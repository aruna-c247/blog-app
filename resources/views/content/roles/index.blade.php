@extends('layouts/contentNavbarLayout')

@section('title', 'Role List - Page')

@section('page-script')
<!-- <script src="{{asset('assets/js/ui-modals.js')}}"></script> -->
@endsection

@section('content')
@include('content/pages/flash-message')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Page /</span> Role List
</h4>

<!-- Basic Bootstrap Table -->

<!-- Striped Rows -->
<div class="card">
  <!-- <h5 class="card-header">Blogs</h5> -->
  <div class="table-responsive text-nowrap">
    
    <a href="{{ route('roles.create') }}" class="btn rounded-pill btn-outline-primary text-right m-2">Create New Role</a>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @if (!empty($roles))
        @foreach ($roles as $key => $role)

        <tr>
          <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ ++$i }}</strong></td>
          <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $role->name }}</strong></td>
          <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                    @can('role-edit')
                    <a class="dropdown-item" href="{{ route('roles.edit',$role->id) }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<i class='bx bx-edit-alt me-1'></i> <span>Edit</span>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    @endcan 
                    @can('role-delete')
                    <a class="dropdown-item delete-role" href="{{ route('roles.destroy',  $role->id) }}" data-id="{{ $role->id }}" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<i class='bx bx-trash me-1'></i> <span>Delete</span>" data-bs-toggle="modal" data-bs-toggle="tooltip"><i class="bx bx-trash me-1"></i> Delete</a>
                    @endcan 
                </div>
            </div>
          </td>
        </tr>
        @php $i++; @endphp
        @endforeach
      
        @else
        <tr>
          <td colspan="10" style="text-align:center">No records here.</td>
        </tr>
        @endif

      </tbody>
    </table>
    {!! $roles->links() !!}
  </div>
</div>

<!-- Modal -->
{{--<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="{{route('roles.destroy')}}" method="POST">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Are you sure?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <p>Do you really want to delete these records? This process cannot be undone.</p>
          <input type="hidden" id="delete-role-id" name="delete_role_id"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
    </form>
  </div>
</div>--}}
<!--/ Striped Rows -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
// $(document).ready(function() {
//     $('.delete-role').click(function() {
//       event.preventDefault();
//       var deleteId = $(this).attr('data-id');
//       $('#delete-role-id').val(deleteId);
//     })
// });
</script>


@endsection
