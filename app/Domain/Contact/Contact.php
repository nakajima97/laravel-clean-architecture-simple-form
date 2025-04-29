<?php

namespace App\Domain\Contact;

/**
 * 問い合わせ情報を表すドメインエンティティ。
 *
 * このクラスは、ユーザーから送信された問い合わせ内容（名前、メールアドレス、メッセージ）を保持します。
 */
class Contact
{
    /**
     * ユーザー名
     * @var string
     */
    private string $name;

    /**
     * メールアドレス
     * @var string
     */
    private string $email;

    /**
     * 問い合わせメッセージ
     * @var string
     */
    private string $message;

    /**
     * Contact コンストラクタ。
     *
     * @param string $name    ユーザー名
     * @param string $email   メールアドレス
     * @param string $message 問い合わせメッセージ
     */
    public function __construct(string $name, string $email, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * ユーザー名を取得
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * メールアドレスを取得
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * 問い合わせメッセージを取得
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
