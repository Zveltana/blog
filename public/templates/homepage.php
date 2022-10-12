<?php $title = 'Blog'; ?>

<?php ob_start();?>
<section class="height width">
    <h1 class="title pb-20">Bienvenue sur le Blog d'Amélia MASSOT</h1>

    <div class="flex flex-col gap-y-10 items-center lg:gap-y-0 lg:gap-x-20 lg:flex-row lg:flex-nowrap">
        <div class="space-y-10">
            <?php echo $_SESSION['token'] ?>
            <h2 class="subtitle">Laissez moi me présenter en quelques lignes.</h2>

            <p class="main-text text-justify">Je suis une développeuse en alternance depuis maintenant un an dans l'entreprise
                AKAWAKA.
                J'ai un parcour de graphiste/web Designer ce qui me permet aujourd'hui,
                en plus de ma formation de développeuse de concevoir des sites de A à Z, du visuel, de l'intégration
                jusqu'au back. J'ai crée ce blog pour vous permettre de
                découvrir en même temps que moi les recoins du développement web. J'espère que les articles vous
                plairons et
                n'hésitez pas à me contacter sur mes différents réseaux sociaux.</p>

            <div class="flex w-20 flex-wrap justify-around md:w-32">
                <a href="https://www.linkedin.com/in/am%C3%A9lia-massot-d%C3%A9veloppement-communication-digital-web/" target="_blank" class="justify-around">
                    <img src="img/linkedin.svg"
                         alt="icone linkedin"
                         title="Logo Linkedin"
                         class="w-6 md:w-8 xl:w-10"/>
                </a>

                <a href="https://twitter.com/Amel_CSGO" target="_blank" class="justify-around">
                    <img src="img/twitter.svg"
                         alt="icone twitter"
                         title="Logo Twitter"
                         class="w-6 md:w-8 xl:w-10 bg-brown rounded-full"/>
                </a>

                <a href="https://github.com/Zveltana" target="_blank" class="justify-around">
                    <img src="img/github.svg"
                         alt="icone github"
                         title="Logo Github"
                         class="w-6 md:w-8 xl:w-10"/>
                </a>
            </div>
        </div>

        <img src="img/amelia.jpg" alt="photo d'Amélia MASSOT" class="rounded-full border-4 border-brown object-cover w-2/5">
    </div>

    <div class="flex justify-center">
        <div class="button" title="Cliquez ici pour découvrir l'article">
            <a href="index.php?action=posts">
                <p class="button-primary hover:text-white">Accéder aux articles ⇨</p>
            </a>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require ('layout.php');
