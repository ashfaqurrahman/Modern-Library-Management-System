<section class="content-header">
  <section class="content">
    <div class="box box-info custom_box">
      <div class="box-header">
        <h3 class="box-title">
          <i class="fa fa-retweet"></i>          
          </i>
          <?php echo $this->lang->line("current circulation"); ?> - <?php if(isset($member_name)) echo $this->lang->line("member")." : ".$member_name; ?>
        </h3>
      </div>
      <div class="box-body" id="display_div">
      
        <?php 
        $currency = $this->config->item('currency');
      
        $temp = count($info); // variable $temp is the number of total entries in single fetch comes from database.
         echo "<table style='width:100%'class='table table-bordered table-zebra table-hover table-stripped background_white'>
          <tr>           
           
            <th>".$this->lang->line("book id")."</th>
            <th>".$this->lang->line("title")."</th>
            <th>".$this->lang->line("author")."</th>
            <th>".$this->lang->line("issue date")."</th>
            <th>".$this->lang->line("expiry date")."</th>           
            <th>".$this->lang->line("fine")." - {$currency}</th>    
            <th>".$this->lang->line("return")."</th>  
            
                     
          </tr>";

          /* $i is the number of entries from database. starts with 0. and limit is less than total number of entries of database. because i starts from 0 */

          for($i=0;$i<$temp;$i++)            
          { 
           
            $first_par = $info[$i]['circulation_id'];
            $second_par =$info[$i]['member_id'];  

            $return_date = date('Y-m-d');

            if(strtotime($return_date) > strtotime($info[$i]['expire_date']))
            {
                 $diff = abs(strtotime($return_date) - strtotime($info[$i]['expire_date']));
                 $years = floor($diff / (365*60*60*24));
                 $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                 $fine_amount = $fine_per_day*$days;
            }

            else 
              $fine_amount = 0;

                 


            echo "<tr id='tr_{$first_par}' class = 'display_row'>"; 

              echo "<td>"; 
                if (isset($info[$i]['book_id'])) 
                {
                  if(strlen($info[$i]['book_id'])>30)
                  echo substr($info[$i]['book_id'], 0, 30)."...";
                  else echo $info[$i]['book_id'];
                }          
              echo "</td>";

              echo "<td>";
               if (isset($info[$i]['title'])) 
                  {
                    echo $info[$i]['title'];                    
                  }
              echo "</td>";

              echo "<td>";
               if (isset($info[$i]['author'])) 
                  {
                    echo $info[$i]['author'];                    
                  }
              echo "</td>";

              echo "<td>"; 
                if (isset($info[$i]['issue_date'])) 
                {
                  if(strlen($info[$i]['issue_date'])>30)
                  echo substr($info[$i]['issue_date'], 0, 30)."...";
                  else echo $info[$i]['issue_date'];
                }          
              echo "</td>"; 

              echo "<td>";
               if (isset($info[$i]['expire_date'])) 
                  {
                    echo $info[$i]['expire_date'];                    
                  }
              echo "</td>"; 
             

              echo "<td>";
               if (isset($info[$i]['fine_amount'])) 
                  {
                    echo $fine_amount;                    
                  }
              echo "</td>";


              echo "<td>";
              if (isset($info[$i]['is_returned'])  && $info[$i]['is_returned'] == "0")
                {
                  
                  $temp_url = site_url('librarian/update_circulation')."/".$first_par."/".$second_par;
                  echo "<a id='return_{$first_par}' class='btn btn-warning return'>
                  <i class='fa fa-reply'></i> ".$this->lang->line("return")."
                </a>";             

               } 
              else echo "yes"; 
              echo "</td>";

                     
            echo "</tr>";          
          }          
          echo "</table>";
         $show_flag = 'block';
       
          if($book_limit!=0)
          {
            if($temp<$book_limit)
              $show_flag = 'block';
            else
              $show_flag = 'none';
          }
               
    ?> 

   <br/>
      <button type="button" class="btn btn-warning btn-lg" id = "new_issue_btn" data-toggle="modal" data-target="#myModal" style = "display:<?php echo $show_flag;?>"> <?php echo $this->lang->line("new issue"); ?></button> 
      
  
 
</div>
</section>
</section>







<script type="text/javascript">
  
$j("document").ready(function(){
  var temp = "<?php echo $temp; ?>";
  var book_limit = "<?php echo $book_limit; ?>";

  $(document.body).on('click','.return',function(){

    var id=$(this).attr('id');
    var id_sep=[];
    id_sep=id.split("_");
    var id=id_sep[1];
    
    var ans=confirm("<?php echo $this->lang->line('are you sure')?>");
    if(!ans){
      return false;
    }

    // alert(id);
    // return false;

    var base_url="<?php echo base_url(); ?>";
    $.ajax({
      type:'POST',
      url: base_url+"librarian/update_circulation",
      data:{id:id},
      success:function(response){
        $("#tr_"+id).hide();
        temp--;
        if(book_limit!=0)
        {
          
          if(temp<book_limit)
            $('#new_issue_btn').show();
          else
            $('#new_issue_btn').hide();
        }

        else
        {

          $('#new_issue_btn').show();
        }
        

        $("#book_preview").hide();

      }

    });



  });

  $("#new_issue_submit").click(function(){
   
    var base_url="<?php echo base_url(); ?>";

    $.ajax({
      type:'POST',
      url: base_url+"librarian/new_issue_action",
      data:{book_id   :   $("#book_id").val()},
      success:function(response){
         temp++;
         if(book_limit !=0)
         {

          if(temp<book_limit)
            $('#new_issue_btn').show();
          else
            $('#new_issue_btn').hide();
         }

        if(response == 'unavail')
        {
          $('#new_issue_btn').show();         
          alert('<?php echo $this->lang->line("sorry ! this book is not available right now");?>');
        }
        else
        {
           if(response == '0')
             alert("<?php echo $this->lang->line('sorry! this user can not be issued another book')?>");
          else        
            $("#display_div tr:first").after(response); 
        }

         

      }

    });

   

  });




  });


</script>