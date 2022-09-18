<?php

namespace InSided\Solution\Controller;

use InSided\Solution\Request\Factory\ConversationActionFactoryInterface;
use InSided\Solution\Service\ArticleService;
use InSided\Solution\Utils\AbstractController;
use InSided\Solution\Validator\ValidatorInterface;
use JsonSerializable;
use Psr\Http\Message\ServerRequestInterface;

class ArticleController extends AbstractController
{
    public function __construct(
        private ArticleService $articleService,
        private ValidatorInterface $validator
        private ConversationActionFactoryInterface $actionFactory,
    ){}

//    /**
//     * @Route("/community/{user-id}/{community-id}/articles", name="list.articles", methods={"GET"})
//     */
//    public function listAction(ServerRequestInterface $request): JsonSerializable
//    {
//        $this->articleService->list($this->validator->validate(new ListAction($request)));
//    }
//
//    /**
//     * @Route("/community/{user-id}/{community-id}/articles", name="create.article", methods={"POST"})
//     */
//    public function createAction(Request $request): JsonSerializable
//    {
//        $this->articleService->create$this->validator->validate(new CreateAction($request)));
//    }
//
//    /**
//     * @Route("/community/{user-id}/{community-id}/articles/{article-id}", name="update.article", methods={"PUT"})
//     */
//    public function updateAction(Request $request): JsonSerializable
//    {
//        $this->articleService->update($this->validator->validate(new UpdateAction($request)));
//    }
//
//    /**
//     * @Route("/community/{user-id}/{community-id}/articles/{article-id}", name="delete.article", methods={"PUT"})
//     */
//    public function deleteAction(Request $request): JsonSerializable
//    {
//        $this->articleService->delete($this->validator->validate(new DeleteAction($request)));
//    }
//
//
//    /**
//     *  @Route("/community/{user-id}/{community-id}/articles/{article-id}", name="disable.article.comments", methods={"PATCH"})
//     */
//    public function disableCommentsAction(Request $request): JsonSerializable
//    {
////        $this->articleService->disableComments(
////            $this->validator->validate($this->actionFactory->createDisableCommentAction($request))
////        );
////        $this->articleService->disableComments($this->validator->validate(new DisableCommentAction($request)));
//    }
}
