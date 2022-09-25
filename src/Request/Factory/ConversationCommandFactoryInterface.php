<?php

namespace InSided\Solution\Request\Factory;

use InSided\Solution\Request\Post\Conversation\CreateConversationCommand;
use InSided\Solution\Request\Post\Conversation\DeleteConversationCommand;
use InSided\Solution\Request\Post\Conversation\ListConversationCommand;
use InSided\Solution\Request\Post\Conversation\UpdateConversationCommand;

interface ConversationCommandFactoryInterface
{
    public function createConversationAction(mixed $buffer): CreateConversationCommand;
    public function deleteConversationAction(mixed $buffer): DeleteConversationCommand;
    public function listConversationAction(mixed $buffer): ListConversationCommand;
    public function updateConversationAction(mixed $buffer): UpdateConversationCommand;
}
