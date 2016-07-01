<?php
/**
 * This file is part of Artscore Studio Framework Package.
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */

namespace ASF\LayoutBundle\Tests\Form\Type;

use Symfony\Component\Form\Test\TypeTestCase;
use ASF\LayoutBundle\Form\BaseCollectionType;

/**
 * Base Collection Form Type Tests.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class BaseCollectionTypeTest extends TypeTestCase
{
    /**
     * @covers ASF\LayoutBundle\Form\BaseCollectionType
     */
    public function testOfAddingBaseCollectionTypeInForm()
    {
        $formData = array('collection' => null);

        $form = $this->factory->createBuilder()
            ->add('collection', BaseCollectionType::class)->getForm();

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
