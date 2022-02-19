@extends('backend.layout.app')
@section('title','All User')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <style>
      .fa-star{
          cursor:pointer;
      }
  </style>
@endpush
@section('main_menu','HOME')
@section('active_menu','All user')
@section('link',route('admin.adminDashboard'))
@section('content')

<?php
$balance = file_get_contents("http://api.greenweb.com.bd/g_api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&balance");

$rate = file_get_contents("http://api.greenweb.com.bd/g_api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&rate");

$sms = file_get_contents("https://technotrack.com.bd/sms_count.php");

$expiry = file_get_contents("http://api.greenweb.com.bd/g_api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&expiry");
?>

<div class="card">
            <div class="card-header">
              <h3 class="card-title">Total User: <span class="badge badge-secondary">{{$user->count()}}</span> SMS Left: <span class="badge badge-secondary"><?=$sms;?></span> Expiry Date: <span class="badge badge-secondary"><?=$expiry;?></span></h3>
              <a href="#" type="button" data-toggle="modal" data-target="#sms_to_all" class="btn-sm btn-primary float-right" style="margin-left: 10px">Send SMS to All</a>
               @if(\Request::is('admin/due_user'))
                   <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Send SMS
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('admin.send_sms_to_due_user')}}">SMS to Due users</a>
                        <a class="dropdown-item" href="{{route('admin.sms_first_reminder')}}">First reminder SMS</a>
                        {{-- <a class="dropdown-item" href="{{route('admin.over_due_sms')}}">OverDue SMS</a>
                        <a class="dropdown-item" href="#">SMS to All</a> --}}
                      </div>
                    </div>
                  @else
                    <a href="{{route('admin.all_user.create')}}" type="button" class="btn-sm btn-success float-right">Add User</a>
                 @endif
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Ref Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  {{--<th>Action</th>--}}
                  <th>Customer Level</th>
                  <th>Car Number</th>
                  <th>Monthly Bill</th>
                  <th>Assigned technician</th>
                  <th>Note</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

