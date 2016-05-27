<!DOCTYPE html>
<html>
    <head>
        <title>Stage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css" >
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" >
        <script src="js/jquery-1.11.2.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.add-product-area').click(function(){
                   $(this).slideUp();
                   setTimeout(fade, 500);
                });
                $('.delete-product-area').click(function(){
                   $('.add-display-container').slideUp();
                   setTimeout(fade1, 500);
                });
            });
            
            function fade()
            {
                $('.add-display-container').slideDown();
            }
            
            function fade1()
            {
                $('.add-product-area').slideDown();
            }
            
            
            </script>
    </head>
    <body >
        <nav class="navbar navbar-default" style="background-color: white">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">FASHEHOLIC</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <form class="navbar-form navbar-left hidden-xs" role="search" style="position: absolute;width:100%;text-align: center;margin-left: -30px;">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search Brands/Products" style="border-radius: 20px;padding:0px 100px;background-color: #F8F8F8">
        </div>
        
      </form>
        <form class="navbar-form navbar-left hidden-sm hidden-md hidden-lg" role="search" >
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search Brands/Products" style="border-radius: 20px;padding:0px 100px;background-color: #F8F8F8">
        </div>
        
      </form>
      <ul class="nav navbar-nav navbar-right">
       
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><span style="border: 1px solid;padding: 5px;border-radius: 5px">FILTER</span> </a>
          <ul class="dropdown-menu">
            <li><a href="#">Category1</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Category2</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Category3</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Category4</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Category5</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Category6</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">accessories</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU </a>
          <ul class="dropdown-menu" style="background-color: gray">
            <li class="bg-grey"><a href="#">PROFILE</a></li>
            <li role="separator" class="divider white-color-menu-line"></li>
            <li class="bg-grey"><a href="#">NOTICE</a></li>
            <li role="separator" class="divider white-color-menu-line"></li>
            <li class="bg-grey"><a href="#">LOGOUT</a></li>
            <li role="separator" class="divider white-color-menu-line"></li>
            <li class="bg-grey"><a href="#">CUSTOMER SERVICE</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>