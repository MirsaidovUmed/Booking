@php
    $startDate = request()->get('start_date', \Carbon\Carbon::now()->format('Y-m-d'));
    $endDate = request()->get('end_date', \Carbon\Carbon::now()->addDay()->format('Y-m-d'));
@endphp

<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <!-- Информация по отелю -->
        <div class="flex flex-wrap mb-12">
            <div class="w-full flex justify-start md:w-1/3 mb-8 md:mb-0">
                <img class="h-full rounded-l-sm" src="{{ $hotel->poster_url }}" alt="Hotel Image">
            </div>
            <div class="w-full md:w-2/3 px-4">
                <div class="text-2xl font-bold">{{ $hotel->title }}</div> <!-- Исправлено поле с name на title -->
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0-2c3.31 0 6 2.69 6 6s-2.69 6-6-6-6-2.69-6-6 2.69-6 6-6z" />
                    </svg>
                    {{ $hotel->address }} <!-- Адрес отеля -->
                </div>
                <div>{{ $hotel->description }}</div> <!-- Описание отеля -->
            </div>
        </div>

        <!-- Форма бронирования -->
        <div class="flex flex-col">
            <div class="text-2xl text-center md:text-start font-bold">Забронировать комнату</div>
            <form method="get" action="{{ url()->current() }}">
                <div class="flex my-6">
                    <div class="flex items-center mr-5">
                        <div class="relative">
                            <input name="start_date" min="{{ date('Y-m-d') }}" value="{{ $startDate }}"
                                   placeholder="Дата заезда" type="date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                        <span class="mx-4 text-gray-500">по</span>
                        <div class="relative">
                            <input name="end_date" type="date" min="{{ date('Y-m-d') }}" value="{{ $endDate }}"
                                   placeholder="Дата выезда"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                    </div>
                    <div>
                        <x-the-button type="submit" class=" h-full w-full">Загрузить номера</x-the-button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Список отзывов -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Отзывы</h2>
            @if($hotel->reviews->isNotEmpty())
                @foreach($hotel->reviews as $review)
                    <div class="border-b py-4">
                        <div class="font-bold">{{ $review->user->name }}</div> <!-- Имя пользователя, оставившего отзыв -->
                        <div class="text-sm text-gray-600">
                            @if($review->created_at)
                                {{ $review->created_at->format('Y-m-d') }}
                            @else
                                Дата не указана
                            @endif
                        </div>
                        <div class="mt-2 font-bold text-yellow-500">Отзыв: {{ $review->review}}</div> <!-- Отзыв -->
                        <div class="mt-2 font-bold text-yellow-500">Рейтинг: {{ $review->rating }}/5</div> <!-- Рейтинг -->
                    </div>
                @endforeach
            @else
                <p>Пока нет отзывов об этом отеле.</p>
            @endif
        </div>
    </div>
</x-app-layout>
