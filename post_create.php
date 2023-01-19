<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>basic php crud</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>

    <?php
        require('connect.php');

        $titleError = '';
        $descError = '';
        $title = '';
        $desc = '';

        if(isset($_POST['create-post-button'])) {
            $title = $_POST['title'];
            $desc = $_POST['description'];

            if(empty($title)) {
                $titleError = 'The title field is required.';
            }
            if(empty($desc)) {
                $descError = 'The description field is required.';
            }
            if(!empty($title) && !empty($desc)) {
                mysqli_query($db, "INSERT INTO posts(title, description) VALUES('$title', '$desc')");
                $_SESSION['successMsg'] = 'A post created successfully';
                header('location: index.php');
            }
        }
    ?>

    <div class="container p-5">
        <div class="row">
            <div class="col-12">
                <form action="post_create.php" method="POST">
                    <div class="card">
                        <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                            <div class="card-title">
                                Posts Creation Form
                            </div>
                            </div>
                            <div class="col-6">
                                <a href="index.php" class="btn btn-secondary float-end"><< Back</a>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control my-2 <?php if(!empty($titleError)) : ?>is-invalid<?php endif ?>" placeholder="Enter Post Title..." value="<?php echo $title; ?>">
                                <span class="text-danger"><?php echo $titleError; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control my-2 <?php if(!empty($descError)) : ?>is-invalid<?php endif ?>" placeholder="Description ..."><?php echo $desc; ?></textarea>
                                <span class="text-danger"><?php echo $descError; ?></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="create-post-button" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="./js/bootstrap.min.js"></script>

</html>