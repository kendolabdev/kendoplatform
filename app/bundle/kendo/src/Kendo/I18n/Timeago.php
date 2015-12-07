<?php
namespace Kendo\I18n;

/**
 * Class Timeago
 *
 * @package Kendo\I18n
 */
class Timeago
{

    /**
     * Seconds in a minute
     */
    CONST IN_MINUTE = 60;

    /**
     * Seconds in an hour
     */
    CONST IN_HOUR = 3600;

    /**
     * Seconds in a day
     */
    CONST IN_DAY = 86400;

    /**
     * Second in 30 day ( 1 month)
     */
    CONST IN_MONTH = 2592000;

    /**
     * Second in 365 days ( 1 year)
     */
    CONST IN_YEAR = 31104000;

    /**
     * less than 30 seconds
     */
    CONST AGO_SECONDS = 29;

    /**
     * less than 1 minutes and 30 second
     */
    CONST AGO_1_MINUTE = 89;

    /**
     * less than 1 hour
     */
    CONST AGO_MINUTES = 3600;

    /**
     * less than 1 hour 5 minute
     */
    CONST AGO_1_HOUR = 3900;

    /**
     * less than 1 day
     */
    CONST AGO_HOURS = 86400;

    /**
     * less than 1 day & 1 hours
     */
    CONST AGO_1_DAY = 9000;

    /**
     * less than 2 days
     */
    CONST AGO_1_DAY_HOURS = 172800;

    /**
     * less than 30 day
     */
    CONST AGO_DAYS = 2592000;

    /**
     * less than 31 day
     */
    CONST AGO_1_MONTH = 2678400;

    /**
     * less than 1 year
     */
    CONST AGO_MONTHS = 31536000;

    /**
     * less than 1 year 1 month
     */

    CONST AGO_1_YEAR = 34128000;

    /**
     * less than 2 years
     */
    CONST AGO_1_YEAR_MONTHS = 63072000;


    /**
     * @param $from
     *
     * @return string
     */
    public static function translate($from)
    {
        $diff = strtotime(Kendo_DATE_TIME) - strtotime($from);
        $timeago = null;

        $reps = [];


        switch (true) {

            case $diff < self::AGO_SECONDS:
                $timeago = "seconds_ago";
                break;

            case $diff < self::AGO_1_MINUTE:
                $timeago = "1_minute_ago";
                break;

            case $diff < self::AGO_MINUTES:
                $timeago = 'minutes_ago';
                $reps[':minutes'] = floor($diff / self::IN_MINUTE);
                break;

            case $diff < self::AGO_1_HOUR:
                $timeago = '1_hour_ago';
                break;

            case $diff < self::AGO_HOURS:
                $timeago = 'hours_ago';
                $reps[':hours'] = floor($diff / self::IN_HOUR);
                break;

            case $diff < self::AGO_1_DAY:
                $timeago = '1_day_ago';
                break;

            case $diff < self::AGO_1_DAY_HOURS:
                $timeago = '1_day_hours_ago';
                $reps[':hours'] = floor(($diff - self::IN_DAY) / self::IN_HOUR);
                break;

            case $diff < self::AGO_DAYS:
                $timeago = 'days_ago';
                $reps[':days'] = floor($diff / self::IN_DAY);
                break;

            case $diff < self::AGO_1_MONTH:
                $timeago = '1_month_ago';
                break;

            case $diff < self::AGO_MONTHS:
                $timeago = 'days_ago';
                $reps[':days'] = floor($diff / self::IN_MONTH);
                break;

            case $diff < self::AGO_1_YEAR:
                $timeago = '1_year_ago';
                break;

            case $diff < self::AGO_1_YEAR_MONTHS:
                $timeago = '1_year_months_ago';
                $reps[':months'] = floor(($diff - self::IN_YEAR) / self::IN_MONTH);
                break;

            default:
                $timeago = 'years_months_ago';
                $years = floor($diff / self::IN_YEAR);
                $month = floor(($diff - $years * self::IN_YEAR) / self::IN_MONTH);

                $reps[':years'] = $years;
                $reps[':months'] = $month;

                if (1 > $month) {
                    $timeago = 'years_ago';
                }
        }

        return \App::text('core.' . $timeago, $reps);
    }
}