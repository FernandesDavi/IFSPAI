<?php
	$this->assign('title','BANCOTCCDAVI | Observacoeses');
	$this->assign('nav','observacoeses');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/observacoeses.js").wait(function(){
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
	<i class="icon-th-list"></i> Observações
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="observacoesCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdObs">Id Obs<% if (page.orderBy == 'IdObs') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Observacoes">Observacoes<% if (page.orderBy == 'Observacoes') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdAlunoObs">Id Aluno Obs<% if (page.orderBy == 'IdAlunoObs') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdRespObs">Id Resp Obs<% if (page.orderBy == 'IdRespObs') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idObs')) %>">
				<td><%= _.escape(item.get('idObs') || '') %></td>
				<td><%= _.escape(item.get('observacoes') || '') %></td>
				<td><%= _.escape(item.get('idAlunoObs') || '') %></td>
				<td><%= _.escape(item.get('idRespObs') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="observacoesModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idObsInputContainer" class="control-group">
					<label class="control-label" for="idObs">Id Obs</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idObs"><%= _.escape(item.get('idObs') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="observacoesInputContainer" class="control-group">
					<label class="control-label" for="observacoes">Observacoes</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="observacoes" placeholder="Observacoes" value="<%= _.escape(item.get('observacoes') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idAlunoObsInputContainer" class="control-group">
					<label class="control-label" for="idAlunoObs">Id Aluno Obs</label>
					<div class="controls inline-inputs">
						<select id="idAlunoObs" name="idAlunoObs"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idRespObsInputContainer" class="control-group">
					<label class="control-label" for="idRespObs">Id Resp Obs</label>
					<div class="controls inline-inputs">
						<select id="idRespObs" name="idRespObs"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteObservacoesButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteObservacoesButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Observacoes</button>
						<span id="confirmDeleteObservacoesContainer" class="hide">
							<button id="cancelDeleteObservacoesButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteObservacoesButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="observacoesDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Observacoes
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="observacoesModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveObservacoesButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="observacoesCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newObservacoesButton" class="btn btn-primary">Add Observacoes</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
