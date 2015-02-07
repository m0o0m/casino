//ActionScript 3.0
//  package com
//    package mgs
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


//  package mgs
//    package aurora
//      package modules
//        package bonusBubble
//          package controller
//            class ActivateQueuedBonusCommand
package mgs.aurora.modules.bonusBubble.controller 
{
    import mgs.aurora.modules.bonusBubble.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ActivateQueuedBonusCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ActivateQueuedBonusCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            if (arg1.getBody() == null) 
            {
                (loc3 = new Object()).eAction = 1;
                this.facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.REQUEST_FUNBONUS, loc3, "funbonus_request");
            }
            else 
            {
                loc1 = mgs.aurora.modules.bonusBubble.BonusBubbleFacade.getInstance(mgs.aurora.modules.bonusBubble.BonusBubble.NAME);
                loc1.activateQueued = false;
                loc2 = XML(arg1.getBody());
                if (loc2.Response.FunBonusBalances.FunBonus.Active.length() > 0) 
                {
                    this.facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.CHANGE_BONUS_OFFER, true);
                }
                else 
                {
                    this.facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.CHANGE_BONUS_OFFER, false);
                }
            }
            return;
        }
    }
}


//            class ChangeSettingsCommand
package mgs.aurora.modules.bonusBubble.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.bonusBubble.*;
    import mgs.aurora.modules.bonusBubble.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ChangeSettingsCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ChangeSettingsCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc3:*=null;
            var loc1:*=flash.utils.Dictionary(arg1.getBody());
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy.NAME) as mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy;
            var loc4:*=0;
            var loc5:*=loc1;
            label322: for (loc3 in loc5) 
            {
                var loc6:*=loc3;
                switch (loc6) 
                {
                    case mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.SHOW_HEADING:
                    {
                        loc2.showtitle = Boolean(loc1[loc3]);
                        continue label322;
                    }
                    case mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.SHOW_BONUS_VALUE:
                    {
                        loc2.showbonusValue = Boolean(loc1[loc3]);
                        continue label322;
                    }
                    case mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.BONUS_TEXT:
                    {
                        loc2.bonusText = loc1[loc3];
                        continue label322;
                    }
                    case mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.CASH_TEXT:
                    {
                        loc2.cashText = loc1[loc3];
                        continue label322;
                    }
                    case mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.TITLE_TEXT:
                    {
                        loc2.titleText = loc1[loc3];
                        continue label322;
                    }
                    case mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.TOTAL_TEXT:
                    {
                        loc2.totalText = loc1[loc3];
                        continue label322;
                    }
                }
            }
            return;
        }
    }
}


//            class DisplayBubbleCommand
package mgs.aurora.modules.bonusBubble.controller 
{
    import flash.display.*;
    import flash.filters.*;
    import flash.text.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.bonusBubble.model.*;
    import mgs.aurora.modules.bonusBubble.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class DisplayBubbleCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function DisplayBubbleCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc7:*=null;
            var loc8:*=null;
            var loc9:*=null;
            var loc18:*=0;
            var loc19:*=null;
            var loc20:*=null;
            var loc21:*=null;
            var loc22:*=null;
            var loc23:*=null;
            var loc24:*=null;
            var loc25:*=null;
            var loc26:*=null;
            var loc27:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy.NAME) as mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.CurrentValuesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.CurrentValuesProxy;
            var loc3:*=this.facade.retrieveMediator(mgs.aurora.modules.bonusBubble.view.BubbleMediator.NAME) as mgs.aurora.modules.bonusBubble.view.BubbleMediator;
            var loc4:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.PointProxy.NAME) as mgs.aurora.modules.bonusBubble.model.PointProxy;
            var loc5:*=new flash.display.Sprite();
            var loc6:*;
            (loc6 = new flash.text.TextFormat()).font = loc1.font;
            loc6.size = loc1.fontSize;
            var loc10:*;
            if ((loc10 = mgs.aurora.modules.bonusBubble.model.FormattingProxy(facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME))).useCurrency) 
            {
                loc18 = loc10.standardCurrencyFormat;
                loc19 = loc10.currencyFormatInfo.getFormatfromISOCode(loc2.currencyISOCode, loc18, false);
                loc7 = mgs.aurora.common.utilities.BalanceUtils.formatNumberToCurrencyDisplay(loc2.cashBalance, loc19);
                loc20 = loc10.currencyFormatInfo.getFormatfromISOCode(loc2.currencyISOCode, 0, true);
                loc8 = mgs.aurora.common.utilities.BalanceUtils.formatNumberToCurrencyDisplay(loc2.bonusBalance, loc20);
                loc9 = mgs.aurora.common.utilities.BalanceUtils.formatNumberToCurrencyDisplay(loc2.totalBalance, loc20);
            }
            else 
            {
                loc7 = mgs.aurora.common.utilities.BalanceUtils.convertToCredits(loc2.cashBalance, true, loc10.tmSeparator, loc10.fSeparator);
                loc8 = mgs.aurora.common.utilities.BalanceUtils.convertToCredits(loc2.bonusBalance, true, loc10.tmSeparator, loc10.fSeparator);
                loc9 = mgs.aurora.common.utilities.BalanceUtils.convertToCredits(loc2.totalBalance, true, loc10.tmSeparator, loc10.fSeparator);
            }
            var loc11:*=12;
            if (loc1.showtitle) 
            {
                (loc21 = new flash.text.TextFormat()).font = loc1.font;
                loc21.size = loc1.fontSize;
                loc21.bold = true;
                (loc22 = this.createNewTitle(loc1.titleText, loc21)).y = loc11;
                loc11 = loc11 + (loc22.height + 5);
            }
            var loc12:*=this.createNewLabel(loc1.cashText, loc6);
            var loc13:*=this.createNewValue(loc7, loc6);
            if (loc1.showbonusValue) 
            {
                loc23 = this.createNewLabel(loc1.bonusText, loc6);
                loc24 = this.createNewLabel(loc1.totalText, loc6);
                loc25 = this.createNewValue(loc8, loc6);
                loc26 = this.createNewValue(loc9, loc6);
            }
            loc13.x = this._labelWidth + 30 + this._valueWidth - loc13.width;
            loc13.y = loc11;
            loc12.x = 10;
            loc12.y = loc11;
            if (loc1.showbonusValue) 
            {
                loc25.x = this._labelWidth + 30 + this._valueWidth - loc25.width;
                loc25.y = Math.round(loc13.y + loc13.height);
                loc26.x = this._labelWidth + 30 + this._valueWidth - loc26.width;
                loc26.y = Math.round(loc25.y + loc25.height) + 5;
                loc23.x = 10;
                loc23.y = Math.round(loc12.y + loc12.height);
                loc24.x = 10;
                loc24.y = Math.round(loc23.y + loc23.height) + 5;
            }
            var loc14:*=loc1.showbonusValue ? Math.round(loc24.y + loc24.height + 12) : Math.round(loc12.y + loc12.height + 12);
            var loc15:*=Math.round(40 + this._labelWidth + this._valueWidth);
            if (loc1.showtitle) 
            {
                loc22.x = Math.round(loc15 / 2 - loc22.width / 2);
            }
            var loc16:*=this.drawBackground(loc15, loc14);
            if (loc1.showbonusValue) 
            {
                (loc27 = loc16.graphics).beginFill(2236962, 1);
                loc27.drawRect(30 + this._labelWidth, loc26.y - 2, this._valueWidth, 1);
                loc27.endFill();
            }
            var loc17:*;
            (loc17 = new flash.filters.DropShadowFilter()).quality = 5;
            loc17.strength = 0.6;
            loc17.distance = 1;
            loc17.blurX = 7;
            loc17.blurY = 7;
            loc16.filters = [loc17];
            loc5.addChild(loc16);
            loc5.addChild(loc12);
            loc5.addChild(loc13);
            if (loc1.showbonusValue) 
            {
                loc5.addChild(loc23);
                loc5.addChild(loc24);
                loc5.addChild(loc25);
                loc5.addChild(loc26);
            }
            if (loc1.showtitle) 
            {
                loc5.addChild(loc22);
            }
            loc5.x = loc4.point.x - 9;
            loc5.y = loc4.point.y - 2 - loc5.height;
            loc5.alpha = 0;
            loc3.setViewComponent(loc5);
            return;
        }

        internal function createNewLabel(arg1:String, arg2:flash.text.TextFormat):flash.text.TextField
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy.NAME) as mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy;
            var loc2:*;
            (loc2 = this.createText(arg1, arg2)).selectable = false;
            loc2.embedFonts = loc1.embedFonts;
            loc2.antiAliasType = loc1.antiAliasType;
            this._labelWidth = this._labelWidth > loc2.width ? this._labelWidth : loc2.width;
            return loc2;
        }

        internal function createNewTitle(arg1:String, arg2:flash.text.TextFormat):flash.text.TextField
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy.NAME) as mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy;
            var loc2:*;
            (loc2 = this.createTitleText(arg1, arg2)).selectable = false;
            loc2.embedFonts = loc1.embedFonts;
            loc2.antiAliasType = loc1.antiAliasType;
            return loc2;
        }

        internal function createNewValue(arg1:String, arg2:flash.text.TextFormat):flash.text.TextField
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy.NAME) as mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy;
            var loc2:*;
            (loc2 = this.createText(arg1, arg2)).selectable = false;
            loc2.embedFonts = loc1.embedFonts;
            loc2.antiAliasType = loc1.antiAliasType;
            this._valueWidth = this._valueWidth > loc2.width ? this._valueWidth : loc2.width;
            return loc2;
        }

        internal function createText(arg1:String, arg2:flash.text.TextFormat):flash.text.TextField
        {
            var loc1:*=new flash.text.TextField();
            loc1.defaultTextFormat = arg2;
            loc1.text = arg1;
            loc1.autoSize = flash.text.TextFieldAutoSize.RIGHT;
            return loc1;
        }

        internal function createTitleText(arg1:String, arg2:flash.text.TextFormat):flash.text.TextField
        {
            var loc1:*=new flash.text.TextField();
            loc1.defaultTextFormat = arg2;
            loc1.text = arg1;
            loc1.autoSize = flash.text.TextFieldAutoSize.CENTER;
            return loc1;
        }

        internal function drawBackground(arg1:Number, arg2:Number):flash.display.Sprite
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy.NAME) as mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy;
            var loc2:*;
            var loc3:*;
            (loc3 = (loc2 = new flash.display.Sprite()).graphics).beginFill(loc1.lineColor, 1);
            loc3.drawRoundRect(0, 0, arg1, arg2, 20);
            loc3.moveTo(20, arg2);
            loc3.curveTo(20, arg2 + 10, 10, arg2 + 20);
            loc3.curveTo(30, arg2 + 20, 46, arg2);
            loc3.lineTo(20, arg2);
            loc3.beginFill(loc1.backgroundColor, 1);
            loc3.drawRoundRect(2, 2, arg1 - 4, arg2 - 4, 18);
            loc3.moveTo(22, arg2 - 2);
            loc3.curveTo(22, arg2 + 9, 14.5, arg2 + 17.75);
            loc3.curveTo(31, arg2 + 16, 44, arg2 - 2);
            loc3.lineTo(22, arg2 - 2);
            loc2.graphics.endFill();
            return loc2;
        }

        internal function formatCredits(arg1:Number):String
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME) as mgs.aurora.modules.bonusBubble.model.FormattingProxy;
            var loc2:*=arg1.toString();
            if (loc1.enabled) 
            {
                loc2 = mgs.aurora.common.utilities.BalanceUtils.convertToCredits(arg1, true, loc1.tmSeparator, loc1.fSeparator);
            }
            return loc2;
        }

        internal var _labelWidth:Number=0;

        internal var _valueWidth:Number=0;
    }
}


