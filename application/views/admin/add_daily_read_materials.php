<?php $this->load->view('admin/theme/message'); ?>
<style type="text/css">
#suggestion_div_for_book_id,#suggestion_div_for_book_id:hover
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

<section class="content-header">
  <section class="content">
    <div class="box box-info custom_box">
      <div class="box-header">
        <h3 class="box-title"><i class="fa fa-plus-circle"></i> <?php echo $this->lang->line("add"); ?> - <?php echo $this->lang->line("daily read books"); ?></h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <!-- enctype="multipart/form-data" is needed to image upload -->
      <form class="form-horizontal" action="<?php echo site_url().'admin/add_daily_read_materials_action';?>" method="POST">
        <div class="box-body">

          <div class="form-group">
            <label class="col-sm-3 control-label" for="name"><?php echo $this->lang->line("book id"); ?> *</label>
            <div class="col-sm-9 col-md-6 col-lg-6">
              <input id="daily_book_id" name="book_id" value="<?php echo set_value('book_id');?>"  class="form-control" type="text">              
              <span class="red"><?php echo form_error('book_id'); ?></span>

              <div id="suggestion_div_for_book_id"></div>

            </div>
          </div>
        </div> <!-- /.box-body --> 

        <div class="box-footer">
          <div class="form-group">
            <div class="col-sm-12 text-center">
              <input name="submit" type="submit" class="btn btn-warning btn-lg" value="<?php echo $this->lang->line("save"); ?>"/>  
              <input type="button" class="btn btn-default btn-lg" value="<?php echo $this->lang->line("cancel"); ?>" onclick='goBack("admin/daily_read_material")'/>  
            </div>
          </div>
        </div><!-- /.box-footer -->         
      </div><!-- /.box-info -->       
    </form>     
  </div>
</section>
</section>

<!-- autocomplete for book -->
<script type="text/javascript">
  $('#daily_book_id').keyup(function(){
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
          $('#suggestion_div_for_book_id').show().html(response);
        }
           
    });
     
  });

  $(document.body).on('click','.book_name',function(){
    $('#daily_book_id').val($(this).attr('book_id'));
    $('#suggestion_div_for_book_id').hide();
  });

  $('#daily_book_id').keydown(function(){
    $('#suggestion_div_for_book_id').hide();
  });
</script>
<!-- end of autocomplete for book -->



