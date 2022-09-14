<div class="sidebar">
        <h3 class="title">MENU</h3>
             <ul>
                <?php 
                    foreach($data["category"] as $value){
                        echo "<li><a href='".URL."/index.php/home/category/".$value["id"]."/1'>".$value["category_name"]."</a></li>";
                            }?>
            </ul>
</div>