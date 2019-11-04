<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FrontendTest extends TestCase
{
    /**
     * Test the redirect to /charts.
     *
     * @return void
     */
    public function testRedirectTest()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    /**
     * Test /charts response code.
     *
     * @return void
     */
    public function testChartsResponseTest()
    {
        $response = $this->get('/charts');

        $response->assertStatus(200);
    }

    /**
     * Test rendering of retention curve chart.
     *
     * @return void
     */
    public function testRetentionCurveRenderTest()
    {
        $response = $this->get('/charts');

        $response->assertSee('Retention Curve Chart');
    }
}
