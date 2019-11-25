<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <script src="https://kit.fontawesome.com/0febd544a9.js"></script>

<script> 

console.log('script ready');

function refresh() {

  var l = document.getElementById('refreshDate');
  
  var t = setTimeout(l, 500);
}
</script>


 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" >

        <title>My Events Calendar </title>

    </head>

    <body class=" mt-5 col-12 mx-auto">


    {{-- ERROS --}}

           
@if (session()->has('addedit'))
<div class="col-2 container   alert alert-success mx-right mt-1 mr-0" role="alert">
    {{ session()->get('addedit') }}
</div>
@endif


@if (session()->has('delete'))
<div class="col-2 container  alert alert-danger mx-right mt-1 mr-0" role="alert">
    {{ session()->get('delete') }}
</div>
@endif

              <!-- Errors -->
                        @if ($errors->any())
                            <div class="col-2 container alert alert-danger mx-right mt-1 mr-0">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif



    {{-- ERROS END --}}


      {{-- LOGIN  --}}

    @guest
                           
                                <a class="d-flex text-right" href="{{ route('login') }}">{{ __('Login') }}</a>
                           
                            @if (Route::has('register'))
                                
                                    <a class="d-flex text-right" href="{{ route('register') }}">{{ __('Register') }}</a>
                                
                            @endif
                        @else
                            
                                <a class="d-flex text-right"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Loged with : {{ Auth::user()->email }} <span class="caret"></span>
                                </a>


                                    <a class="class="d-flex text-right" nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                
                          
                        @endguest

<br>
      {{-- END LOGIN  --}}




    <button class="mx-auto   btn btn-outline-success "> About this app</button> 
       



<main class="col-12 mx-auto">
    
        <h1 class=" mb-3 text-center">Welcome to your Event calendar @  <span style="color:blue"> @if (Auth::user()) {{{  strtoupper(Auth::user()->name)  }}} @else You are not logged ! </span>@endif</h1>
        <h3 onload="refresh()" id="refreshDate" class=" mb-3 text-center">Current time : {{$currentDate}} <small>timezone : Europe/Paris</small></h3>
       




  <table class="col-8 mx-auto table">

  <thead class="thead-dark">
   <button type="button" class="mx-auto mb-2 text-center d-flex btn btn-primary" data-toggle="modal" data-target="#exampleModal1">New event</button>
      <tr>
        <th scope="col">Event status</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Date</th>
        <th scope="col">Tools</th>
      </tr>
  </thead>

  <tbody>
  @foreach ( $events as $event )
      
    
  <tr>
   
  <th scope="row" style="color:{{ $color }}">Event Status</th>
    <td>{{ $event->event_name }}</td>
    <td>{{ $event->event_description }}</td>
    <td> Event Start : {{$event->event_start}} <br> Event End : {{$event->event_end}}</td>  
    <td>
    <button  class="container btn-success" data-toggle="modal" data-target="#exampleModal2{{$event->id}}">Edit </button> 

    <form action="/{{$event->id}}" method="post">
    @method('DELETE')
    @csrf
    <button class="container mt-1 btn-danger">Delete </button>
    </form>
    </td>
    </tr>
     @endforeach
    </tbody>
    </table>

{{-- MODAL UPDATE --}}
     @foreach ($events as $event )
      <div class="modal fade" id="exampleModal2{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit an Event</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

      <form action="{{ route('update',  $event->id) }}" method="POST">
      @method('PUT')
      @csrf
    

      <div class="modal-body">
        
          <div class="form-group">
            <label for="name" class="col-form-label">Event Name</label>
            <input type="text" placeholder="{{$event->event_name}}" name="event_name" class="form-control" >
          </div>

    
          <div class="form-group">
            <label for="description" class="col-form-label">Event Description</label>
            <textarea placeholder="{{$event->event_description}}" name="event_description" class="form-control" id="message-text"></textarea>
          </div>

                  <div class="mb-2 input-group date" data-provide="datepicker">
            <input placeholder="Event start" name="event_start" type="text" class=" form-control">
            <div class=" ml-2 input-group-addon">
                <i class="far fa-calendar-alt"></i>
            </div>
        </div>
                  <div class=" input-group date" data-provide="datepicker">
            <input placeholder="Event end" name="event_end" type="text" class="form-control">
            <div class="ml-2 input-group-addon">
                <i class="fas fa-calendar"></i>
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endforeach


{{-- MODAL INSERT --}}

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ action('EventsController@store') }}" method="POST">

      
      @csrf
      <div class="modal-body">
        
          <div class="form-group">
            <label for="name" class="col-form-label">Event Name</label>
            <input type="text" name="event_name" class="form-control" >
          </div>

    
          <div class="form-group">
            <label for="description" class="col-form-label">Event Description</label>
            <textarea name="event_description" class="form-control" id="message-text"></textarea>
          </div>

                              <div class="mb-2 input-group date" data-provide="datepicker">
              <input placeholder="Event start" name="event_start" type="text" class=" form-control">
              <div class=" ml-2 input-group-addon">
                  <i class="far fa-calendar-alt"></i>
              </div>
          </div>
                    <div class=" input-group date" data-provide="datepicker">
              <input placeholder="Event end" name="event_end" type="text" class="form-control">
              <div class="ml-2 input-group-addon">
                  <i class="fas fa-calendar"></i>
              </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Add event</button>
      </div>
      </form>
    </div>
  </div>
</div>

</main>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"> </script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.fr.min.js"> </script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>





$.fn.datepicker.defaults.format = "dd/mm/yyyy ";
$('.datepicker').datepicker({
    
});
</script>
    </body>
</html>
