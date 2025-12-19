<?php
// Функция для отрисовки таблицы
function drawTable($cols, $rows, $color) {
    echo "<table border='1'>";
    for ($tr = 1; $tr <= $rows; $tr++) {
        echo "<tr>";
        for ($td = 1; $td <= $cols; $td++) {
            if ($tr == 1 || $td == 1) {
                echo "<th style='background-color: $color; padding: 5px;'>" . $tr * $td . "</th>";
            } else {
                echo "<td style='padding: 5px;'>" . $tr * $td . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}

// Инициализация переменных со значениями по умолчанию
$cols = 10;
$rows = 10;
$color = '#ffff00';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cols = abs((int) ($_POST['cols'] ?? 0));
    $rows = abs((int) ($_POST['rows'] ?? 0));
    $color = trim(strip_tags($_POST['color'] ?? ''));
    
    // Установка значений по умолчанию, если введены некорректные данные
    $cols = $cols > 0 ? $cols : 10;
    $rows = $rows > 0 ? $rows : 10;
    $color = !empty($color) ? htmlspecialchars($color) : '#ffff00';
}
?>
<section>
    <!-- Action должен быть REQUEST_URI, чтобы сохранить параметр ?id=table -->
    <form action='<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>' method="POST">
        <label>Количество колонок: </label><br>
        <input name='cols' type='text' value='<?= $cols ?>'><br>
        
        <label>Количество строк: </label><br>
        <input name='rows' type='text' value='<?= $rows ?>'><br>
        
        <label>Цвет: </label><br>
        <input name='color' type='color' value='<?= $color ?>' list="listColors">
        <datalist id="listColors">
            <option value="#ff0000">Красный</option>
            <option value="#00ff00">Зеленый</option>
            <option value="#0000ff">Синий</option>
            <option value="#ffff00">Желтый</option>
        </datalist>
        <br><br>
        <input type='submit' value='Создать'>
    </form>
    <br>
    <!-- Таблица -->
    <?php 
        // Вызов функции строго как в задании: drawTable
        drawTable($cols, $rows, $color); 
    ?>
    <!-- Таблица -->
</section>
