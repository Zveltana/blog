<?php $title = 'Erreur'; ?>

<?php ob_start();?>
    <section class="width height">
        <div class="bg-white space-y-5 border-solid border-4 border-brown rounded-2xl">
            <div class="width height space-y-20">
                <h1 class="title">Grosse erreur</h1>

                <p class="main-text text-center"><?= $errorMessage ?></p>
            </div>
        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require ('layout.php');
