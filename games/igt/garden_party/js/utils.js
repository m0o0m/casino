//Combine some small js files together.


/**
 * StringBuilder class
 *
 */

/**
 * StringBuilder constructor.
 *
 */
function StringBuilder()
{
	this._s = "";
}

/**
 * Appends an object to the string.
 * @param o The object to append.
 * @return Returns this StringBuilder.
 */
StringBuilder.prototype.append = function(o)
{
	this._s += o;
	return this;
}

/**
 * Appends a newline character.
 * @return 
 */
StringBuilder.prototype.newline = function()
{
	this._s += "\n";
	return this;
}

/**
 * Gets the String from the StringBuilder.
 * @return Returns the String from the string builder.
 */
StringBuilder.prototype.toString = function()
{
	return this._s;
}


/**
 * Coordinate class.
 *
 */


/**
 *
 */
function Coordinate(x, y)
{
	this._x = x;
	this._y = y;
}

/**
 *
 */
Coordinate.prototype.add = function(p)
{
	return new Point(
			this._x + p.x(),
			this._y + p.y());
}

/**
 *
 */
Coordinate.prototype.subtract = function(p)
{
	return new Point(
			this._x - p.x(),
			this._y - p.y());
}

/**
 *
 */
Coordinate.prototype.multiply = function(p)
{
	return new Point(
			this._x * p.x(),
			this._y * p.y());
}

/**
 *
 */
Coordinate.prototype.toString = function()
{
	return this._x + ", " + this._y;
}

/**
 * Border class.
 *
 */
function Border(top, bottom, left, right)
{
	this._top = top;
	this._bottom = bottom;
	this._left = left;
	this._right = right;
}

/**
 * Returns the height of the top border.
 * @return The height of the top border.
 */
Border.prototype.top = function()
{
	return this._top;
}

/**
 * Returns the height of the bottom border.
 * @return The height of the bottom border.
 */
Border.prototype.bottom = function()
{
	return this._bottom;
}

/**
 * Returns the width of the left border.
 * @return The width of the left border.
 */
Border.prototype.left = function()
{
	return this._left;
}

/**
 * Returns the width of the right border.
 * @return The width of the right border.
 */
Border.prototype.right = function()
{
	return this._right;
}

/**
 * Adds this border by another.
 * @param b The boarder to subtract.
 * @return Returns the result of the subtraction.
 */
Border.prototype.add = function(b)
{
	return new Border(
		this._top + b.top(),
		this._bottom + b.bottom(),
		this._left + b.left(),
		this._right + b.right());
}

/**
 * Subtracts this border by another.
 * @param b The boarder to subtract.
 * @return Returns the result of the subtraction.
 */
Border.prototype.subtract = function(b)
{
	return new Border(
		this._top - b.top(),
		this._bottom - b.bottom(),
		this._left - b.left(),
		this._right - b.right());
}

/**
 * Multiplies this border by another.
 * @param b The boarder to multiply by.
 * @return Returns the result of the multiplication.
 */
Border.prototype.multiply = function(b)
{
	return new Border(
		this._top * b.top(),
		this._bottom * b.bottom(),
		this._left * b.left(),
		this._right * b.right());
}

/**
 * Returns a new border multiplied by the scale amount.
 * @param s The amount to scale the object by.
 * @return Returns the results of the scaling.
 */
Border.prototype.scale = function(s)
{
	return new Border(
		this._top * s,
		this._bottom * s,
		this._left * s,
		this._right * s);
}

/**
 *
 */
Border.prototype.toString = function()
{
	return this._top + ", " + this._bottom + ", " + this._left + ", " + this._right;
}



/**
 * Dimension class.
 *
 */

/**
 *
 */
function Dimension(width, height)
{
	this._width = width;
	this._height  = height;
}

/**
 *
 */
Dimension.prototype.width = function()
{
	return this._width;
}

/**
 *
 */
Dimension.prototype.height = function()
{
	return this._height;
}

/**
 * Gets the aspect ratio of the object.
 * @return The aspect ratio.
 */
Dimension.prototype.aspect = function()
{
	return this._width / this._height;
}

/**
 *
 */
Dimension.prototype.add = function(d)
{
	return new Dimension(
			this._width + d.width(),
			this._height + d.height());
}

/**
 *
 */
Dimension.prototype.subtract = function(d)
{
	return new Dimension(
			this._width - d.width(),
			this._height - d.height());
}

/**
 *
 */
Dimension.prototype.multiply = function(d)
{
	return new Dimension(
			this._width * d.width(),
			this._height * d.height());
}

/**
 *
 */
Dimension.prototype.scale = function(s)
{
	return new Dimension(
			this._width * s,
			this._height * s);
}

/**
 *
 */
Dimension.prototype.equals = function(d)
{
	return (this._width == d.width() && this._height == d.height());
}

/**
 *
 */
Dimension.prototype.toString = function()
{
	return this._width + " x " + this._height;
}


/**
 * Combine resize.js.
 *
 */
 
var DEBUG = false;

