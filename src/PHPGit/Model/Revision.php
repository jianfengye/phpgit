<?php

namespace PHPGit\Model;

class Revision
{
    public $sha1;
    public $author;
    public $date;
    public $desc;

    const FORMAT = '%H,%an,%ci,%s';

    public function __construct($sha1, $author, $date, $desc)
    {
        $this->sha1 = $sha1;
        $this->author = $author;
        $this->date = \DateTime::createFromFormat(\DateTime::ISO8601, $date);
        $this->desc = $desc;
    }

    // get instance by lines
    public static function instanceByFormat($line)
    {
        list($sha1, $author, $date, $desc) = explode(',', $line);
        return new Revision($sha1, $author, $date, $desc);
    }
}
