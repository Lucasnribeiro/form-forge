<?php

namespace Lucasnribeiro\FormForge;

class Validator
{
    private $rules = [];
    private $errors = [];

    public function addRule($field, $rule, $message)
    {
        $this->rules[$field][] = ['rule' => $rule, 'message' => $message];
        return $this;
    }

    public function validate($data)
    {
        $this->errors = [];
        foreach ($this->rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                if (!$this->executeRule($rule['rule'], $data[$field] ?? null)) {
                    $this->errors[$field][] = $rule['message'];
                }
            }
        }
        return empty($this->errors);
    }

    private function executeRule($rule, $value)
    {
        if (is_callable($rule)) {
            return $rule($value);
        }
        switch ($rule) {
            case 'required':
                return !empty($value);
            case 'email':
                return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
            // Add more built-in rules as needed
        }
        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
