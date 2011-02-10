<?php

/*
 * @author Alain Horner <alain.horner@liip.ch>
 * @author Lea Haensenberger <lea.haensenberger@gmail.com>
 *
 * This file is part of the Liip/TeraWurflBundle
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\TeraWurflBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateDbCommand extends Command
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setDefinition(array(
                new InputArgument('source', InputArgument::OPTIONAL, 'The source, the wurflefile should be loaded from. Can be "remote", "remote_cvs", "local" ', 'local'),
            ))
            ->setName('wurfl:update')
            ->setDescription('Updates the terawurfl database');
     }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return integer 0 if everything went fine, or an error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $updateService = $this->container->get('liip_terawurfl.update');
        $updateService->updateFrom($input->getArgument('source'));
    }

}
