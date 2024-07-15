<?php

namespace Lucasnribeiro\FormForge\Tests\Inputs;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Inputs\TextInput;

class TextInputTest extends TestCase
{
    public function testRender()
    {
        $input = new TextInput('username', ['label' => 'Username']);
        $expected = '<label for="username">Username</label><input type="text" name="username" id="username" value="">';
        $this->assertEquals($expected, $input->render());

        $input = new TextInput('username', ['label' => 'Username', 'value' => 'john_doe']);
        $expected = '<label for="username">Username</label><input type="text" name="username" id="username" value="john_doe">';
        $this->assertEquals($expected, $input->render());
    }
}
