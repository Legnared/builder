<div class="container-fluid">

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">

        <?php foreach($landings as $key => $value): ?>

        <div class="col my-3">

            <a href="/code/<?php echo $value->url_landing; ?>"><img src="/views/assets/img/placeholder-square.svg"
                    class="img-fluid rounded"></a>

            <div class="text-center mt-3">

                <h6 class="font-weight-light"><a
                        href="/code/<?php echo $value->url_landing; ?>"><?php echo $value->title_landing; ?>
                        <small><span data-feather="edit"></span></small></a></h6>

            </div>

        </div>

        <?php endforeach ?>



    </div>

</div>