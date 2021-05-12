<?php

class Exception extends RuntimeException
{
  /**
   * Prettify error message output.
   *
   * @return string
   */
  public function errorMessage()
  {
    return '<strong>' . htmlspecialchars($this->getMessage()) . "</strong><br />\n";
  }
}
