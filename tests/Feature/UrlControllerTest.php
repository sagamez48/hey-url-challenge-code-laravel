<?php namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UrlControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Create a new short URL');
    }

    public function testShow()
    {
        /* $this->client->request('GET', 'urls/2h312'); */
        /* Add tests */
    }

    public function testVisit()
    {
        /* $this->client->request('GET', 'urls/2h312'); */
        /* Add tests */
    }

    public function testCreate()
    {
        /* $this->client->request('POST', 'urls/'); */
        /* Add tests */
    }
}
