<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\Tests;

use ASF\LayoutBundle\ASFLayoutBundle;

/**
 * Layout Bundle Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFLayoutBundleTest extends ContainerAwareTestCase
{
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\HttpKernel\Bundle\Bundle::build()
	 */
	public function testBuild()
	{
		$bundle = new ASFLayoutBundle();
		$bundle->build($this->container);
	}
}