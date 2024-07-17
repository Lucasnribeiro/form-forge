<?php

namespace Lucasnribeiro\FormForge\Inputs;

abstract class AbstractInput
{
    protected $name;
    protected $options;
    protected $classes = [];
    protected $styles = [];
    protected $label;

    public function __construct($name, array $options = [])
    {
        $this->name = $name;
        $this->options = $options;
        $this->classes = $options['classes'] ?? [];
        $this->styles = $options['styles'] ?? [];
        $this->label = new Label($name, $options['label'] ?? str_replace(['-', '_'], " ", ucfirst($this->name)));

        if (isset($options['label_classes'])) {
            foreach ($options['label_classes'] as $class) {
                $this->label->addClass($class);
            }
        }
    }

    abstract public function render();

    public function label(): Label
    {
        return $this->label;
    }

    protected function getClasses(): string
    {
        return !empty($this->classes) ? implode(' ', $this->classes) : '';
    }

    protected function getStyles(): string
    {
        if (empty($this->styles)) {
            return '';
        }
        return implode('; ', array_map(
            function ($key, $value) {
                return "$key: $value";
            },
            array_keys($this->styles),
            $this->styles
        ));
    }

    protected function renderAttributes(): string
    {
        $attributes = [];

        $classes = $this->getClasses();
        if (!empty($classes)) {
            $attributes[] = "class=\"{$classes}\"";
        }

        $styles = $this->getStyles();
        if (!empty($styles)) {
            $attributes[] = "style=\"{$styles}\"";
        }

        return implode(' ', $attributes);
    }

    public function addClass($class)
    {
        if (!in_array($class, $this->classes)) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function addStyle($property, $value)
    {
        $this->styles[$property] = $value;
        return $this;
    }
}
