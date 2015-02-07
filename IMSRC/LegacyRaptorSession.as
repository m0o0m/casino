//ActionScript 3.0
//  package mgs
//    package aurora
//      package modules
//        package legacylogin
//          package controller
//            package changepassword
//              class AttemptChangePasswordCommand
package mgs.aurora.modules.legacylogin.controller.changepassword 
{
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.legacylogin.model.*;
    import mgs.aurora.modules.legacylogin.notifications.*;
    import mgs.aurora.modules.legacylogin.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class AttemptChangePasswordCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function AttemptChangePasswordCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            Logger.logMessage("AttemptChangePasswordCommand");
            if (arg1.getName() == mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.SHOW_CHANGE_PASSWORD_DIALOGUE) 
            {
                if (super.facade.hasProxy(mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy.NAME)) 
                {
                    loc1 = super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy.NAME) as mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy;
                    loc1.setData(arg1.getBody());
                }
                else 
                {
                    loc1 = new mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy(arg1.getBody());
                    super.facade.registerProxy(loc1);
                }
                mgs.aurora.modules.legacylogin.view.DialogueMediator(this.facade.retrieveMediator(mgs.aurora.modules.legacylogin.view.DialogueMediator.NAME)).showChangePasswordDialogue();
                return;
            }
            if (this.newPasswordBlank(arg1.getBody())) 
            {
                this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.CHANGE_PASSWORD_FAILED, "ErrorPwd4");
                return;
            }
            if (this.newAndCurrentMatch(arg1.getBody())) 
            {
                this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.CHANGE_PASSWORD_FAILED, "ErrorPwd1");
                return;
            }
            if (!this.newAndConfirmNewMatch(arg1.getBody())) 
            {
                this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.CHANGE_PASSWORD_FAILED, "ErrorPwd2");
                return;
            }
            if (!this.currentAndOldMatch(arg1.getBody())) 
            {
                this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.CHANGE_PASSWORD_FAILED, "ErrorPwd3");
                return;
            }
            this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_CHANGE_PASSWORD_FROM_DETAILS);
            return;
        }

        internal function newAndConfirmNewMatch(arg1:Object):Boolean
        {
            return mgs.aurora.common.utilities.StringUtils.compare(arg1.newPassword, arg1.confirmPassword);
        }

        internal function currentAndOldMatch(arg1:Object):Boolean
        {
            return mgs.aurora.common.utilities.StringUtils.compare(arg1.currentPassword, arg1.oldPassword);
        }

        internal function newAndCurrentMatch(arg1:Object):Boolean
        {
            return mgs.aurora.common.utilities.StringUtils.compare(arg1.currentPassword, arg1.newPassword);
        }

        internal function newPasswordBlank(arg1:Object):Boolean
        {
            return arg1.newPassword == "";
        }
    }
}


//              class BuildChangePasswordCommand
package mgs.aurora.modules.legacylogin.controller.changepassword 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.legacylogin.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BuildChangePasswordCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BuildChangePasswordCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc5:*=null;
            var loc1:*=super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy.NAME) as mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy;
            var loc2:*=loc1.getData() as Object;
            var loc3:*;
            (loc3 = new flash.utils.Dictionary())[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = this.buildPacket(loc2);
            loc3[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = VERB;
            loc3.packetID = mgs.aurora.modules.legacylogin.model.PacketIdProxy.CHANGE_PASSWORD_PACKET_ID;
            if (super.facade.hasProxy(mgs.aurora.modules.legacylogin.model.PacketIdProxy.NAME)) 
            {
                (loc5 = super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.PacketIdProxy.NAME) as mgs.aurora.modules.legacylogin.model.PacketIdProxy).setData(loc3.packetID);
            }
            else 
            {
                super.facade.registerProxy(new mgs.aurora.modules.legacylogin.model.PacketIdProxy(loc3.packetID));
            }
            var loc4:*;
            (loc4 = this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.XmanProxy.NAME) as mgs.aurora.modules.legacylogin.model.XmanProxy).sendPacket(loc3);
            return;
        }

        internal function buildPacket(arg1:Object):XML
        {
            var loc1:*=new XML("<Request>\r\n\t\t\t\t\t\t\t" + ("<ChangePwd NewPwd=\"" + arg1.newPassword + "\"/>") + "\r\n\t\t\t\t\t\t  </Request>");
            return loc1;
        }

        public static const VERB:String="ChangePwd";
    }
}


//              class ProcessChangePasswordResponseCommand
package mgs.aurora.modules.legacylogin.controller.changepassword 
{
    import mgs.aurora.common.enums.configMapping.*;
    import mgs.aurora.modules.legacylogin.model.*;
    import mgs.aurora.modules.legacylogin.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ProcessChangePasswordResponseCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ProcessChangePasswordResponseCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            Logger.logMessage("ProcessChangePasswordResponseCommand");
            var loc1:*=arg1.getBody() as XML;
            if (this.isSuccessfull(loc1.Response)) 
            {
                this.resetCurrentPassword();
                this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.CHANGE_PASSWORD_SUCCESSFULL);
            }
            else 
            {
                this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.CHANGE_PASSWORD_FAILED, "ErrorPwd4");
            }
            return;
        }

        internal function resetCurrentPassword():void
        {
            var loc1:*=mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy(super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy.NAME)).getData();
            var loc2:*=loc1.newPassword;
            loc1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTPASSWORD] = loc2;
            loc1.oldPassword = "";
            loc1.newPassword = "";
            loc1.confirmPassword = "";
            return;
        }

        internal function isSuccessfull(arg1:XMLList):Boolean
        {
            if (arg1.ChangePwd == undefined) 
            {
                return false;
            }
            if (int(arg1.ChangePwd.@Success) != CHANGE_PASSWORD_SUCCESS) 
            {
                return false;
            }
            return true;
        }

        public static const CHANGE_PASSWORD_FAIL:int=0;

        public static const CHANGE_PASSWORD_SUCCESS:int=1;
    }
}


