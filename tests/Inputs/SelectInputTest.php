<?php

namespace Lucasnribeiro\FormForge\Tests\Inputs;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Inputs\SelectInput;

class SelectInputTest extends TestCase
{
    public function testRender()
    {
        $options = ['1' => 'Option 1', '2' => 'Option 2'];
        $input = new SelectInput('choice', ['label' => 'Choose', 'options' => $options]);
        $expected = '<label for="choice">Choose</label><select name="choice" id="choice">' .
                    '<option value="1">Option 1</option><option value="2">Option 2</option></select>';
        $this->assertEquals($expected, $input->render());

        $input = new SelectInput('choice', ['label' => 'Choose', 'options' => $options, 'value' => '2']);
        $expected = '<label for="choice">Choose</label><select name="choice" id="choice">' .
                    '<option value="1">Option 1</option><option value="2" selected>Option 2</option></select>';
        $this->assertEquals($expected, $input->render());
    }
}
