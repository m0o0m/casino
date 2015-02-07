//ActionScript 3.0
//  package mgs
//    package aurora
//      package modules
//        package banking
//          package controller
//            class InitialiseCommand
package mgs.aurora.modules.banking.controller 
{
    import mgs.aurora.common.vo.banking.*;
    import mgs.aurora.modules.banking.model.*;
    import mgs.aurora.modules.banking.model.vo.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class InitialiseCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function InitialiseCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as mgs.aurora.common.vo.banking.BankingDependencies;
            this.facade.registerProxy(new mgs.aurora.modules.banking.model.XManProxy(loc1.xman));
            this.facade.registerProxy(new mgs.aurora.modules.banking.model.DialogueHandlerProxy(loc1.dialogues));
            this.facade.registerProxy(new mgs.aurora.modules.banking.model.BankingConfigProxy(new mgs.aurora.modules.banking.model.vo.BankingConfig(loc1.config)));
            var loc2:*=new mgs.aurora.modules.banking.model.SessionObjectProxy(loc1.sessionObject);
            this.facade.registerProxy(loc2);
            this.facade.registerProxy(new mgs.aurora.modules.banking.model.BalanceProxy(loc2));
            return;
        }
    }
}


//            class LaunchBankingCommand
package mgs.aurora.modules.banking.controller 
{
    import mgs.aurora.modules.banking.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class LaunchBankingCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function LaunchBankingCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            facade.sendNotification(mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_BANKING_DIALOGUE);
            return;
        }
    }
}


//            class LaunchQuickBankingCommand
package mgs.aurora.modules.banking.controller 
{
    import mgs.aurora.modules.banking.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class LaunchQuickBankingCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function LaunchQuickBankingCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            facade.sendNotification(mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_QUICK_BANKING_DIALOGUE);
            return;
        }
    }
}


//            class PacketReturnedCommand
package mgs.aurora.modules.banking.controller 
{
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.banking.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class PacketReturnedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function PacketReturnedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc3:*=0;
            var loc1:*=arg1.getBody() as mgs.aurora.common.events.comms.PacketEvent;
            var loc4:*=loc1.verb.toLowerCase();
            switch (loc4) 
            {
                case "error":
                {
                    loc2 = new mgs.aurora.common.events.PacketErrorEvent(mgs.aurora.common.events.PacketErrorEvent.FATAL);
                    loc2.packet = loc1.response;
                    this.sendNotification(mgs.aurora.modules.banking.notifications.OutboundNotifications.ERROR, loc2);
                    break;
                }
                case "getbalance":
                {
                    loc3 = uint(loc1.response.Response.PlayerInfo.@Balance);
                    this.sendNotification(mgs.aurora.modules.banking.notifications.InboundNotifications.SET_USER_BALANCE, loc3);
                    break;
                }
            }
            return;
        }
    }
}


//            class PrepViewCommand
package mgs.aurora.modules.banking.controller 
{
    import mgs.aurora.modules.banking.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class PrepViewCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function PrepViewCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            facade.registerMediator(new mgs.aurora.modules.banking.view.EventBridgeMediator(arg1.getBody()));
            facade.registerMediator(new mgs.aurora.modules.banking.view.DialoguesMediator());
            return;
        }
    }
}


