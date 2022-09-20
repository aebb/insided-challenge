<?php

namespace InSided\Solution\Request\Factory;

use InSided\Solution\Request\Post\Article\CreateArticleCommand;
use InSided\Solution\Request\Post\Article\DeleteArticleCommand;
use InSided\Solution\Request\Post\Article\EnableArticleCommand;
use InSided\Solution\Request\Post\Article\ListArticleCommand;
use InSided\Solution\Request\Post\Article\UpdateArticleCommand;
interface ArticleCommandFactoryInterface
{
    function createArticleAction(mixed $buffer): CreateArticleCommand;
    function deleteArticleAction(mixed $buffer): DeleteArticleCommand;
    function enableArticleAction(mixed $buffer): EnableArticleCommand;
    function listArticleAction(mixed $buffer):   ListArticleCommand;
    function updateArticleAction(mixed $buffer): UpdateArticleCommand;

}
