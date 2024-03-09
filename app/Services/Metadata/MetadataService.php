<?php
namespace App\Services\Metadata;

use App\Services\Metadata\Responses\GetMetadataResponse;
use DOMDocument;
use GuzzleHttp\Client;

class MetadataService implements MetadataServiceInterface
{
    public function getMetadata($url): GetMetadataResponse
    {
        $client = new Client([
            'timeout' => 10,
        ]);
        $response = $client->get($url);
        $html = (string) $response->getBody();
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        libxml_use_internal_errors(false);

        $titleNodeList = $doc->getElementsByTagName('title');
        $title = $titleNodeList->length > 0 ? $titleNodeList->item(0)->textContent : '';

        $image = '';
        $metaTags = $doc->getElementsByTagName('meta');
        foreach ($metaTags as $metaTag) {
            if ($metaTag->getAttribute('property') === 'og:image') {
                $image = $metaTag->getAttribute('content');
                break;
            }
        }

        return new GetMetadataResponse($title, $image);
    }
}
