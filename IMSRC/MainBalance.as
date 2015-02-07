//ActionScript 3.0
//  package com
//    package encode
//      class Base64
package com.encode 
{
    import flash.utils.*;
    
    public class Base64 extends Object
    {
        public function Base64()
        {
            super();
            throw new Error("Base64 class is static container only");
        }

        public static function encode(arg1:String):String
        {
            var loc1:*=new flash.utils.ByteArray();
            loc1.writeUTFBytes(arg1);
            return encodeByteArray(loc1);
        }

        public static function encodeByteArray(arg1:flash.utils.ByteArray):String
        {
            var loc2:*=null;
            var loc4:*=0;
            var loc5:*=0;
            var loc6:*=0;
            var loc1:*="";
            var loc3:*=new Array(4);
            arg1.position = 0;
            while (arg1.bytesAvailable > 0) 
            {
                loc2 = new Array();
                loc4 = 0;
                while (loc4 < 3 && arg1.bytesAvailable > 0) 
                {
                    loc2[loc4] = arg1.readUnsignedByte();
                    ++loc4;
                }
                loc3[0] = (loc2[0] & 252) >> 2;
                loc3[1] = (loc2[0] & 3) << 4 | loc2[1] >> 4;
                loc3[2] = (loc2[1] & 15) << 2 | loc2[2] >> 6;
                loc3[3] = loc2[2] & 63;
                loc5 = loc2.length;
                while (loc5 < 3) 
                {
                    loc3[loc5 + 1] = 64;
                    ++loc5;
                }
                loc6 = 0;
                while (loc6 < loc3.length) 
                {
                    loc1 = loc1 + BASE64_CHARS.charAt(loc3[loc6]);
                    ++loc6;
                }
            }
            return loc1;
        }

        public static function decode(arg1:String):String
        {
            var loc1:*=decodeToByteArray(arg1);
            return loc1.readUTFBytes(loc1.length);
        }

        public static function decodeToByteArray(arg1:String):flash.utils.ByteArray
        {
            var loc5:*=0;
            var loc6:*=0;
            var loc1:*=new flash.utils.ByteArray();
            var loc2:*=new Array(4);
            var loc3:*=new Array(3);
            var loc4:*=0;
            while (loc4 < arg1.length) 
            {
                loc5 = 0;
                while (loc5 < 4 && loc4 + loc5 < arg1.length) 
                {
                    loc2[loc5] = BASE64_CHARS.indexOf(arg1.charAt(loc4 + loc5));
                    ++loc5;
                }
                loc3[0] = (loc2[0] << 2) + ((loc2[1] & 48) >> 4);
                loc3[1] = ((loc2[1] & 15) << 4) + ((loc2[2] & 60) >> 2);
                loc3[2] = ((loc2[2] & 3) << 6) + loc2[3];
                loc6 = 0;
                while (loc6 < loc3.length) 
                {
                    if (loc2[loc6 + 1] == 64) 
                    {
                        break;
                    }
                    loc1.writeByte(loc3[loc6]);
                    ++loc6;
                }
                loc4 = loc4 + 4;
            }
            loc1.position = 0;
            return loc1;
        }

        public static const version:String="1.1.0";

        internal static const BASE64_CHARS:String="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    }
}


//    package mgs
//      package components
//        package tabnavigator
//          package events
//            class CustomTabEvent
package com.mgs.components.tabnavigator.events 
{
    import flash.events.*;
    
    public class CustomTabEvent extends flash.events.Event
    {
        public function CustomTabEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false, arg4:String=null, arg5:String=null)
        {
            super(arg1, arg2, arg3);
            this.itemName = arg4;
            this.itemLabel = arg5;
            return;
        }

        public function get itemName():String
        {
            return this._itemName;
        }

        public function set itemName(arg1:String):void
        {
            this._itemName = arg1;
            return;
        }

        public function get itemLabel():String
        {
            return this._itemLabel;
        }

        public function set itemLabel(arg1:String):void
        {
            this._itemLabel = arg1;
            return;
        }

        public override function toString():String
        {
            return formatToString("CustomTabEvent", "type", "bubbles", "cancelable", "eventPhase", "itemName", "itemLabel");
        }

        public override function clone():flash.events.Event
        {
            return new com.mgs.components.tabnavigator.events.CustomTabEvent(type, bubbles, cancelable, this.itemName, this.itemLabel);
        }

        public static const ITEM_SELECTED:String="itemSelected";

        internal var _itemName:String;

        internal var _itemLabel:String;
    }
}


//          class CustomTabNavigator
package com.mgs.components.tabnavigator 
{
    import com.mgs.components.tabnavigator.events.*;
    import fl.controls.*;
    import fl.core.*;
    import fl.data.*;
    import fl.events.*;
    import fl.managers.*;
    import flash.events.*;
    import flash.text.*;
    
    public class CustomTabNavigator extends fl.core.UIComponent implements fl.managers.IFocusManagerComponent
    {
        public function CustomTabNavigator()
        {
            this._itemButtons = new Array();
            super();
            return;
        }

        public function TabNavigator():*
        {
            if (this.dataProvider == null) 
            {
                this.dataProvider = new fl.data.DataProvider();
            }
            this.forceStyle();
            return;
        }

        internal function forceStyle():*
        {
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            return;
        }

        protected override function draw():void
        {
            var loc1:*=0;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc8:*=null;
            var loc9:*=NaN;
            var loc10:*=null;
            var loc11:*=null;
            var loc12:*=null;
            var loc13:*=NaN;
            var loc5:*=new Array();
            var loc6:*=0;
            var loc7:*=0;
            if (isInvalid(fl.core.InvalidationType.DATA)) 
            {
                (loc11 = new flash.text.TextFormat()).bold = true;
                loc11.size = 11;
                loc11.color = 7041148;
                loc11.font = "Arial";
                (loc12 = new flash.text.TextFormat()).bold = true;
                loc12.size = 11;
                loc12.color = 2236962;
                loc12.font = "Arial";
                loc1 = 0;
                while (loc1 < this._itemButtons.length) 
                {
                    fl.controls.Button(this._itemButtons[loc1]).removeEventListener(flash.events.MouseEvent.CLICK, this.handleClickEvent);
                    this.removeChild(this._itemButtons[loc1]);
                    ++loc1;
                }
                loc1 = 0;
                while (loc1 < this._dataProvider.length) 
                {
                    loc2 = this._dataProvider.getItemAt(loc1);
                    loc3 = new flash.text.TextField();
                    loc3.border = true;
                    loc3.text = loc2.label;
                    loc4 = loc3.getLineMetrics(0);
                    loc5.push(loc4.width);
                    loc6 = loc6 + loc4.width;
                    ++loc1;
                }
                loc1 = 0;
                while (loc1 < this._dataProvider.length) 
                {
                    loc9 = Math.floor(width / loc6 * loc5[loc1]);
                    loc2 = this._dataProvider.getItemAt(loc1);
                    loc8 = new fl.controls.Button();
                    if (loc1 != 0) 
                    {
                        loc8.setStyle("upSkin", Tab_upSkin);
                        loc8.setStyle("overSkin", Tab_overSkin);
                        loc8.setStyle("downSkin", Tab_downSkin);
                        loc8.setStyle("disabledSkin", Tab_disabledSkin);
                    }
                    else 
                    {
                        loc8.setStyle("upSkin", Tab_upSkin_left);
                        loc8.setStyle("overSkin", Tab_overSkin_left);
                        loc8.setStyle("downSkin", Tab_downSkin_left);
                        loc8.setStyle("disabledSkin", Tab_disabledSkin_left);
                    }
                    loc8.useHandCursor = true;
                    loc8.setStyle("selectedUpSkin", Tab_selectedUpSkin);
                    loc8.setStyle("selectedOverSkin", Tab_selectedOverSkin);
                    loc8.setStyle("selectedDownSkin", Tab_selectedDownSkin);
                    loc8.setStyle("selectedDisabledSkin", Tab_selectedDisabledSkin);
                    loc8.setStyle("focusRectSkin", Tab_focusRectSkin);
                    loc8.setStyle("textFormat", loc11);
                    loc8.setStyle("disabledTextFormat", loc12);
                    loc8.name = loc2.data;
                    loc8.addEventListener(flash.events.MouseEvent.CLICK, this.handleClickEvent);
                    loc8.label = loc2.label;
                    loc8.width = loc9;
                    loc8.height = this.height;
                    loc8.x = loc7;
                    loc8.textField.gridFitType = flash.text.GridFitType.NONE;
                    if (loc1 == this._selectedIndex) 
                    {
                        loc8.enabled = false;
                        loc10 = new com.mgs.components.tabnavigator.events.CustomTabEvent(com.mgs.components.tabnavigator.events.CustomTabEvent.ITEM_SELECTED, true, true, loc8.name, loc8.label);
                        dispatchEvent(loc10);
                    }
                    loc7 = loc7 + loc9;
                    this._itemButtons.push(loc8);
                    addChild(loc8);
                    loc8.drawNow();
                    ++loc1;
                }
                invalidate(fl.core.InvalidationType.ALL, false);
            }
            if (isInvalid(fl.core.InvalidationType.SELECTED)) 
            {
                loc13 = 0;
                var loc14:*=0;
                var loc15:*=this._itemButtons;
                for each (loc8 in loc15) 
                {
                    if (loc13 != this._selectedIndex) 
                    {
                        loc8.enabled = true;
                    }
                    else 
                    {
                        loc8.enabled = false;
                        loc10 = new com.mgs.components.tabnavigator.events.CustomTabEvent(com.mgs.components.tabnavigator.events.CustomTabEvent.ITEM_SELECTED, true, true, loc8.name, loc8.label);
                        dispatchEvent(loc10);
                    }
                    ++loc13;
                }
            }
            super.draw();
            return;
        }

        internal function handleClickEvent(arg1:flash.events.MouseEvent):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=arg1.currentTarget as fl.controls.Button;
            var loc4:*=0;
            var loc5:*=this._itemButtons;
            for each (loc2 in loc5) 
            {
                if (loc2 == loc1) 
                {
                    loc2.enabled = false;
                    continue;
                }
                loc2.enabled = true;
            }
            loc3 = new com.mgs.components.tabnavigator.events.CustomTabEvent(com.mgs.components.tabnavigator.events.CustomTabEvent.ITEM_SELECTED, true, true, loc1.name, loc1.label);
            dispatchEvent(loc3);
            return;
        }

        protected override function focusOutHandler(arg1:flash.events.FocusEvent):void
        {
            super.focusOutHandler(arg1);
            return;
        }

        public override function drawFocus(arg1:Boolean):void
        {
            super.drawFocus(arg1);
            if (arg1 && !(uiFocusRect == null)) 
            {
                setChildIndex(uiFocusRect, (numChildren - 1));
            }
            return;
        }

        protected override function keyDownHandler(arg1:flash.events.KeyboardEvent):void
        {
            return;
        }

        public function set selectedIndex(arg1:Number):void
        {
            this._selectedIndex = arg1;
            invalidate(fl.core.InvalidationType.SELECTED);
            return;
        }

        public function get selectedIndex():Number
        {
            return this._selectedIndex;
        }

        public function set dataProvider(arg1:fl.data.DataProvider):void
        {
            if (this._dataProvider != null) 
            {
                this._dataProvider.removeEventListener(fl.events.DataChangeEvent.DATA_CHANGE, this.handleDataChange);
            }
            this._dataProvider = arg1;
            this._dataProvider.addEventListener(fl.events.DataChangeEvent.DATA_CHANGE, this.handleDataChange, false, 0, true);
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        public function get dataProvider():fl.data.DataProvider
        {
            return this._dataProvider;
        }

        protected function handleDataChange(arg1:fl.events.DataChangeEvent):void
        {
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        protected var _dataProvider:fl.data.DataProvider;

        protected var _itemButtons:Array;

        protected var _selectedIndex:Number;
    }
}


//      package funbonus
//        package common
//          package enums
//            class FunBonusEnums
package com.mgs.funbonus.common.enums 
{
    public final class FunBonusEnums extends Object
    {
        public function FunBonusEnums()
        {
            super();
            return;
        }

        
        {
            BIA_INFORMATION = 1;
            BIA_COLLECTION = 2;
            BIA_SELECTION = 3;
            BIA_EXPIRY = 4;
            FUNBONUS_CONFIG = "funbonus.config";
            FUNBONUS_STRINGS = "funbonus.strings";
        }

        public static var FUNBONUS_CONFIG:String="funbonus.config";

        public static var BIA_COLLECTION:uint=2;

        public static var BIA_SELECTION:uint=3;

        public static var FUNBONUS_STRINGS:String="funbonus.strings";

        public static var BIA_INFORMATION:uint=1;

        public static var BIA_EXPIRY:uint=4;
    }
}


//          package events
//            class BonusPanelEvent
package com.mgs.funbonus.common.events 
{
    import flash.events.*;
    
    public class BonusPanelEvent extends flash.events.Event
    {
        public function BonusPanelEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false, arg4:Number=NaN)
        {
            super(arg1, arg2, arg3);
            this.bonusID = arg4;
            return;
        }

        public function set bonusID(arg1:Number):void
        {
            _bonusID = arg1;
            return;
        }

        public function get bonusID():Number
        {
            return _bonusID;
        }

        public override function toString():String
        {
            return formatToString("BonusPanelEvent", "type", "bubbles", "cancelable", "eventPhase", "bonusID");
        }

        public override function clone():flash.events.Event
        {
            return new com.mgs.funbonus.common.events.BonusPanelEvent(type, bubbles, cancelable, bonusID);
        }

        public static const SWITCHTOREALPLAY:String="BonusPanelEvent.SWITCHTOREALPLAY";

        public static const COLLECT_BONUS:String="BonusPanelEvent.COLLECT_BONUS";

        public static const SWITCHTOFUNBONUS:String="BonusPanelEvent.SWITCHTOFUNBONUS";

        public static const LOAD_TERMS_AND_CONDITIONS:String="BonusPanelEvent.LOAD_TERMS_AND_CONDITIONS";

        public static const FORFEIT_BONUS:String="BonusPanelEvent.FORFEIT_BONUS";

        public static const CLOSE_BONUS:String="BonusPanelEvent.CLOSE_BONUS";

        public static const LOAD_WHAT_IS_FUNBONUS:String="BonusPanelEvent.LOAD_WHAT_IS_FUNBONUS";

        internal var _bonusID:Number;
    }
}


//          package interfaces
//            class IFunBonus
package com.mgs.funbonus.common.interfaces 
{
    public interface IFunBonus
    {
        function packetReceived(arg1:uint, arg2:XML):void;

        function hide(arg1:uint=1):void;

        function setup(arg1:String, arg2:com.mgs.funbonus.common.interfaces.IFunBonusComs):void;

        function onHideSystem(arg1:Boolean=false, arg2:uint=1):void;

        function setCoordinates(arg1:int, arg2:int):void;

        function onShowSystem():void;

        function show(arg1:uint=1):void;
    }
}


//            class IFunBonusComs
package com.mgs.funbonus.common.interfaces 
{
    public interface IFunBonusComs
    {
        function getCasinoLoginStatus():int;

        function getCurrencyCode():String;

        function switchLogin(arg1:int):void;

        function requestBonusAction(arg1:uint, arg2:uint):void;

        function formatCurrency(arg1:int, arg2:String):String;

        function readConfigStringSKE(arg1:String, arg2:String, arg3:Number):String;

        function changeBonusOffer():void;

        function initExternalComs():void;

        function executeCasinoFrameCommand(arg1:String, arg2:String=""):void;
    }
}


//        package components
//          package dialogs
//            class DialogFactory
package com.mgs.funbonus.components.dialogs 
{
    import com.mgs.funbonus.system.*;
    import fl.controls.*;
    import fl.core.*;
    import flash.events.*;
    import flash.text.*;
    import org.osflash.signals.*;
    
    public class DialogFactory extends fl.core.UIComponent
    {
        public function DialogFactory(arg1:String, arg2:int=0)
        {
            this.panel_Dialog = new Panel_Dialog();
            this.acceptSignal = new org.osflash.signals.Signal();
            this.queuedSignal = new org.osflash.signals.Signal();
            this.cancelSignal = new org.osflash.signals.Signal();
            this.system = com.mgs.funbonus.system.System.getInstance();
            super();
            this._type = arg1;
            this._id = arg2;
            return;
        }

        internal function queuedButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.system.updateUIMode(com.mgs.funbonus.system.System.UI_DIALOG_CLOSE);
            this.queuedSignal.dispatch(this._id);
            return;
        }

        internal function yesButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.system.updateUIMode(com.mgs.funbonus.system.System.UI_DIALOG_CLOSE);
            this.acceptSignal.dispatch(this._id);
            return;
        }

        internal function noButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.system.updateUIMode(com.mgs.funbonus.system.System.UI_DIALOG_CLOSE);
            this.cancelSignal.dispatch();
            return;
        }

        protected override function draw():void
        {
            this.system.updateUIMode(com.mgs.funbonus.system.System.UI_DIALOG_OPEN);
            var loc1:*=this._type;
            switch (loc1) 
            {
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_COLLECT:
                {
                    this.panel_Dialog.gotoAndStop("Header");
                    this.panel_Dialog.DialogHeading.text = this.system.readConfigString("funbonus.strings", "Collecting", "Your Fun Bonus will end if you collect");
                    this.panel_Dialog.DialogHeading.autoSize = flash.text.TextFieldAutoSize.CENTER;
                    this.panel_Dialog.DialogHeading.wordWrap = true;
                    this.panel_Dialog.DialogHeading.multiline = true;
                    if (this.panel_Dialog.DialogHeading.numLines > 1) 
                    {
                        this.panel_Dialog.DialogHeading.y = this.panel_Dialog.DialogHeading.y - 15 * (this.panel_Dialog.DialogHeading.numLines - 1);
                    }
                    this.panel_Dialog.DialogText.text = this.system.readConfigString("funbonus.strings", "CollectingConfirmRealMoney", "Are you sure you want to collect your winnings now?");
                    this.yesButton = this.system.buttonBuilder("Yes", "Yes", 114, 33, 7, 108, this.yesButtonHandler, "button", "diag", SmallRed_Button_upSkin, SmallRed_Button_overSkin, SmallRed_Button_downSkin, SmallRed_Button_disabledSkin);
                    this.addChild(this.yesButton);
                    this.yesButton.drawNow();
                    this.noButton = this.system.buttonBuilder("No", "No", 114, 33, 127, 108, this.noButtonHandler, "button", "diag", SmallGreen_Button_upSkin, SmallGreen_Button_overSkin, SmallGreen_Button_downSkin, SmallGreen_Button_disabledSkin);
                    this.addChild(this.noButton);
                    this.noButton.drawNow();
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_COLLECT_INVALID:
                {
                    this.panel_Dialog.gotoAndStop("Message");
                    this.panel_Dialog.DialogText.text = this.system.readConfigString("funbonus.strings", "CollectingAmountDeny", "You cannot collect because your collectable amount is currently 0.");
                    this.noButton = this.system.buttonBuilder("OK", "OK", 114, 33, 67, 108, this.noButtonHandler, "button", "diag", SmallGreen_Button_upSkin, SmallGreen_Button_overSkin, SmallGreen_Button_downSkin, SmallGreen_Button_disabledSkin);
                    this.addChild(this.noButton);
                    this.noButton.drawNow();
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_ACTIVATE:
                {
                    this.panel_Dialog.gotoAndStop("MultiMessage");
                    this.panel_Dialog.DialogTopText.text = this.system.readConfigString("funbonus.strings", "ActivateBonusDetail", "Are you sure you want to activate this queued bonus?");
                    this.panel_Dialog.DialogMiddleText.text = this.system.readConfigString("funbonus.strings", "ActivateBonusConfirm", "Your active bonus and any potential winnings will be forfeited.");
                    this.yesButton = this.system.buttonBuilder("Yes", "Yes", 114, 33, 7, 108, this.yesButtonHandler, "button", "diag", SmallRed_Button_upSkin, SmallRed_Button_overSkin, SmallRed_Button_downSkin, SmallRed_Button_disabledSkin);
                    this.addChild(this.yesButton);
                    this.yesButton.drawNow();
                    this.noButton = this.system.buttonBuilder("No", "No", 114, 33, 127, 108, this.noButtonHandler, "button", "diag", SmallGreen_Button_upSkin, SmallGreen_Button_overSkin, SmallGreen_Button_downSkin, SmallGreen_Button_disabledSkin);
                    this.addChild(this.noButton);
                    this.noButton.drawNow();
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_EXPIRED:
                {
                    this.panel_Dialog.gotoAndStop("BigMessage");
                    this.panel_Dialog.DialogBigText.text = this.system.readConfigString("funbonus.strings", "FunBonusExpired", "Your Fun Bonus has Expired");
                    this.yesButton = this.system.buttonBuilder("PlayFunBonusExpiredReal", "Play with Real Money", 245, 37, 2, 108, this.yesButtonHandler, "button", "main", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                    this.addChild(this.yesButton);
                    this.yesButton.drawNow();
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_PLAYTIME_EXPIRED:
                {
                    this.panel_Dialog.gotoAndStop("BigMessage");
                    this.panel_Dialog.DialogBigText.text = this.system.readConfigString("funbonus.strings", "FunBonusPlayTimeExpired", "Your Fun Bonus has ended because you have run out of Playtime");
                    this.yesButton = this.system.buttonBuilder("PlayFunBonusExpiredReal", "Play with Real Money", 245, 37, 2, 108, this.yesButtonHandler, "button", "main", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                    this.addChild(this.yesButton);
                    this.yesButton.drawNow();
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_FUNDS_DEPLETED:
                {
                    this.panel_Dialog.gotoAndStop("BigMessageQueued");
                    this.panel_Dialog.DialogBigText.text = this.system.readConfigString("funbonus.strings", "FunBonusFunds", "Your Fun Bonus has ended because you have run out of Fun Bonus Funds");
                    this.yesButton = this.system.buttonBuilder("PlayFunBonusExpiredReal", "Play with Real Money", 245, 37, 2, 108, this.yesButtonHandler, "button", "main", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                    this.addChild(this.yesButton);
                    this.yesButton.drawNow();
                    this.noButton = this.system.buttonBuilder("ForfeitBonus", "Forfeit this Bonus", 245, 37, 2, 69, this.queuedButtonHandler, "button", "diag", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                    this.addChild(this.noButton);
                    this.noButton.drawNow();
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_EXPIRED_QUEUED:
                {
                    this.panel_Dialog.gotoAndStop("BigMessageQueued");
                    this.panel_Dialog.DialogBigText.text = this.system.readConfigString("funbonus.strings", "FunBonusExpired", "Your Fun Bonus has Expired");
                    this.yesButton = this.system.buttonBuilder("PlayFunBonusExpiredReal", "Play with Real Money", 245, 37, 2, 108, this.yesButtonHandler, "button", "main", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                    this.addChild(this.yesButton);
                    this.yesButton.drawNow();
                    this.noButton = this.system.buttonBuilder("AcitvateQueued", "Activate Queued Bonus", 245, 37, 2, 69, this.queuedButtonHandler, "button", "diag", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                    this.addChild(this.noButton);
                    this.noButton.drawNow();
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_PLAYTIME_EXPIRED_QUEUED:
                {
                    this.panel_Dialog.gotoAndStop("BigMessageQueued");
                    this.panel_Dialog.DialogBigText.text = this.system.readConfigString("funbonus.strings", "FunBonusPlayTimeExpired", "Your Fun Bonus has ended because you have run out of Playtime");
                    this.yesButton = this.system.buttonBuilder("PlayFunBonusExpiredReal", "Play with Real Money", 245, 37, 2, 108, this.yesButtonHandler, "button", "main", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                    this.addChild(this.yesButton);
                    this.yesButton.drawNow();
                    this.noButton = this.system.buttonBuilder("AcitvateQueued", "Activate Queued Bonus", 245, 37, 2, 69, this.queuedButtonHandler, "button", "diag", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                    this.addChild(this.noButton);
                    this.noButton.drawNow();
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_FUNDS_DEPLETED_QUEUED:
                {
                    this.panel_Dialog.gotoAndStop("BigMessageQueued");
                    this.panel_Dialog.DialogBigText.text = this.system.readConfigString("funbonus.strings", "FunBonusFunds", "Your Fun Bonus has ended because you have run out of Fun Bonus Funds");
                    this.yesButton = this.system.buttonBuilder("PlayFunBonusExpiredReal", "Play with Real Money", 245, 37, 2, 108, this.yesButtonHandler, "button", "main", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                    this.addChild(this.yesButton);
                    this.yesButton.drawNow();
                    this.noButton = this.system.buttonBuilder("AcitvateQueued", "Activate Queued Bonus", 245, 37, 2, 69, this.queuedButtonHandler, "button", "diag", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                    this.addChild(this.noButton);
                    this.noButton.drawNow();
                    break;
                }
            }
            super.draw();
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            this.addChild(this.panel_Dialog);
            return;
        }

        public static const TYPE_EXPIRED:String="TYPE_EXPIRED";

        public static const TYPE_FUNDS_DEPLETED:String="TYPE_FUNDS_DEPLETED";

        public static const TYPE_COLLECT:String="TYPE_COLLECT";

        public static const TYPE_PLAYTIME_EXPIRED_QUEUED:String="TYPE_PLAYTIME_EXPIRED_QUEUED";

        public static const TYPE_PLAYTIME_EXPIRED:String="TYPE_PLAYTIME_EXPIRED";

        public static const TYPE_FUNDS_DEPLETED_QUEUED:String="TYPE_FUNDS_DEPLETED_QUEUED";

        public static const TYPE_EXPIRED_QUEUED:String="TYPE_EXPIRED_QUEUED";

        public static const TYPE_ACTIVATE:String="TYPE_ACTIVATE";

        public static const TYPE_COLLECT_INVALID:String="TYPE_COLLECT_INVALID";

        public var cancelSignal:org.osflash.signals.Signal;

        internal var panel_Dialog:Panel_Dialog;

        public var yesButton:fl.controls.Button;

        public var system:com.mgs.funbonus.system.System;

        public var acceptSignal:org.osflash.signals.Signal;

        public var noButton:fl.controls.Button;

        internal var _type:String;

        internal var _id:int;

        public var queuedSignal:org.osflash.signals.Signal;
    }
}


//          package linkbutton
//            class LinkButton
package com.mgs.funbonus.components.linkbutton 
{
    import fl.controls.*;
    import flash.events.*;
    import flash.text.*;
    
    public class LinkButton extends fl.controls.Button
    {
        public function LinkButton()
        {
            this.linkButtonOverFormat = new flash.text.TextFormat();
            this.linkButtonFormat = new flash.text.TextFormat();
            this.linkButtonFormat.bold = false;
            this.linkButtonFormat.color = 8554646;
            this.linkButtonFormat.font = "Arial";
            this.linkButtonFormat.size = 10;
            this.linkButtonFormat.underline = true;
            this.linkButtonOverFormat.bold = false;
            this.linkButtonOverFormat.color = 16777215;
            this.linkButtonOverFormat.font = "Arial";
            this.linkButtonOverFormat.size = 10;
            this.linkButtonOverFormat.underline = true;
            useHandCursor = true;
            addEventListener(flash.events.MouseEvent.MOUSE_OUT, this.linkStyleHandler, false, 0, true);
            addEventListener(flash.events.MouseEvent.MOUSE_OVER, this.linkStyleHandler, false, 0, true);
            addEventListener(flash.events.Event.ADDED_TO_STAGE, this.init, false, 0, true);
            super();
            return;
        }

        internal function init(arg1:flash.events.Event):void
        {
            removeEventListener(flash.events.Event.ADDED_TO_STAGE, this.init);
            setStyle("upSkin", Link_Button_Skin);
            setStyle("overSkin", Link_Button_Skin);
            setStyle("downSkin", Link_Button_Skin);
            setStyle("disabledSkin", Link_Button_Skin);
            setStyle("textFormat", this.linkButtonFormat);
            this.drawNow();
            return;
        }

        internal function linkStyleHandler(arg1:flash.events.MouseEvent):void
        {
            var loc1:*=arg1.currentTarget as fl.controls.Button;
            if (arg1.type != flash.events.MouseEvent.MOUSE_OUT) 
            {
                loc1.setStyle("textFormat", this.linkButtonOverFormat);
            }
            else 
            {
                loc1.setStyle("textFormat", this.linkButtonFormat);
            }
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            return;
        }

        internal var linkButtonOverFormat:flash.text.TextFormat;

        internal var linkButtonFormat:flash.text.TextFormat;
    }
}


//          package tilelist
//            class QueuedBonusRenderer
package com.mgs.funbonus.components.tilelist 
{
    import com.mgs.funbonus.components.dialogs.*;
    import com.mgs.funbonus.data.*;
    import com.mgs.funbonus.system.*;
    import fl.controls.*;
    import fl.controls.listClasses.*;
    import flash.events.*;
    import mx.utils.*;
    
    public class QueuedBonusRenderer extends QueuedBonusLayer implements fl.controls.listClasses.ICellRenderer
    {
        public function QueuedBonusRenderer()
        {
            this.system = com.mgs.funbonus.system.System.getInstance();
            super();
            this.StartingBalance.text = this.system.readConfigString("funbonus.strings", "StartingBalance", "Starting Balance");
            this.MaxWinAmount.text = this.system.readConfigString("funbonus.strings", "MaxWinAmount", "Max Win Amount");
            return;
        }

        public function setSize(arg1:Number, arg2:Number):void
        {
            return;
        }

        internal function forfeitButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.system.displayAlertDialog(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_ACTIVATE, com.mgs.funbonus.data.FunBonusCollectionItem(this.data).id);
            return;
        }

        public function set data(arg1:Object):void
        {
            var loc2:*=null;
            var loc5:*=undefined;
            this._data = arg1;
            var loc1:*=arg1 as com.mgs.funbonus.data.FunBonusCollectionItem;
            this.StartingBalanceNum.text = this.system.formatCurrency(loc1.startingBalance, "credits");
            this.MaxWinAmountNum.htmlText = "<b>" + this.system.formatCurrency(loc1.maxWinAmount, "credits") + "</b>";
            this.QueueNumber.QueueNumberText.text = mx.utils.StringUtil.substitute(this.system.readConfigString("funbonus.strings", "QueuedCounter", "FUN BONUS {0} OF {1}"), loc1.index, loc1.total);
            if (loc1.index != 1) 
            {
                if (this.getChildByName("playWithButton") != null) 
                {
                    this.removeChild(this.getChildByName("playWithButton"));
                }
            }
            else 
            {
                loc5 = this.getChildByName("playWithButton");
                if (this.getChildByName("playWithButton") != null) 
                {
                };
            }
            ConditionLabel0.text = "";
            ConditionNum0.text = "";
            ConditionLabel1.text = "";
            ConditionNum1.text = "";
            ConditionLabel2.text = "";
            ConditionNum2.text = "";
            ConditionLabel3.text = "";
            ConditionNum3.text = "";
            ConditionLabel4.text = "";
            ConditionNum4.text = "";
            var loc3:*=0;
            if (loc1.expiresIn != -1) 
            {
                this["ConditionLabel" + loc3].text = this.system.readConfigString("funbonus.strings", "ExpiresIn", "Expires In");
                this["ConditionNum" + loc3].text = this.system.formatTime(loc1.expiresIn);
                ++loc3;
            }
            if (loc1.playTimeRemaining != -1) 
            {
                this["ConditionLabel" + loc3].text = this.system.readConfigString("funbonus.strings", "PlaytimeRemaining", "Playtime Remaining");
                this["ConditionNum" + loc3].text = this.system.formatTime(loc1.playTimeRemaining);
                ++loc3;
            }
            if (loc1.minWinAmount > 0) 
            {
                this["ConditionLabel" + loc3].text = this.system.formatCurrency(loc1.minWinAmount, "credits");
                this["ConditionNum" + loc3].text = this.system.readConfigString("funbonus.strings", "MinWinAmount", "Min win amount");
                ++loc3;
            }
            var loc4:*=0;
            while (loc4 < loc1.collectConditions.length) 
            {
                loc2 = loc1.collectConditions[loc4] as com.mgs.funbonus.data.CollectConditionItem;
                if (loc2.id != 1) 
                {
                    if (loc2.id == 0) 
                    {
                        this["ConditionLabel" + (loc4 + loc3)].text = this.system.readConfigString("funbonus.strings", "WageredRequired", "Play-through Required");
                        this["ConditionNum" + (loc4 + loc3)].text = this.system.formatCurrency(loc2.end, "credits");
                    }
                }
                else 
                {
                    this["ConditionLabel" + (loc4 + loc3)].text = this.system.readConfigString("funbonus.strings", "DepositedRequired", "Deposit Required");
                    this["ConditionNum" + (loc4 + loc3)].text = this.system.formatCurrency(loc2.end, "credits") + " " + loc1.currencyCode;
                }
                ++loc4;
            }
            return;
        }

        public function set listData(arg1:fl.controls.listClasses.ListData):void
        {
            this._listData = arg1;
            return;
        }

        public function get selected():Boolean
        {
            return false;
        }

        public function get listData():fl.controls.listClasses.ListData
        {
            return this._listData;
        }

        public function setMouseState(arg1:String):void
        {
            return;
        }

        public function get data():Object
        {
            return this._data;
        }

        public function set selected(arg1:Boolean):void
        {
            return;
        }

        public function setStyle(arg1:String, arg2:Object):void
        {
            return;
        }

        internal var _listData:fl.controls.listClasses.ListData;

        internal var _data:Object;

        internal var playWithButton:fl.controls.Button;

        protected var system:com.mgs.funbonus.system.System;
    }
}


//          package timers
//            class Countdown
package com.mgs.funbonus.components.timers 
{
    import flash.events.*;
    import flash.utils.*;
    import org.osflash.signals.*;
    
    public class Countdown extends Object
    {
        public function Countdown()
        {
            this.updateCounter = new org.osflash.signals.Signal();
            super();
            return;
        }

        public function destroy():void
        {
            if (this._minuteTimer != null) 
            {
                this._minuteTimer.stop();
                this._minuteTimer.removeEventListener(flash.events.TimerEvent.TIMER, this.update);
                this.updateCounter.removeAll();
            }
            return;
        }

        internal function update(arg1:flash.events.TimerEvent=null):void
        {
            --this._startTime;
            if (this._startTime <= 0) 
            {
                this._minuteTimer.stop();
                this._minuteTimer.removeEventListener(flash.events.TimerEvent.TIMER, this.update);
            }
            this.updateCounter.dispatch(com.mgs.funbonus.components.timers.Countdown.UPDATE, this._startTime);
            return;
        }

        public function start(arg1:int):void
        {
            if (arg1 > 0) 
            {
                this._startTime = arg1;
                this._minuteTimer = new flash.utils.Timer(60000);
                this._minuteTimer.addEventListener(flash.events.TimerEvent.TIMER, this.update, false, 0, true);
                this._minuteTimer.start();
                this.updateCounter.dispatch(com.mgs.funbonus.components.timers.Countdown.UPDATE, this._startTime);
            }
            else 
            {
                this.updateCounter.dispatch(com.mgs.funbonus.components.timers.Countdown.UPDATE, 0);
            }
            return;
        }

        
        {
            UPDATE = "COMPLETE";
            WARNING = "WARNING";
            COMPLETE = "COMPLETE";
        }

        internal var _startTime:int;

        internal var _minuteTimer:flash.utils.Timer;

        public var updateCounter:org.osflash.signals.Signal;

        public static var COMPLETE:String="COMPLETE";

        public static var UPDATE:String="COMPLETE";

        public static var WARNING:String="WARNING";
    }
}


//          package tooltip
//            class Tooltip
package com.mgs.funbonus.components.tooltip 
{
    import flash.display.*;
    import flash.events.*;
    import flash.filters.*;
    import flash.text.*;
    import flash.utils.*;
    import mgs.greensock.*;
    
    public class Tooltip extends flash.display.Sprite
    {
        public function Tooltip(arg1:flash.display.DisplayObject, arg2:String, arg3:String="up", arg4:int=8, arg5:int=3, arg6:uint=11910090, arg7:uint=3488068, arg8:Boolean=false, arg9:int=1, arg10:Boolean=true, arg11:String="center", arg12:int=0, arg13:String="", arg14:int=0, arg15:String="right")
        {
            var loc5:*=null;
            this.textfield = new flash.text.TextField();
            this.textfield_right = new flash.text.TextField();
            this.timer = new flash.utils.Timer(100, 1);
            this.glowFilter = new flash.filters.GlowFilter(16711680, 1, 5, 5, 2, 1);
            super();
            this._target = arg1;
            this._txt = arg2;
            this._dir = arg3;
            this._cornerRadius = arg5;
            this._color = arg6;
            this._txtColor = arg7;
            this._alfa = arg9;
            this._useArrow = arg10;
            this._dist = arg4;
            this._force = arg8;
            this.textfield.selectable = false;
            this.textformat = new flash.text.TextFormat();
            this.textformat.align = arg11;
            this.textformat.color = arg7;
            this.textformat.bold = false;
            this.textformat.font = "Arial";
            this.textformat.size = 11;
            this.textfield = new flash.text.TextField();
            this.textfield.defaultTextFormat = this.textformat;
            this.textfield.htmlText = arg2;
            this.textfield.multiline = true;
            this.textfield.selectable = false;
            this.textfield.gridFitType = flash.text.GridFitType.NONE;
            if (arg13 != "") 
            {
                this.textformat.align = arg15;
                this.textfield_right = new flash.text.TextField();
                this.textfield_right.selectable = false;
                this.textfield_right.defaultTextFormat = this.textformat;
                this.textfield_right.htmlText = arg13;
                this.textfield_right.multiline = true;
                this.textfield_right.selectable = false;
                this.textfield_right.gridFitType = flash.text.GridFitType.NONE;
                this.textfield_right.y = 6;
                this.textfield_right.x = arg14;
            }
            var loc1:*=0;
            var loc2:*=arg12;
            var loc3:*=0;
            var loc4:*=0;
            while (loc4 < this.textfield.numLines) 
            {
                this.textLineMetrics = this.textfield.getLineMetrics(loc4);
                loc3 = this.textLineMetrics.width;
                if (!(arg13 == "") && loc4 < this.textfield_right.numLines) 
                {
                    loc5 = this.textfield_right.getLineMetrics(loc4);
                    loc3 = loc3 + loc5.width;
                }
                if (loc2 < loc3) 
                {
                    loc2 = loc3;
                }
                loc1 = loc1 + this.textLineMetrics.height;
                ++loc4;
            }
            this.w = loc2 + 15;
            this.h = loc1 + 15;
            this.textfield.width = this.w;
            this.textfield.height = this.h;
            this.textfield.y = 6;
            if (arg13 != "") 
            {
                this.textfield_right.width = this.w;
                this.textfield_right.height = this.h;
                this.addChild(this.textfield_right);
            }
            this.graphics.clear();
            this.graphics.beginFill(arg6, arg9);
            this.graphics.drawRoundRect(0, 0, this.w, this.h, arg5, arg5);
            this.drawArrow();
            this.graphics.endFill();
            this.bmpFilter = new flash.filters.DropShadowFilter(2, 90, 0, 1, 4, 4, 1, 1);
            this.filters = [this.bmpFilter];
            this.textfield.filters = null;
            this.addChild(this.textfield);
            if (this._force) 
            {
                this.showTooltip();
            }
            else 
            {
                arg1.addEventListener(flash.events.MouseEvent.MOUSE_OVER, this.startTooltipCounter, false, 0, true);
                arg1.addEventListener(flash.events.MouseEvent.MOUSE_OUT, this.hideTooltip, false, 0, true);
            }
            return;
        }

        internal function moveTooltip(arg1:flash.events.MouseEvent):void
        {
            var loc1:*=this._dir;
            switch (loc1) 
            {
                case "up":
                {
                    this.x = mouseX - this.w / 2;
                    this.y = mouseY - (this.h + this._dist);
                    break;
                }
                case "down":
                {
                    this.x = mouseX - this.w / 2;
                    this.y = mouseY + (this.h + this._dist);
                    break;
                }
                case "left":
                {
                    this.x = mouseX - this.w - this._dist;
                    this.y = mouseY - this.h / 2;
                    break;
                }
                case "right":
                {
                    this.x = mouseX + this._dist;
                    this.y = mouseY - this.h / 2;
                    break;
                }
            }
            return;
        }

        internal function showTooltip(arg1:flash.events.TimerEvent=null):void
        {
            if (this.timer.hasEventListener(flash.events.TimerEvent.TIMER_COMPLETE)) 
            {
                this.timer.removeEventListener(flash.events.TimerEvent.TIMER_COMPLETE, this.showTooltip);
            }
            var loc1:*=this._dir;
            switch (loc1) 
            {
                case "up":
                {
                    this.x = this._target.x + (this._target.width - this.w) / 2;
                    this.y = this._target.y - this.h - this._dist;
                    break;
                }
                case "down":
                {
                    this.x = (this._target.x + this._target.width - this.w) / 2;
                    this.y = this._target.y + this._target.height + this._dist;
                    break;
                }
                case "left":
                {
                    this.x = this._target.x + this._target.width - this.w - this._dist;
                    this.y = this._target.y + this._target.height - this.h / 2;
                    break;
                }
                case "right":
                {
                    this.x = this._target.x + this._target.width + this._dist;
                    this.y = this._target.y + this._target.height / 2 - this.h / 2;
                    break;
                }
            }
            this._target.parent.addChild(this);
            this.showing = true;
            return;
        }

        public function set text(arg1:String):void
        {
            this.textfield.htmlText = arg1;
            var loc1:*=0;
            var loc2:*=0;
            var loc3:*=0;
            while (loc3 < this.textfield.numLines) 
            {
                this.textLineMetrics = this.textfield.getLineMetrics(loc3);
                if (loc2 < this.textLineMetrics.width) 
                {
                    loc2 = this.textLineMetrics.width;
                }
                loc1 = loc1 + this.textLineMetrics.height;
                ++loc3;
            }
            this.w = loc2 + 18;
            this.h = loc1 + 18;
            this.textfield.width = this.w;
            this.textfield.height = this.h;
            this.textfield.y = 5;
            this.graphics.clear();
            this.graphics.beginFill(this._color, this._alfa);
            this.graphics.drawRoundRect(0, 0, this.w, this.h, this._cornerRadius, this._cornerRadius);
            this.drawArrow();
            this.graphics.endFill();
            return;
        }

        internal function drawArrow():void
        {
            if (this._useArrow && this._dir == Tooltip.UP) 
            {
                this.graphics.moveTo(this.w / 2 - 6, this.h);
                this.graphics.lineTo(this.w / 2, this.h + 4.5);
                this.graphics.lineTo(this.w / 2 + 6, this.h);
            }
            if (this._useArrow && this._dir == Tooltip.DOWN) 
            {
                this.graphics.moveTo(this.w / 2 - 6, 0);
                this.graphics.lineTo(this.w / 2, -4.5);
                this.graphics.lineTo(this.w / 2 + 6, 0);
            }
            if (this._useArrow && this._dir == Tooltip.RIGHT) 
            {
                this.graphics.moveTo(0, this.h / 2 - 6);
                this.graphics.lineTo(-4.5, this.h / 2);
                this.graphics.lineTo(0, this.h / 2 + 6);
            }
            return;
        }

        internal function hideTooltip(arg1:flash.events.MouseEvent):void
        {
            if (this.timer.currentCount == 1) 
            {
                this.showing = false;
                this._target.parent.removeChild(this);
            }
            this.timer.reset();
            return;
        }

        internal function startTooltipCounter(arg1:flash.events.MouseEvent):void
        {
            if (this.showing == false) 
            {
                this.timer.addEventListener(flash.events.TimerEvent.TIMER_COMPLETE, this.showTooltip, false, 0, true);
                this.timer.start();
            }
            return;
        }

        public static const DOWN:String="down";

        public static const LEFT:String="left";

        public static const UP:String="up";

        public static const RIGHT:String="right";

        internal var textLineMetrics:flash.text.TextLineMetrics;

        internal var timer:flash.utils.Timer;

        internal var _alfa:int;

        internal var _dir:String;

        internal var textfield_right:flash.text.TextField;

        internal var _dist:int;

        internal var bmpFilter:flash.filters.BitmapFilter;

        internal var _useArrow:Boolean;

        internal var textformat:flash.text.TextFormat;

        internal var glowFilter:flash.filters.GlowFilter;

        internal var _cornerRadius:int;

        internal var showing:Boolean=false;

        internal var h:int;

        internal var tween:mgs.greensock.TweenLite;

        internal var _force:Boolean;

        internal var textfield:flash.text.TextField;

        internal var _target:flash.display.DisplayObject;

        internal var _txt:String;

        internal var _txtColor:uint;

        internal var w:int;

        internal var _color:uint;
    }
}


//        package data
//          class CollectConditionItem
package com.mgs.funbonus.data 
{
    public dynamic class CollectConditionItem extends Object
    {
        public function CollectConditionItem()
        {
            super();
            return;
        }

        public function toString():String
        {
            return "[CollectConditionItem: " + this.id + "," + this.start.toString() + "," + this.end.toString() + "," + this.current.toString() + "]";
        }

        public var start:uint;

        public var current:uint;

        public var end:uint;

        public var id:Number;
    }
}


//          class FunBonusCollectionItem
package com.mgs.funbonus.data 
{
    public dynamic class FunBonusCollectionItem extends Object
    {
        public function FunBonusCollectionItem()
        {
            super();
            return;
        }

        public function toString():String
        {
            return "[FunBonusCollectionItem: " + this.id + "," + this.active + "," + this.startingBalance.toString() + "," + this.currentBalance.toString() + "," + this.collectableAmount.toString() + "," + this.expiresIn + "," + this.playTimeRemaining.toString() + "," + this.minWinAmount.toString() + "," + this.maxWinAmount.toString() + "," + this.collectConditions.toString() + "]";
        }

        public var collectConditions:Array;

        public var startingBalance:uint;

        public var total:Number;

        public var active:Boolean;

        public var maxWinAmount:int;

        public var index:Number;

        public var playTimeRemaining:Number;

        public var id:Number;

        public var currencyCode:String;

        public var minWinAmount:uint;

        public var currentBalance:uint;

        public var hasQueued:Boolean;

        public var expiresIn:Number;

        public var collectableAmount:uint;
    }
}


//          class RealMoneyCollectionItem
package com.mgs.funbonus.data 
{
    public dynamic class RealMoneyCollectionItem extends Object
    {
        public function RealMoneyCollectionItem()
        {
            super();
            return;
        }

        public function toString():String
        {
            return "[RealMoneyCollectionItem: " + this.currencyCode + "," + this.realBalance.toString() + "," + this.bonusBalance.toString() + "," + this.totalCredits.toString() + "," + this.showLink + "]";
        }

        public var currencyCode:String;

        public var totalCredits:int;

        public var showLink:Boolean;

        public var bonusBalance:int;

        public var realBalance:int;
    }
}


//        package system
//          class System
package com.mgs.funbonus.system 
{
    import com.mgs.funbonus.common.enums.*;
    import com.mgs.funbonus.common.interfaces.*;
    import com.mgs.funbonus.components.dialogs.*;
    import com.mgs.funbonus.components.linkbutton.*;
    import com.mgs.funbonus.data.*;
    import fl.controls.*;
    import fl.data.*;
    import flash.events.*;
    import flash.external.*;
    import flash.text.*;
    import flash.utils.*;
    import mx.utils.*;
    import org.osflash.signals.*;
    
    public class System extends Object
    {
        public function System(arg1:Function=null, arg2:String="", arg3:com.mgs.funbonus.common.interfaces.IFunBonusComs=null)
        {
            this.configStrings = new flash.utils.Dictionary(false);
            this.funBonusDataProvider = new fl.data.DataProvider();
            this.loadedSignal = new org.osflash.signals.Signal();
            this.alertSignal = new org.osflash.signals.Signal();
            this.dialogSignal = new org.osflash.signals.Signal();
            this.overlaySignal = new org.osflash.signals.Signal();
            this.uiSignal = new org.osflash.signals.Signal();
            this.startTime = new Date();
            this.systemFormats = new com.mgs.funbonus.system.SystemFormats();
            this.cachedDelay = new flash.utils.Timer(4000);
            super();
            if (arg1 != hidden) 
            {
                throw new Error("System is a singleton class, use getInstance() instead");
            }
            if (com.mgs.funbonus.system.System.instance != null) 
            {
                throw new Error("Only one System instance should be instantiated");
            }
            this._type = arg2;
            if (this._type != "viper") 
            {
                if (this._type != "aurora") 
                {
                    this.coms = new com.mgs.funbonus.system.TestComs();
                }
                else 
                {
                    this.coms = arg3;
                }
            }
            else 
            {
                flash.external.ExternalInterface.addCallback("OnRequestBonus", this.onRequestBonus);
                this.coms = new com.mgs.funbonus.system.ViperComs();
            }
            return;
        }

        public function get NORMAL_WIDTH():int
        {
            return parseInt(this.readConfigString("clarion_dimensions_lobby", "width", "1024"));
        }

        public function get depositAvailable():Boolean
        {
            return this._depositAvailable;
        }

        internal static function hidden():void
        {
            return;
        }

        internal function processBonus(arg1:XML, arg2:Boolean, arg3:String, arg4:int):com.mgs.funbonus.data.FunBonusCollectionItem
        {
            var loc2:*=null;
            var loc4:*=null;
            var loc1:*;
            (loc1 = new com.mgs.funbonus.data.FunBonusCollectionItem()).total = arg4;
            loc1.active = arg2;
            loc1.currencyCode = this.currencyCode;
            loc1.id = arg1.@ID;
            loc1.startingBalance = arg1.@StartBal;
            loc1.currentBalance = arg1.@CurrBal;
            loc1.collectableAmount = arg1.@CollectableAmt;
            loc1.expiresIn = arg1.@ExpInMin;
            loc1.playTimeRemaining = arg1.@PlayTimeRemInMin;
            loc1.minWinAmount = arg1.@MinWinAmt;
            loc1.maxWinAmount = arg1.@MaxWinAmt;
            loc1.collectConditions = [];
            var loc3:*=arg1;
            var loc5:*=0;
            var loc6:*=loc3;
            for each (loc4 in loc6) 
            {
                (loc2 = new com.mgs.funbonus.data.CollectConditionItem()).id = loc4.@ID;
                loc2.start = loc4.@Start;
                loc2.end = loc4.@End;
                loc2.current = loc4.@Current;
                loc1.collectConditions.push(loc2);
            }
            return loc1;
        }

        public function buttonBuilder(arg1:String, arg2:String, arg3:Number, arg4:Number, arg5:Number, arg6:Number, arg7:Function=null, arg8:String="button", arg9:String="main", arg10:Class=null, arg11:Class=null, arg12:Class=null, arg13:Class=null):fl.controls.Button
        {
            var loc1:*=null;
            var loc2:*=null;
            if (arg8 != "button") 
            {
                if (arg8 == "linkbutton" || arg8 == "linkbuttonleft") 
                {
                    loc1 = new com.mgs.funbonus.components.linkbutton.LinkButton();
                }
            }
            else 
            {
                loc1 = new fl.controls.Button();
            }
            if (arg1 == "") 
            {
                loc1.label = "";
            }
            else 
            {
                loc1.label = this.readConfigString("funbonus.strings", arg1, arg2);
            }
            loc1.useHandCursor = true;
            if (arg10 != null) 
            {
                loc1.setStyle("upSkin", arg10);
            }
            if (arg11 != null) 
            {
                loc1.setStyle("overSkin", arg11);
            }
            if (arg12 != null) 
            {
                loc1.setStyle("downSkin", arg12);
            }
            if (arg13 != null) 
            {
                loc1.setStyle("disabledSkin", arg13);
            }
            if (arg9 != null) 
            {
                if (arg9 != "main") 
                {
                    if (arg9 != "nav") 
                    {
                        if (arg9 == "diag") 
                        {
                            loc1.setStyle("textFormat", this.systemFormats.dialogTextFormat);
                        }
                    }
                    else 
                    {
                        loc1.setStyle("disabledTextFormat", this.systemFormats.disabledNavigationButtonFormat);
                        loc1.setStyle("textFormat", this.systemFormats.navigationButtonFormat);
                    }
                }
                else if (arg10 != Red_Button_upSkin) 
                {
                    if (arg10 != Green_Button_upSkin) 
                    {
                        loc1.setStyle("textFormat", this.systemFormats.mainButtonFormat);
                        loc1.setStyle("disabledTextFormat", this.systemFormats.disabledMainButtonFormat);
                    }
                    else 
                    {
                        loc1.setStyle("textFormat", this.systemFormats.mainButtonFormat);
                        loc1.setStyle("disabledTextFormat", this.systemFormats.disabledGreenButtonFormat);
                    }
                }
                else 
                {
                    loc1.setStyle("textFormat", this.systemFormats.redButtonFormat);
                    loc1.setStyle("disabledTextFormat", this.systemFormats.disabledRedButtonFormat);
                }
            }
            loc1.textField.gridFitType = flash.text.GridFitType.NONE;
            if (arg8 != "linkbuttonleft") 
            {
                loc1.width = arg3;
            }
            else 
            {
                loc2 = loc1.textField.getLineMetrics(0);
                loc1.width = loc2.width + 25;
            }
            loc1.height = arg4;
            loc1.x = arg5;
            loc1.y = arg6;
            loc1.addEventListener(flash.events.MouseEvent.CLICK, arg7, false, 0, true);
            return loc1;
        }

        public static function getInstance(arg1:String="", arg2:com.mgs.funbonus.common.interfaces.IFunBonusComs=null):com.mgs.funbonus.system.System
        {
            if (instance == null) 
            {
                instance = new System(hidden, arg1, arg2);
            }
            return instance;
        }

        public function displayOverLay(arg1:String, arg2:Boolean=true):void
        {
            this.overlaySignal.dispatch(arg1, arg2);
            return;
        }

        public function get playMode():String
        {
            var loc1:*=this.coms.getCasinoLoginStatus();
            if (loc1 != 0) 
            {
                if (loc1 != 1) 
                {
                    if (loc1 == 2) 
                    {
                        this._playmode = com.mgs.funbonus.system.System.FUNPLAY;
                    }
                }
                else 
                {
                    this._playmode = com.mgs.funbonus.system.System.PRACTICEPLAY;
                }
            }
            else 
            {
                this._playmode = com.mgs.funbonus.system.System.REALPLAY;
            }
            return this._playmode;
        }

        public function switchToMode(arg1:String):void
        {
            if (arg1 != com.mgs.funbonus.system.System.FUNPLAY) 
            {
                if (arg1 == com.mgs.funbonus.system.System.REALPLAY) 
                {
                    this.coms.switchLogin(0);
                }
            }
            else 
            {
                this.coms.executeCasinoFrameCommand("EVENT", "evt_fbswitch_panel");
            }
            return;
        }

        public function readConfigUncached(arg1:String, arg2:String, arg3:String, arg4:int=1):String
        {
            var loc1:*="";
            if ((loc1 = this.coms.readConfigStringSKE(arg1, arg2, arg4)) == "" || loc1 == null) 
            {
                loc1 = arg3;
            }
            return loc1;
        }

        public function set depositAvailable(arg1:Boolean):void
        {
            this._depositAvailable = arg1;
            return;
        }

        public function get NORMAL_HEIGHT():int
        {
            return parseInt(this.readConfigString("clarion_dimensions_lobby", "height", "730"));
        }

        public function activate(arg1:uint, arg2:Boolean=true):void
        {
            this._activateQueued = arg2;
            if (this._type == "viper" || this._type == "aurora") 
            {
                this.coms.requestBonusAction(com.mgs.funbonus.common.enums.FunBonusEnums.BIA_SELECTION, arg1);
            }
            else 
            {
                this.onRequestBonus(com.mgs.funbonus.common.enums.FunBonusEnums.BIA_SELECTION, "");
            }
            return;
        }

        internal function padValue(arg1:int):String
        {
            if (arg1 < 10 && arg1 > 0) 
            {
                return "0" + String(arg1);
            }
            return String(arg1);
        }

        public function requestInformation(arg1:Boolean=false):void
        {
            var loc1:*=null;
            this.doCachedResponse = arg1;
            this.setplayMode(this.coms.getCasinoLoginStatus());
            if (this._type == "viper" || this._type == "aurora") 
            {
                this.syncResponse = true;
                this.coms.requestBonusAction(com.mgs.funbonus.common.enums.FunBonusEnums.BIA_INFORMATION, 0);
            }
            else 
            {
                this.syncResponse = true;
                loc1 = new XML("<GetFunBonusBalancesResponse Cur=\"USD\">\r\n\t\t\t\t\t\t<RealMoney RealBal=\"100\" BonusBal=\"100\" TotalCred=\"200\"/>\r\n\t\t\t\t\t\t<FunBonus>\r\n\t\t\t\t\t\t\t<Active>\r\n\t\t\t\t\t\t\t\t<Bonus ID=\"1\" StartBal=\"2500\" CurrBal=\"1040\" CollectableAmt=\"40\" ExpInMin=\"1\" PlayTimeRemInMin=\"5\" MinWinAmt=\"0\" MaxWinAmt=\"50\">\r\n\t\t\t\t\t\t\t\t<Conditions>\r\n\t\t\t\t\t\t\t\t<Condition ID=\"0\" Start=\"0\" End=\"200\" Current=\"0\"/>\r\n\t\t\t\t\t\t\t\t</Conditions>\r\n\t\t\t\t\t\t\t\t</Bonus>\r\n\t\t\t\t\t\t\t</Active>\r\n\t\t\t\t\t\t\t<Queued>\r\n\t\t\t\t\t\t\t\t<Bonus ID=\"2\" StartBal=\"100\" CurrBal=\"200\" CollectableAmt=\"100\" ExpInMin=\"50\" PlayTimeRemInMin=\"40\" MinWinAmt=\"0\" MaxWinAmt=\"500\">\r\n\t\t\t\t\t\t\t\t<Conditions>\r\n\t\t\t\t\t\t\t\t<Condition ID=\"0\" Start=\"0\" End=\"200\" Current=\"0\"/>\r\n\t\t\t\t\t\t\t\t</Conditions>\r\n\t\t\t\t\t\t\t\t</Bonus>\r\n\t\t\t\t\t\t\t\t<Bonus ID=\"3\" StartBal=\"0\" CurrBal=\"400\" CollectableAmt=\"100\" ExpInMin=\"50\" PlayTimeRemInMin=\"500\" MinWinAmt=\"0\" MaxWinAmt=\"100\">\r\n\t\t\t\t\t\t\t\t<Conditions>\r\n\t\t\t\t\t\t\t\t<Condition ID=\"0\" Start=\"0\" End=\"100\" Current=\"0\"/>\r\n\t\t\t\t\t\t\t\t<Condition ID=\"1\" Start=\"0\" End=\"50\" Current=\"0\"/>\r\n\t\t\t\t\t\t\t\t</Conditions>\r\n\t\t\t\t\t\t\t\t</Bonus>\r\n\t\t\t\t\t\t\t\t<Bonus ID=\"4\" StartBal=\"0\" CurrBal=\"200\" CollectableAmt=\"100\" ExpInMin=\"50\" PlayTimeRemInMin=\"500\" MinWinAmt=\"0\" MaxWinAmt=\"200\">\r\n\t\t\t\t\t\t\t\t<Conditions>\r\n\t\t\t\t\t\t\t\t<Condition ID=\"0\" Start=\"0\" End=\"20\" Current=\"0\"/>\r\n\t\t\t\t\t\t\t\t<Condition ID=\"1\" Start=\"0\" End=\"30\" Current=\"0\"/>\r\n\t\t\t\t\t\t\t\t</Conditions>\r\n\t\t\t\t\t\t\t\t</Bonus>\r\n\t\t\t\t\t\t\t\t</Queued>\r\n\t\t\t\t\t\t</FunBonus>\r\n\t\t\t\t\t</GetFunBonusBalancesResponse>");
                this.onRequestBonus(com.mgs.funbonus.common.enums.FunBonusEnums.BIA_INFORMATION, loc1.toXMLString());
            }
            return;
        }

        public function setDoCachedResponse(arg1:Boolean):void
        {
            this.doCachedResponse = arg1;
            return;
        }

        public function formatTime(arg1:Number, arg2:String="{0}h {1}m"):String
        {
            var loc1:*=arg1 * 60;
            var loc2:*=Math.floor(loc1 / (24 * 60 * 60));
            loc1 = loc1 - loc2 * 24 * 60 * 60;
            var loc3:*=Math.floor(loc1 / (60 * 60));
            loc1 = loc1 - loc3 * 60 * 60;
            var loc4:*=Math.floor(loc1 / 60);
            if (loc2 > 0) 
            {
                arg2 = "{0}d {1}h";
                return mx.utils.StringUtil.substitute(arg2, this.padValue(loc2), this.padValue(loc3));
            }
            if (loc3 > 0) 
            {
                arg2 = "{0}h {1}m";
                return mx.utils.StringUtil.substitute(arg2, this.padValue(loc3), this.padValue(loc4));
            }
            if (loc4 > 0) 
            {
                if (arg1 * 60 > 60) 
                {
                    arg2 = "{0}h {1}m";
                    return mx.utils.StringUtil.substitute(arg2, this.padValue(loc3), this.padValue(loc4));
                }
                return this.readConfigString("funbonus.strings", "LessThanMinute", "< 1 min");
            }
            arg2 = "{0} m";
            return mx.utils.StringUtil.substitute(arg2, this.padValue(loc4));
        }

        internal function processReal(arg1:XML, arg2:String, arg3:Boolean):com.mgs.funbonus.data.RealMoneyCollectionItem
        {
            var loc1:*;
            (loc1 = new com.mgs.funbonus.data.RealMoneyCollectionItem()).realBalance = arg1.@RealBal;
            loc1.bonusBalance = arg1.@BonusBal;
            loc1.totalCredits = arg1.@TotalCred;
            loc1.currencyCode = arg2;
            loc1.showLink = arg3;
            return loc1;
        }

        public function displayAlertDialog(arg1:String, arg2:int=0):void
        {
            this.alertSignal.dispatch(arg1, arg2);
            return;
        }

        public function formatCurrency(arg1:int, arg2:String):String
        {
            return this.coms.formatCurrency(arg1, arg2);
        }

        public function readConfigString(arg1:String, arg2:String, arg3:String, arg4:int=1):String
        {
            var loc1:*=arg1 + "*\'*\"*||*\"*\'*" + arg2;
            if (this.configStrings[loc1] == null) 
            {
                this.configStrings[loc1] = this.readConfigUncached(arg1, arg2, arg3, arg4);
            }
            return this.configStrings[loc1];
        }

        public function updateUIMode(arg1:String):void
        {
            if (arg1 == com.mgs.funbonus.system.System.UI_REAL || arg1 == com.mgs.funbonus.system.System.UI_ACTIVE_TAB) 
            {
                this.uiSignal.dispatch(true);
                this.currentUIMode = arg1;
            }
            else if (arg1 != com.mgs.funbonus.system.System.UI_QUEUED_TAB) 
            {
                if (arg1 != com.mgs.funbonus.system.System.UI_DIALOG_OPEN) 
                {
                    if (arg1 == com.mgs.funbonus.system.System.UI_DIALOG_CLOSE) 
                    {
                        if (this.currentUIMode == com.mgs.funbonus.system.System.UI_QUEUED_TAB) 
                        {
                            this.uiSignal.dispatch(false);
                        }
                        else 
                        {
                            this.uiSignal.dispatch(true);
                        }
                    }
                }
                else 
                {
                    this.uiSignal.dispatch(false);
                }
            }
            else 
            {
                this.uiSignal.dispatch(false);
                this.currentUIMode = arg1;
            }
            return;
        }

        public function loadTutorial():void
        {
            this.coms.executeCasinoFrameCommand("EVENT", "evt_fbtutorial_panel");
            return;
        }

        public function refresh():void
        {
            this.show = false;
            this.requestInformation();
            return;
        }

        public function loadTermsAndConditions():void
        {
            this.coms.executeCasinoFrameCommand("EVENT", "evt_fbtermsnconditions_vpb");
            return;
        }

        public function sendCloseEvent():void
        {
            this.coms.executeCasinoFrameCommand("EVENT", "evt_exthidebb");
            return;
        }

        public function sendAlert():void
        {
            this.alertSignal.dispatch(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_COLLECT_INVALID, 0);
            return;
        }

        public function evtHide():void
        {
            this.coms.executeCasinoFrameCommand("EVENT", "evt_exthidebb");
            return;
        }

        public function collect(arg1:uint):void
        {
            if (this._type == "viper" || this._type == "aurora") 
            {
                this.coms.requestBonusAction(com.mgs.funbonus.common.enums.FunBonusEnums.BIA_COLLECTION, arg1);
            }
            else 
            {
                this.onRequestBonus(com.mgs.funbonus.common.enums.FunBonusEnums.BIA_COLLECTION, "");
            }
            return;
        }

        public function get type():String
        {
            return this._type;
        }

        internal function setplayMode(arg1:int):void
        {
            if (arg1 != 0) 
            {
                if (arg1 != 1) 
                {
                    if (arg1 == 2) 
                    {
                        this._playmode = com.mgs.funbonus.system.System.FUNPLAY;
                    }
                }
                else 
                {
                    this._playmode = com.mgs.funbonus.system.System.PRACTICEPLAY;
                }
            }
            else 
            {
                this._playmode = com.mgs.funbonus.system.System.REALPLAY;
            }
            return;
        }

        internal function processInformationResponse(arg1:XML):void
        {
            var loc3:*=null;
            var loc4:*=null;
            var loc1:*=arg1.Bonus[0];
            var loc2:*=false;
            this.currencyCode = arg1.@Cur;
            this.funBonusDataProvider = new fl.data.DataProvider();
            if (loc1 == null) 
            {
                this.currentState = com.mgs.funbonus.system.System.NONE;
            }
            else 
            {
                this.funBonusDataProvider.addItem(this.processBonus(loc1, true, this.currencyCode, 0));
                this.currentState = com.mgs.funbonus.system.System.ACTIVE;
                if (!((loc3 = arg1.Bonus) == null) && !(loc3.length() == 0)) 
                {
                    var loc5:*=0;
                    var loc6:*=loc3;
                    for each (loc4 in loc6) 
                    {
                        this.funBonusDataProvider.addItem(this.processBonus(loc4, false, this.currencyCode, loc3.length()));
                    }
                    this.currentState = com.mgs.funbonus.system.System.QUEUED;
                }
                loc2 = true;
            }
            this.realMoneyCollectionItem = this.processReal(arg1.RealMoney[0], this.currencyCode, loc2);
            this.loadedSignal.dispatch();
            return;
        }

        public function onRequestBonus(arg1:uint, arg2:String):void
        {
            var loc1:*=arg1;
            switch (loc1) 
            {
                case com.mgs.funbonus.common.enums.FunBonusEnums.BIA_INFORMATION:
                {
                    if (this.syncResponse) 
                    {
                        if (!(this.cachedResponse == "") && this.doCachedResponse == true) 
                        {
                            this.processInformationResponse(XML(this.cachedResponse));
                        }
                        else 
                        {
                            this.processInformationResponse(XML(arg2));
                            this.startTime = new Date();
                        }
                        this.cachedResponse = arg2;
                        this.syncResponse = false;
                    }
                    break;
                }
                case com.mgs.funbonus.common.enums.FunBonusEnums.BIA_EXPIRY:
                {
                    break;
                }
                case com.mgs.funbonus.common.enums.FunBonusEnums.BIA_COLLECTION:
                {
                    if (XML(arg2).@status != 102) 
                    {
                        this.show = false;
                        if (this._playmode != com.mgs.funbonus.system.System.FUNPLAY) 
                        {
                            this.requestInformation(false);
                        }
                        else 
                        {
                            this.displayOverLay(com.mgs.funbonus.system.System.REALPLAY, false);
                        }
                    }
                    else 
                    {
                        this.alertSignal.dispatch(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_COLLECT_INVALID, 0);
                    }
                    break;
                }
                case com.mgs.funbonus.common.enums.FunBonusEnums.BIA_SELECTION:
                {
                    if (XML(arg2).@status != 102) 
                    {
                        this.show = false;
                        this.doCachedResponse = false;
                        if (this._activateQueued) 
                        {
                            this._activateQueued = false;
                            this.syncResponse = true;
                            this.coms.changeBonusOffer();
                        }
                    }
                    else 
                    {
                        this.alertSignal.dispatch(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_COLLECT_INVALID, 0);
                    }
                    break;
                }
            }
            return;
        }

        public function initComs():void
        {
            this.coms.initExternalComs();
            return;
        }

        public static const NONE:String="NONE";

        public static const UI_DIALOG_CLOSE:String="UI_DIALOG_CLOSE";

        public static const FUNPLAY:String="FUNPLAY";

        public static const REMOVE:String="REMOVE";

        public static const ACTIVE:String="ACTIVE";

        public static const UI_ACTIVE_TAB:String="UI_ACTIVE_TAB";

        public static const REALPLAY:String="REALPLAY";

        public static const UI_REAL:String="UI_REAL";

        public static const PRACTICEPLAY:String="PRACTICEPLAY";

        public static const QUEUED:String="QUEUED";

        public static const UI_QUEUED_TAB:String="UI_QUEUED_TAB";

        public static const UI_DIALOG_OPEN:String="UI_DIALOG_OPEN";

        internal var cachedDelay:flash.utils.Timer;

        internal var cachedResponse:String="";

        internal var _depositAvailable:Boolean=false;

        public var coms:com.mgs.funbonus.common.interfaces.IFunBonusComs;

        public var overlaySignal:org.osflash.signals.Signal;

        internal var doCachedResponse:Boolean=false;

        public var currencyCode:String;

        internal var _type:String;

        public var currentState:String="";

        public var dialogSignal:org.osflash.signals.Signal;

        internal var syncResponse:Boolean=false;

        public var show:Boolean=true;

        public var showing:Boolean=false;

        public var startTime:Date;

        public var realMoneyCollectionItem:com.mgs.funbonus.data.RealMoneyCollectionItem;

        public var loadedSignal:org.osflash.signals.Signal;

        internal var currentUIMode:String="";

        internal var _playmode:String;

        internal static var instance:com.mgs.funbonus.system.System;

        public var loading:Boolean=false;

        public var funBonusDataProvider:fl.data.DataProvider;

        public var active:Boolean=true;

        internal var systemFormats:com.mgs.funbonus.system.SystemFormats;

        public var uiSignal:org.osflash.signals.Signal;

        internal var configStrings:flash.utils.Dictionary;

        public var alertSignal:org.osflash.signals.Signal;

        internal var _activateQueued:Boolean=false;
    }
}


//          class SystemFormats
package com.mgs.funbonus.system 
{
    import flash.filters.*;
    import flash.text.*;
    
    public class SystemFormats extends Object
    {
        public function SystemFormats()
        {
            this.navigationButtonFormat = new flash.text.TextFormat();
            this.disabledNavigationButtonFormat = new flash.text.TextFormat();
            this.mainButtonFormat = new flash.text.TextFormat();
            this.disabledMainButtonFormat = new flash.text.TextFormat();
            this.dialogTextFormat = new flash.text.TextFormat();
            this.redButtonFormat = new flash.text.TextFormat();
            this.disabledRedButtonFormat = new flash.text.TextFormat();
            this.disabledGreenButtonFormat = new flash.text.TextFormat();
            this.darkDropShadow = new flash.filters.DropShadowFilter();
            this.lightDropShadow = new flash.filters.DropShadowFilter();
            super();
            this.disabledRedButtonFormat.color = 3355443;
            this.disabledRedButtonFormat.font = "Arial";
            this.disabledRedButtonFormat.size = 12;
            this.redButtonFormat.color = 16777215;
            this.redButtonFormat.font = "Arial";
            this.redButtonFormat.size = 12;
            this.redButtonFormat.align = flash.text.TextFormatAlign.CENTER;
            this.mainButtonFormat.bold = false;
            this.mainButtonFormat.color = 16777215;
            this.mainButtonFormat.font = "Arial";
            this.mainButtonFormat.size = 12;
            this.mainButtonFormat.align = flash.text.TextFormatAlign.CENTER;
            this.disabledGreenButtonFormat.bold = false;
            this.disabledGreenButtonFormat.color = 3355443;
            this.disabledGreenButtonFormat.font = "Arial";
            this.disabledGreenButtonFormat.size = 12;
            this.disabledMainButtonFormat.bold = false;
            this.disabledMainButtonFormat.color = 3355443;
            this.disabledMainButtonFormat.font = "Arial";
            this.disabledMainButtonFormat.size = 12;
            this.disabledNavigationButtonFormat.color = 3355443;
            this.disabledNavigationButtonFormat.font = "Arial";
            this.disabledNavigationButtonFormat.size = 12;
            this.navigationButtonFormat.color = 2697513;
            this.navigationButtonFormat.font = "Arial";
            this.navigationButtonFormat.size = 12;
            this.dialogTextFormat.color = 16777215;
            this.dialogTextFormat.font = "Arial";
            this.dialogTextFormat.size = 12;
            this.darkDropShadow.blurX = 1;
            this.darkDropShadow.blurY = 1;
            this.darkDropShadow.distance = 1;
            this.darkDropShadow.strength = 1;
            this.darkDropShadow.quality = 1;
            this.darkDropShadow.angle = 90;
            this.darkDropShadow.inner = false;
            this.darkDropShadow.knockout = false;
            this.darkDropShadow.hideObject = false;
            this.darkDropShadow.color = 0;
            this.lightDropShadow.blurX = 1;
            this.lightDropShadow.blurY = 1;
            this.lightDropShadow.distance = 1;
            this.lightDropShadow.strength = 1;
            this.lightDropShadow.quality = 1;
            this.lightDropShadow.angle = 90;
            this.lightDropShadow.inner = false;
            this.lightDropShadow.knockout = false;
            this.lightDropShadow.hideObject = false;
            this.lightDropShadow.color = 16777215;
            return;
        }

        public var mainButtonFormat:flash.text.TextFormat;

        public var disabledRedButtonFormat:flash.text.TextFormat;

        public var darkDropShadow:flash.filters.DropShadowFilter;

        public var lightDropShadow:flash.filters.DropShadowFilter;

        public var dialogTextFormat:flash.text.TextFormat;

        public var disabledGreenButtonFormat:flash.text.TextFormat;

        public var disabledNavigationButtonFormat:flash.text.TextFormat;

        public var redButtonFormat:flash.text.TextFormat;

        public var navigationButtonFormat:flash.text.TextFormat;

        public var disabledMainButtonFormat:flash.text.TextFormat;
    }
}


//          class TestComs
package com.mgs.funbonus.system 
{
    import com.mgs.funbonus.common.interfaces.*;
    
    public class TestComs extends Object implements com.mgs.funbonus.common.interfaces.IFunBonusComs
    {
        public function TestComs()
        {
            super();
            return;
        }

        public function switchLogin(arg1:int):void
        {
            return;
        }

        public function readConfigStringSKE(arg1:String, arg2:String, arg3:Number):String
        {
            return "";
        }

        public function changeBonusOffer():void
        {
            return;
        }

        public function formatCurrency(arg1:int, arg2:String):String
        {
            if (arg2 == "credits") 
            {
                return arg1.toString() + ".00";
            }
            return "$" + arg1.toString() + "";
        }

        public function initExternalComs():void
        {
            return;
        }

        public function executeCasinoFrameCommand(arg1:String, arg2:String=""):void
        {
            return;
        }

        public function getCasinoLoginStatus():int
        {
            return 2;
        }

        public function getCurrencyCode():String
        {
            return "USD";
        }

        public function requestBonusAction(arg1:uint, arg2:uint):void
        {
            return;
        }
    }
}


//          class ViperComs
package com.mgs.funbonus.system 
{
    import com.encode.*;
    import com.mgs.funbonus.common.enums.*;
    import com.mgs.funbonus.common.interfaces.*;
    import flash.external.*;
    
    public class ViperComs extends Object implements com.mgs.funbonus.common.interfaces.IFunBonusComs
    {
        public function ViperComs()
        {
            this.configPattern = new RegExp("\\u2009", "g");
            super();
            return;
        }

        public function switchLogin(arg1:int):void
        {
            flash.external.ExternalInterface.marshallExceptions = true;
            flash.external.ExternalInterface.call("SwitchLogin", arg1);
            return;
        }

        public function executeCasinoFrameCommand(arg1:String, arg2:String=""):void
        {
            flash.external.ExternalInterface.marshallExceptions = false;
            flash.external.ExternalInterface.call("ExecuteCasinoFrameCommand", arg1, arg2);
            return;
        }

        public function readConfigStringSKE(arg1:String, arg2:String, arg3:Number):String
        {
            var expandEnv:Number;
            var section:String;
            var myVal:String;
            var key:String;

            var loc1:*;
            section = arg1;
            key = arg2;
            expandEnv = arg3;
            flash.external.ExternalInterface.marshallExceptions = true;
            myVal = "";
            try 
            {
                myVal = flash.external.ExternalInterface.call("ReadConfigStringSKE", section, key, expandEnv);
                myVal = com.encode.Base64.decode(myVal);
                myVal = myVal.replace(this.configPattern, " ");
            }
            catch (err:Error)
            {
            };
            return myVal;
        }

        public function initExternalComs():void
        {
            flash.external.ExternalInterface.marshallExceptions = false;
            flash.external.ExternalInterface.call("InitBonusBubble");
            return;
        }

        public function getCasinoLoginStatus():int
        {
            flash.external.ExternalInterface.marshallExceptions = true;
            return flash.external.ExternalInterface.call("GetCasinoLoginStatus") as int;
        }

        public function getCurrencyCode():String
        {
            flash.external.ExternalInterface.marshallExceptions = true;
            var loc1:*=flash.external.ExternalInterface.call("GetCurrencyCode") as String;
            return com.encode.Base64.decode(loc1);
        }

        public function requestBonusAction(arg1:uint, arg2:uint):void
        {
            flash.external.ExternalInterface.marshallExceptions = true;
            flash.external.ExternalInterface.call("RequestBonusAction", arg1, arg2);
            return;
        }

        public function formatCurrency(arg1:int, arg2:String):String
        {
            flash.external.ExternalInterface.marshallExceptions = true;
            arg2 = flash.external.ExternalInterface.call("FormatCurrency", arg1, arg2);
            return com.encode.Base64.decode(arg2);
        }

        public function changeBonusOffer():void
        {
            this.requestBonusAction(com.mgs.funbonus.common.enums.FunBonusEnums.BIA_INFORMATION, 0);
            return;
        }

        internal var configPattern:RegExp;
    }
}


//        package views
//          package funbonus
//            package active
//              class ActiveBonus
package com.mgs.funbonus.views.funbonus.active 
{
    import com.mgs.components.tabnavigator.*;
    import com.mgs.funbonus.data.*;
    import com.mgs.funbonus.views.funbonus.*;
    import fl.core.*;
    import fl.data.*;
    
    public class ActiveBonus extends com.mgs.funbonus.views.funbonus.FunBonus
    {
        public function ActiveBonus()
        {
            super();
            return;
        }

        public override function checkStatus():void
        {
            activeBonusDetail.checkStatus();
            return;
        }

        protected override function draw():void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=NaN;
            if (isInvalid(fl.core.InvalidationType.DATA)) 
            {
                loc1 = new fl.data.DataProvider();
                loc1.addItem({"label":system.readConfigString("funbonus.strings", "ActiveBonus", "Active Bonus"), "data":"Active"});
                tabNavigator.dataProvider = loc1;
                tabNavigator.selectedIndex = 0;
                loc3 = 0;
                while (loc3 < dataProvider.length) 
                {
                    loc2 = dataProvider.getItemAt(loc3) as com.mgs.funbonus.data.FunBonusCollectionItem;
                    if (loc2.active) 
                    {
                        activeBonusDetail.funBonusCollectionItem = dataProvider.getItemAt(loc3) as com.mgs.funbonus.data.FunBonusCollectionItem;
                        break;
                    }
                    ++loc3;
                }
                invalidate(fl.core.InvalidationType.ALL, false);
            }
            super.draw();
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            activeBonusDetail.x = 10;
            activeBonusDetail.y = 63;
            activeBonusDetail.height;
            tabNavigator = new com.mgs.components.tabnavigator.CustomTabNavigator();
            tabNavigator.x = 9;
            tabNavigator.y = 41.5;
            tabNavigator.width = 120;
            tabNavigator.height = 30;
            layer.addChild(tabNavigator);
            layer.addChild(activeBonusDetail);
            this.drawNow();
            return;
        }
    }
}


//            package detail
//              class ActiveBonusDetail
package com.mgs.funbonus.views.funbonus.detail 
{
    import com.mgs.funbonus.components.dialogs.*;
    import com.mgs.funbonus.components.timers.*;
    import com.mgs.funbonus.components.tooltip.*;
    import com.mgs.funbonus.data.*;
    import com.mgs.funbonus.system.*;
    import fl.controls.*;
    import fl.core.*;
    import flash.display.*;
    import flash.events.*;
    import flash.text.*;
    import flash.utils.*;
    import mx.utils.*;
    import utils.clips.*;
    
    public class ActiveBonusDetail extends fl.core.UIComponent
    {
        public function ActiveBonusDetail()
        {
            this.invertToColor = com.mgs.funbonus.views.funbonus.detail.ActiveBonusDetail_invertToColor;
            this.invertToColorShader = new flash.display.Shader(new this.invertToColor() as flash.utils.ByteArray);
            this._activeBonusUI = new ActiveBonusLayer();
            this.system = com.mgs.funbonus.system.System.getInstance();
            super();
            return;
        }

        public function get hasQueuedBonus():Boolean
        {
            return this._hasQueuedBonus;
        }

        internal function collectFramePostion(arg1:com.mgs.funbonus.data.FunBonusCollectionItem):uint
        {
            if (arg1.startingBalance >= arg1.currentBalance) 
            {
                return Math.round(this.percentage(arg1.currentBalance, arg1.startingBalance) / 10);
            }
            if (arg1.maxWinAmount == -1) 
            {
                return 20;
            }
            return Math.round(this.percentage(arg1.collectableAmount, arg1.maxWinAmount) * 20 / 100) + 10;
        }

        internal function updatePlayTime(arg1:String, arg2:int):void
        {
            if (arg1 == com.mgs.funbonus.components.timers.Countdown.UPDATE) 
            {
                this._funBonusCollectionItem.playTimeRemaining = arg2;
                this.timeControl.remainingTime.valuePlaytimeRemaining.text = this.system.formatTime(arg2);
            }
            return;
        }

        protected override function draw():void
        {
            var loc1:*=NaN;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=false;
            var loc5:*=NaN;
            var loc6:*=0;
            var loc7:*=null;
            var loc8:*=null;
            var loc9:*=null;
            var loc10:*=null;
            var loc11:*=null;
            var loc12:*=0;
            var loc13:*=null;
            var loc14:*=null;
            var loc15:*=null;
            var loc16:*=null;
            var loc17:*=null;
            var loc18:*=null;
            var loc19:*=NaN;
            if (isInvalid(fl.core.InvalidationType.DATA)) 
            {
                if (this.funBonusCollectionItem != null) 
                {
                    loc1 = 75;
                    var loc20:*=0;
                    var loc21:*=this._refConditions;
                    for each (loc2 in loc21) 
                    {
                        this._activeBonusUI.removeChild(loc2);
                    }
                    if (this.timeControl != null) 
                    {
                        this._activeBonusUI.removeChild(this.timeControl);
                    }
                    this.timeControl = new TimeControl();
                    if (this.funBonusCollectionItem.expiresIn == -1) 
                    {
                        this.timeControl.expiresIn.visible = false;
                    }
                    else 
                    {
                        this.timeControl.expiresIn.labelExpiresIn.htmlText = "<b>" + this.system.readConfigString("funbonus.strings", "ExpiresIn", "Expires In") + "</b>";
                        this.timeControl.expiresIn.labelExpiresIn.width = 200;
                        if (this.expiresCountDown != null) 
                        {
                            this.expiresCountDown.destroy();
                        }
                        this.expiresCountDown = new com.mgs.funbonus.components.timers.Countdown();
                        this.expiresCountDown.updateCounter.add(this.updateExpires);
                        this.expiresCountDown.start(this.funBonusCollectionItem.expiresIn);
                    }
                    if (this.funBonusCollectionItem.playTimeRemaining == -1) 
                    {
                        this.timeControl.remainingTime.visible = false;
                    }
                    else 
                    {
                        this.timeControl.remainingTime.labelPlaytimeRemaining.htmlText = "<b>" + this.system.readConfigString("funbonus.strings", "PlaytimeRemaining", "Playtime") + "</b>";
                        this.timeControl.remainingTime.labelPlaytimeRemaining.width = 200;
                        this.timeControl.remainingTime.labelPlaytimeRemaining.autoSize = flash.text.TextFieldAutoSize.LEFT;
                        if (this.playTimeCountDown != null) 
                        {
                            this.playTimeCountDown.destroy();
                        }
                        this.playTimeCountDown = new com.mgs.funbonus.components.timers.Countdown();
                        this.playTimeCountDown.updateCounter.add(this.updatePlayTime);
                        this.playTimeCountDown.start(this.funBonusCollectionItem.playTimeRemaining);
                        if (this.funBonusCollectionItem.expiresIn != -1) 
                        {
                            this.timeControl.remainingTime.x = 112;
                        }
                        else 
                        {
                            this.timeControl.remainingTime.x = 15.9;
                        }
                    }
                    if (this.funBonusCollectionItem.expiresIn == -1 && this.funBonusCollectionItem.playTimeRemaining == -1) 
                    {
                        loc1 = 25;
                    }
                    else 
                    {
                        loc1 = 75;
                        this.timeControl.x = 10;
                        this.timeControl.y = 20;
                        this._activeBonusUI.addChild(this.timeControl);
                    }
                    if (this.funBonusCollectionItem.collectConditions.length == 1) 
                    {
                        loc1 = 93;
                    }
                    loc4 = true;
                    this._refConditions = [];
                    this._waitingconditions = [];
                    loc5 = 0;
                    while (loc5 < this.funBonusCollectionItem.collectConditions.length) 
                    {
                        loc3 = this.funBonusCollectionItem.collectConditions[loc5] as com.mgs.funbonus.data.CollectConditionItem;
                        if (loc3.id != 1) 
                        {
                            if (loc3.id == 0) 
                            {
                                loc17 = new WagerProgressBar();
                                this.invertToColorShader.precisionHint = flash.display.ShaderPrecision.FULL;
                                loc17.blendMode = flash.display.BlendMode.LAYER;
                                loc17.wagerProgressText.blendShader = this.invertToColorShader;
                                loc17.name = "wagerProgressBar";
                                loc17.wagerProgressText.label.text = this.formatProgress(loc3.id, loc3.current, loc3.end);
                                loc17.gotoAndStop(this.percentage(loc3.current, loc3.end));
                                loc17.x = 9;
                                loc17.y = loc1;
                                loc1 = loc1 + 35;
                                this._refConditions.push(loc17);
                                this._activeBonusUI.addChild(loc17);
                                if (loc3.current < loc3.end) 
                                {
                                    this._waitingconditions.push(this.system.readConfigString("funbonus.strings", "NotMetWageringCondition", " - Complete the required play-through"));
                                    loc4 = false;
                                    this.wagerDone = false;
                                }
                                else 
                                {
                                    this.wagerDone = true;
                                }
                                loc17.message = this.currentMessage(this.system.readConfigString("funbonus.strings", "Wagered", "played-through"), loc3.current, loc3.end, this.system.readConfigString("funbonus.strings", "FunCredits", "Fun Credits"));
                                this.conditionWager = new com.mgs.funbonus.components.tooltip.Tooltip(loc17, loc17.message, com.mgs.funbonus.components.tooltip.Tooltip.UP, 0);
                            }
                        }
                        else 
                        {
                            (loc16 = new DepositProgressBar()).blendMode = flash.display.BlendMode.LAYER;
                            this.invertToColorShader.precisionHint = flash.display.ShaderPrecision.FULL;
                            loc16.depositProgressText.blendShader = this.invertToColorShader;
                            loc16.name = "depositProgressBar";
                            loc16.depositProgressText.label.text = this.formatProgress(loc3.id, loc3.current, loc3.end, this.funBonusCollectionItem.currencyCode);
                            loc16.x = 9;
                            loc16.y = loc1;
                            loc1 = loc1 + 35;
                            this._refConditions.push(loc16);
                            this._activeBonusUI.addChild(loc16);
                            if (loc3.current < loc3.end) 
                            {
                                this._waitingconditions.push(this.system.readConfigString("funbonus.strings", "NotMetDepositCondition", " - Complete the required deposit "));
                                loc4 = false;
                                this.depositDone = false;
                            }
                            else 
                            {
                                this.depositDone = true;
                            }
                            loc16.gotoAndStop(this.percentage(loc3.current, loc3.end));
                            loc16.message = this.currentMessage(this.system.readConfigString("funbonus.strings", "Deposited", "deposited"), loc3.current, loc3.end, this.funBonusCollectionItem.currencyCode);
                            this.conditionDeposit = new com.mgs.funbonus.components.tooltip.Tooltip(loc16, loc16.message, com.mgs.funbonus.components.tooltip.Tooltip.UP, 0);
                        }
                        ++loc5;
                    }
                    loc6 = 147;
                    loc7 = new myArial();
                    (loc8 = new flash.text.TextFormat()).size = 11;
                    loc8.font = loc7.fontName;
                    loc8.color = 0;
                    (loc9 = new utils.clips.CurvedText(this.system.readConfigString("funbonus.strings", "labelStart", "Too Low"), 81, -47, 0, "up", loc8)).x = 18;
                    loc9.y = 67;
                    loc9.showCurve = false;
                    loc9.showLetterBorder = false;
                    loc9.rotation = -34;
                    loc9.draw();
                    this.collectProgressBar.addChild(loc9);
                    (loc10 = new utils.clips.CurvedText(this.system.readConfigString("funbonus.strings", "labelCollect", "Collectable"), 83, 0, 60, "up", loc8)).x = 110;
                    loc10.y = 18;
                    loc10.showCurve = false;
                    loc10.showLetterBorder = false;
                    loc10.rotation = -3;
                    loc10.draw();
                    this.collectProgressBar.addChild(loc10);
                    loc11 = new RegExp("(\\.[\\d]*)$");
                    if (this.funBonusCollectionItem.maxWinAmount == -1) 
                    {
                        this.collectProgressBar.collectRanges.labelMaxLimit.visible = false;
                        this.collectProgressBar.collectRanges.valueMaxLimit.visible = false;
                    }
                    else 
                    {
                        this.collectProgressBar.collectRanges.labelMaxLimit.htmlText = "<b>" + this.system.readConfigString("funbonus.strings", "labelMaxLimit", "Max") + "</b>";
                        this.collectProgressBar.collectRanges.valueMaxLimit.htmlText = this.system.formatCurrency(this.funBonusCollectionItem.maxWinAmount + this.funBonusCollectionItem.startingBalance, "credits").replace(loc11, "");
                    }
                    this.collectProgressBar.collectRanges.labelStartingLimit.htmlText = "<b>" + this.system.readConfigString("funbonus.strings", "labelStartingLimit", "Starting Balance") + "</b>";
                    this.collectProgressBar.labelStart.htmlText = "0";
                    this.collectProgressBar.collectRanges.labelStartingLimit.autoSize = flash.text.TextFieldAutoSize.CENTER;
                    this.collectProgressBar.collectRanges.valueStartingLimit.htmlText = this.system.formatCurrency(this.funBonusCollectionItem.startingBalance, "credits").replace(loc11, "");
                    this.collectProgressBar.gotoAndStop(this.collectFramePostion(this.funBonusCollectionItem));
                    this.collectProgressBar.x = 5;
                    this.collectProgressBar.y = loc6;
                    if ((loc12 = this.collectProgressBar.collectRanges.valueMaxLimit.text.length) > 5) 
                    {
                        this.collectProgressBar.collectRanges.valueMaxLimit.x = this.collectProgressBar.collectRanges.valueMaxLimit.x - (loc12 - 5) * 5;
                        this.collectProgressBar.collectRanges.valueMaxLimit.y = 102;
                    }
                    this.collectButton.y = loc6 + 55;
                    this.collectButtonHitArea.y = this.collectButton.y;
                    this.progressCollectHitArea.y = loc6;
                    if (!(this.toolTip == null) && this.progressCollectHitArea.parent.contains(this.toolTip)) 
                    {
                        this.progressCollectHitArea.parent.removeChild(this.toolTip);
                    }
                    this.toolTip = new com.mgs.funbonus.components.tooltip.Tooltip(this.progressCollectHitArea, this.collectableTooltipText("left"), com.mgs.funbonus.components.tooltip.Tooltip.UP, 0, 3, 11910090, 3488068, false, 1, true, flash.text.TextFormatAlign.LEFT, 160, this.collectableTooltipText("right"));
                    if (loc4) 
                    {
                        this.collectButton.label = mx.utils.StringUtil.substitute(this.system.readConfigString("funbonus.strings", "CanCollect", "COLLECT {0}"), this.system.formatCurrency(this.funBonusCollectionItem.collectableAmount, "credits"));
                        this.collectButton.textField.wordWrap = false;
                        this.collectButton.textField.autoSize = flash.text.TextFieldAutoSize.CENTER;
                        this.collectButton.enabled = true;
                        this.collectButton.drawNow();
                        if (!(this.collectButtonToolTip == null) && this.collectButton.parent.contains(this.collectButtonToolTip)) 
                        {
                            this.collectButton.parent.removeChild(this.collectButtonToolTip);
                        }
                        this.collectButtonToolTip = new com.mgs.funbonus.components.tooltip.Tooltip(this.collectButton, this.collectableTooltipText("left"), com.mgs.funbonus.components.tooltip.Tooltip.UP, 8, 3, 11910090, 3488068, false, 1, true, flash.text.TextFormatAlign.LEFT, 160, this.collectableTooltipText("right"));
                    }
                    else 
                    {
                        this.collectButton.enabled = false;
                        this.collectButton.textField.autoSize = flash.text.TextFieldAutoSize.RIGHT;
                        if (!(this.collectButtonToolTip == null) && this.collectButton.parent.contains(this.collectButtonToolTip)) 
                        {
                            this.collectButton.parent.removeChild(this.collectButtonToolTip);
                        }
                        loc18 = this.system.readConfigString("funbonus.strings", "NotCollectHeader", " <u>Before you can collect you need to:</u>") + "\n\n";
                        loc19 = 0;
                        while (loc19 < this._waitingconditions.length) 
                        {
                            if (loc19 + 1 == this._waitingconditions.length) 
                            {
                                loc18 = loc18 + this._waitingconditions[loc19];
                            }
                            else 
                            {
                                loc18 = loc18 + (this._waitingconditions[loc19] + "\n");
                            }
                            ++loc19;
                        }
                        loc18 = loc18 + "\n";
                        this.collectButtonToolTip = new com.mgs.funbonus.components.tooltip.Tooltip(this.collectButtonHitArea, loc18, com.mgs.funbonus.components.tooltip.Tooltip.UP, -5, 3, 11910090, 3488068, false, 1, true, flash.text.TextFormatAlign.CENTER);
                    }
                    if (!loc4 && this.wagerDone && this.funBonusCollectionItem.currentBalance > this.funBonusCollectionItem.startingBalance) 
                    {
                        this.system.depositAvailable = true;
                    }
                    else 
                    {
                        this.system.depositAvailable = false;
                    }
                    loc13 = mx.utils.StringUtil.substitute(this.system.readConfigString("funbonus.strings", "funBonusBalance", "Your Fun Bonus Balance is <b>{0}</b>"), this.system.formatCurrency(this.funBonusCollectionItem.currentBalance, "credits"));
                    loc14 = new RegExp("[\\n\\r]", "g");
                    loc13 = loc13.replace(loc14, " ");
                    (loc15 = new FunBonusBalance()).labelBalance.htmlText = loc13;
                    loc15.x = 0;
                    loc15.y = loc6 + 120;
                    this._activeBonusUI.addChild(loc15);
                    invalidate(fl.core.InvalidationType.ALL, false);
                    if (this.validateData) 
                    {
                        if (this._funBonusCollectionItem != null) 
                        {
                            if (this._funBonusCollectionItem.currentBalance <= 0) 
                            {
                                if (this.hasQueuedBonus) 
                                {
                                    this.system.alertSignal.dispatch(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_FUNDS_DEPLETED_QUEUED, 0);
                                }
                                else 
                                {
                                    this.system.alertSignal.dispatch(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_FUNDS_DEPLETED, 0);
                                }
                            }
                            else if (this._funBonusCollectionItem.playTimeRemaining == 0) 
                            {
                                if (this.hasQueuedBonus) 
                                {
                                    this.system.alertSignal.dispatch(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_PLAYTIME_EXPIRED_QUEUED, 0);
                                }
                                else 
                                {
                                    this.system.alertSignal.dispatch(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_PLAYTIME_EXPIRED, 0);
                                }
                            }
                        }
                        this.validateData = false;
                    }
                }
            }
            super.draw();
            return;
        }

        public function set funBonusCollectionItem(arg1:com.mgs.funbonus.data.FunBonusCollectionItem):void
        {
            this._funBonusCollectionItem = arg1;
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        public function checkStatus():void
        {
            this.validateData = true;
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        internal function percentage(arg1:uint, arg2:uint):uint
        {
            var loc1:*=arg1 * 100 / arg2;
            return Math.floor(loc1);
        }

        public function get funBonusCollectionItem():com.mgs.funbonus.data.FunBonusCollectionItem
        {
            return this._funBonusCollectionItem;
        }

        internal function formatProgress(arg1:int, arg2:int, arg3:int, arg4:String=""):String
        {
            var loc1:*="";
            var loc2:*=arg3 - arg2;
            var loc3:*=arg2 >= arg3;
            if (arg1 == 1) 
            {
                if (loc3) 
                {
                    loc1 = this.system.readConfigString("funbonus.strings", "DepositConditionCompleted", "Deposit Completed");
                }
                else 
                {
                    loc1 = mx.utils.StringUtil.substitute(this.system.readConfigString("funbonus.strings", "DepositCondition", "Deposit another {0} {1}"), this.system.formatCurrency(arg3 - arg2, "credits"), arg4);
                }
                return loc1;
            }
            if (arg1 == 0) 
            {
                if (loc3) 
                {
                    loc1 = this.system.readConfigString("funbonus.strings", "WagerConditionCompleted", "Play-through Completed");
                }
                else 
                {
                    loc1 = mx.utils.StringUtil.substitute(this.system.readConfigString("funbonus.strings", "WagerCondition", "Play-through another {0}"), this.system.formatCurrency(arg3 - arg2, "credits"));
                }
                return loc1;
            }
            return loc1;
        }

        internal function currentMessage(arg1:String, arg2:int, arg3:int, arg4:String=""):String
        {
            var loc1:*="";
            loc1 = this.system.readConfigString("funbonus.strings", "CollectConditionTooltip", " You have {0} {1} \n of the {2} {3}\n required");
            return loc1 = mx.utils.StringUtil.substitute(loc1, arg1, this.system.formatCurrency(arg2, "credits"), this.system.formatCurrency(arg3, "credits"), arg4);
        }

        internal function drawBitmapFromText(arg1:String, arg2:int, arg3:int, arg4:int):flash.display.Bitmap
        {
            var loc1:*=new myArial();
            var loc2:*;
            (loc2 = new flash.text.TextFormat()).size = 11;
            loc2.align = flash.text.TextFormatAlign.CENTER;
            loc2.font = loc1.fontName;
            var loc3:*;
            (loc3 = new flash.text.TextField()).htmlText = arg1;
            loc3.embedFonts = true;
            loc3.defaultTextFormat = loc2;
            loc3.width = 100;
            loc3.selectable = false;
            loc3.height = 17;
            loc3.x = arg2 + 120;
            loc3.y = arg3;
            this.addChild(loc3);
            var loc4:*;
            (loc4 = new flash.display.BitmapData(100, 17, true, 0)).draw(loc3);
            var loc5:*;
            (loc5 = new flash.display.Bitmap(loc4)).x = arg2;
            loc5.y = arg3;
            return loc5;
        }

        internal function updateExpires(arg1:String, arg2:int):void
        {
            if (arg1 == com.mgs.funbonus.components.timers.Countdown.UPDATE) 
            {
                this._funBonusCollectionItem.expiresIn = arg2;
                this.timeControl.expiresIn.valueExpiresIn.text = this.system.formatTime(arg2);
            }
            return;
        }

        protected override function configUI():void
        {
            this.collectProgressBar = new CollectProgressBar();
            this._activeBonusUI.addChild(this.collectProgressBar);
            this.progressCollectHitArea = new flash.display.Sprite();
            this.progressCollectHitArea.graphics.beginFill(0, 0);
            this.progressCollectHitArea.graphics.drawRoundRect(0, 0, 227, 130, 0, 0);
            this.progressCollectHitArea.graphics.endFill();
            this.progressCollectHitArea.x = 11;
            this.progressCollectHitArea.y = 160;
            this._activeBonusUI.addChild(this.progressCollectHitArea);
            this.collectButtonHitArea = new flash.display.Sprite();
            this.collectButtonHitArea.graphics.beginFill(0, 0);
            this.collectButtonHitArea.graphics.drawRoundRect(0, 0, 91, 67, 80, 80);
            this.collectButtonHitArea.graphics.endFill();
            this.collectButtonHitArea.x = 78;
            this.collectButtonHitArea.y = 195;
            this.collectButton = this.system.buttonBuilder("Collect", "COLLECT", 91, 64, 78, 238, this.collectButtonHandler, "button", "main", Blue_Button_Round_activeSkin, Blue_Button_Round_overSkin, Blue_Button_Round_downSkin, Blue_Button_Round_disabledSkin);
            this.collectButton.textField.width = this.collectButton.textField.textWidth + 100;
            this._activeBonusUI.addChild(this.collectButtonHitArea);
            this._activeBonusUI.addChild(this.collectButton);
            this._activeBonusUI.x = 0;
            this._activeBonusUI.y = 0;
            this.addChild(this._activeBonusUI);
            return;
        }

        internal function passParameters(arg1:Function, arg2:Array):Function
        {
            var method:Function;
            var additionalArguments:Array;

            var loc1:*;
            method = arg1;
            additionalArguments = arg2;
            return function (arg1:flash.events.Event):void
            {
                method.apply(null, [arg1].concat(additionalArguments));
                return;
            }
        }

        public function set hasQueuedBonus(arg1:Boolean):void
        {
            this._hasQueuedBonus = arg1;
            return;
        }

        internal function collectButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.system.displayAlertDialog(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_COLLECT, this._funBonusCollectionItem.id);
            return;
        }

        internal function collectableTooltipText(arg1:String):String
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=null;
            if (arg1 == "left") 
            {
                loc2 = this.system.readConfigString("funbonus.strings", "CurrentBalance", "Current Balance");
                loc3 = this.system.readConfigString("funbonus.strings", "MinusStartingBalance", "- Starting Balance");
                loc4 = this.system.readConfigString("funbonus.strings", "CreditsWonLost", "= Credits Won/Lost");
                loc5 = this.system.readConfigString("funbonus.strings", "EqualCollectableAmount", "Collectable Amount*");
                loc6 = "";
                if (this.funBonusCollectionItem.maxWinAmount == -1) 
                {
                    loc5 = loc5.slice(0, -1);
                }
                else 
                {
                    loc6 = this.system.readConfigString("funbonus.strings", "CollectLimit", "\n *Taking into account the\n<b> {0} max limit</b>");
                    loc6 = mx.utils.StringUtil.substitute(loc6, this.system.formatCurrency(this.funBonusCollectionItem.maxWinAmount, "credits"));
                }
                loc1 = " {0}\n {1}\n {2}\n\n {3}\n {4}";
                return mx.utils.StringUtil.substitute(loc1, loc2, loc3, loc4, loc5, loc6);
            }
            loc2 = this.system.formatCurrency(this.funBonusCollectionItem.currentBalance, "credits");
            loc3 = "-" + this.system.formatCurrency(this.funBonusCollectionItem.startingBalance, "credits");
            loc4 = this.system.formatCurrency(this.funBonusCollectionItem.currentBalance - this.funBonusCollectionItem.startingBalance, "credits");
            loc5 = this.system.formatCurrency(this.funBonusCollectionItem.collectableAmount, "credits");
            loc1 = " {0}\n {1}\n {2}\n\n {3}";
            return mx.utils.StringUtil.substitute(loc1, loc2, loc3, loc4, loc5);
        }

        internal function drawBitmapFromTextField(arg1:flash.text.TextField, arg2:int, arg3:int, arg4:int):flash.display.Bitmap
        {
            var loc1:*;
            (loc1 = new flash.display.BitmapData(arg1.width, arg1.height, true, 0)).draw(arg1);
            var loc2:*;
            (loc2 = new flash.display.Bitmap(loc1)).smoothing = true;
            loc2.x = arg2;
            loc2.y = arg3;
            loc2.scaleX = loc2.width / (loc2.width + 1);
            loc2.scaleY = loc2.height / (loc2.height + 1);
            loc2.z = 0;
            arg1.visible = false;
            return loc2;
        }

        internal var conditionDeposit:com.mgs.funbonus.components.tooltip.Tooltip;

        internal var _activeBonusUI:ActiveBonusLayer;

        internal var collectProgressBar:CollectProgressBar;

        internal var collectButtonHitArea:flash.display.Sprite;

        internal var _hasQueuedBonus:Boolean=false;

        internal var _refConditions:Array;

        internal var system:com.mgs.funbonus.system.System;

        internal var playTimeCountDown:com.mgs.funbonus.components.timers.Countdown;

        internal var depositDone:Boolean=false;

        internal var progressCollectHitArea:flash.display.Sprite;

        internal var timeControl:TimeControl;

        internal var toolTip:com.mgs.funbonus.components.tooltip.Tooltip;

        internal var validateData:Boolean=false;

        internal var _waitingconditions:Array;

        internal var wagerDone:Boolean=true;

        internal var _funBonusCollectionItem:com.mgs.funbonus.data.FunBonusCollectionItem;

        internal var invertToColor:Class;

        internal var conditionsHeader:HeaderTxt;

        internal var collectButtonToolTip:com.mgs.funbonus.components.tooltip.Tooltip;

        internal var invertToColorShader:flash.display.Shader;

        internal var collectHeader:HeaderTxt;

        internal var collectButton:fl.controls.Button;

        internal var expiresCountDown:com.mgs.funbonus.components.timers.Countdown;

        internal var conditionWager:com.mgs.funbonus.components.tooltip.Tooltip;
    }
}


//              class ActiveBonusDetail_invertToColor
package com.mgs.funbonus.views.funbonus.detail 
{
    import mx.core.*;
    
    public class ActiveBonusDetail_invertToColor extends mx.core.ByteArrayAsset
    {
        public function ActiveBonusDetail_invertToColor()
        {
            super();
            return;
        }
    }
}


//            package queued
//              class QueuedBonus
package com.mgs.funbonus.views.funbonus.queued 
{
    import com.mgs.components.tabnavigator.*;
    import com.mgs.components.tabnavigator.events.*;
    import com.mgs.funbonus.components.dialogs.*;
    import com.mgs.funbonus.components.tilelist.*;
    import com.mgs.funbonus.data.*;
    import com.mgs.funbonus.system.*;
    import com.mgs.funbonus.views.funbonus.*;
    import fl.controls.*;
    import fl.core.*;
    import fl.data.*;
    import flash.events.*;
    import flash.text.*;
    import mgs.greensock.*;
    import mgs.greensock.easing.*;
    
    public class QueuedBonus extends com.mgs.funbonus.views.funbonus.FunBonus
    {
        public function QueuedBonus()
        {
            this._queuedBonusUI = new QueuedBonusInner();
            this.warningMessage = new WarningMessage();
            super();
            return;
        }

        protected override function draw():void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=NaN;
            var loc4:*=null;
            if (isInvalid(fl.core.InvalidationType.DATA)) 
            {
                this.counter = 0;
                this.queuedBonuseList.dataProvider.removeAll();
                this.queuedBonuseList.removeAll();
                loc2 = new fl.data.DataProvider();
                loc2.addItem({"label":system.readConfigString("funbonus.strings", "ActiveBonus", "Active Bonus"), "data":"Active"});
                if (dataProvider.length > 2) 
                {
                    loc4 = " (" + String((dataProvider.length - 1)) + ")";
                    loc2.addItem({"label":system.readConfigString("funbonus.strings", "QueuedBonuses", "Queued Bonuses") + loc4, "data":"Queued"});
                }
                else 
                {
                    loc2.addItem({"label":system.readConfigString("funbonus.strings", "QueuedBonus", "Queued Bonus"), "data":"Queued"});
                }
                tabNavigator.dataProvider = loc2;
                tabNavigator.selectedIndex = 0;
                loc3 = 0;
                while (loc3 < dataProvider.length) 
                {
                    this.currentIndex = 1;
                    loc1 = dataProvider.getItemAt(loc3) as com.mgs.funbonus.data.FunBonusCollectionItem;
                    if (loc1.active) 
                    {
                        activeBonusDetail.funBonusCollectionItem = loc1;
                    }
                    else 
                    {
                        activeBonusDetail.hasQueuedBonus = true;
                        this.counter = this.counter + 1;
                        loc1.index = this.counter;
                        this.queuedBonuseList.dataProvider.addItem(loc1);
                    }
                    ++loc3;
                }
                if (this.counter != 1) 
                {
                    this.nextButton.enabled = true;
                    this.prevButton.enabled = false;
                }
                else 
                {
                    this.nextButton.enabled = false;
                    this.prevButton.enabled = false;
                }
                this.activateButton.enabled = true;
                this.warningMessage.visible = false;
                invalidate(fl.core.InvalidationType.ALL, false);
            }
            super.draw();
            return;
        }

        internal function previousButtonHandler(arg1:flash.events.MouseEvent):void
        {
            if (this.slideAnimation == null || !this.slideAnimation._active) 
            {
                --this.currentIndex;
                if (this.currentIndex != 1) 
                {
                    this.activateButton.visible = false;
                    this.activateButton.enabled = false;
                    this.warningMessage.visible = true;
                    this.nextButton.enabled = true;
                    this.prevButton.enabled = true;
                }
                else 
                {
                    this.activateButton.enabled = true;
                    this.activateButton.visible = true;
                    this.warningMessage.visible = false;
                    this.prevButton.enabled = false;
                    this.nextButton.enabled = true;
                }
                this.slideAnimation = new mgs.greensock.TweenLite(this.queuedBonuseList, 1, {"ease":mgs.greensock.easing.Quad.easeOut, "horizontalScrollPosition":this.queuedBonuseList.horizontalScrollPosition - 230});
                this.slideAnimation.play();
            }
            return;
        }

        internal function nextButtonHandler(arg1:flash.events.MouseEvent):void
        {
            if (this.slideAnimation == null || !this.slideAnimation._active) 
            {
                this.currentIndex = this.currentIndex + 1;
                if (this.currentIndex != 1) 
                {
                    this.activateButton.enabled = false;
                    this.activateButton.visible = false;
                    this.warningMessage.visible = true;
                }
                else 
                {
                    this.activateButton.enabled = true;
                    this.activateButton.visible = true;
                    this.warningMessage.visible = false;
                }
                if (this.counter != this.currentIndex) 
                {
                    this.nextButton.enabled = true;
                    this.prevButton.enabled = true;
                }
                else 
                {
                    this.nextButton.enabled = false;
                    this.prevButton.enabled = true;
                }
                this.slideAnimation = new mgs.greensock.TweenLite(this.queuedBonuseList, 1, {"ease":mgs.greensock.easing.Quad.easeOut, "horizontalScrollPosition":this.queuedBonuseList.horizontalScrollPosition + 230});
                this.slideAnimation.play();
            }
            return;
        }

        internal function tabIndexChange(arg1:com.mgs.components.tabnavigator.events.CustomTabEvent):void
        {
            if (arg1.itemName != "Active") 
            {
                if (arg1.itemName == "Queued") 
                {
                    system.updateUIMode(com.mgs.funbonus.system.System.UI_QUEUED_TAB);
                    activeBonusDetail.visible = false;
                    this._queuedBonusUI.visible = true;
                }
            }
            else 
            {
                activeBonusDetail.visible = true;
                this._queuedBonusUI.visible = false;
                system.updateUIMode(com.mgs.funbonus.system.System.UI_ACTIVE_TAB);
            }
            return;
        }

        public override function checkStatus():void
        {
            activeBonusDetail.checkStatus();
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            activeBonusDetail.x = 10;
            activeBonusDetail.y = 63;
            layer.addChild(activeBonusDetail);
            tabNavigator = new com.mgs.components.tabnavigator.CustomTabNavigator();
            tabNavigator.addEventListener(com.mgs.components.tabnavigator.events.CustomTabEvent.ITEM_SELECTED, this.tabIndexChange, false, 0, true);
            tabNavigator.x = 9;
            tabNavigator.y = 41.5;
            tabNavigator.width = 253;
            tabNavigator.height = 30;
            this._queuedBonusUI.x = 0;
            this._queuedBonusUI.y = 50;
            var loc1:*=new flash.text.TextFormat();
            loc1.bold = true;
            loc1.color = 3421756;
            loc1.font = "Arial";
            loc1.size = 10;
            this.queuedBonuseList = new fl.controls.TileList();
            this.queuedBonuseList.scrollPolicy = fl.controls.ScrollPolicy.OFF;
            this.queuedBonuseList.columnWidth = 230;
            this.queuedBonuseList.rowHeight = 180;
            this.queuedBonuseList.rowCount = 1;
            this.queuedBonuseList.cacheAsBitmap = true;
            this.queuedBonuseList.setStyle("cellRenderer", com.mgs.funbonus.components.tilelist.QueuedBonusRenderer);
            this.queuedBonuseList.width = 230;
            this.queuedBonuseList.height = 180;
            this.queuedBonuseList.x = 20;
            this.queuedBonuseList.y = 50;
            this._queuedBonusUI.addChild(this.queuedBonuseList);
            this.activateButton = system.buttonBuilder("ActivateBonus", "Activate this Bonus", 210, 36, 30, 242, this.forfeitButtonHandler, "button", "main", Red_Button_upSkin, Red_Button_overSkin, Red_Button_downSkin, Red_Button_disabledSkin);
            this.activateButton.textField.autoSize = flash.text.TextFieldAutoSize.RIGHT;
            this.warningMessage.errorMessage.htmlText = system.readConfigString("funbonus.strings", "ActivateBonusToolTip", "Only the <b>first bonus</b>\n in the queue can be <b>activated</b>.");
            this.warningMessage.x = 30;
            this.warningMessage.y = 242;
            this.warningMessage.visible = false;
            this._queuedBonusUI.addChild(this.warningMessage);
            this._queuedBonusUI.addChild(this.activateButton);
            this.activateButton.drawNow();
            this.prevButton = system.buttonBuilder("", "", 15, 150, 8, 70, this.previousButtonHandler, "button", "nav", Left_Button_upSkin, Left_Button_overSkin, Left_Button_downSkin, Left_Button_disabledSkin);
            this._queuedBonusUI.addChild(this.prevButton);
            this.nextButton = system.buttonBuilder("", "", 15, 150, 247, 70, this.nextButtonHandler, "button", "nav", Right_Button_upSkin, Right_Button_overSkin, Right_Button_downSkin, Right_Button_disabledSkin);
            this._queuedBonusUI.addChild(this.nextButton);
            layer.addChild(this._queuedBonusUI);
            layer.addChild(tabNavigator);
            return;
        }

        internal function forfeitButtonHandler(arg1:flash.events.MouseEvent):void
        {
            system.displayAlertDialog(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_ACTIVATE, com.mgs.funbonus.data.FunBonusCollectionItem(dataProvider.getItemAt(0)).id);
            return;
        }

        public override function setPlayMode(arg1:String):void
        {
            if (!(playWithButton == null) && activeBonusDetail.contains(playWithButton)) 
            {
                activeBonusDetail.removeChild(playWithButton);
            }
            if (arg1 == com.mgs.funbonus.system.System.FUNPLAY) 
            {
                playWithButton = system.buttonBuilder("PlayRealMoney", "PLAY WITH REAL MONEY", 245, 37, 3, 292, playRealButtonHandler, "button", "main", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                activeBonusDetail.addChild(playWithButton);
            }
            return;
        }

        internal var _queuedBonusUI:QueuedBonusInner;

        internal var prevButton:fl.controls.Button;

        internal var warningMessage:WarningMessage;

        internal var slideAnimation:mgs.greensock.TweenLite;

        internal var nextButton:fl.controls.Button;

        internal var currentState:Number;

        internal var activateButton:fl.controls.Button;

        internal var currentIndex:Number;

        internal var queuedBonuseList:fl.controls.TileList;

        internal var counter:Number=1;
    }
}


//            class FunBonus
package com.mgs.funbonus.views.funbonus 
{
    import com.mgs.components.tabnavigator.*;
    import com.mgs.funbonus.components.tooltip.*;
    import com.mgs.funbonus.system.*;
    import com.mgs.funbonus.views.funbonus.detail.*;
    import fl.controls.*;
    import fl.core.*;
    import fl.data.*;
    import fl.events.*;
    import flash.events.*;
    import flash.text.*;
    import flash.utils.*;
    import mx.utils.*;
    import org.osflash.signals.*;
    
    public class FunBonus extends fl.core.UIComponent
    {
        public function FunBonus()
        {
            this._layer = new Panel_FunBonus();
            this._funBonusLogo = new Logo_FunBonus();
            this.activeBonusDetail = new com.mgs.funbonus.views.funbonus.detail.ActiveBonusDetail();
            this.system = com.mgs.funbonus.system.System.getInstance();
            this.createdTime = new Date();
            this.updateTimer = new flash.utils.Timer(60000);
            super();
            if (this.dataProvider == null) 
            {
                this.dataProvider = new fl.data.DataProvider();
            }
            this.updateTimer.addEventListener(flash.events.TimerEvent.TIMER, this.updateToolTip, false, 0, true);
            this.switchSignal = new org.osflash.signals.Signal();
            this.closeSignal = new org.osflash.signals.Signal();
            return;
        }

        protected function handleDataChange(arg1:fl.events.DataChangeEvent):void
        {
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        protected function playFunButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.playWithButton.enabled = false;
            this.switchSignal.dispatch(com.mgs.funbonus.system.System.REALPLAY);
            return;
        }

        public function get layer():Panel_FunBonus
        {
            return this._layer;
        }

        internal function termsButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.system.loadTermsAndConditions();
            return;
        }

        protected override function configUI():void
        {
            if (this.system.type != "aurora") 
            {
                this._layer.gotoAndStop(1);
            }
            else 
            {
                this._layer.gotoAndStop(2);
            }
            super.configUI();
            var loc1:*=this.system.buttonBuilder("", "", 14, 15, 247, 8, this.closeButtonHandler, "button", null, Close_Button_upSkin, Close_Button_overSkin, Close_Button_downSkin, Close_Button_disabledSkin);
            this.layer.addChild(loc1);
            var loc2:*=this.system.buttonBuilder("", "", 14, 15, 230, 8, this.helpButtonHandler, "button", null, Tutorial_Button_upSkin, Tutorial_Button_overSkin, Tutorial_Button_downSkin, Tutorial_Button_disabledSkin);
            this.layer.addChild(loc2);
            var loc3:*=this.system.buttonBuilder("TermsConditions", "Terms and Conditions", 200, 18, 40, 400, this.termsButtonHandler, "linkbutton");
            this.layer.addChild(loc3);
            this.addChild(this._layer);
            return;
        }

        internal function refreshButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.system.refresh();
            return;
        }

        internal function closeButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.closeSignal.dispatch();
            return;
        }

        internal function updateToolTip(arg1:flash.events.TimerEvent):void
        {
            var loc1:*=new Date().getTime() - this.createdTime.getTime();
            var loc2:*=Math.round(loc1 / 1000 / 60);
            if (loc2 < 2) 
            {
                this.refreshToolTip.text = mx.utils.StringUtil.substitute(this.system.readConfigString("funbonus.strings", "RefreshCounter", "{0} Minute since \n the last Refresh"), loc2);
            }
            else 
            {
                this.refreshToolTip.text = mx.utils.StringUtil.substitute(this.system.readConfigString("funbonus.strings", "MinutesRefreshCounter", "{0} Minutes since \n the last Refresh"), loc2);
            }
            return;
        }

        protected function playRealButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.playWithButton.enabled = false;
            this.switchSignal.dispatch(com.mgs.funbonus.system.System.REALPLAY);
            return;
        }

        public function checkStatus():void
        {
            return;
        }

        public function set dataProvider(arg1:fl.data.DataProvider):void
        {
            if (this._dataProvider != null) 
            {
                this._dataProvider.removeEventListener(fl.events.DataChangeEvent.DATA_CHANGE, this.handleDataChange);
            }
            this._dataProvider = arg1;
            this._dataProvider.addEventListener(fl.events.DataChangeEvent.DATA_CHANGE, this.handleDataChange, false, 0, true);
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        internal function helpButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.system.loadTutorial();
            return;
        }

        public function setPlayMode(arg1:String):void
        {
            if (!(this.playWithButton == null) && this.activeBonusDetail.contains(this.playWithButton)) 
            {
                this.activeBonusDetail.removeChild(this.playWithButton);
            }
            if (arg1 == com.mgs.funbonus.system.System.FUNPLAY) 
            {
                this.playWithButton = this.system.buttonBuilder("PlayRealMoney", "PLAY WITH REAL MONEY", 245, 37, 3, 292, this.playRealButtonHandler, "button", "main", Green_Button_upSkin, Green_Button_overSkin, Green_Button_downSkin, Green_Button_disabledSkin);
                this.playWithButton.textField.autoSize = flash.text.TextFieldAutoSize.RIGHT;
                this.playWithButton.textField.width = this.playWithButton.textField.textWidth + 10;
                this.activeBonusDetail.addChild(this.playWithButton);
            }
            return;
        }

        public function get dataProvider():fl.data.DataProvider
        {
            return this._dataProvider;
        }

        public var closeSignal:org.osflash.signals.Signal;

        protected var tabNavigator:com.mgs.components.tabnavigator.CustomTabNavigator;

        internal var updateTimer:flash.utils.Timer;

        internal var refreshToolTip:com.mgs.funbonus.components.tooltip.Tooltip;

        internal var _funBonusLogo:Logo_FunBonus;

        internal var _layer:Panel_FunBonus;

        internal var createdTime:Date;

        internal var _dataProvider:fl.data.DataProvider;

        protected var activeBonusDetail:com.mgs.funbonus.views.funbonus.detail.ActiveBonusDetail;

        protected var playWithButton:fl.controls.Button;

        protected var system:com.mgs.funbonus.system.System;

        public var switchSignal:org.osflash.signals.Signal;
    }
}


//          package realmoney
//            class RealMoney
package com.mgs.funbonus.views.realmoney 
{
    import com.mgs.funbonus.data.*;
    import com.mgs.funbonus.system.*;
    import fl.controls.*;
    import fl.core.*;
    import fl.events.*;
    import flash.events.*;
    import flash.text.*;
    import mx.utils.*;
    import org.osflash.signals.*;
    
    public class RealMoney extends fl.core.UIComponent
    {
        public function RealMoney()
        {
            this.system = com.mgs.funbonus.system.System.getInstance();
            this._realMoneyUI = new Panel_RealMoney();
            this._header_FunBonus = new Header_FunBonus();
            super();
            this.closeSignal = new org.osflash.signals.Signal();
            this.switchSignal = new org.osflash.signals.Signal();
            return;
        }

        internal function closeButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.closeSignal.dispatch();
            return;
        }

        protected override function draw():void
        {
            var loc1:*=null;
            if (isInvalid(fl.core.InvalidationType.DATA)) 
            {
                loc1 = this.realMoneyCollectionItem;
                this._realMoneyUI.txtBalance.text = mx.utils.StringUtil.substitute(this._realMoneyUI.txtBalance.text, "(" + loc1.currencyCode + ")");
                this._realMoneyUI.BalanceNum.text = this.system.formatCurrency(loc1.realBalance, "credits");
                this._realMoneyUI.BonusNum.text = this.system.formatCurrency(loc1.bonusBalance, "credits");
                this._realMoneyUI.TotalCreditsNum.text = this.system.formatCurrency(loc1.totalCredits, "credits");
                if (loc1.showLink) 
                {
                    this._header_FunBonus.x = 1.5;
                    this._header_FunBonus.y = 115;
                    this._header_FunBonus.addChild(this.helpButton);
                    this._realMoneyUI.addChild(this._header_FunBonus);
                    this._realMoneyUI.addChild(this.playWithButton);
                    this._realMoneyUI.innerPanel.height = 190;
                    this.helpButton.drawNow();
                    this.playWithButton.drawNow();
                }
                invalidate(fl.core.InvalidationType.ALL, false);
            }
            super.draw();
            return;
        }

        internal function playFunButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.playWithButton.enabled = false;
            this.switchSignal.dispatch(com.mgs.funbonus.system.System.FUNPLAY);
            return;
        }

        protected function handleDataChange(arg1:fl.events.DataChangeEvent):void
        {
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        public function get realMoneyCollectionItem():com.mgs.funbonus.data.RealMoneyCollectionItem
        {
            return this._realMoneyCollectionItem;
        }

        public function set realMoneyCollectionItem(arg1:com.mgs.funbonus.data.RealMoneyCollectionItem):void
        {
            this._realMoneyCollectionItem = arg1;
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            if (this.system.type != "aurora") 
            {
                this._realMoneyUI.innerPanel.gotoAndStop(1);
            }
            else 
            {
                this._realMoneyUI.innerPanel.gotoAndStop(2);
            }
            var loc1:*=this.system.buttonBuilder("", "", 14, 15, 247, 8, this.closeButtonHandler, "button", null, Close_Button_upSkin, Close_Button_overSkin, Close_Button_downSkin, Close_Button_disabledSkin);
            this._realMoneyUI.HeaderRealMoneyText.text = this.system.readConfigString("funbonus.strings", "RealMoney", "REAL MONEY");
            this._realMoneyUI.txtBalance.text = this.system.readConfigString("funbonus.strings", "Balance", "Balance {0}");
            this._realMoneyUI.txtBonus.text = this.system.readConfigString("funbonus.strings", "Bonus", "Bonus");
            this._realMoneyUI.txtTotalCredits.text = this.system.readConfigString("funbonus.strings", "TotalCredits", "Total Credits");
            this._realMoneyUI.BalanceNum.text = "";
            this._realMoneyUI.BonusNum.text = "";
            this._realMoneyUI.TotalCreditsNum.text = "";
            this._realMoneyUI.BalanceNum.autoSize = flash.text.TextFieldAutoSize.RIGHT;
            this._realMoneyUI.BonusNum.autoSize = flash.text.TextFieldAutoSize.RIGHT;
            this._realMoneyUI.TotalCreditsNum.autoSize = flash.text.TextFieldAutoSize.RIGHT;
            this.helpButton = this.system.buttonBuilder("", "", 14, 15, 247, 8, this.helpButtonHandler, "button", null, Tutorial_Button_upSkin, Tutorial_Button_overSkin, Tutorial_Button_downSkin, Tutorial_Button_disabledSkin);
            this.playWithButton = this.system.buttonBuilder("PlayFunBonus", "Play with my Fun Bonus", 350, 20, -5, 150, this.playFunButtonHandler, "linkbuttonleft");
            this._realMoneyUI.addChild(loc1);
            this.addChild(this._realMoneyUI);
            return;
        }

        internal function helpButtonHandler(arg1:flash.events.MouseEvent):void
        {
            this.system.loadTutorial();
            return;
        }

        public var closeSignal:org.osflash.signals.Signal;

        internal var playWithButton:fl.controls.Button;

        internal var system:com.mgs.funbonus.system.System;

        internal var _header_FunBonus:Header_FunBonus;

        internal var _realMoneyCollectionItem:com.mgs.funbonus.data.RealMoneyCollectionItem;

        internal var _realMoneyUI:Panel_RealMoney;

        internal var helpButton:fl.controls.Button;

        public var switchSignal:org.osflash.signals.Signal;
    }
}


//  package fl
//    package containers
//      class BaseScrollPane
package fl.containers 
{
    import fl.controls.*;
    import fl.core.*;
    import fl.events.*;
    import flash.display.*;
    import flash.events.*;
    import flash.geom.*;
    
    public class BaseScrollPane extends fl.core.UIComponent
    {
        public function BaseScrollPane()
        {
            super();
            return;
        }

        public function set horizontalPageScrollSize(arg1:Number):void
        {
            _horizontalPageScrollSize = arg1;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public function get verticalPageScrollSize():Number
        {
            if (isNaN(availableHeight)) 
            {
                drawNow();
            }
            return _verticalPageScrollSize == 0 && !isNaN(availableHeight) ? availableHeight : _verticalPageScrollSize;
        }

        public function set verticalPageScrollSize(arg1:Number):void
        {
            _verticalPageScrollSize = arg1;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public function get horizontalScrollBar():fl.controls.ScrollBar
        {
            return _horizontalScrollBar;
        }

        public function get verticalScrollBar():fl.controls.ScrollBar
        {
            return _verticalScrollBar;
        }

        protected override function configUI():void
        {
            super.configUI();
            contentScrollRect = new flash.geom.Rectangle(0, 0, 85, 85);
            _verticalScrollBar = new fl.controls.ScrollBar();
            _verticalScrollBar.addEventListener(fl.events.ScrollEvent.SCROLL, handleScroll, false, 0, true);
            _verticalScrollBar.visible = false;
            _verticalScrollBar.lineScrollSize = defaultLineScrollSize;
            addChild(_verticalScrollBar);
            copyStylesToChild(_verticalScrollBar, SCROLL_BAR_STYLES);
            _horizontalScrollBar = new fl.controls.ScrollBar();
            _horizontalScrollBar.direction = fl.controls.ScrollBarDirection.HORIZONTAL;
            _horizontalScrollBar.addEventListener(fl.events.ScrollEvent.SCROLL, handleScroll, false, 0, true);
            _horizontalScrollBar.visible = false;
            _horizontalScrollBar.lineScrollSize = defaultLineScrollSize;
            addChild(_horizontalScrollBar);
            copyStylesToChild(_horizontalScrollBar, SCROLL_BAR_STYLES);
            disabledOverlay = new flash.display.Shape();
            var loc1:*=disabledOverlay.graphics;
            loc1.beginFill(16777215);
            loc1.drawRect(0, 0, width, height);
            loc1.endFill();
            addEventListener(flash.events.MouseEvent.MOUSE_WHEEL, handleWheel, false, 0, true);
            return;
        }

        public function get horizontalScrollPosition():Number
        {
            return _horizontalScrollBar.scrollPosition;
        }

        protected function setContentSize(arg1:Number, arg2:Number):void
        {
            if ((contentWidth == arg1 || useFixedHorizontalScrolling) && contentHeight == arg2) 
            {
                return;
            }
            contentWidth = arg1;
            contentHeight = arg2;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        protected function handleScroll(arg1:fl.events.ScrollEvent):void
        {
            if (arg1.target != _verticalScrollBar) 
            {
                setHorizontalScrollPosition(arg1.position);
            }
            else 
            {
                setVerticalScrollPosition(arg1.position);
            }
            return;
        }

        protected function handleWheel(arg1:flash.events.MouseEvent):void
        {
            if (!enabled || !_verticalScrollBar.visible || contentHeight <= availableHeight) 
            {
                return;
            }
            _verticalScrollBar.scrollPosition = _verticalScrollBar.scrollPosition - arg1.delta * verticalLineScrollSize;
            setVerticalScrollPosition(_verticalScrollBar.scrollPosition);
            dispatchEvent(new fl.events.ScrollEvent(fl.controls.ScrollBarDirection.VERTICAL, arg1.delta, horizontalScrollPosition));
            return;
        }

        protected function setHorizontalScrollPosition(arg1:Number, arg2:Boolean=false):void
        {
            return;
        }

        protected function setVerticalScrollPosition(arg1:Number, arg2:Boolean=false):void
        {
            return;
        }

        protected override function draw():void
        {
            if (isInvalid(fl.core.InvalidationType.STYLES)) 
            {
                setStyles();
                drawBackground();
                if (contentPadding != getStyleValue("contentPadding")) 
                {
                    invalidate(fl.core.InvalidationType.SIZE, false);
                }
            }
            if (isInvalid(fl.core.InvalidationType.SIZE, fl.core.InvalidationType.STATE)) 
            {
                drawLayout();
            }
            updateChildren();
            super.draw();
            return;
        }

        protected function setStyles():void
        {
            copyStylesToChild(_verticalScrollBar, SCROLL_BAR_STYLES);
            copyStylesToChild(_horizontalScrollBar, SCROLL_BAR_STYLES);
            return;
        }

        protected function drawBackground():void
        {
            var loc1:*=background;
            background = getDisplayObjectInstance(getStyleValue("skin"));
            background.width = width;
            background.height = height;
            addChildAt(background, 0);
            if (!(loc1 == null) && !(loc1 == background)) 
            {
                removeChild(loc1);
            }
            return;
        }

        protected function drawLayout():void
        {
            calculateAvailableSize();
            calculateContentWidth();
            background.width = width;
            background.height = height;
            if (vScrollBar) 
            {
                _verticalScrollBar.visible = true;
                _verticalScrollBar.x = width - fl.controls.ScrollBar.WIDTH - contentPadding;
                _verticalScrollBar.y = contentPadding;
                _verticalScrollBar.height = availableHeight;
            }
            else 
            {
                _verticalScrollBar.visible = false;
            }
            _verticalScrollBar.setScrollProperties(availableHeight, 0, contentHeight - availableHeight, verticalPageScrollSize);
            setVerticalScrollPosition(_verticalScrollBar.scrollPosition, false);
            if (hScrollBar) 
            {
                _horizontalScrollBar.visible = true;
                _horizontalScrollBar.x = contentPadding;
                _horizontalScrollBar.y = height - fl.controls.ScrollBar.WIDTH - contentPadding;
                _horizontalScrollBar.width = availableWidth;
            }
            else 
            {
                _horizontalScrollBar.visible = false;
            }
            _horizontalScrollBar.setScrollProperties(availableWidth, 0, useFixedHorizontalScrolling ? _maxHorizontalScrollPosition : contentWidth - availableWidth, horizontalPageScrollSize);
            setHorizontalScrollPosition(_horizontalScrollBar.scrollPosition, false);
            drawDisabledOverlay();
            return;
        }

        protected function calculateAvailableSize():void
        {
            var loc1:*=fl.controls.ScrollBar.WIDTH;
            var loc6:*;
            contentPadding = loc6 = Number(getStyleValue("contentPadding"));
            var loc2:*=loc6;
            var loc3:*=height - 2 * loc2 - vOffset;
            vScrollBar = _verticalScrollPolicy == fl.controls.ScrollPolicy.ON || _verticalScrollPolicy == fl.controls.ScrollPolicy.AUTO && contentHeight > loc3;
            var loc4:*=width - (vScrollBar ? loc1 : 0) - 2 * loc2;
            var loc5:*=useFixedHorizontalScrolling ? _maxHorizontalScrollPosition : contentWidth - loc4;
            hScrollBar = _horizontalScrollPolicy == fl.controls.ScrollPolicy.ON || _horizontalScrollPolicy == fl.controls.ScrollPolicy.AUTO && loc5 > 0;
            if (hScrollBar) 
            {
                loc3 = loc3 - loc1;
            }
            if (hScrollBar && !vScrollBar && _verticalScrollPolicy == fl.controls.ScrollPolicy.AUTO && contentHeight > loc3) 
            {
                vScrollBar = true;
                loc4 = loc4 - loc1;
            }
            availableHeight = loc3 + vOffset;
            availableWidth = loc4;
            return;
        }

        protected function calculateContentWidth():void
        {
            return;
        }

        protected function updateChildren():void
        {
            var loc1:*;
            _horizontalScrollBar.enabled = loc1 = enabled;
            _verticalScrollBar.enabled = loc1;
            _verticalScrollBar.drawNow();
            _horizontalScrollBar.drawNow();
            return;
        }

        public static function getStyleDefinition():Object
        {
            return mergeStyles(defaultStyles, fl.controls.ScrollBar.getStyleDefinition());
        }

        
        {
            defaultStyles = {"repeatDelay":500, "repeatInterval":35, "skin":"ScrollPane_upSkin", "contentPadding":0, "disabledAlpha":0.5};
        }

        public override function set enabled(arg1:Boolean):void
        {
            if (enabled == arg1) 
            {
                return;
            }
            _verticalScrollBar.enabled = arg1;
            _horizontalScrollBar.enabled = arg1;
            super.enabled = arg1;
            return;
        }

        public function get horizontalScrollPolicy():String
        {
            return _horizontalScrollPolicy;
        }

        public function set horizontalScrollPolicy(arg1:String):void
        {
            _horizontalScrollPolicy = arg1;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public function get verticalScrollPolicy():String
        {
            return _verticalScrollPolicy;
        }

        public function set verticalScrollPolicy(arg1:String):void
        {
            _verticalScrollPolicy = arg1;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public function get horizontalLineScrollSize():Number
        {
            return _horizontalScrollBar.lineScrollSize;
        }

        public function set horizontalLineScrollSize(arg1:Number):void
        {
            _horizontalScrollBar.lineScrollSize = arg1;
            return;
        }

        public function get verticalLineScrollSize():Number
        {
            return _verticalScrollBar.lineScrollSize;
        }

        public function set verticalLineScrollSize(arg1:Number):void
        {
            _verticalScrollBar.lineScrollSize = arg1;
            return;
        }

        protected function drawDisabledOverlay():void
        {
            if (enabled) 
            {
                if (contains(disabledOverlay)) 
                {
                    removeChild(disabledOverlay);
                }
            }
            else 
            {
                var loc1:*;
                disabledOverlay.y = loc1 = contentPadding;
                disabledOverlay.x = loc1;
                disabledOverlay.width = availableWidth;
                disabledOverlay.height = availableHeight;
                disabledOverlay.alpha = getStyleValue("disabledAlpha") as Number;
                addChild(disabledOverlay);
            }
            return;
        }

        public function set horizontalScrollPosition(arg1:Number):void
        {
            drawNow();
            _horizontalScrollBar.scrollPosition = arg1;
            setHorizontalScrollPosition(_horizontalScrollBar.scrollPosition, false);
            return;
        }

        public function get verticalScrollPosition():Number
        {
            return _verticalScrollBar.scrollPosition;
        }

        public function set verticalScrollPosition(arg1:Number):void
        {
            drawNow();
            _verticalScrollBar.scrollPosition = arg1;
            setVerticalScrollPosition(_verticalScrollBar.scrollPosition, false);
            return;
        }

        public function get maxHorizontalScrollPosition():Number
        {
            drawNow();
            return Math.max(0, contentWidth - availableWidth);
        }

        public function get maxVerticalScrollPosition():Number
        {
            drawNow();
            return Math.max(0, contentHeight - availableHeight);
        }

        public function get useBitmapScrolling():Boolean
        {
            return _useBitmpScrolling;
        }

        public function set useBitmapScrolling(arg1:Boolean):void
        {
            _useBitmpScrolling = arg1;
            invalidate(fl.core.InvalidationType.STATE);
            return;
        }

        public function get horizontalPageScrollSize():Number
        {
            if (isNaN(availableWidth)) 
            {
                drawNow();
            }
            return _horizontalPageScrollSize == 0 && !isNaN(availableWidth) ? availableWidth : _horizontalPageScrollSize;
        }

        protected static const SCROLL_BAR_STYLES:Object={"upArrowDisabledSkin":"upArrowDisabledSkin", "upArrowDownSkin":"upArrowDownSkin", "upArrowOverSkin":"upArrowOverSkin", "upArrowUpSkin":"upArrowUpSkin", "downArrowDisabledSkin":"downArrowDisabledSkin", "downArrowDownSkin":"downArrowDownSkin", "downArrowOverSkin":"downArrowOverSkin", "downArrowUpSkin":"downArrowUpSkin", "thumbDisabledSkin":"thumbDisabledSkin", "thumbDownSkin":"thumbDownSkin", "thumbOverSkin":"thumbOverSkin", "thumbUpSkin":"thumbUpSkin", "thumbIcon":"thumbIcon", "trackDisabledSkin":"trackDisabledSkin", "trackDownSkin":"trackDownSkin", "trackOverSkin":"trackOverSkin", "trackUpSkin":"trackUpSkin", "repeatDelay":"repeatDelay", "repeatInterval":"repeatInterval"};

        protected var _verticalScrollBar:fl.controls.ScrollBar;

        protected var _horizontalScrollBar:fl.controls.ScrollBar;

        protected var contentScrollRect:flash.geom.Rectangle;

        protected var disabledOverlay:flash.display.Shape;

        protected var background:flash.display.DisplayObject;

        protected var contentWidth:Number=0;

        protected var _horizontalScrollPolicy:String;

        protected var _verticalScrollPolicy:String;

        protected var contentPadding:Number=0;

        protected var availableWidth:Number;

        protected var availableHeight:Number;

        protected var vOffset:Number=0;

        protected var vScrollBar:Boolean;

        protected var hScrollBar:Boolean;

        protected var _maxHorizontalScrollPosition:Number=0;

        protected var _horizontalPageScrollSize:Number=0;

        protected var _verticalPageScrollSize:Number=0;

        protected var defaultLineScrollSize:Number=4;

        protected var useFixedHorizontalScrolling:Boolean=false;

        protected var _useBitmpScrolling:Boolean=false;

        protected var contentHeight:Number=0;

        internal static var defaultStyles:Object;
    }
}


//      class UILoader
package fl.containers 
{
    import fl.core.*;
    import fl.display.*;
    import fl.events.*;
    import flash.display.*;
    import flash.events.*;
    import flash.net.*;
    import flash.system.*;
    import flash.utils.*;
    
    public class UILoader extends fl.core.UIComponent
    {
        public function UILoader()
        {
            super();
            return;
        }

        protected function clearLoadEvents():void
        {
            loader.contentLoaderInfo.removeEventListener(flash.events.IOErrorEvent.IO_ERROR, handleError);
            loader.contentLoaderInfo.removeEventListener(flash.events.SecurityErrorEvent.SECURITY_ERROR, handleError);
            loader.contentLoaderInfo.removeEventListener(flash.events.Event.OPEN, passEvent);
            loader.contentLoaderInfo.removeEventListener(flash.events.ProgressEvent.PROGRESS, passEvent);
            loader.contentLoaderInfo.removeEventListener(flash.events.HTTPStatusEvent.HTTP_STATUS, passEvent);
            loader.contentLoaderInfo.removeEventListener(flash.events.Event.COMPLETE, handleComplete);
            return;
        }

        protected override function draw():void
        {
            if (isInvalid(fl.core.InvalidationType.SIZE)) 
            {
                drawLayout();
            }
            super.draw();
            return;
        }

        protected function drawLayout():void
        {
            var loc2:*=NaN;
            var loc3:*=NaN;
            var loc6:*=null;
            if (!contentInited) 
            {
                return;
            }
            var loc1:*=false;
            if (loader) 
            {
                loc2 = (loc6 = loader.contentLoaderInfo).width;
                loc3 = loc6.height;
            }
            else 
            {
                loc2 = contentClip.width;
                loc3 = contentClip.height;
            }
            var loc4:*=_width;
            var loc5:*=_height;
            if (_scaleContent) 
            {
                sizeContent(contentClip, loc2, loc3, _width, _height);
            }
            else 
            {
                _width = contentClip.width;
                _height = contentClip.height;
            }
            if (!(loc4 == _width) || !(loc5 == _height)) 
            {
                dispatchEvent(new fl.events.ComponentEvent(fl.events.ComponentEvent.RESIZE, true));
            }
            return;
        }

        protected function sizeContent(arg1:flash.display.DisplayObject, arg2:Number, arg3:Number, arg4:Number, arg5:Number):void
        {
            var loc3:*=NaN;
            var loc4:*=NaN;
            var loc1:*=arg4;
            var loc2:*=arg5;
            if (_maintainAspectRatio) 
            {
                loc3 = arg4 / arg5;
                loc4 = arg2 / arg3;
                if (loc3 < loc4) 
                {
                    loc2 = loc1 / loc4;
                }
                else 
                {
                    loc1 = loc2 * loc4;
                }
            }
            arg1.width = loc1;
            arg1.height = loc2;
            arg1.x = arg4 / 2 - loc1 / 2;
            arg1.y = arg5 / 2 - loc2 / 2;
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            contentClip = new flash.display.Sprite();
            addChild(contentClip);
            return;
        }

        public static function getStyleDefinition():Object
        {
            return defaultStyles;
        }

        
        {
            defaultStyles = {};
        }

        public override function setSize(arg1:Number, arg2:Number):void
        {
            if (!_scaleContent && _width > 0) 
            {
                return;
            }
            super.setSize(arg1, arg2);
            return;
        }

        public function get autoLoad():Boolean
        {
            return _autoLoad;
        }

        public function set autoLoad(arg1:Boolean):void
        {
            _autoLoad = arg1;
            if (_autoLoad && loader == null && !(_source == null) && !(_source == "")) 
            {
                load();
            }
            return;
        }

        public function get scaleContent():Boolean
        {
            return _scaleContent;
        }

        public function set scaleContent(arg1:Boolean):void
        {
            if (_scaleContent == arg1) 
            {
                return;
            }
            _scaleContent = arg1;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public function get maintainAspectRatio():Boolean
        {
            return _maintainAspectRatio;
        }

        public function set maintainAspectRatio(arg1:Boolean):void
        {
            _maintainAspectRatio = arg1;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public function get bytesLoaded():uint
        {
            return loader == null || loader.contentLoaderInfo == null ? 0 : loader.contentLoaderInfo.bytesLoaded;
        }

        public function get bytesTotal():uint
        {
            return loader == null || loader.contentLoaderInfo == null ? 0 : loader.contentLoaderInfo.bytesTotal;
        }

        public function loadBytes(arg1:flash.utils.ByteArray, arg2:flash.system.LoaderContext=null):void
        {
            var bytes:flash.utils.ByteArray;
            var context:flash.system.LoaderContext=null;

            var loc1:*;
            bytes = arg1;
            context = arg2;
            _unload();
            initLoader();
            try 
            {
                loader.loadBytes(bytes, context);
            }
            catch (error:*)
            {
                throw error;
            }
            return;
        }

        public function get content():flash.display.DisplayObject
        {
            if (loader != null) 
            {
                return loader.content;
            }
            if (contentClip.numChildren) 
            {
                return contentClip.getChildAt(0);
            }
            return null;
        }

        public function get source():Object
        {
            return _source;
        }

        public function set source(arg1:Object):void
        {
            if (arg1 == "") 
            {
                return;
            }
            _source = arg1;
            _unload();
            if (_autoLoad && !(_source == null)) 
            {
                load();
            }
            return;
        }

        public function get percentLoaded():Number
        {
            return bytesTotal <= 0 ? 0 : bytesLoaded / bytesTotal * 100;
        }

        public function load(arg1:flash.net.URLRequest=null, arg2:flash.system.LoaderContext=null):void
        {
            _unload();
            if ((arg1 == null || arg1.url == null) && (_source == null || _source == "")) 
            {
                return;
            }
            var loc1:*=getDisplayObjectInstance(source);
            if (loc1 != null) 
            {
                contentClip.addChild(loc1);
                contentInited = true;
                invalidate(fl.core.InvalidationType.SIZE);
                return;
            }
            arg1 = arg1;
            if (arg1 == null) 
            {
                arg1 = new flash.net.URLRequest(_source.toString());
            }
            if (arg2 == null) 
            {
                arg2 = new flash.system.LoaderContext(false, flash.system.ApplicationDomain.currentDomain);
            }
            initLoader();
            loader.load(arg1, arg2);
            return;
        }

        public function unload():void
        {
            _source = null;
            _unload(true);
            return;
        }

        public function close():void
        {
            var loc1:*;
            try 
            {
                loader.close();
            }
            catch (error:*)
            {
                throw error;
            }
            return;
        }

        protected function _unload(arg1:Boolean=false):void
        {
            var throwError:Boolean=false;

            var loc1:*;
            throwError = arg1;
            if (loader != null) 
            {
                clearLoadEvents();
                contentClip.removeChild(loader);
                try 
                {
                    loader.close();
                }
                catch (e:Error)
                {
                };
                try 
                {
                    loader.unload();
                }
                catch (e:*)
                {
                    if (throwError) 
                    {
                        throw e;
                    }
                }
                loader = null;
                return;
            }
            contentInited = false;
            if (contentClip.numChildren) 
            {
                contentClip.removeChildAt(0);
            }
            return;
        }

        protected function initLoader():void
        {
            loader = new fl.display.ProLoader();
            loader.contentLoaderInfo.addEventListener(flash.events.IOErrorEvent.IO_ERROR, handleError, false, 0, true);
            loader.contentLoaderInfo.addEventListener(flash.events.SecurityErrorEvent.SECURITY_ERROR, handleError, false, 0, true);
            loader.contentLoaderInfo.addEventListener(flash.events.Event.OPEN, passEvent, false, 0, true);
            loader.contentLoaderInfo.addEventListener(flash.events.ProgressEvent.PROGRESS, passEvent, false, 0, true);
            loader.contentLoaderInfo.addEventListener(flash.events.Event.COMPLETE, handleComplete, false, 0, true);
            loader.contentLoaderInfo.addEventListener(flash.events.Event.INIT, handleInit, false, 0, true);
            loader.contentLoaderInfo.addEventListener(flash.events.HTTPStatusEvent.HTTP_STATUS, passEvent, false, 0, true);
            contentClip.addChild(loader);
            return;
        }

        protected function handleComplete(arg1:flash.events.Event):void
        {
            clearLoadEvents();
            passEvent(arg1);
            return;
        }

        protected function passEvent(arg1:flash.events.Event):void
        {
            dispatchEvent(arg1);
            return;
        }

        protected function handleError(arg1:flash.events.Event):void
        {
            passEvent(arg1);
            clearLoadEvents();
            loader.contentLoaderInfo.removeEventListener(flash.events.Event.INIT, handleInit);
            return;
        }

        protected function handleInit(arg1:flash.events.Event):void
        {
            loader.contentLoaderInfo.removeEventListener(flash.events.Event.INIT, handleInit);
            contentInited = true;
            passEvent(arg1);
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        protected var _scaleContent:Boolean=true;

        protected var _autoLoad:Boolean=true;

        protected var contentInited:Boolean=false;

        protected var _source:Object;

        protected var loader:fl.display.ProLoader;

        protected var _maintainAspectRatio:Boolean=true;

        protected var contentClip:flash.display.Sprite;

        internal static var defaultStyles:Object;
    }
}


//    package controls
//      package listClasses
//        class CellRenderer
package fl.controls.listClasses 
{
    import fl.controls.*;
    import flash.events.*;
    
    public class CellRenderer extends fl.controls.LabelButton implements fl.controls.listClasses.ICellRenderer
    {
        public function CellRenderer()
        {
            super();
            toggle = true;
            focusEnabled = false;
            return;
        }

        public override function setSize(arg1:Number, arg2:Number):void
        {
            super.setSize(arg1, arg2);
            return;
        }

        public function get listData():fl.controls.listClasses.ListData
        {
            return _listData;
        }

        public function set listData(arg1:fl.controls.listClasses.ListData):void
        {
            _listData = arg1;
            label = _listData.label;
            setStyle("icon", _listData.icon);
            return;
        }

        public function get data():Object
        {
            return _data;
        }

        public function set data(arg1:Object):void
        {
            _data = arg1;
            return;
        }

        public override function get selected():Boolean
        {
            return super.selected;
        }

        public override function set selected(arg1:Boolean):void
        {
            super.selected = arg1;
            return;
        }

        protected override function toggleSelected(arg1:flash.events.MouseEvent):void
        {
            return;
        }

        protected override function drawLayout():void
        {
            var loc3:*=NaN;
            var loc1:*=Number(getStyleValue("textPadding"));
            var loc2:*=0;
            if (icon != null) 
            {
                icon.x = loc1;
                icon.y = Math.round(height - icon.height >> 1);
                loc2 = icon.width + loc1;
            }
            if (label.length > 0) 
            {
                textField.visible = true;
                loc3 = Math.max(0, width - loc2 - loc1 * 2);
                textField.width = loc3;
                textField.height = textField.textHeight + 4;
                textField.x = loc2 + loc1;
                textField.y = Math.round(height - textField.height >> 1);
            }
            else 
            {
                textField.visible = false;
            }
            background.width = width;
            background.height = height;
            return;
        }

        public static function getStyleDefinition():Object
        {
            return defaultStyles;
        }

        
        {
            defaultStyles = {"upSkin":"CellRenderer_upSkin", "downSkin":"CellRenderer_downSkin", "overSkin":"CellRenderer_overSkin", "disabledSkin":"CellRenderer_disabledSkin", "selectedDisabledSkin":"CellRenderer_selectedDisabledSkin", "selectedUpSkin":"CellRenderer_selectedUpSkin", "selectedDownSkin":"CellRenderer_selectedDownSkin", "selectedOverSkin":"CellRenderer_selectedOverSkin", "textFormat":null, "disabledTextFormat":null, "embedFonts":null, "textPadding":5};
        }

        protected var _listData:fl.controls.listClasses.ListData;

        protected var _data:Object;

        internal static var defaultStyles:Object;
    }
}


//        class ICellRenderer
package fl.controls.listClasses 
{
    public interface ICellRenderer
    {
        function set y(arg1:Number):void;

        function set x(arg1:Number):void;

        function setSize(arg1:Number, arg2:Number):void;

        function get listData():fl.controls.listClasses.ListData;

        function set listData(arg1:fl.controls.listClasses.ListData):void;

        function get data():Object;

        function set data(arg1:Object):void;

        function get selected():Boolean;

        function set selected(arg1:Boolean):void;

        function setMouseState(arg1:String):void;
    }
}


//        class ImageCell
package fl.controls.listClasses 
{
    import fl.containers.*;
    import flash.display.*;
    import flash.events.*;
    
    public class ImageCell extends fl.controls.listClasses.CellRenderer implements fl.controls.listClasses.ICellRenderer
    {
        public function ImageCell()
        {
            super();
            loader = new fl.containers.UILoader();
            loader.addEventListener(flash.events.IOErrorEvent.IO_ERROR, handleErrorEvent, false, 0, true);
            loader.autoLoad = true;
            loader.scaleContent = true;
            addChild(loader);
            return;
        }

        public override function get listData():fl.controls.listClasses.ListData
        {
            return _listData;
        }

        public override function set listData(arg1:fl.controls.listClasses.ListData):void
        {
            _listData = arg1;
            label = _listData.label;
            var loc1:*=(_listData as fl.controls.listClasses.TileListData).source;
            if (source != loc1) 
            {
                source = loc1;
            }
            return;
        }

        public function get source():Object
        {
            return loader.source;
        }

        public function set source(arg1:Object):void
        {
            loader.source = arg1;
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            textOverlay = new flash.display.Shape();
            var loc1:*=textOverlay.graphics;
            loc1.beginFill(16777215);
            loc1.drawRect(0, 0, 100, 100);
            loc1.endFill();
            return;
        }

        protected override function draw():void
        {
            super.draw();
            return;
        }

        protected override function drawLayout():void
        {
            var loc4:*=NaN;
            var loc1:*=getStyleValue("imagePadding") as Number;
            loader.move(loc1, loc1);
            var loc2:*=width - loc1 * 2;
            var loc3:*=height - loc1 * 2;
            if (!(loader.width == loc2) && !(loader.height == loc3)) 
            {
                loader.setSize(loc2, loc3);
            }
            loader.drawNow();
            if (_label == "" || _label == null) 
            {
                if (contains(textField)) 
                {
                    removeChild(textField);
                }
                if (contains(textOverlay)) 
                {
                    removeChild(textOverlay);
                }
            }
            else 
            {
                loc4 = getStyleValue("textPadding") as Number;
                textField.width = Math.min(width - loc4 * 2, textField.textWidth + 5);
                textField.height = textField.textHeight + 5;
                textField.x = Math.max(loc4, width / 2 - textField.width / 2);
                textField.y = height - textField.height - loc4;
                textOverlay.x = loc1;
                textOverlay.height = textField.height + loc4 * 2;
                textOverlay.y = height - textOverlay.height - loc1;
                textOverlay.width = width - loc1 * 2;
                textOverlay.alpha = getStyleValue("textOverlayAlpha") as Number;
                addChild(textOverlay);
                addChild(textField);
            }
            background.width = width;
            background.height = height;
            return;
        }

        protected function handleErrorEvent(arg1:flash.events.IOErrorEvent):void
        {
            dispatchEvent(arg1);
            return;
        }

        public static function getStyleDefinition():Object
        {
            return mergeStyles(defaultStyles, fl.controls.listClasses.CellRenderer.getStyleDefinition());
        }

        
        {
            defaultStyles = {"imagePadding":1, "textOverlayAlpha":0.7};
        }

        protected var textOverlay:flash.display.Shape;

        protected var loader:fl.containers.UILoader;

        internal static var defaultStyles:Object;
    }
}


//        class ListData
package fl.controls.listClasses 
{
    import fl.core.*;
    
    public class ListData extends Object
    {
        public function ListData(arg1:String, arg2:Object, arg3:fl.core.UIComponent, arg4:uint, arg5:uint, arg6:uint=0)
        {
            super();
            _label = arg1;
            _icon = arg2;
            _owner = arg3;
            _index = arg4;
            _row = arg5;
            _column = arg6;
            return;
        }

        public function get label():String
        {
            return _label;
        }

        public function get icon():Object
        {
            return _icon;
        }

        public function get owner():fl.core.UIComponent
        {
            return _owner;
        }

        public function get index():uint
        {
            return _index;
        }

        public function get row():uint
        {
            return _row;
        }

        public function get column():uint
        {
            return _column;
        }

        protected var _icon:Object=null;

        protected var _label:String;

        protected var _owner:fl.core.UIComponent;

        protected var _index:uint;

        protected var _row:uint;

        protected var _column:uint;
    }
}


//        class TileListData
package fl.controls.listClasses 
{
    import fl.core.*;
    
    public class TileListData extends fl.controls.listClasses.ListData
    {
        public function TileListData(arg1:String, arg2:Object, arg3:Object, arg4:fl.core.UIComponent, arg5:uint, arg6:uint, arg7:uint=0)
        {
            super(arg1, arg2, arg4, arg5, arg6, arg7);
            _source = arg3;
            return;
        }

        public function get source():Object
        {
            return _source;
        }

        protected var _source:Object;
    }
}


//      class BaseButton
package fl.controls 
{
    import fl.core.*;
    import fl.events.*;
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    
    public class BaseButton extends fl.core.UIComponent
    {
        public function BaseButton()
        {
            super();
            buttonMode = true;
            mouseChildren = false;
            useHandCursor = false;
            setupMouseEvents();
            setMouseState("up");
            pressTimer = new flash.utils.Timer(1, 0);
            pressTimer.addEventListener(flash.events.TimerEvent.TIMER, buttonDown, false, 0, true);
            return;
        }

        public override function get enabled():Boolean
        {
            return super.enabled;
        }

        public override function set enabled(arg1:Boolean):void
        {
            super.enabled = arg1;
            mouseEnabled = arg1;
            return;
        }

        public function get selected():Boolean
        {
            return _selected;
        }

        public function set selected(arg1:Boolean):void
        {
            if (_selected == arg1) 
            {
                return;
            }
            _selected = arg1;
            invalidate(fl.core.InvalidationType.STATE);
            return;
        }

        public function get autoRepeat():Boolean
        {
            return _autoRepeat;
        }

        public function set autoRepeat(arg1:Boolean):void
        {
            _autoRepeat = arg1;
            return;
        }

        public function set mouseStateLocked(arg1:Boolean):void
        {
            _mouseStateLocked = arg1;
            if (arg1 != false) 
            {
                unlockedMouseState = mouseState;
            }
            else 
            {
                setMouseState(unlockedMouseState);
            }
            return;
        }

        public function setMouseState(arg1:String):void
        {
            if (_mouseStateLocked) 
            {
                unlockedMouseState = arg1;
                return;
            }
            if (mouseState == arg1) 
            {
                return;
            }
            mouseState = arg1;
            invalidate(fl.core.InvalidationType.STATE);
            return;
        }

        protected function setupMouseEvents():void
        {
            addEventListener(flash.events.MouseEvent.ROLL_OVER, mouseEventHandler, false, 0, true);
            addEventListener(flash.events.MouseEvent.MOUSE_DOWN, mouseEventHandler, false, 0, true);
            addEventListener(flash.events.MouseEvent.MOUSE_UP, mouseEventHandler, false, 0, true);
            addEventListener(flash.events.MouseEvent.ROLL_OUT, mouseEventHandler, false, 0, true);
            return;
        }

        protected function mouseEventHandler(arg1:flash.events.MouseEvent):void
        {
            if (arg1.type != flash.events.MouseEvent.MOUSE_DOWN) 
            {
                if (arg1.type == flash.events.MouseEvent.ROLL_OVER || arg1.type == flash.events.MouseEvent.MOUSE_UP) 
                {
                    setMouseState("over");
                    endPress();
                }
                else if (arg1.type == flash.events.MouseEvent.ROLL_OUT) 
                {
                    setMouseState("up");
                    endPress();
                }
            }
            else 
            {
                setMouseState("down");
                startPress();
            }
            return;
        }

        protected function startPress():void
        {
            if (_autoRepeat) 
            {
                pressTimer.delay = Number(getStyleValue("repeatDelay"));
                pressTimer.start();
            }
            dispatchEvent(new fl.events.ComponentEvent(fl.events.ComponentEvent.BUTTON_DOWN, true));
            return;
        }

        protected function buttonDown(arg1:flash.events.TimerEvent):void
        {
            if (!_autoRepeat) 
            {
                endPress();
                return;
            }
            if (pressTimer.currentCount == 1) 
            {
                pressTimer.delay = Number(getStyleValue("repeatInterval"));
            }
            dispatchEvent(new fl.events.ComponentEvent(fl.events.ComponentEvent.BUTTON_DOWN, true));
            return;
        }

        protected function endPress():void
        {
            pressTimer.reset();
            return;
        }

        protected override function draw():void
        {
            if (isInvalid(fl.core.InvalidationType.STYLES, fl.core.InvalidationType.STATE)) 
            {
                drawBackground();
                invalidate(fl.core.InvalidationType.SIZE, false);
            }
            if (isInvalid(fl.core.InvalidationType.SIZE)) 
            {
                drawLayout();
            }
            super.draw();
            return;
        }

        protected function drawBackground():void
        {
            var loc1:*=enabled ? mouseState : "disabled";
            if (selected) 
            {
                loc1 = "selected" + loc1.substr(0, 1).toUpperCase() + loc1.substr(1);
            }
            loc1 = loc1 + "Skin";
            var loc2:*=background;
            background = getDisplayObjectInstance(getStyleValue(loc1));
            addChildAt(background, 0);
            if (!(loc2 == null) && !(loc2 == background)) 
            {
                removeChild(loc2);
            }
            return;
        }

        protected function drawLayout():void
        {
            background.width = width;
            background.height = height;
            return;
        }

        public static function getStyleDefinition():Object
        {
            return defaultStyles;
        }

        
        {
            defaultStyles = {"upSkin":"Button_upSkin", "downSkin":"Button_downSkin", "overSkin":"Button_overSkin", "disabledSkin":"Button_disabledSkin", "selectedDisabledSkin":"Button_selectedDisabledSkin", "selectedUpSkin":"Button_selectedUpSkin", "selectedDownSkin":"Button_selectedDownSkin", "selectedOverSkin":"Button_selectedOverSkin", "focusRectSkin":null, "focusRectPadding":null, "repeatDelay":500, "repeatInterval":35};
        }

        protected var background:flash.display.DisplayObject;

        protected var mouseState:String;

        protected var _selected:Boolean=false;

        protected var _autoRepeat:Boolean=false;

        protected var pressTimer:flash.utils.Timer;

        internal var _mouseStateLocked:Boolean=false;

        internal var unlockedMouseState:String;

        internal static var defaultStyles:Object;
    }
}


//      class Button
package fl.controls 
{
    import fl.core.*;
    import fl.managers.*;
    import flash.display.*;
    
    public class Button extends fl.controls.LabelButton implements fl.managers.IFocusManagerComponent
    {
        public function Button()
        {
            super();
            return;
        }

        public function get emphasized():Boolean
        {
            return _emphasized;
        }

        public function set emphasized(arg1:Boolean):void
        {
            _emphasized = arg1;
            invalidate(fl.core.InvalidationType.STYLES);
            return;
        }

        protected override function draw():void
        {
            if (isInvalid(fl.core.InvalidationType.STYLES) || isInvalid(fl.core.InvalidationType.SIZE)) 
            {
                drawEmphasized();
            }
            super.draw();
            if (emphasizedBorder != null) 
            {
                setChildIndex(emphasizedBorder, (numChildren - 1));
            }
            return;
        }

        protected function drawEmphasized():void
        {
            var loc2:*=NaN;
            if (emphasizedBorder != null) 
            {
                removeChild(emphasizedBorder);
            }
            emphasizedBorder = null;
            if (!_emphasized) 
            {
                return;
            }
            var loc1:*=getStyleValue("emphasizedSkin");
            if (loc1 != null) 
            {
                emphasizedBorder = getDisplayObjectInstance(loc1);
            }
            if (emphasizedBorder != null) 
            {
                addChildAt(emphasizedBorder, 0);
                loc2 = Number(getStyleValue("emphasizedPadding"));
                var loc3:*;
                emphasizedBorder.y = loc3 = -loc2;
                emphasizedBorder.x = loc3;
                emphasizedBorder.width = width + loc2 * 2;
                emphasizedBorder.height = height + loc2 * 2;
            }
            return;
        }

        public override function drawFocus(arg1:Boolean):void
        {
            var loc1:*=NaN;
            var loc2:*=undefined;
            super.drawFocus(arg1);
            if (arg1) 
            {
                loc1 = Number(getStyleValue("emphasizedPadding"));
                if (loc1 < 0 || !_emphasized) 
                {
                    loc1 = 0;
                }
                loc2 = getStyleValue("focusRectPadding");
                loc2 = loc2 != null ? loc2 : 2;
                loc2 = loc2 + loc1;
                uiFocusRect.x = -loc2;
                uiFocusRect.y = -loc2;
                uiFocusRect.width = width + loc2 * 2;
                uiFocusRect.height = height + loc2 * 2;
            }
            return;
        }

        protected override function initializeAccessibility():void
        {
            if (fl.controls.Button.createAccessibilityImplementation != null) 
            {
                fl.controls.Button.createAccessibilityImplementation(this);
            }
            return;
        }

        public static function getStyleDefinition():Object
        {
            return fl.core.UIComponent.mergeStyles(fl.controls.LabelButton.getStyleDefinition(), defaultStyles);
        }

        
        {
            defaultStyles = {"emphasizedSkin":"Button_emphasizedSkin", "emphasizedPadding":2};
        }

        protected var _emphasized:Boolean=false;

        protected var emphasizedBorder:flash.display.DisplayObject;

        internal static var defaultStyles:Object;

        public static var createAccessibilityImplementation:Function;
    }
}


//      class ButtonLabelPlacement
package fl.controls 
{
    public class ButtonLabelPlacement extends Object
    {
        public function ButtonLabelPlacement()
        {
            super();
            return;
        }

        public static const BOTTOM:String="bottom";

        public static const TOP:String="top";

        public static const LEFT:String="left";

        public static const RIGHT:String="right";
    }
}


//      class LabelButton
package fl.controls 
{
    import fl.core.*;
    import fl.events.*;
    import fl.managers.*;
    import flash.display.*;
    import flash.events.*;
    import flash.text.*;
    import flash.ui.*;
    
    public class LabelButton extends fl.controls.BaseButton implements fl.managers.IFocusManagerComponent
    {
        public function LabelButton()
        {
            super();
            return;
        }

        public function get label():String
        {
            return _label;
        }

        public function set label(arg1:String):void
        {
            _label = arg1;
            if (textField.text != _label) 
            {
                textField.text = _label;
                dispatchEvent(new fl.events.ComponentEvent(fl.events.ComponentEvent.LABEL_CHANGE));
            }
            invalidate(fl.core.InvalidationType.SIZE);
            invalidate(fl.core.InvalidationType.STYLES);
            return;
        }

        public function get labelPlacement():String
        {
            return _labelPlacement;
        }

        public function set labelPlacement(arg1:String):void
        {
            _labelPlacement = arg1;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public function get toggle():Boolean
        {
            return _toggle;
        }

        public function set toggle(arg1:Boolean):void
        {
            if (!arg1 && super.selected) 
            {
                selected = false;
            }
            _toggle = arg1;
            if (_toggle) 
            {
                addEventListener(flash.events.MouseEvent.CLICK, toggleSelected, false, 0, true);
            }
            else 
            {
                removeEventListener(flash.events.MouseEvent.CLICK, toggleSelected);
            }
            invalidate(fl.core.InvalidationType.STATE);
            return;
        }

        protected function toggleSelected(arg1:flash.events.MouseEvent):void
        {
            selected = !selected;
            dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE, true));
            return;
        }

        public override function get selected():Boolean
        {
            return _toggle ? _selected : false;
        }

        public override function set selected(arg1:Boolean):void
        {
            _selected = arg1;
            if (_toggle) 
            {
                invalidate(fl.core.InvalidationType.STATE);
            }
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            textField = new flash.text.TextField();
            textField.type = flash.text.TextFieldType.DYNAMIC;
            textField.selectable = false;
            addChild(textField);
            return;
        }

        protected override function draw():void
        {
            if (textField.text != _label) 
            {
                label = _label;
            }
            if (isInvalid(fl.core.InvalidationType.STYLES, fl.core.InvalidationType.STATE)) 
            {
                drawBackground();
                drawIcon();
                drawTextFormat();
                invalidate(fl.core.InvalidationType.SIZE, false);
            }
            if (isInvalid(fl.core.InvalidationType.SIZE)) 
            {
                drawLayout();
            }
            if (isInvalid(fl.core.InvalidationType.SIZE, fl.core.InvalidationType.STYLES)) 
            {
                if (isFocused && focusManager.showFocusIndicator) 
                {
                    drawFocus(true);
                }
            }
            validate();
            return;
        }

        protected function drawIcon():void
        {
            var loc1:*=icon;
            var loc2:*=enabled ? mouseState : "disabled";
            if (selected) 
            {
                loc2 = "selected" + loc2.substr(0, 1).toUpperCase() + loc2.substr(1);
            }
            loc2 = loc2 + "Icon";
            var loc3:*=getStyleValue(loc2);
            if (loc3 == null) 
            {
                loc3 = getStyleValue("icon");
            }
            if (loc3 != null) 
            {
                icon = getDisplayObjectInstance(loc3);
            }
            if (icon != null) 
            {
                addChildAt(icon, 1);
            }
            if (!(loc1 == null) && !(loc1 == icon)) 
            {
                removeChild(loc1);
            }
            return;
        }

        protected function drawTextFormat():void
        {
            var loc1:*=fl.core.UIComponent.getStyleDefinition();
            var loc2:*=enabled ? loc1.defaultTextFormat as flash.text.TextFormat : loc1.defaultDisabledTextFormat as flash.text.TextFormat;
            textField.setTextFormat(loc2);
            var loc3:*=getStyleValue(enabled ? "textFormat" : "disabledTextFormat") as flash.text.TextFormat;
            if (loc3 == null) 
            {
                loc3 = loc2;
            }
            else 
            {
                textField.setTextFormat(loc3);
            }
            textField.defaultTextFormat = loc3;
            setEmbedFont();
            return;
        }

        protected function setEmbedFont():*
        {
            var loc1:*=getStyleValue("embedFonts");
            if (loc1 != null) 
            {
                textField.embedFonts = loc1;
            }
            return;
        }

        protected override function drawLayout():void
        {
            var loc7:*=NaN;
            var loc8:*=NaN;
            var loc1:*=Number(getStyleValue("textPadding"));
            var loc2:*=icon == null && mode == "center" ? fl.controls.ButtonLabelPlacement.TOP : _labelPlacement;
            textField.height = textField.textHeight + 4;
            var loc3:*=textField.textWidth + 4;
            var loc4:*=textField.textHeight + 4;
            var loc5:*=icon != null ? icon.width + loc1 : 0;
            var loc6:*=icon != null ? icon.height + loc1 : 0;
            textField.visible = label.length > 0;
            if (icon != null) 
            {
                icon.x = Math.round((width - icon.width) / 2);
                icon.y = Math.round((height - icon.height) / 2);
            }
            if (textField.visible != false) 
            {
                if (loc2 == fl.controls.ButtonLabelPlacement.BOTTOM || loc2 == fl.controls.ButtonLabelPlacement.TOP) 
                {
                    loc7 = Math.max(0, Math.min(loc3, width - 2 * loc1));
                    if (height - 2 > loc4) 
                    {
                        loc8 = loc4;
                    }
                    else 
                    {
                        loc8 = height - 2;
                    }
                    var loc9:*;
                    loc3 = loc9 = loc7;
                    textField.width = loc9;
                    loc4 = loc9 = loc8;
                    textField.height = loc9;
                    textField.x = Math.round((width - loc3) / 2);
                    textField.y = Math.round((height - textField.height - loc6) / 2 + (loc2 != fl.controls.ButtonLabelPlacement.BOTTOM ? 0 : loc6));
                    if (icon != null) 
                    {
                        icon.y = Math.round(loc2 != fl.controls.ButtonLabelPlacement.BOTTOM ? textField.y + textField.height + loc1 : textField.y - loc6);
                    }
                }
                else 
                {
                    loc7 = Math.max(0, Math.min(loc3, width - loc5 - 2 * loc1));
                    loc3 = loc9 = loc7;
                    textField.width = loc9;
                    textField.x = Math.round((width - loc3 - loc5) / 2 + (loc2 == fl.controls.ButtonLabelPlacement.LEFT ? 0 : loc5));
                    textField.y = Math.round((height - textField.height) / 2);
                    if (icon != null) 
                    {
                        icon.x = Math.round(loc2 == fl.controls.ButtonLabelPlacement.LEFT ? textField.x + loc3 + loc1 : textField.x - loc5);
                    }
                }
            }
            else 
            {
                textField.width = 0;
                textField.height = 0;
            }
            super.drawLayout();
            return;
        }

        protected override function keyDownHandler(arg1:flash.events.KeyboardEvent):void
        {
            if (!enabled) 
            {
                return;
            }
            if (arg1.keyCode == flash.ui.Keyboard.SPACE) 
            {
                if (oldMouseState == null) 
                {
                    oldMouseState = mouseState;
                }
                setMouseState("down");
                startPress();
            }
            return;
        }

        protected override function keyUpHandler(arg1:flash.events.KeyboardEvent):void
        {
            if (!enabled) 
            {
                return;
            }
            if (arg1.keyCode == flash.ui.Keyboard.SPACE) 
            {
                setMouseState(oldMouseState);
                oldMouseState = null;
                endPress();
                dispatchEvent(new flash.events.MouseEvent(flash.events.MouseEvent.CLICK));
            }
            return;
        }

        protected override function initializeAccessibility():void
        {
            if (fl.controls.LabelButton.createAccessibilityImplementation != null) 
            {
                fl.controls.LabelButton.createAccessibilityImplementation(this);
            }
            return;
        }

        public static function getStyleDefinition():Object
        {
            return mergeStyles(defaultStyles, fl.controls.BaseButton.getStyleDefinition());
        }

        
        {
            defaultStyles = {"icon":null, "upIcon":null, "downIcon":null, "overIcon":null, "disabledIcon":null, "selectedDisabledIcon":null, "selectedUpIcon":null, "selectedDownIcon":null, "selectedOverIcon":null, "textFormat":null, "disabledTextFormat":null, "textPadding":5, "embedFonts":false};
        }

        public var textField:flash.text.TextField;

        protected var _labelPlacement:String="right";

        protected var _toggle:Boolean=false;

        protected var icon:flash.display.DisplayObject;

        protected var oldMouseState:String;

        protected var _label:String="Label";

        protected var mode:String="center";

        internal static var defaultStyles:Object;

        public static var createAccessibilityImplementation:Function;
    }
}


//      class ScrollBar
package fl.controls 
{
    import fl.core.*;
    import fl.events.*;
    import flash.display.*;
    import flash.events.*;
    
    public class ScrollBar extends fl.core.UIComponent
    {
        public function ScrollBar()
        {
            super();
            setStyles();
            focusEnabled = false;
            return;
        }

        public function get direction():String
        {
            return _direction;
        }

        public function set direction(arg1:String):void
        {
            if (_direction == arg1) 
            {
                return;
            }
            _direction = arg1;
            if (isLivePreview) 
            {
                return;
            }
            setScaleY(1);
            var loc1:*=_direction == fl.controls.ScrollBarDirection.HORIZONTAL;
            if (loc1 && componentInspectorSetting) 
            {
                if (rotation == 90) 
                {
                    return;
                }
                setScaleX(-1);
                rotation = -90;
            }
            if (!componentInspectorSetting) 
            {
                if (loc1 && rotation == 0) 
                {
                    rotation = -90;
                    setScaleX(-1);
                }
                else if (!loc1 && rotation == -90) 
                {
                    rotation = 0;
                    setScaleX(1);
                }
            }
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            track = new fl.controls.BaseButton();
            track.move(0, 14);
            track.useHandCursor = false;
            track.autoRepeat = true;
            track.focusEnabled = false;
            addChild(track);
            thumb = new fl.controls.LabelButton();
            thumb.label = "";
            thumb.setSize(WIDTH, 15);
            thumb.move(0, 15);
            thumb.focusEnabled = false;
            addChild(thumb);
            downArrow = new fl.controls.BaseButton();
            downArrow.setSize(WIDTH, 14);
            downArrow.autoRepeat = true;
            downArrow.focusEnabled = false;
            addChild(downArrow);
            upArrow = new fl.controls.BaseButton();
            upArrow.setSize(WIDTH, 14);
            upArrow.move(0, 0);
            upArrow.autoRepeat = true;
            upArrow.focusEnabled = false;
            addChild(upArrow);
            upArrow.addEventListener(fl.events.ComponentEvent.BUTTON_DOWN, scrollPressHandler, false, 0, true);
            downArrow.addEventListener(fl.events.ComponentEvent.BUTTON_DOWN, scrollPressHandler, false, 0, true);
            track.addEventListener(fl.events.ComponentEvent.BUTTON_DOWN, scrollPressHandler, false, 0, true);
            thumb.addEventListener(flash.events.MouseEvent.MOUSE_DOWN, thumbPressHandler, false, 0, true);
            enabled = false;
            return;
        }

        protected override function draw():void
        {
            var loc1:*=NaN;
            if (isInvalid(fl.core.InvalidationType.SIZE)) 
            {
                loc1 = super.height;
                downArrow.move(0, Math.max(upArrow.height, loc1 - downArrow.height));
                track.setSize(WIDTH, Math.max(0, loc1 - (downArrow.height + upArrow.height)));
                updateThumb();
            }
            if (isInvalid(fl.core.InvalidationType.STYLES, fl.core.InvalidationType.STATE)) 
            {
                setStyles();
            }
            downArrow.drawNow();
            upArrow.drawNow();
            track.drawNow();
            thumb.drawNow();
            validate();
            return;
        }

        protected function scrollPressHandler(arg1:fl.events.ComponentEvent):void
        {
            var loc1:*=NaN;
            var loc2:*=NaN;
            arg1.stopImmediatePropagation();
            if (arg1.currentTarget != upArrow) 
            {
                if (arg1.currentTarget != downArrow) 
                {
                    loc1 = track.mouseY / track.height * (_maxScrollPosition - _minScrollPosition) + _minScrollPosition;
                    loc2 = pageScrollSize != 0 ? pageScrollSize : pageSize;
                    if (_scrollPosition < loc1) 
                    {
                        setScrollPosition(Math.min(loc1, _scrollPosition + loc2));
                    }
                    else if (_scrollPosition > loc1) 
                    {
                        setScrollPosition(Math.max(loc1, _scrollPosition - loc2));
                    }
                }
                else 
                {
                    setScrollPosition(_scrollPosition + _lineScrollSize);
                }
            }
            else 
            {
                setScrollPosition(_scrollPosition - _lineScrollSize);
            }
            return;
        }

        public function set maxScrollPosition(arg1:Number):void
        {
            setScrollProperties(_pageSize, _minScrollPosition, arg1);
            return;
        }

        protected function thumbPressHandler(arg1:flash.events.MouseEvent):void
        {
            inDrag = true;
            thumbScrollOffset = mouseY - thumb.y;
            thumb.mouseStateLocked = true;
            mouseChildren = false;
            var loc1:*=focusManager.form;
            loc1.addEventListener(flash.events.MouseEvent.MOUSE_MOVE, handleThumbDrag, false, 0, true);
            loc1.addEventListener(flash.events.MouseEvent.MOUSE_UP, thumbReleaseHandler, false, 0, true);
            return;
        }

        protected function handleThumbDrag(arg1:flash.events.MouseEvent):void
        {
            var loc1:*=Math.max(0, Math.min(track.height - thumb.height, mouseY - track.y - thumbScrollOffset));
            setScrollPosition(loc1 / (track.height - thumb.height) * (_maxScrollPosition - _minScrollPosition) + _minScrollPosition);
            return;
        }

        protected function thumbReleaseHandler(arg1:flash.events.MouseEvent):void
        {
            inDrag = false;
            mouseChildren = true;
            thumb.mouseStateLocked = false;
            var loc1:*=focusManager.form;
            loc1.removeEventListener(flash.events.MouseEvent.MOUSE_MOVE, handleThumbDrag);
            loc1.removeEventListener(flash.events.MouseEvent.MOUSE_UP, thumbReleaseHandler);
            return;
        }

        public function setScrollPosition(arg1:Number, arg2:Boolean=true):void
        {
            var loc1:*=scrollPosition;
            _scrollPosition = Math.max(_minScrollPosition, Math.min(_maxScrollPosition, arg1));
            if (loc1 == _scrollPosition) 
            {
                return;
            }
            if (arg2) 
            {
                dispatchEvent(new fl.events.ScrollEvent(_direction, scrollPosition - loc1, scrollPosition));
            }
            updateThumb();
            return;
        }

        protected function setStyles():void
        {
            copyStylesToChild(downArrow, DOWN_ARROW_STYLES);
            copyStylesToChild(thumb, THUMB_STYLES);
            copyStylesToChild(track, TRACK_STYLES);
            copyStylesToChild(upArrow, UP_ARROW_STYLES);
            return;
        }

        protected function updateThumb():void
        {
            var loc1:*=_maxScrollPosition - _minScrollPosition + _pageSize;
            if (track.height <= 12 || _maxScrollPosition <= _minScrollPosition || loc1 == 0 || isNaN(loc1)) 
            {
                thumb.height = 12;
                thumb.visible = false;
            }
            else 
            {
                thumb.height = Math.max(13, _pageSize / loc1 * track.height);
                thumb.y = track.y + (track.height - thumb.height) * (_scrollPosition - _minScrollPosition) / (_maxScrollPosition - _minScrollPosition);
                thumb.visible = enabled;
            }
            return;
        }

        public static function getStyleDefinition():Object
        {
            return defaultStyles;
        }

        public override function setSize(arg1:Number, arg2:Number):void
        {
            if (_direction != fl.controls.ScrollBarDirection.HORIZONTAL) 
            {
                super.setSize(arg1, arg2);
            }
            else 
            {
                super.setSize(arg2, arg1);
            }
            return;
        }

        public override function get width():Number
        {
            return _direction != fl.controls.ScrollBarDirection.HORIZONTAL ? super.width : super.height;
        }

        public override function get height():Number
        {
            return _direction != fl.controls.ScrollBarDirection.HORIZONTAL ? super.height : super.width;
        }

        public override function get enabled():Boolean
        {
            return super.enabled;
        }

        public override function set enabled(arg1:Boolean):void
        {
            super.enabled = arg1;
            var loc1:*;
            upArrow.enabled = loc1 = enabled && _maxScrollPosition > _minScrollPosition;
            thumb.enabled = loc1 = loc1;
            track.enabled = loc1 = loc1;
            downArrow.enabled = loc1;
            updateThumb();
            return;
        }

        public function setScrollProperties(arg1:Number, arg2:Number, arg3:Number, arg4:Number=0):void
        {
            this.pageSize = arg1;
            _minScrollPosition = arg2;
            _maxScrollPosition = arg3;
            if (arg4 >= 0) 
            {
                _pageScrollSize = arg4;
            }
            enabled = _maxScrollPosition > _minScrollPosition;
            setScrollPosition(_scrollPosition, false);
            updateThumb();
            return;
        }

        public function get scrollPosition():Number
        {
            return _scrollPosition;
        }

        public function set scrollPosition(arg1:Number):void
        {
            setScrollPosition(arg1, true);
            return;
        }

        public function get minScrollPosition():Number
        {
            return _minScrollPosition;
        }

        public function set minScrollPosition(arg1:Number):void
        {
            setScrollProperties(_pageSize, arg1, _maxScrollPosition);
            return;
        }

        public function get maxScrollPosition():Number
        {
            return _maxScrollPosition;
        }

        
        {
            defaultStyles = {"downArrowDisabledSkin":"ScrollArrowDown_disabledSkin", "downArrowDownSkin":"ScrollArrowDown_downSkin", "downArrowOverSkin":"ScrollArrowDown_overSkin", "downArrowUpSkin":"ScrollArrowDown_upSkin", "thumbDisabledSkin":"ScrollThumb_upSkin", "thumbDownSkin":"ScrollThumb_downSkin", "thumbOverSkin":"ScrollThumb_overSkin", "thumbUpSkin":"ScrollThumb_upSkin", "trackDisabledSkin":"ScrollTrack_skin", "trackDownSkin":"ScrollTrack_skin", "trackOverSkin":"ScrollTrack_skin", "trackUpSkin":"ScrollTrack_skin", "upArrowDisabledSkin":"ScrollArrowUp_disabledSkin", "upArrowDownSkin":"ScrollArrowUp_downSkin", "upArrowOverSkin":"ScrollArrowUp_overSkin", "upArrowUpSkin":"ScrollArrowUp_upSkin", "thumbIcon":"ScrollBar_thumbIcon", "repeatDelay":500, "repeatInterval":35};
        }

        public function get pageSize():Number
        {
            return _pageSize;
        }

        public function set pageSize(arg1:Number):void
        {
            if (arg1 > 0) 
            {
                _pageSize = arg1;
            }
            return;
        }

        public function get pageScrollSize():Number
        {
            return _pageScrollSize != 0 ? _pageScrollSize : _pageSize;
        }

        public function set pageScrollSize(arg1:Number):void
        {
            if (arg1 >= 0) 
            {
                _pageScrollSize = arg1;
            }
            return;
        }

        public function get lineScrollSize():Number
        {
            return _lineScrollSize;
        }

        public function set lineScrollSize(arg1:Number):void
        {
            if (arg1 > 0) 
            {
                _lineScrollSize = arg1;
            }
            return;
        }

        public static const WIDTH:Number=15;

        protected static const DOWN_ARROW_STYLES:Object={"disabledSkin":"downArrowDisabledSkin", "downSkin":"downArrowDownSkin", "overSkin":"downArrowOverSkin", "upSkin":"downArrowUpSkin", "repeatDelay":"repeatDelay", "repeatInterval":"repeatInterval"};

        protected static const THUMB_STYLES:Object={"disabledSkin":"thumbDisabledSkin", "downSkin":"thumbDownSkin", "overSkin":"thumbOverSkin", "upSkin":"thumbUpSkin", "icon":"thumbIcon", "textPadding":0};

        protected static const TRACK_STYLES:Object={"disabledSkin":"trackDisabledSkin", "downSkin":"trackDownSkin", "overSkin":"trackOverSkin", "upSkin":"trackUpSkin", "repeatDelay":"repeatDelay", "repeatInterval":"repeatInterval"};

        protected static const UP_ARROW_STYLES:Object={"disabledSkin":"upArrowDisabledSkin", "downSkin":"upArrowDownSkin", "overSkin":"upArrowOverSkin", "upSkin":"upArrowUpSkin", "repeatDelay":"repeatDelay", "repeatInterval":"repeatInterval"};

        internal var _pageSize:Number=10;

        internal var _pageScrollSize:Number=0;

        internal var _lineScrollSize:Number=1;

        internal var _minScrollPosition:Number=0;

        internal var _maxScrollPosition:Number=0;

        internal var _direction:String="vertical";

        internal var thumbScrollOffset:Number;

        protected var inDrag:Boolean=false;

        protected var upArrow:fl.controls.BaseButton;

        protected var downArrow:fl.controls.BaseButton;

        protected var thumb:fl.controls.LabelButton;

        protected var track:fl.controls.BaseButton;

        internal var _scrollPosition:Number=0;

        internal static var defaultStyles:Object;
    }
}


//      class ScrollBarDirection
package fl.controls 
{
    public class ScrollBarDirection extends Object
    {
        public function ScrollBarDirection()
        {
            super();
            return;
        }

        public static const VERTICAL:String="vertical";

        public static const HORIZONTAL:String="horizontal";
    }
}


//      class ScrollPolicy
package fl.controls 
{
    public class ScrollPolicy extends Object
    {
        public function ScrollPolicy()
        {
            super();
            return;
        }

        public static const ON:String="on";

        public static const AUTO:String="auto";

        public static const OFF:String="off";
    }
}


//      class SelectableList
package fl.controls 
{
    import fl.containers.*;
    import fl.controls.listClasses.*;
    import fl.core.*;
    import fl.data.*;
    import fl.events.*;
    import fl.managers.*;
    import flash.display.*;
    import flash.events.*;
    import flash.ui.*;
    import flash.utils.*;
    
    public class SelectableList extends fl.containers.BaseScrollPane implements fl.managers.IFocusManagerComponent
    {
        public function SelectableList()
        {
            super();
            activeCellRenderers = [];
            availableCellRenderers = [];
            invalidItems = new flash.utils.Dictionary(true);
            renderedItems = new flash.utils.Dictionary(true);
            _selectedIndices = [];
            if (dataProvider == null) 
            {
                dataProvider = new fl.data.DataProvider();
            }
            verticalScrollPolicy = fl.controls.ScrollPolicy.AUTO;
            rendererStyles = {};
            updatedRendererStyles = {};
            return;
        }

        protected function handleDataChange(arg1:fl.events.DataChangeEvent):void
        {
            var loc4:*=0;
            var loc1:*=arg1.startIndex;
            var loc2:*=arg1.endIndex;
            var loc3:*;
            if ((loc3 = arg1.changeType) != fl.events.DataChangeType.INVALIDATE_ALL) 
            {
                if (loc3 != fl.events.DataChangeType.INVALIDATE) 
                {
                    if (loc3 != fl.events.DataChangeType.ADD) 
                    {
                        if (loc3 != fl.events.DataChangeType.REMOVE) 
                        {
                            if (loc3 != fl.events.DataChangeType.REMOVE_ALL) 
                            {
                                if (loc3 != fl.events.DataChangeType.REPLACE) 
                                {
                                    selectedItems = preChangeItems;
                                    preChangeItems = null;
                                }
                            }
                            else 
                            {
                                clearSelection();
                            }
                        }
                        else 
                        {
                            loc4 = 0;
                            while (loc4 < _selectedIndices.length) 
                            {
                                if (_selectedIndices[loc4] >= loc1) 
                                {
                                    if (_selectedIndices[loc4] <= loc2) 
                                    {
                                        delete _selectedIndices[loc4];
                                    }
                                    else 
                                    {
                                        _selectedIndices[loc4] = _selectedIndices[loc4] - (loc1 - loc2 + 1);
                                    }
                                }
                                ++loc4;
                            }
                        }
                    }
                    else 
                    {
                        loc4 = 0;
                        while (loc4 < _selectedIndices.length) 
                        {
                            if (_selectedIndices[loc4] >= loc1) 
                            {
                                _selectedIndices[loc4] = _selectedIndices[loc4] + (loc1 - loc2);
                            }
                            ++loc4;
                        }
                    }
                }
                else 
                {
                    loc4 = 0;
                    while (loc4 < arg1.items.length) 
                    {
                        invalidateItem(arg1.items[loc4]);
                        ++loc4;
                    }
                }
            }
            else 
            {
                clearSelection();
                invalidateList();
            }
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        protected function handleCellRendererMouseEvent(arg1:flash.events.MouseEvent):void
        {
            var loc1:*=arg1.target as fl.controls.listClasses.ICellRenderer;
            var loc2:*=arg1.type != flash.events.MouseEvent.ROLL_OVER ? fl.events.ListEvent.ITEM_ROLL_OUT : fl.events.ListEvent.ITEM_ROLL_OVER;
            dispatchEvent(new fl.events.ListEvent(loc2, false, false, loc1.listData.column, loc1.listData.row, loc1.listData.index, loc1.data));
            return;
        }

        protected function handleCellRendererClick(arg1:flash.events.MouseEvent):void
        {
            var loc4:*=0;
            var loc5:*=0;
            if (!_enabled) 
            {
                return;
            }
            var loc1:*=arg1.currentTarget as fl.controls.listClasses.ICellRenderer;
            var loc2:*=loc1.listData.index;
            if (!dispatchEvent(new fl.events.ListEvent(fl.events.ListEvent.ITEM_CLICK, false, true, loc1.listData.column, loc1.listData.row, loc2, loc1.data)) || !_selectable) 
            {
                return;
            }
            var loc3:*=selectedIndices.indexOf(loc2);
            if (_allowMultipleSelection) 
            {
                if (arg1.shiftKey) 
                {
                    loc5 = _selectedIndices.length > 0 ? _selectedIndices[0] : loc2;
                    _selectedIndices = [];
                    if (loc5 > loc2) 
                    {
                        loc4 = loc5;
                        while (loc4 >= loc2) 
                        {
                            _selectedIndices.push(loc4);
                            --loc4;
                        }
                    }
                    else 
                    {
                        loc4 = loc5;
                        while (loc4 <= loc2) 
                        {
                            _selectedIndices.push(loc4);
                            ++loc4;
                        }
                    }
                    caretIndex = loc2;
                }
                else if (arg1.ctrlKey) 
                {
                    if (loc3 == -1) 
                    {
                        loc1.selected = true;
                        _selectedIndices.push(loc2);
                    }
                    else 
                    {
                        loc1.selected = false;
                        _selectedIndices.splice(loc3, 1);
                    }
                    caretIndex = loc2;
                }
                else 
                {
                    _selectedIndices = [loc2];
                    caretIndex = loc6 = loc2;
                    lastCaretIndex = loc6;
                }
            }
            else 
            {
                if (loc3 != -1) 
                {
                    return;
                }
                loc1.selected = true;
                _selectedIndices = [loc2];
                var loc6:*;
                caretIndex = loc6 = loc2;
                lastCaretIndex = loc6;
            }
            dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        protected function handleCellRendererChange(arg1:flash.events.Event):void
        {
            var loc1:*=arg1.currentTarget as fl.controls.listClasses.ICellRenderer;
            var loc2:*=loc1.listData.index;
            _dataProvider.invalidateItemAt(loc2);
            return;
        }

        protected function handleCellRendererDoubleClick(arg1:flash.events.MouseEvent):void
        {
            if (!_enabled) 
            {
                return;
            }
            var loc1:*=arg1.currentTarget as fl.controls.listClasses.ICellRenderer;
            var loc2:*=loc1.listData.index;
            dispatchEvent(new fl.events.ListEvent(fl.events.ListEvent.ITEM_DOUBLE_CLICK, false, true, loc1.listData.column, loc1.listData.row, loc2, loc1.data));
            return;
        }

        protected override function setHorizontalScrollPosition(arg1:Number, arg2:Boolean=false):void
        {
            if (arg1 == _horizontalScrollPosition) 
            {
                return;
            }
            var loc1:*=arg1 - _horizontalScrollPosition;
            _horizontalScrollPosition = arg1;
            if (arg2) 
            {
                dispatchEvent(new fl.events.ScrollEvent(fl.controls.ScrollBarDirection.HORIZONTAL, loc1, arg1));
            }
            return;
        }

        protected override function setVerticalScrollPosition(arg1:Number, arg2:Boolean=false):void
        {
            if (arg1 == _verticalScrollPosition) 
            {
                return;
            }
            var loc1:*=arg1 - _verticalScrollPosition;
            _verticalScrollPosition = arg1;
            if (arg2) 
            {
                dispatchEvent(new fl.events.ScrollEvent(fl.controls.ScrollBarDirection.VERTICAL, loc1, arg1));
            }
            return;
        }

        protected override function draw():void
        {
            super.draw();
            return;
        }

        protected override function drawLayout():void
        {
            super.drawLayout();
            contentScrollRect = listHolder.scrollRect;
            contentScrollRect.width = availableWidth;
            contentScrollRect.height = availableHeight;
            listHolder.scrollRect = contentScrollRect;
            return;
        }

        public function get dataProvider():fl.data.DataProvider
        {
            return _dataProvider;
        }

        protected function updateRendererStyles():void
        {
            var loc4:*=null;
            var loc1:*=availableCellRenderers.concat(activeCellRenderers);
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (loc1[loc3].setStyle != null) 
                {
                    var loc5:*=0;
                    var loc6:*=updatedRendererStyles;
                    for (loc4 in loc6) 
                    {
                        loc1[loc3].setStyle(loc4, updatedRendererStyles[loc4]);
                    }
                    loc1[loc3].drawNow();
                }
                ++loc3;
            }
            updatedRendererStyles = {};
            return;
        }

        protected function drawList():void
        {
            return;
        }

        protected override function keyDownHandler(arg1:flash.events.KeyboardEvent):void
        {
            if (!selectable) 
            {
                return;
            }
            var loc1:*=arg1.keyCode;
            switch (loc1) 
            {
                case flash.ui.Keyboard.UP:
                case flash.ui.Keyboard.DOWN:
                case flash.ui.Keyboard.END:
                case flash.ui.Keyboard.HOME:
                case flash.ui.Keyboard.PAGE_UP:
                case flash.ui.Keyboard.PAGE_DOWN:
                {
                    moveSelectionVertically(arg1.keyCode, arg1.shiftKey && _allowMultipleSelection, arg1.ctrlKey && _allowMultipleSelection);
                    arg1.stopPropagation();
                    break;
                }
                case flash.ui.Keyboard.LEFT:
                case flash.ui.Keyboard.RIGHT:
                {
                    moveSelectionHorizontally(arg1.keyCode, arg1.shiftKey && _allowMultipleSelection, arg1.ctrlKey && _allowMultipleSelection);
                    arg1.stopPropagation();
                    break;
                }
            }
            return;
        }

        protected function moveSelectionHorizontally(arg1:uint, arg2:Boolean, arg3:Boolean):void
        {
            return;
        }

        protected function moveSelectionVertically(arg1:uint, arg2:Boolean, arg3:Boolean):void
        {
            return;
        }

        protected override function initializeAccessibility():void
        {
            if (fl.controls.SelectableList.createAccessibilityImplementation != null) 
            {
                fl.controls.SelectableList.createAccessibilityImplementation(this);
            }
            return;
        }

        protected function onPreChange(arg1:fl.events.DataChangeEvent):void
        {
            var loc1:*=arg1.changeType;
            switch (loc1) 
            {
                case fl.events.DataChangeType.REMOVE:
                case fl.events.DataChangeType.ADD:
                case fl.events.DataChangeType.INVALIDATE:
                case fl.events.DataChangeType.REMOVE_ALL:
                case fl.events.DataChangeType.REPLACE:
                case fl.events.DataChangeType.INVALIDATE_ALL:
                {
                    break;
                }
                default:
                {
                    preChangeItems = selectedItems;
                    break;
                }
            }
            return;
        }

        public static function getStyleDefinition():Object
        {
            return mergeStyles(defaultStyles, fl.containers.BaseScrollPane.getStyleDefinition());
        }

        public override function set enabled(arg1:Boolean):void
        {
            super.enabled = arg1;
            list.mouseChildren = _enabled;
            return;
        }

        
        {
            defaultStyles = {"skin":"List_skin", "cellRenderer":fl.controls.listClasses.CellRenderer, "contentPadding":null, "disabledAlpha":null};
        }

        public function set dataProvider(arg1:fl.data.DataProvider):void
        {
            if (_dataProvider != null) 
            {
                _dataProvider.removeEventListener(fl.events.DataChangeEvent.DATA_CHANGE, handleDataChange);
                _dataProvider.removeEventListener(fl.events.DataChangeEvent.PRE_DATA_CHANGE, onPreChange);
            }
            _dataProvider = arg1;
            _dataProvider.addEventListener(fl.events.DataChangeEvent.DATA_CHANGE, handleDataChange, false, 0, true);
            _dataProvider.addEventListener(fl.events.DataChangeEvent.PRE_DATA_CHANGE, onPreChange, false, 0, true);
            clearSelection();
            invalidateList();
            return;
        }

        public override function get maxHorizontalScrollPosition():Number
        {
            return _maxHorizontalScrollPosition;
        }

        public function set maxHorizontalScrollPosition(arg1:Number):void
        {
            _maxHorizontalScrollPosition = arg1;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public function get length():uint
        {
            return _dataProvider.length;
        }

        public function get allowMultipleSelection():Boolean
        {
            return _allowMultipleSelection;
        }

        public function set allowMultipleSelection(arg1:Boolean):void
        {
            if (arg1 == _allowMultipleSelection) 
            {
                return;
            }
            _allowMultipleSelection = arg1;
            if (!arg1 && _selectedIndices.length > 1) 
            {
                _selectedIndices = [_selectedIndices.pop()];
                invalidate(fl.core.InvalidationType.DATA);
            }
            return;
        }

        public function get selectable():Boolean
        {
            return _selectable;
        }

        public function set selectable(arg1:Boolean):void
        {
            if (arg1 == _selectable) 
            {
                return;
            }
            if (!arg1) 
            {
                selectedIndices = [];
            }
            _selectable = arg1;
            return;
        }

        public function get selectedIndex():int
        {
            return _selectedIndices.length != 0 ? _selectedIndices[(_selectedIndices.length - 1)] : -1;
        }

        public function set selectedIndex(arg1:int):void
        {
            selectedIndices = arg1 != -1 ? [arg1] : null;
            return;
        }

        public function get selectedIndices():Array
        {
            return _selectedIndices.concat();
        }

        public function set selectedIndices(arg1:Array):void
        {
            if (!_selectable) 
            {
                return;
            }
            _selectedIndices = arg1 != null ? arg1.concat() : [];
            invalidate(fl.core.InvalidationType.SELECTED);
            return;
        }

        public function get selectedItem():Object
        {
            return _selectedIndices.length != 0 ? _dataProvider.getItemAt(selectedIndex) : null;
        }

        public function set selectedItem(arg1:Object):void
        {
            var loc1:*=_dataProvider.getItemIndex(arg1);
            selectedIndex = loc1;
            return;
        }

        public function get selectedItems():Array
        {
            var loc1:*=[];
            var loc2:*=0;
            while (loc2 < _selectedIndices.length) 
            {
                loc1.push(_dataProvider.getItemAt(_selectedIndices[loc2]));
                ++loc2;
            }
            return loc1;
        }

        public function set selectedItems(arg1:Array):void
        {
            var loc3:*=0;
            if (arg1 == null) 
            {
                selectedIndices = null;
                return;
            }
            var loc1:*=[];
            var loc2:*=0;
            while (loc2 < arg1.length) 
            {
                if ((loc3 = _dataProvider.getItemIndex(arg1[loc2])) != -1) 
                {
                    loc1.push(loc3);
                }
                ++loc2;
            }
            selectedIndices = loc1;
            return;
        }

        public function get rowCount():uint
        {
            return 0;
        }

        public function clearSelection():void
        {
            selectedIndex = -1;
            return;
        }

        public function itemToCellRenderer(arg1:Object):fl.controls.listClasses.ICellRenderer
        {
            var loc1:*=undefined;
            var loc2:*=null;
            if (arg1 != null) 
            {
                var loc3:*=0;
                var loc4:*=activeCellRenderers;
                for (loc1 in loc4) 
                {
                    loc2 = activeCellRenderers[loc1] as fl.controls.listClasses.ICellRenderer;
                    if (loc2.data != arg1) 
                    {
                        continue;
                    }
                    return loc2;
                }
            }
            return null;
        }

        public function addItem(arg1:Object):void
        {
            _dataProvider.addItem(arg1);
            invalidateList();
            return;
        }

        public function addItemAt(arg1:Object, arg2:uint):void
        {
            _dataProvider.addItemAt(arg1, arg2);
            invalidateList();
            return;
        }

        public function removeAll():void
        {
            _dataProvider.removeAll();
            return;
        }

        public function getItemAt(arg1:uint):Object
        {
            return _dataProvider.getItemAt(arg1);
        }

        public function removeItem(arg1:Object):Object
        {
            return _dataProvider.removeItem(arg1);
        }

        public function removeItemAt(arg1:uint):Object
        {
            return _dataProvider.removeItemAt(arg1);
        }

        public function replaceItemAt(arg1:Object, arg2:uint):Object
        {
            return _dataProvider.replaceItemAt(arg1, arg2);
        }

        public function invalidateList():void
        {
            _invalidateList();
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        public function invalidateItem(arg1:Object):void
        {
            if (renderedItems[arg1] == null) 
            {
                return;
            }
            invalidItems[arg1] = true;
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        public function invalidateItemAt(arg1:uint):void
        {
            var loc1:*=_dataProvider.getItemAt(arg1);
            if (loc1 != null) 
            {
                invalidateItem(loc1);
            }
            return;
        }

        public function sortItems(... rest):*
        {
            return _dataProvider.sort.apply(_dataProvider, rest);
        }

        public function sortItemsOn(arg1:String, arg2:Object=null):*
        {
            return _dataProvider.sortOn(arg1, arg2);
        }

        public function isItemSelected(arg1:Object):Boolean
        {
            return selectedItems.indexOf(arg1) > -1;
        }

        public function scrollToSelected():void
        {
            scrollToIndex(selectedIndex);
            return;
        }

        public function scrollToIndex(arg1:int):void
        {
            return;
        }

        public function getNextIndexAtLetter(arg1:String, arg2:int=-1):int
        {
            var loc3:*=NaN;
            var loc4:*=null;
            var loc5:*=null;
            if (length == 0) 
            {
                return -1;
            }
            arg1 = arg1.toUpperCase();
            var loc1:*=(length - 1);
            var loc2:*=0;
            while (loc2 < loc1) 
            {
                if ((loc3 = arg2 + 1 + loc2) > (length - 1)) 
                {
                    loc3 = loc3 - length;
                }
                if ((loc4 = getItemAt(loc3)) == null) 
                {
                    break;
                }
                if ((loc5 = itemToLabel(loc4)) != null) 
                {
                    if (loc5.charAt(0).toUpperCase() == arg1) 
                    {
                        return loc3;
                    }
                }
                ++loc2;
            }
            return -1;
        }

        public function itemToLabel(arg1:Object):String
        {
            return arg1["label"];
        }

        public function setRendererStyle(arg1:String, arg2:Object, arg3:uint=0):void
        {
            if (rendererStyles[arg1] == arg2) 
            {
                return;
            }
            updatedRendererStyles[arg1] = arg2;
            rendererStyles[arg1] = arg2;
            invalidate(fl.core.InvalidationType.RENDERER_STYLES);
            return;
        }

        public function getRendererStyle(arg1:String, arg2:int=-1):Object
        {
            return rendererStyles[arg1];
        }

        public function clearRendererStyle(arg1:String, arg2:int=-1):void
        {
            delete rendererStyles[arg1];
            updatedRendererStyles[arg1] = null;
            invalidate(fl.core.InvalidationType.RENDERER_STYLES);
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            listHolder = new flash.display.Sprite();
            addChild(listHolder);
            listHolder.scrollRect = contentScrollRect;
            list = new flash.display.Sprite();
            listHolder.addChild(list);
            return;
        }

        protected function _invalidateList():void
        {
            availableCellRenderers = [];
            while (activeCellRenderers.length > 0) 
            {
                list.removeChild(activeCellRenderers.pop() as flash.display.DisplayObject);
            }
            return;
        }

        protected var listHolder:flash.display.Sprite;

        protected var list:flash.display.Sprite;

        protected var _dataProvider:fl.data.DataProvider;

        protected var activeCellRenderers:Array;

        protected var availableCellRenderers:Array;

        protected var renderedItems:flash.utils.Dictionary;

        protected var invalidItems:flash.utils.Dictionary;

        protected var _horizontalScrollPosition:Number;

        protected var _verticalScrollPosition:Number;

        protected var _selectable:Boolean=true;

        protected var _selectedIndices:Array;

        protected var caretIndex:int=-1;

        protected var lastCaretIndex:int=-1;

        protected var preChangeItems:Array;

        internal var collectionItemImport:fl.data.SimpleCollectionItem;

        protected var rendererStyles:Object;

        protected var updatedRendererStyles:Object;

        protected var _allowMultipleSelection:Boolean=false;

        public static var createAccessibilityImplementation:Function;

        internal static var defaultStyles:Object;
    }
}


//      class TileList
package fl.controls 
{
    import fl.controls.listClasses.*;
    import fl.core.*;
    import fl.data.*;
    import fl.managers.*;
    import flash.display.*;
    import flash.events.*;
    import flash.ui.*;
    import flash.utils.*;
    
    public class TileList extends fl.controls.SelectableList implements fl.managers.IFocusManagerComponent
    {
        public function TileList()
        {
            super();
            return;
        }

        public override function set maxHorizontalScrollPosition(arg1:Number):void
        {
            return;
        }

        protected override function configUI():void
        {
            super.configUI();
            _horizontalScrollPolicy = scrollPolicy;
            _verticalScrollPolicy = fl.controls.ScrollPolicy.OFF;
            return;
        }

        protected override function setHorizontalScrollPosition(arg1:Number, arg2:Boolean=false):void
        {
            invalidate(fl.core.InvalidationType.SCROLL);
            super.setHorizontalScrollPosition(arg1, true);
            return;
        }

        protected override function setVerticalScrollPosition(arg1:Number, arg2:Boolean=false):void
        {
            invalidate(fl.core.InvalidationType.SCROLL);
            super.setVerticalScrollPosition(arg1, true);
            return;
        }

        protected override function draw():void
        {
            if (direction != fl.controls.ScrollBarDirection.VERTICAL) 
            {
                if (__columnCount > 0) 
                {
                    columnCount = __columnCount;
                }
                if (__rowCount > 0) 
                {
                    rowCount = __rowCount;
                }
            }
            else 
            {
                if (__rowCount > 0) 
                {
                    rowCount = __rowCount;
                }
                if (__columnCount > 0) 
                {
                    columnCount = __columnCount;
                }
            }
            var loc1:*=!(oldLength == length);
            oldLength = length;
            if (isInvalid(fl.core.InvalidationType.STYLES)) 
            {
                setStyles();
                drawBackground();
                if (contentPadding != getStyleValue("contentPadding")) 
                {
                    invalidate(fl.core.InvalidationType.SIZE, false);
                }
                if (_cellRenderer != getStyleValue("cellRenderer")) 
                {
                    _invalidateList();
                    _cellRenderer = getStyleValue("cellRenderer");
                }
            }
            if (isInvalid(fl.core.InvalidationType.SIZE, fl.core.InvalidationType.STATE) || loc1) 
            {
                drawLayout();
            }
            if (isInvalid(fl.core.InvalidationType.RENDERER_STYLES)) 
            {
                updateRendererStyles();
            }
            if (isInvalid(fl.core.InvalidationType.STYLES, fl.core.InvalidationType.SIZE, fl.core.InvalidationType.DATA, fl.core.InvalidationType.SCROLL, fl.core.InvalidationType.SELECTED)) 
            {
                drawList();
                _maxHorizontalScrollPosition = Math.max(0, contentWidth - availableWidth);
            }
            updateChildren();
            validate();
            return;
        }

        protected override function drawLayout():void
        {
            var loc1:*=0;
            var loc2:*=0;
            _horizontalScrollPolicy = _scrollDirection != fl.controls.ScrollBarDirection.HORIZONTAL ? fl.controls.ScrollPolicy.OFF : _scrollPolicy;
            _verticalScrollPolicy = _scrollDirection == fl.controls.ScrollBarDirection.HORIZONTAL ? fl.controls.ScrollPolicy.OFF : _scrollPolicy;
            if (_scrollDirection != fl.controls.ScrollBarDirection.HORIZONTAL) 
            {
                loc2 = columnCount;
                contentWidth = loc2 * _columnWidth;
                contentHeight = _rowHeight * Math.ceil(length / loc2);
            }
            else 
            {
                loc1 = rowCount;
                contentHeight = loc1 * _rowHeight;
                contentWidth = _columnWidth * Math.ceil(length / loc1);
            }
            super.drawLayout();
            return;
        }

        protected override function drawList():void
        {
            var loc1:*=0;
            var loc2:*=0;
            var loc3:*=null;
            var loc4:*=null;
            var loc11:*=0;
            var loc12:*=0;
            var loc15:*=null;
            var loc16:*=0;
            var loc17:*=0;
            var loc18:*=0;
            var loc19:*=0;
            var loc20:*=false;
            var loc21:*=null;
            var loc22:*=null;
            var loc23:*=null;
            var loc24:*=null;
            var loc25:*=null;
            var loc26:*=null;
            var loc5:*=rowCount;
            var loc6:*=columnCount;
            var loc7:*=columnWidth;
            var loc8:*=rowHeight;
            var loc9:*=0;
            var loc10:*=0;
            var loc27:*;
            listHolder.y = loc27 = contentPadding;
            listHolder.x = loc27;
            contentScrollRect = listHolder.scrollRect;
            contentScrollRect.x = Math.floor(_horizontalScrollPosition) % loc7;
            contentScrollRect.y = Math.floor(_verticalScrollPosition) % loc8;
            listHolder.scrollRect = contentScrollRect;
            listHolder.cacheAsBitmap = useBitmapScrolling;
            var loc13:*=[];
            if (_scrollDirection != fl.controls.ScrollBarDirection.HORIZONTAL) 
            {
                ++loc5;
                loc10 = _verticalScrollPosition / loc8 << 0;
                loc18 = Math.floor(loc10 * loc6);
                loc19 = Math.min(length, loc18 + loc5 * loc6);
                loc1 = loc18;
                while (loc1 < loc19) 
                {
                    loc13.push(loc1);
                    ++loc1;
                }
            }
            else 
            {
                loc16 = availableWidth / loc7 << 0;
                loc17 = Math.max(loc16, Math.ceil(length / loc5));
                loc9 = _horizontalScrollPosition / loc7 << 0;
                loc6 = Math.max(loc16, Math.min(loc17 - loc9, loc6 + 1));
                loc12 = 0;
                while (loc12 < loc5) 
                {
                    loc11 = 0;
                    while (loc11 < loc6) 
                    {
                        loc2 = loc12 * loc17 + loc9 + loc11;
                        if (loc2 >= length) 
                        {
                            break;
                        }
                        loc13.push(loc2);
                        ++loc11;
                    }
                    ++loc12;
                }
            }
            renderedItems = loc27 = new flash.utils.Dictionary(true);
            var loc14:*=loc27;
            loc27 = 0;
            var loc28:*=loc13;
            for each (loc2 in loc28) 
            {
                loc14[_dataProvider.getItemAt(loc2)] = true;
            }
            loc15 = new flash.utils.Dictionary(true);
            while (activeCellRenderers.length > 0) 
            {
                loc3 = (loc4 = activeCellRenderers.pop()).data;
                if (loc14[loc3] == null || invalidItems[loc3] == true) 
                {
                    availableCellRenderers.push(loc4);
                }
                else 
                {
                    loc15[loc3] = loc4;
                    invalidItems[loc3] = true;
                }
                list.removeChild(loc4 as flash.display.DisplayObject);
            }
            invalidItems = new flash.utils.Dictionary(true);
            loc1 = 0;
            loc27 = 0;
            loc28 = loc13;
            for each (loc2 in loc28) 
            {
                loc11 = loc1 % loc6;
                loc12 = loc1 / loc6 << 0;
                loc20 = false;
                loc3 = _dataProvider.getItemAt(loc2);
                if (loc15[loc3] == null) 
                {
                    if (availableCellRenderers.length > 0) 
                    {
                        loc4 = availableCellRenderers.pop() as fl.controls.listClasses.ICellRenderer;
                    }
                    else if ((loc24 = (loc4 = getDisplayObjectInstance(getStyleValue("cellRenderer")) as fl.controls.listClasses.ICellRenderer) as flash.display.Sprite) != null) 
                    {
                        loc24.addEventListener(flash.events.MouseEvent.CLICK, handleCellRendererClick, false, 0, true);
                        loc24.addEventListener(flash.events.MouseEvent.ROLL_OVER, handleCellRendererMouseEvent, false, 0, true);
                        loc24.addEventListener(flash.events.MouseEvent.ROLL_OUT, handleCellRendererMouseEvent, false, 0, true);
                        loc24.addEventListener(flash.events.Event.CHANGE, handleCellRendererChange, false, 0, true);
                        loc24.doubleClickEnabled = true;
                        loc24.addEventListener(flash.events.MouseEvent.DOUBLE_CLICK, handleCellRendererDoubleClick, false, 0, true);
                        if (loc24["setStyle"] != null) 
                        {
                            var loc29:*=0;
                            var loc30:*=rendererStyles;
                            for (loc25 in loc30) 
                            {
                                var loc31:*;
                                (loc31 = loc24)["setStyle"](loc25, rendererStyles[loc25]);
                            }
                        }
                    }
                }
                else 
                {
                    loc20 = true;
                    loc4 = loc15[loc3];
                    delete loc15[loc3];
                }
                list.addChild(loc4 as flash.display.Sprite);
                activeCellRenderers.push(loc4);
                loc4.y = loc8 * loc12;
                loc4.x = loc7 * loc11;
                loc4.setSize(columnWidth, rowHeight);
                loc21 = itemToLabel(loc3);
                loc22 = null;
                if (_iconFunction == null) 
                {
                    if (_iconField != null) 
                    {
                        loc22 = loc3[_iconField];
                    }
                }
                else 
                {
                    loc22 = _iconFunction(loc3);
                }
                loc23 = null;
                if (_sourceFunction == null) 
                {
                    if (_sourceField != null) 
                    {
                        loc23 = loc3[_sourceField];
                    }
                }
                else 
                {
                    loc23 = _sourceFunction(loc3);
                }
                if (!loc20) 
                {
                    loc4.data = loc3;
                }
                loc4.listData = new fl.controls.listClasses.TileListData(loc21, loc22, loc23, this, loc2, loc10 + loc12, loc9 + loc11) as fl.controls.listClasses.ListData;
                loc4.selected = !(_selectedIndices.indexOf(loc2) == -1);
                if (loc4 is fl.core.UIComponent) 
                {
                    (loc26 = loc4 as fl.core.UIComponent).drawNow();
                }
                ++loc1;
            }
            return;
        }

        public override function get dataProvider():fl.data.DataProvider
        {
            return super.dataProvider;
        }

        protected override function keyDownHandler(arg1:flash.events.KeyboardEvent):void
        {
            var loc1:*=0;
            arg1.stopPropagation();
            if (!selectable) 
            {
                return;
            }
            var loc2:*=arg1.keyCode;
            switch (loc2) 
            {
                case flash.ui.Keyboard.UP:
                case flash.ui.Keyboard.DOWN:
                {
                    moveSelectionVertically(arg1.keyCode, arg1.shiftKey && _allowMultipleSelection, arg1.ctrlKey && _allowMultipleSelection);
                    break;
                }
                case flash.ui.Keyboard.PAGE_UP:
                case flash.ui.Keyboard.PAGE_DOWN:
                case flash.ui.Keyboard.END:
                case flash.ui.Keyboard.HOME:
                {
                    if (_scrollDirection != fl.controls.ScrollBarDirection.HORIZONTAL) 
                    {
                        moveSelectionVertically(arg1.keyCode, arg1.shiftKey && _allowMultipleSelection, arg1.ctrlKey && _allowMultipleSelection);
                    }
                    else 
                    {
                        moveSelectionHorizontally(arg1.keyCode, arg1.shiftKey && _allowMultipleSelection, arg1.ctrlKey && _allowMultipleSelection);
                    }
                    break;
                }
                case flash.ui.Keyboard.LEFT:
                case flash.ui.Keyboard.RIGHT:
                {
                    moveSelectionHorizontally(arg1.keyCode, arg1.shiftKey && _allowMultipleSelection, arg1.ctrlKey && _allowMultipleSelection);
                    break;
                }
                default:
                {
                    loc1 = getNextIndexAtLetter(String.fromCharCode(arg1.keyCode), selectedIndex);
                    if (loc1 > -1) 
                    {
                        selectedIndex = loc1;
                        scrollToSelected();
                    }
                    break;
                }
            }
            return;
        }

        protected function calculateAvailableHeight():Number
        {
            var loc1:*=Number(getStyleValue("contentPadding"));
            return height - loc1 * 2 - (_horizontalScrollPolicy == fl.controls.ScrollPolicy.ON || _horizontalScrollPolicy == fl.controls.ScrollPolicy.AUTO && _maxHorizontalScrollPosition > 0 ? 15 : 0);
        }

        protected override function moveSelectionVertically(arg1:uint, arg2:Boolean, arg3:Boolean):void
        {
            var loc4:*=0;
            var loc5:*=0;
            var loc1:*=Math.max(1, Math.max(contentHeight, availableHeight) / _rowHeight << 0);
            var loc2:*=Math.ceil(Math.max(columnCount * rowCount, length) / loc1);
            var loc3:*=Math.ceil(length / loc2);
            var loc6:*=arg1;
            switch (loc6) 
            {
                case flash.ui.Keyboard.UP:
                {
                    loc4 = selectedIndex - loc2;
                    break;
                }
                case flash.ui.Keyboard.DOWN:
                {
                    loc4 = selectedIndex + loc2;
                    break;
                }
                case flash.ui.Keyboard.HOME:
                {
                    loc4 = 0;
                    break;
                }
                case flash.ui.Keyboard.END:
                {
                    loc4 = (length - 1);
                    break;
                }
                case flash.ui.Keyboard.PAGE_DOWN:
                {
                    if ((loc5 = selectedIndex + loc2 * (loc3 - 1)) >= length) 
                    {
                        loc5 = loc5 - loc2;
                    }
                    loc4 = Math.min((length - 1), loc5);
                    break;
                }
                case flash.ui.Keyboard.PAGE_UP:
                {
                    if ((loc5 = selectedIndex - loc2 * (loc3 - 1)) < 0) 
                    {
                        loc5 = loc5 + loc2;
                    }
                    loc4 = Math.max(0, loc5);
                    break;
                }
            }
            doKeySelection(loc4, arg2, arg3);
            scrollToSelected();
            return;
        }

        protected override function moveSelectionHorizontally(arg1:uint, arg2:Boolean, arg3:Boolean):void
        {
            var loc1:*=0;
            var loc2:*=0;
            var loc3:*=0;
            var loc4:*=undefined;
            loc1 = Math.ceil(Math.max(rowCount * columnCount, length) / rowCount);
            var loc5:*=arg1;
            switch (loc5) 
            {
                case flash.ui.Keyboard.LEFT:
                {
                    loc2 = Math.max(0, (selectedIndex - 1));
                    break;
                }
                case flash.ui.Keyboard.RIGHT:
                {
                    loc2 = Math.min((length - 1), selectedIndex + 1);
                    break;
                }
                case flash.ui.Keyboard.HOME:
                {
                    loc2 = 0;
                    break;
                }
                case flash.ui.Keyboard.END:
                {
                    loc2 = (length - 1);
                    break;
                }
                case flash.ui.Keyboard.PAGE_UP:
                {
                    loc3 = selectedIndex - selectedIndex % loc1;
                    loc2 = Math.max(0, Math.max(loc3, selectedIndex - columnCount));
                    break;
                }
                case flash.ui.Keyboard.PAGE_DOWN:
                {
                    loc4 = (selectedIndex - selectedIndex % loc1 + loc1 - 1);
                    loc2 = Math.min((length - 1), Math.min(loc4, selectedIndex + loc1));
                    break;
                }
            }
            doKeySelection(loc2, arg2, arg3);
            scrollToSelected();
            return;
        }

        protected function doKeySelection(arg1:uint, arg2:Boolean, arg3:Boolean):void
        {
            var loc3:*=0;
            var loc4:*=0;
            var loc1:*=selectedIndices;
            var loc2:*=false;
            if (!(arg1 < 0 || arg1 > (length - 1))) 
            {
                if (arg2 && loc1.length > 0 && !(arg1 == loc1[0])) 
                {
                    loc3 = loc1[0];
                    loc1 = [];
                    if (arg1 < loc3) 
                    {
                        loc4 = loc3;
                        while (loc4 >= arg1) 
                        {
                            loc1.push(loc4);
                            --loc4;
                        }
                    }
                    else 
                    {
                        loc4 = loc3;
                        while (loc4 <= arg1) 
                        {
                            loc1.push(loc4);
                            ++loc4;
                        }
                    }
                    loc2 = true;
                }
                else 
                {
                    loc1 = [arg1];
                    caretIndex = arg1;
                    loc2 = true;
                }
            }
            selectedIndices = loc1;
            if (loc2) 
            {
                dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            }
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        protected override function initializeAccessibility():void
        {
            if (fl.controls.TileList.createAccessibilityImplementation != null) 
            {
                fl.controls.TileList.createAccessibilityImplementation(this);
            }
            return;
        }

        public static function getStyleDefinition():Object
        {
            return mergeStyles(defaultStyles, fl.controls.SelectableList.getStyleDefinition(), fl.controls.ScrollBar.getStyleDefinition());
        }

        
        {
            defaultStyles = {"cellRenderer":fl.controls.listClasses.ImageCell, "focusRectSkin":null, "focusRectPadding":null, "skin":"TileList_skin"};
        }

        public override function set dataProvider(arg1:fl.data.DataProvider):void
        {
            super.dataProvider = arg1;
            return;
        }

        public function get labelField():String
        {
            return _labelField;
        }

        public function set labelField(arg1:String):void
        {
            if (arg1 == _labelField) 
            {
                return;
            }
            _labelField = arg1;
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        public function get labelFunction():Function
        {
            return _labelFunction;
        }

        public function set labelFunction(arg1:Function):void
        {
            if (_labelFunction == arg1) 
            {
                return;
            }
            _labelFunction = arg1;
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        public function get iconField():String
        {
            return _iconField;
        }

        public function set iconField(arg1:String):void
        {
            if (arg1 == _iconField) 
            {
                return;
            }
            _iconField = arg1;
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        public function get iconFunction():Function
        {
            return _iconFunction;
        }

        public function set iconFunction(arg1:Function):void
        {
            if (_iconFunction == arg1) 
            {
                return;
            }
            _iconFunction = arg1;
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        public function get sourceField():String
        {
            return _sourceField;
        }

        public function set sourceField(arg1:String):void
        {
            _sourceField = arg1;
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        public function get sourceFunction():Function
        {
            return _sourceFunction;
        }

        public function set sourceFunction(arg1:Function):void
        {
            _sourceFunction = arg1;
            invalidate(fl.core.InvalidationType.DATA);
            return;
        }

        public override function get rowCount():uint
        {
            var loc1:*=Number(getStyleValue("contentPadding"));
            var loc2:*=Math.max(1, (_width - 2 * loc1) / _columnWidth << 0);
            var loc3:*=Math.max(1, (_height - 2 * loc1) / _rowHeight << 0);
            if (_scrollDirection != fl.controls.ScrollBarDirection.HORIZONTAL) 
            {
                loc3 = Math.max(1, Math.ceil((_height - 2 * loc1) / _rowHeight));
            }
            else if (_scrollPolicy == fl.controls.ScrollPolicy.ON || _scrollPolicy == fl.controls.ScrollPolicy.AUTO && length > loc2 * loc3) 
            {
                loc3 = Math.max(1, (_height - 2 * loc1 - 15) / _rowHeight << 0);
            }
            return loc3;
        }

        public function set rowCount(arg1:uint):void
        {
            if (arg1 == 0) 
            {
                return;
            }
            if (componentInspectorSetting) 
            {
                __rowCount = arg1;
                return;
            }
            __rowCount = 0;
            var loc1:*=Number(getStyleValue("contentPadding"));
            var loc2:*=Math.ceil(length / arg1) > width / columnWidth >> 0 && _scrollPolicy == fl.controls.ScrollPolicy.AUTO || _scrollPolicy == fl.controls.ScrollPolicy.ON;
            height = rowHeight * arg1 + 2 * loc1 + (_scrollDirection == fl.controls.ScrollBarDirection.HORIZONTAL && loc2 ? fl.controls.ScrollBar.WIDTH : 0);
            return;
        }

        public function get rowHeight():Number
        {
            return _rowHeight;
        }

        public function set rowHeight(arg1:Number):void
        {
            if (_rowHeight == arg1) 
            {
                return;
            }
            _rowHeight = arg1;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public function get columnCount():uint
        {
            var loc1:*=Number(getStyleValue("contentPadding"));
            var loc2:*=Math.max(1, (_width - 2 * loc1) / _columnWidth << 0);
            var loc3:*=Math.max(1, (_height - 2 * loc1) / _rowHeight << 0);
            if (_scrollDirection == fl.controls.ScrollBarDirection.HORIZONTAL) 
            {
                loc2 = Math.max(1, Math.ceil((_width - 2 * loc1) / _columnWidth));
            }
            else if (_scrollPolicy == fl.controls.ScrollPolicy.ON || _scrollPolicy == fl.controls.ScrollPolicy.AUTO && length > loc2 * loc3) 
            {
                loc2 = Math.max(1, (_width - 2 * loc1 - 15) / _columnWidth << 0);
            }
            return loc2;
        }

        public function set columnCount(arg1:uint):void
        {
            if (arg1 == 0) 
            {
                return;
            }
            if (componentInspectorSetting) 
            {
                __columnCount = arg1;
                return;
            }
            __columnCount = 0;
            var loc1:*=Number(getStyleValue("contentPadding"));
            var loc2:*=Math.ceil(length / arg1) > height / rowHeight >> 0 && _scrollPolicy == fl.controls.ScrollPolicy.AUTO || _scrollPolicy == fl.controls.ScrollPolicy.ON;
            width = columnWidth * arg1 + 2 * loc1 + (_scrollDirection == fl.controls.ScrollBarDirection.VERTICAL && loc2 ? 15 : 0);
            return;
        }

        public function get columnWidth():Number
        {
            return _columnWidth;
        }

        public function set columnWidth(arg1:Number):void
        {
            if (_columnWidth == arg1) 
            {
                return;
            }
            _columnWidth = arg1;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public function get innerWidth():Number
        {
            drawNow();
            var loc1:*=getStyleValue("contentPadding") as Number;
            return width - loc1 * 2 - (_verticalScrollBar.visible ? _verticalScrollBar.width : 0);
        }

        public function get innerHeight():Number
        {
            drawNow();
            var loc1:*=getStyleValue("contentPadding") as Number;
            return height - loc1 * 2 - (_horizontalScrollBar.visible ? _horizontalScrollBar.height : 0);
        }

        public function get direction():String
        {
            return _scrollDirection;
        }

        public function set direction(arg1:String):void
        {
            if (_scrollDirection == arg1) 
            {
                return;
            }
            _scrollDirection = arg1;
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public function get scrollPolicy():String
        {
            return _scrollPolicy;
        }

        public function set scrollPolicy(arg1:String):void
        {
            if (!componentInspectorSetting && _scrollPolicy == arg1) 
            {
                return;
            }
            _scrollPolicy = arg1;
            if (direction != fl.controls.ScrollBarDirection.HORIZONTAL) 
            {
                _verticalScrollPolicy = arg1;
                _horizontalScrollPolicy = fl.controls.ScrollPolicy.OFF;
            }
            else 
            {
                _horizontalScrollPolicy = arg1;
                _verticalScrollPolicy = fl.controls.ScrollPolicy.OFF;
            }
            invalidate(fl.core.InvalidationType.SIZE);
            return;
        }

        public override function scrollToIndex(arg1:int):void
        {
            var loc2:*=NaN;
            var loc3:*=NaN;
            drawNow();
            var loc1:*=Math.max(1, contentWidth / _columnWidth << 0);
            if (_scrollDirection != fl.controls.ScrollBarDirection.VERTICAL) 
            {
                if (columnWidth > availableWidth) 
                {
                    return;
                }
                if ((loc3 = arg1 % loc1 * columnWidth) < horizontalScrollPosition) 
                {
                    horizontalScrollPosition = loc3;
                }
                else if (loc3 > horizontalScrollPosition + availableWidth - columnWidth) 
                {
                    horizontalScrollPosition = loc3 + columnWidth - availableWidth;
                }
            }
            else 
            {
                if (rowHeight > availableHeight) 
                {
                    return;
                }
                loc2 = (arg1 / loc1 >> 0) * rowHeight;
                if (loc2 < verticalScrollPosition) 
                {
                    verticalScrollPosition = loc2;
                }
                else if (loc2 > verticalScrollPosition + availableHeight - rowHeight) 
                {
                    verticalScrollPosition = loc2 + rowHeight - availableHeight;
                }
            }
            return;
        }

        public override function itemToLabel(arg1:Object):String
        {
            if (_labelFunction != null) 
            {
                return String(_labelFunction(arg1));
            }
            if (arg1[_labelField] == null) 
            {
                return "";
            }
            return String(arg1[_labelField]);
        }

        public override function get verticalScrollPolicy():String
        {
            return null;
        }

        public override function set verticalScrollPolicy(arg1:String):void
        {
            return;
        }

        public override function get horizontalScrollPolicy():String
        {
            return null;
        }

        public override function set horizontalScrollPolicy(arg1:String):void
        {
            return;
        }

        public override function get maxHorizontalScrollPosition():Number
        {
            drawNow();
            return _maxHorizontalScrollPosition;
        }

        protected var _rowHeight:Number=50;

        protected var _columnWidth:Number=50;

        protected var _scrollDirection:String="horizontal";

        protected var _scrollPolicy:String="auto";

        protected var _cellRenderer:Object;

        protected var oldLength:uint=0;

        protected var _labelField:String="label";

        protected var _iconField:String="icon";

        protected var _iconFunction:Function;

        protected var _sourceField:String="source";

        protected var _sourceFunction:Function;

        protected var __rowCount:uint=0;

        protected var __columnCount:uint=0;

        internal var collectionItemImport:fl.data.TileListCollectionItem;

        protected var _labelFunction:Function;

        public static var createAccessibilityImplementation:Function;

        internal static var defaultStyles:Object;
    }
}


//    package core
//      class ComponentShim
package fl.core 
{
    import flash.display.*;
    
    public dynamic class ComponentShim extends flash.display.MovieClip
    {
        public function ComponentShim()
        {
            super();
            return;
        }
    }
}


//      class InvalidationType
package fl.core 
{
    public class InvalidationType extends Object
    {
        public function InvalidationType()
        {
            super();
            return;
        }

        public static const ALL:String="all";

        public static const SIZE:String="size";

        public static const STYLES:String="styles";

        public static const RENDERER_STYLES:String="rendererStyles";

        public static const STATE:String="state";

        public static const DATA:String="data";

        public static const SCROLL:String="scroll";

        public static const SELECTED:String="selected";
    }
}


//      class UIComponent
package fl.core 
{
    import fl.events.*;
    import fl.managers.*;
    import flash.display.*;
    import flash.events.*;
    import flash.system.*;
    import flash.text.*;
    import flash.utils.*;
    
    public class UIComponent extends flash.display.Sprite
    {
        public function UIComponent()
        {
            super();
            instanceStyles = {};
            sharedStyles = {};
            invalidHash = {};
            callLaterMethods = new flash.utils.Dictionary();
            fl.managers.StyleManager.registerInstance(this);
            configUI();
            invalidate(fl.core.InvalidationType.ALL);
            tabEnabled = this is fl.managers.IFocusManagerComponent;
            focusRect = false;
            if (tabEnabled) 
            {
                addEventListener(flash.events.FocusEvent.FOCUS_IN, focusInHandler);
                addEventListener(flash.events.FocusEvent.FOCUS_OUT, focusOutHandler);
                addEventListener(flash.events.KeyboardEvent.KEY_DOWN, keyDownHandler);
                addEventListener(flash.events.KeyboardEvent.KEY_UP, keyUpHandler);
            }
            initializeFocusManager();
            addEventListener(flash.events.Event.ENTER_FRAME, hookAccessibility, false, 0, true);
            return;
        }

        protected function configUI():void
        {
            isLivePreview = checkLivePreview();
            var loc1:*=rotation;
            rotation = 0;
            var loc2:*=super.width;
            var loc3:*=super.height;
            var loc4:*;
            super.scaleY = loc4 = 1;
            super.scaleX = loc4;
            setSize(loc2, loc3);
            move(super.x, super.y);
            rotation = loc1;
            startWidth = loc2;
            startHeight = loc3;
            if (numChildren > 0) 
            {
                removeChildAt(0);
            }
            return;
        }

        protected function checkLivePreview():Boolean
        {
            var className:String;

            var loc1:*;
            className = null;
            if (parent == null) 
            {
                return false;
            }
            try 
            {
                className = flash.utils.getQualifiedClassName(parent);
            }
            catch (e:Error)
            {
            };
            return className == "fl.livepreview::LivePreviewParent";
        }

        protected function isInvalid(arg1:String, ... rest):Boolean
        {
            if (invalidHash[arg1] || invalidHash[fl.core.InvalidationType.ALL]) 
            {
                return true;
            }
            while (rest.length > 0) 
            {
                if (!invalidHash[rest.pop()]) 
                {
                    continue;
                }
                return true;
            }
            return false;
        }

        protected function validate():void
        {
            invalidHash = {};
            return;
        }

        protected function draw():void
        {
            if (isInvalid(fl.core.InvalidationType.SIZE, fl.core.InvalidationType.STYLES)) 
            {
                if (isFocused && focusManager.showFocusIndicator) 
                {
                    drawFocus(true);
                }
            }
            validate();
            return;
        }

        protected function getDisplayObjectInstance(arg1:Object):flash.display.DisplayObject
        {
            var skin:Object;
            var classDef:Object;

            var loc1:*;
            skin = arg1;
            classDef = null;
            if (skin is Class) 
            {
                return new skin() as flash.display.DisplayObject;
            }
            if (skin is flash.display.DisplayObject) 
            {
                (skin as flash.display.DisplayObject).x = 0;
                (skin as flash.display.DisplayObject).y = 0;
                return skin as flash.display.DisplayObject;
            }
            try 
            {
                classDef = flash.utils.getDefinitionByName(skin.toString());
            }
            catch (e:Error)
            {
                try 
                {
                    classDef = loaderInfo.applicationDomain.getDefinition(skin.toString()) as Object;
                }
                catch (e:Error)
                {
                };
            }
            if (classDef == null) 
            {
                return null;
            }
            return new classDef() as flash.display.DisplayObject;
        }

        protected function getStyleValue(arg1:String):Object
        {
            return instanceStyles[arg1] != null ? instanceStyles[arg1] : sharedStyles[arg1];
        }

        protected function copyStylesToChild(arg1:fl.core.UIComponent, arg2:Object):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=arg2;
            for (loc1 in loc3) 
            {
                arg1.setStyle(loc1, getStyleValue(arg2[loc1]));
            }
            return;
        }

        protected function callLater(arg1:Function):void
        {
            var fn:Function;

            var loc1:*;
            fn = arg1;
            if (inCallLaterPhase) 
            {
                return;
            }
            callLaterMethods[fn] = true;
            if (stage == null) 
            {
                addEventListener(flash.events.Event.ADDED_TO_STAGE, callLaterDispatcher, false, 0, true);
            }
            else 
            {
                try 
                {
                    stage.addEventListener(flash.events.Event.RENDER, callLaterDispatcher, false, 0, true);
                    stage.invalidate();
                }
                catch (se:SecurityError)
                {
                    addEventListener(flash.events.Event.ENTER_FRAME, callLaterDispatcher, false, 0, true);
                }
            }
            return;
        }

        internal function callLaterDispatcher(arg1:flash.events.Event):void
        {
            var event:flash.events.Event;
            var methods:flash.utils.Dictionary;
            var method:Object;

            var loc1:*;
            method = null;
            event = arg1;
            if (event.type == flash.events.Event.ADDED_TO_STAGE) 
            {
                try 
                {
                    removeEventListener(flash.events.Event.ADDED_TO_STAGE, callLaterDispatcher);
                    stage.addEventListener(flash.events.Event.RENDER, callLaterDispatcher, false, 0, true);
                    stage.invalidate();
                    return;
                }
                catch (se1:SecurityError)
                {
                    addEventListener(flash.events.Event.ENTER_FRAME, callLaterDispatcher, false, 0, true);
                }
            }
            event.target.removeEventListener(flash.events.Event.RENDER, callLaterDispatcher);
            event.target.removeEventListener(flash.events.Event.ENTER_FRAME, callLaterDispatcher);
            try 
            {
                if (stage == null) 
                {
                    addEventListener(flash.events.Event.ADDED_TO_STAGE, callLaterDispatcher, false, 0, true);
                    return;
                }
            }
            catch (se2:SecurityError)
            {
            };
            inCallLaterPhase = true;
            methods = callLaterMethods;
            loc2 = 0;
            var loc3:*=methods;
            for (method in loc3) 
            {
                method();
                delete methods[method];
            }
            inCallLaterPhase = false;
            return;
        }

        internal function initializeFocusManager():void
        {
            var loc1:*=null;
            var loc2:*=null;
            if (stage != null) 
            {
                createFocusManager();
                loc1 = focusManager;
                if (loc1 != null) 
                {
                    loc2 = focusManagerUsers[loc1];
                    if (loc2 == null) 
                    {
                        loc2 = new flash.utils.Dictionary(true);
                        focusManagerUsers[loc1] = loc2;
                    }
                    loc2[this] = true;
                }
            }
            else 
            {
                addEventListener(flash.events.Event.ADDED_TO_STAGE, addedHandler, false, 0, true);
            }
            addEventListener(flash.events.Event.REMOVED_FROM_STAGE, removedHandler);
            return;
        }

        protected function getScaleY():Number
        {
            return super.scaleY;
        }

        internal function addedHandler(arg1:flash.events.Event):void
        {
            removeEventListener(flash.events.Event.ADDED_TO_STAGE, addedHandler);
            initializeFocusManager();
            return;
        }

        internal function removedHandler(arg1:flash.events.Event):void
        {
            var loc2:*=null;
            var loc3:*=false;
            var loc4:*=undefined;
            var loc5:*=undefined;
            var loc6:*=null;
            removeEventListener(flash.events.Event.REMOVED_FROM_STAGE, removedHandler);
            addEventListener(flash.events.Event.ADDED_TO_STAGE, addedHandler);
            var loc1:*=focusManager;
            if (loc1 != null) 
            {
                loc2 = focusManagerUsers[loc1];
                if (loc2 != null) 
                {
                    delete loc2[this];
                    loc3 = true;
                    var loc7:*=0;
                    var loc8:*=loc2;
                    for (loc4 in loc8) 
                    {
                        loc3 = false;
                        break;
                    }
                    if (loc3) 
                    {
                        delete focusManagerUsers[loc1];
                        loc2 = null;
                    }
                }
                if (loc2 == null) 
                {
                    loc1.deactivate();
                    loc7 = 0;
                    loc8 = focusManagers;
                    for (loc5 in loc8) 
                    {
                        loc6 = focusManagers[loc5];
                        if (loc1 != loc6) 
                        {
                            continue;
                        }
                        delete focusManagers[loc5];
                    }
                }
            }
            return;
        }

        protected function createFocusManager():void
        {
            var stageAccessOK:Boolean;
            var myTopLevel:flash.display.DisplayObjectContainer;

            var loc1:*;
            stageAccessOK = true;
            try 
            {
                stage.getChildAt(0);
            }
            catch (se:SecurityError)
            {
                stageAccessOK = false;
            }
            myTopLevel = null;
            if (stageAccessOK) 
            {
                myTopLevel = stage;
            }
            else 
            {
                myTopLevel = this;
                try 
                {
                    while (myTopLevel.parent != null) 
                    {
                        myTopLevel = myTopLevel.parent;
                    }
                }
                catch (se:SecurityError)
                {
                };
            }
            if (focusManagers[myTopLevel] == null) 
            {
                focusManagers[myTopLevel] = new fl.managers.FocusManager(myTopLevel);
            }
            return;
        }

        protected function isOurFocus(arg1:flash.display.DisplayObject):Boolean
        {
            return arg1 == this;
        }

        protected function focusInHandler(arg1:flash.events.FocusEvent):void
        {
            var loc1:*=null;
            if (isOurFocus(arg1.target as flash.display.DisplayObject)) 
            {
                loc1 = focusManager;
                if (loc1 && loc1.showFocusIndicator) 
                {
                    drawFocus(true);
                    isFocused = true;
                }
            }
            return;
        }

        protected function keyDownHandler(arg1:flash.events.KeyboardEvent):void
        {
            return;
        }

        protected function keyUpHandler(arg1:flash.events.KeyboardEvent):void
        {
            return;
        }

        protected function hookAccessibility(arg1:flash.events.Event):void
        {
            removeEventListener(flash.events.Event.ENTER_FRAME, hookAccessibility);
            initializeAccessibility();
            return;
        }

        protected function initializeAccessibility():void
        {
            if (fl.core.UIComponent.createAccessibilityImplementation != null) 
            {
                fl.core.UIComponent.createAccessibilityImplementation(this);
            }
            return;
        }

        public static function getStyleDefinition():Object
        {
            return defaultStyles;
        }

        public static function mergeStyles(... rest):Object
        {
            var loc4:*=null;
            var loc5:*=null;
            var loc1:*={};
            var loc2:*=rest.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                loc4 = rest[loc3];
                var loc6:*=0;
                var loc7:*=loc4;
                for (loc5 in loc7) 
                {
                    if (loc1[loc5] != null) 
                    {
                        continue;
                    }
                    loc1[loc5] = rest[loc3][loc5];
                }
                ++loc3;
            }
            return loc1;
        }

        
        {
            inCallLaterPhase = false;
            defaultStyles = {"focusRectSkin":"focusRectSkin", "focusRectPadding":2, "textFormat":new flash.text.TextFormat("_sans", 11, 0, false, false, false, "", "", flash.text.TextFormatAlign.LEFT, 0, 0, 0, 0), "disabledTextFormat":new flash.text.TextFormat("_sans", 11, 10066329, false, false, false, "", "", flash.text.TextFormatAlign.LEFT, 0, 0, 0, 0), "defaultTextFormat":new flash.text.TextFormat("_sans", 11, 0, false, false, false, "", "", flash.text.TextFormatAlign.LEFT, 0, 0, 0, 0), "defaultDisabledTextFormat":new flash.text.TextFormat("_sans", 11, 10066329, false, false, false, "", "", flash.text.TextFormatAlign.LEFT, 0, 0, 0, 0)};
            focusManagers = new flash.utils.Dictionary(true);
            focusManagerUsers = new flash.utils.Dictionary(true);
        }

        public function get componentInspectorSetting():Boolean
        {
            return _inspector;
        }

        public function set componentInspectorSetting(arg1:Boolean):void
        {
            _inspector = arg1;
            if (_inspector) 
            {
                beforeComponentParameters();
            }
            else 
            {
                afterComponentParameters();
            }
            return;
        }

        protected function beforeComponentParameters():void
        {
            return;
        }

        protected function afterComponentParameters():void
        {
            return;
        }

        public function get enabled():Boolean
        {
            return _enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            if (arg1 == _enabled) 
            {
                return;
            }
            _enabled = arg1;
            invalidate(fl.core.InvalidationType.STATE);
            return;
        }

        public function setSize(arg1:Number, arg2:Number):void
        {
            _width = arg1;
            _height = arg2;
            invalidate(fl.core.InvalidationType.SIZE);
            dispatchEvent(new fl.events.ComponentEvent(fl.events.ComponentEvent.RESIZE, false));
            return;
        }

        public override function get width():Number
        {
            return _width;
        }

        public override function set width(arg1:Number):void
        {
            if (_width == arg1) 
            {
                return;
            }
            setSize(arg1, height);
            return;
        }

        public override function get height():Number
        {
            return _height;
        }

        public override function set height(arg1:Number):void
        {
            if (_height == arg1) 
            {
                return;
            }
            setSize(width, arg1);
            return;
        }

        public function setStyle(arg1:String, arg2:Object):void
        {
            if (instanceStyles[arg1] === arg2 && !(arg2 is flash.text.TextFormat)) 
            {
                return;
            }
            instanceStyles[arg1] = arg2;
            invalidate(fl.core.InvalidationType.STYLES);
            return;
        }

        public function clearStyle(arg1:String):void
        {
            setStyle(arg1, null);
            return;
        }

        public function getStyle(arg1:String):Object
        {
            return instanceStyles[arg1];
        }

        public function move(arg1:Number, arg2:Number):void
        {
            _x = arg1;
            _y = arg2;
            super.x = Math.round(arg1);
            super.y = Math.round(arg2);
            dispatchEvent(new fl.events.ComponentEvent(fl.events.ComponentEvent.MOVE));
            return;
        }

        public override function get x():Number
        {
            return isNaN(_x) ? super.x : _x;
        }

        public override function set x(arg1:Number):void
        {
            move(arg1, _y);
            return;
        }

        public override function get y():Number
        {
            return isNaN(_y) ? super.y : _y;
        }

        public override function set y(arg1:Number):void
        {
            move(_x, arg1);
            return;
        }

        public override function get scaleX():Number
        {
            return width / startWidth;
        }

        public override function set scaleX(arg1:Number):void
        {
            setSize(startWidth * arg1, height);
            return;
        }

        public override function get scaleY():Number
        {
            return height / startHeight;
        }

        public override function set scaleY(arg1:Number):void
        {
            setSize(width, startHeight * arg1);
            return;
        }

        protected function focusOutHandler(arg1:flash.events.FocusEvent):void
        {
            if (isOurFocus(arg1.target as flash.display.DisplayObject)) 
            {
                drawFocus(false);
                isFocused = false;
            }
            return;
        }

        protected function setScaleY(arg1:Number):void
        {
            super.scaleY = arg1;
            return;
        }

        protected function getScaleX():Number
        {
            return super.scaleX;
        }

        protected function setScaleX(arg1:Number):void
        {
            super.scaleX = arg1;
            return;
        }

        public override function get visible():Boolean
        {
            return super.visible;
        }

        public override function set visible(arg1:Boolean):void
        {
            if (super.visible == arg1) 
            {
                return;
            }
            super.visible = arg1;
            var loc1:*=arg1 ? fl.events.ComponentEvent.SHOW : fl.events.ComponentEvent.HIDE;
            dispatchEvent(new fl.events.ComponentEvent(loc1, true));
            return;
        }

        public function validateNow():void
        {
            invalidate(fl.core.InvalidationType.ALL, false);
            draw();
            return;
        }

        public function invalidate(arg1:String="all", arg2:Boolean=true):void
        {
            invalidHash[arg1] = true;
            if (arg2) 
            {
                this.callLater(draw);
            }
            return;
        }

        public function setSharedStyle(arg1:String, arg2:Object):void
        {
            if (sharedStyles[arg1] === arg2 && !(arg2 is flash.text.TextFormat)) 
            {
                return;
            }
            sharedStyles[arg1] = arg2;
            if (instanceStyles[arg1] == null) 
            {
                invalidate(fl.core.InvalidationType.STYLES);
            }
            return;
        }

        public function get focusEnabled():Boolean
        {
            return _focusEnabled;
        }

        public function set focusEnabled(arg1:Boolean):void
        {
            _focusEnabled = arg1;
            return;
        }

        public function get mouseFocusEnabled():Boolean
        {
            return _mouseFocusEnabled;
        }

        public function set mouseFocusEnabled(arg1:Boolean):void
        {
            _mouseFocusEnabled = arg1;
            return;
        }

        public function get focusManager():fl.managers.IFocusManager
        {
            var o:flash.display.DisplayObject;

            var loc1:*;
            o = this;
            while (o) 
            {
                if (fl.core.UIComponent.focusManagers[o] != null) 
                {
                    return fl.managers.IFocusManager(fl.core.UIComponent.focusManagers[o]);
                }
            }
            return null;
        }

        public function set focusManager(arg1:fl.managers.IFocusManager):void
        {
            fl.core.UIComponent.focusManagers[this] = arg1;
            return;
        }

        public function drawFocus(arg1:Boolean):void
        {
            var loc1:*=NaN;
            isFocused = arg1;
            if (!(uiFocusRect == null) && contains(uiFocusRect)) 
            {
                removeChild(uiFocusRect);
                uiFocusRect = null;
            }
            if (arg1) 
            {
                uiFocusRect = getDisplayObjectInstance(getStyleValue("focusRectSkin")) as flash.display.Sprite;
                if (uiFocusRect == null) 
                {
                    return;
                }
                loc1 = Number(getStyleValue("focusRectPadding"));
                uiFocusRect.x = -loc1;
                uiFocusRect.y = -loc1;
                uiFocusRect.width = width + loc1 * 2;
                uiFocusRect.height = height + loc1 * 2;
                addChildAt(uiFocusRect, 0);
            }
            return;
        }

        public function setFocus():void
        {
            if (stage) 
            {
                stage.focus = this;
            }
            return;
        }

        public function getFocus():flash.display.InteractiveObject
        {
            if (stage) 
            {
                return stage.focus;
            }
            return null;
        }

        protected function setIMEMode(arg1:Boolean):*
        {
            var enabled:Boolean;

            var loc1:*;
            enabled = arg1;
            if (_imeMode != null) 
            {
                if (enabled) 
                {
                    flash.system.IME.enabled = true;
                    _oldIMEMode = flash.system.IME.conversionMode;
                    try 
                    {
                        if (!errorCaught && !(flash.system.IME.conversionMode == flash.system.IMEConversionMode.UNKNOWN)) 
                        {
                            flash.system.IME.conversionMode = _imeMode;
                        }
                        errorCaught = false;
                    }
                    catch (e:Error)
                    {
                        errorCaught = true;
                        throw new Error("IME mode not supported: " + _imeMode);
                    }
                }
                else 
                {
                    if (!(flash.system.IME.conversionMode == flash.system.IMEConversionMode.UNKNOWN) && !(_oldIMEMode == flash.system.IMEConversionMode.UNKNOWN)) 
                    {
                        flash.system.IME.conversionMode = _oldIMEMode;
                    }
                    flash.system.IME.enabled = false;
                }
            }
            return;
        }

        public function drawNow():void
        {
            draw();
            return;
        }

        public const version:String="3.0.3.1";

        public var focusTarget:fl.managers.IFocusManagerComponent;

        protected var isLivePreview:Boolean=false;

        internal var tempText:flash.text.TextField;

        protected var instanceStyles:Object;

        protected var sharedStyles:Object;

        protected var callLaterMethods:flash.utils.Dictionary;

        protected var invalidateFlag:Boolean=false;

        protected var _enabled:Boolean=true;

        protected var invalidHash:Object;

        protected var uiFocusRect:flash.display.DisplayObject;

        internal var _focusEnabled:Boolean=true;

        internal var _mouseFocusEnabled:Boolean=true;

        protected var _width:Number;

        protected var _height:Number;

        protected var _x:Number;

        protected var _y:Number;

        protected var startWidth:Number;

        protected var startHeight:Number;

        protected var _imeMode:String=null;

        protected var _oldIMEMode:String=null;

        protected var errorCaught:Boolean=false;

        protected var _inspector:Boolean=false;

        internal static var focusManagers:flash.utils.Dictionary;

        internal static var focusManagerUsers:flash.utils.Dictionary;

        protected var isFocused:Boolean=false;

        public static var inCallLaterPhase:Boolean=false;

        public static var createAccessibilityImplementation:Function;

        internal static var defaultStyles:Object;
    }
}


//    package data
//      class DataProvider
package fl.data 
{
    import fl.events.*;
    import flash.events.*;
    
    public class DataProvider extends flash.events.EventDispatcher
    {
        public function DataProvider(arg1:Object=null)
        {
            super();
            if (arg1 != null) 
            {
                data = getDataFromObject(arg1);
            }
            else 
            {
                data = [];
            }
            return;
        }

        public function get length():uint
        {
            return data.length;
        }

        public function invalidateItemAt(arg1:int):void
        {
            checkIndex(arg1, (data.length - 1));
            dispatchChangeEvent(fl.events.DataChangeType.INVALIDATE, [data[arg1]], arg1, arg1);
            return;
        }

        public function invalidateItem(arg1:Object):void
        {
            var loc1:*=getItemIndex(arg1);
            if (loc1 == -1) 
            {
                return;
            }
            invalidateItemAt(loc1);
            return;
        }

        public function invalidate():void
        {
            dispatchEvent(new fl.events.DataChangeEvent(fl.events.DataChangeEvent.DATA_CHANGE, fl.events.DataChangeType.INVALIDATE_ALL, data.concat(), 0, data.length));
            return;
        }

        public function addItemAt(arg1:Object, arg2:uint):void
        {
            checkIndex(arg2, data.length);
            dispatchPreChangeEvent(fl.events.DataChangeType.ADD, [arg1], arg2, arg2);
            data.splice(arg2, 0, arg1);
            dispatchChangeEvent(fl.events.DataChangeType.ADD, [arg1], arg2, arg2);
            return;
        }

        public function addItem(arg1:Object):void
        {
            dispatchPreChangeEvent(fl.events.DataChangeType.ADD, [arg1], (data.length - 1), (data.length - 1));
            data.push(arg1);
            dispatchChangeEvent(fl.events.DataChangeType.ADD, [arg1], (data.length - 1), (data.length - 1));
            return;
        }

        public function addItemsAt(arg1:Object, arg2:uint):void
        {
            checkIndex(arg2, data.length);
            var loc1:*=getDataFromObject(arg1);
            dispatchPreChangeEvent(fl.events.DataChangeType.ADD, loc1, arg2, (arg2 + loc1.length - 1));
            data.splice.apply(data, [arg2, 0].concat(loc1));
            dispatchChangeEvent(fl.events.DataChangeType.ADD, loc1, arg2, (arg2 + loc1.length - 1));
            return;
        }

        public function addItems(arg1:Object):void
        {
            addItemsAt(arg1, data.length);
            return;
        }

        public function concat(arg1:Object):void
        {
            addItems(arg1);
            return;
        }

        public function merge(arg1:Object):void
        {
            var loc5:*=null;
            var loc1:*=getDataFromObject(arg1);
            var loc2:*=loc1.length;
            var loc3:*=data.length;
            dispatchPreChangeEvent(fl.events.DataChangeType.ADD, data.slice(loc3, data.length), loc3, (this.data.length - 1));
            var loc4:*=0;
            while (loc4 < loc2) 
            {
                loc5 = loc1[loc4];
                if (getItemIndex(loc5) == -1) 
                {
                    data.push(loc5);
                }
                ++loc4;
            }
            if (data.length > loc3) 
            {
                dispatchChangeEvent(fl.events.DataChangeType.ADD, data.slice(loc3, data.length), loc3, (this.data.length - 1));
            }
            else 
            {
                dispatchChangeEvent(fl.events.DataChangeType.ADD, [], -1, -1);
            }
            return;
        }

        public function getItemAt(arg1:uint):Object
        {
            checkIndex(arg1, (data.length - 1));
            return data[arg1];
        }

        public function getItemIndex(arg1:Object):int
        {
            return data.indexOf(arg1);
        }

        public function removeItemAt(arg1:uint):Object
        {
            checkIndex(arg1, (data.length - 1));
            dispatchPreChangeEvent(fl.events.DataChangeType.REMOVE, data.slice(arg1, arg1 + 1), arg1, arg1);
            var loc1:*=data.splice(arg1, 1);
            dispatchChangeEvent(fl.events.DataChangeType.REMOVE, loc1, arg1, arg1);
            return loc1[0];
        }

        public function removeItem(arg1:Object):Object
        {
            var loc1:*=getItemIndex(arg1);
            if (loc1 != -1) 
            {
                return removeItemAt(loc1);
            }
            return null;
        }

        public function removeAll():void
        {
            var loc1:*=data.concat();
            dispatchPreChangeEvent(fl.events.DataChangeType.REMOVE_ALL, loc1, 0, loc1.length);
            data = [];
            dispatchChangeEvent(fl.events.DataChangeType.REMOVE_ALL, loc1, 0, loc1.length);
            return;
        }

        public function replaceItem(arg1:Object, arg2:Object):Object
        {
            var loc1:*=getItemIndex(arg2);
            if (loc1 != -1) 
            {
                return replaceItemAt(arg1, loc1);
            }
            return null;
        }

        public function replaceItemAt(arg1:Object, arg2:uint):Object
        {
            checkIndex(arg2, (data.length - 1));
            var loc1:*=[data[arg2]];
            dispatchPreChangeEvent(fl.events.DataChangeType.REPLACE, loc1, arg2, arg2);
            data[arg2] = arg1;
            dispatchChangeEvent(fl.events.DataChangeType.REPLACE, loc1, arg2, arg2);
            return loc1[0];
        }

        public function sort(... rest):*
        {
            dispatchPreChangeEvent(fl.events.DataChangeType.SORT, data.concat(), 0, (data.length - 1));
            var loc1:*=data.sort.apply(data, rest);
            dispatchChangeEvent(fl.events.DataChangeType.SORT, data.concat(), 0, (data.length - 1));
            return loc1;
        }

        public function sortOn(arg1:Object, arg2:Object=null):*
        {
            dispatchPreChangeEvent(fl.events.DataChangeType.SORT, data.concat(), 0, (data.length - 1));
            var loc1:*=data.sortOn(arg1, arg2);
            dispatchChangeEvent(fl.events.DataChangeType.SORT, data.concat(), 0, (data.length - 1));
            return loc1;
        }

        public function clone():fl.data.DataProvider
        {
            return new fl.data.DataProvider(data);
        }

        public function toArray():Array
        {
            return data.concat();
        }

        public override function toString():String
        {
            return "DataProvider [" + data.join(" , ") + "]";
        }

        protected function getDataFromObject(arg1:Object):Array
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=0;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=null;
            var loc7:*=null;
            var loc8:*=null;
            var loc9:*=null;
            var loc10:*=null;
            var loc11:*=null;
            if (arg1 is Array) 
            {
                loc2 = arg1 as Array;
                if (loc2.length > 0) 
                {
                    if (loc2[0] is String || loc2[0] is Number) 
                    {
                        loc1 = [];
                        loc3 = 0;
                        while (loc3 < loc2.length) 
                        {
                            loc4 = {"label":String(loc2[loc3]), "data":loc2[loc3]};
                            loc1.push(loc4);
                            ++loc3;
                        }
                        return loc1;
                    }
                }
                return arg1.concat();
            }
            if (arg1 is fl.data.DataProvider) 
            {
                return arg1.toArray();
            }
            if (arg1 is XML) 
            {
                loc5 = arg1 as XML;
                loc1 = [];
                loc6 = loc5.*;
                var loc12:*=0;
                var loc13:*=loc6;
                for each (loc7 in loc13) 
                {
                    arg1 = {};
                    loc8 = loc7.attributes();
                    var loc14:*=0;
                    var loc15:*=loc8;
                    for each (loc9 in loc15) 
                    {
                        arg1[loc9.localName()] = loc9.toString();
                    }
                    loc10 = loc7.*;
                    loc14 = 0;
                    loc15 = loc10;
                    for each (loc11 in loc15) 
                    {
                        if (!loc11.hasSimpleContent()) 
                        {
                            continue;
                        }
                        arg1[loc11.localName()] = loc11.toString();
                    }
                    loc1.push(arg1);
                }
                return loc1;
            }
            throw new TypeError("Error: Type Coercion failed: cannot convert " + arg1 + " to Array or DataProvider.");
        }

        protected function checkIndex(arg1:int, arg2:int):void
        {
            if (arg1 > arg2 || arg1 < 0) 
            {
                throw new RangeError("DataProvider index (" + arg1 + ") is not in acceptable range (0 - " + arg2 + ")");
            }
            return;
        }

        protected function dispatchChangeEvent(arg1:String, arg2:Array, arg3:int, arg4:int):void
        {
            dispatchEvent(new fl.events.DataChangeEvent(fl.events.DataChangeEvent.DATA_CHANGE, arg1, arg2, arg3, arg4));
            return;
        }

        protected function dispatchPreChangeEvent(arg1:String, arg2:Array, arg3:int, arg4:int):void
        {
            dispatchEvent(new fl.events.DataChangeEvent(fl.events.DataChangeEvent.PRE_DATA_CHANGE, arg1, arg2, arg3, arg4));
            return;
        }

        protected var data:Array;
    }
}


//      class SimpleCollectionItem
package fl.data 
{
    public dynamic class SimpleCollectionItem extends Object
    {
        public function SimpleCollectionItem()
        {
            super();
            return;
        }

        public function toString():String
        {
            return "[SimpleCollectionItem: " + label + "," + data + "]";
        }

        public var label:String;

        public var data:String;
    }
}


//      class TileListCollectionItem
package fl.data 
{
    public dynamic class TileListCollectionItem extends Object
    {
        public function TileListCollectionItem()
        {
            super();
            return;
        }

        public function toString():String
        {
            return "[TileListCollectionItem: " + label + "," + source + "]";
        }

        public var label:String;

        public var source:String;
    }
}


//    package display
//      class ProLoader
package fl.display 
{
    import fl.events.*;
    import flash.display.*;
    import flash.events.*;
    import flash.net.*;
    import flash.system.*;
    import flash.utils.*;
    
    public class ProLoader extends flash.display.Sprite
    {
        public function ProLoader()
        {
            super();
            this._loader = new flash.display.Loader();
            this._loader.contentLoaderInfo.sharedEvents.addEventListener(fl.events.ProLoaderRSLPreloaderSandboxEvent.PROLOADER_RSLPRELOADER_SANDBOX, this.handleProLoaderRSLPreloaderSandboxEvent, false, 0, true);
            super.addChild(this._loader);
            this._realContentLoader = null;
            this._cli = new fl.display.ProLoaderInfo(this);
            this._loading = false;
            this._hasRequestedContentParentProp = false;
            return;
        }

        internal function handleProLoaderRSLPreloaderSandboxEvent(arg1:Object):void
        {
            var e:Object;
            var content:flash.display.DisplayObjectContainer;

            var loc1:*;
            content = null;
            e = arg1;
            if (e.loaderInfo == null) 
            {
                if (!(e.shape == null) && flash.utils.getQualifiedClassName(e.shape) == "flash.display::Shape") 
                {
                    try 
                    {
                        content = e.shape.parent;
                        if (content != null) 
                        {
                            content.removeChild(e.shape);
                            if (super.numChildren < 2) 
                            {
                                super.addChild(content);
                            }
                        }
                    }
                    catch (se:SecurityError)
                    {
                    };
                }
            }
            else 
            {
                try 
                {
                    this._realContentLoader = e.loaderInfo.loader;
                }
                catch (se:SecurityError)
                {
                    _realContentLoader = null;
                }
                this._cli.realContentLoaderInfo = e.loaderInfo;
            }
            return;
        }

        function loadDoneCallback(arg1:flash.display.DisplayObject):Boolean
        {
            var d:flash.display.DisplayObject;
            var p:flash.display.DisplayObjectContainer;

            var loc1:*;
            p = null;
            d = arg1;
            if (!this._loading) 
            {
                this._loader.unload();
                return false;
            }
            this._loading = false;
            if (d != null) 
            {
                try 
                {
                    if (this._cli.realContentLoaderInfo != null) 
                    {
                        if (this._hasRequestedContentParentProp) 
                        {
                            if (d.parent == this) 
                            {
                                while (super.numChildren > 2) 
                                {
                                    super.removeChildAt(1);
                                }
                            }
                        }
                        else 
                        {
                            super.addChild(d);
                        }
                    }
                    else if (d.loaderInfo.loader == this._loader) 
                    {
                        if (!this._hasRequestedContentParentProp || this._cli._lcRequestedContentParentSet && !(d.parent == this)) 
                        {
                            super.addChild(d);
                        }
                    }
                    else 
                    {
                        this._realContentLoader = d.loaderInfo.loader;
                        this._cli.realContentLoaderInfo = this._realContentLoader.contentLoaderInfo;
                        if (this._hasRequestedContentParentProp) 
                        {
                            p = this._loader.content.parent as flash.display.DisplayObjectContainer;
                            if (p == this || p == null) 
                            {
                                while (super.numChildren > 1) 
                                {
                                    super.removeChildAt(1);
                                }
                                super.addChild(d);
                            }
                            else 
                            {
                                p.addChildAt(d, p.getChildIndex(this._loader.content));
                                p.removeChild(this._loader.content);
                            }
                        }
                        else 
                        {
                            super.addChild(d);
                        }
                    }
                }
                catch (se:SecurityError)
                {
                };
            }
            return true;
        }

        public function get realLoader():flash.display.Loader
        {
            return this._loader.contentLoaderInfo.loader;
        }

        public function get realContentLoader():flash.display.Loader
        {
            return this._realContentLoader != null ? this._realContentLoader.contentLoaderInfo.loader : null;
        }

        public function get content():flash.display.DisplayObject
        {
            if (super.numChildren > 1) 
            {
                return super.getChildAt(1);
            }
            if (this._realContentLoader) 
            {
                return this._realContentLoader.content;
            }
            return this._loader.content;
        }

        public function get contentLoaderInfo():fl.display.ProLoaderInfo
        {
            return this._cli;
        }

        public function close():void
        {
            var loc1:*;
            if (this._loading) 
            {
                this._loading = false;
                try 
                {
                    this._loader.close();
                }
                catch (err:Error)
                {
                };
            }
            else 
            {
                this._loader.close();
            }
            return;
        }

        public function load(arg1:flash.net.URLRequest, arg2:flash.system.LoaderContext=null):void
        {
            var loc1:*=null;
            while (super.numChildren > 1) 
            {
                super.removeChildAt(1);
            }
            this._realContentLoader = null;
            this._hasRequestedContentParentProp = false;
            this._cli.reset();
            if (arg2 == null) 
            {
                arg2 = new flash.system.LoaderContext();
            }
            if (arg2.hasOwnProperty("requestedContentParent")) 
            {
                this._hasRequestedContentParentProp = true;
                loc1 = arg2["requestedContentParent"];
                if (loc1 == null) 
                {
                    arg2["requestedContentParent"] = this;
                    this._cli._lcRequestedContentParentSet = true;
                }
            }
            this._loader.load(arg1, arg2);
            this._loading = true;
            return;
        }

        public function loadBytes(arg1:flash.utils.ByteArray, arg2:flash.system.LoaderContext=null):void
        {
            var loc1:*=null;
            while (super.numChildren > 1) 
            {
                super.removeChildAt(1);
            }
            this._realContentLoader = null;
            this._hasRequestedContentParentProp = false;
            this._cli.reset();
            if (arg2 == null) 
            {
                arg2 = new flash.system.LoaderContext();
            }
            if (arg2.hasOwnProperty("requestedContentParent")) 
            {
                this._hasRequestedContentParentProp = true;
                loc1 = arg2["requestedContentParent"];
                if (loc1 == null) 
                {
                    arg2["requestedContentParent"] = this;
                    this._cli._lcRequestedContentParentSet = true;
                }
            }
            this._loader.loadBytes(arg1, arg2);
            this._loading = true;
            return;
        }

        public function loadFilePromise(arg1:Object, arg2:flash.system.LoaderContext=null):void
        {
            var loc1:*=null;
            while (super.numChildren > 1) 
            {
                super.removeChildAt(1);
            }
            this._realContentLoader = null;
            this._hasRequestedContentParentProp = false;
            this._cli.reset();
            if (arg2 == null) 
            {
                arg2 = new flash.system.LoaderContext();
            }
            if (arg2.hasOwnProperty("requestedContentParent")) 
            {
                this._hasRequestedContentParentProp = true;
                loc1 = arg2["requestedContentParent"];
                if (loc1 == null) 
                {
                    arg2["requestedContentParent"] = this;
                    this._cli._lcRequestedContentParentSet = true;
                }
            }
            var loc2:*;
            (loc2 = this._loader)["loadFilePromise"](arg1, arg2);
            this._loading = true;
            return;
        }

        public function unload():void
        {
            if (!this._loading) 
            {
                while (super.numChildren > 1) 
                {
                    super.removeChildAt(1);
                }
                this._loader.unload();
            }
            return;
        }

        public function unloadAndStop(arg1:Boolean=true):void
        {
            if (!this._loading) 
            {
                while (super.numChildren > 1) 
                {
                    super.removeChildAt(1);
                }
                var loc1:*;
                (loc1 = this._loader)["unloadAndStop"](arg1);
            }
            return;
        }

        public override function addChild(arg1:flash.display.DisplayObject):flash.display.DisplayObject
        {
            if (!(this._realContentLoader == null) && this._realContentLoader.content == arg1 || this._loader.content == arg1) 
            {
                return super.addChild(arg1);
            }
            throw new Error("Error #2069: The ProLoader class does not implement this method.");
        }

        public override function addChildAt(arg1:flash.display.DisplayObject, arg2:int):flash.display.DisplayObject
        {
            throw new Error("Error #2069: The ProLoader class does not implement this method.");
        }

        public override function removeChild(arg1:flash.display.DisplayObject):flash.display.DisplayObject
        {
            throw new Error("Error #2069: The ProLoader class does not implement this method.");
        }

        public override function removeChildAt(arg1:int):flash.display.DisplayObject
        {
            throw new Error("Error #2069: The ProLoader class does not implement this method.");
        }

        public override function setChildIndex(arg1:flash.display.DisplayObject, arg2:int):void
        {
            throw new Error("Error #2069: The ProLoader class does not implement this method.");
        }

        public override function get numChildren():int
        {
            return (super.numChildren - 1);
        }

        public override function getChildAt(arg1:int):flash.display.DisplayObject
        {
            if (arg1 >= 0) 
            {
                ++arg1;
            }
            return super.getChildAt(arg1);
        }

        public override function getChildIndex(arg1:flash.display.DisplayObject):int
        {
            return (super.getChildIndex(arg1) - 1);
        }

        public function get uncaughtErrorEvents():flash.events.EventDispatcher
        {
            return this._loader["uncaughtErrorEvents"];
        }

        internal var _cli:fl.display.ProLoaderInfo;

        internal var _loader:flash.display.Loader;

        internal var _realContentLoader:flash.display.Loader;

        internal var _loading:Boolean;

        internal var _hasRequestedContentParentProp:Boolean;
    }
}


//      class ProLoaderInfo
package fl.display 
{
    import flash.display.*;
    import flash.errors.*;
    import flash.events.*;
    import flash.system.*;
    import flash.utils.*;
    
    public class ProLoaderInfo extends flash.events.EventDispatcher
    {
        public function ProLoaderInfo(arg1:fl.display.ProLoader)
        {
            super();
            this._realContentLI = null;
            this._lcRequestedContentParentSet = false;
            this._rslPreloaderLoaded = false;
            this._doneProgressStalling = false;
            this._numAdded = 0;
            this._proLoader = arg1;
            this._realLI = arg1.realLoader.contentLoaderInfo;
            this._realLI.addEventListener(flash.events.AsyncErrorEvent.ASYNC_ERROR, this.handleAsyncErrorEvent, false, 0, true);
            this._realLI.addEventListener(flash.events.Event.COMPLETE, this.handleLoaderInfoEvent, false, 0, true);
            this._realLI.addEventListener(flash.events.HTTPStatusEvent.HTTP_STATUS, this.handleLoaderInfoEvent, false, 0, true);
            this._realLI.addEventListener(flash.events.Event.INIT, this.handleLoaderInfoEvent, false, 0, true);
            this._realLI.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.handleLoaderInfoEvent, false, 0, true);
            this._realLI.addEventListener(flash.events.Event.OPEN, this.handleLoaderInfoEvent, false, 0, true);
            this._realLI.addEventListener(flash.events.ProgressEvent.PROGRESS, this.handleProgressEvent, false, 0, true);
            this._realLI.addEventListener(flash.events.SecurityErrorEvent.SECURITY_ERROR, this.handleSecurityErrorEvent, false, 0, true);
            this._realLI.addEventListener(flash.events.Event.UNLOAD, this.handleLoaderInfoEvent, false, 0, true);
            return;
        }

        internal function handleLoaderInfoEvent(arg1:flash.events.Event):void
        {
            var e:flash.events.Event;
            var theContent:flash.display.DisplayObject;
            var theName:String;
            var rslPreloader:Object;

            var loc1:*;
            theContent = null;
            theName = null;
            rslPreloader = null;
            e = arg1;
            var loc2:*=e.type;
            switch (loc2) 
            {
                case flash.events.HTTPStatusEvent.HTTP_STATUS:
                case flash.events.IOErrorEvent.IO_ERROR:
                case flash.events.Event.OPEN:
                case flash.events.Event.UNLOAD:
                {
                    super.dispatchEvent(e);
                    break;
                }
                case flash.events.Event.INIT:
                {
                    if (!this._rslPreloaderLoaded) 
                    {
                        try 
                        {
                            theContent = this._realLI.content;
                            theName = flash.utils.getQualifiedClassName(theContent);
                            if (theName.substr(-13) == "__Preloader__") 
                            {
                                rslPreloader = theContent["__rslPreloader"];
                                if (rslPreloader != null) 
                                {
                                    theName = flash.utils.getQualifiedClassName(rslPreloader);
                                    if (theName == "fl.rsl::RSLPreloader") 
                                    {
                                        this._rslPreloaderLoaded = true;
                                        this._numAdded = 0;
                                        theContent.addEventListener(flash.events.Event.ADDED, this.handleAddedEvent, false, 0, true);
                                    }
                                }
                            }
                        }
                        catch (err:Error)
                        {
                            _rslPreloaderLoaded = false;
                        }
                    }
                    if (!this._rslPreloaderLoaded) 
                    {
                        this._proLoader.loadDoneCallback(theContent);
                        if (!this._doneProgressStalling && this._realLI.bytesLoaded >= this._realLI.bytesTotal) 
                        {
                            this._doneProgressStalling = true;
                            super.dispatchEvent(new flash.events.ProgressEvent(flash.events.ProgressEvent.PROGRESS, false, false, this._realLI.bytesLoaded, this._realLI.bytesTotal));
                        }
                        super.dispatchEvent(e);
                    }
                    break;
                }
                case flash.events.Event.COMPLETE:
                {
                    if (!this._rslPreloaderLoaded) 
                    {
                        super.dispatchEvent(e);
                    }
                    break;
                }
            }
            return;
        }

        internal function handleProgressEvent(arg1:flash.events.ProgressEvent):void
        {
            if (this._doneProgressStalling || arg1.bytesLoaded < arg1.bytesTotal) 
            {
                super.dispatchEvent(arg1);
            }
            return;
        }

        internal function handleSecurityErrorEvent(arg1:flash.events.SecurityErrorEvent):void
        {
            if (!this._lcRequestedContentParentSet || !(arg1.errorID == 2047)) 
            {
                super.dispatchEvent(arg1);
            }
            return;
        }

        internal function handleAddedEvent(arg1:flash.events.Event):void
        {
            var loc1:*=arg1.target as flash.display.DisplayObject;
            var loc2:*=arg1.currentTarget as flash.display.DisplayObjectContainer;
            if (!(loc1 == null) && !(loc2 == null) && loc1.parent == loc2) 
            {
                var loc3:*;
                var loc4:*=((loc3 = this)._numAdded + 1);
                loc3._numAdded = loc4;
            }
            if (this._numAdded > 1) 
            {
                arg1.currentTarget.removeEventListener(flash.events.Event.ADDED, this.handleAddedEvent);
                if (this._proLoader.loadDoneCallback(loc1)) 
                {
                    if (!this._doneProgressStalling && this._realLI.bytesLoaded >= this._realLI.bytesTotal) 
                    {
                        this._doneProgressStalling = true;
                        super.dispatchEvent(new flash.events.ProgressEvent(flash.events.ProgressEvent.PROGRESS, false, false, this._realLI.bytesLoaded, this._realLI.bytesTotal));
                    }
                    super.dispatchEvent(new flash.events.Event(flash.events.Event.INIT, false, false));
                    super.dispatchEvent(new flash.events.Event(flash.events.Event.COMPLETE, false, false));
                }
            }
            return;
        }

        public function get applicationDomain():flash.system.ApplicationDomain
        {
            return this._realLI.applicationDomain;
        }

        function set realContentLoaderInfo(arg1:flash.display.LoaderInfo):void
        {
            var value:flash.display.LoaderInfo;
            var obj:Object;

            var loc1:*;
            obj = null;
            value = arg1;
            this._realContentLI = value;
            this._realContentLI.addEventListener(flash.events.Event.COMPLETE, this.handleRealContentEvent, false, 0, true);
            this._realContentLI.addEventListener(flash.events.Event.INIT, this.handleRealContentEvent, false, 0, true);
            this._realContentLI.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.handleLoaderInfoEvent, false, 0, true);
            this._realContentLI.addEventListener(flash.events.SecurityErrorEvent.SECURITY_ERROR, this.handleSecurityErrorEvent, false, 0, true);
            this._rslPreloaderLoaded = true;
            if (this._realContentLI.hasOwnProperty("childSandboxBridge")) 
            {
                try 
                {
                    obj = this._realLI["childSandboxBridge"];
                    if (obj != null) 
                    {
                        this._realContentLI["childSandboxBridge"] = obj;
                    }
                }
                catch (se:SecurityError)
                {
                };
                try 
                {
                    obj = this._realLI["parentSandboxBridge"];
                    if (obj != null) 
                    {
                        this._realContentLI["parentSandboxBridge"] = obj;
                    }
                }
                catch (se:SecurityError)
                {
                };
            }
            return;
        }

        function get realContentLoaderInfo():flash.display.LoaderInfo
        {
            return this._realContentLI;
        }

        function reset():void
        {
            this._realContentLI = null;
            this._rslPreloaderLoaded = false;
            this._doneProgressStalling = false;
            this._lcRequestedContentParentSet = false;
            return;
        }

        public function get actionScriptVersion():uint
        {
            return this._realLI.actionScriptVersion;
        }

        internal function handleRealContentEvent(arg1:flash.events.Event):void
        {
            var e:flash.events.Event;
            var d:flash.display.DisplayObject;

            var loc1:*;
            d = null;
            e = arg1;
            if (e.type == flash.events.Event.INIT) 
            {
                try 
                {
                    d = this._realContentLI.content;
                }
                catch (se:SecurityError)
                {
                    d = null;
                }
                this._proLoader.loadDoneCallback(d);
                if (!this._doneProgressStalling && this._realLI.bytesLoaded >= this._realLI.bytesTotal) 
                {
                    this._doneProgressStalling = true;
                    super.dispatchEvent(new flash.events.ProgressEvent(flash.events.ProgressEvent.PROGRESS, false, false, this._realLI.bytesLoaded, this._realLI.bytesTotal));
                }
            }
            super.dispatchEvent(e);
            return;
        }

        public function get bytes():flash.utils.ByteArray
        {
            return this._realLI.bytes;
        }

        public function get bytesLoaded():uint
        {
            if (this._realLI.bytesLoaded >= this._realLI.bytesTotal && this._proLoader.content == null) 
            {
                return (this._realLI.bytesTotal - 1);
            }
            return this._realLI.bytesLoaded;
        }

        public function get bytesTotal():uint
        {
            return this._realLI.bytesTotal;
        }

        public function get childAllowsParent():Boolean
        {
            return this._realLI.childAllowsParent;
        }

        public function get childSandboxBridge():Object
        {
            if (this._realContentLI != null) 
            {
                return this._realContentLI["childSandboxBridge"];
            }
            return this._realLI["childSandboxBridge"];
        }

        public function set childSandboxBridge(arg1:Object):void
        {
            if (this._realContentLI == null) 
            {
                this._realLI["childSandboxBridge"] = arg1;
            }
            else 
            {
                this._realContentLI["childSandboxBridge"] = arg1;
            }
            return;
        }

        public function get content():flash.display.DisplayObject
        {
            return this._proLoader.content;
        }

        public function get contentType():String
        {
            return this._realLI.contentType;
        }

        public function get frameRate():Number
        {
            return this._realLI.frameRate;
        }

        public function get height():int
        {
            return this._realLI.height;
        }

        public function get isURLInaccessible():Boolean
        {
            return this._realLI.isURLInaccessible;
        }

        public function get loader():fl.display.ProLoader
        {
            return this._proLoader;
        }

        public function get loaderURL():String
        {
            return this._realLI.loaderURL;
        }

        public function get parameters():Object
        {
            return this._realLI.parameters;
        }

        public function get parentAllowsChild():Boolean
        {
            return this._realLI.parentAllowsChild;
        }

        public function get parentSandboxBridge():Object
        {
            if (this._realContentLI != null) 
            {
                return this._realContentLI["parentSandboxBridge"];
            }
            return this._realLI["parentSandboxBridge"];
        }

        public function set parentSandboxBridge(arg1:Object):*
        {
            if (this._realContentLI == null) 
            {
                this._realLI["parentSandboxBridge"] = arg1;
            }
            else 
            {
                this._realContentLI["parentSandboxBridge"] = arg1;
            }
            return;
        }

        public function get sameDomain():Boolean
        {
            return this._realLI.sameDomain;
        }

        public function get sharedEvents():flash.events.EventDispatcher
        {
            if (this._realContentLI != null) 
            {
                return this._realContentLI.sharedEvents;
            }
            return this._realLI.sharedEvents;
        }

        public function get swfVersion():uint
        {
            return this._realLI.swfVersion;
        }

        public function get url():String
        {
            return this._realLI.url;
        }

        public function get width():int
        {
            return this._realLI.width;
        }

        public override function dispatchEvent(arg1:flash.events.Event):Boolean
        {
            Error.throwError(flash.errors.IllegalOperationError, 2118);
            return false;
        }

        internal function handleAsyncErrorEvent(arg1:flash.events.AsyncErrorEvent):void
        {
            if (!this._lcRequestedContentParentSet) 
            {
                super.dispatchEvent(arg1);
            }
            return;
        }

        internal var _proLoader:fl.display.ProLoader;

        internal var _realLI:flash.display.LoaderInfo;

        internal var _realContentLI:flash.display.LoaderInfo;

        internal var _rslPreloaderLoaded:Boolean;

        internal var _numAdded:int;

        var _lcRequestedContentParentSet:Boolean;

        internal var _doneProgressStalling:Boolean;
    }
}


//    package events
//      class ComponentEvent
package fl.events 
{
    import flash.events.*;
    
    public class ComponentEvent extends flash.events.Event
    {
        public function ComponentEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function toString():String
        {
            return formatToString("ComponentEvent", "type", "bubbles", "cancelable");
        }

        public override function clone():flash.events.Event
        {
            return new fl.events.ComponentEvent(type, bubbles, cancelable);
        }

        public static const BUTTON_DOWN:String="buttonDown";

        public static const LABEL_CHANGE:String="labelChange";

        public static const HIDE:String="hide";

        public static const SHOW:String="show";

        public static const RESIZE:String="resize";

        public static const MOVE:String="move";

        public static const ENTER:String="enter";
    }
}


//      class DataChangeEvent
package fl.events 
{
    import flash.events.*;
    
    public class DataChangeEvent extends flash.events.Event
    {
        public function DataChangeEvent(arg1:String, arg2:String, arg3:Array, arg4:int=-1, arg5:int=-1)
        {
            super(arg1);
            _changeType = arg2;
            _startIndex = arg4;
            _items = arg3;
            _endIndex = arg5 != -1 ? arg5 : _startIndex;
            return;
        }

        public function get changeType():String
        {
            return _changeType;
        }

        public function get items():Array
        {
            return _items;
        }

        public function get startIndex():uint
        {
            return _startIndex;
        }

        public function get endIndex():uint
        {
            return _endIndex;
        }

        public override function toString():String
        {
            return formatToString("DataChangeEvent", "type", "changeType", "startIndex", "endIndex", "bubbles", "cancelable");
        }

        public override function clone():flash.events.Event
        {
            return new fl.events.DataChangeEvent(type, _changeType, _items, _startIndex, _endIndex);
        }

        public static const DATA_CHANGE:String="dataChange";

        public static const PRE_DATA_CHANGE:String="preDataChange";

        protected var _startIndex:uint;

        protected var _endIndex:uint;

        protected var _changeType:String;

        protected var _items:Array;
    }
}


//      class DataChangeType
package fl.events 
{
    public class DataChangeType extends Object
    {
        public function DataChangeType()
        {
            super();
            return;
        }

        public static const CHANGE:String="change";

        public static const INVALIDATE:String="invalidate";

        public static const INVALIDATE_ALL:String="invalidateAll";

        public static const ADD:String="add";

        public static const REMOVE:String="remove";

        public static const REMOVE_ALL:String="removeAll";

        public static const REPLACE:String="replace";

        public static const SORT:String="sort";
    }
}


//      class ListEvent
package fl.events 
{
    import flash.events.*;
    
    public class ListEvent extends flash.events.Event
    {
        public function ListEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false, arg4:int=-1, arg5:int=-1, arg6:int=-1, arg7:Object=null)
        {
            super(arg1, arg2, arg3);
            _rowIndex = arg5;
            _columnIndex = arg4;
            _index = arg6;
            _item = arg7;
            return;
        }

        public function get rowIndex():Object
        {
            return _rowIndex;
        }

        public function get columnIndex():int
        {
            return _columnIndex;
        }

        public function get index():int
        {
            return _index;
        }

        public function get item():Object
        {
            return _item;
        }

        public override function toString():String
        {
            return formatToString("ListEvent", "type", "bubbles", "cancelable", "columnIndex", "rowIndex", "index", "item");
        }

        public override function clone():flash.events.Event
        {
            return new fl.events.ListEvent(type, bubbles, cancelable, _columnIndex, _rowIndex);
        }

        public static const ITEM_ROLL_OUT:String="itemRollOut";

        public static const ITEM_ROLL_OVER:String="itemRollOver";

        public static const ITEM_CLICK:String="itemClick";

        public static const ITEM_DOUBLE_CLICK:String="itemDoubleClick";

        protected var _rowIndex:int;

        protected var _columnIndex:int;

        protected var _index:int;

        protected var _item:Object;
    }
}


//      class ProLoaderRSLPreloaderSandboxEvent
package fl.events 
{
    import flash.display.*;
    import flash.events.*;
    
    public class ProLoaderRSLPreloaderSandboxEvent extends flash.events.Event
    {
        public function ProLoaderRSLPreloaderSandboxEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false, arg4:flash.display.LoaderInfo=null, arg5:flash.display.Shape=null)
        {
            super(arg1, arg2, arg3);
            this.loaderInfo = arg4;
            this.shape = arg5;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new fl.events.ProLoaderRSLPreloaderSandboxEvent(type, bubbles, cancelable, this.loaderInfo, this.shape);
        }

        public override function toString():String
        {
            return formatToString("ProLoaderRSLPreloaderSandboxEvent", "type", "bubbles", "cancelable", "eventPhase", "loaderInfo", "shape");
        }

        public static const PROLOADER_RSLPRELOADER_SANDBOX:String="__proLoaderRSLPreloaderSandbox";

        public var loaderInfo:flash.display.LoaderInfo;

        public var shape:flash.display.Shape;
    }
}


//      class ScrollEvent
package fl.events 
{
    import flash.events.*;
    
    public class ScrollEvent extends flash.events.Event
    {
        public function ScrollEvent(arg1:String, arg2:Number, arg3:Number)
        {
            super(fl.events.ScrollEvent.SCROLL, false, false);
            _direction = arg1;
            _delta = arg2;
            _position = arg3;
            return;
        }

        public function get direction():String
        {
            return _direction;
        }

        public function get delta():Number
        {
            return _delta;
        }

        public function get position():Number
        {
            return _position;
        }

        public override function toString():String
        {
            return formatToString("ScrollEvent", "type", "bubbles", "cancelable", "direction", "delta", "position");
        }

        public override function clone():flash.events.Event
        {
            return new fl.events.ScrollEvent(_direction, _delta, _position);
        }

        public static const SCROLL:String="scroll";

        internal var _direction:String;

        internal var _delta:Number;

        internal var _position:Number;
    }
}


//    package managers
//      class FocusManager
package fl.managers 
{
    import fl.controls.*;
    import fl.core.*;
    import flash.display.*;
    import flash.events.*;
    import flash.text.*;
    import flash.ui.*;
    import flash.utils.*;
    
    public class FocusManager extends Object implements fl.managers.IFocusManager
    {
        public function FocusManager(arg1:flash.display.DisplayObjectContainer)
        {
            super();
            focusableObjects = new flash.utils.Dictionary(true);
            if (arg1 != null) 
            {
                _form = arg1;
                activate();
            }
            return;
        }

        public function get nextTabIndex():int
        {
            return 0;
        }

        public function get showFocusIndicator():Boolean
        {
            return _showFocusIndicator;
        }

        public function set showFocusIndicator(arg1:Boolean):void
        {
            _showFocusIndicator = arg1;
            return;
        }

        public function get form():flash.display.DisplayObjectContainer
        {
            return _form;
        }

        public function set form(arg1:flash.display.DisplayObjectContainer):void
        {
            _form = arg1;
            return;
        }

        public function getFocus():flash.display.InteractiveObject
        {
            var loc1:*=form.stage.focus;
            return findFocusManagerComponent(loc1);
        }

        internal function addFocusables(arg1:flash.display.DisplayObject, arg2:Boolean=false):void
        {
            var o:flash.display.DisplayObject;
            var skipTopLevel:Boolean=false;
            var focusable:fl.managers.IFocusManagerComponent;
            var io:flash.display.InteractiveObject;
            var doc:flash.display.DisplayObjectContainer;
            var docParent:flash.display.DisplayObjectContainer;
            var i:int;
            var child:flash.display.DisplayObject;

            var loc1:*;
            focusable = null;
            io = null;
            doc = null;
            docParent = null;
            i = 0;
            child = null;
            o = arg1;
            skipTopLevel = arg2;
            if (!skipTopLevel) 
            {
                if (o is fl.managers.IFocusManagerComponent) 
                {
                    focusable = fl.managers.IFocusManagerComponent(o);
                    if (focusable.focusEnabled) 
                    {
                        if (focusable.tabEnabled && isTabVisible(o)) 
                        {
                            focusableObjects[o] = true;
                            calculateCandidates = true;
                        }
                        o.addEventListener(flash.events.Event.TAB_ENABLED_CHANGE, tabEnabledChangeHandler, false, 0, true);
                        o.addEventListener(flash.events.Event.TAB_INDEX_CHANGE, tabIndexChangeHandler, false, 0, true);
                    }
                }
                else if (o is flash.display.InteractiveObject) 
                {
                    io = o as flash.display.InteractiveObject;
                    if (io && io.tabEnabled && findFocusManagerComponent(io) == io) 
                    {
                        focusableObjects[io] = true;
                        calculateCandidates = true;
                    }
                    io.addEventListener(flash.events.Event.TAB_ENABLED_CHANGE, tabEnabledChangeHandler, false, 0, true);
                    io.addEventListener(flash.events.Event.TAB_INDEX_CHANGE, tabIndexChangeHandler, false, 0, true);
                }
            }
            if (o is flash.display.DisplayObjectContainer) 
            {
                doc = flash.display.DisplayObjectContainer(o);
                o.addEventListener(flash.events.Event.TAB_CHILDREN_CHANGE, tabChildrenChangeHandler, false, 0, true);
                docParent = null;
                try 
                {
                    docParent = doc.parent;
                }
                catch (se:SecurityError)
                {
                    docParent = null;
                }
                if (doc is flash.display.Stage || docParent is flash.display.Stage || doc.tabChildren) 
                {
                    i = 0;
                    while (i < doc.numChildren) 
                    {
                        try 
                        {
                            child = doc.getChildAt(i);
                            if (child != null) 
                            {
                                addFocusables(doc.getChildAt(i));
                            }
                        }
                        catch (error:SecurityError)
                        {
                        };
                        ++i;
                    }
                }
            }
            return;
        }

        public function setFocus(arg1:flash.display.InteractiveObject):void
        {
            if (arg1 is fl.managers.IFocusManagerComponent) 
            {
                fl.managers.IFocusManagerComponent(arg1).setFocus();
            }
            else 
            {
                form.stage.focus = arg1;
            }
            return;
        }

        public function showFocus():void
        {
            return;
        }

        public function hideFocus():void
        {
            return;
        }

        public function findFocusManagerComponent(arg1:flash.display.InteractiveObject):flash.display.InteractiveObject
        {
            var component:flash.display.InteractiveObject;
            var p:flash.display.InteractiveObject;

            var loc1:*;
            component = arg1;
            p = component;
            try 
            {
                while (component) 
                {
                    if (component is fl.managers.IFocusManagerComponent && fl.managers.IFocusManagerComponent(component).focusEnabled) 
                    {
                        return component;
                    }
                    component = component.parent;
                }
            }
            catch (se:SecurityError)
            {
            };
            return p;
        }

        internal function addedHandler(arg1:flash.events.Event):void
        {
            var loc1:*=flash.display.DisplayObject(arg1.target);
            if (loc1.stage) 
            {
                addFocusables(flash.display.DisplayObject(arg1.target));
            }
            return;
        }

        internal function removedHandler(arg1:flash.events.Event):void
        {
            var loc1:*=0;
            var loc3:*=null;
            var loc2:*=flash.display.DisplayObject(arg1.target);
            if (loc2 is fl.managers.IFocusManagerComponent && focusableObjects[loc2] == true) 
            {
                if (loc2 == lastFocus) 
                {
                    fl.managers.IFocusManagerComponent(lastFocus).drawFocus(false);
                    lastFocus = null;
                }
                loc2.removeEventListener(flash.events.Event.TAB_ENABLED_CHANGE, tabEnabledChangeHandler, false);
                delete focusableObjects[loc2];
                calculateCandidates = true;
            }
            else if (loc2 is flash.display.InteractiveObject && focusableObjects[loc2] == true) 
            {
                if (loc3 = loc2 as flash.display.InteractiveObject) 
                {
                    if (loc3 == lastFocus) 
                    {
                        lastFocus = null;
                    }
                    delete focusableObjects[loc3];
                    calculateCandidates = true;
                }
                loc2.addEventListener(flash.events.Event.TAB_ENABLED_CHANGE, tabEnabledChangeHandler, false, 0, true);
            }
            removeFocusables(loc2);
            return;
        }

        internal function getTopLevelFocusTarget(arg1:flash.display.InteractiveObject):flash.display.InteractiveObject
        {
            var o:flash.display.InteractiveObject;

            var loc1:*;
            o = arg1;
            try 
            {
                while (o != flash.display.InteractiveObject(form)) 
                {
                    if (o is fl.managers.IFocusManagerComponent && fl.managers.IFocusManagerComponent(o).focusEnabled && fl.managers.IFocusManagerComponent(o).mouseFocusEnabled && fl.core.UIComponent(o).enabled) 
                    {
                        return o;
                    }
                    o = o.parent;
                    if (o != null) 
                    {
                        continue;
                    }
                }
            }
            catch (se:SecurityError)
            {
            };
            return null;
        }

        internal function removeFocusables(arg1:flash.display.DisplayObject):void
        {
            var loc1:*=null;
            var loc2:*=null;
            if (arg1 is flash.display.DisplayObjectContainer) 
            {
                arg1.removeEventListener(flash.events.Event.TAB_CHILDREN_CHANGE, tabChildrenChangeHandler, false);
                arg1.removeEventListener(flash.events.Event.TAB_INDEX_CHANGE, tabIndexChangeHandler, false);
                var loc3:*=0;
                var loc4:*=focusableObjects;
                for (loc1 in loc4) 
                {
                    loc2 = flash.display.DisplayObject(loc1);
                    if (!flash.display.DisplayObjectContainer(arg1).contains(loc2)) 
                    {
                        continue;
                    }
                    if (loc2 == lastFocus) 
                    {
                        lastFocus = null;
                    }
                    loc2.removeEventListener(flash.events.Event.TAB_ENABLED_CHANGE, tabEnabledChangeHandler, false);
                    delete focusableObjects[loc1];
                    calculateCandidates = true;
                }
            }
            return;
        }

        internal function isTabVisible(arg1:flash.display.DisplayObject):Boolean
        {
            var o:flash.display.DisplayObject;
            var p:flash.display.DisplayObjectContainer;

            var loc1:*;
            p = null;
            o = arg1;
            try 
            {
                p = o.parent;
                while (p && !(p is flash.display.Stage) && !(p.parent && p.parent is flash.display.Stage)) 
                {
                    if (!p.tabChildren) 
                    {
                        return false;
                    }
                    p = p.parent;
                }
            }
            catch (se:SecurityError)
            {
            };
            return true;
        }

        internal function isValidFocusCandidate(arg1:flash.display.DisplayObject, arg2:String):Boolean
        {
            var loc1:*=null;
            if (!isEnabledAndVisible(arg1)) 
            {
                return false;
            }
            if (arg1 is fl.managers.IFocusManagerGroup) 
            {
                loc1 = fl.managers.IFocusManagerGroup(arg1);
                if (arg2 == loc1.groupName) 
                {
                    return false;
                }
            }
            return true;
        }

        internal function isEnabledAndVisible(arg1:flash.display.DisplayObject):Boolean
        {
            var o:flash.display.DisplayObject;
            var formParent:flash.display.DisplayObjectContainer;
            var tf:flash.text.TextField;
            var sb:flash.display.SimpleButton;

            var loc1:*;
            formParent = null;
            tf = null;
            sb = null;
            o = arg1;
            try 
            {
                formParent = flash.display.DisplayObject(form).parent;
                while (o != formParent) 
                {
                    if (o is fl.core.UIComponent) 
                    {
                        if (!fl.core.UIComponent(o).enabled) 
                        {
                            return false;
                        }
                    }
                    else if (o is flash.text.TextField) 
                    {
                        tf = flash.text.TextField(o);
                        if (tf.type == flash.text.TextFieldType.DYNAMIC || !tf.selectable) 
                        {
                            return false;
                        }
                    }
                    else if (o is flash.display.SimpleButton) 
                    {
                        sb = flash.display.SimpleButton(o);
                        if (!sb.enabled) 
                        {
                            return false;
                        }
                    }
                    if (!o.visible) 
                    {
                        return false;
                    }
                    o = o.parent;
                }
            }
            catch (se:SecurityError)
            {
            };
            return true;
        }

        internal function tabEnabledChangeHandler(arg1:flash.events.Event):void
        {
            calculateCandidates = true;
            var loc1:*=flash.display.InteractiveObject(arg1.target);
            var loc2:*=focusableObjects[loc1] == true;
            if (loc1.tabEnabled) 
            {
                if (!loc2 && isTabVisible(loc1)) 
                {
                    if (!(loc1 is fl.managers.IFocusManagerComponent)) 
                    {
                        loc1.focusRect = false;
                    }
                    focusableObjects[loc1] = true;
                }
            }
            else if (loc2) 
            {
                delete focusableObjects[loc1];
            }
            return;
        }

        internal function tabIndexChangeHandler(arg1:flash.events.Event):void
        {
            calculateCandidates = true;
            return;
        }

        internal function tabChildrenChangeHandler(arg1:flash.events.Event):void
        {
            if (arg1.target != arg1.currentTarget) 
            {
                return;
            }
            calculateCandidates = true;
            var loc1:*=flash.display.DisplayObjectContainer(arg1.target);
            if (loc1.tabChildren) 
            {
                addFocusables(loc1, true);
            }
            else 
            {
                removeFocusables(loc1);
            }
            return;
        }

        public function activate():void
        {
            var loc1:*;
            if (activated) 
            {
                return;
            }
            addFocusables(form);
            form.addEventListener(flash.events.Event.ADDED, addedHandler, false, 0, true);
            form.addEventListener(flash.events.Event.REMOVED, removedHandler, false, 0, true);
            try 
            {
                form.stage.addEventListener(flash.events.FocusEvent.MOUSE_FOCUS_CHANGE, mouseFocusChangeHandler, false, 0, true);
                form.stage.addEventListener(flash.events.FocusEvent.KEY_FOCUS_CHANGE, keyFocusChangeHandler, false, 0, true);
                form.stage.addEventListener(flash.events.Event.ACTIVATE, activateHandler, false, 0, true);
                form.stage.addEventListener(flash.events.Event.DEACTIVATE, deactivateHandler, false, 0, true);
            }
            catch (se:SecurityError)
            {
                form.addEventListener(flash.events.FocusEvent.MOUSE_FOCUS_CHANGE, mouseFocusChangeHandler, false, 0, true);
                form.addEventListener(flash.events.FocusEvent.KEY_FOCUS_CHANGE, keyFocusChangeHandler, false, 0, true);
                form.addEventListener(flash.events.Event.ACTIVATE, activateHandler, false, 0, true);
                form.addEventListener(flash.events.Event.DEACTIVATE, deactivateHandler, false, 0, true);
            }
            form.addEventListener(flash.events.FocusEvent.FOCUS_IN, focusInHandler, true, 0, true);
            form.addEventListener(flash.events.FocusEvent.FOCUS_OUT, focusOutHandler, true, 0, true);
            form.addEventListener(flash.events.MouseEvent.MOUSE_DOWN, mouseDownHandler, false, 0, true);
            form.addEventListener(flash.events.KeyboardEvent.KEY_DOWN, keyDownHandler, true, 0, true);
            activated = true;
            if (lastFocus) 
            {
                setFocus(lastFocus);
            }
            return;
        }

        public function deactivate():void
        {
            var loc1:*;
            if (!activated) 
            {
                return;
            }
            focusableObjects = new flash.utils.Dictionary(true);
            focusableCandidates = null;
            lastFocus = null;
            defButton = null;
            form.removeEventListener(flash.events.Event.ADDED, addedHandler, false);
            form.removeEventListener(flash.events.Event.REMOVED, removedHandler, false);
            try 
            {
                form.stage.removeEventListener(flash.events.FocusEvent.MOUSE_FOCUS_CHANGE, mouseFocusChangeHandler, false);
                form.stage.removeEventListener(flash.events.FocusEvent.KEY_FOCUS_CHANGE, keyFocusChangeHandler, false);
                form.stage.removeEventListener(flash.events.Event.ACTIVATE, activateHandler, false);
                form.stage.removeEventListener(flash.events.Event.DEACTIVATE, deactivateHandler, false);
            }
            catch (se:SecurityError)
            {
            };
            form.removeEventListener(flash.events.FocusEvent.MOUSE_FOCUS_CHANGE, mouseFocusChangeHandler, false);
            form.removeEventListener(flash.events.FocusEvent.KEY_FOCUS_CHANGE, keyFocusChangeHandler, false);
            form.removeEventListener(flash.events.Event.ACTIVATE, activateHandler, false);
            form.removeEventListener(flash.events.Event.DEACTIVATE, deactivateHandler, false);
            form.removeEventListener(flash.events.FocusEvent.FOCUS_IN, focusInHandler, true);
            form.removeEventListener(flash.events.FocusEvent.FOCUS_OUT, focusOutHandler, true);
            form.removeEventListener(flash.events.MouseEvent.MOUSE_DOWN, mouseDownHandler, false);
            form.removeEventListener(flash.events.KeyboardEvent.KEY_DOWN, keyDownHandler, true);
            activated = false;
            return;
        }

        internal function focusInHandler(arg1:flash.events.FocusEvent):void
        {
            var loc2:*=null;
            if (!activated) 
            {
                return;
            }
            var loc1:*=flash.display.InteractiveObject(arg1.target);
            if (form.contains(loc1)) 
            {
                lastFocus = findFocusManagerComponent(flash.display.InteractiveObject(loc1));
                if (lastFocus is fl.controls.Button) 
                {
                    loc2 = fl.controls.Button(lastFocus);
                    if (defButton) 
                    {
                        defButton.emphasized = false;
                        defButton = loc2;
                        loc2.emphasized = true;
                    }
                }
                else if (defButton && !(defButton == _defaultButton)) 
                {
                    defButton.emphasized = false;
                    defButton = _defaultButton;
                    _defaultButton.emphasized = true;
                }
            }
            return;
        }

        internal function focusOutHandler(arg1:flash.events.FocusEvent):void
        {
            if (!activated) 
            {
                return;
            }
            var loc1:*=arg1.target as flash.display.InteractiveObject;
            return;
        }

        internal function activateHandler(arg1:flash.events.Event):void
        {
            if (!activated) 
            {
                return;
            }
            var loc1:*=flash.display.InteractiveObject(arg1.target);
            if (lastFocus) 
            {
                if (lastFocus is fl.managers.IFocusManagerComponent) 
                {
                    fl.managers.IFocusManagerComponent(lastFocus).setFocus();
                }
                else 
                {
                    form.stage.focus = lastFocus;
                }
            }
            lastAction = "ACTIVATE";
            return;
        }

        internal function deactivateHandler(arg1:flash.events.Event):void
        {
            if (!activated) 
            {
                return;
            }
            var loc1:*=flash.display.InteractiveObject(arg1.target);
            return;
        }

        internal function mouseFocusChangeHandler(arg1:flash.events.FocusEvent):void
        {
            if (!activated) 
            {
                return;
            }
            if (arg1.relatedObject is flash.text.TextField) 
            {
                return;
            }
            arg1.preventDefault();
            return;
        }

        internal function keyFocusChangeHandler(arg1:flash.events.FocusEvent):void
        {
            if (!activated) 
            {
                return;
            }
            showFocusIndicator = true;
            if ((arg1.keyCode == flash.ui.Keyboard.TAB || arg1.keyCode == 0) && !arg1.isDefaultPrevented()) 
            {
                setFocusToNextObject(arg1);
                arg1.preventDefault();
            }
            return;
        }

        internal function keyDownHandler(arg1:flash.events.KeyboardEvent):void
        {
            if (!activated) 
            {
                return;
            }
            if (arg1.keyCode == flash.ui.Keyboard.TAB) 
            {
                lastAction = "KEY";
                if (calculateCandidates) 
                {
                    sortFocusableObjects();
                    calculateCandidates = false;
                }
            }
            if (defaultButtonEnabled && arg1.keyCode == flash.ui.Keyboard.ENTER && defaultButton && defButton.enabled) 
            {
                sendDefaultButtonEvent();
            }
            return;
        }

        internal function mouseDownHandler(arg1:flash.events.MouseEvent):void
        {
            if (!activated) 
            {
                return;
            }
            if (arg1.isDefaultPrevented()) 
            {
                return;
            }
            var loc1:*=getTopLevelFocusTarget(flash.display.InteractiveObject(arg1.target));
            if (!loc1) 
            {
                return;
            }
            showFocusIndicator = false;
            if ((!(loc1 == lastFocus) || lastAction == "ACTIVATE") && !(loc1 is flash.text.TextField)) 
            {
                setFocus(loc1);
            }
            lastAction = "MOUSEDOWN";
            return;
        }

        public function get defaultButton():fl.controls.Button
        {
            return _defaultButton;
        }

        public function set defaultButton(arg1:fl.controls.Button):void
        {
            var loc1:*=arg1 ? fl.controls.Button(arg1) : null;
            if (loc1 != _defaultButton) 
            {
                if (_defaultButton) 
                {
                    _defaultButton.emphasized = false;
                }
                if (defButton) 
                {
                    defButton.emphasized = false;
                }
                _defaultButton = loc1;
                defButton = loc1;
                if (loc1) 
                {
                    loc1.emphasized = true;
                }
            }
            return;
        }

        public function sendDefaultButtonEvent():void
        {
            defButton.dispatchEvent(new flash.events.MouseEvent(flash.events.MouseEvent.CLICK));
            return;
        }

        internal function setFocusToNextObject(arg1:flash.events.FocusEvent):void
        {
            if (!hasFocusableObjects()) 
            {
                return;
            }
            var loc1:*=getNextFocusManagerComponent(arg1.shiftKey);
            if (loc1) 
            {
                setFocus(loc1);
            }
            return;
        }

        internal function hasFocusableObjects():Boolean
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=focusableObjects;
            for (loc1 in loc3) 
            {
                return true;
            }
            return false;
        }

        public function getNextFocusManagerComponent(arg1:Boolean=false):flash.display.InteractiveObject
        {
            var loc7:*=null;
            if (!hasFocusableObjects()) 
            {
                return null;
            }
            if (calculateCandidates) 
            {
                sortFocusableObjects();
                calculateCandidates = false;
            }
            var loc1:*=form.stage.focus;
            loc1 = flash.display.DisplayObject(findFocusManagerComponent(flash.display.InteractiveObject(loc1)));
            var loc2:*="";
            if (loc1 is fl.managers.IFocusManagerGroup) 
            {
                loc2 = (loc7 = fl.managers.IFocusManagerGroup(loc1)).groupName;
            }
            var loc3:*=getIndexOfFocusedObject(loc1);
            var loc4:*=false;
            var loc5:*=loc3;
            if (loc3 == -1) 
            {
                if (arg1) 
                {
                    loc3 = focusableCandidates.length;
                }
                loc4 = true;
            }
            var loc6:*=getIndexOfNextObject(loc3, arg1, loc4, loc2);
            return findFocusManagerComponent(focusableCandidates[loc6]);
        }

        internal function getIndexOfFocusedObject(arg1:flash.display.DisplayObject):int
        {
            var loc1:*=focusableCandidates.length;
            var loc2:*=0;
            loc2 = 0;
            while (loc2 < loc1) 
            {
                if (focusableCandidates[loc2] == arg1) 
                {
                    return loc2;
                }
                ++loc2;
            }
            return -1;
        }

        internal function getIndexOfNextObject(arg1:int, arg2:Boolean, arg3:Boolean, arg4:String):int
        {
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=0;
            var loc6:*=null;
            var loc7:*=null;
            var loc1:*=focusableCandidates.length;
            var loc2:*=arg1;
            for (;;) 
            {
                if (arg2) 
                {
                    --arg1;
                }
                else 
                {
                    ++arg1;
                }
                if (arg3) 
                {
                    if (arg2 && arg1 < 0) 
                    {
                        break;
                    }
                    if (!arg2 && arg1 == loc1) 
                    {
                        break;
                    }
                }
                else 
                {
                    arg1 = (arg1 + loc1) % loc1;
                    if (loc2 == arg1) 
                    {
                        break;
                    }
                }
                if (!isValidFocusCandidate(focusableCandidates[arg1], arg4)) 
                {
                    continue;
                }
                if ((loc3 = flash.display.DisplayObject(findFocusManagerComponent(focusableCandidates[arg1]))) is fl.managers.IFocusManagerGroup) 
                {
                    loc4 = fl.managers.IFocusManagerGroup(loc3);
                    loc5 = 0;
                    while (loc5 < focusableCandidates.length) 
                    {
                        if ((loc6 = focusableCandidates[loc5]) is fl.managers.IFocusManagerGroup) 
                        {
                            if ((loc7 = fl.managers.IFocusManagerGroup(loc6)).groupName == loc4.groupName && loc7.selected) 
                            {
                                arg1 = loc5;
                            }
                        }
                        ++loc5;
                    }
                }
                return arg1;
            }
            return arg1;
        }

        internal function sortFocusableObjects():void
        {
            var loc1:*=null;
            var loc2:*=null;
            focusableCandidates = [];
            var loc3:*=0;
            var loc4:*=focusableObjects;
            for (loc1 in loc4) 
            {
                loc2 = flash.display.InteractiveObject(loc1);
                if (loc2.tabIndex && !isNaN(Number(loc2.tabIndex)) && loc2.tabIndex > 0) 
                {
                    sortFocusableObjectsTabIndex();
                    return;
                }
                focusableCandidates.push(loc2);
            }
            focusableCandidates.sort(sortByDepth);
            return;
        }

        internal function sortFocusableObjectsTabIndex():void
        {
            var loc1:*=null;
            var loc2:*=null;
            focusableCandidates = [];
            var loc3:*=0;
            var loc4:*=focusableObjects;
            for (loc1 in loc4) 
            {
                loc2 = flash.display.InteractiveObject(loc1);
                if (!(loc2.tabIndex && !isNaN(Number(loc2.tabIndex)))) 
                {
                    continue;
                }
                focusableCandidates.push(loc2);
            }
            focusableCandidates.sort(sortByTabIndex);
            return;
        }

        internal function sortByDepth(arg1:flash.display.InteractiveObject, arg2:flash.display.InteractiveObject):Number
        {
            var aa:flash.display.InteractiveObject;
            var bb:flash.display.InteractiveObject;
            var val1:String;
            var val2:String;
            var index:int;
            var tmp:String;
            var tmp2:String;
            var zeros:String;
            var a:flash.display.DisplayObject;
            var b:flash.display.DisplayObject;

            var loc1:*;
            index = 0;
            tmp = null;
            tmp2 = null;
            aa = arg1;
            bb = arg2;
            val1 = "";
            val2 = "";
            zeros = "0000";
            a = flash.display.DisplayObject(aa);
            b = flash.display.DisplayObject(bb);
            try 
            {
                while (!(a == flash.display.DisplayObject(form)) && a.parent) 
                {
                    index = getChildIndex(a.parent, a);
                    tmp = index.toString(16);
                    if (tmp.length < 4) 
                    {
                        tmp2 = zeros.substring(0, 4 - tmp.length) + tmp;
                    }
                    val1 = tmp2 + val1;
                    a = a.parent;
                }
            }
            catch (se1:SecurityError)
            {
            };
            try 
            {
                while (!(b == flash.display.DisplayObject(form)) && b.parent) 
                {
                    index = getChildIndex(b.parent, b);
                    tmp = index.toString(16);
                    if (tmp.length < 4) 
                    {
                        tmp2 = zeros.substring(0, 4 - tmp.length) + tmp;
                    }
                    val2 = tmp2 + val2;
                    b = b.parent;
                }
            }
            catch (se2:SecurityError)
            {
            };
            return val1 > val2 ? 1 : val1 < val2 ? -1 : 0;
        }

        internal function getChildIndex(arg1:flash.display.DisplayObjectContainer, arg2:flash.display.DisplayObject):int
        {
            return arg1.getChildIndex(arg2);
        }

        internal function sortByTabIndex(arg1:flash.display.InteractiveObject, arg2:flash.display.InteractiveObject):int
        {
            return arg1.tabIndex > arg2.tabIndex ? 1 : arg1.tabIndex < arg2.tabIndex ? -1 : sortByDepth(arg1, arg2);
        }

        public function get defaultButtonEnabled():Boolean
        {
            return _defaultButtonEnabled;
        }

        public function set defaultButtonEnabled(arg1:Boolean):void
        {
            _defaultButtonEnabled = arg1;
            return;
        }

        internal var _form:flash.display.DisplayObjectContainer;

        internal var focusableObjects:flash.utils.Dictionary;

        internal var focusableCandidates:Array;

        internal var activated:Boolean=false;

        internal var calculateCandidates:Boolean=true;

        internal var lastFocus:flash.display.InteractiveObject;

        internal var lastAction:String;

        internal var defButton:fl.controls.Button;

        internal var _defaultButton:fl.controls.Button;

        internal var _defaultButtonEnabled:Boolean=true;

        internal var _showFocusIndicator:Boolean=true;
    }
}


//      class IFocusManager
package fl.managers 
{
    import fl.controls.*;
    import flash.display.*;
    
    public interface IFocusManager
    {
        function get defaultButton():fl.controls.Button;

        function set defaultButton(arg1:fl.controls.Button):void;

        function get defaultButtonEnabled():Boolean;

        function set defaultButtonEnabled(arg1:Boolean):void;

        function get nextTabIndex():int;

        function get showFocusIndicator():Boolean;

        function set showFocusIndicator(arg1:Boolean):void;

        function getFocus():flash.display.InteractiveObject;

        function setFocus(arg1:flash.display.InteractiveObject):void;

        function showFocus():void;

        function hideFocus():void;

        function activate():void;

        function deactivate():void;

        function findFocusManagerComponent(arg1:flash.display.InteractiveObject):flash.display.InteractiveObject;

        function getNextFocusManagerComponent(arg1:Boolean=false):flash.display.InteractiveObject;

        function get form():flash.display.DisplayObjectContainer;

        function set form(arg1:flash.display.DisplayObjectContainer):void;
    }
}


//      class IFocusManagerComponent
package fl.managers 
{
    public interface IFocusManagerComponent
    {
        function get focusEnabled():Boolean;

        function set focusEnabled(arg1:Boolean):void;

        function get mouseFocusEnabled():Boolean;

        function get tabEnabled():Boolean;

        function get tabIndex():int;

        function setFocus():void;

        function drawFocus(arg1:Boolean):void;
    }
}


//      class IFocusManagerGroup
package fl.managers 
{
    public interface IFocusManagerGroup
    {
        function get groupName():String;

        function set groupName(arg1:String):void;

        function get selected():Boolean;

        function set selected(arg1:Boolean):void;
    }
}


//      class StyleManager
package fl.managers 
{
    import fl.core.*;
    import flash.text.*;
    import flash.utils.*;
    
    public class StyleManager extends Object
    {
        public function StyleManager()
        {
            super();
            styleToClassesHash = {};
            classToInstancesDict = new flash.utils.Dictionary(true);
            classToStylesDict = new flash.utils.Dictionary(true);
            classToDefaultStylesDict = new flash.utils.Dictionary(true);
            globalStyles = fl.core.UIComponent.getStyleDefinition();
            return;
        }

        internal static function getInstance():*
        {
            if (_instance == null) 
            {
                _instance = new StyleManager();
            }
            return _instance;
        }

        public static function registerInstance(arg1:fl.core.UIComponent):void
        {
            var instance:fl.core.UIComponent;
            var inst:fl.managers.StyleManager;
            var classDef:Class;
            var target:Class;
            var defaultStyles:Object;
            var styleToClasses:Object;
            var n:String;

            var loc1:*;
            target = null;
            defaultStyles = null;
            styleToClasses = null;
            n = null;
            instance = arg1;
            inst = getInstance();
            classDef = getClassDef(instance);
            if (classDef == null) 
            {
                return;
            }
            if (inst.classToInstancesDict[classDef] == null) 
            {
                inst.classToInstancesDict[classDef] = new flash.utils.Dictionary(true);
                target = classDef;
                while (defaultStyles == null) 
                {
                    if (target["getStyleDefinition"] != null) 
                    {
                        var loc2:*;
                        defaultStyles = (loc2 = target)["getStyleDefinition"]();
                        break;
                    }
                }
                styleToClasses = inst.styleToClassesHash;
                loc2 = 0;
                var loc3:*=defaultStyles;
                for (n in loc3) 
                {
                    if (styleToClasses[n] == null) 
                    {
                        styleToClasses[n] = new flash.utils.Dictionary(true);
                    }
                    styleToClasses[n][classDef] = true;
                }
                inst.classToDefaultStylesDict[classDef] = defaultStyles;
                if (inst.classToStylesDict[classDef] == null) 
                {
                    inst.classToStylesDict[classDef] = {};
                }
            }
            inst.classToInstancesDict[classDef][instance] = true;
            setSharedStyles(instance);
            return;
        }

        internal static function setSharedStyles(arg1:fl.core.UIComponent):void
        {
            var loc4:*=null;
            var loc1:*=getInstance();
            var loc2:*=getClassDef(arg1);
            var loc3:*=loc1.classToDefaultStylesDict[loc2];
            var loc5:*=0;
            var loc6:*=loc3;
            for (loc4 in loc6) 
            {
                arg1.setSharedStyle(loc4, getSharedStyle(arg1, loc4));
            }
            return;
        }

        internal static function getSharedStyle(arg1:fl.core.UIComponent, arg2:String):Object
        {
            var loc1:*=getClassDef(arg1);
            var loc2:*;
            var loc3:*;
            if ((loc3 = (loc2 = getInstance()).classToStylesDict[loc1][arg2]) != null) 
            {
                return loc3;
            }
            if ((loc3 = loc2.globalStyles[arg2]) != null) 
            {
                return loc3;
            }
            return loc2.classToDefaultStylesDict[loc1][arg2];
        }

        public static function getComponentStyle(arg1:Object, arg2:String):Object
        {
            var loc1:*=getClassDef(arg1);
            var loc2:*;
            return (loc2 = getInstance().classToStylesDict[loc1]) != null ? loc2[arg2] : null;
        }

        public static function clearComponentStyle(arg1:Object, arg2:String):void
        {
            var loc1:*=getClassDef(arg1);
            var loc2:*;
            if (!((loc2 = getInstance().classToStylesDict[loc1]) == null) && !(loc2[arg2] == null)) 
            {
                delete loc2[arg2];
                invalidateComponentStyle(loc1, arg2);
            }
            return;
        }

        public static function setComponentStyle(arg1:Object, arg2:String, arg3:Object):void
        {
            var loc1:*=getClassDef(arg1);
            var loc2:*;
            if ((loc2 = getInstance().classToStylesDict[loc1]) == null) 
            {
                var loc3:*;
                getInstance().classToStylesDict[loc1] = loc3 = {};
                loc2 = loc3;
            }
            if (loc2 == arg3) 
            {
                return;
            }
            loc2[arg2] = arg3;
            invalidateComponentStyle(loc1, arg2);
            return;
        }

        internal static function getClassDef(arg1:Object):Class
        {
            var component:Object;

            var loc1:*;
            component = arg1;
            if (component is Class) 
            {
                return component as Class;
            }
            try 
            {
                return flash.utils.getDefinitionByName(flash.utils.getQualifiedClassName(component)) as Class;
            }
            catch (e:Error)
            {
                if (component is fl.core.UIComponent) 
                {
                    try 
                    {
                        return component.loaderInfo.applicationDomain.getDefinition(flash.utils.getQualifiedClassName(component)) as Class;
                    }
                    catch (e:Error)
                    {
                    };
                }
            }
            return null;
        }

        internal static function invalidateStyle(arg1:String):void
        {
            var loc2:*=null;
            var loc1:*=getInstance().styleToClassesHash[arg1];
            if (loc1 == null) 
            {
                return;
            }
            var loc3:*=0;
            var loc4:*=loc1;
            for (loc2 in loc4) 
            {
                invalidateComponentStyle(Class(loc2), arg1);
            }
            return;
        }

        internal static function invalidateComponentStyle(arg1:Class, arg2:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=getInstance().classToInstancesDict[arg1];
            if (loc1 == null) 
            {
                return;
            }
            var loc4:*=0;
            var loc5:*=loc1;
            for (loc2 in loc5) 
            {
                if ((loc3 = loc2 as fl.core.UIComponent) == null) 
                {
                    continue;
                }
                loc3.setSharedStyle(arg2, getSharedStyle(loc3, arg2));
            }
            return;
        }

        public static function setStyle(arg1:String, arg2:Object):void
        {
            var loc1:*=getInstance().globalStyles;
            if (loc1[arg1] === arg2 && !(arg2 is flash.text.TextFormat)) 
            {
                return;
            }
            loc1[arg1] = arg2;
            invalidateStyle(arg1);
            return;
        }

        public static function clearStyle(arg1:String):void
        {
            setStyle(arg1, null);
            return;
        }

        public static function getStyle(arg1:String):Object
        {
            return getInstance().globalStyles[arg1];
        }

        internal var styleToClassesHash:Object;

        internal var classToInstancesDict:flash.utils.Dictionary;

        internal var classToStylesDict:flash.utils.Dictionary;

        internal var classToDefaultStylesDict:flash.utils.Dictionary;

        internal var globalStyles:Object;

        internal static var _instance:fl.managers.StyleManager;
    }
}


//  package mgs
//    package greensock
//      package core
//        class Animation
package mgs.greensock.core 
{
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    
    public class Animation extends Object
    {
        public function Animation(arg1:Number=0, arg2:Object=null)
        {
            super();
            this.vars = arg2 || {};
            if (this.vars._isGSVars) 
            {
                this.vars = this.vars.vars;
            }
            var loc2:*;
            this._totalDuration = loc2 = arg1 || 0;
            this._duration = loc2;
            this._delay = Number(this.vars.delay) || 0;
            this._timeScale = 1;
            this._time = loc2 = 0;
            this._totalTime = loc2;
            this.data = this.vars.data;
            this._rawPrevTime = -1;
            if (_rootTimeline == null) 
            {
                if (_rootFrame != -1) 
                {
                    return;
                }
                else 
                {
                    _rootFrame = 0;
                    _rootFramesTimeline = new mgs.greensock.core.SimpleTimeline();
                    _rootTimeline = new mgs.greensock.core.SimpleTimeline();
                    _rootTimeline._startTime = flash.utils.getTimer() / 1000;
                    _rootFramesTimeline._startTime = 0;
                    _rootFramesTimeline._active = loc2 = true;
                    _rootTimeline._active = loc2;
                    ticker.addEventListener("enterFrame", _updateRoot, false, 0, true);
                }
            }
            var loc1:*=this.vars.useFrames ? _rootFramesTimeline : _rootTimeline;
            loc1.add(this, loc1._time);
            this._reversed = this.vars.reversed == true;
            if (this.vars.paused) 
            {
                this.paused(true);
            }
            return;
        }

        public function seek(arg1:*, arg2:Boolean=true):*
        {
            return this.totalTime(Number(arg1), arg2);
        }

        
        {
            ticker = new flash.display.Shape();
            _rootFrame = -1;
            _tickEvent = new flash.events.Event("tick");
        }

        public function reverse(arg1:*=null, arg2:Boolean=true):*
        {
            if (arguments.length) 
            {
                this.seek(arg1 || this.totalDuration(), arg2);
            }
            this.reversed(true);
            return this.paused(false);
        }

        public function render(arg1:Number, arg2:Boolean=false, arg3:Boolean=false):void
        {
            return;
        }

        public function invalidate():*
        {
            return this;
        }

        public function kill(arg1:Object=null, arg2:Object=null):*
        {
            this._kill(arg1, arg2);
            return this;
        }

        public function _enabled(arg1:Boolean, arg2:Boolean=false):Boolean
        {
            this._gc = !arg1;
            this._active = Boolean(arg1 && !this._paused && this._totalTime > 0 && this._totalTime < this._totalDuration);
            if (!arg2) 
            {
                if (arg1 && this.timeline == null) 
                {
                    this._timeline.add(this, this._startTime - this._delay);
                }
                else if (!arg1 && !(this.timeline == null)) 
                {
                    this._timeline._remove(this, true);
                }
            }
            return false;
        }

        public function _kill(arg1:Object=null, arg2:Object=null):Boolean
        {
            return this._enabled(false, false);
        }

        protected function _uncache(arg1:Boolean):*
        {
            var loc1:*=arg1 ? this : this.timeline;
            while (loc1) 
            {
                loc1._dirty = true;
                loc1 = loc1.timeline;
            }
            return this;
        }

        protected function _swapSelfInParams(arg1:Array):Array
        {
            var loc1:*=arg1.length;
            var loc2:*=arg1.concat();
            while (--loc1 > -1) 
            {
                if (arg1[loc1] !== "{self}") 
                {
                    continue;
                }
                loc2[loc1] = this;
            }
            return loc2;
        }

        public function eventCallback(arg1:String, arg2:Function=null, arg3:Array=null):*
        {
            if (arg1 == null) 
            {
                return null;
            }
            if (arg1.substr(0, 2) == "on") 
            {
                if (arguments.length == 1) 
                {
                    return this.vars[arg1];
                }
                if (arg2 != null) 
                {
                    this.vars[arg1] = arg2;
                    this.vars[arg1 + "Params"] = arg3 is Array && !(arg3.join("").indexOf("{self}") === -1) ? this._swapSelfInParams(arg3) : arg3;
                }
                else 
                {
                    delete this.vars[arg1];
                }
                if (arg1 == "onUpdate") 
                {
                    this._onUpdate = arg2;
                }
            }
            return this;
        }

        public function delay(arg1:Number=NaN):*
        {
            if (!arguments.length) 
            {
                return this._delay;
            }
            if (this._timeline.smoothChildTiming) 
            {
                this.startTime(this._startTime + arg1 - this._delay);
            }
            this._delay = arg1;
            return this;
        }

        public function duration(arg1:Number=NaN):*
        {
            if (!arguments.length) 
            {
                this._dirty = false;
                return this._duration;
            }
            var loc1:*;
            this._totalDuration = loc1 = arg1;
            this._duration = loc1;
            this._uncache(true);
            if (this._timeline.smoothChildTiming) 
            {
                if (this._time > 0) 
                {
                    if (this._time < this._duration) 
                    {
                        if (arg1 != 0) 
                        {
                            this.totalTime(this._totalTime * arg1 / this._duration, true);
                        }
                    }
                }
            }
            return this;
        }

        public function totalDuration(arg1:Number=NaN):*
        {
            this._dirty = false;
            return arguments.length ? this.duration(arg1) : this._totalDuration;
        }

        public function time(arg1:Number=NaN, arg2:Boolean=false):*
        {
            if (!arguments.length) 
            {
                return this._time;
            }
            if (this._dirty) 
            {
                this.totalDuration();
            }
            if (arg1 > this._duration) 
            {
                arg1 = this._duration;
            }
            return this.totalTime(arg1, arg2);
        }

        public function totalTime(arg1:Number=NaN, arg2:Boolean=false, arg3:Boolean=false):*
        {
            var loc1:*=null;
            if (!arguments.length) 
            {
                return this._totalTime;
            }
            if (this._timeline) 
            {
                if (arg1 < 0 && !arg3) 
                {
                    arg1 = arg1 + this.totalDuration();
                }
                if (this._timeline.smoothChildTiming) 
                {
                    if (this._dirty) 
                    {
                        this.totalDuration();
                    }
                    if (arg1 > this._totalDuration && !arg3) 
                    {
                        arg1 = this._totalDuration;
                    }
                    loc1 = this._timeline;
                    this._startTime = (this._paused ? this._pauseTime : loc1._time) - (this._reversed ? this._totalDuration - arg1 : arg1) / this._timeScale;
                    if (!this._timeline._dirty) 
                    {
                        this._uncache(false);
                    }
                    if (loc1._timeline != null) 
                    {
                        while (loc1._timeline) 
                        {
                            if (loc1._timeline._time !== (loc1._startTime + loc1._totalTime) / loc1._timeScale) 
                            {
                                loc1.totalTime(loc1._totalTime, true);
                            }
                            loc1 = loc1._timeline;
                        }
                    }
                }
                if (this._gc) 
                {
                    this._enabled(true, false);
                }
                if (this._totalTime != arg1) 
                {
                    this.render(arg1, arg2, false);
                }
            }
            return this;
        }

        public function startTime(arg1:Number=NaN):*
        {
            if (!arguments.length) 
            {
                return this._startTime;
            }
            if (arg1 != this._startTime) 
            {
                this._startTime = arg1;
                if (this.timeline) 
                {
                    if (this.timeline._sortChildren) 
                    {
                        this.timeline.add(this, arg1 - this._delay);
                    }
                }
            }
            return this;
        }

        public function timeScale(arg1:Number=NaN):*
        {
            var loc1:*=NaN;
            if (!arguments.length) 
            {
                return this._timeScale;
            }
            arg1 = arg1 || 1e-006;
            if (this._timeline && this._timeline.smoothChildTiming) 
            {
                loc1 = this._pauseTime || this._pauseTime == 0 ? this._pauseTime : this._timeline._totalTime;
                this._startTime = loc1 - (loc1 - this._startTime) * this._timeScale / arg1;
            }
            this._timeScale = arg1;
            return this._uncache(false);
        }

        public function reversed(arg1:Boolean=false):*
        {
            if (!arguments.length) 
            {
                return this._reversed;
            }
            if (arg1 != this._reversed) 
            {
                this._reversed = arg1;
                this.totalTime(this._totalTime, true);
            }
            return this;
        }

        public function paused(arg1:Boolean=false):*
        {
            var loc1:*=NaN;
            var loc2:*=NaN;
            if (!arguments.length) 
            {
                return this._paused;
            }
            if (arg1 != this._paused) 
            {
                if (this._timeline) 
                {
                    loc1 = this._timeline.rawTime();
                    loc2 = loc1 - this._pauseTime;
                    if (!arg1 && this._timeline.smoothChildTiming) 
                    {
                        this._startTime = this._startTime + loc2;
                        this._uncache(false);
                    }
                    this._pauseTime = arg1 ? loc1 : NaN;
                    this._paused = arg1;
                    this._active = !arg1 && this._totalTime > 0 && this._totalTime < this._totalDuration;
                    if (!arg1 && !(loc2 == 0) && !(this._duration === 0)) 
                    {
                        this.render(this._timeline.smoothChildTiming ? this._totalTime : (loc1 - this._startTime) / this._timeScale, true, true);
                    }
                }
            }
            if (this._gc && !arg1) 
            {
                this._enabled(true, false);
            }
            return this;
        }

        public function restart(arg1:Boolean=false, arg2:Boolean=true):*
        {
            this.reversed(false);
            this.paused(false);
            return this.totalTime(arg1 ? -this._delay : 0, arg2, true);
        }

        public static function _updateRoot(arg1:flash.events.Event=null):void
        {
            var loc1:*;
            _rootFrame++;
            _rootTimeline.render((flash.utils.getTimer() / 1000 - _rootTimeline._startTime) * _rootTimeline._timeScale, false, false);
            _rootFramesTimeline.render((_rootFrame - _rootFramesTimeline._startTime) * _rootFramesTimeline._timeScale, false, false);
            ticker.dispatchEvent(_tickEvent);
            return;
        }

        public function play(arg1:*=null, arg2:Boolean=true):*
        {
            if (arguments.length) 
            {
                this.seek(arg1, arg2);
            }
            this.reversed(false);
            return this.paused(false);
        }

        public function pause(arg1:*=null, arg2:Boolean=true):*
        {
            if (arguments.length) 
            {
                this.seek(arg1, arg2);
            }
            return this.paused(true);
        }

        public function resume(arg1:*=null, arg2:Boolean=true):*
        {
            if (arguments.length) 
            {
                this.seek(arg1, arg2);
            }
            return this.paused(false);
        }

        public static const version:String="12.0.13";

        protected var _onUpdate:Function;

        public var _delay:Number;

        public var _rawPrevTime:Number;

        public var _active:Boolean;

        public var _gc:Boolean;

        public var _startTime:Number;

        public var _time:Number;

        public var _totalTime:Number;

        public var _duration:Number;

        public var _totalDuration:Number;

        public var _pauseTime:Number;

        public var _timeScale:Number;

        public var _reversed:Boolean;

        public var _timeline:mgs.greensock.core.SimpleTimeline;

        public var _dirty:Boolean;

        public var _paused:Boolean;

        public var _next:mgs.greensock.core.Animation;

        public var _prev:mgs.greensock.core.Animation;

        public var vars:Object;

        public var data:*;

        public var _initted:Boolean;

        public static var _rootTimeline:mgs.greensock.core.SimpleTimeline;

        public static var _rootFramesTimeline:mgs.greensock.core.SimpleTimeline;

        protected static var _rootFrame:Number=-1;

        protected static var _tickEvent:flash.events.Event;

        public var timeline:mgs.greensock.core.SimpleTimeline;

        public static var ticker:flash.display.Shape;
    }
}


//        class PropTween
package mgs.greensock.core 
{
    public final class PropTween extends Object
    {
        public function PropTween(arg1:Object, arg2:String, arg3:Number, arg4:Number, arg5:String, arg6:Boolean, arg7:mgs.greensock.core.PropTween=null, arg8:int=0)
        {
            super();
            this.t = arg1;
            this.p = arg2;
            this.s = arg3;
            this.c = arg4;
            this.n = arg5;
            this.f = arg1[arg2] is Function;
            this.pg = arg6;
            if (arg7) 
            {
                arg7._prev = this;
                this._next = arg7;
            }
            this.pr = arg8;
            return;
        }

        public var t:Object;

        public var p:String;

        public var s:Number;

        public var c:Number;

        public var f:Boolean;

        public var pr:int;

        public var pg:Boolean;

        public var n:String;

        public var r:Boolean;

        public var _next:mgs.greensock.core.PropTween;

        public var _prev:mgs.greensock.core.PropTween;
    }
}


//        class SimpleTimeline
package mgs.greensock.core 
{
    public class SimpleTimeline extends mgs.greensock.core.Animation
    {
        public function SimpleTimeline(arg1:Object=null)
        {
            super(0, arg1);
            var loc1:*;
            this.smoothChildTiming = loc1 = true;
            this.autoRemoveChildren = loc1;
            return;
        }

        public function insert(arg1:*, arg2:*=0):*
        {
            return this.add(arg1, arg2 || 0);
        }

        public function add(arg1:*, arg2:*="+=0", arg3:String="normal", arg4:Number=0):*
        {
            var loc2:*=NaN;
            arg1._startTime = Number(arg2 || 0) + arg1._delay;
            if (arg1._paused) 
            {
                if (this != arg1._timeline) 
                {
                    arg1._pauseTime = arg1._startTime + (this.rawTime() - arg1._startTime) / arg1._timeScale;
                }
            }
            if (arg1.timeline) 
            {
                arg1.timeline._remove(arg1, true);
            }
            var loc3:*;
            arg1._timeline = loc3 = this;
            arg1.timeline = loc3;
            if (arg1._gc) 
            {
                arg1._enabled(true, true);
            }
            var loc1:*=this._last;
            if (this._sortChildren) 
            {
                loc2 = arg1._startTime;
                while (loc1 && loc1._startTime > loc2) 
                {
                    loc1 = loc1._prev;
                }
            }
            if (loc1) 
            {
                arg1._next = loc1._next;
                loc1._next = mgs.greensock.core.Animation(arg1);
            }
            else 
            {
                arg1._next = this._first;
                this._first = mgs.greensock.core.Animation(arg1);
            }
            if (arg1._next) 
            {
                arg1._next._prev = arg1;
            }
            else 
            {
                this._last = mgs.greensock.core.Animation(arg1);
            }
            arg1._prev = loc1;
            if (_timeline) 
            {
                _uncache(true);
            }
            return this;
        }

        public function _remove(arg1:mgs.greensock.core.Animation, arg2:Boolean=false):*
        {
            if (arg1.timeline == this) 
            {
                if (!arg2) 
                {
                    arg1._enabled(false, true);
                }
                arg1.timeline = null;
                if (arg1._prev) 
                {
                    arg1._prev._next = arg1._next;
                }
                else if (this._first === arg1) 
                {
                    this._first = arg1._next;
                }
                if (arg1._next) 
                {
                    arg1._next._prev = arg1._prev;
                }
                else if (this._last === arg1) 
                {
                    this._last = arg1._prev;
                }
                if (_timeline) 
                {
                    _uncache(true);
                }
            }
            return this;
        }

        public override function render(arg1:Number, arg2:Boolean=false, arg3:Boolean=false):void
        {
            var loc2:*=null;
            var loc1:*=this._first;
            var loc3:*;
            _rawPrevTime = loc3 = arg1;
            _time = loc3 = loc3;
            _totalTime = loc3;
            while (loc1) 
            {
                loc2 = loc1._next;
                if (loc1._active || arg1 >= loc1._startTime && !loc1._paused) 
                {
                    if (loc1._reversed) 
                    {
                        loc1.render((loc1._dirty ? loc1.totalDuration() : loc1._totalDuration) - (arg1 - loc1._startTime) * loc1._timeScale, arg2, arg3);
                    }
                    else 
                    {
                        loc1.render((arg1 - loc1._startTime) * loc1._timeScale, arg2, arg3);
                    }
                }
                loc1 = loc2;
            }
            return;
        }

        public function rawTime():Number
        {
            return _totalTime;
        }

        public var autoRemoveChildren:Boolean;

        public var smoothChildTiming:Boolean;

        public var _sortChildren:Boolean;

        public var _first:mgs.greensock.core.Animation;

        public var _last:mgs.greensock.core.Animation;
    }
}


//      package easing
//        class Ease
package mgs.greensock.easing 
{
    public class Ease extends Object
    {
        public function Ease(arg1:Function=null, arg2:Array=null, arg3:Number=0, arg4:Number=0)
        {
            super();
            this._func = arg1;
            this._params = arg2 ? _baseParams.concat(arg2) : _baseParams;
            this._type = arg3;
            this._power = arg4;
            return;
        }

        public function getRatio(arg1:Number):Number
        {
            var loc1:*=NaN;
            if (this._func != null) 
            {
                this._params[0] = arg1;
                return this._func.apply(null, this._params);
            }
            loc1 = this._type != 1 ? this._type != 2 ? arg1 < 0.5 ? arg1 * 2 : (1 - arg1) * 2 : arg1 : 1 - arg1;
            if (this._power != 1) 
            {
                if (this._power != 2) 
                {
                    if (this._power != 3) 
                    {
                        if (this._power == 4) 
                        {
                            loc1 = loc1 * loc1 * loc1 * loc1 * loc1;
                        }
                    }
                    else 
                    {
                        loc1 = loc1 * loc1 * loc1 * loc1;
                    }
                }
                else 
                {
                    loc1 = loc1 * loc1 * loc1;
                }
            }
            else 
            {
                loc1 = loc1 * loc1;
            }
            return this._type != 1 ? this._type != 2 ? arg1 < 0.5 ? loc1 / 2 : 1 - loc1 / 2 : loc1 : 1 - loc1;
        }

        
        {
            _baseParams = [0, 0, 1, 1];
        }

        protected var _func:Function;

        protected var _params:Array;

        protected var _p1:Number;

        protected var _p2:Number;

        protected var _p3:Number;

        public var _type:int;

        public var _power:int;

        public var _calcEnd:Boolean;

        protected static var _baseParams:Array;
    }
}


//        class Quad
package mgs.greensock.easing 
{
    public final class Quad extends Object
    {
        public function Quad()
        {
            super();
            return;
        }

        
        {
            easeOut = new mgs.greensock.easing.Ease(null, null, 1, 1);
            easeIn = new mgs.greensock.easing.Ease(null, null, 2, 1);
            easeInOut = new mgs.greensock.easing.Ease(null, null, 3, 1);
        }

        public static var easeOut:mgs.greensock.easing.Ease;

        public static var easeIn:mgs.greensock.easing.Ease;

        public static var easeInOut:mgs.greensock.easing.Ease;
    }
}


//      package plugins
//        class ColorMatrixFilterPlugin
package mgs.greensock.plugins 
{
    import flash.filters.*;
    import mgs.greensock.*;
    
    public class ColorMatrixFilterPlugin extends mgs.greensock.plugins.FilterPlugin
    {
        public function ColorMatrixFilterPlugin()
        {
            super("colorMatrixFilter");
            return;
        }

        public override function _onInitTween(arg1:Object, arg2:*, arg3:mgs.greensock.TweenLite):Boolean
        {
            var loc1:*=arg2;
            _initFilter(arg1, {"remove":arg2.remove, "index":arg2.index, "addFilter":arg2.addFilter}, arg3, flash.filters.ColorMatrixFilter, new flash.filters.ColorMatrixFilter(_idMatrix.slice()), _propNames);
            if (_filter == null) 
            {
                trace("FILTER NULL! ");
                return true;
            }
            this._matrix = flash.filters.ColorMatrixFilter(_filter).matrix;
            var loc2:*=[];
            if (!(loc1.matrix == null) && loc1.matrix is Array) 
            {
                loc2 = loc1.matrix;
            }
            else 
            {
                if (loc1.relative != true) 
                {
                    loc2 = _idMatrix.slice();
                }
                else 
                {
                    loc2 = this._matrix.slice();
                }
                loc2 = setBrightness(loc2, loc1.brightness);
                loc2 = setContrast(loc2, loc1.contrast);
                loc2 = setHue(loc2, loc1.hue);
                loc2 = setSaturation(loc2, loc1.saturation);
                loc2 = setThreshold(loc2, loc1.threshold);
                if (!isNaN(loc1.colorize)) 
                {
                    loc2 = colorize(loc2, loc1.colorize, loc1.amount);
                }
            }
            this._matrixTween = new mgs.greensock.plugins.EndArrayPlugin();
            this._matrixTween._init(this._matrix, loc2);
            return true;
        }

        public override function setRatio(arg1:Number):void
        {
            this._matrixTween.setRatio(arg1);
            flash.filters.ColorMatrixFilter(_filter).matrix = this._matrix;
            super.setRatio(arg1);
            return;
        }

        public static function colorize(arg1:Array, arg2:Number, arg3:Number=1):Array
        {
            if (isNaN(arg2)) 
            {
                return arg1;
            }
            if (isNaN(arg3)) 
            {
                arg3 = 1;
            }
            var loc1:*=(arg2 >> 16 & 255) / 255;
            var loc2:*=(arg2 >> 8 & 255) / 255;
            var loc3:*=(arg2 & 255) / 255;
            var loc4:*;
            var loc5:*=[(loc4 = 1 - arg3) + arg3 * loc1 * _lumR, arg3 * loc1 * _lumG, arg3 * loc1 * _lumB, 0, 0, arg3 * loc2 * _lumR, loc4 + arg3 * loc2 * _lumG, arg3 * loc2 * _lumB, 0, 0, arg3 * loc3 * _lumR, arg3 * loc3 * _lumG, loc4 + arg3 * loc3 * _lumB, 0, 0, 0, 0, 0, 1, 0];
            return applyMatrix(loc5, arg1);
        }

        public static function setThreshold(arg1:Array, arg2:Number):Array
        {
            if (isNaN(arg2)) 
            {
                return arg1;
            }
            var loc1:*=[_lumR * 256, _lumG * 256, _lumB * 256, 0, -256 * arg2, _lumR * 256, _lumG * 256, _lumB * 256, 0, -256 * arg2, _lumR * 256, _lumG * 256, _lumB * 256, 0, -256 * arg2, 0, 0, 0, 1, 0];
            return applyMatrix(loc1, arg1);
        }

        public static function setHue(arg1:Array, arg2:Number):Array
        {
            if (isNaN(arg2)) 
            {
                return arg1;
            }
            arg2 = arg2 * Math.PI / 180;
            var loc1:*=Math.cos(arg2);
            var loc2:*=Math.sin(arg2);
            var loc3:*=[_lumR + loc1 * (1 - _lumR) + loc2 * (-_lumR), _lumG + loc1 * (-_lumG) + loc2 * (-_lumG), _lumB + loc1 * (-_lumB) + loc2 * (1 - _lumB), 0, 0, _lumR + loc1 * (-_lumR) + loc2 * 0.143, _lumG + loc1 * (1 - _lumG) + loc2 * 0.14, _lumB + loc1 * (-_lumB) + loc2 * -0.283, 0, 0, _lumR + loc1 * (-_lumR) + loc2 * (-(1 - _lumR)), _lumG + loc1 * (-_lumG) + loc2 * _lumG, _lumB + loc1 * (1 - _lumB) + loc2 * _lumB, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1];
            return applyMatrix(loc3, arg1);
        }

        public static function setBrightness(arg1:Array, arg2:Number):Array
        {
            if (isNaN(arg2)) 
            {
                return arg1;
            }
            arg2 = arg2 * 100 - 100;
            return applyMatrix([1, 0, 0, 0, arg2, 0, 1, 0, 0, arg2, 0, 0, 1, 0, arg2, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1], arg1);
        }

        public static function setSaturation(arg1:Array, arg2:Number):Array
        {
            if (isNaN(arg2)) 
            {
                return arg1;
            }
            var loc1:*=1 - arg2;
            var loc2:*=loc1 * _lumR;
            var loc3:*=loc1 * _lumG;
            var loc4:*=loc1 * _lumB;
            var loc5:*=[loc2 + arg2, loc3, loc4, 0, 0, loc2, loc3 + arg2, loc4, 0, 0, loc2, loc3, loc4 + arg2, 0, 0, 0, 0, 0, 1, 0];
            return applyMatrix(loc5, arg1);
        }

        public static function setContrast(arg1:Array, arg2:Number):Array
        {
            if (isNaN(arg2)) 
            {
                return arg1;
            }
            arg2 = arg2 + 0.01;
            var loc1:*=[arg2, 0, 0, 0, 128 * (1 - arg2), 0, arg2, 0, 0, 128 * (1 - arg2), 0, 0, arg2, 0, 128 * (1 - arg2), 0, 0, 0, 1, 0];
            return applyMatrix(loc1, arg1);
        }

        public static function applyMatrix(arg1:Array, arg2:Array):Array
        {
            var loc4:*=0;
            var loc5:*=0;
            if (!(arg1 is Array) || !(arg2 is Array)) 
            {
                return arg2;
            }
            var loc1:*=[];
            var loc2:*=0;
            var loc3:*=0;
            loc4 = 0;
            while (loc4 < 4) 
            {
                loc5 = 0;
                while (loc5 < 5) 
                {
                    loc3 = loc5 != 4 ? 0 : arg1[loc2 + 4];
                    loc1[loc2 + loc5] = arg1[loc2] * arg2[loc5] + arg1[loc2 + 1] * arg2[loc5 + 5] + arg1[loc2 + 2] * arg2[loc5 + 10] + arg1[loc2 + 3] * arg2[loc5 + 15] + loc3;
                    loc5 = loc5 + 1;
                }
                loc2 = loc2 + 5;
                loc4 = loc4 + 1;
            }
            return loc1;
        }

        
        {
            _propNames = [];
            _idMatrix = [1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0];
            _lumR = 0.212671;
            _lumG = 0.71516;
            _lumB = 0.072169;
        }

        public static const API:Number=2;

        protected var _matrix:Array;

        protected var _matrixTween:mgs.greensock.plugins.EndArrayPlugin;

        internal static var _propNames:Array;

        protected static var _idMatrix:Array;

        protected static var _lumR:Number=0.212671;

        protected static var _lumG:Number=0.71516;

        protected static var _lumB:Number=0.072169;
    }
}


//        class ColorTransformPlugin
package mgs.greensock.plugins 
{
    import flash.display.*;
    import flash.geom.*;
    import mgs.greensock.*;
    
    public class ColorTransformPlugin extends mgs.greensock.plugins.TintPlugin
    {
        public function ColorTransformPlugin()
        {
            super();
            _propName = "colorTransform";
            return;
        }

        public override function _onInitTween(arg1:Object, arg2:*, arg3:mgs.greensock.TweenLite):Boolean
        {
            var loc1:*=null;
            var loc3:*=null;
            var loc4:*=NaN;
            var loc2:*=new flash.geom.ColorTransform();
            if (arg1 is flash.display.DisplayObject) 
            {
                _transform = flash.display.DisplayObject(arg1).transform;
                loc1 = _transform.colorTransform;
            }
            else if (arg1 is flash.geom.ColorTransform) 
            {
                loc1 = arg1 as flash.geom.ColorTransform;
            }
            else 
            {
                return false;
            }
            loc2.concat(loc1);
            var loc5:*=0;
            var loc6:*=arg2;
            for (loc3 in loc6) 
            {
                if (loc3 == "tint" || loc3 == "color") 
                {
                    if (arg2[loc3] != null) 
                    {
                        loc2.color = int(arg2[loc3]);
                    }
                    continue;
                }
                if (loc3 == "tintAmount" || loc3 == "exposure" || loc3 == "brightness") 
                {
                    continue;
                }
                loc2[loc3] = arg2[loc3];
            }
            if (isNaN(arg2.tintAmount)) 
            {
                if (isNaN(arg2.exposure)) 
                {
                    if (!isNaN(arg2.brightness)) 
                    {
                        loc2.blueOffset = loc5 = Math.max(0, (arg2.brightness - 1) * 255);
                        loc2.greenOffset = loc5 = loc5;
                        loc2.redOffset = loc5;
                        loc2.blueMultiplier = loc5 = 1 - Math.abs((arg2.brightness - 1));
                        loc2.greenMultiplier = loc5 = loc5;
                        loc2.redMultiplier = loc5;
                    }
                }
                else 
                {
                    loc2.blueOffset = loc5 = 255 * (arg2.exposure - 1);
                    loc2.greenOffset = loc5 = loc5;
                    loc2.redOffset = loc5;
                    loc2.blueMultiplier = loc5 = 1;
                    loc2.greenMultiplier = loc5 = loc5;
                    loc2.redMultiplier = loc5;
                }
            }
            else 
            {
                loc4 = arg2.tintAmount / (1 - (loc2.redMultiplier + loc2.greenMultiplier + loc2.blueMultiplier) / 3);
                loc2.redOffset = loc2.redOffset * loc4;
                loc2.greenOffset = loc2.greenOffset * loc4;
                loc2.blueOffset = loc2.blueOffset * loc4;
                loc2.blueMultiplier = loc5 = 1 - arg2.tintAmount;
                loc2.greenMultiplier = loc5 = loc5;
                loc2.redMultiplier = loc5;
            }
            _init(loc1, loc2);
            return true;
        }

        public static const API:Number=2;
    }
}


//        class EndArrayPlugin
package mgs.greensock.plugins 
{
    import mgs.greensock.*;
    
    public class EndArrayPlugin extends mgs.greensock.plugins.TweenPlugin
    {
        public function EndArrayPlugin()
        {
            this._info = [];
            super("endArray");
            return;
        }

        public override function _onInitTween(arg1:Object, arg2:*, arg3:mgs.greensock.TweenLite):Boolean
        {
            if (!(arg1 is Array) || !(arg2 is Array)) 
            {
                return false;
            }
            this._init(arg1 as Array, arg2);
            return true;
        }

        public function _init(arg1:Array, arg2:Array):void
        {
            this._a = arg1;
            var loc1:*=arg2.length;
            var loc2:*=0;
            while (--loc1 > -1) 
            {
                if (!(!(arg1[loc1] == arg2[loc1]) && !(arg1[loc1] == null))) 
                {
                    continue;
                }
                var loc3:*;
                this._info[loc3 = loc2++] = new ArrayTweenInfo(loc1, this._a[loc1], arg2[loc1] - this._a[loc1]);
            }
            return;
        }

        public override function _roundProps(arg1:Object, arg2:Boolean=true):void
        {
            if ("endArray" in arg1) 
            {
                this._round = arg2;
            }
            return;
        }

        public override function setRatio(arg1:Number):void
        {
            var loc2:*=null;
            var loc3:*=NaN;
            var loc1:*=this._info.length;
            if (this._round) 
            {
                while (--loc1 > -1) 
                {
                    loc2 = this._info[loc1];
                    var loc4:*;
                    loc3 = loc4 = loc2.c * arg1 + loc2.s;
                    this._a[loc2.i] = loc4 > 0 ? loc3 + 0.5 >> 0 : loc3 - 0.5 >> 0;
                }
            }
            else 
            {
                while (--loc1 > -1) 
                {
                    loc2 = this._info[loc1];
                    this._a[loc2.i] = loc2.c * arg1 + loc2.s;
                }
            }
            return;
        }

        public static const API:Number=2;

        protected var _a:Array;

        protected var _round:Boolean;

        protected var _info:Array;
    }
}


class ArrayTweenInfo extends Object
{
    public function ArrayTweenInfo(arg1:uint, arg2:Number, arg3:Number)
    {
        super();
        this.i = arg1;
        this.s = arg2;
        this.c = arg3;
        return;
    }

    public var i:uint;

    public var s:Number;

    public var c:Number;
}

//        class FilterPlugin
package mgs.greensock.plugins 
{
    import flash.filters.*;
    import mgs.greensock.*;
    
    public class FilterPlugin extends mgs.greensock.plugins.TweenPlugin
    {
        public function FilterPlugin(arg1:String="", arg2:Number=0)
        {
            super(arg1, arg2);
            return;
        }

        protected function _initFilter(arg1:*, arg2:Object, arg3:mgs.greensock.TweenLite, arg4:Class, arg5:flash.filters.BitmapFilter, arg6:Array):Boolean
        {
            var loc2:*=null;
            var loc3:*=0;
            var loc4:*=null;
            this._target = arg1;
            this._tween = arg3;
            this._type = arg4;
            var loc1:*=this._target.filters;
            var loc5:*;
            if ((loc5 = arg2 is flash.filters.BitmapFilter ? {} : arg2).index == null) 
            {
                this._index = loc1.length;
                if (loc5.addFilter != true) 
                {
                    do 
                    {
                        var loc6:*;
                        var loc7:*;
                    }
                    while ((loc6._index = loc7 = ((loc6 = this)._index - 1)) > -1 && !(loc1[this._index] is this._type));
                }
            }
            else 
            {
                this._index = loc5.index;
            }
            if (this._index < 0 || !(loc1[this._index] is this._type)) 
            {
                if (this._index < 0) 
                {
                    this._index = loc1.length;
                }
                if (this._index > loc1.length) 
                {
                    loc3 = (loc1.length - 1);
                    while (++loc3 < this._index) 
                    {
                        loc1[loc3] = new flash.filters.BlurFilter(0, 0, 1);
                    }
                }
                loc1[this._index] = arg5;
                this._target.filters = loc1;
            }
            this._filter = loc1[this._index];
            this._remove = loc5.remove == true;
            loc3 = arg6.length;
            while (--loc3 > -1) 
            {
                if (!((loc2 = arg6[loc3]) in arg2 && !(this._filter[loc2] == arg2[loc2]))) 
                {
                    continue;
                }
                if (loc2 == "color" || loc2 == "highlightColor" || loc2 == "shadowColor") 
                {
                    (loc4 = new mgs.greensock.plugins.HexColorsPlugin())._initColor(this._filter, loc2, arg2[loc2]);
                    _addTween(loc4, "setRatio", 0, 1, _propName);
                    continue;
                }
                if (loc2 == "quality" || loc2 == "inner" || loc2 == "knockout" || loc2 == "hideObject") 
                {
                    this._filter[loc2] = arg2[loc2];
                    continue;
                }
                _addTween(this._filter, loc2, this._filter[loc2], arg2[loc2], _propName);
            }
            return true;
        }

        public override function setRatio(arg1:Number):void
        {
            super.setRatio(arg1);
            var loc1:*=this._target.filters;
            if (!(loc1[this._index] is this._type)) 
            {
                this._index = loc1.length;
                do 
                {
                    var loc2:*;
                    var loc3:*;
                }
                while ((loc2._index = loc3 = ((loc2 = this)._index - 1)) > -1 && !(loc1[this._index] is this._type));
                if (this._index == -1) 
                {
                    this._index = loc1.length;
                }
            }
            if (arg1 == 1 && this._remove && this._tween._time == this._tween._duration) 
            {
                if (this._index < loc1.length) 
                {
                    loc1.splice(this._index, 1);
                }
            }
            else 
            {
                loc1[this._index] = this._filter;
            }
            this._target.filters = loc1;
            return;
        }

        public static const API:Number=2;

        protected var _target:Object;

        protected var _type:Class;

        protected var _filter:flash.filters.BitmapFilter;

        protected var _index:int;

        protected var _remove:Boolean;

        internal var _tween:mgs.greensock.TweenLite;
    }
}


//        class HexColorsPlugin
package mgs.greensock.plugins 
{
    import mgs.greensock.*;
    
    public class HexColorsPlugin extends mgs.greensock.plugins.TweenPlugin
    {
        public function HexColorsPlugin()
        {
            super("hexColors");
            _overwriteProps = [];
            this._colors = [];
            return;
        }

        public override function _onInitTween(arg1:Object, arg2:*, arg3:mgs.greensock.TweenLite):Boolean
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=arg2;
            for (loc1 in loc3) 
            {
                this._initColor(arg1, loc1, uint(arg2[loc1]));
            }
            return true;
        }

        public function _initColor(arg1:Object, arg2:String, arg3:uint):void
        {
            var loc3:*=0;
            var loc4:*=0;
            var loc5:*=0;
            var loc1:*;
            if (loc1 = typeof arg1[arg2] == "function") 
            {
                var loc6:*;
            }
            var loc2:*=undefined;
            if (undefined != arg3) 
            {
                loc3 = loc2 >> 16;
                loc4 = loc2 >> 8 & 255;
                loc5 = loc2 & 255;
                this._colors[this._colors.length] = new ColorProp(arg1, arg2, loc1, loc3, (arg3 >> 16) - loc3, loc4, (arg3 >> 8 & 255) - loc4, loc5, (arg3 & 255) - loc5);
                _overwriteProps[_overwriteProps.length] = arg2;
            }
            return;
        }

        public override function _kill(arg1:Object):Boolean
        {
            var loc1:*=this._colors.length;
            while (loc1--) 
            {
                if (arg1[this._colors[loc1].p] == null) 
                {
                    continue;
                }
                this._colors.splice(loc1, 1);
            }
            return super._kill(arg1);
        }

        public override function setRatio(arg1:Number):void
        {
            var loc2:*=null;
            var loc3:*=NaN;
            var loc1:*=this._colors.length;
            while (--loc1 > -1) 
            {
                loc2 = this._colors[loc1];
                loc3 = loc2.rs + arg1 * loc2.rc << 16 | loc2.gs + arg1 * loc2.gc << 8 | loc2.bs + arg1 * loc2.bc;
                if (loc2.f) 
                {
                    var loc4:*;
                    (loc4 = loc2.t)[loc2.p](loc3);
                    continue;
                }
                loc2.t[loc2.p] = loc3;
            }
            return;
        }

        public static const API:Number=2;

        protected var _colors:Array;
    }
}


class ColorProp extends Object
{
    public function ColorProp(arg1:Object, arg2:String, arg3:Boolean, arg4:int, arg5:int, arg6:int, arg7:int, arg8:int, arg9:int)
    {
        super();
        this.t = arg1;
        this.p = arg2;
        this.f = arg3;
        this.rs = arg4;
        this.rc = arg5;
        this.gs = arg6;
        this.gc = arg7;
        this.bs = arg8;
        this.bc = arg9;
        return;
    }

    public var t:Object;

    public var p:String;

    public var f:Boolean;

    public var rs:int;

    public var rc:int;

    public var gs:int;

    public var gc:int;

    public var bs:int;

    public var bc:int;
}

//        class ShortRotationPlugin
package mgs.greensock.plugins 
{
    import mgs.greensock.*;
    
    public class ShortRotationPlugin extends mgs.greensock.plugins.TweenPlugin
    {
        public function ShortRotationPlugin()
        {
            super("shortRotation");
            _overwriteProps.pop();
            return;
        }

        public override function _onInitTween(arg1:Object, arg2:*, arg3:mgs.greensock.TweenLite):Boolean
        {
            var loc2:*=NaN;
            var loc3:*=null;
            if (typeof arg2 == "number") 
            {
                return false;
            }
            var loc1:*=Boolean(arg2.useRadians == true);
            var loc4:*=0;
            var loc5:*=arg2;
            for (loc3 in loc5) 
            {
                if (loc3 == "useRadians") 
                {
                    continue;
                }
                if (arg1[loc3] is Function) 
                {
                    var loc6:*;
                }
                loc2 = undefined;
                this._initRotation(arg1, loc3, loc2, typeof arg2[loc3] != "number" ? loc2 + Number(arg2[loc3].split("=").join("")) : Number(arg2[loc3]), loc1);
            }
            return true;
        }

        public function _initRotation(arg1:Object, arg2:String, arg3:Number, arg4:Number, arg5:Boolean=false):void
        {
            var loc1:*=arg5 ? Math.PI * 2 : 360;
            var loc2:*=(arg4 - arg3) % loc1;
            if (loc2 != loc2 % (loc1 / 2)) 
            {
                loc2 = loc2 < 0 ? loc2 + loc1 : loc2 - loc1;
            }
            _addTween(arg1, arg2, arg3, arg3 + loc2, arg2);
            _overwriteProps[_overwriteProps.length] = arg2;
            return;
        }

        public static const API:Number=2;
    }
}


//        class TintPlugin
package mgs.greensock.plugins 
{
    import flash.display.*;
    import flash.geom.*;
    import mgs.greensock.*;
    import mgs.greensock.core.*;
    
    public class TintPlugin extends mgs.greensock.plugins.TweenPlugin
    {
        public function TintPlugin()
        {
            super("tint,colorTransform,removeTint");
            return;
        }

        public override function _onInitTween(arg1:Object, arg2:*, arg3:mgs.greensock.TweenLite):Boolean
        {
            if (!(arg1 is flash.display.DisplayObject)) 
            {
                return false;
            }
            var loc1:*=new flash.geom.ColorTransform();
            if (!(arg2 == null) && !(arg3.vars.removeTint == true)) 
            {
                loc1.color = uint(arg2);
            }
            this._transform = flash.display.DisplayObject(arg1).transform;
            var loc2:*=this._transform.colorTransform;
            loc1.alphaMultiplier = loc2.alphaMultiplier;
            loc1.alphaOffset = loc2.alphaOffset;
            this._init(loc2, loc1);
            return true;
        }

        public function _init(arg1:flash.geom.ColorTransform, arg2:flash.geom.ColorTransform):void
        {
            var loc2:*=null;
            var loc1:*=_props.length;
            while (--loc1 > -1) 
            {
                loc2 = _props[loc1];
                if (arg1[loc2] == arg2[loc2]) 
                {
                    continue;
                }
                _addTween(arg1, loc2, arg1[loc2], arg2[loc2], "tint");
            }
            return;
        }

        public override function setRatio(arg1:Number):void
        {
            var loc1:*=this._transform.colorTransform;
            var loc2:*=_firstPT;
            while (loc2) 
            {
                loc1[loc2.p] = loc2.c * arg1 + loc2.s;
                loc2 = loc2._next;
            }
            this._transform.colorTransform = loc1;
            return;
        }

        
        {
            _props = ["redMultiplier", "greenMultiplier", "blueMultiplier", "alphaMultiplier", "redOffset", "greenOffset", "blueOffset", "alphaOffset"];
        }

        public static const API:Number=2;

        protected var _transform:flash.geom.Transform;

        protected static var _props:Array;
    }
}


//        class TransformAroundPointPlugin
package mgs.greensock.plugins 
{
    import flash.display.*;
    import flash.geom.*;
    import flash.utils.*;
    import mgs.greensock.*;
    
    public class TransformAroundPointPlugin extends mgs.greensock.plugins.TweenPlugin
    {
        public function TransformAroundPointPlugin()
        {
            super("transformAroundPoint,transformAroundCenter,x,y", -1);
            return;
        }

        public override function _onInitTween(arg1:Object, arg2:*, arg3:mgs.greensock.TweenLite):Boolean
        {
            var target:Object;
            var value:*;
            var tween:mgs.greensock.TweenLite;
            var p:String;
            var short:mgs.greensock.plugins.ShortRotationPlugin;
            var sp:String;
            var m:flash.geom.Matrix;
            var point:flash.geom.Point;
            var b:flash.geom.Rectangle;
            var s:flash.display.Sprite;
            var container:flash.display.Sprite;
            var enumerables:Object;
            var endX:Number;
            var endY:Number;

            var loc1:*;
            p = null;
            short = null;
            sp = null;
            m = null;
            point = null;
            b = null;
            s = null;
            container = null;
            enumerables = null;
            endX = NaN;
            endY = NaN;
            target = arg1;
            value = arg2;
            tween = arg3;
            if (!(value.point is flash.geom.Point)) 
            {
                return false;
            }
            this._target = target as flash.display.DisplayObject;
            if (value.pointIsLocal != true) 
            {
                this._point = value.point.clone();
                this._local = this._target.globalToLocal(this._target.parent.localToGlobal(this._point));
            }
            else 
            {
                this._pointIsLocal = true;
                this._local = value.point.clone();
                this._point = this._target.parent.globalToLocal(this._target.localToGlobal(this._local));
            }
            if (!_classInitted) 
            {
                try 
                {
                    _isFlex = Boolean(flash.utils.getDefinitionByName("mx.managers.SystemManager"));
                }
                catch (e:Error)
                {
                    _isFlex = false;
                }
                _classInitted = true;
            }
            if ((!isNaN(value.width) || !isNaN(value.height)) && !(this._target.parent == null)) 
            {
                m = this._target.transform.matrix;
                point = this._target.parent.globalToLocal(this._target.localToGlobal(new flash.geom.Point(100, 100)));
                this._target.width = this._target.width * 2;
                if (point.x != this._target.parent.globalToLocal(this._target.localToGlobal(new flash.geom.Point(100, 100))).x) 
                {
                    this._target.width = this._target.width / 2;
                    this._target.transform.matrix = m;
                }
                else 
                {
                    this._proxy = this._target;
                    this._target.rotation = 0;
                    this._proxySizeData = {};
                    if (!isNaN(value.width)) 
                    {
                        _addTween(this._proxySizeData, "width", this._target.width / 2, value.width, "width");
                    }
                    if (!isNaN(value.height)) 
                    {
                        _addTween(this._proxySizeData, "height", this._target.height, value.height, "height");
                    }
                    b = this._target.getBounds(this._target);
                    s = new flash.display.Sprite();
                    container = _isFlex ? new (flash.utils.getDefinitionByName("mx.core.UIComponent"))() : new flash.display.Sprite();
                    container.addChild(s);
                    container.visible = false;
                    this._useAddElement = Boolean(_isFlex && this._proxy.parent.hasOwnProperty("addElement"));
                    if (this._useAddElement) 
                    {
                        Object(this._proxy.parent).addElement(container);
                    }
                    else 
                    {
                        this._proxy.parent.addChild(container);
                    }
                    this._target = s;
                    s.graphics.beginFill(255, 0.4);
                    s.graphics.drawRect(b.x, b.y, b.width, b.height);
                    s.graphics.endFill();
                    this._proxy.width = this._proxy.width / 2;
                    this._target.transform.matrix = loc2 = m;
                    s.transform.matrix = loc2;
                }
            }
            loc2 = 0;
            var loc3:*=value;
            for (p in loc3) 
            {
                if (p == "point" || p == "pointIsLocal") 
                {
                    continue;
                }
                if (p == "shortRotation") 
                {
                    this._shortRotation = new mgs.greensock.plugins.ShortRotationPlugin();
                    this._shortRotation._onInitTween(this._target, value[p], tween);
                    _addTween(this._shortRotation, "setRatio", 0, 1, "shortRotation");
                    var loc4:*=0;
                    var loc5:*=value[p];
                    for (sp in loc5) 
                    {
                        _overwriteProps[_overwriteProps.length] = sp;
                    }
                    continue;
                }
                if (p == "x" || p == "y") 
                {
                    _addTween(this._point, p, this._point[p], value[p], p);
                    continue;
                }
                if (p == "scale") 
                {
                    _addTween(this._target, "scaleX", this._target.scaleX, value.scale, "scaleX");
                    _addTween(this._target, "scaleY", this._target.scaleY, value.scale, "scaleY");
                    _overwriteProps[_overwriteProps.length] = "scaleX";
                    _overwriteProps[_overwriteProps.length] = "scaleY";
                    continue;
                }
                if ((p == "width" || p == "height") && !(this._proxy == null)) 
                {
                    continue;
                }
                _addTween(this._target, p, this._target[p], value[p], p);
                _overwriteProps[_overwriteProps.length] = p;
            }
            if (tween != null) 
            {
                enumerables = tween.vars;
                if ("x" in enumerables || "y" in enumerables) 
                {
                    if ("x" in enumerables) 
                    {
                        endX = typeof enumerables.x != "number" ? this._target.x + Number(enumerables.x.split("=").join("")) : enumerables.x;
                    }
                    if ("y" in enumerables) 
                    {
                        endY = typeof enumerables.y != "number" ? this._target.y + Number(enumerables.y.split("=").join("")) : enumerables.y;
                    }
                    tween._kill({"x":true, "y":true, "_tempKill":true}, this._target);
                    this.setRatio(1);
                    if (!isNaN(endX)) 
                    {
                        _addTween(this._point, "x", this._point.x, this._point.x + (endX - this._target.x), "x");
                    }
                    if (!isNaN(endY)) 
                    {
                        _addTween(this._point, "y", this._point.y, this._point.y + (endY - this._target.y), "y");
                    }
                    this.setRatio(0);
                }
            }
            return true;
        }

        public override function _kill(arg1:Object):Boolean
        {
            if (this._shortRotation != null) 
            {
                this._shortRotation._kill(arg1);
                if (this._shortRotation._overwriteProps.length == 0) 
                {
                    arg1.shortRotation = true;
                }
            }
            return super._kill(arg1);
        }

        public override function _roundProps(arg1:Object, arg2:Boolean=true):void
        {
            if ("transformAroundPoint" in arg1) 
            {
                var loc1:*;
                this._yRound = loc1 = arg2;
                this._xRound = loc1;
            }
            else if ("x" in arg1) 
            {
                this._xRound = arg2;
            }
            else if ("y" in arg1) 
            {
                this._yRound = arg2;
            }
            return;
        }

        public override function setRatio(arg1:Number):void
        {
            var loc1:*=null;
            var loc2:*=NaN;
            var loc3:*=NaN;
            if (!(this._proxy == null) && !(this._proxy.parent == null)) 
            {
                if (this._useAddElement) 
                {
                    Object(this._proxy.parent).addElement(this._target.parent);
                }
                else 
                {
                    this._proxy.parent.addChild(this._target.parent);
                }
            }
            if (this._pointIsLocal && this._target.parent) 
            {
                loc1 = this._target.parent.globalToLocal(this._target.localToGlobal(this._local));
                if (Math.abs(loc1.x - this._point.x) > 0.5 || Math.abs(loc1.y - this._point.y) > 0.5) 
                {
                    this._point = loc1;
                }
            }
            super.setRatio(arg1);
            if (this._target.parent) 
            {
                loc1 = this._target.parent.globalToLocal(this._target.localToGlobal(this._local));
                if (this._xRound) 
                {
                    var loc4:*;
                    loc2 = loc4 = this._target.x + this._point.x - loc1.x;
                }
                undefined.x = this._target;
                if (this._yRound) 
                {
                    loc2 = loc4 = this._target.y + this._point.y - loc1.y;
                }
                undefined.y = this._target;
            }
            if (!(this._proxy == null) && !(this._proxy.parent == null)) 
            {
                loc3 = this._target.rotation;
                this._target.rotation = loc4 = 0;
                this._proxy.rotation = loc4;
                if (this._proxySizeData.width != null) 
                {
                    this._target.width = loc4 = this._proxySizeData.width;
                    this._proxy.width = loc4;
                }
                if (this._proxySizeData.height != null) 
                {
                    this._target.height = loc4 = this._proxySizeData.height;
                    this._proxy.height = loc4;
                }
                this._target.rotation = loc4 = loc3;
                this._proxy.rotation = loc4;
                loc1 = this._target.parent.globalToLocal(this._target.localToGlobal(this._local));
                if (this._xRound) 
                {
                    loc2 = loc4 = this._target.x + this._point.x - loc1.x;
                }
                undefined.x = this._proxy;
                if (this._yRound) 
                {
                    loc2 = loc4 = this._target.y + this._point.y - loc1.y;
                }
                undefined.y = this._proxy;
                if (this._useAddElement) 
                {
                    Object(this._proxy.parent).removeElement(this._target.parent);
                }
                else 
                {
                    this._proxy.parent.removeChild(this._target.parent);
                }
            }
            return;
        }

        public static const API:Number=2;

        protected var _target:flash.display.DisplayObject;

        protected var _local:flash.geom.Point;

        protected var _point:flash.geom.Point;

        protected var _shortRotation:mgs.greensock.plugins.ShortRotationPlugin;

        protected var _pointIsLocal:Boolean;

        protected var _proxy:flash.display.DisplayObject;

        protected var _proxySizeData:Object;

        protected var _useAddElement:Boolean;

        protected var _xRound:Boolean;

        protected var _yRound:Boolean;

        internal static var _classInitted:Boolean;

        internal static var _isFlex:Boolean;
    }
}


//        class TransformMatrixPlugin
package mgs.greensock.plugins 
{
    import flash.geom.*;
    import mgs.greensock.*;
    
    public class TransformMatrixPlugin extends mgs.greensock.plugins.TweenPlugin
    {
        public function TransformMatrixPlugin()
        {
            super("transformMatrix,x,y,scaleX,scaleY,rotation,width,height,transformAroundPoint,transformAroundCenter");
            return;
        }

        public override function _onInitTween(arg1:Object, arg2:*, arg3:mgs.greensock.TweenLite):Boolean
        {
            var loc2:*=NaN;
            var loc3:*=NaN;
            var loc4:*=NaN;
            var loc5:*=NaN;
            var loc6:*=NaN;
            var loc7:*=NaN;
            var loc8:*=NaN;
            var loc9:*=NaN;
            var loc10:*=NaN;
            var loc11:*=NaN;
            this._transform = arg1.transform as flash.geom.Transform;
            this._matrix = this._transform.matrix;
            var loc1:*=this._matrix.clone();
            this._txStart = loc1.tx;
            this._tyStart = loc1.ty;
            this._aStart = loc1.a;
            this._bStart = loc1.b;
            this._cStart = loc1.c;
            this._dStart = loc1.d;
            if ("x" in arg2) 
            {
                this._txChange = typeof arg2.x != "number" ? Number(arg2.x.split("=").join("")) : arg2.x - this._txStart;
            }
            else if ("tx" in arg2) 
            {
                this._txChange = arg2.tx - this._txStart;
            }
            else 
            {
                this._txChange = 0;
            }
            if ("y" in arg2) 
            {
                this._tyChange = typeof arg2.y != "number" ? Number(arg2.y.split("=").join("")) : arg2.y - this._tyStart;
            }
            else if ("ty" in arg2) 
            {
                this._tyChange = arg2.ty - this._tyStart;
            }
            else 
            {
                this._tyChange = 0;
            }
            this._aChange = "a" in arg2 ? arg2.a - this._aStart : 0;
            this._bChange = "b" in arg2 ? arg2.b - this._bStart : 0;
            this._cChange = "c" in arg2 ? arg2.c - this._cStart : 0;
            this._dChange = "d" in arg2 ? arg2.d - this._dStart : 0;
            if ("rotation" in arg2 || "shortRotation" in arg2 || "scale" in arg2 && !(arg2 is flash.geom.Matrix) || "scaleX" in arg2 || "scaleY" in arg2 || "skewX" in arg2 || "skewY" in arg2 || "skewX2" in arg2 || "skewY2" in arg2) 
            {
                if ((loc4 = Math.sqrt(loc1.a * loc1.a + loc1.b * loc1.b)) != 0) 
                {
                    if (loc1.a < 0 && loc1.d > 0) 
                    {
                        loc4 = -loc4;
                    }
                }
                else 
                {
                    var loc12:*;
                    loc4 = loc12 = 0.0001;
                    loc1.a = loc12;
                }
                if ((loc5 = Math.sqrt(loc1.c * loc1.c + loc1.d * loc1.d)) != 0) 
                {
                    if (loc1.d < 0 && loc1.a > 0) 
                    {
                        loc5 = -loc5;
                    }
                }
                else 
                {
                    loc5 = loc12 = 0.0001;
                    loc1.d = loc12;
                }
                loc6 = Math.atan2(loc1.b, loc1.a);
                if (loc1.a < 0 && loc1.d >= 0) 
                {
                    loc6 = loc6 + (loc6 <= 0 ? Math.PI : -Math.PI);
                }
                loc7 = Math.atan2(-this._matrix.c, this._matrix.d) - loc6;
                loc8 = loc6;
                if ("shortRotation" in arg2) 
                {
                    if ((loc10 = (arg2.shortRotation * _DEG2RAD - loc6) % (Math.PI * 2)) > Math.PI) 
                    {
                        loc10 = loc10 - Math.PI * 2;
                    }
                    else if (loc10 < -Math.PI) 
                    {
                        loc10 = loc10 + Math.PI * 2;
                    }
                    loc8 = loc8 + loc10;
                }
                else if ("rotation" in arg2) 
                {
                    loc8 = typeof arg2.rotation != "number" ? Number(arg2.rotation.split("=").join("")) * _DEG2RAD + loc6 : arg2.rotation * _DEG2RAD;
                }
                loc9 = "skewX" in arg2 ? typeof arg2.skewX != "number" ? Number(arg2.skewX.split("=").join("")) * _DEG2RAD + loc7 : Number(arg2.skewX) * _DEG2RAD : 0;
                if ("skewY" in arg2) 
                {
                    loc11 = typeof arg2.skewY != "number" ? Number(arg2.skewY.split("=").join("")) * _DEG2RAD - loc7 : arg2.skewY * _DEG2RAD;
                    loc8 = loc8 + (loc11 + loc7);
                    loc9 = loc9 - loc11;
                }
                if (loc8 != loc6) 
                {
                    if ("rotation" in arg2 || "shortRotation" in arg2) 
                    {
                        this._angleChange = loc8 - loc6;
                        loc8 = loc6;
                    }
                    else 
                    {
                        loc1.rotate(loc8 - loc6);
                    }
                }
                if ("scale" in arg2) 
                {
                    loc2 = Number(arg2.scale) / loc4;
                    loc3 = Number(arg2.scale) / loc5;
                    if (typeof arg2.scale != "number") 
                    {
                        loc2 = loc2 + 1;
                        loc3 = loc3 + 1;
                    }
                }
                else 
                {
                    if ("scaleX" in arg2) 
                    {
                        loc2 = Number(arg2.scaleX) / loc4;
                        if (typeof arg2.scaleX != "number") 
                        {
                            loc2 = loc2 + 1;
                        }
                    }
                    if ("scaleY" in arg2) 
                    {
                        loc3 = Number(arg2.scaleY) / loc5;
                        if (typeof arg2.scaleY != "number") 
                        {
                            loc3 = loc3 + 1;
                        }
                    }
                }
                if (loc9 != loc7) 
                {
                    loc1.c = (-loc5) * Math.sin(loc9 + loc8);
                    loc1.d = loc5 * Math.cos(loc9 + loc8);
                }
                if ("skewX2" in arg2) 
                {
                    if (typeof arg2.skewX2 != "number") 
                    {
                        loc1.c = loc1.c + Math.tan(0 - Number(arg2.skewX2) * _DEG2RAD);
                    }
                    else 
                    {
                        loc1.c = Math.tan(0 - arg2.skewX2 * _DEG2RAD);
                    }
                }
                if ("skewY2" in arg2) 
                {
                    if (typeof arg2.skewY2 != "number") 
                    {
                        loc1.b = loc1.b + Math.tan(Number(arg2.skewY2) * _DEG2RAD);
                    }
                    else 
                    {
                        loc1.b = Math.tan(arg2.skewY2 * _DEG2RAD);
                    }
                }
                if (loc2 || loc2 == 0) 
                {
                    loc1.a = loc1.a * loc2;
                    loc1.b = loc1.b * loc2;
                }
                if (loc3 || loc3 == 0) 
                {
                    loc1.c = loc1.c * loc3;
                    loc1.d = loc1.d * loc3;
                }
                this._aChange = loc1.a - this._aStart;
                this._bChange = loc1.b - this._bStart;
                this._cChange = loc1.c - this._cStart;
                this._dChange = loc1.d - this._dStart;
            }
            return true;
        }

        public override function setRatio(arg1:Number):void
        {
            var loc1:*=NaN;
            var loc2:*=NaN;
            var loc3:*=NaN;
            var loc4:*=NaN;
            this._matrix.a = this._aStart + arg1 * this._aChange;
            this._matrix.b = this._bStart + arg1 * this._bChange;
            this._matrix.c = this._cStart + arg1 * this._cChange;
            this._matrix.d = this._dStart + arg1 * this._dChange;
            if (this._angleChange) 
            {
                loc1 = Math.cos(this._angleChange * arg1);
                loc2 = Math.sin(this._angleChange * arg1);
                loc3 = this._matrix.a;
                loc4 = this._matrix.c;
                this._matrix.a = loc3 * loc1 - this._matrix.b * loc2;
                this._matrix.b = loc3 * loc2 + this._matrix.b * loc1;
                this._matrix.c = loc4 * loc1 - this._matrix.d * loc2;
                this._matrix.d = loc4 * loc2 + this._matrix.d * loc1;
            }
            this._matrix.tx = this._txStart + arg1 * this._txChange;
            this._matrix.ty = this._tyStart + arg1 * this._tyChange;
            this._transform.matrix = this._matrix;
            return;
        }

        public static const API:Number=2;

        internal static const _DEG2RAD:Number=Math.PI / 180;

        protected var _transform:flash.geom.Transform;

        protected var _matrix:flash.geom.Matrix;

        protected var _txStart:Number;

        protected var _txChange:Number;

        protected var _tyStart:Number;

        protected var _tyChange:Number;

        protected var _aStart:Number;

        protected var _aChange:Number;

        protected var _bStart:Number;

        protected var _bChange:Number;

        protected var _cStart:Number;

        protected var _cChange:Number;

        protected var _dStart:Number;

        protected var _dChange:Number;

        protected var _angleChange:Number=0;
    }
}


//        class TweenPlugin
package mgs.greensock.plugins 
{
    import mgs.greensock.*;
    import mgs.greensock.core.*;
    
    public class TweenPlugin extends Object
    {
        public function TweenPlugin(arg1:String="", arg2:int=0)
        {
            super();
            this._overwriteProps = arg1.split(",");
            this._propName = this._overwriteProps[0];
            this._priority = arg2 || 0;
            return;
        }

        public function _onInitTween(arg1:Object, arg2:*, arg3:mgs.greensock.TweenLite):Boolean
        {
            return false;
        }

        protected function _addTween(arg1:Object, arg2:String, arg3:Number, arg4:*, arg5:String=null, arg6:Boolean=false):mgs.greensock.core.PropTween
        {
            var loc1:*=NaN;
            if (!(arg4 == null)) 
            {
                !(arg4 == null);
                var loc2:*;
                loc1 = loc2 = typeof arg4 === "number" || !(arg4.charAt(1) === "=") ? Number(arg4) - arg3 : int(arg4.charAt(0) + "1") * Number(arg4.substr(2));
            }
            if (!(arg4 == null)) 
            {
                this._firstPT = new mgs.greensock.core.PropTween(arg1, arg2, arg3, loc1, arg5 || arg2, false, this._firstPT);
                this._firstPT.r = arg6;
                return this._firstPT;
            }
            return null;
        }

        public function setRatio(arg1:Number):void
        {
            var loc2:*=NaN;
            var loc1:*=this._firstPT;
            while (loc1) 
            {
                loc2 = loc1.c * arg1 + loc1.s;
                if (loc1.r) 
                {
                    loc2 = loc2 + (loc2 > 0 ? 0.5 : -0.5) | 0;
                }
                if (loc1.f) 
                {
                    var loc3:*;
                    (loc3 = loc1.t)[loc1.p](loc2);
                }
                else 
                {
                    loc1.t[loc1.p] = loc2;
                }
                loc1 = loc1._next;
            }
            return;
        }

        public function _roundProps(arg1:Object, arg2:Boolean=true):void
        {
            var loc1:*=this._firstPT;
            while (loc1) 
            {
                if (this._propName in arg1 || !(loc1.n == null) && loc1.n.split(this._propName + "_").join("") in arg1) 
                {
                    loc1.r = arg2;
                }
                loc1 = loc1._next;
            }
            return;
        }

        public function _kill(arg1:Object):Boolean
        {
            var loc2:*=0;
            if (this._propName in arg1) 
            {
                this._overwriteProps = [];
            }
            else 
            {
                loc2 = this._overwriteProps.length;
                while (--loc2 > -1) 
                {
                    if (!(this._overwriteProps[loc2] in arg1)) 
                    {
                        continue;
                    }
                    this._overwriteProps.splice(loc2, 1);
                }
            }
            var loc1:*=this._firstPT;
            while (loc1) 
            {
                if (loc1.n in arg1) 
                {
                    if (loc1._next) 
                    {
                        loc1._next._prev = loc1._prev;
                    }
                    if (loc1._prev) 
                    {
                        loc1._prev._next = loc1._next;
                        loc1._prev = null;
                    }
                    else if (this._firstPT == loc1) 
                    {
                        this._firstPT = loc1._next;
                    }
                }
                loc1 = loc1._next;
            }
            return false;
        }

        internal static function _onTweenEvent(arg1:String, arg2:mgs.greensock.TweenLite):Boolean
        {
            var loc2:*=false;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=null;
            var loc1:*=arg2._firstPT;
            if (arg1 == "_onInitAllProps") 
            {
                while (loc1) 
                {
                    loc6 = loc1._next;
                    loc3 = loc4;
                    while (loc3 && loc3.pr > loc1.pr) 
                    {
                        loc3 = loc3._next;
                    }
                    var loc7:*;
                    loc1._prev = loc7 = loc3 ? loc3._prev : loc5;
                    if (loc7) 
                    {
                        loc1._prev._next = loc1;
                    }
                    else 
                    {
                        loc4 = loc1;
                    }
                    loc1._next = loc7 = loc3;
                    if (loc7) 
                    {
                        loc3._prev = loc1;
                    }
                    else 
                    {
                        loc5 = loc1;
                    }
                    loc1 = loc6;
                }
                arg2._firstPT = loc7 = loc4;
                loc1 = loc7;
            }
            while (loc1) 
            {
                if (loc1.pg) 
                {
                    if (arg1 in loc1.t) 
                    {
                        if ((loc7 = loc1.t)[arg1]()) 
                        {
                            loc2 = true;
                        }
                    }
                }
                loc1 = loc1._next;
            }
            return loc2;
        }

        public static function activate(arg1:Array):Boolean
        {
            mgs.greensock.TweenLite._onPluginEvent = mgs.greensock.plugins.TweenPlugin._onTweenEvent;
            var loc1:*=arg1.length;
            while (--loc1 > -1) 
            {
                if (arg1[loc1].API != mgs.greensock.plugins.TweenPlugin.API) 
                {
                    continue;
                }
                mgs.greensock.TweenLite._plugins[new (arg1[loc1] as Class)()._propName] = arg1[loc1];
            }
            return true;
        }

        public static const version:String="12.0.13";

        public static const API:Number=2;

        public var _propName:String;

        public var _overwriteProps:Array;

        public var _priority:int=0;

        protected var _firstPT:mgs.greensock.core.PropTween;
    }
}


//      class TweenLite
package mgs.greensock 
{
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.greensock.core.*;
    import mgs.greensock.easing.*;
    
    public class TweenLite extends mgs.greensock.core.Animation
    {
        public function TweenLite(arg1:Object, arg2:Number, arg3:Object)
        {
            var loc1:*=0;
            super(arg2, arg3);
            if (arg1 == null) 
            {
                throw new Error("Cannot tween a null object. Duration: " + arg2 + ", data: " + this.data);
            }
            if (!_overwriteLookup) 
            {
                _overwriteLookup = {"none":0, "all":1, "auto":2, "concurrent":3, "allOnStart":4, "preexisting":5, "true":1, "false":0};
                ticker.addEventListener("enterFrame", _dumpGarbage, false, -1, true);
            }
            this.ratio = 0;
            this.target = arg1;
            this._ease = defaultEase;
            this._overwrite = "overwrite" in this.vars ? typeof this.vars.overwrite !== "number" ? _overwriteLookup[this.vars.overwrite] : this.vars.overwrite >> 0 : _overwriteLookup[defaultOverwrite];
            if (this.target is Array && typeof this.target[0] === "object") 
            {
                this._targets = this.target.concat();
                this._propLookup = [];
                this._siblings = [];
                loc1 = this._targets.length;
                while (--loc1 > -1) 
                {
                    this._siblings[loc1] = _register(this._targets[loc1], this, false);
                    if (this._overwrite != 1) 
                    {
                        continue;
                    }
                    if (!(this._siblings[loc1].length > 1)) 
                    {
                        continue;
                    }
                    _applyOverwrite(this._targets[loc1], this, null, 1, this._siblings[loc1]);
                }
            }
            else 
            {
                this._propLookup = {};
                this._siblings = _tweenLookup[arg1];
                if (this._siblings != null) 
                {
                    this._siblings[this._siblings.length] = this;
                    if (this._overwrite == 1) 
                    {
                        _applyOverwrite(arg1, this, null, 1, this._siblings);
                    }
                }
                else 
                {
                    var loc2:*;
                    _tweenLookup[arg1] = loc2 = [this];
                    this._siblings = loc2;
                }
            }
            if (this.vars.immediateRender || arg2 == 0 && _delay == 0 && !(this.vars.immediateRender == false)) 
            {
                this.render(-_delay, false, true);
            }
            return;
        }

        public override function render(arg1:Number, arg2:Boolean=false, arg3:Boolean=false):void
        {
            var loc1:*=false;
            var loc2:*=null;
            var loc3:*=null;
            var loc5:*=NaN;
            var loc4:*=_time;
            if (arg1 >= _duration) 
            {
                var loc6:*;
                _time = loc6 = _duration;
                _totalTime = loc6;
                this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1;
                if (!_reversed) 
                {
                    loc1 = true;
                    loc2 = "onComplete";
                }
                if (_duration == 0) 
                {
                    if (arg1 == 0 || _rawPrevTime < 0) 
                    {
                        if (_rawPrevTime != arg1) 
                        {
                            arg3 = true;
                            if (_rawPrevTime > 0) 
                            {
                                loc2 = "onReverseComplete";
                                if (arg2) 
                                {
                                    arg1 = -1;
                                }
                            }
                        }
                    }
                    _rawPrevTime = arg1;
                }
            }
            else if (arg1 < 1e-007) 
            {
                _time = loc6 = 0;
                _totalTime = loc6;
                this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0;
                if (!(loc4 == 0) || _duration == 0 && _rawPrevTime > 0) 
                {
                    loc2 = "onReverseComplete";
                    loc1 = _reversed;
                }
                if (arg1 < 0) 
                {
                    _active = false;
                    if (_duration == 0) 
                    {
                        if (_rawPrevTime >= 0) 
                        {
                            arg3 = true;
                        }
                        _rawPrevTime = arg1;
                    }
                }
                else if (!_initted) 
                {
                    arg3 = true;
                }
            }
            else 
            {
                _time = loc6 = arg1;
                _totalTime = loc6;
                if (this._easeType) 
                {
                    loc5 = arg1 / _duration;
                    if (this._easeType == 1 || this._easeType == 3 && loc5 >= 0.5) 
                    {
                        loc5 = 1 - loc5;
                    }
                    if (this._easeType == 3) 
                    {
                        loc5 = loc5 * 2;
                    }
                    if (this._easePower != 1) 
                    {
                        if (this._easePower != 2) 
                        {
                            if (this._easePower != 3) 
                            {
                                if (this._easePower == 4) 
                                {
                                    loc5 = loc5 * loc5 * loc5 * loc5 * loc5;
                                }
                            }
                            else 
                            {
                                loc5 = loc5 * loc5 * loc5 * loc5;
                            }
                        }
                        else 
                        {
                            loc5 = loc5 * loc5 * loc5;
                        }
                    }
                    else 
                    {
                        loc5 = loc5 * loc5;
                    }
                    if (this._easeType != 1) 
                    {
                        if (this._easeType != 2) 
                        {
                            if (arg1 / _duration < 0.5) 
                            {
                                this.ratio = loc5 / 2;
                            }
                            else 
                            {
                                this.ratio = 1 - loc5 / 2;
                            }
                        }
                        else 
                        {
                            this.ratio = loc5;
                        }
                    }
                    else 
                    {
                        this.ratio = 1 - loc5;
                    }
                }
                else 
                {
                    this.ratio = this._ease.getRatio(arg1 / _duration);
                }
            }
            if (_time == loc4 && !arg3) 
            {
                return;
            }
            if (!_initted) 
            {
                this._init();
                if (!_initted) 
                {
                    return;
                }
                if (_time && !loc1) 
                {
                    this.ratio = this._ease.getRatio(_time / _duration);
                }
                else if (loc1 && this._ease._calcEnd) 
                {
                    this.ratio = this._ease.getRatio(_time !== 0 ? 1 : 0);
                }
            }
            if (!_active) 
            {
                if (!_paused && !(_time === loc4) && arg1 >= 0) 
                {
                    _active = true;
                }
            }
            if (loc4 == 0) 
            {
                if (this._startAt != null) 
                {
                    if (arg1 >= 0) 
                    {
                        this._startAt.render(arg1, arg2, arg3);
                    }
                    else if (!loc2) 
                    {
                        loc2 = "_dummyGS";
                    }
                }
                if (vars.onStart) 
                {
                    if (!(_time == 0) || _duration == 0) 
                    {
                        if (!arg2) 
                        {
                            vars.onStart.apply(null, vars.onStartParams);
                        }
                    }
                }
            }
            loc3 = this._firstPT;
            while (loc3) 
            {
                if (loc3.f) 
                {
                    (loc6 = loc3.t)[loc3.p](loc3.c * this.ratio + loc3.s);
                }
                else 
                {
                    loc3.t[loc3.p] = loc3.c * this.ratio + loc3.s;
                }
                loc3 = loc3._next;
            }
            if (_onUpdate != null) 
            {
                if (arg1 < 0 && !(this._startAt == null)) 
                {
                    this._startAt.render(arg1, arg2, arg3);
                }
                if (!arg2) 
                {
                    _onUpdate.apply(null, vars.onUpdateParams);
                }
            }
            if (loc2) 
            {
                if (!_gc) 
                {
                    if (arg1 < 0 && !(this._startAt == null) && _onUpdate == null) 
                    {
                        this._startAt.render(arg1, arg2, arg3);
                    }
                    if (loc1) 
                    {
                        if (_timeline.autoRemoveChildren) 
                        {
                            this._enabled(false, false);
                        }
                        _active = false;
                    }
                    if (!arg2) 
                    {
                        if (vars[loc2]) 
                        {
                            vars[loc2].apply(null, vars[loc2 + "Params"]);
                        }
                    }
                }
            }
            return;
        }

        public override function _kill(arg1:Object=null, arg2:Object=null):Boolean
        {
            var loc1:*=0;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=false;
            var loc7:*=null;
            var loc8:*=false;
            if (arg1 === "all") 
            {
                arg1 = null;
            }
            if (arg1 == null) 
            {
                if (arg2 == null || arg2 == this.target) 
                {
                    return this._enabled(false, false);
                }
            }
            arg2 = arg2 || this._targets || this.target;
            if (arg2 is Array && typeof arg2[0] === "object") 
            {
                loc1 = arg2.length;
                while (--loc1 > -1) 
                {
                    if (!this._kill(arg1, arg2[loc1])) 
                    {
                        continue;
                    }
                    loc6 = true;
                }
            }
            else 
            {
                if (this._targets) 
                {
                    loc1 = this._targets.length;
                    while (--loc1 > -1) 
                    {
                        if (arg2 !== this._targets[loc1]) 
                        {
                            continue;
                        }
                        loc5 = this._propLookup[loc1] || {};
                        this._overwrittenProps = this._overwrittenProps || [];
                        var loc9:*;
                        this._overwrittenProps[loc1] = loc9 = arg1 ? this._overwrittenProps[loc1] || {} : "all";
                        loc2 = loc9;
                        break;
                    }
                }
                else 
                {
                    if (arg2 !== this.target) 
                    {
                        return false;
                    }
                    loc5 = this._propLookup;
                    this._overwrittenProps = loc9 = arg1 ? this._overwrittenProps || {} : "all";
                    loc2 = loc9;
                }
                if (loc5) 
                {
                    loc7 = arg1 || loc5;
                    loc8 = !(arg1 == loc2) && !(loc2 == "all") && !(arg1 == loc5) && (!(typeof arg1 == "object") || !(arg1._tempKill == true));
                    loc9 = 0;
                    var loc10:*=loc7;
                    for (loc3 in loc10) 
                    {
                        if ((loc4 = loc5[loc3]) != null) 
                        {
                            if (loc4.pg && loc4.t._kill(loc7)) 
                            {
                                loc6 = true;
                            }
                            if (!loc4.pg || loc4.t._overwriteProps.length === 0) 
                            {
                                if (loc4._prev) 
                                {
                                    loc4._prev._next = loc4._next;
                                }
                                else if (loc4 == this._firstPT) 
                                {
                                    this._firstPT = loc4._next;
                                }
                                if (loc4._next) 
                                {
                                    loc4._next._prev = loc4._prev;
                                }
                                var loc11:*;
                                loc4._prev = loc11 = null;
                                loc4._next = loc11;
                            }
                            delete loc5[loc3];
                        }
                        if (!loc8) 
                        {
                            continue;
                        }
                        loc2[loc3] = 1;
                    }
                    if (this._firstPT == null && _initted) 
                    {
                        this._enabled(false, false);
                    }
                }
            }
            return loc6;
        }

        public override function invalidate():*
        {
            if (this._notifyPluginsOfEnabled) 
            {
                _onPluginEvent("_onDisable", this);
            }
            this._firstPT = null;
            this._overwrittenProps = null;
            _onUpdate = null;
            this._startAt = null;
            var loc1:*;
            this._notifyPluginsOfEnabled = loc1 = false;
            _active = loc1 = loc1;
            _initted = loc1;
            this._propLookup = this._targets ? {} : [];
            return this;
        }

        public override function _enabled(arg1:Boolean, arg2:Boolean=false):Boolean
        {
            var loc1:*=0;
            if (arg1 && _gc) 
            {
                if (this._targets) 
                {
                    loc1 = this._targets.length;
                    while (--loc1 > -1) 
                    {
                        this._siblings[loc1] = _register(this._targets[loc1], this, true);
                    }
                }
                else 
                {
                    this._siblings = _register(this.target, this, true);
                }
            }
            super._enabled(arg1, arg2);
            if (this._notifyPluginsOfEnabled) 
            {
                if (this._firstPT != null) 
                {
                    return _onPluginEvent(arg1 ? "_onEnable" : "_onDisable", this);
                }
            }
            return false;
        }

        public static function killDelayedCallsTo(arg1:Function):void
        {
            killTweensOf(arg1);
            return;
        }

        protected function _init():void
        {
            var loc2:*=0;
            var loc3:*=false;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=null;
            var loc1:*=vars.immediateRender;
            if (vars.startAt) 
            {
                if (this._startAt != null) 
                {
                    this._startAt.render(-1, true);
                }
                vars.startAt.overwrite = 0;
                vars.startAt.immediateRender = true;
                this._startAt = new mgs.greensock.TweenLite(this.target, 0, vars.startAt);
                if (loc1) 
                {
                    if (_time > 0) 
                    {
                        this._startAt = null;
                    }
                    else if (_duration !== 0) 
                    {
                        return;
                    }
                }
            }
            else if (loc1 && vars.runBackwards && !(_duration === 0)) 
            {
                if (this._startAt == null) 
                {
                    if (_time === 0) 
                    {
                        loc6 = {};
                        var loc7:*=0;
                        var loc8:*=vars;
                        for (loc5 in loc8) 
                        {
                            if (loc5 in _reservedProps) 
                            {
                                continue;
                            }
                            loc6[loc5] = vars[loc5];
                        }
                        loc6.overwrite = 0;
                        this._startAt = mgs.greensock.TweenLite.to(this.target, 0, loc6);
                        return;
                    }
                }
                else 
                {
                    this._startAt.render(-1, true);
                    this._startAt = null;
                }
            }
            if (vars.ease is mgs.greensock.easing.Ease) 
            {
                this._ease = vars.easeParams is Array ? vars.ease.config.apply(vars.ease, vars.easeParams) : vars.ease;
            }
            else if (typeof vars.ease !== "function") 
            {
                this._ease = defaultEase;
            }
            else 
            {
                this._ease = new mgs.greensock.easing.Ease(vars.ease, vars.easeParams);
            }
            this._easeType = this._ease._type;
            this._easePower = this._ease._power;
            this._firstPT = null;
            if (this._targets) 
            {
                loc2 = this._targets.length;
                while (--loc2 > -1) 
                {
                    this._propLookup[loc2] = loc7 = {};
                    if (!this._initProps(this._targets[loc2], loc7, this._siblings[loc2], this._overwrittenProps ? this._overwrittenProps[loc2] : null)) 
                    {
                        continue;
                    }
                    loc3 = true;
                }
            }
            else 
            {
                loc3 = this._initProps(this.target, this._propLookup, this._siblings, this._overwrittenProps);
            }
            if (loc3) 
            {
                _onPluginEvent("_onInitAllProps", this);
            }
            if (this._overwrittenProps) 
            {
                if (this._firstPT == null) 
                {
                    if (typeof this.target !== "function") 
                    {
                        this._enabled(false, false);
                    }
                }
            }
            if (vars.runBackwards) 
            {
                loc4 = this._firstPT;
                while (loc4) 
                {
                    loc4.s = loc4.s + loc4.c;
                    loc4.c = -loc4.c;
                    loc4 = loc4._next;
                }
            }
            _onUpdate = vars.onUpdate;
            _initted = true;
            return;
        }

        protected function _initProps(arg1:Object, arg2:Object, arg3:Array, arg4:Object):Boolean
        {
            var loc2:*=null;
            var loc3:*=0;
            var loc4:*=false;
            var loc5:*=null;
            var loc6:*=null;
            var loc1:*=this.vars;
            if (arg1 == null) 
            {
                return false;
            }
            var loc7:*=0;
            var loc8:*=loc1;
            for (loc2 in loc8) 
            {
                loc6 = loc1[loc2];
                if (loc2 in _reservedProps) 
                {
                    if (loc6 is Array) 
                    {
                        if (loc6.join("").indexOf("{self}") !== -1) 
                        {
                            loc1[loc2] = _swapSelfInParams(loc6 as Array);
                        }
                    }
                    continue;
                }
                if (loc2 in _plugins) 
                {
                    loc2 in _plugins;
                    var loc9:*;
                    loc5 = loc9 = new _plugins[loc2]();
                }
                if (loc2 in _plugins) 
                {
                    this._firstPT = new mgs.greensock.core.PropTween(loc5, "setRatio", 0, 1, loc2, true, this._firstPT, loc5._priority);
                    loc3 = loc5._overwriteProps.length;
                    while (--loc3 > -1) 
                    {
                        arg2[loc5._overwriteProps[loc3]] = this._firstPT;
                    }
                    if (loc5._priority || "_onInitAllProps" in loc5) 
                    {
                        loc4 = true;
                    }
                    if ("_onDisable" in loc5 || "_onEnable" in loc5) 
                    {
                        this._notifyPluginsOfEnabled = true;
                    }
                    continue;
                }
                arg2[loc2] = loc9 = new mgs.greensock.core.PropTween(arg1, loc2, 0, 1, loc2, false, this._firstPT);
                this._firstPT = loc9;
                this._firstPT.s = this._firstPT.f ? (loc9 = arg1)[loc2.indexOf("set") || !("get" + loc2.substr(3) in arg1) ? loc2 : "get" + loc2.substr(3)]() : Number(arg1[loc2]);
                this._firstPT.c = typeof loc6 !== "number" ? typeof loc6 === "string" && loc6.charAt(1) === "=" ? int(loc6.charAt(0) + "1") * Number(loc6.substr(2)) : Number(loc6) || 0 : Number(loc6) - this._firstPT.s;
            }
            if (arg4) 
            {
                if (this._kill(arg4, arg1)) 
                {
                    return this._initProps(arg1, arg2, arg3, arg4);
                }
            }
            if (this._overwrite > 1) 
            {
                if (this._firstPT != null) 
                {
                    if (arg3.length > 1) 
                    {
                        if (_applyOverwrite(arg1, this, arg2, this._overwrite, arg3)) 
                        {
                            this._kill(arg2, arg1);
                            return this._initProps(arg1, arg2, arg3, arg4);
                        }
                    }
                }
            }
            return loc4;
        }

        public static function to(arg1:Object, arg2:Number, arg3:Object):mgs.greensock.TweenLite
        {
            return new TweenLite(arg1, arg2, arg3);
        }

        public static function from(arg1:Object, arg2:Number, arg3:Object):mgs.greensock.TweenLite
        {
            arg3 = _prepVars(arg3, true);
            arg3.runBackwards = true;
            return new TweenLite(arg1, arg2, arg3);
        }

        public static function fromTo(arg1:Object, arg2:Number, arg3:Object, arg4:Object):mgs.greensock.TweenLite
        {
            arg4 = _prepVars(arg4, true);
            arg3 = _prepVars(arg3);
            arg4.startAt = arg3;
            arg4.immediateRender = !(arg4.immediateRender == false) && !(arg3.immediateRender == false);
            return new TweenLite(arg1, arg2, arg4);
        }

        protected static function _prepVars(arg1:Object, arg2:Boolean=false):Object
        {
            if (arg1._isGSVars) 
            {
                arg1 = arg1.vars;
            }
            if (arg2 && !("immediateRender" in arg1)) 
            {
                arg1.immediateRender = true;
            }
            return arg1;
        }

        public static function delayedCall(arg1:Number, arg2:Function, arg3:Array=null, arg4:Boolean=false):mgs.greensock.TweenLite
        {
            return new TweenLite(arg2, 0, {"delay":arg1, "onComplete":arg2, "onCompleteParams":arg3, "onReverseComplete":arg2, "onReverseCompleteParams":arg3, "immediateRender":false, "useFrames":arg4, "overwrite":0});
        }

        public static function set(arg1:Object, arg2:Object):mgs.greensock.TweenLite
        {
            return new TweenLite(arg1, 0, arg2);
        }

        internal static function _dumpGarbage(arg1:flash.events.Event):void
        {
            var loc1:*=0;
            var loc2:*=null;
            var loc3:*=null;
            if (_rootFrame / 60 >> 0 === _rootFrame / 60) 
            {
                var loc4:*=0;
                var loc5:*=_tweenLookup;
                for (loc3 in loc5) 
                {
                    loc2 = _tweenLookup[loc3];
                    loc1 = loc2.length;
                    while (--loc1 > -1) 
                    {
                        if (!loc2[loc1]._gc) 
                        {
                            continue;
                        }
                        loc2.splice(loc1, 1);
                    }
                    if (loc2.length !== 0) 
                    {
                        continue;
                    }
                    delete _tweenLookup[loc3];
                }
            }
            return;
        }

        public static function killTweensOf(arg1:*, arg2:Object=null):void
        {
            var loc1:*=getTweensOf(arg1);
            var loc2:*=loc1.length;
            while (--loc2 > -1) 
            {
                TweenLite(loc1[loc2])._kill(arg2, arg1);
            }
            return;
        }

        public static function getTweensOf(arg1:*):Array
        {
            var loc1:*=0;
            var loc2:*=null;
            var loc3:*=0;
            var loc4:*=null;
            if (arg1 is Array && !(typeof arg1[0] == "string") && !(typeof arg1[0] == "number")) 
            {
                loc1 = arg1.length;
                loc2 = [];
                while (--loc1 > -1) 
                {
                    loc2 = loc2.concat(getTweensOf(arg1[loc1]));
                }
                loc1 = loc2.length;
                while (--loc1 > -1) 
                {
                    loc4 = loc2[loc1];
                    loc3 = loc1;
                    while (--loc3 > -1) 
                    {
                        if (loc4 !== loc2[loc3]) 
                        {
                            continue;
                        }
                        loc2.splice(loc1, 1);
                    }
                }
            }
            else 
            {
                loc2 = _register(arg1).concat();
                loc1 = loc2.length;
                while (--loc1 > -1) 
                {
                    if (!loc2[loc1]._gc) 
                    {
                        continue;
                    }
                    loc2.splice(loc1, 1);
                }
            }
            return loc2;
        }

        protected static function _register(arg1:Object, arg2:mgs.greensock.TweenLite=null, arg3:Boolean=false):Array
        {
            var loc2:*=0;
            var loc1:*;
            if ((loc1 = _tweenLookup[arg1]) == null) 
            {
                var loc3:*;
                _tweenLookup[arg1] = loc3 = [];
                loc1 = loc3;
            }
            if (arg2) 
            {
                loc2 = loc1.length;
                loc1[loc2] = arg2;
                if (arg3) 
                {
                    while (--loc2 > -1) 
                    {
                        if (loc1[loc2] !== arg2) 
                        {
                            continue;
                        }
                        loc1.splice(loc2, 1);
                    }
                }
            }
            return loc1;
        }

        protected static function _applyOverwrite(arg1:Object, arg2:mgs.greensock.TweenLite, arg3:Object, arg4:int, arg5:Array):Boolean
        {
            var loc1:*=0;
            var loc2:*=false;
            var loc3:*=null;
            var loc8:*=NaN;
            var loc9:*=0;
            if (arg4 == 1 || arg4 >= 4) 
            {
                loc9 = arg5.length;
                loc1 = 0;
                while (loc1 < loc9) 
                {
                    if ((loc3 = arg5[loc1]) == arg2) 
                    {
                        if (arg4 == 5) 
                        {
                            break;
                        }
                    }
                    else if (!loc3._gc) 
                    {
                        if (loc3._enabled(false, false)) 
                        {
                            loc2 = true;
                        }
                    }
                    ++loc1;
                }
                return loc2;
            }
            var loc4:*=arg2._startTime + 1e-010;
            var loc5:*=[];
            var loc6:*=0;
            var loc7:*=arg2._duration == 0;
            loc1 = arg5.length;
            while (--loc1 > -1) 
            {
                if ((loc3 = arg5[loc1]) === arg2 || loc3._gc || loc3._paused) 
                {
                    continue;
                }
                if (loc3._timeline != arg2._timeline) 
                {
                    loc8 = loc8 || _checkOverlap(arg2, 0, loc7);
                    if (_checkOverlap(loc3, loc8, loc7) === 0) 
                    {
                        var loc10:*;
                        loc5[loc10 = loc6++] = loc3;
                    }
                    continue;
                }
                if (!(loc3._startTime <= loc4)) 
                {
                    continue;
                }
                if (!(loc3._startTime + loc3.totalDuration() / loc3._timeScale + 1e-010 > loc4)) 
                {
                    continue;
                }
                if ((loc7 || !loc3._initted) && loc4 - loc3._startTime <= 2e-010) 
                {
                    continue;
                }
                loc5[loc10 = loc6++] = loc3;
            }
            loc1 = loc6;
            while (--loc1 > -1) 
            {
                loc3 = loc5[loc1];
                if (arg4 == 2) 
                {
                    if (loc3._kill(arg3, arg1)) 
                    {
                        loc2 = true;
                    }
                }
                if (!(!(arg4 === 2) || !loc3._firstPT && loc3._initted)) 
                {
                    continue;
                }
                if (!loc3._enabled(false, false)) 
                {
                    continue;
                }
                loc2 = true;
            }
            return loc2;
        }

        internal static function _checkOverlap(arg1:mgs.greensock.core.Animation, arg2:Number, arg3:Boolean):Number
        {
            var loc1:*;
            var loc2:*=(loc1 = arg1._timeline)._timeScale;
            var loc3:*=arg1._startTime;
            var loc4:*=1e-010;
            while (loc1._timeline) 
            {
                loc3 = loc3 + loc1._startTime;
                loc2 = loc2 * loc1._timeScale;
                if (loc1._paused) 
                {
                    return -100;
                }
                loc1 = loc1._timeline;
            }
            if (!((loc3 = loc3 / loc2) > arg2)) 
            {
                if (!(arg3 && loc3 == arg2 || !arg1._initted && loc3 - arg2 < 2 * loc4)) 
                {
                    var loc5:*;
                    loc3 = loc5 = loc3 + arg1.totalDuration() / arg1._timeScale / loc2;
                }
            }
            return undefined;
        }

        
        {
            defaultEase = new mgs.greensock.easing.Ease(null, null, 1, 1);
            defaultOverwrite = "auto";
            ticker = mgs.greensock.core.Animation.ticker;
            _plugins = {};
            _tweenLookup = new flash.utils.Dictionary(false);
            _reservedProps = {"ease":1, "delay":1, "overwrite":1, "onComplete":1, "onCompleteParams":1, "onCompleteScope":1, "useFrames":1, "runBackwards":1, "startAt":1, "onUpdate":1, "onUpdateParams":1, "onUpdateScope":1, "onStart":1, "onStartParams":1, "onStartScope":1, "onReverseComplete":1, "onReverseCompleteParams":1, "onReverseCompleteScope":1, "onRepeat":1, "onRepeatParams":1, "onRepeatScope":1, "easeParams":1, "yoyo":1, "onCompleteListener":1, "onUpdateListener":1, "onStartListener":1, "onReverseCompleteListener":1, "onRepeatListener":1, "orientToBezier":1, "immediateRender":1, "repeat":1, "repeatDelay":1, "data":1, "paused":1, "reversed":1};
        }

        public static const version:String="12.0.16";

        public static var defaultOverwrite:String="auto";

        public static var ticker:flash.display.Shape;

        public static var _plugins:Object;

        public static var _onPluginEvent:Function;

        protected static var _tweenLookup:flash.utils.Dictionary;

        protected static var _reservedProps:Object;

        protected static var _overwriteLookup:Object;

        public var target:Object;

        public var ratio:Number;

        public var _propLookup:Object;

        public var _firstPT:mgs.greensock.core.PropTween;

        public var _ease:mgs.greensock.easing.Ease;

        protected var _easeType:int;

        protected var _easePower:int;

        protected var _siblings:Array;

        public static var defaultEase:mgs.greensock.easing.Ease;

        protected var _overwrite:int;

        protected var _overwrittenProps:Object;

        protected var _notifyPluginsOfEnabled:Boolean;

        protected var _startAt:mgs.greensock.TweenLite;

        protected var _targets:Array;
    }
}


//  package mx
//    package core
//      class ByteArrayAsset
package mx.core 
{
    import flash.utils.*;
    
    use namespace mx_internal;
    
    public class ByteArrayAsset extends flash.utils.ByteArray implements mx.core.IFlexAsset
    {
        public function ByteArrayAsset()
        {
            super();
            return;
        }

        
        {
            mx_internal::VERSION = "4.1.0.16076";
        }

        mx_internal static const VERSION:String="4.1.0.16076";
    }
}


//      class IFlexAsset
package mx.core 
{
    public interface IFlexAsset
    {
    }
}


//      namespace mx_internal
package mx.core 
{
    public namespace mx_internal="http://www.adobe.com/2006/flex/mx/internal";
}


//    package utils
//      class StringUtil
package mx.utils 
{
    import mx.core.*;
    
    use namespace mx_internal;
    
    public class StringUtil extends Object
    {
        public function StringUtil()
        {
            super();
            return;
        }

        public static function trim(arg1:String):String
        {
            if (arg1 == null) 
            {
                return "";
            }
            var loc1:*=0;
            while (isWhitespace(arg1.charAt(loc1))) 
            {
                ++loc1;
            }
            var loc2:*=(arg1.length - 1);
            while (isWhitespace(arg1.charAt(loc2))) 
            {
                --loc2;
            }
            if (loc2 >= loc1) 
            {
                return arg1.slice(loc1, loc2 + 1);
            }
            return "";
        }

        public static function trimArrayElements(arg1:String, arg2:String):String
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=0;
            if (!(arg1 == "") && !(arg1 == null)) 
            {
                loc1 = arg1.split(arg2);
                loc2 = loc1.length;
                loc3 = 0;
                while (loc3 < loc2) 
                {
                    loc1[loc3] = mx.utils.StringUtil.trim(loc1[loc3]);
                    ++loc3;
                }
                if (loc2 > 0) 
                {
                    arg1 = loc1.join(arg2);
                }
            }
            return arg1;
        }

        public static function isWhitespace(arg1:String):Boolean
        {
            var loc1:*=arg1;
            switch (loc1) 
            {
                case " ":
                case "\t":
                case "\r":
                case "\n":
                case "":
                {
                    return true;
                }
                default:
                {
                    return false;
                }
            }
        }

        public static function substitute(arg1:String, ... rest):String
        {
            var loc2:*=null;
            if (arg1 == null) 
            {
                return "";
            }
            var loc1:*=rest.length;
            if (loc1 == 1 && rest[0] is Array) 
            {
                loc1 = (loc2 = rest[0] as Array).length;
            }
            else 
            {
                loc2 = rest;
            }
            var loc3:*=0;
            while (loc3 < loc1) 
            {
                arg1 = arg1.replace(new RegExp("\\{" + loc3 + "\\}", "g"), loc2[loc3]);
                ++loc3;
            }
            return arg1;
        }

        public static function repeat(arg1:String, arg2:int):String
        {
            if (arg2 == 0) 
            {
                return "";
            }
            var loc1:*=arg1;
            var loc2:*=1;
            while (loc2 < arg2) 
            {
                loc1 = loc1 + arg1;
                ++loc2;
            }
            return loc1;
        }

        public static function restrict(arg1:String, arg2:String):String
        {
            var loc4:*=0;
            if (arg2 == null) 
            {
                return arg1;
            }
            if (arg2 == "") 
            {
                return "";
            }
            var loc1:*=[];
            var loc2:*=arg1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                loc4 = arg1.charCodeAt(loc3);
                if (testCharacter(loc4, arg2)) 
                {
                    loc1.push(loc4);
                }
                ++loc3;
            }
            return String.fromCharCode.apply(null, loc1);
        }

        internal static function testCharacter(arg1:uint, arg2:String):Boolean
        {
            var loc7:*=0;
            var loc9:*=false;
            var loc1:*=false;
            var loc2:*=false;
            var loc3:*=false;
            var loc4:*=true;
            var loc5:*=0;
            var loc6:*;
            if ((loc6 = arg2.length) > 0) 
            {
                if ((loc7 = arg2.charCodeAt(0)) == 94) 
                {
                    loc1 = true;
                }
            }
            var loc8:*=0;
            while (loc8 < loc6) 
            {
                loc7 = arg2.charCodeAt(loc8);
                loc9 = false;
                if (loc2) 
                {
                    loc9 = true;
                    loc2 = false;
                }
                else if (loc7 != 45) 
                {
                    if (loc7 != 94) 
                    {
                        if (loc7 != 92) 
                        {
                            loc9 = true;
                        }
                        else 
                        {
                            loc2 = true;
                        }
                    }
                    else 
                    {
                        loc4 = !loc4;
                    }
                }
                else 
                {
                    loc3 = true;
                }
                if (loc9) 
                {
                    if (loc3) 
                    {
                        if (loc5 <= arg1 && arg1 <= loc7) 
                        {
                            loc1 = loc4;
                        }
                        loc3 = false;
                        loc5 = 0;
                    }
                    else 
                    {
                        if (arg1 == loc7) 
                        {
                            loc1 = loc4;
                        }
                        loc5 = loc7;
                    }
                }
                ++loc8;
            }
            return loc1;
        }

        
        {
            mx_internal::VERSION = "4.1.0.16076";
        }

        mx_internal static const VERSION:String="4.1.0.16076";
    }
}


//  package org
//    package osflash
//      package signals
//        class IOnceSignal
package org.osflash.signals 
{
    public interface IOnceSignal
    {
        function dispatch(... rest):void;

        function addOnce(arg1:Function):org.osflash.signals.ISlot;

        function remove(arg1:Function):org.osflash.signals.ISlot;

        function get valueClasses():Array;

        function get numListeners():uint;

        function set valueClasses(arg1:Array):void;

        function removeAll():void;
    }
}


//        class ISignal
package org.osflash.signals 
{
    public interface ISignal extends org.osflash.signals.IOnceSignal
    {
        function add(arg1:Function):org.osflash.signals.ISlot;
    }
}


//        class ISlot
package org.osflash.signals 
{
    public interface ISlot
    {
        function get enabled():Boolean;

        function set enabled(arg1:Boolean):void;

        function get priority():int;

        function get params():Array;

        function get once():Boolean;

        function remove():void;

        function set params(arg1:Array):void;

        function set listener(arg1:Function):void;

        function get listener():Function;

        function execute(arg1:Array):void;

        function execute0():void;

        function execute1(arg1:Object):void;
    }
}


//        class OnceSignal
package org.osflash.signals 
{
    import flash.errors.*;
    import flash.utils.*;
    
    public class OnceSignal extends Object implements org.osflash.signals.IOnceSignal
    {
        public function OnceSignal(... rest)
        {
            this.slots = org.osflash.signals.SlotList.NIL;
            super();
            this.valueClasses = rest.length == 1 && rest[0] is Array ? rest[0] : rest;
            return;
        }

        public function addOnce(arg1:Function):org.osflash.signals.ISlot
        {
            return this.registerListener(arg1, true);
        }

        protected function registrationPossible(arg1:Function, arg2:Boolean):Boolean
        {
            if (!this.slots.nonEmpty) 
            {
                return true;
            }
            var loc1:*=this.slots.find(arg1);
            if (!loc1) 
            {
                return true;
            }
            if (loc1.once != arg2) 
            {
                throw new flash.errors.IllegalOperationError("You cannot addOnce() then add() the same listener without removing the relationship first.");
            }
            return false;
        }

        public function set valueClasses(arg1:Array):void
        {
            this._valueClasses = arg1 ? arg1.slice() : [];
            var loc1:*=this._valueClasses.length;
            while (loc1--) 
            {
                if (this._valueClasses[loc1] is Class) 
                {
                    continue;
                }
                throw new ArgumentError("Invalid valueClasses argument: " + "item at index " + loc1 + " should be a Class but was:<" + this._valueClasses[loc1] + ">." + flash.utils.getQualifiedClassName(this._valueClasses[loc1]));
            }
            return;
        }

        public function remove(arg1:Function):org.osflash.signals.ISlot
        {
            var loc1:*=this.slots.find(arg1);
            if (!loc1) 
            {
                return null;
            }
            this.slots = this.slots.filterNot(arg1);
            return loc1;
        }

        protected function registerListener(arg1:Function, arg2:Boolean=false):org.osflash.signals.ISlot
        {
            var loc1:*=null;
            if (this.registrationPossible(arg1, arg2)) 
            {
                loc1 = new org.osflash.signals.Slot(arg1, this, arg2);
                this.slots = this.slots.prepend(loc1);
                return loc1;
            }
            return this.slots.find(arg1);
        }

        public function get numListeners():uint
        {
            return this.slots.length;
        }

        public function dispatch(... rest):void
        {
            var loc1:*=this._valueClasses.length;
            var loc2:*=rest.length;
            if (loc2 < loc1) 
            {
                throw new ArgumentError("Incorrect number of arguments. " + "Expected at least " + loc1 + " but received " + loc2 + ".");
            }
            var loc3:*=0;
            while (loc3 < loc1) 
            {
                if (!(rest[loc3] is this._valueClasses[loc3] || rest[loc3] === null)) 
                {
                    throw new ArgumentError("Value object <" + rest[loc3] + "> is not an instance of <" + this._valueClasses[loc3] + ">.");
                }
                ++loc3;
            }
            var loc4:*;
            if ((loc4 = this.slots).nonEmpty) 
            {
                while (loc4.nonEmpty) 
                {
                    loc4.head.execute(rest);
                    loc4 = loc4.tail;
                }
            }
            return;
        }

        public function get valueClasses():Array
        {
            return this._valueClasses;
        }

        public function removeAll():void
        {
            this.slots = org.osflash.signals.SlotList.NIL;
            return;
        }

        protected var _valueClasses:Array;

        protected var slots:org.osflash.signals.SlotList;
    }
}


//        class Signal
package org.osflash.signals 
{
    public class Signal extends org.osflash.signals.OnceSignal implements org.osflash.signals.ISignal
    {
        public function Signal(... rest)
        {
            rest = rest.length == 1 && rest[0] is Array ? rest[0] : rest;
            super(rest);
            return;
        }

        public function add(arg1:Function):org.osflash.signals.ISlot
        {
            return registerListener(arg1);
        }
    }
}


//        class Slot
package org.osflash.signals 
{
    public class Slot extends Object implements org.osflash.signals.ISlot
    {
        public function Slot(arg1:Function, arg2:org.osflash.signals.IOnceSignal, arg3:Boolean=false, arg4:int=0)
        {
            super();
            this._listener = arg1;
            this._once = arg3;
            this._signal = arg2;
            this._priority = arg4;
            this.verifyListener(arg1);
            return;
        }

        public function get once():Boolean
        {
            return this._once;
        }

        public function set enabled(arg1:Boolean):void
        {
            this._enabled = arg1;
            return;
        }

        public function remove():void
        {
            this._signal.remove(this._listener);
            return;
        }

        public function set params(arg1:Array):void
        {
            this._params = arg1;
            return;
        }

        public function get params():Array
        {
            return this._params;
        }

        public function get enabled():Boolean
        {
            return this._enabled;
        }

        protected function verifyListener(arg1:Function):void
        {
            if (null == arg1) 
            {
                throw new ArgumentError("Given listener is null.");
            }
            if (null == this._signal) 
            {
                throw new Error("Internal signal reference has not been set yet.");
            }
            return;
        }

        public function execute0():void
        {
            if (!this._enabled) 
            {
                return;
            }
            if (this._once) 
            {
                this.remove();
            }
            if (this._params && this._params.length) 
            {
                this._listener.apply(null, this._params);
                return;
            }
            this._listener();
            return;
        }

        public function execute1(arg1:Object):void
        {
            if (!this._enabled) 
            {
                return;
            }
            if (this._once) 
            {
                this.remove();
            }
            if (this._params && this._params.length) 
            {
                this._listener.apply(null, [arg1].concat(this._params));
                return;
            }
            this._listener(arg1);
            return;
        }

        public function get priority():int
        {
            return this._priority;
        }

        public function toString():String
        {
            return "[Slot listener: " + this._listener + ", once: " + this._once + ", priority: " + this._priority + ", enabled: " + this._enabled + "]";
        }

        public function set listener(arg1:Function):void
        {
            if (null == arg1) 
            {
                throw new ArgumentError("Given listener is null.\nDid you want to set enabled to false instead?");
            }
            this.verifyListener(arg1);
            this._listener = arg1;
            return;
        }

        public function execute(arg1:Array):void
        {
            if (!this._enabled) 
            {
                return;
            }
            if (this._once) 
            {
                this.remove();
            }
            if (this._params && this._params.length) 
            {
                arg1 = arg1.concat(this._params);
            }
            var loc1:*=arg1.length;
            if (loc1 != 0) 
            {
                if (loc1 != 1) 
                {
                    if (loc1 != 2) 
                    {
                        if (loc1 != 3) 
                        {
                            this._listener.apply(null, arg1);
                        }
                        else 
                        {
                            this._listener(arg1[0], arg1[1], arg1[2]);
                        }
                    }
                    else 
                    {
                        this._listener(arg1[0], arg1[1]);
                    }
                }
                else 
                {
                    this._listener(arg1[0]);
                }
            }
            else 
            {
                this._listener();
            }
            return;
        }

        public function get listener():Function
        {
            return this._listener;
        }

        protected var _enabled:Boolean=true;

        protected var _priority:int=0;

        protected var _signal:org.osflash.signals.IOnceSignal;

        protected var _listener:Function;

        protected var _once:Boolean=false;

        protected var _params:Array;
    }
}


//        class SlotList
package org.osflash.signals 
{
    public final class SlotList extends Object
    {
        public function SlotList(arg1:org.osflash.signals.ISlot, arg2:org.osflash.signals.SlotList=null)
        {
            super();
            if (!arg1 && !arg2) 
            {
                if (NIL) 
                {
                    throw new ArgumentError("Parameters head and tail are null. Use the NIL element instead.");
                }
                this.nonEmpty = false;
            }
            else 
            {
                if (!arg1) 
                {
                    throw new ArgumentError("Parameter head cannot be null.");
                }
                this.head = arg1;
                this.tail = arg2 || NIL;
                this.nonEmpty = true;
            }
            return;
        }

        public function insertWithPriority(arg1:org.osflash.signals.ISlot):org.osflash.signals.SlotList
        {
            if (!this.nonEmpty) 
            {
                return new org.osflash.signals.SlotList(arg1);
            }
            var loc1:*=arg1.priority;
            if (loc1 > this.head.priority) 
            {
                return this.prepend(arg1);
            }
            var loc2:*=new org.osflash.signals.SlotList(this.head);
            var loc3:*=loc2;
            var loc4:*=this.tail;
            while (loc4.nonEmpty) 
            {
                if (loc1 > loc4.head.priority) 
                {
                    loc3.tail = loc4.prepend(arg1);
                    return loc2;
                }
                var loc5:*;
                loc3.tail = loc5 = new org.osflash.signals.SlotList(loc4.head);
                loc3 = loc5;
                loc4 = loc4.tail;
            }
            loc3.tail = new org.osflash.signals.SlotList(arg1);
            return loc2;
        }

        public function get length():uint
        {
            if (!this.nonEmpty) 
            {
                return 0;
            }
            if (this.tail == NIL) 
            {
                return 1;
            }
            var loc1:*=0;
            var loc2:*=this;
            while (loc2.nonEmpty) 
            {
                ++loc1;
                loc2 = loc2.tail;
            }
            return loc1;
        }

        public function toString():String
        {
            var loc1:*="";
            var loc2:*=this;
            while (loc2.nonEmpty) 
            {
                loc1 = loc1 + (loc2.head + " -> ");
                loc2 = loc2.tail;
            }
            loc1 = loc1 + "NIL";
            return "[List " + loc1 + "]";
        }

        public function prepend(arg1:org.osflash.signals.ISlot):org.osflash.signals.SlotList
        {
            return new org.osflash.signals.SlotList(arg1, this);
        }

        public function find(arg1:Function):org.osflash.signals.ISlot
        {
            if (!this.nonEmpty) 
            {
                return null;
            }
            var loc1:*=this;
            while (loc1.nonEmpty) 
            {
                if (loc1.head.listener == arg1) 
                {
                    return loc1.head;
                }
                loc1 = loc1.tail;
            }
            return null;
        }

        public function append(arg1:org.osflash.signals.ISlot):org.osflash.signals.SlotList
        {
            if (!arg1) 
            {
                return this;
            }
            if (!this.nonEmpty) 
            {
                return new org.osflash.signals.SlotList(arg1);
            }
            if (this.tail == NIL) 
            {
                return new org.osflash.signals.SlotList(arg1).prepend(this.head);
            }
            var loc1:*=new org.osflash.signals.SlotList(this.head);
            var loc2:*=loc1;
            var loc3:*=this.tail;
            while (loc3.nonEmpty) 
            {
                var loc4:*;
                loc2.tail = loc4 = new org.osflash.signals.SlotList(loc3.head);
                loc2 = loc4;
                loc3 = loc3.tail;
            }
            loc2.tail = new org.osflash.signals.SlotList(arg1);
            return loc1;
        }

        public function filterNot(arg1:Function):org.osflash.signals.SlotList
        {
            if (!this.nonEmpty || arg1 == null) 
            {
                return this;
            }
            if (arg1 == this.head.listener) 
            {
                return this.tail;
            }
            var loc1:*=new org.osflash.signals.SlotList(this.head);
            var loc2:*=loc1;
            var loc3:*=this.tail;
            while (loc3.nonEmpty) 
            {
                if (loc3.head.listener == arg1) 
                {
                    loc2.tail = loc3.tail;
                    return loc1;
                }
                var loc4:*;
                loc2.tail = loc4 = new org.osflash.signals.SlotList(loc3.head);
                loc2 = loc4;
                loc3 = loc3.tail;
            }
            return this;
        }

        public function contains(arg1:Function):Boolean
        {
            if (!this.nonEmpty) 
            {
                return false;
            }
            var loc1:*=this;
            while (loc1.nonEmpty) 
            {
                if (loc1.head.listener == arg1) 
                {
                    return true;
                }
                loc1 = loc1.tail;
            }
            return false;
        }

        public static const NIL:org.osflash.signals.SlotList=new SlotList(null, null);

        public var head:org.osflash.signals.ISlot;

        public var nonEmpty:Boolean=false;

        public var tail:org.osflash.signals.SlotList;
    }
}


//  package utils
//    package clips
//      class CurvedText
package utils.clips 
{
    import flash.display.*;
    import flash.geom.*;
    import flash.text.*;
    
    public class CurvedText extends flash.display.MovieClip
    {
        public function CurvedText(arg1:String, arg2:Number=200, arg3:Number=0, arg4:Number=360, arg5:String="up", arg6:flash.text.TextFormat=null)
        {
            super();
            this._text = arg1;
            this._radius = arg2;
            this._startAngle = arg3;
            this._endAngle = arg4;
            this._direction = arg5;
            this._textFormat = arg6;
            this._letters = [];
            this._totalAngle = Math.abs(this._startAngle + this._endAngle);
            return;
        }

        public function draw():void
        {
            var loc3:*=null;
            if (this._text == "") 
            {
                return;
            }
            if (this._letterHolder && contains(this._letterHolder)) 
            {
                removeChild(this._letterHolder);
            }
            this._letterHolder = new flash.display.MovieClip();
            addChild(this._letterHolder);
            var loc1:*=this._text.length;
            var loc2:*=0;
            while (loc2 < loc1) 
            {
                loc3 = this.getLetterObject(this._text.charAt(loc2));
                loc3.stepDegrees = this._totalAngle / loc1;
                this._letters.push(loc3);
                this._widthOfText = this._widthOfText + loc3.fieldWidth;
                this._letterHolder.addChild(loc3.movie);
                ++loc2;
            }
            this.position();
            if (this.showCurve) 
            {
                this._letterHolder.graphics.lineStyle(1, 16711680, 1);
                this._letterHolder.graphics.drawCircle(0, 0, this._radius);
            }
            return;
        }

        internal function position():void
        {
            var loc5:*=NaN;
            var loc6:*=0;
            var loc7:*=0;
            var loc1:*=this._letters.length;
            var loc2:*=this._startAngle;
            var loc3:*=0;
            while (loc3 < loc1) 
            {
                loc5 = this._letters[loc3].stepDegrees + loc2;
                if (this._direction != DIRECTION_DOWN) 
                {
                    loc6 = this._radius * Math.cos((loc5 - 90) / 180 * Math.PI);
                    loc7 = this._radius * Math.sin((loc5 - 90) / 180 * Math.PI);
                }
                else 
                {
                    loc5 = loc5 - 180;
                    this._letters[loc3].movie.scaleY = -1;
                }
                loc6 = this._radius * Math.cos((loc5 - 90) / 180 * Math.PI);
                loc7 = this._radius * Math.sin((loc5 - 90) / 180 * Math.PI);
                this._letters[loc3].movie.x = loc6;
                this._letters[loc3].movie.y = loc7;
                this._letters[loc3].movie.rotation = loc5;
                loc2 = loc2 + this._letters[loc3].stepDegrees;
                ++loc3;
            }
            var loc4:*=this._letterHolder.getBounds(this);
            this._letterHolder.x = -loc4.x;
            this._letterHolder.y = -loc4.y;
            if (this._direction == DIRECTION_DOWN) 
            {
                this._letterHolder.scaleX = -1;
            }
            return;
        }

        internal function getLetterObject(arg1:String):Object
        {
            if (!this._textFormat) 
            {
                this._textFormat = new flash.text.TextFormat();
                this._textFormat.align = flash.text.TextFormatAlign.CENTER;
                this._textFormat.font = "Verdana";
                this._textFormat.size = 12;
                this._textFormat.color = 0;
            }
            var loc1:*=new flash.display.MovieClip();
            var loc2:*=new flash.text.TextField();
            loc2.width = 10;
            loc2.defaultTextFormat = this._textFormat;
            loc2.embedFonts = true;
            loc2.multiline = false;
            loc2.autoSize = flash.text.TextFieldAutoSize.CENTER;
            loc2.text = arg1;
            loc2.x = (-loc2.width) / 2;
            loc2.y = (-loc2.height) / 2;
            if (this.showLetterBorder) 
            {
                loc2.border = true;
            }
            loc1.addChild(loc2);
            return {"movie":loc1, "field":loc2, "widthInDegrees":0, "fieldWidth":loc2.width, "fieldHeight":loc2.height};
        }

        public static const DIRECTION_DOWN:String="down";

        public static const DIRECTION_UP:String="up";

        internal var _direction:String;

        internal var _widthOfText:Number=0;

        internal var _text:String;

        internal var _letters:Array;

        public var showLetterBorder:Boolean=false;

        internal var _letterHolder:flash.display.MovieClip;

        internal var _totalAngle:Number=0;

        internal var _endAngle:Number=360;

        internal var _textFormat:flash.text.TextFormat;

        internal var _startAngle:Number=0;

        internal var _radius:Number;

        public var showCurve:Boolean=false;
    }
}


//  class ActiveBonusLayer
package 
{
    import flash.display.*;
    
    public dynamic class ActiveBonusLayer extends flash.display.MovieClip
    {
        public function ActiveBonusLayer()
        {
            super();
            return;
        }
    }
}


//  class Blue_Button_Round_activeSkin
package 
{
    import flash.display.*;
    
    public dynamic class Blue_Button_Round_activeSkin extends flash.display.MovieClip
    {
        public function Blue_Button_Round_activeSkin()
        {
            super();
            return;
        }
    }
}


//  class Blue_Button_Round_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class Blue_Button_Round_disabledSkin extends flash.display.MovieClip
    {
        public function Blue_Button_Round_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class Blue_Button_Round_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class Blue_Button_Round_downSkin extends flash.display.MovieClip
    {
        public function Blue_Button_Round_downSkin()
        {
            super();
            return;
        }
    }
}


//  class Blue_Button_Round_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class Blue_Button_Round_overSkin extends flash.display.MovieClip
    {
        public function Blue_Button_Round_overSkin()
        {
            super();
            return;
        }
    }
}


//  class CellRenderer_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class CellRenderer_disabledSkin extends flash.display.MovieClip
    {
        public function CellRenderer_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class CellRenderer_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class CellRenderer_downSkin extends flash.display.MovieClip
    {
        public function CellRenderer_downSkin()
        {
            super();
            return;
        }
    }
}


//  class CellRenderer_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class CellRenderer_overSkin extends flash.display.MovieClip
    {
        public function CellRenderer_overSkin()
        {
            super();
            return;
        }
    }
}


//  class CellRenderer_selectedDisabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class CellRenderer_selectedDisabledSkin extends flash.display.MovieClip
    {
        public function CellRenderer_selectedDisabledSkin()
        {
            super();
            return;
        }
    }
}


//  class CellRenderer_selectedDownSkin
package 
{
    import flash.display.*;
    
    public dynamic class CellRenderer_selectedDownSkin extends flash.display.MovieClip
    {
        public function CellRenderer_selectedDownSkin()
        {
            super();
            return;
        }
    }
}


//  class CellRenderer_selectedOverSkin
package 
{
    import flash.display.*;
    
    public dynamic class CellRenderer_selectedOverSkin extends flash.display.MovieClip
    {
        public function CellRenderer_selectedOverSkin()
        {
            super();
            return;
        }
    }
}


//  class CellRenderer_selectedUpSkin
package 
{
    import flash.display.*;
    
    public dynamic class CellRenderer_selectedUpSkin extends flash.display.MovieClip
    {
        public function CellRenderer_selectedUpSkin()
        {
            super();
            return;
        }
    }
}


//  class CellRenderer_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class CellRenderer_upSkin extends flash.display.MovieClip
    {
        public function CellRenderer_upSkin()
        {
            super();
            return;
        }
    }
}


//  class Close_Button_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class Close_Button_disabledSkin extends flash.display.MovieClip
    {
        public function Close_Button_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class Close_Button_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class Close_Button_downSkin extends flash.display.MovieClip
    {
        public function Close_Button_downSkin()
        {
            super();
            return;
        }
    }
}


//  class Close_Button_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class Close_Button_overSkin extends flash.display.MovieClip
    {
        public function Close_Button_overSkin()
        {
            super();
            return;
        }
    }
}


//  class Close_Button_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class Close_Button_upSkin extends flash.display.MovieClip
    {
        public function Close_Button_upSkin()
        {
            super();
            return;
        }
    }
}


//  class CollectInfo
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class CollectInfo extends flash.display.MovieClip
    {
        public function CollectInfo()
        {
            super();
            return;
        }

        public var labelMaxLimit:flash.text.TextField;

        public var labelStartingLimit:flash.text.TextField;

        public var valueMaxLimit:flash.text.TextField;

        public var valueStartingLimit:flash.text.TextField;
    }
}


//  class CollectProgressBar
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class CollectProgressBar extends flash.display.MovieClip
    {
        public function CollectProgressBar()
        {
            super();
            return;
        }

        public var collectRanges:CollectInfo;

        public var labelStart:flash.text.TextField;
    }
}


//  class DepositProgressBar
package 
{
    import flash.display.*;
    
    public class DepositProgressBar extends flash.display.MovieClip
    {
        public function DepositProgressBar()
        {
            super();
            return;
        }

        public function set message(arg1:String):void
        {
            this._message = arg1;
            return;
        }

        public function get message():String
        {
            return this._message;
        }

        public var depositProgressText:WagerProgressText;

        internal var _message:String;
    }
}


//  class ExpiresIn
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class ExpiresIn extends flash.display.MovieClip
    {
        public function ExpiresIn()
        {
            super();
            return;
        }

        public var valueExpiresIn:flash.text.TextField;

        public var labelExpiresIn:flash.text.TextField;
    }
}


//  class FunBonusBalance
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class FunBonusBalance extends flash.display.MovieClip
    {
        public function FunBonusBalance()
        {
            super();
            return;
        }

        public var labelBalance:flash.text.TextField;
    }
}


//  class Green_Button_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class Green_Button_disabledSkin extends flash.display.MovieClip
    {
        public function Green_Button_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class Green_Button_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class Green_Button_downSkin extends flash.display.MovieClip
    {
        public function Green_Button_downSkin()
        {
            super();
            return;
        }
    }
}


//  class Green_Button_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class Green_Button_overSkin extends flash.display.MovieClip
    {
        public function Green_Button_overSkin()
        {
            super();
            return;
        }
    }
}


//  class Green_Button_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class Green_Button_upSkin extends flash.display.MovieClip
    {
        public function Green_Button_upSkin()
        {
            super();
            return;
        }
    }
}


//  class HeaderTxt
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class HeaderTxt extends flash.display.MovieClip
    {
        public function HeaderTxt()
        {
            super();
            return;
        }

        public var headertxt:flash.text.TextField;
    }
}


//  class Header_FunBonus
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class Header_FunBonus extends flash.display.MovieClip
    {
        public function Header_FunBonus()
        {
            super();
            return;
        }

        public var logo:Logo_FunBonus;

        public var headerFunBonusText:flash.text.TextField;
    }
}


//  class Header_Queue
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class Header_Queue extends flash.display.MovieClip
    {
        public function Header_Queue()
        {
            super();
            return;
        }

        public var QueueNumberText:flash.text.TextField;
    }
}


//  class Left_Button_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class Left_Button_disabledSkin extends flash.display.MovieClip
    {
        public function Left_Button_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class Left_Button_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class Left_Button_downSkin extends flash.display.MovieClip
    {
        public function Left_Button_downSkin()
        {
            super();
            return;
        }
    }
}


//  class Left_Button_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class Left_Button_overSkin extends flash.display.MovieClip
    {
        public function Left_Button_overSkin()
        {
            super();
            return;
        }
    }
}


//  class Left_Button_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class Left_Button_upSkin extends flash.display.MovieClip
    {
        public function Left_Button_upSkin()
        {
            super();
            return;
        }
    }
}


//  class Link_Button_Skin
package 
{
    import flash.display.*;
    
    public dynamic class Link_Button_Skin extends flash.display.MovieClip
    {
        public function Link_Button_Skin()
        {
            super();
            return;
        }
    }
}


//  class Logo_FunBonus
package 
{
    import flash.display.*;
    
    public dynamic class Logo_FunBonus extends flash.display.MovieClip
    {
        public function Logo_FunBonus()
        {
            super();
            return;
        }
    }
}


//  class MainBalance
package 
{
    import com.mgs.funbonus.common.events.*;
    import com.mgs.funbonus.common.interfaces.*;
    import com.mgs.funbonus.components.dialogs.*;
    import com.mgs.funbonus.system.*;
    import com.mgs.funbonus.views.funbonus.*;
    import com.mgs.funbonus.views.funbonus.active.*;
    import com.mgs.funbonus.views.funbonus.queued.*;
    import com.mgs.funbonus.views.realmoney.*;
    import fl.core.*;
    import flash.display.*;
    import flash.events.*;
    import flash.external.*;
    import flash.net.*;
    import flash.system.*;
    import flash.utils.*;
    import mgs.greensock.*;
    import mgs.greensock.easing.*;
    import mgs.greensock.plugins.*;
    
    public class MainBalance extends fl.core.UIComponent implements com.mgs.funbonus.common.interfaces.IFunBonus
    {
        public function MainBalance()
        {
            super();
            flash.system.Security.allowDomain("*");
            mgs.greensock.plugins.TweenPlugin.activate([mgs.greensock.plugins.TransformAroundPointPlugin, mgs.greensock.plugins.TransformMatrixPlugin, mgs.greensock.plugins.TintPlugin, mgs.greensock.plugins.ColorTransformPlugin, mgs.greensock.plugins.ColorMatrixFilterPlugin, mgs.greensock.plugins.EndArrayPlugin]);
            if (stage) 
            {
                this.delayInit();
                this.stage.align = flash.display.StageAlign.BOTTOM_LEFT;
                this.stage.scaleMode = flash.display.StageScaleMode.NO_SCALE;
            }
            else 
            {
                addEventListener(flash.events.Event.ADDED_TO_STAGE, this.delayInit, false, 0, true);
            }
            return;
        }

        public function onHideSystem(arg1:Boolean=false, arg2:uint=1):void
        {
            if (this.system.showing == true) 
            {
                this.hide(arg2);
            }
            return;
        }

        internal function switchToRealPlay():void
        {
            var loc1:*=new com.mgs.funbonus.common.events.BonusPanelEvent(com.mgs.funbonus.common.events.BonusPanelEvent.SWITCHTOREALPLAY, true, true);
            this.dispatchEvent(loc1);
            return;
        }

        internal function handleFunBonusSwitch(arg1:Boolean=true):void
        {
            this.system.loading = true;
            if (this.system.type == "viper" || this.system.type == "aurora") 
            {
                this.system.switchToMode(com.mgs.funbonus.system.System.FUNPLAY);
            }
            else 
            {
                this.system.requestInformation();
            }
            return;
        }

        internal function clearMatrix(arg1:flash.display.DisplayObject):void
        {
            this.targetUI.mouseChildren = true;
            this.targetUI.mouseEnabled = true;
            this.system.showing = true;
            this.system.loading = false;
            this.loadUI();
            return;
        }

        public function get systemReference():com.mgs.funbonus.common.interfaces.IFunBonusComs
        {
            return this._systemReference;
        }

        public function packetReceived(arg1:uint, arg2:XML):void
        {
            this.system.setDoCachedResponse(false);
            this.system.onRequestBonus(arg1, arg2.toXMLString());
            return;
        }

        internal function overlayHandler(arg1:String, arg2:Boolean=true):void
        {
            if (this.system.playMode == com.mgs.funbonus.system.System.FUNPLAY) 
            {
                this.funBonus.mouseChildren = false;
                this.funBonus.mouseEnabled = false;
            }
            this.pollingRunning(false);
            var loc1:*=arg1;
            switch (loc1) 
            {
                case com.mgs.funbonus.system.System.REALPLAY:
                {
                    this.handleRealPlaySwitch();
                    break;
                }
                case com.mgs.funbonus.system.System.FUNPLAY:
                {
                    this.handleFunBonusSwitch();
                    break;
                }
                case com.mgs.funbonus.system.System.REMOVE:
                {
                    break;
                }
            }
            return;
        }

        internal function init(arg1:flash.events.Event=null):void
        {
            var loc5:*=0;
            removeEventListener(flash.events.Event.ADDED_TO_STAGE, this.init);
            var loc1:*=this.loaderInfo.parameters.host;
            var loc2:*=this.loaderInfo.parameters.serverid;
            if (this._host == null) 
            {
                this.system = com.mgs.funbonus.system.System.getInstance(loc1);
                this._host = loc1;
            }
            else 
            {
                this.system = com.mgs.funbonus.system.System.getInstance(this._host, this._systemReference);
            }
            this.system.loadedSignal.add(this.loadUI);
            this.system.alertSignal.add(this.alertDialogHandler);
            this.system.overlaySignal.add(this.overlayHandler);
            this.system.uiSignal.add(this.pollingRunning);
            var loc3:*;
            if ((loc3 = Number(this.system.readConfigString("funbonus.config", "DelayPollingInMin", "1")) * 60000) > 0) 
            {
                this.pollingTimer = new flash.utils.Timer(loc3);
                this.pollingTimer.addEventListener(flash.events.TimerEvent.TIMER, this.pollDelayed, false, 0, true);
            }
            var loc4:*;
            if ((loc4 = Number(this.system.readConfigString("funbonus.config", "AutoHideDelay", "5")) * 1000) > 0) 
            {
                this.autoHideTimer = new flash.utils.Timer(loc4);
                this.autoHideTimer.addEventListener(flash.events.TimerEvent.TIMER, this.autoHide, false, 0, true);
            }
            if (this._host != "viper") 
            {
                if (this._host != "aurora") 
                {
                    flash.external.ExternalInterface.addCallback("showSystem", this.onShowSystem);
                    flash.external.ExternalInterface.addCallback("hideSystem", this.onHideSystem);
                    flash.external.ExternalInterface.addCallback("onJSResize", this.onJSResize);
                    this.onShowSystem();
                }
                else 
                {
                    this.system.initComs();
                    loc5 = this._systemReference.getCasinoLoginStatus();
                }
            }
            else 
            {
                this.initTimer = new flash.utils.Timer(1000);
                this.initTimer.addEventListener(flash.events.TimerEvent.TIMER, this.initComs, false, 0, true);
                flash.external.ExternalInterface.addCallback("onInitCompleted", this.onInitCompleted);
                flash.external.ExternalInterface.addCallback("showSystem", this.onShowSystem);
                flash.external.ExternalInterface.addCallback("hideSystem", this.onHideSystem);
                flash.external.ExternalInterface.addCallback("onBalanceUpdated", this.onBalanceUpdated);
                flash.external.ExternalInterface.addCallback("onJSResize", this.onJSResize);
                this.system.initComs();
                this.initTimer.start();
            }
            return;
        }

        internal function autoHide(arg1:flash.events.TimerEvent):void
        {
            this.onHideSystem(false, 15);
            return;
        }

        internal function pollingRunning(arg1:Boolean):void
        {
            if (this.pollingTimer) 
            {
                if (arg1) 
                {
                    this.pollingTimer.start();
                }
                else 
                {
                    this.pollingTimer.stop();
                }
            }
            return;
        }

        public function hide(arg1:uint=15):void
        {
            this.system.showing = false;
            this.system.loading = false;
            if (this.pollingTimer) 
            {
                this.pollingTimer.stop();
            }
            if (this.autoHideTimer) 
            {
                this.autoHideTimer.stop();
            }
            if (this.currentAlertDialog != null) 
            {
                this.cancelDialogSignal(true);
            }
            if (this.targetUI != null) 
            {
                if (this.system.type != "aurora") 
                {
                    mgs.greensock.TweenLite.to(this.targetUI, arg1, {"useFrames":true, "transformMatrix":{"scaleX":0, "scaleY":0, "y":730, "x":120}});
                }
                else 
                {
                    mgs.greensock.TweenLite.to(this.targetUI, arg1, {"useFrames":true, "transformMatrix":{"scaleX":0, "scaleY":0, "y":this._posY, "x":this._posX}});
                }
                if (this.autoHideTimer) 
                {
                    this.targetUI.removeEventListener(flash.events.MouseEvent.MOUSE_OUT, this.autoHideAdjust);
                    this.targetUI.removeEventListener(flash.events.MouseEvent.MOUSE_OVER, this.autoHideAdjust);
                }
            }
            return;
        }

        internal function playWithRealMoneySignal(arg1:int):void
        {
            this.currentAlertDialog.yesButton.enabled = false;
            this.system.activate(arg1, false);
            this.system.displayOverLay(com.mgs.funbonus.system.System.REALPLAY, false);
            return;
        }

        internal function alertDialogHandler(arg1:String, arg2:int):void
        {
            var loc1:*=arg1;
            switch (loc1) 
            {
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_COLLECT_INVALID:
                {
                    this.currentAlertDialog = new com.mgs.funbonus.components.dialogs.DialogFactory(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_COLLECT_INVALID, arg2);
                    this.currentAlertDialog.cancelSignal.add(this.cancelDialogSignal);
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_ACTIVATE:
                {
                    this.currentAlertDialog = new com.mgs.funbonus.components.dialogs.DialogFactory(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_ACTIVATE, arg2);
                    this.currentAlertDialog.acceptSignal.add(this.activateQueuedBonusSignal);
                    this.currentAlertDialog.cancelSignal.add(this.cancelDialogSignal);
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_COLLECT:
                {
                    this.currentAlertDialog = new com.mgs.funbonus.components.dialogs.DialogFactory(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_COLLECT, arg2);
                    this.currentAlertDialog.acceptSignal.add(this.collectBonusSignal);
                    this.currentAlertDialog.cancelSignal.add(this.cancelDialogSignal);
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_EXPIRED:
                {
                    this.currentAlertDialog = new com.mgs.funbonus.components.dialogs.DialogFactory(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_EXPIRED, arg2);
                    this.currentAlertDialog.acceptSignal.add(this.playWithRealMoneySignal);
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_PLAYTIME_EXPIRED:
                {
                    this.currentAlertDialog = new com.mgs.funbonus.components.dialogs.DialogFactory(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_PLAYTIME_EXPIRED, arg2);
                    if (this.system.depositAvailable) 
                    {
                        this.currentAlertDialog.acceptSignal.add(this.playWithRealMoneySignal_noFunds);
                    }
                    else 
                    {
                        this.currentAlertDialog.acceptSignal.add(this.playWithRealMoneySignal);
                    }
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_FUNDS_DEPLETED:
                {
                    this.currentAlertDialog = new com.mgs.funbonus.components.dialogs.DialogFactory(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_FUNDS_DEPLETED, arg2);
                    this.currentAlertDialog.acceptSignal.add(this.playWithRealMoneySignal_noFunds);
                    this.currentAlertDialog.queuedSignal.add(this.playWithRealMoneySignal);
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_EXPIRED_QUEUED:
                {
                    this.currentAlertDialog = new com.mgs.funbonus.components.dialogs.DialogFactory(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_EXPIRED_QUEUED, arg2);
                    this.currentAlertDialog.acceptSignal.add(this.playWithRealMoneySignal);
                    this.currentAlertDialog.queuedSignal.add(this.activateQueuedBonusSignal);
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_PLAYTIME_EXPIRED_QUEUED:
                {
                    this.currentAlertDialog = new com.mgs.funbonus.components.dialogs.DialogFactory(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_PLAYTIME_EXPIRED_QUEUED, arg2);
                    if (this.system.depositAvailable) 
                    {
                        this.currentAlertDialog.acceptSignal.add(this.playWithRealMoneySignal_noFunds);
                    }
                    else 
                    {
                        this.currentAlertDialog.acceptSignal.add(this.playWithRealMoneySignal);
                    }
                    this.currentAlertDialog.queuedSignal.add(this.activateQueuedBonusSignal);
                    break;
                }
                case com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_FUNDS_DEPLETED_QUEUED:
                {
                    this.currentAlertDialog = new com.mgs.funbonus.components.dialogs.DialogFactory(com.mgs.funbonus.components.dialogs.DialogFactory.TYPE_FUNDS_DEPLETED_QUEUED, arg2);
                    this.currentAlertDialog.acceptSignal.add(this.playWithRealMoneySignal_noFunds);
                    this.currentAlertDialog.queuedSignal.add(this.activateQueuedBonusSignal);
                    break;
                }
            }
            this.currentAlertDialog.x = this._posX + 10.5;
            this.currentAlertDialog.y = this.targetY + 140;
            if (this.autoHideTimer) 
            {
                this.currentAlertDialog.addEventListener(flash.events.MouseEvent.MOUSE_OUT, this.autoHideAdjust);
                this.currentAlertDialog.addEventListener(flash.events.MouseEvent.MOUSE_OVER, this.autoHideAdjust);
            }
            if (this.currentAlertDialog != null) 
            {
                mgs.greensock.TweenLite.to(this.funBonus, 1, {"colorTransform":{"tint":0, "tintAmount":0.5, "brightness":0.2}});
                this.addChild(this.currentAlertDialog);
                this.currentAlertDialog.drawNow();
                this.funBonus.mouseChildren = false;
                this.funBonus.mouseEnabled = true;
            }
            return;
        }

        internal function playWithRealMoneySignal_noFunds(arg1:int):void
        {
            this.currentAlertDialog.yesButton.enabled = false;
            this.system.displayOverLay(com.mgs.funbonus.system.System.REALPLAY, false);
            return;
        }

        internal function loadUI():void
        {
            var loc1:*=NaN;
            this.targetUI = null;
            while (this.numChildren != 0) 
            {
                this.removeChildAt(0);
            }
            if (this.system.playMode == com.mgs.funbonus.system.System.FUNPLAY) 
            {
                if (this.system.playMode == com.mgs.funbonus.system.System.FUNPLAY) 
                {
                    this.system.updateUIMode(com.mgs.funbonus.system.System.UI_ACTIVE_TAB);
                    if (this.system.currentState != com.mgs.funbonus.system.System.ACTIVE) 
                    {
                        if (this.system.currentState == com.mgs.funbonus.system.System.QUEUED) 
                        {
                            this.funBonus = new com.mgs.funbonus.views.funbonus.queued.QueuedBonus();
                        }
                    }
                    else 
                    {
                        this.funBonus = new com.mgs.funbonus.views.funbonus.active.ActiveBonus();
                    }
                    this.componentHeight = 440;
                    this.targetUI = this.funBonus;
                    this.funBonus.switchSignal.add(this.switchToMode);
                    this.funBonus.closeSignal.add(this.system.evtHide);
                    this.funBonus.dataProvider = this.system.funBonusDataProvider;
                    this.funBonus.setPlayMode(this.system.playMode);
                    if (this.system.type != "aurora") 
                    {
                        this._posY = 280;
                        this.funBonus.y = loc2 = 280;
                        this.targetY = loc2;
                        flash.external.ExternalInterface.call("balanceobject.updateMainBalanceSize", 281, this.componentHeight);
                    }
                    else if (this._posY < this.componentHeight) 
                    {
                        this.funBonus.y = loc2 = this._posY;
                        this.targetY = loc2;
                    }
                    else 
                    {
                        this.funBonus.y = loc2 = this._posY - this.componentHeight;
                        this.targetY = loc2;
                    }
                    this.funBonus.x = this._posX;
                    if (this.system.loading == true) 
                    {
                        mgs.greensock.TweenLite.to(this.funBonus, 0, {"transformMatrix":{"scaleX":0.1, "scaleY":0.1}});
                    }
                    this.addChild(this.funBonus);
                    this.drawNow();
                }
            }
            else 
            {
                this.realMoney = new com.mgs.funbonus.views.realmoney.RealMoney();
                this.realMoney.width = 281;
                this.realMoney.height = 137;
                this.realMoney.realMoneyCollectionItem = this.system.realMoneyCollectionItem;
                this.realMoney.closeSignal.add(this.system.evtHide);
                this.realMoney.switchSignal.add(this.switchToMode);
                this.realMoney.x = this._posX;
                this.targetUI = this.realMoney;
                if (this.system.realMoneyCollectionItem.showLink) 
                {
                    this.componentHeight = 187;
                    if (this.system.type != "aurora") 
                    {
                        this._posY = 525;
                        this.realMoney.y = loc2 = 525;
                        this.targetY = loc2;
                        flash.external.ExternalInterface.call("balanceobject.updateMainBalanceSize", 281, this.componentHeight + 10);
                    }
                    else if (this._posY < this.componentHeight) 
                    {
                        var loc2:*;
                        this.realMoney.y = loc2 = this._posY;
                        this.targetY = loc2;
                    }
                    else 
                    {
                        this.realMoney.y = loc2 = this._posY - this.componentHeight;
                        this.targetY = loc2;
                    }
                }
                else 
                {
                    this.componentHeight = 137;
                    if (this.system.type != "aurora") 
                    {
                        flash.external.ExternalInterface.call("balanceobject.updateMainBalanceSize", 281, this.componentHeight);
                        this._posY = 585;
                        this.realMoney.y = loc2 = 585;
                        this.targetY = loc2;
                    }
                    else if (this._posY < this.componentHeight) 
                    {
                        this.realMoney.y = loc2 = this._posY;
                        this.targetY = loc2;
                    }
                    else 
                    {
                        this.realMoney.y = loc2 = this._posY - this.componentHeight;
                        this.targetY = loc2;
                    }
                }
                if (this.system.loading == true) 
                {
                    this.realMoney.y = this.targetY;
                    mgs.greensock.TweenLite.to(this.realMoney, 0, {"transformMatrix":{"scaleX":0.1, "scaleY":0.1}});
                }
                this.system.updateUIMode(com.mgs.funbonus.system.System.REALPLAY);
                this.addChild(this.realMoney);
                this.drawNow();
            }
            if (this.autoHideTimer) 
            {
                this.targetUI.addEventListener(flash.events.MouseEvent.MOUSE_OUT, this.autoHideAdjust);
                this.targetUI.addEventListener(flash.events.MouseEvent.MOUSE_OVER, this.autoHideAdjust);
            }
            if (this.system.loading != true) 
            {
                if (this.system.showing) 
                {
                    loc1 = this.componentHeight - this.componentHeight * this.scaley;
                    loc1 = this.targetY + loc1;
                    mgs.greensock.TweenLite.to(this.targetUI, 0, {"useFrames":true, "transformMatrix":{"scaleX":this.scalex, "scaleY":this.scaley, "y":loc1}});
                    if (this.system.playMode == com.mgs.funbonus.system.System.FUNPLAY) 
                    {
                        this.funBonus.checkStatus();
                    }
                }
            }
            else 
            {
                this.show();
            }
            return;
        }

        public function onInitCompleted():void
        {
            if (this.initTimer.running) 
            {
                this.initTimer.stop();
            }
            return;
        }

        public function show(arg1:uint=20):void
        {
            this.targetUI.mouseChildren = false;
            this.targetUI.mouseEnabled = false;
            if (this.system.type != "aurora") 
            {
                this.targetUI.y = 700;
                this.targetUI.x = 120;
            }
            else 
            {
                this.targetUI.y = this._posY;
                this.targetUI.x = this._posX;
            }
            var loc1:*=this.componentHeight - this.componentHeight * this.scaley;
            loc1 = this.targetY + loc1;
            mgs.greensock.TweenLite.to(this.targetUI, arg1, {"useFrames":true, "transformMatrix":{"scaleX":this.scalex, "scaleY":this.scaley, "y":loc1, "x":this._posX}, "onComplete":this.clearMatrix, "onCompleteParams":[this.targetUI]});
            return;
        }

        public function autoHideAdjust(arg1:flash.events.MouseEvent):void
        {
            var loc1:*=arg1.type;
            switch (loc1) 
            {
                case flash.events.MouseEvent.MOUSE_OUT:
                {
                    this.autoHideTimer.start();
                    break;
                }
                case flash.events.MouseEvent.MOUSE_OVER:
                {
                    if (this.autoHideTimer.running) 
                    {
                        this.autoHideTimer.reset();
                    }
                    break;
                }
            }
            return;
        }

        internal function pollDelayed(arg1:flash.events.TimerEvent):void
        {
            this.system.requestInformation(true);
            return;
        }

        internal function collectBonusSignal(arg1:int):void
        {
            this.cancelDialogSignal();
            this.system.collect(arg1);
            return;
        }

        internal function handleRealPlaySwitch(arg1:Boolean=true):void
        {
            this.system.loading = true;
            if (this.system.type == "viper" || this.system.type == "aurora") 
            {
                this.system.switchToMode(com.mgs.funbonus.system.System.REALPLAY);
            }
            else 
            {
                this.system.requestInformation();
            }
            return;
        }

        internal function activateQueuedBonusSignal(arg1:int):void
        {
            this.cancelDialogSignal();
            this.system.activate(arg1);
            return;
        }

        public function onJSResize():void
        {
            var loc1:*;
            this.currentWidth = flash.external.ExternalInterface.call("getWidth");
            this.currentHeight = flash.external.ExternalInterface.call("getHeight");
            try 
            {
                if (this.currentHeight < this.system.NORMAL_HEIGHT) 
                {
                    this.scaley = this.currentHeight / this.system.NORMAL_HEIGHT;
                }
                else 
                {
                    this.scaley = 1;
                }
                if (this.currentWidth < this.system.NORMAL_WIDTH) 
                {
                    this.scalex = this.currentWidth / this.system.NORMAL_WIDTH;
                }
                else 
                {
                    this.scalex = 1;
                }
            }
            catch (er:Error)
            {
            };
            this.hide(0);
            this.system.evtHide();
            return;
        }

        internal function cancelDialogSignal(arg1:Boolean=false):void
        {
            if (!arg1) 
            {
                mgs.greensock.TweenLite.to(this.funBonus, 1, {"colorTransform":{"tint":0, "tintAmount":0, "brightness":0.5}});
            }
            this.funBonus.mouseChildren = true;
            this.funBonus.mouseEnabled = true;
            this.currentAlertDialog.cancelSignal.removeAll();
            this.currentAlertDialog.acceptSignal.removeAll();
            this.removeChild(this.currentAlertDialog);
            this.currentAlertDialog = null;
            return;
        }

        public function setup(arg1:String, arg2:com.mgs.funbonus.common.interfaces.IFunBonusComs):void
        {
            this._host = arg1;
            this._systemReference = arg2;
            return;
        }

        public function setCoordinates(arg1:int, arg2:int):void
        {
            this._posX = arg1;
            this._posY = arg2;
            return;
        }

        internal function delayInit(arg1:flash.events.Event=null):void
        {
            if (this._host != "aurora") 
            {
                flash.utils.setTimeout(this.init, 5000);
            }
            else 
            {
                this.init(arg1);
            }
            return;
        }

        internal function switchToMode(arg1:String):void
        {
            this.system.displayOverLay(arg1);
            return;
        }

        public function onBalanceUpdated():void
        {
            this.system.loading = false;
            this.system.requestInformation();
            return;
        }

        
        {
            v_versionid = "27.0.1.2";
            v_copyright = "copyright (c) Microgaming 2012";
            v_product = "MainBalance";
        }

        public function onShowSystem():void
        {
            if (this.system.showing == false && this.system.loading == false && !(this.system.coms.getCasinoLoginStatus() == -1)) 
            {
                if (this.autoHideTimer) 
                {
                    this.autoHideTimer.start();
                }
                if (this.pollingTimer) 
                {
                    this.pollingTimer.start();
                }
                this.system.loading = true;
                this.system.requestInformation(false);
            }
            return;
        }

        public function initComs(arg1:flash.events.TimerEvent):void
        {
            this.system.showing = false;
            this.system.initComs();
            return;
        }

        internal var currentHeight:Number;

        internal var container:fl.core.UIComponent;

        internal var _host:String=null;

        internal var initTimer:flash.utils.Timer;

        internal var currentState:String;

        internal var recieveConnection:flash.net.LocalConnection;

        internal var componentHeight:Number;

        internal var _systemReference:com.mgs.funbonus.common.interfaces.IFunBonusComs;

        internal var autoHideTimer:flash.utils.Timer;

        internal var realMoney:com.mgs.funbonus.views.realmoney.RealMoney;

        internal var syncLock:Boolean=false;

        internal var currentWidth:Number;

        internal var componentWidth:Number;

        internal var scalex:Number=1;

        internal var scaley:Number=1;

        public var system:com.mgs.funbonus.system.System;

        internal var funBonus:com.mgs.funbonus.views.funbonus.FunBonus;

        internal var targetY:Number;

        internal var pollingTimer:flash.utils.Timer;

        internal var currentAlertDialog:com.mgs.funbonus.components.dialogs.DialogFactory;

        internal var _posX:int=10;

        internal var _posY:int=500;

        internal var animating:Boolean=false;

        public static var v_product:String="MainBalance";

        public static var v_versionid:String="27.0.1.2";

        public static var v_copyright:String="copyright (c) Microgaming 2012";

        internal var targetUI:*;
    }
}


//  class Panel_Dialog
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class Panel_Dialog extends flash.display.MovieClip
    {
        public function Panel_Dialog()
        {
            super();
            addFrameScript(0, this.frame1, 1, this.frame2, 2, this.frame3, 3, this.frame4, 4, this.frame5);
            return;
        }

        internal function frame1():*
        {
            stop();
            return;
        }

        internal function frame2():*
        {
            stop();
            return;
        }

        internal function frame3():*
        {
            stop();
            return;
        }

        internal function frame4():*
        {
            stop();
            return;
        }

        internal function frame5():*
        {
            stop();
            return;
        }

        public var DialogHeading:flash.text.TextField;

        public var DialogMiddleText:flash.text.TextField;

        public var DialogText:flash.text.TextField;

        public var DialogTopText:flash.text.TextField;

        public var DialogBigText:flash.text.TextField;
    }
}


//  class Panel_Dialog_Line
package 
{
    import flash.display.*;
    
    public dynamic class Panel_Dialog_Line extends flash.display.MovieClip
    {
        public function Panel_Dialog_Line()
        {
            super();
            return;
        }
    }
}


//  class Panel_FunBonus
package 
{
    import flash.display.*;
    
    public dynamic class Panel_FunBonus extends flash.display.MovieClip
    {
        public function Panel_FunBonus()
        {
            super();
            addFrameScript(0, this.frame1, 1, this.frame2);
            return;
        }

        internal function frame1():*
        {
            stop();
            return;
        }

        internal function frame2():*
        {
            stop();
            return;
        }

        public var header:Header_FunBonus;
    }
}


//  class Panel_FunInner
package 
{
    import flash.display.*;
    
    public dynamic class Panel_FunInner extends flash.display.MovieClip
    {
        public function Panel_FunInner()
        {
            super();
            return;
        }
    }
}


//  class Panel_FunInner_Line
package 
{
    import flash.display.*;
    
    public dynamic class Panel_FunInner_Line extends flash.display.MovieClip
    {
        public function Panel_FunInner_Line()
        {
            super();
            return;
        }
    }
}


//  class Panel_RealMoney
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class Panel_RealMoney extends flash.display.MovieClip
    {
        public function Panel_RealMoney()
        {
            super();
            return;
        }

        public var txtTotalCredits:flash.text.TextField;

        public var txtBonus:flash.text.TextField;

        public var txtBalance:flash.text.TextField;

        public var HeaderRealMoneyText:flash.text.TextField;

        public var BonusNum:flash.text.TextField;

        public var BalanceNum:flash.text.TextField;

        public var TotalCreditsNum:flash.text.TextField;

        public var innerPanel:RealMoneyPanelInner;
    }
}


//  class Panel_RealMoney_Line
package 
{
    import flash.display.*;
    
    public dynamic class Panel_RealMoney_Line extends flash.display.MovieClip
    {
        public function Panel_RealMoney_Line()
        {
            super();
            return;
        }
    }
}


//  class QueuedBonusInner
package 
{
    import flash.display.*;
    
    public dynamic class QueuedBonusInner extends flash.display.MovieClip
    {
        public function QueuedBonusInner()
        {
            super();
            return;
        }
    }
}


//  class QueuedBonusLayer
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class QueuedBonusLayer extends flash.display.MovieClip
    {
        public function QueuedBonusLayer()
        {
            super();
            return;
        }

        public var MaxWinAmount:flash.text.TextField;

        public var StartingBalance:flash.text.TextField;

        public var ConditionLabel4:flash.text.TextField;

        public var ConditionLabel3:flash.text.TextField;

        public var ConditionLabel2:flash.text.TextField;

        public var ConditionLabel1:flash.text.TextField;

        public var ConditionLabel0:flash.text.TextField;

        public var ConditionNum4:flash.text.TextField;

        public var MaxWinAmountNum:flash.text.TextField;

        public var ConditionNum2:flash.text.TextField;

        public var ConditionNum3:flash.text.TextField;

        public var ConditionNum0:flash.text.TextField;

        public var ConditionNum1:flash.text.TextField;

        public var QueueNumber:Header_Queue;

        public var StartingBalanceNum:flash.text.TextField;
    }
}


//  class RealMoneyPanelInner
package 
{
    import flash.display.*;
    
    public dynamic class RealMoneyPanelInner extends flash.display.MovieClip
    {
        public function RealMoneyPanelInner()
        {
            super();
            addFrameScript(0, this.frame1, 1, this.frame2);
            return;
        }

        internal function frame1():*
        {
            stop();
            return;
        }

        internal function frame2():*
        {
            stop();
            return;
        }
    }
}


//  class Red_Button_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class Red_Button_disabledSkin extends flash.display.MovieClip
    {
        public function Red_Button_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class Red_Button_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class Red_Button_downSkin extends flash.display.MovieClip
    {
        public function Red_Button_downSkin()
        {
            super();
            return;
        }
    }
}


//  class Red_Button_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class Red_Button_overSkin extends flash.display.MovieClip
    {
        public function Red_Button_overSkin()
        {
            super();
            return;
        }
    }
}


//  class Red_Button_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class Red_Button_upSkin extends flash.display.MovieClip
    {
        public function Red_Button_upSkin()
        {
            super();
            return;
        }
    }
}


//  class RemainingTime
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class RemainingTime extends flash.display.MovieClip
    {
        public function RemainingTime()
        {
            super();
            return;
        }

        public var valuePlaytimeRemaining:flash.text.TextField;

        public var labelPlaytimeRemaining:flash.text.TextField;
    }
}


//  class Right_Button_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class Right_Button_disabledSkin extends flash.display.MovieClip
    {
        public function Right_Button_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class Right_Button_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class Right_Button_downSkin extends flash.display.MovieClip
    {
        public function Right_Button_downSkin()
        {
            super();
            return;
        }
    }
}


//  class Right_Button_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class Right_Button_overSkin extends flash.display.MovieClip
    {
        public function Right_Button_overSkin()
        {
            super();
            return;
        }
    }
}


//  class Right_Button_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class Right_Button_upSkin extends flash.display.MovieClip
    {
        public function Right_Button_upSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollArrowDown_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollArrowDown_disabledSkin extends flash.display.MovieClip
    {
        public function ScrollArrowDown_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollArrowDown_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollArrowDown_downSkin extends flash.display.MovieClip
    {
        public function ScrollArrowDown_downSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollArrowDown_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollArrowDown_overSkin extends flash.display.MovieClip
    {
        public function ScrollArrowDown_overSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollArrowDown_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollArrowDown_upSkin extends flash.display.MovieClip
    {
        public function ScrollArrowDown_upSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollArrowUp_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollArrowUp_disabledSkin extends flash.display.MovieClip
    {
        public function ScrollArrowUp_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollArrowUp_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollArrowUp_downSkin extends flash.display.MovieClip
    {
        public function ScrollArrowUp_downSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollArrowUp_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollArrowUp_overSkin extends flash.display.MovieClip
    {
        public function ScrollArrowUp_overSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollArrowUp_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollArrowUp_upSkin extends flash.display.MovieClip
    {
        public function ScrollArrowUp_upSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollBar_thumbIcon
package 
{
    import flash.display.*;
    
    public dynamic class ScrollBar_thumbIcon extends flash.display.MovieClip
    {
        public function ScrollBar_thumbIcon()
        {
            super();
            return;
        }
    }
}


//  class ScrollThumb_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollThumb_downSkin extends flash.display.MovieClip
    {
        public function ScrollThumb_downSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollThumb_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollThumb_overSkin extends flash.display.MovieClip
    {
        public function ScrollThumb_overSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollThumb_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollThumb_upSkin extends flash.display.MovieClip
    {
        public function ScrollThumb_upSkin()
        {
            super();
            return;
        }
    }
}


//  class ScrollTrack_skin
package 
{
    import flash.display.*;
    
    public dynamic class ScrollTrack_skin extends flash.display.MovieClip
    {
        public function ScrollTrack_skin()
        {
            super();
            return;
        }
    }
}


//  class SmallGreen_Button_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class SmallGreen_Button_disabledSkin extends flash.display.MovieClip
    {
        public function SmallGreen_Button_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class SmallGreen_Button_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class SmallGreen_Button_downSkin extends flash.display.MovieClip
    {
        public function SmallGreen_Button_downSkin()
        {
            super();
            return;
        }
    }
}


//  class SmallGreen_Button_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class SmallGreen_Button_overSkin extends flash.display.MovieClip
    {
        public function SmallGreen_Button_overSkin()
        {
            super();
            return;
        }
    }
}


//  class SmallGreen_Button_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class SmallGreen_Button_upSkin extends flash.display.MovieClip
    {
        public function SmallGreen_Button_upSkin()
        {
            super();
            return;
        }
    }
}


//  class SmallRed_Button_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class SmallRed_Button_disabledSkin extends flash.display.MovieClip
    {
        public function SmallRed_Button_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class SmallRed_Button_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class SmallRed_Button_downSkin extends flash.display.MovieClip
    {
        public function SmallRed_Button_downSkin()
        {
            super();
            return;
        }
    }
}


//  class SmallRed_Button_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class SmallRed_Button_overSkin extends flash.display.MovieClip
    {
        public function SmallRed_Button_overSkin()
        {
            super();
            return;
        }
    }
}


//  class SmallRed_Button_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class SmallRed_Button_upSkin extends flash.display.MovieClip
    {
        public function SmallRed_Button_upSkin()
        {
            super();
            return;
        }
    }
}


//  class Tab_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tab_disabledSkin extends flash.display.MovieClip
    {
        public function Tab_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class Tab_disabledSkin_left
package 
{
    import flash.display.*;
    
    public dynamic class Tab_disabledSkin_left extends flash.display.MovieClip
    {
        public function Tab_disabledSkin_left()
        {
            super();
            return;
        }
    }
}


//  class Tab_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tab_downSkin extends flash.display.MovieClip
    {
        public function Tab_downSkin()
        {
            super();
            return;
        }
    }
}


//  class Tab_downSkin_left
package 
{
    import flash.display.*;
    
    public dynamic class Tab_downSkin_left extends flash.display.MovieClip
    {
        public function Tab_downSkin_left()
        {
            super();
            return;
        }
    }
}


//  class Tab_focusRectSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tab_focusRectSkin extends flash.display.MovieClip
    {
        public function Tab_focusRectSkin()
        {
            super();
            return;
        }
    }
}


//  class Tab_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tab_overSkin extends flash.display.MovieClip
    {
        public function Tab_overSkin()
        {
            super();
            return;
        }
    }
}


//  class Tab_overSkin_left
package 
{
    import flash.display.*;
    
    public dynamic class Tab_overSkin_left extends flash.display.MovieClip
    {
        public function Tab_overSkin_left()
        {
            super();
            return;
        }
    }
}


//  class Tab_selectedDisabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tab_selectedDisabledSkin extends flash.display.MovieClip
    {
        public function Tab_selectedDisabledSkin()
        {
            super();
            return;
        }
    }
}


//  class Tab_selectedDownSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tab_selectedDownSkin extends flash.display.MovieClip
    {
        public function Tab_selectedDownSkin()
        {
            super();
            return;
        }
    }
}


//  class Tab_selectedOverSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tab_selectedOverSkin extends flash.display.MovieClip
    {
        public function Tab_selectedOverSkin()
        {
            super();
            return;
        }
    }
}


//  class Tab_selectedUpSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tab_selectedUpSkin extends flash.display.MovieClip
    {
        public function Tab_selectedUpSkin()
        {
            super();
            return;
        }
    }
}


//  class Tab_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tab_upSkin extends flash.display.MovieClip
    {
        public function Tab_upSkin()
        {
            super();
            return;
        }
    }
}


//  class Tab_upSkin_left
package 
{
    import flash.display.*;
    
    public dynamic class Tab_upSkin_left extends flash.display.MovieClip
    {
        public function Tab_upSkin_left()
        {
            super();
            return;
        }
    }
}


//  class TileList_skin
package 
{
    import flash.display.*;
    
    public dynamic class TileList_skin extends flash.display.MovieClip
    {
        public function TileList_skin()
        {
            super();
            return;
        }
    }
}


//  class TimeControl
package 
{
    import flash.display.*;
    
    public dynamic class TimeControl extends flash.display.MovieClip
    {
        public function TimeControl()
        {
            super();
            return;
        }

        public var expiresIn:ExpiresIn;

        public var header:HeaderTxt;

        public var remainingTime:RemainingTime;
    }
}


//  class Tutorial_Button_disabledSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tutorial_Button_disabledSkin extends flash.display.MovieClip
    {
        public function Tutorial_Button_disabledSkin()
        {
            super();
            return;
        }
    }
}


//  class Tutorial_Button_downSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tutorial_Button_downSkin extends flash.display.MovieClip
    {
        public function Tutorial_Button_downSkin()
        {
            super();
            return;
        }
    }
}


//  class Tutorial_Button_overSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tutorial_Button_overSkin extends flash.display.MovieClip
    {
        public function Tutorial_Button_overSkin()
        {
            super();
            return;
        }
    }
}


//  class Tutorial_Button_upSkin
package 
{
    import flash.display.*;
    
    public dynamic class Tutorial_Button_upSkin extends flash.display.MovieClip
    {
        public function Tutorial_Button_upSkin()
        {
            super();
            return;
        }
    }
}


//  class WagerProgressBar
package 
{
    import flash.display.*;
    
    public class WagerProgressBar extends flash.display.MovieClip
    {
        public function WagerProgressBar()
        {
            super();
            return;
        }

        public function set message(arg1:String):void
        {
            this._message = arg1;
            return;
        }

        public function get message():String
        {
            return this._message;
        }

        public var wagerProgressText:WagerProgressText;

        internal var _message:String;
    }
}


//  class WagerProgressText
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class WagerProgressText extends flash.display.MovieClip
    {
        public function WagerProgressText()
        {
            super();
            return;
        }

        public var label:flash.text.TextField;
    }
}


//  class WarningMessage
package 
{
    import flash.display.*;
    import flash.text.*;
    
    public dynamic class WarningMessage extends flash.display.MovieClip
    {
        public function WarningMessage()
        {
            super();
            return;
        }

        public var errorMessage:flash.text.TextField;
    }
}


//  class focusRectSkin
package 
{
    import flash.display.*;
    
    public dynamic class focusRectSkin extends flash.display.MovieClip
    {
        public function focusRectSkin()
        {
            super();
            return;
        }
    }
}


//  class myArial
package 
{
    import flash.text.*;
    
    public dynamic class myArial extends flash.text.Font
    {
        public function myArial()
        {
            super();
            return;
        }
    }
}


