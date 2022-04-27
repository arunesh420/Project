<?php
require_once "config.php";
$sql = "SELECT * FROM contacts";
$result=mysqli_query($conn,$sql)
?>
<?php include "head.php"?>
    <html>
    <head><title>Retrieve</title><link href="header.php"></head>
    <body>
    <a href="create.php">Create</a>
    <form action="search.php" method="post">
        <input type="text" name="search_keyword" required>
        <select name="search_field" required>
            <option value="name" selected> Name</option>
            <option value="address">Last Name</option>
            <option value="email">Email</option>
            <option value="contact">Email</option>
        </select>
        <input type="submit" value="Search">
    </form>
    <table class="table table-bordered" border="1">
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($result as $row){ ?>
            <tr>
                <td><?php echo$row['id']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['contact']?></td>
                <td><a href="delete_detail.php? id=<?php echo $row["id"]?>">Delete</a> </td>
            </tr>

        <?php } ?>
    </table>
    </body>
    </html>
