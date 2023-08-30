<?php

namespace App\Repositories\Eloquent;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

    class UserEloquentRepository extends BaseRepository implements UserRepositoryInterface
{
    //protected Model $model;
    public function __construct(User $model)
    {
        //$this->model=$model;
        parent::__construct($model);
    }
}