//            class DisposeCommand
package mgs.aurora.modules.bonusBubble.controller 
{
    import mgs.aurora.modules.bonusBubble.model.*;
    import mgs.aurora.modules.bonusBubble.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class DisposeCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function DisposeCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            this.facade.removeProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME);
            this.facade.removeProxy(mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy.NAME);
            this.facade.removeProxy(mgs.aurora.modules.bonusBubble.model.RequestTimerProxy.NAME);
            this.facade.removeProxy(mgs.aurora.modules.bonusBubble.model.RemoveTimerProxy.NAME);
            this.facade.removeProxy(mgs.aurora.modules.bonusBubble.model.CurrentValuesProxy.NAME);
            this.facade.removeProxy(mgs.aurora.modules.bonusBubble.model.PointProxy.NAME);
            this.facade.removeProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME);
            this.facade.removeMediator(mgs.aurora.modules.bonusBubble.view.HoverAreaMediator.NAME);
            this.facade.removeMediator(mgs.aurora.modules.bonusBubble.view.BonusBubbleMediator.NAME);
            return;
        }
    }
}


//            class PacketReceivedCommand
package mgs.aurora.modules.bonusBubble.controller 
{
    import mgs.aurora.modules.bonusBubble.*;
    import mgs.aurora.modules.bonusBubble.model.*;
    import mgs.aurora.modules.bonusBubble.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class PacketReceivedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function PacketReceivedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc3:*=null;
            var loc1:*=arg1.getBody() as XML;
            var loc2:*=loc1.Id.@verb;
            var loc4:*=this.facade.retrieveMediator(mgs.aurora.modules.bonusBubble.view.HoverAreaMediator.NAME) as mgs.aurora.modules.bonusBubble.view.HoverAreaMediator;
            var loc5:*=loc2.toLowerCase();
            switch (loc5) 
            {
                case "getbonusbalance":
                {
                    if (!(loc4 == null) && loc4.hitTest()) 
                    {
                        this.parseValidResponsePacket(loc1);
                    }
                    break;
                }
                case "currencybonusbalances":
                {
                    if (!(loc4 == null) && loc4.hitTest()) 
                    {
                        this.parseValidCurrencyResponsePacket(loc1);
                    }
                    break;
                }
                case "genericxml":
                {
                    this.setFunBonusCurrencyData(loc1);
                    this.facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.FUNBONUS_PACKET_RECEIVED, loc1);
                    break;
                }
                case "error":
                {
                    (loc3 = this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy).supported = false;
                    this.facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.ERROR_PACKET_RECEIVED, loc1);
                    break;
                }
            }
            return;
        }

        internal function setFunBonusCurrencyData(arg1:XML):void
        {
            var loc1:*=mgs.aurora.modules.bonusBubble.model.FormattingProxy(facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME));
            loc1.currencyCode = arg1.Response.FunBonusBalances.@Cur;
            return;
        }

        internal function parseValidResponsePacket(arg1:XML):void
        {
            var loc3:*=null;
            var loc1:*=arg1.Response.BonusBalances.@IsEnabled == "true";
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy;
            if (loc1) 
            {
                if (loc2.enabled && loc2.display) 
                {
                    (loc3 = this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.CurrentValuesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.CurrentValuesProxy).setData(arg1.Response.BonusBalances[0]);
                    this.facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.DISPLAY_BUBBLE, arg1);
                }
            }
            else 
            {
                loc2.supported = false;
            }
            return;
        }

        internal function parseValidCurrencyResponsePacket(arg1:XML):void
        {
            var loc3:*=null;
            var loc1:*=arg1.Response.CurrencyBonusBalance.@isBonusEnabled == "1";
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy;
            if (loc1) 
            {
                if (loc2.enabled && loc2.display) 
                {
                    (loc3 = this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.CurrentValuesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.CurrentValuesProxy).setData(arg1.Response.CurrencyBonusBalance[0]);
                    this.facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.DISPLAY_BUBBLE, arg1);
                }
            }
            else 
            {
                loc2.supported = false;
            }
            return;
        }
    }
}


//            class ResetCommand
package mgs.aurora.modules.bonusBubble.controller 
{
    import mgs.aurora.modules.bonusBubble.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ResetCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ResetCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy;
            loc1.supported = true;
            return;
        }
    }
}


//            class SendPacketCommand
package mgs.aurora.modules.bonusBubble.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.bonusBubble.*;
    import mgs.aurora.modules.bonusBubble.model.*;
    import mgs.aurora.modules.bonusBubble.model.Coms.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SendPacketCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SendPacketCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            if (arg1.getType() != mgs.aurora.modules.bonusBubble.model.Coms.AuroraComs.FUNBONUS_REQUEST) 
            {
                loc1 = this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME) as mgs.aurora.modules.bonusBubble.model.FormattingProxy;
                if (loc1.useFunBonusBubble) 
                {
                    this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SHOW_FUNBONUS);
                }
                else if (loc1.useCurrency) 
                {
                    this.sendVersion2Packet();
                }
                else 
                {
                    this.sendVersion1Packet();
                }
            }
            else 
            {
                this.sendFunBonusPacket(arg1);
            }
            return;
        }

        internal function sendFunBonusPacket(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.XManProxy.NAME) as mgs.aurora.modules.bonusBubble.model.XManProxy;
            var loc2:*=new flash.utils.Dictionary();
            var loc3:*=arg1.getBody();
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] = "10001";
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] = "1";
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] = "FunBonus";
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = "GenericXML";
            var loc4:*=String(loc3.eAction);
            switch (loc4) 
            {
                case "1":
                {
                    loc2[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request><FunBonusBalances/></Request>");
                    break;
                }
                case "2":
                {
                    loc2[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request><FunBonusCollect/></Request>");
                    break;
                }
                case "3":
                {
                    loc2[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request><FunBonusForfeit/></Request>");
                    break;
                }
                case "4":
                {
                    loc2[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request><FunBonusOutofplaytime/></Request>");
                    break;
                }
                default:
                {
                    loc2[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request><FunBonusBalances/></Request>");
                    break;
                }
            }
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] = true;
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] = "onFunBonusEvent";
            loc1.sendPacket(loc2);
            return;
        }

        internal function sendVersion1Packet():void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.XManProxy.NAME) as mgs.aurora.modules.bonusBubble.model.XManProxy;
            var loc2:*=new flash.utils.Dictionary();
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] = "10001";
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] = "1";
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] = "GetBonusBalance";
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = "GetBonusBalance";
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request/>");
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] = true;
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] = "onGetBonusBalance";
            loc1.sendPacket(loc2);
            return;
        }

        internal function sendVersion2Packet():void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.XManProxy.NAME) as mgs.aurora.modules.bonusBubble.model.XManProxy;
            var loc2:*=new flash.utils.Dictionary();
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] = "10001";
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] = "1";
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] = "CurrencyBonusBalances";
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = "CurrencyBonusBalances";
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request/>");
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] = true;
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] = "onCurrencyBonusBalances";
            loc1.sendPacket(loc2);
            return;
        }
    }
}


