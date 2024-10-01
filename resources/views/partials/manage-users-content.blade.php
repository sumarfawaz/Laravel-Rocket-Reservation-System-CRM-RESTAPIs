<!-- Create, Update and Delete Customers -->

<button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createCustomerModal">Create New Customer</button>

<!-- Customer Table -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ePassport ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->epassportid }}</td>
            <td>{{ $customer->first_name }}</td>
            <td>{{ $customer->last_name }}</td>
            <td>{{ $customer->phone_number }}</td>
            <td>{{ $customer->email }}</td>
            <td>
                <!-- Edit button -->
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCustomerModal{{ $customer->id }}"
                    data-id="{{ $customer->id }}" 
                    data-epassportid="{{ $customer->epassportid }}"
                    data-firstname="{{ $customer->first_name }}"
                    data-lastname="{{ $customer->last_name }}"
                    data-phonenumber="{{ $customer->phone_number }}"
                    data-email="{{ $customer->email }}">
                    Edit
                </button>

                <!-- Delete button -->
                <form action="{{ route('customers.destroy', $customer->epassportid) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </td>
        </tr>

        <!-- Edit Customer Modal -->
        <div class="modal fade" id="editCustomerModal{{ $customer->id }}" tabindex="-1" aria-labelledby="editCustomerLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCustomerLabel">Edit Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editCustomerForm{{ $customer->id }}" action="{{ route('customers.update', $customer->epassportid) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="epassportid" class="form-label">ePassport ID</label>
                                <input type="text" class="form-control" name="epassportid" value="{{ $customer->epassportid }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{ $customer->first_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ $customer->last_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" value="{{ $customer->phone_number }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $customer->email }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </tbody>
</table>

<!-- Create Customer Modal -->
<div class="modal fade" id="createCustomerModal" tabindex="-1" aria-labelledby="createCustomerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCustomerLabel">Create New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="epassportid" class="form-label">ePassport ID</label>
                        <input type="text" class="form-control" name="epassportid">
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name">
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <button type="submit" class="btn btn-primary">Create Customer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to handle modal population -->
<script>
    $(document).ready(function () {
        // Listen for the modal open event
        $('.modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var customerId = button.data('id');
            var modal = $(this);

            // Populate fields with data attributes
            modal.find('input[name="epassportid"]').val(button.data('epassportid'));
            modal.find('input[name="first_name"]').val(button.data('firstname'));
            modal.find('input[name="last_name"]').val(button.data('lastname'));
            modal.find('input[name="phone_number"]').val(button.data('phonenumber'));
            modal.find('input[name="email"]').val(button.data('email'));
        });
    });
</script>
