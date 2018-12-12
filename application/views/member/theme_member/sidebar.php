<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->  
  
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">  

      <li><a href="<?php echo site_url()."member/member_book_list"; ?>"><i class="fa fa-list"></i> <span><?php echo $this->lang->line("book"); ?></span></a></li>      
      <li><a href="<?php echo site_url()."member/member_circulation"; ?>"><i class="fa fa-retweet"></i> <span><?php echo $this->lang->line("my circulation history"); ?></span></a></li>      
      <li><a href="<?php echo site_url()."member/requested_books"; ?>"><i class="fa fa-book"></i><span><?php echo $this->lang->line("my requested books"); ?></span></a></li>
      <li><a href="<?php echo site_url()."member/sms_email_history"; ?>"><i class="fa fa-envelope"></i><span><?php echo $this->lang->line("my notifications"); ?></span></a></li>
 
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>