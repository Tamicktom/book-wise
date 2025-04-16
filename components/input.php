<?php

enum InputType: string
{
  case TEXT = "text";
  case EMAIL = "email";
  case PASSWORD = "password";
  case NUMBER = "number";
}

class Input
{
  public bool $required = false;
  public bool $disabled = false;
  public string $id = "";
  public string $name = "";
  public InputType $type = InputType::TEXT;
  public string $placeholder = "";
  public string $value = "";
  public string $class = "w-full max-w-xs p-2 text-sm transition-all border-2 rounded-md border-stone-800 bg-stone-100 text-stone-800 dark:text-stone-200 focus:outline-none focus:border-lime-500 dark:bg-stone-900 placeholder-stone-700 dark:placeholder-stone-300";

  public function render(): string
  {
    $disabled = $this->disabled ? 'disabled' : '';
    $required = $this->required ? 'required' : '';

    $input = <<<HTML
      <input
        id="{$this->id}"
        name="{$this->name}"
        type="{$this->type->value}"
        class="{$this->class}"
        placeholder="{$this->placeholder}"
        value="{$this->value}"
        $disabled
        $required
      />
    HTML;

    return $input;
  }
}
