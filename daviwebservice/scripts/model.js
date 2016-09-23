/**
 * backbone model definitions for IFSPAI
 */

/**
 * Use emulated HTTP if the server doesn't support PUT/DELETE or application/json requests
 */
Backbone.emulateHTTP = false;
Backbone.emulateJSON = false;

var model = {};

/**
 * long polling duration in miliseconds.  (5000 = recommended, 0 = disabled)
 * warning: setting this to a low number will increase server load
 */
model.longPollDuration = 0;

/**
 * whether to refresh the collection immediately after a model is updated
 */
model.reloadCollectionOnModelUpdate = true;


/**
 * a default sort method for sorting collection items.  this will sort the collection
 * based on the orderBy and orderDesc property that was used on the last fetch call
 * to the server. 
 */
model.AbstractCollection = Backbone.Collection.extend({
	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	lastRequestParams: null,
	collectionHasChanged: true,
	
	/**
	 * fetch the collection from the server using the same options and 
	 * parameters as the previous fetch
	 */
	refetch: function() {
		this.fetch({ data: this.lastRequestParams })
	},
	
	/* uncomment to debug fetch event triggers
	fetch: function(options) {
            this.constructor.__super__.fetch.apply(this, arguments);
	},
	// */
	
	/**
	 * client-side sorting baesd on the orderBy and orderDesc parameters that
	 * were used to fetch the data from the server.  Backbone ignores the
	 * order of records coming from the server so we have to sort them ourselves
	 */
	comparator: function(a,b) {
		
		var result = 0;
		var options = this.lastRequestParams;
		
		if (options && options.orderBy) {
			
			// lcase the first letter of the property name
			var propName = options.orderBy.charAt(0).toLowerCase() + options.orderBy.slice(1);
			var aVal = a.get(propName);
			var bVal = b.get(propName);
			
			if (isNaN(aVal) || isNaN(bVal)) {
				// treat comparison as case-insensitive strings
				aVal = aVal ? aVal.toLowerCase() : '';
				bVal = bVal ? bVal.toLowerCase() : '';
			} else {
				// treat comparision as a number
				aVal = Number(aVal);
				bVal = Number(bVal);
			}
			
			if (aVal < bVal) {
				result = options.orderDesc ? 1 : -1;
			} else if (aVal > bVal) {
				result = options.orderDesc ? -1 : 1;
			}
		}
		
		return result;

	},
	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, options) {

		// the response is already decoded into object form, but it's easier to
		// compary the stringified version.  some earlier versions of backbone did
		// not include the raw response so there is some legacy support here
		var responseText = options && options.xhr ? options.xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastRequestParams = options ? options.data : undefined;
		
		// if the collection has changed then we need to force a re-sort because backbone will
		// only resort the data if a property in the model has changed
		if (this.lastResponseText && this.collectionHasChanged) this.sort({ silent:true });
		
		this.lastResponseText = responseText;
		
		var rows;

		if (response.currentPage) {
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		} else {
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Aluno Backbone Model
 */
model.AlunoModel = Backbone.Model.extend({
	urlRoot: 'api/aluno',
	idAttribute: 'idAluno',
	idAluno: '',
	nomeAluno: '',
	prontuario: '',
	idAlunoResp: '',
	defaults: {
		'idAluno': null,
		'nomeAluno': '',
		'prontuario': '',
		'idAlunoResp': ''
	}
});

/**
 * Aluno Backbone Collection
 */
model.AlunoCollection = model.AbstractCollection.extend({
	url: 'api/alunos',
	model: model.AlunoModel
});

/**
 * Frequencia Backbone Model
 */
model.FrequenciaModel = Backbone.Model.extend({
	urlRoot: 'api/frequencia',
	idAttribute: 'idFrequencia',
	idFrequencia: '',
	frequencia: '',
	dia: '',
	aulaDada: '',
	idFrequenciaAluno: '',
	idFrequenciaMateria: '',
	defaults: {
		'idFrequencia': null,
		'frequencia': '',
		'dia': new Date(),
		'aulaDada': '',
		'idFrequenciaAluno': '',
		'idFrequenciaMateria': ''
	}
});

/**
 * Frequencia Backbone Collection
 */
model.FrequenciaCollection = model.AbstractCollection.extend({
	url: 'api/frequencias',
	model: model.FrequenciaModel
});

/**
 * LogSis Backbone Model
 */
model.LogSisModel = Backbone.Model.extend({
	urlRoot: 'api/logsis',
	idAttribute: 'id',
	id: '',
	ioEs: '',
	usuarioId: '',
	dataHora: '',
	defaults: {
		'id': null,
		'ioEs': '',
		'usuarioId': '',
		'dataHora': new Date()
	}
});

/**
 * LogSis Backbone Collection
 */
model.LogSisCollection = model.AbstractCollection.extend({
	url: 'api/logsises',
	model: model.LogSisModel
});

/**
 * Login Backbone Model
 */
model.LoginModel = Backbone.Model.extend({
	urlRoot: 'api/login',
	idAttribute: 'idLogin',
	idLogin: '',
	login: '',
	senha: '',
	idLoginAluno: '',
	defaults: {
		'idLogin': null,
		'login': '',
		'senha': '',
		'idLoginAluno': ''
	}
});

/**
 * Login Backbone Collection
 */
model.LoginCollection = model.AbstractCollection.extend({
	url: 'api/logins',
	model: model.LoginModel
});

/**
 * Materia Backbone Model
 */
model.MateriaModel = Backbone.Model.extend({
	urlRoot: 'api/materia',
	idAttribute: 'idMateria',
	idMateria: '',
	nomeMateria: '',
	idMateriaAluno: '',
	idMateriaProf: '',
	cargaHoraria: '',
	defaults: {
		'idMateria': null,
		'nomeMateria': '',
		'idMateriaAluno': '',
		'idMateriaProf': '',
		'cargaHoraria': ''
	}
});

/**
 * Materia Backbone Collection
 */
model.MateriaCollection = model.AbstractCollection.extend({
	url: 'api/materias',
	model: model.MateriaModel
});

/**
 * Notas Backbone Model
 */
model.NotasModel = Backbone.Model.extend({
	urlRoot: 'api/notas',
	idAttribute: 'idNotas',
	idNotas: '',
	avaliacaoNome: '',
	datas: '',
	calculo: '',
	nota: '',
	idNotasAluno: '',
	idNotasMateria: '',
	defaults: {
		'idNotas': null,
		'avaliacaoNome': '',
		'datas': '',
		'calculo': '',
		'nota': '',
		'idNotasAluno': '',
		'idNotasMateria': ''
	}
});

/**
 * Notas Backbone Collection
 */
model.NotasCollection = model.AbstractCollection.extend({
	url: 'api/notases',
	model: model.NotasModel
});

/**
 * Prof Backbone Model
 */
model.ProfModel = Backbone.Model.extend({
	urlRoot: 'api/prof',
	idAttribute: 'idProf',
	idProf: '',
	nomeProf: '',
	defaults: {
		'idProf': null,
		'nomeProf': ''
	}
});

/**
 * Prof Backbone Collection
 */
model.ProfCollection = model.AbstractCollection.extend({
	url: 'api/profs',
	model: model.ProfModel
});

/**
 * Responsavel Backbone Model
 */
model.ResponsavelModel = Backbone.Model.extend({
	urlRoot: 'api/responsavel',
	idAttribute: 'idResp',
	idResp: '',
	nome: '',
	endereco: '',
	cpf: '',
	rg: '',
	defaults: {
		'idResp': null,
		'nome': '',
		'endereco': '',
		'cpf': '',
		'rg': ''
	}
});

/**
 * Responsavel Backbone Collection
 */
model.ResponsavelCollection = model.AbstractCollection.extend({
	url: 'api/responsavels',
	model: model.ResponsavelModel
});

