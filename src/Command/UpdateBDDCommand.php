<?php

/* 
 * Djamal LAMRI 16/08/1984.
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputArgument;

class UpdateBDDCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:updateBDD';
    private $em;

    protected function configure()
    {
         $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Categorise img with title.');
        
        $this
        // configure an argument
        ->addArgument('name', InputArgument::REQUIRED, 'The username of the user.')
        ;

    }

    public function __construct(EntityManagerInterface $em){
           $this->em = $em;
           parent::__construct();
    }
    
    
    protected function setUpdateBDD($input)
    {
        $conn = $this->em->getConnection();

        $sql = "UPDATE activitys t, villes o SET t.latitude = o.ville_latitude_deg, t.longitude = o.ville_longitude_deg WHERE t.ville = o.ville_nom_reel and t.latitude = ''";
        
//        and description LIKE '%bibliothèque%'";

        $conn->query($sql);

    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'updateBDD',
            '============',
            '',
        ]);
//        dd($input->getArgument('username'));
        // insert word for LIKE %% sql after update with concat
        $this->setUpdateBDD($input->getArgument('name'));


        $output->writeln('Executed: ');

        return 0;
    }
}