//            class SetupCommand
package mgs.aurora.modules.bonusBubble.controller 
{
    import flash.display.*;
    import flash.utils.*;
    import mgs.aurora.common.enums.bonusBubble.*;
    import mgs.aurora.common.enums.configMapping.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.common.interfaces.currency.*;
    import mgs.aurora.modules.bonusBubble.model.*;
    import mgs.aurora.modules.bonusBubble.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetupCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetupCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as flash.utils.Dictionary;
            this.setupSessionProxy(loc1[mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.SESSION_PROXY]);
            this.setupXman(loc1[mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.XMAN_MODULE]);
            this.setupConfig(loc1[mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.CONFIG_XML]);
            this.setupStrings(loc1[mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.XML_STRINGS]);
            this.setupFunBonus(loc1[mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.FUN_BONUS_CONFIG], loc1[mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.FUN_BONUS_MODULE]);
            this.setUpFormatInfo(loc1[mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.CURRENCY_SUPPORTED], loc1[mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.CURRENCY_XML], loc1[mgs.aurora.common.enums.bonusBubble.BonusBubbleConfigKeys.STANDARD_CURRENCY_FORMAT]);
            return;
        }

        internal function setupFunBonus(arg1:XML, arg2:flash.display.DisplayObject):void
        {
            var loc1:*=mgs.aurora.modules.bonusBubble.model.SessionProxy(this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SessionProxy.NAME));
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME) as mgs.aurora.modules.bonusBubble.model.FormattingProxy;
            var loc3:*=loc1.getData()[mgs.aurora.common.enums.configMapping.SessionConfig.FUN_BONUS_TYPE];
            loc2.useFunBonusBubble = loc3 == mgs.aurora.common.enums.bonusBubble.BonusBubbleTypes.NEW_GREY_BUBBLE || loc3 == mgs.aurora.common.enums.bonusBubble.BonusBubbleTypes.FULL_FUN_BONUS_BUBBLE;
            loc2.allowFunBonus = loc3 == mgs.aurora.common.enums.bonusBubble.BonusBubbleTypes.FULL_FUN_BONUS_BUBBLE;
            loc2.funBonusConfig = arg1;
            if (loc2.useFunBonusBubble) 
            {
                this.facade.registerMediator(new mgs.aurora.modules.bonusBubble.view.MainBalanceMediator(arg2));
            }
            return;
        }

        internal function setupSessionProxy(arg1:Object):void
        {
            if (arg1 != null) 
            {
                if (this.facade.hasProxy(mgs.aurora.modules.bonusBubble.model.SessionProxy.NAME)) 
                {
                    this.facade.removeProxy(mgs.aurora.modules.bonusBubble.model.SessionProxy.NAME);
                }
                this.facade.registerProxy(new mgs.aurora.modules.bonusBubble.model.SessionProxy(arg1));
            }
            return;
        }

        internal function setupXman(arg1:mgs.aurora.common.interfaces.comms.IXManPacketSender):void
        {
            if (arg1 != null) 
            {
                if (this.facade.hasProxy(mgs.aurora.modules.bonusBubble.model.XManProxy.NAME)) 
                {
                    this.facade.removeProxy(mgs.aurora.modules.bonusBubble.model.XManProxy.NAME);
                }
                this.facade.registerProxy(new mgs.aurora.modules.bonusBubble.model.XManProxy(arg1));
            }
            return;
        }

        internal function setupStrings(arg1:XML):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.StringsProxy.NAME) as mgs.aurora.modules.bonusBubble.model.StringsProxy;
            loc1.setData(arg1);
            return;
        }

        internal function setupConfig(arg1:XML):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy.NAME) as mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.RequestTimerProxy.NAME) as mgs.aurora.modules.bonusBubble.model.RequestTimerProxy;
            var loc3:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.RemoveTimerProxy.NAME) as mgs.aurora.modules.bonusBubble.model.RemoveTimerProxy;
            loc1.setData(arg1);
            loc2.delay = loc1.requestDelay;
            loc3.delay = loc1.removeDelay;
            return;
        }

        internal function setUpFormatInfo(arg1:Boolean, arg2:mgs.aurora.common.interfaces.currency.ICurrency, arg3:int):void
        {
            var loc1:*;
            (loc1 = this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME) as mgs.aurora.modules.bonusBubble.model.FormattingProxy).useCurrency = arg1;
            loc1.currencyFormatInfo = arg2;
            loc1.standardCurrencyFormat = arg3;
            return;
        }
    }
}


//            class StartupCommand
package mgs.aurora.modules.bonusBubble.controller 
{
    import mgs.aurora.modules.bonusBubble.model.*;
    import mgs.aurora.modules.bonusBubble.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class StartupCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function StartupCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            this.facade.registerProxy(new mgs.aurora.modules.bonusBubble.model.SwitchesProxy());
            this.facade.registerProxy(new mgs.aurora.modules.bonusBubble.model.DisplayConfigProxy());
            this.facade.registerProxy(new mgs.aurora.modules.bonusBubble.model.RequestTimerProxy());
            this.facade.registerProxy(new mgs.aurora.modules.bonusBubble.model.RemoveTimerProxy());
            this.facade.registerProxy(new mgs.aurora.modules.bonusBubble.model.CurrentValuesProxy());
            this.facade.registerProxy(new mgs.aurora.modules.bonusBubble.model.PointProxy());
            this.facade.registerProxy(new mgs.aurora.modules.bonusBubble.model.FormattingProxy());
            this.facade.registerProxy(new mgs.aurora.modules.bonusBubble.model.StringsProxy());
            this.facade.registerProxy(new mgs.aurora.modules.bonusBubble.model.AuroraFunBonusComsProxy());
            this.facade.registerMediator(new mgs.aurora.modules.bonusBubble.view.HoverAreaMediator());
            this.facade.registerMediator(new mgs.aurora.modules.bonusBubble.view.BubbleMediator());
            this.facade.registerMediator(new mgs.aurora.modules.bonusBubble.view.BonusBubbleMediator(arg1.getBody()));
            return;
        }
    }
}


//          package model
//            package Coms
//              class AuroraComs
package mgs.aurora.modules.bonusBubble.model.Coms 
{
    import com.mgs.funbonus.common.enums.*;
    import com.mgs.funbonus.common.interfaces.*;
    import mgs.aurora.common.enums.raptorSession.*;
    import mgs.aurora.common.events.funBonus.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.bonusBubble.*;
    import mgs.aurora.modules.bonusBubble.model.*;
    
    public class AuroraComs extends Object implements com.mgs.funbonus.common.interfaces.IFunBonusComs
    {
        public function AuroraComs()
        {
            super();
            this._facade = mgs.aurora.modules.bonusBubble.BonusBubbleFacade.getInstance(mgs.aurora.modules.bonusBubble.BonusBubble.NAME);
            return;
        }

        public function getCasinoLoginStatus():int
        {
            var loc1:*=mgs.aurora.modules.bonusBubble.model.SessionProxy(this._facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SessionProxy.NAME));
            return loc1.userType;
        }

        public function getCurrencyCode():String
        {
            var loc1:*=mgs.aurora.modules.bonusBubble.model.FormattingProxy(this._facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME));
            return loc1.currencyCode;
        }

        public function switchLogin(arg1:int):void
        {
            this._facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HIDE_FUNBONUS);
            this._facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SWITCH_USER, mgs.aurora.common.enums.raptorSession.UserTypes.REAL_USER);
            return;
        }

        public function requestBonusAction(arg1:uint, arg2:uint):void
        {
            var loc1:*=new Object();
            loc1.eAction = arg1;
            loc1.nUser = arg2;
            this._facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.REQUEST_FUNBONUS, loc1, mgs.aurora.modules.bonusBubble.model.Coms.AuroraComs.FUNBONUS_REQUEST);
            return;
        }

        public function formatCurrency(arg1:int, arg2:String):String
        {
            var loc3:*=0;
            var loc4:*=null;
            var loc5:*=null;
            var loc1:*=mgs.aurora.modules.bonusBubble.model.FormattingProxy(this._facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME));
            var loc2:*=mgs.aurora.modules.bonusBubble.model.SessionProxy(this._facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SessionProxy.NAME));
            if (loc1.useCurrency && !(loc2.userType == mgs.aurora.common.enums.raptorSession.UserTypes.FUN_BONUS)) 
            {
                loc3 = loc1.standardCurrencyFormat;
                loc4 = loc1.currencyFormatInfo.getFormatfromISOCode(loc1.currencyCode, loc3, false);
                return loc5 = mgs.aurora.common.utilities.BalanceUtils.formatNumberToCurrencyDisplay(arg1, loc4);
            }
            return mgs.aurora.common.utilities.BalanceUtils.convertToCredits(arg1, true, loc1.tmSeparator, loc1.fSeparator);
        }

        public function readConfigStringSKE(arg1:String, arg2:String, arg3:Number):String
        {
            var section:String;
            var key:String;
            var expandEnv:Number;
            var formattingProxy:mgs.aurora.modules.bonusBubble.model.FormattingProxy;
            var stringsProxy:mgs.aurora.modules.bonusBubble.model.StringsProxy;
            var text:String;

            var loc1:*;
            formattingProxy = null;
            stringsProxy = null;
            text = null;
            section = arg1;
            key = arg2;
            expandEnv = arg3;
            if (section.toLowerCase() == com.mgs.funbonus.common.enums.FunBonusEnums.FUNBONUS_CONFIG) 
            {
                formattingProxy = this._facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME) as mgs.aurora.modules.bonusBubble.model.FormattingProxy;
                var loc3:*=0;
                var loc4:*=formattingProxy.funBonusConfig.config;
                var loc2:*=new XMLList("");
                for each (var loc5:* in loc4) 
                {
                    var loc6:*;
                    with (loc6 = loc5) 
                    {
                        if (@id == key.toUpperCase()) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                return String(loc2.@value);
            }
            if (section.toLowerCase() == com.mgs.funbonus.common.enums.FunBonusEnums.FUNBONUS_STRINGS) 
            {
                stringsProxy = this._facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.StringsProxy.NAME) as mgs.aurora.modules.bonusBubble.model.StringsProxy;
                text = stringsProxy.getStringText(key.toUpperCase());
                text = this.formatString(text);
                return text;
            }
            return "";
        }

        internal function formatString(arg1:String):String
        {
            var loc1:*=arg1;
            loc1 = loc1.replace(new RegExp("-L-", "g"), "\n");
            loc1 = loc1.replace(new RegExp("-B-", "g"), "<b>");
            loc1 = loc1.replace(new RegExp("-B!-", "g"), " </b>");
            loc1 = loc1.replace(new RegExp("-U-", "g"), " <u>");
            loc1 = loc1.replace(new RegExp("-U!-", "g"), "</u>");
            return loc1;
        }

        public function initExternalComs():void
        {
            return;
        }

        public function executeCasinoFrameCommand(arg1:String, arg2:String=""):void
        {
            if (arg1 == "EVENT") 
            {
                var loc1:*=arg2;
                switch (loc1) 
                {
                    case mgs.aurora.common.events.funBonus.FunBonusEvents.FB_SWITCH_USER:
                    {
                        this._facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HIDE_FUNBONUS);
                        this._facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SWITCH_USER, mgs.aurora.common.enums.raptorSession.UserTypes.FUN_BONUS);
                        break;
                    }
                    case mgs.aurora.common.events.funBonus.FunBonusEvents.FB_SHOW_TUTORIAL:
                    case mgs.aurora.common.events.funBonus.FunBonusEvents.FP_SHOW_TC:
                    {
                        this._facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SHOW_FB_EXTERNAL, arg2);
                        break;
                    }
                    case mgs.aurora.common.events.funBonus.FunBonusEvents.FB_HIDE_BUBBLE:
                    {
                        this._facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HIDE_FUNBONUS);
                        break;
                    }
                }
            }
            return;
        }

        public function changeBonusOffer():void
        {
            this._facade.activateQueued = true;
            this._facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HIDE_FUNBONUS);
            this._facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.ACTIVATE_QUEUED_BONUS);
            return;
        }

        public static const FUNBONUS_REQUEST:String="funbonus_request";

        internal var _facade:mgs.aurora.modules.bonusBubble.BonusBubbleFacade;
    }
}


