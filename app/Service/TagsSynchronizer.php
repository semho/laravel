<?php

namespace App\Service;

class TagsSynchronizer
{

    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

}
