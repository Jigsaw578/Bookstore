<div class="container-fluid fixed-top bg-light" >

            <nav class=" navbar narbar2  navbar-expand-lg">
                <a href="<?= URL ?>index.php/home">
                    <div class="logo">
                        <img src="<?php echo URL; ?>public/img/BS.jpg" alt="">
                    </div>
                </a>
                <button class="navbar-toggler menu" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars"></i>
                    </span>
                </button>
                <div id="my-nav" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto header-menu">
                    <div class="navbar narbar2 navbar-light bg-light">
                        <li class="nav-item "><div class="menubut">
                            <div class="menubut"><a class="nav-link menuitem" href="<?= URL ?>index.php/home">TRANG CHỦ <span class="sr-only">(current)</span></a></div>
                        </li>
                        <li class="nav-item">
                            <div class="menubut"><a class="nav-link menuitem" href="<?= URL ?>index.php/home/sale" tabindex="-1" aria-disabled="true">GIẢM GIÁ</a></div>
                        </li>
                        <li class="nav-item">
                            <div class="menubut"><a class="nav-link menuitem" href="<?= URL ?>index.php/home/newss" tabindex="-1" aria-disabled="true">TIN TỨC</a></div>
                        </li>
                    </div> 
                    </ul>
                    <div class="navbar narbar2 navbar-light bg-light">
                    <li class="nav-item dropdown cartli">
                    <?php
                    
                    if (isset($_SESSION['user'])){
                        ?>
                        <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button  type="button" class="btn btn-primary btn-lg btn-outline-primary"><div><i class="fas fa-user" style="font-size:24px;"></i> <?= $_SESSION['user'] ?> </div></button>    
                      </a>
                            
                            
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <ul>
                                    <?php 
                                        if ($_SESSION['role'] !=0 ){
                                            echo "<li class='list-group-item list-group-item-action'><a href='".URL."index.php/admin' class='dropdown-item'>Quản lý</a></li>";
                                        }
                                        ?>
                                        
                                        <li class="list-group-item list-group-item-action"><a class="dropdown-item" href="<?= URL ?>index.php/home/detailsUser">Chi tiết</a></li>
                                        
                                        <li class="list-group-item list-group-item-action"><a class="dropdown-item" href="<?= URL ?>index.php/home/logout">Đăng xuất</a></li>
                                        
                                    </ul>
                              </div>
                            </div>
                            
                        <!-- echo $_SESSION['user']; -->
                    <?php
                    }
                    else{

                   
                    ?>
                        <a href="<?= URL ?>index.php/home/login" class="mr-2">
                            <button  type="button" class="btn btn-primary btn-lg btn-outline-primary">Đăng nhập</button>
                        </a>
                        <a href="<?= URL ?>index.php/home/register" class="mr-2">
                            <button  type="button" class="btn btn-primary btn-lg btn-outline-primary">Đăng ký</button>
                        </a>
                       <?php 
                        }
                       ?>
                </li>
                    <div class="navbar  narbar2 navbar-light bg-light">
                        <a href="<?= URL ?>index.php/home/cartview" class="btn btn-primary btn-lg btn-outline-primary"><i class="fas fa-shopping-cart"></i></a>
                    </div>
                    <div class="navbar  narbar2 navbar-light bg-light">
                        <form action="<?= URL ?>index.php/home/search" method="post" class="form-inline">
                            <input type="text" name="search" class="form-control mr-sm-2" >
                            <button type="submit" class="btn btn-outline-success my-2 my-sm-0">
                                <i class="fas fa-search" style="font-size:30px;"></i>
                            </button>
                        </form>
                        
                    </div>
                </div>
            </div>
            </nav>
        </div>