//            class PromptForCashCommand
package mgs.aurora.modules.banking.controller 
{
    import mgs.aurora.common.enums.raptorSession.*;
    import mgs.aurora.common.events.banking.*;
    import mgs.aurora.modules.banking.model.*;
    import mgs.aurora.modules.banking.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class PromptForCashCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function PromptForCashCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.banking.model.BankingConfigProxy.NAME) as mgs.aurora.modules.banking.model.BankingConfigProxy;
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.banking.model.SessionObjectProxy.NAME) as mgs.aurora.modules.banking.model.SessionObjectProxy;
            if (!loc1.cashPromptShown && loc2.isLoggedIn && loc2.balance == 0 && !(loc2.userType == mgs.aurora.common.enums.raptorSession.UserTypes.DEMO_USER) && (loc2.userType != mgs.aurora.common.enums.raptorSession.UserTypes.GUEST_USER ? true : loc1.allowGuestPurchase)) 
            {
                loc1.cashPromptShown = true;
                facade.sendNotification(mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_PROMPT_FOR_CASH);
            }
            else 
            {
                facade.sendNotification(mgs.aurora.modules.banking.notifications.OutboundNotifications.BANKING_NOT_LAUNCHED, new mgs.aurora.common.events.banking.BankingEvent(mgs.aurora.common.events.banking.BankingEvent.BANKING_NOT_LAUNCHED));
            }
            return;
        }
    }
}


//            class RefreshCommand
package mgs.aurora.modules.banking.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.banking.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RefreshCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RefreshCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as String;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.banking.model.BankingConfigProxy.NAME) as mgs.aurora.modules.banking.model.BankingConfigProxy;
            var loc3:*;
            (loc3 = new flash.utils.Dictionary())[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] = loc2.clientID;
            loc3[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] = loc2.moduleID;
            loc3[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] = "GetBalance" + new Date().valueOf();
            loc3[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = "GetBalance";
            loc3[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request/>");
            loc3[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] = true;
            loc3[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] = loc1 ? loc1 : "onGetBalance";
            var loc4:*;
            (loc4 = this.facade.retrieveProxy(mgs.aurora.modules.banking.model.XManProxy.NAME) as mgs.aurora.modules.banking.model.XManProxy).sendPacket(loc3);
            return;
        }
    }
}


//            class ResetCommand
package mgs.aurora.modules.banking.controller 
{
    import mgs.aurora.modules.banking.model.*;
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
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.banking.model.BankingConfigProxy.NAME) as mgs.aurora.modules.banking.model.BankingConfigProxy;
            loc1.cashPromptShown = false;
            return;
        }
    }
}


//            class SetUserBalanceCommand
package mgs.aurora.modules.banking.controller 
{
    import mgs.aurora.modules.banking.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetUserBalanceCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetUserBalanceCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.banking.model.BalanceProxy.NAME) as mgs.aurora.modules.banking.model.BalanceProxy;
            loc1.balance = Number(arg1.getBody());
            return;
        }
    }
}


//            class ShowRefreshDialogueCommand
package mgs.aurora.modules.banking.controller 
{
    import mgs.aurora.modules.banking.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ShowRefreshDialogueCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ShowRefreshDialogueCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            facade.sendNotification(mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_REFRESH_BALANCE_DIALOGUE);
            return;
        }
    }
}


//            class StartupCommand
package mgs.aurora.modules.banking.controller 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class StartupCommand extends org.puremvc.as3.multicore.patterns.command.MacroCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function StartupCommand()
        {
            super();
            return;
        }

        protected override function initializeMacroCommand():void
        {
            super.initializeMacroCommand();
            this.addSubCommand(mgs.aurora.modules.banking.controller.PrepViewCommand);
            return;
        }
    }
}


//          package model
//            package vo
//              class Balance
package mgs.aurora.modules.banking.model.vo 
{
    import mgs.aurora.modules.banking.model.*;
    
    public class Balance extends Object
    {
        public function Balance(arg1:Boolean, arg2:mgs.aurora.modules.banking.model.SessionObjectProxy)
        {
            super();
            this._waitingForBalance = arg1;
            this._sessionObj = arg2;
            return;
        }

        public function get balance():Number
        {
            return this._sessionObj.balance;
        }

        public function set balance(arg1:Number):void
        {
            this._sessionObj.balance = arg1;
            return;
        }

        public function get isWaitingForBalance():Boolean
        {
            return this._waitingForBalance;
        }

        public function set isWaitingForBalance(arg1:Boolean):void
        {
            this._waitingForBalance = arg1;
            return;
        }

        internal var _waitingForBalance:Boolean;

        internal var _sessionObj:mgs.aurora.modules.banking.model.SessionObjectProxy;
    }
}


