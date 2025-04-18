<?php

require_once 'Internationalization.php';

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

class ValidationError
{
  private string $field;
  private string $code;
  private string $message;

  public function __construct(string $field, string $code, string $message)
  {
    $this->field = $field;
    $this->code = $code;
    $this->message = $message;
  }
  public function getField(): string
  {
    return $this->field;
  }
  public function getCode(): string
  {
    return $this->code;
  }
  public function getMessage(): string
  {
    return $this->message;
  }
}

class Validation
{
  private Schema $schema;
  private array $data;
  private array $errors = [];
  private array $parsedData = [];
  private bool $isValid = true;
  private Internationalization $intl;

  public function __construct(Schema $schema, array $data)
  {
    $this->schema = $schema;
    $this->data = $data;
    $this->intl = new Internationalization();
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
        $msg = $this->intl->t('validation.' . $key . '.errors.required');
        //serialize the object to store in session
        $this->errors[$key] = new ValidationError($key, 'required', $msg);
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
          // $this->errors[$key] = "Field $key is required.";
          $msg = $this->intl->t('validation.' . $key . '.errors.required');
          $this->errors[$key] = new ValidationError($key, 'required', $msg);
          $this->isValid = false;
        }
        break;
      case 'email':
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $msg = $this->intl->t('validation.' . $key . '.errors.invalid');
          // $this->errors[$key] = "Field $key must be a valid email address.";
          $this->errors[$key] = new ValidationError($key, 'email', $msg);
          $this->isValid = false;
        }
        break;
      default:
        if (preg_match('/^min:(\d+)$/', $rule, $matches)) {
          if (strlen($value) < (int)$matches[1]) {
            $msg = $this->intl->t('validation.' . $key . '.errors.min', ['min' => $matches[1]]);
            // $this->errors[$key] = "Field $key must be at least {$matches[1]} characters long.";
            $this->errors[$key] = new ValidationError($key, 'min', $msg);
            $this->isValid = false;
          }
        } elseif (preg_match('/^max:(\d+)$/', $rule, $matches)) {
          if (strlen($value) > (int)$matches[1]) {
            $msg = $this->intl->t('validation.' . $key . '.errors.max', ['max' => $matches[1]]);
            // $this->errors[$key] = "Field $key must be at most {$matches[1]} characters long.";
            $this->errors[$key] = new ValidationError($key, 'max', $msg);
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
