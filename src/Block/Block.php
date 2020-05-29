<?php

namespace Del\Press\Block;

class Block implements BlockInterface
{
    /**
     * @return string
     */
    public function render(): string
    {
        return '<h1>Hello World</h1>';
    }
}
