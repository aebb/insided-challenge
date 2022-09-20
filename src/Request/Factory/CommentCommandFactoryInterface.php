<?php

namespace InSided\Solution\Request\Factory;

use InSided\Solution\Request\Comments\CreateCommentCommand;

interface CommentCommandFactoryInterface
{
    function createCommentAction(mixed $buffer): CreateCommentCommand;
}
