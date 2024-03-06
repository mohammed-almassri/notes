<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all();

    public function paginate(int $perPage = 10);

    public function find(int $id);

    public function create(array $data): Model;

    public function update(int $id, array $data): Model;

    public function delete(int $id);
}
