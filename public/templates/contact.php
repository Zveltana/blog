<?php $title = 'Contact'; ?>

<?php ob_start();?>
    <section class="width height">
        <h1 class="title mb-20">Pour nous contacter</h1>

        <form action="" method="post" class="bg-white space-y-5 border-solid border-4 border-brown rounded-2xl">
            <div class="height width space-y-10">
                <!-- si message d'erreur on l'affiche -->
                <?php if(isset($errorMessage)) : ?>
                    <div class="main-text font-semibold text-brown mb-5" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <div class="space-y-2 flex flex-col">
                        <label for="firstName" class="form-label main-text">Votre Prénom</label>
                        <input type="text" class="form-control main-text" id="firstName" name="firstName">
                        <?php if (!empty($errors['firstName'])): ?>
                            <span class="error main-text text-brown font-semibold"><?= $errors['firstName']?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3 main-text space-y-2 flex flex-col">
                    <label for="lastName" class="form-label">Votre Nom</label>
                    <input type="text" class="form-control" id="lastName" name="lastName">
                    <?php if (!empty($errors['lastName'])): ?>
                        <span class="error main-text text-brown font-semibold"><?= $errors['lastName']?></span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <div class="space-y-2 flex flex-col">
                        <label for="email" class="form-label main-text">Votre Email</label>
                        <input type="email" class="form-control main-text" id="email" name="email">
                        <?php if (!empty($errors['email'])): ?>
                            <span class="error main-text text-brown font-semibold"><?= $errors['email']?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="space-y-2 flex flex-col">
                        <label for="subject" class="form-label main-text">Votre Sujet</label>
                        <input type="text" class="form-control main-text" id="subject" name="subject">
                        <?php if (!empty($errors['subject'])): ?>
                            <span class="error main-text text-brown font-semibold"><?= $errors['subject']?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3 main-text space-y-2 flex flex-col">
                    <label for="content" class="form-label">Votre Message</label>
                    <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                    <?php if (!empty($errors['content'])): ?>
                        <span class="error main-text text-brown font-semibold"><?= $errors['content']?></span>
                    <?php endif; ?>
                </div>

                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                <div class="flex justify-center">
                    <div class="button-g" title="Envoyez le formulaire">
                        <button type="submit" class="button-green">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require ('layout.php');