<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
</head>
<body>

<div class="container mt-5">

                
<div class="mt-3">
    <a href="<?php echo base_url('auth/login'); ?>" class="btn btn-primary">Login</a>
</div>

<div class="card">
        <div class="card-header">
            <h2>User Registration</h2>
        </div>
        <div class="card-body">
            <?php echo validation_errors(); ?>

          
            <form method="post" action="<?php echo base_url('auth/register'); ?>" enctype="multipart/form-data" >
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name" required>
                <?php echo form_error('name',"<div style='color:red'>","</div>");?>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email id" required>
                <?php echo form_error('email',"<div style='color:red'>","</div>");?>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password" required>
                <?php echo form_error('password',"<div style='color:red'>","</div>");?>
            </div>
            <div class="form-group">
                <label for="password">Confirmpassword:</label>
                <input type="password" class="form-control" id="password" name="confirmpassword" required>
                <?php echo form_error('confirmpassword',"<div style='color:red'>","</div>");?>  
            </div>
            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" class="form-control-file" id="picture" name="picture">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
    <div class="text-center">Already have an account? <a href="<?php echo base_url('auth/login'); ?>">Login</a></div>
</div>

<!-- Include Bootstrap JS and SweetAlert JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>

<?php
// Display SweetAlert on successful or failed registration
if ($this->session->flashdata('success')) {
    echo '<script>Swal.fire("Success", "'.$this->session->flashdata('success').'", "success")</script>';
}
if ($this->session->flashdata('error')) {
    echo '<script>Swal.fire("Error", "'.$this->session->flashdata('error').'", "error")</script>';
}
?>

</body>
</html>