//            class AuroraFunBonusComsProxy
package mgs.aurora.modules.bonusBubble.model 
{
    import mgs.aurora.modules.bonusBubble.model.Coms.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class AuroraFunBonusComsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function AuroraFunBonusComsProxy(arg1:Object=null)
        {
            super(NAME, new mgs.aurora.modules.bonusBubble.model.Coms.AuroraComs());
            return;
        }

        public static const NAME:String="AuroraFunBonusComsProxy";
    }
}


//            class CurrentValuesProxy
package mgs.aurora.modules.bonusBubble.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class CurrentValuesProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function CurrentValuesProxy()
        {
            super(NAME, null);
            return;
        }

        public function get cashBalance():Number
        {
            return this.xml.@cashBalance;
        }

        public function get bonusBalance():Number
        {
            return this.xml.@bonusBalance;
        }

        public function get totalBalance():Number
        {
            return this.xml.@totalBalance;
        }

        public function get currencyISOCode():String
        {
            return this.xml.@currencyISOCode;
        }

        internal function get xml():XML
        {
            return this.data as XML;
        }

        public static const NAME:String="CurrentValuesProxy";
    }
}


//            class DisplayConfigProxy
package mgs.aurora.modules.bonusBubble.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class DisplayConfigProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function DisplayConfigProxy()
        {
            super(NAME, null);
            return;
        }

        public function get cashText():String
        {
            return this.xml.text.@cash;
        }

        public function set cashText(arg1:String):void
        {
            this.xml.text.@cash = arg1;
            return;
        }

        public function get bonusText():String
        {
            return this.xml.text.@bonus;
        }

        public function set bonusText(arg1:String):void
        {
            this.xml.text.@bonus = arg1;
            return;
        }

        public function get totalText():String
        {
            return this.xml.text.@total;
        }

        public function set totalText(arg1:String):void
        {
            this.xml.text.@total = arg1;
            return;
        }

        public function get titleText():String
        {
            return this.xml.text.@title;
        }

        public function set titleText(arg1:String):void
        {
            this.xml.text.@title = arg1;
            return;
        }

        public function get requestDelay():Number
        {
            return parseInt(this.xml.settings.@requestDelay.toString(), 10);
        }

        public function get removeDelay():Number
        {
            return parseInt(this.xml.settings.@removeDelay.toString(), 10);
        }

        public function get font():String
        {
            return this.xml.settings.@font;
        }

        public function get fontSize():Number
        {
            return parseInt(this.xml.settings.@size.toString(), 10);
        }

        public function get fontColor():Number
        {
            return parseInt(this.xml.settings.@color.toString(), 10);
        }

        public function get backgroundColor():Number
        {
            if (this.xml.settings.@backgroundColor.length() == 1) 
            {
                return parseInt(this.xml.settings.@backgroundColor.toString(), 16);
            }
            return 15724527;
        }

        public function get lineColor():Number
        {
            if (this.xml.settings.@lineColor.length() == 1) 
            {
                return parseInt(this.xml.settings.@lineColor.toString(), 16);
            }
            return 2236962;
        }

        public function get version():String
        {
            if (this.xml.@version.length() == 1) 
            {
                return this.xml.@version;
            }
            return "1";
        }

        public function get embedFonts():Boolean
        {
            if (this.xml.settings.@embeddedFonts.length() == 1) 
            {
                return this.xml.settings.@embeddedFonts.toString() == "true";
            }
            return false;
        }

        public function get antiAliasType():String
        {
            if (this.xml.settings.@antiAliasType.length() == 1) 
            {
                return this.xml.settings.@antiAliasType.toString();
            }
            return "advanced";
        }

        internal function get xml():XML
        {
            return this.data as XML;
        }

        public function get showbonusValue():Boolean
        {
            return this._showbonusValue;
        }

        public function set showbonusValue(arg1:Boolean):void
        {
            this._showbonusValue = arg1;
            return;
        }

        public function get showtitle():Boolean
        {
            return this._showtitle;
        }

        public function set showtitle(arg1:Boolean):void
        {
            this._showtitle = arg1;
            return;
        }

        public static const NAME:String="DisplayConfigProxy";

        internal var _showbonusValue:Boolean=true;

        internal var _showtitle:Boolean=false;
    }
}


//            class FormattingProxy
package mgs.aurora.modules.bonusBubble.model 
{
    import flash.utils.*;
    import mgs.aurora.common.interfaces.currency.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class FormattingProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function FormattingProxy()
        {
            super(NAME, new flash.utils.Dictionary());
            return;
        }

        public override function onRegister():void
        {
            this.data.enabled = false;
            this.data.fSeparator = ".";
            this.data.tmSeparator = " ";
            return;
        }

        public function get currencyCode():String
        {
            return this.data.currencyCode;
        }

        public function set currencyCode(arg1:String):void
        {
            this.data.currencyCode = arg1;
            return;
        }

        public function get enabled():Boolean
        {
            return this.data.enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            this.data.enabled = arg1;
            return;
        }

        public function get fSeparator():String
        {
            return this.data.fSeparator;
        }

        public function set fSeparator(arg1:String):void
        {
            this.data.fSeparator = arg1;
            return;
        }

        public function get tmSeparator():String
        {
            return this.data.tmSeparator;
        }

        public function set tmSeparator(arg1:String):void
        {
            this.data.tmSeparator = arg1;
            return;
        }

        public function set useCurrency(arg1:Boolean):void
        {
            this._useCurrency = arg1;
            return;
        }

        public function get useCurrency():Boolean
        {
            return this._useCurrency;
        }

        public function set currencyFormatInfo(arg1:mgs.aurora.common.interfaces.currency.ICurrency):void
        {
            this._currencyFormatInfo = arg1;
            return;
        }

        public function get currencyFormatInfo():mgs.aurora.common.interfaces.currency.ICurrency
        {
            return this._currencyFormatInfo;
        }

        public function set standardCurrencyFormat(arg1:int):void
        {
            this._standardCurrentFormat = arg1;
            return;
        }

        public function get standardCurrencyFormat():int
        {
            return this._standardCurrentFormat;
        }

        public function set useFunBonusBubble(arg1:Boolean):void
        {
            this._useFunBonusBubble = arg1;
            return;
        }

        public function get useFunBonusBubble():Boolean
        {
            return this._useFunBonusBubble;
        }

        public function set allowFunBonus(arg1:Boolean):void
        {
            this._allowFunBonus = arg1;
            return;
        }

        public function get allowFunBonus():Boolean
        {
            return this._allowFunBonus;
        }

        public function set funBonusConfig(arg1:XML):void
        {
            this._funBonusConfig = arg1;
            return;
        }

        public function get funBonusConfig():XML
        {
            return this._funBonusConfig;
        }

        public static const NAME:String="FormattingProxy";

        internal var _useCurrency:Boolean;

        internal var _currencyFormatInfo:mgs.aurora.common.interfaces.currency.ICurrency;

        internal var _standardCurrentFormat:int;

        internal var _useFunBonusBubble:Boolean;

        internal var _allowFunBonus:Boolean;

        internal var _funBonusConfig:XML;
    }
}


