<?php

namespace Lucasnribeiro\FormForge\Inputs;

class TextareaInput extends AbstractInput
{
    public function render()
    {
        $value = $this->options['value'] ?? '';
        $attributes = $this->renderAttributes() ?? '' ;
        return $this->label->render() .
               "<textarea name=\"{$this->name}\" id=\"{$this->name}\"{$attributes}>{$value}</textarea>";
    }
}
