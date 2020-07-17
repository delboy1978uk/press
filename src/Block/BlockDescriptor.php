<?php

namespace Del\Press\Block;

use Del\Press\Page\Page;
use Del\Press\Page\PageInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BlockDescriptor
 * @package Del\Press\Block
 * @ORM\Entity
 */
class BlockDescriptor
{
    /**
     * @var int $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @return string
     */
    private $id = 0;

    /**
     * @var Page $page
     * @ORM\ManyToOne(targetEntity="\Del\Press\Page\Page")
     * @ORM\JoinColumn(name="page", referencedColumnName="id")
     */
    private $page;

    /**
     * @var int $pageOrder
     * @ORM\Column(type="integer", length=3)
     */
    private $pageOrder;

    /**
     * @var string $class
     * @ORM\Column(type="string", length=100)
     */
    private $class;

    /**
     * @var string $content
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Page
     */
    public function getPage(): Page
    {
        return $this->page;
    }

    /**
     * @param Page $page
     */
    public function setPage(Page $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPageOrder(): int
    {
        return $this->pageOrder;
    }

    /**
     * @param int $pageOrder
     */
    public function setPageOrder(int $pageOrder): void
    {
        $this->pageOrder = $pageOrder;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public static function createFromBlock(BlockInterface $block, PageInterface $page): BlockDescriptor
    {
        $descriptor = new BlockDescriptor();
        $descriptor->setClass(get_class($block));
        $descriptor->setContent($block->getContent());
        $descriptor->setPage($page);

        return $descriptor;
    }
}
