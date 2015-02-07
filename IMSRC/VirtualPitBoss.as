//ActionScript 3.0
//  package mgs
//    package aurora
//      package modules
//        package vpb
//          package controller
//            class CompleteRMMActionCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import mgs.aurora.modules.vpb.pipes.param.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class CompleteRMMActionCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function CompleteRMMActionCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc3:*=null;
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            if (!(loc1.getData() == null) || loc1.getData() == null && !(loc1.messageType == -1)) 
            {
                var loc4:*=loc1.messageType;
                switch (loc4) 
                {
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_MY_ACCOUNT:
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_CASHCHECK:
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_PLAYCHECK:
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_LOYALTY:
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_OLR:
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_WEBECASH:
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_WEBPAGE:
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_CHAT:
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_FUNBONUS_TERMS_AND_CONDITIONS:
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_FUNBONUS_TUTORIAL:
                    {
                        loc3 = facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
                        Debugger.trace("RMM :: CompleteRMMActionCommand : " + loc1.messageType + " , " + loc3.winParameters[loc1.messageType], "SYSTEM");
                        if (loc3.winParameters[loc1.messageType] == null) 
                        {
                            sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.INITIATE_ACTION);
                            loc2.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_CLOSE_DELAY_TIMER);
                        }
                        else 
                        {
                            sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.REQUEST_WEB_APP_DETAILS, loc1.messageType);
                        }
                        break;
                    }
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_GAME:
                    {
                        facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.IS_GAME_VALID, new mgs.aurora.modules.vpb.pipes.param.IsGameValidParameters(loc1.moduleID, loc1.clientID));
                        loc2.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_CLOSE_DELAY_TIMER);
                        break;
                    }
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.SWITCH_REAL_TO_FUN:
                    {
                        facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SWITCH_USER_TYPE, 2);
                        break;
                    }
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.SWITCH_FUN_TO_REAL:
                    {
                        facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SWITCH_USER_TYPE, 0);
                        break;
                    }
                    case -1:
                    {
                        loc2.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_CLOSE_DELAY_TIMER);
                        break;
                    }
                }
            }
            return;
        }
    }
}


//            class DisableCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class DisableCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function DisableCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            this.updateConfig();
            this.updateView();
            this.stopTimers();
            return;
        }

        internal function updateConfig():void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            loc1.enabled = false;
            return;
        }

        internal function updateView():void
        {
            var loc1:*=this.facade.retrieveMediator(mgs.aurora.modules.vpb.view.PopupMediator.NAME) as mgs.aurora.modules.vpb.view.PopupMediator;
            loc1.removePopup();
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.RMMLocalConnectionProxy.NAME) as mgs.aurora.modules.vpb.model.RMMLocalConnectionProxy;
            loc2.close();
            return;
        }

        internal function stopTimers():void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            loc1.stopAll();
            return;
        }
    }
}


//            class DisplayMessageCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import mgs.aurora.modules.vpb.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class DisplayMessageCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function DisplayMessageCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            loc1.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.REMOVE_MESSAGE_DELAY);
            var loc2:*=this.facade.retrieveMediator(mgs.aurora.modules.vpb.view.PopupMediator.NAME) as mgs.aurora.modules.vpb.view.PopupMediator;
            var loc3:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.DisplayMessageProxy.NAME) as mgs.aurora.modules.vpb.model.DisplayMessageProxy;
            loc2.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.ANIMATE_MESSAGE_IN, loc3.getData());
            return;
        }
    }
}


//            class EnableCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class EnableCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function EnableCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            if (!loc1.supported) 
            {
                this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.ERROR, null, mgs.aurora.common.enums.vpb.VPBErrorTypes.VPB_NOT_SUPPORTED);
                return;
            }
            if (!loc1.enabled) 
            {
                loc1.enabled = true;
                loc2 = this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
                loc2.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.INIT_MESSAGE_DELAY);
            }
            return;
        }
    }
}


//            class GetBalanceCommand
package mgs.aurora.modules.vpb.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.vpb.enums.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class GetBalanceCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function GetBalanceCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=new flash.utils.Dictionary();
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] = "10001";
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] = "1";
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] = mgs.aurora.modules.vpb.enums.VPBVerbs.GET_BALANCE + "::" + new Date().valueOf();
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = mgs.aurora.modules.vpb.enums.VPBVerbs.GET_BALANCE;
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request/>");
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] = false;
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] = mgs.aurora.modules.vpb.enums.VPBVerbs.GET_BALANCE;
            this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SEND_PACKET, loc1);
            return;
        }
    }
}


//            class GetNextMessageCommand
package mgs.aurora.modules.vpb.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.vpb.enums.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class GetNextMessageCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function GetNextMessageCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            if (loc1.numMessages > 0) 
            {
                loc2 = new flash.utils.Dictionary();
                loc2[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] = mgs.aurora.modules.vpb.enums.VPBPacketIDs.CLIENT_ID;
                loc2[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] = mgs.aurora.modules.vpb.enums.VPBPacketIDs.MODULE_ID;
                loc2[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] = mgs.aurora.modules.vpb.enums.VPBVerbs.GET_NEXT_MESSAGE + "::" + new Date().valueOf();
                loc2[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = mgs.aurora.modules.vpb.enums.VPBVerbs.GET_NEXT_MESSAGE;
                loc2[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request/>");
                loc2[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] = false;
                loc2[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] = mgs.aurora.modules.vpb.enums.VPBVerbs.GET_NEXT_MESSAGE;
                this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SEND_PACKET, loc2);
            }
            else 
            {
                (loc3 = this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy).startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.NUM_MESSAGES_REQUEST_DELAY);
            }
            return;
        }
    }
}


//            class GetNumMessagesCommand
package mgs.aurora.modules.vpb.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.vpb.enums.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class GetNumMessagesCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function GetNumMessagesCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=new flash.utils.Dictionary();
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] = mgs.aurora.modules.vpb.enums.VPBPacketIDs.CLIENT_ID;
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] = mgs.aurora.modules.vpb.enums.VPBPacketIDs.MODULE_ID;
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] = mgs.aurora.modules.vpb.enums.VPBVerbs.GET_NUM_MESSAGES + "::" + new Date().valueOf();
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = mgs.aurora.modules.vpb.enums.VPBVerbs.GET_NUM_MESSAGES;
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request/>");
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] = false;
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] = mgs.aurora.modules.vpb.enums.VPBVerbs.GET_NUM_MESSAGES;
            this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SEND_PACKET, loc1);
            return;
        }
    }
}


//            class HandleGameValidCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.enums.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import mgs.aurora.modules.vpb.pipes.param.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class HandleGameValidCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function HandleGameValidCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as Boolean;
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.SessionObjectProxy.NAME) as mgs.aurora.modules.vpb.model.SessionObjectProxy;
            var loc3:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            var loc4:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            var loc5:*="";
            if (loc2.currentModuleID == loc3.moduleID && loc2.currentClientID == loc3.clientID) 
            {
                loc5 = mgs.aurora.common.enums.vpb.VPBErrorTypes.LAUNCHING_SAME_GAME;
                loc1 = false;
            }
            if (loc1) 
            {
                if (loc3.title == "" || loc3.title == null) 
                {
                    sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.INITIATE_ACTION);
                    loc4.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_CLOSE_DELAY_TIMER);
                    return;
                }
                this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.DISPLAY_MESSAGE);
            }
            else if (loc3.packetText != mgs.aurora.modules.vpb.enums.VPBPacketText.RMM_MESSAGE) 
            {
                this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RESTART_PACKET_TIMER);
            }
            else 
            {
                loc4.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_CLOSE_DELAY_TIMER);
                sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.DISPLAY_INVALID_GAME_MESSAGE, new mgs.aurora.modules.vpb.pipes.param.IsGameValidParameters(loc3.clientID, loc3.moduleID), loc5);
            }
            return;
        }
    }
}


//            class HandleWebAppAvailableCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class HandleWebAppAvailableCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function HandleWebAppAvailableCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=arg1.getBody() as Boolean;
            if (loc1) 
            {
                loc2 = this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
                if (loc2.title == "" || loc2.title == null) 
                {
                    sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.INITIATE_ACTION);
                    facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RESTART_PACKET_TIMER);
                    return;
                }
                this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.DISPLAY_MESSAGE);
            }
            else 
            {
                this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RESTART_PACKET_TIMER);
            }
            return;
        }
    }
}


//            class HandleWebAppDetailsReceivedCommand
package mgs.aurora.modules.vpb.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class HandleWebAppDetailsReceivedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function HandleWebAppDetailsReceivedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=flash.utils.Dictionary(arg1.getBody());
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            var loc3:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.RMMLocalConnectionProxy.NAME) as mgs.aurora.modules.vpb.model.RMMLocalConnectionProxy;
            if (loc2.messageType == mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_CHAT) 
            {
                loc1["url"] = loc2.url;
            }
            loc3.outGoingLaunchSite(loc1, loc2.messageType);
            var loc4:*;
            (loc4 = facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy).startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_CLOSE_DELAY_TIMER);
            return;
        }
    }
}


//            class HideMessageCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class HideMessageCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function HideMessageCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.ANIMATE_MESSAGE_OUT);
            this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RESTART_PACKET_TIMER);
            return;
        }
    }
}


//            class InitConfigCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.common.interfaces.sounds.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.model.vo.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class InitConfigCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function InitConfigCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=null;
            if (arg1.getBody()) 
            {
                loc1 = arg1.getBody() as mgs.aurora.modules.vpb.model.vo.SetupParams;
                loc2 = new mgs.aurora.modules.vpb.model.VPBConfigProxy(loc1.config);
                this.facade.registerProxy(loc2);
                this.initializeTimers(loc2);
                this.setupXManProx(loc1.xman);
                this.setupSessionProx(loc1.session);
                this.setupSoundEngineProxy(loc1.sounds);
                if (loc2.rmmSupported) 
                {
                    this.initializeRMM();
                }
                loc2.winParameters = loc1.windowParameters;
                this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SETUP_COMPLETE);
            }
            else 
            {
                this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.ERROR, null, mgs.aurora.common.enums.vpb.VPBErrorTypes.INVALID_CONFIG_DATA);
            }
            return;
        }

        internal function initializeRMM():void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            sendNotification(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.INITIALISE_RMM, {"stageWidth":loc1.stageWidth, "stageHeight":loc1.stageHeight, "offsetRight":loc1.rmmOffsetRight, "offsetBottom":loc1.rmmOffsetBottom, "toastDisplayTime":loc1.rmmToastDisplayTime, "centeredDisplayTime":loc1.rmmCenteredDisplayTime});
            return;
        }

        internal function setupSoundEngineProxy(arg1:mgs.aurora.common.interfaces.sounds.ISounds):void
        {
            facade.registerProxy(new mgs.aurora.modules.vpb.model.SoundEngineProxy(arg1));
            return;
        }

        internal function setupSessionProx(arg1:Object):void
        {
            facade.registerProxy(new mgs.aurora.modules.vpb.model.SessionObjectProxy(arg1));
            return;
        }

        internal function setupXManProx(arg1:mgs.aurora.common.interfaces.comms.IXManPacketSender):void
        {
            facade.registerProxy(new mgs.aurora.modules.vpb.model.XManProxy(arg1));
            return;
        }

        internal function initializeTimers(arg1:mgs.aurora.modules.vpb.model.VPBConfigProxy):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            loc1.addTimer(new mgs.aurora.modules.vpb.model.TimerConfig(mgs.aurora.modules.vpb.model.timer.TimerNames.INIT_MESSAGE_DELAY, arg1.initMessageDelay));
            loc1.addTimer(new mgs.aurora.modules.vpb.model.TimerConfig(mgs.aurora.modules.vpb.model.timer.TimerNames.NEXT_MESSAGE_DELAY, arg1.nextMessageDelay));
            loc1.addTimer(new mgs.aurora.modules.vpb.model.TimerConfig(mgs.aurora.modules.vpb.model.timer.TimerNames.NUM_MESSAGES_REQUEST_DELAY, arg1.numMessagesRequestDelay));
            loc1.addTimer(new mgs.aurora.modules.vpb.model.TimerConfig(mgs.aurora.modules.vpb.model.timer.TimerNames.REMOVE_MESSAGE_DELAY, arg1.removeMessageDelay));
            loc1.addTimer(new mgs.aurora.modules.vpb.model.TimerConfig(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_METHOD_CALL, arg1.rmmCallbackTimeout));
            loc1.addTimer(new mgs.aurora.modules.vpb.model.TimerConfig(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_REMOVE_MESSAGE_DELAY, 100000));
            loc1.addTimer(new mgs.aurora.modules.vpb.model.TimerConfig(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_CLOSE_DELAY_TIMER, 1000));
            loc1.addTimer(new mgs.aurora.modules.vpb.model.TimerConfig(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_AFTER_CLOSED_DELAY_TIMER, 100));
            return;
        }
    }
}


