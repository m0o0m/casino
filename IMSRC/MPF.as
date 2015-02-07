//ActionScript 3.0
//  package mgs
//    package aurora
//      package modules
//        package mpf
//          package controller
//            package avatar
//              class AvatarMetaDataReceivedCommand
package mgs.aurora.modules.mpf.controller.avatar 
{
    import __AS3__.vec.*;
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.common.vo.multiplayer.*;
    import mgs.aurora.modules.mpf.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class AvatarMetaDataReceivedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function AvatarMetaDataReceivedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc5:*=null;
            var loc1:*=String(arg1.getBody());
            if (loc1 == "") 
            {
                Debugger.trace("AvatarMetaDataReceivedCommand Empty Resp", mgs.aurora.modules.mpf.MPFFacade.NAME);
                sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.FETCH_AVATAR_METADATA, "0");
                return;
            }
            var loc2:*=new Vector.<mgs.aurora.common.vo.multiplayer.AvatarMetaData>();
            var loc3:*=loc1.split(",");
            var loc4:*=0;
            while (loc4 < loc3.length) 
            {
                loc5 = loc3[loc4].split("|");
                loc2.push(new mgs.aurora.common.vo.multiplayer.AvatarMetaData(String(loc5[0]), String(loc5[1]), String(loc5[2]), String(loc5[3])));
                ++loc4;
            }
            facade.sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.AVATAR_META_DATA_RECEIVED, new mgs.aurora.common.events.multiplayer.MPFAvatarEvent(mgs.aurora.common.events.multiplayer.MPFAvatarEvent.AVATAR_METADATA_RECEIVED, null, loc2));
            return;
        }
    }
}


//              class CancelAvatarCommand
package mgs.aurora.modules.mpf.controller.avatar 
{
    import flash.events.*;
    import flash.net.*;
    import mgs.aurora.modules.mpf.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class CancelAvatarCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function CancelAvatarCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.mpf.model.ConfigProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.ConfigProxy.NAME));
            var loc2:*=new flash.net.URLVariables();
            loc2.aliasID = arg1.getBody();
            var loc3:*;
            (loc3 = new flash.net.URLRequest(loc1.cancelURL)).method = flash.net.URLRequestMethod.POST;
            loc3.data = loc2;
            var loc4:*;
            (loc4 = new flash.net.URLLoader()).addEventListener(flash.events.HTTPStatusEvent.HTTP_STATUS, this.onHTTPStatus);
            loc4.addEventListener(flash.events.Event.COMPLETE, this.onComplete);
            loc4.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onError);
            loc4.addEventListener(flash.events.SecurityErrorEvent.SECURITY_ERROR, this.onError);
            loc4.load(loc3);
            return;
        }

        internal function onError(arg1:flash.events.TextEvent):void
        {
            return;
        }

        internal function onComplete(arg1:flash.events.Event):void
        {
            return;
        }

        internal function onHTTPStatus(arg1:flash.events.HTTPStatusEvent):void
        {
            return;
        }
    }
}


//              class FetchAvatarMetadataCommand
package mgs.aurora.modules.mpf.controller.avatar 
{
    import mgs.aurora.modules.mpf.*;
    import mgs.aurora.modules.mpf.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class FetchAvatarMetadataCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function FetchAvatarMetadataCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.mpf.model.ConfigProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.ConfigProxy.NAME));
            var loc2:*=String(arg1.getBody());
            Debugger.trace("FetchAvatarMetadataCommand : " + loc2 + " : " + loc1.fetchMetaDataURL, mgs.aurora.modules.mpf.MPFFacade.NAME);
            var loc3:*;
            (loc3 = mgs.aurora.modules.mpf.model.FetchRequestProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.FetchRequestProxy.NAME))).fetch(loc1.fetchMetaDataURL, loc2);
            return;
        }
    }
}


//              class LoadAvatarCommand
package mgs.aurora.modules.mpf.controller.avatar 
{
    import mgs.aurora.modules.mpf.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class LoadAvatarCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function LoadAvatarCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.mpf.model.AvatarLoaderProxy.NAME) as mgs.aurora.modules.mpf.model.AvatarLoaderProxy;
            loc1.load(arg1.getBody() as String);
            return;
        }
    }
}


//            package startup
//              class PrepModelCommand
package mgs.aurora.modules.mpf.controller.startup 
{
    import mgs.aurora.modules.mpf.model.*;
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
            facade.registerProxy(new mgs.aurora.modules.mpf.model.AvatarLoaderProxy());
            facade.registerProxy(new mgs.aurora.modules.mpf.model.FetchRequestProxy());
            facade.registerProxy(new mgs.aurora.modules.mpf.model.StatusProxy());
            return;
        }
    }
}


//              class PrepNotificationsCommand
package mgs.aurora.modules.mpf.controller.startup 
{
    import mgs.aurora.modules.mpf.controller.*;
    import mgs.aurora.modules.mpf.controller.avatar.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class PrepNotificationsCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function PrepNotificationsCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            this.setupInboundNotifications();
            this.setupInternalNotifications();
            return;
        }

        internal function setupInboundNotifications():void
        {
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InboundNotifications.SETUP, mgs.aurora.modules.mpf.controller.SetupCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InboundNotifications.ATTEMPT_CONNECTIONS, mgs.aurora.modules.mpf.controller.AttemptConnectionsCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InboundNotifications.ATTEMPT_LOBBY_CONNECTION, mgs.aurora.modules.mpf.controller.AttemptLobbyConnectionCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InboundNotifications.ATTEMPT_ROUTER_CONNECTION, mgs.aurora.modules.mpf.controller.AttemptRouterConnectionCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InboundNotifications.SEND_PACKET, mgs.aurora.modules.mpf.controller.SendPacketCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InboundNotifications.LOAD_AVATAR, mgs.aurora.modules.mpf.controller.avatar.LoadAvatarCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InboundNotifications.CANCEL_AVATAR, mgs.aurora.modules.mpf.controller.avatar.CancelAvatarCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InboundNotifications.FETCH_AVATAR_METADATA, mgs.aurora.modules.mpf.controller.avatar.FetchAvatarMetadataCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InboundNotifications.CLOSE_CONNECTIONS, mgs.aurora.modules.mpf.controller.CloseConnectionCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InboundNotifications.ATTEMPT_REGISTRATION, mgs.aurora.modules.mpf.controller.AttemptRegistrationCommand);
            return;
        }

        internal function setupInternalNotifications():void
        {
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InternalNotifications.DO_ROUTER_LOGIN, mgs.aurora.modules.mpf.controller.RouterLoginCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InternalNotifications.AVATAR_META_DATA_RECEIVED, mgs.aurora.modules.mpf.controller.avatar.AvatarMetaDataReceivedCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InternalNotifications.PROCESS_RESPONSE, mgs.aurora.modules.mpf.controller.ProcessResponsePacketCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InternalNotifications.CHECK_DISPLAY_NOTIFICATION_ALLOWED, mgs.aurora.modules.mpf.controller.CheckNotificationAllowedCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InternalNotifications.REQUEST_REGISTRATION_STATUS, mgs.aurora.modules.mpf.controller.RequestRegistrationStatusCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InternalNotifications.PROCESS_REGISTRATION_STATUS, mgs.aurora.modules.mpf.controller.ProcessRegistrationStatusCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InternalNotifications.REQUEST_REGISTRATION, mgs.aurora.modules.mpf.controller.RequestRegistrationCommand);
            facade.registerCommand(mgs.aurora.modules.mpf.notifications.InternalNotifications.PROCESS_REGISTRATION, mgs.aurora.modules.mpf.controller.ProcessRegistrationCommand);
            return;
        }
    }
}


//              class PrepViewCommand
package mgs.aurora.modules.mpf.controller.startup 
{
    import flash.events.*;
    import mgs.aurora.modules.mpf.view.*;
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
            facade.registerMediator(new mgs.aurora.modules.mpf.view.EventBridgeMediator(arg1.getBody() as flash.events.IEventDispatcher));
            return;
        }
    }
}


//              class StartupCommand
package mgs.aurora.modules.mpf.controller.startup 
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
            addSubCommand(mgs.aurora.modules.mpf.controller.startup.PrepNotificationsCommand);
            addSubCommand(mgs.aurora.modules.mpf.controller.startup.PrepViewCommand);
            addSubCommand(mgs.aurora.modules.mpf.controller.startup.PrepModelCommand);
            return;
        }
    }
}


//            class AttemptConnectionsCommand
package mgs.aurora.modules.mpf.controller 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class AttemptConnectionsCommand extends org.puremvc.as3.multicore.patterns.command.MacroCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function AttemptConnectionsCommand()
        {
            super();
            return;
        }

        protected override function initializeMacroCommand():void
        {
            super.initializeMacroCommand();
            this.addSubCommand(mgs.aurora.modules.mpf.controller.AttemptRouterConnectionCommand);
            this.addSubCommand(mgs.aurora.modules.mpf.controller.AttemptLobbyConnectionCommand);
            return;
        }
    }
}


//            class AttemptLobbyConnectionCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.common.enums.magneto.*;
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class AttemptLobbyConnectionCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function AttemptLobbyConnectionCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=mgs.aurora.modules.mpf.model.MagnetoProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.MagnetoProxy.NAME));
            if (loc1.lobbyConnected) 
            {
                loc2 = new mgs.aurora.common.events.multiplayer.MPFConnectionEvent(mgs.aurora.common.events.multiplayer.MPFConnectionEvent.SOCKET_CONNECTED, mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_LOBBY);
                sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.CONNECTION_ESTABLISHED, loc2);
                return;
            }
            loc1.connect(mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_LOBBY);
            return;
        }
    }
}


