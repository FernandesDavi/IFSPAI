<?php
	$this->assign('title','IFSPAI | Materias');
	$this->assign('nav','materias');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/materias.js").wait(function(){
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
	<i class="icon-th-list"></i> Materias
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="materiaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdMateria">Id Materia<% if (page.orderBy == 'IdMateria') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_NomeMateria">Nome Materia<% if (page.orderBy == 'NomeMateria') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdMateriaAluno">Id Materia Aluno<% if (page.orderBy == 'IdMateriaAluno') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdMateriaProf">Id Materia Prof<% if (page.orderBy == 'IdMateriaProf') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CargaHoraria">Carga Horaria<% if (page.orderBy == 'CargaHoraria') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idMateria')) %>">
				<td><%= _.escape(item.get('idMateria') || '') %></td>
				<td><%= _.escape(item.get('nomeMateria') || '') %></td>
				<td><%= _.escape(item.get('idMateriaAluno') || '') %></td>
				<td><%= _.escape(item.get('idMateriaProf') || '') %></td>
				<td><%= _.escape(item.get('cargaHoraria') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="materiaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idMateriaInputContainer" class="control-group">
					<label class="control-label" for="idMateria">Id Materia</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idMateria"><%= _.escape(item.get('idMateria') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nomeMateriaInputContainer" class="control-group">
					<label class="control-label" for="nomeMateria">Nome Materia</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nomeMateria" placeholder="Nome Materia" value="<%= _.escape(item.get('nomeMateria') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idMateriaAlunoInputContainer" class="control-group">
					<label class="control-label" for="idMateriaAluno">Id Materia Aluno</label>
					<div class="controls inline-inputs">
						<select id="idMateriaAluno" name="idMateriaAluno"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idMateriaProfInputContainer" class="control-group">
					<label class="control-label" for="idMateriaProf">Id Materia Prof</label>
					<div class="controls inline-inputs">
						<select id="idMateriaProf" name="idMateriaProf"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cargaHorariaInputContainer" class="control-group">
					<label class="control-label" for="cargaHoraria">Carga Horaria</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="cargaHoraria" placeholder="Carga Horaria" value="<%= _.escape(item.get('cargaHoraria') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteMateriaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteMateriaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Materia</button>
						<span id="confirmDeleteMateriaContainer" class="hide">
							<button id="cancelDeleteMateriaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteMateriaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="materiaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Materia
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="materiaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveMateriaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="materiaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newMateriaButton" class="btn btn-primary">Add Materia</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
