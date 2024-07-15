<?php

namespace Lucasnribeiro\FormForge;

use Lucasnribeiro\FormForge\Inputs\TextInput;
use Lucasnribeiro\FormForge\Inputs\EmailInput;
use Lucasnribeiro\FormForge\Inputs\TextareaInput;
use Lucasnribeiro\FormForge\Inputs\SelectInput;
use Lucasnribeiro\FormForge\Inputs\InputFactory;

class Form
{
    /** @array  */
    private $fields = [];
    private $validator;
    private $inputFactory;

    public function __construct(InputFactory $inputFactory)
    {
        $this->validator = new Validator();
        $this->inputFactory = $inputFactory;
    }

    public function addField($name, $type, $options = [])
    {
        $this->fields[$name] = $this->inputFactory->create($type, $name, $options);
        return $this;
    }

    public function addRule($field, $rule, $message)
    {
        $this->validator->addRule($field, $rule, $message);
        return $this;
    }

    public function render()
    {
        $html = '<form method="post">';
        foreach ($this->fields as $name => $field) {
            $html .= $field->render();
            if (isset($this->getErrors()[$name])) {
                $html .= '<span class="error">' . implode(', ', $this->getErrors()[$name]) . '</span>';
            }
        }
        $html .= '<input type="submit" value="Submit">';
        $html .= '</form>';
        return $html;
    }

    public function validate($data)
    {
        return $this->validator->validate($data);
    }

    public function getErrors()
    {
        return $this->validator->getErrors();
    }
}
