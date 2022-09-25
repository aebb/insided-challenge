<?php

namespace InSided\Solution\Entity;

use DateTime;

class Article extends Post
{
    protected ?string $title;

    protected ?bool $enableComments;

    public function __construct(
        string $title = null,
        string $content = null,
        string $enableComments = null,
        User $owner = null,
        array $comments = [],
        string $id = null,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    ) {
        parent::__construct($content, $owner, $comments, $id, $createdAt, $updatedAt);
        $this->title = $title;
        $this->enableComments = $enableComments;
    }

    public function setData(array $data): void
    {
        parent::setData($data);
        $this->title = $data['title'];
    }

    public function addComment(Comment $comment): ?Comment
    {
        if ($this->enableComments) {
            return $this->comments[$comment->getId()] = $comment;
        }

        return null;
    }

    public function enableComments(bool $flag): void
    {
        $this->enableComments = $flag;
    }
}
