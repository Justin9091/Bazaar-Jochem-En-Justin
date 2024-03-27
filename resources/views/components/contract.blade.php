<div class="bg-gray-800 rounded-lg flex flex-col items-center justify-center p-5">
    <a href="{{ route('download.contract', ['userid' => $userid]) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-4" download="contract.pdf">@lang('csv.download_contract')</a>

    <form action="{{ route('upload.contract', ['userid' => $userid]) }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center justify-center">
        @csrf
        <label for="file" class="mb-2">@lang('csv.select_file')</label>
        <input type="file" id="file" name="file" class="bg-gray-700 py-2 px-4 rounded focus:outline-none focus:bg-white focus:border-gray-800 mb-4">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">@lang('csv.upload')</button>
    </form>
</div>
