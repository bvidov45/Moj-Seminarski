<?php  include 'db.php'; ?>
<?php  include 'table_zanr.php'; ?>


<!DOCTYPE html>
<html>
    <head>
        <title>INDEX</title>
        <meta charset="UTF-8">
        <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="style.css">
  
    </head>
    <body>
        <div class="jumbotron text-center">
        <a href="unos.php"><button class="btn btn-primary">Return to first page</button></a><br><br>
        <?php foreach (range('A', 'Z') as $char) {?>
            <a href="index.php?let=<?php echo $char;  ?>"><button class="btn btn-primary"><?php echo $char; ?></button></a>
        <?php }?>
        <br><br><br> 
        </div>
    
      
       
       <?php
       if(isset($_GET['let'])){
       $let = $_GET['let'];
       
       $query = "SELECT * FROM filmovi WHERE naslov LIKE  '$let%'";
       $let='';
       $res = mysqli_query($conn, $query);
       
      echo "<ul>";
      while($row = mysqli_fetch_assoc($res)){
      echo "<li>" . "<img height=200 widht=175  src='".'img/'.$row['slika']."'/>";echo "<br>";
      echo  $row['naslov'];
      echo " (". $row['godina'].")";echo "<br>";
      echo "Trajanje : ".$row['trajanje']. "min"."</li>";echo "<br>";}}
      echo "</ul>";
      
    ?>
     
    </body>
</html>
