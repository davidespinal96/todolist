@extends('layouts.master')

@section('content')
  <form method="GET" action="{{ route('renderSearch') }}">
    <div class="input-field">
      <input name="search" type="text" autocomplete="off" placeholder="Buscar" id="search">
      <button type="submit" class="waves-effect waves-light btn">buscar</button>
    </div>
  </form>
  
  <table>
    <thead>
      <tr>
        <th>Task</th>
        @isAdmin
        <th>Assigned to</th>
        @endisAdmin
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tasks as $task)
      <tr>
        <td>
          <a href="{{ route('updateStatus',$task->id) }}">
            @if(!$task->status)
              {{ $task->content }}
            @else
              <strike class="grey-text">{{ $task->content }}</strike>
            @endif
          </a>
        </td>
        @isAdmin
        <td>{{ $task->user->name }}</td>
        @endisAdmin
        <td><a title="edit" href="{{ route('edit',$task->id) }}"><i class="small material-icons">edit</i></a></td>
        <td><a title="delete" onclick="return confirm('Delete?');" href="{{ route('delete',$task->id) }}"><i class="small material-icons">delete_forever</i></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $tasks->links('vendor.pagination.materialize') }}

  <form method="POST" action="{{ route('store') }}" class="col s12">
    <div class="row">
      <div class="input-field col s12">
        <input name="task" id="task" type="text" class="validate">
        <label for="task">New task</label>
      </div>
    </div>

    @include('partials.coworkers')

    <button type="submit" class="waves-effect waves-light btn">Add new task</button>
    @csrf
  </form>

  @isWorker
  <form action="" class="col s12">
    <div class="input-field">
        <select>
          <option value="" disabled selected>Send invitation to:</option>
          <option value="2">Buzz McCallister</option>
          <option value="3">Fuller McCallister</option>
          <option value="4">Harry Lime</option>
          <option value="5">Marv Merchants</option>
        </select>
        <label>Send invitation</label>
    </div>
    <a class="waves-effect waves-light btn">Send invitation</a>
  </form>
  @endisWorker

  @isAdmin
  <br><br><br>
  <ul class="collection with-header">
    <li class="collection-header"><h4>My coworkers</h4></li>
    <li class="collection-item"><div>Buzz McCallister<a href="#!" class="secondary-content">delete</a></div></li>
    <li class="collection-item"><div>Fuller McCallister<a href="#!" class="secondary-content">delete</a></div></li>
    <li class="collection-item"><div>Harry Lime<a href="#!" class="secondary-content">delete</a></div></li>
    <li class="collection-item"><div>Marv Merchants<a href="#!" class="secondary-content">delete</a></div></li>
  </ul>
  @endisAdmin
@endsection