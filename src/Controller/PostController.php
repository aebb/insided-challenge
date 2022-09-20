<?php

namespace InSided\Solution\Controller;

use InSided\Solution\Utils\Controller;
use InSided\Solution\Utils\ValidatorInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class PostController extends Controller
{
    public function __construct(ValidatorInterface $validator, ResponseFactoryInterface $responseFactory)
    {
        $this->validator = $validator;
        $this->responseFactory = $responseFactory;
    }
}
