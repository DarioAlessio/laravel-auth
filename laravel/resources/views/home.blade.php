@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">UPLOAD IMAGE</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('upload-image')}}"  method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('POST')


                      <input type="file" name="image" >
                      <br>
                      <br>
                      <input type="submit"  value="UPLOAD">


                    </form>
                    <br>

                    <a href="{{ route ('clear-image')}}"><input type="submit" value="CLEAR"></a>

                </div>


            </div>
        </div>

        @if (Auth::user() -> image)
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Profile</div>

                  <div class="card-body">
                      <h1>I'M A AVATAR</h1>

                      <img src="{{ asset ('storage/image/' . Auth::user() -> image  )}}" height="200px">

                  </div>


              </div>
          </div>
        @endif




    </div>
</div>
@endsection
