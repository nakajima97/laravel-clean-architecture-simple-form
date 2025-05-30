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
     * @param  Contact  $contact  保存する問い合わせエンティティ
     */
    public function save(Contact $contact): void
    {
        EloquentContact::create([
            'name' => $contact->getName(),
            'email' => $contact->getEmail(),
            'message' => $contact->getMessage(),
        ]);
    }

    /**
     * すべての問い合わせ情報を取得する。
     * 作成日時の降順（新しい順）で返します。
     *
     * @return array<Contact> 問い合わせエンティティの配列
     */
    public function findAll(): array
    {
        $eloquentContacts = EloquentContact::orderBy('created_at', 'desc')->get();
        
        $contacts = [];
        foreach ($eloquentContacts as $eloquentContact) {
            $contacts[] = new Contact(
                $eloquentContact->name,
                $eloquentContact->email,
                $eloquentContact->message
            );
        }
        
        return $contacts;
    }
}
