<?php

namespace Lucasnribeiro\FormForge\Inputs;

class TextareaInput extends AbstractInput
{
    public function render(): string
    {
        $value = $this->options['value'] ?? '';
        return $this->getLabel() .
               "<textarea name=\"{$this->name}\" id=\"{$this->name}\">{$value}</textarea>";
    }
}
