<?php
if (!isset($_GET['id'] ) OR !is_numeric($_GET['id']))
 {
	header('Location: index.php');

}
else
{
	extract($_GET);
	$id = strip_tags($id);//supprime les balises html et php
	
	require_once('config/functions.php');
	
	if(!empty($_POST))
	{
		extract($_POST);
		$errors = array();

		$author = strip_tags($author);
		$comment = strip_tags($comment);

		if (empty($author))
			array_push($errors, 'Enter a pseudo');
	

		if(empty($comment))
			array_push($errors, 'Enter a comment');
		

		if(count($errors) == 0)//si il nya rien dans le tableau d'erreur
		{
			$comment = addComment($id,$author,$comment);
			$success = 'Your comment is published';
			unset($author);//vide le champ author du formulaire apres envoie
			unset($comment);
		}
	}

	$article = getArticle($id);
    $comments = getComment($id);
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('blognavbar.php');?>
	<meta charset="utf-8"/>
	<title><?= $article->title ?></title>
    <link rel="stylesheet" href="../mihawk.CSS">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
        
        
        <h1><?= $article->title ?></h1>
        <p><?= $article->content ?></p>
        <hr>

        <?php
        if (isset($success)) {
            echo $success;
        }
        if (!empty($errors)):?>
        <?php foreach ($errors as $error): ?>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-danger"><?= $error?></div>
                
                </div>
            </div>
    
        <?php endforeach;?>
    <?php endif; ?>
        
        <div class="row">
            <div class="col-md-6">
            <form action="article.php?id=<?= $article->id?>" method="post">
                <p><label for="author">Pseudo:</label><br>
                <input type="text" name="author" id="author" value="<?php if(isset($author)) echo $author?>" class="form-control"/></p>
                <p><label for="comment">Comment:</label><br>
                    <textarea name="comment" id="comment" cols="30" rows="5" class="form-control"><?php if(isset($comment)) echo $comment?></textarea></p>
                    <button type="submit" class="btn btn-success">Send</button>
            </form>
                    
            </div>
            
    </div><br>
    <button class="btn btn-warning"><a href="index.php">Back to the articles pages</a></button>
</div>
    <div class="container-fluid">
        <div class="row comment">
            <div class=" col-xs-12 col-md-12 col-lg-12 text-center">
    <h1>Comments</h1>
                <hr>
        <?php foreach($comments as $com): ?>
            <p> Date:<time><?= $com->date?></time></p>
                Author:<h4><?= $com->author?></h4>
            <p>content:<?= ' '.$com->comments?></p>
                <hr>
        <?php endforeach;?>
                
                </div>
        </div>
	</div>
    <?php include('blogfooter.php');?>
</body>
</html>