<?php

namespace Application\Verifier;

class PictureVerifier
{
    public function verify(bool $required = true): bool|array
    {
        $message = [];
        $picture = $_FILES['picture'];

        if($required && !file_exists($picture['tmp_name']))
        {
            return false;
        }

        if(!$required && !file_exists($picture['tmp_name']))
        {
            return true;
        }

        if(file_exists($picture['tmp_name']) && $picture['error'] === 0 && $picture['size'] <= 1000000)
        {
            $mtype = mime_content_type($picture['tmp_name']);

            if(str_starts_with($mtype, 'image/'))
            {
                return true;
            }
        }

        return $message;



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