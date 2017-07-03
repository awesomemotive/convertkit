<?php

namespace Examinecom\ConvertKit\Service;

use Examinecom\ConvertKit\ConvertKit;

abstract class AbstractService
{
    /**
     * @var ConvertKit
     */
    protected $client;

    public function __construct(ConvertKit $client)
    {
        $this->client = $client;
    }
}
