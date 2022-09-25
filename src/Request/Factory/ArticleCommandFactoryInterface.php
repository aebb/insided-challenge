<?php

namespace InSided\Solution\Request\Factory;

use InSided\Solution\Request\Post\Article\CreateArticleCommand;
use InSided\Solution\Request\Post\Article\DeleteArticleCommand;
use InSided\Solution\Request\Post\Article\EnableArticleCommand;
use InSided\Solution\Request\Post\Article\ListArticleCommand;
use InSided\Solution\Request\Post\Article\UpdateArticleCommand;

interface ArticleCommandFactoryInterface
{
    public function createArticleAction(mixed $buffer): CreateArticleCommand;
    public function deleteArticleAction(mixed $buffer): DeleteArticleCommand;
    public function enableArticleAction(mixed $buffer): EnableArticleCommand;
    public function listArticleAction(mixed $buffer): ListArticleCommand;
    public function updateArticleAction(mixed $buffer): UpdateArticleCommand;
}
