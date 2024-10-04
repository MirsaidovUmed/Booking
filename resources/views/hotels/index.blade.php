<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">

        <form method="GET" action="{{ route('hotels.index') }}" class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="price_min" class="block text-sm font-medium text-gray-700">Min Price</label>
                    <input type="number" name="price_min" id="price_min" value="{{ request('price_min') }}" min="0" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="price_max" class="block text-sm font-medium text-gray-700">Max Price</label>
                    <input type="number" name="price_max" id="price_max" value="{{ request('price_max') }}" min="0" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="facilities" class="block text-sm font-medium text-gray-700">Facilities</label>
                    <select name="facilities[]" id="facilities" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" multiple>
                        @foreach($facilities as $facility)
                            <option value="{{ $facility->id }}" {{ is_array(request('facilities')) && in_array($facility->id, request('facilities')) ? 'selected' : '' }}>{{ $facility->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Filter</button>
                <a href="{{ route('hotels.index') }}" class="ml-4 px-4 py-2 bg-gray-600 text-white rounded-md">Reset</a>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($hotels as $hotel)
                <x-hotels.hotel-card :hotel="$hotel"></x-hotels.hotel-card>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $hotels->links() }}
        </div>
    </div>
</x-app-layout>
