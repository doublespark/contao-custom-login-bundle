<?php

declare(strict_types=1);

namespace Doublespark\ContaoCustomLoginBundle\Tests\Helpers;

use Doublespark\ContaoCustomLoginBundle\Helper\TemplateLoader;

class TemplateLoaderTest extends \PHPUnit\Framework\TestCase {

    public function testInstantiates()
    {
        $templateLoader = new TemplateLoader('be_default');
        $this->assertInstanceOf(TemplateLoader::class, $templateLoader);
    }

    public function testFallsBackToDefault()
    {
        $templateLoader = new TemplateLoader('be_default');
        $this->assertEquals('be_default', $templateLoader->getTemplate('4.9', '1'));
    }

    public function testSetsDefault()
    {
        $templateLoader = new TemplateLoader('be_default');
        $templateLoader->setDefaultTemplate('new_default');
        $this->assertEquals('new_default', $templateLoader->getTemplate('4.9', '1'));
    }

    public function testFetchesTemplates()
    {
        $templateLoader = new TemplateLoader('be_default');

        $templateLoader->addTemplate('4.7','*', 'be_login47');
        $templateLoader->addTemplate('4.9','*', 'be_login49');
        $templateLoader->addTemplate('4.9','2', 'be_login492');

        $this->assertEquals('be_login49', $templateLoader->getTemplate('4.9', '1'));
        $this->assertEquals('be_login492', $templateLoader->getTemplate('4.9', '2'));
        $this->assertEquals('be_login47', $templateLoader->getTemplate('4.7', '5'));
    }

}