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
				->arrayNode('supported_assets')
					->addDefaultsIfNotSet()
					->children()
					   ->arrayNode('jquery')
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
					   ->end()
					->end()
				->end()
			->end()
		;
		
		return $treeBuilder;
	}
}