<?php

namespace Lucasnribeiro\FormForge\Inputs;

class EmailInput extends AbstractInput
{
    public function render(): string
    {
        $value = $this->options['value'] ?? '';
        return $this->getLabel() .
               "<input type=\"email\" name=\"{$this->name}\" id=\"{$this->name}\" value=\"{$value}\">";
    }
}
