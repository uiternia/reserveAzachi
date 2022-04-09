<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          イベント内容
      </h2>
  </x-slot>

  <div class="pt-12 pb-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <div class="max-w-2xl py-4 mx-auto">
            <x-jet-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            {{-- <form method="post" action="{{ route('events.destroy',['event' => $event->id]) }}">
                @csrf
                @method('delete')
                <input type="submit" value="イベントを消去">
            </form> --}}
    
            <form method="post" action="{{ route('events.reserve',['id' => $event->id]) }}">
              @csrf
                <div class="my-4">
                    <x-jet-label for="event_name" value="イベント名" />
                    {{$event->name}}
                </div>

                <div class="my-4 border-t-2">
                    <x-jet-label for="information" value="イベント詳細" />
                    {!! nl2br(e($event->information)) !!}
                </div>


            <div class="md:flex border-t-2 justify-between">
                <div class="my-4">
                    <x-jet-label for="event_date" value="イベント日付" />
                    {{$event->eventDate}}
                </div>

                <div class="my-4">
                    <x-jet-label for="start_time" value="開始時刻" />
                    {{$event->startTime}}
                </div>

                <div class="my-4">
                    <x-jet-label for="end_time" value="終了時刻" />
                    {{$event->endTime}}
                </div>
            </div>

            <div class="md:flex border-t-2 justify-between items-end">
                <div class="mt-4">
                    <x-jet-label for="max_people" value="定員上限" />
                    {{$event->max_people}}
                </div>

                <div class="mt-4">
                  <x-jet-label for="reserved_people" value="予約人数" />
                  <select name="reserved_people">
                    @for($i = 1; $i <= $reservablePeople; $i++)
                    <option value="{{$i}}">
                      {{$i}}
                    </option>
                    @endfor
                  </select>
                </div>
                <input type="hidden" name="id" value="{{$event->id}}">
                <x-jet-button class="ml-4">
                    予約する
                </x-jet-button>
            </div>
            </form>
            </div>

          </div>
      </div>
  </div>
</x-app-layout>
