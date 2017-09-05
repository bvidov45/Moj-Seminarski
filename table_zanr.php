<?php include 'db.php';




$sql1 = "CREATE TABLE IF NOT EXISTS `zanr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB";


if (!$conn->query($sql1)  === TRUE) {
    echo "Error creating table: " . $conn->error;
} 
$sql3 = "INSERT INTO zanr (id, naziv) VALUES
	(1, 'akcija'),
	(2, 'drama'),
	(3, 'sci-fi'),
	(4, 'triler'),
	(5, 'komedija'),
	(6, 'horror'),
	(7, 'avantura')";
$result = mysqli_query($conn, $sql3);
