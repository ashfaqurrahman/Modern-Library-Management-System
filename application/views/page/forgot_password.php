<br>
<style>#recovery_form{text-align:center;}</style>
<style>#wait{padding-top:20px;padding-left:10px;}</style>

  <div class="row ">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 border_gray grid_content padded background_white">
    <h6 class="column-title"><i class="fa fa-key fa-2x blue"> <?php echo $this->lang->line("password recovery"); ?></i></h6>
    <div class="account-wall" id='recovery_form'> 
        <div class="form-group">
           <div id='msg'></div>
           <label class="col-xs-12" style="margin-left:0;padding-left:0;"><?php echo $this->lang->line("enter your email"); ?></label>
           <input type="email" class="form-control col-xs-12" id="email" placeholder="<?php echo $this->lang->line("enter your email"); ?>">          
        </div>
        <div class="form-group">
          <button type="button" id="submit" style="margin-top:20px" class="btn btn-warning btn-lg"><?php echo $this->lang->line("send recovery data"); ?></button>
          <span id='wait' ></span>  
        </div>      
    </div>
  </div>
  </div>



<script type="text/javascript">
$('document').ready(function(){
  $("#submit").click(function(){
    $("#msg").removeAttr('class');
    $("#msg").html("");

    var email=$("#email").val();
    if(email=='')
    {
      $("#msg").attr('class','alert alert-warning');
      $("#msg").html("<?php echo $this->lang->line('please enter an email address')?>");
    }
    else
    {
      $("#wait").html("<img src='<?php echo site_url();?>assets/pre-loader/Ovals in circle.gif' height='20' width='20'>");
      $.ajax({
        type:'POST',
        url: "<?php echo site_url();?>home/code_genaration",
        data:{email:email},
        success:function(response){
          $("#wait").html("");
          if(response=='0')
          {
            $("#msg").attr('class','alert alert-danger');
            $("#msg").html("<?php echo $this->lang->line('this email is not associated with any member');?>");
          }
          else
          {
            var string="<div class='well'>"+ 
              "<p>"+
                "<?php echo $this->lang->line('an email containing a url and a password recovery code is sent to your email'); ?><br>"+
                "<?php echo $this->lang->line('check your inbox and perform the following steps'); ?>:"+
              "</p>"+
              "<ol>"+
                "<li><?php echo $this->lang->line('go to the provided url'); ?></li>"+
                "<li><?php echo $this->lang->line('enter the provided code'); ?></li>"+
                "<li><?php echo $this->lang->line('reset your password'); ?></li>"+
              "</ol>"+
              "<h4><?php echo $this->lang->line('link and code will expire after 24 hours'); ?></h4>"+
            "</div>";
            $("#recovery_form").slideUp();
            $("#recovery_form").html(string);
            $("#recovery_form").slideDown();
          }
      }
      });
    }
  });
});
</script>

