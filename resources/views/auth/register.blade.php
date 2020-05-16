@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="form-control-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-control-label">{{ __('E-Mail Address') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-control-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="form-control-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-university">Universitas</label>
                            <input id="input-university-id" name="university_id" type="hidden" value="">
                            <select class="form-control" id="input-university">
                                <option value=""></option>
                            </select>
                            <div class="invalid-feedback">
                            {{ $errors->first('university_id') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-address">NIM</label>
                            <input id="input-address" name="nim" class="form-control {{ $errors->first('nim') ? 'is-invalid' : ''}}" placeholder="Nomor Induk Mahasiswa" type="text" value="" required>
                            <div class="invalid-feedback">
                            {{ $errors->first('nim') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-address">Program Studi</label>
                            <input id="input-address" name="prodi" class="form-control {{ $errors->first('prodi') ? 'is-invalid' : ''}}" placeholder="Program Studi" type="text" value="" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('prodi') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-username">No Hp</label>
                            <input type="text" name="phone" id="input-username" class="form-control {{ $errors->first('phone') ? 'is-invalid' : ''}}" value="" placeholder="No Hp" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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

@section('localjs')
<!-- Local JS -->
<script>
  $(document).ready(function() {
  
    // initiate select2
    $('#input-university').select2({
      ajax: {
        url: '{{url("/api/sel2/perguruantinggi")}}',
        dataType: 'json',
        delay: 250,
        data: function (params) {
          var query = {
            search: params.term
          }

          // Query parameters will be ?search=[term]&page=[page]
          return query;
        },
        processResults: function (data) {
          return {
            results: $.map(data, function(obj) {
              return {
                id: obj.id,
                text: obj.text
              };
            })
          };
        },
        cache: true
      },
      placeholder: 'Pilih Perguruan Tinggi'
    });
  
  });

  // select2 onchange trigger
  $('#input-university').on('change',() => {
    let id = $('#input-university :selected').val();
    $('#input-university-id').val(id) ;
  })



  
</script>    
@endsection