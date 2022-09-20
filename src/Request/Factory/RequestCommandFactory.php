<?php

namespace InSided\Solution\Request\Factory;

use InSided\Solution\Request\Comments\CreateCommentCommand;
use InSided\Solution\Request\Post\Article\CreateArticleCommand;
use InSided\Solution\Request\Post\Article\DeleteArticleCommand;
use InSided\Solution\Request\Post\Article\EnableArticleCommand;
use InSided\Solution\Request\Post\Article\ListArticleCommand;
use InSided\Solution\Request\Post\Article\UpdateArticleCommand;
use InSided\Solution\Request\Post\Conversation\CreateConversationCommand;
use InSided\Solution\Request\Post\Conversation\DeleteConversationCommand;
use InSided\Solution\Request\Post\Conversation\ListConversationCommand;
use InSided\Solution\Request\Post\Conversation\UpdateConversationCommand;
use Psr\Http\Message\ServerRequestInterface;

class RequestCommandFactory implements ArticleCommandFactoryInterface, ConversationCommandFactoryInterface, CommentCommandFactoryInterface
{
    /**
     * @param ServerRequestInterface $buffer
     */
    public function createArticleAction($buffer): CreateArticleCommand
    {
        return new CreateArticleCommand(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
            $buffer->getParsedBody()['content'],
            $buffer->getParsedBody()['title'],
        );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function deleteArticleAction($buffer): DeleteArticleCommand
    {
       return new DeleteArticleCommand(
           $buffer->getAttribute('user'),
           $buffer->getAttribute('community-id'),
           $buffer->getAttribute('article-id'),
       );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function enableArticleAction($buffer): EnableArticleCommand
    {
       return new EnableArticleCommand(
           $buffer->getAttribute('user'),
           $buffer->getAttribute('community-id'),
           $buffer->getAttribute('article-id'),
       );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function listArticleAction($buffer): ListArticleCommand
    {
       return new ListArticleCommand(
           $buffer->getAttribute('user'),
           $buffer->getAttribute('community-id'),
       );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function updateArticleAction($buffer): UpdateArticleCommand
    {
        return new UpdateArticleCommand(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
            $buffer->getAttribute('article-id'),
            $buffer->getParsedBody()['content'],
            $buffer->getParsedBody()['title'],
        );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function createConversationAction($buffer): CreateConversationCommand
    {
        return new CreateConversationCommand(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
            $buffer->getParsedBody()['content'],
        );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function deleteConversationAction($buffer): DeleteConversationCommand
    {
        return new DeleteConversationCommand(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
            $buffer->getAttribute('conversation-id'),
        );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function listConversationAction($buffer): ListConversationCommand
    {
        return new ListConversationCommand(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
        );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function updateConversationAction($buffer): UpdateConversationCommand
    {
        return new UpdateConversationCommand(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
            $buffer->getAttribute('conversation-id'),
            $buffer->getParsedBody()['content'],
        );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function createCommentAction($buffer): CreateCommentCommand
    {
        return new CreateCommentCommand(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
            $buffer->getAttribute('post-id'),
            $buffer->getParsedBody()['content'],
        );
    }
}
