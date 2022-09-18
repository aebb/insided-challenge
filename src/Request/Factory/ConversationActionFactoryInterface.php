<?php

namespace InSided\Solution\Request\Factory;

use InSided\Solution\Request\Post\Conversation\CreateConversationAction;
use InSided\Solution\Request\Post\Conversation\DeleteConversationAction;
use InSided\Solution\Request\Post\Conversation\ListConversationAction;
use InSided\Solution\Request\Post\Conversation\UpdateConversationAction;

interface ConversationActionFactoryInterface
{
    function createConversationAction($buffer): CreateConversationAction;
    function deleteConversationAction($buffer): DeleteConversationAction;
    function listConversationAction($buffer):   ListConversationAction;
    function updateConversationAction($buffer): UpdateConversationAction;
}
