<?php $this->load->view('admin/theme/message'); ?>

<?php
    if($this->session->userdata('book_isbn_file_name')==1)
    {
        echo "<div class='alert alert-success text-center'><h4 style='margin:0;'>";
        echo "<i class='fa fa-check-circle'></i>".$this->lang->line("your data has been successfully stored into the database.")."</h4><br/>";
        echo "<h4 style='margin:0;'><a class='btn btn-lg' onClick=\"print_barcode('#div_for_print_book_ids')\">".$this->lang->line("print catalog")." <i class='fa fa-print'></i></a></h4></div>";
        $this->session->unset_userdata('book_isbn_file_name');
    } 
        $view_permission    = 1;
        $edit_permission    = 1;
        $delete_permission  = 1;
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1> <?php echo $this->lang->line("book"); ?> </h1>

</section>
<div id="div_for_print_book_ids" style="display:none;"><?php if(isset($book_ids)) echo $book_ids; ?></div>

<!-- Main content -->
<section class="content">  
  <div class="row">
    <div class="col-xs-12">
        <div class="grid_container" style="width:100%; height:557px;">
            <table 
            id="tt"  
            class="easyui-datagrid" 
            url="<?php echo base_url()."admin/book_list_data"; ?>" 
            
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
                        <th field="id" checkbox="true"><?php echo $this->lang->line("ID"); ?></th>                        
                        <th field="book_id_field" formatter='book_id_show'><?php echo $this->lang->line("book id"); ?></th>                        
                        <th field="isbn"  sortable="true" ><?php echo $this->lang->line("ISBN"); ?></th>
                        <th field="status"  formatter="availability_check"><?php echo $this->lang->line("availability"); ?></th>
                        <th field="title" sortable="true" ><?php echo $this->lang->line("title"); ?></th>
                        <th field="author" sortable="true" ><?php echo $this->lang->line("author"); ?> </th>
                        <th field="edition" sortable="true" ><?php echo $this->lang->line("edition"); ?> </th>
                        <th field="edition_year" sortable="true" ><?php echo $this->lang->line("edition Year"); ?> </th>
                        <th field="add_date" sortable="true" ><?php echo $this->lang->line("add date"); ?> </th>
                        <th field="pdf" formatter="action_read" ><?php echo $this->lang->line("read Online"); ?> </th>                  
                        <th field="view" formatter='action_column'><?php echo $this->lang->line("actions"); ?></th>                    
                    </tr>
                </thead>
            </table>                        
         </div>
  
       <div id="tb" style="padding:3px">
       
            <?php $this->load->view('admin/submenu_book'); ?> 
              
            <form class="form-inline" style="margin-top:20px"  enctype="multipart/form-data">

                <div class="form-group">
                    <input id="book_id" name="book_id" class="form-control" size="15" placeholder="<?php echo $this->lang->line("book id"); ?>">
                </div>

                <div class="form-group">
                    <input id="isbn" name="isbn" class="form-control" size="15" placeholder="<?php echo $this->lang->line("ISBN"); ?>">
                </div>  

                <div class="form-group">
                    <input id="title" name="title" class="form-control" size="15" placeholder="<?php echo $this->lang->line("title"); ?>">
                </div>

                <div class="form-group">
                    <input id="author" name="author" class="form-control" size="15" placeholder="<?php echo $this->lang->line("author"); ?>">
                </div>   

                <div class="form-group">
                    <?php 
                      $category_info['']=$this->lang->line("book category");                     
                      echo form_dropdown('category',$category_info,"",'class="form-control" id="category"'); 
                    ?>
                </div>   

                <div class="form-group">
                    <input id="from_date" name="from_date" class="form-control datepicker" size="15" placeholder="<?php echo $this->lang->line("from date"); ?>">
                </div>

                <div class="form-group">
                    <input id="to_date" name="to_date" class="form-control  datepicker" size="15" placeholder="<?php echo $this->lang->line("to date"); ?>">
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
        var details_url=base_url+'admin/view_details/'+row.id;        
        var edit_url=base_url+'admin/update_book/'+row.id;
        var delete_url=base_url+'admin/delete_book_action/'+row.id;
        
        var str="";
        var view_permission="<?php echo $view_permission; ?>";        
        var edit_permission="<?php echo $edit_permission; ?>";   
        var delete_permission="<?php echo $delete_permission; ?>";   
        
        if(view_permission==1)     
        str="<a title='"+'<?php echo $this->lang->line("view") ?>'+"' style='cursor:pointer' href='"+details_url+"'>"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/magnifier.png");?>" alt="View">'+"</a>";
        
        if(edit_permission==1)
        str=str+"&nbsp;&nbsp;&nbsp;&nbsp;<a style='cursor:pointer' title='"+'<?php echo $this->lang->line("edit") ?>'+"' href='"+edit_url+"'>"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/edit.png");?>" alt="Edit">'+"</a>";

        if(delete_permission == 1)
        str=str+"&nbsp;&nbsp;&nbsp;&nbsp;<a style='cursor:pointer' title='"+'<?php echo $this->lang->line("delete") ?>'+"' href='"+delete_url+"'>"+' <img src="<?php echo base_url("plugins/grocery_crud/themes/flexigrid/css/images/close.png");?>" alt="Delete">'+"</a>";
        
        return str;
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

    function action_read(value,row,index)
    {               
         if(row.pdf!=null)
         {   
            var base_url = "<?php echo base_url(); ?>";         
            var details_url = base_url+'admin_member/read_online/'+row.id+'/'+row.is_uploaded;
            return "<a  target='_BLANK' href='"+details_url+"'><i class='fa fa-file'></i> <?php echo $this->lang->line('read online'); ?></a>";
         }
         else
         {
            var str = '';
            return str;
         }
    } 

    function book_id_show(value, row, index)
    {
        var book_id = row.id;
        return book_id;
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
          from_date:        $j('#from_date').val(),
          to_date:          $j('#to_date').val(),
          is_searched:      1
        });


    }  

    $('#barcode').click(function(){
        var url = "<?php echo site_url('admin/barcode_generate');?>";
        var rows = $j("#tt").datagrid("getSelections");
        var info=JSON.stringify(rows); 
        if(rows == '')
        {
            alert("<?php echo $this->lang->line('you haven\'t select any book'); ?>");
            return false;
        }
        $.ajax({
            type:'POST',
            url:url,
            data:{info:info},
            success:function(response){
                $('#for_barcode_display').html(response);                
                // $('#print_barcode').show();
                docw();
                setTimeout(function(){PrintElem('#for_barcode_display')}, 2000);
            }
        });
    });

    function docw() { 
        var doct = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">"; 
        document.write(doct + document.getElementsByTagName('html')[0].innerHTML); 
    }

    // print section for search generated barcode
    function PrintElem(elem) 
    { 
        Popup($(elem).html());
    } 

    function Popup(data) 
    { 
        $('#print_barcode').hide();
        var mywindow = window.open('', 'for_barcode_display', 'height=562,width=795'); 
        mywindow.document.write('<html><head>'); 
        // mywindow.document.write('<style> table.print_slip tbody td {border:1px solid #ccc; }</style>'); 
        mywindow.document.write('</head><body >'); 
        mywindow.document.write(data); 
        mywindow.document.write('</body></html>'); 
        mywindow.document.close(); 
        mywindow.print(); 
        return true; 
    } 
    // end of print section for search generated barcode

    //print section for add_book
    function print_barcode(elem) 
    { 
        popup($(elem).html()); 
    } 

    function popup(data) 
    { 

        var mywindow = window.open('', 'print_details', 'height=562,width=795'); 
        mywindow.document.write('<html><head>'); 
        // mywindow.document.write('<style> table.print_slip tbody td {border:1px solid #ccc; }</style>'); 
        mywindow.document.write('</head><body >'); 
        mywindow.document.write(data); 
        mywindow.document.write('</body></html>'); 
        mywindow.document.close(); 
        mywindow.print(); 
        return true; 
    } 
    //end of print section for add_book

   

    $("#import_book_btn").click(function(){
        $("#text_upload_modal").modal();
        }); 

