<?php

namespace Lucasnribeiro\FormForge\Tests;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Form;
use Lucasnribeiro\FormForge\Inputs\InputFactory;
use Lucasnribeiro\FormForge\EventDispatcher;
use Lucasnribeiro\FormForge\Cache\FileCache;

class FormSubmitButtonTest extends TestCase
{
    private $form;
    private $inputFactory;

    protected function setUp(): void
    {
        $this->inputFactory = new InputFactory();

        $this->form = new Form($this->inputFactory);
    }

    public function testDefaultSubmitButton()
    {
        $rendered = $this->form->render();
        $this->assertStringContainsString('<input type="submit" value="Submit">', $rendered);
    }

    public function testCustomSubmitButton()
    {
        $this->form->submitButton()
            ->setValue('Send')
            ->addClass('btn')
            ->addClass('btn-primary')
            ->addAttribute('id', 'submit-btn')
            ->addAttribute('data-test', 'true');

        $rendered = $this->form->render();
        $this->assertStringContainsString('<input type="submit" value="Send" class="btn btn-primary" id="submit-btn" data-test="true">', $rendered);
    }

    public function testChainedSubmitButtonMethods()
    {
        $this->form->submitButton()
            ->setValue('Submit Form')
            ->addClass('custom-btn')
            ->addAttribute('id', 'custom-submit');

        $rendered = $this->form->render();
        $this->assertStringContainsString('<input type="submit" value="Submit Form" class="custom-btn" id="custom-submit">', $rendered);
    }
}
