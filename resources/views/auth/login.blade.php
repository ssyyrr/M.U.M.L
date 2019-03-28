@extends('layouts.form')
@section('card')

@component('components.card')
        @slot('title')
            @lang('Inscription')
@endslot

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        {{ csrf_field() }}


                        @include('partials.form-group', [
                                           'title' => __('E-Mail Address'),
                                            'type' => 'email',
                                            'name' => 'email',
                                            'required' => true,
                                           'span'=>'fas fa-at',
                                           'alias'=> '',
                                               'cat'=> 'alias',
                                             ])

                        @include('partials.form-group', [
                                            'title' => __('Password'),
                                             'type' => 'password',
                                              'name' => 'password',
                                              'required' => true,
                                              'span'=>'fas fa-unlock',
                                              'alias'=> '',
                                               'cat'=> 'alias',
                                               ])


                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="fas fa-sign-in-alt  form-control-row"  aria-hidden="true" ></span>

                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    <span class="fas fa-unlock   form-control-row"  aria-hidden="true" ></span>

                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    @endcomponent
@endsection
