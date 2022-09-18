<?php

namespace InSided\Solution\Entity;

abstract class Post extends Message
{
    abstract function addComment(Comment $comment): bool;
}
