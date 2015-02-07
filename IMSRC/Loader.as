//ActionScript 3.0
//  package com
//    package demonsters
//      package debugger
//        class IMonsterDebuggerConnection
package com.demonsters.debugger 
{
    internal interface IMonsterDebuggerConnection
    {
        function processQueue():void;

        function set onConnect(arg1:Function):void;

        function set address(arg1:String):void;

        function get connected():Boolean;

        function connect():void;

        function send(arg1:String, arg2:Object, arg3:Boolean=false):void;
    }
}


//        class MonsterDebugger
package com.demonsters.debugger 
{
    import flash.display.*;
    
    public class MonsterDebugger extends Object
    {
        public function MonsterDebugger()
        {
            super();
            return;
        }

        public static function get enabled():Boolean
        {
            return _enabled;
        }

        public static function trace(arg1:*, arg2:*, arg3:String="", arg4:String="", arg5:uint=0, arg6:int=5):void
        {
            if (_initialized && _enabled) 
            {
                MonsterDebuggerCore.trace(arg1, arg2, arg3, arg4, arg5, arg6);
            }
            return;
        }

        static function send(arg1:String, arg2:Object):void
        {
            if (_initialized && _enabled) 
            {
                MonsterDebuggerConnection.send(arg1, arg2, false);
            }
            return;
        }

        public static function log(... rest):void
        {
            var loc1:*=null;
            var loc2:*=0;
            if (_initialized && _enabled) 
            {
                loc1 = [];
                loc2 = 0;
                while (loc2 < rest.length) 
                {
                    loc1[loc1.length] = String(rest[loc2]);
                    ++loc2;
                }
                MonsterDebuggerCore.trace("log", loc1.join(", "), "", "", 0, 5);
            }
            return;
        }

        public static function clear():void
        {
            if (_initialized && _enabled) 
            {
                MonsterDebuggerCore.clear();
            }
            return;
        }

        public static function unregisterPlugin(arg1:String):void
        {
            if (_initialized) 
            {
                MonsterDebuggerCore.unregisterPlugin(arg1);
            }
            return;
        }

        public static function set enabled(arg1:Boolean):void
        {
            _enabled = arg1;
            return;
        }

        public static function snapshot(arg1:*, arg2:flash.display.DisplayObject, arg3:String="", arg4:String=""):void
        {
            if (_initialized && _enabled) 
            {
                MonsterDebuggerCore.snapshot(arg1, arg2, arg3, arg4);
            }
            return;
        }

        public static function inspect(arg1:*):void
        {
            if (_initialized && _enabled) 
            {
                MonsterDebuggerCore.inspect(arg1);
            }
            return;
        }

        public static function registerPlugin(arg1:Class):void
        {
            var loc1:*=null;
            if (_initialized) 
            {
                loc1 = new arg1();
                MonsterDebuggerCore.registerPlugin(loc1.id, loc1);
            }
            return;
        }

        public static function hasPlugin(arg1:String):Boolean
        {
            if (_initialized) 
            {
                return MonsterDebuggerCore.hasPlugin(arg1);
            }
            return false;
        }

        public static function breakpoint(arg1:*, arg2:String="breakpoint"):void
        {
            if (_initialized && _enabled) 
            {
                MonsterDebuggerCore.breakpoint(arg1, arg2);
            }
            return;
        }

        public static function initialize(arg1:Object, arg2:String="127.0.0.1", arg3:Function=null):void
        {
            if (!_initialized) 
            {
                _initialized = true;
                MonsterDebuggerCore.base = arg1;
                MonsterDebuggerCore.initialize();
                MonsterDebuggerConnection.initialize();
                MonsterDebuggerConnection.address = arg2;
                MonsterDebuggerConnection.onConnect = arg3;
                MonsterDebuggerConnection.connect();
            }
            return;
        }

        
        {
            _enabled = true;
            _initialized = false;
        }

        static const VERSION:Number=3;

        internal static var _enabled:Boolean=true;

        internal static var _initialized:Boolean=false;

        public static var logger:Function;
    }
}


//        class MonsterDebuggerConnection
package com.demonsters.debugger 
{
    internal class MonsterDebuggerConnection extends Object
    {
        public function MonsterDebuggerConnection()
        {
            super();
            return;
        }

        static function initialize():void
        {
            connector = new MonsterDebuggerConnectionDefault();
            return;
        }

        static function processQueue():void
        {
            connector.processQueue();
            return;
        }

        static function set onConnect(arg1:Function):void
        {
            connector.onConnect = arg1;
            return;
        }

        static function set address(arg1:String):void
        {
            connector.address = arg1;
            return;
        }

        static function get connected():Boolean
        {
            return connector.connected;
        }

        static function connect():void
        {
            connector.connect();
            return;
        }

        static function send(arg1:String, arg2:Object, arg3:Boolean=false):void
        {
            connector.send(arg1, arg2, arg3);
            return;
        }

        internal static var connector:IMonsterDebuggerConnection;
    }
}


//        class MonsterDebuggerConnectionDefault
package com.demonsters.debugger 
{
    import flash.events.*;
    import flash.net.*;
    import flash.system.*;
    import flash.utils.*;
    
    internal class MonsterDebuggerConnectionDefault extends Object implements com.demonsters.debugger.IMonsterDebuggerConnection
    {
        public function MonsterDebuggerConnectionDefault()
        {
            _queue = [];
            super();
            _socket = new flash.net.Socket();
            _socket.addEventListener(flash.events.Event.CONNECT, connectHandler, false, 0, false);
            _socket.addEventListener(flash.events.Event.CLOSE, closeHandler, false, 0, false);
            _socket.addEventListener(flash.events.IOErrorEvent.IO_ERROR, closeHandler, false, 0, false);
            _socket.addEventListener(flash.events.SecurityErrorEvent.SECURITY_ERROR, closeHandler, false, 0, false);
            _socket.addEventListener(flash.events.ProgressEvent.SOCKET_DATA, dataHandler, false, 0, false);
            _connecting = false;
            _process = false;
            _address = "127.0.0.1";
            _port = 5800;
            _timeout = new flash.utils.Timer(2000, 1);
            _timeout.addEventListener(flash.events.TimerEvent.TIMER, closeHandler, false, 0, false);
            _retry = new flash.utils.Timer(1000, 1);
            _retry.addEventListener(flash.events.TimerEvent.TIMER, retryHandler, false, 0, false);
            return;
        }

        internal function dataHandler(arg1:flash.events.ProgressEvent):void
        {
            _bytes = new flash.utils.ByteArray();
            _socket.readBytes(_bytes, 0, _socket.bytesAvailable);
            _bytes.position = 0;
            processPackage();
            return;
        }

        public function send(arg1:String, arg2:Object, arg3:Boolean=false):void
        {
            var loc1:*=null;
            if (arg3 && arg1 == MonsterDebuggerCore.ID && _socket.connected) 
            {
                loc1 = new com.demonsters.debugger.MonsterDebuggerData(arg1, arg2).bytes;
                _socket.writeUnsignedInt(loc1.length);
                _socket.writeBytes(loc1);
                _socket.flush();
                return;
            }
            _queue.push(new com.demonsters.debugger.MonsterDebuggerData(arg1, arg2));
            if (_queue.length > MAX_QUEUE_LENGTH) 
            {
                _queue.shift();
            }
            if (_queue.length > 0) 
            {
                next();
            }
            return;
        }

        public function get connected():Boolean
        {
            if (_socket == null) 
            {
                return false;
            }
            return _socket.connected;
        }

        internal function next():void
        {
            if (!com.demonsters.debugger.MonsterDebugger.enabled) 
            {
                return;
            }
            if (!_process) 
            {
                return;
            }
            if (!_socket.connected) 
            {
                connect();
                return;
            }
            var loc1:*=com.demonsters.debugger.MonsterDebuggerData(_queue.shift()).bytes;
            _socket.writeUnsignedInt(loc1.length);
            _socket.writeBytes(loc1);
            _socket.flush();
            loc1 = null;
            if (_queue.length > 0) 
            {
                next();
            }
            return;
        }

        internal function retryHandler(arg1:flash.events.TimerEvent):void
        {
            _retry.stop();
            connect();
            return;
        }

        public function set onConnect(arg1:Function):void
        {
            _onConnect = arg1;
            return;
        }

        internal function processPackage():void
        {
            var loc1:*=0;
            var loc2:*=null;
            if (_bytes.bytesAvailable == 0) 
            {
                return;
            }
            if (_length == 0) 
            {
                _length = _bytes.readUnsignedInt();
                _package = new flash.utils.ByteArray();
            }
            if (_package.length < _length && _bytes.bytesAvailable > 0) 
            {
                loc1 = _bytes.bytesAvailable;
                if (loc1 > _length - _package.length) 
                {
                    loc1 = _length - _package.length;
                }
                _bytes.readBytes(_package, _package.length, loc1);
            }
            if (!(_length == 0) && _package.length == _length) 
            {
                loc2 = com.demonsters.debugger.MonsterDebuggerData.read(_package);
                if (loc2.id != null) 
                {
                    MonsterDebuggerCore.handle(loc2);
                }
                _length = 0;
                _package = null;
            }
            if (_length == 0 && _bytes.bytesAvailable > 0) 
            {
                processPackage();
            }
            return;
        }

        public function set address(arg1:String):void
        {
            _address = arg1;
            return;
        }

        internal function connectHandler(arg1:flash.events.Event):void
        {
            _timeout.stop();
            _retry.stop();
            if (_onConnect != null) 
            {
                _onConnect();
            }
            _connecting = false;
            _bytes = new flash.utils.ByteArray();
            _package = new flash.utils.ByteArray();
            _length = 0;
            _socket.writeUTFBytes("<hello/>" + "\n");
            _socket.writeByte(0);
            _socket.flush();
            return;
        }

        public function processQueue():void
        {
            if (!_process) 
            {
                _process = true;
                if (_queue.length > 0) 
                {
                    next();
                }
            }
            return;
        }

        internal function closeHandler(arg1:flash.events.Event=null):void
        {
            MonsterDebuggerUtils.resume();
            if (!_retry.running) 
            {
                _connecting = false;
                _process = false;
                _timeout.stop();
                _retry.reset();
                _retry.start();
            }
            return;
        }

        public function connect():void
        {
            var loc1:*;
            if (!_connecting && com.demonsters.debugger.MonsterDebugger.enabled) 
            {
                try 
                {
                    flash.system.Security.loadPolicyFile("xmlsocket://" + _address + ":" + _port);
                    _connecting = true;
                    _socket.connect(_address, _port);
                    _retry.stop();
                    _timeout.reset();
                    _timeout.start();
                }
                catch (e:Error)
                {
                    closeHandler();
                }
            }
            return;
        }

        internal const MAX_QUEUE_LENGTH:int=500;

        internal var _length:uint;

        internal var _package:flash.utils.ByteArray;

        internal var _onConnect:Function;

        internal var _queue:Array;

        internal var _connecting:Boolean;

        internal var _socket:flash.net.Socket;

        internal var _timeout:flash.utils.Timer;

        internal var _port:int;

        internal var _retry:flash.utils.Timer;

        internal var _bytes:flash.utils.ByteArray;

        internal var _process:Boolean;

        internal var _address:String;
    }
}


//        class MonsterDebuggerConstants
package com.demonsters.debugger 
{
    internal class MonsterDebuggerConstants extends Object
    {
        public function MonsterDebuggerConstants()
        {
            super();
            return;
        }

        static const ICON_DISPLAY_OBJECT:String="iconDisplayObject";

        static const TYPE_BOOLEAN:String="Boolean";

        static const TYPE_XMLLIST:String="XMLList";

        static const COMMAND_TRACE:String="TRACE";

        static const TYPE_VECTOR:String="Vector";

        static const TYPE_NOT_FOUND:String="Not found";

        static const ACCESS_METHOD:String="method";

        static const TYPE_XMLVALUE:String="XMLValue";

        static const COMMAND_NOTFOUND:String="NOTFOUND";

        static const COMMAND_MONITOR:String="MONITOR";

        static const COMMAND_STOP_HIGHLIGHT:String="STOP_HIGHLIGHT";

        static const ACCESS_CONSTANT:String="constant";

        static const TYPE_FUNCTION:String="Function";

        static const TYPE_UINT:String="uint";

        static const COMMAND_INFO:String="INFO";

        static const TYPE_INT:String="int";

        static const TYPE_XMLATTRIBUTE:String="XMLAttribute";

        static const COMMAND_SNAPSHOT:String="SNAPSHOT";

        static const ICON_DEFAULT:String="iconDefault";

        static const ICON_VARIABLE_READONLY:String="iconVariableReadonly";

        static const COMMAND_BASE:String="BASE";

        static const ICON_XMLATTRIBUTE:String="iconXMLAttribute";

        static const COMMAND_GET_PROPERTIES:String="GET_PROPERTIES";

        static const TYPE_XML:String="XML";

        static const TYPE_BYTEARRAY:String="ByteArray";

        static const TYPE_XMLNODE:String="XMLNode";

        static const ICON_VARIABLE_WRITEONLY:String="iconVariableWriteonly";

        static const TYPE_WARNING:String="Warning";

        static const PERMISSION_READWRITE:String="readwrite";

        static const PERMISSION_WRITEONLY:String="writeonly";

        static const COMMAND_HIGHLIGHT:String="HIGHLIGHT";

        static const TYPE_VOID:String="void";

        static const ICON_VARIABLE:String="iconVariable";

        static const TYPE_METHOD:String="MethodClosure";

        static const COMMAND_GET_PREVIEW:String="GET_PREVIEW";

        static const COMMAND_GET_FUNCTIONS:String="GET_FUNCTIONS";

        static const COMMAND_HELLO:String="HELLO";

        static const TYPE_UNREADABLE:String="Unreadable";

        static const PERMISSION_READONLY:String="readonly";

        static const ICON_XMLNODE:String="iconXMLNode";

        static const COMMAND_CLEAR_TRACES:String="CLEAR_TRACES";

        static const TYPE_STRING:String="String";

        static const ACCESS_DISPLAY_OBJECT:String="displayObject";

        static const COMMAND_RESUME:String="RESUME";

        static const COMMAND_PAUSE:String="PAUSE";

        static const COMMAND_START_HIGHLIGHT:String="START_HIGHLIGHT";

        static const ICON_WARNING:String="iconWarning";

        static const COMMAND_SET_PROPERTY:String="SET_PROPERTY";

        static const ICON_XMLVALUE:String="iconXMLValue";

        static const ACCESS_ACCESSOR:String="accessor";

        static const COMMAND_CALL_METHOD:String="CALL_METHOD";

        static const COMMAND_SAMPLES:String="SAMPLES";

        static const ICON_FUNCTION:String="iconFunction";

        static const COMMAND_INSPECT:String="INSPECT";

        static const TYPE_OBJECT:String="Object";

        static const TYPE_NUMBER:String="Number";

        static const ICON_ROOT:String="iconRoot";

        static const TYPE_ARRAY:String="Array";

        static const ACCESS_VARIABLE:String="variable";

        static const COMMAND_GET_OBJECT:String="GET_OBJECT";

        static const DELIMITER:String=".";
    }
}


