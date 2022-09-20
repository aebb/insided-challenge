<?php

namespace InSided\Solution\Request\Factory;

use InSided\Solution\Request\Post\Conversation\CreateConversationCommand;
use InSided\Solution\Request\Post\Conversation\DeleteConversationCommand;
use InSided\Solution\Request\Post\Conversation\ListConversationCommand;
use InSided\Solution\Request\Post\Conversation\UpdateConversationCommand;

interface ConversationCommandFactoryInterface
{
    function createConversationAction(mixed $buffer): CreateConversationCommand;
    function deleteConversationAction(mixed $buffer): DeleteConversationCommand;
    function listConversationAction(mixed $buffer):   ListConversationCommand;
    function updateConversationAction(mixed $buffer): UpdateConversationCommand;
}
