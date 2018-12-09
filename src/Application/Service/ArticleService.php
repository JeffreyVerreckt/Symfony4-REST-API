<?php

namespace App\Application\Service;


use App\Application\DTO\ArticleAssembler;
use App\Application\DTO\ArticleDTO;
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
     * @var ArticleAssembler
     */
    private $articleAssembler;

    /**
     * ArticleService constructor.
     * @param ArticleRepositoryInterface $articleRepository
     * @param ArticleAssembler $articleAssembler
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        ArticleAssembler $articleAssembler
    ) {
        $this->articleRepository = $articleRepository;
        $this->articleAssembler = $articleAssembler;
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
        return $article;
    }

    /**
     * @return array|null
     */
    public function getAllArticles(): ?array
    {
        return $this->articleRepository->findAll();
    }

    /**
     * @param ArticleDTO $articleDTO
     * @return Article
     */
    public function addArticle(ArticleDTO $articleDTO): Article
    {
        $article = $this->articleAssembler->createArticle($articleDTO);
        $this->articleRepository->save($article);

        return $article;
    }

    /**
     * @param int $articleId
     * @param ArticleDTO $articleDTO
     * @return Article
     * @throws EntityNotFoundException
     */
    public function updateArticle(int $articleId, ArticleDTO $articleDTO): Article
    {
        $article = $this->articleRepository->findById($articleId);
        if (!$article) {
            throw new EntityNotFoundException('Article with id '.$articleId.' does not exist!');
        }
        $article = $this->articleAssembler->updateArticle($article, $articleDTO);
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
