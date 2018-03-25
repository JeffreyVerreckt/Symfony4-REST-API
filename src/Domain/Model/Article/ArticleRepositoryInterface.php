<?php

namespace App\Domain\Model\Article;

/**
 * Interface ArticleRepositoryInterface
 * @package App\Domain\Model\Article
 */
interface ArticleRepositoryInterface
{

    /**
     * @param int $articleId
     * @return Article
     */
    public function findById(int $articleId): ?Article;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Article $article
     */
    public function save(Article $article): void;

    /**
     * @param Article $article
     */
    public function delete(Article $article): void;

}
