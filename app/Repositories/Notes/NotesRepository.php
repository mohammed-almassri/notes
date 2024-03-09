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

    public function createTasks(string $noteId, array $data)
    {
        $note = $this->find($noteId);
        $note->tasks()->createMany($data);
    }

    public function updateTasks(string $noteId, array $data)
    {
        $note = $this->find($noteId);
        $tasks = $note->tasks;
        //split the data into two arrays, one for the tasks to be created and one for the tasks to be updated
        //the data where the id is not in the tasks array will be used to create new tasks
        //the data where the id is in the tasks array will be used to update the existing tasks

        $tasksToCreate = array_filter($data, fn($task) => !in_array($task['id'], array_column($tasks->toArray(), 'id')));
        $tasksToUpdate = array_filter($data, fn($task) => in_array($task['id'], array_column($tasks->toArray(), 'id')));

        $note->tasks()->createMany($tasksToCreate);
        foreach ($tasksToUpdate as $task) {
            $note->tasks()->where('id', $task['id'])->update($task);
        }

        //get the ids of the tasks that are not in the data array and delete them

        $tasksToDelete = array_filter($tasks->toArray(), fn($task) => !in_array($task['id'], array_column($data, 'id')));
        $note->tasks()->whereIn('id', array_column($tasksToDelete, 'id'))->delete();

    }
}
