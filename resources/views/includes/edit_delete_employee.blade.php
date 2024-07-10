<!-- Edit -->
<div class="modal fade" id="edit{{ $employee->name }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <h4 class="modal-title"><b><span class="employee_id">Edit Employee</span></b></h4>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('employees.update', $employee->name) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name</label>


                        <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}"
                            required>

                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Position</label>


                        <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}"
                            required>

                    </div>


                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>


                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $employee->email }}" >

                    </div>
                    <div class="form-group">
                        <label for="schedule" class="col-sm-3 control-label">Schedule</label>


                        <select class="form-control" id="schedule" name="schedule" required>

                            @foreach ($schedules as $schedule)
                                <option value="{{ $schedule->slug }}">{{ $schedule->slug }} -> from
                                    {{ $schedule->time_in }} to {{ $schedule->time_out }} </option>
                            @endforeach

                        </select>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i>
                    Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete{{ $employee->name }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="align-items: center">

              <h4 class="modal-title "><span class="employee_id">Delete Employee</span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('employees.destroy', $employee->name) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="text-center">
                        <h6>Are you sure you want to delete:</h6>
                        <h2 class="bold del_employee_name">{{$employee->name}}</h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Edit Employee
    $(document).on('submit', '#edit-form', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serialize();

        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(response) {
                // Handle success response
                // For example, show a success message or update the employee details on the page
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle error response
                // For example, show an error message or log the error
                console.log(xhr.responseText);
            }
        });
    });

    // Delete Employee
    $(document).on('submit', '#delete-form', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serialize();

        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(response) {
                // Handle success response
                // For example, show a success message or remove the deleted employee from the page
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle error response
                // For example, show an error message or log the error
                console.log(xhr.responseText);
            }
        });
    });
</script>
