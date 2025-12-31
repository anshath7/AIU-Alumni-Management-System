<?php 
include 'admin/db_connect.php'; 
?>
<style>
    .masthead {
        min-height: 23vh !important;
        height: 23vh !important;
    }
    .masthead:before {
        min-height: 23vh !important;
        height: 23vh !important;
    }
    img#cimg {
        max-height: 10vh;
        max-width: 6vw;
    }
</style>

<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Manage Account</h3>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>

<div class="container mt-3 pt-2">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="update_account">
                        <!-- Personal Information -->
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="lastname" class="control-label">Last Name</label>
                                <input type="text" class="form-control" name="lastname" 
                                    value="<?php echo isset($_SESSION['bio']['lastname']) ? $_SESSION['bio']['lastname'] : '' ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="firstname" class="control-label">First Name</label>
                                <input type="text" class="form-control" name="firstname" 
                                    value="<?php echo isset($_SESSION['bio']['firstname']) ? $_SESSION['bio']['firstname'] : '' ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="middlename" class="control-label">Middle Name</label>
                                <input type="text" class="form-control" name="middlename" 
                                    value="<?php echo isset($_SESSION['bio']['middlename']) ? $_SESSION['bio']['middlename'] : '' ?>">
                            </div>
                        </div>
                        
                        <!-- Gender and Batch Information -->
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="gender" class="control-label">Gender</label>
                                <select class="custom-select" name="gender" required>
                                    <option <?php echo isset($_SESSION['bio']['gender']) && $_SESSION['bio']['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                    <option <?php echo isset($_SESSION['bio']['gender']) && $_SESSION['bio']['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="batch" class="control-label">Batch</label>
                                <input type="text" class="form-control datepickerY" name="batch" 
                                    value="<?php echo isset($_SESSION['bio']['batch']) ? $_SESSION['bio']['batch'] : '' ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="course_id" class="control-label">Course Graduated</label>
                                <select class="custom-select select2" name="course_id" required>
                                    <option></option>
                                    <?php 
                                    $course = $conn->query("SELECT * FROM courses ORDER BY course ASC");
                                    while($row = $course->fetch_assoc()): ?>
                                        <option value="<?php echo $row['id'] ?>" 
                                            <?php echo isset($_SESSION['bio']['course_id']) && $_SESSION['bio']['course_id'] == $row['id'] ? 'selected' : '' ?>>
                                            <?php echo $row['course'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Additional Information -->
                        <div class="row form-group">
                            <div class="col-md-5">
                                <label for="connected_to" class="control-label">Currently Connected To</label>
                                <textarea name="connected_to" id="connected_to" cols="30" rows="3" class="form-control"><?php echo isset($_SESSION['bio']['connected_to']) ? $_SESSION['bio']['connected_to'] : '' ?></textarea>
                            </div>
                            <div class="col-md-5">
                                <label for="img" class="control-label">Image</label>
                                <input type="file" class="form-control" name="img" onchange="displayImg(this, $(this))">
                                <img src="admin/assets/uploads/<?php echo isset($_SESSION['bio']['avatar']) ? $_SESSION['bio']['avatar'] : 'default.png' ?>" alt="Avatar" id="cimg">
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="row">
                            <div class="col-md-4">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" class="form-control" name="email" 
                                    value="<?php echo isset($_SESSION['bio']['email']) ? $_SESSION['bio']['email'] : '' ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" name="password">
                                <small><i>Leave this blank if you don't want to change your password</i></small>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <hr class="divider">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary">Update Account</button>
                            </div>
                        </div>
                        
                        <!-- Error/Success Message -->
                        <div id="msg"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize datepicker
    $('.datepickerY').datepicker({
        format: " yyyy",
        viewMode: "years",
        minViewMode: "years"
    });

    // Initialize select2
    $('.select2').select2({
        placeholder: "Please Select Here",
        width: "100%"
    });

    // Display image preview
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#cimg').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Form submission with AJAX
    $('#update_account').submit(function(e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'admin/ajax.php?action=update_account',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Account successfully updated.", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 700);
                } else {
                    $('#msg').html('<div class="alert alert-danger">Email already exists.</div>');
                    end_load();
                }
            }
        });
    });
</script>