//Section for upload CSV.*********************************

    $(document.body).on('click','#pull_data',function(){
      
      var site_url="<?php echo site_url();?>";
      var queryString = new FormData($("#csv_import_form")[0]);   
      var fileval=$("#csv_file").val();

      if(fileval == '')
        alert("Please select a file");
      else{
        $.ajax({
            url: site_url+'admin/import_book_action_ajax',
            type: 'POST',
            data: queryString,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success:function(response){ 
                alert(response);                  
                   
            }
        });

      }  
        
    });
//End of Section for upload CSV.*********************************

    
</script>

<!-- Start Modal For CSV Upload. -->
<div id="text_upload_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&#215;</span>
                </button>
                <h4 id="new_search_details_title" class="modal-title"><i class="fa fa-cloud-upload"></i> Import Book from CSV</h4>
            </div><br/>


            <div class="modal-body">
                <form  class="form-inline" enctype="multipart/form-data" id="csv_import_form" style="margin-bottom:10px;">                              
                        <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <input type="file" name="csv_file" id="csv_file" value="<?php echo set_value('csv_file'); ?>"/>                   
                        </div>                  
                </form>

                
                <button class='btn btn-success'  id = "pull_data"><i class="fa fa-upload"></i> Upload File</button>         
              
                <br/>
                <br/>
                <br/>
                <br/><span ><a target="_BLANK" class="btn btn-sm btn-primary" href="<?php echo base_url("assets/sample/book_import_sample.csv"); ?>"><i class="fa fa-cloud-download"></i> Download Sample CSV</a></span> 
                (Open with text editor to view original formatting)

           
            </div>   
        </div>
    </div>
</div>

<!-- End Modal For CSV   Upload. -->

