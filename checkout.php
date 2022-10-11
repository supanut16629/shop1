<?php
session_start();

if(isset($_SESSION["cart"])){
    echo "<h1>สรุปรายการสินค้า</h1>";
    $total=0;
    echo "<h2>ตระก้าสินค้า</h2>";
    echo "<table border=1 borderColor ='#444'><tr><th>ลำดับ</th><th>id</th><th>name</th><th>description</th><th>price</th></tr>";
        for($i=0;$i<count($_SESSION["cart"]);$i++)
        {
            $item=$_SESSION["cart"][$i];
            echo "<tr><td>".($i+1)."</td>";
            echo "<td>".$item['id']."</td>";
            echo "<td>".$item['name']."</td>";
            echo "<td>".$item['description']."</td>";
            echo "<td>".$item['price']."</td>";
            
            $total+=$item['price'];
        }
    echo "</table>";
    echo "<h2>ราคาสินค้า $total บาท</h2>";
?>
    <form action="order.php" method="post">
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname" value=""><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname" value=""><br>
        <lable for="address">Address:</label><br>
<textarea id="address" name="address"  rows="4" cols="40"></textarea><br>
        <lable for="mobile">Mobile No.:</label><br>
        <input type="text" id="mobile" name="mobile" value=""><br>
        <input type="submit" value="Submit">
        </form> 
<?php
}
?>