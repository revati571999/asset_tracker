@extends('admin.master')
@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="content-wrapper">
<div class="card" style="width: 18rem;">
  <div class="card-body">
  <form action="/home/editpost/{{$detail->id}}" method="post">
      @csrf()
  <div class="form-group">
    <label for="exampleInputEmail1">Asset Name </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{$detail->name}}">
   
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Asset Description </label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="description" value="{{$detail->description}}">
   </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

  </div>
</div>
</div>


</body>
</html>

@endsection