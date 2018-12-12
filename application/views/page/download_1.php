<meta charset="UTF-8">
<?php 
if($file_name!="")
{
	echo "<a href='".base_url().$file_name."' title='".$this->lang->line("download")."'>".$this->lang->line("click here to download")."</a>";
}
?>