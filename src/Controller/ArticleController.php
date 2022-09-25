<?php

namespace InSided\Solution\Controller;

use InSided\Solution\Request\Factory\ArticleCommandFactoryInterface;
use InSided\Solution\Service\ArticleService;
use InSided\Solution\Utils\Controller;
use InSided\Solution\Utils\Http;
use InSided\Solution\Utils\ValidatorInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ArticleController extends Controller
{
    public function __construct(
        ValidatorInterface $validator,
        ResponseFactoryInterface $responseFactory,
        private ArticleService $service,
        private ArticleCommandFactoryInterface $actionFactory,
    ) {
        parent::__construct($validator, $responseFactory);
    }

    /**
     * @Route("/community/{user-id}/{community-id}/articles", name="list.articles", methods={"GET"})
     */
    public function listAction(ServerRequestInterface $request): ResponseInterface
    {
        return $this->execute(
            fn() => $this->service->list(
                $this->validator->validate($this->actionFactory->listArticleAction($request))
            )
        );
    }

    /**
     * @Route("/community/{user-id}/{community-id}/articles/{type}", name="create.article", methods={"POST"})
     */
    public function createAction(ServerRequestInterface $request): ResponseInterface
    {
        return $this->execute(
            fn() => $this->service->create(
                $this->validator->validate($this->actionFactory->createArticleAction($request))
            ),
            HTTP::HTTP_CREATED
        );
    }

    /**
     * @Route("/community/{user-id}/{community-id}/articles/{article-id}", name="update.article", methods={"PUT"})
     */
    public function updateAction(ServerRequestInterface $request): ResponseInterface
    {
        return $this->execute(
            fn() => $this->service->update(
                $this->validator->validate($this->actionFactory->updateArticleAction($request))
            )
        );
    }

    /**
     * @Route("/community/{user-id}/{community-id}/articles/{article-id}", name="delete.article", methods={"DELETE"})
     */
    public function deleteAction(ServerRequestInterface $request): ResponseInterface
    {
        return $this->execute(
            fn() => $this->service->delete(
                $this->validator->validate($this->actionFactory->deleteArticleAction($request))
            )
        );
    }


    /**
     * @Route(
     *     "/community/{user-id}/{community-id}/articles/{article-id}/disableComments",
     *      name="enable.article", methods={"PATCH"}
     * )
     */
    public function enableCommentsAction(ServerRequestInterface $request): ResponseInterface
    {
        return $this->execute(
            fn() => $this->service->enableComments(
                $this->validator->validate($this->actionFactory->enableArticleAction($request))
            )
        );
    }
}
