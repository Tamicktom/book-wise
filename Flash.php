<?php

class Flash
{

  public function push($key, $value)
  {
    $_SESSION["flash_$key"] = $value;
  }

  public function get($key)
  {
    if ($this->has($key)) {
      $value = $_SESSION["flash_$key"];
      return $value;
    }
    return null;
  }

  public function getAndClear($key)
  {
    if ($this->has($key)) {
      $value = $_SESSION["flash_$key"];
      unset($_SESSION["flash_$key"]);
      return $value;
    }
    return null;
  }

  public function has($key)
  {
    return isset($_SESSION["flash_$key"]);
  }

  public function clear($key)
  {
    if ($this->has($key)) {
      unset($_SESSION["flash_$key"]);
    }
  }
}
