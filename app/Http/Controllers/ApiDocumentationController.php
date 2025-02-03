<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ApiDocumentationController extends Controller
{
    public function openApi(): JsonResponse
    {
        $openApiSpec = [
            "openapi" => "3.0.3",
            "info" => [
                "title" => "API de Palavras em Inglês",
                "description" => "Documentação da API no padrão OpenAPI 3.0",
                "version" => "1.0.0"
            ],
            "servers" => [
                [
                    "url" => url('/api'),
                    "description" => "Servidor Local"
                ]
            ],
            "paths" => [
                "/auth/signup" => [
                    "post" => [
                        "summary" => "Criar um novo usuário",
                        "description" => "Cria um novo usuário no sistema.",
                        "tags" => ["Autenticação"],
                        "requestBody" => [
                            "required" => true,
                            "content" => [
                                "application/json" => [
                                    "schema" => [
                                        "type" => "object",
                                        "properties" => [
                                            "name" => ["type" => "string", "example" => "João Silva"],
                                            "email" => ["type" => "string", "format" => "email", "example" => "joao@email.com"],
                                            "password" => ["type" => "string", "example" => "123456"]
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        "responses" => [
                            "201" => [
                                "description" => "Usuário criado com sucesso",
                                "content" => [
                                    "application/json" => [
                                        "example" => [
                                            "message" => "Usuário cadastrado com sucesso",
                                            "user_id" => 1
                                        ]
                                    ]
                                ]
                            ],
                            "400" => ["description" => "Erro na validação"]
                        ]
                    ]
                ],
                "/auth/signin" => [
                    "post" => [
                        "summary" => "Autenticação de usuário",
                        "description" => "Autentica um usuário e retorna um token JWT.",
                        "tags" => ["Autenticação"],
                        "requestBody" => [
                            "required" => true,
                            "content" => [
                                "application/json" => [
                                    "schema" => [
                                        "type" => "object",
                                        "properties" => [
                                            "email" => ["type" => "string", "example" => "joao@email.com"],
                                            "password" => ["type" => "string", "example" => "123456"]
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        "responses" => [
                            "200" => [
                                "description" => "Login realizado com sucesso",
                                "content" => [
                                    "application/json" => [
                                        "example" => [
                                            "token" => "eyJhbGciOiJIUzI1..."
                                        ]
                                    ]
                                ]
                            ],
                            "401" => ["description" => "Credenciais inválidas"]
                        ]
                    ]
                ],
                "/entries/en/{word}" => [
                    "get" => [
                        "summary" => "Buscar palavra em inglês",
                        "description" => "Busca o significado de uma palavra na API.",
                        "tags" => ["Dicionário"],
                        "parameters" => [
                            [
                                "name" => "word",
                                "in" => "path",
                                "required" => true,
                                "schema" => ["type" => "string"],
                                "description" => "Palavra a ser pesquisada",
                                "example" => "hello"
                            ]
                        ],
                        "responses" => [
                            "200" => [
                                "description" => "Palavra encontrada",
                                "content" => [
                                    "application/json" => [
                                        "example" => [
                                            "word" => "hello",
                                            "meaning" => "A greeting or expression of goodwill."
                                        ]
                                    ]
                                ]
                            ],
                            "404" => ["description" => "Palavra não encontrada"]
                        ]
                    ]
                ]
            ]
        ];

        return response()->json($openApiSpec);
    }
}
