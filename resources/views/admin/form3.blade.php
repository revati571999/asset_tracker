<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->    
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

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
                // $("#example1").load(location.href + " #example1");
                window.location.reload();
              }
          })
        })
    })
</script>

  <style>
      .container{
          display: flex;
          justify-content: center;
      }
      .btnMargin{
          margin-left: 25%;;
      }
  </style>
</head>
<body>
    
@include('admin.includes.nav')
@include('admin.includes.sidebar')

<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}"></script>
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
@php
    function unique_code($limit)
     {
       return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
      }
     @endphp
 <input id="code" type="hidden" class="form-control " name="asset_id" value="@php echo unique_code(16); @endphp" readonly>  
    </div>
<!-- </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Asset id </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="asset_id" placeholder="Enter Asset name">
    @if($errors->has('asset_id'))
        <label class="alert alert-danger" >{{$errors->first('asset_id')}}</label>
        @endif
  </div> -->
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
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">Asset Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped ">
                  <thead>
                  <tr>
                  <th >Asset Name</th>
                   <th >Asset type</th>
                    <th >Status</th>

               <th>Image</th>

                <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  @foreach($category as $cat)
      <td>{{$cat->name}}</td>
      <td>{{$cat->type}}</td>
      @if($cat->isactive==1)
      <td class="btn btn-success">active</td>
      @else
      <td class="btn btn-danger">inactive</td>
      @endif
      <td><img src="{{asset('/uploads/'.$cat->image)}}" alt="" height="50" width="50"></td>
        <td>
          <a href="/home/showimage/{{$cat->id}}" class="btn btn-success">show image</a>
          <a href="/home/editform2/{{$cat->id}}" class="btn btn-success">Edit</a> 
        <a href="javascript:void(0)" cid="{{$cat->id}}" class="btn btn-danger delcat">Delete</a></td>
    </tr>
    @endforeach
                  </tbody>
                  
                </table>
                {{$category->links()}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
</div>
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
