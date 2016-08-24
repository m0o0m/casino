//
//IGT console bridge
//
// © IGT 2013
//
(function()
{
	var _fireEvent = function(_event)
	{
		return com.igt.mxf.fireEvent(_event,[].slice.call(arguments,1));
	};

	var _mxfReady = function(_thisScriptUrl)
	{
		com.igt.mxf.setMessageOrigin(
			window.parent, _thisScriptUrl //MXF can do this itself, on the server side. Except RP might screw it up...
		);

		var _event = document.createEvent('Event');
		_event.initEvent('com.igt.events.bridgeReady', false, false, null);
		_event.bridge = _interface;
		window.dispatchEvent(_event);
	};

	var _consoleReady = function()
	{
		_interface.addEvent = com.igt.mxf.addEvent;
		_interface.addOneShotEvent = com.igt.mxf.addOneShotEvent;
		_interface.addEvents = function()
		{
			com.igt.mxf.addEvents.apply(this,arguments);
		},
		_interface.console = {
			activate: function(_height)
			{
				com.igt.mxf.sendMessage('consoleResize',_height);
			},
			navigate: function(url)
			{
				window.parent.location = url;
			},
			resume: com.igt.mxf.resume
		};
		_interface.removeEvent = com.igt.mxf.removeEvent;
		_interface.removeEvents = com.igt.mxf.removeEvents;
		_interface.commands = com.igt.mxf.commands;
		_interface.MXFflags = com.igt.mxf.MXFflags;
		_interface.doCommand = function(_command,_params)
		{
			com.igt.mxf.sendMessage('command',_command,_params);
		};
		_interface.launchParameters = com.igt.mxf.launchParameters;

		_interface.addEvents({
			'currency': function(_config){
				var _isoCode = _config['@currencyCode'];
				var _space = _config.MAJOR_SYMBOL_PADDING_SPACE == 'true' ? '\u00a0' : '';
				var _precision = parseInt(_config.DECIMAL_PRECISION);
				var _prefix = _config.MAJOR_SYMBOL_ALIGNMENT == 'left' ? _config.MAJOR_SYMBOL + _space : '';
				var _thousands = (_config.USE_THOUSANDS_SEPARATOR == 'yes' ? _config.THOUSANDS_SEPARATOR : '').replace('_','\u00a0');
				var _suffix	= _config.MAJOR_SYMBOL_ALIGNMENT == 'right' ? _space + _config.MAJOR_SYMBOL : '';
				var _decimal = ( _precision ? _config.DECIMAL_SEPARATOR : '').replace('_','\u00a0');

				function _format(_value,_short){

					var _currency = (+_value).toFixed(_precision).split('.');
					var _pounds = (+_currency[0]).toString();
					var _pence = _currency[1] || '';
					var _matches;

					if(_thousands)
						while(_matches = _pounds.match(/^(\d+)(\d\d\d)(.*)$/))
							_pounds = _matches[1].concat(_thousands,_matches[2],_matches[3]);

					_short = _short && _pence == 0;
					return _prefix.concat(
						_pounds,
						_short ? '' : _decimal,
						_short ? '' : _pence,
						_suffix
					);
				};

				_interface.currency = {
					format: _format,
					formatS: function(_value){
						return _format(_value,true);
					},
					formatL: function(_value){
						return _format(_value,false);
					}
				};
			}
		});

		
		com.igt.mxf.sendMessage('consoleInitialised');
		//Tell the console everything has loaded using a custom event
		//make sure this method is called only once
		delete _interface._consoleReady;
	};

	//fetch the MXF script
	//wait for it to be ready
	//once it's ready handle init with the game

	(function()
	{
		var _script = document.createElement('script'),
			_thisScriptUrl = [].slice.apply(document.getElementsByTagName('script')).pop().src;

		_script.onload = function()
		{
			_mxfReady(_thisScriptUrl);
			_script.onload = void 0;
		};
		_script.src = _thisScriptUrl.replace(/\/[^\/]+($|\?)/,'/MXF.js$1');
		document.body.appendChild(_script);
	})();

	//Create an augmentable public interface
	//Other functions get defined when consoleReady is called
	var _interface = {
		consoleReady:_consoleReady
	};

})();
