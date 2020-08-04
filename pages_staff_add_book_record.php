<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();

     if(isset($_POST['add_book']))
    {
        if ( empty($_POST["b_title"]) || empty($_POST["b_isbn"]) || empty($_POST['b_author']) || empty($_POST['b_publisher']) || empty($_POST['b_count']) ) 
        {
            $err="Blank Values Not Accepted😬!";
        }
        else
        {     
                $b_title = $_POST['b_title'];
                $b_isbn = $_POST['b_isbn'];
                $b_author = $_POST['b_author'];
                $b_publisher =  $_POST['b_publisher'];
                $b_summary = $_POST['b_summary'];
                $cat_id  = $_GET['cat_id'];
                $cat_name = $_GET['cat_name'];
                $b_count = $_POST['b_count'];
                $b_price = $_POST['b_price'];
                
                //Insert Captured information to a database table
                $postQuery="INSERT INTO iBookStore_books (b_price, b_title, b_isbn, b_author, b_publisher, b_summary, cat_id, cat_name, b_count) VALUES (?,?,?,?,?,?,?,?,?)";
                $postStmt = $mysqli->prepare($postQuery);
                //bind paramaters
                $rc=$postStmt->bind_param('sssssssss', $b_price, $b_title, $b_isbn, $b_author, $b_publisher, $b_summary, $cat_id, $cat_name, $b_count);
                $postStmt->execute();
                //declare a varible which will be passed to alert function
                if($postStmt)
                {
                    $success = "Book Added" && header("refresh:1; url=pages_staff_add_book.php");
                }
                else 
                {
                    $err = "Please Try Again Or Try Later";
                } 
            }
        }
            
    require_once('partials/_head.php');
    require_once('partials/_codeGen.php');
?>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php require_once('partials/_staffNav.php');?>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="pages_staff_dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="pages_staff_add_book.php">Books Categories</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Add Books</span></li>
                            </ol>
                        </nav>
                    </div>
                </li>
            </ul>

        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php require_once('partials/_staffSideNav.php');?>
        <!--  END SIDEBAR  -->
        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class=" widget box box-shadow">
                            <div class="widget-header">                                
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Fill All Required Fields</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <form method="post" enctype="multipart/form-data" >
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Book Title</label>
                                            <input type="name" name="b_title" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Book Price(Ksh)</label>
                                            <input type="name" name="b_price" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">Book ISBN Number</label>
                                            <input type="text" name="b_isbn" value="<?php echo $alpha;?>-<?php echo $beta;?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Book Author</label>
                                            <input type="name" name="b_author" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">Book Publisher</label>
                                            <input type="text" name="b_publisher"  class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">Book Copies Available</label>
                                            <input type="text" name="b_count"  class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="inputCity">Book Summary | Description </label>
                                            <textarea type="text" rows="15" name="b_summary" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" name="add_book" class="btn btn-primary mt-3">Add Book</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once('partials/_footer.php');?>
        </div>
        <!--  END CONTENT PART  -->
    </div>
    <?php require_once('partials/_scripts.php');?>   
</body>

</html>