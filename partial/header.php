<?php
session_start();
echo '<nav class="nav navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/forum/index.php">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact Us</a>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">
      Top Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
      $sql="SELECT * FROM `category`";
      $result=mysqli_query($conn,$sql);
      while ($row=mysqli_fetch_assoc($result)) {
        echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].' ">'.$row['category_name'].'</a>';
        
      }
      
      
      echo '</div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
      
    </ul>
    <div class="row mx-2">';
    
    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
      echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      <p class="text-light mx-2 my-0">Welcome '.$_SESSION['username'].'</p>
      </form>
      <a href="partial/_logout.php" class="btn btn-outline-primary ml-2">log out</a>';
    }
    else
    {
      echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>
      <button class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#login">log in</button>
      <button class="btn btn-outline-primary mx-2" data-toggle="modal" data-target="#signup">sign up</button>';
    }
      echo '  </div>
      </div>
    </nav>';
    
    include 'login.php';
    include 'signup.php';
if (isset($_GET['signupsuccess'])&&$_GET['signupsuccess']==true) {
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can now log in.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>