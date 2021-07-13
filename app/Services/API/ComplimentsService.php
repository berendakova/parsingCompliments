<?php


namespace App\Services\API;


use App\Models\Category;
use App\Models\Compliment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ComplimentsService
{
    public function create(string $text, int $categoryId = null): Compliment
    {
        $compliment = new Compliment();
        $compliment->text = $text;
        $compliment->save();
        if (isset($categoryId)) {
            $compliment->categories()->attach($categoryId);
        }
        return $compliment;
    }

    public function getRandomByCategory(int $categoryId, ?int $count = 1): Collection
    {
        return DB::table('compliments')
            ->join('compliments_categories_pivot', 'compliments.id', '=', 'compliment_id')
            ->where('compliments_categories_pivot.category_id', '=', $categoryId)
            ->inRandomOrder()
            ->limit(1)
            ->get();
    }

    public function getAll(): Collection
    {
        return Compliment::all();
    }

    public function getAllByCategory(int $categoryId): Collection
    {
        return DB::table('compliments')
            ->join('compliments_categories_pivot', 'compliments.id', '=', 'compliment_id')
            ->where('compliments_categories_pivot.category_id', '=', $categoryId)
            ->inRandomOrder()
            ->get();
    }

    public function delete(int $id): void
    {
        Compliment::findOrFail($id)->delete();
    }

    public function attachComplimentToCategories(int $complimentId, int $categoryId): void
    {
        Category::findOrFail($categoryId);
        Compliment::findOrFail($complimentId)->categories()->attach($categoryId);
    }

    public function rand(): Compliment
    {
        return Compliment::inRandomOrder()->first();
    }
}
