<?php $this->load->view('admin/theme/message'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $this->lang->line("daily read books"); ?> </h1>

</section>

<!-- Main content -->
<section class="content">  
  <div class="row">
    <div class="col-xs-12">
        <div class="grid_container" style="width:100%; height:700px;">
            <table 
            id="tt"  
            class="easyui-datagrid" 

            url="<?php echo base_url()."admin/daily_read_material_data"; ?>" 
            
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
                    <th field="book_id" sortable="true" ><?php echo $this->lang->line("book id"); ?></th>
                    <th field="isbn" sortable="true" ><?php echo $this->lang->line("ISBN"); ?></th>
                    <th field="title" sortable="true" ><?php echo $this->lang->line("title"); ?></th> 
                    <th field="author" sortable="true" ><?php echo $this->lang->line("author"); ?></th>
                    <th field="edition" sortable="true" ><?php echo $this->lang->line("edition"); ?></th> 
                    <th field="price" sortable="true" ><?php echo $this->lang->line("price"); ?></th> 
                    <th field="no_of_times" sortable="true" ><?php echo $this->lang->line("read - number of times"); ?></th> 
                    <th field="read_at" sortable="true" ><?php echo $this->lang->line("last read at"); ?></th> 
                </tr>
            </thead>
        </table>                        
    </div>

    <div id="tb" style="padding:3px">


    <a class="btn btn-warning"  title="<?php echo $this->lang->line("add"); ?> - <?php echo $this->lang->line("daily read books"); ?>" href="<?php echo site_url('admin/add_daily_read_materials');?>">
            <i class="fa fa-plus-circle"></i> <?php echo $this->lang->line("add"); ?> 
        </a>


        <form class="form-inline" style="margin-top:20px">   

            <div class="form-group">
                <input id="book_id" name="book_id" class="form-control" size="14" placeholder="<?php echo $this->lang->line("book id"); ?>">
            </div>
             <div class="form-group">
                <input id="isbn" name="isbn" class="form-control" size="14" placeholder="<?php echo $this->lang->line("ISBN"); ?>">
            </div> 
             <div class="form-group">
                <input id="title" name="title" class="form-control" size="14" placeholder="<?php echo $this->lang->line("title"); ?>">
            </div>            

            <div class="form-group">
                <input id="author" name="author" class="form-control" size="14" placeholder="<?php echo $this->lang->line("author"); ?>">
            </div>   

            <div class="form-group">                
                <input id="edition" name="edition" class="form-control" size="14" placeholder="<?php echo $this->lang->line("edition"); ?>">
            </div> 

            <div class="form-group">
                <input id="from_date" name="from_date" class="form-control datepicker" size="14" placeholder="<?php echo $this->lang->line("from date"); ?>">
            </div>

            <div class="form-group">
                <input id="to_date" name="to_date" class="form-control  datepicker" size="14" placeholder="<?php echo $this->lang->line("to date"); ?>">             
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
   
   function doSearch(event)
   {
      event.preventDefault(); 
      $j('#tt').datagrid('load',
      {
        book_id     :     $j('#book_id').val(),
        isbn        :     $j('#isbn').val(), 
        title       :     $j('#title').val(),
        author      :     $j('#author').val(),         
        edition      :     $j('#edition').val(),         
        from_date   :     $j('#from_date').val(),    
        to_date     :     $j('#to_date').val(),         
        is_searched :      1
      });
    }   

</script>
