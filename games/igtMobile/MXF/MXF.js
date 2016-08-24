//
// MXF v1.3
//
//IGT consoleAPI
//
// © IGT 2013,2014
//
var com = com || {};
com.igt = com.igt || {};

com.igt.mxf = (function()
{
	//be paranoid
	var _hasOwnProperty = {}.hasOwnProperty;

	//copy properties from _src to _dst. Doesn't recurse
	var _extend = function(_dst,_src)
	{
		for(var _p in _src)
		{
			if(_hasOwnProperty.call(_src,_p))
			{
				_dst[_p] = _src[_p];
			}
		}
	};

	var _EventSource = function(_context)
	{
		var _eventHandlers = {};

		function _addEvent(_event,_handler)
		{
			var _h = _eventHandlers[_event] = (_eventHandlers[_event] || []);
			//error if the handler is not a function
			if(_handler instanceof Function)
			{
				_h.indexOf(_handler) >= 0 || _h.push(_handler); //dont duplicate handlers, always append
			}
			else
			{
				console.error('MXF event handlers must be functions');
			}
			return this;
		};

		function _addEvents(_handlers)
		{
			for(var _event in _handlers)
			{
				_handlers.hasOwnProperty(_event) && _addEvent.call(this,_event,_handlers[_event]);
			}
			return this;
		};

		function _addOneShotEvent(_event,_handler)
		{
			if(_handler instanceof Function)
			{
				return _addEvent.call(this,_event,function _self()
				{
					_handler.apply(_context,arguments);
					_removeEvent(_event,_self);
				});
			}
			else
			{
				console.error('MXF event handlers must be functions');
			}
			return this;
		};

		function _removeEvent(_type,_handler)
		{
			var _p, _h = _eventHandlers[_type];

			if(_h)
			{
				_p = _h.indexOf(_handler);
				_p >= 0 && _h.splice(_p,1);
				//if it's the last handler remove the type entry
				0 == _h.length && delete _eventHandlers[_type];
			}
			return this;
		};

		function _removeEvents(_handlers)
		{
			for(var _event in _handlers)
			{
				_handlers.hasOwnProperty(_event) && _removeEvent.call(this,_event,_handlers[_event]);
			}
			return this;
		};

		//this = the type of the event that is being fired
		//arguments are proxied to the handler fucntion
		function _fireEvent(_event,_args)
		{
			_eventHandlers[_event] && _eventHandlers[_event].forEach(
				function(_handler)
				{
					_handler.apply(_context,_args);
				}
			);
			return !!_eventHandlers[_event];
		};

		function _handlerCount(_event)
		{
			return _eventHandlers[_event] && _eventHandlers[_event].length || 0;
		};

		this._addEvent = _addEvent;
		this._addEvents = _addEvents;
		this._addOneShotEvent = _addOneShotEvent;
		this._removeEvent = _removeEvent;
		this._removeEvents = _removeEvents;
		this._fireEvent = _fireEvent;
		this._handlerCount = _handlerCount;
	};

	//used to validate ciontrol values on both sides of the interface
	//this ensures that the same validation rules are applied on the game side, although
	//errors will be logged on the console side
	//call like a method: _isValidValue.call(this,_value)
	var _isValidValue = function(_value)
	{
		//if the control has a list of values, then check the new value is in the list
		if(this.values && this.values.indexOf(_value) === -1)
		{
			console.error('Invalid value for  control "' + this.name + '": value "' + _value + '" for is not in values');
			return 0;
		}
		//an closed interval includes endpoints
		if(this.closedInterval)
		{
			if(!(_value >= this.closedInterval[0]))
			{
				console.error('Invalid value for  control "' + this.name + '": value "' + _value + '" is <= ' + this.closedInterval[0]);
				return 0;
			}
			if(!(_value <= this.closedInterval[1]))
			{
				console.error('Invalid value for  control "' + this.name + '": value "' + _value + '" is >= ' + this.closedInterval[1]);
				return 0;
			}
		}
		//an open interval includes endpoints
		if(this.openInterval)
		{
			if(!(_value > this.openInterval[0]))
			{
				console.error('Invalid value for  control "' + this.name + '": value "' + _value + '" is < ' + this.openInterval[0]);
				return 0;
			}
			if(!(_value < this.openInterval[1]))
			{
				console.error('Invalid value for  control "' + this.name + '": value "' + _value + '" is > ' + this.openInterval[1]);
				return 0;
			}
		}
		return 1;
	};

	var _Control = function(_payload)
	{
		var _eventSource;
		var _config = JSON.parse(JSON.stringify(_payload)); //break references so this object can't be modified

		var _setValue = function (_value)
		{
			//ignore new values for disabled controls
			if(!_config.enabled)
			{
				console.error('New value "' + _value + '" for disabled control "' + _config.name + '" ignored');
				return;
			}
			_isValidValue.call(_config,_value) && _sendMessage('control',_config.name,'change',[].slice.call(arguments,0));
		};

		//create an eventsink who's context is the public interface
		_eventSource = new _EventSource(_payload);

		//the enable event is special. Trap it so the controls enablement status can be tracked
		//sending new values to a disbaled control is not allowed
		_eventSource._addEvent('enable',function(_enabled)
		{
			_config.enabled = !!_enabled;
		});


		//these functions are needed internally
		this._fireEvent = _eventSource._fireEvent;

		//everything else is needed externally
		//MXF is this._interface redundant?

		_extend(_payload,{
			setValue: _setValue,
			addEvent: _eventSource._addEvent,
			addEvents: _eventSource._addEvents,
			addOneShotEvent: _eventSource._addOneShotEvent,
			removeEvent: _eventSource._removeEvent,
			removeEvents: _eventSource._removeEvents
		});
	};

	//static function for processing responses
	var _outcomeParser = {
		_float: function(_s)
		{
			return parseFloat(_s) || 0;
		},
		_int: function(_s)
		{
			return parseInt(_s,10) || 0;
		},
		_list: function(_s)
		{
			return _s.split(',');
		},
		_nameize: function(_array,_nameProperty)
		{
			var _r = {},_v,_i = _array.length;

			_nameProperty = _nameProperty || '@name';

			while(--_i >=0)
			{
				_v = _array[_i];
				_r[_v[_nameProperty]] = _v;
				delete _v[_nameProperty];
			}
			return _r;
		},
		_arrayize: function(_v)
		{
			return _v instanceof Array ? _v : _v !== void 0 ? [_v] : [];
		}
	};

	var _Currency;

	var _setCurrencyFormat = function(_format)
	{
		_sendMessage('currency',_format.config); //For GCM. MXF consoles should used formatted values
		delete _format.config; //ensure that non-GCM console don't try and use this
		_Currency = _format;
	}

//SHARED WITH MXF FIGURE OUT HOW TO DO THIS
	var _messagePrefix = 'com.igt.mxf:';
	var _messageOrigin;
	var _messageWindow;
	var _eventsEnabled =1; //initially events are enabled
	var _eventHandlers = new _EventSource(); //see the event functions. a hash of event names to array of handlers
	var _registeredControls = {}; //references to the controls that have been registered for validation
	var _resumeHandler; //handler to call when resuming
	var _resumeCounter; //count of resume calls so far
	var _resumeAction;
//for debugging figure out where we are
	var _where = window === top ? 'game' : 'console';

//TODO there should be a preventDefault method too
//possibly a cancel method
//the alt is to notify the other side we are not interested in the event here
//then it can skip sending the message
	var _resumeHandlers = { //provide simple default implementations for skins that care not about these events
		'wagerIsStarting': function()
		{
			_sendMessage('wagerStarted');
		},
		'wagerIsComplete': function()
		{
			_sendMessage('wagerComplete');
		},
		'wagerIsAborted': function()
		{
			_sendMessage('wagerAborted');
		},
		'insufficientFundsNotification': function()
		{
			_sendMessage('resume');
		},
		'displayMessage': function(index)
		{
			_sendMessage('resume',index);
		},
		'command': function(command)
		{
			_sendMessage('resume');
		},
		'gameOutcome': function()
		{
			_sendMessage('afterGameOutcome');
		},
		'beforeInitGame': function(cashierUsed)
		{
			_sendMessage('resume',cashierUsed);
		}
	};

	var _queryString = new (
		function(_search)
		{
			var _search = (_search || location.search).substring(1);
			_search && _search.split('&').map(
				function(_p)
				{
					_p = _p.split('=');
					this[decodeURIComponent(_p[0])] = decodeURIComponent(_p[1]);
				},this
			);
		}
	)();
	Object.freeze && Object.freeze(_queryString);

	var _MXFflags = (function()
	{
		var _flags = (_queryString.MXFdebug || '').split(',');

		return function _MXFflags(name)
		{
			return _flags.indexOf(name) >= 0;
		}
	})();


	//A tags have all the same properties as document.location
	//so can treated like location for the purpose of decoding components
	var _locationFromUrl = function(_url)
	{
		var _anchor = document.createElement('a');
		_anchor.setAttribute('href',_url);
		return _anchor;
	};

	var _originFromLocation = function(_location)
	{
		_location = typeof(_location) == 'string'
			? _locationFromUrl(_location)
			: _location;

		return _location.origin || [
			_location.protocol,
			'//',
			_location.hostname,
			_location.port > 0 ? ':' : '',
			_location.port > 0 ? _location.port : ''
		].join('');
	};

	//this function is a trapdoor.
	//It removes itself from the interface once called ensuring it can only be called once
	var _setMessageOrigin = function(_window,_location)
	{
		_messageWindow = _window;
		_messageOrigin = _originFromLocation(_location);

		delete _interface.setMessageOrigin;//Trapdoor!
		return this;
	};

	var _getQueryStringParameter = function(_parameter)
	{
		return _queryString[_parameter];
	};

	//Handles sending a message to the other side of the interface
	//Can handle any number of arguments
	// - _type: first argument should be the type of message (the event that will be fired on the other side)
	// - rest of the argument list will be passed to the recipients event handlers
	var _sendMessage = function(_type)
	{
		if(!_messageOrigin)
		{
			return;
		}
		_MXFflags('log') && console.warn('TX to "'+_messageOrigin+'":'+JSON.stringify([].slice.call(arguments)));
		try
		{
			_messageWindow.postMessage(_messagePrefix + JSON.stringify([].slice.call(arguments)),_messageOrigin);
		}
		catch(_exception)
		{
			console.error(_exception);
		}
	};

	//handles recieving a message from the other side of the interface
	var _onMessageFromMXF = function(_event)
	{
		var _message, _type;

		//Ignore messages from origins that MXF shoudln't be talking to
		if(_event.origin != _messageOrigin)
		{
			return;
		}

		//ignore any non-IGT messages, even if they came from a trusted source
		if(0 !== _event.data.indexOf(_messagePrefix))
		{
			return;
		}

		_MXFflags('log') && console.warn(_where+' RX:' + _event.data);

		//decode the message object
		_message = _event.data.substr(_messagePrefix.length);
		try
		{
			_message = JSON.parse(_message);
		}
		catch(_exception)
		{
			console.error(_exception);
			return;
		}

		_type = _message.shift();

		if(!_eventsEnabled && _type!='afterGameOutcome')
		{
			console.error(_where+' is disabled. Message ignored '+_message);
			return;
		}

		//if the event needs a resume call, remember it
		if(_resumeHandlers[_type])
		{
			_resumeHandler = _resumeHandlers[_type];
			_resumeCounter = _eventHandlers._handlerCount(_type);
			_resumeAction = void 0;
		}

		switch(_type)
		{
		case 'register':
			if(_registeredControls[_message[0].name])
			{
				console.error('Control '+_message[0].name+' is already registered');
			}
			else
			{
				//create a contol object and keep a ref to it
				//the control constructor augments the message payload with the public interface to the control
				//register messages have a single object parameter describing the control
				_registeredControls[_message[0].name] = new _Control(_message[0]);
			}
		default:
			//if there are no handlers, _fireEvent returns false and resume should be called immediatly
			_eventHandlers._fireEvent(_type,_message) || _resume();
		}
	};

	//damn. resume got combined with actions - but what if there are multiple actions?
	var _resume = function(action)
	{
		//remember the last action
		if(action != null)
		{
			_resumeAction = action;
		}
		if( --_resumeCounter <= 0)
		{
			_resumeHandler && _resumeHandler(_resumeAction);
			_resumeHandler = void 0;
		}
	};

	var _commands = (function()
	{
		var _commandHandlers = {};

		_eventHandlers._addEvent('command',function(_command)
		{
			var _commandHandler = _commandHandlers[_command];

			_commandHandler
				? _commandHandler.apply(void 0,Array.prototype.slice.call(arguments,1))
				: _resume();
		});

		return {
			setHandler: function(_command,_hanlder)
			{
				_commandHandlers[_command]=_hanlder;
			},
			unsetHandler: function(_command)
			{
				delete _commandHandlers[_command];
			},
			setHandlers: function(_handlers)
			{
				for(var _command in _handlers)
				{
					if(_handlers.hasOwnProperty(_command))
					{
						_commandHandlers[_command] = _handlers[_command];
					}
				}
			},
			unsetHandlers: function(_handlers)
			{
				for(var _command in _handlers)
				{
					if(_handlers.hasOwnProperty(_command))
					{
						delete _commandHandlers[_command];
					}
				}
			}
		};
	})();

	//orientationchange messages must have a handler
	//fake an orienation event inside the console IFRAME
	_eventHandlers._addEvent('orientationchange',function(_orientation)
	{
		var _event = document.createEvent('HTMLEvents');

		window.orientation = _orientation;
		_event.initEvent('orientationchange',1,1);
		(window.dispatchEvent||document.dispatchEvent)(_event)
	});

	//delegates control events to a registered control
	// - _name : first argument is the name of the control
	// - rest of arguments passed to _control._fireEvent
	_eventHandlers._addEvent('control',function(_name)
	{
		var _args = [].slice.call(arguments,1),
			_control = _registeredControls[_name];

		if(!_control)
		{
			console.error('"' + _name + '" is not a registered control');
		}
		_control._fireEvent.apply(void 0,_args);
	});

//it would be nicer to phrase this as a function
	var _registerControl = function(_control)
	{
		//create an event sink for the control so events can be handled
		var _eventSource = new _EventSource(_control);

		var _sendEvent = function(_event,_data)
		{
			//think about setting these up as handlers...
			switch(_event)
			{
			case 'enable':
				//if sending an enbale event, set the enabled status of the control proxy
				//so that if it's disabled, messages can be ignored
				_control.enabled  = _data[0];
				break;
			}
			_sendMessage('control',_control.name,_event,_data);
		};

		//links the event _event, from the object _source to the MXF event _linkedEvent.
		// Every time _event is fired by _source, _linkedEvent is fired
		// arguments passed to fireEvent are proxied
		var _linkEvent = function(_linkedEvent,_source,_event)
		{
			_source.addEvent(_event,function()
			{
				_sendEvent.call(void 0,_linkedEvent,[].slice.call(arguments,0));
			});
			return this;
		};

		//in this function "this" is the name of the event
		var _fireEvent = function(_event,_args)
		{
			//silently ignore changes on the registered side
			switch(_event)
			{
			case 'change':
				if(!_control.enabled //ignore messages if the control is supposed to be disabled
				|| !_isValidValue.call(_control,_args[0])) //ignore messages if the value is invalid
				{
					return;
				}
				break;
			}
			_eventSource._fireEvent(_event,_args);
		};

		var _actualSendEvent;

		var _ignoreChange = function(){
			if(!_actualSendEvent){
				_actualSendEvent = _sendEvent;

				this._sendEvent = _sendEvent = function(event){
					if(event == 'change'){
						return;
					}else{
						_actualSendEvent.apply(this,arguments);
					}
				};
			}
			return this;
		};


		//this is the internal interface used by MXF to fire events on the MXFcontrol proxy
		_registeredControls[_control.name] = {
			_control: _control,
			_fireEvent: _fireEvent
		};

		//let the other side know the control exists
		_sendMessage('register',_control);

		//this interface is exposed to the code that registered the control
		_extend(_control,{
			sendEvent: _sendEvent,
			linkEvent: _linkEvent,
			addEvent: _eventSource._addEvent,
			addEvents: _eventSource._addEvents,
			addOneShotEvent: _eventSource._addOneShotEvent,
			removeEvent: _eventSource._removeEvent,
			removeEvents: _eventSource._removeEvents,
			ignoreChange: _ignoreChange
		});

		return _control;
	};

	var _sendOutcome = function(_outcome)
	{
		//if a formatter exists, use it to convert property
		var _MXFoutcome ={},
			_property,
			_outcomeCloners = {
				Balances: function()
				{
					var _balances = { Balance: {}};

					if(this.Balance)
					{
						_outcomeParser._arrayize(this.Balance).forEach(
							function(_balance)
							{
								_balances.Balance[_balance['@name']] = {
									//these balances are not in denom units
									amount: _outcomeParser._float(_balance['#text']),
									formattedAmount: _Currency.format(_balance['#text'])
								}
							}
						);
					}
					return _balances || {};
				},
				TransactionId:function(){
					return this;
				},
				OutcomeDetail:function()
				{
					return {
						Balance: _outcomeParser._float(_Currency.toCurrency(this.Balance)),
						Payout: _outcomeParser._float(_Currency.toCurrency(this.Payout)),
						Pending: _outcomeParser._float(_Currency.toCurrency(this.Pending)),
						Settled: _outcomeParser._float(_Currency.toCurrency(this.Settled))
					}
				},
				//might not need this, as console can use Balances['FREESPIN'].amount/TotalBet
				PromotionalFreeSpin:function(){
					return {
						count: _outcomeParser._int(this['@count']),
						gip: this['@gip'] === 'true'
					};
				},
				CustomData:function()
				{
					//customData is a string, so just copy it
					return this;
				}
			};

		for(_property in _outcome)
			if(_outcomeCloners[_property])
				_MXFoutcome[_property] = _outcomeCloners[_property].call(_outcome[_property]);

		_sendMessage('gameOutcome',_MXFoutcome);
	};

	var _enableEvents = function(_enable)
	{
		_eventsEnabled = !!_enable;
	};

	//add the global hook to message events
	window.addEventListener('message',_onMessageFromMXF,true);
	_MXFflags('log') && console.warn(_where+' is listening for messages');


	//add a hook for orientation events, but only if this is the top window
	//these don't fire in iframes
	window.top == window && window.addEventListener('com.igt.events.orientationchange',
		function(_event)
		{
			_sendMessage('orientationchange',_event.orientation);
		},false
	);

	window.addEventListener('beforeunload',function(){
		if(document.exitFullscreen){
			document.exitFullscreen();
		}else if(document.mozCancelFullScreen){
			document.mozCancelFullScreen();
		}else if(document.webkitExitFullscreen){
			document.webkitExitFullscreen();
		}
	});

	var _gameInterface = {
		addEvent: _eventHandlers._addEvent,
		addEvents: _eventHandlers._addEvents,
		addOneShotEvent: _eventHandlers._addOneShotEvent,
		removeEvent: _eventHandlers._removeEvent,
		removeEvents: _eventHandlers._removeEvents,
		sendMessage: _sendMessage,
		enableEvents: _enableEvents,
		registerControl: _registerControl,
		sendOutcome: _sendOutcome,
		setCurrencyFormat: _setCurrencyFormat
	};

	var _bridgeInterface = {
		//sanitise the evenst that can be bound?
		addEvent: _eventHandlers._addEvent,
		addEvents: _eventHandlers._addEvents,
		addOneShotEvent: _eventHandlers._addOneShotEvent,
		removeEvent: _eventHandlers._removeEvent,
		removeEvents: _eventHandlers._removeEvents,
		resume: _resume,
		sendMessage: _sendMessage,
		fireEvent: _eventHandlers._fireEvent
	};

	//contains the public API
	var _interface = {
		setMessageOrigin: _setMessageOrigin,
		setCurrencyFormat: _setCurrencyFormat,
		sendOutcome: _sendOutcome,
		getGameInterface: function()
		{
			delete _interface.getGameInterface;
			delete _interface.getBridgeInterface;
			return _gameInterface;
		},
		getBridgeInterface: function()
		{
			delete _interface.getGameInterface;
			delete _interface.getBridgeInterface;
			return _gameInterface;
		},
		addEvent: _eventHandlers._addEvent,
		addEvents: _eventHandlers._addEvents,
		addOneShotEvent: _eventHandlers._addOneShotEvent,
		removeEvent: _eventHandlers._removeEvent,
		removeEvents: _eventHandlers._removeEvents,
		//only resume if all the handlers called resume, otherwise something async is going on
		resume: _resume,
//MXF sendMessage should not be exposed
		sendMessage: _sendMessage,
		setMessageOrigin: _setMessageOrigin,
		//should not be used by the bridge
		enableEvents: _enableEvents,
//MXF best thing to do is for the bridge to get a ref via a trapdoor. would rather not expose this :(
		fireEvent: _eventHandlers._fireEvent,
//Only needed on the game side, but how to get the right API?
		registerControl: _registerControl,
		commands: _commands,
		MXFflags: _MXFflags,
		launchParameters: _queryString
	};

	return _interface;
})();
