<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Bundle configuration
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class Configuration implements ConfigurationInterface
{
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Config\Definition\ConfigurationInterface::getConfigTreeBuilder()
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('asf_layout');
		
		$rootNode
			->children()
				->booleanNode('enable_twig_support')
				    ->defaultTrue()
				->end()
				->booleanNode('enable_assetic_support')
				    ->defaultTrue()
				->end()
				->booleanNode('enable_flash_messages')
				    ->defaultTrue()
				->end()
				->arrayNode('assets')
					->addDefaultsIfNotSet()
					->children()
					   ->append($this->addJqueryParameterNode())
					   ->append($this->addTwitterBootstrapParameterNode())
					   ->append($this->addjQueryUIParameterNode())
					   ->append($this->addSelect2ParameterNode())
					   ->append($this->addBazingaJsTranslationParameterNode())
					   ->append($this->addSpeakingURLParameterNode())
					   ->append($this->addTinyMCEParameterNode())
					   ->booleanNode('fos_js_routing')->defaultFalse()->end()
					->end()
				->end()
			->end()
		;
		
		return $treeBuilder;
	}
	
	/**
	 * Return jQuery configuration
	 */
	protected function addJqueryParameterNode()
	{
	    $builder = new TreeBuilder();
	    $node = $builder->root('jquery');
	    
	    $node
            ->treatTrueLike(array('path' => "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"))
            ->treatFalseLike(array('path' => false))
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('path')
                    ->cannotBeEmpty()
                    ->info('Fill this value if you do not use the package "component/jquery".')
                    ->defaultValue("%kernel.root_dir%/../vendor/components/jquery/jquery.min.js")
                ->end()
            ->end()
        ;
        
        return $node;
	}
	
	/**
	 * Get jQuery UI Configuration
	 */
	protected function addjQueryUIParameterNode()
	{
	    $builder = new TreeBuilder();
	    $node = $builder->root('jqueryui');
	     
	    $node
	       ->treatTrueLike(array(
	           'js' => "%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js",
	           'css' => "%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css"
	       ))
	       ->treatFalseLike(array('js' => false, 'css' => false))
	       ->treatNullLike(array('js' => false, 'css' => false))
	       ->children()
	           ->scalarNode('js')
	               ->cannotBeEmpty()
	               ->info('Fill this value if you do not use the package "component/jqueryui".')
	               ->defaultValue("%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js")
	           ->end()
	           ->scalarNode('css')
	               ->cannotBeEmpty()
	               ->info('Fill this value if you do not use the package "component/jqueryui".')
	               ->defaultValue("%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css")
	           ->end()
	       ->end()
	    ;
	    
	    return $node;
	}
	
	/**
	 * Get Twitter Bootstrap Configuration
	 */
	protected function addTwitterBootstrapParameterNode()
	{
	    $builder = new TreeBuilder();
	    $node = $builder->root('twbs');
	
	    $node
	       ->treatTrueLike(array(
               'twbs_dir' => '%kernel.root_dir%/../vendor/components/bootstrap',
               'js' => array("js/bootstrap.min.js"),
               'less' => array(
                   "less/bootstrap.less", 
                   "less/theme.less"
               ),
	           'css' => array(),
               'icon_prefix' => 'glyphicon',
               'fonts_dir' => '%kernel.root_dir%/../web/fonts',
	           'icon_tag' => 'span',
	           'form_theme' => 'ASFLayoutBundle:form:form_div_layout.html.twig'
           ))
           ->treatFalseLike(array(
               'twbs_dir' => false
           ))
	       ->addDefaultsIfNotSet()
	       ->children()
	           ->scalarNode('twbs_dir')
	               ->cannotBeEmpty()
	               ->info('Fill this value if you do not use the package "component/bootstrap".')
	               ->defaultValue('%kernel.root_dir%/../vendor/components/bootstrap')
	           ->end()
	           ->arrayNode('js')
	               ->treatNullLike(array())
	               ->treatFalseLike(array())
	               ->info('By default, the bundle search js files in folder fill in "asf_layout.assets.twbs.twbs_dir" parameter.')
    	           ->fixXmlConfig('js')
    	           ->prototype('scalar')->end()
    	           ->defaultValue(array(
    	               "js/bootstrap.min.js"
    	           ))
	           ->end()
	           ->arrayNode('less')
	               ->treatNullLike(array())
	               ->treatFalseLike(array())
	               ->info('By default, the bundle search less files in folder fill in "asf_layout.assets.twbs.twbs_dir" parameter.')
    	           ->fixXmlConfig('less')
    	           ->prototype('scalar')->end()
    	           ->defaultValue(array(
    	               "less/bootstrap.less",
	                   "less/theme.less"
    	           ))
	           ->end()
	           ->arrayNode('css')
	               ->treatNullLike(array())
	               ->treatFalseLike(array())
	               ->info('By default, the bundle search css files in folder fill in "asf_layout.assets.twbs.twbs_dir" parameter.')
    	           ->fixXmlConfig('css')
    	           ->prototype('scalar')->end()
	           ->end()
	           ->scalarNode('icon_prefix')
	               ->defaultValue('glyphicon')
	           ->end()
	           ->scalarNode('icon_tag')
	               ->defaultValue('span')
	           ->end()
	           ->scalarNode('fonts_dir')
	               ->defaultValue('%kernel.root_dir%/../web/fonts')
	           ->end()
	           ->scalarNode('form_theme')
	               ->defaultValue('ASFLayoutBundle:form:form_div_layout.html.twig')
	           ->end()
	           ->arrayNode('customize')
	               ->children()
	                   ->arrayNode('less')
	                       ->children()
	                           ->scalarNode('dest_dir')->end()
	                           ->arrayNode('files')
    	                           ->fixXmlConfig('less_files')
    	                           ->prototype('scalar')->end()
    	                       ->end()
    	                   ->end()
    	               ->end()
    	           ->end()
	           ->end()
	       ->end()
	    ;
	    
	    return $node;
	}
	
	/**
	 * Get Select2 Configuration
	 */
	protected function addSelect2ParameterNode()
	{
	    $builder = new TreeBuilder();
	    $node = $builder->root('select2');
	    
	    $node
            ->treatFalseLike(array('js' => false, 'css' => false))
            ->treatNullLike(array('js' => false, 'css' => false))
            ->treatTrueLike(array(
                'js' => "%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js", 
                'css' => "%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css"
            ))
            ->children()
                ->scalarNode('js')
                    ->cannotBeEmpty()
                    ->defaultValue("%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js")
                ->end()
                ->scalarNode('css')
                    ->cannotBeEmpty()
                    ->defaultValue("%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css")
                ->end()
            ->end()
        ;
	           
        return $node;
	}
	
	/**
	 * Get Bazinga Js Translator Configuration
	 */
	protected function addBazingaJsTranslationParameterNode()
	{
	    $builder = new TreeBuilder();
	    $node = $builder->root('bazinga_js_translation');
	    
	    $node
	       ->treatFalseLike(array(
	           'bz_translator_js' => false
	       ))
	       ->treatNullLike(array(
	           'bz_translator_js' => false
	       ))
	       ->treatTrueLike(array(
               'bz_translator_js' => "bundles/bazingajstranslation/js/translator.min.js", 
               'bz_translator_config' => "js/translations/config.js", 
               'bz_translations_files' => "js/translations/*/*.js"
           ))
	       ->children()
    	       ->scalarNode('bz_translator_js')
    	           ->cannotBeEmpty()
    	           ->defaultValue("bundles/bazingajstranslation/js/translator.min.js")
    	       ->end()
    	       ->scalarNode('bz_translator_config')
    	           ->cannotBeEmpty()
    	           ->defaultValue("js/translations/config.js")
    	       ->end()
    	       ->scalarNode('bz_translations_files')
    	           ->defaultValue("js/translations/*/*.js")
    	       ->end()
	       ->end()
	    ;
	    
	    return $node;
	}
	
	/**
	 * Get Speaking URL Configuration
	 */
	protected function addSpeakingURLParameterNode()
	{
	    $builder = new TreeBuilder();
	    $node = $builder->root('speakingurl');
	
	    $node
	       ->treatTrueLike(array('path' => "%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js"))
	       ->treatFalseLike(array('path' => false))
	       ->treatNullLike(array('path' => false))
	       ->children()
	           ->scalarNode('path')
	               ->cannotBeEmpty()
	               ->defaultValue("%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js")
	           ->end()
	       ->end()
	    ;
	     
	    return $node;
	}
	
	/**
	 * Get TinyMCE Configuration
	 */
	protected function addTinyMCEParameterNode()
	{
        $builder = new TreeBuilder();
        $node = $builder->root('tinymce');
        
        $exclude_files = array('bower.json', 'changelog.txt', 'composer.json', 'license.txt', 'package.json', 'readme.md');
        
        $node
            ->treatTrueLike(array(
                'tinymce_dir' => '%kernel.root_dir%/../vendor/tinymce/tinymce',
                'js' => "tinymce.min.js",
                'config' => array(
                    'selector' => '.tinymce-content'
                ),
                'customize' => array(
                    'dest_dir' => '%kernel.root_dir%/../web/js/tinymce',
                    'base_url' => '/js/tinymce'
                )
            ))
            ->treatFalseLike(array(
                'tinymce_dir' => false
            ))
            ->treatNullLike(array(
                'tinymce_dir' => '%kernel.root_dir%/../vendor/tinymce/tinymce',
                'js' => "tinymce.min.js",
                'config' => array(
                    'selector' => '.tinymce-content'
                ),
                'customize' => array(
                    'dest_dir' => '%kernel.root_dir%/../web/js/tinymce',
                    'base_url' => '/js/tinymce'
                )
            ))
            ->children()
                ->scalarNode('tinymce_dir')
                    ->cannotBeEmpty()
                    ->defaultValue('%kernel.root_dir%/../vendor/tinymce/tinymce')
                ->end()
				->scalarNode('js')
					->CannotBeEmpty()
					->defaultValue("tinymce.min.js")
				->end()
				->arrayNode('config')
					->addDefaultsIfNotSet()
					->children()
						->scalarNode('selector')
							->cannotBeEmpty()
							->defaultValue('.tinymce-content')
						->end()
					->end()
				->end()
				->arrayNode('customize')
				    ->addDefaultsIfNotSet()
	               ->children()
                       ->scalarNode('dest_dir')
                           ->cannotBeEmpty()
                           ->defaultValue('%kernel.root_dir%/../web/js/tinymce')
                       ->end()
                       ->scalarNode('base_url')
                           ->cannotBeEmpty()
                           ->defaultValue('/js/tinymce')
                       ->end()
                       ->arrayNode('exclude_files')
                           ->fixXmlConfig('exclude_files')
                           ->prototype('scalar')->end()
                           ->defaultValue($exclude_files)
                       ->end()
    	           ->end()
	           ->end()
			->end()
		;
	
		return $node;
	}
}