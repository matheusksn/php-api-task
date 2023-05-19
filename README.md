API de tarefas com Redis


Este é um projeto simples que implementa uma API de tarefas utilizando PHP e Redis como banco de dados. A API permite listar todas as tarefas, criar novas tarefas, obter os detalhes de uma tarefa específica, atualizar tarefas existentes e excluir tarefas.

Pré-requisitos
PHP 7.0 ou superior
Redis instalado e em execução
Instalação
Clone o repositório para o seu ambiente local.
Certifique-se de ter o Redis instalado e em execução na porta padrão (6379).
Execute o seguinte comando para instalar as dependências:
Copy code
composer install
Configure as informações de conexão do Redis no arquivo TarefaRepository.php, se necessário.
Uso
Listar todas as tarefas
Endpoint: GET /api/tarefas

Retorna todas as tarefas armazenadas no Redis.

Criar uma nova tarefa
Endpoint: POST /api/tarefas

Cria uma nova tarefa e a salva no Redis. Os dados da tarefa devem ser enviados no corpo da requisição.

Exemplo de corpo da requisição:

json
Copy code
{
  "id": 1,
  "descricao": "Tarefa 1"
}
Obter detalhes de uma tarefa específica
Endpoint: GET /api/tarefas/{id}

Recupera os detalhes de uma tarefa com base no ID fornecido.

Atualizar uma tarefa
Endpoint: PUT /api/tarefas/{id}

Atualiza os detalhes de uma tarefa existente no Redis. Os dados atualizados da tarefa devem ser enviados no corpo da requisição.

Exemplo de corpo da requisição:

json
Copy code
{
  "descricao": "Nova descrição da Tarefa 1"
}
Excluir uma tarefa
Endpoint: DELETE /api/tarefas/{id}

Exclui uma tarefa do Redis com base no ID fornecido.
