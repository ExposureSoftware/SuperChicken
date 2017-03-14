<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-13
 * Time: 21:54
 *
 * Adds the CLI entry point for the SuperChicken.
 * This provides a menu driven interaction that demonstrates the features of the included code. This is meant
 * only for demonstration and fun.
 */

use ExposureSoftware\SuperChicken\Animals\Avians\Chicken;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

echo 'Welcome to your chicken farm!' . PHP_EOL;
do {
    $acres = readline('How many acres should your first claim be? [integer] ');
} while (!is_numeric($acres));

$farm = new \ExposureSoftware\SuperChicken\Farm($acres);
echo "Congratulations your {$farm->size()} acre farm has {$farm->population()} chickens." . PHP_EOL;
echo 'You will be able to plan each day, then be reported on what happens in the night.' . PHP_EOL;

$running = true;
while ($running) {
    echo 'Select an action:' . PHP_EOL;
    echo '1) Feed Chickens.' . PHP_EOL;
    echo '2) Play some jazz music for your Chickens.' . PHP_EOL;
    echo '3) Collect eggs.' . PHP_EOL;
    echo '4) Eat a Chicken.' . PHP_EOL;
    echo '5) Check on Chickens.' . PHP_EOL;
    echo '6) Rest for the day.' . PHP_EOL;
    echo PHP_EOL . '0) Exit' . PHP_EOL;
    $option = readline('Choice: ' . PHP_EOL);

    switch ($option) {
        case 0:
            $running = false;
            break;
        case 1:
            do {
                $pellets = readline('How many Chick-O-Pellets do you feed? [integer] ' );
            } while (!is_numeric($pellets));
            $farm->feed();
            break;
        case 2:
            echo 'The Chickens liked that! Some of them start dancing with each other.' . PHP_EOL;
            $farm->stimulated(true);
            break;
        case 3:
            echo "You collect {$farm->collectEggs()->count()} eggs and don't even get pecked!" . PHP_EOL;
            break;
        case 4:
            echo 'Delicious! The Chicken is moist, and tender. You\'ll miss that bird.' . PHP_EOL;
            $farm->cull(1);
            break;
        case 5:
            $chickens = $farm->chickens();
            $hens = $chickens->filter(function (Chicken $chicken) {
                return !$chicken->isRooster();
            });
            $roosters = $chickens->filter(function (Chicken $chicken) {
                return $chicken->isRooster();
            });
            echo "You currently have {$hens->count()} hens and {$roosters->count()} roosters." . PHP_EOL;
            break;
        case 6:
            $farm->night();
            echo 'You rest well, dreaming of plump birds. A new day dawns.' . PHP_EOL;
            break;
        default:
            echo 'Not a valid choice.' . PHP_EOL;
    }
}

echo 'Thanks for playing!';
exit;