//            package login
//              class AttemptLoginCommand
package mgs.aurora.modules.legacylogin.controller.login 
{
    import mgs.aurora.common.enums.configMapping.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.legacylogin.model.*;
    import mgs.aurora.modules.legacylogin.notifications.*;
    import mgs.aurora.modules.legacylogin.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class AttemptLoginCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function AttemptLoginCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc4:*=null;
            var loc2:*=arg1.getBody();
            if (super.facade.hasProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME)) 
            {
                loc1 = super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME) as mgs.aurora.modules.legacylogin.model.LoginRequestProxy;
                loc1.setData(loc2);
            }
            else 
            {
                loc1 = new mgs.aurora.modules.legacylogin.model.LoginRequestProxy(loc2);
                super.facade.registerProxy(loc1);
            }
            if (loc2[mgs.aurora.common.enums.configMapping.SessionConfig.EXT_AUTOLOGIN_CHECKBOX_VALUE] == "-1") 
            {
                if ((loc4 = mgs.aurora.common.utilities.FlashStorage.loadData("login", "autologin", "/")) == null) 
                {
                    loc4 = "0";
                }
                loc2[mgs.aurora.common.enums.configMapping.SessionConfig.EXT_AUTOLOGIN_CHECKBOX_VALUE] = loc4;
            }
            if (loc2[mgs.aurora.common.enums.configMapping.SessionConfig.AUTOLOGIN] == null) 
            {
                loc2[mgs.aurora.common.enums.configMapping.SessionConfig.AUTOLOGIN] = String(loc2[mgs.aurora.common.enums.configMapping.SessionConfig.EXT_AUTOLOGIN_CHECKBOX_VALUE]);
            }
            if (this.getSession(loc2) != "") 
            {
                super.facade.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_SESSION_LOGIN);
                return;
            }
            if (this.isDemo(loc2)) 
            {
                super.facade.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_FROM_DEMO_DETAILS);
                return;
            }
            if (this.externalLogin(loc2)) 
            {
                super.facade.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_FROM_DETAILS_EXTERNAL);
                return;
            }
            if (this.isAutoLogin(loc2)) 
            {
                super.facade.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_FROM_DETAILS_AUTO);
                return;
            }
            var loc3:*;
            (loc3 = mgs.aurora.modules.legacylogin.view.DialogueMediator(this.facade.retrieveMediator(mgs.aurora.modules.legacylogin.view.DialogueMediator.NAME))).showLoginDialogue();
            return;
        }

        internal function isAutoLogin(arg1:Object):Boolean
        {
            var loc5:*=false;
            var loc6:*=false;
            var loc1:*=mgs.aurora.common.utilities.StringUtils.stringToBoolean(mgs.aurora.common.utilities.FlashStorage.loadData("login", "autologin", "/"));
            var loc2:*=mgs.aurora.modules.legacylogin.model.LoginRequestProxy(facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME));
            Debugger.trace("AUTOLOGIN isAutoLogin " + loc1, "SYSTEM");
            if (loc1) 
            {
                if (loc2.allowAutoLogin == false) 
                {
                    this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.SAVE_AUTOLOGIN, false);
                    return false;
                }
            }
            else if (!(loc5 = arg1[mgs.aurora.common.enums.configMapping.SessionConfig.EXT_AUTOLOGIN_CHECKBOX_VALUE] == 1)) 
            {
                if (!(loc6 = int(arg1[mgs.aurora.common.enums.configMapping.SessionConfig.AUTOLOGIN]) == 1)) 
                {
                    this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.SAVE_AUTOLOGIN, false);
                    return false;
                }
            }
            var loc3:*=arg1[mgs.aurora.common.enums.configMapping.SessionConfig.SUSERNAME];
            var loc4:*=arg1[mgs.aurora.common.enums.configMapping.SessionConfig.SID3];
            if (loc3 == "" || loc4 == "" || loc3 == null || loc4 == null || loc3 == "null" || loc4 == "null") 
            {
                return false;
            }
            this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.SAVE_AUTOLOGIN, true);
            return true;
        }

        internal function isDemo(arg1:Object):Boolean
        {
            var loc1:*=int(arg1[mgs.aurora.common.enums.configMapping.SessionConfig.DEMO_PLAY]) == 1;
            var loc2:*=arg1[mgs.aurora.common.enums.configMapping.SessionConfig.EXTUSERNAME];
            var loc3:*=arg1[mgs.aurora.common.enums.configMapping.SessionConfig.EXTPASSWORD];
            if (loc2.toLowerCase() == "demo" && loc3.toLowerCase() == "demo") 
            {
                loc1 = true;
            }
            return loc1;
        }

        internal function externalLogin(arg1:Object):Boolean
        {
            var loc1:*=int(arg1[mgs.aurora.common.enums.configMapping.SessionConfig.EXTERNALLOGIN]);
            if (loc1 == 1 && !(arg1[mgs.aurora.common.enums.configMapping.SessionConfig.EXTUSERNAME] == "") && !(arg1[mgs.aurora.common.enums.configMapping.SessionConfig.EXTPASSWORD] == "")) 
            {
                return true;
            }
            return false;
        }

        internal function getSession(arg1:Object):String
        {
            var loc1:*=int(arg1[mgs.aurora.common.enums.configMapping.SessionConfig.LOGIN_BY_SESSIONID]);
            if (loc1 != 1) 
            {
                return "";
            }
            return arg1[mgs.aurora.common.enums.configMapping.SessionConfig.EXTSESSIONID];
        }
    }
}


//              class BuildLoginCommand
package mgs.aurora.modules.legacylogin.controller.login 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.enums.configMapping.*;
    import mgs.aurora.modules.legacylogin.model.*;
    import mgs.aurora.modules.legacylogin.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BuildLoginCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BuildLoginCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.legacylogin.model.LoginRequestProxy(super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME)).getData();
            var loc2:*=true;
            if (arg1.getName() != mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_FROM_DETAILS_EXTERNAL) 
            {
                if (arg1.getName() != mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_FROM_DEMO_DETAILS) 
                {
                    if (arg1.getName() == mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_FROM_DETAILS_AUTO) 
                    {
                        loc1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTUSERNAME] = String(loc1[mgs.aurora.common.enums.configMapping.SessionConfig.SUSERNAME]);
                        loc1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTPASSWORD] = String(loc1[mgs.aurora.common.enums.configMapping.SessionConfig.SID3]);
                        loc2 = false;
                    }
                }
                else 
                {
                    loc1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTUSERNAME] = "";
                    loc1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTPASSWORD] = "";
                    loc2 = false;
                }
            }
            else 
            {
                loc1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTUSERNAME] = loc1[mgs.aurora.common.enums.configMapping.SessionConfig.EXTUSERNAME];
                loc1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTPASSWORD] = loc1[mgs.aurora.common.enums.configMapping.SessionConfig.EXTPASSWORD];
                loc2 = false;
            }
            var loc3:*=this.buildPacket(loc1);
            Debugger.trace("loginPkt : " + loc3.toXMLString());
            var loc4:*;
            (loc4 = new flash.utils.Dictionary())[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = loc3;
            loc4[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = VERB;
            var loc5:*;
            (loc5 = this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.XmanProxy.NAME) as mgs.aurora.modules.legacylogin.model.XmanProxy).sendPacket(loc4, loc2);
            return;
        }

        internal function buildPacket(arg1:Object):XML
        {
            var loc1:*=new XML("<Request>\r\n\t\t\t\t\t\t\t" + ("<Credentials Name=\"" + arg1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTUSERNAME] + "\" Pass=\"" + arg1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTPASSWORD] + "\" clientType=\"" + arg1[mgs.aurora.common.enums.configMapping.SessionConfig.CLIENTTYPE] + "\"/>") + "\r\n\t\t\t\t\t\t\t" + ("<FC ID1=\"" + arg1[mgs.aurora.common.enums.configMapping.SessionConfig.ID1] + "\" IPAddress=\"" + arg1[mgs.aurora.common.enums.configMapping.SessionConfig.IPADDRESS] + "\" ID2=\"" + arg1[mgs.aurora.common.enums.configMapping.SessionConfig.ID2] + "\"/>") + "\r\n\t\t\t\t\t\t  </Request>");
            return loc1;
        }

        public static const VERB:String="Login";
    }
}


//              class BuildSessionLoginCommand
package mgs.aurora.modules.legacylogin.controller.login 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.enums.configMapping.*;
    import mgs.aurora.modules.legacylogin.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BuildSessionLoginCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BuildSessionLoginCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            Logger.logMessage("BuildSessionLoginCommand");
            var loc1:*=mgs.aurora.modules.legacylogin.model.LoginRequestProxy(super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME)).getData();
            loc1[mgs.aurora.common.enums.configMapping.SessionConfig.SESSIONID] = loc1[mgs.aurora.common.enums.configMapping.SessionConfig.EXTSESSIONID];
            var loc2:*=new flash.utils.Dictionary();
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = this.buildPacket();
            loc2[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = VERB;
            var loc3:*;
            (loc3 = this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.XmanProxy.NAME) as mgs.aurora.modules.legacylogin.model.XmanProxy).sendPacket(loc2, false);
            return;
        }

        internal function buildPacket():XML
        {
            var loc1:*=new XML("<Request/>");
            return loc1;
        }

        public static const VERB:String="GetBalance";
    }
}


//              class ProcessLoginErrorCommand
package mgs.aurora.modules.legacylogin.controller.login 
{
    import flash.display.*;
    import mgs.aurora.common.events.raptorSessions.*;
    import mgs.aurora.modules.legacylogin.model.*;
    import mgs.aurora.modules.legacylogin.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ProcessLoginErrorCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ProcessLoginErrorCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as XML;
            var loc2:*=int(loc1.Response.Error.@servercode);
            var loc3:*;
            (loc3 = mgs.aurora.modules.legacylogin.model.LegacyLoginProxy(this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LegacyLoginProxy.NAME)).stage).dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.ERROR, loc1));
            if (loc2 == mgs.aurora.modules.legacylogin.controller.login.ProcessLoginErrorCommand.CODE_PASSWORD_INCORRECT) 
            {
                this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.SHOW_LOGIN_ERROR_DIALOGUE, String(loc1.Response.Error.@text));
            }
            return;
        }

        public static const CODE_PASSWORD_INCORRECT:int=100;
    }
}


