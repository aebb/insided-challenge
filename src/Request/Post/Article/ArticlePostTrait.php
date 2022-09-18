<?php

namespace InSided\Solution\Request\Post\Article;

use InSided\Solution\Entity\Article;
use InSided\Solution\Request\Base\PostTypeTrait;

trait ArticlePostTrait
{
    use PostTypeTrait{
        PostTypeTrait::getType as parentGetType();
    }

    public function getType(): string
    {
        return Article::class;
    }
}
