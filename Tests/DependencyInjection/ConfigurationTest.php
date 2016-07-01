<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\LayoutBundle\Tests\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use ASF\LayoutBundle\DependencyInjection\Configuration;

/**
 * This test case check if the default bundle's configuration from bundle's Configuration class is OK.
 *  
 * @author Nicolas Claverie <info@artscore-studio.fr
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $defaultConfig;

    /**
     * {@inheritdoc}
     *
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $processor = new Processor();
        $this->defaultConfig = $processor->processConfiguration(new Configuration(), array());
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testEnableFlashMessagesSupportParameterInDefaultConfiguration()
    {
        $this->assertTrue($this->defaultConfig['enable_flash_messages']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testSupportedAssetsParameterInDefaultConfiguration()
    {
        $this->assertArrayHasKey('assets', $this->defaultConfig);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testJqueryParameterInDefaultConfiguration()
    {
        $this->assertArrayHasKey('jquery', $this->defaultConfig['assets']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testJqueryPathParameterInDefaultConfiguration()
    {
        $this->assertArrayHasKey('path', $this->defaultConfig['assets']['jquery']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testJqueryPathParameterValueInDefaultConfiguration()
    {
        $this->assertRegExp('/\/jquery/', $this->defaultConfig['assets']['jquery']['path']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testJqueryUIParameterInDefaultConfiguration()
    {
        $this->assertArrayNotHasKey('jqueryui', $this->defaultConfig['assets']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsDirParameterInDefaultConfiguration()
    {
        $this->assertArrayHasKey('twbs_dir', $this->defaultConfig['assets']['twbs']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsDirParameterValueInDefaultConfiguration()
    {
        $this->assertRegExp('/\/bootstrap/', $this->defaultConfig['assets']['twbs']['twbs_dir']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsIconPrefixParameterInDefaultConfiguration()
    {
        $this->assertArrayHasKey('icon_prefix', $this->defaultConfig['assets']['twbs']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsIconPrefixParameterValueInDefaultConfiguration()
    {
        $this->assertEquals('glyphicon', $this->defaultConfig['assets']['twbs']['icon_prefix']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsIconTagParameterInDefaultConfiguration()
    {
        $this->assertArrayHasKey('icon_tag', $this->defaultConfig['assets']['twbs']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsIconTagParameterValueInDefaultConfiguration()
    {
        $this->assertEquals('span', $this->defaultConfig['assets']['twbs']['icon_tag']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsFormThemeParameterInDefaultConfiguration()
    {
        $this->assertArrayHasKey('form_theme', $this->defaultConfig['assets']['twbs']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsFormThemeParameterValueInDefaultConfiguration()
    {
        $this->assertEquals('ASFLayoutBundle:form:fields.html.twig', $this->defaultConfig['assets']['twbs']['form_theme']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsFontsDirParameterInDefaultConfiguration()
    {
        $this->assertArrayHasKey('fonts_dir', $this->defaultConfig['assets']['twbs']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsFontsDirParameterValueInDefaultConfiguration()
    {
        $this->assertEquals('%kernel.root_dir%/../web/fonts', $this->defaultConfig['assets']['twbs']['fonts_dir']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsJsPathParameterInDefaultConfiguration()
    {
        $this->assertArrayHasKey('js', $this->defaultConfig['assets']['twbs']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsJsParameterValueInDefaultConfiguration()
    {
        $this->assertEquals('js/bootstrap.min.js', $this->defaultConfig['assets']['twbs']['js'][0]);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsLessParameterValueInDefaultConfiguration()
    {
        $default_values = array(
            'less/bootstrap.less',
            'less/theme.less',
        );

        $defaults_exists = true;
        foreach ($this->defaultConfig['assets']['twbs']['less'] as $key => $value) {
            if ($value != $default_values[$key]) {
                $defaults_exists = false;
            }
        }
        $this->assertTrue($defaults_exists);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTwbsCSSParameterValueInDefaultConfiguration()
    {
        $this->assertCount(0, $this->defaultConfig['assets']['twbs']['css']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testSelect2ParameterInDefaultConfiguration()
    {
        $this->assertArrayNotHasKey('select2', $this->defaultConfig['assets']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testBazingaJsTranslationParameterInDefaultConfiguration()
    {
        $this->assertArrayNotHasKey('bazinga_js_translator', $this->defaultConfig['assets']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testSpeakingURLParameterInDefaultConfiguration()
    {
        $this->assertArrayNotHasKey('speakingurl', $this->defaultConfig['assets']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testFOSJsRoutingParameterInDefaultConfiguration()
    {
        $this->assertArrayHasKey('fos_js_routing', $this->defaultConfig['assets']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testFOSJsRoutingParameterValueInDefaultConfiguration()
    {
        $this->assertFalse($this->defaultConfig['assets']['fos_js_routing']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testTinyMCEParameterInDefaultConfiguration()
    {
        $this->assertArrayNotHasKey('tinymce', $this->defaultConfig['assets']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testJqueryTagsInputParameterInDefaultConfiguration()
    {
        $this->assertArrayNotHasKey('jquery_tags_input', $this->defaultConfig['assets']);
    }

    /**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
    public function testPrismJSParameterInDefaultConfiguration()
    {
        $this->assertArrayNotHasKey('prism_js', $this->defaultConfig['assets']);
    }
}
