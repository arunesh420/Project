<?php
require_once "config.php";
if(isset($_POST["search_keyword"]) && isset($_POST["search_field"])){
    $search_keyword = $_POST["search_keyword"];
    $search_field = $_POST["search_field"];
    if ($search_field == "name"){
        $sql=" SELECT * FROM contacts WHERE name LIKE '%".$search_keyword . "%'";
        $result = mysqli_query($conn,$sql);
    }
}
?>
<?php include "head.php"?>
<html>
<head><title>Search</title><link href="header.php"></head>
<body>
<a href="create.php">Create</a>
<form action="search.php" method="post">

    <input type ="text" name="search_keyword" required>
    <select name="search_field" required>
        <option value ="name" selected> Name</option>
    </select>
    <input type ="submit" value="search">

</form>
<a href="retrieve.php"><button>Clear</button></a>
<table class="table table-bordered" border="1">
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Delete</th>
    </tr>
    <?php
    if (isset($result)) {
        if (mysqli_num_rows($result) == 0 ) {
            echo "<tr>";
            echo "<td colspan='6' > No Data found </td>";
            echo "</td>";
        }
    }
    ?>
    <?php if (isset($result)) { ?>
    <?php foreach ($result as $row){ ?>
    <tr>
        <td><?php echo$row['id']?></td>
        <td><?php echo $row['name']?></td>
        <td><?php echo $row['address']?></td>
        <td><?php echo $row['email']?></td>
        <td><?php echo $row['contact']?></td>
        
            <td><a href="delete_detail.php" ?id=<?php echo $row["id"]?>">Delete</a> </td>
        </tr>
        <?php } ?>
    <?php } ?>
</table>
</body>
</html>