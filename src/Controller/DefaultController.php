<?php
namespace MyApplication\Controller;
use Silex\Application;
use MyApplication\Entity\Producto;
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
    return $app["twig"]->render("home.twig", [
      "productos" => $this->productList(),
    ]);
  }

  public function productList()
  {
    return [
      1 => new Producto(1, "Producto 01", 200.00),
      2 => new Producto(2, "Producto 02", 200.00),
      3 => new Producto(3, "Producto 03", 200.00),
      4 => new Producto(4, "Producto 04", 200.00),
      5 => new Producto(5, "Producto 05", 200.00),
      6 => new Producto(6, "Producto 06", 200.00),
      7 => new Producto(7, "Producto 07", 200.00),
      8 => new Producto(8, "Producto 08", 200.00),
      9 => new Producto(9, "Producto 09", 200.00),
      10 => new Producto(10, "Producto 10", 200.00),
    ];
  }
}
