<?php

/* 
 * Djamal LAMRI 16/08/1984.
 */

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;

class CreateUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-user';
    private $em;

    protected function configure()
    {
            $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Creates a new user.')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command allows you to create a user...')
    ;
    }

    public function __construct(EntityManagerInterface $em){
           $this->em = $em;
           parent::__construct();
    }
    
    protected function getActivitys(){
        return $this->em->getRepository(\App\Entity\Activitys::class);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'img categorisator',
            '============',
            '',
        ]);
dump($this->getActivitys()->findAll());
        // retrieve the argument value using getArgument()
        $output->writeln('Images categorised: ');

        return 0;
    }
}
