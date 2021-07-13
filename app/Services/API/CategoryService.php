<?php


namespace App\Services\API;


use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function create(string $name): Category
    {
        $category = new Category();
        $category->name = $name;
        $category->save();

        return $category;
    }

    public function delete(int $id): void
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }

    public function getAll(): Collection
    {
        return Category::all();
    }

    public function isExistCategory(int $categoryId): bool
    {
        $category = Category::findOrFail($categoryId);
        if($category === null) {
            return false;
        }
        return true;
    }

}