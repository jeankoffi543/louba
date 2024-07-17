<?php

namespace Tests\Unit;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {

       $date = Carbon::parse("Thu Jun 15 2023 13:45:43 GMT+0000");
       var_dump($date->format("d-m-Y"));
        $this->assertTrue(true);
    }
}
