<?php
require_once('config/functions.php');

$articles = getArticles();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title> Mon blog</title>
    <link rel=stylesheet href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../mihawk.CSS">
    <script type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        
        <?php include('blognavbar.php');?>
        <div class="container-fluid">
            <div class="row">
                <div class=" col-xs-12 col-sm-6 col-md-12 col-lg-12">
        <u><h1 style="margin: 4rem;">Articles</h1></u>
        <?php foreach($articles as $article):?>
        <div class="text-center text-warning"><u><h2><?php echo 'Article number'.' '.$article->id ?></h2></u></div>
       <div class="text-center"> <h2><?= $article->title ?></h2></div>
        <div class="text-center"><time><?= $article->date?></time></div>
        <br><br>
        <div class="text-center"><a href="article.php?id=<?= $article->id ?>" class="btn btn-primary" style="margin: 2rem;">More</a></div>
        <?php endforeach;?><br><br>
                    </div>
                </div>
            </div>
         <?php include('blogfooter.php');?>
            
    </body>

</html>