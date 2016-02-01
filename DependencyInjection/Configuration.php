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
				->arrayNode('supported_assets')
					->addDefaultsIfNotSet()
					->children()
					   ->append($this->addJqueryParameterNode())
					   ->append($this->addjQueryUIParameterNode())
					   ->append($this->addTwitterBootstrapParameterNode())
					   ->append($this->addSelect2ParameterNode())
					   ->append($this->addBazingaJsTranslatorParameterNode())
					   ->append($this->addSpeakingURLParameterNode())
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
	       ->addDefaultsIfNotSet()
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
	               return array('js' => false);
	           })
	       ->end()
	       ->addDefaultsIfNotSet()
	       ->children()
	           ->scalarNode('js')
	               ->cannotBeEmpty()
    	           ->defaultValue(array("%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js"))
	           ->end()
	           ->scalarNode('less')
	               ->defaultValue(array(
	                   "@ASFLayoutBundle/Resources/public/supports/bootstrap/less/bootstrap.less",
	                   "@ASFLayoutBundle/Resources/public/supports/bootstrap/less/theme.less"
	               ))
	           ->end()
	           ->scalarNode('css')
	               ->defaultValue(array())
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
	       ->addDefaultsIfNotSet()
	       ->children()
	           ->scalarNode('js')
	               ->defaultValue("%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js")
	           ->end()
	           ->scalarNode('css')
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
	       ->addDefaultsIfNotSet()
	       ->children()
    	       ->scalarNode('bz_translator_js')
    	           ->defaultValue("%kernel.root_dir%/../web/bundles/bazingajstranslation/js/translator.min.js")
    	       ->end()
    	       ->scalarNode('bz_translator_config')
    	           ->defaultValue("%kernel.root_dir%/../web/js/translations/config.js")
    	       ->end()
    	       ->scalarNode('bz_translations_files')
    	           ->defaultValue("%kernel.root_dir%/../web/js/translations/*/*.js")
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
	       ->addDefaultsIfNotSet()
	       ->children()
	           ->scalarNode('path')
	               ->defaultValue("%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js")
	           ->end()
	       ->end()
	    ;
	     
	    return $node;
	}
}