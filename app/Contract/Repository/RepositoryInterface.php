<?php

declare(strict_types=1);

namespace App\Contract\Repository;

interface RepositoryInterface
{
    public function all();
    public function find(int $id);
    public function create(array $fields);
    public function update(int $id,array $fields);
    public function delete(int $id);
}
