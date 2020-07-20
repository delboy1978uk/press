<?php

namespace Del\Press\Page;

use Del\Press\Block\BlockDescriptor;
use Del\Press\Block\BlockInterface;
use Doctrine\ORM\EntityManager;

class Editor
{
    /** @var EntityManager $entityManager */
    private $entityManager;

    /**
     * Editor constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Page $page
     * @param string $class
     * @return array
     */
    public function addNewBlock(Page $page, string $class): array
    {
        $html = '';
        $class = '\\' . $class;
        $numberOfExistingBlocks = count($page->getBlocks());

        if (class_exists($class)) {
            $block = new $class();

            if ($block instanceof BlockInterface) {
                $html = $this->renderBlockEditorDiv($block);
                $blockDescriptor = new BlockDescriptor();
                $blockDescriptor->setPage($page);
                $blockDescriptor->setClass(\get_class($block));
                $blockDescriptor->setContent($block->getContent());
                $blockDescriptor->setPageOrder($numberOfExistingBlocks + 1);
                $this->entityManager->persist($blockDescriptor);
                $this->entityManager->flush($blockDescriptor);
            }
        }

        return [
            'html' => $html,
        ];
    }

    /**
     * @param BlockInterface $block
     * @return string
     */
    private function renderBlockEditorDiv(BlockInterface $block): string
    {
        $html = '<div class="panel panel-primary page-block">
                  <div class="panel-heading">
                      <button type="button" class="close tt" title="Delete ' . $block->getBlockType() . '" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="panel-title">' . $block->getBlockType() . '</h3>
                  </div>
                  <div class="panel-body">';
        $html .= $block->renderEditor();
        $html .= '</div>
                  </div><br>';

        return $html;
    }
}
