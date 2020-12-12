<?php

namespace Performing\Wait\Tests;

use Performing\Wait\Spinner;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function assert_wait_function_waits()
    {
        $start = microtime(true);
        ob_start();

        wait("I'm busy...", function (Spinner $spinner) {
            sleep(1);
        });

        $end = microtime(true);
        $output = ob_get_clean();

        $this->assertStringContainsStringIgnoringCase("I'm busy...", $output);
        $this->assertTrue($end - $start >= 1);
    }
}
