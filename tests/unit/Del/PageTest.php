<?php

use Codeception\TestCase\Test;
use Del\Press\Block\Header;
use Del\Press\Block\Paragraph;
use Del\Press\Page\Page;
use Del\Press\Page\PageInterface;

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
        $block = new Header();
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
        $blocks[] = new Header('Wow');
        $blocks[] = new Paragraph('This is freaking awesome');
        $this->page->setBlocks($blocks);
        $this->assertCount(3, $this->page->getBlocks());
    }
}
