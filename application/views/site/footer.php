 
    <div class="container-fluid white footer">
    <div class="row footer-container copyright-row">
      <div style="text-align: center;" class="col-xs-12  clearfix">          
         <?php echo $this->config->item("product_name").$this->config->item("product_version").' - <a target="_BLANK" href="'.site_url().'"><b>'.$this->config->item("institute_address1").'</b></a>'; ?>
      </div>
    </div><!-- end row -->
    </div><!-- end container -->

  <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.js'></script>
  <script type='text/javascript' src='<?php echo base_url();?>assets/js/bootstrap.min.js'></script>
</body>
</html>