//            class PointProxy
package mgs.aurora.modules.bonusBubble.model 
{
    import flash.geom.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class PointProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function PointProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public function get point():flash.geom.Point
        {
            return this._customPoint != null ? this._customPoint.clone() : this._mousePoint.clone();
        }

        public function setMousePoint(arg1:flash.geom.Point):void
        {
            this._mousePoint = arg1;
            return;
        }

        public function set customPoint(arg1:flash.geom.Point):void
        {
            this._customPoint = arg1;
            return;
        }

        public function get customPoint():flash.geom.Point
        {
            return this._customPoint;
        }

        public static const NAME:String="PointProxy";

        internal var _mousePoint:flash.geom.Point=null;

        internal var _customPoint:flash.geom.Point=null;
    }
}


//            class RemoveTimerProxy
package mgs.aurora.modules.bonusBubble.model 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.modules.bonusBubble.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class RemoveTimerProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function RemoveTimerProxy(arg1:Object=null)
        {
            super(NAME, new flash.utils.Timer(500, 1));
            return;
        }

        public override function onRegister():void
        {
            this.timer.addEventListener(flash.events.TimerEvent.TIMER_COMPLETE, this.onTimer);
            return;
        }

        public override function onRemove():void
        {
            this.timer.removeEventListener(flash.events.TimerEvent.TIMER_COMPLETE, this.onTimer);
            return;
        }

        public function set delay(arg1:Number):void
        {
            this.timer.delay = arg1;
            return;
        }

        public function get delay():Number
        {
            return this.timer.delay;
        }

        public function start():void
        {
            this.timer.start();
            return;
        }

        public function stop():void
        {
            this.timer.stop();
            return;
        }

        internal function get timer():flash.utils.Timer
        {
            return this.data as flash.utils.Timer;
        }

        public function get running():Boolean
        {
            return this.timer.running;
        }

        internal function onTimer(arg1:flash.events.TimerEvent):void
        {
            this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.REMOVE_TIMER);
            return;
        }

        public static const NAME:String="RemoveTimerProxy";
    }
}


//            class RequestTimerProxy
package mgs.aurora.modules.bonusBubble.model 
{
    import flash.events.*;
    import flash.geom.*;
    import flash.utils.*;
    import mgs.aurora.modules.bonusBubble.*;
    import mgs.aurora.modules.bonusBubble.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class RequestTimerProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function RequestTimerProxy(arg1:Object=null)
        {
            super(NAME, new flash.utils.Timer(500, 1));
            return;
        }

        public override function onRegister():void
        {
            this.timer.addEventListener(flash.events.TimerEvent.TIMER_COMPLETE, this.onTimer);
            return;
        }

        public override function onRemove():void
        {
            this.timer.stop();
            this.timer.removeEventListener(flash.events.TimerEvent.TIMER_COMPLETE, this.onTimer);
            return;
        }

        public function set delay(arg1:Number):void
        {
            this.timer.delay = arg1;
            return;
        }

        public function get delay():Number
        {
            return this.timer.delay;
        }

        public function start():void
        {
            this.timer.start();
            return;
        }

        public function stop():void
        {
            this.timer.stop();
            return;
        }

        internal function get timer():flash.utils.Timer
        {
            return this.data as flash.utils.Timer;
        }

        public function get running():Boolean
        {
            return this.timer.running;
        }

        internal function onTimer(arg1:flash.events.TimerEvent):void
        {
            var loc1:*=this.facade.retrieveMediator(mgs.aurora.modules.bonusBubble.view.BonusBubbleMediator.NAME) as mgs.aurora.modules.bonusBubble.view.BonusBubbleMediator;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.PointProxy.NAME) as mgs.aurora.modules.bonusBubble.model.PointProxy;
            var loc3:*=new flash.geom.Point(loc1.stage.mouseX, loc1.stage.mouseY);
            loc2.setMousePoint(loc3);
            this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.REQUEST_TIMER);
            return;
        }

        public static const NAME:String="RequestTimerProxy";
    }
}


//            class SessionProxy
package mgs.aurora.modules.bonusBubble.model 
{
    import mgs.aurora.common.enums.configMapping.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class SessionProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function SessionProxy(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public function get userType():int
        {
            return getData()[mgs.aurora.common.enums.configMapping.SessionConfig.USERTYPE];
        }

        public static const NAME:String="SessionProxy";
    }
}


//            class StringsProxy
package mgs.aurora.modules.bonusBubble.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class StringsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function StringsProxy()
        {
            super(NAME, null);
            return;
        }

        public function getStringText(arg1:String):String
        {
            var id:String;

            var loc1:*;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.xml.string;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@ID == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            return loc2.@text;
        }

        internal function get xml():XML
        {
            return this.data as XML;
        }

        public static const NAME:String="StringsProxy";
    }
}


//            class SwitchesProxy
package mgs.aurora.modules.bonusBubble.model 
{
    import flash.utils.*;
    import mgs.aurora.modules.bonusBubble.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class SwitchesProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function SwitchesProxy(arg1:Object=false)
        {
            super(NAME, new flash.utils.Dictionary());
            return;
        }

        public override function onRegister():void
        {
            this.switches.enabled = true;
            this.switches.display = true;
            this.switches.supported = true;
            this.switches.displayed = false;
            return;
        }

        public function get enabled():Boolean
        {
            return this.switches.enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            if (arg1 != this.switches.enabled) 
            {
                this.switches.enabled = arg1;
                this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.ENABLED_STATE_CHANGED, this.switches.enabled);
            }
            return;
        }

        public function get supported():Boolean
        {
            return this.switches.supported;
        }

        public function set supported(arg1:Boolean):void
        {
            this.switches.supported = arg1;
            return;
        }

        public function get displayed():Boolean
        {
            return this.switches.displayed;
        }

        public function set displayed(arg1:Boolean):void
        {
            this.switches.displayed = arg1;
            return;
        }

        public function get display():Boolean
        {
            return this.switches.display;
        }

        public function set display(arg1:Boolean):void
        {
            if (arg1 != this.switches.display) 
            {
                this.switches.display = arg1;
                this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.DISPLAY_STATE_CHANGED, this.switches.display);
            }
            return;
        }

        internal function get switches():flash.utils.Dictionary
        {
            return this.data as flash.utils.Dictionary;
        }

        public static const NAME:String="SwitchesProxy";
    }
}


//            class XManProxy
package mgs.aurora.modules.bonusBubble.model 
{
    import flash.utils.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.modules.bonusBubble.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class XManProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function XManProxy(arg1:mgs.aurora.common.interfaces.comms.IXManPacketSender)
        {
            super(NAME, arg1);
            return;
        }

        public override function onRegister():void
        {
            this.xman.addEventListener("onGetBonusBalance", this.onXmanPacketReceived);
            this.xman.addEventListener("onCurrencyBonusBalances", this.onXmanPacketReceived);
            this.xman.addEventListener("onFunBonusEvent", this.onXmanPacketReceived);
            return;
        }

        public override function onRemove():void
        {
            this.xman.removeEventListener("onGetBonusBalance", this.onXmanPacketReceived);
            this.xman.removeEventListener("onCurrencyBonusBalances", this.onXmanPacketReceived);
            this.xman.removeEventListener("onFunBonusEvent", this.onXmanPacketReceived);
            return;
        }

        public function sendPacket(arg1:flash.utils.Dictionary):void
        {
            if (!this._pending) 
            {
                this._pending = true;
                this.xman.sendPacket(arg1);
            }
            return;
        }

        internal function onXmanPacketReceived(arg1:mgs.aurora.common.events.comms.PacketEvent):void
        {
            this._pending = false;
            this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.PACKET_RECEIVED, arg1.response);
            return;
        }

        internal function get xman():mgs.aurora.common.interfaces.comms.IXManPacketSender
        {
            return this.data as mgs.aurora.common.interfaces.comms.IXManPacketSender;
        }

        public static const NAME:String="XManProxy";

        internal var _pending:Boolean=false;
    }
}


//          package view
//            class BonusBubbleMediator
package mgs.aurora.modules.bonusBubble.view 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.modules.bonusBubble.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class BonusBubbleMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function BonusBubbleMediator(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.ERROR_PACKET_RECEIVED);
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SWITCH_USER);
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SHOW_FB_EXTERNAL);
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.CHANGE_BONUS_OFFER);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getName();
            switch (loc1) 
            {
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.ERROR_PACKET_RECEIVED:
                {
                    this.bonusBubble.onErrorPacket(arg1.getBody() as XML);
                    break;
                }
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SWITCH_USER:
                {
                    this.bonusBubble.switchUser(arg1.getBody() as uint);
                    break;
                }
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SHOW_FB_EXTERNAL:
                {
                    this.bonusBubble.dispatchEvent(new flash.events.Event(String(arg1.getBody())));
                    break;
                }
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.CHANGE_BONUS_OFFER:
                {
                    this.bonusBubble.changeBonusOffer(Boolean(arg1.getBody()));
                    break;
                }
            }
            return;
        }

        internal function get bonusBubble():mgs.aurora.modules.bonusBubble.BonusBubble
        {
            return this.viewComponent as mgs.aurora.modules.bonusBubble.BonusBubble;
        }

        public function get stage():flash.display.Sprite
        {
            return this.viewComponent as flash.display.Sprite;
        }

        public static const NAME:String="BonusBubbleMediator";
    }
}


