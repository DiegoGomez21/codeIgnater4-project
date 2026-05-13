<?php

namespace App\Services;

use Config\Services;
use Throwable;

class TelefonoCipherService
{
    private const PREFIX = 'enc::';

    public function encrypt(?string $value): ?string
    {
        if ($value === null || $value === '') {
            return $value;
        }

        if (str_starts_with($value, self::PREFIX)) {
            return $value;
        }

        $encrypted = Services::encrypter()->encrypt($value);

        return self::PREFIX . base64_encode($encrypted);
    }

    public function decrypt(?string $value): ?string
    {
        if ($value === null || $value === '') {
            return $value;
        }

        if (! str_starts_with($value, self::PREFIX)) {
            return $value;
        }

        $payload = substr($value, strlen(self::PREFIX));
        $binary  = base64_decode($payload, true);

        if ($binary === false) {
            return $value;
        }

        try {
            return (string) Services::encrypter()->decrypt($binary);
        } catch (Throwable) {
            return $value;
        }
    }
}