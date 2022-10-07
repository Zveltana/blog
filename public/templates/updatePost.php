<?php $title = 'Update Post'; ?>

<?php ob_start();?>
    <section class="width height">
        <h1 class="title mb-20">Modification du commentaire : <?= $post->title ?></h1>

        <form action="" method="post" class="bg-white space-y-5 border-solid border-4 border-brown rounded-2xl">
            <div class="height width">
                <!-- si message d'erreur on l'affiche -->
                <?php if(isset($errorMessage)) : ?>
                    <div class="main-text font-semibold text-brown mb-5" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <div class="space-x-5">
                        <label for="title" class="form-label main-text">Titre</label>
                        <input type="text" class="form-control main-text" id="title" name="title" value="<?= $post->title ?>">
                    </div>
                </div>

                <div class="mb-3 main-text space-x-5">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="<?= $post->description ?>">
                </div>

                <div class="mb-3 main-text space-x-5">
                    <label for="content" class="form-label">Contenu</label>
                    <textarea id="content" name="content"><?= $post->content ?></textarea>
                </div>

                <div class="flex">
                    <div class="button-g" title="Modifier l'article">
                        <button type="submit" class="button-green">Modifier</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require ('layout.php');