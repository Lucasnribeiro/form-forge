<?php

namespace Lucasnribeiro\FormForge;

use Lucasnribeiro\FormForge\Inputs\InputFactory;
use Lucasnribeiro\FormForge\Inputs\SubmitButton;

class Form
{
    private $fields = [];
    private $method = 'post';
    private $action = '';
    private $validator;
    private $inputFactory;
    private $globalClasses = [];
    private $globalStyles = [];
    private $submitButton;

    public function __construct(InputFactory $inputFactory)
    {
        $this->validator = new Validator();
        $this->inputFactory = $inputFactory;
        $this->submitButton = new SubmitButton();
    }

    public function setMethod(string $method)
    {
        $allowedMethods = ['get', 'post', 'put', 'patch', 'delete'];
        $method = strtolower($method);
        
        if (!in_array($method, $allowedMethods)) {
            throw new \InvalidArgumentException("Invalid form method: $method");
        }
        
        $this->method = $method;
        return $this;
    }

    public function setAction(string $action)
    {
        $this->action = $action;
        return $this;
    }

    public function addGlobalClass($class)
    {
        if (!in_array($class, $this->globalClasses)) {
            $this->globalClasses[] = $class;
        }
        return $this;
    }

    public function addGlobalStyle($property, $value)
    {
        $this->globalStyles[$property] = $value;
        return $this;
    }

    public function addField($name, $type, $options = [])
    {
        $options['classes'] = array_merge($this->globalClasses, $options['classes'] ?? []);
        $options['styles'] = array_merge($this->globalStyles, $options['styles'] ?? []);
        
        $field = $this->inputFactory->create($type, $name, $options);
        $this->fields[$name] = $field;

        return $this;
    }

    public function addRule($field, $rule, $message)
    {
        $this->validator->addRule($field, $rule, $message);
        return $this;
    }

    public function render()
    {
        $actionAttr = $this->action ? " action=\"{$this->action}\"" : '';
        if (in_array($this->method, ['put', 'patch', 'delete'])) {
            $html = "<form method=\"post\"{$actionAttr}>";
        }else{
            $html = "<form method=\"{$this->method}\"{$actionAttr}>";
        }
        
        // For spoofing methods when using frameworks
        if (!in_array($this->method, ['get', 'post'])) {
            $html .= "<input type=\"hidden\" name=\"_method\" value=\"{$this->method}\">";
        }
        foreach ($this->fields as $name => $field) {
            $html .= $field->render();
            if (isset($this->getErrors()[$name])) {
                $html .= '<span class="error">' . implode(', ', $this->getErrors()[$name]) . '</span>';
            }
        }
        $html .= $this->submitButton->render();
        $html .= '</form>';
        return $html;
    }

    public function submitButton(): SubmitButton
    {
        return $this->submitButton;
    }

    public function validate($data)
    {
        return $this->validator->validate($data);
    }

    public function getErrors()
    {
        return $this->validator->getErrors();
    }

    public function field($name)
    {
        return $this->fields[$name];
    }
}
