<?php

namespace Del\Press;

use Del\Press\Block\Block;
use Del\Press\Block\BlockDescriptor;
use Del\Press\Page\Page;
use Del\Press\Page\PageInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

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
     * @throws \Doctrine\ORM\ORMException
     */
    public function createPage(): PageInterface
    {
        $page = new Page();
        $this->em->persist($page);
        $this->em->flush($page);

        return $page;
    }

    /**
     * @param string $slugOrId
     * @return PageInterface|null
     */
    public function fetchPage(string $slugOrId): ?PageInterface
    {
        $repo = $this->em->getRepository(Page::class);
        /** @var Page $page */
        $page = is_numeric($slugOrId)
        ? $repo->find($slugOrId)
        : $repo->findOneBy(['slug' => $slugOrId]);

        return $page;
    }

    /**
     * @param PageInterface $page
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updatePage(PageInterface $page): bool
    {
        $this->em->flush($page);

        return true;
    }

    /**
     * @param PageInterface $page
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deletePage(PageInterface $page): void
    {
        $this->em->remove($page);
        $this->em->flush();
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

    /**
     * @return EntityRepository
     */
    public function getPageRepository(): EntityRepository
    {
        return $this->em->getRepository(Page::class);
    }

    /**
     * @return EntityRepository
     */
    public function getBlockRepository(): EntityRepository
    {
        return $this->em->getRepository(BlockDescriptor::class);
    }
}
