<?php

namespace Sashagm\Payment\Tests\Feature;


use Sashagm\Payment\Tests\TestCase;
use Illuminate\Support\Facades\Route;

class WaitTest extends TestCase
{
/** @test */
	public function test_location_waits(): void
	{
		Route::get('/payment', function() {
			return response('<a href="/b">Go to B</a>', headers: ['Content-Type' => 'text/html']);
		});
		
		
		
		
	}
}