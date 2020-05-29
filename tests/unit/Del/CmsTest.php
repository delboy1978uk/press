<?php

use Barnacle\Container;
use Bone\BoneDoctrine\BoneDoctrinePackage;
use Codeception\TestCase\Test;
use Del\Press\Block\Header;
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
     * @throws \Doctrine\ORM\ORMException
     */
    public function testCreatePage()
    {
        $this->assertInstanceOf(PageInterface::class, $this->cms->createPage());
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function testRenderPage()
    {
        $page = $this->cms->createPage();
        $block = new Header('Hello World');
        $page->addBlock($block);
        $this->assertEquals('<h1>Hello World</h1>', $this->cms->renderPage($page));
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function testRenderPageUsingSetContent()
    {
        $page = $this->cms->createPage();
        $block = new Header();
        $block->setContent('Hello World');
        $page->addBlock($block);
        $this->assertEquals('<h1>Hello World</h1>', $this->cms->renderPage($page));
    }
}
