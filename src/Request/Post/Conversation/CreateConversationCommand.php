<?php

namespace InSided\Solution\Request\Post\Conversation;

use InSided\Solution\Entity\Conversation;
use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\CreatePostCommand;

class CreateConversationCommand extends CreatePostCommand
{
    use ConversationPostTrait;

    public function getData(): array
    {
        return [
           'owner'   => $this->user,
           'content' => $this->content
        ];
    }
}
