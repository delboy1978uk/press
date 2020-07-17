<?php

namespace Del\Press\Block;

class Link extends AbstractBlock
{
    /** @var string $href */
    private $href;

    /**
     * Link constructor.
     * @param string $href
     * @param string $content
     */
    public function __construct(string $href = '#', string $content = '')
    {
        $this->content = $content;
        $this->href = $href;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return '<a href="' . $this->href .'">' . $this->content . '</a>';
    }

    /**
     * @return string
     */
    public function renderEditor(): string
    {
        return '<input class="form-control" type="text" placeholder="Type your URL here" />
                <input class="form-control" type="text" placeholder="Type your display text here.."/>';
    }
}
