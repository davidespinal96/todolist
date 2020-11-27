@extends('layouts.master')

@section('content')
  <form method="GET" action="{{ route('renderSearch') }}">
    <div class="input-field">
      <input name="search" type="text" autocomplete="off" placeholder="Search" id="search">
      <button type="submit" class="waves-effect waves-light btn">Search</button>
    </div>
  </form>
  
  <table>
    <thead>
      <tr>
        <th>Task</th>
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

    <button type="submit" class="waves-effect waves-light btn">Add new task</button>
    @csrf
  </form>
@endsection