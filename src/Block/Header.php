<?php

namespace Del\Press\Block;

class Header extends AbstractBlock
{
    /** @var string $size */
    private $size;

    public function __construct($content = '', $size = 1)
    {
        $this->content = $content;
        $this->size = ($size > 0 && $size < 7) ? $size : 1;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return '<h' . $this->size .'>' . $this->content . '</h' . $this->size .'>';
    }
}
