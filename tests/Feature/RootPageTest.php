<?php

namespace Tests\Feature;

use Tests\TestCase;

class RootPageTest extends TestCase
{
    public function testHomeRequest()
    {
        $response = $this->get(route('home'));
        $response->assertOk();
    }
}