var NON_IE_PROPERTY_TYPE = 1;
var IE_PROPERTY_TYPE = 2;

/***********************************************************/
/***** GameWindow Class ************************************/
/***********************************************************/

/**
 *
 */
function GameWindow(width, height)
{
	this._threshold = 0.02;
	this._p = null;
	this._d = new Dimension(width, height);
	this.properties();
	this.target();
	
	if(DEBUG)
	{
		var sb = new StringBuilder();
		sb.append("Game Properties")
			.newline()
			.newline()
			.append("size: ")
			.append(this._d.toString())
			.newline()
			.append("aspect: ")
			.append(this._d.aspect());
		
		alert(sb.toString());
		
		var wpp = new WindowPropertiesPrinter(this._p);
		wpp.print();
	}
	
}

/**
 *
 */
GameWindow.prototype.dimensions = function()
{
	return this._d;
}

/**
 * 
 * @return
 */
GameWindow.prototype.target = function()
{
	this._target = new Dimension(
		this._p.border().left() + this._p.border().right() + this._d.width(),
		this._p.border().top() + this._p.border().bottom() + this._d.height())
	
	return this._target;
}

/**
 * 
 * @return
 */
GameWindow.prototype.properties = function()
{
	if(typeof(window.innerWidth) == 'number')
	{
		if(DEBUG) alert("Window Properties Type\n\nNon-IE window properties");
		this._p = new WindowProperties(this._p);
	}
	else if(document.documentElement && document.documentElement.clientWidth)
	{
		if(DEBUG) alert("Window Properties Type\n\nIE 6+ in 'standards compliant mode' window properties");
		this._p = new IE6StrictWindowProperties(this._p);
	}
	else if(document.body && document.body.clientWidth)
	{
		if(DEBUG) alert("Window Properties Type\n\nIE in 'quirks mode' window properties");
		this._p = new IEWindowProperties(this._p);
	}
	else
	{
		this._p = null;
	}
	
	return this._p;
}

/**
 * Calculates the amount to adjust the width and height.
 * @return Returns the adjustable width and height.
 */
GameWindow.prototype.calculateAdjustment = function()
{
	var widthAdj = 0;
	var heightAdj = 0;
	
	if(this._target.width() > screen.availWidth)
		widthAdj = this._target.width() - screen.availWidth;
	
	if(this._target.height() > screen.availHeight)
		var heightAdj = this._target.height() - screen.availHeight;
	
	return new Dimension(widthAdj, heightAdj);
}

/**
 *
 */
GameWindow.prototype.adjust = function()
{
	var adj = this.calculateAdjustment();
	
	while(adj.width() > 0 || adj.height() > 0)
	{
		if(adj.width() > adj.height())
		{
			var w = this._d.width() - adj.width();
			this._d = new Dimension(w, w / this._d.aspect());
		}
		else
		{
			var h = this._d.height() - adj.height();
			this._d = new Dimension(h * this._d.aspect(), h);
		}
		
		if(DEBUG)
		{
			var sb = new StringBuilder();
			sb.append("Game Properties")
				.newline()
				.newline()
				.append("size: ")
				.append(this._d.toString())
				.newline()
				.append("aspect: ")
				.append(this._d.aspect());
			
			alert(sb.toString());
		}
		
		this.target();
		adj = this.calculateAdjustment();
	}
	
}

/**
 * 
 * @return
 */
GameWindow.prototype.verify = function()
{
	var p = this.properties();
	
	if(p.type() == 1)
		return true;
	
	var a = this._d.aspect();
	var upper = a + this._threshold;
	var lower = a - this._threshold;
	
	a = p.inner().aspect();
	
	return (a < upper && a > lower);
	
}

/**
 * 
 */
GameWindow.prototype.resize = function()
{
	window.resizeTo(this._target.width(), this._target.height());
	
	if(DEBUG)
	{
		var wpp = new WindowPropertiesPrinter(this.properties());
		wpp.print();
	}
}

/**
 * 
 */
GameWindow.prototype.center = function()
{
	var x = (screen.availWidth / 2) - (this._target.width() / 2);
	var y = (screen.availHeight / 2) - (this._target.height() / 2);
	
	window.moveTo(x,y);
}

/**
 *
 */
GameWindow.prototype.calculatePostAdjustment = function()
{
	var w = this._d.width() - this._p.inner().width();
	var h = this._d.height() - this._p.inner().height();
	return new Dimension(w, h);
}

/**
 * 
 */
GameWindow.prototype.postAdjust = function()
{
	var d = this.calculatePostAdjustment();

	if(d.width() > d.height())
	{
		this._d = new Dimension(
				this._p.inner().width(),
				this._p.inner().width() / this._d.aspect());
	}
	else
	{
		this._d = new Dimension(
				this._p.inner().height() * this._d.aspect(),
				this._p.inner().height());
	}

	this.target();

	window.resizeTo(this._target.width(), this._target.height());

	this.properties();
	d = this.calculatePostAdjustment();

	if(d.width() > 0 || d.height() > 0)
	{
		window.resizeTo(
				this._target.width() + d.width(),
				this._target.height() + d.height());
	}

	if(DEBUG)
	{
		var wpp = new WindowPropertiesPrinter(this.properties());
		wpp.print();
	}

}