//              class BankingConfig
package mgs.aurora.modules.banking.model.vo 
{
    public class BankingConfig extends Object
    {
        public function BankingConfig(arg1:XML)
        {
            super();
            this.config = arg1;
            return;
        }

        public var moduleID:String="1";

        public var clientID:String="10001";

        public var config:XML;

        public var cashPromptShown:Boolean;
    }
}


//            class BalanceProxy
package mgs.aurora.modules.banking.model 
{
    import mgs.aurora.modules.banking.model.vo.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class BalanceProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function BalanceProxy(arg1:mgs.aurora.modules.banking.model.SessionObjectProxy)
        {
            super(NAME, new mgs.aurora.modules.banking.model.vo.Balance(false, arg1));
            return;
        }

        public function get balanceContainer():mgs.aurora.modules.banking.model.vo.Balance
        {
            return getData() as mgs.aurora.modules.banking.model.vo.Balance;
        }

        public function get balance():Number
        {
            return this.balanceContainer.balance;
        }

        public function set balance(arg1:Number):void
        {
            this.balanceContainer.balance = arg1;
            return;
        }

        public static const NAME:String="BalanceProxy";
    }
}


//            class BankingConfigProxy
package mgs.aurora.modules.banking.model 
{
    import mgs.aurora.modules.banking.model.vo.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class BankingConfigProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function BankingConfigProxy(arg1:mgs.aurora.modules.banking.model.vo.BankingConfig)
        {
            super(NAME, arg1);
            return;
        }

        internal function get config():mgs.aurora.modules.banking.model.vo.BankingConfig
        {
            return getData() as mgs.aurora.modules.banking.model.vo.BankingConfig;
        }

        public function get moduleID():String
        {
            return this.config.moduleID;
        }

        public function set moduleID(arg1:String):void
        {
            this.config.moduleID = arg1;
            return;
        }

        public function get clientID():String
        {
            return this.config.clientID;
        }

        public function set clientID(arg1:String):void
        {
            this.config.clientID = arg1;
            return;
        }

        public function get allowGuestPurchase():Boolean
        {
            return Boolean(Number(this.config.config.@allowGuestPurchase));
        }

        public function get cashPromptShown():Boolean
        {
            return this.config.cashPromptShown;
        }

        public function set cashPromptShown(arg1:Boolean):void
        {
            this.config.cashPromptShown = arg1;
            return;
        }

        public static const NAME:String="BankingConfigProxy";
    }
}


//            class DialogueHandlerProxy
package mgs.aurora.modules.banking.model 
{
    import flash.display.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class DialogueHandlerProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function DialogueHandlerProxy(arg1:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler)
        {
            super(NAME, arg1);
            return;
        }

        public function get handler():mgs.aurora.common.interfaces.dialogues.IDialoguesHandler
        {
            return getData() as mgs.aurora.common.interfaces.dialogues.IDialoguesHandler;
        }

        public function get globalNumDisplayed():int
        {
            return this.handler.globalNumDisplayed;
        }

        public function get id():String
        {
            return this.handler.id;
        }

        public function get numDisplayed():int
        {
            return this.handler.numDisplayed;
        }

        public function create(arg1:String, arg2:String, arg3:flash.display.DisplayObjectContainer=null, arg4:XMLList=null, arg5:XMLList=null, arg6:flash.display.LoaderInfo=null, arg7:flash.display.LoaderInfo=null, arg8:flash.display.LoaderInfo=null):void
        {
            this.handler.create(arg1, arg2, arg3, arg4, arg5, arg6, arg7, arg8);
            return;
        }

        public function dialogue(arg1:String):mgs.aurora.common.interfaces.dialogues.IDialogue
        {
            return this.handler.dialogue(arg1);
        }

        public function remove(arg1:String):void
        {
            this.handler.remove(arg1);
            return;
        }

        public function removeAll():void
        {
            this.handler.removeAll();
            return;
        }

        public static const NAME:String="DialogueHandlerProxy";
    }
}


