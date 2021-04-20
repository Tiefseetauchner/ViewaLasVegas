<?php

namespace ViewaLasVegas;

use TYPO3Fluid\Fluid\Core\Cache\SimpleFileCache;
use TYPO3Fluid\Fluid\View\TemplateView;

//require "../vendor/autoload.php";

spl_autoload_register(function ($class) {
  if (strpos($class, 'ViewaLasVegas'))
    var_dump($class);
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

$view = new TemplateView();

$paths = $view->getTemplatePaths();
$view->assignMultiple([
  'asdf' => $hotels,
]);

$view->setCache(new SimpleFileCache("/cache/"));

$paths->setTemplatePathAndFilename("template.html");

$output = $view->render();

echo $output;
//$paths->setTemplateRootPaths(array("/templates/"));
//$paths->setTemplateRootPaths(array("/layouts/"));
//$paths->setTemplateRootPaths(array("/layouts/"));