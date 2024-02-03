<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategorySubcategoryGenreMap;
use App\Models\Content;
use App\Models\ContentMedia;
use App\Models\DownloadedContent;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $data = Content::with('media', 'category', 'subCategory', 'genre')->findOrFail($id);

        if ($data->media_type == 1) {
            $client = new Client();
            $response = $client->get(env('do_url') . $data->media[0]->media_url);
            $pdfContents = $response->getBody()->getContents();
            $data->media[0]->media_url = base64_encode($pdfContents);
            $data->media[0]->pdf_url = base64_encode($pdfContents);
        }
        $downloadStatus = 0;
        if (auth('api')->check()) {
            $userId = auth('api')->user()->id;
            $download = DownloadedContent::where('user_id', $userId)->where('content_id', $id)->first();
            if ($download) {
                $downloadStatus = 1;
            }

        }

        $data->download_status = $downloadStatus;
        return $this->successJsonResponse('Content data found', $data);
    }

    public function store(Request $request)
    {

        try {
            $user_id = auth('api')->user()->id;

            DB::beginTransaction();

            $thumbnail_image = $request->has('thumbnail_image')
            ? $this->uploadMedia($request->thumbnail_image, 'thumbnail')
            : null;

            $feature_image = $request->has('feature_image')
            ? $this->uploadMedia($request->feature_image, 'feature')
            : null;

            $contentData = [
                'user_id' => $user_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->sub_category_id,
                'genre_id' => $request->genre_id,
                'title' => $request->title,
                'author' => $request->author,
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

            $contentMediaItems = [];
            if ($request->content_type == 4) {
                $contentMediaItems[] = [
                    'content_id' => $content->id,
                    'media_type' => $request->content_type,
                    'media_url' => $this->uploadMedia($request->content, 'video'),
                ];
            } elseif ($request->content_type == 2) {
                $contentMediaItems[] = [
                    'content_id' => $content->id,
                    'media_type' => $request->content_type,
                    'media_text' => $request->content,
                ];
            } elseif ($request->content_type == 1) {
                $contentFiles = $request->file('content');
                $contentMediaItems[] = [
                    'content_id' => $content->id,
                    'media_type' => $request->content_type,
                    'media_url' => $this->uploadMedia($contentFiles, 'document'),
                ];
            } elseif ($request->content_type == 0) {
                $contentFiles = $request->file('content');
                foreach ($contentFiles as $media) {
                    $contentMediaItems[] = [
                        'content_id' => $content->id,
                        'media_type' => $request->content_type,
                        'media_url' => $this->uploadMedia($media, 'image'),
                    ];
                }
            }

            if (!empty($contentMediaItems)) {
                ContentMedia::insert($contentMediaItems);
            }

            DB::commit();
            return $this->successJsonResponse('Content uploaded successfully', $content);
        } catch (Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return $this->errorJsonResponse('Content not uploaded3');
        }
    }

    public function update(Request $request, $resourceId)
    {
        try {
            // Get the JSON data from the request body
            $requestData = $request->json()->all();

            // Log the received data
            Log::info('Received data:', ['data' => $requestData]);

            // Return the response
            return response()->json(['status' => 'success', 'message' => 'Resource updated successfully', "_id" => $resourceId, "data" => $requestData]);
        } catch (Throwable $th) {
            Log::error($th);
            return $this->errorJsonResponse('content not updated');
        }
    }

    public function contentByCategory()
    {
        $categories = Category::with(['contents.category', 'contents.subCategory', 'contents.genre'])->get();
        $data = [];
        foreach ($categories as $category) {
            if (sizeof($category->contents) > 0) {
                $data[] = [
                    'id' => $category->id,
                    'category_name' => $category->name,
                    'content' => $category->contents,
                ];
            }

        }

        return $this->successJsonResponse('Content data found', $data);
    }

    public function fetchContentFromCategory($id)
    {
        $categoryMaps = CategorySubcategoryGenreMap::where('category_id', $id)->get();
        $data = [];
        foreach ($categoryMaps as $categoryMap) {
            $contents = Content::with(['media', 'category', 'subCategory', 'genre'])
                ->where('category_sub_category_map_id', $categoryMap->id)
                ->get();

            foreach ($contents as $content) {
                if ($content->media_type == 1) {
                    $client = new Client();
                    $response = $client->get($content->media[0]->media_url);
                    $pdfContents = $response->getBody()->getContents();
                    $content->media[0]->media_url = base64_encode($pdfContents);
                }
            }

            $data[] = [
                'category_id' => $categoryMap->category->id,
                'category_name' => $categoryMap->category->name,
                'content' => $contents,
            ];
        }
        return $this->successJsonResponse('Content data found', $data);
    }

    public function fetchContentFromSubCategory($id)
    {
        $categoryMaps = CategorySubcategoryGenreMap::where('subcategory_id', $id)->get();
        $data = [];
        $genre = [];

        foreach ($categoryMaps as $categoryMap) {
            // Fetch contents directly using category_id and genre_id
            $contents = Content::with('media')
                ->where('category_id', $categoryMap->category_id)
                ->where('genre_id', $categoryMap->genre_id)
                ->get();

            foreach ($contents as $content) {
                if ($content->media_type == 1) {
                    $client = new Client();
                    $response = $client->get($content->media[0]->media_url);
                    $pdfContents = $response->getBody()->getContents();
                    $content->media[0]->media_url = base64_encode($pdfContents);
                }
            }

            $data[] = [
                'subcategory_id' => $categoryMap->subCategory->id,
                'subcategory_name' => $categoryMap->subCategory->name,
                'category_name' => $categoryMap->category->name,
                'genre_name' => $categoryMap->genre->name,
                'content' => $contents,
            ];

            $genre[] = [
                'id' => $categoryMap->id,
                'genre' => $categoryMap->genre->name,
            ];
        }

        $finalData = ['content_data' => $data, 'genre' => $genre];
        return $this->successJsonResponse('Content data found', $finalData);
    }

    public function fetchContentFromGenre($id)
    {
        $categoryMaps = CategorySubcategoryGenreMap::where('genre_id', $id)->get();
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
                'genre_id' => $categoryMap->genre->id,
                'category_name' => $categoryMap->category->name,
                'genre_name' => $categoryMap->genre->name,
                'content' => $contents,
            ];
        }
        return $this->successJsonResponse('Content data found', $data);
    }

    private function uploadMedia($mediaFile, $directory)
    {
        $path = Storage::disk('do_spaces')->put('test/content/' . $directory, $mediaFile, 'public');
        return $path;
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