//              class ProcessLoginResponseCommand
package mgs.aurora.modules.legacylogin.controller.login 
{
    import flash.display.*;
    import flash.external.*;
    import mgs.aurora.common.enums.configMapping.*;
    import mgs.aurora.common.events.raptorSessions.*;
    import mgs.aurora.modules.legacylogin.model.*;
    import mgs.aurora.modules.legacylogin.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ProcessLoginResponseCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ProcessLoginResponseCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc5:*=null;
            var loc6:*=null;
            var loc1:*=arg1.getBody() as XML;
            Debugger.trace("ProcessLoginResponseCommand : " + loc1, "SYSTEM");
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME).getData();
            var loc3:*=this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy.NAME) as mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy;
            var loc4:*=mgs.aurora.modules.legacylogin.model.LegacyLoginProxy(this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LegacyLoginProxy.NAME)).stage;
            if (loc1.Response.hasOwnProperty("Mup") && !(loc1.Response.Mup.@mupIdentifier.toString() == "") && !(loc1.Response.Mup.@mupIdentifier == undefined)) 
            {
                loc2[mgs.aurora.common.enums.configMapping.SessionConfig.MIGRATION_MUPID] = loc1.Response.Mup.@mupIdentifier.toString();
                loc2[mgs.aurora.common.enums.configMapping.SessionConfig.MIGRATION_STATUS] = 0;
                (loc5 = new Object()).bms = 0;
                flash.external.ExternalInterface.call("saveExternalSettings", loc5);
                loc4.dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.LAUNCH_BRANDMIGRATION, loc2));
                return;
            }
            if (loc1.Response.hasOwnProperty("OldSingleSignOnName") && !(loc1.Response.OldSingleSignOnName.@name.toString() == "")) 
            {
                loc2[mgs.aurora.common.enums.configMapping.SessionConfig.MIGRATION_OLD_SINGLE_SIGNON_NAME] = uint(loc1.Response.Server.OldSingleSignOnName.@name.toString());
                loc2[mgs.aurora.common.enums.configMapping.SessionConfig.USERTYPE] = 0;
                loc2[mgs.aurora.common.enums.configMapping.SessionConfig.MIGRATION_STATUS] = 1;
                (loc6 = new Object()).bms = 1;
                flash.external.ExternalInterface.call("saveExternalSettings", loc6);
                loc4.dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.LAUNCH_BRANDMIGRATION, loc2));
                return;
            }
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.MIGRATION_STATUS] = 2;
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.AUTOLOGIN] = String(loc2[mgs.aurora.common.enums.configMapping.SessionConfig.EXT_AUTOLOGIN_CHECKBOX_VALUE]);
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.USERTYPE] = uint(loc1.Response.Credentials.@UserType);
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.SESSIONNUMBER] = uint(loc1.Response.Credentials.@SessionNumber);
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.BALANCE] = uint(loc1.Response.PlayerInfo.@Balance);
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.ID1] = loc1.Response.FC.@ID1.toString();
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.SESSIONID] = loc1.Id.@sessionid.toString();
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.SESSION_AUTHENTICATION_TOKEN] = loc1.Response.SessionAuthentication.@token.toString();
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.SESSION_USERID] = loc1.Response.SessionAuthentication.@userId.toString();
            if (loc3.isManualLogin) 
            {
                this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.SAVE_AUTOLOGIN, loc3.autoLogin);
            }
            this.saveToExternal(loc2, loc3);
            loc4.dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.LOGIN_SUCCESSFULL, loc2));
            return;
        }

        internal function saveToExternal(arg1:Object, arg2:mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy):void
        {
            var loc1:*=new Object();
            loc1.cln = String(arg1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTUSERNAME]);
            loc1.nUserType = String(arg1[mgs.aurora.common.enums.configMapping.SessionConfig.USERTYPE]);
            loc1.sID1 = String(arg1[mgs.aurora.common.enums.configMapping.SessionConfig.ID1]);
            if (arg2.isManualLogin) 
            {
                loc1.crecall = "0";
                loc1.cpw = "";
                if (arg2.rememberPassword) 
                {
                    loc1.crecall = "1";
                    loc1.cpw = String(arg1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTPASSWORD]);
                }
            }
            if (arg1[mgs.aurora.common.enums.configMapping.SessionConfig.MIGRATION_EXTERNAL] == "1") 
            {
                arg1[mgs.aurora.common.enums.configMapping.SessionConfig.MIGRATION_EXTERNAL] = "0";
                loc1.crecall = "1";
                loc1.cpw = String(arg1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTPASSWORD]);
            }
            flash.external.ExternalInterface.call("saveExternalSettings", loc1);
            return;
        }
    }
}


//              class ProcessSessionLoginResponseCommand
package mgs.aurora.modules.legacylogin.controller.login 
{
    import flash.display.*;
    import mgs.aurora.common.enums.configMapping.*;
    import mgs.aurora.common.events.raptorSessions.*;
    import mgs.aurora.modules.legacylogin.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ProcessSessionLoginResponseCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ProcessSessionLoginResponseCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as XML;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME).getData();
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.AUTOLOGIN] = String(loc2[mgs.aurora.common.enums.configMapping.SessionConfig.EXT_AUTOLOGIN_CHECKBOX_VALUE]);
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.BALANCE] = uint(loc1.Response.PlayerInfo.@Balance);
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.USERTYPE] = loc2[mgs.aurora.common.enums.configMapping.SessionConfig.EXTUSERTYPE];
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTUSERNAME] = loc2[mgs.aurora.common.enums.configMapping.SessionConfig.EXTUSERNAME];
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTPASSWORD] = loc2[mgs.aurora.common.enums.configMapping.SessionConfig.EXTPASSWORD];
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.SESSION_AUTHENTICATION_TOKEN] = loc2[mgs.aurora.common.enums.configMapping.SessionConfig.EXT_SESSION_TOKEN];
            loc2[mgs.aurora.common.enums.configMapping.SessionConfig.SESSION_USERID] = loc2[mgs.aurora.common.enums.configMapping.SessionConfig.EXT_SESSION_USERID];
            var loc3:*;
            (loc3 = mgs.aurora.modules.legacylogin.model.LegacyLoginProxy(this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LegacyLoginProxy.NAME)).stage).dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.LOGIN_SUCCESSFULL, loc2));
            return;
        }
    }
}


//              class SaveAutoLoginCommand
package mgs.aurora.modules.legacylogin.controller.login 
{
    import mgs.aurora.common.utilities.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SaveAutoLoginCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SaveAutoLoginCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as Boolean;
            mgs.aurora.common.utilities.FlashStorage.saveData("login", "autologin", loc1 ? "1" : "0", "/");
            return;
        }
    }
}


//            class StartupCommand
package mgs.aurora.modules.legacylogin.controller 
{
    import mgs.aurora.modules.legacylogin.model.*;
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
            this.facade.registerProxy(new mgs.aurora.modules.legacylogin.model.LegacyLoginProxy(arg1.getBody()));
            return;
        }
    }
}


//          package enums
//            class DialogueDefinition
package mgs.aurora.modules.legacylogin.enums 
{
    public class DialogueDefinition extends Object
    {
        public function DialogueDefinition()
        {
            super();
            return;
        }

        public static const LEGACY_LOGIN_SERVER_CONNECT:String="legacy_login_server_connect";

        public static const LOGIN_LOGINNAME:String="LoginName";

        public static const LOGIN_PASSWORD:String="Password";

        public static const LOGIN_REMEMBERPASSWORD:String="RememberPassword";

        public static const LOGIN_AUTOLOGIN:String="AutoLogin";

        public static const CHG_PWD_ACCOUNT:String="Account";

        public static const CHG_PWD_OLD_PASSWORD:String="OldPassword";

        public static const CHG_PWD_NEW_PASSWORD:String="NewPassword";

        public static const CHG_PWD_CONFIRM_NEW_PASSWORD:String="ConNewPassword";

        public static const LOGIN_FORGOTPASSWORD:String="forgotPassword";

        public static const TITLE:String="title";

        public static const BACKGROUND:String="background";

        public static const ICON1:String="icon1";

        public static const STATIC1:String="static1";

        public static const STATIC2:String="static2";

        public static const STATIC3:String="static3";

        public static const OK:String="OK";

        public static const CANCEL:String="CANCEL";

        public static const MESS:String="MESS";

        public static const REG:String="REG";

        public static const REALRADIO:String="REALRADIO";

        public static const GUESTRADIO:String="GUESTRADIO";

        public static const YES:String="YES";

        public static const NO:String="NO";

        public static const DIALOGUE_LOGIN_NAME:String="legacyLogin";

        public static const DIALOGUE_LOGIN_ERROR:String="legacyLoginError";

        public static const DIALOGUE_CHANGE_PASSWORD_NAME:String="changePassword";

        public static const DIALOGUE_CHANGE_PASSWORD_ERROR_NAME:String="changePasswordError";

        public static const DIALOGUE_CHANGE_PASSWORD_SUCCESS_NAME:String="changePasswordSuccess";

        public static const DIALOGUE_REGISTER1:String="register1";

        public static const DIALOGUE_REGISTER2:String="register2";
    }
}


