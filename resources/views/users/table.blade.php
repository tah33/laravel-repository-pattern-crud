<div class="col-12 col-md-12 col-lg-8">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Users') }}</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            @foreach($users as $key=> $user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="btn btn-primary">{{ __('Edit') }}</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                              class="d-inline" onsubmit="return confirm('{{__('Are You Sure')}}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($users->nextPageUrl())
        <div class="card-footer text-right">
            {{ $users->links('vendor.pagination.bootstrap-5') }}
        </div>
    @endif
</div>
