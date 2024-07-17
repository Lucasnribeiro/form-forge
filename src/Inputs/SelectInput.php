<?php

namespace Lucasnribeiro\FormForge\Inputs;

class SelectInput extends AbstractInput
{
    public function render()
    {
        $options = $this->options['options'] ?? [];
        $value = $this->options['value'] ?? '';
        $attributes = $this->renderAttributes() ?? '' ;

        $html = $this->label->render() . "<select name=\"{$this->name}\" id=\"{$this->name}\"{$attributes}>";
        foreach ($options as $optionValue => $optionLabel) {
            $selected = $optionValue == $value ? ' selected' : '';
            $html .= "<option value=\"{$optionValue}\"{$selected}>{$optionLabel}</option>";
        }
        $html .= "</select>";

        return $html;
    }
}