//          package model
//            class ChangePasswordRequestProxy
package mgs.aurora.modules.legacylogin.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class ChangePasswordRequestProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function ChangePasswordRequestProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public static const NAME:String="ChangePasswordRequestProxy";
    }
}


//            class DialogueDetailsProxy
package mgs.aurora.modules.legacylogin.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class DialogueDetailsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function DialogueDetailsProxy(arg1:Object=null)
        {
            super(NAME, new Object());
            return;
        }

        public function get rememberPassword():Boolean
        {
            return this._rememberPassword;
        }

        public function set rememberPassword(arg1:Boolean):void
        {
            this._rememberPassword = arg1;
            return;
        }

        public function get autoLogin():Boolean
        {
            return this._autoLogin;
        }

        public function set autoLogin(arg1:Boolean):void
        {
            this._autoLogin = arg1;
            return;
        }

        public function get isManualLogin():Boolean
        {
            return this._isManualLogin;
        }

        public function set isManualLogin(arg1:Boolean):void
        {
            this._isManualLogin = arg1;
            return;
        }

        public static const NAME:String="DialogueDetailsProxy";

        internal var _rememberPassword:Boolean;

        internal var _autoLogin:Boolean;

        internal var _isManualLogin:Boolean;
    }
}


//            class LegacyLoginProxy
package mgs.aurora.modules.legacylogin.model 
{
    import flash.display.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class LegacyLoginProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function LegacyLoginProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public function get stage():flash.display.Sprite
        {
            return this.data as flash.display.Sprite;
        }

        public static const NAME:String="LegacyLoginProxy";
    }
}


//            class LoginRequestProxy
package mgs.aurora.modules.legacylogin.model 
{
    import mgs.aurora.common.enums.configMapping.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class LoginRequestProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function LoginRequestProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public function get allowForgotPassword():Boolean
        {
            return int(data[mgs.aurora.common.enums.configMapping.SessionConfig.ALLOW_FORGOT_PASSWORD]) == 1;
        }

        public function get allowRememberPassword():Boolean
        {
            return int(data[mgs.aurora.common.enums.configMapping.SessionConfig.ALLOW_REMEMBER_PASSWORD]) == 1;
        }

        public function get allowAutoLogin():Boolean
        {
            return int(data[mgs.aurora.common.enums.configMapping.SessionConfig.SHOW_AUTOLOGIN_CHECKBOX]) == 1 && int(data[mgs.aurora.common.enums.configMapping.SessionConfig.ALLOW_REMEMBER_PASSWORD]) == 1;
        }

        public static const NAME:String="LoginDataProxy";
    }
}


//            class PacketIdProxy
package mgs.aurora.modules.legacylogin.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class PacketIdProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function PacketIdProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public static const NAME:String="PacketIdProxy";

        public static const LOGIN_PACKET_ID:String=NAME + "/PacketIdProxy/login_packet_id";

        public static const CHANGE_PASSWORD_PACKET_ID:String=NAME + "/PacketIdProxy/change_password_packet_id";

        public static const BALANCE_PACKET_ID:String=NAME + "/PacketIdProxy/balance_packet_id";
    }
}


//            class XmanProxy
package mgs.aurora.modules.legacylogin.model 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.modules.legacylogin.*;
    import mgs.aurora.modules.legacylogin.controller.changepassword.*;
    import mgs.aurora.modules.legacylogin.controller.login.*;
    import mgs.aurora.modules.legacylogin.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class XmanProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function XmanProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            this.init();
            return;
        }

        public function get xman():mgs.aurora.common.interfaces.comms.IXManPacketSender
        {
            return this.data as mgs.aurora.common.interfaces.comms.IXManPacketSender;
        }

        public function sendPacket(arg1:flash.utils.Dictionary, arg2:Boolean=true):void
        {
            arg1[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] = MODULEID;
            arg1[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] = CLIENTID;
            arg1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] = mgs.aurora.modules.legacylogin.LegacyLogin.NAME;
            arg1[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] = mgs.aurora.modules.legacylogin.LegacyLogin.NAME;
            arg1[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] = true;
            if (arg2) 
            {
                this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.DISPLAY_SERVER_CONNECT_DIALOGUE);
            }
            this.xman.sendPacket(arg1);
            return;
        }

        internal function init():void
        {
            this.xman.addEventListener(mgs.aurora.modules.legacylogin.LegacyLogin.NAME, this.onPacketResponse);
            this.xman.addEventListener(mgs.aurora.common.events.comms.XManEvent.ERROR, this.onError);
            this.xman.addEventListener(mgs.aurora.common.events.comms.XManEvent.PACKET_SENT, this.onGeneralEvent);
            return;
        }

        internal function onError(arg1:mgs.aurora.common.events.comms.XManEvent):void
        {
            this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.REMOVE_SERVER_CONNECT_DIALOGUE);
            return;
        }

        internal function onGeneralEvent(arg1:mgs.aurora.common.events.comms.XManEvent):void
        {
            return;
        }

        internal function onPacketResponse(arg1:mgs.aurora.common.events.comms.PacketEvent):void
        {
            this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.REMOVE_SERVER_CONNECT_DIALOGUE);
            if (arg1.packetID != mgs.aurora.modules.legacylogin.LegacyLogin.NAME) 
            {
                Debugger.trace(mgs.aurora.modules.legacylogin.LegacyLogin.NAME + " : Packet Not Expected : " + arg1.moduleID + " : " + arg1.packetID);
            }
            else 
            {
                var loc1:*=String(arg1.response.Id.@verb);
                switch (loc1) 
                {
                    case mgs.aurora.modules.legacylogin.controller.login.BuildSessionLoginCommand.VERB:
                    {
                        this.facade.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_SESSION_LOGIN_RESPONSE, arg1.response);
                        break;
                    }
                    case mgs.aurora.modules.legacylogin.controller.login.BuildLoginCommand.VERB:
                    {
                        this.facade.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_RESPONSE, arg1.response);
                        break;
                    }
                    case mgs.aurora.modules.legacylogin.controller.changepassword.BuildChangePasswordCommand.VERB:
                    {
                        this.facade.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_CHANGE_PASSWORD_RESPONSE, arg1.response);
                        break;
                    }
                    case mgs.aurora.modules.legacylogin.model.XmanProxy.ERROR_VERB:
                    {
                        this.facade.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_ERROR, arg1.response);
                        break;
                    }
                    default:
                    {
                        break;
                    }
                }
            }
            return;
        }

        public static const NAME:String="XmanProxy";

        public static const MODULEID:String="1";

        public static const CLIENTID:String="10001";

        public static const ERROR_VERB:String="Error";
    }
}


