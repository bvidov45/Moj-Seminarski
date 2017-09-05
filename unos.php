
<?php  include 'db.php'; ?>
<?php  include 'table_zanr.php'; ?> 

<?php

$sql5 = "CREATE TABLE IF NOT EXISTS `filmovi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `id_zanr` int(11) DEFAULT NULL,
  `godina` year(4) DEFAULT NULL,
  `trajanje` int(11) DEFAULT NULL,
  `slika` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_filmovi_zanr` (`id_zanr`),
  CONSTRAINT `FK_filmovi_zanr` FOREIGN KEY (`id_zanr`) REFERENCES `zanr` (`id`)
) ENGINE=InnoDB";


if (!$conn->query($sql5)  === TRUE) {
    echo "Error creating table: " . $conn->error;
} 

?>




 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Kolekcija filmova</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
     <div class="container">
         <div class="jumbotron text-center">
             <h2>Kolekcija filmova</h2>
             <a href="index.php"><button class="btn btn-primary">Go to Index page</button></a>
         </div>
         <h3>Unos novog filma</h3>
         <form class="col-md-4" method="POST" enctype="multipart/form-data">
             <div class="form-group">
                 <label>Naslov</label>
                 <input type="text" name="naslov" class="form-control"/>
             </div>
             <div class="form-group">
                  <?php
                    $query4 = "SELECT * FROM zanr ";
                    $result4 = mysqli_query($conn, $query4);
                   ?>
                 <label>Žanr</label>
                 <select name="zanr" class="form-control">
                 <?php   while ($row4 = mysqli_fetch_array($result4)){
                 echo "<option value='$row4[id]'>". $row4['naziv'] ."</option>";
                 }?>
                 </select>
             </div>
             
             <div class="form-group">
                 <label>Godina</label>
                 <select name="godina" class="form-control">
                 <?php for($i=2017; $i>=1900; $i--){
                       echo "<option>".$i."</option>";
                  }?>
            </select>
             </div>
             
             <div class="form-group">
                 <label>Trajanje</label>
                 <input type="text" name="trajanje" class="form-control"/>
             </div>
             
              <div class="form-group">
                 <label>Slika</label>
                 <input type="file" name="slika" class="form-control"/>
             </div>
             
              <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-danger"/>
             </div>
         </form>
         
         
      <?php
      $sql = 'SELECT * FROM filmovi';
      $result = mysqli_query($conn, $sql);
      echo "<table class='table'>
          <thead>
            <tr>
              <th>Slika</th>
              <th>Naslov</th>
              <th>Godina</th>
              <th>Trajanje</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>";
      while($row = mysqli_fetch_assoc($result)){
       echo "
            <tr> 
              <td><img height=175 widht=150 src='img/".$row['slika']."'</td>
              <td>$row[naslov]</td>
              <td>$row[godina]</td>
              <td>$row[trajanje]</td>
              <td><a href='unos.php?id= $row[id]' class='btn btn-danger'>Delete</a></td>
              
            </tr>";
       }
          echo "</tbody>
                </table>";
      
      ?>
    
      
     </div>
      
      
      
      
      
      
      
      

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php 
if (isset($_POST['submit'])){
    $naslov = mysqli_real_escape_string($conn, strip_tags($_POST['naslov'])) ;
    $zanr = mysqli_real_escape_string($conn, strip_tags($_POST['zanr'])) ;
    $godina = mysqli_real_escape_string($conn, strip_tags($_POST['godina'])) ;
    $trajanje = mysqli_real_escape_string($conn, strip_tags($_POST['trajanje'])) ;
    $slika = mysqli_real_escape_string($conn, strip_tags($_FILES['slika']['name'])) ;
   
      //the path to store uploaded image
    $target = "img/".basename($_FILES['slika']['name']);
    //move uploaded image into folder img
    if
    (move_uploaded_file($_FILES['slika']['tmp_name'], $target)){
        $echo = "File uploaded";
    } else {
          $echo = "error";
    }
    $query = "INSERT INTO filmovi (naslov, id_zanr, godina, trajanje, slika)"
   . " VALUES (?, ?, ?, ?, ?)";
   $stmt=$conn->prepare($query);
   $stmt->bind_param('siiis', $naslov, $zanr, $godina, $trajanje, $slika);
   
   if($stmt->execute()){?>
       <script>window.location='unos.php';</script>
   <?php }
   $stmt->close();
    
}
if(isset($_GET['id'])){

    $del = "DELETE FROM filmovi WHERE id='$_GET[id]'";
          //execute the query
    if(mysqli_query($conn, $del)){?>
       <script>window.location="unos.php";</script>
   <?php }
 }

?>