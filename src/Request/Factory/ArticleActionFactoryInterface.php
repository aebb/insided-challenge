<?php

namespace InSided\Solution\Request\Factory;

use InSided\Solution\Request\Post\Article\CreateArticleAction;
use InSided\Solution\Request\Post\Article\DeleteArticleAction;
use InSided\Solution\Request\Post\Article\EnableArticleAction;
use InSided\Solution\Request\Post\Article\ListArticleAction;
use InSided\Solution\Request\Post\Article\UpdateArticleAction;
interface ArticleActionFactoryInterface
{
    function createArticleAction($buffer): CreateArticleAction;
    function deleteArticleAction($buffer): DeleteArticleAction;
    function enableArticleAction($buffer): EnableArticleAction;
    function listArticleAction($buffer):   ListArticleAction;
    function updateArticleAction($buffer): UpdateArticleAction;

}
