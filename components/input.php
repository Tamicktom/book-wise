<?php

// function input() {
//   $input = <<<HTML
//     <input
//       type="text"
//       name="search"
//       id="search-input"
//       class="w-full max-w-xs p-2 text-sm transition-all border-2 rounded-md border-stone-800 bg-stone-100 text-stone-800 dark:text-stone-200 focus:outline-none focus:border-lime-500 dark:bg-stone-900 placeholder-stone-700 dark:placeholder-stone-300"
//       placeholder="Pesquisar"
//     />
//   HTML;

//   return $input;
// }

enum InputType: string
{
  case TEXT = "text";
  case EMAIL = "email";
  case PASSWORD = "password";
  case NUMBER = "number";
}

class Input
{
  public string $id = "";
  public string $name = "";
  public InputType $type = InputType::TEXT;
  public string $placeholder = "";
  public string $value = "";
  public string $class = "w-full max-w-xs p-2 text-sm transition-all border-2 rounded-md border-stone-800 bg-stone-100 text-stone-800 dark:text-stone-200 focus:outline-none focus:border-lime-500 dark:bg-stone-900 placeholder-stone-700 dark:placeholder-stone-300";

  public function render(): string
  {
    $input = <<<HTML
      <input
        type="{$this->type->value}"
        name="{$this->name}"
        id="{$this->id}"
        class="{$this->class}"
        placeholder="{$this->placeholder}"
        value="{$this->value}"
      />
    HTML;

    return $input;
  }
}
