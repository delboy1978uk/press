<?php

namespace Del\Press\Block;

class Paragraph extends AbstractBlock
{
    /**
     * @return string
     */
    public function render(): string
    {
        return '<p>' . $this->content . '</p>';
    }
}
