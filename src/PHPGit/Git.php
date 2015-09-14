<?php

namespace PHPGit;

use \PHPGit\Model\Revision;
use \PHPGit\Model\Diff;

class Git
{

    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    // get all revisions
    public function revisions()
    {
        $commands = "git log --pretty=format:". Revision::FORMAT ." --date-order";
        $lines = $this->execute($command);
        $revisions = [];
        foreach ($lines as $line) {
            $revisions[] = Revision::instanceByFormat($line);
        }

        return $revisions;
    }

    // get last version
    public function lastRevision()
    {
        $command = "git log --pretty=format:". Revision::FORMAT ." --date-order -1";
        $lines = $this->execute($command);

        if (count($lines) != 1) {
            throw new \LogicException('No Log here');
        }

        return Revision::instanceByFormat(current($lines));
    }

    // diff sha
    public function diff($sha1, $sha2)
    {
        $command = "git diff {$sha1} {$sha2} --no-ext-diff";
        $lines = $this->execute($command);

        $diffs = [];
        $tmps = [];
        foreach ($lines as $key => $line) {
            $tmps[] = $line;

            if (($key == count($lines) - 1) || (substr($lines[$key+1], 0, 10) == 'diff --git')){
                if (empty($tmps)) {
                    continue;
                }
                $diffs[] = Diff::instanceByLines($tmps);
                $tmps = [];
            }

        }
        return $diffs;
    }

    public function pull()
    {
        $command = "git pull";
        $lines = $this->execute($command);
    }

    public function checkout($branch)
    {
        $command = "git checkout {$branch}";
        $this->execute($command);
    }


    private function execute($command)
    {
        $cwd = getcwd();
        chdir($this->repository);
        exec($command, $output, $returnValue);
        chdir($cwd);

        if ($returnValue !== 0) {
            throw new \RuntimeException("execute command {$command} error:" . implode("\r\n", $output));
        }

        return $output;
    }
}
