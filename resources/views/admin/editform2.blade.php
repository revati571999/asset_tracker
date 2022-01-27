@extends('admin.master')
@section('content')

<div class="content-wrapper">
<div class="card m-auto" style="width: 18rem;">
  <div class="card-body">
  <form action="/home/editpost2/{{$category->id}}" method="post" enctype="multipart/form-data">
      @csrf()
  
      <div class="form-group">
    <label for="exampleInputEmail1">Asset Name </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{$category->name}}" >
    </div>
  <div class="form-group">
  <select class="form-control" id="category_id" name="type" >
       
       <option value=""> Asset type</option>
       
       @foreach($detail as $i)
        <option value="{{$i->id}}" {{($i->id == $category->detail_id)?'selected':''}}>{{$i->name}}</option>
        @endforeach
      
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Asset id </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="asset_id" value="{{$category->asset_id}}">
   
  </div>
  <div class="row form-group ">
      <div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status" value="1" {{($category->isactive == "1")?'checked':''}}>Active
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status" value="0" {{($category->isactive == "0")?'checked':''}}>Inactive
  </label>
</div>
  
  <label>Image </label>
          <input type="file" class="form-contol" name="file"/>
        
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

  </div>
</div>


</div>




@endsection