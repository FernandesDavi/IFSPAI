<?php
	$this->assign('title','BANCOTCCDAVI | Home');
	$this->assign('nav','home');

	$this->display('_Header.tpl.php');
?>

	<div class="modal hide fade" id="getStartedDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>Getting Started With Phreeze</h3>
		</div>
		
		<div class="modal-footer">
			<button id="okButton" data-dismiss="modal" class="btn btn-primary">Let's Rock...</button>
		</div>
	</div>

	<div class="container">

		
	</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>