//            class SessionObjectProxy
package mgs.aurora.modules.banking.model 
{
    import mgs.aurora.common.enums.configMapping.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class SessionObjectProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function SessionObjectProxy(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public function get userType():Number
        {
            return getData()[mgs.aurora.common.enums.configMapping.SessionConfig.USERTYPE];
        }

        public function get isLoggedIn():Boolean
        {
            return getData()[mgs.aurora.common.enums.configMapping.SessionConfig.LOGGEDIN];
        }

        public function get balance():Number
        {
            return getData()[mgs.aurora.common.enums.configMapping.SessionConfig.BALANCE];
        }

        public function set balance(arg1:Number):void
        {
            getData()[mgs.aurora.common.enums.configMapping.SessionConfig.BALANCE] = arg1;
            return;
        }

        public static const NAME:String="SessionObjectProxy";
    }
}


//            class XManProxy
package mgs.aurora.modules.banking.model 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.modules.banking.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class XManProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function XManProxy(arg1:mgs.aurora.common.interfaces.comms.IXManPacketSender)
        {
            super(NAME, arg1);
            this._dispatcher = new flash.events.EventDispatcher();
            return;
        }

        public function get xman():mgs.aurora.common.interfaces.comms.IXManPacketSender
        {
            return getData() as mgs.aurora.common.interfaces.comms.IXManPacketSender;
        }

        public function sendPacket(arg1:flash.utils.Dictionary):void
        {
            var loc1:*=this.xman;
            var loc2:*=arg1[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] as String;
            loc1.addEventListener(loc2, this.onPacketReceived);
            loc1.sendPacket(arg1);
            return;
        }

        internal function onPacketReceived(arg1:mgs.aurora.common.events.comms.PacketEvent):void
        {
            this.xman.removeEventListener(arg1.type, this.onPacketReceived);
            facade.sendNotification(mgs.aurora.modules.banking.notifications.InboundNotifications.PACKET_RETURNED, arg1);
            this.dispatchEvent(arg1);
            return;
        }

        public function addEventListener(arg1:String, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            this._dispatcher.addEventListener(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        internal function dispatchEvent(arg1:flash.events.Event):Boolean
        {
            return this._dispatcher.dispatchEvent(arg1);
        }

        public static const NAME:String="XManProxy";

        internal var _dispatcher:flash.events.EventDispatcher;
    }
}


//          package notifications
//            class DialogueNotifications
package mgs.aurora.modules.banking.notifications 
{
    public class DialogueNotifications extends Object
    {
        public function DialogueNotifications()
        {
            super();
            return;
        }

        public static const NAME:String="DialogueNotifications";

        public static const SHOW_BANKING_DIALOGUE:String=NAME + "/notes/show_banking_dialogue";

        public static const SHOW_QUICK_BANKING_DIALOGUE:String=NAME + "/notes/show_quick_banking_dialogue";

        public static const SHOW_PROMPT_FOR_CASH:String=NAME + "/notes/show_prompt_for_cash";

        public static const SHOW_REFRESH_BALANCE_DIALOGUE:String=NAME + "/notes/show_refresh_balance_dialogue";
    }
}


