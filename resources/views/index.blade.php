<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Content Header -->
<section class="content-header">
    <h1>
        DATABASE BACKUP
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
        <li class="active">Database Backup</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
           <div class="panel panel-primary">
              <div class="panel-heading">
               DB-BACKUP
               <a href="{{url('database-backup/create')}}" class="btn btn-default btn-xs pull-right"><i class="fa fa-database"></i> Export Database</a>
              </div>
              <div class="panel-body">
                <div class="">
                        <table class="table-bordered" id="purchase_details" width="100%">
                            <thead>
                                <tr>
                                    <th height="25">Srl</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($directories)) @foreach ($directories as $key=>$file)
                                <tr>
                                    <td height="25">{{ ++$key }}</td>
                                    <td>{{ $file }}</td>
                                    <td>
                                        @php 
                                            date_default_timezone_set('Asia/Dhaka');
                                            echo date("Y-m-d.", filectime('storage/app/public/'.$file));
                                         @endphp
                                    </td>
                                    <td>
                                        @php 
                                           date_default_timezone_set('Asia/Dhaka');
                                           echo date("H:i:s.", filectime('storage/app/public/'.$file));
                                         @endphp
                                    </td>
                                    <td>
                                        <div style="display:flex;">
                                       <a class="btn btn-success btn-xs" href="{{asset('storage/app/public/'.$file)}}" download=""><i class="fa fa-download"></i>
                                        Download </a>
                                       &nbsp;&nbsp;&nbsp;
                                        <form action="{{url('database-backup/delete')}}" method="post">
                                            {{ method_field('DELETE') }} {{ csrf_field() }}
                                            <input type="hidden" name="file" value="{{$file}}" />
                                            <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"  >
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
                                       
                                    </div>

                                    </td>
                                </tr>
                                @endforeach @endif
                            </tbody>
                        </table>
                    </div>

              </div>
            </div>
        </div>
    </div> 
</section>
