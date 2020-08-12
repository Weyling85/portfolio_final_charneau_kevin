<div class="container">
  <div class='row'>
    <div class='col-md-offset-2 col-md-8'>
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->
        <!--<ol class="carousel-indicators">
          <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#quote-carousel" data-slide-to="1"></li>
          <li data-target="#quote-carousel" data-slide-to="2"></li>
        </ol>-->
        
        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner">

          <!-- Quote 1 -->
          <?php 
          
          $i = 0;
          foreach ($recommandations as $recommandation) 
          {
            $active = "";
            if($i == 0)
            {
              $active = 'active';
            }
            ?>
            <div class="item <?=$active?>">
            <blockquote>
              <div class="row">
                <div class="col-sm-9">
                  <p><?=$recommandation['message']?></p><br />
                  <h4><?=$recommandation['first_name'].' '.$recommandation['last_name'].', '.$recommandation['enterprise']?></h4>
                  <?php $i++?>
                </div>
              </div>
            </blockquote>
          </div>
          <?php }
          ?>
        </div>
        <!-- Carousel Buttons Next/Prev -->
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
      </div>                          
    </div>
  </div>
</div>