//          package notifications
//            class LegacyLoginNotifications
package mgs.aurora.modules.legacylogin.notifications 
{
    public class LegacyLoginNotifications extends Object
    {
        public function LegacyLoginNotifications()
        {
            super();
            return;
        }

        public static const NAME:String="LegacyLoginNotifications";

        public static const STARTUP:String=NAME + "/notes/startup";

        public static const ATTEMPT_LOGIN:String=NAME + "/notes/attempt_login";

        public static const ATTEMPT_CHANGE_PASSWORD:String=NAME + "/notes/change_password";

        public static const PACKET_REQUEST:String=NAME + "/notes/packet_request";

        public static const LOGIN_SUCCESSFULL:String=NAME + "/notes/login_successfull";

        public static const CHANGE_PASSWORD_FAILED:String=NAME + "/notes/change_password_failed";

        public static const CHANGE_PASSWORD_SUCCESSFULL:String=NAME + "/notes/change_password_successfull";

        public static const SET_XMAN_SESSIONID:String=NAME + "/notes/set_xman_sessionid";

        public static const PROCESS_SESSION_LOGIN:String=NAME + "/notes/process_session_login";

        public static const PROCESS_SESSION_LOGIN_RESPONSE:String=NAME + "/notes/process_session_login_response";

        public static const PROCESS_LOGIN_FROM_DETAILS_EXTERNAL:String=NAME + "/notes/process_login_from_details_external";

        public static const PROCESS_LOGIN_FROM_DETAILS_AUTO:String=NAME + "/notes/process_login_from_details_auto";

        public static const PROCESS_LOGIN_FROM_DIALOGUE:String=NAME + "/notes/process_login_from_dialogue";

        public static const PROCESS_LOGIN_FROM_DEMO_DETAILS:String=NAME + "/notes/process_login_from_demo_details";

        public static const PROCESS_LOGIN_RESPONSE:String=NAME + "/notes/process_login_response";

        public static const PROCESS_LOGIN_RESPONSE_AFTER_GUEST_PROMPT:String=NAME + "/notes/process_login_response_after_guest_prompt";

        public static const PROCESS_LOGIN_ERROR:String=NAME + "/notes/process_login_error";

        public static const SHOW_LOGIN_ERROR_DIALOGUE:String=NAME + "/notes/show_login_error_dialogue";

        public static const PROCESS_CHANGE_PASSWORD_FROM_DETAILS:String=NAME + "/notes/process_change_password_from_details";

        public static const SHOW_CHANGE_PASSWORD_DIALOGUE:String=NAME + "/notes/show_change_password_dialogue";

        public static const PROCESS_CHANGE_PASSWORD_RESPONSE:String=NAME + "/notes/process_change_password_response";

        public static const DISPLAY_SERVER_CONNECT_DIALOGUE:String=NAME + "/notes/display_server_connect_dialogue";

        public static const REMOVE_SERVER_CONNECT_DIALOGUE:String=NAME + "/notes/remove_server_connect_dialogue";

        public static const DISPLAY_GUEST_PROMPT_FOR_REAL_PLAY:String=NAME + "/notes/guest_prompt_for_real_play";

        public static const SAVE_AUTOLOGIN:String=NAME + "/notes/save_autologin";
    }
}


