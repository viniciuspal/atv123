<?php
require 'db.php';

// Consulta a soma das vendas agrupadas por produto
$sql = "SELECT nome_produto, SUM(quantidade_vendida) AS total_vendido FROM produtos GROUP BY nome_produto";
$stmt = $pdo->query($sql);
$dados = $stmt->fetchAll();

$nomes = array_column($dados, 'nome_produto');
$quantidades = array_column($dados, 'total_vendido');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de Vendas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Quantidade Vendida por Produto</h2>
    <canvas id="vendasChart" width="600" height="400"></canvas>

    <script>
        const ctx = document.getElementById('vendasChart').getContext('2d');
        const vendasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($nomes) ?>,
                datasets: [{
                    label: 'Quantidade Vendida',
                    data: <?= json_encode($quantidades) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>
</body>
</html>