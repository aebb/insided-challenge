<?php

namespace InSided\Solution\Request\Post\Conversation;

use InSided\Solution\Entity\Conversation;
use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\CreatePostAction;

class CreateConversationAction extends CreatePostAction
{
    use ConversationPostTrait;

    public function getData(): array
    {
       return [
         'content' => $this->content
       ];
    }
}
