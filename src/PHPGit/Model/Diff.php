<?php

namespace PHPGit\Model;

class Diff
{
    public $file;
    public $lines;

    public static function instanceByLines($lines)
    {
        if (empty($lines)) {
            return null;
        }
        $diff = new Diff();

        list($tmp1, $tmp2, $afile, $bfile) = explode(' ', current($lines));
        $diff->file = substr($afile, 2);
        $diff->lines = $lines;
        return $diff;
    }
}
