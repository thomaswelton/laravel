<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>

<?php if ($paginator->getLastPage() > 1): ?>
    <div class="col-lg-12 text-center">
        <ul class="pagination">
            <?php echo $presenter->render(); ?>
        </ul>
    </div>
<?php endif;
