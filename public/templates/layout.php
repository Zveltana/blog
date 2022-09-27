<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../dist/style.css">
    <title><?=$title?></title>
</head>
<body class="bg-marbre bg-no-repeat bg-cover">
    <header class="bg-black text-white py-10 border-b-8 border-brown flex items-center">
        <a href="index.php" class="text-xl font-fira ml-20"><img src="img/logo.png" alt="logo" class="w-32"></a>

        <div class="largeur flex flex-1 items-center justify-between">
            <div class="2xl:container 2xl:mx-auto flex flex-1 items-center justify-end lg:justify-center">
                <nav>
                    <ol class="hidden list-none txtshadow gap-x-7 font-fira text-sm text-white lg:flex lg:text-base xl:text-lg">
                        <?php if (isset($_GET['action'])): ?>
                            <li class="hover:text-brown-500">
                                <a href="index.php">Accueil</a>
                            </li>
                        <?php else:?>
                        <li class="text-brown-500">Accueil</li>
                        <?php endif;?>

                        <li>
                            <a href="contact.html" class="hover:text-brown-500">Contact</a>
                        </li>
                    </ol>
                </nav>

                <label for="menu-toggle" class="z-10 block cursor-pointer mr-20 lg:hidden">
                    <img src="img/burger.svg" alt="icone menu burger" class="w-10"/>
                </label>

            </div>

            <?php if(isset($_SESSION['LOGGED_USER'])):?>
                <div class="flex flex-col hidden lg:block text-sm font-fira mr-20 lg:text-base xl:text-lg"
                    <p class="hidden lg:block hover:text-brown-500 text-sm font-fira mr-20 lg:text-base xl:text-lg"><?= $_SESSION['LOGGED_USER'] ?></p>

                    <a class="hidden lg:block hover:text-brown-500 text-sm font-fira mr-20 lg:text-base xl:text-lg" href="index.php?action=logout">Déconnexion</a>
                 </div>
            <?php else: ?>
                <div>
                    <a href="index.php?action=login" class="hidden lg:block hover:text-brown-500 text-sm font-fira mr-20 lg:text-base xl:text-lg">Se connecter</a>

                    <a href="index.php?action=signup" class="hidden lg:block hover:text-brown-500 text-sm font-fira mr-20 lg:text-base xl:text-lg">S'inscrire</a>
                </div>
            <?php endif; ?>

            <input type="checkbox" class="hidden" id="menu-toggle"/>

            <div class="absolute top-14 right-0 hidden w-2/4 bg-black border-b-8 border-brown mr-20" id="menu">
                <nav>
                    <ol class="flex w-full list-none flex-col font-fira text-white gap-y-4 py-8 text-center text-xl">
                        <?php if (isset($_GET['action'])): ?>
                            <li class="hover:text-brown-500">
                                <a href="index.php">Accueil</a>
                            </li>
                        <?php else:?>
                            <li class="text-brown-500">Accueil</li>
                        <?php endif;?>

                        <li>
                            <a href="contact.html" class="hover:text-brown-500">Contact</a>
                        </li>
                    </ol>
                </nav>

                <hr>

                <?php if(isset($_SESSION['LOGGED_USER'])):?>
                    <div class="flex w-full flex-col items-center py-8 gap-y-4"
                        <p class="hover:text-brown-500 font-fira text-xl"><?= $_SESSION['LOGGED_USER'] ?></p>

                        <a class="hover:text-brown-500 font-fira text-xl" href="index.php?action=logout">Déconnexion</a>
                    </div>
                <?php else: ?>
                    <div class="flex w-full flex-col items-center py-8 gap-y-4">
                        <a href="index.php?action=login" class="hover:text-brown-500 font-fira text-xl">Se connecter</a>

                        <a href="index.php?action=signup" class="hover:text-brown-500 font-fira text-xl">S'inscrire</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main><?=$content?></main>

    <footer class="bg-black text-white main-text text-center">
        <div class="py-20 space-y-10">
            <ol class="flex space-x-10 justify-center">
                <li><a href="">
                        Accueil</a>
                </li>

                <li><a href="">
                        Blog</a>
                </li>

                <li><a href="">
                        Contact</a>
                </li>
            </ol>

            <p>Copyright © Blog 2022</p>
        </div>
    </footer>
</body>