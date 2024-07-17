<?php

namespace Lucasnribeiro\FormForge\Tests;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Form;
use Lucasnribeiro\FormForge\Inputs\InputFactory;
use Lucasnribeiro\FormForge\EventDispatcher;
use Lucasnribeiro\FormForge\Cache\FileCache;

class FormMethodActionTest extends TestCase
{
    private $form;
    private $inputFactory;

    protected function setUp(): void
    {
        $this->inputFactory = new InputFactory();
        $this->form = new Form($this->inputFactory);
    }

    public function testDefaultMethodAndAction()
    {
        $rendered = $this->form->render();
        $this->assertStringContainsString('<form method="post">', $rendered);
        $this->assertStringNotContainsString('action=', $rendered);
    }

    public function testSetMethodAndAction()
    {
        $this->form->setMethod('get')->setAction('/submit');
        $rendered = $this->form->render();
        $this->assertStringContainsString('<form method="get" action="/submit">', $rendered);
    }

    public function testInvalidMethod()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->form->setMethod('invalid');
    }

    public function testNonStandardMethod()
    {
        $this->form->setMethod('put')->setAction('/update');
        $rendered = $this->form->render();
        $this->assertStringContainsString('<form method="post" action="/update">', $rendered);
        $this->assertStringContainsString('<input type="hidden" name="_method" value="put">', $rendered);
    }
}