//        class MonsterDebuggerCore
package com.demonsters.debugger 
{
    import flash.display.*;
    import flash.events.*;
    import flash.external.*;
    import flash.geom.*;
    import flash.system.*;
    import flash.text.*;
    import flash.utils.*;
    
    internal class MonsterDebuggerCore extends Object
    {
        public function MonsterDebuggerCore()
        {
            super();
            return;
        }

        static function clear():void
        {
            if (com.demonsters.debugger.MonsterDebugger.enabled) 
            {
                send({"command":MonsterDebuggerConstants.COMMAND_CLEAR_TRACES});
            }
            return;
        }

        static function sendInformation():void
        {
            var tmpTitle:String;
            var isFlex:Boolean;
            var slash:int;
            var ns:Namespace;
            var filename:String;
            var FileClass:*;
            var fileLocation:String;
            var NativeApplicationClass:*;
            var data:Object;
            var isDebugger:Boolean;
            var tmpLocation:String;
            var descriptor:XML;
            var UIComponentClass:*;
            var playerVersion:String;
            var playerType:String;
            var fileTitle:String;

            var loc1:*;
            UIComponentClass = undefined;
            tmpLocation = null;
            tmpTitle = null;
            NativeApplicationClass = undefined;
            descriptor = null;
            ns = null;
            filename = null;
            FileClass = undefined;
            slash = 0;
            playerType = flash.system.Capabilities.playerType;
            playerVersion = flash.system.Capabilities.version;
            isDebugger = flash.system.Capabilities.isDebugger;
            isFlex = false;
            fileTitle = "";
            fileLocation = "";
            try 
            {
                UIComponentClass = flash.utils.getDefinitionByName("mx.core::UIComponent");
                if (UIComponentClass != null) 
                {
                    isFlex = true;
                }
            }
            catch (e1:Error)
            {
            };
            if (_base is flash.display.DisplayObject && _base.hasOwnProperty("loaderInfo")) 
            {
                if (flash.display.DisplayObject(_base).loaderInfo != null) 
                {
                    fileLocation = unescape(flash.display.DisplayObject(_base).loaderInfo.url);
                }
            }
            if (_base.hasOwnProperty("stage")) 
            {
                if (!(_base["stage"] == null) && _base["stage"] is flash.display.Stage) 
                {
                    fileLocation = unescape(flash.display.Stage(_base["stage"]).loaderInfo.url);
                }
            }
            if (playerType == "ActiveX" || playerType == "PlugIn") 
            {
                if (flash.external.ExternalInterface.available) 
                {
                    try 
                    {
                        tmpLocation = flash.external.ExternalInterface.call("window.location.href.toString");
                        tmpTitle = flash.external.ExternalInterface.call("window.document.title.toString");
                        if (tmpLocation != null) 
                        {
                            fileLocation = tmpLocation;
                        }
                        if (tmpTitle != null) 
                        {
                            fileTitle = tmpTitle;
                        }
                    }
                    catch (e2:Error)
                    {
                    };
                }
            }
            if (playerType == "Desktop") 
            {
                try 
                {
                    NativeApplicationClass = flash.utils.getDefinitionByName("flash.desktop::NativeApplication");
                    if (NativeApplicationClass != null) 
                    {
                        descriptor = NativeApplicationClass["nativeApplication"]["applicationDescriptor"];
                        ns = descriptor.namespace();
                        filename = descriptor.ns::filename;
                        FileClass = flash.utils.getDefinitionByName("flash.filesystem::File");
                        if (flash.system.Capabilities.os.toLowerCase().indexOf("windows") == -1) 
                        {
                            if (flash.system.Capabilities.os.toLowerCase().indexOf("mac") != -1) 
                            {
                                filename = filename + ".app";
                                fileLocation = (loc2 = FileClass["applicationDirectory"])["resolvePath"](filename)["nativePath"];
                            }
                        }
                        else 
                        {
                            filename = filename + ".exe";
                            fileLocation = (loc2 = FileClass["applicationDirectory"])["resolvePath"](filename)["nativePath"];
                        }
                    }
                }
                catch (e3:Error)
                {
                };
            }
            if (fileTitle == "" && !(fileLocation == "")) 
            {
                slash = Math.max(fileLocation.lastIndexOf("\\"), fileLocation.lastIndexOf("/"));
                if (slash == -1) 
                {
                    fileTitle = fileLocation;
                }
                else 
                {
                    fileTitle = fileLocation.substring(slash + 1, fileLocation.lastIndexOf("."));
                }
            }
            data = {"command":MonsterDebuggerConstants.COMMAND_INFO, "debuggerVersion":com.demonsters.debugger.MonsterDebugger.VERSION, "playerType":playerType, "playerVersion":playerVersion, "isDebugger":isDebugger, "isFlex":isFlex, "fileLocation":fileLocation, "fileTitle":fileTitle};
            send(data, true);
            MonsterDebuggerConnection.processQueue();
            return;
        }

        internal static function handleInternal(arg1:com.demonsters.debugger.MonsterDebuggerData):void
        {
            var method:Function;
            var displayObject:flash.display.DisplayObject;
            var bytes:flash.utils.ByteArray;
            var item:com.demonsters.debugger.MonsterDebuggerData;
            var xml:XML;
            var bitmapData:flash.display.BitmapData;
            var obj:*;

            var loc1:*;
            obj = undefined;
            xml = null;
            method = null;
            displayObject = null;
            bitmapData = null;
            bytes = null;
            item = arg1;
            var loc2:*=item.data["command"];
            switch (loc2) 
            {
                case MonsterDebuggerConstants.COMMAND_HELLO:
                {
                    sendInformation();
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_BASE:
                {
                    obj = MonsterDebuggerUtils.getObject(_base, "", 0);
                    if (obj != null) 
                    {
                        xml = XML(MonsterDebuggerUtils.parse(obj, "", 1, 2, true));
                        send({"command":MonsterDebuggerConstants.COMMAND_BASE, "xml":xml});
                    }
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_INSPECT:
                {
                    obj = MonsterDebuggerUtils.getObject(_base, item.data["target"], 0);
                    if (obj != null) 
                    {
                        _base = obj;
                        xml = XML(MonsterDebuggerUtils.parse(obj, "", 1, 2, true));
                        send({"command":MonsterDebuggerConstants.COMMAND_BASE, "xml":xml});
                    }
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_GET_OBJECT:
                {
                    obj = MonsterDebuggerUtils.getObject(_base, item.data["target"], 0);
                    if (obj != null) 
                    {
                        xml = XML(MonsterDebuggerUtils.parse(obj, item.data["target"], 1, 2, true));
                        send({"command":MonsterDebuggerConstants.COMMAND_GET_OBJECT, "xml":xml});
                    }
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_GET_PROPERTIES:
                {
                    obj = MonsterDebuggerUtils.getObject(_base, item.data["target"], 0);
                    if (obj != null) 
                    {
                        xml = XML(MonsterDebuggerUtils.parse(obj, item.data["target"], 1, 1, false));
                        send({"command":MonsterDebuggerConstants.COMMAND_GET_PROPERTIES, "xml":xml});
                    }
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_GET_FUNCTIONS:
                {
                    obj = MonsterDebuggerUtils.getObject(_base, item.data["target"], 0);
                    if (obj != null) 
                    {
                        xml = XML(MonsterDebuggerUtils.parseFunctions(obj, item.data["target"]));
                        send({"command":MonsterDebuggerConstants.COMMAND_GET_FUNCTIONS, "xml":xml});
                    }
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_SET_PROPERTY:
                {
                    obj = MonsterDebuggerUtils.getObject(_base, item.data["target"], 1);
                    if (obj != null) 
                    {
                        try 
                        {
                            obj[item.data["name"]] = item.data["value"];
                            send({"command":MonsterDebuggerConstants.COMMAND_SET_PROPERTY, "target":item.data["target"], "value":obj[item.data["name"]]});
                        }
                        catch (e1:Error)
                        {
                        };
                    }
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_GET_PREVIEW:
                {
                    obj = MonsterDebuggerUtils.getObject(_base, item.data["target"], 0);
                    if (!(obj == null) && MonsterDebuggerUtils.isDisplayObject(obj)) 
                    {
                        displayObject = obj as flash.display.DisplayObject;
                        bitmapData = MonsterDebuggerUtils.snapshot(displayObject, new flash.geom.Rectangle(0, 0, 300, 300));
                        if (bitmapData != null) 
                        {
                            bytes = bitmapData.getPixels(new flash.geom.Rectangle(0, 0, bitmapData.width, bitmapData.height));
                            send({"command":MonsterDebuggerConstants.COMMAND_GET_PREVIEW, "bytes":bytes, "width":bitmapData.width, "height":bitmapData.height});
                        }
                    }
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_CALL_METHOD:
                {
                    method = MonsterDebuggerUtils.getObject(_base, item.data["target"], 0);
                    if (!(method == null) && method is Function) 
                    {
                        if (item.data["returnType"] != MonsterDebuggerConstants.TYPE_VOID) 
                        {
                            try 
                            {
                                obj = method.apply(null, item.data["arguments"]);
                                xml = XML(MonsterDebuggerUtils.parse(obj, "", 1, 5, false));
                                send({"command":MonsterDebuggerConstants.COMMAND_CALL_METHOD, "id":item.data["id"], "xml":xml});
                            }
                            catch (e2:Error)
                            {
                            };
                        }
                        else 
                        {
                            method.apply(null, item.data["arguments"]);
                        }
                    }
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_PAUSE:
                {
                    MonsterDebuggerUtils.pause();
                    send({"command":MonsterDebuggerConstants.COMMAND_PAUSE});
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_RESUME:
                {
                    MonsterDebuggerUtils.resume();
                    send({"command":MonsterDebuggerConstants.COMMAND_RESUME});
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_HIGHLIGHT:
                {
                    obj = MonsterDebuggerUtils.getObject(_base, item.data["target"], 0);
                    if (!(obj == null) && MonsterDebuggerUtils.isDisplayObject(obj)) 
                    {
                        if (!(flash.display.DisplayObject(obj).stage == null) && flash.display.DisplayObject(obj).stage is flash.display.Stage) 
                        {
                            _stage = obj["stage"];
                        }
                        if (_stage != null) 
                        {
                            highlightClear();
                            send({"command":MonsterDebuggerConstants.COMMAND_STOP_HIGHLIGHT});
                            _highlight.removeEventListener(flash.events.MouseEvent.CLICK, highlightClicked);
                            _highlight.mouseEnabled = false;
                            _highlightTarget = flash.display.DisplayObject(obj);
                            _highlightMouse = false;
                            _highlightUpdate = true;
                        }
                    }
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_START_HIGHLIGHT:
                {
                    highlightClear();
                    _highlight.addEventListener(flash.events.MouseEvent.CLICK, highlightClicked, false, 0, true);
                    _highlight.mouseEnabled = true;
                    _highlightTarget = null;
                    _highlightMouse = true;
                    _highlightUpdate = true;
                    send({"command":MonsterDebuggerConstants.COMMAND_START_HIGHLIGHT});
                    break;
                }
                case MonsterDebuggerConstants.COMMAND_STOP_HIGHLIGHT:
                {
                    highlightClear();
                    _highlight.removeEventListener(flash.events.MouseEvent.CLICK, highlightClicked);
                    _highlight.mouseEnabled = false;
                    _highlightTarget = null;
                    _highlightMouse = false;
                    _highlightUpdate = false;
                    send({"command":MonsterDebuggerConstants.COMMAND_STOP_HIGHLIGHT});
                    break;
                }
            }
            return;
        }

        static function get base():*
        {
            return _base;
        }

        internal static function highlightClicked(arg1:flash.events.MouseEvent):void
        {
            arg1.preventDefault();
            arg1.stopImmediatePropagation();
            highlightClear();
            _highlightTarget = MonsterDebuggerUtils.getObjectUnderPoint(_stage, new flash.geom.Point(_stage.mouseX, _stage.mouseY));
            _highlightMouse = false;
            _highlight.removeEventListener(flash.events.MouseEvent.CLICK, highlightClicked);
            _highlight.mouseEnabled = false;
            if (_highlightTarget != null) 
            {
                inspect(_highlightTarget);
                highlightDraw(false);
            }
            send({"command":MonsterDebuggerConstants.COMMAND_STOP_HIGHLIGHT});
            return;
        }

        static function unregisterPlugin(arg1:String):void
        {
            if (arg1 in _plugins) 
            {
                _plugins[arg1] = null;
            }
            return;
        }

        static function hasPlugin(arg1:String):Boolean
        {
            return arg1 in _plugins;
        }

        static function initialize():void
        {
            _monitorTime = new Date().time;
            _monitorStart = new Date().time;
            _monitorFrames = 0;
            _monitorTimer = new flash.utils.Timer(MONITOR_UPDATE);
            _monitorTimer.addEventListener(flash.events.TimerEvent.TIMER, monitorTimerCallback, false, 0, true);
            _monitorTimer.start();
            if (_base.hasOwnProperty("stage") && !(_base["stage"] == null) && _base["stage"] is flash.display.Stage) 
            {
                _stage = _base["stage"] as flash.display.Stage;
            }
            _monitorSprite = new flash.display.Sprite();
            _monitorSprite.addEventListener(flash.events.Event.ENTER_FRAME, frameHandler, false, 0, true);
            var loc1:*=new flash.text.TextFormat();
            loc1.font = "Arial";
            loc1.color = 16777215;
            loc1.size = 11;
            loc1.leftMargin = 5;
            loc1.rightMargin = 5;
            _highlightInfo = new flash.text.TextField();
            _highlightInfo.embedFonts = false;
            _highlightInfo.autoSize = flash.text.TextFieldAutoSize.LEFT;
            _highlightInfo.mouseWheelEnabled = false;
            _highlightInfo.mouseEnabled = false;
            _highlightInfo.condenseWhite = false;
            _highlightInfo.embedFonts = false;
            _highlightInfo.multiline = false;
            _highlightInfo.selectable = false;
            _highlightInfo.wordWrap = false;
            _highlightInfo.defaultTextFormat = loc1;
            _highlightInfo.text = "";
            _highlight = new flash.display.Sprite();
            _highlightMouse = false;
            _highlightTarget = null;
            _highlightUpdate = false;
            return;
        }

        internal static function highlightDraw(arg1:Boolean):void
        {
            var boundsInner:flash.geom.Rectangle;
            var fill:Boolean;
            var boundsOuter:flash.geom.Rectangle;
            var boundsText:flash.geom.Rectangle;

            var loc1:*;
            fill = arg1;
            if (_highlightTarget == null) 
            {
                return;
            }
            boundsOuter = _highlightTarget.getBounds(_stage);
            if (_highlightTarget is flash.display.Stage) 
            {
                boundsOuter.x = 0;
                boundsOuter.y = 0;
                boundsOuter.width = _highlightTarget["stageWidth"];
                boundsOuter.height = _highlightTarget["stageHeight"];
            }
            else 
            {
                boundsOuter.x = int(boundsOuter.x + 0.5);
                boundsOuter.y = int(boundsOuter.y + 0.5);
                boundsOuter.width = int(boundsOuter.width + 0.5);
                boundsOuter.height = int(boundsOuter.height + 0.5);
            }
            boundsInner = boundsOuter.clone();
            boundsInner.x = boundsInner.x + 2;
            boundsInner.y = boundsInner.y + 2;
            boundsInner.width = boundsInner.width - 4;
            boundsInner.height = boundsInner.height - 4;
            if (boundsInner.width < 0) 
            {
                boundsInner.width = 0;
            }
            if (boundsInner.height < 0) 
            {
                boundsInner.height = 0;
            }
            _highlight.graphics.clear();
            _highlight.graphics.beginFill(HIGHLITE_COLOR, 1);
            _highlight.graphics.drawRect(boundsOuter.x, boundsOuter.y, boundsOuter.width, boundsOuter.height);
            _highlight.graphics.drawRect(boundsInner.x, boundsInner.y, boundsInner.width, boundsInner.height);
            if (fill) 
            {
                _highlight.graphics.beginFill(HIGHLITE_COLOR, 0.25);
                _highlight.graphics.drawRect(boundsInner.x, boundsInner.y, boundsInner.width, boundsInner.height);
            }
            if (_highlightTarget.name == null) 
            {
                _highlightInfo.text = String(MonsterDebuggerDescribeType.get(_highlightTarget).@name);
            }
            else 
            {
                _highlightInfo.text = String(_highlightTarget.name) + " - " + String(MonsterDebuggerDescribeType.get(_highlightTarget).@name);
            }
            boundsText = new flash.geom.Rectangle(boundsOuter.x, boundsOuter.y - (_highlightInfo.textHeight + 3), _highlightInfo.textWidth + 15, _highlightInfo.textHeight + 5);
            if (boundsText.y < 0) 
            {
                boundsText.y = boundsOuter.y + boundsOuter.height;
            }
            if (boundsText.y + boundsText.height > _stage.stageHeight) 
            {
                boundsText.y = _stage.stageHeight - boundsText.height;
            }
            if (boundsText.x < 0) 
            {
                boundsText.x = 0;
            }
            if (boundsText.x + boundsText.width > _stage.stageWidth) 
            {
                boundsText.x = _stage.stageWidth - boundsText.width;
            }
            _highlight.graphics.beginFill(HIGHLITE_COLOR, 1);
            _highlight.graphics.drawRect(boundsText.x, boundsText.y, boundsText.width, boundsText.height);
            _highlight.graphics.endFill();
            _highlightInfo.x = boundsText.x;
            _highlightInfo.y = boundsText.y;
            try 
            {
                _stage.addChild(_highlight);
                _stage.addChild(_highlightInfo);
            }
            catch (e:Error)
            {
            };
            return;
        }

        static function inspect(arg1:*):void
        {
            var loc1:*=undefined;
            var loc2:*=null;
            if (com.demonsters.debugger.MonsterDebugger.enabled) 
            {
                _base = arg1;
                loc1 = MonsterDebuggerUtils.getObject(_base, "", 0);
                if (loc1 != null) 
                {
                    loc2 = XML(MonsterDebuggerUtils.parse(loc1, "", 1, 2, true));
                    send({"command":MonsterDebuggerConstants.COMMAND_BASE, "xml":loc2});
                }
            }
            return;
        }

        internal static function frameHandler(arg1:flash.events.Event):void
        {
            if (com.demonsters.debugger.MonsterDebugger.enabled) 
            {
                var loc1:*;
                _monitorFrames++;
                if (_highlightUpdate) 
                {
                    highlightUpdate();
                }
            }
            return;
        }

        internal static function send(arg1:Object, arg2:Boolean=false):void
        {
            if (com.demonsters.debugger.MonsterDebugger.enabled) 
            {
                MonsterDebuggerConnection.send(MonsterDebuggerCore.ID, arg1, arg2);
            }
            return;
        }

        internal static function monitorTimerCallback(arg1:flash.events.TimerEvent):void
        {
            var loc1:*=NaN;
            var loc2:*=NaN;
            var loc3:*=0;
            var loc4:*=0;
            var loc5:*=null;
            if (com.demonsters.debugger.MonsterDebugger.enabled) 
            {
                loc1 = new Date().time;
                loc2 = loc1 - _monitorTime;
                loc3 = _monitorFrames / loc2 * 1000;
                loc4 = 0;
                if (_stage == null) 
                {
                    if (_base.hasOwnProperty("stage") && !(_base["stage"] == null) && _base["stage"] is flash.display.Stage) 
                    {
                        _stage = flash.display.Stage(_base["stage"]);
                    }
                }
                if (_stage != null) 
                {
                    loc4 = _stage.frameRate;
                }
                _monitorFrames = 0;
                _monitorTime = loc1;
                if (MonsterDebuggerConnection.connected) 
                {
                    loc5 = {"command":MonsterDebuggerConstants.COMMAND_MONITOR, "memory":MonsterDebuggerUtils.getMemory(), "fps":loc3, "fpsMovie":loc4, "time":loc1};
                    send(loc5);
                }
            }
            return;
        }

        internal static function highlightUpdate():void
        {
            var loc1:*=undefined;
            highlightClear();
            if (_highlightMouse) 
            {
                if (_base.hasOwnProperty("stage") && !(_base["stage"] == null) && _base["stage"] is flash.display.Stage) 
                {
                    _stage = _base["stage"] as flash.display.Stage;
                }
                if (flash.system.Capabilities.playerType == "Desktop") 
                {
                    loc1 = flash.utils.getDefinitionByName("flash.desktop::NativeApplication");
                    if (!(loc1 == null) && !(loc1["nativeApplication"]["activeWindow"] == null)) 
                    {
                        _stage = loc1["nativeApplication"]["activeWindow"]["stage"];
                    }
                }
                if (_stage == null) 
                {
                    _highlight.removeEventListener(flash.events.MouseEvent.CLICK, highlightClicked);
                    _highlight.mouseEnabled = false;
                    _highlightTarget = null;
                    _highlightMouse = false;
                    _highlightUpdate = false;
                    return;
                }
                _highlightTarget = MonsterDebuggerUtils.getObjectUnderPoint(_stage, new flash.geom.Point(_stage.mouseX, _stage.mouseY));
                if (_highlightTarget != null) 
                {
                    highlightDraw(true);
                }
                return;
            }
            if (_highlightTarget != null) 
            {
                if (_highlightTarget.stage == null || _highlightTarget.parent == null) 
                {
                    _highlight.removeEventListener(flash.events.MouseEvent.CLICK, highlightClicked);
                    _highlight.mouseEnabled = false;
                    _highlightTarget = null;
                    _highlightMouse = false;
                    _highlightUpdate = false;
                    return;
                }
                highlightDraw(false);
            }
            return;
        }

        static function breakpoint(arg1:*, arg2:String="breakpoint"):void
        {
            var loc1:*=null;
            var loc2:*=null;
            if (com.demonsters.debugger.MonsterDebugger.enabled && MonsterDebuggerConnection.connected) 
            {
                loc1 = MonsterDebuggerUtils.stackTrace();
                loc2 = {"command":MonsterDebuggerConstants.COMMAND_PAUSE, "memory":MonsterDebuggerUtils.getMemory(), "date":new Date(), "target":String(arg1), "reference":MonsterDebuggerUtils.getReferenceID(arg1), "stack":loc1, "id":arg2};
                send(loc2);
                MonsterDebuggerUtils.pause();
            }
            return;
        }

        static function set base(arg1:*):void
        {
            _base = arg1;
            return;
        }

        internal static function highlightClear():void
        {
            if (!(_highlight == null) && !(_highlight.parent == null)) 
            {
                _highlight.parent.removeChild(_highlight);
                _highlight.graphics.clear();
                _highlight.x = 0;
                _highlight.y = 0;
            }
            if (!(_highlightInfo == null) && !(_highlightInfo.parent == null)) 
            {
                _highlightInfo.parent.removeChild(_highlightInfo);
                _highlightInfo.x = 0;
                _highlightInfo.y = 0;
            }
            return;
        }

        static function handle(arg1:com.demonsters.debugger.MonsterDebuggerData):void
        {
            if (com.demonsters.debugger.MonsterDebugger.enabled) 
            {
                if (arg1.id == null || arg1.id == "") 
                {
                    return;
                }
                if (arg1.id != MonsterDebuggerCore.ID) 
                {
                    if (arg1.id in _plugins && !(_plugins[arg1.id] == null)) 
                    {
                        com.demonsters.debugger.MonsterDebuggerPlugin(_plugins[arg1.id]).handle(arg1);
                    }
                }
                else 
                {
                    handleInternal(arg1);
                }
            }
            return;
        }

        
        {
            _base = null;
            _stage = null;
            _plugins = {};
        }

        static function registerPlugin(arg1:String, arg2:com.demonsters.debugger.MonsterDebuggerPlugin):void
        {
            if (arg1 in _plugins) 
            {
                return;
            }
            _plugins[arg1] = arg2;
            return;
        }

        static function snapshot(arg1:*, arg2:flash.display.DisplayObject, arg3:String="", arg4:String=""):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            if (com.demonsters.debugger.MonsterDebugger.enabled) 
            {
                if ((loc1 = MonsterDebuggerUtils.snapshot(arg2)) != null) 
                {
                    loc2 = loc1.getPixels(new flash.geom.Rectangle(0, 0, loc1.width, loc1.height));
                    loc3 = {"command":MonsterDebuggerConstants.COMMAND_SNAPSHOT, "memory":MonsterDebuggerUtils.getMemory(), "date":new Date(), "target":String(arg1), "reference":MonsterDebuggerUtils.getReferenceID(arg1), "bytes":loc2, "width":arg2.width, "height":arg2.height, "person":arg3, "label":arg4};
                    send(loc3);
                }
            }
            return;
        }

        static function trace(arg1:*, arg2:*, arg3:String="", arg4:String="", arg5:uint=0, arg6:int=5):void
        {
            var loc1:*=null;
            var loc2:*=null;
            if (com.demonsters.debugger.MonsterDebugger.enabled) 
            {
                loc1 = XML(MonsterDebuggerUtils.parse(arg2, "", 1, arg6, false));
                loc2 = {"command":MonsterDebuggerConstants.COMMAND_TRACE, "memory":MonsterDebuggerUtils.getMemory(), "date":new Date(), "target":String(arg1), "reference":MonsterDebuggerUtils.getReferenceID(arg1), "xml":loc1, "person":arg3, "label":arg4, "color":arg5};
                send(loc2);
            }
            return;
        }

        internal static const HIGHLITE_COLOR:uint=3381759;

        static const ID:String="com.demonsters.debugger.core";

        internal static const MONITOR_UPDATE:int=500;

        internal static var _highlightInfo:flash.text.TextField;

        internal static var _monitorStart:Number;

        internal static var _monitorTime:Number;

        internal static var _monitorFrames:int;

        internal static var _highlightTarget:flash.display.DisplayObject;

        internal static var _monitorTimer:flash.utils.Timer;

        internal static var _monitorSprite:flash.display.Sprite;

        internal static var _highlightMouse:Boolean;

        internal static var _highlight:flash.display.Sprite;

        internal static var _highlightUpdate:Boolean;

        internal static var _plugins:Object;

        internal static var _stage:flash.display.Stage=null;

        internal static var _base:Object=null;
    }
}


//        class MonsterDebuggerData
package com.demonsters.debugger 
{
    import flash.utils.*;
    
    public class MonsterDebuggerData extends Object
    {
        public function MonsterDebuggerData(arg1:String, arg2:Object)
        {
            super();
            _id = arg1;
            _data = arg2;
            return;
        }

        public function get data():Object
        {
            return _data;
        }

        public function set bytes(arg1:flash.utils.ByteArray):void
        {
            var value:flash.utils.ByteArray;
            var bytesData:flash.utils.ByteArray;
            var bytesId:flash.utils.ByteArray;

            var loc1:*;
            value = arg1;
            bytesId = new flash.utils.ByteArray();
            bytesData = new flash.utils.ByteArray();
            try 
            {
                value.readBytes(bytesId, 0, value.readUnsignedInt());
                value.readBytes(bytesData, 0, value.readUnsignedInt());
                _id = bytesId.readObject() as String;
                _data = bytesData.readObject() as Object;
            }
            catch (e:Error)
            {
                _id = null;
                _data = null;
            }
            bytesId = null;
            bytesData = null;
            return;
        }

        public function get id():String
        {
            return _id;
        }

        public function get bytes():flash.utils.ByteArray
        {
            var loc1:*=new flash.utils.ByteArray();
            var loc2:*=new flash.utils.ByteArray();
            loc1.writeObject(_id);
            loc2.writeObject(_data);
            var loc3:*=new flash.utils.ByteArray();
            loc3.writeUnsignedInt(loc1.length);
            loc3.writeBytes(loc1);
            loc3.writeUnsignedInt(loc2.length);
            loc3.writeBytes(loc2);
            loc3.position = 0;
            loc1 = null;
            loc2 = null;
            return loc3;
        }

        public static function read(arg1:flash.utils.ByteArray):com.demonsters.debugger.MonsterDebuggerData
        {
            var loc1:*=new MonsterDebuggerData(null, null);
            loc1.bytes = arg1;
            return loc1;
        }

        internal var _data:Object;

        internal var _id:String;
    }
}


//        class MonsterDebuggerDescribeType
package com.demonsters.debugger 
{
    import flash.utils.*;
    
    internal class MonsterDebuggerDescribeType extends Object
    {
        public function MonsterDebuggerDescribeType()
        {
            super();
            return;
        }

        static function get(arg1:*):XML
        {
            var loc1:*=flash.utils.getQualifiedClassName(arg1);
            if (loc1 in cache) 
            {
                return cache[loc1];
            }
            var loc2:*=flash.utils.describeType(arg1);
            cache[loc1] = loc2;
            return loc2;
        }

        
        {
            cache = {};
        }

        internal static var cache:Object;
    }
}


//        class MonsterDebuggerPlugin
package com.demonsters.debugger 
{
    public class MonsterDebuggerPlugin extends Object
    {
        public function MonsterDebuggerPlugin(arg1:String)
        {
            super();
            _id = arg1;
            return;
        }

        protected function send(arg1:Object):void
        {
            com.demonsters.debugger.MonsterDebugger.send(_id, arg1);
            return;
        }

        public function get id():String
        {
            return _id;
        }

        public function handle(arg1:com.demonsters.debugger.MonsterDebuggerData):void
        {
            return;
        }

        internal var _id:String;
    }
}


//        class MonsterDebuggerUtils
package com.demonsters.debugger 
{
    import flash.display.*;
    import flash.geom.*;
    import flash.system.*;
    import flash.utils.*;
    
    internal class MonsterDebuggerUtils extends Object
    {
        public function MonsterDebuggerUtils()
        {
            super();
            return;
        }

        public static function snapshot(arg1:flash.display.DisplayObject, arg2:flash.geom.Rectangle=null):flash.display.BitmapData
        {
            var bitmapData:flash.display.BitmapData;
            var rotation:Number;
            var scaleX:Number;
            var scaleY:Number;
            var scaled:flash.geom.Rectangle;
            var b:flash.display.BitmapData;
            var alpha:Number;
            var m:flash.geom.Matrix;
            var rectangle:flash.geom.Rectangle=null;
            var s:Number;
            var bounds:flash.geom.Rectangle;
            var visible:Boolean;
            var object:flash.display.DisplayObject;

            var loc1:*;
            m = null;
            scaled = null;
            s = NaN;
            b = null;
            object = arg1;
            rectangle = arg2;
            if (object == null) 
            {
                return null;
            }
            visible = object.visible;
            alpha = object.alpha;
            rotation = object.rotation;
            scaleX = object.scaleX;
            scaleY = object.scaleY;
            try 
            {
                object.visible = true;
                object.alpha = 1;
                object.rotation = 0;
                object.scaleX = 1;
                object.scaleY = 1;
            }
            catch (e1:Error)
            {
            };
            bounds = object.getBounds(object);
            bounds.x = int(bounds.x + 0.5);
            bounds.y = int(bounds.y + 0.5);
            bounds.width = int(bounds.width + 0.5);
            bounds.height = int(bounds.height + 0.5);
            if (object is flash.display.Stage) 
            {
                bounds.x = 0;
                bounds.y = 0;
                bounds.width = flash.display.Stage(object).stageWidth;
                bounds.height = flash.display.Stage(object).stageHeight;
            }
            bitmapData = null;
            if (bounds.width <= 0 || bounds.height <= 0) 
            {
                return null;
            }
            bitmapData = new flash.display.BitmapData(bounds.width, bounds.height, false, 16777215);
            m = new flash.geom.Matrix();
            m.tx = -bounds.x;
            m.ty = -bounds.y;
            bitmapData.draw(object, m, null, null, null, false);
            try 
            {
                object.visible = visible;
                object.alpha = alpha;
                object.rotation = rotation;
                object.scaleX = scaleX;
                object.scaleY = scaleY;
            }
            catch (e2:Error)
            {
            };
            if (rectangle != null) 
            {
                if (bounds.width <= rectangle.width && bounds.height <= rectangle.height) 
                {
                    return bitmapData;
                }
                scaled = bounds.clone();
                scaled.width = rectangle.width;
                scaled.height = rectangle.width * bounds.height / bounds.width;
                if (scaled.height > rectangle.height) 
                {
                    scaled = bounds.clone();
                    scaled.width = rectangle.height * bounds.width / bounds.height;
                    scaled.height = rectangle.height;
                }
                s = scaled.width / bounds.width;
                b = new flash.display.BitmapData(scaled.width, scaled.height, false, 0);
                m = new flash.geom.Matrix();
                m.scale(s, s);
                b.draw(bitmapData, m, null, null, null, true);
                return b;
            }
            return bitmapData;
        }

        internal static function parseClass(arg1:*, arg2:String, arg3:XML, arg4:int=1, arg5:int=5, arg6:Boolean=true):XML
        {
            var displayObjects:Array;
            var itemXML:XML;
            var accessors:XMLList;
            var target:String;
            var accessorsLength:int;
            var item:*;
            var constantsLength:int;
            var isXMLString:XML;
            var itemTarget:String;
            var displayObject:flash.display.DisplayObjectContainer;
            var child:flash.display.DisplayObject;
            var isXML:Boolean;
            var childLength:int;
            var itemIcon:String;
            var nodeXML:XML;
            var includeDisplayObjects:Boolean=true;
            var isDynamic:Boolean;
            var variablesLength:int;
            var maxDepth:int=5;
            var itemPermission:String;
            var itemName:String;
            var itemsArrayLength:int;
            var currentDepth:int=1;
            var object:*;
            var constants:XMLList;
            var rootXML:XML;
            var itemAccess:String;
            var key:String;
            var prop:*;
            var i:int;
            var itemType:String;
            var variables:XMLList;
            var itemsArray:Array;
            var keys:Object;
            var description:XML;

            var loc1:*;
            key = null;
            itemsArrayLength = 0;
            item = undefined;
            itemXML = null;
            itemAccess = null;
            itemPermission = null;
            itemIcon = null;
            itemType = null;
            itemName = null;
            itemTarget = null;
            isXMLString = null;
            i = 0;
            prop = undefined;
            displayObject = null;
            displayObjects = null;
            child = null;
            object = arg1;
            target = arg2;
            description = arg3;
            currentDepth = arg4;
            maxDepth = arg5;
            includeDisplayObjects = arg6;
            rootXML = new XML("<root/>");
            nodeXML = new XML("<node/>");
            variables = description;
            accessors = description;
            constants = description;
            isDynamic = description.@isDynamic;
            variablesLength = variables.length();
            accessorsLength = accessors.length();
            constantsLength = constants.length();
            childLength = 0;
            keys = {};
            itemsArray = [];
            isXML = false;
            if (isDynamic) 
            {
                var loc2:*=0;
                var loc3:*=object;
                for (prop in loc3) 
                {
                    key = String(prop);
                    if (keys.hasOwnProperty(key)) 
                    {
                        continue;
                    }
                    keys[key] = key;
                    itemName = key;
                    itemType = parseType(flash.utils.getQualifiedClassName(object[key]));
                    itemTarget = target + "." + key;
                    itemAccess = MonsterDebuggerConstants.ACCESS_VARIABLE;
                    itemPermission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                    itemIcon = MonsterDebuggerConstants.ICON_VARIABLE;
                    itemsArray[itemsArray.length] = {"name":itemName, "type":itemType, "target":itemTarget, "access":itemAccess, "permission":itemPermission, "icon":itemIcon};
                }
            }
            i = 0;
            while (i < variablesLength) 
            {
                key = variables[i].@name;
                if (!keys.hasOwnProperty(key)) 
                {
                    keys[key] = key;
                    itemName = key;
                    itemType = parseType(variables[i].@type);
                    itemTarget = target + "." + key;
                    itemAccess = MonsterDebuggerConstants.ACCESS_VARIABLE;
                    itemPermission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                    itemIcon = MonsterDebuggerConstants.ICON_VARIABLE;
                    itemsArray[itemsArray.length] = {"name":itemName, "type":itemType, "target":itemTarget, "access":itemAccess, "permission":itemPermission, "icon":itemIcon};
                }
                ++i;
            }
            i = 0;
            while (i < accessorsLength) 
            {
                key = accessors[i].@name;
                if (!keys.hasOwnProperty(key)) 
                {
                    keys[key] = key;
                    itemName = key;
                    itemType = parseType(accessors[i].@type);
                    itemTarget = target + "." + key;
                    itemAccess = MonsterDebuggerConstants.ACCESS_ACCESSOR;
                    itemPermission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                    itemIcon = MonsterDebuggerConstants.ICON_VARIABLE;
                    if (accessors[i].@access == MonsterDebuggerConstants.PERMISSION_READONLY) 
                    {
                        itemPermission = MonsterDebuggerConstants.PERMISSION_READONLY;
                        itemIcon = MonsterDebuggerConstants.ICON_VARIABLE_READONLY;
                    }
                    if (accessors[i].@access == MonsterDebuggerConstants.PERMISSION_WRITEONLY) 
                    {
                        itemPermission = MonsterDebuggerConstants.PERMISSION_WRITEONLY;
                        itemIcon = MonsterDebuggerConstants.ICON_VARIABLE_WRITEONLY;
                    }
                    itemsArray[itemsArray.length] = {"name":itemName, "type":itemType, "target":itemTarget, "access":itemAccess, "permission":itemPermission, "icon":itemIcon};
                }
                ++i;
            }
            i = 0;
            while (i < constantsLength) 
            {
                key = constants[i].@name;
                if (!keys.hasOwnProperty(key)) 
                {
                    keys[key] = key;
                    itemName = key;
                    itemType = parseType(constants[i].@type);
                    itemTarget = target + "." + key;
                    itemAccess = MonsterDebuggerConstants.ACCESS_CONSTANT;
                    itemPermission = MonsterDebuggerConstants.PERMISSION_READONLY;
                    itemIcon = MonsterDebuggerConstants.ICON_VARIABLE_READONLY;
                    itemsArray[itemsArray.length] = {"name":itemName, "type":itemType, "target":itemTarget, "access":itemAccess, "permission":itemPermission, "icon":itemIcon};
                }
                ++i;
            }
            itemsArray.sortOn("name", Array.CASEINSENSITIVE);
            if (includeDisplayObjects && object is flash.display.DisplayObjectContainer) 
            {
                displayObject = flash.display.DisplayObjectContainer(object);
                displayObjects = [];
                childLength = displayObject.numChildren;
                i = 0;
                while (i < childLength) 
                {
                    child = displayObject.getChildAt(i);
                    if (child != null) 
                    {
                        itemXML = MonsterDebuggerDescribeType.get(child);
                        itemType = parseType(itemXML.@name);
                        itemName = "DisplayObject";
                        if (child.name != null) 
                        {
                            itemName = itemName + (" - " + child.name);
                        }
                        itemTarget = target + "." + "getChildAt(" + i + ")";
                        itemAccess = MonsterDebuggerConstants.ACCESS_DISPLAY_OBJECT;
                        itemPermission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                        itemIcon = child is flash.display.DisplayObjectContainer ? MonsterDebuggerConstants.ICON_ROOT : MonsterDebuggerConstants.ICON_DISPLAY_OBJECT;
                        displayObjects[displayObjects.length] = {"name":itemName, "type":itemType, "target":itemTarget, "access":itemAccess, "permission":itemPermission, "icon":itemIcon, "index":i};
                    }
                    ++i;
                }
                displayObjects.sortOn("name", Array.CASEINSENSITIVE);
                itemsArray = displayObjects.concat(itemsArray);
            }
            itemsArrayLength = itemsArray.length;
            i = 0;
            while (i < itemsArrayLength) 
            {
                itemType = itemsArray[i].type;
                itemName = itemsArray[i].name;
                itemTarget = itemsArray[i].target;
                itemPermission = itemsArray[i].permission;
                itemAccess = itemsArray[i].access;
                itemIcon = itemsArray[i].icon;
                try 
                {
                    if (itemAccess != MonsterDebuggerConstants.ACCESS_DISPLAY_OBJECT) 
                    {
                        item = object[itemName];
                    }
                    else 
                    {
                        item = flash.display.DisplayObjectContainer(object).getChildAt(itemsArray[i].index);
                    }
                }
                catch (e:Error)
                {
                    item = null;
                }
                if (!(item == null) && !(itemPermission == MonsterDebuggerConstants.PERMISSION_WRITEONLY)) 
                {
                    if (itemType == MonsterDebuggerConstants.TYPE_STRING || itemType == MonsterDebuggerConstants.TYPE_BOOLEAN || itemType == MonsterDebuggerConstants.TYPE_NUMBER || itemType == MonsterDebuggerConstants.TYPE_INT || itemType == MonsterDebuggerConstants.TYPE_UINT || itemType == MonsterDebuggerConstants.TYPE_FUNCTION) 
                    {
                        isXML = false;
                        isXMLString = new XML();
                        if (itemType == MonsterDebuggerConstants.TYPE_STRING) 
                        {
                            try 
                            {
                                isXMLString = new XML(item);
                                isXML = !isXMLString.hasSimpleContent() && isXMLString.children().length() > 0;
                            }
                            catch (error:TypeError)
                            {
                            };
                        }
                        if (isXML) 
                        {
                            nodeXML = new XML("<node/>");
                            nodeXML.@icon = itemIcon;
                            nodeXML.@label = itemName + " (" + itemType + ")";
                            nodeXML.@name = itemName;
                            nodeXML.@type = itemType;
                            nodeXML.@value = "";
                            nodeXML.@target = itemTarget;
                            nodeXML.@access = itemAccess;
                            nodeXML.@permission = itemPermission;
                            nodeXML.appendChild(parseXML(isXMLString, itemTarget + "." + "children()", currentDepth, maxDepth).children());
                            rootXML.appendChild(nodeXML);
                        }
                        else 
                        {
                            nodeXML = new XML("<node/>");
                            nodeXML.@icon = itemIcon;
                            nodeXML.@label = itemName + " (" + itemType + ") = " + printValue(item, itemType);
                            nodeXML.@name = itemName;
                            nodeXML.@type = itemType;
                            nodeXML.@value = printValue(item, itemType);
                            nodeXML.@target = itemTarget;
                            nodeXML.@access = itemAccess;
                            nodeXML.@permission = itemPermission;
                            rootXML.appendChild(nodeXML);
                        }
                    }
                    else 
                    {
                        nodeXML = new XML("<node/>");
                        nodeXML.@icon = itemIcon;
                        nodeXML.@label = itemName + " (" + itemType + ")";
                        nodeXML.@name = itemName;
                        nodeXML.@type = itemType;
                        nodeXML.@target = itemTarget;
                        nodeXML.@access = itemAccess;
                        nodeXML.@permission = itemPermission;
                        if (!(item == null) && !(itemType == MonsterDebuggerConstants.TYPE_BYTEARRAY)) 
                        {
                            nodeXML.appendChild(parse(item, itemTarget, currentDepth + 1, maxDepth, includeDisplayObjects).children());
                        }
                        rootXML.appendChild(nodeXML);
                    }
                }
                ++i;
            }
            return rootXML;
        }

        internal static function parseArray(arg1:*, arg2:String, arg3:int=1, arg4:int=5, arg5:Boolean=true):XML
        {
            var isNumeric:Boolean;
            var maxDepth:int=5;
            var currentDepth:int=1;
            var childTarget:String;
            var target:String;
            var isXML:Boolean;
            var rootXML:XML;
            var childXML:XML;
            var key:*;
            var i:int;
            var nodeXML:XML;
            var includeDisplayObjects:Boolean=true;
            var keys:Array;
            var childType:String;
            var isXMLString:XML;
            var object:*;

            var loc1:*;
            nodeXML = null;
            childXML = null;
            key = undefined;
            object = arg1;
            target = arg2;
            currentDepth = arg3;
            maxDepth = arg4;
            includeDisplayObjects = arg5;
            rootXML = new XML("<root/>");
            childType = "";
            childTarget = "";
            isXML = false;
            isXMLString = new XML();
            i = 0;
            nodeXML = new XML("<node/>");
            nodeXML.@icon = MonsterDebuggerConstants.ICON_VARIABLE;
            nodeXML.@label = "length" + " (" + MonsterDebuggerConstants.TYPE_UINT + ") = " + object["length"];
            nodeXML.@name = "length";
            nodeXML.@type = MonsterDebuggerConstants.TYPE_UINT;
            nodeXML.@value = object["length"];
            nodeXML.@target = target + "." + "length";
            nodeXML.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
            nodeXML.@permission = MonsterDebuggerConstants.PERMISSION_READONLY;
            keys = [];
            isNumeric = true;
            var loc2:*=0;
            var loc3:*=object;
            for (key in loc3) 
            {
                if (!(key is int)) 
                {
                    isNumeric = false;
                }
                keys.push(key);
            }
            if (isNumeric) 
            {
                keys.sort(Array.NUMERIC);
            }
            else 
            {
                keys.sort(Array.CASEINSENSITIVE);
            }
            i = 0;
            while (i < keys.length) 
            {
                childType = parseType(MonsterDebuggerDescribeType.get(object[keys[i]]).@name);
                childTarget = target + "." + String(keys[i]);
                if (childType == MonsterDebuggerConstants.TYPE_STRING || childType == MonsterDebuggerConstants.TYPE_BOOLEAN || childType == MonsterDebuggerConstants.TYPE_NUMBER || childType == MonsterDebuggerConstants.TYPE_INT || childType == MonsterDebuggerConstants.TYPE_UINT || childType == MonsterDebuggerConstants.TYPE_FUNCTION) 
                {
                    isXML = false;
                    isXMLString = new XML();
                    if (childType == MonsterDebuggerConstants.TYPE_STRING) 
                    {
                        try 
                        {
                            isXMLString = new XML(object[keys[i]]);
                            if (!isXMLString.hasSimpleContent() && isXMLString.children().length() > 0) 
                            {
                                isXML = true;
                            }
                        }
                        catch (error:TypeError)
                        {
                        };
                    }
                    if (isXML) 
                    {
                        childXML = new XML("<node/>");
                        childXML.@icon = MonsterDebuggerConstants.ICON_VARIABLE;
                        childXML.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                        childXML.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                        childXML.@label = "[" + keys[i] + "] (" + childType + ")";
                        childXML.@name = "[" + keys[i] + "]";
                        childXML.@type = childType;
                        childXML.@value = "";
                        childXML.@target = childTarget;
                        childXML.appendChild(parseXML(object[keys[i]], childTarget, currentDepth + 1, maxDepth).children());
                        nodeXML.appendChild(childXML);
                    }
                    else 
                    {
                        childXML = new XML("<node/>");
                        childXML.@icon = MonsterDebuggerConstants.ICON_VARIABLE;
                        childXML.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                        childXML.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                        childXML.@label = "[" + keys[i] + "] (" + childType + ") = " + printValue(object[keys[i]], childType);
                        childXML.@name = "[" + keys[i] + "]";
                        childXML.@type = childType;
                        childXML.@value = printValue(object[keys[i]], childType);
                        childXML.@target = childTarget;
                        nodeXML.appendChild(childXML);
                    }
                }
                else 
                {
                    childXML = new XML("<node/>");
                    childXML.@icon = MonsterDebuggerConstants.ICON_VARIABLE;
                    childXML.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                    childXML.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                    childXML.@label = "[" + keys[i] + "] (" + childType + ")";
                    childXML.@name = "[" + keys[i] + "]";
                    childXML.@type = childType;
                    childXML.@value = "";
                    childXML.@target = childTarget;
                    childXML.appendChild(parse(object[keys[i]], childTarget, currentDepth + 1, maxDepth, includeDisplayObjects).children());
                    nodeXML.appendChild(childXML);
                }
                ++i;
            }
            rootXML.appendChild(nodeXML);
            return rootXML;
        }

        public static function parseFunctions(arg1:*, arg2:String=""):XML
        {
            var description:XML;
            var itemXML:XML;
            var methodsLength:int;
            var returnType:String;
            var itemTarget:String;
            var argsString:String;
            var methodsArr:Array;
            var target:String="";
            var rootXML:XML;
            var args:Array;
            var key:String;
            var optional:Boolean;
            var i:int;
            var itemType:String;
            var n:int;
            var parameters:XMLList;
            var methods:XMLList;
            var parameterXML:XML;
            var methodXML:XML;
            var parametersLength:int;
            var type:String;
            var keys:Object;
            var itemName:String;
            var object:*;

            var loc1:*;
            itemXML = null;
            key = null;
            returnType = null;
            parameters = null;
            parametersLength = 0;
            args = null;
            argsString = null;
            methodXML = null;
            parameterXML = null;
            object = arg1;
            target = arg2;
            rootXML = new XML("<root/>");
            description = MonsterDebuggerDescribeType.get(object);
            type = parseType(description.@name);
            itemType = "";
            itemName = "";
            itemTarget = "";
            keys = {};
            methods = description;
            methodsArr = [];
            methodsLength = methods.length();
            optional = false;
            i = 0;
            n = 0;
            itemXML = new XML("<node/>");
            itemXML.@icon = MonsterDebuggerConstants.ICON_DEFAULT;
            itemXML.@label = "(" + type + ")";
            itemXML.@target = target;
            i = 0;
            while (i < methodsLength) 
            {
                key = methods[i].@name;
                try 
                {
                    if (!keys.hasOwnProperty(key)) 
                    {
                        keys[key] = key;
                        methodsArr[methodsArr.length] = {"name":key, "xml":methods[i], "access":MonsterDebuggerConstants.ACCESS_METHOD};
                    }
                }
                catch (e:Error)
                {
                };
                ++i;
            }
            methodsArr.sortOn("name", Array.CASEINSENSITIVE);
            methodsLength = methodsArr.length;
            i = 0;
            while (i < methodsLength) 
            {
                itemType = MonsterDebuggerConstants.TYPE_FUNCTION;
                itemName = methodsArr[i].xml.@name;
                itemTarget = target + MonsterDebuggerConstants.DELIMITER + itemName;
                returnType = parseType(methodsArr[i].xml.@returnType);
                parameters = methodsArr[i].xml;
                parametersLength = parameters.length();
                args = [];
                argsString = "";
                optional = false;
                n = 0;
                while (n < parametersLength) 
                {
                    if (parameters[n].@optional == "true" && !optional) 
                    {
                        optional = true;
                        args[args.length] = "[";
                    }
                    args[args.length] = parseType(parameters[n].@type);
                    ++n;
                }
                if (optional) 
                {
                    args[args.length] = "]";
                }
                argsString = args.join(", ");
                argsString = argsString.replace("[, ", "[");
                argsString = argsString.replace(", ]", "]");
                methodXML = new XML("<node/>");
                methodXML.@icon = MonsterDebuggerConstants.ICON_FUNCTION;
                methodXML.@type = MonsterDebuggerConstants.TYPE_FUNCTION;
                methodXML.@access = MonsterDebuggerConstants.ACCESS_METHOD;
                methodXML.@label = itemName + "(" + argsString + "):" + returnType;
                methodXML.@name = itemName;
                methodXML.@target = itemTarget;
                methodXML.@args = argsString;
                methodXML.@returnType = returnType;
                n = 0;
                while (n < parametersLength) 
                {
                    parameterXML = new XML("<node/>");
                    parameterXML.@type = parseType(parameters[n].@type);
                    parameterXML.@index = parameters[n].@index;
                    parameterXML.@optional = parameters[n].@optional;
                    methodXML.appendChild(parameterXML);
                    ++n;
                }
                itemXML.appendChild(methodXML);
                ++i;
            }
            rootXML.appendChild(itemXML);
            return rootXML;
        }

        public static function parseXML(arg1:*, arg2:String="", arg3:int=1, arg4:int=-1):XML
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc5:*=null;
            var loc1:*=new XML("<root/>");
            var loc4:*=0;
            if (!(arg4 == -1) && arg3 > arg4) 
            {
                return loc1;
            }
            if (arg2.indexOf("@") == -1) 
            {
                if (arg1.name() != null) 
                {
                    if (arg1.hasSimpleContent()) 
                    {
                        (loc2 = new XML("<node/>")).@icon = MonsterDebuggerConstants.ICON_XMLNODE;
                        loc2.@type = MonsterDebuggerConstants.TYPE_XMLNODE;
                        loc2.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                        loc2.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                        loc2.@label = arg1.name() + " (" + MonsterDebuggerConstants.TYPE_XMLNODE + ")";
                        loc2.@name = arg1.name();
                        loc2.@value = "";
                        loc2.@target = arg2;
                        if (arg1 != "") 
                        {
                            (loc3 = new XML("<node/>")).@icon = MonsterDebuggerConstants.ICON_XMLVALUE;
                            loc3.@type = MonsterDebuggerConstants.TYPE_XMLVALUE;
                            loc3.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                            loc3.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                            loc3.@label = "(" + MonsterDebuggerConstants.TYPE_XMLVALUE + ") = " + printValue(arg1, MonsterDebuggerConstants.TYPE_XMLVALUE);
                            loc3.@name = "";
                            loc3.@value = printValue(arg1, MonsterDebuggerConstants.TYPE_XMLVALUE);
                            loc3.@target = arg2;
                            loc2.appendChild(loc3);
                        }
                        loc4 = 0;
                        while (loc4 < arg1.attributes().length()) 
                        {
                            (loc3 = new XML("<node/>")).@icon = MonsterDebuggerConstants.ICON_XMLATTRIBUTE;
                            loc3.@type = MonsterDebuggerConstants.TYPE_XMLATTRIBUTE;
                            loc3.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                            loc3.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                            loc3.@label = "@" + arg1.attributes()[loc4].name() + " (" + MonsterDebuggerConstants.TYPE_XMLATTRIBUTE + ") = " + arg1.attributes()[loc4];
                            loc3.@name = "";
                            loc3.@value = arg1.attributes()[loc4];
                            loc3.@target = arg2 + "." + "@" + arg1.attributes()[loc4].name();
                            loc2.appendChild(loc3);
                            ++loc4;
                        }
                        loc1.appendChild(loc2);
                    }
                    else 
                    {
                        (loc2 = new XML("<node/>")).@icon = MonsterDebuggerConstants.ICON_XMLNODE;
                        loc2.@type = MonsterDebuggerConstants.TYPE_XMLNODE;
                        loc2.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                        loc2.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                        loc2.@label = arg1.name() + " (" + MonsterDebuggerConstants.TYPE_XMLNODE + ")";
                        loc2.@name = arg1.name();
                        loc2.@value = "";
                        loc2.@target = arg2;
                        loc4 = 0;
                        while (loc4 < arg1.attributes().length()) 
                        {
                            (loc3 = new XML("<node/>")).@icon = MonsterDebuggerConstants.ICON_XMLATTRIBUTE;
                            loc3.@type = MonsterDebuggerConstants.TYPE_XMLATTRIBUTE;
                            loc3.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                            loc3.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                            loc3.@label = "@" + arg1.attributes()[loc4].name() + " (" + MonsterDebuggerConstants.TYPE_XMLATTRIBUTE + ") = " + arg1.attributes()[loc4];
                            loc3.@name = "";
                            loc3.@value = arg1.attributes()[loc4];
                            loc3.@target = arg2 + "." + "@" + arg1.attributes()[loc4].name();
                            loc2.appendChild(loc3);
                            ++loc4;
                        }
                        loc4 = 0;
                        while (loc4 < arg1.children().length()) 
                        {
                            loc5 = arg2 + "." + "children()" + "." + loc4;
                            loc2.appendChild(parseXML(arg1.children()[loc4], loc5, arg3 + 1, arg4).children());
                            ++loc4;
                        }
                        loc1.appendChild(loc2);
                    }
                }
                else 
                {
                    (loc2 = new XML("<node/>")).@icon = MonsterDebuggerConstants.ICON_XMLVALUE;
                    loc2.@type = MonsterDebuggerConstants.TYPE_XMLVALUE;
                    loc2.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                    loc2.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                    loc2.@label = "(" + MonsterDebuggerConstants.TYPE_XMLVALUE + ") = " + printValue(arg1, MonsterDebuggerConstants.TYPE_XMLVALUE);
                    loc2.@name = "";
                    loc2.@value = printValue(arg1, MonsterDebuggerConstants.TYPE_XMLVALUE);
                    loc2.@target = arg2;
                    loc1.appendChild(loc2);
                }
            }
            else 
            {
                (loc2 = new XML("<node/>")).@icon = MonsterDebuggerConstants.ICON_XMLATTRIBUTE;
                loc2.@type = MonsterDebuggerConstants.TYPE_XMLATTRIBUTE;
                loc2.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                loc2.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                loc2.@label = arg1;
                loc2.@name = "";
                loc2.@value = arg1;
                loc2.@target = arg2;
                loc1.appendChild(loc2);
            }
            return loc1;
        }

        public static function resume():Boolean
        {
            var loc1:*;
            try 
            {
                flash.system.System.resume();
                return true;
            }
            catch (e:Error)
            {
            };
            return false;
        }

        public static function getObjectUnderPoint(arg1:flash.display.DisplayObjectContainer, arg2:flash.geom.Point):flash.display.DisplayObject
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc4:*=null;
            if (arg1.areInaccessibleObjectsUnderPoint(arg2)) 
            {
                return arg1;
            }
            loc1 = arg1.getObjectsUnderPoint(arg2);
            loc1.reverse();
            if (loc1 == null || loc1.length == 0) 
            {
                return arg1;
            }
            loc2 = loc1[0];
            loc1.length = 0;
            for (;;) 
            {
                loc1[loc1.length] = loc2;
                if (loc2.parent == null) 
                {
                    break;
                }
                loc2 = loc2.parent;
            }
            loc1.reverse();
            var loc3:*=0;
            while (loc3 < loc1.length) 
            {
                if ((loc4 = loc1[loc3]) is flash.display.DisplayObjectContainer) 
                {
                    loc2 = loc4;
                    if (!flash.display.DisplayObjectContainer(loc4).mouseChildren) 
                    {
                        break;
                    }
                }
                else 
                {
                    break;
                }
                ++loc3;
            }
            return loc2;
        }

        public static function getReferenceID(arg1:*):String
        {
            if (arg1 in _references) 
            {
                return _references[arg1];
            }
            var loc1:*="#" + String(_reference);
            _references[arg1] = loc1;
            var loc2:*;
            _reference++;
            return loc1;
        }

        public static function printValue(arg1:*, arg2:String):String
        {
            if (arg2 == MonsterDebuggerConstants.TYPE_BYTEARRAY) 
            {
                return arg1["length"] + " bytes";
            }
            if (arg1 == null) 
            {
                return "null";
            }
            return String(arg1);
        }

        internal static function parseObject(arg1:*, arg2:String, arg3:int=1, arg4:int=5, arg5:Boolean=true):XML
        {
            var isNumeric:Boolean;
            var maxDepth:int=5;
            var currentDepth:int=1;
            var childTarget:String;
            var target:String;
            var isXML:Boolean;
            var rootXML:XML;
            var childXML:XML;
            var i:int;
            var prop:*;
            var properties:Array;
            var nodeXML:XML;
            var includeDisplayObjects:Boolean=true;
            var childType:String;
            var isXMLString:XML;
            var object:*;

            var loc1:*;
            childXML = null;
            prop = undefined;
            object = arg1;
            target = arg2;
            currentDepth = arg3;
            maxDepth = arg4;
            includeDisplayObjects = arg5;
            rootXML = new XML("<root/>");
            nodeXML = new XML("<node/>");
            childType = "";
            childTarget = "";
            isXML = false;
            isXMLString = new XML();
            i = 0;
            properties = [];
            isNumeric = true;
            var loc2:*=0;
            var loc3:*=object;
            for (prop in loc3) 
            {
                if (!(prop is int)) 
                {
                    isNumeric = false;
                }
                properties.push(prop);
            }
            if (isNumeric) 
            {
                properties.sort(Array.NUMERIC);
            }
            else 
            {
                properties.sort(Array.CASEINSENSITIVE);
            }
            i = 0;
            while (i < properties.length) 
            {
                childType = parseType(MonsterDebuggerDescribeType.get(object[properties[i]]).@name);
                childTarget = target + "." + properties[i];
                if (childType == MonsterDebuggerConstants.TYPE_STRING || childType == MonsterDebuggerConstants.TYPE_BOOLEAN || childType == MonsterDebuggerConstants.TYPE_NUMBER || childType == MonsterDebuggerConstants.TYPE_INT || childType == MonsterDebuggerConstants.TYPE_UINT || childType == MonsterDebuggerConstants.TYPE_FUNCTION) 
                {
                    isXML = false;
                    isXMLString = new XML();
                    if (childType == MonsterDebuggerConstants.TYPE_STRING) 
                    {
                        try 
                        {
                            isXMLString = new XML(object[properties[i]]);
                            if (!isXMLString.hasSimpleContent() && isXMLString.children().length() > 0) 
                            {
                                isXML = true;
                            }
                        }
                        catch (error:TypeError)
                        {
                        };
                    }
                    if (isXML) 
                    {
                        childXML = new XML("<node/>");
                        childXML.@icon = MonsterDebuggerConstants.ICON_VARIABLE;
                        childXML.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                        childXML.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                        childXML.@label = properties[i] + " (" + childType + ")";
                        childXML.@name = properties[i];
                        childXML.@type = childType;
                        childXML.@value = "";
                        childXML.@target = childTarget;
                        childXML.appendChild(parseXML(object[properties[i]], childTarget, currentDepth + 1, maxDepth).children());
                        nodeXML.appendChild(childXML);
                    }
                    else 
                    {
                        childXML = new XML("<node/>");
                        childXML.@icon = MonsterDebuggerConstants.ICON_VARIABLE;
                        childXML.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                        childXML.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                        childXML.@label = properties[i] + " (" + childType + ") = " + printValue(object[properties[i]], childType);
                        childXML.@name = properties[i];
                        childXML.@type = childType;
                        childXML.@value = printValue(object[properties[i]], childType);
                        childXML.@target = childTarget;
                        nodeXML.appendChild(childXML);
                    }
                }
                else 
                {
                    childXML = new XML("<node/>");
                    childXML.@icon = MonsterDebuggerConstants.ICON_VARIABLE;
                    childXML.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                    childXML.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                    childXML.@label = properties[i] + " (" + childType + ")";
                    childXML.@name = properties[i];
                    childXML.@type = childType;
                    childXML.@value = "";
                    childXML.@target = childTarget;
                    childXML.appendChild(parse(object[properties[i]], childTarget, currentDepth + 1, maxDepth, includeDisplayObjects).children());
                    nodeXML.appendChild(childXML);
                }
                ++i;
            }
            rootXML.appendChild(nodeXML.children());
            return rootXML;
        }

        public static function parse(arg1:*, arg2:String="", arg3:int=1, arg4:int=5, arg5:Boolean=true):XML
        {
            var loc3:*=null;
            var loc8:*=0;
            var loc9:*=null;
            var loc1:*=new XML("<root/>");
            var loc2:*=new XML("<node/>");
            var loc4:*=new XML();
            var loc5:*="";
            var loc6:*="";
            var loc7:*=false;
            if (!(arg4 == -1) && arg3 > arg4) 
            {
                return loc1;
            }
            if (arg1 != null) 
            {
                loc4 = MonsterDebuggerDescribeType.get(arg1);
                loc5 = parseType(loc4.@name);
                loc6 = parseType(loc4.@base);
                loc7 = loc4.@isDynamic;
                if (arg1 is Class) 
                {
                    loc2.appendChild(parseClass(arg1, arg2, loc4, arg3, arg4, arg5).children());
                }
                else if (loc5 != MonsterDebuggerConstants.TYPE_XML) 
                {
                    if (loc5 != MonsterDebuggerConstants.TYPE_XMLLIST) 
                    {
                        if (loc5 == MonsterDebuggerConstants.TYPE_STRING || loc5 == MonsterDebuggerConstants.TYPE_BOOLEAN || loc5 == MonsterDebuggerConstants.TYPE_NUMBER || loc5 == MonsterDebuggerConstants.TYPE_INT || loc5 == MonsterDebuggerConstants.TYPE_UINT) 
                        {
                            loc2.appendChild(parseBasics(arg1, arg2, loc5).children());
                        }
                        else if (loc5 == MonsterDebuggerConstants.TYPE_ARRAY || loc5.indexOf(MonsterDebuggerConstants.TYPE_VECTOR) == 0) 
                        {
                            loc2.appendChild(parseArray(arg1, arg2, arg3, arg4).children());
                        }
                        else if (loc5 != MonsterDebuggerConstants.TYPE_OBJECT) 
                        {
                            loc2.appendChild(parseClass(arg1, arg2, loc4, arg3, arg4, arg5).children());
                        }
                        else 
                        {
                            loc2.appendChild(parseObject(arg1, arg2, arg3, arg4, arg5).children());
                        }
                    }
                    else 
                    {
                        (loc3 = new XML("<node/>")).@icon = MonsterDebuggerConstants.ICON_VARIABLE;
                        loc3.@type = MonsterDebuggerConstants.TYPE_UINT;
                        loc3.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                        loc3.@permission = MonsterDebuggerConstants.PERMISSION_READONLY;
                        loc3.@target = arg2 + "." + "length";
                        loc3.@label = "length" + " (" + MonsterDebuggerConstants.TYPE_UINT + ") = " + arg1.length();
                        loc3.@name = "length";
                        loc3.@value = arg1.length();
                        loc8 = 0;
                        while (loc8 < arg1.length()) 
                        {
                            loc3.appendChild(parseXML(arg1[loc8], arg2 + "." + String(loc8) + ".children()", arg3, arg4).children());
                            ++loc8;
                        }
                        loc2.appendChild(loc3);
                    }
                }
                else 
                {
                    loc2.appendChild(parseXML(arg1, arg2 + "." + "children()", arg3, arg4).children());
                }
            }
            else 
            {
                (loc3 = new XML("<node/>")).@icon = MonsterDebuggerConstants.ICON_WARNING;
                loc3.@label = "Null object";
                loc3.@name = "Null object";
                loc3.@type = MonsterDebuggerConstants.TYPE_WARNING;
                loc2.appendChild(loc3);
                loc5 = "null";
            }
            if (arg3 != 1) 
            {
                loc1.appendChild(loc2.children());
            }
            else 
            {
                (loc9 = new XML("<node/>")).@icon = MonsterDebuggerConstants.ICON_ROOT;
                loc9.@label = "(" + loc5 + ")";
                loc9.@type = loc5;
                loc9.@target = arg2;
                loc9.appendChild(loc2.children());
                loc1.appendChild(loc9);
            }
            return loc1;
        }

        public static function parseType(arg1:String):String
        {
            var loc1:*=null;
            var loc2:*=null;
            if (arg1.indexOf("::") != -1) 
            {
                arg1 = arg1.substring(arg1.indexOf("::") + 2, arg1.length);
            }
            if (arg1.indexOf("::") != -1) 
            {
                loc1 = arg1.substring(0, arg1.indexOf("<") + 1);
                loc2 = arg1.substring(arg1.indexOf("::") + 2, arg1.length);
                arg1 = loc1 + loc2;
            }
            arg1 = arg1.replace("()", "");
            arg1 = arg1.replace(MonsterDebuggerConstants.TYPE_METHOD, MonsterDebuggerConstants.TYPE_FUNCTION);
            return arg1;
        }

        public static function getReference(arg1:String):*
        {
            var loc1:*=undefined;
            var loc2:*=null;
            if (arg1.charAt(0) != "#") 
            {
                return null;
            }
            var loc3:*=0;
            var loc4:*=_references;
            for (loc1 in loc4) 
            {
                loc2 = _references[loc1];
                if (loc2 != arg1) 
                {
                    continue;
                }
                return loc1;
            }
            return null;
        }

        public static function pause():Boolean
        {
            var loc1:*;
            try 
            {
                flash.system.System.pause();
                return true;
            }
            catch (e:Error)
            {
            };
            return false;
        }

        public static function getMemory():uint
        {
            return flash.system.System.totalMemory;
        }

        public static function getObject(arg1:*, arg2:String="", arg3:int=0):*
        {
            var i:int;
            var parent:int=0;
            var index:Number;
            var target:String="";
            var base:*;
            var splitted:Array;
            var object:*;

            var loc1:*;
            index = NaN;
            base = arg1;
            target = arg2;
            parent = arg3;
            if (target == null || target == "") 
            {
                return base;
            }
            if (target.charAt(0) == "#") 
            {
                return getReference(target);
            }
            object = base;
            splitted = target.split(MonsterDebuggerConstants.DELIMITER);
            i = 0;
            while (i < splitted.length - parent) 
            {
                if (splitted[i] != "") 
                {
                    try 
                    {
                        if (splitted[i] != "children()") 
                        {
                            if (object is flash.display.DisplayObjectContainer && splitted[i].indexOf("getChildAt(") == 0) 
                            {
                                index = splitted[i].substring(11, splitted[i].indexOf(")", 11));
                                object = flash.display.DisplayObjectContainer(object).getChildAt(index);
                            }
                            else 
                            {
                                object = object[splitted[i]];
                            }
                        }
                        else 
                        {
                            object = object.children();
                        }
                    }
                    catch (e:Error)
                    {
                        break;
                    }
                }
                ++i;
            }
            return object;
        }

        public static function stackTrace():XML
        {
            var classname:String;
            var stack:String;
            var bracketIndex:int;
            var rootXML:XML;
            var childXML:XML;
            var functionXML:XML;
            var method:String;
            var i:int;
            var methodIndex:int;
            var s:String;
            var line:String;
            var file:String;
            var lines:Array;

            var loc1:*;
            childXML = null;
            stack = null;
            lines = null;
            i = 0;
            s = null;
            bracketIndex = 0;
            methodIndex = 0;
            classname = null;
            method = null;
            file = null;
            line = null;
            functionXML = null;
            rootXML = new XML("<root/>");
            childXML = new XML("<node/>");
            try 
            {
                throw new Error();
            }
            catch (e:Error)
            {
                stack = e.getStackTrace();
                if (stack == null || stack == "") 
                {
                    return new XML("<root><error>Stack unavailable</error></root>");
                }
                stack = stack.split("\t").join("");
                lines = stack.split("\n");
                if (lines.length <= 4) 
                {
                    return new XML("<root><error>Stack to short</error></root>");
                }
                lines.shift();
                lines.shift();
                lines.shift();
                lines.shift();
                i = 0;
                while (i < lines.length) 
                {
                    s = lines[i];
                    s = s.substring(3, s.length);
                    bracketIndex = s.indexOf("[");
                    methodIndex = s.indexOf("/");
                    if (bracketIndex == -1) 
                    {
                        bracketIndex = s.length;
                    }
                    if (methodIndex == -1) 
                    {
                        methodIndex = bracketIndex;
                    }
                    classname = MonsterDebuggerUtils.parseType(s.substring(0, methodIndex));
                    method = "";
                    file = "";
                    line = "";
                    if (!(methodIndex == s.length) && !(methodIndex == bracketIndex)) 
                    {
                        method = s.substring(methodIndex + 1, bracketIndex);
                    }
                    if (bracketIndex != s.length) 
                    {
                        file = s.substring(bracketIndex + 1, s.lastIndexOf(":"));
                        line = s.substring(s.lastIndexOf(":") + 1, (s.length - 1));
                    }
                    functionXML = new XML("<node/>");
                    functionXML.@classname = classname;
                    functionXML.@method = method;
                    functionXML.@file = file;
                    functionXML.@line = line;
                    childXML.appendChild(functionXML);
                    ++i;
                }
            }
            rootXML.appendChild(childXML.children());
            return rootXML;
        }

        public static function isDisplayObject(arg1:*):Boolean
        {
            return arg1 is flash.display.DisplayObject || arg1 is flash.display.DisplayObjectContainer;
        }

        internal static function parseBasics(arg1:*, arg2:String, arg3:String, arg4:int=1, arg5:int=5):XML
        {
            var object:*;
            var isXML:Boolean;
            var target:String;
            var rootXML:XML;
            var isXMLString:XML;
            var currentDepth:int=1;
            var type:String;
            var nodeXML:XML;
            var maxDepth:int=5;

            var loc1:*;
            object = arg1;
            target = arg2;
            type = arg3;
            currentDepth = arg4;
            maxDepth = arg5;
            rootXML = new XML("<root/>");
            nodeXML = new XML("<node/>");
            isXML = false;
            isXMLString = new XML();
            if (type == MonsterDebuggerConstants.TYPE_STRING) 
            {
                try 
                {
                    isXMLString = new XML(object);
                    isXML = !isXMLString.hasSimpleContent() && isXMLString.children().length() > 0;
                }
                catch (error:TypeError)
                {
                };
            }
            if (isXML) 
            {
                nodeXML.@icon = MonsterDebuggerConstants.ICON_VARIABLE;
                nodeXML.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                nodeXML.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                nodeXML.@label = "(" + MonsterDebuggerConstants.TYPE_XML + ")";
                nodeXML.@name = "";
                nodeXML.@type = MonsterDebuggerConstants.TYPE_XML;
                nodeXML.@value = "";
                nodeXML.@target = target;
                nodeXML.appendChild(parseXML(isXMLString, target + "." + "children()", currentDepth, maxDepth).children());
            }
            else 
            {
                nodeXML.@icon = MonsterDebuggerConstants.ICON_VARIABLE;
                nodeXML.@access = MonsterDebuggerConstants.ACCESS_VARIABLE;
                nodeXML.@permission = MonsterDebuggerConstants.PERMISSION_READWRITE;
                nodeXML.@label = "(" + type + ") = " + printValue(object, type);
                nodeXML.@name = "";
                nodeXML.@type = type;
                nodeXML.@value = printValue(object, type);
                nodeXML.@target = target;
            }
            rootXML.appendChild(nodeXML);
            return rootXML;
        }

        
        {
            _references = new flash.utils.Dictionary(true);
            _reference = 0;
        }

        internal static var _references:flash.utils.Dictionary;

        internal static var _reference:int=0;
    }
}


//    package orbis
//      package controller
//        class IController
package com.orbis.controller 
{
    public interface IController
    {
        function realPlayClicked():void;

        function demoPlayClicked():void;

        function cycleQuality():void;

        function showAbout(arg1:Boolean):void;

        function showError(arg1:String, arg2:Boolean, arg3:String):void;

        function isRealPlay():Boolean;

        function soundOn():Boolean;

        function isTurbo():Boolean;

        function isLoggedIn():Boolean;

        function toggleSound():void;

        function toggleTurbo():void;

        function setLoggedIn(arg1:Boolean):void;

        function setRealPlay(arg1:Boolean):void;

        function setQuality(arg1:String):void;

        function setGameVersion(arg1:String):void;

        function setPreloaderVersion(arg1:String):void;

        function setTopbarVersion(arg1:String):void;

        function errorOKClicked():void;

        function getSettings():void;

        function setSound(arg1:Boolean):void;

        function setTurbo(arg1:Boolean):void;

        function onBonusOKClicked():void;
    }
}


//        class SettingsController
package com.orbis.controller 
{
    import com.orbis.ui.topbar.*;
    import flash.display.*;
    import flash.net.*;
    
    public class SettingsController extends Object implements IController
    {
        public function SettingsController()
        {
            super();
            this.sharedObjectSettings = new Array("soundOn", "turboOn", "quality");
            this.settings = new Array();
            return;
        }

        public function showOrbisAbout(arg1:Boolean):void
        {
            this.topbar.showAbout(arg1);
            this.setTopbarVersion("");
            this.game.setPreloaderVersion();
            return;
        }

        public function setGameVersion(arg1:String):void
        {
            this.topbar.setGameVersion(arg1);
            return;
        }

        public function setPreloaderVersion(arg1:String):void
        {
            this.topbar.setPreloaderVersion(arg1);
            return;
        }

        public function setTopbarVersion(arg1:String):void
        {
            this.topbar.setTopbarVersion(arg1);
            return;
        }

        public function showError(arg1:String, arg2:Boolean, arg3:String):void
        {
            this.topbar.showError(arg1, arg2, arg3);
            this.criticalErrorShown = arg2;
            return;
        }

        public function initSettings(arg1:Boolean, arg2:Boolean, arg3:Boolean):void
        {
            if (this.readSharedObject()) 
            {
                trace("SettingsController.initSettings(loggedIn, realPlay, skip) settings[soundOn]: " + this.settings["soundOn"]);
                this.setQuality(this.settings["quality"]);
                this.setSound(this.settings["soundOn"]);
                this.setTurbo(this.settings["turboOn"]);
            }
            else 
            {
                trace("SettingsController.initSettings(loggedIn, realPlay, skip) false: ");
                this.setSound(true);
                this.setTurbo(true);
                this.setQuality("HIGH");
                this.writeSharedObject();
            }
            if (arg3) 
            {
                this.setRealPlay(arg2);
            }
            else 
            {
                delete this.settings["realPlay"];
                this.topbar.updateSetting("realPlay", undefined);
            }
            this.setSkip(arg3);
            this.setLoggedIn(arg1);
            return;
        }

        public function showOrbisError(arg1:String, arg2:Boolean, arg3:String, arg4:Boolean):void
        {
            this.topbar.showError(arg1, arg2, arg3);
            this.criticalErrorShown = arg2;
            this.isLoginRequired = arg4;
            return;
        }

        public function errorOKClicked():void
        {
            trace("errorOKClicked");
            trace("criticalErrorShown " + this.criticalErrorShown);
            trace("isLoginRequired " + this.isLoginRequired);
            if (this.criticalErrorShown) 
            {
                if (this.isLoginRequired) 
                {
                    this.login();
                }
                delete this.settings["realPlay"];
                this.topbar.updateSetting("realPlay", undefined);
                this.reboot();
            }
            else 
            {
                this.game.onRecoverFromNonCritical();
            }
            return;
        }

        public function onBonusOKClicked():void
        {
            this.game.onBonusOKClicked();
            return;
        }

        internal function writeSharedObject():Boolean
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=false;
            var loc4:*=0;
            var loc5:*=this.sharedObjectSettings;
            for (loc2 in loc5) 
            {
                loc3 = this.sharedObjectSettings[loc2];
                if (this.settings[loc3] != null) 
                {
                    loc1 = true;
                    this.sharedObject.data.settings[loc3] = this.settings[loc3];
                }
                trace("SettingsController.writeSharedObject() settingName: settings[settingName]: " + loc3 + ": " + this.settings[loc3]);
            }
            if (loc1) 
            {
                this.sharedObject.flush();
            }
            return loc1;
        }

        internal function readSharedObject():Boolean
        {
            var loc2:*=null;
            var loc1:*=false;
            this.sharedObject = SharedObject.getLocal(this.gameName);
            var loc3:*=0;
            var loc4:*=this.sharedObject.data.settings;
            for (loc2 in loc4) 
            {
                trace("SettingsController.readSharedObject() settings[setting]: " + this.settings[loc2]);
                loc1 = true;
                this.settings[loc2] = this.sharedObject.data.settings[loc2];
            }
            if (!loc1) 
            {
                this.sharedObject.data.settings = new Array();
            }
            return loc1;
        }

        public function setGameName(arg1:String):void
        {
            this.gameName = arg1;
            return;
        }

        public function setGame(arg1:flash.display.MovieClip):void
        {
            this.game = arg1;
            return;
        }

        public function getGame():flash.display.MovieClip
        {
            return this.game;
        }

        public function setTopbar(arg1:com.orbis.ui.topbar.ITopBar):void
        {
            this.topbar = arg1;
            return;
        }

        public function getTopbar():com.orbis.ui.topbar.ITopBar
        {
            return this.topbar;
        }

        internal function makeJavascriptCall(arg1:String):void
        {
            var url:String;

            var loc1:*;
            url = arg1;
            this.urlRequest = new URLRequest(url);
            trace("*****url: " + url);
            trace("*****urlRequest: " + this.urlRequest);
            try 
            {
                navigateToURL(this.urlRequest, "_self");
            }
            catch (e:Error)
            {
                trace("SettingsController.makeJavascriptCall() Error: URLRequest " + e.toString());
            }
            return;
        }

        public function login():void
        {
            this.makeJavascriptCall("javascript:n_name=openGameLogin();void(0)");
            return;
        }

        public function help():void
        {
            this.makeJavascriptCall("javascript:n_name=games_help();void(0)");
            return;
        }

        public function rules():void
        {
            this.makeJavascriptCall("javascript:n_name=games_rules();void(0)");
            return;
        }

        public function bank():void
        {
            this.makeJavascriptCall("javascript:n_name=games_bank(\"" + this.gameName + "\");void(0)");
            return;
        }

        public function playForReal():void
        {
            delete this.settings["realPlay"];
            this.topbar.updateSetting("realPlay", undefined);
            if (this.isLoggedIn()) 
            {
                this.reboot();
            }
            else 
            {
                this.login();
            }
            return;
        }

        public function reboot():void
        {
            this.topbar.hideDialog("errorBox");
            this.topbar.showRealDemoDialogs();
            this.game.reboot();
            return;
        }

        public function realPlayClicked():void
        {
            if (this.isLoggedIn()) 
            {
                this.setRealPlay(true);
                this.topbar.hideDemoRealDialogs();
                this.game.realPlayClicked();
            }
            else 
            {
                this.login();
            }
            return;
        }

        public function demoPlayClicked():void
        {
            this.setRealPlay(false);
            this.topbar.hideDemoRealDialogs();
            this.game.demoPlayClicked();
            return;
        }

        public function toggleSound():void
        {
            this.settings["soundOn"] = !this.settings["soundOn"];
            this.game.soundOn(this.soundOn());
            return;
        }

        public function toggleTurbo():void
        {
            this.settings["turboOn"] = !this.settings["turboOn"];
            this.game.toggleTurbo(this.isTurbo());
            return;
        }

        public function soundOn():Boolean
        {
            return this.settings["soundOn"];
        }

        public function isTurbo():Boolean
        {
            return this.settings["turboOn"];
        }

        public function isLoggedIn():Boolean
        {
            return this.settings["loggedIn"];
        }

        public function isRealPlay():Boolean
        {
            return this.settings["realPlay"];
        }

        public function getQuality():String
        {
            return this.settings["quality"];
        }

        public function getSettings():void
        {
            this.topbar.getSettings();
            return;
        }

        public function setLoggedIn(arg1:Boolean):void
        {
            this.settings["loggedIn"] = arg1;
            this.topbar.setLoggedIn(arg1);
            return;
        }

        public function UILoaded():void
        {
            this.game.topbarLayedOut();
            return;
        }

        public function setRealPlay(arg1:Boolean):void
        {
            this.settings["realPlay"] = arg1;
            this.topbar.setRealPlay(arg1);
            return;
        }

        internal function setSkip(arg1:Boolean):void
        {
            this.settings["skip"] = arg1;
            return;
        }

        public function skipDemoReal():Boolean
        {
            return this.settings["skip"];
        }

        public function setSound(arg1:Boolean):void
        {
            this.settings["soundOn"] = arg1;
            this.topbar.setSound(arg1);
            return;
        }

        public function setTurbo(arg1:Boolean):void
        {
            this.settings["turboOn"] = arg1;
            this.topbar.setTurbo(arg1);
            return;
        }

        public function setQuality(arg1:String):void
        {
            this.settings["quality"] = arg1;
            this.game.stage.quality = arg1;
            this.topbar.updateSetting("quality", arg1);
            return;
        }

        public function cycleQuality():void
        {
            return;
        }

        public function showAbout(arg1:Boolean):void
        {
            this.game.showAbout(arg1);
            return;
        }

        internal var topbar:com.orbis.ui.topbar.ITopBar;

        internal var game:flash.display.MovieClip;

        internal var criticalErrorShown:Boolean;

        internal var isLoginRequired:Boolean;

        internal var settings:Array;

        internal var sharedObject:flash.net.SharedObject;

        internal var sharedObjectSettings:Array;

        internal var urlRequest:flash.net.URLRequest;

        internal var gameName:String;
    }
}


//      package game
//        class IGame
package com.orbis.game 
{
    import com.orbis.load.*;
    import com.orbis.ui.topbar.*;
    import flash.display.*;
    
    public interface IGame
    {
        function initGame(arg1:com.orbis.load.IPreloader, arg2:flash.display.DisplayObjectContainer, arg3:com.orbis.ui.topbar.ITopBar):void;
    }
}


//      package load
//        package exceptions
//          class AssetRetrievalException
package com.orbis.load.exceptions 
{
    public class AssetRetrievalException extends Error
    {
        public function AssetRetrievalException(arg1:String)
        {
            super(arg1);
            return;
        }
    }
}


//        class IPreloader
package com.orbis.load 
{
    import flash.display.*;
    import flash.media.*;
    
    public interface IPreloader
    {
        function getPreloaderXML():XML;

        function getSWFAsset(arg1:String):flash.display.DisplayObject;

        function getXMLAsset(arg1:String):XML;

        function getSoundAsset(arg1:String, arg2:Boolean):flash.media.Sound;

        function getImageAsset(arg1:String):flash.display.DisplayObject;
    }
}


//      package ui
//        package topbar
//          class ITopBar
package com.orbis.ui.topbar 
{
    public interface ITopBar
    {
        function setController(arg1:Object):void;

        function showBalance(arg1:String):void;

        function showPaid(arg1:String):void;

        function showStake(arg1:String):void;

        function showFreeBets(arg1:String):void;

        function showBonusWin(arg1:String, arg2:*):void;

        function setBonusPercent(arg1:Number):void;

        function setGameVersion(arg1:String):void;

        function setTopbarVersion(arg1:String):void;

        function setPreloaderVersion(arg1:String):void;

        function show():void;

        function layout():void;

        function addMessage(arg1:String, arg2:Number, arg3:String):void;

        function getVersion():String;

        function setGameLogo(arg1:String):void;

        function setTime(arg1:String, arg2:String):void;

        function updateStopWatch(arg1:Number):void;

        function setupButtons():void;

        function hideDialog(arg1:String):void;

        function setLoggedIn(arg1:Boolean):void;

        function setRealPlay(arg1:Boolean):void;

        function showError(arg1:String, arg2:Boolean, arg3:String):void;

        function hideBonusWin():void;

        function hideDemoRealDialogs():void;

        function getSettings():void;

        function updateSetting(arg1:String, arg2:*):void;

        function showAbout(arg1:Boolean):void;

        function setSound(arg1:Boolean):void;

        function setTurbo(arg1:Boolean):void;

        function showRealDemoDialogs():void;
    }
}


//  package mgs
//    package aurora
//      package common
//        package enums
//          class PreloaderConstants
package mgs.aurora.common.enums 
{
    public class PreloaderConstants extends Object
    {
        public function PreloaderConstants()
        {
            super();
            return;
        }

        public static const REAL_PLAY:String="realplay";

        public static const DEMO_PLAY:String="demoplay";
    }
}


//          class StageSizeConstants
package mgs.aurora.common.enums 
{
    public class StageSizeConstants extends Object
    {
        public function StageSizeConstants()
        {
            super();
            return;
        }

        public static const WIDESCREEN_HEIGHT:int=720;

        public static const WIDESCREEN_WIDTH:int=1280;

        public static const STANDARD_HEIGHT:int=768;

        public static const STANDARD_WIDTH:int=1024;

        public static const T3DEFAULTFRAME_HEIGHT:int=757;

        public static const T3MINIFRAME_HEIGHT:int=748;
    }
}


//        package events
//          package sgi
//            class SgiEvent
package mgs.aurora.common.events.sgi 
{
    import flash.events.*;
    
    public class SgiEvent extends flash.events.Event
    {
        public function SgiEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.sgi.SgiEvent(type, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SgiEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public static const NAME:String="SgiEvent";

        public static const REAL_PLAY:String=NAME + "/types/real_play";

        public static const DEMO_PLAY:String=NAME + "/types/demo_play";

        public static const UILOADED:String=NAME + "/types/uiloaded";

        public static const PLAYFORREAL:String=NAME + "/types/playforreal";

        public static const SHOWABOUT:String=NAME + "/types/showabout";

        public static const HIDEABOUT:String=NAME + "/types/hideabout";

        public static const CHANGESOUND:String=NAME + "/types/changesound";
    }
}


//        package interfaces
//          class ICore
package mgs.aurora.common.interfaces 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.orbis.*;
    import mgs.aurora.common.scale.*;
    
    public interface ICore
    {
        function setup(arg1:mgs.aurora.common.interfaces.IExternalData, arg2:flash.display.Sprite, arg3:String, arg4:mgs.aurora.common.orbis.TopBarController, arg5:mgs.aurora.common.scale.ScaleManager):void;

        function updateExternalData(arg1:Object):void;

        function dispose(arg1:flash.events.Event=null):void;
    }
}


//          class IExternalData
package mgs.aurora.common.interfaces 
{
    public interface IExternalData
    {
        function refresh():void;

        function clear():void;

        function setValue(arg1:String, arg2:String):void;

        function getValue(arg1:String, arg2:String=null):String;

        function removeValue(arg1:String):void;
    }
}


//        package orbis
//          class TopBarController
package mgs.aurora.common.orbis 
{
    import com.orbis.controller.*;
    import com.orbis.ui.topbar.*;
    import flash.display.*;
    import flash.events.*;
    import flash.external.*;
    import flash.net.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.sgi.*;
    import mgs.aurora.common.reflection.*;
    
    public class TopBarController extends flash.events.EventDispatcher implements com.orbis.controller.IController
    {
        public function TopBarController()
        {
            super();
            return;
        }

        public function getQuality():String
        {
            return this._settings["quality"];
        }

        public function setGameVersion(arg1:String):void
        {
            return;
        }

        public function setPreloaderVersion(arg1:String):void
        {
            return;
        }

        public function setTopbarVersion(arg1:String):void
        {
            return;
        }

        public function onBonusOKClicked():void
        {
            return;
        }

        public function errorOKClicked():void
        {
            return;
        }

        public function set gameName(arg1:String):void
        {
            this._gameName = arg1;
            return;
        }

        public function login():void
        {
            flash.external.ExternalInterface.call("openGameLogin");
            return;
        }

        public function help():void
        {
            flash.external.ExternalInterface.call("games_help");
            return;
        }

        public function rules():void
        {
            flash.external.ExternalInterface.call("games_rules");
            return;
        }

        public function initSettings(arg1:Object):void
        {
            this._settings = new Array();
            this._skip = arg1.skip == "true";
            this._token = arg1.orbistoken;
            this.setLoggedIn(arg1.loggedIn == "true");
            this.getSavedSoundValue(arg1.sPath);
            this.setQuality(arg1.quality);
            this.loadAboutMC();
            this.setRealPlay(arg1.playMode == mgs.aurora.common.enums.PreloaderConstants.REAL_PLAY);
            return;
        }

        public function setupReflection(arg1:XML):void
        {
            this._reflector = new mgs.aurora.common.reflection.TopBarReflector(this, arg1);
            return;
        }

        public function get token():String
        {
            return this._token;
        }

        public function bank():void
        {
            flash.external.ExternalInterface.call("games_bank", this._gameName);
            return;
        }

        public function get About():flash.display.DisplayObject
        {
            return this._about;
        }

        public function loadGameLogo(arg1:String):void
        {
            this._topbar.setGameLogo(arg1);
            return;
        }

        public function loadAboutMC():void
        {
            this._loader = new flash.display.Loader();
            this._loader.contentLoaderInfo.addEventListener(flash.events.Event.INIT, this.onAboutLoaded);
            this._loader.load(new flash.net.URLRequest("sgi/About.swf"));
            return;
        }

        public function onAboutLoaded(arg1:flash.events.Event):void
        {
            this._about = flash.display.DisplayObject(this._loader.content);
            return;
        }

        public function checkforSkip():void
        {
            if (this._skip) 
            {
                if (this.isRealPlay()) 
                {
                    this.realPlayClicked();
                }
                else 
                {
                    this.demoPlayClicked();
                }
            }
            else 
            {
                this._topbar.showRealDemoDialogs();
            }
            return;
        }

        public function getSavedSoundValue(arg1:String):void
        {
            var path:String;
            var local:flash.net.SharedObject;
            var tempSound:Boolean;

            var loc1:*;
            local = null;
            tempSound = false;
            path = arg1;
            try 
            {
                local = flash.net.SharedObject.getLocal("Sound", path);
                tempSound = local.data["muted"] == "1";
            }
            catch (err:Error)
            {
                tempSound = false;
            }
            this._settings["soundOn"] = !tempSound;
            this.setSound(this.soundOn());
            return;
        }

        public function setTopbar(arg1:com.orbis.ui.topbar.ITopBar):void
        {
            this._topbar = arg1;
            return;
        }

        public function getTopbar():com.orbis.ui.topbar.ITopBar
        {
            return this._topbar;
        }

        public function setWinValue(arg1:String):void
        {
            this._topbar.showPaid(arg1);
            return;
        }

        public function setBetValue(arg1:String):void
        {
            this._topbar.showStake(arg1);
            return;
        }

        public function setBalance(arg1:String):void
        {
            this._topbar.showBalance(arg1);
            return;
        }

        public function setBonusPercent(arg1:Number):void
        {
            this._topbar.setBonusPercent(arg1);
            return;
        }

        public function setFreeBets(arg1:String):void
        {
            this._topbar.showFreeBets(arg1);
            return;
        }

        public function setExternalOperatorInfo(arg1:XML):void
        {
            if (arg1 && this._reflector) 
            {
                this._reflector.execute(arg1);
            }
            return;
        }

        public function playForReal():void
        {
            delete this._settings["realPlay"];
            this._topbar.updateSetting("realPlay", undefined);
            if (this.isLoggedIn()) 
            {
                this._topbar.showRealDemoDialogs();
                this.dispatchEvent(new mgs.aurora.common.events.sgi.SgiEvent(mgs.aurora.common.events.sgi.SgiEvent.PLAYFORREAL));
            }
            else 
            {
                this.login();
            }
            this.dispatchEvent(new mgs.aurora.common.events.sgi.SgiEvent(mgs.aurora.common.events.sgi.SgiEvent.UILOADED));
            return;
        }

        public function realPlayClicked():void
        {
            if (this.isLoggedIn()) 
            {
                this._topbar.hideDemoRealDialogs();
                this.setRealPlay(true);
                this._topbar.showFreeBets("");
                this._topbar.setBonusPercent(0);
                this.dispatchEvent(new mgs.aurora.common.events.sgi.SgiEvent(mgs.aurora.common.events.sgi.SgiEvent.REAL_PLAY));
            }
            else 
            {
                this.login();
            }
            return;
        }

        public function demoPlayClicked():void
        {
            this._topbar.hideDemoRealDialogs();
            this.setRealPlay(false);
            this.dispatchEvent(new mgs.aurora.common.events.sgi.SgiEvent(mgs.aurora.common.events.sgi.SgiEvent.DEMO_PLAY));
            return;
        }

        public function UILoaded():void
        {
            this._topbar.showBalance("");
            this._topbar.showStake("");
            this._topbar.showFreeBets("");
            this._topbar.hideDemoRealDialogs();
            this.dispatchEvent(new mgs.aurora.common.events.sgi.SgiEvent(mgs.aurora.common.events.sgi.SgiEvent.UILOADED));
            return;
        }

        public function cycleQuality():void
        {
            var loc2:*=null;
            var loc1:*="";
            if (loc2 != "LOW") 
            {
                if (loc2 != "MEDIUM") 
                {
                    if (loc2 != "HIGH") 
                    {
                        loc2 = "LOW";
                        loc1 = "Quality Low";
                    }
                    else 
                    {
                        loc2 = "BEST";
                        loc1 = "Quality Best";
                    }
                }
                else 
                {
                    loc2 = "HIGH";
                    loc1 = "Quality High";
                }
            }
            else 
            {
                loc2 = "MEDIUM";
                loc1 = "Quality Mid";
            }
            this._settings["quality"] = loc2;
            return;
        }

        public function showAbout(arg1:Boolean):void
        {
            if (arg1) 
            {
                this.dispatchEvent(new mgs.aurora.common.events.sgi.SgiEvent(mgs.aurora.common.events.sgi.SgiEvent.SHOWABOUT));
            }
            else 
            {
                this.dispatchEvent(new mgs.aurora.common.events.sgi.SgiEvent(mgs.aurora.common.events.sgi.SgiEvent.HIDEABOUT));
            }
            return;
        }

        public function showError(arg1:String, arg2:Boolean, arg3:String):void
        {
            return;
        }

        public function isRealPlay():Boolean
        {
            return this._settings["realPlay"];
        }

        public function soundOn():Boolean
        {
            return this._settings["soundOn"];
        }

        public function isTurbo():Boolean
        {
            return this._settings["turboOn"];
        }

        public function turboOn():Boolean
        {
            return false;
        }

        public function isLoggedIn():Boolean
        {
            return this._settings["isLoggedIn"];
        }

        public function toggleSound():void
        {
            this._settings["soundOn"] = !this._settings["soundOn"];
            this.dispatchEvent(new mgs.aurora.common.events.sgi.SgiEvent(mgs.aurora.common.events.sgi.SgiEvent.CHANGESOUND));
            return;
        }

        public function toggleTurbo():void
        {
            this._settings["turboOn"] = !this._settings["turboOn"];
            return;
        }

        public function setLoggedIn(arg1:Boolean):void
        {
            this._settings["isLoggedIn"] = arg1;
            this._topbar.setLoggedIn(arg1);
            return;
        }

        public function setRealPlay(arg1:Boolean):void
        {
            this._settings["realPlay"] = arg1;
            this._topbar.setRealPlay(arg1);
            return;
        }

        public function getSettings():void
        {
            this._topbar.getSettings();
            return;
        }

        public function setSound(arg1:Boolean):void
        {
            this._settings["soundOn"] = arg1;
            this._topbar.setSound(arg1);
            return;
        }

        public function setTurbo(arg1:Boolean):void
        {
            this._settings["turboOn"] = arg1;
            this._topbar.setTurbo(arg1);
            return;
        }

        public function setQuality(arg1:String):void
        {
            this._settings["quality"] = arg1;
            this._topbar.updateSetting("quality", arg1);
            return;
        }

        internal var _topbar:com.orbis.ui.topbar.ITopBar;

        internal var _isLoginRequired:Boolean;

        internal var _settings:Array;

        internal var _game:flash.display.MovieClip;

        internal var _token:String="";

        internal var _gameName:String="";

        internal var _about:flash.display.DisplayObject;

        internal var _loader:flash.display.Loader;

        internal var _reflector:mgs.aurora.common.reflection.TopBarReflector;

        internal var _skip:Boolean;
    }
}


//        package reflection
//          class TopBarReflector
package mgs.aurora.common.reflection 
{
    public class TopBarReflector extends Object
    {
        public function TopBarReflector(arg1:Object, arg2:XML)
        {
            super();
            this._targetInstance = arg1;
            this._rules = arg2;
            return;
        }

        public function execute(arg1:XML):void
        {
            var xmlFromGame:XML;
            var vaildReflection:Boolean;
            var reflectionList:XMLList;
            var n:int;
            var parameterList:XMLList;
            var forReflection:Object;
            var parameterIndex:int;
            var i:int;
            var value:XMLList;

            var loc1:*;
            vaildReflection = false;
            reflectionList = null;
            n = 0;
            parameterList = null;
            forReflection = null;
            parameterIndex = 0;
            i = 0;
            value = null;
            xmlFromGame = arg1;
            try 
            {
                reflectionList = this._rules.reflection;
                n = 0;
                while (n < reflectionList.length()) 
                {
                    vaildReflection = true;
                    parameterList = reflectionList[n].parameter;
                    forReflection = new Object();
                    forReflection.method = reflectionList[n].@methodName;
                    forReflection.parameters = new Array();
                    parameterIndex = 0;
                    i = 0;
                    while (i < parameterList.length()) 
                    {
                        value = this.existsInXmlFromGame(xmlFromGame, parameterList[i].@xmlPath);
                        if (value) 
                        {
                            if (value.length() > 0) 
                            {
                                loc2 = parameterList[i].@type.toLowerCase();
                                switch (loc2) 
                                {
                                    case "int":
                                    {
                                        forReflection.parameters[parameterIndex] = int(value);
                                        break;
                                    }
                                    case "uint":
                                    {
                                        forReflection.parameters[parameterIndex] = uint(value);
                                        break;
                                    }
                                    case "number":
                                    {
                                        forReflection.parameters[parameterIndex] = Number(value);
                                        break;
                                    }
                                    case "boolean":
                                    {
                                        forReflection.parameters[parameterIndex] = this.stringToBoolean(String(value));
                                        break;
                                    }
                                    default:
                                    {
                                        forReflection.parameters[parameterIndex] = String(value);
                                        break;
                                    }
                                }
                                ++parameterIndex;
                            }
                            else 
                            {
                                vaildReflection = false;
                            }
                        }
                        else 
                        {
                            vaildReflection = false;
                        }
                        ++i;
                    }
                    if (vaildReflection) 
                    {
                        Debugger.trace("TopBarReflector::execute ", "SYSTEM - TopBarReflector", forReflection);
                        this._targetInstance[forReflection.method].apply(null, forReflection.parameters);
                    }
                    else 
                    {
                        Debugger.trace("TopBarReflector::execute reflection fail, parameters for method " + forReflection.method + " not found", "SYSTEM - TopBarReflector", forReflection);
                    }
                    ++n;
                }
            }
            catch (e:Error)
            {
                Debugger.trace("TopBarReflector::execute error", "SYSTEM - TopBarReflector", e);
            }
            return;
        }

        internal function existsInXmlFromGame(arg1:XML, arg2:String):XMLList
        {
            var loc1:*=arg2.split(".");
            var loc2:*=new XMLList(arg1);
            var loc3:*=1;
            while (loc2 != null) 
            {
                if (loc3 >= loc1.length) 
                {
                    break;
                }
                loc2 = loc2[loc1[loc3]];
                ++loc3;
            }
            return loc2;
        }

        internal function stringToBoolean(arg1:String):Boolean
        {
            if (arg1 == null) 
            {
                return false;
            }
            if (arg1.toLowerCase() == "true" || arg1 == "1") 
            {
                return true;
            }
            return false;
        }

        internal var _rules:XML;

        internal var _targetInstance:Object;
    }
}


//        package scale
//          class ScaleManager
package mgs.aurora.common.scale 
{
    import flash.display.*;
    import flash.events.*;
    import flash.external.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.interfaces.*;
    
    public class ScaleManager extends Object
    {
        public function ScaleManager(arg1:flash.display.Stage, arg2:Boolean, arg3:Boolean=false)
        {
            super();
            this._stage = arg1;
            this._resize = arg2;
            this._allowLocking = arg3;
            this._preloadeWSMove = mgs.aurora.common.enums.StageSizeConstants.WIDESCREEN_WIDTH / 2 - mgs.aurora.common.enums.StageSizeConstants.STANDARD_WIDTH / 2;
            if (arg2) 
            {
                this._stage.addEventListener(flash.events.Event.RESIZE, this.onScale);
                this.onScale(new flash.events.Event(flash.events.Event.RESIZE));
            }
            return;
        }

        public function onScale(arg1:flash.events.Event):void
        {
            var loc4:*=NaN;
            var loc5:*=NaN;
            var loc10:*=null;
            var loc11:*=null;
            var loc12:*=NaN;
            var loc13:*=NaN;
            var loc14:*=NaN;
            var loc15:*=NaN;
            var loc16:*=NaN;
            var loc17:*=NaN;
            var loc18:*=false;
            var loc19:*=false;
            var loc20:*=null;
            var loc21:*=NaN;
            var loc22:*=NaN;
            var loc23:*=NaN;
            var loc24:*=NaN;
            var loc25:*=NaN;
            var loc26:*=NaN;
            var loc27:*=NaN;
            var loc28:*=NaN;
            if (!this._resize) 
            {
                return;
            }
            var loc1:*=this._stage.stageWidth;
            var loc2:*=this._stage.stageHeight;
            var loc3:*=0;
            if (this._allowLocking) 
            {
                if (loc1 > this._initWindowWidth || loc2 > this._initWindowHeight) 
                {
                    loc11 = (loc10 = flash.external.ExternalInterface.call("getWindowSize")).split(";");
                    if (!(loc1 == loc11[0]) && loc11[0] > this._initWindowWidth || !(loc2 == loc11[1]) && loc11[1] > this._initWindowHeight) 
                    {
                        loc12 = loc1 / loc11[0];
                        loc13 = loc2 / loc11[1];
                        loc14 = this._initWindowWidth * loc12;
                        loc15 = this._initWindowHeight * loc12;
                        loc16 = this._initWindowWidth * loc13;
                        loc17 = this._initWindowHeight * loc13;
                        loc18 = loc15 <= loc2 && loc14 <= loc1;
                        loc19 = loc17 <= loc2 && loc16 <= loc1;
                        if (loc18 && loc19) 
                        {
                            loc3 = loc12;
                        }
                        else if (!loc18 && loc19) 
                        {
                            loc3 = loc13;
                        }
                        else if (loc18 && !loc19) 
                        {
                            loc3 = loc13;
                        }
                    }
                }
            }
            var loc6:*=loc1 / this._initWindowWidth;
            var loc7:*=loc2 / this._initWindowHeight;
            var loc8:*=loc6 >= loc7 ? loc7 : loc6;
            var loc9:*=false;
            if (loc8 > 1 && this._allowLocking) 
            {
                loc8 = (loc9 = loc3 >= 1 && loc3 < loc8) ? 1 * loc3 : 1;
            }
            if (!(this._core == null) || !(this._preloaderArt == null)) 
            {
                (loc20 = this._core == null ? flash.display.DisplayObject(this._preloaderArt) : flash.display.DisplayObject(this._core)).scaleX = loc8;
                loc20.scaleY = loc8;
                loc21 = this._initWindowWidth * loc8;
                loc22 = this._initWindowHeight * loc8;
                if (loc1 > loc21) 
                {
                    loc23 = loc1 / 2;
                    loc24 = loc21 / 2;
                    loc25 = loc23 - loc24;
                    loc20.x = this.widescreen && this._core == null ? this._preloadeWSMove * loc8 + loc25 : loc25;
                }
                else 
                {
                    loc20.x = this.widescreen && this._core == null ? this._preloadeWSMove * loc8 : 0;
                }
                if (loc2 > loc22) 
                {
                    loc26 = loc2 / 2;
                    loc27 = loc22 / 2;
                    loc28 = loc26 - loc27;
                    loc20.y = loc28;
                }
                else 
                {
                    loc20.y = 0;
                }
            }
            return;
        }

        public function resetPreloaderArt():void
        {
            if (!this._resize) 
            {
                return;
            }
            this._preloaderArt.scaleX = 1;
            this._preloaderArt.scaleY = 1;
            this._preloaderArt.y = 0;
            if (this.widescreen) 
            {
                this._preloaderArt.x = this._preloadeWSMove;
            }
            else 
            {
                this._preloaderArt.x = 0;
            }
            return;
        }

        public function set core(arg1:mgs.aurora.common.interfaces.ICore):void
        {
            this._core = arg1;
            this.resetPreloaderArt();
            this.onScale(new flash.events.Event(flash.events.Event.RESIZE));
            return;
        }

        public function set preloaderArt(arg1:flash.display.Sprite):void
        {
            this._preloaderArt = arg1;
            this.onScale(new flash.events.Event(flash.events.Event.RESIZE));
            return;
        }

        public function set initWindowWidth(arg1:Number):void
        {
            this._initWindowWidth = arg1;
            return;
        }

        public function get initWindowWidth():Number
        {
            return this._initWindowWidth;
        }

        public function set initWindowHeight(arg1:Number):void
        {
            this._initWindowHeight = arg1;
            return;
        }

        public function get initWindowHeight():Number
        {
            return this._initWindowHeight;
        }

        public function get widescreen():Boolean
        {
            return this._widescreen;
        }

        public function set widescreen(arg1:Boolean):void
        {
            this._widescreen = arg1;
            return;
        }

        public function reSize():void
        {
            var loc1:*="";
            if (this._resize == false && !(this._stage == null) && (!(this._initWindowWidth == 1024) || !(this._initWindowHeight == 768))) 
            {
                this._resize = true;
                this._stage.align = flash.display.StageAlign.TOP_LEFT;
                this._stage.scaleMode = flash.display.StageScaleMode.NO_SCALE;
                if (this._stage.hasEventListener(flash.events.Event.RESIZE)) 
                {
                    this._stage.removeEventListener(flash.events.Event.RESIZE, this.onScale);
                    this._stage.addEventListener(flash.events.Event.RESIZE, this.onScale);
                }
                else 
                {
                    this._stage.addEventListener(flash.events.Event.RESIZE, this.onScale);
                }
            }
            else if (this._resize == true && !(this._stage == null) && this._initWindowWidth == 1024 && this._initWindowHeight == 768) 
            {
                this._stage.removeEventListener(flash.events.Event.RESIZE, this.onScale);
                this._resize = false;
                this._stage.align = "";
                this._stage.scaleMode = flash.display.StageScaleMode.SHOW_ALL;
                this.resetSize();
            }
            if (this._resize) 
            {
                this.onScale(new flash.events.Event(flash.events.Event.RESIZE));
            }
            return;
        }

        public function resetSize():void
        {
            flash.display.DisplayObject(this._core).scaleX = 1;
            flash.display.DisplayObject(this._core).scaleY = 1;
            flash.display.DisplayObject(this._core).x = 0;
            flash.display.DisplayObject(this._core).y = 0;
            return;
        }

        internal var _stage:flash.display.Stage;

        internal var _resize:Boolean;

        internal var _allowLocking:Boolean;

        internal var _widescreen:Boolean;

        internal var _initWindowWidth:Number=1024;

        internal var _initWindowHeight:Number=768;

        internal var _preloadeWSMove:Number;

        internal var _core:mgs.aurora.common.interfaces.ICore;

        internal var _preloaderArt:flash.display.Sprite;
    }
}


//      package modules
//        package loader
//          package enums
//            class LoaderFrameLabels
package mgs.aurora.modules.loader.enums 
{
    public class LoaderFrameLabels extends Object
    {
        public function LoaderFrameLabels()
        {
            super();
            return;
        }

        public static const FRAME_ONE:String="1";

        public static const FRAME_DEMO_REAL:String="demoreal";

        public static const FRAME_GAME:String="game";
    }
}


//          package model
//            class ExternalData
package mgs.aurora.modules.loader.model 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.*;
    
    public class ExternalData extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.IExternalData
    {
        public function ExternalData()
        {
            super();
            this.clear();
            return;
        }

        public function refresh():void
        {
            return;
        }

        public function clear():void
        {
            this._store = new flash.utils.Dictionary();
            return;
        }

        public function setValue(arg1:String, arg2:String):void
        {
            this._store[arg1] = arg2;
            return;
        }

        public function getValue(arg1:String, arg2:String=null):String
        {
            arg1 = arg1.toLowerCase();
            var loc1:*=this._store[arg1] != null ? String(this._store[arg1]) : arg2;
            return loc1;
        }

        public function removeValue(arg1:String):void
        {
            delete this._store[arg1];
            return;
        }

        protected var _store:flash.utils.Dictionary;
    }
}


//            class WebExternalData
package mgs.aurora.modules.loader.model 
{
    import flash.events.*;
    import flash.external.*;
    
    public class WebExternalData extends mgs.aurora.modules.loader.model.ExternalData
    {
        public function WebExternalData(arg1:Object)
        {
            super();
            this._params = arg1;
            return;
        }

        public override function refresh():void
        {
            var loc1:*=null;
            var loc2:*=null;
            if (this._params["mgs_useflashvars"] != "1") 
            {
                loc2 = flash.external.ExternalInterface.call("getExternalSettings");
                loc3 = 0;
                loc4 = loc2;
                for (loc1 in loc4) 
                {
                    this.setValue(loc1.toLowerCase(), unescape(loc2[loc1]));
                }
            }
            else 
            {
                var loc3:*=0;
                var loc4:*=this._params;
                for (loc1 in loc4) 
                {
                    this.setValue(loc1.toLowerCase(), unescape(this._params[loc1]));
                }
            }
            this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            return;
        }

        internal var _params:Object;
    }
}


//          class SystemLoader
package mgs.aurora.modules.loader 
{
    import com.orbis.game.*;
    import com.orbis.load.*;
    import com.orbis.ui.topbar.*;
    import flash.display.*;
    import flash.events.*;
    import flash.external.*;
    import flash.net.*;
    import flash.system.*;
    import flash.text.*;
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.sgi.*;
    import mgs.aurora.common.interfaces.*;
    import mgs.aurora.common.orbis.*;
    import mgs.aurora.common.scale.*;
    import mgs.aurora.modules.loader.enums.*;
    import mgs.aurora.modules.loader.model.*;
    
    public class SystemLoader extends flash.display.MovieClip implements com.orbis.game.IGame
    {
        public function SystemLoader()
        {
            var loc1:*=false;
            var loc2:*=false;
            var loc3:*=false;
            var loc4:*=false;
            var loc5:*=false;
            var loc6:*=0;
            var loc7:*=0;
            var loc8:*=false;
            super();
            flash.external.ExternalInterface.addCallback("JStoSWFCommsTest", this.JStoSWFCommsTest);
            flash.external.ExternalInterface.call("setFullOSVersion", flash.system.Capabilities.os);
            flash.external.ExternalInterface.addCallback("updateExternalData", this.updateExternalData);
            Debugger.ALLOW = true;
            if (stage == null) 
            {
                this._scaleManger = new mgs.aurora.common.scale.ScaleManager(stage, false, false);
            }
            else 
            {
                loc1 = false;
                loc2 = String(stage.loaderInfo.parameters["t3game"]).toLowerCase() == "true";
                loc3 = String(stage.loaderInfo.parameters["widescreen"]).toLowerCase() == "true";
                loc4 = String(stage.loaderInfo.parameters["defaultFrame"]).toLowerCase() == "true";
                loc5 = String(stage.loaderInfo.parameters["doDefaultFrameAdjustment"]) == "1";
                loc6 = mgs.aurora.common.enums.StageSizeConstants.STANDARD_HEIGHT;
                loc7 = mgs.aurora.common.enums.StageSizeConstants.STANDARD_WIDTH;
                if (loc3) 
                {
                    loc6 = mgs.aurora.common.enums.StageSizeConstants.WIDESCREEN_HEIGHT;
                    loc7 = mgs.aurora.common.enums.StageSizeConstants.WIDESCREEN_WIDTH;
                    stage.align = flash.display.StageAlign.TOP_LEFT;
                    stage.scaleMode = flash.display.StageScaleMode.NO_SCALE;
                    loc1 = true;
                    flash.external.ExternalInterface.call("setExternalInit", 1280, 720);
                }
                else if (loc2) 
                {
                    loc6 = loc4 ? mgs.aurora.common.enums.StageSizeConstants.T3DEFAULTFRAME_HEIGHT : mgs.aurora.common.enums.StageSizeConstants.T3MINIFRAME_HEIGHT;
                    stage.align = flash.display.StageAlign.TOP_LEFT;
                    stage.scaleMode = flash.display.StageScaleMode.NO_SCALE;
                    loc1 = true;
                    flash.external.ExternalInterface.call("setExternalInit", 1024, 770);
                }
                else 
                {
                    flash.external.ExternalInterface.call("setExternalInit", 1024, 770);
                }
                loc8 = String(stage.loaderInfo.parameters["allowResolutionLocking"]).toLowerCase() == "true";
                this._scaleManger = new mgs.aurora.common.scale.ScaleManager(stage, loc1, loc8);
                this._scaleManger.initWindowHeight = loc6;
                this._scaleManger.initWindowWidth = loc7;
                this._scaleManger.reSize();
                this.getExternalData();
            }
            this._loginType = "";
            this._topbarOffset = loc4 && loc5 ? 53 : 80;
            return;
        }

        internal function onTopbarReflectionLoaded(arg1:flash.events.Event):void
        {
            this._urlLoader.removeEventListener(flash.events.Event.COMPLETE, this.onTopbarReflectionLoaded);
            this._urlLoader.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onTopbarReflectionLoadedError);
            this._topbarReflectionRules = new XML(this._urlLoader.data);
            this.continueCasinoLoad();
            return;
        }

        internal function getExternalData():void
        {
            this._externalData = new mgs.aurora.modules.loader.model.WebExternalData(stage.loaderInfo.parameters);
            flash.events.IEventDispatcher(this._externalData).addEventListener(flash.events.Event.CHANGE, this.onExternalDataRecieved);
            this._externalData.refresh();
            return;
        }

        internal function onExternalDataRecieved(arg1:flash.events.Event):void
        {
            if (this.stage) 
            {
                this.stage.frameRate = 25;
                this._documentFPS = this.stage.frameRate;
            }
            var loc1:*=String(this._externalData.getValue("enablePerformanceRating", "false")).toLowerCase() == "true";
            var loc2:*=int(this._externalData.getValue("numberOfIterations", "0").toLowerCase());
            this._performance = int(this._externalData.getValue("performanceRating", "0").toLowerCase());
            if (loc1 && this._performance == 0) 
            {
                this.doPlayerBenchMark(loc2);
            }
            var loc3:*=String(this._externalData.getValue("widescreen", "false")).toLowerCase() == "true";
            var loc4:*=String(this._externalData.getValue("t3game", "false")).toLowerCase() == "true";
            var loc5:*=String(this._externalData.getValue("defaultFrame", "false")).toLowerCase() == "true";
            if (loc3) 
            {
                this._scaleManger.initWindowWidth = mgs.aurora.common.enums.StageSizeConstants.WIDESCREEN_WIDTH;
                this._scaleManger.initWindowHeight = mgs.aurora.common.enums.StageSizeConstants.WIDESCREEN_HEIGHT;
                this._scaleManger.reSize();
            }
            else if (loc4) 
            {
                this._scaleManger.initWindowWidth = mgs.aurora.common.enums.StageSizeConstants.STANDARD_WIDTH;
                this._scaleManger.initWindowHeight = loc5 ? mgs.aurora.common.enums.StageSizeConstants.T3DEFAULTFRAME_HEIGHT : mgs.aurora.common.enums.StageSizeConstants.T3MINIFRAME_HEIGHT;
                this._scaleManger.reSize();
            }
            var loc6:*=loc3 ? mgs.aurora.common.enums.StageSizeConstants.WIDESCREEN_WIDTH : mgs.aurora.common.enums.StageSizeConstants.STANDARD_WIDTH;
            var loc7:*=loc3 ? mgs.aurora.common.enums.StageSizeConstants.WIDESCREEN_HEIGHT : mgs.aurora.common.enums.StageSizeConstants.STANDARD_HEIGHT;
            if (loc4) 
            {
                loc7 = loc5 ? mgs.aurora.common.enums.StageSizeConstants.T3DEFAULTFRAME_HEIGHT : mgs.aurora.common.enums.StageSizeConstants.T3MINIFRAME_HEIGHT;
            }
            var loc8:*=loc3 || loc4 ? "true" : "false";
            flash.external.ExternalInterface.call("setGameSetting", loc8, loc6, loc7);
            if (this._externalData.getValue("gameid", "") != "") 
            {
                this.startLoadCombinedSettings();
            }
            else 
            {
                this.startLoadDependencies();
            }
            return;
        }

        internal function loadLoaderProgressArt():void
        {
            this._loader = new flash.display.Loader();
            this._loader.contentLoaderInfo.addEventListener(flash.events.Event.INIT, this.onloaderProgressArtLoaded);
            this._loader.contentLoaderInfo.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onLoaderProgressArtLoadError);
            this._loader.load(new flash.net.URLRequest("System/Aurora/" + this.getVersionedFilename("PreloaderArt.swf")));
            return;
        }

        internal function get background():flash.display.MovieClip
        {
            return this._loaderProgressArt["background"];
        }

        internal function get gameTextField():flash.text.TextField
        {
            return this._loaderProgressArt["GameLoadingText"];
        }

        internal function get maskSlider():flash.display.MovieClip
        {
            return this._loaderProgressArt["maskSlider"];
        }

        internal function startLoadGameSettings():void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc1:*="";
            if (this._externalData.getValue("gameid", "") == "") 
            {
                return;
            }
            else 
            {
                loc1 = this._externalData.getValue("gameid", "");
                this._urlLoader = new flash.net.URLLoader();
                this._urlLoader.addEventListener(flash.events.Event.COMPLETE, this.onGameSettingsLoaded);
                this._urlLoader.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onGameSettingsLoadedError);
                loc2 = "";
                loc3 = "GameSettings.ashx?gameId=" + loc1 + "&system=aurora" + loc2;
                if (this._externalData.getValue("ul", "") != "") 
                {
                    loc2 = loc2 + ("&ul=" + this._externalData.getValue("ul", ""));
                }
                if (this._externalData.getValue("theme", "") != "") 
                {
                    loc2 = loc2 + ("&theme=" + this._externalData.getValue("theme", ""));
                }
                if (this._externalData.getValue("variant", "") != "") 
                {
                    loc2 = loc2 + ("&variant=" + this._externalData.getValue("variant", ""));
                }
                if (this._externalData.getValue("regmarket", "") != "") 
                {
                    loc2 = loc2 + ("&regMarket=" + this._externalData.getValue("regmarket", ""));
                }
                (loc4 = new flash.net.URLRequest(loc3)).method = flash.net.URLRequestMethod.GET;
                this._urlLoader.load(loc4);
            }
            return;
        }

        internal function onLoaderProgressArtLoadError(arg1:flash.events.IOErrorEvent):void
        {
            this.handleFileError("PreloaderArt.swf");
            this._loader.contentLoaderInfo.removeEventListener(flash.events.Event.INIT, this.onloaderProgressArtLoaded);
            this._loader.contentLoaderInfo.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onLoaderProgressArtLoadError);
            return;
        }

        internal function onloaderProgressArtLoaded(arg1:flash.events.Event):void
        {
            var e:flash.events.Event;
            var wideScreen:Boolean;
            var isSGI:String;

            var loc1:*;
            e = arg1;
            this._loader.contentLoaderInfo.removeEventListener(flash.events.Event.INIT, this.onloaderProgressArtLoaded);
            this._loader.contentLoaderInfo.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onLoaderProgressArtLoadError);
            this._loaderProgressArt = this._loader.content as flash.display.Sprite;
            wideScreen = String(this._externalData.getValue("widescreen", "false")).toLowerCase() == "true";
            isSGI = String(this._externalData.getValue("issgi", "false")).toLowerCase();
            this._scaleManger.widescreen = wideScreen;
            this._scaleManger.preloaderArt = this._loaderProgressArt;
            this.addChild(this._loaderProgressArt);
            if (wideScreen) 
            {
                if (this._loaderProgressArt["background"] != null) 
                {
                    if (isSGI == "true") 
                    {
                        this._loaderProgressArt.x = mgs.aurora.common.enums.StageSizeConstants.WIDESCREEN_WIDTH / 2 - mgs.aurora.common.enums.StageSizeConstants.STANDARD_WIDTH / 2;
                    }
                    this._loaderProgressArt["background"].gotoAndStop("large");
                }
            }
            this._scaleManger.reSize();
            if (isSGI == "true") 
            {
                this._loaderProgressArt.y = this._topbarOffset;
            }
            try 
            {
                this.gameTextField.text = unescape(decodeURI(unescape(String(this._externalData.getValue("preloaderText", "Loading")))));
            }
            catch (e:Error)
            {
            };
            this.loadCore();
            return;
        }

        internal function loadCore():void
        {
            this._loader = new flash.display.Loader();
            this._loader.contentLoaderInfo.addEventListener(flash.events.Event.INIT, this.onCoreLoaded);
            this._loader.contentLoaderInfo.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onCoreLoadError);
            this._loader.contentLoaderInfo.addEventListener(flash.events.ProgressEvent.PROGRESS, this.onCoreLoadProgress);
            this._startTime = new Date();
            this._loader.load(new flash.net.URLRequest("System/Aurora/" + this.getVersionedFilename("Core.swf")), new flash.system.LoaderContext(false, null, flash.system.SecurityDomain.currentDomain));
            return;
        }

        internal function onCoreLoadProgress(arg1:flash.events.ProgressEvent):void
        {
            var e:flash.events.ProgressEvent;
            var frameNumber:Number;

            var loc1:*;
            frameNumber = NaN;
            e = arg1;
            try 
            {
                frameNumber = e.bytesLoaded / e.bytesTotal * 100 / 7.69;
                if (frameNumber > this.maskSlider.currentFrame) 
                {
                    this.maskSlider.gotoAndStop(Math.round(frameNumber));
                }
            }
            catch (e:Error)
            {
            };
            try 
            {
                this.loaderProgressBar.scaleX = Number(e.bytesLoaded / e.bytesTotal * 0.125);
            }
            catch (e:Error)
            {
            };
            return;
        }

        internal function onCoreLoaded(arg1:flash.events.Event):void
        {
            var loc1:*=new Date();
            var loc2:*=loc1.time - this._startTime.time;
            this.calculateSpeed(loc2, this._loader.contentLoaderInfo.bytesTotal);
            var loc3:*;
            if ((loc3 = String(this._externalData.getValue("issgi", "false")).toLowerCase()) != "false") 
            {
                this._topBarController.removeEventListener(mgs.aurora.common.events.sgi.SgiEvent.PLAYFORREAL, this.onPlayforReal);
                this._topBarController.setupReflection(this._topbarReflectionRules);
            }
            this._loader.contentLoaderInfo.removeEventListener(flash.events.Event.INIT, this.onCoreLoaded);
            this._loader.contentLoaderInfo.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onCoreLoadProgress);
            this._loader.contentLoaderInfo.removeEventListener(flash.events.ProgressEvent.PROGRESS, this.onCoreLoadProgress);
            this.addChild(flash.display.DisplayObject(this._loader.content));
            this._core = this._loader.content as mgs.aurora.common.interfaces.ICore;
            this._scaleManger.core = this._core;
            this._externalData.setValue("t3game", String(stage.loaderInfo.parameters["t3game"]));
            this._core.setup(this._externalData, this._loaderProgressArt, this._loginType, this._topBarController, this._scaleManger);
            return;
        }

        internal function calculateSpeed(arg1:Number, arg2:uint):void
        {
            var loc1:*=arg2 / 128;
            var loc2:*=arg1 / 1000;
            var loc3:*=Math.round(loc1 / loc2);
            var loc4:*="";
            if (loc3 < 56) 
            {
                loc4 = loc4 + "56kbps";
            }
            else if (loc3 >= 56 && loc3 < 1024) 
            {
                loc4 = loc4 + "128kbps_1024kbps";
            }
            else if (loc3 >= 1024 && loc3 < 10240) 
            {
                loc4 = loc4 + "1024kbps_10mbps";
            }
            else if (loc3 >= 10240 && loc3 < 20480) 
            {
                loc4 = loc4 + "10mbps_20mbps";
            }
            else if (loc3 >= 20480 && loc3 < 40960) 
            {
                loc4 = loc4 + "20mbps_40mbps";
            }
            else if (loc3 >= 40960 && loc3 < 61440) 
            {
                loc4 = loc4 + "40mbps_60mbps";
            }
            else if (loc3 >= 61440) 
            {
                loc4 = loc4 + "over_60mbps";
            }
            else 
            {
                loc4 = loc4 + "unknown";
            }
            this._externalData.setValue("averagespeed", loc4);
            Debugger.trace("SystemLoader.loadTimeComplete.kbps: " + loc4, "SYSTEM");
            flash.external.ExternalInterface.call("onAverageSpeed", loc4);
            return;
        }

        internal function get loaderProgressBar():flash.display.Sprite
        {
            return this._loaderProgressArt["percBar"]["bar"] as flash.display.Sprite;
        }

        internal function handleFileError(arg1:String):void
        {
            flash.external.ExternalInterface.call("onMissingSystemFile", arg1);
            return;
        }

        public function getVersionedFilename(arg1:String):String
        {
            var filename:String;
            var v:String;

            var loc1:*;
            filename = arg1;
            v = "";
            if (this._dependencies != null) 
            {
                var loc3:*=0;
                var loc4:*=this._dependencies.dependency;
                var loc2:*=new XMLList("");
                for each (var loc5:* in loc4) 
                {
                    var loc6:*;
                    with (loc6 = loc5) 
                    {
                        if (@file == filename.toLowerCase()) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                v = loc2.@etag;
                if (v.length > 0) 
                {
                    filename = filename + "?v=" + v;
                }
            }
            return filename;
        }

        internal function doPlayerBenchMark(arg1:int):void
        {
            this.runTest(arg1);
            return;
        }

        internal function runTest(arg1:int):void
        {
            var loc1:*=flash.utils.getTimer();
            var loc2:*=1;
            var loc3:*=1;
            var loc4:*=0;
            var loc5:*=0;
            while (loc5 < arg1) 
            {
                loc4 = loc4 + 1 / loc3 * (4 / (8 * loc5 + 1) - 2 / (8 * loc5 + 4) - 1 / (8 * loc5 + 5) - 1 / (8 * loc5 + 6) - 1 / (8 * loc5 + 7) - 1 / (8 * loc5 + 8) - 1 / (8 * loc5 + 9) - 1 / (8 * loc5 + 10) - 1 / (8 * loc5 + 11));
                loc3 = loc3 * 16;
                ++loc5;
            }
            var loc6:*=flash.utils.getTimer() - loc1;
            var loc7:*=Math.floor(1 / loc6 * 1000);
            this._performance = Math.round(loc7 / this._documentFPS * 100);
            this._externalData.setValue("performancerating", String(this._performance));
            return;
        }

        internal function JStoSWFCommsTest():void
        {
            Debugger.trace("JStoSWFCommsTest success!", "SYSTEM");
            return;
        }

        internal function updateExternalData(arg1:Object):void
        {
            var loc1:*=null;
            if (this._externalData != null) 
            {
                var loc2:*=0;
                var loc3:*=arg1;
                for (loc1 in loc3) 
                {
                    this._externalData.setValue(loc1, arg1[loc1]);
                }
            }
            if (this._core != null) 
            {
                this._core.updateExternalData(arg1);
            }
            return;
        }

        public override function gotoAndStop(arg1:Object, arg2:String=null):void
        {
            var loc1:*=String(this._externalData.getValue("issgi", "false")).toLowerCase();
            var loc2:*=arg1.toString();
            switch (loc2) 
            {
                case mgs.aurora.modules.loader.enums.LoaderFrameLabels.FRAME_DEMO_REAL:
                {
                    if (loc1 == "false") 
                    {
                        this.loadLoaderProgressArt();
                    }
                    break;
                }
                case mgs.aurora.modules.loader.enums.LoaderFrameLabels.FRAME_ONE:
                {
                    if (loc1 == "false") 
                    {
                        this.loadLoaderProgressArt();
                    }
                    break;
                }
                case mgs.aurora.modules.loader.enums.LoaderFrameLabels.FRAME_GAME:
                {
                    if (loc1 == "false") 
                    {
                        this.loadLoaderProgressArt();
                    }
                    break;
                }
                default:
                {
                    break;
                }
            }
            return;
        }

        public function initGame(arg1:com.orbis.load.IPreloader, arg2:flash.display.DisplayObjectContainer, arg3:com.orbis.ui.topbar.ITopBar):void
        {
            this._topbar = arg3;
            this._stageOwner = arg2;
            this._tbPreloderAssets = arg1;
            addEventListener(flash.events.Event.ADDED_TO_STAGE, this.addedToStage);
            arg2.addChildAt(this, 1);
            return;
        }

        internal function addedToStage(arg1:flash.events.Event):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=null;
            var loc7:*=null;
            removeEventListener(flash.events.Event.ADDED_TO_STAGE, this.addedToStage);
            this._topBarController = new mgs.aurora.common.orbis.TopBarController();
            this.getExternalData();
            var loc1:*=String(this._externalData.getValue("issgi", "false")).toLowerCase();
            if (loc1 != "false") 
            {
                this.stage.frameRate = 25;
                loc2 = this._stageOwner.getChildAt(0);
                loc2.visible = false;
                this._topBarController.addEventListener(mgs.aurora.common.events.sgi.SgiEvent.DEMO_PLAY, this.demoPlayClicked);
                this._topBarController.addEventListener(mgs.aurora.common.events.sgi.SgiEvent.REAL_PLAY, this.realPlayClicked);
                this._topBarController.addEventListener(mgs.aurora.common.events.sgi.SgiEvent.UILOADED, this.UILoaded);
                this._topBarController.addEventListener(mgs.aurora.common.events.sgi.SgiEvent.PLAYFORREAL, this.onPlayforReal);
                this._topBarController.addEventListener(mgs.aurora.common.events.sgi.SgiEvent.CHANGESOUND, this.SoundChanged);
                this._topBarController.setTopbar(this._topbar);
                loc3 = this._stageOwner.loaderInfo.parameters;
                this._externalData.setValue("gameid", loc3.gameID);
                loc4 = this._tbPreloderAssets.getPreloaderXML();
                if ((loc5 = String(loc4.game_settings.logged_in)) != "") 
                {
                    loc3.loggedIn = loc5;
                }
                if ((loc6 = String(loc4.game_settings.skip)) != "") 
                {
                    loc3.skip = loc6;
                }
                if ((loc7 = String(loc4.game_settings.play_mode)) != "") 
                {
                    loc3.playMode = loc7;
                }
                else 
                {
                    loc3.playMode = loc3.gameDataParams;
                }
                if (this._externalData.getValue("reverseproxy") == "1") 
                {
                    loc3.sPath = null;
                }
                this._topBarController.initSettings(loc3);
                this._topBarController.gameName = this._externalData.getValue("gameid");
                this._topbar.setController(this._topBarController);
                this._topbar.updateSetting("realPlay", undefined);
                this._topbar.layout();
            }
            return;
        }

        public function SoundChanged(arg1:mgs.aurora.common.events.sgi.SgiEvent):void
        {
            return;
        }

        public function realPlayClicked(arg1:mgs.aurora.common.events.sgi.SgiEvent):void
        {
            this._topBarController.removeEventListener(mgs.aurora.common.events.sgi.SgiEvent.REAL_PLAY, this.realPlayClicked);
            this._topBarController.removeEventListener(mgs.aurora.common.events.sgi.SgiEvent.DEMO_PLAY, this.demoPlayClicked);
            this._loginType = "REAL";
            this._externalData.setValue("authtoken", this._topBarController.token);
            this.loadLoaderProgressArt();
            return;
        }

        public function demoPlayClicked(arg1:mgs.aurora.common.events.sgi.SgiEvent):void
        {
            this._topBarController.removeEventListener(mgs.aurora.common.events.sgi.SgiEvent.REAL_PLAY, this.realPlayClicked);
            this._topBarController.removeEventListener(mgs.aurora.common.events.sgi.SgiEvent.DEMO_PLAY, this.demoPlayClicked);
            this._loginType = "DEMO";
            this.loadLoaderProgressArt();
            return;
        }

        public function UILoaded(arg1:mgs.aurora.common.events.sgi.SgiEvent):void
        {
            var loc2:*=null;
            var loc3:*=null;
            this._topBarController.removeEventListener(mgs.aurora.common.events.sgi.SgiEvent.UILOADED, this.UILoaded);
            this._stageOwner.swapChildrenAt(0, 1);
            this._sgiTimer = new flash.utils.Timer(100, 1);
            this._sgiTimer.start();
            this._sgiTimer.addEventListener(flash.events.TimerEvent.TIMER_COMPLETE, this.showTopbar);
            var loc1:*=this._stageOwner.loaderInfo.parameters.showGameLogo == "1";
            if (loc1) 
            {
                loc2 = "sgi/gamelogo/" + this._externalData.getValue("gameID") + "GameLogo.swf";
                loc3 = new flash.net.URLRequest(loc2);
                this._topbar.setGameLogo(loc3.url);
            }
            return;
        }

        public function showTopbar(arg1:flash.events.TimerEvent):void
        {
            this._sgiTimer.stop();
            this._sgiTimer.removeEventListener(flash.events.TimerEvent.TIMER_COMPLETE, this.showTopbar);
            this._sgiTimer = null;
            var loc1:*=this._stageOwner.getChildAt(1);
            loc1.visible = true;
            this._topBarController.checkforSkip();
            return;
        }

        public function onPlayforReal(arg1:mgs.aurora.common.events.sgi.SgiEvent):void
        {
            this._topBarController.addEventListener(mgs.aurora.common.events.sgi.SgiEvent.REAL_PLAY, this.realPlayClicked);
            this._topBarController.addEventListener(mgs.aurora.common.events.sgi.SgiEvent.DEMO_PLAY, this.demoPlayClicked);
            if (this._core == null) 
            {
                if (this._loaderProgressArt != null) 
                {
                    this.removeChild(this._loaderProgressArt);
                }
                this._loader.close();
            }
            return;
        }

        internal function continueCasinoLoad():void
        {
            this.gotoAndStop(mgs.aurora.modules.loader.enums.LoaderFrameLabels.FRAME_GAME);
            return;
        }

        internal function setupDebugging():void
        {
            var loc1:*=null;
            Debugger.ALLOW = this._externalData.getValue("debug", "false") == "true";
            if (Debugger.ALLOW) 
            {
                var loc2:*=this._externalData.getValue("debugtype", "1");
                switch (loc2) 
                {
                    case "0":
                    {
                        Debugger.USE_FLASHDEVELOP = true;
                        break;
                    }
                    case "1":
                    {
                        Debugger.USE_MONSTER = true;
                        Debugger.clearTraces();
                        Debugger.createMonsterDebugger(this);
                        break;
                    }
                }
                this.startLoadLevels();
                loc2 = 0;
                var loc3:*=stage.loaderInfo.parameters;
                for (loc1 in loc3) 
                {
                    Debugger.trace("param - " + loc1 + ", " + stage.loaderInfo.parameters[loc1], "SYSTEM");
                }
            }
            else 
            {
                this.setupTopBarReflectionRules();
            }
            return;
        }

        internal function startLoadDependencies():void
        {
            this._urlLoader = new flash.net.URLLoader();
            this._urlLoader.addEventListener(flash.events.Event.COMPLETE, this.onDependenciesLoaded);
            this._urlLoader.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onDependenciesLoadedError);
            var loc1:*="?system=aurora";
            if (this._externalData.getValue("theme", "") != "") 
            {
                loc1 = loc1 + ("&theme=" + this._externalData.getValue("theme", ""));
            }
            if (this._externalData.getValue("variant", "") != "") 
            {
                loc1 = loc1 + ("&variant=" + this._externalData.getValue("variant", ""));
            }
            if (this._externalData.getValue("regmarket", "") != "") 
            {
                loc1 = loc1 + ("&regMarket=" + this._externalData.getValue("regmarket", ""));
            }
            if (this._externalData.getValue("ul", "") != "") 
            {
                loc1 = loc1 + ("&ul=" + this._externalData.getValue("ul", ""));
            }
            var loc2:*=new flash.net.URLRequest("System/Aurora/Dependencies.ashx" + loc1);
            loc2.method = flash.net.URLRequestMethod.GET;
            this._urlLoader.load(loc2);
            return;
        }

        internal function onCoreLoadError(arg1:flash.events.IOErrorEvent):void
        {
            this.handleFileError("Core.swf");
            this._loader.contentLoaderInfo.removeEventListener(flash.events.Event.INIT, this.onCoreLoaded);
            this._loader.contentLoaderInfo.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onCoreLoadProgress);
            this._loader.contentLoaderInfo.removeEventListener(flash.events.ProgressEvent.PROGRESS, this.onCoreLoadProgress);
            return;
        }

        internal function startLoadCombinedSettings():void
        {
            var loc6:*=null;
            var loc1:*="";
            var loc2:*=String(this._externalData.getValue("issgi", "false")).toLowerCase();
            if (loc2 != "false") 
            {
                loc6 = this._stageOwner.loaderInfo.parameters;
                this._externalData.setValue("gameid", loc6.gameID);
            }
            loc1 = this._externalData.getValue("gameid", "");
            this._urlLoader = new flash.net.URLLoader();
            this._urlLoader.addEventListener(flash.events.Event.COMPLETE, this.onCombinedSettingsLoaded);
            this._urlLoader.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onCombinedSettingsLoadedError);
            var loc3:*="";
            var loc4:*="CombinedDependencies.ashx?gameId=" + loc1 + "&system=aurora";
            if (this._externalData.getValue("ul", "") != "") 
            {
                loc3 = loc3 + ("&ul=" + this._externalData.getValue("ul", ""));
            }
            if (this._externalData.getValue("theme", "") != "") 
            {
                loc3 = loc3 + ("&theme=" + this._externalData.getValue("theme", ""));
            }
            if (this._externalData.getValue("variant", "") != "") 
            {
                loc3 = loc3 + ("&variant=" + this._externalData.getValue("variant", ""));
            }
            if (this._externalData.getValue("regmarket", "") != "") 
            {
                loc3 = loc3 + ("&regMarket=" + this._externalData.getValue("regmarket", ""));
            }
            loc4 = loc4 + loc3;
            var loc5:*;
            (loc5 = new flash.net.URLRequest(loc4)).method = flash.net.URLRequestMethod.GET;
            this._urlLoader.load(loc5);
            return;
        }

        internal function onCombinedSettingsLoadedError(arg1:flash.events.IOErrorEvent):void
        {
            this._urlLoader.removeEventListener(flash.events.Event.COMPLETE, this.onGameSettingsLoaded);
            this._urlLoader.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onGameSettingsLoadedError);
            return;
        }

        internal function onCombinedSettingsLoaded(arg1:flash.events.Event):void
        {
            var loc1:*=null;
            this._urlLoader.removeEventListener(flash.events.Event.COMPLETE, this.onCombinedSettingsLoaded);
            this._urlLoader.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onCombinedSettingsLoadedError);
            XML.ignoreWhitespace = true;
            XML.ignoreComments = true;
            if (this._urlLoader.data.toString() != "") 
            {
                this._externalData.setValue("__combinedsettings__", this._urlLoader.data.toString());
            }
            loc1 = XML(this._urlLoader.data.toString());
            this._dependencies = new XML(loc1.systemDependencies);
            this.setupDebugging();
            return;
        }

        internal function onGameSettingsLoaded(arg1:flash.events.Event):void
        {
            this._urlLoader.removeEventListener(flash.events.Event.COMPLETE, this.onGameSettingsLoaded);
            this._urlLoader.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onGameSettingsLoadedError);
            XML.ignoreWhitespace = true;
            XML.ignoreComments = true;
            if (!(this._urlLoader.data == undefined) || !(this._urlLoader.data.toString() == "")) 
            {
                this._externalData.setValue("__gamesettings__", this._urlLoader.data.toString());
            }
            return;
        }

        internal function onGameSettingsLoadedError(arg1:flash.events.IOErrorEvent):void
        {
            this._urlLoader.removeEventListener(flash.events.Event.COMPLETE, this.onGameSettingsLoaded);
            this._urlLoader.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onGameSettingsLoadedError);
            return;
        }

        internal function onDependenciesLoaded(arg1:flash.events.Event):void
        {
            this._urlLoader.removeEventListener(flash.events.Event.COMPLETE, this.onLevelsLoaded);
            this._urlLoader.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onLevelsLoadedError);
            XML.ignoreWhitespace = true;
            XML.ignoreComments = true;
            this._externalData.setValue("__combinedsettings__", this._urlLoader.data.toString());
            this._dependencies = new XML(this._urlLoader.data);
            this.setupDebugging();
            this.startLoadGameSettings();
            return;
        }

        internal function onDependenciesLoadedError(arg1:flash.events.IOErrorEvent):void
        {
            this._urlLoader.removeEventListener(flash.events.Event.COMPLETE, this.onLevelsLoaded);
            this._urlLoader.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onLevelsLoadedError);
            return;
        }

        internal function setupTopBarReflectionRules():void
        {
            var loc1:*=this._externalData.getValue("issgi", "false") == "true";
            if (loc1) 
            {
                this.startLoadTopbarReflection();
            }
            else 
            {
                this.continueCasinoLoad();
            }
            return;
        }

        internal function startLoadLevels():void
        {
            this._urlLoader = new flash.net.URLLoader();
            this._urlLoader.addEventListener(flash.events.Event.COMPLETE, this.onLevelsLoaded);
            this._urlLoader.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onLevelsLoadedError);
            var loc1:*=this._externalData.getValue("debugLevels", "levels.xml");
            this._urlLoader.load(new flash.net.URLRequest("System/Aurora/" + this.getVersionedFilename(loc1)));
            return;
        }

        internal function onLevelsLoadedError(arg1:flash.events.Event):void
        {
            this._urlLoader.removeEventListener(flash.events.Event.COMPLETE, this.onLevelsLoaded);
            this._urlLoader.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onLevelsLoadedError);
            this.setupTopBarReflectionRules();
            return;
        }

        internal function onLevelsLoaded(arg1:flash.events.Event):void
        {
            this._urlLoader.removeEventListener(flash.events.Event.COMPLETE, this.onLevelsLoaded);
            this._urlLoader.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onLevelsLoadedError);
            XML.ignoreWhitespace = true;
            XML.ignoreComments = true;
            var loc1:*=new XML(this._urlLoader.data);
            Debugger.setLevelsData(loc1);
            this.setupTopBarReflectionRules();
            return;
        }

        internal function startLoadTopbarReflection():void
        {
            this._urlLoader = new flash.net.URLLoader();
            this._urlLoader.addEventListener(flash.events.Event.COMPLETE, this.onTopbarReflectionLoaded);
            this._urlLoader.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onTopbarReflectionLoadedError);
            var loc1:*=this._externalData.getValue("topbarReflectionRulesURL", "TopBarReflection.xml");
            this._urlLoader.load(new flash.net.URLRequest("System/Aurora/" + this.getVersionedFilename(loc1)));
            return;
        }

        internal function onTopbarReflectionLoadedError(arg1:flash.events.Event):void
        {
            this._urlLoader.removeEventListener(flash.events.Event.COMPLETE, this.onTopbarReflectionLoaded);
            this._urlLoader.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onTopbarReflectionLoadedError);
            this.continueCasinoLoad();
            return;
        }

        internal var _core:mgs.aurora.common.interfaces.ICore;

        internal var _loaderProgressArt:flash.display.Sprite;

        internal var _externalData:mgs.aurora.common.interfaces.IExternalData;

        internal var _loader:flash.display.Loader;

        internal var _urlLoader:flash.net.URLLoader;

        internal var _topBarController:mgs.aurora.common.orbis.TopBarController;

        internal var _topbar:com.orbis.ui.topbar.ITopBar;

        internal var _tbPreloderAssets:com.orbis.load.IPreloader;

        internal var _loginType:String;

        internal var _gamelogoLoader:flash.display.Loader;

        internal var _sgiTimer:flash.utils.Timer;

        internal var _topbarOffset:uint;

        internal var _topbarReflectionRules:XML;

        internal var _dependencies:XML;

        internal var _gameSettings:XML;

        internal var _scaleManger:mgs.aurora.common.scale.ScaleManager;

        internal var _documentFPS:Number;

        internal var _performance:Number=0;

        internal var _startTime:Date;

        internal var _stageOwner:flash.display.DisplayObjectContainer;
    }
}


