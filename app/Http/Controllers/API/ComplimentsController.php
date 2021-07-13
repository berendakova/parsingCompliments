<?php


namespace App\Http\Controllers\API;


use App\Http\Request\CreateRequest;
use App\Http\Request\RandByCategoryRequest;
use App\Services\API\ComplimentsService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ComplimentsController
{
    private ComplimentsService $complimentsService;

    public function __construct(ComplimentsService $complimentsService)
    {
        $this->complimentsService = $complimentsService;
    }

    public function create(CreateRequest $request): JsonResponse
    {
        $compliment = $this->complimentsService->create($request->text, $request->categoryId ?? null);
        return response()->json($compliment);
    }

    public function randByCategory(RandByCategoryRequest $request, int $categoryId): JsonResponse
    {
        $compliment = $this->complimentsService->getRandomByCategory($categoryId, $request->count);
        return response()->json($compliment);
    }

    public function delete(int $complimentId): Response
    {
        $this->complimentsService->delete($complimentId);
        return response()->noContent();
    }

    public function list(): JsonResponse
    {
        $compliments = $this->complimentsService->getAll();
        return response()->json($compliments);
    }

    public function listByCategory(int $categoryId): JsonResponse
    {
        $compliments = $this->complimentsService->getAllByCategory($categoryId);
        return response()->json($compliments);
    }

    public function attachToCategory(int $complimentId, int $categoryId)
    {
        $this->complimentsService->attachComplimentToCategories($complimentId, $categoryId);
    }

    public function getRand(): JsonResponse
    {
        $compliment = $this->complimentsService->rand();
        return response()->json($compliment);
    }

}
