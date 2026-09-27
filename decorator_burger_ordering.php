<?php

declare(strict_types=1);

namespace App\FoodOrdering;

interface Meal
{
    public function getDescription(): string;

    public function getPrice(): float;
}

final class BasicBurger implements Meal
{
    public function getDescription(): string
    {
        return 'Basic Burger';
    }

    public function getPrice(): float
    {
        return 100.00;
    }
}

abstract class MealDecorator implements Meal
{
    public function __construct(protected readonly Meal $meal)
    {
    }
}

final class CheeseDecorator extends MealDecorator
{
    public function getDescription(): string
    {
        return $this->meal->getDescription() . ', Cheese';
    }

    public function getPrice(): float
    {
        return $this->meal->getPrice() + 20.00;
    }
}

final class BaconDecorator extends MealDecorator
{
    public function getDescription(): string
    {
        return $this->meal->getDescription() . ', Bacon';
    }

    public function getPrice(): float
    {
        return $this->meal->getPrice() + 30.00;
    }
}

final class SauceDecorator extends MealDecorator
{
    public function getDescription(): string
    {
        return $this->meal->getDescription() . ', Sauce';
    }

    public function getPrice(): float
    {
        return $this->meal->getPrice() + 10.00;
    }
}

// Client code
$meal = new BasicBurger();

$meal = new CheeseDecorator($meal);

$meal = new BaconDecorator($meal);

$meal = new SauceDecorator($meal);

echo $meal->getDescription() . ': PHP '
    . number_format($meal->getPrice(), 2);