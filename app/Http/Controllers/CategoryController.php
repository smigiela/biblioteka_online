<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @return Collection
     */
    public function index():Collection
    {
        return Category::all();
    }

    /**
     * @param CategoryRequest $request
     *
     * @return Category
     */
    public function store(CategoryRequest $request):Category
    {
        $newItem = new Category;
        $newItem->nameOfCategory = $request->get("nameOfCategory");
        $newItem->save();

        return $newItem;
    }

    /**
     * @param Category $author
     *
     * @return Category
     */
    public function show(Category $category):Category
    {
        return Category::find($category['id']);
    }


    /**
     * @param CategoryRequest $request
     * @param Category $author
     *
     * @return Category
     */
    public function update(CategoryRequest $request, Category $category):Category
    {
        $newItem = Category::find($category['id']);
        $newItem->update($request->all());
        return $newItem;
    }

    /**
     * @param Category $author
     *
     * @return Category
     */
    public function destroy(Category $category):String
    {
        if (Category::find($category['id'])) {
            Category::destroy($category['id']);
            return "Pomyślnie usunięto autora (ID: " . $category['id'] . ")";
        } else {
            return "Author (ID: " . $category['id'] . ") nie istnieje";
        }
    }
}
