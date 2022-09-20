<?php

namespace InSided\Solution\Entity;

use DateTime;

class Comment extends Message
{
    protected ?Post $parent;

    public function __construct(
        string $content,
        User $owner,
        Post $post,
        string $id = null,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    )
    {
        parent::__construct($content, $owner, $id, $createdAt, $updatedAt);
        $this->parent = $post;
    }
}
