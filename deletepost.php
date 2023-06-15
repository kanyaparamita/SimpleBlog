<?php

    $con = mysqli_connect("localhost","root","","simpleblog");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to mySQL";
    }

    $idDelete = $_GET['idDelete'];

    mysqli_query($con, "DELETE FROM post WHERE post_id = '$idDelete'");

    mysqli_close($con);
    header("Location: index.php");

?>