<?php

namespace ViewaLasVegas;

spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});

$hotels = [
  new Hotel("The Casino For all",
    "You heard of Casino Royal, well, we aren't royal, we're so trash that only plebs can afford being seen here!",
    "'MURICA 124", "Las Vegas"),
  new Hotel("Allergika",
    "We aren't a Casino. We are a pharmaceutical company. The Webdev refuses to remove us, help!",
    "ALLERGIKA Pharma GmbH", "82515 Wolfratshausen"),
  new Hotel("Heuriger zum Heuberg",
    "Ana is ummi kumman und wuit a vorstöung. Mia sans Schutzhaus do am Heuberg, warum suin ma da wos schreim",
    "A stroßn in Wean", "1170 Wien"),
];

$template = readfile("template.html");

echo $template;