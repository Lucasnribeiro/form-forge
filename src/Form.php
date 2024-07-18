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
    private $cache;
    private $cacheKey;

    public function __construct(InputFactory $inputFactory)
    {
        $this->validator = new Validator();
        $this->inputFactory = $inputFactory;
        $this->submitButton = new SubmitButton();
        $this->cache = FileCache::getInstance();
        $this->cacheKey = null;
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
        $this->cacheKey = null;

        return $this;
    }

    public function addRule($field, $rule, $message)
    {
        $this->validator->addRule($field, $rule, $message);
        return $this;
    }

    public function render()
    {

        $this->cacheKey = $this->generateCacheKey();

        if ($this->cache->has($this->cacheKey)) {
            return $this->cache->get($this->cacheKey);
        }

        $html = $this->generateFormHtml();

        $this->cache->set($this->cacheKey, $html);

        return $html;
    }

    private function generateFormHtml()
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

    private function generateCacheKey()
    {
        return md5(serialize([
            $this->fields,
            $this->method,
            $this->action,
            $this->globalClasses,
            $this->globalStyles,
            $this->submitButton
        ]));
    }

    public function submitButton()
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
