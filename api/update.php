<?php
// Configurações do banco de dados
require '../config.php';

// Tratamento de Lowercase para o método
$method = strtoupper($_SERVER['REQUEST_METHOD']);

// Verifica se o método enviado é PUT
if ($method === 'PUT') {
    //Obtendo os valores, tendo em vista que o PUT não funciona como o POST
    parse_str(file_get_contents('php://input'), $input);

    //Atribuindo valores a variaveis
    $id = $input['id'] ?? null;
    $title = $input['title'] ?? null;
    $body = $input['body'] ?? null;

    //Validações de injeções de código malicioso
    $id = filter_var($id);
    $title = filter_var($title);
    $body = filter_var($body);
    
    //Valida se os valores esperados estão sendo enviados
    if($id && $title && $body) {
        //Obtém objeto apartir do id
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        //Verifica se encontrou o objeto e caso não encotre retorna o erro
        if($sql->rowCount() > 0) {
            //Atualiza os valores caso tenha encontrado
            $sql = $pdo->prepare("UPDATE notes SET title = :title, body = :body WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':title', $title);
            $sql->bindValue(':body', $body);
            $sql->execute();

            //Retorna o objeto atualizado
            $array['result'][] = [
                'id' => $id,
                'title' => $title,
                'body' => $body
            ];
        } else {
            $array['error'] = 'Unable to locate the note.';
        }
    } else {
        $array['error'] = 'To insert a note, make sure you have sent a id, title and body.';
    }

} else {
    // Retorna erro se o método não for PUT
    $array['error'] = 'Method not accepted. The expected method is: PUT.';
}

require '../return.php';
?>
