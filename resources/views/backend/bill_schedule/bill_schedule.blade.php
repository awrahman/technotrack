@extends('backend.layout.app')
@section('title','Bill Schedule')
@push('css')
          <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">

          <style>
    .event-log {
      font-family: consolas, Monaco, monospace;
      margin: 10px 5px;
      line-height: 2;
      border: 1px solid #4c4c4c;
      height: auto;
      width: 90%;
      padding: 2px 6px;
      color: #4c4c4c;
      white-space: pre;
    }
  </style>
@endpush
@section('main_menu','HOME')
@section('active_menu','Bill Schedule')
@section('link',route('admin.adminDashboard'))
@section('content')


    <div class="row mb-3">
        <div class="col-md-1">
{{--            <button class="btn btn-info btn-block" onclick="calendar()">Select Date</button>--}}
            <span>Select A Date:</span>
        </div>
        <div class="col-md-4">
            <form action="{{route('admin.calendar_search')}}" method="post">
               @csrf
                <div class="row">
                    <div class="col-md-4">
                    <input class="form-control form-control" type="date" id="date" value="" name="date">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success btn-block" type="submit" style="background: #483290;border: #483290">Search</button>
                    </div>
                </div>
           </form>

    </div>
    </div>

<div class="card">
            <div class="card-header">
              <h3 class="card-title">Showing Date Of : <span class="badge badge-success">
                      @if($formate_date == 'null')
                      All date
                          @else
                          {{date("jS  F Y ", strtotime($formate_date))}}
                        @endif
                  </span></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Car Number</th>
                  <th>Monthly Bill</th>
                  <th>Total Due</th>
                  <th>Assigned technician</th>
                  <th>Status</th>
                  <th>Note</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @if(count($schedule) > 0)


