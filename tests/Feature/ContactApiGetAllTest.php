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
}
