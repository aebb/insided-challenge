<?php

namespace InSided\Solution\Entity;

use DateTime;

abstract class Post extends Message
{
    protected ?array $comments;

    public function __construct(
        string $content = null,
        User $owner = null,
        array $comments = [],
        string $id = null,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    ) {
        parent::__construct($content, $owner, $id, $createdAt, $updatedAt);
        $this->comments = $comments;
    }

    abstract public function addComment(Comment $comment): ?Comment;

    public function setData(array $data)
    {
        $this->content = $data['content'];
    }

    public function jsonSerialize(): array
    {
        $result = parent::jsonSerialize();
        $owner = $this->getOwner() ? ['owner' => $this->getOwner()->getUsername()] : [];

        return array_merge($result, $owner);
    }
}
