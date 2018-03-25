<?php

namespace App\Application\Service;


use App\Domain\Model\Article\Article;
use App\Domain\Model\Article\ArticleRepositoryInterface;

/**
 * Class ArticleService
 * @package App\Application\Service
 */
final class ArticleService
{

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * ArticleService constructor.
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository){
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param int $articleId
     * @return Article|null
     */
    public function getArticle(int $articleId): ?Article
    {
        return $this->articleRepository->findById($articleId);
    }

    /**
     * @return array|null
     */
    public function getAllArticles(): ?array
    {
        return $this->articleRepository->findAll();
    }

    /**
     * @param string $title
     * @param string $content
     * @return Article
     */
    public function addArticle(string $title, string $content): Article
    {
        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);
        $this->articleRepository->save($article);

        return $article;
    }

    /**
     * @param int $articleId
     * @param string $title
     * @param string $content
     * @return Article|null
     */
    public function updateArticle(int $articleId, string $title, string $content): ?Article
    {
        $article = $this->articleRepository->findById($articleId);
        if (!$article) {
            return null;
        }
        $article->setTitle($title);
        $article->setContent($content);
        $this->articleRepository->save($article);

        return $article;
    }

    /**
     * @param int $articleId
     */
    public function deleteArticle(int $articleId): void
    {
        $article = $this->articleRepository->findById($articleId);
        if ($article) {
            $this->articleRepository->delete($article);
        }
    }

}