//  package org
//    package flashdevelop
//      package utils
//        class FlashConnect
package org.flashdevelop.utils 
{
    import flash.events.*;
    import flash.net.*;
    import flash.utils.*;
    import flash.xml.*;
    
    public class FlashConnect extends Object
    {
        public function FlashConnect()
        {
            super();
            return;
        }

        public static function send(arg1:flash.xml.XMLNode):void
        {
            if (messages == null) 
            {
                initialize();
            }
            messages.push(arg1);
            return;
        }

        public static function trace(arg1:Object, arg2:Number=1):void
        {
            var loc1:*=createMsgNode(arg1.toString(), arg2);
            org.flashdevelop.utils.FlashConnect.send(loc1);
            return;
        }

        public static function atrace(... rest):void
        {
            var loc1:*=rest.join(",");
            var loc2:*=createMsgNode(loc1, org.flashdevelop.utils.TraceLevel.DEBUG);
            org.flashdevelop.utils.FlashConnect.send(loc2);
            return;
        }

        public static function mtrace(arg1:Object, arg2:String, arg3:String, arg4:Number):void
        {
            var loc1:*;
            var loc2:*=(loc1 = arg3.split("/").join("\\")) + ":" + arg4 + ":" + arg1;
            org.flashdevelop.utils.FlashConnect.trace(loc2, org.flashdevelop.utils.TraceLevel.DEBUG);
            return;
        }

        public static function flush():Boolean
        {
            if (status) 
            {
                sendStack();
                return true;
            }
            return false;
        }

        public static function initialize():int
        {
            if (socket) 
            {
                return status;
            }
            counter = 0;
            messages = new Array();
            socket = new flash.net.XMLSocket();
            socket.addEventListener(flash.events.Event.CLOSE, onClose);
            socket.addEventListener(flash.events.DataEvent.DATA, onData);
            socket.addEventListener(flash.events.Event.CONNECT, onConnect);
            socket.addEventListener(flash.events.IOErrorEvent.IO_ERROR, onIOError);
            socket.addEventListener(flash.events.SecurityErrorEvent.SECURITY_ERROR, onSecurityError);
            interval = flash.utils.setInterval(sendStack, 50);
            socket.connect(host, port);
            return status;
        }

        internal static function onData(arg1:flash.events.DataEvent):void
        {
            org.flashdevelop.utils.FlashConnect.status = 1;
            if (org.flashdevelop.utils.FlashConnect.onReturnData != null) 
            {
                org.flashdevelop.utils.FlashConnect.onReturnData(arg1.data);
            }
            return;
        }

        internal static function onClose(arg1:flash.events.Event):void
        {
            socket = null;
            org.flashdevelop.utils.FlashConnect.status = -1;
            if (org.flashdevelop.utils.FlashConnect.onConnection != null) 
            {
                org.flashdevelop.utils.FlashConnect.onConnection();
            }
            return;
        }

        internal static function onConnect(arg1:flash.events.Event):void
        {
            org.flashdevelop.utils.FlashConnect.status = 1;
            if (org.flashdevelop.utils.FlashConnect.onConnection != null) 
            {
                org.flashdevelop.utils.FlashConnect.onConnection();
            }
            return;
        }

        internal static function onIOError(arg1:flash.events.IOErrorEvent):void
        {
            org.flashdevelop.utils.FlashConnect.status = -1;
            if (org.flashdevelop.utils.FlashConnect.onConnection != null) 
            {
                org.flashdevelop.utils.FlashConnect.onConnection();
            }
            return;
        }

        internal static function onSecurityError(arg1:flash.events.SecurityErrorEvent):void
        {
            org.flashdevelop.utils.FlashConnect.status = -1;
            if (org.flashdevelop.utils.FlashConnect.onConnection != null) 
            {
                org.flashdevelop.utils.FlashConnect.onConnection();
            }
            return;
        }

        internal static function createMsgNode(arg1:String, arg2:Number):flash.xml.XMLNode
        {
            if (isNaN(arg2)) 
            {
                arg2 = org.flashdevelop.utils.TraceLevel.DEBUG;
            }
            var loc1:*=new flash.xml.XMLNode(1, null);
            var loc2:*=new flash.xml.XMLNode(3, encodeURI(arg1));
            loc1.attributes.state = arg2.toString();
            loc1.attributes.cmd = "trace";
            loc1.nodeName = "message";
            loc1.appendChild(loc2);
            return loc1;
        }

        internal static function sendStack():void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=null;
            if (messages.length > 0 && status == 1) 
            {
                loc1 = new flash.xml.XMLDocument();
                loc2 = loc1.createElement("flashconnect");
                while (messages.length != 0) 
                {
                    var loc6:*;
                    counter++;
                    if (counter > limit) 
                    {
                        flash.utils.clearInterval(interval);
                        loc3 = new String("FlashConnect aborted. You have reached the limit of maximum messages.");
                        loc4 = createMsgNode(loc3, org.flashdevelop.utils.TraceLevel.ERROR);
                        loc2.appendChild(loc4);
                        messages = new Array();
                        break;
                    }
                    loc5 = flash.xml.XMLNode(messages.shift());
                    loc2.appendChild(loc5);
                }
                loc1.appendChild(loc2);
                if (socket && socket.connected) 
                {
                    socket.send(loc1);
                }
                counter = 0;
            }
            return;
        }

        
        {
            status = 0;
            limit = 1000;
            host = "127.0.0.1";
            port = 1978;
        }

        public static var status:Number=0;

        public static var limit:Number=1000;

        public static var host:String="127.0.0.1";

        public static var port:Number=1978;

        internal static var socket:flash.net.XMLSocket;

        internal static var messages:Array;

        internal static var interval:Number;

        internal static var counter:Number;

        public static var onConnection:Function;

        public static var onReturnData:Function;
    }
}


