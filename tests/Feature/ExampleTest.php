<?php

namespace Sashagm\Payment\Tests\Tests\Feature;


class ExampleTest extends \Orchestra\Testbench\TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_page()
    {   
        $response = $this->get('/');

        ray($response);
        //$this->assertTrue(true);
    }
}
