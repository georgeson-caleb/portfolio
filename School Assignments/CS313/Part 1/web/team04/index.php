<!DOCTYPE html>
<html lang="en">
<head>
    <title>Scriptures</title>
</head>
​
<body>
​
<?php
    require("dbConnect.php");
    // DB assigned to db variable
    $db = get_db();
    $query = "SELECT * FROM Scriptures";
    $stmt = $db->prepare($query);
    $stmt->execute();
​
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
​
    foreach ($rows as $value) {
        echo $value;
        //echo "<p>" . $value['book'] . " " . $value['chapter'] . ":" . $value['verse'] . " - \"" . $value['content'] . "\"</p>";
    }
?>
</body>
​
</html>