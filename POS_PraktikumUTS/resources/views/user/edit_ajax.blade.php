<div class="modal fade" id="editModal{{ $user->user_id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $user->user_id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $user->user_id }}">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-edit-{{ $user->user_id }}" action="{{ url('user/' . $user->user_id . '/update_ajax') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Username field with AdminLTE input group styling -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <small id="error-username" class="text-danger w-100"></small>
                    </div>
                    <!-- Name field with AdminLTE input group styling -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" placeholder="Name" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                        <small id="error-nama" class="text-danger w-100"></small>
                    </div>
                    <!-- Password field with AdminLTE input group styling -->
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password (leave blank to keep unchanged)">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <small id="error-password" class="text-danger w-100"></small>
                    </div>
                    <!-- Role dropdown with AdminLTE input group styling -->
                    <div class="input-group mb-3">
                        <select class="form-control" id="level_id" name="level_id" required>
                            <option value="" disabled>Select Role</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->level_id }}" {{ $user->level_id == $level->level_id ? 'selected' : '' }}>{{ $level->level_nama }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-layer-group"></span>
                            </div>
                        </div>
                        <small id="error-level_id" class="text-danger w-100"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        // Initialize jQuery validation for the edit form
        $("#form-edit-{{ $user->user_id }}").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 4,
                    maxlength: 20
                },
                nama: {
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },
                password: {
                    minlength: 5
                },
                level_id: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: "Please enter a username.",
                    minlength: "Username must be at least 4 characters.",
                    maxlength: "Username cannot exceed 20 characters."
                },
                nama: {
                    required: "Please enter a name.",
                    minlength: "Name must be at least 2 characters.",
                    maxlength: "Name cannot exceed 50 characters."
                },
                password: {
                    minlength: "Password must be at least 5 characters."
                },
                level_id: {
                    required: "Please select a role."
                }
            },
            submitHandler: function(form) {
                // Handle form submission via AJAX
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            // Show success message and close modal
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            }).then(function() {
                                $('#editModal{{ $user->user_id }}').modal('hide');
                                // Reload DataTables to reflect changes
                                $('#userTable').DataTable().ajax.reload();
                            });
                        } else {
                            // Clear previous errors
                            $('.text-danger').text('');
                            // Display new errors
                            $.each(response.errors, function(key, val) {
                                $('#error-' + key).text(val[0]);
                            });
                            // Show error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Failed to update user.'
                            });
                        }
                    },
                    error: function(xhr) {
                        // Handle unexpected errors
                        Swal.fire({
                            icon: 'error',
                            title: 'Unexpected Error',
                            text: 'Please try again later.'
                        });
                    }
                });
                return false; // Prevent default form submission
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                // Place error messages below the input group
                error.addClass('invalid-feedback');
                element.closest('.input-group').next('.text-danger').append(error);
            },
            highlight: function(element) {
                // Highlight invalid fields
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                // Remove highlight from valid fields
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>