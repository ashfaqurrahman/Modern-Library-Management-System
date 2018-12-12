
 <?php $this->load->view('admin/theme/message'); ?>
<?php
        if($this->session->userdata('logged_in')!=1)
        redirect('home/index','location');
 ?>

 <?php
    // if(in_array(3,$this->role_module_accesses_2))  
    $edit_permission=1;
    $view_permission=1;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> Packages </h1>

</section>


<!-- Main content -->
<section class="content">  
  <div class="row">
    <div class="col-xs-12">
        <div style="width:100%;height:500px;">
            <table 
            id="tt"  
            class="easyui-datagrid" 
            url="<?php echo base_url()."teacher/packages_data"; ?>" 
            
            pagination="true" 
            rownumbers="true" 
            toolbar="#tb" 
            pageSize="10" 
            pageList="[5,10,20,50,100]"  
            fit= "false" 
            fitColumns= "false" 
            nowrap= "true" 
            view= "detailview"
            idField="id"
            >
            
                <thead>
                    <tr>
                        <th field="id" checkbox="true"></th>                        
                        <th field="name"  sortable="true" >Name</th>
                        <th field="domain_name" sortable="true" >Domain Name</th>
                        <th field="domain_reg_date" sortable="true" >Domain Registration Date</th>
                        <th field="domain_expire_date"    sortable="true">Domain Expire Date</th>
                        <th field="hosting_package" sortable="true" >Hosting Package</th>
                        <th field="hosting_reg_date" sortable="true" >Hosting Registration Date</th> 
                        <th field="hosting_expire_date" sortable="true" >Hosting Expire Date</th> 
                        <th field="mobile" sortable="true" >Mobile No.</th> 
                        <th field="amount" sortable="true" >Amount</th> 
                        <th field="view" formatter='action_column'>Actions</th>              
                                                      
                    </tr>
                </thead>
            </table>                        
         </div>
  
       <div id="tb" style="padding:3px">
            <?php $this->load->view('admin/user/submenu'); ?> 

            <a class="btn btn-warning"  title="Manage Package" href="<?php echo site_url().'teacher/manage_package';?>">
                <i class="fa fa-plus-circle"></i> Manage Package
            </a> 
           
            <form class="form-inline" style="margin-top:20px">
                <div class="form-group">
                    <input  id="search_name" name="search_name" class="form-control" size="20" placeholder="Name" >
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
        var details_url=base_url+'teacher/view_details/'+row.id;        
        var edit_url=base_url+'teacher/renew_package/'+row.id;
        
        var str="";
        var view_permission="<?php echo $view_permission; ?>";        
        var edit_permission="<?php echo $edit_permission; ?>";   
        
        if(view_permission==1)     
        str="<a title='Details' target='_blank' style='cursor:pointer' href='"+details_url+"'>"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/magnifier.png");?>" alt="View">'+"</a>";
        
        if(edit_permission==1)
        str=str+"&nbsp;&nbsp;&nbsp;&nbsp;<a target='_blank' style='cursor:pointer' title='Update' href='"+edit_url+"'>"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/edit.png");?>" alt="Edit" >'+"</a>";
        
        return str;
    }  
    

           
   
    function doSearch(event)
    {        
        event.preventDefault(); 
        $j('#tt').datagrid('load',{
          search_name:             $j('#search_name').val(),
          is_searched:      1
        });
    }  

</script>
