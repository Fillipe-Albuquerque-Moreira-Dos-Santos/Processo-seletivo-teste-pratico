<?php

class Crud
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:dbname=sistema_gerenciamento;host=localhost:3306", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
            exit();
        }
    }

    public function cadastrarPaciente($nome, $data_nasc, $genero, $telefone, $endereco)
    {
        try {
            $query = "INSERT INTO pacientes (nome, data_nascimento, genero, telefone, endereco) VALUES (:nome, :data_nasc, :genero, :telefone, :endereco)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":data_nasc", $data_nasc);
            $stmt->bindParam(":genero", $genero);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":endereco", $endereco);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar paciente: " . $e->getMessage();
            return false;
        }
    }

    public function buscarDados($nome = null)
    {
        try {
            if ($nome !== null) {
                $query = "SELECT * FROM pacientes WHERE nome LIKE :nome";
                $stmt = $this->pdo->prepare($query);
                $nome_like = "%" . $nome . "%";
                $stmt->bindParam(':nome', $nome_like, PDO::PARAM_STR);
            } else {
                $query = "SELECT * FROM pacientes";
                $stmt = $this->pdo->prepare($query);
            }

            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOException $e) {
            echo "Erro ao buscar os pacientes: " . $e->getMessage();
            return [];
        }
    }

    public function buscarPacientePorId($id)
{
    try {
        $query = "SELECT * FROM pacientes WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
        return $paciente;
    } catch (PDOException $e) {
        echo "Erro ao buscar paciente por ID: " . $e->getMessage();
        return false;
    }
}


public function atualizarPaciente($id, $dados)
    {
        try {
            $query = "UPDATE pacientes SET nome = :nome, data_nascimento = :data_nasc, genero = :genero, telefone = :telefone, endereco = :endereco WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":nome", $dados['nome']);
            $stmt->bindParam(":data_nasc", $dados['data_nascimento']);
            $stmt->bindParam(":genero", $dados['genero']);
            $stmt->bindParam(":telefone", $dados['telefone']);
            $stmt->bindParam(":endereco", $dados['endereco']);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar paciente: " . $e->getMessage();
            return false;
        }
    }


    public function excluirPaciente($id)
    {
        try {
            $query = "DELETE FROM pacientes WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao excluir paciente: " . $e->getMessage();
            return false;
        }
    }

    public function processarFormularioCadastro()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "Cadastrar") {
            $nome = $_POST["nome"];
            $data_nasc = $_POST["data_nasc"];
            $genero = $_POST["genero"];
            $telefone = $_POST["telefone"];
            $endereco = $_POST["endereco"];

            $cadastrado = $this->cadastrarPaciente($nome, $data_nasc, $genero, $telefone, $endereco);

            if ($cadastrado) {
                echo "<script>alert('Cadastro bem-sucedido!'); window.location.href='http://localhost/Teste_pratico_vaga_de_estagio/gerenciamento_pacientes/';</script>";
            } else {
                echo "Erro ao cadastrar paciente!";
            }
        }
    }

    public function processarFormularioBusca($nome = null)
    {
        if ($nome !== null) {
            // Chama o método buscarDados() com o nome fornecido
            $resultados = $this->buscarDados($nome);
            return $resultados; // Retorna os resultados da busca
        }
    }

    public function processarExclusao()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] === "excluir" && isset($_GET["id"])) {
            $id = $_GET["id"];
            $excluido = $this->excluirPaciente($id);
            if ($excluido) {
                echo "<script>alert('Paciente excluído com sucesso!'); window.location.href='http://localhost/Teste_pratico_vaga_de_estagio/gerenciamento_pacientes/buscar.php';</script>";
            } else {
                echo "Erro ao excluir paciente!";
            }
        }
    }
}

$crud = new Crud();
$crud->processarFormularioCadastro();
$crud->processarFormularioBusca();
$crud->processarExclusao();

?>