//            class PacketReceivedCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.enums.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.message.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.model.vo.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import mgs.aurora.modules.vpb.pipes.param.*;
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
            var loc1:*=arg1.getBody() as XML;
            var loc2:*=loc1.Id.@verb.toString();
            var loc3:*=loc2;
            switch (loc3) 
            {
                case mgs.aurora.modules.vpb.enums.VPBVerbs.GET_NUM_MESSAGES:
                {
                    this.handleGetNumMessagesResponse(loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.enums.VPBVerbs.GET_NEXT_MESSAGE:
                {
                    this.handleGetNextMessageResponse(loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.enums.VPBVerbs.GET_BALANCE:
                {
                    this.handleBalanceUpdate(loc1);
                }
            }
            return;
        }

        internal function handleBalanceUpdate(arg1:XML):void
        {
            this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.UPDATE_BALANCE, arg1.Response.PlayerInfo.@Balance);
            return;
        }

        internal function handleGetNumMessagesResponse(arg1:XML):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=uint(arg1.Response.NumMessages.@count);
            if (loc1 > 0) 
            {
                loc2 = this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
                loc2.numMessages = loc1;
                this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.GET_NEXT_MESSAGE);
            }
            else 
            {
                (loc3 = this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy).startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.NUM_MESSAGES_REQUEST_DELAY);
            }
            return;
        }

        internal function handleGetNextMessageResponse(arg1:XML):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            loc1.setData(arg1);
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            var loc3:*;
            var loc4:*=((loc3 = loc2).numMessages - 1);
            loc3.numMessages = loc4;
            loc3 = loc1.packetType;
            switch (loc3) 
            {
                case mgs.aurora.modules.vpb.enums.VPBPacketTypes.VPB_INTERIM_PACKET:
                {
                    this.handleNormalVPBMessage(this.parseInterimPacket(loc1), loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.enums.VPBPacketTypes.VPB_FULL_PACKET:
                {
                    if (loc1.packetText != mgs.aurora.modules.vpb.enums.VPBPacketText.RMM_MESSAGE) 
                    {
                        this.handleNormalVPBMessage(this.parseFullPacket(loc1), loc1);
                    }
                    else if (loc2.rmmSupported) 
                    {
                        this.handleRMMVPBMessage(this.parseRMMPacket(loc1));
                    }
                    else 
                    {
                        facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RESTART_PACKET_TIMER);
                    }
                    break;
                }
            }
            facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.GET_BALANCE);
            return;
        }

        internal function parseRMMPacket(arg1:mgs.aurora.modules.vpb.model.ResponseProxy):mgs.aurora.modules.vpb.model.message.MessageContents
        {
            var loc1:*=new mgs.aurora.modules.vpb.model.message.MessageContents();
            loc1.packetText = arg1.packetText;
            loc1.messageIdentifier = arg1.messageIdentifier;
            loc1.serverID = arg1.serverID;
            return loc1;
        }

        internal function handleRMMVPBMessage(arg1:mgs.aurora.modules.vpb.model.message.MessageContents):void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.RMMLocalConnectionProxy.NAME) as mgs.aurora.modules.vpb.model.RMMLocalConnectionProxy;
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.SessionObjectProxy.NAME) as mgs.aurora.modules.vpb.model.SessionObjectProxy;
            var loc3:*;
            (loc3 = facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy).isWaitingForRMMCallback = true;
            var loc4:*=loc1.connect();
            var loc5:*=new mgs.aurora.modules.vpb.model.vo.LoadRMMTemplateParams(loc4, uint(loc2.serverID), loc2.username, arg1.messageIdentifier, loc2.language, loc2.clientType, loc2.userType);
            facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.LOAD_RMM_TEMPLATE, loc5);
            return;
        }

        internal function handleNormalVPBMessage(arg1:mgs.aurora.modules.vpb.model.message.MessageContents, arg2:mgs.aurora.modules.vpb.model.ResponseProxy):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.DisplayMessageProxy.NAME) as mgs.aurora.modules.vpb.model.DisplayMessageProxy;
            loc1.setData(arg1);
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            if (arg1.messageType == mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_GAME || arg1.messageType == mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_CASHCHECK || arg1.messageType == mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_LOYALTY || arg1.messageType == mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_MY_ACCOUNT || arg1.messageType == mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_PLAYCHECK) 
            {
                loc2.stopTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.REMOVE_MESSAGE_DELAY);
                var loc3:*=arg1.messageType;
                switch (loc3) 
                {
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_GAME:
                    {
                        this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.IS_GAME_VALID, new mgs.aurora.modules.vpb.pipes.param.IsGameValidParameters(arg1.moduleID, arg1.clientID));
                        return;
                    }
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_CASHCHECK:
                    {
                        this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.IS_WEB_APP_AVAILABLE, mgs.aurora.common.enums.vpb.VPBWebApps.CASHCHECK);
                        return;
                    }
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_LOYALTY:
                    {
                        this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.IS_WEB_APP_AVAILABLE, mgs.aurora.common.enums.vpb.VPBWebApps.LOYALTY_MANAGER);
                        return;
                    }
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_MY_ACCOUNT:
                    {
                        this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.IS_WEB_APP_AVAILABLE, mgs.aurora.common.enums.vpb.VPBWebApps.MY_ACCOUNT);
                        return;
                    }
                    case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_PLAYCHECK:
                    {
                        this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.IS_WEB_APP_AVAILABLE, mgs.aurora.common.enums.vpb.VPBWebApps.PLAYCHECK);
                        return;
                    }
                }
            }
            if (arg2.title == "" || arg2.title == null) 
            {
                sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.INITIATE_ACTION);
                facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RESTART_PACKET_TIMER);
                return;
            }
            this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.DISPLAY_MESSAGE);
            return;
        }

        internal function parseInterimPacket(arg1:mgs.aurora.modules.vpb.model.ResponseProxy):mgs.aurora.modules.vpb.model.message.MessageContents
        {
            var loc1:*=new mgs.aurora.modules.vpb.model.message.MessageContents();
            loc1.messageType = arg1.messageType;
            loc1.title = arg1.title;
            loc1.body = arg1.messageBody;
            loc1.hyperlink = arg1.hyperlink;
            return loc1;
        }

        internal function parseFullPacket(arg1:mgs.aurora.modules.vpb.model.ResponseProxy):mgs.aurora.modules.vpb.model.message.MessageContents
        {
            var loc1:*=new mgs.aurora.modules.vpb.model.message.MessageContents();
            loc1.messageType = arg1.messageType;
            loc1.moduleID = arg1.moduleID;
            loc1.clientID = arg1.clientID;
            loc1.title = arg1.title;
            loc1.body = arg1.messageBody;
            loc1.hyperlink = arg1.hyperlink;
            loc1.postData = arg1.postData;
            return loc1;
        }
    }
}


//            class PrepModelCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.modules.vpb.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class PrepModelCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function PrepModelCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            this.facade.registerProxy(new mgs.aurora.modules.vpb.model.TimerProxy());
            this.facade.registerProxy(new mgs.aurora.modules.vpb.model.ResponseProxy());
            this.facade.registerProxy(new mgs.aurora.modules.vpb.model.DisplayMessageProxy());
            this.facade.registerProxy(new mgs.aurora.modules.vpb.model.RMMLocalConnectionProxy());
            return;
        }
    }
}


//            class PrepViewCommand
package mgs.aurora.modules.vpb.controller 
{
    import flash.events.*;
    import mgs.aurora.modules.vpb.view.*;
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
            this.facade.registerMediator(new mgs.aurora.modules.vpb.view.ExternalInterfaceMediator());
            this.facade.registerMediator(new mgs.aurora.modules.vpb.view.EventBridgeMediator(arg1.getBody() as flash.events.IEventDispatcher));
            this.facade.registerMediator(new mgs.aurora.modules.vpb.view.PopupMediator());
            return;
        }
    }
}


//            class RMMCallbackTimeoutCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RMMCallbackTimeoutCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RMMCallbackTimeoutCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.CLOSE_RMM_MESSAGE);
            facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RESTART_PACKET_TIMER);
            return;
        }
    }
}


//            class RMMDisplayTimerCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RMMDisplayTimerCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RMMDisplayTimerCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc4:*=NaN;
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            var loc3:*=arg1.getBody() as Number;
            if (loc2.rmmDisplayDuration != 0) 
            {
                loc4 = loc2.rmmDisplayDuration + loc3;
                loc1.updateTimerDuration(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_REMOVE_MESSAGE_DELAY, loc4);
                loc1.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_REMOVE_MESSAGE_DELAY);
            }
            return;
        }
    }
}


//            class RMMToastCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.modules.vpb.enums.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.model.vo.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RMMToastCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RMMToastCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as mgs.aurora.modules.vpb.model.vo.RMMToastParams;
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            var loc3:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            var loc4:*;
            (loc4 = mgs.aurora.modules.vpb.model.RMMLocalConnectionProxy(facade.retrieveProxy(mgs.aurora.modules.vpb.model.RMMLocalConnectionProxy.NAME))).outGoingSetParamList(loc2.winParameters);
            loc2.isWaitingForRMMCallback = false;
            loc2.rmmDisplayDuration = Number(loc1.displaySeconds) * 1000;
            loc3.stopTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_METHOD_CALL);
            var loc5:*=loc1.intDisplayID;
            switch (loc5) 
            {
                case mgs.aurora.modules.vpb.enums.RMMDisplayTypes.RMM_CENTRED_DISPLAY:
                {
                    facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.RMM_CENTRED_FANFAIR, loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.enums.RMMDisplayTypes.RMM_TOAST_FROM_RIGHT_DISPLAY:
                {
                    facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.RMM_TOAST_RIGHT, loc1);
                    break;
                }
            }
            return;
        }
    }
}


//            class RMMTrackingCommand
package mgs.aurora.modules.vpb.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.vpb.enums.*;
    import mgs.aurora.modules.vpb.model.vo.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RMMTrackingCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RMMTrackingCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as mgs.aurora.modules.vpb.model.vo.RMMTrackingParams;
            var loc2:*=new flash.utils.Dictionary();
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] = mgs.aurora.modules.vpb.enums.VPBPacketIDs.CLIENT_ID;
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] = mgs.aurora.modules.vpb.enums.VPBPacketIDs.MODULE_ID;
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] = mgs.aurora.modules.vpb.enums.VPBVerbs.PLAYER_RESPONSE + "::" + new Date().valueOf();
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = mgs.aurora.modules.vpb.enums.VPBVerbs.PLAYER_RESPONSE;
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request>\r\n\t\t\t\t\t" + ("<PlayerResponse messageIdentifier=\"" + loc1.messageId + "\" playerResponseTypeID=\"" + loc1.playerResponseTypeID + "\" linkIndex=\"" + loc1.linkIndex + "\"/>") + "\r\n\t\t\t\t</Request>");
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] = false;
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] = mgs.aurora.modules.vpb.enums.VPBVerbs.PLAYER_RESPONSE;
            sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SEND_PACKET, loc2);
            return;
        }
    }
}


//            class RestartPacketTimerCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RestartPacketTimerCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RestartPacketTimerCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            if (loc1.numMessages > 0) 
            {
                loc2.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.NEXT_MESSAGE_DELAY);
            }
            else 
            {
                loc2.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.NUM_MESSAGES_REQUEST_DELAY);
            }
            return;
        }
    }
}


