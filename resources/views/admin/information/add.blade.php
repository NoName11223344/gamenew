@extends('admin.master.layout')

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Thêm mới thông tin</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form method="post" action="{{ route('information.store') }}">
                    @csrf
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="title">Tên thông tin</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="password">Nội dung thông tin </label>
                                <textarea class="form-control" name="content"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <input class="btn btn-primary" type="submit" value="Lưu">
                        </div>

                </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            // Summernote
            $('#summernote').summernote({
                height: 200,
                focus: true
            })

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
@endsection
