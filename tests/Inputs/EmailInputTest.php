<?php

namespace Lucasnribeiro\FormForge\Tests\Inputs;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Inputs\EmailInput;

class EmailInputTest extends TestCase
{
    public function testRender()
    {
        $input = new EmailInput('email', ['label' => 'Email Address']);
        $expected = '<label for="email">Email Address</label><input type="email" name="email" id="email" value="">';
        $this->assertEquals($expected, $input->render());

        $input = new EmailInput('email', ['label' => 'Email Address', 'value' => 'test@example.com']);
        $expected = '<label for="email">Email Address</label><input type="email" name="email" id="email" value="test@example.com">';
        $this->assertEquals($expected, $input->render());
    }
}
