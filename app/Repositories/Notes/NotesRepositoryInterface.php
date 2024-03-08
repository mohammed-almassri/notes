<?php
namespace App\Repositories\Notes;

use App\Repositories\BaseRepositoryInterface;

interface NotesRepositoryInterface extends BaseRepositoryInterface
{
    public function createTasks(int $noteId, array $data);
}
