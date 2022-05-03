<?php

namespace Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Psy\Shell;

class ThinkCommand extends Command {
    
    protected static $defaultName = 'think';

    protected function configure()  {
        $this
            ->setDescription('Interact with your application')
            ->setHelp('Interact with your application');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
	{
        $output->writeln('<info>🐝 Bee interactive shell activated</info>');

        if (file_exists('vendor/autoload.php')) require 'vendor/autoload.php';
        if (file_exists('app/bootstrap.php')) require 'app/bootstrap.php';

        $shell = new Shell();

		return $output->write($shell->run()) ? 0 : 1;
    }
}
