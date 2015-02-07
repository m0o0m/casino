//ActionScript 3.0
//  package mgs
//    package aurora
//      package modules
//        package defaultMarketManager
//          package controller
//            class BalanceUpdatedCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BalanceUpdatedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BalanceUpdatedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.BALANCE_UPDATED));
            return;
        }
    }
}


//            class BankPressedCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BankPressedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BankPressedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.BANK_BUTTON_PRESSED));
            return;
        }
    }
}


//            class BankReturnCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BankReturnCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BankReturnCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.RETURN_FROM_BANK));
            return;
        }
    }
}


//            class CasinoTimeoutCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class CasinoTimeoutCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function CasinoTimeoutCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.CASINO_TIME_OUT));
            return;
        }
    }
}


//            class ExitGameCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ExitGameCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ExitGameCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.EXIT_GAME_MODULE));
            return;
        }
    }
}


//            class HelpPressedCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class HelpPressedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function HelpPressedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.HELP_BUTTON_PRESSED));
            return;
        }
    }
}


//            class LoadGameCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class LoadGameCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function LoadGameCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.LOAD_GAME_MODULE));
            return;
        }
    }
}


//            class LoginSuccessfulCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class LoginSuccessfulCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function LoginSuccessfulCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.LOGIN_SUCCESSFULL));
            return;
        }
    }
}


//            class SendLoginRequestCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SendLoginRequestCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SendLoginRequestCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.SEND_LOGIN_REQUEST));
            return;
        }
    }
}


//            class SetUpCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetUpCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetUpCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            return;
        }
    }
}


//            class ShowErrorDialogCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ShowErrorDialogCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ShowErrorDialogCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.SHOW_ERROR_DIALOG));
            return;
        }
    }
}


//            class ShowLoginDialogCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ShowLoginDialogCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ShowLoginDialogCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.SHOW_LOGIN_DIALOG));
            return;
        }
    }
}


//            class StartupCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import mgs.aurora.modules.defaultMarketManager.model.*;
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
            this.facade.registerProxy(new mgs.aurora.modules.defaultMarketManager.model.StageProxy(arg1.getBody()));
            return;
        }
    }
}


//            class SystemLoadedCommand
package mgs.aurora.modules.defaultMarketManager.controller 
{
    import flash.display.*;
    import mgs.aurora.common.events.marketManager.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SystemLoadedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SystemLoadedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.defaultMarketManager.model.StageProxy(this.facade.retrieveProxy(mgs.aurora.modules.defaultMarketManager.model.StageProxy.NAME)).stage;
            loc1.dispatchEvent(new mgs.aurora.common.events.marketManager.MarketManagerEvent(mgs.aurora.common.events.marketManager.MarketManagerEvent.SYSTEM_LOADED));
            return;
        }
    }
}


//          package model
//            class StageProxy
package mgs.aurora.modules.defaultMarketManager.model 
{
    import flash.display.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class StageProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function StageProxy(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public function get stage():flash.display.Sprite
        {
            return this.data as flash.display.Sprite;
        }

        public static const NAME:String="StageProxy";
    }
}


//            class StringsProxy
package mgs.aurora.modules.defaultMarketManager.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class StringsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function StringsProxy(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public static const NAME:String="StringsProxy";
    }
}


//            class XmanProxy
package mgs.aurora.modules.defaultMarketManager.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class XmanProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function XmanProxy(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public static const NAME:String="XmanProxy";
    }
}


//          package notifications
//            class DefaultMarketManagerNotifications
package mgs.aurora.modules.defaultMarketManager.notifications 
{
    public class DefaultMarketManagerNotifications extends Object
    {
        public function DefaultMarketManagerNotifications()
        {
            super();
            return;
        }

        public static const NAME:String="defaultMarketManagerNotifications";

        public static const SET_UP:String=NAME + "/notes/set_up";

        public static const STARTUP:String=NAME + "/notes/startup";

        public static const SYSTEM_LOADED:String=NAME + "/notes/systemloaded";

        public static const SHOW_LOGIN_DIALOG:String=NAME + "/notes/showlogindialog";

        public static const SEND_LOGIN_REQUEST:String=NAME + "/notes/sendloginrequest";

        public static const LOGIN_SUCCESSFUL:String=NAME + "/notes/loginsuccessful";

        public static const LOAD_GAME:String=NAME + "/notes/loadgame";

        public static const EXIT_GAME:String=NAME + "/notes/exitgame";

        public static const SHOW_ERROR_DIALOG:String=NAME + "/notes/showerrordialog";

        public static const CASINO_TIMEOUT:String=NAME + "/notes/casinotimeout";

        public static const BANK_PRESSED:String=NAME + "/notes/bankpressed";

        public static const BANK_RETURN:String=NAME + "/notes/bankreturn";

        public static const MYACCOUNT_PRESSED:String=NAME + "/notes/myaccountpressed";

        public static const HELP_PRESSED:String=NAME + "/notes/helppressed";

        public static const SHOW_BONUSBUBBLE:String=NAME + "/notes/showbonusbubble";

        public static const BALANCE_UPDATED:String=NAME + "/notes/balanceupdated";
    }
}


//          package view
//            class DialogueMediator
package mgs.aurora.modules.defaultMarketManager.view 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class DialogueMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function DialogueMediator(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            return;
        }

        public static const NAME:String="DialogueMediator";
    }
}