//        class FlashViewer
package org.flashdevelop.utils 
{
    import flash.system.*;
    
    public class FlashViewer extends Object
    {
        public function FlashViewer()
        {
            super();
            return;
        }

        public static function trace(arg1:Object, arg2:Number=1):void
        {
            var loc1:*=null;
            var loc2:*;
            counter++;
            if (counter > limit && !aborted) 
            {
                aborted = true;
                loc1 = "FlashViewer aborted. You have reached the limit of maximum messages.";
                flash.system.fscommand("trace", "3:" + loc1);
            }
            if (!aborted) 
            {
                flash.system.fscommand("trace", arg2 + ":" + arg1);
            }
            return;
        }

        public static function mtrace(arg1:Object, arg2:String, arg3:String, arg4:Number):void
        {
            var loc1:*;
            var loc2:*=(loc1 = arg3.split("/").join("\\")) + ":" + arg4 + ":" + arg1;
            FlashViewer.trace(loc2, org.flashdevelop.utils.TraceLevel.DEBUG);
            return;
        }

        public static function atrace(... rest):void
        {
            var loc1:*=rest.join(",");
            FlashViewer.trace(loc1, org.flashdevelop.utils.TraceLevel.DEBUG);
            return;
        }

        
        {
            limit = 1000;
            counter = 0;
            aborted = false;
        }

        public static var limit:Number=1000;

        internal static var counter:Number=0;

        internal static var aborted:Boolean=false;
    }
}


