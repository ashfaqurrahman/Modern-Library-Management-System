<?php //if(in_array(2,$this->role_module_accesses_2)): ?>
<a class="btn btn-warning"  title="<?php echo $this->lang->line("add"); ?> - <?php echo $this->lang->line("book"); ?>" href="<?php echo site_url('admin/add_book');?>">
    <i class="fa fa-plus-circle"></i> <?php echo $this->lang->line("add"); ?>
</a>
<a class="btn btn-warning pull-right" id="print_barcode" onClick="PrintElem('#for_barcode_display')" title="<?php echo $this->lang->line("print catalog"); ?>" style="display:none;margin-left:5px;">
    <i class="fa fa-print"></i> <?php echo $this->lang->line("print catalog"); ?>
</a>

<!-- <a class="btn btn-success pull-right" id="barcode"  title="<?php echo $this->lang->line("generate catalog"); ?>">
    <i class="fa fa-barcode"></i> <?php echo $this->lang->line("generate catalog"); ?>
</a> -->

<a class="btn btn-primary pull-right" id="import_book_btn"  title="Import" style = 'margin-right:10px'>
    <i class="fa fa-upload"></i> Import Book - CSV
</a>

<div id="for_barcode_display" style="display:none;">
</div>
<?php //endif; ?>