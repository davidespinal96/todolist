<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>To-do list</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
</head>
<body>
  <div class="container">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <p>Logged as <b>{{ Auth::user()->name }}</b> 
        <button type="submit" class="waves-effect waves-light btn">Logout</button>
      </p>
    </form>
    <h1 class="center-align green-text text-darken-4">To Do List</h1>
    
    @yield('content')

  </div>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
  <script>
    var elem = document.querySelector('.collapsible');
    var options;
    var instance = M.Collapsible.init(elem, options);

    var elem2 = document.querySelector('select');
    var instance = M.FormSelect.init(elem2);

    $(document).ready(function(){
      $.ajax({
        type: 'get',
        url: '{!!URL::to('search')!!}',
        success: function(response){
          var r_array = response;
          var data_r = {};

          for(var i = 0; i < r_array.length; i++){
            data_r[r_array[i].content] = null;
          }

          $('input#search').autocomplete({
            data : data_r,
            onAutocomplete : function(reqdata){
              
            }
          });
        }
      })
    });
  </script>
  </body>
</html>
