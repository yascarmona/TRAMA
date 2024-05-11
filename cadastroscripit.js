// Adicionando o evento de clique ao ícone de hambúrguer
document.querySelector('.hamburger-menu').addEventListener('click', function () {
    document.querySelector('ul').classList.toggle('show'); 
    this.classList.toggle('change');
});
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g,'');
    if(cpf == '') return false;
    // Elimina CPFs invalidos conhecidos
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
            return false;
    // Valida 1o digito
    let add = 0;
    for (let i=0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    let rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
    // Valida 2o digito
    add = 0;
    for (let i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;
}

// Função para validar CNPJ
function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g,'');
    if(cnpj == '') return false;
    if (cnpj.length != 14)
        return false;
    // Valida DVs
    let tamanho = cnpj.length - 2
    let numeros = cnpj.substring(0,tamanho);
    let digitos = cnpj.substring(tamanho);
    let soma = 0;
    let pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;
    return true;
}

// Função para validar CPF ou CNPJ
function validarCPFCNPJ(valor) {
    valor = valor.replace(/[^\d]+/g,'');
    if (valor.length === 11) {
        return validarCPF(valor);
    } else if (valor.length === 14) {
        return validarCNPJ(valor);
    } else {
        return false;
    }
}

// Mostra os campos específicos dependendo do tipo de cadastro selecionado
document.getElementById('cliente').addEventListener('change', function() {
    document.getElementById('cliente_fields').style.display = 'block';
    document.getElementById('empresa_fields').style.display = 'none';
});

document.getElementById('empresa').addEventListener('change', function() {
    document.getElementById('cliente_fields').style.display = 'none';
    document.getElementById('empresa_fields').style.display = 'block';
});

// Adiciona máscara de CPF
document.getElementById('cpf').addEventListener('input', function() {
    let cpf = this.value.replace(/\D/g, '');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    this.value = cpf;
});

// Adiciona máscara de CNPJ
document.getElementById('cnpj').addEventListener('input', function() {
    let cnpj = this.value.replace(/\D/g, '');
    cnpj = cnpj.replace(/^(\d{2})(\d)/, '$1.$2');
    cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
    cnpj = cnpj.replace(/\.(\d{3})(\d)/, '.$1/$2');
    cnpj = cnpj.replace(/(\d{4})(\d)/, '$1-$2');
    this.value = cnpj;
});

// Adiciona máscara de telefone
document.getElementById('tel').addEventListener('input', function() {
    let tel = this.value.replace(/\D/g, '');
    tel = tel.replace(/^(\d{2})(\d)/g, '($1) $2');
    tel = tel.replace(/(\d)(\d{4})$/, '$1-$2');
    this.value = tel;
});

// Valida CPF ou CNPJ quando o formulário for submetido
document.querySelector('form').addEventListener('submit', function(event) {
    let cpf = document.getElementById('cpf').value;
    let cnpj = document.getElementById('cnpj').value;

    if (cpf.trim() !== '') { // Verifica se o campo CPF está preenchido
        if (!validarCPF(cpf)) { // Valida CPF
            alert("CPF inválido!");
            event.preventDefault(); // Impede o envio do formulário
        } else {
            alert("Parabéns, cadastro realizado!");
        }
    } else if (cnpj.trim() !== '') { // Verifica se o campo CNPJ está preenchido
        if (!validarCNPJ(cnpj)) { // Valida CNPJ
            alert("CNPJ inválido!");
            event.preventDefault(); // Impede o envio do formulário
        } else {
            alert("Parabéns, cadastro realizado!");
        }
    } else {
        alert("Por favor, preencha o CPF ou CNPJ!");
        event.preventDefault(); // Impede o envio do formulário
    }
});
