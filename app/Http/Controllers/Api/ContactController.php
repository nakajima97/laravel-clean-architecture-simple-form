<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        // ここではまだ保存処理はしない（UseCaseに渡すだけ）
        $validatedData = $request->validated();

        // この段階では仮でレスポンスだけ返す
        return response()->json([
            'message' => 'バリデーション成功！',
            'data' => $validatedData,
        ], 201);
    }
}
