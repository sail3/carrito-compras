<?php
namespace MyApplication\Controller;
use Silex\Application;
use MyApplication\Command\DefaultCommand;
/**
 * Default application Controller.
 */
class DefaultController
{
  /**
   * Index Action.
   */
  public function index(Application $app)
  {
    $command = new DefaultCommand();
    return $app["twig"]->render("Layout.twig");
  }
}
