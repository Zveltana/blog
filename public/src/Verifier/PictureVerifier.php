<?php

namespace Application\Verifier;

class PictureVerifier
{
    public const NOT_VALID = 0;
    public const VALID = 1;
    public const NOTHING = 2;

    public function verify(bool $required = true): int
    {
        $picture = $_FILES['picture'];

        if($required && !file_exists($picture['tmp_name']))
        {
            return self::NOTHING;
        }

        if(!$required && !file_exists($picture['tmp_name']))
        {
            return self::VALID;
        }

        if(file_exists($picture['tmp_name']) && $picture['error'] === 0 && $picture['size'] <= 1000000)
        {
            $mtype = mime_content_type($picture['tmp_name']);

            if(str_starts_with($mtype, 'image/'))
            {
                return self::VALID;
            }
        }

        return self::NOT_VALID;
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