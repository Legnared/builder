<?php

  $url = "landings?select=title_landing,url_landing";
  $method = "GET";
  $fields = array();

  $landings = CurlController::request($url, $method, $fields);
  // echo '<pr>'; print_r($landings); echo '</pr>';
  // return;

  if($landings->status == 200){

    $landings = $landings->results;

  } else {

    $landings = array();

  }

?>


<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start" id="sidebar-left">

    <div class="offcanvas-body">

        <ul class="list-group list-group-flush">
            <?php foreach ($landings as $key => $value): ?>

            <li class="list-group-item list-gropu-item-action py-3 ">
                <div class="d-flex w-100 align-items-center justify-content-between">

                    <strong class="mb-1"><?php echo $value->title_landing ?></strong>
                    <small><a href="/code/<?php echo $value->url_landing ?>"><span
                                data-feather="edit"></span></a></small>
                </div>

                <div class="col-10 mb-1 small">
                    <a href="/<?php echo $value->url_landing ?>"><?php echo $value->url_landing ?></a>
                </div>
            </li>

            <?php endforeach ?>
        </ul>
    </div>
</div>