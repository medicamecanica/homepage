<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
			  <?php $i=0; foreach($photos as $photo):?>  
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php print $i?>" class="<?php print $i==0?'active':'';$i++;?>"></li>
            <!--<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            -->
             <?php endforeach;?>
          </ol>
          <div class="carousel-inner" role="listbox">
			  
			<?php $i=0; foreach($photos as $photo):?>  
            <div class="carousel-item <?php print $i==0?'active':'';$i++;?>">
				<div style="overflow-y: hidden;background-color: gray; background-repeat: no-repeat; background-size: 900px 350px;">
					<img class="d-block img-fluid" style="object-fit: contain;  margin: 0 auto;" src="<?php print $photo['src']?>" alt="<?php print $photo['ref']?>">
				</div>
            </div>
              <?php endforeach;?>
            <!--<div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
            </div>
            -->
           
          </div>
         
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
