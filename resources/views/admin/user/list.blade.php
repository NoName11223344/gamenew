@extends('admin.master.layout')

@section('content')
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">List User</h3>
            <a href="{{ route('user.create') }}" class="btn btn-success float-right">Thêm mới</a>
        </div>
        <div class="card-header">
            <form action="{{ route('user.index') }}" method="get">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="user_name">Tên đăng nhập</label>
                        <input type="text" id="user_name" class="form-control" name="user_name" value="{{ request('user_name') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="status">Trạng thái</label>
                        <select class="select form-control" name="status">
                            <option value="">-- Tất cả --</option>
                            <option value="0" {{ request('status') == '0' ? "selected" : ''}}>Chưa kích hoạt</option>
                            <option value="1" {{ request('status') == 1 ? "selected" : ''}}>Đã kích hoạt</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type">Phân loại</label>
                        <select class="select form-control" name="role">
                            <option value="">-- Tất cả --</option>
                            <option value="0" {{ request('role') == '0' ? "selected" : ''}}>Thành viên</option>
                            <option value="1" {{ request('role') == 1 ? "selected" : ''}}>Admin</option>
                            <option value="2" {{ request('role') == 2 ? "selected" : ''}}>Sale</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary"> Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>

    @if (session('success'))
            <div class="alert alert-success mx-2 mt-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-body" style="overflow-x: scroll">
            <table class="table table-bordered" style="width: 1500px">
                <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>User Name</th>
                    <th>Mật khẩu</th>
                    <th>Tên</th>
                    <th>Đại lý</th>
                    <th>Số điện thoại</th>
                    <th>Mức quy đổi</th>
                    <th>Trạng thái</th>
                    <th>Phân loại</th>
                    <th>Thời gian tạo</th>

                    <th style="width: 150px">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->user_name }}</td>
                    <td>{{ \Illuminate\Support\Facades\Crypt::decrypt($user->password) }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        @if(isset($user->group->group_name))
                            <span class="badge badge-success">{{ $user->group->group_name }}</span>
                        @else
                            <span class="badge badge-warning">Chưa được phân đại lý</span>
                        @endif
                       </td>
                    <td>
                        {{ $user->phone }}
                    </td>
                    <td>
                        @switch($user->rate)
                            @case(1)
                            1đ = 25.000đ
                            @break
                            @case(2)
                            1đ = 50.000đ
                            @break
                            @case(3)
                            1đ = 100.000đ
                            @break
                        @endswitch
                    </td>
                    <td>
                        @switch($user->status)
                            @case(0)
                            <span class="badge badge-warning">Chưa kích hoạt</span>
                            @break
                            @case(1)
                            <span class="badge badge-primary">Đã kích hoạt</span>
                            @break
                        @endswitch
                    </td>
                    <td>
                        @switch($user->role)
                            @case(0)
                            Người dùng
                            @break
                            @case(1)
                            Admin
                            @break
                            @case(2)
                            Sale
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#LinkAff{{$user->id}}">
                                <i class="fas fa-link"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="LinkAff{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="#LinkAff{{$user->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Link affiliate
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body row">
                                            <input class="form-control col-md-11" type="text" disabled
                                                   value="{{ route('register', ['sale' => $user->user_name]) }}">
                                            <button onclick="return copyText(this)" class="copy_aff btn btn-primary col-md-1"><i class="fas fa-copy"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @break
                        @endswitch
                    </td>
                    <td>
                        {{ date('d-m-Y H:i:s', strtotime($user->created_at)) }}
                    </td>
                    <td style="width: 150px">
                        <a href="{{ route('user.edit', ['user' => $user->id]) }}" title="Chỉnh sửa">
                            <button class="btn btn-primary">
                                <i class="fa fa-pencil-alt"></i>
                            </button>
                        </a>
                        <a onclick="deleteItem(this);" url="{{ route('user.destroy', ['user' => $user->id]) }}" title="Xóa"><button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></a>
                        @if($user->status == 0)
                        <a onclick="acceptItem(this);" url="{{ route('accept_user', ['id' => $user->id]) }}" title="Kích hoạt">
                            <button class="btn btn-success">
                                <i class="fa fa-angle-up"></i>
                            </button>
                        </a>
                        @else
                            <a onclick="acceptItem(this);" url="{{ route('accept_user', ['id' => $user->id]) }}" title="Hủy Kích hoạt">
                                <button class="btn btn-success">
                                    <i class="fa fa-angle-down"></i>
                                </button>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->appends(request()->query())->links() }}
    </div>
@endsection
@section('js')
    <script>
        function copyText(button) {
            const input = $(button).prev('input');
            navigator.clipboard.writeText(input.val())
                .then(() => {
                    alert('Text copied to clipboard');
                    console.log('Text copied to clipboard');
                })
                .catch((err) => {
                    alert('Failed to copy text');
                    console.error('Failed to copy text: ', err);
                });
        };
    </script>
@endsection
