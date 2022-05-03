<?php

namespace Benjamintemitope\PhpCli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class ServeCommand extends Command
{
    protected static $defaultName = 'serve';

    public function configure(){
    	$this
            ->setDescription('Start the built-in PHP web server')
            ->setHelp('Start the built-in PHP web server')
            ->addOption('port', 'p', InputOption::VALUE_OPTIONAL, 'Port to run app on');
    }

    public function execute(InputInterface $input, OutputInterface $output): int{
    	$port = $input->getOption('port') ? (int) $input->getOption('port') : 8000;

    	$process = Process::fromShellCommandline("php -S 127.0.0.1:$port", null, null, null, null);

        if (file_exists('public/index.php')) {
            $process = Process::fromShellCommandline("php -S 127.0.0.1:$port -t public/", null, null, null, null);
        }

        return $process->run(function ($type, $line) use ($output, $port) {
            if (is_string($line) && !strpos($line, 'Failed')) {
                $output->write($line);
            } else {
                $output->write("<error>$line</error>");
            }
        });
    }
}
