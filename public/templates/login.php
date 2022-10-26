<?php $title = 'Login'; ?>

<?php ob_start();?>
<section class="width height">
    <h1 class="title mb-20">Connectez-Vous au Blog pour pouvoir créer ou modifier des articles</h1>

    <?php if(!isset($_SESSION['LOGGED_USER'])): ?>

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
                    <label for="email" class="form-label main-text">Email</label>
                    <input type="email" class="form-control main-text" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com" value="<?php if($_POST) echo strip_tags($_POST['email']); ?>">
                    <?php if (!empty($errors['email'])): ?>
                        <span class="error main-text text-brown font-semibold"><?= $errors['email']?></span>
                    <?php endif; ?>
                </div>
                <p id="email-help" class="text-green-500 description">L'email utilisé lors de la création du compte.</p>
            </div>

            <div class="mb-3 main-text space-y-2 flex flex-col">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
                <?php if (!empty($errors['password'])): ?>
                    <span class="error main-text text-brown font-semibold"><?= $errors['password']?></span>
                <?php endif; ?>
            </div>

            <div class="flex justify-center">
                <div class="button-g" title="Envoyez le formulaire">
                    <button type="submit" class="button-green">Envoyer</button>
                </div>
            </div>
        </div>
    </form>
    <?php endif; ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require ('layout.php');