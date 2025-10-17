<?php
require 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

// Busca a venda pelo ID
$sql = "SELECT * FROM produtos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$venda = $stmt->fetch();

if (!$venda) {
    echo "Venda não encontrada.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome_produto'] ?? '';
    $quantidade = $_POST['quantidade_vendida'] ?? 0;
    $data = $_POST['data_venda'] ?? '';

    if ($nome && $quantidade && $data) {
        $sql = "UPDATE produtos SET nome_produto = :nome, quantidade_vendida = :quantidade, data_venda = :data WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome' => $nome,
            'quantidade' => $quantidade,
            'data' => $data,
            'id' => $id
        ]);
        header('Location: index.php');
        exit;
    }
}
?>

<form method="POST">
    Produto: <input type="text" name="nome_produto" value="<?= htmlspecialchars($venda['nome_produto']) ?>" required><br>
    Quantidade Vendida: <input type="number" name="quantidade_vendida" value="<?= $venda['quantidade_vendida'] ?>" required><br>
    Data da Venda: <input type="date" name="data_venda" value="<?= $venda['data_venda'] ?>" required><br>
    <button type="submit">Atualizar Venda</button>
</form>