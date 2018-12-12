<section class="content-header">
  <h1> <?php echo $this->lang->line("circulation");?></h1>

</section>


<!-- Main content -->
<section class="content">  
  <div class="row">
    <div class="col-xs-12">
        <div class="grid_container" style="width:100%; min-height:700px;">
            <table 
            id="tt"  
            class="easyui-datagrid" 
            url="<?php echo base_url()."admin/circulation_data"; ?>" 
            
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
                        <th field="book_id"  sortable="true" ><?php echo $this->lang->line("book id");?></th>
                        <th field="name"  sortable="true" ><?php echo $this->lang->line("member name");?></th>
                        <th field="member_id"  sortable="true" ><?php echo $this->lang->line("member id");?></th>
                        <th field="title" sortable="true" ><?php echo $this->lang->line("title");?></th>
                        <th field="author" sortable="true" ><?php echo $this->lang->line("author");?></th>
                        <th field="issue_date" sortable="true" ><?php echo $this->lang->line("issue date");?></th>
                        <th field="expire_date" sortable="true" ><?php echo $this->lang->line("expiry date");?></th>
                        <th field="return_date"    sortable="true"><?php echo $this->lang->line("return date");?></th>
                        <th field="fine_amount" sortable="true" ><?php echo $this->lang->line("fine");?> - <?php echo "{$this->config->item('currency')}"; ?></th>
                        <th field="is_returned" formatter="action_column2" ><?php echo $this->lang->line("is returned");?></th> 
                       <!--  <th field="view" formatter='action_column'>Details</th> -->              
                                                      
                    </tr>
                </thead>
            </table>                        
         </div>
  
       <div id="tb" style="padding:3px">

           <a class="btn btn-warning"  title="Add Book" href="<?php echo site_url('admin/add_circulation');?>">
            <i class="fa fa-retweet"></i> <?php echo $this->lang->line("issue and return");?>
           </a>  
            <form class="form-inline" style="margin-top:20px">
                <div class="form-group">
                    <input id="book_id" name="book_id" class="form-control" size="14" placeholder="<?php echo $this->lang->line("book id");?>">
                </div> 

                <div class="form-group">
                    <input id="name" name="name" class="form-control" size="14" placeholder="<?php echo $this->lang->line("member name");?>">
                </div>  

                <div class="form-group">
                    <input id="member_id" name="member_id" class="form-control" size="14" placeholder="<?php echo $this->lang->line("member id");?>">
                </div>  

                <div class="form-group">
                    <input id="book_title" name="book_title" class="form-control" size="14" placeholder="<?php echo $this->lang->line("title");?>">
                </div>

                <div class="form-group">
                    <input id="author" name="author" class="form-control" size="14" placeholder="<?php echo $this->lang->line("author");?>">
                </div> 

                <div class="form-group">
                  <label for="return_status"></label>
                  <select class="form-control" id="return_status">                   
                    <option value="issued" selected><?php echo $this->lang->line("issued");?></option>
                    <option value="returned"><?php echo $this->lang->line("returned");?></option>
                    <option value="expired_returned"><?php echo $this->lang->line("expired and returned");?></option>                   
                    <option value="expired_not_returned"><?php echo $this->lang->line("expired and not returned");?></option>                   
                  </select>
                </div>  

                <!-- <div class="form-group">
                    <input id="from_date" name="from_date" class="form-control datepicker" size="14" placeholder="<?php echo $this->lang->line("issue from date");?>">
                </div>

                 <div class="form-group">
                    <input id="to_date" name="to_date" class="form-control  datepicker" size="14" placeholder="<?php echo $this->lang->line("issue to date");?>">
                </div> -->   
                
                <button class='btn btn-info'  onclick="doSearch(event)"><?php echo $this->lang->line("search");?></button>     
                      
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
    
 

    function action_column2(value,row,index){
    	var status = row.is_returned;
    	var str = '';

    	 if(status=='1')
       	str=str+"<label class='label label-success'><?php echo $this->lang->line('yes') ?></label>";

       if(status=='0')
       	str=str+"<label class='label label-danger'><?php echo $this->lang->line('no') ?></label>";
        
        return str;

    }
    

           
   
    
    function doSearch(event)
    {
        event.preventDefault(); 
        $j('#tt').datagrid('load',{
          book_id    :     $j('#book_id').val(),
          name       :     $j('#name').val(),
          member_id  :     $j('#member_id').val(),
          book_title :     $j('#book_title').val(),
          author     :     $j('#author').val(),       
          from_date  :     $j('#from_date').val(),    
          to_date    :     $j('#to_date').val(),         
          return_status    :     $j('#return_status').val(),         
          is_searched:      1
        });


    }  
    

</script>
