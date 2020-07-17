<?php

namespace Del\Press\Block;

interface BlockInterface
{
    public function getContent(): string;
    public function render(): string;
    public function renderEditor(): string;
    public function setContent(string $content): void;
    public function getBlockType(): string;
}
