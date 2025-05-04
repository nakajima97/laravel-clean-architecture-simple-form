<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactApiGetAllTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 問い合わせ情報が全て取得できるか確認するテスト
     */
    public function test_index_returns_all_contacts()
    {
        // テスト用のダミーデータを3件作成
        Contact::factory()->count(3)->create();

        // APIエンドポイントにGETリクエストを送信
        $response = $this->getJson('/api/contacts');

        // レスポンスのステータスコードが200であることを確認
        $response->assertStatus(200);

        // レスポンスの構造を確認
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'email',
                    'message'
                ]
            ]
        ]);

        // データベースに保存されている件数と一致することを確認
        $this->assertCount(3, $response->json('data'));
    }

    /**
     * 問い合わせ情報が存在しない場合に空の配列が返されることを確認するテスト
     */
    public function test_index_returns_empty_array_when_no_contacts()
    {
        // APIエンドポイントにGETリクエストを送信
        $response = $this->getJson('/api/contacts');

        // レスポンスのステータスコードが200であることを確認
        $response->assertStatus(200);

        // 空の配列が返されることを確認
        $response->assertJson([
            'data' => []
        ]);
    }

    /**
     * 特定のデータが正しく取得できるか確認するテスト
     */
    public function test_index_returns_correct_contact_data()
    {
        // 特定のデータを持つ問い合わせを作成
        $contact = Contact::factory()->create([
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'message' => 'これはテストメッセージです。'
        ]);

        // APIエンドポイントにGETリクエストを送信
        $response = $this->getJson('/api/contacts');

        // レスポンスのステータスコードが200であることを確認
        $response->assertStatus(200);

        // 特定のデータが含まれていることを確認
        $response->assertJson([
            'data' => [
                [
                    'name' => 'テスト太郎',
                    'email' => 'test@example.com',
                    'message' => 'これはテストメッセージです。'
                ]
            ]
        ]);
    }

    /**
     * 複数の問い合わせが正しい順序で取得できるか確認するテスト
     */
    public function test_index_returns_contacts_in_correct_order()
    {
        // 日付の異なる問い合わせを作成（新しい順に並ぶことを想定）
        $oldContact = Contact::factory()->create([
            'name' => '古いユーザー',
            'created_at' => now()->subDays(2)
        ]);
        
        $newContact = Contact::factory()->create([
            'name' => '新しいユーザー',
            'created_at' => now()
        ]);

        // APIエンドポイントにGETリクエストを送信
        $response = $this->getJson('/api/contacts');

        // データが正しい順序で返されていることを確認
        // 注: デフォルトでは新しい順（created_at DESC）を想定
        $data = $response->json('data');
        $this->assertEquals('新しいユーザー', $data[0]['name']);
        $this->assertEquals('古いユーザー', $data[1]['name']);
    }

    /**
     * 大量のデータがある場合でも正しく取得できるか確認するテスト
     */
    public function test_index_handles_large_number_of_contacts()
    {
        // 多数の問い合わせデータを作成
        Contact::factory()->count(50)->create();

        // APIエンドポイントにGETリクエストを送信
        $response = $this->getJson('/api/contacts');

        // レスポンスのステータスコードが200であることを確認
        $response->assertStatus(200);

        // 全てのデータが取得できていることを確認
        $this->assertCount(50, $response->json('data'));
    }
}
