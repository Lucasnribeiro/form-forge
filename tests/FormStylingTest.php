<?php

namespace Lucasnribeiro\FormForge\Tests;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Form;
use Lucasnribeiro\FormForge\Inputs\EmailInput;
use Lucasnribeiro\FormForge\Inputs\InputFactory;
use Lucasnribeiro\FormForge\Inputs\TextInput;

class FormStylingTest extends TestCase
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

    public function testCustomStyling()
    {
        $this->form->addGlobalClass('form-input')
                   ->addGlobalStyle('padding', '0.5rem')
                   ->addField('name', 'text', [
                       'label' => 'Your Name',
                       'classes' => ['text-lg'],
                       'label_classes' => ['font-bold'],
                       'styles' => ['border' => '1px solid #ccc']
                   ]);

        $rendered = $this->form->render();

        $this->assertStringContainsString('class="form-input text-lg"', $rendered);
        $this->assertStringContainsString('style="padding: 0.5rem; border: 1px solid #ccc"', $rendered);
        $this->assertStringContainsString('<label for="name" class="font-bold">Your Name</label>', $rendered);
    }

    public function testAddingStylesAfterFieldCreation()
    {
        $this->form->addField('email', 'email', ['label' => 'Your Email'])
                   ->field('email')->addClass('text-blue-500')
                                    ->addStyle('margin-top', '1rem');

        $rendered = $this->form->render();

        $this->assertStringContainsString('class="text-blue-500"', $rendered);
        $this->assertStringContainsString('style="margin-top: 1rem"', $rendered);
    }
}
