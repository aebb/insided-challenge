<?php

namespace InSided\Solution\Utils;

use JsonSerializable;

abstract class AbstractController
{
    public function execute(callable $execute): JsonSerializable
    {
        try {
            return $execute();
        } catch (AppException $appException) {
            //return $this->json($appException, $appException->getStatusCode());
        } catch (Exception $exception) {
//            $appException = new AppException();
//            return $this->json($appException, $appException->getStatusCode());
        }
    }
}
