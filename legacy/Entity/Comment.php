<?php

namespace InSided\GetOnBoard\Entity;

class Comment
{
    public $id;
    public $content;

    public function __construct()
    {
        $this->id =  uniqid();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}