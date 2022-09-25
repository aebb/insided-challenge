<?php

namespace InSided\Solution\Request\Factory;

use InSided\Solution\Request\Comment\CreateCommentCommand;

interface CommentCommandFactoryInterface
{
    public function createCommentAction(mixed $buffer): CreateCommentCommand;
}
