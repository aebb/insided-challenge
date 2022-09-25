<?php

namespace InSided\Solution\Request\Post;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Base\PostCommand;
use InSided\Solution\Request\Base\PostTypeTrait;
use InSided\Solution\Utils\AppException;
use InSided\Solution\Utils\Http;

abstract class CreatePostCommand extends PostCommand
{
    use PostTypeTrait;

    private const ERROR_EMPTY_CONTENT = 'no post content provided';

    public function __construct(
        User $user,
        string $communityId,
        protected readonly string $content
    ) {
        parent::__construct($user, $communityId);
    }

    abstract public function getData(): array;

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
