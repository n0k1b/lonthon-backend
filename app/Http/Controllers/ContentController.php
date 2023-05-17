<?php

namespace App\Http\Controllers;

use App\Models\CategorySubcategoryGenreMap;
use App\Models\Content;
use App\Models\ContentMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Log;
use Spatie\PdfToImage\Pdf;
use Throwable;

class ContentController extends Controller
{
    //

    public function show(Content $id)
    {
        $data = Content::with('media')->first();
        if ($data->media_type == 3) {
            $image = $this->fetchImageFromPdf($data->media[0]->media_url);
            Log::info($image);
        }
        return $this->successJsonResponse('Homepage content found', $data);
    }
    public function store(Request $request)
    {
        //Log::info($request);
        try {

            $user_id = 1;
            $category_subcategory_map = CategorySubcategoryGenreMap::where('category_id', $request->category_id)->where('subcategory_id', $request->sub_category_id)->where('genre_id', $request->genre_id)->first();

            // Handle thumbnail image upload
            if ($request->has('thumbnail_image')) {
                $thumbnailImage = $request->thumbnail_image;
                $thumbnail_image = $this->processBase64Image($thumbnailImage, $user_id, 'thumbnail');
            } else {
                $thumbnail_image = null;
            }

            // Handle feature image upload
            if ($request->has('feature_image')) {
                $featureImage = $request->feature_image;
                $feature_image = $this->processBase64Image($featureImage, $user_id, 'feature');
            } else {
                $feature_image = null;
            }

            // Create new content instance
            $content = new Content();
            $content->user_id = $user_id;
            $content->category_sub_category_map_id = $category_subcategory_map->id;
            $content->title = $request->title;
            $content->thumbnail_image = $thumbnail_image;
            $content->feature_image = $feature_image;
            $content->summary = $request->summary;
            $content->type = $request->type;
            $content->media_type = $request->content_type;
            $content->save();

            // Handle content media upload
            $content_media = new ContentMedia();

            if ($request->content_type == 2) {
                $content_media->content_id = $content->id;
                $content_media->media_type = $request->content_type;
                $content_media->media_text = $request->content;
                $content_media->save();
            } elseif ($request->content_type == 3) {
                $content_media->content_id = $content->id;
                $content_media->media_type = $request->content_type;
                $content_media->media_url = $this->processBase64Image($request->content, $user_id, 'media_document', 'pdf');
                $content_media->save();
            } else {
                foreach ($request->content as $media) {
                    $content_media->content_id = $content->id;
                    $content_media->media_type = $request->content_type;
                    $media_content = $media;
                    $media_url = $this->processBase64Image($media_content, $user_id, 'media_image');
                    $content_media->media_url = $media_url;
                    $content_media->save();
                }
            }
        } catch (Throwable $th) {
            Log::error($th);
        }
    }

    private function processBase64Image($base64Image, $user_id, $directory, $type = 'image')
    {

        if ($type == 'image') {

            $filename = $directory . '/' . $user_id . '_' . uniqid() . '.png';
            $image = str_replace('data:image/jpeg;base64,', '', $base64Image);
            $image = str_replace(' ', '+', $image);
            Storage::disk('public')->put($filename, base64_decode($image));
            return url('storage/' . $filename);
        } else {

            $filename = $directory . '/' . $user_id . '_' . uniqid() . '.pdf';
            $pdfPath = tempnam(sys_get_temp_dir(), 'pdf');

            file_put_contents($pdfPath, base64_decode($base64Image));
            $pdf = new Pdf($pdfPath);
            $numPages = $pdf->getNumberOfPages();
            $savedImagePaths = [];

            for ($page = 1; $page <= $numPages; $page++) {
                // Generate a unique image name
                $imageName = uniqid('image_', true) . '.jpg';

                // Set the current page and save the image
                $pdf->setPage($page)->saveImage(storage_path('app/pdf-images') . '/' . $imageName);

                // Save the image using the Storage facade
                $savedImagePath = 'path/to/save/' . $imageName; // Replace with the desired save location
                Storage::disk('public')->put($savedImagePath, file_get_contents(storage_path('app/pdf-images') . '/' . $imageName));

                $savedImagePaths[] = $savedImagePath;
            }

            // Delete the temporary PDF file
            unlink($pdfPath);

            //return response()->json(['saved_image_paths' => $savedImagePaths]);
            return url('storage/' . $savedImagePaths);
        }
        // assuming all images are JPEGs

    }
}
