<?php

namespace InSided\Solution\Controller;

use InSided\Solution\Request\Factory\ConversationActionFactoryInterface;
use InSided\Solution\Service\PostService;
use InSided\Solution\Utils\AbstractController;
use InSided\Solution\Validator\ValidatorInterface;
use JsonSerializable;
use Psr\Http\Message\ServerRequestInterface;

class PostController extends AbstractController
{
    public function __construct(
        private PostService                        $postService,
        private ValidatorInterface                 $validator,
        private ConversationActionFactoryInterface $actionFactory,
    ){

    }

    /**
     * @Route("/community/{user-id}/{community-id}/articles/{post-id}", name="add.comment.article", methods={"PUT"})
     * @Route("/community/{user-id}/{community-id}/conversations/{post-id}", name="add.comment.conversation", methods={"PUT"})
     */
    public function createAction(ServerRequestInterface $request): JsonSerializable
    {
        $this->postService->createComment($this->validator->validate(new CreateRequest($request)));
    }
}
