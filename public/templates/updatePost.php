<?php $title = 'Update Article'; ?>

<?php ob_start();?>
    <section class="width height">
        <h1 class="title mb-20">Modification du commentaire : <?= $post->title ?></h1>

        <form action="" method="post" class="bg-white space-y-5 border-solid border-4 border-brown rounded-2xl" enctype="multipart/form-data">
            <div class="height width space-y-10">
                <!-- si message d'erreur on l'affiche -->
                <?php if(isset($errorMessage)) : ?>
                    <div class="main-text font-semibold text-brown mb-5" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <div class="space-y-2 flex flex-col">
                        <label for="title" class="form-label main-text">Titre</label>
                        <input type="text" class="form-control subtitle" id="title" name="title" value="<?= $post->title ?>">
                    </div>
                </div>

                <div class="mb-3 main-text space-y-2 flex flex-col">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="<?= $post->description ?>">
                </div>

                <div class="mb-3 main-text space-y-2 flex flex-col">
                    <label for="content" class="form-label">Contenu</label>
                    <textarea id="content" name="content" rows="5"><?= $post->content ?></textarea>
                </div>

                <div class="mb-3 main-text space-x-5 flex">
                    <div>
                        <label for="picture" class="form-label">Image de l'article</label>

                        <img src="<?= $post->picture?>" alt="" class="w-12 md:w-20">
                    </div>
                    <input type="file" id="picture" class="form-control" name="picture" value="<?= $post->picture ?>">
                </div>

                <?php if (!empty($message['verify_picture'])): ?>
                    <span class="error main-text text-brown font-semibold"><?= $message['verify_picture']?></span>
                <?php endif; ?>

                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                <input type="hidden" name="identifier" value="<?= $post->identifier ?>">

                <div class="flex justify-center">
                    <div class="button-g" title="Modifier l'article">
                        <button type="submit" class="button-green">Modifier</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require ('layout.php');