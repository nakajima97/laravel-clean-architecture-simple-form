<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\UseCases\Contact\ContactSubmitUseCase;
use App\UseCases\Contact\GetAllContactsUseCase;

/**
 * 問い合わせAPI用コントローラー。
 *
 * このコントローラーは、問い合わせフォームからのリクエストを受け付け、
 * バリデーション後にユースケースへデータを渡して保存処理を行います。
 */
class ContactController extends Controller
{
    /**
     * 問い合わせ送信ユースケース
     */
    private ContactSubmitUseCase $contactSubmitUseCase;

    /**
     * 問い合わせ取得ユースケース
     */
    private GetAllContactsUseCase $getAllContactsUseCase;

    /**
     * ContactController コンストラクタ。
     *
     * @param  ContactSubmitUseCase  $contactSubmitUseCase  問い合わせ送信ユースケース
     * @param  GetAllContactsUseCase  $getAllContactsUseCase  問い合わせ取得ユースケース
     */
    public function __construct(
        ContactSubmitUseCase $contactSubmitUseCase,
        GetAllContactsUseCase $getAllContactsUseCase
    ) {
        $this->contactSubmitUseCase = $contactSubmitUseCase;
        $this->getAllContactsUseCase = $getAllContactsUseCase;
    }

    /**
     * 問い合わせデータを受け取り保存するAPIエンドポイント。
     *
     * @param  ContactRequest  $request  バリデーション済みリクエスト
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContactRequest $request)
    {
        $validatedData = $request->validated();

        $this->contactSubmitUseCase->handle(
            $validatedData['name'],
            $validatedData['email'],
            $validatedData['message']
        );

        return response()->json([
            'message' => '問い合わせを受け付けました。',
        ], 201);
    }

    /**
     * すべての問い合わせデータを取得するAPIエンドポイント。
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $contacts = $this->getAllContactsUseCase->handle();

        return response()->json([
            'data' => $contacts,
        ]);
    }
}
