<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all();

    public function paginate(int $perPage = 10);

    public function find($id);

    public function create(array $data): Model;

    public function update($id, array $data): Model;

    public function delete($id);
}
