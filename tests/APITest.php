<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class APITest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAPIGet()
    {
        $this->get('/api/file/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }
}
