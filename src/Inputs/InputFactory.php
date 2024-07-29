<?php

namespace Lucasnribeiro\FormForge\Inputs;

class InputFactory
{
    private $types = [];

    public function register(string $type, string $class)
    {
        $this->types[$type] = $class;
    }

    public function create(string $type, string $name, array $options = [])
    {
        if (!isset($this->types[$type])) {
            throw new \InvalidArgumentException("Unsupported input type: {$type}");
        }

        $class = $this->types[$type];
        return new $class($name, $options);
    }
}
