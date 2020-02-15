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

class CategorisedCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:categorised';
    private $em;

    protected function configure()
    {
            $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Categorise img with title.')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command allows you to create a user...')
    ;
    }

    public function __construct(EntityManagerInterface $em){
           $this->em = $em;
           parent::__construct();
    }
    
    protected function getImages(){
        return $this->em->getRepository(\App\Entity\Images::class);
    }
    
    protected function getCategorys(){
        return $this->em->getRepository(\App\Entity\Categorys::class);
    }
    
    protected function getActivitys(){
        return $this->em->getRepository(\App\Entity\Activitys::class);
    }
    
    protected function findLike($name): array
    {
        $conn = $this->em->getConnection();

        $sql = '
            SELECT id FROM activitys p
            WHERE p.description LIKE :name
            OR p.title LIKE :title
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => '%'.$name.'%', 'title' => '%'.$name.'%']);

        // returns an array of arrays (i.e. a raw data set)
        $result = $stmt->fetchAll();
        return $result;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Categorisator',
            '============',
            '',
        ]);

        $catsImg = $this->getImages()->findAll();

        // relie l'image correspondant à l'activité
        foreach($catsImg as $key => $cat){
            
            $linkimgs = $this->findLike($cat->getImg());
            foreach($linkimgs as $linkimg){
//                dump((int)$linkimg["id"]);
                $activitysimg = $this->getActivitys()->find((int)$linkimg["id"]);
                $isimages = $activitysimg->getImages();
                $activitysimg->addImage($cat);
            }

        }
        
        
        $this->em->persist($cat);
        $this->em->flush();

        // retrieve the argument value using getArgument()
        $output->writeln('Images categorised: ');

        return 0;
    }
}