//            class SendActionNotificationCommand
package mgs.aurora.modules.vpb.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SendActionNotificationCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SendActionNotificationCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            loc1.stopTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.REMOVE_MESSAGE_DELAY);
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            var loc3:*;
            (loc3 = new flash.utils.Dictionary())[mgs.aurora.common.enums.vpb.VPBActionNotificationParams.MESSAGE_TYPE] = loc2.messageType;
            var loc4:*=loc2.messageType;
            switch (loc4) 
            {
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.SEND_EMAIL:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.POST_TO_WEBSERVER:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.POPUP_MESSAGE_ONLY:
                {
                    return;
                }
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_OLR:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_WEBECASH:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_PLAYCHECK:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_CASHCHECK:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_LOYALTY:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_FUNBONUS_TERMS_AND_CONDITIONS:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_FUNBONUS_TUTORIAL:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_MY_ACCOUNT:
                {
                    break;
                }
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_GAME:
                {
                    loc3[mgs.aurora.common.enums.vpb.VPBActionNotificationParams.CLIENT_ID] = loc2.clientID;
                    loc3[mgs.aurora.common.enums.vpb.VPBActionNotificationParams.MODULE_ID] = loc2.moduleID;
                    break;
                }
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.DISPLAY_WELCOME_FANFARE:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.DISPLAY_BIRTHDAY_FANFARE:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.DISPLAY_BONUS_FANFARE:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_WEBPAGE:
                case mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_CHAT:
                {
                    loc3[mgs.aurora.common.enums.vpb.VPBActionNotificationParams.POST_DATA] = loc2.postData;
                    loc3[mgs.aurora.common.enums.vpb.VPBActionNotificationParams.URL] = loc2.url;
                    break;
                }
            }
            sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.ACTION_NOTIFICATION, loc3, loc2.messageType.toString());
            if (!(loc2.messageType == mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_FUNBONUS_TERMS_AND_CONDITIONS) && !(loc2.messageType == mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_FUNBONUS_TUTORIAL)) 
            {
                loc2.setData(null);
            }
            return;
        }
    }
}


//            class SendPacketCommand
package mgs.aurora.modules.vpb.controller 
{
    import flash.utils.*;
    import mgs.aurora.modules.vpb.model.*;
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
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.XManProxy.NAME) as mgs.aurora.modules.vpb.model.XManProxy;
            loc1.sendPacket(arg1.getBody() as flash.utils.Dictionary);
            return;
        }
    }
}


//            class SetArtCommand
package mgs.aurora.modules.vpb.controller 
{
    import flash.display.*;
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import mgs.aurora.modules.vpb.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetArtCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetArtCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            if (!arg1.getBody() as flash.display.LoaderInfo) 
            {
                this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.ERROR, null, mgs.aurora.common.enums.vpb.VPBErrorTypes.INVALID_ART_SUPPLIED);
                return;
            }
            var loc1:*=this.facade.retrieveMediator(mgs.aurora.modules.vpb.view.PopupMediator.NAME) as mgs.aurora.modules.vpb.view.PopupMediator;
            loc1.lib = arg1.getBody() as flash.display.LoaderInfo;
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.SoundEngineProxy.NAME) as mgs.aurora.modules.vpb.model.SoundEngineProxy;
            var loc3:*;
            (loc3 = new Array()).push("VPBNotifySound");
            loc2.add(loc3);
            return;
        }
    }
}


//            class SetDialogParentCommand
package mgs.aurora.modules.vpb.controller 
{
    import flash.display.*;
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import mgs.aurora.modules.vpb.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetDialogParentCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetDialogParentCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as flash.display.DisplayObjectContainer;
            if (loc1 == null) 
            {
                sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.ERROR, null, mgs.aurora.common.enums.vpb.VPBErrorTypes.INVALID_DIALOG_PARENT_SUPPLIED);
                return;
            }
            var loc2:*=this.facade.retrieveMediator(mgs.aurora.modules.vpb.view.PopupMediator.NAME) as mgs.aurora.modules.vpb.view.PopupMediator;
            loc2.setViewComponent(loc1);
            return;
        }
    }
}


//            class SetFrameTypeCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetFrameTypeCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetFrameTypeCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            if (!arg1.getBody() as String) 
            {
                sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.ERROR, null, mgs.aurora.common.enums.vpb.VPBErrorTypes.INVALID_FRAME_TYPE_SUPPLIED);
                return;
            }
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            loc1.frameType = arg1.getBody() as String;
            return;
        }
    }
}


//            class SetupCommand
package mgs.aurora.modules.vpb.controller 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetupCommand extends org.puremvc.as3.multicore.patterns.command.MacroCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetupCommand()
        {
            super();
            return;
        }

        protected override function initializeMacroCommand():void
        {
            super.initializeMacroCommand();
            this.addSubCommand(mgs.aurora.modules.vpb.controller.InitConfigCommand);
            return;
        }
    }
}


//            class StartupCommand
package mgs.aurora.modules.vpb.controller 
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
            this.addSubCommand(mgs.aurora.modules.vpb.controller.PrepModelCommand);
            this.addSubCommand(mgs.aurora.modules.vpb.controller.PrepViewCommand);
            return;
        }
    }
}


//            class TimerCompleteCommand
package mgs.aurora.modules.vpb.controller 
{
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class TimerCompleteCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function TimerCompleteCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getType();
            switch (loc1) 
            {
                case mgs.aurora.modules.vpb.model.timer.TimerNames.INIT_MESSAGE_DELAY:
                {
                    this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.GET_NUM_MESSAGES);
                    break;
                }
                case mgs.aurora.modules.vpb.model.timer.TimerNames.NEXT_MESSAGE_DELAY:
                {
                    this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.GET_NEXT_MESSAGE);
                    break;
                }
                case mgs.aurora.modules.vpb.model.timer.TimerNames.NUM_MESSAGES_REQUEST_DELAY:
                {
                    this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.GET_NUM_MESSAGES);
                    break;
                }
                case mgs.aurora.modules.vpb.model.timer.TimerNames.REMOVE_MESSAGE_DELAY:
                {
                    this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.HIDE_MESSAGE);
                    break;
                }
                case mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_METHOD_CALL:
                {
                    this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RMM_CALLBACK_TIMEOUT);
                    break;
                }
                case mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_REMOVE_MESSAGE_DELAY:
                {
                    this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RMM_CALLBACK_TIMEOUT);
                    break;
                }
                case mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_CLOSE_DELAY_TIMER:
                {
                    mgs.aurora.modules.vpb.model.RMMLocalConnectionProxy(facade.retrieveProxy(mgs.aurora.modules.vpb.model.RMMLocalConnectionProxy.NAME)).close();
                    break;
                }
                case mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_AFTER_CLOSED_DELAY_TIMER:
                {
                    facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RESTART_PACKET_TIMER);
                    break;
                }
            }
            return;
        }
    }
}


//          package enums
//            class RMMDisplayTypes
package mgs.aurora.modules.vpb.enums 
{
    public class RMMDisplayTypes extends Object
    {
        public function RMMDisplayTypes()
        {
            super();
            return;
        }

        public static const RMM_TOAST_FROM_RIGHT_DISPLAY:Number=0;

        public static const RMM_CENTRED_DISPLAY:Number=1;
    }
}


//            class VPBPacketIDs
package mgs.aurora.modules.vpb.enums 
{
    public class VPBPacketIDs extends Object
    {
        public function VPBPacketIDs()
        {
            super();
            return;
        }

        public static const CLIENT_ID:String="0";

        public static const MODULE_ID:String="130";
    }
}


//            class VPBPacketText
package mgs.aurora.modules.vpb.enums 
{
    public class VPBPacketText extends Object
    {
        public function VPBPacketText()
        {
            super();
            return;
        }

        public static const RMM_MESSAGE:String="RICH_MEDIA_MESSAGE";
    }
}


//            class VPBPacketTypes
package mgs.aurora.modules.vpb.enums 
{
    public class VPBPacketTypes extends Object
    {
        public function VPBPacketTypes()
        {
            super();
            return;
        }

        public static const VPB_INTERIM_PACKET:uint=0;

        public static const VPB_FULL_PACKET:uint=1;
    }
}


//            class VPBSounds
package mgs.aurora.modules.vpb.enums 
{
    public class VPBSounds extends Object
    {
        public function VPBSounds()
        {
            super();
            return;
        }

        public static const DISPLAY_RMM_MESSAGE:String="VPBNotifySound";
    }
}


//            class VPBVerbs
package mgs.aurora.modules.vpb.enums 
{
    public class VPBVerbs extends Object
    {
        public function VPBVerbs()
        {
            super();
            return;
        }

        public static const GET_NUM_MESSAGES:String="VP_GETNUMMESSAGES";

        public static const GET_NEXT_MESSAGE:String="VP_GETNEXTMESSAGE";

        public static const PLAYER_RESPONSE:String="PlayerResponse";

        public static const GET_BALANCE:String="GetBalance";
    }
}


//          package model
//            package message
//              class MessageContents
package mgs.aurora.modules.vpb.model.message 
{
    public class MessageContents extends Object
    {
        public function MessageContents()
        {
            super();
            return;
        }

        public function get messageType():uint
        {
            return this._messageType;
        }

        public function set messageType(arg1:uint):void
        {
            this._messageType = arg1;
            return;
        }

        public function get title():String
        {
            return this._title;
        }

        public function set title(arg1:String):void
        {
            this._title = arg1;
            return;
        }

        public function get body():String
        {
            return this._body;
        }

        public function set body(arg1:String):void
        {
            this._body = arg1;
            return;
        }

        public function get hyperlink():String
        {
            return this._hyperlink;
        }

        public function set hyperlink(arg1:String):void
        {
            this._hyperlink = arg1;
            return;
        }

        public function get moduleID():Number
        {
            return this._moduleID;
        }

        public function set moduleID(arg1:Number):void
        {
            this._moduleID = arg1;
            return;
        }

        public function get clientID():Number
        {
            return this._clientID;
        }

        public function set clientID(arg1:Number):void
        {
            this._clientID = arg1;
            return;
        }

        public function get postData():String
        {
            return this._postData;
        }

        public function set postData(arg1:String):void
        {
            this._postData = arg1;
            return;
        }

        public function get packetText():String
        {
            return this._packetText;
        }

        public function set packetText(arg1:String):void
        {
            this._packetText = arg1;
            return;
        }

        public function get messageIdentifier():String
        {
            return this._messageIdentifier;
        }

        public function set messageIdentifier(arg1:String):void
        {
            this._messageIdentifier = arg1;
            return;
        }

        public function get serverID():Number
        {
            return this._serverID;
        }

        public function set serverID(arg1:Number):void
        {
            this._serverID = arg1;
            return;
        }

        internal var _messageType:uint;

        internal var _title:String;

        internal var _body:String;

        internal var _url:String;

        internal var _hyperlink:String;

        internal var _moduleID:Number;

        internal var _clientID:Number;

        internal var _postData:String;

        internal var _packetText:String;

        internal var _messageIdentifier:String;

        internal var _serverID:Number;
    }
}


