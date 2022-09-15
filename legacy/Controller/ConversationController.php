<?php

namespace InSided\GetOnBoard\Controller;

use InSided\GetOnBoard\Repository\CommunityRepository;

class ConversationController
{
    /**
     * @param $communityId
     * @return array
     *
     * POST insided.com/community/[user-id]/[community-id]/conversations
     */
    public function listAction($communityId)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $posts = $community->getPosts();

        return $posts;
    }

    /**
     * @param $communityId
     * @param $title
     * @param $content
     *
     * @return \InSided\GetOnBoard\Entity\Post|null
     *
     * POST insided.com/community/[user-id]/[community-id]/conversations/[type]
     *
     */
    public function createAction($userId, $communityId, $title, $content)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $post = $community->addPost($title, $content, 'conversation');

        $user = CommunityRepository::getUser($userId);
        $user->addPost($post);

        return $post;
    }

    /**
     * @param $communityId
     * @param $title
     * @param $content
     *
     * @return mixed
     *
     * PUT insided.com/community/[user-id]/[community-id]/conversations/[conversation-id]
     *
     */
    public function updateAction($userId, $communityId, $conversationId, $title, $content)
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $conversationId) {
                $community = CommunityRepository::getCommunity($communityId);
                $post = $community->updatePost($conversationId, $title, $content);
            }
        }

        return $post;
    }

    /**
     * @param $communityId
     * @param $title
     * @param $text
     *
     * @return null
     *
     * DELETE insided.com/community/[user-id]/[community-id]/conversations/[conversation-id]
     */
    public function deleteAction($userId, $communityId, $conversationId)
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $conversationId) {
                $community = CommunityRepository::getCommunity($communityId);
                $community->deletePost($conversationId);
            }
        }

        return null;
    }

    /**
     * @param $communityId
     * @param $title
     * @param $content
     *
     * @return mixed
     *
     * POST insided.com/community/[user-id]/[community-id]/conversations/[conversation-id]
     */
    public function commentAction($userId, $communityId, $conversationId, $content)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $comment = $community->addComment($conversationId, $content);

        $user = CommunityRepository::getUser($userId);
        $user->addComment($comment);

        return $comment;
    }
}