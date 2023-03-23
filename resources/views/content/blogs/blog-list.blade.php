@extends('layouts/contentNavbarLayout')

@section('title', 'Blog List - Page')

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
                <img class="preview-image-before-upload" src="{{url('images/blog_feature_images/avatar.png')}}" />
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
                <a class="dropdown-item" href="{{url('delete/'.$blog->slug)}}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<i class='bx bx-trash me-1'></i> <span>Delete</span>"><i class="bx bx-trash me-1"></i> Delete</a>
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
<!--/ Striped Rows -->

@endsection
