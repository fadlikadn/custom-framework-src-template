
pp.define('Putri/PutriList', function (putriTemplate) {

var c = function (parent, options) {
	pp.ListPanel.call(this, parent, $.extend({
		'class': 'StdPanel',
		'title': 'Samples'
	}, options));

	this.setTemplateName(putriTemplate, 'PutriList');

	this._controller = 'Putri/Putri';
	this._controllerAction = 'prepareList';

	this._object = 'Sample Record';
	this._deleteAction = 'delete';

	this._listRow = ['SampleRow', 'tr'];

	pp.mixin.SPPanel.call(this);
};
c.prototype = new pp.ListPanel();

c.prototype._prepareTemplate = function () {

	pp.ListPanel.prototype._prepareTemplate.call(this);

	this._loadRecords(this._data);
	
	this._liveEvent(this._evenDelete,'.edit .delete', {}, this.reloadTable);

};

c.prototype._reloadTable = function () {
	this._eventSubmit({
		'controllerAction': 'prepareList'
	}, null, this._loadRecords);
};

return c;
});
