<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Contact;

class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_success()
    {
        $response = $this->postJson('/api/contact', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'message' => 'お問い合わせ内容'
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => '問い合わせを受け付けました。']);

        $this->assertDatabaseHas('contacts', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'message' => 'お問い合わせ内容'
        ]);
    }

    public function test_store_validation_error()
    {
        $response = $this->postJson('/api/contact', [
            'name' => '', // nameが空
            'email' => 'invalid-email',
            'message' => ''
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }

    public function test_store_email_too_long()
    {
        $longEmail = str_repeat('a', 256) . '@example.com';
        $response = $this->postJson('/api/contact', [
            'name' => 'テストユーザー',
            'email' => $longEmail,
            'message' => 'テスト'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }
}
