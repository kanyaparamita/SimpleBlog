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

<title>Simple Blog | Post Editor</title>


</head>

<body class="default">
<img src="assets/img/background.jpg" class="background">
<div class="wrapper">

<?php

    $con = mysqli_connect("localhost","root","","simpleblog");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to mySQL";
    }

    $idPost = 0;
    $post_modif = "false";
    $post_judul = "";
    $post_tanggal = "";
    $post_konten = "";

    if (isset ($_GET['id'])) {
        $idPost = $_GET['id'];
        $isiPost = mysqli_query ($con, "SELECT * FROM post WHERE post_id = $idPost");
        $singlePost = mysqli_fetch_array ($isiPost);
        $post_judul = $singlePost['post_judul'];
        $post_tanggal = $singlePost['post_tanggal'];
        $post_konten = $singlePost['post_konten'];
        $post_modif = "true";
    }

?>

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><img src="assets/img/logo.png"></a>
    <ul class="nav-primary">
        <li><a href="new_post.php" style="padding-left: 10px;">+ New Post</a></li>
    </ul>
</nav>

<article class="art simple post">
    
    
    <h2 class="art-title" style="margin-bottom:40px">-</h2>

    <div class="art-body">
        <div class="art-body-inner">
            <h6>Add Post</h6>

            <div id="contact-area">
                <form method="post" action="index.php?id=<?=$idPost;?>&modif=<?=$post_modif;?>" onsubmit="return validasiTanggal();"
                        name="formPost">
                    <label for="Judul">Title:</label>
                    <input type="text" name="Judul" id="Judul" required value = "<?php echo $post_judul; ?>" >

                    <label for="Tanggal">Date:</label>
                    <input type="Date" name="Tanggal" id="Tanggal" required value = <?php echo $post_tanggal; ?>>
                    
                    <label for="Konten">Content:</label><br>
                    <textarea name="Konten" rows="20" cols="20" id="Konten" required><?php echo $post_konten; ?></textarea>

                    <input type="submit" name="submit" value="Submit Post" class="submit-button">
                </form>
            </div>
        </div>
    </div>

</article>

<footer class="footer">
    <div class="back-to-top"><a class="btt" href="">Back to top</a></div>
    <div class="psi">Kanyap</div>
</footer>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<script>
    function validasiTanggal() {
        var inputTgl = document.forms["formPost"]["Tanggal"].value;
        var currentDate = new Date();

        // parse each content from date
        var arrTgl = inputTgl.split("-");
        var inputTahun = arrTgl[0];
        var inputBulan = arrTgl[1];
        var inputHari = arrTgl[2];
        
        // passes the contents of inputDate to the same data format as currentDate
        var inputDate = new Date();
        inputDate.setFullYear(inputTahun,inputBulan-1,inputHari);

        // compare with current date
        if (inputDate >= currentDate) {
            return true;
        } else {
            alert("Enter a date greater than or equal to today");
            return false;
        }
    }
</script>

<?php mysqli_close($con); ?>

</body>
</html>