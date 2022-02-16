<?php

namespace App\Http\Controllers;

use App\Contract\Image\ImageManipulatorInterface;
use App\Http\Requests\{StoreArticleRequest, UpdateArticleRequest};
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Response;

class ArticleController extends Controller
{

    /**
     * @var ImageManipulatorInterface
     */
    private ImageManipulatorInterface $imageManipulator;


    /**
     * CreateShopHandler constructor.
     * @param ImageManipulatorInterface $imageManipulator
     */
    public function __construct(ImageManipulatorInterface $imageManipulator)
    {
        $this->imageManipulator = $imageManipulator;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ArticleResource::collection(Article::all());
    }

    /**
     * @param StoreArticleRequest $request
     * @return ArticleResource
     */
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'user_id' => auth()->user()->id,
            'image' => $this->imageManipulator->uploadFile($request->file('image'), 'article')
        ]);
        return new ArticleResource($article);
    }

    /**
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return ArticleResource
     */
    public function update(UpdateArticleRequest $request, Article $article): ArticleResource
    {
        if ($request->file('image')){
            $this->imageManipulator->delete($article->image,'article');
        }

        $article->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'user_id' => auth()->user()->id,
            'image' => $this->imageManipulator->uploadFile($request->file('image'), 'article')
        ]);
        return new ArticleResource($article);
    }

    /**
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Article $article): \Illuminate\Http\JsonResponse
    {
        $image=$article->image;
        $article->delete();
        $this->imageManipulator->delete($image,'article');
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
