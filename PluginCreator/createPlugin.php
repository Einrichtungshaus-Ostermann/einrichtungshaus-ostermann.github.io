<?php

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

require_once 'vendor/autoload.php';

$input = new ArgvInput();
$output = new ConsoleOutput();
$symfonyStyle = new SymfonyStyle($input, $output);

// Dynamic Categories
$fullPluginName = $symfonyStyle->ask('Plugin Name');

$technicalName = 'ost-' . str_replace([' '], ['-'], strtolower($fullPluginName));
$technicalName = $symfonyStyle->ask('Techical Plugin Name', $technicalName);

$containerName = str_replace('-', '_', $technicalName);
$composerName = str_replace('ost-', 'ost/', $technicalName);

$namespaceName = 'Ost' . str_replace(' ', '', ucwords($fullPluginName));
$namespaceName = $symfonyStyle->ask('Namespace name', $namespaceName);

$authorName = $symfonyStyle->ask('Author Name');
$authorMail = $symfonyStyle->ask('Author Email');

$author = $authorName . ' <' . $authorMail . '>';

$description = $symfonyStyle->ask('Description');

$fields = [
    'FULL_PLUGIN_NAME' => $fullPluginName,
    'TECHNICAL_NAME' => $technicalName,
    'COMPOSER_NAME' => $composerName,
    'CONTAINER_NAME' => $containerName,
    'NAMESPACE_NAME' => $namespaceName,
    'AUTHOR' => $author,
    'PLUGIN_DESCRIPTION' => $description,
    'YEAR' => (new DateTime())->format('Y')
];


recurse_copy('template', $namespaceName);


function replaceTemplate(string $template): string
{
    global $fields;

    return str_replace(array_keys($fields), array_values($fields), $template);
}



function recurse_copy($src, $dst)
{
    $dir = opendir($src);

    if (!mkdir($dst) && !is_dir($dst)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $dst));
    }

    while (false !== ($file = readdir($dir))) {
        if (($file !== '.') && ($file !== '..')) {
            if (is_dir($src . '/' . $file)) {
                recurse_copy($src . '/' . $file, $dst . '/' . $file);
            } else {
                $newFile = replaceTemplate($file);

                file_put_contents($dst . '/' . $newFile, replaceTemplate(file_get_contents($src . '/' . $file)));
            }
        }
    }

    closedir($dir);
}
