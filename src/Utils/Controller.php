<?php

namespace InSided\Solution\Utils;

use Exception;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class Controller
{
    public function __construct(
        protected ValidatorInterface $validator,
        protected ResponseFactoryInterface $responseFactory,
    ) {
    }

    public function execute(callable $execute, int $statusCode = 200): ResponseInterface
    {

        $response = null;
        $result = null;

        try {
            $result = $execute();
            $response = $this->responseFactory->createResponse($statusCode);
        } catch (AppException $appException) {
            $result = $appException;
            $response = $this->responseFactory->createResponse($appException->getStatusCode());
        } catch (Exception $exception) {
            $result = new AppException();
            $response = $this->responseFactory->createResponse($result->getStatusCode());
        }

        $body = $response->getBody();
        $body->write(json_encode($result));

        return $response;
    }
}