//            package timer
//              class IdentifiableTimerEvent
package mgs.aurora.modules.vpb.model.timer 
{
    import flash.events.*;
    import mgs.aurora.modules.vpb.model.*;
    
    public class IdentifiableTimerEvent extends flash.events.Event
    {
        public function IdentifiableTimerEvent(arg1:String, arg2:mgs.aurora.modules.vpb.model.TimerConfig, arg3:Boolean=false, arg4:Boolean=false)
        {
            super(arg1, arg3, arg4);
            this._timerConfig = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.modules.vpb.model.timer.IdentifiableTimerEvent(type, this.timerConfig, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("IdentifiableTimerEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public function get timerConfig():mgs.aurora.modules.vpb.model.TimerConfig
        {
            return this._timerConfig;
        }

        public function set timerConfig(arg1:mgs.aurora.modules.vpb.model.TimerConfig):void
        {
            this._timerConfig = arg1;
            return;
        }

        public static const TIMER:String="Timer";

        internal var _timerConfig:mgs.aurora.modules.vpb.model.TimerConfig;
    }
}


//              class TimerNames
package mgs.aurora.modules.vpb.model.timer 
{
    public class TimerNames extends Object
    {
        public function TimerNames()
        {
            super();
            return;
        }

        public static const NAME:String="TimerNames";

        public static const INIT_MESSAGE_DELAY:String=NAME + "/timers/init_message_delay";

        public static const NUM_MESSAGES_REQUEST_DELAY:String=NAME + "/timers/num_messages_request_delay";

        public static const NEXT_MESSAGE_DELAY:String=NAME + "/timers/next_message_delay";

        public static const REMOVE_MESSAGE_DELAY:String=NAME + "/timers/remove_message_delay";

        public static const RMM_METHOD_CALL:String=NAME + "/timers/rmm_method_call";

        public static const RMM_REMOVE_MESSAGE_DELAY:String=NAME + "/timers/rmm_remove_message_delay";

        public static const RMM_AFTER_CLOSED_DELAY_TIMER:String=NAME + "/timers/rmm_after_closed_delay_timer";

        public static const RMM_CLOSE_DELAY_TIMER:String=NAME + "/timers/rmm_close_delay_timer";
    }
}


//            package vo
//              class FontSettings
package mgs.aurora.modules.vpb.model.vo 
{
    internal class FontSettings extends Object
    {
        public function FontSettings(arg1:String, arg2:Number, arg3:Boolean, arg4:Boolean)
        {
            super();
            this.font = arg1;
            this.fontSize = arg2;
            this.bold = arg3;
            this.italic = arg4;
            return;
        }

        public var font:String;

        public var fontSize:Number;

        public var bold:Boolean;

        public var italic:Boolean;
    }
}


//              class LoadRMMTemplateParams
package mgs.aurora.modules.vpb.model.vo 
{
    public class LoadRMMTemplateParams extends Object
    {
        public function LoadRMMTemplateParams(arg1:String, arg2:uint, arg3:String, arg4:String, arg5:String, arg6:String, arg7:uint)
        {
            super();
            this.connectionID = arg1;
            this.sid = arg2;
            this.login = arg3;
            this.messageIdentifier = arg4;
            this.userLang = arg5;
            this.clientType = arg6;
            this.userType = arg7;
            return;
        }

        public var connectionID:String;

        public var sid:uint;

        public var login:String;

        public var messageIdentifier:String;

        public var userLang:String;

        public var clientType:String;

        public var userType:uint;
    }
}


//              class RMMLocalConnection
package mgs.aurora.modules.vpb.model.vo 
{
    import flash.events.*;
    import flash.net.*;
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    
    public class RMMLocalConnection extends flash.net.LocalConnection
    {
        public function RMMLocalConnection(arg1:org.puremvc.as3.multicore.interfaces.IFacade)
        {
            super();
            this._facade = arg1;
            return;
        }

        public override function connect(arg1:String):void
        {
            if (this.hasEventListener(flash.events.AsyncErrorEvent.ASYNC_ERROR)) 
            {
                this.removeEventListener(flash.events.AsyncErrorEvent.ASYNC_ERROR, this.onAsyncError);
            }
            this.addEventListener(flash.events.AsyncErrorEvent.ASYNC_ERROR, this.onAsyncError);
            if (this._connected) 
            {
                super.close();
                this._connected = false;
            }
            allowDomain("*");
            allowInsecureDomain("*");
            this._connectionName = arg1;
            super.connect(arg1);
            this._connected = true;
            return;
        }

        internal function onAsyncError(arg1:flash.events.AsyncErrorEvent):void
        {
            Debugger.trace(arg1.toString(), "SYSTEM");
            return;
        }

        public function SetConnectionId(arg1:String):void
        {
            this._sendConnectionName = arg1;
            return;
        }

        public function RMMToast(arg1:Number, arg2:Number, arg3:Number, arg4:Number):void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.RMM_TOAST, new mgs.aurora.modules.vpb.model.vo.RMMToastParams(arg1, arg2, arg3, arg4));
            return;
        }

        public function RMMTracking(arg1:String, arg2:String, arg3:String, arg4:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.RMM_TRACKING, new mgs.aurora.modules.vpb.model.vo.RMMTrackingParams(arg1, arg2, arg3, arg4));
            return;
        }

        public function RMMLaunchRealToFun():void
        {
            Debugger.trace("RMM IFB VPB LC : RMMLaunchRealToFun", "SYSTEM");
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.SWITCH_REAL_TO_FUN;
            this.processRequest();
            return;
        }

        public function RMMLaunchFunToReal():void
        {
            Debugger.trace("RMM IFB VPB LC: RMMLaunchFunToReal", "SYSTEM");
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.SWITCH_FUN_TO_REAL;
            this.processRequest();
            return;
        }

        public function RMMLaunchFunBonusTermsAndConditions():void
        {
            Debugger.trace("RMM IFB VPB LC: RMMLaunchFunBonusTermsAndConditions", "SYSTEM");
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_FUNBONUS_TERMS_AND_CONDITIONS;
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.INITIATE_ACTION, loc1.messageType);
            return;
        }

        public function RMMLaunchFunBonusTutorial():void
        {
            Debugger.trace("RMM IFB VPB LC: RMMLaunchFunBonusTutorial", "SYSTEM");
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_FUNBONUS_TUTORIAL;
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.INITIATE_ACTION, loc1.messageType);
            return;
        }

        public function RMMLaunchChatWindow(arg1:String):void
        {
            this.stopDisplayTimer();
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            loc1.url = arg1;
            loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_CHAT;
            loc1.postData = "";
            this.processRequest();
            return;
        }

        public function RMMLaunchGame(arg1:Number, arg2:Number):void
        {
            this.stopDisplayTimer();
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_GAME;
            loc1.clientID = arg2;
            loc1.moduleID = arg1;
            this.processRequest();
            return;
        }

        public function RMMLaunchExternalBrowser(arg1:String):void
        {
            this.stopDisplayTimer();
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            loc1.url = arg1;
            loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_WEBPAGE;
            loc1.postData = "";
            this.processRequest();
            return;
        }

        public function RMMLaunchWebECash(arg1:String):void
        {
            this.stopDisplayTimer();
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_WEBECASH;
            this.processRequest();
            return;
        }

        public function RMMLaunchOLR(arg1:String):void
        {
            this.stopDisplayTimer();
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_OLR;
            this.processRequest();
            return;
        }

        public function RMMLaunchLoyalty():void
        {
            this.stopDisplayTimer();
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_LOYALTY;
            this.processRequest();
            return;
        }

        public function RMMLaunchUtil(arg1:String):void
        {
            this.stopDisplayTimer();
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.ResponseProxy.NAME) as mgs.aurora.modules.vpb.model.ResponseProxy;
            var loc2:*=arg1.toLowerCase();
            switch (loc2) 
            {
                case "myaccount":
                {
                    loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_MY_ACCOUNT;
                    break;
                }
                case "cashcheck":
                {
                    loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_CASHCHECK;
                    break;
                }
                case "playcheck":
                {
                    loc1.messageType = mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_PLAYCHECK;
                    break;
                }
            }
            this.processRequest();
            return;
        }

        internal function processRequest():void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.COMPLETE_RMM_ACTION);
            return;
        }

        public function BackToCasino():void
        {
            this.stopDisplayTimer();
            this.closeMessage();
            return;
        }

        public function get connectionName():String
        {
            return this._connectionName;
        }

        public function get sendConnectionName():String
        {
            return this._sendConnectionName;
        }

        public function closeMessage():void
        {
            if (this._connected) 
            {
                this._connected = false;
                close();
                this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.CLOSE_RMM_MESSAGE);
            }
            return;
        }

        public function stopDisplayTimer():void
        {
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            loc1.stopTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_REMOVE_MESSAGE_DELAY);
            return;
        }

        internal var _connectionName:String;

        internal var _sendConnectionName:String;

        internal var _facade:org.puremvc.as3.multicore.interfaces.IFacade;

        internal var _connected:Boolean;
    }
}


//              class RMMToastParams
package mgs.aurora.modules.vpb.model.vo 
{
    public class RMMToastParams extends Object
    {
        public function RMMToastParams(arg1:Number, arg2:Number, arg3:Number, arg4:Number)
        {
            super();
            this.width = arg1;
            this.height = arg2;
            this.displaySeconds = arg3;
            this.intDisplayID = arg4;
            return;
        }

        public var width:Number;

        public var height:Number;

        public var displaySeconds:Number;

        public var intDisplayID:Number;
    }
}


//              class RMMTrackingParams
package mgs.aurora.modules.vpb.model.vo 
{
    public class RMMTrackingParams extends Object
    {
        public function RMMTrackingParams(arg1:String, arg2:String, arg3:String, arg4:Object)
        {
            super();
            this.messageId = arg1;
            this.playerResponseTypeID = arg2;
            this.linkIndex = arg3;
            this.optional = arg4;
            return;
        }

        public var messageId:String;

        public var playerResponseTypeID:String;

        public var linkIndex:String;

        public var optional:Object;
    }
}


//              class SetupParams
package mgs.aurora.modules.vpb.model.vo 
{
    import flash.utils.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.common.interfaces.sounds.*;
    
    public class SetupParams extends Object
    {
        public function SetupParams(arg1:XML, arg2:mgs.aurora.common.interfaces.comms.IXManPacketSender, arg3:Object, arg4:mgs.aurora.common.interfaces.sounds.ISounds, arg5:flash.utils.Dictionary)
        {
            super();
            this.config = arg1;
            this.xman = arg2;
            this.session = arg3;
            this.sounds = arg4;
            this.windowParameters = arg5;
            return;
        }

        public var config:XML;

        public var xman:mgs.aurora.common.interfaces.comms.IXManPacketSender;

        public var session:Object;

        public var sounds:mgs.aurora.common.interfaces.sounds.ISounds;

        public var windowParameters:flash.utils.Dictionary;
    }
}


//              class VPBConfigData
package mgs.aurora.modules.vpb.model.vo 
{
    import flash.utils.*;
    
    public class VPBConfigData extends Object
    {
        public function VPBConfigData(arg1:XML)
        {
            super();
            this.enabled = false;
            this.numMessages = 0;
            this.stageWidth = uint(arg1.systemFrame.@width);
            this.stageHeight = uint(arg1.systemFrame.@height);
            this.supported = Boolean(uint(arg1.vpb.@supported));
            this.rmmSupported = Boolean(uint(arg1.vpb.rmm.@useRMM));
            this.rmmOffsetRight = uint(arg1.vpb.rmm.@offsetRight);
            this.rmmOffsetBottom = uint(arg1.vpb.rmm.@offsetBottom);
            this.rmmToastDisplayTime = uint(arg1.vpb.rmm.@toastDisplayTime);
            this.rmmCenteredDisplayTime = uint(arg1.vpb.rmm.@centeredDisplayTime);
            this.tweenInDelay = arg1.vpb.animation.@tweenInDelay / 1000;
            this.tweenOutDelay = arg1.vpb.animation.@tweenOutDelay / 1000;
            this.initMessageDelay = arg1.vpb.eventMessages.@initMessageDelay;
            this.numMessagesRequestDelay = arg1.vpb.eventMessages.@numMessagesRequestDelay;
            this.nextMessageDelay = arg1.vpb.eventMessages.@nextMessageDelay;
            this.removeMessageDelay = arg1.vpb.eventMessages.@removeMessageDelay;
            this.titleFontSettings = new FontSettings(arg1.vpb.eventMessages.title.@font, arg1.vpb.eventMessages.title.@size, Boolean(uint(arg1.vpb.eventMessages.title.@bold)), Boolean(uint(arg1.vpb.eventMessages.title.@italic)));
            this.titleDataFontSettings = new FontSettings(arg1.vpb.eventMessages.titleData.@font, arg1.vpb.eventMessages.titleData.@size, Boolean(uint(arg1.vpb.eventMessages.titleData.@bold)), Boolean(uint(arg1.vpb.eventMessages.titleData.@italic)));
            this.instructionURLFontSettings = new FontSettings(arg1.vpb.eventMessages.instructionURL.@font, arg1.vpb.eventMessages.instructionURL.@size, Boolean(uint(arg1.vpb.eventMessages.instructionURL.@bold)), Boolean(uint(arg1.vpb.eventMessages.instructionURL.@italic)));
            this.parseFrameTypes(arg1.vpb.placement);
            return;
        }

        internal function parseFrameTypes(arg1:XMLList):void
        {
            var loc1:*=null;
            var loc2:*=null;
            this.frameTypes = new flash.utils.Dictionary();
            var loc3:*=0;
            var loc4:*=arg1.children();
            for each (loc2 in loc4) 
            {
                loc1 = new Object();
                loc1.x = Number(loc2.@x).valueOf();
                loc1.y = Number(loc2.@y).valueOf();
                this.frameTypes[loc2.name().toString()] = loc1;
                if (this.frameType) 
                {
                    continue;
                }
                this.xPos = Number(loc1.x).valueOf();
                this.yPos = Number(loc1.y).valueOf();
                this.frameType = loc2.name().toString();
            }
            return;
        }

        public var frameTypes:flash.utils.Dictionary;

        public var frameType:String;

        public var supported:Boolean;

        public var xPos:Number;

        public var yPos:Number;

        public var initMessageDelay:Number;

        public var numMessagesRequestDelay:Number;

        public var nextMessageDelay:Number;

        public var removeMessageDelay:Number;

        public var titleFontSettings:FontSettings;

        public var titleDataFontSettings:FontSettings;

        public var instructionURLFontSettings:FontSettings;

        public var enabled:Boolean;

        public var numMessages:uint;

        public var tweenInDelay:Number;

        public var tweenOutDelay:Number;

        public var waitingForRMMCallback:Boolean;

        public var rmmCallbackTimeout:uint=20000;

        public var rmmDisplayDuration:Number;

        public var rmmSupported:Boolean;

        public var stageWidth:uint;

        public var stageHeight:uint;

        public var rmmOffsetRight:uint;

        public var rmmCenteredDisplayTime:uint;

        public var rmmToastDisplayTime:uint;

        public var rmmOffsetBottom:uint;
    }
}


