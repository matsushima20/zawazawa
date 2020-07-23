<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>摂取カロリー登録</title>
</head>

<style>
    body{
        background:linear-gradient(110deg,skyblue,yellow);
    }
    
</style>

<body>
    
    <?php

        $dsn = 'mysql:host=localhost;dbname=zawazawadb;charset=utf8';  
        $user = 'root';
        $password = '';
        $pdo = new PDO($dsn, $user, $password);

        $dishes = $_POST['dishes'];                                       
        $calories = $_POST['calories'];
        
        $sql = "insert into dishes(dishes, calories) values(?, ?)"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$dishes, $calories]);
        
        http_response_code(301);
        header("Location:dishes.html");
        exit;
    ?>
</body>
</html>

