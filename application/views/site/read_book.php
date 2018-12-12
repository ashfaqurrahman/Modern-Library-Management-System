<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-12 grid">
              <div class="border_gray grid_content content_grid clearfix">
                <h4 class="column-title in_center"><i class="fa fa-dot-circle-o blue"> </i> <span class="blue"><?php echo $this->lang->line("most read books"); ?></span></h4>                  
                <?php 
                $delay=0;
                if(count($read_book)==0) echo "<h4><div class='text-center alert alert-info'>No data found.</div></h4>";
                foreach($read_book as $row) 
                { ?>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-centered mythumbnail-container  wow fadeInDown animated">                                    
                        <div  data-wow-delay="0ms" data-wow-duration="400ms" class="before_flip wow zoomIn animated" style="visibility: visible; animation-duration: 400ms; animation-delay: <?php echo $delay;?>ms; animation-name: zoomIn;">
                            <div class="mythumbnail">                            
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="mythumbnail-title">
                                           <?php $title_formated = (strlen($row['title']) > 40) ? substr($row['title'],0,37).'...' : $row['title']; ?>
                                           <?php $author_formated = (strlen($row['author']) > 40) ? substr($row['author'],0,37).'...' : $row['author']; ?>
                                           <i class="fa fa-book"></i> <?php echo $title_formated; ?>
                                        </div>
                                        <br/>
                                       <img alt="<?php echo $row['title']; ?>" src="<?php echo base_url().'upload/cover_images/thumbnail_cover_images/'.$row['cover']; ?>" class="img-responsive border_gray" style="width:160px!important;height:210px!important;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="mythumbnail-title">
                                            <h5><i class="fa fa-user"></i> <?php echo $author_formated; ?></h5>
                                        </div>                                                                      
                                        <div class="mythumbnail-title">
                                           <?php echo $this->lang->line("total read"); ?> <?php echo $row['total_read']; ?> <?php echo $this->lang->line("times"); ?>
                                        </div>
                                    </div>
                                </div>                                    
                            </div>                          
                        </div>
                        <?php
                        $category_str="";
                        if(isset($row['category_id']) && $row['category_id']!='')
                        {
                          $category_ids=explode(',',$row['category_id']);
                          $category_names=array();
                          foreach ($category_ids as $val) 
                          {
                            if(isset($book_category[$val]))
								$category_names[]=$book_category[$val];
                          }
                          $category_str=implode(' / ',$category_names);
                        }                        
                        ?>  
                        <div class="flip_overlay" style="display:none">                      
                             <i class="fa fa-list-ol"></i>&nbsp; <b><?php echo $this->lang->line("book category"); ?> </b> &nbsp;<?php echo  $category_str; ?><br/>
                             <i class="fa fa-book"></i>&nbsp; <b><?php echo $this->lang->line("title"); ?> </b> &nbsp;<?php echo $row['title']; ?><br/>
                             <i class="fa fa-user"></i>&nbsp; <b><?php echo $this->lang->line("author"); ?> </b>&nbsp;<?php echo $row['author']; ?><br/>
                             <i class="fa fa-sort-numeric-asc"></i>&nbsp; <b><?php echo $this->lang->line("ISBN"); ?> </b> &nbsp;<?php echo $row['isbn']; ?><br/>
                             <i class="fa fa-folder-open"></i>&nbsp; <b><?php echo $this->lang->line("publisher"); ?> </b> &nbsp;<?php echo $row['publisher']; ?>
                             <?php if(isset($row['publication_year'])) echo "( ".$row['publication_year']." )"; ?><br/>
                              <i class="fa fa-pencil"></i>&nbsp; <b><?php echo $this->lang->line("edition"); ?> </b> &nbsp;<?php echo $row['edition']; ?>
                             <?php if(isset($row['publishing_year'])) echo "( ".$row['edition_year']." )"; ?>
                        </div>                      
                    </div>
                <?php 
                $delay+=200;
                } ?>
              </div>
            </div>
        </div>
    </div>      
  </div> <!-- end column middle area -->
</div> <!-- end container main content -->

