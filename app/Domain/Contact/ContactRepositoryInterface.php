<?php

namespace App\Domain\Contact;

/**
 * 問い合わせリポジトリのインターフェース。
 *
 * ドメイン層から問い合わせ情報の永続化処理を抽象化するためのインターフェースです。
 * 実装クラスはインフラ層で用意します。
 */
interface ContactRepositoryInterface
{
    /**
     * 問い合わせ情報を保存する。
     *
     * @param  Contact  $contact  保存する問い合わせエンティティ
     */
    public function save(Contact $contact): void;
}
