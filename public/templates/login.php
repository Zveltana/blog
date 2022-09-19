<?php $title = 'Login'; ?>

<?php ob_start();?>
<section class="width height">
    <h1 class="title mb-20">Connectez-Vous au Blog pour pouvoir créer ou modifier des articles</h1>

    <?php if(!isset($_SESSION['loggedUser'])): ?>

    <form action="" method="post" class="bg-white space-y-5 border-solid border-4 border-brown rounded-2xl">
        <div class="height width">
            <!-- si message d'erreur on l'affiche -->
            <?php if(isset($errorMessage)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <div class="space-x-5">
                    <label for="email" class="form-label main-text">Email</label>
                    <input type="email" class="form-control main-text" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
                    <?php if (!empty($errors['email'])): ?>
                        <span class="error"><?= $errors['email']?></span>
                    <?php endif; ?>
                </div>
                <p id="email-help" class="text-green-500 description">L'email utilisé lors de la création du compte.</p>
            </div>

            <div class="mb-3 main-text space-x-5">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
                <?php if (!empty($errors['password'])): ?>
                    <span class="error"><?= $errors['password']?></span>
                <?php endif; ?>
            </div>

            <div class="flex">
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