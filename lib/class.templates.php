<?php
class templates {

    public function Load(&$File) {

        static $Path = __DIR__ . '/../templates/';

        $Handle = fopen($Path . $File, 'rb');
        if ($Handle !== false) {
            $Filesize = filesize($Path . $File);
            $File = fread($Handle, $Filesize);
        }
        fclose($Handle);

    }

}
