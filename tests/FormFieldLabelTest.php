<?php

namespace Lucasnribeiro\FormForge\Tests;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Form;
use Lucasnribeiro\FormForge\Inputs\InputFactory;
use Lucasnribeiro\FormForge\EventDispatcher;
use Lucasnribeiro\FormForge\Cache\FileCache;
use Lucasnribeiro\FormForge\Inputs\EmailInput;
use Lucasnribeiro\FormForge\Inputs\TextInput;

class FormFieldLabelTest extends TestCase
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

    public function testAddLabelClass()
    {
        $this->form->addField('email', 'email', [
            'label' => 'Your Email',
            'label_classes' => ['block', 'text-gray-700']
        ]);

        $this->form->field('email')->label()->addClass('font-bold');

        $rendered = $this->form->render();

        $this->assertStringContainsString('<label for="email" class="block text-gray-700 font-bold">Your Email</label>', $rendered);
    }

    public function testChainedLabelClasses()
    {
        $this->form->addField('name', 'text', ['label' => 'Your Name'])
                   ->field('name')
                   ->label()
                   ->addClass('text-lg')
                   ->addClass('font-semibold');

        $rendered = $this->form->render();

        $this->assertStringContainsString('<label for="name" class="text-lg font-semibold">Your Name</label>', $rendered);
    }
}
