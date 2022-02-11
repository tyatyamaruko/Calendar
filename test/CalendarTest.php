<?php

use PHPUnit\Framework\TestCase;
use src\Calendar\Calendar;

require "./src/Calendar/Calendar.php";

class CalendarTest extends TestCase {

    protected Calendar $calendar;

    protected function setUp(): void {
            $this->calendar = new Calendar("2022-01");
    }

    public function testInstanceOf() {
        $this->assertInstanceOf(Calendar::class, $this->calendar);
    }

    public function testGetDays() {
        $this->assertIsArray($this->calendar->getDays());
    }   

    public function testSetPreZero() {
        $reflection = new ReflectionClass($this->calendar);
        $method = $reflection->getMethod("setPreZero");
        $method->setAccessible(true);
        $result = $method->invoke($this->calendar, "01");

        $this->assertEquals("01", $result);
    }

    public function testGetDayOfWeek() 
    {
        $this->assertEquals(2, $this->calendar->getDayOfWeek("01", "ja"));
    }

}