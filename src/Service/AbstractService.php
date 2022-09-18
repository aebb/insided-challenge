<?php

namespace InSided\Solution\Service;

use Psr\Log\LoggerInterface;

class AbstractService
{
    public function __construct(protected readonly LoggerInterface $logger)
    {

    }
}
