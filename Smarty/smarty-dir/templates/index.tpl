<?php
//$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';
//$page = "login";

?>

    <!--<?php// include '../inc/init.php'?>
    <?php// include ROOT_PATH . 'public/template-parts/header.tpl' ?>-->

<?php include 'header.tpl' ?>


    <div id="main" class="container" style="margin-top:100px;">
        <div class="row">
            <div class="col-9">
                <?php //include $tem .'.php' ?>
            </div><!-- perchè 12 colonne, gestissco lo spazio, i div sono trasparenti ma se vado a ispezionare lo trovo -->

            <?php include 'sidebar.tpl' ?>

        </div>
    </div>
<?php include 'footer.tpl' ?>