//            class InboundNotifications
package mgs.aurora.modules.banking.notifications 
{
    public class InboundNotifications extends Object
    {
        public function InboundNotifications()
        {
            super();
            return;
        }

        public static const NAME:String="InboundNotifications";

        public static const REFRESH_BALANCE:String=NAME + "/notes/refresh_balance";

        public static const SET_USER_BALANCE:String=NAME + "/notes/set_user_balance";

        public static const PACKET_RETURNED:String=NAME + "/notes/packet_returned";

        public static const INITIALISE:String=NAME + "/notes/initialise";

        public static const LAUNCH_QUICK_BANKING:String=NAME + "/notes/launch_quick_banking";

        public static const LAUNCH_BANKING:String=NAME + "/notes/launch_banking";

        public static const PROMPT_FOR_CASH:String=NAME + "/notes/prompt_for_cash";

        public static const SHOW_REFRESH_DIALOGUE:String=NAME + "/notes/show_refresh_dialogue";

        public static const RESET:String=NAME + "/notes/reset";
    }
}


//            class OutboundNotifications
package mgs.aurora.modules.banking.notifications 
{
    public class OutboundNotifications extends Object
    {
        public function OutboundNotifications()
        {
            super();
            return;
        }

        internal static const NAME:String="OutboundNotifications";

        public static const ERROR:String=NAME + "/notes/error";

        public static const LAUNCH_BANKING:String=NAME + "/notes/launch_banking";

        public static const BANKING_NOT_LAUNCHED:String=NAME + "/notes/banking_not_launched";

        public static const BANKING_COMPLETE:String=NAME + "/notes/banking_complete";

        public static const FRAME_LAUNCH_BANK:String=NAME + "/notes/frame_launch_bank";
    }
}


