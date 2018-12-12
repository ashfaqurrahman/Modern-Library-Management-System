<?php $this->load->view('member/theme_member/message'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $this->lang->line("my requested books"); ?></h1>

</section>


<!-- Main content -->
<section class="content">  
  <div class="row">
    <div class="col-xs-12">
        <div class="grid_container" style="height:500px; width:100%;" >
            <table 
            id="tt"  
            class="easyui-datagrid" 
            url="<?php echo base_url()."member/requested_books_data"; ?>" 

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
                        <!-- <th field="id" checkbox="true">id</th>                         -->
                        <!-- <th field="name"  sortable="true" >Member Name</th> -->
                        <th field="book_title" sortable="true"><?php echo $this->lang->line("title"); ?></th>
                        <th field="author" sortable="true" ><?php echo $this->lang->line("author"); ?></th>                                      
                        <th field="edition" sortable="true" ><?php echo $this->lang->line("edition"); ?></th>  
                        <th field="note" sortable="true" ><?php echo $this->lang->line("notes"); ?></th>                                    
                        <th field="reply" sortable="true" ><?php echo $this->lang->line("reply"); ?></th>
                         <th field="view" formatter='action_column'><?php echo $this->lang->line("status"); ?></th>               
                    </tr>
                </thead>
            </table>                        
         </div>
  
       <div id="tb" style="padding:3px">

       <?php $this->load->view("member/theme_member/submenu"); ?>
           
              
            <form class="form-inline" style="margin-top:20px">
               
                <div class="form-group">
                    <input id="book_title" name="book_title" class="form-control" size="20" placeholder="<?php echo $this->lang->line("title"); ?>">
                </div>

                <div class="form-group">
                    <input id="author" name="author" class="form-control" size="20" placeholder="<?php echo $this->lang->line("author"); ?>">
                </div>   
                 
                <button class='btn btn-info'  onclick="doSearch(event)"><?php echo $this->lang->line("search"); ?></button>    
                      
            </form> 

        </div>        
    </div>
  </div>   
</section>


<script>       
    var base_url="<?php echo site_url(); ?>"

    function action_column(value, row, index)
    {
    	var status = row.request_status;
    	var str = "";

    	if(status == "Accepted")
    	str = str+"<label class='label label-success'>"+'<?php echo $this->lang->line("accepted"); ?>'+"</label>";    	

    	if(status == 'Pending')
    		str = str+"<label class='label label-warning'>"+'<?php echo $this->lang->line("pending"); ?>'+"</label>";

    	if(status == 'Rejected')
    		str = str+"<label class='label label-danger'>"+'<?php echo $this->lang->line("rejected"); ?>'+"</label>";

    	return str;

    }    
   
   
    function doSearch(event)
    {
        event.preventDefault(); 
        $j('#tt').datagrid('load',{        
          book_title:       $j('#book_title').val(),
          author:           $j('#author').val(),           
          is_searched:      1
        });


    }  
    

</script>
