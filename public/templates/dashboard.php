<?php $title = 'Blog'; ?>

<?php ob_start();?>

<section class="bg-gradient-to-r from-brown to-brown-500 skew-y-3 mt-10">
    <h1 class="title -skew-y-3 pt-20">Gestion des utilisateurs</h1>
    <div class="width height flex flex-wrap -skew-y-3 gap-x-5 gap-y-5 lg:gap-y-10 lg:gap-x-10">
        <?php foreach ($users as $user) {?>
            <article class="bg-black shadow-2xl height border-b-10 border-solid border-blue w-2/4 lg:w-1/4">
                <div class="container-big">
                    <div class="gap-x-10 mx-5 2xl:mx-10">
                        <div class="space-y-5 flex-1 text-white">
                            <h2 class="subtitle"><?= $user->getFullName() ?></h2>

                            <p class="main-text"><?= $user->getEmail() ?></p>

                            <?php if($user->getIsADMIN() === false):?>
                            <div class="flex flex-col items-center gap-y-10">
                                    <form action="index.php?action=updateUser&id=<?= $user->getIdentifier() ?>" method="post">
                                        <div class="flex flex-col items-center gap-x-10 gap-y-10 2xl:flex-row">
                                            <div class="space-y-2">
                                                <div>
                                                    <label for="is_visitor">Visieur</label>

                                                    <input type="radio" id="is_visitor" name="status" value=0 checked>
                                                </div>

                                                <div>
                                                    <label for="is_admin">Admin</label>

                                                    <input type="radio" id="is_admin" name="status" value=1>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="button-status" title="Effectuer la modification">
                                                    <button type="submit" class="button-brown">Modifier</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div>
                                        <div class="button-status" title="Supprimer l'utilisateur'">
                                            <a href="index.php?action=deleteUser&id=<?= $user->getIdentifier() ?>" class="button-brown">Supprimer</a>
                                        </div>
                                    </div>
                            </div>
                            <?php else: ?>
                                <p class="main-text"><?= $user->getIsAdmin() ? "Admin" : "Visiteur" ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </article>
        <?php } ?>
    </div>
</section>

<section class="bg-gradient-to-r from-blue to-blue-500 skew-y-3">
    <h1 class="title -skew-y-3 pt-20">Gestion des commentaires</h1>
    <div class="width height flex flex-wrap -skew-y-3 gap-x-5 gap-y-10 lg:gap-x-10">
        <?php foreach ($posts as $post){ ?>
            <?php foreach ($comments as $comment){ ?>
                <?php if($comment->postId->identifier === $post->identifier):?>
                    <?php if($comment->IsEnabled === false):?>
                        <article class="bg-black shadow-2xl height border-b-10 border-solid border-brown w-2/4 lg:w-1/4">
                            <div class="container-big">
                                <div class="gap-x-10 mx-5 2xl:mx-10">
                                    <div class="space-y-5 flex-1 text-white">
                                        <h1 class="title"> <?= $post->title?></h1>

                                        <h2 class="subtitle"><?= $comment->title ?></h2>

                                        <p class="main-text"><?= $comment->comment ?></p>

                                        <div class="flex flex-col items-center gap-y-5">
                                            <div>
                                                <div class="button-status" title="Valider le commentaire">
                                                    <a href="index.php?action=checkComment&id=<?= $comment->identifier ?>" class="button-brown">Valider</a>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="button-status" title="Supprimer le commentaire">
                                                    <a href="index.php?action=deleteComment&id=<?= $comment->identifier ?>" class="button-brown">Supprimer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endif; ?>
                <?php endif; ?>
            <?php }?>
        <?php } ?>
    </div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require ('layout.php');
