<?php

namespace Del\Press;

use Del\Press\Block\Block;
use Del\Press\Page\Page;
use Del\Press\Page\PageInterface;
use Doctrine\ORM\EntityManager;

class Cms
{
    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return PageInterface
     */
    public function createPage(): PageInterface
    {
        return new Page();
    }

    /**
     * @param string $slugOrId
     * @return PageInterface|null
     */
    public function fetchPage(string $slugOrId): ?PageInterface
    {
        return null;
    }

    /**
     * @param PageInterface $page
     * @return bool
     */
    public function upatePage(PageInterface $page): bool
    {
        return false;
    }

    public function deletePage(PageInterface $page): void
    {

    }

    /**
     * @return string
     */
    public function renderPage(PageInterface $page): string
    {
        $html = '';
        $blocks = $page->getBlocks();

        /** @var Block $block */
        foreach ($blocks as $block) {
            $html .= $block->render();
        }

        return $html;
    }
}
