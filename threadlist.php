<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- manual css style includes as ques id for min height -->
    <link rel="stylesheet" href="style/style.css">

    <title>iDiscuss Forum</title>
</head>

<body>
    <!-- connect to the database -->
    <?php include 'partial/_dbconnect.php';?>
    <!-- header included -->
    <?php include "partial\header.php";?>
    <?php
$id = $_GET['catid'];
$sql = "SELECT * FROM `category` WHERE category_id=$id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  $catname = $row['category_name'];
  $catdesc = $row['category_desc'];
}
?>
    <?php
            $showalert=false;
            
            if ($_SERVER['REQUEST_METHOD']=="POST") {
                $title=$_POST['title'];
                $desc=$_POST['desc'];
                $userid=$_POST['uid'];
                $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user`, `thread_created`) VALUES ('$title', '$desc', '$id', '$userid', current_timestamp())";
                $result=mysqli_query($conn,$sql);
                $showalert=true;
                if ($showalert) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Thread has been added. Please wait while for community to respond...!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                }
            }
            


?>



    <!-- container of categories -->
    <div class="container my-4">
        <!-- thread list jumbotron -->
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forum Threads.</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>


        <!-- ask a question container -->
        <?php
        if (isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true) {
            echo '<div class="container">
                <h2 class="text-center py-2">Ask a Questions</h2>
                <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                    <div class="form-group">
                        <label for="th_title">Thread Title</label>
                        <input type="text" class="form-control" id="th_title" name="title" aria-describedby="th_title">
                        <small id="th_title" class="form-text text-muted">Keep Title as short & crisp as possible.</small>
                    </div>
                    <input type="hidden" name="uid" value="'.$_SESSION['uid'].'">
                    <div class="form-group">
                        <label for="th_desc">Ellaborate your Queries</label>
                        <textarea class="form-control" id="th_desc" name="desc" rows="3"></textarea>
                    </div>


                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
                </div>';
        }
        else {
            echo '<div class="container">
                    <h2 class="text-center py-2">Ask a Questions</h2>
                    <p class="lead">You are not logged in. Log in to be able to ask question.</p>
                </div>';
        }
          

       ?>



        <!-- user question answer (media heading)-->
        <div class="container">
            <h2 class="text-center py-2">Browse Questions</h2>
            <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result = mysqli_query($conn, $sql);
            $noresult = true;
            while ($row = mysqli_fetch_assoc($result)) {
              $noresult = false;
              $id = $row['thread_id'];
              $title = $row['thread_title'];
              $desc = $row['thread_desc'];
              $thread_uid=$row['thread_user'];
              $sql2="SELECT user_email FROM `users` WHERE user_id=$thread_uid";
              $result2=mysqli_query($conn,$sql2);
              $row2=mysqli_fetch_assoc($result2);
              echo '<div class="media my-4">
                            <img src="img/user.png" width="64px" height="64px" class="mr-3" alt="user_img">
                            <div class="media-body">
                            
                                <h5 class="mt-0 my-0"><a class="text-dark" href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                                
                                ' . $desc . '
                            </div><p class="font-weight-bold my-0"> Asked by: '.$row2['user_email'].' at '.$row['thread_created'].'</p>
                        </div>';
            }
            if ($noresult) {
              echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <p class="display-4">No Questions are found.</p>
                  <p class="lead">Be a first Person to put your Question here.</p>
                </div>
              </div>';
            }
            ?>
        </div>

    </div>










    <?php include "partial/footer.php";?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>