<!DOCTYPE html>
<html>
<head>
<title>Добавление записи</title>
<meta charset="utf-8" />
</head>
<body>
<a href = "order_by.php">Сортрировка</a>
<a href = "insert_add.php">Добавление</a>
<a href = "delete_example.php">Удаление</a>
<a href = "select_find.php">Поиск</a>
<?php
if (isset($_POST["surname"]) && isset($_POST["name"]) && isset($_POST["patronymic"]) && isset($_POST["group_name"])){
     
    try {
        $conn = new PDO("mysql:host=localhost;dbname=College", "admin_college", "12345q");
        $sql = "INSERT INTO Students (name, surname, patronymic, group_name) VALUES (:name, :surname, :patronymic, :group_name)";
        // определяем prepared statement
        $stmt = $conn->prepare($sql);
        // привязываем параметры к значениям
        $stmt->bindValue(":name", $_POST["name"]);
        $stmt->bindValue(":surname", $_POST["surname"]);
        $stmt->bindValue(":patronymic", $_POST["patronymic"]);
        $stmt->bindValue(":group_name", $_POST["group_name"]);
        // выполняем prepared statement
        $affectedRowsNumber = $stmt->execute();
        // если добавлена как минимум одна строка
        if($affectedRowsNumber > 0 ){
            echo "Добавлен студент: фамилия=" . $_POST["surname"] ."  группа= " . $_POST["group_name"];  
        }
    }
    catch (PDOException $e) {
        echo "Ошибка в работе с базой данных: " . $e->getMessage();
    }
}
?>
<h3>Добавить студента</h3>
<form method="post">
    <p>Фамилия:
    <input type="text" name="surname" /></p>
    <p>Имя:
    <input type="text" name="name" /></p>
    <p>Отчество:
    <input type="text" name="patronymic" /></p>
    <p>Группа:
    <input type="text" name="group_name" /></p>

    <input type="submit" value="Добавить">
</form>
</body>
</html>