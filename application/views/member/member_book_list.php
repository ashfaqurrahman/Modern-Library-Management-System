<?php $this->load->view('member/theme_member/message'); ?>

<?php
    /*$view_permission=$edit_permission=$delete_permission=0;
    if(in_array(1,$this->role_module_accesses_28))*/  
        $view_permission    = 1;
    /*if(in_array(3,$this->role_module_accesses_28))*/  
        $edit_permission    = 1;
    /*if(in_array(4,$this->role_module_accesses_28)) */ 
        $delete_permission  = 1;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $this->lang->line("book"); ?> </h1>

</section>

<!-- Main content -->
<section class="content">  
  <div class="row">
    <div class="col-xs-12">
        <div class="grid_container" style="width:100%; height:500px;">
            <table 
            id="tt"  
            class="easyui-datagrid" 
            url="<?php echo base_url()."member/member_book_list_data"; ?>" 
            
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
                        <th field="id" sortable="true"><?php echo $this->lang->line("book id"); ?></th>                                                         
                        <th field="isbn"  sortable="true" ><?php echo $this->lang->line("ISBN"); ?> </th>
                        <th field="status"  formatter="availability_check" ><?php echo $this->lang->line("availability"); ?> </th>
                        <th field="title" sortable="true" ><?php echo $this->lang->line("title"); ?> </th>
                        <th field="subtitle" sortable="true" ><?php echo $this->lang->line("subtitle"); ?> </th>
                        <th field="author" sortable="true" ><?php echo $this->lang->line("author"); ?> </th>
                        <th field="edition" sortable="true" ><?php echo $this->lang->line("edition"); ?> </th>
                        <th field="edition_year" sortable="true" ><?php echo $this->lang->line("edition year"); ?> </th>
                        <th field="publisher" sortable="true"><?php echo $this->lang->line("Publisher"); ?> </th>                     
                        <th field="publishing_year" sortable="true"><?php echo $this->lang->line("publication year"); ?> </th>                     
                        <th field="size1" sortable="true" ><?php echo $this->lang->line("size"); ?> </th>
                        <th field="pdf" formatter="action_read" ><?php echo $this->lang->line("read online"); ?> </th>
                        <th field="view" formatter='action_column'><?php echo $this->lang->line("actions"); ?> </th>                    
                    </tr>
                </thead>
            </table>                        
         </div>
  
       <div id="tb" style="padding:3px">
       
            
              
            <form class="form-inline" style="margin-top:20px">
                <div class="form-group">
                    <input id="book_id" name="book_id" class="form-control" size="20" placeholder="<?php echo $this->lang->line("book id"); ?>">
                </div> 
                 <div class="form-group">
                    <input id="isbn" name="isbn" class="form-control" size="20" placeholder="<?php echo $this->lang->line("ISBN"); ?> ">
                </div>   

                <div class="form-group">
                    <input id="title" name="title" class="form-control" size="20" placeholder="<?php echo $this->lang->line("title"); ?>">
                </div>

                <div class="form-group">
                    <input id="author" name="author" class="form-control" size="20" placeholder="<?php echo $this->lang->line("author"); ?>">
                </div>   

                <div class="form-group">
                    <?php 
                      $category_info['']=$this->lang->line("book category");                      
                      echo form_dropdown('category',$category_info,"",'class="form-control" id="category"'); 
                    ?>
                </div>    
                <button class='btn btn-info'  onclick="doSearch(event)"><?php echo $this->lang->line("search"); ?></button>     

                      
            </form> 

        </div>        
    </div>
  </div>   
</section>

<script>       
    var base_url="<?php echo site_url(); ?>"
    
    function action_column(value,row,index)
    {               
        var details_url=base_url+'member/view_details/'+row.id;        
        /*var edit_url=base_url+'admin/update_book/'+row.id;
        var delete_url=base_url+'admin/delete_book_action/'+row.id;*/
        
        var str="";
        var view_permission="<?php echo $view_permission; ?>";        
        /*var edit_permission="<?php echo $edit_permission; ?>";   
        var delete_permission="<?php echo $delete_permission; ?>";*/   
        
        if(view_permission==1)     
        str="<a title='Details' style='cursor:pointer' href='"+details_url+"'>"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/magnifier.png");?>" alt="View">'+"</a>";
        
        /*if(edit_permission==1)
        str=str+"&nbsp;&nbsp;&nbsp;&nbsp;<a style='cursor:pointer' title='Update' href='"+edit_url+"'>"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/edit.png");?>" alt="Edit">'+"</a>";

        if(delete_permission == 1)
        str=str+"&nbsp;&nbsp;&nbsp;&nbsp;<a style='cursor:pointer' title='Delete' href='"+delete_url+"'>"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/close.png");?>" alt="Delete">'+"</a>";*/
        
        return str;
    }  


    function action_read(value,row,index)
    {               
         if(row.pdf!=null)
         {            
             var details_url=base_url+'admin_member/read_online/'+row.id+'/'+row.is_uploaded;
             return "<a target='_BLANK' href='"+details_url+"'><?php echo $this->lang->line('read online'); ?></a>";
         }
         else
         {
            var str = '';
            return str;
         }
    }  

    function availability_check(value,row,index)
    {
        var str = '';
        if (row.status == 1) {
            str = str+"<label class='label label-success'><?php echo $this->lang->line('available'); ?></label>"; 
        } else {
            str = str+"<label class='label label-danger'><?php echo $this->lang->line('unavailable'); ?></label>";
        }
        return str;
    }
       
           
   
    function doSearch(event)
    {
        event.preventDefault(); 
        $j('#tt').datagrid('load',{
          book_id:          $j('#book_id').val(),
          isbn:             $j('#isbn').val(),
          title:            $j('#title').val(),
          author:           $j('#author').val(),           
          category_id:      $j('#category').val(),
          is_searched:      1
        });


    }  



    

</script>
