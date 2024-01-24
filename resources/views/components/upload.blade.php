<div>
    <form action="{{ route('files.manualUpload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div style="text-align: center;
                 width: 400px;
                 margin: auto;
                 margin-top: 100px;">
            <label for="file" class="form-label">Choose file:</label>
            <input class="form-control form-control-lg" type="file" id="file" name="file"
                   accept=".csv">
            <button class="btn btn-danger" type="submit">
                Upload
            </button>
        </div>
    </form>
</div>
