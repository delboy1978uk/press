<?php

namespace Del\Press\Block;

class Header extends AbstractBlock
{
    /** @var string $size */
    private $size;

    /**
     * Header constructor.
     * @param string $content
     * @param int $size
     */
    public function __construct(string $content = '', int $size = 1)
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

    /**
     * @return string
     */
    public function renderEditor(): string
    {
        return '<input type="text" placeholder="Type a header.." class="form-control block-header" />';
    }
}
