
        <div class="form-group">
            {{ Form::label('Username') }}
            {!! Form::text('name', old('name'), [
                'class' => 'form-control',
                'placeholder' => 'Please Enter Name',
                'required' => 'true',
                'minlength' => 5,
                'maxlength' => 40,
            ]) !!}
        </div>
        <div class="form-group">
            {{ Form::label('Email') }}
            @if ($trans == 'user.admin.adUser.btnUserAdd')
                    {!! Form::text('email', old('email'), [
                        'class' => 'form-control',
                        'placeholder' => 'Please Enter Email',
                        'required' => 'true',
                        'minlength' => 5,
                        'maxlength' => 80,
                    ]) !!}
                @else
                    {!! Form::text('email', old('email'), [
                        'class' => 'form-control',
                        'placeholder' => 'Please Enter Email',
                        'required' => 'true',
                        'minlength' => 5,
                        'maxlength' => 80,
                        'readonly' => 'true'
                    ]) !!}
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {{ Form::label('password', trans('auth.password')) }}
            {!! Form::password('password', [
                'class' => 'form-control', 
                'id' => 'password', 
                'minlength' => 6,
                'maxlength' => 30,
            ]) !!}
            @include('layouts.error-validate', ['title' => 'password'])
        </div>
        <div class="form-group">
            {{ Form::label('password-confirm', trans('auth.confirm_password')) }}
            {!! Form::password('password_confirmation', [
                'class' => 'form-control', 
                'id' => 'password-confirm',
                'minlength' => 6,
                'maxlength' => 30,
            ])!!}
        </div>
        <div class="form-group">
             {{ Form::label('User Level') }}
             {!! Form::select('role', ['1' => 'Admin', '2' => 'user']) !!}
        </div>
        {!! Form::submit(trans($trans), ['class' => 'btn btn-default']) !!}
        {!! Form::reset(trans('user.admin.reset'), ['class' => 'btn btn-default']) !!}
