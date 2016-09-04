<?php
class filefunctions {

    public function viewfile ($arg1) {

        /* For handling template files. */
        $templates = new templates;

        if ($dh = opendir($arg1)) {
            while ($file = readdir($dh)) {
                $slash = '/';
                if (is_dir($arg1 . $slash . $file)) {
                    /* View directory. */
                    $dir_icon = 'dir_icon.html';
                    $templates->Load($dir_icon);
                    printf($dir_icon, $arg1, $file);
                    unset($dir_icon);
                } else {
                    /* View file. */
                    $fileicon = 'fileicon.html';
                    $templates->Load($fileicon);
                    printf($fileicon, $arg1, $file);
                    unset($fileicon);
                }
            }
        }

    }

}
