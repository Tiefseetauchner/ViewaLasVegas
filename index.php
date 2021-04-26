<?php

namespace ViewaLasVegas;

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/vendor/autoload.php';

include 'ViewaLasVegas/Hotel.php';

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

$app = AppFactory::create();

$twig = Twig::create('/templates', ['cache' => '/cache']);

$app->add(TwigMiddleware::create($app, $twig));

// Define named route
$app->get('/hello/{name}', function ($request, $response, $args) {
  $view = Twig::fromRequest($request);
  return $view->render($response, 'template.html', [
    'name' => $args['name']
  ]);
})->setName('profile');

// Render from string
$app->get('/hi/{name}', function ($request, $response, $args) {
  $view = Twig::fromRequest($request);
  $str = $view->fetchFromString(
    '<p>Hi, my name is {{ name }}.</p>',
    [
      'name' => $args['name']
    ]
  );
  $response->getBody()->write($str);
  return $response;
});

// Run app
$app->run();