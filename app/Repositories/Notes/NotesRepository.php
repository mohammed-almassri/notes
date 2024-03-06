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
}