//            class DisplayMessageProxy
package mgs.aurora.modules.vpb.model 
{
    import mgs.aurora.modules.vpb.model.message.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class DisplayMessageProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function DisplayMessageProxy()
        {
            super(NAME, new mgs.aurora.modules.vpb.model.message.MessageContents());
            return;
        }

        public function get message():mgs.aurora.modules.vpb.model.message.MessageContents
        {
            return getData() as mgs.aurora.modules.vpb.model.message.MessageContents;
        }

        public function get body():String
        {
            return this.message.body;
        }

        public function get clientID():Number
        {
            return this.message.clientID;
        }

        public function get hyperlink():String
        {
            return this.message.hyperlink;
        }

        public function get messageType():uint
        {
            return this.message.messageType;
        }

        public function get moduleID():Number
        {
            return this.message.moduleID;
        }

        public function get postData():String
        {
            return this.message.postData;
        }

        public function get title():String
        {
            return this.message.title;
        }

        public static const NAME:String="DisplayMessageProxy";
    }
}


//            class RMMLocalConnectionProxy
package mgs.aurora.modules.vpb.model 
{
    import flash.net.*;
    import flash.utils.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.vpb.model.vo.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class RMMLocalConnectionProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function RMMLocalConnectionProxy()
        {
            super(NAME, null);
            return;
        }

        internal function get localConnection():mgs.aurora.modules.vpb.model.vo.RMMLocalConnection
        {
            var loc1:*=getData() as mgs.aurora.modules.vpb.model.vo.RMMLocalConnection;
            if (!loc1) 
            {
                loc1 = new mgs.aurora.modules.vpb.model.vo.RMMLocalConnection(facade);
                setData(loc1);
            }
            return loc1;
        }

        public function connect():String
        {
            var loc1:*="_rmm-" + mgs.aurora.common.utilities.GUID.create();
            this.localConnection.connect(loc1);
            return loc1;
        }

        public function get connectionName():String
        {
            return this.localConnection.connectionName;
        }

        public function close():void
        {
            this.localConnection.BackToCasino();
            return;
        }

        public function outGoingSetParamList(arg1:flash.utils.Dictionary):void
        {
            var loc1:*=new flash.net.LocalConnection();
            loc1.send(this.localConnection.sendConnectionName, "setWindowSizes", arg1);
            return;
        }

        public function outGoingLaunchSite(arg1:flash.utils.Dictionary, arg2:int):void
        {
            var loc1:*=new flash.net.LocalConnection();
            arg1["instructionType"] = arg2;
            loc1.send(this.localConnection.sendConnectionName, "setUrlPostData", arg1);
            return;
        }

        public static const NAME:String="RMMLocalConnectionProxy";
    }
}


//            class ResponseProxy
package mgs.aurora.modules.vpb.model 
{
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.enums.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class ResponseProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function ResponseProxy()
        {
            super(NAME, null);
            return;
        }

        public override function setData(arg1:Object):void
        {
            super.setData(arg1);
            this.resetOverrides();
            return;
        }

        internal function resetOverrides():void
        {
            this._url = null;
            this._messageType = -1;
            this._postdata = null;
            this._moduleID = -1;
            this._clientID = -1;
            return;
        }

        internal function get response():XML
        {
            return getData() as XML;
        }

        public function get title():String
        {
            return this.response.Response.Message.Title.@val;
        }

        public function get messageBody():String
        {
            if (this.packetType == mgs.aurora.modules.vpb.enums.VPBPacketTypes.VPB_INTERIM_PACKET) 
            {
                return this.response.Response.Message.TitleData.@val;
            }
            return this.response.Response.Message.Message.@val;
        }

        public function get messageType():int
        {
            if (this._messageType != -1) 
            {
                return this._messageType;
            }
            if (this.response.Response.Message.@messagetype.toXMLString() == "") 
            {
                return -1;
            }
            var loc1:*=int(this.response.Response.Message.@messagetype);
            if (this.packetType == mgs.aurora.modules.vpb.enums.VPBPacketTypes.VPB_INTERIM_PACKET) 
            {
                return loc1 != mgs.aurora.common.enums.vpb.VPBMessageTypes.LAUNCH_OLR ? 7 : 0;
            }
            return loc1;
        }

        public function set messageType(arg1:int):void
        {
            this._messageType = arg1;
            return;
        }

        public function get url():String
        {
            var loc1:*=null;
            if (this._url) 
            {
                return this._url;
            }
            if (this.packetType != mgs.aurora.modules.vpb.enums.VPBPacketTypes.VPB_INTERIM_PACKET) 
            {
                loc1 = this.response.Response.Message.URL.@val;
            }
            else 
            {
                loc1 = this.response.Response.Message.RedirectURL.@val;
            }
            if (!loc1.match("^http")) 
            {
                loc1 = "http://" + loc1;
            }
            return loc1;
        }

        public function set url(arg1:String):void
        {
            this._url = arg1;
            return;
        }

        public function get hyperlink():String
        {
            if (this.packetType == mgs.aurora.modules.vpb.enums.VPBPacketTypes.VPB_INTERIM_PACKET) 
            {
                return this.response.Response.Message.InstructionURL.@val;
            }
            return this.response.Response.Message.HyperLink.@val;
        }

        public function get packetType():uint
        {
            if (this.response.Response.Message.@pktType.toString() != "") 
            {
                return uint(this.response.Response.Message.@pktType);
            }
            return mgs.aurora.modules.vpb.enums.VPBPacketTypes.VPB_FULL_PACKET;
        }

        public function get packetText():String
        {
            return this.response.Response.Message.@pktTxt;
        }

        public function get moduleID():Number
        {
            if (this._moduleID != -1) 
            {
                return this._moduleID;
            }
            return Number(this.response.Response.Message.Game.@MID);
        }

        public function set moduleID(arg1:Number):void
        {
            this._moduleID = arg1;
            return;
        }

        public function set clientID(arg1:Number):void
        {
            this._clientID = arg1;
            return;
        }

        public function get clientID():Number
        {
            if (this._clientID != -1) 
            {
                return this._clientID;
            }
            return Number(this.response.Response.Message.Game.@CID);
        }

        public function get postData():String
        {
            if (this._postdata) 
            {
                return this._postdata;
            }
            return this.response.Response.Message.PostData.@val;
        }

        public function set postData(arg1:String):void
        {
            this._postdata = arg1;
            return;
        }

        public function get messageIdentifier():String
        {
            return this.response.Response.Message.@messageIdentifier;
        }

        public function get serverID():Number
        {
            return Number(this.response.Id.@sid);
        }

        public static const NAME:String="ResponseProxy";

        internal var _url:String;

        internal var _messageType:int=-1;

        internal var _postdata:String;

        internal var _moduleID:Number=-1;

        internal var _clientID:Number=-1;
    }
}


//            class SessionObjectProxy
package mgs.aurora.modules.vpb.model 
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

        public function get sessionID():String
        {
            return getData()[mgs.aurora.common.enums.configMapping.SessionConfig.SESSIONID];
        }

        public function get username():String
        {
            return getData()[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTUSERNAME];
        }

        public function get language():String
        {
            return getData()[mgs.aurora.common.enums.configMapping.SessionConfig.LANGUAGE];
        }

        public function get clientType():String
        {
            return getData()[mgs.aurora.common.enums.configMapping.SessionConfig.CLIENTTYPE];
        }

        public function get currentModuleID():Number
        {
            return Number(getData()[mgs.aurora.common.enums.configMapping.SessionConfig.CURMID]);
        }

        public function get currentClientID():Number
        {
            return Number(getData()[mgs.aurora.common.enums.configMapping.SessionConfig.CURCID]);
        }

        public function get serverID():uint
        {
            return uint(getData()[mgs.aurora.common.enums.configMapping.SessionConfig.SERVERID]);
        }

        public function get userType():uint
        {
            return uint(getData()[mgs.aurora.common.enums.configMapping.SessionConfig.USERTYPE]);
        }

        public function get muted():Boolean
        {
            return Boolean(uint(getData()[mgs.aurora.common.enums.configMapping.SessionConfig.MUTESOUND]));
        }

        public static const NAME:String="SessionObjectProxy";
    }
}


//            class SoundEngineProxy
package mgs.aurora.modules.vpb.model 
{
    import mgs.aurora.common.interfaces.sounds.*;
    import mgs.aurora.modules.vpb.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class SoundEngineProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function SoundEngineProxy(arg1:mgs.aurora.common.interfaces.sounds.ISounds)
        {
            super(NAME, arg1);
            return;
        }

        internal function get soundEngine():mgs.aurora.common.interfaces.sounds.ISounds
        {
            return mgs.aurora.common.interfaces.sounds.ISounds(getData());
        }

        public function add(arg1:Array):void
        {
            var loc1:*=facade.retrieveMediator(mgs.aurora.modules.vpb.view.PopupMediator.NAME) as mgs.aurora.modules.vpb.view.PopupMediator;
            this.soundEngine.add(loc1.lib, arg1, SOUND_GROUP_ID);
            return;
        }

        public function play(arg1:String):void
        {
            this.soundEngine.play(arg1, SOUND_GROUP_ID);
            return;
        }

        internal static const SOUND_GROUP_ID:String="SystemSounds/VPB";

        public static const NAME:String="SoundEngineProxy";
    }
}


//            class TimerConfig
package mgs.aurora.modules.vpb.model 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    
    public class TimerConfig extends flash.events.EventDispatcher
    {
        public function TimerConfig(arg1:String, arg2:Number)
        {
            super();
            this._id = arg1;
            this._duration = arg2;
            return;
        }

        public function get duration():Number
        {
            return this._duration;
        }

        public function set duration(arg1:Number):void
        {
            this._duration = arg1;
            return;
        }

        public function get id():String
        {
            return this._id;
        }

        public function set id(arg1:String):void
        {
            this._id = arg1;
            return;
        }

        public function get timer():flash.utils.Timer
        {
            return this._timer;
        }

        public function set timer(arg1:flash.utils.Timer):void
        {
            this._timer = arg1;
            this._timer.addEventListener(flash.events.TimerEvent.TIMER, this.onTimer, false, 0, true);
            return;
        }

        internal function onTimer(arg1:flash.events.TimerEvent):void
        {
            dispatchEvent(new mgs.aurora.modules.vpb.model.timer.IdentifiableTimerEvent(mgs.aurora.modules.vpb.model.timer.IdentifiableTimerEvent.TIMER, this));
            return;
        }

        internal var _duration:Number;

        internal var _id:String;

        internal var _timer:flash.utils.Timer;
    }
}


//            class TimerProxy
package mgs.aurora.modules.vpb.model 
{
    import flash.utils.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class TimerProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function TimerProxy()
        {
            super(NAME, new flash.utils.Dictionary());
            return;
        }

        public function get timers():flash.utils.Dictionary
        {
            return getData() as flash.utils.Dictionary;
        }

        public function addTimer(arg1:mgs.aurora.modules.vpb.model.TimerConfig):Boolean
        {
            var loc1:*=this.timers;
            if (loc1[arg1.id] != null) 
            {
                return false;
            }
            loc1[arg1.id] = arg1;
            arg1.addEventListener(mgs.aurora.modules.vpb.model.timer.IdentifiableTimerEvent.TIMER, this.onTimer, false, 0, true);
            return true;
        }

        public function removeTimer(arg1:String):Boolean
        {
            if (this.timers[arg1]) 
            {
                delete this.timers[arg1];
                return true;
            }
            return false;
        }

        public function startTimer(arg1:String):Boolean
        {
            var loc2:*=null;
            var loc1:*=this.timers[arg1] as mgs.aurora.modules.vpb.model.TimerConfig;
            if (!loc1) 
            {
                return false;
            }
            if (!loc1.timer) 
            {
                loc2 = new flash.utils.Timer(loc1.duration);
                loc1.timer = loc2;
            }
            if (loc1.timer.running) 
            {
                loc1.timer.stop();
                loc1.timer.reset();
                loc1.timer.start();
            }
            else 
            {
                loc1.timer.reset();
                loc1.timer.start();
            }
            return true;
        }

        public function resetTimer(arg1:String):Boolean
        {
            var loc1:*=this.timers[arg1] as mgs.aurora.modules.vpb.model.TimerConfig;
            if (!loc1) 
            {
                return false;
            }
            if (loc1.timer) 
            {
                loc1.timer.stop();
                loc1.timer.reset();
                loc1.timer.start();
                return true;
            }
            return false;
        }

        public function stopTimer(arg1:String):Boolean
        {
            var loc1:*=this.timers[arg1] as mgs.aurora.modules.vpb.model.TimerConfig;
            if (!loc1) 
            {
                return false;
            }
            if (loc1.timer && loc1.timer.running) 
            {
                loc1.timer.stop();
                loc1.timer.reset();
                return true;
            }
            return false;
        }

        public function stopAll():void
        {
            var loc2:*=null;
            var loc1:*=this.timers;
            var loc3:*=0;
            var loc4:*=loc1;
            for (loc2 in loc4) 
            {
                this.stopTimer(loc2);
            }
            return;
        }

        internal function onTimer(arg1:mgs.aurora.modules.vpb.model.timer.IdentifiableTimerEvent):void
        {
            this.stopTimer(arg1.timerConfig.id);
            this.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.TIMER_TIMEDOUT, arg1.timerConfig, arg1.timerConfig.id.toString());
            return;
        }

        public function updateTimerDuration(arg1:String, arg2:Number):Boolean
        {
            var loc1:*=this.timers[arg1] as mgs.aurora.modules.vpb.model.TimerConfig;
            if (!loc1) 
            {
                return false;
            }
            loc1.duration = arg2;
            return true;
        }

        public static const NAME:String="TimerProxy";
    }
}


