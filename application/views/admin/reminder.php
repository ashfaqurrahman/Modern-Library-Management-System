<?php
    // $edit_permission=0;
    // if(in_array(3,$this->role_module_accesses_2))  
    $edit_permission=1;
?>
<!-- Content Header (Page header) -->
<style type="text/css">
  @media screen and (min-width: 980px) {
      .small_select{
      width: 96px !important;
      padding-left: 5px !important;
    }
  }
</style>
<section class="content-header">
  <h1> <?php echo $this->lang->line("send notification to delayed members"); ?></h1>  
</section>

<!-- Main content -->
<section class="content">  
  <div class="row">
    <div class="col-xs-12">
        <div class="grid_container" style="min-height:700px">
            <table 
            id="mt"  
            class="easyui-datagrid" 
            url="<?php echo base_url()."reminder/reminders_data"; ?>" 
            
            pagination="true" 
            rownumbers="true" 
            toolbar="#tb" 
            pageSize="10" 
            pageList="[5,10,20,50,100]"  
            fit= "true" 
            fitColumns= "true" 
            nowrap= "true" 
            view= "detailview"
            idField="id"
            >
            
                <thead>
                    <tr>
                        <th field="id" checkbox="true"></th>         
                        <th field="name" sortable="true" ><?php echo $this->lang->line("member name"); ?></th>
                        <th field="email" sortable="true" ><?php echo $this->lang->line("email"); ?></th>
                        <th field="mobile" sortable="true" ><?php echo $this->lang->line("mobile"); ?></th>
                        <th field="member_id" sortable="true" ><?php echo $this->lang->line("member id"); ?></th>                        
                        <th field="issue_date" sortable="true" ><?php echo $this->lang->line("issue date"); ?></th>
                        <th field="expire_date" sortable="true" ><?php echo $this->lang->line("expiry date"); ?></th> 
                        <th field="title" sortable="true" ><?php echo $this->lang->line("title"); ?></th>        
                    </tr>
                </thead>
            </table>                        
         </div>

       <div id="tb" style="padding:3px">
            <a class="btn btn-warning"  title="Send Notification" onclick="sms_send_email_ui()">
                <i class="fa fa-send"></i> <?php echo $this->lang->line("send sms/email notification"); ?>
            </a>          
            <form class="form-inline clearfix" style="margin-top:20px">

                <div class="form-group">
                    <input  id="name" name="name" class="form-control" size="15" placeholder="<?php echo $this->lang->line("member name"); ?>" >
                </div>

                <div class="form-group">
                    <input  id="issue_from_date" name="issue_from_date" class="form-control datepicker" size="20" placeholder="<?php echo $this->lang->line("issue from date");?>"/>
                </div>

                <div class="form-group">
                    <input  id="issue_to_date" name="issue_to_date" class="form-control datepicker" size="20" placeholder="<?php echo $this->lang->line("issue to date"); ?>"/>
                </div>

                <div class="form-group">
                    <input  id="expire_from_date" name="expire_from_date" class="form-control datepicker" size="20" placeholder="<?php echo $this->lang->line("expire from date"); ?>"/>
                </div>

                <div class="form-group">
                    <input  id="expire_to_date" name="expire_to_date" class="form-control datepicker" size="20" placeholder="<?php echo $this->lang->line("expire to date"); ?>"/>
                </div>

                <div class="form-group">
                  <bumton class='btn btn-info'  onclick="doSearch(event)"><?php echo $this->lang->line("search"); ?></bumton>
                </div>

            </form>         
        </div>
    </div>
  </div>   
</section>



<!--Modal for Send SMS  Email-->
  