//          package view
//            class DialogueMediator
package mgs.aurora.modules.legacylogin.view 
{
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.enums.configMapping.*;
    import mgs.aurora.common.enums.raptorSession.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.events.raptorSessions.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.legacylogin.enums.*;
    import mgs.aurora.modules.legacylogin.model.*;
    import mgs.aurora.modules.legacylogin.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class DialogueMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function DialogueMediator(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        internal function onLoginCheckBoxChange(arg1:mgs.aurora.common.events.dialogues.DialogueSelectionEvent):void
        {
            var loc4:*=null;
            var loc5:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy.NAME) as mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy;
            var loc2:*=this._dialogueHandler.dialogue(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_NAME).checkBoxes;
            var loc3:*;
            if ((loc3 = arg1.control as mgs.aurora.common.interfaces.controls.ICheckBox).id != mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LOGIN_REMEMBERPASSWORD) 
            {
                if (loc3.id == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LOGIN_AUTOLOGIN) 
                {
                    loc1.autoLogin = loc3.checked;
                    if (loc1.autoLogin && !loc1.rememberPassword) 
                    {
                        loc5 = loc2.getCheckBox(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LOGIN_REMEMBERPASSWORD);
                        loc5.checked = loc6 = true;
                        loc1.rememberPassword = loc6;
                    }
                }
            }
            else 
            {
                loc1.rememberPassword = loc3.checked;
                if (!loc1.rememberPassword) 
                {
                    loc4 = loc2.getCheckBox(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LOGIN_AUTOLOGIN);
                    var loc6:*;
                    loc4.checked = loc6 = false;
                    loc1.autoLogin = loc6;
                }
            }
            return;
        }

        internal function onLoginDialogueButtonAction(arg1:*):void
        {
            var loc3:*=null;
            var loc4:*=0;
            var loc5:*=0;
            var loc6:*=null;
            var loc1:*=this._diagDictionary[arg1.diagId];
            var loc2:*=loc1.texts.getInputText(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LOGIN_LOGINNAME).text;
            if (arg1.control.id != mgs.aurora.modules.legacylogin.enums.DialogueDefinition.OK) 
            {
                if (arg1.control.id != mgs.aurora.modules.legacylogin.enums.DialogueDefinition.REG) 
                {
                    if (arg1.control.id != mgs.aurora.modules.legacylogin.enums.DialogueDefinition.CANCEL) 
                    {
                        if (arg1.control.id == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LOGIN_FORGOTPASSWORD) 
                        {
                            mgs.aurora.modules.legacylogin.model.LegacyLoginProxy(this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LegacyLoginProxy.NAME)).stage.dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.LAUNCH_FORGOTPASSWORD, loc2));
                            return;
                        }
                        this.remove(arg1.diagId);
                    }
                    else 
                    {
                        (loc6 = mgs.aurora.modules.legacylogin.model.LegacyLoginProxy(this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LegacyLoginProxy.NAME)).stage).dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.EXIT, null));
                    }
                }
                else 
                {
                    loc3 = mgs.aurora.modules.legacylogin.model.LoginRequestProxy(super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME)).getData();
                    loc4 = int(loc3[mgs.aurora.common.enums.configMapping.SessionConfig.ID4]);
                    this.remove(arg1.diagId);
                    if ((loc5 = uint(loc3[mgs.aurora.common.enums.configMapping.SessionConfig.BYPASS_REGDIAG])) == 0) 
                    {
                        if (loc4 == 1) 
                        {
                            this.showRegister2();
                            return;
                        }
                        this.showRegister1();
                        return;
                    }
                    mgs.aurora.modules.legacylogin.model.LegacyLoginProxy(this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LegacyLoginProxy.NAME)).stage.dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.LAUNCH_ORL, mgs.aurora.common.enums.raptorSession.OlrTypes.OLR_REAL));
                }
            }
            else 
            {
                this.doLogin(arg1.diagId);
            }
            return;
        }

        internal function onChangePasswordDialogueButtonAction(arg1:*):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            if (arg1.control.id != mgs.aurora.modules.legacylogin.enums.DialogueDefinition.OK) 
            {
                if (arg1.control.id == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.CANCEL) 
                {
                    this.remove(arg1.diagId);
                }
            }
            else 
            {
                loc1 = mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy(facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy.NAME)).getData();
                loc2 = loc1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTPASSWORD];
                loc3 = this._diagDictionary[mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_NAME].texts;
                loc1.currentPassword = loc2;
                loc1.oldPassword = loc3.getInputText(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.CHG_PWD_OLD_PASSWORD).text;
                loc1.newPassword = loc3.getInputText(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.CHG_PWD_NEW_PASSWORD).text;
                loc1.confirmPassword = loc3.getInputText(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.CHG_PWD_CONFIRM_NEW_PASSWORD).text;
                this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.ATTEMPT_CHANGE_PASSWORD, loc1);
            }
            return;
        }

        internal function onErrorSuccessDialogueButtonAction(arg1:*):void
        {
            if (arg1.diagId != mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_SUCCESS_NAME) 
            {
                this.remove(arg1.diagId);
                if (arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_ERROR) 
                {
                    this.checkAndResetAutoLogin();
                }
            }
            else 
            {
                this.removeAll();
            }
            return;
        }

        internal function onRegisterDialogueButtonAction(arg1:*):void
        {
            var loc1:*=mgs.aurora.modules.legacylogin.model.LegacyLoginProxy(this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LegacyLoginProxy.NAME)).stage;
            if (arg1.control.id == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.CANCEL || arg1.control.id == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.NO) 
            {
                if (this._sendLoginResponseAfterGuestPrompt) 
                {
                    this.remove(arg1.diagId);
                    this._sendLoginResponseAfterGuestPrompt = false;
                    this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_RESPONSE_AFTER_GUEST_PROMPT, this._loginPkt);
                    return;
                }
                this.showLoginDialogue();
            }
            else if (arg1.control.id != mgs.aurora.modules.legacylogin.enums.DialogueDefinition.OK) 
            {
                if (arg1.control.id == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.YES) 
                {
                    loc1.dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.LAUNCH_ORL, mgs.aurora.common.enums.raptorSession.OlrTypes.OLR_REAL));
                }
            }
            else if (mgs.aurora.common.interfaces.dialogues.IDialogue(this._diagDictionary[mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_REGISTER1]).radioButtons.getRadioButton(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.REALRADIO).selected) 
            {
                loc1.dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.LAUNCH_ORL, mgs.aurora.common.enums.raptorSession.OlrTypes.OLR_REAL));
            }
            else 
            {
                loc1.dispatchEvent(new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(mgs.aurora.common.events.raptorSessions.RaptorSessionEvent.LAUNCH_ORL, mgs.aurora.common.enums.raptorSession.OlrTypes.OLR_GUEST));
            }
            this.remove(arg1.diagId);
            return;
        }

        public function showChangePasswordDialogue():void
        {
            this.create(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_NAME, "ChangePassword");
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.CHANGE_PASSWORD_FAILED);
            loc1.push(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.CHANGE_PASSWORD_SUCCESSFULL);
            loc1.push(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.DISPLAY_SERVER_CONNECT_DIALOGUE);
            loc1.push(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.REMOVE_SERVER_CONNECT_DIALOGUE);
            loc1.push(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.SHOW_LOGIN_ERROR_DIALOGUE);
            loc1.push(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.DISPLAY_GUEST_PROMPT_FOR_REAL_PLAY);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getName();
            switch (loc1) 
            {
                case mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.CHANGE_PASSWORD_FAILED:
                {
                    this.showChangePasswordErrorDialogue(arg1.getBody() as String);
                    break;
                }
                case mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.CHANGE_PASSWORD_SUCCESSFULL:
                {
                    this.showChangePasswordSuccessDialogue();
                    break;
                }
                case mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.DISPLAY_SERVER_CONNECT_DIALOGUE:
                {
                    this.showServerConnect(true);
                    break;
                }
                case mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.REMOVE_SERVER_CONNECT_DIALOGUE:
                {
                    this.showServerConnect(false);
                    break;
                }
                case mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.SHOW_LOGIN_ERROR_DIALOGUE:
                {
                    this.showLoginResponseErrorDialogue(arg1.getBody() as String);
                    break;
                }
                case mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.DISPLAY_GUEST_PROMPT_FOR_REAL_PLAY:
                {
                    this._loginPkt = arg1.getBody() as XML;
                    this._sendLoginResponseAfterGuestPrompt = true;
                    this.showRegister2();
                    break;
                }
                default:
                {
                    break;
                }
            }
            return;
        }

        public override function onRegister():void
        {
            super.onRegister();
            this._sendLoginResponseAfterGuestPrompt = false;
            this._diagDictionary = new flash.utils.Dictionary();
            this._dialogueHandler = this.viewComponent as mgs.aurora.common.interfaces.dialogues.IDialoguesHandler;
            this._dialogueHandler.addEventListener(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.DIALOGUE_CREATED, this.onDialogueCreated);
            this._dialogueHandler.addEventListener(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.DIALOGUE_DISPLAYED, this.onDialogueDisplayed);
            this._dialogueHandler.addEventListener(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.DIALOGUE_REMOVED, this.onDialogueRemoved);
            this.facade.registerProxy(new mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy());
            return;
        }

        public function showLoginDialogue(arg1:Boolean=false):void
        {
            this._loginAfterError = arg1;
            var loc1:*=mgs.aurora.modules.legacylogin.model.LoginRequestProxy(super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME)).getData();
            var loc2:*=int(loc1[mgs.aurora.common.enums.configMapping.SessionConfig.ID4]);
            var loc3:*=int(loc1[mgs.aurora.common.enums.configMapping.SessionConfig.DISABLEFCCOMPONENTS]);
            var loc4:*=int(loc1[mgs.aurora.common.enums.configMapping.SessionConfig.SHOWREG_ON_LOGIN]);
            if (loc3 == 0 && loc2 == 0) 
            {
                this.create(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_NAME, "Login");
            }
            else if (loc4 != 1) 
            {
                this.create(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_NAME, "Login");
            }
            else 
            {
                this.create(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_NAME, "RegLogin");
            }
            var loc5:*;
            (loc5 = mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy(this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy.NAME))).isManualLogin = true;
            this.dispatchEvent(new mgs.aurora.common.events.SystemPreloaderEvent(mgs.aurora.common.events.SystemPreloaderEvent.HIDE));
            return;
        }

        public function showLoginResponseErrorDialogue(arg1:String):void
        {
            this._currentLoginError = arg1;
            this.create(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_ERROR, "Error");
            return;
        }

        internal function checkAndResetAutoLogin():void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy.NAME) as mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy;
            if (loc1.autoLogin) 
            {
                loc1.autoLogin = false;
                loc2 = mgs.aurora.modules.legacylogin.model.LoginRequestProxy(super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME)).getData();
                loc2[mgs.aurora.common.enums.configMapping.SessionConfig.AUTOLOGIN] = 0;
                loc2[mgs.aurora.common.enums.configMapping.SessionConfig.MIGRATION_STATUS] = "";
                loc3 = mgs.aurora.modules.legacylogin.model.LegacyLoginProxy(this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LegacyLoginProxy.NAME)).stage;
                loc3.dispatchEvent(new mgs.aurora.common.events.SystemStoreEvent(mgs.aurora.common.events.SystemStoreEvent.STORENAMEVALUE, mgs.aurora.common.enums.StorageNames.LOGIN_AUTOLOGIN, "0"));
            }
            this.showLoginDialogue(true);
            return;
        }

        public function showChangePasswordErrorDialogue(arg1:String):void
        {
            this.create(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_ERROR_NAME, arg1);
            return;
        }

        public function showChangePasswordSuccessDialogue():void
        {
            this.create(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_SUCCESS_NAME, "ConfirmPwd");
            return;
        }

        public function showServerConnect(arg1:Boolean):void
        {
            if (arg1) 
            {
                this.create(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LEGACY_LOGIN_SERVER_CONNECT, "ServerConnect");
            }
            else 
            {
                this.remove(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LEGACY_LOGIN_SERVER_CONNECT);
            }
            return;
        }

        public function showRegister1():void
        {
            this.create(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_REGISTER1, "Register1");
            return;
        }

        public function showRegister2():void
        {
            this.create(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_REGISTER2, "Register2");
            return;
        }

        public function get art():flash.display.LoaderInfo
        {
            return this._dialogueHandler.art;
        }

        public function set art(arg1:flash.display.LoaderInfo):void
        {
            this._dialogueHandler.art = arg1;
            return;
        }

        public function get artLang():flash.display.LoaderInfo
        {
            return this._dialogueHandler.artLang;
        }

        public function set artLang(arg1:flash.display.LoaderInfo):void
        {
            this._dialogueHandler.artLang = arg1;
            return;
        }

        public function get displayedList():String
        {
            return this._dialogueHandler.displayedList;
        }

        public function get fonts():flash.display.LoaderInfo
        {
            return this._dialogueHandler.fonts;
        }

        public function set fonts(arg1:flash.display.LoaderInfo):void
        {
            this._dialogueHandler.fonts = arg1;
            return;
        }

        public function get layoutConfig():XML
        {
            return this._dialogueHandler.layoutConfig;
        }

        public function set layoutConfig(arg1:XML):void
        {
            this._dialogueHandler.layoutConfig = arg1;
            return;
        }

        public function get uiConfig():XML
        {
            return this._dialogueHandler.uiConfig;
        }

        public function set uiConfig(arg1:XML):void
        {
            this._dialogueHandler.uiConfig = arg1;
            return;
        }

        public function get globalNumDisplayed():int
        {
            return this._dialogueHandler.globalNumDisplayed;
        }

        public function get id():String
        {
            return this._dialogueHandler.id;
        }

        public function get numDisplayed():int
        {
            return this._dialogueHandler.numDisplayed;
        }

        public function dialogue(arg1:String):mgs.aurora.common.interfaces.dialogues.IDialogue
        {
            return this._dialogueHandler.dialogue(arg1);
        }

        public function remove(arg1:String):void
        {
            this._dialogueHandler.remove(arg1);
            return;
        }

        public function removeAll():void
        {
            this._dialogueHandler.removeAll();
            return;
        }

        public function create(arg1:String, arg2:String, arg3:flash.display.DisplayObjectContainer=null, arg4:XMLList=null, arg5:XMLList=null, arg6:flash.display.LoaderInfo=null, arg7:flash.display.LoaderInfo=null, arg8:flash.display.LoaderInfo=null):void
        {
            this._dialogueHandler.create(arg1, arg2, arg3, arg4, arg5, arg6, arg7, arg8);
            return;
        }

        public function addEventListener(arg1:String, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            this._dialogueHandler.addEventListener(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public function dispatchEvent(arg1:flash.events.Event):Boolean
        {
            return this._dialogueHandler.dispatchEvent(arg1);
        }

        public function hasEventListener(arg1:String):Boolean
        {
            return this._dialogueHandler.hasEventListener(arg1);
        }

        public function removeEventListener(arg1:String, arg2:Function, arg3:Boolean=false):void
        {
            this._dialogueHandler.removeEventListener(arg1, arg2, arg3);
            return;
        }

        public function willTrigger(arg1:String):Boolean
        {
            return this._dialogueHandler.willTrigger(arg1);
        }

        internal function doLogin(arg1:String):void
        {
            Debugger.trace(NAME + " : doLogin : ");
            var loc1:*=mgs.aurora.modules.legacylogin.model.LoginRequestProxy(super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME)).getData();
            loc1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTUSERNAME] = this._diagDictionary[mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_NAME].texts.getText("LoginName").text;
            loc1[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTPASSWORD] = this._diagDictionary[mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_NAME].texts.getText("Password").text;
            this.remove(arg1);
            this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_FROM_DIALOGUE);
            return;
        }

        internal function onDialogueRemoved(arg1:mgs.aurora.common.events.dialogues.DialoguesHandlerEvent):void
        {
            Debugger.trace(NAME + " : onDialogueRemoved : " + arg1.diagId);
            return;
        }

        internal function onDialogueCreated(arg1:mgs.aurora.common.events.dialogues.DialoguesHandlerEvent):void
        {
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=null;
            var loc7:*=null;
            var loc8:*=null;
            var loc9:*=null;
            var loc10:*=null;
            var loc11:*=null;
            var loc12:*=null;
            var loc13:*=0;
            var loc14:*=null;
            var loc15:*=null;
            var loc16:*=null;
            var loc17:*=null;
            var loc18:*=null;
            this._diagDictionary[arg1.diagId] = this.dialogue(arg1.diagId);
            if (arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_ERROR_NAME || arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_SUCCESS_NAME || arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LEGACY_LOGIN_SERVER_CONNECT || arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_REGISTER1 || arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_REGISTER2) 
            {
                return;
            }
            var loc1:*=mgs.aurora.modules.legacylogin.model.LoginRequestProxy(facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME));
            var loc2:*=this._diagDictionary[arg1.diagId];
            if (arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_ERROR) 
            {
                (loc4 = loc2.texts.getText(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.MESS)).text = this._currentLoginError;
                return;
            }
            if (arg1.diagId != mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_NAME) 
            {
                if (arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_NAME) 
                {
                    loc17 = (loc16 = mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy(super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.ChangePasswordRequestProxy.NAME)).getData())[mgs.aurora.common.enums.configMapping.SessionConfig.CURRENTUSERNAME];
                    (loc18 = this._diagDictionary[mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_NAME].texts.getText(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.CHG_PWD_ACCOUNT)).text = loc17;
                    loc3 = this._diagDictionary[mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_NAME].texts.getInputText(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.CHG_PWD_OLD_PASSWORD);
                }
            }
            else 
            {
                loc3 = loc2.texts.getInputText(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LOGIN_LOGINNAME);
                loc5 = loc2.texts.getInputText(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LOGIN_PASSWORD);
                loc6 = mgs.aurora.modules.legacylogin.model.LoginRequestProxy(super.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.LoginRequestProxy.NAME)).getData();
                loc7 = String(loc6[mgs.aurora.common.enums.configMapping.SessionConfig.EXTUSERNAME]);
                loc8 = String(loc6[mgs.aurora.common.enums.configMapping.SessionConfig.EXTPASSWORD]);
                loc9 = String(loc6[mgs.aurora.common.enums.configMapping.SessionConfig.SUSERNAME]);
                (loc10 = loc2.buttons.getButton(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LOGIN_FORGOTPASSWORD)).visible = loc1.allowForgotPassword;
                (loc11 = this._diagDictionary[mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_NAME].checkBoxes.getCheckBox(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LOGIN_AUTOLOGIN)).visible = loc1.allowAutoLogin;
                if (loc11.visible) 
                {
                    if (int(loc6[mgs.aurora.common.enums.configMapping.SessionConfig.EXT_AUTOLOGIN_CHECKBOX_VALUE]) != 0) 
                    {
                        if (int(loc6[mgs.aurora.common.enums.configMapping.SessionConfig.EXT_AUTOLOGIN_CHECKBOX_VALUE]) == 1) 
                        {
                            loc11.checked = true;
                        }
                    }
                    else 
                    {
                        loc11.checked = false;
                    }
                }
                loc12 = this._diagDictionary[mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_NAME].checkBoxes.getCheckBox(mgs.aurora.modules.legacylogin.enums.DialogueDefinition.LOGIN_REMEMBERPASSWORD);
                loc13 = int(loc6[mgs.aurora.common.enums.configMapping.SessionConfig.SRECALL]);
                if (!loc1.allowRememberPassword) 
                {
                    loc12.visible = false;
                    loc6[mgs.aurora.common.enums.configMapping.SessionConfig.SRECALL] = "0";
                    loc13 = 0;
                }
                if (loc7 == "" || this._loginAfterError || loc7 == loc9) 
                {
                    if (!(loc9 == null) && !(loc9 == "null")) 
                    {
                        loc3.text = loc9;
                    }
                    else if (!(loc7 == null) && !(loc7 == "null")) 
                    {
                        loc3.text = loc7;
                    }
                    if (loc13 == 1) 
                    {
                        loc12.checked = true;
                        (loc14 = this.facade.retrieveProxy(mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy.NAME) as mgs.aurora.modules.legacylogin.model.DialogueDetailsProxy).rememberPassword = true;
                        if (!((loc15 = String(loc6[mgs.aurora.common.enums.configMapping.SessionConfig.SID3])) == null) && !(loc15 == "null")) 
                        {
                            loc5.text = String(loc6[mgs.aurora.common.enums.configMapping.SessionConfig.SID3]);
                        }
                    }
                }
                else 
                {
                    loc3.text = loc7;
                    loc5.text = loc8;
                }
            }
            loc3.setFocus();
            return;
        }

        internal function onDialogueDisplayed(arg1:mgs.aurora.common.events.dialogues.DialoguesHandlerEvent):void
        {
            if (arg1.diagId != mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_NAME) 
            {
                if (arg1.diagId != mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_NAME) 
                {
                    if (arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_REGISTER1 || arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_REGISTER2) 
                    {
                        this._diagDictionary[arg1.diagId].buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onRegisterDialogueButtonAction);
                        this._diagDictionary[arg1.diagId].buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onRegisterDialogueButtonAction);
                    }
                    else if (arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_LOGIN_ERROR || arg1.diagId == mgs.aurora.modules.legacylogin.enums.DialogueDefinition.DIALOGUE_CHANGE_PASSWORD_SUCCESS_NAME) 
                    {
                        this._diagDictionary[arg1.diagId].buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onErrorSuccessDialogueButtonAction);
                        this._diagDictionary[arg1.diagId].buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onErrorSuccessDialogueButtonAction);
                    }
                }
                else 
                {
                    this._diagDictionary[arg1.diagId].buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onChangePasswordDialogueButtonAction);
                    this._diagDictionary[arg1.diagId].buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onChangePasswordDialogueButtonAction);
                }
            }
            else 
            {
                this._diagDictionary[arg1.diagId].buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, this.onLoginDialogueButtonAction);
                this._diagDictionary[arg1.diagId].buttons.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, this.onLoginDialogueButtonAction);
                this._diagDictionary[arg1.diagId].checkBoxes.addEventListener(mgs.aurora.common.events.dialogues.DialogueSelectionEvent.SELECTION_CHANGE, this.onLoginCheckBoxChange);
            }
            return;
        }

        public static const NAME:String="DialogueMediator";

        internal var _dialogueHandler:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler;

        internal var _currentLoginError:String;

        internal var _diagDictionary:flash.utils.Dictionary;

        internal var _sendLoginResponseAfterGuestPrompt:Boolean;

        internal var _loginPkt:XML;

        internal var _loginAfterError:Boolean;
    }
}


