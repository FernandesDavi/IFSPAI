<?php
	$this->assign('title','BANCOTCCDAVI | Turmas');
	$this->assign('nav','turmas');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/turmas.js").wait(function(){
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
	<i class="icon-th-list"></i> Turma
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="turmaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdTurma">Id Turma<% if (page.orderBy == 'IdTurma') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Turma">Turma<% if (page.orderBy == 'Turma') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Sala">Sala<% if (page.orderBy == 'Sala') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Ano">Ano<% if (page.orderBy == 'Ano') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idTurma')) %>">
				<td><%= _.escape(item.get('idTurma') || '') %></td>
				<td><%= _.escape(item.get('turma') || '') %></td>
				<td><%= _.escape(item.get('sala') || '') %></td>
				<td><%= _.escape(item.get('ano') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="turmaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idTurmaInputContainer" class="control-group">
					<label class="control-label" for="idTurma">Id Turma</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idTurma"><%= _.escape(item.get('idTurma') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="turmaInputContainer" class="control-group">
					<label class="control-label" for="turma">Turma</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="turma" placeholder="Turma" value="<%= _.escape(item.get('turma') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="salaInputContainer" class="control-group">
					<label class="control-label" for="sala">Sala</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="sala" placeholder="Sala" value="<%= _.escape(item.get('sala') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="anoInputContainer" class="control-group">
					<label class="control-label" for="ano">Ano</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="ano" placeholder="Ano" value="<%= _.escape(item.get('ano') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteTurmaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteTurmaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Turma</button>
						<span id="confirmDeleteTurmaContainer" class="hide">
							<button id="cancelDeleteTurmaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteTurmaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="turmaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Turma
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="turmaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveTurmaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="turmaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newTurmaButton" class="btn btn-primary">Add Turma</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
