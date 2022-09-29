<?php $title = 'Blog'; ?>

<?php ob_start();?>

<section class="bg-gradient-to-r from-brown to-brown-500 skew-y-3 mt-10">
    <div class="width height flex flex-wrap -skew-y-3 gap-x-5 gap-y-5 lg:flex-nowrap lg:gap-y-0 lg:gap-x-10">
        <?php foreach ($users as $user) {?>
            <article class="bg-black shadow-2xl height border-b-10 border-solid border-blue w-2/4 lg:w-1/4">
                <div class="container-big">
                    <div class="mx-10 grid grid-cols-blog gap-x-10 gap-y-10 md:grid-cols-blog-md">
                        <div class="space-y-5 flex-1 text-white">
                            <h1 class="subtitle"><?= $user->getFullName() ?></h1>

                            <p class="main-text"><?= $user->getEmail() ?></p>

                            <p class="main-text"><?= $user->getIsAdmin() ? "Admin" : "Visiteur" ?></p>


                        </div>
                    </div>
                </div>
            </article>
        <?php } ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require ('layout.php');
