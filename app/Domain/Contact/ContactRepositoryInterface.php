<?php

namespace App\Domain\Contact;

interface ContactRepositoryInterface
{
    public function save(Contact $contact): void;
}
