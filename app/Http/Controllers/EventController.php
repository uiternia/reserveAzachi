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
        $today = Carbon::today();

        $reservedPeople = DB::table('reserves')
        ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
        ->whereNull('canceled_date')
        ->groupBy('event_id');

        $events = DB::table('events')
        ->leftJoinSub($reservedPeople, 'reservedPeople', function($join){
        $join->on('events.id', '=', 'reservedPeople.event_id'); })
        ->whereDate('start_date','>=' , $today)
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

        if($check){
            session()->flash('status','この時間帯は他のイベントが存在します。');
            return view('chef.events.create');
        }

        $startDate = EventService::joinDateAndTime($request['event_date'],$request['start_time']);
        $endDate = EventService::joinDateAndTime($request['event_date'],$request['end_time']);


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
        $event = Event::findOrFail($event->id);

        $users = $event->users;

        $reservations = [];
        
        foreach($users as $user)
        {
            $reservedInfo = [
                'name' => $user->name,
                'number_of_people' => $user->pivot->number_of_people,
                'canceled_date' => $user->pivot->canceled_date
            ];
            array_push($reservations,$reservedInfo);
        }

        $eventDate = $event->eventDate;
        $startTime = $event->start_time;
        $endTime = $event->end_time;

        return view('chef.events.show',compact('event','users','eventDate','reservations','startTime','endTime'));
    }

    public function edit(Event $event)
    {
        $event = Event::findOrFail($event->id);
        $eventDate = $event->editEventDate;
        $startTime = $event->start_time;
        $endTime = $event->end_time;
        
        return view('chef.events.edit',compact('event','eventDate','startTime','endTime'));
    }

    
    public function update(UpdateEventRequest $request, Event $event)
    {
        
        $check =  EventService::countDuplication(
            $event->id,
            $request['event_date'],
            $request['start_time'],
            $request['end_time']
        );

        if($check){
            $event = Event::findOrFail($event->id);

            $eventDate = $event->editEventDate;
            $startTime = $event->start_time;
            $endTime = $event->end_time;
            
            session()->flash('status','この時間帯は他のイベントが存在します。');
            return view('chef.events.edit',compact('event','eventDate','startTime','endTime'));
        }

        $startDate = EventService::joinDateAndTime($request['event_date'],$request['start_time']);
        $endDate = EventService::joinDateAndTime($request['event_date'],$request['end_time']);

        $event = Event::findOrFail($event->id);
        $event->name = $request['event_name'];
        $event->information = $request['information'];
        $event->start_date = $startDate;
        $event->end_date = $endDate;
        $event->max_people = $request['max_people'];
        $event->is_visible = $request['is_visible'];
        $event->save();
            
        session()->flash('status','イベント内容を更新しました');
        return to_route('events.index');

    }

    
    public function destroy(Event $event)
    {
        // $event = Event::findOrFail($event->id);
        // $event->delete();
        // session()->flash('status','イベントを消去しました。');
        // return to_route('events.index');
    }

    public function past()
    {
        $today = Carbon::today();

        $reservedPeople = DB::table('reserves')
        ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
        ->whereNull('canceled_date')
        ->groupBy('event_id');
        $events = DB::table('events')
        ->leftJoinSub($reservedPeople, 'reservedPeople', function($join){
        $join->on('events.id', '=', 'reservedPeople.event_id'); })
        ->whereDate('start_date', '<' , $today)
        ->orderBy('start_date','desc')
        ->paginate(10);

        return view('chef.events.past',compact('events'));
    }
}
