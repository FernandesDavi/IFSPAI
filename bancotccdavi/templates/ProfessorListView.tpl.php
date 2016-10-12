<?php
	$this->assign('title','BANCOTCCDAVI | Professors');
	$this->assign('nav','professors');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/professors.js").wait(function(){
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
	<i class="icon-th-list"></i> Professor
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="professorCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdProfessor">Id Professor<% if (page.orderBy == 'IdProfessor') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nome">Nome<% if (page.orderBy == 'Nome') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Cpf">Cpf<% if (page.orderBy == 'Cpf') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Rg">Rg<% if (page.orderBy == 'Rg') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Logradouro">Logradouro<% if (page.orderBy == 'Logradouro') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Cep">Cep<% if (page.orderBy == 'Cep') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Numero">Numero<% if (page.orderBy == 'Numero') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Complemento">Complemento<% if (page.orderBy == 'Complemento') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Prontuario">Prontuario<% if (page.orderBy == 'Prontuario') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idProfessor')) %>">
				<td><%= _.escape(item.get('idProfessor') || '') %></td>
				<td><%= _.escape(item.get('nome') || '') %></td>
				<td><%= _.escape(item.get('cpf') || '') %></td>
				<td><%= _.escape(item.get('rg') || '') %></td>
				<td><%= _.escape(item.get('logradouro') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('cep') || '') %></td>
				<td><%= _.escape(item.get('numero') || '') %></td>
				<td><%= _.escape(item.get('complemento') || '') %></td>
				<td><%= _.escape(item.get('prontuario') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="professorModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idProfessorInputContainer" class="control-group">
					<label class="control-label" for="idProfessor">Id Professor</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idProfessor"><%= _.escape(item.get('idProfessor') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nomeInputContainer" class="control-group">
					<label class="control-label" for="nome">Nome</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nome" placeholder="Nome" value="<%= _.escape(item.get('nome') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cpfInputContainer" class="control-group">
					<label class="control-label" for="cpf">Cpf</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="cpf" placeholder="Cpf" value="<%= _.escape(item.get('cpf') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="rgInputContainer" class="control-group">
					<label class="control-label" for="rg">Rg</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="rg" placeholder="Rg" value="<%= _.escape(item.get('rg') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="logradouroInputContainer" class="control-group">
					<label class="control-label" for="logradouro">Logradouro</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="logradouro" placeholder="Logradouro" value="<%= _.escape(item.get('logradouro') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cepInputContainer" class="control-group">
					<label class="control-label" for="cep">Cep</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="cep" placeholder="Cep" value="<%= _.escape(item.get('cep') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="numeroInputContainer" class="control-group">
					<label class="control-label" for="numero">Numero</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="numero" placeholder="Numero" value="<%= _.escape(item.get('numero') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="complementoInputContainer" class="control-group">
					<label class="control-label" for="complemento">Complemento</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="complemento" placeholder="Complemento" value="<%= _.escape(item.get('complemento') || '') %>">
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
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteProfessorButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteProfessorButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Professor</button>
						<span id="confirmDeleteProfessorContainer" class="hide">
							<button id="cancelDeleteProfessorButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteProfessorButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="professorDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Professor
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="professorModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveProfessorButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="professorCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newProfessorButton" class="btn btn-primary">Add Professor</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
