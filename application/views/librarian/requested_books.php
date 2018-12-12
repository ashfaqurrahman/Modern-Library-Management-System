<?php $this->load->view('librarian/theme/message'); ?>

<?php
    $view_permission    = 1; 
    $edit_permission    = 1;
    $delete_permission  = 1;
?>
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="reject_modal" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header" id="reject_modal_header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $this->lang->line("reject request"); ?></h4>
        </div>

        <div class="modal-body" id="reject_modal_body">
            <div class="form-group">
                <label><?php echo $this->lang->line("cause of rejection"); ?></label>
                 <textarea class="form-control" id = "admin_reply"></textarea>
            </div>
            <input name='reject_req_id' id='reject_req_id' type='hidden' />        
            <input type="button" id="submit_reject" class="btn btn-success " value="<?php echo $this->lang->line("reject"); ?>" />
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick='reject_request'><?php echo $this->lang->line("close"); ?></button>
        </div>
      </div>      
    </div>
  </div>  
</div>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $this->lang->line("requested books"); ?> </h1>

</section>


<!-- Main content -->
<section class="content">  
  <div class="row" >
    <div class="col-xs-12">
        <div class="grid_container" style="width:100%; min-height:600px;">
            <table 
            id="tt"  
            class="easyui-datagrid" 
            url="<?php echo base_url()."librarian/requested_books_data"; ?>" 

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

            <!-- url is the link to controller function to load grid data -->
            
                <thead>
                    <tr>
                                           
                        <th field="name"  sortable="true" ><?php echo $this->lang->line("member name"); ?></th>
                        <th field="book_title" sortable="true" ><?php echo $this->lang->line("title"); ?></th>
                        <th field="author" sortable="true" ><?php echo $this->lang->line("author"); ?></th>
                        <th field="edition" sortable="true" ><?php echo $this->lang->line("edition"); ?></th>
                        <th field="request_date" sortable="true"><?php echo $this->lang->line("date"); ?></th>                     
                        <th field="request_status" formatter='request_status' sortable="true"><?php echo $this->lang->line("status"); ?></th>                     
                        <th field="view" formatter='action_column'><?php echo $this->lang->line("actions"); ?></th>    

                    </tr>
                </thead>
            </table>                        
         </div>
  
       <div id="tb" style="padding:3px">
           
              
            <form class="form-inline" style="margin-top:20px">
                <div class="form-group">
                    <input id="name" name="name" class="form-control" size="20" placeholder="<?php echo $this->lang->line("member name"); ?>">
                </div>   

                <div class="form-group">
                    <input id="book_title" name="book_title" class="form-control" size="20" placeholder="<?php echo $this->lang->line("title"); ?>">
                </div>

                <div class="form-group">
                    <input id="author" name="author" class="form-control" size="20" placeholder="<?php echo $this->lang->line("author"); ?>">
                </div>   

                <div class="form-group">
                    <input id="from_date" name="from_date" class="form-control datepicker" size="20" placeholder="<?php echo $this->lang->line("from date"); ?>">
                </div>

                 <div class="form-group">
                    <input id="to_date" name="to_date" class="form-control  datepicker" size="20" placeholder="<?php echo $this->lang->line("to date"); ?>">
                </div>   
                
                <button class='btn btn-info'  onclick="doSearch(event)"><?php echo $this->lang->line("search"); ?></button>     
                      
            </form> 

        </div>        
    </div>
  </div>   
</section>


<script> 

	 $j(function() {
    $( ".datepicker" ).datepicker();
  });      
    var base_url="<?php echo site_url(); ?>"
    
    function action_column(value,row,index)
    {               
              
       
        var status = row.request_status;        
        var str="";  
        var req_id=row.id;
        
        if(status=='Pending')
        {
          str=str+"&nbsp;&nbsp;&nbsp;&nbsp;<a style='cursor:pointer' title='Update' onclick='accept_req(event,"+req_id+")' >"+'<button type="button" class="btn btn-info"><?php echo $this->lang->line("accept"); ?></button>'+"</a>";
          str=str+"&nbsp;&nbsp;&nbsp;&nbsp;<a style='cursor:pointer' title='Update' onclick='reject_req(event,"+req_id+")' >"+'<button type="button" class="btn btn-warning"><?php echo $this->lang->line("reject"); ?></button>'+"</a>";
        }

        else str="<label class='label label-success'>"+"<?php echo $this->lang->line('resolved'); ?>"+"</label>";

        // if(status=='Accepted')
        //   str=str+"<label class='label label-success'>"+"<?php echo $this->lang->line('accepted'); ?>"+"</label>";

        // if(status=='Rejected')
        //   str=str+"<label class='label label-danger'>"+"<?php echo $this->lang->line('rejected'); ?>"+"</label>";
              
        return str;
    }  

    function request_status(value,row,index)
    {             
      var status = row.request_status;
      var str="";
      if(status=='Accepted') str="<label class='label label-success'>"+"<?php echo $this->lang->line('accepted'); ?>"+"</label>";
      else if(status=='Rejected') str="<label class='label label-danger'>"+"<?php echo $this->lang->line('rejected'); ?>"+"</label>";
      else str="<label class='label label-warning'>"+"<?php echo $this->lang->line('pending'); ?>"+"</label>";
        
      return str;
    }   
           
   
    function doSearch(event)
    {
        event.preventDefault(); 
        $j('#tt').datagrid('load',{
          name       :     $j('#name').val(),
          book_title :     $j('#book_title').val(),
          author     :     $j('#author').val(),       
          from_date  :     $j('#from_date').val(),    
          to_date    :     $j('#to_date').val(),         
          is_searched:      1
        });


    }  
    

    function accept_req(e,req_id){
    	var ans=confirm("<?php echo $this->lang->line('are you sure'); ?>");

    	if(!ans){
    		return false;
    	}

    	$.ajax({
    		url:base_url+'librarian/accept_action',
    		type:'POST',
    		data:{req_id:req_id},
    		success:function(response){

    			$j('#tt').datagrid('reload');

    		}
    	});

    }


    function reject_req(e,req_id){

            $("#reject_modal").modal();
            $("#reject_req_id").val(req_id);
    }


        $("#submit_reject").click(function(){

            var reject_reason=$("#admin_reply").val();
            var req_id=$("#reject_req_id").val();

            $(this).attr('disabled','yes');

            $.ajax({
            url:base_url+'librarian/reject_action',
            type:'POST',
            data:{req_id:req_id,reject_reason:reject_reason},
            success:function(response){
                $(this).removeAttr('disabled');
                $("#reject_modal").modal('hide');
                $j('#tt').datagrid('reload');

            }
        });  



        });





</script>
