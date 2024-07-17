<?php

namespace Lucasnribeiro\FormForge\Inputs;

class SubmitButton
{
    private $value;
    private $classes = [];
    private $attributes = [];

    public function __construct(string $value = 'Submit')
    {
        $this->value = $value;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
        return $this;
    }

    public function addClass(string $class)
    {
        if (!in_array($class, $this->classes)) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function addAttribute(string $key, string $value)
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function render()
    {
        $classes = !empty($this->classes) ? ' class="' . implode(' ', $this->classes) . '"' : '';
        
        $attributes = '';
        foreach ($this->attributes as $key => $value) {
            $attributes .= " $key=\"$value\"";
        }

        return "<input type=\"submit\" value=\"{$this->value}\"$classes$attributes>";
    }
}
