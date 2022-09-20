<?php

namespace InSided\Solution\Request\Post;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Base\PostCommand;
use InSided\Solution\Utils\AppException;
use InSided\Solution\Utils\Http;

abstract class GetPostCommand extends PostCommand
{
    private const ERROR_EMPTY_POST_ID = 'no post id provided';

    public function __construct(User $user, string $communityId, protected readonly string $postId)
    {
        parent::__construct($user, $communityId);
    }

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function validate(): bool
    {
        return parent::validate() && $this->validatePostId();
    }

    /**
     * @throws AppException
     */
    private function validatePostId(): bool
    {
        if (empty($this->postId)) {
            throw new AppException(self::ERROR_EMPTY_POST_ID, HTTP::HTTP_BAD_REQUEST);
        }

        return true;
    }
}
