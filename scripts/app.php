<?php

use Sample\SimpleMonthlyCalendar\SimpleMonthlyCalendar;

require __DIR__ . '/../vendor/autoload.php';

$calendar = new SimpleMonthlyCalendar(new \DateTime('2016-12-31'));
var_dump($calendar->monthsSince(2)->format('Y/m/d'));
// string(10) "2017/02/28"
