<?php

namespace Lucasnribeiro\FormForge\Inputs;

class TextInput extends AbstractInput
{
    public function render(): string
    {
        $value = $this->options['value'] ?? '';
        return $this->getLabel() .
               "<input type=\"text\" name=\"{$this->name}\" id=\"{$this->name}\" value=\"{$value}\">";
    }
}
