<?php
require 'db.php';

// Busca todas as vendas
$sql = "SELECT * FROM produtos ORDER BY data_venda DESC";
$stmt = $pdo->query($sql);
$vendas = $stmt->fetchAll();
?>

<a href="create.php">Nova Venda</a>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Produto</th>
        <th>Quantidade Vendida</th>
        <th>Data da Venda</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($vendas as $venda): ?>
    <tr>
        <td><?= $venda['id'] ?></td>
        <td><?= htmlspecialchars($venda['nome_produto']) ?></td>
        <td><?= $venda['quantidade_vendida'] ?></td>
        <td><?= $venda['data_venda'] ?></td>
        <td>
            <a href="update.php?id=<?= $venda['id'] ?>">Editar</a> | 
            <a href="delete.php?id=<?= $venda['id'] ?>" onclick="return confirm('Excluir essa venda?');">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>