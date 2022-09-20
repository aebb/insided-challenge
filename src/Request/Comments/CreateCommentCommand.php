<?php

namespace InSided\Solution\Request\Comments;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\GetPostCommand;
use InSided\Solution\Utils\AppException;
use InSided\Solution\Utils\Http;

class CreateCommentCommand extends GetPostCommand
{
    private const ERROR_EMPTY_CONTENT = 'no comment content provided';

    public function __construct(User $user, string $communityId, string $postId, private readonly string $content)
    {
        parent::__construct($user, $communityId, $postId);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function validate(): bool
    {
        return parent::validate() && $this->validateContent();
    }

    /**
     * @throws AppException
     */
    private function validateContent(): bool
    {
        if (empty($this->content)) {
            throw new AppException(self::ERROR_EMPTY_CONTENT, HTTP::HTTP_BAD_REQUEST);
        }

        return true;
    }
}
