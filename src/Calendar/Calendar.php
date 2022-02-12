<?php

namespace Calendar;

class Calendar
{
    private string $yearMonth;
    private array $days;
    private array $dayOfWeeks = [
        "ja" => ["日", "月", "火", "水", "木", "金", "土"],
        "en" => ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    ];
    /**
     * @param string $date format is 'yyyy-mm'
     * @return mixed $days|false
     */
    public function __construct($date)
    {
        if (!preg_match('/\A[\d]{4}-[\d]{2}\z/', $date)) {
            throw new \Exception("$date is invalid value. expected format is yyyy-mm.");
        }
        $this->yearMonth = $date;

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

    /**
     * return instance property days
     * @return array $days
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * get Sunday date
     * @param string|int $value
     * @param string lang : ja or en
     * @return string 
     */
    public function getDayOfWeek($value, string $lang = "ja"): string
    {
        $dayOfWeek = date('w', strtotime($this->yearMonth . "-" . self::setPreZero($value)));
        switch ($lang) {
            case 'ja':
                return $this->dayOfWeeks[$lang][$dayOfWeek];
            case 'en':
                return $this->dayOfWeeks[$lang][$dayOfWeek];
            default:
                throw new \Exception("not defined lang. please read reference.");
        }
    }

    /**
     * if length < 2 return string with 0 
     * @param string $value
     * @param string $value
     */
    private function setPreZero(string $value): string
    {
        if (strlen($value) < 2) {
            return "0" . $value;
        }
        return $value;
    }

    /**
     * show calendar view
     * @param string $lang ja or en
     */
    public function showCalendar(string $lang = "ja") {
        $view = "<table>";
        $view .= "<tr>";
        foreach(range(0, 6) as $i) {
            $view .= "<th class='cal-header'>" . $this->dayOfWeeks[$lang][$i] . "</th>";
        }
        $view .= "</tr>";
        foreach($this->days as $weeks) {
            $view .= "<tr>";
            foreach($weeks as $day) {
                $view .= $day != 0 ? "<td>$day</td>" : "<td></td>";
            }
            $view .= "</tr>";
        }
        $view .= "</table>";

        echo $view;
    }
}
