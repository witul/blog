<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    public function all(array $columns = ['*'], array $relations = []): Collection;

    public function findById(int $id, array $columns = ['*'], array $relations = [], array $appends = []): ?Model;

    public function store(array $payload): ?Model;

    public function update(int $id, array $payload): bool;

    public function delete(int $id): bool;
}
