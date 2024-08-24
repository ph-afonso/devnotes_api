<?php
// Configurações do banco de dados
require '../config.php';

// Tratamento de Lowercase para o método
$method = strtoupper($_SERVER['REQUEST_METHOD']);

// Verifica se o método enviado é DELETE
if ($method === 'DELETE') {
    //Obtendo os valores, tendo em vista que o DELETE não funciona como o POST
    parse_str(file_get_contents('php://input'), $input);

    //Atribuindo valores a variaveis
    $id = $input['id'] ?? null;

    //Validações de injeções de código malicioso
    $id = filter_var($id);
    
    //Valida se os valores esperados estão sendo enviados
    if($id) {
        //Obtém objeto apartir do id
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        //Verifica se encontrou o objeto e caso não encotre retorna o erro
        if($sql->rowCount() > 0) {
            //Deleta o objeto
            $sql = $pdo->prepare("DELETE FROM notes WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            //Retorna sucesso na deleção
            $array['result'] = 'Deltated successfully.';           
            
        } else {
            $array['error'] = 'Unable to locate the note.';
        }
    } else {
        $array['error'] = 'Unable to delete, please provide an id.';
    }

} else {
    // Retorna erro se o método não for DELETE
    $array['error'] = 'Method not accepted. The expected method is: DELETE.';
}

require '../return.php';
?>
