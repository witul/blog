<?php

namespace App\Repositories\Eloquent;


use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
class BaseRepository implements EloquentRepositoryInterface
{

    /**
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
     * @param $sortBy
     * @param $sortDir
     * @return void
     */
    public function sortBy($sortBy, $sortDir){

    }
    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * @param callable $scopeFunction
     * @return mixed
     */
    public function scope(callable $scopeFunction){
        return $scopeFunction($this->model->newQuery());
    }

    /**
     * @param $column
     * @param $dir
     * @return mixed
     */
    public function orderBy($column, $dir='asc'){
        return $this->scope(function($q) use($column,$dir){
            $method = ($dir === 'asc' ? 'orderBy':'orderByDesc');
            return $q->$method($column);
        });
    }

    /**
     * @param $perPage
     * @param array $columns
     * @param array $relations
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 10, array $columns = ['*'], array $relations = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->model->with($relations)->paginate($perPage, $columns);
    }

    /**
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @param array $appends
     * @return Model|null
     */
    public function findById(int $id, array $columns = ['*'], array $relations = [], array $appends = []): ?Model
    {
        return $this->model->select($columns)->with($relations)->findOrFail($id)->append($appends);
    }

    /**
     * @param array $payload
     * @return Model|null
     */
    public function store(array $payload): ?Model
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    /**
     * @param int $id
     * @param array $payload
     * @return bool
     */
    public function update(int $id, array $payload): bool
    {
        $model = $this->findById($id);
        return $model->update($payload);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->findById($id)->delete();
    }
}
