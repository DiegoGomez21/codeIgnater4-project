<?php

declare(strict_types=1);



namespace Config;

use CodeIgniter\Shield\Config\AuthToken as ShieldAuthToken;


class AuthToken extends ShieldAuthToken
{
    
    public int $recordLoginAttempt = Auth::RECORD_LOGIN_ATTEMPT_FAILURE;

    
    public array $authenticatorHeader = [
        'tokens' => 'Authorization',
        'hmac'   => 'Authorization',
    ];

    
    public int $unusedTokenLifetime = YEAR;

    
    public int $secret2StorageLimit = 255;

    
    public int $hmacSecretKeyByteSize = 32;

    
    public $hmacEncryptionKeys = [
        'k1' => [
            'key' => '',
        ],
    ];

    
    public string $hmacEncryptionCurrentKey = 'k1';

    
    public string $hmacEncryptionDefaultDriver = 'OpenSSL';

    
    public string $hmacEncryptionDefaultDigest = 'SHA512';
}

