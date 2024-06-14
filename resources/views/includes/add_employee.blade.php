<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            <h4 class="modal-title"><b>Add Employee</b></h4>
            <div class="modal-body">

                <div class="card-body text-left">

                    <form method="POST" action="{{ route('employees.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            {{--  <input type="text" class="form-control" placeholder="Enter Employee Name" id="name" name="name" required pattern="[^\s]+" onkeyup="this.value = this.value.replace(/\s/g, '-')" />  --}}
                            <select id="employeeSelect" name="name" class="form-select">
                                <!-- Options will be dynamically populated here -->
                            </select>

                        <div class="form-group">Position
                            <label for="position">Position</label>  
                            <input type="text" class="form-control" placeholder="Enter Employee Position" id="position" name="position" value="Jsons-team"  required pattern="[^\s]+" onkeyup="this.value = this.value.replace(/\s/g, '-')" />
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="" />
                        </div>
                        <div class="form-group">
                            <label for="schedule" class="col-sm-3 control-label">Schedule</label>
                            <select class="form-control" id="schedule" name="schedule" required>
                                
                                @foreach($schedules as $schedule)
                                    <option value="{{$schedule->slug}}">{{$schedule->slug}} -> from {{$schedule->time_in}} to {{$schedule->time_out}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5" data-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>



                </div>
            </div>


        </div>

    </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var responseEmployees;

        $.ajax({
            url: '{{ route('showEmployee') }}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                responseEmployees = response.employees;
                $('#employeeSelect').empty();
                $.each(responseEmployees, function(index, employee) {
                    var displayName = employee.name.replace(/\s+/g, '-'); // Replace spaces with hyphens
                    $('#employeeSelect').append('<option value="' + employee.id + '">' + displayName + '</option>');
                });
                $('#employeeSelect').trigger('change');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });

        $('#employeeSelect').change(function() {
            var selectedEmployeeId = $(this).val();
            var selectedEmployee = responseEmployees.find(function(employee) {
                return employee.id == selectedEmployeeId;
            });
            $('#email').val(selectedEmployee.email);
        });
    });
</script>