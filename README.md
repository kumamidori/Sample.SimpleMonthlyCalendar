[WIP] Month Calculations Sample Code
=======

Calculate Monthly Dates - Same day prev/next month in PHP.

Requirements
------------
 * PHP 5.3+

## Calculating Monthly Dates

ago
```
2016-12-28   <-- 2 months ago   ---   2017-02-28
```

since
```
2016-12-31   --- 2 months since -->   2017-02-28
```

## Usage

```
$calendar = new SimpleMonthlyCalendar(new \DateTime('2016-12-31'));
var_dump($calendar->monthsSince(2)->format('Y/m/d'));
// string(10) "2017/02/28"
```


## Setup

```
$ composer install
$ php ./scripts/app.php
```

## Testing

```
$ ./bin/phpunit
```

### auto test

```
# compile(first time only)
$ ./bin/testrunner compile -p vendor/autoload.php
$ ./bin/testrunner phpunit -a tests/
```

## Blog Links

- [Obtaining the next month in PHP](http://derickrethans.nl/obtaining-the-next-month-in-php.html)

## Date, Time, and Calendar Library Links

- [Zend_Date - Zend Framework Reference - Zend Framework](http://framework.zend.com/manual/1.12/ja/zend.date.html)
  - [Zend Framework 1 for Composer, zf1/zend-date](https://github.com/zf1/zend-date)
- [pear/Calendar](https://github.com/pear/Calendar)
- [yohang/CalendR](https://github.com/yohang/CalendR)

## License

Public Domain
