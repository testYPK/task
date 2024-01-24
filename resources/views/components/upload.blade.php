@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div>
    <form action="{{ route('files.manualUpload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row w-50 p-3">
                <label for="file" class="form-label">Choose file:</label>
                <input class="form-control form-control-lg" type="file" id="file" name="file"
                       accept=".csv">
                <button class="btn btn-danger" type="submit">
                    Upload
                </button>
            </div>
        </div>
    </form>
</div>
