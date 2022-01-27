@extends('admin.master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".delcat").click(function(e){
          var cid=$(this).attr("cid");
          $.ajax({
              url:"{{url('home/deleteform2')}}",
              method:'delete',
              data:{_token:'{{csrf_token()}}',cid:cid},
              success:function(response){
                console.log(response)
                $("#mytable").load(location.href + " #mytable");
              }
          })
        })
    })
</script>

  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<style>
      .w-5{
        display:none;
      }
   </style>
<div class="content-wrapper">
<div class="card  m-auto " style="width: 18rem;">
  <div class="card-body">
  <form action="/home/postform2" method="post" enctype="multipart/form-data">
      @csrf()
  <div class="form-group">
    <label for="exampleInputEmail1">Asset Name </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Enter Asset name">
    @if($errors->has('name'))
        <label class="alert alert-danger" >{{$errors->first('name')}}</label>
        @endif
  </div>
  <div class="form-group">
  <select class="form-control" id="" name="type">
       
       <option value=""> Asset type</option>

      
       @foreach($detail as $i)
        <option value="{{$i->id}}" >{{$i->name}}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Asset id </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="asset_id" placeholder="Enter Asset name">
    @if($errors->has('asset_id'))
        <label class="alert alert-danger" >{{$errors->first('asset_id')}}</label>
        @endif
  </div>
  <div class=" form-group ">
      <h6> status</h6>
      
     
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status" value="1">Active
  </label>
      &nbsp;&nbsp;&nbsp;&nbsp;

  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status" value="0">Inactive
  </label>
    </div>
  
  <label>Image </label>
          <input type="file" class="form-contol" name="file"/>
          @if($errors->has('file'))
          <label class="alert alert-danger" > {{$errors->first('file')}} </label>
          @endif
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

  </div>
</div>

<div class="container">
<table id="example1 mytable" class="table table-bordered table-striped">
  <thead>
      <tr>
      <th scope="col">Asset Name</th>
      <th scope="col">Asset type</th>
      <th scope="col">Status</th>

      <th scope="col">Image</th>

      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
     @foreach($category as $cat)
      <td>{{$cat->name}}</td>
      <td>{{$cat->type}}</td>
      <td>{{$cat->isactive}}</td>
      <td><img src="{{asset('/uploads/'.$cat->image)}}" alt="" height="50" width="50"></td>
        <td><a href="/home/editform2/{{$cat->id}}" class="btn btn-success">Edit</a> 
        <a href="javascript:void(0)" cid="{{$cat->id}}" class="btn btn-danger delcat">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
<span>{{$category->links()}}</span>
</div>

</div>

@stop