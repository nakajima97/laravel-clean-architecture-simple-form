<?php

namespace Tests\Unit;

use App\Domain\Contact\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    public function test_contact_getters()
    {
        $contact = new Contact('ユーザー', 'user@example.com', 'メッセージ');
        $this->assertSame('ユーザー', $contact->getName());
        $this->assertSame('user@example.com', $contact->getEmail());
        $this->assertSame('メッセージ', $contact->getMessage());
    }
}