//            class AttemptRegistrationCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.common.enums.magneto.*;
    import mgs.aurora.modules.mpf.enums.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.model.vo.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class AttemptRegistrationCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function AttemptRegistrationCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME) as mgs.aurora.modules.mpf.model.SessionObjectProxy;
            if (loc1.userType != 0) 
            {
                sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.DISPLAY_REGISTER_ERROR_DIALOGUE, "11");
                return;
            }
            mgs.aurora.modules.mpf.model.StatusProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StatusProxy.NAME)).systemRegistration = true;
            XML.ignoreWhitespace = true;
            XML.prettyIndent = 0;
            XML.prettyPrinting = false;
            loc2 = new XML("<P>" + ("<Cmd cmdID=\"" + mgs.aurora.modules.mpf.enums.MPFCommandIDs.SERVICE_REQUEST + "\" casinoID=\"" + loc1.serverID + "\" clientType=\"" + loc1.clientType + "\" tourID=\"" + loc1.curTournamentID + "\"/>") + "</P>");
            sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.SEND_PACKET, new mgs.aurora.modules.mpf.model.vo.SendPacketParams(mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER, mgs.aurora.modules.mpf.enums.MPFToFromID.MAIN_LOBBY, loc2));
            return;
        }
    }
}


//            class AttemptRouterConnectionCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.common.enums.magneto.*;
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class AttemptRouterConnectionCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function AttemptRouterConnectionCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=mgs.aurora.modules.mpf.model.MagnetoProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.MagnetoProxy.NAME));
            if (loc1.routerConnected) 
            {
                loc2 = new mgs.aurora.common.events.multiplayer.MPFConnectionEvent(mgs.aurora.common.events.multiplayer.MPFConnectionEvent.SOCKET_CONNECTED, mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER);
                sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.CONNECTION_ESTABLISHED, loc2);
                return;
            }
            loc1.connect(mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER);
            return;
        }
    }
}


//            class CheckNotificationAllowedCommand
package mgs.aurora.modules.mpf.controller 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class CheckNotificationAllowedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function CheckNotificationAllowedCommand()
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


//            class CloseConnectionCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.common.enums.magneto.*;
    import mgs.aurora.modules.mpf.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class CloseConnectionCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function CloseConnectionCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var notification:org.puremvc.as3.multicore.interfaces.INotification;
            var magneto:mgs.aurora.modules.mpf.model.MagnetoProxy;

            var loc1:*;
            notification = arg1;
            magneto = mgs.aurora.modules.mpf.model.MagnetoProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.MagnetoProxy.NAME));
            Debugger.trace("Close Connection :: " + magneto.lobbyConnected + " ; " + magneto.routerConnected, "SYSTEM - NEO");
            try 
            {
                if (magneto.lobbyConnected) 
                {
                    magneto.close(mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_LOBBY);
                }
                if (magneto.routerConnected) 
                {
                    magneto.close(mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER);
                }
            }
            catch (e:Error)
            {
            };
            return;
        }
    }
}


//            class ProcessRegistrationCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.modules.mpf.enums.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.model.vo.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ProcessRegistrationCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ProcessRegistrationCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc4:*=null;
            var loc1:*=mgs.aurora.modules.mpf.model.vo.ProcessResponseParams(arg1.getBody());
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME) as mgs.aurora.modules.mpf.model.SessionObjectProxy;
            var loc3:*;
            if ((loc3 = loc1.data.Resp.@status) == mgs.aurora.modules.mpf.enums.MPFRegistrationStatus.SUCCESS || loc3 == mgs.aurora.modules.mpf.enums.MPFRegistrationStatus.REGISTERED) 
            {
                mgs.aurora.modules.mpf.model.StatusProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StatusProxy.NAME)).systemRegistration = false;
                sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_REGISTERED_SUCCESSFUL, new mgs.aurora.common.events.multiplayer.MPFPacketEvent(mgs.aurora.common.events.multiplayer.MPFPacketEvent.REGISTRATION_SUCCESSFUL, loc2.serviceID, loc1.data));
            }
            else 
            {
                loc4 = loc1.data.Resp.@status.toString();
                sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.DISPLAY_REGISTER_ERROR_DIALOGUE, loc4);
            }
            return;
        }
    }
}


//            class ProcessRegistrationStatusCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.modules.mpf.enums.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.model.vo.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ProcessRegistrationStatusCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ProcessRegistrationStatusCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc4:*=null;
            var loc1:*=mgs.aurora.modules.mpf.model.vo.ProcessResponseParams(arg1.getBody());
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME) as mgs.aurora.modules.mpf.model.SessionObjectProxy;
            var loc3:*;
            if ((loc3 = loc1.data.Resp.@status) != mgs.aurora.modules.mpf.enums.MPFRegistrationStatus.SUCCESS) 
            {
                if (loc3 != mgs.aurora.modules.mpf.enums.MPFRegistrationStatus.REGISTERED) 
                {
                    loc4 = loc1.data.Resp.@status.toString();
                    sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.DISPLAY_REGISTER_ERROR_DIALOGUE, loc4);
                }
                else 
                {
                    mgs.aurora.modules.mpf.model.StatusProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StatusProxy.NAME)).systemRegistration = false;
                    sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_REGISTERED_SUCCESSFUL, new mgs.aurora.common.events.multiplayer.MPFPacketEvent(mgs.aurora.common.events.multiplayer.MPFPacketEvent.REGISTRATION_SUCCESSFUL, loc2.serviceID, loc1.data));
                }
            }
            else 
            {
                sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.DISPLAY_REGISTER_DIALOGUE, loc1.data);
            }
            return;
        }
    }
}


//            class ProcessResponsePacketCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.common.enums.magneto.*;
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.modules.mpf.enums.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.model.vo.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ProcessResponsePacketCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ProcessResponsePacketCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc3:*=null;
            var loc1:*=mgs.aurora.modules.mpf.model.vo.ProcessResponseParams(arg1.getBody());
            var loc2:*=mgs.aurora.modules.mpf.model.StatusProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StatusProxy.NAME));
            Debugger.trace("ProcessResponsePacketCommand - " + loc1.data.toXMLString(), "SYSTEM - MPF");
            if (loc1.socketID == mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER && loc1.data.Cmd.@cmdID.toString() == mgs.aurora.modules.mpf.enums.MPFCommandIDs.FORCED_LOGOUT) 
            {
                mgs.aurora.modules.mpf.model.StatusProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StatusProxy.NAME)).loggedIn = false;
                sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_NOTIFICATION, new mgs.aurora.common.events.multiplayer.MPFNotificationEvent(mgs.aurora.common.events.multiplayer.MPFNotificationEvent.FORCE_LOGOUT, loc1.socketID, loc1.data));
                return;
            }
            if (loc1.socketID == mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER && loc1.data.Cmd.@cmdID.toString() == mgs.aurora.modules.mpf.enums.MPFCommandIDs.TOURNAMENT_IN_PROGRESS) 
            {
                sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_NOTIFICATION, new mgs.aurora.common.events.multiplayer.MPFNotificationEvent(mgs.aurora.common.events.multiplayer.MPFNotificationEvent.TOURNAMENT_IN_PROGRESS, loc1.socketID, loc1.data));
                sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.CHECK_DISPLAY_NOTIFICATION_ALLOWED, loc1.data);
            }
            if (loc1.socketID == mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER && loc1.data.Resp.@respID.toString() == mgs.aurora.modules.mpf.enums.MPFResponseIDs.SERVICE_RESPONSE && loc2.systemRegistration) 
            {
                if (!(loc1.data.Resp.@visibility == "1") || loc1.data.Resp.@serviceID == "0") 
                {
                    sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.DISPLAY_REGISTER_ERROR_DIALOGUE, "GAME_UNAVAILABLE");
                    return;
                }
                (loc3 = mgs.aurora.modules.mpf.model.SessionObjectProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME))).serviceID = loc1.data.Resp.@serviceID.toString();
                sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.REQUEST_REGISTRATION_STATUS);
            }
            if (loc1.socketID == mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER && loc1.data.Resp.@respID.toString() == mgs.aurora.modules.mpf.enums.MPFResponseIDs.REGISTRATION_STATUS && loc2.systemRegistration) 
            {
                sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.PROCESS_REGISTRATION_STATUS, loc1);
            }
            if (loc1.socketID == mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER && loc1.data.Resp.@respID.toString() == mgs.aurora.modules.mpf.enums.MPFResponseIDs.REGISTRATION_RESPONSE && loc2.systemRegistration) 
            {
                sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.PROCESS_REGISTRATION, loc1);
            }
            sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.PACKET_RECEIVED, new mgs.aurora.common.events.multiplayer.MPFPacketEvent(mgs.aurora.common.events.multiplayer.MPFPacketEvent.PACKET_RECEIVED, loc1.socketID, loc1.data));
            return;
        }
    }
}


