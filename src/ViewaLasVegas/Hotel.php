<?php


namespace ViewaLasVegas;


class Hotel
{
  public $name;
  public $description;
  public $addressLine;
  public $city;

  /**
   * Hotel constructor.
   * @param $name
   * @param $description
   * @param $addressLine
   * @param $city
   */
  public function __construct($name, $description, $addressLine, $city)
  {
    $this->name = $name;
    $this->description = $description;
    $this->addressLine = $addressLine;
    $this->city = $city;
  }

}