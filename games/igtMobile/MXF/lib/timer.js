//provides a clock and a timer
//requires extern.js
//see the default skin it htdocs/skins/default for example of how to include this
//
// call com.igt.mxf.timer(). It returns an object with an element property so the caller can add it to the DOM and some handy functions
// that are self explanatory, look neear the end of this file
//
// if the console url has a url custom parameter ${SKINCODE}_elapsed
// the value should be the number of seconds elapsed since the start of the session
// if the parameter does not exist or cannot be converted to an integer, the timer starts from 0

com.igt.extern('console.timer');
com.igt.console.timer = function(id,clockClassName,timerClassName){
	"use strict";
	
	//add a leading 0 so the number is always 2 digits
	function format2digits(d){
		return (d<10 ? '0' : '' ) + d;
	}

	function formatTime(date){
		return [
			date.getHours(),
			date.getMinutes(),
			date.getSeconds(),
		].map(format2digits).join(':');
	}

	
	function formatElapsedTime(startTime,currentTime){

		var elapsed = (+currentTime) - (+startTime); //unary plus casts date objects to epoch
		var h,m,s; //for hours minutes and seconds

		//drop the milliseconds
		elapsed -= elapsed%1000;
		elapsed /= 1000;

		//seconds
		s = elapsed%60;
		//minutes
		elapsed -= s;
		elapsed /= 60;
		m = elapsed%60;
		//hours
		elapsed -= m;
		elapsed /= 60;
		h = elapsed%24;

		//display hours only if > 0
		return (h > 0 ? [h,m,s] : [m,s]).map(format2digits).join(':');
	}

	var containerElement = document.createElement('div');
	containerElement.id = id || '';

	var clockElement;
	var timerElement;
	
	if(clockClassName){
		clockElement = document.createElement('div');
		clockElement.className = clockClassName;
		containerElement.appendChild(clockElement);
	}

	if(timerClassName){
		timerElement = document.createElement('div');
		timerElement.className = timerClassName;
		containerElement.appendChild(timerElement);
	}

	//check if there is an elapsed time on the url, if so, use it, otherwise 
	var startTime = parseInt(com.igt.mxf.launchParameters[com.igt.mxf.launchParameters['skincode'] + '_elapsed']);
	if(startTime){
		startTime = new Date(startTime*1000);
	}else{
		startTime = +new Date();
	}
	var lastClock;
	var lastTimer;
	
	//set up an interval to update the timer and clock at 5HZ
	//just fast enough to give fairly accurate seconds without stressing the browser
	var interval;

	function run(bRun){
		if(bRun && !interval){
			interval = setInterval(function(){
				var now = new Date();
				var newClock;
				var newTimer;

				if(clockClassName){
					newClock = formatTime(now);
					if(newClock != lastClock){ //don't update the DOM unless the time actually changed enough
						clockElement.innerText = newClock;
					}
					lastClock = newClock;
				}

				if(timerClassName){
					newTimer = formatElapsedTime(startTime,now);
					if(newTimer != lastTimer){ //don't update the DOM unless the time actually changed enough
						timerElement.innerText = newTimer;
					}
					lastTimer = newTimer;
				}
			},200);
		}else if(!bRun && interval){
			interval = clearInterval(interval);
		}
	}

	run(true);

	return {
		element: containerElement,
		show: function(bShow){
			containerElement.style.display = bShow ? '' : 'none';
			run(bShow);
		},
		showTimer: function(bShow){
			if(timerElement){
				timerElement.style.display = bShow ? '' : 'none';
			}
		},
		showClock: function(bShow){
			if(clockElement){
				timerElement.style.display = bShow ? '' : 'none';
			}
		}
	};

};