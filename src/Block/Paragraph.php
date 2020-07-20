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

    /**
     * @return string
     */
    public function renderEditor(): string
    {
        return '<textarea class="form-control" placeholder="Type your paragraph here..">' . $this->content . '</textarea>';
    }
}
