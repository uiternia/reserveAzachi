<x-calendar-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          イベントカレンダー
        </h2>
      </div>
      @if (Route::has('login'))
      <div>
          @auth
              <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
          @else
              <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

              @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
              @endif
          @endauth
      </div>
    </div>
  @endif
  </x-slot>

 <div class="py-12 overflow-scroll">
      <div class="event-calendar  mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @livewire('calendar')
          </div>
      </div>
  </div>
  
</x-calendar-layout>
