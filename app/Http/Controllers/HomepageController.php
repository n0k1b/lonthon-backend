<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
}