//          package view
//            class DialoguesMediator
package mgs.aurora.modules.banking.view 
{
    import flash.events.*;
    import mgs.aurora.common.events.banking.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.banking.model.*;
    import mgs.aurora.modules.banking.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class DialoguesMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function DialoguesMediator()
        {
            super(NAME, null);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_BANKING_DIALOGUE);
            loc1.push(mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_QUICK_BANKING_DIALOGUE);
            loc1.push(mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_PROMPT_FOR_CASH);
            loc1.push(mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_REFRESH_BALANCE_DIALOGUE);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=arg1.getName();
            switch (loc2) 
            {
                case mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_BANKING_DIALOGUE:
                {
                    loc1 = this.showDialogue("Ecash1");
                    loc1.buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onEcash1DialogueButtonClicked);
                    loc1.buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onEcash1DialogueButtonClicked);
                    break;
                }
                case mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_QUICK_BANKING_DIALOGUE:
                {
                    loc1 = this.showDialogue("Ecash5");
                    loc1.buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onEcash2DialogueButtonClicked);
                    loc1.buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onEcash2DialogueButtonClicked);
                    this.launchBanking();
                    break;
                }
                case mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_PROMPT_FOR_CASH:
                {
                    loc1 = this.showDialogue("Ecash4");
                    loc1.buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onEcash4DialogueButtonClicked);
                    loc1.buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onEcash4DialogueButtonClicked);
                    break;
                }
                case mgs.aurora.modules.banking.notifications.DialogueNotifications.SHOW_REFRESH_BALANCE_DIALOGUE:
                {
                    loc1 = this.showDialogue("Ecash5");
                    loc1.buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onEcash2DialogueButtonClicked);
                    loc1.buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onEcash2DialogueButtonClicked);
                    break;
                }
            }
            return;
        }

        internal function launchBanking():void
        {
            this.facade.sendNotification(mgs.aurora.modules.banking.notifications.OutboundNotifications.LAUNCH_BANKING, new mgs.aurora.common.events.banking.BankingEvent(mgs.aurora.common.events.banking.BankingEvent.LAUNCH_BANKING));
            return;
        }

        internal function bankingNotLaunched():void
        {
            this.facade.sendNotification(mgs.aurora.modules.banking.notifications.OutboundNotifications.BANKING_NOT_LAUNCHED, new mgs.aurora.common.events.banking.BankingEvent(mgs.aurora.common.events.banking.BankingEvent.BANKING_NOT_LAUNCHED));
            return;
        }

        internal function onEcash4DialogueButtonClicked(arg1:*):void
        {
            var loc1:*=arg1.control.id;
            switch (loc1) 
            {
                case "YES":
                {
                    this.closeDialogue(arg1.diagId);
                    this.showEcash2();
                    this.launchBanking();
                    break;
                }
                case "NO":
                {
                    this.closeDialogue(arg1.diagId);
                    this.bankingNotLaunched();
                    break;
                }
            }
            return;
        }

        internal function onEcash1DialogueButtonClicked(arg1:*):void
        {
            var loc1:*=arg1.control.id;
            switch (loc1) 
            {
                case "YES":
                {
                    this.onBankingYes(arg1);
                    break;
                }
                case "NO":
                {
                    this.onBankingNo(arg1);
                    break;
                }
            }
            return;
        }

        internal function onEcash2DialogueButtonClicked(arg1:*):void
        {
            var loc1:*=arg1.control.id;
            switch (loc1) 
            {
                case "OK":
                {
                    this.onBankingOK(arg1);
                    break;
                }
            }
            return;
        }

        internal function onBankingYes(arg1:*):void
        {
            this.closeDialogue(arg1.diagId);
            this.showEcash2();
            this.launchBanking();
            return;
        }

        internal function showEcash2():void
        {
            var loc1:*=this.showDialogue("Ecash2");
            loc1.buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onEcash2DialogueButtonClicked);
            loc1.buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onEcash2DialogueButtonClicked);
            return;
        }

        internal function onBankingNo(arg1:*):void
        {
            this.closeDialogue(arg1.diagId);
            this.bankingNotLaunched();
            return;
        }

        internal function onBankingOK(arg1:*):void
        {
            var loc1:*=null;
            this.closeDialogue(arg1.diagId);
            if (!this.serverConnectDialog) 
            {
                this.serverConnectDialog = this.showDialogue("ServerConnect");
                loc1 = facade.retrieveProxy(mgs.aurora.modules.banking.model.XManProxy.NAME) as mgs.aurora.modules.banking.model.XManProxy;
                loc1.addEventListener("bankingDialogueRefresh", this.onBankingRefresh, false, 0, true);
            }
            this.facade.sendNotification(mgs.aurora.modules.banking.notifications.InboundNotifications.REFRESH_BALANCE, "bankingDialogueRefresh");
            if (arg1.diagType.toLowerCase() == "ecash5" || arg1.diagType.toLowerCase() == "ecash2") 
            {
                this.facade.sendNotification(mgs.aurora.modules.banking.notifications.OutboundNotifications.FRAME_LAUNCH_BANK, new mgs.aurora.common.events.banking.BankingEvent(mgs.aurora.common.events.banking.BankingEvent.FRAME_LAUNCH_BANK));
            }
            return;
        }

        internal function onBankingRefresh(arg1:flash.events.Event):void
        {
            this.facade.sendNotification(mgs.aurora.modules.banking.notifications.OutboundNotifications.BANKING_COMPLETE, new mgs.aurora.common.events.banking.BankingEvent(mgs.aurora.common.events.banking.BankingEvent.BANKING_COMPLETE));
            this.closeDialogue(this.serverConnectDialog.id);
            return;
        }

        internal function closeDialogue(arg1:String):void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.banking.model.DialogueHandlerProxy.NAME) as mgs.aurora.modules.banking.model.DialogueHandlerProxy;
            loc1.remove(arg1);
            return;
        }

        internal function showDialogue(arg1:String):mgs.aurora.common.interfaces.dialogues.IDialogue
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.banking.model.DialogueHandlerProxy.NAME) as mgs.aurora.modules.banking.model.DialogueHandlerProxy;
            var loc2:*=mgs.aurora.common.utilities.GUID.create();
            loc1.create(loc2, arg1);
            var loc3:*;
            return loc3 = loc1.dialogue(loc2);
        }

        public static const NAME:String="DialoguesMediator";

        internal var serverConnectDialog:mgs.aurora.common.interfaces.dialogues.IDialogue;
    }
}


