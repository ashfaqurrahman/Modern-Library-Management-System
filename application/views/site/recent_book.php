<style type="text/css">
  
/*
Bestsellers Badge
*/

.yith-wcbsl-badge-wrapper {
position : absolute;
top : -20px;
left : 20;
width : 120px;
height : 120px;
overflow : hidden;
}

.green {
  background : #50974F !important;
  color: white !important;
}
.yith-wcbsl-badge-content {
font-family : "Open Sans", Helvetica, sans-serif;
font-size : 16px;
height : 40px;
width : 200px;
background : #a00000;
color : #fff;
-webkit-transform : rotate(-45deg);
-ms-transform : rotate(-45deg);
transform : rotate(-45deg);
text-align : center;
line-height : 40px;
position : absolute;
/*top : 20px;*/
left : -60px;
box-shadow : 0px 1px 4px 0 rgba(0, 0, 0, 0.3);
font-weight : 800;
}

.yith-wcbsl-badge-wrapper.yith-wcbsl-mini-badge {
width : 80px;
height : 80px;
}

.yith-wcbsl-badge-wrapper.yith-wcbsl-mini-badge .yith-wcbsl-badge-content {
font-size : 12px;
height : 30px;
width : 130px;
line-height : 30px;
top : 13px;
left : -36px;
}
</style>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-12 grid">
              <div class="border_gray grid_content content_grid clearfix">
                <h4 class="column-title in_center"><i class="fa fa-dot-circle-o blue"> </i> <span class="blue"><?php echo $this->lang->line("most recent books"); ?></span></h4>                  
                <?php 
                $delay=0;
                if(count($recent_book)==0) echo "<h4><div class='text-center alert alert-info'>".$this->lang->line("no data found")."</div></h4>";
                foreach($recent_book as $row) 
                { ?>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-centered mythumbnail-container  wow fadeInDown animated">                                    
                        <div  data-wow-delay="0ms" data-wow-duration="400ms" class="before_flip wow zoomIn animated" style="visibility: visible; animation-duration: 400ms; animation-delay: <?php echo $delay;?>ms; animation-name: zoomIn;">
                            <div class="mythumbnail border_gray">                            
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="mythumbnail-title">
                                           <?php //if($this->config->item("language")!="arabic") echo "<br/><br/><br/>";?>                                       
                                           
                                           <?php if(!$this->is_rtl) echo "<br/><br/><br/>";?>    <!-- extra space for tag if LTR -->                                       
                                                                                    
                                           <?php $title_formated = (strlen($row['title']) > 40) ? substr($row['title'],0,37).'...' : $row['title']; ?>
                                           <?php $author_formated = (strlen($row['author']) > 40) ? substr($row['author'],0,37).'...' : $row['author']; ?>
                                           <i class="fa fa-book"></i> <?php echo $title_formated; ?>
                                           <!-- if LTR theme theme load sticky tag -->
                                           <span class="hide_rtl"> 
                                           <?php 
                                             if($row['available_book'] != 0)
                                             echo '<div class="yith-wcbsl-badge-wrapper yith-wcbsl-mini-badge"> <div class="yith-wcbsl-badge-content green">'.$this->lang->line("available").'</div></div>';
                                             else echo '<div class="yith-wcbsl-badge-wrapper yith-wcbsl-mini-badge"> <div class="yith-wcbsl-badge-content">'.$this->lang->line("unavailable").'</div> </div>';
                                             
                                           ?>
                                           </span>
                                           <!-- if RTL theme theme dont load sticky tag, load label -->
                                           <span class="show_rtl text-center" style="display:none">
                                             <?php 
                                             if($row['available_book'] != 0)
                                             echo '<span class="label label-success">'."available".'</span>';
                                             else echo '<span class="label label-danger">'."unavailable".'</span>';
                                             ?>
                                           </span>
                                        </div>
                                        <br/>
                                       <img alt="<?php echo $row['title']; ?>" src="<?php echo base_url().'upload/cover_images/thumbnail_cover_images/'.$row['cover']; ?>" class="img-responsive" style="width:190px!important;height:250px!important;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="mythumbnail-title">
                                            <h5><i class="fa fa-user"></i> <?php echo $author_formated; ?></h5>
                                        </div>                                                                      
                                        <div class="mythumbnail-title">
                                           <?php echo $this->lang->line("added"); ?> @<?php echo date("d/m/Y",strtotime( $row['add_date'])); ?> 
                                        </div>
                                    </div>
                                </div>                                    
                            </div>                          
                        </div>
                        <?php
						
                        $category_str="";
                        if(isset($row['category_id']) && $row['category_id'] != '')
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
                           <i class="fa fa-sort-numeric-asc"></i>&nbsp; <b><?php echo $this->lang->line("ISBN"); ?>  </b> &nbsp;<?php echo $row['isbn']; ?><br/>
                           <i class="fa fa-folder-open"></i>&nbsp; <b><?php echo $this->lang->line("publisher"); ?>  </b> &nbsp;<?php echo $row['publisher']; ?><br/>
                           <i class="fa fa-book"></i>&nbsp; <b><?php echo $this->lang->line("total books"); ?> &nbsp </b> &nbsp;<?php echo $row['number_of_books']; ?> &nbsp <?php echo $this->lang->line("copy"); ?> <br/>
                           <i class="fa fa-book"></i>&nbsp; <b><?php echo $this->lang->line("available books"); ?> &nbsp </b> &nbsp;<?php echo $row['available_book']; ?> &nbsp <?php echo $this->lang->line("copy"); ?> <br/>
                           <?php if(isset($row['publication_year'])) echo "( ".$row['publication_year']." )<br/>"; ?>
                            <i class="fa fa-pencil"></i>&nbsp; <b><?php echo $this->lang->line("edition"); ?>  </b> &nbsp;<?php echo $row['edition']; ?>
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

