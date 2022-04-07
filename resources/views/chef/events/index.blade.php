<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          イベント管理
      </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
              <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">イベント一覧</h1>
              </div>
              @if (session('status'))
              <div class="mb-4 font-medium text-green-600">
                  {{ session('status') }}
              </div>
          @endif
              <div class="w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                  <thead>
                    <tr>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">イベント名</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">開始日時</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">終了日時</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約人数</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">定員</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">表示・非表示</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($events as $event)
                    <tr>
                      <td class="text-blue-500 px-4 py-3"><a href="{{route('events.show',['event' => $event->id])}}">{{$event->name}}</a></td>
                      <td class="px-4 py-3">{{$event->start_date}}</td>
                      <td class="px-4 py-3">{{$event->end_date}}</td>
                      <td class="px-4 py-3">15 GB</td>
                      <td class="px-4 py-3 text-lg text-gray-900">{{$event->max_people}}</td>
                      <td class="px-4 py-3 text-lg text-gray-900">{{$event->is_visible}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{$events->links()}}
              </div>
              <div class="flex justify-between mt-4">
                <div><button onclick="location.href='{{route('events.past')}}'" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">過去のイベント一覧</button></div>
                <div><button onclick="location.href='{{route('events.create')}}'" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">新規作成</button></div>
              </div>
            </div>
          </section>
        </div>
    </div>
</div>

</x-app-layout>