//            class RequestRegistrationCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.common.enums.magneto.*;
    import mgs.aurora.modules.mpf.enums.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.model.vo.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RequestRegistrationCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RequestRegistrationCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME) as mgs.aurora.modules.mpf.model.SessionObjectProxy;
            XML.ignoreWhitespace = true;
            XML.prettyIndent = 0;
            XML.prettyPrinting = false;
            loc2 = new XML("<P>" + ("<Cmd cmdID=\"" + mgs.aurora.modules.mpf.enums.MPFCommandIDs.REGISTRATION_REQUEST + "\" tourID=\"" + loc1.curTournamentID + "\" register=\"1\"/>") + "</P>");
            Debugger.trace("register please  - " + loc2.toXMLString() + " ; " + loc1.serviceID, "SYSTEM - MPF");
            sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.SEND_PACKET, new mgs.aurora.modules.mpf.model.vo.SendPacketParams(mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER, uint(loc1.serviceID), loc2));
            return;
        }
    }
}


//            class RequestRegistrationStatusCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.common.enums.magneto.*;
    import mgs.aurora.modules.mpf.enums.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.model.vo.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RequestRegistrationStatusCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RequestRegistrationStatusCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME) as mgs.aurora.modules.mpf.model.SessionObjectProxy;
            XML.ignoreWhitespace = true;
            XML.prettyIndent = 0;
            XML.prettyPrinting = false;
            loc2 = new XML("<P>" + ("<Cmd cmdID=\"" + mgs.aurora.modules.mpf.enums.MPFCommandIDs.REGISTRATION_STATUS + "\" tourID=\"" + loc1.curTournamentID + "\" compatibilityVersion=\"1\" aliasRequired=\"0\"/>") + "</P>");
            Debugger.trace("getServiceID - " + loc2.toXMLString(), "SYSTEM - MPF");
            sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.SEND_PACKET, new mgs.aurora.modules.mpf.model.vo.SendPacketParams(mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER, uint(loc1.serviceID), loc2));
            return;
        }
    }
}


//            class RouterLoginCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.common.enums.magneto.*;
    import mgs.aurora.modules.mpf.enums.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.model.vo.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RouterLoginCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RouterLoginCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME) as mgs.aurora.modules.mpf.model.SessionObjectProxy;
            XML.ignoreWhitespace = true;
            XML.prettyIndent = 0;
            XML.prettyPrinting = false;
            if (loc1.allowTokenLogin) 
            {
                if (loc1.sessionToken == null || loc1.sessionToken == "") 
                {
                    loc2 = new XML("<P toFromID=\"" + mgs.aurora.modules.mpf.enums.MPFToFromID.ROUTER + "\">\r\n\t\t\t\t\t\t\t\t" + ("<Cmd cmdID=\"" + mgs.aurora.modules.mpf.enums.MPFCommandIDs.LOGIN + "\" serverID=\"" + loc1.serverID + "\" clientType=\"" + loc1.clientType + "\" loginType=\"Standard\">\r\n\t\t\t\t\t\t\t\t\t" + ("<LoginName>" + loc1.currentUsername + "</LoginName>") + "\r\n\t\t\t\t\t\t\t\t\t" + ("<Password>" + loc1.currentPassword + "</Password>") + "\r\n\t\t\t\t\t\t\t\t</Cmd>") + "\r\n\t\t\t\t\t\t\t</P>");
                }
                else 
                {
                    loc2 = new XML("<P toFromID=\"" + mgs.aurora.modules.mpf.enums.MPFToFromID.ROUTER + "\">\r\n\t\t\t\t\t\t\t\t" + ("<Cmd cmdID=\"" + mgs.aurora.modules.mpf.enums.MPFCommandIDs.LOGIN + "\" serverID=\"" + loc1.serverID + "\" clientType=\"" + loc1.clientType + "\" loginType=\"SessionAuthToken\">\r\n\t\t\t\t\t\t\t\t\t" + ("<UserId>" + loc1.sessionUserId + "</UserId>") + "\r\n\t\t\t\t\t\t\t\t\t" + ("<SessionAuthToken>" + loc1.sessionToken + "</SessionAuthToken>") + "\r\n\t\t\t\t\t\t\t\t</Cmd>") + "\r\n\t\t\t\t\t\t\t</P>");
                }
            }
            else 
            {
                loc2 = new XML("<P toFromID=\"" + mgs.aurora.modules.mpf.enums.MPFToFromID.ROUTER + "\">\r\n\t\t\t\t\t\t\t" + ("<Cmd cmdID=\"" + mgs.aurora.modules.mpf.enums.MPFCommandIDs.LOGIN + "\" name=\"" + loc1.currentUsername + "\" pwd=\"" + loc1.currentPassword + "\" serverID=\"" + loc1.serverID + "\" clientType=\"" + loc1.clientType + "\" sessionID=\"\"/>") + "\r\n\t\t\t\t\t\t</P>");
            }
            Debugger.trace("Attempt Login - " + loc2.toXMLString(), "SYSTEM - MPF");
            sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.SEND_PACKET, new mgs.aurora.modules.mpf.model.vo.SendPacketParams(mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER, mgs.aurora.modules.mpf.enums.MPFToFromID.ROUTER, loc2));
            return;
        }
    }
}


//            class SendPacketCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.model.vo.*;
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
            var loc1:*=arg1.getBody() as mgs.aurora.modules.mpf.model.vo.SendPacketParams;
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.mpf.model.MagnetoProxy.NAME) as mgs.aurora.modules.mpf.model.MagnetoProxy;
            loc2.sendPacket(loc1.socketID, loc1.serviceID, loc1.packet);
            return;
        }
    }
}


//            class SetupCommand
package mgs.aurora.modules.mpf.controller 
{
    import mgs.aurora.common.enums.mpf.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.model.vo.*;
    import mgs.aurora.modules.mpf.view.*;
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
            var loc1:*=arg1.getBody() as mgs.aurora.modules.mpf.model.vo.SetupParams;
            facade.registerProxy(new mgs.aurora.modules.mpf.model.ConfigProxy(loc1.config));
            facade.registerProxy(new mgs.aurora.modules.mpf.model.MagnetoProxy(loc1.magneto));
            facade.registerProxy(new mgs.aurora.modules.mpf.model.SessionObjectProxy(loc1.session));
            facade.registerProxy(new mgs.aurora.modules.mpf.model.DialoguesHandlerProxy(loc1.dialogues));
            facade.registerProxy(new mgs.aurora.modules.mpf.model.GamesListProxy(loc1.gamesList));
            facade.registerProxy(new mgs.aurora.modules.mpf.model.StringsProxy(loc1.strings));
            facade.registerProxy(new mgs.aurora.modules.mpf.model.CurrencyProxy());
            facade.registerMediator(new mgs.aurora.modules.mpf.view.NotificationDialogueMediator());
            facade.registerMediator(new mgs.aurora.modules.mpf.view.ErrorDialogueMediator());
            facade.registerMediator(new mgs.aurora.modules.mpf.view.RegisterDialogueMediator());
            var loc2:*=mgs.aurora.modules.mpf.model.CurrencyProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.CurrencyProxy.NAME));
            loc2.currencies = loc1.currencyInfo[mgs.aurora.common.enums.mpf.mpfConfigKeys.CURRENCY_XML];
            loc2.standardFormat = int(loc1.currencyInfo[mgs.aurora.common.enums.mpf.mpfConfigKeys.STANDARD_CURRENCY_FORMAT]);
            return;
        }
    }
}


//          package enums
//            class MPFCommandIDs
package mgs.aurora.modules.mpf.enums 
{
    public class MPFCommandIDs extends Object
    {
        public function MPFCommandIDs()
        {
            super();
            return;
        }

        public static const TOURNAMENT_IN_PROGRESS:String="14";

        public static const FORCED_LOGOUT:String="106";

        public static const LOGIN:String="100";

        public static const SERVICE_REQUEST:String="45";

        public static const REGISTRATION_STATUS:String="73";

        public static const REGISTRATION_REQUEST:String="74";
    }
}


//            class MPFDialogues
package mgs.aurora.modules.mpf.enums 
{
    public class MPFDialogues extends Object
    {
        public function MPFDialogues()
        {
            super();
            return;
        }

        public static const ERROR:String="Error";

        public static const NOTIFICATION:String="MpfTournamentInProgress";

        public static const REGISTER:String="MessageOkCancelCenter";

        public static const NOTIFICATION_TEXT1_MESSAGE:String="TOURNAMENT_INPROGRESS_TEXT1";

        public static const NOTIFICATION_TEXT2_MESSAGE:String="TOURNAMENT_INPROGRESS_TEXT2";

        public static const NOTIFICATION_TEXT_REPLACEMENT:String="tournamentName";

        public static const TEXT_MESSAGE:String="MESS";

        public static const TEXT1_MESSAGE:String="MESS1";

        public static const OK_BNT:String="OK";

        public static const YES_BNT:String="YES";

        public static const NO_BNT:String="NO";

        public static const CANCEL_BNT:String="CANCEL";

        public static const REGISTER_COST_STRING:String="TOUR_REG_COST";

        public static const REGISTER_CREDIT_STRING:String="TOUR_REG_CREDITS";

        public static const REGISTER_FREE_STRING:String="TOUR_REG_FREE";

        public static const REGISTER_COST_REPLACEMENT:String="cost";

        public static const REGISTER_CREDITS_REPLACEMENT:String="credits";

        public static const REGISTER_ERROR_TITLE:String="TOURNAMENT_REG_ERROR_TITLE";

        public static const REGISTER_ERROR:String="REG_ERROR";

        public static const REGISTER_ERROR_TOURNAME:String="tournamentName";

        public static const REGISTER_ERROR_ERROR:String="errorstatusID";
    }
}


//            class MPFLoginStatus
package mgs.aurora.modules.mpf.enums 
{
    public class MPFLoginStatus extends Object
    {
        public function MPFLoginStatus()
        {
            super();
            return;
        }

        public static const SUCCESS:String="0";
    }
}


