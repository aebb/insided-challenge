<?php

namespace InSided\Solution\Request\Post\Conversation;

use InSided\Solution\Entity\Conversation;
use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\CreatePostAction;
use InSided\Solution\Request\Post\GetPostAction;
use InSided\Solution\Request\Post\UpdatePostAction;

class UpdateConversationAction extends UpdatePostAction
{
    public function getData(): array
    {
       return [
         'content' => $this->content
       ];
    }
}
