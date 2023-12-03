<?php

namespace Tests\Unit;

use App\Services\TranslatorService;
use Tests\TestCase;

class TranslatorServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {

        /**
         * @var TranslatorService $translator
         */
        $translator = app()->get(TranslatorService::class);
        $hello = "Hello";
        $result =  $translator->translate($hello,'uk');
        $this->assertEquals("Привіт", $result);
        $this->assertInstanceOf(TranslatorService::class, $translator);
    }
}
