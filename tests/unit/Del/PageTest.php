<?php

use Codeception\TestCase\Test;
use Del\Press\Page\Page;
use Del\Press\Page\PageInterface;
use Del\Press\Block\Block;

class PageTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var PageInterface
     */
    protected $page;

    protected function _before()
    {
        $this->page = new Page();
    }

    protected function _after()
    {
        unset($this->page);
    }

    public function testGettersAndSetters()
    {
        $this->page->setTitle('Title');
        $this->page->setSlug('some-url-slug');
        $this->page->setUserId(666);
        $this->page->setPublishedDate(new DateTime('2014-09-18'));
        $this->page->setTags(['awesome', 'features']);
        $this->page->setIsPublished(true);
        $block = new Block();
        $this->page->addBlock($block);

        $this->assertEquals(0, $this->page->getId());
        $this->assertEquals(666, $this->page->getUserId());
        $this->assertEquals('Title', $this->page->getTitle());
        $this->assertEquals('some-url-slug', $this->page->getSlug());
        $this->assertInstanceOf(DateTime::class, $this->page->getPublishedDate());
        $this->assertEquals('2014-09-18', $this->page->getPublishedDate()->format('Y-m-d'));
        $this->assertCount(2, $this->page->getTags());
        $this->assertCount(1, $this->page->getBlocks());
        $this->assertTrue($this->page->isPublished());

        $blocks = $this->page->getBlocks();
        $blocks[] = new Block();
        $this->page->setBlocks($blocks);
        $this->assertCount(2, $this->page->getBlocks());
    }
}
