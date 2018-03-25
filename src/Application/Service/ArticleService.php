<?php

namespace App\Application\Service;


use App\Domain\Model\Article\Article;
use App\Domain\Model\Article\ArticleRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

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
     * @return Article
     * @throws EntityNotFoundException
     */
    public function getArticle(int $articleId): Article
    {
        $article = $this->articleRepository->findById($articleId);
        if (!$article) {
            throw new EntityNotFoundException('Article with id '.$articleId.' does not exist!');
        }
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
     * @return Article
     * @throws EntityNotFoundException
     */
    public function updateArticle(int $articleId, string $title, string $content): Article
    {
        $article = $this->articleRepository->findById($articleId);
        if (!$article) {
            throw new EntityNotFoundException('Article with id '.$articleId.' does not exist!');
        }

        $article->setTitle($title);
        $article->setContent($content);
        $this->articleRepository->save($article);

        return $article;
    }

    /**
     * @param int $articleId
     * @throws EntityNotFoundException
     */
    public function deleteArticle(int $articleId): void
    {
        $article = $this->articleRepository->findById($articleId);
        if (!$article) {
            throw new EntityNotFoundException('Article with id '.$articleId.' does not exist!');
        }

        $this->articleRepository->delete($article);
    }

}
