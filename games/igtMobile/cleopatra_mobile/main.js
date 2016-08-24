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
        if (newClass.O_) {
            return this
        }
        this.D0 = $empty;
        var value = (this.initialize) ? this.initialize.apply(this, arguments) : this;
        delete this.D0;
        delete this.caller;
        return value
    }.extend(this);
    newClass.implement(params);
    newClass.constructor = Class;
    newClass.prototype.constructor = newClass;
    return newClass
}
Function.prototype.protect = function() {
    this.AP = true;
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
        F.O_ = true;
        var proto = new F;
        delete F.O_;
        return proto
    },
    wrap: function(self, key, method) {
        if (method.yT) {
            method = method.yT
        }
        return function() {
            if (method.AP && this.D0 == null) {
                throw new Error('The method "' + key + '" cannot be called.')
            }
            var caller = this.caller,
                current = this.D0;
            this.caller = current;
            this.D0 = arguments.callee;
            var result = method.apply(this, arguments);
            this.D0 = current;
            this.caller = caller;
            return result
        }.extend({
            ud: self,
            yT: method,
            T_: key
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
                if (value.Ae) {
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
            var name = this.caller.T_,
                previous = this.caller.ud.parent.prototype[name];
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
            iE = -1,
            bg = events.length,
            fn;
        if (delay) {
            while (++iE < bg) {
                if (fn = events[iE]) {
                    setTimeout(function() {
                        fn.apply(this, args)
                    }, delay)
                }
            }
        } else {
            while (++iE < bg) {
                if (fn = events[iE]) {
                    fn.$bound ? fn.$bound.apply(fn.$boundObject, (fn.$boundArgs || []).concat(Array.prototype.slice.call(args))) : fn.apply(this, args)
                }
            }
        }
        return this
    },
    lV: function(type, args) {
        var events, iE = 0,
            bg, fn;
        if (!(events = this.$events) || !(events = events[type])) {
            return this
        }
        args = args === undefined ? [] : args instanceof Array ? args : [args];
        for (bg = events.length; iE < bg; ++iE) {
            if (fn = events[iE]) {
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
            var r1 = "r1=" + method;
            data = (data) ? r1 + "&" + data : r1;
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
    uP: function() {
        var Og = this,
            N8 = [].slice.call(arguments, 0);
        return function() {
            return Og.apply(this, N8.concat([].slice.call(arguments, 0)))
        }
    },
    qY: function(iE) {
        return function() {
            return arguments[iE]
        }
    },
    Nz: function() {
        var ht = this,
            N8 = arguments;
        return function() {
            var iE = N8.length,
                CQ = [];
            while (iE-- > 0) {
                CQ[iE] = arguments[N8[iE]]
            }
            ht.apply(this, CQ)
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
    TT: function(r1) {
        var N8 = Array.slice(arguments, 1),
            iE = -1,
            bg = this.length,
            dq = [];
        while (++iE < bg) {
            dq[iE] = this[iE][r1].apply(this[iE], N8)
        }
        return dq
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
    HA: function(rU) {
        return this.TT("HA", rU).join("")
    },
    zX: function() {
        var iE = 0,
            sq = this.length,
            bg, jH = [this[0]];
        while (++iE < sq) {
            bg = Math.floor(Math.random() * iE);
            jH[iE] = jH[bg];
            jH[bg] = this[iE]
        }
        return jH
    },
    k3: function() {
        var fQ = {},
            iE = this.length;
        while (--iE >= 0) {
            fQ[this[iE]] = iE
        }
        return fQ
    },
    Sb: function(nI) {
        return this.map(function(GZ) {
            return nI[GZ]
        })
    },
    UV: function(ZZ) {
        var sq = this.length - 1,
            jH = [],
            iE;
        for (iE = 0; iE <= sq; ++iE) {
            jH[iE] = this[iE * ZZ % sq || iE]
        }
        return jH
    },
    zo: function() {
        this.zo = (function() {
            var xI = 0;
            return function() {
                var sq = this.length,
                    iE;
                if (sq > 1) {
                    while (xI == (iE = Math.floor(Math.random() * sq))) {}
                }
                return this[xI = iE]
            }
        })();
        return this.zo()
    }
});
Array.qB = function(GZ) {
    return GZ instanceof Array ? GZ : GZ ? [GZ] : []
};
Array.pR = function(jf, VZ, x7, KZ) {
    var jH = [],
        iE;
    x7 = x7 || Infinity;
    KZ = KZ || 1;
    for (iE = jf; iE <= VZ; ++iE) {
        jH.push(iE % x7 * KZ)
    }
    return jH
};
String.implement({
    bv: function() {
        return this.charAt(Math.floor(Math.random() * this.length))
    },
    pm: function(fI) {
        return this.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
    },
    Kx: function(jH) {
        var T3 = function(fQ) {
            return this.substitute(fQ)
        };
        return jH.map(T3, this)
    },
    SB: function(rU, Oz) {
        Oz = Oz ? ' class="'.concat(Oz, '"') : "";
        return "<".concat(rU, Oz, ">", this, "</", rU, ">")
    },
    HA: function(rU, Oz) {
        return this.pm().SB(rU, Oz)
    }
});
Elements.nP = function(DM) {
    return (new Element("div")).set("html", arguments).getChildren()
};
Element.implement({
    m7: (function() {
        var JL = {};
        return function(g7) {
            JL[g7] = JL[g7] || function() {
                window.event.which !== 0 && g7.test(String.fromCharCode(window.event.charCode)) && event.preventDefault()
            };
            return this.addEvent("keypress", JL[g7])
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
            ud: binder.ud,
            yT: binder.yT,
            T_: binder.T_
        }).apply(this, arguments)
    };
    return binder
};
var yE = {};
var kG = function(v6) {
    this.rI = window.getComputedStyle(v6, null)
};
kG.prototype = {
    mK: function(VK, cg) {
        cg = yE.IQ(cg);
        try {
            return this.rI.getPropertyCSSValue ? this.rI.getPropertyCSSValue(cg).getFloatValue(VK) : this.rI.getPropertyValue(cg).toInt()
        } catch (KK) {}
    },
    eX: function(cg) {
        cg = yE.IQ(cg);
        return this.mK(5, cg)
    },
    Ep: function(cg) {
        cg = yE.IQ(cg);
        return this.rI.getPropertyValue(cg)
    }
};
yE.Ao = (function(a, b, c) {
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
    }, A(""), j = l = null, e.cX = f, e.Ma = d, g.className = g.className.replace(/\bno-javascript\b/, "") + " javascript " + u.join(" ");
    return e
})(this, this.document);
yE.iO = function() {
    document.body.adopt((new Element("div", {
        style: "position: absolute; top: -1000px"
    })).adopt(new Element("input", {
        id: "Ww",
        type: "text"
    }), new Element("label", {
        "for": "Ww",
        text: "Ww"
    })))
};
(function() {
    var iJ = {
            x0: /([0-9_]+) like Mac OS X/,
            MR: /Android ([0-9.]+)/,
            EX: /Windows \w+ ([0-9.]+)/
        },
        G5 = navigator.userAgent.match(/[(]([^;]+)(?:; U)?; ([^;)]+)(?:; [^)]+)?[)]/) || [],
        RW;
    this.E0 = G5[1];
    if (this.RW = G5[2]) {
        for (RW in iJ) {
            if (G5 = this.RW.match(iJ[RW])) {
                this.RW = RW;
                this.PA = G5[1] && parseFloat(G5[1].substr(0, 3).replace("_", "."));
                break
            }
        }
    }
    if (this.Ao.touch) {
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
    this.d1 = yE.RW == "x0";
    (function() {
        var EZ = document.createElement("canvas"),
            rA = document.createElement("canvas"),
            dp, uO;
        rA.setAttribute("width", 1);
        rA.setAttribute("height", 1);
        uO = rA.getContext("2d");
        EZ.setAttribute("width", 8);
        EZ.setAttribute("height", 8);
        dp = EZ.getContext("2d");
        if (rA.getContext === undefined) {
            return
        }
        this.GV = !!dp.putImageData;
        this.iz = !!dp.getImageData;
        if (this.GV && this.iz) {
            this.zF = 1;
            try {
                dp.putImageData(uO.getImageData(0, 0, 1, 1), -1, -1)
            } catch (zj) {
                this.zF = 0
            }
        }
        if (this.iz) {
            uO.fillStyle = "#ffffff";
            uO.fillRect(0, 0, 1, 1);
            dp.clearRect(0, 0, 8, 8);
            dp.drawImage(rA, 4, 4);
            this.aj = dp.getImageData(4, 4, 1, 1).data[0] == 0
        }
    }).call(this);
    document.readyState === "complete" ? yE.iO() : window.addEvent("domready", yE.iO)
}).call(yE);
yE.aj && (function(EV, rq, jK) {
    if (EV != 1) {
        CanvasRenderingContext2D.prototype.drawImage = function(PB, d9, Ke, u3, H9, kc, Xx, pU, T8) {
            rq.call(this, PB, d9 / EV, Ke / EV, u3 / EV, H9 / EV, kc / EV, Xx / EV, pU / EV, T8 / EV)
        };
        CanvasRenderingContext2D.prototype.putImageData = jK && function(Hc, kc, Xx) {
            jK.call(this, Hc, kc * EV, Xx * EV)
        }
    }
})(window.devicePixelRatio || 1, CanvasRenderingContext2D.prototype.drawImage, CanvasRenderingContext2D.prototype.putImageData);
var Sw = new Class({
    jZ: function() {
        this.vd = $merge.run([this.vd].extend(arguments));
        if (!this.addEvent) {
            return this
        }
        for (var oP in this.vd) {
            if ($type(this.vd[oP]) != "function" || !(/^on[A-Z]/).test(oP)) {
                continue
            }
            this.addEvent(oP, this.vd[oP]);
            delete this.vd[oP]
        }
        return this
    },
    I4: function(cg) {
        return this.vd.hasOwnProperty(cg) ? this.vd[cg] : void 0
    },
    DQ: function(cg, yI) {
        return this.vd[cg] = yI
    }
});
var g9 = function(P3, JY, ES) {
    this.P3 = P3;
    this.JY = JY;
    this.ES = ES || 1;
    this.kT = 0;
    this.BL = this.BL.bind(this)
};
g9.prototype = {
    BL: function() {
        if (--this.kT == 0) {
            this.P3.removeEvent(this.JY, this.BL);
            this.QM()
        }
    },
    cM: function(Hd) {
        this.QM = Hd;
        this.kT = this.ES, this.P3.addEvent(this.JY, this.BL)
    },
    tY: function() {
        this.P3.removeEvent(this.JY, this.BL)
    }
};
Events.implement({
    jm: function(JY, ES) {
        return new g9(this, JY, ES)
    },
    b6: function(FC, QM) {
        var Og = this,
            JW = function() {
                QM.apply(this, arguments);
                Og.removeEvent(FC, JW)
            };
        return this.addEvent(FC, JW)
    }
});
Element.Properties.Jb = {
    set: (function() {
        var fg = function() {
            gj = Math.min(1, this.clientWidth / this.scrollWidth);
            gj && this.za({
                transform: yX.Q7.gj(gj, gj),
                transformOrigin: "0 0"
            })
        };
        return function(DM) {
            if (!this.fg) {
                this.fg = this.fg || fg.bind(this);
                window.addEvent("orientationchange", this.fg)
            }
            this.set("html", DM);
            fg.call(this);
            return this
        }
    })(),
    get: Element.Properties.html.get
};
var pv = new Class({
    Extends: Events,
    Implements: Sw,
    vd: {
        OU: "",
        c9: "",
        AX: 0
    },
    kE: 0,
    toElement: function() {
        return this.Ut
    },
    initialize: function(vd) {
        this.jZ(vd);
        this.Ut = (vd.Ut || new Element("div", {
            id: this.vd.OU,
            "class": this.vd.c9 + " pv"
        })).adopt(this.nh = this.vd.nh || new Element("div", {
            "class": "vH"
        }));
        vd.AX && pv.AX(this)
    },
    xW: function(DM) {
        this.nh.innerHTML = DM;
        return this
    },
    bE: function(B8) {
        B8 = arguments.length ? !!B8 : !this.kE;
        if (B8 != this.kE) {
            this.fireEvent(B8 ? "hP" : "qT");
            this.Ut.style.visibility = B8 ? "inherit" : "hidden";
            this.kE = B8;
            this.fireEvent(B8 ? "Dz" : "kw")
        }
        return this
    },
    ah: function() {
        return this.kE
    },
    AW: function() {
        return this.bE(!this.kE)
    },
    Kg: function(v6) {
        v6 = v6 || new Element("div");
        this.Ut.adopt(v6.adopt(this.Ut.getChildren()));
        return this
    },
    yD: function(Bn, jP) {
        return (new Element("div", {
            id: Bn || "",
            "class": jP || ""
        })).adopt((new Element("div", {
            "class": "zf"
        })).adopt(this), new Element("div", {
            "class": "Vp"
        }))
    },
    v9: function() {
        this.Ut.destroy()
    },
    Gx: function() {
        this.Ut.dispose()
    },
    M9: function() {
        return xt.EC(this.__proto__.constructor, [this.vd])
    }
});
pv.AX = function(Xk) {
    var xW = Xk.xW;
    Xk.xW = function(DM) {
        this.nh.set("Jb", DM);
        return this
    }
};
var m9 = new Class({
    Extends: pv,
    Binds: ["qg", "J9", "hi", "QP"],
    Ut: null,
    nh: null,
    Mq: 0,
    q8: 0,
    Y5: 1,
    vd: {
        vH: "",
        Y5: 0,
        Ie: 200,
        b3: 1
    },
    initialize: function(vd) {
        this.jZ(vd);
        this.Ut = new Element("div", {
            id: this.vd.OU,
            "class": this.vd.c9 + " m9"
        }).adopt(this.nh = new Element("div", {
            "class": "vH"
        }).adopt(this.Xa = new Element("div", {
            "class": "gM"
        })), new Element("div", {
            "class": "JK"
        }));
        this.xW(this.vd.vH);
        this.Kl(this.vd.Y5);
        this.nh.addEvents({
            touchstart: this.qg,
            touchend: this.J9,
            W4: this.QP
        });
        this.dX = this.nh;
        document.addEvents({
            touchend: this.hi,
            touchcancel: this.hi
        })
    },
    Kg: function(v6, R4) {
        v6.wraps(this.Xa, R4);
        return this
    },
    Kl: function(Kl) {
        if (this.Y5 != !!Kl) {
            this.Y5 = !!Kl;
            this.Y5 ? this.Ut.removeClass("vm") : this.Ut.addClass("vm");
            this.hi();
            this.fireEvent("Kl", this.Y5)
        }
        return this
    },
    xW: function(vH) {
        vH instanceof Element ? this.Xa.adopt(arguments) : this.bO(vH);
        return this
    },
    bO: function(gM) {
        this.vH != gM && this.Xa.set("text", this.vH = gM);
        return this
    },
    qg: function(JY) {
        JY.preventDefault();
        if (this.Y5) {
            this.Ut.addClass("Mq");
            this.Mq = 1;
            ++this.q8;
            this.fireEvent("kO").nh.fireEvent("W4", [this.q8], this.vd.Ie)
        }
    },
    J9: function() {
        this.Y5 && this.Mq && this.fireEvent("RB");
        this.hi()
    },
    hi: function() {
        this.Mq = 0;
        this.Ut.removeClass("Mq")
    },
    QP: function(q8) {
        q8 == this.q8 && this.vd.b3 ? this.J9() : this.Ut.removeClass("Mq")
    }
});
var qS = (function() {
    var Rk = {
            chipSet1: [0.05, 0.1, 0.5, 1, 5, 25, 100, 500, 1000, 5000, 10000],
            chipSet2: [0.25, 0.5, 1, 5, 25, 100, 500, 1000, 5000, 10000, 50000],
            chipSet3: [0.5, 1, 5, 10, 50, 100, 500, 1000, 5000, 10000, 50000, 100000],
            chipSet4: [5, 10, 50, 100, 500, 1000, 5000, 10000, 50000, 100000, 500000, 1000000]
        },
        CI, xS, QI, DJ, oJ, TJ, Fu, E6, hV = function(Wo, y9) {
            var pL = qS.xV(Wo).split("."),
                Vb = (+pL[0]).toString(),
                Yf = pL[1] || "",
                zI;
            if (oJ) {
                while (zI = Vb.match(/^(\d+)(\d\d\d)(.*)$/)) {
                    Vb = zI[1].concat(oJ, zI[2], zI[3])
                }
            }
            y9 = y9 && Yf == 0;
            return DJ.concat(Vb, y9 ? "" : dK, y9 ? "" : Yf, TJ)
        };
    return {
        toString: function() {
            return Fu
        },
        i8: function(pL) {
            return pL / xS
        },
        xV: function(Wo) {
            return (Wo * xS).toFixed(QI)
        },
        ff: gC = function(Bh, y9) {
            return hV(qS.i8(Bh), y9)
        },
        PD: TV = function(Wo) {
            return hV(Wo, 1)
        },
        UY: Oq = function(Wo) {
            return hV(Wo, 0)
        },
        r3: function(nk, tS) {
            var bJ = nk.MAJOR_SYMBOL_PADDING_SPACE == "true" ? "\u00a0" : "";
            Fu = nk["@currencyCode"];
            QI = parseInt(nk.DECIMAL_PRECISION);
            xS = tS;
            DJ = nk.MAJOR_SYMBOL_ALIGNMENT == "left" ? nk.MAJOR_SYMBOL + bJ : "";
            TJ = nk.MAJOR_SYMBOL_ALIGNMENT == "right" ? bJ + nk.MAJOR_SYMBOL : "";
            oJ = (nk.USE_THOUSANDS_SEPARATOR == "yes" ? nk.THOUSANDS_SEPARATOR : "").replace("_", "\u00a0");
            dK = (QI ? nk.DECIMAL_SEPARATOR : "").replace("_", "\u00a0");
            Rk = Rk[nk.CHIP_SET_CODE] || [];
            CI = Rk[0] || 1;
            Rk = Rk.map(function(yI) {
                return Math.round(yI / CI)
            })
        },
        cE: function(Wo) {
            var iE = Rk.length,
                hs = [];
            Wo = Math.round(Wo * xS / CI);
            while (--iE >= 0 && Wo > 0) {
                while (Wo - Rk[iE] >= 0) {
                    hs.push(iE);
                    Wo -= Rk[iE]
                }
            }
            return hs
        },
        IN: function(Ih) {
            for (var GZ = 0, iE = Ih.length; --iE >= 0; GZ += Rk[Ih[iE]] * CI) {}
            return qS.i8(GZ)
        },
        aM: function(Ih) {
            return Ih.map(function(GZ) {
                return Rk[GZ] * CI
            })
        },
        Hl: function(N5, WQ) {
            var SW = Math.round(xS / CI),
                hs = [],
                iE;
            WQ = Math.round(WQ * xS / CI) || Infinity;
            for (iE = 0; iE < Rk.length; ++iE) {
                if (Rk[iE] >= SW && Rk[iE] <= WQ && 0 < N5--) {
                    hs.push(iE)
                }
            }
            return hs
        },
        OO: function(kS) {
            return qS.i8(Rk[kS] * CI)
        }
    }
})();
var lW = (function() {
    var lD = function(iE) {
            iE = iE in this.vd.SI && iE || 0;
            if (this.BR != iE) {
                this.BR = iE;
                this.Kl(this.Y5);
                this.X5.innerHTML = this.vd.wr(this.vd.SI[iE]);
                this.fireEvent("rh", [this.vd.SI[iE], iE])
            }
        },
        RU = function() {
            lD.call(this, this.BR + 1)
        },
        f7 = function() {
            lD.call(this, this.BR - 1)
        };
    return new Class({
        Extends: pv,
        Y5: 0,
        vd: {
            Y5: 0,
            SI: [],
            wr: Oq
        },
        initialize: function(vd) {
            this.jZ(vd);
            this.Y5 = this.vd.Y5;
            this.Ut = new Element("div", {
                id: this.vd.OU,
                "class": "lW " + this.vd.c9
            });
            this.Ut.adopt(this.sn = (new m9({
                c9: "lW ss"
            })).addEvent("kO", f7.bind(this)), this.bK = (new m9({
                c9: "lW nA"
            })).addEvent("kO", RU.bind(this)), this.X5 = new Element("div", {
                "class": "b4"
            }));
            this.vd.HN !== void 0 && this.E3(this.vd.HN)
        },
        sc: function(v6) {
            return v6.wraps(this.X5)
        },
        E3: function(HN) {
            lD.call(this, this.vd.SI.indexOf(HN))
        },
        XA: function() {
            return this.vd.SI[this.BR]
        },
        Kl: function(Kl) {
            this.Y5 = Kl = !!Kl;
            this.sn.Kl(Kl && this.BR - 1 in this.vd.SI);
            this.bK.Kl(Kl && this.BR + 1 in this.vd.SI)
        }
    })
})();
var Lq = (function() {
    var x6 = function() {
            var IY = this.h9.bN(),
                bc = IY.eX("width"),
                Ef = IY.eX("height"),
                MK = this.vd.xn.MK || IY.Ep("color"),
                C_ = this.vd.xn.C_,
                Q9 = this.vd.xn.lx,
                v7 = this.vd.SI.length,
                Hw, fe = this.vd.xn.SF,
                nL, OE = this.h9,
                zW = OE.getContext("2d"),
                Yw = +this.FE.XA(),
                GZ;
            v7 = Q9 ? v7 : parseInt(this.vd.SI[v7 - 1], 10);
            Hw = bc / (v7 + v7 * fe - fe);
            fe *= Hw;
            OE.width = bc;
            OE.height = Ef;
            for (nL = 0; nL < v7; nL++) {
                GZ = Q9 ? +this.vd.SI[nL] : nL + 1;
                zW.fillStyle = GZ <= Yw ? MK : C_;
                zW.fillRect((Hw + fe) * nL, 0, Hw, Ef)
            }
        },
        aB = function(HN) {
            x6.call(this);
            this.fireEvent("rh", arguments)
        };
    return new Class({
        Extends: pv,
        HN: 0,
        vm: 0,
        vd: {
            SI: [],
            wr: function(HN) {
                return HN
            },
            c2: null,
            xn: {
                lx: 1,
                SF: 0.4,
                MK: 0,
                C_: 0
            }
        },
        initialize: function(vd) {
            this.jZ(vd);
            this.Ut = new Element("div", {
                id: this.vd.OU,
                "class": "Lq " + this.vd.c9
            });
            this.Ut.adopt(this.FE = new lW({
                c9: "H_",
                Y5: 1,
                SI: this.vd.SI,
                HN: this.vd.HN,
                wr: this.vd.wr
            }), (new m9({
                c9: "h4",
                Y5: 1
            })).addEvent("RB", this.bE.bind(this, 0)));
            this.FE.sc(new Element("div", {
                "class": "RP"
            })).grab(new Element("div", {
                "class": "dA",
                html: this.vd.c2
            }), "top").adopt(this.h9 = new Element("canvas", {
                "class": "xn"
            }));
            this.FE.addEvent("rh", aB.bind(this));
            this.vd.HN !== void 0 && this.E3(this.vd.HN)
        },
        bE: function(B8) {
            B8 && x6.call(this);
            return this.parent(B8)
        },
        E3: function(HN) {
            this.FE.E3(HN);
            return this
        },
        XA: function() {
            return this.FE.XA()
        },
    })
})();
var fY = new Class({
    Extends: pv,
    Binds: ["Td", "Z6"],
    vd: {
        Oz: ""
    },
    initialize: function(vd) {
        this.jZ(vd);
        this.Ut = (new Element("div", {
            id: this.vd.OU,
            "class": "fY " + (this.vd.G1 || this.vd.Oz)
        })).adopt((new Element("div")).adopt(this.nh = new Element("span")))
    },
    Rs: function() {
        return this.nh
    },
    Td: function(gM) {
        this.nh.set("text", gM);
        return this
    },
    f6: function(DM) {
        this.nh.set("html", DM);
        return this
    },
    Z6: function(gM) {
        this.nh.set("html", "");
        return this
    },
    sC: function(cg, yI) {
        this.nh.sC(cg, yI);
        return this
    },
    za: function(S6) {
        this.nh.za(S6);
        return this
    }
});
var oI = (function() {
    var EN = 0,
        p7 = 0,
        sI = {},
        GJ = 0,
        MA = 25,
        ZT = 0,
        Q2 = function() {
            var iE, P4, V1;
            for (iE in sI) {
                P4 = sI[iE];
                P4.pH -= MA;
                if (P4.pH <= 0) {
                    isNaN(P4.pH = P4.o5) && UP(iE);
                    V1 = +new Date;
                    P4.QM(V1 - P4.R5);
                    P4.R5 = V1
                }
            }
        },
        LZ = function(Dc, QM, aA) {
            aA = Math.max(aA, 0);
            sI[++GJ] = {
                QM: QM,
                o5: Dc ? aA : NaN,
                pH: aA,
                R5: +new Date
            };
            ++p7;
            W_(0);
            return GJ
        },
        UP = function(wQ) {
            if (sI[wQ]) {
                --p7 || W_(1);
                delete sI[wQ]
            }
        },
        jV = function(wQ, QM) {
            if (sI[wQ]) {
                sI[wQ].QM = QM
            }
            return sI[wQ] && wQ
        },
        Hq = function(cN) {
            MA = Math.ceil(1000 / cN)
        },
        uF = function() {
            return MA
        },
        W_ = function(wH) {
            var V1;
            if (ZT == !wH) {
                return
            }
            if (ZT) {
                V1 = +new Date;
                for (iE in sI) {
                    sI[iE].mH = V1 - sI[iE].R5
                }
                EN = clearInterval(EN)
            } else {
                V1 = +new Date;
                for (iE in sI) {
                    if (sI[iE].mH) {
                        sI[iE].R5 = V1 - sI[iE].mH
                    }
                }
                EN = p7 && setInterval(Q2, MA)
            }
            ZT = !!EN && !wH
        };
    Hq(40);
    window.addEventListener("pagehide", W_.uP(1));
    window.addEventListener("pageshow", W_.uP(0));
    return {
        uF: uF,
        Hq: Hq,
        IW: LZ.uP(0),
        Ii: LZ.uP(1),
        jV: jV,
        LP: UP,
        vh: UP,
        W_: W_.uP(1),
        D7: W_.uP(0)
    }
})();
var bY = new Class({
    Implements: [Events, Sw],
    vd: {},
    h6: 0,
    initialize: function(vd) {
        this.jZ(vd)
    },
    N6: function() {
        return !!this.h6
    },
    Rg: function(v0) {
        this.h6 = 1;
        this.fireEvent("fp", this);
        this.v0 = v0;
        return this
    },
    jT: function() {
        if (this.h6) {
            this.h6 = 0;
            this.fireEvent("g_", this);
            delete this.v0
        }
        return this
    },
    bs: function() {
        if (this.h6) {
            this.h6 = 0;
            this.fireEvent("nM", this);
            this.v0 && this.v0();
            delete this.v0
        }
        return this
    },
    uA: function() {
        if (this.h6) {
            this.h6 = 0;
            this.fireEvent("Uk", this).v0 && this.v0();
            delete this.v0
        }
        return this
    }
});
var Cz = new Class({
    Extends: bY,
    initialize: function(NS, Vt) {
        this.NS = NS;
        this.Vt = Vt
    },
    Rg: function(v0) {
        this.parent(v0);
        return this.Vt() ? this.NS.Rg(this.uA.bind(this)) : this.uA()
    },
    jT: function() {
        if (this.h6) {
            this.NS.jT();
            this.parent()
        }
        return this
    },
    bs: function() {
        if (this.h6) {
            this.NS.bs();
            this.parent()
        }
        return this
    }
});
var Oc = new Class({
    Extends: bY,
    Binds: ["dZ"],
    tq: 0,
    initialize: function(tC) {
        this.tC = tC
    },
    eM: function() {
        this.tC.cM(this.dZ);
        this.tq = 1
    },
    Rg: function(v0) {
        this.eM();
        this.parent(v0);
        0 == this.tq && this.uA();
        return this
    },
    dZ: function() {
        this.tq = 0;
        this.h6 && this.uA()
    },
    jT: function() {
        this.tC && this.tC.tY();
        this.tq = 0;
        return this.parent()
    },
    bs: function() {
        this.tC && this.tC.tY();
        this.tq = 0;
        return this.parent()
    }
});
(function() {
    var Ml = function(JY, ES) {
        return new Oc(new g9(this, JY, ES))
    };
    Events.implement("SE", Ml);
    bY.implement("SE", Ml);
    Element.implement("SE", Ml)
})();
var VF = new Class({
    Extends: Oc,
    tq: 0,
    Yk: [],
    initialize: function() {
        this.Yk = Array.flatten(arguments)
    },
    eM: function() {
        this.tq = this.Yk.length;
        this.Yk.forEach(function(tC) {
            tC.cM(this.dZ)
        }, this)
    },
    jT: function() {
        this.Yk.forEach(function(tC) {
            tC.tY()
        }, this);
        return this.parent()
    },
    bs: function() {
        this.Yk.forEach(function(tC) {
            tC.tY()
        }, this);
        return this.parent()
    }
});
var Pg = new Class({
    Extends: VF,
    dZ: function() {
        if (--this.tq == 0) {
            this.h6 && this.uA()
        }
    }
});
var iQ = (function() {
    var m8 = function() {
        this.My = 0;
        this.fireEvent("Hn", this);
        this.VJ()
    };
    return new Class({
        Extends: bY,
        vd: {
            Ki: 0
        },
        My: 0,
        Rg: function(v0) {
            this.parent(v0);
            if (Math.max(0, this.vd.Ki) > 0) {
                this.My = oI.IW(m8.bind(this), this.vd.Ki)
            } else {
                m8.call(this)
            }
            return this
        },
        VJ: function() {
            this.uA()
        },
        jT: function() {
            this.My = this.My && oI.LP(this.My);
            this.h6 && this.parent();
            return this
        },
        bs: function() {
            this.My = this.My && oI.LP(this.My);
            this.h6 && this.parent();
            return this
        }
    })
})();
var C2 = new Class({
    Extends: bY,
    initialize: function() {
        this.kP = Array.flatten(arguments);
        this.parent()
    },
    Rg: function(v0) {
        var r2 = this,
            Rq = this.kP.length,
            kY = function() {
                --Rq || r2.uA()
            };
        this.parent(v0);
        this.kP.TT("Rg", kY);
        return this
    },
    jT: function() {
        this.kP.TT("jT");
        return this.parent()
    },
    bs: function() {
        this.kP.TT("bs");
        return this.parent()
    }
});
var N3 = new Class({
    Extends: iQ,
    Binds: ["TS", "V5"],
    vd: {
        uZ: 1,
        Hi: 0,
        A4: 1,
        NF: 0,
        aA: 1,
        f_: 10000000000
    },
    jI: NaN,
    uZ: 1,
    Rg: function(v0) {
        this.uZ = this.vd.uZ;
        this.parent(v0)
    },
    VJ: function() {
        this.jI = 0;
        (this.vd.NF > 0) ? this.TS(): this.V5()
    },
    Wr: function(fO) {
        this.uZ = fO || 1
    },
    TS: function() {
        var AO = this.vd.Hi + this.jI % this.vd.f_ * this.vd.A4;
        if (!isNaN(AO)) {
            this.My = 0;
            this.fireEvent("lC", [this, this.jI, AO]);
            this.HD(this.jI, AO) && this.V5()
        }
    },
    V5: function() {
        if (this.jI == NaN) {
            return
        }
        if (++this.jI >= this.vd.NF) {
            if (0 == --this.uZ || 0 == this.vd.NF) {
                this.jI = NaN;
                this.uA();
                return
            }
            this.jI = 0;
            this.fireEvent("eS", [this, this.uZ])
        }
        this.My = oI.IW(this.TS, this.vd.aA)
    },
    jT: function() {
        this.My = this.My && oI.LP(this.My);
        this.jI = NaN;
        this.uZ = NaN;
        return this.parent()
    },
    bs: function() {
        this.My = this.My && oI.LP(this.My);
        this.jI = NaN;
        this.uZ = NaN;
        return this.parent()
    }
});
var Zg = new Class({
    Extends: N3,
    q_: [],
    initialize: function(q_, vd) {
        this.jZ(vd);
        this.aD(q_)
    },
    aD: function(q_) {
        q_ = q_ || [];
        this.q_ = q_.filter(function(Yp) {
            return Yp instanceof bY
        });
        this.vd.Hi = 0;
        this.vd.A4 = 1;
        this.vd.NF = this.q_.length;
        this.vd.f_ = this.q_.length;
        return this
    },
    HD: function(jI, AO) {
        this.q_[jI].Rg(this.V5);
        return 0
    },
    jT: function() {
        var Yp = this.q_[this.jI];
        if (Yp) {
            delete Yp.v0;
            Yp.jT()
        }
        this.parent()
    },
    bs: function() {
        var Yp = this.q_[this.jI];
        if (Yp) {
            delete Yp.v0;
            Yp.bs()
        }
        return this.parent()
    }
});
var j2 = new Class({
    Extends: Zg,
    initialize: function() {
        this.parent(Array.flatten(arguments))
    }
});
z3.OG = {};
z3.KS = {};
TA.Dq("image/*", (function(rP) {
    return function(Ij) {
        var JG = this,
            PB = new Image();
        PB.onload = function() {
            delete PB.onload;
            delete PB.onerror;
            z3.OG[JG.OU] = PB;
            JG.KS && xt.XK(JG.KS, function(uQ, OU) {
                z3.KS[OU] = xt.EC(hH, [PB].concat(uQ.slice(0)))
            });
            JG.Rd()
        };
        PB.onerror = this.l6;
        PB.src = Ij.concat(this.Lg, "&resolution=", rP)
    }
})(navigator.userAgent.indexOf("iPad;") >= 0 ? 2 : window.devicePixelRatio || 1), ["image/*"]);
var hH = function(PB, nL, nz, Hw, Qd, NI, x4, kj) {
    kj = kj || 1;
    PB.KS = PB.KS || [];
    PB.KS.push(this);
    this.PB = PB;
    this.nL = nL / kj;
    this.nz = nz / kj;
    this.bc = Hw / kj;
    this.Ef = Qd / kj;
    this.QO = NI;
    this.lk = x4;
    this.nS = this.bc / NI;
    this.Q_ = this.Ef / x4;
    this.vT = kj;
    this.aG = window.devicePixelRatio || 1
};
hH.prototype = {
    constructor: hH,
    CD: function(pj, lA, Ix, J_, Qh, qZ, LH, a9, Hp) {
        var sq = arguments.length,
            nL = this.nL,
            nz = this.nz,
            Hw = this.bc,
            Qd = this.Ef,
            kj = this.vT;
        sq == 3 ? pj.drawImage(this.PB, nL * kj, nz * kj, Hw * kj, Qd * kj, lA * this.aG, Ix * this.aG, Hw * this.aG, Qd * this.aG) : sq == 5 ? pj.drawImage(this.PB, nL * kj, nz * kj, Hw * kj, Qd * kj, lA * this.aG, Ix * this.aG, J_ * this.aG, Qh * this.aG) : pj.drawImage(this.PB, nL * kj + lA * kj, nz * kj + Ix * kj, J_ * kj, Qh * kj, qZ * this.aG, LH * this.aG, a9 * this.aG, Hp * this.aG)
    },
    YK: function(pj, cD, yp, kc, Xx, pU, T8) {
        this.CD(pj, (cD * this.nS) || 0, (yp * this.Q_) || 0, this.nS, this.Q_, kc || 0, Xx || 0, pU || this.nS, T8 || this.Q_)
    },
    l5: function() {
        return this.PB.l5()
    },
    pW: function() {
        return this.PB.pW(this.vT || 1)
    },
    pF: function(cD, yp) {
        return [-this.nL - (cD || 0) * this.nS, -this.nz - (yp || 0) * this.Q_, ""].join("px ")
    },
    fN: function(Yp) {
        return [-this.nL - (Yp || 0) % this.QO * this.nS, "px"].join("")
    },
    vK: function(Yp) {
        return [-this.nz - (Yp || 0) % this.lk * this.Q_, "px"].join("")
    },
    zU: function(cD, yp) {
        return [this.PB.l5(), "repeat", this.pF(cD, yp)].join(" ")
    }
};
Image.prototype.l5 = function() {
    return ["url(", this.src, ")"].join("")
};
Image.prototype.pW = function(vT) {
    return [this.width / vT, this.height / vT, ""].join("px ")
};
hH.rS = function(Hw, Qd) {
    var OE = document.createElement("canvas");
    OE.width = Hw * window.devicePixelRatio || 1;
    OE.height = Qd * window.devicePixelRatio || 1
};
Element.implement({
    BJ: function(wA, cD, yp) {
        return this.fs(wA).Gm(wA, cD, yp)
    },
    fs: function(wA) {
        return this.za({
            width: wA.nS + "px",
            height: wA.Q_ + "px"
        })
    },
    Gm: function(wA, cD, yp) {
        return this.za({
            backgroundImage: wA.l5(),
            backgroundSize: wA.pW(),
            backgroundPosition: wA.pF(cD, yp)
        })
    }
});
Fx.implement({
    stopTimer: function() {
        if (!this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.timer = oI.vh(this.timer);
        return true
    },
    startTimer: function() {
        if (this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.hT = this.hT || this.step.bind(this);
        this.timer = oI.Ii(this.hT, Math.round(1000 / this.options.fps));
        return true
    }
}, 1);
var oi = new Class({
    Extends: iQ,
    vd: {
        KY: {}
    },
    initialize: function(nB, vd) {
        this.parent(vd);
        this.nB = nB.addEvent("complete", this.uA.bind(this))
    },
    VJ: function() {
        this.nB.start(this.vd.KY)
    },
    jT: function() {
        this.nB.cancel();
        return this.parent()
    },
    bs: function() {
        return this.parent()
    }
});
var mR = new Class({
    Extends: bY,
    vd: {
        ws: !!yE.Ao.csstransitions,
        lv: true,
        Ki: 1,
        unit: "",
        transition: "linear",
        iZ: 1
    },
    gN: 0,
    jZ: function(vd) {
        this.parent(vd);
        this.vd.ws && this.rn(this.vd);
        return this
    },
    initialize: function(v6, vd) {
        this.v6 = v6;
        this.jZ(vd);
        if (this.vd.ws) {
            this.parent()
        } else {
            return new oi(new Fx.Morph(v6, vd), vd)
        }
    },
    Rg: function(v0) {
        this.parent(v0);
        return this.oS()
    }
});
yE.Ao.csstransitions && mR.implement({
    Binds: ["Tq", "aV"],
    rn: function(vd) {
        var sj = vd.duration + "ms",
            HS = vd.Ki + "ms",
            Eq = [],
            db = [],
            uh = [],
            N0;
        this.M6 = {
            transitionProperty: "",
            transitionDuration: "",
            transitionDelay: "",
            transitionTimingFunction: ""
        };
        this.Xb = {};
        this.JN = 0;
        for (N0 in vd.KY) {
            yI = vd.KY[N0];
            N0 = N0.camelCase();
            if ($type(yI) == "array") {
                this.M6[N0] = yI[0].toString() + this.vd.unit;
                this.Xb[N0] = yI[1].toString() + this.vd.unit
            } else {
                this.Xb[N0] = yI.toString() + this.vd.unit
            }
        }
        this.vd.lv && mR.wT(this.Xb) && this.lv();
        for (N0 in this.Xb) {
            ++this.JN;
            Eq.push(N0.hyphenate());
            db.push(sj);
            uh.push(HS)
        }
        this.Xb.transitionProperty = Eq.join(" ,");
        this.Xb.transitionDuration = db.join(" ,");
        this.Xb.transitionDelay = uh.join(" ,");
        this.Xb.transitionTimingFunction = mR.U2[vd.transition] || vd.transition;
        this.VL = vd.Ki + vd.duration;
        return this
    },
    lv: function() {
        var Xb = this.Xb,
            M6 = this.M6,
            IY = this.v6.bN(),
            Cn = Xb.transform = Xb.transform || IY.Uc(),
            sX = M6.transform = M6.transform || IY.Uc();
        S6 = [{
            N0: "top",
            mQ: 1,
            BR: 5
        }, {
            N0: "bottom",
            mQ: -1,
            BR: 5
        }, {
            N0: "left",
            mQ: 1,
            BR: 4
        }, {
            N0: "right",
            mQ: -1,
            BR: 4
        }];
        S6.forEach(function(N0) {
            var mQ = N0.mQ,
                BR = N0.BR,
                N0 = N0.N0,
                Rg, X9, b5;
            if (Xb[N0]) {
                X9 = mQ * parseFloat(Xb[N0]) || 0;
                b5 = mQ * parseFloat(M6[N0]) || 0;
                Rg = -mQ * IY.eX(N0) || 0;
                sX[BR] = Rg + b5;
                Cn[BR] = Rg + X9;
                delete Xb[N0];
                delete M6[N0]
            }
        })
    },
    Tq: function(JY) {
        --this.gN == 0 && this.uA()
    },
    aV: function() {
        this.gN = 0;
        this.h6 && this.uA()
    },
    oS: function() {
        if (this.JN) {
            this.v6.za(this.M6);
            document.body.offsetWidth;
            this.v6.addEvent("transitionend", this.Tq);
            this.gN = this.JN;
            this.v6.za(this.Xb);
            this.RH = this.vd.iZ && setTimeout(this.aV, this.VL + 250)
        } else {
            this.uA()
        }
    },
    uA: function() {
        this.v6.removeEvent("transitionend", this.Tq);
        this.v6.za({
            transitionProperty: "",
            transitionDuration: "",
            transitionDelay: "",
            transitionTimingFunction: ""
        });
        document.body.offsetWidth;
        this.parent()
    }
});
mR.wT = function(N0) {
    var BV = (N0.top !== undefined),
        TW = (N0.bottom !== undefined),
        sq = (N0.left !== undefined),
        dq = (N0.right !== undefined);
    if (!mR.Ap) {
        return false
    }
    return (BV || TW || sq || dq) && !(BV && TW) && !(sq && dq)
};
mR.Ap = yE.E0 != "iPad" && yE.Ao.csstransforms && yE.d1;
mR.w6 = ["top", "left", "bottom", "right"];
mR.U2 = {
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
var qH = new Class({
    Extends: N3,
    v6: null,
    initialize: function(v6, vd) {
        this.jZ(vd);
        this.Xl(v6)
    },
    Xl: function(v6) {
        this.v6 = v6;
        return this
    },
    bs: function() {
        if (this.h6) {
            this.jI = this.vd.NF - 1;
            this.HD(this.jI, (this.vd.Hi + this.vd.A4 * this.jI) % this.vd.f_);
            this.parent()
        }
        return this
    }
});
var kR = new Class({
    Extends: qH,
    vd: {
        eT: []
    },
    initialize: function(v6, vd) {
        vd.NF = vd.NF || vd.eT.length;
        this.parent(v6, vd)
    },
    vA: "",
    HD: function(jI, AO) {
        var Fq = this.vd.eT[jI];
        this.v6.addClass(Fq).removeClass(this.vA);
        this.vA = Fq;
        return 1
    },
    jT: function() {
        this.v6.removeClass(this.vA);
        return this.parent()
    }
});
var e_ = new Class({
    Extends: qH,
    vd: {
        bS: "backgroundPosition",
        VK: "px 0"
    },
    initialize: function(v6, vd) {
        this.parent(v6, vd);
        this.vd.bS = this.vd.bS.camelCase()
    },
    Rg: function(v0) {
        this.PG = this.v6 ? this.v6.qQ(this.vd.bS) : "";
        this.parent(v0)
    },
    HD: function(jI, AO) {
        var yI = AO.toString().concat(this.vd.VK);
        this.v6.sC(this.vd.bS, yI);
        return 1
    },
    jT: function() {
        this.v6.sC(this.vd.bS, this.PG);
        return this.parent()
    }
});
var Sf = new Class({
    Extends: e_,
    vd: {
        bS: "visibility",
        eP: ["visible", "hidden"],
        VK: ""
    },
    jZ: function(vd) {
        var Ub = vd.eP ? vd.eP.length : this.vd.eP.length;
        vd.NF = vd.NF || Ub;
        vd.f_ = vd.f_ || Ub;
        return this.parent(vd)
    },
    HD: function(jI, AO) {
        this.v6.sC(this.vd.bS, this.vd.eP[jI] + this.vd.VK);
        return 1
    }
});
var xz = new Class({
    Extends: Sf,
    initialize: function(v6, wA, vd) {
        var FG, oZ;
        vd = vd || {};
        FG = (vd.FG || "x").toUpperCase() === "X";
        oZ = FG ? wA.QO : wA.lk;
        vd.bS = FG ? "backgroundPositionX" : "backgroundPositionY";
        vd.NF = vd.NF || oZ;
        vd.eP = (vd.eP || Array.pR(1, vd.NF)).map(FG ? wA.fN : wA.vK, wA);
        this.parent(v6, vd)
    }
});
hH.prototype.bY = function(v6, vd) {
    return new xz(v6, this, vd)
};
Element.implement({
    XJ: function(wA, vd) {
        return new xz(this, wA, vd)
    }
});
var Nt = function(jH, TW, Bv, gn, nL, nz) {
    jH instanceof Array ? this.push.apply(this, jH.slice(0, 6)) : this.push.call(this, jH || 1, TW || 0, Bv || 0, gn || 1, nL || 0, nz || 0)
};
Nt.prototype = [];
Nt.prototype.$family = {
    name: "Nt"
};
$extend(Nt.prototype, {
    qh: function(VO) {
        var jH = this[0],
            TW = this[1],
            Bv = this[2],
            gn = this[3];
        this[0] = jH * VO[0] + Bv * VO[1];
        this[1] = TW * VO[0] + gn * VO[1];
        this[2] = jH * VO[2] + Bv * VO[3];
        this[3] = TW * VO[2] + gn * VO[3];
        this[4] = jH * VO[4] + Bv * VO[5] + this[4];
        this[5] = TW * VO[4] + gn * VO[5] + this[5];
        return this
    }
});
var DI = {
    zC: function(Lc, Ho) {
        this[4] += Lc;
        this[5] += Ho;
        return this
    },
    Ws: function(Lc) {
        this[4] += Lc;
        return this
    },
    sv: function(Ho) {
        this[5] += Ho;
        return this
    },
    aQ: function(Hf) {
        var rQ = Math.sin(Hf),
            Kc = Math.cos(Hf),
            jH = this[0],
            TW = this[1],
            Bv = this[2],
            gn = this[3];
        this[0] = jH * Kc + Bv * rQ;
        this[1] = TW * Kc + gn * rQ;
        this[2] = Bv * Kc - jH * rQ;
        this[3] = gn * Kc - TW * rQ;
        return this
    },
    gj: function(Y1, lP) {
        this[0] *= Y1;
        this[1] *= Y1;
        this[2] *= lP;
        this[3] *= lP;
        return this
    },
    ue: function() {
        this[0] = -this[0];
        this[1] = -this[1];
        return this
    },
    SS: function() {
        this[2] = -this[2];
        this[3] = -this[3];
        return this
    },
    toString: yE.Ao.csstransforms3d && yE.d1 ? function() {
        return "matrix3d(".concat([this[0], this[1], 0, 0, this[2], this[3], 0, 0, 0, 0, 1, 0, this[4], this[5], 0, 1].join(","), ")")
    } : Browser.Engine.gecko ? function() {
        return "matrix(".concat([this[0], this[1], this[2], this[3], this[4] + "px", this[5] + "px"].join(","), ")")
    } : function() {
        return "matrix(".concat(this.join(","), ")")
    }
};
var Ds = function() {
    Nt.apply(this, arguments)
};
var YI = function() {};
YI.prototype = Nt.prototype;
Ds.prototype = new YI();
Ds.prototype.constructor = Ds;
$extend(Ds.prototype, DI);
yX = {
    Q7: function(a, b, c, d, e, f) {
        return new Ds(a, b, c, d, e, f)
    }
};
yX.Q7.wB = new Ds();
(function() {
    for (var r1 in DI) {
        yX.Q7[r1] = (function(r1) {
            return function() {
                return r1.apply(new Ds(1, 0, 0, 1, 0, 0), arguments)
            }
        })(DI[r1])
    }
})();
kG.prototype.Uc = function() {
    var Q7 = this.Ep("transform");
    Q7 = Q7 && Q7.replace(/^[^(]+/, "").match(/[-0-9.]+/g);
    Q7 = Q7 && Q7.map(parseFloat);
    return Q7 && Q7.length == 16 ? new Ds(Q7[0], Q7[1], Q7[4], Q7[5], Q7[12], Q7[13]) : new Ds(Q7)
};
var jz = (function() {
    var GS = function() {
            this.cY = new N3({
                Hi: 1
            });
            this.cY.HD = function(jI, AO) {
                dV.call(this, (this.vd.Mb) ? (this.MN + AO - 1) : (this.MN + (this.aY - this.MN) * Math.log(AO) / Math.LN10));
                return 1
            }.bind(this);
            this.cY.addEvents({
                nM: function() {
                    dV.call(this, this.aY);
                    this.MN = this.aY
                }.bind(this)
            });
            return this.cY
        },
        dV = function(MN) {
            MN = this.vd.ji(MN);
            if (MN !== this.iS) {
                return !!this.nh.set("text", this.iS = MN)
            }
        };
    return new Class({
        Extends: pv,
        Implements: [Events, Sw],
        vd: {
            ji: Oq,
            a_: qS.xV,
            Mb: false,
            f1: 25
        },
        initialize: function(vd) {
            this.jZ(vd);
            this.Ut = this.nh = this.vd.Ut.addClass("jz " + this.vd.c9);
            (this.vd.MN !== undefined) && this.E3(this.vd.MN)
        },
        wL: function() {
            this.MN = 0;
            this.nh.set("text", this.iS = "");
            this.fireEvent("rh", [this.MN, this.iS])
        },
        E3: function(MN) {
            this.cY && this.cY.bs();
            if (dV.call(this, MN)) {
                this.MN = this.aY = MN;
                this.fireEvent("rh", [this.vd.a_(MN), this.iS])
            }
            return this
        },
        XA: function() {
            return this.MN || 0
        },
        ft: function(aY, Kr) {
            var NF;
            (this.cY || GS.call(this)).bs();
            this.aY = aY;
            if (this.vd.Mb) {
                NF = Math.floor(Math.abs(qS.xV(this.aY - this.MN) / qS.xV(Kr)) * this.vd.f1);
                this.cY.jZ({
                    A4: Kr / this.vd.f1,
                    NF: NF,
                    aA: this.vd.aA
                })
            } else {
                NF = Math.floor(this.vd.f1 + this.vd.f1 * Math.log(Math.abs(qS.xV(aY - this.MN) / qS.xV(Kr))) / Math.LN10);
                this.cY.jZ({
                    NF: NF,
                    A4: 9 / NF
                })
            }
        },
        bY: function() {
            var r2 = this;
            return new Cz(this.cY || GS.call(this), function() {
                return r2.aY != r2.MN
            })
        }
    })
})();
var JB = new Class({
    Extends: pv,
    initialize: function(vd) {
        this.jZ(vd);
        this.Ut = new Element("div", {
            id: this.vd.OU,
            "class": "JB " + this.vd.c9
        }), this.bT = {}
    },
    Jz: function(v6, R4) {
        var v6 = v6 instanceof Element ? v6 : v6.toElement();
        if (R4 !== undefined) {
            R4 = this.Ut.getChildren()[R4]
        }
        R4 instanceof Element ? v6.inject(R4, "before") : this.Ut.adopt(v6);
        return this
    },
    fb: function(JY, WY, R4) {
        (this.bT[JY] = this.bT[JY] || []).push(WY);
        this.Jz(WY, R4);
        this.fireEvent("YL", [JY, WY]);
        return this
    },
    XZ: function(KT) {
        xt.XK(KT, this.fb.Nz(1, 0).bind(this))
    },
    pA: function(jn, JY) {
        var zQ, Ew, iE;
        for (zQ in this.bT) {
            if (JY && zQ !== JY) {
                continue
            }
            Ew = this.bT[zQ];
            Ew && Ew.forEach(function(WY) {
                WY.Kl(jn)
            })
        }
        return this
    },
    YA: function(jn) {
        xt.XK(this.bT, this.pA.uP(jn).Nz(1), this);
        return this
    },
    PC: function(JY) {
        this.bT[JY].forEach(function(WY) {
            WY.removeEvents();
            WY.Gx()
        });
        delete this.bT[JY];
        return this
    },
    k6: function() {
        xt.XK(this.bT, this.PC.Nz(1).bind(this));
        return this
    }
});
var Pn = new Class({
    Extends: pv,
    Binds: ["Xo", "dG"],
    initialize: function(vd) {
        this.jZ(vd);
        this.Ut = (new Element("div", {
            id: this.vd.OU,
            "class": this.vd.c9 + " Pn"
        })).adopt(this.nh = new Element("div", {
            "class": "tL"
        }), this.bT = new JB({
            c9: "d5"
        }).addEvent("YL", this.Xo.bind(this)));
        this.addEvents({
            tc: this.dG,
            kw: cW.xf
        })
    },
    Td: function(UD) {
        this.nh.innerHTML = "";
        this.nh.adopt(arguments).children.length || this.nh.set("html", UD);
        return this
    },
    Xo: function(JY, WY) {
        WY.addEvent("RB", this.fireEvent.bind(this, JY))
    },
    dG: function() {
        this.bE(0)
    },
    fb: function(JY, WY, R4) {
        this.bT.fb(JY, WY, R4);
        return this
    },
    XZ: function(PM) {
        xt.XK(PM, this.fb.Nz(1, 0), this);
        return this
    },
    Sd: function() {
        return this.fb("tc", new m9({
            c9: "Sp",
            Y5: 1
        }))
    },
    pA: function(jn, JY) {
        this.bT.pA(jn, JY);
        return this
    },
    YA: function(jn) {
        this.bT.YA(jn);
        return this
    },
    TF: function(B8) {
        this.bT.bE(B8);
        return this
    },
    PC: function(JY) {
        this.bT.PC(JY);
        return this
    },
    k6: function() {
        this.bT.k6();
        return this
    }
});
Pn.CC = function(UO) {
    var Ai = (new Element("div", {
        "class": "fE",
        style: "visibility:hidden"
    })).adopt(new Element("div", {
        "class": "Rx"
    }).adopt(UO));
    UO.Ut = Ai;
    return UO
};
var WE = new Class({
    Implements: [Events, Sw],
    Binds: ["gs"],
    vd: {
        NQ: 5
    },
    toElement: function() {
        return this.Iu
    },
    initialize: function(vd) {
        var iE, bg, Cx, dq, q5, Q6, fZ = 0,
            Z5 = [],
            ER, r2 = this;
        this.jZ(vd);
        this.mM = [];
        this.W2 = [];
        this.ew = new Elements();
        this.fC = [];
        this.ks = [];
        for (iE = this.vd.H4; iE--;) {
            this.ks[iE] = iE
        }
        this.Cl = [];
        this.bF = [];
        this.OC = yE.RW == "MR" ? {
            cg: "display",
            bE: "block",
            s9: "none"
        } : {
            cg: "visibility",
            bE: "visible",
            s9: "hidden"
        };
        this.CT = this.CT.bind(this);
        this.Iu = new Element("div", {
            id: "Yv"
        });
        iE = this.vd.vp.length;
        dq = this.vd.nx.kx;
        do {
            this.ew[--dq] = q5 = new Element("div", {
                "class": "q5",
                styles: {
                    right: fZ
                }
            });
            this.Cl[dq] = (new j2(this.vd.yb && new mR(q5, {
                duration: 175,
                transition: "quint:in",
                KY: {
                    top: "35px"
                }
            }), (new iQ()).addEvents({
                Uk: this.yV.bind(this, dq)
            }), this.vd.yb && new mR(q5, {
                duration: 1,
                KY: {
                    top: "10px"
                }
            })));
            this.bF[dq] = (new j2((new iQ()).addEvents({
                Uk: this.Ra.bind(this, dq)
            }), this.vd.yb && new mR(q5, {
                duration: 100,
                transition: "sine:in",
                KY: {
                    top: "12px"
                }
            }), this.vd.yb && new mR(q5, {
                duration: 250,
                transition: "sine:in:out",
                KY: {
                    top: "0px"
                }
            })));
            bg = iE - this.vd.nx.Q5;
            do {
                --iE;
                Q6 = new Element("div", {
                    "class": "D8",
                    style: "position:absolute; top:" + ((iE - bg - 1) * (this.vd.nx.eh + this.vd.nx.xh)) + "px"
                });
                this.mM[this.vd.vp[iE]] = Q6;
                Q6.inject(q5, "top")
            } while (iE > bg);
            this.fC[dq] = new Elements();
            for (bg = this.vd.H4; bg--;) {
                var S6 = {
                        backgroundPosition: (bg * -(this.vd.nx.qd + this.vd.nx.vB)) + "px 0px",
                        right: fZ + "px",
                    },
                    nK;
                S6[this.OC.cg] = this.OC.s9;
                this.fC[dq][bg] = nK = new Element("div", {
                    "class": this.vd.hR,
                    styles: S6
                })
            }
            fZ += this.vd.nx.qd;
            if (this.vd.nx.vB && dq) {
                Z5[dq] = new Element("div", {
                    "class": "wv",
                    styles: {
                        right: fZ
                    }
                })
            }
            fZ += this.vd.nx.vB
        } while (iE);
        this.Iu.adopt(this.ew, this.fC, Z5);
        this.Cy = this.Cy.bind(this)
    },
    qW: function() {
        if (this.EN) {
            this.ew.za({
                top: "0px",
                visibility: ""
            });
            this.V6(0);
            this.EN = oI.vh(this.EN)
        }
        this.HF = 0
    },
    d3: function(bR) {
        bR.each(function(Xh, R4) {
            this.mM[R4].removeClass(this.W2[R4]).addClass(Xh).style.backgroundPosition = ""
        }, this);
        this.W2 = bR.slice(0)
    },
    bf: function(bR) {
        this.bR = bR.slice(0)
    },
    a7: function(vp) {
        var O0 = [];
        for (var iE = vp.length; iE--;) {
            O0[iE] = this.mM[vp[iE]]
        }
        return new Elements(O0)
    },
    Js: function(kZ) {
        var s_ = this.ew.map(Function.qY(1)),
            Cl = [],
            bF = [],
            ER = 0,
            b7 = 0;
        this.ks = this.ks.zX();
        this.OW = {
            rD: 0,
            sj: -1,
            PE: 0,
            WR: this.vd.nx.kx,
            dm: [],
            T9: 0,
            ks: this.ew.map(function(q5, iE) {
                return this.ks[iE % this.ks.length]
            }, this),
            rM: []
        };
        this.EN = this.EN || oI.Ii(this.CT, this.vd.NQ);
        this.V6(0);
        (kZ ? s_.zX() : s_).forEach(function(fe, iE) {
            Cl[iE] = this.Cl[fe].jZ({
                Ki: ER += this.vd.Kq
            });
            bF[iE] = this.bF[fe].jZ({
                Ki: b7 += this.vd.uU
            })
        }, this);
        this.WM = (new C2(Cl)).Rg();
        this.Mz = (new C2(bF)).addEvent("Uk", this.bL.bind(this))
    },
    V6: function(Tj) {
        this.fC.forEach(function(mJ, dq) {
            var PB = mJ[(this.OW.rD + this.OW.ks[dq]) % this.vd.H4];
            PB.style[this.OC.cg] = Tj && this.OW.dm[dq] ? this.OC.bE : this.OC.s9;
            this.OW.rM[dq] = PB
        }, this)
    },
    yV: function(dq) {
        if (!this.EN) {
            return
        }
        this.OW.dm[dq] = 1;
        this.OW.rM[dq].style[this.OC.cg] = this.OC.bE;
        this.ew[dq].style.visibility = "hidden";
        --this.OW.WR || this.fireEvent("X3")
    },
    CT: function() {
        if (!this.OW.WR && this.bR) {
            this.d3(this.bR);
            this.OW.sj += Math.ceil(this.vd.Dn / oI.uF());
            this.OW.sj = Math.max(this.OW.sj, 1);
            delete this.bR;
            this.OW.ER = 0
        }
        this.V6(0);
        this.OW.rD++;
        this.OW.rD %= this.vd.H4;
        this.V6(1);
        !this.HF && --this.OW.sj;
        this.OW.sj == 0 && !this.OW.T9 && this.Mz.Rg()
    },
    Ra: function(dq) {
        this.ew[dq].style.visibility = "visible";
        this.OW.rM[dq].style[this.OC.cg] = this.OC.s9;
        document.body.offsetWidth;
        this.OW.dm[dq] = 0;
        ++this.OW.T9
    },
    bL: function() {
        this.EN = oI.vh(this.EN);
        this.V6(0);
        this.ew.sC("visibility", "visible");
        document.body.offsetWidth;
        oI.IW(this.Cy, 1)
    },
    Cy: function() {
        this.fireEvent("bL")
    },
    gs: function(M0) {
        this.HF = !!M0
    }
});
var rC = (function() {
    var Hv = ((navigator.userAgent.indexOf("Mozilla/5.0") > -1 && navigator.userAgent.indexOf("Android ") > -1 && navigator.userAgent.indexOf("AppleWebKit") > -1) && !(navigator.userAgent.indexOf("Chrome") > -1));
    return new Class({
        Implements: [Sw],
        GI: null,
        tm: null,
        AL: null,
        vd: {
            Jc: [],
            nx: null,
            gS: 2,
            wg: 3,
            l0: "#000000",
            pK: "miter",
            zK: "butt",
            qn: "",
            Ps: true
        },
        toElement: function() {
            return this.tm
        },
        initialize: function(GI, vd) {
            this.jZ(vd);
            this.tm = new Element("div", {
                id: "zh"
            });
            this.GI = this.Xp(GI);
            var nx = this.vd.nx,
                N4 = this.vd.gS,
                QK = nx.eh,
                ep = nx.qd,
                Tt = nx.vB,
                QY = nx.xh,
                kx = nx.kx,
                Q5 = this.vd.Bx.length / nx.kx,
                lF = (ep + Tt) * kx - Tt,
                Aa = (QK + QY) * Q5 - QY,
                vC = (nx.bc - lF) / 2,
                gP = (nx.Ef - Aa) / 2,
                vT = 1,
                aG = 1;
            xt.XK(z3.KS, function(ow) {
                if (ow.vT && ow.vT > vT) {
                    vT = ow.vT
                }
            });
            vT = this.vd.vT || vT;
            this.V2 = this.vd.Bx.map(function(GZ, iE) {
                return [vC + (iE % kx) * (ep + Tt) + N4 / 2, gP + Math.floor(iE / kx) * (QK + QY) + N4 / 2, ep - N4, QK - N4]
            }, this);
            this.AL = new Element("canvas", {
                width: this.vd.nx.bc * vT,
                height: this.vd.nx.Ef * vT,
                styles: {
                    width: this.vd.nx.bc,
                    height: this.vd.nx.Ef
                }
            });
            this.AL.getContext("2d").scale(vT / aG, vT / aG);
            this.ax = this.vd.Jc.filter(function(Th) {
                return Th < GI.length
            }).map(function(Th) {
                var Ut = this.AL.clone(),
                    zW = Ut.getContext("2d"),
                    bg = 0;
                zW.scale(vT / aG, vT / aG);
                while (bg++ < Th) {
                    this.yw(zW, this.GI[bg])
                }
                return Ut
            }, this);
            this.kz(this.vd.hg);
            this.AL.za({
                position: "relative"
            });
            this.vd.Gr.forEach(function(Ut, iE) {
                var jU = this[iE];
                Ut && Ut.za({
                    position: "absolute",
                    top: (jU.sE[0][1] - Ut.firstElementChild.height / 2) + "px",
                    transform: yX.Q7.gj(jU.W6 ? 1 : -1, 1)
                }) && Ut.sC(jU.W6 ? "left" : "right", (jU.SP === void(0) ? -2 : jU.SP) + "px")
            }, this.GI);
            this.tm.adopt(this.AL, this.ax, this.vd.Gr)
        },
        w_: function(vl) {
            var zW = this.AL.getContext("2d");
            this.mL();
            vl.forEach(function(dk) {
                this.yw(zW, this.GI[dk.sK], dk.sK ? null : dk.I0)
            }, this);
            return this
        },
        mL: function() {
            var zW = this.AL.getContext("2d");
            zW.save();
            zW.setTransform(1, 0, 0, 1, 0, 0);
            zW.clearRect(0, 0, zW.canvas.width, zW.canvas.height);
            if (Hv) {
                this.AL.sC("opacity", 0.99);
                setTimeout(function() {
                    this.AL.sC("opacity", 1)
                }.bind(this), 0)
            }
            zW.restore()
        },
        wn: function(dk) {
            var iE = dk.sK,
                zW = this.AL.getContext("2d");
            this.mL();
            this.yw(zW, this.GI[iE], dk.I0, dk.eR);
            return this
        },
        Sy: function(bE) {
            this.AL.style.visibility = (bE ? "visible" : "");
            return this
        },
        FM: function(B8) {
            if (this.hg) {
                this.hg.style.visibility = B8 ? "visible" : ""
            }
        },
        kz: function(Gj, B8) {
            this.FM(0);
            this.hg = this.ax[this.vd.Jc.indexOf(Gj)];
            this.vd.Gr.forEach(function(xF, Pz) {
                xF && (Pz <= Gj ? xF.removeClass("vm") : xF.addClass("vm"))
            });
            this.FM(B8);
            return this
        },
        yw: function(zW, YM, I0, eR) {
            var vd = this.vd,
                bg = 0,
                sE = YM.sE;
            zW.lineCap = vd.zK;
            zW.lineJoin = vd.pK;
            if (sE && sE.length && vd.Ps) {
                zW.beginPath();
                zW.moveTo(sE[bg][0], sE[bg][1]);
                while (++bg < sE.length) {
                    zW.lineTo(sE[bg][0], sE[bg][1])
                }
                zW.strokeStyle = vd.l0;
                zW.lineWidth = vd.wg;
                zW.stroke();
                zW.strokeStyle = YM.Zi;
                zW.lineWidth = vd.gS;
                zW.stroke()
            }
            I0 && I0.forEach(function(j0) {
                var TB = this[j0];
                zW.clearRect(TB[0], TB[1], TB[2], TB[3]);
                zW.beginPath();
                zW.moveTo(TB[0], TB[1]);
                zW.lineTo(TB[0] + TB[2], TB[1]);
                zW.lineTo(TB[0] + TB[2], TB[1] + TB[3]);
                zW.lineTo(TB[0], TB[1] + TB[3]);
                zW.closePath();
                zW.globalCompositeOperation = "destination-over";
                zW.strokeStyle = vd.l0;
                zW.lineWidth = vd.wg;
                zW.stroke();
                zW.beginPath();
                zW.moveTo(TB[0], TB[1]);
                zW.lineTo(TB[0] + TB[2], TB[1]);
                zW.lineTo(TB[0] + TB[2], TB[1] + TB[3]);
                zW.lineTo(TB[0], TB[1] + TB[3]);
                zW.closePath();
                zW.globalCompositeOperation = "source-over";
                zW.strokeStyle = YM.Zi;
                zW.lineWidth = vd.gS;
                zW.stroke()
            }, this.V2);
            eR && eR.forEach(function(j0) {
                var TB = this[j0];
                zW.beginPath();
                zW.moveTo(TB[0], TB[1] + TB[3] / 2);
                zW.lineTo(TB[0] + TB[2], TB[1] + TB[3] / 2);
                zW.stroke()
            }, this.V2)
        },
        Xp: function(GI) {
            var mx = function(sE) {
                    var Hf, DT, Kc, kA, fe = 0;
                    while (++fe < this.length / 2) {
                        Hf = this[fe - 1];
                        DT = this[fe];
                        Kc = this[fe + 1];
                        if (Math.abs(Hf[1] - DT[1]) < nN) {
                            kA = Kc[1] - DT[1];
                            if (kA) {
                                DT[0] += (Kc[0] - DT[0]) * (Hf[1] - DT[1]) / kA
                            }
                            DT[1] = Hf[1]
                        }
                    }
                    return this
                },
                nx = this.vd.nx,
                c6 = this.vd.nx.c6 || 0,
                ep = nx.qd,
                QK = nx.eh,
                kx = nx.kx,
                Q5 = this.vd.Bx.length / nx.kx,
                nN = QK / 2,
                G_ = ep / 2,
                Tt = nx.vB,
                QY = nx.xh,
                lF = (ep + Tt) * kx - Tt,
                Aa = (QK + QY) * Q5 - QY,
                vC = (nx.bc - lF) / 2,
                gP = (nx.Ef - Aa) / 2,
                dd, Ci;
            GI.forEach(function(dd) {
                var sE = dd.sE,
                    xI, d0, uI;
                if (sE) {
                    var SP = (dd.SP + 2 || 0);
                    sE[0] = [dd.W6 ? SP : nx.bc - SP, sE[0] + gP];
                    sE[1] = [dd.W6 ? nx.bc - vC - c6 : vC + c6, sE[1] + gP];
                    xI = sE.pop();
                    dd.ZI.forEach(function(D8) {
                        d0 = vC + G_ + D8 % kx * (ep + Tt);
                        uI = gP + nN + Math.floor(D8 / kx) * (QK + QY) + dd.xT;
                        sE.push([d0, uI])
                    });
                    if (c6 !== 0) {
                        var kW = c6 / (dd.W6 ? xI[0] - d0 : d0 - xI[0]);
                        xI[1] = xI[1] - ((xI[1] - uI) * kW)
                    }
                    sE.push(xI);
                    mx.call(sE).reverse();
                    mx.call(sE).reverse()
                }
            });
            return GI
        },
        F4: function(LB, Vm, WS, vu, Y4) {
            var nx = this.vd.nx,
                kx = nx.kx,
                Q5 = nx.cd || nx.Q5,
                vT = 1,
                aG = 1,
                Ol = Vm * Q5 + 1,
                OL = LB * kx + 1,
                nL, nz, T1 = 1,
                Mt = 0.5,
                Ur, zW;
            xt.XK(z3.KS, function(ow) {
                if (ow.vT && ow.vT > vT) {
                    vT = ow.vT
                }
            });
            vT = this.vd.vT || vT;
            Ur = new Element("canvas", {
                width: OL * vT,
                height: Ol * vT,
                styles: {
                    width: OL,
                    height: Ol
                }
            });
            zW = Ur.getContext("2d");
            zW.scale(vT / aG, vT / aG);
            zW.fillStyle = "#fff";
            zW.fillRect(1, 1, OL - 1, Ol - 1);
            zW.globalCompositeOperation = "source-over";
            zW.fillStyle = (Y4) ? Y4 : (this.vd.qn === "") ? WS.Zi : this.vd.qn;
            WS.ZI.forEach(function(R4) {
                nz = LB * Math.floor(R4 / kx);
                nL = Vm * (R4 % kx), zW.fillRect(nL + 1, nz + 1, LB - 1, Vm - 1)
            });
            zW.globalCompositeOperation = "source-over";
            zW.lineWidth = T1;
            zW.strokeStyle = "#000";
            zW.strokeRect(Mt, Mt, OL - T1, Ol - T1);
            zW.strokeStyle = "#444";
            zW.beginPath();
            for (nL = LB; nL < OL - 1; nL += LB) {
                zW.moveTo(nL + Mt, T1);
                zW.lineTo(nL + Mt, Ol - T1)
            }
            zW.stroke();
            zW.beginPath();
            for (nz = Vm; nz < Ol - 1; nz += Vm) {
                zW.moveTo(T1, nz + Mt);
                zW.lineTo(OL - T1, nz + Mt)
            }
            zW.stroke();
            return (new Element("div", {
                "class": "HL"
            })).adopt(new Element("div", {
                "class": "MW",
                html: vu
            }), Ur)
        }
    })
})();
(function() {
    var tO = {},
        Bu = {};
    PrefixFree.properties.forEach(function(N0) {
        tO[StyleFix.camelCase(N0)] = StyleFix.camelCase(PrefixFree.prefixProperty(N0));
        Bu[N0] = PrefixFree.prefixProperty(N0)
    });
    Element.implement({
        sC: function(bS, yI) {
            this.style[tO[bS] || bS] = PrefixFree.value(yI.toString(), bS);
            return this
        },
        qQ: function(bS, yI) {
            return this.style[tO[bS] || bS]
        },
        za: function(S6) {
            var bS;
            for (bS in S6) {
                this.sC(bS, S6[bS])
            }
            return this
        },
        bN: function() {
            return new kG(this)
        }
    });
    yE.IQ = function(bS) {
        return tO[bS] || bS
    };
    yE.C8 = function(N0) {
        return Bu[N0] || N0
    }
})();
var w8 = new Class({
    Extends: Pn,
    initialize: function() {
        this.parent.apply(this, arguments);
        this.o3 = (new Element("div", {
            "class": "P1"
        })).inject(this)
    },
    dG: function() {
        this.parent();
        this.k6(0)
    },
    QV: function(UD, xa) {
        UD.Buttons.forEach(function(WY, BR) {
            this.fb("choice" + BR, new m9({
                c9: UD.Buttons.length > 1 ? "" : "Sp",
                vH: UD.Buttons.length > 1 ? WY.Text : "",
                Y5: 1
            })).b6("choice" + BR, function() {
                this.dG();
                xa(UD.Buttons[BR].Cmd)
            })
        }.bind(this));
        this.o3.set("text", UD.Reference ? i6("mproxy.Error.RGSid") + UD.Reference : "");
        return this.Td(new Element("p", {
            text: UD.Message
        }), UD.SupportInfo && (new Element("p", {
            text: UD.SupportInfo.Message
        })).adopt(new Element("address", {
            text: [UD.SupportInfo.PhoneNumber, UD.SupportInfo.Email].join("\n")
        })))
    }
});
var C0 = new Class({
    Extends: Request,
    options: {
        IA: 10000
    },
    initialize: function(Tp) {
        this.parent(Tp);
        delete this.headers["X-Requested-With"]
    },
    send: function() {
        var Jr = navigator.onLine;
        this.options.IA && setTimeout(this.cancel.bind(this), this.options.IA);
        Jr === false ? this.fireEvent("offline") : this.parent()
    }
});
var KR = (function() {
    var E5 = function() {
            if (0 >= --this.M1) {
                this.fireEvent("uA");
                this.fireEvent("LJ", this.Bz.status)
            } else {
                this.Bz.send()
            }
        },
        Jh = function() {
            this.fireEvent("rZ")
        },
        zB = function(L6) {
            var LF, iL, jq, L6;
            try {
                L6 = JSON.parse(L6)
            } catch (e) {
                return this.fireEvent("cV")
            }
            LF = L6.ReturnStatus;
            if (LF.Code != 1000000) {
                this.fireEvent("Ba", LF)
            } else {
                if (L6.Authentication && L6.Authentication.Status == "Pending") {
                    ++this.M1;
                    setTimeout(this.send.bind(this), this.BN *= 1.5)
                } else {
                    this.fireEvent("YH", L6)
                }
            }
        },
        N9 = function() {
            this.fireEvent("uA")
        };
    return new Class({
        Implements: Events,
        initialize: function(N8) {
            this.M1 = N8.M1 || 0;
            this.BN = N8.BN || 1000;
            this.Bz = new C0({
                url: N8.MG,
                data: N8.gc,
                method: N8.r1 || "post",
                async: N8.oQ ? 0 : 1,
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json; charset=utf8"
                },
                urlEncoded: 0,
                IA: N8.IA
            });
            this.Bz.addEvents({
                failure: N8.E5 || E5.bind(this),
                cancel: N8.E5 || E5.bind(this),
                success: N8.zB || zB.bind(this),
                complete: N8.N9 || N9.bind(this),
                offline: N8.Jh || Jh.bind(this)
            })
        },
        send: function() {
            this.Bz.send()
        },
        complete: function() {
            this.parent.apply(this, arguments)
        }
    })
})();
var aO = (function() {
    return new Class({
        Implements: [Sw, Events],
        vd: {
            nk: {
                requestTimeout: 10000,
                requestRetries: 0
            },
            rj: function(dv) {},
            Bj: function(dv) {},
            eq: function(QT) {},
            Xy: function(L6) {
                debugConsol.assert(0)
            },
            RI: function(iL) {},
            km: function() {}
        },
        jB: 0,
        initialize: function(vd) {
            this.jZ(vd)
        },
        dv: function(N8) {
            N8.MG = this.vd.nk.proxyUrl.concat(N8.Rl);
            N8.IA = this.vd.nk.requestTimeout || 0;
            N8.M1 = this.vd.nk.requestRetries || 0;
            if (N8.He) {
                N8.E5 = N8.n3 = N8.zB = N8.N9 = N8.Jh = function() {}
            }
            var Bz = (new KR(N8)).addEvents({
                rZ: N8.rj || this.vd.rj,
                LJ: N8.Bj || this.vd.Bj,
                Ba: N8.eq || this.vd.eq,
                YH: N8.Xy || this.vd.Xy,
                cV: N8.RI || this.vd.RI,
                lR: N8.km || this.vd.km
            });
            return Bz
        }
    })
})();
aO.TM = {
    Bh: function(fI) {
        return parseFloat(fI) || 0
    },
    ox: function(fI) {
        return parseInt(fI, 10) || 0
    },
    PW: function(fI) {
        return fI.split(",")
    },
    BE: function(fI) {
        return new Date(fI.substr(0, 4), fI.substr(4, 2), fI.substr(6, 2), fI.substr(8, 2), fI.substr(10, 2))
    },
    IC: function(Qn, T_) {
        var dq = {},
            GZ, iE = Qn.length;
        T_ = T_ || "@name";
        while (--iE >= 0) {
            GZ = Qn[iE];
            dq[GZ[T_]] = GZ;
            delete GZ[T_]
        }
        return dq
    }
};
var hZ = function(p1, nk) {
    nk.enableHighAccuracy = nk.enableHighAccuracy == "true";
    nk.maximumAge = nk.maximumAge || 300000;
    nk.timeout = nk.timeout || 600000;
    "geolocation" in navigator ? navigator.geolocation.getCurrentPosition(p1, p1, nk) : p1({
        message: "Device does not support navigator.geolocation",
        code: -1
    })
};
var wJ = new Class({
    initialize: function() {}
});
var p8 = (function() {
    var NP, nk, tA, vr, GK, i_, gF, oq = (function() {
            var dD, iT = {
                    closeGame: function() {
                        i_ && i_.dv({
                            Rl: "/close.action",
                            gc: JSON.stringify(vr.params),
                            E5: Wc,
                            n3: Wc,
                            zB: Wc,
                            Jh: Wc
                        }).send()
                    },
                    requestMobileNumber: function() {
                        UZ()
                    },
                    getGeoCoordinates: function() {
                        hZ(cc, nk.geoLocation)
                    },
                    insufficientFundsNotification: function() {
                        zk.jy()
                    }
                },
                U9 = {
                    closeGame: function() {
                        Ox = 1;
                        if (window.opener) {
                            window.close()
                        } else {
                            window.location = nk.console.lobbyURL
                        }
                    },
                    reloadGame: function() {
                        Ox = 1;
                        if (vr.params.mac) {
                            window.location = nk.console.lobbyURL
                        } else {
                            z3.KA()
                        }
                    },
                    switchToCashPlay: function() {
                        z3.KA({
                            playMode: "real"
                        })
                    },
                    gameInProgressReload: function() {
                        Ox = 1;
                        z3.KA(dD.Param)
                    },
                    "": function() {
                        zk.FP()
                    }
                };

            function Wc() {
                zk.Wc(dD)
            }
            return {
                QW: function(Lf) {
                    iT[""] = Lf && function() {
                        iT[""] = void 0;
                        Lf()
                    }
                },
                zg: function(R_) {
                    var V9 = R_["@name"],
                        uQ = {};
                    dD = R_;
                    R_.Param && Array.qB(R_.Param).forEach(function(fe) {
                        uQ[fe["@name"]] = fe["#text"]
                    });
                    R_.Param = uQ;
                    (iT[V9] || Wc)()
                },
                mY: function(V9, uQ) {
                    var Lf = U9[V9];
                    Lf ? Lf(uQ) : console.warn("No default handler for " + V9)
                }
            }
        })(),
        Tz = function(UD) {
            gF.eV || gF.SC();
            UD.Reference = "";
            UD.Buttons = Array.qB(UD.Buttons.Button);
            zk.FL(UD)
        },
        Ty = function(UD) {
            z3.KC && z3.KC.DN();
            gF.eV || gF.VS();
            UD.Buttons = Array.qB(UD.Buttons.Button);
            zk.FL(UD)
        },
        Rn, HZ, I6, G2, Ns = function(L6) {
            HZ = L6.GameLogicResponse;
            if (!I6) {
                I6 = Date.now()
            }
            Rn = HZ.OutcomeDetail.TransactionId;
            var Hj = 0;
            if (tA && tA.transactiondelay && tA.gameType && tA.gameType.toUpperCase() == "S") {
                Hj = tA.transactiondelay ? tA.transactiondelay * 1000 : 0;
                Hj = Math.max(0, Hj - (Date.now() - G2))
            }
            setTimeout(function() {
                HZ.OutcomeDetail.Balance = qS.i8(HZ.OutcomeDetail.Balance);
                HZ.Messages = HZ.Messages || [];
                if (HZ.Messages.Message) {
                    HZ.Messages = Array.qB(HZ.Messages.Message)
                }
                nw()
            }, Hj)
        },
        nw = function() {
            var UD = HZ.Messages && HZ.Messages.shift();
            gF.HZ = HZ;
            if (UD) {
                oq.QW(nw);
                Tz(UD)
            } else {
                gF.lN()
            }
        },
        rj = function() {
            return Ty({
                Message: i6("mproxy.Error.networkOffLine"),
                Buttons: {
                    Button: {
                        Text: i6("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": ""
                        }
                    }
                }
            })
        },
        Bj = function(LF) {
            return Ty({
                Message: i6(LF ? "mproxy.Error.networkError" : "mproxy.Error.connectionLost"),
                Reference: LF ? "MGC-002-" + LF : "MGC-001",
                Buttons: {
                    Button: {
                        Text: i6("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": LF ? "closeGame" : "reloadGame"
                        }
                    }
                }
            })
        },
        RI = function(dv) {
            return Ty({
                Message: i6("mproxy.Error.payloadError"),
                Reference: "MGC-003",
                Buttons: {
                    Button: {
                        Text: i6("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": "closeGame"
                        }
                    }
                }
            })
        },
        eq = function(q2) {
            var KK = q2.AdditionalInfo || {};
            KK.Action = KK.Action || "";
            KK.Buttons = KK.Buttons ? KK.Buttons.split(",").map(function(gM) {
                return i6("mproxy.Buttons." + gM)
            }) : [i6("mproxy.Buttons.OK")];
            return Ty({
                Message: q2.Message,
                Reference: q2.Code,
                Buttons: {
                    Button: KK.Action.split(",").map(function(V9, iE) {
                        return {
                            Text: KK.Buttons[iE] || V9,
                            Cmd: {
                                "@name": V9 || "closeGame"
                            }
                        }
                    })
                }
            })
        },
        wu = function(q2) {
            return Tz({
                Message: i6("mproxy.CancelSubmitMobileNumber.message"),
                Buttons: {
                    Button: {
                        Text: i6("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": "closeGame"
                        }
                    }
                }
            })
        },
        Xy = function(L6) {
            var iL = L6.Exception;
            return iL ? this.fireEvent("HB", iL) : this.fireEvent("P_", L6)
        },
        wE = function() {
            var yq = 0,
                vx = function() {};
            return function() {
                if (!yq) {
                    yq = 1;
                    document.body.style.display = "none";
                    i_ && i_.dv({
                        oQ: 1,
                        Rl: "/close.action",
                        gc: JSON.stringify(vr.params),
                        He: 1
                    }).send()
                }
            }
        },
        cc = function(d4) {
            var MC = {};
            if (d4.coords) {
                MC.latitude = d4.coords.latitude.toString();
                MC.longitude = d4.coords.longitude.toString()
            }
            MC.locationstatus = (d4.code || 0).toString();
            MC.locationmessage = d4.message || "";
            Nq(MC)
        },
        initResponse, J2 = function(xE) {
            function Oh(L6) {
                var qX = wE();
                window.addEvents({
                    beforeunload: qX,
                    unload: qX
                });
                JE = L6;
                qS.r3(JE.CURRENCY, vr.params.denomamount);
                JE.GameLogicResponse.OutcomeDetail.Balance = qS.i8(JE.GameLogicResponse.OutcomeDetail.Balance);
                zk.gV(JE.CURRENCY, JE.GameLogicResponse)
            }
            var uQ = xt.qE({
                getplayerbalance: (!!xE).toString()
            }, vr.params);
            oq.QW(J2);
            i_.dv({
                Rl: "/initstate.action",
                gc: JSON.stringify(uQ)
            }).addEvents({
                P_: Oh,
                HB: Ty
            }).send()
        },
        Nq = (function() {
            var WI = {
                requestMobileNumber: function(q2) {
                    UZ(q2)
                },
                initGeoCoordinates: function(q2) {
                    NZ(q2)
                }
            };
            return function(gQ) {
                function Bl(QT) {
                    var Lf = QT.AdditionalInfo && WI[QT.AdditionalInfo.Action] || eq;
                    Lf(QT)
                }

                function Bf(L6) {
                    var qX = wE();
                    window.addEvents({
                        beforeunload: qX,
                        unload: qX
                    });
                    zk.xy()
                }
                GK = GK || k2(xt.MD(vr.params, ["uniqueid", "nscode", "skincode", "softwareid"]));
                gQ = xt.qE(gQ || {}, vr.params);
                oq.QW(Nq);
                i_.dv({
                    Rl: "/authenticate.action",
                    gc: JSON.stringify(gQ),
                    eq: Bl
                }).addEvents({
                    P_: Bf,
                    HB: Ty
                }).send()
            }
        })(),
        BH = function() {
            function U5(oW, K0, LD) {
                if (K0 && 0 > LD.indexOf(K0)) {
                    this.zO(oW)
                } else {
                    this.Nl(oW)
                }
            }

            function Xf(Zs, Lj) {
                var oW = this.ZO(),
                    Uh = oW.PatternsBet;
                oW.PatternsBet = Zs;
                U5.call(this, oW, Uh, Lj)
            }

            function K1(Ly, xe) {
                var oW = this.ZO(),
                    B0 = oW.BetPerPattern && oW.BetPerPattern[qS] || 0;
                oW.BetPerPattern = oW.BetPerPattern || {};
                oW.BetPerPattern[qS] = qS.xV(Ly);
                U5.call(this, oW, qS.i8(B0).toString(), xe)
            }
            Rn = JE.GameLogicResponse.OutcomeDetail.TransactionId;
            gF.NC(gF.Qg = JE.Paytable);
            gF.Zl(HZ = gF.HZ = JE.GameLogicResponse);
            gF.a6(gF.HZ);
            JE = void 0;
            if (gF.HZ.PatternSliderInput) {
                if (gF.HZ.PatternSliderInput.PatternsBet) {
                    Xf.call(GK, gF.HZ.PatternSliderInput.PatternsBet, gF.Qg.PatternSliderInfo.PatternInfo.Step)
                }
                if (gF.HZ.PatternSliderInput.BetPerPattern) {
                    K1.call(GK, gF.HZ.PatternSliderInput.BetPerPattern, gF.Qg.PatternSliderInfo.BetInfo.Step)
                }
            }
            Z0.rp("progress")
        },
        UZ = (function() {
            var Wd, Zf;
            return function(q2) {
                var oW = GK.ZO(),
                    LL = q2.Message || [
                        ["", ""]
                    ];
                Zf = Zf || (new Element("form")).adopt(LL.length > 1 ? (new Element("select", {
                    name: "PH"
                })).adopt(LL.length > 1 && new Element("option", {
                    value: "",
                    text: i6("mproxy.SubmitMobileNumber.labelRegionCode")
                }), LL.map(function(XN) {
                    return new Element("option", {
                        value: XN[0],
                        text: XN[1]
                    })
                })) : new Element("input", {
                    type: "hidden",
                    name: "PH",
                    value: LL[0][0]
                }), (new Element("label", {
                    text: i6("mproxy.SubmitMobileNumber.labelDeviceNumber")
                })).adopt(new Element("input", {
                    type: "tel",
                    style: "-wap-input-format: '*N';",
                    name: "gh"
                }))).addEvent("submit", function() {
                    var gh = this.elements.gh.value,
                        PH = this.elements.PH.value,
                        oW = GK.ZO();
                    oW.deviceNumber = gh;
                    oW.regionCode = PH;
                    GK.zO(oW);
                    window.event && window.event.preventDefault();
                    if (gh && (PH || LL.length == 0)) {
                        Wd.pA(0);
                        i_.dv({
                            r1: "get",
                            Rl: "/subdnbr.action",
                            gc: {
                                devicenumber: gh,
                                regioncode: PH
                            }
                        }).addEvents({
                            P_: function(L6) {
                                delete L6.ReturnStatus.Code;
                                eq(L6.ReturnStatus)
                            },
                            uA: function() {
                                Wd.bE(0)
                            }
                        }).send()
                    }
                });
                Wd = Wd || Pn.CC(new Pn({
                    OU: "Wd",
                    c9: "LI uf"
                }).addEvents({
                    U0: Zf.fireEvent.bind(Zf, "submit"),
                    tc: function() {
                        Wd.bE(0);
                        wu()
                    }
                }).XZ({
                    tc: new m9({
                        vH: i6("mproxy.SubmitMobileNumber.buttonCancel"),
                        Y5: 1
                    }),
                    U0: new m9({
                        vH: i6("mproxy.SubmitMobileNumber.buttonValidate"),
                        Y5: 1
                    })
                }).Td(new Element("h1", {
                    text: i6("mproxy.SubmitMobileNumber.title")
                }), new Element("p", {
                    text: i6("mproxy.SubmitMobileNumber.message")
                }), Zf));
                document.body.grab(Wd, "top");
                Zf.elements.gh.value = oW.deviceNumber || "";
                Zf.focus();
                if (LL.length > 1) {
                    Zf.elements.PH.value = oW.regionCode || ""
                }
                return Wd.pA(1).bE(1)
            }
        })(),
        NZ = function(q2) {
            var nq = nq || Pn.CC(new Pn({
                OU: "D4",
                c9: "LI uf"
            })).Td(q2.Message).XZ({
                tc: new m9({
                    vH: i6("Game.buttonOk"),
                    Y5: 1
                })
            }).addEvents({
                tc: function() {
                    nq.toElement().destroy();
                    nq = void 0
                }
            }).addEvents({
                tc: function() {
                    hZ(cc, nk.geoLocation)
                }
            }).bE(1);
            document.body.grab(nq, "top")
        },
        dP = function() {
            if (vr.params.mac) {
                i_.dv({
                    r1: "get",
                    Rl: "/valdnbr.action",
                    gc: {
                        mac: vr.params.mac
                    },
                    Xy: function(L6) {
                        vr.params = L6.ReturnData;
                        Nq()
                    }
                }).send()
            } else {
                Nq()
            }
        },
        iD = function(gc) {
            var Hj = 0;
            if (HZ.OutcomeDetail.GameStatus && (HZ.OutcomeDetail.GameStatus == "Start") && tA.transactiondelay) {
                if (I6) {
                    Hj = Math.max(0, (tA.transactiondelay * 1000) - (Date.now() - I6))
                }
                I6 = 0;
                G2 = Date.now()
            }
            if (Hj) {
                setTimeout(function() {
                    zx(gc)
                }, Hj)
            } else {
                zx(gc)
            }
        },
        zx = (function() {
            var Rl;
            return function(gc) {
                Rl = Rl || "/play.action".concat(xt.Hk(vr.params, ["language", "presenttype", "channel", "freespin_tokenID", "freespin_bet", "freespin_lines", "freespin_num", "playMode"]));
                gc.GameLogicRequest.TransactionId = Rn;
                oq.QW();
                i_.dv({
                    Rl: Rl,
                    gc: JSON.stringify(gc)
                }).addEvents({
                    P_: Ns,
                    HB: Ty
                }).send()
            }
        })(),
        KE = (function() {
            var Rl;
            return function(QM, gc) {
                Rl = Rl || "/paytable.action".concat(xt.Hk(vr.params, ["language", "presenttype", "channel"]));
                oq.QW();
                i_.dv({
                    r1: "get",
                    Rl: Rl,
                    gc: JSON.stringify(gc)
                }).addEvents({
                    P_: QM,
                    HB: Ty
                }).send()
            }
        })(),
        Ox, zk = (function() {
            var FF, E2, LR = {},
                tJ;

            function II() {
                gF.Zl(gF.HZ);
                gF.C4()
            }
            return {
                qf: function(nk, vr) {
                    var Zj, tw = +new Date;
                    FF = document.createElement("iframe");
                    E2 = document.createElement("div");
                    E2.id = "zk";
                    E2.appendChild(FF);
                    document.body.insertBefore(E2, document.body.lastElementChild);
                    Z0.rp("queue", 1);
                    com.igt.mxf.setMessageOrigin(FF.contentWindow, nk.url).addOneShotEvent("consoleInitialised", function(nk) {
                        clearTimeout(Zj);
                        console.warn("Console loaded after " + (Math.round((tw - new Date) / 10) / 100) + "s");
                        if (nk) {
                            vr.uQ = xt.qE(vr.params, nk)
                        }
                        Z0.rp("progress", 1);
                        Z0.rp("console")
                    }).addEvents({
                        consoleResize: function(Ef) {
                            if (E2.style.height != Ef) {
                                E2.style.visibility = "visible";
                                E2.style.height = Ef;
                                document.body.offsetWidth;
                                X6()
                            }
                            com.igt.mxf.sendMessage("consoleResized", Ef)
                        },
                        command: function(V9, uQ) {
                            oq.mY(V9, uQ)
                        }
                    });
                    Zj = setTimeout(function() {
                        Z0.Tu(window.parent, "loaderror")
                    }, nk.timeout || 15000);
                    (function(MG) {
                        var a = document.createElement("a");
                        a.setAttribute("href", MG);
                        FF.src = a.href + (a.search ? "&" : "?") + xt.OH(vr.params, nk.urlParameterWhitelist)
                    })(nk.url)
                },
                jy: function() {
                    gF.HZ = HZ;
                    gF.J3();
                    z3.KC && z3.KC.DN();
                    if (tJ) {
                        com.igt.mxf.addOneShotEvent("resume", function() {
                            tJ = 0;
                            gF.sO(1)
                        });
                        com.igt.mxf.enableEvents(1);
                        HZ && com.igt.mxf.sendOutcome(HZ);
                        com.igt.mxf.sendMessage("insufficientFundsNotification")
                    } else {
                        gF.sO(1)
                    }
                },
                kX: function() {
                    gF.sO(0);
                    if (!tJ) {
                        tJ = 1;
                        com.igt.mxf.addOneShotEvent("wagerStarted", function() {
                            com.igt.mxf.enableEvents(0);
                            gF.Cd()
                        });
                        com.igt.mxf.sendMessage("wagerIsStarting")
                    } else {
                        gF.Cd()
                    }
                },
                KL: function() {
                    gF.sO(0);
                    if (!tJ) {
                        tJ = 1;
                        com.igt.mxf.addOneShotEvent("wagerStarted", function() {
                            com.igt.mxf.enableEvents(0);
                            gF.Rv()
                        });
                        com.igt.mxf.sendMessage("wagerIsStarting")
                    } else {
                        gF.Rv()
                    }
                },
                Kd: function() {
                    com.igt.mxf.addOneShotEvent("wagerComplete", function() {
                        tJ = 0;
                        gF.Eg()
                    });
                    E2.style.visibility = "";
                    com.igt.mxf.enableEvents(1);
                    com.igt.mxf.sendMessage("wagerIsComplete")
                },
                FP: function() {
                    gF.J3();
                    z3.KC && z3.KC.DN();
                    if (tJ) {
                        com.igt.mxf.addOneShotEvent("wagerAborted", function() {
                            tJ = 0;
                            gF.sO(1)
                        });
                        com.igt.mxf.enableEvents(1);
                        com.igt.mxf.sendMessage("wagerIsAborted")
                    } else {
                        gF.sO(1)
                    }
                },
                Wc: function(R_) {
                    com.igt.mxf.addOneShotEvent("resume", function() {
                        oq.mY(R_["@name"], R_.Param)
                    });
                    com.igt.mxf.sendMessage("command", R_["@name"], R_.Param)
                },
                FL: function(UD) {
                    com.igt.mxf.addOneShotEvent("resume", function(BR) {
                        E2.style.visibility = "";
                        if (UD.Buttons[BR]) {
                            oq.zg(UD.Buttons[BR].Cmd)
                        } else {
                            NP.QV(UD, oq.zg).bE(1);
                            E2.style.height = ""
                        }
                    });
                    com.igt.mxf.enableEvents(1);
                    com.igt.mxf.sendMessage("displayMessage", UD.Id, UD.Reference, UD.Message, UD.Buttons.map(function(WY) {
                        return WY.Text
                    }));
                    E2.style.visibility = "visible";
                    E2.style.height = 0
                },
                e5: function() {
                    if (gF.HZ.OutcomeDetail.Settled != 0) {
                        com.igt.mxf.addOneShotEvent("afterGameOutcome", II);
                        com.igt.mxf.sendOutcome(gF.HZ)
                    } else {
                        II()
                    }
                },
                xy: function() {
                    com.igt.mxf.addOneShotEvent("resume", function(Y8) {
                        J2(Y8)
                    });
                    com.igt.mxf.sendMessage("beforeInitGame")
                },
                gV: function(pL, Q1) {
                    com.igt.mxf.addOneShotEvent("afterGameOutcome", BH);
                    com.igt.mxf.setCurrencyFormat({
                        config: pL,
                        toCurrency: qS.xV,
                        format: qS.ff
                    });
                    com.igt.mxf.sendOutcome(Q1)
                },
                bE: function(B8) {
                    if (E2) {
                        E2.style.visibility = B8 ? "" : "hidden"
                    }
                },
                s3: function() {
                    E2.style.visibility = "";
                    com.igt.mxf.sendMessage("gameReady")
                }
            }
        })();
    Pn.qr = function(UO) {
        UO.addEvents({
            hP: function() {
                zk && zk.bE(0)
            },
            kw: function() {
                zk && zk.bE(1)
            }
        });
        return Pn.CC(UO)
    };
    return function(t1, Ga, fG, Vc) {
        nk = t1;
        tA = fG;
        vr = Ga;
        gF = new wJ.xc();
        if (document.querySelector("meta[name='com.igt.game.IOS9FIX'][content='yes']")) {
            var kQ = new Element("div", {
                id: "game"
            });
            var Zb = new Element("div", {
                id: "ios9fix"
            });
            Zb.style.position = "absolute";
            Zb.style.top = "0";
            Zb.style.left = "0";
            Zb.style.width = "100%";
            Zb.style.height = "100%";
            Zb.style.overflow = "hidden";
            gF.Ut = (Zb.adopt(kQ)).inject(document.body.lastElementChild, "before");
            gF.Ut = kQ
        } else {
            gF.Ut = (new Element("div", {
                id: "game"
            })).inject(document.body.lastElementChild, "before")
        }
        i_ = new aO({
            nk: nk.RGS,
            rj: rj,
            Bj: Bj,
            eq: eq,
            Xy: Xy,
            RI: RI
        });
        gF.Zh = Pn.CC(new w8({
            OU: "Zh",
            c9: "Bc uf"
        }));
        document.body.grab(gF.Zh, "top");
        NP = Pn.qr(new w8({
            OU: "NP",
            c9: "LI uf",
            PM: 0
        }).addEvents({
            hP: function() {
                Z0.rp("abortLoading"), gF.Zh.bE(0)
            }
        }));
        document.body.grab(NP, "top");

        function subvertBalanceMeterForPromotionalFreeSpin(gF) {
            if (!gF.UH) {
                throw new Error("You must expose UH on the game instance")
            }
            var FZ = gF.UH.E3.bind(gF.UH);
            gF.UH.vd.ji = Math.floor;
            gF.UH.vd.wr = Math.floor;
            gF.UH.E3 = function() {
                if (gF.HZ.PromotionalFreeSpin && gF.HZ.PromotionalFreeSpin["@count"]) {
                    FZ(gF.HZ.PromotionalFreeSpin["@count"])
                }
            };
            gF.UH.XA = function() {
                return Infinity
            };
            gF.UH.E3()
        }
        Vc.LZ("initialise", function ar() {
            Vc.UP("initialise", ar);
            gF.GK = GK;
            if (gF.HZ.PromotionalFreeSpin) {
                gF.Qg.PatternSliderInfo.PatternInfo.Step = [vr.params.freespin_lines];
                if (i6("Game.consoleBalance") === i6("Game.consoleBalance").toUpperCase()) {
                    K_.ur("Game.consoleBalance", i6("mproxy.PromotionalFreeSpin.consoleBalance").toUpperCase())
                } else {
                    K_.ur("Game.consoleBalance", i6("mproxy.PromotionalFreeSpin.consoleBalance"))
                }
            }
            gF.eV();
            gF.eV = void 0;
            if (gF.HZ.PromotionalFreeSpin) {
                subvertBalanceMeterForPromotionalFreeSpin(gF)
            }
            Z0.rp("initialised");
            zk.s3()
        });
        Vc.jm(["loaded", "console"], dP);
        zk.qf(nk.console, vr);
        gF.KL = zk.KL;
        gF.kX = zk.kX;
        gF.Kd = zk.Kd;
        gF.e5 = zk.e5;
        gF.Qj = zk.bE;
        if (tA && tA.transactiondelay && tA.gameType && tA.gameType.toUpperCase() == "S") {
            gF.zx = iD
        } else {
            gF.zx = zx
        }
        gF.KE = KE;
        gF.sO = function(Kl) {
            gF.DF(Kl && !Ox)
        }
    }
})();
wJ.TM = aO.TM;
/*! iScroll v5.1.3 ~ (c) 2008-2014 Matteo Spinelli ~ http://cubiq.org/license */
(function(window, document, Math) {
    var rAF = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
        window.setTimeout(callback, 1000 / 60)
    };
    var utils = (function() {
        var me = {};
        var R1 = document.createElement("div").style;
        var ZX = (function() {
            var vendors = ["t", "webkitT", "MozT", "msT", "OT"],
                transform, i = 0,
                l = vendors.length;
            for (; i < l; i++) {
                transform = vendors[i] + "ransform";
                if (transform in R1) {
                    return vendors[i].substr(0, vendors[i].length - 1)
                }
            }
            return false
        })();

        function U6(style) {
            if (ZX === false) {
                return false
            }
            if (ZX === "") {
                return style
            }
            return ZX + style.charAt(0).toUpperCase() + style.substr(1)
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
        var Q7 = U6("transform");
        me.extend(me, {
            hasTransform: Q7 !== false,
            hasPerspective: U6("perspective") in R1,
            hasTouch: "ontouchstart" in window,
            hasPointer: window.PointerEvent || window.MSPointerEvent,
            hasTransition: U6("transition") in R1
        });
        me.isBadAndroid = /Android /.test(window.navigator.appVersion) && !(/Chrome\/\d/.test(window.navigator.appVersion));
        me.extend(me.style = {}, {
            transform: Q7,
            transitionTimingFunction: U6("transitionTimingFunction"),
            transitionDuration: U6("transitionDuration"),
            transitionDelay: U6("transitionDelay"),
            transformOrigin: U6("transformOrigin")
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
                ev.IM = true;
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
        this.kT = {};
        this.wG();
        this.refresh();
        this.scrollTo(this.options.startX, this.options.startY);
        this.enable()
    }
    IScroll.prototype = {
        version: "5.1.3",
        wG: function() {
            this.Oe()
        },
        destroy: function() {
            this.Oe(true);
            this.MZ("destroy")
        },
        Wv: function(e) {
            if (e.target != this.scroller || !this.isInTransition) {
                return
            }
            this.BQ();
            if (!this.resetPosition(this.options.bounceTime)) {
                this.isInTransition = false;
                this.MZ("scrollEnd")
            }
        },
        Rg: function(e) {
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
            this.BQ();
            this.startTime = utils.getTime();
            if (this.options.useTransition && this.isInTransition) {
                this.isInTransition = false;
                pos = this.getComputedPosition();
                this.zC(Math.round(pos.x), Math.round(pos.y));
                this.MZ("scrollEnd")
            } else {
                if (!this.options.useTransition && this.isAnimating) {
                    this.isAnimating = false;
                    this.MZ("scrollEnd")
                }
            }
            this.startX = this.x;
            this.startY = this.y;
            this.absStartX = this.x;
            this.absStartY = this.y;
            this.pointX = point.pageX;
            this.pointY = point.pageY;
            this.MZ("beforeScrollStart")
        },
        Z1: function(e) {
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
                this.MZ("scrollStart")
            }
            this.moved = true;
            this.zC(newX, newY);
            if (timestamp - this.startTime > 300) {
                this.startTime = timestamp;
                this.startX = this.x;
                this.startY = this.y
            }
        },
        bs: function(e) {
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
                this.MZ("scrollCancel");
                return
            }
            if (this.kT.flick && duration < 200 && distanceX < 100 && distanceY < 100) {
                this.MZ("flick");
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
            this.MZ("scrollEnd")
        },
        mA: function() {
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
            this.MZ("refresh");
            this.resetPosition()
        },
        on: function(type, fn) {
            if (!this.kT[type]) {
                this.kT[type] = []
            }
            this.kT[type].push(fn)
        },
        off: function(type, fn) {
            if (!this.kT[type]) {
                return
            }
            var index = this.kT[type].indexOf(fn);
            if (index > -1) {
                this.kT[type].splice(index, 1)
            }
        },
        MZ: function(type) {
            if (!this.kT[type]) {
                return
            }
            var i = 0,
                l = this.kT[type].length;
            if (!l) {
                return
            }
            for (; i < l; i++) {
                this.kT[type][i].apply(this, [].slice.call(arguments, 1))
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
                this.SK(easing.style);
                this.BQ(time);
                this.zC(x, y)
            } else {
                this.z4(x, y, time, easing.fn)
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
        BQ: function(time) {
            time = time || 0;
            this.scrollerStyle[utils.style.transitionDuration] = time + "ms";
            if (!time && utils.isBadAndroid) {
                this.scrollerStyle[utils.style.transitionDuration] = "0.001s"
            }
        },
        SK: function(easing) {
            this.scrollerStyle[utils.style.transitionTimingFunction] = easing
        },
        zC: function(x, y) {
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
        Oe: function(remove) {
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
        z4: function(destX, destY, duration, easingFn) {
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
                    that.zC(destX, destY);
                    if (!that.resetPosition(that.options.bounceTime)) {
                        that.MZ("scrollEnd")
                    }
                    return
                }
                now = (now - startTime) / duration;
                easing = easingFn(now);
                newX = (destX - startX) * easing + startX;
                newY = (destY - startY) * easing + startY;
                that.zC(newX, newY);
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
                    this.Rg(e);
                    break;
                case "touchmove":
                case "pointermove":
                case "MSPointerMove":
                case "mousemove":
                    this.Z1(e);
                    break;
                case "touchend":
                case "pointerup":
                case "MSPointerUp":
                case "mouseup":
                case "touchcancel":
                case "pointercancel":
                case "MSPointerCancel":
                case "mousecancel":
                    this.bs(e);
                    break;
                case "orientationchange":
                case "resize":
                    this.mA();
                    break;
                case "transitionend":
                case "webkitTransitionEnd":
                case "oTransitionEnd":
                case "MSTransitionEnd":
                    this.Wv(e);
                    break;
                case "wheel":
                case "DOMMouseScroll":
                case "mousewheel":
                    this.qp(e);
                    break;
                case "keydown":
                    this.tZ(e);
                    break;
                case "click":
                    if (!e.IM) {
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
var Mu = (function() {
    return new Class({
        Extends: Pn,
        Binds: ["BF", "l3"],
        vd: {
            QL: 1
        },
        gK: 0,
        initialize: function(vd) {
            var mq;
            this.parent(vd);
            this.XZ({
                zN: new m9({
                    c9: "zN"
                }),
                xw: new m9({
                    c9: "xw"
                }),
                tc: new m9({
                    c9: "tc",
                    Y5: 1
                })
            });
            this.addEvents({
                xw: this.l3,
                zN: this.BF
            });
            this.Ut.adopt((new Element("div", {
                "class": "h_"
            })).adopt(this.bT, this.lI = new Element("div", {
                "class": "S3"
            }).adopt(this.nh)));
            this.DL = new IScroll(this.lI, {
                hScrollbar: false,
                vScrollbar: true,
                checkDOMChanges: false,
                hideScrollbar: false
            })
        },
        Td: function(UD) {
            var YU;
            this.parent(arguments);
            this.DL.scrollTo(0, 0, 0);
            setTimeout(this.DL.refresh.bind(this.DL), 200);
            return this
        },
        bE: function(B8) {
            if (B8) {
                this.gK = 0;
                this.dn(0)
            }
            this.parent(B8)
        },
        dG: function() {
            this.parent();
            this.Td("")
        },
        l3: function() {
            if (++this.gK >= this.vd.QL) {
                this.gK = 0
            }
            this.gK = Math.min(this.gK, this.vd.QL - 1);
            this.dn(this.gK)
        },
        dn: function(n_) {
            this.fireEvent("Lu", n_)
        },
        BF: function() {
            if (this.gK <= 0) {
                this.gK = this.vd.QL
            }
            this.gK = Math.max(--this.gK, 0);
            this.dn(this.gK)
        },
        pA: function(jn) {
            this.bT.pA(jn, "zN");
            this.bT.pA(jn, "xw");
            return this
        }
    })
})();
qc = {
    MT: {
        J4: [void 0, "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAXNJREFUeNpUUT1LA0EUnN3cmYSIEklAsBHxH/gHDJLCSo2gNoKNpdglBO3Uzs5OIXaCSjBWCjb2gloqGkSxiLk7z0u83Peue4cGMzAMj7czb98u4ZwjxGF5qlpXXmY7nk3DOkklNkritdXK0zz+gYSG3fUJZTiVzuRzK5Den2HdX0OzWri1NDQDRy0dNbJdQ6U0WZVBC4VCEdrBBgJDAfccgPFIL+MU35wcF2vaUmigDx/1uXxuGdp+GX7zTRg0MLMFZrVh2g6ynw6a/fLC3wTJDTwivT7C+mqC2R2RHESNcDNXTEk4PgJKyN50mo+rNqIFOzdX4I7dPRzCY4At6HH0QOojlKsdnQz6LoLfZqiGz6G7QuUYYozztQs9CqdjPjm789owbBe6iDMEVVdQ7G0KZyOdQLrtnvQ869ZiVklaQWZEt5F0A4ibwJBiaAwlYCZi6vapku0xhNiZGaoaKXnWk2g0WvYZGzC92ub5Z8/H/QgwAA5PxXqfuYnrAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYJJREFUeNpUUT1IQlEYPVd9VmSm9D82BEXQ0hJRSw2N/YEENQURtbc1NEREa6AtETQIRaIQTUEFRUTgJkmCRFFm6vP3vXy/9/bei0IPnOHynXPPd+4ljDGY2N9ZDqVeH2ZkqWQzz3aHixLnQGQvEJlHDYhp2N6YzLq9fe0jk+tIfaiIxd4hlj8g8pfQ5LecPxjt+Dfsbi6G7PbGuam5LRwd3iKbqUCSNRBjKMkqWrkLEKKcHIdvFkyDLfN+Pzs8vooD/zWSySzS6RJ4XkChIKJSriJTHISn+cX3l+CgukQSCQHpzxJEQYauU2ugUQZzXVF2w25TyMTYGvuWW2AVvLl6hlAj/oVpoGBUr+1sJDCOFfkXIiseoxGxdrfkhlinCpyOL2g6x67uAtbltqLQG25riYJS1aBmUddVaJpksIouTxx8uee07llXfENZUWprT+f7UVXc1u4NXB7d3jhcTYXc4dlTR53BxNL0aMjTnJrhHIoVrWpOmq90RoLnj3Uf9yPAAF3hydF9XDs/AAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYBJREFUeNpUUT0sQ1EYPfe11TYIqhUbEUMHooMBg0EXm6pEMBosdqMaLTaTxKSJ0DTaSZdKGvEXiZShSFC/wVO8/np/fde7r9Hoyb3Jl/udc7577iWUUjCsLM+G+fSxTxGzHDshlgatYHNH1lajE/gHwgRLC94Pu6Pb2e+dx/WbjIPUI8TcC+r4OMw/j5mN4JmrKggszoSJye4f8QcQCCbwnMmjJCoghKAkKfDQXVggb8VCiSkm4HJPR+M9w3NYWI/jIs3j/l3A61cB70IBX/kSzotudFnvJ/8mmKkqkpPbvE7MIluUoJY1o6GpehL9up9KE6ycTLxjQ3RPGADHmqH9SwhFsUqugAk0pvyfGWaFWmgukyai2swiGavC18llBa0cD0mz0Hj00DDnbqTOHY8taTQNt7JaqRVJ3yX01V/hrtC+XfOs01O9H7zscCbzbnwrjYZ7i0mAp/EKbVYhs7mdctUIGEb9g+EO+6vPbpKN0T/lOu2h6IrEIqc1H/crwAA+ZL5w8eTkhgAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYNJREFUeNpUUU0vA1EUPW/oKCKpmkYQWyKRFH9AJCLs6iNiQSKxIGXTrYV0y4YFXUjsWJA2LMWmC1+pdFNNE+mCkMZXx1BNpzPTmXneDEVv8vLue+eee+55j1BKYcXe+lzkJn3pk+UcZ53rnA1mZ0v30XQwPI5/QSzCxvJgtq2lQxgeWUKdYoI+P0GUMjhNHSPzdicGNq88v4Td1ZkI76gdm5gKgsbjoIUCoOvfKNvDqQiKuro/u34yZV1xyfTZ6PDQAmgsBipJQD4PyDJQLIIqCvqEHtx8pCfLCtWappD6vAJqFWoaYJrfCBvVYMvlaIRqqCTkH6Betxe2QfP2FlDVv2K7nkI3DKjl8coKfBVPX1/uiOBsAiEE5AfQGVlmivefj3BwPPWHonZzrqux4zCaubBBpVSCwjpaeY55kJiXhJRAq7P9oOJZ1+Z7s4LTI3jdPXDxLhis+2shi8T7Nd40UVzZSXoqCFZsLfZHMvKDjxm0pXmuxmzmW48C2+cVH/clwABa/cABYaRFJQAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAXpJREFUeNpUkTssQ1Ecxr9ztcXgEWlrMdgkBgtGCREWkdQjYpBaTGIxCUtTY2O3kEgEqaRIPHYWCxodDBJuFBFuya26j3Pveei9QvQ7yzn5/3//833nECklPK2lZjLq/XnMsnTFO1eH6kW0oeNgfiU9hn8iHpBaGNCikbZw7+Ac6AeBdvcGvfiI2/wR9JJaWF4/j/wBq8vTmWCwdnR4PIncYQ6mboI7vFwBmMNw+7ENJmg6sXEy6QHKvXo20tM3i+xeFvqzDuPdgFW0YH/aoAZFI+nGp7iZ+L0h4DKbfD27fqNjOZDiJ5PkEkIIBGQTBChJxIdkI++HHzB/9VDR7APlJaQA4/x/ZgSqSEgWNJVUk0jZNvG9e/KmU0ZRYk8gSkgmN4/94Uq90r7/Qk/hMAcud+Ey19+bjgnDNlCUFwjy1t2KZ12Md2khNIfrRCeCaPKtmPwVJXIJpmiFla3rSAXgaWmqP0OJGhPEVn4KNSLAWg5SO2cVH/ctwAArDMouom/JaQAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAXhJREFUeNpUUUsvQ0EYPVO3Vx+kEhXqse1K4gf4AZXYlMZrIRFbiSDYkNhaSDxXtmyQRv+DdGNFK6SxIEH1cVVLM72P6R0zVzx6kpkvmXPO9xrCOYfE8e5YPJNJRSmtuiDefN5mO9zXmpheS8XwD0QattcHiz2h7mBkeAbe+iPqWhLam4bk1QOyxU9taTvX8Ws42orEVVUdjU2twLrdAK89g9eppAARE5cMukVOZjfLk9Lgurm7HYkMTcBMr8KupGDTR3D9FdzIwzZKGOilyBQ84z8VFNO0iNe4BpNCqwJw9s1wG3UbCHgYTEbI3kKA93dRKJKzns7EVf4TS73YBRMGw0IDFFXhvJB/Ju1+BkKczh1Icc0AnkoK3E2cz+9UXM4M4U79/OLe55C6KY7ISEX8EHO/V4F01oeuFv20Ya2bc8Fiu98K9ocoAl7m9F78UHCT8+GdurWNQ62jwSCxv9gWf6k0R03mckqrTbYd9BuJ5YNyw8d9CTAA1ge6+NBkWwgAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAXlJREFUeNpUUU1LAlEUPW8aM5MkUiOCiBaStA8KKmhbBFYUrVq0aV1GiwiiXbUwaNcfiD6wpEUbF22MCjfRQuxj4VeK+ZEziY76Zl4zE4qey+HyuOfc++57hDEGDaf7q97oV9AlVUROO7cTs2KpDvp2zvyLaALRDAcb0xlr15BtanIdwoeA+MMnxFISCfkRRaSyh7che8Nw4l7y8pxxYXZuF/d71xATedRKFRBC1FxFzhEE4+nFUeBlRTNwsWxwfnx0Df7tc6RfYyhEMiimCiimBZTzvzC89YEOZJfrE3iqSCQTTOvCilCGQmW9wBQZTA1SMIIZZLI55mR8uBf6gqGrZ0iFUkP8D02uqEGbdwZPKM9yP1HCSSYQNaCzLq6CdgtAjWOep7DenONj1hvJGVGLtQZllRSSyhLocBokbr5seVb3jCPD5U027Y5E7NC7y5YiqPMbrEfKHt9F7C0GDVsTI165X3TBKOujUWlTSLLT5wm8t3zcnwADAKXOvJhPA1MNAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAXJJREFUeNpUUTtLA0EQ/vYudxGJInmUkv9gYyFYCaKVDxC1ERsj1laKoKCVRZoUio9KBIVgfoOIIGhjKWiMGizy0NyZy132dse9E8V8zDAMM998M7uMiBBga3sk//VanPDdlhbkLBqVlIoXsjt30/gHFhDWVgcqRiKRHBpbwptTxn35FsK2QY8loGFVc7mn1B9hfXM4j4g+NT63gaPrLL48G0L6qsJAJNH78A7my7PjbHE2IGjOS3FycHQR+1e7qDUrsD0LTruJlvIgVuNdiH16M78KEeKcPdlF2K6FtmiHUwMEq5IktAwduiA2v5ymuiKHB948X4IL76/5h6FMpeTT/5uVgq6R91Fj3FRrh1f9NhMElzCsNoTG6HSvFA7XrD7zIlZuQKqi8OVPVO57ErwpEK+7qJuR845nzWT6K040kqz2dcE1NUgBmE2OVMNFN5fVw+O3VAchwMJKOt/j8AlDUijNNSY/Db1wcvDa8XHfAgwAlnzI6m3b+yoAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAXVJREFUeNpUUU0vA1EUPTNpHxmRNkwjSCwrFlRs/QBdUd8WIvYW0oUuNV2wsCLBL2Dho2n/gUVjrxUiNkhGUKNadDoznc71XhsfPcl9L3nnnHtu7pOICAKH+7PJm6tcxCh/yQBBaWtx+4Pt6cXV3DT+QRKG7fjoa29fjxqeWIbC7kHmOfS8jkzmDpr2qUc3ngO/hoPdsSRjbGpmaQ1UjIMcjQcYgqrfpykHFVM6Wo4VF4RBvry4ngyPz4PeYyA7B9TueT0B7guoVsBIyMDNbevcT4LHtqtSG8uCylzolviT02DIRa0G+P0OLFuS9hI+Gh4yIAvOLZ/wo/gnFnq+C4cbLBtN8DBGlH/WJLXDgcTHFiUgxEYFeNA88HqJVuKlenN5IGimzjIKDBMwrUYJYekDKPDQbE5BT7d53LTWrZj6qnZW1dCgAb/Pqc+ez3uQvVLwVvDq6zt6oMkgsJfwJ7XHlohlyfVoxly3K2Clo5vFpo/7FmAAlnixZNoJQskAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYlJREFUeNpUUUtIAlEUPU+zMvuAVmRoRBHRZ9cmF7XVdpXUumW0i6AWfQiKKGgX7Vq0CpIkFy0KiiCiaBcFJZIRlR+cAZ3UaXwz8yZnwsgDj8flnXPuPfcRTdOgY393JvjydDUq5jMmvbbWNDB3lyc0Pbvnxz8QXbC94uNa3H2NI/4FMFKJTDaPNPeG+5sDcLEwv7h50VQSmN2OZLDB3jowMbWJGC8gkxNRUGSYq2rh7BgEFw/XXF8e9niGxo90gSnycD7m888j+pmEKBVQkGVQWYGsqMWjoK13BInX28lShwpKRSIzS5GYh8oYSpn0mxVra70TCv0m68uTmrvHCyNgKp2Bqqp/5JJALXaglP7PjAqLxaqlElFSZ3fpOwAhxHjQDSRJAh+PwGyp1pbWAoa5ydnpOX6+C0D6lgw3SgsGMZfN4ksQ8PF8hrrm/kDZWlfnhjmbvb3R1e01ZmZMhcC/IxY+hSi88xs7d01lAh0by/5gOvk4qtCc6XdWG7M5ukOrWydlH/cjwAB9PsVz483UdAAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAX9JREFUeNpUkc1LAkEYxp/d3DUrtKBOEmTg39Al6Fx00IIIOnQq6FJHDxHRKYJKKCrw1rFA8tIf4DkqCKIvMsusdK2M9WNnZ2em3Y1EHxiG4Xl+8877jiSEgKOD3Zlk7uY8YtR02TkrPh/vGAimVmPpSTRJcoD1lRGtJzjQOzw+hy/pE5mfa+jaOwpnl6h/FEtbm/d9DSAejyY9qndidGYZp9lDlIkGyoljwWQGjPQdBGFHO2u30w4g568vokNjs0hlEnirZvBlFPBDPqGb36hRHXSwG/KrPvVfwWMRIuV5zg3WrSq4YK7BhAXOBWinAi/l0nwsLMyQDTvmpZa2w5VG2JU9C8EEGOXNPcMDpU18f7xI3K/+NSVJ7s7tMDUYeLEO7pFFYuPBvVxm/V0n4qpkmxzM5LDsRQmDWbVAdAr1qQyjx3fcMtbFpZBm+b29JBQA61Tdp4gyQXu2DKVilvb2n/taAEcLsXBSLdUjMmVuaabI3Ai0pxLbjy0f9yvAAKc/zKDBZtFlAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYJJREFUeNpUUb0vBEEcfbvn49aKRHKc81HQKPkTUInGVyI0Go0QSo24CI2EgkgUFGriQnT+AJH4CJErRBYhvu52nbNn1+3szozZFeJeMslk3nu/N29G4pzDx+bycOLm+qTHtk0Z4iisqKyutnFvPH7Qj3+QfMPSdLsejTVFOrpGwdwcPnQNmbcXJC8PYRjPRnwlWfVnWF8cSJQUl/Z1D83g9nIfjp0BpcSnwDyCs/MjuK63NbV4NugbZO3quLetcwTa+Q4+s4/4st5Avj5A8iaIYyFW04C0kR74TSgixJFcSw+EHrHBOfthOAVjDOHSMpHoSbMTrTxWUwdZMEg9nBaKfb0oThmH69H/nVEkwPXUvaSWqZCkoFZAUDHdcTxkslnIcojPrl7IQYfqSHRXu7tBnnggLhXLgyP2lk1gWg5eU09Q1crtgmeNjzXrilIeiVbXIxxWxN0BM5dDWn9CPv9pLGxoVQUGH3OTLQkz995DqRtEh0LFTFEq9ubXkgUf9y3AAEVBykMixLCfAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAY1JREFUeNpUUb8vQ1EYPbf6JFWq9SMkVNoOEoMYJKwECyLEr8Qg/AFiIEwWixAR0jAIESNaxNAYOkiYiEUjDLQVReNVf9F6r6/vXn1PmrQn383NzT3n+3LORxhjULBun3IGHy76U8mIRnkTnYmmLW2nG/P2QeSAKILFhR6+uKaxorV3Fn5ixG2M4Zf3IX2zCxb0hHZWXZVZQQFn/HJyxtrm9rElbH7ocBUBXgQCXluG15oOcJ93RQ73ScNIe69DEWjC9+cDTd0zWPYyPCYYAgLAi0AoBcQkBp9tFNUB90h2gpaKCeKh5XgTGL7TgPxvCTRzMyojrq8DJyVI39wk89uGoRp08RTxHLIKJQw5DSaJuZ6hlTk9iwWfiGiwKRlkivzzM2QqJFHy6YGk1bGzlT21uebD3HliudtWP1lKUA8Vk6CJGOh3GFafA++mlsO8WCemu/ioob7Cax3Cj96c6S5DH32GzX8E089TaH/rsjJPoGBwftxZFbruL5Ti6ugUZ6DB0qbT47WDvMX9CTAAr9W7oFOadr8AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYRJREFUeNpUUbtKA0EUPRN3DYLrIyZiaWGRxg9QEUQ7QUgURSwtbKwEG7UIWCiIpaCgvSgEI4hWCmlUEFQsfCE+AiGQh9nsxs3OZnfG2QWDucNwZzjn3HvuDOGcw429tdn4x9d1pGKWfO7dLzWzTjmcWNg5nsC/IK5gY3Ek1xnoCQ4Nz4OmLeQeUlC1NF6L51BpKr+6fxuqCbZXZuKy1DQ+Fo3hYTcJI6vDMasCIbBFfvWfwSbWQew4Oe0KfO/pq+jgwBzutkS1tyx+MioqhTLM7zKoZqCtGIamfE79dZCqjknKL7oglmCVKbjDPIAzDibsSmYrmM8iS6P9vLkQhjdg6uIJlm7WyJ4AroDB5vb/mSE1cJnnCx/ET9uEbVIDXDJlVehyFsSR+frppVfc16J3H2Va72EJsMpsb7tnw6H4sQ2U2p8hl7oO6551abI311gJBBXhUaYKmFiGrELveIbdpOY344+hOoEby2N9capkIkyyvNbEbmSSFkpsnNzUfdyvAAMALPHJgt+9ty8AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAW9JREFUeNpUkc9Kw0AQxr9NYtVChWoLFnwTFfQoKlgV9eDJV1CL4FULHkpB8FB8AFEIFlG8ePUgvYgeKihYW/pH05SYtknTJLsmaa12YJhd5vvN7MwSxhhcO42vi7mPxyW91eDcu08YomPCaHo3lVnBPyMucLQzLYWCE6GZ2S1oxRLKTxkoqoR3JYvvtlKNn+XDPeBkf14UeN/yYnQPD6kEmp9lmC0dhBBYTsz7a7AJOz+4Km24AJcrPkenJjdxf3wI+TULtVyAJn9Bq0nQVQV+GdACbO23g2DabaK8ZFEvFdBu1EFty0swSuGOx+nOmQfZnhtngSKBN+Db3TWMutoTe4DjtkOY3aX0OnCUMFkuEMEgzrv/EtQVUwZ9wAFssMRtxSvODau4rAUp2rQjsLpRtxmaNoUWYiAKu+hba2w1IvE6QoMSAW90qhs+x51lUj+qSbES7gNciy1ERGsES0zozAUTFCpLJ28qfR/3I8AA7gTElXK97BkAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYVJREFUeNpUUc8rBGEYfr7ZWb82Vuzm4MpFtlycyIlyXBQOckAkf4GbAzkoB5FEQi62lnV0kCKtcuSyrUjZsnbW7I+Z2flm5vvGzBTZ5/R+vc/zvc/zvsS2bbjY2ZyNf6STUaoVBfftq2vkNeGuxNrq+Rj+gbiCteXBXLCtM9Q3vISsxpD6yECRM5BTVzDkd2lr9zH8J9hYn4r7/PWjwxMriN0lkS8roJYF4jSpaUF8vQQYPdvfvp50BcJn+n6kd2gBpzd3eM9J+CqWICsqCqoGpVJBqSmCBuVl/HeCyEydvOU1j6hRA4xzr8Ecq65dXWiGwA0yPTdgFxsj8AImU2molP6RPThkzhk4s/5nhmj7/LacfSNmTYuTiHjeXXBHzAwTgvoJRvz2ycGt97mgBTouAtIjmGmCWyaYE9hyalPXYVQ0BMtPKIntsaq1Ls715HR/a6gQ6IYhBj3vop5Hs/qMeutb2jt6DlcJXMzM98cDNBMVbeqNtkgtL/naEseHD1WH+xFgAJihyphwnesbAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAXpJREFUeNpUUbtKA0EUPbubh0kwAU1AUBSx8ScEQT8gJiAKFnYp7QRFBAsljZW1gkgKA8H8gYUpDRZqMKRI8O26WdfobrKP2XFmQDEHhstwzzn33BmJUgqO4/xKqdGqpq1uR+b3SDDqj0fGyrmD8yz+QeKC/fXZ95GhieT8XA6K+gGzVkO784Ir9RKq9aZtnNRTf4LD7UwpFAhnFrJbeC0U4GoafNtmHUnUC3IDh5LTteLtEhfI9YfqwtzMKp6PjtBrNuGoKlxdh2cY8L6+MGkN4zH8ufg7IeB4toTmkyASywIlRDSo58FncaNeGJ5EpL30NB03hyAWNCoVENP8IwsBOx4TuL7/f2cEglCo2r6X4sxJLMWycxBG7jEDVTKh+DLdLN8Jc3nUTpxdB1/RZU2HuTmscuK366LjOGhF20iYsWLfs+4sT73HnYEkz8gzc3dD7uI+psMM9bTdYivVJ+DIZ6dL+sB32lWIGB0gij9oRcrbZ42+j/sRYADqlciGzWDmkgAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYZJREFUeNpUkT1IQlEcxc/V1MzACqWiIGlpqKEtXNok3awwWpuMlmhtFByioaKGwIiGCDIkhwaDWoKIpoYCS4pUECu11Jfv6fu4t/eeFHm2C7/D+Z9zCWMMmrY2lmL51JVf5MsG7W1ot1O51x3fDO3N4p+IZgitegudfaOOCd8KMvUO3OUF8KU0pOQR2OdjMbJz6fwzhNeCMYOpY8YzH8b2bRFvNRl1iYIQQJAZBpLrMMq14+jm4byeXEpdTI97lrF+XcBTqYFcVUKBl1HkFVQEGZkeH3rLN3O/CW1U5MlD1Yocx4ETKRTa7ETVUxmjqJr6VUgg/sUAS3d7oRdMPKtwQ/mDdWljKDKYJP7vjDbFaGXljxfSsAxCPxykyVMFVKrDxqUgkXYW3z1prvdmd58O5aKgYl0FRDC5oYNU4KDUKnB9nSNvGYu2zLoQnCyULS7Hq30KNXO/WkCBlc9iuJJAl5gtHuzfOlsMmgJLszEnf+830289WjTY6LtpJB6LnLV83I8AAwDjRcfZnJDetQAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYdJREFUeNpUUc8rRFEU/u7MGwwzjBpZKD+SWdnPyspKNoMSdlKUlBVWEgsbYiFmwx9AJmIlSUlpamThZ5H8mJExw8wb8+O9d9+913uvyHynW/d0vu+e75xLhBAwsbYyGIrehgNKXraZueR0cWejb3d2ar8H/0BMwfx0e8JT1+xt6xxFEgoe5GdkE29IRI5RiL8mlxcvav4ES0v9IXtpWXfHwAz2Ho/wpWagMQpiFDVOQU8OjQvdXJ077TMFttjNWZe/YxjbDweIZuP4LKQha9/IaDnktAKUJh8csZfe3w4SU1XyytIGMYW8roALbhWYEZxz0Ao3CKVkaMIvlEYfrAEj8esisgVjF4JxMMr+zwwJDkmk3p8Iq6yCaZxY7gFukHWVAh9JcLskNhbC1uM2Wle/Y7+6hK5QME2Hbh6DqOUUqJkCnE/3yFXXbhWtdWy8NUHdHm++oQV6uQvC8E7SMspf7lGSlZPB4F1NkcDEyKQ/VPoZD9ipZrVmkoPnq7y768vnRR/3I8AAPYvH8hBmEQ4AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYdJREFUeNpUkT0sQ1EUx/+3r63UZyMqBgNi6GIukkbEZCA+EhEjCQOTxEoY2JiwsNiIRjGYBJH4CEEkPgZfqdJoi1b7Xt9797179T3RtL+TO9yc8z/n/s8lnHMYLEz1+4LBkw5ZiVuMu9VSyBy62z+5stmNLIghmB5tiTiLa8u8TcOIPqp4OA0gKb4houwixQLRuY0LV0YwO9bnEwRHV2v7BLZmDvD1noAqURBCoKYoaOUOIKir83sHvYbA8hY+7vR4BrE+vovgTRifgRjiH0n8RJIQvyXIz27YKl56/idYdSaT18tEujAO6UcB05iZ0BkHAwdNlIDYVDLgbeTJ63qYBs/9d5Dicqb4Dw7OGXSuZXuGFbqNf389E11xGpbS8QdLhwYKFIfBqI0vHx6ZzS00VLUhVF9B49TsppmHQuUKFC7BUXUPMVSxlrPWkba6CI2VlklPbmhiEYzXk4IY8mvuYXfGoovbt64cgcFQc4MvrzzUIdhVc7Su2pn04fIv7Z/lfNyvAAMADJ3GxDc8e38AAAAASUVORK5CYII="],
        L1: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAXVJREFUeNpUUUsvA1EYPXdmWopEaJvG4x/Y+wEkwq5IxE5ELO1EIsKGSOOxJSIiliSN/gZsxMqKRJRRaqHa0elM53Ef5k7j0fPl5ubee875cr5LhBCQONwcyz7rD+m6Yyvy3BqN8p54Z24hczuJfyBSsLU0+JGMJxPDY3PgZgFG4RqVagV3+Rd8Vmul1T09+Ss42BjJRlR1Ij29jKfLXfj1MjjzII0Ep7h5/ITlsNOV/cK0FCiP+fvxodFZ5C+24ZjFQGCAujUwzwL1HaQ6IqjYbOqng+b5HuGm3nAOCEKw8EFG83wOjRAwIcjiTK8YSMUQBqw8X4HTP7IEZQK1OodZZ/8zQ4toqigbJdIqfDAuQIKSuyQaFsWXzaAQiJ2TYmiu9HW3n9/r7zAtF1WLoRoQyiYNl+1wGC5Fm6aeNY11bb7/I6qQRFdMQ4uqgAd3ltsgu0yUMsdvySaBxNpcf9amPB0EDFurhPCYpuTWj16bPu5bgAEAHyHU3gO5rvsAAAAASUVORK5CYII=",
        vg: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAKCAYAAACALL/6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAcFJREFUeNpckT9oE3EcxT+/313umktzSaSJba1VoRgEi6ioLajULgZ0UFxcFXSQLqVgEXeHipPo4OaiHRRBHBQ0/htEMEItVCpJg2lrNKk2ueaSJrnkTAIufqYvj8cX3nvi9nWFFm7mVYS9vd2kUxn6d4S5M1/maFRhNBji5qd0YW6pPtzyrci22XwfYTxQYOjXGgfLJrlnJfZJi/N9AdSfea5sE8GxA/pi+7NMvtPdQ7rG7mwIPRFkbMJk+mWME16Dt/fXqIUlsekbXNT8BpqYlHtsU+h2DTvroe6rszDp8ORMnP7t8IEiR6LjDMbOcfLqFANe97Ka1BX8tSKpvId/GAMK4XKodW2gNxd4tP9wRxcNpUfOr6v8T0lUkI0NNOklu5RFyq6O7ihCqGeNKiOan+Gwhu00kOsK35crBAY3qTUrbBk6xciDGXJPZ1EuXMvLrz7Lrfo0fH11PLYHB5dqSfBjGUYJ8HExTub5Y17M3GKlIu6J1g6dWiPeAqbVxZ+cylyqzrddJS4d38lq+jdF1+ahLcqvE5u+9g7COpYjXgyS3NpDwrCInO7mS9NkNlvE6Q1zd9UtvPlcjbZz/BVgAGSFouuHExi9AAAAAElFTkSuQmCC"
    }
};
wJ.xc = (function() {
    var Cp = {
            RC: ["w01", "s01", "s02", "s03", "s04", "s05", "s06", "s07", "s08", "s09", "s10", "s11", "b01"],
            aF: {
                w01: 11,
                b01: 11
            },
            vp: [20, 0, 5, 10, 15, 21, 1, 6, 11, 16, 22, 2, 7, 12, 17, 23, 3, 8, 13, 18, 24, 4, 9, 14, 19],
            Bx: [0, 3, 6, 9, 12, 1, 4, 7, 10, 13, 2, 5, 8, 11, 14],
            W3: ["L0C0R0", "L0C1R0", "L0C2R0", "L0C3R0", "L0C4R0", "L0C0R1", "L0C1R1", "L0C2R1", "L0C3R1", "L0C4R1", "L0C0R2", "L0C1R2", "L0C2R2", "L0C3R2", "L0C4R2"].k3(),
            Fk: ["Scatter", "Line 1", "Line 2", "Line 3", "Line 4", "Line 5", "Line 6", "Line 7", "Line 8", "Line 9", "Line 10", "Line 11", "Line 12", "Line 13", "Line 14", "Line 15", "Line 16", "Line 17", "Line 18", "Line 19", "Line 20"].k3(),
            nx: {
                kx: 5,
                Q5: 5,
                cd: 3,
                eh: 56,
                qd: 56,
                xh: 0,
                vB: 3,
                bc: 316,
                Ef: 174
            },
            Bw: [{
                Zi: "#FC0060"
            }, {
                W6: 1,
                Zi: "#DC4408",
                ZI: [5, 6, 7, 8, 9],
                sE: [84, 84],
                xT: 0
            }, {
                W6: 1,
                Zi: "#403C88",
                ZI: [0, 1, 2, 3, 4],
                sE: [35, 35],
                xT: 0
            }, {
                W6: 1,
                Zi: "#004884",
                ZI: [10, 11, 12, 13, 14],
                sE: [133, 133],
                xT: 0
            }, {
                W6: 1,
                Zi: "#FC9898",
                ZI: [0, 6, 12, 8, 4],
                sE: [7, 14],
                xT: -6
            }, {
                W6: 1,
                Zi: "#A468A4",
                ZI: [10, 6, 2, 8, 14],
                sE: [161, 154],
                xT: +6
            }, {
                W6: 1,
                Zi: "#F4AC00",
                ZI: [0, 1, 7, 13, 14],
                sE: [49, 119],
                xT: 0
            }, {
                W6: 1,
                Zi: "#80005C",
                ZI: [10, 11, 7, 3, 4],
                sE: [119, 49],
                xT: 0
            }, {
                W6: 1,
                Zi: "#489430",
                ZI: [5, 1, 7, 13, 9],
                sE: [103, 71],
                xT: +9
            }, {
                W6: 1,
                Zi: "#FCE000",
                ZI: [5, 11, 7, 3, 9],
                sE: [65, 97],
                xT: -9
            }, {
                W6: 1,
                Zi: "#C8D4D8",
                ZI: [0, 6, 7, 8, 14],
                sE: [21, 141],
                xT: -12
            }, {
                W6: 1,
                Zi: "#6CC044",
                ZI: [10, 6, 7, 8, 4],
                sE: [147, 27],
                xT: +12
            }, {
                W6: 0,
                Zi: "#BCA464",
                ZI: [14, 8, 2, 1, 5],
                sE: [119, 74],
                xT: +3
            }, {
                W6: 0,
                Zi: "#24C0FC",
                ZI: [4, 8, 12, 11, 5],
                sE: [54, 94],
                xT: +3
            }, {
                W6: 0,
                Zi: "#A43884",
                ZI: [14, 8, 2, 6, 5],
                sE: [161, 99],
                xT: +16
            }, {
                W6: 0,
                Zi: "#94341C",
                ZI: [4, 8, 12, 6, 5],
                sE: [7, 69],
                xT: -16
            }, {
                W6: 0,
                Zi: "#548890",
                ZI: [9, 13, 7, 1, 0],
                sE: [77, 28],
                xT: -12
            }, {
                W6: 0,
                Zi: "#D04C4C",
                ZI: [9, 3, 7, 11, 10],
                sE: [91, 140],
                xT: +12
            }, {
                W6: 0,
                Zi: "#2894D8",
                ZI: [14, 13, 7, 1, 5],
                sE: [133, 78],
                xT: -6
            }, {
                W6: 0,
                Zi: "#64BC7C",
                ZI: [4, 3, 7, 11, 5],
                sE: [40, 84],
                xT: +6
            }, {
                W6: 0,
                Zi: "#641084",
                ZI: [14, 8, 2, 1, 0],
                sE: [147, 15],
                xT: -3
            }]
        },
        sB = (function() {
            var rm = [1, 2, 3, 4, 5].map(function() {
                return Cp.RC
            });
            return function(JM) {
                return Cp.vp.map(function(iE, dq) {
                    return JM[Cp.Bx[dq]] || rm[Math.floor(dq % 5)].getRandom()
                })
            }
        })();
    Cp.Gr = qc.MT.J4.map(function(P7, iE) {
        var jU = Cp.Bw[iE];
        return P7 && (new Element("div", {
            "class": "xM"
        })).adopt(new Element("img", {
            src: P7,
            "class": "CS"
        }), new Element("img", {
            src: qc.MT.vg,
            "class": "h7"
        }), new Element("img", {
            src: qc.MT.L1,
            "class": "Oo"
        }))
    });
    var GP = function() {
            this.Ey.AW()
        },
        dM = function() {
            this.fF.bE(0);
            this.uH.Kl(0);
            this.DZ.FM(1)
        },
        hx = function() {
            var oW = this.GK.ZO();
            this.DZ.FM(0);
            oW.PatternsBet = this.Ey.XA();
            this.GK.zO(oW);
            this.sO(1)
        },
        ki = function(HN) {
            this.DZ.kz(HN, this.Ey.kE);
            this.G8.bO(HN);
            this.OM.E3(this.Wu());
            this.sO(1)
        };
    var a8 = function() {
            this.fF.AW()
        },
        wx = function() {
            this.uH.Kl(0);
            this.Ey.bE(0)
        },
        uE = function() {
            var oW = this.GK.ZO();
            oW.BetPerPattern[qS] = qS.xV(this.fF.XA());
            this.GK.zO(oW);
            this.sO(1)
        },
        Tc = function(HN) {
            this.S0.bO(Oq(HN));
            this.OM.E3(this.Wu());
            this.sO(1)
        };
    var aq = function() {
        this.DZ.Sy(0);
        this.Ey.bE(0);
        this.fF.bE(0);
        this.Ud.Z6();
        this.KL()
    };
    var r6 = function() {
        this.zx({
            GameLogicRequest: {
                ActionInput: {
                    Action: "play"
                },
                PatternSliderInput: {
                    BetPerPattern: this.fF.XA(),
                    PatternsBet: this.Ey.XA()
                }
            }
        })
    };
    return new Class({
        Extends: wJ,
        Implements: Events,
        eV: function() {
            var r2 = this,
                oW = this.GK.ZO();
            this.JU = (new Mu({
                OU: "JU",
                c9: "UC",
                QL: i6("Game.mboxHowToPlay").length,
                TQ: 1
            })).addEvents({
                Lu: this.Ht.bind(this),
                Dz: oI.W_,
                qT: oI.D7
            });
            com.igt.mxf.registerControl({
                type: "command",
                name: "howToPlay",
                text: i6("MenuCommand.howToPlay"),
                enabled: 1
            }).addEvent("change", this.JU.bE.bind(this.JU, 1));
            this.q3 = (new Mu({
                OU: "q3",
                c9: "UC",
                QL: i6("Game.mboxPaytable").length,
                TQ: 1
            })).addEvents({
                Lu: this.dH.bind(this),
                Dz: oI.W_,
                qT: oI.D7
            });
            com.igt.mxf.registerControl({
                type: "command",
                name: "paytable",
                text: i6("MenuCommand.payTable"),
                enabled: 1
            }).addEvent("change", this.q3.bE.bind(this.q3, 1));
            [this.JU, this.q3].forEach(function(UO) {
                document.body.grab(Pn.qr(UO), "top")
            }, this);
            document.body.grab(new Element("div", {
                id: "iW"
            }));
            this.Ud = new fY({
                OU: "VI"
            });
            this.DZ = new rC(Cp.Bw, {
                nx: Cp.nx,
                pK: "round",
                Gr: Cp.Gr,
                Bx: Cp.Bx,
                Jc: this.Qg.PatternSliderInfo.PatternInfo.Step,
                hg: this.HZ.PatternSliderInput.PatternsBet
            });
            this.WE = (new WE({
                nx: Cp.nx,
                hR: "Cg",
                H4: 5,
                Dn: 360,
                Kq: 60,
                uU: 300,
                yb: 0,
                vp: Cp.vp
            })).addEvents({
                X3: r6.bind(this),
                bL: this.e5.bind(this)
            });
            this.OM = new jz({
                Ut: new Element("span")
            });
            com.igt.mxf.registerControl({
                type: "stake",
                name: "stake",
                text: i6("Game.consoleBet"),
                enabled: 0,
                valueText: Oq(0),
                value: 0
            }).linkEvent("change", this.OM, "rh");
            this.Ar = new jz({
                Ut: new Element("span")
            });
            this.Cw = new jz({
                Ut: new Element("span"),
                ji: Math.floor
            });
            this.T0 = new jz({
                Ut: new Element("span"),
                ji: Math.floor
            });
            this.UH = new jz({
                Ut: new Element("span"),
                MN: this.HZ.OutcomeDetail.Balance
            });
            com.igt.mxf.registerControl({
                type: "balance",
                name: "totalBalance",
                text: i6("Game.consoleBalance"),
                enabled: 1,
                valueText: Oq(this.HZ.OutcomeDetail.Balance),
                value: qS.xV(this.HZ.OutcomeDetail.Balance)
            }).addEvent("change", function(HN) {
                HN = HN >= 0 ? HN : 0;
                this.UH.E3(qS.i8(HN));
                this.HZ.OutcomeDetail.Balance = this.UH.XA();
                this.sO(1)
            }.bind(this));
            this.uH = (new m9({
                OU: "cJ",
                vH: i6("Game.buttonSpin"),
                Y5: 0
            })).addEvents({
                RB: aq.bind(this)
            });
            this.S0 = (new m9({
                OU: "DC",
                Y5: 0
            })).addEvents({
                kO: a8.bind(this)
            }).Kg((new Element("div", {
                "class": "e7"
            })).adopt(new Element("div", {
                html: i6("Game.buttonBetPerPattern")
            })));
            this.fF = new Lq({
                OU: "Ly",
                SI: this.Qg.PatternSliderInfo.BetInfo.Step,
                wr: Oq,
                c2: i6("Game.selectorBetPerPattern") + " ",
                xn: {
                    C_: "#555",
                    lx: 1
                }
            }).addEvents({
                rh: Tc.bind(this),
                hP: wx.bind(this),
                kw: uE.bind(this)
            });
            var tz = com.igt.mxf.registerControl({
                type: "list",
                name: "betPerPattern",
                text: i6("Game.buttonBetPerPattern"),
                enabled: 0,
                value: qS.i8(oW.BetPerPattern[qS]).toString(),
                valueText: this.Qg.PatternSliderInfo.BetInfo.Step.map(Oq),
                values: this.Qg.PatternSliderInfo.BetInfo.Step
            }).addEvent("change", function(HN) {
                if (this.S0.Kl) {
                    this.fF.E3(HN)
                }
            }.bind(this)).linkEvent("change", this.fF, "rh").linkEvent("enable", this.S0, "Kl");
            this.G8 = (new m9({
                OU: "ZR",
                Kl: 0
            })).addEvents({
                kO: GP.bind(this)
            }).Kg((new Element("div", {
                "class": "e7"
            })).adopt(new Element("div", {
                html: i6("Game.buttonPatternsBet")
            })));
            this.Ey = (new Lq({
                OU: "Zs",
                SI: this.Qg.PatternSliderInfo.PatternInfo.Step,
                c2: i6("Game.selectorPatternsBet"),
                xn: {
                    C_: "#555",
                    lx: 0
                }
            })).addEvents({
                rh: ki.bind(this),
                hP: dM.bind(this),
                kw: hx.bind(this)
            });
            var rF = com.igt.mxf.registerControl({
                type: "list",
                name: "patternsBet",
                text: i6("Game.buttonPatternsBet"),
                enabled: 0,
                valueText: this.Qg.PatternSliderInfo.PatternInfo.Step,
                values: this.Qg.PatternSliderInfo.PatternInfo.Step,
                value: oW.PatternsBet
            }).addEvent("change", function(HN) {
                if (this.G8.Kl) {
                    this.Ey.E3(HN)
                }
            }.bind(this)).linkEvent("change", this.Ey, "rh").linkEvent("enable", this.G8, "Kl");
            this.fF.E3(qS.i8(oW.BetPerPattern[qS]).toString());
            this.Ey.E3(oW.PatternsBet);
            this.Tf = new m9({
                OU: "t0",
                Y5: 1,
                vH: i6("Game.buttonSkip")
            });
            this.g5 = (new m9({
                OU: "wO",
                Y5: 1,
                vH: i6("Game.buttonStart")
            })).addEvents({
                RB: function() {
                    this.g5.bE(0);
                    this.kX()
                }.bind(this)
            });
            this.Ut.adopt(new Element("div", {
                id: "Rp"
            }), new Element("div", {
                id: "Ge"
            }), (new Element("div", {
                id: "bM"
            })).adopt(this.Zh, new Element("div", {
                id: "NM"
            }), (new Element("div", {
                id: "Qx",
                styles: {
                    backgroundImage: yE.RW == "x0" ? "" : "none"
                }
            })).adopt(this.WE), new Element("div", {
                id: "ac"
            }), this.DZ), this.Ud, new Element("div", {
                id: "tV"
            }), this.fF, this.Ey, (new Element("div", {
                id: "e6"
            })).adopt((new Element("div", {
                id: "PM"
            })).adopt(this.G8, this.S0, this.uH, this.Tf, this.g5)), new Element("div", {
                id: "Ot"
            }).adopt(new Element("div", {
                id: "Ec",
                "class": "o8"
            }).adopt(new Element("span", {
                "class": "e7",
                text: i6("Game.consoleBalance")
            }), this.UH), new Element("div", {
                id: "L2",
                "class": "o8"
            }).adopt(new Element("hr"), new Element("span", {
                "class": "e7",
                text: i6("Game.consoleBet")
            }), this.OM), new Element("div", {
                id: "Xm",
                "class": "o8"
            }).adopt(new Element("hr"), new Element("span", {
                "class": "e7",
                text: i6("Game.consoleBonus")
            }), this.Ar), new Element("div", {
                id: "Hr",
                "class": "o8"
            }).adopt(new Element("hr"), new Element("span", {
                "class": "e7",
                text: i6("Game.consoleSpins")
            }), this.Cw, new Element("span", {
                text: "/"
            }), this.T0)));
            this.Mr();
            if (this.HZ.OutcomeDetail.Stage == "FreeSpin" || this.HZ.OutcomeDetail.NextStage == "FreeSpin") {
                document.body.addClass("Dm");
                this.Ar.E3(this.HZ.PrizeOutcome["FreeSpin.Total"] || 0);
                this.Cw.E3(this.HZ.FreeSpinOutcome.Count);
                this.T0.E3(this.HZ.FreeSpinOutcome.TotalAwarded);
                this.HZ.OutcomeDetail.Stage = "FreeSpin";
                this.g5.bE(1)
            } else {
                this.sO(1)
            }
            this.WE.d3(this.HZ.PopulationOutcome[this.HZ.OutcomeDetail.Stage + ".Reels"].ZI);
            this.HZ.OutcomeDetail.GameStatus == "Initial" && this.sO(1)
        },
        Mr: function() {
            var r2 = this,
                qx = function() {
                    return r2.HZ.PrizeOutcome[r2.ZF + ".Lines"]["@totalPay"] + r2.HZ.PrizeOutcome[r2.ZF + ".Scatter"]["@totalPay"]
                },
                E9 = function(UD, Zi) {
                    r2.Ud.sC("color", Zi).Td(UD)
                },
                yg = function(NS) {
                    var hG = r2.HZ.PrizeOutcome[r2.ZF + ".Scatter"].Prize.concat(r2.HZ.PrizeOutcome[r2.ZF + ".Lines"].Prize);
                    hG.forEach(function(MQ) {
                        r2.DZ.wn(MQ);
                        MQ.w9 = r2.WE.a7(MQ.I0.filter(function(GZ) {
                            return (MQ.sK == 0 || MQ["@multiplier"] == "2.0") && Cp.aF[r2.HZ.PopulationOutcome[r2.ZF + ".Reels"].ZI[GZ]]
                        }))
                    }, this);
                    NS.zL(hG.sort(function(jH, TW) {
                        return TW["@totalPay"] - jH["@totalPay"] || jH.sK - TW.sK
                    })).zV.jZ({
                        f_: r2.ZF == "BaseGame" ? 4 : 5
                    })
                },
                Dh = function(NS, jI) {
                    var MQ = NS.Zz(jI),
                        CV = r2.HZ.OutcomeDetail.Stage == "FreeSpin" && r2.HZ.OutcomeDetail.NextStage == "BaseGame",
                        eH = MQ["@totalPay"] + (MQ.sK == 0 && CV && r2.HZ.PrizeOutcome["FreeSpin.Total"]),
                        Fy = MQ.sK ? "Game.lineWin" : CV ? "Game.freeSpinWin" : "Game.scatterWin";
                    E9(uM(Fy, Oq(eH)), Cp.Bw[MQ.sK].Zi);
                    wk.sK = MQ.sK
                },
                Am = function() {
                    var U1 = r2.ZF == "BaseGame" ? r2.HZ.PrizeOutcome["Game.Total"] : qx();
                    E9(uM(U1 ? r2.ZF == "BaseGame" ? "Game.totalWin" : "Game.bonusWin" : "Game.gameOver", Oq(U1)), "#fff")
                },
                tD = new Cz((new iQ({
                    Ki: 1200
                })).addEvents({
                    fp: function() {
                        E9(uM(r2.ZF == "BaseGame" ? "Game.totalWin" : "Game.bonusWin", Oq(r2.ZF == "BaseGame" ? r2.HZ.PrizeOutcome["Game.Total"] : qx())), "#fff");
                        r2.DZ.w_(r2.HZ.PrizeOutcome[r2.ZF + ".Lines"].Prize).Sy(1)
                    },
                    Uk: function() {
                        r2.DZ.Sy(0)
                    },
                    nM: function() {
                        r2.DZ.Sy(0)
                    }
                }), function() {
                    return r2.HZ.PrizeOutcome[r2.ZF + ".Lines"].Prize.length > 1
                }),
                wk = (new Sf(null, {
                    bS: "backgroundPosition",
                    eP: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 0].map(function(iE) {
                        return (iE * -Cp.nx.qd) + "px"
                    }),
                    aA: 100
                })).addEvent("lC", function(NS, jI, AO) {
                    if (AO == 0) {
                        r2.DZ.Sy(jI % (NS.vd.f_ * 2))
                    }
                }).addEvent("Uk", function(NS) {
                    r2.DZ.Sy(0)
                }),
                Mf = new Class({
                    Extends: N3,
                    initialize: function(zV, DZ) {
                        this.DZ = DZ;
                        this.zV = zV;
                        this.MQ = null;
                        this.Dl = []
                    },
                    HD: function(jI, AO) {
                        this.MQ = this.Dl[jI];
                        this.DZ.wn(this.MQ).Sy(1);
                        this.zV.Xl(this.MQ.w9).Rg(this.V5)
                    },
                    zL: function(Dl) {
                        Dl = Dl || [];
                        Dl = Dl instanceof Array ? Dl : [Dl];
                        this.vd.Hi = 0;
                        this.vd.A4 = 1;
                        this.vd.NF = Dl.length;
                        this.vd.f_ = Dl.length;
                        this.Dl = Dl.slice(0);
                        return this
                    },
                    Zz: function(jI) {
                        return this.Dl[jI]
                    },
                    R8: function() {
                        return this.Dl[this.jI]
                    },
                    bs: function() {
                        if (this.h6) {
                            this.zV.bs();
                            this.DZ.Sy(0);
                            this.parent()
                        }
                    },
                    uA: function() {
                        this.DZ.Sy(0);
                        this.parent()
                    }
                }),
                wF = new Mf(wk, this.DZ).addEvents({
                    fp: yg,
                    lC: Dh,
                    Uk: Am
                }),
                wb = ["NJ", "fT", "U8", "n0", "z1", "lE"].map(function(Oz, iE) {
                    var XR = new Element("div", {
                        "class": Oz
                    });
                    return (new Element("div", {
                        "class": "wb",
                    })).adopt([XR, XR.clone().addClass("cB").sC("transform", yX.Q7.gj(-1, 1)), XR.clone().addClass("mj").sC("transform", yX.Q7.gj(1, -1)), XR.clone().addClass("Fl").sC("transform", yX.Q7.gj(-1, -1))])
                }),
                ZM = {
                    aW: new Element("div", {
                        "class": "gz"
                    })
                },
                M_ = {
                    aW: ZM.aW.clone()
                },
                Nv = (new Element("div", {
                    id: "Nv",
                    "class": "Ch"
                })).adopt(new Element("div", {
                    "class": "CM"
                }).adopt(new Element("div", {
                    "class": "z9"
                }).adopt(ZM.aW))),
                sf = (new Element("div", {
                    id: "sf",
                    "class": "Ch"
                })).adopt(new Element("div", {
                    "class": "CM"
                }).adopt(new Element("div", {
                    "class": "Ff"
                }).adopt(M_.aW))),
                zY = 1,
                lz = new C2(new mR(Nv, {
                    Ki: 500,
                    unit: "px",
                    duration: 1000 * zY,
                    KY: {
                        left: 0
                    },
                    ws: 0
                }), new mR(sf, {
                    Ki: 500,
                    unit: "px",
                    duration: 1000 * zY,
                    KY: {
                        right: 0
                    },
                    ws: 0
                })).addEvents({
                    fp: this.Ud.Z6.bind(this.Ud)
                }),
                pd = new C2(new mR(Nv, {
                    duration: 1000 * zY,
                    KY: {
                        left: -z3.KS.Nv.bc + "px"
                    },
                    ws: 0
                }), new mR(sf, {
                    duration: 1000 * zY,
                    KY: {
                        right: -z3.KS.sf.bc + "px"
                    },
                    ws: 0
                })),
                eb = (new Cz((new iQ({
                    Ki: 4000
                })).addEvents({
                    fp: function() {
                        r2.Zh.Td(i6("Game.capFreeSpin")).bE(1)
                    },
                    Uk: function() {
                        r2.Zh.bE(0)
                    }
                }), function() {
                    return r2.HZ.FreeSpinOutcome.IncrementTriggered == "true" && r2.HZ.FreeSpinOutcome.MaxAwarded == "true"
                })),
                ru = new Cz((new j2(lz, new iQ({
                    Ki: 2000
                }), pd)).addEvents({
                    fp: function() {
                        var TU = uM("Game.bonusRetriggerSub", r2.HZ.FreeSpinOutcome.Awarded);
                        var UD = uM("Game.bonusRetrigger", "<span>" + TU + "</span>");
                        ZM.aW.set("html", UD).sC("font-size", "21px");
                        M_.aW.set("html", UD).sC("font-size", "21px")
                    }
                }), function() {
                    return r2.HZ.FreeSpinOutcome.IncrementTriggered == "true" && r2.HZ.FreeSpinOutcome.MaxAwarded == "false"
                }),
                Od = this.Tf.bE.bind(this.Tf, 1),
                PO = this.Tf.bE.bind(this.Tf, 0),
                YP = new Cz((new j2(tD, wF, this.UH.bY(), this.Ar.bY())).addEvents({
                    nM: PO,
                    Uk: PO,
                    fp: Od
                }), function() {
                    return r2.HZ.AwardCapOutcome.AwardCapExceeded == "false" && qx()
                }),
                bP = new Cz((r2.Zh.SE("kw")).addEvents({
                    fp: function() {
                        r2.Zh.Td(uM("Game.capAward", TV(r2.HZ.PrizeOutcome["Game.Total"]))).fb("tc", new m9({
                            vH: i6("Game.buttonOk"),
                            Y5: 1
                        })).bE(1)
                    }
                }), function() {
                    return r2.HZ.AwardCapOutcome.AwardCapExceeded == "true"
                }),
                PJ = (new C2(YP, new iQ({
                    Ki: 1000
                }))).addEvents({
                    fp: function() {
                        r2.Ar.ft(r2.HZ.PrizeOutcome["FreeSpin.Total"], r2.HZ.PatternSliderInput.BetPerPattern * r2.HZ.PatternSliderInput.PatternsBet)
                    },
                    Uk: function() {
                        r2.Ar.E3(r2.HZ.PrizeOutcome["FreeSpin.Total"])
                    }
                }),
                uk = (new iQ({
                    Ki: 2000
                })).addEvent("Uk", function() {
                    r2.WE.d3(r2.HZ.PopulationOutcome[r2.HZ.OutcomeDetail.NextStage + ".Reels"].ZI);
                    r2.Cw.E3(r2.HZ.FreeSpinOutcome.Count);
                    r2.T0.E3(r2.HZ.FreeSpinOutcome.TotalAwarded);
                    r2.Ar.E3(0);
                    document.body.toggleClass("Dm");
                    document.body.offsetWidth;
                    r2.ZF = r2.HZ.OutcomeDetail.NextStage
                }),
                uz = new N3({
                    NF: wb.length,
                    uZ: 1,
                    aA: 200
                }),
                KD = new N3({
                    NF: wb.length,
                    Hi: wb.length - 1,
                    A4: -1,
                    uZ: 1,
                    aA: 100
                });
                console.log('adopt');
            $("Qx").adopt(Nv, sf, wb);
            uz.HD = KD.HD = function(jI, AO) {
                var DD = wb[jI % wb.length],
                    lb = wb[(jI + 1) % wb.length];
                if (DD) {
                    DD.style.visibility = "hidden"
                }
                if (lb) {
                    lb.style.visibility = "visible"
                }
                document.body.offsetWidth;
                return 1
            };
            KD.addEvents({
                Uk: function() {
                    wb[0].za({
                        visibility: "hidden"
                    })
                }
            });
            this.JV = (new j2(bP, YP)).addEvents({
                fp: function() {
                    r2.UH.ft(r2.HZ.OutcomeDetail.Balance, r2.HZ.PatternSliderInput.BetPerPattern * r2.HZ.PatternSliderInput.PatternsBet)
                },
                Uk: function() {
                    var U1 = r2.ZF == "BaseGame" ? r2.HZ.PrizeOutcome["Game.Total"] : qx();
                    E9(uM(U1 ? "Game.winPaid" : "Game.gameOver", Oq(U1)), "#fff");
                    r2.UH.E3(r2.HZ.OutcomeDetail.Balance);
                    PO();
                    r2.Kd()
                }
            });
            this.PJ = (new j2(eb, ru, PJ)).addEvents({
                Uk: function() {
                    r2.Eg()
                }
            });
            this.Tf.addEvent("RB", function() {
                YP.bs()
            });
            this.QF = (new j2(lz, uz, KD, uk, pd)).addEvents({
                fp: function() {
                    var UD = uM("Game.bonusInitiated", r2.HZ.FreeSpinOutcome.TotalAwarded);
                    ZM.aW.set("text", UD);
                    M_.aW.set("text", UD)
                },
                Uk: function() {
                    r2.Eg()
                }
            });
            this.nG = (new j2(PJ, lz, uk, pd, this.JV)).addEvents({
                fp: function() {
                    var UD = uM("Game.bonusTotal", Oq(r2.HZ.PrizeOutcome["FreeSpin.Total"]));
                    ZM.aW.set("html", UD);
                    M_.aW.set("html", UD)
                }
            })
        },
        Ht: function(n_) {
            this.JU.pA(1).Td(i6("Game.mboxHowToPlay")[n_])
        },
        dH: (function() {
            var tM, bz = wJ.TM,
                Z_ = xt.qE(xt.dB(Cp.RC.k3(), function(iE, Bv) {
                    return '<img class="' + Bv + '"/>'
                })),
                Ku = function(n_) {
                    var UD = Elements.nP(i6("Game.mboxPaytable")[n_].substitute(Z_)),
                        Ww = (new Element("div")).adopt(UD),
                        zh = Ww.querySelector("winlinediagrams");
                    zh && zh.adopt(Cp.Bw.map(function(sE, BR) {
                        return sE.ZI && this.F4(11, 11, sE, BR)
                    }, this.DZ));
                    tM[n_] = Ww.getChildren()
                };
            return function(n_) {
                var r2, QR;
                if (tM) {
                    tM[n_] || Ku.call(this, n_);
                    this.q3.pA(1).Td(tM[n_])
                } else {
                    r2 = this;
                    QR = function(Gh) {
                        var Ax = [];
                        tM = [];
                        Z_.awardCap = TV(qS.i8(bz.Bh(Gh.Paytable.AwardCapInfo)));
                        Gh.Paytable.PrizeInfo = wJ.TM.IC(Array.qB(Gh.Paytable.PrizeInfo));
                        Gh.Paytable.PrizeInfo.PrizeInfoLines = Array.qB(Gh.Paytable.PrizeInfo.PrizeInfoLines.Prize).map(function(hq) {
                            var gL = [];
                            hq.PrizePay.forEach(function(F7) {
                                var Bv = F7["@count"];
                                gL[Bv] = F7["@value"];
                                Ax[Bv] = Bv
                            });
                            hq.PrizePay = gL;
                            return hq
                        });

                        function sS(sM, sN) {
                            return ["<thead><tr><th></th>", sM, "</tr></thead><tbody>", sN, "</tbody>"].join("")
                        }
                        Ax.sort();
                        Z_.paytableLines = sS(Ax.map(function(iE) {
                            return iE && "<th>".concat(iE, "x</th>")
                        }).join(""), Gh.Paytable.PrizeInfo.PrizeInfoLines.map(function(hq) {
                            return '<tr><th><img class="'.concat(hq["@name"], '"/></th>', Ax.map(function(iE) {
                                var GZ = hq.PrizePay[iE];
                                return iE && "<td>".concat(GZ ? "x" : "", GZ || "-", "</td>")
                            }).join(""), "</tr>")
                        }).join(""));
                        return r2.dH(n_)
                    };
                    this.KE(QR)
                }
            }
        })(),
        NC: function(Hy) {
            xt.XK(Hy.PatternSliderInfo, function(wj) {
                wj.Step = Array.qB(wj.Step)
            });
            this.Qg = Hy
        },
        a6: function(Gh) {
            Gh.PopulationOutcome = wJ.TM.IC(Array.qB(Gh.PopulationOutcome).map(function(fQ) {
                fQ.ZI = sB(fQ["#text"].split(","));
                delete fQ["#text"];
                return fQ
            }))
        },
        Zl: function(Gh) {
            var bz = wJ.TM;
            Gh.HighlightOutcome && Array.qB(Gh.HighlightOutcome).map(function(PR) {
                var tk = Array.qB(this.PrizeOutcome).filter(function(tk) {
                    return tk["@name"] == PR["@name"]
                })[0];
                Array.qB(PR.Highlight).forEach(function(dt) {
                    var hq = Array.qB(tk.Prize).filter(function(hq) {
                        return hq["@name"] == dt["@name"]
                    })[0];
                    if (hq) {
                        hq.I0 = dt["#text"].split(",").Sb(Cp.W3)
                    }
                })
            }, Gh);
            Gh.PrizeOutcome && Gh.PrizeOutcome.map(function(fQ) {
                fQ["@totalPay"] = bz.Bh(fQ["@totalPay"]);
                fQ.Prize = Array.qB(fQ.Prize);
                fQ.Prize.forEach(function(fe) {
                    fe["@totalPay"] = bz.Bh(fe["@totalPay"]);
                    fe.sK = Cp.Fk[fe["@name"]]
                })
            });
            delete Gh.HighlightOutcome;
            Gh.PrizeOutcome = Gh.PrizeOutcome && bz.IC(Gh.PrizeOutcome);
            Gh.OutcomeDetail.Balance = bz.Bh(Gh.OutcomeDetail.Balance);
            Gh.OutcomeDetail.Payout = bz.Bh(Gh.OutcomeDetail.Payout);
            if (Gh.FreeSpinOutcome) {
                Gh.FreeSpinOutcome.Count = bz.ox(Gh.FreeSpinOutcome.Count);
                Gh.FreeSpinOutcome.TotalAwarded = bz.ox(Gh.FreeSpinOutcome.TotalAwarded)
            }
            if (Gh.PrizeOutcome) {
                Gh.PrizeOutcome["Game.Total"] = Gh.PrizeOutcome["Game.Total"]["@totalPay"];
                if (Gh.PrizeOutcome["FreeSpin.Total"]) {
                    Gh.PrizeOutcome["FreeSpin.Total"] = Gh.AwardCapOutcome && Gh.AwardCapOutcome.AwardCapExceeded == "true" ? Gh.PrizeOutcome["Game.Total"] : Gh.PrizeOutcome["FreeSpin.Total"]["@totalPay"]
                }
            }
            this.ZF = Gh.OutcomeDetail.Stage
        },
        DF: function(Kl) {
            var pQ = Kl && this.HZ.OutcomeDetail.NextStage == "BaseGame";
            pQ && this.UH.E3(this.HZ.OutcomeDetail.Balance);
            this.S0.Kl(pQ && 0 < this.UH.XA());
            this.G8.Kl(pQ && 0 < this.UH.XA());
            this.uH.Kl(Kl && this.cR() && !this.fF.ah() && !this.Ey.ah())
        },
        cR: function() {
            var h0 = this.HZ.OutcomeDetail.NextStage != "BaseGame" || 0 <= this.HZ.OutcomeDetail.Balance - this.Wu();
            h0 || this.Zh.Td(i6("Error.insufficientFunds"));
            this.Zh.bE(!h0);
            return h0
        },
        lN: function() {
            this.a6(this.HZ);
            this.WE.bf(this.HZ.PopulationOutcome[this.HZ.OutcomeDetail.Stage + ".Reels"].ZI)
        },
        C4: function() {
            this.UH.E3(this.HZ.OutcomeDetail.Balance - this.HZ.OutcomeDetail.Payout);
            this.Ud.Z6();
            if (this.HZ.OutcomeDetail.Stage == "BaseGame") {
                this.HZ.OutcomeDetail.NextStage == "FreeSpin" ? this.QF.Rg() : this.JV.Rg()
            } else {
                this.sO(0);
                this.Cw.E3(this.HZ.FreeSpinOutcome.Count);
                this.T0.E3(this.HZ.FreeSpinOutcome.TotalAwarded);
                this.HZ.OutcomeDetail.NextStage == "BaseGame" ? this.nG.Rg() : this.PJ.Rg()
            }
        },
        Wu: function() {
            return this.fF.XA() * this.Ey.XA()
        },
        Rv: function() {
            this.Ud.Z6();
            if (this.HZ.OutcomeDetail.NextStage == "BaseGame") {
                this.Ud.sC("color", "#F44C74").Td(i6("Game.goodLuck"));
                this.UH.E3(Math.max(0, this.UH.XA() - this.Wu()))
            } else {
                this.Ud.sC("color", "#F44C74").Td(i6("Game.allWinsTripled"))
            }
            this.WE.Js(this.HZ.OutcomeDetail.NextStage == "FreeSpin")
        },
        Cd: function() {
            this.Ud.Z6();
            if (this.HZ.OutcomeDetail.NextStage == "BaseGame") {
                this.Ud.sC("color", "#F44C74").Td(i6("Game.goodLuck"));
                this.UH.E3(Math.max(0, this.UH.XA() - this.Wu()))
            } else {
                this.Ud.sC("color", "#F44C74").Td(i6("Game.allWinsTripled"))
            }
            this.WE.Js(this.HZ.OutcomeDetail.NextStage == "FreeSpin")
        },
        SC: function() {
            this.UH.E3(this.HZ.OutcomeDetail.Balance - this.HZ.OutcomeDetail.Payout)
        },
        VS: function() {
            this.JU && this.JU.bE(0);
            this.q3 && this.q3.bE(0)
        },
        J3: function() {
            this.WE && this.WE.qW()
        },
        Eg: function() {
            this.HZ.OutcomeDetail.NextStage == "FreeSpin" ? this.Rv() : this.sO(1)
        }
    })
})();