//            class VPBConfigProxy
package mgs.aurora.modules.vpb.model 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.vpb.*;
    import mgs.aurora.modules.vpb.model.vo.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class VPBConfigProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function VPBConfigProxy(arg1:XML)
        {
            super(NAME, new mgs.aurora.modules.vpb.model.vo.VPBConfigData(arg1));
            return;
        }

        public function set winParameters(arg1:flash.utils.Dictionary):void
        {
            this._winParameters = arg1;
            return;
        }

        public function get config():mgs.aurora.modules.vpb.model.vo.VPBConfigData
        {
            return getData() as mgs.aurora.modules.vpb.model.vo.VPBConfigData;
        }

        public function set frameType(arg1:String):void
        {
            if (!this.config.frameTypes[arg1]) 
            {
                sendNotification(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.ERROR, null, mgs.aurora.common.enums.vpb.VPBErrorTypes.INVALID_FRAME_TYPE_SUPPLIED);
                return;
            }
            this.config.frameType = arg1;
            var loc1:*=this.config.frameTypes[arg1];
            this.config.xPos = loc1.x;
            this.config.yPos = loc1.y;
            return;
        }

        public function get frameType():String
        {
            return this.config.frameType;
        }

        public function get supported():Boolean
        {
            return this.config.supported;
        }

        public function get rmmSupported():Boolean
        {
            return this.config.rmmSupported;
        }

        public function get xPos():Number
        {
            return this.config.xPos;
        }

        public function get yPos():Number
        {
            return this.config.yPos;
        }

        public function get initMessageDelay():Number
        {
            return this.config.initMessageDelay;
        }

        public function get numMessagesRequestDelay():Number
        {
            return this.config.numMessagesRequestDelay;
        }

        public function get nextMessageDelay():Number
        {
            return this.config.nextMessageDelay;
        }

        public function get removeMessageDelay():Number
        {
            return this.config.removeMessageDelay;
        }

        public function get titleFont():String
        {
            return this.config.titleFontSettings.font;
        }

        public function get titleFontSize():Number
        {
            return this.config.titleFontSettings.fontSize;
        }

        public function get titleBold():Boolean
        {
            return this.config.titleFontSettings.bold;
        }

        public function get titleItalic():Boolean
        {
            return this.config.titleFontSettings.italic;
        }

        public function get titleDataFont():String
        {
            return this.config.titleFontSettings.font;
        }

        public function get titleDataFontSize():Number
        {
            return this.config.titleDataFontSettings.fontSize;
        }

        public function get titleDataBold():Boolean
        {
            return this.config.titleDataFontSettings.bold;
        }

        public function get titleDataItalic():Boolean
        {
            return this.config.titleDataFontSettings.italic;
        }

        public function get instructionURLFont():String
        {
            return this.config.instructionURLFontSettings.font;
        }

        public function get instructionURLFontSize():Number
        {
            return this.config.instructionURLFontSettings.fontSize;
        }

        public function get instructionURLBold():Boolean
        {
            return this.config.instructionURLFontSettings.bold;
        }

        public function get instructionURLItalic():Boolean
        {
            return this.config.instructionURLFontSettings.italic;
        }

        public function set enabled(arg1:Boolean):void
        {
            this.config.enabled = arg1;
            return;
        }

        public function get enabled():Boolean
        {
            return this.config.enabled;
        }

        public function set numMessages(arg1:uint):void
        {
            this.config.numMessages = arg1;
            return;
        }

        public function get numMessages():uint
        {
            return this.config.numMessages;
        }

        public function get tweenInDelay():Number
        {
            return this.config.tweenInDelay;
        }

        public function get tweenOutDelay():Number
        {
            return this.config.tweenOutDelay;
        }

        public function get isWaitingForRMMCallback():Boolean
        {
            return this.config.waitingForRMMCallback;
        }

        public function set isWaitingForRMMCallback(arg1:Boolean):void
        {
            this.config.waitingForRMMCallback = arg1;
            return;
        }

        public function get rmmCallbackTimeout():uint
        {
            return this.config.rmmCallbackTimeout;
        }

        public function get rmmDisplayDuration():Number
        {
            return this.config.rmmDisplayDuration;
        }

        public function set rmmDisplayDuration(arg1:Number):void
        {
            this.config.rmmDisplayDuration = arg1;
            return;
        }

        public function get stageWidth():uint
        {
            return this.config.stageWidth;
        }

        public function get stageHeight():uint
        {
            return this.config.stageHeight;
        }

        public function get rmmOffsetRight():uint
        {
            return this.config.rmmOffsetRight;
        }

        public function get rmmOffsetBottom():uint
        {
            return this.config.rmmOffsetBottom;
        }

        public function get rmmToastDisplayTime():uint
        {
            return this.config.rmmToastDisplayTime;
        }

        public function get rmmCenteredDisplayTime():uint
        {
            return this.config.rmmCenteredDisplayTime;
        }

        public function get winParameters():flash.utils.Dictionary
        {
            return this._winParameters;
        }

        public static const NAME:String="VPBConfigProxy";

        internal var _winParameters:flash.utils.Dictionary;
    }
}


//            class XManProxy
package mgs.aurora.modules.vpb.model 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class XManProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function XManProxy(arg1:mgs.aurora.common.interfaces.comms.IXManPacketSender)
        {
            super(NAME, arg1);
            return;
        }

        public function get xman():mgs.aurora.common.interfaces.comms.IXManPacketSender
        {
            return getData() as mgs.aurora.common.interfaces.comms.IXManPacketSender;
        }

        public function sendPacket(arg1:flash.utils.Dictionary):void
        {
            var loc1:*=this.xman;
            this.eventName = arg1[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] as String;
            loc1.addEventListener(this.eventName, this.onPacketReceived);
            loc1.sendPacket(arg1);
            return;
        }

        internal function onPacketReceived(arg1:mgs.aurora.common.events.comms.PacketEvent):void
        {
            facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.PACKET_RECEIVED, arg1.response);
            return;
        }

        public static const NAME:String="XManProxy";

        internal var eventName:String;
    }
}


//          package notifications
//            class VPBExternalInterfaceNotifications
package mgs.aurora.modules.vpb.notifications 
{
    public class VPBExternalInterfaceNotifications extends Object
    {
        public function VPBExternalInterfaceNotifications()
        {
            super();
            return;
        }

        public static const NAME:String="VPBExternalInterfaceNotifications";

        public static const LOAD_RMM_TEMPLATE:String=NAME + "/notes/load_rmm_template";

        public static const RMM_CENTRED_FANFAIR:String=NAME + "/notes/rmm_centered_fanfair";

        public static const RMM_TOAST_RIGHT:String=NAME + "/notes/rmm_toast_right";

        public static const CLOSE_RMM_MESSAGE:String=NAME + "/notes/close_rmm_message";

        public static const FOCUS_RMM_MESSAGE:String=NAME + "/notes/focus_rmm_message";

        public static const INITIALISE_RMM:String=NAME + "/notes/initialise_rmm";
    }
}


//            class VPBInboundNotifications
package mgs.aurora.modules.vpb.notifications 
{
    public class VPBInboundNotifications extends Object
    {
        public function VPBInboundNotifications()
        {
            super();
            return;
        }

        internal static const NAME:String="VPBInboundNotifications";

        public static const SETUP:String=NAME + "/notes/setup";

        public static const ENABLE:String=NAME + "/notes/enable";

        public static const DISABLE:String=NAME + "/notes/disable";

        public static const PACKET_RECEIVED:String=NAME + "/notes/packet_received";

        public static const SET_ART_ASSET:String=NAME + "/notes/set_art_asset";

        public static const SET_DIALOG_PARENT:String=NAME + "/notes/set_dialog_parent";

        public static const SET_FRAME_TYPE:String=NAME + "/notes/set_frame_type";

        public static const GAME_IS_VALID:String=NAME + "/notes/game_is_valid";

        public static const WEB_APP_AVAILABLE:String=NAME + "/notes/web_app_available";

        public static const WEB_APP_WINPARMS:String=NAME + "/notes/web_app_winparms";

        public static const WEB_APP_DETAILS:String=NAME + "/notes/web_app_details";

        public static const RMM_TOAST:String=NAME + "/notes/rmm_toast";

        public static const RMM_TRACKING:String=NAME + "/notes/rmm_tracking";

        public static const RMM_LAUNCH_CHAT_WINDOW:String=NAME + "/notes/rmm_launch_chat_window";

        public static const RMM_LAUNCH_GAME:String=NAME + "/notes/rmm_launch_game";

        public static const RMM_LAUNCH_EXTERNAL_BROWSER:String=NAME + "/notes/rmm_launch_external_browser";

        public static const RMM_LAUNCH_WEB_ECASH:String=NAME + "/notes/rmm_launch_web_ecash";

        public static const RMM_LAUNCH_WEB_ORL:String=NAME + "/notes/rmm_launch_web_orl";

        public static const RMM_LAUNCH_LOYALTY:String=NAME + "/notes/rmm_launch_loyalty";

        public static const RMM_LAUNCH_UTIL:String=NAME + "/notes/rmm_launch_util";

        public static const RMM_BACK_TO_CASINO:String=NAME + "/notes/rmm_back_to_casino";
    }
}


//            class VPBInternalNotifications
package mgs.aurora.modules.vpb.notifications 
{
    public class VPBInternalNotifications extends Object
    {
        public function VPBInternalNotifications()
        {
            super();
            return;
        }

        public static const NAME:String="VPBInternalNotifications";

        public static const STARTUP:String=NAME + "/notes/startup";

        public static const TIMER_TIMEDOUT:String=NAME + "/notes/timer_timeout";

        public static const GET_NEXT_MESSAGE:String=NAME + "/notes/get_next_message";

        public static const GET_NUM_MESSAGES:String=NAME + "/notes/get_num_messages";

        public static const DISPLAY_MESSAGE:String=NAME + "/notes/display_message";

        public static const ANIMATE_MESSAGE_IN:String=NAME + "/notes/animate_message_in";

        public static const HIDE_MESSAGE:String=NAME + "/notes/hide_message";

        public static const ANIMATE_MESSAGE_OUT:String=NAME + "/notes/animate_message_out";

        public static const MESSAGE_CLOSED:String=NAME + "/notes/message_closed";

        public static const REMOVE_MESSAGE_FROM_DISPLAY:String=NAME + "/notes/remove_message_from_display";

        public static const RESTART_PACKET_TIMER:String=NAME + "/notes/restart_packet_timer";

        public static const INITIATE_ACTION:String=NAME + "/notes/initiate_action";

        public static const RMM_CENTRED_FANFAIR_CALLED:String=NAME + "/notes/rmm_centred_fanfair_called";

        public static const RMM_TOAST_RIGHT_CALLED:String=NAME + "/notes/rmm_toast_right_called";

        public static const RMM_CALLBACK_TIMEOUT:String=NAME + "/notes/rmm_callback_timeout";

        public static const COMPLETE_RMM_ACTION:String=NAME + "/notes/complete_rmm_action";

        public static const GET_BALANCE:String=NAME + "/notes/get_balance";
    }
}


