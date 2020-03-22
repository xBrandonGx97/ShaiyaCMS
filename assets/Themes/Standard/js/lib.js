var genericConstructor = function(){
	return function(){
		this.initialize.apply(this,arguments);
	};
};

AjaxResultTable = genericConstructor();
AjaxResultTable.prototype ={
	initialize: function(formName,pageIndex,pageSize,pageOrder){
		this.formName		=	formName;
		this.formEl			=	$('#' + this.formName);
		this.resultEl		=	$('#' + this.formName + 'Result');
		this.form			=	$('#' + this.formName);
		this.url			=	this.form.prop('action');
		this.pageIndex		=	pageIndex;
		this.pageSize		=	pageSize;
		this.pageOrder		=	pageOrder;
		this.submitButton	=	$('#' + this.formName + 'Submit');
		this.queryString	=	'';
		this.firstRun		=	true;
//		this.firstRun		=	false;
		this.hook();
	},
	load: function (){
		var _self = this;
		this.submitButton.prop('disabled', true);
		$(this.resultEl).html('<div class="bt-spinner"></div>');
		this.refreshQueryString();
		$.post(this.url, this.queryString, function (response){
			$(_self.resultEl).html(response);
			_self.hook();
			_self.submitButton.prop('disabled', false);
		});
	},
	hook: function (){
		var _self = this;
		if(this.firstRun == true){
			// Hook submit button on first run only
			$(this.submitButton).click(function(){
				_self.load();
			});
			if(_self.submitButton.prop('disabled') == false){
				_self.load();
			};
			$(this.formEl).find('input,select').change(function(){
				_self.pageIndex = 1;
			});
			$(this.form).find('input:first').focus();
			this.firstRun = false;
		}
		$(this.resultEl).find('.page').click(function (e){
			e.preventDefault();
			_self.pageIndex = $(this).prop('href').split('#')[1];
			_self.load();
		});
		$(this.resultEl).find('th a').click(function (e){
			e.preventDefault();
			var pageColumn = $(this).prop('href').split('#')[1];
			var lastPageOrder = _self.pageOrder;
			if (!e.shiftKey){
				_self.pageOrder ={};
			}
			_self.pageOrder[pageColumn] = (lastPageOrder[pageColumn] != undefined && lastPageOrder[pageColumn] == 'DESC') ? 'ASC' : 'DESC';
			_self.load();
		});
	},
	refreshQueryString: function(){
		this.queryString = (this.form != undefined) ? this.form.serialize() : '';
		var i = 0;
		for (key in this.pageOrder){
			this.queryString += '&pageOrder=' + key;
			this.queryString += '&pageDirection=' + this.pageOrder[key];
			break;
		}
		this.queryString += '&pageIndex=' + (this.pageIndex - 1);
		this.queryString += '&pageSize=' + this.pageSize;
	}
}