<form action="{{ route('sellers.importcsv', ['userId' => $userid]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="csv_file">Select CSV File to Import:</label>
        <input type="file" class="form-control-file" id="csv_file" name="csv_file">
    </div>
    <button type="submit" class="btn btn-primary">Import CSV</button>
</form>
