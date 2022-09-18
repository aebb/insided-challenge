<?php

namespace InSided\Solution\Entity;

use DateTime;

class Article extends Post
{
    private string $title;

    private bool $enableComments;

    public function addComment(Comment $comment): bool
    {
        if($this->enableComments) {
            return true; //add later;
        }

        return false;
    }

}
