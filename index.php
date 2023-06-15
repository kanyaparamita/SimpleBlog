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

<title>Simple Blog</title>


</head>

<body class="default">
<img src="assets/img/background.jpg" class="background">
<div class="wrapper">

<?php

    $con = mysqli_connect("localhost","root","","simpleblog");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to mySQL";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post_judul = mysqli_real_escape_string($con,$_POST['Judul']);
        $post_tanggal = mysqli_real_escape_string($con,$_POST['Tanggal']);
        $post_konten = mysqli_real_escape_string($con,$_POST['Konten']);
        
        // menyambungkan dengan keterangan edit post yang ada di url
        $isModif = $_GET['modif'];
        $idPostModif = $_GET['id'];
        if ($isModif) {
          $post_query = "UPDATE post SET post_judul = '$post_judul', post_tanggal = '$post_tanggal',
                        post_konten = '$post_konten' WHERE post_id = '$idPostModif'";
        } else {
          $post_query = "INSERT INTO post (post_judul, post_tanggal, post_konten)
                  VALUES ('$post_judul', '$post_tanggal','$post_konten')";
        }

        if (!mysqli_query ($con, $post_query)) {
            die('Error: ' . mysqli_error($con));
        }
    }

    $listPost = mysqli_query ($con, "SELECT * FROM post ORDER BY post_tanggal DESC");

?>

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><img src="assets/img/logo.png"></a>
    <ul class="nav-primary">
        <li><a href="new_post.php">+ Tambah Post</a></li>
    </ul>
</nav>

<div id="home">
    <div class="posts">
        <nav class="art-list">
          <ul class="art-list-body">
            <?php
              while ($singlePost = mysqli_fetch_array($listPost)) {
            ?>
              <li class="art-list-item">
                  <h2 class="art-list-title judul"><a href="post.php?id=<?=$singlePost['post_id'];?>"><?php echo $singlePost['post_judul']; ?></a></h2>
                  <div class="art-list-item-title-and-time">
                      <div class="art-list-time">
                        <?php echo $singlePost['post_tanggal']; ?>
                        <span style="color:#F40034;">&#10029;</span> Featured</div>
                  </div>
                  <p class="isi"><?php
                      if (strlen($singlePost['post_konten']) > 500) {
                        echo substr($singlePost['post_konten'], 0, 499);
                        echo " ... ";
                        echo "<a href=\"post.php?id=".$singlePost['post_id']."\">Read more</a>";
                      } else {
                        echo $singlePost['post_konten'];
                      }
                    ?>
                    <br/>
                    <a href="new_post.php?id=<?=$singlePost['post_id'];?>">Edit</a> | <a href="#" onclick="delFunc(<?php echo $singlePost['post_id']; ?>)">Hapus</a>
                  </p>
              </li>
            <?php } ?>
          </ul>
        </nav>
    </div>
</div>

<script>
  function delFunc(idPostDel) {
    if (confirm ("Apakah Anda yakin postingan ini dihapus?") == true) {
      location.href = "deletepost.php?idDelete="+idPostDel;
    }
  }
</script>

<footer class="footer">
    <div class="back-to-top"><a class="btt" href="">Back to top</a></div>
    <div class="psi">Kanyap</div>
</footer>

</div>

<script type="text/javascript" src="assets/js/fittext.js"></script>
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