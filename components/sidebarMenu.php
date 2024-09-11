<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" >
    <div class="position-sticky pt-3" style="margin-top:10%;">
        <ul class="nav flex-column">
            <?php 
                foreach($_SESSION['arrModulos'] as $modulo){
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $modulo["url"];?>">
                    <span data-feather="shopping-cart"></span>
                    <?php echo $modulo["nombre"];?>
                    </a>
                </li> 
            <?php
                }
            ?>
            
        </ul>
    </div>
</nav>