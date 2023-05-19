<?php

class TarefaService {
    private $tarefaRepository;

    public function __construct(TarefaRepository $tarefaRepository) {
        $this->tarefaRepository = $tarefaRepository;
    }

    public function listarTarefas() {
        return $this->tarefaRepository->listarTarefas();
    }

    public function criarTarefa($id, $descricao) {
        $tarefa = array('id' => $id, 'descricao' => $descricao);
        $this->tarefaRepository->criarTarefa($tarefa);
    }

    public function obterDetalhesTarefa($id) {
        return $this->tarefaRepository->obterDetalhesTarefa($id);
    }

    public function atualizarTarefa($id, $novaDescricao) {
        $this->tarefaRepository->atualizarTarefa($id, $novaDescricao);
    }

    public function excluirTarefa($id) {
        $this->tarefaRepository->excluirTarefa($id);
    }
}