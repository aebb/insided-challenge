<?php

namespace InSided\Solution\Entity;

class Conversation extends Post
{
    function addComment(Comment $comment): ?Comment
    {
        return $this->comments[$comment->getId()] = $comment;
    }

}
