<?php

namespace InSided\Solution\Utils;

use InSided\Solution\Request\Base\AbstractCommand;

interface ValidatorInterface
{
    function validate(AbstractCommand $action): AbstractCommand;
}
