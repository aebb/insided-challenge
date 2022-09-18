<?php

namespace InSided\Solution\Validator;

interface ValidatorInterface
{
    function validate(Action $action): Action;
}
