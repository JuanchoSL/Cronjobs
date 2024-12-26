# Cronjobs

## Description

Little methods collection in order to declare some Command as Cronjobs and execute it when the programm time have a coincidence. This is an extension of the  [Terminal library](https://github.com/JuanchoSL/Terminal).

## Install

```bash
composer require juanchosl/cronjobs
```

## How to use

### Config

#### Commands

First, you need to create the desired Command to execute. Visit the Terminal library for show how create [Commands](https://github.com/JuanchoSL/Terminal).
The commands can be reused from your own terminal app.

#### Inputs

The commands receive the arguments from console, for this reason you need to create an Input entity for declare manually the values to send to the cronjob

```php
$input = new Input;
$input->addArgument('required_single', 'value');
$input->addArgument('required_void', null);
$input->addArgument('required_multi', ['a', 'b', 'c']);
```

#### Programming

In order to set the execution time, needs to create a standard time config using a ProgrammingInterface for declare when the Cronjobs need to be executed
You can use the cron standar syntax, the \* value is the default value when it is not setted:

```php
$programming = (new Programming)->setHour('*/2');
```

```php
$programming = (new Programming)->setHour('15,30,45,0');
```

```php
$programming = (new Programming)->setHour('6');
```

### Crontab

Create the script to call from your crontab console app every minute (or when you wont) and mount a Crontab app, adding your cronjobs

```php
include dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$logger = new Logger((new FileRepository(LOGS_DIR . DIRECTORY_SEPARATOR . 'cronjobs.log'))->setComposer(new TextComposer));

$app = new Crontab;
$app->setLogger($logger);
$app->setDebug(true);
$app->add(new FirstCommand, (new Input)->addArgument('argument', 'value'), (new Programming)->setHour('*/2')); //Execute every hours multiple of 2
$app->add(new SecondCommand, (new Input)->addArgument('argument', 'value'), (new Programming)->setDayOfWeek(0)); //Execute the first day of week, 0 is Sunday
$app->add(new ThirdCommand, (new Input)->addArgument('argument', 'value'), (new Programming)->setDayOfMonth(1)); //Execute the first day of month
$app->run();
```
