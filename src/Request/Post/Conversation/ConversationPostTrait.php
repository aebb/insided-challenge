<?php

namespace InSided\Solution\Request\Post\Conversation;

use InSided\Solution\Entity\Conversation;
use InSided\Solution\Request\Base\PostTypeTrait;

trait ConversationPostTrait
{
    use PostTypeTrait;

    public function getType(): string
    {
        return Conversation::class;
    }
}
