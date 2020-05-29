<?php

use Barnacle\Container;
use Bone\BoneDoctrine\BoneDoctrinePackage;
use Codeception\TestCase\Test;
use Del\Press\Cms;
use Del\Press\Page\PageInterface;
use Del\Press\Block\Block;
use Doctrine\ORM\EntityManager;

class CmsTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Cms
     */
    protected $cms;

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    protected function _before()
    {
        $c = new Container([
            'db' => [
                'driver' => 'pdo_mysql',
                'host' => 'mariadb',
                'database' => 'awesome',
                'dbname' => 'awesome',
                'user' => 'dbuser',
                'pass' => '[123456]',
                'password' => '[123456]',
            ],
            'entity_paths' => ['src/'],
            'proxy_dir' => 'tests/_data/tmp',
        ]);
        $package = new BoneDoctrinePackage();
        $package->addToContainer($c);
        $em = $c->get(EntityManager::class);
        $this->cms = new Cms($em);
    }

    protected function _after()
    {
        // unset the blank class after each test
        unset($this->cms);
    }

    /**
     * Check tests are working
     */
    public function testCreatePage()
    {
        $this->assertInstanceOf(PageInterface::class, $this->cms->createPage());
    }

    /**
     * Check tests are working
     */
    public function testRenderPage()
    {
        $page = $this->cms->createPage();
        $block = new Block();
        $page->addBlock($block);
        $this->assertEquals('<h1>Hello World</h1>', $this->cms->renderPage($page));
    }
}
