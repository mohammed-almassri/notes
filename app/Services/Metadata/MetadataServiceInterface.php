<?php
namespace App\Services\Metadata;

use App\Services\Metadata\Responses\GetMetadataResponse;

interface MetadataServiceInterface
{
    public function getMetadata($url): GetMetadataResponse;
}
