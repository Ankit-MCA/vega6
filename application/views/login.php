<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>User Login</h2>
        </div>
        <div class="card-body">
     <?php
            if ($this->session->flashdata('success')) {
                echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';
            }
            if ($this->session->flashdata('error')) {
                echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>';
            }
            ?>


            <?php echo form_open('auth/login'); ?>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
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
// Display SweetAlert on successful or failed login
if ($this->session->flashdata('success')) {
    echo '<script>Swal.fire("Success", "'.$this->session->flashdata('success').'", "success")</script>';
}
if ($this->session->flashdata('error')) {
    echo '<script>Swal.fire("Error", "'.$this->session->flashdata('error').'", "error")</script>';
}
?>

</body>
</html>
