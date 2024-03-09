<?php
namespace App\Services\Metadata\Responses;

class GetMetadataResponse
{
    public $title;
    public $image;
    public function __construct($title, $image)
    {
        $this->title = $title;
        $this->image = $image;
    }
}
