<?php

class Label
{
  public string $id = "";
  public string $for = "";
  public string $text = "";
  public string $class = "text-sm font-medium text-stone-600 dark:text-stone-200";

  public function render(): string
  {
    $label = <<<HTML
      <label
        id="{$this->id}"
        for="{$this->for}"
        class="{$this->class}"
      >
        {$this->text}
      </label>
    HTML;

    return $label;
  }
}
