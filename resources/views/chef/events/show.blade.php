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
    
            <form method="get" action="{{ route('events.edit',['event' => $event->id]) }}">
    
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
                <div class="flex space-x-4 justify-around">
                    @if($event->is_visible)
                    表示中
                    @else
                    非表示
                    @endif
                </div>
                @if($event->eventDate >= \Carbon\Carbon::today()->format('Y年m月d日'))
                <x-jet-button class="ml-4">
                    編集する
                </x-jet-button>
                @endif
            </div>
            </form>
            </div>

          </div>
      </div>
  </div>
  <div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="max-w-2xl py-4 mx-auto">
              @if (!$users->isEmpty())
                  <div class="text-center py-4">予約状況</div>
                  <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                      <tr>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約者名</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約人数</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                        @if(is_null($reservation['canceled_date']))
                        <tr>
                            <td class="px-4 py-3">{{$reservation['name']}}様</td>
                            <td class="px-4 py-3">{{$reservation['number_of_people']}}名</td>
                        </tr>
                        @endif
                       @endforeach
                      @endif
                    </tbody>
                  </table>    
          </div>
        </div>
    </div>
  </div>
  <script src="{{ mix('js/flatpickr.js')}}"></script>
</x-app-layout>
