<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento</title>
    <style>
    </style>
</head>
<body>
    <h1>Agendamento</h1>
    
    <!-- Formulário para o usuário inserir os dados do agendamento / chamando a ação do agendar-->
    <form action="agendar.php"  method="POST"> 
        <input type="text" id="nome" name="nome" placeholder="Nome" required><br>
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <input type="text" id="telefone" name="telefone" placeholder="Telefone" required><br>
        <input type="text" id="endereco" name="endereco" placeholder="Endereço" required><br>
        <input type="date" id="data_agendamento" name="data_agendamento" placeholder="Data" required><br><br>
        <input type="submit" value="Agendar"> <!-- Botão para enviar o formulário -->
    </form>
 
</body>
</html>
