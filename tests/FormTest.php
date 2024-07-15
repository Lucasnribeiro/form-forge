<?php

namespace Lucasnribeiro\FormForge\Tests;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Form;
use Lucasnribeiro\FormForge\Inputs\InputFactory;
use Lucasnribeiro\FormForge\Inputs\TextInput;
use Lucasnribeiro\FormForge\Inputs\EmailInput;

class FormTest extends TestCase
{
    private $form;
    private $inputFactory;

    protected function setUp(): void
    {
        $this->inputFactory = new InputFactory();
        $this->inputFactory->register('text', TextInput::class);
        $this->inputFactory->register('email', EmailInput::class);
        $this->form = new Form($this->inputFactory);
    }

    public function testAddField()
    {
        $this->form->addField('username', 'text', ['label' => 'Username']);
        $this->form->addField('email', 'email', ['label' => 'Email Address']);

        $rendered = $this->form->render();
        $this->assertStringContainsString('<input type="text" name="username"', $rendered);
        $this->assertStringContainsString('<input type="email" name="email"', $rendered);
    }

    public function testValidation()
    {
        $this->form->addField('email', 'email')
                   ->addRule('email', 'required', 'Email is required')
                   ->addRule('email', 'email', 'Invalid email format');

        $this->assertFalse($this->form->validate(['email' => '']));
        $this->assertFalse($this->form->validate(['email' => 'invalid']));
        $this->assertTrue($this->form->validate(['email' => 'test@example.com']));
    }

    public function testRenderWithErrors()
    {
        $this->form->addField('email', 'email')
                   ->addRule('email', 'required', 'Email is required');

        $this->form->validate(['email' => '']);
        $rendered = $this->form->render();
        $this->assertStringContainsString('<span class="error">Email is required</span>', $rendered);
    }
}