//            class MPFRegistrationStatus
package mgs.aurora.modules.mpf.enums 
{
    public class MPFRegistrationStatus extends Object
    {
        public function MPFRegistrationStatus()
        {
            super();
            return;
        }

        public static const SUCCESS:String="0";

        public static const REGISTERED:String="10";
    }
}


//            class MPFResponseIDs
package mgs.aurora.modules.mpf.enums 
{
    public class MPFResponseIDs extends Object
    {
        public function MPFResponseIDs()
        {
            super();
            return;
        }

        public static const LOGIN:String="100";

        public static const SERVICE_RESPONSE:String="45";

        public static const REGISTRATION_STATUS:String="73";

        public static const REGISTRATION_RESPONSE:String="74";
    }
}


//            class MPFToFromID
package mgs.aurora.modules.mpf.enums 
{
    public class MPFToFromID extends Object
    {
        public function MPFToFromID()
        {
            super();
            return;
        }

        public static const ROUTER:uint=99;

        public static const LOBBY:uint=100;

        public static const MAIN_LOBBY:uint=110;
    }
}


//          package model
//            package vo
//              class ProcessResponseParams
package mgs.aurora.modules.mpf.model.vo 
{
    public class ProcessResponseParams extends Object
    {
        public function ProcessResponseParams(arg1:String, arg2:XML)
        {
            super();
            this.socketID = arg1;
            this.data = arg2;
            return;
        }

        public var socketID:String;

        public var data:XML;
    }
}


//              class SendPacketParams
package mgs.aurora.modules.mpf.model.vo 
{
    public class SendPacketParams extends Object
    {
        public function SendPacketParams(arg1:String, arg2:uint, arg3:XML)
        {
            super();
            this.socketID = arg1;
            this.serviceID = arg2;
            this.packet = arg3;
            return;
        }

        public var socketID:String;

        public var serviceID:uint;

        public var packet:XML;
    }
}


//              class SetupParams
package mgs.aurora.modules.mpf.model.vo 
{
    import flash.utils.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.common.interfaces.magneto.*;
    
    public class SetupParams extends Object
    {
        public function SetupParams(arg1:XML, arg2:mgs.aurora.common.interfaces.magneto.IMagneto, arg3:Object, arg4:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler, arg5:XML, arg6:XML, arg7:flash.utils.Dictionary)
        {
            super();
            this.config = arg1;
            this.magneto = arg2;
            this.session = arg3;
            this.dialogues = arg4;
            this.gamesList = arg5;
            this.strings = arg6;
            this.currencyInfo = arg7;
            return;
        }

        public var currencyInfo:flash.utils.Dictionary;

        public var config:XML;

        public var magneto:mgs.aurora.common.interfaces.magneto.IMagneto;

        public var session:Object;

        public var gamesList:XML;

        public var dialogues:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler;

        public var strings:XML;
    }
}


//            class AvatarLoaderProxy
package mgs.aurora.modules.mpf.model 
{
    import flash.events.*;
    import flash.net.*;
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.modules.mpf.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class AvatarLoaderProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function AvatarLoaderProxy()
        {
            super(NAME, new flash.net.URLLoader());
            return;
        }

        public override function setData(arg1:Object):void
        {
            super.setData(arg1);
            var loc1:*=arg1 as flash.events.IEventDispatcher;
            loc1.addEventListener(flash.events.Event.COMPLETE, this.onFileLoaded, false, 0, true);
            loc1.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onError, false, 0, true);
            loc1.addEventListener(flash.events.SecurityErrorEvent.SECURITY_ERROR, this.onError, false, 0, true);
            return;
        }

        internal function onError(arg1:flash.events.Event):void
        {
            Debugger.trace("AvatarLoaderProxy.onError " + arg1.toString(), mgs.aurora.modules.mpf.MPFFacade.NAME);
            sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.AVATAR_LOADING_ERROR, new mgs.aurora.common.events.multiplayer.MPFErrorEvent(mgs.aurora.common.events.multiplayer.MPFErrorEvent.AVATAR_LOADING_ERROR, arg1));
            return;
        }

        internal function onFileLoaded(arg1:flash.events.Event):void
        {
            Debugger.trace("AvatarLoaderProxy.onFileLoaded", mgs.aurora.modules.mpf.MPFFacade.NAME);
            sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.AVATAR_RECEIVED, new mgs.aurora.common.events.multiplayer.MPFAvatarEvent(mgs.aurora.common.events.multiplayer.MPFAvatarEvent.AVATAR_RECEIVED, arg1.currentTarget.data));
            return;
        }

        internal function get loader():flash.net.URLLoader
        {
            return getData() as flash.net.URLLoader;
        }

        public function load(arg1:String):void
        {
            Debugger.trace("AvatarLoaderProxy.load " + arg1, mgs.aurora.modules.mpf.MPFFacade.NAME);
            var loc1:*=new flash.net.URLRequest(arg1);
            this.loader.dataFormat = flash.net.URLLoaderDataFormat.BINARY;
            this.loader.load(loc1);
            return;
        }

        public static const NAME:String="AvatarLoaderProxy";
    }
}


//            class ConfigProxy
package mgs.aurora.modules.mpf.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class ConfigProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function ConfigProxy(arg1:XML)
        {
            super(NAME, arg1);
            return;
        }

        internal function get config():XML
        {
            return getData() as XML;
        }

        public function get cancelURL():String
        {
            return this.avatarUrl + this.cancel;
        }

        public function get fetchMetaDataURL():String
        {
            return this.avatarUrl + this.fetch;
        }

        public function get oneClickEnabled():Boolean
        {
            return this.config.@enableMPFOneClick.toString() == "1";
        }

        public function get maxTitleLength():int
        {
            return int(this.config.registration.@maxTitleLength);
        }

        internal function get fetch():String
        {
            return this.config.avatar.@fetch.toString();
        }

        internal function get avatarUrl():String
        {
            var loc1:*=this.config.avatar.@fileUrl.toString();
            return loc1.lastIndexOf("/") != (loc1.length - 1) ? loc1 + "/" : loc1;
        }

        internal function get cancel():String
        {
            return this.config.avatar.@cancel.toString();
        }

        public static const NAME:String="ConfigProxy";
    }
}


//            class CurrencyProxy
package mgs.aurora.modules.mpf.model 
{
    import mgs.aurora.common.interfaces.currency.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class CurrencyProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function CurrencyProxy()
        {
            super(NAME, null);
            return;
        }

        public function getFormatFromISOCode(arg1:String, arg2:int):String
        {
            return this._currencies.getFormatfromISOCode(arg1, arg2, false);
        }

        public function get standardFormat():int
        {
            return this._standardFormat;
        }

        public function set standardFormat(arg1:int):void
        {
            this._standardFormat = arg1;
            return;
        }

        public function set currencies(arg1:mgs.aurora.common.interfaces.currency.ICurrency):void
        {
            this._currencies = arg1;
            return;
        }

        public static const NAME:String="CurrencyProxy";

        internal var _currencies:mgs.aurora.common.interfaces.currency.ICurrency;

        internal var _standardFormat:int;
    }
}


//            class DialoguesHandlerProxy
package mgs.aurora.modules.mpf.model 
{
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class DialoguesHandlerProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function DialoguesHandlerProxy(arg1:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler)
        {
            super(NAME, arg1);
            return;
        }

        public override function setData(arg1:Object):void
        {
            super.setData(arg1);
            var loc1:*=mgs.aurora.common.interfaces.dialogues.IDialoguesHandler(arg1);
            loc1.addEventListener(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.DIALOGUE_CREATED, this.onCreated, false, 0, true);
            return;
        }

        internal function onCreated(arg1:mgs.aurora.common.events.dialogues.DialoguesHandlerEvent):void
        {
            var loc1:*=this.dialogueHandler.dialogue(arg1.diagId);
            sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.DIALOGUE_CREATED, loc1, arg1.diagType);
            return;
        }

        internal function get dialogueHandler():mgs.aurora.common.interfaces.dialogues.IDialoguesHandler
        {
            return mgs.aurora.common.interfaces.dialogues.IDialoguesHandler(getData());
        }

        public function create(arg1:String, arg2:String):void
        {
            this.dialogueHandler.create(arg1, arg2);
            return;
        }

        public function remove(arg1:String):void
        {
            this.dialogueHandler.remove(arg1);
            return;
        }

        public static const NAME:String="DialoguesHandlerProxy";
    }
}


//            class FetchRequestProxy
package mgs.aurora.modules.mpf.model 
{
    import flash.events.*;
    import flash.net.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class FetchRequestProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function FetchRequestProxy()
        {
            super(NAME, null);
            return;
        }

        public function fetch(arg1:String, arg2:String):void
        {
            var loc1:*=new flash.net.URLVariables();
            loc1.aliasID = arg2;
            var loc2:*;
            (loc2 = new flash.net.URLRequest(arg1)).method = flash.net.URLRequestMethod.POST;
            loc2.data = loc1;
            var loc3:*;
            (loc3 = new flash.net.URLLoader()).addEventListener(flash.events.HTTPStatusEvent.HTTP_STATUS, this.onHTTPStatus, false, 0, true);
            loc3.addEventListener(flash.events.Event.COMPLETE, this.onComplete, false, 0, true);
            loc3.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onError, false, 0, true);
            loc3.addEventListener(flash.events.SecurityErrorEvent.SECURITY_ERROR, this.onError, false, 0, true);
            loc3.load(loc2);
            return;
        }

        internal function onError(arg1:flash.events.TextEvent):void
        {
            return;
        }

        internal function onComplete(arg1:flash.events.Event):void
        {
            sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.AVATAR_META_DATA_RECEIVED, arg1.target.data);
            return;
        }

        internal function onHTTPStatus(arg1:flash.events.HTTPStatusEvent):void
        {
            return;
        }

        public static const NAME:String="FetchRequestProxy";
    }
}


