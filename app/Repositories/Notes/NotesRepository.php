<?php

namespace App\Repositories\Notes;

use App\Models\Note;
use App\Repositories\BaseRepository;

class NotesRepository extends BaseRepository implements NotesRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Note::class);
    }

    public function all()
    {
        return $this->model::with('tasks')->get();
    }

    public function createTasks(int $noteId, array $data)
    {
        $note = $this->find($noteId);
        $note->tasks()->createMany($data);
    }
}
