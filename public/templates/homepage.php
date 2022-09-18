<?php $title = 'Blog'; ?>

<?php ob_start();?>
<section class="flex justify-center height">
    <div class="py-16 bg-blob bg-no-repeat bg-center bg-10 my-20 w-2/4 md:bg-15 lg:bg-14 lg:bg-left-bottom lg:w-1/4">
        <h1 class="title">Connaissez-vous le développement web ?</h1>
    </div>
</section>

<section class="bg-gradient-to-r from-green to-green-500 skew-y-3 height space-y-20">
    <div class="width text-white text-center font-oleo font-black text-2xl md:text-3xl lg:text-4xl">
        <h1 class="md:mx-32 lg:mx-52">Venez découvrir de nombreux articles qui vous racontent l'histoire du code</h1>
    </div>

    <div class="bg-white py-14 m-auto w-2/4 lg:w-1/4">
        <p class="font-fira text-center font-semibold text-lg md:text-xl lg:text-2xl">Nous commencerons par le PHP</p>
    </div>
</section>


<section class="bg-gradient-to-r from-brown to-brown-500 skew-y-3 mt-10">
    <div class="width height flex flex-wrap -skew-y-3 gap-x-5 gap-y-5 lg:flex-nowrap lg:gap-y-0 lg:gap-x-10">
        <article class="bg-black shadow-2xl height border-b-10 border-solid border-blue">
            <div class="container-big">
                <div class="mx-10 grid grid-cols-blog gap-x-10 gap-y-10 md:grid-cols-blog-md">
                    <div class="space-y-5 flex-1 text-white">
                        <p class="text-brown">18 juin 2019</p>

                        <img src="./img/blog-dev.jpg" alt="" class="w-64">

                        <h1 class="subtitle">Test</h1>

                        <p class="main-text">On va voir comment se présente le blog</p>

                        <div class="flex justify-center">
                            <div class="button-b" title="Cliquez ici pour découvrir l'article">
                                <a href="post.html">
                                    <p class="button-brown">Lire l'article</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <article class="bg-black shadow-2xl height border-b-10 border-solid border-blue">
            <div class="container-big">
                <div class="mx-10 grid grid-cols-blog gap-x-10 gap-y-10 md:grid-cols-blog-md">
                    <div class="space-y-5 flex-1 text-white">
                        <p class="text-brown">18 juin 2019</p>

                        <img src="./img/blog-dev.jpg" alt="" class="w-64">

                        <h1 class="subtitle">Test</h1>

                        <p class="main-text">On va voir comment se présente le blog</p>

                        <div class="flex justify-center">
                            <div class="button" title="Cliquez ici pour découvrir l'article">
                                <a href="post.html">
                                    <p class="button-brown">Lire l'article</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<section class="bg-marbre skew-y-3 height">
    <div class="bg-blue py-14 m-auto w-2/4 lg:w-1/4">
        <p class="font-fira text-center text-white text-2xl font-semibold">Le JavaScript sera la suite</p>
    </div>
</section>

<section class="bg-gradient-to-r from-blue to-blue-500 skew-y-3">
    <div class="width height flex flex-wrap -skew-y-3 gap-x-5 gap-y-5 lg:flex-nowrap lg:gap-y-0 lg:gap-x-10">
        <article class="bg-black shadow-2xl height border-b-10 border-solid border-brown">
            <div class="container-big">
                <div class="mx-10 grid grid-cols-blog gap-x-10 gap-y-10 md:grid-cols-blog-md">
                    <div class="space-y-5 flex-1 text-white">
                        <p class="text-blue">18 juin 2019</p>

                        <img src="./img/blog-dev.jpg" alt="" class="w-64">

                        <h1 class="subtitle">Test</h1>

                        <p class="main-text">On va voir comment se présente le blog</p>

                        <div class="flex justify-center">
                            <div class="button-b" title="Cliquez ici pour découvrir l'article">
                                <a href="post.html">
                                    <p class="button-blue">Lire l'article</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <article class="bg-black shadow-2xl height border-b-10 border-solid border-brown">
            <div class="container-big">
                <div class="mx-10 grid grid-cols-blog gap-x-10 gap-y-10 md:grid-cols-blog-md">
                    <div class="space-y-5 flex-1 text-white">
                        <p class="text-blue">18 juin 2019</p>

                        <img src="./img/blog-dev.jpg" alt="" class="w-64">

                        <h1 class="subtitle">Test</h1>

                        <p class="main-text">On va voir comment se présente le blog</p>

                        <div class="flex justify-center">
                            <div class="button-b" title="Cliquez ici pour découvrir l'article">
                                <a href="post.html">
                                    <p class="button-blue">Lire l'article</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require ('layout.php');
