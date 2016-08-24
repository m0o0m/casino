var MooTools = {
    version: "1.2.4",
    build: "0d9113241a90b9cd5643b926795852a2026710d4"
};
var Native = function(options) {
    options = options || {};
    var name = options.name;
    var legacy = options.legacy;
    var protect = options.protect;
    var methods = options.implement;
    var generics = options.generics;
    var initialize = options.initialize;
    var afterImplement = options.afterImplement || function() {};
    var object = initialize || legacy;
    generics = generics !== false;
    object.constructor = Native;
    object.$family = {
        name: "native"
    };
    if (legacy && initialize) {
        object.prototype = legacy.prototype
    }
    object.prototype.constructor = object;
    if (name) {
        var family = name.toLowerCase();
        object.prototype.$family = {
            name: family
        };
        Native.typize(object, family)
    }
    var add = function(obj, name, method, force) {
        if (!protect || force || !obj.prototype[name]) {
            obj.prototype[name] = method
        }
        if (generics) {
            Native.genericize(obj, name, protect)
        }
        afterImplement.call(obj, name, method);
        return obj
    };
    object.alias = function(a1, a2, a3) {
        if (typeof a1 == "string") {
            var pa1 = this.prototype[a1];
            if ((a1 = pa1)) {
                return add(this, a2, a1, a3)
            }
        }
        for (var a in a1) {
            this.alias(a, a1[a], a2)
        }
        return this
    };
    object.implement = function(a1, a2, a3) {
        if (typeof a1 == "string") {
            return add(this, a1, a2, a3)
        }
        for (var p in a1) {
            add(this, p, a1[p], a2)
        }
        return this
    };
    if (methods) {
        object.implement(methods)
    }
    return object
};
Native.genericize = function(object, property, check) {
    if ((!check || !object[property]) && typeof object.prototype[property] == "function") {
        object[property] = function() {
            var args = Array.prototype.slice.call(arguments);
            return object.prototype[property].apply(args.shift(), args)
        }
    }
};
Native.implement = function(objects, properties) {
    for (var i = 0, l = objects.length; i < l; i++) {
        objects[i].implement(properties)
    }
};
Native.typize = function(object, family) {
    if (!object.type) {
        object.type = function(item) {
            return ($type(item) === family)
        }
    }
};
(function() {
    var natives = {
        Array: Array,
        Date: Date,
        Function: Function,
        Number: Number,
        RegExp: RegExp,
        String: String
    };
    for (var n in natives) {
        new Native({
            name: n,
            initialize: natives[n],
            protect: true
        })
    }
    var types = {
        "boolean": Boolean,
        "native": Native,
        object: Object
    };
    for (var t in types) {
        Native.typize(types[t], t)
    }
    var generics = {
        Array: ["concat", "indexOf", "join", "lastIndexOf", "pop", "push", "reverse", "shift", "slice", "sort", "splice", "toString", "unshift", "valueOf"],
        String: ["charAt", "charCodeAt", "concat", "indexOf", "lastIndexOf", "match", "replace", "search", "slice", "split", "substr", "substring", "toLowerCase", "toUpperCase", "valueOf"]
    };
    for (var g in generics) {
        for (var i = generics[g].length; i--;) {
            Native.genericize(natives[g], generics[g][i], true)
        }
    }
})();
var Hash = new Native({
    name: "Hash",
    initialize: function(object) {
        if ($type(object) == "hash") {
            object = $unlink(object.getClean())
        }
        for (var key in object) {
            this[key] = object[key]
        }
        return this
    }
});
Hash.implement({
    forEach: function(fn, bind) {
        for (var key in this) {
            if (this.hasOwnProperty(key)) {
                fn.call(bind, this[key], key, this)
            }
        }
    },
    getClean: function() {
        var clean = {};
        for (var key in this) {
            if (this.hasOwnProperty(key)) {
                clean[key] = this[key]
            }
        }
        return clean
    },
    getLength: function() {
        var length = 0;
        for (var key in this) {
            if (this.hasOwnProperty(key)) {
                length++
            }
        }
        return length
    }
});
Hash.alias("forEach", "each");
Array.implement({
    forEach: function(fn, bind) {
        for (var i = 0, l = this.length; i < l; i++) {
            fn.call(bind, this[i], i, this)
        }
    }
});
Array.alias("forEach", "each");

function $A(iterable) {
    if (iterable.item) {
        var l = iterable.length,
            array = new Array(l);
        while (l--) {
            array[l] = iterable[l]
        }
        return array
    }
    return Array.prototype.slice.call(iterable)
}

function $arguments(i) {
    return function() {
        return arguments[i]
    }
}

function $chk(obj) {
    return !!(obj || obj === 0)
}

function $clear(timer) {
    clearTimeout(timer);
    clearInterval(timer);
    return null
}

function $defined(obj) {
    return (obj != undefined)
}

function $each(iterable, fn, bind) {
    var type = $type(iterable);
    ((type == "arguments" || type == "collection" || type == "array") ? Array : Hash).each(iterable, fn, bind)
}

function $empty() {}

function $extend(original, extended) {
    for (var key in (extended || {})) {
        original[key] = extended[key]
    }
    return original
}

function $H(object) {
    return new Hash(object)
}

function $lambda(value) {
    return ($type(value) == "function") ? value : function() {
        return value
    }
}

function $merge() {
    var args = Array.slice(arguments);
    args.unshift({});
    return $mixin.apply(null, args)
}

function $mixin(mix) {
    for (var i = 1, l = arguments.length; i < l; i++) {
        var object = arguments[i];
        if ($type(object) != "object") {
            continue
        }
        for (var key in object) {
            var op = object[key],
                mp = mix[key];
            mix[key] = (mp && $type(op) == "object" && $type(mp) == "object") ? $mixin(mp, op) : $unlink(op)
        }
    }
    return mix
}

function $pick() {
    for (var i = 0, l = arguments.length; i < l; i++) {
        if (arguments[i] != undefined) {
            return arguments[i]
        }
    }
    return null
}

function $random(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min)
}

function $splat(obj) {
    var type = $type(obj);
    return (type) ? ((type != "array" && type != "arguments") ? [obj] : obj) : []
}
var $time = Date.now || function() {
    return +new Date
};

function $try() {
    for (var i = 0, l = arguments.length; i < l; i++) {
        try {
            return arguments[i]()
        } catch (e) {}
    }
    return null
}

function $type(obj) {
    if (obj == undefined) {
        return false
    }
    if (obj.$family) {
        return (obj.$family.name == "number" && !isFinite(obj)) ? false : obj.$family.name
    }
    if (obj.nodeName) {
        switch (obj.nodeType) {
            case 1:
                return "element";
            case 3:
                return (/\S/).test(obj.nodeValue) ? "textnode" : "whitespace"
        }
    } else {
        if (typeof obj.length == "number") {
            if (obj.callee) {
                return "arguments"
            } else {
                if (obj.item) {
                    return "collection"
                }
            }
        }
    }
    return typeof obj
}

function $unlink(object) {
    var unlinked;
    switch ($type(object)) {
        case "object":
            unlinked = {};
            for (var p in object) {
                unlinked[p] = $unlink(object[p])
            }
            break;
        case "hash":
            unlinked = new Hash(object);
            break;
        case "array":
            unlinked = [];
            for (var i = 0, l = object.length; i < l; i++) {
                unlinked[i] = $unlink(object[i])
            }
            break;
        default:
            return object
    }
    return unlinked
}
var Browser = $merge({
    Engine: {
        name: "unknown",
        version: 0
    },
    Platform: {
        name: (window.orientation != undefined) ? "ipod" : (navigator.platform.match(/mac|win|linux/i) || ["other"])[0].toLowerCase()
    },
    Features: {
        xpath: !!(document.evaluate),
        air: !!(window.runtime),
        query: !!(document.querySelector)
    },
    Plugins: {},
    Engines: {
        presto: function() {
            return (!window.opera) ? false : ((arguments.callee.caller) ? 960 : ((document.getElementsByClassName) ? 950 : 925))
        },
        trident: function() {
            return (!window.ActiveXObject) ? false : ((window.XMLHttpRequest) ? ((document.querySelectorAll) ? 6 : 5) : 4)
        },
        webkit: function() {
            return (navigator.taintEnabled) ? false : ((Browser.Features.xpath) ? ((Browser.Features.query) ? 525 : 420) : 419)
        },
        gecko: function() {
            return (!document.getBoxObjectFor && window.mozInnerScreenX == null) ? false : ((document.getElementsByClassName) ? 19 : 18)
        }
    }
}, Browser || {});
Browser.Platform[Browser.Platform.name] = true;
Browser.detect = function() {
    for (var engine in this.Engines) {
        var version = this.Engines[engine]();
        if (version) {
            this.Engine = {
                name: engine,
                version: version
            };
            this.Engine[engine] = this.Engine[engine + version] = true;
            break
        }
    }
    return {
        name: engine,
        version: version
    }
};
Browser.detect();
Browser.Request = function() {
    return $try(function() {
        return new XMLHttpRequest()
    }, function() {
        return new ActiveXObject("MSXML2.XMLHTTP")
    }, function() {
        return new ActiveXObject("Microsoft.XMLHTTP")
    })
};
Browser.Features.xhr = !!(Browser.Request());
Browser.Plugins.Flash = (function() {
    var version = ($try(function() {
        return navigator.plugins["Shockwave Flash"].description
    }, function() {
        return new ActiveXObject("ShockwaveFlash.ShockwaveFlash").GetVariable("$version")
    }) || "0 r0").match(/\d+/g);
    return {
        version: parseInt(version[0] || 0 + "." + version[1], 10) || 0,
        build: parseInt(version[2], 10) || 0
    }
})();

