<div class="col-12 col-md-12 col-lg-4">
    <div class="card">
        @php
            $route = isset($edit) ? route('users.update',$edit->id) : route('users.store');
        @endphp
        <form method="post" class="needs-validation" enctype="multipart/form-data"
              action="{{ $route }}">@csrf
            @isset($edit)
                @method('put')
            @endisset
            <div class="card-header">
                <h4>{{ isset($edit) ? __('Edit User') : __('Add User') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">{{ __('Name') }} <strong>*</strong></label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ old('name') ? : (isset($edit) ? $edit->name : '') }}">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group col-12">
                        <label for="email">{{ __('Email') }} <strong>*</strong></label>
                        <input type="text" name="email" id="email" class="form-control"
                               value="{{ old('email') ? : (isset($edit) ? $edit->email : '') }}">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group col-12">
                        <label for="password">{{ __('Password') }} <strong>*</strong></label>
                        <input type="password" name="password" id="password" class="form-control">
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group col-12">
                        <label for="password_confirmation">{{ __('Confirm Password') }} <strong>*</strong></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">{{ __('Save Changes') }}</button>
            </div>
        </form>
    </div>
</div>
