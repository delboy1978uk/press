<?php

namespace Del\Press\Block;

class Image extends AbstractBlock
{
    /** @var string $src */
    private $src;

    /**
     * Link constructor.
     * @param string $src
     */
    public function __construct(string $src)
    {
        $this->src = $href;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return '<img src="' . $this->src .'" />';
    }
}
