## Introduction
Calendar is sample library for PHP. This library helps your project, for example schedule manager, show casual calendar.

## Release Note
#### version 1.0.0 2022/02/14

## Install

Just type the following command on the command line.

```bash
composer require tyatyamaruko/calendar
```

## Usage

Import
```php
<?php
use Calendar\Calendar;
?>
```

Create Instance

```php
<?php
// available format is only yyyy-mm
$calendar = new Calendar("2022-02");
?>
```

Get the number of days in the month specified when the instance is created. Up to the beginning of the day of the week can be filled with zeroes.

```php
<?php
$days = $calendar->getDays();
?>
```

Displays the calendar view.

By default, "ja" is passed as the argument.
You can also specify "en". If specified, the day of the week will be in the specified language.

```php
<?php
$calendar->showCalendar();
?>
```

For February 2022, it will be displayed as follows. (No style will be assigned)

|日|月|火|水|木|金|土|
|-|-|-|-|-|-|-|
|||1|2|3|4|5|
|6|7|8|9|10|11|12|
|13|14|15|16|17|18|19|
|20|21|22|23|24|25|26|
|27|28||||||

If you want more customization, you can use the getDays() function to implement your own layout.
