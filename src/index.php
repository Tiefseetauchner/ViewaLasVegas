<?php

namespace ViewaLasVegas;

spl_autoload_register(function ($class) {

  // project-specific namespace prefix
  $prefix = 'ViewaLasVegas\\';

  // base directory for the namespace prefix
  $base_dir = __DIR__ . '/src/';

  // does the class use the namespace prefix?
  $len = strlen($prefix);
  if (strncmp($prefix, $class, $len) !== 0) {
    // no, move to the next registered autoloader
    return;
  }

  // get the relative class name
  $relative_class = substr($class, $len);

  // replace the namespace prefix with the base directory, replace namespace
  // separators with directory separators in the relative class name, append
  // with .php
  $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

  // if the file exists, require it
  if (file_exists($file)) {
    require $file;
  }
});

function var_dump_pre($mixed = null)
{
  echo '<pre>';
  echo htmlspecialchars(var_dump_ret($mixed));
  echo '</pre>';
  return null;
}

function var_dump_ret($mixed = null)
{
  ob_start();
  var_dump($mixed);
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

function insertHotels($template, $placeholder, array $data)
{
  $content = "<table>";

  foreach ($data as $dataELement) {
    $content .= "<tr>";
    $content .= "<td>" . $dataELement->name . "</td>";
    $content .= "<td>" . $dataELement->description . "</td>";
    $content .= "<td>" . $dataELement->addressLine . "<br />" . $dataELement->city . "</td>";
    $content .= "</tr>";
  }

  $content .= "</table>";

  return str_replace($placeholder, $content, $template);
}

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

$template = file_get_contents("template.html");

$template = insertHotels($template, "{{ HOTELS }}", $hotels);

echo $template;