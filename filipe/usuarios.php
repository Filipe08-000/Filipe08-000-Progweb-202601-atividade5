<?php
    // O require chama o conexao.php que já verifica o login via sessão
    require "conexao.php"; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <style>
        /* Mantendo o seu padrão de estilo */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding-top: 60px; }
        .navbar { background-color: #333; color: white; padding: 10px 0; display: flex; justify-content: space-between; align-items: center; position: fixed; top: 0; width: 100%; z-index: 1000; }
        .navbar .logo { margin-left: 20px; font-size: 24px; font-weight: bold; }
        .navbar nav { margin-right: 20px; }
        .navbar nav a { color: white; text-decoration: none; margin: 0 15px; font-size: 16px; transition: color 0.3s; }
        .navbar nav a:hover { color: #4CAF50; }
        .content { padding: 30px; margin-top: 10px; }
        .contentgrid { padding: 30px; margin-top: 5px; }
        .welcome-message { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); margin-bottom: 30px; }
        .welcome-message h2 { font-size: 24px; color: #333; }
    </style>
</head>
<body>

    <?php include "menu.php"; ?>   

    <div class="content">
        <div class="welcome-message">
            <h2>Gerenciamento de Usuários</h2>
        </div>
    </div>

    <div class="contentgrid">
        <table border="1" align="center" width="100%" style="background-color: white; border-collapse: collapse;">
            <tr>
                <th bgcolor="#CCCCCC" style="padding: 10px;">ID</th>
                <th bgcolor="#CCCCCC">Usuário (Username)</th>
                <th bgcolor="#CCCCCC">Senha (Hash/Texto)</th>
                <th bgcolor="#CCCCCC">Status</th>
            </tr>
            <?php
            // Buscando os dados da tabela 'usuario'
            $resultado = pg_query($conn, "SELECT idusuario, username, password, status FROM usuario ORDER BY idusuario ASC");
            
            while ($linha = pg_fetch_assoc($resultado)) {
            ?>
            <tr>
                <td align="center" style="padding: 8px;"><?php echo $linha["idusuario"]; ?></td>
                <td style="padding: 8px;"><?php echo $linha["username"]; ?></td>
                <td align="center">********</td> <td align="center">
                    <?php
                    // Lógica para converter o boolean do Postgres em texto amigável
                    if($linha["status"] == "t") {
                        echo "<span style='color: green; font-weight: bold;'>Ativo</span>";
                    } else {
                        echo "<span style='color: red;'>Inativo</span>";
                    }
                    ?>
                </td>
            </tr>    
            <?php
            }
            ?>
        </table>
    </div>

</body>
</html>