//        class TraceLevel
package org.flashdevelop.utils 
{
    public class TraceLevel extends Object
    {
        public function TraceLevel()
        {
            super();
            return;
        }

        public static const INFO:Number=0;

        public static const DEBUG:Number=1;

        public static const WARNING:Number=2;

        public static const ERROR:Number=3;

        public static const FATAL:Number=4;
    }
}


//  class Debugger
package 
{
    import com.demonsters.debugger.*;
    import flash.external.*;
    import flash.utils.*;
    import org.flashdevelop.utils.*;
    
    public class Debugger extends Object
    {
        public function Debugger()
        {
            super();
            return;
        }

        public static function createMonsterDebugger(arg1:Object):void
        {
            if (ALLOW) 
            {
                com.demonsters.debugger.MonsterDebugger.initialize(arg1);
            }
            return;
        }

        public static function clearTraces():void
        {
            com.demonsters.debugger.MonsterDebugger.clear();
            return;
        }

        public static function trace(arg1:*, arg2:String="", arg3:Object=null, arg4:uint=1118481):void
        {
            var loc1:*=undefined;
            arg2 = arg2 != null ? arg2 : "";
            if (Debugger.ALLOW == false) 
            {
                return;
            }
            if (Debugger.doLevelfilter) 
            {
                if (!(Debugger.onlyAllowed && Debugger.levels[arg2.toLowerCase()])) 
                {
                    return;
                }
                if (Debugger.levels[arg2.toLowerCase()] == null || Debugger.levels[arg2.toLowerCase()] == undefined) 
                {
                    return;
                }
            }
            if (Debugger.doLevelfilter) 
            {
                arg4 = !(Debugger.levelColors[arg2.toLowerCase()] == undefined) && arg4 == 1118481 ? Debugger.levelColors[arg2.toLowerCase()] : arg4;
            }
            arg2 = arg2 != "" ? "[" + arg2 + "]" : arg2;
            if (USE_MONSTER) 
            {
                loc1 = arg2.length > 0 && typeof arg1 == "string" && Debugger.showLevel ? arg2 + " : " + arg1 : arg1;
                com.demonsters.debugger.MonsterDebugger.trace(arg3, loc1, null, null, arg4);
            }
            else if (USE_IDE_TRACE) 
            {
                trace(arg1.toString());
            }
            else if (USE_FIREBUG) 
            {
                flash.external.ExternalInterface.call("console." + arg2, arg1.toString());
            }
            else 
            {
                org.flashdevelop.utils.FlashConnect.trace(arg1, Number(arg2));
            }
            return;
        }

        public static function setLevelsData(arg1:XML):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            Debugger.levels = new flash.utils.Dictionary();
            Debugger.levelColors = new flash.utils.Dictionary();
            var loc4:*=0;
            var loc5:*=arg1.level;
            for each (loc1 in loc5) 
            {
                loc2 = loc1.@id.toString().toLowerCase();
                loc3 = loc1.@allow.toString();
                if (loc1.@color.length() == 1) 
                {
                    Debugger.levelColors[loc2] = parseInt(loc1.@color.toString(), 16);
                }
                Debugger.levels[loc2] = loc3 == "1";
            }
            Debugger.onlyAllowed = arg1.@showOnlyAllowed.toString() == "1";
            Debugger.doLevelfilter = arg1.@filter.toString() == "1";
            Debugger.showLevel = arg1.@showLevel.toString() == "1";
            return;
        }

        
        {
            USE_FLASHDEVELOP = true;
            USE_FIREBUG = false;
            USE_IDE_TRACE = false;
            USE_MONSTER = false;
            ALLOW = false;
            doLevelfilter = false;
            onlyAllowed = false;
            showLevel = false;
        }

        public static var USE_FLASHDEVELOP:Boolean=true;

        public static var USE_FIREBUG:Boolean=false;

        public static var USE_IDE_TRACE:Boolean=false;

        public static var USE_MONSTER:Boolean=false;

        public static var ALLOW:Boolean=false;

        internal static var doLevelfilter:Boolean=false;

        internal static var levels:flash.utils.Dictionary;

        internal static var levelColors:flash.utils.Dictionary;

        internal static var onlyAllowed:Boolean=false;

        internal static var showLevel:Boolean=false;
    }
}


