<?php

namespace InSided\Solution\Utils;

use InSided\Solution\Request\Base\AbstractCommand;

class Validator implements ValidatorInterface
{

    public function validate(AbstractCommand $action): AbstractCommand
    {
        $action->validate();
        return $action;
    }
}
