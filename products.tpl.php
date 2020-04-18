 <div class="row">
  <?php if(is_array($products)):?>
		<?php foreach($products as $p):?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <?php 
             
		 $html=$p->show_photos('product', $conf->product->multidir_output[$p->entity],0,1,null,null,null,null,null,null,null,1);
              $tmpphoto=  explode("\n",$html)[2];
             // var_dump($tmpphoto);
              // print $p->nbphoto;
               if($p->nbphoto>0)$tmpphoto=str_replace('photowithmargin','card-img-top',$tmpphoto);
               else $tmpphoto=$form->showphoto('product',$p,0,0,0,'card-img-top');
               print  $tmpphoto;

          ?>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#"><?php print $p->label?></a>
                </h4>
                <h5><?php print  price($p->price_ttc, 0, $langs, 0, 0, -1, $conf->currency)?></h5>
                <p class="card-text" style="text-overflow: ellipsis;-webkit-line-clamp: 5"><?php print $p->description?></p>
              </div>
              <div class="card-footer">
                <small class="text-muted"><?php print $p->stock_reel.' unidades'?></small>
              </div>
            </div>
          </div>
		<?php endforeach?>
    <?php else: ?>
  <?php endif?>
         
          

        </div>
        <!-- /.row -->