//            class BubbleMediator
package mgs.aurora.modules.bonusBubble.view 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.modules.bonusBubble.*;
    import mgs.aurora.modules.bonusBubble.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class BubbleMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function BubbleMediator()
        {
            super(NAME, null);
            return;
        }

        public override function setViewComponent(arg1:Object):void
        {
            this.removeBubbleFromStage();
            super.setViewComponent(arg1);
            this.bubble.addEventListener(flash.events.Event.ADDED_TO_STAGE, this.addedToStage);
            this.bubble.addEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.removedFromToStage);
            var loc1:*=this.facade.retrieveMediator(mgs.aurora.modules.bonusBubble.view.BonusBubbleMediator.NAME) as mgs.aurora.modules.bonusBubble.view.BonusBubbleMediator;
            loc1.stage.addChild(this.bubble);
            return;
        }

        public override function onRemove():void
        {
            if (this.bubble) 
            {
                this.bubble.removeEventListener(flash.events.Event.ADDED_TO_STAGE, this.addedToStage);
                this.bubble.removeEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.removedFromToStage);
                if (this.bubble.stage) 
                {
                    this.bubble.parent.removeChild(this.bubble);
                    this.bubble.stage.removeEventListener(flash.events.Event.ENTER_FRAME, this.fadeIn);
                    this.bubble.stage.removeEventListener(flash.events.Event.ENTER_FRAME, this.fadeOut);
                }
                this.viewComponent = null;
            }
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.REMOVE_TIMER);
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HOVER_AREA_CHANGED);
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HOVER_AREA_REMOVED);
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.DISPLAY_STATE_CHANGED);
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.ENABLED_STATE_CHANGED);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getName();
            switch (loc1) 
            {
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.REMOVE_TIMER:
                {
                    if (this.bubble) 
                    {
                        this.removeBubble();
                    }
                    else 
                    {
                        this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.BUBBLE_REMOVED);
                    }
                    break;
                }
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HOVER_AREA_REMOVED:
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HOVER_AREA_CHANGED:
                {
                    this.removeBubbleFromStage();
                    break;
                }
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.ENABLED_STATE_CHANGED:
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.DISPLAY_STATE_CHANGED:
                {
                    if (!arg1.getBody()) 
                    {
                        this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HIDE_FUNBONUS);
                        this.removeBubbleFromStage();
                    }
                    break;
                }
            }
            return;
        }

        public function removeBubble():void
        {
            if (this.bubble.stage) 
            {
                this.bubble.stage.removeEventListener(flash.events.Event.ENTER_FRAME, this.fadeIn);
                this.bubble.stage.addEventListener(flash.events.Event.ENTER_FRAME, this.fadeOut);
            }
            return;
        }

        internal function get bubble():flash.display.Sprite
        {
            return this.viewComponent as flash.display.Sprite;
        }

        internal function fadeIn(arg1:flash.events.Event):void
        {
            this.bubble.alpha = this.bubble.alpha + (1 - this.bubble.alpha) / 3;
            if (this.bubble.alpha > 0.95) 
            {
                this.bubble.alpha = 1;
                this.bubble.stage.removeEventListener(flash.events.Event.ENTER_FRAME, this.fadeIn);
                this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.BUBBLE_DISPLAYED);
            }
            return;
        }

        internal function fadeOut(arg1:flash.events.Event):void
        {
            this.bubble.alpha = this.bubble.alpha - this.bubble.alpha / 8;
            if (this.bubble.alpha < 0.05) 
            {
                this.bubble.alpha = 0;
                this.removeBubbleFromStage();
            }
            return;
        }

        internal function addedToStage(arg1:flash.events.Event):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy;
            loc1.displayed = true;
            this.bubble.stage.addEventListener(flash.events.Event.ENTER_FRAME, this.fadeIn);
            return;
        }

        internal function removeBubbleFromStage():void
        {
            if (this.bubble != null) 
            {
                if (this.bubble.stage) 
                {
                    this.bubble.stage.removeEventListener(flash.events.Event.ENTER_FRAME, this.fadeIn);
                    this.bubble.stage.removeEventListener(flash.events.Event.ENTER_FRAME, this.fadeOut);
                }
                if (this.bubble.parent != null) 
                {
                    this.bubble.parent.removeChild(this.bubble);
                }
            }
            return;
        }

        internal function removedFromToStage(arg1:flash.events.Event=null):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy;
            loc1.displayed = false;
            if (this.bubble.stage) 
            {
                this.bubble.stage.removeEventListener(flash.events.Event.ENTER_FRAME, this.fadeIn);
                this.bubble.stage.removeEventListener(flash.events.Event.ENTER_FRAME, this.fadeOut);
            }
            if (arg1.target != this.bubble) 
            {
                this.bubble.parent.removeChild(this.bubble);
            }
            this.bubble.removeEventListener(flash.events.Event.ADDED_TO_STAGE, this.addedToStage);
            this.bubble.removeEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.removedFromToStage);
            this.viewComponent = null;
            this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.BUBBLE_REMOVED);
            return;
        }

        public static const NAME:String="BubbleMediator";
    }
}


//            class HoverAreaMediator
package mgs.aurora.modules.bonusBubble.view 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.modules.bonusBubble.*;
    import mgs.aurora.modules.bonusBubble.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class HoverAreaMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function HoverAreaMediator(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public override function onRemove():void
        {
            this.cleanupHoverAreaReference();
            return;
        }

        public override function setViewComponent(arg1:Object):void
        {
            this.cleanupHoverAreaReference();
            this.facade.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HOVER_AREA_CHANGED);
            super.setViewComponent(arg1);
            if (this.hoverArea) 
            {
                this.hoverArea.addEventListener(flash.events.MouseEvent.ROLL_OVER, this.onRollOver);
            }
            return;
        }

        internal function onRollOver(arg1:flash.events.MouseEvent):void
        {
            var loc2:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy;
            if (loc1.enabled && loc1.supported && loc1.display && !loc1.displayed) 
            {
                this.hoverArea.removeEventListener(flash.events.MouseEvent.ROLL_OVER, this.onRollOver);
                this.hoverArea.addEventListener(flash.events.MouseEvent.ROLL_OUT, this.onRollOut);
                loc2 = this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.RequestTimerProxy.NAME) as mgs.aurora.modules.bonusBubble.model.RequestTimerProxy;
                loc2.start();
            }
            return;
        }

        internal function onRollOut(arg1:flash.events.MouseEvent):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.RequestTimerProxy.NAME) as mgs.aurora.modules.bonusBubble.model.RequestTimerProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.RemoveTimerProxy.NAME) as mgs.aurora.modules.bonusBubble.model.RemoveTimerProxy;
            var loc3:*=this.facade.retrieveMediator(mgs.aurora.modules.bonusBubble.view.BubbleMediator.NAME) as mgs.aurora.modules.bonusBubble.view.BubbleMediator;
            loc1.stop();
            if (!loc2.running) 
            {
                this.hoverArea.removeEventListener(flash.events.MouseEvent.ROLL_OUT, this.onRollOut);
                loc2.start();
            }
            return;
        }

        internal function onRollOutOfHoverAreaAfterBubbleRemove(arg1:flash.events.MouseEvent):void
        {
            this.hoverArea.removeEventListener(flash.events.MouseEvent.ROLL_OUT, this.onRollOutOfHoverAreaAfterBubbleRemove);
            this.hoverArea.addEventListener(flash.events.MouseEvent.ROLL_OVER, this.onRollOver);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.BUBBLE_REMOVED);
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.ENABLED_STATE_CHANGED);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getName();
            switch (loc1) 
            {
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.BUBBLE_REMOVED:
                {
                    if (this.hoverArea) 
                    {
                        if (this.hitTest()) 
                        {
                            this.hoverArea.addEventListener(flash.events.MouseEvent.ROLL_OUT, this.onRollOutOfHoverAreaAfterBubbleRemove);
                        }
                        else 
                        {
                            this.hoverArea.addEventListener(flash.events.MouseEvent.ROLL_OVER, this.onRollOver);
                        }
                    }
                    break;
                }
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.ENABLED_STATE_CHANGED:
                {
                    if (this.hoverArea) 
                    {
                        if (arg1.getBody()) 
                        {
                            this.hoverArea.addEventListener(flash.events.MouseEvent.ROLL_OVER, this.onRollOver);
                        }
                        else 
                        {
                            this.hoverArea.removeEventListener(flash.events.MouseEvent.ROLL_OVER, this.onRollOver);
                            this.hoverArea.removeEventListener(flash.events.MouseEvent.ROLL_OUT, this.onRollOut);
                        }
                    }
                    break;
                }
            }
            return;
        }

        internal function get hoverArea():flash.display.Sprite
        {
            return this.viewComponent as flash.display.Sprite;
        }

        public function hitTest():Boolean
        {
            if (!(this.hoverArea == null) && !(this.hoverArea.stage == null)) 
            {
                return this.hoverArea.hitTestPoint(this.hoverArea.stage.mouseX, this.hoverArea.stage.mouseY);
            }
            return false;
        }

        internal function cleanupHoverAreaReference():void
        {
            if (this.hoverArea != null) 
            {
                this.hoverArea.removeEventListener(flash.events.MouseEvent.ROLL_OVER, this.onRollOver);
                this.hoverArea.removeEventListener(flash.events.MouseEvent.ROLL_OUT, this.onRollOut);
                this.viewComponent = null;
            }
            return;
        }

        public static const NAME:String="HoverAreaMediator";
    }
}