//            class GamesListProxy
package mgs.aurora.modules.mpf.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class GamesListProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function GamesListProxy(arg1:XML)
        {
            super(NAME, arg1);
            return;
        }

        internal function get gamesList():XML
        {
            return XML(getData());
        }

        public function containsGameID(arg1:String, arg2:String):Boolean
        {
            var gameID:String;
            var tourID:String;
            var result:XMLList;
            var sessionData:mgs.aurora.modules.mpf.model.SessionObjectProxy;

            var loc1:*;
            result = null;
            sessionData = null;
            gameID = arg1;
            tourID = arg2;
            gameID = this.getGameID(gameID);
            var loc3:*=0;
            var loc4:*=this.gamesList.gameset.art;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == gameID) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            result = loc2;
            if (result.toXMLString() == "") 
            {
                return false;
            }
            sessionData = mgs.aurora.modules.mpf.model.SessionObjectProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME));
            if (sessionData.curTournamentID == tourID) 
            {
                return false;
            }
            return true;
        }

        public function getGameID(arg1:String):String
        {
            var loc1:*=0;
            while (loc1 < this.gamesList.gameset.length()) 
            {
                if (this.gamesList.gameset[loc1].art.@mpfGameid != undefined) 
                {
                    if (this.gamesList.gameset[loc1].art.@mpfGameid.toLowerCase() == arg1.toLowerCase()) 
                    {
                        return this.gamesList.gameset[loc1].art.@id;
                    }
                }
                ++loc1;
            }
            return arg1;
        }

        public static const NAME:String="GamesListProxy";
    }
}


//            class MagnetoProxy
package mgs.aurora.modules.mpf.model 
{
    import flash.events.*;
    import mgs.aurora.common.enums.magneto.*;
    import mgs.aurora.common.events.magneto.*;
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.common.interfaces.magneto.*;
    import mgs.aurora.modules.mpf.enums.*;
    import mgs.aurora.modules.mpf.model.vo.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class MagnetoProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function MagnetoProxy(arg1:mgs.aurora.common.interfaces.magneto.IMagneto)
        {
            super(NAME, arg1);
            return;
        }

        public override function setData(arg1:Object):void
        {
            super.setData(arg1);
            var loc1:*=arg1 as flash.events.IEventDispatcher;
            loc1.addEventListener(mgs.aurora.common.events.magneto.MagnetoEvent.CONNECTED, this.onConnection, false, 0, true);
            loc1.addEventListener(mgs.aurora.common.events.magneto.MagnetoEvent.DATA, this.onData, false, 0, true);
            return;
        }

        internal function onData(arg1:mgs.aurora.common.events.magneto.MagnetoEvent):void
        {
            var loc1:*=arg1.data.Error.@cmdID.toString();
            switch (loc1) 
            {
                case mgs.aurora.modules.mpf.enums.MPFResponseIDs.LOGIN:
                {
                    Debugger.trace("MPF Login error - " + arg1.data, "SYSTEM - MPF", null, 16711680);
                    sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.LOGIN_ERROR, new mgs.aurora.common.events.multiplayer.MPFPacketEvent(mgs.aurora.common.events.multiplayer.MPFPacketEvent.LOGIN_ERROR, arg1.socketId, arg1.data));
                    break;
                }
                default:
                {
                    loc1 = arg1.data.Resp.@respID.toString();
                    switch (loc1) 
                    {
                        case mgs.aurora.modules.mpf.enums.MPFResponseIDs.LOGIN:
                        {
                            if (arg1.data.Resp.@status.toString() != mgs.aurora.modules.mpf.enums.MPFLoginStatus.SUCCESS) 
                            {
                                Debugger.trace("MPF Login error", "SYSTEM - MPF", null, 16711680);
                                mgs.aurora.modules.mpf.model.StatusProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StatusProxy.NAME)).loggedIn = false;
                                sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.LOGIN_ERROR, new mgs.aurora.common.events.multiplayer.MPFPacketEvent(mgs.aurora.common.events.multiplayer.MPFPacketEvent.LOGIN_ERROR, arg1.socketId, arg1.data));
                            }
                            else 
                            {
                                Debugger.trace("MPF Logged in", "SYSTEM - MPF");
                                mgs.aurora.modules.mpf.model.StatusProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StatusProxy.NAME)).loggedIn = true;
                                sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.LOGIN_SUCCESS, new mgs.aurora.common.events.multiplayer.MPFPacketEvent(mgs.aurora.common.events.multiplayer.MPFPacketEvent.LOGIN_SUCCESSFUL, arg1.socketId, arg1.data));
                            }
                            break;
                        }
                        default:
                        {
                            sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.PROCESS_RESPONSE, new mgs.aurora.modules.mpf.model.vo.ProcessResponseParams(arg1.socketId, arg1.data));
                            break;
                        }
                    }
                }
            }
            return;
        }

        internal function onConnection(arg1:mgs.aurora.common.events.magneto.MagnetoEvent):void
        {
            if (arg1.socketId != mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_LOBBY) 
            {
                this._routerConnected = true;
            }
            else 
            {
                this._lobbyConnected = true;
            }
            var loc1:*=new mgs.aurora.common.events.multiplayer.MPFConnectionEvent(mgs.aurora.common.events.multiplayer.MPFConnectionEvent.SOCKET_CONNECTED, arg1.socketId);
            sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.CONNECTION_ESTABLISHED, loc1);
            if (this._lobbyConnected && this._routerConnected) 
            {
                sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.ALL_CONNECTIONS_ESTABLISHED, new mgs.aurora.common.events.multiplayer.MPFConnectionEvent(mgs.aurora.common.events.multiplayer.MPFConnectionEvent.ALL_SOCKETS_CONNECTED, arg1.socketId));
            }
            return;
        }

        internal function get magneto():mgs.aurora.common.interfaces.magneto.IMagneto
        {
            return getData() as mgs.aurora.common.interfaces.magneto.IMagneto;
        }

        public function get routerConnected():Boolean
        {
            return this._routerConnected;
        }

        public function get lobbyConnected():Boolean
        {
            return this._lobbyConnected;
        }

        public function connect(arg1:String):void
        {
            this.magneto.connect(arg1);
            return;
        }

        public function close(arg1:String):void
        {
            if (arg1 != mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_LOBBY) 
            {
                this._routerConnected = false;
                mgs.aurora.modules.mpf.model.StatusProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StatusProxy.NAME)).loggedIn = false;
            }
            else 
            {
                this._lobbyConnected = false;
            }
            this.magneto.close(arg1);
            return;
        }

        public function sendPacket(arg1:String, arg2:uint, arg3:XML):void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME) as mgs.aurora.modules.mpf.model.SessionObjectProxy;
            this.magneto.sendData(arg1, arg3, loc1.serverID, arg2, 10001);
            return;
        }

        public static const NAME:String="MagnetoProxy";

        internal var _routerConnected:Boolean;

        internal var _lobbyConnected:Boolean;
    }
}


//            class SessionObjectProxy
package mgs.aurora.modules.mpf.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class SessionObjectProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function SessionObjectProxy(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public function get serverID():uint
        {
            return uint(getData().serverID);
        }

        public function get currentUsername():String
        {
            return getData().session.currentusername;
        }

        public function get currentPassword():String
        {
            return getData().session.currentpassword;
        }

        public function get clientType():String
        {
            return getData().clientType;
        }

        public function get userType():int
        {
            var loc1:*=getData().session;
            return int(loc1.usertype);
        }

        public function get sessionToken():String
        {
            return getData().sessionToken;
        }

        public function get sessionUserId():String
        {
            return getData().sessionUserId;
        }

        public function get allowTokenLogin():Boolean
        {
            Debugger.trace("AllowTokenLogin :: " + getData().allowTokenLogin, "MPF - NEO");
            return getData().allowTokenLogin;
        }

        public function get curTournamentID():String
        {
            Debugger.trace("curTournamentID :: " + getData().curTournamentID, "MPF - NEO");
            return getData().curTournamentID;
        }

        public function set curTournamentID(arg1:String):void
        {
            getData().curTournamentID = arg1;
            Debugger.trace("curTournamentID Set :: " + arg1 + " ;; " + getData().curTournamentID, "MPF - NEO");
            return;
        }

        public function get serviceID():String
        {
            Debugger.trace("seviceID :: " + getData().serviceID, "MPF - NEO");
            return getData().serviceID;
        }

        public function set serviceID(arg1:String):void
        {
            getData().serviceID = arg1;
            Debugger.trace("seviceID Set :: " + arg1 + " ;; " + getData().serviceID, "MPF - NEO");
            return;
        }

        public function get currentModuleID():String
        {
            return getData().currentModuleID;
        }

        public function get currentClientID():String
        {
            return getData().currentClientID;
        }

        public function get tournamentName():String
        {
            return this._tournamentName;
        }

        public function set tournamentName(arg1:String):void
        {
            this._tournamentName = arg1;
            return;
        }

        public static const NAME:String="SessionObjectProxy";

        internal var _tournamentName:String;
    }
}


