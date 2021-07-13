<?php


namespace App\Http\Controllers\API;


use App\Services\API\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function list(): JsonResponse
    {
        $categories =  $this->categoryService->getAll();
        return response()->json($categories);
    }

    public function isExist(int $categoryId) : JsonResponse
    {
        $isExist = $this->categoryService->isExistCategory($categoryId);
        return response()->json($isExist);
    }

}