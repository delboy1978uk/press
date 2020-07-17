<?php

namespace Del\Press\Page;

use Del\Press\Block\BlockInterface;

class Editor
{
    /**
     * @return array
     */
    public function addNewBlock(Page $page, string $class): array
    {
        $html = '';
        $class = '\\' . $class;

        if (class_exists($class)) {
            $block = new $class();

            if ($block instanceof BlockInterface) {
                $html = $block->renderEditor();
            }
        }

        return [
            'html' => $html,
        ];
    }
}
