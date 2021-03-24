<?php

namespace CocoJr\CleanArchitectureSfMakerBundle\Maker;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Filesystem\Filesystem;

class MakeMessengerCommand extends AbstractMaker
{
    const AVAILABLE_TYPES = ['UseCase', 'Query', 'Command', 'Event'];

    public static function getCommandName(): string
    {
        return 'make2:messenger:template';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig)
    {
        $command
            ->setDescription('Create a new messsenger command')
            ->addArgument('domain', InputArgument::REQUIRED, 'Domain (e.g. <fg=yellow>User</>)')
            ->addArgument('name', InputArgument::REQUIRED, 'Name (e.g. <fg=yellow>Login</>)')
            ->addArgument('type', InputArgument::REQUIRED, 'Type of the command (<fg=yellow>UseCase</>, <fg=yellow>Query</>, <fg=yellow>Command</> OR <fg=yellow>Event</>)')
        ;
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {
        if (!in_array($type = $input->getArgument('type'), self::AVAILABLE_TYPES)) {
            $error = '   ERROR: Invalid type "'.$type.'"   ';
            $pad = str_pad('', strlen($error), ' ');
            $io->newLine();
            $io->writeln(' <bg=red;fg=white>'.$pad.'</>');
            $io->writeln(' <bg=red;fg=white>'.$error.'</>');
            $io->writeln(' <bg=red;fg=white>'.$pad.'</>');
            $io->newLine();

            exit;
        }

        $generated = [
            $this->generateBusinessClass('Message', $input, $generator),
            $this->generateBusinessClass('Handler', $input, $generator),
            $this->generateBusinessClass('Handler', $input, $generator, true),
            $this->generateBusinessClass('Request', $input, $generator),
        ];
        if ($type !== 'Event') {
            $generated[] = $this->generateBusinessClass('Response', $input, $generator);
        }

        $io->writeln('The following files are going to be generated:');
        foreach ($generated as $value) {
            $io->writeln(' - '.$value);
        }

        if (strtolower($io->ask('Do you want to continue?', 'Y')) !== 'y') {
            exit;
        }

        $generator->writeChanges();
        $this->writeService($input);

        $this->writeSuccessMessage($io);
    }

    private function generateBusinessClass(string $type, InputInterface $input, Generator $generator, bool $test = false): string
    {
        $functionnalityName = $input->getArgument('name');
        $domain = $input->getArgument('domain');
        $messageType = $input->getArgument('type');
        $template = __DIR__.'/Resources/skeleton/business/'.strtolower($type);
        if (strtolower($type) === 'handler') {
            $template .= '_'.strtolower($messageType);
        }

        $className = $functionnalityName.$type;
        $classNamespace = $domain.'\\'.$messageType.'\\'.$type;
        if ($test) {
            $className .= 'Test';
            $classNamespace = 'Test\\'.$classNamespace;
            $template .= '.test';
        }
        $template .= '.tpl.php';
        $classNameDetails = $generator->createClassNameDetails($className, $classNamespace);
        $className = str_replace('App\\', 'Business\\', $classNameDetails->getFullName());

        return $this->generateClass($generator, $className, $template, $type, $messageType, $domain, $functionnalityName);
    }

    private function generateClass(Generator $generator, string $className, string $template, string $type, string $messageType, string $domain, string $functionnalityName): string
    {
        return $generator->generateClass(
            $className,
            $template,
            [
                'type' => $type, // Message, Handler, Request, Response
                'messageType' => $messageType, // Query, Command, Event
                'domain' => $domain,
                'functionnalityName' => $functionnalityName,
            ]
        );
    }

    private function writeService(InputInterface $input)
    {
        $serviceFile = __DIR__.'/../../../config/services.yaml';
        $serviceFileContent = file_get_contents($serviceFile);
        $serviceNamespaceDeclaration = 'Business\\'.$input->getArgument('domain').'\\'.$input->getArgument('type').'\\Handler';
        $filesystem = new Filesystem();
        if (strpos($serviceFileContent, $serviceNamespaceDeclaration) === false) {
            $filesystem->appendToFile($serviceFile, "\n\n    ## ".$input->getArgument('domain').$input->getArgument('type')." ##");
            $filesystem->appendToFile($serviceFile, "\n    ".$serviceNamespaceDeclaration."\\:");
            $filesystem->appendToFile($serviceFile, "\n        resource: '../src/Business/".$input->getArgument('domain')."/".$input->getArgument('type')."/Handler/*'");
            $filesystem->appendToFile($serviceFile, "\n        tags: [{ name: messenger.message_handler, bus: ".strtolower($input->getArgument('type')).".bus }]");
            $filesystem->appendToFile($serviceFile, "\n        autoconfigure: false");
            $filesystem->appendToFile($serviceFile, "\n    ## /".$input->getArgument('domain').$input->getArgument('type')." ##");
        }
    }
}
