<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class NoteData extends Data
{
    /**
     * @property \App\Data\TaskData[] $songs
     */
    public function __construct(
        public ?string $title,
        public ?string $description,
        public ?string $image_url = null,
        public int $user_id,
        public array $tasks = [],
    ) {}

    public static function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_url' => ['nullable', 'string', 'url', 'max:255'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