//            class MainBalanceMediator
package mgs.aurora.modules.bonusBubble.view 
{
    import com.mgs.funbonus.common.enums.*;
    import com.mgs.funbonus.common.interfaces.*;
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.modules.bonusBubble.*;
    import mgs.aurora.modules.bonusBubble.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class MainBalanceMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function MainBalanceMediator(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        internal function get funBonusBubble():com.mgs.funbonus.common.interfaces.IFunBonus
        {
            return this.viewComponent as com.mgs.funbonus.common.interfaces.IFunBonus;
        }

        public override function onRegister():void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.AuroraFunBonusComsProxy.NAME) as mgs.aurora.modules.bonusBubble.model.AuroraFunBonusComsProxy;
            this._facade = mgs.aurora.modules.bonusBubble.BonusBubbleFacade.getInstance(mgs.aurora.modules.bonusBubble.BonusBubble.NAME);
            var loc2:*=loc1.getData() as com.mgs.funbonus.common.interfaces.IFunBonusComs;
            var loc3:*=this.facade.retrieveMediator(mgs.aurora.modules.bonusBubble.view.BonusBubbleMediator.NAME) as mgs.aurora.modules.bonusBubble.view.BonusBubbleMediator;
            this.funBonusBubble.setup("aurora", loc2);
            loc3.stage.addChild(this.funBonusBubble as flash.display.DisplayObject);
            loc3.stage.addEventListener(flash.events.MouseEvent.CLICK, this.onBubbleClick);
            loc3.stage.parent.parent.addEventListener(flash.events.MouseEvent.CLICK, this.onStageClick);
            return;
        }

        internal function onBubbleClick(arg1:flash.events.MouseEvent):void
        {
            arg1.stopPropagation();
            return;
        }

        internal function onStageClick(arg1:flash.events.MouseEvent):void
        {
            this.funBonusBubble.onHideSystem(true, 0);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.FUNBONUS_PACKET_RECEIVED);
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SHOW_FUNBONUS);
            loc1.push(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HIDE_FUNBONUS);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getName();
            switch (loc1) 
            {
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.FUNBONUS_PACKET_RECEIVED:
                {
                    this.handleFunBonusPacket(arg1.getBody());
                    break;
                }
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SHOW_FUNBONUS:
                {
                    this.funBonusBubble.onShowSystem();
                    break;
                }
                case mgs.aurora.modules.bonusBubble.BonusBubbleFacade.HIDE_FUNBONUS:
                {
                    this.funBonusBubble.onHideSystem(true, 0);
                }
            }
            return;
        }

        internal function handleFunBonusPacket(arg1:Object):void
        {
            var loc3:*=0;
            var loc4:*=null;
            var loc5:*=null;
            var loc1:*=arg1 as XML;
            var loc2:*=new XML();
            if (loc1.Response.hasOwnProperty(mgs.aurora.modules.bonusBubble.view.MainBalanceMediator.FB_BALANCE)) 
            {
                loc2 = XML(loc1);
                loc3 = com.mgs.funbonus.common.enums.FunBonusEnums.BIA_INFORMATION;
                if (!(loc4 = this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME) as mgs.aurora.modules.bonusBubble.model.FormattingProxy).allowFunBonus && loc2.FunBonus) 
                {
                    delete loc2.FunBonus;
                }
                if (this._facade.activateQueued) 
                {
                    this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.ACTIVATE_QUEUED_BONUS, loc1);
                    return;
                }
                loc5 = this.facade.retrieveProxy(mgs.aurora.modules.bonusBubble.model.PointProxy.NAME) as mgs.aurora.modules.bonusBubble.model.PointProxy;
                this.funBonusBubble.setCoordinates(loc5.point.x, loc5.point.y);
            }
            else if (loc1.Response.hasOwnProperty(mgs.aurora.modules.bonusBubble.view.MainBalanceMediator.FB_FORFEIT)) 
            {
                loc3 = com.mgs.funbonus.common.enums.FunBonusEnums.BIA_SELECTION;
                loc2 = XML(loc1);
            }
            else if (loc1.Response.hasOwnProperty(mgs.aurora.modules.bonusBubble.view.MainBalanceMediator.FB_COLLECT)) 
            {
                loc3 = com.mgs.funbonus.common.enums.FunBonusEnums.BIA_COLLECTION;
                loc2 = XML(loc1);
            }
            else if (loc1.Response.hasOwnProperty(mgs.aurora.modules.bonusBubble.view.MainBalanceMediator.FB_EXPIRE)) 
            {
                loc3 = com.mgs.funbonus.common.enums.FunBonusEnums.BIA_EXPIRY;
                loc2 = XML(loc1);
            }
            else 
            {
                return;
            }
            this.funBonusBubble.packetReceived(loc3, loc2);
            return;
        }

        public static const NAME:String="MainBalanceMediator";

        public static const FB_BALANCE:String="FunBonusBalances";

        public static const FB_COLLECT:String="FunBonusCollect";

        public static const FB_EXPIRE:String="FunBonusOutofplaytime";

        public static const FB_FORFEIT:String="FunBonusForfeit";

        internal var _facade:mgs.aurora.modules.bonusBubble.BonusBubbleFacade;
    }
}


//          class BonusBubble
package mgs.aurora.modules.bonusBubble 
{
    import flash.display.*;
    import flash.events.*;
    import flash.geom.*;
    import flash.utils.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.events.funBonus.*;
    import mgs.aurora.common.events.raptorSessions.*;
    import mgs.aurora.common.interfaces.bonusBubble.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class BonusBubble extends flash.display.Sprite implements mgs.aurora.common.interfaces.bonusBubble.IBonusBubble
    {
        public function BonusBubble()
        {
            super();
            if (this.stage) 
            {
                this.init();
            }
            else 
            {
                this.addEventListener(flash.events.Event.ADDED_TO_STAGE, this.init);
                this.addEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.dispose);
            }
            return;
        }

        internal function init(arg1:flash.events.Event=null):void
        {
            this._facade = mgs.aurora.modules.bonusBubble.BonusBubbleFacade.getInstance(mgs.aurora.modules.bonusBubble.BonusBubble.NAME);
            this._facade.startup(this);
            return;
        }

        internal function dispose(arg1:flash.events.Event=null):void
        {
            this._facade.dispose();
            org.puremvc.as3.multicore.patterns.facade.Facade.removeCore(mgs.aurora.modules.bonusBubble.BonusBubble.NAME);
            return;
        }

        public function setup(arg1:flash.utils.Dictionary):void
        {
            this._facade.setup(arg1);
            return;
        }

        public function reset():void
        {
            this._facade.reset();
            return;
        }

        public function setCreditsFormatting(arg1:Boolean, arg2:String=".", arg3:String=" "):void
        {
            this._facade.setCreditsFormatting(arg1, arg2, arg3);
            return;
        }

        public function changeSettings(arg1:flash.utils.Dictionary):void
        {
            this._facade.changeSettings(arg1);
            return;
        }

        public function get trigger():flash.display.InteractiveObject
        {
            return this._facade.trigger;
        }

        public function set trigger(arg1:flash.display.InteractiveObject):void
        {
            this._facade.trigger = arg1;
            return;
        }

        public function get supported():Boolean
        {
            return this._facade.supported;
        }

        public function get enabled():Boolean
        {
            return this._facade.enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            this._facade.enabled = arg1;
            return;
        }

        public function get display():Boolean
        {
            return this._facade.display;
        }

        public function set display(arg1:Boolean):void
        {
            this._facade.display = arg1;
            return;
        }

        public function onErrorPacket(arg1:XML):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.PacketErrorEvent(mgs.aurora.common.events.PacketErrorEvent.FATAL, arg1));
            return;
        }

        public function get coordinates():flash.geom.Point
        {
            return this._facade.coordinates;
        }

        public function set coordinates(arg1:flash.geom.Point):void
        {
            this._facade.coordinates = arg1;
            return;
        }

        public function switchUser(arg1:uint):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.LAUNCH_SWITCH_USER, arg1));
            return;
        }

        public function show():void
        {
            this._facade.showBubble();
            return;
        }

        public function changeBonusOffer(arg1:Boolean):void
        {
            if (arg1) 
            {
                this.dispatchEvent(new flash.events.Event(mgs.aurora.common.events.funBonus.FunBonusEvents.FB_CHANGE_BONUS_OFFER));
            }
            else 
            {
                this.dispatchEvent(new flash.events.Event(mgs.aurora.common.events.funBonus.FunBonusEvents.FB_CHANGE_BONUS_OFFER_ERROR));
            }
            return;
        }

        public static const NAME:String="BonusBubble";

        internal var _facade:mgs.aurora.modules.bonusBubble.BonusBubbleFacade;
    }
}


