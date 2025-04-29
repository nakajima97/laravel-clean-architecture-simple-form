<?php

namespace App\UseCases\Contact;

use App\Domain\Contact\Contact;
use App\Domain\Contact\ContactRepositoryInterface;

/**
 * 問い合わせ送信ユースケース。
 *
 * バリデーション済みの問い合わせデータを受け取り、リポジトリを介して保存処理を行います。
 */
class ContactSubmitUseCase
{
    /**
     * @var ContactRepositoryInterface 問い合わせリポジトリ
     */
    private ContactRepositoryInterface $contactRepository;

    /**
     * コンストラクタ。
     *
     * @param  ContactRepositoryInterface  $contactRepository  問い合わせリポジトリ
     */
    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * 問い合わせデータを保存するユースケースの実行。
     *
     * @param  string  $name  ユーザー名
     * @param  string  $email  メールアドレス
     * @param  string  $message  問い合わせメッセージ
     */
    public function handle(string $name, string $email, string $message): void
    {
        $contact = new Contact($name, $email, $message);
        $this->contactRepository->save($contact);
    }
}
