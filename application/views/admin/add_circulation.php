<style type="text/css">
  #suggestion_div_for_book,#suggestion_div_for_book:hover
  {
    background: #CCC;
    display: none;
    border-radius: 5px;
  }
  .book_name:hover
  {
    cursor: pointer;
  }
</style>

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><strong><?php echo $this->lang->line("new issue"); ?></strong></h4>
        </div>
        <div class="modal-body">
          <div class="form-horizontal">
            <div class="form-group">
              <label class="control-label col-sm-4 col-xs-12 col-md-4 col-lg-4" for="book_id"><?php echo $this->lang->line("book id"); ?></label>
              <div class="col-sm-8 col-xs-12 col-md-8 col-lg-8">
                <input type="text" class="form-control" id="book_id" name = "book_id" placeholder="<?php echo $this->lang->line("book ID/name");?> <?php echo $this->lang->line("write"); ?>" required>

                <div id="suggestion_div_for_book"></div>

              </div>
            </div>
            
            <!-- <div class="form-group"> 
              <div class="col-sm-8 col-xs-12 col-md-8 col-lg-8 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                <input type="button" id = "new_issue_check"class="btn btn-default" value = "Preview"/>
              </div>
            </div> -->
          </div>
        </div>
        <div class="modal-footer">
          
          <div id = "book_preview" class="text-center" style="display:none">
            <div style="margin-bottom:5px;">
              <input type="button" id="new_issue_submit" class="btn btn-success btn-lg" data-dismiss="modal" value = "<?php echo $this->lang->line("issue"); ?>" style="display:bock;" />
            </div>
            <div>              
              <img class="img img-thumbnail" id="book_cover_preview" style="width:175px; height:275px;" src="">
            </div>
            
          </div>
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
        </div>
      </div>  

    </div>
  </div>
</div>




<style type="text/css"> 
  .form-control

  {
    padding: 6px 140px 6px 10px!important;
    border-radius: 5px!important;

  }
  .btn-primary
  {
    border-radius: 5px!important;
  }
  #suggestion_div_for_member,#suggestion_div_for_member:hover
  {
    background: white;
    display: none;
    border-radius: 5px;
  }
  .member_name:hover
  {
    cursor: pointer;
  }
</style>

<div class="row">
  <div style="background:#3399FF;margin-bottom:0px;margin-top:20px;padding-left:15px;padding-top:15px;" class="col-xs-12  col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
    <h3 style="margin-top:0px !important;color:white"><i class="fa fa-search"></i> <?php echo $this->lang->line("member search panel"); ?></h3>
  </div>
  <div class="col-xs-12  col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3" style="margin-top:0px;background-color:#EEE;padding:10px;">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        <i class="fa fa-5x fa-user"style="margin-top:20px;color:#3399FF;"></i>    
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
      <form class="form" role="form" action="<?php echo site_url().'admin/add_circulation_action';?>"  method = "post" style="padding-left:15px;">
        <input type="text" id="member_id" name="member_id" class="form-control" placeholder="<?php echo $this->lang->line("member ID/name"); ?>" />
        
        <div id="suggestion_div_for_member"></div>
        
        <button type="submit" class="btn btn-primary btn-md" style="margin-top:10px;width:120px;background-color:#3399FF !important;color:white !important;"><?php echo $this->lang->line("search"); ?></button>
      </form>
      <br/>
      <br/>
    </div>
  </div>
</div>


<!-- autocomplete for member -->
<script type="text/javascript">
  $('#member_id').keyup(function(){
    var member_name = $(this).val();
    
    var url = "<?php echo site_url('admin/get_suggestion_for_member'); ?>";
    $.ajax
    ({
       type:'POST',
       data:{member_name:member_name},
       async:false,
       url:url,
       success:function(response)
        {
          $('#suggestion_div_for_member').show().html(response);
        }
           
    });
     
  });

  $(document.body).on('click','.member_name',function(){
    $('#member_id').val($(this).attr('member_id'));
    $('#suggestion_div_for_member').hide();
  });

  $('#member_id').keydown(function(){
    $('#suggestion_div_for_member').hide();
  });
</script>
<!-- end of autocomplete for member -->


<!-- autocomplete for book -->
<script type="text/javascript">
  $('#book_id').keyup(function(){
    var book_name = $(this).val();
   
    var url = "<?php echo site_url('admin/get_suggestion_for_book'); ?>";
    $.ajax
    ({
       type:'POST',
       data:{book_name:book_name},
       async:false,
       url:url,
       success:function(response)
        {
          $('#suggestion_div_for_book').show().html(response);
        }
           
    });
     
  });

  $(document.body).on('click','.book_name',function(){
    $('#book_id').val($(this).attr('book_id'));
    $('#suggestion_div_for_book').hide();
    var base_url="<?php echo base_url(); ?>";

    $.ajax({
      type:'POST',
      url: base_url+"admin/new_issue_check",
      data:{book_id   :   $(this).attr('book_id')},
      success:function(response){
        //alert(response);
        if(response =='wrong_id')
          alert("<?php echo $this->lang->line('sorry! there is no such book'); ?>");
        else
        {
          $("#book_preview").slideDown();
          $("#book_cover_preview").attr('src',response);      

        }
       
      
      }

    });
  });

  $('#book_id').keydown(function(){
    $('#suggestion_div_for_book').hide();
  });
</script>
<!-- end of autocomplete for book -->

<!-- After Search Section. -->


<div class="row">
  <div class="col-md-12">
    <div>

      <?php  
      if(isset($member_exist) && !empty($member_exist))
      {
        if(isset($row))
          $this->load->view('admin/add_circulation_result');
      }  
      if(isset($member_exist) && empty($member_exist)) 
        echo '<br/><div class="col-lg-6 col-lg-offset-3"><div class="alert alert-info text-center"><h4>'.$this->lang->line("sorry! there is no such member").'</h4></di></div>';
      ?> 
      
    </div>
  </div>
</div>







