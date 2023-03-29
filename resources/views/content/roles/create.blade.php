@extends('layouts/contentNavbarLayout')

@section('title', ' Create New Role - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Create New Role</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form class="" action="{{route('roles.store')}}" method="post">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" name="name" value="{{ old('name') }}" placeholder="User"/>
              @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
              @endif
            </div>
          </div>
          <div class="row mb-3">
            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Permission</label>
            <div class="col-sm-10">
              <select class="form-select" id="exampleFormControlSelect1" name="permission" aria-label="Default select example">
                <option value="" selected>Open this select menu</option>
                @if (count($permission) > 0)
                
                    @foreach($permission as $value)
                    
                    <option {{ old('permission') == $value->id ? 'selected="selected"' : '' }} value="{{$value->id }}">{{$value->name}}</option>
                  @endforeach
                @endif
              </select>
              @if ($errors->has('permission'))
                <span class="text-danger">{{ $errors->first('permission') }}</span>
              @endif
            </div>
          </div>
          
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div> 
        </form>
      </div>
    </div>
  </div>
  
</div>
@endsection
