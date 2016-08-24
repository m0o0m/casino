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
        if (newClass.HC) {
            return this
        }
        this.nB = $empty;
        var value = (this.initialize) ? this.initialize.apply(this, arguments) : this;
        delete this.nB;
        delete this.caller;
        return value
    }.extend(this);
    newClass.implement(params);
    newClass.constructor = Class;
    newClass.prototype.constructor = newClass;
    return newClass
}
Function.prototype.protect = function() {
    this.ek = true;
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
        F.HC = true;
        var proto = new F;
        delete F.HC;
        return proto
    },
    wrap: function(self, key, method) {
        if (method.M0) {
            method = method.M0
        }
        return function() {
            if (method.ek && this.nB == null) {
                throw new Error('The method "' + key + '" cannot be called.')
            }
            var caller = this.caller,
                current = this.nB;
            this.caller = current;
            this.nB = arguments.callee;
            var result = method.apply(this, arguments);
            this.nB = current;
            this.caller = caller;
            return result
        }.extend({
            XJ: self,
            M0: method,
            Y8: key
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
                if (value.jG) {
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
            var name = this.caller.Y8,
                previous = this.caller.XJ.parent.prototype[name];
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
            pY = -1,
            O4 = events.length,
            fn;
        if (delay) {
            while (++pY < O4) {
                if (fn = events[pY]) {
                    setTimeout(function() {
                        fn.apply(this, args)
                    }, delay)
                }
            }
        } else {
            while (++pY < O4) {
                if (fn = events[pY]) {
                    fn.$bound ? fn.$bound.apply(fn.$boundObject, (fn.$boundArgs || []).concat(Array.prototype.slice.call(args))) : fn.apply(this, args)
                }
            }
        }
        return this
    },
    f9: function(type, args) {
        var events, pY = 0,
            O4, fn;
        if (!(events = this.$events) || !(events = events[type])) {
            return this
        }
        args = args === undefined ? [] : args instanceof Array ? args : [args];
        for (O4 = events.length; pY < O4; ++pY) {
            if (fn = events[pY]) {
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
            var Kf = "Kf=" + method;
            data = (data) ? Kf + "&" + data : Kf;
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
    FH: function() {
        var tz = this,
            Wl = [].slice.call(arguments, 0);
        return function() {
            return tz.apply(this, Wl.concat([].slice.call(arguments, 0)))
        }
    },
    l0: function(pY) {
        return function() {
            return arguments[pY]
        }
    },
    Qm: function() {
        var vT = this,
            Wl = arguments;
        return function() {
            var pY = Wl.length,
                pD = [];
            while (pY-- > 0) {
                pD[pY] = arguments[Wl[pY]]
            }
            vT.apply(this, pD)
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
    VU: function(Kf) {
        var Wl = Array.slice(arguments, 1),
            pY = -1,
            O4 = this.length,
            nh = [];
        while (++pY < O4) {
            nh[pY] = this[pY][Kf].apply(this[pY], Wl)
        }
        return nh
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
    IU: function(l5) {
        return this.VU("IU", l5).join("")
    },
    NU: function() {
        var pY = 0,
            Ct = this.length,
            O4, q9 = [this[0]];
        while (++pY < Ct) {
            O4 = Math.floor(Math.random() * pY);
            q9[pY] = q9[O4];
            q9[O4] = this[pY]
        }
        return q9
    },
    uR: function() {
        var Jw = {},
            pY = this.length;
        while (--pY >= 0) {
            Jw[this[pY]] = pY
        }
        return Jw
    },
    AM: function(WN) {
        return this.map(function(iP) {
            return WN[iP]
        })
    },
    oL: function(I2) {
        var Ct = this.length - 1,
            q9 = [],
            pY;
        for (pY = 0; pY <= Ct; ++pY) {
            q9[pY] = this[pY * I2 % Ct || pY]
        }
        return q9
    },
    G1: function() {
        this.G1 = (function() {
            var EL = 0;
            return function() {
                var Ct = this.length,
                    pY;
                if (Ct > 1) {
                    while (EL == (pY = Math.floor(Math.random() * Ct))) {}
                }
                return this[EL = pY]
            }
        })();
        return this.G1()
    }
});
Array.FM = function(iP) {
    return iP instanceof Array ? iP : iP ? [iP] : []
};
Array.ZD = function(BR, FU, Rn, Tx) {
    var q9 = [],
        pY;
    Rn = Rn || Infinity;
    Tx = Tx || 1;
    for (pY = BR; pY <= FU; ++pY) {
        q9.push(pY % Rn * Tx)
    }
    return q9
};
String.implement({
    nx: function() {
        return this.charAt(Math.floor(Math.random() * this.length))
    },
    zE: function(HT) {
        return this.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
    },
    aG: function(q9) {
        var q0 = function(Jw) {
            return this.substitute(Jw)
        };
        return q9.map(q0, this)
    },
    V3: function(l5, iM) {
        iM = iM ? ' class="'.concat(iM, '"') : "";
        return "<".concat(l5, iM, ">", this, "</", l5, ">")
    },
    IU: function(l5, iM) {
        return this.zE().V3(l5, iM)
    }
});
Elements.c1 = function(WW) {
    return (new Element("div")).set("html", arguments).getChildren()
};
Element.implement({
    c6: (function() {
        var hq = {};
        return function(o_) {
            hq[o_] = hq[o_] || function() {
                window.event.which !== 0 && o_.test(String.fromCharCode(window.event.charCode)) && event.preventDefault()
            };
            return this.addEvent("keypress", hq[o_])
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
            XJ: binder.XJ,
            M0: binder.M0,
            Y8: binder.Y8
        }).apply(this, arguments)
    };
    return binder
};
var jU = {};
var Mm = function(hE) {
    this.u8 = window.getComputedStyle(hE, null)
};
Mm.prototype = {
    Yz: function(ZZ, YI) {
        YI = jU.jd(YI);
        try {
            return this.u8.getPropertyCSSValue ? this.u8.getPropertyCSSValue(YI).getFloatValue(ZZ) : this.u8.getPropertyValue(YI).toInt()
        } catch (VC) {}
    },
    TJ: function(YI) {
        YI = jU.jd(YI);
        return this.Yz(5, YI)
    },
    yz: function(YI) {
        YI = jU.jd(YI);
        return this.u8.getPropertyValue(YI)
    }
};
jU.Bd = (function(a, b, c) {
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
    }, A(""), j = l = null, e.Ts = f, e.Lf = d, g.className = g.className.replace(/\bno-javascript\b/, "") + " javascript " + u.join(" ");
    return e
})(this, this.document);
jU.wF = function() {
    document.body.adopt((new Element("div", {
        style: "position: absolute; top: -1000px"
    })).adopt(new Element("input", {
        id: "QL",
        type: "text"
    }), new Element("label", {
        "for": "QL",
        text: "QL"
    })))
};
(function() {
    var HX = {
            I5: /([0-9_]+) like Mac OS X/,
            OZ: /Android ([0-9.]+)/,
            LR: /Windows \w+ ([0-9.]+)/
        },
        sP = navigator.userAgent.match(/[(]([^;]+)(?:; U)?; ([^;)]+)(?:; [^)]+)?[)]/) || [],
        cR;
    this.p8 = sP[1];
    if (this.cR = sP[2]) {
        for (cR in HX) {
            if (sP = this.cR.match(HX[cR])) {
                this.cR = cR;
                this.H0 = sP[1] && parseFloat(sP[1].substr(0, 3).replace("_", "."));
                break
            }
        }
    }
    if (this.Bd.touch) {
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
    this.e3 = jU.cR == "I5";
    (function() {
        var wh = document.createElement("canvas"),
            dz = document.createElement("canvas"),
            OC, oc;
        dz.setAttribute("width", 1);
        dz.setAttribute("height", 1);
        oc = dz.getContext("2d");
        wh.setAttribute("width", 8);
        wh.setAttribute("height", 8);
        OC = wh.getContext("2d");
        if (dz.getContext === undefined) {
            return
        }
        this.jb = !!OC.putImageData;
        this.w6 = !!OC.getImageData;
        if (this.jb && this.w6) {
            this.Gw = 1;
            try {
                OC.putImageData(oc.getImageData(0, 0, 1, 1), -1, -1)
            } catch (j_) {
                this.Gw = 0
            }
        }
        if (this.w6) {
            oc.fillStyle = "#ffffff";
            oc.fillRect(0, 0, 1, 1);
            OC.clearRect(0, 0, 8, 8);
            OC.drawImage(dz, 4, 4);
            this.kP = OC.getImageData(4, 4, 1, 1).data[0] == 0
        }
    }).call(this);
    document.readyState === "complete" ? jU.wF() : window.addEvent("domready", jU.wF)
}).call(jU);
jU.kP && (function(zq, Ru, DN) {
    if (zq != 1) {
        CanvasRenderingContext2D.prototype.drawImage = function(Xf, aF, Yt, Ar, Z5, Yh, PE, tS, P_) {
            Ru.call(this, Xf, aF / zq, Yt / zq, Ar / zq, Z5 / zq, Yh / zq, PE / zq, tS / zq, P_ / zq)
        };
        CanvasRenderingContext2D.prototype.putImageData = DN && function(G8, Yh, PE) {
            DN.call(this, G8, Yh * zq, PE * zq)
        }
    }
})(window.devicePixelRatio || 1, CanvasRenderingContext2D.prototype.drawImage, CanvasRenderingContext2D.prototype.putImageData);
var hn = new Class({
    jy: function() {
        this.s3 = $merge.run([this.s3].extend(arguments));
        if (!this.addEvent) {
            return this
        }
        for (var OO in this.s3) {
            if ($type(this.s3[OO]) != "function" || !(/^on[A-Z]/).test(OO)) {
                continue
            }
            this.addEvent(OO, this.s3[OO]);
            delete this.s3[OO]
        }
        return this
    },
    dD: function(YI) {
        return this.s3.hasOwnProperty(YI) ? this.s3[YI] : void 0
    },
    MQ: function(YI, wT) {
        return this.s3[YI] = wT
    }
});
var yp = function(DG, WR, Np) {
    this.DG = DG;
    this.WR = WR;
    this.Np = Np || 1;
    this.UC = 0;
    this.qh = this.qh.bind(this)
};
yp.prototype = {
    qh: function() {
        if (--this.UC == 0) {
            this.DG.removeEvent(this.WR, this.qh);
            this.zD()
        }
    },
    m3: function(zc) {
        this.zD = zc;
        this.UC = this.Np, this.DG.addEvent(this.WR, this.qh)
    },
    qR: function() {
        this.DG.removeEvent(this.WR, this.qh)
    }
};
Events.implement({
    qU: function(WR, Np) {
        return new yp(this, WR, Np)
    },
    MW: function(O8, zD) {
        var tz = this,
            iK = function() {
                zD.apply(this, arguments);
                tz.removeEvent(O8, iK)
            };
        return this.addEvent(O8, iK)
    }
});
Element.Properties.iZ = {
    set: (function() {
        var uc = function() {
            gX = Math.min(1, this.clientWidth / this.scrollWidth);
            gX && this.I7({
                transform: Sl.iN.gX(gX, gX),
                transformOrigin: "0 0"
            })
        };
        return function(WW) {
            if (!this.uc) {
                this.uc = this.uc || uc.bind(this);
                window.addEvent("orientationchange", this.uc)
            }
            this.set("html", WW);
            uc.call(this);
            return this
        }
    })(),
    get: Element.Properties.html.get
};
var YL = new Class({
    Extends: Events,
    Implements: hn,
    s3: {
        qZ: "",
        zX: "",
        Mu: 0
    },
    KT: 0,
    toElement: function() {
        return this.HB
    },
    initialize: function(s3) {
        this.jy(s3);
        this.HB = (s3.HB || new Element("div", {
            id: this.s3.qZ,
            "class": this.s3.zX + " YL"
        })).adopt(this.Yi = this.s3.Yi || new Element("div", {
            "class": "pR"
        }));
        s3.Mu && YL.Mu(this)
    },
    rS: function(WW) {
        this.Yi.innerHTML = WW;
        return this
    },
    Z3: function(r4) {
        r4 = arguments.length ? !!r4 : !this.KT;
        if (r4 != this.KT) {
            this.fireEvent(r4 ? "a_" : "XL");
            this.HB.style.visibility = r4 ? "inherit" : "hidden";
            this.KT = r4;
            this.fireEvent(r4 ? "wK" : "pc")
        }
        return this
    },
    Bb: function() {
        return this.KT
    },
    eu: function() {
        return this.Z3(!this.KT)
    },
    oQ: function(hE) {
        hE = hE || new Element("div");
        this.HB.adopt(hE.adopt(this.HB.getChildren()));
        return this
    },
    H_: function(ya, xa) {
        return (new Element("div", {
            id: ya || "",
            "class": xa || ""
        })).adopt((new Element("div", {
            "class": "Y9"
        })).adopt(this), new Element("div", {
            "class": "H5"
        }))
    },
    yN: function() {
        this.HB.destroy()
    },
    Pz: function() {
        this.HB.dispose()
    },
    P5: function() {
        return Zz.TF(this.__proto__.constructor, [this.s3])
    }
});
YL.Mu = function(uE) {
    var rS = uE.rS;
    uE.rS = function(WW) {
        this.Yi.set("iZ", WW);
        return this
    }
};
var C6 = new Class({
    Extends: YL,
    Binds: ["Fr", "fp", "n5", "bO"],
    HB: null,
    Yi: null,
    Y0: 0,
    tE: 0,
    Xw: 1,
    s3: {
        pR: "",
        Xw: 0,
        lB: 200,
        fC: 1
    },
    initialize: function(s3) {
        this.jy(s3);
        this.HB = new Element("div", {
            id: this.s3.qZ,
            "class": this.s3.zX + " C6"
        }).adopt(this.Yi = new Element("div", {
            "class": "pR"
        }).adopt(this.Rp = new Element("div", {
            "class": "RN"
        })), new Element("div", {
            "class": "pH"
        }));
        this.rS(this.s3.pR);
        this.fL(this.s3.Xw);
        this.Yi.addEvents({
            touchstart: this.Fr,
            touchend: this.fp,
            Rf: this.bO
        });
        this.Uu = this.Yi;
        document.addEvents({
            touchend: this.n5,
            touchcancel: this.n5
        })
    },
    oQ: function(hE, fM) {
        hE.wraps(this.Rp, fM);
        return this
    },
    fL: function(fL) {
        if (this.Xw != !!fL) {
            this.Xw = !!fL;
            this.Xw ? this.HB.removeClass("rc") : this.HB.addClass("rc");
            this.n5();
            this.fireEvent("fL", this.Xw)
        }
        return this
    },
    rS: function(pR) {
        pR instanceof Element ? this.Rp.adopt(arguments) : this.kU(pR);
        return this
    },
    kU: function(RN) {
        this.pR != RN && this.Rp.set("text", this.pR = RN);
        return this
    },
    Fr: function(WR) {
        WR.preventDefault();
        if (this.Xw) {
            this.HB.addClass("Y0");
            this.Y0 = 1;
            ++this.tE;
            this.fireEvent("DF").Yi.fireEvent("Rf", [this.tE], this.s3.lB)
        }
    },
    fp: function() {
        this.Xw && this.Y0 && this.fireEvent("GL");
        this.n5()
    },
    n5: function() {
        this.Y0 = 0;
        this.HB.removeClass("Y0")
    },
    bO: function(tE) {
        tE == this.tE && this.s3.fC ? this.fp() : this.HB.removeClass("Y0")
    }
});
var L5 = (function() {
    var aH = {
            chipSet1: [0.05, 0.1, 0.5, 1, 5, 25, 100, 500, 1000, 5000, 10000],
            chipSet2: [0.25, 0.5, 1, 5, 25, 100, 500, 1000, 5000, 10000, 50000],
            chipSet3: [0.5, 1, 5, 10, 50, 100, 500, 1000, 5000, 10000, 50000, 100000],
            chipSet4: [5, 10, 50, 100, 500, 1000, 5000, 10000, 50000, 100000, 500000, 1000000]
        },
        yj, iO, vI, eH, PG, Zc, lk, bU, nl = function(Ro, sW) {
            var zw = L5.N6(Ro).split("."),
                O7 = (+zw[0]).toString(),
                uQ = zw[1] || "",
                AP;
            if (PG) {
                while (AP = O7.match(/^(\d+)(\d\d\d)(.*)$/)) {
                    O7 = AP[1].concat(PG, AP[2], AP[3])
                }
            }
            sW = sW && uQ == 0;
            return eH.concat(O7, sW ? "" : qH, sW ? "" : uQ, Zc)
        };
    return {
        toString: function() {
            return lk
        },
        cF: function(zw) {
            return zw / iO
        },
        N6: function(Ro) {
            return (Ro * iO).toFixed(vI)
        },
        kN: Iq = function(wP, sW) {
            return nl(L5.cF(wP), sW)
        },
        H8: K9 = function(Ro) {
            return nl(Ro, 1)
        },
        qK: TR = function(Ro) {
            return nl(Ro, 0)
        },
        Tp: function(Cx, SB) {
            var J7 = Cx.MAJOR_SYMBOL_PADDING_SPACE == "true" ? "\u00a0" : "";
            lk = Cx["@currencyCode"];
            vI = parseInt(Cx.DECIMAL_PRECISION);
            iO = SB;
            eH = Cx.MAJOR_SYMBOL_ALIGNMENT == "left" ? Cx.MAJOR_SYMBOL + J7 : "";
            Zc = Cx.MAJOR_SYMBOL_ALIGNMENT == "right" ? J7 + Cx.MAJOR_SYMBOL : "";
            PG = (Cx.USE_THOUSANDS_SEPARATOR == "yes" ? Cx.THOUSANDS_SEPARATOR : "").replace("_", "\u00a0");
            qH = (vI ? Cx.DECIMAL_SEPARATOR : "").replace("_", "\u00a0");
            aH = aH[Cx.CHIP_SET_CODE] || [];
            yj = aH[0] || 1;
            aH = aH.map(function(wT) {
                return Math.round(wT / yj)
            })
        },
        aN: function(Ro) {
            var pY = aH.length,
                sB = [];
            Ro = Math.round(Ro * iO / yj);
            while (--pY >= 0 && Ro > 0) {
                while (Ro - aH[pY] >= 0) {
                    sB.push(pY);
                    Ro -= aH[pY]
                }
            }
            return sB
        },
        Rd: function(Vj) {
            for (var iP = 0, pY = Vj.length; --pY >= 0; iP += aH[Vj[pY]] * yj) {}
            return L5.cF(iP)
        },
        BB: function(Vj) {
            return Vj.map(function(iP) {
                return aH[iP] * yj
            })
        },
        PT: function(DR, uX) {
            var lD = Math.round(iO / yj),
                sB = [],
                pY;
            uX = Math.round(uX * iO / yj) || Infinity;
            for (pY = 0; pY < aH.length; ++pY) {
                if (aH[pY] >= lD && aH[pY] <= uX && 0 < DR--) {
                    sB.push(pY)
                }
            }
            return sB
        },
        Q_: function(Te) {
            return L5.cF(aH[Te] * yj)
        }
    }
})();
var WC = (function() {
    var nA = function(pY) {
            pY = pY in this.s3.CE && pY || 0;
            if (this.m5 != pY) {
                this.m5 = pY;
                this.fL(this.Xw);
                this.PF.innerHTML = this.s3.Ck(this.s3.CE[pY]);
                this.fireEvent("tC", [this.s3.CE[pY], pY])
            }
        },
        z8 = function() {
            nA.call(this, this.m5 + 1)
        },
        Co = function() {
            nA.call(this, this.m5 - 1)
        };
    return new Class({
        Extends: YL,
        Xw: 0,
        s3: {
            Xw: 0,
            CE: [],
            Ck: TR
        },
        initialize: function(s3) {
            this.jy(s3);
            this.Xw = this.s3.Xw;
            this.HB = new Element("div", {
                id: this.s3.qZ,
                "class": "WC " + this.s3.zX
            });
            this.HB.adopt(this.ro = (new C6({
                zX: "WC zI"
            })).addEvent("DF", Co.bind(this)), this.kl = (new C6({
                zX: "WC JK"
            })).addEvent("DF", z8.bind(this)), this.PF = new Element("div", {
                "class": "wH"
            }));
            this.s3.ke !== void 0 && this.Rt(this.s3.ke)
        },
        fV: function(hE) {
            return hE.wraps(this.PF)
        },
        Rt: function(ke) {
            nA.call(this, this.s3.CE.indexOf(ke))
        },
        j5: function() {
            return this.s3.CE[this.m5]
        },
        fL: function(fL) {
            this.Xw = fL = !!fL;
            this.ro.fL(fL && this.m5 - 1 in this.s3.CE);
            this.kl.fL(fL && this.m5 + 1 in this.s3.CE)
        }
    })
})();
var Xz = (function() {
    var bB = function() {
            var C2 = this.Xc.io(),
                iX = C2.TJ("width"),
                Dy = C2.TJ("height"),
                OX = this.s3.KZ.OX || C2.yz("color"),
                lg = this.s3.KZ.lg,
                KO = this.s3.KZ.KY,
                g2 = this.s3.CE.length,
                ij, tZ = this.s3.KZ.Nt,
                Vs, lw = this.Xc,
                Ek = lw.getContext("2d"),
                D6 = +this.w2.j5(),
                iP;
            g2 = KO ? g2 : parseInt(this.s3.CE[g2 - 1], 10);
            ij = iX / (g2 + g2 * tZ - tZ);
            tZ *= ij;
            lw.width = iX;
            lw.height = Dy;
            for (Vs = 0; Vs < g2; Vs++) {
                iP = KO ? +this.s3.CE[Vs] : Vs + 1;
                Ek.fillStyle = iP <= D6 ? OX : lg;
                Ek.fillRect((ij + tZ) * Vs, 0, ij, Dy)
            }
        },
        tI = function(ke) {
            bB.call(this);
            this.fireEvent("tC", arguments)
        };
    return new Class({
        Extends: YL,
        ke: 0,
        rc: 0,
        s3: {
            CE: [],
            Ck: function(ke) {
                return ke
            },
            x0: null,
            KZ: {
                KY: 1,
                Nt: 0.4,
                OX: 0,
                lg: 0
            }
        },
        initialize: function(s3) {
            this.jy(s3);
            this.HB = new Element("div", {
                id: this.s3.qZ,
                "class": "Xz " + this.s3.zX
            });
            this.HB.adopt(this.w2 = new WC({
                zX: "Dq",
                Xw: 1,
                CE: this.s3.CE,
                ke: this.s3.ke,
                Ck: this.s3.Ck
            }), (new C6({
                zX: "xp",
                Xw: 1
            })).addEvent("GL", this.Z3.bind(this, 0)));
            this.w2.fV(new Element("div", {
                "class": "Qq"
            })).grab(new Element("div", {
                "class": "c7",
                html: this.s3.x0
            }), "top").adopt(this.Xc = new Element("canvas", {
                "class": "KZ"
            }));
            this.w2.addEvent("tC", tI.bind(this));
            this.s3.ke !== void 0 && this.Rt(this.s3.ke)
        },
        Z3: function(r4) {
            r4 && bB.call(this);
            return this.parent(r4)
        },
        Rt: function(ke) {
            this.w2.Rt(ke);
            return this
        },
        j5: function() {
            return this.w2.j5()
        },
    })
})();
var rP = new Class({
    Extends: YL,
    Binds: ["aE", "qd"],
    s3: {
        iM: ""
    },
    initialize: function(s3) {
        this.jy(s3);
        this.HB = (new Element("div", {
            id: this.s3.qZ,
            "class": "rP " + (this.s3.k9 || this.s3.iM)
        })).adopt((new Element("div")).adopt(this.Yi = new Element("span")))
    },
    TG: function() {
        return this.Yi
    },
    aE: function(RN) {
        this.Yi.set("text", RN);
        return this
    },
    bG: function(WW) {
        this.Yi.set("html", WW);
        return this
    },
    qd: function(RN) {
        this.Yi.set("html", "");
        return this
    },
    EN: function(YI, wT) {
        this.Yi.EN(YI, wT);
        return this
    },
    I7: function(BJ) {
        this.Yi.I7(BJ);
        return this
    }
});
var ZQ = (function() {
    var RQ = 0,
        Lz = 0,
        sp = {},
        m_ = 0,
        eL = 25,
        Dv = 0,
        iy = function() {
            var pY, kO, l3;
            for (pY in sp) {
                kO = sp[pY];
                kO.wf -= eL;
                if (kO.wf <= 0) {
                    isNaN(kO.wf = kO.r1) && v8(pY);
                    l3 = +new Date;
                    kO.zD(l3 - kO.U8);
                    kO.U8 = l3
                }
            }
        },
        TW = function(Ri, zD, kx) {
            kx = Math.max(kx, 0);
            sp[++m_] = {
                zD: zD,
                r1: Ri ? kx : NaN,
                wf: kx,
                U8: +new Date
            };
            ++Lz;
            hS(0);
            return m_
        },
        v8 = function(kh) {
            if (sp[kh]) {
                --Lz || hS(1);
                delete sp[kh]
            }
        },
        FZ = function(kh, zD) {
            if (sp[kh]) {
                sp[kh].zD = zD
            }
            return sp[kh] && kh
        },
        SD = function(L4) {
            eL = Math.ceil(1000 / L4)
        },
        W4 = function() {
            return eL
        },
        hS = function(s5) {
            var l3;
            if (Dv == !s5) {
                return
            }
            if (Dv) {
                l3 = +new Date;
                for (pY in sp) {
                    sp[pY].pA = l3 - sp[pY].U8
                }
                RQ = clearInterval(RQ)
            } else {
                l3 = +new Date;
                for (pY in sp) {
                    if (sp[pY].pA) {
                        sp[pY].U8 = l3 - sp[pY].pA
                    }
                }
                RQ = Lz && setInterval(iy, eL)
            }
            Dv = !!RQ && !s5
        };
    SD(40);
    window.addEventListener("pagehide", hS.FH(1));
    window.addEventListener("pageshow", hS.FH(0));
    return {
        W4: W4,
        SD: SD,
        s2: TW.FH(0),
        SK: TW.FH(1),
        FZ: FZ,
        vD: v8,
        jT: v8,
        hS: hS.FH(1),
        e4: hS.FH(0)
    }
})();
var yA = new Class({
    Implements: [Events, hn],
    s3: {},
    uG: 0,
    initialize: function(s3) {
        this.jy(s3)
    },
    nV: function() {
        return !!this.uG
    },
    tl: function(o6) {
        this.uG = 1;
        this.fireEvent("wd", this);
        this.o6 = o6;
        return this
    },
    QU: function() {
        if (this.uG) {
            this.uG = 0;
            this.fireEvent("HQ", this);
            delete this.o6
        }
        return this
    },
    bT: function() {
        if (this.uG) {
            this.uG = 0;
            this.fireEvent("Wp", this);
            this.o6 && this.o6();
            delete this.o6
        }
        return this
    },
    Q1: function() {
        if (this.uG) {
            this.uG = 0;
            this.fireEvent("Vz", this).o6 && this.o6();
            delete this.o6
        }
        return this
    }
});
var o3 = new Class({
    Extends: yA,
    initialize: function(AG, yG) {
        this.AG = AG;
        this.yG = yG
    },
    tl: function(o6) {
        this.parent(o6);
        return this.yG() ? this.AG.tl(this.Q1.bind(this)) : this.Q1()
    },
    QU: function() {
        if (this.uG) {
            this.AG.QU();
            this.parent()
        }
        return this
    },
    bT: function() {
        if (this.uG) {
            this.AG.bT();
            this.parent()
        }
        return this
    }
});
var JQ = new Class({
    Extends: yA,
    Binds: ["X7"],
    j1: 0,
    initialize: function(My) {
        this.My = My
    },
    Zf: function() {
        this.My.m3(this.X7);
        this.j1 = 1
    },
    tl: function(o6) {
        this.Zf();
        this.parent(o6);
        0 == this.j1 && this.Q1();
        return this
    },
    X7: function() {
        this.j1 = 0;
        this.uG && this.Q1()
    },
    QU: function() {
        this.My && this.My.qR();
        this.j1 = 0;
        return this.parent()
    },
    bT: function() {
        this.My && this.My.qR();
        this.j1 = 0;
        return this.parent()
    }
});
(function() {
    var fu = function(WR, Np) {
        return new JQ(new yp(this, WR, Np))
    };
    Events.implement("iu", fu);
    yA.implement("iu", fu);
    Element.implement("iu", fu)
})();
var FG = new Class({
    Extends: JQ,
    j1: 0,
    XZ: [],
    initialize: function() {
        this.XZ = Array.flatten(arguments)
    },
    Zf: function() {
        this.j1 = this.XZ.length;
        this.XZ.forEach(function(My) {
            My.m3(this.X7)
        }, this)
    },
    QU: function() {
        this.XZ.forEach(function(My) {
            My.qR()
        }, this);
        return this.parent()
    },
    bT: function() {
        this.XZ.forEach(function(My) {
            My.qR()
        }, this);
        return this.parent()
    }
});
var yZ = new Class({
    Extends: FG,
    X7: function() {
        if (--this.j1 == 0) {
            this.uG && this.Q1()
        }
    }
});
var gS = (function() {
    var eP = function() {
        this.dp = 0;
        this.fireEvent("UB", this);
        this.kC()
    };
    return new Class({
        Extends: yA,
        s3: {
            WP: 0
        },
        dp: 0,
        tl: function(o6) {
            this.parent(o6);
            if (Math.max(0, this.s3.WP) > 0) {
                this.dp = ZQ.s2(eP.bind(this), this.s3.WP)
            } else {
                eP.call(this)
            }
            return this
        },
        kC: function() {
            this.Q1()
        },
        QU: function() {
            this.dp = this.dp && ZQ.vD(this.dp);
            this.uG && this.parent();
            return this
        },
        bT: function() {
            this.dp = this.dp && ZQ.vD(this.dp);
            this.uG && this.parent();
            return this
        }
    })
})();
var Bp = new Class({
    Extends: yA,
    initialize: function() {
        this.ec = Array.flatten(arguments);
        this.parent()
    },
    tl: function(o6) {
        var mi = this,
            Ic = this.ec.length,
            tY = function() {
                --Ic || mi.Q1()
            };
        this.parent(o6);
        this.ec.VU("tl", tY);
        return this
    },
    QU: function() {
        this.ec.VU("QU");
        return this.parent()
    },
    bT: function() {
        this.ec.VU("bT");
        return this.parent()
    }
});
var DW = new Class({
    Extends: gS,
    Binds: ["hI", "Ln"],
    s3: {
        fS: 1,
        rN: 0,
        RI: 1,
        UN: 0,
        kx: 1,
        aR: 10000000000
    },
    cY: NaN,
    fS: 1,
    tl: function(o6) {
        this.fS = this.s3.fS;
        this.parent(o6)
    },
    kC: function() {
        this.cY = 0;
        (this.s3.UN > 0) ? this.hI(): this.Ln()
    },
    ib: function(u1) {
        this.fS = u1 || 1
    },
    hI: function() {
        var ZB = this.s3.rN + this.cY % this.s3.aR * this.s3.RI;
        if (!isNaN(ZB)) {
            this.dp = 0;
            this.fireEvent("cD", [this, this.cY, ZB]);
            this.L8(this.cY, ZB) && this.Ln()
        }
    },
    Ln: function() {
        if (this.cY == NaN) {
            return
        }
        if (++this.cY >= this.s3.UN) {
            if (0 == --this.fS || 0 == this.s3.UN) {
                this.cY = NaN;
                this.Q1();
                return
            }
            this.cY = 0;
            this.fireEvent("qm", [this, this.fS])
        }
        this.dp = ZQ.s2(this.hI, this.s3.kx)
    },
    QU: function() {
        this.dp = this.dp && ZQ.vD(this.dp);
        this.cY = NaN;
        this.fS = NaN;
        return this.parent()
    },
    bT: function() {
        this.dp = this.dp && ZQ.vD(this.dp);
        this.cY = NaN;
        this.fS = NaN;
        return this.parent()
    }
});
var C7 = new Class({
    Extends: DW,
    G7: [],
    initialize: function(G7, s3) {
        this.jy(s3);
        this.MC(G7)
    },
    MC: function(G7) {
        G7 = G7 || [];
        this.G7 = G7.filter(function(t8) {
            return t8 instanceof yA
        });
        this.s3.rN = 0;
        this.s3.RI = 1;
        this.s3.UN = this.G7.length;
        this.s3.aR = this.G7.length;
        return this
    },
    L8: function(cY, ZB) {
        this.G7[cY].tl(this.Ln);
        return 0
    },
    QU: function() {
        var t8 = this.G7[this.cY];
        if (t8) {
            delete t8.o6;
            t8.QU()
        }
        this.parent()
    },
    bT: function() {
        var t8 = this.G7[this.cY];
        if (t8) {
            delete t8.o6;
            t8.bT()
        }
        return this.parent()
    }
});
var tn = new Class({
    Extends: C7,
    initialize: function() {
        this.parent(Array.flatten(arguments))
    }
});
Zh.wG = {};
Zh.q1 = {};
xU.qo("image/*", (function(H3) {
    return function(VR) {
        var ZW = this,
            Xf = new Image();
        Xf.onload = function() {
            delete Xf.onload;
            delete Xf.onerror;
            Zh.wG[ZW.qZ] = Xf;
            ZW.q1 && Zz.ZP(ZW.q1, function(Nv, qZ) {
                Zh.q1[qZ] = Zz.TF(jJ, [Xf].concat(Nv.slice(0)))
            });
            ZW.Lv()
        };
        Xf.onerror = this.Jm;
        Xf.src = VR.concat(this.VF, "&resolution=", H3)
    }
})(navigator.userAgent.indexOf("iPad;") >= 0 ? 2 : window.devicePixelRatio || 1), ["image/*"]);
var jJ = function(Xf, Vs, fH, ij, t5, fg, HK, tj) {
    tj = tj || 1;
    Xf.q1 = Xf.q1 || [];
    Xf.q1.push(this);
    this.Xf = Xf;
    this.Vs = Vs / tj;
    this.fH = fH / tj;
    this.iX = ij / tj;
    this.Dy = t5 / tj;
    this.Vo = fg;
    this.Xl = HK;
    this.x8 = this.iX / fg;
    this.OY = this.Dy / HK;
    this.dq = tj;
    this.rm = window.devicePixelRatio || 1
};
jJ.prototype = {
    constructor: jJ,
    e7: function(q3, E2, uk, s1, cc, y9, q5, yV, K1) {
        var Ct = arguments.length,
            Vs = this.Vs,
            fH = this.fH,
            ij = this.iX,
            t5 = this.Dy,
            tj = this.dq;
        Ct == 3 ? q3.drawImage(this.Xf, Vs * tj, fH * tj, ij * tj, t5 * tj, E2 * this.rm, uk * this.rm, ij * this.rm, t5 * this.rm) : Ct == 5 ? q3.drawImage(this.Xf, Vs * tj, fH * tj, ij * tj, t5 * tj, E2 * this.rm, uk * this.rm, s1 * this.rm, cc * this.rm) : q3.drawImage(this.Xf, Vs * tj + E2 * tj, fH * tj + uk * tj, s1 * tj, cc * tj, y9 * this.rm, q5 * this.rm, yV * this.rm, K1 * this.rm)
    },
    X1: function(q3, HI, Yc, Yh, PE, tS, P_) {
        this.e7(q3, (HI * this.x8) || 0, (Yc * this.OY) || 0, this.x8, this.OY, Yh || 0, PE || 0, tS || this.x8, P_ || this.OY)
    },
    LV: function() {
        return this.Xf.LV()
    },
    tm: function() {
        return this.Xf.tm(this.dq || 1)
    },
    Rz: function(HI, Yc) {
        return [-this.Vs - (HI || 0) * this.x8, -this.fH - (Yc || 0) * this.OY, ""].join("px ")
    },
    fd: function(t8) {
        return [-this.Vs - (t8 || 0) % this.Vo * this.x8, "px"].join("")
    },
    BL: function(t8) {
        return [-this.fH - (t8 || 0) % this.Xl * this.OY, "px"].join("")
    },
    VG: function(HI, Yc) {
        return [this.Xf.LV(), "repeat", this.Rz(HI, Yc)].join(" ")
    }
};
Image.prototype.LV = function() {
    return ["url(", this.src, ")"].join("")
};
Image.prototype.tm = function(dq) {
    return [this.width / dq, this.height / dq, ""].join("px ")
};
jJ.Am = function(ij, t5) {
    var lw = document.createElement("canvas");
    lw.width = ij * window.devicePixelRatio || 1;
    lw.height = t5 * window.devicePixelRatio || 1
};
Element.implement({
    wA: function(jC, HI, Yc) {
        return this.qe(jC).PL(jC, HI, Yc)
    },
    qe: function(jC) {
        return this.I7({
            width: jC.x8 + "px",
            height: jC.OY + "px"
        })
    },
    PL: function(jC, HI, Yc) {
        return this.I7({
            backgroundImage: jC.LV(),
            backgroundSize: jC.tm(),
            backgroundPosition: jC.Rz(HI, Yc)
        })
    }
});
Fx.implement({
    stopTimer: function() {
        if (!this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.timer = ZQ.jT(this.timer);
        return true
    },
    startTimer: function() {
        if (this.timer) {
            return false
        }
        this.time = $time() - this.time;
        this.Rq = this.Rq || this.step.bind(this);
        this.timer = ZQ.SK(this.Rq, Math.round(1000 / this.options.fps));
        return true
    }
}, 1);
var Ex = new Class({
    Extends: gS,
    s3: {
        CQ: {}
    },
    initialize: function(QZ, s3) {
        this.parent(s3);
        this.QZ = QZ.addEvent("complete", this.Q1.bind(this))
    },
    kC: function() {
        this.QZ.start(this.s3.CQ)
    },
    QU: function() {
        this.QZ.cancel();
        return this.parent()
    },
    bT: function() {
        return this.parent()
    }
});
var yQ = new Class({
    Extends: yA,
    s3: {
        JE: !!jU.Bd.csstransitions,
        Mp: true,
        WP: 1,
        unit: "",
        transition: "linear",
        Wk: 1
    },
    YR: 0,
    jy: function(s3) {
        this.parent(s3);
        this.s3.JE && this.yL(this.s3);
        return this
    },
    initialize: function(hE, s3) {
        this.hE = hE;
        this.jy(s3);
        if (this.s3.JE) {
            this.parent()
        } else {
            return new Ex(new Fx.Morph(hE, s3), s3)
        }
    },
    tl: function(o6) {
        this.parent(o6);
        return this.VI()
    }
});
jU.Bd.csstransitions && yQ.implement({
    Binds: ["PV", "nG"],
    yL: function(s3) {
        var L2 = s3.duration + "ms",
            q2 = s3.WP + "ms",
            OI = [],
            KG = [],
            Xt = [],
            Ih;
        this.xZ = {
            transitionProperty: "",
            transitionDuration: "",
            transitionDelay: "",
            transitionTimingFunction: ""
        };
        this.K0 = {};
        this.xf = 0;
        for (Ih in s3.CQ) {
            wT = s3.CQ[Ih];
            Ih = Ih.camelCase();
            if ($type(wT) == "array") {
                this.xZ[Ih] = wT[0].toString() + this.s3.unit;
                this.K0[Ih] = wT[1].toString() + this.s3.unit
            } else {
                this.K0[Ih] = wT.toString() + this.s3.unit
            }
        }
        this.s3.Mp && yQ.b_(this.K0) && this.Mp();
        for (Ih in this.K0) {
            ++this.xf;
            OI.push(Ih.hyphenate());
            KG.push(L2);
            Xt.push(q2)
        }
        this.K0.transitionProperty = OI.join(" ,");
        this.K0.transitionDuration = KG.join(" ,");
        this.K0.transitionDelay = Xt.join(" ,");
        this.K0.transitionTimingFunction = yQ.l1[s3.transition] || s3.transition;
        this.YM = s3.WP + s3.duration;
        return this
    },
    Mp: function() {
        var K0 = this.K0,
            xZ = this.xZ,
            C2 = this.hE.io(),
            Q8 = K0.transform = K0.transform || C2.UD(),
            cE = xZ.transform = xZ.transform || C2.UD();
        BJ = [{
            Ih: "top",
            zn: 1,
            m5: 5
        }, {
            Ih: "bottom",
            zn: -1,
            m5: 5
        }, {
            Ih: "left",
            zn: 1,
            m5: 4
        }, {
            Ih: "right",
            zn: -1,
            m5: 4
        }];
        BJ.forEach(function(Ih) {
            var zn = Ih.zn,
                m5 = Ih.m5,
                Ih = Ih.Ih,
                tl, O3, aM;
            if (K0[Ih]) {
                O3 = zn * parseFloat(K0[Ih]) || 0;
                aM = zn * parseFloat(xZ[Ih]) || 0;
                tl = -zn * C2.TJ(Ih) || 0;
                cE[m5] = tl + aM;
                Q8[m5] = tl + O3;
                delete K0[Ih];
                delete xZ[Ih]
            }
        })
    },
    PV: function(WR) {
        --this.YR == 0 && this.Q1()
    },
    nG: function() {
        this.YR = 0;
        this.uG && this.Q1()
    },
    VI: function() {
        if (this.xf) {
            this.hE.I7(this.xZ);
            document.body.offsetWidth;
            this.hE.addEvent("transitionend", this.PV);
            this.YR = this.xf;
            this.hE.I7(this.K0);
            this.UQ = this.s3.Wk && setTimeout(this.nG, this.YM + 250)
        } else {
            this.Q1()
        }
    },
    Q1: function() {
        this.hE.removeEvent("transitionend", this.PV);
        this.hE.I7({
            transitionProperty: "",
            transitionDuration: "",
            transitionDelay: "",
            transitionTimingFunction: ""
        });
        document.body.offsetWidth;
        this.parent()
    }
});
yQ.b_ = function(Ih) {
    var ep = (Ih.top !== undefined),
        Z1 = (Ih.bottom !== undefined),
        Ct = (Ih.left !== undefined),
        nh = (Ih.right !== undefined);
    if (!yQ.uV) {
        return false
    }
    return (ep || Z1 || Ct || nh) && !(ep && Z1) && !(Ct && nh)
};
yQ.uV = jU.p8 != "iPad" && jU.Bd.csstransforms && jU.e3;
yQ.Bi = ["top", "left", "bottom", "right"];
yQ.l1 = {
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
var fB = new Class({
    Extends: DW,
    hE: null,
    initialize: function(hE, s3) {
        this.jy(s3);
        this.sH(hE)
    },
    sH: function(hE) {
        this.hE = hE;
        return this
    },
    bT: function() {
        if (this.uG) {
            this.cY = this.s3.UN - 1;
            this.L8(this.cY, (this.s3.rN + this.s3.RI * this.cY) % this.s3.aR);
            this.parent()
        }
        return this
    }
});
var hU = new Class({
    Extends: fB,
    s3: {
        L6: []
    },
    initialize: function(hE, s3) {
        s3.UN = s3.UN || s3.L6.length;
        this.parent(hE, s3)
    },
    Gn: "",
    L8: function(cY, ZB) {
        var Bh = this.s3.L6[cY];
        this.hE.addClass(Bh).removeClass(this.Gn);
        this.Gn = Bh;
        return 1
    },
    QU: function() {
        this.hE.removeClass(this.Gn);
        return this.parent()
    }
});
var KC = new Class({
    Extends: fB,
    s3: {
        cA: "backgroundPosition",
        ZZ: "px 0"
    },
    initialize: function(hE, s3) {
        this.parent(hE, s3);
        this.s3.cA = this.s3.cA.camelCase()
    },
    tl: function(o6) {
        this.y8 = this.hE ? this.hE.o4(this.s3.cA) : "";
        this.parent(o6)
    },
    L8: function(cY, ZB) {
        var wT = ZB.toString().concat(this.s3.ZZ);
        this.hE.EN(this.s3.cA, wT);
        return 1
    },
    QU: function() {
        this.hE.EN(this.s3.cA, this.y8);
        return this.parent()
    }
});
var QP = new Class({
    Extends: KC,
    s3: {
        cA: "visibility",
        T4: ["visible", "hidden"],
        ZZ: ""
    },
    jy: function(s3) {
        var PD = s3.T4 ? s3.T4.length : this.s3.T4.length;
        s3.UN = s3.UN || PD;
        s3.aR = s3.aR || PD;
        return this.parent(s3)
    },
    L8: function(cY, ZB) {
        this.hE.EN(this.s3.cA, this.s3.T4[cY] + this.s3.ZZ);
        return 1
    }
});
var VZ = new Class({
    Extends: QP,
    initialize: function(hE, jC, s3) {
        var Op, x7;
        s3 = s3 || {};
        Op = (s3.Op || "x").toUpperCase() === "X";
        x7 = Op ? jC.Vo : jC.Xl;
        s3.cA = Op ? "backgroundPositionX" : "backgroundPositionY";
        s3.UN = s3.UN || x7;
        s3.T4 = (s3.T4 || Array.ZD(1, s3.UN)).map(Op ? jC.fd : jC.BL, jC);
        this.parent(hE, s3)
    }
});
jJ.prototype.yA = function(hE, s3) {
    return new VZ(hE, this, s3)
};
Element.implement({
    Ph: function(jC, s3) {
        return new VZ(this, jC, s3)
    }
});
var kn = function(q9, Z1, Iw, f6, Vs, fH) {
    q9 instanceof Array ? this.push.apply(this, q9.slice(0, 6)) : this.push.call(this, q9 || 1, Z1 || 0, Iw || 0, f6 || 1, Vs || 0, fH || 0)
};
kn.prototype = [];
kn.prototype.$family = {
    name: "kn"
};
$extend(kn.prototype, {
    N5: function(hj) {
        var q9 = this[0],
            Z1 = this[1],
            Iw = this[2],
            f6 = this[3];
        this[0] = q9 * hj[0] + Iw * hj[1];
        this[1] = Z1 * hj[0] + f6 * hj[1];
        this[2] = q9 * hj[2] + Iw * hj[3];
        this[3] = Z1 * hj[2] + f6 * hj[3];
        this[4] = q9 * hj[4] + Iw * hj[5] + this[4];
        this[5] = Z1 * hj[4] + f6 * hj[5] + this[5];
        return this
    }
});
var R3 = {
    mH: function(dJ, JD) {
        this[4] += dJ;
        this[5] += JD;
        return this
    },
    Hw: function(dJ) {
        this[4] += dJ;
        return this
    },
    Sa: function(JD) {
        this[5] += JD;
        return this
    },
    qa: function(J8) {
        var gN = Math.sin(J8),
            Ej = Math.cos(J8),
            q9 = this[0],
            Z1 = this[1],
            Iw = this[2],
            f6 = this[3];
        this[0] = q9 * Ej + Iw * gN;
        this[1] = Z1 * Ej + f6 * gN;
        this[2] = Iw * Ej - q9 * gN;
        this[3] = f6 * Ej - Z1 * gN;
        return this
    },
    gX: function(uM, FC) {
        this[0] *= uM;
        this[1] *= uM;
        this[2] *= FC;
        this[3] *= FC;
        return this
    },
    yh: function() {
        this[0] = -this[0];
        this[1] = -this[1];
        return this
    },
    eI: function() {
        this[2] = -this[2];
        this[3] = -this[3];
        return this
    },
    toString: jU.Bd.csstransforms3d && jU.e3 ? function() {
        return "matrix3d(".concat([this[0], this[1], 0, 0, this[2], this[3], 0, 0, 0, 0, 1, 0, this[4], this[5], 0, 1].join(","), ")")
    } : Browser.Engine.gecko ? function() {
        return "matrix(".concat([this[0], this[1], this[2], this[3], this[4] + "px", this[5] + "px"].join(","), ")")
    } : function() {
        return "matrix(".concat(this.join(","), ")")
    }
};
var SS = function() {
    kn.apply(this, arguments)
};
var hC = function() {};
hC.prototype = kn.prototype;
SS.prototype = new hC();
SS.prototype.constructor = SS;
$extend(SS.prototype, R3);
Sl = {
    iN: function(a, b, c, d, e, f) {
        return new SS(a, b, c, d, e, f)
    }
};
Sl.iN.mr = new SS();
(function() {
    for (var Kf in R3) {
        Sl.iN[Kf] = (function(Kf) {
            return function() {
                return Kf.apply(new SS(1, 0, 0, 1, 0, 0), arguments)
            }
        })(R3[Kf])
    }
})();
Mm.prototype.UD = function() {
    var iN = this.yz("transform");
    iN = iN && iN.replace(/^[^(]+/, "").match(/[-0-9.]+/g);
    iN = iN && iN.map(parseFloat);
    return iN && iN.length == 16 ? new SS(iN[0], iN[1], iN[4], iN[5], iN[12], iN[13]) : new SS(iN)
};
var Rw = (function() {
    var kR = function() {
            this.Lt = new DW({
                rN: 1
            });
            this.Lt.L8 = function(cY, ZB) {
                nr.call(this, (this.s3.mJ) ? (this.HH + ZB - 1) : (this.HH + (this.DI - this.HH) * Math.log(ZB) / Math.LN10));
                return 1
            }.bind(this);
            this.Lt.addEvents({
                Wp: function() {
                    nr.call(this, this.DI);
                    this.HH = this.DI
                }.bind(this)
            });
            return this.Lt
        },
        nr = function(HH) {
            HH = this.s3.db(HH);
            if (HH !== this.Dp) {
                return !!this.Yi.set("text", this.Dp = HH)
            }
        };
    return new Class({
        Extends: YL,
        Implements: [Events, hn],
        s3: {
            db: TR,
            EX: L5.N6,
            mJ: false,
            B5: 25
        },
        initialize: function(s3) {
            this.jy(s3);
            this.HB = this.Yi = this.s3.HB.addClass("Rw " + this.s3.zX);
            (this.s3.HH !== undefined) && this.Rt(this.s3.HH)
        },
        Tj: function() {
            this.HH = 0;
            this.Yi.set("text", this.Dp = "");
            this.fireEvent("tC", [this.HH, this.Dp])
        },
        Rt: function(HH) {
            this.Lt && this.Lt.bT();
            if (nr.call(this, HH)) {
                this.HH = this.DI = HH;
                this.fireEvent("tC", [this.s3.EX(HH), this.Dp])
            }
            return this
        },
        j5: function() {
            return this.HH || 0
        },
        kd: function(DI, aU) {
            var UN;
            (this.Lt || kR.call(this)).bT();
            this.DI = DI;
            if (this.s3.mJ) {
                UN = Math.floor(Math.abs(L5.N6(this.DI - this.HH) / L5.N6(aU)) * this.s3.B5);
                this.Lt.jy({
                    RI: aU / this.s3.B5,
                    UN: UN,
                    kx: this.s3.kx
                })
            } else {
                UN = Math.floor(this.s3.B5 + this.s3.B5 * Math.log(Math.abs(L5.N6(DI - this.HH) / L5.N6(aU))) / Math.LN10);
                this.Lt.jy({
                    UN: UN,
                    RI: 9 / UN
                })
            }
        },
        yA: function() {
            var mi = this;
            return new o3(this.Lt || kR.call(this), function() {
                return mi.DI != mi.HH
            })
        }
    })
})();
var cS = new Class({
    Extends: YL,
    initialize: function(s3) {
        this.jy(s3);
        this.HB = new Element("div", {
            id: this.s3.qZ,
            "class": "cS " + this.s3.zX
        }), this.w_ = {}
    },
    Sd: function(hE, fM) {
        var hE = hE instanceof Element ? hE : hE.toElement();
        if (fM !== undefined) {
            fM = this.HB.getChildren()[fM]
        }
        fM instanceof Element ? hE.inject(fM, "before") : this.HB.adopt(hE);
        return this
    },
    oa: function(WR, bz, fM) {
        (this.w_[WR] = this.w_[WR] || []).push(bz);
        this.Sd(bz, fM);
        this.fireEvent("fK", [WR, bz]);
        return this
    },
    U4: function(uU) {
        Zz.ZP(uU, this.oa.Qm(1, 0).bind(this))
    },
    Ep: function(Vd, WR) {
        var wu, wo, pY;
        for (wu in this.w_) {
            if (WR && wu !== WR) {
                continue
            }
            wo = this.w_[wu];
            wo && wo.forEach(function(bz) {
                bz.fL(Vd)
            })
        }
        return this
    },
    ND: function(Vd) {
        Zz.ZP(this.w_, this.Ep.FH(Vd).Qm(1), this);
        return this
    },
    g4: function(WR) {
        this.w_[WR].forEach(function(bz) {
            bz.removeEvents();
            bz.Pz()
        });
        delete this.w_[WR];
        return this
    },
    Sm: function() {
        Zz.ZP(this.w_, this.g4.Qm(1).bind(this));
        return this
    }
});
var Lu = new Class({
    Extends: YL,
    Binds: ["SJ", "X6"],
    initialize: function(s3) {
        this.jy(s3);
        this.HB = (new Element("div", {
            id: this.s3.qZ,
            "class": this.s3.zX + " Lu"
        })).adopt(this.Yi = new Element("div", {
            "class": "Tn"
        }), this.w_ = new cS({
            zX: "Hv"
        }).addEvent("fK", this.SJ.bind(this)));
        this.addEvents({
            e2: this.X6,
            pc: OE.LH
        })
    },
    aE: function(UT) {
        this.Yi.innerHTML = "";
        this.Yi.adopt(arguments).children.length || this.Yi.set("html", UT);
        return this
    },
    SJ: function(WR, bz) {
        bz.addEvent("GL", this.fireEvent.bind(this, WR))
    },
    X6: function() {
        this.Z3(0)
    },
    oa: function(WR, bz, fM) {
        this.w_.oa(WR, bz, fM);
        return this
    },
    U4: function(ws) {
        Zz.ZP(ws, this.oa.Qm(1, 0), this);
        return this
    },
    XN: function() {
        return this.oa("e2", new C6({
            zX: "Fj",
            Xw: 1
        }))
    },
    Ep: function(Vd, WR) {
        this.w_.Ep(Vd, WR);
        return this
    },
    ND: function(Vd) {
        this.w_.ND(Vd);
        return this
    },
    Yl: function(r4) {
        this.w_.Z3(r4);
        return this
    },
    g4: function(WR) {
        this.w_.g4(WR);
        return this
    },
    Sm: function() {
        this.w_.Sm();
        return this
    }
});
Lu.YV = function(hy) {
    var Kn = (new Element("div", {
        "class": "FY",
        style: "visibility:hidden"
    })).adopt(new Element("div", {
        "class": "eh"
    }).adopt(hy));
    hy.HB = Kn;
    return hy
};
var TV = (function() {
    var Ye = ((navigator.userAgent.indexOf("Mozilla/5.0") > -1 && navigator.userAgent.indexOf("Android ") > -1 && navigator.userAgent.indexOf("AppleWebKit") > -1) && !(navigator.userAgent.indexOf("Chrome") > -1));
    return new Class({
        Implements: [hn],
        zj: null,
        rH: null,
        OP: null,
        s3: {
            ew: [],
            X0: null,
            Al: 2,
            Vm: 3,
            c5: "#000000",
            pm: "miter",
            VP: "butt",
            ZI: "",
            Fn: true
        },
        toElement: function() {
            return this.rH
        },
        initialize: function(zj, s3) {
            this.jy(s3);
            this.rH = new Element("div", {
                id: "Z9"
            });
            this.zj = this.ux(zj);
            var X0 = this.s3.X0,
                B_ = this.s3.Al,
                Ui = X0.cd,
                MB = X0.R9,
                Fi = X0.ly,
                J4 = X0.e1,
                fc = X0.fc,
                vn = this.s3.wD.length / X0.fc,
                qS = (MB + Fi) * fc - Fi,
                Tl = (Ui + J4) * vn - J4,
                Hp = (X0.iX - qS) / 2,
                DV = (X0.Dy - Tl) / 2,
                dq = 1,
                rm = 1;
            Zz.ZP(Zh.q1, function(OU) {
                if (OU.dq && OU.dq > dq) {
                    dq = OU.dq
                }
            });
            dq = this.s3.dq || dq;
            this.MS = this.s3.wD.map(function(iP, pY) {
                return [Hp + (pY % fc) * (MB + Fi) + B_ / 2, DV + Math.floor(pY / fc) * (Ui + J4) + B_ / 2, MB - B_, Ui - B_]
            }, this);
            this.OP = new Element("canvas", {
                width: this.s3.X0.iX * dq,
                height: this.s3.X0.Dy * dq,
                styles: {
                    width: this.s3.X0.iX,
                    height: this.s3.X0.Dy
                }
            });
            this.OP.getContext("2d").scale(dq / rm, dq / rm);
            this.eC = this.s3.ew.filter(function(rk) {
                return rk < zj.length
            }).map(function(rk) {
                var HB = this.OP.clone(),
                    Ek = HB.getContext("2d"),
                    O4 = 0;
                Ek.scale(dq / rm, dq / rm);
                while (O4++ < rk) {
                    this.kV(Ek, this.zj[O4])
                }
                return HB
            }, this);
            this.bS(this.s3.ar);
            this.OP.I7({
                position: "relative"
            });
            this.s3.kW.forEach(function(HB, pY) {
                var UY = this[pY];
                HB && HB.I7({
                    position: "absolute",
                    top: (UY.Gx[0][1] - HB.firstElementChild.height / 2) + "px",
                    transform: Sl.iN.gX(UY.l6 ? 1 : -1, 1)
                }) && HB.EN(UY.l6 ? "left" : "right", (UY.sl === void(0) ? -2 : UY.sl) + "px")
            }, this.zj);
            this.rH.adopt(this.OP, this.eC, this.s3.kW)
        },
        RE: function(jf) {
            var Ek = this.OP.getContext("2d");
            this.ZH();
            jf.forEach(function(X3) {
                this.kV(Ek, this.zj[X3.s6], X3.s6 ? null : X3.ue)
            }, this);
            return this
        },
        ZH: function() {
            var Ek = this.OP.getContext("2d");
            Ek.save();
            Ek.setTransform(1, 0, 0, 1, 0, 0);
            Ek.clearRect(0, 0, Ek.canvas.width, Ek.canvas.height);
            if (Ye) {
                this.OP.EN("opacity", 0.99);
                setTimeout(function() {
                    this.OP.EN("opacity", 1)
                }.bind(this), 0)
            }
            Ek.restore()
        },
        zO: function(X3) {
            var pY = X3.s6,
                Ek = this.OP.getContext("2d");
            this.ZH();
            this.kV(Ek, this.zj[pY], X3.ue, X3.Dx);
            return this
        },
        sv: function(Z3) {
            this.OP.style.visibility = (Z3 ? "visible" : "");
            return this
        },
        Ud: function(r4) {
            if (this.ar) {
                this.ar.style.visibility = r4 ? "visible" : ""
            }
        },
        bS: function(gh, r4) {
            this.Ud(0);
            this.ar = this.eC[this.s3.ew.indexOf(gh)];
            this.s3.kW.forEach(function(F4, jw) {
                F4 && (jw <= gh ? F4.removeClass("rc") : F4.addClass("rc"))
            });
            this.Ud(r4);
            return this
        },
        kV: function(Ek, XV, ue, Dx) {
            var s3 = this.s3,
                O4 = 0,
                Gx = XV.Gx;
            Ek.lineCap = s3.VP;
            Ek.lineJoin = s3.pm;
            if (Gx && Gx.length && s3.Fn) {
                Ek.beginPath();
                Ek.moveTo(Gx[O4][0], Gx[O4][1]);
                while (++O4 < Gx.length) {
                    Ek.lineTo(Gx[O4][0], Gx[O4][1])
                }
                Ek.strokeStyle = s3.c5;
                Ek.lineWidth = s3.Vm;
                Ek.stroke();
                Ek.strokeStyle = XV.Wu;
                Ek.lineWidth = s3.Al;
                Ek.stroke()
            }
            ue && ue.forEach(function(RO) {
                var Sb = this[RO];
                Ek.clearRect(Sb[0], Sb[1], Sb[2], Sb[3]);
                Ek.beginPath();
                Ek.moveTo(Sb[0], Sb[1]);
                Ek.lineTo(Sb[0] + Sb[2], Sb[1]);
                Ek.lineTo(Sb[0] + Sb[2], Sb[1] + Sb[3]);
                Ek.lineTo(Sb[0], Sb[1] + Sb[3]);
                Ek.closePath();
                Ek.globalCompositeOperation = "destination-over";
                Ek.strokeStyle = s3.c5;
                Ek.lineWidth = s3.Vm;
                Ek.stroke();
                Ek.beginPath();
                Ek.moveTo(Sb[0], Sb[1]);
                Ek.lineTo(Sb[0] + Sb[2], Sb[1]);
                Ek.lineTo(Sb[0] + Sb[2], Sb[1] + Sb[3]);
                Ek.lineTo(Sb[0], Sb[1] + Sb[3]);
                Ek.closePath();
                Ek.globalCompositeOperation = "source-over";
                Ek.strokeStyle = XV.Wu;
                Ek.lineWidth = s3.Al;
                Ek.stroke()
            }, this.MS);
            Dx && Dx.forEach(function(RO) {
                var Sb = this[RO];
                Ek.beginPath();
                Ek.moveTo(Sb[0], Sb[1] + Sb[3] / 2);
                Ek.lineTo(Sb[0] + Sb[2], Sb[1] + Sb[3] / 2);
                Ek.stroke()
            }, this.MS)
        },
        ux: function(zj) {
            var k_ = function(Gx) {
                    var J8, xS, Ej, Eo, tZ = 0;
                    while (++tZ < this.length / 2) {
                        J8 = this[tZ - 1];
                        xS = this[tZ];
                        Ej = this[tZ + 1];
                        if (Math.abs(J8[1] - xS[1]) < AE) {
                            Eo = Ej[1] - xS[1];
                            if (Eo) {
                                xS[0] += (Ej[0] - xS[0]) * (J8[1] - xS[1]) / Eo
                            }
                            xS[1] = J8[1]
                        }
                    }
                    return this
                },
                X0 = this.s3.X0,
                NL = this.s3.X0.NL || 0,
                MB = X0.R9,
                Ui = X0.cd,
                fc = X0.fc,
                vn = this.s3.wD.length / X0.fc,
                AE = Ui / 2,
                K7 = MB / 2,
                Fi = X0.ly,
                J4 = X0.e1,
                qS = (MB + Fi) * fc - Fi,
                Tl = (Ui + J4) * vn - J4,
                Hp = (X0.iX - qS) / 2,
                DV = (X0.Dy - Tl) / 2,
                rR, QS;
            zj.forEach(function(rR) {
                var Gx = rR.Gx,
                    EL, ds, lL;
                if (Gx) {
                    var sl = (rR.sl + 2 || 0);
                    Gx[0] = [rR.l6 ? sl : X0.iX - sl, Gx[0] + DV];
                    Gx[1] = [rR.l6 ? X0.iX - Hp - NL : Hp + NL, Gx[1] + DV];
                    EL = Gx.pop();
                    rR.TM.forEach(function(zm) {
                        ds = Hp + K7 + zm % fc * (MB + Fi);
                        lL = DV + AE + Math.floor(zm / fc) * (Ui + J4) + rR.q4;
                        Gx.push([ds, lL])
                    });
                    if (NL !== 0) {
                        var Ot = NL / (rR.l6 ? EL[0] - ds : ds - EL[0]);
                        EL[1] = EL[1] - ((EL[1] - lL) * Ot)
                    }
                    Gx.push(EL);
                    k_.call(Gx).reverse();
                    k_.call(Gx).reverse()
                }
            });
            return zj
        },
        AA: function(zx, Hu, xG, fi, Xa) {
            var X0 = this.s3.X0,
                fc = X0.fc,
                vn = X0.U7 || X0.vn,
                dq = 1,
                rm = 1,
                MM = Hu * vn + 1,
                uz = zx * fc + 1,
                Vs, fH, EM = 1,
                UH = 0.5,
                Ut, Ek;
            Zz.ZP(Zh.q1, function(OU) {
                if (OU.dq && OU.dq > dq) {
                    dq = OU.dq
                }
            });
            dq = this.s3.dq || dq;
            Ut = new Element("canvas", {
                width: uz * dq,
                height: MM * dq,
                styles: {
                    width: uz,
                    height: MM
                }
            });
            Ek = Ut.getContext("2d");
            Ek.scale(dq / rm, dq / rm);
            Ek.fillStyle = "#fff";
            Ek.fillRect(1, 1, uz - 1, MM - 1);
            Ek.globalCompositeOperation = "source-over";
            Ek.fillStyle = (Xa) ? Xa : (this.s3.ZI === "") ? xG.Wu : this.s3.ZI;
            xG.TM.forEach(function(fM) {
                fH = zx * Math.floor(fM / fc);
                Vs = Hu * (fM % fc), Ek.fillRect(Vs + 1, fH + 1, zx - 1, Hu - 1)
            });
            Ek.globalCompositeOperation = "source-over";
            Ek.lineWidth = EM;
            Ek.strokeStyle = "#000";
            Ek.strokeRect(UH, UH, uz - EM, MM - EM);
            Ek.strokeStyle = "#444";
            Ek.beginPath();
            for (Vs = zx; Vs < uz - 1; Vs += zx) {
                Ek.moveTo(Vs + UH, EM);
                Ek.lineTo(Vs + UH, MM - EM)
            }
            Ek.stroke();
            Ek.beginPath();
            for (fH = Hu; fH < MM - 1; fH += Hu) {
                Ek.moveTo(EM, fH + UH);
                Ek.lineTo(uz - EM, fH + UH)
            }
            Ek.stroke();
            return (new Element("div", {
                "class": "Cc"
            })).adopt(new Element("div", {
                "class": "MG",
                html: fi
            }), Ut)
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
var HU = (function() {
    var bh = Object.freeze(function() {
        var bh = {};
        bh.dK = {};
        (function() {
            window.AudioContext = window.AudioContext || window.webkitAudioContext;
            if (navigator.userAgent.indexOf("Chrome/11.") > -1 && navigator.userAgent.indexOf("Linux x86_64") > -1) {
                bh.dK.rI = 0
            } else {
                if ((navigator.userAgent.indexOf("4.1.1") > -1 || navigator.userAgent.indexOf("4.1.2") > -1) && (navigator.userAgent.indexOf("GT-I9300") > -1 || navigator.userAgent.indexOf("GT-I9100") > -1)) {
                    bh.dK.rI = 0
                } else {
                    window.AudioContext ? bh.dK.rI = 1 : bh.dK.rI = 0
                }
            }
        })();
        Object.freeze(bh.dK);
        return Object.freeze(bh)
    })();
    nC = function(WD) {
        this.B7 += WD / 1000;
        if (this.B7 >= this.uh) {
            --this.tp;
            this.B7 = this.JA
        }
        if (this.tp === 0) {
            this.eU = ZQ.jT(this.eU);
            this.B7 = this.JA = this.uh = void 0;
            this.Oo && Oo.call(this);
            pS(this, "pC", this.JA)
        }
    }, Oo = function() {
        Zz.BZ(this, this.Oo);
        this.I1(this.aj);
        delete this.Oo
    }, pS = function(mi, WR, Wl) {
        setTimeout(mi.fireEvent.bind.apply(mi.fireEvent, arguments), 0)
    };
    return new Class({
        Implements: Events,
        uK: function() {
            return 0
        },
        Dz: function(zF, ib, Ys) {
            Ys = Ys || 0;
            var zF = this.FL[zF];
            this.Vp = zF;
            return this.v6.apply(this, zF.concat(ib, Ys))
        },
        bc: function(zF) {
            var zF = this.FL[zF];
            return this.VM.apply(this, zF)
        },
        Gj: function(zF) {
            var zF = this.FL[zF];
            return this.Aa.apply(this, zF)
        },
        GW: function(WR, Np) {
            return new JQ(new yp(this, WR, Np))
        },
        qV: function(zF, ib, Ys) {
            return this.GW("cg").addEvent("wd", this.bc.bind(this, zF, ib, Ys))
        },
        pK: function(zF, ib, Ys) {
            return this.GW("YX").addEvent("wd", this.Dz.bind(this, zF, ib, Ys))
        },
        NF: function(zF, ib, Ys) {
            return this.GW("pC").addEvent("wd", this.Dz.bind(this, zF, ib, Ys))
        },
        initialize: function(Ht, Cx) {
            var p2 = function() {
                    this.hS()
                },
                kg = function() {
                    this.D2()
                },
                BH = function() {
                    this.IG()
                },
                Ta = function() {
                    if (document.hidden) {
                        this.hS()
                    } else {
                        this.D2()
                    }
                };
            window.addEventListener("pagehide", p2.bind(this), false);
            window.addEventListener("focusout", p2.bind(this), false);
            window.addEventListener("pageshow", kg.bind(this), false);
            window.addEventListener("focusin", kg.bind(this), false);
            window.addEventListener("focus", kg.bind(this), false);
            window.addEventListener("beforeunload", BH.bind(this), false);
            window.addEventListener("unload", BH.bind(this), false);
            document.addEventListener("webkitvisibilitychange", Ta.bind(this), false);
            document.addEventListener("visibilitychange", Ta.bind(this), false);
            this.nS = bh.dK.rI && Cx.AK > 0 ? HU.k1(Ht) : HU.q7(Ht);
            this.FL = Cx.Uc || []
        },
        F_: function() {
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
        Vc: function(B6) {
            this.Oo = B6;
            this.B7 || Oo.call(this);
            var apitsModule = APITS(B6.F_())
        },
        v6: function(aM, PD, ib) {
            this.eU = this.eU && ZQ.jT(this.eU);
            this.JA = this.B7 = aM;
            this.uh = aM + PD;
            this.tp = ib || 1;
            this.eU = ZQ.SK(nC.bind(this), 100);
            pS(this, "YX", this.JA);
            return this
        },
        VM: function(aM) {
            pS(this, "cg", aM);
            return this
        },
        hS: function() {
            this.eU = this.eU && ZQ.jT(this.eU);
            pS(this, "cl");
            return this
        },
        IG: function() {
            this.eU = this.eU && ZQ.jT(this.eU);
            this.B7 = this.JA = this.uh = void 0;
            pS(this, "A9");
            return this
        },
        DD: function() {
            this.IG()
        },
        Aa: function(aM) {
            var ts = this.JA;
            return aM ? ts === aM : ts
        },
        D2: function(aM) {
            this.eU = this.B7 && ZQ.SK(nC.bind(this), 100);
            return this
        },
        I1: function(Aj) {
            this.aj = !!Aj
        },
        bX: function() {
            return this.aj
        }
    })
})();
xU.qo("audio/*", function(VR) {
    Zh.rQ = new HU("audio", {
        AK: this.AK,
        Uc: this.Uc
    });
    if (Zh.rQ.nS) {
        var vV = Lu.YV(new Lu({
                qZ: "vV",
                zX: "iT hK"
            })),
            bx = function(vV) {
                vV.Z3(0);
                vV.HB.destroy();
                Zh.rQ.addEvents({
                    load: this.Lv,
                    error: this.Jm,
                    abort: this.Jm
                }).nS("audio", this.CO.split(",").map(function(Ht) {
                    var a = document.createElement("a");
                    a.href = VR + this.VF + "&Accept=" + Ht;
                    a.protocol = "http";
                    return {
                        type: Ht,
                        src: a.href
                    }
                }, this), this.u2 && Zz.Ev(this.u2, function(pY, Iw) {
                    var a = document.createElement("a");
                    a.href = VR + this.VF + "&Accept=" + y7(this.CO);
                    a.protocol = window.location.protocol;
                    a.pathname = a.pathname + "/" + this.u2[Iw];
                    var N3 = a.href;
                    return N3
                }, this))
            },
            rK = function(vV) {
                vV.HB.destroy();
                Zh.rQ.Vc(Zh.rQ);
                this.Lv()
            },
            y7 = function(CO) {
                var uT = new Audio();
                var yR = CO.split(",");
                var uL = {};
                var i = yR.length;
                while (--i >= 0) {
                    uL[uT.canPlayType(yR[i])] = yR[i]
                }
                return uL.probably || uL.maybe || void 0
            };
        vV.U4({
            IO: new C6({
                pR: iJ("audioLoader.yes"),
                Xw: 1
            }),
            e2: new C6({
                pR: iJ("audioLoader.no"),
                Xw: 1
            })
        }).addEvents({
            IO: bx.bind(this, vV),
            e2: rK.bind(this, vV)
        }).aE(iJ("audioLoader.confirm"));
        document.body.adopt(vV);
        vV.Z3(1)
    } else {
        this.Lv()
    }
});
HU.q7 = (function() {
    var WA = function(q9, Z1) {
            return (q9 - Z1) * (q9 - Z1) < 0.00001
        },
        eQ = function() {
            if (this.HM) {
                this.Y5 = this.HM;
                this.HM = void 0;
                this.fireEvent("cg", this.Y5);
                this.Y5 === this.vM && a9.call(this)
            }
        },
        D3 = function() {
            if (this.JA && this.HB.currentTime >= this.uh) {
                if (--this.tp) {
                    this.v6(this.JA, this.uh - this.JA, this.tp)
                } else {
                    this.G5 = this.JA;
                    this.HB.pause()
                }
                this.JA = void 0
            } else {
                if (!this.uh) {
                    this.HB.currentTime = this.HM || 0;
                    this.HB.pause()
                }
            }
        },
        OB = function() {
            if (this.G5) {
                this.uh = this.HM = this.Y5 = this.vM = this.tp = this.JA = void 0;
                this.fireEvent("pC", this.G5);
                this.G5 = void 0
            } else {
                if (this.JA) {
                    this.fireEvent("cl")
                }
            }
        },
        a9 = function() {
            if (this.Y5 === this.vM) {
                this.JA = this.vM;
                this.HM = this.Y5 = this.vM = void 0;
                this.fireEvent("YX", this.JA);
                this.HB.play()
            }
        },
        c_ = {
            uK: function() {
                return 0
            },
            F_: function() {
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
            v6: function(aM, PD, ib, Ys) {
                Ys = Ys || 0;
                if (Ys == 0) {
                    this.tp = ib || 1;
                    this.vM = aM;
                    this.uh = aM + PD;
                    this.Y5 === aM && a9.call(this, this.uh);
                    this.HM === aM || this.VM(aM)
                } else {}
                return this
            },
            VM: function(aM) {
                if (this.HM !== aM) {
                    this.HB.currentTime = this.HM = aM
                }
                return this
            },
            hS: function() {
                this.HB.pause();
                return this
            },
            IG: function(qZ) {
                if (!qZ) {
                    this.HB.pause();
                    this.uh = this.HM = this.Y5 = this.vM = this.tp = this.JA = void 0
                } else {}
                return this
            },
            DD: function() {
                this.IG()
            },
            D2: function() {
                this.Aa() && this.HB.play();
                return this
            },
            Aa: function(aM) {
                var ts = this.vM || this.JA;
                return aM ? ts === aM : ts
            },
            I1: function(Aj) {
                this.HB.muted = !!Aj
            },
            bX: function() {
                return this.HB.muted
            }
        },
        Ob = function(Ht, fP) {
            var HB, yH, AL, Vh = function() {
                    this.fireEvent("load")
                }.bind(this),
                vx = function() {
                    this.fireEvent("load")
                }.bind(this),
                XM = function() {
                    UM.call(this)
                }.bind(this),
                Zy = function() {
                    yH && clearTimeout(yH);
                    yH = setTimeout(this.fireEvent.bind(this, "load"), 20000)
                }.bind(this),
                UM = function() {
                    yH && clearTimeout(yH);
                    this.HB.removeEventListener("progress", Zy, true);
                    this.HB.removeEventListener("error", Vh, true);
                    this.HB.removeEventListener("abort", vx, true);
                    this.HB.removeEventListener("canplaythrough", XM, true);
                    Zy = Vh = vx = UM = void 0;
                    this.Vc(c_);
                    this.fireEvent("load")
                };
            HB = new Element(Ht);
            HB.addEventListener("seeked", eQ.bind(this));
            HB.addEventListener("ended", OB.bind(this));
            HB.addEventListener("pause", OB.bind(this));
            HB.addEventListener("timeupdate", D3.bind(this));
            HB.addEventListener("canplaythrough", XM, true);
            HB.addEventListener("error", Vh, true);
            HB.addEventListener("abort", vx, true);
            HB.addEventListener("progress", Zy, true);
            this.HB = HB;
            this.HB.preload = "none";
            this.HB.adopt(fP.map(function(j0) {
                return new Element("source", j0)
            }));
            if (jU.cR === "I5" && jU.H0 >= 8) {
                this.HB.play()
            } else {
                this.HB.load()
            }
            this.HB.preload = "auto";
            yH = setTimeout(this.fireEvent.bind(this, "load"), 20000);
            return this
        };
    return function(Ht) {
        var Sp = !(jU.cR == "OZ" && jU.H0 < 2.3) && !(jU.cR == "I5" && jU.H0 < 4) && document.createElement(Ht).play;
        return Sp && Ob
    }
})();
HU.k1 = (function() {
    var WA = function(q9, Z1) {
            return (q9 - Z1) * (q9 - Z1) < 0.00001
        },
        kz = [],
        j0, Wx = [],
        kv = [],
        Fv = null,
        OB = function() {
            if (this.G5) {
                this.uh = this.HM = this.Y5 = this.vM = this.tp = this.JA = void 0;
                this.fireEvent("pC", this.G5);
                this.G5 = void 0
            } else {
                if (this.JA) {
                    this.fireEvent("cl")
                }
            }
        },
        a9 = function() {
            if (this.Y5 === this.vM) {
                this.JA = this.vM;
                this.HM = this.Y5 = this.vM = void 0;
                this.fireEvent("YX", this.JA);
                this.HB.play()
            }
        },
        Ai = function(jA) {
            for (var i in kv) {
                if (kv[i].Ys == jA && kv[i].Ys != undefined) {
                    c_.IG(kv[i].Y8)
                }
            }
        },
        gI = function() {
            for (var i in kv) {
                if (kv[i].Y8 != undefined) {
                    c_.IG(kv[i].Y8)
                }
            }
        },
        c_ = {
            uK: function() {
                return 1
            },
            F_: function() {
                var soundPlayer = {
                    play: function(id, loop, channel) {
                        c_.v6(id, loop, channel)
                    },
                    stop: function(id) {
                        c_.IG(id)
                    },
                    createTrack: function() {
                        return {
                            schedule: function schedule() {}
                        }
                    },
                    decode: function(id, buffer, successCallback, failureCallback) {
                        Fv.decodeAudioData(buffer, function(mc) {
                            kz[id] = mc;
                            successCallback()
                        }, function() {
                            failureCallback(new Error('Failed to decode buffer for sound "' + id + '"'))
                        })
                    },
                    format: "audio/mpeg"
                };
                return soundPlayer
            },
            Dz: function(zF, ib, Ys) {
                Ys = Ys || 0;
                this.Vp = zF;
                return this.v6.call(this, zF, ib, Ys)
            },
            v6: function(aM, ib, Ys) {
                j0 = Fv.createBufferSource();
                j0.buffer = kz[aM];
                j0.loop = ib > 1 ? true : false;
                var TB = {
                    j0: j0,
                    Y8: aM,
                    Ys: Ys
                };
                if (Ys == 0) {
                    Ai(Ys)
                } else {
                    this.IG(aM)
                }
                kv[aM] = TB;
                j0.connect(Wx.master);
                (typeof j0.start === "undefined") ? j0.noteGrainOn(0, 0, j0.buffer.duration): j0.start(0);
                return this
            },
            VM: function(aM) {
                return this
            },
            hS: function() {
                Wx.master.gain.value = 0;
                return this
            },
            IG: function(Mi) {
                if (kv[Mi]) {
                    if (navigator.userAgent.indexOf("like Mac OS X") >= 0 && navigator.userAgent.indexOf("6_") >= 0) {
                        if (kv[Mi].j0.playbackState == j0.PLAYING_STATE || kv[Mi].j0.playbackState == j0.SCHEDULED_STATE) {
                            kv[Mi].j0.noteOff(0)
                        }
                    } else {
                        if (kv[Mi].j0.playbackState == j0.PLAYING_STATE || kv[Mi].j0.playbackState == j0.SCHEDULED_STATE) {
                            kv[Mi].j0.stop(0)
                        }
                    }
                    delete kv[Mi]
                }
                this.uh = this.HM = this.Y5 = this.vM = this.tp = this.JA = void 0;
                return this
            },
            DD: function() {
                gI()
            },
            D2: function() {
                Wx.master.gain.value = 1;
                this.Aa();
                return this
            },
            Aa: function(aM) {
                if (kv[aM] && kv[aM].j0.playbackState == j0.PLAYING_STATE) {
                    return true
                }
                return false
            },
            Gj: function(zF) {
                return this.Aa.call(this, zF)
            },
            I1: function(Aj) {},
            bX: function() {
                return false
            }
        },
        Ob = function(Ht, fP, Uc) {
            var HB, yH, AL, Vh = function(e) {
                    this.fireEvent("error")
                }.bind(this),
                f5 = function() {
                    if (Object.keys(kz).length >= Object.keys(Uc).length) {
                        yH = setTimeout(this.fireEvent.bind(this, "load"), 1)
                    }
                }.bind(this),
                vx = function(e) {
                    this.fireEvent("abort")
                }.bind(this),
                XM = function() {
                    UM.call(this)
                }.bind(this),
                Zy = function() {}.bind(this),
                UM = function() {
                    yH && clearTimeout(yH);
                    this.HB.removeEventListener("progress", Zy, true);
                    this.HB.removeEventListener("error", Vh, true);
                    this.HB.removeEventListener("abort", vx, true);
                    this.HB.removeEventListener("canplaythrough", XM, true);
                    Zy = Vh = vx = UM = void 0;
                    this.Vc(c_);
                    this.fireEvent("load")
                };
            for (var N3 in Uc) {
                if (Uc.hasOwnProperty(N3)) {
                    Eh(N3, Uc, f5, vx)
                }
            }
            Fv = new window.AudioContext();
            j0 = Fv.createBufferSource();
            j0.connect(Fv.destination);
            Wx = {
                destination: Fv.destination,
                master: (typeof Fv.createGain === "undefined") ? Fv.createGainNode() : Fv.createGain(),
                music: (typeof Fv.createGain === "undefined") ? Fv.createGainNode() : Fv.createGain(),
                fx: (typeof Fv.createGain === "undefined") ? Fv.createGainNode() : Fv.createGain()
            };
            Wx.master.connect(Wx.destination);
            Wx.music.connect(Wx.master);
            Wx.fx.connect(Wx.master);
            (typeof j0.start === "undefined") ? j0.noteGrainOn(0, 0, 0): j0.start(0);
            this.Vc(c_);
            return this
        },
        Eh = function(N3, Uc, Hg, PN) {
            var Q4 = new XMLHttpRequest();
            Q4.onload = function(e) {
                Fv.decodeAudioData(e.target.response, function(mc) {
                    kz[N3] = mc;
                    Hg.apply()
                }, function() {
                    PN.apply()
                })
            }.bind(this);
            Q4.onerror = function(e) {
                PN.apply(e)
            };
            Q4.open("GET", Uc[N3], true);
            Q4.responseType = "arraybuffer";
            Q4.send()
        };
    return function(Ht) {
        var Sp = !(jU.cR == "OZ" && jU.H0 < 2.3) && !(jU.cR == "I5" && jU.H0 < 4) && document.createElement(Ht).play;
        return Sp && Ob
    }
})();
(function() {
    var Cd = {},
        ge = {};
    PrefixFree.properties.forEach(function(Ih) {
        Cd[StyleFix.camelCase(Ih)] = StyleFix.camelCase(PrefixFree.prefixProperty(Ih));
        ge[Ih] = PrefixFree.prefixProperty(Ih)
    });
    Element.implement({
        EN: function(cA, wT) {
            this.style[Cd[cA] || cA] = PrefixFree.value(wT.toString(), cA);
            return this
        },
        o4: function(cA, wT) {
            return this.style[Cd[cA] || cA]
        },
        I7: function(BJ) {
            var cA;
            for (cA in BJ) {
                this.EN(cA, BJ[cA])
            }
            return this
        },
        io: function() {
            return new Mm(this)
        }
    });
    jU.jd = function(cA) {
        return Cd[cA] || cA
    };
    jU.i_ = function(Ih) {
        return ge[Ih] || Ih
    }
})();
var ub = new Class({
    Extends: Lu,
    initialize: function() {
        this.parent.apply(this, arguments);
        this.xo = (new Element("div", {
            "class": "qE"
        })).inject(this)
    },
    X6: function() {
        this.parent();
        this.Sm(0)
    },
    PB: function(UT, ac) {
        UT.Buttons.forEach(function(bz, m5) {
            this.oa("choice" + m5, new C6({
                zX: UT.Buttons.length > 1 ? "" : "Fj",
                pR: UT.Buttons.length > 1 ? bz.Text : "",
                Xw: 1
            })).MW("choice" + m5, function() {
                this.X6();
                ac(UT.Buttons[m5].Cmd)
            })
        }.bind(this));
        this.xo.set("text", UT.Reference ? iJ("mproxy.Error.RGSid") + UT.Reference : "");
        return this.aE(new Element("p", {
            text: UT.Message
        }), UT.SupportInfo && (new Element("p", {
            text: UT.SupportInfo.Message
        })).adopt(new Element("address", {
            text: [UT.SupportInfo.PhoneNumber, UT.SupportInfo.Email].join("\n")
        })))
    }
});
var xn = new Class({
    Extends: Request,
    options: {
        ov: 10000
    },
    initialize: function(lx) {
        this.parent(lx);
        delete this.headers["X-Requested-With"]
    },
    send: function() {
        var Jy = navigator.onLine;
        this.options.ov && setTimeout(this.cancel.bind(this), this.options.ov);
        Jy === false ? this.fireEvent("offline") : this.parent()
    }
});
var XK = (function() {
    var IM = function() {
            if (0 >= --this.uS) {
                this.fireEvent("Q1");
                this.fireEvent("Jk", this.sZ.status)
            } else {
                this.sZ.send()
            }
        },
        Fh = function() {
            this.fireEvent("pq")
        },
        f5 = function(gC) {
            var DK, dR, Ci, gC;
            try {
                gC = JSON.parse(gC)
            } catch (e) {
                return this.fireEvent("aQ")
            }
            DK = gC.ReturnStatus;
            if (DK.Code != 1000000) {
                this.fireEvent("dn", DK)
            } else {
                if (gC.Authentication && gC.Authentication.Status == "Pending") {
                    ++this.uS;
                    setTimeout(this.send.bind(this), this.tR *= 1.5)
                } else {
                    this.fireEvent("Z_", gC)
                }
            }
        },
        yx = function() {
            this.fireEvent("Q1")
        };
    return new Class({
        Implements: Events,
        initialize: function(Wl) {
            this.uS = Wl.uS || 0;
            this.tR = Wl.tR || 1000;
            this.sZ = new xn({
                url: Wl.N3,
                data: Wl.mc,
                method: Wl.Kf || "post",
                async: Wl.T2 ? 0 : 1,
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json; charset=utf8"
                },
                urlEncoded: 0,
                ov: Wl.ov
            });
            this.sZ.addEvents({
                failure: Wl.IM || IM.bind(this),
                cancel: Wl.IM || IM.bind(this),
                success: Wl.f5 || f5.bind(this),
                complete: Wl.yx || yx.bind(this),
                offline: Wl.Fh || Fh.bind(this)
            })
        },
        send: function() {
            this.sZ.send()
        },
        complete: function() {
            this.parent.apply(this, arguments)
        }
    })
})();
var HO = (function() {
    return new Class({
        Implements: [hn, Events],
        s3: {
            Cx: {
                requestTimeout: 10000,
                requestRetries: 0
            },
            SZ: function(Ed) {},
            eT: function(Ed) {},
            wX: function(cf) {},
            yr: function(gC) {
                debugConsol.assert(0)
            },
            Tt: function(dR) {},
            g3: function() {}
        },
        hs: 0,
        initialize: function(s3) {
            this.jy(s3)
        },
        Ed: function(Wl) {
            Wl.N3 = this.s3.Cx.proxyUrl.concat(Wl.eN);
            Wl.ov = this.s3.Cx.requestTimeout || 0;
            Wl.uS = this.s3.Cx.requestRetries || 0;
            if (Wl.lY) {
                Wl.IM = Wl.ey = Wl.f5 = Wl.yx = Wl.Fh = function() {}
            }
            var sZ = (new XK(Wl)).addEvents({
                pq: Wl.SZ || this.s3.SZ,
                Jk: Wl.eT || this.s3.eT,
                dn: Wl.wX || this.s3.wX,
                Z_: Wl.yr || this.s3.yr,
                aQ: Wl.Tt || this.s3.Tt,
                Qg: Wl.g3 || this.s3.g3
            });
            return sZ
        }
    })
})();
HO.Cs = {
    wP: function(HT) {
        return parseFloat(HT) || 0
    },
    mx: function(HT) {
        return parseInt(HT, 10) || 0
    },
    Kt: function(HT) {
        return HT.split(",")
    },
    Zs: function(HT) {
        return new Date(HT.substr(0, 4), HT.substr(4, 2), HT.substr(6, 2), HT.substr(8, 2), HT.substr(10, 2))
    },
    gH: function(sU, Y8) {
        var nh = {},
            iP, pY = sU.length;
        Y8 = Y8 || "@name";
        while (--pY >= 0) {
            iP = sU[pY];
            nh[iP[Y8]] = iP;
            delete iP[Y8]
        }
        return nh
    }
};
var e5 = function(H6, Cx) {
    Cx.enableHighAccuracy = Cx.enableHighAccuracy == "true";
    Cx.maximumAge = Cx.maximumAge || 300000;
    Cx.timeout = Cx.timeout || 600000;
    "geolocation" in navigator ? navigator.geolocation.getCurrentPosition(H6, H6, Cx) : H6({
        message: "Device does not support navigator.geolocation",
        code: -1
    })
};
var C8 = new Class({
    initialize: function() {}
});
var Ue = (function() {
    var vZ, Cx, hP, bj, Pk, CK, u5, aC = (function() {
            var Jf, fk = {
                    closeGame: function() {
                        CK && CK.Ed({
                            eN: "/close.action",
                            mc: JSON.stringify(bj.params),
                            IM: FN,
                            ey: FN,
                            f5: FN,
                            Fh: FN
                        }).send()
                    },
                    requestMobileNumber: function() {
                        wZ()
                    },
                    getGeoCoordinates: function() {
                        e5(mP, Cx.geoLocation)
                    },
                    insufficientFundsNotification: function() {
                        V6.fG()
                    }
                },
                kX = {
                    closeGame: function() {
                        JI = 1;
                        if (window.opener) {
                            window.close()
                        } else {
                            window.location = Cx.console.lobbyURL
                        }
                    },
                    reloadGame: function() {
                        JI = 1;
                        if (bj.params.mac) {
                            window.location = Cx.console.lobbyURL
                        } else {
                            Zh.SG()
                        }
                    },
                    switchToCashPlay: function() {
                        Zh.SG({
                            playMode: "real"
                        })
                    },
                    gameInProgressReload: function() {
                        JI = 1;
                        Zh.SG(Jf.Param)
                    },
                    "": function() {
                        V6.WG()
                    }
                };

            function FN() {
                V6.FN(Jf)
            }
            return {
                QI: function(oU) {
                    fk[""] = oU && function() {
                        fk[""] = void 0;
                        oU()
                    }
                },
                Qt: function(rX) {
                    var ta = rX["@name"],
                        Nv = {};
                    Jf = rX;
                    rX.Param && Array.FM(rX.Param).forEach(function(tZ) {
                        Nv[tZ["@name"]] = tZ["#text"]
                    });
                    rX.Param = Nv;
                    (fk[ta] || FN)()
                },
                GQ: function(ta, Nv) {
                    var oU = kX[ta];
                    oU ? oU(Nv) : console.warn("No default handler for " + ta)
                }
            }
        })(),
        gd = function(UT) {
            u5.WK || u5.CF();
            UT.Reference = "";
            UT.Buttons = Array.FM(UT.Buttons.Button);
            V6.Ho(UT)
        },
        Z6 = function(UT) {
            Zh.rQ && Zh.rQ.IG();
            u5.WK || u5.r2();
            UT.Buttons = Array.FM(UT.Buttons.Button);
            V6.Ho(UT)
        },
        wa, Pc, za, vl, ti = function(gC) {
            Pc = gC.GameLogicResponse;
            if (!za) {
                za = Date.now()
            }
            wa = Pc.OutcomeDetail.TransactionId;
            var dC = 0;
            if (hP && hP.transactiondelay && hP.gameType && hP.gameType.toUpperCase() == "S") {
                dC = hP.transactiondelay ? hP.transactiondelay * 1000 : 0;
                dC = Math.max(0, dC - (Date.now() - vl))
            }
            setTimeout(function() {
                Pc.OutcomeDetail.Balance = L5.cF(Pc.OutcomeDetail.Balance);
                Pc.Messages = Pc.Messages || [];
                if (Pc.Messages.Message) {
                    Pc.Messages = Array.FM(Pc.Messages.Message)
                }
                vw()
            }, dC)
        },
        vw = function() {
            var UT = Pc.Messages && Pc.Messages.shift();
            u5.Pc = Pc;
            if (UT) {
                aC.QI(vw);
                gd(UT)
            } else {
                u5.MU()
            }
        },
        SZ = function() {
            return Z6({
                Message: iJ("mproxy.Error.networkOffLine"),
                Buttons: {
                    Button: {
                        Text: iJ("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": ""
                        }
                    }
                }
            })
        },
        eT = function(DK) {
            return Z6({
                Message: iJ(DK ? "mproxy.Error.networkError" : "mproxy.Error.connectionLost"),
                Reference: DK ? "MGC-002-" + DK : "MGC-001",
                Buttons: {
                    Button: {
                        Text: iJ("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": DK ? "closeGame" : "reloadGame"
                        }
                    }
                }
            })
        },
        Tt = function(Ed) {
            return Z6({
                Message: iJ("mproxy.Error.payloadError"),
                Reference: "MGC-003",
                Buttons: {
                    Button: {
                        Text: iJ("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": "closeGame"
                        }
                    }
                }
            })
        },
        wX = function(PN) {
            var VC = PN.AdditionalInfo || {};
            VC.Action = VC.Action || "";
            VC.Buttons = VC.Buttons ? VC.Buttons.split(",").map(function(RN) {
                return iJ("mproxy.Buttons." + RN)
            }) : [iJ("mproxy.Buttons.OK")];
            return Z6({
                Message: PN.Message,
                Reference: PN.Code,
                Buttons: {
                    Button: VC.Action.split(",").map(function(ta, pY) {
                        return {
                            Text: VC.Buttons[pY] || ta,
                            Cmd: {
                                "@name": ta || "closeGame"
                            }
                        }
                    })
                }
            })
        },
        jL = function(PN) {
            return gd({
                Message: iJ("mproxy.CancelSubmitMobileNumber.message"),
                Buttons: {
                    Button: {
                        Text: iJ("mproxy.Buttons.OK"),
                        Cmd: {
                            "@name": "closeGame"
                        }
                    }
                }
            })
        },
        yr = function(gC) {
            var dR = gC.Exception;
            return dR ? this.fireEvent("u_", dR) : this.fireEvent("ip", gC)
        },
        BH = function() {
            var bK = 0,
                Oz = function() {};
            return function() {
                if (!bK) {
                    bK = 1;
                    document.body.style.display = "none";
                    CK && CK.Ed({
                        T2: 1,
                        eN: "/close.action",
                        mc: JSON.stringify(bj.params),
                        lY: 1
                    }).send()
                }
            }
        },
        mP = function(Hc) {
            var xD = {};
            if (Hc.coords) {
                xD.latitude = Hc.coords.latitude.toString();
                xD.longitude = Hc.coords.longitude.toString()
            }
            xD.locationstatus = (Hc.code || 0).toString();
            xD.locationmessage = Hc.message || "";
            KN(xD)
        },
        initResponse, XT = function(Uz) {
            function uZ(gC) {
                var fW = BH();
                window.addEvents({
                    beforeunload: fW,
                    unload: fW
                });
                HG = gC;
                L5.Tp(HG.CURRENCY, bj.params.denomamount);
                HG.GameLogicResponse.OutcomeDetail.Balance = L5.cF(HG.GameLogicResponse.OutcomeDetail.Balance);
                V6.PK(HG.CURRENCY, HG.GameLogicResponse)
            }
            var Nv = Zz.BZ({
                getplayerbalance: (!!Uz).toString()
            }, bj.params);
            aC.QI(XT);
            CK.Ed({
                eN: "/initstate.action",
                mc: JSON.stringify(Nv)
            }).addEvents({
                ip: uZ,
                u_: Z6
            }).send()
        },
        KN = (function() {
            var FD = {
                requestMobileNumber: function(PN) {
                    wZ(PN)
                },
                initGeoCoordinates: function(PN) {
                    aq(PN)
                }
            };
            return function(Cl) {
                function mU(cf) {
                    var oU = cf.AdditionalInfo && FD[cf.AdditionalInfo.Action] || wX;
                    oU(cf)
                }

                function hY(gC) {
                    var fW = BH();
                    window.addEvents({
                        beforeunload: fW,
                        unload: fW
                    });
                    V6.Pv()
                }
                Pk = Pk || qO(Zz.a7(bj.params, ["uniqueid", "nscode", "skincode", "softwareid"]));
                Cl = Zz.BZ(Cl || {}, bj.params);
                aC.QI(KN);
                CK.Ed({
                    eN: "/authenticate.action",
                    mc: JSON.stringify(Cl),
                    wX: mU
                }).addEvents({
                    ip: hY,
                    u_: Z6
                }).send()
            }
        })(),
        Kq = function() {
            function jk(vL, kM, rw) {
                if (kM && 0 > rw.indexOf(kM)) {
                    this.xC(vL)
                } else {
                    this.I9(vL)
                }
            }

            function Cw(y_, gj) {
                var vL = this.Xv(),
                    WL = vL.PatternsBet;
                vL.PatternsBet = y_;
                jk.call(this, vL, WL, gj)
            }

            function Ur(mC, N8) {
                var vL = this.Xv(),
                    Ae = vL.BetPerPattern && vL.BetPerPattern[L5] || 0;
                vL.BetPerPattern = vL.BetPerPattern || {};
                vL.BetPerPattern[L5] = L5.N6(mC);
                jk.call(this, vL, L5.cF(Ae).toString(), N8)
            }
            wa = HG.GameLogicResponse.OutcomeDetail.TransactionId;
            u5.rD(u5.LJ = HG.Paytable);
            u5.Sx(Pc = u5.Pc = HG.GameLogicResponse);
            u5.eR(u5.Pc);
            HG = void 0;
            if (u5.Pc.PatternSliderInput) {
                if (u5.Pc.PatternSliderInput.PatternsBet) {
                    Cw.call(Pk, u5.Pc.PatternSliderInput.PatternsBet, u5.LJ.PatternSliderInfo.PatternInfo.Step)
                }
                if (u5.Pc.PatternSliderInput.BetPerPattern) {
                    Ur.call(Pk, u5.Pc.PatternSliderInput.BetPerPattern, u5.LJ.PatternSliderInfo.BetInfo.Step)
                }
            }
            xb.m7("progress")
        },
        wZ = (function() {
            var Cy, CN;
            return function(PN) {
                var vL = Pk.Xv(),
                    Ie = PN.Message || [
                        ["", ""]
                    ];
                CN = CN || (new Element("form")).adopt(Ie.length > 1 ? (new Element("select", {
                    name: "Ki"
                })).adopt(Ie.length > 1 && new Element("option", {
                    value: "",
                    text: iJ("mproxy.SubmitMobileNumber.labelRegionCode")
                }), Ie.map(function(m4) {
                    return new Element("option", {
                        value: m4[0],
                        text: m4[1]
                    })
                })) : new Element("input", {
                    type: "hidden",
                    name: "Ki",
                    value: Ie[0][0]
                }), (new Element("label", {
                    text: iJ("mproxy.SubmitMobileNumber.labelDeviceNumber")
                })).adopt(new Element("input", {
                    type: "tel",
                    style: "-wap-input-format: '*N';",
                    name: "KJ"
                }))).addEvent("submit", function() {
                    var KJ = this.elements.KJ.value,
                        Ki = this.elements.Ki.value,
                        vL = Pk.Xv();
                    vL.deviceNumber = KJ;
                    vL.regionCode = Ki;
                    Pk.xC(vL);
                    window.event && window.event.preventDefault();
                    if (KJ && (Ki || Ie.length == 0)) {
                        Cy.Ep(0);
                        CK.Ed({
                            Kf: "get",
                            eN: "/subdnbr.action",
                            mc: {
                                devicenumber: KJ,
                                regioncode: Ki
                            }
                        }).addEvents({
                            ip: function(gC) {
                                delete gC.ReturnStatus.Code;
                                wX(gC.ReturnStatus)
                            },
                            Q1: function() {
                                Cy.Z3(0)
                            }
                        }).send()
                    }
                });
                Cy = Cy || Lu.YV(new Lu({
                    qZ: "Cy",
                    zX: "hK iT"
                }).addEvents({
                    GF: CN.fireEvent.bind(CN, "submit"),
                    e2: function() {
                        Cy.Z3(0);
                        jL()
                    }
                }).U4({
                    e2: new C6({
                        pR: iJ("mproxy.SubmitMobileNumber.buttonCancel"),
                        Xw: 1
                    }),
                    GF: new C6({
                        pR: iJ("mproxy.SubmitMobileNumber.buttonValidate"),
                        Xw: 1
                    })
                }).aE(new Element("h1", {
                    text: iJ("mproxy.SubmitMobileNumber.title")
                }), new Element("p", {
                    text: iJ("mproxy.SubmitMobileNumber.message")
                }), CN));
                document.body.grab(Cy, "top");
                CN.elements.KJ.value = vL.deviceNumber || "";
                CN.focus();
                if (Ie.length > 1) {
                    CN.elements.Ki.value = vL.regionCode || ""
                }
                return Cy.Ep(1).Z3(1)
            }
        })(),
        aq = function(PN) {
            var Vg = Vg || Lu.YV(new Lu({
                qZ: "SE",
                zX: "hK iT"
            })).aE(PN.Message).U4({
                e2: new C6({
                    pR: iJ("Game.buttonOk"),
                    Xw: 1
                })
            }).addEvents({
                e2: function() {
                    Vg.toElement().destroy();
                    Vg = void 0
                }
            }).addEvents({
                e2: function() {
                    e5(mP, Cx.geoLocation)
                }
            }).Z3(1);
            document.body.grab(Vg, "top")
        },
        vm = function() {
            if (bj.params.mac) {
                CK.Ed({
                    Kf: "get",
                    eN: "/valdnbr.action",
                    mc: {
                        mac: bj.params.mac
                    },
                    yr: function(gC) {
                        bj.params = gC.ReturnData;
                        KN()
                    }
                }).send()
            } else {
                KN()
            }
        },
        JH = function(mc) {
            var dC = 0;
            if (Pc.OutcomeDetail.GameStatus && (Pc.OutcomeDetail.GameStatus == "Start") && hP.transactiondelay) {
                if (za) {
                    dC = Math.max(0, (hP.transactiondelay * 1000) - (Date.now() - za))
                }
                za = 0;
                vl = Date.now()
            }
            if (dC) {
                setTimeout(function() {
                    oC(mc)
                }, dC)
            } else {
                oC(mc)
            }
        },
        oC = (function() {
            var eN;
            return function(mc) {
                eN = eN || "/play.action".concat(Zz.R5(bj.params, ["language", "presenttype", "channel", "freespin_tokenID", "freespin_bet", "freespin_lines", "freespin_num", "playMode"]));
                mc.GameLogicRequest.TransactionId = wa;
                aC.QI();
                CK.Ed({
                    eN: eN,
                    mc: JSON.stringify(mc)
                }).addEvents({
                    ip: ti,
                    u_: Z6
                }).send()
            }
        })(),
        wC = (function() {
            var eN;
            return function(zD, mc) {
                eN = eN || "/paytable.action".concat(Zz.R5(bj.params, ["language", "presenttype", "channel"]));
                aC.QI();
                CK.Ed({
                    Kf: "get",
                    eN: eN,
                    mc: JSON.stringify(mc)
                }).addEvents({
                    ip: zD,
                    u_: Z6
                }).send()
            }
        })(),
        JI, V6 = (function() {
            var yg, Gy, TQ = {},
                KI;

            function qc() {
                u5.Sx(u5.Pc);
                u5.Ul()
            }
            return {
                ho: function(Cx, bj) {
                    var bL, Zr = +new Date;
                    yg = document.createElement("iframe");
                    Gy = document.createElement("div");
                    Gy.id = "V6";
                    Gy.appendChild(yg);
                    document.body.insertBefore(Gy, document.body.lastElementChild);
                    xb.m7("queue", 1);
                    com.igt.mxf.setMessageOrigin(yg.contentWindow, Cx.url).addOneShotEvent("consoleInitialised", function(Cx) {
                        clearTimeout(bL);
                        console.warn("Console loaded after " + (Math.round((Zr - new Date) / 10) / 100) + "s");
                        if (Cx) {
                            bj.Nv = Zz.BZ(bj.params, Cx)
                        }
                        xb.m7("progress", 1);
                        xb.m7("console")
                    }).addEvents({
                        consoleResize: function(Dy) {
                            if (Gy.style.height != Dy) {
                                Gy.style.visibility = "visible";
                                Gy.style.height = Dy;
                                document.body.offsetWidth;
                                iG()
                            }
                            com.igt.mxf.sendMessage("consoleResized", Dy)
                        },
                        command: function(ta, Nv) {
                            aC.GQ(ta, Nv)
                        }
                    });
                    bL = setTimeout(function() {
                        xb.IF(window.parent, "loaderror")
                    }, Cx.timeout || 15000);
                    (function(N3) {
                        var a = document.createElement("a");
                        a.setAttribute("href", N3);
                        yg.src = a.href + (a.search ? "&" : "?") + Zz.oT(bj.params, Cx.urlParameterWhitelist)
                    })(Cx.url)
                },
                fG: function() {
                    u5.Pc = Pc;
                    u5.zz();
                    Zh.rQ && Zh.rQ.IG();
                    if (KI) {
                        com.igt.mxf.addOneShotEvent("resume", function() {
                            KI = 0;
                            u5.BE(1)
                        });
                        com.igt.mxf.enableEvents(1);
                        Pc && com.igt.mxf.sendOutcome(Pc);
                        com.igt.mxf.sendMessage("insufficientFundsNotification")
                    } else {
                        u5.BE(1)
                    }
                },
                vG: function() {
                    u5.BE(0);
                    if (!KI) {
                        KI = 1;
                        com.igt.mxf.addOneShotEvent("wagerStarted", function() {
                            com.igt.mxf.enableEvents(0);
                            u5.gJ()
                        });
                        com.igt.mxf.sendMessage("wagerIsStarting")
                    } else {
                        u5.gJ()
                    }
                },
                yB: function() {
                    u5.BE(0);
                    if (!KI) {
                        KI = 1;
                        com.igt.mxf.addOneShotEvent("wagerStarted", function() {
                            com.igt.mxf.enableEvents(0);
                            u5.Sj()
                        });
                        com.igt.mxf.sendMessage("wagerIsStarting")
                    } else {
                        u5.Sj()
                    }
                },
                zB: function() {
                    com.igt.mxf.addOneShotEvent("wagerComplete", function() {
                        KI = 0;
                        u5.GZ()
                    });
                    Gy.style.visibility = "";
                    com.igt.mxf.enableEvents(1);
                    com.igt.mxf.sendMessage("wagerIsComplete")
                },
                WG: function() {
                    u5.zz();
                    Zh.rQ && Zh.rQ.IG();
                    if (KI) {
                        com.igt.mxf.addOneShotEvent("wagerAborted", function() {
                            KI = 0;
                            u5.BE(1)
                        });
                        com.igt.mxf.enableEvents(1);
                        com.igt.mxf.sendMessage("wagerIsAborted")
                    } else {
                        u5.BE(1)
                    }
                },
                FN: function(rX) {
                    com.igt.mxf.addOneShotEvent("resume", function() {
                        aC.GQ(rX["@name"], rX.Param)
                    });
                    com.igt.mxf.sendMessage("command", rX["@name"], rX.Param)
                },
                Ho: function(UT) {
                    com.igt.mxf.addOneShotEvent("resume", function(m5) {
                        Gy.style.visibility = "";
                        if (UT.Buttons[m5]) {
                            aC.Qt(UT.Buttons[m5].Cmd)
                        } else {
                            vZ.PB(UT, aC.Qt).Z3(1);
                            Gy.style.height = ""
                        }
                    });
                    com.igt.mxf.enableEvents(1);
                    com.igt.mxf.sendMessage("displayMessage", UT.Id, UT.Reference, UT.Message, UT.Buttons.map(function(bz) {
                        return bz.Text
                    }));
                    Gy.style.visibility = "visible";
                    Gy.style.height = 0
                },
                hB: function() {
                    if (u5.Pc.OutcomeDetail.Settled != 0) {
                        com.igt.mxf.addOneShotEvent("afterGameOutcome", qc);
                        com.igt.mxf.sendOutcome(u5.Pc)
                    } else {
                        qc()
                    }
                },
                Pv: function() {
                    com.igt.mxf.addOneShotEvent("resume", function(uJ) {
                        XT(uJ)
                    });
                    com.igt.mxf.sendMessage("beforeInitGame")
                },
                PK: function(zw, yu) {
                    com.igt.mxf.addOneShotEvent("afterGameOutcome", Kq);
                    com.igt.mxf.setCurrencyFormat({
                        config: zw,
                        toCurrency: L5.N6,
                        format: L5.kN
                    });
                    com.igt.mxf.sendOutcome(yu)
                },
                Z3: function(r4) {
                    if (Gy) {
                        Gy.style.visibility = r4 ? "" : "hidden"
                    }
                },
                IN: function() {
                    Gy.style.visibility = "";
                    com.igt.mxf.sendMessage("gameReady")
                }
            }
        })();
    Lu.WU = function(hy) {
        hy.addEvents({
            a_: function() {
                V6 && V6.Z3(0)
            },
            pc: function() {
                V6 && V6.Z3(1)
            }
        });
        return Lu.YV(hy)
    };
    return function(MJ, LB, GA, fb) {
        Cx = MJ;
        hP = GA;
        bj = LB;
        u5 = new C8.hV();
        if (document.querySelector("meta[name='com.igt.game.IOS9FIX'][content='yes']")) {
            var Mr = new Element("div", {
                id: "game"
            });
            var ss = new Element("div", {
                id: "ios9fix"
            });
            ss.style.position = "absolute";
            ss.style.top = "0";
            ss.style.left = "0";
            ss.style.width = "100%";
            ss.style.height = "100%";
            ss.style.overflow = "hidden";
            u5.HB = (ss.adopt(Mr)).inject(document.body.lastElementChild, "before");
            u5.HB = Mr
        } else {
            u5.HB = (new Element("div", {
                id: "game"
            })).inject(document.body.lastElementChild, "before")
        }
        CK = new HO({
            Cx: Cx.RGS,
            SZ: SZ,
            eT: eT,
            wX: wX,
            yr: yr,
            Tt: Tt
        });
        u5.gR = Lu.YV(new ub({
            qZ: "gR",
            zX: "lh iT"
        }));
        document.body.grab(u5.gR, "top");
        vZ = Lu.WU(new ub({
            qZ: "vZ",
            zX: "hK iT",
            ws: 0
        }).addEvents({
            a_: function() {
                xb.m7("abortLoading"), u5.gR.Z3(0)
            }
        }));
        document.body.grab(vZ, "top");

        function subvertBalanceMeterForPromotionalFreeSpin(u5) {
            if (!u5.Mb) {
                throw new Error("You must expose Mb on the game instance")
            }
            var UZ = u5.Mb.Rt.bind(u5.Mb);
            u5.Mb.s3.db = Math.floor;
            u5.Mb.s3.Ck = Math.floor;
            u5.Mb.Rt = function() {
                if (u5.Pc.PromotionalFreeSpin && u5.Pc.PromotionalFreeSpin["@count"]) {
                    UZ(u5.Pc.PromotionalFreeSpin["@count"])
                }
            };
            u5.Mb.j5 = function() {
                return Infinity
            };
            u5.Mb.Rt()
        }
        fb.TW("initialise", function D5() {
            fb.v8("initialise", D5);
            u5.Pk = Pk;
            if (u5.Pc.PromotionalFreeSpin) {
                u5.LJ.PatternSliderInfo.PatternInfo.Step = [bj.params.freespin_lines];
                if (iJ("Game.consoleBalance") === iJ("Game.consoleBalance").toUpperCase()) {
                    Jr.rY("Game.consoleBalance", iJ("mproxy.PromotionalFreeSpin.consoleBalance").toUpperCase())
                } else {
                    Jr.rY("Game.consoleBalance", iJ("mproxy.PromotionalFreeSpin.consoleBalance"))
                }
            }
            u5.WK();
            u5.WK = void 0;
            if (u5.Pc.PromotionalFreeSpin) {
                subvertBalanceMeterForPromotionalFreeSpin(u5)
            }
            xb.m7("initialised");
            V6.IN()
        });
        fb.qU(["loaded", "console"], vm);
        V6.ho(Cx.console, bj);
        u5.yB = V6.yB;
        u5.vG = V6.vG;
        u5.zB = V6.zB;
        u5.hB = V6.hB;
        u5.kJ = V6.Z3;
        if (hP && hP.transactiondelay && hP.gameType && hP.gameType.toUpperCase() == "S") {
            u5.oC = JH
        } else {
            u5.oC = oC
        }
        u5.wC = wC;
        u5.BE = function(fL) {
            u5.rp(fL && !JI)
        }
    }
})();
C8.Cs = HO.Cs;
var DM = {
    lU: function(nH, Vb, Nf) {
        var Iw = 0,
            nh = 0;
        this.forEach(function(iP, pY, q9) {
            Vb.call(Nf, iP, pY, q9, Iw, nh);
            Iw = (++Iw == nH) ? 0 : Iw;
            nh += Iw ? 0 : 1
        })
    },
    kp: function(nH, Vb, Nf) {
        var Iw = 0,
            nh = 0;
        return this.map(function(iP, pY, q9) {
            g2 = Vb.call(Nf, iP, pY, q9, Iw, nh);
            Iw = (++Iw == nH) ? 0 : Iw;
            nh += Iw ? 0 : 1;
            return g2
        })
    },
    b7: function(nH) {
        var nh = [],
            pY;
        for (pY = 0; pY < this.length; pY += nH) {
            [].push.apply(nh, this.slice(pY, pY + nH).reverse())
        }
        return nh
    }
};
var Eb = (function() {
    var hQ = function() {
            this.U2.S8 = 1;
            this.kQ = ZQ.FZ(this.kQ, Sq.bind(this));
            this.fireEvent("S8")
        },
        Ul = function() {
            this.Ne(this.HE);
            delete this.HE;
            this.kQ = ZQ.jT(this.kQ);
            document.body.offsetWidth;
            ZQ.s2(this.fireEvent.bind(this, "hp"), 1)
        },
        lC = function(Ml) {
            var uw = this.U2.Dt.length;
            if (this.U2.gM) {
                while (--uw >= 0) {
                    if (0 == this.U2.Dt[uw]--) {
                        this.dm.NR(uw);
                        --this.U2.gM
                    }
                }
            }
            this.dm.Yx(Ml > this.s3.M9 ? this.s3.M9 : Ml)
        },
        Sq = function(Ml) {
            !this.ye && --this.U2.L2;
            if (this.U2.S8 && this.f2) {
                this.HE = this.f2.slice(0);
                this.U2.L2 += Math.ceil(this.s3.MT / ZQ.W4());
                this.U2.L2 = Math.max(this.U2.L2, 1);
                delete this.f2
            }
            if (this.U2.L2 == 0) {
                if (this.dm.Hc) {
                    this.kQ = ZQ.FZ(this.kQ, aZ.bind(this))
                }
            }
            this.dm.Yx(Ml)
        },
        aZ = function(Ml) {
            var uw = this.U2.QN.length;
            if (this.U2.HP > 0) {
                while (--uw >= 0) {
                    if (0 == this.U2.QN[uw]--) {
                        this.dm.DH(uw, this.f2);
                        --this.U2.HP
                    }
                }
            }
            this.dm.Yx(Ml > this.s3.M9 ? this.s3.M9 : Ml)
        };
    return new Class({
        Implements: [Events, hn],
        Binds: ["zP"],
        s3: {
            KL: 5,
            M9: 50
        },
        toElement: function() {
            return this.HB
        },
        initialize: function(s3) {
            s3.X0.qS = s3.X0.fc * (s3.X0.R9 + s3.X0.ly) - s3.X0.ly;
            s3.X0.Tl = s3.X0.U7 * (s3.X0.cd + s3.X0.e1) - s3.X0.e1;
            s3.X0.pk = s3.dm.Qi * s3.X0.cd;
            var wq = s3.X0;
            this.jy(s3);
            this.s3.Dt = s3.Dt || Array.ZD(0, 4, 1, 0);
            this.s3.QN = s3.QN || Array.ZD(0, wq.fc - 1, wq.fc, 20);
            this.GV = new Elements(DM.kp.call(this.s3.zQ, wq.fc, function(fM, m5, q9, t2, sG) {
                var d1 = new Element("div", {
                    "class": "T_",
                    styles: {
                        position: "absolute",
                        height: wq.cd,
                        width: wq.R9,
                        top: sG * (wq.cd + wq.e1),
                        left: t2 * (wq.R9 + wq.ly)
                    }
                });
                return d1
            }, this));
            this.HB = new Element("div", {
                "class": "md",
                styles: {
                    position: "relative",
                    margin: "0 auto",
                    height: wq.U7 * (wq.cd + wq.e1) - wq.e1,
                    width: wq.fc * (wq.R9 + wq.ly) - wq.ly
                }
            }).adopt(this.GV);
            wq.ly && this.HB.adopt(Array.ZD(0, wq.fc - 2).map(function(t2) {
                return new Element("div", {
                    "class": "gE",
                    styles: {
                        left: wq.R9 + t2 * (wq.R9 + wq.ly)
                    }
                })
            }, this));
            this.dm = this.s3.dm;
            this.dm.addEvents({
                S8: hQ.bind(this),
                hp: Ul.bind(this)
            });
            this.HB.adopt(this.dm.Xx({
                X0: s3.X0
            }))
        },
        Ne: (function() {
            var z7 = [];
            return function(f2, Ce, Ia) {
                Ce && this.dm.sT(f2, Ce, Ia);
                f2.forEach(function(N2, fM) {
                    this.GV[fM] && this.GV[fM].removeClass(z7[fM]).addClass(N2)
                }, this);
                z7 = f2;
                this.GV.EN("visibility", "")
            }
        })(),
        Ka: function(f2) {
            this.f2 = f2;
            this.dm.qi(f2)
        },
        cv: function(fE) {
            var W6 = [];
            for (var pY = fE.length; pY--;) {
                W6[pY] = this.GV[fE[pY]]
            }
            return new Elements(W6)
        },
        dI: function() {
            if (this.kQ) {
                this.GV.EN("visibility", "");
                this.dm.dI();
                this.kQ = ZQ.jT(this.kQ)
            }
            this.ye = 0
        },
        sN: function(s3) {
            this.dm.Ra();
            this.GV.EN("visibility", "hidden");
            this.U2 = {
                L2: 0,
                S8: 0,
                hp: 0,
                gM: this.s3.X0.fc,
                HP: this.s3.X0.fc,
                Dt: (this.s3.Dt).slice(0),
                QN: (this.s3.QN).slice(0)
            };
            this.kQ = this.kQ || ZQ.SK(lC.bind(this), this.s3.KL)
        },
        zP: function(gG) {
            this.ye = !!gG
        }
    })
})();
var Lo = new Class({
    Implements: [Events, hn],
    initialize: function(s3) {
        this.jy(s3)
    },
    Xx: function(s3) {
        this.jy(s3)
    },
    Ra: function(A5) {
        this.mO = this.K4 = this.s3.X0.fc;
        this.Ba = 0;
        return this
    },
    NR: function(i3, f2) {
        --this.mO;
        return this
    },
    DH: function(i3, f2) {
        --this.K4;
        return this
    },
    dI: function() {
        this.mO = this.K4 = 0;
        return this
    }
});
var Of = (function() {
    var Y_ = function Y_(Ia) {
            Ia.forEach(function(NW, pY) {
                this.h4[pY] = this.QO(this.NE, pY, NW)
            }, this);
            this.Ic = false
        },
        Yx = function Yx(Ml) {
            if (!this.K4 && this.rT === 0) {
                this.dI().fireEvent("hp")
            }
            this.dO[this.NE].forEach(function(t2, uw) {
                if (this.JG[uw] === 0) {
                    return
                }
                this.bZ[uw] += Ml;
                this.R6 = this.zS * this.bZ[uw];
                if (!this.Lx[uw].Qf && this.JG[uw] == this.Qi) {
                    this.Lx[uw].pV = this.R6;
                    this.Lx[uw].Qf = this.bZ[uw]
                }
                if (this.JG[uw] != -1 && this.JG[uw] <= this.Qi) {
                    this.M5[uw] = this.Lx[uw].TT(this.bZ[uw] - this.Lx[uw].Qf)
                } else {
                    this.M5[uw] = this.R6
                }
                this.Yv = Math.floor(this.M5[uw] / this.wq.cd);
                this.OV[uw] = Math.floor(this.M5[uw] % this.wq.cd);
                if (this.Yv > this.Zx[uw]) {
                    this.zm = this.dO[this.NE][uw][this.h4[uw]];
                    this.DX[uw].unshift(this.zm);
                    this.DX[uw].pop();
                    this.h4[uw]--;
                    if (this.h4[uw] < 0) {
                        this.h4[uw] = this.dO[this.NE][uw].length - 1
                    }
                    if (this.JG[uw] >= 0) {
                        this.JG[uw]--
                    }
                    if (this.JG[uw] === 0) {
                        this.rT--;
                        this.OV[uw] = 0
                    }
                    this.Zx[uw] = this.Yv
                }
            }, this);
            this.lG.BN()
        };
    return new Class({
        Implements: [Events, hn],
        Extends: Lo,
        initialize: function initialize(s3) {
            var Bu = {
                lG: null,
                aw: 0,
                zN: 42,
                Qi: 4,
                uY: 200,
                dq: 1
            };
            this.Yx = Yx;
            for (var H4 in Bu) {
                this[H4] = s3[H4] || Bu[H4]
            }
            this.OV = [];
            this.lQ = s3.lQ;
            this.dq = 1;
            Zz.ZP(Zh.q1, function(OU) {
                if (OU.dq && OU.dq > this.dq) {
                    this.dq = OU.dq
                }
            }, this);
            this.dq = s3.dq || this.dq;
            this.NE = s3.NE;
            this.Zx = [];
            this.R6 = 0, this.DX = [];
            this.h4 = [];
            this.M5 = [];
            this.zS = this.zN / 1000;
            this.rT = 0;
            this.dO = s3.Oc;
            this.JG = [];
            this.bZ = [];
            this.q1 = s3.q1;
            this.Yv = 0
        },
        Xx: function Xx(s3) {
            this.wq = s3.X0;
            this.parent(s3);
            this.Lx = [];
            this.dO[this.NE].forEach(function(t2, uw) {
                this.Lx[uw] = $merge(s3.lQ, {});
                this.Lx[uw] = new this.lQ({
                    bl: this.Qi * this.wq.cd,
                    L2: this.Qi * this.uY
                })
            }, this);
            this.bq(this.lG);
            this.HB = document.createElement("div");
            this.HB.setAttribute("id", "wk");
            this.HB.setAttribute("style", "visibility:hidden;position:absolute;width:" + this.wq.qS + "px;height:" + this.wq.Tl + "px;");
            this.lG.zy(this.HB);
            this.WE();
            return this.HB
        },
        WE: function() {
            var U7 = this.wq.U7;
            this.qM = Zz.Ev(this.dO, function(dO) {
                return dO.map(function(Wh) {
                    return Array.Uf(Wh, U7)
                })
            })
        },
        Ra: function Ra() {
            delete this.Hc;
            this.dO[this.NE].forEach(function(t2, uw) {
                this.bZ[uw] = 0;
                this.Lx[uw].Qf = 0
            }, this);
            this.rT = this.dO[this.NE].length;
            this.HB.style.visibility = "";
            this.lG.BN();
            this.parent();
            return this
        },
        NR: function NR(uw, f2) {
            this.parent.apply(this, arguments);
            this.JG[uw] = -1;
            this.Zx[uw] = 0;
            this.mO || this.fireEvent("S8");
            return this
        },
        qi: function qi(Hc) {
            this.Hc = this.M8(Hc)
        },
        DH: function DH(uw) {
            this.parent.apply(this, arguments);
            this.h4[uw] = this.QO(this.NE, uw, this.Hc[uw]);
            this.JG[uw] = this.wq.vn + this.aw;
            return this
        },
        dI: function dI() {
            this.parent.apply(this, arguments);
            this.lG.V4();
            this.HB.style.visibility = "hidden";
            return this
        },
        bq: function bq(lG) {
            this.lG = new lG(this)
        },
        sT: function sT(TM, NE, Ia) {
            this.NE = NE;
            this.lG.V4();
            TM = this.M8(TM);
            if (Ia) {
                this.h4 = Ia
            } else {
                Y_.call(this, TM)
            }
            this.dO[this.NE].forEach(function(t2, uw) {
                var iz, bC, Dm = this.dO[this.NE][uw].length;
                this.DX[uw] = [];
                this.OV[uw] = 0;
                this.JG[uw] = -1;
                for (bC = 0; bC <= this.wq.U7; bC++) {
                    iz = (Dm + this.h4[uw] + bC - this.aw - this.wq.U7) % Dm;
                    this.DX[uw][bC] = this.dO[this.NE][uw][iz]
                }
            }, this)
        },
        M8: function M8(Hc) {
            var ep = [];
            DM.lU.call(Hc, this.dO[this.NE].length, function(zm, pY, q9, nh, Iw) {
                if (Iw < this.wq.U7) {
                    ep[nh] = ep[nh] || [];
                    ep[nh][Iw] = zm
                }
            }, this);
            return ep
        },
        QO: function QO(NE, OQ, Hc) {
            var Hd = Hc.join(""),
                fM = this.qM[NE][OQ][Hd].getRandom();
            return (fM + this.wq.U7 - 1 + this.aw) % this.dO[NE][OQ].length
        }
    })
})();
Array.Uf = function(a, n) {
    var i, j, q, L = a.length,
        h = {};
    for (i = 0; q = "", i < L; h[q] = h[q] || [], h[q].push(i++)) {
        for (j = 0; j < n; q += a[(i + j++) % L]) {}
    }
    return h
};
Zg = (function() {
    var Ye = ((navigator.userAgent.indexOf("Mozilla/5.0") > -1 && navigator.userAgent.indexOf("Android ") > -1 && navigator.userAgent.indexOf("AppleWebKit") > -1) && !(navigator.userAgent.indexOf("Chrome") > -1));
    var exports = function(pp) {
        this.pp = pp;
        this.wq = pp.s3.X0;
        this.Vs = 0;
        this.fH = 0;
        this.bC = 0;
        this.Rl = "";
        this.dq;
        this.rm;
        this.Ut
    };
    exports.prototype = {
        zy: function zy(pp) {
            var Ut, wq = this.pp.s3.X0,
                dq = this.dq = this.pp.dq || 1,
                rm = this.rm = window.devicePixelRatio || 1;
            Ut = this.Ut = document.createElement("canvas");
            Ut.setAttribute("width", this.wq.qS * dq);
            Ut.setAttribute("height", this.wq.Tl * dq);
            Ut.setAttribute("style", "position:absolute;top:0px;left:0px;width:" + this.wq.qS + "px;height:" + this.wq.Tl + "px;");
            this.Ek = Ut.getContext("2d");
            this.Ek.scale(dq / rm, dq / rm);
            this.Ek.fillStyle = "#FFF";
            this.Ek.strokeStyle = "#000";
            this.Ek.lineWidth = 3;
            this.Ek.font = "16px consolas";
            this.Ek.textBaseline = "top";
            pp.appendChild(Ut)
        },
        BN: function BN() {
            var uw;
            this.V4();
            for (uw = 0; uw < this.wq.fc; uw++) {
                this.RA(uw)
            }
        },
        RA: function RA(uw) {
            for (this.bC = 0; this.bC <= this.wq.U7; this.bC++) {
                this.Vs = uw * (this.wq.R9 + this.wq.ly);
                this.fH = this.bC * this.wq.cd + ((this.pp.OV[uw] | 0) - this.wq.cd);
                this.Rl = this.pp.DX[uw][this.bC];
                this.Wz(this.Rl, {
                    Vs: this.Vs,
                    fH: this.fH
                })
            }
        },
        Wz: function Wz(Rl, Sb) {
            var jC = this.pp.q1[this.pp.NE][Rl];
            jC.X1(this.Ek, 0, 0, Sb.Vs, Sb.fH)
        },
        V4: function V4() {
            var Ek = this.Ut.getContext("2d");
            Ek.save();
            Ek.setTransform(1, 0, 0, 1, 0, 0);
            Ek.clearRect(0, 0, Ek.canvas.width, Ek.canvas.height);
            if (Ye) {
                this.Ut.EN("opacity", 0.99);
                setTimeout(function() {
                    this.Ut.EN("opacity", 1)
                }.bind(this), 0)
            }
            Ek.restore()
        }
    };
    return exports
})();

function Yu(s3) {
    this.aT = s3.aT;
    this.x5 = s3.x5;
    this.bl = s3.bl;
    this.L2 = s3.L2;
    this.pV = 0
}
Yu.prototype = {
    gf: function(t) {
        return t * t * t
    },
    mg: function(t) {
        return 3 * t * t * (1 - t)
    },
    Ak: function(t) {
        return 3 * t * (1 - t) * (1 - t)
    },
    K6: function(t) {
        return (1 - t) * (1 - t) * (1 - t)
    },
    TT: function(lv) {
        var X5 = lv / this.L2;
        return this.aT * this.mg(X5) + this.x5 * this.Ak(X5) + this.K6(X5)
    },
    r3: function(pV) {
        this.pV = pV
    }
};

function ox(s3) {
    this.bl = s3.bl;
    this.L2 = s3.L2;
    this.pV = 0
}
ox.prototype = {
    TT: function(lv) {
        return this.bl * ((lv = lv / this.L2 - 1) * lv * lv + 1) + this.pV
    }
};

function yO(s3) {
    this.bl = s3.bl;
    this.L2 = s3.L2;
    this.pV = 0
}
yO.prototype = {
    TT: function(lv) {
        return this.bl * (lv / this.L2) + this.pV
    },
    r3: function(pV) {
        this.pV = pV
    }
};
/*! iScroll v5.1.3 ~ (c) 2008-2014 Matteo Spinelli ~ http://cubiq.org/license */
(function(window, document, Math) {
    var rAF = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
        window.setTimeout(callback, 1000 / 60)
    };
    var utils = (function() {
        var me = {};
        var yo = document.createElement("div").style;
        var ef = (function() {
            var vendors = ["t", "webkitT", "MozT", "msT", "OT"],
                transform, i = 0,
                l = vendors.length;
            for (; i < l; i++) {
                transform = vendors[i] + "ransform";
                if (transform in yo) {
                    return vendors[i].substr(0, vendors[i].length - 1)
                }
            }
            return false
        })();

        function C_(style) {
            if (ef === false) {
                return false
            }
            if (ef === "") {
                return style
            }
            return ef + style.charAt(0).toUpperCase() + style.substr(1)
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
        var iN = C_("transform");
        me.extend(me, {
            hasTransform: iN !== false,
            hasPerspective: C_("perspective") in yo,
            hasTouch: "ontouchstart" in window,
            hasPointer: window.PointerEvent || window.MSPointerEvent,
            hasTransition: C_("transition") in yo
        });
        me.isBadAndroid = /Android /.test(window.navigator.appVersion) && !(/Chrome\/\d/.test(window.navigator.appVersion));
        me.extend(me.style = {}, {
            transform: iN,
            transitionTimingFunction: C_("transitionTimingFunction"),
            transitionDuration: C_("transitionDuration"),
            transitionDelay: C_("transitionDelay"),
            transformOrigin: C_("transformOrigin")
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
                ev.jR = true;
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
        this.UC = {};
        this.ZR();
        this.refresh();
        this.scrollTo(this.options.startX, this.options.startY);
        this.enable()
    }
    IScroll.prototype = {
        version: "5.1.3",
        ZR: function() {
            this.jm()
        },
        destroy: function() {
            this.jm(true);
            this.oV("destroy")
        },
        kc: function(e) {
            if (e.target != this.scroller || !this.isInTransition) {
                return
            }
            this.cX();
            if (!this.resetPosition(this.options.bounceTime)) {
                this.isInTransition = false;
                this.oV("scrollEnd")
            }
        },
        tl: function(e) {
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
            this.cX();
            this.startTime = utils.getTime();
            if (this.options.useTransition && this.isInTransition) {
                this.isInTransition = false;
                pos = this.getComputedPosition();
                this.mH(Math.round(pos.x), Math.round(pos.y));
                this.oV("scrollEnd")
            } else {
                if (!this.options.useTransition && this.isAnimating) {
                    this.isAnimating = false;
                    this.oV("scrollEnd")
                }
            }
            this.startX = this.x;
            this.startY = this.y;
            this.absStartX = this.x;
            this.absStartY = this.y;
            this.pointX = point.pageX;
            this.pointY = point.pageY;
            this.oV("beforeScrollStart")
        },
        iF: function(e) {
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
                this.oV("scrollStart")
            }
            this.moved = true;
            this.mH(newX, newY);
            if (timestamp - this.startTime > 300) {
                this.startTime = timestamp;
                this.startX = this.x;
                this.startY = this.y
            }
        },
        bT: function(e) {
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
                this.oV("scrollCancel");
                return
            }
            if (this.UC.flick && duration < 200 && distanceX < 100 && distanceY < 100) {
                this.oV("flick");
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
            this.oV("scrollEnd")
        },
        xT: function() {
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
            this.oV("refresh");
            this.resetPosition()
        },
        on: function(type, fn) {
            if (!this.UC[type]) {
                this.UC[type] = []
            }
            this.UC[type].push(fn)
        },
        off: function(type, fn) {
            if (!this.UC[type]) {
                return
            }
            var index = this.UC[type].indexOf(fn);
            if (index > -1) {
                this.UC[type].splice(index, 1)
            }
        },
        oV: function(type) {
            if (!this.UC[type]) {
                return
            }
            var i = 0,
                l = this.UC[type].length;
            if (!l) {
                return
            }
            for (; i < l; i++) {
                this.UC[type][i].apply(this, [].slice.call(arguments, 1))
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
                this.vJ(easing.style);
                this.cX(time);
                this.mH(x, y)
            } else {
                this.lV(x, y, time, easing.fn)
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
        cX: function(time) {
            time = time || 0;
            this.scrollerStyle[utils.style.transitionDuration] = time + "ms";
            if (!time && utils.isBadAndroid) {
                this.scrollerStyle[utils.style.transitionDuration] = "0.001s"
            }
        },
        vJ: function(easing) {
            this.scrollerStyle[utils.style.transitionTimingFunction] = easing
        },
        mH: function(x, y) {
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
        jm: function(remove) {
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
        lV: function(destX, destY, duration, easingFn) {
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
                    that.mH(destX, destY);
                    if (!that.resetPosition(that.options.bounceTime)) {
                        that.oV("scrollEnd")
                    }
                    return
                }
                now = (now - startTime) / duration;
                easing = easingFn(now);
                newX = (destX - startX) * easing + startX;
                newY = (destY - startY) * easing + startY;
                that.mH(newX, newY);
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
                    this.tl(e);
                    break;
                case "touchmove":
                case "pointermove":
                case "MSPointerMove":
                case "mousemove":
                    this.iF(e);
                    break;
                case "touchend":
                case "pointerup":
                case "MSPointerUp":
                case "mouseup":
                case "touchcancel":
                case "pointercancel":
                case "MSPointerCancel":
                case "mousecancel":
                    this.bT(e);
                    break;
                case "orientationchange":
                case "resize":
                    this.xT();
                    break;
                case "transitionend":
                case "webkitTransitionEnd":
                case "oTransitionEnd":
                case "MSTransitionEnd":
                    this.kc(e);
                    break;
                case "wheel":
                case "DOMMouseScroll":
                case "mousewheel":
                    this.P7(e);
                    break;
                case "keydown":
                    this.lO(e);
                    break;
                case "click":
                    if (!e.jR) {
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
var jY = (function() {
    return new Class({
        Extends: Lu,
        Binds: ["rb", "EP"],
        s3: {
            hu: 1
        },
        E0: 0,
        initialize: function(s3) {
            var Tf;
            this.parent(s3);
            this.U4({
                NG: new C6({
                    zX: "NG"
                }),
                GE: new C6({
                    zX: "GE"
                }),
                e2: new C6({
                    zX: "e2",
                    Xw: 1
                })
            });
            this.addEvents({
                GE: this.EP,
                NG: this.rb
            });
            this.HB.adopt((new Element("div", {
                "class": "B2"
            })).adopt(this.w_, this.N4 = new Element("div", {
                "class": "Cm"
            }).adopt(this.Yi)));
            this.Uo = new IScroll(this.N4, {
                hScrollbar: false,
                vScrollbar: true,
                checkDOMChanges: false,
                hideScrollbar: false
            })
        },
        aE: function(UT) {
            var WO;
            this.parent(arguments);
            this.Uo.scrollTo(0, 0, 0);
            setTimeout(this.Uo.refresh.bind(this.Uo), 200);
            return this
        },
        Z3: function(r4) {
            if (r4) {
                this.E0 = 0;
                this.wv(0)
            }
            this.parent(r4)
        },
        X6: function() {
            this.parent();
            this.aE("")
        },
        EP: function() {
            if (++this.E0 >= this.s3.hu) {
                this.E0 = 0
            }
            this.E0 = Math.min(this.E0, this.s3.hu - 1);
            this.wv(this.E0)
        },
        wv: function(Fa) {
            this.fireEvent("RH", Fa)
        },
        rb: function() {
            if (this.E0 <= 0) {
                this.E0 = this.s3.hu
            }
            this.E0 = Math.max(--this.E0, 0);
            this.wv(this.E0)
        },
        Ep: function(Vd) {
            this.w_.Ep(Vd, "NG");
            this.w_.Ep(Vd, "GE");
            return this
        }
    })
})();
JZ = {
    s8: {
        KX: [void 0, "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAJCAMAAAAxZj1mAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAB5QTFRF4nI9uU8xtDIJjxoA7X19SAQClyMA2JWBdRYA2QAAia0/LwAAAC5JREFUeNpiYOaAA2YGRnY4YGRgYmCBAiCTmRMO2BjYiOMwc7BCAQeIg7AHIMAApe0C74RD8HgAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFtDIJUlLjAABzuU8xjxoAgIDrAABJlyMAdRYA2JWBAADTconQ+wAAACpJREFUeNpiYOaEA2YGBkZWKGBkYGDnggN2ojlMbFDAxM7AwgEHLAABBgCWuALtvZioRQAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFUYmJS35+tDIJuU8xjxoAhauyABsflyMAdRYA2JWBAEdNt29nRwAAAChJREFUeNpiYOaEA2YGJkZWKGBgYmDnggN2ojlscMDOwMIBBywAAQYAmFYC+BK7s6AAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRF/6ystDIJuU8xi0lFjxoA7X19/8LCTzIslyMAdRYA2JWB/4SECte02QAAACtJREFUeNpiYOKCAyYGRgY2KAAyOVi5oYCVg2gOMzsUMHMwsHDCAQtAgAEAnZMDEwSNueQAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFtDIJ7lLuuU8xfAB8jxoA8ILyUABPlyMAdRYA2JWB4gDimBwoQQAAACpJREFUeNpiYOKEAyYGBkZWKGBkYGDnggN2ojnMbFDAzM7AwgEHLAABBgCWHALtiVmjCAAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFtDIJiU8A/7ZSuU8xjxoAlyMAVzIA+8t9dRYA2JWB+5EAdGRjHwAAADBJREFUeNpiYOaEA2YGBiZ2KGBiYGDlggNWBhZkDpIMC5oMIxsUMAL1cMABC0CAAQCYZgLmFsn4bgAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFtDIJuU8xo0PGjxoAQgBgLAQyvYDZlyMAdRYA2JWBeACvZopkRAAAACpJREFUeNpiYOSEA0YGBiY2KGBiYGDnggN2ojksrFDAws7AzAEHzAABBgCYJALtOrItsAAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFBk0HtDIJuU8xbqxujxoAlMKUCjQMlyMAdRYA2JWBLJEsTi6IFwAAAClJREFUeNpiYOKEAyYGRmZWKGBmZGDnggN2ojkMbFAAZLJwwAELQIABAJeiAu1guCNvAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFlpYAtDIJ//9SuU8xjxoA//+A6+sAUUwGlyMAdRYA2JWB//8A9fuYYAAAACtJREFUeNpiYOaCA2YGRiZWKGBiZOBg44YCNg6iOQzsUABksnDCAQtAgAEAni8DEzhEC6cAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFtDIJuU8xuGBgjxoATg4JNQwEihISy4qKlyMAdRYA2JWBlhQUiPWjUQAAACxJREFUeNpiYOSCA0YGBiZ2KGBiYOBg44YCNg6iOSysUMDCwcDMCQfMAAEGAKCfAxOWgkGkAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFAHJwtDIJuU8xUuLgjxoAAEdNAMzHgOrplyMAdRYA2JWBANzcz26GDQAAACtJREFUeNpiYOKCAyYGRmZ2KGBmZOBg44YCNg6iOQysUABksnDCAQtAgAEAoiUDE7zIvMIAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFtDIJuU8xsLBSUUwGjxoAvb2ALy8AlyMAdRYA2JWBeHcB+daQCgAAACpJREFUeNpiYOSEA0YGBiZWKGBiYGDnggN2YjkszGxQwAzkcMABC0CAAQCVtwLqtLPsNgAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFtDIJLFZnlsHMuU8xjxoAS5OwrdbeEjRDlyMAdRYA2JWBWq2+9efj5AAAADFJREFUeNpiYOaCA2YGBiY2KGBiYOBg5YYCVg40DjdWGW4gh5EdChg5GFg44YAFIMAAoIUDHw52ZAcAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFtDIJV+FcuU8xAIkAjxoABk0HgP+AlyMAdRYA2JWBAPsANaQCnQAAAC9JREFUeNpiYOKEAyYGBkY2KGBkYGDnggN2nBwWBhYUGWZWKGBmZ2DhgAMWgAADAJc6AufcZJa4AAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAIAAABChommAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGJJREFUeNpi2elvKO8WwIAbPNy1geX34xsfTTyEhYWxqnj79u3vuR0sjz9+//bw4YcPH7Aq+vjx49uP35kYiADUU8QCxJsPHLp76yZWaWU1dSsGBsZ+KYZnf/AZI8XCABBgADiiI6fXjO79AAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFOkRFtDIJhauyuU8xjxoAqcXFS35+HC8vlyMAdRYA2JWBUYmJ/wv6tAAAACtJREFUeNpiYOaCA2YGRiZWKGBiZOBg44YCNg6iOQzsUABksnDCAQtAgAEAni8DEzhEC6cAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRF/1K4tDIJiQBRuU8xjxoAVwAz/4DLlyMAdRYA2JWB+wCU1itkUwAAAClJREFUeNpiYOaEA2YGRgY2KAAy2bnggJ1oDhMrFDCxM7BwwAELQIABAJjAAu0awaQjAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFtDIJAEpuuU8xjxoAWq2+EjRDgMTmAH68lyMAdRYA2JWBAInMMjLF2QAAACxJREFUeNpiYOKCAyYGBhY2KGBhYOBg54YCdg6iOYysUMDIwcDMCQfMAAEGAKE7AxM9vy6pAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFtDIJV+FcBmUMuU8xjxoABk0Hhd6LlyMAdRYA2JWBA7QUrUqgIwAAAC1JREFUeNpiYOaEA2YGBkY2KGBkYGDnggMWZA47Pg4TKxQwsTOwcMABC0CAAQCX+gLqox2dVwAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFtDIJuU8xYmZKjxoAQT81sK2KlyMAdRYAwsSr2JWBv7uWyWmB3QAAACpJREFUeNpiYOSEA0YGBg44YGBgY+WCAlY2ojlMLFDAxMbAzA4HzAABBgCWUALBNmmjAgAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRF7ruftDIJuU8xcFVCjxoA6M+9TzIswZJwlyMAdRYA2JWB0Z56ZDdDSAAAACtJREFUeNpiYOKCAyYGRgZWKAAyOdi5oYCdg2gOMxsUMHMwsHDCAQtAgAEAnZMDE4iTdO8AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFUABPxEzOtDIJuU8xjxoA0YDMlgCNLAQylyMAdRYA2JWBowCZq+2d+wAAACtJREFUeNpiYOaCA2YGJkZWKGBkYuBg44YCNg6iOQzsUABksnDCAQtAgAEAni8DE8gEg9UAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFwX/YtDIJWCFouU8xjxoAPxlIlj22zp/flyMAdRYA2JWBo0PGddjKEgAAACtJREFUeNpiYOaCA2YGRgZ2KAAyOdi4oYCNg2gOEysUMHEwsHDCAQtAgAEAoTsDExaNTJ0AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFtDIJuqrUuU8xVUFmjxoAzMHgOCdDjXewlyMAdRYA2JWBnnrM0OVWjwAAACxJREFUeNpiYOKCAyYGBkZWKGBkYOBg54YCdg6iOcxsUMDMwcDCCQcsAAEGAJ2TAxOXGDtfAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFoepSP3gAtDIJuU8xjxoAlyMAKEwAuvCAdRYA2JWBc9wA4mi2IQAAAC5JREFUeNpiYOaEA2YGJgZ2KAAyWbnggBWZw8LAglOGlZENChhZGVg44IAFIMAAmHEC5myRN98AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFtDIJzp/fuU8xVUFmjxoAm16qOCdD1LPclyMAdRYA2JWBqGa56Aw10wAAACxJREFUeNpiYOKCAyYGBkZ2KGBkYOBg5YYCVg6iOcxsUMDMwcDCCQcsAAEGAJ+bAxNMSuS+AAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFtDIJuU8xsLBSjxoAUUwGy9SJLy8AlyMAdRYA2JWBlpYAHfGQKgAAACpJREFUeNpiYOSEA0YGBiZWKGBiYGDnggN2ojksbFDAws7AzAEHzAABBgCWHALt7Gdc6QAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFtDIJuqrUuU8xVUFmjxoAzMHgjXewMTA3lyMAdRYA2JWBk4myt5nYsQAAACxJREFUeNpiYOKCAyYGBkZWKGBkYOBg44YCNg6iOczsUMDMwcDCCQcsAAEGAJyPAxO7rW9BAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFgrbVtDIJLFZnuU8xlyMAjxoAEjRDS5Owo8ngdRYA2JWBR5PBGp/noQAAAC9JREFUeNpiYOaCA2YGRgYOKAAyWdi5oYCdBZnDysCKW4aJDQqYWBhYOeGAFSDAAJ+oAwn0MXb4AAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFPxlItDIJuU8xk2qejxoAsJG4WCFoLAQylyMAdRYA2JWBYSRxUKQ3yAAAACtJREFUeNpiYOKCAyYGRmZWKGBmZOBg44YCNg6iOQzsUABksnDCAQtAgAEAnhUDE0Wqpm0AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFtDIJuU8xe39d5/S9jxoAS1I2y9SJ8vXWlyMAdRYA2JWB2++eUXi9oAAAACxJREFUeNpiYOSCA0YGBmZ2KGBmYOBg44YCNg6iOUysUMDEwcDCCQcsAAEGAKEHAxMgFDkeAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFAHJwtDIJuU8xUuLgjxoAAEdNALy2gOrplyMAdRYA2JWBAMzHGnOxSwAAACtJREFUeNpiYOKCAyYGRmZ2KGBmZOBg44YCNg6iOQysUABksnDCAQtAgAEAoiUDE7zIvMIAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFXWpstDIJuU8xjxoAt9bW0uXoOkRFhauylyMAdRYA2JWBlsHMTYtlyAAAACtJREFUeNpiYOKCAyYGRhZWKGBhZOBg54YCdg6iOQxsUABkMnPCATNAgAEAn7UDE3+IovEAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAB5QTFRFtDIJuU8xbqxujxoAlMKUlyMAdRYACjQM2JWBInMiXFQdbwAAAChJREFUeNpiYOSAA0YGBiYWKGBiYGDlhANWojnscMDKwMwGB8wAAQYAhIoCmXYwIN8AAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFtDIJuU8xeHcB+8t9jxoA07Ip8uCWUUwGlyMAdRYA2JWB5cEt62ql3AAAACxJREFUeNpiYOSCA0YGBmY2KGBmYOBg5YYCVg6iOUzsUMDEwcDCCQcsAAEGAJ37AxN1hU6AAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFtDIJV+FcBmUMuU8xjxoAA7QUBk0Hhd6LlyMAdRYA2JWBFMEZEOavHwAAACxJREFUeNpiYOaCA2YGBkZ2KGBkYOBg5YYCVg6iOUxsUMDEwcDCCQcsAAEGAKA3AxPi+YvwAAAAAElFTkSuQmCC", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFYSRx8ILytDIJuU8xjxoAPxlIxEzO66jylyMAdRYA2JWB1lHlc1BE0wAAACtJREFUeNpiYOaCA2YGJkZ2KGBkYuBg44YCNg6iOQysUABksnDCAQtAgAEAoj8DEwkr35oAAAAASUVORK5CYII=", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFtDIJcjgquU8x7aF7jxoATigV7ruflyMAdRYA2JWB4nI9fdC2sAAAACpJREFUeNpiYOKEAyYGBmY2KGBmYGDnggN2ojmMrFDAyM7AwgEHLAABBgCZKALtEIfi8wAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFtDIJuU8xubm5UU9CjxoAycnJMTA3lyMAdRYA2JWBjIyMq+E0hAAAACpJREFUeNpiYOSEA0YGBiZWKGBiYGDnggN2ojnMbFDAzM7AwgEHLAABBgCWAgLtNTbafwAAAABJRU5ErkJggg==", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACFQTFRFXWpstDIJuU8xjxoAqcXFOkRF0uXolyMAdRYA2JWBt9bWK9WFxgAAAClJREFUeNpiYOKEAyYGRjY4YGRgZ+GCAhZ2ojkMrFAAZDJzwAEzQIABAJHYAsFjJ8ecAAAAAElFTkSuQmCC"],
        xu: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAICAMAAAD6Ou7DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACRQTFRFtDIJQUpLuU8xjIyMjxoAmpqaKC8wd3d3lyMAdRYA2JWBgYGBHXtLXwAAACxJREFUeNpiYOKCAyYGBmZWKGBmYOBg54YCdg6iOYxsUMDIwcDCCQcsAAEGAJ6XAxN2fUBwAAAAAElFTkSuQmCC"
    }
};
SV = function() {
    var mi = this;
    this.ec = null;
    this.Ay = ["ET", "Go", "aP", "tL", "NK"];
    this.P8 = 1.5;
    this.xW = 2.5;
    this.PC = 8;
    this.H2 = 100;
    this.ZC = new Rw({
        HB: new Element("div", {
            id: "vE"
        })
    });
    this.d5 = (new Element("div", {
        id: "mm"
    }));
    this.tq = (new Element("div", {
        id: "hW"
    }));
    this.r9 = (new Element("div", {
        id: "Q2"
    }));
    this.Ns = (new Element("div", {
        id: "Ip"
    }));
    this.Ns.innerHTML = iJ("Game.bigWin");
    this.V5 = (new Element("div", {
        id: "Q9",
        events: {
            webkitTransitionEnd: function(e) {
                if (e.event.elapsedTime < 0.75) {
                    mi.qz.removeClass("V1");
                    mi.qz.addClass("jG")
                }
            }
        }
    })).adopt(this.d5, this.tq, this.Ns, this.ZC, this.r9);
    this.qz = (new Element("div", {
        id: "oM",
        "class": "jG"
    })).adopt(this.V5);
    $("game").adopt(this.qz);
    this.QH = {
        cA: "backgroundPositionX",
        T4: Array.ZD(1, 10, 10, -110),
        ZZ: "px",
        kx: 100,
        fS: 1
    };
    this.GS = function(element) {
        var defaults = {
            wd: function() {
                element.EN("visibility", "visible")
            },
            Wp: function() {
                element.EN("visibility", "hidden")
            },
            Vz: function() {
                element.EN("visibility", "hidden")
            }
        };
        return defaults
    };
    this.AG = new gS({
        WP: 6300
    }).addEvents({
        wd: function() {
            mi.qz.addClass("Hm");
            mi.qz.removeClass("jG");
            mi.iC()
        },
        Wp: function() {
            mi.qz.removeClass("Hm");
            mi.qz.addClass("V1");
            mi.IG(1)
        },
        Vz: function() {
            mi.qz.removeClass("Hm");
            mi.qz.addClass("V1");
            mi.IG()
        }
    });
    this.AG.vP = function() {
        return mi.ZC
    };
    this.iC = function() {
        this.ec = {
            K3: [],
            x7: [],
            rF: [],
            Uq: 0
        };
        this.oe();
        this.ec.nE = ZQ.SK(this.gc.bind(this), this.H2)
    };
    this.oe = function() {
        var zC = (Math.random() * (this.xW - this.P8)) + this.P8,
            vf = 110 * zC,
            HR = 79 * zC;
        var Vs = Math.floor((Math.random() * 80) + 10),
            fH = Math.floor((Math.random() * 50) + 30);
        var margin_left = Math.floor(0.5 * vf);
        var margin_top = Math.floor(0.5 * HR);
        var eG = Math.floor(Math.random() * this.Ay.length);
        var qZ = this.Ay[eG];
        var wU = new Element("div", {
            id: qZ,
            "class": "F5"
        });
        wU.I7({
            transform: Sl.iN.gX(zC, zC),
            left: Vs + "%",
            top: fH + "%",
            "margin-left": "-" + margin_left + "px",
            "margin-top": "-" + margin_top + "px"
        });
        var RJ = (new QP(wU, this.QH)).addEvents(this.GS(wU));
        RJ.toElement = function() {
            return wU
        };
        this.ec.K3.push(wU);
        this.ec.x7.push(0);
        this.ec.rF.push(qZ);
        this.qz.appendChild(wU);
        RJ.tl()
    };
    this.gc = function() {
        if (this.ec.K3.length > 20) {
            this.IG()
        }
        for (var pY = 0; pY < this.ec.K3.length; pY++) {
            var wU = this.ec.K3[pY];
            if (wU === null) {
                continue
            }
            var Wt = this.ec.x7[pY];
            this.ec.x7[pY]++;
            if (this.ec.x7[pY] > 10) {
                this.qz.removeChild(this.ec.K3[pY]);
                this.ec.K3[pY] = null;
                continue
            }
        }
        var Ug = (this.Vf() === 0);
        if (Ug && this.ec.Uq) {
            this.IG(1)
        } else {
            var eG = Math.floor(Math.random() * (30 / this.PC));
            if (!this.ec.Uq && (Ug || (eG == 0))) {
                this.oe()
            }
        }
    };
    this.IG = function(z1) {
        if (this.ec) {
            if (!z1) {
                this.ec.Uq = 1
            } else {
                if (this.ec.nE) {
                    ZQ.jT(this.ec.nE)
                }
                for (var pY = 0; pY < this.ec.K3.length; pY++) {
                    var d1 = this.ec.K3[pY];
                    if (d1 !== null) {
                        this.qz.removeChild(d1);
                        delete this.ec.K3[pY]
                    }
                }
                delete this.ec
            }
        }
    };
    this.Vf = function() {
        var Np = 0;
        for (var pY = 0; pY < this.ec.K3.length; pY++) {
            if (this.ec.K3[pY] !== null) {
                Np++
            }
        }
        return Np
    };
    return this.AG
};
C8.hV = (function() {
    var XC = ["w01", "s01", "s02", "s03", "s04", "s05", "s06", "s07", "s08", "s09", "s10", "b01"],
        xl = {
            XC: XC,
            iU: Zz.Ev(XC.uR(), function() {
                return 12
            }),
            fE: [0, 5, 10, 15, 1, 6, 11, 16, 2, 7, 12, 17, 3, 8, 13, 18, 4, 9, 14, 19],
            wD: [0, 4, 8, 12, 16, 1, 5, 9, 13, 17, 2, 6, 10, 14, 18, 3, 7, 11, 15, 19],
            b3: ["L0C0R0", "L0C1R0", "L0C2R0", "L0C3R0", "L0C4R0", "L0C0R1", "L0C1R1", "L0C2R1", "L0C3R1", "L0C4R1", "L0C0R2", "L0C1R2", "L0C2R2", "L0C3R2", "L0C4R2", "L0C0R3", "L0C1R3", "L0C2R3", "L0C3R3", "L0C4R3"].uR(),
            xX: ["Scatter", "Line 1", "Line 2", "Line 3", "Line 4", "Line 5", "Line 6", "Line 7", "Line 8", "Line 9", "Line 10", "Line 11", "Line 12", "Line 13", "Line 14", "Line 15", "Line 16", "Line 17", "Line 18", "Line 19", "Line 20", "Line 21", "Line 22", "Line 23", "Line 24", "Line 25", "Line 26", "Line 27", "Line 28", "Line 29", "Line 30", "Line 31", "Line 32", "Line 33", "Line 34", "Line 35", "Line 36", "Line 37", "Line 38", "Line 39", "Line 40"].uR(),
            X0: {
                fc: 5,
                vn: 5,
                U7: 4,
                cd: 42,
                R9: 56,
                e1: 0,
                ly: 3,
                iX: 316,
                Dy: 174,
                NL: 5
            },
            X2: [{
                Wu: "#fff"
            }, {
                l6: 1,
                Wu: "#d90000",
                TM: [5, 6, 7, 8, 9],
                Gx: [62, 62],
                q4: 0
            }, {
                l6: 1,
                Wu: "#0000d3",
                TM: [10, 11, 12, 13, 14],
                Gx: [106, 106],
                q4: 0
            }, {
                l6: 1,
                Wu: "#00474d",
                TM: [0, 1, 2, 3, 4],
                Gx: [20, 20],
                q4: 0
            }, {
                l6: 1,
                Wu: "#ff8484",
                TM: [15, 16, 17, 18, 19],
                Gx: [149, 149],
                q4: 0
            }, {
                l6: 1,
                Wu: "#e200e2",
                TM: [5, 11, 17, 13, 9],
                Gx: [53, 50],
                q4: -2
            }, {
                l6: 1,
                Wu: "#fb9100",
                TM: [10, 6, 2, 8, 14],
                Gx: [113, 113],
                q4: -8
            }, {
                l6: 1,
                Wu: "#7800af",
                TM: [0, 1, 7, 13, 19],
                Gx: [27, 145],
                q4: 16
            }, {
                l6: 1,
                Wu: "#2c912c",
                TM: [15, 16, 12, 8, 4],
                Gx: [141, 23],
                q4: -16
            }, {
                l6: 1,
                Wu: "#ffff00",
                TM: [5, 1, 2, 3, 9],
                Gx: [70, 65],
                q4: 2
            }, {
                l6: 1,
                Wu: "#961414",
                TM: [10, 16, 17, 18, 14],
                Gx: [97, 97],
                q4: -13
            }, {
                l6: 1,
                Wu: "#00dcdc",
                TM: [0, 6, 12, 18, 19],
                Gx: [12, 154],
                q4: 9
            }, {
                l6: 1,
                Wu: "#787701",
                TM: [15, 11, 7, 3, 4],
                Gx: [157, 16],
                q4: -9
            }, {
                l6: 1,
                Wu: "#5aadbe",
                TM: [5, 1, 7, 13, 9],
                Gx: [46, 75],
                q4: -4
            }, {
                l6: 1,
                Wu: "#00fb00",
                TM: [10, 16, 12, 8, 14],
                Gx: [120, 112],
                q4: 4
            }, {
                l6: 1,
                Wu: "#b9b9b9",
                TM: [0, 6, 2, 8, 4],
                Gx: [3, 7],
                q4: -7
            }, {
                l6: 1,
                Wu: "#518989",
                TM: [15, 11, 17, 13, 19],
                Gx: [134, 138],
                q4: 7
            }, {
                l6: 1,
                Wu: "#fb0094",
                TM: [5, 11, 7, 3, 9],
                Gx: [77, 57],
                q4: 5
            }, {
                l6: 1,
                Wu: "#0089cc",
                TM: [10, 6, 12, 18, 14],
                Gx: [90, 120],
                q4: -5
            }, {
                l6: 1,
                Wu: "#03b414",
                TM: [0, 6, 7, 8, 4],
                Gx: [35, 31],
                q4: -2
            }, {
                l6: 1,
                Wu: "#bfbb96",
                TM: [15, 11, 12, 13, 19],
                Gx: [165, 162],
                q4: 6
            }, {
                l6: 0,
                Wu: "#d19e7a",
                TM: [19, 18, 12, 6, 5],
                Gx: [165, 82],
                q4: 0
            }, {
                l6: 0,
                Wu: "#a30099",
                TM: [4, 3, 7, 11, 10],
                Gx: [19, 95],
                q4: -12
            }, {
                l6: 0,
                Wu: "#a343c6",
                TM: [9, 8, 2, 6, 5],
                Gx: [53, 59],
                q4: 0
            }, {
                l6: 0,
                Wu: "#9e7acc",
                TM: [14, 13, 17, 11, 10],
                Gx: [108, 109],
                q4: -8
            }, {
                l6: 0,
                Wu: "#73dc00",
                TM: [19, 13, 12, 11, 5],
                Gx: [142, 74],
                q4: 2
            }, {
                l6: 0,
                Wu: "#a866b9",
                TM: [4, 8, 7, 6, 10],
                Gx: [3, 101],
                q4: -2
            }, {
                l6: 0,
                Wu: "#969600",
                TM: [4, 3, 7, 1, 0],
                Gx: [27, 8],
                q4: 10
            }, {
                l6: 0,
                Wu: "#9389b2",
                TM: [19, 18, 12, 16, 15],
                Gx: [150, 137],
                q4: -10
            }, {
                l6: 0,
                Wu: "#4793c1",
                TM: [19, 13, 12, 6, 0],
                Gx: [125, 12],
                q4: -10
            }, {
                l6: 0,
                Wu: "#612471",
                TM: [4, 8, 7, 11, 15],
                Gx: [36, 158],
                q4: 10
            }, {
                l6: 0,
                Wu: "#dbef9e",
                TM: [14, 8, 2, 1, 0],
                Gx: [91, 25],
                q4: 6
            }, {
                l6: 0,
                Wu: "#00ccc7",
                TM: [9, 13, 17, 16, 15],
                Gx: [70, 150],
                q4: -6
            }, {
                l6: 0,
                Wu: "#96c1cc",
                TM: [14, 8, 2, 1, 5],
                Gx: [100, 51],
                q4: -9
            }, {
                l6: 0,
                Wu: "#227322",
                TM: [9, 13, 17, 16, 10],
                Gx: [77, 117],
                q4: 9
            }, {
                l6: 0,
                Wu: "#e5c12d",
                TM: [19, 13, 7, 6, 0],
                Gx: [157, 30],
                q4: 12
            }, {
                l6: 0,
                Wu: "#14c119",
                TM: [4, 8, 12, 11, 15],
                Gx: [12, 153],
                q4: -12
            }, {
                l6: 0,
                Wu: "#d651e5",
                TM: [19, 13, 7, 1, 5],
                Gx: [134, 67],
                q4: -17
            }, {
                l6: 0,
                Wu: "#e2723d",
                TM: [4, 8, 12, 16, 10],
                Gx: [43, 123],
                q4: 17
            }, {
                l6: 0,
                Wu: "#8c8c8c",
                TM: [14, 18, 12, 6, 0],
                Gx: [115, 39],
                q4: 2
            }, {
                l6: 0,
                Wu: "#b7d6d6",
                TM: [9, 3, 7, 11, 15],
                Gx: [62, 161],
                q4: -2
            }],
            fh: ["h_", "lX", "e8", "T3"],
            uf: {
                w01: "dV",
                s01: "BI",
                s02: "CT",
                s03: "LO",
                s04: "x2",
                b01: "y0"
            }
        },
        nN = (function() {
            return function(Kx) {
                return xl.fE.map(function(pY, nh) {
                    return Kx[xl.wD[nh]]
                })
            }
        }());
    xl.kW = JZ.s8.KX.map(function(mV, pY) {
        var UY = xl.X2[pY];
        return mV && (new Element("div", {
            "class": "Iy"
        })).adopt(new Element("img", {
            src: mV,
            "class": "JY"
        }), new Element("img", {
            src: JZ.s8.xu,
            "class": "Ao"
        }))
    });
    var Xi = function() {
            this.C0.eu();
            this.Jh.qd();
            this.Gv.Z3(0)
        },
        Nc = function() {
            this.VN.fL(0)
        },
        Jb = function() {
            var vL = this.Pk.Xv();
            vL.BetPerPattern[L5] = L5.N6(this.C0.j5());
            this.Pk.xC(vL);
            this.BE(1)
        },
        Xj = function(ke) {
            this.wc.kU(TR(ke));
            this.Dc.Rt(this.ji());
            this.BE(1)
        };
    var sI = function() {
        this.V7.sv(0);
        this.C0.Z3(0);
        this.Jh.qd();
        this.Jh.TG().removeClass("rC");
        this.yB()
    };
    return new Class({
        Extends: C8,
        Implements: Events,
        Binds: ["sN", "hQ", "Ul", "tQ", "Qv"],
        XE: 0,
        iQ: 0,
        k5: 0,
        WK: function() {
            var mi = this,
                vL = this.Pk.Xv();
            this.wE = (new jY({
                qZ: "wE",
                zX: "Lc",
                hu: iJ("Game.mboxHowToPlay").length,
                Bc: 1
            })).addEvents({
                RH: this.tQ,
                wK: ZQ.hS,
                XL: ZQ.e4
            });
            com.igt.mxf.registerControl({
                type: "command",
                name: "howToPlay",
                text: iJ("MenuCommand.howToPlay"),
                enabled: 1
            }).addEvent("change", this.wE.Z3.bind(this.wE, 1));
            this.gn = (new jY({
                qZ: "gn",
                zX: "Lc",
                hu: iJ("Game.mboxPaytable").length,
                Bc: 1
            })).addEvents({
                RH: this.Qv,
                wK: ZQ.hS,
                XL: ZQ.e4
            });
            com.igt.mxf.registerControl({
                type: "command",
                name: "paytable",
                text: iJ("MenuCommand.payTable"),
                enabled: 1
            }).addEvent("change", this.gn.Z3.bind(this.gn, 1));
            [this.wE, this.gn].forEach(function(hy) {
                document.body.grab(Lu.YV(hy), "top")
            }, this);
            this.Jh = new rP({
                qZ: "Nb"
            });
            this.V7 = new TV(xl.X2, {
                X0: xl.X0,
                kW: xl.kW,
                wD: xl.wD,
                ew: this.LJ.PatternSliderInfo.PatternInfo.Step,
                ar: this.Pc.PatternSliderInput.PatternsBet,
                c5: "#000",
                Al: 2,
                Vm: 4,
                pm: "round",
                VP: "round",
                ZI: "#0089cc"
            });
            this.md = (new Eb({
                X0: xl.X0,
                MT: 0,
                KL: 25,
                zQ: xl.wD,
                fl: {},
                Dt: [0, 0, 0, 0, 0],
                QN: [1, 10, 18, 26, 34],
                dm: new Of({
                    zN: 600,
                    aw: 10,
                    Qi: 1,
                    uY: 50,
                    lG: Zg,
                    lQ: ox,
                    NE: this.Pc.OutcomeDetail.Stage,
                    q1: {
                        BaseGame: {
                            w01: Zh.q1.tJ,
                            s01: Zh.q1.JM,
                            s02: Zh.q1.Pu,
                            s03: Zh.q1.X9,
                            s04: Zh.q1.rB,
                            s05: Zh.q1.dA,
                            s06: Zh.q1.PJ,
                            s07: Zh.q1.Wg,
                            s08: Zh.q1.Fl,
                            s09: Zh.q1.JB,
                            s10: Zh.q1.YU,
                            b01: Zh.q1.ZM
                        },
                        FreeSpin: {
                            w01: Zh.q1.Kd,
                            s01: Zh.q1.Bq,
                            s02: Zh.q1.Bo,
                            s03: Zh.q1.SU,
                            s04: Zh.q1.zR,
                            s05: Zh.q1.pN,
                            s06: Zh.q1.x6,
                            s07: Zh.q1.vv,
                            s08: Zh.q1.o2,
                            s09: Zh.q1.F3,
                            s10: Zh.q1.Zu,
                            b01: Zh.q1.d2
                        }
                    },
                    Oc: this.km
                })
            })).addEvents({
                S8: this.hQ.bind(this),
                hp: this.hB.bind(this)
            });
            this.Dc = new Rw({
                HB: new Element("span")
            });
            com.igt.mxf.registerControl({
                type: "stake",
                name: "stake",
                text: iJ("Game.consoleBet"),
                enabled: 0,
                valueText: TR(0),
                value: 0
            }).linkEvent("change", this.Dc, "tC");
            this.XR = new Rw({
                HB: new Element("span")
            });
            this.g6 = new Rw({
                HB: new Element("span"),
                db: Math.floor
            });
            this.F8 = new Rw({
                HB: new Element("span"),
                db: Math.floor
            });
            this.Mb = new Rw({
                HB: new Element("span"),
                HH: this.Pc.OutcomeDetail.Balance,
                B5: 20
            });
            com.igt.mxf.registerControl({
                type: "balance",
                name: "totalBalance",
                text: iJ("Game.consoleBalance"),
                enabled: 1,
                valueText: TR(this.Pc.OutcomeDetail.Balance),
                value: L5.N6(this.Pc.OutcomeDetail.Balance)
            }).addEvent("change", function(ke) {
                ke = ke >= 0 ? ke : 0;
                this.Mb.Rt(L5.cF(ke));
                this.Pc.OutcomeDetail.Balance = this.Mb.j5();
                this.BE(1)
            }.bind(this));
            this.VN = (new C6({
                qZ: "iS",
                pR: iJ("Game.buttonSpin"),
                Xw: 0
            })).addEvents({
                GL: sI.bind(this)
            });
            this.wc = (new C6({
                qZ: "Pd",
                Xw: 0
            })).addEvents({
                DF: Xi.bind(this)
            }).oQ((new Element("div", {
                "class": "oY"
            })).adopt(new Element("div", {
                html: iJ("Game.buttonBetPerPattern")
            })));
            this.C0 = new Xz({
                qZ: "mC",
                CE: this.LJ.PatternSliderInfo.BetInfo.Step,
                Ck: TR,
                x0: iJ("Game.selectorBetPerPattern") + " ",
                KZ: {
                    lg: "#555",
                    KY: 1
                }
            }).addEvents({
                tC: Xj.bind(this),
                a_: Nc.bind(this),
                pc: Jb.bind(this)
            });
            var xt = com.igt.mxf.registerControl({
                type: "list",
                name: "betPerPattern",
                text: iJ("Game.buttonBetPerPattern"),
                enabled: 0,
                value: L5.cF(vL.BetPerPattern[L5]).toString(),
                valueText: this.LJ.PatternSliderInfo.BetInfo.Step.map(TR),
                values: this.LJ.PatternSliderInfo.BetInfo.Step
            }).addEvent("change", function(ke) {
                if (this.wc.fL) {
                    this.C0.Rt(ke)
                }
            }.bind(this)).linkEvent("change", this.C0, "tC").linkEvent("enable", this.wc, "fL");
            this.rW = new Element("div", {
                id: "QV"
            }).adopt(new Element("div", {
                "class": "oY"
            }).adopt(new Element("div", {
                html: iJ("Game.buttonPatternsBet")
            }), new Element("number", {
                html: this.Pc.PatternSliderInput.PatternsBet
            })));
            this.Gv = (new YL({
                qZ: "xY",
                Yi: new Element("currency")
            })).oQ((new Element("div", {
                "class": "oY"
            })).adopt(new Element("div", {
                html: iJ("Game.boxWin")
            })));
            YL.Mu(this.Gv);
            this.C0.Rt(L5.cF(vL.BetPerPattern[L5]).toString());
            this.Km = new C6({
                qZ: "Ke",
                Xw: 1,
                pR: iJ("Game.buttonSkip")
            });
            this.fv = new C6({
                qZ: "sL",
                Xw: 1,
                pR: iJ("Game.buttonStart")
            });
            this.HB.adopt(new Element("div", {
                id: "p9"
            }), new Element("div", {
                id: "Tb"
            }), new Element("div", {
                id: "Eg"
            }), new Element("div", {
                id: "MV"
            }).adopt(this.gR, new Element("div", {
                id: "DC"
            }), new Element("div", {
                id: "V9"
            }), new Element("div", {
                id: "h0"
            }), this.md, new Element("div", {
                id: "EA"
            }), this.V7, this.Wm), this.Jh, new Element("div", {
                id: "Cb"
            }), this.C0, (new Element("div", {
                id: "Ow"
            })).adopt((new Element("div", {
                id: "ws"
            })).adopt((new Element("div", {
                "class": "Er",
                id: "s9"
            })).adopt(this.rW, this.Gv), this.wc, this.VN, this.Km, this.fv)), new Element("div", {
                id: "b8"
            }).adopt(new Element("div", {
                id: "i7",
                "class": "Yw"
            }).adopt(new Element("span", {
                "class": "oY",
                text: iJ("Game.consoleBalance")
            }), this.Mb), new Element("div", {
                id: "IL",
                "class": "Yw"
            }).adopt(new Element("hr"), new Element("span", {
                "class": "oY",
                text: iJ("Game.consoleBet")
            }), this.Dc), new Element("div", {
                id: "Gk",
                "class": "Yw"
            }).adopt(new Element("hr"), new Element("span", {
                "class": "oY",
                text: iJ("Game.consoleBonus")
            }), this.XR), new Element("div", {
                id: "Ji",
                "class": "Yw"
            }).adopt(new Element("hr"), new Element("span", {
                "class": "oY",
                text: iJ("Game.consoleSpins")
            }), this.g6, new Element("span", {
                text: "/"
            }), this.F8)));
            this.I6();
            this.k5 = 1;
            if (this.Pc.OutcomeDetail.Stage == "FreeSpin") {
                document.body.addClass("hN");
                mi.Jh.aE(iJ("Game.freeSpinPrompt"));
                mi.Jh.TG().addClass("rC");
                var q6 = this.Pc.PrizeOutcome["FreeSpin.Total"] || 0;
                q6 += mi.Pc.PrizeOutcome["BaseGame.Scatter"]["@totalPay"];
                mi.XR.Rt(q6);
                this.g6.Rt(this.Pc.FreeSpinOutcome.Count);
                this.F8.Rt(this.Pc.FreeSpinOutcome.TotalAwarded);
                this.Pc.OutcomeDetail.Stage = "FreeSpin";
                this.fv.Z3(1);
                this.BE(0)
            } else {
                document.body.addClass("Wq");
                if (this.Pc.OutcomeDetail.NextStage == "FreeSpin") {
                    mi.xB.tl()
                } else {
                    Zh.rQ.Dz("zd");
                    this.BE(1)
                }
            }
            this.md.Ne(this.Pc.PopulationOutcome[this.Pc.OutcomeDetail.Stage + ".Reels"].TM, this.Pc.OutcomeDetail.Stage)
        },
        I6: function() {
            var mi = this,
                ru = function() {
                    return mi.Pc.PrizeOutcome[mi.Jc + ".Lines"]["@totalPay"] + mi.Pc.PrizeOutcome[mi.Jc + ".Scatter"]["@totalPay"]
                },
                Cj = function(UT, Wu) {
                    mi.Jh.EN("color", Wu || "#fff").aE(UT)
                },
                Ty = new o3((new gS({
                    WP: 1200
                })).addEvents({
                    wd: function() {
                        mi.V7.RE(mi.Pc.PrizeOutcome[mi.Jc + ".Lines"].Prize).sv(1)
                    },
                    Vz: function() {
                        mi.V7.sv(0)
                    },
                    Wp: function() {
                        mi.V7.sv(0)
                    }
                }), function() {
                    return mi.Pc.PrizeOutcome[mi.Jc + ".Lines"].Prize.length > 0
                }),
                YA = mi.YA = (function() {
                    var LG = [],
                        d9, bV = 0,
                        sq = mi.md.toElement();
                    return (new QP(null, {
                        cA: "backgroundPositionX",
                        T4: Array.ZD(1, 11, 11, -xl.X0.R9).concat(0),
                        ZZ: "px",
                        kx: 70
                    })).addEvents({
                        wd: function(AG) {
                            var A8, hd = mi.Pc.PrizeOutcome[mi.Jc + ".Scatter"],
                                FK = mi.Pc.PrizeOutcome[mi.Jc + ".Lines"];
                            AG.bV = 1;
                            if (mi.Pc.OutcomeDetail.Stage.match(/^BaseGame/) && mi.Pc.OutcomeDetail.NextStage == "FreeSpin") {
                                A8 = hd.i6.concat(FK.i6);
                                LG = []
                            } else {
                                A8 = hd.wB.concat(FK.wB);
                                LG = hd.Prize.concat(FK.Prize)
                            }
                            AG.s3.UN = (mi.Pc.OutcomeDetail.NextStage == "BaseGame" && mi.Pc.OutcomeDetail.Stage == "FreeSpin") ? 24 : 12;
                            LG.sort(function(q9, Z1) {
                                return q9["@totalPay"] == 0 ? 1 : Z1["@totalPay"] == 0 ? -1 : Z1["@totalPay"] - q9["@totalPay"] || q9.s6 - Z1.s6
                            });
                            d9 = 0;
                            this.ib(LG.length);
                            this.fireEvent("qm")
                        },
                        cD: function(AG, cY) {
                            if (mi.Pc.OutcomeDetail.NextStage == "BaseGame" && mi.Pc.OutcomeDetail.Stage == "FreeSpin") {
                                cY % 3 || d9.b9.EN("opacity", cY % 6 ? 0 : "")
                            }
                            if (mi.Pc.OutcomeDetail.Stage == "BaseGame") {
                                cY % 3 || d9.hL.EN("opacity", cY % 6 ? 0 : "");
                                if (!d9.Tm) {
                                    cY % 3 || d9.Sf.EN("opacity", cY % 6 ? 0 : "")
                                }
                            }
                        },
                        qm: function(AG, fS) {
                            $$(".md .T_").EN("background-position-x", "");
                            var wL = mi.Pc.OutcomeDetail.Stage == "FreeSpin" && mi.Pc.OutcomeDetail.NextStage == "BaseGame",
                                cT, Fe = ["w01", "s01", "s02", "s03", "s04"];
                            d9 && mi.V7.sv(0);
                            d9 = LG.shift();
                            if (mi.Pc.OutcomeDetail.Stage.match(/^BaseGame/) && mi.YA.bV < 2) {
                                var Qh = d9["@payName"].slice(-3),
                                    ug = xl.uf[Qh];
                                ug && Zh.rQ.Dz(ug)
                            }
                            d9.Rm = mi.md.cv(d9.ue.filter(function(pY) {
                                return "w01" == mi.Pc.PopulationOutcome[mi.Jc + ".Reels"].TM[pY]
                            }));
                            d9.b9 = mi.md.cv(d9.ue.filter(function(pY) {
                                return "b01" == mi.Pc.PopulationOutcome[mi.Jc + ".Reels"].TM[pY]
                            }));
                            d9.Sf = mi.md.cv(d9.ue.filter(function(pY) {
                                return Fe.indexOf(mi.Pc.PopulationOutcome["BaseGame.Reels"].TM[pY]) != -1
                            }));
                            d9.hL = mi.md.cv(d9.ue.filter(function(pY) {
                                return Fe.indexOf(mi.Pc.PopulationOutcome["BaseGame.Reels"].TM[pY]) == -1
                            }));
                            cT = d9["@totalPay"] + (d9.s6 == 0 && wL && mi.Pc.PrizeOutcome["FreeSpin.Total"]);
                            var ww = mi.Pc.OutcomeDetail.Stage == "FreeSpin" && mi.Pc.OutcomeDetail.NextStage != "BaseGame" ? mi.Pc.OutcomeDetail.Pending : mi.Pc.OutcomeDetail.Settled;
                            d9.Tm = cT >= ww;
                            if (d9.Tm && mi.Pc.OutcomeDetail.Stage == "BaseGame") {
                                this.sH(d9.Sf)
                            } else {
                                this.sH(new Elements());
                                if (d9.Rm.length > 0) {
                                    d9.Rm.EN("background-position-x", "-280px")
                                }
                            }
                            mi.V7.zO(d9).sv(1);
                            cT = d9["@totalPay"] + (d9.s6 == 0 && wL && mi.Pc.PrizeOutcome["FreeSpin.Total"]);
                            Cj(gQ(d9.s6 ? "Game.lineWin" : wL ? "Game.freeSpinWin" : "Game.scatterWin", TR(cT)), d9.Ly.Wu);
                            $$(".md .T_").EN("opacity", "");
                            mi.YA.bV++
                        },
                        Vz: function() {
                            $$(".md .T_").EN("opacity", "");
                            $$(".md .T_").EN("background-position-x", "");
                            d9 && mi.V7.sv(0)
                        },
                        Wp: function() {
                            $$(".md .T_").EN("opacity", "");
                            $$(".md .T_").EN("background-position-x", "")
                        },
                        Hb: function() {
                            d9 && mi.V7.sv(0);
                            LG = 0;
                            $$(".md .T_").EN("opacity", "");
                            $$(".md .T_").EN("background-position-x", "")
                        }
                    })
                }()),
                wm = (new QP(null, {
                    cA: "backgroundPositionX",
                    T4: Array.ZD(1, Zh.q1.ZM.Vo - 1, Zh.q1.ZM.Vo - 1, -xl.X0.R9),
                    ZZ: "px",
                    kx: 90,
                    fS: 1
                })).addEvents({
                    wd: function() {
                        this.sH(mi.md.cv(mi.Pc.PrizeOutcome[mi.Jc + ".Scatter"].wB))
                    }
                }),
                Rg = (new o3((new gS({
                    WP: 4000
                })).addEvents({
                    wd: function() {
                        mi.gR.aE(iJ("Game.capFreeSpin")).Z3(1)
                    },
                    Vz: function() {
                        mi.gR.Z3(0)
                    }
                }), function() {
                    return mi.Pc.FreeSpinOutcome.IncrementTriggered == "true" && mi.Pc.FreeSpinOutcome.MaxAwarded == "true"
                })),
                zU = this.zU = new SV().addEvents({
                    Vz: function() {
                        Cj(gQ("Game.winPaid", TR(ru())), "#fff")
                    },
                    wd: function() {
                        Zh.rQ.Dz("QX")
                    }
                }),
                t0 = this.t0 = mi.zU.vP(),
                lr = this.lr = mi.t0.yA().addEvents({
                    Vz: function() {
                        mi.t0.Rt(mi.Pc.PrizeOutcome["Game.Total"])
                    }
                }),
                S9 = this.S9 = new o3(new Bp(mi.zU, new gS({
                    WP: 7000
                })).addEvents({
                    wd: jU.cR == "OZ" ? function() {
                        mi.Gv.rS(TR(mi.Pc.PrizeOutcome["Game.Total"])).Z3(1);
                        mi.t0.Rt(mi.Pc.PrizeOutcome["Game.Total"])
                    } : function() {
                        mi.Gv.rS(TR(mi.Pc.PrizeOutcome["Game.Total"])).Z3(1);
                        mi.t0.Rt(0);
                        mi.t0.kd(mi.Pc.PrizeOutcome["Game.Total"], mi.Pc.PatternSliderInput.BetPerPattern * mi.Pc.PatternSliderInput.PatternsBet);
                        mi.lr.tl()
                    }
                }), function() {
                    return mi.Pc.AwardCapOutcome.AwardCapExceeded != "true" && mi.Pc.OutcomeDetail.Payout >= mi.Pc.OutcomeDetail.Settled * 10 && mi.Pc.OutcomeDetail.Settled > 0 && mi.Jc === "BaseGame"
                }),
                fD = new o3((new tn(new o3(new gS({
                    WP: 1200
                }), function() {
                    return (mi.Pc.OutcomeDetail.NextStage == "BaseGame" && mi.Pc.OutcomeDetail.Stage == "FreeSpin")
                }), mi.S9, Ty, mi.YA, this.XR.yA(), this.Mb.yA().addEvents({
                    wd: function() {
                        if (mi.Pc.PrizeOutcome["Game.Total"] && mi.Jc == "BaseGame") {
                            Cj(gQ("Game.winPaid", TR(mi.Pc.PrizeOutcome["Game.Total"])), "#fff")
                        }
                    }
                }))).addEvents({
                    wd: function() {
                        mi.Km.Z3(1)
                    },
                    Wp: function() {
                        mi.Km.Z3(0);
                        mi.YA.fireEvent("Hb");
                        if (mi.Jc == "BaseGame") {
                            Zh.rQ.IG()
                        }
                    },
                    Vz: function() {
                        mi.Km.Z3(0)
                    }
                }), function() {
                    return mi.Pc.AwardCapOutcome.AwardCapExceeded == "false" && ru()
                }),
                nO = new o3((mi.gR.iu("pc")).addEvents({
                    wd: function() {
                        mi.gR.aE(gQ("Game.capAward", K9(mi.Pc.PrizeOutcome["Game.Total"]))).oa("e2", new C6({
                            pR: iJ("Game.buttonOk"),
                            Xw: 1
                        })).Z3(1)
                    }
                }), function() {
                    return mi.Pc.AwardCapOutcome.AwardCapExceeded == "true"
                }),
                iq = (new Bp(fD, new gS({
                    WP: 1000
                }))).addEvents({
                    wd: function() {
                        mi.XR.kd(mi.Pc.PrizeOutcome["FreeSpin.Total"] + mi.Pc.PrizeOutcome["BaseGame.Scatter"]["@totalPay"], mi.Pc.PatternSliderInput.BetPerPattern * mi.Pc.PatternSliderInput.PatternsBet)
                    },
                    Vz: function() {
                        var EW = mi.Pc.PrizeOutcome["FreeSpin.Total"];
                        if (mi.Pc.AwardCapOutcome.AwardCapExceeded != "true") {
                            EW += mi.Pc.PrizeOutcome["BaseGame.Scatter"]["@totalPay"]
                        }
                        mi.XR.Rt(EW)
                    }
                }),
                pg = (new gS({
                    WP: 2000
                })).addEvents({
                    Vz: function(self) {
                        mi.md.toElement().removeClass("mW");
                        mi.md.Ne(mi.Pc.PopulationOutcome[mi.Pc.OutcomeDetail.NextStage + ".Reels"].TM, mi.Pc.OutcomeDetail.NextStage);
                        mi.g6.Rt(mi.Pc.FreeSpinOutcome.Count);
                        mi.F8.Rt(mi.Pc.FreeSpinOutcome.TotalAwarded);
                        mi.XR.Rt(mi.Pc.PrizeOutcome["BaseGame.Scatter"]["@totalPay"]);
                        document.body.toggleClass("hN");
                        document.body.toggleClass("Wq");
                        document.body.offsetWidth;
                        mi.Jc = mi.Pc.OutcomeDetail.NextStage;
                        mi.Jh.TG().removeClass("rC");
                        mi.Jh.EN("color", "#fff").aE(iJ("Game.playingBonusReels"))
                    },
                    wd: function() {
                        if (mi.Pc.OutcomeDetail.NextStage == "BaseGame" && mi.Pc.OutcomeDetail.Stage == "FreeSpin") {
                            Zh.rQ.IG()
                        } else {}
                    }
                });
            var DP = new Elements([new Element("div", {
                id: "bu"
            }), new Element("div", {
                id: "xA"
            })]);
            var qf = (new Element("div", {
                id: "T7",
            })).adopt(DP).I7({
                visibility: "hidden",
                transform: Sl.iN.gX(0.01, 0.01)
            }).inject(this.md);
            var bM = qf.iu("transitionend").addEvents({
                wd: function() {
                    qf.EN("transform", Sl.iN.gX(1, 1))
                }
            });
            var z3 = qf.iu("transitionend").addEvents({
                wd: function() {
                    qf.EN("opacity", 0)
                },
                Vz: function() {
                    qf.I7({
                        visibility: "hidden",
                        transform: Sl.iN.gX(0.01, 0.01),
                        opacity: 1,
                        transition: ""
                    })
                }
            });
            var wW = new o3(new tn(wm, bM, new gS({
                WP: 1800
            }).addEvents({
                Vz: function() {
                    mi.F8.Rt(mi.Pc.FreeSpinOutcome.TotalAwarded)
                }
            }), z3).addEvents({
                wd: function() {
                    qf.I7({
                        visibility: "visible",
                        transition: "-webkit-transform 1s ease-out, opacity 0.7s ease-in"
                    });
                    DP.set("html", gQ("Game.bonusRetrigger", "<em>" + mi.Pc.FreeSpinOutcome.Awarded + "</em>"))
                }
            }), function() {
                return mi.Pc.FreeSpinOutcome.IncrementTriggered == "true" && mi.Pc.FreeSpinOutcome.MaxAwarded == "false"
            });
            this.vd = (new tn(nO, fD)).addEvents({
                wd: function() {
                    mi.Mb.kd(mi.Pc.OutcomeDetail.Balance, mi.Pc.PatternSliderInput.BetPerPattern * mi.Pc.PatternSliderInput.PatternsBet);
                    var hk = mi.Jc == "BaseGame" ? mi.Pc.PrizeOutcome["Game.Total"] : ru(),
                        oM = mi.Pc.AwardCapOutcome.AwardCapExceeded != "true" && mi.Pc.OutcomeDetail.Payout >= mi.Pc.OutcomeDetail.Settled * 10 && mi.Pc.OutcomeDetail.Settled > 0 && mi.Jc === "BaseGame",
                        ug, Qh, hH = mi.Pc.PrizeOutcome["BaseGame.Lines"]["Prize"];
                    Cj(gQ(hk ? oM ? "Game.bigWinStatus" : "Game.winPaid" : "Game.gameOver", TR(hk)), "#fff");
                    if (!oM && hk && hH.length) {
                        Zh.rQ.Dz((hH.length > 1) ? "uC" : "pP")
                    } else {
                        Zh.rQ.IG()
                    }
                    if (hk && !oM) {
                        mi.Gv.rS(TR(hk)).Z3(1)
                    }
                },
                Vz: function() {
                    var hk = mi.Jc == "BaseGame" ? mi.Pc.PrizeOutcome["Game.Total"] : ru();
                    Cj(gQ(hk ? "Game.winPaid" : "Game.gameOver", TR(hk)), "#fff");
                    mi.Mb.Rt(mi.Pc.OutcomeDetail.Balance);
                    mi.Km.Z3(0);
                    mi.zB()
                }
            });
            this.iq = (new tn(Rg, wW, iq)).addEvents({
                wd: function() {
                    if (mi.Pc.AwardCapOutcome.AwardCapExceeded == "false") {
                        ru() && Cj(gQ("Game.bonusWinPaid", TR(ru())), "#fff")
                    }
                },
                Vz: function() {
                    mi.GZ()
                }
            });
            this.Km.addEvent("GL", function() {
                fD.bT()
            });
            this.xB = new tn(wm).addEvents({
                wd: function() {
                    mi.md.toElement().addClass("mW");
                    mi.fv.Z3(1);
                    Cj(iJ("Game.freeSpinPrompt"));
                    mi.Jh.TG().addClass("rC");
                    mi.Jh.EN("color", "")
                }
            }).jy({
                fS: Infinity
            });
            this.fv.addEvents({
                GL: function() {
                    mi.fv.Z3(0);
                    mi.xB.bT();
                    mi.vG()
                }
            });
            this.gJ = function() {
                mi.Pc.OutcomeDetail.Stage == "BaseGame" ? mi.A4.tl() : sI.call(this)
            };
            var Ee = new Elements([new Element("div", {
                id: "t3"
            }), new Element("div", {
                id: "bg"
            }), new Element("div", {
                id: "Kw"
            })]);
            var dF = (new Element("div", {
                id: "D4"
            })).adopt(new Element("div", {
                id: "LZ"
            }), new Element("div", {
                id: "CZ"
            }), new Element("div", {
                id: "xN"
            }), new Element("div", {
                id: "Sg"
            }), (new Element("div", {
                id: "GX"
            })).adopt(Ee)).I7({
                visibility: "hidden",
                transform: Sl.iN.gX(0.01, 0.01)
            });
            this.HB.adopt(dF);
            var wj = dF.iu("transitionend").addEvents({
                wd: function() {
                    dF.EN("transform", Sl.iN.gX(1, 1))
                }
            });
            var nJ = dF.iu("transitionend").addEvents({
                wd: function() {
                    dF.EN("opacity", 0)
                },
                Vz: function() {
                    dF.I7({
                        visibility: "hidden",
                        transform: Sl.iN.gX(0.01, 0.01),
                        opacity: 1,
                        transition: ""
                    })
                }
            });
            this.A4 = (new tn(wj, pg, nJ)).addEvents({
                wd: function() {
                    Ee.set("html", gQ("Game.bonusWelcome", "<em>" + mi.Pc.FreeSpinOutcome.Awarded + "</em>"));
                    dF.I7({
                        visibility: "visible",
                        transition: "-webkit-transform 1s ease-out, opacity 0.7s ease-in"
                    })
                },
                Vz: function() {
                    mi.GZ()
                }
            });
            this.TY = (new tn(iq, wj, pg, nJ, this.vd).addEvents({
                wd: function() {
                    if (mi.Pc.AwardCapOutcome.AwardCapExceeded == "false") {
                        ru() && Cj(gQ("Game.bonusWinPaid", TR(ru())), "#fff")
                    }
                    var EW = mi.Pc.PrizeOutcome["FreeSpin.Total"];
                    if (mi.Pc.AwardCapOutcome.AwardCapExceeded != "true") {
                        EW += mi.Pc.PrizeOutcome["BaseGame.Scatter"]["@totalPay"]
                    }
                    Ee.set("html", gQ("Game.bonusTotal", "<em>", TR(EW), "</em>"));
                    dF.I7({
                        visibility: "visible",
                        transition: "-webkit-transform 1s ease-out, opacity 0.7s ease-in"
                    })
                }
            }))
        },
        tQ: function(Fa) {
            this.wE.Ep(1).aE(iJ("Game.mboxHowToPlay")[Fa])
        },
        Qv: (function() {
            var Vv, G9 = C8.Cs,
                ag = Zz.BZ(Zz.Ev(xl.XC.concat(["fsw01", "fsb01"]).uR(), function(pY, Iw) {
                    return '<img class="' + Iw + '"/>'
                })),
                j8 = function(Fa) {
                    var UT = Elements.c1(iJ("Game.mboxPaytable")[Fa].substitute(ag)),
                        QL = (new Element("div")).adopt(UT),
                        Z9 = QL.querySelector("winlinediagrams");
                    Z9 && Z9.adopt(xl.X2.map(function(Gx, m5) {
                        return Gx.TM && this.AA(11, 11, Gx, m5)
                    }, this.V7));
                    Vv[Fa] = QL.getChildren()
                };
            return function(Fa) {
                var mi, zM;
                if (Vv) {
                    Vv[Fa] || j8.call(this, Fa);
                    this.gn.Ep(1).aE(Vv[Fa])
                } else {
                    this.wC(function(jN) {
                        Vv = [];
                        Zz.BZ(this.LJ, jN.Paytable);
                        this.LJ.PaytableStatistics.toString = function() {
                            return iJ(this["@minRTP"] == this["@maxRTP"] ? "Paytable.RTPvalue" : "Paytable.RTPrange", this).substitute(this)
                        };
                        ag.RTP = this.LJ.PaytableStatistics;
                        ag.awardCap = K9(L5.cF(G9.wP(jN.Paytable.AwardCapInfo)));
                        return this.Qv(Fa)
                    }.bind(this))
                }
            }
        })(),
        rD: function(gz) {
            Zz.ZP(gz.PatternSliderInfo, function(lT) {
                lT.Step = Array.FM(lT.Step)
            });
            this.LJ = gz;
            this.km = {};
            gz.StripInfo.forEach(function(cO) {
                this.km[cO["@name"]] = [];
                cO.Strip.forEach(function(jE) {
                    var Wh = jE["#text"].split(",");
                    this.km[cO["@name"]].push(Wh)
                }, this)
            }, this)
        },
        eR: function(jN) {
            jN.PopulationOutcome = C8.Cs.gH(Array.FM(jN.PopulationOutcome).map(function(Jw) {
                Jw.TM = nN(Jw["#text"].split(","));
                delete Jw["#text"];
                return Jw
            }))
        },
        Sx: function(jN) {
            var G9 = C8.Cs;
            jN.PrizeOutcome = G9.gH(Array.FM(jN.PrizeOutcome));
            ["BaseGame.Lines", "FreeSpin.Lines", "BaseGame.Scatter", "FreeSpin.Scatter"].forEach(function(Y8) {
                jN.PrizeOutcome[Y8] = jN.PrizeOutcome[Y8] || {}
            });
            Zz.ZP(jN.PrizeOutcome, function(yu) {
                yu["@totalPay"] = G9.wP(yu["@totalPay"]);
                yu.wB = [];
                yu.Ox = {};
                yu.Prize = Array.FM(yu.Prize).map(function(He) {
                    yu.Ox[He["@name"]] = He.ue = [];
                    He["@totalPay"] = G9.wP(He["@totalPay"]);
                    He.s6 = xl.xX[He["@name"]] || 0;
                    He.Ly = xl.X2[He.s6];
                    return He
                })
            });
            Array.FM(jN.HighlightOutcome).forEach(function(yu) {
                var Bt = jN.PrizeOutcome[yu["@name"]];
                Bt && Array.FM(yu.Highlight).forEach(function(Jt) {
                    var Fu = Bt && Bt.Ox[Jt["@name"]];
                    if (Fu) {
                        [].push.apply(Fu, Jt["#text"].split(",").AM(xl.b3));
                        Bt.wB.combine(Fu)
                    }
                })
            });
            delete jN.HighlightOutcome;
            jN.OutcomeDetail.Balance = G9.wP(jN.OutcomeDetail.Balance);
            jN.OutcomeDetail.Payout = G9.wP(jN.OutcomeDetail.Payout);
            if (jN.FreeSpinOutcome) {
                jN.FreeSpinOutcome.Count = G9.mx(jN.FreeSpinOutcome.Count);
                jN.FreeSpinOutcome.TotalAwarded = G9.mx(jN.FreeSpinOutcome.TotalAwarded)
            }
            if (jN.PrizeOutcome["Game.Total"]) {
                Bt = jN.PrizeOutcome;
                Bt["Game.Total"] = Bt["Game.Total"]["@totalPay"];
                if (Bt["FreeSpin.Total"]) {
                    Bt["FreeSpin.Total"] = jN.AwardCapOutcome && jN.AwardCapOutcome.AwardCapExceeded == "true" ? Bt["Game.Total"] : Bt["FreeSpin.Total"]["@totalPay"]
                }
            }
            this.Jc = jN.OutcomeDetail.Stage;
            return jN
        },
        wQ: function(Cn) {
            this.c3 = jN.PopulationOutcome[this.Jc + ".Reels"].TM;
            this.zp = jN.PrizeOutcome[this.Jc + ".Lines"];
            this.zo = jN.PrizeOutcome[this.Jc + ".Lines"]
        },
        rp: function(fL) {
            var XG = fL && this.Pc.OutcomeDetail.NextStage == "BaseGame";
            XG && this.Mb.Rt(this.Pc.OutcomeDetail.Balance);
            this.wc.fL(XG && 0 < this.Mb.j5());
            this.VN.fL(fL && this.WY() && !this.C0.Bb())
        },
        WY: function() {
            var pT = this.Pc.OutcomeDetail.NextStage != "BaseGame" || 0 <= this.Mb.j5() - this.ji();
            pT || this.gR.aE(iJ("Error.insufficientFunds"));
            this.gR.Z3(!pT);
            return pT
        },
        sN: function() {
            if (this.Pc.OutcomeDetail.NextStage == "BaseGame") {
                this.Jh.EN("color", "#FFF").aE(iJ("Game.goodLuck"));
                this.Mb.Rt(Math.max(0, this.Mb.j5() - this.ji()))
            } else {
                this.Jh.EN("color", "#fff").aE(iJ("Game.playingBonusReels"));
                this.g6.Rt(this.Pc.FreeSpinOutcome.Count + 1)
            }
            this.md.sN()
        },
        hQ: function() {
            this.oC({
                GameLogicRequest: {
                    ActionInput: {
                        Action: "play"
                    },
                    PatternSliderInput: {
                        BetPerPattern: this.C0.j5(),
                        PatternsBet: this.Pc.PatternSliderInput.PatternsBet
                    }
                }
            })
        },
        MU: function() {
            this.eR(this.Pc);
            this.g6.Rt(this.Pc.FreeSpinOutcome.Count);
            this.md.Ka(this.Pc.PopulationOutcome[this.Pc.OutcomeDetail.Stage + ".Reels"].TM)
        },
        ji: function() {
            return this.C0.j5() * this.Pc.PatternSliderInput.PatternsBet
        },
        Sj: function() {
            this.Gv.Z3(0);
            this.BE(0);
            if (!Zh.rQ.Gj("hm")) {
                Zh.rQ.Dz(this.Pc.OutcomeDetail.NextStage == "FreeSpin" ? "hm" : xl.fh.G1(), Infinity)
            }
            setTimeout(this.sN, 0)
        },
        CF: function() {
            this.Mb.Rt(this.Pc.OutcomeDetail.Balance - this.Pc.OutcomeDetail.Payout)
        },
        r2: function() {
            Zh.rQ && Zh.rQ.IG();
            this.wE && this.wE.Z3(0);
            this.gn && this.gn.Z3(0);
            this.Pb && this.Pb.bT()
        },
        zz: function() {
            this.md && this.md.dI();
            this.Pb && this.Pb.bT()
        },
        GZ: function() {
            this.Pc.OutcomeDetail.NextStage == "FreeSpin" ? this.Sj() : this.BE(1)
        },
        Ul: function() {
            this.Mb.Rt(this.Pc.OutcomeDetail.Balance - this.Pc.OutcomeDetail.Payout);
            this.Jh.qd();
            this.C0.Rt(this.Pc.PatternSliderInput.BetPerPattern);
            if (this.Pc.OutcomeDetail.Stage == "BaseGame") {
                if (this.Pc.OutcomeDetail.NextStage == "FreeSpin") {
                    Zh.rQ.Dz(xl.uf.b01);
                    this.xB.tl()
                } else {
                    this.vd.tl()
                }
            } else {
                this.BE(0);
                this.g6.Rt(this.Pc.FreeSpinOutcome.Count);
                this.Pc.OutcomeDetail.NextStage == "BaseGame" ? this.TY.tl() : this.iq.tl()
            }
        }
    })
}());
