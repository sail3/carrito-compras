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

}
