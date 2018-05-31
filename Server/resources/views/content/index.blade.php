@extends('layouts.app')

@section('content')

<div class="container">
  <div onclick="createNewElement()" 
  style="position: absolute; top: 70px; right: 10px; background-color: rgba(0, 0, 0, 0.75); color: #fff; width: 100px; text-align: center; border-radius: 8px;">
    Add New
  </div>
@if (count($pages) > 0)
<div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Type</th>
          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
    @foreach($pages as $page)
        <tr id='page{{$page->id}}'>
          <th scope="row">{{$page->id}}</th>
          <td>{{$page->title}}</td>
          <td>{{$page->type}}</td>
          <td id='status{{$page->id}}' style="width: 94px;">
          @if ($page->status == 1)
            Active
          @else
            Disabled
          @endif
          </td>
          <td>
            <div class="btn-group" role="group">
              <a href="" class="btn btn-primary content-button">Edit</a>
              <button onclick="disableElement({{$page->id}}, this)"
                class="btn btn-secondary content-button">
                @if ($page->status == 1)
                  Disable
                @else
                  Enable
                @endif
              </button>
              <button onclick="deleteElement({{$page->id}})"
                class="btn btn-danger content-button">Delete</button>
            </div>
          </td>
        </tr>
	  @endforeach
      </tbody>
    </table>
 </div>
 @endif
 </div>
@endsection

@section('scripts')
<script type="text/javascript">
  function createNewElement() {
    $.ajax({
      type: 'POST',
      url: './content',
      data: {
        "_token":"{{ csrf_token() }}"
      },
      dataType: 'JSON',
      success: function(response){ 
        location.reload();
        //console.log(response);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        //console.log(textStatus + ' : ' + errorThrown);
      }
    });
  }
  function disableElement(id, element) {
    $.ajax({
      type: 'PUT',
      url: './content/disable/'+id,
      data: {
        "_token":"{{ csrf_token() }}",
        'id': id
      },
      dataType: 'JSON',
      success: function(response){ 
        if(element.innerHTML.replace(/\s+/g, '') == 'Disable') {
          element.innerHTML = 'Enable';
          document.getElementById('status'+id).innerHTML = 'Disabled';
        } else {
          element.innerHTML = 'Disable';
          document.getElementById('status'+id).innerHTML = 'Active';
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        //console.log(textStatus + ' : ' + errorThrown);
      }
    });
  }
  function deleteElement(id) {
    $.ajax({
      type: 'DELETE',
      url: './content/'+id,
      data: {
        "_token":"{{ csrf_token() }}",
        'id': id
      },
      dataType: 'JSON',
      success: function(response){ 
        document.getElementById('page'+id).remove();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        //console.log(textStatus + ' : ' + errorThrown);
      }
    });
  }
</script>
@endsection