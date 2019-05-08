<?php session_start(); ?>
 
<?php
if(!isset($_SESSION['valid'])) {
    header('Location: login.php');
}
?>
 
<?php
// including the database connection file
include_once("connection.php");
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $nama = $_POST['nama'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];  
    
    // checking empty fields
    if(empty($nama) || empty($qty) || empty($price)) {                
        if(empty($nama)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($qty)) {
            echo "<font color='red'>Quantity field is empty.</font><br/>";
        }
        
        if(empty($price)) {
            echo "<font color='red'>Price field is empty.</font><br/>";
        }        
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE binatang1 SET nama='$nama', qty='$qty', price='$price' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is view.php
        header("Location: view.php");
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM binatang1 WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{
    $nama = $res['nama'];
    $qty = $res['qty'];
    $price = $res['price'];
}
?>
<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>
    <br><?php $waktu = date_default_timezone_set('Asia/Jakarta');  ?>
    <a href="index.php">Home</a> | <a href="view.php">View Products</a> | <a href="logout.php">Logout</a>
    <br/><br/>
    
    <form name="form1" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="nama" value="<?php echo $nama;?>"></td>
            </tr>
            <tr> 
                <td>Quantity</td>
                <td><input type="text" name="qty" value="<?php echo $qty;?>"></td>
            </tr>
            <tr> 
                <td>Price</td>
                <td><input type="text" name="price" value="<?php echo $price;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
            

        </table>
    </form>
</body>
</html>