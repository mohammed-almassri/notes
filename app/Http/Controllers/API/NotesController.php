<?php

namespace App\Http\Controllers\API;

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
        $data = array_merge(
            $request->all(),
            ['user_id' => \Auth::id()]
        );
        $note = $this->notesRepository->create($data);
        return $note;
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
        return $note;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
