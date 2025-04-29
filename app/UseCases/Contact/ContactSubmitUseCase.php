<?php

namespace App\UseCases\Contact;

use App\Domain\Contact\Contact;
use App\Domain\Contact\ContactRepositoryInterface;

class ContactSubmitUseCase
{
    private ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function handle(string $name, string $email, string $message): void
    {
        $contact = new Contact($name, $email, $message);

        $this->contactRepository->save($contact);
    }
}