//            class EventBridgeMediator
package mgs.aurora.modules.banking.view 
{
    import flash.events.*;
    import mgs.aurora.modules.banking.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class EventBridgeMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function EventBridgeMediator(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.banking.notifications.OutboundNotifications.ERROR);
            loc1.push(mgs.aurora.modules.banking.notifications.OutboundNotifications.LAUNCH_BANKING);
            loc1.push(mgs.aurora.modules.banking.notifications.OutboundNotifications.BANKING_NOT_LAUNCHED);
            loc1.push(mgs.aurora.modules.banking.notifications.OutboundNotifications.BANKING_COMPLETE);
            loc1.push(mgs.aurora.modules.banking.notifications.OutboundNotifications.FRAME_LAUNCH_BANK);
            return loc1;
        }

        internal function get eventDispatcher():flash.events.IEventDispatcher
        {
            return getViewComponent() as flash.events.IEventDispatcher;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getName();
            switch (loc1) 
            {
                case mgs.aurora.modules.banking.notifications.OutboundNotifications.LAUNCH_BANKING:
                case mgs.aurora.modules.banking.notifications.OutboundNotifications.BANKING_NOT_LAUNCHED:
                case mgs.aurora.modules.banking.notifications.OutboundNotifications.BANKING_COMPLETE:
                case mgs.aurora.modules.banking.notifications.OutboundNotifications.FRAME_LAUNCH_BANK:
                case mgs.aurora.modules.banking.notifications.OutboundNotifications.ERROR:
                {
                    this.eventDispatcher.dispatchEvent(arg1.getBody() as flash.events.Event);
                    break;
                }
                default:
                {
                    super.handleNotification(arg1);
                    break;
                }
            }
            return;
        }

        public static const NAME:String="EventBridgeMediator";
    }
}


//          class Banking
package mgs.aurora.modules.banking 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.interfaces.banking.*;
    import mgs.aurora.common.vo.banking.*;
    import mgs.aurora.modules.banking.model.*;
    import mgs.aurora.modules.banking.notifications.*;
    
    public class Banking extends flash.display.Sprite implements mgs.aurora.common.interfaces.banking.IBanking
    {
        public function Banking()
        {
            super();
            if (this.stage) 
            {
                this.init();
            }
            else 
            {
                this.addEventListener(flash.events.Event.ADDED_TO_STAGE, this.init);
            }
            return;
        }

        internal function init(arg1:flash.events.Event=null):void
        {
            this.removeEventListener(flash.events.Event.ADDED_TO_STAGE, this.init);
            this._facade = mgs.aurora.modules.banking.BankingFacade.getInstance(mgs.aurora.modules.banking.BankingFacade.NAME);
            this._facade.startup(this);
            return;
        }

        public function refreshBalance():void
        {
            this._facade.sendNotification(mgs.aurora.modules.banking.notifications.InboundNotifications.REFRESH_BALANCE);
            return;
        }

        public function setUserBalance(arg1:Number):void
        {
            this._facade.sendNotification(mgs.aurora.modules.banking.notifications.InboundNotifications.SET_USER_BALANCE, arg1);
            return;
        }

        public function initialise(arg1:mgs.aurora.common.vo.banking.BankingDependencies):void
        {
            this._facade.sendNotification(mgs.aurora.modules.banking.notifications.InboundNotifications.INITIALISE, arg1);
            return;
        }

        public function get balance():Number
        {
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.banking.model.BalanceProxy.NAME) as mgs.aurora.modules.banking.model.BalanceProxy;
            return loc1.balance;
        }

        public function launchBank():void
        {
            this._facade.sendNotification(mgs.aurora.modules.banking.notifications.InboundNotifications.LAUNCH_BANKING);
            return;
        }

        public function launchQuickBank():void
        {
            this._facade.sendNotification(mgs.aurora.modules.banking.notifications.InboundNotifications.LAUNCH_QUICK_BANKING);
            return;
        }

        public function promptForCash():void
        {
            this._facade.sendNotification(mgs.aurora.modules.banking.notifications.InboundNotifications.PROMPT_FOR_CASH);
            return;
        }

        public function reset():void
        {
            this._facade.sendNotification(mgs.aurora.modules.banking.notifications.InboundNotifications.RESET);
            return;
        }

        public function showRefreshDialogue():void
        {
            Debugger.trace("BANKING showRefreshDialogue ", "SYSTEM");
            this._facade.sendNotification(mgs.aurora.modules.banking.notifications.InboundNotifications.SHOW_REFRESH_DIALOGUE);
            return;
        }

        internal var _facade:mgs.aurora.modules.banking.BankingFacade;
    }
}


