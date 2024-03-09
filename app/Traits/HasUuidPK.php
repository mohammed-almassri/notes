<?php
namespace App\Traits;

trait HasUuidPK
{
    public function getKeyType()
    {
        return 'string';
    }

    public function getIncrementing()
    {
        return false;
    }
}
