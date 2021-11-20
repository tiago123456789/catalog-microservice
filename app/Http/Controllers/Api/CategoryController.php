<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(CategoryRequest $request)
    {
        return Category::create($request->all());
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::where("id", "=", $id)->first();
        if (!$category) {
            return response()->json([
                "message" => "Category not found."
            ], 404);
        }

        $dataModified = $request->all();
        Category::where("id", "=", $id)->update($dataModified);
        return response()->json(null, 204);
    }

    public function destroy(int $id)
    {
        $category = Category::where("id", "=", $id)->first();
        if (!$category) {
            return response()->json([
                "message" => "Category not found."
            ], 404);
        }

        Category::destroy($id);
        return response()->json(null, 204);
    }

}
