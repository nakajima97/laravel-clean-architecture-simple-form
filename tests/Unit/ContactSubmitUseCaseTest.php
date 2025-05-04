<?php

namespace Tests\Unit;

use App\Domain\Contact\ContactRepositoryInterface;
use App\UseCases\Contact\ContactSubmitUseCase;
use PHPUnit\Framework\TestCase;
use App\Domain\Contact\Contact;

class ContactSubmitUseCaseTest extends TestCase
{
    public function test_handle_calls_repository_save()
    {
        // Arrange: ContactRepositoryInterfaceのMock作成
        $mockRepo = $this->createMock(ContactRepositoryInterface::class);
        $mockRepo->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($contact) {
                return $contact instanceof Contact
                    && $contact->getName() === 'テストユーザー'
                    && $contact->getEmail() === 'test@example.com'
                    && $contact->getMessage() === 'テストメッセージ';
            }));

        $useCase = new ContactSubmitUseCase($mockRepo);

        // Act
        $useCase->handle('テストユーザー', 'test@example.com', 'テストメッセージ');
    }
}
