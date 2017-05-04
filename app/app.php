<?php
require __DIR__ . "/../vendor/autoload.php";

$app = new Silex\Application();

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  "twig.path" => __DIR__ . "/../src/View",
));

// Routes
$app->get("/", "MyApplication\Controller\DefaultController::index");
$app->post("/add", "MyApplication\Controller\DefaultController::addItem");
$app->get("/my-car", "MyApplication\Controller\DefaultController::store");
$app->post("/edit-order", "MyApplication\Controller\DefaultController::editOrder");

return $app;
