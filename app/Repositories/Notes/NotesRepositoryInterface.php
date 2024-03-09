<?php
namespace App\Repositories\Notes;

use App\Repositories\BaseRepositoryInterface;

interface NotesRepositoryInterface extends BaseRepositoryInterface
{
    public function createTasks(string $noteId, array $data);
    public function updateTasks(string $noteId, array $data);
}
