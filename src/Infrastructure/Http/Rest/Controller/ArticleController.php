<?php

namespace App\Infrastructure\Http\Rest\Controller;


use App\Domain\Model\Article\Article;
use App\Domain\Model\Article\ArticleRepositoryInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArticleController
 * @package App\Infrastructure\Http\Rest\Controller
 */
final class ArticleController extends FOSRestController
{
    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * ArticleController constructor.
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Creates an Article resource
     * @Rest\Post("/articles")
     * @param Request $request
     * @return View
     */
    public function postArticle(Request $request): View
    {
        $article = new Article();
        $article->setTitle($request->get('title'));
        $article->setContent($request->get('content'));
        $this->articleRepository->save($article);

        // Todo: 400 response - Invalid Input
        // Todo: 404 response - Resource not found

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($article, Response::HTTP_CREATED);
    }

    /**
     * Retrieves an Article resource
     * @Rest\Get("/articles/{articleId}")
     */
    public function getArticle(int $articleId): View
    {
        $article = $this->articleRepository->findById($articleId);

        // Todo: 404 response - Resource not found

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($article, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Article resource
     * @Rest\Get("/articles")
     */
    public function getArticles(): View
    {
        $articles = $this->articleRepository->findAll();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of article object
        return View::create($articles, Response::HTTP_OK);
    }

    /**
     * Replaces Article resource
     * @Rest\Put("/articles/{articleId}")
     * @param int $articleId
     * @param Request $request
     * @return View
     */
    public function putArticle(int $articleId, Request $request): View
    {
        $article = $this->articleRepository->findById($articleId);
        if ($article) {
            $article->setTitle($request->get('title'));
            $article->setContent($request->get('content'));
            $this->articleRepository->save($article);
        }

        // Todo: 400 response - Invalid Input
        // Todo: 404 response - Resource not found

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($article, Response::HTTP_OK);
    }

    /**
     * Removes the Article resource
     * @Rest\Delete("/articles/{articleId}")
     * @param int $articleId
     * @return View
     */
    public function deleteArticle(int $articleId): View
    {
        $article = $this->articleRepository->findById($articleId);
        if ($article) {
            $this->articleRepository->delete($article);
        }

        // Todo: 404 response - Resource not found

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
