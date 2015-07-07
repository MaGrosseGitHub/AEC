
<?php 
if(isset($img))
	echo HTML::getImg($img); 
?>
<h1>TEST</h1>

<form id = "form" action="<?php echo Router::url('cockpit/posts/test/'); ?>" method="post" enctype="multipart/form-data">
<?php
    echo $this->Form->input('title_FR','Titre <span style = "color : red;">FR</span>');	
	echo $this->Form->input('file','Image',array('type'=>'fileImg'));
?>
<button>submit</button>
</form>