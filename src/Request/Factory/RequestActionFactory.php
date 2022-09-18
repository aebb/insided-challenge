<?php

namespace InSided\Solution\Request\Factory;

use InSided\Solution\Request\Comments\CreateCommentAction;
use InSided\Solution\Request\Post\Article\CreateArticleAction;
use InSided\Solution\Request\Post\Article\DeleteArticleAction;
use InSided\Solution\Request\Post\Article\EnableArticleAction;
use InSided\Solution\Request\Post\Article\ListArticleAction;
use InSided\Solution\Request\Post\Article\UpdateArticleAction;
use InSided\Solution\Request\Post\Conversation\CreateConversationAction;
use InSided\Solution\Request\Post\Conversation\DeleteConversationAction;
use InSided\Solution\Request\Post\Conversation\ListConversationAction;
use InSided\Solution\Request\Post\Conversation\UpdateConversationAction;
use Psr\Http\Message\ServerRequestInterface;

class RequestActionFactory implements ArticleActionFactoryInterface, ConversationActionFactoryInterface, CommentActionFactoryInterface
{
    /**
     * @param ServerRequestInterface $buffer
     */
    public function createArticleAction($buffer): CreateArticleAction
    {
        return new CreateArticleAction(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
            $buffer->getParsedBody()['content'],
            $buffer->getParsedBody()['title'],
        );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function deleteArticleAction($buffer): DeleteArticleAction
    {
       return new DeleteArticleAction(
           $buffer->getAttribute('user'),
           $buffer->getAttribute('community-id'),
           $buffer->getAttribute('article-id'),
       );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function enableArticleAction($buffer): EnableArticleAction
    {
       return new EnableArticleAction(
           $buffer->getAttribute('user'),
           $buffer->getAttribute('community-id'),
           $buffer->getAttribute('article-id'),
       );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function listArticleAction($buffer): ListArticleAction
    {
       return new ListArticleAction(
           $buffer->getAttribute('user'),
           $buffer->getAttribute('community-id'),
       );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function updateArticleAction($buffer): UpdateArticleAction
    {
        return new UpdateArticleAction(
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
    public function createConversationAction($buffer): CreateConversationAction
    {
        return new CreateConversationAction(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
            $buffer->getParsedBody()['content'],
        );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function deleteConversationAction($buffer): DeleteConversationAction
    {
        return new DeleteConversationAction(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
            $buffer->getAttribute('conversation-id'),
        );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function listConversationAction($buffer): ListConversationAction
    {
        return new ListConversationAction(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
        );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function updateConversationAction($buffer): UpdateConversationAction
    {
        return new UpdateConversationAction(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
            $buffer->getAttribute('conversation-id'),
            $buffer->getParsedBody()['content'],
        );
    }

    /**
     * @param ServerRequestInterface $buffer
     */
    public function createCommentAction($buffer): CreateCommentAction
    {
        return new CreateCommentAction(
            $buffer->getAttribute('user'),
            $buffer->getAttribute('community-id'),
            $buffer->getAttribute('post-id'),
            $buffer->getParsedBody()['content'],
        );
    }
}
