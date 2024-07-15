<?php

namespace Lucasnribeiro\FormForge\Tests\Inputs;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Inputs\AbstractInput;

class AbstractInputTest extends TestCase
{
    public function testGetLabel()
    {
        $input = $this->getMockForAbstractClass(AbstractInput::class, ['test_field']);
        $method = new \ReflectionMethod(AbstractInput::class, 'getLabel');
        $method->setAccessible(true);

        $this->assertEquals('<label for="test_field">Test field</label>', $method->invoke($input));

        $input = $this->getMockForAbstractClass(AbstractInput::class, ['test_field', ['label' => 'Custom Label']]);
        $this->assertEquals('<label for="test_field">Custom Label</label>', $method->invoke($input));
    }
}
