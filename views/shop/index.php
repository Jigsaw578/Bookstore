
<!DOCTYPE html>
<html>

<head>
    <title>BookStore</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo URL; ?>public/backend/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/public/css/style-1.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/public/css/style-user.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400500600&display=swap" rel="stylesheet">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0"></script>
    <script>
        $('.carousel').carousel({
            interval: 200

        })
    </script>
    <script>

        function actionChange(a,i){

        var r = confirm(a);
        if (r == true) {
            window.location.href= i;
        }
        }
        function notification() {
            alert("Thêm vào giỏ hàng thành công");
        }
    </script>
    
</head>

<body>
    <!-- --header-- -->
    <?php $this->view("shop/modules/header"); ?>
    <!-- ---- -->

    <!-- --body-- -->
    <!-- --banner-- -->
    <div class="banner">

    <?php $this->view("shop/modules/banner"); ?>


    </div>
    <!-- ---- -->
    <!-- --product-- -->
    <div class="container-fluid mt-5 mb-5">
        <div class="container product">
        <?php $this->view($data['page'],$data); ?>
        </div>
    </div>
    <!-- ---- -->
    <!-- --footer-- -->
<?php $this->view("shop/modules/footer"); ?>
    
    <!-- ---- -->
</body>
<script src="<?= URL?>/public/js/control.js"></script>
</html>