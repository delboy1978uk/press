<?php

namespace Del\Press\Page;

use DateTime;
use Del\Press\Block\BlockInterface;
use Doctrine\Common\Collections\Collection;

interface PageInterface
{
    public function addBlock(BlockInterface $block): void;
    public function getBlocks(): Collection;
    public function getId(): int;
    public function getPublishedDate(): DateTime;
    public function getSlug(): string;
    public function getTitle(): string;
    public function getTags(): array;
    public function getUserId(): int;
    public function isPublished(): bool;
    public function setBlocks(Collection $blocks): void;
    public function setSlug(string $slug): void;
    public function setTitle(string $title): void;
    public function setIsPublished(bool $isPublished): void;
    public function setPublishedDate(DateTime $date): void;
    public function setTags(array $tags): void;
    public function setUserId(int $userId): void;
}
