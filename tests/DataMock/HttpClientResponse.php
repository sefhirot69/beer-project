<?php

namespace App\Tests\DataMock;

final class HttpClientResponse
{
    public static function response() : string {
        return '{"statusCode":200}';
    }
}