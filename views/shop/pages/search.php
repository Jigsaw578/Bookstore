<div class="container2 text-center">
    <div class="h2 mb-5">Kết quả tìm kiếm</div>
    <div class="row" id="newsu">
        <div class="col-12 row">
            <?php
            if($data["search"]==NULL){
                echo" <h5>Không có kết quả tìm kiếm</h5>";
            }
            else{
            foreach ($data["search"] as $value) {
                echo "<div class='col-lg-3 col-md-6 col-sm-6 col-6 mt-3'>";
                echo "<div class='card product p-2' styte='width:auto'>";
                echo "<a href='".URL."index.php/home/details/".$value["id"]."'><img class='proo card-img-top' style='width: 100%; height: 400px;' src='".URL."public/img/" . $value["image"] . "' alt='" . $value["image"] . "'></a>";
                echo "<div class='card-title product-title text-center h5' ><a href='".URL."index.php/home/details/".$value["id"]."' class='proo'>" . $value["product_name"] . "</a></div>";
                // print_r($value['image']);
                if($value['sale']==1){
                    echo "<div class='price text-center h6' style='text-decoration-line:line-through'>" . number_format($value["price"], 0, '', ',') . " VNĐ</div>";
                    echo "<div class='price text-center h6'>" . number_format($value["price"]-($value["price"]*($value["saleprice"]/100)), 0, '', ',') . " VNĐ</div>";
                }else{
                    echo "<div class='price text-center h6'>" . number_format($value["price"], 0, '', ',') . " VNĐ</div>";
                }
                echo "<span class='text-center add-to-cart add-cart btn btn-outline-warning' onclick='tks()'>";
                echo "'<a onclick='notification();' href='".URL."index.php/home/addcart/".$value["id"]."'>";
                echo "<i class='fas fa-cart-plus'></i>";
                echo " </a>";
                echo " </span>";
                echo "</div>";
                echo " </div>";
            }}
            ?>
            
    </div>

</div>
