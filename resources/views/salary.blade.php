@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Saraly') }}</div>
                @if(Session::has('pmessage'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('pmessage') }}</p>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ url('salary-add/'.$user->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus disabled>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Emp ID') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number"  value="{{$user->id}}"  class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus disabled>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Gross Salary') }}</label>

                            <div class="col-md-6">
                                <input id="gsalary" type="text" class="form-control @error('gsalary') is-invalid @enderror" name="gsalary" value="{{ @$user->salary->gsalary }}" required autocomplete="gsalary">

                                @error('gsalary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="pf" class="col-md-4 col-form-label text-md-right">{{ __('PF') }}</label>

                            <div class="col-md-6">
                                <input id="pf" type="text" class="form-control @error('pf') is-invalid @enderror" name="pf" value="{{ @$user->salary->pf }}" required autocomplete="pf">

                                @error('pf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="esi" class="col-md-4 col-form-label text-md-right">{{ __('ESI') }}</label>

                            <div class="col-md-6">
                                <input id="esi" type="text" class="form-control @error('esi') is-invalid @enderror" name="esi" value="{{ @$user->salary->esi }}" required autocomplete="esi">

                                @error('esi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="tds" class="col-md-4 col-form-label text-md-right">{{ __('TDS') }}</label>

                            <div class="col-md-6">
                                <input id="tds" type="text" class="form-control @error('tds') is-invalid @enderror" name="tds" value="{{ @$user->salary->tds }}" required autocomplete="tds">

                                @error('tds')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nsalary" class="col-md-4 col-form-label text-md-right">{{ __('Net Salary') }}</label>

                            <div class="col-md-6">
                                <input id="nsalary" type="text"  value="{{ @$user->salary->nsalary }}"   class="form-control @error('nsalary') is-invalid @enderror" name="nsalary" required autocomplete="new-nsalary">

                                @error('nsalary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                    

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