//  class Logger
package 
{
    import com.demonsters.debugger.*;
    import flash.external.*;
    import flash.system.*;
    import org.flashdevelop.utils.*;
    
    public class Logger extends Object
    {
        public function Logger()
        {
            super();
            return;
        }

        public static function memorySnapshot():void
        {
            var loc1:*=flash.system.System.totalMemory;
            var loc2:*="Memory Snapshot: " + Math.round(loc1 / 1024 / 1024 * 100) / 100 + " MB (" + Math.round(loc1 / 1024) + " kb)";
            logMessage(loc2, INFO);
            return;
        }

        public static function createMonsterDebugger(arg1:Object):void
        {
            if (DO_LOGGING) 
            {
                com.demonsters.debugger.MonsterDebugger.initialize(arg1);
            }
            return;
        }

        public static function logMessage(arg1:*, arg2:String="", arg3:Object=null):void
        {
            var loc1:*=null;
            if (DO_LOGGING == false) 
            {
                return;
            }
            if (USE_MONSTER) 
            {
                loc1 = arg2 + " : " + arg1;
                com.demonsters.debugger.MonsterDebugger.trace(arg3, loc1);
            }
            else if (USE_IDE_TRACE) 
            {
                trace(arg1.toString());
            }
            else if (USE_FIREBUG) 
            {
                flash.external.ExternalInterface.call("console." + arg2, arg1.toString());
            }
            else 
            {
                org.flashdevelop.utils.FlashConnect.trace(arg1, Number(arg2));
            }
            return;
        }

        
        {
            USE_FLASHDEVELOP = true;
            USE_FIREBUG = false;
            USE_IDE_TRACE = false;
            USE_MONSTER = false;
            DO_LOGGING = false;
            TRACE_FILTER = TRACE_ALL;
        }

        public static const INFO:String="info";

        public static const WARN:String="warn";

        public static const ERROR:String="error";

        public static const LOG:String="log";

        public static const TRACE_ALL:String="trace_all";

        public static var USE_FLASHDEVELOP:Boolean=true;

        public static var USE_FIREBUG:Boolean=false;

        public static var USE_IDE_TRACE:Boolean=false;

        public static var USE_MONSTER:Boolean=false;

        public static var DO_LOGGING:Boolean=false;

        public static var TRACE_FILTER:String="trace_all";
    }
}


