<?php
require_once 'crud.php'; // Inclua o arquivo que contém a definição da classe Crud

// Verifica se o ID do paciente foi fornecido na URL
if (isset($_GET['id'])) {
    $id_paciente = $_GET['id'];
    
    // Verifica se o ID do paciente não está vazio
    if (!empty($id_paciente)) {
        // Instancia o objeto Crud
        $crud = new Crud();
        
        // Verifica se o formulário foi submetido
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'Salvar Edições') {
            // Recupera os dados do formulário
            $nome = $_POST['nome'];
            $data_nasc = $_POST['data_nasc'];
            $genero = $_POST['genero'];
            $telefone = $_POST['telefone'];
            $endereco = $_POST['endereco'];
            
            // Atualiza os dados do paciente no banco de dados
            $atualizado = $crud->atualizarPaciente($id_paciente, [
                'nome' => $nome,
                'data_nascimento' => $data_nasc,
                'genero' => $genero,
                'telefone' => $telefone,
                'endereco' => $endereco
            ]);
            
            if ($atualizado) {
                echo "<script>alert('Paciente atualizado com sucesso!'); window.location.href='buscar.php';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar paciente!');</script>";
            }
        }
        
        // Busca os dados do paciente com base no ID
        $paciente = $crud->buscarPacientePorId($id_paciente);
        
        // Verifica se o paciente foi encontrado
        if (!$paciente) {
            echo "<script>alert('Paciente não encontrado!'); window.location.href='buscar.php';</script>";
            exit; 
        }
    } else {
        echo "<script>alert('ID do paciente não especificado!');</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section id="esquerda">
    <div id='voltar'><a href='http://localhost/Teste_pratico_vaga_de_estagio/gerenciamento_pacientes/'>Voltar</a></div>
    <div class="login-box">
        <h2>Editar Paciente</h2>
        <form id="formEditar" method="POST">
            <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
            <!-- Preenche os campos do formulário com os dados do paciente -->
            <div class="user-box">
                <input type="text" name="nome" id="nome" value="<?php echo isset($paciente['nome']) ? $paciente['nome'] : ''; ?>" placeholder="Nome" required>
                <label>Nome</label>
            </div>

            <div class="user-box">
                <input type="date" name="data_nasc" id="data_nasc" value="<?php echo isset($paciente['data_nascimento']) ? $paciente['data_nascimento'] : ''; ?>" required>
            </div>

            <div class="user-box">
                <select name="genero" id="genero" required>
                    <option value="M" <?php if(isset($paciente['genero']) && $paciente['genero'] == 'M') echo 'selected'; ?>>Masculino</option>
                    <option value="F" <?php if(isset($paciente['genero']) && $paciente['genero'] == 'F') echo 'selected'; ?>>Feminino</option>
                    <option value="N" <?php if(isset($paciente['genero']) && $paciente['genero'] == 'N') echo 'selected'; ?>>Neutro</option>
                </select>
            </div>

            <div class="user-box">
                <input type="text" name="telefone" id="telefone" value="<?php echo isset($paciente['telefone']) ? $paciente['telefone'] : ''; ?>" placeholder="Telefone" required>
                <label>Telefone</label>
            </div>

            <div class="user-box">
                <input type="text" name="endereco" id="endereco" value="<?php echo isset($paciente['endereco']) ? $paciente['endereco'] : ''; ?>" placeholder="Endereço" required>
                <label>Endereço</label>
            </div>

            <input class="salvarEdicao button" type="submit" name="action" value="Salvar Edições">
        </form>
    </div>
</section>
<script src="script.js"></script>
</body>
</html>
