<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventService
{
  public static function checkDuplication($eventDate, $startTime, $endTime)
  {
    $check = DB::table('events')
        ->whereDate('start_date',$eventDate)
        ->whereTime('end_date','>',$startTime)
        ->whereTime('start_date','<',$endTime)
        ->exists();
        return $check;
  }

  public static function joinDateAndTime($date,$time)
  {
    $join = $date . " " . $time;
    $dateTime = Carbon::createFromFormat('Y-m-d H:i', $join);
    return $dateTime;
  }
}
