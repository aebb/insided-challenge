<?php

namespace InSided\GetOnBoard\Controller;

use InSided\GetOnBoard\Repository\CommunityRepository;

class ArticleController
{
    /**
     * @param $communityId
     * @return array
     *
     * POST insided.com/community/[user-id]/[community-id]/articles
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
     * POST insided.com/community/[user-id]/[community-id]/articles/[type]
     *
     */
    public function createAction($userId, $communityId, $title, $content)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $post = $community->addPost($title, $content, 'article');

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
     * PUT insided.com/community/[user-id]/[community-id]/articles/[article-id]
     *
     */
    public function updateAction($userId, $communityId, $articleId, $title, $content)
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $articleId) {
                $community = CommunityRepository::getCommunity($communityId);
                $post = $community->updatePost($articleId, $title, $content);
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
     * DELETE insided.com/community/[user-id]/[community-id]/articles/[article-id]
     */
    public function deleteAction($userId, $communityId, $articleId)
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $articleId) {
                $community = CommunityRepository::getCommunity($communityId);
                $community->deletePost($articleId);
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
     * POST insided.com/community/[user-id]/[community-id]/articles/[article-id]
     */
    public function commentAction($userId, $communityId, $articleId, $content)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $comment = $community->addComment($articleId, $content);

        $user = CommunityRepository::getUser($userId);
        $user->addComment($comment);

        return $comment;
    }

    /**
     * @param $communityId
     * @param $articleId
     *
     * PATCH insided.com/community/[community-id]/articles/[article-id]/disableComments
     */
    public function disableCommentsAction($communityId, $articleId)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $community->disableCommentsForArticle($articleId);
    }
}