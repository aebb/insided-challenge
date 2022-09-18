<?php

namespace InSided\Solution\Entity;

abstract class Message extends Model
{
    protected string $contents;

    protected User $createdBy;
}
