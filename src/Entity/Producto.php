<?php
namespace MyApplication\Entity;
/**
 * Clase entidad para los productos.
 */
class Producto
{
  private $codigo;
  private $nombre;
  private $precio;

  public function __construct($codigo = "", $nombre = "", $precio = 0.0)
  {
    $this->codigo = $codigo;
    $this->nombre = $nombre;
    $this->precio = $precio;
  }

  public function setCodigo($codigo)
  {
    $this->codigo = $codigo;
    return $this;
  }
  public function getCodigo()
  {
    return $this->codigo;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
    return $this;
  }
  public function getNombre()
  {
    return $this->nombre;
  }
  public function setPrecio($precio)
  {
    $this->precio = $precio;
    return $this;
  }
  public function getPrecio()
  {
    return $this->precio;
  }
}
