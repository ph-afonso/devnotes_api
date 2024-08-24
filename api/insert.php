<?php
// Configurações do banco de dados
require '../config.php';

// Tratamento de Lowercase para o método
$method = strtoupper($_SERVER['REQUEST_METHOD']);

// Verifica se o método enviado é POST
if ($method === 'POST') {
    $title = filter_input(INPUT_POST, 'title');
    $body = filter_input(INPUT_POST, 'body');

    //Verifica se os dados necessários estão preenchidos
    if($title && $body) {
        $sql = $pdo->prepare("INSERT INTO notes (title, body) VALUES(:title, :body)");
        $sql->bindValue(':title', $title);
        $sql->bindValue(':body', $body);
        $sql->execute();

        //Obtém o ID do objeto inserido
        $id = $pdo->lastInsertId();
        
        //Retorna o objeto inserido
        $array['result'][] = [
            'id' => $id,
            'title' => $title,
            'body' => $body
        ];

    } else {
        $array['error'] = 'To insert a note, make sure you have sent a title and body.';
    }

} else {
    // Retorna erro se o método não for POST
    $array['error'] = 'Method not accepted. The expected method is: POST.';
}

require '../return.php';
?>