@foreach($schedule as $key=>$data)

            @php($user_data = \App\AllUser::find($data->user_id))

                <tr>
                  <td>{{$user_data->id}}</td>
                  <td><a href="{{route('admin.all_user.show',$user_data->id)}}">{{$user_data->name}}</a></td>
                  <td>{{$user_data->phone}}</td>
                  <td>{{$user_data->car_number}}</td>
                  <td>{{$user_data->monthly_bill}}</td>
                  <td>X</td>

                  <td>
                      @php($assigen_technician = \App\Assign_technician_device::where('user_id',$user_data->id)->where('status',0)->get())

                      @if($assigen_technician->count() !== 0)
                          @foreach($assigen_technician as $assigen_technician_data)
                              <a href="{{route('admin.technician.show',$assigen_technician_data->technician_id)}}">{{\App\Technician::find($assigen_technician_data->technician_id)->name}}</a>
                              <span class="right badge badge-success">{{$assigen_technician_data->created_at->diffForHumans()}}</span><br>
                          @endforeach

                       @elseif($assigen_technician->count() ==  0)
                          No Technician Assigned
                       @endif
                  </td>

                  <td>
                      @if($user_data->payment_status == 1)
                        <span class="right badge badge-success">Paid</span>
                      @else
                        <span class="right badge badge-danger">UnPaid</span>
                      @endif
                  </td>
                    <td>{{$data->note}}</td>
                  <td>

                      @if($user_data->expair_status == 0)
                          <a class="btn btn-info btn-sm" href="{{route('admin.all_user.edit',$user_data->id)}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="#" onclick="expier_user({{$user_data->id}})">
                              <i class="fas fa-trash">
                              </i>
                              Expire
                          </a>

                      <form id="delete-form-{{$user_data->id}}" action="{{route('admin.user_delete',$user_data->id)}}" method="get" style="display: none">
                                                @csrf
                                                @method('get')

                        </form>


                      <a class="btn btn-secondary btn-sm" href="" data-toggle="modal" data-target="#assign_technician" onclick="user_id('{{$user_data->id}}','null')">
                              <i class="fas fa-assistive-listening-systems">
                              </i>
                              Assign Tech
                          </a>

                    @if($schedule = \App\Billing_shedule::where('user_id',$user_data->id)->exists())
                        <button type="button" id="mouse_hover" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Scheduled at:  {{date("jS  F Y", strtotime(\App\Billing_shedule::where('user_id',$user_data->id)->first()->date))}}, comment: {{\App\Billing_shedule::where('user_id',$user_data->id)->first()->note}}" style="background: #a72294;border: #a72294">Bill Scheduled
                        </button>

                        @else

                       <a class="btn btn-warning btn-sm" href="" data-toggle="modal" data-target="#bill_shedule" onclick="bill_user_id({{$user_data->id}})">
                              <i class="fas fa-money-bill">
                              </i>
                              Billing Schedule
                       </a>
                    @endif

                      @else
                          <button class="btn btn-danger btn-sm" disabled>
                              <i class="fas fa-trash">
                              </i>
                              Expire
                          </button>

                           <a class="btn btn-success btn-sm" href="#" onclick="active_user({{$user_data->id}})">
                              <i class="fas fa-trash">
                              </i>
                              Active
                          </a>

                          <form id="active-form-{{$user_data->id}}" action="{{route('admin.active_user',$user_data->id)}}" method="get" style="display: none">
                             @csrf
                             @method('get')
                        </form>

                          <a class="btn btn-secondary btn-sm" href="" data-toggle="modal" data-target="#assign_technician" onclick="user_id({{$user_data->id}})" >
                              <i class="fas fa-assistive-listening-systems">
                              </i>
                              Assign Tech
                          </a>

                          @if($schedule = \App\Billing_shedule::where('user_id',$user_data->id)->exists())
                        <button type="button" id="mouse_hover" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Scheduled at:  {{date("jS  F Y", strtotime(\App\Billing_shedule::where('user_id',$user_data->id)->first()->date))}}, comment: {{\App\Billing_shedule::where('user_id',$user_data->id)->first()->note}}" style="background: #a72294;border: #a72294">Bill Scheduled
                        </button>

                        @else

                       <a class="btn btn-warning btn-sm" href="" data-toggle="modal" data-target="#bill_shedule" onclick="bill_user_id({{$user_data->id}})">
                              <i class="fas fa-money-bill">
                              </i>
                              Billing Schedule
                       </a>
                    @endif

                            <br>
                          Expired: <span class="right badge badge-danger">{{$user_data->updated_at->diffForHumans()}}</span>

                      @endif

                   </td>

                </tr>

@endforeach


                @endif

                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Car Number</th>
                  <th>Monthly Bill</th>
                  <th>Total Due</th>
                  <th>Assigned technician</th>
                  <th>Status</th>
                  <th>Note</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->





    <!-- Modal -->
<div class="modal fade" id="assign_technician" tabindex="-1" role="dialog" aria-labelledby="assign_technicianLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{route('admin.technician_assign')}}" method="post">
        @CSRF
      <div class="modal-header">
        <h5 class="modal-title" id="assign_technicianLabel">Assign Technician</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" value="" id="hidden_user_id" name="user_id">
          <input type="hidden" value="" id="hidden_order_id" name="order_id">
            <div class="form-group">
                    <label for="exampleFormControlSelect1">Technician Name</label>
                    <select class="form-control" id="technican_data" name="technician_id" required>
                        <option selected disabled>Select Technician</option>
                        @foreach($technician as $technician_data)
                      <option value="{{$technician_data->id}}">{{$technician_data->name}}</option>
                            @endforeach
                    </select>
             </div>
          <div class="form-group">
                    <label for="exampleFormControlSelect1">Collect Amount</label>
                    <input type="number" class="form-control" id="Email" name="collect_amount">
             </div>
            <div class="checkbox">
              <label><input type="checkbox" value="0" onclick="hidetable()" name="for_repair"> Only For Repair</label>
            </div>
          <table class="table table-bordered" id="dynamic_field" >

          </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Assign</button>
      </div>

       </form>

    </div>
  </div>
</div>





