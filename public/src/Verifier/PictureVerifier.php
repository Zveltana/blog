<?php

namespace Application\Verifier;

class PictureVerifier
{
    public function verify(bool $required = true): bool
    {
        $picture = $_FILES['picture'];

        if($required && file_exists($picture['name']))
        {
            var_dump('weth');
            return false;
        }

        if($required && !file_exists($picture['name']))
        {
            var_dump('salut');
            return false;
        }

        if(!$required && file_exists($picture['name']))
        {
            var_dump('couocu');
            return true;
        }

        if($required && file_exists($picture['name']))
        {
            var_dump('yo');
            $tmpname = $picture['tmp_name'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mtype = finfo_file($finfo, $tmpname);

            if(str_starts_with($mtype, 'image/'))
            {
                return true;
            }

            return false;
        }

        return false;



        /*$picture = $_FILES['picture'];
        $message = [];

        $fileInfo = pathinfo($picture['name']);
        $extension = $fileInfo['extension'];

        $move = sprintf("img/blog/%s.%s", md5(basename($picture['name'])), $extension);

        if (isset($picture) && $picture['error'] === 0 && $picture['size'] <= 1000000) {
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'svg'];
            if (in_array($extension, $allowedExtensions, true)) {
                move_uploaded_file($picture['tmp_name'], $move);
            } else {
                return $message;
            }
        }

        return $move;*/
    }

    public function upload(): string
    {
        $picture = $_FILES['picture'];

        $fileInfo = pathinfo($picture['name']);
        $extension = $fileInfo['extension'];

        $move = sprintf("img/blog/%s.%s", md5(basename($picture['name'])), $extension);

        move_uploaded_file($picture['tmp_name'], $move);

        return $move;
    }
}