<?php

namespace InSided\Solution\Request\Post\Article;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\CreatePostCommand;
use InSided\Solution\Utils\AppException;
use InSided\Solution\Utils\Http;

class CreateArticleCommand extends CreatePostCommand
{
    use ArticlePostTrait;

    private const ERROR_EMPTY_TITLE = 'no title provided';

    public function __construct(
        User $user,
        string $communityId,
        string $content,
        private readonly string $title
    ) {
        parent::__construct($user, $communityId, $content);
    }

    public function getData(): array
    {
        return [
         'owner'   => $this->user,
         'content' => $this->content,
         'title'   => $this->title,
        ];
    }

    public function validate(): bool
    {
        return parent::validate() && $this->validateTitle();
    }

    /**
     * @throws AppException
     */
    private function validateTitle(): bool
    {
        if (empty($this->title)) {
            throw new AppException(self::ERROR_EMPTY_TITLE, HTTP::HTTP_BAD_REQUEST);
        }

        return true;
    }
}
