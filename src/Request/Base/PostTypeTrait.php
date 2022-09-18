<?php

namespace InSided\Solution\Request\Base;

trait PostTypeTrait
{
    abstract function getType(): string;
}