//          class BonusBubbleFacade
package mgs.aurora.modules.bonusBubble 
{
    import flash.display.*;
    import flash.geom.*;
    import flash.utils.*;
    import mgs.aurora.modules.bonusBubble.controller.*;
    import mgs.aurora.modules.bonusBubble.model.*;
    import mgs.aurora.modules.bonusBubble.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class BonusBubbleFacade extends org.puremvc.as3.multicore.patterns.facade.Facade implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function BonusBubbleFacade(arg1:String)
        {
            super(arg1);
            return;
        }

        internal function showFunBubble():void
        {
            this._showBubble = false;
            var loc1:*=this.retrieveProxy(mgs.aurora.modules.bonusBubble.model.PointProxy.NAME) as mgs.aurora.modules.bonusBubble.model.PointProxy;
            var loc2:*=new flash.geom.Point(this.trigger.x, this.trigger.y);
            loc1.setMousePoint(loc2);
            sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SHOW_FUNBONUS);
            return;
        }

        public static function getInstance(arg1:String):mgs.aurora.modules.bonusBubble.BonusBubbleFacade
        {
            if (mgs.aurora.modules.bonusBubble.BonusBubbleFacade._instance == null) 
            {
                mgs.aurora.modules.bonusBubble.BonusBubbleFacade._instance = new BonusBubbleFacade(arg1);
            }
            return mgs.aurora.modules.bonusBubble.BonusBubbleFacade._instance;
        }

        public function startup(arg1:flash.display.Sprite):void
        {
            this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.STARTUP, arg1);
            return;
        }

        public function dispose():void
        {
            this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.DISPOSE);
            this.removeCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.RESET);
            this.removeCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.STARTUP);
            this.removeCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SETUP);
            this.removeCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.PACKET_RECEIVED);
            this.removeCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.DISPOSE);
            this.removeCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.REQUEST_TIMER);
            this.removeCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.REMOVE_TIMER);
            this.removeCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.DISPLAY_BUBBLE);
            this.removeCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.CHANGE_SETTINGS);
            this.removeCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.REQUEST_FUNBONUS);
            return;
        }

        protected override function initializeController():void
        {
            super.initializeController();
            this.registerCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.RESET, mgs.aurora.modules.bonusBubble.controller.ResetCommand);
            this.registerCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.STARTUP, mgs.aurora.modules.bonusBubble.controller.StartupCommand);
            this.registerCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SETUP, mgs.aurora.modules.bonusBubble.controller.SetupCommand);
            this.registerCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.PACKET_RECEIVED, mgs.aurora.modules.bonusBubble.controller.PacketReceivedCommand);
            this.registerCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.DISPOSE, mgs.aurora.modules.bonusBubble.controller.DisposeCommand);
            this.registerCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.REQUEST_TIMER, mgs.aurora.modules.bonusBubble.controller.SendPacketCommand);
            this.registerCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.REQUEST_FUNBONUS, mgs.aurora.modules.bonusBubble.controller.SendPacketCommand);
            this.registerCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.DISPLAY_BUBBLE, mgs.aurora.modules.bonusBubble.controller.DisplayBubbleCommand);
            this.registerCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.CHANGE_SETTINGS, mgs.aurora.modules.bonusBubble.controller.ChangeSettingsCommand);
            this.registerCommand(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.ACTIVATE_QUEUED_BONUS, mgs.aurora.modules.bonusBubble.controller.ActivateQueuedBonusCommand);
            return;
        }

        public function setup(arg1:flash.utils.Dictionary):void
        {
            this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.SETUP, arg1);
            return;
        }

        public function reset():void
        {
            this.sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.RESET);
            return;
        }

        public function setCreditsFormatting(arg1:Boolean, arg2:String=".", arg3:String=" "):void
        {
            var loc1:*;
            (loc1 = this.retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME) as mgs.aurora.modules.bonusBubble.model.FormattingProxy).enabled = arg1;
            loc1.fSeparator = arg2;
            loc1.tmSeparator = arg3;
            return;
        }

        public function changeSettings(arg1:flash.utils.Dictionary):void
        {
            sendNotification(mgs.aurora.modules.bonusBubble.BonusBubbleFacade.CHANGE_SETTINGS, arg1);
            return;
        }

        public function get trigger():flash.display.InteractiveObject
        {
            var loc1:*=this.retrieveMediator(mgs.aurora.modules.bonusBubble.view.HoverAreaMediator.NAME) as mgs.aurora.modules.bonusBubble.view.HoverAreaMediator;
            return loc1.getViewComponent() as flash.display.InteractiveObject;
        }

        public function set trigger(arg1:flash.display.InteractiveObject):void
        {
            var loc1:*=this.retrieveMediator(mgs.aurora.modules.bonusBubble.view.HoverAreaMediator.NAME) as mgs.aurora.modules.bonusBubble.view.HoverAreaMediator;
            loc1.setViewComponent(arg1);
            if (this._showBubble && this.display) 
            {
                this.showFunBubble();
            }
            return;
        }

        public function get supported():Boolean
        {
            var loc1:*=this.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy;
            return loc1.supported;
        }

        public function get enabled():Boolean
        {
            var loc1:*=this.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy;
            return loc1.enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            var loc1:*=this.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy;
            loc1.enabled = arg1;
            return;
        }

        public function get display():Boolean
        {
            var loc1:*=this.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy;
            return loc1.display;
        }

        public function set display(arg1:Boolean):void
        {
            var loc1:*=this.retrieveProxy(mgs.aurora.modules.bonusBubble.model.SwitchesProxy.NAME) as mgs.aurora.modules.bonusBubble.model.SwitchesProxy;
            loc1.display = arg1;
            if (this._showBubble && !(this.trigger == null) && this.display) 
            {
                this.showFunBubble();
            }
            return;
        }

        public function get coordinates():flash.geom.Point
        {
            var loc1:*=retrieveProxy(mgs.aurora.modules.bonusBubble.model.PointProxy.NAME) as mgs.aurora.modules.bonusBubble.model.PointProxy;
            return loc1.customPoint;
        }

        public function set coordinates(arg1:flash.geom.Point):void
        {
            var loc1:*=retrieveProxy(mgs.aurora.modules.bonusBubble.model.PointProxy.NAME) as mgs.aurora.modules.bonusBubble.model.PointProxy;
            loc1.customPoint = arg1;
            return;
        }

        public function get activateQueued():Boolean
        {
            return this._activateQueued;
        }

        public function set activateQueued(arg1:Boolean):void
        {
            this._activateQueued = arg1;
            return;
        }

        public function showBubble():void
        {
            var loc1:*=retrieveProxy(mgs.aurora.modules.bonusBubble.model.FormattingProxy.NAME) as mgs.aurora.modules.bonusBubble.model.FormattingProxy;
            if (loc1.allowFunBonus) 
            {
                this._showBubble = true;
            }
            if (this._showBubble == true && !(this.trigger == null) && this.display) 
            {
                this.showFunBubble();
            }
            return;
        }

        public static const ACTIVATE_QUEUED_BONUS:String=NAME + "/notes/activate_queued_bonus";

        public static const SHOW_FUNBONUS:String=NAME + "/notes/show_funbonus";

        public static const NAME:String="BonusBubbleFacade";

        public static const STARTUP:String=NAME + "/notes/startup";

        public static const SETUP:String=NAME + "/notes/setup";

        public static const RESET:String=NAME + "/notes/reset";

        public static const PACKET_RECEIVED:String=NAME + "/notes/packet_received";

        public static const ERROR_PACKET_RECEIVED:String=NAME + "/notes/error_packet_received";

        public static const DISPOSE:String=NAME + "/notes/dispose";

        public static const REQUEST_TIMER:String=NAME + "/notes/request_timer";

        public static const REMOVE_TIMER:String=NAME + "/notes/remove_timer";

        public static const DISPLAY_BUBBLE:String=NAME + "/notes/display_bubble";

        public static const BUBBLE_DISPLAYED:String=NAME + "/notes/bubble_displayed";

        public static const BUBBLE_REMOVED:String=NAME + "/notes/bubble_removed";

        public static const HOVER_AREA_CHANGED:String=NAME + "/notes/hover_area_changed";

        public static const ENABLED_STATE_CHANGED:String=NAME + "/notes/enabled_state_changed";

        public static const DISPLAY_STATE_CHANGED:String=NAME + "/notes/display_state_changed";

        public static const CHANGE_SETTINGS:String=NAME + "/notes/change_settings";

        public static const REQUEST_FUNBONUS:String=NAME + "/notes/request_funbonus";

        public static const FUNBONUS_PACKET_RECEIVED:String="funbonus_packet_received";

        public static const HOVER_AREA_REMOVED:String=NAME + "/notes/hover_area_removed";

        public static const HIDE_FUNBONUS:String=NAME + "/notes/hide_funbonus";

        public static const SWITCH_USER:String=NAME + "/notes/switch_user";

        public static const SHOW_FB_EXTERNAL:String=NAME + "/notes/show_fb_external";

        public static const CHANGE_BONUS_OFFER:String=NAME + "/notes/change_bonus_offer";

        internal var _showBubble:Boolean=false;

        internal var _activateQueued:Boolean=false;

        internal static var _instance:mgs.aurora.modules.bonusBubble.BonusBubbleFacade;
    }
}


