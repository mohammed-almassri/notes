<?php

namespace App\Repositories\Tasks;

use App\Models\Task;
use App\Repositories\BaseRepository;

class TasksRepository extends BaseRepository implements TasksRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Task::class);
    }
}
