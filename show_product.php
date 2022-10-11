<?php
session_start();

$servername="localhost";
$username="root";
$password="123456789";
$dbname="shop";
$per_page=5;
$start_page=0;

if(isset($_GET["page"]) )$start_page=$_GET["page"]*$per_page;
else $start_page=0;

//create connect
$con = mysqli_connect($servername,$username,$password,$dbname);
if(!$con){
    die("Connection mysql database fail!!".mysqli_connect_error());
}

$sql="SELECT * FROM product";
$result = mysqli_query($con,$sql);
$numrow = mysqli_num_rows($result);
echo "<h1> FinalMouse Shop</h1>";
echo "<h3>  Finalmouse gaming mouse shop ,etc </h3>";
echo "There are ".$numrow." products in total.<br>";
echo "page".($_GET["page"]+1).'/'.($numrow/$per_page)."<br>";

$prev = $_GET["page"]-1;
$next = $_GET["page"]+1;
if($prev ==-1)
    $prev = 0;
if($prev == ($numrow/$per_page))
    $next = ceil($numrow/$per_page)-1;

//prev
echo "<button onclick=location.href='show_product.php?page=$prev'> previous </button>";
// paging 1-50 
for($i=0;$i<ceil($numrow/$per_page);$i++)
    echo "<a href='show_product.php?page=$i'>[".($i+1)."]</a>";
//next
echo "<button onclick=location.href='show_product.php?page=$next'> next </button>";

$sql="SELECT * FROM product LIMIT $start_page,$per_page";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
    echo "<table border=1 borderColor ='#444'><tr><td>id</td><td>name</td><td>description</td><td>price</td></tr>";
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>";
        echo $row["description"]."</td><td>".$row["price"]."</td>";
        echo "<td><a href='add_product.php?id=".$row["id"]."'>ใส่ตระก้า</td></tr>";
    }
    echo "</table>";
}else{
    echo "0 results";
}
if(isset($_SESSION["cart"]) && count($_SESSION['cart'])>0){
    $total=0;
    echo"<h2>ตระกร้าสินค้า</h2>";
    echo "<table border=1 borderColor ='#444'><tr><th>ลำดับ</th><th>id</th><th>name</th><th>description</th><th>price</th></tr>";
    for($i=0;$i<count($_SESSION['cart']);$i++){
        $item =$_SESSION['cart'][$i];
        echo "<tr><td>".($i+1)."</td>";
        echo "<td>".$item['id']."</td>";
        echo "<td>".$item['name']."</td>";
        echo "<td>".$item['description']."</td>";
        echo "<td>".$item['price']."</td>";
        echo "<td><a href='delCart.php?i=".$i."'>";
        echo "<font color='red'> x </font></a></td></tr>";
        
        $total+=$item['price'];
    }
    
    echo "</table>";
    echo "<button onclick=location.href='clearAll.php?i=".$i."'>Clear All</button>";
    echo "<h2>ราคาสินค้า ".$total." บาท</h2>";
    echo "<h3><a href='checkout.php'>สั่งซื้อ</h3>";
    
}

mysqli_close($con);

?>