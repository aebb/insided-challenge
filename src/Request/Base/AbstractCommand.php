<?php

namespace InSided\Solution\Request\Base;

use InSided\Solution\Entity\User;
use InSided\Solution\Utils\AppException;
use InSided\Solution\Utils\Http;

abstract class AbstractCommand
{
    private const ERROR_EMPTY_USER   = 'No user provided';
    private const ERROR_EMPTY_COMMUNITY_ID = 'No community-id provided';

    public function __construct(
        protected  readonly User $user,
        protected  readonly string $communityId,
    ){}

    public function getUser(): User
    {
        return $this->user;
    }

    public function getCommunityId(): string
    {
        return $this->communityId;
    }

    /**
     * @throws AppException
     */
    public function validate(): bool
    {
        return $this->validateUser() && $this->validateCommunityId();
    }

    /**
     * @throws AppException
     */
    private function validateUser(): bool
    {
        if (empty($this->user)) {
            throw new AppException(self::ERROR_EMPTY_USER, HTTP::HTTP_BAD_REQUEST);
        }

        return true;
    }

    /**
     * @throws AppException
     */
    private function validateCommunityId(): bool
    {
        if (empty($this->communityId)) {
            throw new AppException(self::ERROR_EMPTY_COMMUNITY_ID, HTTP::HTTP_BAD_REQUEST);
        }

        return true;
    }
}
