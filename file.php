<?php
// Если форма отправлена, выполняем обработку файла
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    // Папка для загрузки файлов
    $targetDirectory = "uploads/";
    
    // Получаем информацию о файле
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDirectory . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
    // Создаем папку, если она не существует
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    // Проверяем, не превышает ли файл допустимый размер (например, 5MB)
    if ($_FILES["file"]["size"] > 5000000) {
        echo "Ошибка: файл слишком большой.";
    } else {
        // Допустимые форматы файлов
        $allowedTypes = ['jpg', 'php', 'gif', 'pdf', 'txt', 'doc', 'docx', 'zip'];

        if (in_array($fileType, $allowedTypes)) {
            // Пытаемся загрузить файл на сервер
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                echo "Файл " . htmlspecialchars($fileName) . " успешно загружен.";
            } else {
                echo "Ошибка при загрузке файла.";
            }
        } else {
            echo "Ошибка: Недопустимый формат файла.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка файла</title>
</head>
<body>
    <h2>Загрузите файл</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="file">Выберите файл:</label>
        <input type="file" name="file" id="file" required>
        <br><br>
        <button type="submit">Загрузить</button>
    </form>
</body>
</html>
