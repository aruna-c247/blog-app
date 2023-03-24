@extends('layouts/contentNavbarLayout')

@section('title', 'Blog List - Page')

@section('page-script')
<script src="{{asset('assets/js/ui-modals.js')}}"></script>
@endsection

@section('content')
@include('content/pages/flash-message')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Page /</span> Blog List
</h4>

<!-- Basic Bootstrap Table -->

<!-- Striped Rows -->
<div class="card">
  <!-- <h5 class="card-header">Blogs</h5> -->
  <div class="table-responsive text-nowrap">
    
    <a href="{{url('create-blog')}}" class="btn rounded-pill btn-outline-primary text-right m-2">Add New Blog</a>

    <table class="table table-striped">
      <thead>
        <tr>
          <!-- <th>#</th> -->
          <th>Title</th>
          <th>Category</th>
          <th>Feature Image</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @if (!empty($blogData))
          @foreach($blogData as $blog)
        <tr>
          <!-- <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{$blog->id}}</strong></td> -->
          <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{$blog->title}}</strong></td>
          <td>{{$blog->category->category_name}}</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up">
              @if(!empty($blog->feature_image))
                <img src="{{url('images/blog_feature_images/'.$blog->feature_image)}}" alt="Avatar" class="rounded-circle">
              @else
                <img class="rounded-circle" src="{{url('images/blog_feature_images/avatar.png')}}" />
              @endif
              </li>
              <!-- <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Christina Parker">
                <img src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar" class="rounded-circle">
              </li> -->

            </ul>
          </td>
          @if($blog->status == 1)
          <td><span class="badge bg-label-primary me-1">Active</span></td>
          @else
          <td><span class="badge bg-label-danger me-1">Deactive</span></td>
          @endif
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{url('edit-blog/'.$blog->slug)}}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<i class='bx bx-edit-alt me-1'></i> <span>Edit</span>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="#" data-slug="{{$blog->slug}}" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<i class='bx bx-trash me-1'></i> <span>Delete</span>"><i class="bx bx-trash me-1" data-bs-toggle="modal" data-bs-target="#backDropModal"></i> Delete</a> {{--data-bs-toggle="tooltip" {{url('delete/'.$blog->slug)}} --}}
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      
        @else
        <tr>
          <td colspan="10" style="text-align:center">No records here.</td>
        </tr>
        @endif

      </tbody>
    </table>
    {!! $blogData->links() !!}
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="backDropModalTitle">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col mb-3">
                      <label for="nameBackdrop" class="form-label">Name</label>
                      <input type="text" id="nameBackdrop" class="form-control" placeholder="Enter Name">
                    </div>
                  </div>
                  <div class="row g-2">
                    <div class="col mb-0">
                      <label for="emailBackdrop" class="form-label">Email</label>
                      <input type="text" id="emailBackdrop" class="form-control" placeholder="xxxx@xxx.xx">
                    </div>
                    <div class="col mb-0">
                      <label for="dobBackdrop" class="form-label">DOB</label>
                      <input type="text" id="dobBackdrop" class="form-control" placeholder="DD / MM / YY">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
<!--/ Striped Rows -->

@endsection
