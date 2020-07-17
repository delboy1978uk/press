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
    public function __construct(string $src = '')
    {
        $this->src = $src;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return '<img src="' . $this->src .'" />';
    }


    /**
     * @return string
     */
    public function renderEditor(): string
    {
        return '<input class="form-control" type="file" />';
    }
}
