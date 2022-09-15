<?php

namespace InSided\GetOnBoard\Entity;

class Post
{
    public $id;
    public $title;
    public $content;
    public $type;
    public $parent;
    public $comments;
    public $deleted;
    public $commentsAllowed = true;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->id =  uniqid();
        $this->comments = [];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param $parent
     */
    public function setParent($parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @param $content
     *
     * @return Comment
     */
    public function addComment($content)
    {
        $comment = new Comment();
        $comment->setContent($content);

        $this->comments[] = $comment;

        return $comment;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @return bool
     */
    public function isCommentsAllowed(): bool
    {
        return $this->commentsAllowed;
    }

    /**
     * @param mixed $commentsAllowed
     */
    public function setCommentsAllowed($commentsAllowed)
    {
        if (!$commentsAllowed) {
            $this->comments = [];
        }

        $this->commentsAllowed = $commentsAllowed;
    }
}