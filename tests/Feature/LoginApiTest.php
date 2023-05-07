<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ResponseTrait;

class LoginApiTest extends TestCase
{
    use ResponseTrait;

    /**
     * A basic feature test example.
     */
    public function test_valid_login(): void
    {
        $response = $this->json('POST', '/api/v1/login', [
            'email' => 'carro@gmail.com',
            'password' => 'qweqwe11',
        ]);

        $code = Response::HTTP_OK;

        $response->assertStatus($code);
        $response->assertJsonStructure([
            'data' => [
                "user" => [
                    "id",
                    "name",
                    "email",
                ]
            ],
            'meta' => [
                'token' => [
                    'type',
                    'token',
                    'expires_at',
                ]
            ]
        ]);
    }

    public function test_invalid_login()
    {
        $response = $this->json('POST', '/api/v1/login', [
            'email' => 'carro@gmail.com',
            'password' => 'testwrong',
        ]);

        $errorCode = Response::HTTP_UNPROCESSABLE_ENTITY;

        $response->assertStatus($errorCode);
        $response->assertJson([
            "errors" => [
                "code" => $errorCode,
                "code_msg" => Response::$statusTexts[$errorCode],
            ]
        ]);
    }
}
