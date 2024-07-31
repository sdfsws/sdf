<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // اختياري: يمكنك إضافة هذا السطر لتجنب خطأ في حالة عدم وجود manifest.json
        $this->assertFileDoesNotExist(public_path('build/manifest.json'));
    }
}
