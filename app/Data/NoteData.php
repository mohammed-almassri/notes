<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class NoteData extends Data
{
    public function __construct(
        public string $title,
        public string $description,
        public ?string $image_url = null,
        public int $user_id,
    ) {}

    public static function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image_url' => ['nullable', 'string', 'url', 'max:255'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
