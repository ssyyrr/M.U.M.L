@extends('layouts.form')
@section('card')



    @component('components.card')

        @slot('title')
            @lang('Register')
        @endslot

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" name="register">
                        {{ csrf_field() }}

                        @include('partials.form-group', [
                         'title' => __('Carte Identite Nationale'),
                          'type' => 'text',
                          'name' => 'cin',
                          'required' => true,
                         'span'=>'fas fa-address-card',
                          'alias'=> '99999999',
                          'cat'=> 'mask',

                           ])
                        {{--'alias'=> '',--}}
                        {{--'cat'=> 'alias',--}}

                        @include('partials.form-group', [
                                                 'title' => __('Nom'),
                                                  'type' => 'text',
                                                  'name' => 'name',
                                                  'required' => true,
                                                 'span'=>'fas fa-user',
                                                 'alias'=> '',
                                                     'cat'=> 'alias',

                                                   ])

                        @include('partials.form-group', [
                                               'title' => __('Prenom'),
                                                'type' => 'text',
                                                'name' => 'prenom',
                                                'required' => true,
                                               'span'=>'fas fa-user-friends',
                                               'alias'=> '',
                                                   'cat'=> 'alias',

                                                 ])

                        @include('partials.form-group', [
                                            'title' => __('Date de Naissance'),
                                             'type' => 'text',
                                             'name' => 'datenaissance',
                                             'required' => true,
                                            'span'=>'fa fa-calendar',
                                            'alias'=> 'dd/mm/yyyy',
                                             'cat'=> 'alias',
                                              ])

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <span class="fas fa-key  form-control-row"  aria-hidden="true" ></span>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="universite_id" class="col-md-4 col-form-label text-md-right">{{ __('Universite') }}</label>
                            <span class="fas fa-university  form-control-row"  aria-hidden="true" ></span>
                            <div class="col-md-6">

                                <select id="universite_id" type="text"
                                        class="form-control input-sm {{ $errors->has('universite_id') ? ' is-invalid' : '' }}"
                                        {{-- linked-select  data-target="#etablissement" onchange="divetablissement()"--}}

                                        name="universite_id" value="{{ old('universite_id') }}"
                                        required autofocus>
                                    <option value=''> --Select University-- </option>

                                          @if(!empty($universites))

                                                @foreach($universites as $universite )
                                                    <option value='{{ $universite->id }}'  > {{ $universite->intitule}}</option>

                                                @endforeach
                                           @endif


                                </select>
                            </div>
                            @if ($errors->has('universite_id'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('universite_id') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row"
                             id="divetablissement"
                             name="divetablissement">
                            {{--style="display:none;"--}}


                            <label for="etablissement_id" class="col-md-4 col-form-label text-md-right">{{ __('Etablissement') }}</label>
                            <span class="fas fa-home   form-control-row"  aria-hidden="true" ></span>
                            <div class="col-md-6">
                                <select id="etablissement_id"
                                        type="text" class="form-control input-sm {{ $errors->has('etablissement_id') ? ' is-invalid' : '' }}"
                                        name="etablissement_id" value="{{ old('etablissement_id') }}" required autofocus>
                                    <option value=''> --Select Etablissement-- </option>

                                             @if(!empty($etablissements))

                                                        @foreach($etablissements as $etablissement )
                                                            <option value='{{ $etablissement-> id}}'>
                                                                {{ $etablissement->intitule}}
                                                            </option>
                                                        @endforeach

                                             @endif
                                </select>
                            </div>
                            @if ($errors->has('etablissement_id'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('etablissement_id') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile Utilisateur') }}</label>
                            <span class="fas fa-graduation-cap   form-control-row"  aria-hidden="true" ></span>
                            <div class="col-md-6">
                                <select id="profile" type="text" class="form-control{{ $errors->has('profile') ? ' is-invalid' : '' }}" name="profile" value="{{ old('profile') }}" required autofocus>
                                    <option value="">Select User Role</option>
                                    <option value="Etudiant">Etudiant</option>
                                    <option value="Enseignant">Enseignant</option>


                                </select>
                            </div>
                            @if ($errors->has('profile'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profile') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row" id="divgrade" style="display:none;">
                            <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Grade Utilisateur') }}</label>
                            <span class="fas fa-user-graduate form-control-row"  aria-hidden="true" ></span>
                            <div class="col-md-6">
                                <select id="grade" type="text" class="form-control{{ $errors->has('grade') ? ' is-invalid' : '' }}"
                                        name="grade" value="{{ old('grade') }}" required autofocus>

                                </select>
                            </div>
                            @if ($errors->has('grade'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('grade') }}</strong>
                                    </span>
                            @endif
                        </div>

                        @include('partials.form-group', [
                                           'title' => __('Addresse'),
                                            'type' => 'text',
                                            'name' => 'addresse',
                                            'required' => true,
                                           'span'=>'fas fa-map-marker-alt',
                                           'alias'=> '',
                                           'cat'=> 'alias',
                                             ])

                        @include('partials.form-group', [
                                        'title' => __('Numero Telephone'),
                                         'type' => 'text',
                                         'name' => 'numtel',
                                         'required' => true,
                                        'span'=>'fas fa-phone-volume ',
                                         'cat'=> 'mask',
                                        'alias'=> '(999) 9999-9999',
                                          ])


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">

                                @component('components.button',[
                                    'span'=>'fas fa-hand-pointer',
                                     ]
                                  )
                                    {{ __('Register') }}
                                @endcomponent

                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    @endcomponent

@endsection
