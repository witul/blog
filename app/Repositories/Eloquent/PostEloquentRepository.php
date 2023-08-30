<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PostEloquentRepository extends BaseRepository implements PostRepositoryInterface
{
    //protected Model $model;
    public function __construct(Post $model)
    {
        //$this->model=$model;
        parent::__construct($model);
    }

    public function store(array $payload): ?Model
    {

        if ($payload['file'] ?? null) {
            $payload['thumbnail'] = $payload['file']->store('thumbnails', 'public');
        }
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function update(int $id, array $payload): bool
    {
        $model = $this->findById($id);
        if ($payload['file'] ?? null) {
            $payload['thumbnail'] = $payload['file']->store('thumbnails', 'public');
        }
        return $model->update($payload);
    }
}
