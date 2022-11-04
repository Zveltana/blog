<?php $title = 'submitContact'; ?>

<?php ob_start();?>
    <section class="width height">
        <div class="bg-white space-y-5 border-solid border-4 border-brown rounded-2xl">
            <div class="height width">
                <h1 class="title mb-20">Votre message a bien été envoyé</h1>

                <div class="flex justify-center">
                    <div class="button" title="Cliquez ici pour retouner à la page d'accueil">
                        <a href="index.php">
                            <p class="button-primary hover:text-white p-1">Retourner à la page d'accueil ⇨</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require 'layout.php';