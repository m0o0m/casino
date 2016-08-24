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
        if (newClass.vr) {
            return this
        }
        this.nq = $empty;
        var value = (this.initialize) ? this.initialize.apply(this, arguments) : this;
        delete this.nq;
        delete this.caller;
        return value
    }.extend(this);
    newClass.implement(params);
    newClass.constructor = Class;
    newClass.prototype.constructor = newClass;
    return newClass
}
Function.prototype.protect = function() {
    this.aX = true;
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
        F.vr = true;
        var proto = new F;
        delete F.vr;
        return proto
    },
    wrap: function(self, key, method) {
        if (method.qU) {
            method = method.qU
        }
        return function() {
            if (method.aX && this.nq == null) {
                throw new Error('The method "' + key + '" cannot be called.')
            }
            var caller = this.caller,
                current = this.nq;
            this.caller = current;
            this.nq = arguments.callee;
            var result = method.apply(this, arguments);
            this.nq = current;
            this.caller = caller;
            return result
        }.extend({
            O8: self,
            qU: method,
            gn: key
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
                if (value.RG) {
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
            var name = this.caller.gn,
                previous = this.caller.O8.parent.prototype[name];
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
            Bv = -1,
            NQ = events.length,
            fn;
        if (delay) {
            while (++Bv < NQ) {
                if (fn = events[Bv]) {
                    setTimeout(function() {
                        fn.apply(this, args)
                    }, delay)
                }
            }
        } else {
            while (++Bv < NQ) {
                if (fn = events[Bv]) {
                    fn.$bound ? fn.$bound.apply(fn.$boundObject, (fn.$boundArgs || []).concat(Array.prototype.slice.call(args))) : fn.apply(this, args)
                }
            }
        }
        return this
    },
    HK: function(type, args) {
        var events, Bv = 0,
            NQ, fn;
        if (!(events = this.$events) || !(events = events[type])) {
            return this
        }
        args = args === undefined ? [] : args instanceof Array ? args : [args];
        for (NQ = events.length; Bv < NQ; ++Bv) {
            if (fn = events[Bv]) {
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
            var M9 = "M9=" + method;
            data = (data) ? M9 + "&" + data : M9;
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
    ku: function() {
        var Q7 = this,
            jP = [].slice.call(arguments, 0);
        return function() {
            return Q7.apply(this, jP.concat([].slice.call(arguments, 0)))
        }
    },
    nO: function(Bv) {
        return function() {
            return arguments[Bv]
        }
    },
    UN: function() {
        var Qe = this,
            jP = arguments;
        return function() {
            var Bv = jP.length,
                yh = [];
            while (Bv-- > 0) {
                yh[Bv] = arguments[jP[Bv]]
            }
            Qe.apply(this, yh)
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
    mU: function(M9) {
        var jP = Array.slice(arguments, 1),
            Bv = -1,
            NQ = this.length,
            Ig = [];
        while (++Bv < NQ) {
            Ig[Bv] = this[Bv][M9].apply(this[Bv], jP)
        }
        return Ig
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
    U2: function(eU) {
        return this.mU("U2", eU).join("")
    },
    tb: function() {
        var Bv = 0,
            ye = this.length,
            NQ, s8 = [this[0]];
        while (++Bv < ye) {
            NQ = Math.floor(Math.random() * Bv);
            s8[Bv] = s8[NQ];
            s8[NQ] = this[Bv]
        }
        return s8
    },
    mj: function() {
        var mr = {},
            Bv = this.length;
        while (--Bv >= 0) {
            mr[this[Bv]] = Bv
        }
        return mr
    },
    Ix: function(yw) {
        return this.map(function(vn) {
            return yw[vn]
        })
    },
    wd: function(vl) {
        var ye = this.length - 1,
            s8 = [],
            Bv;
        for (Bv = 0; Bv <= ye; ++Bv) {
            s8[Bv] = this[Bv * vl % ye || Bv]
        }
        return s8
    },
    tx: function() {
        this.tx = (function() {
            var XD = 0;
            return function() {
                var ye = this.length,
                    Bv;
                if (ye > 1) {
                    while (XD == (Bv = Math.floor(Math.random() * ye))) {}
                }
                return this[XD = Bv]
            }
        })();
        return this.tx()
    }
});
Array.UT = function(vn) {
    return vn instanceof Array ? vn : vn ? [vn] : []
};
Array.g5 = function(XA, W6, hW, P4) {
    var s8 = [],
        Bv;
    hW = hW || Infinity;
    P4 = P4 || 1;
    for (Bv = XA; Bv <= W6; ++Bv) {
        s8.push(Bv % hW * P4)
    }
    return s8
};
String.implement({
    yJ: function() {
        return this.charAt(Math.floor(Math.random() * this.length))
    },
    J7: function(Zl) {
        return this.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
    },
    S8: function(s8) {
        var Bk = function(mr) {
            return this.substitute(mr)
        };
        return s8.map(Bk, this)
    },
    RK: function(eU, Jf) {
        Jf = Jf ? ' class="'.concat(Jf, '"') : "";
        return "<".concat(eU, Jf, ">", this, "</", eU, ">")
    },
    U2: function(eU, Jf) {
        return this.J7().RK(eU, Jf)
    }
});
Elements.MI = function(xU) {
    return (new Element("div")).set("html", arguments).getChildren()
};
Element.implement({
    tJ: (function() {
        var VB = {};
        return function(Ee) {
            VB[Ee] = VB[Ee] || function() {
                window.event.which !== 0 && Ee.test(String.fromCharCode(window.event.charCode)) && event.preventDefault()
            };
            return this.addEvent("keypress", VB[Ee])
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
            O8: binder.O8,
            qU: binder.qU,
            gn: binder.gn
        }).apply(this, arguments)
    };
    return binder
};
var He = {};
var sc = function(lI) {
    this.iN = window.getComputedStyle(lI, null)
};
sc.prototype = {
    ps: function(ED, ZX) {
        ZX = He.Gq(ZX);
        try {
            return this.iN.getPropertyCSSValue ? this.iN.getPropertyCSSValue(ZX).getFloatValue(ED) : this.iN.getPropertyValue(ZX).toInt()
        } catch (MY) {}
    },
    AL: function(ZX) {
        ZX = He.Gq(ZX);
        return this.ps(5, ZX)
    },
    nW: function(ZX) {
        ZX = He.Gq(ZX);
        return this.iN.getPropertyValue(ZX)
    }
};
He.cV = (function(a, b, c) {
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
    }, A(""), j = l = null, e.bo = f, e.r4 = d, g.className = g.className.replace(/\bno-javascript\b/, "") + " javascript " + u.join(" ");
    return e
})(this, this.document);
He.d0 = function() {
    document.body.adopt((new Element("div", {
        style: "position: absolute; top: -1000px"
    })).adopt(new Element("input", {
        id: "xz",
        type: "text"
    }), new Element("label", {
        "for": "xz",
        text: "xz"
    })))
};
(function() {
    var iH = {
            U6: /([0-9_]+) like Mac OS X/,
            Lj: /Android ([0-9.]+)/,
            Ji: /Windows \w+ ([0-9.]+)/
        },
        uf = navigator.userAgent.match(/[(]([^;]+)(?:; U)?; ([^;)]+)(?:; [^)]+)?[)]/) || [],
        Q_;
    this.Zm = uf[1];
    if (this.Q_ = uf[2]) {
        for (Q_ in iH) {
            if (uf = this.Q_.match(iH[Q_])) {
                this.Q_ = Q_;
                this.n_ = uf[1] && parseFloat(uf[1].substr(0, 3).replace("_", "."));
                break
            }
        }
    }
    if (this.cV.touch) {
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
    this.VD = He.Q_ == "U6";
    (function() {
        var ek = document.createElement("canvas"),
            aR = document.createElement("canvas"),
            Yu, ay;
        aR.setAttribute("width", 1);
        aR.setAttribute("height", 1);
        ay = aR.getContext("2d");
        ek.setAttribute("width", 8);
        ek.setAttribute("height", 8);
        Yu = ek.getContext("2d");
        if (aR.getContext === undefined) {
            return
        }
        this.T8 = !!Yu.putImageData;
        this.eG = !!Yu.getImageData;
        if (this.T8 && this.eG) {
            this.pm = 1;
            try {
                Yu.putImageData(ay.getImageData(0, 0, 1, 1), -1, -1)
            } catch (q8) {
                this.pm = 0
            }
        }
        if (this.eG) {
            ay.fillStyle = "#ffffff";
            ay.fillRect(0, 0, 1, 1);
            Yu.clearRect(0, 0, 8, 8);
            Yu.drawImage(aR, 4, 4);
            this.Qh = Yu.getImageData(4, 4, 1, 1).data[0] == 0
        }
    }).call(this);
    document.readyState === "complete" ? He.d0() : window.addEvent("domready", He.d0)
}).call(He);
He.Qh && (function(wB, V8, VV) {
    if (wB != 1) {
        CanvasRenderingContext2D.prototype.drawImage = function(Er, bm, SI, K8, yg, Cm, Dm, TQ, TV) {
            V8.call(this, Er, bm / wB, SI / wB, K8 / wB, yg / wB, Cm / wB, Dm / wB, TQ / wB, TV / wB)
        };
        CanvasRenderingContext2D.prototype.putImageData = VV && function(LR, Cm, Dm) {
            VV.call(this, LR, Cm * wB, Dm * wB)
        }
    }
})(window.devicePixelRatio || 1, CanvasRenderingContext2D.prototype.drawImage, CanvasRenderingContext2D.prototype.putImageData);
var gT = new Class({
    BH: function() {
        this.C4 = $merge.run([this.C4].extend(arguments));
        if (!this.addEvent) {
            return this
        }
        for (var aB in this.C4) {
            if ($type(this.C4[aB]) != "function" || !(/^on[A-Z]/).test(aB)) {
                continue
            }
            this.addEvent(aB, this.C4[aB]);
            delete this.C4[aB]
        }
        return this
    },
    TP: function(ZX) {
        return this.C4.hasOwnProperty(ZX) ? this.C4[ZX] : void 0
    },
    kh: function(ZX, IO) {
        return this.C4[ZX] = IO
    }
});
var xa = function(Rw, tX, AN) {
    this.Rw = Rw;
    this.tX = tX;
    this.AN = AN || 1;
    this.dH = 0;
    this.FQ = this.FQ.bind(this)
};
xa.prototype = {
    FQ: function() {
        if (--this.dH == 0) {
            this.Rw.removeEvent(this.tX, this.FQ);
            this.ba()
        }
    },
    VE: function(d5) {
        this.ba = d5;
        this.dH = this.AN, this.Rw.addEvent(this.tX, this.FQ)
    },
    IN: function() {
        this.Rw.removeEvent(this.tX, this.FQ)
    }
};
Events.implement({
    uR: function(tX, AN) {
        return new xa(this, tX, AN)
    },
    LF: function(NK, ba) {
        var Q7 = this,
            Pn = function() {
                ba.apply(this, arguments);
                Q7.removeEvent(NK, Pn)
            };
        return this.addEvent(NK, Pn)
    }
});
Element.Properties.K1 = {
    set: (function() {
        var JH = function() {
            tV = Math.min(1, this.clientWidth / this.scrollWidth);
            tV && this.nm({
                transform: Ei.e9.tV(tV, tV),
                transformOrigin: "0 0"
            })
        };
        return function(xU) {
            if (!this.JH) {
                this.JH = this.JH || JH.bind(this);
                window.addEvent("orientationchange", this.JH)
            }
            this.set("html", xU);
            JH.call(this);
            return this
        }
    })(),
    get: Element.Properties.html.get
};
var GM = new Class({
    Extends: Events,
    Implements: gT,
    C4: {
        ix: "",
        gs: "",
        OE: 0
    },
    z9: 0,
    toElement: function() {
        return this.nG
    },
    initialize: function(C4) {
        this.BH(C4);
        this.nG = (C4.nG || new Element("div", {
            id: this.C4.ix,
            "class": this.C4.gs + " GM"
        })).adopt(this.b_ = this.C4.b_ || new Element("div", {
            "class": "uo"
        }));
        C4.OE && GM.OE(this)
    },
    fw: function(xU) {
        this.b_.innerHTML = xU;
        return this
    },
    tM: function(bW) {
        bW = arguments.length ? !!bW : !this.z9;
        if (bW != this.z9) {
            this.fireEvent(bW ? "J5" : "HL");
            this.nG.style.visibility = bW ? "inherit" : "hidden";
            this.z9 = bW;
            this.fireEvent(bW ? "H5" : "Q6")
        }
        return this
    },
    lu: function() {
        return this.z9
    },
    t_: function() {
        return this.tM(!this.z9)
    },
    x9: function(lI) {
        lI = lI || new Element("div");
        this.nG.adopt(lI.adopt(this.nG.getChildren()));
        return this
    },
    rL: function(QO, QE) {
        return (new Element("div", {
            id: QO || "",
            "class": QE || ""
        })).adopt((new Element("div", {
            "class": "JF"
        })).adopt(this), new Element("div", {
            "class": "l6"
        }))
    },
    KS: function() {
        this.nG.destroy()
    },
    F_: function() {
        this.nG.dispose()
    },
    WJ: function() {
        return sq.Od(this.__proto__.constructor, [this.C4])
    }
});
GM.OE = function(tQ) {
    var fw = tQ.fw;
    tQ.fw = function(xU) {
        this.b_.set("K1", xU);
        return this
    }
};
var AE = new Class({
    Extends: GM,
    Binds: ["dJ", "rj", "v8", "JW"],
    nG: null,
    b_: null,
    Ec: 0,
    LJ: 0,
    Hq: 1,
    C4: {
        uo: "",
        Hq: 0,
        v9: 200,
        R5: 1
    },
    initialize: function(C4) {
        this.BH(C4);
        this.nG = new Element("div", {
            id: this.C4.ix,
            "class": this.C4.gs + " AE"
        }).adopt(this.b_ = new Element("div", {
            "class": "uo"
        }).adopt(this.wT = new Element("div", {
            "class": "z6"
        })), new Element("div", {
            "class": "dQ"
        }));
        this.fw(this.C4.uo);
        this.GZ(this.C4.Hq);
        this.b_.addEvents({
            touchstart: this.dJ,
            touchend: this.rj,
            eS: this.JW
        });
        this.Og = this.b_;
        document.addEvents({
            touchend: this.v8,
            touchcancel: this.v8
        })
    },
    x9: function(lI, aU) {
        lI.wraps(this.wT, aU);
        return this
    },
    GZ: function(GZ) {
        if (this.Hq != !!GZ) {
            this.Hq = !!GZ;
            this.Hq ? this.nG.removeClass("UL") : this.nG.addClass("UL");
            this.v8();
            this.fireEvent("GZ", this.Hq)
        }
        return this
    },
    fw: function(uo) {
        uo instanceof Element ? this.wT.adopt(arguments) : this.H4(uo);
        return this
    },
    H4: function(z6) {
        this.uo != z6 && this.wT.set("text", this.uo = z6);
        return this
    },
    dJ: function(tX) {
        tX.preventDefault();
        if (this.Hq) {
            this.nG.addClass("Ec");
            this.Ec = 1;
            ++this.LJ;
            this.fireEvent("BI").b_.fireEvent("eS", [this.LJ], this.C4.v9)
        }
    },
    rj: function() {
        this.Hq && this.Ec && this.fireEvent("uh");
        this.v8()
    },
    v8: function() {
        this.Ec = 0;
        this.nG.removeClass("Ec")
    },
    JW: function(LJ) {
        LJ == this.LJ && this.C4.R5 ? this.rj() : this.nG.removeClass("Ec")
    }
});
var Ym = (function() {
    var KF = {
            chipSet1: [0.05, 0.1, 0.5, 1, 5, 25, 100, 500, 1000, 5000, 10000],
            chipSet2: [0.25, 0.5, 1, 5, 25, 100, 500, 1000, 5000, 10000, 50000],
            chipSet3: [0.5, 1, 5, 10, 50, 100, 500, 1000, 5000, 10000, 50000, 100000],
            chipSet4: [5, 10, 50, 100, 500, 1000, 5000, 10000, 50000, 100000, 500000, 1000000]
        },
        xA, qK, iJ, Ll, Vh, DP, xM, mI, jX = function(g1, yk) {
            var wa = Ym.mf(g1).split("."),
                nK = (+wa[0]).toString(),
                cE = wa[1] || "",
                N1;
            if (Vh) {
                while (N1 = nK.match(/^(\d+)(\d\d\d)(.*)$/)) {
                    nK = N1[1].concat(Vh, N1[2], N1[3])
                }
            }
            yk = yk && cE == 0;
            return Ll.concat(nK, yk ? "" : bG, yk ? "" : cE, DP)
        };
    return {
        toString: function() {
            return xM
        },
        Vx: function(wa) {
            return wa / qK
        },
        mf: function(g1) {
            return (g1 * qK).toFixed(iJ)
        },
        r8: NL = function(T2, yk) {
            return jX(Ym.Vx(T2), yk)
        },
        Rm: XJ = function(g1) {
            return jX(g1, 1)
        },
        tO: nl = function(g1) {
            return jX(g1, 0)
        },
        Xp: function(Z6, EG) {
            var f0 = Z6.MAJOR_SYMBOL_PADDING_SPACE == "true" ? "\u00a0" : "";
            xM = Z6["@currencyCode"];
            iJ = parseInt(Z6.DECIMAL_PRECISION);
            qK = EG;
            Ll = Z6.MAJOR_SYMBOL_ALIGNMENT == "left" ? Z6.MAJOR_SYMBOL + f0 : "";
            DP = Z6.MAJOR_SYMBOL_ALIGNMENT == "right" ? f0 + Z6.MAJOR_SYMBOL : "";
            Vh = (Z6.USE_THOUSANDS_SEPARATOR == "yes" ? Z6.THOUSANDS_SEPARATOR : "").replace("_", "\u00a0");
            bG = (iJ ? Z6.DECIMAL_SEPARATOR : "").replace("_", "\u00a0");
            KF = KF[Z6.CHIP_SET_CODE] || [];
            xA = KF[0] || 1;
            KF = KF.map(function(IO) {
                return Math.round(IO / xA)
            })
        },
        aE: function(g1) {
            var Bv = KF.length,
                sL = [];
            g1 = Math.round(g1 * qK / xA);
            while (--Bv >= 0 && g1 > 0) {
                while (g1 - KF[Bv] >= 0) {
                    sL.push(Bv);
                    g1 -= KF[Bv]
                }
            }
            return sL
        },
        hp: function(ee) {
            for (var vn = 0, Bv = ee.length; --Bv >= 0; vn += KF[ee[Bv]] * xA) {}
            return Ym.Vx(vn)
        },
        Wp: function(ee) {
            return ee.map(function(vn) {
                return KF[vn] * xA
            })
        },
        Kx: function(UR, YQ) {
            var IY = Math.round(qK / xA),
                sL = [],
                Bv;
            YQ = Math.round(YQ * qK / xA) || Infinity;
            for (Bv = 0; Bv < KF.length; ++Bv) {
                if (KF[Bv] >= IY && KF[Bv] <= YQ && 0 < UR--) {
                    sL.push(Bv)
                }
            }
            return sL
        },
        p3: function(OG) {
            return Ym.Vx(KF[OG] * xA)
        }
    }
})();
var W3 = (function() {
    var bU = function(Bv) {
            Bv = Bv in this.C4.ZB && Bv || 0;
            if (this.Pk != Bv) {
                this.Pk = Bv;
                this.GZ(this.Hq);
                this.B3.innerHTML = this.C4.j_(this.C4.ZB[Bv]);
                this.fireEvent("Lr", [this.C4.ZB[Bv], Bv])
            }
        },
        Td = function() {
            bU.call(this, this.Pk + 1)
        },
        aW = function() {
            bU.call(this, this.Pk - 1)
        };
    return new Class({
        Extends: GM,
        Hq: 0,
        C4: {
            Hq: 0,
            ZB: [],
            j_: nl
        },
        initialize: function(C4) {
            this.BH(C4);
            this.Hq = this.C4.Hq;
            this.nG = new Element("div", {
                id: this.C4.ix,
                "class": "W3 " + this.C4.gs
            });
            this.nG.adopt(this.t2 = (new AE({
                gs: "W3 dM"
            })).addEvent("BI", aW.bind(this)), this.fC = (new AE({
                gs: "W3 sG"
            })).addEvent("BI", Td.bind(this)), this.B3 = new Element("div", {
                "class": "mV"
            }));
            this.C4.CG !== void 0 && this.xd(this.C4.CG)
        },
        N_: function(lI) {
            return lI.wraps(this.B3)
        },
        xd: function(CG) {
            bU.call(this, this.C4.ZB.indexOf(CG))
        },
        bu: function() {
            return this.C4.ZB[this.Pk]
        },
        GZ: function(GZ) {
            this.Hq = GZ = !!GZ;
            this.t2.GZ(GZ && this.Pk - 1 in this.C4.ZB);
            this.fC.GZ(GZ && this.Pk + 1 in this.C4.ZB)
        }
    })
})();
var dK = (function() {
    var bT = function() {
            var B0 = this.t6.Eh(),
                Q2 = window.devicePixelRatio || 1,
                iB = B0.AL("width") * Q2,
                Dt = B0.AL("height") * Q2,
                X0 = this.C4.u0.X0 || B0.nW("color"),
                g7 = this.C4.u0.g7,
                tK = this.C4.u0.tp,
                s5 = this.C4.ZB.length,
                sF, mq = this.C4.u0.e3,
                l8, Ut = this.t6,
                Ov = Ut.getContext("2d"),
                Z2 = +this.qL.bu(),
                vn;
            s5 = tK ? s5 : parseInt(this.C4.ZB[s5 - 1], 10);
            sF = iB / (s5 + s5 * mq - mq);
            mq *= sF;
            Ut.width = iB;
            Ut.height = Dt;
            for (l8 = 0; l8 < s5; l8++) {
                vn = tK ? +this.C4.ZB[l8] : l8 + 1;
                Ov.fillStyle = vn <= Z2 ? X0 : g7;
                Ov.fillRect((sF + mq) * l8, 0, sF, Dt)
            }
        },
        kO = function(CG) {
            bT.call(this);
            this.fireEvent("Lr", arguments)
        };
    return new Class({
        Extends: GM,
        CG: 0,
        UL: 0,
        C4: {
            ZB: [],
            j_: function(CG) {
                return CG
            },
            Ul: null,
            V6: "top",
            u0: {
                tp: 1,
                e3: 0.4,
                X0: 0,
                g7: 0
            }
        },
        initialize: function(C4) {
            this.BH(C4);
            this.nG = new Element("div", {
                id: this.C4.ix,
                "class": "N5 " + this.C4.gs
            });
            this.nG.adopt(this.qL = new W3({
                gs: "mh",
                Hq: 1,
                ZB: this.C4.ZB,
                CG: this.C4.CG,
                j_: this.C4.j_
            }));
            this.qL.N_(new Element("div", {
                "class": "VP"
            })).grab(new Element("div", {
                "class": "RV",
                html: this.C4.Ul
            }), this.C4.V6).adopt(this.t6 = new Element("canvas", {
                "class": "u0"
            }));
            this.qL.addEvent("Lr", kO.bind(this));
            this.C4.CG !== void 0 && this.xd(this.C4.CG)
        },
        tM: function(bW) {
            bW && bT.call(this);
            return this.parent(bW)
        },
        GZ: function(Hq) {
            this.qL.GZ(Hq)
        },
        xd: function(CG) {
            this.qL.xd(CG);
            return this
        },
        bu: function() {
            return this.qL.bu()
        }
    })
})();
var Ep = new Class({
    Extends: GM,
    Binds: ["QX", "Zt"],
    C4: {
        Jf: ""
    },
    initialize: function(C4) {
        this.BH(C4);
        this.nG = (new Element("div", {
            id: this.C4.ix,
            "class": "Ep " + (this.C4.gw || this.C4.Jf)
        })).adopt((new Element("div")).adopt(this.b_ = new Element("span")))
    },
    jA: function() {
        return this.b_
    },
    QX: function(z6) {
        this.b_.set("text", z6);
        return this
    },
    ft: function(xU) {
        this.b_.set("html", xU);
        return this
    },
    Zt: function(z6) {
        this.b_.set("html", "");
        return this
    },
    nj: function(ZX, IO) {
        this.b_.nj(ZX, IO);
        return this
    },
    nm: function(fb) {
        this.b_.nm(fb);
        return this
    }
});
var BO = new Class({
    Extends: Ep,
    Binds: ["kI", "QX", "Eq", "wc"],
    initialize: function(C4) {
        this.parent(C4);
        this.Jw = new Element("span", {
            "class": "r9"
        });
        this.QS = new Element("span", {
            "class": "ro"
        });
        this.Jw.inject(this.b_, "before");
        this.QS.inject(this.b_, "after")
    },
    q2: function(ZX, IO) {
        this.Jw.setStyle(ZX, IO);
        return this
    },
    W_: function(ZX, IO) {
        this.QS.setStyle(ZX, IO);
        return this
    },
    kI: function(z6) {
        this.Jw.set("text", z6);
        return this
    },
    L1: function(xU) {
        this.Jw.set("html", xU);
        return this
    },
    Eq: function(z6) {
        this.QS.set("text", z6);
        return this
    },
    vX: function(xU) {
        this.QS.set("html", xU);
        return this
    },
    wc: function(x8) {
        (x8 === "left" || x8 === void(0)) && this.Jw.set("html", "");
        (x8 === "right" || x8 === void(0)) && this.QS.set("html", "");
        return this.Zt()
    },
    nm: function(ZX, IO) {
        this.Jw.setStyle(ZX, IO);
        this.QS.setStyle(ZX, IO);
        return this.nj(ZX, IO)
    }
});
var pA = (function() {
    var Au = 0,
        t8 = 0,
        dV = {},
        U0 = 0,
        LQ = 25,
        bV = 0,
        Tm = function() {
            var Bv, Qq, EW;
            for (Bv in dV) {
                Qq = dV[Bv];
                Qq.Db -= LQ;
                if (Qq.Db <= 0) {
                    isNaN(Qq.Db = Qq.pU) && Yl(Bv);
                    EW = +new Date;
                    Qq.ba(EW - Qq.pW);
                    Qq.pW = EW
                }
            }
        },
        yX = function(rp, ba, cv) {
            cv = Math.max(cv, 0);
            dV[++U0] = {
                ba: ba,
                pU: rp ? cv : NaN,
                Db: cv,
                pW: +new Date
            };
            ++t8;
            vy(0);
            return U0
        },
        Yl = function(SG) {
            if (dV[SG]) {
                --t8 || vy(1);
                delete dV[SG]
            }
        },
        P6 = function(SG, ba) {
            if (dV[SG]) {
                dV[SG].ba = ba
            }
            return dV[SG] && SG
        },
        Qu = function(WQ) {
            LQ = Math.ceil(1000 / WQ)
        },
        rE = function() {
            return LQ
        },
        vy = function(BE) {
            var EW;
            if (bV == !BE) {
                return
            }
            if (bV) {
                EW = +new Date;
                for (Bv in dV) {
                    dV[Bv].eH = EW - dV[Bv].pW
                }
                Au = clearInterval(Au)
            } else {
                EW = +new Date;
                for (Bv in dV) {
                    if (dV[Bv].eH) {
                        dV[Bv].pW = EW - dV[Bv].eH
                    }
                }
                Au = t8 && setInterval(Tm, LQ)
            }
            bV = !!Au && !BE
        };
    Qu(40);
    window.addEventListener("pagehide", vy.ku(1));
    window.addEventListener("pageshow", vy.ku(0));
    return {
        rE: rE,
        Qu: Qu,
        UF: yX.ku(0),
        aC: yX.ku(1),
        P6: P6,
        MO: Yl,
        sl: Yl,
        vy: vy.ku(1),
        gD: vy.ku(0)
    }
})();
var s2 = new Class({
    Implements: [Events, gT],
    C4: {},
    Zd: 0,
    initialize: function(C4) {
        this.BH(C4)
    },
    dO: function() {
        return !!this.Zd
    },
    zm: function(Qw) {
        this.Zd = 1;
        this.fireEvent("FG", this);
        this.Qw = Qw;
        return this
    },
    yq: function() {
        if (this.Zd) {
            this.Zd = 0;
            this.fireEvent("Xh", this);
            delete this.Qw
        }
        return this
    },
    pT: function() {
        if (this.Zd) {
            this.Zd = 0;
            this.fireEvent("TU", this);
            this.Qw && this.Qw();
            delete this.Qw
        }
        return this
    },
    Gn: function() {
        if (this.Zd) {
            this.Zd = 0;
            this.fireEvent("dB", this).Qw && this.Qw();
            delete this.Qw
        }
        return this
    }
});
var Nh = new Class({
    Extends: s2,
    initialize: function(G0, MS) {
        this.G0 = G0;
        this.MS = MS
    },
    zm: function(Qw) {
        this.parent(Qw);
        return this.MS() ? this.G0.zm(this.Gn.bind(this)) : this.Gn()
    },
    yq: function() {
        if (this.Zd) {
            this.G0.yq();
            this.parent()
        }
        return this
    },
    pT: function() {
        if (this.Zd) {
            this.G0.pT();
            this.parent()
        }
        return this
    }
});
var w5 = new Class({
    Extends: s2,
    Binds: ["hR"],
    F2: 0,
    initialize: function(F8) {
        this.F8 = F8
    },
    r_: function() {
        this.F8.VE(this.hR);
        this.F2 = 1
    },
    zm: function(Qw) {
        this.r_();
        this.parent(Qw);
        0 == this.F2 && this.Gn();
        return this
    },
    hR: function() {
        this.F2 = 0;
        this.Zd && this.Gn()
    },
    yq: function() {
        this.F8 && this.F8.IN();
        this.F2 = 0;
        return this.parent()
    },
    pT: function() {
        this.F8 && this.F8.IN();
        this.F2 = 0;
        return this.parent()
    }
});
(function() {
    var cA = function(tX, AN) {
        return new w5(new xa(this, tX, AN))
    };
    Events.implement("kg", cA);
    s2.implement("kg", cA);
    Element.implement("kg", cA)
})();
var wk = new Class({
    Extends: w5,
    F2: 0,
    WW: [],
    initialize: function() {
        this.WW = Array.flatten(arguments)
    },
    r_: function() {
        this.F2 = this.WW.length;
        this.WW.forEach(function(F8) {
            F8.VE(this.hR)
        }, this)
    },
    yq: function() {
        this.WW.forEach(function(F8) {
            F8.IN()
        }, this);
        return this.parent()
    },
    pT: function() {
        this.WW.forEach(function(F8) {
            F8.IN()
        }, this);
        return this.parent()
    }
});
var xl = new Class({
    Extends: wk,
    hR: function() {
        if (--this.F2 == 0) {
            this.Zd && this.Gn()
        }
    }
});
var H_ = (function() {
    var I0 = function() {
        this.O2 = 0;
        this.fireEvent("aP", this);
        this.VF()
    };
    return new Class({
        Extends: s2,
        C4: {
            ec: 0
        },
        O2: 0,
        zm: function(Qw) {
            this.parent(Qw);
            if (Math.max(0, this.C4.ec) > 0) {
                this.O2 = pA.UF(I0.bind(this), this.C4.ec)
            } else {
                I0.call(this)
            }
            return this
        },
        VF: function() {
            this.Gn()
        },
        yq: function() {
            this.O2 = this.O2 && pA.MO(this.O2);
            this.Zd && this.parent();
            return this
        },
        pT: function() {
            this.O2 = this.O2 && pA.MO(this.O2);
            this.Zd && this.parent();
            return this
        }
    })
})();
var IW = new Class({
    Extends: s2,
    initialize: function() {
        this.W2 = Array.flatten(arguments);
        this.parent()
    },
    zm: function(Qw) {
        var BX = this,
            xG = this.W2.length,
            oQ = function() {
                --xG || BX.Gn()
            };
        this.parent(Qw);
        this.W2.mU("zm", oQ);
        return this
    },
    yq: function() {
        this.W2.mU("yq");
        return this.parent()
    },
    pT: function() {
        this.W2.mU("pT");
        return this.parent()
    }
});
var Yf = new Class({
    Extends: H_,
    Binds: ["mQ", "ml"],
    C4: {
        Ay: 1,
        eT: 0,
        E8: 1,
        rs: 0,
        cv: 1,
        f_: 10000000000
    },
    Mq: NaN,
    Ay: 1,
    zm: function(Qw) {
        this.Ay = this.C4.Ay;
        this.parent(Qw)
    },
    VF: function() {
        this.Mq = 0;
        (this.C4.rs > 0) ? this.mQ(): this.ml()
    },
    Ne: function(TA) {
        this.Ay = TA || 1
    },
    mQ: function() {
        var UG = this.C4.eT + this.Mq % this.C4.f_ * this.C4.E8;
        if (!isNaN(UG)) {
            this.O2 = 0;
            this.fireEvent("Mx", [this, this.Mq, UG]);
            this.Ba(this.Mq, UG) && this.ml()
        }
    },
    ml: function() {
        if (this.Mq == NaN) {
            return
        }
        if (++this.Mq >= this.C4.rs) {
            if (0 == --this.Ay || 0 == this.C4.rs) {
                this.Mq = NaN;
                this.Gn();
                return
            }
            this.Mq = 0;
            this.fireEvent("kq", [this, this.Ay])
        }
        this.O2 = pA.UF(this.mQ, this.C4.cv)
    },
    yq: function() {
        this.O2 = this.O2 && pA.MO(this.O2);
        this.Mq = NaN;
        this.Ay = NaN;
        return this.parent()
    },
    pT: function() {
        this.O2 = this.O2 && pA.MO(this.O2);
        this.Mq = NaN;
        this.Ay = NaN;
        return this.parent()
    }
});
var qx = new Class({
    Extends: Yf,
    qJ: [],
    initialize: function(qJ, C4) {
        this.BH(C4);
        this.Xi(qJ)
    },
    Xi: function(qJ) {
        qJ = qJ || [];
        this.qJ = qJ.filter(function(W7) {
            return W7 instanceof s2
        });
        this.C4.eT = 0;
        this.C4.E8 = 1;
        this.C4.rs = this.qJ.length;
        this.C4.f_ = this.qJ.length;
        return this
    },
    Ba: function(Mq, UG) {
        this.qJ[Mq].zm(this.ml);
        return 0
    },
    yq: function() {
        var W7 = this.qJ[this.Mq];
        if (W7) {
            delete W7.Qw;
            W7.yq()
        }
        this.parent()
    },
    pT: function() {
        var W7 = this.qJ[this.Mq];
        if (W7) {
            delete W7.Qw;
            W7.pT()
        }
        return this.parent()
    }
});
var SK = new Class({
    Extends: qx,
    initialize: function() {
        this.parent(Array.flatten(arguments))
    }
});
Zi.FK = {};
Zi.iT = {};
DF.hJ("image/*", (function(Df) {
    return function(Ct) {
        var Qz = this,
            Er = new Image();
        Er.onload = function() {
            delete Er.onload;
            delete Er.onerror;
            Zi.FK[Qz.ix] = Er;
            Qz.iT && sq.h0(Qz.iT, function(D3, ix) {
                Zi.iT[ix] = sq.Od(IJ, [Er].concat(D3.slice(0)))
            });
            Qz.Q3()
        };
        Er.onerror = this.A_;
        Er.src = Ct.concat(this.Jl, "&resolution=", Df)
    }
})(navigator.userAgent.indexOf("iPad;") >= 0 ? 2 : window.devicePixelRatio || 1), ["image/*"]);
var IJ = function(Er, l8, Ez, sF, HE, iQ, Nr, uw) {
    uw = uw || 1;
    Er.iT = Er.iT || [];
    Er.iT.push(this);
    this.Er = Er;
    this.l8 = l8 / uw;
    this.Ez = Ez / uw;
    this.iB = sF / uw;
    this.Dt = HE / uw;
    this.CY = iQ;
    this.bh = Nr;
    this.wE = this.iB / iQ;
    this.rb = this.Dt / Nr;
    this.Vd = uw;
    this.Q2 = window.devicePixelRatio || 1
};
IJ.prototype = {
    constructor: IJ,
    cr: function(LG, LC, NH, zV, cj, aO, oA, s3, Xm) {
        var ye = arguments.length,
            l8 = this.l8,
            Ez = this.Ez,
            sF = this.iB,
            HE = this.Dt,
            uw = this.Vd;
        ye == 3 ? LG.drawImage(this.Er, l8 * uw, Ez * uw, sF * uw, HE * uw, LC * this.Q2, NH * this.Q2, sF * this.Q2, HE * this.Q2) : ye == 5 ? LG.drawImage(this.Er, l8 * uw, Ez * uw, sF * uw, HE * uw, LC * this.Q2, NH * this.Q2, zV * this.Q2, cj * this.Q2) : LG.drawImage(this.Er, l8 * uw + LC * uw, Ez * uw + NH * uw, zV * uw, cj * uw, aO * this.Q2, oA * this.Q2, s3 * this.Q2, Xm * this.Q2)
    },
    Sb: function(LG, oX, Zg, Cm, Dm, TQ, TV) {
        this.cr(LG, (oX * this.wE) || 0, (Zg * this.rb) || 0, this.wE, this.rb, Cm || 0, Dm || 0, TQ || this.wE, TV || this.rb)
    },
    b6: function() {
        return this.Er.b6()
    },
    j5: function() {
        return this.Er.j5(this.Vd || 1)
    },
    hc: function(oX, Zg) {
        return [-this.l8 - (oX || 0) * this.wE, -this.Ez - (Zg || 0) * this.rb, ""].join("px ")
    },
    Ye: function(W7) {
        return [-this.l8 - (W7 || 0) % this.CY * this.wE, "px"].join("")
    },
    mC: function(W7) {
        return [-this.Ez - (W7 || 0) % this.bh * this.rb, "px"].join("")
    },
    ik: function(oX, Zg) {
        return [this.Er.b6(), "repeat", this.hc(oX, Zg)].join(" ")
    }
};
Image.prototype.b6 = function() {
    return ["url(", this.src, ")"].join("")
};
Image.prototype.j5 = function(Vd) {
    return [this.width / Vd, this.height / Vd, ""].join("px ")
};
IJ.jh = function(sF, HE) {
    var Ut = document.createElement("canvas");
    Ut.width = sF * window.devicePixelRatio || 1;
    Ut.height = HE * window.devicePixelRatio || 1
};
Element.implement({
    uK: function(xw, oX, Zg) {
        return this.SD(xw).cD(xw, oX, Zg)
    },
    SD: function(xw) {
        return this.nm({
            width: xw.wE + "px",
            height: xw.rb + "px"
        })
    },
    cD: function(xw, oX, Zg) {
        return this.nm({
            backgroundImage: xw.b6(),
            backgroundSize: xw.j5(),
            backgroundPosition: xw.hc(oX, Zg)
        })
    }
});
Fx.implement({
    stopTimer: function() {
        if (!this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.timer = pA.sl(this.timer);
        return true
    },
    startTimer: function() {
        if (this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.ea = this.ea || this.step.bind(this);
        this.timer = pA.aC(this.ea, Math.round(1000 / this.options.fps));
        return true
    }
}, 1);
var C3 = new Class({
    Extends: H_,
    C4: {
        uc: {}
    },
    initialize: function(X3, C4) {
        this.parent(C4);
        this.X3 = X3.addEvent("complete", this.Gn.bind(this))
    },
    VF: function() {
        this.X3.start(this.C4.uc)
    },
    yq: function() {
        this.X3.cancel();
        return this.parent()
    },
    pT: function() {
        return this.parent()
    }
});
var yL = new Class({
    Extends: s2,
    C4: {
        qR: !!He.cV.csstransitions,
        Ke: true,
        ec: 1,
        unit: "",
        transition: "linear",
        Al: 1
    },
    Yo: 0,
    BH: function(C4) {
        this.parent(C4);
        this.C4.qR && this.ZN(this.C4);
        return this
    },
    initialize: function(lI, C4) {
        this.lI = lI;
        this.BH(C4);
        if (this.C4.qR) {
            this.parent()
        } else {
            return new C3(new Fx.Morph(lI, C4), C4)
        }
    },
    zm: function(Qw) {
        this.parent(Qw);
        return this.YX()
    }
});
He.cV.csstransitions && yL.implement({
    Binds: ["FN", "NU"],
    ZN: function(C4) {
        var Uz = C4.duration + "ms",
            FH = C4.ec + "ms",
            rY = [],
            sX = [],
            XR = [],
            zO;
        this.vJ = {
            transitionProperty: "",
            transitionDuration: "",
            transitionDelay: "",
            transitionTimingFunction: ""
        };
        this.Q1 = {};
        this.t7 = 0;
        for (zO in C4.uc) {
            IO = C4.uc[zO];
            zO = zO.camelCase();
            if ($type(IO) == "array") {
                this.vJ[zO] = IO[0].toString() + this.C4.unit;
                this.Q1[zO] = IO[1].toString() + this.C4.unit
            } else {
                this.Q1[zO] = IO.toString() + this.C4.unit
            }
        }
        this.C4.Ke && yL.jC(this.Q1) && this.Ke();
        for (zO in this.Q1) {
            ++this.t7;
            rY.push(zO.hyphenate());
            sX.push(Uz);
            XR.push(FH)
        }
        this.Q1.transitionProperty = rY.join(" ,");
        this.Q1.transitionDuration = sX.join(" ,");
        this.Q1.transitionDelay = XR.join(" ,");
        this.Q1.transitionTimingFunction = yL.VA[C4.transition] || C4.transition;
        this.Dy = C4.ec + C4.duration;
        return this
    },
    Ke: function() {
        var Q1 = this.Q1,
            vJ = this.vJ,
            B0 = this.lI.Eh(),
            e6 = Q1.transform = Q1.transform || B0.n7(),
            ph = vJ.transform = vJ.transform || B0.n7();
        fb = [{
            zO: "top",
            vG: 1,
            Pk: 5
        }, {
            zO: "bottom",
            vG: -1,
            Pk: 5
        }, {
            zO: "left",
            vG: 1,
            Pk: 4
        }, {
            zO: "right",
            vG: -1,
            Pk: 4
        }];
        fb.forEach(function(zO) {
            var vG = zO.vG,
                Pk = zO.Pk,
                zO = zO.zO,
                zm, RM, KM;
            if (Q1[zO]) {
                RM = vG * parseFloat(Q1[zO]) || 0;
                KM = vG * parseFloat(vJ[zO]) || 0;
                zm = -vG * B0.AL(zO) || 0;
                ph[Pk] = zm + KM;
                e6[Pk] = zm + RM;
                delete Q1[zO];
                delete vJ[zO]
            }
        })
    },
    FN: function(tX) {
        --this.Yo == 0 && this.Gn()
    },
    NU: function() {
        this.Yo = 0;
        this.Zd && this.Gn()
    },
    YX: function() {
        if (this.t7) {
            this.lI.nm(this.vJ);
            document.body.offsetWidth;
            this.lI.addEvent("transitionend", this.FN);
            this.Yo = this.t7;
            this.lI.nm(this.Q1);
            this.uV = this.C4.Al && setTimeout(this.NU, this.Dy + 250)
        } else {
            this.Gn()
        }
    },
    Gn: function() {
        this.lI.removeEvent("transitionend", this.FN);
        this.lI.nm({
            transitionProperty: "",
            transitionDuration: "",
            transitionDelay: "",
            transitionTimingFunction: ""
        });
        document.body.offsetWidth;
        this.parent()
    }
});
yL.jC = function(zO) {
    var uk = (zO.top !== undefined),
        M7 = (zO.bottom !== undefined),
        ye = (zO.left !== undefined),
        Ig = (zO.right !== undefined);
    if (!yL.YK) {
        return false
    }
    return (uk || M7 || ye || Ig) && !(uk && M7) && !(ye && Ig)
};
yL.YK = He.Zm != "iPad" && He.cV.csstransforms && He.VD;
yL.G9 = ["top", "left", "bottom", "right"];
yL.VA = {
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
var u4 = new Class({
    Extends: Yf,
    lI: null,
    initialize: function(lI, C4) {
        this.BH(C4);
        this.P1(lI)
    },
    P1: function(lI) {
        this.lI = lI;
        return this
    },
    pT: function() {
        if (this.Zd) {
            this.Mq = this.C4.rs - 1;
            this.Ba(this.Mq, (this.C4.eT + this.C4.E8 * this.Mq) % this.C4.f_);
            this.parent()
        }
        return this
    }
});
var Nm = new Class({
    Extends: u4,
    C4: {
        dd: []
    },
    initialize: function(lI, C4) {
        C4.rs = C4.rs || C4.dd.length;
        this.parent(lI, C4)
    },
    hY: "",
    Ba: function(Mq, UG) {
        var I6 = this.C4.dd[Mq];
        this.lI.addClass(I6).removeClass(this.hY);
        this.hY = I6;
        return 1
    },
    yq: function() {
        this.lI.removeClass(this.hY);
        return this.parent()
    }
});
var Ox = new Class({
    Extends: u4,
    C4: {
        H1: "backgroundPosition",
        ED: "px 0"
    },
    initialize: function(lI, C4) {
        this.parent(lI, C4);
        this.C4.H1 = this.C4.H1.camelCase()
    },
    zm: function(Qw) {
        this.hG = this.lI ? this.lI.yF(this.C4.H1) : "";
        this.parent(Qw)
    },
    Ba: function(Mq, UG) {
        var IO = UG.toString().concat(this.C4.ED);
        this.lI.nj(this.C4.H1, IO);
        return 1
    },
    yq: function() {
        this.lI.nj(this.C4.H1, this.hG);
        return this.parent()
    }
});
var Qi = new Class({
    Extends: Ox,
    C4: {
        H1: "visibility",
        AQ: ["visible", "hidden"],
        ED: ""
    },
    BH: function(C4) {
        var j9 = C4.AQ ? C4.AQ.length : this.C4.AQ.length;
        C4.rs = C4.rs || j9;
        C4.f_ = C4.f_ || j9;
        return this.parent(C4)
    },
    Ba: function(Mq, UG) {
        this.lI.nj(this.C4.H1, this.C4.AQ[Mq] + this.C4.ED);
        return 1
    }
});
var MD = new Class({
    Extends: Qi,
    initialize: function(lI, xw, C4) {
        var N2, OJ;
        C4 = C4 || {};
        N2 = (C4.N2 || "x").toUpperCase() === "X";
        OJ = N2 ? xw.CY : xw.bh;
        C4.H1 = N2 ? "backgroundPositionX" : "backgroundPositionY";
        C4.rs = C4.rs || OJ;
        C4.AQ = (C4.AQ || Array.g5(1, C4.rs)).map(N2 ? xw.Ye : xw.mC, xw);
        this.parent(lI, C4)
    }
});
IJ.prototype.s2 = function(lI, C4) {
    return new MD(lI, this, C4)
};
Element.implement({
    Vy: function(xw, C4) {
        return new MD(this, xw, C4)
    }
});
var xy = function(s8, M7, Wz, AR, l8, Ez) {
    s8 instanceof Array ? this.push.apply(this, s8.slice(0, 6)) : this.push.call(this, s8 || 1, M7 || 0, Wz || 0, AR || 1, l8 || 0, Ez || 0)
};
xy.prototype = [];
xy.prototype.$family = {
    name: "xy"
};
$extend(xy.prototype, {
    wY: function(Kz) {
        var s8 = this[0],
            M7 = this[1],
            Wz = this[2],
            AR = this[3];
        this[0] = s8 * Kz[0] + Wz * Kz[1];
        this[1] = M7 * Kz[0] + AR * Kz[1];
        this[2] = s8 * Kz[2] + Wz * Kz[3];
        this[3] = M7 * Kz[2] + AR * Kz[3];
        this[4] = s8 * Kz[4] + Wz * Kz[5] + this[4];
        this[5] = M7 * Kz[4] + AR * Kz[5] + this[5];
        return this
    }
});
var zQ = {
    fP: function(uE, ip) {
        this[4] += uE;
        this[5] += ip;
        return this
    },
    Tx: function(uE) {
        this[4] += uE;
        return this
    },
    kn: function(ip) {
        this[5] += ip;
        return this
    },
    EJ: function(YY) {
        var tz = Math.sin(YY),
            WC = Math.cos(YY),
            s8 = this[0],
            M7 = this[1],
            Wz = this[2],
            AR = this[3];
        this[0] = s8 * WC + Wz * tz;
        this[1] = M7 * WC + AR * tz;
        this[2] = Wz * WC - s8 * tz;
        this[3] = AR * WC - M7 * tz;
        return this
    },
    tV: function(aA, AP) {
        this[0] *= aA;
        this[1] *= aA;
        this[2] *= AP;
        this[3] *= AP;
        return this
    },
    HX: function() {
        this[0] = -this[0];
        this[1] = -this[1];
        return this
    },
    uG: function() {
        this[2] = -this[2];
        this[3] = -this[3];
        return this
    },
    toString: He.cV.csstransforms3d && He.VD ? function() {
        return "matrix3d(".concat([this[0], this[1], 0, 0, this[2], this[3], 0, 0, 0, 0, 1, 0, this[4], this[5], 0, 1].join(","), ")")
    } : Browser.Engine.gecko ? function() {
        return "matrix(".concat([this[0], this[1], this[2], this[3], this[4] + "px", this[5] + "px"].join(","), ")")
    } : function() {
        return "matrix(".concat(this.join(","), ")")
    }
};
var Lf = function() {
    xy.apply(this, arguments)
};
var cM = function() {};
cM.prototype = xy.prototype;
Lf.prototype = new cM();
Lf.prototype.constructor = Lf;
$extend(Lf.prototype, zQ);
Ei = {
    e9: function(a, b, c, d, e, f) {
        return new Lf(a, b, c, d, e, f)
    }
};
Ei.e9.jT = new Lf();
(function() {
    for (var M9 in zQ) {
        Ei.e9[M9] = (function(M9) {
            return function() {
                return M9.apply(new Lf(1, 0, 0, 1, 0, 0), arguments)
            }
        })(zQ[M9])
    }
})();
sc.prototype.n7 = function() {
    var e9 = this.nW("transform");
    e9 = e9 && e9.replace(/^[^(]+/, "").match(/[-0-9.]+/g);
    e9 = e9 && e9.map(parseFloat);
    return e9 && e9.length == 16 ? new Lf(e9[0], e9[1], e9[4], e9[5], e9[12], e9[13]) : new Lf(e9)
};
var Vi = (function() {
    var ks = function() {
            this.ws = new Yf({
                eT: 1
            });
            this.ws.Ba = function(Mq, UG) {
                tW.call(this, (this.C4.eR) ? (this.s1 + UG - 1) : (this.s1 + (this.rh - this.s1) * Math.log(UG) / Math.LN10));
                return 1
            }.bind(this);
            this.ws.addEvents({
                TU: function() {
                    tW.call(this, this.rh);
                    this.s1 = this.rh
                }.bind(this)
            });
            return this.ws
        },
        tW = function(s1) {
            s1 = this.C4.Iy(s1);
            if (s1 !== this.SB) {
                return !!this.b_.set("text", this.SB = s1)
            }
        };
    return new Class({
        Extends: GM,
        Implements: [Events, gT],
        C4: {
            Iy: nl,
            ly: Ym.mf,
            eR: false,
            cB: 25
        },
        initialize: function(C4) {
            this.BH(C4);
            this.nG = this.b_ = this.C4.nG.addClass("Vi " + this.C4.gs);
            (this.C4.s1 !== undefined) && this.xd(this.C4.s1)
        },
        uu: function() {
            this.s1 = 0;
            this.b_.set("text", this.SB = "");
            this.fireEvent("Lr", [this.s1, this.SB])
        },
        xd: function(s1) {
            this.ws && this.ws.pT();
            if (tW.call(this, s1)) {
                this.s1 = this.rh = s1;
                this.fireEvent("Lr", [this.C4.ly(s1), this.SB])
            }
            return this
        },
        bu: function() {
            return this.s1 || 0
        },
        DZ: function(rh, lC) {
            var rs;
            (this.ws || ks.call(this)).pT();
            this.rh = rh;
            if (this.C4.eR) {
                rs = Math.floor(Math.abs(Ym.mf(this.rh - this.s1) / Ym.mf(lC)) * this.C4.cB);
                this.ws.BH({
                    E8: lC / this.C4.cB,
                    rs: rs,
                    cv: this.C4.cv
                })
            } else {
                rs = Math.floor(this.C4.cB + this.C4.cB * Math.log(Math.abs(Ym.mf(rh - this.s1) / Ym.mf(lC))) / Math.LN10);
                this.ws.BH({
                    rs: rs,
                    E8: 9 / rs
                })
            }
        },
        s2: function() {
            var BX = this;
            return new Nh(this.ws || ks.call(this), function() {
                return BX.rh != BX.s1
            })
        }
    })
})();
var BL = new Class({
    Extends: GM,
    initialize: function(C4) {
        this.BH(C4);
        this.nG = new Element("div", {
            id: this.C4.ix,
            "class": "BL " + this.C4.gs
        }), this.Cq = {}
    },
    VH: function(lI, aU) {
        var lI = lI instanceof Element ? lI : lI.toElement();
        if (aU !== undefined) {
            aU = this.nG.getChildren()[aU]
        }
        aU instanceof Element ? lI.inject(aU, "before") : this.nG.adopt(lI);
        return this
    },
    BW: function(tX, iC, aU) {
        (this.Cq[tX] = this.Cq[tX] || []).push(iC);
        this.VH(iC, aU);
        this.fireEvent("RS", [tX, iC]);
        return this
    },
    Ub: function(uS) {
        sq.h0(uS, this.BW.UN(1, 0).bind(this))
    },
    pj: function(QA, tX) {
        var TN, nA, Bv;
        for (TN in this.Cq) {
            if (tX && TN !== tX) {
                continue
            }
            nA = this.Cq[TN];
            nA && nA.forEach(function(iC) {
                iC.GZ(QA)
            })
        }
        return this
    },
    qV: function(QA) {
        sq.h0(this.Cq, this.pj.ku(QA).UN(1), this);
        return this
    },
    hx: function(tX) {
        this.Cq[tX].forEach(function(iC) {
            iC.removeEvents();
            iC.F_()
        });
        delete this.Cq[tX];
        return this
    },
    sI: function() {
        sq.h0(this.Cq, this.hx.UN(1).bind(this));
        return this
    }
});
var J0 = new Class({
    Extends: GM,
    Binds: ["HF", "R7"],
    initialize: function(C4) {
        this.BH(C4);
        this.nG = (new Element("div", {
            id: this.C4.ix,
            "class": this.C4.gs + " J0"
        })).adopt(this.b_ = new Element("div", {
            "class": "iE"
        }), this.Cq = new BL({
            gs: "rd"
        }).addEvent("RS", this.HF.bind(this)));
        this.addEvents({
            zf: this.R7,
            Q6: bs.m4
        })
    },
    QX: function(x8) {
        this.b_.innerHTML = "";
        this.b_.adopt(arguments).children.length || this.b_.set("html", x8);
        return this
    },
    HF: function(tX, iC) {
        iC.addEvent("uh", this.fireEvent.bind(this, tX))
    },
    R7: function() {
        this.tM(0)
    },
    BW: function(tX, iC, aU) {
        this.Cq.BW(tX, iC, aU);
        return this
    },
    Ub: function(fO) {
        sq.h0(fO, this.BW.UN(1, 0), this);
        return this
    },
    qa: function() {
        return this.BW("zf", new AE({
            gs: "zz",
            Hq: 1
        }))
    },
    pj: function(QA, tX) {
        this.Cq.pj(QA, tX);
        return this
    },
    qV: function(QA) {
        this.Cq.qV(QA);
        return this
    },
    ZZ: function(bW) {
        this.Cq.tM(bW);
        return this
    },
    hx: function(tX) {
        this.Cq.hx(tX);
        return this
    },
    sI: function() {
        this.Cq.sI();
        return this
    }
});
J0.jk = function(Pr) {
    var fl = (new Element("div", {
        "class": "Zb",
        style: "visibility:hidden"
    })).adopt(new Element("div", {
        "class": "lp"
    }).adopt(Pr));
    Pr.nG = fl;
    return Pr
};
var VX = (function() {
    var jK = function() {
            this.uA.GQ = 1;
            this.z1 = pA.P6(this.z1, E5.bind(this));
            this.fireEvent("GQ")
        },
        cX = function() {
            this.dn(this.OB);
            if (this.OB.stop) {
                this.OB = null
            } else {
                delete this.OB
            }
            this.a_();
            this.z1 = pA.sl(this.z1);
            document.body.offsetWidth;
            pA.UF(this.fireEvent.bind(this, "Lk"), 1)
        },
        Cp = function(xJ) {
            var R0 = this.uA.pb.length;
            if (this.uA.JU) {
                while (--R0 >= 0) {
                    if (0 == this.uA.pb[R0]--) {
                        this.Rs.Mf(R0);
                        --this.uA.JU
                    }
                }
            }
            this.Rs.FF(xJ > this.C4.L7 ? this.C4.L7 : xJ)
        },
        E5 = function(xJ) {
            !this.Ow && --this.uA.Uz;
            if (this.uA.GQ && this.z2) {
                if (this.z2.stop) {
                    this.OB = this.z2
                } else {
                    this.OB = this.z2.slice(0)
                }
                this.uA.Uz += Math.ceil(this.C4.vN / pA.rE());
                this.uA.Uz = Math.max(this.uA.Uz, 1);
                if (this.z2.stop) {
                    this.z2 = null
                } else {
                    delete this.z2
                }
            }
            if (this.uA.Uz == 0) {
                if (this.Rs.Gu) {
                    this.z1 = pA.P6(this.z1, wX.bind(this))
                }
            }
            this.Rs.FF(xJ > this.C4.L7 ? this.C4.L7 : xJ)
        },
        wX = function(xJ) {
            this.NZ = 0;
            var R0 = this.uA.Uv.length;
            if (this.uA.Y7 > 0) {
                while (--R0 >= 0) {
                    if (this.Rs.Yz[R0] >= this.Rs.yl.SPIN_SPINNING && 0 == this.uA.Uv[R0]--) {
                        if (this.OB.stop) {
                            this.Rs.Ey(R0, this.OB.stop[R0])
                        } else {
                            this.Rs.Ey(R0, this.OB)
                        }--this.uA.Y7
                    }
                }
            }
            this.Rs.FF(xJ > this.C4.L7 ? this.C4.L7 : xJ)
        };
    return new Class({
        Implements: [Events, gT],
        Binds: ["FZ"],
        C4: {
            Sy: 5,
            L7: 25
        },
        toElement: function() {
            return this.nG
        },
        initialize: function(C4) {
            C4.Bn.kW = C4.Bn.iB;
            C4.Bn.cm = C4.Bn.Dt;
            C4.Bn.oa = C4.Rs.f8 * C4.Bn.Pe;
            Km = function(Jp) {
                return Jp
            };
            gX = function(Jp) {
                return Jp
            };
            if (C4.LW) {
                this.LW = C4.LW;
                this.iV = {}
            }
            var ln = C4.Bn;
            this.BH(C4);
            this.C4.pb = C4.pb || Array.g5(0, 4, 1, 0);
            this.C4.Uv = C4.Uv || Array.g5(0, (ln.bK || ln.sK) - 1, (ln.bK || ln.sK), 20);
            this.C4.DR = C4.DR || Array.apply(null, new Array(ln.bK || ln.sK)).map(Number.prototype.valueOf, 1);
            this.C4.Jh = C4.t3 || C4.xC;
            this.C4.qM = C4.qM;
            var O_ = [];
            var gR = 0;
            this.C4.Bn.Hn.forEach(function(OP, UX) {
                for (var Bv = 0; Bv < OP; Bv++) {
                    var g9 = new Element("div", {
                        "class": "rP",
                        styles: {
                            position: "absolute",
                            height: ln.Pe,
                            width: ln.l9,
                            top: ln.U9[UX] + (Bv * (ln.Pe + ln.Op)),
                            left: UX * (ln.l9 + ln.rW)
                        }
                    });
                    if (C4.LW) {
                        this.iV[this.LW[gR]] = g9;
                        gR = gR + 1
                    }
                    O_.push(g9)
                }
            }, this);
            this.UC = new Elements(O_);
            var Sd = [];
            if (this.C4.k9) {
                this.C4.Bn.Hn.forEach(function(OP, UX) {
                    var cg = new Element("div", {
                        "class": "rP",
                        styles: {
                            position: "absolute",
                            height: ln.Pe,
                            width: ln.l9,
                            top: ln.U9[UX] - (ln.Pe + ln.Op),
                            left: UX * (ln.l9 + ln.rW)
                        }
                    });
                    Sd.push(cg);
                    var Rl = new Element("div", {
                        "class": "rP",
                        styles: {
                            position: "absolute",
                            height: ln.Pe,
                            width: ln.l9,
                            top: ln.OY[UX].c9 + ln.OY[UX].Dt,
                            left: UX * (ln.l9 + ln.rW)
                        }
                    });
                    Sd.push(Rl)
                }, this)
            }
            this.B8 = new Elements(Sd);
            this.nG = new Element("div", {
                "class": "qf",
                styles: {
                    position: "relative",
                    margin: "0 auto",
                    height: ln.Dt,
                    width: ln.iB
                }
            }).adopt(this.UC, this.B8);
            ln.rW && this.nG.adopt(Array.g5(0, ln.sK - 2).map(function(c1) {
                return new Element("div", {
                    "class": "Z0",
                    styles: {
                        left: ln.l9 + c1 * (ln.l9 + ln.rW)
                    }
                })
            }, this));
            this.Rs = this.C4.Rs;
            this.Rs.addEvents({
                GQ: jK.bind(this),
                Lk: cX.bind(this)
            });
            this.nG.adopt(this.Rs.Sw({
                Bn: C4.Bn
            }))
        },
        a_: function() {
            if (!this.C4.k9) {
                return
            }
            var iD = this.Rs.Kt || this.Rs.uW;
            var g8 = this.Rs.pG;
            if (!iD || !g8) {
                return
            }
            for (var Bv = 0; Bv < this.C4.Bn.sK; Bv++) {
                var V5 = this.Rs.gf[iD][Bv].length;
                this.B8[Bv * 2].className = "rP " + this.Rs.gf[iD][Bv][(g8[Bv] + (V5 - 1)) % V5];
                this.B8[(Bv * 2) + 1].className = "rP " + this.Rs.gf[iD][Bv][(g8[Bv] + this.C4.Bn.OY[Bv].SO) % V5]
            }
        },
        dn: (function() {
            var Sl = [];
            return function(z2, fJ, Ot) {
                if (z2.stop) {
                    fJ && this.Rs.Mv(z2.map, fJ, z2.stop);
                    sq.h0(z2.map, function(PM, e7) {
                        this.iV[e7].className = "rP " + PM
                    }, this)
                } else {
                    fJ && this.Rs.Mv(z2, fJ, Ot);
                    z2.forEach(function(aL, aU) {
                        this.UC[aU] && this.UC[aU].removeClass(Sl[aU]).addClass(aL)
                    }, this);
                    Sl = z2
                }
                this.UC.nj("visibility", "");
                this.B8.nj("visibility", "")
            }
        })(),
        VM: function(z2, iD) {
            if (z2.stop) {
                this.z2 = z2;
                this.Rs.Fy(z2, iD)
            } else {
                z2 = gX(z2);
                this.z2 = z2;
                this.Rs.Fy(z2, iD)
            }
        },
        Lu: function(jB) {
            jB = Km(jB);
            var CZ = [];
            for (var Bv = jB.length; Bv--;) {
                CZ[Bv] = this.UC[jB[Bv]]
            }
            return new Elements(CZ)
        },
        Gd: function() {
            if (this.z1) {
                this.UC.nj("visibility", "");
                this.B8.nj("visibility", "");
                this.Rs.Gd();
                this.z1 = pA.sl(this.z1)
            }
            this.Ow = 0
        },
        G3: function(C4) {
            this.uA = {
                Uz: 0,
                GQ: 0,
                Lk: 0,
                JU: this.C4.Bn.sK,
                Y7: this.C4.Bn.sK,
                pb: (this.C4.pb).slice(0),
                Uv: (this.C4.Uv).slice(0),
                DR: ((C4 && C4.DR) || this.C4.DR).slice(0),
                Jh: this.C4.Jh,
                qM: this.C4.qM,
                iD: C4 && C4.iD
            };
            this.Rs.Dv(this.uA);
            this.UC.nj("visibility", "hidden");
            this.B8.nj("visibility", "hidden");
            this.z1 = this.z1 || pA.aC(Cp.bind(this), this.C4.Sy)
        },
        FZ: function(jI) {
            this.Ow = !!jI
        }
    })
})();
var VL = new Class({
    Implements: [Events, gT],
    initialize: function(C4) {
        this.BH(C4)
    },
    Sw: function(C4) {
        this.BH(C4)
    },
    Dv: function(GF) {
        this.Ax = this.CX = this.C4.Bn.sK;
        this.sT = 0;
        return this
    },
    Mf: function(UX, z2) {
        --this.Ax;
        return this
    },
    Ey: function(UX, z2) {
        --this.CX;
        return this
    },
    Gd: function() {
        this.Ax = this.CX = 0;
        return this
    }
});
var Kg = (function() {
    var yl = {
            SPIN_REST: 0,
            SPIN_INIT: 2,
            SPIN_FAUX_BOUNCE_START: 4,
            SPIN_SPINUP: 6,
            SPIN_SPINNING: 8,
            SPIN_FINDEND: 10,
            SPIN_STITCH: 12,
            SPIN_STOPPING: 14,
            SPIN_STOPEND: 16,
            SPIN_FAUX_BOUNCE: 18,
            SPIN_HANDBRAKE: 99,
        },
        J9 = function J9(Ot) {
            Ot.forEach(function(dA, Bv) {
                this.pG[Bv] = this.tZ(this.Mu, Bv, dA)
            }, this);
            this.xG = false
        },
        FF = function FF(xJ) {
            if (!window.requestAnimationFrame) {
                this.CT(xJ)
            } else {
                if (!this.Wr) {
                    this.Wr = 1;
                    this.U_ = 0;
                    window.requestAnimationFrame(wC.bind(this))
                }
            }
        },
        wC = function wC(dE) {
            dE = Math.floor(dE);
            if (this.U_) {
                this.CT(dE - this.U_)
            } else {
                this.CT(0)
            }
            this.U_ = dE;
            if (this.Wr) {
                window.requestAnimationFrame(wC.bind(this))
            }
        },
        Y9 = function Y9() {
            if (this.eP && !this.eP()) {
                return false
            }
            for (var Bv = 0; Bv < this.C4.Bn.bK; Bv++) {
                if (this.Yz[Bv] != yl.SPIN_HANDBRAKE) {
                    return false
                }
            }
            return true
        },
        CT = function CT(xJ) {
            if (this.Y9()) {
                this.Wr = 0;
                this.Gd().fireEvent("Lk");
                return
            }
            if (this.M0) {
                return
            }
            this.jU = this.gf[this.Mu].length;
            this.gf[this.Mu].forEach(function(c1, R0) {
                if (this.PQ[R0] === 0) {
                    return
                }
                if (this.Yz[R0] == yl.SPIN_HANDBRAKE) {
                    return
                }
                if (this.Yz[R0] == yl.SPIN_REST) {
                    return
                }
                if (this.Yz[R0] != yl.SPIN_REST && this.Yz[R0] != yl.m7 && this.Yz[R0] != yl.SPIN_FAUX_BOUNCE_START) {
                    this.bp[R0] += xJ
                }
                var cU = this.gf[this.Mu][R0].length * this.ln.eu;
                switch (this.Yz[R0]) {
                    case yl.SPIN_REST:
                        break;
                    case yl.SPIN_INIT:
                        break;
                    case yl.SPIN_SPINUP:
                        this.HG = Math.floor((this.lJ * this.bp[R0]));
                        this.Wf[R0] = (this.Fw[R0] > 0) ? ((cU - (this.HG % (cU))) + this.QD[R0]) % cU : (this.QD[R0] + this.HG) % (cU);
                        if ((this.lJ * this.bp[R0]) > this.ln.OY[R0].Dt) {
                            this.Yz[R0] = yl.SPIN_SPINNING
                        }
                        break;
                    case yl.SPIN_SPINNING:
                        this.HG = Math.floor((this.lJ * this.bp[R0]));
                        this.Wf[R0] = (this.Fw[R0] > 0) ? ((cU - (this.HG % (cU))) + this.QD[R0]) % cU : (this.QD[R0] + this.HG) % (cU);
                        break;
                    case yl.SPIN_FINDEND:
                        this.PQ[R0] = (this.ln.Hn[R0] + 1) + this.xO;
                        var vZ = ((this.lJ * this.bp[R0])) + (this.ln.OY[R0].Dt + (this.ln.eu * 2));
                        var cU = this.gf[this.Mu][R0].length * this.ln.eu;
                        this.tA[R0] = Math.floor(vZ + (this.ln.eu - (vZ % this.ln.eu)));
                        this.dZ[R0] = this.pG[R0] * this.ln.eu;
                        this.dI[R0] = (this.ln.Hn[R0] * this.ln.eu);
                        this.Yz[R0] = yl.SPIN_STITCH;
                    case yl.SPIN_STITCH:
                        this.HG = Math.floor(this.lJ * this.bp[R0]);
                        if (this.eg[R0] > 0) {
                            this.Wf[R0] = (this.Fw[R0] > 0) ? ((cU - (this.HG % (cU))) + this.QD[R0]) % cU : (this.QD[R0] + this.HG) % (cU)
                        }
                        if (this.tA[R0] > 0) {
                            var YZ = Math.floor((this.tA[R0] - this.HG));
                            if (YZ < 0) {
                                this.eg[R0] = 0;
                                this.Yz[R0] = yl.SPIN_STOPPING
                            } else {
                                this.eg[R0] = this.ln.OY[R0].Dt + (this.ln.eu * 2) < YZ ? this.ln.OY[R0].Dt + (this.ln.eu * 2) : YZ;
                                if (this.Fw[R0] > 0) {
                                    this.AY[R0] = (this.ln.OY[R0].c9 + this.ln.OY[R0].Dt) - this.eg[R0]
                                }
                            }
                        }
                        break;
                    case yl.SPIN_STOPPING:
                        if (this.dI[R0] > 0) {
                            this.dI[R0] = Math.floor(this.dI[R0] - ((this.lJ * xJ)));
                            if (this.dI[R0] < 0) {
                                this.dI[R0] = 0
                            }
                        }
                        this.ZM = 0;
                        this.bR[R0] = 0;
                        if (this.eg[R0] <= 0 && this.dI[R0] == 0) {
                            this.jU--;
                            this.bR[R0] = 0;
                            if (this.tm) {
                                this.Yz[R0] = yl.SPIN_FAUX_BOUNCE;
                                this.fireEvent("HC", R0)
                            } else {
                                this.Yz[R0] = yl.SPIN_HANDBRAKE;
                                this.fireEvent("fT", R0)
                            }
                        }
                        break;
                    case yl.SPIN_STOPEND:
                        break;
                    case yl.SPIN_FAUX_BOUNCE_START:
                        if (this.zy[R0] >= this.PT.length) {
                            this.Yz[R0] = yl.SPIN_SPINUP;
                            this.zy[R0] = 0;
                            this.bR[R0] = 0;
                            this.bp[R0] = 0
                        } else {
                            this.bR[R0] = this.PT[this.zy[R0]++] * this.Fw[R0]
                        }
                        break;
                    case yl.SPIN_FAUX_BOUNCE:
                        if (this.zy[R0] >= this.tm.length) {
                            this.Yz[R0] = yl.SPIN_HANDBRAKE;
                            this.bR[R0] = 0;
                            this.fireEvent("fT", R0)
                        } else {
                            this.bR[R0] = this.tm[this.zy[R0]++] * this.Fw[R0]
                        }
                        this.HG = 0;
                        this.Wf[R0] = (this.Fw[R0] > 0) ? ((cU - (this.HG % (cU))) + this.QD[R0]) % cU : (this.QD[R0] + this.HG) % (cU);
                        break;
                    case yl.SPIN_HANDBRAKE:
                        break;
                    default:
                }
            }, this);
            this.HJ.Ov.save();
            this.A9 ? this.A9() : this.HJ.Hk();
            this.HJ.Ov.restore()
        };
    return new Class({
        Implements: [Events, gT],
        Extends: VL,
        initialize: function initialize(C4) {
            var Nn = {
                HJ: null,
                xO: 0,
                oo: 42,
                f8: 4,
                Vr: 200
            };
            this.FF = FF;
            this.CT = CT;
            this.Y9 = Y9;
            for (var Jk in Nn) {
                this[Jk] = C4[Jk] || Nn[Jk]
            }
            this.bR = [];
            this.eh = C4.eh;
            this.Mu = C4.Mu;
            this.A9 = C4.Kw;
            this.xT = C4.nD;
            this.eP = C4.eP;
            this.Xt = !!C4.nD;
            this.GU = [];
            this.HG = 0, this.fK = 0, this.pG = [];
            this.dI = [];
            this.Wf = [];
            this.eg = [];
            this.AY = [];
            this.Br = [];
            this.mA = [];
            this.tA = [];
            this.dZ = [];
            this.Fw = [1, 1, 1, 1, 1];
            this.QD = [];
            this.lJ = this.oo / 1000;
            this.jU = 0;
            this.gf = C4.uL;
            this.PQ = [];
            this.bp = [];
            this.q7 = [];
            this.iT = C4.iT;
            this.ZM = 0;
            this.Yz = Array.g5(1, C4.uL[C4.Mu].length, 1, 1);
            this.yl = yl;
            this.zy = []
        },
        Sw: function Sw(C4) {
            this.ln = C4.Bn;
            this.parent(C4);
            this.H0 = [];
            this.gf[this.Mu].forEach(function(c1, R0) {
                this.H0[R0] = $merge(C4.eh, {});
                this.H0[R0] = new this.eh({
                    xf: this.f8 * this.ln.Pe,
                    Uz: this.f8 * this.Vr
                })
            }, this);
            this.Yb(this.HJ);
            this.nG = document.createElement("div");
            this.nG.setAttribute("id", "Dh");
            this.nG.setAttribute("style", "visibility:hidden;position:absolute;width:" + this.ln.kW + "px;height:" + this.ln.cm + "px;");
            this.HJ.Lx(this.nG);
            this.BU();
            return this.nG
        },
        BU: function() {
            this.Lg = sq.mk(this.gf, function(gf) {
                return gf.map(function(x4, Pk) {
                    return Array.lS(x4, this.ln.Hn[Pk])
                }, this)
            }, this)
        },
        Dv: function Dv(C4) {
            delete this.Gu;
            this.M0 = 0;
            this.Fw = C4.DR;
            this.tm = C4.Jh;
            this.PT = C4.qM;
            this.gf[this.Mu].forEach(function(c1, R0) {
                this.bp[R0] = 0;
                this.q7[R0] = 0;
                this.eg[R0] = this.ln.OY[R0].Dt + (this.ln.eu * 4);
                this.AY[R0] = this.ln.OY[R0].c9 - (this.ln.eu * 2);
                this.Br[R0] = 0;
                this.Wf[R0] = (this.pG[R0]) * this.ln.eu;
                this.QD[R0] = this.Wf[R0];
                this.dI[R0] = -1;
                this.H0[R0].kp = 0;
                this.Yz[R0] = yl.SPIN_REST;
                this.zy[R0] = 0
            }, this);
            this.jU = this.gf[this.Mu].length;
            this.nG.style.visibility = "";
            this.HJ.Ov.save();
            if (C4.iD) {
                this.uW = C4.iD
            } else {
                this.uW = this.Mu
            }
            this.Kt = this.uW;
            this.A9 ? this.A9() : this.HJ.Hk();
            this.HJ.Ov.restore();
            this.parent();
            return this
        },
        Mf: function Mf(R0, z2) {
            this.parent.apply(this, arguments);
            this.PQ[R0] = -1;
            this.tA[R0] = -1;
            this.dZ[R0] = 0;
            this.mA[R0] = -1;
            this.GU[R0] = 0;
            if (this.PT) {
                this.Yz[R0] = yl.SPIN_FAUX_BOUNCE_START
            } else {
                this.Yz[R0] = yl.SPIN_SPINUP
            }
            this.Ax || this.fireEvent("GQ");
            return this
        },
        Fy: function Fy(Gu, iD) {
            if (iD) {
                this.C4.Kt = iD
            }
            if (Gu.stop) {
                this.Gu = Gu
            } else {
                this.Gu = this.Hx(Gu)
            }
        },
        Ey: function Ey(R0) {
            this.parent.apply(this, arguments);
            if (this.C4.Kt) {
                this.Kt = this.C4.Kt
            } else {
                this.Kt = this.Mu
            }
            if (this.Gu.stop) {
                this.pG[R0] = this.Gu.stop[R0]
            } else {
                this.pG[R0] = this.tZ(this.Mu, R0, this.Gu[R0])
            }
            this.Yz[R0] = yl.SPIN_FINDEND;
            this.fireEvent("Jb", R0);
            return this
        },
        Gd: function Gd() {
            this.parent.apply(this, arguments);
            this.Wr = 0;
            this.HJ.sm();
            this.nG.style.visibility = "hidden";
            return this
        },
        Yb: function Yb(HJ) {
            this.HJ = new HJ(this)
        },
        Mv: function Mv(hs, Mu, Ot) {
            this.Mu = Mu;
            this.HJ.sm();
            hs = this.Hx(gX(hs));
            if (Ot) {
                this.pG = Ot
            } else {
                J9.call(this, hs)
            }
            this.gf[this.Mu].forEach(function(c1, R0) {
                var mP, oz, V5 = this.gf[this.Mu][R0].length;
                this.bR[R0] = 0;
                this.Wf[R0] = (this.pG[R0]) * this.ln.eu;
                this.PQ[R0] = -1
            }, this)
        },
        Hx: function Hx(Gu) {
            var uk = [];
            var Md = 0;
            this.C4.Bn.Hn.forEach(function(OP, UX) {
                for (var Bv = 0; Bv < OP; Bv++) {
                    uk[UX] = uk[UX] || [];
                    uk[UX][Bv] = Gu[Md++]
                }
            }, this);
            return uk
        },
        tZ: function tZ(Mu, aM, Gu) {
            var AS = Gu.join(""),
                aU = this.Lg[Mu][aM][AS];
            if (!!aU) {
                aU = aU.getRandom()
            } else {
                aU = 0
            }
            return aU
        }
    })
})();
Array.lS = function(a, n) {
    var i, j, q, L = a.length,
        h = {};
    for (i = 0; q = "", i < L; h[q] = h[q] || [], h[q].push(i++)) {
        for (j = 0; j < n; q += a[(i + j++) % L]) {}
    }
    return h
};
pz = (function() {
    var Tq = ((navigator.userAgent.indexOf("Mozilla/5.0") > -1 && navigator.userAgent.indexOf("Android ") > -1 && navigator.userAgent.indexOf("AppleWebKit") > -1) && !(navigator.userAgent.indexOf("Chrome") > -1));
    var v6 = false;
    if (navigator.userAgent.indexOf("Chrome/") > -1) {
        var chromeVersion = navigator.userAgent.substring(navigator.userAgent.indexOf("Chrome/") + 7);
        chromeVersion = chromeVersion.substring(0, chromeVersion.indexOf("."));
        if (chromeVersion.toInt() < 20) {
            v6 = true
        }
    }
    var exports = function(XG) {
        this.XG = XG;
        this.ln = XG.C4.Bn;
        this.l8 = 0;
        this.Ez = 0;
        this.oz = 0;
        this.PM = "";
        this.Vd;
        this.Q2;
        this.FM
    };
    exports.prototype = {
        Lx: function Lx(XG) {
            var FM, ln = this.XG.C4.Bn,
                Q2 = window.devicePixelRatio || 1;
            var zW = this.ln.WA || 2;
            FM = this.FM = document.createElement("canvas");
            FM.setAttribute("width", this.ln.kW * zW);
            FM.setAttribute("height", this.ln.cm * zW);
            FM.setAttribute("style", "position:absolute;top:0px;left:0px;width:" + this.ln.kW + "px;height:" + this.ln.cm + "px;");
            Q2 = window.devicePixelRatio || 1;
            this.Ov = FM.getContext("2d");
            FM.setAttribute("z-index", "2");
            this.Ov.fillStyle = "#FFF";
            this.Ov.strokeStyle = "#000";
            this.Ov.lineWidth = 3;
            this.Ov.font = "16px consolas";
            this.Ov.textBaseline = "top";
            this.Ov.setTransform(zW / Q2, 0, 0, zW / Q2, 0, 0);
            XG.appendChild(FM)
        },
        Hk: function Hk() {
            var R0;
            this.sm();
            for (R0 = 0; R0 < this.ln.sK; R0++) {
                this.Zr(R0)
            }
        },
        Zr: function Zr(R0) {
            this.HP(R0, 0);
            this.Pt(R0, 0)
        },
        HP: function Zr(R0, F0) {
            if (!F0) {
                F0 = 0
            }
            if (bs.debugRendering) {
                if (F0 == 0) {
                    this.Ov.setFillColor("#FF0000");
                    this.Ov.fillRect(this.ln.OY[R0].Jw, this.XG.AY[R0], this.ln.l9, this.XG.eg[R0])
                }
            }
            if (!bs.c4) {
                bs.c4 = false
            }
            if (bs.c4) {
                return
            }
            var LU = 1;
            var Ih = this.XG.Wf[R0] % this.ln.eu,
                MV = (Math.floor(this.XG.Wf[R0] / this.ln.eu) + this.XG.gf[this.XG.Mu][R0].length - LU) % this.XG.gf[this.XG.Mu][R0].length;
            Ih += this.XG.bR[R0];
            if (this.XG.eg[R0] > 0) {
                for (this.oz = -LU; this.oz <= this.ln.OY[R0].SO + LU; this.oz++) {
                    this.PM = this.XG.gf[this.XG.uW][R0][MV];
                    MV = (MV + 1) % this.XG.gf[this.XG.uW][R0].length;
                    this.l8 = this.ln.OY[R0].Jw;
                    this.Ez = (this.ln.OY[R0].c9) + (this.oz * this.ln.Pe) - (Ih | 0);
                    if ((this.Ez >= this.XG.AY[R0] && (this.Ez < this.XG.AY[R0] + this.XG.eg[R0]))) {
                        var mH = this.XG.AY[R0];
                        var qE = this.XG.AY[R0] + this.XG.eg[R0];
                        if (mH < this.ln.OY[R0].c9) {
                            mH = this.ln.OY[R0].c9
                        }
                        if (qE > this.ln.OY[R0].c9 + this.ln.OY[R0].Dt) {
                            qE = this.ln.OY[R0].c9 + this.ln.OY[R0].Dt
                        }
                        if (this.XG.Xt) {
                            var tl = this.XG.xT(this.PM, F0, R0, true);
                            if (!!tl && tl != null) {
                                this.l8 += tl.P9;
                                this.Ez += tl.r1;
                                this.K2(tl.mm, {
                                    l8: this.l8,
                                    Ez: this.Ez,
                                    W7: tl.W7 ? tl.W7 : 0
                                }, {
                                    c9: this.ln.OY[R0].c9,
                                    Ab: this.ln.OY[R0].c9 + this.ln.OY[R0].Dt
                                })
                            }
                        } else {
                            this.K2(this.PM, {
                                l8: this.l8,
                                Ez: this.Ez
                            }, {
                                c9: this.ln.OY[R0].c9,
                                Ab: this.ln.OY[R0].c9 + this.ln.OY[R0].Dt
                            })
                        }
                    }
                }
            }
        },
        Kh: function Zr(R0) {},
        n5: function Zr(R0) {
            this.Ov.clearRect(this.ln.OY[R0].Jw, this.XG.AY[R0], this.ln.l9, this.XG.eg[R0])
        },
        Pt: function Zr(R0, F0) {
            if (!F0) {
                F0 = 0
            }
            if (bs.debugRendering) {
                if (F0 == 0) {
                    this.Ov.setFillColor("#0000FF");
                    if (this.XG.Fw[R0] > 0) {
                        this.Ov.fillRect(this.ln.OY[R0].Jw, this.ln.OY[R0].c9, this.ln.l9, this.XG.AY[R0] - this.ln.OY[R0].c9)
                    } else {
                        this.Ov.fillRect(this.ln.OY[R0].Jw, this.XG.AY[R0] + this.XG.eg[R0], this.ln.l9, this.ln.OY[R0].Dt + (this.ln.eu * 2) - (this.XG.eg[R0]))
                    }
                }
            }
            if (!bs.Fl) {
                bs.Fl = false
            }
            if (bs.Fl) {
                return
            }
            var Ih = this.XG.Wf[R0] % this.ln.eu,
                MV = (Math.floor(this.XG.Wf[R0] / this.ln.eu) + this.XG.gf[this.XG.Mu][R0].length) % this.XG.gf[this.XG.Mu][R0].length;
            var LU = 2;
            if (this.XG.eg[R0] == 0 || (this.XG.eg[R0] < this.ln.OY[R0].Dt + this.ln.eu * 2)) {
                Ih = this.XG.dI[R0] % this.ln.eu;
                if (this.XG.Fw[R0] < 0) {
                    Ih = (this.ln.eu - Ih) % this.ln.eu
                }
                MV = (Math.floor((this.XG.dZ[R0] + (this.XG.Fw[R0] * this.XG.dI[R0])) / this.ln.eu) + this.XG.gf[this.XG.Kt][R0].length - LU) % this.XG.gf[this.XG.Kt][R0].length;
                Ih += this.XG.bR[R0];
                var w0 = 0,
                    IR = 0;
                if (this.XG.AY[R0] > this.ln.OY[R0].c9) {
                    w0 = this.ln.OY[R0].c9;
                    IR = w0 + (this.ln.OY[R0].Dt - this.XG.eg[R0])
                } else {
                    w0 = this.ln.OY[R0].c9 + this.XG.eg[R0];
                    IR = w0 + (this.ln.OY[R0].Dt - this.XG.eg[R0])
                }
                for (this.oz = -LU; this.oz <= this.ln.OY[R0].SO + LU; this.oz++) {
                    this.PM = this.XG.gf[this.XG.Kt][R0][MV];
                    MV = (MV + 1) % this.XG.gf[this.XG.Kt][R0].length;
                    this.l8 = this.ln.OY[R0].Jw;
                    if (this.XG.Fw[R0] > 0) {
                        this.Ez = (IR - this.ln.OY[R0].Dt) + ((this.oz) * this.ln.Pe) - (Ih | 0)
                    } else {
                        this.Ez = (w0) + (this.oz * this.ln.Pe) - (Ih | 0)
                    }
                    var st = 0;
                    var sb = 0;
                    if (this.XG.Fw[R0] > 0) {
                        st = this.ln.OY[R0].c9 - (this.ln.Pe * LU);
                        sb = this.XG.AY[R0] - this.ln.Pe;
                        if (this.XG.eg[R0] <= 0) {
                            sb += this.ln.Pe
                        }
                        if (this.XG.eg[R0] == 0) {
                            sb = this.ln.OY[R0].c9 + this.ln.OY[R0].Dt
                        }
                    } else {
                        st = this.XG.AY[R0] + this.XG.eg[R0];
                        sb = st + (this.ln.OY[R0].Dt + (this.ln.eu * 2) - (this.XG.eg[R0]))
                    }
                    if (this.Ez >= st && this.Ez <= sb) {
                        if (this.XG.Xt) {
                            var tl = this.XG.xT(this.PM, F0, R0, false);
                            if (!!tl) {
                                this.l8 += tl.P9;
                                this.Ez += tl.r1;
                                this.K2(tl.mm, {
                                    l8: this.l8,
                                    Ez: this.Ez,
                                    W7: tl.W7 ? tl.W7 : 0
                                }, {
                                    c9: this.ln.OY[R0].c9,
                                    Ab: this.ln.OY[R0].c9 + this.ln.OY[R0].Dt
                                })
                            }
                        } else {
                            this.K2(this.PM, {
                                l8: this.l8,
                                Ez: this.Ez
                            }, {
                                c9: w0,
                                Ab: IR
                            })
                        }
                    }
                }
            }
        },
        Yq: function Yq(PM, Pq) {
            var xw = this.XG.iT[this.XG.Mu][PM];
            xw.Sb(this.Ov, 0, 0, Pq.l8, Pq.Ez)
        },
        K2: function Yq(PM, Pq, RH) {
            var xw = this.XG.iT[this.XG.Mu][PM];
            var NF = (Pq.Ez < RH.c9) ? RH.c9 - Pq.Ez : 0;
            if (NF >= xw.rb) {
                return
            }
            var pC = (Pq.Ez + xw.rb > RH.Ab) ? (Pq.Ez + xw.rb) - RH.Ab : 0;
            if (pC >= xw.rb) {
                return
            }
            var start_x = 0;
            if (Pq.W7) {
                start_x = xw.wE * Pq.W7
            }
            xw.cr(this.Ov, start_x, NF, xw.wE, xw.rb - (NF + pC), Pq.l8, Pq.Ez + NF, xw.wE, xw.rb - (NF + pC))
        },
        pP: function pP(R0) {
            var Q2 = window.devicePixelRatio || 1;
            this.Ov.beginPath();
            this.Ov.rect(this.ln.OY[R0].Jw * Q2, this.ln.OY[R0].c9 * Q2, this.ln.OY[R0].iB * Q2, this.ln.OY[R0].Dt * Q2);
            this.Ov.clip()
        },
        xc: function xc() {
            if (v6) {
                return
            }
            var zW = this.ln.WA || 2;
            var Q2 = window.devicePixelRatio || 1;
            this.Ov.setTransform(zW, 0, 0, zW, 0, 0);
            var numberOfReels = this.ln.OY.length;
            this.Ov.setFillColor("#FF0000");
            this.Ov.beginPath();
            this.Ov.moveTo(this.ln.OY[0].Jw, this.ln.OY[0].c9 + this.ln.OY[0].Dt);
            for (var i = 0; i < numberOfReels; i++) {
                this.Ov.lineTo(this.ln.OY[i].Jw, this.ln.OY[i].c9);
                this.Ov.lineTo(this.ln.OY[i].Jw + this.ln.OY[i].iB + this.ln.rW, this.ln.OY[i].c9)
            }
            for (var i = numberOfReels - 1; i >= 0; i--) {
                this.Ov.lineTo(this.ln.OY[i].Jw + this.ln.OY[i].iB + this.ln.rW, this.ln.OY[i].c9 + this.ln.OY[i].Dt);
                this.Ov.lineTo(this.ln.OY[i].Jw, this.ln.OY[i].c9 + this.ln.OY[i].Dt)
            }
            this.Ov.closePath();
            this.Ov.clip();
            this.Ov.setTransform(zW / Q2, 0, 0, zW / Q2, 0, 0)
        },
        sm: function sm() {
            this.Ov = this.FM.getContext("2d");
            this.Ov.save();
            this.Ov.setTransform(1, 0, 0, 1, 0, 0);
            this.Ov.clearRect(0, 0, this.Ov.canvas.width, this.Ov.canvas.height);
            if (Tq) {
                this.FM.style.opacity = 0.99;
                setTimeout(function() {
                    this.FM.style.opacity = 1
                }.bind(this), 0)
            }
            this.Ov.restore()
        },
        PH: function PH(l8, Ez, sF, HE) {
            var dpr_adjust = window.devicePixelRatio || 1;
            l8 = l8 * dpr_adjust;
            Ez = Ez * dpr_adjust;
            sF = sF * dpr_adjust;
            HE = HE * dpr_adjust;
            this.Ov.clearRect(l8, Ez, sF, HE)
        }
    };
    return exports
})();

function WV(C4) {
    this.fd = C4.fd;
    this.HU = C4.HU;
    this.xf = C4.xf;
    this.Uz = C4.Uz;
    this.K0 = 0
}
WV.prototype = {
    oO: function(t) {
        return t * t * t
    },
    qm: function(t) {
        return 3 * t * t * (1 - t)
    },
    LH: function(t) {
        return 3 * t * (1 - t) * (1 - t)
    },
    CH: function(t) {
        return (1 - t) * (1 - t) * (1 - t)
    },
    Ar: function(T3) {
        var rO = T3 / this.Uz;
        return this.fd * this.qm(rO) + this.HU * this.LH(rO) + this.CH(rO)
    },
    Vk: function(K0) {
        this.K0 = K0
    }
};

function cR(C4) {
    this.xf = C4.xf;
    this.Uz = C4.Uz;
    this.K0 = 0
}
cR.prototype = {
    Ar: function(T3) {
        return this.xf * ((T3 = T3 / this.Uz - 1) * T3 * T3 + 1) + this.K0
    }
};

function EL(C4) {
    this.xf = C4.xf;
    this.Uz = C4.Uz;
    this.K0 = 0
}
EL.prototype = {
    Ar: function(T3) {
        return this.xf * (T3 / this.Uz) + this.K0
    },
    Vk: function(K0) {
        this.K0 = K0
    }
};
var W1 = (function() {
    var Tq = ((navigator.userAgent.indexOf("Mozilla/5.0") > -1 && navigator.userAgent.indexOf("Android ") > -1 && navigator.userAgent.indexOf("AppleWebKit") > -1) && !(navigator.userAgent.indexOf("Chrome") > -1));
    return new Class({
        Implements: [gT],
        zw: null,
        Yw: null,
        tT: null,
        C4: {
            hi: [],
            Bn: null,
            GG: 2,
            pL: 3,
            I8: "#000000",
            m3: "miter",
            wn: "butt",
            XT: ""
        },
        toElement: function() {
            return this.Yw
        },
        initialize: function(zw, C4) {
            this.BH(C4);
            this.Yw = new Element("div", {
                id: "pp"
            });
            var Bn = this.C4.Bn,
                lN = this.C4.pL,
                oE = Bn.Pe,
                bw = Bn.l9,
                aH = Bn.rW,
                S0 = Bn.Op,
                sK = Bn.sK,
                iP = this.C4.gQ.length / Bn.sK,
                kW = (bw + aH) * sK - aH,
                cm = (oE + S0) * iP - S0,
                KA = (Bn.iB - kW) / 2,
                zs = (Bn.Dt - cm) / 2,
                Q2 = window.devicePixelRatio || 1;
            zW = 2;
            this.zW = zW;
            this.Q2 = Q2;
            pZ = function(Jp) {
                return Jp
            };
            Km = function(Jp) {
                return Jp
            };
            if (C4.Bn.u2) {
                M1 = Array.g5(0, (C4.Bn.u2 * (C4.Bn.EU)) - 1).map(function(vn) {
                    return Math.floor(((vn % C4.Bn.u2) * (C4.Bn.EU)) + Math.floor(vn / C4.Bn.u2))
                }, this);
                E3 = function(bq) {
                    return bq.map(function(Bv, Ig) {
                        return M1[Bv]
                    }, this)
                }
            } else {
                E3 = Km
            }
            if (C4.WO) {
                zw.forEach(function(data) {
                    if (data.hs) {
                        data.hs = this.E3(data.hs)
                    }
                })
            }
            this.zw = this.JJ(zw);
            this.cc = [];
            if (this.C4.Bn.u2) {
                this.C4.Bn.Hn.forEach(function(vn, Bv) {
                    for (var ye = 0; ye < vn; ye++) {
                        this.cc.push([this.C4.Bn.OY[Bv].Jw + (lN / 2), this.C4.Bn.OY[Bv].c9 + (lN / 2), bw - lN, oE - lN])
                    }
                }, this)
            } else {
                this.C4.Bn.Hn.forEach(function(vn, Bv) {
                    for (var ye = 0; ye < vn; ye++) {
                        this.cc.push([KA + Bv * (bw + aH) + lN / 2, this.C4.Bn.U9[Bv] + ye * (oE + S0) + lN / 2, bw - lN, oE - lN])
                    }
                }, this)
            }
            this.tT = new Element("canvas", {
                width: this.C4.Bn.iB * zW,
                height: this.C4.Bn.Dt * zW,
                styles: {
                    width: this.C4.Bn.iB,
                    height: this.C4.Bn.Dt
                }
            });
            this.tT.getContext("2d").scale(zW, zW);
            this.NS = this.C4.hi.filter(function(hX) {
                return hX < zw.length
            }).map(function(hX) {
                var nG = this.tT.clone(),
                    Ov = nG.getContext("2d"),
                    NQ = 0;
                Ov.scale(zW, zW);
                while (NQ++ < hX) {
                    this.Bx(Ov, this.zw[NQ])
                }
                return nG
            }, this);
            this.Zn(this.C4.kQ);
            this.tT.nm({
                position: "relative"
            });
            this.C4.Dj.forEach(function(nG, Bv) {
                var I1 = this[Bv];
                nG && nG.nm({
                    position: "absolute",
                    top: (I1.vc[0][1] - nG.firstElementChild.height / 2) + "px",
                    transform: Ei.e9.tV(I1.Jw ? 1 : -1, 1)
                }) && nG.nj(I1.Jw ? "left" : "right", (I1.gc === void(0) ? -2 : I1.gc) + "px")
            }, this.zw);
            this.Yw.adopt(this.tT, this.NS, this.C4.Dj)
        },
        e0: function(sU) {
            var Ov = this.tT.getContext("2d");
            Ov.setTransform(this.zW, 0, 0, this.zW, 0, 0);
            this.IP();
            sU.forEach(function(Rf) {
                this.Bx(Ov, this.zw[Rf.tH], Rf.tH && !this.zw[Rf.tH].HM ? null : Rf.RE)
            }, this);
            return this
        },
        IP: function() {
            var Ov = this.tT.getContext("2d");
            Ov.save();
            Ov.setTransform(1, 0, 0, 1, 0, 0);
            Ov.clearRect(0, 0, Ov.canvas.width, Ov.canvas.height);
            if (Tq) {
                this.tT.nj("opacity", 0.99);
                setTimeout(function() {
                    this.tT.nj("opacity", 1)
                }.bind(this), 0)
            }
            Ov.restore()
        },
        pJ: function(sU) {
            var Ov = this.tT.getContext("2d");
            this.IP();
            sU.forEach(function(Rf) {
                this.Bx(Ov, this.zw[Rf.tH], Rf.RE)
            }, this);
            return this
        },
        iF: function(Rf) {
            var Bv = Rf.tH,
                Ov = this.tT.getContext("2d");
            this.IP();
            Ov.setTransform(this.zW, 0, 0, this.zW, 0, 0);
            this.Bx(Ov, this.zw[Bv], Km(Rf.RE), Rf.p0);
            return this
        },
        M_: function(tM) {
            !tM && this.IP();
            this.tT.style.visibility = (tM ? "visible" : "");
            return this
        },
        R6: function(bW) {
            if (this.kQ) {
                this.kQ.style.visibility = bW ? "visible" : ""
            }
        },
        Zn: function(V0, bW) {
            this.R6(0);
            this.kQ = this.NS[this.C4.hi.indexOf(V0)];
            this.C4.Dj.forEach(function(uP, Rj) {
                uP && (Rj <= V0 ? uP.removeClass("UL") : uP.addClass("UL"))
            });
            this.R6(bW);
            return this
        },
        Bx: function(Ov, Ng, RE, p0) {
            var C4 = this.C4,
                NQ = 0,
                vc = Ng.vc;
            Ov.lineCap = C4.wn;
            Ov.lineJoin = C4.m3;
            if (vc && vc.length) {
                Ov.beginPath();
                Ov.moveTo(vc[NQ][0], vc[NQ][1]);
                while (++NQ < vc.length) {
                    Ov.lineTo(vc[NQ][0], vc[NQ][1])
                }
                Ov.strokeStyle = C4.I8;
                Ov.lineWidth = C4.pL;
                Ov.stroke();
                Ov.strokeStyle = Ng.P8;
                Ov.lineWidth = C4.GG;
                Ov.stroke()
            }
            RE && RE.forEach(function(vt) {
                var Pq = this[vt];
                Ov.clearRect(Pq[0], Pq[1], Pq[2], Pq[3]);
                Ov.beginPath();
                Ov.moveTo(Pq[0], Pq[1]);
                Ov.lineTo(Pq[0] + Pq[2], Pq[1]);
                Ov.lineTo(Pq[0] + Pq[2], Pq[1] + Pq[3]);
                Ov.lineTo(Pq[0], Pq[1] + Pq[3]);
                Ov.closePath();
                Ov.globalCompositeOperation = "destination-over";
                Ov.strokeStyle = C4.I8;
                Ov.lineWidth = C4.pL;
                Ov.stroke();
                Ov.beginPath();
                Ov.moveTo(Pq[0], Pq[1]);
                Ov.lineTo(Pq[0] + Pq[2], Pq[1]);
                Ov.lineTo(Pq[0] + Pq[2], Pq[1] + Pq[3]);
                Ov.lineTo(Pq[0], Pq[1] + Pq[3]);
                Ov.closePath();
                Ov.globalCompositeOperation = "source-over";
                Ov.strokeStyle = Ng.P8;
                Ov.lineWidth = C4.GG;
                Ov.stroke()
            }, this.cc);
            p0 && p0.forEach(function(vt) {
                var Pq = this[vt];
                Ov.beginPath();
                Ov.moveTo(Pq[0], Pq[1] + Pq[3] / 2);
                Ov.lineTo(Pq[0] + Pq[2], Pq[1] + Pq[3] / 2);
                Ov.stroke()
            }, this.cc)
        },
        JJ: function(zw) {
            var gB = function(vc) {
                    var YY, Hu, WC, BK, mq = 0;
                    while (++mq < this.length / 2) {
                        YY = this[mq - 1];
                        Hu = this[mq];
                        WC = this[mq + 1];
                        if (Math.abs(YY[1] - Hu[1]) < Zj) {
                            BK = WC[1] - Hu[1];
                            if (BK) {
                                Hu[0] += (WC[0] - Hu[0]) * (YY[1] - Hu[1]) / BK
                            }
                            Hu[1] = YY[1]
                        }
                    }
                    return this
                },
                Bn = this.C4.Bn,
                gq = this.C4.Bn.gq || 0,
                bw = Bn.l9,
                oE = Bn.Pe,
                sK = Bn.sK,
                iP = this.C4.gQ.length / Bn.sK,
                u2 = Bn.u2 || Bn.sK,
                EU = Bn.EU || iP,
                Zj = oE / 2,
                Tg = bw / 2,
                aH = Bn.rW,
                S0 = Bn.Op,
                kW = (bw + aH) * u2 - aH,
                cm = (oE + S0) * EU - S0,
                KA = (Bn.iB - kW) / 2,
                zs = (Bn.Dt - cm) / 2,
                L8, HS;
            zw.forEach(function(L8) {
                var vc = L8.vc,
                    XD, zt, e1;
                if (vc) {
                    var gc = (L8.gc + 2 || 0);
                    vc[0] = [L8.Jw ? gc : Bn.iB - gc, vc[0] + zs];
                    vc[1] = [L8.Jw ? Bn.iB - KA - gq : KA + gq, vc[1] + zs];
                    XD = vc.pop();
                    L8.hs.forEach(function(mm) {
                        zt = KA + Tg + mm % u2 * (bw + aH);
                        e1 = zs + Zj + Math.floor(mm / u2) * (oE + S0) + L8.xu;
                        vc.push([zt, e1])
                    });
                    if (gq !== 0) {
                        var D5 = gq / (L8.Jw ? XD[0] - zt : zt - XD[0]);
                        XD[1] = XD[1] - ((XD[1] - e1) * D5)
                    }
                    vc.push(XD);
                    gB.call(vc).reverse();
                    gB.call(vc).reverse()
                }
            });
            return zw
        },
        F1: function(oq, rg, Zv, Xk, tN) {
            var Bn = this.C4.Bn,
                sK = Bn.sK,
                iP = Bn.IX || Bn.iP;
            if (this.C4.Bn.u2) {
                sK = this.C4.Bn.u2;
                iP = this.C4.Bn.EU
            }
            var Q2 = window.devicePixelRatio || 1,
                zW = 2,
                qg = rg * iP + 1,
                KJ = oq * sK + 1,
                l8, Ez, Qa = 1,
                DB = 0.5,
                FM, Ov;
            FM = new Element("canvas", {
                width: KJ * zW,
                height: qg * zW,
                styles: {
                    width: KJ,
                    height: qg
                }
            });
            Ov = FM.getContext("2d");
            Ov.scale(zW, zW);
            Ov.fillStyle = "#fff";
            Ov.fillRect(1, 1, KJ - 1, qg - 1);
            Ov.globalCompositeOperation = "source-over";
            Ov.fillStyle = (tN) ? tN : (this.C4.XT === "") ? Zv.P8 : this.C4.XT;
            Zv.hs.forEach(function(aU) {
                Ez = oq * Math.floor(aU / sK);
                l8 = rg * (aU % sK), Ov.fillRect(l8 + 1, Ez + 1, oq - 1, rg - 1)
            });
            Ov.globalCompositeOperation = "source-over";
            Ov.lineWidth = Qa;
            Ov.strokeStyle = "#000";
            Ov.strokeRect(DB, DB, KJ - Qa, qg - Qa);
            Ov.strokeStyle = "#444";
            Ov.beginPath();
            for (l8 = oq; l8 < KJ - 1; l8 += oq) {
                Ov.moveTo(l8 + DB, Qa);
                Ov.lineTo(l8 + DB, qg - Qa)
            }
            Ov.stroke();
            Ov.beginPath();
            for (Ez = rg; Ez < qg - 1; Ez += rg) {
                Ov.moveTo(Qa, Ez + DB);
                Ov.lineTo(KJ - Qa, Ez + DB)
            }
            Ov.stroke();
            return (new Element("div", {
                "class": "Cj"
            })).adopt(new Element("div", {
                "class": "Zw",
                html: Xk
            }), FM)
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
var q6 = (function() {
    var oY = Object.freeze(function() {
        var oY = {};
        oY.Rb = {};
        (function() {
            window.AudioContext = window.AudioContext || window.webkitAudioContext;
            if (navigator.userAgent.indexOf("Chrome/11.") > -1 && navigator.userAgent.indexOf("Linux x86_64") > -1) {
                oY.Rb.dk = 0
            } else {
                if ((navigator.userAgent.indexOf("4.1.1") > -1 || navigator.userAgent.indexOf("4.1.2") > -1) && (navigator.userAgent.indexOf("GT-I9300") > -1 || navigator.userAgent.indexOf("GT-I9100") > -1)) {
                    oY.Rb.dk = 0
                } else {
                    window.AudioContext ? oY.Rb.dk = 1 : oY.Rb.dk = 0
                }
            }
        })();
        Object.freeze(oY.Rb);
        return Object.freeze(oY)
    })();
    CD = function(Z_) {
        this.cL += Z_ / 1000;
        if (this.cL >= this.o7) {
            --this.rR;
            this.cL = this.Pz
        }
        if (this.rR === 0) {
            this.s0 = pA.sl(this.s0);
            this.cL = this.Pz = this.o7 = void 0;
            this.bO && bO.call(this);
            rK(this, "T7", this.Pz)
        }
    }, bO = function() {
        sq.IU(this, this.bO);
        this.QZ(this.sZ);
        delete this.bO
    }, rK = function(BX, tX, jP) {
        setTimeout(BX.fireEvent.bind.apply(BX.fireEvent, arguments), 0)
    };
    return new Class({
        Implements: Events,
        qB: function() {
            return 0
        },
        Sa: function(Yp, Ne, aF) {
            aF = aF || 0;
            var Yp = this.yQ[Yp];
            this.hA = Yp;
            return this.Hi.apply(this, Yp.concat(Ne, aF))
        },
        Vt: function(Yp) {
            var Yp = this.yQ[Yp];
            return this.lm.apply(this, Yp)
        },
        wz: function(Yp) {
            var Yp = this.yQ[Yp];
            return this.dg.apply(this, Yp)
        },
        Gy: function(tX, AN) {
            return new w5(new xa(this, tX, AN))
        },
        rx: function(Yp, Ne, aF) {
            return this.Gy("Ku").addEvent("FG", this.Vt.bind(this, Yp, Ne, aF))
        },
        Jn: function(Yp, Ne, aF) {
            return this.Gy("JP").addEvent("FG", this.Sa.bind(this, Yp, Ne, aF))
        },
        Rv: function(Yp, Ne, aF) {
            return this.Gy("T7").addEvent("FG", this.Sa.bind(this, Yp, Ne, aF))
        },
        initialize: function(x5, Z6) {
            var Kk = function() {
                    this.vy()
                },
                Ic = function() {
                    this.pK()
                },
                VR = function() {
                    this.x3()
                },
                kY = function() {
                    if (document.hidden) {
                        this.vy()
                    } else {
                        this.pK()
                    }
                };
            window.addEventListener("pagehide", Kk.bind(this), false);
            window.addEventListener("focusout", Kk.bind(this), false);
            window.addEventListener("pageshow", Ic.bind(this), false);
            window.addEventListener("focusin", Ic.bind(this), false);
            window.addEventListener("focus", Ic.bind(this), false);
            window.addEventListener("beforeunload", VR.bind(this), false);
            window.addEventListener("unload", VR.bind(this), false);
            document.addEventListener("webkitvisibilitychange", kY.bind(this), false);
            document.addEventListener("visibilitychange", kY.bind(this), false);
            this.nF = oY.Rb.dk && Z6.R_ > 0 ? q6.Ek(x5) : q6.PU(x5);
            this.yQ = Z6.MF || []
        },
        u1: function() {
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
        Rn: function(fc) {
            this.bO = fc;
            this.cL || bO.call(this);
            var apitsModule = APITS(fc.u1())
        },
        Hi: function(KM, j9, Ne) {
            this.s0 = this.s0 && pA.sl(this.s0);
            this.Pz = this.cL = KM;
            this.o7 = KM + j9;
            this.rR = Ne || 1;
            this.s0 = pA.aC(CD.bind(this), 100);
            rK(this, "JP", this.Pz);
            return this
        },
        lm: function(KM) {
            rK(this, "Ku", KM);
            return this
        },
        vy: function() {
            this.s0 = this.s0 && pA.sl(this.s0);
            rK(this, "Wu");
            return this
        },
        x3: function() {
            this.s0 = this.s0 && pA.sl(this.s0);
            this.cL = this.Pz = this.o7 = void 0;
            rK(this, "zK");
            return this
        },
        Nz: function() {
            this.x3()
        },
        dg: function(KM) {
            var KB = this.Pz;
            return KM ? KB === KM : KB
        },
        pK: function(KM) {
            this.s0 = this.cL && pA.aC(CD.bind(this), 100);
            return this
        },
        QZ: function(VI) {
            this.sZ = !!VI
        },
        ap: function() {
            return this.sZ
        }
    })
})();
DF.hJ("audio/*", function(Ct) {
    Zi.gY = new q6("audio", {
        R_: this.R_,
        MF: this.MF
    });
    if (Zi.gY.nF) {
        var JV = J0.jk(new J0({
                ix: "JV",
                gs: "ow yC"
            })),
            bn = function(JV) {
                JV.tM(0);
                JV.nG.destroy();
                Zi.gY.addEvents({
                    load: this.Q3,
                    error: this.A_,
                    abort: this.A_
                }).nF("audio", this.ew.split(",").map(function(x5) {
                    var a = document.createElement("a");
                    a.href = Ct + this.Jl + "&Accept=" + x5;
                    a.protocol = "http";
                    return {
                        type: x5,
                        src: a.href
                    }
                }, this), this.z0 && sq.mk(this.z0, function(Bv, Wz) {
                    var a = document.createElement("a");
                    a.href = Ct + this.Jl + "&Accept=" + AW(this.ew);
                    a.protocol = window.location.protocol;
                    a.pathname = a.pathname + "/" + this.z0[Wz];
                    var Dk = a.href;
                    return Dk
                }, this))
            },
            hV = function(JV) {
                JV.nG.destroy();
                Zi.gY.Rn(Zi.gY);
                this.Q3()
            },
            AW = function(ew) {
                var SA = new Audio();
                var CO = ew.split(",");
                var Ea = {};
                var i = CO.length;
                while (--i >= 0) {
                    Ea[SA.canPlayType(CO[i])] = CO[i]
                }
                return Ea.probably || Ea.maybe || void 0
            };
        JV.Ub({
            zb: new AE({
                uo: zS("audioLoader.yes"),
                Hq: 1
            }),
            zf: new AE({
                uo: zS("audioLoader.no"),
                Hq: 1
            })
        }).addEvents({
            zb: bn.bind(this, JV),
            zf: hV.bind(this, JV)
        }).QX(zS("audioLoader.confirm"));
        document.body.adopt(JV);
        JV.tM(1)
    } else {
        this.Q3()
    }
});
q6.PU = (function() {
    var KX = function(s8, M7) {
            return (s8 - M7) * (s8 - M7) < 0.00001
        },
        PB = function() {
            if (this.Ur) {
                this.ZS = this.Ur;
                this.Ur = void 0;
                this.fireEvent("Ku", this.ZS);
                this.ZS === this.Gg && Sh.call(this)
            }
        },
        nx = function() {
            if (this.Pz && this.nG.currentTime >= this.o7) {
                if (--this.rR) {
                    this.Hi(this.Pz, this.o7 - this.Pz, this.rR)
                } else {
                    this.W4 = this.Pz;
                    this.nG.pause()
                }
                this.Pz = void 0
            } else {
                if (!this.o7) {
                    this.nG.currentTime = this.Ur || 0;
                    this.nG.pause()
                }
            }
        },
        vb = function() {
            if (this.W4) {
                this.o7 = this.Ur = this.ZS = this.Gg = this.rR = this.Pz = void 0;
                this.fireEvent("T7", this.W4);
                this.W4 = void 0
            } else {
                if (this.Pz) {
                    this.fireEvent("Wu")
                }
            }
        },
        Sh = function() {
            if (this.ZS === this.Gg) {
                this.Pz = this.Gg;
                this.Ur = this.ZS = this.Gg = void 0;
                this.fireEvent("JP", this.Pz);
                this.nG.play()
            }
        },
        bF = {
            qB: function() {
                return 0
            },
            u1: function() {
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
            Hi: function(KM, j9, Ne, aF) {
                aF = aF || 0;
                if (aF == 0) {
                    this.rR = Ne || 1;
                    this.Gg = KM;
                    this.o7 = KM + j9;
                    this.ZS === KM && Sh.call(this, this.o7);
                    this.Ur === KM || this.lm(KM)
                } else {}
                return this
            },
            lm: function(KM) {
                if (this.Ur !== KM) {
                    this.nG.currentTime = this.Ur = KM
                }
                return this
            },
            vy: function() {
                this.nG.pause();
                return this
            },
            x3: function(ix) {
                if (!ix) {
                    this.nG.pause();
                    this.o7 = this.Ur = this.ZS = this.Gg = this.rR = this.Pz = void 0
                } else {}
                return this
            },
            Nz: function() {
                this.x3()
            },
            pK: function() {
                this.dg() && this.nG.play();
                return this
            },
            dg: function(KM) {
                var KB = this.Gg || this.Pz;
                return KM ? KB === KM : KB
            },
            QZ: function(VI) {
                this.nG.muted = !!VI
            },
            ap: function() {
                return this.nG.muted
            }
        },
        Jm = function(x5, lL) {
            var nG, NM, Py, OQ = function() {
                    this.fireEvent("load")
                }.bind(this),
                wG = function() {
                    this.fireEvent("load")
                }.bind(this),
                yK = function() {
                    TG.call(this)
                }.bind(this),
                H8 = function() {
                    NM && clearTimeout(NM);
                    NM = setTimeout(this.fireEvent.bind(this, "load"), 20000)
                }.bind(this),
                TG = function() {
                    NM && clearTimeout(NM);
                    this.nG.removeEventListener("progress", H8, true);
                    this.nG.removeEventListener("error", OQ, true);
                    this.nG.removeEventListener("abort", wG, true);
                    this.nG.removeEventListener("canplaythrough", yK, true);
                    H8 = OQ = wG = TG = void 0;
                    this.Rn(bF);
                    this.fireEvent("load")
                };
            nG = new Element(x5);
            nG.addEventListener("seeked", PB.bind(this));
            nG.addEventListener("ended", vb.bind(this));
            nG.addEventListener("pause", vb.bind(this));
            nG.addEventListener("timeupdate", nx.bind(this));
            nG.addEventListener("canplaythrough", yK, true);
            nG.addEventListener("error", OQ, true);
            nG.addEventListener("abort", wG, true);
            nG.addEventListener("progress", H8, true);
            this.nG = nG;
            this.nG.preload = "none";
            this.nG.adopt(lL.map(function(x0) {
                return new Element("source", x0)
            }));
            if (He.Q_ === "U6" && He.n_ >= 8) {
                this.nG.play()
            } else {
                this.nG.load()
            }
            this.nG.preload = "auto";
            NM = setTimeout(this.fireEvent.bind(this, "load"), 20000);
            return this
        };
    return function(x5) {
        var ZE = !(He.Q_ == "Lj" && He.n_ < 2.3) && !(He.Q_ == "U6" && He.n_ < 4) && document.createElement(x5).play;
        return ZE && Jm
    }
})();
q6.Ek = (function() {
    var KX = function(s8, M7) {
            return (s8 - M7) * (s8 - M7) < 0.00001
        },
        Gj = [],
        x0, Z9 = [],
        Bw = [],
        ZF = null,
        vb = function() {
            if (this.W4) {
                this.o7 = this.Ur = this.ZS = this.Gg = this.rR = this.Pz = void 0;
                this.fireEvent("T7", this.W4);
                this.W4 = void 0
            } else {
                if (this.Pz) {
                    this.fireEvent("Wu")
                }
            }
        },
        Sh = function() {
            if (this.ZS === this.Gg) {
                this.Pz = this.Gg;
                this.Ur = this.ZS = this.Gg = void 0;
                this.fireEvent("JP", this.Pz);
                this.nG.play()
            }
        },
        l_ = function(vC) {
            for (var i in Bw) {
                if (Bw[i].aF == vC && Bw[i].aF != undefined) {
                    bF.x3(Bw[i].gn)
                }
            }
        },
        P_ = function() {
            for (var i in Bw) {
                if (Bw[i].gn != undefined) {
                    bF.x3(Bw[i].gn)
                }
            }
        },
        bF = {
            qB: function() {
                return 1
            },
            u1: function() {
                var soundPlayer = {
                    play: function(id, loop, channel) {
                        bF.Hi(id, loop, channel)
                    },
                    stop: function(id) {
                        bF.x3(id)
                    },
                    createTrack: function() {
                        return {
                            schedule: function schedule() {}
                        }
                    },
                    decode: function(id, buffer, successCallback, failureCallback) {
                        ZF.decodeAudioData(buffer, function(WU) {
                            Gj[id] = WU;
                            successCallback()
                        }, function() {
                            failureCallback(new Error('Failed to decode buffer for sound "' + id + '"'))
                        })
                    },
                    format: "audio/mpeg"
                };
                return soundPlayer
            },
            Sa: function(Yp, Ne, aF) {
                aF = aF || 0;
                this.hA = Yp;
                return this.Hi.call(this, Yp, Ne, aF)
            },
            Hi: function(KM, Ne, aF) {
                x0 = ZF.createBufferSource();
                x0.buffer = Gj[KM];
                x0.loop = Ne > 1 ? true : false;
                var gV = {
                    x0: x0,
                    gn: KM,
                    aF: aF
                };
                if (aF == 0) {
                    l_(aF)
                } else {
                    this.x3(KM)
                }
                Bw[KM] = gV;
                x0.connect(Z9.master);
                (typeof x0.start === "undefined") ? x0.noteGrainOn(0, 0, x0.buffer.duration): x0.start(0);
                return this
            },
            lm: function(KM) {
                return this
            },
            vy: function() {
                Z9.master.gain.value = 0;
                return this
            },
            x3: function(G8) {
                if (Bw[G8]) {
                    if (navigator.userAgent.indexOf("like Mac OS X") >= 0 && navigator.userAgent.indexOf("6_") >= 0) {
                        if (Bw[G8].x0.playbackState == x0.PLAYING_STATE || Bw[G8].x0.playbackState == x0.SCHEDULED_STATE) {
                            Bw[G8].x0.noteOff(0)
                        }
                    } else {
                        if (Bw[G8].x0.playbackState == x0.PLAYING_STATE || Bw[G8].x0.playbackState == x0.SCHEDULED_STATE) {
                            Bw[G8].x0.stop(0)
                        }
                    }
                    delete Bw[G8]
                }
                this.o7 = this.Ur = this.ZS = this.Gg = this.rR = this.Pz = void 0;
                return this
            },
            Nz: function() {
                P_()
            },
            pK: function() {
                Z9.master.gain.value = 1;
                this.dg();
                return this
            },
            dg: function(KM) {
                if (Bw[KM] && Bw[KM].x0.playbackState == x0.PLAYING_STATE) {
                    return true
                }
                return false
            },
            wz: function(Yp) {
                return this.dg.call(this, Yp)
            },
            QZ: function(VI) {},
            ap: function() {
                return false
            }
        },
        Jm = function(x5, lL, MF) {
            var nG, NM, Py, OQ = function(e) {
                    this.fireEvent("error")
                }.bind(this),
                mJ = function() {
                    if (Object.keys(Gj).length >= Object.keys(MF).length) {
                        NM = setTimeout(this.fireEvent.bind(this, "load"), 1)
                    }
                }.bind(this),
                wG = function(e) {
                    this.fireEvent("abort")
                }.bind(this),
                yK = function() {
                    TG.call(this)
                }.bind(this),
                H8 = function() {}.bind(this),
                TG = function() {
                    NM && clearTimeout(NM);
                    this.nG.removeEventListener("progress", H8, true);
                    this.nG.removeEventListener("error", OQ, true);
                    this.nG.removeEventListener("abort", wG, true);
                    this.nG.removeEventListener("canplaythrough", yK, true);
                    H8 = OQ = wG = TG = void 0;
                    this.Rn(bF);
                    this.fireEvent("load")
                };
            for (var Dk in MF) {
                if (MF.hasOwnProperty(Dk)) {
                    Ej(Dk, MF, mJ, wG)
                }
            }
            ZF = new window.AudioContext();
            x0 = ZF.createBufferSource();
            x0.connect(ZF.destination);
            Z9 = {
                destination: ZF.destination,
                master: (typeof ZF.createGain === "undefined") ? ZF.createGainNode() : ZF.createGain(),
                music: (typeof ZF.createGain === "undefined") ? ZF.createGainNode() : ZF.createGain(),
                fx: (typeof ZF.createGain === "undefined") ? ZF.createGainNode() : ZF.createGain()
            };
            Z9.master.connect(Z9.destination);
            Z9.music.connect(Z9.master);
            Z9.fx.connect(Z9.master);
            (typeof x0.start === "undefined") ? x0.noteGrainOn(0, 0, 0): x0.start(0);
            this.Rn(bF);
            return this
        },
        Ej = function(Dk, MF, PJ, fF) {
            var T1 = new XMLHttpRequest();
            T1.onload = function(e) {
                ZF.decodeAudioData(e.target.response, function(WU) {
                    Gj[Dk] = WU;
                    PJ.apply()
                }, function() {
                    fF.apply()
                })
            }.bind(this);
            T1.onerror = function(e) {
                fF.apply(e)
            };
            T1.open("GET", MF[Dk], true);
            T1.responseType = "arraybuffer";
            T1.send()
        };
    return function(x5) {
        var ZE = !(He.Q_ == "Lj" && He.n_ < 2.3) && !(He.Q_ == "U6" && He.n_ < 4) && document.createElement(x5).play;
        return ZE && Jm
    }
})();
(function() {
    var dq = {},
        YL = {};
    PrefixFree.properties.forEach(function(zO) {
        dq[StyleFix.camelCase(zO)] = StyleFix.camelCase(PrefixFree.prefixProperty(zO));
        YL[zO] = PrefixFree.prefixProperty(zO)
    });
    Element.implement({
        nj: function(H1, IO) {
            this.style[dq[H1] || H1] = PrefixFree.value(IO.toString(), H1);
            return this
        },
        yF: function(H1, IO) {
            return this.style[dq[H1] || H1]
        },
        nm: function(fb) {
            var H1;
            for (H1 in fb) {
                this.nj(H1, fb[H1])
            }
            return this
        },
        Eh: function() {
            return new sc(this)
        }
    });
    He.Gq = function(H1) {
        return dq[H1] || H1
    };
    He.TJ = function(zO) {
        return YL[zO] || zO
    }
})();
var Cw = new Class({
    Extends: J0,
    initialize: function() {
        this.parent.apply(this, arguments);
        this.Uh = (new Element("div", {
            "class": "uT"
        })).inject(this)
    },
    R7: function() {
        this.parent();
        this.sI(0)
    },
    v2: function(x8, bQ) {
        x8.Buttons.forEach(function(iC, Pk) {
            this.BW("choice" + Pk, new AE({
                gs: x8.Buttons.length > 1 ? "" : "zz",
                uo: x8.Buttons.length > 1 ? iC.Text : "",
                Hq: 1
            })).LF("choice" + Pk, function() {
                this.R7();
                bQ(x8.Buttons[Pk].Cmd)
            })
        }.bind(this));
        this.Uh.set("text", x8.Reference ? zS("mproxy.Error.RGSid") + x8.Reference : "");
        return this.QX(new Element("p", {
            text: x8.Message
        }), x8.SupportInfo && (new Element("p", {
            text: x8.SupportInfo.Message
        })).adopt(new Element("address", {
            text: [x8.SupportInfo.PhoneNumber, x8.SupportInfo.Email].join("\n")
        })))
    }
});
var Sx = new Class({
    Extends: Request,
    options: {
        lZ: 10000
    },
    initialize: function(KC) {
        this.parent(KC);
        delete this.headers["X-Requested-With"]
    },
    send: function() {
        var LP = navigator.onLine;
        this.options.lZ && setTimeout(this.cancel.bind(this), this.options.lZ);
        LP === false ? this.fireEvent("offline") : this.parent()
    }
});
var uy = (function() {
    var Jr = function() {
            if (0 >= --this.ww) {
                this.fireEvent("Gn");
                this.fireEvent("iy", this.s4.status)
            } else {
                this.s4.send()
            }
        },
        MH = function() {
            this.fireEvent("rD")
        },
        mJ = function(cq) {
            var J2, XV, yB, cq;
            try {
                cq = JSON.parse(cq)
            } catch (e) {
                return this.fireEvent("cG")
            }
            J2 = cq.ReturnStatus;
            if (J2.Code != 1000000) {
                this.fireEvent("qk", J2)
            } else {
                if (cq.Authentication && cq.Authentication.Status == "Pending") {
                    ++this.ww;
                    setTimeout(this.send.bind(this), this.yz *= 1.5)
                } else {
                    this.fireEvent("KD", cq)
                }
            }
        },
        t5 = function() {
            this.fireEvent("Gn")
        };
    return new Class({
        Implements: Events,
        initialize: function(jP) {
            this.ww = jP.ww || 0;
            this.yz = jP.yz || 1000;
            this.s4 = new Sx({
                url: jP.Dk,
                data: jP.WU,
                method: jP.M9 || "post",
                async: jP.eQ ? 0 : 1,
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json; charset=utf8"
                },
                urlEncoded: 0,
                lZ: jP.lZ
            });
            this.s4.addEvents({
                failure: jP.Jr || Jr.bind(this),
                cancel: jP.Jr || Jr.bind(this),
                success: jP.mJ || mJ.bind(this),
                complete: jP.t5 || t5.bind(this),
                offline: jP.MH || MH.bind(this)
            })
        },
        send: function() {
            this.s4.send()
        },
        complete: function() {
            this.parent.apply(this, arguments)
        }
    })
})();
var TH = (function() {
    return new Class({
        Implements: [gT, Events],
        C4: {
            Z6: {
                requestTimeout: 10000,
                requestRetries: 0
            },
            a7: function(mY) {},
            Ii: function(mY) {},
            G4: function(zX) {},
            cN: function(cq) {
                debugConsol.assert(0)
            },
            kH: function(XV) {},
            nJ: function() {}
        },
        vO: 0,
        initialize: function(C4) {
            this.BH(C4)
        },
        mY: function(jP) {
            jP.Dk = this.C4.Z6.proxyUrl.concat(jP.fL);
            jP.lZ = this.C4.Z6.requestTimeout || 0;
            jP.ww = this.C4.Z6.requestRetries || 0;
            if (jP.yY) {
                jP.Jr = jP.Ty = jP.mJ = jP.t5 = jP.MH = function() {}
            }
            var s4 = (new uy(jP)).addEvents({
                rD: jP.a7 || this.C4.a7,
                iy: jP.Ii || this.C4.Ii,
                qk: jP.G4 || this.C4.G4,
                KD: jP.cN || this.C4.cN,
                cG: jP.kH || this.C4.kH,
                KT: jP.nJ || this.C4.nJ
            });
            return s4
        }
    })
})();
TH.o6 = {
    T2: function(Zl) {
        return parseFloat(Zl) || 0
    },
    cw: function(Zl) {
        return parseInt(Zl, 10) || 0
    },
    sC: function(Zl) {
        return Zl.split(",")
    },
    a9: function(Zl) {
        return new Date(Zl.substr(0, 4), Zl.substr(4, 2), Zl.substr(6, 2), Zl.substr(8, 2), Zl.substr(10, 2))
    },
    QV: function(aY, gn) {
        var Ig = {},
            vn, Bv = aY.length;
        gn = gn || "@name";
        while (--Bv >= 0) {
            vn = aY[Bv];
            Ig[vn[gn]] = vn;
            delete vn[gn]
        }
        return Ig
    }
};
var Cv = function(ru, Z6) {
    Z6.enableHighAccuracy = Z6.enableHighAccuracy == "true";
    Z6.maximumAge = Z6.maximumAge || 300000;
    Z6.timeout = Z6.timeout || 600000;
    "geolocation" in navigator ? navigator.geolocation.getCurrentPosition(ru, ru, Z6) : ru({
        message: "Device does not support navigator.geolocation",
        code: -1
    })
};
var a5 = new Class({
    initialize: function() {}
});
var sk = (function() {
    var SR, Z6, Gc, D4, CU, ux, hS, xr = (function() {
            var EC, IK = {
                    closeGame: function() {
                        ux && ux.mY({
                            fL: "/close.action",
                            WU: JSON.stringify(D4.params),
                            Jr: wQ,
                            Ty: wQ,
                            mJ: wQ,
                            MH: wQ
                        }).send()
                    },
                    requestMobileNumber: function() {
                        QF()
                    },
                    getGeoCoordinates: function() {
                        Cv(Ev, Z6.geoLocation)
                    },
                    insufficientFundsNotification: function() {
                        gM.x6()
                    }
                },
                ky = {
                    closeGame: function() {
                        L_ = 1;
                        if (window.opener) {
                            window.close()
                        } else {
                            window.location = Z6.console.lobbyURL
                        }
                    },
                    reloadGame: function() {
                        L_ = 1;
                        if (D4.params.mac) {
                            window.location = Z6.console.lobbyURL
                        } else {
                            Zi.XO()
                        }
                    },
                    switchToCashPlay: function() {
                        Zi.XO({
                            playMode: "real"
                        })
                    },
                    gameInProgressReload: function() {
                        L_ = 1;
                        Zi.XO(EC.Param)
                    },
                    "": function() {
                        gM.C1()
                    }
                };

            function wQ() {
                gM.wQ(EC)
            }
            return {
                qZ: function(Ri) {
                    IK[""] = Ri && function() {
                        IK[""] = void 0;
                        Ri()
                    }
                },
                QT: function(Cn) {
                    var oT = Cn["@name"],
                        D3 = {};
                    EC = Cn;
                    Cn.Param && Array.UT(Cn.Param).forEach(function(mq) {
                        D3[mq["@name"]] = mq["#text"]
                    });
                    Cn.Param = D3;
                    (IK[oT] || wQ)()
                },
                zP: function(oT, D3) {
                    var Ri = ky[oT];
                    Ri ? Ri(D3) : console.warn("No default handler for " + oT)
                }
            }
        })(),
        Ch = function(x8) {
            hS.Sg || hS.RY();
            x8.Reference = "";
            x8.Buttons = Array.UT(x8.Buttons.Button);
            gM.g3(x8)
        },
        ax = function(x8) {
            Zi.gY && Zi.gY.x3();
            hS.Sg || hS.fk();
            x8.Buttons = Array.UT(x8.Buttons.Button);
            gM.g3(x8)
        },
        Mt, o9, Qs, qe, Q8 = function(cq) {
            o9 = cq.GameLogicResponse;
            if (!Qs) {
                Qs = Date.now()
            }
            Mt = o9.OutcomeDetail.TransactionId;
            var o8 = 0;
            if (Gc && Gc.transactiondelay && Gc.gameType && Gc.gameType.toUpperCase() == "S") {
                o8 = Gc.transactiondelay ? Gc.transactiondelay * 1000 : 0;
                o8 = Math.max(0, o8 - (Date.now() - qe))
            }
            setTimeout(function() {
                o9.OutcomeDetail.Balance = Ym.Vx(o9.OutcomeDetail.Balance);
                o9.Messages = o9.Messages || [];
                if (o9.Messages.Message) {
                    o9.Messages = Array.UT(o9.Messages.Message)
                }
                tS()
            }, o8)
        },
        tS = function() {
            var x8 = o9.Messages && o9.Messages.shift();
            hS.o9 = o9;
            if (x8) {
                xr.qZ(tS);
                Ch(x8)
            } else {
                hS.BY()
            }
        },
        a7 = function() {
            return ax({
                Message: zS("mproxy.Error.networkOffLine"),
                Buttons: {
                    Button: {
                        Text: zS("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": ""
                        }
                    }
                }
            })
        },
        Ii = function(J2) {
            return ax({
                Message: zS(J2 ? "mproxy.Error.networkError" : "mproxy.Error.connectionLost"),
                Reference: J2 ? "MGC-002-" + J2 : "MGC-001",
                Buttons: {
                    Button: {
                        Text: zS("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": J2 ? "closeGame" : "reloadGame"
                        }
                    }
                }
            })
        },
        kH = function(mY) {
            return ax({
                Message: zS("mproxy.Error.payloadError"),
                Reference: "MGC-003",
                Buttons: {
                    Button: {
                        Text: zS("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": "closeGame"
                        }
                    }
                }
            })
        },
        G4 = function(fF) {
            var MY = fF.AdditionalInfo || {};
            MY.Action = MY.Action || "";
            MY.Buttons = MY.Buttons ? MY.Buttons.split(",").map(function(z6) {
                return zS("mproxy.Buttons." + z6)
            }) : [zS("mproxy.Buttons.OK")];
            return ax({
                Message: fF.Message,
                Reference: fF.Code,
                Buttons: {
                    Button: MY.Action.split(",").map(function(oT, Bv) {
                        return {
                            Text: MY.Buttons[Bv] || oT,
                            Cmd: {
                                "@name": oT || "closeGame"
                            }
                        }
                    })
                }
            })
        },
        Mj = function(fF) {
            return Ch({
                Message: zS("mproxy.CancelSubmitMobileNumber.message"),
                Buttons: {
                    Button: {
                        Text: zS("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": "closeGame"
                        }
                    }
                }
            })
        },
        cN = function(cq) {
            var XV = cq.Exception;
            return XV ? this.fireEvent("lq", XV) : this.fireEvent("jw", cq)
        },
        VR = function() {
            var uM = 0,
                Jd = function() {};
            return function() {
                if (!uM) {
                    uM = 1;
                    document.body.style.display = "none";
                    ux && ux.mY({
                        eQ: 1,
                        fL: "/close.action",
                        WU: JSON.stringify(D4.params),
                        yY: 1
                    }).send()
                }
            }
        },
        Ev = function(Gu) {
            var e7 = {};
            if (Gu.coords) {
                e7.latitude = Gu.coords.latitude.toString();
                e7.longitude = Gu.coords.longitude.toString()
            }
            e7.locationstatus = (Gu.code || 0).toString();
            e7.locationmessage = Gu.message || "";
            bN(e7)
        },
        initResponse, Nq = function(RC) {
            function p1(cq) {
                var GW = VR();
                window.addEvents({
                    beforeunload: GW,
                    unload: GW
                });
                h4 = cq;
                Ym.Xp(h4.CURRENCY, D4.params.denomamount);
                h4.GameLogicResponse.OutcomeDetail.Balance = Ym.Vx(h4.GameLogicResponse.OutcomeDetail.Balance);
                gM.QW(h4.CURRENCY, h4.GameLogicResponse)
            }
            var D3 = sq.IU({
                getplayerbalance: (!!RC).toString()
            }, D4.params);
            xr.qZ(Nq);
            ux.mY({
                fL: "/initstate.action",
                WU: JSON.stringify(D3)
            }).addEvents({
                jw: p1,
                lq: ax
            }).send()
        },
        bN = (function() {
            var Ik = {
                requestMobileNumber: function(fF) {
                    QF(fF)
                },
                initGeoCoordinates: function(fF) {
                    t0(fF)
                }
            };
            return function(cH) {
                function aZ(zX) {
                    var Ri = zX.AdditionalInfo && Ik[zX.AdditionalInfo.Action] || G4;
                    Ri(zX)
                }

                function Sr(cq) {
                    var GW = VR();
                    window.addEvents({
                        beforeunload: GW,
                        unload: GW
                    });
                    gM.yW()
                }
                CU = CU || JG(sq.AC(D4.params, ["uniqueid", "nscode", "skincode", "softwareid"]));
                cH = sq.IU(cH || {}, D4.params);
                xr.qZ(bN);
                ux.mY({
                    fL: "/authenticate.action",
                    WU: JSON.stringify(cH),
                    G4: aZ
                }).addEvents({
                    jw: Sr,
                    lq: ax
                }).send()
            }
        })(),
        EB = function() {
            function A5(Ls, zl, pc) {
                if (zl && 0 > pc.indexOf(zl)) {
                    this.Ph(Ls)
                } else {
                    this.Nv(Ls)
                }
            }

            function Hl(rw, MN) {
                var Ls = this.Q9(),
                    HI = Ls.PatternsBet;
                Ls.PatternsBet = rw;
                A5.call(this, Ls, HI, MN)
            }

            function dC(oN, Ml) {
                var Ls = this.Q9(),
                    DV = Ls.BetPerPattern && Ls.BetPerPattern[Ym] || 0;
                Ls.BetPerPattern = Ls.BetPerPattern || {};
                Ls.BetPerPattern[Ym] = Ym.mf(oN);
                A5.call(this, Ls, Ym.Vx(DV).toString(), Ml)
            }
            Mt = h4.GameLogicResponse.OutcomeDetail.TransactionId;
            hS.wU(hS.dN = h4.Paytable);
            hS.I9(o9 = hS.o9 = h4.GameLogicResponse);
            hS.Vs(hS.o9);
            h4 = void 0;
            if (hS.o9.PatternSliderInput) {
                if (hS.o9.PatternSliderInput.PatternsBet) {
                    Hl.call(CU, hS.o9.PatternSliderInput.PatternsBet, hS.dN.PatternSliderInfo.PatternInfo.Step)
                }
                if (hS.o9.PatternSliderInput.BetPerPattern) {
                    dC.call(CU, hS.o9.PatternSliderInput.BetPerPattern, hS.dN.PatternSliderInfo.BetInfo.Step)
                }
            }
            gh.JN("progress")
        },
        QF = (function() {
            var IB, iM;
            return function(fF) {
                var Ls = CU.Q9(),
                    T0 = fF.Message || [
                        ["", ""]
                    ];
                iM = iM || (new Element("form")).adopt(T0.length > 1 ? (new Element("select", {
                    name: "xh"
                })).adopt(T0.length > 1 && new Element("option", {
                    value: "",
                    text: zS("mproxy.SubmitMobileNumber.labelRegionCode")
                }), T0.map(function(Kc) {
                    return new Element("option", {
                        value: Kc[0],
                        text: Kc[1]
                    })
                })) : new Element("input", {
                    type: "hidden",
                    name: "xh",
                    value: T0[0][0]
                }), (new Element("label", {
                    text: zS("mproxy.SubmitMobileNumber.labelDeviceNumber")
                })).adopt(new Element("input", {
                    type: "tel",
                    style: "-wap-input-format: '*N';",
                    name: "aN"
                }))).addEvent("submit", function() {
                    var aN = this.elements.aN.value,
                        xh = this.elements.xh.value,
                        Ls = CU.Q9();
                    Ls.deviceNumber = aN;
                    Ls.regionCode = xh;
                    CU.Ph(Ls);
                    window.event && window.event.preventDefault();
                    if (aN && (xh || T0.length == 0)) {
                        IB.pj(0);
                        ux.mY({
                            M9: "get",
                            fL: "/subdnbr.action",
                            WU: {
                                devicenumber: aN,
                                regioncode: xh
                            }
                        }).addEvents({
                            jw: function(cq) {
                                delete cq.ReturnStatus.Code;
                                G4(cq.ReturnStatus)
                            },
                            Gn: function() {
                                IB.tM(0)
                            }
                        }).send()
                    }
                });
                IB = IB || J0.jk(new J0({
                    ix: "IB",
                    gs: "yC ow"
                }).addEvents({
                    bx: iM.fireEvent.bind(iM, "submit"),
                    zf: function() {
                        IB.tM(0);
                        Mj()
                    }
                }).Ub({
                    zf: new AE({
                        uo: zS("mproxy.SubmitMobileNumber.buttonCancel"),
                        Hq: 1
                    }),
                    bx: new AE({
                        uo: zS("mproxy.SubmitMobileNumber.buttonValidate"),
                        Hq: 1
                    })
                }).QX(new Element("h1", {
                    text: zS("mproxy.SubmitMobileNumber.title")
                }), new Element("p", {
                    text: zS("mproxy.SubmitMobileNumber.message")
                }), iM));
                document.body.grab(IB, "top");
                iM.elements.aN.value = Ls.deviceNumber || "";
                iM.focus();
                if (T0.length > 1) {
                    iM.elements.xh.value = Ls.regionCode || ""
                }
                return IB.pj(1).tM(1)
            }
        })(),
        t0 = function(fF) {
            var Gm = Gm || J0.jk(new J0({
                ix: "bZ",
                gs: "yC ow"
            })).QX(fF.Message).Ub({
                zf: new AE({
                    uo: zS("Game.buttonOk"),
                    Hq: 1
                })
            }).addEvents({
                zf: function() {
                    Gm.toElement().destroy();
                    Gm = void 0
                }
            }).addEvents({
                zf: function() {
                    Cv(Ev, Z6.geoLocation)
                }
            }).tM(1);
            document.body.grab(Gm, "top")
        },
        Iw = function() {
            if (D4.params.mac) {
                ux.mY({
                    M9: "get",
                    fL: "/valdnbr.action",
                    WU: {
                        mac: D4.params.mac
                    },
                    cN: function(cq) {
                        D4.params = cq.ReturnData;
                        bN()
                    }
                }).send()
            } else {
                bN()
            }
        },
        W0 = function(WU) {
            var o8 = 0;
            if (o9.OutcomeDetail.GameStatus && (o9.OutcomeDetail.GameStatus == "Start") && Gc.transactiondelay) {
                if (Qs) {
                    o8 = Math.max(0, (Gc.transactiondelay * 1000) - (Date.now() - Qs))
                }
                Qs = 0;
                qe = Date.now()
            }
            if (o8) {
                setTimeout(function() {
                    pS(WU)
                }, o8)
            } else {
                pS(WU)
            }
        },
        pS = (function() {
            var fL;
            return function(WU) {
                fL = fL || "/play.action".concat(sq.wq(D4.params, ["language", "presenttype", "channel", "freespin_tokenID", "freespin_bet", "freespin_lines", "freespin_num", "playMode"]));
                WU.GameLogicRequest.TransactionId = Mt;
                xr.qZ();
                ux.mY({
                    fL: fL,
                    WU: JSON.stringify(WU)
                }).addEvents({
                    jw: Q8,
                    lq: ax
                }).send()
            }
        })(),
        U7 = (function() {
            var fL;
            return function(ba, WU) {
                fL = fL || "/paytable.action".concat(sq.wq(D4.params, ["language", "presenttype", "channel"]));
                xr.qZ();
                ux.mY({
                    M9: "get",
                    fL: fL,
                    WU: JSON.stringify(WU)
                }).addEvents({
                    jw: ba,
                    lq: ax
                }).send()
            }
        })(),
        L_, gM = (function() {
            var rC, Mp, Yy = {},
                Qv;

            function FD() {
                hS.I9(hS.o9);
                hS.cX()
            }
            return {
                Dw: function(Z6, D4) {
                    var i4, fX = +new Date;
                    rC = document.createElement("iframe");
                    Mp = document.createElement("div");
                    Mp.id = "gM";
                    Mp.appendChild(rC);
                    document.body.insertBefore(Mp, document.body.lastElementChild);
                    gh.JN("queue", 1);
                    com.igt.mxf.setMessageOrigin(rC.contentWindow, Z6.url).addOneShotEvent("consoleInitialised", function(Z6) {
                        clearTimeout(i4);
                        console.warn("Console loaded after " + (Math.round((fX - new Date) / 10) / 100) + "s");
                        if (Z6) {
                            D4.D3 = sq.IU(D4.params, Z6)
                        }
                        gh.JN("progress", 1);
                        gh.JN("console")
                    }).addEvents({
                        consoleResize: function(Dt) {
                            if (Mp.style.height != Dt) {
                                Mp.style.visibility = "visible";
                                Mp.style.height = Dt;
                                document.body.offsetWidth;
                                m6()
                            }
                            com.igt.mxf.sendMessage("consoleResized", Dt)
                        },
                        command: function(oT, D3) {
                            xr.zP(oT, D3)
                        }
                    });
                    i4 = setTimeout(function() {
                        gh.X4(window.parent, "loaderror")
                    }, Z6.timeout || 15000);
                    (function(Dk) {
                        var a = document.createElement("a");
                        a.setAttribute("href", Dk);
                        rC.src = a.href + (a.search ? "&" : "?") + sq.lU(D4.params, Z6.urlParameterWhitelist)
                    })(Z6.url)
                },
                x6: function() {
                    hS.o9 = o9;
                    hS.KK();
                    Zi.gY && Zi.gY.x3();
                    if (Qv) {
                        com.igt.mxf.addOneShotEvent("resume", function() {
                            Qv = 0;
                            hS.jp(1)
                        });
                        com.igt.mxf.enableEvents(1);
                        o9 && com.igt.mxf.sendOutcome(o9);
                        com.igt.mxf.sendMessage("insufficientFundsNotification")
                    } else {
                        hS.jp(1)
                    }
                },
                Zx: function() {
                    hS.jp(0);
                    if (!Qv) {
                        Qv = 1;
                        com.igt.mxf.addOneShotEvent("wagerStarted", function() {
                            com.igt.mxf.enableEvents(0);
                            hS.tR()
                        });
                        com.igt.mxf.sendMessage("wagerIsStarting")
                    } else {
                        hS.tR()
                    }
                },
                hg: function() {
                    hS.jp(0);
                    if (!Qv) {
                        Qv = 1;
                        com.igt.mxf.addOneShotEvent("wagerStarted", function() {
                            com.igt.mxf.enableEvents(0);
                            hS.ud()
                        });
                        com.igt.mxf.sendMessage("wagerIsStarting")
                    } else {
                        hS.ud()
                    }
                },
                OO: function() {
                    com.igt.mxf.addOneShotEvent("wagerComplete", function() {
                        Qv = 0;
                        hS.Ve()
                    });
                    Mp.style.visibility = "";
                    com.igt.mxf.enableEvents(1);
                    com.igt.mxf.sendMessage("wagerIsComplete")
                },
                C1: function() {
                    hS.KK();
                    Zi.gY && Zi.gY.x3();
                    if (Qv) {
                        com.igt.mxf.addOneShotEvent("wagerAborted", function() {
                            Qv = 0;
                            hS.jp(1)
                        });
                        com.igt.mxf.enableEvents(1);
                        com.igt.mxf.sendMessage("wagerIsAborted")
                    } else {
                        hS.jp(1)
                    }
                },
                wQ: function(Cn) {
                    com.igt.mxf.addOneShotEvent("resume", function() {
                        xr.zP(Cn["@name"], Cn.Param)
                    });
                    com.igt.mxf.sendMessage("command", Cn["@name"], Cn.Param)
                },
                g3: function(x8) {
                    com.igt.mxf.addOneShotEvent("resume", function(Pk) {
                        Mp.style.visibility = "";
                        if (x8.Buttons[Pk]) {
                            xr.QT(x8.Buttons[Pk].Cmd)
                        } else {
                            SR.v2(x8, xr.QT).tM(1);
                            Mp.style.height = ""
                        }
                    });
                    com.igt.mxf.enableEvents(1);
                    com.igt.mxf.sendMessage("displayMessage", x8.Id, x8.Reference, x8.Message, x8.Buttons.map(function(iC) {
                        return iC.Text
                    }));
                    Mp.style.visibility = "visible";
                    Mp.style.height = 0
                },
                zD: function() {
                    if (hS.o9.OutcomeDetail.Settled != 0) {
                        com.igt.mxf.addOneShotEvent("afterGameOutcome", FD);
                        com.igt.mxf.sendOutcome(hS.o9)
                    } else {
                        FD()
                    }
                },
                yW: function() {
                    com.igt.mxf.addOneShotEvent("resume", function(nh) {
                        Nq(nh)
                    });
                    com.igt.mxf.sendMessage("beforeInitGame")
                },
                QW: function(wa, PL) {
                    com.igt.mxf.addOneShotEvent("afterGameOutcome", EB);
                    com.igt.mxf.setCurrencyFormat({
                        config: wa,
                        toCurrency: Ym.mf,
                        format: Ym.r8
                    });
                    com.igt.mxf.sendOutcome(PL)
                },
                tM: function(bW) {
                    if (Mp) {
                        Mp.style.visibility = bW ? "" : "hidden"
                    }
                },
                bI: function() {
                    Mp.style.visibility = "";
                    com.igt.mxf.sendMessage("gameReady")
                }
            }
        })();
    J0.gH = function(Pr) {
        Pr.addEvents({
            J5: function() {
                gM && gM.tM(0)
            },
            Q6: function() {
                gM && gM.tM(1)
            }
        });
        return J0.jk(Pr)
    };
    return function(Bh, P7, YI, nV) {
        Z6 = Bh;
        Gc = YI;
        D4 = P7;
        hS = new a5.Hd();
        if (document.querySelector("meta[name='com.igt.game.IOS9FIX'][content='yes']")) {
            var eC = new Element("div", {
                id: "game"
            });
            var hL = new Element("div", {
                id: "ios9fix"
            });
            hL.style.position = "absolute";
            hL.style.top = "0";
            hL.style.left = "0";
            hL.style.width = "100%";
            hL.style.height = "100%";
            hL.style.overflow = "hidden";
            hS.nG = (hL.adopt(eC)).inject(document.body.lastElementChild, "before");
            hS.nG = eC
        } else {
            hS.nG = (new Element("div", {
                id: "game"
            })).inject(document.body.lastElementChild, "before")
        }
        ux = new TH({
            Z6: Z6.RGS,
            a7: a7,
            Ii: Ii,
            G4: G4,
            cN: cN,
            kH: kH
        });
        hS.Bf = J0.jk(new Cw({
            ix: "Bf",
            gs: "M2 ow"
        }));
        document.body.grab(hS.Bf, "top");
        SR = J0.gH(new Cw({
            ix: "SR",
            gs: "yC ow",
            fO: 0
        }).addEvents({
            J5: function() {
                gh.JN("abortLoading"), hS.Bf.tM(0)
            }
        }));
        document.body.grab(SR, "top");

        function subvertBalanceMeterForPromotionalFreeSpin(hS) {
            if (!hS.k6) {
                throw new Error("You must expose k6 on the game instance")
            }
            var HQ = hS.k6.xd.bind(hS.k6);
            hS.k6.C4.Iy = Math.floor;
            hS.k6.C4.j_ = Math.floor;
            hS.k6.xd = function() {
                if (hS.o9.PromotionalFreeSpin && hS.o9.PromotionalFreeSpin["@count"]) {
                    HQ(hS.o9.PromotionalFreeSpin["@count"])
                }
            };
            hS.k6.bu = function() {
                return Infinity
            };
            hS.k6.xd()
        }
        nV.yX("initialise", function qd() {
            nV.Yl("initialise", qd);
            hS.CU = CU;
            if (hS.o9.PromotionalFreeSpin) {
                hS.dN.PatternSliderInfo.PatternInfo.Step = [D4.params.freespin_lines];
                if (zS("Game.consoleBalance") === zS("Game.consoleBalance").toUpperCase()) {
                    Pv.lQ("Game.consoleBalance", zS("mproxy.PromotionalFreeSpin.consoleBalance").toUpperCase())
                } else {
                    Pv.lQ("Game.consoleBalance", zS("mproxy.PromotionalFreeSpin.consoleBalance"))
                }
            }
            hS.Sg();
            hS.Sg = void 0;
            if (hS.o9.PromotionalFreeSpin) {
                subvertBalanceMeterForPromotionalFreeSpin(hS)
            }
            gh.JN("initialised");
            gM.bI()
        });
        nV.uR(["loaded", "console"], Iw);
        gM.Dw(Z6.console, D4);
        hS.hg = gM.hg;
        hS.Zx = gM.Zx;
        hS.OO = gM.OO;
        hS.zD = gM.zD;
        hS.vp = gM.tM;
        if (Gc && Gc.transactiondelay && Gc.gameType && Gc.gameType.toUpperCase() == "S") {
            hS.pS = W0
        } else {
            hS.pS = pS
        }
        hS.U7 = U7;
        hS.jp = function(GZ) {
            hS.zn(GZ && !L_)
        }
    }
})();
a5.o6 = TH.o6;
/*! iScroll v5.1.3 ~ (c) 2008-2014 Matteo Spinelli ~ http://cubiq.org/license */
(function(window, document, Math) {
    var rAF = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
        window.setTimeout(callback, 1000 / 60)
    };
    var utils = (function() {
        var me = {};
        var Bc = document.createElement("div").style;
        var wD = (function() {
            var vendors = ["t", "webkitT", "MozT", "msT", "OT"],
                transform, i = 0,
                l = vendors.length;
            for (; i < l; i++) {
                transform = vendors[i] + "ransform";
                if (transform in Bc) {
                    return vendors[i].substr(0, vendors[i].length - 1)
                }
            }
            return false
        })();

        function Cf(style) {
            if (wD === false) {
                return false
            }
            if (wD === "") {
                return style
            }
            return wD + style.charAt(0).toUpperCase() + style.substr(1)
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
        var e9 = Cf("transform");
        me.extend(me, {
            hasTransform: e9 !== false,
            hasPerspective: Cf("perspective") in Bc,
            hasTouch: "ontouchstart" in window,
            hasPointer: window.PointerEvent || window.MSPointerEvent,
            hasTransition: Cf("transition") in Bc
        });
        me.isBadAndroid = /Android /.test(window.navigator.appVersion) && !(/Chrome\/\d/.test(window.navigator.appVersion));
        me.extend(me.style = {}, {
            transform: e9,
            transitionTimingFunction: Cf("transitionTimingFunction"),
            transitionDuration: Cf("transitionDuration"),
            transitionDelay: Cf("transitionDelay"),
            transformOrigin: Cf("transformOrigin")
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
                ev.BD = true;
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
        this.dH = {};
        this.aD();
        this.refresh();
        this.scrollTo(this.options.startX, this.options.startY);
        this.enable()
    }
    IScroll.prototype = {
        version: "5.1.3",
        aD: function() {
            this.OI()
        },
        destroy: function() {
            this.OI(true);
            this.Dx("destroy")
        },
        Eb: function(e) {
            if (e.target != this.scroller || !this.isInTransition) {
                return
            }
            this.jm();
            if (!this.resetPosition(this.options.bounceTime)) {
                this.isInTransition = false;
                this.Dx("scrollEnd")
            }
        },
        zm: function(e) {
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
            this.jm();
            this.startTime = utils.getTime();
            if (this.options.useTransition && this.isInTransition) {
                this.isInTransition = false;
                pos = this.getComputedPosition();
                this.fP(Math.round(pos.x), Math.round(pos.y));
                this.Dx("scrollEnd")
            } else {
                if (!this.options.useTransition && this.isAnimating) {
                    this.isAnimating = false;
                    this.Dx("scrollEnd")
                }
            }
            this.startX = this.x;
            this.startY = this.y;
            this.absStartX = this.x;
            this.absStartY = this.y;
            this.pointX = point.pageX;
            this.pointY = point.pageY;
            this.Dx("beforeScrollStart")
        },
        Cl: function(e) {
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
                this.Dx("scrollStart")
            }
            this.moved = true;
            this.fP(newX, newY);
            if (timestamp - this.startTime > 300) {
                this.startTime = timestamp;
                this.startX = this.x;
                this.startY = this.y
            }
        },
        pT: function(e) {
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
                this.Dx("scrollCancel");
                return
            }
            if (this.dH.flick && duration < 200 && distanceX < 100 && distanceY < 100) {
                this.Dx("flick");
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
            this.Dx("scrollEnd")
        },
        CR: function() {
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
            this.Dx("refresh");
            this.resetPosition()
        },
        on: function(type, fn) {
            if (!this.dH[type]) {
                this.dH[type] = []
            }
            this.dH[type].push(fn)
        },
        off: function(type, fn) {
            if (!this.dH[type]) {
                return
            }
            var index = this.dH[type].indexOf(fn);
            if (index > -1) {
                this.dH[type].splice(index, 1)
            }
        },
        Dx: function(type) {
            if (!this.dH[type]) {
                return
            }
            var i = 0,
                l = this.dH[type].length;
            if (!l) {
                return
            }
            for (; i < l; i++) {
                this.dH[type][i].apply(this, [].slice.call(arguments, 1))
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
                this.mi(easing.style);
                this.jm(time);
                this.fP(x, y)
            } else {
                this.Lp(x, y, time, easing.fn)
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
        jm: function(time) {
            time = time || 0;
            this.scrollerStyle[utils.style.transitionDuration] = time + "ms";
            if (!time && utils.isBadAndroid) {
                this.scrollerStyle[utils.style.transitionDuration] = "0.001s"
            }
        },
        mi: function(easing) {
            this.scrollerStyle[utils.style.transitionTimingFunction] = easing
        },
        fP: function(x, y) {
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
        OI: function(remove) {
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
        Lp: function(destX, destY, duration, easingFn) {
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
                    that.fP(destX, destY);
                    if (!that.resetPosition(that.options.bounceTime)) {
                        that.Dx("scrollEnd")
                    }
                    return
                }
                now = (now - startTime) / duration;
                easing = easingFn(now);
                newX = (destX - startX) * easing + startX;
                newY = (destY - startY) * easing + startY;
                that.fP(newX, newY);
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
                    this.zm(e);
                    break;
                case "touchmove":
                case "pointermove":
                case "MSPointerMove":
                case "mousemove":
                    this.Cl(e);
                    break;
                case "touchend":
                case "pointerup":
                case "MSPointerUp":
                case "mouseup":
                case "touchcancel":
                case "pointercancel":
                case "MSPointerCancel":
                case "mousecancel":
                    this.pT(e);
                    break;
                case "orientationchange":
                case "resize":
                    this.CR();
                    break;
                case "transitionend":
                case "webkitTransitionEnd":
                case "oTransitionEnd":
                case "MSTransitionEnd":
                    this.Eb(e);
                    break;
                case "wheel":
                case "DOMMouseScroll":
                case "mousewheel":
                    this.Yi(e);
                    break;
                case "keydown":
                    this.UW(e);
                    break;
                case "click":
                    if (!e.BD) {
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
var Yv = (function() {
    return new Class({
        Extends: J0,
        Binds: ["Gi", "zC"],
        C4: {
            bi: 1
        },
        Tt: 0,
        initialize: function(C4) {
            var Wn;
            this.parent(C4);
            this.Ub({
                G5: new AE({
                    gs: "G5"
                }),
                R8: new AE({
                    gs: "R8"
                }),
                zf: new AE({
                    gs: "zf",
                    Hq: 1
                })
            });
            this.addEvents({
                R8: this.zC,
                G5: this.Gi
            });
            this.nG.adopt((new Element("div", {
                "class": "V9"
            })).adopt(this.Cq, this.zk = new Element("div", {
                "class": "nT"
            }).adopt(this.b_)));
            this.uU = new IScroll(this.zk, {
                hScrollbar: false,
                vScrollbar: true,
                checkDOMChanges: false,
                hideScrollbar: false
            })
        },
        QX: function(x8) {
            var Y3;
            this.parent(arguments);
            this.uU.scrollTo(0, 0, 0);
            setTimeout(this.uU.refresh.bind(this.uU), 200);
            return this
        },
        tM: function(bW) {
            if (bW) {
                this.Tt = 0;
                this.V_(0)
            }
            this.parent(bW)
        },
        R7: function() {
            this.parent();
            this.QX("")
        },
        zC: function() {
            if (++this.Tt >= this.C4.bi) {
                this.Tt = 0
            }
            this.Tt = Math.min(this.Tt, this.C4.bi - 1);
            this.V_(this.Tt)
        },
        V_: function(Aw) {
            this.fireEvent("C8", Aw)
        },
        Gi: function() {
            if (this.Tt <= 0) {
                this.Tt = this.C4.bi
            }
            this.Tt = Math.max(--this.Tt, 0);
            this.V_(this.Tt)
        },
        pj: function(QA) {
            this.Cq.pj(QA, "G5");
            this.Cq.pj(QA, "R8");
            return this
        }
    })
})();
var fz = (function() {
    return new Class({
        Extends: GM,
        Binds: ["Vb"],
        C4: {
            gs: "uq",
            RJ: "",
            Ts: ""
        },
        initialize: function(C4) {
            this.BH(C4);
            this.gG = (new AE({
                gs: "Tz",
                uo: this.C4.Ts,
                Hq: 1
            })).addEvents({
                uh: this.Vb
            });
            this.jH = new Element("div", {
                "class": "fz"
            });
            this.Hp = new Element("div", {
                "class": "DC"
            });
            this.nG = (new Element("div", {
                id: this.C4.ix,
                "class": this.C4.gs
            }).adopt(new Element("div", {
                "class": "iS"
            }).adopt(new Element("div", {
                "class": "bf",
                text: this.C4.RJ
            }), this.gG), this.jH.adopt(this.Hp)));
            this.jH.addEventListener("touchmove", function(e) {
                e.preventDefault()
            });
            this.addEvents({
                Q6: function() {
                    setTimeout(bs.m4, 0)
                }
            });
            this.uU = new IScroll(this.jH, {
                hScrollbar: false,
                vScrollbar: true,
                checkDOMChanges: false,
                hideScrollbar: false
            })
        },
        QX: function(x8) {
            this.Hp.innerHTML = "";
            this.Hp.adopt(arguments).children.length || this.Hp.set("html", x8);
            setTimeout(this.uU.refresh.bind(this.uU), 200);
            return this
        },
        tM: function(toshow) {
            this.parent.apply(this, arguments);
            if (toshow) {
                this.uU.refresh()
            }
        },
        Vb: function() {
            this.uU.scrollTo(0, 0, 0);
            this.tM(0)
        },
    })
})();
fz.jk = function(Wl) {
    var hK = new Element("div", {
            "class": "CC"
        }),
        fl = (new Element("div", {
            "class": "Uj",
            style: "visibility:hidden"
        })).adopt(hK, new Element("div", {
            "class": "YA"
        }).adopt(Wl));
    Wl.nG = fl;
    return Wl
};
kX = function() {
    var BX = this;
    this.Qo = new Element("div", {
        "class": "z6"
    });
    this.M3 = (new Element("div", {
        id: "YS",
        "class": "gI"
    })).adopt(this.Qo);
    return {
        wK: function() {
            return (new H_({
                ec: 1000
            })).addEvents({
                FG: function() {
                    BX.M3.removeClass("gI")
                }
            })
        },
        Sv: function() {
            return (new H_({
                ec: 1000
            })).addEvents({
                FG: function() {
                    BX.M3.addClass("nU")
                }
            })
        },
        zp: function() {
            return (new H_({
                ec: 5
            })).addEvents({
                FG: function() {
                    BX.M3.addClass("gI");
                    BX.M3.removeClass("nU")
                }
            })
        },
        QX: function(x8) {
            BX.Qo.set("html", x8 || "");
            return BX
        },
        toElement: function() {
            return BX.M3
        }
    }
};
c7 = function() {
    var BX = this;
    this.oJ = new Element("div", {
        "class": "z6"
    });
    this.ER = (new Element("div", {
        id: "xQ",
        "class": "gI"
    })).adopt(new Element("div", {
        "class": "Xe"
    }).adopt(this.oJ));
    return {
        wK: function() {
            return (new H_({
                ec: 1000
            })).addEvents({
                FG: function() {
                    BX.ER.removeClass("gI")
                }
            })
        },
        Sv: function() {
            return (new H_({
                ec: 1000
            })).addEvents({
                FG: function() {
                    BX.ER.addClass("gI")
                }
            })
        },
        QX: function(x8) {
            BX.oJ.set("html", x8 || "");
            return BX
        },
        toElement: function() {
            return BX.ER
        }
    }
};
GJ = function(YM) {
    var BX = this;
    this.eN = new Element("div", {
        id: "mR"
    });
    this.T9 = new Element("span", {
        id: "VC"
    });
    this.T9.innerHTML = zS("Game.bigWin");
    this.IL = new Vi({
        nG: new Element("div", {
            id: "Ol"
        }),
        Iy: nl,
        s1: 0,
        cB: 50
    });
    this.Mi = new Element("div", {
        id: "aT"
    }).adopt(this.eN);
    this.Mi.addClass("xe");
    this.D8 = new Element("div", {
        id: "Dz",
        "class": "RG"
    }).adopt(this.Mi, this.T9, this.IL);
    this.Gw = new Qi(this.eN, {
        H1: "backgroundPositionX",
        AQ: [0, 0, -141, -141, -282, -282, -282, -282, -282, -282, -282, -282, -282, -282, -282, -282, -282, -282, -141, -141, 0, 0],
        ED: "px",
        Ay: 1,
        ec: 1000,
        cv: 50
    }).addEvents({
        aP: function() {
            this.lI.nj("visibility", "inherit")
        },
        dB: function() {
            this.lI.nj("visibility", "hidden")
        },
        TU: function() {
            this.lI.nj("visibility", "hidden")
        }
    });
    this.GO = Zi.gY.Rv("aT").addEvents({
        FG: function() {
            BX.Gw.zm()
        }
    });
    this.TI = function() {
        var AN = this.GV.length || 0;
        return AN
    };
    return {
        s2: function() {
            return (new H_({
                ec: 4200
            })).addEvents({
                FG: function() {
                    BX.D8.removeClass("RG");
                    BX.D8.addClass("yr");
                    BX.Mi.addClass("y5");
                    BX.Mi.removeClass("xe");
                    BX.GO.zm()
                },
                TU: function() {
                    BX.D8.addClass("RG");
                    BX.D8.removeClass("yr")
                },
                dB: function() {
                    BX.D8.addClass("RG");
                    BX.D8.removeClass("yr");
                    BX.Mi.removeClass("y5");
                    BX.Mi.addClass("xe")
                }
            })
        },
        kU: function() {
            return BX.IL
        },
        toElement: function() {
            return BX.D8
        }
    }
};
a5.Hd = (function() {
    var nB = ["w01", "w02", "s01", "s02", "s03", "s04", "s05", "s06", "s07", "s08", "s09", "b01", "b02", "s10", "s11", "s12", "s13", "s14", "s15", "s16", "s17", "s18"],
        xX = {
            nB: nB,
            KU: ["w01", "s01", "s02", "s03", "s09", "w02", "s10", "s11", "s12", "s18"].mj(),
            zN: sq.mk(nB.mj(), function() {
                return 12
            }),
            jB: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18],
            gQ: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18],
            iV: ["L0C0R0", "L0C0R1", "L0C0R2", "L0C1R0", "L0C1R1", "L0C1R2", "L0C1R3", "L0C2R0", "L0C2R1", "L0C2R2", "L0C2R3", "L0C2R4", "L0C3R0", "L0C3R1", "L0C3R2", "L0C3R3", "L0C4R0", "L0C4R1", "L0C4R2"].mj(),
            lb: ["Scatter", "Line 1", "Line 2", "Line 3", "Line 4", "Line 5", "Line 6", "Line 7", "Line 8", "Line 9", "Line 10", "Line 11", "Line 12", "Line 13", "Line 14", "Line 15", "Line 16", "Line 17", "Line 18", "Line 19", "Line 20", "Line 21", "Line 22", "Line 23", "Line 24", "Line 25", "Line 26", "Line 27", "Line 28", "Line 29", "Line 30", "Line 31", "Line 32", "Line 33", "Line 34", "Line 35", "Line 36", "Line 37", "Line 38", "Line 39", "Line 40"].mj(),
            Bn: {
                lM: 75,
                eu: 49,
                Op: 0,
                rW: 3,
                OY: [{
                    Jw: 0,
                    c9: 49,
                    iB: 75,
                    Dt: 49 * 3,
                    i7: 3,
                    SO: 3
                }, {
                    Jw: 75 + 3,
                    c9: 24,
                    iB: 75,
                    Dt: 49 * 4,
                    i7: 4,
                    SO: 4
                }, {
                    Jw: (75 + 3) * 2,
                    c9: 0,
                    iB: 75,
                    Dt: 49 * 5,
                    i7: 5,
                    SO: 5
                }, {
                    Jw: (75 + 3) * 3,
                    c9: 24,
                    iB: 75,
                    Dt: 49 * 4,
                    i7: 4,
                    SO: 4
                }, {
                    Jw: (75 + 3) * 4,
                    c9: 49,
                    iB: 75,
                    Dt: 49 * 3,
                    i7: 3,
                    SO: 3
                }, ],
                bK: 5,
                Hn: [3, 4, 5, 4, 3],
                U9: [49, 24, 0, 24, 49],
                jE: 3,
                iB: 387,
                Dt: 245,
                sK: 5,
                iP: 3,
                IX: 5,
                Pe: 49,
                l9: 75,
                fI: 3,
                gq: 10,
                EH: {
                    Nv: {
                        Dt: 0,
                        iB: 0,
                        q_: 0,
                        vv: 0,
                        Lt: 0,
                        D9: 0,
                        L2: 0
                    }
                }
            },
            KP: [{
                P8: "#ff0000"
            }, {
                P8: "#FF0000",
                HM: 1
            }, {
                P8: "#0000FF",
                HM: 1
            }, {
                P8: "#008000",
                HM: 1
            }, {
                P8: "#FFFF00",
                HM: 1
            }, {
                P8: "#FF0000",
                HM: 1
            }, {
                P8: "#0000FF",
                HM: 1
            }, {
                P8: "#008000",
                HM: 1
            }, {
                P8: "#FFFF00",
                HM: 1
            }],
            Qy: ["Jx"],
            R3: {
                s01: "iq",
                s02: "oD"
            }
        },
        Uw = (function() {
            return function(bq) {
                return xX.jB.map(function(Bv, Ig) {
                    return bq[xX.gQ[Ig]]
                })
            }
        }());
    var hl = null;
    var x8 = 0;
    return new Class({
        Extends: a5,
        Implements: Events,
        Binds: ["L4", "np", "TK", "Xg", "vW", "G3", "Ve", "jK", "cX"],
        QI: 0,
        J8: 0,
        aw: 0,
        Sg: function() {
            var BX = this,
                Ls = this.CU.Q9();
            this.mx = (new fz({
                ix: "hq",
                gs: "b5",
                RJ: zS("Game.gameRules"),
                Ts: zS("Game.buttonClose")
            })).addEvents({
                H5: function() {
                    document.body.addClass("Wl");
                    pA.vy
                },
                HL: function() {
                    document.body.removeClass("Wl");
                    pA.gD
                }
            });
            com.igt.mxf.registerControl({
                type: "command",
                name: "howToPlay",
                text: zS("MenuCommand.howToPlay"),
                enabled: 1
            }).addEvent("change", this.mx.tM.bind(this.mx, 1));
            this.Y8 = (new fz({
                ix: "sE",
                gs: "b5",
                RJ: zS("Game.payTable"),
                Ts: zS("Game.buttonClose")
            })).addEvents({
                H5: function() {
                    document.body.addClass("Wl");
                    pA.vy
                },
                HL: function() {
                    document.body.removeClass("Wl");
                    pA.gD
                }
            });
            com.igt.mxf.registerControl({
                type: "command",
                name: "paytable",
                text: zS("MenuCommand.payTable"),
                enabled: 1
            }).addEvent("change", this.Y8.tM.bind(this.Y8, 1));
            [this.mx, this.Y8].forEach(function(Pr) {
                document.body.grab(fz.jk(Pr), "top")
            }, this);
            this.FC = new BO({
                ix: "QK"
            });
            this.hZ = new Element("span", {
                id: "Mn"
            });
            this.vg = new Element("span");
            this.vg.innerHTML = zS("Game.lineWinPreText");
            this.wh = new Element("div", {
                id: "wh",
                "class": "Y_"
            });
            this.hn = new W1(xX.KP, {
                Bn: xX.Bn,
                Dj: [],
                gQ: xX.gQ,
                hi: this.dN.PatternSliderInfo.PatternInfo.Step,
                kQ: this.o9.PatternSliderInput.PatternsBet,
                I8: "#000",
                GG: 3,
                pL: 4,
                m3: "miter",
                wn: "butt",
                XT: "#0089cc"
            });
            this.qf = (new VX({
                Bn: xX.Bn,
                vN: 0,
                Sy: 5,
                E1: 50,
                vI: xX.gQ,
                X2: {},
                pb: [0, 0, 0, 0, 0],
                Uv: [1, 10, 19, 38, 55],
                Rs: new Kg({
                    oo: 800,
                    xO: 0,
                    f8: 1,
                    Vr: 1,
                    HJ: pz,
                    eh: cR,
                    Sy: 0,
                    Mu: this.o9.OutcomeDetail.Stage,
                    iT: {
                        BaseGame: {
                            w01: Zi.iT.Iu,
                            s01: Zi.iT.Fr,
                            s02: Zi.iT.wb,
                            s03: Zi.iT.o_,
                            s04: Zi.iT.IA,
                            s05: Zi.iT.QP,
                            s06: Zi.iT.Rt,
                            s07: Zi.iT.iR,
                            s08: Zi.iT.KV,
                            s09: Zi.iT.vj,
                            b01: Zi.iT.uv
                        },
                        FreeSpin: {
                            w02: Zi.iT.hB,
                            s10: Zi.iT.ME,
                            s11: Zi.iT.f3,
                            s12: Zi.iT.Y1,
                            s13: Zi.iT.zx,
                            s14: Zi.iT.Dq,
                            s15: Zi.iT.iG,
                            s16: Zi.iT.Bj,
                            s17: Zi.iT.GP,
                            s18: Zi.iT.XS,
                            b02: Zi.iT.fE
                        }
                    },
                    uL: this.Aj
                })
            })).addEvents({
                GQ: this.jK.bind(this),
                Lk: this.zD
            });
            this.CS = kX();
            this.L3 = c7();
            this.Hf = new Vi({
                nG: new Element("span"),
                Iy: XJ
            });
            this.lD = new Vi({
                nG: new Element("span"),
                Iy: XJ
            });
            this.oS = new Vi({
                nG: new Element("span"),
                Iy: Math.floor
            }).xd(50);
            com.igt.mxf.registerControl({
                type: "stake",
                name: "stake",
                text: zS("Game.consoleBet"),
                enabled: 0,
                valueText: XJ(0),
                value: 0
            }).linkEvent("change", this.Hf, "Lr");
            this.jg = new Element("div", {
                id: "FI",
                "class": "VU"
            });
            this.dz = new Vi({
                nG: new Element("span"),
                Iy: XJ,
                s1: this.o9.OutcomeDetail.Balance
            });
            this.gK = new Vi({
                nG: new Element("span"),
                Iy: XJ
            });
            this.HN = new Vi({
                nG: new Element("span")
            });
            this.Iz = new Vi({
                nG: new Element("span"),
                Iy: Math.floor
            });
            this.lG = new Vi({
                nG: new Element("span"),
                Iy: Math.floor
            });
            this.y8 = new Vi({
                nG: new Element("span"),
                Iy: Math.floor
            });
            this.k6 = new Vi({
                nG: new Element("span"),
                s1: this.o9.OutcomeDetail.Balance,
                cB: 20
            });
            com.igt.mxf.registerControl({
                type: "balance",
                name: "totalBalance",
                text: zS("Game.consoleBalance"),
                enabled: 1,
                valueText: nl(this.o9.OutcomeDetail.Balance),
                value: Ym.mf(this.o9.OutcomeDetail.Balance)
            }).addEvent("change", function(CG) {
                CG = CG >= 0 ? CG : 0;
                this.k6.xd(Ym.Vx(CG));
                this.o9.OutcomeDetail.Balance = this.k6.bu();
                this.jp(1)
            }.bind(this));
            this.Cq = new Element("div", {
                id: "fO"
            });
            this.Yr = (new AE({
                ix: "HW",
                Hq: 0
            })).addEvents({
                uh: this.L4,
                BI: this.np
            });
            this.H6 = new AE({
                ix: "qF",
                Hq: 1
            });
            this.Qp = (new AE({
                ix: "vd",
                Hq: 1
            })).addEvents({
                BI: this.np
            });
            this.oU = (new AE({
                ix: "Yh",
                Hq: 1
            })).addEvents({
                BI: this.TK
            });
            this.Xw = new Element("div", {
                id: "Fb"
            });
            this.GS = new Element("div", {
                id: "GS"
            }).addEvent("touchstart", this.TK);
            this.FS = new Element("div", {
                id: "m_"
            });
            this.M6 = new dK({
                ix: "oN",
                ZB: this.dN.PatternSliderInfo.BetInfo.Step,
                j_: XJ,
                Ul: zS("Game.selectorBetPerPattern"),
                V6: "bottom",
                u0: {
                    g7: "#555",
                    e3: 0.2,
                    tp: 1
                }
            }).addEvents({
                Lr: this.vW
            });
            var A3 = com.igt.mxf.registerControl({
                type: "list",
                name: "betPerPattern",
                text: zS("Game.buttonBetPerPattern"),
                enabled: 0,
                value: Ym.Vx(Ls.BetPerPattern[Ym]).toString(),
                valueText: this.dN.PatternSliderInfo.BetInfo.Step.map(XJ),
                values: this.dN.PatternSliderInfo.BetInfo.Step
            }).addEvent("change", function(CG) {
                this.M6.xd(CG)
            }.bind(this)).linkEvent("change", this.M6, "Lr").linkEvent("enable", this.oU, "GZ");
            this.M6.xd(Ym.Vx(Ls.BetPerPattern[Ym]).toString());
            this.Hf.xd(this.n2());
            this.lD.xd(this.n2());
            this.zM = new Element("div", {
                id: "i1"
            }).set("html", zS("Game.betPrompt"));
            this.GX = new Element("div", {
                id: "Wg",
                "class": "gI"
            }).adopt(new Element("div", {
                id: "Bg"
            }), this.zM).addEvent("touchstart", this.TK);
            this.Gs = (new Element("div", {
                id: "cf"
            })).adopt(this.D1 = (new Element("div", {
                id: "VK"
            })));
            this.gP = new Element("div", {
                id: "cO"
            });
            this.nG.adopt(this.gP.adopt(new Element("div", {
                id: "e2"
            }).adopt(this.zG = new Element("div", {
                id: "zG"
            }).adopt(this.qf, this.hn, this.Xw.adopt(new Element("div", {
                id: "Oo",
                "class": "VU"
            }).adopt(new Element("span", {
                "class": "A7",
                text: zS("Game.freeSpinLinesMultiWay")
            }), this.oS, new Element("span", {
                "class": "A7",
                text: zS("Game.consoleCoins")
            })), this.M6, this.GS, new Element("div", {
                id: "uX",
                "class": "VU"
            }).adopt(this.lD, new Element("span", {
                "class": "A7",
                text: zS("Game.consoleBet")
            }))), this.ZW = GJ(this.zG)), this.Bf), this.CS, this.L3, this.FC, this.Cq.adopt(this.Yr, this.H6, this.Qp), this.Gs, this.oU, this.GX, new Element("div", {
                id: "z3"
            }).adopt(this.FS.adopt(new Element("div", {
                id: "Cc",
                "class": "VU"
            }).adopt(this.k6, new Element("span", {
                "class": "A7",
                text: zS("Game.consoleBalance")
            })), new Element("div", {
                id: "FI",
                "class": "VU jQ"
            }).adopt(this.dz, new Element("span", {
                "class": "A7",
                text: zS("Game.consoleWin")
            })), new Element("div", {
                id: "Sp",
                "class": "VU"
            }).adopt(this.Hf, new Element("span", {
                "class": "A7",
                text: zS("Game.consoleBet")
            })), new Element("div", {
                id: "G7",
                "class": "VU"
            }).adopt(this.HN, new Element("span", {
                "class": "A7",
                text: zS("Game.consoleBonusCount")
            })), new Element("div", {
                id: "EO",
                "class": "VU"
            }).adopt(new Element("span", {
                "class": "PG"
            }).adopt(this.lG, new Element("span", {
                text: " " + zS("Game.consoleSpinsPlayedOf") + " "
            }), this.y8), new Element("span", {
                "class": "A7",
                text: zS("Game.consoleSpins")
            })), new Element("div", {
                id: "Lb",
                "class": "VU"
            }).adopt(this.gK, new Element("span", {
                "class": "A7",
                text: zS("Game.consoleBonus")
            }))))), new Element("div", {
                id: "ZA"
            }).adopt(new Element("div", {
                id: "XQ"
            }), new Element("div", {
                id: "DJ"
            }), new Element("div", {
                id: "Bd",
                text: zS("Game.rotateMessage")
            })));
            this.Ro();
            this.aw = 1;
            if (this.o9.OutcomeDetail.NextStage == "FreeSpin") {
                BX.o9.PrizeOutcome["BaseGame.LeftRightMultiWay"].Prize.sort(function(s8, M7) {
                    return s8["@payName"].slice(-3) == "b01" ? -999999 : s8["@totalPay"] == 0 ? 1 : M7["@payName"].slice(-3) == "b01" ? 1 : M7["@totalPay"] == 0 ? -1 : M7["@totalPay"] - s8["@totalPay"] || s8.tH - M7.tH
                });
                BX.Di = BX.o9.PrizeOutcome["BaseGame.LeftRightMultiWay"].Prize[0]["@totalPay"];
                var CG = BX.Di + BX.o9.PrizeOutcome["FreeSpin.Total"];
                BX.gK.xd(CG);
                BX.gK.nG.nj("opacity", (CG > 0) ? 1 : 0);
                BX.Yr.tM(0)
            }
            if (this.o9.OutcomeDetail.Stage == "FreeSpin" && this.o9.OutcomeDetail.NextStage == "FreeSpin") {
                document.body.addClass("X7");
                this.lG.xd(this.o9.FreeSpinOutcome.Count);
                this.y8.xd(this.o9.FreeSpinOutcome.TotalAwarded);
                BX.oU.GZ(0);
                setTimeout(function() {
                    BX.Yt.zm()
                }, 0)
            } else {
                if (this.o9.OutcomeDetail.NextStage == "FreeSpin") {
                    BX.oU.GZ(0);
                    setTimeout(function() {
                        BX.Yt.zm()
                    }, 0)
                } else {
                    document.body.addClass("oK");
                    this.l0.zm();
                    this.lX();
                    Zi.gY.Sa("Yk");
                    this.jp(1)
                }
            }
            this.qf.dn(this.o9.PopulationOutcome[this.o9.OutcomeDetail.Stage + ".Reels"].hs, this.o9.OutcomeDetail.Stage);
            this.U7(function(wM) {
                var BX = this,
                    TC = [],
                    Gz = [],
                    CM = a5.o6,
                    Pw = sq.mk(xX.nB.concat(["menu", "left", "right", "tick", "spin"]).mj(), function(Bv, Wz) {
                        return '<img class="' + Wz + '"/>'
                    });
                wM.Paytable.PaytableStatistics.toString = function() {
                    return zS(this["@minRTP"] == this["@maxRTP"] ? "Paytable.RTPvalue" : "Paytable.RTPrange", this).substitute(this)
                };
                Pw.RTP = wM.Paytable.PaytableStatistics.toString();
                Pw.awardCap = XJ(Ym.Vx(CM.T2(wM.Paytable.AwardCapInfo)));
                var qP = xX.KP.map(function(vc, Pk) {
                    return vc.hs && this.F1(11, 11, vc, Pk)
                }, this.hn);
                zS("Game.sboxPaytable").forEach(function(q4) {
                    var x8 = Elements.MI(q4.substitute(Pw)),
                        xz = (new Element("div")).adopt(x8);
                    pp = xz.querySelector("winlinediagrams");
                    pp && pp.adopt(qP);
                    TC.push(xz)
                });
                this.Y8.QX(TC);
                zS("Game.sboxHowToPlay").forEach(function(q4) {
                    var x8 = Elements.MI(q4.substitute(Pw)),
                        xz = (new Element("div")).adopt(x8);
                    Gz.push(xz)
                });
                this.mx.QX(Gz)
            }.bind(this));
            m6()
        },
        lX: function() {
            var BX = this;
            var wh = zS("Game.marketingMessages").replace("{b01}", '<img class="b01"/>').replace("{w01}", '<img class="w01"/>').split("|"),
                tM = true;
            if (wh.length > 0) {
                x8 = 0;
                hl = setInterval(function() {
                    if (tM) {
                        BX.FC.wc();
                        BX.FC.nj("color", "#fff").ft(zS(wh[x8], "#fff"));
                        BX.FC.nG.addClass("p5");
                        BX.FC.nG.addClass("tM");
                        x8++
                    } else {
                        BX.FC.wc();
                        BX.FC.nG.removeClass("p5");
                        BX.FC.nG.removeClass("tM")
                    }
                    tM = !tM;
                    x8 > wh.length - 1 && (x8 = 0)
                }, 5000)
            }
        },
        Ro: function() {
            var BX = this,
                LZ = function() {
                    return BX.o9.PrizeOutcome[BX.WD + ".Scatter"]["@totalPay"] + BX.o9.PrizeOutcome[BX.WD + ".LeftRightMultiWay"]["@totalPay"] + BX.o9.PrizeOutcome[BX.WD + ".RightLeftMultiWay"]["@totalPay"]
                },
                JO = function(x8, P8) {
                    BX.FC.wc();
                    BX.FC.nj("color", P8 || "#fff").ft(x8);
                    BX.FC.nG.addClass("tM")
                },
                wP = function(x8, P8) {
                    BX.FC.Zt();
                    BX.FC.q2("color", P8 || "").L1(x8 || "");
                    BX.FC.nG.addClass("tM")
                },
                hD = function(x8, P8) {
                    BX.FC.Zt();
                    BX.FC.W_("color", P8 || "").vX(x8 || "");
                    BX.FC.nG.addClass("tM")
                },
                tn = function(CG) {
                    BX.dz.xd(CG);
                    BX.dz.nG.nj("opacity", 1);
                    BX.jg.addClass("kj")
                },
                XN = function(CG) {
                    BX.gK.xd(CG);
                    BX.gK.nG.nj("opacity", (CG > 0) ? 1 : 0)
                },
                wF = new Nh((new H_({
                    ec: 600
                })).addEvents({
                    FG: function() {
                        BX.o9.PrizeOutcome[BX.WD + ".LeftRightMultiWay"].Prize.sort(function(s8, M7) {
                            return s8["@totalPay"] == 0 ? 1 : M7["@totalPay"] == 0 ? -1 : M7["@totalPay"] - s8["@totalPay"] || s8.tH - M7.tH
                        });
                        BX.o9.PrizeOutcome[BX.WD + ".RightLeftMultiWay"].Prize.sort(function(s8, M7) {
                            return s8["@totalPay"] == 0 ? 1 : M7["@totalPay"] == 0 ? -1 : M7["@totalPay"] - s8["@totalPay"] || s8.tH - M7.tH
                        });
                        var y1 = BX.o9.PrizeOutcome[BX.WD + ".LeftRightMultiWay"].Prize.concat(BX.o9.PrizeOutcome[BX.WD + ".RightLeftMultiWay"].Prize);
                        y1.sort(function(s8, M7) {
                            return s8["@totalPay"] == 0 ? 1 : M7["@totalPay"] == 0 ? -1 : M7["@totalPay"] - s8["@totalPay"] || s8.tH - M7.tH
                        });
                        y1 = BX.o9.PrizeOutcome[BX.WD + ".Scatter"].Prize.concat(y1);
                        y1.forEach(function(yp, Pk) {
                            yp.tH = 0 + (Pk + 1)
                        });
                        BX.hn.e0(y1).M_(1)
                    },
                    dB: function() {},
                    TU: function() {
                        BX.hn.M_(0)
                    }
                }), function() {
                    return BX.o9.PrizeOutcome[BX.WD + ".LeftRightMultiWay"].Prize.concat(BX.o9.PrizeOutcome[BX.WD + ".RightLeftMultiWay"].Prize, BX.o9.PrizeOutcome[BX.WD + ".Scatter"].Prize).length > 0
                }),
                ET = new Qi(null, {
                    H1: "backgroundPositionX",
                    AQ: Array.g5(1, 12, 12, -xX.Bn.l9),
                    ED: "px",
                    cv: 100
                }).addEvents({
                    FG: function() {
                        BX.qf.UC.forEach(function(mm) {
                            mm.addClass("S9")
                        });
                        this.Ay = (BX.o9.OutcomeDetail.Stage == "BaseGame" && BX.o9.OutcomeDetail.NextStage == "FreeSpin") ? 0 : 1;
                        var eM = BX.o9.PrizeOutcome[BX.WD + ".Scatter"],
                            tB = BX.o9.PrizeOutcome[BX.WD + ".LeftRightMultiWay"],
                            tq = BX.o9.PrizeOutcome[BX.WD + ".RightLeftMultiWay"],
                            RE = eM.p_.concat(tB.p_, tq.p_);
                        YN = BX.qf.Lu(RE.filter(function(Bv) {
                            return "b01" == BX.o9.PopulationOutcome[BX.WD + ".Reels"].hs[Bv] || "b02" == BX.o9.PopulationOutcome[BX.WD + ".Reels"].hs[Bv]
                        }));
                        this.P1(YN)
                    },
                    Mx: function(Bv, vn) {
                        if (this.Ay < 1 && vn >= 10 && this.C4.rs == 12) {
                            this.C4.rs = 4;
                            this.C4.JQ = 4;
                            this.C4.AQ = Array.g5(7, 10, 12, -xX.Bn.l9);
                            this.C4.E8 = 0
                        }
                    },
                    dB: function() {
                        YN.nj("background-position-x", "");
                        this.C4.rs = 12;
                        this.C4.JQ = 12;
                        this.C4.AQ = Array.g5(1, 12, 12, -xX.Bn.l9)
                    },
                    TU: function() {
                        YN.nj("background-position-x", "");
                        this.C4.rs = 12;
                        this.C4.JQ = 12;
                        this.C4.AQ = Array.g5(1, 12, 12, -xX.Bn.l9)
                    }
                }),
                wv = new Nh((new Qi(null, {
                    H1: "backgroundPositionX",
                    AQ: Array.g5(1, 12, 12, -xX.Bn.l9),
                    ED: "px",
                    cv: 100,
                    Ay: 1
                })).addEvents({
                    FG: function() {
                        var eM = BX.o9.PrizeOutcome[BX.WD + ".Scatter"],
                            qS = BX.o9.PrizeOutcome[BX.WD + ".Lines"],
                            tB = BX.o9.PrizeOutcome[BX.WD + ".LeftRightMultiWay"],
                            tq = BX.o9.PrizeOutcome[BX.WD + ".RightLeftMultiWay"],
                            y1 = eM.Prize.concat(qS.Prize, tB.Prize, tq.Prize),
                            wN = BX.o9.PopulationOutcome[BX.WD + ".Reels"].hs,
                            RE = eM.p_.concat(qS.p_, tB.p_, tq.p_),
                            YN;
                        YN = BX.qf.Lu(RE.filter(function(Bv) {
                            return wN[Bv] in xX.KU
                        }));
                        y1.sort(function(s8, M7) {
                            return s8["@totalPay"] == 0 ? 1 : M7["@totalPay"] == 0 ? -1 : M7["@totalPay"] - s8["@totalPay"] || s8.tH - M7.tH
                        });
                        if (BX.o9.OutcomeDetail.Stage.match(/^BaseGame/)) {}
                        mc = BX.qf.Lu(RE.filter(function(Bv) {
                            return !(wN[Bv] in xX.KU) && "b01" != wN[Bv]
                        }));
                        this.P1(YN)
                    },
                    Mx: function(G0, Mq) {
                        Mq % 3 || (Mq % 6 ? mc.addClass("UD") : mc.removeClass("UD"))
                    },
                    dB: function() {
                        mc.removeClass("UD")
                    },
                    TU: function() {
                        mc.removeClass("UD")
                    }
                }), function() {
                    return BX.o9.AwardCapOutcome.AwardCapExceeded != "true" && LZ && LZ() >= BX.n2() * 2
                }),
                Nd = BX.Nd = (function() {
                    var y1 = [],
                        Ny, X6 = 0,
                        jj = BX.qf.toElement();
                    return (new Qi(null, {
                        H1: "backgroundPositionX",
                        AQ: [0, 0, 0, 0, 0, 0, 0, 0],
                        ED: "px",
                        cv: 100
                    })).addEvents({
                        FG: function(G0) {
                            var YN, eM = BX.o9.PrizeOutcome[BX.WD + ".Scatter"],
                                YJ = BX.o9.PrizeOutcome[BX.WD + ".LeftRightMultiWay"],
                                tq = BX.o9.PrizeOutcome[BX.WD + ".RightLeftMultiWay"],
                                qS = BX.o9.PrizeOutcome[BX.WD + ".Lines"];
                            G0.X6 = 1;
                            if (BX.o9.OutcomeDetail.Stage.match(/^BaseGame/) && BX.o9.OutcomeDetail.NextStage == "FreeSpin") {
                                YN = eM.Qx.concat(qS.Qx);
                                Sf = [];
                                y1 = []
                            } else {
                                YN = eM.p_.concat(qS.p_);
                                Sf = BX.o9.PrizeOutcome[BX.WD + ".LeftRightMultiWay"].Prize.concat(BX.o9.PrizeOutcome[BX.WD + ".RightLeftMultiWay"].Prize);
                                y1 = eM.Prize.concat(qS.Prize, Sf)
                            }
                            y1.sort(function(s8, M7) {
                                return s8["@totalPay"] == 0 ? 1 : M7["@totalPay"] == 0 ? -1 : M7["@totalPay"] - s8["@totalPay"] || s8.tH - M7.tH
                            });
                            Ny = 0;
                            this.Ne(y1.length);
                            jj.addClass("A4");
                            this.fireEvent("kq")
                        },
                        Mx: function(G0, Mq) {
                            Mq % 2 || Mq % 4 ? Ny.aQ.removeClass("UD") : Ny.aQ.addClass("UD")
                        },
                        kq: function(G0, Ay) {
                            rS = BX.o9.OutcomeDetail.Stage == "FreeSpin" && BX.o9.OutcomeDetail.NextStage == "BaseGame";
                            Ny && BX.hn.M_(0);
                            Ny = y1.shift();
                            Ny.Cx = BX.qf.Lu(Ny.RE.filter(function(Bv) {
                                return BX.o9.PopulationOutcome[BX.WD + ".Reels"].hs[Bv] in xX.KU
                            }));
                            Ny.aQ = BX.qf.Lu(Ny.RE.filter(function(Bv) {
                                return true
                            }));
                            var bP = Ny["@totalPay"] + (Ny["@payName"].slice(-3) == "b01" && rS && BX.o9.PrizeOutcome["FreeSpin.Total"]);
                            var ZH = BX.o9.OutcomeDetail.Stage == "FreeSpin" && BX.o9.OutcomeDetail.NextStage != "BaseGame" ? BX.o9.OutcomeDetail.Pending : BX.o9.OutcomeDetail.Settled;
                            this.P1(Ny.Cx);
                            BX.hn.iF(Ny).M_(1);
                            var Jy;
                            if (rS && Ny["@payName"].slice(-3) == "b01" && BX.o9.OutcomeDetail.NextStage == "BaseGame") {
                                Jy = gd("Game.freeSpinWin", XJ(bP))
                            } else {
                                if (Ny["@ways"] > 0) {
                                    Jy = gd("Game.multiwayWin", Ny["@ways"] > 1 ? XJ(bP / Ny["@ways"]) + " X " + Ny["@ways"] : XJ(bP))
                                } else {
                                    Jy = bP ? gd("Game.scatterWin", XJ(bP)) : zS("Game.bonusCompleteNoWin")
                                }
                            }
                            wP(Jy);
                            BX.Nd.X6++
                        },
                        dB: function() {
                            $$(".qf .rP").removeClass("UD");
                            jj.removeClass("A4");
                            if (Ny && (BX.o9.OutcomeDetail.NextStage == "FreeSpin" || (rS && BX.WD != "BaseGame"))) {
                                Ny["@name"] != "Scatter" && BX.hn.M_(0)
                            }
                            wP()
                        },
                        TU: function() {
                            $$(".qf .rP").removeClass("UD");
                            jj.removeClass("A4");
                            wP()
                        },
                        I_: function() {
                            $$(".qf .rP").removeClass("UD");
                            jj.removeClass("A4");
                            Ny && BX.hn.M_(0);
                            y1 = 0
                        }
                    })
                }()),
                w6 = (new Nh((new SK(BX.L3.wK(), new H_({
                    ec: 1150
                }), BX.L3.Sv())).addEvents({
                    FG: function() {
                        var dU = gd("Game.capFreeSpin", BX.o9.FreeSpinOutcome.TotalAwarded, BX.o9.FreeSpinOutcome.Awarded == "0" ? zS("Game.capFreeSpinNo") : BX.o9.FreeSpinOutcome.Awarded);
                        BX.L3.QX(dU)
                    }
                }), function() {
                    return BX.o9.FreeSpinOutcome.IncrementTriggered == "true" && BX.o9.FreeSpinOutcome.MaxAwarded == "true"
                })),
                SN = (new Nh((new SK(ET, BX.L3.wK(), new H_({
                    ec: 1150
                }), BX.L3.Sv())).addEvents({
                    FG: function() {
                        BX.L3.QX(gd("Game.bonusRetrigger", BX.o9.FreeSpinOutcome.Awarded))
                    }
                }), function() {
                    return BX.o9.FreeSpinOutcome.IncrementTriggered == "true" && BX.o9.FreeSpinOutcome.Awarded != 0 && BX.o9.FreeSpinOutcome.MaxAwarded == "false"
                })),
                kU = BX.ZW.kU();
            OD = kU.s2().addEvents({
                dB: function() {
                    kU.xd(BX.o9.PrizeOutcome["Game.Total"])
                }
            });
            Oe = new Nh(this.ZW.s2().addEvents({
                FG: function() {
                    BX.Cq.removeClass("gI");
                    BX.Yr.tM(0);
                    BX.H6.tM(1);
                    BX.qf.UC.forEach(function(mm) {
                        mm.addClass("S9")
                    });
                    if (He.Q_ == "Lj") {
                        kU.xd(BX.o9.PrizeOutcome["Game.Total"])
                    } else {
                        kU.xd(0);
                        kU.DZ(BX.o9.PrizeOutcome["Game.Total"], BX.o9.PatternSliderInput.BetPerPattern * BX.o9.PatternSliderInput.PatternsBet)
                    }
                    OD.zm()
                },
                dB: function() {
                    tn(BX.o9.PrizeOutcome["Game.Total"]);
                    BX.H6.tM(0);
                    BX.Yr.tM(1);
                    BX.qf.UC.forEach(function(mm) {
                        mm.removeClass("S9")
                    })
                },
                TU: function() {
                    OD.pT();
                    tn(BX.o9.PrizeOutcome["Game.Total"]);
                    BX.H6.tM(0);
                    BX.Yr.tM(1);
                    BX.qf.UC.forEach(function(mm) {
                        mm.removeClass("S9")
                    })
                }
            }), function() {
                return BX.o9.AwardCapOutcome.AwardCapExceeded != "true" && BX.o9.OutcomeDetail.Payout >= BX.o9.OutcomeDetail.Settled * 10 && BX.o9.OutcomeDetail.Settled > 0 && BX.WD === "BaseGame"
            }), LD = new SK(wF, BX.Nd).addEvents({
                FG: function() {
                    this.Ay = BX.WD == "BaseGame" ? Infinity : 1
                }
            }), this.l0 = new Nh((new H_({
                ec: 500
            }).addEvents({
                FG: function() {
                    !BX.fV() && BX.Bf.nG.addClass("VN")
                },
                aP: function() {
                    BX.GX.removeClass("gI")
                }
            })), function() {
                return ((!BX.o9.PromotionalFreeSpin) && (BX.k6.bu() > 0))
            });
            LE = new Nh((new SK(wv, LD)).addEvents({
                FG: function() {
                    var UZ = BX.n2(),
                        xx = BX.o9.PrizeOutcome["Game.Total"];
                    LB = "";
                    if (BX.WD == "BaseGame") {
                        xx >= UZ * 5 && (LB = "iq");
                        xx >= UZ * 10 && (LB = "oD");
                        LB && Zi.gY.Sa(LB)
                    }
                    if (BX.o9.OutcomeDetail.Stage == "BaseGame" && BX.WD == "BaseGame" || BX.o9.OutcomeDetail.Stage == "FreeSpin" && BX.WD == "BaseGame") {
                        BX.OO()
                    } else {
                        BX.Cq.removeClass("gI");
                        BX.H6.tM(1)
                    }
                },
                TU: function() {
                    BX.FC.kI("");
                    BX.Nd.fireEvent("I_");
                    if (BX.WD == "BaseGame") {
                        if (!Zi.gY.wz("MW") && !Zi.gY.wz("Jx")) {
                            Zi.gY.x3()
                        }
                    } else {
                        BX.Cq.addClass("gI");
                        BX.H6.tM(0)
                    }
                },
                dB: function() {
                    BX.FC.kI("");
                    BX.Nd.fireEvent("I_");
                    if (BX.o9.OutcomeDetail.Stage == "BaseGame" && BX.WD == "BaseGame") {
                        if (!Zi.gY.wz("MW") && !Zi.gY.wz("Jx")) {
                            Zi.gY.x3()
                        }
                    } else {
                        BX.Cq.addClass("gI");
                        BX.H6.tM(0)
                    }
                }
            }), function() {
                var c8 = BX.o9.OutcomeDetail.Stage == "FreeSpin" && BX.WD == "BaseGame";
                return BX.o9.AwardCapOutcome.AwardCapExceeded == "false" && (LZ() || (BX.o9.PrizeOutcome["FreeSpin.Total"] && c8))
            }), Hr = new Nh((new SK(new H_({
                ec: 8000
            }), new H_({
                ec: 2000
            }).addEvents({
                FG: function() {
                    this.Ux = pA.aC(function() {
                        if (Zi.gY.nG.volume > 0) {
                            if (Zi.gY.nG.volume - 0.05 <= 0) {
                                Zi.gY.nG.volume = 0;
                                pA.sl(this.Ux)
                            } else {
                                Zi.gY.nG.volume -= 0.05
                            }
                        }
                    }.bind(this), 50)
                }
            }))).addEvents({
                FG: function() {},
                dB: function() {
                    if (this.Ux) {
                        pA.sl(this.Ux)
                    }
                    Zi.gY.x3();
                    Zi.gY.nG.volume = 1
                },
                TU: function() {
                    if (this.Ux) {
                        pA.sl(this.Ux)
                    }
                    Zi.gY.nG.volume = 1
                }
            }), function() {
                return Zi.gY.wz("Jx")
            }), RW = new Nh((BX.Bf.kg("Q6")).addEvents({
                FG: function() {
                    Zi.gY.x3();
                    BX.zG.nj("z-index", "1");
                    BX.Bf.QX(gd("Game.capAward", XJ(BX.o9.PrizeOutcome["Game.Total"]))).BW("zf", new AE({
                        uo: zS("Game.buttonOk"),
                        Hq: 1
                    })).tM(1)
                },
                dB: function() {
                    BX.zG.nj("z-index", "");
                    BX.OO()
                }
            }), function() {
                return BX.o9.AwardCapOutcome.AwardCapExceeded == "true"
            }), vE = (new IW(LE, new H_({
                ec: 1000
            }))).addEvents({
                FG: function() {
                    BX.y8.xd(BX.o9.FreeSpinOutcome.TotalAwarded);
                    BX.lG.xd(BX.o9.FreeSpinOutcome.Count);
                    var cQ = BX.o9.PrizeOutcome["FreeSpin.Total"] + BX.Di;
                    if (BX.o9.AwardCapOutcome.AwardCapExceeded == "true") {
                        cQ = BX.o9.PrizeOutcome["Game.Total"]
                    }
                    XN(cQ)
                },
                dB: function() {
                    if (BX.o9.OutcomeDetail.NextStage == "BaseGame") {
                        Zi.gY.Sa("gO");
                        BX.FC.wc().nm("display", "");
                        BX.FC.nG.removeClass("tM")
                    }
                }
            }), Xb = (new H_({
                ec: 2000
            })).addEvents({
                FG: function() {
                    document.body.toggleClass("X7");
                    BX.qf.UC.forEach(function(mm) {
                        mm.removeClass("S9")
                    });
                    BX.o9.PrizeOutcome["FreeSpin.Total"] && BX.FC.wc().nm("display", "");
                    BX.FC.nG.removeClass("tM");
                    BX.Nd.pT();
                    BX.qf.dn(BX.o9.PopulationOutcome[BX.o9.OutcomeDetail.NextStage + ".Reels"].hs, BX.o9.OutcomeDetail.NextStage);
                    BX.lG.xd(BX.o9.FreeSpinOutcome.Count);
                    BX.y8.xd(BX.o9.FreeSpinOutcome.TotalAwarded);
                    BX.o9.PrizeOutcome["BaseGame.LeftRightMultiWay"].Prize.sort(function(s8, M7) {
                        return s8["@payName"].slice(-3) == "b01" ? -999999 : s8["@totalPay"] == 0 ? 1 : M7["@payName"].slice(-3) == "b01" ? 1 : M7["@totalPay"] == 0 ? -1 : M7["@totalPay"] - s8["@totalPay"] || s8.tH - M7.tH
                    });
                    BX.Di = BX.o9.PrizeOutcome["BaseGame.LeftRightMultiWay"].Prize[0]["@totalPay"];
                    XN(BX.Di);
                    document.body.offsetWidth;
                    BX.WD = BX.o9.OutcomeDetail.NextStage
                },
                dB: function() {
                    BX.FC.jA().removeClass("mO")
                }
            });
            this.cW = (new SK(Oe, RW, LE)).addEvents({
                FG: function() {
                    var xx = BX.o9.PrizeOutcome["Game.Total"],
                        aT = BX.o9.AwardCapOutcome.AwardCapExceeded != "true" && BX.o9.OutcomeDetail.Payout >= BX.o9.OutcomeDetail.Settled * 10 && BX.o9.OutcomeDetail.Settled > 0 && BX.WD === "BaseGame",
                        rS = BX.o9.OutcomeDetail.Stage == "FreeSpin" && BX.o9.OutcomeDetail.NextStage == "BaseGame";
                    if (xx) {
                        !aT && tn(xx)
                    } else {
                        BX.OO();
                        BX.lX()
                    }
                },
                TU: function() {}
            });
            this.vE = (new SK(w6, SN, vE)).addEvents({
                FG: function() {
                    if (BX.o9.AwardCapOutcome.AwardCapExceeded == "false" && LZ()) {
                        hD(gd("Game.bonusWin", XJ(LZ())));
                        wP()
                    }
                },
                dB: function() {
                    BX.H6.tM(0);
                    BX.Cq.addClass("gI");
                    BX.Ve()
                }
            });
            this.H6.addEvent("uh", function() {
                BX.o9.OutcomeDetail.Stage == "FreeSpin" && BX.WD == "FreeSpin" ? LE.pT() : Oe.pT()
            });
            this.Yt = this.Qp.kg("uh").addEvents({
                FG: function() {
                    Zi.gY.Sa("MW", Infinity);
                    ET.zm();
                    BX.Cq.removeClass("gI");
                    BX.Yr.tM(0);
                    BX.Qp.tM(1);
                    BX.FC.wc().nm("display", "");
                    BX.FC.nG.removeClass("tM");
                    BX.FC.QX(zS("Game.freeSpinPrompt")).jA().addClass("mO");
                    BX.FC.nG.addClass("tM")
                },
                dB: function() {
                    ET.pT();
                    BX.Zx();
                    BX.Cq.addClass("gI");
                    BX.Qp.tM(0);
                    BX.FC.wc().jA().removeClass("mO");
                    BX.FC.nG.removeClass("tM")
                }
            });
            this.O1 = (new SK(BX.CS.wK(), Xb, BX.CS.Sv(), BX.CS.zp())).addEvents({
                FG: function() {
                    BX.FC.nG.removeClass("tM");
                    BX.CS.QX(gd("Game.bonusWelcome", BX.o9.FreeSpinOutcome.TotalAwarded))
                },
                dB: function() {
                    BX.Ve();
                    BX.FC.nG.removeClass("tM")
                }
            });
            this.qX = (new SK(vE, BX.CS.wK(), Xb, BX.CS.Sv(), BX.CS.zp(), this.cW).addEvents({
                FG: function() {
                    var cQ = BX.o9.PrizeOutcome["FreeSpin.Total"] + BX.Di;
                    if (BX.o9.AwardCapOutcome.AwardCapExceeded == "true") {
                        cQ = BX.o9.PrizeOutcome["Game.Total"]
                    }
                    BX.CS.QX(cQ ? gd("Game.bonusCompleteWin", XJ(cQ)) : zS("Game.bonusCompleteNoWin"));
                    BX.FC.nG.removeClass("tM")
                },
                TU: function() {
                    BX.H6.tM(0)
                },
                dB: function() {
                    BX.H6.tM(0)
                }
            }));
            this.p4 = new Qi(this.D1, {
                H1: "backgroundPositionX",
                AQ: Array.g5(1, 9, 9, -130),
                ED: "px",
                Ay: 0,
                cv: 30,
                ec: 1500
            }).addEvents({
                aP: function() {
                    BX.Gs.style.visibility = "visible"
                },
                TU: function() {
                    BX.Gs.style.visibility = ""
                }
            })
        },
        wU: function(KZ) {
            sq.h0(KZ.PatternSliderInfo, function(tc) {
                tc.Step = Array.UT(tc.Step).map(function(vn) {
                    return vn
                })
            });
            this.dN = KZ;
            this.Aj = {};
            KZ.StripInfo.forEach(function(wg) {
                this.Aj[wg["@name"]] = [];
                wg.Strip.forEach(function(HT) {
                    var x4 = HT["#text"].split(",");
                    this.Aj[wg["@name"]].push(x4)
                }, this)
            }, this)
        },
        Vs: function(wM) {
            var starttime = Date.now();
            wM.PopulationOutcome = a5.o6.QV(Array.UT(wM.PopulationOutcome).map(function(mr) {
                mr.hs = Uw(mr["#text"].split(","));
                delete mr["#text"];
                return mr
            }))
        },
        I9: function(wM) {
            var starttime = Date.now();
            var CM = a5.o6;
            wM.PrizeOutcome = CM.QV(Array.UT(wM.PrizeOutcome));
            ["BaseGame.Lines", "FreeSpin.Lines", "BaseGame.Scatter", "FreeSpin.Scatter", "BaseGame.LeftRightMultiWay", "FreeSpin.LeftRightMultiWay", "BaseGame.RightLeftMultiWay", "FreeSpin.RightLeftMultiWay"].forEach(function(gn) {
                wM.PrizeOutcome[gn] = wM.PrizeOutcome[gn] || {}
            });
            sq.h0(wM.PrizeOutcome, function(PL) {
                PL["@totalPay"] = CM.T2(PL["@totalPay"]);
                PL.p_ = [];
                PL.rc = {};
                PL.Prize = Array.UT(PL.Prize).map(function(yp) {
                    PL.rc[yp["@name"]] = yp.RE = [];
                    yp["@totalPay"] = CM.T2(yp["@totalPay"]);
                    yp.tH = xX.lb[yp["@name"]] || 0;
                    yp.FB = xX.KP[yp.tH];
                    return yp
                })
            });
            Array.UT(wM.HighlightOutcome).forEach(function(PL) {
                var Yg = wM.PrizeOutcome[PL["@name"]];
                Yg && Array.UT(PL.Highlight).forEach(function(ML) {
                    var Wd = Yg && Yg.rc[ML["@name"]];
                    if (Wd) {
                        [].push.apply(Wd, ML["#text"].split(",").Ix(xX.iV));
                        Yg.p_.combine(Wd)
                    }
                })
            });
            delete wM.HighlightOutcome;
            wM.OutcomeDetail.Payout = CM.T2(wM.OutcomeDetail.Payout);
            if (wM.FreeSpinOutcome) {
                wM.FreeSpinOutcome.Count = CM.cw(wM.FreeSpinOutcome.Count);
                wM.FreeSpinOutcome.TotalAwarded = CM.cw(wM.FreeSpinOutcome.TotalAwarded)
            }
            if (wM.PrizeOutcome["Game.Total"]) {
                Yg = wM.PrizeOutcome;
                Yg["Game.Total"] = Yg["Game.Total"]["@totalPay"];
                if (Yg["FreeSpin.Total"]) {
                    Yg["FreeSpin.Total"] = wM.Outcome && wM.AwardCapOutcome.AwardCapExceeded == "true" ? Yg["Game.Total"] : Yg["FreeSpin.Total"]["@totalPay"]
                }
            }
            this.WD = wM.OutcomeDetail.Stage;
            return wM
        },
        np: function() {
            this.Bf.nG.removeClass("VN")
        },
        L4: function() {
            LE.pT();
            this.Xg();
            this.jg.removeClass("kj");
            this.dz.nG.nj("opacity", "");
            this.Xw.removeClass("bB").addClass("io");
            this.FC.nG.removeClass("p5");
            this.FC.nG.removeClass("tM");
            clearInterval(hl);
            this.Cq.addClass("gI");
            this.oU.GZ(0);
            this.Bf.nG.removeClass("VN");
            this.FC.wc().nm("display", "");
            this.hn.M_(0);
            this.hg();
            m6()
        },
        zn: function(GZ) {
            var d4 = GZ && this.o9.OutcomeDetail.NextStage == "BaseGame",
                fV = this.fV();
            !fV && this.FC.nG.removeClass("p5") && this.FC.nG.removeClass("tM");
            this.Yr.GZ(GZ && fV);
            if (GZ && this.fV() && (this.Xw.className.indexOf("bB") == -1)) {
                this.Yr.tM(1);
                this.oU.GZ(1);
                this.Cq.removeClass("gI")
            } else {
                this.Yr.tM(0)
            }
            d4 && this.k6.xd(this.o9.OutcomeDetail.Balance);
            this.oU.GZ(d4 && 0 < this.k6.bu());
            GZ || this.p4.pT()
        },
        fV: function() {
            var k0 = this.o9.OutcomeDetail.NextStage != "BaseGame" || 0 <= Ym.mf(this.o9.OutcomeDetail.Balance - this.n2());
            if (!k0) {
                this.Bf.QX(zS("Error.insufficientFunds"));
                clearInterval(hl);
                this.FC.wc();
                this.FC.nG.removeClass("p5");
                this.FC.nG.removeClass("tM")
            }
            this.Bf.tM(!k0);
            return k0
        },
        G3: function() {
            if (this.o9.OutcomeDetail.NextStage == "BaseGame") {
                this.FC.nG.removeClass("tM");
                this.k6.xd(Math.max(0, this.k6.bu() - this.n2()))
            } else {
                this.FC.L1(zS("Game.freeSpinLinesMultiWay"));
                this.FC.vX(gd("Game.freeSpinCoinValue", XJ(this.M6.bu())));
                this.lG.xd(this.o9.FreeSpinOutcome.Count + 1);
                this.FC.nG.addClass("tM")
            }
            this.qf.G3()
        },
        ud: function() {
            this.jp(0);
            if (!Zi.gY.wz("MW") && !Zi.gY.wz("Jx")) {
                this.o9.OutcomeDetail.NextStage == "FreeSpin" ? Zi.gY.Sa("MW", Infinity) : Zi.gY.Sa("Jx", Infinity)
            }
            setTimeout(this.G3, 0)
        },
        jK: function() {
            this.p4.zm();
            this.pS({
                GameLogicRequest: {
                    TransactionId: this.o9.OutcomeDetail.TransactionId,
                    ActionInput: {
                        Action: "play"
                    },
                    PatternSliderInput: {
                        BetPerPattern: this.M6.bu(),
                        PatternsBet: this.o9.PatternSliderInput.PatternsBet
                    }
                }
            })
        },
        sB: function() {
            this.p4.zm();
            this.pS({
                GameLogicRequest: {
                    TransactionId: this.o9.OutcomeDetail.TransactionId,
                    ActionInput: {
                        Action: "play"
                    },
                    PatternSliderInput: {
                        BetPerPattern: this.M6.bu(),
                        PatternsBet: this.o9.PatternSliderInput.PatternsBet
                    }
                }
            })
        },
        BY: function() {
            this.Vs(this.o9);
            this.p4.pT();
            this.qf.VM(this.o9.PopulationOutcome[this.o9.OutcomeDetail.Stage + ".Reels"].hs)
        },
        n2: function() {
            return this.M6.bu() * this.oS.bu()
        },
        RY: function() {
            this.p4 && this.p4.pT();
            this.k6.xd(this.o9.OutcomeDetail.Balance - this.o9.OutcomeDetail.Payout)
        },
        fk: function() {
            Zi.gY && Zi.gY.x3();
            this.mx && this.mx.tM(0);
            this.Y8 && this.Y8.tM(0);
            this.p4 && this.p4.pT()
        },
        KK: function() {
            this.qf && this.qf.Gd()
        },
        tR: function() {
            if (this.o9.OutcomeDetail.Stage.match(/^BaseGame/) && this.o9.OutcomeDetail.NextStage.match(/^FreeSpin/)) {
                this.O1.zm()
            } else {
                this.ud()
            }
        },
        Ve: function() {
            if (this.o9.OutcomeDetail.NextStage.match(/^FreeSpin/)) {
                this.ud()
            } else {
                this.jp(1)
            }
        },
        cX: function() {
            this.k6.xd(this.o9.OutcomeDetail.Balance - this.o9.OutcomeDetail.Payout);
            if (this.o9.OutcomeDetail.Stage == "BaseGame") {
                this.FC.Zt();
                if (this.o9.OutcomeDetail.NextStage == "FreeSpin") {
                    this.Yt.zm()
                } else {
                    this.cW.zm()
                }
            } else {
                this.jp(0);
                this.o9.OutcomeDetail.NextStage == "BaseGame" ? this.qX.zm() : this.vE.zm()
            }
        },
        TK: function() {
            if (this.Xw.className.indexOf("bB") != -1) {
                this.Xw.removeClass("bB");
                this.Cq.removeClass("gI");
                this.oU.GZ(1);
                this.oU.nG.nj("visibility", "");
                var P5 = this.fV();
                P5 && this.FC.nG.addClass("p5") && this.FC.nG.removeClass("tM");
                var Ls = this.CU.Q9();
                Ls.BetPerPattern[Ym] = Ym.mf(this.M6.bu());
                this.CU.Ph(Ls);
                P5 && this.lX();
                this.FC.nG.removeClass("p5");
                this.zn(1)
            } else {
                this.Bf.tM(0);
                this.GX.nj("visibility", "hidden");
                this.Xw.addClass("bB");
                this.Cq.addClass("gI");
                this.oU.GZ(0);
                this.M6.tM(1);
                clearInterval(hl);
                LE.pT();
                this.dz.nG.nj("opacity", "");
                this.Bf.nG.removeClass("VN");
                this.FC.wc();
                this.FC.nG.removeClass("p5");
                this.FC.nG.removeClass("tM")
            }
        },
        Xg: function() {
            this.GX.nj("visibility", "hidden")
        },
        vW: function(CG) {
            this.Hf.xd(this.n2());
            this.lD.xd(this.n2())
        },
        vW: function(CG) {
            this.Hf.xd(this.n2());
            this.lD.xd(this.n2())
        }
    })
}());
