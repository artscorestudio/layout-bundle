<?php
/**
 * This file is part of Artscore Studio Framework Package.
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */

namespace ASF\LayoutBundle\Tests\Form;

use Symfony\Component\Form\Test\TypeTestCase;
use ASF\LayoutBundle\Form\DatePickerType;

/**
 * Date Picker Form Type Tests.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class DatePickerTypeTest extends TypeTestCase
{
    /**
     * @covers ASF\LayoutBundle\Form\DatePickerType
     */
    public function testOfAddingDatePickerTypeInForm()
    {
        $formData = array('date' => null);

        $form = $this->factory->createBuilder()
            ->add('date', DatePickerType::class)->getForm();

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
