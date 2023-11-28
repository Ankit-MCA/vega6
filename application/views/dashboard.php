<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Welcome, <?php echo $this->session->userdata('name'); ?>!</h2>
        </div>
        <div class="card-body">
            <!-- Menu -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('auth/profile'); ?>">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('post/index'); ?>">Post crud</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('auth/search'); ?>">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
                </li>
            </ul>

            <!-- Profile Picture -->
            <p>Your Profile Picture:</p>
            <img src="<?php echo base_url('images/' . $this->session->userdata('picture')); ?>" alt="Profile Picture" class="img-thumbnail" style="width: 200px; height: 200px;">

            <!-- Dashboard content goes here... -->
            <p>Dashboard content goes here...</p>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
