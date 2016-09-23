<?php
	$this->assign('title','IFSPAI | Alunos');
	$this->assign('nav','alunos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/alunos.js").wait(function(){
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
	<i class="icon-th-list"></i> Alunos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="alunoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdAluno">Id Aluno<% if (page.orderBy == 'IdAluno') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_NomeAluno">Nome Aluno<% if (page.orderBy == 'NomeAluno') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Prontuario">Prontuario<% if (page.orderBy == 'Prontuario') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdAlunoResp">Id Aluno Resp<% if (page.orderBy == 'IdAlunoResp') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idAluno')) %>">
				<td><%= _.escape(item.get('idAluno') || '') %></td>
				<td><%= _.escape(item.get('nomeAluno') || '') %></td>
				<td><%= _.escape(item.get('prontuario') || '') %></td>
				<td><%= _.escape(item.get('idAlunoResp') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="alunoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idAlunoInputContainer" class="control-group">
					<label class="control-label" for="idAluno">Id Aluno</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idAluno"><%= _.escape(item.get('idAluno') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nomeAlunoInputContainer" class="control-group">
					<label class="control-label" for="nomeAluno">Nome Aluno</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nomeAluno" placeholder="Nome Aluno" value="<%= _.escape(item.get('nomeAluno') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="prontuarioInputContainer" class="control-group">
					<label class="control-label" for="prontuario">Prontuario</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="prontuario" placeholder="Prontuario" value="<%= _.escape(item.get('prontuario') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idAlunoRespInputContainer" class="control-group">
					<label class="control-label" for="idAlunoResp">Id Aluno Resp</label>
					<div class="controls inline-inputs">
						<select id="idAlunoResp" name="idAlunoResp"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteAlunoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteAlunoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Aluno</button>
						<span id="confirmDeleteAlunoContainer" class="hide">
							<button id="cancelDeleteAlunoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteAlunoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="alunoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Aluno
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="alunoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveAlunoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="alunoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newAlunoButton" class="btn btn-primary">Add Aluno</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
