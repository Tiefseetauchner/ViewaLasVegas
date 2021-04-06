<?php

namespace ViewaLasVegas;

spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});

function var_dump_pre($mixed = null)
{
  echo '<pre>';
  echo htmlspecialchars(var_dump_ret($mixed));
  echo '</pre>';
  return null;
}

function var_dump_ret($mixed = null) {
  ob_start();
  var_dump($mixed);
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

function run_commands($template)
{
  preg_match_all("/[{]{2} START (\p{L}+) (.*) [}]{2}/ui", $template, $matches);
  var_dump_pre($matches);
  echo "<hr>";

  for ($i = 0; $i < count($matches[0]); $i++) {
    switch ($matches[1][$i]) {
      case "LOOP":
        run_loop($template, $matches[2][$i]);
    }
  }
}

function run_loop($template, $args)
{
  $loopName = explode(" ", $args)[0];
  preg_match("/[{]{2} START LOOP $args [}]{2}" .
    ".*" .
    "[{]{2} END $loopName [}]{2}/uis",
    $template, $loopMatch);
  var_dump_pre($this->{$loopName});
  var_dump_pre($loopMatch);
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

run_commands($template);

echo $template;