<div id="modal_send_sms_email" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <bumton type="bumton" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </bumton>
        <h4 id="SMS" class="modal-title"> <i class="fa fa-envelope"></i> <b><?php echo $this->lang->line("send notification"); ?></b></h4>
      </div>

      <div id="modalBody" class="modal-body">        
        <div id="show_message" class="text-center"></div>

        
        <div class="form-group">
           <label for="sms_content"><?php echo $this->lang->line("notification type"); ?> *</label><br/>
           <select class="form-control" required id="message_type">
            <option value="Notification" selected="selected"><?php echo $this->lang->line("only notification"); ?></option>
            <option value="Email" ><?php echo $this->lang->line("email and notification"); ?> </option>
            <!-- <option value="SMS"><?php echo $this->lang->line("SMS and notification"); ?> </option> -->
          </select>
        </div>
      

        <div class="form-group">
          <label for="sms_content"><?php echo $this->lang->line("message subject"); ?> *</label><br/>
          <input type="text" id="sms_subject" required class="form-control" placeholder="<?php echo $this->lang->line("message subject"); ?>"/>
        </div>

        <div class="form-group">
          <label for="sms_content"><?php echo $this->lang->line("message"); ?> *</label><br/>
          <textarea name="sms_content" required style="width:100%;height:200px;" id="sms_content"></textarea>
        </div>

        <div id="text_count"></div>
     
      </div>

      <div class="modal-footer clearfix">
           <bumton id="send_sms_email" class="btn btn-warning pull-left" > <i class="fa fa-envelope"></i> <?php echo $this->lang->line("send"); ?></bumton>
           <bumton type="button" class="btn btn-default pull-right" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></bumton>
      </div>
    </div>
  </div>
</div>



<script>

    $j(function() {
        $( ".datepicker" ).datepicker();
    });  

    var base_url="<?php echo site_url(); ?>"
   
    function doSearch(event)
    {
        event.preventDefault(); 
        $j('#mt').datagrid('load',{
          name:                  $j('#name').val(),
          issue_from_date:             $j('#issue_from_date').val(),
          issue_to_date:               $j('#issue_to_date').val(),
          expire_from_date:             $j('#expire_from_date').val(),
          expire_to_date:               $j('#expire_to_date').val(),
          is_searched:      1
        });
    }



    function sms_send_email_ui()
    {
      $("#modal_send_sms_email").modal();
    }  
    
    $j("document").ready(function(){

      // var todate="<?php echo date('Y');?>";
      // var from=todate-70;
      // var to=todate-12;
      // var str=from+":"+to;
      // $('#from_date').datepicker({format: "dd-mm-yyyy",changeMonth:true, changeYear:true,yearRange: str, startView: "decade" });
      // $('#to_date').datepicker({format: "dd-mm-yyyy",changeMonth:true, changeYear:true,yearRange: str, startView: "decade" });

      $("#sms_content").keyup(function(){
        var content=$("#sms_content").val();
        var length= content.length;
        var no_sms= parseInt(length)/160;
        no_sms=Math.ceil(no_sms); 
        $("#text_count").html(length+'/'+no_sms);
      });
      
      $("#send_sms_email").click(function(){      
                  
          var subject=$("#sms_subject").val();
          var content=$("#sms_content").val();
          var message_type=$("#message_type").val();
          var rows = $j("#mt").datagrid("getSelections");
          var info=JSON.stringify(rows);  
          
          if(rows=="") 
          {
            $("#show_message").addClass("alert alert-warning");
            $("#show_message").html("<b><?php echo $this->lang->line('you did not select any member'); ?></b>");
            return;
          }
          
          if(subject=="" || content=="")
          {
            $("#show_message").addClass("alert alert-warning");
            $("#show_message").html("Something is missing.");
            return;
          }

          $(this).attr('disabled','yes');
          $("#show_message").addClass("alert alert-info");
          $("#show_message").show().html('<i class="fa fa-spinner fa-spin"></i> <?php echo $this->lang->line("sending, please wait..."); ?>');
          $.ajax({
          type:'POST' ,
          url: "<?php echo site_url(); ?>reminder/send_notification",
          data:{content:content,info:info,subject:subject,message_type:message_type},
          success:function(response){
            $("#send_sms_email").removeAttr('disabled');                     
            $("#show_message").addClass("alert alert-info");
            $("#show_message").html(response);
          }
        });   
      }); 
  });

</script>
