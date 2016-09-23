<?php
	$this->assign('title','IFSPAI | Notases');
	$this->assign('nav','notases');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/notases.js").wait(function(){
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
	<i class="icon-th-list"></i> Notases
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="notasCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdNotas">Id Notas<% if (page.orderBy == 'IdNotas') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_AvaliacaoNome">Avaliacao Nome<% if (page.orderBy == 'AvaliacaoNome') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Datas">Datas<% if (page.orderBy == 'Datas') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Calculo">Calculo<% if (page.orderBy == 'Calculo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nota">Nota<% if (page.orderBy == 'Nota') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_IdNotasAluno">Id Notas Aluno<% if (page.orderBy == 'IdNotasAluno') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdNotasMateria">Id Notas Materia<% if (page.orderBy == 'IdNotasMateria') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idNotas')) %>">
				<td><%= _.escape(item.get('idNotas') || '') %></td>
				<td><%= _.escape(item.get('avaliacaoNome') || '') %></td>
				<td><%= _.escape(item.get('datas') || '') %></td>
				<td><%= _.escape(item.get('calculo') || '') %></td>
				<td><%= _.escape(item.get('nota') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('idNotasAluno') || '') %></td>
				<td><%= _.escape(item.get('idNotasMateria') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="notasModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idNotasInputContainer" class="control-group">
					<label class="control-label" for="idNotas">Id Notas</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idNotas"><%= _.escape(item.get('idNotas') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="avaliacaoNomeInputContainer" class="control-group">
					<label class="control-label" for="avaliacaoNome">Avaliacao Nome</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="avaliacaoNome" placeholder="Avaliacao Nome" value="<%= _.escape(item.get('avaliacaoNome') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="datasInputContainer" class="control-group">
					<label class="control-label" for="datas">Datas</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="datas" placeholder="Datas" value="<%= _.escape(item.get('datas') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="calculoInputContainer" class="control-group">
					<label class="control-label" for="calculo">Calculo</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="calculo" placeholder="Calculo" value="<%= _.escape(item.get('calculo') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="notaInputContainer" class="control-group">
					<label class="control-label" for="nota">Nota</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nota" placeholder="Nota" value="<%= _.escape(item.get('nota') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idNotasAlunoInputContainer" class="control-group">
					<label class="control-label" for="idNotasAluno">Id Notas Aluno</label>
					<div class="controls inline-inputs">
						<select id="idNotasAluno" name="idNotasAluno"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idNotasMateriaInputContainer" class="control-group">
					<label class="control-label" for="idNotasMateria">Id Notas Materia</label>
					<div class="controls inline-inputs">
						<select id="idNotasMateria" name="idNotasMateria"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteNotasButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteNotasButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Notas</button>
						<span id="confirmDeleteNotasContainer" class="hide">
							<button id="cancelDeleteNotasButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteNotasButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="notasDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Notas
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="notasModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveNotasButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="notasCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newNotasButton" class="btn btn-primary">Add Notas</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
