<?php

namespace Del\Press\Block;

abstract class AbstractBlock implements BlockInterface
{
    /** @var string $content */
    protected $content;

    public function __construct(string $content = '')
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}