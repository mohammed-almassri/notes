<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class NoteData extends Data
{
    public function __construct(
        public string $title,
        public string $description,
        public ?string $image_url = null,
    ) {}
}
