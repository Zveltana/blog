<?php $title = 'Blog';

ob_start(); ?>

<div class="height width space-y-10">
    <p><a href="index.php" class="main-text text-brown-500 hover:text-green-500">Retour aux différents articles</a></p>

    <section class="flex justify-center">
        <div class="py-16 bg-blob-brown bg-no-repeat bg-center bg-10 my-20 w-2/4 md:bg-15 lg:bg-14 lg:bg-left-top lg:w-2/5">
            <h1 class="title"><?= htmlspecialchars($post -> title) ?></h1>

            <p class="main-text text-center">Date de l'article : <?= $post -> frenchCreationDate ?></p>
        </div>
    </section>

    <section class="bg-brown space-y-10 height px-8 md:px-16 xl:px-64">
        <h1 class="subtitle text-white"><?= htmlspecialchars($post -> description) ?></h1>
        <p class="main-text text-white">
            <?= nl2br (htmlspecialchars($post -> content)) ?>
        </p>
    </section>

    <div class="height bg-white px-8 md:px-16 xl:px-64">
        <h2 class="subtitle mb-10">Commentaires</h2>

        <?php foreach ($comments as $comment) {?>
            <div class="space-y-3">
                <p class="main-text"><?= nl2br(htmlspecialchars($comment -> comment)) ?></p>

                <p><strong>Ecrit par : <?= htmlspecialchars($comment -> author) ?></strong> le <?= $comment -> frenchCreationDate ?> (<a href="index.php?action=editComment&id=<?= $comment-> identifier?>" class="text-brown-500 hover:text-green-500">modifier</a>)</p>
            </div>

            <hr class="border-brown border-2 my-5">
        <?php } ?>
    </div>

    <?php if(isset($_SESSION['LOGGED_USER'])):?>
    <form action="index.php?action=addComment&id=<?= $post -> identifier?>" method="post" class="bg-white space-y-5 border-solid border-4 border-brown rounded-2xl">
        <div class="height width">
            <p class="subtitle text-brown-500 mb-10">Ajouter un commentaire</p>

            <?php if(isset($errorMessage)) : ?>
                <div class="main-text font-semibold text-brown mb-5" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <div class="space-x-5">
                    <label for="author" class="form-label main-text">Auteur</label>
                    <input type="text" class="form-control main-text" id="author" name="author">
                    <?php if (!empty($errors['author'])): ?>
                        <span class="error main-text text-brown font-semibold"><?= $errors['author']?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mb-3 main-text space-x-5">
                <label for="comment" class="form-label">Commentaire</label>
                <input type="comment" class="form-control" id="comment" name="comment">
                <?php if (!empty($errors['comment'])): ?>
                    <span class="error main-text text-brown font-semibold"><?= $errors['comment']?></span>
                <?php endif; ?>
            </div>

            <div class="flex">
                <div class="button-b" title="Envoyez le formulaire">
                    <button type="submit" class="button-brown">Envoyer</button>
                </div>
            </div>
        </div>
    </form>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();

require('layout.php');
?>

