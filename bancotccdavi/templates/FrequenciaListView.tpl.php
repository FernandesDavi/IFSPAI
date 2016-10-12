<?php
	$this->assign('title','BANCOTCCDAVI | Frequencias');
	$this->assign('nav','frequencias');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/frequencias.js").wait(function(){
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
	<i class="icon-th-list"></i> Frequencia
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="frequenciaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdFreq">Id Freq<% if (page.orderBy == 'IdFreq') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Dia">Dia<% if (page.orderBy == 'Dia') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_AulaDada">Aula Dada<% if (page.orderBy == 'AulaDada') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Frequencia">Frequencia<% if (page.orderBy == 'Frequencia') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdAlunoFreq">Id Aluno Freq<% if (page.orderBy == 'IdAlunoFreq') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_IdAtribuicaoFreq">Id Atribuicao Freq<% if (page.orderBy == 'IdAtribuicaoFreq') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idFreq')) %>">
				<td><%= _.escape(item.get('idFreq') || '') %></td>
				<td><%if (item.get('dia')) { %><%= _date(app.parseDate(item.get('dia'))).format('MMM D, YYYY h:mm A') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('aulaDada') || '') %></td>
				<td><%= _.escape(item.get('frequencia') || '') %></td>
				<td><%= _.escape(item.get('idAlunoFreq') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('idAtribuicaoFreq') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="frequenciaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idFreqInputContainer" class="control-group">
					<label class="control-label" for="idFreq">Id Freq</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idFreq"><%= _.escape(item.get('idFreq') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="diaInputContainer" class="control-group">
					<label class="control-label" for="dia">Dia</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dia" type="text" value="<%= _date(app.parseDate(item.get('dia'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<div class="input-append bootstrap-timepicker-component">
							<input id="dia-time" type="text" class="timepicker-default input-small" value="<%= _date(app.parseDate(item.get('dia'))).format('h:mm A') %>" />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="aulaDadaInputContainer" class="control-group">
					<label class="control-label" for="aulaDada">Aula Dada</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="aulaDada" placeholder="Aula Dada" value="<%= _.escape(item.get('aulaDada') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="frequenciaInputContainer" class="control-group">
					<label class="control-label" for="frequencia">Frequencia</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="frequencia" placeholder="Frequencia" value="<%= _.escape(item.get('frequencia') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idAlunoFreqInputContainer" class="control-group">
					<label class="control-label" for="idAlunoFreq">Id Aluno Freq</label>
					<div class="controls inline-inputs">
						<select id="idAlunoFreq" name="idAlunoFreq"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idAtribuicaoFreqInputContainer" class="control-group">
					<label class="control-label" for="idAtribuicaoFreq">Id Atribuicao Freq</label>
					<div class="controls inline-inputs">
						<select id="idAtribuicaoFreq" name="idAtribuicaoFreq"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteFrequenciaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteFrequenciaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Frequencia</button>
						<span id="confirmDeleteFrequenciaContainer" class="hide">
							<button id="cancelDeleteFrequenciaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteFrequenciaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="frequenciaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Frequencia
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="frequenciaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveFrequenciaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="frequenciaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newFrequenciaButton" class="btn btn-primary">Add Frequencia</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
