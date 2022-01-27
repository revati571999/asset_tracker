@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      .w-5{
        display:none;
      }
    </style>
</head>
<body>

<div class="card" style="width: 18rem;">
  <div class="card-body">
  <form action="" method="post">
      @csrf()
  <div class="form-group">
    <label for="exampleInputEmail1">Asset Name </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Enter Asset name">
    @if($errors->has('name'))
        <label class="alert alert-danger" >{{$errors->first('name')}}</label>
        @endif
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Asset type </label>
   <option value=""></option>
    @if($errors->has('description'))
        <label class="alert alert-danger" >{{$errors->first('description')}}</label>
        @endif
  </div>
  <div class="form-group">
          <label>Image </label>
          <input type="file" class="form-contol" name="file"/>
          @if($errors->has('file'))
          <label class="alert alert-danger" > {{$errors->first('file')}} </label>
          @endif
      </div>
      

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

  </div>
</div>

<div class="container">
<table class="table border=1">
  <thead>
      <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    
    
  </tbody>
</table>
<span></span>
</div>
</body>
</html>

@endsection