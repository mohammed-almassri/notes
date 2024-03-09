<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class TaskData extends Data
{
    public function __construct(
        public string $id,
        public ?string $title,
        public ?string $description,
        public int $user_id,
        public string $note_id,
        public ?bool $done,
        public int $order,
    ) {}

    public static function rules(): array
    {
        return [
            'id' => ['required', 'uuid'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'note_id' => ['required', 'uuid', 'exists:notes,id'],
            'done' => ['nullable', 'boolean'],
            'order' => ['required', 'integer'],
        ];
    }
}
