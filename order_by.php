<!DOCTYPE html>
<html>
<head>
<title>Сортрировочная</title>
<meta charset="utf-8" />
</head>
<body>
<a href = "order_by.php">Сортрировка</a>
<a href = "insert_add.php">Добавление</a>
<a href = "delete_example.php">Удаление</a>
<a href = "select_find.php">Поиск</a>

<h3>Выберите поле для сортировки</h3>
<!-- Создаём форму с фильтрами -->
<form method = "POST">
    <!-- Выбор из двух вариантов -->
    <select name="column_to_order" size="2">
        <option value="surname">По фамилии</option>
        <option value="group_name">По номеру группы</option>
    </select>
    <!-- Кнопки "радио" -->
        <input type="radio" name="type_of_order" checked value="ASC"/>По возрастанию 
        <input type="radio" name="type_of_order" value="DESC"/>По убыванию
    <!-- Кнопка, которая отправляет данные с формы на сервер -->
    <input type="submit" value="Применить">
</form>

<?php
//Значение по умолчанию для колонки, по которой сортируем:
$column_to_order = "surname";

//Проверка на заполнение значения
if (isset($_POST["column_to_order"]))
    $column_to_order = $_POST["column_to_order"];

//Значение по умолчанию для порядка сортировки:
$type_of_order = "ASC";

//Проверка на заполнение значения
if (isset($_POST["type_of_order"]))
    $type_of_order = $_POST["type_of_order"];


//Подключаемся к БД:

//Имя нашей БД
$dbname = "db_1";
//Имя пользователя
$user = "root";
//Пароль 
$password = "qwerty";
//Создаём объект подключения, используя нашу БД и пользователя root:
$conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $password);
//Пишем запрос:
$sql = "SELECT * FROM Students order by $column_to_order $type_of_order";
//Выполняем его. Результат попадает в переменную $result:
$result = $conn->query($sql);

//Рисуем таблицу:

//Задаём ей толщину рамки
echo "<table border = 1>";
//Затем шапку, где прописываем названия стобцов (фамилия и группа, например):
echo "<tr>";
echo "<th>Фамилия</th>";
echo "<th>Группа</th>";
echo "</tr>";

//В цикле выполняем метод fetch() переменной $result, чтобы получить данные построчно:
while($row=$result->fetch()){
    //Начинаем отрисовку строки
    echo "<tr>";
    //Выводим на экран, используя наименования столбцов как ключи: фамилия, группа
    echo "<td>".$row["surname"]."</td>";
    echo "<td>".$row["group_name"]."</td>";
    //Заканчиваем отрисовку строки
    echo "</tr>";
}
//Закрывает тег таблицы, для завершения её отрисовки
echo "</table>";
?>
</body>
</html>