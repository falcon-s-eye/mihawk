<?php
//fonction qui recupere tous les articles
function getArticles()
{
    require('config/connect.php');
    $req = $bdd->prepare('SELECT id,date,title FROM article ORDER BY id DESC');
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
    $req->closeCursor();
}
//fonction qui recupere un article
function getArticle($id)
{
	require('config/connect.php');

	$req = $bdd->prepare('SELECT *FROM article WHERE id=? ');
	$req->execute(array($id));
	if($req->rowcount() == 1)//si il ya une reconnaissance de l'id
	{
		$data = $req->fetch(PDO::FETCH_OBJ);
		return $data;
	}
	else
		header('Location: index.php');
	
	$req->closeCursor();
}
/*fonction qui ajout un comment a la base de donnee*/
function addComment($article_id, $author, $comment)
{
	require('config/connect.php');
	$req = $bdd->prepare('INSERT INTO comments ( article_id , author, comments , date) VALUES (?,?,?,NOW())');//NOW(): insert automatiquement la date
	$req->execute(array( $article_id, $author , $comment));
	$req->closeCursor();
}
//fonction qui recupere les commentaires d'un article

function getComment($id)
{
    require('config/connect.php');
    $req = $bdd->prepare('SELECT * FROM comments WHERE article_id=?');
    $req->execute(array($id));
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
    $req->closeCursor();
}
//fonction qui ajoute un article
function addArticle($id, $title, $content)
{
    require('config/connect.php');
    $req = $bdd->prepare('INSERT INTO article(id, title, content, date) VALUES(?,?,?, NOW())');
    $req->execute(array($id, $title, $content));
    $req->closeCursor();
}

?>