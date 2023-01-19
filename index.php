<?php
session_start();
require('connect.php');
?>
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
    <div class="container p-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <div class="card-title">
                                    Posts List
                                </div>
                            </div>
                            <div class="col-6">
                                <a href="post_create.php" class="btn btn-primary float-end">+ Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['successMsg'])) : ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <?php
                                echo $_SESSION['successMsg'];
                                unset($_SESSION['successMsg']);
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close">&times;</button>
                            </div>
                        <?php endif ?>

                        <table class="table table-bordered border shadow-sm">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>

                            <?php
                            $posts = mysqli_query($db, "SELECT * FROM posts");

                            foreach ($posts as $post) {
                            ?>
                                <tr>
                                    <td><?php echo $post['id']; ?></td>
                                    <td><?php echo $post['title']; ?></td>
                                    <td><?php echo $post['description']; ?></td>
                                    <td>
                                        <a href="post_edit.php?postId=<?php echo $post['id']; ?>">Edit</a> |
                                        <a onclick="return confirm('Are you sure you want to delete?')" href="index.php?post_id_to_delete=<?php echo $post['id']; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['post_id_to_delete'])) {
        $post_id_to_delete = $_GET['post_id_to_delete'];

        mysqli_query($db, "DELETE FROM posts WHERE id=$post_id_to_delete");
        $_SESSION['successMsg'] = 'A post deleted successfully';
        header('location:index.php');
    }
    ?>
</body>
<script src="./js/bootstrap.min.js"></script>

</html>