<?php 

// Configurações do banco de dados
$db_host = 'localhost';
$db_name = 'devnotes';
$db_user = 'root';
$db_pass = '';

//Array de Retorno padrão
$array = [
    'error' => '',
    'result' => []
];

try {
    // Criando uma nova instância de PDO com as configurações do banco de dados
    $pdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=utf8",
        $db_user,
        $db_pass
    );

    // Configurando o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Exibindo uma mensagem de erro caso a conexão falhe
    $errorMensage = "Erro ao conectar com o banco de dados: " . $e->getMessage();
    $array['error'] = $errorMensage;
}

?>