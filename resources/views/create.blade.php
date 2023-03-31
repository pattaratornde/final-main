@extends('base')
 
@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add DATA</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('tas.store') }}">
          @csrf
          <div class="form-group">    
              <label for="ta_id">TA ID:*</label>
              <input type="text" class="form-control" name="ta_id"/>
          </div>
 
          <div class="form-group">
              <label for="student_id">Student ID:*</label>
              <input type="text" class="form-control" name="student_id"/>
          </div>
 
          <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name"/>
          </div>

          <div class="form-group">
              <label for="address">Address:</label>
              <input type="text" class="form-control" name="address"/>
          </div>

          <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email"/>
          </div>

          <div class="form-group">
              <label for="users_id">User ID:</label>
              <input type="text" class="form-control" name="users_id"/>
          </div>

          <button type="submit" class="btn btn-primary">Add Data</button>
      </form>
  </div>
</div>
</div>
@endsection
