<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class TaskData extends Data
{
    public function __construct(
        public string $title,
        public ?string $description,
        public int $user_id,
        public int $note_id,
        public ?int $parentId = null,
    ) {}

    public static function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'note_id' => ['required', 'integer', 'exists:notes,id'],
            'parentId' => ['nullable', 'integer', 'exists:tasks,id'],
        ];
    }
}
