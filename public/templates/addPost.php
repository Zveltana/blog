<?php $title = 'Ajouter un article'; ?>

<?php ob_start();?>
    <?php $postData = $_POST;?>
    <section class="width height">
        <h1 class="title mb-20">Ajouter un article de blog</h1>

        <form action="" method="post" enctype="multipart/form-data" class="bg-white space-y-5 border-solid border-4 border-brown rounded-2xl">
            <div class="height width space-y-10">
                <!-- si message d'erreur on l'affiche -->
                <?php if(isset($errorMessage)) : ?>
                    <div class="main-text font-semibold text-brown mb-5" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3 main-text space-y-2 flex flex-col">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php if($postData) {
                        echo strip_tags($postData['title']);
                    } ?>">
                    <?php if (!empty($errors['title'])): ?>
                        <span class="error main-text text-brown font-semibold"><?= $errors['title']?></span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <div class="space-y-2 flex flex-col">
                        <label for="description" class="form-label main-text">Description</label>
                        <input type="text" class="form-control main-text" id="description" name="description" value="<?php if($postData) {
                            echo strip_tags($postData['description']);
                        } ?>">
                        <?php if (!empty($errors['description'])): ?>
                            <span class="error main-text text-brown font-semibold"><?= $errors['description']?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3 main-text space-y-2 flex flex-col">
                    <label for="content" class="form-label">Contenu de l'article</label>
                    <textarea class="form-control" id="content" name="content" rows="5"><?php if($postData) {
                            echo strip_tags($postData['content']);
                        } ?></textarea>
                    <?php if (!empty($errors['content'])): ?>
                        <span class="error main-text text-brown font-semibold"><?= $errors['content']?></span>
                    <?php endif; ?>
                </div>

                <div class="mb-3 main-text space-y-2 flex flex-col">
                    <label for="picture" class="form-label">Image de l'article</label>
                    <input type="file" class="form-control" id="picture" name="picture">
                    <?php if (!empty($errors['picture'])): ?>
                        <span class="error main-text text-brown font-semibold"><?= $errors['picture']?></span>
                    <?php endif; ?>
                    <?php if (!empty($message['verify_picture'])): ?>
                        <span class="error main-text text-brown font-semibold"><?= $message['verify_picture']?></span>
                    <?php endif; ?>
                </div>

                <div class="flex justify-center">
                    <div class="button-g" title="Envoyez le formulaire">
                        <button type="submit" class="button-green">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require 'layout.php';