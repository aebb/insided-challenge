<?php

namespace InSided\Solution\Request\Factory;

use InSided\Solution\Request\Comments\CreateCommentAction;

interface CommentActionFactoryInterface
{
    function createCommentAction($buffer): CreateCommentAction;
}
