<?php

namespace Application\Verifier;

class PictureVerifier
{
    public function verify(): array|string
    {
        $picture = $_FILES['picture'];
        $message = [];

        $fileInfo = pathinfo($picture['name']);
        $extension = $fileInfo['extension'];

        $move = sprintf("img/blog/%s.%s", md5(basename($picture['name'])), $extension);

        if (isset($picture) && $picture['error'] === 0 && $picture['size'] <= 1000000) {
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'svg'];
            if (in_array($extension, $allowedExtensions, true)) {
                move_uploaded_file($_FILES['picture']['tmp_name'], $move);
            } else {
                return $message;
            }
        }

        return $move;
    }
}