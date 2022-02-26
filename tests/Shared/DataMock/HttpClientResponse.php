<?php

namespace App\Tests\Shared\DataMock;

final class HttpClientResponse
{
    public static function response() : string {
        return '{"statusCode":200}';
    }
}