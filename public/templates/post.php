<?php $title = 'Blog';

ob_start(); ?>

<div class="height width space-y-10">
    <p><a href="index.php?action=posts" class="main-text <?php if($category->name === 'PHP'): ?>text-brown-500 hover:text-blue-500<?php else: ?>text-blue-500 hover:text-brown-500<?php endif;?>">Retour aux différents articles</a></p>

    <section class="flex justify-center">
        <div class="py-16 <?php if($category->name === 'PHP'):?>bg-blob-brown<?php else: ?>bg-blob-blue <?php endif; ?> bg-no-repeat bg-center bg-10 my-20 w-2/4 md:bg-15 lg:bg-14 lg:bg-left-top lg:w-2/5">
            <h1 class="title"><?= htmlspecialchars($post->title) ?></h1>

            <p class="main-text text-center">Date de l'article : <?= $post->frenchCreationDate ?></p>
        </div>
    </section>

    <section class="<?php if($category->name === 'PHP'): ?>bg-brown<?php else: ?>bg-blue<?php endif; ?> space-y-10 height px-8 md:px-16 xl:px-64">
        <p class="text-right subtitle text-white">Ecrit par : <?= htmlspecialchars($user->getFullName()) ?></p>
        <h1 class="subtitle text-white"><?= htmlspecialchars($post->description) ?></h1>
        <p class="main-text text-white">
            <?= nl2br (htmlspecialchars($post->content)) ?>
        </p>
    </section>

    <div class="height bg-white px-8 md:px-16 xl:px-64">
        <h2 class="subtitle mb-10">Commentaires</h2>

        <?php foreach ($comments as $comment) {?>
            <?php if ($comment->IsEnabled === true):?>
                <div class="space-y-3">
                    <p class="main-text <?php if($category->name === 'PHP'): ?>text-brown-500<?php else: ?>text-blue-500<?php endif;?>"><?= nl2br($comment->comment) ?></p>

                    <p><strong>Ecrit par : <?= $comment->author->getFullName() ?></strong> le <?= $comment->frenchCreationDate ?>
                        <?php if(isset($_SESSION['LOGGED_USER'])):?>(<a href="index.php?action=editComment&id=<?= $comment->identifier?>" class="<?php if($category->name === 'PHP'): ?>text-brown-500 hover:text-green-500<?php else: ?>text-blue-500 hover:text-brown-500<?php endif;?>">modifier</a>)</p><?php endif; ?>
                </div>

                <hr class="<?php if($category->name === 'PHP'): ?>border-brown<?php else: ?>border-blue<?php endif;?> border-2 my-5">
            <?php endif;?>
        <?php } ?>
    </div>

    <?php if(isset($_SESSION['LOGGED_USER'])):?>
    <form action="index.php?action=post&id=<?= $post->identifier?>" method="post" class="bg-white space-y-5 border-solid border-4 <?php if($category->name === 'PHP'): ?>border-brown<?php else: ?>border-blue<?php endif;?> rounded-2xl">
        <div class="height width">
            <p class="subtitle <?php if($category->name === 'PHP'): ?>text-brown-500<?php else: ?>text-blue-500<?php endif;?> mb-10">Ajouter un commentaire</p>

            <?php if(isset($errorMessage)) : ?>
                <div class="main-text font-semibold <?php if($category->name === 'PHP'): ?>text-brown<?php else: ?>text-blue<?php endif;?> mb-5" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <?php if(isset($message)) : ?>
                <div class="main-text font-semibold <?php if($category->name === 'PHP'): ?>text-brown<?php else: ?>text-blue<?php endif;?> mb-5" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="mb-3 main-text space-x-5 flex items-center">
                <label for="comment" class="form-label">Commentaire</label>
                <textarea class="form-control" id="comment" name="comment"></textarea>
                <?php if (!empty($errors['comment'])): ?>
                    <span class="error main-text <?php if($category->name === 'PHP'): ?>text-brown<?php else: ?>text-blue<?php endif;?> font-semibold"><?= $errors['comment']?></span>
                <?php endif; ?>
            </div>

            <div class="flex">
                <div class="<?php if($category->name === 'PHP'): ?>button-b<?php else: ?>button-bl<?php endif;?>" title="Envoyez le formulaire">
                    <button type="submit" class="<?php if($category->name === 'PHP'): ?>button-brown<?php else: ?>button-blue<?php endif;?>">Envoyer</button>
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

