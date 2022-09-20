<?php

namespace InSided\Solution\Entity;

use DateTime;

abstract class Message extends Model
{
    protected ?string $content;

    protected ?User $owner;

    public function __construct(
        string $content = null,
        User $owner = null,
        string $id = null,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    )
    {
        parent::__construct($id, $createdAt, $updatedAt);
        $this->content =  $content;
        $this->owner = $owner;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }
}
