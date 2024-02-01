<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Throwable;

class HomepageController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::with('subcategories.subCategory.genres.genre')->get();
            $homepageContent = $categories->map(function ($category) {
                $categoryData = $category->toArray();
                $categoryData['subcategories'] = $category->subcategories->pluck('subCategory')->toArray();
                if ($categoryData['subcategories']) {
                    foreach ($categoryData['subcategories'] as &$subcategory) {
                        if ($subcategory['genres']) {
                            $subcategory['genres'] = collect($subcategory['genres'])->pluck('genre')->toArray();
                        }
                    }
                }

                return $categoryData;
            });

            if ($homepageContent) {
                return $this->successJsonResponse('Homepage content found', $homepageContent);
            }
            return $this->errorJsonResponse('Homepage content not found');
        } catch (Throwable $th) {
            return $this->exceptionJsonResponse($th);
        }
    }
    public function getCategory()
    {
        $data = Category::with('subcategories')->get();
        return $this->successJsonResponse('Category data found', $data);
    }
    public function getSubCategory($id)
    {
        $data = Category::with('subcategories.subcategory')->where('id', $id)->first();

        if ($data) {

            $subcategories = $data->subcategories->pluck('subcategory');

            return $this->successJsonResponse('Subcategory data found', $subcategories);
        }

        return $this->errorJsonResponse('Category not found');
    }

    public function getGenre($id)
    {
        $data = Subcategory::with('genres')->where('id', $id)->first();

        if ($data) {
            $genres = $data->genres->pluck('genre');

            return $this->successJsonResponse('Genre data found', $genres);
        }

        return $this->errorJsonResponse('Category not found');
    }
}
