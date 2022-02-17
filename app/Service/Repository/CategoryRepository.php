<?php

declare(strict_types=1);

namespace App\Service\Repository;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
