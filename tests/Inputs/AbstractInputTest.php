<?php

namespace Lucasnribeiro\FormForge\Tests\Inputs;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Inputs\AbstractInput;
use Lucasnribeiro\FormForge\Inputs\Label;

class AbstractInputTest extends TestCase
{
    public function testLabel()
    {
        // Test default label
        $input = $this->getMockForAbstractClass(AbstractInput::class, ['test_field']);
        $this->assertInstanceOf(Label::class, $input->label());
        $this->assertEquals('<label for="test_field">Test field</label>', $input->label()->render());

        // Test custom label
        $input = $this->getMockForAbstractClass(AbstractInput::class, ['test_field', ['label' => 'Custom Label']]);
        $this->assertEquals('<label for="test_field">Custom Label</label>', $input->label()->render());

        // Test adding label class
        $input->label()->addClass('form-label');
        $this->assertEquals('<label for="test_field" class="form-label">Custom Label</label>', $input->label()->render());

        // Test initial label classes
        $input = $this->getMockForAbstractClass(AbstractInput::class, ['test_field', [
            'label' => 'With Classes',
            'label_classes' => ['class1', 'class2']
        ]]);
        $this->assertEquals('<label for="test_field" class="class1 class2">With Classes</label>', $input->label()->render());

        // Test adding more classes
        $input->label()->addClass('class3');
        $this->assertEquals('<label for="test_field" class="class1 class2 class3">With Classes</label>', $input->label()->render());
    }
}
