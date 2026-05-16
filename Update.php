<!DOCTYPE html>
<html>
<head>
    <title>Atualização - Burguer</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <h1 id="titulo">Resultado</h1>

        <?php
            $servidor = "localhost";
            $usuario  = "root";
            $senha    = "";
            $banco    = "cardapio";

            $conexao = new mysqli($servidor, $usuario, $senha, $banco);

            if ($conexao->connect_error) {
                die("<p class='msg erro'>Erro de conexão: " . $conexao->connect_error . "</p>");
            }

            $id         = "";
            $nome       = "";
            $preco      = "";
            $descricao  = "";
            $categoria  = "";
            $disponivel = "";

            if (isset($_POST['id']))         $id         = $_POST['id'];
            if (isset($_POST['nome']))       $nome       = $_POST['nome'];
            if (isset($_POST['preco']))      $preco      = $_POST['preco'];
            if (isset($_POST['descricao']))  $descricao  = $_POST['descricao'];
            if (isset($_POST['categoria']))  $categoria  = $_POST['categoria'];
            if (isset($_POST['disponivel'])) $disponivel = $_POST['disponivel'];

            if (empty($id)) {
                echo "<p class='msg erro'>⚠ O ID do produto é obrigatório!</p>";
            } else {
                $sql = "UPDATE cardapio SET ";

                if (!empty($nome))      $sql .= "nome = '$nome', ";
                if (!empty($preco))     $sql .= "preco = '$preco', ";
                if (!empty($descricao)) $sql .= "descricao = '$descricao', ";
                if (!empty($categoria)) $sql .= "categoria = '$categoria', ";
                if ($disponivel !== "") $sql .= "disponivel = '$disponivel', ";

                $sql = rtrim($sql, ", ");
                $sql .= " WHERE id = '$id'";

                if ($conexao->query($sql) === TRUE) {
                    if ($conexao->affected_rows > 0) {
                        echo "<p class='msg sucesso'>✔ Produto atualizado com sucesso!</p>";
                    } else {
                        echo "<p class='msg aviso'>⚠ Nenhuma alteração realizada ou ID não encontrado.</p>";
                    }
                } else {
                    echo "<p class='msg erro'>✕ Erro ao atualizar: " . $conexao->error . "</p>";
                }
            }

            $conexao->close();
        ?>

        <div class="acoes">
            <a href="Atualizar.html">Atualizar outro</a>
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
