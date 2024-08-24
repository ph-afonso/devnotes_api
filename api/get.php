<?php
// Configurações do banco de dados
require '../config.php';

// Tratamento de Lowercase para o método
$method = strtoupper($_SERVER['REQUEST_METHOD']);

// Verifica se o método enviado é GET
if ($method === 'GET') {
    $id = filter_input(INPUT_GET, 'id');

    if($id) {
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'] = [
                'id' => $data['id'],
                'title' => $data['title'],
                'body' => $data['body']
            ];

        } else {
            $array['error'] = 'The ID sent does not exist.';
        }
    } else {
        $array['error'] = 'The ID parameter was not sent.';
    }

} else {
    // Retorna erro se o método não for GET
    $array['error'] = 'Method not accepted. The expected method is: GET.';
}

require '../return.php';
?>
