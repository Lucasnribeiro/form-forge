<?php

namespace Lucasnribeiro\FormForge\Tests\Inputs;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Inputs\SelectInput;
use Lucasnribeiro\FormForge\Inputs\TextInput;
use Lucasnribeiro\FormForge\Inputs\EmailInput;
use Lucasnribeiro\FormForge\Inputs\InputFactory;

class InputFactoryTest extends TestCase
{
    private $factory;

    protected function setUp(): void
    {
        $this->factory = new InputFactory();
        $this->factory->register('text', TextInput::class);
        $this->factory->register('email', EmailInput::class);
    }

    public function testCreateTextInput()
    {
        $input = $this->factory->create('text', 'username');
        $this->assertInstanceOf(TextInput::class, $input);
    }

    public function testCreateEmailInput()
    {
        $input = $this->factory->create('email', 'user_email');
        $this->assertInstanceOf(EmailInput::class, $input);
    }

    public function testCreateUnsupportedInput()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->factory->create('unsupported', 'test');
    }
}
