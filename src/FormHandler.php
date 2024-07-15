<?php

namespace Lucasnribeiro\FormForge;

class FormHandler
{
    private $form;
    private $successCallback;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function onSuccess(callable $callback)
    {
        $this->successCallback = $callback;
        return $this;
    }

    public function handle($data)
    {
        if ($this->form->validate($data)) {
            if ($this->successCallback) {
                call_user_func($this->successCallback, $data);
            }
            return true;
        }
        return false;
    }
}