function $exec(text) {
    if (!text) {
        return text
    }
    if (window.execScript) {
        window.execScript(text)
    } else {
        var script = document.createElement("script");
        script.setAttribute("type", "text/javascript");
        script[(Browser.Engine.webkit && Browser.Engine.version < 420) ? "innerText" : "text"] = text;
        document.head.appendChild(script);
        document.head.removeChild(script)
    }
    return text
}
Native.UID = 1;
var $uid = (Browser.Engine.trident) ? function(item) {
    return (item.uid || (item.uid = [Native.UID++]))[0]
} : function(item) {
    return item.uid || (item.uid = Native.UID++)
};
var Window = new Native({
    name: "Window",
    legacy: (Browser.Engine.trident) ? null : window.Window,
    initialize: function(win) {
        $uid(win);
        if (!win.Element) {
            win.Element = $empty;
            if (Browser.Engine.webkit) {
                win.document.createElement("iframe")
            }
            win.Element.prototype = (Browser.Engine.webkit) ? window["[[DOMElement.prototype]]"] : {}
        }
        win.document.window = win;
        return $extend(win, Window.Prototype)
    },
    afterImplement: function(property, value) {
        window[property] = Window.Prototype[property] = value
    }
});
Window.Prototype = {
    $family: {
        name: "window"
    }
};
new Window(window);
var Document = new Native({
    name: "Document",
    legacy: (Browser.Engine.trident) ? null : window.Document,
    initialize: function(doc) {
        $uid(doc);
        doc.head = doc.getElementsByTagName("head")[0];
        doc.html = doc.getElementsByTagName("html")[0];
        if (Browser.Engine.trident && Browser.Engine.version <= 4) {
            $try(function() {
                doc.execCommand("BackgroundImageCache", false, true)
            })
        }
        if (Browser.Engine.trident) {
            doc.window.attachEvent("onunload", function() {
                doc.window.detachEvent("onunload", arguments.callee);
                doc.head = doc.html = doc.window = null
            })
        }
        return $extend(doc, Document.Prototype)
    },
    afterImplement: function(property, value) {
        document[property] = Document.Prototype[property] = value
    }
});
Document.Prototype = {
    $family: {
        name: "document"
    }
};
new Document(document);
Array.implement({
    every: function(fn, bind) {
        for (var i = 0, l = this.length; i < l; i++) {
            if (!fn.call(bind, this[i], i, this)) {
                return false
            }
        }
        return true
    },
    filter: function(fn, bind) {
        var results = [];
        for (var i = 0, l = this.length; i < l; i++) {
            if (fn.call(bind, this[i], i, this)) {
                results.push(this[i])
            }
        }
        return results
    },
    clean: function() {
        return this.filter($defined)
    },
    indexOf: function(item, from) {
        var len = this.length;
        for (var i = (from < 0) ? Math.max(0, len + from) : from || 0; i < len; i++) {
            if (this[i] === item) {
                return i
            }
        }
        return -1
    },
    map: function(fn, bind) {
        var results = [];
        for (var i = 0, l = this.length; i < l; i++) {
            results[i] = fn.call(bind, this[i], i, this)
        }
        return results
    },
    some: function(fn, bind) {
        for (var i = 0, l = this.length; i < l; i++) {
            if (fn.call(bind, this[i], i, this)) {
                return true
            }
        }
        return false
    },
    associate: function(keys) {
        var obj = {},
            length = Math.min(this.length, keys.length);
        for (var i = 0; i < length; i++) {
            obj[keys[i]] = this[i]
        }
        return obj
    },
    link: function(object) {
        var result = {};
        for (var i = 0, l = this.length; i < l; i++) {
            for (var key in object) {
                if (object[key](this[i])) {
                    result[key] = this[i];
                    delete object[key];
                    break
                }
            }
        }
        return result
    },
    contains: function(item, from) {
        return this.indexOf(item, from) != -1
    },
    extend: function(array) {
        for (var i = 0, j = array.length; i < j; i++) {
            this.push(array[i])
        }
        return this
    },
    getLast: function() {
        return (this.length) ? this[this.length - 1] : null
    },
    getRandom: function() {
        return (this.length) ? this[$random(0, this.length - 1)] : null
    },
    include: function(item) {
        if (!this.contains(item)) {
            this.push(item)
        }
        return this
    },
    combine: function(array) {
        for (var i = 0, l = array.length; i < l; i++) {
            this.include(array[i])
        }
        return this
    },
    erase: function(item) {
        for (var i = this.length; i--; i) {
            if (this[i] === item) {
                this.splice(i, 1)
            }
        }
        return this
    },
    empty: function() {
        this.length = 0;
        return this
    },
    flatten: function() {
        var array = [];
        for (var i = 0, l = this.length; i < l; i++) {
            var type = $type(this[i]);
            if (!type) {
                continue
            }
            array = array.concat((type == "array" || type == "collection" || type == "arguments") ? Array.flatten(this[i]) : this[i])
        }
        return array
    },
    hexToRgb: function(array) {
        if (this.length != 3) {
            return null
        }
        var rgb = this.map(function(value) {
            if (value.length == 1) {
                value += value
            }
            return value.toInt(16)
        });
        return (array) ? rgb : "rgb(" + rgb + ")"
    },
    rgbToHex: function(array) {
        if (this.length < 3) {
            return null
        }
        if (this.length == 4 && this[3] == 0 && !array) {
            return "transparent"
        }
        var hex = [];
        for (var i = 0; i < 3; i++) {
            var bit = (this[i] - 0).toString(16);
            hex.push((bit.length == 1) ? "0" + bit : bit)
        }
        return (array) ? hex : "#" + hex.join("")
    }
});
Function.implement({
    extend: function(properties) {
        for (var property in properties) {
            this[property] = properties[property]
        }
        return this
    },
    create: function(options) {
        var self = this;
        options = options || {};
        return function(event) {
            var args = options.arguments;
            args = (args != undefined) ? $splat(args) : Array.slice(arguments, (options.event) ? 1 : 0);
            if (options.event) {
                args = [event || window.event].extend(args)
            }
            var returns = function() {
                return self.apply(options.bind || null, args)
            };
            if (options.delay) {
                return setTimeout(returns, options.delay)
            }
            if (options.periodical) {
                return setInterval(returns, options.periodical)
            }
            if (options.attempt) {
                return $try(returns)
            }
            return returns()
        }
    },
    run: function(args, bind) {
        return this.apply(bind, $splat(args))
    },
    pass: function(args, bind) {
        return this.create({
            bind: bind,
            arguments: args
        })
    },
    bind: function(bind) {
        var self = this,
            args = [].slice.call(arguments, 1);
        return function() {
            return self.apply(bind, args.concat([].slice.call(arguments, 0)))
        }
    },
    bindWithEvent: function(bind) {
        var self = this,
            args = [].slice.call(arguments, 1);
        return function(event) {
            return self.apply(bind, [event || window.event].concat(args, [].slice.call(arguments, 0)))
        }
    },
    attempt: function(args, bind) {
        return this.create({
            bind: bind,
            arguments: args,
            attempt: true
        })()
    },
    delay: function(delay, bind, args) {
        return this.create({
            bind: bind,
            arguments: args,
            delay: delay
        })()
    },
    periodical: function(periodical, bind, args) {
        return this.create({
            bind: bind,
            arguments: args,
            periodical: periodical
        })()
    }
});
Number.implement({
    limit: function(min, max) {
        return Math.min(max, Math.max(min, this))
    },
    round: function(precision) {
        precision = Math.pow(10, precision || 0);
        return Math.round(this * precision) / precision
    },
    times: function(fn, bind) {
        for (var i = 0; i < this; i++) {
            fn.call(bind, i, this)
        }
    },
    toFloat: function() {
        return parseFloat(this)
    },
    toInt: function(base) {
        return parseInt(this, base || 10)
    }
});
Number.alias("times", "each");
(function(math) {
    var methods = {};
    math.each(function(name) {
        if (!Number[name]) {
            methods[name] = function() {
                return Math[name].apply(null, [this].concat($A(arguments)))
            }
        }
    });
    Number.implement(methods)
})(["abs", "acos", "asin", "atan", "atan2", "ceil", "cos", "exp", "floor", "log", "max", "min", "pow", "sin", "sqrt", "tan"]);
String.implement({
    test: function(regex, params) {
        return ((typeof regex == "string") ? new RegExp(regex, params) : regex).test(this)
    },
    contains: function(string, separator) {
        return (separator) ? (separator + this + separator).indexOf(separator + string + separator) > -1 : this.indexOf(string) > -1
    },
    trim: function() {
        return this.replace(/^\s+|\s+$/g, "")
    },
    clean: function() {
        return this.replace(/\s+/g, " ").trim()
    },
    camelCase: function() {
        return this.replace(/-\D/g, function(match) {
            return match.charAt(1).toUpperCase()
        })
    },
    hyphenate: function() {
        return this.replace(/[A-Z]/g, function(match) {
            return ("-" + match.charAt(0).toLowerCase())
        })
    },
    capitalize: function() {
        return this.replace(/\b[a-z]/g, function(match) {
            return match.toUpperCase()
        })
    },
    escapeRegExp: function() {
        return this.replace(/([-.*+?^${}()|[\]\/\\])/g, "\\$1")
    },
    toInt: function(base) {
        return parseInt(this, base || 10)
    },
    toFloat: function() {
        return parseFloat(this)
    },
    hexToRgb: function(array) {
        var hex = this.match(/^#?(\w{1,2})(\w{1,2})(\w{1,2})$/);
        return (hex) ? hex.slice(1).hexToRgb(array) : null
    },
    rgbToHex: function(array) {
        var rgb = this.match(/\d{1,3}/g);
        return (rgb) ? rgb.rgbToHex(array) : null
    },
    stripScripts: function(option) {
        var scripts = "";
        var text = this.replace(/<script[^>]*>([\s\S]*?)<\/script>/gi, function() {
            scripts += arguments[1] + "\n";
            return ""
        });
        if (option === true) {
            $exec(scripts)
        } else {
            if ($type(option) == "function") {
                option(scripts, text)
            }
        }
        return text
    },
    substitute: function(object, regexp) {
        return this.replace(regexp || (/\\?\{([^{}]+)\}/g), function(match, name) {
            if (match.charAt(0) == "\\") {
                return match.slice(1)
            }
            return (object[name] != undefined) ? object[name] : ""
        })
    }
});
Hash.implement({
    has: Object.prototype.hasOwnProperty,
    keyOf: function(value) {
        for (var key in this) {
            if (this.hasOwnProperty(key) && this[key] === value) {
                return key
            }
        }
        return null
    },
    hasValue: function(value) {
        return (Hash.keyOf(this, value) !== null)
    },
    extend: function(properties) {
        Hash.each(properties || {}, function(value, key) {
            Hash.set(this, key, value)
        }, this);
        return this
    },
    combine: function(properties) {
        Hash.each(properties || {}, function(value, key) {
            Hash.include(this, key, value)
        }, this);
        return this
    },
    erase: function(key) {
        if (this.hasOwnProperty(key)) {
            delete this[key]
        }
        return this
    },
    get: function(key) {
        return (this.hasOwnProperty(key)) ? this[key] : null
    },
    set: function(key, value) {
        if (!this[key] || this.hasOwnProperty(key)) {
            this[key] = value
        }
        return this
    },
    empty: function() {
        Hash.each(this, function(value, key) {
            delete this[key]
        }, this);
        return this
    },
    include: function(key, value) {
        if (this[key] == undefined) {
            this[key] = value
        }
        return this
    },
    map: function(fn, bind) {
        var results = new Hash;
        Hash.each(this, function(value, key) {
            results.set(key, fn.call(bind, value, key, this))
        }, this);
        return results
    },
    filter: function(fn, bind) {
        var results = new Hash;
        Hash.each(this, function(value, key) {
            if (fn.call(bind, value, key, this)) {
                results.set(key, value)
            }
        }, this);
        return results
    },
    every: function(fn, bind) {
        for (var key in this) {
            if (this.hasOwnProperty(key) && !fn.call(bind, this[key], key)) {
                return false
            }
        }
        return true
    },
    some: function(fn, bind) {
        for (var key in this) {
            if (this.hasOwnProperty(key) && fn.call(bind, this[key], key)) {
                return true
            }
        }
        return false
    },
    getKeys: function() {
        var keys = [];
        Hash.each(this, function(value, key) {
            keys.push(key)
        });
        return keys
    },
    getValues: function() {
        var values = [];
        Hash.each(this, function(value) {
            values.push(value)
        });
        return values
    },
    toQueryString: function(base) {
        var queryString = [];
        Hash.each(this, function(value, key) {
            if (base) {
                key = base + "[" + key + "]"
            }
            var result;
            switch ($type(value)) {
                case "object":
                    result = Hash.toQueryString(value, key);
                    break;
                case "array":
                    var qs = {};
                    value.each(function(val, i) {
                        qs[i] = val
                    });
                    result = Hash.toQueryString(qs, key);
                    break;
                default:
                    result = key + "=" + encodeURIComponent(value)
            }
            if (value != undefined) {
                queryString.push(result)
            }
        });
        return queryString.join("&")
    }
});
Hash.alias({
    keyOf: "indexOf",
    hasValue: "contains"
});
var Event = new Native({
    name: "Event",
    initialize: function(event, win) {
        win = win || window;
        var doc = win.document;
        event = event || win.event;
        if (event.$extended) {
            return event
        }
        this.$extended = true;
        var type = event.type;
        var target = event.target || event.srcElement;
        while (target && target.nodeType == 3) {
            target = target.parentNode
        }
        if (type.test(/key/)) {
            var code = event.which || event.keyCode;
            var key = Event.Keys.keyOf(code);
            if (type == "keydown") {
                var fKey = code - 111;
                if (fKey > 0 && fKey < 13) {
                    key = "f" + fKey
                }
            }
            key = key || String.fromCharCode(code).toLowerCase()
        } else {
            if (type.match(/(click|mouse|menu)/i)) {
                doc = (!doc.compatMode || doc.compatMode == "CSS1Compat") ? doc.html : doc.body;
                var page = {
                    x: event.pageX || event.clientX + doc.scrollLeft,
                    y: event.pageY || event.clientY + doc.scrollTop
                };
                var client = {
                    x: (event.pageX) ? event.pageX - win.pageXOffset : event.clientX,
                    y: (event.pageY) ? event.pageY - win.pageYOffset : event.clientY
                };
                if (type.match(/DOMMouseScroll|mousewheel/)) {
                    var wheel = (event.wheelDelta) ? event.wheelDelta / 120 : -(event.detail || 0) / 3
                }
                var rightClick = (event.which == 3) || (event.button == 2);
                var related = null;
                if (type.match(/over|out/)) {
                    switch (type) {
                        case "mouseover":
                            related = event.relatedTarget || event.fromElement;
                            break;
                        case "mouseout":
                            related = event.relatedTarget || event.toElement
                    }
                    if (!(function() {
                            while (related && related.nodeType == 3) {
                                related = related.parentNode
                            }
                            return true
                        }).create({
                            attempt: Browser.Engine.gecko
                        })()) {
                        related = false
                    }
                }
            }
        }
        return $extend(this, {
            event: event,
            type: type,
            page: page,
            client: client,
            rightClick: rightClick,
            wheel: wheel,
            relatedTarget: related,
            target: target,
            code: code,
            key: key,
            shift: event.shiftKey,
            control: event.ctrlKey,
            alt: event.altKey,
            meta: event.metaKey
        })
    }
});
Event.Keys = new Hash({
    enter: 13,
    up: 38,
    down: 40,
    left: 37,
    right: 39,
    esc: 27,
    space: 32,
    backspace: 8,
    tab: 9,
    "delete": 46
});
Event.implement({
    stop: function() {
        return this.stopPropagation().preventDefault()
    },
    stopPropagation: function() {
        if (this.event.stopPropagation) {
            this.event.stopPropagation()
        } else {
            this.event.cancelBubble = true
        }
        return this
    },
    preventDefault: function() {
        if (this.event.preventDefault) {
            this.event.preventDefault()
        } else {
            this.event.returnValue = false
        }
        return this
    }
});

function Class(params) {
    if (params instanceof Function) {
        params = {
            initialize: params
        }
    }
    var newClass = function() {
        Object.reset(this);
        if (newClass.zs) {
            return this
        }
        this.M5 = $empty;
        var value = (this.initialize) ? this.initialize.apply(this, arguments) : this;
        delete this.M5;
        delete this.caller;
        return value
    }.extend(this);
    newClass.implement(params);
    newClass.constructor = Class;
    newClass.prototype.constructor = newClass;
    return newClass
}
Function.prototype.protect = function() {
    this.nG = true;
    return this
};
Object.reset = function(object, key) {
    if (key == null) {
        for (var p in object) {
            Object.reset(object, p)
        }
        return object
    }
    delete object[key];
    switch ($type(object[key])) {
        case "object":
            var F = function() {};
            F.prototype = object[key];
            var i = new F;
            object[key] = Object.reset(i);
            break;
        case "array":
            object[key] = $unlink(object[key]);
            break
    }
    return object
};
new Native({
    name: "Class",
    initialize: Class
}).extend({
    instantiate: function(F) {
        F.zs = true;
        var proto = new F;
        delete F.zs;
        return proto
    },
    wrap: function(self, key, method) {
        if (method.DI) {
            method = method.DI
        }
        return function() {
            if (method.nG && this.M5 == null) {
                throw new Error('The method "' + key + '" cannot be called.')
            }
            var caller = this.caller,
                current = this.M5;
            this.caller = current;
            this.M5 = arguments.callee;
            var result = method.apply(this, arguments);
            this.M5 = current;
            this.caller = caller;
            return result
        }.extend({
            xq: self,
            DI: method,
            bX: key
        })
    }
});
Class.implement({
    implement: function(key, value) {
        if ($type(key) == "object") {
            var keys = {};
            for (var p in key.__proto__) {
                keys[p] = 0
            }
            for (var p in key) {
                keys[p] = 0
            }
            for (var p in keys) {
                this.implement(p, key[p])
            }
            return this
        }
        if (Class.Mutators.hasOwnProperty(key)) {
            value = Class.Mutators[key].call(this, value);
            if (value == null) {
                return this
            }
        }
        var proto = this.prototype;
        switch ($type(value)) {
            case "function":
                if (value.e4) {
                    return this
                }
                proto[key] = Class.wrap(this, key, value);
                break;
            case "object":
                var previous = proto[key];
                if ($type(previous) == "object") {
                    $mixin(previous, value)
                } else {
                    proto[key] = $unlink(value)
                }
                break;
            case "array":
                proto[key] = $unlink(value);
                break;
            default:
                proto[key] = value
        }
        return this
    }
});
Class.Mutators = {
    Extends: function(parent) {
        this.parent = parent;
        this.prototype = Class.instantiate(parent);
        this.implement("parent", function() {
            var name = this.caller.bX,
                previous = this.caller.xq.parent.prototype[name];
            if (!previous) {
                throw new Error('The method "' + name + '" has no parent.')
            }
            return previous.apply(this, arguments)
        }.protect())
    },
    Implements: function(items) {
        $splat(items).each(function(item) {
            if (item instanceof Function) {
                item = Class.instantiate(item)
            }
            this.implement(item)
        }, this)
    }
};
var Chain = new Class({
    $chain: [],
    chain: function() {
        this.$chain.extend(Array.flatten(arguments));
        return this
    },
    callChain: function() {
        return (this.$chain.length) ? this.$chain.shift().apply(this, arguments) : false
    },
    clearChain: function() {
        this.$chain.empty();
        return this
    }
});
var Events = new Class({
    $events: {},
    addEvent: function(type, fn, internal) {
        if (!(fn instanceof Function)) {
            throw new Error("Event handlers must be functions")
        }
        type = Events.removeOn(type);
        if (fn != $empty) {
            this.$events[type] = this.$events[type] || [];
            this.$events[type].include(fn);
            if (internal) {
                fn.internal = true
            }
        }
        return this
    },
    addEvents: function(events) {
        for (var type in events) {
            this.addEvent(type, events[type])
        }
        return this
    },
    fireEvent: function(type, args, delay) {
        type = Events.removeOn(type);
        if (!this.$events || !this.$events[type]) {
            return this
        }
        args = $splat(args);
        var events = this.$events[type],
            Ey = -1,
            Gx = events.length,
            fn;
        if (delay) {
            while (++Ey < Gx) {
                if (fn = events[Ey]) {
                    setTimeout(function() {
                        fn.apply(this, args)
                    }, delay)
                }
            }
        } else {
            while (++Ey < Gx) {
                if (fn = events[Ey]) {
                    fn.$bound ? fn.$bound.apply(fn.$boundObject, (fn.$boundArgs || []).concat(Array.prototype.slice.call(args))) : fn.apply(this, args)
                }
            }
        }
        return this
    },
    qI: function(type, args) {
        var events, Ey = 0,
            Gx, fn;
        if (!(events = this.$events) || !(events = events[type])) {
            return this
        }
        args = args === undefined ? [] : args instanceof Array ? args : [args];
        for (Gx = events.length; Ey < Gx; ++Ey) {
            if (fn = events[Ey]) {
                fn.$bound ? fn.$bound.apply(fn.$boundObject, (fn.$boundArgs || []).concat(Array.prototype.slice.call(args))) : fn.apply(this, args)
            }
        }
        return this
    },
    removeEvent: function(type, fn) {
        type = Events.removeOn(type);
        if (!this.$events[type]) {
            return this
        }
        if (!fn.internal) {
            this.$events[type].erase(fn)
        }
        return this
    },
    removeEvents: function(events) {
        var type;
        if ($type(events) == "object") {
            for (type in events) {
                this.removeEvent(type, events[type])
            }
            return this
        }
        if (events) {
            events = Events.removeOn(events)
        }
        for (type in this.$events) {
            if (events && events != type) {
                continue
            }
            var fns = this.$events[type];
            for (var i = fns.length; i--; i) {
                this.removeEvent(type, fns[i])
            }
        }
        return this
    }
});
Events.removeOn = function(string) {
    return string.replace(/^on([A-Z])/, function(full, first) {
        return first.toLowerCase()
    })
};
var Options = new Class({
    setOptions: function() {
        this.options = $merge.run([this.options].extend(arguments));
        if (!this.addEvent) {
            return this
        }
        for (var option in this.options) {
            if ($type(this.options[option]) != "function" || !(/^on[A-Z]/).test(option)) {
                continue
            }
            this.addEvent(option, this.options[option]);
            delete this.options[option]
        }
        return this
    }
});
var Element = new Native({
    name: "Element",
    legacy: window.Element,
    initialize: function(tag, props) {
        var konstructor = Element.Constructors.get(tag);
        if (konstructor) {
            return konstructor(props)
        }
        if (typeof tag == "string") {
            return document.newElement(tag, props)
        }
        return document.id(tag).set(props)
    },
    afterImplement: function(key, value) {
        Element.Prototype[key] = value;
        if (Array[key]) {
            return
        }
        Elements.implement(key, function() {
            var items = [],
                elements = true;
            for (var i = 0, j = this.length; i < j; i++) {
                var returns = this[i][key].apply(this[i], arguments);
                items.push(returns);
                if (elements) {
                    elements = ($type(returns) == "element")
                }
            }
            return (elements) ? new Elements(items) : items
        })
    }
});
Element.Prototype = {
    $family: {
        name: "element"
    }
};
Element.Constructors = new Hash;
var IFrame = new Native({
    name: "IFrame",
    generics: false,
    initialize: function() {
        var params = Array.link(arguments, {
            properties: Object.type,
            iframe: $defined
        });
        var props = params.properties || {};
        var iframe = document.id(params.iframe);
        var onload = props.onload || $empty;
        delete props.onload;
        props.id = props.name = $pick(props.id, props.name, iframe ? (iframe.id || iframe.name) : "IFrame_" + $time());
        iframe = new Element(iframe || "iframe", props);
        var onFrameLoad = function() {
            var host = $try(function() {
                return iframe.contentWindow.location.host
            });
            if (!host || host == window.location.host) {
                var win = new Window(iframe.contentWindow);
                new Document(iframe.contentWindow.document);
                $extend(win.Element.prototype, Element.Prototype)
            }
            onload.call(iframe.contentWindow, iframe.contentWindow.document)
        };
        var contentWindow = $try(function() {
            return iframe.contentWindow
        });
        ((contentWindow && contentWindow.document.body) || window.frames[props.id]) ? onFrameLoad(): iframe.addListener("load", onFrameLoad);
        return iframe
    }
});
var Elements = new Native({
    initialize: function(elements, options) {
        options = $extend({
            ddup: true,
            cash: true
        }, options);
        elements = elements || [];
        if (options.ddup || options.cash) {
            var uniques = {},
                returned = [];
            for (var i = 0, l = elements.length; i < l; i++) {
                var el = document.id(elements[i], !options.cash);
                
                if(el == undefined) continue;
                
                if (options.ddup) {
                    if (uniques[el.uid]) {
                        continue
                    }
                    uniques[el.uid] = true
                }
                if (el) {
                    returned.push(el)
                }
            }
            elements = returned
        }
        return (options.cash) ? $extend(elements, this) : elements
    }
});
Elements.implement({
    filter: function(filter, bind) {
        if (!filter) {
            return this
        }
        return new Elements(Array.filter(this, (typeof filter == "string") ? function(item) {
            return item.match(filter)
        } : filter, bind))
    }
});
Document.implement({
    newElement: function(tag, props) {
        if (Browser.Engine.trident && props) {
            ["name", "type", "checked"].each(function(attribute) {
                if (!props[attribute]) {
                    return
                }
                tag += " " + attribute + '="' + props[attribute] + '"';
                if (attribute != "checked") {
                    delete props[attribute]
                }
            });
            tag = "<" + tag + ">"
        }
        return document.id(this.createElement(tag)).set(props)
    },
    newTextNode: function(text) {
        return this.createTextNode(text)
    },
    getDocument: function() {
        return this
    },
    getWindow: function() {
        return this.window
    },
    id: (function() {
        var types = {
            string: function(id, nocash, doc) {
                id = doc.getElementById(id);
                return (id) ? types.element(id, nocash) : null
            },
            element: function(el, nocash) {
                $uid(el);
                if (!nocash && !el.$family && !(/^object|embed$/i).test(el.tagName)) {
                    var proto = Element.Prototype;
                    for (var p in proto) {
                        el[p] = proto[p]
                    }
                }
                return el
            },
            object: function(obj, nocash, doc) {
                if (obj.toElement) {
                    return types.element(obj.toElement(doc), nocash)
                }
                return null
            }
        };
        types.textnode = types.whitespace = types.window = types.document = $arguments(0);
        return function(el, nocash, doc) {
            if (el && el.$family && el.uid) {
                return el
            }
            var type = $type(el);
            return (types[type]) ? types[type](el, nocash, doc || document) : null
        }
    })()
});
if (window.$ == null) {
    Window.implement({
        $: function(el, nc) {
            return document.id(el, nc, this.document)
        }
    })
}
Window.implement({
    $$: function(selector) {
        if (arguments.length == 1 && typeof selector == "string") {
            return this.document.getElements(selector)
        }
        var elements = [];
        var args = Array.flatten(arguments);
        for (var i = 0, l = args.length; i < l; i++) {
            var item = args[i];
            switch ($type(item)) {
                case "element":
                    elements.push(item);
                    break;
                case "string":
                    elements.extend(this.document.getElements(item, true))
            }
        }
        return new Elements(elements)
    },
    getDocument: function() {
        return this.document
    },
    getWindow: function() {
        return this
    }
});
Native.implement([Element, Document], {
    getElement: function(selector, nocash) {
        return document.id(this.getElements(selector, true)[0] || null, nocash)
    },
    getElements: function(tags, nocash) {
        tags = tags.split(",");
        var elements = [];
        var ddup = (tags.length > 1);
        tags.each(function(tag) {
            var partial = this.getElementsByTagName(tag.trim());
            (ddup) ? elements.extend(partial): elements = partial
        }, this);
        return new Elements(elements, {
            ddup: ddup,
            cash: !nocash
        })
    }
});
(function() {
    var collected = {},
        storage = {};
    var props = {
        input: "checked",
        option: "selected",
        textarea: (Browser.Engine.webkit && Browser.Engine.version < 420) ? "innerHTML" : "value"
    };
    var get = function(uid) {
        return (storage[uid] || (storage[uid] = {}))
    };
    var clean = function(item, retain) {
        if (!item) {
            return
        }
        var uid = item.uid;
        if (Browser.Engine.trident) {
            if (item.clearAttributes) {
                var clone = retain && item.cloneNode(false);
                item.clearAttributes();
                if (clone) {
                    item.mergeAttributes(clone)
                }
            } else {
                if (item.removeEvents) {
                    item.removeEvents()
                }
            }
            if ((/object/i).test(item.tagName)) {
                for (var p in item) {
                    if (typeof item[p] == "function") {
                        item[p] = $empty
                    }
                }
                Element.dispose(item)
            }
        }
        if (!uid) {
            return
        }
        collected[uid] = storage[uid] = null
    };
    var purge = function() {
        Hash.each(collected, clean);
        if (Browser.Engine.trident) {
            $A(document.getElementsByTagName("object")).each(clean)
        }
        if (window.CollectGarbage) {
            CollectGarbage()
        }
        collected = storage = null
    };
    var walk = function(element, walk, start, match, all, nocash) {
        var el = element[start || walk];
        var elements = [];
        while (el) {
            if (el.nodeType == 1 && (!match || Element.match(el, match))) {
                if (!all) {
                    return document.id(el, nocash)
                }
                elements.push(el)
            }
            el = el[walk]
        }
        return (all) ? new Elements(elements, {
            ddup: false,
            cash: !nocash
        }) : null
    };
    var attributes = {
        html: "innerHTML",
        "class": "className",
        "for": "htmlFor",
        defaultValue: "defaultValue",
        text: (Browser.Engine.trident || (Browser.Engine.webkit && Browser.Engine.version < 420)) ? "innerText" : "textContent"
    };
    var bools = ["compact", "nowrap", "ismap", "declare", "noshade", "checked", "disabled", "readonly", "multiple", "selected", "noresize", "defer"];
    var camels = ["value", "type", "defaultValue", "accessKey", "cellPadding", "cellSpacing", "colSpan", "frameBorder", "maxLength", "readOnly", "rowSpan", "tabIndex", "useMap"];
    bools = bools.associate(bools);
    Hash.extend(attributes, bools);
    Hash.extend(attributes, camels.associate(camels.map(String.toLowerCase)));
    var inserters = {
        before: function(context, element) {
            if (element.parentNode) {
                element.parentNode.insertBefore(context, element)
            }
        },
        after: function(context, element) {
            if (!element.parentNode) {
                return
            }
            var next = element.nextSibling;
            (next) ? element.parentNode.insertBefore(context, next): element.parentNode.appendChild(context)
        },
        bottom: function(context, element) {
            element.appendChild(context)
        },
        top: function(context, element) {
            var first = element.firstChild;
            (first) ? element.insertBefore(context, first): element.appendChild(context)
        }
    };
    inserters.inside = inserters.bottom;
    Hash.each(inserters, function(inserter, where) {
        where = where.capitalize();
        Element.implement("inject" + where, function(el) {
            inserter(this, document.id(el, true));
            return this
        });
        Element.implement("grab" + where, function(el) {
            inserter(document.id(el, true), this);
            return this
        })
    });
    Element.implement({
        set: function(prop, value) {
            switch ($type(prop)) {
                case "object":
                    for (var p in prop) {
                        this.set(p, prop[p])
                    }
                    break;
                case "string":
                    var property = Element.Properties.get(prop);
                    (property && property.set) ? property.set.apply(this, Array.slice(arguments, 1)): this.setProperty(prop, value)
            }
            return this
        },
        get: function(prop) {
            var property = Element.Properties.get(prop);
            return (property && property.get) ? property.get.apply(this, Array.slice(arguments, 1)) : this.getProperty(prop)
        },
        erase: function(prop) {
            var property = Element.Properties.get(prop);
            (property && property.erase) ? property.erase.apply(this): this.removeProperty(prop);
            return this
        },
        setProperty: function(attribute, value) {
            var key = attributes[attribute];
            if (value == undefined) {
                return this.removeProperty(attribute)
            }
            if (key && bools[attribute]) {
                value = !!value
            }(key) ? this[key] = value: this.setAttribute(attribute, "" + value);
            return this
        },
        setProperties: function(attributes) {
            for (var attribute in attributes) {
                this.setProperty(attribute, attributes[attribute])
            }
            return this
        },
        getProperty: function(attribute) {
            var key = attributes[attribute];
            var value = (key) ? this[key] : this.getAttribute(attribute, 2);
            return (bools[attribute]) ? !!value : (key) ? value : value || null
        },
        getProperties: function() {
            var args = $A(arguments);
            return args.map(this.getProperty, this).associate(args)
        },
        removeProperty: function(attribute) {
            var key = attributes[attribute];
            (key) ? this[key] = (key && bools[attribute]) ? false : "": this.removeAttribute(attribute);
            return this
        },
        removeProperties: function() {
            Array.each(arguments, this.removeProperty, this);
            return this
        },
        hasClass: function(className) {
            return this.className.contains(className, " ")
        },
        addClass: function(className) {
            if (!this.hasClass(className)) {
                this.className = (this.className + " " + className).clean()
            }
            return this
        },
        removeClass: function(className) {
            this.className = this.className.replace(new RegExp("(^|\\s)" + className + "(?:\\s|$)"), "$1");
            return this
        },
        toggleClass: function(className) {
            return this.hasClass(className) ? this.removeClass(className) : this.addClass(className)
        },
        adopt: function() {
            Array.flatten(arguments).each(function(element) {
                element = document.id(element, true);
                if (element) {
                    this.appendChild(element)
                }
            }, this);
            return this
        },
        appendText: function(text, where) {
            return this.grab(this.getDocument().newTextNode(text), where)
        },
        grab: function(el, where) {
            inserters[where || "bottom"](document.id(el, true), this);
            return this
        },
        inject: function(el, where) {
            inserters[where || "bottom"](this, document.id(el, true));
            return this
        },
        replaces: function(el) {
            el = document.id(el, true);
            el.parentNode.replaceChild(this, el);
            return this
        },
        wraps: function(el, where) {
            el = document.id(el, true);
            return this.replaces(el).grab(el, where)
        },
        getPrevious: function(match, nocash) {
            return walk(this, "previousSibling", null, match, false, nocash)
        },
        getAllPrevious: function(match, nocash) {
            return walk(this, "previousSibling", null, match, true, nocash)
        },
        getNext: function(match, nocash) {
            return walk(this, "nextSibling", null, match, false, nocash)
        },
        getAllNext: function(match, nocash) {
            return walk(this, "nextSibling", null, match, true, nocash)
        },
        getFirst: function(match, nocash) {
            return walk(this, "nextSibling", "firstChild", match, false, nocash)
        },
        getLast: function(match, nocash) {
            return walk(this, "previousSibling", "lastChild", match, false, nocash)
        },
        getParent: function(match, nocash) {
            return walk(this, "parentNode", null, match, false, nocash)
        },
        getParents: function(match, nocash) {
            return walk(this, "parentNode", null, match, true, nocash)
        },
        getSiblings: function(match, nocash) {
            return this.getParent().getChildren(match, nocash).erase(this)
        },
        getChildren: function(match, nocash) {
            return walk(this, "nextSibling", "firstChild", match, true, nocash)
        },
        getWindow: function() {
            return this.ownerDocument.window
        },
        getDocument: function() {
            return this.ownerDocument
        },
        getElementById: function(id, nocash) {
            var el = this.ownerDocument.getElementById(id);
            if (!el) {
                return null
            }
            for (var parent = el.parentNode; parent != this; parent = parent.parentNode) {
                if (!parent) {
                    return null
                }
            }
            return document.id(el, nocash)
        },
        getSelected: function() {
            return new Elements($A(this.options).filter(function(option) {
                return option.selected
            }))
        },
        getComputedStyle: function(property) {
            if (this.currentStyle) {
                return this.currentStyle[property.camelCase()]
            }
            var computed = this.getDocument().defaultView.getComputedStyle(this, null);
            return (computed) ? computed.getPropertyValue([property.hyphenate()]) : null
        },
        toQueryString: function() {
            var queryString = [];
            this.getElements("input, select, textarea", true).each(function(el) {
                if (!el.name || el.disabled || el.type == "submit" || el.type == "reset" || el.type == "file") {
                    return
                }
                var value = (el.tagName.toLowerCase() == "select") ? Element.getSelected(el).map(function(opt) {
                    return opt.value
                }) : ((el.type == "radio" || el.type == "checkbox") && !el.checked) ? null : el.value;
                $splat(value).each(function(val) {
                    if (typeof val != "undefined") {
                        queryString.push(el.name + "=" + encodeURIComponent(val))
                    }
                })
            });
            return queryString.join("&")
        },
        clone: function(contents, keepid) {
            contents = contents !== false;
            var clone = this.cloneNode(contents);
            var clean = function(node, element) {
                if (!keepid) {
                    node.removeAttribute("id")
                }
                if (Browser.Engine.trident) {
                    node.clearAttributes();
                    node.mergeAttributes(element);
                    node.removeAttribute("uid");
                    if (node.options) {
                        var no = node.options,
                            eo = element.options;
                        for (var j = no.length; j--;) {
                            no[j].selected = eo[j].selected
                        }
                    }
                }
                var prop = props[element.tagName.toLowerCase()];
                if (prop && element[prop]) {
                    node[prop] = element[prop]
                }
            };
            if (contents) {
                var ce = clone.getElementsByTagName("*"),
                    te = this.getElementsByTagName("*");
                for (var i = ce.length; i--;) {
                    clean(ce[i], te[i])
                }
            }
            clean(clone, this);
            return document.id(clone)
        },
        destroy: function() {
            Element.empty(this);
            Element.dispose(this);
            clean(this, true);
            return null
        },
        empty: function() {
            $A(this.childNodes).each(function(node) {
                Element.destroy(node)
            });
            return this
        },
        dispose: function() {
            return (this.parentNode) ? this.parentNode.removeChild(this) : this
        },
        hasChild: function(el) {
            el = document.id(el, true);
            if (!el) {
                return false
            }
            if (Browser.Engine.webkit && Browser.Engine.version < 420) {
                return $A(this.getElementsByTagName(el.tagName)).contains(el)
            }
            return (this.contains) ? (this != el && this.contains(el)) : !!(this.compareDocumentPosition(el) & 16)
        },
        match: function(tag) {
            return (!tag || (tag == this) || (Element.get(this, "tag") == tag))
        }
    });
    Native.implement([Element, Window, Document], {
        addListener: function(type, fn) {
            if (type == "unload") {
                var old = fn,
                    self = this;
                fn = function() {
                    self.removeListener("unload", fn);
                    old()
                }
            } else {
                collected[this.uid] = this
            }
            if (this.addEventListener) {
                this.addEventListener(type, fn, false)
            } else {
                this.attachEvent("on" + type, fn)
            }
            return this
        },
        removeListener: function(type, fn) {
            if (this.removeEventListener) {
                this.removeEventListener(type, fn, false)
            } else {
                this.detachEvent("on" + type, fn)
            }
            return this
        },
        retrieve: function(property, dflt) {
            var storage = get(this.uid),
                prop = storage[property];
            if (dflt != undefined && prop == undefined) {
                prop = storage[property] = dflt
            }
            return $pick(prop)
        },
        store: function(property, value) {
            var storage = get(this.uid);
            storage[property] = value;
            return this
        },
        eliminate: function(property) {
            var storage = get(this.uid);
            delete storage[property];
            return this
        }
    });
    window.addListener("unload", purge)
})();
Element.Properties = new Hash;
Element.Properties.style = {
    set: function(style) {
        this.style.cssText = style
    },
    get: function() {
        return this.style.cssText
    },
    erase: function() {
        this.style.cssText = ""
    }
};
Element.Properties.tag = {
    get: function() {
        return this.tagName.toLowerCase()
    }
};
Element.Properties.html = (function() {
    var wrapper = document.createElement("div");
    var translations = {
        table: [1, "<table>", "</table>"],
        select: [1, "<select>", "</select>"],
        tbody: [2, "<table><tbody>", "</tbody></table>"],
        tr: [3, "<table><tbody><tr>", "</tr></tbody></table>"]
    };
    translations.thead = translations.tfoot = translations.tbody;
    var html = {
        set: function() {
            var html = Array.flatten(arguments).join("");
            var wrap = Browser.Engine.trident && translations[this.get("tag")];
            if (wrap) {
                var first = wrapper;
                first.innerHTML = wrap[1] + html + wrap[2];
                for (var i = wrap[0]; i--;) {
                    first = first.firstChild
                }
                this.empty().adopt(first.childNodes)
            } else {
                this.innerHTML = html
            }
        }
    };
    html.erase = html.set;
    return html
})();
if (Browser.Engine.webkit && Browser.Engine.version < 420) {
    Element.Properties.text = {
        get: function() {
            if (this.innerText) {
                return this.innerText
            }
            var temp = this.ownerDocument.newElement("div", {
                html: this.innerHTML
            }).inject(this.ownerDocument.body);
            var text = temp.innerText;
            temp.destroy();
            return text
        }
    }
}
Element.Properties.events = {
    set: function(events) {
        this.addEvents(events)
    }
};
Native.implement([Element, Window, Document], {
    addEvent: function(type, fn) {
        var events = this.retrieve("events", {});
        if (!(fn instanceof Function)) {
            throw new Error("Event handlers must be functions")
        }
        events[type] = events[type] || {
            keys: [],
            values: []
        };
        if (events[type].keys.contains(fn)) {
            return this
        }
        events[type].keys.push(fn);
        var realType = type,
            custom = Element.Events.get(type),
            condition = fn,
            self = this;
        if (custom) {
            if (custom.onAdd) {
                custom.onAdd.call(this, fn)
            }
            if (custom.condition) {
                condition = function(event) {
                    if (custom.condition.call(this, event)) {
                        return fn.call(this, event)
                    }
                    return true
                }
            }
            realType = custom.base || realType
        }
        var defn = function() {
            return fn.call(self)
        };
        var nativeEvent = Element.NativeEvents[realType];
        if (nativeEvent) {
            if (nativeEvent == 2) {
                defn = function(event) {
                    event = new Event(event, self.getWindow());
                    if (condition.call(self, event) === false) {
                        event.stop()
                    }
                }
            }
            this.addListener(realType, defn)
        }
        events[type].values.push(defn);
        return this
    },
    removeEvent: function(type, fn) {
        var events = this.retrieve("events");
        if (!events || !events[type]) {
            return this
        }
        var pos = events[type].keys.indexOf(fn);
        if (pos == -1) {
            return this
        }
        events[type].keys.splice(pos, 1);
        var value = events[type].values.splice(pos, 1)[0];
        var custom = Element.Events.get(type);
        if (custom) {
            if (custom.onRemove) {
                custom.onRemove.call(this, fn)
            }
            type = custom.base || type
        }
        return (Element.NativeEvents[type]) ? this.removeListener(type, value) : this
    },
    addEvents: function(events) {
        for (var event in events) {
            this.addEvent(event, events[event])
        }
        return this
    },
    removeEvents: function(events) {
        var type;
        if ($type(events) == "object") {
            for (type in events) {
                this.removeEvent(type, events[type])
            }
            return this
        }
        var attached = this.retrieve("events");
        if (!attached) {
            return this
        }
        if (!events) {
            for (type in attached) {
                this.removeEvents(type)
            }
            this.eliminate("events")
        } else {
            if (attached[events]) {
                while (attached[events].keys[0]) {
                    this.removeEvent(events, attached[events].keys[0])
                }
                attached[events] = null
            }
        }
        return this
    },
    fireEvent: function(type, args, delay) {
        var events = this.retrieve("events");
        if (!events || !events[type]) {
            return this
        }
        events[type].keys.each(function(fn) {
            fn.create({
                bind: this,
                delay: delay,
                "arguments": args
            })()
        }, this);
        return this
    },
    cloneEvents: function(from, type) {
        from = document.id(from);
        var fevents = from.retrieve("events");
        if (!fevents) {
            return this
        }
        if (!type) {
            for (var evType in fevents) {
                this.cloneEvents(from, evType)
            }
        } else {
            if (fevents[type]) {
                fevents[type].keys.each(function(fn) {
                    this.addEvent(type, fn)
                }, this)
            }
        }
        return this
    }
});
Element.NativeEvents = {
    click: 2,
    dblclick: 2,
    mouseup: 2,
    mousedown: 2,
    contextmenu: 2,
    mousewheel: 2,
    DOMMouseScroll: 2,
    mouseover: 2,
    mouseout: 2,
    mousemove: 2,
    selectstart: 2,
    selectend: 2,
    keydown: 2,
    keypress: 2,
    keyup: 2,
    focus: 2,
    blur: 2,
    change: 2,
    reset: 2,
    select: 2,
    submit: 2,
    load: 1,
    unload: 1,
    beforeunload: 2,
    resize: 1,
    move: 1,
    DOMContentLoaded: 1,
    readystatechange: 1,
    error: 1,
    abort: 1,
    scroll: 1
};
(function() {
    var $check = function(event) {
        var related = event.relatedTarget;
        if (related == undefined) {
            return true
        }
        if (related === false) {
            return false
        }
        return ($type(this) != "document" && related != this && related.prefix != "xul" && !this.hasChild(related))
    };
    Element.Events = new Hash({
        mouseenter: {
            base: "mouseover",
            condition: $check
        },
        mouseleave: {
            base: "mouseout",
            condition: $check
        },
        mousewheel: {
            base: (Browser.Engine.gecko) ? "DOMMouseScroll" : "mousewheel"
        }
    })
})();
Element.Properties.styles = {
    set: function(styles) {
        this.setStyles(styles)
    }
};
Element.Properties.opacity = {
    set: function(opacity, novisibility) {
        if (!novisibility) {
            if (opacity == 0) {
                if (this.style.visibility != "hidden") {
                    this.style.visibility = "hidden"
                }
            } else {
                if (this.style.visibility != "visible") {
                    this.style.visibility = "visible"
                }
            }
        }
        if (!this.currentStyle || !this.currentStyle.hasLayout) {
            this.style.zoom = 1
        }
        if (Browser.Engine.trident) {
            this.style.filter = (opacity == 1) ? "" : "alpha(opacity=" + opacity * 100 + ")"
        }
        this.style.opacity = opacity;
        this.store("opacity", opacity)
    },
    get: function() {
        return this.retrieve("opacity", 1)
    }
};
Element.implement({
    setOpacity: function(value) {
        return this.set("opacity", value, true)
    },
    getOpacity: function() {
        return this.get("opacity")
    },
    setStyle: function(property, value) {
        switch (property) {
            case "opacity":
                return this.set("opacity", parseFloat(value));
            case "float":
                property = (Browser.Engine.trident) ? "styleFloat" : "cssFloat"
        }
        property = property.camelCase();
        if ($type(value) != "string") {
            var map = (Element.Styles.get(property) || "@").split(" ");
            value = $splat(value).map(function(val, i) {
                if (!map[i]) {
                    return ""
                }
                return ($type(val) == "number") ? map[i].replace("@", Math.round(val)) : val
            }).join(" ")
        } else {
            if (value == String(Number(value))) {
                value = Math.round(value)
            }
        }
        this.style[property] = value;
        return this
    },
    getStyle: function(property) {
        switch (property) {
            case "opacity":
                return this.get("opacity");
            case "float":
                property = (Browser.Engine.trident) ? "styleFloat" : "cssFloat"
        }
        property = property.camelCase();
        var result = this.style[property];
        if (!$chk(result)) {
            result = [];
            for (var style in Element.ShortStyles) {
                if (property != style) {
                    continue
                }
                for (var s in Element.ShortStyles[style]) {
                    result.push(this.getStyle(s))
                }
                return result.join(" ")
            }
            result = this.getComputedStyle(property)
        }
        if (result) {
            result = String(result);
            var color = result.match(/rgba?\([\d\s,]+\)/);
            if (color) {
                result = result.replace(color[0], color[0].rgbToHex())
            }
        }
        if (Browser.Engine.presto || (Browser.Engine.trident && !$chk(parseInt(result, 10)))) {
            if (property.test(/^(height|width)$/)) {
                var values = (property == "width") ? ["left", "right"] : ["top", "bottom"],
                    size = 0;
                values.each(function(value) {
                    size += this.getStyle("border-" + value + "-width").toInt() + this.getStyle("padding-" + value).toInt()
                }, this);
                return this["offset" + property.capitalize()] - size + "px"
            }
            if ((Browser.Engine.presto) && String(result).test("px")) {
                return result
            }
            if (property.test(/(border(.+)Width|margin|padding)/)) {
                return "0px"
            }
        }
        return result
    },
    setStyles: function(styles) {
        for (var style in styles) {
            this.setStyle(style, styles[style])
        }
        return this
    },
    getStyles: function() {
        var result = {};
        Array.flatten(arguments).each(function(key) {
            result[key] = this.getStyle(key)
        }, this);
        return result
    }
});
Element.Styles = new Hash({
    left: "@px",
    top: "@px",
    bottom: "@px",
    right: "@px",
    width: "@px",
    height: "@px",
    maxWidth: "@px",
    maxHeight: "@px",
    minWidth: "@px",
    minHeight: "@px",
    backgroundColor: "rgb(@, @, @)",
    backgroundPosition: "@px @px",
    color: "rgb(@, @, @)",
    fontSize: "@px",
    letterSpacing: "@px",
    lineHeight: "@px",
    clip: "rect(@px @px @px @px)",
    margin: "@px @px @px @px",
    padding: "@px @px @px @px",
    border: "@px @ rgb(@, @, @) @px @ rgb(@, @, @) @px @ rgb(@, @, @)",
    borderWidth: "@px @px @px @px",
    borderStyle: "@ @ @ @",
    borderColor: "rgb(@, @, @) rgb(@, @, @) rgb(@, @, @) rgb(@, @, @)",
    zIndex: "@",
    zoom: "@",
    fontWeight: "@",
    textIndent: "@px",
    opacity: "@"
});
Element.ShortStyles = {
    margin: {},
    padding: {},
    border: {},
    borderWidth: {},
    borderStyle: {},
    borderColor: {}
};
["Top", "Right", "Bottom", "Left"].each(function(direction) {
    var Short = Element.ShortStyles;
    var All = Element.Styles;
    ["margin", "padding"].each(function(style) {
        var sd = style + direction;
        Short[style][sd] = All[sd] = "@px"
    });
    var bd = "border" + direction;
    Short.border[bd] = All[bd] = "@px @ rgb(@, @, @)";
    var bdw = bd + "Width",
        bds = bd + "Style",
        bdc = bd + "Color";
    Short[bd] = {};
    Short.borderWidth[bdw] = Short[bd][bdw] = All[bdw] = "@px";
    Short.borderStyle[bds] = Short[bd][bds] = All[bds] = "@";
    Short.borderColor[bdc] = Short[bd][bdc] = All[bdc] = "rgb(@, @, @)"
});
Native.implement([Document, Element], {
    getElements: function(expression, nocash) {
        expression = expression.split(",");
        var items, local = {};
        for (var i = 0, l = expression.length; i < l; i++) {
            var selector = expression[i],
                elements = Selectors.Utils.search(this, selector, local);
            if (i != 0 && elements.item) {
                elements = $A(elements)
            }
            items = (i == 0) ? elements : (items.item) ? $A(items).concat(elements) : items.concat(elements)
        }
        return new Elements(items, {
            ddup: (expression.length > 1),
            cash: !nocash
        })
    }
});
Element.implement({
    match: function(selector) {
        if (!selector || (selector == this)) {
            return true
        }
        var tagid = Selectors.Utils.parseTagAndID(selector);
        var tag = tagid[0],
            id = tagid[1];
        if (!Selectors.Filters.byID(this, id) || !Selectors.Filters.byTag(this, tag)) {
            return false
        }
        var parsed = Selectors.Utils.parseSelector(selector);
        return (parsed) ? Selectors.Utils.filter(this, parsed, {}) : true
    }
});
var Selectors = {
    Cache: {
        nth: {},
        parsed: {}
    }
};
Selectors.RegExps = {
    id: (/#([\w-]+)/),
    tag: (/^(\w+|\*)/),
    quick: (/^(\w+|\*)$/),
    splitter: (/\s*([+>~\s])\s*([a-zA-Z#.*:\[])/g),
    combined: (/\.([\w-]+)|\[(\w+)(?:([!*^$~|]?=)(["']?)([^\4]*?)\4)?\]|:([\w-]+)(?:\(["']?(.*?)?["']?\)|$)/g)
};
Selectors.Utils = {
    chk: function(item, uniques) {
        if (!uniques) {
            return true
        }
        var uid = $uid(item);
        if (!uniques[uid]) {
            return uniques[uid] = true
        }
        return false
    },
    parseNthArgument: function(argument) {
        if (Selectors.Cache.nth[argument]) {
            return Selectors.Cache.nth[argument]
        }
        var parsed = argument.match(/^([+-]?\d*)?([a-z]+)?([+-]?\d*)?$/);
        if (!parsed) {
            return false
        }
        var inta = parseInt(parsed[1], 10);
        var a = (inta || inta === 0) ? inta : 1;
        var special = parsed[2] || false;
        var b = parseInt(parsed[3], 10) || 0;
        if (a != 0) {
            b--;
            while (b < 1) {
                b += a
            }
            while (b >= a) {
                b -= a
            }
        } else {
            a = b;
            special = "index"
        }
        switch (special) {
            case "n":
                parsed = {
                    a: a,
                    b: b,
                    special: "n"
                };
                break;
            case "odd":
                parsed = {
                    a: 2,
                    b: 0,
                    special: "n"
                };
                break;
            case "even":
                parsed = {
                    a: 2,
                    b: 1,
                    special: "n"
                };
                break;
            case "first":
                parsed = {
                    a: 0,
                    special: "index"
                };
                break;
            case "last":
                parsed = {
                    special: "last-child"
                };
                break;
            case "only":
                parsed = {
                    special: "only-child"
                };
                break;
            default:
                parsed = {
                    a: (a - 1),
                    special: "index"
                }
        }
        return Selectors.Cache.nth[argument] = parsed
    },
    parseSelector: function(selector) {
        if (Selectors.Cache.parsed[selector]) {
            return Selectors.Cache.parsed[selector]
        }
        var m, parsed = {
            classes: [],
            pseudos: [],
            attributes: []
        };
        while ((m = Selectors.RegExps.combined.exec(selector))) {
            var cn = m[1],
                an = m[2],
                ao = m[3],
                av = m[5],
                pn = m[6],
                pa = m[7];
            if (cn) {
                parsed.classes.push(cn)
            } else {
                if (pn) {
                    var parser = Selectors.Pseudo.get(pn);
                    if (parser) {
                        parsed.pseudos.push({
                            parser: parser,
                            argument: pa
                        })
                    } else {
                        parsed.attributes.push({
                            name: pn,
                            operator: "=",
                            value: pa
                        })
                    }
                } else {
                    if (an) {
                        parsed.attributes.push({
                            name: an,
                            operator: ao,
                            value: av
                        })
                    }
                }
            }
        }
        if (!parsed.classes.length) {
            delete parsed.classes
        }
        if (!parsed.attributes.length) {
            delete parsed.attributes
        }
        if (!parsed.pseudos.length) {
            delete parsed.pseudos
        }
        if (!parsed.classes && !parsed.attributes && !parsed.pseudos) {
            parsed = null
        }
        return Selectors.Cache.parsed[selector] = parsed
    },
    parseTagAndID: function(selector) {
        var tag = selector.match(Selectors.RegExps.tag);
        var id = selector.match(Selectors.RegExps.id);
        return [(tag) ? tag[1] : "*", (id) ? id[1] : false]
    },
    filter: function(item, parsed, local) {
        var i;
        if (parsed.classes) {
            for (i = parsed.classes.length; i--; i) {
                var cn = parsed.classes[i];
                if (!Selectors.Filters.byClass(item, cn)) {
                    return false
                }
            }
        }
        if (parsed.attributes) {
            for (i = parsed.attributes.length; i--; i) {
                var att = parsed.attributes[i];
                if (!Selectors.Filters.byAttribute(item, att.name, att.operator, att.value)) {
                    return false
                }
            }
        }
        if (parsed.pseudos) {
            for (i = parsed.pseudos.length; i--; i) {
                var psd = parsed.pseudos[i];
                if (!Selectors.Filters.byPseudo(item, psd.parser, psd.argument, local)) {
                    return false
                }
            }
        }
        return true
    },
    getByTagAndID: function(ctx, tag, id) {
        if (id) {
            var item = (ctx.getElementById) ? ctx.getElementById(id, true) : Element.getElementById(ctx, id, true);
            return (item && Selectors.Filters.byTag(item, tag)) ? [item] : []
        } else {
            return ctx.getElementsByTagName(tag)
        }
    },
    search: function(self, expression, local) {
        var splitters = [];
        var selectors = expression.trim().replace(Selectors.RegExps.splitter, function(m0, m1, m2) {
            splitters.push(m1);
            return ":)" + m2
        }).split(":)");
        var items, filtered, item;
        for (var i = 0, l = selectors.length; i < l; i++) {
            var selector = selectors[i];
            if (i == 0 && Selectors.RegExps.quick.test(selector)) {
                items = self.getElementsByTagName(selector);
                continue
            }
            var splitter = splitters[i - 1];
            var tagid = Selectors.Utils.parseTagAndID(selector);
            var tag = tagid[0],
                id = tagid[1];
            if (i == 0) {
                items = Selectors.Utils.getByTagAndID(self, tag, id)
            } else {
                var uniques = {},
                    found = [];
                for (var j = 0, k = items.length; j < k; j++) {
                    found = Selectors.Getters[splitter](found, items[j], tag, id, uniques)
                }
                items = found
            }
            var parsed = Selectors.Utils.parseSelector(selector);
            if (parsed) {
                filtered = [];
                for (var m = 0, n = items.length; m < n; m++) {
                    item = items[m];
                    if (Selectors.Utils.filter(item, parsed, local)) {
                        filtered.push(item)
                    }
                }
                items = filtered
            }
        }
        return items
    }
};
Selectors.Getters = {
    " ": function(found, self, tag, id, uniques) {
        var items = Selectors.Utils.getByTagAndID(self, tag, id);
        for (var i = 0, l = items.length; i < l; i++) {
            var item = items[i];
            if (Selectors.Utils.chk(item, uniques)) {
                found.push(item)
            }
        }
        return found
    },
    ">": function(found, self, tag, id, uniques) {
        var children = Selectors.Utils.getByTagAndID(self, tag, id);
        for (var i = 0, l = children.length; i < l; i++) {
            var child = children[i];
            if (child.parentNode == self && Selectors.Utils.chk(child, uniques)) {
                found.push(child)
            }
        }
        return found
    },
    "+": function(found, self, tag, id, uniques) {
        while ((self = self.nextSibling)) {
            if (self.nodeType == 1) {
                if (Selectors.Utils.chk(self, uniques) && Selectors.Filters.byTag(self, tag) && Selectors.Filters.byID(self, id)) {
                    found.push(self)
                }
                break
            }
        }
        return found
    },
    "~": function(found, self, tag, id, uniques) {
        while ((self = self.nextSibling)) {
            if (self.nodeType == 1) {
                if (!Selectors.Utils.chk(self, uniques)) {
                    break
                }
                if (Selectors.Filters.byTag(self, tag) && Selectors.Filters.byID(self, id)) {
                    found.push(self)
                }
            }
        }
        return found
    }
};
Selectors.Filters = {
    byTag: function(self, tag) {
        return (tag == "*" || (self.tagName && self.tagName.toLowerCase() == tag))
    },
    byID: function(self, id) {
        return (!id || (self.id && self.id == id))
    },
    byClass: function(self, klass) {
        return (self.className && self.className.contains && self.className.contains(klass, " "))
    },
    byPseudo: function(self, parser, argument, local) {
        return parser.call(self, argument, local)
    },
    byAttribute: function(self, name, operator, value) {
        var result = Element.prototype.getProperty.call(self, name);
        if (!result) {
            return (operator == "!=")
        }
        if (!operator || value == undefined) {
            return true
        }
        switch (operator) {
            case "=":
                return (result == value);
            case "*=":
                return (result.contains(value));
            case "^=":
                return (result.substr(0, value.length) == value);
            case "$=":
                return (result.substr(result.length - value.length) == value);
            case "!=":
                return (result != value);
            case "~=":
                return result.contains(value, " ");
            case "|=":
                return result.contains(value, "-")
        }
        return false
    }
};
Selectors.Pseudo = new Hash({
    checked: function() {
        return this.checked
    },
    empty: function() {
        return !(this.innerText || this.textContent || "").length
    },
    not: function(selector) {
        return !Element.match(this, selector)
    },
    contains: function(text) {
        return (this.innerText || this.textContent || "").contains(text)
    },
    "first-child": function() {
        return Selectors.Pseudo.index.call(this, 0)
    },
    "last-child": function() {
        var element = this;
        while ((element = element.nextSibling)) {
            if (element.nodeType == 1) {
                return false
            }
        }
        return true
    },
    "only-child": function() {
        var prev = this;
        while ((prev = prev.previousSibling)) {
            if (prev.nodeType == 1) {
                return false
            }
        }
        var next = this;
        while ((next = next.nextSibling)) {
            if (next.nodeType == 1) {
                return false
            }
        }
        return true
    },
    "nth-child": function(argument, local) {
        argument = (argument == undefined) ? "n" : argument;
        var parsed = Selectors.Utils.parseNthArgument(argument);
        if (parsed.special != "n") {
            return Selectors.Pseudo[parsed.special].call(this, parsed.a, local)
        }
        var count = 0;
        local.positions = local.positions || {};
        var uid = $uid(this);
        if (!local.positions[uid]) {
            var self = this;
            while ((self = self.previousSibling)) {
                if (self.nodeType != 1) {
                    continue
                }
                count++;
                var position = local.positions[$uid(self)];
                if (position != undefined) {
                    count = position + count;
                    break
                }
            }
            local.positions[uid] = count
        }
        return (local.positions[uid] % parsed.a == parsed.b)
    },
    index: function(index) {
        var element = this,
            count = 0;
        while ((element = element.previousSibling)) {
            if (element.nodeType == 1 && ++count > index) {
                return false
            }
        }
        return (count == index)
    },
    even: function(argument, local) {
        return Selectors.Pseudo["nth-child"].call(this, "2n+1", local)
    },
    odd: function(argument, local) {
        return Selectors.Pseudo["nth-child"].call(this, "2n", local)
    },
    selected: function() {
        return this.selected
    },
    enabled: function() {
        return (this.disabled === false)
    }
});
Element.Events.domready = {
    onAdd: function(fn) {
        if (Browser.loaded) {
            fn.call(this)
        }
    }
};
(function() {
    var domready = function() {
        if (Browser.loaded) {
            return
        }
        Browser.loaded = true;
        window.fireEvent("domready");
        document.fireEvent("domready")
    };
    window.addEvent("load", domready);
    if (Browser.Engine.trident) {
        var temp = document.createElement("div");
        (function() {
            ($try(function() {
                temp.doScroll();
                return document.id(temp).inject(document.body).set("html", "temp").dispose()
            })) ? domready(): arguments.callee.delay(50)
        })()
    } else {
        if (Browser.Engine.webkit && Browser.Engine.version < 525) {
            (function() {
                (["loaded", "complete"].contains(document.readyState)) ? domready(): arguments.callee.delay(50)
            })()
        } else {
            document.addEvent("DOMContentLoaded", domready)
        }
    }
})();
var Cookie = new Class({
    Implements: Options,
    options: {
        path: false,
        domain: false,
        duration: false,
        secure: false,
        document: document
    },
    initialize: function(key, options) {
        this.key = key;
        this.setOptions(options)
    },
    write: function(value) {
        value = encodeURIComponent(value);
        if (this.options.domain) {
            value += "; domain=" + this.options.domain
        }
        if (this.options.path) {
            value += "; path=" + this.options.path
        }
        if (this.options.duration) {
            var date = new Date();
            date.setTime(date.getTime() + this.options.duration * 24 * 60 * 60 * 1000);
            value += "; expires=" + date.toGMTString()
        }
        if (this.options.secure) {
            value += "; secure"
        }
        this.options.document.cookie = this.key + "=" + value;
        return this
    },
    read: function() {
        var value = this.options.document.cookie.match("(?:^|;)\\s*" + this.key.escapeRegExp() + "=([^;]*)");
        return (value) ? decodeURIComponent(value[1]) : null
    },
    dispose: function() {
        new Cookie(this.key, $merge(this.options, {
            duration: -1
        })).write("");
        return this
    }
});
Cookie.write = function(key, value, options) {
    return new Cookie(key, options).write(value)
};
Cookie.read = function(key) {
    return new Cookie(key).read()
};
Cookie.dispose = function(key, options) {
    return new Cookie(key, options).dispose()
};
var Fx = new Class({
    Implements: [Chain, Events, Options],
    options: {
        fps: 50,
        unit: false,
        duration: 500,
        link: "ignore"
    },
    initialize: function(options) {
        this.subject = this.subject || this;
        this.setOptions(options);
        this.options.duration = Fx.Durations[this.options.duration] || this.options.duration.toInt();
        var wait = this.options.wait;
        if (wait === false) {
            this.options.link = "cancel"
        }
    },
    getTransition: function() {
        return function(p) {
            return -(Math.cos(Math.PI * p) - 1) / 2
        }
    },
    step: function() {
        var time = $time();
        if (time < this.time + this.options.duration) {
            var delta = this.transition((time - this.time) / this.options.duration);
            this.set(this.compute(this.from, this.to, delta))
        } else {
            this.set(this.compute(this.from, this.to, 1));
            this.complete()
        }
    },
    set: function(now) {
        return now
    },
    compute: function(from, to, delta) {
        return Fx.compute(from, to, delta)
    },
    check: function() {
        if (!this.timer) {
            return true
        }
        switch (this.options.link) {
            case "cancel":
                this.cancel();
                return true;
            case "chain":
                this.chain(this.caller.bind.apply(this, arguments));
                return false
        }
        return false
    },
    start: function(from, to) {
        if (!this.check(from, to)) {
            return this
        }
        this.from = from;
        this.to = to;
        this.time = 0;
        this.transition = this.getTransition();
        this.startTimer();
        this.onStart();
        return this
    },
    complete: function() {
        if (this.stopTimer()) {
            this.onComplete()
        }
        return this
    },
    cancel: function() {
        if (this.stopTimer()) {
            this.onCancel()
        }
        return this
    },
    onStart: function() {
        this.fireEvent("start", this.subject)
    },
    onComplete: function() {
        this.fireEvent("complete", this.subject);
        if (!this.callChain()) {
            this.fireEvent("chainComplete", this.subject)
        }
    },
    onCancel: function() {
        this.fireEvent("cancel", this.subject).clearChain()
    },
    pause: function() {
        this.stopTimer();
        return this
    },
    resume: function() {
        this.startTimer();
        return this
    },
    stopTimer: function() {
        if (!this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.timer = $clear(this.timer);
        return true
    },
    startTimer: function() {
        if (this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.timer = this.step.periodical(Math.round(1000 / this.options.fps), this);
        return true
    }
});
Fx.compute = function(from, to, delta) {
    return (to - from) * delta + from
};
Fx.Durations = {
    "short": 250,
    normal: 500,
    "long": 1000
};
Fx.CSS = new Class({
    Extends: Fx,
    prepare: function(element, property, values) {
        values = $splat(values);
        var values1 = values[1];
        if (!$chk(values1)) {
            values[1] = values[0];
            values[0] = element.getStyle(property)
        }
        var parsed = values.map(this.parse);
        return {
            from: parsed[0],
            to: parsed[1]
        }
    },
    parse: function(value) {
        value = $lambda(value)();
        value = (typeof value == "string") ? value.split(" ") : $splat(value);
        return value.map(function(val) {
            val = String(val);
            var found = false;
            Fx.CSS.Parsers.each(function(parser, key) {
                if (found) {
                    return
                }
                var parsed = parser.parse(val);
                if ($chk(parsed)) {
                    found = {
                        value: parsed,
                        parser: parser
                    }
                }
            });
            found = found || {
                value: val,
                parser: Fx.CSS.Parsers.String
            };
            return found
        })
    },
    compute: function(from, to, delta) {
        var computed = [];
        (Math.min(from.length, to.length)).times(function(i) {
            computed.push({
                value: from[i].parser.compute(from[i].value, to[i].value, delta),
                parser: from[i].parser
            })
        });
        computed.$family = {
            name: "fx:css:value"
        };
        return computed
    },
    serve: function(value, unit) {
        if ($type(value) != "fx:css:value") {
            value = this.parse(value)
        }
        var returned = [];
        value.each(function(bit) {
            returned = returned.concat(bit.parser.serve(bit.value, unit))
        });
        return returned
    },
    render: function(element, property, value, unit) {
        element.setStyle(property, this.serve(value, unit))
    },
    search: function(selector) {
        if (Fx.CSS.Cache[selector]) {
            return Fx.CSS.Cache[selector]
        }
        var to = {};
        Array.each(document.styleSheets, function(sheet, j) {
            var href = sheet.href;
            if (href && href.contains("://") && !href.contains(document.domain)) {
                return
            }
            var rules = sheet.rules || sheet.cssRules;
            Array.each(rules, function(rule, i) {
                if (!rule.style) {
                    return
                }
                var selectorText = (rule.selectorText) ? rule.selectorText.replace(/^\w+/, function(m) {
                    return m.toLowerCase()
                }) : null;
                if (!selectorText || !selectorText.test("^" + selector + "$")) {
                    return
                }
                Element.Styles.each(function(value, style) {
                    if (!rule.style[style] || Element.ShortStyles[style]) {
                        return
                    }
                    value = String(rule.style[style]);
                    to[style] = (value.test(/^rgb/)) ? value.rgbToHex() : value
                })
            })
        });
        return Fx.CSS.Cache[selector] = to
    }
});
Fx.CSS.Cache = {};
Fx.CSS.Parsers = new Hash({
    Color: {
        parse: function(value) {
            if (value.match(/^#[0-9a-f]{3,6}$/i)) {
                return value.hexToRgb(true)
            }
            return ((value = value.match(/(\d+),\s*(\d+),\s*(\d+)/))) ? [value[1], value[2], value[3]] : false
        },
        compute: function(from, to, delta) {
            return from.map(function(value, i) {
                return Math.round(Fx.compute(from[i], to[i], delta))
            })
        },
        serve: function(value) {
            return value.map(Number)
        }
    },
    Number: {
        parse: parseFloat,
        compute: Fx.compute,
        serve: function(value, unit) {
            return (unit) ? value + unit : value
        }
    },
    String: {
        parse: $lambda(false),
        compute: $arguments(1),
        serve: $arguments(0)
    }
});
Fx.Tween = new Class({
    Extends: Fx.CSS,
    initialize: function(element, options) {
        this.element = this.subject = document.id(element);
        this.parent(options)
    },
    set: function(property, now) {
        if (arguments.length == 1) {
            now = property;
            property = this.property || this.options.property
        }
        this.render(this.element, property, now, this.options.unit);
        return this
    },
    start: function(property, from, to) {
        if (!this.check(property, from, to)) {
            return this
        }
        var args = Array.flatten(arguments);
        this.property = this.options.property || args.shift();
        var parsed = this.prepare(this.element, this.property, args);
        return this.parent(parsed.from, parsed.to)
    }
});
Element.Properties.tween = {
    set: function(options) {
        var tween = this.retrieve("tween");
        if (tween) {
            tween.cancel()
        }
        return this.eliminate("tween").store("tween:options", $extend({
            link: "cancel"
        }, options))
    },
    get: function(options) {
        if (options || !this.retrieve("tween")) {
            if (options || !this.retrieve("tween:options")) {
                this.set("tween", options)
            }
            this.store("tween", new Fx.Tween(this, this.retrieve("tween:options")))
        }
        return this.retrieve("tween")
    }
};
Element.implement({
    tween: function(property, from, to) {
        this.get("tween").start(arguments);
        return this
    },
    fade: function(how) {
        var fade = this.get("tween"),
            o = "opacity",
            toggle;
        how = $pick(how, "toggle");
        switch (how) {
            case "in":
                fade.start(o, 1);
                break;
            case "out":
                fade.start(o, 0);
                break;
            case "show":
                fade.set(o, 1);
                break;
            case "hide":
                fade.set(o, 0);
                break;
            case "toggle":
                var flag = this.retrieve("fade:flag", this.get("opacity") == 1);
                fade.start(o, (flag) ? 0 : 1);
                this.store("fade:flag", !flag);
                toggle = true;
                break;
            default:
                fade.start(o, arguments)
        }
        if (!toggle) {
            this.eliminate("fade:flag")
        }
        return this
    },
    highlight: function(start, end) {
        if (!end) {
            end = this.retrieve("highlight:original", this.getStyle("background-color"));
            end = (end == "transparent") ? "#fff" : end
        }
        var tween = this.get("tween");
        tween.start("background-color", start || "#ffff88", end).chain(function() {
            this.setStyle("background-color", this.retrieve("highlight:original"));
            tween.callChain()
        }.bind(this));
        return this
    }
});
Fx.Morph = new Class({
    Extends: Fx.CSS,
    initialize: function(element, options) {
        this.element = this.subject = document.id(element);
        this.parent(options)
    },
    set: function(now) {
        if (typeof now == "string") {
            now = this.search(now)
        }
        for (var p in now) {
            this.render(this.element, p, now[p], this.options.unit)
        }
        return this
    },
    compute: function(from, to, delta) {
        var now = {};
        for (var p in from) {
            now[p] = this.parent(from[p], to[p], delta)
        }
        return now
    },
    start: function(properties) {
        if (!this.check(properties)) {
            return this
        }
        if (typeof properties == "string") {
            properties = this.search(properties)
        }
        var from = {},
            to = {};
        for (var p in properties) {
            var parsed = this.prepare(this.element, p, properties[p]);
            from[p] = parsed.from;
            to[p] = parsed.to
        }
        return this.parent(from, to)
    }
});
Element.Properties.morph = {
    set: function(options) {
        var morph = this.retrieve("morph");
        if (morph) {
            morph.cancel()
        }
        return this.eliminate("morph").store("morph:options", $extend({
            link: "cancel"
        }, options))
    },
    get: function(options) {
        if (options || !this.retrieve("morph")) {
            if (options || !this.retrieve("morph:options")) {
                this.set("morph", options)
            }
            this.store("morph", new Fx.Morph(this, this.retrieve("morph:options")))
        }
        return this.retrieve("morph")
    }
};
Element.implement({
    morph: function(props) {
        this.get("morph").start(props);
        return this
    }
});
Fx.implement({
    getTransition: function() {
        var trans = this.options.transition || Fx.Transitions.Sine.easeInOut;
        if (typeof trans == "string") {
            var data = trans.split(":");
            trans = Fx.Transitions;
            trans = trans[data[0]] || trans[data[0].capitalize()];
            if (data[1]) {
                trans = trans["ease" + data[1].capitalize() + (data[2] ? data[2].capitalize() : "")]
            }
        }
        return trans
    }
});
Fx.Transition = function(transition, params) {
    params = $splat(params);
    return $extend(transition, {
        easeIn: function(pos) {
            return transition(pos, params)
        },
        easeOut: function(pos) {
            return 1 - transition(1 - pos, params)
        },
        easeInOut: function(pos) {
            return (pos <= 0.5) ? transition(2 * pos, params) / 2 : (2 - transition(2 * (1 - pos), params)) / 2
        }
    })
};
Fx.Transitions = new Hash({
    linear: $arguments(0)
});
Fx.Transitions.extend = function(transitions) {
    for (var transition in transitions) {
        Fx.Transitions[transition] = new Fx.Transition(transitions[transition])
    }
};
Fx.Transitions.extend({
    Pow: function(p, x) {
        return Math.pow(p, x[0] || 6)
    },
    Expo: function(p) {
        return Math.pow(2, 8 * (p - 1))
    },
    Circ: function(p) {
        return 1 - Math.sin(Math.acos(p))
    },
    Sine: function(p) {
        return 1 - Math.sin((1 - p) * Math.PI / 2)
    },
    Back: function(p, x) {
        x = x[0] || 1.618;
        return Math.pow(p, 2) * ((x + 1) * p - x)
    },
    Bounce: function(p) {
        var value;
        for (var a = 0, b = 1; 1; a += b, b /= 2) {
            if (p >= (7 - 4 * a) / 11) {
                value = b * b - Math.pow((11 - 6 * a - 11 * p) / 4, 2);
                break
            }
        }
        return value
    },
    Elastic: function(p, x) {
        return Math.pow(2, 10 * --p) * Math.cos(20 * p * Math.PI * (x[0] || 1) / 3)
    }
});
["Quad", "Cubic", "Quart", "Quint"].each(function(transition, i) {
    Fx.Transitions[transition] = new Fx.Transition(function(p) {
        return Math.pow(p, [i + 2])
    })
});
var Request = new Class({
    Implements: [Chain, Events, Options],
    options: {
        url: "",
        data: "",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            Accept: "text/javascript, text/html, application/xml, text/xml, */*"
        },
        async: true,
        format: false,
        method: "post",
        link: "ignore",
        isSuccess: null,
        emulation: true,
        urlEncoded: true,
        encoding: "utf-8",
        evalScripts: false,
        evalResponse: false,
        noCache: false
    },
    initialize: function(options) {
        this.xhr = new Browser.Request();
        this.setOptions(options);
        this.options.isSuccess = this.options.isSuccess || this.isSuccess;
        this.headers = new Hash(this.options.headers)
    },
    onStateChange: function() {
        if (this.xhr.readyState != 4 || !this.running) {
            return
        }
        this.running = false;
        this.status = 0;
        $try(function() {
            this.status = this.xhr.status
        }.bind(this));
        this.xhr.onreadystatechange = $empty;
        if (this.options.isSuccess.call(this, this.status)) {
            this.response = {
                text: this.xhr.responseText,
                xml: this.xhr.responseXML
            };
            this.success(this.response.text, this.response.xml)
        } else {
            this.response = {
                text: null,
                xml: null
            };
            this.failure()
        }
    },
    isSuccess: function() {
        return ((this.status >= 200) && (this.status < 300))
    },
    processScripts: function(text) {
        if (this.options.evalResponse || (/(ecma|java)script/).test(this.getHeader("Content-type"))) {
            return $exec(text)
        }
        return text.stripScripts(this.options.evalScripts)
    },
    success: function(text, xml) {
        this.onSuccess(this.processScripts(text), xml)
    },
    onSuccess: function() {
        this.fireEvent("complete", arguments).fireEvent("success", arguments).callChain()
    },
    failure: function() {
        this.onFailure()
    },
    onFailure: function() {
        this.fireEvent("complete").fireEvent("failure", this.xhr)
    },
    setHeader: function(name, value) {
        this.headers.set(name, value);
        return this
    },
    getHeader: function(name) {
        return $try(function() {
            return this.xhr.getResponseHeader(name)
        }.bind(this))
    },
    check: function() {
        if (!this.running) {
            return true
        }
        switch (this.options.link) {
            case "cancel":
                this.cancel();
                return true;
            case "chain":
                this.chain(this.caller.bind.apply(this, arguments));
                return false
        }
        return false
    },
    send: function(options) {
        if (!this.check(options)) {
            return this
        }
        this.running = true;
        var type = $type(options);
        if (type == "string" || type == "element") {
            options = {
                data: options
            }
        }
        var old = this.options;
        options = $extend({
            data: old.data,
            url: old.url,
            method: old.method
        }, options);
        var data = options.data,
            url = String(options.url),
            method = options.method.toLowerCase();
        switch ($type(data)) {
            case "element":
                data = document.id(data).toQueryString();
                break;
            case "object":
            case "hash":
                data = Hash.toQueryString(data)
        }
        if (this.options.format) {
            var format = "format=" + this.options.format;
            data = (data) ? format + "&" + data : format
        }
        if (this.options.emulation && !["get", "post"].contains(method)) {
            var xw = "xw=" + method;
            data = (data) ? xw + "&" + data : xw;
            method = "post"
        }
        if (this.options.urlEncoded && method == "post") {
            var encoding = (this.options.encoding) ? "; charset=" + this.options.encoding : "";
            this.headers.set("Content-type", "application/x-www-form-urlencoded" + encoding)
        }
        if (this.options.noCache) {
            var noCache = "noCache=" + new Date().getTime();
            data = (data) ? noCache + "&" + data : noCache
        }
        var trimPosition = url.lastIndexOf("/");
        if (trimPosition > -1 && (trimPosition = url.indexOf("#")) > -1) {
            url = url.substr(0, trimPosition)
        }
        if (data && method == "get") {
            url = url + (url.contains("?") ? "&" : "?") + data;
            data = null
        }
        this.xhr.open(method.toUpperCase(), url, this.options.async);
        this.xhr.onreadystatechange = this.onStateChange.bind(this);
        this.headers.each(function(value, key) {
            try {
                this.xhr.setRequestHeader(key, value)
            } catch (e) {
                this.fireEvent("exception", [key, value])
            }
        }, this);
        this.fireEvent("request");
        this.xhr.send(data);
        if (!this.options.async) {
            this.onStateChange()
        }
        return this
    },
    cancel: function() {
        if (!this.running) {
            return this
        }
        this.running = false;
        this.xhr.abort();
        this.xhr.onreadystatechange = $empty;
        this.xhr = new Browser.Request();
        this.fireEvent("cancel");
        return this
    }
});
(function() {
    var methods = {};
    ["get", "post", "put", "delete", "GET", "POST", "PUT", "DELETE"].each(function(method) {
        methods[method] = function() {
            var params = Array.link(arguments, {
                url: String.type,
                data: $defined
            });
            return this.send($extend(params, {
                method: method
            }))
        }
    });
    Request.implement(methods)
})();
Element.Properties.send = {
    set: function(options) {
        var send = this.retrieve("send");
        if (send) {
            send.cancel()
        }
        return this.eliminate("send").store("send:options", $extend({
            data: this,
            link: "cancel",
            method: this.get("method") || "post",
            url: this.get("action")
        }, options))
    },
    get: function(options) {
        if (options || !this.retrieve("send")) {
            if (options || !this.retrieve("send:options")) {
                this.set("send", options)
            }
            this.store("send", new Request(this.retrieve("send:options")))
        }
        return this.retrieve("send")
    }
};
Element.implement({
    send: function(url) {
        var sender = this.get("send");
        sender.send({
            data: this,
            url: url || sender.options.url
        });
        return this
    }
});
MooTools.More = {
    version: "1.2.4.4",
    build: "6f6057dc645fdb7547689183b2311063bd653ddf"
};
(function() {
    var data = {
        language: "en-US",
        languages: {
            "en-US": {}
        },
        cascades: ["en-US"]
    };
    var cascaded;
    MooTools.lang = new Events();
    $extend(MooTools.lang, {
        setLanguage: function(lang) {
            if (!data.languages[lang]) {
                return this
            }
            data.language = lang;
            this.load();
            this.fireEvent("langChange", lang);
            return this
        },
        load: function() {
            var langs = this.cascade(this.getCurrentLanguage());
            cascaded = {};
            $each(langs, function(set, setName) {
                cascaded[setName] = this.lambda(set)
            }, this)
        },
        getCurrentLanguage: function() {
            return data.language
        },
        addLanguage: function(lang) {
            data.languages[lang] = data.languages[lang] || {};
            return this
        },
        cascade: function(lang) {
            var cascades = (data.languages[lang] || {}).cascades || [];
            cascades.combine(data.cascades);
            cascades.erase(lang).push(lang);
            var langs = cascades.map(function(lng) {
                return data.languages[lng]
            }, this);
            return $merge.apply(this, langs)
        },
        lambda: function(set) {
            (set || {}).get = function(key, args) {
                return $lambda(set[key]).apply(this, $splat(args))
            };
            return set
        },
        get: function(set, key, args) {
            if (cascaded && cascaded[set]) {
                return (key ? cascaded[set].get(key, args) : cascaded[set])
            }
        },
        set: function(lang, set, members) {
            this.addLanguage(lang);
            langData = data.languages[lang];
            if (!langData[set]) {
                langData[set] = {}
            }
            $extend(langData[set], members);
            if (lang == this.getCurrentLanguage()) {
                this.load();
                this.fireEvent("langChange", lang)
            }
            return this
        },
        list: function() {
            return Hash.getKeys(data.languages)
        }
    })
})();
(function() {
    var global = this;
    var log = function() {
        if (global.console && console.log) {
            try {} catch (e) {}
        } else {
            Log.logged.push(arguments)
        }
        return this
    };
    var disabled = function() {
        this.logged.push(arguments);
        return this
    };
    this.Log = new Class({
        logged: [],
        log: disabled,
        resetLog: function() {
            this.logged.empty();
            return this
        },
        enableLog: function() {
            this.log = log;
            this.logged.each(function(args) {
                this.log.apply(this, args)
            }, this);
            return this.resetLog()
        },
        disableLog: function() {
            this.log = disabled;
            return this
        }
    });
    Log.extend(new Log).enableLog();
    Log.logger = function() {
        return this.log.apply(this, arguments)
    }
})();
Fx.Elements = new Class({
    Extends: Fx.CSS,
    initialize: function(elements, options) {
        this.elements = this.subject = $$(elements);
        this.parent(options)
    },
    compute: function(from, to, delta) {
        var now = {};
        for (var i in from) {
            var iFrom = from[i],
                iTo = to[i],
                iNow = now[i] = {};
            for (var p in iFrom) {
                iNow[p] = this.parent(iFrom[p], iTo[p], delta)
            }
        }
        return now
    },
    set: function(now) {
        for (var i in now) {
            var iNow = now[i];
            for (var p in iNow) {
                this.render(this.elements[i], p, iNow[p], this.options.unit)
            }
        }
        return this
    },
    start: function(obj) {
        if (!this.check(obj)) {
            return this
        }
        var from = {},
            to = {};
        for (var i in obj) {
            var iProps = obj[i],
                iFrom = from[i] = {},
                iTo = to[i] = {};
            for (var p in iProps) {
                var parsed = this.prepare(this.elements[i], p, iProps[p]);
                iFrom[p] = parsed.from;
                iTo[p] = parsed.to
            }
        }
        return this.parent(from, to)
    }
});
Function.implement({
    cL: function() {
        var fE = this,
            yb = [].slice.call(arguments, 0);
        return function() {
            return fE.apply(this, yb.concat([].slice.call(arguments, 0)))
        }
    },
    dT: function(Ey) {
        return function() {
            return arguments[Ey]
        }
    },
    ay: function() {
        var wF = this,
            yb = arguments;
        return function() {
            var Ey = yb.length,
                nw = [];
            while (Ey-- > 0) {
                nw[Ey] = arguments[yb[Ey]]
            }
            wF.apply(this, nw)
        }
    }
});
Array.implement({
    compare: function(a) {
        if (this.length != a.length) {
            return false
        }
        for (var i = 0; i < a.length; i++) {
            if (this[i].compare) {
                if (!this[i].compare(a[i])) {
                    return false
                }
            }
            if (this[i] !== a[i]) {
                return false
            }
        }
        return true
    },
    zx: function(xw) {
        var yb = Array.slice(arguments, 1),
            Ey = -1,
            Gx = this.length,
            Y7 = [];
        while (++Ey < Gx) {
            Y7[Ey] = this[Ey][xw].apply(this[Ey], yb)
        }
        return Y7
    },
    filterFirst: function(callback) {
        if (this === void 0 || this === null) {
            throw new TypeError()
        }
        var t = Object(this),
            len = t.length >>> 0,
            thisp = arguments[1];
        if (typeof callback !== "function") {
            throw new TypeError()
        }
        for (var i = 0; i < len; i++) {
            if (i in t && callback.call(thisp, t[i], i, t)) {
                return t[i]
            }
        }
        return void 0
    },
    L8: function(Po) {
        return this.zx("L8", Po).join("")
    },
    zm: function() {
        var Ey = 0,
            F_ = this.length,
            Gx, Kx = [this[0]];
        while (++Ey < F_) {
            Gx = Math.floor(Math.random() * Ey);
            Kx[Ey] = Kx[Gx];
            Kx[Gx] = this[Ey]
        }
        return Kx
    },
    Lc: function() {
        var ES = {},
            Ey = this.length;
        while (--Ey >= 0) {
            ES[this[Ey]] = Ey
        }
        return ES
    },
    Sp: function(Ve) {
        return this.map(function(TW) {
            return Ve[TW]
        })
    },
    iw: function(qv) {
        var F_ = this.length - 1,
            Kx = [],
            Ey;
        for (Ey = 0; Ey <= F_; ++Ey) {
            Kx[Ey] = this[Ey * qv % F_ || Ey]
        }
        return Kx
    },
    AA: function() {
        this.AA = (function() {
            var Yy = 0;
            return function() {
                var F_ = this.length,
                    Ey;
                if (F_ > 1) {
                    while (Yy == (Ey = Math.floor(Math.random() * F_))) {}
                }
                return this[Yy = Ey]
            }
        })();
        return this.AA()
    }
});
Array.CZ = function(TW) {
    return TW instanceof Array ? TW : TW ? [TW] : []
};
Array.bY = function(ft, wX, OD, BL) {
    var Kx = [],
        Ey;
    OD = OD || Infinity;
    BL = BL || 1;
    for (Ey = ft; Ey <= wX; ++Ey) {
        Kx.push(Ey % OD * BL)
    }
    return Kx
};
String.implement({
    bE: function() {
        return this.charAt(Math.floor(Math.random() * this.length))
    },
    pJ: function(yk) {
        return this.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
    },
    bI: function(Kx) {
        var EP = function(ES) {
            return this.substitute(ES)
        };
        return Kx.map(EP, this)
    },
    LQ: function(Po, fe) {
        fe = fe ? ' class="'.concat(fe, '"') : "";
        return "<".concat(Po, fe, ">", this, "</", Po, ">")
    },
    L8: function(Po, fe) {
        return this.pJ().LQ(Po, fe)
    }
});
Elements.e3 = function(v3) {
    return (new Element("div")).set("html", arguments).getChildren()
};
Element.implement({
    OH: (function() {
        var w9 = {};
        return function(F9) {
            w9[F9] = w9[F9] || function() {
                window.event.which !== 0 && F9.test(String.fromCharCode(window.event.charCode)) && event.preventDefault()
            };
            return this.addEvent("keypress", w9[F9])
        }
    })()
});
Class.Mutators.Binds = function(binds) {
    if (binds instanceof Array && this.prototype.Binds instanceof Array) {
        binds.push.apply(binds, this.prototype.Binds)
    }
    return binds
};
Class.Mutators.initialize = function(initialize) {
    var binder = function() {
        $splat(this.Binds).each(function(name) {
            var original = this[name];
            this[name] = original.bind(this).extend(original)
        }, this);
        $splat(this.BindsWithEvent).each(function(name) {
            var original = this[name];
            this[name] = original.bindWithEvent(this).extend(original)
        }, this);
        delete this.Binds;
        delete this.BindsWithEvent;
        return initialize.extend({
            xq: binder.xq,
            DI: binder.DI,
            bX: binder.bX
        }).apply(this, arguments)
    };
    return binder
};
var N8 = {};
var Of = function(A7) {
    this.jm = window.getComputedStyle(A7, null)
};
Of.prototype = {
    RC: function(eg, S1) {
        S1 = N8.Rl(S1);
        try {
            return this.jm.getPropertyCSSValue ? this.jm.getPropertyCSSValue(S1).getFloatValue(eg) : this.jm.getPropertyValue(S1).toInt()
        } catch (ic) {}
    },
    Dy: function(S1) {
        S1 = N8.Rl(S1);
        return this.RC(5, S1)
    },
    Ra: function(S1) {
        S1 = N8.Rl(S1);
        return this.jm.getPropertyValue(S1)
    }
};
N8.QW = (function(a, b, c) {
    function G() {}

    function F(a, b) {
        var c = a.charAt(0).toUpperCase() + a.substr(1),
            d = (a + " " + p.join(c + " ") + c).split(" ");
        return !!E(d, b)
    }

    function E(a, b) {
        for (var d in a) {
            if (k[a[d]] !== c && (!b || b(a[d], j))) {
                return !0
            }
        }
    }

    function D(a, b) {
        return ("" + a).indexOf(b) !== -1
    }

    function C(a, b) {
        return typeof a === b
    }

    function B(a, b) {
        return A(o.join(a + ";") + (b || ""))
    }

    function A(a) {
        k.cssText = a
    }
    var d = "1.7",
        e = {},
        f = !0,
        g = b.documentElement,
        h = b.head || b.getElementsByTagName("head")[0],
        i = "modernizr",
        j = b.createElement(i),
        k = j.style,
        l = b.createElement("input"),
        m = ":)",
        n = Object.prototype.toString,
        o = " -webkit- -moz- -o- -ms- -khtml- ".split(" "),
        p = "Webkit Moz O ms Khtml".split(" "),
        q = {
            svg: "http://www.w3.org/2000/svg"
        },
        r = {},
        s = {},
        t = {},
        u = [],
        v, w = function(a) {
            var c = b.createElement("style"),
                d = b.createElement("div"),
                e;
            c.textContent = a + "{#modernizr{height:3px}}", h.appendChild(c), d.id = "modernizr", g.appendChild(d), e = d.offsetHeight === 3, c.parentNode.removeChild(c), d.parentNode.removeChild(d);
            return !!e
        },
        x = function() {
            function d(d, e) {
                e = e || b.createElement(a[d] || "div");
                var f = (d = "on" + d) in e;
                f || (e.setAttribute || (e = b.createElement("div")), e.setAttribute && e.removeAttribute && (e.setAttribute(d, ""), f = C(e[d], "function"), C(e[d], c) || (e[d] = c), e.removeAttribute(d))), e = null;
                return f
            }
            var a = {
                select: "input",
                change: "input",
                submit: "form",
                reset: "form",
                error: "img",
                load: "img",
                abort: "img"
            };
            return d
        }(),
        y = ({}).hasOwnProperty,
        z;
    C(y, c) || C(y.call, c) ? z = function(a, b) {
        return b in a && C(a.constructor.prototype[b], c)
    } : z = function(a, b) {
        return y.call(a, b)
    }, r.canvas = function() {
        var a = b.createElement("canvas");
        return !!(a.getContext && a.getContext("2d"))
    }, r.touch = function() {
        return "ontouchstart" in a || w("@media (" + o.join("touch-enabled),(") + "modernizr)")
    }, r.borderradius = function() {
        return F("borderRadius", "", function(a) {
            return D(a, "orderRadius")
        })
    }, r.textshadow = function() {
        return b.createElement("div").style.textShadow === ""
    }, r.opacity = function() {
        B("opacity:.55");
        return /^0.55$/.test(k.opacity)
    }, r.cssanimations = function() {
        return F("animationName")
    }, r.csstransforms = function() {
        return !!E(["transformProperty", "WebkitTransform", "MozTransform", "OTransform", "msTransform"])
    }, r.csstransforms3d = function() {
        var a = !!E(["perspectiveProperty", "WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"]);
        a && "webkitPerspective" in g.style && (a = w("@media (" + o.join("transform-3d),(") + "modernizr)"));
        return a
    }, r.csstransitions = function() {
        return F("transitionProperty")
    };
    for (var H in r) {
        z(r, H) && (v = H.toLowerCase(), e[v] = r[H](), u.push((e[v] ? "" : "no-") + v))
    }
    e.input || G(), e.crosswindowmessaging = e.postmessage, e.historymanagement = e.history, e.addTest = function(a, b) {
        a = a.toLowerCase();
        if (!e[a]) {
            b = !!b(), g.className += " " + (b ? "" : "no-") + a, e[a] = b;
            return e
        }
    }, A(""), j = l = null, e.P1 = f, e.d1 = d, g.className = g.className.replace(/\bno-javascript\b/, "") + " javascript " + u.join(" ");
    return e
})(this, this.document);
N8.ko = function() {
    document.body.adopt((new Element("div", {
        style: "position: absolute; top: -1000px"
    })).adopt(new Element("input", {
        id: "AH",
        type: "text"
    }), new Element("label", {
        "for": "AH",
        text: "AH"
    })))
};
(function() {
    var Yq = {
            Lm: /([0-9_]+) like Mac OS X/,
            p5: /Android ([0-9.]+)/,
            V_: /Windows \w+ ([0-9.]+)/
        },
        C5 = navigator.userAgent.match(/[(]([^;]+)(?:; U)?; ([^;)]+)(?:; [^)]+)?[)]/) || [],
        Aq;
    this.Ko = C5[1];
    if (this.Aq = C5[2]) {
        for (Aq in Yq) {
            if (C5 = this.Aq.match(Yq[Aq])) {
                this.Aq = Aq;
                this.sc = C5[1] && parseFloat(C5[1].substr(0, 3).replace("_", "."));
                break
            }
        }
    }
    if (this.QW.touch) {
        Element.NativeEvents.touchstart = 2;
        Element.NativeEvents.touchmove = 2;
        Element.NativeEvents.touchend = 2;
        Element.NativeEvents.touchcancel = 2
    } else {
        Element.Events.touchstart = {
            base: "mousedown"
        };
        Element.Events.touchmove = {
            base: "mousemove"
        };
        Element.Events.touchend = {
            base: "mouseup"
        }
    }
    if (window.onorientationchange === undefined) {
        Element.Events.orientationchange = {
            base: "resize"
        }
    } else {
        Element.NativeEvents.orientationchange = 2
    }
    var prefixedEvents = [
        ["animationstart", "webkitAnimationStart", "oanimationstart", "MSAnimationStart"],
        ["animationiteration", "webkitAnimationIteration", "oanimationiteration", "MSAnimationIteration"],
        ["animationend", "webkitAnimationEnd", "oanimationend", "MSAnimationEnd"],
        ["transitionend", "webkitTransitionEnd", "oanimationend", "MSTransitionEnd"]
    ];
    prefixedEvents.forEach(function(prefixedEvent) {
        var w3cEvent = prefixedEvent[0];
        prefixedEvent.forEach(function(event) {
            if (window["on" + event.toLowerCase()] !== void 0) {
                Element.NativeEvents[event] = 2;
                if (event != w3cEvent) {
                    Element.Events[w3cEvent] = {
                        base: event
                    }
                }
            }
        })
    });
    this.jb = N8.Aq == "Lm";
    (function() {
        var Zi = document.createElement("canvas"),
            lC = document.createElement("canvas"),
            LH, ho;
        lC.setAttribute("width", 1);
        lC.setAttribute("height", 1);
        ho = lC.getContext("2d");
        Zi.setAttribute("width", 8);
        Zi.setAttribute("height", 8);
        LH = Zi.getContext("2d");
        if (lC.getContext === undefined) {
            return
        }
        this.ga = !!LH.putImageData;
        this.Sa = !!LH.getImageData;
        if (this.ga && this.Sa) {
            this.t6 = 1;
            try {
                LH.putImageData(ho.getImageData(0, 0, 1, 1), -1, -1)
            } catch (R6) {
                this.t6 = 0
            }
        }
        if (this.Sa) {
            ho.fillStyle = "#ffffff";
            ho.fillRect(0, 0, 1, 1);
            LH.clearRect(0, 0, 8, 8);
            LH.drawImage(lC, 4, 4);
            this.zv = LH.getImageData(4, 4, 1, 1).data[0] == 0
        }
    }).call(this);
    document.readyState === "complete" ? N8.ko() : window.addEvent("domready", N8.ko)
}).call(N8);
N8.zv && (function(bM, g3, t3) {
    if (bM != 1) {
        CanvasRenderingContext2D.prototype.drawImage = function(Hg, uy, WZ, tp, yr, JY, GK, Fd, hT) {
            g3.call(this, Hg, uy / bM, WZ / bM, tp / bM, yr / bM, JY / bM, GK / bM, Fd / bM, hT / bM)
        };
        CanvasRenderingContext2D.prototype.putImageData = t3 && function(gD, JY, GK) {
            t3.call(this, gD, JY * bM, GK * bM)
        }
    }
})(window.devicePixelRatio || 1, CanvasRenderingContext2D.prototype.drawImage, CanvasRenderingContext2D.prototype.putImageData);
var NL = new Class({
    O0: function() {
        this.JH = $merge.run([this.JH].extend(arguments));
        if (!this.addEvent) {
            return this
        }
        for (var OC in this.JH) {
            if ($type(this.JH[OC]) != "function" || !(/^on[A-Z]/).test(OC)) {
                continue
            }
            this.addEvent(OC, this.JH[OC]);
            delete this.JH[OC]
        }
        return this
    },
    Sy: function(S1) {
        return this.JH.hasOwnProperty(S1) ? this.JH[S1] : void 0
    },
    f6: function(S1, I_) {
        return this.JH[S1] = I_
    }
});
var QJ = function(Gv, lv, zp) {
    this.Gv = Gv;
    this.lv = lv;
    this.zp = zp || 1;
    this.Uk = 0;
    this.wh = this.wh.bind(this)
};
QJ.prototype = {
    wh: function() {
        if (--this.Uk == 0) {
            this.Gv.removeEvent(this.lv, this.wh);
            this.XS()
        }
    },
    eM: function(VW) {
        this.XS = VW;
        this.Uk = this.zp, this.Gv.addEvent(this.lv, this.wh)
    },
    Dt: function() {
        this.Gv.removeEvent(this.lv, this.wh)
    }
};
Events.implement({
    kM: function(lv, zp) {
        return new QJ(this, lv, zp)
    },
    U7: function(ZQ, XS) {
        var fE = this,
            pw = function() {
                XS.apply(this, arguments);
                fE.removeEvent(ZQ, pw)
            };
        return this.addEvent(ZQ, pw)
    }
});
Element.Properties.gA = {
    set: (function() {
        var wJ = function() {
            Bq = Math.min(1, this.clientWidth / this.scrollWidth);
            Bq && this.mI({
                transform: hA.VK.Bq(Bq, Bq),
                transformOrigin: "0 0"
            })
        };
        return function(v3) {
            if (!this.wJ) {
                this.wJ = this.wJ || wJ.bind(this);
                window.addEvent("orientationchange", this.wJ)
            }
            this.set("html", v3);
            wJ.call(this);
            return this
        }
    })(),
    get: Element.Properties.html.get
};
var Jl = new Class({
    Extends: Events,
    Implements: NL,
    JH: {
        Vs: "",
        vL: "",
        PR: 0
    },
    O3: 0,
    toElement: function() {
        return this.jx
    },
    initialize: function(JH) {
        this.O0(JH);
        this.jx = (JH.jx || new Element("div", {
            id: this.JH.Vs,
            "class": this.JH.vL + " Jl"
        })).adopt(this.c5 = this.JH.c5 || new Element("div", {
            "class": "SK"
        }));
        JH.PR && Jl.PR(this)
    },
    cg: function(v3) {
        this.c5.innerHTML = v3;
        return this
    },
    ex: function(uT) {
        uT = arguments.length ? !!uT : !this.O3;
        if (uT != this.O3) {
            this.fireEvent(uT ? "DH" : "TY");
            this.jx.style.visibility = uT ? "inherit" : "hidden";
            this.O3 = uT;
            this.fireEvent(uT ? "cV" : "xZ")
        }
        return this
    },
    wz: function() {
        return this.O3
    },
    PV: function() {
        return this.ex(!this.O3)
    },
    p9: function(A7) {
        A7 = A7 || new Element("div");
        this.jx.adopt(A7.adopt(this.jx.getChildren()));
        return this
    },
    aH: function(M8, kq) {
        return (new Element("div", {
            id: M8 || "",
            "class": kq || ""
        })).adopt((new Element("div", {
            "class": "Wc"
        })).adopt(this), new Element("div", {
            "class": "vz"
        }))
    },
    qT: function() {
        this.jx.destroy()
    },
    Oz: function() {
        this.jx.dispose()
    },
    Nx: function() {
        return iX.o5(this.__proto__.constructor, [this.JH])
    }
});
Jl.PR = function(o7) {
    var cg = o7.cg;
    o7.cg = function(v3) {
        this.c5.set("gA", v3);
        return this
    }
};
var eT = new Class({
    Extends: Jl,
    Binds: ["NH", "n5", "dg", "XQ"],
    jx: null,
    c5: null,
    oO: 0,
    Jn: 0,
    Xl: 1,
    JH: {
        SK: "",
        Xl: 0,
        Wo: 200,
        m7: 1
    },
    initialize: function(JH) {
        this.O0(JH);
        this.jx = new Element("div", {
            id: this.JH.Vs,
            "class": this.JH.vL + " eT"
        }).adopt(this.c5 = new Element("div", {
            "class": "SK"
        }).adopt(this.Q5 = new Element("div", {
            "class": "x4"
        })), new Element("div", {
            "class": "hQ"
        }));
        this.cg(this.JH.SK);
        this.f7(this.JH.Xl);
        this.c5.addEvents({
            touchstart: this.NH,
            touchend: this.n5,
            c9: this.XQ
        });
        this.QN = this.c5;
        document.addEvents({
            touchend: this.dg,
            touchcancel: this.dg
        })
    },
    p9: function(A7, B_) {
        A7.wraps(this.Q5, B_);
        return this
    },
    f7: function(f7) {
        if (this.Xl != !!f7) {
            this.Xl = !!f7;
            this.Xl ? this.jx.removeClass("H5") : this.jx.addClass("H5");
            this.dg();
            this.fireEvent("f7", this.Xl)
        }
        return this
    },
    cg: function(SK) {
        SK instanceof Element ? this.Q5.adopt(arguments) : this.yJ(SK);
        return this
    },
    yJ: function(x4) {
        this.SK != x4 && this.Q5.set("text", this.SK = x4);
        return this
    },
    NH: function(lv) {
        lv.preventDefault();
        if (this.Xl) {
            this.jx.addClass("oO");
            this.oO = 1;
            ++this.Jn;
            this.fireEvent("Db").c5.fireEvent("c9", [this.Jn], this.JH.Wo)
        }
    },
    n5: function() {
        this.Xl && this.oO && this.fireEvent("z7");
        this.dg()
    },
    dg: function() {
        this.oO = 0;
        this.jx.removeClass("oO")
    },
    XQ: function(Jn) {
        Jn == this.Jn && this.JH.m7 ? this.n5() : this.jx.removeClass("oO")
    }
});
var ro = (function() {
    var sA = {
            chipSet1: [0.05, 0.1, 0.5, 1, 5, 25, 100, 500, 1000, 5000, 10000],
            chipSet2: [0.25, 0.5, 1, 5, 25, 100, 500, 1000, 5000, 10000, 50000],
            chipSet3: [0.5, 1, 5, 10, 50, 100, 500, 1000, 5000, 10000, 50000, 100000],
            chipSet4: [5, 10, 50, 100, 500, 1000, 5000, 10000, 50000, 100000, 500000, 1000000]
        },
        pm, EK, Ek, ZZ, a9, xg, Z0, IP, qt = function(l4, nm) {
            var v4 = ro.K7(l4).split("."),
                KX = (+v4[0]).toString(),
                cv = v4[1] || "",
                Cv;
            if (a9) {
                while (Cv = KX.match(/^(\d+)(\d\d\d)(.*)$/)) {
                    KX = Cv[1].concat(a9, Cv[2], Cv[3])
                }
            }
            nm = nm && cv == 0;
            return ZZ.concat(KX, nm ? "" : fW, nm ? "" : cv, xg)
        };
    return {
        toString: function() {
            return Z0
        },
        rQ: function(v4) {
            return v4 / EK
        },
        K7: function(l4) {
            return (l4 * EK).toFixed(Ek)
        },
        wl: dL = function(qh, nm) {
            return qt(ro.rQ(qh), nm)
        },
        yQ: xV = function(l4) {
            return qt(l4, 1)
        },
        pS: iM = function(l4) {
            return qt(l4, 0)
        },
        Vr: function(qS, qe) {
            var A2 = qS.MAJOR_SYMBOL_PADDING_SPACE == "true" ? "\u00a0" : "";
            Z0 = qS["@currencyCode"];
            Ek = parseInt(qS.DECIMAL_PRECISION);
            EK = qe;
            ZZ = qS.MAJOR_SYMBOL_ALIGNMENT == "left" ? qS.MAJOR_SYMBOL + A2 : "";
            xg = qS.MAJOR_SYMBOL_ALIGNMENT == "right" ? A2 + qS.MAJOR_SYMBOL : "";
            a9 = (qS.USE_THOUSANDS_SEPARATOR == "yes" ? qS.THOUSANDS_SEPARATOR : "").replace("_", "\u00a0");
            fW = (Ek ? qS.DECIMAL_SEPARATOR : "").replace("_", "\u00a0");
            sA = sA[qS.CHIP_SET_CODE] || [];
            pm = sA[0] || 1;
            sA = sA.map(function(I_) {
                return Math.round(I_ / pm)
            })
        },
        lZ: function(l4) {
            var Ey = sA.length,
                hh = [];
            l4 = Math.round(l4 * EK / pm);
            while (--Ey >= 0 && l4 > 0) {
                while (l4 - sA[Ey] >= 0) {
                    hh.push(Ey);
                    l4 -= sA[Ey]
                }
            }
            return hh
        },
        ec: function(g4) {
            for (var TW = 0, Ey = g4.length; --Ey >= 0; TW += sA[g4[Ey]] * pm) {}
            return ro.rQ(TW)
        },
        FQ: function(g4) {
            return g4.map(function(TW) {
                return sA[TW] * pm
            })
        },
        cb: function(FK, Et) {
            var w2 = Math.round(EK / pm),
                hh = [],
                Ey;
            Et = Math.round(Et * EK / pm) || Infinity;
            for (Ey = 0; Ey < sA.length; ++Ey) {
                if (sA[Ey] >= w2 && sA[Ey] <= Et && 0 < FK--) {
                    hh.push(Ey)
                }
            }
            return hh
        },
        pO: function(LF) {
            return ro.rQ(sA[LF] * pm)
        }
    }
})();
var Ne = (function() {
    var Ff = function(Ey) {
            Ey = Ey in this.JH.VT && Ey || 0;
            if (this.jG != Ey) {
                this.jG = Ey;
                this.f7(this.Xl);
                this.jB.innerHTML = this.JH.Ym(this.JH.VT[Ey]);
                this.fireEvent("cM", [this.JH.VT[Ey], Ey])
            }
        },
        FL = function() {
            Ff.call(this, this.jG + 1)
        },
        hZ = function() {
            Ff.call(this, this.jG - 1)
        };
    return new Class({
        Extends: Jl,
        Xl: 0,
        JH: {
            Xl: 0,
            VT: [],
            Ym: iM
        },
        initialize: function(JH) {
            this.O0(JH);
            this.Xl = this.JH.Xl;
            this.jx = new Element("div", {
                id: this.JH.Vs,
                "class": "Ne " + this.JH.vL
            });
            this.jx.adopt(this.R8 = (new eT({
                vL: "Ne Ws"
            })).addEvent("Db", hZ.bind(this)), this.sM = (new eT({
                vL: "Ne aV"
            })).addEvent("Db", FL.bind(this)), this.jB = new Element("div", {
                "class": "n_"
            }));
            this.JH.jr !== void 0 && this.rC(this.JH.jr)
        },
        pp: function(A7) {
            return A7.wraps(this.jB)
        },
        rC: function(jr) {
            Ff.call(this, this.JH.VT.indexOf(jr))
        },
        N2: function() {
            return this.JH.VT[this.jG]
        },
        f7: function(f7) {
            this.Xl = f7 = !!f7;
            this.R8.f7(f7 && this.jG - 1 in this.JH.VT);
            this.sM.f7(f7 && this.jG + 1 in this.JH.VT)
        }
    })
})();
var SZ = (function() {
    var rB = function() {
            var Td = this.RD.Hs(),
                DC = Td.Dy("width"),
                K2 = Td.Dy("height"),
                DZ = this.JH.UA.DZ || Td.Ra("color"),
                Sl = this.JH.UA.Sl,
                CT = this.JH.UA.Ht,
                MK = this.JH.VT.length,
                v8, X_ = this.JH.UA.M3,
                HF, EQ = this.RD,
                F2 = EQ.getContext("2d"),
                E3 = +this.qg.N2(),
                TW;
            MK = CT ? MK : parseInt(this.JH.VT[MK - 1], 10);
            v8 = DC / (MK + MK * X_ - X_);
            X_ *= v8;
            EQ.width = DC;
            EQ.height = K2;
            for (HF = 0; HF < MK; HF++) {
                TW = CT ? +this.JH.VT[HF] : HF + 1;
                F2.fillStyle = TW <= E3 ? DZ : Sl;
                F2.fillRect((v8 + X_) * HF, 0, v8, K2)
            }
        },
        Go = function(jr) {
            rB.call(this);
            this.fireEvent("cM", arguments)
        };
    return new Class({
        Extends: Jl,
        jr: 0,
        H5: 0,
        JH: {
            VT: [],
            Ym: function(jr) {
                return jr
            },
            LE: null,
            UA: {
                Ht: 1,
                M3: 0.4,
                DZ: 0,
                Sl: 0
            }
        },
        initialize: function(JH) {
            this.O0(JH);
            this.jx = new Element("div", {
                id: this.JH.Vs,
                "class": "SZ " + this.JH.vL
            });
            this.jx.adopt(this.qg = new Ne({
                vL: "jz",
                Xl: 1,
                VT: this.JH.VT,
                jr: this.JH.jr,
                Ym: this.JH.Ym
            }), (new eT({
                vL: "G4",
                Xl: 1
            })).addEvent("z7", this.ex.bind(this, 0)));
            this.qg.pp(new Element("div", {
                "class": "Ef"
            })).grab(new Element("div", {
                "class": "UF",
                html: this.JH.LE
            }), "top").adopt(this.RD = new Element("canvas", {
                "class": "UA"
            }));
            this.qg.addEvent("cM", Go.bind(this));
            this.JH.jr !== void 0 && this.rC(this.JH.jr)
        },
        ex: function(uT) {
            uT && rB.call(this);
            return this.parent(uT)
        },
        rC: function(jr) {
            this.qg.rC(jr);
            return this
        },
        N2: function() {
            return this.qg.N2()
        },
    })
})();
var UZ = new Class({
    Extends: Jl,
    Binds: ["Qo", "lU"],
    JH: {
        fe: ""
    },
    initialize: function(JH) {
        this.O0(JH);
        this.jx = (new Element("div", {
            id: this.JH.Vs,
            "class": "UZ " + (this.JH.yq || this.JH.fe)
        })).adopt((new Element("div")).adopt(this.c5 = new Element("span")))
    },
    m5: function() {
        return this.c5
    },
    Qo: function(x4) {
        this.c5.set("text", x4);
        return this
    },
    Yg: function(v3) {
        this.c5.set("html", v3);
        return this
    },
    lU: function(x4) {
        this.c5.set("html", "");
        return this
    },
    jl: function(S1, I_) {
        this.c5.jl(S1, I_);
        return this
    },
    mI: function(b5) {
        this.c5.mI(b5);
        return this
    }
});
var d9 = (function() {
    var Kb = 0,
        h0 = 0,
        ST = {},
        HT = 0,
        X9 = 25,
        rO = 0,
        B9 = function() {
            var Ey, u8, Nj;
            for (Ey in ST) {
                u8 = ST[Ey];
                u8.RL -= X9;
                if (u8.RL <= 0) {
                    isNaN(u8.RL = u8.JO) && mw(Ey);
                    Nj = +new Date;
                    u8.XS(Nj - u8.GX);
                    u8.GX = Nj
                }
            }
        },
        ky = function(d5, XS, B1) {
            B1 = Math.max(B1, 0);
            ST[++HT] = {
                XS: XS,
                JO: d5 ? B1 : NaN,
                RL: B1,
                GX: +new Date
            };
            ++h0;
            lK(0);
            return HT
        },
        mw = function(ee) {
            if (ST[ee]) {
                --h0 || lK(1);
                delete ST[ee]
            }
        },
        I3 = function(ee, XS) {
            if (ST[ee]) {
                ST[ee].XS = XS
            }
            return ST[ee] && ee
        },
        N4 = function(G8) {
            X9 = Math.ceil(1000 / G8)
        },
        Ac = function() {
            return X9
        },
        lK = function(YV) {
            var Nj;
            if (rO == !YV) {
                return
            }
            if (rO) {
                Nj = +new Date;
                for (Ey in ST) {
                    ST[Ey].x_ = Nj - ST[Ey].GX
                }
                Kb = clearInterval(Kb)
            } else {
                Nj = +new Date;
                for (Ey in ST) {
                    if (ST[Ey].x_) {
                        ST[Ey].GX = Nj - ST[Ey].x_
                    }
                }
                Kb = h0 && setInterval(B9, X9)
            }
            rO = !!Kb && !YV
        };
    N4(40);
    window.addEventListener("pagehide", lK.cL(1));
    window.addEventListener("pageshow", lK.cL(0));
    return {
        Ac: Ac,
        N4: N4,
        xD: ky.cL(0),
        nr: ky.cL(1),
        I3: I3,
        I5: mw,
        iK: mw,
        lK: lK.cL(1),
        bB: lK.cL(0)
    }
})();
var Rn = new Class({
    Implements: [Events, NL],
    JH: {},
    DB: 0,
    initialize: function(JH) {
        this.O0(JH)
    },
    Yl: function() {
        return !!this.DB
    },
    kc: function(EM) {
        this.DB = 1;
        this.fireEvent("QQ", this);
        this.EM = EM;
        return this
    },
    P7: function() {
        if (this.DB) {
            this.DB = 0;
            this.fireEvent("T5", this);
            delete this.EM
        }
        return this
    },
    SM: function() {
        if (this.DB) {
            this.DB = 0;
            this.fireEvent("zL", this);
            this.EM && this.EM();
            delete this.EM
        }
        return this
    },
    IJ: function() {
        if (this.DB) {
            this.DB = 0;
            this.fireEvent("rA", this).EM && this.EM();
            delete this.EM
        }
        return this
    }
});
var Mq = new Class({
    Extends: Rn,
    initialize: function(EN, v_) {
        this.EN = EN;
        this.v_ = v_
    },
    kc: function(EM) {
        this.parent(EM);
        return this.v_() ? this.EN.kc(this.IJ.bind(this)) : this.IJ()
    },
    P7: function() {
        if (this.DB) {
            this.EN.P7();
            this.parent()
        }
        return this
    },
    SM: function() {
        if (this.DB) {
            this.EN.SM();
            this.parent()
        }
        return this
    }
});
var Th = new Class({
    Extends: Rn,
    Binds: ["uF"],
    f_: 0,
    initialize: function(xa) {
        this.xa = xa
    },
    g8: function() {
        this.xa.eM(this.uF);
        this.f_ = 1
    },
    kc: function(EM) {
        this.g8();
        this.parent(EM);
        0 == this.f_ && this.IJ();
        return this
    },
    uF: function() {
        this.f_ = 0;
        this.DB && this.IJ()
    },
    P7: function() {
        this.xa && this.xa.Dt();
        this.f_ = 0;
        return this.parent()
    },
    SM: function() {
        this.xa && this.xa.Dt();
        this.f_ = 0;
        return this.parent()
    }
});
(function() {
    var j9 = function(lv, zp) {
        return new Th(new QJ(this, lv, zp))
    };
    Events.implement("HX", j9);
    Rn.implement("HX", j9);
    Element.implement("HX", j9)
})();
var Sz = new Class({
    Extends: Th,
    f_: 0,
    tn: [],
    initialize: function() {
        this.tn = Array.flatten(arguments)
    },
    g8: function() {
        this.f_ = this.tn.length;
        this.tn.forEach(function(xa) {
            xa.eM(this.uF)
        }, this)
    },
    P7: function() {
        this.tn.forEach(function(xa) {
            xa.Dt()
        }, this);
        return this.parent()
    },
    SM: function() {
        this.tn.forEach(function(xa) {
            xa.Dt()
        }, this);
        return this.parent()
    }
});
var kF = new Class({
    Extends: Sz,
    uF: function() {
        if (--this.f_ == 0) {
            this.DB && this.IJ()
        }
    }
});
var hS = (function() {
    var Ak = function() {
        this.Og = 0;
        this.fireEvent("RK", this);
        this.iq()
    };
    return new Class({
        Extends: Rn,
        JH: {
            n3: 0
        },
        Og: 0,
        kc: function(EM) {
            this.parent(EM);
            if (Math.max(0, this.JH.n3) > 0) {
                this.Og = d9.xD(Ak.bind(this), this.JH.n3)
            } else {
                Ak.call(this)
            }
            return this
        },
        iq: function() {
            this.IJ()
        },
        P7: function() {
            this.Og = this.Og && d9.I5(this.Og);
            this.DB && this.parent();
            return this
        },
        SM: function() {
            this.Og = this.Og && d9.I5(this.Og);
            this.DB && this.parent();
            return this
        }
    })
})();
var CG = new Class({
    Extends: Rn,
    initialize: function() {
        this.dU = Array.flatten(arguments);
        this.parent()
    },
    kc: function(EM) {
        var DK = this,
            bP = this.dU.length,
            rR = function() {
                --bP || DK.IJ()
            };
        this.parent(EM);
        this.dU.zx("kc", rR);
        return this
    },
    P7: function() {
        this.dU.zx("P7");
        return this.parent()
    },
    SM: function() {
        this.dU.zx("SM");
        return this.parent()
    }
});
var TK = new Class({
    Extends: hS,
    Binds: ["zy", "qZ"],
    JH: {
        QT: 1,
        Ea: 0,
        vd: 1,
        Ue: 0,
        B1: 1,
        K4: 10000000000
    },
    qL: NaN,
    QT: 1,
    kc: function(EM) {
        this.QT = this.JH.QT;
        this.parent(EM)
    },
    iq: function() {
        this.qL = 0;
        (this.JH.Ue > 0) ? this.zy(): this.qZ()
    },
    mj: function(U_) {
        this.QT = U_ || 1
    },
    zy: function() {
        var SH = this.JH.Ea + this.qL % this.JH.K4 * this.JH.vd;
        if (!isNaN(SH)) {
            this.Og = 0;
            this.fireEvent("VU", [this, this.qL, SH]);
            this.aX(this.qL, SH) && this.qZ()
        }
    },
    qZ: function() {
        if (this.qL == NaN) {
            return
        }
        if (++this.qL >= this.JH.Ue) {
            if (0 == --this.QT || 0 == this.JH.Ue) {
                this.qL = NaN;
                this.IJ();
                return
            }
            this.qL = 0;
            this.fireEvent("sS", [this, this.QT])
        }
        this.Og = d9.xD(this.zy, this.JH.B1)
    },
    P7: function() {
        this.Og = this.Og && d9.I5(this.Og);
        this.qL = NaN;
        this.QT = NaN;
        return this.parent()
    },
    SM: function() {
        this.Og = this.Og && d9.I5(this.Og);
        this.qL = NaN;
        this.QT = NaN;
        return this.parent()
    }
});
var nM = new Class({
    Extends: TK,
    uL: [],
    initialize: function(uL, JH) {
        this.O0(JH);
        this.f5(uL)
    },
    f5: function(uL) {
        uL = uL || [];
        this.uL = uL.filter(function(J_) {
            return J_ instanceof Rn
        });
        this.JH.Ea = 0;
        this.JH.vd = 1;
        this.JH.Ue = this.uL.length;
        this.JH.K4 = this.uL.length;
        return this
    },
    aX: function(qL, SH) {
        this.uL[qL].kc(this.qZ);
        return 0
    },
    P7: function() {
        var J_ = this.uL[this.qL];
        if (J_) {
            delete J_.EM;
            J_.P7()
        }
        this.parent()
    },
    SM: function() {
        var J_ = this.uL[this.qL];
        if (J_) {
            delete J_.EM;
            J_.SM()
        }
        return this.parent()
    }
});
var q9 = new Class({
    Extends: nM,
    initialize: function() {
        this.parent(Array.flatten(arguments))
    }
});
iP.NX = {};
iP.yS = {};
Wx.Pj("image/*", (function(Ri) {
    return function(HE) {
        var FN = this,
            Hg = new Image();
        Hg.onload = function() {
            delete Hg.onload;
            delete Hg.onerror;
            iP.NX[FN.Vs] = Hg;
            FN.yS && iX.E7(FN.yS, function(Fj, Vs) {
                iP.yS[Vs] = iX.o5(qW, [Hg].concat(Fj.slice(0)))
            });
            FN.T7()
        };
        Hg.onerror = this.bR;
        Hg.src = HE.concat(this.lX, "&resolution=", Ri)
    }
})(navigator.userAgent.indexOf("iPad;") >= 0 ? 2 : window.devicePixelRatio || 1), ["image/*"]);
var qW = function(Hg, HF, LI, v8, jp, QZ, Qu, u4) {
    u4 = u4 || 1;
    Hg.yS = Hg.yS || [];
    Hg.yS.push(this);
    this.Hg = Hg;
    this.HF = HF / u4;
    this.LI = LI / u4;
    this.DC = v8 / u4;
    this.K2 = jp / u4;
    this.PN = QZ;
    this.W9 = Qu;
    this.Z6 = this.DC / QZ;
    this.tQ = this.K2 / Qu;
    this.sE = u4;
    this.m8 = window.devicePixelRatio || 1
};
qW.prototype = {
    constructor: qW,
    Gf: function(Ji, S0, xL, QV, Yh, Z3, lw, tC, MJ) {
        var F_ = arguments.length,
            HF = this.HF,
            LI = this.LI,
            v8 = this.DC,
            jp = this.K2,
            u4 = this.sE;
        F_ == 3 ? Ji.drawImage(this.Hg, HF * u4, LI * u4, v8 * u4, jp * u4, S0 * this.m8, xL * this.m8, v8 * this.m8, jp * this.m8) : F_ == 5 ? Ji.drawImage(this.Hg, HF * u4, LI * u4, v8 * u4, jp * u4, S0 * this.m8, xL * this.m8, QV * this.m8, Yh * this.m8) : Ji.drawImage(this.Hg, HF * u4 + S0 * u4, LI * u4 + xL * u4, QV * u4, Yh * u4, Z3 * this.m8, lw * this.m8, tC * this.m8, MJ * this.m8)
    },
    y_: function(Ji, Gh, Sb, JY, GK, Fd, hT) {
        this.Gf(Ji, (Gh * this.Z6) || 0, (Sb * this.tQ) || 0, this.Z6, this.tQ, JY || 0, GK || 0, Fd || this.Z6, hT || this.tQ)
    },
    JT: function() {
        return this.Hg.JT()
    },
    kS: function() {
        return this.Hg.kS(this.sE || 1)
    },
    Cf: function(Gh, Sb) {
        return [-this.HF - (Gh || 0) * this.Z6, -this.LI - (Sb || 0) * this.tQ, ""].join("px ")
    },
    Y4: function(J_) {
        return [-this.HF - (J_ || 0) % this.PN * this.Z6, "px"].join("")
    },
    VQ: function(J_) {
        return [-this.LI - (J_ || 0) % this.W9 * this.tQ, "px"].join("")
    },
    ZS: function(Gh, Sb) {
        return [this.Hg.JT(), "repeat", this.Cf(Gh, Sb)].join(" ")
    }
};
Image.prototype.JT = function() {
    return ["url(", this.src, ")"].join("")
};
Image.prototype.kS = function(sE) {
    return [this.width / sE, this.height / sE, ""].join("px ")
};
qW.ep = function(v8, jp) {
    var EQ = document.createElement("canvas");
    EQ.width = v8 * window.devicePixelRatio || 1;
    EQ.height = jp * window.devicePixelRatio || 1
};
Element.implement({
    l2: function(GW, Gh, Sb) {
        return this.rD(GW).ZV(GW, Gh, Sb)
    },
    rD: function(GW) {
        return this.mI({
            width: GW.Z6 + "px",
            height: GW.tQ + "px"
        })
    },
    ZV: function(GW, Gh, Sb) {
        return this.mI({
            backgroundImage: GW.JT(),
            backgroundSize: GW.kS(),
            backgroundPosition: GW.Cf(Gh, Sb)
        })
    }
});
Fx.implement({
    stopTimer: function() {
        if (!this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.timer = d9.iK(this.timer);
        return true
    },
    startTimer: function() {
        if (this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.BJ = this.BJ || this.step.bind(this);
        this.timer = d9.nr(this.BJ, Math.round(1000 / this.options.fps));
        return true
    }
}, 1);
var pG = new Class({
    Extends: hS,
    JH: {
        uJ: {}
    },
    initialize: function(iG, JH) {
        this.parent(JH);
        this.iG = iG.addEvent("complete", this.IJ.bind(this))
    },
    iq: function() {
        this.iG.start(this.JH.uJ)
    },
    P7: function() {
        this.iG.cancel();
        return this.parent()
    },
    SM: function() {
        return this.parent()
    }
});
var hp = new Class({
    Extends: Rn,
    JH: {
        MT: !!N8.QW.csstransitions,
        CC: true,
        n3: 1,
        unit: "",
        transition: "linear",
        XL: 1
    },
    Fc: 0,
    O0: function(JH) {
        this.parent(JH);
        this.JH.MT && this.D5(this.JH);
        return this
    },
    initialize: function(A7, JH) {
        this.A7 = A7;
        this.O0(JH);
        if (this.JH.MT) {
            this.parent()
        } else {
            return new pG(new Fx.Morph(A7, JH), JH)
        }
    },
    kc: function(EM) {
        this.parent(EM);
        return this.eO()
    }
});
N8.QW.csstransitions && hp.implement({
    Binds: ["SB", "qm"],
    D5: function(JH) {
        var rq = JH.duration + "ms",
            Jk = JH.n3 + "ms",
            n8 = [],
            jL = [],
            ze = [],
            a8;
        this.NU = {
            transitionProperty: "",
            transitionDuration: "",
            transitionDelay: "",
            transitionTimingFunction: ""
        };
        this.RA = {};
        this.Ed = 0;
        for (a8 in JH.uJ) {
            I_ = JH.uJ[a8];
            a8 = a8.camelCase();
            if ($type(I_) == "array") {
                this.NU[a8] = I_[0].toString() + this.JH.unit;
                this.RA[a8] = I_[1].toString() + this.JH.unit
            } else {
                this.RA[a8] = I_.toString() + this.JH.unit
            }
        }
        this.JH.CC && hp.Z9(this.RA) && this.CC();
        for (a8 in this.RA) {
            ++this.Ed;
            n8.push(a8.hyphenate());
            jL.push(rq);
            ze.push(Jk)
        }
        this.RA.transitionProperty = n8.join(" ,");
        this.RA.transitionDuration = jL.join(" ,");
        this.RA.transitionDelay = ze.join(" ,");
        this.RA.transitionTimingFunction = hp.QB[JH.transition] || JH.transition;
        this.ib = JH.n3 + JH.duration;
        return this
    },
    CC: function() {
        var RA = this.RA,
            NU = this.NU,
            Td = this.A7.Hs(),
            uX = RA.transform = RA.transform || Td.OL(),
            dM = NU.transform = NU.transform || Td.OL();
        b5 = [{
            a8: "top",
            EH: 1,
            jG: 5
        }, {
            a8: "bottom",
            EH: -1,
            jG: 5
        }, {
            a8: "left",
            EH: 1,
            jG: 4
        }, {
            a8: "right",
            EH: -1,
            jG: 4
        }];
        b5.forEach(function(a8) {
            var EH = a8.EH,
                jG = a8.jG,
                a8 = a8.a8,
                kc, LV, oe;
            if (RA[a8]) {
                LV = EH * parseFloat(RA[a8]) || 0;
                oe = EH * parseFloat(NU[a8]) || 0;
                kc = -EH * Td.Dy(a8) || 0;
                dM[jG] = kc + oe;
                uX[jG] = kc + LV;
                delete RA[a8];
                delete NU[a8]
            }
        })
    },
    SB: function(lv) {
        --this.Fc == 0 && this.IJ()
    },
    qm: function() {
        this.Fc = 0;
        this.DB && this.IJ()
    },
    eO: function() {
        if (this.Ed) {
            this.A7.mI(this.NU);
            document.body.offsetWidth;
            this.A7.addEvent("transitionend", this.SB);
            this.Fc = this.Ed;
            this.A7.mI(this.RA);
            this.Rq = this.JH.XL && setTimeout(this.qm, this.ib + 250)
        } else {
            this.IJ()
        }
    },
    IJ: function() {
        this.A7.removeEvent("transitionend", this.SB);
        this.A7.mI({
            transitionProperty: "",
            transitionDuration: "",
            transitionDelay: "",
            transitionTimingFunction: ""
        });
        document.body.offsetWidth;
        this.parent()
    }
});
hp.Z9 = function(a8) {
    var aK = (a8.top !== undefined),
        V3 = (a8.bottom !== undefined),
        F_ = (a8.left !== undefined),
        Y7 = (a8.right !== undefined);
    if (!hp.VO) {
        return false
    }
    return (aK || V3 || F_ || Y7) && !(aK && V3) && !(F_ && Y7)
};
hp.VO = N8.Ko != "iPad" && N8.QW.csstransforms && N8.jb;
hp.gS = ["top", "left", "bottom", "right"];
hp.QB = {
    ease: "cubic-bezier(0.25, 0.1 , 0.25, 1   )",
    "ease:in": "cubic-bezier(0.42, 0   , 1   , 1   )",
    "ease:out": "cubic-bezier(0   , 0   , 0.58, 1   )",
    "ease:in:out": "cubic-bezier(0.42, 0   , 0.58, 1   )",
    linear: "cubic-bezier(0   , 0   , 1   , 1   )",
    "expo:in": "cubic-bezier(0.71, 0.01, 0.83, 0   )",
    "expo:out": "cubic-bezier(0.14, 1   , 0.32, 0.99)",
    "expo:in:out": "cubic-bezier(0.85, 0   , 0.15, 1   )",
    "circ:in": "cubic-bezier(0.34, 0   , 0.96, 0.23)",
    "circ:out": "cubic-bezier(0   , 0.5 , 0.37, 0.98)",
    "circ:in:out": "cubic-bezier(0.88, 0.1 , 0.12, 0.9 )",
    "sine:in": "cubic-bezier(0.22, 0.04, 0.36, 0   )",
    "sine:out": "cubic-bezier(0.04, 0   , 0.5 , 1   )",
    "sine:in:out": "cubic-bezier(0.37, 0.01, 0.63, 1   )",
    "quad:in": "cubic-bezier(0.14, 0.01, 0.49, 0   )",
    "quad:out": "cubic-bezier(0.01, 0   , 0.43, 1   )",
    "quad:in:out": "cubic-bezier(0.47, 0.04, 0.53, 0.96)",
    "cubic:in": "cubic-bezier(0.35, 0   , 0.65, 0   )",
    "cubic:out": "cubic-bezier(0.09, 0.25, 0.24, 1   )",
    "cubic:in:out": "cubic-bezier(0.66, 0   , 0.34, 1   )",
    "quart:in": "cubic-bezier(0.69, 0   , 0.76, 0.17)",
    "quart:out": "cubic-bezier(0.26, 0.96, 0.44, 1   )",
    "quart:in:out": "cubic-bezier(0.76, 0   , 0.24, 1   )",
    "quint:in": "cubic-bezier(0.64, 0   , 0.78, 0   )",
    "quint:out": "cubic-bezier(0.22, 1   , 0.35, 1   )",
    "quint:in:out": "cubic-bezier(0.9 , 0   , 0.1 , 1   )"
};
var NJ = new Class({
    Extends: TK,
    A7: null,
    initialize: function(A7, JH) {
        this.O0(JH);
        this.QP(A7)
    },
    QP: function(A7) {
        this.A7 = A7;
        return this
    },
    SM: function() {
        if (this.DB) {
            this.qL = this.JH.Ue - 1;
            this.aX(this.qL, (this.JH.Ea + this.JH.vd * this.qL) % this.JH.K4);
            this.parent()
        }
        return this
    }
});
var DT = new Class({
    Extends: NJ,
    JH: {
        Bw: []
    },
    initialize: function(A7, JH) {
        JH.Ue = JH.Ue || JH.Bw.length;
        this.parent(A7, JH)
    },
    Yj: "",
    aX: function(qL, SH) {
        var Q_ = this.JH.Bw[qL];
        this.A7.addClass(Q_).removeClass(this.Yj);
        this.Yj = Q_;
        return 1
    },
    P7: function() {
        this.A7.removeClass(this.Yj);
        return this.parent()
    }
});
var Sr = new Class({
    Extends: NJ,
    JH: {
        vK: "backgroundPosition",
        eg: "px 0"
    },
    initialize: function(A7, JH) {
        this.parent(A7, JH);
        this.JH.vK = this.JH.vK.camelCase()
    },
    kc: function(EM) {
        this.P3 = this.A7 ? this.A7.vf(this.JH.vK) : "";
        this.parent(EM)
    },
    aX: function(qL, SH) {
        var I_ = SH.toString().concat(this.JH.eg);
        this.A7.jl(this.JH.vK, I_);
        return 1
    },
    P7: function() {
        this.A7.jl(this.JH.vK, this.P3);
        return this.parent()
    }
});
var LK = new Class({
    Extends: Sr,
    JH: {
        vK: "visibility",
        gF: ["visible", "hidden"],
        eg: ""
    },
    O0: function(JH) {
        var Hh = JH.gF ? JH.gF.length : this.JH.gF.length;
        JH.Ue = JH.Ue || Hh;
        JH.K4 = JH.K4 || Hh;
        return this.parent(JH)
    },
    aX: function(qL, SH) {
        this.A7.jl(this.JH.vK, this.JH.gF[qL] + this.JH.eg);
        return 1
    }
});
var bK = new Class({
    Extends: LK,
    initialize: function(A7, GW, JH) {
        var Hd, wG;
        JH = JH || {};
        Hd = (JH.Hd || "x").toUpperCase() === "X";
        wG = Hd ? GW.PN : GW.W9;
        JH.vK = Hd ? "backgroundPositionX" : "backgroundPositionY";
        JH.Ue = JH.Ue || wG;
        JH.gF = (JH.gF || Array.bY(1, JH.Ue)).map(Hd ? GW.Y4 : GW.VQ, GW);
        this.parent(A7, JH)
    }
});
qW.prototype.Rn = function(A7, JH) {
    return new bK(A7, this, JH)
};
Element.implement({
    fL: function(GW, JH) {
        return new bK(this, GW, JH)
    }
});
var Tp = function(Kx, V3, ef, mV, HF, LI) {
    Kx instanceof Array ? this.push.apply(this, Kx.slice(0, 6)) : this.push.call(this, Kx || 1, V3 || 0, ef || 0, mV || 1, HF || 0, LI || 0)
};
Tp.prototype = [];
Tp.prototype.$family = {
    name: "Tp"
};
$extend(Tp.prototype, {
    ZI: function(Yw) {
        var Kx = this[0],
            V3 = this[1],
            ef = this[2],
            mV = this[3];
        this[0] = Kx * Yw[0] + ef * Yw[1];
        this[1] = V3 * Yw[0] + mV * Yw[1];
        this[2] = Kx * Yw[2] + ef * Yw[3];
        this[3] = V3 * Yw[2] + mV * Yw[3];
        this[4] = Kx * Yw[4] + ef * Yw[5] + this[4];
        this[5] = V3 * Yw[4] + mV * Yw[5] + this[5];
        return this
    }
});
var B7 = {
    Cd: function(OU, Dc) {
        this[4] += OU;
        this[5] += Dc;
        return this
    },
    cw: function(OU) {
        this[4] += OU;
        return this
    },
    jW: function(Dc) {
        this[5] += Dc;
        return this
    },
    hs: function(Lj) {
        var zq = Math.sin(Lj),
            e5 = Math.cos(Lj),
            Kx = this[0],
            V3 = this[1],
            ef = this[2],
            mV = this[3];
        this[0] = Kx * e5 + ef * zq;
        this[1] = V3 * e5 + mV * zq;
        this[2] = ef * e5 - Kx * zq;
        this[3] = mV * e5 - V3 * zq;
        return this
    },
    Bq: function(T6, Dz) {
        this[0] *= T6;
        this[1] *= T6;
        this[2] *= Dz;
        this[3] *= Dz;
        return this
    },
    nx: function() {
        this[0] = -this[0];
        this[1] = -this[1];
        return this
    },
    u5: function() {
        this[2] = -this[2];
        this[3] = -this[3];
        return this
    },
    toString: N8.QW.csstransforms3d && N8.jb ? function() {
        return "matrix3d(".concat([this[0], this[1], 0, 0, this[2], this[3], 0, 0, 0, 0, 1, 0, this[4], this[5], 0, 1].join(","), ")")
    } : Browser.Engine.gecko ? function() {
        return "matrix(".concat([this[0], this[1], this[2], this[3], this[4] + "px", this[5] + "px"].join(","), ")")
    } : function() {
        return "matrix(".concat(this.join(","), ")")
    }
};
var l3 = function() {
    Tp.apply(this, arguments)
};
var Wu = function() {};
Wu.prototype = Tp.prototype;
l3.prototype = new Wu();
l3.prototype.constructor = l3;
$extend(l3.prototype, B7);
hA = {
    VK: function(a, b, c, d, e, f) {
        return new l3(a, b, c, d, e, f)
    }
};
hA.VK.LJ = new l3();
(function() {
    for (var xw in B7) {
        hA.VK[xw] = (function(xw) {
            return function() {
                return xw.apply(new l3(1, 0, 0, 1, 0, 0), arguments)
            }
        })(B7[xw])
    }
})();
Of.prototype.OL = function() {
    var VK = this.Ra("transform");
    VK = VK && VK.replace(/^[^(]+/, "").match(/[-0-9.]+/g);
    VK = VK && VK.map(parseFloat);
    return VK && VK.length == 16 ? new l3(VK[0], VK[1], VK[4], VK[5], VK[12], VK[13]) : new l3(VK)
};
var vX = (function() {
    var Kg = function() {
            this.Km = new TK({
                Ea: 1
            });
            this.Km.aX = function(qL, SH) {
                r1.call(this, (this.JH.aO) ? (this.AM + SH - 1) : (this.AM + (this.IB - this.AM) * Math.log(SH) / Math.LN10));
                return 1
            }.bind(this);
            this.Km.addEvents({
                zL: function() {
                    r1.call(this, this.IB);
                    this.AM = this.IB
                }.bind(this)
            });
            return this.Km
        },
        r1 = function(AM) {
            AM = this.JH.lA(AM);
            if (AM !== this.NP) {
                return !!this.c5.set("text", this.NP = AM)
            }
        };
    return new Class({
        Extends: Jl,
        Implements: [Events, NL],
        JH: {
            lA: iM,
            Te: ro.K7,
            aO: false,
            Sv: 25
        },
        initialize: function(JH) {
            this.O0(JH);
            this.jx = this.c5 = this.JH.jx.addClass("vX " + this.JH.vL);
            (this.JH.AM !== undefined) && this.rC(this.JH.AM)
        },
        Lq: function() {
            this.AM = 0;
            this.c5.set("text", this.NP = "");
            this.fireEvent("cM", [this.AM, this.NP])
        },
        rC: function(AM) {
            this.Km && this.Km.SM();
            if (r1.call(this, AM)) {
                this.AM = this.IB = AM;
                this.fireEvent("cM", [this.JH.Te(AM), this.NP])
            }
            return this
        },
        N2: function() {
            return this.AM || 0
        },
        kg: function(IB, F0) {
            var Ue;
            (this.Km || Kg.call(this)).SM();
            this.IB = IB;
            if (this.JH.aO) {
                Ue = Math.floor(Math.abs(ro.K7(this.IB - this.AM) / ro.K7(F0)) * this.JH.Sv);
                this.Km.O0({
                    vd: F0 / this.JH.Sv,
                    Ue: Ue,
                    B1: this.JH.B1
                })
            } else {
                Ue = Math.floor(this.JH.Sv + this.JH.Sv * Math.log(Math.abs(ro.K7(IB - this.AM) / ro.K7(F0))) / Math.LN10);
                this.Km.O0({
                    Ue: Ue,
                    vd: 9 / Ue
                })
            }
        },
        Rn: function() {
            var DK = this;
            return new Mq(this.Km || Kg.call(this), function() {
                return DK.IB != DK.AM
            })
        }
    })
})();
var MG = new Class({
    Extends: Jl,
    initialize: function(JH) {
        this.O0(JH);
        this.jx = new Element("div", {
            id: this.JH.Vs,
            "class": "MG " + this.JH.vL
        }), this.Oj = {}
    },
    Vk: function(A7, B_) {
        var A7 = A7 instanceof Element ? A7 : A7.toElement();
        if (B_ !== undefined) {
            B_ = this.jx.getChildren()[B_]
        }
        B_ instanceof Element ? A7.inject(B_, "before") : this.jx.adopt(A7);
        return this
    },
    Bs: function(lv, YN, B_) {
        (this.Oj[lv] = this.Oj[lv] || []).push(YN);
        this.Vk(YN, B_);
        this.fireEvent("Y1", [lv, YN]);
        return this
    },
    Pz: function(Nl) {
        iX.E7(Nl, this.Bs.ay(1, 0).bind(this))
    },
    zM: function(BB, lv) {
        var i4, fU, Ey;
        for (i4 in this.Oj) {
            if (lv && i4 !== lv) {
                continue
            }
            fU = this.Oj[i4];
            fU && fU.forEach(function(YN) {
                YN.f7(BB)
            })
        }
        return this
    },
    kh: function(BB) {
        iX.E7(this.Oj, this.zM.cL(BB).ay(1), this);
        return this
    },
    Nm: function(lv) {
        this.Oj[lv].forEach(function(YN) {
            YN.removeEvents();
            YN.Oz()
        });
        delete this.Oj[lv];
        return this
    },
    Mm: function() {
        iX.E7(this.Oj, this.Nm.ay(1).bind(this));
        return this
    }
});
var L6 = new Class({
    Extends: Jl,
    Binds: ["ub", "Qb"],
    initialize: function(JH) {
        this.O0(JH);
        this.jx = (new Element("div", {
            id: this.JH.Vs,
            "class": this.JH.vL + " L6"
        })).adopt(this.c5 = new Element("div", {
            "class": "NC"
        }), this.Oj = new MG({
            vL: "aA"
        }).addEvent("Y1", this.ub.bind(this)));
        this.addEvents({
            LC: this.Qb,
            xZ: DA.LS
        })
    },
    Qo: function(A_) {
        this.c5.innerHTML = "";
        this.c5.adopt(arguments).children.length || this.c5.set("html", A_);
        return this
    },
    ub: function(lv, YN) {
        YN.addEvent("z7", this.fireEvent.bind(this, lv))
    },
    Qb: function() {
        this.ex(0)
    },
    Bs: function(lv, YN, B_) {
        this.Oj.Bs(lv, YN, B_);
        return this
    },
    Pz: function(b3) {
        iX.E7(b3, this.Bs.ay(1, 0), this);
        return this
    },
    rj: function() {
        return this.Bs("LC", new eT({
            vL: "wq",
            Xl: 1
        }))
    },
    zM: function(BB, lv) {
        this.Oj.zM(BB, lv);
        return this
    },
    kh: function(BB) {
        this.Oj.kh(BB);
        return this
    },
    KB: function(uT) {
        this.Oj.ex(uT);
        return this
    },
    Nm: function(lv) {
        this.Oj.Nm(lv);
        return this
    },
    Mm: function() {
        this.Oj.Mm();
        return this
    }
});
L6.nS = function(YR) {
    var MB = (new Element("div", {
        "class": "Kr",
        style: "visibility:hidden"
    })).adopt(new Element("div", {
        "class": "KN"
    }).adopt(YR));
    YR.jx = MB;
    return YR
};
var yN = new Class({
    Implements: [Events, NL],
    Binds: ["tY"],
    JH: {
        aU: 5
    },
    toElement: function() {
        return this.ji
    },
    initialize: function(JH) {
        var Ey, Gx, KV, Y7, gW, H8, BV = 0,
            vH = [],
            v6, DK = this;
        this.O0(JH);
        this.x3 = [];
        this.pB = [];
        this.Mx = new Elements();
        this.Bh = [];
        this.hq = [];
        for (Ey = this.JH.UB; Ey--;) {
            this.hq[Ey] = Ey
        }
        this.SW = [];
        this.m3 = [];
        this.YW = N8.Aq == "p5" ? {
            S1: "display",
            ex: "block",
            Ya: "none"
        } : {
            S1: "visibility",
            ex: "visible",
            Ya: "hidden"
        };
        this.wx = this.wx.bind(this);
        this.ji = new Element("div", {
            id: "rr"
        });
        Ey = this.JH.uY.length;
        Y7 = this.JH.jd.xE;
        do {
            this.Mx[--Y7] = gW = new Element("div", {
                "class": "gW",
                styles: {
                    right: BV
                }
            });
            this.SW[Y7] = (new q9(this.JH.Tf && new hp(gW, {
                duration: 175,
                transition: "quint:in",
                uJ: {
                    top: "35px"
                }
            }), (new hS()).addEvents({
                rA: this.OJ.bind(this, Y7)
            }), this.JH.Tf && new hp(gW, {
                duration: 1,
                uJ: {
                    top: "10px"
                }
            })));
            this.m3[Y7] = (new q9((new hS()).addEvents({
                rA: this.k8.bind(this, Y7)
            }), this.JH.Tf && new hp(gW, {
                duration: 100,
                transition: "sine:in",
                uJ: {
                    top: "12px"
                }
            }), this.JH.Tf && new hp(gW, {
                duration: 250,
                transition: "sine:in:out",
                uJ: {
                    top: "0px"
                }
            })));
            Gx = Ey - this.JH.jd.ah;
            do {
                --Ey;
                H8 = new Element("div", {
                    "class": "ov",
                    style: "position:absolute; top:" + ((Ey - Gx - 1) * (this.JH.jd.Q3 + this.JH.jd.N9)) + "px"
                });
                this.x3[this.JH.uY[Ey]] = H8;
                H8.inject(gW, "top")
            } while (Ey > Gx);
            this.Bh[Y7] = new Elements();
            for (Gx = this.JH.UB; Gx--;) {
                var b5 = {
                        backgroundPosition: (Gx * -(this.JH.jd.tD + this.JH.jd.FE)) + "px 0px",
                        right: BV + "px",
                    },
                    gd;
                b5[this.YW.S1] = this.YW.Ya;
                this.Bh[Y7][Gx] = gd = new Element("div", {
                    "class": this.JH.M2,
                    styles: b5
                })
            }
            BV += this.JH.jd.tD;
            if (this.JH.jd.FE && Y7) {
                vH[Y7] = new Element("div", {
                    "class": "ui",
                    styles: {
                        right: BV
                    }
                })
            }
            BV += this.JH.jd.FE
        } while (Ey);
        this.ji.adopt(this.Mx, this.Bh, vH);
        this.MA = this.MA.bind(this)
    },
    TP: function() {
        if (this.Kb) {
            this.Mx.mI({
                top: "0px",
                visibility: ""
            });
            this.jD(0);
            this.Kb = d9.iK(this.Kb)
        }
        this.RJ = 0
    },
    Nv: function(c3) {
        c3.each(function(wT, B_) {
            this.x3[B_].removeClass(this.pB[B_]).addClass(wT).style.backgroundPosition = ""
        }, this);
        this.pB = c3.slice(0)
    },
    Cl: function(c3) {
        this.c3 = c3.slice(0)
    },
    QD: function(uY) {
        var ZD = [];
        for (var Ey = uY.length; Ey--;) {
            ZD[Ey] = this.x3[uY[Ey]]
        }
        return new Elements(ZD)
    },
    AP: function(MI) {
        var Zu = this.Mx.map(Function.dT(1)),
            SW = [],
            m3 = [],
            v6 = 0,
            M9 = 0;
        this.hq = this.hq.zm();
        this.zH = {
            FR: 0,
            rq: -1,
            Od: 0,
            Q6: this.JH.jd.xE,
            Rk: [],
            Nt: 0,
            hq: this.Mx.map(function(gW, Ey) {
                return this.hq[Ey % this.hq.length]
            }, this),
            KG: []
        };
        this.Kb = this.Kb || d9.nr(this.wx, this.JH.aU);
        this.jD(0);
        (MI ? Zu.zm() : Zu).forEach(function(X_, Ey) {
            SW[Ey] = this.SW[X_].O0({
                n3: v6 += this.JH.q2
            });
            m3[Ey] = this.m3[X_].O0({
                n3: M9 += this.JH.N3
            })
        }, this);
        this.Rj = (new CG(SW)).kc();
        this.Q2 = (new CG(m3)).addEvent("rA", this.mS.bind(this))
    },
    jD: function(AE) {
        this.Bh.forEach(function(Vo, Y7) {
            var Hg = Vo[(this.zH.FR + this.zH.hq[Y7]) % this.JH.UB];
            Hg.style[this.YW.S1] = AE && this.zH.Rk[Y7] ? this.YW.ex : this.YW.Ya;
            this.zH.KG[Y7] = Hg
        }, this)
    },
    OJ: function(Y7) {
        if (!this.Kb) {
            return
        }
        this.zH.Rk[Y7] = 1;
        this.zH.KG[Y7].style[this.YW.S1] = this.YW.ex;
        this.Mx[Y7].style.visibility = "hidden";
        --this.zH.Q6 || this.fireEvent("uR")
    },
    wx: function() {
        if (!this.zH.Q6 && this.c3) {
            this.Nv(this.c3);
            this.zH.rq += Math.ceil(this.JH.qE / d9.Ac());
            this.zH.rq = Math.max(this.zH.rq, 1);
            delete this.c3;
            this.zH.v6 = 0
        }
        this.jD(0);
        this.zH.FR++;
        this.zH.FR %= this.JH.UB;
        this.jD(1);
        !this.RJ && --this.zH.rq;
        this.zH.rq == 0 && !this.zH.Nt && this.Q2.kc()
    },
    k8: function(Y7) {
        this.Mx[Y7].style.visibility = "visible";
        this.zH.KG[Y7].style[this.YW.S1] = this.YW.Ya;
        document.body.offsetWidth;
        this.zH.Rk[Y7] = 0;
        ++this.zH.Nt
    },
    mS: function() {
        this.Kb = d9.iK(this.Kb);
        this.jD(0);
        this.Mx.jl("visibility", "visible");
        document.body.offsetWidth;
        d9.xD(this.MA, 1)
    },
    MA: function() {
        this.fireEvent("mS")
    },
    tY: function(fK) {
        this.RJ = !!fK
    }
});
var bO = (function() {
    var xH = ((navigator.userAgent.indexOf("Mozilla/5.0") > -1 && navigator.userAgent.indexOf("Android ") > -1 && navigator.userAgent.indexOf("AppleWebKit") > -1) && !(navigator.userAgent.indexOf("Chrome") > -1));
    return new Class({
        Implements: [NL],
        XU: null,
        mH: null,
        Ww: null,
        JH: {
            wd: [],
            jd: null,
            aL: 2,
            CJ: 3,
            ww: "#000000",
            CX: "miter",
            rM: "butt",
            Q4: "",
            RZ: true
        },
        toElement: function() {
            return this.mH
        },
        initialize: function(XU, JH) {
            this.O0(JH);
            this.mH = new Element("div", {
                id: "H9"
            });
            this.XU = this.Gw(XU);
            var jd = this.JH.jd,
                nN = this.JH.aL,
                HH = jd.Q3,
                ew = jd.tD,
                F7 = jd.FE,
                oz = jd.N9,
                xE = jd.xE,
                ah = this.JH.kW.length / jd.xE,
                RM = (ew + F7) * xE - F7,
                ug = (HH + oz) * ah - oz,
                j_ = (jd.DC - RM) / 2,
                yu = (jd.K2 - ug) / 2,
                sE = 1,
                m8 = 1;
            iX.E7(iP.yS, function(P2) {
                if (P2.sE && P2.sE > sE) {
                    sE = P2.sE
                }
            });
            sE = this.JH.sE || sE;
            this.zE = this.JH.kW.map(function(TW, Ey) {
                return [j_ + (Ey % xE) * (ew + F7) + nN / 2, yu + Math.floor(Ey / xE) * (HH + oz) + nN / 2, ew - nN, HH - nN]
            }, this);
            this.Ww = new Element("canvas", {
                width: this.JH.jd.DC * sE,
                height: this.JH.jd.K2 * sE,
                styles: {
                    width: this.JH.jd.DC,
                    height: this.JH.jd.K2
                }
            });
            this.Ww.getContext("2d").scale(sE / m8, sE / m8);
            this.mm = this.JH.wd.filter(function(Xr) {
                return Xr < XU.length
            }).map(function(Xr) {
                var jx = this.Ww.clone(),
                    F2 = jx.getContext("2d"),
                    Gx = 0;
                F2.scale(sE / m8, sE / m8);
                while (Gx++ < Xr) {
                    this.mQ(F2, this.XU[Gx])
                }
                return jx
            }, this);
            this.rZ(this.JH.hR);
            this.Ww.mI({
                position: "relative"
            });
            this.JH.k0.forEach(function(jx, Ey) {
                var TN = this[Ey];
                jx && jx.mI({
                    position: "absolute",
                    top: (TN.zC[0][1] - jx.firstElementChild.height / 2) + "px",
                    transform: hA.VK.Bq(TN.UG ? 1 : -1, 1)
                }) && jx.jl(TN.UG ? "left" : "right", (TN.Ia === void(0) ? -2 : TN.Ia) + "px")
            }, this.XU);
            this.mH.adopt(this.Ww, this.mm, this.JH.k0)
        },
        k5: function(Fw) {
            var F2 = this.Ww.getContext("2d");
            this.xC();
            Fw.forEach(function(YB) {
                this.mQ(F2, this.XU[YB.Cy], YB.Cy ? null : YB.X1)
            }, this);
            return this
        },
        xC: function() {
            var F2 = this.Ww.getContext("2d");
            F2.save();
            F2.setTransform(1, 0, 0, 1, 0, 0);
            F2.clearRect(0, 0, F2.canvas.width, F2.canvas.height);
            if (xH) {
                this.Ww.jl("opacity", 0.99);
                setTimeout(function() {
                    this.Ww.jl("opacity", 1)
                }.bind(this), 0)
            }
            F2.restore()
        },
        Vg: function(YB) {
            var Ey = YB.Cy,
                F2 = this.Ww.getContext("2d");
            this.xC();
            this.mQ(F2, this.XU[Ey], YB.X1, YB.fF);
            return this
        },
        eG: function(ex) {
            this.Ww.style.visibility = (ex ? "visible" : "");
            return this
        },
        yL: function(uT) {
            if (this.hR) {
                this.hR.style.visibility = uT ? "visible" : ""
            }
        },
        rZ: function(Mn, uT) {
            this.yL(0);
            this.hR = this.mm[this.JH.wd.indexOf(Mn)];
            this.JH.k0.forEach(function(pM, oH) {
                pM && (oH <= Mn ? pM.removeClass("H5") : pM.addClass("H5"))
            });
            this.yL(uT);
            return this
        },
        mQ: function(F2, Xj, X1, fF) {
            var JH = this.JH,
                Gx = 0,
                zC = Xj.zC;
            F2.lineCap = JH.rM;
            F2.lineJoin = JH.CX;
            if (zC && zC.length && JH.RZ) {
                F2.beginPath();
                F2.moveTo(zC[Gx][0], zC[Gx][1]);
                while (++Gx < zC.length) {
                    F2.lineTo(zC[Gx][0], zC[Gx][1])
                }
                F2.strokeStyle = JH.ww;
                F2.lineWidth = JH.CJ;
                F2.stroke();
                F2.strokeStyle = Xj.jY;
                F2.lineWidth = JH.aL;
                F2.stroke()
            }
            X1 && X1.forEach(function(P8) {
                var DG = this[P8];
                F2.clearRect(DG[0], DG[1], DG[2], DG[3]);
                F2.beginPath();
                F2.moveTo(DG[0], DG[1]);
                F2.lineTo(DG[0] + DG[2], DG[1]);
                F2.lineTo(DG[0] + DG[2], DG[1] + DG[3]);
                F2.lineTo(DG[0], DG[1] + DG[3]);
                F2.closePath();
                F2.globalCompositeOperation = "destination-over";
                F2.strokeStyle = JH.ww;
                F2.lineWidth = JH.CJ;
                F2.stroke();
                F2.beginPath();
                F2.moveTo(DG[0], DG[1]);
                F2.lineTo(DG[0] + DG[2], DG[1]);
                F2.lineTo(DG[0] + DG[2], DG[1] + DG[3]);
                F2.lineTo(DG[0], DG[1] + DG[3]);
                F2.closePath();
                F2.globalCompositeOperation = "source-over";
                F2.strokeStyle = Xj.jY;
                F2.lineWidth = JH.aL;
                F2.stroke()
            }, this.zE);
            fF && fF.forEach(function(P8) {
                var DG = this[P8];
                F2.beginPath();
                F2.moveTo(DG[0], DG[1] + DG[3] / 2);
                F2.lineTo(DG[0] + DG[2], DG[1] + DG[3] / 2);
                F2.stroke()
            }, this.zE)
        },
        Gw: function(XU) {
            var RN = function(zC) {
                    var Lj, Kz, e5, sX, X_ = 0;
                    while (++X_ < this.length / 2) {
                        Lj = this[X_ - 1];
                        Kz = this[X_];
                        e5 = this[X_ + 1];
                        if (Math.abs(Lj[1] - Kz[1]) < Cr) {
                            sX = e5[1] - Kz[1];
                            if (sX) {
                                Kz[0] += (e5[0] - Kz[0]) * (Lj[1] - Kz[1]) / sX
                            }
                            Kz[1] = Lj[1]
                        }
                    }
                    return this
                },
                jd = this.JH.jd,
                uc = this.JH.jd.uc || 0,
                ew = jd.tD,
                HH = jd.Q3,
                xE = jd.xE,
                ah = this.JH.kW.length / jd.xE,
                Cr = HH / 2,
                rx = ew / 2,
                F7 = jd.FE,
                oz = jd.N9,
                RM = (ew + F7) * xE - F7,
                ug = (HH + oz) * ah - oz,
                j_ = (jd.DC - RM) / 2,
                yu = (jd.K2 - ug) / 2,
                uh, hc;
            XU.forEach(function(uh) {
                var zC = uh.zC,
                    Yy, gH, nJ;
                if (zC) {
                    var Ia = (uh.Ia + 2 || 0);
                    zC[0] = [uh.UG ? Ia : jd.DC - Ia, zC[0] + yu];
                    zC[1] = [uh.UG ? jd.DC - j_ - uc : j_ + uc, zC[1] + yu];
                    Yy = zC.pop();
                    uh.X5.forEach(function(ov) {
                        gH = j_ + rx + ov % xE * (ew + F7);
                        nJ = yu + Cr + Math.floor(ov / xE) * (HH + oz) + uh.OM;
                        zC.push([gH, nJ])
                    });
                    if (uc !== 0) {
                        var gL = uc / (uh.UG ? Yy[0] - gH : gH - Yy[0]);
                        Yy[1] = Yy[1] - ((Yy[1] - nJ) * gL)
                    }
                    zC.push(Yy);
                    RN.call(zC).reverse();
                    RN.call(zC).reverse()
                }
            });
            return XU
        },
        J7: function(kR, hm, Nn, XC, AX) {
            var jd = this.JH.jd,
                xE = jd.xE,
                ah = jd.L2 || jd.ah,
                sE = 1,
                m8 = 1,
                r4 = hm * ah + 1,
                dj = kR * xE + 1,
                HF, LI, YK = 1,
                X8 = 0.5,
                Ag, F2;
            iX.E7(iP.yS, function(P2) {
                if (P2.sE && P2.sE > sE) {
                    sE = P2.sE
                }
            });
            sE = this.JH.sE || sE;
            Ag = new Element("canvas", {
                width: dj * sE,
                height: r4 * sE,
                styles: {
                    width: dj,
                    height: r4
                }
            });
            F2 = Ag.getContext("2d");
            F2.scale(sE / m8, sE / m8);
            F2.fillStyle = "#fff";
            F2.fillRect(1, 1, dj - 1, r4 - 1);
            F2.globalCompositeOperation = "source-over";
            F2.fillStyle = (AX) ? AX : (this.JH.Q4 === "") ? Nn.jY : this.JH.Q4;
            Nn.X5.forEach(function(B_) {
                LI = kR * Math.floor(B_ / xE);
                HF = hm * (B_ % xE), F2.fillRect(HF + 1, LI + 1, kR - 1, hm - 1)
            });
            F2.globalCompositeOperation = "source-over";
            F2.lineWidth = YK;
            F2.strokeStyle = "#000";
            F2.strokeRect(X8, X8, dj - YK, r4 - YK);
            F2.strokeStyle = "#444";
            F2.beginPath();
            for (HF = kR; HF < dj - 1; HF += kR) {
                F2.moveTo(HF + X8, YK);
                F2.lineTo(HF + X8, r4 - YK)
            }
            F2.stroke();
            F2.beginPath();
            for (LI = hm; LI < r4 - 1; LI += hm) {
                F2.moveTo(YK, LI + X8);
                F2.lineTo(dj - YK, LI + X8)
            }
            F2.stroke();
            return (new Element("div", {
                "class": "uQ"
            })).adopt(new Element("div", {
                "class": "xB",
                html: XC
            }), Ag)
        }
    })
})();
APITS = (function() {
    function playerProxy(soundPlayer, reply, sourceWindow) {
        var log = console.log.bind(console, sourceWindow.location.pathname);
        return Object.freeze({
            decode: function(id, arrayBuffer) {
                log("APITS decode", id);
                var reply = this;

                function success() {
                    reply("decoded", [id])
                }

                function failure(error) {
                    reply("error", [error.message])
                }
                soundPlayer.decode(id, arrayBuffer, success, failure)
            },
            play: function(id, options) {
                soundPlayer.play(id, options && options.loop, 1)
            },
            stop: function(id) {
                soundPlayer.stop(id)
            }
        })
    }
    return function(soundPlayer) {
        var log = console.log.bind(console, window.location.pathname);
        window.addEventListener("message", function(event) {
            if (event.origin !== window.location.origin) {
                log("APITS: ignore, not trusted", event.origin);
                return
            }
            if (event.data[0] !== "audio") {
                log("APITS: ignore, not for me ", event.data);
                return
            }
            log("APITS RX from ", event.source.location.pathname, event.data);
            var remoteFrame = event.source.location.pathname;
            var controlPort = event.ports[0];
            var reply = function(command, args) {
                log("APITS TX to ", event.source.location.pathname, [command, args]);
                controlPort.postMessage([command, args])
            };
            var player = playerProxy(soundPlayer, reply, event.source);
            controlPort.onmessage = function(event) {
                log("APITS RX from ", remoteFrame, event.data);
                var command = event.data[0];
                var args = event.data[1];
                player[command].apply(reply, args)
            };
            reply("format", [soundPlayer.format])
        })
    }
}());
var Kw = (function() {
    var sB = Object.freeze(function() {
        var sB = {};
        sB.kQ = {};
        (function() {
            window.AudioContext = window.AudioContext || window.webkitAudioContext;
            if (navigator.userAgent.indexOf("Chrome/11.") > -1 && navigator.userAgent.indexOf("Linux x86_64") > -1) {
                sB.kQ.NR = 0
            } else {
                if ((navigator.userAgent.indexOf("4.1.1") > -1 || navigator.userAgent.indexOf("4.1.2") > -1) && (navigator.userAgent.indexOf("GT-I9300") > -1 || navigator.userAgent.indexOf("GT-I9100") > -1)) {
                    sB.kQ.NR = 0
                } else {
                    window.AudioContext ? sB.kQ.NR = 1 : sB.kQ.NR = 0
                }
            }
        })();
        Object.freeze(sB.kQ);
        return Object.freeze(sB)
    })();
    xc = function(kI) {
        this.L0 += kI / 1000;
        if (this.L0 >= this.cE) {
            --this.Pq;
            this.L0 = this.tZ
        }
        if (this.Pq === 0) {
            this.XY = d9.iK(this.XY);
            this.L0 = this.tZ = this.cE = void 0;
            this.d2 && d2.call(this);
            IM(this, "GP", this.tZ)
        }
    }, d2 = function() {
        iX.gG(this, this.d2);
        this.oL(this.g2);
        delete this.d2
    }, IM = function(DK, lv, yb) {
        setTimeout(DK.fireEvent.bind.apply(DK.fireEvent, arguments), 0)
    };
    return new Class({
        Implements: Events,
        aE: function() {
            return 0
        },
        Zz: function(Uu, mj, uE) {
            uE = uE || 0;
            var Uu = this.fb[Uu];
            this.w7 = Uu;
            return this.Qp.apply(this, Uu.concat(mj, uE))
        },
        cc: function(Uu) {
            var Uu = this.fb[Uu];
            return this.Rr.apply(this, Uu)
        },
        mJ: function(Uu) {
            var Uu = this.fb[Uu];
            return this.yO.apply(this, Uu)
        },
        Tb: function(lv, zp) {
            return new Th(new QJ(this, lv, zp))
        },
        l1: function(Uu, mj, uE) {
            return this.Tb("mn").addEvent("QQ", this.cc.bind(this, Uu, mj, uE))
        },
        tb: function(Uu, mj, uE) {
            return this.Tb("eN").addEvent("QQ", this.Zz.bind(this, Uu, mj, uE))
        },
        QY: function(Uu, mj, uE) {
            return this.Tb("GP").addEvent("QQ", this.Zz.bind(this, Uu, mj, uE))
        },
        initialize: function(Vc, qS) {
            var ek = function() {
                    this.lK()
                },
                km = function() {
                    this.y9()
                },
                vt = function() {
                    this.bm()
                },
                Uy = function() {
                    if (document.hidden) {
                        this.lK()
                    } else {
                        this.y9()
                    }
                };
            window.addEventListener("pagehide", ek.bind(this), false);
            window.addEventListener("focusout", ek.bind(this), false);
            window.addEventListener("pageshow", km.bind(this), false);
            window.addEventListener("focusin", km.bind(this), false);
            window.addEventListener("focus", km.bind(this), false);
            window.addEventListener("beforeunload", vt.bind(this), false);
            window.addEventListener("unload", vt.bind(this), false);
            document.addEventListener("webkitvisibilitychange", Uy.bind(this), false);
            document.addEventListener("visibilitychange", Uy.bind(this), false);
            this.s9 = sB.kQ.NR && qS.kf > 0 ? Kw.bt(Vc) : Kw.Lv(Vc);
            this.fb = qS.p8 || []
        },
        JJ: function() {
            var soundPlayer = {
                play: function(id) {
                    console.warn("Attempting to play '" + id + "' in non-audio mode is not supported.")
                },
                decode: function(id, buffer, successCallback, failureCallback) {
                    successCallback()
                },
                stop: function(id) {
                    console.warn("Attempting to stop '" + id + "' in non-audio mode is not supported.")
                },
                format: null
            };
            return soundPlayer
        },
        Uq: function(zR) {
            this.d2 = zR;
            this.L0 || d2.call(this);
            var apitsModule = APITS(zR.JJ())
        },
        Qp: function(oe, Hh, mj) {
            this.XY = this.XY && d9.iK(this.XY);
            this.tZ = this.L0 = oe;
            this.cE = oe + Hh;
            this.Pq = mj || 1;
            this.XY = d9.nr(xc.bind(this), 100);
            IM(this, "eN", this.tZ);
            return this
        },
        Rr: function(oe) {
            IM(this, "mn", oe);
            return this
        },
        lK: function() {
            this.XY = this.XY && d9.iK(this.XY);
            IM(this, "vM");
            return this
        },
        bm: function() {
            this.XY = this.XY && d9.iK(this.XY);
            this.L0 = this.tZ = this.cE = void 0;
            IM(this, "H2");
            return this
        },
        WE: function() {
            this.bm()
        },
        yO: function(oe) {
            var Mr = this.tZ;
            return oe ? Mr === oe : Mr
        },
        y9: function(oe) {
            this.XY = this.L0 && d9.nr(xc.bind(this), 100);
            return this
        },
        oL: function(Xz) {
            this.g2 = !!Xz
        },
        ZK: function() {
            return this.g2
        }
    })
})();
Wx.Pj("audio/*", function(HE) {
    iP.N_ = new Kw("audio", {
        kf: this.kf,
        p8: this.p8
    });
    if (iP.N_.s9) {
        var cR = L6.nS(new L6({
                Vs: "cR",
                vL: "Eo kJ"
            })),
            qX = function(cR) {
                cR.ex(0);
                cR.jx.destroy();
                iP.N_.addEvents({
                    load: this.T7,
                    error: this.bR,
                    abort: this.bR
                }).s9("audio", this.hW.split(",").map(function(Vc) {
                    var a = document.createElement("a");
                    a.href = HE + this.lX + "&Accept=" + Vc;
                    a.protocol = "http";
                    return {
                        type: Vc,
                        src: a.href
                    }
                }, this), this.ks && iX.WD(this.ks, function(Ey, ef) {
                    var a = document.createElement("a");
                    a.href = HE + this.lX + "&Accept=" + tJ(this.hW);
                    a.protocol = window.location.protocol;
                    a.pathname = a.pathname + "/" + this.ks[ef];
                    var CQ = a.href;
                    return CQ
                }, this))
            },
            wI = function(cR) {
                cR.jx.destroy();
                iP.N_.Uq(iP.N_);
                this.T7()
            },
            tJ = function(hW) {
                var Rx = new Audio();
                var X6 = hW.split(",");
                var gN = {};
                var i = X6.length;
                while (--i >= 0) {
                    gN[Rx.canPlayType(X6[i])] = X6[i]
                }
                return gN.probably || gN.maybe || void 0
            };
        cR.Pz({
            i1: new eT({
                SK: Ki("audioLoader.yes"),
                Xl: 1
            }),
            LC: new eT({
                SK: Ki("audioLoader.no"),
                Xl: 1
            })
        }).addEvents({
            i1: qX.bind(this, cR),
            LC: wI.bind(this, cR)
        }).Qo(Ki("audioLoader.confirm"));
        document.body.adopt(cR);
        cR.ex(1)
    } else {
        this.T7()
    }
});
Kw.Lv = (function() {
    var ZN = function(Kx, V3) {
            return (Kx - V3) * (Kx - V3) < 0.00001
        },
        wE = function() {
            if (this.Hp) {
                this.gf = this.Hp;
                this.Hp = void 0;
                this.fireEvent("mn", this.gf);
                this.gf === this.Vf && FA.call(this)
            }
        },
        Tn = function() {
            if (this.tZ && this.jx.currentTime >= this.cE) {
                if (--this.Pq) {
                    this.Qp(this.tZ, this.cE - this.tZ, this.Pq)
                } else {
                    this.xK = this.tZ;
                    this.jx.pause()
                }
                this.tZ = void 0
            } else {
                if (!this.cE) {
                    this.jx.currentTime = this.Hp || 0;
                    this.jx.pause()
                }
            }
        },
        R1 = function() {
            if (this.xK) {
                this.cE = this.Hp = this.gf = this.Vf = this.Pq = this.tZ = void 0;
                this.fireEvent("GP", this.xK);
                this.xK = void 0
            } else {
                if (this.tZ) {
                    this.fireEvent("vM")
                }
            }
        },
        FA = function() {
            if (this.gf === this.Vf) {
                this.tZ = this.Vf;
                this.Hp = this.gf = this.Vf = void 0;
                this.fireEvent("eN", this.tZ);
                this.jx.play()
            }
        },
        xU = {
            aE: function() {
                return 0
            },
            JJ: function() {
                var soundPlayer = {
                    play: function(id) {
                        console.warn("Attempting to play '" + id + "' in single channel mode is not supported.")
                    },
                    stop: function(id) {
                        console.warn("Attempting to stop '" + id + "' in single channel mode is not supported.")
                    },
                    decode: function(id, buffer, successCallback, failureCallback) {
                        successCallback()
                    },
                    format: null
                };
                return soundPlayer
            },
            Qp: function(oe, Hh, mj, uE) {
                uE = uE || 0;
                if (uE == 0) {
                    this.Pq = mj || 1;
                    this.Vf = oe;
                    this.cE = oe + Hh;
                    this.gf === oe && FA.call(this, this.cE);
                    this.Hp === oe || this.Rr(oe)
                } else {}
                return this
            },
            Rr: function(oe) {
                if (this.Hp !== oe) {
                    this.jx.currentTime = this.Hp = oe
                }
                return this
            },
            lK: function() {
                this.jx.pause();
                return this
            },
            bm: function(Vs) {
                if (!Vs) {
                    this.jx.pause();
                    this.cE = this.Hp = this.gf = this.Vf = this.Pq = this.tZ = void 0
                } else {}
                return this
            },
            WE: function() {
                this.bm()
            },
            y9: function() {
                this.yO() && this.jx.play();
                return this
            },
            yO: function(oe) {
                var Mr = this.Vf || this.tZ;
                return oe ? Mr === oe : Mr
            },
            oL: function(Xz) {
                this.jx.muted = !!Xz
            },
            ZK: function() {
                return this.jx.muted
            }
        },
        fV = function(Vc, UP) {
            var jx, Dj, sG, bJ = function() {
                    this.fireEvent("load")
                }.bind(this),
                hB = function() {
                    this.fireEvent("load")
                }.bind(this),
                uM = function() {
                    WM.call(this)
                }.bind(this),
                mW = function() {
                    Dj && clearTimeout(Dj);
                    Dj = setTimeout(this.fireEvent.bind(this, "load"), 20000)
                }.bind(this),
                WM = function() {
                    Dj && clearTimeout(Dj);
                    this.jx.removeEventListener("progress", mW, true);
                    this.jx.removeEventListener("error", bJ, true);
                    this.jx.removeEventListener("abort", hB, true);
                    this.jx.removeEventListener("canplaythrough", uM, true);
                    mW = bJ = hB = WM = void 0;
                    this.Uq(xU);
                    this.fireEvent("load")
                };
            jx = new Element(Vc);
            jx.addEventListener("seeked", wE.bind(this));
            jx.addEventListener("ended", R1.bind(this));
            jx.addEventListener("pause", R1.bind(this));
            jx.addEventListener("timeupdate", Tn.bind(this));
            jx.addEventListener("canplaythrough", uM, true);
            jx.addEventListener("error", bJ, true);
            jx.addEventListener("abort", hB, true);
            jx.addEventListener("progress", mW, true);
            this.jx = jx;
            this.jx.preload = "none";
            this.jx.adopt(UP.map(function(cf) {
                return new Element("source", cf)
            }));
            if (N8.Aq === "Lm" && N8.sc >= 8) {
                this.jx.play()
            } else {
                this.jx.load()
            }
            this.jx.preload = "auto";
            Dj = setTimeout(this.fireEvent.bind(this, "load"), 20000);
            return this
        };
    return function(Vc) {
        var r3 = !(N8.Aq == "p5" && N8.sc < 2.3) && !(N8.Aq == "Lm" && N8.sc < 4) && document.createElement(Vc).play;
        return r3 && fV
    }
})();
Kw.bt = (function() {
    var ZN = function(Kx, V3) {
            return (Kx - V3) * (Kx - V3) < 0.00001
        },
        jf = [],
        cf, Ck = [],
        S6 = [],
        zK = null,
        R1 = function() {
            if (this.xK) {
                this.cE = this.Hp = this.gf = this.Vf = this.Pq = this.tZ = void 0;
                this.fireEvent("GP", this.xK);
                this.xK = void 0
            } else {
                if (this.tZ) {
                    this.fireEvent("vM")
                }
            }
        },
        FA = function() {
            if (this.gf === this.Vf) {
                this.tZ = this.Vf;
                this.Hp = this.gf = this.Vf = void 0;
                this.fireEvent("eN", this.tZ);
                this.jx.play()
            }
        },
        oT = function(sL) {
            for (var i in S6) {
                if (S6[i].uE == sL && S6[i].uE != undefined) {
                    xU.bm(S6[i].bX)
                }
            }
        },
        zN = function() {
            for (var i in S6) {
                if (S6[i].bX != undefined) {
                    xU.bm(S6[i].bX)
                }
            }
        },
        xU = {
            aE: function() {
                return 1
            },
            JJ: function() {
                var soundPlayer = {
                    play: function(id, loop, channel) {
                        xU.Qp(id, loop, channel)
                    },
                    stop: function(id) {
                        xU.bm(id)
                    },
                    createTrack: function() {
                        return {
                            schedule: function schedule() {}
                        }
                    },
                    decode: function(id, buffer, successCallback, failureCallback) {
                        zK.decodeAudioData(buffer, function(iA) {
                            jf[id] = iA;
                            successCallback()
                        }, function() {
                            failureCallback(new Error('Failed to decode buffer for sound "' + id + '"'))
                        })
                    },
                    format: "audio/mpeg"
                };
                return soundPlayer
            },
            Zz: function(Uu, mj, uE) {
                uE = uE || 0;
                this.w7 = Uu;
                return this.Qp.call(this, Uu, mj, uE)
            },
            Qp: function(oe, mj, uE) {
                cf = zK.createBufferSource();
                cf.buffer = jf[oe];
                cf.loop = mj > 1 ? true : false;
                var fM = {
                    cf: cf,
                    bX: oe,
                    uE: uE
                };
                if (uE == 0) {
                    oT(uE)
                } else {
                    this.bm(oe)
                }
                S6[oe] = fM;
                cf.connect(Ck.master);
                (typeof cf.start === "undefined") ? cf.noteGrainOn(0, 0, cf.buffer.duration): cf.start(0);
                return this
            },
            Rr: function(oe) {
                return this
            },
            lK: function() {
                Ck.master.gain.value = 0;
                return this
            },
            bm: function(eK) {
                if (S6[eK]) {
                    if (navigator.userAgent.indexOf("like Mac OS X") >= 0 && navigator.userAgent.indexOf("6_") >= 0) {
                        if (S6[eK].cf.playbackState == cf.PLAYING_STATE || S6[eK].cf.playbackState == cf.SCHEDULED_STATE) {
                            S6[eK].cf.noteOff(0)
                        }
                    } else {
                        if (S6[eK].cf.playbackState == cf.PLAYING_STATE || S6[eK].cf.playbackState == cf.SCHEDULED_STATE) {
                            S6[eK].cf.stop(0)
                        }
                    }
                    delete S6[eK]
                }
                this.cE = this.Hp = this.gf = this.Vf = this.Pq = this.tZ = void 0;
                return this
            },
            WE: function() {
                zN()
            },
            y9: function() {
                Ck.master.gain.value = 1;
                this.yO();
                return this
            },
            yO: function(oe) {
                if (S6[oe] && S6[oe].cf.playbackState == cf.PLAYING_STATE) {
                    return true
                }
                return false
            },
            mJ: function(Uu) {
                return this.yO.call(this, Uu)
            },
            oL: function(Xz) {},
            ZK: function() {
                return false
            }
        },
        fV = function(Vc, UP, p8) {
            var jx, Dj, sG, bJ = function(e) {
                    this.fireEvent("error")
                }.bind(this),
                Cq = function() {
                    if (Object.keys(jf).length >= Object.keys(p8).length) {
                        Dj = setTimeout(this.fireEvent.bind(this, "load"), 1)
                    }
                }.bind(this),
                hB = function(e) {
                    this.fireEvent("abort")
                }.bind(this),
                uM = function() {
                    WM.call(this)
                }.bind(this),
                mW = function() {}.bind(this),
                WM = function() {
                    Dj && clearTimeout(Dj);
                    this.jx.removeEventListener("progress", mW, true);
                    this.jx.removeEventListener("error", bJ, true);
                    this.jx.removeEventListener("abort", hB, true);
                    this.jx.removeEventListener("canplaythrough", uM, true);
                    mW = bJ = hB = WM = void 0;
                    this.Uq(xU);
                    this.fireEvent("load")
                };
            for (var CQ in p8) {
                if (p8.hasOwnProperty(CQ)) {
                    GF(CQ, p8, Cq, hB)
                }
            }
            zK = new window.AudioContext();
            cf = zK.createBufferSource();
            cf.connect(zK.destination);
            Ck = {
                destination: zK.destination,
                master: (typeof zK.createGain === "undefined") ? zK.createGainNode() : zK.createGain(),
                music: (typeof zK.createGain === "undefined") ? zK.createGainNode() : zK.createGain(),
                fx: (typeof zK.createGain === "undefined") ? zK.createGainNode() : zK.createGain()
            };
            Ck.master.connect(Ck.destination);
            Ck.music.connect(Ck.master);
            Ck.fx.connect(Ck.master);
            (typeof cf.start === "undefined") ? cf.noteGrainOn(0, 0, 0): cf.start(0);
            this.Uq(xU);
            return this
        },
        GF = function(CQ, p8, m6, x0) {
            var sD = new XMLHttpRequest();
            sD.onload = function(e) {
                zK.decodeAudioData(e.target.response, function(iA) {
                    jf[CQ] = iA;
                    m6.apply()
                }, function() {
                    x0.apply()
                })
            }.bind(this);
            sD.onerror = function(e) {
                x0.apply(e)
            };
            sD.open("GET", p8[CQ], true);
            sD.responseType = "arraybuffer";
            sD.send()
        };
    return function(Vc) {
        var r3 = !(N8.Aq == "p5" && N8.sc < 2.3) && !(N8.Aq == "Lm" && N8.sc < 4) && document.createElement(Vc).play;
        return r3 && fV
    }
})();
(function() {
    var xd = {},
        Gd = {};
    PrefixFree.properties.forEach(function(a8) {
        xd[StyleFix.camelCase(a8)] = StyleFix.camelCase(PrefixFree.prefixProperty(a8));
        Gd[a8] = PrefixFree.prefixProperty(a8)
    });
    Element.implement({
        jl: function(vK, I_) {
            this.style[xd[vK] || vK] = PrefixFree.value(I_.toString(), vK);
            return this
        },
        vf: function(vK, I_) {
            return this.style[xd[vK] || vK]
        },
        mI: function(b5) {
            var vK;
            for (vK in b5) {
                this.jl(vK, b5[vK])
            }
            return this
        },
        Hs: function() {
            return new Of(this)
        }
    });
    N8.Rl = function(vK) {
        return xd[vK] || vK
    };
    N8.pk = function(a8) {
        return Gd[a8] || a8
    }
})();
var vF = new Class({
    Extends: L6,
    initialize: function() {
        this.parent.apply(this, arguments);
        this.Rb = (new Element("div", {
            "class": "vv"
        })).inject(this)
    },
    Qb: function() {
        this.parent();
        this.Mm(0)
    },
    vb: function(A_, sj) {
        A_.Buttons.forEach(function(YN, jG) {
            this.Bs("choice" + jG, new eT({
                vL: A_.Buttons.length > 1 ? "" : "wq",
                SK: A_.Buttons.length > 1 ? YN.Text : "",
                Xl: 1
            })).U7("choice" + jG, function() {
                this.Qb();
                sj(A_.Buttons[jG].Cmd)
            })
        }.bind(this));
        this.Rb.set("text", A_.Reference ? Ki("mproxy.Error.RGSid") + A_.Reference : "");
        return this.Qo(new Element("p", {
            text: A_.Message
        }), A_.SupportInfo && (new Element("p", {
            text: A_.SupportInfo.Message
        })).adopt(new Element("address", {
            text: [A_.SupportInfo.PhoneNumber, A_.SupportInfo.Email].join("\n")
        })))
    }
});
var CP = new Class({
    Extends: Request,
    options: {
        nL: 10000
    },
    initialize: function(dp) {
        this.parent(dp);
        delete this.headers["X-Requested-With"]
    },
    send: function() {
        var k3 = navigator.onLine;
        this.options.nL && setTimeout(this.cancel.bind(this), this.options.nL);
        k3 === false ? this.fireEvent("offline") : this.parent()
    }
});
var ts = (function() {
    var vx = function() {
            if (0 >= --this.dn) {
                this.fireEvent("IJ");
                this.fireEvent("ZO", this.gC.status)
            } else {
                this.gC.send()
            }
        },
        BG = function() {
            this.fireEvent("Cn")
        },
        Cq = function(lT) {
            var Fq, hH, vy, lT;
            try {
                lT = JSON.parse(lT)
            } catch (e) {
                return this.fireEvent("Cb")
            }
            Fq = lT.ReturnStatus;
            if (Fq.Code != 1000000) {
                this.fireEvent("fH", Fq)
            } else {
                if (lT.Authentication && lT.Authentication.Status == "Pending") {
                    ++this.dn;
                    setTimeout(this.send.bind(this), this.ND *= 1.5)
                } else {
                    this.fireEvent("K9", lT)
                }
            }
        },
        R9 = function() {
            this.fireEvent("IJ")
        };
    return new Class({
        Implements: Events,
        initialize: function(yb) {
            this.dn = yb.dn || 0;
            this.ND = yb.ND || 1000;
            this.gC = new CP({
                url: yb.CQ,
                data: yb.iA,
                method: yb.xw || "post",
                async: yb.Uf ? 0 : 1,
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json; charset=utf8"
                },
                urlEncoded: 0,
                nL: yb.nL
            });
            this.gC.addEvents({
                failure: yb.vx || vx.bind(this),
                cancel: yb.vx || vx.bind(this),
                success: yb.Cq || Cq.bind(this),
                complete: yb.R9 || R9.bind(this),
                offline: yb.BG || BG.bind(this)
            })
        },
        send: function() {
            this.gC.send()
        },
        complete: function() {
            this.parent.apply(this, arguments)
        }
    })
})();
var Ly = (function() {
    return new Class({
        Implements: [NL, Events],
        JH: {
            qS: {
                requestTimeout: 10000,
                requestRetries: 0
            },
            qx: function(AO) {},
            tX: function(AO) {},
            nz: function(cD) {},
            dB: function(lT) {
                debugConsol.assert(0)
            },
            iO: function(hH) {},
            EW: function() {}
        },
        Z1: 0,
        initialize: function(JH) {
            this.O0(JH)
        },
        AO: function(yb) {
            yb.CQ = this.JH.qS.proxyUrl.concat(yb.UQ);
            yb.nL = this.JH.qS.requestTimeout || 0;
            yb.dn = this.JH.qS.requestRetries || 0;
            if (yb.b_) {
                yb.vx = yb.dX = yb.Cq = yb.R9 = yb.BG = function() {}
            }
            var gC = (new ts(yb)).addEvents({
                Cn: yb.qx || this.JH.qx,
                ZO: yb.tX || this.JH.tX,
                fH: yb.nz || this.JH.nz,
                K9: yb.dB || this.JH.dB,
                Cb: yb.iO || this.JH.iO,
                xm: yb.EW || this.JH.EW
            });
            return gC
        }
    })
})();
Ly.tL = {
    qh: function(yk) {
        return parseFloat(yk) || 0
    },
    q5: function(yk) {
        return parseInt(yk, 10) || 0
    },
    B4: function(yk) {
        return yk.split(",")
    },
    eS: function(yk) {
        return new Date(yk.substr(0, 4), yk.substr(4, 2), yk.substr(6, 2), yk.substr(8, 2), yk.substr(10, 2))
    },
    Mi: function(MS, bX) {
        var Y7 = {},
            TW, Ey = MS.length;
        bX = bX || "@name";
        while (--Ey >= 0) {
            TW = MS[Ey];
            Y7[TW[bX]] = TW;
            delete TW[bX]
        }
        return Y7
    }
};
var zz = function(Aj, qS) {
    qS.enableHighAccuracy = qS.enableHighAccuracy == "true";
    qS.maximumAge = qS.maximumAge || 300000;
    qS.timeout = qS.timeout || 600000;
    "geolocation" in navigator ? navigator.geolocation.getCurrentPosition(Aj, Aj, qS) : Aj({
        message: "Device does not support navigator.geolocation",
        code: -1
    })
};
var J2 = new Class({
    initialize: function() {}
});
var DP = (function() {
    var aS, qS, wt, My, gQ, wo, Ae, zJ = (function() {
            var Yv, dz = {
                    closeGame: function() {
                        wo && wo.AO({
                            UQ: "/close.action",
                            iA: JSON.stringify(My.params),
                            vx: cs,
                            dX: cs,
                            Cq: cs,
                            BG: cs
                        }).send()
                    },
                    requestMobileNumber: function() {
                        oQ()
                    },
                    getGeoCoordinates: function() {
                        zz(nQ, qS.geoLocation)
                    },
                    insufficientFundsNotification: function() {
                        Jf.lu()
                    }
                },
                NN = {
                    closeGame: function() {
                        rG = 1;
                        if (window.opener) {
                            window.close()
                        } else {
                            window.location = qS.console.lobbyURL
                        }
                    },
                    reloadGame: function() {
                        rG = 1;
                        if (My.params.mac) {
                            window.location = qS.console.lobbyURL
                        } else {
                            iP.Rt()
                        }
                    },
                    switchToCashPlay: function() {
                        iP.Rt({
                            playMode: "real"
                        })
                    },
                    gameInProgressReload: function() {
                        rG = 1;
                        iP.Rt(Yv.Param)
                    },
                    "": function() {
                        Jf.Ma()
                    }
                };

            function cs() {
                Jf.cs(Yv)
            }
            return {
                j4: function(jO) {
                    dz[""] = jO && function() {
                        dz[""] = void 0;
                        jO()
                    }
                },
                lI: function(yg) {
                    var tk = yg["@name"],
                        Fj = {};
                    Yv = yg;
                    yg.Param && Array.CZ(yg.Param).forEach(function(X_) {
                        Fj[X_["@name"]] = X_["#text"]
                    });
                    yg.Param = Fj;
                    (dz[tk] || cs)()
                },
                JG: function(tk, Fj) {
                    var jO = NN[tk];
                    jO ? jO(Fj) : console.warn("No default handler for " + tk)
                }
            }
        })(),
        AG = function(A_) {
            Ae.DJ || Ae.r2();
            A_.Reference = "";
            A_.Buttons = Array.CZ(A_.Buttons.Button);
            Jf.lR(A_)
        },
        G1 = function(A_) {
            iP.N_ && iP.N_.bm();
            Ae.DJ || Ae.KC();
            A_.Buttons = Array.CZ(A_.Buttons.Button);
            Jf.lR(A_)
        },
        pQ, LU, fB, ux, SO = function(lT) {
            LU = lT.GameLogicResponse;
            if (!fB) {
                fB = Date.now()
            }
            pQ = LU.OutcomeDetail.TransactionId;
            var WR = 0;
            if (wt && wt.transactiondelay && wt.gameType && wt.gameType.toUpperCase() == "S") {
                WR = wt.transactiondelay ? wt.transactiondelay * 1000 : 0;
                WR = Math.max(0, WR - (Date.now() - ux))
            }
            setTimeout(function() {
                LU.OutcomeDetail.Balance = ro.rQ(LU.OutcomeDetail.Balance);
                LU.Messages = LU.Messages || [];
                if (LU.Messages.Message) {
                    LU.Messages = Array.CZ(LU.Messages.Message)
                }
                QS()
            }, WR)
        },
        QS = function() {
            var A_ = LU.Messages && LU.Messages.shift();
            Ae.LU = LU;
            if (A_) {
                zJ.j4(QS);
                AG(A_)
            } else {
                Ae.vR()
            }
        },
        qx = function() {
            return G1({
                Message: Ki("mproxy.Error.networkOffLine"),
                Buttons: {
                    Button: {
                        Text: Ki("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": ""
                        }
                    }
                }
            })
        },
        tX = function(Fq) {
            return G1({
                Message: Ki(Fq ? "mproxy.Error.networkError" : "mproxy.Error.connectionLost"),
                Reference: Fq ? "MGC-002-" + Fq : "MGC-001",
                Buttons: {
                    Button: {
                        Text: Ki("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": Fq ? "closeGame" : "reloadGame"
                        }
                    }
                }
            })
        },
        iO = function(AO) {
            return G1({
                Message: Ki("mproxy.Error.payloadError"),
                Reference: "MGC-003",
                Buttons: {
                    Button: {
                        Text: Ki("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": "closeGame"
                        }
                    }
                }
            })
        },
        nz = function(x0) {
            var ic = x0.AdditionalInfo || {};
            ic.Action = ic.Action || "";
            ic.Buttons = ic.Buttons ? ic.Buttons.split(",").map(function(x4) {
                return Ki("mproxy.Buttons." + x4)
            }) : [Ki("mproxy.Buttons.OK")];
            return G1({
                Message: x0.Message,
                Reference: x0.Code,
                Buttons: {
                    Button: ic.Action.split(",").map(function(tk, Ey) {
                        return {
                            Text: ic.Buttons[Ey] || tk,
                            Cmd: {
                                "@name": tk || "closeGame"
                            }
                        }
                    })
                }
            })
        },
        kH = function(x0) {
            return AG({
                Message: Ki("mproxy.CancelSubmitMobileNumber.message"),
                Buttons: {
                    Button: {
                        Text: Ki("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": "closeGame"
                        }
                    }
                }
            })
        },
        dB = function(lT) {
            var hH = lT.Exception;
            return hH ? this.fireEvent("pA", hH) : this.fireEvent("JV", lT)
        },
        vt = function() {
            var ox = 0,
                dC = function() {};
            return function() {
                if (!ox) {
                    ox = 1;
                    document.body.style.display = "none";
                    wo && wo.AO({
                        Uf: 1,
                        UQ: "/close.action",
                        iA: JSON.stringify(My.params),
                        b_: 1
                    }).send()
                }
            }
        },
        nQ = function(Uh) {
            var Xi = {};
            if (Uh.coords) {
                Xi.latitude = Uh.coords.latitude.toString();
                Xi.longitude = Uh.coords.longitude.toString()
            }
            Xi.locationstatus = (Uh.code || 0).toString();
            Xi.locationmessage = Uh.message || "";
            GA(Xi)
        },
        initResponse, JL = function(vm) {
            function aN(lT) {
                var wr = vt();
                window.addEvents({
                    beforeunload: wr,
                    unload: wr
                });
                uW = lT;
                ro.Vr(uW.CURRENCY, My.params.denomamount);
                uW.GameLogicResponse.OutcomeDetail.Balance = ro.rQ(uW.GameLogicResponse.OutcomeDetail.Balance);
                Jf.GV(uW.CURRENCY, uW.GameLogicResponse)
            }
            var Fj = iX.gG({
                getplayerbalance: (!!vm).toString()
            }, My.params);
            zJ.j4(JL);
            wo.AO({
                UQ: "/initstate.action",
                iA: JSON.stringify(Fj)
            }).addEvents({
                JV: aN,
                pA: G1
            }).send()
        },
        GA = (function() {
            var sf = {
                requestMobileNumber: function(x0) {
                    oQ(x0)
                },
                initGeoCoordinates: function(x0) {
                    uu(x0)
                }
            };
            return function(Lb) {
                function Ke(cD) {
                    var jO = cD.AdditionalInfo && sf[cD.AdditionalInfo.Action] || nz;
                    jO(cD)
                }

                function IO(lT) {
                    var wr = vt();
                    window.addEvents({
                        beforeunload: wr,
                        unload: wr
                    });
                    Jf.oW()
                }
                gQ = gQ || DS(iX.qU(My.params, ["uniqueid", "nscode", "skincode", "softwareid"]));
                Lb = iX.gG(Lb || {}, My.params);
                zJ.j4(GA);
                wo.AO({
                    UQ: "/authenticate.action",
                    iA: JSON.stringify(Lb),
                    nz: Ke
                }).addEvents({
                    JV: IO,
                    pA: G1
                }).send()
            }
        })(),
        Bc = function() {
            function pX(Bd, SL, rk) {
                if (SL && 0 > rk.indexOf(SL)) {
                    this.Nb(Bd)
                } else {
                    this.Or(Bd)
                }
            }

            function Sn(PG, PF) {
                var Bd = this.uS(),
                    G0 = Bd.PatternsBet;
                Bd.PatternsBet = PG;
                pX.call(this, Bd, G0, PF)
            }

            function i_(xe, Pw) {
                var Bd = this.uS(),
                    Fp = Bd.BetPerPattern && Bd.BetPerPattern[ro] || 0;
                Bd.BetPerPattern = Bd.BetPerPattern || {};
                Bd.BetPerPattern[ro] = ro.K7(xe);
                pX.call(this, Bd, ro.rQ(Fp).toString(), Pw)
            }
            pQ = uW.GameLogicResponse.OutcomeDetail.TransactionId;
            Ae.Tw(Ae.UY = uW.Paytable);
            Ae.JC(LU = Ae.LU = uW.GameLogicResponse);
            Ae.ZT(Ae.LU);
            uW = void 0;
            if (Ae.LU.PatternSliderInput) {
                if (Ae.LU.PatternSliderInput.PatternsBet) {
                    Sn.call(gQ, Ae.LU.PatternSliderInput.PatternsBet, Ae.UY.PatternSliderInfo.PatternInfo.Step)
                }
                if (Ae.LU.PatternSliderInput.BetPerPattern) {
                    i_.call(gQ, Ae.LU.PatternSliderInput.BetPerPattern, Ae.UY.PatternSliderInfo.BetInfo.Step)
                }
            }
            WI.dQ("progress")
        },
        oQ = (function() {
            var oS, u9;
            return function(x0) {
                var Bd = gQ.uS(),
                    KL = x0.Message || [
                        ["", ""]
                    ];
                u9 = u9 || (new Element("form")).adopt(KL.length > 1 ? (new Element("select", {
                    name: "wN"
                })).adopt(KL.length > 1 && new Element("option", {
                    value: "",
                    text: Ki("mproxy.SubmitMobileNumber.labelRegionCode")
                }), KL.map(function(aP) {
                    return new Element("option", {
                        value: aP[0],
                        text: aP[1]
                    })
                })) : new Element("input", {
                    type: "hidden",
                    name: "wN",
                    value: KL[0][0]
                }), (new Element("label", {
                    text: Ki("mproxy.SubmitMobileNumber.labelDeviceNumber")
                })).adopt(new Element("input", {
                    type: "tel",
                    style: "-wap-input-format: '*N';",
                    name: "WW"
                }))).addEvent("submit", function() {
                    var WW = this.elements.WW.value,
                        wN = this.elements.wN.value,
                        Bd = gQ.uS();
                    Bd.deviceNumber = WW;
                    Bd.regionCode = wN;
                    gQ.Nb(Bd);
                    window.event && window.event.preventDefault();
                    if (WW && (wN || KL.length == 0)) {
                        oS.zM(0);
                        wo.AO({
                            xw: "get",
                            UQ: "/subdnbr.action",
                            iA: {
                                devicenumber: WW,
                                regioncode: wN
                            }
                        }).addEvents({
                            JV: function(lT) {
                                delete lT.ReturnStatus.Code;
                                nz(lT.ReturnStatus)
                            },
                            IJ: function() {
                                oS.ex(0)
                            }
                        }).send()
                    }
                });
                oS = oS || L6.nS(new L6({
                    Vs: "oS",
                    vL: "kJ Eo"
                }).addEvents({
                    wR: u9.fireEvent.bind(u9, "submit"),
                    LC: function() {
                        oS.ex(0);
                        kH()
                    }
                }).Pz({
                    LC: new eT({
                        SK: Ki("mproxy.SubmitMobileNumber.buttonCancel"),
                        Xl: 1
                    }),
                    wR: new eT({
                        SK: Ki("mproxy.SubmitMobileNumber.buttonValidate"),
                        Xl: 1
                    })
                }).Qo(new Element("h1", {
                    text: Ki("mproxy.SubmitMobileNumber.title")
                }), new Element("p", {
                    text: Ki("mproxy.SubmitMobileNumber.message")
                }), u9));
                document.body.grab(oS, "top");
                u9.elements.WW.value = Bd.deviceNumber || "";
                u9.focus();
                if (KL.length > 1) {
                    u9.elements.wN.value = Bd.regionCode || ""
                }
                return oS.zM(1).ex(1)
            }
        })(),
        uu = function(x0) {
            var RV = RV || L6.nS(new L6({
                Vs: "mP",
                vL: "kJ Eo"
            })).Qo(x0.Message).Pz({
                LC: new eT({
                    SK: Ki("Game.buttonOk"),
                    Xl: 1
                })
            }).addEvents({
                LC: function() {
                    RV.toElement().destroy();
                    RV = void 0
                }
            }).addEvents({
                LC: function() {
                    zz(nQ, qS.geoLocation)
                }
            }).ex(1);
            document.body.grab(RV, "top")
        },
        Gk = function() {
            if (My.params.mac) {
                wo.AO({
                    xw: "get",
                    UQ: "/valdnbr.action",
                    iA: {
                        mac: My.params.mac
                    },
                    dB: function(lT) {
                        My.params = lT.ReturnData;
                        GA()
                    }
                }).send()
            } else {
                GA()
            }
        },
        lS = function(iA) {
            var WR = 0;
            if (LU.OutcomeDetail.GameStatus && (LU.OutcomeDetail.GameStatus == "Start") && wt.transactiondelay) {
                if (fB) {
                    WR = Math.max(0, (wt.transactiondelay * 1000) - (Date.now() - fB))
                }
                fB = 0;
                ux = Date.now()
            }
            if (WR) {
                setTimeout(function() {
                    Rf(iA)
                }, WR)
            } else {
                Rf(iA)
            }
        },
        Rf = (function() {
            var UQ;
            return function(iA) {
                UQ = UQ || "/play.action".concat(iX.MR(My.params, ["language", "presenttype", "channel", "freespin_tokenID", "freespin_bet", "freespin_lines", "freespin_num", "playMode"]));
                iA.GameLogicRequest.TransactionId = pQ;
                zJ.j4();
                wo.AO({
                    UQ: UQ,
                    iA: JSON.stringify(iA)
                }).addEvents({
                    JV: SO,
                    pA: G1
                }).send()
            }
        })(),
        Ip = (function() {
            var UQ;
            return function(XS, iA) {
                UQ = UQ || "/paytable.action".concat(iX.MR(My.params, ["language", "presenttype", "channel"]));
                zJ.j4();
                wo.AO({
                    xw: "get",
                    UQ: UQ,
                    iA: JSON.stringify(iA)
                }).addEvents({
                    JV: XS,
                    pA: G1
                }).send()
            }
        })(),
        rG, Jf = (function() {
            var yZ, PO, Ze = {},
                dV;

            function q7() {
                Ae.JC(Ae.LU);
                Ae.qM()
            }
            return {
                Oo: function(qS, My) {
                    var fS, A6 = +new Date;
                    yZ = document.createElement("iframe");
                    PO = document.createElement("div");
                    PO.id = "Jf";
                    PO.appendChild(yZ);
                    document.body.insertBefore(PO, document.body.lastElementChild);
                    WI.dQ("queue", 1);
                    com.igt.mxf.setMessageOrigin(yZ.contentWindow, qS.url).addOneShotEvent("consoleInitialised", function(qS) {
                        clearTimeout(fS);
                        console.warn("Console loaded after " + (Math.round((A6 - new Date) / 10) / 100) + "s");
                        if (qS) {
                            My.Fj = iX.gG(My.params, qS)
                        }
                        WI.dQ("progress", 1);
                        WI.dQ("console")
                    }).addEvents({
                        consoleResize: function(K2) {
                            if (PO.style.height != K2) {
                                PO.style.visibility = "visible";
                                PO.style.height = K2;
                                document.body.offsetWidth;
                                Ty()
                            }
                            com.igt.mxf.sendMessage("consoleResized", K2)
                        },
                        command: function(tk, Fj) {
                            zJ.JG(tk, Fj)
                        }
                    });
                    fS = setTimeout(function() {
                        WI.gB(window.parent, "loaderror")
                    }, qS.timeout || 15000);
                    (function(CQ) {
                        var a = document.createElement("a");
                        a.setAttribute("href", CQ);
                        yZ.src = a.href + (a.search ? "&" : "?") + iX.n2(My.params, qS.urlParameterWhitelist)
                    })(qS.url)
                },
                lu: function() {
                    Ae.LU = LU;
                    Ae.iz();
                    iP.N_ && iP.N_.bm();
                    if (dV) {
                        com.igt.mxf.addOneShotEvent("resume", function() {
                            dV = 0;
                            Ae.dJ(1)
                        });
                        com.igt.mxf.enableEvents(1);
                        LU && com.igt.mxf.sendOutcome(LU);
                        com.igt.mxf.sendMessage("insufficientFundsNotification")
                    } else {
                        Ae.dJ(1)
                    }
                },
                ZJ: function() {
                    Ae.dJ(0);
                    if (!dV) {
                        dV = 1;
                        com.igt.mxf.addOneShotEvent("wagerStarted", function() {
                            com.igt.mxf.enableEvents(0);
                            Ae.WN()
                        });
                        com.igt.mxf.sendMessage("wagerIsStarting")
                    } else {
                        Ae.WN()
                    }
                },
                CN: function() {
                    Ae.dJ(0);
                    if (!dV) {
                        dV = 1;
                        com.igt.mxf.addOneShotEvent("wagerStarted", function() {
                            com.igt.mxf.enableEvents(0);
                            Ae.qc()
                        });
                        com.igt.mxf.sendMessage("wagerIsStarting")
                    } else {
                        Ae.qc()
                    }
                },
                Ks: function() {
                    com.igt.mxf.addOneShotEvent("wagerComplete", function() {
                        dV = 0;
                        Ae.eV()
                    });
                    PO.style.visibility = "";
                    com.igt.mxf.enableEvents(1);
                    com.igt.mxf.sendMessage("wagerIsComplete")
                },
                Ma: function() {
                    Ae.iz();
                    iP.N_ && iP.N_.bm();
                    if (dV) {
                        com.igt.mxf.addOneShotEvent("wagerAborted", function() {
                            dV = 0;
                            Ae.dJ(1)
                        });
                        com.igt.mxf.enableEvents(1);
                        com.igt.mxf.sendMessage("wagerIsAborted")
                    } else {
                        Ae.dJ(1)
                    }
                },
                cs: function(yg) {
                    com.igt.mxf.addOneShotEvent("resume", function() {
                        zJ.JG(yg["@name"], yg.Param)
                    });
                    com.igt.mxf.sendMessage("command", yg["@name"], yg.Param)
                },
                lR: function(A_) {
                    com.igt.mxf.addOneShotEvent("resume", function(jG) {
                        PO.style.visibility = "";
                        if (A_.Buttons[jG]) {
                            zJ.lI(A_.Buttons[jG].Cmd)
                        } else {
                            aS.vb(A_, zJ.lI).ex(1);
                            PO.style.height = ""
                        }
                    });
                    com.igt.mxf.enableEvents(1);
                    com.igt.mxf.sendMessage("displayMessage", A_.Id, A_.Reference, A_.Message, A_.Buttons.map(function(YN) {
                        return YN.Text
                    }));
                    PO.style.visibility = "visible";
                    PO.style.height = 0
                },
                rL: function() {
                    if (Ae.LU.OutcomeDetail.Settled != 0) {
                        com.igt.mxf.addOneShotEvent("afterGameOutcome", q7);
                        com.igt.mxf.sendOutcome(Ae.LU)
                    } else {
                        q7()
                    }
                },
                oW: function() {
                    com.igt.mxf.addOneShotEvent("resume", function(Ai) {
                        JL(Ai)
                    });
                    com.igt.mxf.sendMessage("beforeInitGame")
                },
                GV: function(v4, uU) {
                    com.igt.mxf.addOneShotEvent("afterGameOutcome", Bc);
                    com.igt.mxf.setCurrencyFormat({
                        config: v4,
                        toCurrency: ro.K7,
                        format: ro.wl
                    });
                    com.igt.mxf.sendOutcome(uU)
                },
                ex: function(uT) {
                    if (PO) {
                        PO.style.visibility = uT ? "" : "hidden"
                    }
                },
                Mt: function() {
                    PO.style.visibility = "";
                    com.igt.mxf.sendMessage("gameReady")
                }
            }
        })();
    L6.K3 = function(YR) {
        YR.addEvents({
            DH: function() {
                Jf && Jf.ex(0)
            },
            xZ: function() {
                Jf && Jf.ex(1)
            }
        });
        return L6.nS(YR)
    };
    return function(sl, Iz, pz, Gu) {
        qS = sl;
        wt = pz;
        My = Iz;
        Ae = new J2.Mu();
        if (document.querySelector("meta[name='com.igt.game.IOS9FIX'][content='yes']")) {
            var yH = new Element("div", {
                id: "game"
            });
            var Iy = new Element("div", {
                id: "ios9fix"
            });
            Iy.style.position = "absolute";
            Iy.style.top = "0";
            Iy.style.left = "0";
            Iy.style.width = "100%";
            Iy.style.height = "100%";
            Iy.style.overflow = "hidden";
            Ae.jx = (Iy.adopt(yH)).inject(document.body.lastElementChild, "before");
            Ae.jx = yH
        } else {
            Ae.jx = (new Element("div", {
                id: "game"
            })).inject(document.body.lastElementChild, "before")
        }
        wo = new Ly({
            qS: qS.RGS,
            qx: qx,
            tX: tX,
            nz: nz,
            dB: dB,
            iO: iO
        });
        Ae.AV = L6.nS(new vF({
            Vs: "AV",
            vL: "s0 Eo"
        }));
        document.body.grab(Ae.AV, "top");
        aS = L6.K3(new vF({
            Vs: "aS",
            vL: "kJ Eo",
            b3: 0
        }).addEvents({
            DH: function() {
                WI.dQ("abortLoading"), Ae.AV.ex(0)
            }
        }));
        document.body.grab(aS, "top");

        function subvertBalanceMeterForPromotionalFreeSpin(Ae) {
            if (!Ae.F4) {
                throw new Error("You must expose F4 on the game instance")
            }
            var TR = Ae.F4.rC.bind(Ae.F4);
            Ae.F4.JH.lA = Math.floor;
            Ae.F4.JH.Ym = Math.floor;
            Ae.F4.rC = function() {
                if (Ae.LU.PromotionalFreeSpin && Ae.LU.PromotionalFreeSpin["@count"]) {
                    TR(Ae.LU.PromotionalFreeSpin["@count"])
                }
            };
            Ae.F4.N2 = function() {
                return Infinity
            };
            Ae.F4.rC()
        }
        Gu.ky("initialise", function dN() {
            Gu.mw("initialise", dN);
            Ae.gQ = gQ;
            if (Ae.LU.PromotionalFreeSpin) {
                Ae.UY.PatternSliderInfo.PatternInfo.Step = [My.params.freespin_lines];
                if (Ki("Game.consoleBalance") === Ki("Game.consoleBalance").toUpperCase()) {
                    sI.cA("Game.consoleBalance", Ki("mproxy.PromotionalFreeSpin.consoleBalance").toUpperCase())
                } else {
                    sI.cA("Game.consoleBalance", Ki("mproxy.PromotionalFreeSpin.consoleBalance"))
                }
            }
            Ae.DJ();
            Ae.DJ = void 0;
            if (Ae.LU.PromotionalFreeSpin) {
                subvertBalanceMeterForPromotionalFreeSpin(Ae)
            }
            WI.dQ("initialised");
            Jf.Mt()
        });
        Gu.kM(["loaded", "console"], Gk);
        Jf.Oo(qS.console, My);
        Ae.CN = Jf.CN;
        Ae.ZJ = Jf.ZJ;
        Ae.Ks = Jf.Ks;
        Ae.rL = Jf.rL;
        Ae.hV = Jf.ex;
        if (wt && wt.transactiondelay && wt.gameType && wt.gameType.toUpperCase() == "S") {
            Ae.Rf = lS
        } else {
            Ae.Rf = Rf
        }
        Ae.Ip = Ip;
        Ae.dJ = function(f7) {
            Ae.Wk(f7 && !rG)
        }
    }
})();
J2.tL = Ly.tL;
/*! iScroll v5.1.3 ~ (c) 2008-2014 Matteo Spinelli ~ http://cubiq.org/license */
(function(window, document, Math) {
    var rAF = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
        window.setTimeout(callback, 1000 / 60)
    };
    var utils = (function() {
        var me = {};
        var w8 = document.createElement("div").style;
        var IW = (function() {
            var vendors = ["t", "webkitT", "MozT", "msT", "OT"],
                transform, i = 0,
                l = vendors.length;
            for (; i < l; i++) {
                transform = vendors[i] + "ransform";
                if (transform in w8) {
                    return vendors[i].substr(0, vendors[i].length - 1)
                }
            }
            return false
        })();

        function JK(style) {
            if (IW === false) {
                return false
            }
            if (IW === "") {
                return style
            }
            return IW + style.charAt(0).toUpperCase() + style.substr(1)
        }
        me.getTime = Date.now || function getTime() {
            return new Date().getTime()
        };
        me.extend = function(target, obj) {
            for (var i in obj) {
                target[i] = obj[i]
            }
        };
        me.addEvent = function(el, type, fn, capture) {
            el.addEventListener(type, fn, !!capture)
        };
        me.removeEvent = function(el, type, fn, capture) {
            el.removeEventListener(type, fn, !!capture)
        };
        me.prefixPointerEvent = function(pointerEvent) {
            return window.MSPointerEvent ? "MSPointer" + pointerEvent.charAt(9).toUpperCase() + pointerEvent.substr(10) : pointerEvent
        };
        me.momentum = function(current, start, time, lowerMargin, wrapperSize, deceleration) {
            var distance = current - start,
                speed = Math.abs(distance) / time,
                destination, duration;
            deceleration = deceleration === undefined ? 0.0006 : deceleration;
            destination = current + (speed * speed) / (2 * deceleration) * (distance < 0 ? -1 : 1);
            duration = speed / deceleration;
            if (destination < lowerMargin) {
                destination = wrapperSize ? lowerMargin - (wrapperSize / 2.5 * (speed / 8)) : lowerMargin;
                distance = Math.abs(destination - current);
                duration = distance / speed
            } else {
                if (destination > 0) {
                    destination = wrapperSize ? wrapperSize / 2.5 * (speed / 8) : 0;
                    distance = Math.abs(current) + destination;
                    duration = distance / speed
                }
            }
            return {
                destination: Math.round(destination),
                duration: duration
            }
        };
        var VK = JK("transform");
        me.extend(me, {
            hasTransform: VK !== false,
            hasPerspective: JK("perspective") in w8,
            hasTouch: "ontouchstart" in window,
            hasPointer: window.PointerEvent || window.MSPointerEvent,
            hasTransition: JK("transition") in w8
        });
        me.isBadAndroid = /Android /.test(window.navigator.appVersion) && !(/Chrome\/\d/.test(window.navigator.appVersion));
        me.extend(me.style = {}, {
            transform: VK,
            transitionTimingFunction: JK("transitionTimingFunction"),
            transitionDuration: JK("transitionDuration"),
            transitionDelay: JK("transitionDelay"),
            transformOrigin: JK("transformOrigin")
        });
        me.hasClass = function(e, c) {
            var re = new RegExp("(^|\\s)" + c + "(\\s|$)");
            return re.test(e.className)
        };
        me.addClass = function(e, c) {
            if (me.hasClass(e, c)) {
                return
            }
            var newclass = e.className.split(" ");
            newclass.push(c);
            e.className = newclass.join(" ")
        };
        me.removeClass = function(e, c) {
            if (!me.hasClass(e, c)) {
                return
            }
            var re = new RegExp("(^|\\s)" + c + "(\\s|$)", "g");
            e.className = e.className.replace(re, " ")
        };
        me.offset = function(el) {
            var left = -el.offsetLeft,
                top = -el.offsetTop;
            while (el = el.offsetParent) {
                left -= el.offsetLeft;
                top -= el.offsetTop
            }
            return {
                left: left,
                top: top
            }
        };
        me.preventDefaultException = function(el, exceptions) {
            for (var i in exceptions) {
                if (exceptions[i].test(el[i])) {
                    return true
                }
            }
            return false
        };
        me.extend(me.eventType = {}, {
            touchstart: 1,
            touchmove: 1,
            touchend: 1,
            mousedown: 2,
            mousemove: 2,
            mouseup: 2,
            pointerdown: 3,
            pointermove: 3,
            pointerup: 3,
            MSPointerDown: 3,
            MSPointerMove: 3,
            MSPointerUp: 3
        });
        me.extend(me.ease = {}, {
            quadratic: {
                style: "cubic-bezier(0.25, 0.46, 0.45, 0.94)",
                fn: function(k) {
                    return k * (2 - k)
                }
            },
            circular: {
                style: "cubic-bezier(0.1, 0.57, 0.1, 1)",
                fn: function(k) {
                    return Math.sqrt(1 - (--k * k))
                }
            },
            back: {
                style: "cubic-bezier(0.175, 0.885, 0.32, 1.275)",
                fn: function(k) {
                    var b = 4;
                    return (k = k - 1) * k * ((b + 1) * k + b) + 1
                }
            },
            bounce: {
                style: "",
                fn: function(k) {
                    if ((k /= 1) < (1 / 2.75)) {
                        return 7.5625 * k * k
                    } else {
                        if (k < (2 / 2.75)) {
                            return 7.5625 * (k -= (1.5 / 2.75)) * k + 0.75
                        } else {
                            if (k < (2.5 / 2.75)) {
                                return 7.5625 * (k -= (2.25 / 2.75)) * k + 0.9375
                            } else {
                                return 7.5625 * (k -= (2.625 / 2.75)) * k + 0.984375
                            }
                        }
                    }
                }
            },
            elastic: {
                style: "",
                fn: function(k) {
                    var f = 0.22,
                        e = 0.4;
                    if (k === 0) {
                        return 0
                    }
                    if (k == 1) {
                        return 1
                    }
                    return (e * Math.pow(2, -10 * k) * Math.sin((k - f / 4) * (2 * Math.PI) / f) + 1)
                }
            }
        });
        me.tap = function(e, eventName) {
            var ev = document.createEvent("Event");
            ev.initEvent(eventName, true, true);
            ev.pageX = e.pageX;
            ev.pageY = e.pageY;
            e.target.dispatchEvent(ev)
        };
        me.click = function(e) {
            var target = e.target,
                ev;
            if (!(/(SELECT|INPUT|TEXTAREA)/i).test(target.tagName)) {
                ev = document.createEvent("MouseEvents");
                ev.initMouseEvent("click", true, true, e.view, 1, target.screenX, target.screenY, target.clientX, target.clientY, e.ctrlKey, e.altKey, e.shiftKey, e.metaKey, 0, null);
                ev.KU = true;
                target.dispatchEvent(ev)
            }
        };
        return me
    })();

    function IScroll(el, options) {
        this.wrapper = typeof el == "string" ? document.querySelector(el) : el;
        this.scroller = this.wrapper.children[0];
        this.scrollerStyle = this.scroller.style;
        this.options = {
            startX: 0,
            startY: 0,
            scrollY: true,
            directionLockThreshold: 5,
            momentum: true,
            bounce: true,
            bounceTime: 600,
            bounceEasing: "",
            preventDefault: true,
            preventDefaultException: {
                tagName: /^(INPUT|TEXTAREA|BUTTON|SELECT)$/
            },
            HWCompositing: true,
            useTransition: true,
            useTransform: true
        };
        for (var i in options) {
            this.options[i] = options[i]
        }
        this.translateZ = this.options.HWCompositing && utils.hasPerspective ? " translateZ(0)" : "";
        this.options.useTransition = utils.hasTransition && this.options.useTransition;
        this.options.useTransform = utils.hasTransform && this.options.useTransform;
        this.options.eventPassthrough = this.options.eventPassthrough === true ? "vertical" : this.options.eventPassthrough;
        this.options.preventDefault = !this.options.eventPassthrough && this.options.preventDefault;
        this.options.scrollY = this.options.eventPassthrough == "vertical" ? false : this.options.scrollY;
        this.options.scrollX = this.options.eventPassthrough == "horizontal" ? false : this.options.scrollX;
        this.options.freeScroll = this.options.freeScroll && !this.options.eventPassthrough;
        this.options.directionLockThreshold = this.options.eventPassthrough ? 0 : this.options.directionLockThreshold;
        this.options.bounceEasing = typeof this.options.bounceEasing == "string" ? utils.ease[this.options.bounceEasing] || utils.ease.circular : this.options.bounceEasing;
        this.options.resizePolling = this.options.resizePolling === undefined ? 60 : this.options.resizePolling;
        if (this.options.tap === true) {
            this.options.tap = "tap"
        }
        this.x = 0;
        this.y = 0;
        this.directionX = 0;
        this.directionY = 0;
        this.Uk = {};
        this.wS();
        this.refresh();
        this.scrollTo(this.options.startX, this.options.startY);
        this.enable()
    }
    IScroll.prototype = {
        version: "5.1.3",
        wS: function() {
            this.e8()
        },
        destroy: function() {
            this.e8(true);
            this.i6("destroy")
        },
        JP: function(e) {
            if (e.target != this.scroller || !this.isInTransition) {
                return
            }
            this.EA();
            if (!this.resetPosition(this.options.bounceTime)) {
                this.isInTransition = false;
                this.i6("scrollEnd")
            }
        },
        kc: function(e) {
            if (utils.eventType[e.type] != 1) {
                if (e.button !== 0) {
                    return
                }
            }
            if (!this.enabled || (this.initiated && utils.eventType[e.type] !== this.initiated)) {
                return
            }
            if (this.options.preventDefault && !utils.isBadAndroid && !utils.preventDefaultException(e.target, this.options.preventDefaultException)) {
                e.preventDefault()
            }
            var point = e.touches ? e.touches[0] : e,
                pos;
            this.initiated = utils.eventType[e.type];
            this.moved = false;
            this.distX = 0;
            this.distY = 0;
            this.directionX = 0;
            this.directionY = 0;
            this.directionLocked = 0;
            this.EA();
            this.startTime = utils.getTime();
            if (this.options.useTransition && this.isInTransition) {
                this.isInTransition = false;
                pos = this.getComputedPosition();
                this.Cd(Math.round(pos.x), Math.round(pos.y));
                this.i6("scrollEnd")
            } else {
                if (!this.options.useTransition && this.isAnimating) {
                    this.isAnimating = false;
                    this.i6("scrollEnd")
                }
            }
            this.startX = this.x;
            this.startY = this.y;
            this.absStartX = this.x;
            this.absStartY = this.y;
            this.pointX = point.pageX;
            this.pointY = point.pageY;
            this.i6("beforeScrollStart")
        },
        WX: function(e) {
            if (!this.enabled || utils.eventType[e.type] !== this.initiated) {
                return
            }
            if (this.options.preventDefault) {
                e.preventDefault()
            }
            var point = e.touches ? e.touches[0] : e,
                deltaX = point.pageX - this.pointX,
                deltaY = point.pageY - this.pointY,
                timestamp = utils.getTime(),
                newX, newY, absDistX, absDistY;
            this.pointX = point.pageX;
            this.pointY = point.pageY;
            this.distX += deltaX;
            this.distY += deltaY;
            absDistX = Math.abs(this.distX);
            absDistY = Math.abs(this.distY);
            if (timestamp - this.endTime > 300 && (absDistX < 10 && absDistY < 10)) {
                return
            }
            if (!this.directionLocked && !this.options.freeScroll) {
                if (absDistX > absDistY + this.options.directionLockThreshold) {
                    this.directionLocked = "h"
                } else {
                    if (absDistY >= absDistX + this.options.directionLockThreshold) {
                        this.directionLocked = "v"
                    } else {
                        this.directionLocked = "n"
                    }
                }
            }
            if (this.directionLocked == "h") {
                if (this.options.eventPassthrough == "vertical") {
                    e.preventDefault()
                } else {
                    if (this.options.eventPassthrough == "horizontal") {
                        this.initiated = false;
                        return
                    }
                }
                deltaY = 0
            } else {
                if (this.directionLocked == "v") {
                    if (this.options.eventPassthrough == "horizontal") {
                        e.preventDefault()
                    } else {
                        if (this.options.eventPassthrough == "vertical") {
                            this.initiated = false;
                            return
                        }
                    }
                    deltaX = 0
                }
            }
            deltaX = this.hasHorizontalScroll ? deltaX : 0;
            deltaY = this.hasVerticalScroll ? deltaY : 0;
            newX = this.x + deltaX;
            newY = this.y + deltaY;
            if (newX > 0 || newX < this.maxScrollX) {
                newX = this.options.bounce ? this.x + deltaX / 3 : newX > 0 ? 0 : this.maxScrollX
            }
            if (newY > 0 || newY < this.maxScrollY) {
                newY = this.options.bounce ? this.y + deltaY / 3 : newY > 0 ? 0 : this.maxScrollY
            }
            this.directionX = deltaX > 0 ? -1 : deltaX < 0 ? 1 : 0;
            this.directionY = deltaY > 0 ? -1 : deltaY < 0 ? 1 : 0;
            if (!this.moved) {
                this.i6("scrollStart")
            }
            this.moved = true;
            this.Cd(newX, newY);
            if (timestamp - this.startTime > 300) {
                this.startTime = timestamp;
                this.startX = this.x;
                this.startY = this.y
            }
        },
        SM: function(e) {
            if (!this.enabled || utils.eventType[e.type] !== this.initiated) {
                return
            }
            if (this.options.preventDefault && !utils.preventDefaultException(e.target, this.options.preventDefaultException)) {
                e.preventDefault()
            }
            var point = e.changedTouches ? e.changedTouches[0] : e,
                momentumX, momentumY, duration = utils.getTime() - this.startTime,
                newX = Math.round(this.x),
                newY = Math.round(this.y),
                distanceX = Math.abs(newX - this.startX),
                distanceY = Math.abs(newY - this.startY),
                time = 0,
                easing = "";
            this.isInTransition = 0;
            this.initiated = 0;
            this.endTime = utils.getTime();
            if (this.resetPosition(this.options.bounceTime)) {
                return
            }
            this.scrollTo(newX, newY);
            if (!this.moved) {
                if (this.options.tap) {
                    utils.tap(e, this.options.tap)
                }
                if (this.options.click) {
                    utils.click(e)
                }
                this.i6("scrollCancel");
                return
            }
            if (this.Uk.flick && duration < 200 && distanceX < 100 && distanceY < 100) {
                this.i6("flick");
                return
            }
            if (this.options.momentum && duration < 300) {
                momentumX = this.hasHorizontalScroll ? utils.momentum(this.x, this.startX, duration, this.maxScrollX, this.options.bounce ? this.wrapperWidth : 0, this.options.deceleration) : {
                    destination: newX,
                    duration: 0
                };
                momentumY = this.hasVerticalScroll ? utils.momentum(this.y, this.startY, duration, this.maxScrollY, this.options.bounce ? this.wrapperHeight : 0, this.options.deceleration) : {
                    destination: newY,
                    duration: 0
                };
                newX = momentumX.destination;
                newY = momentumY.destination;
                time = Math.max(momentumX.duration, momentumY.duration);
                this.isInTransition = 1
            }
            if (newX != this.x || newY != this.y) {
                if (newX > 0 || newX < this.maxScrollX || newY > 0 || newY < this.maxScrollY) {
                    easing = utils.ease.quadratic
                }
                this.scrollTo(newX, newY, time, easing);
                return
            }
            this.i6("scrollEnd")
        },
        qo: function() {
            var that = this;
            clearTimeout(this.resizeTimeout);
            this.resizeTimeout = setTimeout(function() {
                that.refresh()
            }, this.options.resizePolling)
        },
        resetPosition: function(time) {
            var x = this.x,
                y = this.y;
            time = time || 0;
            if (!this.hasHorizontalScroll || this.x > 0) {
                x = 0
            } else {
                if (this.x < this.maxScrollX) {
                    x = this.maxScrollX
                }
            }
            if (!this.hasVerticalScroll || this.y > 0) {
                y = 0
            } else {
                if (this.y < this.maxScrollY) {
                    y = this.maxScrollY
                }
            }
            if (x == this.x && y == this.y) {
                return false
            }
            this.scrollTo(x, y, time, this.options.bounceEasing);
            return true
        },
        disable: function() {
            this.enabled = false
        },
        enable: function() {
            this.enabled = true
        },
        refresh: function() {
            var rf = this.wrapper.offsetHeight;
            this.wrapperWidth = this.wrapper.clientWidth;
            this.wrapperHeight = this.wrapper.clientHeight;
            this.scrollerWidth = this.scroller.offsetWidth;
            this.scrollerHeight = this.scroller.offsetHeight;
            this.maxScrollX = this.wrapperWidth - this.scrollerWidth;
            this.maxScrollY = this.wrapperHeight - this.scrollerHeight;
            this.hasHorizontalScroll = this.options.scrollX && this.maxScrollX < 0;
            this.hasVerticalScroll = this.options.scrollY && this.maxScrollY < 0;
            if (!this.hasHorizontalScroll) {
                this.maxScrollX = 0;
                this.scrollerWidth = this.wrapperWidth
            }
            if (!this.hasVerticalScroll) {
                this.maxScrollY = 0;
                this.scrollerHeight = this.wrapperHeight
            }
            this.endTime = 0;
            this.directionX = 0;
            this.directionY = 0;
            this.wrapperOffset = utils.offset(this.wrapper);
            this.i6("refresh");
            this.resetPosition()
        },
        on: function(type, fn) {
            if (!this.Uk[type]) {
                this.Uk[type] = []
            }
            this.Uk[type].push(fn)
        },
        off: function(type, fn) {
            if (!this.Uk[type]) {
                return
            }
            var index = this.Uk[type].indexOf(fn);
            if (index > -1) {
                this.Uk[type].splice(index, 1)
            }
        },
        i6: function(type) {
            if (!this.Uk[type]) {
                return
            }
            var i = 0,
                l = this.Uk[type].length;
            if (!l) {
                return
            }
            for (; i < l; i++) {
                this.Uk[type][i].apply(this, [].slice.call(arguments, 1))
            }
        },
        scrollBy: function(x, y, time, easing) {
            x = this.x + x;
            y = this.y + y;
            time = time || 0;
            this.scrollTo(x, y, time, easing)
        },
        scrollTo: function(x, y, time, easing) {
            easing = easing || utils.ease.circular;
            this.isInTransition = this.options.useTransition && time > 0;
            if (!time || (this.options.useTransition && easing.style)) {
                this.UK(easing.style);
                this.EA(time);
                this.Cd(x, y)
            } else {
                this.Xc(x, y, time, easing.fn)
            }
        },
        scrollToElement: function(el, time, offsetX, offsetY, easing) {
            el = el.nodeType ? el : this.scroller.querySelector(el);
            if (!el) {
                return
            }
            var pos = utils.offset(el);
            pos.left -= this.wrapperOffset.left;
            pos.top -= this.wrapperOffset.top;
            if (offsetX === true) {
                offsetX = Math.round(el.offsetWidth / 2 - this.wrapper.offsetWidth / 2)
            }
            if (offsetY === true) {
                offsetY = Math.round(el.offsetHeight / 2 - this.wrapper.offsetHeight / 2)
            }
            pos.left -= offsetX || 0;
            pos.top -= offsetY || 0;
            pos.left = pos.left > 0 ? 0 : pos.left < this.maxScrollX ? this.maxScrollX : pos.left;
            pos.top = pos.top > 0 ? 0 : pos.top < this.maxScrollY ? this.maxScrollY : pos.top;
            time = time === undefined || time === null || time === "auto" ? Math.max(Math.abs(this.x - pos.left), Math.abs(this.y - pos.top)) : time;
            this.scrollTo(pos.left, pos.top, time, easing)
        },
        EA: function(time) {
            time = time || 0;
            this.scrollerStyle[utils.style.transitionDuration] = time + "ms";
            if (!time && utils.isBadAndroid) {
                this.scrollerStyle[utils.style.transitionDuration] = "0.001s"
            }
        },
        UK: function(easing) {
            this.scrollerStyle[utils.style.transitionTimingFunction] = easing
        },
        Cd: function(x, y) {
            if (this.options.useTransform) {
                this.scrollerStyle[utils.style.transform] = "translate(" + x + "px," + y + "px)" + this.translateZ
            } else {
                x = Math.round(x);
                y = Math.round(y);
                this.scrollerStyle.left = x + "px";
                this.scrollerStyle.top = y + "px"
            }
            this.x = x;
            this.y = y
        },
        e8: function(remove) {
            var eventType = remove ? utils.removeEvent : utils.addEvent,
                target = this.options.bindToWrapper ? this.wrapper : window;
            eventType(window, "orientationchange", this);
            eventType(window, "resize", this);
            if (this.options.click) {
                eventType(this.wrapper, "click", this, true)
            }
            if (!this.options.disableMouse) {
                eventType(this.wrapper, "mousedown", this);
                eventType(target, "mousemove", this);
                eventType(target, "mousecancel", this);
                eventType(target, "mouseup", this)
            }
            if (utils.hasPointer && !this.options.disablePointer) {
                eventType(this.wrapper, utils.prefixPointerEvent("pointerdown"), this);
                eventType(target, utils.prefixPointerEvent("pointermove"), this);
                eventType(target, utils.prefixPointerEvent("pointercancel"), this);
                eventType(target, utils.prefixPointerEvent("pointerup"), this)
            }
            if (utils.hasTouch && !this.options.disableTouch) {
                eventType(this.wrapper, "touchstart", this);
                eventType(target, "touchmove", this);
                eventType(target, "touchcancel", this);
                eventType(target, "touchend", this)
            }
            eventType(this.scroller, "transitionend", this);
            eventType(this.scroller, "webkitTransitionEnd", this);
            eventType(this.scroller, "oTransitionEnd", this);
            eventType(this.scroller, "MSTransitionEnd", this)
        },
        getComputedPosition: function() {
            var matrix = window.getComputedStyle(this.scroller, null),
                x, y;
            if (this.options.useTransform) {
                matrix = matrix[utils.style.transform].split(")")[0].split(", ");
                x = +(matrix[12] || matrix[4]);
                y = +(matrix[13] || matrix[5])
            } else {
                x = +matrix.left.replace(/[^-\d.]/g, "");
                y = +matrix.top.replace(/[^-\d.]/g, "")
            }
            return {
                x: x,
                y: y
            }
        },
        Xc: function(destX, destY, duration, easingFn) {
            var that = this,
                startX = this.x,
                startY = this.y,
                startTime = utils.getTime(),
                destTime = startTime + duration;

            function step() {
                var now = utils.getTime(),
                    newX, newY, easing;
                if (now >= destTime) {
                    that.isAnimating = false;
                    that.Cd(destX, destY);
                    if (!that.resetPosition(that.options.bounceTime)) {
                        that.i6("scrollEnd")
                    }
                    return
                }
                now = (now - startTime) / duration;
                easing = easingFn(now);
                newX = (destX - startX) * easing + startX;
                newY = (destY - startY) * easing + startY;
                that.Cd(newX, newY);
                if (that.isAnimating) {
                    rAF(step)
                }
            }
            this.isAnimating = true;
            step()
        },
        handleEvent: function(e) {
            switch (e.type) {
                case "touchstart":
                case "pointerdown":
                case "MSPointerDown":
                case "mousedown":
                    this.kc(e);
                    break;
                case "touchmove":
                case "pointermove":
                case "MSPointerMove":
                case "mousemove":
                    this.WX(e);
                    break;
                case "touchend":
                case "pointerup":
                case "MSPointerUp":
                case "mouseup":
                case "touchcancel":
                case "pointercancel":
                case "MSPointerCancel":
                case "mousecancel":
                    this.SM(e);
                    break;
                case "orientationchange":
                case "resize":
                    this.qo();
                    break;
                case "transitionend":
                case "webkitTransitionEnd":
                case "oTransitionEnd":
                case "MSTransitionEnd":
                    this.JP(e);
                    break;
                case "wheel":
                case "DOMMouseScroll":
                case "mousewheel":
                    this.ye(e);
                    break;
                case "keydown":
                    this.Q7(e);
                    break;
                case "click":
                    if (!e.KU) {
                        e.preventDefault();
                        e.stopPropagation()
                    }
                    break
            }
        }
    };
    IScroll.utils = utils;
    if (typeof module != "undefined" && module.exports) {
        module.exports = IScroll
    } else {
        window.IScroll = IScroll
    }
})(window, document, Math);
var zo = (function() {
    return new Class({
        Extends: L6,
        Binds: ["tg", "R_"],
        JH: {
            s8: 1
        },
        yx: 0,
        initialize: function(JH) {
            var KQ;
            this.parent(JH);
            this.Pz({
                ba: new eT({
                    vL: "ba"
                }),
                O6: new eT({
                    vL: "O6"
                }),
                LC: new eT({
                    vL: "LC",
                    Xl: 1
                })
            });
            this.addEvents({
                O6: this.R_,
                ba: this.tg
            });
            this.jx.adopt((new Element("div", {
                "class": "SN"
            })).adopt(this.Oj, this.T0 = new Element("div", {
                "class": "nX"
            }).adopt(this.c5)));
            this.Gj = new IScroll(this.T0, {
                hScrollbar: false,
                vScrollbar: true,
                checkDOMChanges: false,
                hideScrollbar: false
            })
        },
        Qo: function(A_) {
            var ag;
            this.parent(arguments);
            this.Gj.scrollTo(0, 0, 0);
            setTimeout(this.Gj.refresh.bind(this.Gj), 200);
            return this
        },
        ex: function(uT) {
            if (uT) {
                this.yx = 0;
                this.P5(0)
            }
            this.parent(uT)
        },
        Qb: function() {
            this.parent();
            this.Qo("")
        },
        R_: function() {
            if (++this.yx >= this.JH.s8) {
                this.yx = 0
            }
            this.yx = Math.min(this.yx, this.JH.s8 - 1);
            this.P5(this.yx)
        },
        P5: function(LY) {
            this.fireEvent("cH", LY)
        },
        tg: function() {
            if (this.yx <= 0) {
                this.yx = this.JH.s8
            }
            this.yx = Math.max(--this.yx, 0);
            this.P5(this.yx)
        },
        zM: function(BB) {
            this.Oj.zM(BB, "ba");
            this.Oj.zM(BB, "O6");
            return this
        }
    })
})();
DW = {
    IH: [void 0, "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRFqQMD06sZiGQHnnoNxqAXxp8Ws40SdlMEs40RdVID0qoY06sYjwIC4lJSaEYA/wMD////qEgRmwAAABF0Uk5T/////////////////////wAlrZliAAAANUlEQVR42kTHQRaAIAhAwQ9UFlpy/9O6sAezG8Ld+xbIm4RzpoO7cmEVQyvKw/jRiC/FEmAA7wsEpe9R1HEAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRFvTs706sZdQICnnoNiGQHxp8WxqAXs40Ss40RdVIDdlME0qoY06sYXwICymFhaEYAqQMD////dSD3RQAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0kOACAIBMFRccWN/39WEw3UqRvCzP0ROMzvZtwqodhkBJsAsiFUPz7fIEvJEWAA+GkE6Ua87fwAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRFiGQHA6rV06sZnnoNOf//xp8WxqAXdlMEs40Ss40RdVID0qoY06sYAo+Pm///aEYAA/z8////xYHTqwAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0EWgCAIQMGvYFZkyv0v2yIfzG5wM3t+TtV300pb4eDKnEhGIAN3GVvp+Az+CTAA+u8E6QigQUEAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRFrmpq06sZiGQHnnoNxqAXxp8Ws40SdlMEs40RdVID0qoY06sYjVZWaEYA/bm5+ZeX////R7/5hgAAABF0Uk5T/////////////////////wAlrZliAAAANUlEQVR42kTHQRaAIAhAwQ9UFlpy/9O6sAezG8Ld+xbIl4RzpoO7cmEVQyvKw/jRiDfFEmAA8hcEpZiwOAIAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRFsAKw06sZnnoNiGQHxp8WxqAXdVIDdlMEs40Ss40R0qoY06sYggOG/1L/aEYA/AP8////WGFXNQAAABF0Uk5T/////////////////////wAlrZliAAAANUlEQVR42kTHQRaAIAhAwQ9UFlpy/9O6sAezG8Ld+xbIm4RjppOncqMVxSrGxfjRiC/FEmAA70UEpcGGmr8AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADxQTFRFnnoNiGQH06sZMjL+s40SdVIDs40RAgK+AgK/MzP+xqAXxp8WdlME0qoY06sYAgKWUlL/aEYAAwP8////dg0+CQAAABR0Uk5T/////////////////////////wBPT+cRAAAAOElEQVR42kTHSRbAEBBAwW+IEGlC3/+uFvF07QoVkfZTfPm24KnzeEiWCBZwFsd19y2/6Dh0CTAAHh8Fma27OGwAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRF06sZnnoNiGQHRXCks40RxqAXdlMEdVIDxp8Ws40S0qoY06sYWIitAixNaEYAA0qB////68QA2QAAABF0Uk5T/////////////////////wAlrZliAAAANUlEQVR42kTHQRaAIAhAwQ9UFlpy/9O6sAezG8Ld+xZg42dwz3RyVB6kImhFaW+6iC/FEmAA540EpeGDk/gAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADlQTFRFiGQHAnui06sZnnoNOcPvxqAXs40RdlMEs40Sxp8WdVID0qoYA6rV06sYWMzyAmKHaEYAA7Lr////ntj/AAAAABN0Uk5T////////////////////////ALJ93AgAAAA5SURBVHjaRMdJEoAgDADBYRMkoJL/P5aDKdK3RkVk/pSYH5Mj91hmFC5PI3kSeKCH14SKfoduAQYAABkFDsTc9oQAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRF06sZiGQHc2wEurI7nnoNxqAXxp8WdVIDs40SdlMEs40R0qoY06sYx8dYXVgDaEYAqagD////uOlGDQAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0EWgCAIQMGvYFZkyv0v2yIfzG5wM3t+DjI2gWOFxp050YxSMoVe361e+Az+CTAA98sE6YxcxV8AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADlQTFRFrXIF879K06sZnnoNiGQHxp8WxqAXdlMEs40Ss40RdVID0qoY7ZwH06sYhmYA/spTaEYA+6UH////ik4m8QAAABN0Uk5T////////////////////////ALJ93AgAAAA5SURBVHjaRMdJEoAgDADBYRMkoJL/P5aDKdK3RkVk/pQYXhMiZSwzLm5PI3kS2ZPpPIaKfoduAQYAANEFDg+Ps/oAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRFnDmg06sZUgxgnnoNiGQHxp8WxqAXs40Ss40RdVIDdlME0qoY06sYo1ypRgdGaEYAggOG////mzNJ6QAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0kOACAIBMFRccWN/39WEw3UqRvCzP0ROIzvZtwqodhkBJsAsiFUPz/fIEvJEWAA9mEE6ZF2LA0AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADlQTFRF/+s506sZiGQHnnoNqagDxqAXs40RdVIDs40Sxp8WdlME0qoY8dgD06sY/+5YlYQFaEYA/+UD////zY3KPwAAABN0Uk5T////////////////////////ALJ93AgAAAA4SURBVHjaRMfHDQAgDATBIwcT3X+xIGHhee2Ciag/DIMhbpa2RQuIOhlOx8HqWCQ/ha/g9fERYAD9kwUOu+QzTQAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRFObw506sZBX4AnnoNiGQHxp8WxqAXs40Ss40RdVIDdlME0qoY06sYAl8CW9tXaEYAA6gD////OylnZgAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0kOACAIBMFRccWN/39WEw3UqRvCzP0ROMzvZtwqodhkBJsAsiFUPz7fIEvJEWAA+GkE6Ua87fwAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADlQTFRF/9d306sZiGQHnnoNsog3xqAXs40RdVIDs40Sxp8WdlME0qoY879K06sYj3It/92MaEYA/spT////SUodZgAAABN0Uk5T////////////////////////ALJ93AgAAAA4SURBVHjaRMfHDQAgDATBIwcT3X+xIGHhee2Ciag/DIMpbpa2RQuIOhlOx8HqWCQ/hK/g9fERYAD/mwUOifQO+QAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRFmzmC06sZiGQHnnoNxqAXxp8Ws40SdlMEs40RdVID0qoY06sYo1ypRgdGaEYAfwNf////BVqxsQAAABF0Uk5T/////////////////////wAlrZliAAAANUlEQVR42kTHSQ4AIAgEwRFcceP/r9VEA3XqhopIfxQB47uZtomoPhnswyAfQpumQJfRI8AA5mkEpTUiUkoAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRF06sZnnoNiGQHf7ios40RxqAXdlMEdVIDxp8Ws40S0qoYV5uI06sYk8O1NmBVaEYAXKSQ////h9gF8wAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0EWgCAIQMGvZBZkyv0v2yIfzG5wVX1+DjI2gcvWZo0jc1MyhZqp9Dec+Az+CTAA7qUEzLxYsDQAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRF9zmB06sZiGQHnnoNxqAXxp8Ws40SdlMEs40RdVID0qoY06sY+FiUjwI3aEYA8gNd////7sKsogAAABF0Uk5T/////////////////////wAlrZliAAAANUlEQVR42kTHSQ4AIAgEwRFcceP/r9VEA3XqhopIfxQB47uZtomoPhnswyAfQpumQJfRI8AA5mkEpTUiUkoAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADlQTFRFiGQHAmKH06sZnnoNOZ7cxqAXs40RdlMEs40Sxp8WdVID0qoYA3zH06sYWK3iA0qBaEYAA4PT////O4BluwAAABN0Uk5T////////////////////////ALJ93AgAAAA5SURBVHjaRMdJEoAgDADBYRMkoJL/P5aDKdK3RkVk/pSYH5Mj91hmFC5PI3kSeKCH14SKfoduAQYAABkFDsTc9oQAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRF06sZnnoNiGQHcHB4xqAXxp8WdlMEs40RdVIDs40S0qoYnJnN06sYTld7aEYAwb/lp6XY////W3wVZAAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0EWgCAIQMGvZBZkyv0v2yIfzG5wVX1+DjNAs7XZQc/clEyhZiqXjE1O/A3+CTAA+P8EzKLH3OwAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRF06sZnnoNiGQHUgxgxqAXxp8WdlMEs40RdVIDs40S0qoY06sYRgdGo1ypaEYAayCR////ENkCggAAABF0Uk5T/////////////////////wAlrZliAAAANUlEQVR42kTHQRaAIAhAwQ9UFlpy/9O6sAezG8Ld+xbwJjhnOmiVB6kIWlFuGz+7iC/FEmAA7lkEpS7yK+8AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRFnnoNiGQH06sZs40Rs40SdVIDdlMExqAXxp8W0qoYqDzx06sYzHj2ayCRaEYAskD/////wErQfQAAABF0Uk5T/////////////////////wAlrZliAAAANklEQVR42kTHSRLAIAgAwYEsCprI/1/rISnoWxNmNj6BzqR0Xz9vHJUTKiAV4XrSTbwptgADAOPuBIYzQZn5AAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADlQTFRFiGQHA6gD06sZnnoNP+s3xp8WxqAXdlMEs40Ss40RdVID0qoYCdgA06sYW9tXBX4AaEYACuUA////1NBq0QAAABN0Uk5T////////////////////////ALJ93AgAAAA5SURBVHjaRMfJAYAgDADBDYcHAcH0X6wPA8xvMFVtPyOkx6VAfqd6cNeVi7gTYQeKdCcnNhb7BBgAAWMFE/HP68IAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRF06sZnnoNiGQHf4Sts40RxqAXdlMEdVIDxp8Ws40S0qoYvLy806sYcHB42dnZaEYAx8fH////iZk9GwAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0EWgCAIQMGvZBZkyv0v2yIfzG5wVX1+Dm+Ay9ZmjSNzUzKFmql0GZuc+Az+CTAA9kMEzCY4Zc8AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRFiGQHApZM06sZnnoNOeGNxqAXs40RdlMEs40Sxp8WdVID0qoY06sYWOafAno+aEYAA9dt////Bw2/uQAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0EWgCAIQMGvYFZkyv0v2yIfzG5wM3t+TtWxaeVaoXFkTiQjkIG7vFvp+Az+CTAA+RkE6RWqXkEAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRFsIFPiGQH06sZnnoN/8qRxqAXs40RdVIDs40Sxp8WdlME0qoY06sY/9Kij2lAaEYA/Lly////9XFdNAAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0EWgCAIQMGvYFZkyv0v2yIfzG5wM3t+TtWxaeVaoXFkTiQjlEyh827c+Az+CTAA+RIE6U5zAM4AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRFo1yp06sZiGQHnnoNxqAXxp8Ws40SdlMEs40RdVID0qoY06sYdEOL3qP6aEYAzHj2////5WCQKgAAABF0Uk5T/////////////////////wAlrZliAAAANUlEQVR42kTHQRaAIAhAwQ9UFlpy/9O6sAezG8Ld+xbIm4RzpoO7cmEVQyvKw/jRiC/FEmAA7wsEpe9R1HEAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADlQTFRF06sZiGQHc2wEurI7nnoNxqAXxp8WdVIDs40SdlMEs40R0qoYlYQF06sYXVgDwrVbaEYAo5AH////zWpTEQAAABN0Uk5T////////////////////////ALJ93AgAAAA5SURBVHjaRMdJEoAgDADBYRMkoJL/P5aDKdK3RkVk/hTSaxJcY5lR6J5G9mSCJ1DjY+KNfoduAQYAANMFDvNHxP4AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRFn6TO06sZiGQHnnoNxqAXxp8Ws40SdlMEs40RdVID0qoYf4St06sYp6XYTld7aEYAhIvB////EyopPgAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0kOACAIBMFxV3Dj/5/VRAN16oYQUX8EDuO7mXh/HFFtMoJNgLfxaFMVyFJyBBgA7YEEzGoMIlIAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADZQTFRFv+s506sZiGQHnnoNxqAXxp8Ws40SdlMEs40RdVID0qoYpNgD06sYye5YZYYCaEYAreUD////um7APQAAABJ0Uk5T//////////////////////8A4r+/EgAAADdJREFUeNpEx0kOACAIBMFxV3Dj/5/VRAN16oYQUX8EDuO7mXh/HFFtMoJNgLfxaFMVyFJyBBgA7YEEzGoMIlIAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRF06sZnnoNiGQHRXCks40RxqAXdlMEdVIDxp8Ws40S0qoY06sYTld7oL34aEYAc5zx////9JZ1nAAAABF0Uk5T/////////////////////wAlrZliAAAANUlEQVR42kTHQRaAIAhAwQ9UFlpy/9O6sAezG8Ld+xbwJrhnOjkqD1IRtKI0Gz+7iC/FEmAA7qkEpRcyfMcAAAAASUVORK5CYII="]
};
rm = function() {
    var fc = new Element("div", {
            id: "Xq"
        }),
        vl = new vX({
            jx: new Element("div", {
                id: "Fg"
            })
        }),
        jx = (new Element("div", {
            id: "dk"
        })).adopt(new Element("div", {
            id: "iR",
            text: Ki("bigWin")
        }), fc, (new Element("div", {
            id: "o1"
        })).adopt(vl));
    return {
        Rn: function() {
            return (new LK(fc, {
                vK: "backgroundPositionX",
                gF: Array.bY(1, 9, 9, -100),
                eg: "px",
                B1: 50,
                QT: 14
            })).addEvents({
                QQ: function() {
                    jx.removeClass("Wh");
                    jx.jl("visibility", "visible")
                },
                zL: function() {
                    jx.jl("visibility", "")
                },
                rA: function() {
                    jx.addClass("Wh")
                }
            })
        },
        toElement: function() {
            return jx
        },
        Z2: function() {
            return vl
        }
    }
};
J2.Mu = (function() {
    var GG = ["w01", "s01", "s02", "s03", "s04", "s05", "s06", "s07", "s08", "s09", "s10", "s11", "s12", "s13", "s14", "d01", "d02", "d03", "d04", "d05", "d10", "d11", "d12", "d13", "d14", "b01", "b02"],
        fQ = {
            GG: GG,
            Uz: iX.WD(["d01", "d02", "d03", "d04", "d05", "d10", "d11", "d12", "d13", "d14", "b02", "w01"].Lc(), function() {
                return 1
            }),
            u1: iX.WD(["s01", "s02", "s03", "s04", "s05", "s10", "s11", "s12", "s13", "s14", "d01", "d02", "d03", "d04", "d05", "d10", "d11", "d12", "d13", "d14", "b01"].Lc(), function() {
                return "w01"
            }),
            fm: iX.WD(GG.Lc(), function() {
                return 12
            }),
            uY: [20, 0, 5, 10, 15, 21, 1, 6, 11, 16, 22, 2, 7, 12, 17, 23, 3, 8, 13, 18, 24, 4, 9, 14, 19],
            kW: [0, 3, 6, 9, 12, 1, 4, 7, 10, 13, 2, 5, 8, 11, 14],
            Ib: ["L0C0R0", "L0C1R0", "L0C2R0", "L0C3R0", "L0C4R0", "L0C0R1", "L0C1R1", "L0C2R1", "L0C3R1", "L0C4R1", "L0C0R2", "L0C1R2", "L0C2R2", "L0C3R2", "L0C4R2"].Lc(),
            kp: ["Scatter", "Line 1", "Line 2", "Line 3", "Line 4", "Line 5", "Line 6", "Line 7", "Line 8", "Line 9", "Line 10", "Line 11", "Line 12", "Line 13", "Line 14", "Line 15", "Line 16", "Line 17", "Line 18", "Line 19", "Line 20", "Line 21", "Line 22", "Line 23", "Line 24", "Line 25", "Line 26", "Line 27", "Line 28", "Line 29", "Line 30"].Lc(),
            jd: {
                xE: 5,
                ah: 5,
                L2: 3,
                Q3: 56,
                tD: 56,
                N9: 0,
                FE: 3,
                DC: 316,
                K2: 174,
                uc: 5
            },
            VX: [{
                jY: "#FC0060"
            }, {
                UG: 1,
                jY: "#FF0303",
                X5: [5, 6, 7, 8, 9],
                zC: [84, 84],
                OM: 0
            }, {
                UG: 1,
                jY: "#A90303",
                X5: [0, 1, 2, 3, 4],
                zC: [16, 14],
                OM: 0
            }, {
                UG: 1,
                jY: "#03FCFC",
                X5: [10, 11, 12, 13, 14],
                zC: [148, 148],
                OM: 0
            }, {
                UG: 1,
                jY: "#F99797",
                X5: [0, 6, 12, 8, 4],
                zC: [6, 0],
                OM: -8
            }, {
                UG: 1,
                jY: "#FC03FC",
                X5: [10, 6, 2, 8, 14],
                zC: [158, 164],
                OM: 8
            }, {
                UG: 1,
                jY: "#0303FC",
                X5: [0, 1, 7, 13, 14],
                zC: [26, 140],
                OM: 0
            }, {
                UG: 1,
                jY: "#034A81",
                X5: [10, 11, 7, 3, 4],
                zC: [138, 33],
                OM: 0
            }, {
                UG: 1,
                jY: "#03B2EB",
                X5: [5, 1, 7, 13, 9],
                zC: [92, 72],
                OM: 6
            }, {
                UG: 1,
                jY: "#A9A803",
                X5: [5, 11, 7, 3, 9],
                zC: [76, 96],
                OM: -6
            }, {
                UG: 1,
                jY: "#FBA507",
                X5: [0, 6, 7, 8, 14],
                zC: [36, 131],
                OM: -4
            }, {
                UG: 1,
                jY: "#820386",
                X5: [10, 6, 7, 8, 4],
                zC: [128, 6],
                OM: 4
            }, {
                UG: 1,
                jY: "#FFE503",
                X5: [5, 1, 2, 8, 14],
                zC: [68, 115],
                OM: -5
            }, {
                UG: 1,
                jY: "#03A803",
                X5: [5, 11, 12, 8, 4],
                zC: [100, 47],
                OM: 0
            }, {
                UG: 1,
                jY: "#FECA53",
                X5: [5, 6, 2, 8, 14],
                zC: [60, 131],
                OM: -20
            }, {
                UG: 1,
                jY: "#7F035F",
                X5: [5, 6, 12, 8, 4],
                zC: [108, 38],
                OM: 20
            }, {
                UG: 0,
                jY: "#5CA490",
                X5: [9, 13, 7, 1, 0],
                zC: [79, 19],
                OM: -6
            }, {
                UG: 0,
                jY: "#F2035D",
                X5: [9, 3, 7, 11, 10],
                zC: [89, 154],
                OM: 6
            }, {
                UG: 0,
                jY: "#0383D3",
                X5: [14, 13, 7, 1, 5],
                zC: [126, 66],
                OM: 12
            }, {
                UG: 0,
                jY: "#A7A5D8",
                X5: [4, 3, 7, 11, 5],
                zC: [28, 93],
                OM: -12
            }, {
                UG: 0,
                jY: "#6B2091",
                X5: [14, 8, 2, 1, 0],
                zC: [136, 3],
                OM: 4
            }, {
                UG: 0,
                jY: "#B240FF",
                X5: [4, 8, 12, 11, 10],
                zC: [18, 145],
                OM: -4
            }, {
                UG: 0,
                jY: "#0AE500",
                X5: [14, 13, 12, 6, 0],
                zC: [163, 20],
                OM: 5
            }, {
                UG: 0,
                jY: "#C7C7C7",
                X5: [4, 3, 2, 6, 10],
                zC: [8, 135],
                OM: -5
            }, {
                UG: 0,
                jY: "#03D76D",
                X5: [4, 8, 2, 6, 0],
                zC: [38, 35],
                OM: -12
            }, {
                UG: 0,
                jY: "#FCB972",
                X5: [14, 8, 12, 6, 10],
                zC: [154, 156],
                OM: 12
            }, {
                UG: 0,
                jY: "#CC78F6",
                X5: [4, 8, 7, 6, 0],
                zC: [48, 41],
                OM: 9
            }, {
                UG: 0,
                jY: "#A39007",
                X5: [14, 8, 7, 6, 10],
                zC: [117, 131],
                OM: -9
            }, {
                UG: 0,
                jY: "#848BC1",
                X5: [9, 3, 2, 1, 5],
                zC: [69, 80],
                OM: -9
            }, {
                UG: 0,
                jY: "#ADE503",
                X5: [9, 13, 12, 11, 5],
                zC: [99, 97],
                OM: 9
            }, {
                UG: 0,
                jY: "#739CF1",
                X5: [14, 8, 2, 6, 0],
                zC: [144, 8],
                OM: 0
            }],
            Uo: ["uZ", "R0", "xY", "HP"]
        },
        xX = (function() {
            var UC = [1, 2, 3, 4, 5].map(function() {
                return fQ.GG
            });
            return function(uf) {
                return fQ.uY.map(function(Ey, Y7) {
                    return uf[fQ.kW[Y7]] || UC[Math.floor(Y7 % 5)].getRandom()
                })
            }
        })();
    fQ.k0 = DW.IH.map(function(bg, Ey) {
        var TN = fQ.VX[Ey];
        return bg && (new Element("div", {
            "class": "fJ"
        })).adopt(new Element("img", {
            src: bg,
            "class": "TH"
        }))
    });
    var HI = null;
    var vY = function() {
            this.TZ.PV();
            this.q4.lU();
            this.gj.ex(0)
        },
        QI = function() {
            this.yi.f7(0)
        },
        hL = function() {
            var Bd = this.gQ.uS();
            Bd.BetPerPattern[ro] = ro.K7(this.TZ.N2());
            this.gQ.Nb(Bd);
            this.dJ(1)
        },
        bs = function(jr) {
            this.b8.yJ(iM(jr));
            this.HL.rC(this.rW());
            this.dJ(1)
        };
    var am = function() {
        this.HS.eG(0);
        this.TZ.ex(0);
        clearInterval(HI);
        this.q4.lU();
        this.q4.m5().removeClass("iI");
        this.q4.m5().removeClass("xt");
        this.CN()
    };
    return new Class({
        Extends: J2,
        Implements: Events,
        Binds: ["kP", "qM", "s_", "qd"],
        fd: 0,
        HQ: 0,
        T_: 0,
        DJ: function() {
            var DK = this,
                Bd = this.gQ.uS();
            this.VC = (new zo({
                Vs: "VC",
                vL: "Cm",
                s8: Ki("Game.mboxHowToPlay").length,
                hY: 1
            })).addEvents({
                cH: this.s_,
                cV: d9.lK,
                TY: d9.bB
            });
            com.igt.mxf.registerControl({
                type: "command",
                name: "howToPlay",
                text: Ki("MenuCommand.howToPlay"),
                enabled: 1
            }).addEvent("change", this.VC.ex.bind(this.VC, 1));
            this.eR = (new zo({
                Vs: "eR",
                vL: "Cm",
                s8: Ki("Game.mboxPaytable").length,
                hY: 1
            })).addEvents({
                cH: this.qd,
                cV: d9.lK,
                TY: d9.bB
            });
            com.igt.mxf.registerControl({
                type: "command",
                name: "paytable",
                text: Ki("MenuCommand.payTable"),
                enabled: 1
            }).addEvent("change", this.eR.ex.bind(this.eR, 1));
            [this.VC, this.eR].forEach(function(YR) {
                document.body.grab(L6.nS(YR), "top")
            }, this);
            this.q4 = new UZ({
                Vs: "s4"
            });
            this.HS = new bO(fQ.VX, {
                jd: fQ.jd,
                k0: fQ.k0,
                kW: fQ.kW,
                wd: this.UY.PatternSliderInfo.PatternInfo.Step,
                hR: this.LU.PatternSliderInput.PatternsBet,
                ww: "#000",
                aL: 3,
                CJ: 4,
                Q4: "#0089cc"
            });
            this.yN = (new yN({
                jd: fQ.jd,
                M2: "i7",
                UB: 5,
                qE: 360,
                q2: 60,
                N3: 300,
                Tf: false,
                uY: fQ.uY,
                aU: 40
            })).addEvents({
                uR: this.kP.bind(this),
                mS: this.rL.bind(this)
            });
            this.HL = new vX({
                jx: new Element("span")
            });
            com.igt.mxf.registerControl({
                type: "stake",
                name: "stake",
                text: Ki("Game.consoleBet"),
                enabled: 0,
                valueText: iM(0),
                value: 0
            }).linkEvent("change", this.HL, "cM");
            this.xx = new vX({
                jx: new Element("span")
            });
            this.UO = new vX({
                jx: new Element("span"),
                lA: Math.floor
            });
            this.cW = new vX({
                jx: new Element("span"),
                lA: Math.floor
            });
            this.F4 = new vX({
                jx: new Element("span"),
                AM: this.LU.OutcomeDetail.Balance,
                Sv: 20
            });
            com.igt.mxf.registerControl({
                type: "balance",
                name: "totalBalance",
                text: Ki("Game.consoleBalance"),
                enabled: 1,
                valueText: iM(this.LU.OutcomeDetail.Balance),
                value: ro.K7(this.LU.OutcomeDetail.Balance)
            }).addEvent("change", function(jr) {
                jr = jr >= 0 ? jr : 0;
                this.F4.rC(ro.rQ(jr));
                this.LU.OutcomeDetail.Balance = this.F4.N2();
                this.dJ(1)
            }.bind(this));
            this.yi = (new eT({
                Vs: "VP",
                SK: Ki("Game.buttonSpin"),
                Xl: 0
            })).addEvents({
                z7: am.bind(this)
            });
            this.b8 = (new eT({
                Vs: "CR",
                Xl: 0
            })).addEvents({
                Db: vY.bind(this)
            }).p9((new Element("div", {
                "class": "Hi"
            })).adopt(new Element("div", {
                html: Ki("Game.buttonBetPerPattern")
            })));
            this.TZ = new SZ({
                Vs: "xe",
                VT: this.UY.PatternSliderInfo.BetInfo.Step,
                Ym: iM,
                LE: Ki("Game.selectorBetPerPattern") + " ",
                UA: {
                    Sl: "#555",
                    Ht: 1
                }
            }).addEvents({
                cM: bs.bind(this),
                DH: QI.bind(this),
                xZ: hL.bind(this)
            });
            var w4 = com.igt.mxf.registerControl({
                type: "list",
                name: "betPerPattern",
                text: Ki("Game.buttonBetPerPattern"),
                enabled: 0,
                value: ro.rQ(Bd.BetPerPattern[ro]).toString(),
                valueText: this.UY.PatternSliderInfo.BetInfo.Step.map(iM),
                values: this.UY.PatternSliderInfo.BetInfo.Step
            }).addEvent("change", function(jr) {
                if (this.b8.f7) {
                    this.TZ.rC(jr)
                }
            }.bind(this)).linkEvent("change", this.TZ, "cM").linkEvent("enable", this.b8, "f7");
            this.Wt = new Element("div", {
                id: "Oa"
            }).adopt(new Element("div", {
                "class": "Hi"
            }).adopt(new Element("div", {
                html: Ki("Game.buttonPatternsBet")
            }), new Element("number", {
                html: "30"
            })));
            this.gj = (new Jl({
                Vs: "GM",
                c5: new Element("currency")
            })).p9((new Element("div", {
                "class": "Hi"
            })).adopt(new Element("div", {
                html: Ki("Game.boxWin")
            })));
            Jl.PR(this.gj);
            this.TZ.rC(ro.rQ(Bd.BetPerPattern[ro]).toString());
            this.tK = new eT({
                Vs: "v9",
                Xl: 1,
                SK: Ki("Game.buttonSkip")
            });
            this.WJ = new eT({
                Vs: "Yu",
                Xl: 1,
                SK: Ki("Game.buttonStart")
            }).addEvents({
                z7: function() {
                    if (!iP.N_.mJ("tR")) {
                        iP.N_.Zz("tR", Infinity)
                    }
                }
            });
            this.E1 = rm();
            this.jx.adopt(new Element("div", {
                id: "OQ"
            }), (new Element("div", {
                id: "bw"
            })).adopt(new Element("div", {
                id: "K0"
            })), (new Element("div", {
                id: "bN"
            })).adopt(this.AV, new Element("div", {
                id: "hy"
            }), (new Element("div", {
                id: "tx",
                styles: {
                    backgroundImage: N8.Aq == "Lm" ? "" : "none"
                }
            })).adopt(this.yN), new Element("div", {
                id: "KE"
            }), this.HS, this.E1), this.q4, new Element("div", {
                id: "PZ"
            }), this.TZ, (new Element("div", {
                id: "tz"
            })).adopt((new Element("div", {
                id: "b3"
            })).adopt((new Element("div", {
                "class": "e2"
            })).adopt(this.Wt, this.gj), this.b8, this.yi, this.tK, this.WJ)), new Element("div", {
                id: "Wf"
            }).adopt(new Element("div", {
                id: "mM",
                "class": "pU"
            }).adopt(new Element("span", {
                "class": "Hi",
                text: Ki("Game.consoleBalance")
            }), this.F4), new Element("div", {
                id: "yv",
                "class": "pU"
            }).adopt(new Element("hr"), new Element("span", {
                "class": "Hi",
                text: Ki("Game.consoleBet")
            }), this.HL), new Element("div", {
                id: "U6",
                "class": "pU"
            }).adopt(new Element("hr"), new Element("span", {
                "class": "Hi",
                text: Ki("Game.consoleBonus")
            }), this.xx), new Element("div", {
                id: "tB",
                "class": "pU"
            }).adopt(new Element("hr"), new Element("span", {
                "class": "Hi",
                text: Ki("Game.consoleSpins")
            }), this.UO, new Element("span", {
                text: "/"
            }), this.cW)));
            this.Ky();
            this.T_ = 1;
            if (this.LU.OutcomeDetail.Stage == "FreeSpin" && this.LU.OutcomeDetail.NextStage == "FreeSpin") {
                document.body.addClass("KI");
                this.q4.Qo(Ki("Game.freeSpinPrompt"));
                this.q4.m5().addClass("xt");
                this.LU.PrizeOutcome["FreeSpin.Total"] && this.xx.rC(this.LU.PrizeOutcome["FreeSpin.Total"]);
                this.UO.rC(this.LU.FreeSpinOutcome.Count);
                this.cW.rC(this.LU.FreeSpinOutcome.TotalAwarded);
                this.LU.OutcomeDetail.Stage = "FreeSpin";
                this.WJ.ex(1);
                this.dJ(0)
            } else {
                document.body.addClass("hI");
                if (this.LU.OutcomeDetail.NextStage == "FreeSpin") {
                    this.mF.kc()
                } else {
                    iP.N_.Zz("C1");
                    var Eh = Ki("Game.marketingMessages").split("|");
                    if (Eh.length > 0) {
                        var c = 1;
                        HI = setInterval(function() {
                            DK.q4.m5().addClass("iI");
                            DK.q4.Qo(Ki(Eh[c], "#fff"));
                            c++;
                            if (c >= Eh.length) {
                                c = 0
                            }
                        }, 5000);
                        this.q4.m5().addClass("iI");
                        this.q4.Qo(Ki(Eh[0], "#fff"))
                    }
                    this.dJ(1)
                }
            }
            this.yN.Nv(this.LU.PopulationOutcome[this.LU.OutcomeDetail.Stage + ".Reels"].X5)
        },
        Ky: function() {
            var DK = this,
                NW = function() {
                    return DK.LU.PrizeOutcome[DK.uB + ".Lines"]["@totalPay"] + DK.LU.PrizeOutcome[DK.uB + ".Scatter"]["@totalPay"]
                },
                C4 = function(A_, jY) {
                    DK.q4.jl("color", jY || "#fff").Qo(A_ || "")
                },
                s6 = new Mq((new hS({
                    n3: 1200
                })).addEvents({
                    QQ: function() {
                        var Vm = DK.uB == "BaseGame" ? DK.LU.PrizeOutcome["Game.Total"] : NW(),
                            K8 = DK.LU.PrizeOutcome[DK.uB + ".Lines"]["Prize"];
                        if (DK.KP(DK.LU, DK.uB)) {
                            C4(MM("Game.winPaid", iM(Vm)), "#fff")
                        }
                        DK.HS.k5(DK.LU.PrizeOutcome[DK.uB + ".Lines"].Prize).eG(1)
                    },
                    rA: function() {
                        DK.HS.eG(0)
                    },
                    zL: function() {
                        DK.HS.eG(0)
                    }
                }), function() {
                    var ow = DK.LU.PrizeOutcome[DK.uB + ".Lines"].Prize.length;
                    if (ow == 0 && DK.LU.OutcomeDetail.Stage.match(/^FreeSpin/) && DK.uB == "BaseGame") {
                        return DK.LU.PrizeOutcome["FreeSpin.Total"] > 0
                    }
                    return ow > 0
                }),
                Tk = new Mq((new LK(null, {
                    vK: "backgroundPositionX",
                    gF: Array.bY(1, 12, 12, -fQ.jd.tD),
                    eg: "px",
                    B1: 100,
                    QT: 2
                })).addEvents({
                    QQ: function() {
                        var A8 = DK.LU.PrizeOutcome[DK.uB + ".Scatter"],
                            lP = DK.LU.PrizeOutcome[DK.uB + ".Lines"],
                            O9, ZX = "Rg",
                            XG = A8.Prize,
                            Vw = 0,
                            MN = (DK.uB == "BaseGame" && XG.length) ? XG[0]["@payName"] : "",
                            D6 = DK.LU.OutcomeDetail.Stage.match(/^BaseGame/) && DK.LU.OutcomeDetail.NextStage == "FreeSpin";
                        if (DK.LU.OutcomeDetail.Stage.match(/^BaseGame/)) {
                            Vw = MN.match(/^[0-9]/);
                            if (Vw == 4) {
                                ZX = "wv"
                            } else {
                                if (Vw > 4) {
                                    ZX = "nA"
                                }
                            }
                            iP.N_.Zz(ZX)
                        }
                        if (!D6) {
                            if (!DK.KP(DK.LU, DK.uB)) {
                                C4(MM(DK.uB == "BaseGame" ? "Game.totalWin" : "Game.bonusWin", iM(DK.uB == "BaseGame" ? DK.LU.PrizeOutcome["Game.Total"] : NW())), "#fff")
                            }
                            O9 = DK.yN.QD(A8.KW.concat(lP.KW))
                        } else {
                            O9 = DK.yN.QD(A8.yB.concat(lP.yB));
                            O9.addClass("ht");
                            this.QT = 1
                        }
                        this.QP(O9)
                    },
                    rA: function() {
                        if (D6 = DK.LU.OutcomeDetail.Stage.match(/^BaseGame/) && DK.LU.OutcomeDetail.NextStage == "FreeSpin") {
                            cP.kc()
                        }
                    }
                }), function() {
                    return !(DK.LU.OutcomeDetail.Stage.match(/^FreeSpin/) && DK.uB == "BaseGame")
                }),
                cP = (function() {
                    var O9;
                    return new CG(new Mq(new hS({
                        n3: 1200
                    }).addEvents({
                        rA: function() {
                            iP.N_.Zz("tR", Infinity)
                        },
                        tH: function() {
                            iP.N_.Zz("tR", Infinity)
                        }
                    }), function() {
                        return DK.LU.OutcomeDetail.Stage == "BaseGame" && DK.LU.OutcomeDetail.NextStage == "FreeSpin"
                    }), new LK(null, {
                        vK: "backgroundPositionX",
                        gF: Array.bY(1, 12, 12, -fQ.jd.tD),
                        eg: "px",
                        B1: 100,
                        QT: 0
                    }).addEvents({
                        QQ: function() {
                            var A8 = DK.LU.PrizeOutcome[DK.uB + ".Scatter"],
                                lP = DK.LU.PrizeOutcome[DK.uB + ".Lines"];
                            O9 = DK.yN.QD(A8.yB.concat(lP.yB));
                            O9.removeClass("ht");
                            O9.addClass("Cp");
                            this.QP(O9)
                        },
                        zL: function() {
                            O9.removeClass("Cp");
                            this.QP(new Elements())
                        }
                    }))
                })(),
                WP = (function() {
                    var hC = function() {
                            if (oj) {
                                DK.HS.eG(0);
                                oj.Au.jl("opacity", 1);
                                oj.NZ.removeClass("PC")
                            }
                        },
                        ow = [],
                        oj, ji = DK.yN.toElement();
                    return (new LK(null, {
                        vK: "backgroundPositionX",
                        gF: Array.bY(1, 12, 12, -fQ.jd.tD),
                        eg: "px, 0px, 0px",
                        B1: 120
                    })).addEvents({
                        QQ: function() {
                            var O9, A8 = DK.LU.PrizeOutcome[DK.uB + ".Scatter"],
                                lP = DK.LU.PrizeOutcome[DK.uB + ".Lines"];
                            ow = A8.Prize.concat(lP.Prize);
                            ow.sort(function(Kx, V3) {
                                return Kx["@totalPay"] == 0 ? 1 : V3["@totalPay"] == 0 ? -1 : V3["@totalPay"] - Kx["@totalPay"] || Kx.Cy - V3.Cy
                            });
                            oj = 0;
                            this.mj(ow.length);
                            this.fireEvent("sS")
                        },
                        VU: function(EN, qL) {
                            qL % 3 || oj.Au.jl("opacity", qL % 6 ? 0.5 : 1)
                        },
                        sS: function() {
                            var c1 = DK.LU.OutcomeDetail.Stage == "FreeSpin" && DK.LU.OutcomeDetail.NextStage == "BaseGame",
                                X5 = DK.LU.PopulationOutcome[DK.uB + ".Reels"].X5,
                                AI;
                            oj && hC.call(this);
                            oj = ow.shift();
                            oj.NZ = DK.yN.QD(oj.X1.filter(function(Ey) {
                                return "w01" == X5[Ey]
                            }));
                            oj.Au = DK.yN.QD(oj.X1.filter(function(Ey) {
                                return "w01" != X5[Ey]
                            }));
                            this.QP(oj.NZ);
                            oj.fF = oj.X1.some(function(B_) {
                                return oj.X1.length == 2 ? fQ.Uz[X5[B_]] : fQ.u1[X5[B_]]
                            }) && oj.X1.filter(function(B_) {
                                return fQ.Uz[X5[B_]]
                            });
                            DK.HS.Vg(oj).eG(1);
                            AI = oj["@totalPay"] + (oj.Cy == 0 && c1 && DK.LU.PrizeOutcome["FreeSpin.Total"]);
                            var Qx = MM(oj.Cy ? "Game.lineWin" : c1 ? "Game.freeSpinWin" : "Game.scatterWin", iM(AI));
                            if (AI == 0 && c1) {
                                Qx = Ki("Game.freeSpinComplete")
                            }
                            C4(Qx, oj.x2.jY);
                            oj.NZ.addClass("PC");
                            fQ.u1[oj.jA] ? ji.addClass("WF") : ji.removeClass("WF")
                        },
                        rA: function() {
                            oj && hC.call(this);
                            Fn.mj(5)
                        },
                        zL: function() {},
                        fi: function() {
                            oj && hC.call(this);
                            ow = 0;
                            Fn.mj(1)
                        }
                    })
                })(),
                JF = (new Mq((new hS({
                    n3: 4000
                })).addEvents({
                    QQ: function() {
                        DK.AV.Qo(Ki("Game.capFreeSpin")).ex(1)
                    },
                    rA: function() {
                        DK.AV.ex(0)
                    }
                }), function() {
                    return DK.LU.FreeSpinOutcome.IncrementTriggered == "true" && DK.LU.FreeSpinOutcome.MaxAwarded == "true"
                })),
                Rh = new Mq(new hS({
                    n3: 2000
                }), function() {
                    return DK.LU.FreeSpinOutcome.IncrementTriggered == "true" && DK.LU.FreeSpinOutcome.MaxAwarded == "false"
                }),
                Kh = DK.E1.Z2(),
                Fn = this.E1.Rn(),
                J9 = Kh.Rn().addEvents({
                    rA: function() {
                        Kh.rC(DK.LU.PrizeOutcome["Game.Total"])
                    }
                }),
                Lw = new Mq(new q9(new hS({
                    n3: 500
                }), new CG(new hS({
                    n3: 8000
                }), Fn.addEvents({
                    QQ: N8.Aq == "p5" ? function() {
                        DK.gj.cg(iM(DK.LU.PrizeOutcome["Game.Total"])).ex(1);
                        Kh.rC(DK.LU.PrizeOutcome["Game.Total"]);
                        C4(Ki("Game.bigWinStatus"), "#fff")
                    } : function() {
                        DK.gj.cg(iM(DK.LU.PrizeOutcome["Game.Total"])).ex(1);
                        C4(Ki("Game.bigWinStatus"), "#fff");
                        Kh.rC(0);
                        Kh.kg(DK.LU.PrizeOutcome["Game.Total"], DK.LU.PatternSliderInput.BetPerPattern * DK.LU.PatternSliderInput.PatternsBet);
                        J9.kc()
                    }
                }))).addEvents({
                    QQ: function() {
                        if (DK.uB == "BaseGame") {
                            iP.N_.Zz("W1")
                        }
                    }
                }), function() {
                    return DK.KP(DK.LU, DK.uB)
                }),
                EC = new Mq((new q9(Tk, Lw, s6, WP, this.xx.Rn(), this.F4.Rn().addEvents({
                    QQ: function() {
                        var Vm = DK.uB == "BaseGame" ? DK.LU.PrizeOutcome["Game.Total"] : NW();
                        C4(!(DK.LU.OutcomeDetail.NextStage.match(/^BaseGame/) && DK.uB == "FreeSpin") ? MM(Vm ? "Game.winPaid" : "Game.gameOver", iM(Vm)) : "", "#fff")
                    }
                }))).addEvents({
                    QQ: function() {
                        DK.tK.ex(1)
                    },
                    zL: function() {
                        DK.tK.ex(0);
                        WP.fireEvent("fi");
                        if (DK.uB == "BaseGame") {
                            iP.N_.bm()
                        }
                    },
                    rA: function() {
                        DK.tK.ex(0)
                    }
                }), function() {
                    if (DK.LU.OutcomeDetail.Stage.match(/^FreeSpin/) && DK.uB == "BaseGame") {
                        return DK.LU.AwardCapOutcome.AwardCapExceeded == "false" && (NW() + DK.LU.PrizeOutcome["FreeSpin.Total"])
                    }
                    return DK.LU.AwardCapOutcome.AwardCapExceeded == "false" && NW()
                }),
                Uc = new Mq((DK.AV.HX("xZ")).addEvents({
                    QQ: function() {
                        iP.N_.bm();
                        DK.AV.Qo(MM("Game.capAward", xV(DK.LU.PrizeOutcome["Game.Total"]))).Bs("LC", new eT({
                            SK: Ki("Game.buttonOk"),
                            Xl: 1
                        })).ex(1)
                    }
                }), function() {
                    return DK.LU.AwardCapOutcome.AwardCapExceeded == "true"
                }),
                a7 = (new CG(EC, new hS({
                    n3: 1000
                }))).addEvents({
                    QQ: function() {
                        DK.xx.kg(DK.LU.PrizeOutcome["FreeSpin.Total"], DK.LU.PatternSliderInput.BetPerPattern * DK.LU.PatternSliderInput.PatternsBet)
                    },
                    rA: function() {
                        DK.xx.rC(DK.LU.PrizeOutcome["FreeSpin.Total"])
                    }
                }),
                Tt = (new hS({
                    n3: 2000
                })).addEvents({
                    rA: function() {
                        DK.yN.Nv(DK.LU.PopulationOutcome[DK.LU.OutcomeDetail.NextStage + ".Reels"].X5);
                        DK.UO.rC(DK.LU.FreeSpinOutcome.Count);
                        DK.cW.rC(DK.LU.FreeSpinOutcome.TotalAwarded);
                        DK.xx.rC(0);
                        document.body.toggleClass("KI");
                        document.body.toggleClass("hI");
                        document.body.offsetWidth;
                        DK.uB = DK.LU.OutcomeDetail.NextStage;
                        if (DK.LU.OutcomeDetail.NextStage == "BaseGame" && DK.LU.OutcomeDetail.Stage == "FreeSpin") {
                            iP.N_.bm()
                        }
                    },
                    QQ: function() {
                        cP.SM();
                        DK.q4.lU("")
                    }
                });
            this.c4 = (new q9(Uc, EC)).addEvents({
                QQ: function() {
                    DK.F4.kg(DK.LU.OutcomeDetail.Balance, DK.LU.PatternSliderInput.BetPerPattern * DK.LU.PatternSliderInput.PatternsBet);
                    if (!DK.KP(DK.LU, DK.uB)) {
                        var Vm = DK.uB == "BaseGame" ? DK.LU.PrizeOutcome["Game.Total"] : NW();
                        C4(MM(Vm ? "Game.winPaid" : "Game.gameOver", iM(Vm)), "#fff");
                        if (!Vm) {
                            iP.N_.bm();
                            var Eh = Ki("Game.marketingMessages").split("|");
                            if (Eh.length > 0) {
                                var c = 1;
                                var mC = 0;
                                HI = setInterval(function() {
                                    if (c % 2 == 0) {
                                        DK.q4.m5().removeClass("iI");
                                        C4(Ki("Game.gameOver", "#fff"))
                                    } else {
                                        DK.q4.m5().addClass("iI");
                                        C4(Ki(Eh[mC], "#fff"));
                                        mC++
                                    }
                                    c++;
                                    if (c >= (Eh.length * 2 + 1)) {
                                        c = mC = 0
                                    }
                                }, 5000)
                            } else {
                                C4(Ki("Game.gameOver", "#fff"))
                            }
                        } else {
                            DK.gj.cg(iM(Vm)).ex(1)
                        }
                    }
                },
                rA: function() {
                    var Vm = DK.uB == "BaseGame" ? DK.LU.PrizeOutcome["Game.Total"] : NW();
                    Vm && C4(MM("Game.winPaid", iM(Vm)), "#fff");
                    DK.F4.rC(DK.LU.OutcomeDetail.Balance);
                    DK.tK.ex(0);
                    DK.Ks()
                }
            });
            this.tK.addEvent("z7", function() {
                EC.SM()
            });
            this.a7 = (new q9(JF, Rh, a7)).addEvents({
                rA: function() {
                    DK.eV()
                }
            });
            this.tK.addEvent("z7", function() {
                EC.SM()
            });
            this.mF = (new q9(Tk)).addEvents({
                rA: function() {
                    DK.WJ.ex(1);
                    C4(Ki("Game.freeSpinPrompt"));
                    DK.q4.m5().addClass("xt")
                }
            });
            this.WJ.addEvents({
                z7: function() {
                    DK.WJ.ex(0);
                    C4();
                    DK.ZJ()
                }
            });
            this.WN = function() {
                DK.LU.OutcomeDetail.Stage == "BaseGame" ? DK.Ta.kc() : am.call(this)
            };
            var kT = new Element("div", {
                id: "iT"
            });
            var Yx = (new Element("div", {
                id: "Wb"
            })).adopt(kT).mI({
                visibility: "hidden",
                transform: hA.VK.Bq(0.01, 0.01)
            });
            this.jx.adopt(Yx);
            var x5 = Yx.HX("transitionend").addEvents({
                QQ: function() {
                    Yx.jl("transform", hA.VK.Bq(1, 1))
                }
            });
            var zZ = Yx.HX("transitionend").addEvents({
                QQ: function() {
                    Yx.jl("opacity", 0)
                },
                rA: function() {
                    Yx.mI({
                        visibility: "hidden",
                        transform: hA.VK.Bq(0.01, 0.01),
                        opacity: 1,
                        transition: ""
                    })
                }
            });
            this.Ta = (new q9(x5, Tt, zZ)).addEvents({
                QQ: function() {
                    kT.set("gA", MM("Game.bonusWelcome", "<number>" + DK.LU.FreeSpinOutcome.TotalAwarded + "</number>"), 0);
                    Yx.mI({
                        visibility: "visible",
                        transition: "-webkit-transform 1s ease-out, opacity 0.7s ease-in"
                    })
                },
                rA: function() {
                    DK.eV()
                }
            });
            this.XA = (new q9(a7, x5, Tt, zZ, this.c4).addEvents({
                QQ: function() {
                    if (DK.LU.PrizeOutcome["FreeSpin.Total"] > 0) {
                        kT.set("gA", Ki("Game.bonusWinComplete") + "<currency>" + xV(DK.LU.PrizeOutcome["FreeSpin.Total"]) + "</currency>")
                    } else {
                        kT.set("gA", Ki("Game.bonusComplete"))
                    }
                    Yx.mI({
                        visibility: "visible",
                        transition: "-webkit-transform 1s ease-out, opacity 0.7s ease-in"
                    })
                }
            }))
        },
        s_: function(LY) {
            this.VC.zM(1).Qo(Ki("Game.mboxHowToPlay")[LY])
        },
        qd: (function() {
            var rl, Sk = J2.tL,
                kd = iX.gG(iX.WD(fQ.GG.Lc(), function(Ey, ef) {
                    return '<img class="' + ef + '"/>'
                })),
                zT = function(LY) {
                    var A_ = Elements.e3(Ki("Game.mboxPaytable")[LY].substitute(kd)),
                        AH = (new Element("div")).adopt(A_),
                        H9 = AH.querySelector("winlinediagrams");
                    H9 && H9.adopt(fQ.VX.map(function(zC, jG) {
                        return zC.X5 && this.J7(11, 11, zC, jG)
                    }, this.HS));
                    rl[LY] = AH.getChildren()
                };
            return function(LY) {
                var DK, DQ;
                if (rl) {
                    rl[LY] || zT.call(this, LY);
                    this.eR.zM(1).Qo(rl[LY])
                } else {
                    this.Ip(function(sK) {
                        rl = [];
                        iX.gG(this.UY, sK.Paytable);
                        this.UY.PaytableStatistics.toString = function() {
                            return Ki(this["@minRTP"] == this["@maxRTP"] ? "Paytable.RTPvalue" : "Paytable.RTPrange", this).substitute(this)
                        };
                        kd.RTP = this.UY.PaytableStatistics;
                        kd.awardCap = xV(ro.rQ(Sk.qh(sK.Paytable.AwardCapInfo)));
                        return this.qd(LY)
                    }.bind(this))
                }
            }
        })(),
        Tw: function(Y_) {
            iX.E7(Y_.PatternSliderInfo, function(Ou) {
                Ou.Step = Array.CZ(Ou.Step)
            });
            this.UY = Y_
        },
        KP: function(LU, uB) {
            return LU.AwardCapOutcome.AwardCapExceeded != "true" && LU.OutcomeDetail.Payout >= LU.OutcomeDetail.Settled * 10 && LU.OutcomeDetail.Settled > 0 && uB === "BaseGame"
        },
        ZT: function(sK) {
            sK.PopulationOutcome = J2.tL.Mi(Array.CZ(sK.PopulationOutcome).map(function(ES) {
                ES.X5 = xX(ES["#text"].split(","));
                delete ES["#text"];
                return ES
            }))
        },
        JC: function(sK) {
            var Sk = J2.tL;
            sK.PrizeOutcome = Sk.Mi(Array.CZ(sK.PrizeOutcome));
            ["BaseGame.Lines", "FreeSpin.Lines", "BaseGame.Scatter", "FreeSpin.Scatter"].forEach(function(bX) {
                sK.PrizeOutcome[bX] = sK.PrizeOutcome[bX] || {}
            });
            iX.E7(sK.PrizeOutcome, function(uU) {
                uU["@totalPay"] = Sk.qh(uU["@totalPay"]);
                uU.KW = [];
                uU.yB = [];
                uU.a_ = {};
                uU.Prize = Array.CZ(uU.Prize).map(function(qY) {
                    uU.a_[qY["@name"]] = qY.X1 = [];
                    qY["@totalPay"] = Sk.qh(qY["@totalPay"]);
                    qY.Cy = fQ.kp[qY["@name"]] || 0;
                    qY.x2 = fQ.VX[qY.Cy];
                    qY.jA = qY["@payName"].split(" ")[1];
                    return qY
                })
            });
            Array.CZ(sK.HighlightOutcome).forEach(function(uU) {
                var IF = sK.PrizeOutcome[uU["@name"]];
                IF && Array.CZ(uU.Highlight).forEach(function(bp) {
                    var g5 = IF && IF.a_[bp["@name"]];
                    if (g5) {
                        [].push.apply(g5, bp["#text"].split(",").Sp(fQ.Ib));
                        IF.KW.combine(g5);
                        IF["@totalPay"] == 0 && IF.yB.combine(g5)
                    }
                })
            });
            delete sK.HighlightOutcome;
            sK.OutcomeDetail.Balance = Sk.qh(sK.OutcomeDetail.Balance);
            sK.OutcomeDetail.Payout = Sk.qh(sK.OutcomeDetail.Payout);
            if (sK.FreeSpinOutcome) {
                sK.FreeSpinOutcome.Count = Sk.q5(sK.FreeSpinOutcome.Count);
                sK.FreeSpinOutcome.TotalAwarded = Sk.q5(sK.FreeSpinOutcome.TotalAwarded)
            }
            if (sK.PrizeOutcome["Game.Total"]) {
                IF = sK.PrizeOutcome;
                IF["Game.Total"] = IF["Game.Total"]["@totalPay"];
                if (IF["FreeSpin.Total"]) {
                    IF["FreeSpin.Total"] = sK.AwardCapOutcome && sK.AwardCapOutcome.AwardCapExceeded == "true" ? IF["Game.Total"] : IF["FreeSpin.Total"]["@totalPay"]
                }
            }
            this.uB = sK.OutcomeDetail.Stage
        },
        Dw: function(oa) {
            this.uC = sK.PopulationOutcome[this.uB + ".Reels"].X5;
            this.U9 = sK.PrizeOutcome[this.uB + ".Lines"];
            this.Bi = sK.PrizeOutcome[this.uB + ".Lines"]
        },
        Wk: function(f7) {
            var zB = f7 && this.LU.OutcomeDetail.NextStage == "BaseGame";
            zB && this.F4.rC(this.LU.OutcomeDetail.Balance);
            this.b8.f7(zB && 0 < this.F4.N2());
            this.yi.f7(f7 && this.va() && !this.TZ.wz())
        },
        va: function() {
            var C9 = this.LU.OutcomeDetail.NextStage != "BaseGame" || 0 <= this.LU.OutcomeDetail.Balance - this.rW();
            C9 || this.AV.Qo(Ki("Error.insufficientFunds"));
            this.AV.ex(!C9);
            return C9
        },
        kP: function() {
            this.Rf({
                GameLogicRequest: {
                    ActionInput: {
                        Action: "play"
                    },
                    PatternSliderInput: {
                        BetPerPattern: this.TZ.N2(),
                        PatternsBet: this.LU.PatternSliderInput.PatternsBet
                    }
                }
            })
        },
        vR: function() {
            this.ZT(this.LU);
            this.UO.rC(this.LU.FreeSpinOutcome.Count);
            this.cW.rC(this.LU.FreeSpinOutcome.TotalAwarded);
            this.yN.Cl(this.LU.PopulationOutcome[this.LU.OutcomeDetail.Stage + ".Reels"].X5)
        },
        rW: function() {
            return this.TZ.N2() * this.LU.PatternSliderInput.PatternsBet
        },
        qM: function() {
            this.q4.lU();
            this.F4.rC(this.LU.OutcomeDetail.Balance - this.LU.OutcomeDetail.Payout);
            this.TZ.rC(this.LU.PatternSliderInput.BetPerPattern);
            if (this.LU.OutcomeDetail.Stage == "BaseGame") {
                this.LU.OutcomeDetail.NextStage == "FreeSpin" ? this.mF.kc() : this.c4.kc()
            } else {
                this.dJ(0);
                this.LU.OutcomeDetail.NextStage == "BaseGame" ? this.XA.kc() : this.a7.kc()
            }
        },
        qc: function() {
            this.q4.m5().removeClass("xt");
            this.gj.ex(0);
            this.dJ(0);
            if (!iP.N_.mJ("tR")) {
                iP.N_.Zz(this.LU.OutcomeDetail.NextStage == "FreeSpin" ? "tR" : fQ.Uo.AA(), Infinity)
            }
            if (this.LU.OutcomeDetail.NextStage == "BaseGame") {
                this.q4.jl("color", "#FFF").Qo(Ki("Game.goodLuck"));
                this.F4.rC(Math.max(0, this.F4.N2() - this.rW()))
            } else {
                this.q4.jl("color", "#fff").Qo(Ki("Game.playingBonusReels"))
            }
            this.yN.AP()
        },
        r2: function() {
            this.F4.rC(this.LU.OutcomeDetail.Balance - this.LU.OutcomeDetail.Payout)
        },
        KC: function() {
            iP.N_ && iP.N_.bm();
            this.VC && this.VC.ex(0);
            this.eR && this.eR.ex(0);
            this.OO && this.OO.SM()
        },
        iz: function() {
            this.yN && this.yN.TP();
            this.OO && this.OO.SM()
        },
        eV: function() {
            this.LU.OutcomeDetail.NextStage == "FreeSpin" ? this.qc() : this.dJ(1)
        }
    })
})();