//          class LegacyLogin
package mgs.aurora.modules.legacylogin 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.common.interfaces.raptorSessions.*;
    import mgs.aurora.modules.legacylogin.model.*;
    import mgs.aurora.modules.legacylogin.notifications.*;
    import mgs.aurora.modules.legacylogin.view.*;
    
    public class LegacyLogin extends flash.display.Sprite implements mgs.aurora.common.interfaces.raptorSessions.ILegacyRaptorSession
    {
        public function LegacyLogin()
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
            this.removeEventListener(flash.events.Event.ADDED_TO_STAGE, this.init);
            this._facade = mgs.aurora.modules.legacylogin.LegacyLoginFacade.getInstance(mgs.aurora.modules.legacylogin.LegacyLogin.NAME);
            this._facade.startup(this);
            return;
        }

        internal function dispose(arg1:flash.events.Event=null):void
        {
            this.removeEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.dispose);
            return;
        }

        public function initialize(arg1:mgs.aurora.common.interfaces.comms.IXManPacketSender, arg2:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler):void
        {
            this._facade.registerProxy(new mgs.aurora.modules.legacylogin.model.XmanProxy(arg1));
            this._dialogueMediator = new mgs.aurora.modules.legacylogin.view.DialogueMediator(arg2);
            this._facade.registerMediator(this._dialogueMediator);
            return;
        }

        public function attemptLogin(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.ATTEMPT_LOGIN, arg1);
            return;
        }

        public function attemptChangePassword(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.SHOW_CHANGE_PASSWORD_DIALOGUE, arg1);
            return;
        }

        public override function addEventListener(arg1:String, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            if (this.isDialogueHandlerEvent(arg1)) 
            {
                this._dialogueMediator.addEventListener(arg1, arg2, arg3, arg4, arg5);
            }
            else 
            {
                super.addEventListener(arg1, arg2, arg3, arg4, arg5);
            }
            return;
        }

        public override function removeEventListener(arg1:String, arg2:Function, arg3:Boolean=false):void
        {
            if (this.isDialogueHandlerEvent(arg1)) 
            {
                this._dialogueMediator.removeEventListener(arg1, arg2, arg3);
            }
            else 
            {
                super.removeEventListener(arg1, arg2, arg3);
            }
            return;
        }

        public override function hasEventListener(arg1:String):Boolean
        {
            if (this.isDialogueHandlerEvent(arg1)) 
            {
                return this._dialogueMediator.hasEventListener(arg1);
            }
            return super.hasEventListener(arg1);
        }

        public override function willTrigger(arg1:String):Boolean
        {
            if (this.isDialogueHandlerEvent(arg1)) 
            {
                return this._dialogueMediator.willTrigger(arg1);
            }
            return super.willTrigger(arg1);
        }

        public override function dispatchEvent(arg1:flash.events.Event):Boolean
        {
            if (this.isDialogueHandlerEvent(arg1.type)) 
            {
                return this._dialogueMediator.dispatchEvent(arg1);
            }
            return super.dispatchEvent(arg1);
        }

        internal function isDialogueHandlerEvent(arg1:String):Boolean
        {
            var loc1:*=arg1;
            switch (loc1) 
            {
                case mgs.aurora.common.events.SystemPreloaderEvent.HIDE:
                case mgs.aurora.common.events.SystemPreloaderEvent.SHOW:
                case mgs.aurora.common.events.SystemStoreEvent.STORENAMEVALUE:
                {
                    return true;
                }
                default:
                {
                    return false;
                }
            }
        }

        public static const NAME:String="LegacyLogin";

        internal var _facade:mgs.aurora.modules.legacylogin.LegacyLoginFacade;

        internal var _dialogueMediator:mgs.aurora.modules.legacylogin.view.DialogueMediator;
    }
}


