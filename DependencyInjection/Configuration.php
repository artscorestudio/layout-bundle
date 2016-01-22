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
				->arrayNode('supports')
					->addDefaultsIfNotSet()
					->children()
						->booleanNode('jquery')->defaultFalse()->end()
					->end()
				->end()
				->arrayNode('jquery_config')
					->addDefaultsIfNotSet()
					->children()
						->scalarNode('path')
							->cannotBeEmpty()
							->defaultValue("%kernel.root_dir%/Resources/public/jquery/jquery.min.js")
						->end()
					->end()
				->end()
			->end()
		;
		
		return $treeBuilder;
	}
}