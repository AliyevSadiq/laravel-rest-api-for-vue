<?php

declare(strict_types=1);

namespace App\Service\Repository;

use App\Contract\Image\ImageManipulatorInterface;
use App\Models\Article;

class ArticleRepository extends BaseRepository
{
    private Article $model;
    private ImageManipulatorInterface $imageManipulator;

    public function __construct(Article $model,ImageManipulatorInterface $imageManipulator)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->imageManipulator = $imageManipulator;
    }

    public function all()
    {
        return auth()->user()->articles()->get();
    }

    public function create(array $fields)
    {
        return $this->model->create([
            'title' => $fields['title'],
            'description' => $fields['description'],
            'category_id' => $fields['category_id'],
            'user_id' => auth()->user()->id,
            'image' => $this->imageManipulator->uploadFile($fields['image'], $this->model->getDiskName())
        ]);
    }


    public function update(int $id, array $fields)
    {
        $article=$this->find($id);
        if ($fields['image']){
            $this->imageManipulator->delete($article->image,$this->model->getDiskName());
        }

        $article->update([
            'title' => $fields['title'],
            'description' => $fields['description'],
            'category_id' => $fields['category_id'],
            'user_id' => auth()->user()->id,
            'image' =>  $this->imageManipulator->uploadFile($fields['image'], $this->model->getDiskName())
        ]);

        return $article;
    }

    public function delete(int $id)
    {
        $article=$this->find($id);
        $image=$article->image;
        $article->delete();
        $this->imageManipulator->delete($image,$this->model->getDiskName());
    }
}
