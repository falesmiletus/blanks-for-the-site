<?php
// На этой странице подключаемся к БД и удаляем студента по ID.
//ID приходит с формы кнопки удаления в файле delete_example.php
if(isset($_POST["id"]))
{
    try {
        $conn = new PDO("mysql:host=localhost;dbname=College", "admin_college", "12345q");
        $sql = "DELETE FROM Students WHERE ID = :student_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":student_id", $_POST["id"]);
        $stmt->execute();
        //возвращаемся на текущую страницу.
        header("Location: delete_example.php");
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>