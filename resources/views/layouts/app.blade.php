<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{--  NE PAS INDEXER  --}}
  <meta name="robots" content="noindex, nofollow">

  <title>{{$currentPage['title']}}</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}"/> 
</head>

<body class="{{$currentPage['bodyClass']}}">

  <aside class="alert-container">

    {{-- <div class="alert alert-success alert-dismissible notification slide show" id="addRemoveNotif" role="alert">
      Suppression de <strong>2</strong> <a href="#cable-secteur">Câble secteur</a>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="alert alert-success alert-dismissible notification slide show" id="addRemoveNotif" role="alert">
      Suppression de <strong>2</strong> <a href="#cable-secteur">Câble secteur</a>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div> --}}

  </aside>

  <header>
      @include('layouts.main-nav')
      @yield('main-header')
  </header>
  
  <main role="document">
    @yield('content')
  </main>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
</body>

</html>