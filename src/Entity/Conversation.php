<?php

namespace InSided\Solution\Entity;

class Conversation extends Post
{
    public function addComment(Comment $comment): ?Comment
    {
        return $this->comments[$comment->getId()] = $comment;
    }
}
