<?php
$ano = date('Y');
$mes = date('m');
echo "<table>";
echo "<tr><th colspan='7'>" . DateTime::createFromFormat('!m', $mes)->format('F Y') . "</th></tr>";
echo "<tr>";
echo "<th>Dom</th>";
echo "<th>Seg</th>";
echo "<th>Ter</th>";
echo "<th>Qua</th>";
echo "<th>Qui</th>";
echo "<th>Sex</th>";
echo "<th>Sáb</th>";
echo "</tr>";
echo "<tr>";
$dias_no_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
$primeiro_dia_semana = date('w', strtotime("$ano-$mes-01"));
for ($dia = 1; $dia <= $dias_no_mes; $dia++) {
    $data = sprintf("%02d/%02d/%04d", $dia, $mes, $ano);
    if ($dia == 1) {
        for ($i = 0; $i < $primeiro_dia_semana; $i++) {
            echo "<td></td>";
        }
    }
    $classe_disponivel = ''; // Defina a classe CSS conforme a disponibilidade da data
    if (dataDisponivel($data)) {
        $classe_disponivel = 'disponivel';
    } else {
        $classe_disponivel = 'indisponivel';
    }
    echo "<td><button class='data_disponivel $classe_disponivel' data-data='$data'>$dia</button></td>";
    if ((($dia + $primeiro_dia_semana) % 7) == 0 && $dia != $dias_no_mes) {
        echo "</tr><tr>";
    }
}
echo "</tr>";
echo "</table>";

function dataDisponivel($data) {
    // Lógica para verificar se a data está disponível
    // Retorne true se estiver disponível, false caso contrário
    return true; // Exemplo: sempre retorna true para este exemplo
}
?>
