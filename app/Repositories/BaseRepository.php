<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public function __construct(
        protected string $model
    ) {
    }

    public function all()
    {
        return $this->model::all();
    }

    public function paginate(int $perPage = 10)
    {
        return $this->model::paginate($perPage);
    }

    public function find(int $id)
    {
        return $this->model::find($id);
    }

    public function create(array $data): Model
    {
        return $this->model::create($data);
    }

    public function update(int $id, array $data): Model
    {
        $m = $this->find($id);
        $m->update($data);
        return $m;
    }

    public function delete(int $id)
    {
        return $this->find($id)->delete();
    }
}
