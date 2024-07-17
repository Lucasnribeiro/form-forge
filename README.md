# FormForge

FormForge is a OOP based form builder for PHP. The goal of this project is to be an example of how to build libraries using composer autoloader and PSR-4. The abstractions contained here can be ported into many other projects that uses OOP. This is not production ready, it's meant to be just an study. 

## Features

- Fluent API for easy form creation and customization
- Support for various input types (text, email, select, etc.)
- Customizable labels and submit buttons
- Form method and action customization
- Basic validation support
- Extensible architecture

## Installation

You can install FormForge via Composer:

```bash
composer require lucasnribeiro/form-forge

``` 

## Basic Usage

```php
use Lucasnribeiro\FormForge\Form;
use Lucasnribeiro\FormForge\Inputs\InputFactory;

$form = new Form(new InputFactory());

$form->setMethod('post')
     ->setAction('/submit-form')
     ->addField('name', 'text', ['label' => 'Your Name'])
     ->addField('email', 'email', ['label' => 'Your Email'])
     ->addField('country', 'select', [
         'label' => 'Country',
         'options' => ['US' => 'United States', 'CA' => 'Canada', 'UK' => 'United Kingdom']
     ])
     ->submitButton()
         ->setValue('Send')
         ->addClass('btn-primary');

echo $form->render();
``` 

## Customizing Fields

You can customize individual fields after adding them:

```php
$form->addField('email', 'email', ['label' => 'Your Email'])
     ->field('email')
     ->addClass('form-control')
     ->label()
     ->addClass('form-label');
``` 

## Customizing the Submit Button

```php
$form->submitButton()
     ->setValue('Send Message')
     ->addClass('btn')
     ->addClass('btn-primary')
     ->addAttribute('id', 'contact-submit');
``` 

## Example using Tailwind

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Lucasnribeiro\FormForge\FormBuilder;

$form = FormBuilder::create();
$form->setMethod('post')
     ->setAction('/submit-contact')
     ->addField('name', 'text', ['label' => 'Full Name'])
     ->addField('email', 'email', ['label' => 'Email Address'])
     ->addField('subject', 'text', ['label' => 'Subject'])
     ->addField('message', 'textarea', ['label' => 'Your Message']);

$form->field('name')
     ->addClass('mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50')
     ->label()
     ->addClass('block text-sm font-medium text-gray-700');

$form->field('email')
     ->addClass('mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50')
     ->label()
     ->addClass('block text-sm font-medium text-gray-700');

$form->field('subject')
     ->addClass('mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50')
     ->label()
     ->addClass('block text-sm font-medium text-gray-700');

$form->field('message')
     ->addClass('mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50')
     ->label()
     ->addClass('block text-sm font-medium text-gray-700');

$form->submitButton()
     ->setValue('Send Message')
     ->addClass('mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FormForge</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
     <div class="flex flex-row justify-center mt-10">
          <div class="w-96">
               <?php echo $form->render(); ?>
          </div>
     </div>
</body>
</html>
``` 