<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);

    $perPage = $paginator->getPerPage();
?>

<?php if ($paginator->getLastPage() > 1): ?>
    <div class="col-lg-12 text-center">
        <ul class="pagination">
            <?php echo $presenter->render(); ?>
        </ul>
    </div>

	<div class="text-center">
	    <div class="btn-group">
	    	<?php

	    	$buttonClasses = 'btn btn-sm btn-default';

	    	$url = new \Purl\Url(Request::fullUrl());
	    	$url->query->set('page', null);

	    	foreach(array(5,25,50) as $int){
				$url->query->set('perPage', $int);

				$class = $buttonClasses;
				if($perPage == $int) $class .= ' active';

				echo HTML::link($url, $int, $attributes = array('class' => $class));
			} ?>
	    </div>
	</div>
<?php endif;
