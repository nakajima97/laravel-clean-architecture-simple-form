<?php

namespace App\Infrastructure\Eloquent;

use App\Domain\Contact\ContactRepositoryInterface;
use App\Domain\Contact\Contact;
use App\Models\Contact as EloquentContact;

class ContactRepository implements ContactRepositoryInterface
{
    public function save(Contact $contact): void
    {
        EloquentContact::create([
            'name' => $contact->getName(),
            'email' => $contact->getEmail(),
            'message' => $contact->getMessage(),
        ]);
    }
}
