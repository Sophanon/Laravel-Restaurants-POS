@extends('index')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="text-right mb-1">
                    <a class="btn btn-primary" href="{{ route('user_create') }}">Create</a>
                </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th style="width: 40px">Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->status ? 'active' : 'inactive' }}</td>
                            <td>
                                <a href="{{ route('user_show', $item->id) }}" class="btn btn-warning">Edit</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteItem{{ $item->id }}">
                                    Delete
                                </button>
                                @include('admin.users.delete', [
                                    'item' => $item
                                ])
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Data</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $data->links() }}
            </div>
          </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection
