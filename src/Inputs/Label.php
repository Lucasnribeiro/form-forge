<?php

namespace Lucasnribeiro\FormForge\Inputs;

class Label
{
    private $for;
    private $text;
    private $classes = [];

    public function __construct(string $for, string $text)
    {
        $this->for = $for;
        $this->text = $text;
    }

    public function addClass(string $class)
    {
        if (!in_array($class, $this->classes)) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function render()
    {
        $classes = !empty($this->classes) ? ' class="' . implode(' ', $this->classes) . '"' : '';
        return "<label for=\"{$this->for}\"{$classes}>{$this->text}</label>";
    }
}