//  class _6a7454bb97abbdc00bdca2739e7de988f02ddaa9ae373f0d1cf06157acc74b83_flash_display_Sprite
package 
{
    import flash.display.*;
    import flash.system.*;
    
    public class _6a7454bb97abbdc00bdca2739e7de988f02ddaa9ae373f0d1cf06157acc74b83_flash_display_Sprite extends flash.display.Sprite
    {
        public function _6a7454bb97abbdc00bdca2739e7de988f02ddaa9ae373f0d1cf06157acc74b83_flash_display_Sprite()
        {
            super();
            return;
        }

        public function allowDomainInRSL(... rest):void
        {
            flash.system.Security.allowDomain(rest);
            return;
        }

        public function allowInsecureDomainInRSL(... rest):void
        {
            flash.system.Security.allowInsecureDomain(rest);
            return;
        }
    }
}


//  class _90f43c89438b4dcdaa10bc8fca400fa3d85c11ba15f327e5e03f0dc0ddca2b0d_flash_display_Sprite
package 
{
    import flash.display.*;
    import flash.system.*;
    
    public class _90f43c89438b4dcdaa10bc8fca400fa3d85c11ba15f327e5e03f0dc0ddca2b0d_flash_display_Sprite extends flash.display.Sprite
    {
        public function _90f43c89438b4dcdaa10bc8fca400fa3d85c11ba15f327e5e03f0dc0ddca2b0d_flash_display_Sprite()
        {
            super();
            return;
        }

        public function allowDomainInRSL(... rest):void
        {
            Security.allowDomain(rest);
            return;
        }

        public function allowInsecureDomainInRSL(... rest):void
        {
            Security.allowInsecureDomain(rest);
            return;
        }
    }
}


//  class _fa8e2b4e561453951730e65f840c2f41a48f8defebb3f3dcf61db38866db3f25_flash_display_Sprite
package 
{
    import flash.display.*;
    import flash.system.*;
    
    public class _fa8e2b4e561453951730e65f840c2f41a48f8defebb3f3dcf61db38866db3f25_flash_display_Sprite extends flash.display.Sprite
    {
        public function _fa8e2b4e561453951730e65f840c2f41a48f8defebb3f3dcf61db38866db3f25_flash_display_Sprite()
        {
            super();
            return;
        }

        public function allowDomainInRSL(... rest):void
        {
            flash.system.Security.allowDomain(rest);
            return;
        }

        public function allowInsecureDomainInRSL(... rest):void
        {
            flash.system.Security.allowInsecureDomain(rest);
            return;
        }
    }
}


