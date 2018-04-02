<?php


namespace App\Application\DTO;


use App\Domain\Model\Article\Article;

/**
 * Class ArticleAssembler
 * @package App\Application\DTO
 */
final class ArticleAssembler
{

    /**
     * @param ArticleDTO $articleDTO
     * @param Article|null $article
     * @return Article
     */
    public function readDTO(ArticleDTO $articleDTO, ?Article $article = null): Article
    {
        if (!$article) {
            $article = new Article();
        }

        $article->setContent($articleDTO->getContent());
        $article->setTitle($articleDTO->getTitle());

        return $article;
    }

    /**
     * @param Article $article
     * @param ArticleDTO $articleDTO
     * @return Article
     */
    public function updateArticle(Article $article, ArticleDTO $articleDTO): Article
    {
        return $this->readDTO($articleDTO, $article);
    }

    /**
     * @param ArticleDTO $articleDTO
     * @return Article
     */
    public function createArticle(ArticleDTO $articleDTO): Article
    {
        return $this->readDTO($articleDTO);
    }

    /**
     * @param Article $article
     * @return ArticleDTO
     */
    public function writeDTO(Article $article)
    {
        return new ArticleDTO(
            $article->getTitle(),
            $article->getContent()
        );
    }

}
