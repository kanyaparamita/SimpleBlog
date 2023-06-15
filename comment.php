<?php

	$con = mysqli_connect("localhost","root","","simpleblog");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to mySQL";
    }

    date_default_timezone_set("Asia/Jakarta");
    $comment_idpost = $_GET['IDPost'];
    $comment_nama = $_GET['Nama'];
    $comment_email = $_GET['Email'];
    $comment_konten = $_GET['Komentar'];

    $comment_query = "INSERT INTO komen (komen_idpost, komen_nama, komen_email, komen_konten)
                  VALUES ('$comment_idpost', '$comment_nama', '$comment_email', '$comment_konten')";

    if (!mysqli_query ($con, $comment_query)) {
            die('Error: ' . mysqli_error($con));
    }
   
    $post_comment = mysqli_query ($con, "SELECT * FROM komen WHERE komen_idpost = '$comment_idpost' ORDER BY komen_tanggal DESC");

   	echo "<ul class=\"art-list-body\" id=\"listKomen\">";
		while ($singleComment = mysqli_fetch_array($post_comment)) {
			echo "<li class=\"art-list-item\">";
			echo "<div class=\"art-list-item-title-and-time\">";
		    echo "<h2 class=\"art-list-title\">".$singleComment['komen_nama']."</h2>";
		    echo "<div class=\"art-list-time\">".$singleComment['komen_tanggal']."</div>";
		    echo "</div>";
		    echo "<p>".$singleComment['komen_konten']."</p>";
		    echo "</li>";
		}
    echo "</ul>";

    mysqli_close($con);

 ?>