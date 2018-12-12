<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->  
  
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      
      <li><a href="<?php echo site_url()."librarian/dash_board"; ?>"><i class="fa fa-tachometer"></i><span><?php echo $this->lang->line('dashboard');?></span></a></li>
      
      <!-- <li><a href="<?php echo site_url()."admin_config"; ?>"><i class="fa fa-cogs"></i><span><?php echo $this->lang->line('general settings');?></span></a></li> -->
    
          <li><a href="<?php echo site_url()."librarian/book_list"; ?>"><i class="fa fa-book"></i> <span><?php echo $this->lang->line('book');?></span></a></li>

      
          <li><a href="<?php echo site_url()."librarian/config_member"; ?>"><i class="fa fa-group"></i> <span><?php echo $this->lang->line('member');?></span></a></li>
      

      

      <!-- <li class="treeview">
        <a href="#">
          <i class="fa fa-retweet"></i>
          <span><?php echo $this->lang->line('circulation');?></span>
          <i class="fa fa-angle-left pull-right"></i>
        </a> 
        <ul class="treeview-menu">     
           <li><a href="<?php echo site_url()."librarian/config_circulation"; ?>"><i class="fa fa-cog"></i><span><?php echo $this->lang->line('circulation settings');?></span></a></li> -->
           <li><a href="<?php echo site_url()."librarian/circulation"; ?>"><i class="fa fa-exchange"></i> <span><?php echo $this->lang->line('issue & return');?></span></a></li>
        <!-- </ul>
      </li> --> 

      <!-- <li class="treeview">
        <a href="#">
          <i class="fa fa-bell"></i>
          <span><?php echo $this->lang->line('notification');?></span>
          <i class="fa fa-angle-left pull-right"></i>
        </a> 
        <ul class="treeview-menu">
          <li><a href="<?php echo site_url()."admin_config_sms/index"; ?>"><i class="fa fa-envelope"></i> <span><?php echo $this->lang->line('SMS settings');?></span></a></li>
          <li><a href="<?php echo site_url()."admin_config_email/index"; ?>"><i class="fa fa-envelope-o"></i> <span><?php echo $this->lang->line('email SMTP settings');?></span></a></li> -->
          <li><a href="<?php echo site_url()."remind/index"; ?>"><i class="fa fa-clock-o"></i> <span> <?php echo $this->lang->line('notify delayed members');?></span></a></li>
        <!-- </ul>
      </li> -->
      

      <li><a href="<?php echo site_url()."librarian/daily_read_material"; ?>"><i class="fa fa-folder-open"></i> <span><?php echo $this->lang->line('daily read books');?></span></a></li>
      <li><a href="<?php echo site_url()."librarian/requested_books"; ?>"><i class="fa  fa-inbox"></i> <span><?php echo $this->lang->line('requested books');?></span></a></li>
    

      <!-- <li class="treeview">
        <a href="#">
          <i class="fa fa-file-pdf-o"></i>
          <span><?php echo $this->lang->line('Report');?></span>
          <i class="fa fa-angle-left pull-right"></i>
        </a> 
        <ul class="treeview-menu">
          <li><a href="<?php echo site_url()."report/index"; ?>"><i class="fa fa-money"></i> <span><?php echo $this->lang->line('fine report');?></span></a></li>
          <li><a href="<?php echo site_url()."report/notification_report"; ?>"><i class="fa fa-envelope-o"></i> <span><?php echo $this->lang->line('notification report');?></span></a></li>         
        </ul>
      </li> -->

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>