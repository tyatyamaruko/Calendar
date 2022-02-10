<?php

class Calendar
{

    private $days;
    /**
     * @param string $date format is 'yyyy-mm'
     * @return mixed $days|false
     */
    public function __construct($date)
    {
        if (!preg_match('/\A[\d]{4}-[\d]{2}\z/', $date)) {
            throw new Exception("$date is invalid value. expected format is yyyy-mm.");
        }
        // get the days of month count
        if (!$dayCount = date('t', strtotime($date))) return false;
        // get frist of dayofweek at the month
        if (!$dayOfWeek = date('w', strtotime($date . "-01"))) return false;

        $weeks = [];
        $week = "";

        // fill with 0 from sunday to 1 dayofweek
        $week = explode(" ", trim(str_repeat('0 ', $dayOfWeek)));

        foreach (range(1, $dayCount) as $day) {
            $week[] = $day;

            // $day == satday or $day == $dayCOunt
            if ($day % 7 == 5 || $day == $dayCount) {
                $weeks[] = $week;
                $week = [];
            }
        }

        $this->days = $weeks;
    }

    public function getDays()
    {
        return $this->days;
    }
}