//            class StatusProxy
package mgs.aurora.modules.mpf.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class StatusProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function StatusProxy()
        {
            super(NAME, null);
            return;
        }

        public function get loggedIn():Boolean
        {
            return this._loggedIn;
        }

        public function set loggedIn(arg1:Boolean):void
        {
            Debugger.trace("MPF : SET STATUS " + arg1, "SYSTEM");
            this._loggedIn = arg1;
            return;
        }

        public function get systemRegistration():Boolean
        {
            return this._systemRegistration;
        }

        public function set systemRegistration(arg1:Boolean):void
        {
            this._systemRegistration = arg1;
            return;
        }

        public static const NAME:String="StatusProxy";

        internal var _loggedIn:Boolean=false;

        internal var _systemRegistration:Boolean=false;
    }
}


//            class StringsProxy
package mgs.aurora.modules.mpf.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class StringsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function StringsProxy(arg1:XML)
        {
            super(NAME, arg1);
            return;
        }

        internal function get strings():XML
        {
            return XML(getData());
        }

        public function getString(arg1:String):String
        {
            var id:String;

            var loc1:*;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.strings.string;
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

        public static const NAME:String="StringsProxy";
    }
}


//          package notifications
//            class InboundNotifications
package mgs.aurora.modules.mpf.notifications 
{
    public class InboundNotifications extends Object
    {
        public function InboundNotifications()
        {
            super();
            return;
        }

        internal static const NAME:String="InboundNotifications";

        public static const SETUP:String=NAME + "/notes/setup";

        public static const ATTEMPT_CONNECTIONS:String=NAME + "/notes/attempt_connections";

        public static const ATTEMPT_LOBBY_CONNECTION:String=NAME + "/notes/attempt_lobby_connection";

        public static const ATTEMPT_ROUTER_CONNECTION:String=NAME + "/notes/attempt_router_connection";

        public static const SEND_PACKET:String=NAME + "/notes/send_packet";

        public static const LOAD_AVATAR:String=NAME + "/notes/load_avatar";

        public static const CANCEL_AVATAR:String=NAME + "/notes/cancel_avatar";

        public static const FETCH_AVATAR_METADATA:String=NAME + "/notes/fetch_avatar_metadata";

        public static const CLOSE_CONNECTIONS:String=NAME + "/notes/close_connections";

        public static const ATTEMPT_REGISTRATION:String=NAME + "/notes/attempt_registration";
    }
}


//            class InternalNotifications
package mgs.aurora.modules.mpf.notifications 
{
    public class InternalNotifications extends Object
    {
        public function InternalNotifications()
        {
            super();
            return;
        }

        internal static const NAME:String="InternalNotifications";

        public static const DO_ROUTER_LOGIN:String=NAME + "/notes/do_router_login";

        public static const AVATAR_META_DATA_RECEIVED:String=NAME + "/notes/avatar_meta_data_received";

        public static const PROCESS_RESPONSE:String=NAME + "/notes/process_response";

        public static const DISPLAY_NOTIFICATION:String=NAME + "/notes/display_notification";

        public static const CHECK_DISPLAY_NOTIFICATION_ALLOWED:String=NAME + "/notes/check_display_notification_allowed";

        public static const DIALOGUE_CREATED:String=NAME + "/notes/dialogue_created";

        public static const REQUEST_REGISTRATION_STATUS:String=NAME + "/notes/request_registration_status";

        public static const PROCESS_REGISTRATION_STATUS:String=NAME + "/notes/process_registration_status";

        public static const REQUEST_REGISTRATION:String=NAME + "/notes/request_registration";

        public static const PROCESS_REGISTRATION:String=NAME + "/notes/process_registration";

        public static const DISPLAY_REGISTER_DIALOGUE:String=NAME + "/notes/display_register_dialogue";

        public static const DISPLAY_REGISTER_ERROR_DIALOGUE:String=NAME + "/notes/display_register_error_dialogue";
    }
}


//            class OutboundNotifications
package mgs.aurora.modules.mpf.notifications 
{
    public class OutboundNotifications extends Object
    {
        public function OutboundNotifications()
        {
            super();
            return;
        }

        internal static const NAME:String="OutboundNotifications";

        public static const CONNECTION_ESTABLISHED:String=NAME + "/notes/connection_established";

        public static const ALL_CONNECTIONS_ESTABLISHED:String=NAME + "/notes/all_connections_established";

        public static const PACKET_RECEIVED:String=NAME + "/notes/packet_received";

        public static const AVATAR_RECEIVED:String=NAME + "/notes/avatar_received";

        public static const LOGIN_SUCCESS:String=NAME + "/notes/login_success";

        public static const LOGIN_ERROR:String=NAME + "/notes/login_error";

        public static const AVATAR_LOADING_ERROR:String=NAME + "/notes/avatar_loading_error";

        public static const AVATAR_META_DATA_RECEIVED:String=NAME + "/notes/avatar_meta_data_received";

        public static const PLAYER_NOTIFICATION:String=NAME + "/notes/player_notification";

        public static const LAUNCH_TOURNAMENT:String=NAME + "/notes/launch_tournament";

        public static const PLAYER_REGISTERED_SUCCESSFUL:String=NAME + "/notes/player_registered_successful";

        public static const PLAYER_REGISTERED_FAILED:String=NAME + "/notes/player_registered_failed";
    }
}


//          package view
//            class ErrorDialogueMediator
package mgs.aurora.modules.mpf.view 
{
    import flash.utils.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.mpf.enums.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class ErrorDialogueMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function ErrorDialogueMediator()
        {
            super(NAME, viewComponent);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.mpf.notifications.InternalNotifications.DISPLAY_REGISTER_ERROR_DIALOGUE);
            loc1.push(mgs.aurora.modules.mpf.notifications.InternalNotifications.DIALOGUE_CREATED);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=arg1.getName();
            switch (loc2) 
            {
                case mgs.aurora.modules.mpf.notifications.InternalNotifications.DISPLAY_REGISTER_ERROR_DIALOGUE:
                {
                    this._errorCode = String(arg1.getBody());
                    this._errorStringID = this._errorCode != "GAME_UNAVAILABLE" ? "REG_STATUS" + this._errorCode + "_TEXT" : this._errorCode;
                    mgs.aurora.modules.mpf.model.DialoguesHandlerProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.DialoguesHandlerProxy.NAME)).create(mgs.aurora.common.utilities.GUID.create(), mgs.aurora.modules.mpf.enums.MPFDialogues.ERROR);
                    break;
                }
                case mgs.aurora.modules.mpf.notifications.InternalNotifications.DIALOGUE_CREATED:
                {
                    loc1 = mgs.aurora.common.interfaces.dialogues.IDialogue(arg1.getBody());
                    if (arg1.getType() == mgs.aurora.modules.mpf.enums.MPFDialogues.ERROR) 
                    {
                        this.registerErrorDialogueCreated(loc1);
                    }
                    break;
                }
            }
            return;
        }

        internal function registerErrorDialogueCreated(arg1:mgs.aurora.common.interfaces.dialogues.IDialogue):void
        {
            var loc4:*=null;
            var loc1:*=mgs.aurora.modules.mpf.model.StringsProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StringsProxy.NAME));
            var loc2:*=mgs.aurora.common.utilities.StringUtils.dialogueStringToHtml(loc1.getString(this._errorStringID));
            arg1.title.text = mgs.aurora.common.utilities.StringUtils.dialogueStringToHtml(loc1.getString(mgs.aurora.modules.mpf.enums.MPFDialogues.REGISTER_ERROR_TITLE));
            if (loc2 == "") 
            {
                loc2 = mgs.aurora.common.utilities.StringUtils.dialogueStringToHtml(loc1.getString(mgs.aurora.modules.mpf.enums.MPFDialogues.REGISTER_ERROR));
                (loc4 = new flash.utils.Dictionary())[mgs.aurora.modules.mpf.enums.MPFDialogues.REGISTER_ERROR_ERROR] = this._errorCode;
                loc2 = mgs.aurora.common.utilities.StringUtils.replaceNamedVars(loc2, loc4);
            }
            arg1.texts.getText(mgs.aurora.modules.mpf.enums.MPFDialogues.TEXT_MESSAGE).text = loc2;
            var loc3:*;
            (loc3 = arg1.buttons.getButton(mgs.aurora.modules.mpf.enums.MPFDialogues.OK_BNT)).addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onOkSelected, false, 0, true);
            loc3.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onOkSelected, false, 0, true);
            return;
        }

        internal function onOkSelected(arg1:*):void
        {
            mgs.aurora.modules.mpf.model.DialoguesHandlerProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.DialoguesHandlerProxy.NAME)).remove(arg1.diagId);
            var loc1:*=mgs.aurora.modules.mpf.model.SessionObjectProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME));
            mgs.aurora.modules.mpf.model.StatusProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StatusProxy.NAME)).systemRegistration = false;
            sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_REGISTERED_FAILED, new mgs.aurora.common.events.multiplayer.MPFPacketEvent(mgs.aurora.common.events.multiplayer.MPFPacketEvent.REGISTRATION_ERROR, loc1.serviceID, new XML()));
            return;
        }

        public static const NAME:String="ErrorDialogueMediator";

        internal var _errorStringID:String;

        internal var _errorCode:String;
    }
}


