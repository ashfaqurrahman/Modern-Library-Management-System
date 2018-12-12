
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $this->lang->line("notification report"); ?> </h1>

</section>

<!-- Main content -->
<section class="content">  
  <div class="row">
    <div class="col-xs-12">
        <div class="grid_container" style="width:100%; height:500px;">
            <table 
            id="tt"  
            class="easyui-datagrid" 

            url="<?php echo base_url()."report/notification_report_data"; ?>" 
            
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
                    <!-- <th field="id" checkbox="true">ID</th> -->
                    <th field="name" sortable="true" ><?php echo $this->lang->line("member name"); ?></th>
                    <th field="email" sortable="true" ><?php echo $this->lang->line("email"); ?></th>
                    <th field="mobile" sortable="true" ><?php echo $this->lang->line("mobile"); ?></th>
                    <th field="type" sortable="true" ><?php echo $this->lang->line("notification type"); ?></th>
                    <th field="sent_at" sortable="true" ><?php echo $this->lang->line("sent at"); ?></th> 
                    <th field="title" sortable="true" ><?php echo $this->lang->line("message subject"); ?></th> 
                    <th field="message" sortable="true" ><?php echo $this->lang->line("message"); ?></th> 
                </tr>
            </thead>
        </table>                        
    </div>

    <div id="tb" style="padding:3px">
        <a target="_blank" class="btn btn-warning"  title="Download" href="<?php echo site_url('report/notification_report_download');?>">
            <i class="fa fa-cloud-download"></i> <?php echo $this->lang->line("download"); ?>
        </a> 

        <form class="form-inline" style="margin-top:20px">                  

            <!-- <div class="form-group">
                <input id="type" name="type" class="form-control" size="20" placeholder="Notification Type">
            </div> -->
            <?php 
            $message_type['']=$this->lang->line("notification type");
            echo form_dropdown('type',$message_type,'','class="form-control" id="type"');  
            ?>     

            <div class="form-group">
                <input id="name" name="name" class="form-control" size="20" placeholder="<?php echo $this->lang->line("member name"); ?>">
            </div>          

             
            <div class="form-group">
                <input id="from_date" name="from_date" class="form-control datepicker" size="20" placeholder="<?php echo $this->lang->line("from date"); ?>">
            </div>

            <div class="form-group">
                <input id="to_date" name="to_date" class="form-control  datepicker" size="20" placeholder="<?php echo $this->lang->line("to Date"); ?>">             
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
           
   
   function doSearch(event)
   {
        event.preventDefault(); 
        $j('#tt').datagrid('load',
        {
          type       :     $j('#type').val(),      
          name       :     $j('#name').val(),      
          from_date   :     $j('#from_date').val(),    
          to_date     :     $j('#to_date').val(),         
          is_searched :      1
        });
    }    

</script>
