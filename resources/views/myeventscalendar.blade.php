<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>My Events Calendar </title>

    </head>
    <body class=" mt-5 col-8 mx-auto">

    
        <h1 class=" mb-3 text-center">Welcome to your Event calendar</h1>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
       <th scope="col">Description</th>
      <th scope="col">Date</th>
      <th scope="col">Tools</th>
    </tr>
  </thead>

  <tbody>
  @foreach ( $events as $event )
      
 
    <tr>
      <th scope="row">Stat</th>
      <td>{{ $event->event_name }}</td>
      <td>{{ $event->event_description }}</td>
      <td> Event Start : {{$event->event_start}} <br> Event End : {{$event->event_end}}</td>
      
      <td>
      
      
      <form action="/{{ $event->id }}" method="post">
      <button class="container btn-success" data-toggle="modal" data-target="#exampleModal2">Edit </button> 

    @method('PUT')

</form>


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

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/" method="POST">
      @method('PUT')
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
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Update</button>
      </div>
      </form>
    </div>
  </div>
</div>





{{-- MODAL INSERT --}}



<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">New event</button>

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
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Add envent</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>
</html>
