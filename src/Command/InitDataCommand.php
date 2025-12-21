<?php

namespace App\Command;

use App\Config\DataInitializer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:init-data',
    description: 'Initialize database with sample data (2 users, 2 properties, 2 transactions, 2 visits)',
)]
class InitDataCommand extends Command
{
    public function __construct(private DataInitializer $dataInitializer)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $io->info('Initializing database with sample data...');
            
            $this->dataInitializer->initialize();
            
            $io->success('Data initialized successfully!');
            $io->writeln('');
            $io->writeln('Created:');
            $io->writeln('  - 2 Users (jean.dupont@example.com, marie.martin@example.com)');
            $io->writeln('  - 2 Properties (Maison à Paris, Appartement à Lyon)');
            $io->writeln('  - 2 Transactions');
            $io->writeln('  - 2 Visits');
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error('Failed to initialize data: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
