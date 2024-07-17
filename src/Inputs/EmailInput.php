<?php

namespace Lucasnribeiro\FormForge\Inputs;

class EmailInput extends AbstractInput
{
    public function render(): string
    {
        $value = $this->options['value'] ?? '';
        $attributes = $this->renderAttributes() ?? '' ;
        return $this->label->render() .
               "<input type=\"email\" name=\"{$this->name}\" id=\"{$this->name}\" value=\"{$value}\"{$attributes}>";
    }
}