/**
 * 
 */
GameWindow.prototype.moveAndResize = function()
{
	//window.moveTo(0,0);
	
	this.adjust();
	this.resize();
	this.center();
	
	if(!this.verify())
		this.postAdjust();

}

/***********************************************************/
/***** WindowProperties Class ******************************/
/***********************************************************/

/**
 *
 *
 */
function WindowProperties(p)
{
	if(p == null)
		this._border = new Border(
				(window.outerHeight - window.innerHeight) / 2,
				(window.outerHeight - window.innerHeight) / 2,
				(window.outerWidth - window.innerWidth) / 2,
				(window.outerWidth - window.innerWidth) / 2);
	else
		this._border = p.border();
	
	this._inner = new Dimension(window.innerWidth, window.innerHeight);
	this._outer = new Dimension(window.outerWidth, window.outerHeight);
	this._type = NON_IE_PROPERTY_TYPE;
}

/**
 *
 */
WindowProperties.prototype.border = function()
{
	return this._border;
}

/**
 *
 */
WindowProperties.prototype.outer = function()
{
	return this._outer;
}

/**
 *
 */
WindowProperties.prototype.inner = function()
{
	return this._inner;
}

/**
 * 
 * @return
 */
WindowProperties.prototype.type = function()
{
	return this._type;
}

/***********************************************************/
/***** IE6StrictWindowProperties Class *********************/
/***********************************************************/

/**
 * 
 */
function IE6StrictWindowProperties(p)
{
	if(p == null)
	{
		window.moveTo(0,0);
		
		this._border = new Border(
			window.screenTop + document.documentElement.clientTop,
			window.screenLeft + document.documentElement.clientTop,
			window.screenLeft + document.documentElement.clientLeft,
			window.screenLeft + document.documentElement.clientLeft);
	}
	else
	{
		this._border = p.border();
	}
	
	this._inner = new Dimension(
		document.documentElement.clientWidth,
		document.documentElement.clientHeight);
	
	this._outer = new Dimension(
		document.documentElement.offsetWidth + (this._border.left() * 2),
		document.documentElement.offsetHeight + this._border.left() + window.screenTop);
	
	this._type = IE_PROPERTY_TYPE;
}

/**
 *
 */
IE6StrictWindowProperties.prototype.border = function()
{
	return this._border;
}

/**
 *
 */
IE6StrictWindowProperties.prototype.outer = function()
{
	return this._outer;
}

/**
 *
 */
IE6StrictWindowProperties.prototype.inner = function()
{
	return this._inner;
}

/**
 * 
 * @return
 */
IE6StrictWindowProperties.prototype.type = function()
{
	return this._type;
}

/***********************************************************/
/***** IEWindowProperties Class ****************************/
/***********************************************************/

/**
 *
 *
 */
function IEWindowProperties(p)
{
	if(p == null)
	{
		window.moveTo(0,0);
		
		this._border = new Border(
			window.screenTop + document.body.clientTop,
			window.screenLeft + document.body.clientTop,
			window.screenLeft + document.body.clientLeft,
			window.screenLeft + document.body.clientLeft);
	}
	else
	{
		this._border = p.border();
	}
	
	this._inner = new Dimension(
		document.body.clientWidth,
		document.body.clientHeight);
	
	this._outer = new Dimension(
		document.body.offsetWidth + (this._border.left() * 2),
		document.body.offsetHeight + this._border.left() + window.screenTop);
	
	this._type = IE_PROPERTY_TYPE;
	
}

/**
 *
 */
IEWindowProperties.prototype.border = function()
{
	return this._border;
}

/**
 *
 */
IEWindowProperties.prototype.outer = function()
{
	return this._outer;
}

/**
 *
 */
IEWindowProperties.prototype.inner = function()
{
	return this._inner;
}

/**
 * 
 * @return
 */
IEWindowProperties.prototype.type = function()
{
	return this._type;
}

/***********************************************************/
/***** WindowPropertiesPrinter Class ***********************/
/***********************************************************/

/**
 *
 *
 */
function WindowPropertiesPrinter(p)
{
	this._p = p;
}

/**
 *
 *
 */
WindowPropertiesPrinter.prototype.print = function()
{
	if(this._p == null)
		alert("Window properties are null.");

	var sb = new StringBuilder();
	sb.append("Window Properties")
		.newline()
		.newline()
		.append("border: ")
		.append(this._p.border().toString())
		.newline()
		.append("outer: ")
		.append(this._p.outer().toString())
		.newline()
		.append("inner: ")
		.append(this._p.inner().toString())
		.newline()
		.append("aspect: ")
		.append(this._p.inner().width() / this._p.inner().height())
		.newline()
		.append("type: ")
		.append(this._p.type());
		
	alert(sb.toString());
}

 