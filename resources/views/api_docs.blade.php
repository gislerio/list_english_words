<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentação da API</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
<div class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-600 text-white p-4 text-center text-lg font-semibold">
        Documentação da API
    </header>

    <!-- Main Content -->
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Endpoints Disponíveis</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Método</th>
                    <th class="border border-gray-300 px-4 py-2">Endpoint</th>
                    <th class="border border-gray-300 px-4 py-2">Descrição</th>
                </tr>
                </thead>
                <tbody class="text-gray-700">
                @foreach ($routes as $route)
                    <tr class="border-b">
                        <td class="border px-4 py-2 text-center font-bold {{ str_contains($route['method'], 'GET') ? 'text-green-600' : (str_contains($route['method'], 'POST') ? 'text-blue-600' : 'text-red-600') }}">
                            {{ $route['method'] }}
                        </td>
                        <td class="border px-4 py-2">{{ $route['uri'] }}</td>
                        <td class="border px-4 py-2">{{ $route['name'] ?? 'Sem descrição' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
