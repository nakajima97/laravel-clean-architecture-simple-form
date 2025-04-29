<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * contactsテーブルに対応するEloquentモデル。
 *
 * 問い合わせデータの永続化を担います。
 */
class Contact extends Model
{
    // ダミーデータを生成できるようにする
    use HasFactory;

    /**
     * ホワイトリスト項目
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
