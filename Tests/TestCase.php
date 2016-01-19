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

use Symfony\Bundle\FrameworkBundle\Tests\TestCase as BaseTestCase;

/**
 * Abstract class for unit test cases
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
abstract class TestCase extends BaseTestCase
{
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp()
	{
		parent::setUp();
	}
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::tearDown()
	 */
	protected function tearDown()
	{
		parent::tearDown();
	}
}