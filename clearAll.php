<?php
session_start();

$i = $_GET['i'];
if(isset($_SESSION["cart"])){
    array_splice($_SESSION["cart"],0,$i);
}

?>
<script>
    window.alert("นำสินค้าออกจากตระก้าทั้งหมดเรียบร้อยแล้ว");
    window.location.replace("show_product.php");
</script>