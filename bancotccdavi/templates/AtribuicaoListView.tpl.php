<?php
	$this->assign('title','BANCOTCCDAVI | Atribuicaos');
	$this->assign('nav','atribuicaos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/atribuicaos.js").wait(function(){
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
	<i class="icon-th-list"></i> Atribuição
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="atribuicaoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Atribuicao">Atribuicao<% if (page.orderBy == 'Atribuicao') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_ProfAtr">Prof Atr<% if (page.orderBy == 'ProfAtr') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_TurmaAtr">Turma Atr<% if (page.orderBy == 'TurmaAtr') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DiscAtr">Disc Atr<% if (page.orderBy == 'DiscAtr') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('atribuicao')) %>">
				<td><%= _.escape(item.get('atribuicao') || '') %></td>
				<td><%= _.escape(item.get('profAtr') || '') %></td>
				<td><%= _.escape(item.get('turmaAtr') || '') %></td>
				<td><%= _.escape(item.get('discAtr') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="atribuicaoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="atribuicaoInputContainer" class="control-group">
					<label class="control-label" for="atribuicao">Atribuicao</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="atribuicao"><%= _.escape(item.get('atribuicao') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="profAtrInputContainer" class="control-group">
					<label class="control-label" for="profAtr">Prof Atr</label>
					<div class="controls inline-inputs">
						<select id="profAtr" name="profAtr"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="turmaAtrInputContainer" class="control-group">
					<label class="control-label" for="turmaAtr">Turma Atr</label>
					<div class="controls inline-inputs">
						<select id="turmaAtr" name="turmaAtr"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="discAtrInputContainer" class="control-group">
					<label class="control-label" for="discAtr">Disc Atr</label>
					<div class="controls inline-inputs">
						<select id="discAtr" name="discAtr"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteAtribuicaoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteAtribuicaoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Atribuicao</button>
						<span id="confirmDeleteAtribuicaoContainer" class="hide">
							<button id="cancelDeleteAtribuicaoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteAtribuicaoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="atribuicaoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Atribuicao
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="atribuicaoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveAtribuicaoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="atribuicaoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newAtribuicaoButton" class="btn btn-primary">Add Atribuicao</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
