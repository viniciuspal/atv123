<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome_produto'] ?? '';
    $quantidade = $_POST['quantidade_vendida'] ?? 0;
    $data = $_POST['data_venda'] ?? '';

    if ($nome && $quantidade && $data) {
        $sql = "INSERT INTO produtos (nome_produto, quantidade_vendida, data_venda) VALUES (:nome, :quantidade, :data)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nome' => $nome, 'quantidade' => $quantidade, 'data' => $data]);
        header('Location: index.php');
        exit;
    }
}
?>

<form method="POST">
    Produto: <input type="text" name="nome_produto" required><br>
    Quantidade Vendida: <input type="number" name="quantidade_vendida" required><br>
    Data da Venda: <input type="date" name="data_venda" required><br>
    <button type="submit">Cadastrar Venda</button>
</form>