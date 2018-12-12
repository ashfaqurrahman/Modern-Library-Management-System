


<?php $this->load->view('admin/theme/message'); ?>
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
  <h1> Library </h1>

</section>


<!-- Main content -->
<section class="content">  
  <div class="row">
    <div class="col-xs-12">
        <div class="grid_container">
            <table 
            id="tt"  
            class="easyui-datagrid" 
            url="<?php echo base_url()."admin/add_book"; ?>" 
            
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
                        <th field="id" checkbox="true">id</th>                        
                        <th field="isbn"  sortable="true" >ISBN</th>
                        <th field="title" sortable="true" >Title</th>
                        <th field="author" sortable="true" >Author</th>
                        <th field="publisher" sortable="true">Publisher</th>                     
                        <th field="view" formatter='action_column'>Actions</th>                    
                    </tr>
                </thead>
            </table>                        
         </div>
  
       <div id="tb" style="padding:3px">
            <?php $this->load->view('admin/theme/submenu'); ?> 

              
            <form class="form-inline" style="margin-top:20px">
                <div class="form-group">
                    <input id="isbn" name="isbn" class="form-control" size="20" placeholder="ISBN">
                </div>   

                <div class="form-group">
                    <input id="title" name="title" class="form-control" size="20" placeholder="Title">
                </div>

                <div class="form-group">
                    <input id="author" name="author" class="form-control" size="20" placeholder="Author">
                </div>   

                <div class="form-group">
                    <?php 
                      $category_info['']='Category';                     
                      echo form_dropdown('category',$category_info,"",'class="form-control" id="category"'); 
                    ?>
                </div>    
                <button class='btn btn-info'  onclick="doSearch(event)">Search</button>     

                      
            </form> 

        </div>        
    </div>
  </div>   
</section>


<script>       
    var base_url="<?php echo site_url(); ?>"
    
    function action_column(value,row,index)
    {               
        var details_url=base_url+'admin/view_details/'+row.id;        
        var edit_url=base_url+'admin/update_book/'+row.id;
        var delete_url=base_url+'admin/delete_book_action/'+row.id;
        
        var str="";
        var view_permission="<?php echo $view_permission; ?>";        
        var edit_permission="<?php echo $edit_permission; ?>";   
        var delete_permission="<?php echo $delete_permission; ?>";   
        
        if(view_permission==1)     
        str="<a title='Details' style='cursor:pointer' href='"+details_url+"'>"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/magnifier.png");?>" alt="View">'+"</a>";
        
        if(edit_permission==1)
        str=str+"&nbsp;&nbsp;&nbsp;&nbsp;<a style='cursor:pointer' title='Update' href='"+edit_url+"'>"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/edit.png");?>" alt="Edit">'+"</a>";

        if(delete_permission == 1)
        str=str+"&nbsp;&nbsp;&nbsp;&nbsp;<a style='cursor:pointer' title='Delete' href='"+delete_url+"'>"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/close.png");?>" alt="Delete">'+"</a>";
        
        return str;
    }  
           
   
    function doSearch(event)
    {
        event.preventDefault(); 
        $j('#tt').datagrid('load',{
          isbn:             $j('#isbn').val(),
          title:            $j('#title').val(),
          author:           $j('#author').val(),           
          category_id:      $j('#category').val(),
          is_searched:      1
        });


    }  
    

</script>
