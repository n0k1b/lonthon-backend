<?php

namespace App\Http\Controllers;

use App\Models\CategorySubcategoryGenreMap;
use App\Models\Content;
use App\Models\ContentMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ContentController extends Controller
{
    //
    public function index()
    {
        $data = Content::get();
        return $this->successJsonResponse('Content data found', $data);
    }
    public function show($id)
    {
        $data = Content::with('media')->findOrFail($id);
        return $this->successJsonResponse('Content data found', $data);
    }

    public function store(Request $request)
    {
        try {
            $user_id = 1;
            $category_subcategory_map = CategorySubcategoryGenreMap::where('category_id', $request->category_id)
                ->where('subcategory_id', $request->sub_category_id)
                ->where('genre_id', $request->genre_id)
                ->first();

            DB::beginTransaction();

            // Handle thumbnail image upload
            $thumbnail_image = $request->has('thumbnail_image')
            ? $this->processBase64Image($request->thumbnail_image, $user_id, 'thumbnail')
            : null;

            // Handle feature image upload
            $feature_image = $request->has('feature_image')
            ? $this->processBase64Image($request->feature_image, $user_id, 'feature')
            : null;

            // Create new content instance
            $content = new Content([
                'user_id' => $user_id,
                'category_sub_category_map_id' => $category_subcategory_map->id,
                'title' => $request->title,
                'thumbnail_image' => $thumbnail_image,
                'feature_image' => $feature_image,
                'summary' => $request->summary,
                'type' => $request->type,
                'media_type' => $request->content_type,
            ]);

            if (!$content->save()) {
                DB::rollBack();
                return $this->successJsonResponse('Content not uploaded');
            }

            // Handle content media upload
            $contentMediaItems = [];

            if ($request->content_type == 2) {
                $contentMediaItems[] = [
                    'content_id' => $content->id,
                    'media_type' => $request->content_type,
                    'media_text' => $request->content,
                ];
            } elseif ($request->content_type == 3) {
                $contentMediaItems[] = [
                    'content_id' => $content->id,
                    'media_type' => $request->content_type,
                    'media_url' => $this->processBase64Image($request->content, $user_id, 'media_document', 'pdf'),
                ];
            } elseif ($request->content_type == 0) {
                foreach ($request->content as $media) {
                    $contentMediaItems[] = [
                        'content_id' => $content->id,
                        'media_type' => $request->content_type,
                        'media_url' => $this->processBase64Image($media, $user_id, 'media_image'),
                    ];
                }
            }

            if (!empty($contentMediaItems)) {
                ContentMedia::insert($contentMediaItems);
            }

            DB::commit();
            return $this->successJsonResponse('Content uploaded successfully', $content);
        } catch (Throwable $th) {
            DB::rollBack();
            return $this->successJsonResponse('Content not uploaded');
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
            Storage::disk('public')->put($filename, base64_decode($base64Image));
            return url('storage/' . $filename);
        }
        // assuming all images are JPEGs
    }
}
