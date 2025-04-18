<?php

/**
 * Final result usage:
 * 
 * $schema = new Schema([
 *  'name' => ['required', 'min:3', 'max:255'],
 *  'email' => ['required', 'email'],
 *  'password' => ['required', 'min:6', 'max:255'],
 *  'confirm_password' => ['required', 'min:6', 'max:255'],
 * ]);
 * 
 * $safeParsed = Validation::parse($schema, $_POST);
 * 
 * if ($safeParsed->isValid()) {
 *  // do something with the data
 * }
 */


class Schema
{
  private array $rules = [];

  public function __construct(array $rules)
  {
    $this->rules = $rules;
  }

  public function getRules()
  {
    return $this->rules;
  }

  public function getRule($key)
  {
    return $this->rules[$key] ?? null;
  }

  public function setRule($key, $rule)
  {
    $this->rules[$key] = $rule;
  }
}

class Validation
{
  private Schema $schema;
  private array $data;
  private array $errors = [];
  private array $parsedData = [];
  private bool $isValid = true;

  public function __construct(Schema $schema, array $data)
  {
    $this->schema = $schema;
    $this->data = $data;
  }
  public static function parse(Schema $schema, array $data)
  {
    $validation = new self($schema, $data);
    $validation->validate();
    return $validation;
  }
  public function validate()
  {
    foreach ($this->schema->getRules() as $key => $rules) {
      if (isset($this->data[$key])) {
        $this->parsedData[$key] = $this->data[$key];
        foreach ($rules as $rule) {
          $this->applyRule($key, $rule);
        }
      } else {
        $this->errors[$key] = "Field $key is required.";
        $this->isValid = false;
      }
    }
  }
  private function applyRule($key, $rule)
  {
    $value = $this->data[$key];
    switch ($rule) {
      case 'required':
        if (empty($value)) {
          $this->errors[$key] = "Field $key is required.";
          $this->isValid = false;
        }
        break;
      case 'email':
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $this->errors[$key] = "Field $key must be a valid email address.";
          $this->isValid = false;
        }
        break;
      default:
        if (preg_match('/^min:(\d+)$/', $rule, $matches)) {
          if (strlen($value) < (int)$matches[1]) {
            $this->errors[$key] = "Field $key must be at least {$matches[1]} characters long.";
            $this->isValid = false;
          }
        } elseif (preg_match('/^max:(\d+)$/', $rule, $matches)) {
          if (strlen($value) > (int)$matches[1]) {
            $this->errors[$key] = "Field $key must be at most {$matches[1]} characters long.";
            $this->isValid = false;
          }
        }
        break;
    }
  }
  public function isValid()
  {
    return $this->isValid;
  }
  public function getErrors()
  {
    return $this->errors;
  }
  public function getParsedData()
  {
    return $this->parsedData;
  }
  public function getSchema()
  {
    return $this->schema;
  }
  public function getData()
  {
    return $this->data;
  }
}
