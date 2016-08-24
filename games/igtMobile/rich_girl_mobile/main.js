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
        if (newClass.G5) {
            return this
        }
        this.ZJ = $empty;
        var value = (this.initialize) ? this.initialize.apply(this, arguments) : this;
        delete this.ZJ;
        delete this.caller;
        return value
    }.extend(this);
    newClass.implement(params);
    newClass.constructor = Class;
    newClass.prototype.constructor = newClass;
    return newClass
}
Function.prototype.protect = function() {
    this.vo = true;
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
        F.G5 = true;
        var proto = new F;
        delete F.G5;
        return proto
    },
    wrap: function(self, key, method) {
        if (method.L5) {
            method = method.L5
        }
        return function() {
            if (method.vo && this.ZJ == null) {
                throw new Error('The method "' + key + '" cannot be called.')
            }
            var caller = this.caller,
                current = this.ZJ;
            this.caller = current;
            this.ZJ = arguments.callee;
            var result = method.apply(this, arguments);
            this.ZJ = current;
            this.caller = caller;
            return result
        }.extend({
            N9: self,
            L5: method,
            U3: key
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
                if (value.Tt) {
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
            var name = this.caller.U3,
                previous = this.caller.N9.parent.prototype[name];
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
            W7 = -1,
            eQ = events.length,
            fn;
        if (delay) {
            while (++W7 < eQ) {
                if (fn = events[W7]) {
                    setTimeout(function() {
                        fn.apply(this, args)
                    }, delay)
                }
            }
        } else {
            while (++W7 < eQ) {
                if (fn = events[W7]) {
                    fn.$bound ? fn.$bound.apply(fn.$boundObject, (fn.$boundArgs || []).concat(Array.prototype.slice.call(args))) : fn.apply(this, args)
                }
            }
        }
        return this
    },
    sg: function(type, args) {
        var events, W7 = 0,
            eQ, fn;
        if (!(events = this.$events) || !(events = events[type])) {
            return this
        }
        args = args === undefined ? [] : args instanceof Array ? args : [args];
        for (eQ = events.length; W7 < eQ; ++W7) {
            if (fn = events[W7]) {
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
            var oo = "oo=" + method;
            data = (data) ? oo + "&" + data : oo;
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
    C5: function() {
        var UL = this,
            J0 = [].slice.call(arguments, 0);
        return function() {
            return UL.apply(this, J0.concat([].slice.call(arguments, 0)))
        }
    },
    UE: function(W7) {
        return function() {
            return arguments[W7]
        }
    },
    j3: function() {
        var sp = this,
            J0 = arguments;
        return function() {
            var W7 = J0.length,
                g5 = [];
            while (W7-- > 0) {
                g5[W7] = arguments[J0[W7]]
            }
            sp.apply(this, g5)
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
    Mw: function(oo) {
        var J0 = Array.slice(arguments, 1),
            W7 = -1,
            eQ = this.length,
            vO = [];
        while (++W7 < eQ) {
            vO[W7] = this[W7][oo].apply(this[W7], J0)
        }
        return vO
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
    e3: function(lx) {
        return this.Mw("e3", lx).join("")
    },
    N2: function() {
        var W7 = 0,
            I9 = this.length,
            eQ, aI = [this[0]];
        while (++W7 < I9) {
            eQ = Math.floor(Math.random() * W7);
            aI[W7] = aI[eQ];
            aI[eQ] = this[W7]
        }
        return aI
    },
    HE: function() {
        var cJ = {},
            W7 = this.length;
        while (--W7 >= 0) {
            cJ[this[W7]] = W7
        }
        return cJ
    },
    P3: function(zW) {
        return this.map(function(o3) {
            return zW[o3]
        })
    },
    Aw: function(Yy) {
        var I9 = this.length - 1,
            aI = [],
            W7;
        for (W7 = 0; W7 <= I9; ++W7) {
            aI[W7] = this[W7 * Yy % I9 || W7]
        }
        return aI
    },
    AP: function() {
        this.AP = (function() {
            var Fv = 0;
            return function() {
                var I9 = this.length,
                    W7;
                if (I9 > 1) {
                    while (Fv == (W7 = Math.floor(Math.random() * I9))) {}
                }
                return this[Fv = W7]
            }
        })();
        return this.AP()
    }
});
Array.sc = function(o3) {
    return o3 instanceof Array ? o3 : o3 ? [o3] : []
};
Array.TC = function(gK, ZG, ZZ, Q7) {
    var aI = [],
        W7;
    ZZ = ZZ || Infinity;
    Q7 = Q7 || 1;
    for (W7 = gK; W7 <= ZG; ++W7) {
        aI.push(W7 % ZZ * Q7)
    }
    return aI
};
String.implement({
    sN: function() {
        return this.charAt(Math.floor(Math.random() * this.length))
    },
    dB: function(qY) {
        return this.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
    },
    Y5: function(aI) {
        var Qs = function(cJ) {
            return this.substitute(cJ)
        };
        return aI.map(Qs, this)
    },
    bc: function(lx, eH) {
        eH = eH ? ' class="'.concat(eH, '"') : "";
        return "<".concat(lx, eH, ">", this, "</", lx, ">")
    },
    e3: function(lx, eH) {
        return this.dB().bc(lx, eH)
    }
});
Elements.lL = function(n7) {
    return (new Element("div")).set("html", arguments).getChildren()
};
Element.implement({
    dH: (function() {
        var Jr = {};
        return function(ZV) {
            Jr[ZV] = Jr[ZV] || function() {
                window.event.which !== 0 && ZV.test(String.fromCharCode(window.event.charCode)) && event.preventDefault()
            };
            return this.addEvent("keypress", Jr[ZV])
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
            N9: binder.N9,
            L5: binder.L5,
            U3: binder.U3
        }).apply(this, arguments)
    };
    return binder
};
var jD = {};
var wq = function(JM) {
    this.mN = window.getComputedStyle(JM, null)
};
wq.prototype = {
    vE: function(Wt, AZ) {
        AZ = jD.mI(AZ);
        try {
            return this.mN.getPropertyCSSValue ? this.mN.getPropertyCSSValue(AZ).getFloatValue(Wt) : this.mN.getPropertyValue(AZ).toInt()
        } catch (HV) {}
    },
    Qt: function(AZ) {
        AZ = jD.mI(AZ);
        return this.vE(5, AZ)
    },
    y4: function(AZ) {
        AZ = jD.mI(AZ);
        return this.mN.getPropertyValue(AZ)
    }
};
jD.UZ = (function(a, b, c) {
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
    }, A(""), j = l = null, e.b_ = f, e.jg = d, g.className = g.className.replace(/\bno-javascript\b/, "") + " javascript " + u.join(" ");
    return e
})(this, this.document);
jD.dk = function() {
    document.body.adopt((new Element("div", {
        style: "position: absolute; top: -1000px"
    })).adopt(new Element("input", {
        id: "WN",
        type: "text"
    }), new Element("label", {
        "for": "WN",
        text: "WN"
    })))
};
(function() {
    var Hy = {
            GO: /([0-9_]+) like Mac OS X/,
            MG: /Android ([0-9.]+)/,
            BO: /Windows \w+ ([0-9.]+)/
        },
        ZM = navigator.userAgent.match(/[(]([^;]+)(?:; U)?; ([^;)]+)(?:; [^)]+)?[)]/) || [],
        Af;
    this.Ak = ZM[1];
    if (this.Af = ZM[2]) {
        for (Af in Hy) {
            if (ZM = this.Af.match(Hy[Af])) {
                this.Af = Af;
                this.mJ = ZM[1] && parseFloat(ZM[1].substr(0, 3).replace("_", "."));
                break
            }
        }
    }
    if (this.UZ.touch) {
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
    this.YB = jD.Af == "GO";
    (function() {
        var Uc = document.createElement("canvas"),
            Ax = document.createElement("canvas"),
            ee, Zs;
        Ax.setAttribute("width", 1);
        Ax.setAttribute("height", 1);
        Zs = Ax.getContext("2d");
        Uc.setAttribute("width", 8);
        Uc.setAttribute("height", 8);
        ee = Uc.getContext("2d");
        if (Ax.getContext === undefined) {
            return
        }
        this.cb = !!ee.putImageData;
        this.CL = !!ee.getImageData;
        if (this.cb && this.CL) {
            this.vB = 1;
            try {
                ee.putImageData(Zs.getImageData(0, 0, 1, 1), -1, -1)
            } catch (uM) {
                this.vB = 0
            }
        }
        if (this.CL) {
            Zs.fillStyle = "#ffffff";
            Zs.fillRect(0, 0, 1, 1);
            ee.clearRect(0, 0, 8, 8);
            ee.drawImage(Ax, 4, 4);
            this.Rl = ee.getImageData(4, 4, 1, 1).data[0] == 0
        }
    }).call(this);
    document.readyState === "complete" ? jD.dk() : window.addEvent("domready", jD.dk)
}).call(jD);
jD.Rl && (function(bz, p7, QA) {
    if (bz != 1) {
        CanvasRenderingContext2D.prototype.drawImage = function(Px, Yd, XL, EC, MY, s8, xG, U6, aA) {
            p7.call(this, Px, Yd / bz, XL / bz, EC / bz, MY / bz, s8 / bz, xG / bz, U6 / bz, aA / bz)
        };
        CanvasRenderingContext2D.prototype.putImageData = QA && function(dQ, s8, xG) {
            QA.call(this, dQ, s8 * bz, xG * bz)
        }
    }
})(window.devicePixelRatio || 1, CanvasRenderingContext2D.prototype.drawImage, CanvasRenderingContext2D.prototype.putImageData);
var E4 = new Class({
    qQ: function() {
        this.Dk = $merge.run([this.Dk].extend(arguments));
        if (!this.addEvent) {
            return this
        }
        for (var lS in this.Dk) {
            if ($type(this.Dk[lS]) != "function" || !(/^on[A-Z]/).test(lS)) {
                continue
            }
            this.addEvent(lS, this.Dk[lS]);
            delete this.Dk[lS]
        }
        return this
    },
    B0: function(AZ) {
        return this.Dk.hasOwnProperty(AZ) ? this.Dk[AZ] : void 0
    },
    DF: function(AZ, Ba) {
        return this.Dk[AZ] = Ba
    }
});
var fz = function(r4, pB, qA) {
    this.r4 = r4;
    this.pB = pB;
    this.qA = qA || 1;
    this.Pt = 0;
    this.qO = this.qO.bind(this)
};
fz.prototype = {
    qO: function() {
        if (--this.Pt == 0) {
            this.r4.removeEvent(this.pB, this.qO);
            this.KU()
        }
    },
    Ie: function(LN) {
        this.KU = LN;
        this.Pt = this.qA, this.r4.addEvent(this.pB, this.qO)
    },
    hu: function() {
        this.r4.removeEvent(this.pB, this.qO)
    }
};
Events.implement({
    bj: function(pB, qA) {
        return new fz(this, pB, qA)
    },
    rE: function(l9, KU) {
        var UL = this,
            Wh = function() {
                KU.apply(this, arguments);
                UL.removeEvent(l9, Wh)
            };
        return this.addEvent(l9, Wh)
    }
});
Element.Properties.pL = {
    set: (function() {
        var VF = function() {
            mB = Math.min(1, this.clientWidth / this.scrollWidth);
            mB && this.KT({
                transform: Bm.rK.mB(mB, mB),
                transformOrigin: "0 0"
            })
        };
        return function(n7) {
            if (!this.VF) {
                this.VF = this.VF || VF.bind(this);
                window.addEvent("orientationchange", this.VF)
            }
            this.set("html", n7);
            VF.call(this);
            return this
        }
    })(),
    get: Element.Properties.html.get
};
var Df = new Class({
    Extends: Events,
    Implements: E4,
    Dk: {
        UF: "",
        OE: "",
        ht: 0
    },
    VT: 0,
    toElement: function() {
        return this.rp
    },
    initialize: function(Dk) {
        this.qQ(Dk);
        this.rp = (Dk.rp || new Element("div", {
            id: this.Dk.UF,
            "class": this.Dk.OE + " Df"
        })).adopt(this.WP = this.Dk.WP || new Element("div", {
            "class": "TT"
        }));
        Dk.ht && Df.ht(this)
    },
    Pz: function(n7) {
        this.WP.innerHTML = n7;
        return this
    },
    aq: function(RR) {
        RR = arguments.length ? !!RR : !this.VT;
        if (RR != this.VT) {
            this.fireEvent(RR ? "kR" : "fR");
            this.rp.style.visibility = RR ? "inherit" : "hidden";
            this.VT = RR;
            this.fireEvent(RR ? "j4" : "Dh")
        }
        return this
    },
    sC: function() {
        return this.VT
    },
    Lk: function() {
        return this.aq(!this.VT)
    },
    Mo: function(JM) {
        JM = JM || new Element("div");
        this.rp.adopt(JM.adopt(this.rp.getChildren()));
        return this
    },
    mT: function(pH, Py) {
        return (new Element("div", {
            id: pH || "",
            "class": Py || ""
        })).adopt((new Element("div", {
            "class": "Z_"
        })).adopt(this), new Element("div", {
            "class": "H4"
        }))
    },
    IG: function() {
        this.rp.destroy()
    },
    kZ: function() {
        this.rp.dispose()
    },
    ax: function() {
        return GH.ZL(this.__proto__.constructor, [this.Dk])
    }
});
Df.ht = function(ff) {
    var Pz = ff.Pz;
    ff.Pz = function(n7) {
        this.WP.set("pL", n7);
        return this
    }
};
var TM = new Class({
    Extends: Df,
    Binds: ["Pu", "Ag", "q7", "Gv"],
    rp: null,
    WP: null,
    YV: 0,
    oM: 0,
    tY: 1,
    Dk: {
        TT: "",
        tY: 0,
        u5: 200,
        bw: 1
    },
    initialize: function(Dk) {
        this.qQ(Dk);
        this.rp = new Element("div", {
            id: this.Dk.UF,
            "class": this.Dk.OE + " TM"
        }).adopt(this.WP = new Element("div", {
            "class": "TT"
        }).adopt(this.PH = new Element("div", {
            "class": "I_"
        })), new Element("div", {
            "class": "B1"
        }));
        this.Pz(this.Dk.TT);
        this.rC(this.Dk.tY);
        this.WP.addEvents({
            touchstart: this.Pu,
            touchend: this.Ag,
            Mu: this.Gv
        });
        this.uz = this.WP;
        document.addEvents({
            touchend: this.q7,
            touchcancel: this.q7
        })
    },
    Mo: function(JM, rc) {
        JM.wraps(this.PH, rc);
        return this
    },
    rC: function(rC) {
        if (this.tY != !!rC) {
            this.tY = !!rC;
            this.tY ? this.rp.removeClass("Jv") : this.rp.addClass("Jv");
            this.q7();
            this.fireEvent("rC", this.tY)
        }
        return this
    },
    Pz: function(TT) {
        TT instanceof Element ? this.PH.adopt(arguments) : this.bt(TT);
        return this
    },
    bt: function(I_) {
        this.TT != I_ && this.PH.set("text", this.TT = I_);
        return this
    },
    Pu: function(pB) {
        pB.preventDefault();
        if (this.tY) {
            this.rp.addClass("YV");
            this.YV = 1;
            ++this.oM;
            this.fireEvent("lN").WP.fireEvent("Mu", [this.oM], this.Dk.u5)
        }
    },
    Ag: function() {
        this.tY && this.YV && this.fireEvent("Mk");
        this.q7()
    },
    q7: function() {
        this.YV = 0;
        this.rp.removeClass("YV")
    },
    Gv: function(oM) {
        oM == this.oM && this.Dk.bw ? this.Ag() : this.rp.removeClass("YV")
    }
});
var FR = (function() {
    var kd = {
            chipSet1: [0.05, 0.1, 0.5, 1, 5, 25, 100, 500, 1000, 5000, 10000],
            chipSet2: [0.25, 0.5, 1, 5, 25, 100, 500, 1000, 5000, 10000, 50000],
            chipSet3: [0.5, 1, 5, 10, 50, 100, 500, 1000, 5000, 10000, 50000, 100000],
            chipSet4: [5, 10, 50, 100, 500, 1000, 5000, 10000, 50000, 100000, 500000, 1000000]
        },
        Mg, cE, bq, dF, tZ, xz, RQ, BX, D3 = function(tH, Lt) {
            var aU = FR.Bz(tH).split("."),
                iI = (+aU[0]).toString(),
                mb = aU[1] || "",
                pC;
            if (tZ) {
                while (pC = iI.match(/^(\d+)(\d\d\d)(.*)$/)) {
                    iI = pC[1].concat(tZ, pC[2], pC[3])
                }
            }
            Lt = Lt && mb == 0;
            return dF.concat(iI, Lt ? "" : PX, Lt ? "" : mb, xz)
        };
    return {
        toString: function() {
            return RQ
        },
        Hz: function(aU) {
            return aU / cE
        },
        Bz: function(tH) {
            return (tH * cE).toFixed(bq)
        },
        Kj: Rn = function(qP, Lt) {
            return D3(FR.Hz(qP), Lt)
        },
        ui: wM = function(tH) {
            return D3(tH, 1)
        },
        jJ: M3 = function(tH) {
            return D3(tH, 0)
        },
        t_: function(Gk, gw) {
            var GR = Gk.MAJOR_SYMBOL_PADDING_SPACE == "true" ? "\u00a0" : "";
            RQ = Gk["@currencyCode"];
            bq = parseInt(Gk.DECIMAL_PRECISION);
            cE = gw;
            dF = Gk.MAJOR_SYMBOL_ALIGNMENT == "left" ? Gk.MAJOR_SYMBOL + GR : "";
            xz = Gk.MAJOR_SYMBOL_ALIGNMENT == "right" ? GR + Gk.MAJOR_SYMBOL : "";
            tZ = (Gk.USE_THOUSANDS_SEPARATOR == "yes" ? Gk.THOUSANDS_SEPARATOR : "").replace("_", "\u00a0");
            PX = (bq ? Gk.DECIMAL_SEPARATOR : "").replace("_", "\u00a0");
            kd = kd[Gk.CHIP_SET_CODE] || [];
            Mg = kd[0] || 1;
            kd = kd.map(function(Ba) {
                return Math.round(Ba / Mg)
            })
        },
        tP: function(tH) {
            var W7 = kd.length,
                nG = [];
            tH = Math.round(tH * cE / Mg);
            while (--W7 >= 0 && tH > 0) {
                while (tH - kd[W7] >= 0) {
                    nG.push(W7);
                    tH -= kd[W7]
                }
            }
            return nG
        },
        uo: function(Ov) {
            for (var o3 = 0, W7 = Ov.length; --W7 >= 0; o3 += kd[Ov[W7]] * Mg) {}
            return FR.Hz(o3)
        },
        kc: function(Ov) {
            return Ov.map(function(o3) {
                return kd[o3] * Mg
            })
        },
        a4: function(Ln, Lr) {
            var L4 = Math.round(cE / Mg),
                nG = [],
                W7;
            Lr = Math.round(Lr * cE / Mg) || Infinity;
            for (W7 = 0; W7 < kd.length; ++W7) {
                if (kd[W7] >= L4 && kd[W7] <= Lr && 0 < Ln--) {
                    nG.push(W7)
                }
            }
            return nG
        },
        Yr: function(n8) {
            return FR.Hz(kd[n8] * Mg)
        }
    }
})();
var wB = (function() {
    var g0 = function(W7) {
            W7 = W7 in this.Dk.Jt && W7 || 0;
            if (this.lM != W7) {
                this.lM = W7;
                this.rC(this.tY);
                this.xH.innerHTML = this.Dk.yi(this.Dk.Jt[W7]);
                this.fireEvent("qt", [this.Dk.Jt[W7], W7])
            }
        },
        Kk = function() {
            g0.call(this, this.lM + 1)
        },
        b9 = function() {
            g0.call(this, this.lM - 1)
        };
    return new Class({
        Extends: Df,
        tY: 0,
        Dk: {
            tY: 0,
            Jt: [],
            yi: M3
        },
        initialize: function(Dk) {
            this.qQ(Dk);
            this.tY = this.Dk.tY;
            this.rp = new Element("div", {
                id: this.Dk.UF,
                "class": "wB " + this.Dk.OE
            });
            this.rp.adopt(this.b3 = (new TM({
                OE: "wB OQ"
            })).addEvent("lN", b9.bind(this)), this.AL = (new TM({
                OE: "wB eb"
            })).addEvent("lN", Kk.bind(this)), this.xH = new Element("div", {
                "class": "DQ"
            }));
            this.Dk.Ob !== void 0 && this.pf(this.Dk.Ob)
        },
        y6: function(JM) {
            return JM.wraps(this.xH)
        },
        pf: function(Ob) {
            g0.call(this, this.Dk.Jt.indexOf(Ob))
        },
        Tv: function() {
            return this.Dk.Jt[this.lM]
        },
        rC: function(rC) {
            this.tY = rC = !!rC;
            this.b3.rC(rC && this.lM - 1 in this.Dk.Jt);
            this.AL.rC(rC && this.lM + 1 in this.Dk.Jt)
        }
    })
})();
var CC = (function() {
    var Yz = function() {
            var Tb = this.b1.rb(),
                sM = window.devicePixelRatio || 1,
                e7 = Tb.Qt("width") * sM,
                hS = Tb.Qt("height") * sM,
                e2 = this.Dk.Yw.e2 || Tb.y4("color"),
                p2 = this.Dk.Yw.p2,
                nf = this.Dk.Yw.qk,
                l_ = this.Dk.Jt.length,
                cZ, gA = this.Dk.Yw.lB,
                lH, Ns = this.b1,
                JO = Ns.getContext("2d"),
                Kq = +this.UG.Tv(),
                o3;
            l_ = nf ? l_ : parseInt(this.Dk.Jt[l_ - 1], 10);
            cZ = e7 / (l_ + l_ * gA - gA);
            gA *= cZ;
            Ns.width = e7;
            Ns.height = hS;
            for (lH = 0; lH < l_; lH++) {
                o3 = nf ? +this.Dk.Jt[lH] : lH + 1;
                JO.fillStyle = o3 <= Kq ? e2 : p2;
                JO.fillRect((cZ + gA) * lH, 0, cZ, hS)
            }
        },
        PT = function(Ob) {
            Yz.call(this);
            this.fireEvent("qt", arguments)
        };
    return new Class({
        Extends: Df,
        Ob: 0,
        Jv: 0,
        Dk: {
            Jt: [],
            yi: function(Ob) {
                return Ob
            },
            Tu: null,
            sH: "top",
            Yw: {
                qk: 1,
                lB: 0.4,
                e2: 0,
                p2: 0
            }
        },
        initialize: function(Dk) {
            this.qQ(Dk);
            this.rp = new Element("div", {
                id: this.Dk.UF,
                "class": "yl " + this.Dk.OE
            });
            this.rp.adopt(this.UG = new wB({
                OE: "MP",
                tY: 1,
                Jt: this.Dk.Jt,
                Ob: this.Dk.Ob,
                yi: this.Dk.yi
            }));
            this.UG.y6(new Element("div", {
                "class": "hJ"
            })).grab(new Element("div", {
                "class": "Z6",
                html: this.Dk.Tu
            }), this.Dk.sH).adopt(this.b1 = new Element("canvas", {
                "class": "Yw"
            }));
            this.UG.addEvent("qt", PT.bind(this));
            this.Dk.Ob !== void 0 && this.pf(this.Dk.Ob)
        },
        aq: function(RR) {
            RR && Yz.call(this);
            return this.parent(RR)
        },
        rC: function(tY) {
            this.UG.rC(tY)
        },
        pf: function(Ob) {
            this.UG.pf(Ob);
            return this
        },
        Tv: function() {
            return this.UG.Tv()
        }
    })
})();
var eL = new Class({
    Extends: Df,
    Binds: ["ZI", "mO"],
    Dk: {
        eH: ""
    },
    initialize: function(Dk) {
        this.qQ(Dk);
        this.rp = (new Element("div", {
            id: this.Dk.UF,
            "class": "eL " + (this.Dk.XY || this.Dk.eH)
        })).adopt((new Element("div")).adopt(this.WP = new Element("span")))
    },
    b7: function() {
        return this.WP
    },
    ZI: function(I_) {
        this.WP.set("text", I_);
        return this
    },
    u2: function(n7) {
        this.WP.set("html", n7);
        return this
    },
    mO: function(I_) {
        this.WP.set("html", "");
        return this
    },
    Jl: function(AZ, Ba) {
        this.WP.Jl(AZ, Ba);
        return this
    },
    KT: function(zI) {
        this.WP.KT(zI);
        return this
    }
});
var ap = new Class({
    Extends: eL,
    Binds: ["i5", "ZI", "Nv", "Pb"],
    initialize: function(Dk) {
        this.parent(Dk);
        this.Kn = new Element("span", {
            "class": "Ow"
        });
        this.Md = new Element("span", {
            "class": "gQ"
        });
        this.Kn.inject(this.WP, "before");
        this.Md.inject(this.WP, "after")
    },
    xU: function(AZ, Ba) {
        this.Kn.setStyle(AZ, Ba);
        return this
    },
    vW: function(AZ, Ba) {
        this.Md.setStyle(AZ, Ba);
        return this
    },
    i5: function(I_) {
        this.Kn.set("text", I_);
        return this
    },
    iz: function(n7) {
        this.Kn.set("html", n7);
        return this
    },
    Nv: function(I_) {
        this.Md.set("text", I_);
        return this
    },
    Lg: function(n7) {
        this.Md.set("html", n7);
        return this
    },
    Pb: function(Iy) {
        (Iy === "left" || Iy === void(0)) && this.Kn.set("html", "");
        (Iy === "right" || Iy === void(0)) && this.Md.set("html", "");
        return this.mO()
    },
    KT: function(AZ, Ba) {
        this.Kn.setStyle(AZ, Ba);
        this.Md.setStyle(AZ, Ba);
        return this.Jl(AZ, Ba)
    }
});
var tK = (function() {
    var Tn = 0,
        Ij = 0,
        xL = {},
        qw = 0,
        QZ = 25,
        qM = 0,
        vw = function() {
            var W7, Op, kg;
            for (W7 in xL) {
                Op = xL[W7];
                Op.l2 -= QZ;
                if (Op.l2 <= 0) {
                    isNaN(Op.l2 = Op.YD) && rj(W7);
                    kg = +new Date;
                    Op.KU(kg - Op.yE);
                    Op.yE = kg
                }
            }
        },
        AN = function(RG, KU, e0) {
            e0 = Math.max(e0, 0);
            xL[++qw] = {
                KU: KU,
                YD: RG ? e0 : NaN,
                l2: e0,
                yE: +new Date
            };
            ++Ij;
            NR(0);
            return qw
        },
        rj = function(Tm) {
            if (xL[Tm]) {
                --Ij || NR(1);
                delete xL[Tm]
            }
        },
        uY = function(Tm, KU) {
            if (xL[Tm]) {
                xL[Tm].KU = KU
            }
            return xL[Tm] && Tm
        },
        R8 = function(XD) {
            QZ = Math.ceil(1000 / XD)
        },
        Wk = function() {
            return QZ
        },
        NR = function(gJ) {
            var kg;
            if (qM == !gJ) {
                return
            }
            if (qM) {
                kg = +new Date;
                for (W7 in xL) {
                    xL[W7].f_ = kg - xL[W7].yE
                }
                Tn = clearInterval(Tn)
            } else {
                kg = +new Date;
                for (W7 in xL) {
                    if (xL[W7].f_) {
                        xL[W7].yE = kg - xL[W7].f_
                    }
                }
                Tn = Ij && setInterval(vw, QZ)
            }
            qM = !!Tn && !gJ
        };
    R8(40);
    window.addEventListener("pagehide", NR.C5(1));
    window.addEventListener("pageshow", NR.C5(0));
    return {
        Wk: Wk,
        R8: R8,
        Z7: AN.C5(0),
        qW: AN.C5(1),
        uY: uY,
        d9: rj,
        pW: rj,
        NR: NR.C5(1),
        Ko: NR.C5(0)
    }
})();
var q2 = new Class({
    Implements: [Events, E4],
    Dk: {},
    WC: 0,
    initialize: function(Dk) {
        this.qQ(Dk)
    },
    Wn: function() {
        return !!this.WC
    },
    Xx: function(Ve) {
        this.WC = 1;
        this.fireEvent("M9", this);
        this.Ve = Ve;
        return this
    },
    dM: function() {
        if (this.WC) {
            this.WC = 0;
            this.fireEvent("yd", this);
            delete this.Ve
        }
        return this
    },
    Ww: function() {
        if (this.WC) {
            this.WC = 0;
            this.fireEvent("k2", this);
            this.Ve && this.Ve();
            delete this.Ve
        }
        return this
    },
    O_: function() {
        if (this.WC) {
            this.WC = 0;
            this.fireEvent("ft", this).Ve && this.Ve();
            delete this.Ve
        }
        return this
    }
});
var Ud = new Class({
    Extends: q2,
    initialize: function(Ku, aB) {
        this.Ku = Ku;
        this.aB = aB
    },
    Xx: function(Ve) {
        this.parent(Ve);
        return this.aB() ? this.Ku.Xx(this.O_.bind(this)) : this.O_()
    },
    dM: function() {
        if (this.WC) {
            this.Ku.dM();
            this.parent()
        }
        return this
    },
    Ww: function() {
        if (this.WC) {
            this.Ku.Ww();
            this.parent()
        }
        return this
    }
});
var YK = new Class({
    Extends: q2,
    Binds: ["O3"],
    r6: 0,
    initialize: function(fE) {
        this.fE = fE
    },
    Rs: function() {
        this.fE.Ie(this.O3);
        this.r6 = 1
    },
    Xx: function(Ve) {
        this.Rs();
        this.parent(Ve);
        0 == this.r6 && this.O_();
        return this
    },
    O3: function() {
        this.r6 = 0;
        this.WC && this.O_()
    },
    dM: function() {
        this.fE && this.fE.hu();
        this.r6 = 0;
        return this.parent()
    },
    Ww: function() {
        this.fE && this.fE.hu();
        this.r6 = 0;
        return this.parent()
    }
});
(function() {
    var u8 = function(pB, qA) {
        return new YK(new fz(this, pB, qA))
    };
    Events.implement("ju", u8);
    q2.implement("ju", u8);
    Element.implement("ju", u8)
})();
var x5 = new Class({
    Extends: YK,
    r6: 0,
    iu: [],
    initialize: function() {
        this.iu = Array.flatten(arguments)
    },
    Rs: function() {
        this.r6 = this.iu.length;
        this.iu.forEach(function(fE) {
            fE.Ie(this.O3)
        }, this)
    },
    dM: function() {
        this.iu.forEach(function(fE) {
            fE.hu()
        }, this);
        return this.parent()
    },
    Ww: function() {
        this.iu.forEach(function(fE) {
            fE.hu()
        }, this);
        return this.parent()
    }
});
var uV = new Class({
    Extends: x5,
    O3: function() {
        if (--this.r6 == 0) {
            this.WC && this.O_()
        }
    }
});
var a7 = (function() {
    var i9 = function() {
        this.Fu = 0;
        this.fireEvent("ib", this);
        this.HB()
    };
    return new Class({
        Extends: q2,
        Dk: {
            ub: 0
        },
        Fu: 0,
        Xx: function(Ve) {
            this.parent(Ve);
            if (Math.max(0, this.Dk.ub) > 0) {
                this.Fu = tK.Z7(i9.bind(this), this.Dk.ub)
            } else {
                i9.call(this)
            }
            return this
        },
        HB: function() {
            this.O_()
        },
        dM: function() {
            this.Fu = this.Fu && tK.d9(this.Fu);
            this.WC && this.parent();
            return this
        },
        Ww: function() {
            this.Fu = this.Fu && tK.d9(this.Fu);
            this.WC && this.parent();
            return this
        }
    })
})();
var WF = new Class({
    Extends: q2,
    initialize: function() {
        this.Wf = Array.flatten(arguments);
        this.parent()
    },
    Xx: function(Ve) {
        var UW = this,
            TV = this.Wf.length,
            Fs = function() {
                --TV || UW.O_()
            };
        this.parent(Ve);
        this.Wf.Mw("Xx", Fs);
        return this
    },
    dM: function() {
        this.Wf.Mw("dM");
        return this.parent()
    },
    Ww: function() {
        this.Wf.Mw("Ww");
        return this.parent()
    }
});
var vU = new Class({
    Extends: a7,
    Binds: ["Hl", "LM"],
    Dk: {
        Q9: 1,
        TJ: 0,
        yZ: 1,
        oK: 0,
        e0: 1,
        z8: 10000000000
    },
    hP: NaN,
    Q9: 1,
    Xx: function(Ve) {
        this.Q9 = this.Dk.Q9;
        this.parent(Ve)
    },
    HB: function() {
        this.hP = 0;
        (this.Dk.oK > 0) ? this.Hl(): this.LM()
    },
    DD: function(S_) {
        this.Q9 = S_ || 1
    },
    Hl: function() {
        var UA = this.Dk.TJ + this.hP % this.Dk.z8 * this.Dk.yZ;
        if (!isNaN(UA)) {
            this.Fu = 0;
            this.fireEvent("hy", [this, this.hP, UA]);
            this.Mm(this.hP, UA) && this.LM()
        }
    },
    LM: function() {
        if (this.hP == NaN) {
            return
        }
        if (++this.hP >= this.Dk.oK) {
            if (0 == --this.Q9 || 0 == this.Dk.oK) {
                this.hP = NaN;
                this.O_();
                return
            }
            this.hP = 0;
            this.fireEvent("cj", [this, this.Q9])
        }
        this.Fu = tK.Z7(this.Hl, this.Dk.e0)
    },
    dM: function() {
        this.Fu = this.Fu && tK.d9(this.Fu);
        this.hP = NaN;
        this.Q9 = NaN;
        return this.parent()
    },
    Ww: function() {
        this.Fu = this.Fu && tK.d9(this.Fu);
        this.hP = NaN;
        this.Q9 = NaN;
        return this.parent()
    }
});
var pP = new Class({
    Extends: vU,
    Xk: [],
    initialize: function(Xk, Dk) {
        this.qQ(Dk);
        this.jM(Xk)
    },
    jM: function(Xk) {
        Xk = Xk || [];
        this.Xk = Xk.filter(function(Sb) {
            return Sb instanceof q2
        });
        this.Dk.TJ = 0;
        this.Dk.yZ = 1;
        this.Dk.oK = this.Xk.length;
        this.Dk.z8 = this.Xk.length;
        return this
    },
    Mm: function(hP, UA) {
        this.Xk[hP].Xx(this.LM);
        return 0
    },
    dM: function() {
        var Sb = this.Xk[this.hP];
        if (Sb) {
            delete Sb.Ve;
            Sb.dM()
        }
        this.parent()
    },
    Ww: function() {
        var Sb = this.Xk[this.hP];
        if (Sb) {
            delete Sb.Ve;
            Sb.Ww()
        }
        return this.parent()
    }
});
var O7 = new Class({
    Extends: pP,
    initialize: function() {
        this.parent(Array.flatten(arguments))
    }
});
aO.GZ = {};
aO.xj = {};
xN.C9("image/*", (function(Ru) {
    return function(UV) {
        var Ll = this,
            Px = new Image();
        Px.onload = function() {
            delete Px.onload;
            delete Px.onerror;
            aO.GZ[Ll.UF] = Px;
            Ll.xj && GH.FV(Ll.xj, function(DY, UF) {
                aO.xj[UF] = GH.ZL(WZ, [Px].concat(DY.slice(0)))
            });
            Ll.eN()
        };
        Px.onerror = this.VH;
        Px.src = UV.concat(this.xV, "&resolution=", Ru)
    }
})(navigator.userAgent.indexOf("iPad;") >= 0 ? 2 : window.devicePixelRatio || 1), ["image/*"]);
var WZ = function(Px, lH, pJ, cZ, Ge, r_, G6, M_) {
    M_ = M_ || 1;
    Px.xj = Px.xj || [];
    Px.xj.push(this);
    this.Px = Px;
    this.lH = lH / M_;
    this.pJ = pJ / M_;
    this.e7 = cZ / M_;
    this.hS = Ge / M_;
    this.uE = r_;
    this.Zb = G6;
    this.pO = this.e7 / r_;
    this.mu = this.hS / G6;
    this.d0 = M_;
    this.sM = window.devicePixelRatio || 1
};
WZ.prototype = {
    constructor: WZ,
    rg: function(j2, aZ, KA, KC, QF, rH, U2, G3, Oz) {
        var I9 = arguments.length,
            lH = this.lH,
            pJ = this.pJ,
            cZ = this.e7,
            Ge = this.hS,
            M_ = this.d0;
        I9 == 3 ? j2.drawImage(this.Px, lH * M_, pJ * M_, cZ * M_, Ge * M_, aZ * this.sM, KA * this.sM, cZ * this.sM, Ge * this.sM) : I9 == 5 ? j2.drawImage(this.Px, lH * M_, pJ * M_, cZ * M_, Ge * M_, aZ * this.sM, KA * this.sM, KC * this.sM, QF * this.sM) : j2.drawImage(this.Px, lH * M_ + aZ * M_, pJ * M_ + KA * M_, KC * M_, QF * M_, rH * this.sM, U2 * this.sM, G3 * this.sM, Oz * this.sM)
    },
    Bc: function(j2, Qm, KG, s8, xG, U6, aA) {
        this.rg(j2, (Qm * this.pO) || 0, (KG * this.mu) || 0, this.pO, this.mu, s8 || 0, xG || 0, U6 || this.pO, aA || this.mu)
    },
    bC: function() {
        return this.Px.bC()
    },
    Kp: function() {
        return this.Px.Kp(this.d0 || 1)
    },
    wd: function(Qm, KG) {
        return [-this.lH - (Qm || 0) * this.pO, -this.pJ - (KG || 0) * this.mu, ""].join("px ")
    },
    fb: function(Sb) {
        return [-this.lH - (Sb || 0) % this.uE * this.pO, "px"].join("")
    },
    rG: function(Sb) {
        return [-this.pJ - (Sb || 0) % this.Zb * this.mu, "px"].join("")
    },
    Bj: function(Qm, KG) {
        return [this.Px.bC(), "repeat", this.wd(Qm, KG)].join(" ")
    }
};
Image.prototype.bC = function() {
    return ["url(", this.src, ")"].join("")
};
Image.prototype.Kp = function(d0) {
    return [this.width / d0, this.height / d0, ""].join("px ")
};
WZ.Cc = function(cZ, Ge) {
    var Ns = document.createElement("canvas");
    Ns.width = cZ * window.devicePixelRatio || 1;
    Ns.height = Ge * window.devicePixelRatio || 1
};
Element.implement({
    AH: function(wh, Qm, KG) {
        return this.d7(wh).Mn(wh, Qm, KG)
    },
    d7: function(wh) {
        return this.KT({
            width: wh.pO + "px",
            height: wh.mu + "px"
        })
    },
    Mn: function(wh, Qm, KG) {
        return this.KT({
            backgroundImage: wh.bC(),
            backgroundSize: wh.Kp(),
            backgroundPosition: wh.wd(Qm, KG)
        })
    }
});
Fx.implement({
    stopTimer: function() {
        if (!this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.timer = tK.pW(this.timer);
        return true
    },
    startTimer: function() {
        if (this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.Qg = this.Qg || this.step.bind(this);
        this.timer = tK.qW(this.Qg, Math.round(1000 / this.options.fps));
        return true
    }
}, 1);
var MK = new Class({
    Extends: a7,
    Dk: {
        Aj: {}
    },
    initialize: function(xR, Dk) {
        this.parent(Dk);
        this.xR = xR.addEvent("complete", this.O_.bind(this))
    },
    HB: function() {
        this.xR.start(this.Dk.Aj)
    },
    dM: function() {
        this.xR.cancel();
        return this.parent()
    },
    Ww: function() {
        return this.parent()
    }
});
var ct = new Class({
    Extends: q2,
    Dk: {
        KM: !!jD.UZ.csstransitions,
        fg: true,
        ub: 1,
        unit: "",
        transition: "linear",
        FZ: 1
    },
    Hx: 0,
    qQ: function(Dk) {
        this.parent(Dk);
        this.Dk.KM && this.dA(this.Dk);
        return this
    },
    initialize: function(JM, Dk) {
        this.JM = JM;
        this.qQ(Dk);
        if (this.Dk.KM) {
            this.parent()
        } else {
            return new MK(new Fx.Morph(JM, Dk), Dk)
        }
    },
    Xx: function(Ve) {
        this.parent(Ve);
        return this.Yo()
    }
});
jD.UZ.csstransitions && ct.implement({
    Binds: ["Vh", "j6"],
    dA: function(Dk) {
        var hf = Dk.duration + "ms",
            xa = Dk.ub + "ms",
            Fw = [],
            ay = [],
            Yu = [],
            Ei;
        this.RF = {
            transitionProperty: "",
            transitionDuration: "",
            transitionDelay: "",
            transitionTimingFunction: ""
        };
        this.n2 = {};
        this.t0 = 0;
        for (Ei in Dk.Aj) {
            Ba = Dk.Aj[Ei];
            Ei = Ei.camelCase();
            if ($type(Ba) == "array") {
                this.RF[Ei] = Ba[0].toString() + this.Dk.unit;
                this.n2[Ei] = Ba[1].toString() + this.Dk.unit
            } else {
                this.n2[Ei] = Ba.toString() + this.Dk.unit
            }
        }
        this.Dk.fg && ct.GM(this.n2) && this.fg();
        for (Ei in this.n2) {
            ++this.t0;
            Fw.push(Ei.hyphenate());
            ay.push(hf);
            Yu.push(xa)
        }
        this.n2.transitionProperty = Fw.join(" ,");
        this.n2.transitionDuration = ay.join(" ,");
        this.n2.transitionDelay = Yu.join(" ,");
        this.n2.transitionTimingFunction = ct.wk[Dk.transition] || Dk.transition;
        this.gZ = Dk.ub + Dk.duration;
        return this
    },
    fg: function() {
        var n2 = this.n2,
            RF = this.RF,
            Tb = this.JM.rb(),
            oB = n2.transform = n2.transform || Tb.ek(),
            KZ = RF.transform = RF.transform || Tb.ek();
        zI = [{
            Ei: "top",
            EQ: 1,
            lM: 5
        }, {
            Ei: "bottom",
            EQ: -1,
            lM: 5
        }, {
            Ei: "left",
            EQ: 1,
            lM: 4
        }, {
            Ei: "right",
            EQ: -1,
            lM: 4
        }];
        zI.forEach(function(Ei) {
            var EQ = Ei.EQ,
                lM = Ei.lM,
                Ei = Ei.Ei,
                Xx, u3, Wd;
            if (n2[Ei]) {
                u3 = EQ * parseFloat(n2[Ei]) || 0;
                Wd = EQ * parseFloat(RF[Ei]) || 0;
                Xx = -EQ * Tb.Qt(Ei) || 0;
                KZ[lM] = Xx + Wd;
                oB[lM] = Xx + u3;
                delete n2[Ei];
                delete RF[Ei]
            }
        })
    },
    Vh: function(pB) {
        --this.Hx == 0 && this.O_()
    },
    j6: function() {
        this.Hx = 0;
        this.WC && this.O_()
    },
    Yo: function() {
        if (this.t0) {
            this.JM.KT(this.RF);
            document.body.offsetWidth;
            this.JM.addEvent("transitionend", this.Vh);
            this.Hx = this.t0;
            this.JM.KT(this.n2);
            this.b6 = this.Dk.FZ && setTimeout(this.j6, this.gZ + 250)
        } else {
            this.O_()
        }
    },
    O_: function() {
        this.JM.removeEvent("transitionend", this.Vh);
        this.JM.KT({
            transitionProperty: "",
            transitionDuration: "",
            transitionDelay: "",
            transitionTimingFunction: ""
        });
        document.body.offsetWidth;
        this.parent()
    }
});
ct.GM = function(Ei) {
    var Js = (Ei.top !== undefined),
        fp = (Ei.bottom !== undefined),
        I9 = (Ei.left !== undefined),
        vO = (Ei.right !== undefined);
    if (!ct.j0) {
        return false
    }
    return (Js || fp || I9 || vO) && !(Js && fp) && !(I9 && vO)
};
ct.j0 = jD.Ak != "iPad" && jD.UZ.csstransforms && jD.YB;
ct.vY = ["top", "left", "bottom", "right"];
ct.wk = {
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
var H6 = new Class({
    Extends: vU,
    JM: null,
    initialize: function(JM, Dk) {
        this.qQ(Dk);
        this.rY(JM)
    },
    rY: function(JM) {
        this.JM = JM;
        return this
    },
    Ww: function() {
        if (this.WC) {
            this.hP = this.Dk.oK - 1;
            this.Mm(this.hP, (this.Dk.TJ + this.Dk.yZ * this.hP) % this.Dk.z8);
            this.parent()
        }
        return this
    }
});
var Fm = new Class({
    Extends: H6,
    Dk: {
        xt: []
    },
    initialize: function(JM, Dk) {
        Dk.oK = Dk.oK || Dk.xt.length;
        this.parent(JM, Dk)
    },
    yO: "",
    Mm: function(hP, UA) {
        var Qx = this.Dk.xt[hP];
        this.JM.addClass(Qx).removeClass(this.yO);
        this.yO = Qx;
        return 1
    },
    dM: function() {
        this.JM.removeClass(this.yO);
        return this.parent()
    }
});
var Qn = new Class({
    Extends: H6,
    Dk: {
        CQ: "backgroundPosition",
        Wt: "px 0"
    },
    initialize: function(JM, Dk) {
        this.parent(JM, Dk);
        this.Dk.CQ = this.Dk.CQ.camelCase()
    },
    Xx: function(Ve) {
        this.Lf = this.JM ? this.JM.C8(this.Dk.CQ) : "";
        this.parent(Ve)
    },
    Mm: function(hP, UA) {
        var Ba = UA.toString().concat(this.Dk.Wt);
        this.JM.Jl(this.Dk.CQ, Ba);
        return 1
    },
    dM: function() {
        this.JM.Jl(this.Dk.CQ, this.Lf);
        return this.parent()
    }
});
var wG = new Class({
    Extends: Qn,
    Dk: {
        CQ: "visibility",
        LZ: ["visible", "hidden"],
        Wt: ""
    },
    qQ: function(Dk) {
        var gY = Dk.LZ ? Dk.LZ.length : this.Dk.LZ.length;
        Dk.oK = Dk.oK || gY;
        Dk.z8 = Dk.z8 || gY;
        return this.parent(Dk)
    },
    Mm: function(hP, UA) {
        this.JM.Jl(this.Dk.CQ, this.Dk.LZ[hP] + this.Dk.Wt);
        return 1
    }
});
var GF = new Class({
    Extends: wG,
    initialize: function(JM, wh, Dk) {
        var aV, BV;
        Dk = Dk || {};
        aV = (Dk.aV || "x").toUpperCase() === "X";
        BV = aV ? wh.uE : wh.Zb;
        Dk.CQ = aV ? "backgroundPositionX" : "backgroundPositionY";
        Dk.oK = Dk.oK || BV;
        Dk.LZ = (Dk.LZ || Array.TC(1, Dk.oK)).map(aV ? wh.fb : wh.rG, wh);
        this.parent(JM, Dk)
    }
});
WZ.prototype.q2 = function(JM, Dk) {
    return new GF(JM, this, Dk)
};
Element.implement({
    KP: function(wh, Dk) {
        return new GF(this, wh, Dk)
    }
});
var Xy = function(aI, fp, Zr, JP, lH, pJ) {
    aI instanceof Array ? this.push.apply(this, aI.slice(0, 6)) : this.push.call(this, aI || 1, fp || 0, Zr || 0, JP || 1, lH || 0, pJ || 0)
};
Xy.prototype = [];
Xy.prototype.$family = {
    name: "Xy"
};
$extend(Xy.prototype, {
    FE: function(oG) {
        var aI = this[0],
            fp = this[1],
            Zr = this[2],
            JP = this[3];
        this[0] = aI * oG[0] + Zr * oG[1];
        this[1] = fp * oG[0] + JP * oG[1];
        this[2] = aI * oG[2] + Zr * oG[3];
        this[3] = fp * oG[2] + JP * oG[3];
        this[4] = aI * oG[4] + Zr * oG[5] + this[4];
        this[5] = fp * oG[4] + JP * oG[5] + this[5];
        return this
    }
});
var mw = {
    bu: function(OI, aF) {
        this[4] += OI;
        this[5] += aF;
        return this
    },
    OB: function(OI) {
        this[4] += OI;
        return this
    },
    jd: function(aF) {
        this[5] += aF;
        return this
    },
    xY: function(f8) {
        var Nh = Math.sin(f8),
            UX = Math.cos(f8),
            aI = this[0],
            fp = this[1],
            Zr = this[2],
            JP = this[3];
        this[0] = aI * UX + Zr * Nh;
        this[1] = fp * UX + JP * Nh;
        this[2] = Zr * UX - aI * Nh;
        this[3] = JP * UX - fp * Nh;
        return this
    },
    mB: function(zt, eM) {
        this[0] *= zt;
        this[1] *= zt;
        this[2] *= eM;
        this[3] *= eM;
        return this
    },
    mU: function() {
        this[0] = -this[0];
        this[1] = -this[1];
        return this
    },
    Ts: function() {
        this[2] = -this[2];
        this[3] = -this[3];
        return this
    },
    toString: jD.UZ.csstransforms3d && jD.YB ? function() {
        return "matrix3d(".concat([this[0], this[1], 0, 0, this[2], this[3], 0, 0, 0, 0, 1, 0, this[4], this[5], 0, 1].join(","), ")")
    } : Browser.Engine.gecko ? function() {
        return "matrix(".concat([this[0], this[1], this[2], this[3], this[4] + "px", this[5] + "px"].join(","), ")")
    } : function() {
        return "matrix(".concat(this.join(","), ")")
    }
};
var TW = function() {
    Xy.apply(this, arguments)
};
var cC = function() {};
cC.prototype = Xy.prototype;
TW.prototype = new cC();
TW.prototype.constructor = TW;
$extend(TW.prototype, mw);
Bm = {
    rK: function(a, b, c, d, e, f) {
        return new TW(a, b, c, d, e, f)
    }
};
Bm.rK.Zy = new TW();
(function() {
    for (var oo in mw) {
        Bm.rK[oo] = (function(oo) {
            return function() {
                return oo.apply(new TW(1, 0, 0, 1, 0, 0), arguments)
            }
        })(mw[oo])
    }
})();
wq.prototype.ek = function() {
    var rK = this.y4("transform");
    rK = rK && rK.replace(/^[^(]+/, "").match(/[-0-9.]+/g);
    rK = rK && rK.map(parseFloat);
    return rK && rK.length == 16 ? new TW(rK[0], rK[1], rK[4], rK[5], rK[12], rK[13]) : new TW(rK)
};
var Ra = (function() {
    var iC = function() {
            this.GX = new vU({
                TJ: 1
            });
            this.GX.Mm = function(hP, UA) {
                Zj.call(this, (this.Dk.Oj) ? (this.JH + UA - 1) : (this.JH + (this.x_ - this.JH) * Math.log(UA) / Math.LN10));
                return 1
            }.bind(this);
            this.GX.addEvents({
                k2: function() {
                    Zj.call(this, this.x_);
                    this.JH = this.x_
                }.bind(this)
            });
            return this.GX
        },
        Zj = function(JH) {
            JH = this.Dk.Io(JH);
            if (JH !== this.bB) {
                return !!this.WP.set("text", this.bB = JH)
            }
        };
    return new Class({
        Extends: Df,
        Implements: [Events, E4],
        Dk: {
            Io: M3,
            c1: FR.Bz,
            Oj: false,
            T6: 25
        },
        initialize: function(Dk) {
            this.qQ(Dk);
            this.rp = this.WP = this.Dk.rp.addClass("Ra " + this.Dk.OE);
            (this.Dk.JH !== undefined) && this.pf(this.Dk.JH)
        },
        OG: function() {
            this.JH = 0;
            this.WP.set("text", this.bB = "");
            this.fireEvent("qt", [this.JH, this.bB])
        },
        pf: function(JH) {
            this.GX && this.GX.Ww();
            if (Zj.call(this, JH)) {
                this.JH = this.x_ = JH;
                this.fireEvent("qt", [this.Dk.c1(JH), this.bB])
            }
            return this
        },
        Tv: function() {
            return this.JH || 0
        },
        Ee: function(x_, xI) {
            var oK;
            (this.GX || iC.call(this)).Ww();
            this.x_ = x_;
            if (this.Dk.Oj) {
                oK = Math.floor(Math.abs(FR.Bz(this.x_ - this.JH) / FR.Bz(xI)) * this.Dk.T6);
                this.GX.qQ({
                    yZ: xI / this.Dk.T6,
                    oK: oK,
                    e0: this.Dk.e0
                })
            } else {
                oK = Math.floor(this.Dk.T6 + this.Dk.T6 * Math.log(Math.abs(FR.Bz(x_ - this.JH) / FR.Bz(xI))) / Math.LN10);
                this.GX.qQ({
                    oK: oK,
                    yZ: 9 / oK
                })
            }
        },
        q2: function() {
            var UW = this;
            return new Ud(this.GX || iC.call(this), function() {
                return UW.x_ != UW.JH
            })
        }
    })
})();
var y8 = new Class({
    Extends: Df,
    initialize: function(Dk) {
        this.qQ(Dk);
        this.rp = new Element("div", {
            id: this.Dk.UF,
            "class": "y8 " + this.Dk.OE
        }), this.J9 = {}
    },
    Hg: function(JM, rc) {
        var JM = JM instanceof Element ? JM : JM.toElement();
        if (rc !== undefined) {
            rc = this.rp.getChildren()[rc]
        }
        rc instanceof Element ? JM.inject(rc, "before") : this.rp.adopt(JM);
        return this
    },
    KF: function(pB, W_, rc) {
        (this.J9[pB] = this.J9[pB] || []).push(W_);
        this.Hg(W_, rc);
        this.fireEvent("PN", [pB, W_]);
        return this
    },
    xs: function(A2) {
        GH.FV(A2, this.KF.j3(1, 0).bind(this))
    },
    Bv: function(NL, pB) {
        var CV, x7, W7;
        for (CV in this.J9) {
            if (pB && CV !== pB) {
                continue
            }
            x7 = this.J9[CV];
            x7 && x7.forEach(function(W_) {
                W_.rC(NL)
            })
        }
        return this
    },
    IW: function(NL) {
        GH.FV(this.J9, this.Bv.C5(NL).j3(1), this);
        return this
    },
    c5: function(pB) {
        this.J9[pB].forEach(function(W_) {
            W_.removeEvents();
            W_.kZ()
        });
        delete this.J9[pB];
        return this
    },
    S8: function() {
        GH.FV(this.J9, this.c5.j3(1).bind(this));
        return this
    }
});
var xu = new Class({
    Extends: Df,
    Binds: ["vc", "C7"],
    initialize: function(Dk) {
        this.qQ(Dk);
        this.rp = (new Element("div", {
            id: this.Dk.UF,
            "class": this.Dk.OE + " xu"
        })).adopt(this.WP = new Element("div", {
            "class": "uh"
        }), this.J9 = new y8({
            OE: "Vl"
        }).addEvent("PN", this.vc.bind(this)));
        this.addEvents({
            iM: this.C7,
            Dh: x8.wa
        })
    },
    ZI: function(Iy) {
        this.WP.innerHTML = "";
        this.WP.adopt(arguments).children.length || this.WP.set("html", Iy);
        return this
    },
    vc: function(pB, W_) {
        W_.addEvent("Mk", this.fireEvent.bind(this, pB))
    },
    C7: function() {
        this.aq(0)
    },
    KF: function(pB, W_, rc) {
        this.J9.KF(pB, W_, rc);
        return this
    },
    xs: function(xp) {
        GH.FV(xp, this.KF.j3(1, 0), this);
        return this
    },
    qL: function() {
        return this.KF("iM", new TM({
            OE: "Ka",
            tY: 1
        }))
    },
    Bv: function(NL, pB) {
        this.J9.Bv(NL, pB);
        return this
    },
    IW: function(NL) {
        this.J9.IW(NL);
        return this
    },
    o0: function(RR) {
        this.J9.aq(RR);
        return this
    },
    c5: function(pB) {
        this.J9.c5(pB);
        return this
    },
    S8: function() {
        this.J9.S8();
        return this
    }
});
xu.FU = function(Vd) {
    var Cb = (new Element("div", {
        "class": "gW",
        style: "visibility:hidden"
    })).adopt(new Element("div", {
        "class": "hN"
    }).adopt(Vd));
    Vd.rp = Cb;
    return Vd
};
var J1 = {
    m8: function(iF, Ss, Po) {
        var Zr = 0,
            vO = 0;
        this.forEach(function(o3, W7, aI) {
            Ss.call(Po, o3, W7, aI, Zr, vO);
            Zr = (++Zr == iF) ? 0 : Zr;
            vO += Zr ? 0 : 1
        })
    },
    nz: function(iF, Ss, Po) {
        var Zr = 0,
            vO = 0;
        return this.map(function(o3, W7, aI) {
            l_ = Ss.call(Po, o3, W7, aI, Zr, vO);
            Zr = (++Zr == iF) ? 0 : Zr;
            vO += Zr ? 0 : 1;
            return l_
        })
    },
    gB: function(iF) {
        var vO = [],
            W7;
        for (W7 = 0; W7 < this.length; W7 += iF) {
            [].push.apply(vO, this.slice(W7, W7 + iF).reverse())
        }
        return vO
    }
};
var DG = (function() {
    var p1 = function() {
            this.V7.B8 = 1;
            this.QV = tK.uY(this.QV, Z2.bind(this));
            this.fireEvent("B8")
        },
        iT = function() {
            this.LW(this.PM);
            delete this.PM;
            this.QV = tK.pW(this.QV);
            document.body.offsetWidth;
            tK.Z7(this.fireEvent.bind(this, "TS"), 1)
        },
        VM = function(Pq) {
            var tk = this.V7.WX.length;
            if (this.V7.hA) {
                while (--tk >= 0) {
                    if (0 == this.V7.WX[tk]--) {
                        this.Ly.vy(tk);
                        --this.V7.hA
                    }
                }
            }
            this.Ly.CK(Pq > this.Dk.Xi ? this.Dk.Xi : Pq)
        },
        Z2 = function(Pq) {
            !this.Ds && --this.V7.hf;
            if (this.V7.B8 && this.aM) {
                this.PM = this.aM.slice(0);
                this.V7.hf += Math.ceil(this.Dk.ro / tK.Wk());
                this.V7.hf = Math.max(this.V7.hf, 1);
                delete this.aM
            }
            if (this.V7.hf == 0) {
                if (this.Ly.sb) {
                    this.QV = tK.uY(this.QV, LS.bind(this))
                }
            }
            this.Ly.CK(Pq)
        },
        LS = function(Pq) {
            var tk = this.V7.S0.length;
            if (this.V7.f4 > 0) {
                while (--tk >= 0) {
                    if (0 == this.V7.S0[tk]--) {
                        this.Ly.a8(tk, this.aM);
                        --this.V7.f4
                    }
                }
            }
            this.Ly.CK(Pq > this.Dk.Xi ? this.Dk.Xi : Pq)
        };
    return new Class({
        Implements: [Events, E4],
        Binds: ["E9"],
        Dk: {
            Fn: 5,
            Xi: 50
        },
        toElement: function() {
            return this.rp
        },
        initialize: function(Dk) {
            Dk.VY.SA = Dk.VY.wA * (Dk.VY.kz + Dk.VY.lT) - Dk.VY.lT;
            Dk.VY.Xq = Dk.VY.IC * (Dk.VY.EF + Dk.VY.Td) - Dk.VY.Td;
            Dk.VY.fc = Dk.Ly.xo * Dk.VY.EF;
            var Hu = Dk.VY;
            this.qQ(Dk);
            this.Dk.WX = Dk.WX || Array.TC(0, 4, 1, 0);
            this.Dk.S0 = Dk.S0 || Array.TC(0, Hu.wA - 1, Hu.wA, 20);
            this.dE = new Elements(J1.nz.call(this.Dk.fY, Hu.wA, function(rc, lM, aI, pR, Xo) {
                var Wz = new Element("div", {
                    "class": "M0",
                    styles: {
                        position: "absolute",
                        height: Hu.EF,
                        width: Hu.kz,
                        top: Xo * (Hu.EF + Hu.Td),
                        left: pR * (Hu.kz + Hu.lT)
                    }
                });
                return Wz
            }, this));
            this.rp = new Element("div", {
                "class": "eX",
                styles: {
                    position: "relative",
                    margin: "0 auto",
                    height: Hu.IC * (Hu.EF + Hu.Td) - Hu.Td,
                    width: Hu.wA * (Hu.kz + Hu.lT) - Hu.lT
                }
            }).adopt(this.dE);
            Hu.lT && this.rp.adopt(Array.TC(0, Hu.wA - 2).map(function(pR) {
                return new Element("div", {
                    "class": "UK",
                    styles: {
                        left: Hu.kz + pR * (Hu.kz + Hu.lT)
                    }
                })
            }, this));
            this.Ly = this.Dk.Ly;
            this.Ly.addEvents({
                B8: p1.bind(this),
                TS: iT.bind(this)
            });
            this.rp.adopt(this.Ly.Gs({
                VY: Dk.VY
            }))
        },
        LW: (function() {
            var ag = [];
            return function(aM, Gj, wg) {
                Gj && this.Ly.E8(aM, Gj, wg);
                aM.forEach(function(PD, rc) {
                    this.dE[rc] && this.dE[rc].removeClass(ag[rc]).addClass(PD)
                }, this);
                ag = aM;
                this.dE.Jl("visibility", "")
            }
        })(),
        xZ: function(aM) {
            this.aM = aM;
            this.Ly.Wr(aM)
        },
        p3: function(x0) {
            var cO = [];
            for (var W7 = x0.length; W7--;) {
                cO[W7] = this.dE[x0[W7]]
            }
            return new Elements(cO)
        },
        Ri: function() {
            if (this.QV) {
                this.dE.Jl("visibility", "");
                this.Ly.Ri();
                this.QV = tK.pW(this.QV)
            }
            this.Ds = 0
        },
        zv: function(Dk) {
            this.Ly.P_();
            this.dE.Jl("visibility", "hidden");
            this.V7 = {
                hf: 0,
                B8: 0,
                TS: 0,
                hA: this.Dk.VY.wA,
                f4: this.Dk.VY.wA,
                WX: (this.Dk.WX).slice(0),
                S0: (this.Dk.S0).slice(0)
            };
            this.QV = this.QV || tK.qW(VM.bind(this), this.Dk.Fn)
        },
        E9: function(hZ) {
            this.Ds = !!hZ
        }
    })
})();
var dV = new Class({
    Implements: [Events, E4],
    initialize: function(Dk) {
        this.qQ(Dk)
    },
    Gs: function(Dk) {
        this.qQ(Dk)
    },
    P_: function(Uq) {
        this.L7 = this.zV = this.Dk.VY.wA;
        this.bF = 0;
        return this
    },
    vy: function(Jp, aM) {
        --this.L7;
        return this
    },
    a8: function(Jp, aM) {
        --this.zV;
        return this
    },
    Ri: function() {
        this.L7 = this.zV = 0;
        return this
    }
});
var gh = (function() {
    var cU = function cU(wg) {
            wg.forEach(function(H5, W7) {
                this.rZ[W7] = this.Q6(this.HK, W7, H5)
            }, this);
            this.TV = false
        },
        CK = function CK(Pq) {
            if (!this.zV && this.hg === 0) {
                this.Ri().fireEvent("TS")
            }
            this.tQ[this.HK].forEach(function(pR, tk) {
                if (this.BU[tk] === 0) {
                    return
                }
                this.PB[tk] += Pq;
                this.Nl = this.pA * this.PB[tk];
                if (!this.Uw[tk].Jh && this.BU[tk] == this.xo) {
                    this.Uw[tk].B3 = this.Nl;
                    this.Uw[tk].Jh = this.PB[tk]
                }
                if (this.BU[tk] != -1 && this.BU[tk] <= this.xo) {
                    this.q0[tk] = this.Uw[tk].d8(this.PB[tk] - this.Uw[tk].Jh)
                } else {
                    this.q0[tk] = this.Nl
                }
                this.tm = Math.floor(this.q0[tk] / this.Hu.EF);
                this.tC[tk] = Math.floor(this.q0[tk] % this.Hu.EF);
                if (this.tm > this.DZ[tk]) {
                    this.lO = this.tQ[this.HK][tk][this.rZ[tk]];
                    this.rS[tk].unshift(this.lO);
                    this.rS[tk].pop();
                    this.rZ[tk]--;
                    if (this.rZ[tk] < 0) {
                        this.rZ[tk] = this.tQ[this.HK][tk].length - 1
                    }
                    if (this.BU[tk] >= 0) {
                        this.BU[tk]--
                    }
                    if (this.BU[tk] === 0) {
                        this.hg--;
                        this.tC[tk] = 0
                    }
                    this.DZ[tk] = this.tm
                }
            }, this);
            this.H0.P1()
        };
    return new Class({
        Implements: [Events, E4],
        Extends: dV,
        initialize: function initialize(Dk) {
            var j7 = {
                H0: null,
                xF: 0,
                jE: 42,
                xo: 4,
                i8: 200,
                d0: 1
            };
            this.CK = CK;
            for (var kh in j7) {
                this[kh] = Dk[kh] || j7[kh]
            }
            this.tC = [];
            this.q3 = Dk.q3;
            this.d0 = 1;
            GH.FV(aO.xj, function(yk) {
                if (yk.d0 && yk.d0 > this.d0) {
                    this.d0 = yk.d0
                }
            }, this);
            this.d0 = Dk.d0 || this.d0;
            this.HK = Dk.HK;
            this.DZ = [];
            this.Nl = 0, this.rS = [];
            this.rZ = [];
            this.q0 = [];
            this.pA = this.jE / 1000;
            this.hg = 0;
            this.tQ = Dk.OW;
            this.BU = [];
            this.PB = [];
            this.xj = Dk.xj;
            this.tm = 0
        },
        Gs: function Gs(Dk) {
            this.Hu = Dk.VY;
            this.parent(Dk);
            this.Uw = [];
            this.tQ[this.HK].forEach(function(pR, tk) {
                this.Uw[tk] = $merge(Dk.q3, {});
                this.Uw[tk] = new this.q3({
                    u7: this.xo * this.Hu.EF,
                    hf: this.xo * this.i8
                })
            }, this);
            this.YC(this.H0);
            this.rp = document.createElement("div");
            this.rp.setAttribute("id", "oE");
            this.rp.setAttribute("style", "visibility:hidden;position:absolute;width:" + this.Hu.SA + "px;height:" + this.Hu.Xq + "px;");
            this.H0.Cq(this.rp);
            this.CT();
            return this.rp
        },
        CT: function() {
            var IC = this.Hu.IC;
            this.EH = GH.zZ(this.tQ, function(tQ) {
                return tQ.map(function(MT) {
                    return Array.zS(MT, IC)
                })
            })
        },
        P_: function P_() {
            delete this.sb;
            this.tQ[this.HK].forEach(function(pR, tk) {
                this.PB[tk] = 0;
                this.Uw[tk].Jh = 0
            }, this);
            this.hg = this.tQ[this.HK].length;
            this.rp.style.visibility = "";
            this.H0.P1();
            this.parent();
            return this
        },
        vy: function vy(tk, aM) {
            this.parent.apply(this, arguments);
            this.BU[tk] = -1;
            this.DZ[tk] = 0;
            this.L7 || this.fireEvent("B8");
            return this
        },
        Wr: function Wr(sb) {
            this.sb = this.t4(sb)
        },
        a8: function a8(tk) {
            this.parent.apply(this, arguments);
            this.rZ[tk] = this.Q6(this.HK, tk, this.sb[tk]);
            this.BU[tk] = this.Hu.UB + this.xF;
            return this
        },
        Ri: function Ri() {
            this.parent.apply(this, arguments);
            this.H0.XP();
            this.rp.style.visibility = "hidden";
            return this
        },
        YC: function YC(H0) {
            this.H0 = new H0(this)
        },
        E8: function E8(Hw, HK, wg) {
            this.HK = HK;
            this.H0.XP();
            Hw = this.t4(Hw);
            if (wg) {
                this.rZ = wg
            } else {
                cU.call(this, Hw)
            }
            this.tQ[this.HK].forEach(function(pR, tk) {
                var f5, xk, zb = this.tQ[this.HK][tk].length;
                this.rS[tk] = [];
                this.tC[tk] = 0;
                this.BU[tk] = -1;
                for (xk = 0; xk <= this.Hu.IC; xk++) {
                    f5 = (zb + this.rZ[tk] + xk - this.xF - this.Hu.IC) % zb;
                    this.rS[tk][xk] = this.tQ[this.HK][tk][f5]
                }
            }, this)
        },
        t4: function t4(sb) {
            var Js = [];
            J1.m8.call(sb, this.tQ[this.HK].length, function(lO, W7, aI, vO, Zr) {
                if (Zr < this.Hu.IC) {
                    Js[vO] = Js[vO] || [];
                    Js[vO][Zr] = lO
                }
            }, this);
            return Js
        },
        Q6: function Q6(HK, Cs, sb) {
            var fW = sb.join(""),
                rc = this.EH[HK][Cs][fW].getRandom();
            return (rc + this.Hu.IC - 1 + this.xF) % this.tQ[HK][Cs].length
        }
    })
})();
Array.zS = function(a, n) {
    var i, j, q, L = a.length,
        h = {};
    for (i = 0; q = "", i < L; h[q] = h[q] || [], h[q].push(i++)) {
        for (j = 0; j < n; q += a[(i + j++) % L]) {}
    }
    return h
};
t9 = (function() {
    var IZ = ((navigator.userAgent.indexOf("Mozilla/5.0") > -1 && navigator.userAgent.indexOf("Android ") > -1 && navigator.userAgent.indexOf("AppleWebKit") > -1) && !(navigator.userAgent.indexOf("Chrome") > -1));
    var exports = function(Cm) {
        this.Cm = Cm;
        this.Hu = Cm.Dk.VY;
        this.lH = 0;
        this.pJ = 0;
        this.xk = 0;
        this.cv = "";
        this.d0;
        this.sM;
        this.wL
    };
    exports.prototype = {
        Cq: function Cq(Cm) {
            var wL, Hu = this.Cm.Dk.VY,
                d0 = this.d0 = this.Cm.d0 || 1,
                sM = this.sM = window.devicePixelRatio || 1;
            wL = this.wL = document.createElement("canvas");
            wL.setAttribute("width", this.Hu.SA * d0);
            wL.setAttribute("height", this.Hu.Xq * d0);
            wL.setAttribute("style", "position:absolute;top:0px;left:0px;width:" + this.Hu.SA + "px;height:" + this.Hu.Xq + "px;");
            this.JO = wL.getContext("2d");
            this.JO.scale(d0 / sM, d0 / sM);
            this.JO.fillStyle = "#FFF";
            this.JO.strokeStyle = "#000";
            this.JO.lineWidth = 3;
            this.JO.font = "16px consolas";
            this.JO.textBaseline = "top";
            Cm.appendChild(wL)
        },
        P1: function P1() {
            var tk;
            this.XP();
            for (tk = 0; tk < this.Hu.wA; tk++) {
                this.RD(tk)
            }
        },
        RD: function RD(tk) {
            for (this.xk = 0; this.xk <= this.Hu.IC; this.xk++) {
                this.lH = tk * (this.Hu.kz + this.Hu.lT);
                this.pJ = this.xk * this.Hu.EF + ((this.Cm.tC[tk] | 0) - this.Hu.EF);
                this.cv = this.Cm.rS[tk][this.xk];
                this.Fd(this.cv, {
                    lH: this.lH,
                    pJ: this.pJ
                })
            }
        },
        Fd: function Fd(cv, TL) {
            var wh = this.Cm.xj[this.Cm.HK][cv];
            wh.Bc(this.JO, 0, 0, TL.lH, TL.pJ)
        },
        XP: function XP() {
            var JO = this.wL.getContext("2d");
            JO.save();
            JO.setTransform(1, 0, 0, 1, 0, 0);
            JO.clearRect(0, 0, JO.canvas.width, JO.canvas.height);
            if (IZ) {
                this.wL.Jl("opacity", 0.99);
                setTimeout(function() {
                    this.wL.Jl("opacity", 1)
                }.bind(this), 0)
            }
            JO.restore()
        }
    };
    return exports
})();

function Cn(Dk) {
    this.R2 = Dk.R2;
    this.kO = Dk.kO;
    this.u7 = Dk.u7;
    this.hf = Dk.hf;
    this.B3 = 0
}
Cn.prototype = {
    gd: function(t) {
        return t * t * t
    },
    zX: function(t) {
        return 3 * t * t * (1 - t)
    },
    TN: function(t) {
        return 3 * t * (1 - t) * (1 - t)
    },
    r2: function(t) {
        return (1 - t) * (1 - t) * (1 - t)
    },
    d8: function(E5) {
        var vZ = E5 / this.hf;
        return this.R2 * this.zX(vZ) + this.kO * this.TN(vZ) + this.r2(vZ)
    },
    cM: function(B3) {
        this.B3 = B3
    }
};

function yj(Dk) {
    this.u7 = Dk.u7;
    this.hf = Dk.hf;
    this.B3 = 0
}
yj.prototype = {
    d8: function(E5) {
        return this.u7 * ((E5 = E5 / this.hf - 1) * E5 * E5 + 1) + this.B3
    }
};

function Mq(Dk) {
    this.u7 = Dk.u7;
    this.hf = Dk.hf;
    this.B3 = 0
}
Mq.prototype = {
    d8: function(E5) {
        return this.u7 * (E5 / this.hf) + this.B3
    },
    cM: function(B3) {
        this.B3 = B3
    }
};
var ks = (function() {
    var IZ = ((navigator.userAgent.indexOf("Mozilla/5.0") > -1 && navigator.userAgent.indexOf("Android ") > -1 && navigator.userAgent.indexOf("AppleWebKit") > -1) && !(navigator.userAgent.indexOf("Chrome") > -1));
    return new Class({
        Implements: [E4],
        FH: null,
        U7: null,
        qR: null,
        Dk: {
            PV: [],
            VY: null,
            cB: 2,
            Qo: 3,
            Fp: "#000000",
            Uy: "miter",
            ME: "butt",
            yR: "",
            Vg: true
        },
        toElement: function() {
            return this.U7
        },
        initialize: function(FH, Dk) {
            this.qQ(Dk);
            this.U7 = new Element("div", {
                id: "rn"
            });
            this.FH = this.Gu(FH);
            var VY = this.Dk.VY,
                g2 = this.Dk.cB,
                Rk = VY.EF,
                jK = VY.kz,
                Ga = VY.lT,
                LF = VY.Td,
                wA = VY.wA,
                UB = this.Dk.Yx.length / VY.wA,
                SA = (jK + Ga) * wA - Ga,
                Xq = (Rk + LF) * UB - LF,
                vv = (VY.e7 - SA) / 2,
                Vr = (VY.hS - Xq) / 2,
                d0 = 1,
                sM = 1;
            GH.FV(aO.xj, function(yk) {
                if (yk.d0 && yk.d0 > d0) {
                    d0 = yk.d0
                }
            });
            d0 = this.Dk.d0 || d0;
            this.Y0 = this.Dk.Yx.map(function(o3, W7) {
                return [vv + (W7 % wA) * (jK + Ga) + g2 / 2, Vr + Math.floor(W7 / wA) * (Rk + LF) + g2 / 2, jK - g2, Rk - g2]
            }, this);
            this.qR = new Element("canvas", {
                width: this.Dk.VY.e7 * d0,
                height: this.Dk.VY.hS * d0,
                styles: {
                    width: this.Dk.VY.e7,
                    height: this.Dk.VY.hS
                }
            });
            this.qR.getContext("2d").scale(d0 / sM, d0 / sM);
            this.R0 = this.Dk.PV.filter(function(Xa) {
                return Xa < FH.length
            }).map(function(Xa) {
                var rp = this.qR.clone(),
                    JO = rp.getContext("2d"),
                    eQ = 0;
                JO.scale(d0 / sM, d0 / sM);
                while (eQ++ < Xa) {
                    this.z0(JO, this.FH[eQ])
                }
                return rp
            }, this);
            this.O2(this.Dk.l8);
            this.qR.KT({
                position: "relative"
            });
            this.Dk.Bd.forEach(function(rp, W7) {
                var R3 = this[W7];
                rp && rp.KT({
                    position: "absolute",
                    top: (R3.fB[0][1] - rp.firstElementChild.height / 2) + "px",
                    transform: Bm.rK.mB(R3.Kn ? 1 : -1, 1)
                }) && rp.Jl(R3.Kn ? "left" : "right", (R3.Nm === void(0) ? -2 : R3.Nm) + "px")
            }, this.FH);
            this.U7.adopt(this.qR, this.R0, this.Dk.Bd)
        },
        SS: function(CM) {
            var JO = this.qR.getContext("2d");
            this.vM();
            CM.forEach(function(Cw) {
                this.z0(JO, this.FH[Cw.dN], Cw.dN ? null : Cw.ND)
            }, this);
            return this
        },
        vM: function() {
            var JO = this.qR.getContext("2d");
            JO.save();
            JO.setTransform(1, 0, 0, 1, 0, 0);
            JO.clearRect(0, 0, JO.canvas.width, JO.canvas.height);
            if (IZ) {
                this.qR.Jl("opacity", 0.99);
                setTimeout(function() {
                    this.qR.Jl("opacity", 1)
                }.bind(this), 0)
            }
            JO.restore()
        },
        qB: function(Cw) {
            var W7 = Cw.dN,
                JO = this.qR.getContext("2d");
            this.vM();
            this.z0(JO, this.FH[W7], Cw.ND, Cw.yv);
            return this
        },
        AR: function(aq) {
            this.qR.style.visibility = (aq ? "visible" : "");
            return this
        },
        T0: function(RR) {
            if (this.l8) {
                this.l8.style.visibility = RR ? "visible" : ""
            }
        },
        O2: function(Nz, RR) {
            this.T0(0);
            this.l8 = this.R0[this.Dk.PV.indexOf(Nz)];
            this.Dk.Bd.forEach(function(Hk, rA) {
                Hk && (rA <= Nz ? Hk.removeClass("Jv") : Hk.addClass("Jv"))
            });
            this.T0(RR);
            return this
        },
        z0: function(JO, GG, ND, yv) {
            var Dk = this.Dk,
                eQ = 0,
                fB = GG.fB;
            JO.lineCap = Dk.ME;
            JO.lineJoin = Dk.Uy;
            if (fB && fB.length && Dk.Vg) {
                JO.beginPath();
                JO.moveTo(fB[eQ][0], fB[eQ][1]);
                while (++eQ < fB.length) {
                    JO.lineTo(fB[eQ][0], fB[eQ][1])
                }
                JO.strokeStyle = Dk.Fp;
                JO.lineWidth = Dk.Qo;
                JO.stroke();
                JO.strokeStyle = GG.Qi;
                JO.lineWidth = Dk.cB;
                JO.stroke()
            }
            ND && ND.forEach(function(v0) {
                var TL = this[v0];
                JO.clearRect(TL[0], TL[1], TL[2], TL[3]);
                JO.beginPath();
                JO.moveTo(TL[0], TL[1]);
                JO.lineTo(TL[0] + TL[2], TL[1]);
                JO.lineTo(TL[0] + TL[2], TL[1] + TL[3]);
                JO.lineTo(TL[0], TL[1] + TL[3]);
                JO.closePath();
                JO.globalCompositeOperation = "destination-over";
                JO.strokeStyle = Dk.Fp;
                JO.lineWidth = Dk.Qo;
                JO.stroke();
                JO.beginPath();
                JO.moveTo(TL[0], TL[1]);
                JO.lineTo(TL[0] + TL[2], TL[1]);
                JO.lineTo(TL[0] + TL[2], TL[1] + TL[3]);
                JO.lineTo(TL[0], TL[1] + TL[3]);
                JO.closePath();
                JO.globalCompositeOperation = "source-over";
                JO.strokeStyle = GG.Qi;
                JO.lineWidth = Dk.cB;
                JO.stroke()
            }, this.Y0);
            yv && yv.forEach(function(v0) {
                var TL = this[v0];
                JO.beginPath();
                JO.moveTo(TL[0], TL[1] + TL[3] / 2);
                JO.lineTo(TL[0] + TL[2], TL[1] + TL[3] / 2);
                JO.stroke()
            }, this.Y0)
        },
        Gu: function(FH) {
            var YW = function(fB) {
                    var f8, i3, UX, RB, gA = 0;
                    while (++gA < this.length / 2) {
                        f8 = this[gA - 1];
                        i3 = this[gA];
                        UX = this[gA + 1];
                        if (Math.abs(f8[1] - i3[1]) < Rc) {
                            RB = UX[1] - i3[1];
                            if (RB) {
                                i3[0] += (UX[0] - i3[0]) * (f8[1] - i3[1]) / RB
                            }
                            i3[1] = f8[1]
                        }
                    }
                    return this
                },
                VY = this.Dk.VY,
                y1 = this.Dk.VY.y1 || 0,
                jK = VY.kz,
                Rk = VY.EF,
                wA = VY.wA,
                UB = this.Dk.Yx.length / VY.wA,
                Rc = Rk / 2,
                yJ = jK / 2,
                Ga = VY.lT,
                LF = VY.Td,
                SA = (jK + Ga) * wA - Ga,
                Xq = (Rk + LF) * UB - LF,
                vv = (VY.e7 - SA) / 2,
                Vr = (VY.hS - Xq) / 2,
                C1, vb;
            FH.forEach(function(C1) {
                var fB = C1.fB,
                    Fv, f9, vu;
                if (fB) {
                    var Nm = (C1.Nm + 2 || 0);
                    fB[0] = [C1.Kn ? Nm : VY.e7 - Nm, fB[0] + Vr];
                    fB[1] = [C1.Kn ? VY.e7 - vv - y1 : vv + y1, fB[1] + Vr];
                    Fv = fB.pop();
                    C1.Hw.forEach(function(lO) {
                        f9 = vv + yJ + lO % wA * (jK + Ga);
                        vu = Vr + Rc + Math.floor(lO / wA) * (Rk + LF) + C1.qz;
                        fB.push([f9, vu])
                    });
                    if (y1 !== 0) {
                        var tb = y1 / (C1.Kn ? Fv[0] - f9 : f9 - Fv[0]);
                        Fv[1] = Fv[1] - ((Fv[1] - vu) * tb)
                    }
                    fB.push(Fv);
                    YW.call(fB).reverse();
                    YW.call(fB).reverse()
                }
            });
            return FH
        },
        t6: function(Hr, Mh, e8, Vb, LC) {
            var VY = this.Dk.VY,
                wA = VY.wA,
                UB = VY.IC || VY.UB,
                d0 = 1,
                sM = 1,
                Nd = Mh * UB + 1,
                Nf = Hr * wA + 1,
                lH, pJ, wT = 1,
                Ol = 0.5,
                wL, JO;
            GH.FV(aO.xj, function(yk) {
                if (yk.d0 && yk.d0 > d0) {
                    d0 = yk.d0
                }
            });
            d0 = this.Dk.d0 || d0;
            wL = new Element("canvas", {
                width: Nf * d0,
                height: Nd * d0,
                styles: {
                    width: Nf,
                    height: Nd
                }
            });
            JO = wL.getContext("2d");
            JO.scale(d0 / sM, d0 / sM);
            JO.fillStyle = "#fff";
            JO.fillRect(1, 1, Nf - 1, Nd - 1);
            JO.globalCompositeOperation = "source-over";
            JO.fillStyle = (LC) ? LC : (this.Dk.yR === "") ? e8.Qi : this.Dk.yR;
            e8.Hw.forEach(function(rc) {
                pJ = Hr * Math.floor(rc / wA);
                lH = Mh * (rc % wA), JO.fillRect(lH + 1, pJ + 1, Hr - 1, Mh - 1)
            });
            JO.globalCompositeOperation = "source-over";
            JO.lineWidth = wT;
            JO.strokeStyle = "#000";
            JO.strokeRect(Ol, Ol, Nf - wT, Nd - wT);
            JO.strokeStyle = "#444";
            JO.beginPath();
            for (lH = Hr; lH < Nf - 1; lH += Hr) {
                JO.moveTo(lH + Ol, wT);
                JO.lineTo(lH + Ol, Nd - wT)
            }
            JO.stroke();
            JO.beginPath();
            for (pJ = Mh; pJ < Nd - 1; pJ += Mh) {
                JO.moveTo(wT, pJ + Ol);
                JO.lineTo(Nf - wT, pJ + Ol)
            }
            JO.stroke();
            return (new Element("div", {
                "class": "GW"
            })).adopt(new Element("div", {
                "class": "XG",
                html: Vb
            }), wL)
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
var qZ = (function() {
    var Ty = Object.freeze(function() {
        var Ty = {};
        Ty.qN = {};
        (function() {
            window.AudioContext = window.AudioContext || window.webkitAudioContext;
            if (navigator.userAgent.indexOf("Chrome/11.") > -1 && navigator.userAgent.indexOf("Linux x86_64") > -1) {
                Ty.qN.lJ = 0
            } else {
                if ((navigator.userAgent.indexOf("4.1.1") > -1 || navigator.userAgent.indexOf("4.1.2") > -1) && (navigator.userAgent.indexOf("GT-I9300") > -1 || navigator.userAgent.indexOf("GT-I9100") > -1)) {
                    Ty.qN.lJ = 0
                } else {
                    window.AudioContext ? Ty.qN.lJ = 1 : Ty.qN.lJ = 0
                }
            }
        })();
        Object.freeze(Ty.qN);
        return Object.freeze(Ty)
    })();
    G4 = function(gO) {
        this.w0 += gO / 1000;
        if (this.w0 >= this.hn) {
            --this.BJ;
            this.w0 = this.ly
        }
        if (this.BJ === 0) {
            this.M6 = tK.pW(this.M6);
            this.w0 = this.ly = this.hn = void 0;
            this.u0 && u0.call(this);
            RS(this, "xe", this.ly)
        }
    }, u0 = function() {
        GH.d6(this, this.u0);
        this.Yh(this.cK);
        delete this.u0
    }, RS = function(UW, pB, J0) {
        setTimeout(UW.fireEvent.bind.apply(UW.fireEvent, arguments), 0)
    };
    return new Class({
        Implements: Events,
        BH: function() {
            return 0
        },
        ZU: function(Lz, DD, nI) {
            nI = nI || 0;
            var Lz = this.x3[Lz];
            this.Yq = Lz;
            return this.tx.apply(this, Lz.concat(DD, nI))
        },
        gv: function(Lz) {
            var Lz = this.x3[Lz];
            return this.oI.apply(this, Lz)
        },
        Tg: function(Lz) {
            var Lz = this.x3[Lz];
            return this.tn.apply(this, Lz)
        },
        Lv: function(pB, qA) {
            return new YK(new fz(this, pB, qA))
        },
        uI: function(Lz, DD, nI) {
            return this.Lv("ov").addEvent("M9", this.gv.bind(this, Lz, DD, nI))
        },
        ZN: function(Lz, DD, nI) {
            return this.Lv("sO").addEvent("M9", this.ZU.bind(this, Lz, DD, nI))
        },
        Qe: function(Lz, DD, nI) {
            return this.Lv("xe").addEvent("M9", this.ZU.bind(this, Lz, DD, nI))
        },
        initialize: function(h7, Gk) {
            var Vp = function() {
                    this.NR()
                },
                Pn = function() {
                    this.sV()
                },
                eW = function() {
                    this.p6()
                },
                Yl = function() {
                    if (document.hidden) {
                        this.NR()
                    } else {
                        this.sV()
                    }
                };
            window.addEventListener("pagehide", Vp.bind(this), false);
            window.addEventListener("focusout", Vp.bind(this), false);
            window.addEventListener("pageshow", Pn.bind(this), false);
            window.addEventListener("focusin", Pn.bind(this), false);
            window.addEventListener("focus", Pn.bind(this), false);
            window.addEventListener("beforeunload", eW.bind(this), false);
            window.addEventListener("unload", eW.bind(this), false);
            document.addEventListener("webkitvisibilitychange", Yl.bind(this), false);
            document.addEventListener("visibilitychange", Yl.bind(this), false);
            this.gR = Ty.qN.lJ && Gk.BT > 0 ? qZ.nQ(h7) : qZ.Km(h7);
            this.x3 = Gk.Sa || []
        },
        MF: function() {
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
        K9: function(RA) {
            this.u0 = RA;
            this.w0 || u0.call(this);
            var apitsModule = APITS(RA.MF())
        },
        tx: function(Wd, gY, DD) {
            this.M6 = this.M6 && tK.pW(this.M6);
            this.ly = this.w0 = Wd;
            this.hn = Wd + gY;
            this.BJ = DD || 1;
            this.M6 = tK.qW(G4.bind(this), 100);
            RS(this, "sO", this.ly);
            return this
        },
        oI: function(Wd) {
            RS(this, "ov", Wd);
            return this
        },
        NR: function() {
            this.M6 = this.M6 && tK.pW(this.M6);
            RS(this, "N8");
            return this
        },
        p6: function() {
            this.M6 = this.M6 && tK.pW(this.M6);
            this.w0 = this.ly = this.hn = void 0;
            RS(this, "aT");
            return this
        },
        uR: function() {
            this.p6()
        },
        tn: function(Wd) {
            var Rq = this.ly;
            return Wd ? Rq === Wd : Rq
        },
        sV: function(Wd) {
            this.M6 = this.w0 && tK.qW(G4.bind(this), 100);
            return this
        },
        Yh: function(mr) {
            this.cK = !!mr
        },
        rF: function() {
            return this.cK
        }
    })
})();
xN.C9("audio/*", function(UV) {
    aO.DM = new qZ("audio", {
        BT: this.BT,
        Sa: this.Sa
    });
    if (aO.DM.gR) {
        var wR = xu.FU(new xu({
                UF: "wR",
                OE: "qo AW"
            })),
            W3 = function(wR) {
                wR.aq(0);
                wR.rp.destroy();
                aO.DM.addEvents({
                    load: this.eN,
                    error: this.VH,
                    abort: this.VH
                }).gR("audio", this.Sq.split(",").map(function(h7) {
                    var a = document.createElement("a");
                    a.href = UV + this.xV + "&Accept=" + h7;
                    a.protocol = "http";
                    return {
                        type: h7,
                        src: a.href
                    }
                }, this), this.Nw && GH.zZ(this.Nw, function(W7, Zr) {
                    var a = document.createElement("a");
                    a.href = UV + this.xV + "&Accept=" + Vy(this.Sq);
                    a.protocol = window.location.protocol;
                    a.pathname = a.pathname + "/" + this.Nw[Zr];
                    var BR = a.href;
                    return BR
                }, this))
            },
            jv = function(wR) {
                wR.rp.destroy();
                aO.DM.K9(aO.DM);
                this.eN()
            },
            Vy = function(Sq) {
                var lE = new Audio();
                var KW = Sq.split(",");
                var Sz = {};
                var i = KW.length;
                while (--i >= 0) {
                    Sz[lE.canPlayType(KW[i])] = KW[i]
                }
                return Sz.probably || Sz.maybe || void 0
            };
        wR.xs({
            zJ: new TM({
                TT: rO("audioLoader.yes"),
                tY: 1
            }),
            iM: new TM({
                TT: rO("audioLoader.no"),
                tY: 1
            })
        }).addEvents({
            zJ: W3.bind(this, wR),
            iM: jv.bind(this, wR)
        }).ZI(rO("audioLoader.confirm"));
        document.body.adopt(wR);
        wR.aq(1)
    } else {
        this.eN()
    }
});
qZ.Km = (function() {
    var Vn = function(aI, fp) {
            return (aI - fp) * (aI - fp) < 0.00001
        },
        m4 = function() {
            if (this.AI) {
                this.Rf = this.AI;
                this.AI = void 0;
                this.fireEvent("ov", this.Rf);
                this.Rf === this.TR && aC.call(this)
            }
        },
        Hd = function() {
            if (this.ly && this.rp.currentTime >= this.hn) {
                if (--this.BJ) {
                    this.tx(this.ly, this.hn - this.ly, this.BJ)
                } else {
                    this.nS = this.ly;
                    this.rp.pause()
                }
                this.ly = void 0
            } else {
                if (!this.hn) {
                    this.rp.currentTime = this.AI || 0;
                    this.rp.pause()
                }
            }
        },
        sT = function() {
            if (this.nS) {
                this.hn = this.AI = this.Rf = this.TR = this.BJ = this.ly = void 0;
                this.fireEvent("xe", this.nS);
                this.nS = void 0
            } else {
                if (this.ly) {
                    this.fireEvent("N8")
                }
            }
        },
        aC = function() {
            if (this.Rf === this.TR) {
                this.ly = this.TR;
                this.AI = this.Rf = this.TR = void 0;
                this.fireEvent("sO", this.ly);
                this.rp.play()
            }
        },
        U8 = {
            BH: function() {
                return 0
            },
            MF: function() {
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
            tx: function(Wd, gY, DD, nI) {
                nI = nI || 0;
                if (nI == 0) {
                    this.BJ = DD || 1;
                    this.TR = Wd;
                    this.hn = Wd + gY;
                    this.Rf === Wd && aC.call(this, this.hn);
                    this.AI === Wd || this.oI(Wd)
                } else {}
                return this
            },
            oI: function(Wd) {
                if (this.AI !== Wd) {
                    this.rp.currentTime = this.AI = Wd
                }
                return this
            },
            NR: function() {
                this.rp.pause();
                return this
            },
            p6: function(UF) {
                if (!UF) {
                    this.rp.pause();
                    this.hn = this.AI = this.Rf = this.TR = this.BJ = this.ly = void 0
                } else {}
                return this
            },
            uR: function() {
                this.p6()
            },
            sV: function() {
                this.tn() && this.rp.play();
                return this
            },
            tn: function(Wd) {
                var Rq = this.TR || this.ly;
                return Wd ? Rq === Wd : Rq
            },
            Yh: function(mr) {
                this.rp.muted = !!mr
            },
            rF: function() {
                return this.rp.muted
            }
        },
        m7 = function(h7, Gi) {
            var rp, HG, y2, X_ = function() {
                    this.fireEvent("load")
                }.bind(this),
                lF = function() {
                    this.fireEvent("load")
                }.bind(this),
                s3 = function() {
                    MB.call(this)
                }.bind(this),
                Xh = function() {
                    HG && clearTimeout(HG);
                    HG = setTimeout(this.fireEvent.bind(this, "load"), 20000)
                }.bind(this),
                MB = function() {
                    HG && clearTimeout(HG);
                    this.rp.removeEventListener("progress", Xh, true);
                    this.rp.removeEventListener("error", X_, true);
                    this.rp.removeEventListener("abort", lF, true);
                    this.rp.removeEventListener("canplaythrough", s3, true);
                    Xh = X_ = lF = MB = void 0;
                    this.K9(U8);
                    this.fireEvent("load")
                };
            rp = new Element(h7);
            rp.addEventListener("seeked", m4.bind(this));
            rp.addEventListener("ended", sT.bind(this));
            rp.addEventListener("pause", sT.bind(this));
            rp.addEventListener("timeupdate", Hd.bind(this));
            rp.addEventListener("canplaythrough", s3, true);
            rp.addEventListener("error", X_, true);
            rp.addEventListener("abort", lF, true);
            rp.addEventListener("progress", Xh, true);
            this.rp = rp;
            this.rp.preload = "none";
            this.rp.adopt(Gi.map(function(mG) {
                return new Element("source", mG)
            }));
            if (jD.Af === "GO" && jD.mJ >= 8) {
                this.rp.play()
            } else {
                this.rp.load()
            }
            this.rp.preload = "auto";
            HG = setTimeout(this.fireEvent.bind(this, "load"), 20000);
            return this
        };
    return function(h7) {
        var iJ = !(jD.Af == "MG" && jD.mJ < 2.3) && !(jD.Af == "GO" && jD.mJ < 4) && document.createElement(h7).play;
        return iJ && m7
    }
})();
qZ.nQ = (function() {
    var Vn = function(aI, fp) {
            return (aI - fp) * (aI - fp) < 0.00001
        },
        jQ = [],
        mG, Ex = [],
        Kt = [],
        kI = null,
        sT = function() {
            if (this.nS) {
                this.hn = this.AI = this.Rf = this.TR = this.BJ = this.ly = void 0;
                this.fireEvent("xe", this.nS);
                this.nS = void 0
            } else {
                if (this.ly) {
                    this.fireEvent("N8")
                }
            }
        },
        aC = function() {
            if (this.Rf === this.TR) {
                this.ly = this.TR;
                this.AI = this.Rf = this.TR = void 0;
                this.fireEvent("sO", this.ly);
                this.rp.play()
            }
        },
        V_ = function(XZ) {
            for (var i in Kt) {
                if (Kt[i].nI == XZ && Kt[i].nI != undefined) {
                    U8.p6(Kt[i].U3)
                }
            }
        },
        zl = function() {
            for (var i in Kt) {
                if (Kt[i].U3 != undefined) {
                    U8.p6(Kt[i].U3)
                }
            }
        },
        U8 = {
            BH: function() {
                return 1
            },
            MF: function() {
                var soundPlayer = {
                    play: function(id, loop, channel) {
                        U8.tx(id, loop, channel)
                    },
                    stop: function(id) {
                        U8.p6(id)
                    },
                    createTrack: function() {
                        return {
                            schedule: function schedule() {}
                        }
                    },
                    decode: function(id, buffer, successCallback, failureCallback) {
                        kI.decodeAudioData(buffer, function(Ii) {
                            jQ[id] = Ii;
                            successCallback()
                        }, function() {
                            failureCallback(new Error('Failed to decode buffer for sound "' + id + '"'))
                        })
                    },
                    format: "audio/mpeg"
                };
                return soundPlayer
            },
            ZU: function(Lz, DD, nI) {
                nI = nI || 0;
                this.Yq = Lz;
                return this.tx.call(this, Lz, DD, nI)
            },
            tx: function(Wd, DD, nI) {
                mG = kI.createBufferSource();
                mG.buffer = jQ[Wd];
                mG.loop = DD > 1 ? true : false;
                var aD = {
                    mG: mG,
                    U3: Wd,
                    nI: nI
                };
                if (nI == 0) {
                    V_(nI)
                } else {
                    this.p6(Wd)
                }
                Kt[Wd] = aD;
                mG.connect(Ex.master);
                (typeof mG.start === "undefined") ? mG.noteGrainOn(0, 0, mG.buffer.duration): mG.start(0);
                return this
            },
            oI: function(Wd) {
                return this
            },
            NR: function() {
                Ex.master.gain.value = 0;
                return this
            },
            p6: function(zB) {
                if (Kt[zB]) {
                    if (navigator.userAgent.indexOf("like Mac OS X") >= 0 && navigator.userAgent.indexOf("6_") >= 0) {
                        if (Kt[zB].mG.playbackState == mG.PLAYING_STATE || Kt[zB].mG.playbackState == mG.SCHEDULED_STATE) {
                            Kt[zB].mG.noteOff(0)
                        }
                    } else {
                        if (Kt[zB].mG.playbackState == mG.PLAYING_STATE || Kt[zB].mG.playbackState == mG.SCHEDULED_STATE) {
                            Kt[zB].mG.stop(0)
                        }
                    }
                    delete Kt[zB]
                }
                this.hn = this.AI = this.Rf = this.TR = this.BJ = this.ly = void 0;
                return this
            },
            uR: function() {
                zl()
            },
            sV: function() {
                Ex.master.gain.value = 1;
                this.tn();
                return this
            },
            tn: function(Wd) {
                if (Kt[Wd] && Kt[Wd].mG.playbackState == mG.PLAYING_STATE) {
                    return true
                }
                return false
            },
            Tg: function(Lz) {
                return this.tn.call(this, Lz)
            },
            Yh: function(mr) {},
            rF: function() {
                return false
            }
        },
        m7 = function(h7, Gi, Sa) {
            var rp, HG, y2, X_ = function(e) {
                    this.fireEvent("error")
                }.bind(this),
                Og = function() {
                    if (Object.keys(jQ).length >= Object.keys(Sa).length) {
                        HG = setTimeout(this.fireEvent.bind(this, "load"), 1)
                    }
                }.bind(this),
                lF = function(e) {
                    this.fireEvent("abort")
                }.bind(this),
                s3 = function() {
                    MB.call(this)
                }.bind(this),
                Xh = function() {}.bind(this),
                MB = function() {
                    HG && clearTimeout(HG);
                    this.rp.removeEventListener("progress", Xh, true);
                    this.rp.removeEventListener("error", X_, true);
                    this.rp.removeEventListener("abort", lF, true);
                    this.rp.removeEventListener("canplaythrough", s3, true);
                    Xh = X_ = lF = MB = void 0;
                    this.K9(U8);
                    this.fireEvent("load")
                };
            for (var BR in Sa) {
                if (Sa.hasOwnProperty(BR)) {
                    Nk(BR, Sa, Og, lF)
                }
            }
            kI = new window.AudioContext();
            mG = kI.createBufferSource();
            mG.connect(kI.destination);
            Ex = {
                destination: kI.destination,
                master: (typeof kI.createGain === "undefined") ? kI.createGainNode() : kI.createGain(),
                music: (typeof kI.createGain === "undefined") ? kI.createGainNode() : kI.createGain(),
                fx: (typeof kI.createGain === "undefined") ? kI.createGainNode() : kI.createGain()
            };
            Ex.master.connect(Ex.destination);
            Ex.music.connect(Ex.master);
            Ex.fx.connect(Ex.master);
            (typeof mG.start === "undefined") ? mG.noteGrainOn(0, 0, 0): mG.start(0);
            this.K9(U8);
            return this
        },
        Nk = function(BR, Sa, F1, kS) {
            var Q_ = new XMLHttpRequest();
            Q_.onload = function(e) {
                kI.decodeAudioData(e.target.response, function(Ii) {
                    jQ[BR] = Ii;
                    F1.apply()
                }, function() {
                    kS.apply()
                })
            }.bind(this);
            Q_.onerror = function(e) {
                kS.apply(e)
            };
            Q_.open("GET", Sa[BR], true);
            Q_.responseType = "arraybuffer";
            Q_.send()
        };
    return function(h7) {
        var iJ = !(jD.Af == "MG" && jD.mJ < 2.3) && !(jD.Af == "GO" && jD.mJ < 4) && document.createElement(h7).play;
        return iJ && m7
    }
})();
(function() {
    var tB = {},
        B7 = {};
    PrefixFree.properties.forEach(function(Ei) {
        tB[StyleFix.camelCase(Ei)] = StyleFix.camelCase(PrefixFree.prefixProperty(Ei));
        B7[Ei] = PrefixFree.prefixProperty(Ei)
    });
    Element.implement({
        Jl: function(CQ, Ba) {
            this.style[tB[CQ] || CQ] = PrefixFree.value(Ba.toString(), CQ);
            return this
        },
        C8: function(CQ, Ba) {
            return this.style[tB[CQ] || CQ]
        },
        KT: function(zI) {
            var CQ;
            for (CQ in zI) {
                this.Jl(CQ, zI[CQ])
            }
            return this
        },
        rb: function() {
            return new wq(this)
        }
    });
    jD.mI = function(CQ) {
        return tB[CQ] || CQ
    };
    jD.mC = function(Ei) {
        return B7[Ei] || Ei
    }
})();
var tc = new Class({
    Extends: xu,
    initialize: function() {
        this.parent.apply(this, arguments);
        this.cV = (new Element("div", {
            "class": "xm"
        })).inject(this)
    },
    C7: function() {
        this.parent();
        this.S8(0)
    },
    KO: function(Iy, qy) {
        Iy.Buttons.forEach(function(W_, lM) {
            this.KF("choice" + lM, new TM({
                OE: Iy.Buttons.length > 1 ? "" : "Ka",
                TT: Iy.Buttons.length > 1 ? W_.Text : "",
                tY: 1
            })).rE("choice" + lM, function() {
                this.C7();
                qy(Iy.Buttons[lM].Cmd)
            })
        }.bind(this));
        this.cV.set("text", Iy.Reference ? rO("mproxy.Error.RGSid") + Iy.Reference : "");
        return this.ZI(new Element("p", {
            text: Iy.Message
        }), Iy.SupportInfo && (new Element("p", {
            text: Iy.SupportInfo.Message
        })).adopt(new Element("address", {
            text: [Iy.SupportInfo.PhoneNumber, Iy.SupportInfo.Email].join("\n")
        })))
    }
});
var Ho = new Class({
    Extends: Request,
    options: {
        DP: 10000
    },
    initialize: function(T9) {
        this.parent(T9);
        delete this.headers["X-Requested-With"]
    },
    send: function() {
        var sZ = navigator.onLine;
        this.options.DP && setTimeout(this.cancel.bind(this), this.options.DP);
        sZ === false ? this.fireEvent("offline") : this.parent()
    }
});
var qq = (function() {
    var cq = function() {
            if (0 >= --this.MU) {
                this.fireEvent("O_");
                this.fireEvent("IN", this.T8.status)
            } else {
                this.T8.send()
            }
        },
        vi = function() {
            this.fireEvent("QP")
        },
        Og = function(EI) {
            var Kw, RL, Wa, EI;
            try {
                EI = JSON.parse(EI)
            } catch (e) {
                return this.fireEvent("hb")
            }
            Kw = EI.ReturnStatus;
            if (Kw.Code != 1000000) {
                this.fireEvent("ZC", Kw)
            } else {
                if (EI.Authentication && EI.Authentication.Status == "Pending") {
                    ++this.MU;
                    setTimeout(this.send.bind(this), this.dg *= 1.5)
                } else {
                    this.fireEvent("c6", EI)
                }
            }
        },
        tw = function() {
            this.fireEvent("O_")
        };
    return new Class({
        Implements: Events,
        initialize: function(J0) {
            this.MU = J0.MU || 0;
            this.dg = J0.dg || 1000;
            this.T8 = new Ho({
                url: J0.BR,
                data: J0.Ii,
                method: J0.oo || "post",
                async: J0.r3 ? 0 : 1,
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json; charset=utf8"
                },
                urlEncoded: 0,
                DP: J0.DP
            });
            this.T8.addEvents({
                failure: J0.cq || cq.bind(this),
                cancel: J0.cq || cq.bind(this),
                success: J0.Og || Og.bind(this),
                complete: J0.tw || tw.bind(this),
                offline: J0.vi || vi.bind(this)
            })
        },
        send: function() {
            this.T8.send()
        },
        complete: function() {
            this.parent.apply(this, arguments)
        }
    })
})();
var d5 = (function() {
    return new Class({
        Implements: [E4, Events],
        Dk: {
            Gk: {
                requestTimeout: 10000,
                requestRetries: 0
            },
            n0: function(R9) {},
            zx: function(R9) {},
            yX: function(PJ) {},
            TP: function(EI) {
                debugConsol.assert(0)
            },
            N1: function(RL) {},
            io: function() {}
        },
        v6: 0,
        initialize: function(Dk) {
            this.qQ(Dk)
        },
        R9: function(J0) {
            J0.BR = this.Dk.Gk.proxyUrl.concat(J0.vm);
            J0.DP = this.Dk.Gk.requestTimeout || 0;
            J0.MU = this.Dk.Gk.requestRetries || 0;
            if (J0.JN) {
                J0.cq = J0.wC = J0.Og = J0.tw = J0.vi = function() {}
            }
            var T8 = (new qq(J0)).addEvents({
                QP: J0.n0 || this.Dk.n0,
                IN: J0.zx || this.Dk.zx,
                ZC: J0.yX || this.Dk.yX,
                c6: J0.TP || this.Dk.TP,
                hb: J0.N1 || this.Dk.N1,
                L9: J0.io || this.Dk.io
            });
            return T8
        }
    })
})();
d5.oJ = {
    qP: function(qY) {
        return parseFloat(qY) || 0
    },
    SF: function(qY) {
        return parseInt(qY, 10) || 0
    },
    RH: function(qY) {
        return qY.split(",")
    },
    zk: function(qY) {
        return new Date(qY.substr(0, 4), qY.substr(4, 2), qY.substr(6, 2), qY.substr(8, 2), qY.substr(10, 2))
    },
    sq: function(h8, U3) {
        var vO = {},
            o3, W7 = h8.length;
        U3 = U3 || "@name";
        while (--W7 >= 0) {
            o3 = h8[W7];
            vO[o3[U3]] = o3;
            delete o3[U3]
        }
        return vO
    }
};
var wF = function(Ro, Gk) {
    Gk.enableHighAccuracy = Gk.enableHighAccuracy == "true";
    Gk.maximumAge = Gk.maximumAge || 300000;
    Gk.timeout = Gk.timeout || 600000;
    "geolocation" in navigator ? navigator.geolocation.getCurrentPosition(Ro, Ro, Gk) : Ro({
        message: "Device does not support navigator.geolocation",
        code: -1
    })
};
var md = new Class({
    initialize: function() {}
});
var SJ = (function() {
    var Gn, Gk, P8, ZX, fZ, OL, S5, y7 = (function() {
            var Xg, SN = {
                    closeGame: function() {
                        OL && OL.R9({
                            vm: "/close.action",
                            Ii: JSON.stringify(ZX.params),
                            cq: Ed,
                            wC: Ed,
                            Og: Ed,
                            vi: Ed
                        }).send()
                    },
                    requestMobileNumber: function() {
                        SW()
                    },
                    getGeoCoordinates: function() {
                        wF(eY, Gk.geoLocation)
                    },
                    insufficientFundsNotification: function() {
                        Tw.Dq()
                    }
                },
                y9 = {
                    closeGame: function() {
                        lI = 1;
                        if (window.opener) {
                            window.close()
                        } else {
                            window.location = Gk.console.lobbyURL
                        }
                    },
                    reloadGame: function() {
                        lI = 1;
                        if (ZX.params.mac) {
                            window.location = Gk.console.lobbyURL
                        } else {
                            aO.gz()
                        }
                    },
                    switchToCashPlay: function() {
                        aO.gz({
                            playMode: "real"
                        })
                    },
                    gameInProgressReload: function() {
                        lI = 1;
                        aO.gz(Xg.Param)
                    },
                    "": function() {
                        Tw.pE()
                    }
                };

            function Ed() {
                Tw.Ed(Xg)
            }
            return {
                Qk: function(HW) {
                    SN[""] = HW && function() {
                        SN[""] = void 0;
                        HW()
                    }
                },
                vn: function(l6) {
                    var hR = l6["@name"],
                        DY = {};
                    Xg = l6;
                    l6.Param && Array.sc(l6.Param).forEach(function(gA) {
                        DY[gA["@name"]] = gA["#text"]
                    });
                    l6.Param = DY;
                    (SN[hR] || Ed)()
                },
                RP: function(hR, DY) {
                    var HW = y9[hR];
                    HW ? HW(DY) : console.warn("No default handler for " + hR)
                }
            }
        })(),
        CY = function(Iy) {
            S5.lg || S5.X7();
            Iy.Reference = "";
            Iy.Buttons = Array.sc(Iy.Buttons.Button);
            Tw.Di(Iy)
        },
        zT = function(Iy) {
            aO.DM && aO.DM.p6();
            S5.lg || S5.Wm();
            Iy.Buttons = Array.sc(Iy.Buttons.Button);
            Tw.Di(Iy)
        },
        cN, bL, k9, KB, Db = function(EI) {
            bL = EI.GameLogicResponse;
            if (!k9) {
                k9 = Date.now()
            }
            cN = bL.OutcomeDetail.TransactionId;
            var wQ = 0;
            if (P8 && P8.transactiondelay && P8.gameType && P8.gameType.toUpperCase() == "S") {
                wQ = P8.transactiondelay ? P8.transactiondelay * 1000 : 0;
                wQ = Math.max(0, wQ - (Date.now() - KB))
            }
            setTimeout(function() {
                bL.OutcomeDetail.Balance = FR.Hz(bL.OutcomeDetail.Balance);
                bL.Messages = bL.Messages || [];
                if (bL.Messages.Message) {
                    bL.Messages = Array.sc(bL.Messages.Message)
                }
                GS()
            }, wQ)
        },
        GS = function() {
            var Iy = bL.Messages && bL.Messages.shift();
            S5.bL = bL;
            if (Iy) {
                y7.Qk(GS);
                CY(Iy)
            } else {
                S5.pV()
            }
        },
        n0 = function() {
            return zT({
                Message: rO("mproxy.Error.networkOffLine"),
                Buttons: {
                    Button: {
                        Text: rO("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": ""
                        }
                    }
                }
            })
        },
        zx = function(Kw) {
            return zT({
                Message: rO(Kw ? "mproxy.Error.networkError" : "mproxy.Error.connectionLost"),
                Reference: Kw ? "MGC-002-" + Kw : "MGC-001",
                Buttons: {
                    Button: {
                        Text: rO("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": Kw ? "closeGame" : "reloadGame"
                        }
                    }
                }
            })
        },
        N1 = function(R9) {
            return zT({
                Message: rO("mproxy.Error.payloadError"),
                Reference: "MGC-003",
                Buttons: {
                    Button: {
                        Text: rO("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": "closeGame"
                        }
                    }
                }
            })
        },
        yX = function(kS) {
            var HV = kS.AdditionalInfo || {};
            HV.Action = HV.Action || "";
            HV.Buttons = HV.Buttons ? HV.Buttons.split(",").map(function(I_) {
                return rO("mproxy.Buttons." + I_)
            }) : [rO("mproxy.Buttons.OK")];
            return zT({
                Message: kS.Message,
                Reference: kS.Code,
                Buttons: {
                    Button: HV.Action.split(",").map(function(hR, W7) {
                        return {
                            Text: HV.Buttons[W7] || hR,
                            Cmd: {
                                "@name": hR || "closeGame"
                            }
                        }
                    })
                }
            })
        },
        c2 = function(kS) {
            return CY({
                Message: rO("mproxy.CancelSubmitMobileNumber.message"),
                Buttons: {
                    Button: {
                        Text: rO("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": "closeGame"
                        }
                    }
                }
            })
        },
        TP = function(EI) {
            var RL = EI.Exception;
            return RL ? this.fireEvent("m6", RL) : this.fireEvent("zf", EI)
        },
        eW = function() {
            var Sg = 0,
                hl = function() {};
            return function() {
                if (!Sg) {
                    Sg = 1;
                    document.body.style.display = "none";
                    OL && OL.R9({
                        r3: 1,
                        vm: "/close.action",
                        Ii: JSON.stringify(ZX.params),
                        JN: 1
                    }).send()
                }
            }
        },
        eY = function(sb) {
            var lh = {};
            if (sb.coords) {
                lh.latitude = sb.coords.latitude.toString();
                lh.longitude = sb.coords.longitude.toString()
            }
            lh.locationstatus = (sb.code || 0).toString();
            lh.locationmessage = sb.message || "";
            q5(lh)
        },
        initResponse, kf = function(gH) {
            function tg(EI) {
                var j9 = eW();
                window.addEvents({
                    beforeunload: j9,
                    unload: j9
                });
                yV = EI;
                FR.t_(yV.CURRENCY, ZX.params.denomamount);
                yV.GameLogicResponse.OutcomeDetail.Balance = FR.Hz(yV.GameLogicResponse.OutcomeDetail.Balance);
                Tw.UJ(yV.CURRENCY, yV.GameLogicResponse)
            }
            var DY = GH.d6({
                getplayerbalance: (!!gH).toString()
            }, ZX.params);
            y7.Qk(kf);
            OL.R9({
                vm: "/initstate.action",
                Ii: JSON.stringify(DY)
            }).addEvents({
                zf: tg,
                m6: zT
            }).send()
        },
        q5 = (function() {
            var Hh = {
                requestMobileNumber: function(kS) {
                    SW(kS)
                },
                initGeoCoordinates: function(kS) {
                    Xj(kS)
                }
            };
            return function(C_) {
            
                console.log('auth');
                function Q2(PJ) {
                    var HW = PJ.AdditionalInfo && Hh[PJ.AdditionalInfo.Action] || yX;
                    HW(PJ)
                }

                function qx(EI) {
                    var j9 = eW();
                    window.addEvents({
                        beforeunload: j9,
                        unload: j9
                    });
                    Tw.QK()
                }
                fZ = fZ || M8(GH.jY(ZX.params, ["uniqueid", "nscode", "skincode", "softwareid"]));
                C_ = GH.d6(C_ || {}, ZX.params);
                y7.Qk(q5);
                OL.R9({
                    vm: "/authenticate.action",
                    Ii: JSON.stringify(C_),
                    yX: Q2
                }).addEvents({
                    zf: qx,
                    m6: zT
                }).send()
            }
        })(),
        Cv = function() {
            function ze(bM, U_, dG) {
                if (U_ && 0 > dG.indexOf(U_)) {
                    this.L8(bM)
                } else {
                    this.q6(bM)
                }
            }

            function HY(Ue, n_) {
                var bM = this.tp(),
                    wv = bM.PatternsBet;
                bM.PatternsBet = Ue;
                ze.call(this, bM, wv, n_)
            }

            function nj(Oo, bN) {
                var bM = this.tp(),
                    oY = bM.BetPerPattern && bM.BetPerPattern[FR] || 0;
                bM.BetPerPattern = bM.BetPerPattern || {};
                bM.BetPerPattern[FR] = FR.Bz(Oo);
                ze.call(this, bM, FR.Hz(oY).toString(), bN)
            }
            cN = yV.GameLogicResponse.OutcomeDetail.TransactionId;
            S5.sA(S5.JG = yV.Paytable);
            S5.HD(bL = S5.bL = yV.GameLogicResponse);
            S5.jx(S5.bL);
            yV = void 0;
            if (S5.bL.PatternSliderInput) {
                if (S5.bL.PatternSliderInput.PatternsBet) {
                    HY.call(fZ, S5.bL.PatternSliderInput.PatternsBet, S5.JG.PatternSliderInfo.PatternInfo.Step)
                }
                if (S5.bL.PatternSliderInput.BetPerPattern) {
                    nj.call(fZ, S5.bL.PatternSliderInput.BetPerPattern, S5.JG.PatternSliderInfo.BetInfo.Step)
                }
            }
            Yv.UY("progress")
        },
        SW = (function() {
            var SI, rL;
            return function(kS) {
                var bM = fZ.tp(),
                    RU = kS.Message || [
                        ["", ""]
                    ];
                rL = rL || (new Element("form")).adopt(RU.length > 1 ? (new Element("select", {
                    name: "qi"
                })).adopt(RU.length > 1 && new Element("option", {
                    value: "",
                    text: rO("mproxy.SubmitMobileNumber.labelRegionCode")
                }), RU.map(function(lb) {
                    return new Element("option", {
                        value: lb[0],
                        text: lb[1]
                    })
                })) : new Element("input", {
                    type: "hidden",
                    name: "qi",
                    value: RU[0][0]
                }), (new Element("label", {
                    text: rO("mproxy.SubmitMobileNumber.labelDeviceNumber")
                })).adopt(new Element("input", {
                    type: "tel",
                    style: "-wap-input-format: '*N';",
                    name: "s7"
                }))).addEvent("submit", function() {
                    var s7 = this.elements.s7.value,
                        qi = this.elements.qi.value,
                        bM = fZ.tp();
                    bM.deviceNumber = s7;
                    bM.regionCode = qi;
                    fZ.L8(bM);
                    window.event && window.event.preventDefault();
                    if (s7 && (qi || RU.length == 0)) {
                        SI.Bv(0);
                        OL.R9({
                            oo: "get",
                            vm: "/subdnbr.action",
                            Ii: {
                                devicenumber: s7,
                                regioncode: qi
                            }
                        }).addEvents({
                            zf: function(EI) {
                                delete EI.ReturnStatus.Code;
                                yX(EI.ReturnStatus)
                            },
                            O_: function() {
                                SI.aq(0)
                            }
                        }).send()
                    }
                });
                SI = SI || xu.FU(new xu({
                    UF: "SI",
                    OE: "AW qo"
                }).addEvents({
                    cT: rL.fireEvent.bind(rL, "submit"),
                    iM: function() {
                        SI.aq(0);
                        c2()
                    }
                }).xs({
                    iM: new TM({
                        TT: rO("mproxy.SubmitMobileNumber.buttonCancel"),
                        tY: 1
                    }),
                    cT: new TM({
                        TT: rO("mproxy.SubmitMobileNumber.buttonValidate"),
                        tY: 1
                    })
                }).ZI(new Element("h1", {
                    text: rO("mproxy.SubmitMobileNumber.title")
                }), new Element("p", {
                    text: rO("mproxy.SubmitMobileNumber.message")
                }), rL));
                document.body.grab(SI, "top");
                rL.elements.s7.value = bM.deviceNumber || "";
                rL.focus();
                if (RU.length > 1) {
                    rL.elements.qi.value = bM.regionCode || ""
                }
                return SI.Bv(1).aq(1)
            }
        })(),
        Xj = function(kS) {
            var Yb = Yb || xu.FU(new xu({
                UF: "Of",
                OE: "AW qo"
            })).ZI(kS.Message).xs({
                iM: new TM({
                    TT: rO("Game.buttonOk"),
                    tY: 1
                })
            }).addEvents({
                iM: function() {
                    Yb.toElement().destroy();
                    Yb = void 0
                }
            }).addEvents({
                iM: function() {
                    wF(eY, Gk.geoLocation)
                }
            }).aq(1);
            document.body.grab(Yb, "top")
        },
        i7 = function() {
            if (ZX.params.mac) {
                OL.R9({
                    oo: "get",
                    vm: "/valdnbr.action",
                    Ii: {
                        mac: ZX.params.mac
                    },
                    TP: function(EI) {
                        ZX.params = EI.ReturnData;
                        q5()
                    }
                }).send()
            } else {
                q5()
            }
        },
        lQ = function(Ii) {
            var wQ = 0;
            if (bL.OutcomeDetail.GameStatus && (bL.OutcomeDetail.GameStatus == "Start") && P8.transactiondelay) {
                if (k9) {
                    wQ = Math.max(0, (P8.transactiondelay * 1000) - (Date.now() - k9))
                }
                k9 = 0;
                KB = Date.now()
            }
            if (wQ) {
                setTimeout(function() {
                    cL(Ii)
                }, wQ)
            } else {
                cL(Ii)
            }
        },
        cL = (function() {
            var vm;
            return function(Ii) {
                vm = vm || "/play.action".concat(GH.zC(ZX.params, ["language", "presenttype", "channel", "freespin_tokenID", "freespin_bet", "freespin_lines", "freespin_num", "playMode"]));
                Ii.GameLogicRequest.TransactionId = cN;
                y7.Qk();
                OL.R9({
                    vm: vm,
                    Ii: JSON.stringify(Ii)
                }).addEvents({
                    zf: Db,
                    m6: zT
                }).send()
            }
        })(),
        GU = (function() {
            var vm;
            return function(KU, Ii) {
                vm = vm || "/paytable.action".concat(GH.zC(ZX.params, ["language", "presenttype", "channel"]));
                y7.Qk();
                OL.R9({
                    oo: "get",
                    vm: vm,
                    Ii: JSON.stringify(Ii)
                }).addEvents({
                    zf: KU,
                    m6: zT
                }).send()
            }
        })(),
        lI, Tw = (function() {
            var hQ, KQ, w8 = {},
                Rp;

            function R7() {
                S5.HD(S5.bL);
                S5.iT()
            }
            return {
                Uv: function(Gk, ZX) {
                    var HN, BN = +new Date;
                    hQ = document.createElement("iframe");
                    KQ = document.createElement("div");
                    KQ.id = "Tw";
                    KQ.appendChild(hQ);
                    document.body.insertBefore(KQ, document.body.lastElementChild);
                    Yv.UY("queue", 1);
                    com.igt.mxf.setMessageOrigin(hQ.contentWindow, Gk.url).addOneShotEvent("consoleInitialised", function(Gk) {
                        clearTimeout(HN);
                        console.warn("Console loaded after " + (Math.round((BN - new Date) / 10) / 100) + "s");
                        if (Gk) {
                            ZX.DY = GH.d6(ZX.params, Gk)
                        }
                        Yv.UY("progress", 1);
                        Yv.UY("console")
                    }).addEvents({
                        consoleResize: function(hS) {
                            if (KQ.style.height != hS) {
                                KQ.style.visibility = "visible";
                                KQ.style.height = hS;
                                document.body.offsetWidth;
                                nU()
                            }
                            com.igt.mxf.sendMessage("consoleResized", hS)
                        },
                        command: function(hR, DY) {
                            y7.RP(hR, DY)
                        }
                    });
                    HN = setTimeout(function() {
                        Yv.F5(window.parent, "loaderror")
                    }, Gk.timeout || 15000);
                    (function(BR) {
                        var a = document.createElement("a");
                        a.setAttribute("href", BR);
                        hQ.src = a.href + (a.search ? "&" : "?") + GH.Lw(ZX.params, Gk.urlParameterWhitelist)
                    })(Gk.url)
                },
                Dq: function() {
                    S5.bL = bL;
                    S5.Sc();
                    aO.DM && aO.DM.p6();
                    if (Rp) {
                        com.igt.mxf.addOneShotEvent("resume", function() {
                            Rp = 0;
                            S5.zH(1)
                        });
                        com.igt.mxf.enableEvents(1);
                        bL && com.igt.mxf.sendOutcome(bL);
                        com.igt.mxf.sendMessage("insufficientFundsNotification")
                    } else {
                        S5.zH(1)
                    }
                },
                Nt: function() {
                    S5.zH(0);
                    if (!Rp) {
                        Rp = 1;
                        com.igt.mxf.addOneShotEvent("wagerStarted", function() {
                            com.igt.mxf.enableEvents(0);
                            S5.B6()
                        });
                        com.igt.mxf.sendMessage("wagerIsStarting")
                    } else {
                        S5.B6()
                    }
                },
                HI: function() {
                    S5.zH(0);
                    if (!Rp) {
                        Rp = 1;
                        com.igt.mxf.addOneShotEvent("wagerStarted", function() {
                            com.igt.mxf.enableEvents(0);
                            S5.Qw()
                        });
                        com.igt.mxf.sendMessage("wagerIsStarting")
                    } else {
                        S5.Qw()
                    }
                },
                Z3: function() {
                    com.igt.mxf.addOneShotEvent("wagerComplete", function() {
                        Rp = 0;
                        S5.yY()
                    });
                    KQ.style.visibility = "";
                    com.igt.mxf.enableEvents(1);
                    com.igt.mxf.sendMessage("wagerIsComplete")
                },
                pE: function() {
                    S5.Sc();
                    aO.DM && aO.DM.p6();
                    if (Rp) {
                        com.igt.mxf.addOneShotEvent("wagerAborted", function() {
                            Rp = 0;
                            S5.zH(1)
                        });
                        com.igt.mxf.enableEvents(1);
                        com.igt.mxf.sendMessage("wagerIsAborted")
                    } else {
                        S5.zH(1)
                    }
                },
                Ed: function(l6) {
                    com.igt.mxf.addOneShotEvent("resume", function() {
                        y7.RP(l6["@name"], l6.Param)
                    });
                    com.igt.mxf.sendMessage("command", l6["@name"], l6.Param)
                },
                Di: function(Iy) {
                    com.igt.mxf.addOneShotEvent("resume", function(lM) {
                        KQ.style.visibility = "";
                        if (Iy.Buttons[lM]) {
                            y7.vn(Iy.Buttons[lM].Cmd)
                        } else {
                            Gn.KO(Iy, y7.vn).aq(1);
                            KQ.style.height = ""
                        }
                    });
                    com.igt.mxf.enableEvents(1);
                    com.igt.mxf.sendMessage("displayMessage", Iy.Id, Iy.Reference, Iy.Message, Iy.Buttons.map(function(W_) {
                        return W_.Text
                    }));
                    KQ.style.visibility = "visible";
                    KQ.style.height = 0
                },
                kK: function() {
                    if (S5.bL.OutcomeDetail.Settled != 0) {
                        com.igt.mxf.addOneShotEvent("afterGameOutcome", R7);
                        com.igt.mxf.sendOutcome(S5.bL)
                    } else {
                        R7()
                    }
                },
                QK: function() {
                    com.igt.mxf.addOneShotEvent("resume", function(K_) {
                        kf(K_)
                    });
                    com.igt.mxf.sendMessage("beforeInitGame")
                },
                UJ: function(aU, oi) {
                    com.igt.mxf.addOneShotEvent("afterGameOutcome", Cv);
                    com.igt.mxf.setCurrencyFormat({
                        config: aU,
                        toCurrency: FR.Bz,
                        format: FR.Kj
                    });
                    com.igt.mxf.sendOutcome(oi)
                },
                aq: function(RR) {
                    if (KQ) {
                        KQ.style.visibility = RR ? "" : "hidden"
                    }
                },
                wJ: function() {
                    KQ.style.visibility = "";
                    com.igt.mxf.sendMessage("gameReady")
                }
            }
        })();
    xu.P5 = function(Vd) {
        Vd.addEvents({
            kR: function() {
                Tw && Tw.aq(0)
            },
            Dh: function() {
                Tw && Tw.aq(1)
            }
        });
        return xu.FU(Vd)
    };
    return function(I0, bP, Oq, oO) {
        Gk = I0;
        P8 = Oq;
        ZX = bP;
        S5 = new md.iQ();
        if (document.querySelector("meta[name='com.igt.game.IOS9FIX'][content='yes']")) {
            var hB = new Element("div", {
                id: "game"
            });
            var ZP = new Element("div", {
                id: "ios9fix"
            });
            ZP.style.position = "absolute";
            ZP.style.top = "0";
            ZP.style.left = "0";
            ZP.style.width = "100%";
            ZP.style.height = "100%";
            ZP.style.overflow = "hidden";
            S5.rp = (ZP.adopt(hB)).inject(document.body.lastElementChild, "before");
            S5.rp = hB
        } else {
            S5.rp = (new Element("div", {
                id: "game"
            })).inject(document.body.lastElementChild, "before")
        }
        OL = new d5({
            Gk: Gk.RGS,
            n0: n0,
            zx: zx,
            yX: yX,
            TP: TP,
            N1: N1
        });
        S5.iR = xu.FU(new tc({
            UF: "iR",
            OE: "pm qo"
        }));
        document.body.grab(S5.iR, "top");
        Gn = xu.P5(new tc({
            UF: "Gn",
            OE: "AW qo",
            xp: 0
        }).addEvents({
            kR: function() {
                Yv.UY("abortLoading"), S5.iR.aq(0)
            }
        }));
        document.body.grab(Gn, "top");

        function subvertBalanceMeterForPromotionalFreeSpin(S5) {
            if (!S5.Va) {
                throw new Error("You must expose Va on the game instance")
            }
            var PS = S5.Va.pf.bind(S5.Va);
            S5.Va.Dk.Io = Math.floor;
            S5.Va.Dk.yi = Math.floor;
            S5.Va.pf = function() {
                if (S5.bL.PromotionalFreeSpin && S5.bL.PromotionalFreeSpin["@count"]) {
                    PS(S5.bL.PromotionalFreeSpin["@count"])
                }
            };
            S5.Va.Tv = function() {
                return Infinity
            };
            S5.Va.pf()
        }
        oO.AN("initialise", function Zl() {
            oO.rj("initialise", Zl);
            S5.fZ = fZ;
            if (S5.bL.PromotionalFreeSpin) {
                S5.JG.PatternSliderInfo.PatternInfo.Step = [ZX.params.freespin_lines];
                if (rO("Game.consoleBalance") === rO("Game.consoleBalance").toUpperCase()) {
                    pj.j_("Game.consoleBalance", rO("mproxy.PromotionalFreeSpin.consoleBalance").toUpperCase())
                } else {
                    pj.j_("Game.consoleBalance", rO("mproxy.PromotionalFreeSpin.consoleBalance"))
                }
            }
            S5.lg();
            S5.lg = void 0;
            if (S5.bL.PromotionalFreeSpin) {
                subvertBalanceMeterForPromotionalFreeSpin(S5)
            }
            Yv.UY("initialised");
            Tw.wJ()
        });
        oO.bj(["loaded", "console"], i7);
        Tw.Uv(Gk.console, ZX);
        S5.HI = Tw.HI;
        S5.Nt = Tw.Nt;
        S5.Z3 = Tw.Z3;
        S5.kK = Tw.kK;
        S5.b5 = Tw.aq;
        if (P8 && P8.transactiondelay && P8.gameType && P8.gameType.toUpperCase() == "S") {
            S5.cL = lQ
        } else {
            S5.cL = cL
        }
        S5.GU = GU;
        S5.zH = function(rC) {
            S5.XE(rC && !lI)
        }
    }
})();
md.oJ = d5.oJ;
/*! iScroll v5.1.3 ~ (c) 2008-2014 Matteo Spinelli ~ http://cubiq.org/license */
(function(window, document, Math) {
    var rAF = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
        window.setTimeout(callback, 1000 / 60)
    };
    var utils = (function() {
        var me = {};
        var zP = document.createElement("div").style;
        var Sv = (function() {
            var vendors = ["t", "webkitT", "MozT", "msT", "OT"],
                transform, i = 0,
                l = vendors.length;
            for (; i < l; i++) {
                transform = vendors[i] + "ransform";
                if (transform in zP) {
                    return vendors[i].substr(0, vendors[i].length - 1)
                }
            }
            return false
        })();

        function Yt(style) {
            if (Sv === false) {
                return false
            }
            if (Sv === "") {
                return style
            }
            return Sv + style.charAt(0).toUpperCase() + style.substr(1)
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
        var rK = Yt("transform");
        me.extend(me, {
            hasTransform: rK !== false,
            hasPerspective: Yt("perspective") in zP,
            hasTouch: "ontouchstart" in window,
            hasPointer: window.PointerEvent || window.MSPointerEvent,
            hasTransition: Yt("transition") in zP
        });
        me.isBadAndroid = /Android /.test(window.navigator.appVersion) && !(/Chrome\/\d/.test(window.navigator.appVersion));
        me.extend(me.style = {}, {
            transform: rK,
            transitionTimingFunction: Yt("transitionTimingFunction"),
            transitionDuration: Yt("transitionDuration"),
            transitionDelay: Yt("transitionDelay"),
            transformOrigin: Yt("transformOrigin")
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
                ev.wz = true;
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
        this.Pt = {};
        this.gC();
        this.refresh();
        this.scrollTo(this.options.startX, this.options.startY);
        this.enable()
    }
    IScroll.prototype = {
        version: "5.1.3",
        gC: function() {
            this.vQ()
        },
        destroy: function() {
            this.vQ(true);
            this.q4("destroy")
        },
        IY: function(e) {
            if (e.target != this.scroller || !this.isInTransition) {
                return
            }
            this.bH();
            if (!this.resetPosition(this.options.bounceTime)) {
                this.isInTransition = false;
                this.q4("scrollEnd")
            }
        },
        Xx: function(e) {
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
            this.bH();
            this.startTime = utils.getTime();
            if (this.options.useTransition && this.isInTransition) {
                this.isInTransition = false;
                pos = this.getComputedPosition();
                this.bu(Math.round(pos.x), Math.round(pos.y));
                this.q4("scrollEnd")
            } else {
                if (!this.options.useTransition && this.isAnimating) {
                    this.isAnimating = false;
                    this.q4("scrollEnd")
                }
            }
            this.startX = this.x;
            this.startY = this.y;
            this.absStartX = this.x;
            this.absStartY = this.y;
            this.pointX = point.pageX;
            this.pointY = point.pageY;
            this.q4("beforeScrollStart")
        },
        R4: function(e) {
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
                this.q4("scrollStart")
            }
            this.moved = true;
            this.bu(newX, newY);
            if (timestamp - this.startTime > 300) {
                this.startTime = timestamp;
                this.startX = this.x;
                this.startY = this.y
            }
        },
        Ww: function(e) {
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
                this.q4("scrollCancel");
                return
            }
            if (this.Pt.flick && duration < 200 && distanceX < 100 && distanceY < 100) {
                this.q4("flick");
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
            this.q4("scrollEnd")
        },
        QB: function() {
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
            this.q4("refresh");
            this.resetPosition()
        },
        on: function(type, fn) {
            if (!this.Pt[type]) {
                this.Pt[type] = []
            }
            this.Pt[type].push(fn)
        },
        off: function(type, fn) {
            if (!this.Pt[type]) {
                return
            }
            var index = this.Pt[type].indexOf(fn);
            if (index > -1) {
                this.Pt[type].splice(index, 1)
            }
        },
        q4: function(type) {
            if (!this.Pt[type]) {
                return
            }
            var i = 0,
                l = this.Pt[type].length;
            if (!l) {
                return
            }
            for (; i < l; i++) {
                this.Pt[type][i].apply(this, [].slice.call(arguments, 1))
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
                this.Vi(easing.style);
                this.bH(time);
                this.bu(x, y)
            } else {
                this.bn(x, y, time, easing.fn)
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
        bH: function(time) {
            time = time || 0;
            this.scrollerStyle[utils.style.transitionDuration] = time + "ms";
            if (!time && utils.isBadAndroid) {
                this.scrollerStyle[utils.style.transitionDuration] = "0.001s"
            }
        },
        Vi: function(easing) {
            this.scrollerStyle[utils.style.transitionTimingFunction] = easing
        },
        bu: function(x, y) {
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
        vQ: function(remove) {
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
        bn: function(destX, destY, duration, easingFn) {
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
                    that.bu(destX, destY);
                    if (!that.resetPosition(that.options.bounceTime)) {
                        that.q4("scrollEnd")
                    }
                    return
                }
                now = (now - startTime) / duration;
                easing = easingFn(now);
                newX = (destX - startX) * easing + startX;
                newY = (destY - startY) * easing + startY;
                that.bu(newX, newY);
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
                    this.Xx(e);
                    break;
                case "touchmove":
                case "pointermove":
                case "MSPointerMove":
                case "mousemove":
                    this.R4(e);
                    break;
                case "touchend":
                case "pointerup":
                case "MSPointerUp":
                case "mouseup":
                case "touchcancel":
                case "pointercancel":
                case "MSPointerCancel":
                case "mousecancel":
                    this.Ww(e);
                    break;
                case "orientationchange":
                case "resize":
                    this.QB();
                    break;
                case "transitionend":
                case "webkitTransitionEnd":
                case "oTransitionEnd":
                case "MSTransitionEnd":
                    this.IY(e);
                    break;
                case "wheel":
                case "DOMMouseScroll":
                case "mousewheel":
                    this.TG(e);
                    break;
                case "keydown":
                    this.cc(e);
                    break;
                case "click":
                    if (!e.wz) {
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
var w2 = (function() {
    return new Class({
        Extends: xu,
        Binds: ["HP", "GK"],
        Dk: {
            gD: 1
        },
        Rj: 0,
        initialize: function(Dk) {
            var fL;
            this.parent(Dk);
            this.xs({
                hi: new TM({
                    OE: "hi"
                }),
                oX: new TM({
                    OE: "oX"
                }),
                iM: new TM({
                    OE: "iM",
                    tY: 1
                })
            });
            this.addEvents({
                oX: this.GK,
                hi: this.HP
            });
            this.rp.adopt((new Element("div", {
                "class": "D0"
            })).adopt(this.J9, this.eI = new Element("div", {
                "class": "L1"
            }).adopt(this.WP)));
            this.yb = new IScroll(this.eI, {
                hScrollbar: false,
                vScrollbar: true,
                checkDOMChanges: false,
                hideScrollbar: false
            })
        },
        ZI: function(Iy) {
            var fy;
            this.parent(arguments);
            this.yb.scrollTo(0, 0, 0);
            setTimeout(this.yb.refresh.bind(this.yb), 200);
            return this
        },
        aq: function(RR) {
            if (RR) {
                this.Rj = 0;
                this.vH(0)
            }
            this.parent(RR)
        },
        C7: function() {
            this.parent();
            this.ZI("")
        },
        GK: function() {
            if (++this.Rj >= this.Dk.gD) {
                this.Rj = 0
            }
            this.Rj = Math.min(this.Rj, this.Dk.gD - 1);
            this.vH(this.Rj)
        },
        vH: function(X8) {
            this.fireEvent("W9", X8)
        },
        HP: function() {
            if (this.Rj <= 0) {
                this.Rj = this.Dk.gD
            }
            this.Rj = Math.max(--this.Rj, 0);
            this.vH(this.Rj)
        },
        Bv: function(NL) {
            this.J9.Bv(NL, "hi");
            this.J9.Bv(NL, "oX");
            return this
        }
    })
})();
var oZ = (function() {
    return new Class({
        Extends: Df,
        Binds: ["OD"],
        Dk: {
            OE: "kB",
            lc: "",
            yU: ""
        },
        initialize: function(Dk) {
            this.qQ(Dk);
            this.aK = (new TM({
                OE: "aE",
                TT: this.Dk.yU,
                tY: 1
            })).addEvents({
                Mk: this.OD
            });
            this.mX = new Element("div", {
                "class": "oZ"
            });
            this.pQ = new Element("div", {
                "class": "uJ"
            });
            this.rp = (new Element("div", {
                id: this.Dk.UF,
                "class": this.Dk.OE
            }).adopt(new Element("div", {
                "class": "gs"
            }).adopt(new Element("div", {
                "class": "YX",
                text: this.Dk.lc
            }), this.aK), this.mX.adopt(this.pQ)));
            this.mX.addEventListener("touchmove", function(e) {
                e.preventDefault()
            });
            this.addEvents({
                Dh: function() {
                    setTimeout(x8.wa, 0)
                }
            });
            this.yb = new IScroll(this.mX, {
                hScrollbar: false,
                vScrollbar: true,
                checkDOMChanges: false,
                hideScrollbar: false
            })
        },
        ZI: function(Iy) {
            this.pQ.innerHTML = "";
            this.pQ.adopt(arguments).children.length || this.pQ.set("html", Iy);
            setTimeout(this.yb.refresh.bind(this.yb), 200);
            return this
        },
        aq: function(toshow) {
            this.parent.apply(this, arguments);
            if (toshow) {
                this.yb.refresh()
            }
        },
        OD: function() {
            this.yb.scrollTo(0, 0, 0);
            this.aq(0)
        },
    })
})();
oZ.FU = function(s0) {
    var jb = new Element("div", {
            "class": "o7"
        }),
        Cb = (new Element("div", {
            "class": "HU",
            style: "visibility:hidden"
        })).adopt(jb, new Element("div", {
            "class": "nJ"
        }).adopt(s0));
    s0.rp = Cb;
    return s0
};
Sf = function(SD) {
    var UW = this;
    this.M2 = null;
    this.NQ = 4;
    this.PP = 0;
    this.zL = 3;
    this.Ea = 70;
    this.W0 = function() {
        var defaults = {
            b8: aO.xj.g1,
            K1: UW.JO.canvas.width / 2,
            Ih: UW.JO.canvas.height - 60,
            jA: 0,
            wf: -18,
            AE: 0.2,
            X3: 1.2,
            kP: 0,
            NN: 48,
            hZ: true
        };
        return defaults
    };
    this.Zd = new Ra({
        rp: new Element("div", {
            id: "wU"
        }),
        Io: M3,
        JH: 0,
        T6: 20
    });
    this.o1 = (new Element("div", {
        id: "yw"
    }));
    this.o1.innerHTML = rO("Game.bigWin");
    var wL = new Element("canvas", {
        id: "iH"
    });
    wL.setAttribute("width", 392);
    wL.setAttribute("height", 222);
    this.JO = wL.getContext("2d");
    this.JO.clearRect(0, 0, this.JO.canvas.width, this.JO.canvas.height);
    this.Vc = (new Element("div", {
        id: "WR",
        "class": "Tt"
    })).adopt(wL, this.o1, this.Zd);
    SD.adopt(this.Vc);
    this.Ku = new a7({
        ub: 9000
    }).addEvents({
        M9: function() {
            UW.Vc.removeClass("Tt");
            UW.sY()
        },
        k2: function() {
            UW.Vc.addClass("Tt");
            UW.p6(1)
        },
        ft: function() {
            UW.Vc.addClass("Tt");
            UW.p6(1)
        }
    });
    this.Ku.Tc = function() {
        return UW.Zd
    };
    this.sY = function() {
        this.dY();
        this.HH = tK.qW(this.sk.bind(this), this.zL)
    };
    this.dY = function() {
        if (!this.M2) {
            this.M2 = []
        }
        var dp = this.W0();
        dp.jA = (Math.random() * 10) - 5;
        this.M2.push(dp)
    };
    this.sk = function() {
        var s5 = (this.dt() === 0);
        if (s5 && this.Wf.a_) {
            this.p6(1)
        } else {
            var f0 = (++this.PP % this.NQ);
            if (this.M2.length <= this.Ea && f0 == 0) {
                this.dY()
            }
        }
        this.Ny()
    };
    this.Ny = function() {
        var mB, Q7, b8, lH, pJ, e7, hS;
        this.JO.clearRect(0, 0, this.JO.canvas.width, this.JO.canvas.height);
        this.M2.forEach(function(dp) {
            if (dp.hZ) {
                Q7 = dp.kP / dp.NN;
                mB = dp.AE + ((dp.X3 - dp.AE) * Q7);
                b8 = dp.b8;
                e7 = b8.e7 * mB;
                hS = b8.hS * mB;
                lH = dp.K1 - (e7 / 2);
                dp.K1 += dp.jA;
                pJ = dp.Ih - (hS / 2);
                dp.wf += 1.2;
                dp.Ih += dp.wf;
                UW.JO.drawImage(b8.Px, lH, pJ, e7, hS);
                if (++dp.kP >= dp.NN) {
                    dp.hZ = false
                }
            }
        })
    };
    this.p6 = function(uA) {
        if (this.M2) {
            if (this.HH) {
                tK.pW(this.HH)
            }
            delete this.M2
        }
    };
    this.dt = function() {
        var qA = this.M2.length || 0;
        return qA
    };
    return this.Ku
};
md.iQ = (function() {
    var YU = ["w01", "s01", "s02", "s03", "s04", "s05", "s06", "s07", "s08", "s09", "s10", "b01", "w02", "s11", "s12", "s13", "s14"],
        Uo = {
            YU: YU,
            tN: ["s05", "s06", "s07", "s08", "s09", "s11", "s12", "s13", "s14"].HE(),
            J6: ["w02", "s11", "s12", "s13", "s14"].HE(),
            D7: GH.zZ(YU.HE(), function() {
                return 10
            }),
            x0: [0, 3, 6, 9, 12, 1, 4, 7, 10, 13, 2, 5, 8, 11, 14],
            Yx: [0, 3, 6, 9, 12, 1, 4, 7, 10, 13, 2, 5, 8, 11, 14],
            ds: ["L0C0R0", "L0C1R0", "L0C2R0", "L0C3R0", "L0C4R0", "L0C0R1", "L0C1R1", "L0C2R1", "L0C3R1", "L0C4R1", "L0C0R2", "L0C1R2", "L0C2R2", "L0C3R2", "L0C4R2"].HE(),
            qE: ["Scatter", "Line 1", "Line 2", "Line 3", "Line 4", "Line 5", "Line 6", "Line 7", "Line 8", "Line 9"].HE(),
            VY: {
                wA: 5,
                UB: 4,
                IC: 3,
                EF: 74,
                kz: 76,
                Td: 0,
                lT: 3,
                xC: 3,
                e7: 392,
                hS: 222,
                y1: 5,
                Z9: {
                    q6: {
                        hS: 0,
                        e7: 0,
                        K5: 0,
                        FB: 0,
                        Rm: 0,
                        k_: 0,
                        rq: 0
                    }
                }
            },
            YR: [{
                Qi: "#ff0000"
            }, {
                Ui: "vJ",
                Kn: 1,
                Qi: "#B60000",
                Hw: [5, 6, 7, 8, 9],
                fB: [111, 111],
                qz: 0,
                Kv: "#fff"
            }, {
                Ui: "Gg",
                Kn: 0,
                Qi: "#7800E2",
                Hw: [4, 3, 2, 1, 0],
                fB: [37, 37],
                qz: 0,
                Kv: "#fff"
            }, {
                Ui: "OA",
                Kn: 0,
                Qi: "#FC4100",
                Hw: [14, 13, 12, 11, 10],
                fB: [184, 184],
                qz: 0
            }, {
                Ui: "D4",
                Kn: 1,
                Qi: "#FC47FC",
                Hw: [0, 6, 12, 8, 4],
                fB: [12, 12],
                qz: 0
            }, {
                Ui: "Dm",
                Kn: 1,
                Qi: "#FF00D4",
                Hw: [10, 6, 2, 8, 14],
                fB: [209, 209],
                qz: 0
            }, {
                Ui: "dJ",
                Kn: 1,
                Qi: "#00AAFF",
                Hw: [0, 1, 7, 13, 14],
                fB: [61, 161],
                qz: 0
            }, {
                Ui: "g9",
                Kn: 1,
                Qi: "#003CFF",
                Hw: [10, 11, 7, 3, 4],
                fB: [160, 62],
                qz: 0,
                Kv: "#fff"
            }, {
                Ui: "fI",
                Kn: 0,
                Qi: "#00E900",
                Hw: [9, 13, 7, 1, 5],
                fB: [86, 86],
                qz: 0
            }, {
                Ui: "hY",
                Kn: 0,
                Qi: "#FFFE00",
                Hw: [9, 3, 7, 11, 5],
                fB: [135, 135],
                qz: 0
            }]
        },
        Y3 = (function() {
            return function(s4) {
                return Uo.x0.map(function(W7, vO) {
                    return s4[Uo.Yx[vO]]
                })
            }
        }());
    Uo.Bd = Uo.YR.map(function(Rx, W7) {
        var IF = new Element("div", {
            id: Rx.Ui,
            "class": "IF"
        });
        IF.width = 30;
        IF.height = 23;
        return W7 && (new Element("div", {
            "class": "Ui"
        })).adopt(IF)
    });
    var lp;
    var Iy = 0;
    return new Class({
        Extends: md,
        Implements: Events,
        Binds: ["v_", "zd", "ey", "Vs", "vr", "MV", "zv", "yY", "p1", "iT"],
        Qu: 0,
        L_: 0,
        b2: 0,
        lg: function() {
            var UW = this,
                bM = this.fZ.tp();
            this.xg = (new oZ({
                UF: "Tl",
                OE: "OZ",
                lc: rO("Game.gameRules"),
                yU: rO("Game.buttonClose")
            })).addEvents({
                j4: function() {
                    document.body.addClass("s0");
                    tK.NR
                },
                fR: function() {
                    document.body.removeClass("s0");
                    tK.Ko
                }
            });
            com.igt.mxf.registerControl({
                type: "command",
                name: "howToPlay",
                text: rO("MenuCommand.howToPlay"),
                enabled: 1
            }).addEvent("change", this.xg.aq.bind(this.xg, 1));
            this.I4 = (new oZ({
                UF: "Cx",
                OE: "OZ",
                lc: rO("Game.payTable"),
                yU: rO("Game.buttonClose")
            })).addEvents({
                j4: function() {
                    document.body.addClass("s0");
                    tK.NR
                },
                fR: function() {
                    document.body.removeClass("s0");
                    tK.Ko
                }
            });
            com.igt.mxf.registerControl({
                type: "command",
                name: "paytable",
                text: rO("MenuCommand.payTable"),
                enabled: 1
            }).addEvent("change", this.I4.aq.bind(this.I4, 1));
            [this.xg, this.I4].forEach(function(Vd) {
                document.body.grab(oZ.FU(Vd), "top")
            }, this);
            this.W4 = new ap({
                UF: "XS"
            });
            this.B_ = new Element("span", {
                id: "HS"
            });
            this.ai = new Element("span");
            this.ai.innerHTML = rO("Game.lineWinPreText");
            this.Ox = new ks(Uo.YR, {
                VY: Uo.VY,
                Bd: Uo.Bd,
                Yx: Uo.Yx,
                PV: this.JG.PatternSliderInfo.PatternInfo.Step,
                l8: this.bL.PatternSliderInput.PatternsBet,
                Fp: "#000",
                cB: 3,
                Qo: 4,
                Uy: "round",
                ME: "round",
                yR: "#0089cc"
            });
            this.eX = (new DG({
                VY: Uo.VY,
                ro: 0,
                Fn: 25,
                fY: Uo.Yx,
                zw: {},
                WX: [0, 0, 0, 0, 0],
                S0: [1, 10, 18, 26, 34],
                Ly: new gh({
                    jE: 1200,
                    xF: 0,
                    xo: 1,
                    i8: 1,
                    H0: t9,
                    q3: yj,
                    HK: this.bL.OutcomeDetail.Stage,
                    xj: {
                        BaseGame: {
                            w01: aO.xj.Jc,
                            s01: aO.xj.Ck,
                            s02: aO.xj.RC,
                            s03: aO.xj.xX,
                            s04: aO.xj.qT,
                            s05: aO.xj.jI,
                            s06: aO.xj.D2,
                            s07: aO.xj.KK,
                            s08: aO.xj.yI,
                            s09: aO.xj.E2,
                            s10: aO.xj.bQ,
                            b01: aO.xj.zj
                        },
                        FreeSpin: {
                            w02: aO.xj.YJ,
                            s11: aO.xj.CR,
                            s12: aO.xj.ij,
                            s13: aO.xj.vl,
                            s14: aO.xj.Ey
                        }
                    },
                    OW: this.tU
                })
            })).addEvents({
                B8: this.p1.bind(this),
                TS: this.kK
            });
            this.KR = new Ra({
                rp: new Element("span"),
                Io: wM
            });
            this.fj = new Ra({
                rp: new Element("span"),
                Io: wM
            });
            com.igt.mxf.registerControl({
                type: "stake",
                name: "stake",
                text: rO("Game.consoleBet"),
                enabled: 0,
                valueText: wM(0),
                value: 0
            }).linkEvent("change", this.KR, "qt");
            this.Rz = new Ra({
                rp: new Element("span"),
                Io: wM,
                JH: this.bL.OutcomeDetail.Balance
            });
            this.FA = new Ra({
                rp: new Element("span"),
                Io: wM
            });
            this.AM = new Ra({
                rp: new Element("span"),
                JH: 0,
                Io: Math.floor
            });
            this.Bs = new Ra({
                rp: new Element("span"),
                JH: 0,
                Io: Math.floor
            });
            this.mH = new Ra({
                rp: new Element("span"),
                Io: Math.floor
            });
            this.IO = new Element("span");
            this.G_ = new Ra({
                rp: this.IO,
                Io: Math.floor
            });
            this.Va = new Ra({
                rp: new Element("span"),
                JH: this.bL.OutcomeDetail.Balance,
                T6: 20
            });
            com.igt.mxf.registerControl({
                type: "balance",
                name: "totalBalance",
                text: rO("Game.consoleBalance"),
                enabled: 1,
                valueText: M3(this.bL.OutcomeDetail.Balance),
                value: FR.Bz(this.bL.OutcomeDetail.Balance)
            }).addEvent("change", function(Ob) {
                Ob = Ob >= 0 ? Ob : 0;
                this.Va.pf(FR.Hz(Ob));
                this.bL.OutcomeDetail.Balance = this.Va.Tv();
                this.zH(1)
            }.bind(this));
            this.J9 = new Element("div", {
                id: "xp"
            });
            this.CU = (new TM({
                UF: "yG",
                tY: 0
            })).addEvents({
                Mk: this.v_,
                lN: this.zd
            });
            this.dX = new TM({
                UF: "f7",
                tY: 1
            });
            this.Ej = (new TM({
                UF: "QS",
                tY: 1
            })).addEvents({
                lN: this.zd
            });
            this.rP = (new TM({
                UF: "wj",
                tY: 1
            })).addEvents({
                lN: this.ey
            });
            this.rP.rp.Jl("opacity", "0");
            this.EA = new Element("div", {
                id: "Jb"
            });
            this.wS = new Element("div", {
                id: "wS"
            }).addEvent("touchstart", this.ey);
            this.rM = new Element("div", {
                id: "ah"
            });
            this.fS = new CC({
                UF: "Oo",
                Jt: this.JG.PatternSliderInfo.BetInfo.Step,
                yi: wM,
                Tu: rO("Game.selectorBetPerPattern"),
                sH: "bottom",
                Yw: {
                    p2: "#555",
                    lB: 0.2,
                    qk: 1
                }
            }).addEvents({
                qt: this.vr
            });
            var Wq = com.igt.mxf.registerControl({
                type: "list",
                name: "betPerPattern",
                text: rO("Game.buttonBetPerPattern"),
                enabled: 1,
                value: FR.Hz(bM.BetPerPattern[FR]).toString(),
                valueText: this.JG.PatternSliderInfo.BetInfo.Step.map(wM),
                values: this.JG.PatternSliderInfo.BetInfo.Step
            }).addEvent("change", function(Ob) {
                this.fS.pf(Ob)
            }.bind(this)).linkEvent("change", this.fS, "qt").linkEvent("enable", this.rP, "rC");
            this.I8 = new CC({
                UF: "Ue",
                Jt: this.JG.PatternSliderInfo.PatternInfo.Step,
                Tu: rO("Game.selectorPatternsBet"),
                sH: "bottom",
                Yw: {
                    p2: "#555",
                    qk: 0
                }
            }).addEvents({
                qt: this.MV
            });
            var LP = com.igt.mxf.registerControl({
                type: "list",
                name: "patternsBet",
                text: rO("Game.buttonPatternsBet"),
                enabled: 1,
                valueText: this.JG.PatternSliderInfo.PatternInfo.Step,
                values: this.JG.PatternSliderInfo.PatternInfo.Step,
                value: bM.PatternsBet
            }).addEvent("change", function(Ob) {
                this.I8.pf(Ob)
            }.bind(this)).linkEvent("change", this.I8, "qt").linkEvent("enable", this.rP, "rC");
            this.fS.pf(FR.Hz(bM.BetPerPattern[FR]).toString());
            this.I8.pf(bM.PatternsBet);
            this.KR.pf(this.eD());
            this.fj.pf(this.eD());
            this.gU = new Element("div", {
                id: "Ib"
            }).set("html", rO("Game.betPrompt"));
            this.m3 = new Element("div", {
                id: "mQ",
                "class": "ua"
            }).adopt(new Element("div", {
                id: "Ev"
            }), this.gU).addEvent("touchstart", this.ey);
            this.tA = (new Element("div", {
                id: "VR"
            })).adopt(this.B5 = (new Element("div", {
                id: "vS"
            })));
            this.ak = new Element("div", {
                id: "cm"
            });
            this.vL = new Element("div", {
                id: "Lu"
            });
            this.fP = new Element("div", {
                id: "F2"
            });
            this.rp.adopt(this.ak.adopt(new Element("div", {
                id: "QL"
            }), this.reelsContainer = new Element("div", {
                id: "hc"
            }).adopt(this.wP = new Element("div", {
                id: "wP"
            }).adopt(this.eX, this.EA.adopt(this.I8, this.fS, this.wS, new Element("div", {
                id: "VC",
                "class": "eP"
            }).adopt(this.fj, new Element("span", {
                "class": "ZF",
                text: rO("Game.consoleBet")
            })))).addEvent("touchstart", this.Vs), this.Ox, this.iR), this.J9.adopt(this.CU, this.dX, this.Ej), this.tA, this.rP, this.m3, this.W4, new Element("div", {
                id: "dj"
            }).adopt(this.rM.adopt(new Element("div", {
                id: "uu",
                "class": "eP"
            }).adopt(this.Va, new Element("span", {
                "class": "ZF",
                text: rO("Game.consoleBalance")
            })), new Element("div", {
                id: "V9",
                "class": "eP d2"
            }).adopt(this.Rz, new Element("span", {
                "class": "ZF",
                text: rO("Game.consoleWin")
            })), new Element("div", {
                id: "Jy",
                "class": "eP"
            }).adopt(this.KR, new Element("span", {
                "class": "ZF",
                text: rO("Game.consoleBet")
            })), new Element("div", {
                id: "VX",
                "class": "eP"
            }).adopt(new Element("span", {
                "class": "ac"
            }).adopt(this.mH, new Element("span", {
                text: " " + rO("Game.consoleSpinsPlayedOf") + " "
            }), this.G_), new Element("span", {
                "class": "ZF",
                text: rO("Game.consoleSpins")
            })), new Element("div", {
                id: "m9",
                "class": "eP"
            }).adopt(this.AM, new Element("span", {
                "class": "ZF",
                text: rO("Game.consoleBonusCount")
            })), new Element("div", {
                id: "Tq",
                "class": "eP"
            }).adopt(this.Bs, new Element("span", {
                "class": "ZF",
                text: rO("Game.consoleBonusRecord")
            })), new Element("div", {
                id: "Q4",
                "class": "eP d2"
            }).adopt(this.FA, new Element("span", {
                "class": "ZF",
                text: rO("Game.consoleBonus")
            })))), this.fP, this.vL), new Element("div", {
                id: "uU"
            }).adopt(new Element("div", {
                id: "yx"
            }), new Element("div", {
                id: "Sd"
            }), new Element("div", {
                id: "YM",
                text: rO("Game.rotateMessage")
            })));
            this.Lj = Sf(this.wP).addEvents({
                M9: function() {
                    aO.DM.ZU("WR")
                },
                ft: function() {
                    aO.DM.p6()
                }
            });
            this.BF();
            this.b2 = 1;
            if ((this.bL.OutcomeDetail.Stage == "FreeSpin" && this.bL.OutcomeDetail.NextStage == "BaseGame") && this.bL.FreeSpinOutcome.Countdown == "0" || (this.bL.AwardCapOutcome && this.bL.AwardCapOutcome.AwardCapExceeded == "true")) {
                this.bL.OutcomeDetail.Stage = "BaseGame"
            }
            if (this.bL.OutcomeDetail.Stage == "FreeSpin") {
                aO.DM.ZU("i_");
                document.body.addClass("eF");
                UW.W4.ZI(rO("Game.freeSpinPrompt")).b7().addClass("iV");
                UW.FA.pf(UW.bL.PrizeOutcome["FreeSpin.Total"] + UW.bL.PrizeOutcome["BaseGame.Scatter"]["@totalPay"]);
                UW.FA.rp.Jl("opacity", UW.FA.Tv() > 0 ? 1 : 0);
                this.mH.pf(this.bL.FreeSpinOutcome.Count);
                this.G_.pf(this.bL.FreeSpinOutcome.TotalAwarded);
                this.AM.pf(UW.bL.FreeSpinOutcome.Count);
                this.Bs.pf(UW.bL.PopulationOutcome.HighestNumberOfFreeSpin.Hw[0]);
                this.bL.OutcomeDetail.Stage = "FreeSpin";
                this.Ej.ju("Mk").addEvents({
                    M9: function() {
                        this.Ej.aq(1);
                        UW.J9.removeClass("ua");
                        this.rP.rC(0);
                        this.W4.rp.addClass("aq");
                        this.W4.ZI(rO("Game.freeSpinPrompt")).b7().addClass("iV")
                    }.bind(this),
                    ft: function() {
                        this.Ej.aq(0);
                        UW.J9.addClass("ua");
                        this.W4.mO().b7().removeClass("iV");
                        this.Nt()
                    }.bind(this)
                }).Xx()
            } else {
                if (this.bL.OutcomeDetail.NextStage == "FreeSpin") {
                    UW.hL.Xx()
                } else {
                    aO.DM.ZU("i_");
                    document.body.addClass("zr");
                    0 < this.Va.Tv() && this.NJ.Xx();
                    this.zH(1)
                }
            }
            var OC = this.bL.OutcomeDetail.Stage;
            this.eX.LW(this.bL.PopulationOutcome[OC + ".Reels"].Hw, OC);
            this.p5 = this.rM.getElements("div.eP");
            this.p5.each(function(eP) {
                eP.clientHeight > 35 && eP.addClass("BK")
            });
            this.GU(function(c0) {
                var UW = this,
                    e5 = [],
                    fQ = [],
                    Yj = md.oJ,
                    Xd = "gx",
                    VO = GH.zZ(Uo.YU.concat(["menu", "left", "right", "tick", "spin"]).HE(), function(W7, Zr) {
                        return '<img class="' + Zr + " " + Xd + '"/>'
                    });
                c0.Paytable.PaytableStatistics.toString = function() {
                    return rO(this["@minRTP"] == this["@maxRTP"] ? "Paytable.RTPvalue" : "Paytable.RTPrange", this).substitute(this)
                };
                VO.RTP = c0.Paytable.PaytableStatistics.toString();
                VO.awardCap = wM(FR.Hz(Yj.qP(c0.Paytable.AwardCapInfo)));
                var YO = Uo.YR.map(function(fB, lM) {
                    return fB.Hw && this.t6(11, 11, fB, lM)
                }, this.Ox);
                rO("Game.sboxPaytable").forEach(function(Mi, zh) {
                    var Iy = Elements.lL(Mi.substitute(VO)),
                        WN = (new Element("div")).adopt(Iy);
                    rn = WN.querySelector("winlinediagrams");
                    rn && rn.adopt(YO);
                    e5.push(WN)
                });
                this.I4.ZI(e5);
                rO("Game.sboxHowToPlay").forEach(function(Mi, zh) {
                    var Iy = Elements.lL(Mi.substitute(VO)),
                        WN = (new Element("div")).adopt(Iy);
                    fQ.push(WN)
                });
                this.xg.ZI(fQ)
            }.bind(this));
            this.mh();
            nU();
            setTimeout(function() {
                UW.rP.rp.Jl("opacity", "")
            }, 100)
        },
        mh: function() {
            var UW = this;
            this.bR = new Element("div", {
                id: "Cl",
                "class": "OJ"
            });
            this.Gw = new Element("div", {
                id: "cA",
                "class": "Ip"
            });
            this.uD = new Element("div", {
                id: "K2",
                "class": "eO"
            }).adopt(this.bR, this.Gw);
            this.Ws = new Element("div", {
                id: "iY",
                "class": "OJ"
            });
            this.Sm = new Element("div", {
                id: "hX",
                "class": "Ip"
            });
            this.nr = new Element("div", {
                id: "rk",
                "class": "eO"
            }).adopt(this.Ws, this.Sm);
            this.iw = new TM({
                UF: "Ot",
                tY: 1
            }).addEvents({
                Mk: function() {
                    aO.DM.p6();
                    UW.bL.OutcomeDetail.Stage == "BaseGame" && UW.bL.OutcomeDetail.NextStage == "FreeSpin" ? UW.qK.Ww() : UW.xy.Ww()
                }
            });
            this.vL.adopt(new Element("div", {
                id: "uW"
            }), this.uD, this.nr, this.iw)
        },
        IA: function(vN, Fj) {
            this.Gw.set("html", vN);
            this.Sm.set("html", Fj)
        },
        BF: function() {
            var UW = this,
                yK = function() {
                    return UW.bL.PrizeOutcome[UW.ix + ".Lines"]["@totalPay"] + UW.bL.PrizeOutcome[UW.ix + ".Scatter"]["@totalPay"]
                },
                XQ = function(Iy, Qi) {
                    UW.W4.Pb();
                    UW.W4.Jl("color", Qi || "#fff").u2(Iy);
                    UW.W4.rp.addClass("aq")
                },
                a6 = function(Iy, Qi) {
                    UW.W4.mO();
                    UW.W4.xU("color", Qi || "").iz(Iy || "");
                    UW.W4.rp.addClass("aq")
                },
                oA = function(Iy, Qi) {
                    UW.W4.mO();
                    UW.W4.vW("color", Qi || "").Lg(Iy || "");
                    UW.W4.rp.addClass("aq")
                },
                Wp = function() {
                    UW.vL.removeClass("IV").removeClass("Ng").removeClass("vj").removeClass("QD");
                    document.body.addClass("eF");
                    document.body.removeClass("Dc");
                    UW.p5 = UW.rM.getElements("div.eP");
                    UW.p5.each(function(eP) {
                        eP.clientHeight > 35 && eP.addClass("BK")
                    });
                    document.body.offsetWidth;
                    UW.eX.LW(UW.bL.PopulationOutcome[UW.bL.OutcomeDetail.NextStage + ".Reels"].Hw, UW.bL.OutcomeDetail.NextStage);
                    UW.mH.pf(UW.bL.FreeSpinOutcome.Count);
                    UW.G_.pf(UW.bL.FreeSpinOutcome.TotalAwarded);
                    UW.AM.pf(UW.bL.FreeSpinOutcome.Count);
                    UW.Bs.pf(UW.bL.PopulationOutcome.HighestNumberOfFreeSpin.Hw[0]);
                    $$(".eX .M0").Jl("background-position-x", "");
                    UW.ix = UW.bL.OutcomeDetail.NextStage
                },
                Y9 = function(Ob) {
                    UW.Rz.pf(Ob);
                    UW.Rz.rp.Jl("opacity", 1)
                },
                gf = new Ud((new a7({
                    ub: 600
                })).addEvents({
                    M9: function() {
                        var Ym;
                        if (UW.bL.OutcomeDetail.Stage == "BaseGame") {
                            Ym = UW.bL.PrizeOutcome[UW.ix + ".Lines"].Prize.concat(UW.bL.PrizeOutcome[UW.ix + ".Scatter"].Prize)
                        } else {
                            Ym = UW.bL.PrizeOutcome[UW.ix + ".Lines"].Prize
                        }
                        UW.Ox.SS(Ym).AR(1)
                    },
                    k2: function() {
                        UW.Ox.AR(0)
                    }
                }), function() {
                    return UW.bL.PrizeOutcome[UW.ix + ".Lines"].Prize.concat(UW.bL.PrizeOutcome[UW.ix + ".Scatter"].Prize).length > 0
                }),
                jC = new wG(null, {
                    CQ: "backgroundPositionX",
                    LZ: Array.TC(1, 10, 10, -Uo.VY.kz),
                    Wt: "px",
                    e0: 100
                }).addEvents({
                    M9: function() {
                        this.Q9 = 1;
                        aO.DM.ZU("BL");
                        var Xc = UW.bL.PrizeOutcome[UW.ix + ".Scatter"],
                            z5 = UW.bL.PrizeOutcome[UW.ix + ".Lines"],
                            ND = Xc.z1.concat(z5.z1);
                        tS = UW.eX.p3(ND.filter(function(W7) {
                            return "b01" == UW.bL.PopulationOutcome[UW.ix + ".Reels"].Hw[W7]
                        }));
                        Wg = UW.eX.p3([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]);
                        Wg.Jl("opacity", "0.4");
                        tS.Jl("opacity", "");
                        this.rY(tS)
                    },
                    ft: function() {
                        tS.Jl("background-position-x", "")
                    },
                    k2: function() {
                        tS.Jl("background-position-x", "")
                    }
                }),
                AQ = UW.AQ = (function() {
                    var Ym = [],
                        JF, Qb = 0,
                        H7 = [],
                        Sp = UW.eX.toElement();
                    return (new wG(null, {
                        CQ: "backgroundPositionX",
                        LZ: Array.TC(1, 10, 10, -Uo.VY.kz).concat(0),
                        Wt: "px",
                        e0: 150
                    })).addEvents({
                        M9: function(Ku) {
                            var tS, Xc = UW.bL.PrizeOutcome[UW.ix + ".Scatter"],
                                z5 = UW.bL.PrizeOutcome[UW.ix + ".Lines"];
                            H7 = UW.bL.PopulationOutcome[UW.ix + ".Reels"].Hw;
                            Ku.Qb = 1;
                            if (UW.bL.OutcomeDetail.Stage.match(/^BaseGame/) && UW.bL.OutcomeDetail.NextStage == "FreeSpin") {
                                tS = Xc.QW.concat(z5.QW);
                                Ym = []
                            } else {
                                tS = Xc.z1.concat(z5.z1);
                                Ym = (UW.ix == "BaseGame") ? Xc.Prize.concat(z5.Prize) : z5.Prize
                            }
                            Ym.sort(function(aI, fp) {
                                return aI["@totalPay"] == 0 ? 1 : fp["@totalPay"] == 0 ? -1 : fp["@totalPay"] - aI["@totalPay"] || aI.dN - fp.dN
                            });
                            JF = 0;
                            this.DD(Ym.length);
                            this.fireEvent("cj")
                        },
                        hy: function(Ku, hP) {
                            JF.J7.Jl("opacity", hP > 9 ? "" : (hP % 4) < 2 ? "" : 0.5)
                        },
                        cj: function(Ku, Q9) {
                            $$(".eX .M0").Jl("opacity", "");
                            JF && UW.Ox.AR(0);
                            JF = Ym.shift();
                            if (JF) {
                                var Ql = JF["@payName"].split(" ")[1];
                                JF.Dd = UW.eX.p3(JF.ND.filter(function(W7) {
                                    return !(H7[W7] in Uo.tN) && (Ql != "w01") && (Ql != "w02")
                                }));
                                this.rY(JF.Dd);
                                UW.Ox.qB(JF).AR(1)
                            }
                            nW = UW.bL.OutcomeDetail.Stage == "FreeSpin" && UW.bL.OutcomeDetail.NextStage == "BaseGame";
                            var AC = JF["@totalPay"] + ((JF.dN == 0 && nW) && UW.bL.PrizeOutcome["FreeSpin.Total"]);
                            var Iy = vF(JF.dN ? "Game.lineWinPostText" : nW ? "Game.freeSpinWin" : "Game.scatterWin", wM(AC), "");
                            a6(Iy);
                            if (JF.dN) {
                                UW.B_.set("text", JF.dN).Jl("background-color", Uo.YR[JF.dN].Qi).Jl("color", Uo.YR[JF.dN].Kv || "#000");
                                UW.W4.Kn.grab(UW.B_, "top");
                                UW.W4.Kn.grab(UW.ai, "top")
                            }
                            JF.J7 = UW.eX.p3(JF.ND.filter(function(W7) {
                                return (H7[W7] in Uo.tN)
                            }));
                            JF.Uh = UW.eX.p3(JF.ND.filter(function(W7) {
                                return (H7[W7] == "w02")
                            }));
                            JF.Uh.Jl("backgroundPositionY", "-74px");
                            UW.AQ.Qb++
                        },
                        ft: function() {
                            $$(".eX .M0").Jl("opacity", "");
                            $$(".eX .M0").Jl("backgroundPositionY", "0px");
                            if (JF && (UW.bL.OutcomeDetail.NextStage == "FreeSpin" || nW)) {
                                JF["@name"] != "Scatter" && UW.Ox.AR(0)
                            }
                            a6()
                        },
                        k2: function() {
                            $$(".eX .M0").Jl("opacity", "");
                            a6()
                        },
                        xd: function() {
                            $$(".eX .M0").Jl("opacity", "");
                            $$(".eX .M0").Jl("backgroundPositionY", "0px");
                            JF && UW.Ox.AR(0);
                            Ym = 0
                        }
                    })
                }()),
                hG = (new Ud((new a7({
                    ub: 4000
                })).addEvents({
                    M9: function() {
                        var A6 = vF("Game.capFreeSpin", UW.bL.FreeSpinOutcome.TotalAwarded, UW.bL.FreeSpinOutcome.Awarded == "0" ? rO("Game.capFreeSpinNo") : UW.bL.FreeSpinOutcome.Awarded);
                        UW.iR.ZI(A6).aq(1);
                        UW.J9.addClass("ua")
                    },
                    ft: function() {
                        UW.iR.aq(0)
                    }
                }), function() {
                    return UW.bL.FreeSpinOutcome.IncrementTriggered == "true" && UW.bL.FreeSpinOutcome.MaxAwarded == "true"
                })),
                WO = new O7(new YK(new fz(UW.fP, "animationend")).addEvents({
                    M9: function() {
                        UW.wP.Jl("opacity", "0.4");
                        UW.fP.addClass("ed")
                    },
                    ft: function() {
                        UW.fP.removeClass("ed")
                    }
                }), new YK(new fz(UW.IO, "animationend")).addEvents({
                    M9: function() {
                        UW.G_.pf(UW.bL.FreeSpinOutcome.TotalAwarded);
                        UW.IO.addClass("fv")
                    },
                    ft: function() {
                        UW.IO.removeClass("fv");
                        UW.wP.Jl("opacity", "")
                    }
                })),
                u9 = new Ud(WO, function() {
                    return UW.bL.AwardCapOutcome.AwardCapExceeded != "true" && UW.bL.FreeSpinOutcome.IncrementTriggered == "true" && UW.bL.FreeSpinOutcome.MaxAwarded != "true"
                });
            Lj = UW.Lj, hI = this.hI = UW.Lj.Tc(), X2 = hI.q2().addEvents({
                ft: function() {
                    hI.pf(UW.bL.PrizeOutcome["Game.Total"])
                }
            });
            nk = this.Lj = new Ud(new WF(UW.Lj, new a7({
                ub: 8000
            })).addEvents({
                M9: function() {
                    UW.rP.rC(0);
                    UW.J9.removeClass("ua");
                    UW.CU.aq(0);
                    UW.dX.aq(1);
                    if (jD.Af == "MG") {
                        hI.pf(UW.bL.PrizeOutcome["Game.Total"])
                    } else {
                        hI.pf(0);
                        hI.Ee(UW.bL.PrizeOutcome["Game.Total"], UW.bL.PatternSliderInput.BetPerPattern * UW.bL.PatternSliderInput.PatternsBet)
                    }
                    X2.Xx()
                },
                ft: function() {
                    Y9(UW.bL.PrizeOutcome["Game.Total"]);
                    UW.rP.rC(0 < UW.Va.Tv());
                    UW.rP.rp.Jl("display", "");
                    UW.CU.aq(1);
                    UW.dX.aq(0);
                    aO.DM.p6()
                },
                k2: function() {
                    Y9(UW.bL.PrizeOutcome["Game.Total"]);
                    UW.rP.rC(0 < UW.Va.Tv());
                    UW.rP.rp.Jl("display", "");
                    UW.CU.aq(1);
                    UW.dX.aq(0);
                    aO.DM.p6()
                }
            }), function() {
                return UW.bL.AwardCapOutcome.AwardCapExceeded != "true" && UW.bL.OutcomeDetail.Payout >= UW.bL.OutcomeDetail.Settled * 10 && UW.bL.OutcomeDetail.Settled > 0 && UW.ix === "BaseGame"
            }), aQ = new O7(gf, UW.AQ).addEvents({
                M9: function() {
                    this.Q9 = UW.ix == "BaseGame" ? Infinity : 1;
                    if (UW.ix == "BaseGame") {
                        var Xc = UW.bL.PrizeOutcome[UW.ix + ".Scatter"],
                            z5 = UW.bL.PrizeOutcome[UW.ix + ".Lines"],
                            PK = {
                                s01: "vT",
                                s02: "qH",
                                s03: "Iz",
                                s04: "Dx",
                                s05: "U0",
                                s06: "U0",
                                s07: "U0",
                                s08: "U0",
                                s09: "U0",
                                s10: "rx",
                                w01: "Ml"
                            };
                        var Ld = Xc.Prize.concat(z5.Prize);
                        Ld.sort(function(aI, fp) {
                            return aI["@totalPay"] == 0 ? 1 : fp["@totalPay"] == 0 ? -1 : fp["@totalPay"] - aI["@totalPay"] || aI.dN - fp.dN
                        });
                        var yD = Ld[0]["@payName"].split(" ")[1],
                            Jd = "";
                        if (PK[yD]) {
                            Jd = PK[yD]
                        }
                        Jd != "" && (aO.DM.ZU(Jd))
                    }
                }
            }), rm = new Ud(aQ.addEvents({
                M9: function() {
                    var rh = UW.eD(),
                        gl = UW.bL.PrizeOutcome["Game.Total"],
                        uK = "xK",
                        Xc = UW.bL.PrizeOutcome[UW.ix + ".Scatter"],
                        z5 = UW.bL.PrizeOutcome[UW.ix + ".Lines"],
                        ND = Xc.z1.concat(z5.z1),
                        VJ = ND.filter(function(W7) {
                            return "w01" == UW.bL.PopulationOutcome[UW.ix + ".Reels"].Hw[W7]
                        });
                    if (UW.bL.OutcomeDetail.Stage == "BaseGame" && UW.ix == "BaseGame" || UW.bL.OutcomeDetail.Stage == "FreeSpin" && UW.ix == "BaseGame") {
                        UW.Z3()
                    } else {
                        UW.J9.removeClass("ua");
                        UW.dX.aq(1);
                        UW.CU.aq(0)
                    }
                },
                k2: function() {
                    UW.W4.i5("");
                    UW.AQ.fireEvent("xd");
                    if (UW.ix == "BaseGame") {
                        aO.DM.p6()
                    } else {
                        UW.J9.addClass("ua");
                        UW.dX.aq(0)
                    }
                },
                ft: function() {
                    UW.W4.i5("");
                    UW.AQ.fireEvent("xd");
                    if (UW.bL.OutcomeDetail.Stage == "BaseGame" && UW.ix == "BaseGame") {
                        aO.DM.p6()
                    } else {
                        UW.J9.addClass("ua");
                        UW.dX.aq(0)
                    }
                }
            }), function() {
                var R6 = UW.bL.OutcomeDetail.Stage == "FreeSpin" && UW.ix == "BaseGame";
                return UW.bL.AwardCapOutcome.AwardCapExceeded == "false" && (yK() || (UW.bL.PrizeOutcome["FreeSpin.Total"] && R6))
            }), BM = new Ud((UW.iR.ju("Dh")).addEvents({
                M9: function() {
                    aO.DM.p6();
                    UW.wP.Jl("z-index", "1");
                    UW.iR.ZI(vF("Game.capAward", wM(UW.bL.PrizeOutcome["Game.Total"]))).KF("iM", new TM({
                        TT: rO("Game.buttonOk"),
                        tY: 1
                    })).aq(1)
                },
                ft: function() {
                    UW.wP.Jl("z-index", "");
                    UW.Z3()
                }
            }), function() {
                return UW.bL.AwardCapOutcome.AwardCapExceeded == "true"
            }), ww = (new WF(rm, new a7({
                ub: 1000
            }))).addEvents({
                M9: function() {
                    UW.G_.pf(UW.bL.FreeSpinOutcome.TotalAwarded);
                    UW.mH.pf(UW.bL.FreeSpinOutcome.Count);
                    UW.AM.pf(UW.bL.FreeSpinOutcome.Count);
                    UW.Bs.pf(UW.bL.PopulationOutcome.HighestNumberOfFreeSpin.Hw[0]);
                    var Us = UW.bL.PrizeOutcome["FreeSpin.Total"];
                    if (UW.bL.AwardCapOutcome.AwardCapExceeded != "true") {
                        Us += UW.bL.PrizeOutcome["BaseGame.Scatter"]["@totalPay"]
                    }
                    UW.FA.pf(Us);
                    UW.FA.rp.Jl("opacity", UW.FA.Tv() > 0 ? 1 : 0)
                },
                ft: function() {
                    UW.W4.Pb().KT("display", "")
                }
            }), Ye = new Ud((new wG(null, {
                CQ: "backgroundPositionX",
                LZ: Array.TC(1, 10, 10, -Uo.VY.kz),
                Wt: "px",
                e0: 150,
                Q9: 1
            })).addEvents({
                M9: function() {
                    var Xc = UW.bL.PrizeOutcome[UW.ix + ".Scatter"],
                        z5 = UW.bL.PrizeOutcome[UW.ix + ".Lines"],
                        H7 = UW.bL.PopulationOutcome[UW.ix + ".Reels"].Hw,
                        ND = Xc.z1.concat(z5.z1),
                        tS;
                    tS = UW.eX.p3(ND.filter(function(W7) {
                        return H7[W7] in Uo.J6
                    }));
                    this.rY(tS)
                }
            }), function() {
                return UW.bL.AwardCapOutcome.AwardCapExceeded != "true" && yK()
            }), this.aN = (new O7(nk, BM, rm)).addEvents({
                M9: function() {
                    var gl = UW.bL.PrizeOutcome["Game.Total"],
                        WR = UW.bL.AwardCapOutcome.AwardCapExceeded != "true" && UW.bL.OutcomeDetail.Payout >= UW.bL.OutcomeDetail.Settled * 10 && UW.bL.OutcomeDetail.Settled > 0 && UW.ix === "BaseGame";
                    if (gl) {
                        !WR && Y9(gl)
                    } else {
                        UW.Z3()
                    }
                }
            });
            this.ww = (new O7(hG, Ye, u9, ww)).addEvents({
                M9: function() {
                    if (UW.bL.AwardCapOutcome.AwardCapExceeded == "false" && yK()) {
                        oA(vF("Game.bonusWin", wM(yK())));
                        a6()
                    }
                },
                ft: function() {
                    UW.dX.aq(0);
                    UW.J9.addClass("ua");
                    UW.bL.OutcomeDetail.NextStage == "FreeSpin" && UW.yY()
                }
            });
            this.dX.addEvent("Mk", function() {
                UW.bL.OutcomeDetail.Stage == "FreeSpin" && UW.ix == "FreeSpin" ? rm.Ww() : nk.Ww()
            });
            this.qK = (new O7(new a7({
                ub: 6000
            }).addEvents({
                M9: function() {
                    UW.IA(rO("Game.transition1Him"), rO("Game.transition1Her"));
                    UW.vL.addClass("IV");
                    aO.DM.ZU("Tk")
                }
            }), new a7({
                ub: 5000
            }).addEvents({
                M9: function() {
                    UW.IA(rO("Game.transition2Him"), "");
                    UW.vL.removeClass("IV").addClass("Ng");
                    aO.DM.ZU("Bb")
                }
            }), new a7({
                ub: 11000
            }).addEvents({
                M9: function() {
                    UW.IA("", rO("Game.transition3Her"));
                    UW.vL.removeClass("Ng").addClass("vj");
                    aO.DM.ZU("cW")
                }
            }), new a7({
                ub: 6000
            }).addEvents({
                M9: function() {
                    UW.IA(rO("Game.transition4Him"), "");
                    UW.vL.removeClass("vj").addClass("QD");
                    aO.DM.ZU("vC")
                }
            })).addEvents({
                M9: function() {
                    UW.iw.rC(1);
                    UW.AM.pf("");
                    UW.Bs.pf(UW.bL.PopulationOutcome.HighestNumberOfFreeSpin.Hw[0]);
                    UW.FA.pf(UW.bL.PrizeOutcome["BaseGame.Scatter"]["@totalPay"]);
                    UW.FA.rp.Jl("opacity", UW.FA.Tv() > 0 ? 1 : 0);
                    document.body.addClass("Dc");
                    document.body.removeClass("zr")
                },
                ft: function() {
                    Wp()
                },
                k2: function() {
                    Wp()
                }
            }));
            this.xy = (new O7(new a7({
                ub: 4000
            }).addEvents({
                M9: function() {
                    UW.IA("", rO("Game.transition5Her"));
                    UW.vL.addClass("jt");
                    aO.DM.ZU("uq")
                }
            }), new a7({
                ub: 2000
            }).addEvents({
                M9: function() {
                    UW.IA(rO("Game.transition6Him"), "");
                    UW.vL.removeClass("jt").addClass("m_");
                    aO.DM.ZU("WY")
                }
            }), new a7({
                ub: 6000
            }).addEvents({
                M9: function() {
                    UW.IA(rO("Game.transition7Him"), rO("Game.transition7Her"));
                    UW.vL.removeClass("m_").addClass("Cp");
                    aO.DM.ZU("V0")
                }
            })).addEvents({
                M9: function() {
                    document.body.addClass("Dc");
                    document.body.removeClass("eF")
                }
            }));
            this.cw = (new O7(new a7({
                ub: 4000
            }).addEvents({
                M9: function() {
                    UW.iw.rC(0);
                    if (UW.bL.PrizeOutcome["FreeSpin.Total"] > 0) {
                        var Us = UW.bL.PrizeOutcome["FreeSpin.Total"];
                        if (UW.bL.AwardCapOutcome.AwardCapExceeded != "true") {
                            Us += UW.bL.PrizeOutcome["BaseGame.Scatter"]["@totalPay"]
                        }
                        UW.IA(vF("Game.bonusCompleteWin", wM(Us)), "");
                        aO.DM.ZU("TH")
                    } else {
                        UW.IA(rO("Game.bonusComplete"), "")
                    }
                    UW.vL.addClass("Or")
                }
            })).addEvents({
                M9: function() {
                    UW.vL.removeClass("jt").removeClass("m_").removeClass("Cp")
                },
                ft: function() {
                    UW.vL.removeClass("Or");
                    document.body.removeClass("Dc");
                    document.body.addClass("zr");
                    document.body.offsetWidth;
                    UW.eX.LW(UW.bL.PopulationOutcome[UW.bL.OutcomeDetail.NextStage + ".Reels"].Hw, UW.bL.OutcomeDetail.NextStage);
                    $$(".eX .M0").Jl("background-position-x", "");
                    UW.ix = UW.bL.OutcomeDetail.NextStage;
                    UW.W4.mO("");
                    UW.W4.rp.removeClass("aq")
                }
            }));
            this.hL = (new O7(jC, UW.Ej.ju("Mk").addEvents({
                M9: function() {
                    UW.CU.aq(0);
                    UW.Ej.aq(1);
                    UW.J9.removeClass("ua");
                    UW.rP.rC(0);
                    UW.W4.rp.addClass("aq");
                    UW.W4.ZI(rO("Game.freeSpinPrompt")).b7().addClass("iV")
                }.bind(this),
                ft: function() {
                    UW.Ej.aq(0);
                    UW.J9.addClass("ua");
                    UW.W4.mO().b7().removeClass("iV");
                    $$(".eX .M0").Jl("opacity", "")
                }
            }), this.qK, new a7({
                ub: 500
            })).addEvents({
                M9: function() {},
                ft: function() {
                    UW.Nt()
                }
            }));
            this.sL = (new O7(new a7({
                ub: 1150
            }))).addEvents({
                ft: function() {
                    UW.yY()
                }
            });
            this.F_ = (new O7(this.ww, new a7({
                ub: 1150
            }).addEvents({
                M9: function() {
                    UW.dX.aq(0);
                    UW.CU.aq(0)
                }
            }), this.xy, this.cw, this.aN).addEvents({
                k2: function() {
                    UW.rP.rC(0 < UW.Va.Tv());
                    UW.rP.rp.Jl("display", "");
                    UW.dX.aq(0);
                    UW.yY()
                },
                ft: function() {
                    UW.rP.rC(0 < UW.Va.Tv());
                    UW.rP.rp.Jl("display", "");
                    UW.dX.aq(0);
                    UW.yY()
                }
            }));
            this.kX = new wG(this.B5, {
                CQ: "backgroundPositionX",
                LZ: Array.TC(1, 9, 9, -65),
                Wt: "px",
                Q9: 0,
                e0: 30,
                ub: 1500
            }).addEvents({
                ib: function() {
                    UW.tA.style.visibility = "visible"
                },
                k2: function() {
                    UW.tA.style.visibility = ""
                }
            });
            this.NJ = new Ud(new a7({
                ub: 500
            }).addEvents({
                M9: function() {
                    !UW.aj() && UW.iR.rp.addClass("o6")
                },
                ib: function() {
                    UW.m3.removeClass("ua")
                }
            }), function() {
                return !UW.bL.PromotionalFreeSpin && UW.Va.Tv() > 0
            })
        },
        sA: function(dc) {
            GH.FV(dc.PatternSliderInfo, function(X5) {
                X5.Step = Array.sc(X5.Step).map(function(o3) {
                    return o3
                })
            });
            this.JG = dc;
            this.tU = {};
            dc.StripInfo.forEach(function(xw) {
                this.tU[xw["@name"]] = [];
                xw.Strip.forEach(function(NZ) {
                    var MT = NZ["#text"].split(",");
                    this.tU[xw["@name"]].push(MT)
                }, this)
            }, this)
        },
        jx: function(c0) {
            c0.PopulationOutcome = md.oJ.sq(Array.sc(c0.PopulationOutcome).map(function(cJ) {
                cJ.Hw = Y3(cJ["#text"].split(","));
                delete cJ["#text"];
                return cJ
            }))
        },
        HD: function(c0) {
            var Yj = md.oJ;
            c0.PrizeOutcome = Yj.sq(Array.sc(c0.PrizeOutcome));
            ["BaseGame.Lines", "FreeSpin.Lines", "BaseGame.Scatter", "FreeSpin.Scatter"].forEach(function(U3) {
                c0.PrizeOutcome[U3] = c0.PrizeOutcome[U3] || {}
            });
            GH.FV(c0.PrizeOutcome, function(oi) {
                oi["@totalPay"] = Yj.qP(oi["@totalPay"]);
                oi.z1 = [];
                oi.WV = {};
                oi.Prize = Array.sc(oi.Prize).map(function(sv) {
                    oi.WV[sv["@name"]] = sv.ND = [];
                    sv["@totalPay"] = Yj.qP(sv["@totalPay"]);
                    sv.dN = Uo.qE[sv["@name"]] || 0;
                    sv.tV = Uo.YR[sv.dN];
                    return sv
                })
            });
            Array.sc(c0.HighlightOutcome).forEach(function(oi) {
                var GJ = c0.PrizeOutcome[oi["@name"]];
                GJ && Array.sc(oi.Highlight).forEach(function(bK) {
                    var H3 = GJ && GJ.WV[bK["@name"]];
                    if (H3) {
                        [].push.apply(H3, bK["#text"].split(",").P3(Uo.ds));
                        GJ.z1.combine(H3)
                    }
                })
            });
            delete c0.HighlightOutcome;
            c0.OutcomeDetail.Balance = Yj.qP(c0.OutcomeDetail.Balance);
            c0.OutcomeDetail.Payout = Yj.qP(c0.OutcomeDetail.Payout);
            if (c0.FreeSpinOutcome) {
                c0.FreeSpinOutcome.Count = Yj.SF(c0.FreeSpinOutcome.Count);
                c0.FreeSpinOutcome.TotalAwarded = Yj.SF(c0.FreeSpinOutcome.TotalAwarded)
            }
            if (c0.PrizeOutcome["Game.Total"]) {
                GJ = c0.PrizeOutcome;
                GJ["Game.Total"] = GJ["Game.Total"]["@totalPay"];
                if (GJ["FreeSpin.Total"]) {
                    GJ["FreeSpin.Total"] = c0.AwardCapOutcome && c0.AwardCapOutcome.AwardCapExceeded == "true" ? GJ["Game.Total"] : GJ["FreeSpin.Total"]["@totalPay"]
                }
            }
            this.ix = c0.OutcomeDetail.Stage;
            return c0
        },
        zd: function() {
            this.NJ.Ww();
            this.m3.Jl("visibility", "hidden");
            this.iR.rp.removeClass("o6")
        },
        v_: function() {
            rm.Ww();
            this.Rz.rp.Jl("opacity", "");
            this.EA.removeClass("Er");
            lp = clearInterval(lp);
            this.J9.addClass("ua");
            this.rP.rC(0);
            this.rP.rp.Jl("display", "");
            this.W4.Pb().KT("display", "");
            this.Ox.AR(0);
            this.fS.aq(0);
            this.HI();
            nU()
        },
        XE: function(rC) {
            var Yn = rC && this.bL.OutcomeDetail.NextStage == "BaseGame",
                aj = this.aj();
            this.CU.rC(rC && aj);
            if (rC) {
                this.CU.aq(aj);
                aj ? this.J9.removeClass("ua") : this.J9.addClass("ua")
            }
            Yn && this.Va.pf(this.bL.OutcomeDetail.Balance);
            this.rP.rC(Yn && 0 < this.Va.Tv());
            rC || this.kX.Ww()
        },
        aj: function() {
            var zy = this.bL.OutcomeDetail.NextStage != "BaseGame" || 0 <= FR.Bz(this.bL.OutcomeDetail.Balance - this.eD());
            zy || this.iR.ZI(rO("Error.insufficientFunds"));
            this.iR.aq(!zy);
            return zy
        },
        zv: function() {
            if (this.bL.OutcomeDetail.NextStage == "BaseGame") {
                this.W4.rp.removeClass("aq");
                this.Va.pf(Math.max(0, this.Va.Tv() - this.eD()))
            } else {
                this.W4.iz(vF("Game.freeSpinLines", this.I8.Tv()));
                this.W4.Lg(vF("Game.freeSpinCoinValue", wM(this.fS.Tv())));
                var oL = (this.bL.FreeSpinOutcome.Count == this.bL.PopulationOutcome.HighestNumberOfFreeSpin.Hw[0]),
                    mm = this.bL.FreeSpinOutcome.Count + 1;
                if (mm > 100) {
                    mm = 100
                }
                this.mH.pf(mm);
                this.AM.pf(mm);
                if (oL) {
                    this.Bs.pf(mm)
                }
                this.W4.rp.addClass("aq")
            }
            this.eX.zv()
        },
        Qw: function() {
            this.zH(0);
            if (!aO.DM.Tg("v3") && !aO.DM.Tg("jy")) {
                aO.DM.ZU(this.bL.OutcomeDetail.NextStage == "BaseGame" ? "v3" : "jy", Infinity)
            }
            setTimeout(this.zv, 0)
        },
        p1: function() {
            this.kX.Xx();
            this.cL({
                GameLogicRequest: {
                    TransactionId: this.bL.OutcomeDetail.TransactionId,
                    ActionInput: {
                        Action: "play"
                    },
                    PatternSliderInput: {
                        BetPerPattern: this.fS.Tv(),
                        PatternsBet: this.I8.Tv()
                    }
                }
            })
        },
        pV: function() {
            this.jx(this.bL);
            this.kX.Ww();
            this.eX.xZ(this.bL.PopulationOutcome[this.bL.OutcomeDetail.Stage + ".Reels"].Hw)
        },
        eD: function() {
            return this.fS.Tv() * this.I8.Tv()
        },
        X7: function() {
            this.kX && this.kX.Ww();
            this.Va.pf(this.bL.OutcomeDetail.Balance - this.bL.OutcomeDetail.Payout)
        },
        Wm: function() {
            aO.DM && aO.DM.p6();
            this.xg && this.xg.aq(0);
            this.I4 && this.I4.aq(0);
            this.kX && this.kX.Ww()
        },
        Sc: function() {
            this.eX && this.eX.Ri()
        },
        B6: function() {
            if (this.bL.OutcomeDetail.Stage.match(/^BaseGame/) && this.bL.OutcomeDetail.NextStage.match(/^FreeSpin/)) {
                this.sL.Xx()
            } else {
                this.Qw()
            }
        },
        yY: function() {
            if (this.bL.OutcomeDetail.NextStage.match(/^FreeSpin/)) {
                this.Qw()
            } else {
                this.zH(1)
            }
        },
        iT: function() {
            this.Va.pf(this.bL.OutcomeDetail.Balance - this.bL.OutcomeDetail.Payout);
            this.W4.mO();
            switch (this.bL.OutcomeDetail.Stage) {
                case "BaseGame":
                    this.bL.OutcomeDetail.NextStage == "FreeSpin" ? this.hL.Xx() : this.aN.Xx();
                    break;
                case "FreeSpin":
                    this.mH.pf(this.bL.FreeSpinOutcome.Count);
                    this.AM.pf(this.bL.FreeSpinOutcome.Count);
                    this.Bs.pf(this.bL.PopulationOutcome.HighestNumberOfFreeSpin.Hw[0]);
                    this.bL.OutcomeDetail.NextStage == "BaseGame" ? this.F_.Xx() : this.ww.Xx();
                    break
            }
        },
        ey: function() {
            if (this.EA.className.indexOf("Er") != -1) {
                this.EA.removeClass("Er");
                this.zH(1);
                this.rP.rp.Jl("display", "");
                var bM = this.fZ.tp();
                bM.BetPerPattern[FR] = FR.Bz(this.fS.Tv());
                bM.PatternsBet = this.I8.Tv();
                this.fZ.L8(bM)
            } else {
                rm.Ww();
                this.Rz.rp.Jl("opacity", "");
                this.iR.rp.removeClass("o6");
                this.iR.aq(0);
                this.m3.Jl("visibility", "hidden");
                this.EA.addClass("Er");
                this.J9.addClass("ua");
                this.rP.rp.Jl("display", "none");
                this.fS.aq(1);
                this.I8.aq(1);
                this.W4.Pb().KT("display", "");
                this.W4.rp.removeClass("aq")
            }
        },
        Vs: function() {
            this.m3.Jl("visibility", "hidden")
        },
        vr: function(Ob) {
            this.KR.pf(this.eD());
            this.fj.pf(this.eD())
        },
        MV: function(Ob) {
            this.Ox.O2(Ob, 0);
            this.KR.pf(this.eD());
            this.fj.pf(this.eD())
        }
    })
}());