<!-- Modal -->
<div class="modal fade" id="bill_shedule" tabindex="-1" role="dialog" aria-labelledby="bill_sheduleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{route('admin.bill_schedule')}}" method="post">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="bill_sheduleLabel">Billing Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" value="" id="billing_user_id" name="user_id">
          <div class="form-group">
            <label for="exampleInputPassword1">Comment</label>
            <input type="text" class="form-control" placeholder="Comment" name="note" required/>
          </div>


          <div class="form-group">
            <label for="exampleInputPassword1">Schedule date</label>
            <input id="date_picker" class="form-control" placeholder="Note" name="date" required autocomplete="off" data-date-format='yyyy-mm-dd'>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

        </form>
    </div>
  </div>
</div>


@endsection
@push('js')
    <!-- DataTables -->
<script src="{{asset('public/assets/backend/plugins/datatables/jquery.dataTables.js')}}"></script>
 <script src="{{asset('public/assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

    <script>
        var i=1;

      $('#add').click(function(){
           i++;
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><select class="form-control" id="exampleFormControlSelect1" name="device_id[]"> <option selected disabled>Select Device</option>@foreach($device as $device_data)<option value="{{$device_data->id}}">{{$device_data->device_model}}</option>@endforeach</select><td><input type="text" name="quantity[]" placeholder="Enter Quantity" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove</button></td></tr>');
      });


      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });



  function hidetable() {
  var x = document.getElementById("dynamic_field");
  if (x.style.display === "none") {
    x.style.display = "";
  } else {
    x.style.display = "none";
  }
}


function user_id(user_id,order_id) {

    document.getElementById('hidden_user_id').value = user_id;
    document.getElementById('hidden_order_id').value = order_id;
}



    </script>

    <script type="text/javascript">
        function expier_user(id) {
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })
            swalWithBootstrapButtons({
                title: 'Are you sure Want To Expire this user?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Expire it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>



    <script type="text/javascript">
        function active_user(id) {
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })
            swalWithBootstrapButtons({
                title: 'Are you sure Want To Active this user?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Active it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('active-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>

<script>
$('#date_picker').datepicker({
}).on('changeDate', function (ev) {

    $('.datepicker').hide();
});



function bill_user_id(user_id) {

    document.getElementById('billing_user_id').value = user_id;
}


  </script>

    <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>


      <script>
      function calendar(){
      let simplepicker = new SimplePicker({
      zIndex: 10
    });
           simplepicker.open();

    const $button = document.querySelector('button');
    const $eventLog = document.querySelector('.event-log');
    $button.addEventListener('click', (e) => {
      simplepicker.open();

    });

    // $eventLog.innerHTML += '\n\n';
    simplepicker.on('submit', (date, readableDate) => {
        var date= Date(readableDate);

        console.log(new Date(date).toDateString("dd-MM-yyyy"));
      document.getElementById('date').value = new Date(date).toDateString("dd-MM-yyyy");
    });

    simplepicker.on('close', (date) => {
      $eventLog.innerHTML += 'Picker Closed'  + '\n';
    });
      }

  </script>

    <script>
$('#technican_data').change(function(){
    var technician_id = $(this).val();
    if(technician_id){
        $.ajax({
           type:"GET",
           url:"{{url('admin/ajax_search_for_assign_tech')}}/"+technician_id,
           success:function(res){

            if(res){
                $("#dynamic_field").empty();
                $.each(res,function(key,value){
                    $("#dynamic_field").append('<tr class="dynamic-added"><td><select class="form-control" id="exampleFormControlSelect1" name="device_id[]"><option value="'+value.id+'" selected>'+value.model+'</option></select><td><input type="number" name="quantity[]" value="'+value.quantity+'" placeholder="Enter Quantity" class="form-control name_list" max="'+value.quantity+'" min="0"/></td></tr>');
                });

            }else{
               $("#dynamic_field").empty();
            }
           }
        });
    }else{
        $("#dynamic_field").empty();

    }
   });
</script>

@endpush
