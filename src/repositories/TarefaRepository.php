<?php

class TarefaRepository
{
    private $redis;

    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect('localhost', 6379); 
    }

    public function listarTarefas()
    {
        $tarefas = $this->redis->hGetAll('tarefas');

        $result = [];
        foreach ($tarefas as $id => $descricao) {
            $result[] = [
                'id' => $id,
                'descricao' => $descricao
            ];
        }

        return json_encode($result);
    }

    public function criarTarefa($id, $descricao)
    {
        $this->redis->hSet('tarefas', $id, $descricao);

        return json_encode(['message' => 'Tarefa criada com sucesso']);
    }

    public function obterDetalhesTarefa($id)
    {
        $descricao = $this->redis->hGet('tarefas', $id);

        if ($descricao !== false) {
            $result = [
                'id' => $id,
                'descricao' => $descricao
            ];

            return json_encode($result);
        }

        return json_encode(['message' => 'Tarefa não encontrada']);
    }

    public function atualizarTarefa($id, $novaDescricao)
    {
        $tarefaExistente = $this->redis->hGet('tarefas', $id);

        if ($tarefaExistente !== false) {
            $this->redis->hSet('tarefas', $id, $novaDescricao);

            return json_encode(['message' => 'Tarefa atualizada com sucesso']);
        }

        return json_encode(['message' => 'Tarefa não encontrada']);
    }

    public function excluirTarefa($id)
    {
        $tarefaExistente = $this->redis->hGet('tarefas', $id);

        if ($tarefaExistente !== false) {
            $this->redis->hDel('tarefas', $id);

            return json_encode(['message' => 'Tarefa excluída com sucesso']);
        }

        return json_encode(['message' => 'Tarefa não encontrada']);
    }
}
