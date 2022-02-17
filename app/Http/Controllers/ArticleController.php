<?php

namespace App\Http\Controllers;

use App\Contract\Image\ImageManipulatorInterface;
use App\Service\Repository\ArticleRepository;
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
    private ArticleRepository $articleRepository;


    /**
     * CreateShopHandler constructor.
     * @param ImageManipulatorInterface $imageManipulator
     */
    public function __construct(ImageManipulatorInterface $imageManipulator,ArticleRepository $articleRepository)
    {
        $this->imageManipulator = $imageManipulator;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ArticleResource::collection($this->articleRepository->all());
    }

    /**
     * @param StoreArticleRequest $request
     * @return ArticleResource
     */
    public function store(StoreArticleRequest $request)
    {
        $article = $this->articleRepository->create($request->validated());
        return new ArticleResource($article);
    }

    /**
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        return new ArticleResource($this->articleRepository->find($article->id));
    }

    /**
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return ArticleResource
     */
    public function update(UpdateArticleRequest $request, Article $article): ArticleResource
    {
        $article=$this->articleRepository->update($article->id,$request->validated());
        return new ArticleResource($article);
    }

    /**
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Article $article): \Illuminate\Http\JsonResponse
    {
        $this->articleRepository->delete($article->id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
