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
use Symfony\Component\Config\Definition\ScalarNode;
use Symfony\Component\DependencyInjection\Tests\Compiler\CannotBeAutowired;

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
					   ->append($this->addjQueryUIParameterNode())
					   ->append($this->addTwitterBootstrapParameterNode())
					   ->append($this->addSelect2ParameterNode())
					   ->append($this->addBazingaJsTranslatorParameterNode())
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
            ->beforeNormalization()
                ->ifTrue(function($value){
                    return !isset($value['path']) || $value == false;
                })
                ->then(function($value){
                    return array('path' => false);
                })
            ->end()
            ->beforeNormalization()
                ->ifTrue(function($value){
                    return $value === true;
                })
                ->then(function($value){
                    return array('path' => "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js");
                })
            ->end()
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('path')
                    ->cannotBeEmpty()
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
	       ->beforeNormalization()
	           ->ifTrue(function($value){
	               return (!isset($value['js']) && !isset($value['css'])) || $value == false;
	           })
	           ->then(function($value){
	               return array('js' => false, 'css' => false);
	           })
	       ->end()
	       ->beforeNormalization()
    	       ->ifTrue(function($value){
    	           return $value === true;
    	       })
    	       ->then(function($value){
    	           return array(
    	               'js' => "%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js", 
    	               'css' => "%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css"
    	           );
    	       })
	       ->end()
	       ->children()
	           ->scalarNode('js')
	               ->cannotBeEmpty()
	               ->defaultValue("%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js")
	           ->end()
	           ->scalarNode('css')
	               ->cannotBeEmpty()
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
	       ->beforeNormalization()
	           ->ifTrue(function($value){
	               return $value == false;
	           })
	           ->then(function($value){
	               return array();
	           })
	       ->end()
	       ->beforeNormalization()
    	       ->ifTrue(function($value){
    	           return $value === true;
    	       })
    	       ->then(function($value){
    	           return array(
    	               'assets_dir' => '%kernel.root_dir%/../vendor/components/bootstrap',
    	               'js' => array("%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js"),
    	               'less' => array(
    	                   "%kernel.root_dir%/../vendor/components/bootstrap/less/bootstrap.less", 
    	                   "%kernel.root_dir%/../vendor/components/bootstrap/less/theme.less"
    	               ),
    	               'icon_prefix' => 'glyphicon',
    	               'fonts_dir' => '%kernel.root_dir%/../web/fonts'
    	           );
    	       })
	       ->end()
	       ->addDefaultsIfNotSet()
	       ->children()
	           ->scalarNode('assets_dir')
	               ->cannotBeEmpty()
	               ->defaultValue('%kernel.root_dir%/../vendor/components/bootstrap')
	           ->end()
	           ->arrayNode('js')
    	           ->fixXmlConfig('js')
    	           ->prototype('scalar')->end()
    	           ->defaultValue(array(
    	               "%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js"
    	           ))
	           ->end()
	           ->arrayNode('less')
    	           ->fixXmlConfig('less')
    	           ->prototype('scalar')->end()
    	           ->defaultValue(array(
    	               "%kernel.root_dir%/../vendor/components/bootstrap/less/bootstrap.less",
	                   "%kernel.root_dir%/../vendor/components/bootstrap/less/theme.less"
    	           ))
	           ->end()
	           ->arrayNode('css')
    	           ->fixXmlConfig('vss')
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
	       ->beforeNormalization()
    	       ->ifTrue(function($value){
	               return $value == false;
	           })
	           ->then(function($value){
	               return array('js' => false, 'css' => false);
	           })
	       ->end()
	       ->beforeNormalization()
    	       ->ifTrue(function($value){
    	           return $value === true;
    	       })
    	       ->then(function($value){
    	           return array(
    	               'js' => "%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js", 
    	               'css' => "%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css"
    	           );
    	       })
	       ->end()
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
	protected function addBazingaJsTranslatorParameterNode()
	{
	    $builder = new TreeBuilder();
	    $node = $builder->root('bazinga_js_translator');
	     
	    $node
	       ->beforeNormalization()
	           ->ifTrue(function($value){
	               return $value == false;
	           })
	           ->then(function($value){
	               return array('bz_translator_js' => false, 'bz_translator_config' => false, 'bz_translations_files' => false);
	           })
	       ->end()
	       ->beforeNormalization()
    	       ->ifTrue(function($value){
    	           return $value === true;
    	       })
    	       ->then(function($value){
    	           return array(
    	               'bz_translator_js' => "bundles/bazingajstranslation/js/translator.min.js", 
    	               'bz_translator_config' => "js/translations/config.js", 
    	               'bz_translations_files' => "js/translations/*/*.js"
    	           );
    	       })
	       ->end()
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
	    $node = $builder->root('speaking_url');
	
	    $node
	       ->beforeNormalization()
	           ->ifTrue(function($value){
	               return $value == false;
	           })
	           ->then(function($value){
	               return array('path' => false);
	           })
	       ->end()
	       ->beforeNormalization()
    	       ->ifTrue(function($value){
    	           return $value === true;
    	       })
    	       ->then(function($value){
    	           return array('path' => "%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js");
    	       })
	       ->end()
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
	
		$node
			->beforeNormalization()
				->ifTrue(function($value){
					return $value == false;
				})
				->then(function($value){
					return array('path' => false);
				})
			->end()
			->beforeNormalization()
				->ifTrue(function($value){
					return $value === true;
				})
				->then(function($value){
					return array('path' => "%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js");
				})
			->end()
			->children()
				->scalarNode('path')
					->CannotBeEmpty()
					->defaultValue("%kernel.root_dir%/../vendor/tinymce/tinymce/tinymce.jquery.min.js")
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
			->end()
		;
	
		return $node;
	}
}