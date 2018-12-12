
<section class="content-header">
  <h1> <?php echo $this->lang->line("memberwise fine report"); ?></h1>
</section>


<!-- Main content -->
<section class="content">  
  <div class="row">
    <div class="col-xs-12">
        <div class="grid_container" style="width:100%; min-height:500px;">
            <table 
            id="tt"  
            class="easyui-datagrid" 
            url="<?php echo base_url()."report/report_data"; ?>" 
            
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
                        <!-- <th field="id" checkbox="true"></th>-->
                        <th field="name"  sortable="true" ><?php echo $this->lang->line("member name"); ?></th>
                        <th field="email" sortable="true" ><?php echo $this->lang->line("email"); ?></th>
                        <th field="mobile" sortable="true" ><?php echo $this->lang->line("mobile"); ?></th>
                        <th field="address" sortable="true" ><?php echo $this->lang->line("address"); ?></th>
                        <th field="fine_amount" sortable="true" ><?php echo $this->lang->line("fine"); ?> - <?php echo $this->config->item('currency'); ?></th>
                        <th field="view" formatter='action_column'><?php echo $this->lang->line("actions"); ?></th>              
                                                      
                    </tr>
                </thead>
            </table>                        
         </div>
  
       <div id="tb" style="padding:3px">

           <a target="_blank" class="btn btn-warning"  title="Download" href="<?php echo site_url('report/report_download');?>">
            <i class="fa fa-cloud-download"></i> <?php echo $this->lang->line("download"); ?>
           </a>  
            <form class="form-inline" style="margin-top:20px">
                <div class="form-group">
                    <input id="name" name="name" class="form-control" size="20" placeholder="<?php echo $this->lang->line("member name"); ?>">
                </div>   


                <div class="form-group">
                    <input id="from_date" name="from_date" class="form-control datepicker" size="20" placeholder="<?php echo $this->lang->line("return from date"); ?>">
                </div>

                 <div class="form-group">
                    <input id="to_date" name="to_date" class="form-control  datepicker" size="20" placeholder="<?php echo $this->lang->line("return to date"); ?>">
                </div>   
                
                <button class='btn btn-info'  onclick="doSearch(event)"><?php echo $this->lang->line("search"); ?></button>     
                      
            </form> 

        </div>        
    </div>
  </div>   
</section>

<!--  Modal for individual member fine -->

<div id="modal_member_detail" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
                <h4 id="member_details_title" class="modal-title"><?php echo $this->lang->line("view"); ?> - <?php echo $this->lang->line("fine"); ?></h4>
            </div>
      
            <div id="member_view_body" class="modal-body">
        
      </div>
      
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
            </div>
        </div>
    </div>
</div>


<script>   


    $j(function() {
        $( ".datepicker" ).datepicker();
      });     
    var base_url="<?php echo site_url(); ?>"
    
    function action_column(value,row,index)
    {               
        var member_id = row.member_id;        
       
        
        var str="";
        var view_permission=1;   
        
        if(view_permission==1)     
        str="<a title='Details' style='cursor:pointer' onclick='view_details(event,"+member_id+")' >"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/magnifier.png");?>" alt="View">'+"</a>";
        
       
        return str;
    }  

    function view_details(e,member_id)
    {
      var details_url = "<?php echo site_url('report/report_details'); ?>";
      $.ajax({
        url:details_url,
        type:'POST',
        data:{id:member_id},
        success:function(response){
          $("#modal_member_detail").modal();
          $("#member_view_body").html(response);
        }
      });
    }
    
    function doSearch(event)
    {
        event.preventDefault(); 
        $j('#tt').datagrid('load',{
          name       :     $j('#name').val(),     
          from_date  :     $j('#from_date').val(),    
          to_date    :     $j('#to_date').val(),         
          is_searched:      1
        });


    }  
    

</script>
