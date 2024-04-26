<?php
// Inclua o conteúdo do crud.php
include 'crud.php';

// Instancia a classe Crud
$crud = new Crud();

// Defina uma variável para armazenar os resultados
$resultados = [];

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] === "Buscar") {
    // Verifica se o campo de nome não está vazio
    if (!empty($_POST["nome"])) {
        // Processa o formulário de busca
        $nome = $_POST["nome"];
        $resultados = $crud->processarFormularioBusca($nome);
    } else {
        // Se o campo de nome estiver vazio, carrega todos os dados
        $resultados = $crud->buscarDados();
    }
} else {
    // Se o formulário não foi submetido, carrega todos os dados
    $resultados = $crud->buscarDados();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Pacientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section id='direita'>
    <div id='voltar'><a href='http://localhost/Teste_pratico_vaga_de_estagio/gerenciamento_pacientes/'>Voltar</a></div>
    <div id="tabelaPacientes">
        <!-- Aqui será carregada a tabela com os dados dos pacientes -->
        <table>
           <tr class="header-row">
                <td>ID</td>
                <td>Nome</td>
                <td>Sexo</td>
                <td>Data de Nascimento</td>
                <td>Telefone</td>         
                <td>Endereco</td>
                <td colspan="1">Edição dos dados</td>
                <td colspan="2">Excluir</td>
            </tr>
            <?php
            // Verifica se há resultados da busca
            if($resultados) {
                foreach ($resultados as $paciente) {
                    echo "<tr>";
                    echo "<td>".$paciente['id']."</td>";
                    echo "<td>".$paciente['nome']."</td>"; 
                    echo "<td>".$paciente['genero']."</td>"; 
                    // fiz uma formatação de data para pt-br
                    echo "<td>".date('d/m/Y', strtotime($paciente['data_nascimento'])) . "</td>";
                    echo "<td>".$paciente['telefone']."</td>"; 
                    echo "<td>".$paciente['endereco']."</td>"; 
                    echo "<td><a href='editar.php?id=".$paciente['id']."'>Editar</a></td>";
                    echo "<td><a href='crud.php?action=excluir&id=".$paciente['id']."' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a></td>";
                    echo "</tr>";

                }
            } else {
                // Se não houver pacientes, exibe uma mensagem
                echo "<tr><td colspan='8' style='text-align: center; font-size: 20px;'>Nenhum paciente encontrado com este nome.</td></tr>";
            }
            ?>
        </table>
    </div>
</section>

</body>
</html>
