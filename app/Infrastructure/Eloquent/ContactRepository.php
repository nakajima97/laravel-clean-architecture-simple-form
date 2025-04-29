<?php

namespace App\Infrastructure\Eloquent;

use App\Domain\Contact\Contact;
use App\Domain\Contact\ContactRepositoryInterface;
use App\Models\Contact as EloquentContact;

/**
 * Eloquentを用いた問い合わせリポジトリの実装。
 *
 * 問い合わせエンティティをデータベースに保存します。
 */
class ContactRepository implements ContactRepositoryInterface
{
    /**
     * 問い合わせ情報をDBに保存する。
     *
     * @param Contact $contact 保存する問い合わせエンティティ
     * @return void
     */
    public function save(Contact $contact): void
    {
        EloquentContact::create([
            'name' => $contact->getName(),
            'email' => $contact->getEmail(),
            'message' => $contact->getMessage(),
        ]);
    }
}
