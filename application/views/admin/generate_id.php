<?php $this->load->view('admin/theme/message'); ?>



<section class="content-header">
  <h1> <?php echo $this->lang->line("generate member ID"); ?> </h1>

</section>
<!-- <div id="div_for_print_book_ids" style="display:none;"><?php if(isset($book_ids)) echo $book_ids; ?></div> -->

<!-- Main content -->
<section class="content">  
  <div class="row">
    <div class="col-xs-12">
        <div class="grid_container" style="width:100%; height:700px;">
            <table 
            id="tt"  
            class="easyui-datagrid" 
            url="<?php echo base_url()."admin/generate_id_data"; ?>" 
            
            pagination="true" 
            rownumbers="true" 
            toolbar="#tb" 
            pageSize="10" 
            pageList="[5,10,20,50,100]"  
            fit= "true" 
            fitColumns= "true" 
            fitRows = "true"
            nowrap= "true" 
            view= "detailview"
            idField="id"
            >
           
            
                <thead>
                    <tr>
                        <th field="idd" sortable="true"><?php echo $this->lang->line("ID"); ?></th>
                        <th field="id" checkbox="true"><?php echo $this->lang->line("ID"); ?></th>                           
                        <th field="name"  sortable="true" ><?php echo $this->lang->line("name"); ?></th> 
                        <th field="member_idd"  sortable="true" ><?php echo $this->lang->line("member id"); ?></th>                        
                        <th field="user_type" sortable="true" ><?php echo $this->lang->line("user type"); ?></th>
                        <th field="type_id" sortable="true" ><?php echo $this->lang->line("member types"); ?> </th>
                        <th field="email" sortable="true" ><?php echo $this->lang->line("email"); ?> </th>
                        <th field="mobile" sortable="true" ><?php echo $this->lang->line("mobile"); ?> </th>                    
                        <th field="address" sortable="true" ><?php echo $this->lang->line("address"); ?> </th>                  
                        <th field="add_date" sortable="true" ><?php echo $this->lang->line("add date"); ?> </th>                  
                        <th field="status" formatter="status_check" ><?php echo $this->lang->line("status"); ?> </th>
                    </tr>
                </thead>
            </table>                        
         </div>
  
       <div id="tb" style="padding:3px">
       
            <?php $this->load->view('admin/submenu_id'); ?> 

             
              
            <form class="form-inline" style="margin-top:20px"  enctype="multipart/form-data">

                <div class="form-group">
                    <input id="name" name="name" class="form-control" size="15" placeholder="<?php echo $this->lang->line("name"); ?>">
                </div>

                <div class="form-group">
                    <input id="member_idd" name="member_idd" class="form-control" size="15" placeholder="<?php echo $this->lang->line("member id"); ?>">
                </div> 

                <div class="form-group">
                    <input id="type_id" name="type_id" class="form-control" size="15" placeholder="<?php echo $this->lang->line("member types"); ?>">
                </div>

                <div class="form-group">
                    <input id="email" name="email" class="form-control" size="15" placeholder="<?php echo $this->lang->line("email"); ?>">
                </div>

                <div class="form-group">
                    <input id="mobile" name="mobile" class="form-control" size="15" placeholder="<?php echo $this->lang->line("mobile"); ?>">
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

    var base_url="<?php echo site_url(); ?>";    
     

    function status_check(value,row,index)
    {
        var str = '';
        if (row.status == '1') {
            str = str+"<label class='label label-success'><?php echo $this->lang->line('Active'); ?></label>"; 
        } else {
            str = str+"<label class='label label-danger'><?php echo $this->lang->line('Inactive'); ?></label>";
        }
        return str;
    }
           
 
    function doSearch(event)
    {
        event.preventDefault(); 
        $j('#tt').datagrid('load',{
          name:          $j('#name').val(),
          type_id:             $j('#type_id').val(),
          email:            $j('#email').val(),
          mobile:           $j('#mobile').val(),         
          from_date:        $j('#from_date').val(),
          to_date:          $j('#to_date').val(),
          is_searched:      1
        });


    }  

    $('#barcode').click(function(){
        var url = "<?php echo site_url('admin/barcode_generate_id');?>";
        var rows = $j("#tt").datagrid("getSelections");
        var info=JSON.stringify(rows); 
        if(rows == '')
        {
            alert("<?php echo $this->lang->line('you did not select any member'); ?>");
            return false;
        }
        $('#barcode').html("<?php $url=base_url('assets/pre-loader/Fading squares.gif'); echo '<img src=\"'.$url.'\">'; ?>");
        $.ajax({
            type:'POST',
            url:url,
            data:{info:info},
            success:function(response){
                $('#barcode').html("<i class='fa fa-barcode'></i> <?php echo $this->lang->line('generate member ID'); ?>");
                $('#for_barcode_display').html(response);
                docw();
                setTimeout(function(){PrintElem('#for_barcode_display')}, 2000);
                // $('#print_barcode').show();
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
                <h4 id="new_search_details_title" class="modal-title"><i class="fa fa-binoculars"></i> CSV Upload</h4>
            </div><br/>


            <div>
                <form  class="form-inline" enctype="multipart/form-data" id="csv_import_form" style="margin-bottom:10px;">                              
                        <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <input type="file" name="csv_file" id="csv_file" value="<?php echo set_value('csv_file'); ?>"/>                   
                        </div>                  
                </form>

                
            <button class='btn btn-success'  id = "pull_data"><i class="fa fa-upload"></i> Upload File</button>         
              

            <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5 clearfix">
                <br/><span ><a target="_BLANK" class="btn btn-sm btn-primary" href="<?php echo base_url("assets/sample/book_import_sample.csv"); ?>"><i class="fa fa-cloud-download"></i> Download Sample CSV</a></span> 
                <br/>(Open with text editor)

            </div>
            </div>          

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- End Modal For CSV   Upload. -->
