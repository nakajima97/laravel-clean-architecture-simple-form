<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\UseCases\Contact\ContactSubmitUseCase;

class ContactController extends Controller
{
    private ContactSubmitUseCase $contactSubmitUseCase;

    public function __construct(ContactSubmitUseCase $contactSubmitUseCase)
    {
        $this->contactSubmitUseCase = $contactSubmitUseCase;
    }

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
}
