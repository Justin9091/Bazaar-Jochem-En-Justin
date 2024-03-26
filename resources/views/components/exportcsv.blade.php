<div class="grid grid-cols-2 gap-4">
    <x-form action="{{ route('sellers.importcsv', ['userId' => $userid]) }}" method="POST" enctype="multipart/form-data" class="mt-4">
        <div class="mb-4">
            <label for="csv_file" class="block text-white font-semibold">@lang('csv.choose_file_to_import'):</label>
            <input type="file" id="csv_file" name="csv_file" class="block w-full mt-1 px-4 py-2 bg-gray-600 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <button type="submit" class="btn btn-primary inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition duration-300 ease-in-out">@lang('csv.import_csv')</button>
        <a href="{{ route('sellers.createcsv', ['userId' => $userid]) }}" class="btn btn-primary inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition duration-300 ease-in-out">@lang('csv.create_csv')</a>
    </x-form>
</div>
