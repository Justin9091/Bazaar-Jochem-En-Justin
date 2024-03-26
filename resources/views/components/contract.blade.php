<div>
    <a href="{{ route('download.contract') }}" class="btn btn-primary bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" download="contract.pdf">@lang('csv.download_contract')</a>

    <form action="{{ route('upload.contract') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">@lang('csv.select_file')</label>
        <input type="file" id="file" name="file">
        <button type="submit">@lang('csv.upload')</button>
    </form>
</div>
