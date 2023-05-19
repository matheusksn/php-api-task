<?php

require_once 'TarefaRepository.php';
require_once 'TarefaService.php';
require_once 'TarefaController.php';

$redis = new Redis();
$redis->connect('redis', 6379);

$tarefaRepository = new TarefaRepository($redis);
$tarefaService = new TarefaService($tarefaRepository);
$tarefaController = new TarefaController($tarefaService);

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

if ($method === 'GET' && $path === '/api/tarefas') {
    header('Content-Type: application/json');
    echo $tarefaController->listarTarefas();
} elseif ($method === 'POST' && $path === '/api/tarefas') {
    header('Content-Type: application/json');
    echo $tarefaController->criarTarefa();
} elseif ($method === 'GET' && preg_match('/\/api\/tarefas\/(\d+)/', $path, $matches)) {
    $id = $matches[1];
    header('Content-Type: application/json');
    echo $tarefaController->obterDetalhesTarefa($id);
} elseif ($method === 'PUT' && preg_match('/\/api\/tarefas\/(\d+)/', $path, $matches)) {
    $id = $matches[1];
    header('Content-Type: application/json');
    echo $tarefaController->atualizarTarefa($id);
} elseif ($method === 'DELETE' && preg_match('/\/api\/tarefas\/(\d+)/', $path, $matches)) {
    $id = $matches[1];
    header('Content-Type: application/json');
    echo $tarefaController->excluirTarefa($id);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Rota não encontrada']);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Tarefas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Lista de Tarefas</h1>

    <table id="tabela-tarefas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        function getTarefas() {
            fetch('/api/tarefas')
                .then(response => response.json())
                .then(data => {
                    const tabela = document.getElementById('tabela-tarefas');
                    const tbody = tabela.querySelector('tbody');
                    
                    tbody.innerHTML = '';
                    
                    data.forEach(tarefa => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${tarefa.id}</td>
                            <td>${tarefa.descricao}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => console.error(error));
        }

        document.addEventListener('DOMContentLoaded', getTarefas);
    </script>
</body>
</html>
