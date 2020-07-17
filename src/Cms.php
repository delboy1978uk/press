<?php

namespace Del\Press;

use Del\Press\Block\Block;
use Del\Press\Block\BlockDescriptor;
use Del\Press\Block\Header;
use Del\Press\Block\Image;
use Del\Press\Block\Link;
use Del\Press\Block\Paragraph;
use Del\Press\Page\Editor;
use Del\Press\Page\Page;
use Del\Press\Page\PageInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class Cms
{
    const DEFAULT_BLOCK_TYPES = [
        Header::class => 'Header',
        Image::class => 'Image',
        Link::class => 'Link',
        Paragraph::class => 'Paragraph',
    ];

    /** @var EntityManager $em */
    private $em;

    /** @var Editor $editor */
    private $editor;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->editor = new Editor();
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
     * @return array
     */
    public function getBlockTypes(): array
    {
        $packagedBlockTypes = self::DEFAULT_BLOCK_TYPES;
        $customBlockTypes = [];

        return array_merge($packagedBlockTypes, $customBlockTypes);
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

    /**
     * @return Editor
     */
    public function getPageEditor(): Editor
    {
        return $this->editor;
    }
}
