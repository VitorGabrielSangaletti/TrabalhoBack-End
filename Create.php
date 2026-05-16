<!DOCTYPE html>
<html>
<head>
    <title>Cadastro - Burguer</title>
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

            $nome       = "";
            $preco      = "";
            $descricao  = "";
            $categoria  = "";
            $disponivel = "1";

            if (isset($_POST['nome']))       $nome       = $_POST['nome'];
            if (isset($_POST['preco']))      $preco      = $_POST['preco'];
            if (isset($_POST['descricao']))  $descricao  = $_POST['descricao'];
            if (isset($_POST['categoria']))  $categoria  = $_POST['categoria'];
            if (isset($_POST['disponivel'])) $disponivel = $_POST['disponivel'];

            if (empty($nome) || empty($preco) || empty($categoria)) {
                echo "<p class='msg erro'>⚠ Nome, Preço e Categoria são obrigatórios!</p>";
            } else {
                $sql = "INSERT INTO cardapio (nome, preco, descricao, categoria, disponivel) 
                        VALUES ('$nome', '$preco', '$descricao', '$categoria', '$disponivel')";

                if ($conexao->query($sql) === TRUE) {
                    echo "<p class='msg sucesso'>✔ Produto cadastrado com sucesso!</p>";
                    echo "<div class='info-box'>";
                    echo "<p><span>Nome:</span> " . htmlspecialchars($nome) . "</p>";
                    echo "<p><span>Preço:</span> R$ " . number_format($preco, 2) . "</p>";
                    echo "<p><span>Categoria:</span> " . htmlspecialchars($categoria) . "</p>";
                    echo "</div>";
                } else {
                    echo "<p class='msg erro'>✕ Erro ao cadastrar: " . $conexao->error . "</p>";
                }
            }

            $conexao->close();
        ?>

        <div class="acoes">
            <a href="Adicionar.html">+ Cadastrar outro</a>
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
        .info-box {
            background: #141414;
            border: 1px solid #2e2e2e;
            border-radius: 10px;
            padding: 20px 24px;
            margin-bottom: 20px;
        }
        .info-box p { text-align: left; color: #f0f0f0; margin-bottom: 8px; font-size: 15px; }
        .info-box p:last-child { margin-bottom: 0; }
        .info-box span { color: #ffcc00; font-weight: 700; }
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
