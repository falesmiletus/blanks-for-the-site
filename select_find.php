<!DOCTYPE html>
<html>
<head>
<title>Выборка и поиск по имени</title>
<meta charset="utf-8" />
</head>
<body>
<a href = "order_by.php">Сортрировка</a>
<a href = "insert_add.php">Добавление</a>
<a href = "delete_example.php">Удаление</a>
<a href = "select_find.php">Поиск</a>
<h3>Напишите фамилию студента</h3>
<!--Добавляем форму для поиска студентов-->
<form method="POST">
    <!-- Поле для ввода -->
    <input type="text" name = "surname">
    <!-- Кнопка "Найти" -->
    <input type="submit" value="Найти">

<!-- Рисуем таблицу: -->
<!-- Задаём ей толщину рамки -->
<table border = 1>
<!-- Затем шапку, где прописываем названия стобцов (фамилия и группа, например): -->
<tr>
<th>Фамилия</th>
<th>Группа</th>
</tr>


<!-- Начало скрипта PHP -->
<?php
//Подключаемся к БД:

//Имя нашей БД
$dbname = "College";
//Имя пользователя
$user = "admin_college";
//Пароль 
$password = "12345q";
//Создаём объект подключения, используя нашу БД и пользователя root:
$conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $password);
//Пишем запрос: если в поле ввода что-то вписано:
if(isset($_POST["surname"]) && $_POST["surname"] != "")
{
    $surname = $_POST["surname"];
    //то выбираем студента с указанной фамилия
    $sql = "SELECT * FROM Students where surname = '$surname'";
}
else
{
    //иначе выбираем всех студентов
    $sql = "SELECT * FROM Students";
}

//Выполняем его. Результат попадает в переменную $result:
$result = $conn->query($sql);




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

?>
<!-- //Закрывает тег таблицы, для завершения её отрисовки -->
</table>
</body>
</html>