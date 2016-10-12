<?php
	$this->assign('title','BANCOTCCDAVI | Sugestoeses');
	$this->assign('nav','sugestoeses');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/sugestoeses.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Sugestoeses
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="sugestoesCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdSug">Id Sug<% if (page.orderBy == 'IdSug') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Sugestoes">Sugestoes<% if (page.orderBy == 'Sugestoes') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdRespSug">Id Resp Sug<% if (page.orderBy == 'IdRespSug') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idSug')) %>">
				<td><%= _.escape(item.get('idSug') || '') %></td>
				<td><%= _.escape(item.get('sugestoes') || '') %></td>
				<td><%= _.escape(item.get('idRespSug') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="sugestoesModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idSugInputContainer" class="control-group">
					<label class="control-label" for="idSug">Id Sug</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idSug"><%= _.escape(item.get('idSug') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="sugestoesInputContainer" class="control-group">
					<label class="control-label" for="sugestoes">Sugestoes</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="sugestoes" placeholder="Sugestoes" value="<%= _.escape(item.get('sugestoes') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idRespSugInputContainer" class="control-group">
					<label class="control-label" for="idRespSug">Id Resp Sug</label>
					<div class="controls inline-inputs">
						<select id="idRespSug" name="idRespSug"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteSugestoesButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteSugestoesButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Sugestoes</button>
						<span id="confirmDeleteSugestoesContainer" class="hide">
							<button id="cancelDeleteSugestoesButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteSugestoesButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="sugestoesDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Sugestoes
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="sugestoesModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveSugestoesButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="sugestoesCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newSugestoesButton" class="btn btn-primary">Add Sugestoes</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
