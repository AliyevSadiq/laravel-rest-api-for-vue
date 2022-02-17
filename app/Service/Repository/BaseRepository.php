<?php

declare(strict_types=1);

namespace App\Service\Repository;

use App\Contract\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    private Model $model;

    public function __construct(Model $model)
   {
       $this->model = $model;
   }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $fields)
    {
        return $this->model->create($fields);
    }

    public function update(int $id, array $fields)
    {
        $this->find($id)->update($fields);
        return $this->find($id);
    }

    public function delete(int $id)
    {
        $this->find($id)->delete();
    }
}
