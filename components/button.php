<?php

enum ButtonType: string
{
  case BUTTON = "button";
  case SUBMIT = "submit";
  case RESET = "reset";
}

class Button
{
  public string $id = "";
  public string $name = "";
  public string $text = "";
  public string $class = "px-4 py-2 text-sm font-bold text-center text-white transition-all rounded-md bg-lime-500 hover:bg-lime-600 focus:outline-none focus:ring focus:ring-lime-300 dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-500";
  public ButtonType $type = ButtonType::BUTTON;
  public bool $disabled = false;

  public function render(): string
  {
    $disabled = $this->disabled ? 'disabled' : '';

    return <<<HTML
      <button
        id="{$this->id}"
        name="{$this->name}"
        type="{$this->type->value}"
        class="{$this->class}"
        $disabled
      >
        {$this->text}
      </button>
    HTML;
  }
}
