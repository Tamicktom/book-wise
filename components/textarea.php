<?php

require_once 'components/component.php';

class Textarea implements Component
{
  public string $id = "";
  public string $name = "";
  public string $placeholder = "";
  public string $value = "";
  public bool $required = false;
  public string $class = "w-full p-2 text-sm transition-all border-2 rounded-md border-stone-300 dark:border-stone-800 bg-stone-100 text-stone-800 dark:text-stone-200 focus:outline-none focus:border-lime-500 dark:bg-stone-900 placeholder-stone-700 dark:placeholder-stone-300";

  public function render(): string
  {
    $textarea = <<<HTML
      <textarea
        id="{$this->id}"
        name="{$this->name}"
        class="{$this->class}"
        placeholder="{$this->placeholder}"
        required="{$this->required}"
      >{$this->value}</textarea>
    HTML;

    return $textarea;
  }
}
