<?php

namespace \PHPGit;

class Git
{

    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function revisions()
    {

    }

    private function execute($command)
    {
        $cwd = getcwd();
        chdir($this->$repository);
        exec($command, $output, $returnValue);
        chdir($cwd);

        if ($returnValue !== 0) {
            throw new \RuntimeException(implode("\r\n", $output));
        }

        return $output;
    }
}
