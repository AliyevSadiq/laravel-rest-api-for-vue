<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{

    public function index()
    {
        return CategoryResource::collection(Category::all());
    }


    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }


    public function show(Category $category)
    {
        return new CategoryResource($category);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}