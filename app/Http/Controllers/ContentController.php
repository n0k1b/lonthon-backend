<?php

namespace App\Http\Controllers;

use App\Models\CategorySubcategoryGenreMap;
use App\Models\Content;
use App\Models\ContentMedia;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Log;
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

        if ($data->media_type == 1) {
            $client = new Client();
            $response = $client->get($data->media[0]->media_url);
            $pdfContents = $response->getBody()->getContents();
            $data->media[0]->media_url = base64_encode($pdfContents);
        }

        return $this->successJsonResponse('Content data found', $data);
    }

    public function store(Request $request)
    {
        try {
            $user_id = 1;
            $category_subcategory_map = CategorySubcategoryGenreMap::where([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->sub_category_id,
                'genre_id' => $request->genre_id,
            ])->first();

            $author = implode(',', $request->author);
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
            $contentData = [
                'user_id' => $user_id,
                'category_sub_category_map_id' => $category_subcategory_map->id,
                'title' => $request->title,
                'author' => $author,
                'thumbnail_image' => $thumbnail_image,
                'feature_image' => $feature_image,
                'summary' => $request->summary,
                'type' => $request->type,
                'media_type' => $request->content_type,
            ];

            $content = Content::create($contentData);

            if (!$content) {
                DB::rollBack();
                return $this->errorJsonResponse('Content not uploaded2');
            }

            // Handle content media upload
            $contentMediaItems = [];

            if ($request->content_type == 2) {
                $contentMediaItems[] = [
                    'content_id' => $content->id,
                    'media_type' => $request->content_type,
                    'media_text' => $request->content,
                ];
            } elseif ($request->content_type == 1) {
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
            Log::info($th);
            DB::rollBack();
            return $this->errorJsonResponse('Content not uploaded3');
        }
    }

    public function contentByCategory()
    {
        $categoryMaps = CategorySubcategoryGenreMap::with('category')->get();
        $data = [];
        foreach ($categoryMaps as $categoryMap) {
            $contents = Content::with('media')->where('category_sub_category_map_id', $categoryMap->id)->get();
            foreach ($contents as $content) {
                if ($content->media_type == 1) {
                    $client = new Client();
                    $response = $client->get($content->media[0]->media_url);
                    $pdfContents = $response->getBody()->getContents();
                    $content->media[0]->media_url = base64_encode($pdfContents);
                }
            }

            $data[] = [
                'id' => $categoryMap->category->id,
                'category_name' => $categoryMap->category->name,
                'content' => $contents,
            ];

        }

        return $this->successJsonResponse('Content data found', $data);
    }

    private function processBase64Image($base64Image, $user_id, $directory, $type = 'image')
    {
        if ($type == 'image') {
            $filename = $directory . '/' . $user_id . '_' . uniqid() . '.png';
            $image = str_replace('data:image/jpeg;base64,', '', $base64Image);
            $image = str_replace('data:image/png;base64,', '', $base64Image);
            $image = str_replace(' ', '+', $image);
            Storage::disk('public')->put($filename, base64_decode($image));
            return url('storage/' . $filename);
        } else {
            $filename = $directory . '/' . $user_id . '_' . uniqid() . '.pdf';
            $image = str_replace('data:application/pdf;base64,', '', $base64Image);
            $image = str_replace(' ', '+', $image);
            Storage::disk('public')->put($filename, base64_decode($image));
            return url('storage/' . $filename);
        }
        // assuming all images are JPEGs
    }
}
