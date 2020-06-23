<?php

namespace Del\Press\Page;

use DateTime;
use Del\Press\Block\BlockInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Page implements PageInterface
{
    /**
     * @var int $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id = 0;

    /**
     * @var int $id
     * @ORM\Column(type="integer",length=6, nullable=true)
     */
    private $userId = 0;

    /**
     * @var bool $isPublished
     * @ORM\Column(type="boolean")
     */
    private $isPublished = false;

    /**
     * @var DateTime $publishedDate
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $publishedDate;

    /**
     * @var string $slug
     * @ORM\Column(type="string",length=100,nullable=true)
     */
    private $slug = '';

    /**
     * @var string $title
     * @ORM\Column(type="string",length=100,nullable=true)
     */
    private $title = '';

    /**
     * @var array $tags
     */
    private $tags = [];

    /**
     * @var Collection $blocks
     * @ORM\OneToMany(targetEntity="Del\Press\Block\BlockDescriptor", mappedBy="page")
     */
    private $blocks;

    /**
     * Page constructor.
     */
    public function __construct()
    {
        $this->publishedDate = new DateTime();
        $this->blocks = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getBlocks(): Collection
    {
        return $this->blocks;
    }

    /**
     * @param Collection $blocks
     */
    public function setBlocks(Collection $blocks): void
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
