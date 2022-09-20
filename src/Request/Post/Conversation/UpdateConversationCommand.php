<?php

namespace InSided\Solution\Request\Post\Conversation;

use InSided\Solution\Entity\Conversation;
use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\CreatePostCommand;
use InSided\Solution\Request\Post\GetPostCommand;
use InSided\Solution\Request\Post\UpdatePostCommand;

class UpdateConversationCommand extends UpdatePostCommand
{
    public function getData(): array
    {
       return [
         'content' => $this->content
       ];
    }
}
