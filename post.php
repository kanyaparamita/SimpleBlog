<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Deskripsi Blog">
<meta name="author" content="Judul Blog">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="omfgitsasalmon">
<meta name="twitter:title" content="Simple Blog">
<meta name="twitter:description" content="Deskripsi Blog">
<meta name="twitter:creator" content="Simple Blog">
<meta name="twitter:image:src" content="{{! TODO: ADD GRAVATAR URL HERE }}">

<meta property="og:type" content="article">
<meta property="og:title" content="Simple Blog">
<meta property="og:description" content="Deskripsi Blog">
<meta property="og:image" content="{{! TODO: ADD GRAVATAR URL HERE }}">
<meta property="og:site_name" content="Simple Blog">

<link rel="stylesheet" type="text/css" href="assets/css/screen.css" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php

    $con = mysqli_connect("localhost","root","","simpleblog");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to mySQL";
    }

    if (isset ($_GET['id'])) {
        $idPost = $_GET['id'];
        $isiPost = mysqli_query ($con, "SELECT * FROM post WHERE post_id = $idPost");
        $singlePost = mysqli_fetch_array ($isiPost);
    }

?>

<title>Simple Blog | <?php echo $singlePost['post_judul']; ?></title>


</head>

<body class="default">
<img src="assets/img/background.jpg" class="background">
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><img src="assets/img/logo.png"></a>
    <ul class="nav-primary">
        <li><a href="new_post.php" style="padding-left: 10px;">+ New Post</a></li>
    </ul>
</nav>

<article class="art simple post">
    
    <header class="art-header">
        <div class="art-header-inner" style="margin-top: 0px; opacity: 1;">
            <time class="art-time"><?php echo $singlePost['post_tanggal']; ?></time>
            <h2 class="art-title"><?php echo $singlePost['post_judul']; ?></h2>
            <!-- <p class="art-subtitle"></p> -->
        </div>
    </header>

    <div class="art-body">
        <div class="art-body-inner">
            <!-- <hr class="featured-article" /> -->
            <p><?php echo $singlePost['post_konten']; ?></p>

            <hr />
            
            <h2>Comment</h2>

            <div id="contact-area">
                <form method="post" id="formKomen" onsubmit="validasiEmail(); return false">
                    <input type="hidden" name="IDPost" id="IDPost" value="<?php echo $singlePost['post_id']?>">
                    
                    <label for="Nama">Name:</label>
                    <input type="text" name="Nama" id="Nama">
        
                    <label for="Email">Email:</label>
                    <input type="text" name="Email" id="Email">
                    
                    <label for="Komentar">Comment:</label><br>
                    <textarea name="Komentar" rows="20" cols="20" id="Komentar"></textarea>

                    <input type="submit" name="submit" value="Send" class="submit-button">
                </form>
            </div>

            <?php
                $post_comment = mysqli_query ($con, "SELECT * FROM komen WHERE komen_idpost = $idPost ORDER BY komen_tanggal DESC");
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
            ?>
        </div>
    </div>
</article>

<script>
   function validasiEmail() {
        var inputEmail = document.getElementById("Email").value;
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (re.test(inputEmail)) {
            postKomen();
        } else {
            alert ("Masukan email salah.");
            return false;
        }
   }

   function getXmlHttpRequest() {
        var xmlHttpObj;
        if(window.XMLHttpRequest) {
            xmlHttpObj = new XMLHttpRequest();
        } else {
            try {
                xmlHttpObj = new ActiveXObject("Msmx12.XMLHTTP");
            } catch(e) {
                try {
                    xmlHttpObj = new ActiveXObject("Microsoft.XMLHTTP");
                } catch(e) {
                    xmlHttpObj = false;
                }
            }
        }
        return xmlHttpObj;
   } 

   function postKomen() {
        var xmlHttpObj = getXmlHttpRequest();
        var com_idpost = document.getElementById("IDPost").value;
        var com_nama = document.getElementById("Nama").value;
        var com_email = document.getElementById("Email").value;
        var com_konten = document.getElementById("Komentar").value;

        xmlHttpObj.open("GET", "comment.php?IDPost="+com_idpost+"&Nama="+com_nama+
                "&Email="+com_email+"&Komentar="+com_konten,true);
        
        xmlHttpObj.send();
        xmlHttpObj.onreadystatechange = function() {
            if(xmlHttpObj.readyState == 4 && xmlHttpObj.status == 200) {
                document.getElementById("listKomen").innerHTML = xmlHttpObj.responseText;
            }
        }
        document.getElementById("formKomen").reset();
   }

</script>

<footer class="footer">
    <div class="back-to-top"><a class="btt" href="">Back to top</a></div>
    <div class="psi">Kanyap</div>
</footer>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
<script type="text/javascript">
  var ga_ua = '{{! TODO: ADD GOOGLE ANALYTICS UA HERE }}';

  (function(g,h,o,s,t,z){g.GoogleAnalyticsObject=s;g[s]||(g[s]=
      function(){(g[s].q=g[s].q||[]).push(arguments)});g[s].s=+new Date;
      t=h.createElement(o);z=h.getElementsByTagName(o)[0];
      t.src='//www.google-analytics.com/analytics.js';
      z.parentNode.insertBefore(t,z)}(window,document,'script','ga'));
      ga('create',ga_ua);ga('send','pageview');
</script>

<?php mysqli_close($con); ?>

</body>
</html>