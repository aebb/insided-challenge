<?php

namespace InSided\GetOnBoard\Entity;

class Community
{
    public $id;
    public $name;
    public $posts = [];

    public function __construct()
    {
        $this->id =  uniqid();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param $title
     * @param $content
     * @param $type
     * @param null $parent
     *
     * @return Post|null
     */
    public function addPost($title, $content, $type, $parent = null)
    {
        $post = null;

        if ($type == 'article') {
            $post = new Post();
            $post->setTitle($title);
            $post->setContent($content);
            $post->setType($type);
        }

        if ($type == 'conversation') {
            $post = new Post();
            $post->setContent($content);
            $post->setType($type);

            if ($parent) {
                $post->setParent($parent);
            }
        }

        $this->posts[] = $post;

        return $post;
    }

    /**
     * @param $id
     * @param $title
     * @param $content
     *
     * @return mixed|null
     */
    public function updatePost($id, $title, $content)
    {
        $post = null;
        foreach ($this->posts as $post) {
            if ($post->id == $id) {
                break;
            }
        }

        $post->setTitle($title);
        $post->setContent($content);

        $this->posts[] = $post;

        return $post;
    }

    /**
     * @param $id
     * @param $content
     *
     * @return null
     */
    public function addComment($parentId, $content)
    {
        $post = null;
        foreach ($this->posts as $post) {
            if ($post->id == $parentId) {
                break;
            }
        }


        $comment = $post->addComment($content);

        return $comment;
    }

    /**
     * @param $id
     */
    public function deletePost($id)
    {
        $post = null;
        foreach ($this->posts as $post) {
            if ($post->id == $id) {
                break;
            }
        }

        $post->setDeleted(true);
    }

    /**
     * @return array
     */
    public function getPosts()
    {
        $posts = [];
        foreach ($this->posts as $post){
            if (!$post->getDeleted()) {
                $posts[] = $post;
            }
        }

        return $posts;
    }

    /**
     * @param $articleId
     * return void
     */
    public function disableCommentsForArticle($articleId): void
    {
        $post = null;
        foreach ($this->posts as $post) {
            if ($post->id == $articleId) {
                break;
            }
        }

        $post->setCommentsAllowed(false);
    }
}