<?php

// vendor autoload
require_once __DIR__ . '/vendor/autoload.php';

use Talal\LabelPrinter\Printer;
use Talal\LabelPrinter\Mode\Escp;
use Talal\LabelPrinter\Command;

$stream = stream_socket_client('tcp://192.168.0.142:9100', $errorNumber, $errorString);

$printer = new Printer(new Escp($stream));
$font = new Command\Font('brussels', Command\Font::TYPE_OUTLINE);

$printer->addCommand(new Command\CharStyle(Command\CharStyle::NORMAL));
$printer->addCommand($font);
$printer->addCommand(new Command\CharSize(46, $font));
$printer->addCommand(new Command\Align(Command\Align::CENTER));
$printer->addCommand(new Command\Text('Hallo'));
$printer->addCommand(new Command\Cut(Command\Cut::FULL));
$printer->printLabel();

fclose($stream);