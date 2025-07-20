<?php

require_once 'components/component.php';

class Select implements Component
{
  public string $id = "";
  public string $name = "";
  public string $placeholder = "";
  public string $value = "";
  public bool $required = false;
  public string $class = "w-full p-2 text-sm transition-all border-2 rounded-md border-stone-300 dark:border-stone-800 bg-stone-100 text-stone-800 dark:text-stone-200 focus:outline-none focus:border-lime-500 dark:bg-stone-900 placeholder-stone-700 dark:placeholder-stone-300";

  /**
   * Every option should be an associative array with 'value' and 'text' keys.
   * Example: ['value' => '1', 'text' => 'Option 1']
   * The key will be used as the value of the option, and the text will be
   * displayed to the user.
   * 
   * @example
   * $options = [
   *   '1' => 'Option 1',
   *   '2' => 'Option 2',
   *   '3' => 'Option 3',
   * ];
   */
  public array $options = [];

  public function render(): string
  {
    $options_html = '';
    foreach ($this->options as $option_value => $option_text) {
      $selected = ($this->value === $option_value) ? 'selected' : '';
      $options_html .= "<option value=\"$option_value\" $selected>$option_text</option>";
    }

    return <<<HTML
      <select
        id="{$this->id}"
        name="{$this->name}"
        class="{$this->class}"
        required="{$this->required}"
      >
        <option value="" disabled selected>{$this->placeholder}</option>
        {$options_html}
      </select>
    HTML;
  }
}
