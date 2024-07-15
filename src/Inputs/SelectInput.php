<?php

namespace Lucasnribeiro\FormForge\Inputs;

class SelectInput extends AbstractInput
{
    public function render(): string
    {
        $options = $this->options['options'] ?? [];
        $value = $this->options['value'] ?? '';

        $html = $this->getLabel() . "<select name=\"{$this->name}\" id=\"{$this->name}\">";
        foreach ($options as $optionValue => $optionLabel) {
            $selected = $optionValue == $value ? ' selected' : '';
            $html .= "<option value=\"{$optionValue}\"{$selected}>{$optionLabel}</option>";
        }
        $html .= "</select>";

        return $html;
    }
}
