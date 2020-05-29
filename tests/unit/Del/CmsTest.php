<?php


use Del\Press\Cms;

class CmsTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Cms
     */
    protected $cms;

    protected function _before()
    {
        // create a fresh blank class before each test
        $this->cms = new Cms();
    }

    protected function _after()
    {
        // unset the blank class after each test
        unset($this->cms);
    }

    /**
     * Check tests are working
     */
    public function testBlah()
    {
        $this->assertEquals('Ready to start building tests', $this->cms->blah());
    }
}