//            class VPBOutboundNotifications
package mgs.aurora.modules.vpb.notifications 
{
    public class VPBOutboundNotifications extends Object
    {
        public function VPBOutboundNotifications()
        {
            super();
            return;
        }

        public static const NAME:String="VPBOutboundNotifications";

        public static const ACTION_NOTIFICATION:String=NAME + "/notes/action_notification";

        public static const SEND_PACKET:String=NAME + "/notes/send_packet";

        public static const ERROR:String=NAME + "/notes/error";

        public static const SETUP_COMPLETE:String=NAME + "/notes/setup_complete";

        public static const IS_GAME_VALID:String=NAME + "/notes/is_game_valid";

        public static const IS_WEB_APP_AVAILABLE:String=NAME + "/notes/is_web_app_available";

        public static const REQUEST_WEB_APP_DETAILS:String=NAME + "/notes/request_web_app_details";

        public static const UPDATE_BALANCE:String=NAME + "/notes/update_balance";

        public static const DISPLAY_INVALID_GAME_MESSAGE:String=NAME + "/notes/display_invalid_game_message";

        public static const SWITCH_USER_TYPE:String=NAME + "/notes/switch_user_type";
    }
}


//          package pipes
//            package param
//              class IsGameValidParameters
package mgs.aurora.modules.vpb.pipes.param 
{
    import mgs.aurora.common.interfaces.vpb.*;
    
    public class IsGameValidParameters extends Object implements mgs.aurora.common.interfaces.vpb.IIsGameValidParameters
    {
        public function IsGameValidParameters(arg1:Number, arg2:Number)
        {
            super();
            this._moduleID = arg1;
            this._clientID = arg2;
            return;
        }

        public function get moduleID():Number
        {
            return this._moduleID;
        }

        public function get clientID():Number
        {
            return this._clientID;
        }

        internal var _moduleID:Number;

        internal var _clientID:Number;
    }
}


//          package view
//            class EventBridgeMediator
package mgs.aurora.modules.vpb.view 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.events.vpb.*;
    import mgs.aurora.common.interfaces.vpb.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class EventBridgeMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function EventBridgeMediator(arg1:flash.events.IEventDispatcher)
        {
            super(NAME, arg1);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.ACTION_NOTIFICATION);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.ERROR);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.IS_GAME_VALID);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.IS_WEB_APP_AVAILABLE);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SETUP_COMPLETE);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.UPDATE_BALANCE);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.REQUEST_WEB_APP_DETAILS);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.DISPLAY_INVALID_GAME_MESSAGE);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SWITCH_USER_TYPE);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=NaN;
            var loc3:*=null;
            var loc4:*=arg1.getName();
            switch (loc4) 
            {
                case mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.ACTION_NOTIFICATION:
                {
                    loc1 = new mgs.aurora.common.events.vpb.VPBEvent(mgs.aurora.common.events.vpb.VPBEvent.ACTION_NOTIFICATION);
                    loc1.actionDetails = arg1.getBody() as flash.utils.Dictionary;
                    this.eventDispatcher.dispatchEvent(loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.ERROR:
                {
                    loc1 = new mgs.aurora.common.events.vpb.VPBEvent(mgs.aurora.common.events.vpb.VPBEvent.ERROR);
                    loc1.errorType = arg1.getBody() as String;
                    this.eventDispatcher.dispatchEvent(loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.IS_GAME_VALID:
                {
                    loc1 = new mgs.aurora.common.events.vpb.VPBEvent(mgs.aurora.common.events.vpb.VPBEvent.IS_GAME_VALID);
                    loc1.gameDetails = arg1.getBody() as mgs.aurora.common.interfaces.vpb.IIsGameValidParameters;
                    this.eventDispatcher.dispatchEvent(loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.DISPLAY_INVALID_GAME_MESSAGE:
                {
                    loc1 = new mgs.aurora.common.events.vpb.VPBEvent(mgs.aurora.common.events.vpb.VPBEvent.DISPLAY_INVALID_GAME_MESSAGE);
                    loc1.gameDetails = arg1.getBody() as mgs.aurora.common.interfaces.vpb.IIsGameValidParameters;
                    loc1.errorType = arg1.getType();
                    this.eventDispatcher.dispatchEvent(loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.IS_WEB_APP_AVAILABLE:
                {
                    loc1 = new mgs.aurora.common.events.vpb.VPBEvent(mgs.aurora.common.events.vpb.VPBEvent.IS_WEB_APP_AVAILABLE);
                    loc1.webAppName = arg1.getBody() as String;
                    this.eventDispatcher.dispatchEvent(loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SETUP_COMPLETE:
                {
                    loc1 = new mgs.aurora.common.events.vpb.VPBEvent(mgs.aurora.common.events.vpb.VPBEvent.SETUP_COMPLETE);
                    this.eventDispatcher.dispatchEvent(loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.UPDATE_BALANCE:
                {
                    loc1 = new mgs.aurora.common.events.vpb.VPBEvent(mgs.aurora.common.events.vpb.VPBEvent.UPDATE_BALANCE);
                    loc2 = Number(arg1.getBody());
                    loc1.value = loc2;
                    this.eventDispatcher.dispatchEvent(loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.REQUEST_WEB_APP_DETAILS:
                {
                    loc1 = new mgs.aurora.common.events.vpb.VPBEvent(mgs.aurora.common.events.vpb.VPBEvent.REQUEST_WEB_APP_DETAILS);
                    loc1.value = Number(arg1.getBody());
                    this.eventDispatcher.dispatchEvent(loc1);
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SWITCH_USER_TYPE:
                {
                    loc1 = new mgs.aurora.common.events.vpb.VPBEvent(mgs.aurora.common.events.vpb.VPBEvent.SWITCH_USER_TYPE);
                    loc3 = String(arg1.getBody());
                    loc1.userType = loc3;
                    this.eventDispatcher.dispatchEvent(loc1);
                    break;
                }
            }
            return;
        }

        public function get eventDispatcher():flash.events.IEventDispatcher
        {
            return getViewComponent() as flash.events.IEventDispatcher;
        }

        public static const NAME:String="EventBridgeMediator";
    }
}


//            class ExternalInterfaceMediator
package mgs.aurora.modules.vpb.view 
{
    import flash.external.*;
    import mgs.aurora.modules.vpb.enums.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.model.vo.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class ExternalInterfaceMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function ExternalInterfaceMediator()
        {
            super(NAME, null);
            flash.external.ExternalInterface.addCallback("onIframeLoad", this.onIframeLoad);
            flash.external.ExternalInterface.addCallback("rmmClosed", this.onRMMClosed);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.CLOSE_RMM_MESSAGE);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.FOCUS_RMM_MESSAGE);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.LOAD_RMM_TEMPLATE);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.RMM_CENTRED_FANFAIR);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.RMM_TOAST_RIGHT);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.INITIALISE_RMM);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var notification:org.puremvc.as3.multicore.interfaces.INotification;
            var sounds:mgs.aurora.modules.vpb.model.SoundEngineProxy;
            var loadParams:mgs.aurora.modules.vpb.model.vo.LoadRMMTemplateParams;
            var session:mgs.aurora.modules.vpb.model.SessionObjectProxy;
            var fanfairParams:mgs.aurora.modules.vpb.model.vo.RMMToastParams;
            var delay:Number;
            var toastParams:mgs.aurora.modules.vpb.model.vo.RMMToastParams;
            var delay2:Number;

            var loc1:*;
            sounds = null;
            loadParams = null;
            session = null;
            fanfairParams = null;
            delay = NaN;
            toastParams = null;
            delay2 = NaN;
            notification = arg1;
            var loc2:*=notification.getName();
            switch (loc2) 
            {
                case mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.INITIALISE_RMM:
                {
                    flash.external.ExternalInterface.call("initRMM", notification.getBody());
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.CLOSE_RMM_MESSAGE:
                {
                    flash.external.ExternalInterface.call("closeRMMessage");
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.FOCUS_RMM_MESSAGE:
                {
                    flash.external.ExternalInterface.call("focusRMMessage");
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.LOAD_RMM_TEMPLATE:
                {
                    loadParams = notification.getBody() as mgs.aurora.modules.vpb.model.vo.LoadRMMTemplateParams;
                    session = facade.retrieveProxy(mgs.aurora.modules.vpb.model.SessionObjectProxy.NAME) as mgs.aurora.modules.vpb.model.SessionObjectProxy;
                    if (flash.external.ExternalInterface.available) 
                    {
                        try 
                        {
                            flash.external.ExternalInterface.call("loadRMMTemplate", loadParams.connectionID, loadParams.sid, loadParams.login, loadParams.messageIdentifier, loadParams.userLang, loadParams.clientType, session.muted, loadParams.userType);
                        }
                        catch (error:Error)
                        {
                        };
                    }
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.RMM_CENTRED_FANFAIR:
                {
                    sounds = facade.retrieveProxy(mgs.aurora.modules.vpb.model.SoundEngineProxy.NAME) as mgs.aurora.modules.vpb.model.SoundEngineProxy;
                    fanfairParams = notification.getBody() as mgs.aurora.modules.vpb.model.vo.RMMToastParams;
                    sounds.play(mgs.aurora.modules.vpb.enums.VPBSounds.DISPLAY_RMM_MESSAGE);
                    delay = flash.external.ExternalInterface.call("RMMCentredFanfair", fanfairParams.width, fanfairParams.height);
                    facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RMM_CENTRED_FANFAIR_CALLED, delay);
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBExternalInterfaceNotifications.RMM_TOAST_RIGHT:
                {
                    sounds = facade.retrieveProxy(mgs.aurora.modules.vpb.model.SoundEngineProxy.NAME) as mgs.aurora.modules.vpb.model.SoundEngineProxy;
                    toastParams = notification.getBody() as mgs.aurora.modules.vpb.model.vo.RMMToastParams;
                    sounds.play(mgs.aurora.modules.vpb.enums.VPBSounds.DISPLAY_RMM_MESSAGE);
                    delay2 = flash.external.ExternalInterface.call("RMMToastFromRight", toastParams.width, toastParams.height);
                    facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RMM_TOAST_RIGHT_CALLED, delay2);
                    break;
                }
            }
            return;
        }

        internal function onIframeLoad():void
        {
            var loc2:*=null;
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            if (loc1.isWaitingForRMMCallback) 
            {
                loc2 = facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
                loc2.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_METHOD_CALL);
            }
            return;
        }

        internal function onRMMClosed():void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            loc1.startTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.RMM_AFTER_CLOSED_DELAY_TIMER);
            return;
        }

        public static const NAME:String="ExternalInterfaceMediator";
    }
}


//            class PopupMediator
package mgs.aurora.modules.vpb.view 
{
    import fl.transitions.*;
    import fl.transitions.easing.*;
    import flash.display.*;
    import flash.events.*;
    import flash.text.*;
    import mgs.aurora.modules.vpb.model.*;
    import mgs.aurora.modules.vpb.model.message.*;
    import mgs.aurora.modules.vpb.model.timer.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class PopupMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function PopupMediator()
        {
            super(NAME, null);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.ANIMATE_MESSAGE_IN);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.ANIMATE_MESSAGE_OUT);
            loc1.push(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.REMOVE_MESSAGE_FROM_DISPLAY);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getName();
            switch (loc1) 
            {
                case mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.ANIMATE_MESSAGE_IN:
                {
                    if (this._popup) 
                    {
                        this.removePopup();
                    }
                    this.setupPopup(arg1.getBody() as mgs.aurora.modules.vpb.model.message.MessageContents);
                    this.tweenPopupIn();
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.ANIMATE_MESSAGE_OUT:
                {
                    if (this._popup) 
                    {
                        this.tweenPopupOut(this.onTweenPopupOut_TimerExpired);
                    }
                    break;
                }
                case mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.REMOVE_MESSAGE_FROM_DISPLAY:
                {
                    this.removePopup();
                    break;
                }
                default:
                {
                    super.handleNotification(arg1);
                }
            }
            return;
        }

        internal function onTweenPopupOut_TimerExpired(arg1:fl.transitions.TweenEvent):void
        {
            this.removePopup();
            return;
        }

        internal function get parent():flash.display.DisplayObjectContainer
        {
            return getViewComponent() as flash.display.DisplayObjectContainer;
        }

        public function set lib(arg1:flash.display.LoaderInfo):void
        {
            this._loaderInfo = arg1;
            return;
        }

        public function get lib():flash.display.LoaderInfo
        {
            return this._loaderInfo;
        }

        internal function setupPopup(arg1:mgs.aurora.modules.vpb.model.message.MessageContents):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            var loc2:*=this._loaderInfo.applicationDomain.getDefinition("EventMessageBoxAsset") as Class;
            this._popup = new loc2() as flash.display.DisplayObjectContainer;
            this._popup.x = loc1.xPos;
            this._popup.y = loc1.yPos;
            var loc3:*;
            (loc3 = this._popup.getChildByName("messageBox") as flash.display.MovieClip).useHandCursor = true;
            loc3.mask = this._popup.getChildByName("messageBoxMask");
            var loc4:*=loc3.getChildByName("title") as flash.text.TextField;
            var loc5:*=loc3.getChildByName("titleData") as flash.text.TextField;
            var loc6:*=loc3.getChildByName("instructionURLBtn") as flash.display.MovieClip;
            this.setupTitle(arg1, loc4, loc1);
            this.setupTitleData(arg1, loc5, loc1);
            this.setupURL(arg1, loc6, loc1);
            this.parent.addChild(this._popup);
            return;
        }

        internal function setupCloseButton(arg1:flash.display.MovieClip):void
        {
            arg1.addEventListener(flash.events.MouseEvent.CLICK, this.onCloseBtnClicked, false, 0, true);
            arg1.buttonMode = true;
            return;
        }

        internal function setupURLButton(arg1:flash.display.MovieClip):void
        {
            arg1.addEventListener(flash.events.MouseEvent.CLICK, this.hyperlinkClicked);
            arg1.buttonMode = true;
            arg1.useHandCursor = true;
            arg1.mouseChildren = false;
            return;
        }

        internal function setupTitle(arg1:mgs.aurora.modules.vpb.model.message.MessageContents, arg2:flash.text.TextField, arg3:mgs.aurora.modules.vpb.model.VPBConfigProxy):void
        {
            arg2.text = arg1.title;
            var loc1:*=new flash.text.TextFormat(arg3.titleFont, arg3.titleFontSize, null, arg3.titleBold, arg3.titleItalic);
            arg2.setTextFormat(loc1);
            return;
        }

        internal function setupTitleData(arg1:mgs.aurora.modules.vpb.model.message.MessageContents, arg2:flash.text.TextField, arg3:mgs.aurora.modules.vpb.model.VPBConfigProxy):void
        {
            arg2.text = arg1.body;
            arg2.multiline = true;
            arg2.wordWrap = true;
            var loc1:*=new flash.text.TextFormat(arg3.titleDataFont, arg3.titleDataFontSize, null, arg3.titleDataBold, arg3.titleDataItalic);
            arg2.setTextFormat(loc1);
            arg2.autoSize = flash.text.TextFieldAutoSize.CENTER;
            return;
        }

        internal function setupURL(arg1:mgs.aurora.modules.vpb.model.message.MessageContents, arg2:flash.display.MovieClip, arg3:mgs.aurora.modules.vpb.model.VPBConfigProxy):void
        {
            var loc1:*;
            (loc1 = arg2.getChildByName("instructionURL") as flash.text.TextField).text = arg1.hyperlink;
            var loc2:*;
            (loc2 = new flash.text.TextFormat(arg3.instructionURLFont, arg3.instructionURLFontSize, null, arg3.instructionURLBold, arg3.instructionURLItalic)).underline = true;
            loc1.setTextFormat(loc2);
            loc1.autoSize = flash.text.TextFieldAutoSize.CENTER;
            return;
        }

        internal function hyperlinkClicked(arg1:flash.events.MouseEvent):void
        {
            this.removePopup();
            sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.INITIATE_ACTION);
            return;
        }

        internal function onCloseBtnClicked(arg1:flash.events.MouseEvent):void
        {
            var loc1:*=(this._popup.getChildByName("messageBox") as flash.display.MovieClip).getChildByName("closeBtn") as flash.display.MovieClip;
            loc1.removeEventListener(flash.events.MouseEvent.CLICK, this.onCloseBtnClicked);
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.vpb.model.TimerProxy.NAME) as mgs.aurora.modules.vpb.model.TimerProxy;
            loc2.stopTimer(mgs.aurora.modules.vpb.model.timer.TimerNames.REMOVE_MESSAGE_DELAY);
            this.removePopup();
            facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RESTART_PACKET_TIMER);
            return;
        }

        internal function tweenPopupIn():void
        {
            var loc1:*=this._popup.getChildByName("messageBox");
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            this.currentTween = new fl.transitions.Tween(loc1, "y", fl.transitions.easing.None.easeIn, loc1.y, loc1.y - loc1.height, loc2.tweenInDelay, true);
            this.currentTween.addEventListener(fl.transitions.TweenEvent.MOTION_FINISH, this.tweenInComplete, false, 0, true);
            return;
        }

        internal function tweenInComplete(arg1:fl.transitions.TweenEvent):void
        {
            var loc1:*=this._popup.getChildByName("messageBox") as flash.display.MovieClip;
            var loc2:*=loc1.getChildByName("closeBtn") as flash.display.MovieClip;
            var loc3:*=loc1.getChildByName("instructionURLBtn") as flash.display.MovieClip;
            this.setupCloseButton(loc2);
            this.setupURLButton(loc3);
            return;
        }

        internal function tweenPopupOut(arg1:Function=null):void
        {
            var loc1:*=this._popup.getChildByName("messageBox");
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.vpb.model.VPBConfigProxy.NAME) as mgs.aurora.modules.vpb.model.VPBConfigProxy;
            this.currentTween = new fl.transitions.Tween(loc1, "y", fl.transitions.easing.None.easeOut, loc1.y, loc1.y + loc1.height, loc2.tweenOutDelay, true);
            if (arg1 != null) 
            {
                this.currentTween.addEventListener(fl.transitions.TweenEvent.MOTION_FINISH, arg1, false, 0, true);
            }
            return;
        }

        public function removePopup():void
        {
            if (this.currentTween) 
            {
                this.currentTween.stop();
            }
            if (this._popup) 
            {
                this.parent.removeChild(this._popup);
                this._popup = null;
            }
            return;
        }

        public static const NAME:String="PopupMediator";

        internal var _loaderInfo:flash.display.LoaderInfo;

        internal var _popup:flash.display.DisplayObjectContainer;

        internal var currentTween:fl.transitions.Tween;
    }
}


