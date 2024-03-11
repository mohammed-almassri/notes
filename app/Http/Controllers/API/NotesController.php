<?php

namespace App\Http\Controllers\API;

use App\Data\NoteData;
use App\Data\TaskData;
use App\Http\Controllers\Controller;
use App\Repositories\Notes\NotesRepositoryInterface;
use Illuminate\Http\Request;

class NotesController extends Controller
{

    private $notesRepository;

    public function __construct(NotesRepositoryInterface $notesRepository)
    {
        $this->notesRepository = $notesRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->notesRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $noteData = NoteData::validateAndCreate(array_merge(
            $request->all(),
            ['user_id' => \Auth::id()]
        ));
        $note = $this->notesRepository->create($noteData->toArray());
        try {
            $this->notesRepository->setNoteUrl($note);
        } catch (\Exception $e) {
            //ignore
        }

        $tasksData = [];
        if ($request->tasks) {
            foreach ($request->tasks as $task) {
                $tasksData[] = TaskData::validateAndCreate(array_merge(
                    $task,
                    ['user_id' => \Auth::id(), 'note_id' => $note->id]
                ));
            }
        }

        $this->notesRepository->createTasks($note->id, array_map(fn($task) => $task->toArray(), $tasksData));

        return $noteData;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->notesRepository->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $note = $this->notesRepository->update($id, $request->all());
        try {
            $this->notesRepository->setNoteUrl($note);
        } catch (\Exception $e) {
            //ignore
        }

        $tasksData = [];
        if ($request->tasks) {
            foreach ($request->tasks as $task) {
                $tasksData[] = TaskData::validateAndCreate(array_merge(
                    $task,
                    ['user_id' => \Auth::id(), 'note_id' => $note->id]
                ));
            }
        }
        $this->notesRepository->updateTasks($id, array_map(fn($task) => $task->toArray(), $tasksData));
        $noteData = NoteData::from($note);
        return $noteData;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->notesRepository->delete($id);
        return response()->json(['message' => 'Note deleted successfully'], 204);
    }
}
