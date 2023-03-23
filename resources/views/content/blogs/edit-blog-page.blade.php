@extends('layouts/contentNavbarLayout')

@section('title', ' Edit Blog - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Edit Blog</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form class="" action="{{url('update/'.$blogData['slug'])}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" name="title" value="{{ old('title', $blogData['title']) }}" placeholder="Food blogs"/>
              @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
              @endif
            </div>
          </div>
          <div class="row mb-3">
            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
              <select class="form-select" id="exampleFormControlSelect1" name="category" aria-label="Default select example">
                <option value="" selected>Open this select menu</option>
                @if (count($categoryData) > 0)
                    @foreach ($categoryData as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $blogData['category_id'] ? 'selected' : ''}}> {{$category->category_name}} </option>
                    @endforeach
                @endif
              </select>
              @if ($errors->has('category'))
                <span class="text-danger">{{ $errors->first('category') }}</span>
              @endif
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">Description</label>
            <div class="col-sm-10">
              <textarea id="basic-default-message" name="description" class="form-control" rows="3" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2">{{ old('description', $blogData['description']) }}</textarea>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Feature Image</label>
            <div class="col-sm-10">
                <div class="col-md-3 mb-2">
                    @if (!empty($blogData['feature_image']))
                        <img class="card-img" src="{{url('images/blog_feature_images/'.$blogData['feature_image'])}}">
                    @else
                        <img class="card-img" src="{{url('images/blog_feature_images/avatar.png')}}">
                    @endif
                </div>
                <input class="form-control" type="file" name="feature_image" id="formFile">
                @if ($errors->has('feature_image'))
                    <span class="text-danger">{{ $errors->first('feature_image') }}</span>
                @endif
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Status</label>
            <div class="col-sm-10">
           
              <div class="form-check form-check-inline mt-3">
                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ ($blogData['status']=="1")? "checked" : "" }}/>
                <label class="form-check-label" for="inlineRadio1">Enable</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" {{ ($blogData['status']=="0")? "checked" : "" }}/>
                <label class="form-check-label" for="inlineRadio2">Disable</label>
              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div> 
        </form>
      </div>
    </div>
  </div>
  
</div>
@endsection