//          class VPB
package mgs.aurora.modules.vpb 
{
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.common.interfaces.sounds.*;
    import mgs.aurora.common.interfaces.vpb.*;
    import mgs.aurora.modules.vpb.model.vo.*;
    import mgs.aurora.modules.vpb.notifications.*;
    
    public class VPB extends flash.display.Sprite implements mgs.aurora.common.interfaces.vpb.IVPB
    {
        public function VPB()
        {
            super();
            if (stage) 
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
            removeEventListener(flash.events.Event.ADDED_TO_STAGE, this.init);
            this._facade = mgs.aurora.modules.vpb.VPBFacade.getInstance(VPB.FACADE_ID);
            this._facade.startup(this);
            return;
        }

        internal function dispose(arg1:flash.events.Event=null):void
        {
            return;
        }

        public function disable():void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.DISABLE);
            return;
        }

        public function enable():void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.ENABLE);
            return;
        }

        public function gameIsValid(arg1:Boolean):void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.GAME_IS_VALID, arg1);
            return;
        }

        public function setArtAsset(arg1:flash.display.LoaderInfo):void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.SET_ART_ASSET, arg1);
            return;
        }

        public function setDialogParent(arg1:flash.display.DisplayObjectContainer):void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.SET_DIALOG_PARENT, arg1);
            return;
        }

        public function setFrameType(arg1:String):void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.SET_FRAME_TYPE, arg1);
            return;
        }

        public function setup(arg1:XML, arg2:mgs.aurora.common.interfaces.comms.IXManPacketSender, arg3:Object, arg4:mgs.aurora.common.interfaces.sounds.ISounds, arg5:flash.utils.Dictionary):void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.SETUP, new mgs.aurora.modules.vpb.model.vo.SetupParams(arg1, arg2, arg3, arg4, arg5));
            return;
        }

        public function webAppAvailable(arg1:Boolean):void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.WEB_APP_AVAILABLE, arg1);
            return;
        }

        public function webAppLaunchDetails(arg1:flash.utils.Dictionary):void
        {
            this._facade.sendNotification(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.WEB_APP_DETAILS, arg1);
            return;
        }

        internal static const NAME:String="VPB";

        internal static const FACADE_ID:String=NAME + "/facade";

        internal var _facade:mgs.aurora.modules.vpb.VPBFacade;
    }
}


//          class VPBFacade
package mgs.aurora.modules.vpb 
{
    import flash.events.*;
    import mgs.aurora.modules.vpb.controller.*;
    import mgs.aurora.modules.vpb.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class VPBFacade extends org.puremvc.as3.multicore.patterns.facade.Facade implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function VPBFacade(arg1:String)
        {
            super(arg1);
            return;
        }

        public function startup(arg1:flash.events.IEventDispatcher):void
        {
            this.sendNotification(mgs.aurora.modules.vpb.VPBFacade.STARTUP, arg1);
            this.removeCommand(mgs.aurora.modules.vpb.VPBFacade.STARTUP);
            return;
        }

        protected override function initializeController():void
        {
            super.initializeController();
            this.registerCommand(mgs.aurora.modules.vpb.VPBFacade.STARTUP, mgs.aurora.modules.vpb.controller.StartupCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.SETUP, mgs.aurora.modules.vpb.controller.SetupCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.SET_ART_ASSET, mgs.aurora.modules.vpb.controller.SetArtCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.SET_DIALOG_PARENT, mgs.aurora.modules.vpb.controller.SetDialogParentCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.DISABLE, mgs.aurora.modules.vpb.controller.DisableCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.ENABLE, mgs.aurora.modules.vpb.controller.EnableCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.PACKET_RECEIVED, mgs.aurora.modules.vpb.controller.PacketReceivedCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.SET_FRAME_TYPE, mgs.aurora.modules.vpb.controller.SetFrameTypeCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.GAME_IS_VALID, mgs.aurora.modules.vpb.controller.HandleGameValidCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.WEB_APP_AVAILABLE, mgs.aurora.modules.vpb.controller.HandleWebAppAvailableCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.WEB_APP_DETAILS, mgs.aurora.modules.vpb.controller.HandleWebAppDetailsReceivedCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.RMM_TOAST, mgs.aurora.modules.vpb.controller.RMMToastCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInboundNotifications.RMM_TRACKING, mgs.aurora.modules.vpb.controller.RMMTrackingCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.INITIATE_ACTION, mgs.aurora.modules.vpb.controller.SendActionNotificationCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.GET_NEXT_MESSAGE, mgs.aurora.modules.vpb.controller.GetNextMessageCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.GET_NUM_MESSAGES, mgs.aurora.modules.vpb.controller.GetNumMessagesCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.DISPLAY_MESSAGE, mgs.aurora.modules.vpb.controller.DisplayMessageCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.HIDE_MESSAGE, mgs.aurora.modules.vpb.controller.HideMessageCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.TIMER_TIMEDOUT, mgs.aurora.modules.vpb.controller.TimerCompleteCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RESTART_PACKET_TIMER, mgs.aurora.modules.vpb.controller.RestartPacketTimerCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RMM_CALLBACK_TIMEOUT, mgs.aurora.modules.vpb.controller.RMMCallbackTimeoutCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RMM_CENTRED_FANFAIR_CALLED, mgs.aurora.modules.vpb.controller.RMMDisplayTimerCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.RMM_TOAST_RIGHT_CALLED, mgs.aurora.modules.vpb.controller.RMMDisplayTimerCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.COMPLETE_RMM_ACTION, mgs.aurora.modules.vpb.controller.CompleteRMMActionCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBInternalNotifications.GET_BALANCE, mgs.aurora.modules.vpb.controller.GetBalanceCommand);
            this.registerCommand(mgs.aurora.modules.vpb.notifications.VPBOutboundNotifications.SEND_PACKET, mgs.aurora.modules.vpb.controller.SendPacketCommand);
            return;
        }

        public static function getInstance(arg1:String):mgs.aurora.modules.vpb.VPBFacade
        {
            if (mgs.aurora.modules.vpb.VPBFacade._instance == null) 
            {
                mgs.aurora.modules.vpb.VPBFacade._instance = new VPBFacade(arg1);
            }
            return mgs.aurora.modules.vpb.VPBFacade._instance;
        }

        public static const NAME:String="VPBFacade";

        public static const STARTUP:String=NAME + "/notes/startup";

        internal static var _instance:mgs.aurora.modules.vpb.VPBFacade;
    }
}


