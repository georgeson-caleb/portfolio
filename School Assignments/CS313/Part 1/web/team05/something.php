<!DOCTYPE html>
<html lang="en">
<head>
    <title>List Scripture</title>
</head>

<body>

<?php
    require("dbConnect.php");
    $db = get_db();

    $book = strip_tags($_POST["book"]);
    $chapter = strip_tags($_POST["chapter"]);
    $verse = strip_tags($_POST["verse"]);
    $content = strip_tags($_POST["content"]);
    $topics = $_POST["topics[]"];
    //insert new scripture into DB
    $query = "INSERT INTO Scriptures (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content);";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":book", $book, PDO::PARAM_STR);
    $stmt->bindValue(":chapter", $chapter, PDO::PARAM_INT);
    $stmt->bindValue(":verse", $verse, PDO::PARAM_INT);
    $stmt->bindValue(":content", $content, PDO::PARAM_STR);
    $stmt->execute();
    /* //get ID from new scripture entry
    $query = "SELECT id FROM Scriptures WHERE book=:book & chapter=:chapter & verse=:verse & content=:content LIMIT 1;";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":book", $book, PDO::PARAM_STR);
    $stmt->bindValue(":chapter", $chapter, PDO::PARAM_INT);
    $stmt->bindValue(":verse", $verse, PDO::PARAM_INT);
    $stmt->bindValue(":content", $content, PDO::PARAM_STR);
    $stmt->execute();

    $scripture_id = $stmt->fetch(PDO::FETCH_ASSOC)["id"];

    //add to link table
    $query = "INSERT INTO link (scripture_id, topic_id) VALUES (:scripture_id, :topic_id);";
    foreach ($topics as $topic_id) {
       // if(isset($topic_id)){
            $stmt = $db->prepare($query);
            $stmt->bindValue(":scripture_id", $scripture_id, PDO::PARAM_INT);
            $stmt->bindValue(":topic_id", $topic_id, PDO::PARAM_INT);
            $stmt->execute();
       // }
   } */

    //get all scriptures
    $query = "SELECT book, chapter, verse, content FROM Scriptures";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $scriptures = $stmt->fetchAll(PDO::FETCH_ASSOC);


    function getTopicId($scriptureId) {
       global $db;

       $query = "SELECT topic_id FROM link WHERE scripture_id=:id;";
       $stmt = $db->prepare($query);
       $stmt->bindValue(":id", $scriptureId, PDO::PARAM_INT);
       $stmt->execute();

       $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

       return $topics;
   }

   function getTopicName($topicId) {
      global $db;

      $query = "SELECT topic_name FROM topic WHERE topic_id=:id LIMIT 1;";
      $stmt = $db->prepare($query);
      $stmt->bindValue(":id", $topicId, PDO::PARAM_INT);
      $stmt->execute();

      $topicName = $stmt->fetch(PDO::FETCH_ASSOC)["topic_name"];

      return $topicName;
   } 
?>

<table>
    <tr>
        <th>Book</th>
        <th>Chapter/Verse</th>
        <th>Content</th>
        <th>Topic</th>
    </tr>
    <?php 

        foreach ($scriptures as $script) {
        echo "<tr><td>" . $script['book'] . "</td>";
        echo "<td>" . $script['chapter'] . ":" . $script['verse'] . "</td>";
        echo "<td>" . $script['content'] . "</td>";
         $topicIds = getTopicId($script["id"]);
         echo "<td>";
         foreach ($topicIds as $topicId) {
           echo getTopicName($topicId) . " ";
         }
         echo "</td></tr>";
      }
    ?>
</table>


</body>

</html>