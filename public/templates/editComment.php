<?php $title="Le Blog de l'AVBN";

ob_start();
?>

<h1>Le super Blog de l'AVBN !</h1>

<p><a href="index.php?action=post&id=<?= $comment->post ?>">Retour au billet</a> </p>

<h1>Modifier le commentaire d'<?= htmlspecialchars($comment->author)?></h1>

<form action="index.php?action=editComment&id=<?= htmlspecialchars($comment->identifier)?>" method="post">
    <div>
        <label for="author">Auteur</label>

        <input name="author" id="author" value="<?= htmlspecialchars($comment->author) ?>">
    </div>

    <div>
        <label for="comment">Commentaire</label>

        <textarea name="comment" id="comment"><?= htmlspecialchars($comment->comment) ?></textarea>
    </div>

    <div>
        <input type="submit">
    </div>
</form>

<?php

$content = ob_get_clean();

require('layout.php');

?>