@foreach($user as $key=>$user_data)

                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$user_data->id}}</td>
                  <td><a href="{{route('admin.all_user.show',$user_data->id)}}">{{$user_data->name}}</a></td>
                  <td>{{$user_data->phone}}</td>
                  {{--<td><a class="btn btn-danger" href="{{route('admin.make_it_due', $user_data->id)}}">Update Due</a> - Due Date - {{$user_data->due_date}}</td>--}}
                  <td>
                      <p>
                        @switch ($user_data->customer_level)
                            @case(1)
                                <i id="1" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="2" user="{{$user_data->id}}" class="fas fa-star"></i>
                                <i id="3" user="{{$user_data->id}}" class="fas fa-star"></i>
                                <i id="4" user="{{$user_data->id}}" class="fas fa-star"></i>
                                <i id="5" user="{{$user_data->id}}" class="fas fa-star"></i>
                                @break
                            @case(2)
                                <i id="1" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="2" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="3" user="{{$user_data->id}}" class="fas fa-star"></i>
                                <i id="4" user="{{$user_data->id}}" class="fas fa-star"></i>
                                <i id="5" user="{{$user_data->id}}" class="fas fa-star"></i>
                                @break
                            @case(3)
                                <i id="1" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="2" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="3" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="4" user="{{$user_data->id}}" class="fas fa-star"></i>
                                <i id="5" user="{{$user_data->id}}" class="fas fa-star"></i>
                                @break
                            @case(4)
                                <i id="1" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="2" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="3" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="4" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="5" user="{{$user_data->id}}" class="fas fa-star "></i>
                                @break
                            @case(5)
                                <i id="1" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="2" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="3" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="4" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                <i id="5" user="{{$user_data->id}}" class="fas fa-star text-primary"></i>
                                @break
                            @default
                                <i id="1" user="{{$user_data->id}}" class="fas fa-star"></i>
                                <i id="2" user="{{$user_data->id}}" class="fas fa-star"></i>
                                <i id="3" user="{{$user_data->id}}" class="fas fa-star"></i>
                                <i id="4" user="{{$user_data->id}}" class="fas fa-star"></i>
                                <i id="5" user="{{$user_data->id}}" class="fas fa-star"></i>
                        @endswitch
                      </p>
                  </td>
                  <td>
                @php($vehicles = \App\vehicle_details::where('all_user_id',$user_data->id)->where('status',1)->get())
                        @foreach($vehicles as $data)
                            <span>{{$data->vehicle_registration}}<br></span>
                        @endforeach
                  </td>
                  <td>{{$user_data->monthly_bill}}</td>

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
                    {{str_limit($user_data->note,30)}}
                  </td>

                  <td>
                      
                      @if($user_data->payment_status == 1)
                        <span class="right badge badge-success">Paid</span>
                        {{--<p>{{date("F-Y", strtotime($payment->month_name))}}</p>--}}
                      @else
                        <span class="right badge badge-danger">UnPaid</span>
                        {{--<p>{{date("F-Y", strtotime($payment->month_name))}}</p>--}}
                      @endif
                  </td>
                  <td>
                      @if($user_data->service_problem_status ==1)
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


                       @if(\App\Assign_technician_device::where('user_id',$user_data->id)->where('status',0)->exists())
                            <a class="btn btn-secondary btn-sm" href="#" style="background: #5BBC2E;width: 103px">
                              <i class="fas fa-tag">
                              </i>
                              Assigned
                          </a>
                         @else

                        <a class="btn btn-secondary btn-sm" href="" data-toggle="modal" data-target="#assign_technician" onclick="user_id({{$user_data->id}})" >
                              <i class="fas fa-assistive-listening-systems">
                              </i>
                              Assign Tech
                          </a>
                        @endif

                        <a class="btn btn-sm bg-primary" href="{{route('admin.update_repair',$user_data->id)}}">
                            <i class="fa fa-cogs"></i>
                            Service Repaired
                        </a>

                      @elseif($user_data->expair_status == 0)
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


                       @if(\App\Assign_technician_device::where('user_id',$user_data->id)->where('status',0)->exists())
                            <a class="btn btn-secondary btn-sm" href="#" style="background: #5BBC2E;width: 103px">
                              <i class="fas fa-tag">
                              </i>
                              Assigned
                          </a>
                         @else

                        <a class="btn btn-secondary btn-sm" href="" data-toggle="modal" data-target="#assign_technician" onclick="user_id({{$user_data->id}})" >
                              <i class="fas fa-assistive-listening-systems">
                              </i>
                              Assign Tech
                          </a>
                        @endif

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

                    <a class="btn btn-sm bg-pink" href="#"  onclick="send_sms({{$user_data->id}})">
                      <i class="fas fa-sms">
                      </i>
                      SEND SMS
                    </a>

                  <form id="sms_send-{{$user_data->id}}" action="{{route('admin.single_sms',$user_data->id)}}" method="get" style="display: none">
                    @csrf
                    @method('get')
                  </form>

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

                      @if(\App\Assign_technician_device::where('user_id',$user_data->id)->where('status',0)->exists())

                            <a class="btn btn-secondary btn-sm" href="#" style="background: #5BBC2E;width: 103px">
                              <i class="fas fa-tag">
                              </i>
                              Assigned
                          </a>
                         @else

                        <a class="btn btn-secondary btn-sm" href="" data-toggle="modal" data-target="#assign_technician" onclick="user_id({{$user_data->id}})" >
                              <i class="fas fa-assistive-listening-systems">
                              </i>
                              Assign Tech
                          </a>
                        @endif


                          @if($schedule = \App\Billing_shedule::where('user_id',$user_data->id)->exists())
                        <button type="button" id="mouse_hover" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Scheduled at:  {{date("jS  F Y", strtotime(\App\Billing_shedule::where('user_id',$user_data->id)->first()->date))}}, comment: {{\App\Billing_shedule::where('user_id',$user_data->id)->first()->note}}" style="background: #a72294;border: #a72294">Bill Scheduled
                        </button>

                        @else

                    @endif

                    <a class="btn btn-warning btn-sm" href="" data-toggle="modal" data-target="#bill_shedule" onclick="bill_user_id({{$user_data->id}})">
                      <i class="fas fa-money-bill">
                      </i>
                      Billing Schedule
                    </a>

                    <a class="btn btn-sm bg-pink" href="#"  onclick="send_sms({{$user_data->id}})">
                      <i class="fas fa-sms">
                      </i>
                      SEND SMS
                  </a>

                  <form id="sms_send-{{$user_data->id}}" action="{{route('admin.single_sms',$user_data->id)}}" method="get" style="display: none">
                    @csrf
                    @method('get')
                    </form>

                            <br>
                          Expired: <span class="right badge badge-danger">{{$user_data->updated_at->diffForHumans()}}</span>

                      @endif

                   </td>

                </tr>

@endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Ref Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  {{--<th>Action</th>--}}
                  <th>Customer Level</th>
                  <th>Car Number</th>
                  @if(\Request::is('admin/due_user'))
                  @php ($total = \App\AllUser::where('payment_status',0)->where('expair_status',0)->where('demo',0)->sum('monthly_bill'))
                  <th class="bg-primary">Collectable: {{$total}}</th>
                  @else
                  <th>Monthly Bill</th>
                  @endif
                  <th>Assigned technician</th>
                  <th>Note</th>
                  <th>Status</th>
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


<!-- Modal sms to all -->
<div class="modal fade" id="sms_to_all" tabindex="-1" role="dialog" aria-labelledby="smsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{route('admin.sms_to_all')}}" method="get">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="bill_sheduleLabel">SMS to all Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="modal-body">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Message</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="allSMS"></textarea>
            </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send</button>
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
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "scrollX":true,
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
}

    </script>


<script type="text/javascript">
  $(".fa-star").click(function(){
      var starid = $(this).attr('id');
      var userid = $(this).attr('user');
      
      if(userid){
          $.ajax({
              type:"GET",
              url:"{{url('admin/vip_user')}}/"+userid,
              data: 'star='+starid,
              success: function(){
                  location.reload();
              }
          });
      }
  });
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



<script type="text/javascript">
  function send_sms(id) {
      const swalWithBootstrapButtons = swal.mixin({
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: false,
      })
      swalWithBootstrapButtons({
          title: 'Are you sure To send payment Reminder SMS?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, Send Now!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
      }).then((result) => {
          if (result.value) {
              event.preventDefault();
              document.getElementById('sms_send-'+id).submit();
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

@endpush
