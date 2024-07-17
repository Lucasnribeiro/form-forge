<?php

namespace Lucasnribeiro\FormForge\Inputs;

class TextInput extends AbstractInput
{
    public function render()
    {
        $value = $this->options['value'] ?? '';
        $attributes = $this->renderAttributes() ?? '' ;
        return $this->label->render() . 
               "<input type=\"text\" name=\"{$this->name}\" id=\"{$this->name}\" value=\"{$value}\"{$attributes}>";
    }
}
