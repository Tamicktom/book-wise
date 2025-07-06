<?php

// import AppLanguage enum from App\Enums namespace

use App\Enums\AppLanguage;

require_once "enums/AppLanguage.php";

class Internationalization
{
  private array $dictionary = [];
  private AppLanguage $lang = AppLanguage::EN;

  public function __construct()
  {
    $this->initLanguage();
    $this->loadDictionary();
  }

  private function initLanguage(): void
  {
    $browser_language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $uppercase_language = strtoupper($browser_language);
    $this->lang = match ($uppercase_language) {
      'PT' => AppLanguage::PT,
      'PT-BR' => AppLanguage::PT,
      'EN' => AppLanguage::EN,
      default => AppLanguage::EN,
    };
  }

  // load dictionary from .json file
  private function loadDictionary(): void
  {
    $filePath = __DIR__ . "/lang/{$this->lang->value}.json";
    if (file_exists($filePath)) {
      $this->dictionary = json_decode(file_get_contents($filePath), true);
    } else {
      throw new Exception("Language file not found: {$filePath}");
    }
  }

  /**
   * Translate a key to the current language
   * 
   * @param string $key
   * @param array $params
   * @return string
   * 
   * example usage:
   * 
   * ## Example 1
   * 
   * ```php
   * <h1><?= $intl->t('welcome_message', ['name' => 'John']) ?></h1>
   * ```
   * 
   * will render:
   * 
   * ```html
   * <h1>Welcome, John!</h1>
   * ```
   * 
   * ## Example 2
   * 
   * ```php
   * <span><?= $intl->t('validation.name.errors.required') ?></span>
   * ```
   * 
   * will render:
   * 
   * ```html
   * <span>Name is required</span>
   * ```
   */

  public function t(string $key, array $params = []): string
  {
    // check if is a nested key
    if (strpos($key, '.') !== false) {
      $keys = explode('.', $key);
      $value = $this->dictionary;
      foreach ($keys as $k) {
        if (isset($value[$k])) {
          $value = $value[$k];
        } else {
          return $key; // return the key if not found
        }
      }
    } else {
      $value = $this->dictionary[$key] ?? $key; // return the key if not found
    }

    // replace params in the string
    if (!empty($params)) {
      foreach ($params as $param_key => $param_value) {
        $value = str_replace('{' . $param_key . '}', $param_value, $value);
      }
    }

    return $value;
  }

  public function getLanguage(): AppLanguage
  {
    return $this->lang;
  }
  public function getDictionary(): array
  {
    return $this->dictionary;
  }
}
