<?php
include './bootstrap.php';

use PropertyFinder\BoardingCard;
use PropertyFinder\Port;
use PropertyFinder\Train;
use PropertyFinder\Plane;
use PropertyFinder\Bus;

// Just a demonstration...
$boardingCards = [];

$mapData = [
    [
        'Madrid', // departure
        '', // gate
        '', // info
        (new DateTime)->modify('+1 hour'),
        'Barcelona', // arrival
        '', // gate
        '', // info
        (new DateTime)->modify('+2 hour'),
        new Train('78A'),
        '45B' // seat
    ],
    [
        'Barcelona', // departure
        '', // gate
        '', // info
        (new DateTime)->modify('+3 hour'),
        'Gerona Airport', // arrival
        '', // gate
        '', // info
        (new DateTime)->modify('+4 hour'),
        new Bus(''),
        '' // seat
    ],
    [
        'Gerona Airport',
        '45B',
        'Bagage drop at ticket counter 344',
        (new DateTime)->modify('+5 hour'),
        'Stockholm',
        '',
        '',
        (new DateTime)->modify('+6 hour'),
        new Plane('SK455'),
        '3A'
    ],
    [
        'Stockholm',
        '22',
        'Baggage will we automatically transferred from your last leg',
        (new DateTime)->modify('+7 hour'),
        'New York',
        '',
        '',
        (new DateTime)->modify('+8 hour'),
        new Plane('SK22'),
        '7B'
    ],
];

// Make an array of boarding cards
foreach ($mapData as $data) {
    $d = new Port($data[0], $data[1], $data[2]);
    $a = new Port($data[4], $data[5], $data[6]);
    $v =& $data[8];

    $b = new BoardingCard($v, $d, $a);
    $b->setTimeDeparture($data[3]);
    $b->setTimeArrival($data[7]);
    $b->setSeat($data[9]);

    $boardingCards[] = $b;
}

shuffle($boardingCards);
shuffle($boardingCards);
shuffle($boardingCards);
shuffle($boardingCards);

$boardingCardApi = new PropertyFinder\Api;

echo "*** Unsorted Itinerary ***\n";
echo $boardingCardApi->getItinerary($boardingCards) . "\n\n";

echo "*** Sorted Itinerary ***\n";
echo $boardingCardApi->getSortedBoardingCardsItinerary($boardingCards) . "\n";
