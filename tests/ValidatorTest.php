<?php

namespace YourNamespace\Forge\Tests;

use PHPUnit\Framework\TestCase;
use Lucasnribeiro\FormForge\Validator;

class ValidatorTest extends TestCase
{
    private $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testRequiredRule()
    {
        $this->validator->addRule('name', 'required', 'Name is required');
        $this->assertFalse($this->validator->validate(['name' => '']));
        $this->assertTrue($this->validator->validate(['name' => 'John']));
    }

    public function testEmailRule()
    {
        $this->validator->addRule('email', 'email', 'Invalid email format');
        $this->assertFalse($this->validator->validate(['email' => 'invalid']));
        $this->assertTrue($this->validator->validate(['email' => 'test@example.com']));
    }

    public function testCustomRule()
    {
        $this->validator->addRule('age', function ($value) {
            return $value >= 18;
        }, 'Must be 18 or older');
        $this->assertFalse($this->validator->validate(['age' => 17]));
        $this->assertTrue($this->validator->validate(['age' => 18]));
    }

    public function testGetErrors()
    {
        $this->validator->addRule('name', 'required', 'Name is required')
                        ->addRule('email', 'email', 'Invalid email format');
        $this->validator->validate(['name' => '', 'email' => 'invalid']);
        $errors = $this->validator->getErrors();
        $this->assertArrayHasKey('name', $errors);
        $this->assertArrayHasKey('email', $errors);
    }
}
