<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use Carbon\Carbon;
use App\Services\EventService;

class EventController extends Controller
{
    
    public function index()
    {
        $events = DB::table('events')
        ->orderBy('start_date','asc')
        ->paginate(10);
        return view('chef.events.index',
        compact('events'));
    }

   
    public function create()
    {
        return view('chef.events.create');
    }

   
    public function store(StoreEventRequest $request)
    {

       $check =  EventService::checkDuplication($request['event_date'],$request['start_time'],$request['end_time']);

        // $check = DB::table('events')
        // ->whereDate('start_date',$request['event_date'])
        // ->whereTime('end_date','>',$request['start_time'])
        // ->whereTime('start_date','<',$request['end_time'])
        // ->exists();

        if($check){
            session()->flash('status','この時間帯は他のイベントが存在します。');
            return view('chef.events.create');
        }

        $startDate = EventService::joinDateAndTime($request['event_date'],$request['start_time']);
        $endDate = EventService::joinDateAndTime($request['event_date'],$request['end_time']);

        // $start = $request['event_date'] . " " . $request['start_time'];
        // $startDate = Carbon::createFromFormat(
        //     'Y-m-d H:i', $start
        // );

        // $end = $request['event_date'] . " " . $request['end_time'];
        // $endDate = Carbon::createFromFormat(
        //     'Y-m-d H:i', $end
        // );

        Event::create([
            'name' => $request['event_name'],
            'information' => $request['information'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'max_people' => $request['max_people'],
            'is_visible' => $request['is_visible'],
        ]);

        session()->flash('status','イベントを一件登録しました。');
        return to_route('events.index');
    }

   
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
