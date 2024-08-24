<?php
// Configurações do banco de dados
require '../config.php';

// Tratamento de Lowercase para o método
$method = strtoupper($_SERVER['REQUEST_METHOD']);

// Verifica se o método enviado é GET
if ($method === 'GET') {

    //Busca todas as notas no banco de dados
    $sql = $pdo->query("SELECT * FROM notes");

    //Verifica se a busca encontrou algo, se encontrou popula o array de result
    if($sql->rowCount() > 0) {
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $item) {
            $array['result'][] = [
                'id' => $item['id'],
                'title' => $item['title']
            ];
        }
    } else {
        $array['result'] = 'No notes were found.';
    }
} else {
    // Retorna erro se o método não for GET
    $array['error'] = 'Method not accepted. The expected method is: GET.';
}

require '../return.php';

?>