//            class EventBridgeMediator
package mgs.aurora.modules.mpf.view 
{
    import flash.events.*;
    import mgs.aurora.common.enums.magneto.*;
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class EventBridgeMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function EventBridgeMediator(arg1:flash.events.IEventDispatcher)
        {
            super(NAME, arg1);
            return;
        }

        internal function get dispatcher():flash.events.IEventDispatcher
        {
            return getViewComponent() as flash.events.IEventDispatcher;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.ALL_CONNECTIONS_ESTABLISHED);
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.CONNECTION_ESTABLISHED);
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.AVATAR_RECEIVED);
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.PACKET_RECEIVED);
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.LOGIN_SUCCESS);
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.LOGIN_ERROR);
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.AVATAR_LOADING_ERROR);
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.AVATAR_META_DATA_RECEIVED);
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_NOTIFICATION);
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.LAUNCH_TOURNAMENT);
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_REGISTERED_SUCCESSFUL);
            loc1.push(mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_REGISTERED_FAILED);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=false;
            Debugger.trace(arg1.getName());
            var loc3:*=arg1.getName();
            switch (loc3) 
            {
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.CONNECTION_ESTABLISHED:
                {
                    loc1 = arg1.getBody() as mgs.aurora.common.events.multiplayer.MPFConnectionEvent;
                    if (loc1.socketID == mgs.aurora.common.enums.magneto.SocketIdentifiers.MPV_ROUTER) 
                    {
                        loc2 = mgs.aurora.modules.mpf.model.StatusProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StatusProxy.NAME)).loggedIn;
                        if (loc2) 
                        {
                            sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.LOGIN_SUCCESS, new mgs.aurora.common.events.multiplayer.MPFPacketEvent(mgs.aurora.common.events.multiplayer.MPFPacketEvent.LOGIN_SUCCESSFUL, loc1.socketID, null));
                        }
                        else 
                        {
                            sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.DO_ROUTER_LOGIN);
                        }
                    }
                }
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.AVATAR_META_DATA_RECEIVED:
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.AVATAR_RECEIVED:
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.PACKET_RECEIVED:
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.ALL_CONNECTIONS_ESTABLISHED:
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.LOGIN_SUCCESS:
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.LOGIN_ERROR:
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.AVATAR_LOADING_ERROR:
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_NOTIFICATION:
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.LAUNCH_TOURNAMENT:
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_REGISTERED_SUCCESSFUL:
                case mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_REGISTERED_FAILED:
                {
                    this.dispatcher.dispatchEvent(flash.events.Event(arg1.getBody()));
                    break;
                }
            }
            return;
        }

        public static const NAME:String="EventBridgeMediator";
    }
}


//            class NotificationDialogueMediator
package mgs.aurora.modules.mpf.view 
{
    import __AS3__.vec.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.mpf.enums.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class NotificationDialogueMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function NotificationDialogueMediator()
        {
            super(NAME, null);
            this._notificationQueue = new Vector.<XML>();
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.mpf.notifications.InternalNotifications.DISPLAY_NOTIFICATION);
            loc1.push(mgs.aurora.modules.mpf.notifications.InternalNotifications.DIALOGUE_CREATED);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=arg1.getName();
            switch (loc3) 
            {
                case mgs.aurora.modules.mpf.notifications.InternalNotifications.DISPLAY_NOTIFICATION:
                {
                    if (this._displaying) 
                    {
                        loc1 = XML(arg1.getBody());
                        this._notificationQueue.push(loc1);
                    }
                    else 
                    {
                        this.response = XML(arg1.getBody());
                        this.showTournamentNotificationDialogue(this.response);
                    }
                    break;
                }
                case mgs.aurora.modules.mpf.notifications.InternalNotifications.DIALOGUE_CREATED:
                {
                    if (arg1.getType() == mgs.aurora.modules.mpf.enums.MPFDialogues.NOTIFICATION) 
                    {
                        loc2 = mgs.aurora.common.interfaces.dialogues.IDialogue(arg1.getBody());
                        setViewComponent(loc2);
                        this.configureDialogue(loc2);
                    }
                    break;
                }
            }
            return;
        }

        internal function configureDialogue(arg1:mgs.aurora.common.interfaces.dialogues.IDialogue):void
        {
            var loc1:*=arg1.buttons.getButton(mgs.aurora.modules.mpf.enums.MPFDialogues.YES_BNT);
            loc1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onYesSelected, false, 0, true);
            loc1.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onYesSelected, false, 0, true);
            var loc2:*=arg1.buttons.getButton(mgs.aurora.modules.mpf.enums.MPFDialogues.NO_BNT);
            loc2.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onNoSelected, false, 0, true);
            loc2.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onNoSelected, false, 0, true);
            var loc3:*=arg1.texts.getText(mgs.aurora.modules.mpf.enums.MPFDialogues.TEXT_MESSAGE);
            var loc4:*=this.response.Cmd.@name.toString();
            var loc5:*=this.response.Cmd.@tourID == undefined ? this.response.Cmd.@gmID.toString() : this.response.Cmd.@tourID.toString();
            var loc6:*;
            (loc6 = new flash.utils.Dictionary())[mgs.aurora.modules.mpf.enums.MPFDialogues.NOTIFICATION_TEXT_REPLACEMENT] = loc4 + "(" + loc5 + ")";
            var loc7:*=mgs.aurora.modules.mpf.model.StringsProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StringsProxy.NAME));
            var loc8:*=(loc8 = (loc8 = mgs.aurora.common.utilities.StringUtils.replaceNamedVars(loc7.getString(mgs.aurora.modules.mpf.enums.MPFDialogues.NOTIFICATION_TEXT1_MESSAGE), loc6)) + "-L--L-") + loc7.getString(mgs.aurora.modules.mpf.enums.MPFDialogues.NOTIFICATION_TEXT2_MESSAGE);
            loc3.text = mgs.aurora.common.utilities.StringUtils.dialogueStringToHtml(loc8);
            return;
        }

        internal function onYesSelected(arg1:*):void
        {
            var loc1:*=mgs.aurora.modules.mpf.model.SessionObjectProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME));
            loc1.curTournamentID = this.response.Cmd.@tourID == undefined ? this.response.Cmd.@gmID.toString() : this.response.Cmd.@tourID.toString();
            loc1.serviceID = this.response.Cmd.@serviceID.toString();
            var loc2:*=mgs.aurora.modules.mpf.model.GamesListProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.GamesListProxy.NAME));
            var loc3:*=loc2.getGameID(this.response.Cmd.@gameID.toString());
            sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.LAUNCH_TOURNAMENT, new mgs.aurora.common.events.multiplayer.MPFLaunchEvent(mgs.aurora.common.events.multiplayer.MPFLaunchEvent.LAUNCH_GAME, loc3));
            this.remove(arg1.diagId, true);
            return;
        }

        internal function onNoSelected(arg1:*):void
        {
            var loc1:*=mgs.aurora.modules.mpf.model.DialoguesHandlerProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.DialoguesHandlerProxy.NAME));
            this.remove(arg1.diagId, false);
            return;
        }

        internal function remove(arg1:String, arg2:Boolean):void
        {
            var diagId:String;
            var delay:Boolean;
            var dialogues:mgs.aurora.modules.mpf.model.DialoguesHandlerProxy;
            var delaytime:int;
            var timer:flash.utils.Timer;

            var loc1:*;
            delaytime = 0;
            timer = null;
            diagId = arg1;
            delay = arg2;
            setViewComponent(null);
            dialogues = mgs.aurora.modules.mpf.model.DialoguesHandlerProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.DialoguesHandlerProxy.NAME));
            dialogues.remove(diagId);
            this._displaying = false;
            if (this._notificationQueue.length > 0) 
            {
                delaytime = delay ? 1000 : 1;
                timer = new flash.utils.Timer(delaytime, 1);
                timer.addEventListener(flash.events.TimerEvent.TIMER_COMPLETE, function (arg1:flash.events.Event):void
                {
                    doNextNotification();
                    return;
                })
                timer.start();
            }
            return;
        }

        internal function doNextNotification():void
        {
            this.response = this._notificationQueue.pop();
            this.showTournamentNotificationDialogue(this.response);
            return;
        }

        internal function showTournamentNotificationDialogue(arg1:XML):void
        {
            this._displaying = true;
            var loc1:*=this.response.Cmd.@tourID == undefined ? this.response.Cmd.@gmID.toString() : this.response.Cmd.@tourID.toString();
            Debugger.trace("showTournamentNotificationDialogue " + loc1, "MPF - NEO");
            var loc2:*=mgs.aurora.modules.mpf.model.DialoguesHandlerProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.DialoguesHandlerProxy.NAME));
            loc2.create(mgs.aurora.common.utilities.GUID.create(), mgs.aurora.modules.mpf.enums.MPFDialogues.NOTIFICATION);
            return;
        }

        public static const NAME:String="NotificationDialogueMediator";

        internal var response:XML;

        internal var _displaying:Boolean;

        internal var _notificationQueue:__AS3__.vec.Vector.<XML>;
    }
}