//          class LegacyLoginFacade
package mgs.aurora.modules.legacylogin 
{
    import flash.display.*;
    import mgs.aurora.modules.legacylogin.controller.*;
    import mgs.aurora.modules.legacylogin.controller.changepassword.*;
    import mgs.aurora.modules.legacylogin.controller.login.*;
    import mgs.aurora.modules.legacylogin.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class LegacyLoginFacade extends org.puremvc.as3.multicore.patterns.facade.Facade implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function LegacyLoginFacade(arg1:String)
        {
            super(arg1);
            return;
        }

        public function startup(arg1:flash.display.Sprite):void
        {
            this.sendNotification(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.STARTUP, arg1);
            this.removeCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.STARTUP);
            return;
        }

        protected override function initializeController():void
        {
            super.initializeController();
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.STARTUP, mgs.aurora.modules.legacylogin.controller.StartupCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.ATTEMPT_LOGIN, mgs.aurora.modules.legacylogin.controller.login.AttemptLoginCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_FROM_DETAILS_EXTERNAL, mgs.aurora.modules.legacylogin.controller.login.BuildLoginCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_FROM_DETAILS_AUTO, mgs.aurora.modules.legacylogin.controller.login.BuildLoginCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_FROM_DIALOGUE, mgs.aurora.modules.legacylogin.controller.login.BuildLoginCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_FROM_DEMO_DETAILS, mgs.aurora.modules.legacylogin.controller.login.BuildLoginCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_RESPONSE, mgs.aurora.modules.legacylogin.controller.login.ProcessLoginResponseCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_RESPONSE_AFTER_GUEST_PROMPT, mgs.aurora.modules.legacylogin.controller.login.ProcessLoginResponseCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_LOGIN_ERROR, mgs.aurora.modules.legacylogin.controller.login.ProcessLoginErrorCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_SESSION_LOGIN, mgs.aurora.modules.legacylogin.controller.login.BuildSessionLoginCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_SESSION_LOGIN_RESPONSE, mgs.aurora.modules.legacylogin.controller.login.ProcessSessionLoginResponseCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.ATTEMPT_CHANGE_PASSWORD, mgs.aurora.modules.legacylogin.controller.changepassword.AttemptChangePasswordCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.SHOW_CHANGE_PASSWORD_DIALOGUE, mgs.aurora.modules.legacylogin.controller.changepassword.AttemptChangePasswordCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_CHANGE_PASSWORD_FROM_DETAILS, mgs.aurora.modules.legacylogin.controller.changepassword.BuildChangePasswordCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.PROCESS_CHANGE_PASSWORD_RESPONSE, mgs.aurora.modules.legacylogin.controller.changepassword.ProcessChangePasswordResponseCommand);
            this.registerCommand(mgs.aurora.modules.legacylogin.notifications.LegacyLoginNotifications.SAVE_AUTOLOGIN, mgs.aurora.modules.legacylogin.controller.login.SaveAutoLoginCommand);
            return;
        }

        public static function getInstance(arg1:String):mgs.aurora.modules.legacylogin.LegacyLoginFacade
        {
            if (mgs.aurora.modules.legacylogin.LegacyLoginFacade._instance == null) 
            {
                mgs.aurora.modules.legacylogin.LegacyLoginFacade._instance = new LegacyLoginFacade(arg1);
            }
            return mgs.aurora.modules.legacylogin.LegacyLoginFacade._instance;
        }

        public static const NAME:String="LegacyLoginFacade";

        internal static var _instance:mgs.aurora.modules.legacylogin.LegacyLoginFacade;
    }
}


