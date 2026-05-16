<!DOCTYPE html>
<html>
<head>
    <title>Cardápio - Burguer</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CardapioDelete.css">
</head>
<body>

<?php
    $servidor = "localhost";
    $usuario  = "root";
    $senha    = "";
    $banco    = "cardapio";

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    if ($conexao->connect_error) {
        die("<p style='color:#e03030; text-align:center; padding:40px;'>Erro de conexão: " . $conexao->connect_error . "</p>");
    }

    $busca = "";
    if (isset($_POST['busca']) && !empty($_POST['busca'])) {
        $busca = $conexao->real_escape_string($_POST['busca']);
        $sql = "SELECT * FROM cardapio WHERE nome LIKE '%$busca%' ORDER BY categoria, nome";
    } else {
        $sql = "SELECT * FROM cardapio ORDER BY categoria, nome";
    }

    $resultado = $conexao->query($sql);
?>

    <div class="container">

        <h1 id="titulo">Cardápio</h1>
        <p id="conteudo">
            <?php echo $busca ? "Resultados para: <strong style='color:#ffcc00'>\"$busca\"</strong>" : "Todos os produtos cadastrados"; ?>
        </p>

        <form action="Read.php" method="post">
            <div class="campo">
                <label>Buscar por nome</label>
                <input type="text" name="busca" placeholder="Ex: Cheeseburger" value="<?php echo htmlspecialchars($busca); ?>">
            </div>
            <button type="submit">Buscar</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Disponível</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while ($registro = $resultado->fetch_assoc()) {

                    $status = ($registro['disponivel'] == 1)
                        ? '<span class="disponivel">● Sim</span>'
                        : '<span class="indisponivel">● Não</span>';

                    $descricao = (isset($registro['descricao']) && $registro['descricao'] !== '')
                        ? $registro['descricao']
                        : '—';

                    echo "<tr>";
                    echo "<td>" . $registro['id'] . "</td>";
                    echo "<td><strong>" . $registro['nome'] . "</strong></td>";
                    echo "<td>" . $descricao . "</td>";
                    echo "<td>R$ " . number_format($registro['preco'], 2) . "</td>";
                    echo "<td>" . $registro['categoria'] . "</td>";
                    echo "<td>" . $status . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center; padding:40px; color:#666;'>
                        🍔 Nenhum produto encontrado.
                      </td></tr>";
            }

            $conexao->close();
            ?>
            </tbody>
        </table>

        <div style="margin-top: 28px; display: flex; gap: 16px;">
            <a href="Adicionar.html" style="color:#ffcc00; font-weight:700; text-decoration:none;">+ Adicionar produto</a>
            <span style="color:#444;">|</span>
            <a href="Home.html" style="color:#ffcc00; font-weight:700; text-decoration:none;">← Voltar para Home</a>
        </div>

    </div>

</body>
</html>
