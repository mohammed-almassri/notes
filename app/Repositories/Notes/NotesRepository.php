<?php

namespace App\Repositories\Notes;

use App\Models\Note;
use App\Repositories\BaseRepository;
use App\Services\Metadata\MetadataServiceInterface;
use Illuminate\Database\Eloquent\Model;

class NotesRepository extends BaseRepository implements NotesRepositoryInterface
{
    private MetadataServiceInterface $metadataService;
    public function __construct(MetadataServiceInterface $metadataService)
    {
        parent::__construct(Note::class);
        $this->metadataService = $metadataService;
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

        $tasksToCreate = array_filter($data, fn($task) => !in_array($task['id'], array_column($tasks->toArray(), 'id')));
        $tasksToUpdate = array_filter($data, fn($task) => in_array($task['id'], array_column($tasks->toArray(), 'id')));

        $note->tasks()->createMany($tasksToCreate);
        foreach ($tasksToUpdate as $task) {
            $note->tasks()->where('id', $task['id'])->update($task);
        }

        $tasksToDelete = array_filter($tasks->toArray(), fn($task) => !in_array($task['id'], array_column($data, 'id')));
        $note->tasks()->whereIn('id', array_column($tasksToDelete, 'id'))->delete();
    }

    public function setNoteUrl(Model $note)
    {
        $titleURL = preg_match('/\bhttps?:\/\/\S+\.\S+\b/', $note->title, $matches);
        $url = null;
        if ($titleURL) {
            $url = $matches[0];
        } else {
            $descriptionURL = preg_match('/\bhttps?:\/\/\S+\.\S+\b/', $note->description, $matches);
            if ($descriptionURL) {
                $url = $matches[0];
            }
        }

        if ($url && $note->url !== $url) {
            $note->url = $url;
            $metadata = $this->metadataService->getMetadata($note->url);
            $note->metadata_title = $metadata->title;
            $note->metadata_image = $metadata->image;
        } else if (!$url) {
            $note->url = null;
            $note->metadata_title = null;
            $note->metadata_image = null;
        }

        $note->save();
    }
}
