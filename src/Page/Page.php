<?php

namespace Del\Press\Page;

use DateTime;
use Del\Press\Block\BlockInterface;

class Page implements PageInterface
{
    /**
     * @var int $id
     */
    private $id = 0;

    /**
     * @var int $id
     */
    private $userId = 0;

    /**
     * @var bool $isPublished
     */
    private $isPublished = false;

    /**
     * @var DateTime $publishedDate
     */
    private $publishedDate;

    /**
     * @var string $slug
     */
    private $slug = '';

    /**
     * @var string $title
     */
    private $title = '';

    /**
     * @var array $tags
     */
    private $tags = [];

    /**
     * @var array $blocks
     */
    private $blocks = [];

    /**
     * Page constructor.
     */
    public function __construct()
    {
        $this->publishedDate = new DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addBlock(BlockInterface $block): void
    {
       $this->blocks[] = $block;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    /**
     * @param bool $isPublished
     */
    public function setIsPublished(bool $isPublished): void
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return DateTime
     */
    public function getPublishedDate(): DateTime
    {
        return $this->publishedDate;
    }

    /**
     * @param DateTime $publishedDate
     */
    public function setPublishedDate(DateTime $publishedDate): void
    {
        $this->publishedDate = $publishedDate;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return array
     */
    public function getBlocks(): array
    {
        return $this->blocks;
    }

    /**
     * @param array $blocks
     */
    public function setBlocks(array $blocks): void
    {
        $this->blocks = $blocks;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
}
