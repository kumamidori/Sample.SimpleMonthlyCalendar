<?php
/**
 * Sample.SimpleMonthlyCalendar
 *
 */
namespace Sample\SimpleMonthlyCalendar;

class SimpleMonthlyCalendar
{
    /**
     * 現在時刻
     *
     * @var \DateTime
     */
    private $now;

    /**
     * @param \DateTime $now 現在時刻
     */
    public function __construct(\DateTime $now)
    {
        $this->now = $now;
    }

    /**
     * 月内の日で時刻を変更する
     *
     * @param \DateTime
     * @param integer
     * @return \DateTime
     * @throws \UnexpectedValueException
     */
    public function changeByDay(\DateTime $base, $day)
    {
        $this->guardInvalidDay($day);

        $target = clone $base;
        if ($day > $target->modify('last day of')->format('d')) {
            throw new \UnexpectedValueException('day > last of day.');
        }

        return new \DateTime($target->format('Y/m') .'/' . $day);
    }

    /**
     * ○月前の日付を取得する
     *
     * @param integer
     * @return \DateTime
     * @throws \UnexpectedValueException
     */
    public function monthsAgo($months)
    {
        $this->guardInvalidMonths($months);

        $result = clone $this->now;
        for ($m = 1; $m <= $months; $m++) {
            $result = $this->changeByDay($result, 1);
            $result->sub(new \DateInterval('P1D'));
        }

        return $this->changeByDay($result,
            (int) ($this->now->format('d') > $result->format('d') ? $result->format('d') : $this->now->format('d')));
    }

    /**
     * ○月後の日付を取得する
     *
     * @param integer
     * @return \DateTime
     * @throws \UnexpectedValueException
     */
    public function monthsSince($months)
    {
        $this->guardInvalidMonths($months);

        $result = clone $this->now;
        $before = clone $result;
        for ($m = 1; $m <= $months; $m++) {
            $before = clone $result;
            $result = $this->changeByDay($result, (int) $before->modify('last day of')->format('d'));
            $result->add(new \DateInterval('P1D'));
        }

        return $this->changeByDay($result,
            (int) ($this->now->format('d') > $result->modify('last day of')->format('d') ?
                $result->modify('last day of')->format('d') : $this->now->format('d')));
    }

    /**
     * @param $day
     * @throws \UnexpectedValueException
     */
    protected function guardInvalidDay($day)
    {
        if (!is_int($day)) {
            throw new \UnexpectedValueException('day should be integer.' . $day);
        }
        if (!(1 <= $day && $day <= 31)) {
            throw new \UnexpectedValueException('day range should be 1 <= 31');
        }
    }

    /**
     * @param $months
     * @throws \UnexpectedValueException
     */
    protected function guardInvalidMonths($months)
    {
        if (!is_int($months)) {
            throw new \UnexpectedValueException('months should be integer. ' . $months);
        }
        if ($months < 1) {
            throw new \UnexpectedValueException('months should be equals or greater than 1. ' . $months);
        }
    }
}
