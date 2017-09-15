<?php require_once "tmpl/header.php";  ?>

    <h1>Members</h1>

<table class=".table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Activated</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>

<?php
include_once('inc/connect.php');
$query = mysqli_query($con, "SELECT * FROM benutzer ORDER by id");
while($row = $query->fetch_array()){
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['username']."</td>";
    echo "<td>".$row['activated']."</td>";
    echo "<td>".$row['role']."</td>";
    echo "</tr>";
}
?>
 </tbody>
</table>

<style>
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
</style>

<?php require_once "tmpl/footer.php";  ?>
