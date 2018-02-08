<?php
namespace AppBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CronCommand extends ContainerAwareCommand
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->em = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('d1soccer:cron:run')
            ->setDescription('Executes a task that is configured to run on a schedule')
            ->addArgument('taskName', InputArgument::REQUIRED, 'The name of the task to execute')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $taskName = $input->getArgument('taskName');
        $response = "No Response";

        if(!is_null($taskName)) {
            switch(strtolower($taskName)) {
                case "purgeexpiredcache":
                    $response = $this->purgeExpiredCache();
                    break;
                default:
                    break;
            }
        }
        $output->writeln($response);
    }

    private function purgeExpiredCache() {
        $this->em->getRepository('AppBundle:CachedUserEntity')->deleteAllOlderThanMinutes(15);
        return "done";
    }
}
