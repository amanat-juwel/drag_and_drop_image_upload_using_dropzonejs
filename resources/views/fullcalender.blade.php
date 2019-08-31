@extends('layouts.template')

@section('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection

@section('template')

<div class="row">
    <div class="col-md-7 ">
        <section class="content">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">(+) Add Event</button>
                </div>
                <div class="panel-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </section>
    </div>
</div>


<!-- start event add modal -->
<div id="addModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Event</h4>
      </div>
      <div class="modal-body">
        Title:
        <br />
        <input type="text" class="form-control"  name="add_title" id="add_title">

        Start time (yyyy-mm-dd HH:mm:ss):
        <br />
        <input type="text" class="form-control" value="{{ date('Y-m-d H:i:s') }}" name="add_start_date" id="add_start_date">

        End time (yyyy-mm-dd HH:mm:ss):
        <br />
        <input type="text" class="form-control" value="{{ date('Y-m-d H:i:s') }}" name="add_end_date" id="add_end_date">

        Color:
        <br>
        <input type="text" class="form-control" value="#378006" name="add_color" id="add_color">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="button" class="btn btn-success" id="event_add" value="Save">
      </div>
    </div>

  </div>
</div>
<!-- end event add modal -->

<!-- start event edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Event</h4>
              </div>
            <div class="modal-body">
                <input type="hidden" id="event_id" value="" />
                <input type="hidden" id="appointment_id" value="" />
                Title:
                <br />
                <input type="text" class="form-control" id="title">

                Start time:
                <br />
                <input type="text" class="form-control" id="start_date">

                End time:
                <br />
                <input type="text" class="form-control" id="end_date">

                Color:
                <br />
                <input type="text" class="form-control" id="color">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="button" class="btn btn-warning" id="event_update" value="Save Changes">
                <input type="button" class="btn btn-danger" id="event_delete" value="Remove This Event">
            </div>
          
        </div>
    </div>
</div>
<!-- end event edit modal -->

@endsection

@section('script')
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // view events
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            //defaultView: 'agendaWeek',
            events : [
                @foreach($events as $data)
                {   
                    id: '{{ $data->id }}',
                    title : '{{ $data->title  }}',
              
                    start : '{{ $data->start_date }}',
                    @if ($data->end_date)
                            end: '{{ $data->end_date }}',
                    @endif
                    
                    color: '{{ $data->color }}',
                    
                },
                @endforeach
            ],

            eventClick: function(calEvent, jsEvent, view) {
                
                $('#event_id').val(calEvent._id);
                $('#appointment_id').val(calEvent.id);
                $('#title').val(calEvent.title);
                $('#start_date').val(moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss'));
                $('#end_date').val(moment(calEvent.end).format('YYYY-MM-DD HH:mm:ss'));
                $('#color').val(calEvent.color);
                $('#editModal').modal();
            }

        });

        // add events
        $('#event_add').click(function(e) {
            e.preventDefault();

            var formData = {
          
                title: $('#add_title').val(),
                start_date: $('#add_start_date').val(),
                end_date: $('#add_end_date').val(),
                color: $('#add_color').val(),

            };

            console.log(formData)

            var URL = "{{ url('/events') }}";

            $.ajax({
                type:'POST',
                url: URL,
                data : formData,
                success:function(result) {
                   
                    $('#addModal').modal('hide');
                    location.reload()
                },
                error: function (result) {
                    alert('error')
                }
            });
      
        });

        // update events
        $('#event_update').click(function(e) {
            e.preventDefault();

            var formData = {

                event_id: $('#event_id').val(),
                appointment_id: $('#appointment_id').val(),
                title: $('#title').val(),
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
                color: $('#color').val()

            };

            var URL = "{{ url('/events_ajax_update') }}";

            $.ajax({
                type:'POST',
                url: URL,
                data : formData,
                success:function(result) {
                    $('#calendar').fullCalendar('removeEvents', $('#event_id').val());

                    // $('#calendar').fullCalendar('renderEvent', {
                    //     title: result.events.title,
                        
                    //     start: result.events.start_date,
                    //     end: result.events.end_date
                    // }, true);

                    $('#editModal').modal('hide');

                    console.log(result);
                    location.reload()
                },
                error: function (result) {
                    alert('error')
                }
            });
      
        });

        // delete events
        $('#event_delete').click(function(e) {
            e.preventDefault();

            if (confirm("Are you sure?")) {
                var formData = {

                    event_id: $('#event_id').val(),
                };

                var URL = "{{ url('/events/delete') }}";

                $.ajax({
                    type:'POST',
                    url: URL,
                    data : formData,
                    success:function(result) {
                        
                        $('#editModal').modal('hide');
                        console.log(result);
                        location.reload()
                    },
                    error: function (result) {
                        alert('error')
                    }
                });
            }

            return false;
      
        });

    });
</script>
@endsection
