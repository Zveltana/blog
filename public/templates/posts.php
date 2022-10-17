<?php $title = 'Blog'; ?>

<?php ob_start();?>

<section class="height">
    <div class="container-big flex justify-center">
        <div class="py-16 bg-blob bg-no-repeat bg-center bg-10 my-20 w-2/4 md:bg-15 lg:bg-14 lg:bg-left-bottom lg:w-1/4">
            <h1 class="title">Connaissez-vous le développement web ?</h1>
        </div>
    </div>
</section>

<section class="bg-gradient-to-r from-green to-green-500 skew-y-3 height">
    <div class="container-big space-y-20">
        <div class="width text-white text-center font-oleo font-black text-2xl md:text-3xl lg:text-4xl">
            <h1 class="md:mx-32 lg:mx-52">Venez découvrir de nombreux articles qui vous racontent l'histoire du code</h1>
        </div>

        <div class="bg-white py-14 m-auto w-2/4 lg:w-1/4">
            <p class="font-fira text-center font-semibold text-lg md:text-xl lg:text-2xl">Nous commencerons par le PHP</p>
        </div>
    </div>
</section>


<section class="bg-gradient-to-r from-brown to-brown-500 skew-y-3 mt-10">
    <?php foreach ($categories as $category) { ?>
        <?php if ($category->name === 'PHP' ):?>
            <div class="container-big">
                <div class="width height flex flex-wrap -skew-y-3 gap-x-5 gap-y-10 lg:gap-x-10">
                     <?php foreach ($posts as $post){ ?>
                        <?php if ($post-> categoryId === $category->identifier ):?>
                            <article class="bg-black shadow-2xl py-10 border-b-10 border-solid border-blue w-2/4 lg:w-1/4">
                                <div class="gap-x-10 mx-5 2xl:mx-10">
                                    <div class="space-y-5 flex-1 text-white">
                                        <p class="text-brown"><?= htmlspecialchars($post->frenchCreationDate)?></p>

                                        <div class="flex justify-center">
                                            <img src="<?= $post->picture ?>" alt="" class="w-64">
                                        </div>

                                        <h1 class="subtitle"><?= htmlspecialchars($post->title)?></h1>

                                        <p class="main-text"><?= htmlspecialchars($post->description)?></p>

                                        <form action="index.php?action=post" method="post" class="flex justify-center">
                                            <div class="button-b" title="Cliquez ici pour découvrir l'article">
                                                <button class="button-brown">Lire l'article</button>

                                                <input type="hidden" name="identifier" value="<?= $post->identifier ?>">
                                            </div>
                                        </form>

                                        <?php if(isset($_SESSION['LOGGED_USER']) && $_SESSION['LOGGED_USER_ID'] === $post->author): ?>
                                            <form action="index.php?action=updatePost" method="post" class="flex justify-center">
                                                <div class="button-b" title="Cliquez ici pour modifier l'article">
                                                    <button class="button-brown">Modifier l'article</button>

                                                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                                    <input type="hidden" name="title" value="<?= $post->title ?>">
                                                    <input type="hidden" name="description" value="<?= $post->description ?>">
                                                    <input type="hidden" name="content" value="<?= $post->content ?>">

                                                    <input type="hidden" name="identifier" value="<?= $post->identifier ?>">
                                                </div>
                                            </form>

                                            <form action="index.php?action=deletePost" method="post" class="flex justify-center">
                                                <div class="button-b" title="Cliquez ici pour supprimer l'article">
                                                    <button class="button-brown">Supprimer l'article</button>

                                                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                                                    <input type="hidden" name="identifier" value="<?= $post->identifier ?>">
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        <?php endif; ?>
                    <?php } ?>
                 </div>
             </div>

            <?php if(isset($_SESSION['LOGGED_USER'])):?>
                <div class="flex justify-center -skew-y-3">
                    <div class="button-add-php" title="Cliquez ici pour ajouter un article">
                        <a href="index.php?action=addPost&id=<?= urlencode($category->identifier) ?>">
                            <p class="button-add-php-article">+ Ajouter un article</p>
                        </a>
                    </div>
                </div>
            <?php endif;?>
        <?php endif; ?>
    <?php } ?>
</section>

<section class="bg-marbre skew-y-3 height">
    <div class="container-big">
        <div class="bg-blue py-14 m-auto w-2/4 lg:w-1/4">
            <p class="font-fira text-center text-white text-2xl font-semibold">Le JavaScript sera la suite</p>
        </div>
    </div>
</section>

<section class="bg-gradient-to-r from-blue to-blue-500 skew-y-3">
    <?php foreach ($categories as $category) { ?>
        <?php if ($category->name === 'JavaScript' ):?>
            <div class="container-big">
                <div class="width height flex flex-wrap -skew-y-3 gap-x-5 gap-y-10 lg:gap-x-10">
                    <?php foreach ($posts as $post){ ?>
                        <?php if ($post-> categoryId === $category->identifier ):?>
                            <article class="bg-black shadow-2xl py-10 border-b-10 border-solid border-brown w-2/4 lg:w-1/4">
                                <div class="gap-x-10 mx-5 2xl:mx-10">
                                    <div class="space-y-5 flex-1 text-white">
                                        <p class="text-blue"><?= htmlspecialchars($post->frenchCreationDate)?></p>

                                        <div class="flex justify-center">
                                            <img src="<?= $post->picture ?>" alt="" class="w-64">
                                        </div>

                                        <h1 class="subtitle"><?= htmlspecialchars($post->title)?></h1>

                                        <p class="main-text"><?= htmlspecialchars($post->description)?></p>

                                        <form action="index.php?action=post" method="post" class="flex justify-center">
                                            <div class="button-bl" title="Cliquez ici pour découvrir l'article">
                                                <button class="button-blue">Lire l'article</button>

                                                <input type="hidden" name="identifier" value="<?= $post->identifier ?>">
                                            </div>
                                        </form>

                                        <?php if(isset($_SESSION['LOGGED_USER']) && $_SESSION['LOGGED_USER_ID'] === $post->author): ?>
                                            <form action="index.php?action=updatePost" method="post" class="flex justify-center">
                                                <div class="button-bl" title="Cliquez ici pour modifier l'article">
                                                    <button class="button-blue">Modifier l'article</button>

                                                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                                    <input type="hidden" name="title" value="<?= $post->title ?>">
                                                    <input type="hidden" name="description" value="<?= $post->description ?>">
                                                    <input type="hidden" name="content" value="<?= $post->content ?>">

                                                    <input type="hidden" name="identifier" value="<?= $post->identifier ?>">
                                                </div>
                                            </form>

                                            <form action="index.php?action=deletePost" method="post" class="flex justify-center">
                                                <div class="button-bl" title="Cliquez ici pour supprimer l'article">
                                                    <button class="button-blue">Supprimer l'article</button>

                                                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                                                    <input type="hidden" name="identifier" value="<?= $post->identifier ?>">
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        <?php endif; ?>
                    <?php } ?>
                </div>
            </div>

            <?php if(isset($_SESSION['LOGGED_USER'])):?>
                <div class="flex justify-center -skew-y-3">
                    <div class="button-add-js" title="Cliquez ici pour ajouter un article">
                        <a href="index.php?action=addPost&id=<?= urlencode($category->identifier)?>">
                            <p class="button-add-js-article">+ Ajouter un article</p>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php } ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require ('layout.php');