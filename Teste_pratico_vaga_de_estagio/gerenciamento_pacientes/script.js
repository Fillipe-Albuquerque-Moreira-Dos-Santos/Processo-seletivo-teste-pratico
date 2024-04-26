// Validação do campo de nome para no máximo 40 caracteres e não aceitar números
var nomeInput = document.getElementById('nome');
nomeInput.addEventListener('input', function (e) {
    var inputValue = e.target.value;
    // Limita o nome a 35 caracteres
    if (inputValue.length > 40) {
        e.target.value = inputValue.slice(0, 40);
    }
    // Remove os números do valor do campo de nome
    e.target.value = e.target.value.replace(/\d/g, '');
});

// Validação do campo de endereço padrão
var enderecoInput = document.getElementById('endereco');
enderecoInput.addEventListener('input', function (e) {
    e.target.value = e.target.value.replace(/[^A-Za-z0-9\s,.]/g, '').slice(0, 100); // Limita o endereço a 100 caracteres
});

// Máscara e limite de caracteres para o campo de telefone
var telefoneInput = document.getElementById('telefone');
telefoneInput.addEventListener('input', function (e) {
    var telefone = e.target.value.replace(/\D/g, '');
    telefone = telefone.slice(0, 11); // Limita o telefone a 11 dígitos
    telefone = telefone.replace(/^(\d{2})(\d)/g, '($1) $2');
    telefone = telefone.replace(/(\d)(\d{4})$/, '$1-$2');
    e.target.value = telefone;
});

