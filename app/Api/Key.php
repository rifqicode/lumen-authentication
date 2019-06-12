<?php

namespace App\Api;

/**
 *
 */
class Key
{
  protected $key = '123000123';

  public function getKey()
  {
    return $this->key;
  }

  public function validate(string $key = null)
  {
    if ($key == $this->getKey()) {
      return true;
    }
    return false;
  }

}

?>
