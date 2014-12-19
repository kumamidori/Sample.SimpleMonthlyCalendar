<?php

namespace Sample\SimpleMonthlyCalendar;

class SimpleMonthlyCalendarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testChangeMonthBeginningOfDay()
    {
        $fixture = new \DateTime('2014-12-10 00:00:00');
        $calendar = new SimpleMonthlyCalendar($fixture);

        $this->assertEquals(new \DateTime('2014-12-01 00:00:00'), $calendar->changeByDay($fixture, 1));
    }

    /**
     * @test
     */
    public function testChangeMonthEndOfDay()
    {
        $fixture = new \DateTime('2014-11-10 00:00:00');
        $calendar = new SimpleMonthlyCalendar($fixture);

        $this->assertEquals(new \DateTime('2014-11-30 00:00:00'), $calendar->changeByDay($fixture, 30));
    }

    /**
     * @test
     */
    public function testChangeMonthOverDayThrowsException()
    {
        try {
            $fixture = new \DateTime('2014-11-10 00:00:00');
            $calendar = new SimpleMonthlyCalendar($fixture);

            $calendar->changeByDay($fixture, 31);
            $this->fail('期待通りの例外が発生しませんでした。');
        } catch (\UnexpectedValueException $e) {
        }
    }

    /**
     * @test
     */
    public function testChangeMonthInvalidDayThrowsException()
    {
        try {
            $fixture = new \DateTime('2014-11-10 00:00:00');
            $calendar = new SimpleMonthlyCalendar($fixture);

            $calendar->changeByDay($fixture, 32);
            $this->fail('期待通りの例外が発生しませんでした。');
        } catch (\UnexpectedValueException $e) {
        }
    }

    /**
     * @test
     */
    public function testChangeMonthMonthInvalidDayThrowsException()
    {
        try {
            $fixture = new \DateTime('2014-11-10 00:00:00');
            $calendar = new SimpleMonthlyCalendar($fixture);

            $calendar->changeByDay($fixture, 31);
            $this->fail('期待通りの例外が発生しませんでした。');
        } catch (\UnexpectedValueException $e) {
        }
    }

    /**
     * @test
     * @dataProvider monthsAgo1Data
     */
    public function testMonthAgoCaseOneMonthSuccess($from, $month, $to)
    {
        $fixture = new \DateTime($from);
        $calendar = new SimpleMonthlyCalendar($fixture);
        $this->assertEquals(new \DateTime($to), $calendar->monthsAgo($month));
    }

    /**
     * @test
     * @dataProvider monthsAgo2Data
     */
    public function testMonthAgoCaseTwoMonthSuccess($from, $month, $to)
    {
        $fixture = new \DateTime($from);
        $calendar = new SimpleMonthlyCalendar($fixture);
        $this->assertEquals(new \DateTime($to), $calendar->monthsAgo($month));
    }

    /**
     * @test
     * @dataProvider monthsSince1Data
     */
    public function testMonthsSinceCaseOneMonthSuccess($from, $month, $to)
    {
        $fixture = new \DateTime($from);
        $calendar = new SimpleMonthlyCalendar($fixture);
        $this->assertEquals(new \DateTime($to), $calendar->monthsSince($month));
    }

    /**
     * @test
     * @dataProvider monthsSince2Data
     */
    public function testMonthsSinceCaseTwoMonthSuccess($from, $month, $to)
    {
        $fixture = new \DateTime($from);
        $calendar = new SimpleMonthlyCalendar($fixture);
        $this->assertEquals(new \DateTime($to), $calendar->monthsSince($month));
    }

    public function monthsAgo1Data()
    {
        return array(
            '月初12月' => array('2014-12-01', 1, '2014-11-01'),
            '月初11月' => array('2014-11-01', 1, '2014-10-01'),
            '30日までの月の月末' => array('2014-11-30', 1, '2014-10-30'),
            '年またぎ' => array('2015-01-31', 1, '2014-12-31'),
            'うるう年' => array('2016-03-29', 1, '2016-02-29'),
            '10月から30日までの月末に補正' => array('2016-10-31', 1, '2016-09-30'),
            '12月から30日までの月に補正' => array('2014-12-31', 1, '2014-11-30'),
        );
    }

    public function monthsAgo2Data()
    {
        return array(
            '月初12月' => array('2014-12-01', 2, '2014-10-01'),
            '月初11月' => array('2014-11-01', 2, '2014-09-01'),
            '30日までの月の月末' => array('2014-11-30', 2, '2014-09-30'),
            '年またぎ' => array('2015-01-31', 2, '2014-11-30'),
            'うるう年' => array('2016-03-29', 2, '2016-01-29'),
            '30日までの月末に補正' => array('2016-01-31', 2, '2015-11-30'),
            '1月から30日までの月に補正' => array('2015-01-31', 2, '2014-11-30'),
        );
    }

    public function monthsSince1Data()
    {
        return array(
            '月初1月' => array('2015-01-01', 1, '2015-02-01'),
            '月初2月' => array('2014-02-01', 1, '2014-03-01'),
            '30日までの月の月末' => array('2015-11-30', 1, '2015-12-30'),
            '年またぎ' => array('2014-12-31', 1, '2015-01-31'),
            'うるう年から' => array('2016-02-29', 1, '2016-03-29'),
            '28日までの月末に補正' => array('2017-01-31', 1, '2017-02-28'),
            'うるう年へ' => array('2016-01-31', 1, '2016-02-29'),
        );
    }

    public function monthsSince2Data()
    {
        return array(
            '月初1月' => array('2015-01-01', 2, '2015-03-01'),
            '月初2月' => array('2014-02-01', 2, '2014-04-01'),
            '年またぎで28日までの月の月末へ' => array('2014-12-31', 2, '2015-02-28'),
            'うるう年から' => array('2016-02-29', 2, '2016-04-29'),
            '28日までの月末へ' => array('2016-12-31', 2, '2017-02-28'),
            'うるう年へ' => array('2015-12-31', 2, '2016-02-29'),
        );
    }
}