//          class BankingFacade
package mgs.aurora.modules.banking 
{
    import flash.events.*;
    import mgs.aurora.modules.banking.controller.*;
    import mgs.aurora.modules.banking.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class BankingFacade extends org.puremvc.as3.multicore.patterns.facade.Facade implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function BankingFacade(arg1:String)
        {
            super(arg1);
            return;
        }

        public function startup(arg1:flash.events.IEventDispatcher):void
        {
            this.sendNotification(mgs.aurora.modules.banking.BankingFacade.STARTUP, arg1);
            this.removeCommand(mgs.aurora.modules.banking.BankingFacade.STARTUP);
            return;
        }

        protected override function initializeController():void
        {
            super.initializeController();
            this.registerCommand(mgs.aurora.modules.banking.BankingFacade.STARTUP, mgs.aurora.modules.banking.controller.StartupCommand);
            this.registerCommand(mgs.aurora.modules.banking.notifications.InboundNotifications.PACKET_RETURNED, mgs.aurora.modules.banking.controller.PacketReturnedCommand);
            this.registerCommand(mgs.aurora.modules.banking.notifications.InboundNotifications.REFRESH_BALANCE, mgs.aurora.modules.banking.controller.RefreshCommand);
            this.registerCommand(mgs.aurora.modules.banking.notifications.InboundNotifications.SET_USER_BALANCE, mgs.aurora.modules.banking.controller.SetUserBalanceCommand);
            this.registerCommand(mgs.aurora.modules.banking.notifications.InboundNotifications.INITIALISE, mgs.aurora.modules.banking.controller.InitialiseCommand);
            this.registerCommand(mgs.aurora.modules.banking.notifications.InboundNotifications.LAUNCH_BANKING, mgs.aurora.modules.banking.controller.LaunchBankingCommand);
            this.registerCommand(mgs.aurora.modules.banking.notifications.InboundNotifications.LAUNCH_QUICK_BANKING, mgs.aurora.modules.banking.controller.LaunchQuickBankingCommand);
            this.registerCommand(mgs.aurora.modules.banking.notifications.InboundNotifications.PROMPT_FOR_CASH, mgs.aurora.modules.banking.controller.PromptForCashCommand);
            this.registerCommand(mgs.aurora.modules.banking.notifications.InboundNotifications.SHOW_REFRESH_DIALOGUE, mgs.aurora.modules.banking.controller.ShowRefreshDialogueCommand);
            this.registerCommand(mgs.aurora.modules.banking.notifications.InboundNotifications.RESET, mgs.aurora.modules.banking.controller.ResetCommand);
            return;
        }

        public static function getInstance(arg1:String):mgs.aurora.modules.banking.BankingFacade
        {
            if (mgs.aurora.modules.banking.BankingFacade._instance == null) 
            {
                mgs.aurora.modules.banking.BankingFacade._instance = new BankingFacade(arg1);
            }
            return mgs.aurora.modules.banking.BankingFacade._instance;
        }

        public static const NAME:String="BankingFacade";

        public static const STARTUP:String=NAME + "/notes/startup";

        internal static var _instance:mgs.aurora.modules.banking.BankingFacade;
    }
}


