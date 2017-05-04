<?php
namespace MyApplication\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
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

  /**
   * Agrega un producto al carrito.
   */
  public function addItem(Application $app, Request $request)
  {
    $response = [
      'status' => 500,
      'msg' => 'Lack parameters',
    ];
    if ($request->get('productCode') !== '' && $request->get('productCode') !== null) {
      $quantity = 0;
      $total = 0;
      $carrito = $app['session']->get('car', []);
      @$carrito[$request->get('productCode')]++;
      $app['session']->set('car', $carrito);
      $productList = $this->productList();
      foreach ($carrito as $key => $value) {
        $quantity += $value;
        $total += $productList[$key]->getPrecio() * $value;
      }
      $response = [
        'status' => 200,
        'msg' => 'Success',
        'quantity' => $quantity,
        'total' => $total,
      ];
    }
    return new JsonResponse($response);
  }

  /**
   * Muestra el detalle del carrito de compras.
   */
  public function store(Application $app)
  {
    $car = [];
    $total = 0.0;
    $productos = $this->productList();
    $carrito = $app['session']->get('car', []);
    foreach ($carrito as $key => $value) {
      $producto = $productos[$key];
      $subTotal = $producto->getPrecio() * $value;
      $car[] = [
        "cantidad" => $value,
        "producto" => $producto,
        "subTotal" => $subTotal,
      ];
      $total += $subTotal;
    }
    return $app['twig']->render('car.twig', [
      "productos" => $car,
      "import" => $total,
    ]);
  }

  /**
   * Edita una orden.
   */
  public function editOrder(Application $app, Request $request)
  {

    $response = [
      'status' => 500,
      'msg' => 'Lack parameters',
    ];
    if ($request->get('productCode') !== '' && $request->get('productCode') !== null &&
        $request->get('quantity') !== '' && $request->get('quantity') !== null ) {
      $codigoProducto = $request->get('productCode');
      $cantidadActual = $request->get('quantity');
      $carrito = $app['session']->get('car', []);
      $carrito[$codigoProducto] = $cantidadActual;
      $app['session']->set('car', $carrito);
      $response = [
        'status' => 200,
        'msg' => 'Success',
      ];
    }
    return new JsonResponse($response);
  }

  /**
   * Devuelve la lista de productos disponibles.
   */
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
