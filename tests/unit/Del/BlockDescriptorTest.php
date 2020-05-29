<?php

use Codeception\TestCase\Test;
use Del\Press\Block\BlockDescriptor;
use Del\Press\Page\PageInterface;

class BlockDescriptorTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var BlockDescriptor
     */
    protected $blockDescriptor;

    protected function _before()
    {
        $this->blockDescriptor = new BlockDescriptor();
    }

    protected function _after()
    {
        unset($this->blockDescriptor);
    }

    public function testGettersAndSetters()
    {
        $page = new Del\Press\Page\Page();
        $this->blockDescriptor->setContent('OMG content');
        $this->blockDescriptor->setPage()

        $this->assertEquals(0, $this->blockDescriptor->getId());
        
    }
}
