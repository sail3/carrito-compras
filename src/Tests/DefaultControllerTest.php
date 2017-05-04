<?php
namespace MyApplication\Tests;

use Silex\WebTestCase;
/**
 *
 */
class DefaultControllerTest extends WebTestCase
{

  public function createApplication()
  {
    $app = require __DIR__."/../../app/app.php";
    $app['debug'] = true;
    unset($app['exception_handler']);
    $app['session.test'] = true;

    return $app;
  }

  /**
   * Valida la integridad del la pagina Home.
   */
  public function testHomePage()
  {
    $client = $this->createClient();
    $client->request('GET', '/');
    $crawler = $client->getCrawler();

    $this->assertTrue($client->getResponse()->isOk());
    $this->assertGreaterThan(0, $crawler->filter('h1')->count());
    $this->assertGreaterThan(0, $crawler->filter('div.well>button.adding')->count());

  }

  /**
   * Prueba si se puede registrar un producto en el carrito.
   */
  public function testCanBeAddItem()
  {
    $client = $this->createClient();
    $productCode = rand(1, 10);
    $data = [
      'productCode' => $productCode,
    ];
    $client->request('POST', '/add', $data);
    $response = $client->getResponse();
    $responseData = json_decode($response->getContent(),true);

    $this->assertTrue($client->getResponse()->isOk());
    $this->assertEquals(200, $responseData['status']);
    $this->assertEquals('Success', $responseData['msg']);
    $this->assertInternalType('int', $responseData['quantity']);
    $this->assertInternalType('int', $responseData['total']);
  }

  public function testStore()
  {
    $client = $this->createClient();
    $client->request('GET', '/my-car');
    $crawler = $client->getCrawler();

    $this->assertTrue($client->getResponse()->isOk());
    $this->assertGreaterThan(0, $crawler->filter('h1')->count());
    $this->assertGreaterThan(0, $crawler->filter('.btn-success')->count());
    $this->assertGreaterThan(0, $crawler->filter('.btn-danger')->count());
  }

}