//            class RegisterDialogueMediator
package mgs.aurora.modules.mpf.view 
{
    import flash.utils.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.events.multiplayer.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.mpf.enums.*;
    import mgs.aurora.modules.mpf.model.*;
    import mgs.aurora.modules.mpf.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class RegisterDialogueMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function RegisterDialogueMediator()
        {
            super(NAME, viewComponent);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.mpf.notifications.InternalNotifications.DISPLAY_REGISTER_DIALOGUE);
            loc1.push(mgs.aurora.modules.mpf.notifications.InternalNotifications.DIALOGUE_CREATED);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=arg1.getName();
            switch (loc2) 
            {
                case mgs.aurora.modules.mpf.notifications.InternalNotifications.DISPLAY_REGISTER_DIALOGUE:
                {
                    this._response = XML(arg1.getBody());
                    mgs.aurora.modules.mpf.model.DialoguesHandlerProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.DialoguesHandlerProxy.NAME)).create(mgs.aurora.common.utilities.GUID.create(), mgs.aurora.modules.mpf.enums.MPFDialogues.REGISTER);
                    break;
                }
                case mgs.aurora.modules.mpf.notifications.InternalNotifications.DIALOGUE_CREATED:
                {
                    loc1 = mgs.aurora.common.interfaces.dialogues.IDialogue(arg1.getBody());
                    if (arg1.getType() == mgs.aurora.modules.mpf.enums.MPFDialogues.REGISTER) 
                    {
                        this.registerDialogueCreated(loc1);
                    }
                    break;
                }
            }
            return;
        }

        public function registerDialogueCreated(arg1:mgs.aurora.common.interfaces.dialogues.IDialogue):void
        {
            var loc5:*=null;
            var loc8:*=null;
            var loc9:*=null;
            var loc10:*=null;
            var loc11:*=null;
            var loc1:*=mgs.aurora.modules.mpf.model.StringsProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StringsProxy.NAME));
            var loc2:*=mgs.aurora.modules.mpf.model.ConfigProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.ConfigProxy.NAME)).maxTitleLength;
            mgs.aurora.modules.mpf.model.SessionObjectProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME)).tournamentName = this._response.Resp.@name.toString();
            var loc3:*=this._response.Resp.@name.toString().length > loc2 ? this._response.Resp.@name.toString().substr(0, loc2) + "..." : this._response.Resp.@name.toString();
            arg1.title.text = loc3;
            var loc4:*;
            if ((loc4 = int(this._response.Resp.@buyIn) + int(this._response.Resp.@fee)) != 0) 
            {
                loc8 = loc1.getString(mgs.aurora.modules.mpf.enums.MPFDialogues.REGISTER_COST_STRING);
                loc10 = (loc9 = mgs.aurora.modules.mpf.model.CurrencyProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.CurrencyProxy.NAME))).getFormatFromISOCode(this._response.Resp.@currencyISO, loc9.standardFormat);
                (loc11 = new flash.utils.Dictionary())[mgs.aurora.modules.mpf.enums.MPFDialogues.REGISTER_COST_REPLACEMENT] = mgs.aurora.common.utilities.BalanceUtils.formatNumberToCurrencyDisplay(loc4, loc10);
                if (this._response.Resp.@currencyISO != this._response.Resp.@playerCurrencyISOCode) 
                {
                    loc10 = loc9.getFormatFromISOCode(this._response.Resp.@currencyISO, 0);
                    loc11[mgs.aurora.modules.mpf.enums.MPFDialogues.REGISTER_CREDITS_REPLACEMENT] = mgs.aurora.common.utilities.BalanceUtils.formatNumberToCreditsDisplay(this._response.Resp.@amtInPlayerCredits, loc10);
                    loc8 = loc8 + loc1.getString(mgs.aurora.modules.mpf.enums.MPFDialogues.REGISTER_CREDIT_STRING);
                }
                loc5 = mgs.aurora.common.utilities.StringUtils.replaceNamedVars(loc8, loc11);
            }
            else 
            {
                loc5 = loc1.getString(mgs.aurora.modules.mpf.enums.MPFDialogues.REGISTER_FREE_STRING);
            }
            arg1.texts.getText(mgs.aurora.modules.mpf.enums.MPFDialogues.TEXT1_MESSAGE).text = mgs.aurora.common.utilities.StringUtils.dialogueStringToHtml(loc5);
            var loc6:*;
            (loc6 = arg1.buttons.getButton(mgs.aurora.modules.mpf.enums.MPFDialogues.OK_BNT)).addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onYesSelected, false, 0, true);
            loc6.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onYesSelected, false, 0, true);
            var loc7:*;
            (loc7 = arg1.buttons.getButton(mgs.aurora.modules.mpf.enums.MPFDialogues.CANCEL_BNT)).addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onNoSelected, false, 0, true);
            loc7.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onNoSelected, false, 0, true);
            return;
        }

        internal function onNoSelected(arg1:*):void
        {
            this.removeDialogue(arg1.diagId);
            var loc1:*=mgs.aurora.modules.mpf.model.SessionObjectProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.SessionObjectProxy.NAME));
            mgs.aurora.modules.mpf.model.StatusProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.StatusProxy.NAME)).systemRegistration = false;
            sendNotification(mgs.aurora.modules.mpf.notifications.OutboundNotifications.PLAYER_REGISTERED_FAILED, new mgs.aurora.common.events.multiplayer.MPFPacketEvent(mgs.aurora.common.events.multiplayer.MPFPacketEvent.REGISTRATION_ERROR, loc1.serviceID, this._response));
            return;
        }

        internal function onYesSelected(arg1:*):void
        {
            this.removeDialogue(arg1.diagId);
            sendNotification(mgs.aurora.modules.mpf.notifications.InternalNotifications.REQUEST_REGISTRATION);
            return;
        }

        internal function removeDialogue(arg1:String):void
        {
            var loc1:*=mgs.aurora.modules.mpf.model.DialoguesHandlerProxy(facade.retrieveProxy(mgs.aurora.modules.mpf.model.DialoguesHandlerProxy.NAME));
            loc1.remove(arg1);
            return;
        }

        public static const NAME:String="RegisterDialogueMediator";

        internal var _response:XML;
    }
}


//          class MPF
package mgs.aurora.modules.mpf 
{
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.common.interfaces.magneto.*;
    import mgs.aurora.common.interfaces.multiplayer.*;
    import mgs.aurora.modules.mpf.model.vo.*;
    import mgs.aurora.modules.mpf.notifications.*;
    
    public class MPF extends flash.display.Sprite implements mgs.aurora.common.interfaces.multiplayer.IMPF
    {
        public function MPF()
        {
            super();
            if (stage) 
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
            this.addEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.dispose);
            this._facade = new mgs.aurora.modules.mpf.MPFFacade(mgs.aurora.modules.mpf.MPFFacade.NAME);
            this._facade.startup(this);
            return;
        }

        internal function dispose(arg1:flash.events.Event=null):void
        {
            return;
        }

        public function attemptConnections():void
        {
            this._facade.sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.ATTEMPT_CONNECTIONS);
            return;
        }

        public function attemptLobbyConnection():void
        {
            this._facade.sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.ATTEMPT_LOBBY_CONNECTION);
            return;
        }

        public function attemptRouterConnection():void
        {
            this._facade.sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.ATTEMPT_ROUTER_CONNECTION);
            return;
        }

        public function cancelAvatar(arg1:String):void
        {
            this._facade.sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.CANCEL_AVATAR, arg1);
            return;
        }

        public function fetchAvatarMetadata(arg1:String):void
        {
            this._facade.sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.FETCH_AVATAR_METADATA, arg1);
            return;
        }

        public function loadAvatar(arg1:String):void
        {
            this._facade.sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.LOAD_AVATAR, arg1);
            return;
        }

        public function sendPacket(arg1:String, arg2:uint, arg3:XML):void
        {
            this._facade.sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.SEND_PACKET, new mgs.aurora.modules.mpf.model.vo.SendPacketParams(arg1, arg2, arg3));
            return;
        }

        public function setup(arg1:XML, arg2:mgs.aurora.common.interfaces.magneto.IMagnetoPacketSender, arg3:Object, arg4:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler, arg5:XML, arg6:XML, arg7:flash.utils.Dictionary):void
        {
            this._facade.sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.SETUP, new mgs.aurora.modules.mpf.model.vo.SetupParams(arg1, mgs.aurora.common.interfaces.magneto.IMagneto(arg2), arg3, arg4, arg5, arg6, arg7));
            return;
        }

        public function closeConnection():void
        {
            this._facade.sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.CLOSE_CONNECTIONS);
            return;
        }

        public function attemptRegistration():void
        {
            this._facade.sendNotification(mgs.aurora.modules.mpf.notifications.InboundNotifications.ATTEMPT_REGISTRATION);
            return;
        }

        internal var _facade:mgs.aurora.modules.mpf.MPFFacade;
    }
}


//          class MPFFacade
package mgs.aurora.modules.mpf 
{
    import flash.display.*;
    import mgs.aurora.modules.mpf.controller.startup.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class MPFFacade extends org.puremvc.as3.multicore.patterns.facade.Facade implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function MPFFacade(arg1:String)
        {
            super(arg1);
            return;
        }

        public function startup(arg1:flash.display.Sprite):void
        {
            this.sendNotification(mgs.aurora.modules.mpf.MPFFacade.STARTUP, arg1);
            this.removeCommand(mgs.aurora.modules.mpf.MPFFacade.STARTUP);
            return;
        }

        protected override function initializeController():void
        {
            super.initializeController();
            this.registerCommand(mgs.aurora.modules.mpf.MPFFacade.STARTUP, mgs.aurora.modules.mpf.controller.startup.StartupCommand);
            return;
        }

        public static function getInstance(arg1:String):mgs.aurora.modules.mpf.MPFFacade
        {
            if (mgs.aurora.modules.mpf.MPFFacade._instance == null) 
            {
                mgs.aurora.modules.mpf.MPFFacade._instance = new MPFFacade(arg1);
            }
            return mgs.aurora.modules.mpf.MPFFacade._instance;
        }

        public static const NAME:String="MPFFacade";

        public static const STARTUP:String=NAME + "/notes/startup";

        internal static var _instance:mgs.aurora.modules.mpf.MPFFacade;
    }
}


