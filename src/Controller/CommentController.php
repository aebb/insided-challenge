<?php

namespace InSided\Solution\Controller;

use InSided\Solution\Request\Factory\CommentCommandFactoryInterface;
use InSided\Solution\Service\CommentService;
use InSided\Solution\Utils\Controller;
use InSided\Solution\Utils\Http;
use InSided\Solution\Utils\ValidatorInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CommentController extends Controller
{
    public function __construct(
        ValidatorInterface $validator,
        ResponseFactoryInterface $responseFactory,
        private CommentService $service,
        private CommentCommandFactoryInterface $actionFactory,
    ) {
        parent::__construct($validator, $responseFactory);
    }

    /**
     * @Route("/community/{user-id}/{community-id}/articles/{Comment-id}", name="add.comment.article", methods={"POST"})
     * @Route(
     *     "/community/{user-id}/{community-id}/conversations/{Comment-id}",
     *     name="add.comment.conversation", methods={"POST"}
     * )
     */
    public function createAction(ServerRequestInterface $request): ResponseInterface
    {
        return $this->execute(
            fn() => $this->service->createComment(
                $this->validator->validate($this->actionFactory->createCommentAction($request))
            ),
            Http::HTTP_CREATED
        );
    }
}