//          class DefaultMarketManagerFacade
package mgs.aurora.modules.defaultMarketManager 
{
    import flash.display.*;
    import mgs.aurora.modules.defaultMarketManager.controller.*;
    import mgs.aurora.modules.defaultMarketManager.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class DefaultMarketManagerFacade extends org.puremvc.as3.multicore.patterns.facade.Facade implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function DefaultMarketManagerFacade(arg1:String)
        {
            super(arg1);
            return;
        }

        public function startup(arg1:flash.display.Sprite):void
        {
            this.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.STARTUP, arg1);
            this.removeCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.STARTUP);
            return;
        }

        protected override function initializeController():void
        {
            super.initializeController();
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.STARTUP, mgs.aurora.modules.defaultMarketManager.controller.StartupCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.SET_UP, mgs.aurora.modules.defaultMarketManager.controller.SetUpCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.SYSTEM_LOADED, mgs.aurora.modules.defaultMarketManager.controller.SystemLoadedCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.SHOW_LOGIN_DIALOG, mgs.aurora.modules.defaultMarketManager.controller.ShowLoginDialogCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.SEND_LOGIN_REQUEST, mgs.aurora.modules.defaultMarketManager.controller.SendLoginRequestCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.LOGIN_SUCCESSFUL, mgs.aurora.modules.defaultMarketManager.controller.LoginSuccessfulCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.LOAD_GAME, mgs.aurora.modules.defaultMarketManager.controller.LoadGameCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.EXIT_GAME, mgs.aurora.modules.defaultMarketManager.controller.ExitGameCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.SHOW_ERROR_DIALOG, mgs.aurora.modules.defaultMarketManager.controller.ShowErrorDialogCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.CASINO_TIMEOUT, mgs.aurora.modules.defaultMarketManager.controller.CasinoTimeoutCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.BANK_PRESSED, mgs.aurora.modules.defaultMarketManager.controller.BankPressedCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.BANK_RETURN, mgs.aurora.modules.defaultMarketManager.controller.BankReturnCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.HELP_PRESSED, mgs.aurora.modules.defaultMarketManager.controller.HelpPressedCommand);
            this.registerCommand(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.BALANCE_UPDATED, mgs.aurora.modules.defaultMarketManager.controller.BalanceUpdatedCommand);
            return;
        }

        public static function getInstance(arg1:String):mgs.aurora.modules.defaultMarketManager.DefaultMarketManagerFacade
        {
            if (mgs.aurora.modules.defaultMarketManager.DefaultMarketManagerFacade._instance == null) 
            {
                mgs.aurora.modules.defaultMarketManager.DefaultMarketManagerFacade._instance = new DefaultMarketManagerFacade(arg1);
            }
            return mgs.aurora.modules.defaultMarketManager.DefaultMarketManagerFacade._instance;
        }

        public static const NAME:String="defaultMarketManagerFacade";

        public static const STARTUP:String=NAME + "/notes/startup";

        internal static var _instance:mgs.aurora.modules.defaultMarketManager.DefaultMarketManagerFacade;
    }
}


//          class defaultMarketManager
package mgs.aurora.modules.defaultMarketManager 
{
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.common.interfaces.marketManager.*;
    import mgs.aurora.common.interfaces.strings.*;
    import mgs.aurora.modules.defaultMarketManager.model.*;
    import mgs.aurora.modules.defaultMarketManager.notifications.*;
    import mgs.aurora.modules.defaultMarketManager.view.*;
    
    public class defaultMarketManager extends flash.display.Sprite implements mgs.aurora.common.interfaces.marketManager.IMarketManager
    {
        public function defaultMarketManager()
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
            this._facade = mgs.aurora.modules.defaultMarketManager.DefaultMarketManagerFacade.getInstance("DefaultMarketManager");
            this._facade.startup(this);
            return;
        }

        public function setup(arg1:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler, arg2:mgs.aurora.common.interfaces.comms.IXManPacketSender, arg3:mgs.aurora.common.interfaces.strings.ILanguageStrings, arg4:flash.utils.Dictionary):void
        {
            this._facade.registerProxy(new mgs.aurora.modules.defaultMarketManager.model.XmanProxy(arg2));
            this._facade.registerProxy(new mgs.aurora.modules.defaultMarketManager.model.StringsProxy(arg3));
            this._dialogueMediator = new mgs.aurora.modules.defaultMarketManager.view.DialogueMediator(arg1);
            this._facade.registerMediator(this._dialogueMediator);
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.SET_UP);
            return;
        }

        public function systemLoaded(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.SYSTEM_LOADED);
            return;
        }

        public function showLoginDialog(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.SHOW_LOGIN_DIALOG);
            return;
        }

        public function sendLoginRequest(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.SEND_LOGIN_REQUEST);
            return;
        }

        public function loggedInSuccessFull(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.LOGIN_SUCCESSFUL);
            return;
        }

        public function loadGameModule(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.LOAD_GAME);
            return;
        }

        public function exitGameModule(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.EXIT_GAME);
            return;
        }

        public function showErrorDialog(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.SHOW_ERROR_DIALOG);
            return;
        }

        public function casinoTimeout(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.CASINO_TIMEOUT);
            return;
        }

        public function bankButtonPressed(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.BANK_PRESSED);
            return;
        }

        public function returnFromBank(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.BANK_RETURN);
            return;
        }

        public function myAccountButtonPressed(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.MYACCOUNT_PRESSED);
            return;
        }

        public function helpButtonPressed(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.HELP_PRESSED);
            return;
        }

        public function showBonusBubble(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.SHOW_BONUSBUBBLE);
            return;
        }

        public function balanceUpdated(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.defaultMarketManager.notifications.DefaultMarketManagerNotifications.BALANCE_UPDATED, arg1);
            return;
        }

        public function sendCloseGameLogoutRequest(arg1:Object):void
        {
            return;
        }

        public static const NAME:String="DefaultMarketManager";

        internal var _facade:mgs.aurora.modules.defaultMarketManager.DefaultMarketManagerFacade;

        internal var _dialogueMediator:mgs.aurora.modules.defaultMarketManager.view.DialogueMediator;
    }
}


