<?php

namespace App\Application\DTO;

/**
 * Class ArticleDTO
 * @package App\Application\DTO
 */
final class ArticleDTO
{

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * ArticleDTO constructor.
     * @param string $title
     * @param string $content
     */
    public function __construct(string $title = '', string $content = '')
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

}
