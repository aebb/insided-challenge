<?php

namespace InSided\Solution\Controller;

use InSided\Solution\Request\Factory\ConversationCommandFactoryInterface;
use InSided\Solution\Service\ConversationService;
use InSided\Solution\Utils\Controller;
use InSided\Solution\Utils\Http;
use InSided\Solution\Utils\ValidatorInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ConversationController extends Controller
{
    public function __construct(
        ValidatorInterface $validator,
        ResponseFactoryInterface $responseFactory,
        private ConversationService $service,
        private ConversationCommandFactoryInterface $actionFactory,
    ) {
        parent::__construct($validator, $responseFactory);
    }

    /**
     * @Route("/community/{user-id}/{community-id}/conversations", name="list.conversations", methods={"GET"})
     */
    public function listAction(ServerRequestInterface $request): ResponseInterface
    {
        return $this->execute(
            fn() => $this->service->list(
                $this->validator->validate($this->actionFactory->listConversationAction($request))
            )
        );
    }

    /**
     * @Route("/community/{user-id}/{community-id}/conversations/{type}", name="create.conversations", methods={"POST"})
     */
    public function createAction(ServerRequestInterface $request): ResponseInterface
    {
        return $this->execute(
            fn() => $this->service->create(
                $this->validator->validate($this->actionFactory->createConversationAction($request))
            ),
            HTTP::HTTP_CREATED
        );
    }

    /**
     * @Route(
     *     "/community/{user-id}/{community-id}/conversations/{conversation-id}",
     *     name="update.conversation", methods={"PUT"}
     * )
     */
    public function updateAction(ServerRequestInterface $request): ResponseInterface
    {
        return $this->execute(
            fn() => $this->service->update(
                $this->validator->validate($this->actionFactory->updateConversationAction($request))
            )
        );
    }

    /**
     * @Route(
     *     "/community/{user-id}/{community-id}/conversations/{conversation-id}",
     *     name="delete.conversation", methods={"DELETE"}
     * )
     */
    public function deleteAction(ServerRequestInterface $request): ResponseInterface
    {
        return $this->execute(
            fn() => $this->service->delete(
                $this->validator->validate($this->actionFactory->deleteConversationAction($request))
            )
        );
    }
}
