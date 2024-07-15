<?php

namespace Lucasnribeiro\FormForge\Inputs;

abstract class AbstractInput
{
    protected $name;
    protected $options;

    public function __construct($name, array $options = [])
    {
        $this->name = $name;
        $this->options = $options;
    }

    abstract public function render(): string;

    protected function getLabel(): string
    {
        $label = $this->options['label'] ?? str_replace(['-', '_'], " ", ucfirst($this->name));
        return "<label for=\"{$this->name}\">{$label}</label>";
    }
}
