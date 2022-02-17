<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Service\Repository\CategoryRepository;
use Illuminate\Http\Response;

class CategoryController extends Controller
{

    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return CategoryResource::collection($this->categoryRepository->all());
    }


    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->validated());
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }


    public function show(Category $category)
    {
        return new CategoryResource($this->categoryRepository->find($category->id));
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category=$this->categoryRepository->update($category->id,$request->validated());
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }


    public function destroy(Category $category)
    {
        $this->categoryRepository->delete($category->id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
