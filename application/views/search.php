<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
<div class="mt-3">
    <a href="<?php echo base_url('auth/dashboard'); ?>" class="btn btn-primary">Back</a>
</div>
<h2>Search for Images and Videos</h2>


     <?php echo form_open('Auth/search_images', 'id="imagesForm"'); ?>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search for images" name="search_query1">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search Images</button>
        </div>
    </div>
    <?php echo form_close(); ?>

    <?php echo form_open('Auth/search_media', 'id="videosForm"'); ?>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search for videos" name="search_query">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search Videos</button>
        </div>
    </div>
    <?php echo form_close(); ?>

    <ul class="nav nav-tabs" id="mediaTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="true">Images</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="videos-tab" data-toggle="tab" href="#videos" role="tab" aria-controls="videos" aria-selected="false">Videos</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
    <div class="tab-pane fade show active" id="images" role="tabpanel" aria-labelledby="images-tab">
        <?php if (isset($images['hits'])): ?>
            <div class="row">
                <?php foreach ($images['hits'] as $image): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="<?php echo $image['webformatURL']; ?>" class="card-img-top" alt="Pixabay Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $image['tags']; ?></h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
        <?php if (isset($videos['hits'])): ?>
            <div class="row">
                <?php foreach ($videos['hits'] as $video): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <!-- Display video preview -->
                            <video width="100%" height="auto" controls>
                                <source src="<?php echo $video['videos']['medium']['url']; ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $video['tags']; ?></h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>


    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
