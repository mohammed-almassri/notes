<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class NoteData extends Data
{
    /**
     * @property \App\Data\TaskData[] $songs
     */
    public function __construct(
        public string $id,
        public ?string $title,
        public ?string $description,
        public ?string $image_url = null,
        public int $user_id,
        public ?array $tasks = [],
        public ?string $url = null,
        public ?string $metadata_title = null,
        public ?string $metadata_image = null
    ) {}

    public static function rules(): array
    {
        return [
            'id' => ['required', 'uuid'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_url' => ['nullable', 'string', 'url', 'max:255'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
