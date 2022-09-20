<?php

namespace InSided\Solution\Entity;

use DateTime;

class Community extends Model
{
    private ?string $name;

    private ?array $posts;

    public function __construct(
        string $name,
        array $posts = [],
        string $id = null,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    )
    {
        parent::__construct($id, $createdAt, $updatedAt);
        $this->name = $name;
        $this->posts = $posts;
    }

    public function savePost(Post $post): ?Post
    {
        return $this->posts[$post->getId()] = $post;
    }

    public function fetchPost(string $id): ?Post
    {
        return $this->posts[$id] ?? null;
    }

    public function listPosts(string $filter = Post::class): array
    {
        return array_filter($this->posts, fn($post) => get_class($post) === $filter);
    }

    public function removePost(?Post $post): ?Post
    {
        unset($this->posts[$post->getId()]);
        return $post;
    }
}
