<?php

class TarefaController
{
    private $tarefaService;

    public function __construct($tarefaService)
    {
        $this->tarefaService = $tarefaService;
    }

    public function handleRequest()
    {
        $route = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($route) {
            case '/api/tarefas':
                if ($method === 'GET') {
                    echo $this->listarTarefas();
                } elseif ($method === 'POST') {
                    $requestData = json_decode(file_get_contents('php://input'), true);

                    $id = $requestData['id'];
                    $descricao = $requestData['descricao'];

                    echo $this->criarTarefa($id, $descricao);
                } else {
                    echo json_encode(['message' => 'Método não permitido']);
                }
                break;
            case preg_match('/\/api\/tarefas\/(\d+)/', $route, $matches) === 1:
                $id = $matches[1];

                if ($method === 'GET') {
                    echo $this->obterDetalhesTarefa($id);
                } elseif ($method === 'PUT') {
                    $requestData = json_decode(file_get_contents('php://input'), true);

                    $novaDescricao = $requestData['descricao'];

                    echo $this->atualizarTarefa($id, $novaDescricao);
                } elseif ($method === 'DELETE') {
                    echo $this->excluirTarefa($id);
                } else {
                    echo json_encode(['message' => 'Método não permitido']);
                }
                break;
            default:
                echo json_encode(['message' => 'Rota não encontrada']);
                break;
        }
    }

    public function listarTarefas()
    {
        return $this->tarefaService->listarTarefas();
    }

    public function criarTarefa($id, $descricao)
    {
        return $this->tarefaService->criarTarefa($id, $descricao);
    }

    public function obterDetalhesTarefa($id)
    {
        return $this->tarefaService->obterDetalhesTarefa($id);
    }

    public function atualizarTarefa($id, $novaDescricao)
    {
        return $this->tarefaService->atualizarTarefa($id, $novaDescricao);
    }

    public function excluirTarefa($id)
    {
        return $this->tarefaService->excluirTarefa($id);
    }
}
