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

h4.pagination_link
{
font-size: 12px;
text-align: center;
font-weight: normal;
margin-top: 12px;
}

h4.pagination_link a
{
padding: 4px 7px 4px 7px;
background: #238db6;
border-radius: 5px;
color:#fff;
border:1px solid #238db6;
font-style: normal;
text-decoration: none;
}

h4.pagination_link strong
{
padding: 4px 7px 4px 7px;
background: #E95903;
border-radius: 5px;
color:#fff;
border:1px solid #E95903;
font-style: normal;
}

h4.pagination_link a:hover
{
background: #77a2cc;
border:1px solid #77a2cc; 
color: #fff;
}
</style>

<br/>
<?php $category_name=""; if(isset($_GET['category_name'])) $category_name=$_GET['category_name']; ?>
<div class="container-fluid">
  <div class="row">    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-xs-12 grid">
              <div class="border_gray grid_content content_grid">
                <h4 class="column-title"><i class="fa fa-search blue"> </i> <span class="blue"><?php echo $this->lang->line("search book"); ?></span></h4>                 
                  <form role="form" method="GET" action="<?php echo site_url('home/book'); ?>">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-3">
                        <div class="form-group">
                          <input type="text" name="title" id="title" class="form-control input-lg" placeholder="<?php echo $this->lang->line("title"); ?>">
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-3">
                        <div class="form-group">
                          <input type="text" name="author" id="author" class="form-control input-lg" placeholder="<?php echo $this->lang->line("author"); ?>">
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-3">
                        <div class="form-group">
                          <?php 
                            $cat_info=$book_category;                     
                            $cat_info['']=$this->lang->line("all category");                     
                            echo form_dropdown('category_name',$cat_info,"",'class="form-control" id="category_name"'); 
                          ?>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-3">
                        <div class="form-group">
                          <div class="col-xs-12 col-md-6"><input type="submit" value="<?php echo $this->lang->line("search");?>" name="search" class="btn btn-info btn-block btn-lg"></div>
                        </div>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="row">
            <div class="col-xs-12 grid">
              <div class="border_gray grid_content content_grid">
                <?php 
                $search_parameters="";
                if($this->session->userdata('public_lb_title')!="")
                $search_parameters.=" <b>". $this->lang->line("title")."</b>: ".$this->session->userdata('public_lb_title')." ,";
                if($this->session->userdata('public_lb_author')!="")
                $search_parameters.=" <b>". $this->lang->line("author")."</b>: ".$this->session->userdata('public_lb_author')." ,";
                if($this->session->userdata('public_lb_category_name'))
                {
                  $search_parameters.=" <b>". $this->lang->line("book category")."</b>: ".$book_category[$this->session->userdata('public_lb_category_name')];
                }
                $search_parameters=trim($search_parameters,',');
                ?>
                <h4 class="column-title"><i class="fa fa-binoculars blue"> </i> <span class="blue"><?php echo  $this->lang->line("search result"); ?> </span></h4>
                <?php if($search_parameters!="") echo '<h5>'.$search_parameters.'</h5>'; ?>
                <?php if(isset($pages) && $pages!="") echo '<h4  class="pagination_link">'. $this->lang->line("pages").' : '.$pages.'</h4>'; ?>  
                 <div class="row">
                  <div class="col-xs-12">
                    <div class="">  
                      <?php 
                      if(isset($book_info))
                      {
                        if(count($book_info)==0) echo "<div class='alert alert-info'>".$this->lang->line("no book matches with your search query")."</div>";                
                        $delay=0;
                        foreach($book_info as $row) 
                        { ?>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-centered mythumbnail-container  wow fadeInDown animated">                                    
                                <div  data-wow-delay="0ms" data-wow-duration="400ms" class="before_flip wow zoomIn animated" style="visibility: visible; animation-duration: 400ms; animation-delay: <?php echo $delay;?>ms; animation-name: zoomIn;">
                                    <div class="mythumbnail border_gray">                            
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="mythumbnail-title clearfix">
                                                   
                                                   <?php //if($this->config->item("language")!="arabic") echo "<br/><br/><br/>";?>  
                                                   <?php if(!$this->is_rtl)  echo "<br/><br/><br/>";?>  <!-- extra space for tag if LTR -->
                                                  
                                                   <?php $title_formated = (strlen($row['title']) > 40) ? substr($row['title'],0,37).'...' : $row['title']; ?>
                                                   <?php $author_formated = (strlen($row['author']) > 40) ? substr($row['author'],0,37).'...' : $row['author']; ?>
                                                   <i class="fa fa-book"></i> <?php echo $title_formated; ?>
                                                   <!-- if LTR theme theme load sticky tag -->
                                                   <span class="hide_rtl"> 
                                                   <?php 
                                                     if($row['available_book'] != 0)
                                                     echo '<div class="yith-wcbsl-badge-wrapper yith-wcbsl-mini-badge"> <div class="yith-wcbsl-badge-content green">'."available".'</div></div>';
                                                     else echo '<div class="yith-wcbsl-badge-wrapper yith-wcbsl-mini-badge"> <div class="yith-wcbsl-badge-content">'."unavailable".'</div> </div>';
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
                                               <img alt="<?php echo $row['title']; ?>" src="<?php echo base_url().'upload/cover_images/thumbnail_cover_images/'.$row['cover']; ?>" class="img-responsive" style="width:160px!important;height:210px!important;">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="mythumbnail-title">
                                                    <h5><i class="fa fa-user"></i> <?php echo $author_formated; ?></h5>
                                                </div> 
                                            </div>
                                        </div>                                    
                                    </div>                          
                                </div>
                                <?php
                                $category_str="";
                                if(isset($row['category_id'])  && $row['category_id']!='')
                                {
                                  $category_ids=explode(',',$row['category_id']);
                                  $category_names=array();
                                  foreach ($category_ids as $val) 
                                  {
                                    $category_names[]=$book_category[$val];
                                  }
                                  $category_str=implode(' / ',$category_names);
                                }                        
                                ?>  
                                <div class="flip_overlay" style="display:none">                      
                                     <i class="fa fa-list-ol"></i>&nbsp; <b><?php echo $this->lang->line("book category");?> </b> &nbsp; <?php echo  $category_str; ?><br/>
                                     <i class="fa fa-book"></i>&nbsp; <b><?php echo $this->lang->line("title");?> </b> &nbsp; <?php echo $row['title']; ?><br/>
                                     <i class="fa fa-user"></i>&nbsp; <b><?php echo $this->lang->line("author");?> </b>&nbsp; <?php echo $row['author']; ?><br/>
                                     <i class="fa fa-sort-numeric-asc"></i>&nbsp; <b><?php echo $this->lang->line("ISBN");?> </b> &nbsp; <?php echo $row['isbn']; ?><br/>
                                     <i class="fa fa-folder-open"></i>&nbsp; <b><?php echo $this->lang->line("publisher");?> </b> &nbsp; <?php echo $row['publisher']; ?><br/>
                                     <i class="fa fa-book"></i>&nbsp; <b><?php echo $this->lang->line("total books");?>&nbsp </b> &nbsp; <?php echo $row['number_of_books']; ?> &nbsp copies<br/>
                                     <i class="fa fa-book"></i>&nbsp; <b><?php echo $this->lang->line("available books");?>&nbsp </b> &nbsp; <?php echo $row['available_book']; ?> &nbsp copies<br/>
                                     <?php if(isset($row['publication_year'])) echo "( ".$row['publication_year']." )<br/>"; ?>
                                      <i class="fa fa-pencil"></i>&nbsp; <b><?php echo $this->lang->line("edition");?> </b> &nbsp; <?php echo $row['edition']; ?>
                                     <?php if(isset($row['publishing_year'])) echo "( ".$row['edition_year']." )"; ?>
                                </div>                      
                            </div>
                        <?php 
                        $delay+=200;
                        } 
                      }
                      else echo "<div class='alert alert-info'>".$this->lang->line("please use the search form or category links to search books")."</div>";                
                        
                      ?>
                    </div>
                  </div>
                </div>
                <?php if(isset($pages) && $pages!="") echo '<h4  class="pagination_link">'. $this->lang->line("pages").' : '.$pages.'</h4>'; ?>  
              </div>
            </div>
        </div>
    </div> 

     <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="row">
            <div class="col-xs-12 grid">
              <div class="border_gray grid_content content_grid">
                <h4 class="column-title"><i class="fa fa-list-ol blue"> </i> <span class="blue"><?php echo $this->lang->line("book category"); ?></span></h4>                 
                <div class="sidemenu">
                  <ul>
                     <?php foreach($book_category as $key=>$row) 
                     { ?>
                       <li <?php if($category_name==$key) echo 'class="active"';?>><a href="<?php echo site_url('home/book')."?category_name=".$key;?>"><span><?php echo $row; ?></span></a></li>
                       <?php 
                     } ?>
                  </ul>
                </div>
              </div>
            </div>
        </div>
    </div>   

  </div> <!-- end column middle area -->
</div> <!-- end container main content -->

