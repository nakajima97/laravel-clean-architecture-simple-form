<?php

namespace App\UseCases\Contact;

use App\Domain\Contact\ContactRepositoryInterface;

/**
 * すべての問い合わせ情報を取得するユースケース。
 *
 * リポジトリを介して保存されたすべての問い合わせデータを取得します。
 */
class GetAllContactsUseCase
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
     * すべての問い合わせデータを取得するユースケースの実行。
     *
     * @return array 問い合わせデータの配列
     */
    public function handle(): array
    {
        $contacts = $this->contactRepository->findAll();
        
        // ドメインエンティティをレスポンス用の配列に変換
        $result = [];
        foreach ($contacts as $contact) {
            $result[] = [
                'name' => $contact->getName(),
                'email' => $contact->getEmail(),
                'message' => $contact->getMessage(),
            ];
        }
        
        return $result;
    }
}
