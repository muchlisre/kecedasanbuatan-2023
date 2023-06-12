<?php 
require_once __DIR__ . '/autoload.php';
$sentiment = new \PHPInsight\Sentiment();

$servername = 'localhost';
$username = 'root';
$password = 'bismillah';
$dbname = 'ai_sentiment';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
    die("Error connecting to database: " . mysqli_error_string($conn));
}



$query = $conn->query("SELECT * FROM table_posting");
?>
<table border="1" cellspacing="5" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Posting</th>
            <th>Banyak Komentar</th>
            <th>Negatif</th>
            <th>Positif</th>
            <th>Netral</th>
            <th>Rata-rata</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i=1;
        while ($row = $query->fetch_assoc()) {
            //hitung banyak komentar 
            $id_posting = $row['id_posting'];
            $count_comment = $conn->query("SELECT count(id_posting) as banyak FROM table_komentar")->fetch_row();
            $komentar = $conn->query("SELECT komentar FROM table_komentar where id_posting=$id_posting;")->fetch_assoc();
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['judul_posting']; ?></td>
                <td><?php echo $count_comment[0]; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>
    </tbody>

</table>