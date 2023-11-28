<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
</head>
<body>

<div class="container mt-5">
<div class="mt-3">
    <a href="<?php echo base_url('auth/dashboard'); ?>" class="btn btn-primary">Back</a>
</div>
    <div class="card">
        <div class="card-header">
            <h2>User Profile</h2>
        </div>
        <div class="card-body">
            <?php echo validation_errors(); ?>

            <?php echo form_open_multipart('auth/update_profile'); ?>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->session->userdata('name'); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $this->session->userdata('email'); ?>" required>
            </div>
            <div class="form-group">
                <label for="picture">Profile Picture:</label>
                <input type="file" class="form-control-file" id="picture" name="picture">
                <img src="<?php echo base_url('images/' . $this->session->userdata('picture')); ?>" alt="Profile Picture" class="img-thumbnail" style="width: 100px; height: 100px;">
            </div>
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and SweetAlert JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>

<?php
// Display SweetAlert on successful or failed profile update
if ($this->session->flashdata('profile_success')) {
    echo '<script>Swal.fire("Success", "'.$this->session->flashdata('profile_success').'", "success")</script>';
}
if ($this->session->flashdata('profile_error')) {
    echo '<script>Swal.fire("Error", "'.$this->session->flashdata('profile_error').'", "error")</script>';
}
?>

</body>
</html>
