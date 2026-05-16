<!DOCTYPE html>
<html>
<head>
    <title>Deletar - Burguer</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <h1 id="titulo">Resultado</h1>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['id'];

                if (empty($id) || !is_numeric($id)) {
                    echo "<p class='msg erro'>⚠ ID inválido! Digite um número válido.</p>";
                } else {
                    $servidor = "localhost";
                    $usuario  = "root";
                    $senha    = "";
                    $banco    = "cardapio";

                    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

                    if ($conexao->connect_error) {
                        die("<p class='msg erro'>Erro de conexão: " . $conexao->connect_error . "</p>");
                    }

                    $sql = "DELETE FROM cardapio WHERE id = $id";

                    if ($conexao->query($sql) === TRUE) {
                        if ($conexao->affected_rows > 0) {
                            echo "<p class='msg sucesso'>✔ Produto <strong>#$id</strong> removido com sucesso!</p>";
                        } else {
                            echo "<p class='msg aviso'>⚠ Nenhum produto encontrado com o ID <strong>$id</strong>.</p>";
                        }
                    } else {
                        echo "<p class='msg erro'>✕ Erro ao excluir: " . $conexao->error . "</p>";
                    }

                    $conexao->close();
                }
            } else {
                echo "<p class='msg erro'>✕ Acesso inválido!</p>";
            }
        ?>

        <div class="acoes">
            <a href="Deletar.html">Deletar outro</a>
            <a href="Home.html">Voltar</a>
        </div>

    </div>

    <style>
        .msg {
            text-align: center;
            font-size: 17px;
            font-weight: 700;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .sucesso { background: #0d2e1a; color: #00cc66; border: 1px solid #00cc66; }
        .erro    { background: #2e0d0d; color: #e03030; border: 1px solid #e03030; }
        .aviso   { background: #2e2200; color: #ffcc00; border: 1px solid #ffcc00; }
        .acoes { display: flex; gap: 12px; margin-top: 8px; }
        .acoes a {
            flex: 1;
            text-align: center;
            padding: 11px;
            border-radius: 8px;
            border: 1px solid #ffcc00;
            color: #ffcc00;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }
        .acoes a:hover { background: #ffcc00; color: #000; }
    </style>
</body>
</html>
