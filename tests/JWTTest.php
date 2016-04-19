<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\URL;

use App\Freelance\JWT;

class JWTTest extends TestCase
{

	protected $jwt;

	protected function setUp()
	{
		$this->jwt = new JWT('http://freelance.dev');
	}

  /**
   * Test that secrets generate appropriately
   *
   * @return [type] [description]
   */
  public function testGenerateSecret()
  {
  	$secret = $this->jwt->generateSecret()->getSecret();

  	$this->assertTrue(is_string($secret), 'Generated secret is a string.');
  	$this->assertTrue(strlen($secret) === 64, 'Generated secret is 64 characters long.');
  }

  /**
   * Test that tokens generate
   *
   * @return [type] [description]
   */
  public function testGenerateToken()
  {
    $token = $this->jwt->generateSecret()->createToken();

  	$this->assertTrue(is_string((string) $token), 'Generated token is a string.');
  }

  /**
   * Test that tokens validate properly
   *
   * @return [type] [description]
   */
  public function testTokenValidates()
  {
    $token = $this->jwt->setSecret('someSecret')->createToken();

    $this->assertTrue($this->jwt->verifyToken($token), 'Valid token is verified');

    $this->jwt->setSecret('someInvalidSecret');

    $this->assertEquals(false, $this->jwt->verifyToken($token), 'Token not valid with different secret.');
  }

}