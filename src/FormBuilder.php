<?php

namespace Lucasnribeiro\FormForge;

use Lucasnribeiro\FormForge\Inputs\TextInput;
use Lucasnribeiro\FormForge\Inputs\EmailInput;
use Lucasnribeiro\FormForge\Inputs\TextareaInput;
use Lucasnribeiro\FormForge\Inputs\SelectInput;
use Lucasnribeiro\FormForge\Inputs\InputFactory;

class FormBuilder
{
    public static function create(): Form
    {
        $inputFactory = new InputFactory();
        $inputFactory->register('text', TextInput::class);
        $inputFactory->register('email', EmailInput::class);
        $inputFactory->register('textarea', TextareaInput::class);
        $inputFactory->register('select', SelectInput::class);

        return new Form($inputFactory);
    }
}
