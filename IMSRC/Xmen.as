//ActionScript 3.0
//  package mgs
//    package aurora
//      package common
//        package enums
//          package bonusBubble
//            class BonusBubbleConfigKeys
package mgs.aurora.common.enums.bonusBubble 
{
    public class BonusBubbleConfigKeys extends Object
    {
        public function BonusBubbleConfigKeys()
        {
            super();
            return;
        }

        internal static const NAME:String="bonus_bubble_config";

        public static const XMAN_MODULE:String=NAME + "/keys/xman_module";

        public static const SESSION_PROXY:String=NAME + "/keys/session_proxy";

        public static const CONFIG_XML:String=NAME + "/keys/config_xml";

        public static const CURRENCY_SUPPORTED:String=NAME + "/keys/currency_supported";

        public static const CURRENCY_XML:String=NAME + "/keys/currency_xml";

        public static const SHOW_HEADING:String=NAME + "/keys/show_heading";

        public static const SHOW_BONUS_VALUE:String=NAME + "/keys/show_bonus_value";

        public static const BONUS_TEXT:String=NAME + "/keys/bonus_text";

        public static const CASH_TEXT:String=NAME + "/keys/cash_text";

        public static const TITLE_TEXT:String=NAME + "/keys/title_text";

        public static const TOTAL_TEXT:String=NAME + "/keys/total_text";

        public static const STANDARD_CURRENCY_FORMAT:String=NAME + "/keys/standard_currency_format";

        public static const FUN_BONUS_MODULE:String=NAME + "/keys/fun_bonus_module";

        public static const FUN_BONUS_CONFIG:String=NAME + "/keys/fun_bonus_config";

        public static const XML_STRINGS:String=NAME + "/keys/xml_strings";
    }
}


//            class BonusBubbleTypes
package mgs.aurora.common.enums.bonusBubble 
{
    public class BonusBubbleTypes extends Object
    {
        public function BonusBubbleTypes()
        {
            super();
            return;
        }

        public static const ORIGINAL_WHITE_BUBBLE:String="0";

        public static const NEW_GREY_BUBBLE:String="1";

        public static const FULL_FUN_BONUS_BUBBLE:String="2";
    }
}


//          package configMapping
//            class SessionConfig
package mgs.aurora.common.enums.configMapping 
{
    public class SessionConfig extends Object
    {
        public function SessionConfig()
        {
            super();
            return;
        }

        public static const CLIENTTYPE:String="clienttype";

        public static const REGULATED_MARKET_ID:String="regulated_market_id";

        public static const EXTUSERTYPE:String="extusertype";

        public static const EXTAUTHTOKEN:String="extauthtoken";

        public static const EXTUSERNAME:String="extusername";

        public static const EXTPASSWORD:String="extpassword";

        public static const EXTSESSIONID:String="extsessionid";

        public static const USEGENAUTHLOGIN:String="usegenauthlogin";

        public static const IPADDRESS:String="ipaddress";

        public static const GAMEID:String="gameid";

        public static const OPERATORID:String="operatorid";

        public static const EXTERNALLOGIN:String="externallogin";

        public static const EXT_SESSION_TOKEN:String="extsessiontoken";

        public static const EXT_SESSION_USERID:String="extsessionuserid";

        public static const USERTYPE:String="usertype";

        public static const USERTYPE_SWITCH_TOKEN:String="usertype_switch_token";

        public static const USERTYPE_SWITCH:String="usertype_switch";

        public static const BALANCE:String="balance";

        public static const SESSIONID:String="sessionid";

        public static const SESSIONNUMBER:String="sessionnumber";

        public static const LAUNCH_IN_FUNMODE:String="launchInFunMode";

        public static const ID1:String="id1";

        public static const ID2:String="id2";

        public static const ID4:String="id4";

        public static const SUSERNAME:String="susername";

        public static const FBUSERNAME:String="fbusername";

        public static const SID3:String="sid3";

        public static const SRECALL:String="srecall";

        public static const PPUSERNAME:String="ppusername";

        public static const PPKEY:String="ppkey";

        public static const UPE:String="upe";

        public static const GGUSERNAME:String="ggusername";

        public static const GGPASSWORD:String="ggpassword";

        public static const GGRECALL:String="ggrecall";

        public static const HASCREDS:String="hascreds";

        public static const GGPRACTICEONLY:String="ggpracticeonly";

        public static const SINGLESIGNON:String="singlesignon";

        public static const INITIALIZER:String="initializer";

        public static const LOGGEDIN:String="loggedin";

        public static const LOGINTYPE:String="logintype";

        public static const SERVERID:String="serverid";

        public static const LANGUAGE:String="language";

        public static const BTAG:String="btag";

        public static const BTAG2:String="btag2";

        public static const BTAG3:String="btag3";

        public static const BTAG4:String="btag4";

        public static const BTAG5:String="btag5";

        public static const MUTESOUND:String="mutesound";

        public static const PCMGUID:String="pcmguid";

        public static const HELPCATAGORY:String="helpcategory";

        public static const EXTGAMELIST:String="extgamelist";

        public static const CURMID:String="curmid";

        public static const CURCID:String="curcid";

        public static const CURTOURNAMENTID:String="curTournamentid";

        public static const EXTGAMEID:String="extgameid";

        public static const FULLRETURNURL:String="fullreturnurl";

        public static const SAFERETURNURL:String="safereturnurl";

        public static const RETURNURL:String="return_url";

        public static const ENABLE_BONUS_BUBBLE:String="enable_bonus_bubble";

        public static const FUN_BONUS_TYPE:String="fun_bonus_type";

        public static const FUN_BONUS_OFFER_COUNT:String="fun_bonus_offer_count";

        public static const CURRENTUSERNAME:String="currentusername";

        public static const CURRENTPASSWORD:String="currentpassword";

        public static const SESSION_USERID:String="session_userid";

        public static const SESSION_AUTHENTICATION_TOKEN:String="sessionauthentication_token";

        public static const DEMO_PLAY:String="demoplay";

        public static const SHOW_AUTOLOGIN_CHECKBOX:String="showautologincheckbox";

        public static const EXT_AUTOLOGIN_CHECKBOX_VALUE:String="extautologincheckboxvalue";

        public static const AUTOLOGIN:String="autologin";

        public static const ALLOW_FORGOT_PASSWORD:String="allowforgotpwd";

        public static const ALLOW_REMEMBER_PASSWORD:String="allowrememberpassword";

        public static const SHOWREG_ON_LOGIN:String="showregonlogin";

        public static const GUESTPROMPT_FORREALPLAY:String="guestpromptforrealplay";

        public static const AUTOSHOW_REGDIAG:String="autoshowregdiag";

        public static const BYPASS_REGDIAG:String="bypassregdiag";

        public static const LOGIN_BY_SESSIONID:String="loginbysessionid";

        public static const DISABLEFCCOMPONENTS:String="disablefccomponents";

        public static const INFO_CASINONAME:String="casinoname";

        public static const INFO_REGCASINONAME:String="regcasinoname";

        public static const INFO_OLDREGCASINONAME:String="oldregcasinoname";

        public static const INFO_GAMINGGROUPNAME:String="gaminggroupname";

        public static const INFO_COMPANYNAME:String="companyname";

        public static const BASE_URL:String="baseurl";

        public static const CIP:String="cip";

        public static const HGAME:String="hgames";

        public static const HIDDENGAMES:String="hiddenGames";

        public static const MPF_USERID:String="mpf_userid";

        public static const SGI_LOGINTYPE:String="sgi_logintype";

        public static const DEMO_SERVERID:String="demoserverid";

        public static const REAL_SERVERID:String="realserverid";

        public static const WAIT_FOR_LOGGIN:String="wait_for_loggin";

        public static const ALLOW_MPF_TOKEN_LOGIN:String="allowtokenlogin";

        public static const IS_QUICK_REDIRECT:String="is_quick_redirect";

        public static const PARTICIPATION_CODE:String="participation_code";

        public static const MIGRATION_MUPID:String="migration_mupid";

        public static const MIGRATION_STATUS:String="migration_status";

        public static const MIGRATION_SERVER_ID:String="migration_server_id";

        public static const MIGRATION_SERVER_NAME:String="migration_server_name";

        public static const MIGRATION_OLD_SINGLE_SIGNON_NAME:String="migration_old_single_signon_name";

        public static const MIGRATION_EXTERNAL:String="migration_external";

        public static const XMAN_SESSION_STARTED:String="xman_session_started";

        public static const USER_ALIAS:String="user_alias";

        public static const NOTIFIER_ID:String="NotifierId";

        public static const NOTIFIER_TIMEOUT:String="NotifierTimeout";

        public static const CONSECUTIVE_BETS_ENABLED:String="consecutive_bets_enabled";

        public static const CONSECUTIVE_BETS_UPPER_LIMIT:String="consecutive_bets_upper_limit";

        public static const CONSECUTIVE_BETS_COUNT:String="consecutive_bets_count";

        public static const CUSTOM_HEADER_VALUE:String="customheadervalue";

        public static const ENABLE_CUSTOM_HEADER:String="enablecustomheader";

        public static const MPF_SERVICE_ID:String="mpf_service_id";

        public static const INGAME_GAME_LAUNCH:String="ingame_game_launch";

        public static const GAME_IS_PROGRESSIVE:String="game_is_progressive";
    }
}


//            class VPBConfig
package mgs.aurora.common.enums.configMapping 
{
    public class VPBConfig extends Object
    {
        public function VPBConfig()
        {
            super();
            return;
        }

        public static const NAME:String="VPBConfigKeys";

        public static const X_POS:String=NAME + "x";

        public static const Y_POS:String=NAME + "y";

        public static const INIT_MESSAGE_DELAY:String="initMessageDelay";

        public static const NUM_MESSAGES_REQUEST_DELAY:String="numMessagesRequestDelay";

        public static const NEXT_MESSAGE_DELAY:String="nextMessageDelay";

        public static const REMOVE_MESSAGE_DELAY:String="removeMessageDelay";

        public static const TITLE_FONT:String="titleFont";

        public static const TITLE_FONT_SIZE:String="titleSize";

        public static const TITLE_DATA_FONT:String="titleDataFont";

        public static const TITLE_DATA_FONT_SIZE:String="titleDataSize";

        public static const INSTRUCTION_URL_FONT:String="instructionFont";

        public static const INSTRUCTION_URL_FONT_SIZE:String="instructionSize";

        public static const VPB_SUPPORTED:String="supported";

        public static const FRAME_TYPE:String="frame_type";

        public static const FRAME_TYPES:String="frame_types";

        public static const ENABLED:String="enabled";

        public static const NUM_MESSAGES:String="num_messages";

        public static const XMAN:String="xman";

        public static const TWEEN_IN_DELAY:String="tweenInDelay";

        public static const TWEEN_OUT_DELAY:String="tweenOutDelay";
    }
}


//          package controls
//            class ControlType
package mgs.aurora.common.enums.controls 
{
    public class ControlType extends Object
    {
        public function ControlType()
        {
            super();
            return;
        }

        internal static const NAME:String="control/type";

        public static const TITLE:String=NAME + "/title";

        public static const BUTTON:String=NAME + "/button";

        public static const GRAPHIC:String=NAME + "/graphic";

        public static const CHECKBOX:String=NAME + "/checkbox";

        public static const RADIOBUTTON:String=NAME + "/radiobutton";

        public static const COMBOBOX:String=NAME + "/combobox";

        public static const TEXT:String=NAME + "/text";

        public static const INPUTTEXT:String=NAME + "/inputtext";
    }
}


//          package frame
//            class ButtonGroups
package mgs.aurora.common.enums.frame 
{
    public class ButtonGroups extends Object
    {
        public function ButtonGroups()
        {
            super();
            return;
        }

        public static const GAME_FRAME:String="GAME_FRAME";
    }
}


//            class ControlIdentifiers
package mgs.aurora.common.enums.frame 
{
    public class ControlIdentifiers extends Object
    {
        public function ControlIdentifiers()
        {
            super();
            return;
        }

        public static const QUICKMUTE:String="/frame/control/quickmute";

        public static const BALANCEBUTTON:String="/frame/control/balancebutton";
    }
}


//            class ExcludeMethodTypes
package mgs.aurora.common.enums.frame 
{
    public class ExcludeMethodTypes extends Object
    {
        public function ExcludeMethodTypes()
        {
            super();
            return;
        }

        internal static const NAME:String="ExcludeMethodTypes";

        public static const DISABLED:String=NAME + "/disabled";

        public static const ENABLED:String=NAME + "/enabled";

        public static const HIDDEN:String=NAME + "/hidden";
    }
}


//            class QuickMuteFrameLabels
package mgs.aurora.common.enums.frame 
{
    public class QuickMuteFrameLabels extends Object
    {
        public function QuickMuteFrameLabels()
        {
            super();
            return;
        }

        public static const ON:String="On";

        public static const OFF:String="Off";
    }
}


//            class SystemButtonTypes
package mgs.aurora.common.enums.frame 
{
    public class SystemButtonTypes extends Object
    {
        public function SystemButtonTypes()
        {
            super();
            return;
        }

        internal static const NAME:String="systembuttontypes";

        public static const OPTIONS:String=NAME + "/options";

        public static const BANK:String=NAME + "/bank";

        public static const STATS:String=NAME + "/stats";

        public static const EXPERT:String=NAME + "/expert";

        public static const REGULAR:String=NAME + "/regular";

        public static const EXIT:String=NAME + "/exit";

        public static const HELP:String=NAME + "/help";

        public static const PLAYFORREAL:String=NAME + "/playforreal";

        public static const CONNECT:String=NAME + "/connect";

        public static const DISCONNECT:String=NAME + "/disconnect";
    }
}


//          package genie
//            class GenieCasinoErrorTypes
package mgs.aurora.common.enums.genie 
{
    public class GenieCasinoErrorTypes extends Object
    {
        public function GenieCasinoErrorTypes()
        {
            super();
            return;
        }

        public static const SERVER:String="server";

        public static const XMAN:String="xman";

        public static const CLIENT:String="client";
    }
}


//            class GenieInternalErrorCodes
package mgs.aurora.common.enums.genie 
{
    public class GenieInternalErrorCodes extends Object
    {
        public function GenieInternalErrorCodes()
        {
            super();
            return;
        }

        public static const GENERAL_UNKNOWN:String="G1";

        public static const GENERAL_GAME_NOT_AVAILABLE:String="G2";

        public static const XMAN_PACKET_TIMEOUT:String="X1";

        public static const XMAN_INVALID_PACKET_REQUEST:String="X2";

        public static const XMAN_MISSING_SERVER_ID:String="X3";

        public static const XMAN_PACKET_MISMATCH_CORRECTION_FAIL:String="X4";

        public static const XMAN_DUPLICATE_PACKET_ID:String="X5";

        public static const XMAN_CUSTOM_HEADER_NOT_SUPPORTED:String="X6";

        public static const REGULATED_CLIENT_SERVER_MISMATCH:String="R1";

        public static const MPF_SOCKET_POLICY_ERROR:String="MPF1";

        public static const MPF_SOCKET_CONNECTION_ERROR:String="MPF2";

        public static const MPF_FORCED_LOGOUT:String="MPF3";

        public static const MPF_LOGIN_ERROR:String="MPF4";

        public static const MPF_CONNECTION_ERROR:String="MPF5";

        public static const CIP_MAX_LIMIT_ERROR:String="CIP1";

        public static const CIP_INVALID_REQUEST:String="CIP2";
    }
}


//          package magneto
//            class SocketIdentifiers
package mgs.aurora.common.enums.magneto 
{
    public class SocketIdentifiers extends Object
    {
        public function SocketIdentifiers()
        {
            super();
            return;
        }

        internal static const NAME:String="SocketIdentifiers";

        public static const MPV_LOBBY:String=NAME + "/mpv_lobby";

        public static const MPV_ROUTER:String=NAME + "/mpv_router";
    }
}


//          package mpf
//            class mpfConfigKeys
package mgs.aurora.common.enums.mpf 
{
    public class mpfConfigKeys extends Object
    {
        public function mpfConfigKeys()
        {
            super();
            return;
        }

        internal static const NAME:String="mpf_config";

        public static const CURRENCY_SUPPORTED:String=NAME + "/keys/currency_supported";

        public static const CURRENCY_XML:String=NAME + "/keys/currency_xml";

        public static const STANDARD_CURRENCY_FORMAT:String=NAME + "/keys/standard_currency_format";
    }
}


//          package raptorSession
//            class LoginType
package mgs.aurora.common.enums.raptorSession 
{
    public class LoginType extends Object
    {
        public function LoginType()
        {
            super();
            return;
        }

        public static const LEGACY:String="LEGACY";

        public static const UPE_INTERIM:String="UPE_I";

        public static const UPE_FULL:String="UPE_F";

        public static const SGI:String="SGI";

        public static const VANGUARD:String="VANGUARD";

        public static const MPP:String="MPP";
    }
}


//            class OlrTypes
package mgs.aurora.common.enums.raptorSession 
{
    public class OlrTypes extends Object
    {
        public function OlrTypes()
        {
            super();
            return;
        }

        public static const OLR_REAL:String="real";

        public static const OLR_GUEST:String="guest";
    }
}


//            class UserTypes
package mgs.aurora.common.enums.raptorSession 
{
    public class UserTypes extends Object
    {
        public function UserTypes()
        {
            super();
            return;
        }

        public static const REAL_USER:uint=0;

        public static const GUEST_USER:uint=1;

        public static const DEMO_USER:uint=5;

        public static const FUN_BONUS:uint=2;
    }
}


//          package sgi
//            class SGIConstants
package mgs.aurora.common.enums.sgi 
{
    public class SGIConstants extends Object
    {
        public function SGIConstants()
        {
            super();
            return;
        }

        public static const TOPBAR_HEIGHT:int=80;
    }
}


//          package vpb
//            class VPBActionNotificationParams
package mgs.aurora.common.enums.vpb 
{
    public class VPBActionNotificationParams extends Object
    {
        public function VPBActionNotificationParams()
        {
            super();
            return;
        }

        public static const NAME:String="VPBActionNotificationParams";

        public static const MESSAGE_TYPE:String=NAME + "/notes/message_type";

        public static const MODULE_ID:String=NAME + "/notes/module_id";

        public static const CLIENT_ID:String=NAME + "/notes/client_id";

        public static const POST_DATA:String=NAME + "/notes/post_data";

        public static const URL:String=NAME + "/notes/url";
    }
}


//            class VPBConfigKeys
package mgs.aurora.common.enums.vpb 
{
    public class VPBConfigKeys extends Object
    {
        public function VPBConfigKeys()
        {
            super();
            return;
        }

        public static const NAME:String="VPBConfigKeys";

        public static const X_POS:String=NAME + "/keys/x_pos";

        public static const Y_POS:String=NAME + "/keys/y_pos";

        public static const INIT_MESSAGE_DELAY:String=NAME + "/keys/init_message_delay";

        public static const NUM_MESSAGES_REQUEST_DELAY:String=NAME + "/keys/num_messages_request_delay";

        public static const NEXT_MESSAGE_DELAY:String=NAME + "/keys/next_message_delay";

        public static const REMOVE_MESSAGE_DELAY:String=NAME + "/keys/remove_message_delay";

        public static const TITLE_FONT:String=NAME + "/keys/title_font";

        public static const TITLE_FONT_SIZE:String=NAME + "/keys/title_font_size";

        public static const TITLE_DATA_FONT:String=NAME + "/keys/title_data_font";

        public static const TITLE_DATA_FONT_SIZE:String=NAME + "/keys/title_data_font_size";

        public static const INSTRUCTION_URL_FONT:String=NAME + "/keys/instruction_url_font";

        public static const INSTRUCTION_URL_FONT_SIZE:String=NAME + "/keys/instruction_url_font_size";

        public static const VPB_SUPPORTED:String=NAME + "/keys/vpb_supported";

        public static const FRAME_TYPE:String=NAME + "/keys/frame_type";

        public static const FRAME_TYPES:String=NAME + "/keys/frame_types";

        public static const ENABLED:String=NAME + "/keys/enabled";

        public static const NUM_MESSAGES:String=NAME + "/keys/num_messages";

        public static const XMAN:String=NAME + "/keys/xman";

        public static const TWEEN_IN_DELAY:Number=NAME + "/keys/tween_in_delay";

        public static const TWEEN_OUT_DELAY:Number=NAME + "/keys/tween_out_delay";
    }
}


//            class VPBErrorTypes
package mgs.aurora.common.enums.vpb 
{
    public class VPBErrorTypes extends Object
    {
        public function VPBErrorTypes()
        {
            super();
            return;
        }

        public static const NAME:String="VPBErrorTypes";

        public static const INVALID_CONFIG_DATA:String=NAME + "/error/invalid_config_data";

        public static const VPB_NOT_SUPPORTED:String=NAME + "/error/vpb_not_supported";

        public static const INVALID_FRAME_TYPE_SUPPLIED:String=NAME + "/error/invalid_frame_type_supplied";

        public static const INVALID_DIALOG_PARENT_SUPPLIED:String=NAME + "/error/invalid_dialog_parent_supplied";

        public static const INVALID_ART_SUPPLIED:String=NAME + "/error/invalid_art_supplied";

        public static const LAUNCHING_SAME_GAME:String=NAME + "/error/launching_same_game";
    }
}


//            class VPBMessageTypes
package mgs.aurora.common.enums.vpb 
{
    public class VPBMessageTypes extends Object
    {
        public function VPBMessageTypes()
        {
            super();
            return;
        }

        public static const LAUNCH_OLR:uint=0;

        public static const LAUNCH_GAME:uint=1;

        public static const SEND_EMAIL:uint=2;

        public static const LAUNCH_WEBECASH:uint=3;

        public static const DISPLAY_WELCOME_FANFARE:uint=4;

        public static const DISPLAY_BIRTHDAY_FANFARE:uint=5;

        public static const DISPLAY_BONUS_FANFARE:uint=6;

        public static const LAUNCH_WEBPAGE:uint=7;

        public static const POST_TO_WEBSERVER:uint=8;

        public static const LAUNCH_CHAT:uint=9;

        public static const POPUP_MESSAGE_ONLY:uint=10;

        public static const LAUNCH_PLAYCHECK:uint=11;

        public static const LAUNCH_CASHCHECK:uint=12;

        public static const LAUNCH_LOYALTY:uint=13;

        public static const LAUNCH_MY_ACCOUNT:uint=14;

        public static const SWITCH_REAL_TO_FUN:uint=15;

        public static const SWITCH_FUN_TO_REAL:uint=16;

        public static const LAUNCH_FUNBONUS_TUTORIAL:uint=17;

        public static const LAUNCH_FUNBONUS_TERMS_AND_CONDITIONS:uint=18;
    }
}


//            class VPBWebApps
package mgs.aurora.common.enums.vpb 
{
    public class VPBWebApps extends Object
    {
        public function VPBWebApps()
        {
            super();
            return;
        }

        public static const NAME:String="VPBWebApps";

        public static const PLAYCHECK:String="Playcheck";

        public static const CASHCHECK:String="CashCheck";

        public static const LOYALTY_MANAGER:String="Loyalty";

        public static const MY_ACCOUNT:String="MyAccountSite";
    }
}


//          class CasinoPlatforms
package mgs.aurora.common.enums 
{
    public class CasinoPlatforms extends Object
    {
        public function CasinoPlatforms()
        {
            super();
            return;
        }

        public static const VIPER:String="Viper";

        public static const AURORA:String="Aurora";

        public static const RUBY:String="Ruby";

        public static const T3:String="T3";
    }
}


//          class CommsErrorTypes
package mgs.aurora.common.enums 
{
    public class CommsErrorTypes extends Object
    {
        public function CommsErrorTypes()
        {
            super();
            return;
        }

        public static const NAME:String="CommsErrorTypes";

        public static const INVALID_CONFIG_DATA:String=NAME + "/errors/invalid_config_data";

        public static const INVALID_PACKET_REQUEST_DATA:String=NAME + "/error/invalid_packet_request_data";

        public static const DUPLICATE_PACKET_ID:String=NAME + "/error/duplicate_packet_id";

        public static const CONFIG_NOT_INITIALIZED:String=NAME + "/error/config_not_initialized";

        public static const NO_SERVER_ID_SUPPLIED:String=NAME + "/error/no_server_id_supplied";

        public static const PACKET_MISMATCH_CORRECTION_FAILED:String=NAME + "/error/packet_mismatch_correction_failed";
    }
}


//          class ContentType
package mgs.aurora.common.enums 
{
    public class ContentType extends Object
    {
        public function ContentType()
        {
            super();
            return;
        }

        internal static const NAME:String="content_type";

        public static const SWF_CONTENT:String=NAME + "/swf";

        public static const XML_CONTENT:String=NAME + "/xml";

        public static const BIN_CONTENT:String=NAME + "/bin";

        public static const ZIP_CONTENT:String=NAME + "/zip";
    }
}


//          class StorageNames
package mgs.aurora.common.enums 
{
    public class StorageNames extends Object
    {
        public function StorageNames()
        {
            super();
            return;
        }

        public static const LOGIN_STORAGE:String="login";

        public static const LOGIN_REMEMBERPASSWORD:String="rememberpassword";

        public static const LOGIN_AUTOLOGIN:String="autologin";
    }
}


//          class XManConfigKeys
package mgs.aurora.common.enums 
{
    public class XManConfigKeys extends Object
    {
        public function XManConfigKeys()
        {
            super();
            return;
        }

        public static const NAME:String="XManConfigKeys";

        public static const SERVER_URL:String=NAME + "/keys/server_url";

        public static const SERVER_ID:String=NAME + "/keys/server_id";

        public static const PACKET_TIMEOUT:String=NAME + "/keys/packet_timeout";

        public static const SESSION_TIMEOUT:String=NAME + "/keys/session_timeout";

        public static const LANGUAGE:String=NAME + "/keys/language";

        public static const SESSION_ID:String=NAME + "/keys/session_id";
    }
}


//          class XManPacketParameterKeys
package mgs.aurora.common.enums 
{
    public class XManPacketParameterKeys extends Object
    {
        public function XManPacketParameterKeys()
        {
            super();
            return;
        }

        public static const NAME:String="PacketParameterKeys";

        public static const PKT_ATTRIBUTES:String=NAME + "/keys/pkt_attributes";

        public static const MODULE_ID:String=NAME + "/keys/module_id";

        public static const CLIENT_ID:String=NAME + "/keys/client_id";

        public static const SERVER_ID:String=NAME + "/keys/server_id";

        public static const VERB:String=NAME + "/keys/verb";

        public static const REQUEST:String=NAME + "/keys/request";

        public static const PACKET_ID:String=NAME + "/keys/packet_id";

        public static const RESET_SESSION_TIMER:String=NAME + "/keys/reset_session_timer";

        public static const EVENT_NAME:String=NAME + "/keys/event_name";

        public static const EXPECTED_RESPONSE_VERB:String=NAME + "/keys/expected_response_verb";

        public static const INCLUDE_EXT_OPERATOR_INFO:String=NAME + "/keys/include_ext_operator_info";

        public static const PACKET:String=NAME + "/keys/packet";
    }
}


//          class XManServerErrorCodes
package mgs.aurora.common.enums 
{
    public class XManServerErrorCodes extends Object
    {
        public function XManServerErrorCodes()
        {
            super();
            return;
        }

        public static const EC_LOGIN_LOCKED_OUT:String="101";

        public static const EC_LOGIN_COUNTRY_EXCLUDED:String="110";

        public static const EC_LOGIN_UNSUPPORTED_CURRENCY:String="114";

        public static const LOGIN_ATTEMPTS_EXCEEDED:String="150";

        public static const EC_GAME_GENERAL_GAME_NOT_AVAILABLE:String="504";

        public static const EC_GAME_GENERAL_INVALID_BET_LIMITS:String="523";

        public static const FUN_BONUS_EXPIRED:String="50110";

        public static const FUN_BONUS_OUT_OF_PLAYTIME:String="50111";

        public static const IT_LOGIN_ERROR:String="50113";
    }
}


//          class XmanTimerNames
package mgs.aurora.common.enums 
{
    public class XmanTimerNames extends Object
    {
        public function XmanTimerNames()
        {
            super();
            return;
        }

        public static const NAME:String="XmanTimerNames";

        public static const SESSION_TIMER:String=NAME + "/session_timer";

        public static const PACKET_TIMER:String=NAME + "/packet_timer";

        public static const PING_TIMER:String=NAME + "/ping_timer";
    }
}


//        package events
//          package banking
//            class BankingEvent
package mgs.aurora.common.events.banking 
{
    import flash.events.*;
    
    public class BankingEvent extends flash.events.Event
    {
        public function BankingEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.banking.BankingEvent(type, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("BankingEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public function get data():Object
        {
            return this._data;
        }

        public function set data(arg1:Object):void
        {
            this._data = arg1;
            return;
        }

        public static const NAME:String="BankingEvent";

        public static const LAUNCH_BANKING:String=NAME + "/event_types/launch_banking";

        public static const BANKING_LAUNCHED:String=NAME + "/event_types/banking_launched";

        public static const BANKING_NOT_LAUNCHED:String=NAME + "/event_types/banking_not_launched";

        public static const BANK_RETURNED:String=NAME + "/event_types/bank_returned";

        public static const NO_CASH_PROMPT:String=NAME + "/event_types/no_cash_prompt";

        public static const FRAME_LAUNCH_BANK:String=NAME + "/event_types/frame_launch_bank";

        public static const BANKING_COMPLETE:String=NAME + "/event_types/banking_complete";

        public static const GENIE_CASINO_ERROR:String=NAME + "/event_types/genie_casino_error";

        internal var _data:Object;
    }
}


//          package comms
//            class PacketEvent
package mgs.aurora.common.events.comms 
{
    import flash.events.*;
    
    public class PacketEvent extends flash.events.Event
    {
        public function PacketEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.comms.PacketEvent(type, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("PacketEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public function switchType(arg1:String):mgs.aurora.common.events.comms.PacketEvent
        {
            var loc1:*=new mgs.aurora.common.events.comms.PacketEvent(arg1, bubbles, cancelable);
            loc1.clientID = this.clientID;
            loc1.moduleID = this.moduleID;
            loc1.packetID = this.packetID;
            loc1.packetAttributes = this.packetAttributes;
            loc1.serverID = this.serverID;
            loc1.verb = this.verb;
            loc1.request = this.request;
            loc1.response = this.response;
            loc1.resetSessionTimer = this.resetSessionTimer;
            return loc1;
        }

        public static const NAME:String="PacketEvent";

        public static const SEND_REQUEST_PACKET:String=NAME + "/event_types/send_request_packet";

        public static const RESPONSE_PACKET_RECEIVED:String=NAME + "/event_types/response_packet_received";

        public var clientID:String;

        public var moduleID:String;

        public var packetID:String;

        public var packetAttributes:String;

        public var serverID:String;

        public var verb:String;

        public var request:XML;

        public var response:XML;

        public var resetSessionTimer:Boolean;
    }
}


//            class XManEvent
package mgs.aurora.common.events.comms 
{
    import flash.events.*;
    
    public class XManEvent extends flash.events.Event
    {
        public function XManEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.comms.XManEvent(type, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("XManEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public static const NAME:String="XManEvent";

        public static const SETUP_COMPLETE:String=NAME + "/event_types/setup_complete";

        public static const ERROR:String=NAME + "/event_types/error";

        public static const PACKET_SENT:String=NAME + "/event_types/packet_sent";

        public static const SESSION_TIMER_STOPPED:String=NAME + "/event_types/session_timer_stopped";

        public static const SESSION_TIMER_STARTED:String=NAME + "/event_types/session_timer_started";

        public static const SESSION_TIMEDOUT:String=NAME + "/event_types/session_timedout";

        public static const PACKET_TIMEDOUT:String=NAME + "/event_types/packet_timedout";

        public static const HEADER_NOT_SUPPORTED:String=NAME + "/event_types/header_not_supported";

        public var errorType:String;

        public var packetID:String;

        public var responsePacket:XML;
    }
}


//          package controlsBuilder
//            class ControlsBuilderEvent
package mgs.aurora.common.events.controlsBuilder 
{
    import flash.events.*;
    
    public class ControlsBuilderEvent extends flash.events.Event
    {
        public function ControlsBuilderEvent(arg1:String, arg2:Object=null)
        {
            super(arg1);
            this.data = arg2;
            return;
        }

        internal static const NAME:String="controls_builder";

        public static const CONTROLS_CREATED:String=NAME + "/controls_created";

        public var data:Object;
    }
}


//          package dialogues
//            class DialogueFocusEvent
package mgs.aurora.common.events.dialogues 
{
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class DialogueFocusEvent extends flash.events.Event
    {
        public function DialogueFocusEvent(arg1:String, arg2:String, arg3:String, arg4:mgs.aurora.common.interfaces.controls.IControl, arg5:flash.events.FocusEvent, arg6:Boolean=false, arg7:Boolean=false)
        {
            super(arg1, arg6, arg7);
            this.diagId = arg2;
            this.diagType = arg3;
            this.control = arg4;
            this.originalEvent = arg5;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.dialogues.DialogueFocusEvent(type, this.diagId, this.diagType, this.control, this.originalEvent, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("DialogueFocusEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public static const FOCUS_IN:String=flash.events.FocusEvent.FOCUS_IN;

        public static const FOCUS_OUT:String=flash.events.FocusEvent.FOCUS_OUT;

        public var diagId:String;

        public var diagType:String;

        public var control:mgs.aurora.common.interfaces.controls.IControl;

        public var originalEvent:flash.events.FocusEvent;
    }
}


//            class DialogueKeyboardEvent
package mgs.aurora.common.events.dialogues 
{
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class DialogueKeyboardEvent extends flash.events.Event
    {
        public function DialogueKeyboardEvent(arg1:String, arg2:String, arg3:String, arg4:mgs.aurora.common.interfaces.controls.IControl, arg5:flash.events.KeyboardEvent, arg6:Boolean=false, arg7:Boolean=false)
        {
            super(arg1, arg6, arg7);
            this.diagId = arg2;
            this.diagType = arg3;
            this.control = arg4;
            this.originalEvent = arg5;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.dialogues.DialogueKeyboardEvent(type, this.diagId, this.diagType, this.control, this.originalEvent, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("DialogueKeyboardEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public static const KEY_UP:String=flash.events.KeyboardEvent.KEY_UP;

        public static const KEY_DOWN:String=flash.events.KeyboardEvent.KEY_DOWN;

        public var diagId:String;

        public var diagType:String;

        public var control:mgs.aurora.common.interfaces.controls.IControl;

        public var originalEvent:flash.events.KeyboardEvent;
    }
}


//            class DialogueMouseEvent
package mgs.aurora.common.events.dialogues 
{
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class DialogueMouseEvent extends flash.events.Event
    {
        public function DialogueMouseEvent(arg1:String, arg2:String, arg3:String, arg4:mgs.aurora.common.interfaces.controls.IControl, arg5:flash.events.MouseEvent, arg6:Boolean=false, arg7:Boolean=false)
        {
            super(arg1, arg6, arg7);
            this.diagId = arg2;
            this.diagType = arg3;
            this.control = arg4;
            this.originalEvent = arg5;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.dialogues.DialogueMouseEvent(type, this.diagId, this.diagType, this.control, this.originalEvent, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("DialogueMouseEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public static const MOUSE_UP:String=flash.events.MouseEvent.MOUSE_UP;

        public static const MOUSE_OUT:String=flash.events.MouseEvent.MOUSE_OUT;

        public static const ROLL_OUT:String=flash.events.MouseEvent.ROLL_OUT;

        public static const DOUBLE_CLICK:String=flash.events.MouseEvent.DOUBLE_CLICK;

        public static const CLICK:String=flash.events.MouseEvent.CLICK;

        public static const RIGHT_CLICK:String="rightClick";

        public static const MOUSE_DOWN:String=flash.events.MouseEvent.MOUSE_DOWN;

        public static const MOUSE_OVER:String=flash.events.MouseEvent.MOUSE_OVER;

        public static const ROLL_OVER:String=flash.events.MouseEvent.ROLL_OVER;

        public static const MOUSE_MOVE:String=flash.events.MouseEvent.MOUSE_MOVE;

        public static const MOUSE_WHEEL:String=flash.events.MouseEvent.MOUSE_WHEEL;

        public var diagId:String;

        public var diagType:String;

        public var control:mgs.aurora.common.interfaces.controls.IControl;

        public var originalEvent:flash.events.MouseEvent;
    }
}


//            class DialogueSelectionEvent
package mgs.aurora.common.events.dialogues 
{
    import flash.events.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class DialogueSelectionEvent extends flash.events.Event
    {
        public function DialogueSelectionEvent(arg1:String, arg2:String, arg3:String, arg4:mgs.aurora.common.interfaces.controls.IControl, arg5:Boolean=false, arg6:Boolean=false)
        {
            super(arg1, arg5, arg6);
            this.diagId = arg2;
            this.diagType = arg3;
            this.control = arg4;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.dialogues.DialogueSelectionEvent(type, this.diagId, this.diagType, this.control, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("DialogueSelectionEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public static const SELECTED:String=mgs.aurora.common.events.SystemSelectionEvent.SELECTED;

        public static const DESELECTED:String=mgs.aurora.common.events.SystemSelectionEvent.DESELECTED;

        public static const SELECTION_CHANGE:String=mgs.aurora.common.events.SystemSelectionEvent.SELECTION_CHANGE;

        public var diagId:String;

        public var diagType:String;

        public var control:mgs.aurora.common.interfaces.controls.IControl;
    }
}


//            class DialoguesHandlerEvent
package mgs.aurora.common.events.dialogues 
{
    import flash.events.*;
    
    public class DialoguesHandlerEvent extends flash.events.Event
    {
        public function DialoguesHandlerEvent(arg1:String, arg2:String, arg3:String=null, arg4:String=null)
        {
            super(arg1);
            this.id = arg2;
            this.diagId = arg3;
            this.diagType = arg4;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.dialogues.DialoguesHandlerEvent(type, this.id, this.diagId, this.diagType);
        }

        public override function toString():String
        {
            return formatToString("NewEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="dialogues_handler/event";

        public static const DIALOGUE_CREATED:String=NAME + "/dialogue_created";

        public static const DIALOGUE_DISPLAYED:String=NAME + "/dialogue_displayed";

        public static const OTHER_DIALOGUE_DISPLAYED:String=NAME + "/other_dialogue_displayed";

        public static const REMOVING_DIALOGUE:String=NAME + "/removing_dialogue";

        public static const DIALOGUE_REMOVED:String=NAME + "/dialogue_removed";

        public static const OTHER_DIALOGUE_REMOVED:String=NAME + "/other_dialogue_removed";

        public static const ALL_DIALOGUES_REMOVED:String=NAME + "/all_dialogues_removed";

        public var id:String;

        public var diagId:String;

        public var diagType:String;
    }
}


//            class DialoguesModuleEvent
package mgs.aurora.common.events.dialogues 
{
    import flash.events.*;
    
    public class DialoguesModuleEvent extends flash.events.Event
    {
        public function DialoguesModuleEvent(arg1:String, arg2:String, arg3:String, arg4:String)
        {
            super(arg1);
            this.diagId = arg2;
            this.diagType = arg3;
            this.handlerId = arg4;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.dialogues.DialoguesModuleEvent(type, this.diagId, this.diagType, this.handlerId);
        }

        public override function toString():String
        {
            return formatToString("NewEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="dialogues_module/event";

        public static const DIALOGUE_CREATED:String=NAME + "/dialogue_created";

        public static const DIALOGUE_DISPLAYED:String=NAME + "/dialogue_displayed";

        public static const DIALOGUE_REMOVED:String=NAME + "/dialogue_removed";

        public var diagId:String;

        public var diagType:String;

        public var handlerId:String;
    }
}


//            class DialoguesTextEvent
package mgs.aurora.common.events.dialogues 
{
    import flash.events.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class DialoguesTextEvent extends flash.events.Event
    {
        public function DialoguesTextEvent(arg1:String, arg2:String, arg3:String, arg4:mgs.aurora.common.interfaces.controls.IControl, arg5:Boolean=false, arg6:Boolean=false)
        {
            super(arg1, arg5, arg6);
            this.diagId = arg2;
            this.diagType = arg3;
            this.control = arg4;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.dialogues.DialoguesTextEvent(type, this.diagId, this.diagType, this.control, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("DialogueTextEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public static const CHANGE:String=mgs.aurora.common.events.SystemTextEvent.CHANGE;

        public static const TEXT_INPUT:String=mgs.aurora.common.events.SystemTextEvent.TEXT_INPUT;

        public var diagId:String;

        public var diagType:String;

        public var control:mgs.aurora.common.interfaces.controls.IControl;
    }
}


//          package funBonus
//            class FunBonusEvents
package mgs.aurora.common.events.funBonus 
{
    public class FunBonusEvents extends Object
    {
        public function FunBonusEvents()
        {
            super();
            return;
        }

        public static const FB_SWITCH_USER:String="evt_fbswitch_panel";

        public static const FB_SHOW_TUTORIAL:String="evt_fbtutorial_panel";

        public static const FP_SHOW_TC:String="evt_fbtermsnconditions_vpb";

        public static const FB_CHANGE_BONUS_OFFER:String="evt_fbchangebonusoffer";

        public static const FB_CHANGE_BONUS_OFFER_ERROR:String="evt_fbchangebonusoffer_error";

        public static const FB_HIDE_BUBBLE:String="evt_exthidebb";
    }
}


//          package magneto
//            class MagnetoEvent
package mgs.aurora.common.events.magneto 
{
    import flash.events.*;
    
    public class MagnetoEvent extends flash.events.Event
    {
        public function MagnetoEvent(arg1:String, arg2:String, arg3:XML, arg4:Boolean=false, arg5:Boolean=false)
        {
            super(arg1, arg4, arg5);
            this._socketId = arg2;
            this._data = arg3;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.magneto.MagnetoEvent(type, this.socketId, this.data, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("MagnetoEvent", "type", "socketId", "data", "bubbles", "cancelable", "eventPhase");
        }

        public function get socketId():String
        {
            return this._socketId;
        }

        public function get data():XML
        {
            return this._data;
        }

        internal static const NAME:String="MagnetoEvent";

        public static const POLICY_ERROR:String=NAME + "/event/policy_error";

        public static const CONNECTED:String=NAME + "/event/connected";

        public static const CLOSED:String=NAME + "/event/closed";

        public static const ERROR:String=NAME + "/event/error";

        public static const DATA:String=NAME + "/event/data";

        internal var _socketId:String;

        internal var _data:XML;
    }
}


//          package marketManager
//            class MarketManagerEvent
package mgs.aurora.common.events.marketManager 
{
    import flash.events.*;
    
    public class MarketManagerEvent extends flash.events.Event
    {
        public function MarketManagerEvent(arg1:String, arg2:Object=null, arg3:Boolean=false, arg4:Boolean=false)
        {
            super(arg1, arg3, arg4);
            this._data = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.marketManager.MarketManagerEvent(type, this.data, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("MarketManagerEvent", "type", "data", "bubbles", "cancelable", "eventPhase");
        }

        public function get data():Object
        {
            return this._data;
        }

        internal static const NAME:String="marketmanagerevent";

        public static const SYSTEM_LOADED:String=NAME + "/system_loaded";

        public static const SHOW_LOGIN_DIALOG:String=NAME + "/show_login_dialog";

        public static const SEND_LOGIN_REQUEST:String=NAME + "/send_login_request";

        public static const LOGIN_SUCCESSFULL:String=NAME + "/login_successfull";

        public static const LOAD_GAME_MODULE:String=NAME + "/load_game_module";

        public static const EXIT_GAME_MODULE:String=NAME + "/exit_game_module";

        public static const SWITCH_USER_TYPE:String=NAME + "/switch_user_type";

        public static const SHOW_ERROR_DIALOG:String=NAME + "/show_error_dialog";

        public static const INTERNAL_ERROR:String=NAME + "/show_internal_error";

        public static const CASINO_TIME_OUT:String=NAME + "/casino_time_out";

        public static const BANK_BUTTON_PRESSED:String=NAME + "/bank_button_pressed";

        public static const RETURN_FROM_BANK:String=NAME + "/return_from_bank";

        public static const HELP_BUTTON_PRESSED:String=NAME + "/help_button_pressed";

        public static const UPDATE_BONUS_BUBBLE_FEATURES:String=NAME + "/update_bonus_bubble_features";

        public static const EXIT_SYSTEM_REQUEST:String=NAME + "/exit_system_request";

        public static const UPDATE_XMAN_CONFIG:String=NAME + "/update_xman_config";

        public static const LAUNCH_EXTERNAL_SITE:String=NAME + "/launch_external_site";

        public static const LAUNCH_OLR:String=NAME + "/launch_olr";

        public static const BALANCE_UPDATED:String=NAME + "/balance_updated";

        public static const SET_EXTERNAL_LAUNCH_VARS:String=NAME + "/set_external_launch_vars";

        public static const ENABLE_VPB:String=NAME + "/enable_vpb";

        public static const DISABLE_VPB:String=NAME + "/disable_vpb";

        public static const START_XMAN_SESSION:String=NAME + "/start_xman_session";

        public static const GENIE_USER_DISCONNECT:String=NAME + "/genie_user_disconnect";

        public static const GENIE_CASINO_ERROR:String=NAME + "/genie_casino_error";

        public static const NOTIFY_GAME_BALANCE_CHANGE:String=NAME + "/notify_game_balance_change";

        internal var _data:Object;
    }
}


//          package multiplayer
//            class MPFAvatarEvent
package mgs.aurora.common.events.multiplayer 
{
    import __AS3__.vec.*;
    import flash.events.*;
    
    public class MPFAvatarEvent extends flash.events.Event
    {
        public function MPFAvatarEvent(arg1:String, arg2:*=null, arg3:__AS3__.vec.Vector.<mgs.aurora.common.vo.multiplayer.AvatarMetaData>=null, arg4:Boolean=false, arg5:Boolean=false)
        {
            super(arg1, arg4, arg5);
            this.avatar = arg2;
            this.avatarMetaData = arg3;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.multiplayer.MPFAvatarEvent(type, this.avatar, this.avatarMetaData, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("MPFAvatarEvent", "avatar", "avatarMetaData", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="MPFAvatarEvent";

        public static const AVATAR_RECEIVED:String=NAME + "/types/avatar_received";

        public static const AVATAR_METADATA_RECEIVED:String=NAME + "/types/avatar_metadata_received";

        public var avatar:*;

        public var avatarMetaData:__AS3__.vec.Vector.<mgs.aurora.common.vo.multiplayer.AvatarMetaData>;
    }
}


//            class MPFConnectionEvent
package mgs.aurora.common.events.multiplayer 
{
    import flash.events.*;
    
    public class MPFConnectionEvent extends flash.events.Event
    {
        public function MPFConnectionEvent(arg1:String, arg2:String, arg3:Boolean=false, arg4:Boolean=false)
        {
            super(arg1, arg3, arg4);
            this.socketID = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.multiplayer.MPFConnectionEvent(type, this.socketID, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("MPFConnectionEvent", "type", "socketID", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="MPFConnectionEvent";

        public static const ALL_SOCKETS_CONNECTED:String=NAME + "/event/sockets_connected";

        public static const SOCKET_CONNECTED:String=NAME + "/event/socket_connected";

        public var socketID:String;
    }
}


//            class MPFErrorEvent
package mgs.aurora.common.events.multiplayer 
{
    import flash.events.*;
    
    public class MPFErrorEvent extends flash.events.Event
    {
        public function MPFErrorEvent(arg1:String, arg2:flash.events.Event=null, arg3:Boolean=false, arg4:Boolean=false)
        {
            super(arg1, arg3, arg4);
            this._error = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.multiplayer.MPFErrorEvent(type, this._error, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("MPFErrorEvent", "error", "type", "bubbles", "cancelable", "eventPhase");
        }

        public function get error():flash.events.Event
        {
            return this._error;
        }

        internal static const NAME:String="MPFErrorEvent";

        public static const AVATAR_LOADING_ERROR:String=NAME + "/types/avatar_loading_error";

        internal var _error:flash.events.Event;
    }
}


//            class MPFLaunchEvent
package mgs.aurora.common.events.multiplayer 
{
    import flash.events.*;
    
    public class MPFLaunchEvent extends flash.events.Event
    {
        public function MPFLaunchEvent(arg1:String, arg2:String, arg3:Boolean=false, arg4:Boolean=false)
        {
            super(arg1, arg3, arg4);
            this._gameID = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.multiplayer.MPFLaunchEvent(type, this._gameID, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("MPFLaunchEvent", "_gameID", "type", "bubbles", "cancelable", "eventPhase");
        }

        public function get gameID():String
        {
            return this._gameID;
        }

        internal static const NAME:String="MPFLaunchEvent";

        public static const LAUNCH_GAME:String=NAME + "/types/launch_game";

        internal var _gameID:String;
    }
}


//            class MPFNotificationEvent
package mgs.aurora.common.events.multiplayer 
{
    import flash.events.*;
    
    public class MPFNotificationEvent extends flash.events.Event
    {
        public function MPFNotificationEvent(arg1:String, arg2:String, arg3:XML, arg4:Boolean=false, arg5:Boolean=false)
        {
            super(arg1, arg4, arg5);
            this._socketID = arg2;
            this._data = arg3;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.multiplayer.MPFNotificationEvent(type, this.socketID, this.data, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("MPFNotificationEvent", "socketId", "data", "type", "bubbles", "cancelable", "eventPhase");
        }

        public function get socketID():String
        {
            return this._socketID;
        }

        public function get data():XML
        {
            return this._data;
        }

        internal static const NAME:String="MPFNotificationEvent";

        public static const TOURNAMENT_IN_PROGRESS:String=NAME + "/types/tournament_in_progress";

        public static const FORCE_LOGOUT:String=NAME + "/types/force_logout";

        internal var _socketID:String;

        internal var _data:XML;
    }
}


//            class MPFPacketEvent
package mgs.aurora.common.events.multiplayer 
{
    import flash.events.*;
    
    public class MPFPacketEvent extends flash.events.Event
    {
        public function MPFPacketEvent(arg1:String, arg2:String, arg3:XML, arg4:Boolean=false, arg5:Boolean=false)
        {
            super(arg1, arg4, arg5);
            this._socketID = arg2;
            this._data = arg3;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.multiplayer.MPFPacketEvent(type, this._socketID, this._data, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("MPFPacketEvent", "socketId", "data", "type", "bubbles", "cancelable", "eventPhase");
        }

        public function get socketID():String
        {
            return this._socketID;
        }

        public function get data():XML
        {
            return this._data;
        }

        internal static const NAME:String="MPFPacketEvent";

        public static const PACKET_RECEIVED:String=NAME + "/event/packet_received";

        public static const LOGIN_SUCCESSFUL:String=NAME + "/event/login_successful";

        public static const LOGIN_ERROR:String=NAME + "/event/login_error";

        public static const REGISTRATION_SUCCESSFUL:String=NAME + "/event/registration_successful";

        public static const REGISTRATION_ERROR:String=NAME + "/event/registration_error";

        internal var _socketID:String;

        internal var _data:XML;
    }
}


//          package raptorSessions
//            class RaptorSessionEvent
package mgs.aurora.common.events.raptorSessions 
{
    import flash.events.*;
    
    public class RaptorSessionEvent extends flash.events.Event
    {
        public function RaptorSessionEvent(arg1:String, arg2:Object, arg3:Boolean=false, arg4:Boolean=false)
        {
            super(arg1, arg3, arg4);
            this._dynamicData = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.raptorSessions.RaptorSessionEvent(type, this.dynamicData, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("RaptorSessionEvent", "type", "data", "bubbles", "cancelable", "eventPhase");
        }

        public function get dynamicData():Object
        {
            return this._dynamicData;
        }

        internal static const NAME:String="raptorsessionevent";

        public static const LOGIN_SUCCESSFULL:String=NAME + "/login_successfull";

        public static const CHANGE_PASSWORD_SUCCESSFULL:String=NAME + "/change_password_successfull";

        public static const ERROR:String=NAME + "/error";

        public static const LAUNCH_ORL:String=NAME + "/launch_olr";

        public static const LAUNCH_HELP:String=NAME + "/launch_help";

        public static const LAUNCH_MIGRATE:String=NAME + "/launch_migrate";

        public static const LAUNCH_FORGOTPASSWORD:String=NAME + "/launch_forgotPassword";

        public static const EXIT:String=NAME + "/exit";

        public static const SESSION_CREATED:String=NAME + "/session_created";

        public static const LOGOUT_SUCCESSFULL:String=NAME + "/logout_successfull";

        public static const LAUNCH_BRANDMIGRATION:String=NAME + "/launch_brandmigration";

        public static const LAUNCH_SWITCH_USER:String=NAME + "/launch_switch_user";

        public static const SWITCH_USER_CANCELLED:String=NAME + "/switch_user_cancelled";

        internal var _dynamicData:Object;
    }
}


//          package vpb
//            class VPBEvent
package mgs.aurora.common.events.vpb 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.vpb.*;
    
    public class VPBEvent extends flash.events.Event
    {
        public function VPBEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.vpb.VPBEvent(type, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("VPBEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public static const NAME:String="VPBEvent";

        public static const ACTION_NOTIFICATION:String=NAME + "/event_types/action_notification";

        public static const ERROR:String=NAME + "/event_types/error";

        public static const SETUP_COMPLETE:String=NAME + "/event_types/setup_complete";

        public static const IS_GAME_VALID:String=NAME + "/event_types/is_game_valid";

        public static const IS_WEB_APP_AVAILABLE:String=NAME + "/event_types/is_web_app_available";

        public static const UPDATE_BALANCE:String=NAME + "/event_types/update_balance";

        public static const REQUEST_WEB_APP_DETAILS:String=NAME + "/event_types/request_web_app_details";

        public static const DISPLAY_INVALID_GAME_MESSAGE:String=NAME + "/event_types/display_invalid_game_message";

        public static const SWITCH_USER_TYPE:String=NAME + "/event_types/switch_user_type";

        public var actionDetails:flash.utils.Dictionary;

        public var errorType:String;

        public var gameDetails:mgs.aurora.common.interfaces.vpb.IIsGameValidParameters;

        public var webAppName:String;

        public var value:Number;

        public var userType:String="";
    }
}


//          class PacketErrorEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class PacketErrorEvent extends flash.events.Event
    {
        public function PacketErrorEvent(arg1:String, arg2:XML=null, arg3:Boolean=false, arg4:Boolean=false)
        {
            super(arg1, arg3, arg4);
            this.packet = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.PacketErrorEvent(type, this.packet, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("PacketErrorEvent", "type", "packet", "bubbles", "cancelable", "eventPhase");
        }

        public static const NAME:String="PacketErrorEvent";

        public static const FATAL:String=NAME + "/types/fatal";

        public static const HEADER_NOT_SUPPORTED:String=NAME + "/types/header_not_supported";

        public var packet:XML;
    }
}


//          class SystemChipSelectorEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemChipSelectorEvent extends flash.events.Event
    {
        public function SystemChipSelectorEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemChipSelectorEvent(type, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemChipSelectorEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="system/chip_selector/event";

        public static const INC:String=NAME + "/inc";

        public static const DEC:String=NAME + "/dec";
    }
}


//          class SystemConfigEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemConfigEvent extends flash.events.Event
    {
        public function SystemConfigEvent(arg1:String, arg2:*, arg3:*, arg4:Boolean=false, arg5:Boolean=false)
        {
            super(arg1, arg4, arg5);
            this._name = arg2;
            this._value = arg3;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemConfigEvent(type, this.name, this.value, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemConfigEvent", "type", "name", "value", "bubbles", "cancelable", "eventPhase");
        }

        public function get name():*
        {
            return this._name;
        }

        public function get value():*
        {
            return this._value;
        }

        internal static const NAME:String="/system/config/event";

        public static const VALUE_CHANGED:String=NAME + "/changed";

        internal var _name:*;

        internal var _value:*;
    }
}


//          class SystemFocusEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemFocusEvent extends flash.events.Event
    {
        public function SystemFocusEvent(arg1:String, arg2:String, arg3:flash.events.FocusEvent, arg4:Boolean=false, arg5:Boolean=false)
        {
            super(arg1, arg4, arg5);
            this._id = arg2;
            this._targetEvent = arg3;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemFocusEvent(type, this._id, this._targetEvent, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemFocusEvent", "type", "id", "targetEvent", "bubbles", "cancelable", "eventPhase");
        }

        public function get id():String
        {
            return this._id;
        }

        public function get originalEvent():flash.events.FocusEvent
        {
            return this._targetEvent;
        }

        public static const FOCUS_IN:String=flash.events.FocusEvent.FOCUS_IN;

        public static const FOCUS_OUT:String=flash.events.FocusEvent.FOCUS_OUT;

        internal var _id:String;

        internal var _targetEvent:flash.events.FocusEvent;
    }
}


//          class SystemFrameEvents
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemFrameEvents extends flash.events.Event
    {
        public function SystemFrameEvents(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemFrameEvents(type, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemFrameEvents", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="system/frame/event";

        public static const GAME_LAYOUT_COMPLETE:String=NAME + "/game_layout_complete";

        public static const GAME_LAYOUT_CLEARED:String=NAME + "/game_layout_cleared";

        public static const FRAME_SWITCH_COMPLETE:String=NAME + "/frame_switch_complete";
    }
}


//          class SystemInteractionEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemInteractionEvent extends flash.events.Event
    {
        public function SystemInteractionEvent(arg1:String, arg2:String, arg3:flash.events.Event, arg4:Boolean=false, arg5:Boolean=false)
        {
            super(arg1, arg4, arg5);
            this._id = arg2;
            this._targetEvent = arg3;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemInteractionEvent(type, this._id, this._targetEvent, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemInteractionEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public function get id():String
        {
            return this._id;
        }

        public function get originalEvent():flash.events.Event
        {
            return this._targetEvent;
        }

        public static const MOUSE_UP:String=flash.events.MouseEvent.MOUSE_UP;

        public static const MOUSE_OUT:String=flash.events.MouseEvent.MOUSE_OUT;

        public static const ROLL_OUT:String=flash.events.MouseEvent.ROLL_OUT;

        public static const DOUBLE_CLICK:String=flash.events.MouseEvent.DOUBLE_CLICK;

        public static const CLICK:String=flash.events.MouseEvent.CLICK;

        public static const RIGHT_CLICK:String="rightClick";

        public static const MOUSE_DOWN:String=flash.events.MouseEvent.MOUSE_DOWN;

        public static const MOUSE_OVER:String=flash.events.MouseEvent.MOUSE_OVER;

        public static const ROLL_OVER:String=flash.events.MouseEvent.ROLL_OVER;

        public static const MOUSE_MOVE:String=flash.events.MouseEvent.MOUSE_MOVE;

        public static const MOUSE_WHEEL:String=flash.events.MouseEvent.MOUSE_WHEEL;

        public static const KEY_UP:String=flash.events.KeyboardEvent.KEY_UP;

        public static const KEY_DOWN:String=flash.events.KeyboardEvent.KEY_DOWN;

        protected var _id:String;

        protected var _targetEvent:flash.events.Event;
    }
}


//          class SystemKeyboardEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemKeyboardEvent extends mgs.aurora.common.events.SystemInteractionEvent
    {
        public function SystemKeyboardEvent(arg1:String, arg2:String, arg3:flash.events.KeyboardEvent, arg4:Boolean=false, arg5:Boolean=false)
        {
            super(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemKeyboardEvent(type, _id, _targetEvent as flash.events.KeyboardEvent, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemKeyboardEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public static const KEY_UP:String=mgs.aurora.common.events.SystemInteractionEvent.KEY_UP;

        public static const KEY_DOWN:String=mgs.aurora.common.events.SystemInteractionEvent.KEY_DOWN;
    }
}


//          class SystemMouseEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemMouseEvent extends mgs.aurora.common.events.SystemInteractionEvent
    {
        public function SystemMouseEvent(arg1:String, arg2:String, arg3:flash.events.MouseEvent, arg4:Boolean=false, arg5:Boolean=false)
        {
            super(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemMouseEvent(type, _id, _targetEvent as flash.events.MouseEvent, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemMouseEvent", "type", "id", "targetEvent", "bubbles", "cancelable", "eventPhase");
        }

        public static const MOUSE_UP:String=mgs.aurora.common.events.SystemInteractionEvent.MOUSE_UP;

        public static const MOUSE_OUT:String=mgs.aurora.common.events.SystemInteractionEvent.MOUSE_OUT;

        public static const ROLL_OUT:String=mgs.aurora.common.events.SystemInteractionEvent.ROLL_OUT;

        public static const DOUBLE_CLICK:String=mgs.aurora.common.events.SystemInteractionEvent.DOUBLE_CLICK;

        public static const CLICK:String=mgs.aurora.common.events.SystemInteractionEvent.CLICK;

        public static const RIGHT_CLICK:String=mgs.aurora.common.events.SystemInteractionEvent.RIGHT_CLICK;

        public static const MOUSE_DOWN:String=mgs.aurora.common.events.SystemInteractionEvent.MOUSE_DOWN;

        public static const MOUSE_OVER:String=mgs.aurora.common.events.SystemInteractionEvent.MOUSE_OVER;

        public static const ROLL_OVER:String=mgs.aurora.common.events.SystemInteractionEvent.ROLL_OVER;

        public static const MOUSE_MOVE:String=mgs.aurora.common.events.SystemInteractionEvent.MOUSE_MOVE;

        public static const MOUSE_WHEEL:String=mgs.aurora.common.events.SystemInteractionEvent.MOUSE_WHEEL;
    }
}


//          class SystemPreloaderEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemPreloaderEvent extends flash.events.Event
    {
        public function SystemPreloaderEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemPreloaderEvent(type, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemPreloaderEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public static const NAME:String="SystemPreloaderEvent";

        public static const SHOW:String=NAME + "/show";

        public static const HIDE:String=NAME + "/hide";
    }
}


//          class SystemSelectionEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemSelectionEvent extends flash.events.Event
    {
        public function SystemSelectionEvent(arg1:String, arg2:String, arg3:Boolean=false, arg4:Boolean=false)
        {
            super(arg1, arg3, arg4);
            this.id = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemSelectionEvent(type, this.id, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemSelectionEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="system/selection/event";

        public static const SELECTED:String=NAME + "/selected";

        public static const DESELECTED:String=NAME + "/deselected";

        public static const SELECTION_CHANGE:String=NAME + "/selection_change";

        public var id:String;
    }
}


//          class SystemSharedObjectEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemSharedObjectEvent extends flash.events.Event
    {
        public function SystemSharedObjectEvent(arg1:String, arg2:String, arg3:String, arg4:*, arg5:String=null, arg6:Boolean=false, arg7:Boolean=false, arg8:Boolean=false)
        {
            super(arg1, arg7, arg8);
            this._keyName = arg3;
            this._keyValue = arg4;
            this._localPath = arg5;
            this._secure = arg6;
            this._storageName = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemSharedObjectEvent(type, this.storageName, this.keyName, this._keyValue, this.localPath, this.secure, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemSharedObjectEvent", "type", "storageName", "keyName", "keyValue", "localPath", "secure", "bubbles", "cancelable", "eventPhase");
        }

        public function get storageName():String
        {
            return this._storageName;
        }

        public function get keyName():String
        {
            return this._keyName;
        }

        public function get keyValue():*
        {
            return this._keyValue;
        }

        public function get localPath():String
        {
            return this._localPath;
        }

        public function get secure():Boolean
        {
            return this._secure;
        }

        internal static const NAME:String="system/sharedObject/event";

        public static const PENDING:String=NAME + "/pending";

        public static const SUCCESS:String=NAME + "/success";

        public static const FAILED:String=NAME + "/failed";

        internal var _storageName:String;

        internal var _keyName:String;

        internal var _keyValue:*;

        internal var _localPath:String;

        internal var _secure:Boolean;
    }
}


//          class SystemSoundEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    import flash.media.*;
    
    public class SystemSoundEvent extends flash.events.Event
    {
        public function SystemSoundEvent(arg1:String, arg2:String, arg3:String, arg4:flash.media.SoundChannel, arg5:Boolean=false, arg6:Boolean=false)
        {
            super(arg1, arg5, arg6);
            this._id = arg2;
            this._group = arg3;
            this._channel = arg4;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemSoundEvent(type, this.id, this.group, this.channel, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemSoundEvent", "type", "id", "group", "channel", "bubbles", "cancelable", "eventPhase");
        }

        public function get group():String
        {
            return this._group;
        }

        public function get id():String
        {
            return this._id;
        }

        public function get channel():flash.media.SoundChannel
        {
            return this._channel;
        }

        internal static const NAME:String="api/sound/event";

        public static const COMPLETE:String=NAME + "/complete";

        public static const VOLUMEOVERTIME:String=NAME + "/volumeovertime";

        public static const PANOVERTIME:String=NAME + "/panovertime";

        public static const MUTE:String=NAME + "/mute";

        public static const VOLUME:String=NAME + "/volume";

        public static const STOPPED:String=NAME + "/stopped";

        internal var _group:String;

        internal var _id:String;

        internal var _channel:flash.media.SoundChannel;
    }
}


//          class SystemStoreEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemStoreEvent extends flash.events.Event
    {
        public function SystemStoreEvent(arg1:String, arg2:String, arg3:String, arg4:Boolean=false, arg5:Boolean=false)
        {
            super(arg1, arg4, arg5);
            this._name = arg2;
            this._value = arg3;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemStoreEvent(type, this.name, this.value, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemStoreEvent", "type", "name", "value", "bubbles", "cancelable", "eventPhase");
        }

        public function get name():String
        {
            return this._name;
        }

        public function get value():String
        {
            return this._value;
        }

        public static const NAME:String="SystemStoreEvent";

        public static const STORENAMEVALUE:String=NAME + "/storenamevalue";

        internal var _name:String;

        internal var _value:String;
    }
}


//          class SystemTextEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemTextEvent extends flash.events.Event
    {
        public function SystemTextEvent(arg1:String, arg2:String, arg3:Boolean=false, arg4:Boolean=false)
        {
            super(arg1, arg3, arg4);
            this.id = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemTextEvent(type, this.id, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemTextEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="system/text/event";

        public static const CHANGE:String=NAME + "/change";

        public static const TEXT_INPUT:String=NAME + "/text_input";

        public var id:String;
    }
}


//          class SystemToolTipEvent
package mgs.aurora.common.events 
{
    import flash.events.*;
    
    public class SystemToolTipEvent extends flash.events.Event
    {
        public function SystemToolTipEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.common.events.SystemToolTipEvent(type, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("SystemToolTipEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="/system/tooltip/event";

        public static const SHOWING:String=NAME + "/showing";

        public static const REMOVED:String=NAME + "/removed";
    }
}


//        package interfaces
//          package banking
//            class IBanking
package mgs.aurora.common.interfaces.banking 
{
    import flash.events.*;
    import mgs.aurora.common.vo.banking.*;
    
    public interface IBanking extends flash.events.IEventDispatcher
    {
        function initialise(arg1:mgs.aurora.common.vo.banking.BankingDependencies):void;

        function refreshBalance():void;

        function setUserBalance(arg1:Number):void;

        function get balance():Number;

        function launchBank():void;

        function launchQuickBank():void;

        function promptForCash():void;

        function reset():void;

        function showRefreshDialogue():void;
    }
}


//          package bonusBubble
//            class IBonusBubble
package mgs.aurora.common.interfaces.bonusBubble 
{
    import flash.display.*;
    import flash.events.*;
    import flash.geom.*;
    import flash.utils.*;
    
    public interface IBonusBubble extends flash.events.IEventDispatcher
    {
        function setup(arg1:flash.utils.Dictionary):void;

        function reset():void;

        function setCreditsFormatting(arg1:Boolean, arg2:String=".", arg3:String=" "):void;

        function changeSettings(arg1:flash.utils.Dictionary):void;

        function get trigger():flash.display.InteractiveObject;

        function set trigger(arg1:flash.display.InteractiveObject):void;

        function get coordinates():flash.geom.Point;

        function set coordinates(arg1:flash.geom.Point):void;

        function get supported():Boolean;

        function get enabled():Boolean;

        function set enabled(arg1:Boolean):void;

        function get display():Boolean;

        function set display(arg1:Boolean):void;

        function show():void;
    }
}


//          package comms
//            class IXMan
package mgs.aurora.common.interfaces.comms 
{
    public interface IXMan extends mgs.aurora.common.interfaces.comms.IXManPacketSender
    {
        function setup(arg1:Object):void;

        function startSessionTimer():void;

        function stopSessionTimer():void;

        function stopPacketTimer():void;

        function clearPendingPacketQueue():void;

        function setClientLang(arg1:String):void;

        function setSessionID(arg1:String):void;

        function startPing():void;

        function stopPing():void;

        function setServerID(arg1:String):void;

        function updateTimerConfig(arg1:Object):void;
    }
}


//            class IXManPacketSender
package mgs.aurora.common.interfaces.comms 
{
    import flash.events.*;
    import flash.utils.*;
    
    public interface IXManPacketSender extends flash.events.IEventDispatcher
    {
        function sendPacket(arg1:flash.utils.Dictionary):void;
    }
}


//          package controls
//            class IAbstractControlList
package mgs.aurora.common.interfaces.controls 
{
    import flash.events.*;
    
    public interface IAbstractControlList extends flash.events.IEventDispatcher
    {
        function enable(arg1:String):void;

        function enableAll():void;

        function disable(arg1:String):void;

        function disableAll():void;

        function show(arg1:String):void;

        function showAll():void;

        function hide(arg1:String):void;

        function hideAll():void;

        function remove(arg1:String):void;

        function removeAll():void;

        function get enabledList():String;

        function get disabledList():String;

        function get visibleList():String;

        function get hiddenList():String;

        function get list():String;
    }
}


//            class IButton
package mgs.aurora.common.interfaces.controls 
{
    public interface IButton extends mgs.aurora.common.interfaces.controls.IControl
    {
        function get tabIndex():int;

        function set tabIndex(arg1:int):void;

        function get textField():mgs.aurora.common.interfaces.controls.IText;

        function setState(arg1:String):void;
    }
}


//            class IButtonList
package mgs.aurora.common.interfaces.controls 
{
    public interface IButtonList extends mgs.aurora.common.interfaces.controls.IAbstractControlList
    {
        function getButton(arg1:String):mgs.aurora.common.interfaces.controls.IButton;

        function hasButtons(arg1:String):Boolean;
    }
}


//            class ICheckBox
package mgs.aurora.common.interfaces.controls 
{
    public interface ICheckBox extends mgs.aurora.common.interfaces.controls.IButton
    {
        function get checked():Boolean;

        function set checked(arg1:Boolean):void;
    }
}


//            class ICheckBoxList
package mgs.aurora.common.interfaces.controls 
{
    public interface ICheckBoxList extends mgs.aurora.common.interfaces.controls.IAbstractControlList
    {
        function getCheckBox(arg1:String):mgs.aurora.common.interfaces.controls.ICheckBox;

        function hasCheckBox(arg1:String):Boolean;
    }
}


//            class IClonable
package mgs.aurora.common.interfaces.controls 
{
    public interface IClonable
    {
        function clone(... rest):*;
    }
}


//            class IComboBox
package mgs.aurora.common.interfaces.controls 
{
    public interface IComboBox extends mgs.aurora.common.interfaces.controls.IControl
    {
        function get editable():Boolean;

        function set editable(arg1:Boolean):void;

        function get selectedIndex():int;

        function set selectedIndex(arg1:int):void;

        function get selectedItem():Object;

        function get text():String;

        function set text(arg1:String):void;

        function get textField():mgs.aurora.common.interfaces.controls.IInputText;

        function get numItems():int;

        function addItem(arg1:Object):void;

        function addItemAt(arg1:Object, arg2:uint):void;

        function close():void;

        function getItemAt(arg1:uint):Object;

        function open():void;

        function removeAll():void;

        function removeItem(arg1:Object):Object;

        function removeItemAt(arg1:uint):Object;

        function replaceItemAt(arg1:Object, arg2:uint):Object;
    }
}


//            class IComboBoxList
package mgs.aurora.common.interfaces.controls 
{
    public interface IComboBoxList extends mgs.aurora.common.interfaces.controls.IControlList
    {
        function getComboBox(arg1:String):mgs.aurora.common.interfaces.controls.IComboBox;

        function hasComboBox(arg1:String):Boolean;
    }
}


//            class IControl
package mgs.aurora.common.interfaces.controls 
{
    import flash.display.*;
    import flash.events.*;
    
    public interface IControl extends flash.events.IEventDispatcher
    {
        function get id():String;

        function set id(arg1:String):void;

        function get type():String;

        function get x():Number;

        function set x(arg1:Number):void;

        function get y():Number;

        function set y(arg1:Number):void;

        function get width():Number;

        function set width(arg1:Number):void;

        function get height():Number;

        function set height(arg1:Number):void;

        function get enabled():Boolean;

        function set enabled(arg1:Boolean):void;

        function get visible():Boolean;

        function set visible(arg1:Boolean):void;

        function get hitTest():Boolean;

        function get interactiveObject():flash.display.InteractiveObject;

        function get filters():Array;

        function set filters(arg1:Array):void;

        function get alpha():Number;

        function set alpha(arg1:Number):void;

        function addToContainer(arg1:flash.display.DisplayObjectContainer):void;

        function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void;

        function removeFromContainer():void;

        function dispose():void;
    }
}


//            class IControlDimensions
package mgs.aurora.common.interfaces.controls 
{
    public interface IControlDimensions
    {
        function get x():Number;

        function get y():Number;

        function get width():Number;

        function get height():Number;

        function get minWidth():Number;

        function get maxWidth():Number;

        function get minHeight():Number;

        function get maxHeight():Number;
    }
}


//            class IControlGroup
package mgs.aurora.common.interfaces.controls 
{
    public interface IControlGroup extends mgs.aurora.common.interfaces.controls.IControlList
    {
        function linkToGroup(arg1:String):void;

        function unlinkFromGroup(arg1:String):void;
    }
}


//            class IControlList
package mgs.aurora.common.interfaces.controls 
{
    import flash.events.*;
    
    public interface IControlList extends flash.events.IEventDispatcher
    {
        function enableControls(arg1:String):void;

        function enableAllControls():void;

        function disableControls(arg1:String):void;

        function disableAllControls():void;

        function showControls(arg1:String):void;

        function showAllControls():void;

        function hideControls(arg1:String):void;

        function hideAllControls():void;

        function getControl(arg1:String):mgs.aurora.common.interfaces.controls.IControl;

        function hasControls(arg1:String):Boolean;

        function get enabledList():String;

        function get disabledList():String;

        function get visibleList():String;

        function get hiddenList():String;
    }
}


//            class IControlManager
package mgs.aurora.common.interfaces.controls 
{
    import __AS3__.vec.*;
    import flash.display.*;
    
    public interface IControlManager extends mgs.aurora.common.interfaces.controls.IControlList
    {
        function getGroup(arg1:String):mgs.aurora.common.interfaces.controls.IControlGroup;

        function createGroups(arg1:String):void;

        function removeGroups(arg1:String):void;

        function removeAllGroups():void;

        function hasGroups(arg1:String):Boolean;

        function linkControlsToGroups(arg1:String, arg2:String):void;

        function unlinkControlsFromGroups(arg1:String, arg2:String):void;

        function addControl(arg1:mgs.aurora.common.interfaces.controls.ICustomControl, arg2:flash.display.DisplayObjectContainer, arg3:String=null):void;

        function addControls(arg1:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.ICustomControl>, arg2:flash.display.DisplayObjectContainer, arg3:String=null):void;

        function removeControls(arg1:String):void;

        function removeAllControls():void;

        function lockAllControls(arg1:Boolean=true):void;

        function unlockAllControls(arg1:Boolean=true):void;

        function changeControl(arg1:String, arg2:String, arg3:String=""):void;
    }
}


//            class ICustomControl
package mgs.aurora.common.interfaces.controls 
{
    public interface ICustomControl extends mgs.aurora.common.interfaces.controls.IControl
    {
        function get locked():Boolean;

        function set locked(arg1:Boolean):void;

        function get text():String;

        function set text(arg1:String):void;
    }
}


//            class IGraphic
package mgs.aurora.common.interfaces.controls 
{
    public interface IGraphic extends mgs.aurora.common.interfaces.controls.IControl
    {
        function get scaleX():Number;

        function set scaleX(arg1:Number):void;

        function get scaleY():Number;

        function set scaleY(arg1:Number):void;
    }
}


//            class IGraphicsList
package mgs.aurora.common.interfaces.controls 
{
    public interface IGraphicsList extends mgs.aurora.common.interfaces.controls.IControlList
    {
        function getGraphic(arg1:String):mgs.aurora.common.interfaces.controls.ITimelineGraphic;

        function hasGraphic(arg1:String):Boolean;
    }
}


//            class IInputText
package mgs.aurora.common.interfaces.controls 
{
    public interface IInputText extends mgs.aurora.common.interfaces.controls.IText
    {
        function setFocus():void;

        function setSelection(arg1:int, arg2:int):void;

        function get caretIndex():int;

        function get selectionBeginIndex():int;

        function get selectionEndIndex():int;
    }
}


//            class IList
package mgs.aurora.common.interfaces.controls 
{
    public interface IList extends mgs.aurora.common.interfaces.controls.IControl
    {
        function get selectedIndex():int;

        function set selectedIndex(arg1:int):void;

        function get selectedItem():Object;

        function get numItems():int;

        function addItem(arg1:Object):void;

        function addItemAt(arg1:Object, arg2:uint):void;

        function getItemAt(arg1:uint):Object;

        function removeAll():void;

        function removeItem(arg1:Object):Object;

        function removeItemAt(arg1:uint):Object;

        function replaceItemAt(arg1:Object, arg2:uint):Object;
    }
}


//            class IRadioButton
package mgs.aurora.common.interfaces.controls 
{
    public interface IRadioButton extends mgs.aurora.common.interfaces.controls.IButton
    {
        function get selected():Boolean;

        function set selected(arg1:Boolean):void;

        function get group():mgs.aurora.common.interfaces.controls.IRadioButtonGroup;

        function set group(arg1:mgs.aurora.common.interfaces.controls.IRadioButtonGroup):void;
    }
}


//            class IRadioButtonGroup
package mgs.aurora.common.interfaces.controls 
{
    import flash.events.*;
    
    public interface IRadioButtonGroup extends flash.events.IEventDispatcher
    {
        function get id():String;

        function get selected():mgs.aurora.common.interfaces.controls.IRadioButton;

        function addRadioButton(arg1:mgs.aurora.common.interfaces.controls.IRadioButton):void;
    }
}


//            class IRadioButtonList
package mgs.aurora.common.interfaces.controls 
{
    public interface IRadioButtonList extends mgs.aurora.common.interfaces.controls.IAbstractControlList
    {
        function getRadioButton(arg1:String):mgs.aurora.common.interfaces.controls.IRadioButton;

        function hasRadioButtons(arg1:String):Boolean;
    }
}


//            class IStaticText
package mgs.aurora.common.interfaces.controls 
{
    public interface IStaticText extends mgs.aurora.common.interfaces.controls.IControl
    {
        function get text():String;

        function set text(arg1:String):void;
    }
}


//            class IText
package mgs.aurora.common.interfaces.controls 
{
    import flash.text.*;
    
    public interface IText extends mgs.aurora.common.interfaces.controls.IControl
    {
        function get text():String;

        function set text(arg1:String):void;

        function get defaultTextFormat():flash.text.TextFormat;

        function set defaultTextFormat(arg1:flash.text.TextFormat):void;

        function get properties():mgs.aurora.common.interfaces.controls.ITextFieldProperties;

        function getTextFormat(arg1:int=-1, arg2:int=-1):flash.text.TextFormat;

        function setTextFormat(arg1:flash.text.TextFormat, arg2:int=-1, arg3:int=-1):void;
    }
}


//            class ITextFieldProperties
package mgs.aurora.common.interfaces.controls 
{
    import flash.events.*;
    
    public interface ITextFieldProperties extends flash.events.IEventDispatcher
    {
        function get type():String;

        function set type(arg1:String):void;

        function get antiAliasType():String;

        function set antiAliasType(arg1:String):void;

        function get background():Boolean;

        function set background(arg1:Boolean):void;

        function get backgroundColor():uint;

        function set backgroundColor(arg1:uint):void;

        function get border():Boolean;

        function set border(arg1:Boolean):void;

        function get borderColor():uint;

        function set borderColor(arg1:uint):void;

        function get displayAsPassword():Boolean;

        function set displayAsPassword(arg1:Boolean):void;

        function get embedFonts():Boolean;

        function set embedFonts(arg1:Boolean):void;

        function get gridFitType():String;

        function set gridFitType(arg1:String):void;

        function get html():Boolean;

        function set html(arg1:Boolean):void;

        function get maxChars():int;

        function set maxChars(arg1:int):void;

        function get multiline():Boolean;

        function set multiline(arg1:Boolean):void;

        function get restrict():String;

        function set restrict(arg1:String):void;

        function get selectable():Boolean;

        function set selectable(arg1:Boolean):void;

        function get sharpness():Number;

        function set sharpness(arg1:Number):void;

        function get thickness():Number;

        function set thickness(arg1:Number):void;

        function get wordWrap():Boolean;

        function set wordWrap(arg1:Boolean):void;
    }
}


//            class ITextList
package mgs.aurora.common.interfaces.controls 
{
    public interface ITextList extends mgs.aurora.common.interfaces.controls.IAbstractControlList
    {
        function getText(arg1:String):mgs.aurora.common.interfaces.controls.IText;

        function getInputText(arg1:String):mgs.aurora.common.interfaces.controls.IInputText;

        function hasText(arg1:String):Boolean;
    }
}


//            class ITimelineGraphic
package mgs.aurora.common.interfaces.controls 
{
    import flash.display.*;
    
    public interface ITimelineGraphic extends mgs.aurora.common.interfaces.controls.IGraphic
    {
        function get display():flash.display.MovieClip;

        function gotoAndStop(arg1:Object):void;
    }
}


//          package currency
//            class ICurrency
package mgs.aurora.common.interfaces.currency 
{
    public interface ICurrency
    {
        function getFormatfromISOCode(arg1:String, arg2:int, arg3:Boolean):String;

        function getDefaultFormat():String;

        function getDisplaySysmbolFromISOCode(arg1:String, arg2:int):String;
    }
}


//          package dialogues
//            class IDialogue
package mgs.aurora.common.interfaces.dialogues 
{
    import mgs.aurora.common.interfaces.controls.*;
    
    public interface IDialogue extends mgs.aurora.common.interfaces.controls.IControl
    {
        function get controls():mgs.aurora.common.interfaces.controls.IControlList;

        function get buttons():mgs.aurora.common.interfaces.controls.IButtonList;

        function get graphics():mgs.aurora.common.interfaces.controls.IGraphicsList;

        function get texts():mgs.aurora.common.interfaces.controls.ITextList;

        function get checkBoxes():mgs.aurora.common.interfaces.controls.ICheckBoxList;

        function get radioButtons():mgs.aurora.common.interfaces.controls.IRadioButtonList;

        function get comboBoxes():mgs.aurora.common.interfaces.controls.IComboBoxList;

        function get title():mgs.aurora.common.interfaces.controls.IText;

        function addControl(arg1:mgs.aurora.common.interfaces.controls.IControl):void;

        function addBackground(arg1:mgs.aurora.common.interfaces.controls.IControl):void;
    }
}


//            class IDialoguesHandler
package mgs.aurora.common.interfaces.dialogues 
{
    import flash.display.*;
    import flash.events.*;
    
    public interface IDialoguesHandler extends flash.events.IEventDispatcher
    {
        function get id():String;

        function create(arg1:String, arg2:String, arg3:flash.display.DisplayObjectContainer=null, arg4:XMLList=null, arg5:XMLList=null, arg6:flash.display.LoaderInfo=null, arg7:flash.display.LoaderInfo=null, arg8:flash.display.LoaderInfo=null):void;

        function remove(arg1:String):void;

        function removeAll():void;

        function dialogue(arg1:String):mgs.aurora.common.interfaces.dialogues.IDialogue;

        function set layoutConfig(arg1:XML):void;

        function get layoutConfig():XML;

        function set uiConfig(arg1:XML):void;

        function get uiConfig():XML;

        function set art(arg1:flash.display.LoaderInfo):void;

        function get art():flash.display.LoaderInfo;

        function set artLang(arg1:flash.display.LoaderInfo):void;

        function get artLang():flash.display.LoaderInfo;

        function set fonts(arg1:flash.display.LoaderInfo):void;

        function get fonts():flash.display.LoaderInfo;

        function get displayedList():String;

        function get numDisplayed():int;

        function get globalNumDisplayed():int;
    }
}


//            class IDialoguesModule
package mgs.aurora.common.interfaces.dialogues 
{
    import flash.display.*;
    import flash.events.*;
    
    public interface IDialoguesModule extends flash.events.IEventDispatcher
    {
        function get displayCount():uint;

        function setStageResolution(arg1:Number, arg2:Number):void;

        function setLayoutConfig(arg1:XML):void;

        function setLayoutMappingConfig(arg1:XML):void;

        function setCustomLayoutConfig(arg1:XML):void;

        function removeCustomLayout():void;

        function setControlsConfig(arg1:XML):void;

        function setFonts(arg1:flash.display.LoaderInfo):void;

        function setArt(arg1:flash.display.LoaderInfo):void;

        function setArtLanguage(arg1:flash.display.LoaderInfo):void;

        function getNewHandler(arg1:String=null):mgs.aurora.common.interfaces.dialogues.IDialoguesHandler;

        function getHandler(arg1:String):mgs.aurora.common.interfaces.dialogues.IDialoguesHandler;

        function removeAllDialogues():void;
    }
}


//          package frames
//            package frame
//              package assets
//                class IBalanceButton
package mgs.aurora.common.interfaces.frames.frame.assets 
{
    import flash.display.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public interface IBalanceButton extends mgs.aurora.common.interfaces.controls.ICustomControl
    {
        function get balanceButton():flash.display.InteractiveObject;

        function set balanceButton(arg1:flash.display.InteractiveObject):void;
    }
}


//                class IChipSelector
package mgs.aurora.common.interfaces.frames.frame.assets 
{
    import __AS3__.vec.*;
    import flash.events.*;
    
    public interface IChipSelector extends flash.events.IEventDispatcher
    {
        function get displayType():String;

        function set displayType(arg1:String):void;

        function get index():uint;

        function set index(arg1:uint):void;

        function get range():__AS3__.vec.Vector.<uint>;

        function set range(arg1:__AS3__.vec.Vector.<uint>):void;

        function get value():uint;

        function set value(arg1:uint):void;

        function set incAndDecButtonVisiblity(arg1:Boolean):void;

        function set incForciblyEnabled(arg1:Boolean):void;

        function set decForciblyEnabled(arg1:Boolean):void;
    }
}


//                class IClock
package mgs.aurora.common.interfaces.frames.frame.assets 
{
    public interface IClock
    {
        function showTime():void;

        function hideTime():void;
    }
}


//                class ICredits
package mgs.aurora.common.interfaces.frames.frame.assets 
{
    import __AS3__.vec.*;
    
    public interface ICredits
    {
        function alternate(arg1:__AS3__.vec.Vector.<String>, arg2:int):void;

        function stopAlternate():void;

        function set word(arg1:String):void;

        function set value(arg1:String):void;
    }
}


//                class IExternalSites
package mgs.aurora.common.interfaces.frames.frame.assets 
{
    import flash.events.*;
    import mgs.aurora.common.interfaces.loader.*;
    
    public interface IExternalSites extends flash.events.IEventDispatcher
    {
        function configuration(arg1:XML, arg2:mgs.aurora.common.interfaces.loader.IDependenciesConfig):void;

        function dispose():void;
    }
}


//                class IFrameControls
package mgs.aurora.common.interfaces.frames.frame.assets 
{
    import mgs.aurora.common.interfaces.controls.*;
    
    public interface IFrameControls
    {
        function get buttons():mgs.aurora.common.interfaces.controls.IControlManager;

        function get graphics():mgs.aurora.common.interfaces.controls.IControlManager;

        function get texts():mgs.aurora.common.interfaces.controls.IControlManager;
    }
}


//                class IFrameHeading
package mgs.aurora.common.interfaces.frames.frame.assets 
{
    import __AS3__.vec.*;
    import flash.geom.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public interface IFrameHeading extends mgs.aurora.common.interfaces.controls.IText
    {
        function get alternatingIntervalSize():int;

        function get alternatingText():__AS3__.vec.Vector.<String>;

        function alternateText(arg1:__AS3__.vec.Vector.<String>, arg2:int):void;

        function reset():void;

        function restoreTitleDisplay():void;

        function restoreTitleColour():void;

        function set backGroundVisible(arg1:Boolean):void;

        function get backGroundVisible():Boolean;

        function movebackGround(arg1:flash.geom.Point):void;

        function set textVisible(arg1:Boolean):void;

        function get textVisible():Boolean;

        function moveText(arg1:flash.geom.Point):void;

        function set alignText(arg1:String):void;

        function get alignText():String;

        function systemAlternateText(arg1:__AS3__.vec.Vector.<String>, arg2:int):void;

        function get color():uint;

        function set color(arg1:uint):void;

        function get bold():Boolean;

        function set bold(arg1:Boolean):void;

        function get italic():Boolean;

        function set italic(arg1:Boolean):void;

        function get underline():Boolean;

        function set underline(arg1:Boolean):void;
    }
}


//                class IQuickMute
package mgs.aurora.common.interfaces.frames.frame.assets 
{
    import mgs.aurora.common.interfaces.controls.*;
    
    public interface IQuickMute extends mgs.aurora.common.interfaces.controls.ICustomControl
    {
        function on():void;

        function off():void;

        function get state():String;
    }
}


//                class IToolTip
package mgs.aurora.common.interfaces.frames.frame.assets 
{
    import flash.events.*;
    import flash.geom.*;
    
    public interface IToolTip extends flash.events.IEventDispatcher
    {
        function remove():void;

        function show(arg1:String, arg2:flash.geom.Point=null):void;

        function update(arg1:String):void;

        function configuration(arg1:XML):void;

        function dispose():void;
    }
}


//              class IFrame
package mgs.aurora.common.interfaces.frames.frame 
{
    import flash.display.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    
    public interface IFrame
    {
        function get canvas():flash.display.Sprite;

        function get chipSelector():mgs.aurora.common.interfaces.frames.frame.assets.IChipSelector;

        function get controls():mgs.aurora.common.interfaces.frames.frame.assets.IFrameControls;

        function get heading():mgs.aurora.common.interfaces.frames.frame.assets.IFrameHeading;

        function addGameLayout(arg1:XML):void;

        function gameLayoutComplete():void;

        function switchComplete():void;

        function addToContainer(arg1:flash.display.DisplayObjectContainer):void;

        function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void;

        function removeFromContainer():void;

        function get quickMute():mgs.aurora.common.interfaces.frames.frame.assets.IQuickMute;

        function get tooltip():mgs.aurora.common.interfaces.frames.frame.assets.IToolTip;

        function get assetHolder():flash.display.MovieClip;

        function get externalSitesManager():mgs.aurora.common.interfaces.frames.frame.assets.IExternalSites;

        function get infoTextBackGround():flash.display.MovieClip;

        function get credits():mgs.aurora.common.interfaces.frames.frame.assets.ICredits;

        function get clock():mgs.aurora.common.interfaces.frames.frame.assets.IClock;

        function get balanceButton():mgs.aurora.common.interfaces.frames.frame.assets.IBalanceButton;
    }
}


//            class IFrames
package mgs.aurora.common.interfaces.frames 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.interfaces.frames.frame.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.common.interfaces.sounds.*;
    
    public interface IFrames extends flash.events.IEventDispatcher
    {
        function get bonusBubbleTrigger():flash.display.InteractiveObject;

        function set bonusBubbleTrigger(arg1:flash.display.InteractiveObject):void;

        function get currentFrame():mgs.aurora.common.interfaces.frames.frame.IFrame;

        function get tooltip():mgs.aurora.common.interfaces.frames.frame.assets.IToolTip;

        function get clockFeatureOn():Boolean;

        function set clockFeatureOn(arg1:Boolean):void;

        function switchTo(arg1:String, arg2:String):void;

        function addToContainer(arg1:flash.display.DisplayObjectContainer):void;

        function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void;

        function removeFromContainer():void;

        function initialize(arg1:flash.display.LoaderInfo, arg2:flash.display.LoaderInfo, arg3:XML, arg4:XML, arg5:mgs.aurora.common.interfaces.sounds.ISounds, arg6:Object):void;

        function set excludeList(arg1:__AS3__.vec.Vector.<String>):void;

        function get systemButtons():mgs.aurora.common.interfaces.controls.IControlManager;

        function get externalSites():mgs.aurora.common.interfaces.frames.frame.assets.IExternalSites;

        function startConnectClip():void;

        function stopConnectClip():void;

        function set mute(arg1:int):void;

        function set show(arg1:Boolean):void;

        function updateAfterUserSwitch():void;
    }
}


//          package gameObserver
//            class IGameObserver
package mgs.aurora.common.interfaces.gameObserver 
{
    public interface IGameObserver
    {
        function initialize(... rest):void;

        function fileLoaded(... rest):void;

        function preloaderRemoved(... rest):void;

        function gameBusy(... rest):void;

        function gameCleanedUp(... rest):void;

        function gameInitialized(... rest):void;
    }
}


//          package loader
//            class IDependenciesConfig
package mgs.aurora.common.interfaces.loader 
{
    public interface IDependenciesConfig
    {
        function getVersionedFilename(arg1:String):String;
    }
}


//            class IURLLoadRequestInfo
package mgs.aurora.common.interfaces.loader 
{
    import flash.net.*;
    
    public interface IURLLoadRequestInfo
    {
        function get id():String;

        function get url():String;

        function get type():String;

        function get context():*;

        function get requestHeaders():flash.net.URLRequestHeader;

        function get variables():flash.net.URLVariables;

        function get method():String;

        function get loaderDataFormat():String;

        function get fallback():Object;
    }
}


//            class IURLLoadResponseInfo
package mgs.aurora.common.interfaces.loader 
{
    public interface IURLLoadResponseInfo
    {
        function get request():mgs.aurora.common.interfaces.loader.IURLLoadRequestInfo;

        function get content():*;

        function get bytesLoaded():uint;

        function get bytesTotal():uint;

        function get progress():Number;

        function get status():int;
    }
}


//            class IURLLoader
package mgs.aurora.common.interfaces.loader 
{
    public interface IURLLoader
    {
        function start():void;

        function stop():void;

        function dispose():void;

        function getResponseInfo():mgs.aurora.common.interfaces.loader.IURLLoadResponseInfo;
    }
}


//          package magneto
//            class IMagneto
package mgs.aurora.common.interfaces.magneto 
{
    public interface IMagneto extends mgs.aurora.common.interfaces.magneto.IMagnetoPacketSender
    {
        function connect(arg1:String):void;

        function setup(arg1:XML):void;

        function close(arg1:String):void;
    }
}


//            class IMagnetoPacketSender
package mgs.aurora.common.interfaces.magneto 
{
    import flash.events.*;
    
    public interface IMagnetoPacketSender extends flash.events.IEventDispatcher
    {
        function sendData(arg1:String, arg2:XML, arg3:uint, arg4:uint, arg5:uint):void;

        function sendMultiplayerData(arg1:String, arg2:uint, arg3:XML):void;
    }
}


//          package marketManager
//            class IMarketManager
package mgs.aurora.common.interfaces.marketManager 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.common.interfaces.strings.*;
    
    public interface IMarketManager extends flash.events.IEventDispatcher
    {
        function setup(arg1:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler, arg2:mgs.aurora.common.interfaces.comms.IXManPacketSender, arg3:mgs.aurora.common.interfaces.strings.ILanguageStrings, arg4:flash.utils.Dictionary):void;

        function systemLoaded(arg1:Object):void;

        function showLoginDialog(arg1:Object):void;

        function sendLoginRequest(arg1:Object):void;

        function loggedInSuccessFull(arg1:Object):void;

        function loadGameModule(arg1:Object):void;

        function exitGameModule(arg1:Object):void;

        function showErrorDialog(arg1:Object):void;

        function casinoTimeout(arg1:Object):void;

        function bankButtonPressed(arg1:Object):void;

        function returnFromBank(arg1:Object):void;

        function helpButtonPressed(arg1:Object):void;

        function balanceUpdated(arg1:Object):void;

        function sendCloseGameLogoutRequest(arg1:Object):void;
    }
}


//          package multiplayer
//            class IMPF
package mgs.aurora.common.interfaces.multiplayer 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.common.interfaces.magneto.*;
    
    public interface IMPF extends flash.events.IEventDispatcher
    {
        function setup(arg1:XML, arg2:mgs.aurora.common.interfaces.magneto.IMagnetoPacketSender, arg3:Object, arg4:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler, arg5:XML, arg6:XML, arg7:flash.utils.Dictionary):void;

        function attemptLobbyConnection():void;

        function attemptRouterConnection():void;

        function attemptConnections():void;

        function cancelAvatar(arg1:String):void;

        function fetchAvatarMetadata(arg1:String):void;

        function loadAvatar(arg1:String):void;

        function sendPacket(arg1:String, arg2:uint, arg3:XML):void;

        function closeConnection():void;

        function attemptRegistration():void;
    }
}


//          package raptorSessions
//            class ILegacyRaptorSession
package mgs.aurora.common.interfaces.raptorSessions 
{
    public interface ILegacyRaptorSession extends mgs.aurora.common.interfaces.raptorSessions.IRaptorSession
    {
        function attemptChangePassword(arg1:Object):void;
    }
}


//            class IRaptorSession
package mgs.aurora.common.interfaces.raptorSessions 
{
    import flash.events.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    
    public interface IRaptorSession extends flash.events.IEventDispatcher
    {
        function initialize(arg1:mgs.aurora.common.interfaces.comms.IXManPacketSender, arg2:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler):void;

        function attemptLogin(arg1:Object):void;
    }
}


//            class ISgiRaptorSession
package mgs.aurora.common.interfaces.raptorSessions 
{
    public interface ISgiRaptorSession extends mgs.aurora.common.interfaces.raptorSessions.IRaptorSession
    {
        function doLogout():void;
    }
}


//            class IUPEFullLoginRaptorSession
package mgs.aurora.common.interfaces.raptorSessions 
{
    public interface IUPEFullLoginRaptorSession extends mgs.aurora.common.interfaces.raptorSessions.IRaptorSession
    {
    }
}


//            class IUPEInterimLoginRaptorSession
package mgs.aurora.common.interfaces.raptorSessions 
{
    public interface IUPEInterimLoginRaptorSession extends mgs.aurora.common.interfaces.raptorSessions.IRaptorSession
    {
    }
}


//            class IVanguardRaptorSession
package mgs.aurora.common.interfaces.raptorSessions 
{
    public interface IVanguardRaptorSession extends mgs.aurora.common.interfaces.raptorSessions.IRaptorSession
    {
        function switchUserType(arg1:uint):void;
    }
}


//          package sounds
//            class ISoundGroup
package mgs.aurora.common.interfaces.sounds 
{
    import flash.events.*;
    import flash.media.*;
    
    public interface ISoundGroup extends flash.events.IEventDispatcher
    {
        function play(arg1:String, arg2:Number=0, arg3:int=0, arg4:flash.media.SoundTransform=null):void;

        function stop(arg1:String):void;

        function stopAll():void;

        function remove(arg1:Array):void;

        function removeAll():void;

        function setChannelVolume(arg1:Array, arg2:Number):void;

        function setChannelPan(arg1:Array, arg2:Number):void;

        function setChannelLeftToLeft(arg1:Array, arg2:Number):void;

        function setChannelLeftToRight(arg1:Array, arg2:Number):void;

        function setChannelRightToRight(arg1:Array, arg2:Number):void;

        function setChannelRightToLeft(arg1:Array, arg2:Number):void;

        function setChannelMute(arg1:Array, arg2:Boolean):void;

        function getChannelMute(arg1:Array):Boolean;

        function setChannelVolumeOverTime(arg1:Array, arg2:Number, arg3:Number, arg4:Number):void;

        function setChannelPanOverTime(arg1:Array, arg2:Number, arg3:Number, arg4:Number):void;

        function stopVolumeOverTime(arg1:String):void;

        function stopPanOverTime(arg1:String):void;

        function set mute(arg1:Boolean):void;

        function get mute():Boolean;

        function set volume(arg1:Number):void;

        function get volume():Number;

        function getChannel(arg1:String):flash.media.SoundChannel;
    }
}


//            class ISounds
package mgs.aurora.common.interfaces.sounds 
{
    import flash.display.*;
    import flash.events.*;
    import flash.media.*;
    
    public interface ISounds extends flash.events.IEventDispatcher
    {
        function add(arg1:flash.display.LoaderInfo, arg2:Array, arg3:String):mgs.aurora.common.interfaces.sounds.ISoundGroup;

        function play(arg1:String, arg2:String, arg3:Number=0, arg4:int=0, arg5:flash.media.SoundTransform=null):void;

        function stop(arg1:String, arg2:String):void;

        function stopAll(arg1:String):void;

        function remove(arg1:Array, arg2:String):void;

        function removeAll(arg1:String):void;

        function setChannelVolume(arg1:Array, arg2:Number, arg3:String):void;

        function setChannelPan(arg1:Array, arg2:Number, arg3:String):void;

        function setChannelLeftToLeft(arg1:Array, arg2:Number, arg3:String):void;

        function setChannelLeftToRight(arg1:Array, arg2:Number, arg3:String):void;

        function setChannelRightToRight(arg1:Array, arg2:Number, arg3:String):void;

        function setChannelRightToLeft(arg1:Array, arg2:Number, arg3:String):void;

        function setChannelMute(arg1:Array, arg2:Boolean, arg3:String):void;

        function getChannelMute(arg1:Array, arg2:String):Boolean;

        function set mute(arg1:Boolean):void;

        function get mute():Boolean;

        function set globalVolume(arg1:Number):void;

        function get globalVolume():Number;

        function set globalPan(arg1:Number):void;

        function get globalPan():Number;

        function set globalLeftToLeft(arg1:Number):void;

        function get globalLeftToLeft():Number;

        function set globalLeftToRight(arg1:Number):void;

        function get globalLeftToRight():Number;

        function set globalRightToRight(arg1:Number):void;

        function get globalRightToRight():Number;

        function set globalRightToLeft(arg1:Number):void;

        function get globalRightToLeft():Number;

        function setChannelVolumeOverTime(arg1:Array, arg2:String, arg3:Number, arg4:Number, arg5:Number):void;

        function setChannelPanOverTime(arg1:Array, arg2:String, arg3:Number, arg4:Number, arg5:Number):void;

        function stopVolumeOverTime(arg1:String, arg2:String):void;

        function stopPanOverTime(arg1:String, arg2:String):void;

        function group(arg1:String):mgs.aurora.common.interfaces.sounds.ISoundGroup;

        function getChannel(arg1:String):flash.media.SoundChannel;
    }
}


//          package strings
//            class ILanguageStrings
package mgs.aurora.common.interfaces.strings 
{
    public interface ILanguageStrings
    {
        function getString(arg1:String):String;
    }
}


//          package vpb
//            class IIsGameValidParameters
package mgs.aurora.common.interfaces.vpb 
{
    public interface IIsGameValidParameters
    {
        function get moduleID():Number;

        function get clientID():Number;
    }
}


//            class IVPB
package mgs.aurora.common.interfaces.vpb 
{
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.common.interfaces.sounds.*;
    
    public interface IVPB extends flash.events.IEventDispatcher
    {
        function setup(arg1:XML, arg2:mgs.aurora.common.interfaces.comms.IXManPacketSender, arg3:Object, arg4:mgs.aurora.common.interfaces.sounds.ISounds, arg5:flash.utils.Dictionary):void;

        function enable():void;

        function disable():void;

        function setArtAsset(arg1:flash.display.LoaderInfo):void;

        function setDialogParent(arg1:flash.display.DisplayObjectContainer):void;

        function setFrameType(arg1:String):void;

        function gameIsValid(arg1:Boolean):void;

        function webAppAvailable(arg1:Boolean):void;

        function webAppLaunchDetails(arg1:flash.utils.Dictionary):void;
    }
}


//        package net
//          class URLLoadRequestInfo
package mgs.aurora.common.net 
{
    import flash.net.*;
    import mgs.aurora.common.interfaces.loader.*;
    
    public class URLLoadRequestInfo extends Object implements mgs.aurora.common.interfaces.loader.IURLLoadRequestInfo
    {
        public function URLLoadRequestInfo(arg1:String, arg2:String, arg3:String, arg4:*=null, arg5:flash.net.URLRequestHeader=null, arg6:flash.net.URLVariables=null, arg7:String="GET", arg8:String="text", arg9:Object=null)
        {
            super();
            this._id = arg1;
            this._url = arg2;
            this._type = arg3;
            this._context = arg4;
            this._requestHeaders = arg5;
            this._variables = arg6;
            this._method = arg7;
            this._loaderDataFormat = arg8;
            this._fallback = new Object();
            if (arg9 != null) 
            {
                this._fallback = arg9;
            }
            return;
        }

        public function get id():String
        {
            return this._id;
        }

        public function get url():String
        {
            return this._url;
        }

        public function get type():String
        {
            return this._type;
        }

        public function get context():*
        {
            return this._context;
        }

        public function get requestHeaders():flash.net.URLRequestHeader
        {
            return this._requestHeaders;
        }

        public function get variables():flash.net.URLVariables
        {
            return this._variables;
        }

        public function get method():String
        {
            return this._method;
        }

        public function get loaderDataFormat():String
        {
            return this._loaderDataFormat;
        }

        public function get fallback():Object
        {
            return this._fallback;
        }

        protected var _id:String;

        protected var _url:String;

        protected var _type:String;

        protected var _context:*;

        protected var _requestHeaders:flash.net.URLRequestHeader;

        protected var _variables:flash.net.URLVariables;

        protected var _method:String;

        protected var _loaderDataFormat:String;

        protected var _fallback:Object;
    }
}


//        package pipes
//          class CommsPipeMessages
package mgs.aurora.common.pipes 
{
    public class CommsPipeMessages extends Object
    {
        public function CommsPipeMessages()
        {
            super();
            return;
        }

        public static const NAME:String="Comms";

        public static const SETUP:String=NAME + "/pipes/setup";

        public static const SETUP_COMPLETE:String=NAME + "/pipes/setup_complete";

        public static const ERROR:String=NAME + "/pipes/error";

        public static const SEND_PACKET:String=NAME + "/pipes/send_packet";

        public static const PACKET_SENT:String=NAME + "/pipes/packet_sent";

        public static const PACKET_RECEIVED:String=NAME + "/pipes/packet_received";

        public static const START_SESSION_TIMEOUT:String=NAME + "/pipes/start_session_timeout";

        public static const SESSION_TIMEOUT_STARTED:String=NAME + "/pipes/session_timeout_started";

        public static const STOP_SESSION_TIMEOUT:String=NAME + "/pipes/stop_session_timeout";

        public static const SESSION_TIMEOUT_STOPPED:String=NAME + "/pipes/session_timeout_stopped";

        public static const SESSION_TIMED_OUT:String=NAME + "/pipes/session_timed_out";

        public static const PACKET_TIMED_OUT:String=NAME + "/pipes/packet_timed_out";

        public static const SET_CLIENT_LANG:String=NAME + "/pipes/set_client_lang";

        public static const SET_SESSION_ID:String=NAME + "/pipes/set_session_id";

        public static const CLEAR_PENDING_PACKET_QUEUE:String=NAME + "/pipes/clear_pending_packet_queue";
    }
}


//          class FramesBuilderPipeMessages
package mgs.aurora.common.pipes 
{
    public class FramesBuilderPipeMessages extends Object
    {
        public function FramesBuilderPipeMessages()
        {
            super();
            return;
        }

        public static const NAME:String="FramesBuilderPipeMessages";

        public static const CONTROLS_BUILDER_CONNECT:String=NAME + "/message/Controls_Builder_Connect";

        public static const CONTROLS_BUILDER_DISCONNECT:String=NAME + "/message/Controls_Builder_Disconnect";

        public static const SET_ART:String=NAME + "/message/Set_Art";

        public static const SET_CONFIG:String=NAME + "/message/Set_Config";

        public static const SET_FONT:String=NAME + "/message/Set_Font";

        public static const SET_FRAME_DEFINITIONS:String=NAME + "/message/Set_Frame_Definitions";

        public static const GET_FRAME:String=NAME + "/message/Get_Frame";

        public static const CREATE_FRAMES:String=NAME + "/message/Create_Frames";

        public static const FRAME_CREATED:String=NAME + "/message/frame_created";
    }
}


//          class LoginPipeMessages
package mgs.aurora.common.pipes 
{
    public class LoginPipeMessages extends Object
    {
        public function LoginPipeMessages()
        {
            super();
            return;
        }

        public static const NAME:String="LegacyLogin";

        public static const ATTEMPT_LOGIN:String=NAME + "/pipes/attempt_login";

        public static const LOGIN_FAILED:String=NAME + "/pipes/login_failed";

        public static const LOGIN_SUCCESSFULL:String=NAME + "/pipes/login_successfull";

        public static const ATTEMPT_CHANGE_PASSWORD:String=NAME + "/pipes/change_password";

        public static const CHANGE_PASSWORD_FAILED:String=NAME + "/pipes/change_password_failed";

        public static const CHANGE_PASSWORD_SUCCESSFULL:String=NAME + "/pipes/change_password_successfull";

        public static const PACKET_REQUEST:String=NAME + "/pipes/packet_request";

        public static const PACKET_RESPONSE:String=NAME + "/pipes/packet_response";

        public static const SET_XMAN_SESSIONID:String=NAME + "/pipes/set_xman_sessionid";
    }
}


//          class PipeNames
package mgs.aurora.common.pipes 
{
    public class PipeNames extends Object
    {
        public function PipeNames()
        {
            super();
            return;
        }

        internal static const NAME:String="pipe_names";

        public static const TO_AURORA_CORE:String=NAME + "/pipe/to_aurora_core";

        public static const FROM_AURORA_CORE:String=NAME + "/pipe/from_aurora_core";

        public static const TO_AURORA_COMMS:String=NAME + "/pipe/to_aurora_comms";

        public static const FROM_AURORA_COMMS:String=NAME + "/pipe/from_aurora_comms";

        public static const TO_AURORA_SOUNDS:String=NAME + "/pipe/to_aurora_sounds";

        public static const FROM_AURORA_SOUNDS:String=NAME + "/pipe/from_aurora_sounds";

        public static const TO_AURORA_VPB:String=NAME + "/pipe/to_aurora_vpb";

        public static const FROM_AURORA_VPB:String=NAME + "/pipe/from_aurora_vpb";

        public static const TO_AURORA_CONTROLS_BUILDER:String=NAME + "/pipe/to_aurora_controls_builder";

        public static const FROM_AURORA_CONTROLS_BUILDER:String=NAME + "/pipe/from_aurora_controls_builder";

        public static const TO_AURORA_LEGACY_LOGIN:String=NAME + "/pipe/to_aurora_legacy_login";

        public static const FROM_AURORA_LEGACY_LOGIN:String=NAME + "/pipe/from_aurora_legacy_login";

        public static const TO_FRAMES_BUILDER:String="/pipe/to_aurora_frames_builder";

        public static const FROM_FRAMES_BUILDER:String="/pipe/from_aurora_frames_builder";

        public static const TO_AURORA_GAME_MODULE:String="/pipe/to_game_aurora_module";

        public static const FROM_AURORA_GAME_MODULE:String="/pipe/from_game_aurora_module";
    }
}


//          class VPBMessages
package mgs.aurora.common.pipes 
{
    public class VPBMessages extends Object
    {
        public function VPBMessages()
        {
            super();
            return;
        }

        public static const NAME:String="VPB";

        public static const SETUP:String=NAME + "/pipes/setup";

        public static const ENABLE:String=NAME + "/pipes/enable";

        public static const DISABLE:String=NAME + "/pipes/disable";

        public static const PACKET_RECEIVED:String=NAME + "/pipes/packet_received";

        public static const GAME_CHECK_COMPLETE:String=NAME + "/pipes/game_check_complete";

        public static const SET_DIALOG_PARENT:String=NAME + "/pipes/set_dialog_parent";

        public static const SET_ART_ASSET:String=NAME + "/pipes/set_art_asset";

        public static const SET_FRAME_TYPE:String=NAME + "/pipes/set_frame_art";

        public static const WEB_APP_CHECK_COMPLETE:String=NAME + "/pipes/web_app_check_complete";

        public static const ACTION_NOTIFICATION:String=NAME + "/pipes/action_notification";

        public static const SEND_PACKET:String=NAME + "/pipes/send_packet";

        public static const SETUP_COMPLETE:String=NAME + "/pipes/setup_complete";

        public static const ERROR:String=NAME + "/pipes/error";

        public static const GAME_CHECK:String=NAME + "/pipes/game_check";

        public static const WEB_APP_CHECK:String=NAME + "/pipes/web_app_check";
    }
}


//        package utilities
//          class BalanceUtils
package mgs.aurora.common.utilities 
{
    import __AS3__.vec.*;
    import mgs.aurora.common.vo.currency.*;
    
    public class BalanceUtils extends Object
    {
        public function BalanceUtils()
        {
            super();
            this._abbreviateFormats = new Vector.<mgs.aurora.common.vo.currency.AbbreviationFormat>();
            return;
        }

        public function addAbbreviationFormat(arg1:mgs.aurora.common.vo.currency.AbbreviationFormat):void
        {
            this._abbreviateFormats.push(arg1);
            this._abbreviateFormats.sort(this.compare);
            return;
        }

        internal function compare(arg1:mgs.aurora.common.vo.currency.AbbreviationFormat, arg2:mgs.aurora.common.vo.currency.AbbreviationFormat):Number
        {
            return arg2.value - arg1.value;
        }

        public function get allowMultipler():Boolean
        {
            return this._allowMultipler;
        }

        public function set allowMultipler(arg1:Boolean):void
        {
            this._allowMultipler = arg1;
            return;
        }

        public function get allowAbbreviate():Boolean
        {
            return this._allowAbbreviate;
        }

        public function set allowAbbreviate(arg1:Boolean):void
        {
            this._allowAbbreviate = arg1;
            return;
        }

        public function get multiplier():uint
        {
            return this._multiplier;
        }

        public function set multiplier(arg1:uint):void
        {
            this._multiplier = arg1;
            return;
        }

        internal function abbreviateValue(arg1:Number):String
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=NaN;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=0;
            var loc7:*=this._abbreviateFormats;
            for each (loc2 in loc7) 
            {
                if (!(arg1 >= loc2.value)) 
                {
                    continue;
                }
                loc3 = arg1 / loc2.value;
                if (!((loc5 = (loc4 = String(loc3).split(".")).length != 2 ? "" : String(loc4[1])).length <= 2)) 
                {
                    continue;
                }
                loc1 = BalanceUtils.addThousandSeparator(loc3) + loc2.character;
                return loc1;
            }
            return "";
        }

        public static function getInstance():mgs.aurora.common.utilities.BalanceUtils
        {
            if (BalanceUtils.__instance__ == null) 
            {
                BalanceUtils.__instance__ = new BalanceUtils();
            }
            return BalanceUtils.__instance__ as BalanceUtils;
        }

        public static function addThousandSeparator(arg1:Number):String
        {
            var loc5:*=0;
            var loc6:*=null;
            var loc1:*=arg1.toString();
            var loc2:*="";
            var loc3:*=loc1.length;
            var loc4:*=",";
            if (loc1.indexOf(".") == -1) 
            {
                loc5 = loc3 >= 3 ? 3 : loc3;
                loc6 = loc1.substr(loc3 - loc5, loc5);
                loc1 = loc1.substr(0, loc3 - loc5);
                loc3 = loc1.length;
                while (loc5 == 3 && loc3 > 0) 
                {
                    loc2 = loc4 + loc6 + loc2;
                    loc5 = loc3 >= 3 ? 3 : loc3;
                    loc6 = loc1.substr(loc3 - loc5, loc5);
                    loc1 = loc1.substr(0, loc3 - loc5);
                    loc3 = loc1.length;
                }
                loc2 = loc6 + loc2;
                return loc2;
            }
            return loc1;
        }

        public static function formatNumberToCurrencyDisplay(arg1:Number, arg2:String, arg3:Boolean=true, arg4:Boolean=true):String
        {
            var loc5:*=null;
            var loc1:*;
            var loc2:*=(loc1 = getCurrencyInfoFromFormatString(arg2)).display;
            var loc3:*=loc1.front;
            var loc4:*;
            if ((loc4 = BalanceUtils.getInstance()).allowMultipler && arg4) 
            {
                arg1 = arg1 * loc4.multiplier;
            }
            if (loc4.allowAbbreviate && arg3) 
            {
                if ((loc5 = loc4.abbreviateValue(arg1)) != "") 
                {
                    return loc3 ? loc2 + loc5 : loc5 + " " + loc2;
                }
            }
            loc5 = internalFormatNumberToCreditsDisplay(arg1, arg2);
            return loc3 ? loc2 + loc5 : loc5 + loc2;
        }

        public static function formatNumberToCreditsDisplay(arg1:Number, arg2:String, arg3:Boolean=true, arg4:Boolean=true):String
        {
            var loc2:*=null;
            var loc1:*;
            if ((loc1 = BalanceUtils.getInstance()).allowMultipler && arg4) 
            {
                arg1 = arg1 * loc1.multiplier;
            }
            if (loc1.allowAbbreviate && arg3) 
            {
                if ((loc2 = loc1.abbreviateValue(arg1)) != "") 
                {
                    return loc2;
                }
            }
            return loc2 = internalFormatNumberToCreditsDisplay(arg1, arg2);
        }

        public static function internalFormatNumberToCreditsDisplay(arg1:Number, arg2:String):String
        {
            var loc7:*=0;
            var loc8:*=null;
            var loc1:*=arg1.toString();
            var loc2:*="";
            var loc3:*=loc1.length;
            var loc4:*;
            var loc5:*=(loc4 = getSeperatorsFromFormatString(arg2)).fraction;
            var loc6:*=loc4.thousands;
            if (loc5.length > 0) 
            {
                if ((loc2 = loc1.substr(loc3 - 2, 2)).length == 1) 
                {
                    loc2 = "0" + loc2;
                }
                loc1 = loc1.substr(0, loc3 - 2);
                loc2 = ((loc3 = loc1.length) != 0 ? "" : "0") + loc5 + loc2;
            }
            if (loc6.length > 0) 
            {
                loc7 = loc3 >= 3 ? 3 : loc3;
                loc8 = loc1.substr(loc3 - loc7, loc7);
                loc1 = loc1.substr(0, loc3 - loc7);
                loc3 = loc1.length;
                while (loc7 == 3 && loc3 > 0) 
                {
                    loc2 = loc6 + loc8 + loc2;
                    loc7 = loc3 >= 3 ? 3 : loc3;
                    loc8 = loc1.substr(loc3 - loc7, loc7);
                    loc1 = loc1.substr(0, loc3 - loc7);
                    loc3 = loc1.length;
                }
                loc2 = loc8 + loc2;
            }
            else 
            {
                loc2 = loc1 + loc2;
            }
            return loc2;
        }

        internal static function getSeperatorsFromFormatString(arg1:String):Object
        {
            var loc1:*=new Object();
            var loc2:*=0;
            var loc3:*=arg1.lastIndexOf("##");
            var loc4:*=arg1.substr((loc3 - 1), 1);
            loc1.fraction = loc4 == "#" ? "" : loc4;
            var loc5:*=arg1.lastIndexOf("###" + loc1.fraction);
            var loc6:*=arg1.substr((loc5 - 1), 1);
            loc1.thousands = loc6 == "#" ? "" : loc6;
            return loc1;
        }

        internal static function getCurrencyInfoFromFormatString(arg1:String):Object
        {
            var loc1:*=new Object();
            loc1.front = arg1.indexOf("#") > 0;
            loc1.display = loc1.front ? arg1.substr(0, arg1.indexOf("#")) : arg1.substr(arg1.lastIndexOf("#") + 1, (arg1.length - 1));
            return loc1;
        }

        public static function convertToCredits(arg1:Number, arg2:Boolean, arg3:String, arg4:String, arg5:Boolean=true, arg6:Boolean=true):String
        {
            var loc3:*=null;
            var loc1:*;
            if ((loc1 = BalanceUtils.getInstance()).allowMultipler && arg6) 
            {
                arg1 = arg1 * loc1.multiplier;
            }
            if (loc1.allowAbbreviate && arg5) 
            {
                if ((loc3 = loc1.abbreviateValue(arg1)) != "") 
                {
                    return loc3;
                }
            }
            arg3 = arg3 != null ? arg3 : ",";
            arg4 = arg4 != null ? arg4 : ".";
            var loc4:*;
            var loc2:*=loc4 = "#" + (arg3.length > 0 && arg2 ? arg3 : "") + "###" + (arg4.length > 0 ? arg4 + "##" : "");
            loc2 = loc4;
            return internalFormatNumberToCreditsDisplay(arg1, loc2);
        }

        public static function convertToCoins(arg1:Number, arg2:Number):Number
        {
            var loc1:*=Math.floor(arg1 / arg2);
            return loc1;
        }

        public static function formatCoinsDisplay(arg1:Number):String
        {
            var loc1:*=BalanceUtils.getInstance();
            var loc2:*="";
            if (loc1.allowAbbreviate) 
            {
                loc2 = loc1.abbreviateValue(arg1 * 100);
                if (loc2 != "") 
                {
                    return loc2;
                }
            }
            var loc3:*;
            loc2 = loc3 = internalFormatNumberToCreditsDisplay(arg1, "# ###");
            return loc3;
        }

        public static function removeMultiplier(arg1:Number):Number
        {
            var loc1:*=BalanceUtils.getInstance();
            if (loc1.allowMultipler) 
            {
                arg1 = Math.floor(arg1 / loc1.multiplier);
            }
            return arg1;
        }

        internal var _allowMultipler:Boolean=false;

        internal var _allowAbbreviate:Boolean=false;

        internal var _multiplier:uint=1;

        internal var _abbreviateFormats:__AS3__.vec.Vector.<mgs.aurora.common.vo.currency.AbbreviationFormat>;

        internal static var __instance__:mgs.aurora.common.utilities.BalanceUtils;
    }
}


//          class EventDispatcherDecorator
package mgs.aurora.common.utilities 
{
    import flash.events.*;
    import flash.utils.*;
    
    public class EventDispatcherDecorator extends flash.events.EventDispatcher
    {
        public function EventDispatcherDecorator(arg1:flash.events.IEventDispatcher=null, arg2:Boolean=false)
        {
            super(arg1);
            this._target = arg2 ? arg1 : null;
            this._proxy = arg2;
            this._listeners = new flash.utils.Dictionary();
            this._count = 0;
            return;
        }

        public override function addEventListener(arg1:String, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            this._listeners[this._count] = {"type":arg1, "listener":arg2, "useCapture":arg3, "count":this._count};
            var loc1:*;
            var loc2:*=((loc1 = this)._count + 1);
            loc1._count = loc2;
            if (this._proxy) 
            {
                this._target.addEventListener(arg1, this.onEvent, arg3, arg4, arg5);
            }
            super.addEventListener(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public override function removeEventListener(arg1:String, arg2:Function, arg3:Boolean=false):void
        {
            this.removeRefrence(arg1);
            if (this._proxy) 
            {
                this._target.removeEventListener(arg1, this.onEvent, arg3);
            }
            super.removeEventListener(arg1, arg2, arg3);
            return;
        }

        public function removeAllEventListeners():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._listeners;
            for each (loc1 in loc3) 
            {
                this.removeEventListener(loc1.type, loc1.listener, loc1.useCapture);
            }
            this._listeners = null;
            this._listeners = new flash.utils.Dictionary();
            this._count = 0;
            return;
        }

        internal function removeRefrence(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._listeners;
            for each (loc1 in loc3) 
            {
                if (loc1.type != arg1) 
                {
                    continue;
                }
                this._listeners[loc1.count] = null;
                delete this._listeners[loc1.count];
                var loc4:*;
                var loc5:*=((loc4 = this)._count - 1);
                loc4._count = loc5;
            }
            return;
        }

        public function dispose():void
        {
            this.removeAllEventListeners();
            this._target = null;
            this._listeners = null;
            this._count = 0;
            return;
        }

        internal function onEvent(arg1:flash.events.Event):void
        {
            dispatchEvent(arg1);
            return;
        }

        internal var _listeners:flash.utils.Dictionary;

        internal var _target:flash.events.IEventDispatcher;

        internal var _proxy:Boolean;

        internal var _count:int;
    }
}


//          class EventUtils
package mgs.aurora.common.utilities 
{
    import flash.events.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.events.dialogues.*;
    
    public class EventUtils extends Object
    {
        public function EventUtils()
        {
            super();
            return;
        }

        public static function addMouseEventsToSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            arg1.addEventListener(flash.events.MouseEvent.CLICK, arg2, arg3, arg4, arg5);
            arg1.addEventListener(flash.events.MouseEvent.DOUBLE_CLICK, arg2, arg3, arg4, arg5);
            arg1.addEventListener(flash.events.MouseEvent.MOUSE_DOWN, arg2, arg3, arg4, arg5);
            arg1.addEventListener(flash.events.MouseEvent.MOUSE_MOVE, arg2, arg3, arg4, arg5);
            arg1.addEventListener(flash.events.MouseEvent.MOUSE_OUT, arg2, arg3, arg4, arg5);
            arg1.addEventListener(flash.events.MouseEvent.MOUSE_OVER, arg2, arg3, arg4, arg5);
            arg1.addEventListener(flash.events.MouseEvent.MOUSE_UP, arg2, arg3, arg4, arg5);
            arg1.addEventListener(flash.events.MouseEvent.MOUSE_WHEEL, arg2, arg3, arg4, arg5);
            arg1.addEventListener(flash.events.MouseEvent.ROLL_OUT, arg2, arg3, arg4, arg5);
            arg1.addEventListener(flash.events.MouseEvent.ROLL_OVER, arg2, arg3, arg4, arg5);
            return;
        }

        public static function removeMouseEventsFromSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false):void
        {
            arg1.removeEventListener(flash.events.MouseEvent.CLICK, arg2, arg3);
            arg1.removeEventListener(flash.events.MouseEvent.DOUBLE_CLICK, arg2, arg3);
            arg1.removeEventListener(flash.events.MouseEvent.MOUSE_DOWN, arg2, arg3);
            arg1.removeEventListener(flash.events.MouseEvent.MOUSE_MOVE, arg2, arg3);
            arg1.removeEventListener(flash.events.MouseEvent.MOUSE_OUT, arg2, arg3);
            arg1.removeEventListener(flash.events.MouseEvent.MOUSE_OVER, arg2, arg3);
            arg1.removeEventListener(flash.events.MouseEvent.MOUSE_UP, arg2, arg3);
            arg1.removeEventListener(flash.events.MouseEvent.MOUSE_WHEEL, arg2, arg3);
            arg1.removeEventListener(flash.events.MouseEvent.ROLL_OUT, arg2, arg3);
            arg1.removeEventListener(flash.events.MouseEvent.ROLL_OVER, arg2, arg3);
            return;
        }

        public static function addKeyEventsToSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            arg1.addEventListener(flash.events.KeyboardEvent.KEY_DOWN, arg2, arg3, arg4, arg5);
            arg1.addEventListener(flash.events.KeyboardEvent.KEY_UP, arg2, arg3, arg4, arg5);
            return;
        }

        public static function removeKeyEventsFromSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false):void
        {
            arg1.removeEventListener(flash.events.KeyboardEvent.KEY_DOWN, arg2, arg3);
            arg1.removeEventListener(flash.events.KeyboardEvent.KEY_UP, arg2, arg3);
            return;
        }

        public static function addSystemMouseEventsToSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.CLICK, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.DOUBLE_CLICK, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_MOVE, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_WHEEL, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OUT, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OVER, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.RIGHT_CLICK, arg2, arg3, arg4, arg5);
            return;
        }

        public static function removeSystemMouseEventsFromSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false):void
        {
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.CLICK, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.DOUBLE_CLICK, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_MOVE, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_WHEEL, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OUT, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OVER, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.RIGHT_CLICK, arg2, arg3);
            return;
        }

        public static function addSystemKeyEventsToSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            arg1.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP, arg2, arg3, arg4, arg5);
            return;
        }

        public static function removeSystemKeyEventsFromSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false):void
        {
            arg1.removeEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP, arg2, arg3);
            return;
        }

        public static function addDialogueMouseEventsToSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.DOUBLE_CLICK, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_DOWN, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_MOVE, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_OUT, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_OVER, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_UP, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_WHEEL, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.ROLL_OUT, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.ROLL_OVER, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.RIGHT_CLICK, arg2, arg3, arg4, arg5);
            return;
        }

        public static function removeDialogueMouseEventsFromSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false):void
        {
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.CLICK, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.DOUBLE_CLICK, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_DOWN, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_MOVE, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_OUT, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_OVER, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_UP, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_WHEEL, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.ROLL_OUT, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.ROLL_OVER, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.RIGHT_CLICK, arg2, arg3);
            return;
        }

        public static function addDialogueKeyEventsToSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_DOWN, arg2, arg3, arg4, arg5);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, arg2, arg3, arg4, arg5);
            return;
        }

        public static function removeDialogueKeyEventsFromSingleMethod(arg1:flash.events.IEventDispatcher, arg2:Function, arg3:Boolean=false):void
        {
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_DOWN, arg2, arg3);
            arg1.removeEventListener(mgs.aurora.common.events.dialogues.DialogueKeyboardEvent.KEY_UP, arg2, arg3);
            return;
        }

        public static function nativeMouseEventToSystemMouseEvent(arg1:flash.events.MouseEvent, arg2:String):mgs.aurora.common.events.SystemMouseEvent
        {
            var loc1:*="";
            var loc2:*=arg1.type;
            switch (loc2) 
            {
                case flash.events.MouseEvent.CLICK:
                {
                    loc1 = mgs.aurora.common.events.SystemMouseEvent.CLICK;
                    break;
                }
                case flash.events.MouseEvent.DOUBLE_CLICK:
                {
                    loc1 = mgs.aurora.common.events.SystemMouseEvent.DOUBLE_CLICK;
                    break;
                }
                case flash.events.MouseEvent.MOUSE_DOWN:
                {
                    loc1 = mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN;
                    break;
                }
                case flash.events.MouseEvent.MOUSE_MOVE:
                {
                    loc1 = mgs.aurora.common.events.SystemMouseEvent.MOUSE_MOVE;
                    break;
                }
                case flash.events.MouseEvent.MOUSE_OUT:
                {
                    loc1 = mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT;
                    break;
                }
                case flash.events.MouseEvent.MOUSE_OVER:
                {
                    loc1 = mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER;
                    break;
                }
                case flash.events.MouseEvent.MOUSE_UP:
                {
                    loc1 = mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP;
                    break;
                }
                case flash.events.MouseEvent.MOUSE_WHEEL:
                {
                    loc1 = mgs.aurora.common.events.SystemMouseEvent.MOUSE_WHEEL;
                    break;
                }
                case flash.events.MouseEvent.ROLL_OUT:
                {
                    loc1 = mgs.aurora.common.events.SystemMouseEvent.ROLL_OUT;
                    break;
                }
                case flash.events.MouseEvent.ROLL_OVER:
                {
                    loc1 = mgs.aurora.common.events.SystemMouseEvent.ROLL_OVER;
                    break;
                }
                default:
                {
                    return null;
                }
            }
            return new mgs.aurora.common.events.SystemMouseEvent(loc1, arg2, arg1);
        }

        public static function nativeKeyboardEventToSystemKeyboardEvent(arg1:flash.events.KeyboardEvent, arg2:String):mgs.aurora.common.events.SystemKeyboardEvent
        {
            var loc1:*="";
            var loc2:*=arg1.type;
            switch (loc2) 
            {
                case flash.events.KeyboardEvent.KEY_DOWN:
                {
                    loc1 = mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN;
                    break;
                }
                case flash.events.KeyboardEvent.KEY_UP:
                {
                    loc1 = mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP;
                    break;
                }
                default:
                {
                    return null;
                }
            }
            return new mgs.aurora.common.events.SystemKeyboardEvent(loc1, arg2, arg1);
        }
    }
}


//          class FlashStorage
package mgs.aurora.common.utilities 
{
    import flash.events.*;
    import flash.net.*;
    import mgs.aurora.common.events.*;
    
    public class FlashStorage extends Object implements flash.events.IEventDispatcher
    {
        public function FlashStorage(arg1:SingletonEnforcer)
        {
            super();
            this._eventDispatcher = new flash.events.EventDispatcher();
            return;
        }

        public function retreiveData(arg1:String, arg2:String, arg3:String=null, arg4:Boolean=false):*
        {
            var storageName:String;
            var keyName:String;
            var localPath:String=null;
            var secure:Boolean=false;
            var value:*;

            var loc1:*;
            value = undefined;
            storageName = arg1;
            keyName = arg2;
            localPath = arg3;
            secure = arg4;
            value = "";
            try 
            {
                this._sharedObject = flash.net.SharedObject.getLocal(storageName, localPath, secure);
                this._sharedObject.objectEncoding = flash.net.ObjectEncoding.AMF0;
                value = this._sharedObject.data[keyName];
            }
            catch (e:Error)
            {
                this.dispatchEvent(new mgs.aurora.common.events.SystemSharedObjectEvent(mgs.aurora.common.events.SystemSharedObjectEvent.FAILED, storageName, keyName, "", localPath, secure));
                return value;
            }
            return value;
        }

        public function setData(arg1:String, arg2:String, arg3:*, arg4:String=null, arg5:Boolean=false):String
        {
            var storageName:String;
            var keyName:String;
            var keyValue:*;
            var localPath:String=null;
            var secure:Boolean=false;
            var flushed:String;

            var loc1:*;
            flushed = null;
            storageName = arg1;
            keyName = arg2;
            keyValue = arg3;
            localPath = arg4;
            secure = arg5;
            this._keyName = keyName;
            this._keyValue = keyValue;
            this._localPath = localPath;
            this._storageName = storageName;
            this._secure = secure;
            flushed = flash.net.SharedObjectFlushStatus.PENDING;
            try 
            {
                this._sharedObject = flash.net.SharedObject.getLocal(storageName, localPath, secure);
                this._sharedObject.objectEncoding = flash.net.ObjectEncoding.AMF0;
                this._sharedObject.data[keyName] = keyValue;
                this._sharedObject.addEventListener(flash.events.NetStatusEvent.NET_STATUS, this.onSharedObjectStatus);
                flushed = this._sharedObject.flush();
            }
            catch (e:Error)
            {
                if (this._sharedObject) 
                {
                    this._sharedObject.removeEventListener(flash.events.NetStatusEvent.NET_STATUS, this.onSharedObjectStatus);
                }
                this.dispatchEvent(new mgs.aurora.common.events.SystemSharedObjectEvent(mgs.aurora.common.events.SystemSharedObjectEvent.FAILED, storageName, keyName, keyValue, localPath, secure));
                return flushed;
            }
            if (flushed != flash.net.SharedObjectFlushStatus.PENDING) 
            {
                if (flushed == flash.net.SharedObjectFlushStatus.FLUSHED) 
                {
                    this.dispatchEvent(new mgs.aurora.common.events.SystemSharedObjectEvent(mgs.aurora.common.events.SystemSharedObjectEvent.SUCCESS, storageName, keyName, keyValue, localPath, secure));
                }
            }
            else 
            {
                this.dispatchEvent(new mgs.aurora.common.events.SystemSharedObjectEvent(mgs.aurora.common.events.SystemSharedObjectEvent.PENDING, storageName, keyName, keyValue, localPath, secure));
            }
            return flushed;
        }

        public function addEventListener(arg1:String, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            this._eventDispatcher.addEventListener(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public function dispatchEvent(arg1:flash.events.Event):Boolean
        {
            return this._eventDispatcher.dispatchEvent(arg1);
        }

        public function hasEventListener(arg1:String):Boolean
        {
            return this._eventDispatcher.hasEventListener(arg1);
        }

        public function removeEventListener(arg1:String, arg2:Function, arg3:Boolean=false):void
        {
            this._eventDispatcher.removeEventListener(arg1, arg2, arg3);
            return;
        }

        public function willTrigger(arg1:String):Boolean
        {
            return this._eventDispatcher.willTrigger(arg1);
        }

        internal function onSharedObjectStatus(arg1:flash.events.NetStatusEvent):void
        {
            this._sharedObject.removeEventListener(flash.events.NetStatusEvent.NET_STATUS, this.onSharedObjectStatus);
            var loc1:*=arg1.info.code;
            switch (loc1) 
            {
                case "SharedObject.Flush.Success":
                {
                    this.dispatchEvent(new mgs.aurora.common.events.SystemSharedObjectEvent(mgs.aurora.common.events.SystemSharedObjectEvent.SUCCESS, this._storageName, this._keyName, this._keyValue, this._localPath, this._secure));
                    break;
                }
                case "SharedObject.Flush.Failed":
                default:
                {
                    this.dispatchEvent(new mgs.aurora.common.events.SystemSharedObjectEvent(mgs.aurora.common.events.SystemSharedObjectEvent.FAILED, this._storageName, this._keyName, this._keyValue, this._localPath, this._secure));
                    this._sharedObject = null;
                    break;
                }
            }
            return;
        }

        public static function getInstance():mgs.aurora.common.utilities.FlashStorage
        {
            if (FlashStorage.__instance__ == null) 
            {
                FlashStorage.__instance__ = new FlashStorage(new SingletonEnforcer());
            }
            return FlashStorage.__instance__;
        }

        public static function saveData(arg1:String, arg2:String, arg3:*, arg4:String=null, arg5:Boolean=false):String
        {
            return FlashStorage.getInstance().setData(arg1, arg2, arg3, arg4, arg5);
        }

        public static function loadData(arg1:String, arg2:String, arg3:String=null, arg4:Boolean=false):*
        {
            return FlashStorage.getInstance().retreiveData(arg1, arg2, arg3, arg4);
        }

        public static function saveSystemData(arg1:String, arg2:*):String
        {
            return FlashStorage.getInstance().setData(FlashStorage.SYSTEM, arg1, arg2);
        }

        public static function loadSystemData(arg1:String):String
        {
            return FlashStorage.getInstance().retreiveData(FlashStorage.SYSTEM, arg1);
        }

        public static function saveDataEncrypted(arg1:String, arg2:String, arg3:String):String
        {
            return "";
        }

        public static function loadDataEncrypted(arg1:String, arg2:String):String
        {
            return "";
        }

        
        {
            __instance__ = null;
        }

        public static const SYSTEM:String="system";

        internal var _eventDispatcher:flash.events.EventDispatcher;

        internal var _sharedObject:flash.net.SharedObject;

        internal var _storageName:String;

        internal var _keyName:String;

        internal var _keyValue:*;

        internal var _localPath:String=null;

        internal var _secure:Boolean=false;

        internal static var __instance__:mgs.aurora.common.utilities.FlashStorage=null;
    }
}


class SingletonEnforcer extends Object
{
    public function SingletonEnforcer()
    {
        super();
        return;
    }
}

//          class FontUtils
package mgs.aurora.common.utilities 
{
    import flash.text.*;
    
    public class FontUtils extends Object
    {
        public function FontUtils()
        {
            super();
            return;
        }

        public static function getFont(arg1:String):flash.text.Font
        {
            var loc1:*=flash.text.Font.enumerateFonts(true);
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (arg1 == flash.text.Font(loc1[loc3]).fontName) 
                {
                    return loc1[loc3] as flash.text.Font;
                }
                ++loc3;
            }
            return null;
        }
    }
}


//          class GUID
package mgs.aurora.common.utilities 
{
    import flash.system.*;
    
    public class GUID extends Object
    {
        public function GUID()
        {
            super();
            return;
        }

        public static function create():String
        {
            var loc1:*=new Date();
            var loc2:*=loc1.getTime();
            var loc3:*=Math.random() * Number.MAX_VALUE;
            var loc4:*=flash.system.Capabilities.serverString;
            var loc7:*;
            var loc5:*;
            var loc6:*;
            return loc6 = (loc5 = calculate(loc2 + loc4 + loc3 + counter++).toUpperCase()).substring(0, 8) + "-" + loc5.substring(8, 12) + "-" + loc5.substring(12, 16) + "-" + loc5.substring(16, 20) + "-" + loc5.substring(20, 32);
        }

        internal static function calculate(arg1:String):String
        {
            return hex_sha1(arg1);
        }

        internal static function hex_sha1(arg1:String):String
        {
            return binb2hex(core_sha1(str2binb(arg1), arg1.length * 8));
        }

        internal static function core_sha1(arg1:Array, arg2:Number):Array
        {
            var loc8:*=NaN;
            var loc9:*=NaN;
            var loc10:*=NaN;
            var loc11:*=NaN;
            var loc12:*=NaN;
            var loc13:*=NaN;
            var loc14:*=NaN;
            arg1[arg2 >> 5] = arg1[arg2 >> 5] | 128 << 24 - arg2 % 32;
            arg1[(arg2 + 64 >> 9 << 4) + 15] = arg2;
            var loc1:*=new Array(80);
            var loc2:*=1732584193;
            var loc3:*=-271733879;
            var loc4:*=-1732584194;
            var loc5:*=271733878;
            var loc6:*=-1009589776;
            var loc7:*=0;
            while (loc7 < arg1.length) 
            {
                loc8 = loc2;
                loc9 = loc3;
                loc10 = loc4;
                loc11 = loc5;
                loc12 = loc6;
                loc13 = 0;
                while (loc13 < 80) 
                {
                    if (loc13 < 16) 
                    {
                        loc1[loc13] = arg1[loc7 + loc13];
                    }
                    else 
                    {
                        loc1[loc13] = rol(loc1[loc13 - 3] ^ loc1[loc13 - 8] ^ loc1[loc13 - 14] ^ loc1[loc13 - 16], 1);
                    }
                    loc14 = safe_add(safe_add(rol(loc2, 5), sha1_ft(loc13, loc3, loc4, loc5)), safe_add(safe_add(loc6, loc1[loc13]), sha1_kt(loc13)));
                    loc6 = loc5;
                    loc5 = loc4;
                    loc4 = rol(loc3, 30);
                    loc3 = loc2;
                    loc2 = loc14;
                    ++loc13;
                }
                loc2 = safe_add(loc2, loc8);
                loc3 = safe_add(loc3, loc9);
                loc4 = safe_add(loc4, loc10);
                loc5 = safe_add(loc5, loc11);
                loc6 = safe_add(loc6, loc12);
                loc7 = loc7 + 16;
            }
            return new Array(loc2, loc3, loc4, loc5, loc6);
        }

        internal static function sha1_ft(arg1:Number, arg2:Number, arg3:Number, arg4:Number):Number
        {
            if (arg1 < 20) 
            {
                return arg2 & arg3 | ~arg2 & arg4;
            }
            if (arg1 < 40) 
            {
                return arg2 ^ arg3 ^ arg4;
            }
            if (arg1 < 60) 
            {
                return arg2 & arg3 | arg2 & arg4 | arg3 & arg4;
            }
            return arg2 ^ arg3 ^ arg4;
        }

        internal static function sha1_kt(arg1:Number):Number
        {
            return arg1 < 20 ? 1518500249 : arg1 < 40 ? 1859775393 : arg1 < 60 ? -1894007588 : -899497514;
        }

        internal static function safe_add(arg1:Number, arg2:Number):Number
        {
            var loc1:*=(arg1 & 65535) + (arg2 & 65535);
            var loc2:*;
            return (loc2 = (arg1 >> 16) + (arg2 >> 16) + (loc1 >> 16)) << 16 | loc1 & 65535;
        }

        internal static function rol(arg1:Number, arg2:Number):Number
        {
            return arg1 << arg2 | arg1 >>> 32 - arg2;
        }

        internal static function str2binb(arg1:String):Array
        {
            var loc1:*=new Array();
            var loc2:*=(1 << 8 - 1);
            var loc3:*=0;
            while (loc3 < arg1.length * 8) 
            {
                loc1[loc3 >> 5] = loc1[loc3 >> 5] | (arg1.charCodeAt(loc3 / 8) & loc2) << 24 - loc3 % 32;
                loc3 = loc3 + 8;
            }
            return loc1;
        }

        internal static function binb2hex(arg1:Array):String
        {
            var loc1:*=new String("");
            var loc2:*=new String("0123456789abcdef");
            var loc3:*=0;
            while (loc3 < arg1.length * 4) 
            {
                loc1 = loc1 + (loc2.charAt(arg1[loc3 >> 2] >> (3 - loc3 % 4) * 8 + 4 & 15) + loc2.charAt(arg1[loc3 >> 2] >> (3 - loc3 % 4) * 8 & 15));
                ++loc3;
            }
            return loc1;
        }

        
        {
            counter = 0;
        }

        internal static var counter:Number=0;
    }
}


//          class GraphicsUtils
package mgs.aurora.common.utilities 
{
    import flash.display.*;
    import flash.geom.*;
    
    public class GraphicsUtils extends Object
    {
        public function GraphicsUtils()
        {
            super();
            return;
        }

        public static function drawFocusRect(arg1:flash.display.Sprite, arg2:Number, arg3:Number, arg4:Number, arg5:Number, arg6:Number):void
        {
            arg1.graphics.lineStyle(0, 0, 0);
            var loc1:*=Math.round((arg4 - 1)) / 3;
            var loc2:*=Math.round(loc1 * 3 - arg4 / 3);
            var loc3:*=Math.round((arg5 - 1)) / 3;
            var loc4:*=Math.round(loc3 * 3 - arg5 / 3);
            drawHorizontalFocusRectLine(arg1.graphics, arg2, arg3, arg4, arg6, Math.round(loc2 / loc1));
            drawVerticalFocusRectLine(arg1.graphics, arg2, arg3, arg5, arg6, Math.round(loc4 / loc3));
            drawHorizontalFocusRectLine(arg1.graphics, arg2, arg3 + arg5, arg4, arg6, Math.round(loc2 / loc1));
            drawVerticalFocusRectLine(arg1.graphics, arg2 + arg4, arg3, arg5, arg6, Math.round(loc4 / loc3));
            return;
        }

        internal static function drawHorizontalFocusRectLine(arg1:flash.display.Graphics, arg2:Number, arg3:Number, arg4:Number, arg5:Number, arg6:Number):void
        {
            var loc1:*=0;
            while (loc1 < arg4) 
            {
                arg1.beginFill(arg5, 100);
                arg1.drawCircle(arg2 + loc1 + 0.5, Math.round(arg3) + 0.5, 0.5);
                arg1.endFill();
                loc1 = loc1 + arg6;
            }
            return;
        }

        internal static function drawVerticalFocusRectLine(arg1:flash.display.Graphics, arg2:Number, arg3:Number, arg4:Number, arg5:Number, arg6:Number):void
        {
            var loc1:*=0;
            while (loc1 < arg4) 
            {
                arg1.beginFill(arg5, 100);
                arg1.drawCircle(Math.round(arg2) + 0.5, arg3 + loc1 + 0.5, 0.5);
                arg1.endFill();
                loc1 = loc1 + arg6;
            }
            return;
        }

        public static function drawRectangle(arg1:flash.display.Graphics, arg2:Number, arg3:Number, arg4:Number, arg5:Number, arg6:Number, arg7:Number=undefined, arg8:Number=undefined):void
        {
            arg1.lineStyle(arg4, arg5, arg6);
            arg1.moveTo(0, 0);
            if (arg7) 
            {
                arg1.beginFill(arg7, arg8);
            }
            arg1.lineTo(arg2, 0);
            arg1.lineTo(arg2, arg3);
            arg1.lineTo(0, arg3);
            arg1.lineTo(0, 0);
            arg1.endFill();
            return;
        }

        public static function verticalAlign(arg1:flash.display.MovieClip, arg2:flash.display.MovieClip, arg3:String):void
        {
            var loc2:*=0;
            var loc1:*=arg2.height / 2;
            var loc3:*=arg3;
            switch (loc3) 
            {
                case V_ALIGN_BOTTOM:
                {
                    loc2 = arg1.y + arg1.height;
                    break;
                }
                case V_ALIGN_MIDDLE:
                {
                    loc2 = arg1.y + arg1.height / 2;
                    break;
                }
                case V_ALIGN_TOP:
                default:
                {
                    loc2 = arg1.y;
                    break;
                }
            }
            arg2.y = loc2 - loc1;
            return;
        }

        public static function horizontalAlign(arg1:flash.display.MovieClip, arg2:flash.display.MovieClip, arg3:String):void
        {
            var loc2:*=0;
            var loc1:*=arg2.width / 2;
            var loc3:*=arg3;
            switch (loc3) 
            {
                case H_ALIGN_RIGHT:
                {
                    loc2 = arg1.x + arg1.width;
                    break;
                }
                case H_ALIGN_LEFT:
                {
                    loc2 = arg1.x;
                    break;
                }
                case H_ALIGN_CENTER:
                default:
                {
                    loc2 = arg1.x + arg1.width / 2;
                    break;
                }
            }
            arg2.x = loc2 - loc1;
            return;
        }

        public static function addPadding(arg1:flash.display.MovieClip, arg2:flash.display.MovieClip, arg3:String, arg4:int):void
        {
            if (arg3 == PADDING_ALL || arg3 == PADDING_LEFT) 
            {
                arg2.x = arg2.x + arg4;
            }
            if (arg3 == PADDING_ALL || arg3 == PADDING_TOP) 
            {
                arg2.y = arg2.y + arg4;
            }
            if (arg3 == PADDING_ALL || arg3 == PADDING_RIGHT) 
            {
                if (arg3 != PADDING_RIGHT) 
                {
                    arg2.width = arg1.width - arg4 * 2;
                }
                else 
                {
                    arg2.width = arg1.width - arg4;
                }
            }
            if (arg3 == PADDING_ALL || arg3 == PADDING_BOTTOM) 
            {
                if (arg3 != PADDING_BOTTOM) 
                {
                    arg2.height = arg1.height - arg4 * 2;
                }
                else 
                {
                    arg2.height = arg1.height - arg4;
                }
            }
            return;
        }

        public static function getVisibleRect(arg1:flash.display.DisplayObject):flash.geom.Rectangle
        {
            var loc2:*=null;
            var loc1:*=2000;
            var loc3:*;
            (loc3 = new flash.display.BitmapData(loc1, loc1, true, 0)).draw(arg1);
            loc2 = loc3.getColorBoundsRect(4278190080, 0, false);
            loc3.dispose();
            return loc2;
        }

        public static function getMovieClipFromLibrary(arg1:String, arg2:flash.display.LoaderInfo):flash.display.MovieClip
        {
            var loc1:*=arg2.applicationDomain.getDefinition(arg1) as Class;
            return new loc1() as flash.display.MovieClip;
        }

        public static function hitTestMouse(arg1:flash.display.MovieClip, arg2:Boolean=false):Boolean
        {
            if (arg1.stage != null) 
            {
                return arg1.hitTestPoint(arg1.mouseX, arg1.mouseX, arg2);
            }
            return false;
        }

        public static const V_ALIGN_BOTTOM:String="bottom";

        public static const V_ALIGN_MIDDLE:String="middle";

        public static const V_ALIGN_TOP:String="top";

        public static const H_ALIGN_RIGHT:String="right";

        public static const H_ALIGN_CENTER:String="center";

        public static const H_ALIGN_LEFT:String="left";

        public static const PADDING_ALL:String="padding";

        public static const PADDING_LEFT:String="paddingleft";

        public static const PADDING_RIGHT:String="paddingright";

        public static const PADDING_TOP:String="paddingtop";

        public static const PADDING_BOTTOM:String="paddingbottom";
    }
}


//          class MgsCommsEventHandlers
package mgs.aurora.common.utilities 
{
    public class MgsCommsEventHandlers extends Object
    {
        public function MgsCommsEventHandlers()
        {
            super();
            return;
        }

        public var onDataReceived:Function;

        public var onSecurityError:Function;

        public var onIOError:Function;

        public var onClose:Function;

        public var onConnect:Function;

        public var onTLSReady:Function;
    }
}


//          class ObjectUtils
package mgs.aurora.common.utilities 
{
    import flash.utils.*;
    
    public class ObjectUtils extends Object
    {
        public function ObjectUtils()
        {
            super();
            return;
        }

        public static function updateFromXML(arg1:XML, arg2:Object):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=0;
            var loc5:*=arg1.attributes();
            for each (loc1 in loc5) 
            {
                loc2 = loc1.name();
                loc3 = loc1.toString();
                if (!arg2.hasOwnProperty(loc2)) 
                {
                    continue;
                }
                if (mgs.aurora.common.utilities.StringUtils.isBoolean(loc3)) 
                {
                    arg2[loc2] = mgs.aurora.common.utilities.StringUtils.stringToBoolean(loc3);
                    continue;
                }
                arg2[loc2] = loc3;
            }
            return;
        }

        public static function updateFromSameTypeObject(arg1:Object, arg2:Object):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=arg1;
            for (loc1 in loc3) 
            {
                arg2[loc1] = arg1[loc1];
            }
            return;
        }

        public static function dictionaryFromXML(arg1:XML, arg2:flash.utils.Dictionary):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=0;
            var loc5:*=arg1.attributes();
            for each (loc1 in loc5) 
            {
                loc2 = loc1.name();
                loc3 = loc1.toString();
                if (mgs.aurora.common.utilities.StringUtils.isBoolean(loc3)) 
                {
                    arg2[loc2] = mgs.aurora.common.utilities.StringUtils.stringToBoolean(loc3);
                    continue;
                }
                arg2[loc2] = loc3;
            }
            return;
        }

        public static function buildObjectFromStrings(arg1:*, arg2:Array):*
        {
            var loc1:*=arg1;
            var loc2:*=0;
            while (loc2 < arg2.length) 
            {
                loc1 = loc1[arg2[loc2]];
                ++loc2;
            }
            return loc1;
        }
    }
}


//          class PostParameters
package mgs.aurora.common.utilities 
{
    import flash.utils.*;
    
    public class PostParameters extends Object
    {
        public function PostParameters()
        {
            super();
            this._postList = new flash.utils.Dictionary();
            return;
        }

        public function setPostParameters(arg1:String, arg2:Object):void
        {
            this._postList[arg1] = arg2;
            return;
        }

        public function getPostParameter(arg1:String, arg2:String):String
        {
            return this._postList[arg1][arg2];
        }

        public function updatePostParamValue(arg1:String, arg2:String, arg3:String):void
        {
            this._postList[arg1][arg2] = arg3;
            return;
        }

        public static function getInstance():mgs.aurora.common.utilities.PostParameters
        {
            if (PostParameters.__instance__ == null) 
            {
                PostParameters.__instance__ = new PostParameters();
            }
            return PostParameters.__instance__ as PostParameters;
        }

        internal var _postList:flash.utils.Dictionary;

        internal static var __instance__:mgs.aurora.common.utilities.PostParameters;
    }
}


//          class StringUtils
package mgs.aurora.common.utilities 
{
    import __AS3__.vec.*;
    import flash.utils.*;
    
    public class StringUtils extends Object
    {
        public function StringUtils()
        {
            super();
            return;
        }

        public static function stringToBoolean(arg1:String):Boolean
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

        public static function StringBooleanToInt(arg1:String):int
        {
            if (arg1 == null) 
            {
                return 0;
            }
            if (arg1.toLowerCase() == "true" || arg1 == "1") 
            {
                return 1;
            }
            return 0;
        }

        public static function isBoolean(arg1:String):Boolean
        {
            if (arg1 == null) 
            {
                return false;
            }
            return arg1.toLowerCase() == "true" || arg1.toLowerCase() == "false";
        }

        public static function dialogueStringToHtml(arg1:String):String
        {
            var loc1:*=new RegExp("-B-", "gi");
            var loc2:*=new RegExp("-B!-", "gi");
            var loc3:*=new RegExp("-I-", "gi");
            var loc4:*=new RegExp("-I!-", "gi");
            var loc5:*=new RegExp("-L-", "gi");
            return arg1.replace(loc1, "<B>").replace(loc2, "</B>").replace(loc3, "<I>").replace(loc4, "</I>").replace(loc5, "<BR>");
        }

        public static function compare(arg1:String, arg2:String, arg3:Boolean=true):Boolean
        {
            if (arg3) 
            {
                return arg1 == arg2;
            }
            return arg1.toLowerCase() == arg2.toLowerCase();
        }

        public static function bytesToString(arg1:flash.utils.ByteArray):String
        {
            var loc1:*="";
            var loc2:*=0;
            while (loc2 < arg1.length) 
            {
                loc1 = loc1 + String.fromCharCode(arg1[loc2]);
                ++loc2;
            }
            return loc1;
        }

        public static function bytesToUTFString(arg1:flash.utils.ByteArray):String
        {
            return arg1.readUTFBytes(arg1.length);
        }

        public static function stringToByteArray(arg1:String):flash.utils.ByteArray
        {
            var loc1:*=new flash.utils.ByteArray();
            var loc2:*=arg1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                loc1.writeByte(arg1.charCodeAt(loc3));
                ++loc3;
            }
            return loc1;
        }

        public static function utfStringToByteArray(arg1:String):flash.utils.ByteArray
        {
            var loc1:*=new flash.utils.ByteArray();
            var loc2:*=arg1.length;
            loc1.writeUTFBytes(arg1);
            return loc1;
        }

        public static function csvStringToVectorOfStrings(arg1:String):__AS3__.vec.Vector.<String>
        {
            var loc3:*=null;
            var loc1:*=new Vector.<String>();
            var loc2:*=arg1.split(",");
            var loc4:*=0;
            var loc5:*=loc2;
            for each (loc3 in loc5) 
            {
                loc1.push(loc3);
            }
            return loc1;
        }

        public static function replaceWithActualValue(arg1:String, arg2:Object, arg3:Boolean=true):String
        {
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=null;
            if (arg1 == "" || arg1 == null || arg2 == null) 
            {
                return "";
            }
            var loc1:*=arg1.split(",");
            var loc2:*=[];
            var loc7:*=0;
            var loc8:*=loc1;
            for each (loc3 in loc8) 
            {
                loc4 = loc3.split("=");
                loc5 = new RegExp("%", "gi");
                loc6 = loc4[1];
                if (loc4.length != 2) 
                {
                    continue;
                }
                if (loc4[1].indexOf("%") != -1) 
                {
                    loc4[1] = loc4[1].replace(loc5, "");
                    loc6 = arg3 ? arg2[loc4[1].toLowerCase()] : arg2[loc4[1]];
                }
                loc2.push(loc4[0] + "=^=" + loc6);
            }
            return loc2.toString();
        }

        public static function replaceStringID(arg1:XML, arg2:XML, arg3:Array):XML
        {
            var target:XML;
            var stringsXML:XML;
            var attribNames:Array;
            var i:int;
            var a:int;

            var loc1:*;
            a = 0;
            target = arg1;
            stringsXML = arg2;
            attribNames = arg3;
            i = 0;
            while (i < attribNames.length) 
            {
                if (target.@[attribNames[i]].length() == 1) 
                {
                    target.@[attribNames[i]].length() == 1;
                    var loc3:*=0;
                    var loc4:*=stringsXML.string;
                    var loc2:*=new XMLList("");
                    for each (var loc5:* in loc4) 
                    {
                        var loc6:*;
                        with (loc6 = loc5) 
                        {
                            if (@ID == target.@[attribNames[i]]) 
                            {
                                loc2[loc3] = loc5;
                            }
                        }
                    }
                }
                if (target.@[attribNames[i]].length() == 1) 
                {
                    loc3 = 0;
                    loc4 = stringsXML.string;
                    loc2 = new XMLList("");
                    for each (loc5 in loc4) 
                    {
                        with (loc6 = loc5) 
                        {
                            if (@ID == target.@[attribNames[i]]) 
                            {
                                loc2[loc3] = loc5;
                            }
                        }
                    }
                    target.@[attribNames[i]] = loc2.@text;
                }
                if (target.children().length() > 0) 
                {
                    a = 0;
                    while (a < target.children().length()) 
                    {
                        mgs.aurora.common.utilities.StringUtils.replaceStringID(target.children()[a], stringsXML, attribNames);
                        ++a;
                    }
                }
                ++i;
            }
            return target;
        }

        public static function updateFromGlobalVars(arg1:XML, arg2:XMLList, arg3:Boolean=true):XML
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc1:*=arg1.toXMLString();
            var loc5:*=0;
            var loc6:*=arg2.children();
            for each (loc2 in loc6) 
            {
                loc3 = arg2.@character + loc2.@id + arg2.@character;
                loc4 = new RegExp(loc3, "g");
                if (!arg3) 
                {
                    loc4 = new RegExp(loc3, "gi");
                }
                loc1 = loc1.replace(loc4, String(loc2.@text));
            }
            return new XML(loc1);
        }

        public static function replace(arg1:String, ... rest):String
        {
            var loc2:*=null;
            var loc1:*=0;
            while (loc1 < rest.length) 
            {
                loc2 = new RegExp("[{]" + loc1 + "}");
                arg1 = arg1.replace(loc2, rest[loc1]);
            }
            return arg1;
        }

        public static function replaceNamedVars(arg1:String, arg2:flash.utils.Dictionary):String
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=0;
            var loc4:*=arg2;
            for (loc1 in loc4) 
            {
                loc2 = new RegExp("[{]" + loc1 + "}");
                arg1 = arg1.replace(loc2, arg2[loc1]);
            }
            return arg1;
        }
    }
}


//        package vo
//          package banking
//            class BankingDependencies
package mgs.aurora.common.vo.banking 
{
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    
    public class BankingDependencies extends Object
    {
        public function BankingDependencies(arg1:mgs.aurora.common.interfaces.comms.IXManPacketSender=null, arg2:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler=null, arg3:Object=null, arg4:XML=null, arg5:XML=null, arg6:XML=null)
        {
            super();
            this.xman = arg1;
            this.dialogues = arg2;
            this.sessionObject = arg3;
            this.config = arg4;
            this.creditDisplayConfig = arg5;
            this.strings = arg6;
            return;
        }

        public var xman:mgs.aurora.common.interfaces.comms.IXManPacketSender;

        public var dialogues:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler;

        public var sessionObject:Object;

        public var config:XML;

        public var creditDisplayConfig:XML;

        public var strings:XML;
    }
}


//          package currency
//            class AbbreviationFormat
package mgs.aurora.common.vo.currency 
{
    public class AbbreviationFormat extends Object
    {
        public function AbbreviationFormat(arg1:Number, arg2:String)
        {
            super();
            this._character = arg2;
            this._value = arg1;
            return;
        }

        public function get character():String
        {
            return this._character;
        }

        public function get value():Number
        {
            return this._value;
        }

        internal var _character:String;

        internal var _value:Number;
    }
}


//          package multiplayer
//            class AvatarMetaData
package mgs.aurora.common.vo.multiplayer 
{
    public class AvatarMetaData extends Object
    {
        public function AvatarMetaData(arg1:String, arg2:String, arg3:String, arg4:String)
        {
            super();
            this.pokerUserAccountID = arg1;
            this.version = arg2;
            this.isRejected = arg3;
            this.imageName = arg4;
            return;
        }

        public var pokerUserAccountID:String;

        public var version:String;

        public var isRejected:String;

        public var imageName:String;
    }
}


//      package modules
//        package xman
//          package controller
//            class BuildRequestPacketCommand
package mgs.aurora.modules.xman.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BuildRequestPacketCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BuildRequestPacketCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc4:*=null;
            var loc5:*=null;
            var loc1:*=arg1.getBody() as flash.utils.Dictionary;
            var loc2:*=facade.retrieveProxy(mgs.aurora.modules.xman.model.XManConfigProxy.NAME) as mgs.aurora.modules.xman.model.XManConfigProxy;
            if (!this.validateRequestData(loc1, loc2)) 
            {
                (loc4 = new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.ERROR)).errorType = mgs.aurora.common.enums.CommsErrorTypes.INVALID_PACKET_REQUEST_DATA;
                Debugger.trace("Required packet data missing", "SYSTEM - Xman Error");
                sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.ERROR, loc4, mgs.aurora.common.enums.CommsErrorTypes.INVALID_PACKET_REQUEST_DATA);
                return;
            }
            if (!this.hasServerID(loc1, loc2)) 
            {
                (loc5 = new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.ERROR)).errorType = mgs.aurora.common.enums.CommsErrorTypes.NO_SERVER_ID_SUPPLIED;
                Debugger.trace("No serverId supplied", "SYSTEM - Xman Error");
                sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.ERROR, loc5, mgs.aurora.common.enums.CommsErrorTypes.NO_SERVER_ID_SUPPLIED);
                return;
            }
            var loc3:*=this.buildHeader(loc1, loc2);
            loc3.Pkt = loc3.Pkt + (loc1[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] as XML);
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET] = loc3;
            return;
        }

        internal function hasServerID(arg1:flash.utils.Dictionary, arg2:mgs.aurora.modules.xman.model.XManConfigProxy):Boolean
        {
            return arg1[mgs.aurora.common.enums.XManPacketParameterKeys.SERVER_ID] || arg2.serverID;
        }

        internal function buildHeader(arg1:flash.utils.Dictionary, arg2:mgs.aurora.modules.xman.model.XManConfigProxy):XML
        {
            var loc1:*=this.buildPktNode(arg1);
            this.buildIdNode(loc1, arg1, arg2);
            this.buildExternalOperatorInfoNode(loc1, arg1);
            return loc1;
        }

        internal function buildIdNode(arg1:XML, arg2:flash.utils.Dictionary, arg3:mgs.aurora.modules.xman.model.XManConfigProxy):void
        {
            arg1.Pkt = arg1.Pkt + new XML("<Id/>");
            arg1.Id.@mid = arg2[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] as String;
            arg1.Id.@cid = arg2[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] as String;
            if (arg2[mgs.aurora.common.enums.XManPacketParameterKeys.SERVER_ID]) 
            {
                arg1.Id.@sid = arg2[mgs.aurora.common.enums.XManPacketParameterKeys.SERVER_ID] as String;
            }
            else 
            {
                arg1.Id.@sid = arg3.serverID;
            }
            arg1.Id.@verb = arg2[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] as String;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManStateProxy.NAME) as mgs.aurora.modules.xman.model.XManStateProxy;
            arg1.Id.@sessionid = loc1.sessionID;
            arg1.Id.@clientLang = arg3.language;
            return;
        }

        internal function buildPktNode(arg1:flash.utils.Dictionary):XML
        {
            var loc1:*=arg1[mgs.aurora.common.enums.XManPacketParameterKeys.PKT_ATTRIBUTES] as String;
            var loc2:*=loc1 ? new XML("<Pkt " + loc1 + "/>") : new XML("<Pkt/>");
            return loc2;
        }

        internal function buildExternalOperatorInfoNode(arg1:XML, arg2:flash.utils.Dictionary):void
        {
            if (arg2[mgs.aurora.common.enums.XManPacketParameterKeys.INCLUDE_EXT_OPERATOR_INFO] == true) 
            {
                arg1.Pkt = arg1.Pkt + new XML("<ExternalOperatorInfo required=\"true\"/>");
            }
            return;
        }

        internal function validateRequestData(arg1:flash.utils.Dictionary, arg2:mgs.aurora.modules.xman.model.XManConfigProxy):Boolean
        {
            var loc1:*=false;
            if (arg1 != null) 
            {
                loc1 = true;
                if (arg1[mgs.aurora.common.enums.XManPacketParameterKeys.PKT_ATTRIBUTES]) 
                {
                    loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.PKT_ATTRIBUTES] as String == null);
                }
                loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] as String == null);
                loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] as String == null);
                if (arg1[mgs.aurora.common.enums.XManPacketParameterKeys.SERVER_ID]) 
                {
                    loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.SERVER_ID] as String == null);
                }
                loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] as String == null);
                loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] as XML == null);
                loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] as Boolean == null);
                loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] as String == null);
                loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] as String == null);
                if (arg1[mgs.aurora.common.enums.XManPacketParameterKeys.EXPECTED_RESPONSE_VERB]) 
                {
                    loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.EXPECTED_RESPONSE_VERB] as String == null);
                }
                return loc1;
            }
            return false;
        }
    }
}


//            class CleanupRequestHashesCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.model.vo.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class CleanupRequestHashesCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function CleanupRequestHashesCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManRequestProxy.NAME) as mgs.aurora.modules.xman.model.XManRequestProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.ModuleIDAndVerbToPacketIDHashProxy.NAME) as mgs.aurora.modules.xman.model.ModuleIDAndVerbToPacketIDHashProxy;
            var loc3:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.PacketIDToEventNameHashProxy.NAME) as mgs.aurora.modules.xman.model.PacketIDToEventNameHashProxy;
            var loc4:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.PacketIDToModuleIDHashProxy.NAME) as mgs.aurora.modules.xman.model.PacketIDToModuleIDHashProxy;
            var loc5:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.PacketIDToVerbHashProxy.NAME) as mgs.aurora.modules.xman.model.PacketIDToVerbHashProxy;
            var loc6:*;
            var loc7:*=(loc6 = arg1.getBody() as mgs.aurora.modules.xman.model.vo.CleanupParams).packetID;
            loc1.removeRequestListeners(loc6.eventHashPacketID);
            loc2.remove(loc7);
            loc3.remove(loc7);
            loc4.remove(loc7);
            loc5.remove(loc7);
            return;
        }
    }
}


//            class ClearPendingPacketsCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.xman.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ClearPendingPacketsCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ClearPendingPacketsCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManRequestProxy.NAME) as mgs.aurora.modules.xman.model.XManRequestProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy;
            loc1.clearPendingPackets();
            loc2.stopTimer(mgs.aurora.common.enums.XmanTimerNames.PACKET_TIMER);
            return;
        }
    }
}


//            class CorrectPacketMismatchCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.model.vo.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class CorrectPacketMismatchCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function CorrectPacketMismatchCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc7:*=null;
            var loc8:*=null;
            var loc9:*=null;
            var loc10:*=null;
            var loc11:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.ModuleIDAndVerbToPacketIDHashProxy.NAME) as mgs.aurora.modules.xman.model.ModuleIDAndVerbToPacketIDHashProxy;
            var loc2:*=arg1.getBody() as mgs.aurora.common.events.comms.PacketEvent;
            var loc3:*;
            var loc4:*=(loc3 = new XML(String(loc2.response.toXMLString()).toLowerCase())).id.@mid;
            var loc5:*=loc2.response.Id.@verb;
            var loc6:*;
            if ((loc6 = loc1.getPacketID(loc4, loc5)) == null) 
            {
                if ((loc9 = loc1.getVerbForModuleID(loc4)) == "") 
                {
                    (loc11 = new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.ERROR)).errorType = mgs.aurora.common.enums.CommsErrorTypes.PACKET_MISMATCH_CORRECTION_FAILED;
                    loc11.responsePacket = loc2.response;
                    Debugger.trace("Packet response mismatch correction failed", "SYSTEM - Xman Error");
                    sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.ERROR, loc11);
                    sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.DISPATCH_PACKET_RESPONSE, loc2);
                }
                else 
                {
                    loc6 = loc1.getPacketID(loc4, loc9);
                    loc7 = new mgs.aurora.modules.xman.model.vo.CleanupParams(loc6, loc2.packetID);
                    loc2.packetID = loc6;
                    loc10 = this.facade.retrieveProxy(mgs.aurora.modules.xman.model.PacketIDToEventNameHashProxy.NAME) as mgs.aurora.modules.xman.model.PacketIDToEventNameHashProxy;
                    loc2 = loc2.switchType(loc10.getEventName(loc6));
                    loc2.packetID = mgs.aurora.modules.xman.model.InternalPacketIDToPacketIDHashProxy(facade.retrieveProxy(mgs.aurora.modules.xman.model.InternalPacketIDToPacketIDHashProxy.NAME)).getPacketID(loc6);
                    sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.DISPATCH_RESPONSE, loc2);
                    sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.CLEANUP_REQUEST_HASHES, loc7);
                }
            }
            else 
            {
                loc7 = new mgs.aurora.modules.xman.model.vo.CleanupParams(loc6, loc2.packetID);
                loc2.packetID = loc6;
                loc8 = this.facade.retrieveProxy(mgs.aurora.modules.xman.model.PacketIDToEventNameHashProxy.NAME) as mgs.aurora.modules.xman.model.PacketIDToEventNameHashProxy;
                loc2 = loc2.switchType(loc8.getEventName(loc6));
                loc2.packetID = mgs.aurora.modules.xman.model.InternalPacketIDToPacketIDHashProxy(facade.retrieveProxy(mgs.aurora.modules.xman.model.InternalPacketIDToPacketIDHashProxy.NAME)).getPacketID(loc6);
                sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.DISPATCH_RESPONSE, loc2);
                sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.CLEANUP_REQUEST_HASHES, loc7);
            }
            return;
        }
    }
}


//            class HandleValidResponseCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.model.vo.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class HandleValidResponseCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function HandleValidResponseCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as mgs.aurora.common.events.comms.PacketEvent;
            this.facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.CLEANUP_REQUEST_HASHES, new mgs.aurora.modules.xman.model.vo.CleanupParams(loc1.packetID, loc1.packetID));
            loc1.packetID = mgs.aurora.modules.xman.model.InternalPacketIDToPacketIDHashProxy(facade.retrieveProxy(mgs.aurora.modules.xman.model.InternalPacketIDToPacketIDHashProxy.NAME)).getPacketID(loc1.packetID);
            this.facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.DISPATCH_RESPONSE, loc1);
            return;
        }
    }
}


//            class PrepModelCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.modules.xman.model.*;
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
            super.execute(arg1);
            this.facade.registerProxy(new mgs.aurora.modules.xman.model.InternalPacketIDToPacketIDHashProxy());
            this.facade.registerProxy(new mgs.aurora.modules.xman.model.ModuleIDAndVerbToPacketIDHashProxy());
            this.facade.registerProxy(new mgs.aurora.modules.xman.model.PacketIDToEventNameHashProxy());
            this.facade.registerProxy(new mgs.aurora.modules.xman.model.PacketIDToModuleIDHashProxy());
            this.facade.registerProxy(new mgs.aurora.modules.xman.model.PacketIDToVerbHashProxy());
            this.facade.registerProxy(new mgs.aurora.modules.xman.model.PendingRequestsProxy());
            this.facade.registerProxy(new mgs.aurora.modules.xman.model.XManRequestProxy());
            this.facade.registerProxy(new mgs.aurora.modules.xman.model.XManStateProxy());
            this.facade.registerProxy(new mgs.aurora.modules.xman.model.TimerProxy());
            return;
        }
    }
}


//            class PrepViewCommand
package mgs.aurora.modules.xman.controller 
{
    import flash.events.*;
    import mgs.aurora.modules.xman.view.*;
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
            super.execute(arg1);
            this.facade.registerMediator(new mgs.aurora.modules.xman.view.EventBridgeMediator(arg1.getBody() as flash.events.IEventDispatcher));
            return;
        }
    }
}


//            class ResponseValidationCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ResponseValidationCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ResponseValidationCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as mgs.aurora.common.events.comms.PacketEvent;
            var loc2:*=new XML(String(loc1.response.toXMLString()).toLowerCase());
            var loc3:*=loc2.id.@mid;
            var loc4:*=this.compareModuleID(loc2.id.@mid, loc1.packetID);
            var loc5:*=this.compareVerb(loc1.request, loc2, loc1.packetID);
            if (loc4 && loc5) 
            {
                sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.VALID_RESPONSE_RECEIVED, loc1);
            }
            else 
            {
                sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.PACKET_MISMATCH, loc1);
            }
            return;
        }

        internal function compareModuleID(arg1:String, arg2:String):Boolean
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.xman.model.PacketIDToModuleIDHashProxy.NAME) as mgs.aurora.modules.xman.model.PacketIDToModuleIDHashProxy;
            var loc2:*;
            return (loc2 = loc1.getModuleID(arg2)) == arg1;
        }

        internal function compareVerb(arg1:XML, arg2:XML, arg3:String):Boolean
        {
            var loc5:*=false;
            var loc1:*;
            if ((loc1 = arg2.id.@verb).toLowerCase() == "error") 
            {
                return true;
            }
            var loc2:*=arg2.id.@inverb;
            var loc3:*;
            var loc4:*;
            if ((loc4 = (loc3 = facade.retrieveProxy(mgs.aurora.modules.xman.model.PacketIDToVerbHashProxy.NAME) as mgs.aurora.modules.xman.model.PacketIDToVerbHashProxy).getVerb(arg3)).toLowerCase() == "advslot") 
            {
                loc4 = arg1.Request.@verbex.toString();
            }
            if (!(loc5 = loc4.toLowerCase() == loc1.toLowerCase()) && !(loc2 == "")) 
            {
                loc5 = loc4.toLowerCase() == loc2.toLowerCase();
            }
            return loc5;
        }
    }
}


//            class SendBuiltPacketCommand
package mgs.aurora.modules.xman.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.model.request.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SendBuiltPacketCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SendBuiltPacketCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc8:*=null;
            var loc9:*=null;
            var loc10:*=null;
            var loc11:*=null;
            var loc12:*=null;
            var loc13:*=null;
            var loc14:*=null;
            var loc15:*=null;
            var loc16:*=null;
            var loc1:*=arg1.getBody() as flash.utils.Dictionary;
            if (!loc1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET]) 
            {
                Debugger.trace("NO PKT", "SYSTEM - Xman Error");
                return;
            }
            if (!this.validateData(loc1)) 
            {
                (loc8 = new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.ERROR)).errorType = mgs.aurora.common.enums.CommsErrorTypes.INVALID_PACKET_REQUEST_DATA;
                Debugger.trace("Required packet data missing", "SYSTEM - Xman Error");
                sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.ERROR, loc8, mgs.aurora.common.enums.CommsErrorTypes.INVALID_PACKET_REQUEST_DATA);
                return;
            }
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManRequestProxy.NAME) as mgs.aurora.modules.xman.model.XManRequestProxy;
            var loc3:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManConfigProxy.NAME) as mgs.aurora.modules.xman.model.XManConfigProxy;
            var loc4:*=(loc1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] as String) + "-!-" + mgs.aurora.common.utilities.GUID.create();
            var loc5:*=loc1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET] as XML;
            mgs.aurora.modules.xman.model.InternalPacketIDToPacketIDHashProxy(facade.retrieveProxy(mgs.aurora.modules.xman.model.InternalPacketIDToPacketIDHashProxy.NAME)).add(loc4, loc1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID]);
            var loc6:*=new mgs.aurora.modules.xman.model.request.XManRequest(loc4, loc3.serverURL, loc5, loc1, loc3);
            var loc7:*;
            if (loc7 = loc2.addRequest(loc6)) 
            {
                loc9 = facade.retrieveProxy(mgs.aurora.modules.xman.model.PacketIDToModuleIDHashProxy.NAME) as mgs.aurora.modules.xman.model.PacketIDToModuleIDHashProxy;
                loc10 = loc1[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] as String;
                loc9.add(loc4, loc10);
                loc11 = facade.retrieveProxy(mgs.aurora.modules.xman.model.PacketIDToVerbHashProxy.NAME) as mgs.aurora.modules.xman.model.PacketIDToVerbHashProxy;
                if ((loc12 = loc1[mgs.aurora.common.enums.XManPacketParameterKeys.EXPECTED_RESPONSE_VERB] ? loc1[mgs.aurora.common.enums.XManPacketParameterKeys.EXPECTED_RESPONSE_VERB] as String : loc1[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] as String).toLowerCase() == "advslot") 
                {
                    loc12 = loc5.Request.@verbex.toString();
                }
                loc11.add(loc4, loc12);
                (loc13 = facade.retrieveProxy(mgs.aurora.modules.xman.model.ModuleIDAndVerbToPacketIDHashProxy.NAME) as mgs.aurora.modules.xman.model.ModuleIDAndVerbToPacketIDHashProxy).add(loc10, loc12, loc4);
                (loc14 = facade.retrieveProxy(mgs.aurora.modules.xman.model.PacketIDToEventNameHashProxy.NAME) as mgs.aurora.modules.xman.model.PacketIDToEventNameHashProxy).add(loc4, loc1[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME]);
                loc2.sendPacket(loc4);
                if (loc1[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] as Boolean || loc1[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] == null) 
                {
                    (loc15 = this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy).resetTimer(mgs.aurora.common.enums.XmanTimerNames.SESSION_TIMER);
                }
            }
            else 
            {
                (loc16 = new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.ERROR)).errorType = mgs.aurora.common.enums.CommsErrorTypes.DUPLICATE_PACKET_ID;
                Debugger.trace("Duplicate packetId found : " + loc6.packetID, "SYSTEM - Xman Error");
                this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.ERROR, loc16, mgs.aurora.common.enums.CommsErrorTypes.DUPLICATE_PACKET_ID);
            }
            return;
        }

        internal function validateData(arg1:flash.utils.Dictionary):Boolean
        {
            var loc1:*=false;
            if (arg1 != null) 
            {
                loc1 = true;
                loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET] as XML == null);
                loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] as String == null);
                if (arg1[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] != null) 
                {
                    loc1 = loc1 && !(arg1[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] as Boolean == null);
                }
                return loc1;
            }
            return false;
        }
    }
}


//            class SendPacketCommand
package mgs.aurora.modules.xman.controller 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SendPacketCommand extends org.puremvc.as3.multicore.patterns.command.MacroCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SendPacketCommand()
        {
            super();
            return;
        }

        protected override function initializeMacroCommand():void
        {
            super.initializeMacroCommand();
            this.addSubCommand(mgs.aurora.modules.xman.controller.BuildRequestPacketCommand);
            this.addSubCommand(mgs.aurora.modules.xman.controller.SendBuiltPacketCommand);
            return;
        }
    }
}


//            class SendPingCommand
package mgs.aurora.modules.xman.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SendPingCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SendPingCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=new flash.utils.Dictionary();
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.CLIENT_ID] = "10001";
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.MODULE_ID] = "0";
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.PACKET_ID] = "Ping_" + mgs.aurora.common.utilities.GUID.create();
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.VERB] = "Ping";
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.REQUEST] = new XML("<Request/>");
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] = true;
            loc1[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME] = "PingPacketReceived";
            sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SEND_PACKET, loc1);
            return;
        }
    }
}


//            class SetClientLangCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetClientLangCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetClientLangCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc3:*=null;
            var loc4:*=null;
            var loc1:*=arg1.getBody() as String;
            if (loc1 == null) 
            {
                (loc3 = new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.ERROR)).errorType = mgs.aurora.common.enums.CommsErrorTypes.INVALID_CONFIG_DATA;
                Debugger.trace("Invalid clientLang specified", "SYSTEM - Xman Error");
                this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.ERROR, loc3, mgs.aurora.common.enums.CommsErrorTypes.INVALID_CONFIG_DATA);
                return;
            }
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManConfigProxy.NAME) as mgs.aurora.modules.xman.model.XManConfigProxy;
            if (loc2) 
            {
                loc2.language = loc1;
            }
            else 
            {
                (loc4 = new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.ERROR)).errorType = mgs.aurora.common.enums.CommsErrorTypes.INVALID_CONFIG_DATA;
                Debugger.trace("Config object not initialized", "SYSTEM - Xman Error");
                sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.ERROR, loc4, mgs.aurora.common.enums.CommsErrorTypes.CONFIG_NOT_INITIALIZED);
            }
            return;
        }
    }
}


//            class SetServerIDCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.modules.xman.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetServerIDCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetServerIDCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.xman.model.XManConfigProxy.NAME) as mgs.aurora.modules.xman.model.XManConfigProxy;
            loc1.serverID = String(arg1.getBody());
            return;
        }
    }
}


//            class SetSessionIDCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetSessionIDCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetSessionIDCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc3:*=null;
            var loc4:*=null;
            var loc1:*=arg1.getBody() as String;
            if (loc1 == null) 
            {
                (loc3 = new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.ERROR)).errorType = mgs.aurora.common.enums.CommsErrorTypes.INVALID_CONFIG_DATA;
                Debugger.trace("Invalid sessionId provided", "SYSTEM - Xman Error");
                sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.ERROR, loc3, mgs.aurora.common.enums.CommsErrorTypes.INVALID_CONFIG_DATA);
                return;
            }
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManStateProxy.NAME) as mgs.aurora.modules.xman.model.XManStateProxy;
            if (loc2) 
            {
                loc2.sessionID = loc1;
            }
            else 
            {
                (loc4 = new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.ERROR)).errorType = mgs.aurora.common.enums.CommsErrorTypes.CONFIG_NOT_INITIALIZED;
                Debugger.trace("State proxy not initialized", "SYSTEM - Xman Error");
                sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.ERROR, loc4, mgs.aurora.common.enums.CommsErrorTypes.CONFIG_NOT_INITIALIZED);
            }
            return;
        }
    }
}


//            class SetupCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.notifications.*;
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
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            if (this.validate(arg1.getBody())) 
            {
                loc1 = this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManConfigProxy.NAME) as mgs.aurora.modules.xman.model.XManConfigProxy;
                if (loc1) 
                {
                    loc1.setup(arg1.getBody());
                }
                else 
                {
                    loc1 = new mgs.aurora.modules.xman.model.XManConfigProxy(arg1.getBody());
                    this.facade.registerProxy(loc1);
                }
                loc2 = this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy;
                loc2.addTimer(new mgs.aurora.modules.xman.model.TimerConfig(mgs.aurora.common.enums.XmanTimerNames.SESSION_TIMER, loc1.sessionTimeout));
                loc2.addTimer(new mgs.aurora.modules.xman.model.TimerConfig(mgs.aurora.common.enums.XmanTimerNames.PACKET_TIMER, loc1.packetTimeout));
                loc2.addTimer(new mgs.aurora.modules.xman.model.TimerConfig(mgs.aurora.common.enums.XmanTimerNames.PING_TIMER, loc1.sessionTimeout / 2));
                this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SETUP_COMPLETE, new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.SETUP_COMPLETE));
            }
            else 
            {
                (loc3 = new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.ERROR)).errorType = mgs.aurora.common.enums.CommsErrorTypes.INVALID_CONFIG_DATA;
                Debugger.trace("Invalid config data not provided", "SYSTEM - Xman Error");
                this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.ERROR, loc3, mgs.aurora.common.enums.CommsErrorTypes.INVALID_CONFIG_DATA);
            }
            return;
        }

        internal function validate(arg1:Object):Boolean
        {
            var loc1:*=true;
            loc1 = loc1 && !(arg1.url == null);
            loc1 = loc1 && !(arg1.proxytimeout == null);
            loc1 = loc1 && !(arg1.sessiontimeout == null);
            return loc1;
        }
    }
}


//            class StartPacketRequestTimerCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.xman.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class StartPacketRequestTimerCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function StartPacketRequestTimerCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy;
            loc1.startTimer(mgs.aurora.common.enums.XmanTimerNames.PACKET_TIMER);
            return;
        }
    }
}


//            class StartPingCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class StartPingCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function StartPingCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManStateProxy.NAME) as mgs.aurora.modules.xman.model.XManStateProxy;
            if (!loc1.pinging) 
            {
                loc1.pinging = true;
                this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SEND_PING);
                loc2 = this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy;
                loc2.startTimer(mgs.aurora.common.enums.XmanTimerNames.PING_TIMER);
            }
            return;
        }
    }
}


//            class StartSessionTimerCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class StartSessionTimerCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function StartSessionTimerCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy;
            loc1.startTimer(mgs.aurora.common.enums.XmanTimerNames.SESSION_TIMER);
            this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SESSION_TIMER_STARTED, new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.SESSION_TIMER_STARTED));
            return;
        }
    }
}


//            class StartupCommand
package mgs.aurora.modules.xman.controller 
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
            addSubCommand(mgs.aurora.modules.xman.controller.PrepModelCommand);
            addSubCommand(mgs.aurora.modules.xman.controller.PrepViewCommand);
            return;
        }
    }
}


//            class StopPacketRequestTimerCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.xman.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class StopPacketRequestTimerCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function StopPacketRequestTimerCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy;
            loc1.stopTimer(mgs.aurora.common.enums.XmanTimerNames.PACKET_TIMER);
            return;
        }
    }
}


//            class StopPingCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class StopPingCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function StopPingCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManStateProxy.NAME) as mgs.aurora.modules.xman.model.XManStateProxy;
            if (loc1.pinging) 
            {
                loc1.pinging = false;
                loc2 = this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy;
                loc2.stopTimer(mgs.aurora.common.enums.XmanTimerNames.PING_TIMER);
                this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SEND_PING);
            }
            return;
        }
    }
}


//            class StopSessionTimerCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class StopSessionTimerCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function StopSessionTimerCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy;
            loc1.stopTimer(mgs.aurora.common.enums.XmanTimerNames.SESSION_TIMER);
            this.facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SESSION_TIMER_STOPPED, new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.SESSION_TIMER_STOPPED));
            return;
        }
    }
}


//            class TimeOutCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class TimeOutCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function TimeOutCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=arg1.getType();
            switch (loc3) 
            {
                case mgs.aurora.common.enums.XmanTimerNames.PACKET_TIMER:
                {
                    this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.PACKET_TIMEDOUT, new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.PACKET_TIMEDOUT));
                    break;
                }
                case mgs.aurora.common.enums.XmanTimerNames.SESSION_TIMER:
                {
                    this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SESSION_TIMEDOUT, new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.SESSION_TIMEDOUT));
                    break;
                }
                case mgs.aurora.common.enums.XmanTimerNames.PING_TIMER:
                {
                    loc1 = this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManStateProxy.NAME) as mgs.aurora.modules.xman.model.XManStateProxy;
                    if (loc1.pinging) 
                    {
                        this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SEND_PING);
                        loc2 = this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy;
                        loc2.startTimer(mgs.aurora.common.enums.XmanTimerNames.PING_TIMER);
                    }
                    break;
                }
            }
            return;
        }
    }
}


//            class UpdateTimerConfigCommand
package mgs.aurora.modules.xman.controller 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.modules.xman.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class UpdateTimerConfigCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function UpdateTimerConfigCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc1:*=arg1.getBody() as Object;
            Debugger.trace("XMAN : UpdateTimerConfigCommand " + loc1.timerID, "SYSTEM - Xman");
            if (loc1.timerID != mgs.aurora.common.enums.XmanTimerNames.SESSION_TIMER) 
            {
                (loc4 = (loc3 = this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy).timers[loc1.timerID] as mgs.aurora.modules.xman.model.TimerConfig).duration = loc1.duration;
            }
            else 
            {
                loc2 = mgs.aurora.modules.xman.model.XManConfigProxy(facade.retrieveProxy(mgs.aurora.modules.xman.model.XManConfigProxy.NAME));
                loc2.sessionTimeout = loc1.duration;
            }
            return;
        }
    }
}


//          package model
//            package request
//              package event
//                class XmanPacketEvent
package mgs.aurora.modules.xman.model.request.event 
{
    import flash.events.*;
    import mgs.aurora.modules.xman.model.request.*;
    
    public class XmanPacketEvent extends flash.events.Event
    {
        public function XmanPacketEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function clone():flash.events.Event
        {
            var loc1:*=new mgs.aurora.modules.xman.model.request.event.XmanPacketEvent(this.type, this.bubbles, this.cancelable);
            loc1.response = this.response;
            loc1.packetID = this.packetID;
            loc1.request = this.request;
            return loc1;
        }

        public override function toString():String
        {
            return formatToString("XmanPacketEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public function get packetID():String
        {
            return this._packetID;
        }

        public function set packetID(arg1:String):void
        {
            this._packetID = arg1;
            return;
        }

        public function get response():XML
        {
            return this._response;
        }

        public function set response(arg1:XML):void
        {
            this._response = arg1;
            return;
        }

        public function get request():mgs.aurora.modules.xman.model.request.XManRequest
        {
            return this._request;
        }

        public function set request(arg1:mgs.aurora.modules.xman.model.request.XManRequest):void
        {
            this._request = arg1;
            return;
        }

        public static const NAME:String="XmanPacketEvent";

        public static const RECEIVED:String=NAME + "/types/received";

        public static const HEADER_NOT_SUPPORTED:String=NAME + "/types/header_not_supported";

        internal var _packetID:String;

        internal var _response:XML;

        internal var _request:mgs.aurora.modules.xman.model.request.XManRequest;
    }
}


//              class XManRequest
package mgs.aurora.modules.xman.model.request 
{
    import flash.events.*;
    import flash.external.*;
    import flash.net.*;
    import flash.utils.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.model.request.event.*;
    
    public class XManRequest extends flash.events.EventDispatcher
    {
        public function XManRequest(arg1:String, arg2:String, arg3:XML, arg4:flash.utils.Dictionary, arg5:mgs.aurora.modules.xman.model.XManConfigProxy)
        {
            super();
            XML.ignoreComments = true;
            XML.prettyIndent = 0;
            XML.prettyPrinting = false;
            XML.ignoreWhitespace = true;
            this._packetID = arg1;
            this._configProxy = arg5;
            this._request = this.createURLRequest(arg2);
            this._payload = new XML(arg3.toXMLString());
            this._params = arg4;
            return;
        }

        internal function createURLRequest(arg1:String):flash.net.URLRequest
        {
            var loc1:*=new flash.net.URLRequest(arg1);
            if (this._configProxy.requiresCustomHeader == true && !(this._configProxy.customHeaderValue == null) && !(this._configProxy.customHeaderValue == "")) 
            {
                loc1.requestHeaders = new Array(new flash.net.URLRequestHeader(this._configProxy.customHeaderName.toString(), this._configProxy.customHeaderValue.toString()));
            }
            loc1.method = flash.net.URLRequestMethod.POST;
            return loc1;
        }

        public function get packetID():String
        {
            return this._packetID;
        }

        public function sendRequest(arg1:Boolean=false):void
        {
            var casinoClosing:Boolean=false;
            var data:Object;

            var loc1:*;
            data = null;
            casinoClosing = arg1;
            this._request.data = this._payload;
            this._loader = new flash.net.URLLoader();
            this._loader.addEventListener(flash.events.Event.COMPLETE, this.onPacketReturn, false, 0, true);
            this._loader.addEventListener(flash.events.HTTPStatusEvent.HTTP_STATUS, this.onHttpStatus, false, 0, true);
            this._loader.addEventListener(flash.events.IOErrorEvent.IO_ERROR, this.onIOError, false, 0, true);
            this._loader.addEventListener(flash.events.SecurityErrorEvent.SECURITY_ERROR, this.onSecurityError, false, 0, true);
            try 
            {
                if (casinoClosing) 
                {
                    if (flash.external.ExternalInterface.available) 
                    {
                        data = new Object();
                        data["packetid"] = this.packetID;
                        data["url"] = this._request.url;
                        data["payload"] = this._request.data.toString();
                        flash.external.ExternalInterface.call("sendXmanPacket", data);
                    }
                }
                else 
                {
                    this._loader.load(this._request);
                }
            }
            catch (e:Error)
            {
                Debugger.trace("Error in load: " + e.toString());
                dispatchEvent(new mgs.aurora.common.events.PacketErrorEvent(mgs.aurora.common.events.PacketErrorEvent.FATAL));
            }
            return;
        }

        internal function onSecurityError(arg1:flash.events.SecurityErrorEvent):void
        {
            var loc3:*=null;
            var loc1:*=arg1.text.toLowerCase();
            var loc2:*=loc1.substr(loc1.indexOf("#", 0), 5);
            if (loc2 == "#2170") 
            {
                loc3 = new mgs.aurora.modules.xman.model.request.event.XmanPacketEvent(mgs.aurora.modules.xman.model.request.event.XmanPacketEvent.HEADER_NOT_SUPPORTED);
                dispatchEvent(loc3);
                Debugger.trace("XMan Security Error#2170: " + arg1.toString());
            }
            Debugger.trace("XMan Security Error: " + arg1.toString());
            return;
        }

        internal function onIOError(arg1:flash.events.IOErrorEvent):void
        {
            dispatchEvent(new mgs.aurora.common.events.PacketErrorEvent(mgs.aurora.common.events.PacketErrorEvent.FATAL));
            Debugger.trace("XMan IO Error: " + arg1.toString());
            return;
        }

        internal function onHttpStatus(arg1:flash.events.HTTPStatusEvent):void
        {
            dispatchEvent(new mgs.aurora.common.events.PacketErrorEvent(mgs.aurora.common.events.PacketErrorEvent.FATAL));
            Debugger.trace("XMan HttpStatus: status:" + arg1.status + " " + arg1.toString());
            return;
        }

        internal function onPacketReturn(arg1:flash.events.Event):void
        {
            var loc1:*=new mgs.aurora.modules.xman.model.request.event.XmanPacketEvent(mgs.aurora.modules.xman.model.request.event.XmanPacketEvent.RECEIVED);
            loc1.response = new XML(flash.net.URLLoader(arg1.target).data as String);
            loc1.request = this;
            loc1.packetID = this._packetID;
            dispatchEvent(loc1);
            return;
        }

        public function get requestPacket():XML
        {
            return this._payload;
        }

        public function get params():flash.utils.Dictionary
        {
            return this._params;
        }

        public function onJSPacketReturn(arg1:String):void
        {
            var loc1:*=new mgs.aurora.modules.xman.model.request.event.XmanPacketEvent(mgs.aurora.modules.xman.model.request.event.XmanPacketEvent.RECEIVED);
            loc1.response = new XML(arg1);
            loc1.request = this;
            loc1.packetID = this._packetID;
            dispatchEvent(loc1);
            return;
        }

        internal var _packetID:String;

        internal var _request:flash.net.URLRequest;

        internal var _payload:XML;

        internal var _params:flash.utils.Dictionary;

        internal var _loader:flash.net.URLLoader;

        internal var _configProxy:mgs.aurora.modules.xman.model.XManConfigProxy;
    }
}


//            package timer
//              class IdentifiableTimerEvent
package mgs.aurora.modules.xman.model.timer 
{
    import flash.events.*;
    import mgs.aurora.modules.xman.model.*;
    
    public class IdentifiableTimerEvent extends flash.events.Event
    {
        public function IdentifiableTimerEvent(arg1:String, arg2:mgs.aurora.modules.xman.model.TimerConfig, arg3:Boolean=false, arg4:Boolean=false)
        {
            super(arg1, arg3, arg4);
            this._timerConfig = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.modules.xman.model.timer.IdentifiableTimerEvent(type, this.timerConfig, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("IdentifiableTimerEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public function get timerConfig():mgs.aurora.modules.xman.model.TimerConfig
        {
            return this._timerConfig;
        }

        public function set timerConfig(arg1:mgs.aurora.modules.xman.model.TimerConfig):void
        {
            this._timerConfig = arg1;
            return;
        }

        public static const TIMER:String="Timer";

        internal var _timerConfig:mgs.aurora.modules.xman.model.TimerConfig;
    }
}


//            package vo
//              class CleanupParams
package mgs.aurora.modules.xman.model.vo 
{
    public class CleanupParams extends Object
    {
        public function CleanupParams(arg1:String, arg2:String=null)
        {
            super();
            this.packetID = arg1;
            this.eventHashPacketID = arg2;
            return;
        }

        public var packetID:String;

        public var eventHashPacketID:String;
    }
}


//              class XManState
package mgs.aurora.modules.xman.model.vo 
{
    public class XManState extends Object
    {
        public function XManState()
        {
            super();
            return;
        }

        public var sessionID:String;

        public var pinging:Boolean;

        public var casinoClosing:Boolean;
    }
}


//            class InternalPacketIDToPacketIDHashProxy
package mgs.aurora.modules.xman.model 
{
    import flash.utils.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class InternalPacketIDToPacketIDHashProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function InternalPacketIDToPacketIDHashProxy()
        {
            super(NAME, new flash.utils.Dictionary());
            return;
        }

        public function get dictionary():flash.utils.Dictionary
        {
            return getData() as flash.utils.Dictionary;
        }

        public function add(arg1:String, arg2:String):void
        {
            this.dictionary[arg1] = arg2;
            return;
        }

        public function getPacketID(arg1:String):String
        {
            var loc1:*=this.dictionary[arg1] as String;
            this.remove(loc1);
            return loc1;
        }

        public function remove(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this.dictionary;
            for (loc1 in loc3) 
            {
                if (this.dictionary[loc1] != arg1) 
                {
                    continue;
                }
                delete this.dictionary[loc1];
            }
            return;
        }

        public static const NAME:String="InternalPacketIDToPacketIDHashProxy";
    }
}


//            class ModuleIDAndVerbToPacketIDHashProxy
package mgs.aurora.modules.xman.model 
{
    import flash.utils.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class ModuleIDAndVerbToPacketIDHashProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function ModuleIDAndVerbToPacketIDHashProxy()
        {
            super(NAME, new flash.utils.Dictionary());
            return;
        }

        public function get dictionary():flash.utils.Dictionary
        {
            return getData() as flash.utils.Dictionary;
        }

        internal function buildID(arg1:String, arg2:String):String
        {
            return arg1 + ":" + arg2;
        }

        public function add(arg1:String, arg2:String, arg3:String):void
        {
            this.dictionary[this.buildID(arg1, arg2)] = arg3;
            return;
        }

        public function getPacketID(arg1:String, arg2:String):String
        {
            return this.dictionary[this.buildID(arg1, arg2)] as String;
        }

        public function remove(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this.dictionary;
            for (loc1 in loc3) 
            {
                if (this.dictionary[loc1] != arg1) 
                {
                    continue;
                }
                delete this.dictionary[loc1];
            }
            return;
        }

        public function getVerbForModuleID(arg1:String):String
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=0;
            var loc4:*=this.dictionary;
            for (loc1 in loc4) 
            {
                loc2 = loc1.toString().split(":");
                if (loc2[0] != arg1) 
                {
                    continue;
                }
                return loc2[1];
            }
            return "";
        }

        public static const NAME:String="ModuleIDAndVerbToPacketIDHashProxy";
    }
}


//            class PacketIDToEventNameHashProxy
package mgs.aurora.modules.xman.model 
{
    import flash.utils.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class PacketIDToEventNameHashProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function PacketIDToEventNameHashProxy()
        {
            super(NAME, new flash.utils.Dictionary());
            return;
        }

        public function get dictionary():flash.utils.Dictionary
        {
            return getData() as flash.utils.Dictionary;
        }

        public function add(arg1:String, arg2:String):void
        {
            this.dictionary[arg1] = arg2;
            return;
        }

        public function getEventName(arg1:String):String
        {
            return this.dictionary[arg1] as String;
        }

        public function remove(arg1:String):void
        {
            delete this.dictionary[arg1];
            return;
        }

        public static const NAME:String="PacketIDToEventNameHashProxy";
    }
}


//            class PacketIDToModuleIDHashProxy
package mgs.aurora.modules.xman.model 
{
    import flash.utils.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class PacketIDToModuleIDHashProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function PacketIDToModuleIDHashProxy()
        {
            super(NAME, new flash.utils.Dictionary());
            return;
        }

        public function get dictionary():flash.utils.Dictionary
        {
            return getData() as flash.utils.Dictionary;
        }

        public function add(arg1:String, arg2:String):void
        {
            this.dictionary[arg1] = arg2;
            return;
        }

        public function getModuleID(arg1:String):String
        {
            if (!this.dictionary.hasOwnProperty(arg1)) 
            {
                return "";
            }
            return this.dictionary[arg1] as String;
        }

        public function remove(arg1:String):void
        {
            delete this.dictionary[arg1];
            return;
        }

        public static const NAME:String="PacketIDToModuleIDHashProxy";
    }
}


//            class PacketIDToVerbHashProxy
package mgs.aurora.modules.xman.model 
{
    import flash.utils.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class PacketIDToVerbHashProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function PacketIDToVerbHashProxy()
        {
            super(NAME, new flash.utils.Dictionary());
            return;
        }

        public function get dictionary():flash.utils.Dictionary
        {
            return getData() as flash.utils.Dictionary;
        }

        public function add(arg1:String, arg2:String):void
        {
            this.dictionary[arg1] = arg2;
            return;
        }

        public function getVerb(arg1:String):String
        {
            if (!this.dictionary.hasOwnProperty(arg1)) 
            {
                return "";
            }
            return this.dictionary[arg1] as String;
        }

        public function remove(arg1:String):void
        {
            delete this.dictionary[arg1];
            return;
        }

        public static const NAME:String="PacketIDToVerbHashProxy";
    }
}


//            class PendingRequestsProxy
package mgs.aurora.modules.xman.model 
{
    import flash.utils.*;
    import mgs.aurora.modules.xman.model.request.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class PendingRequestsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function PendingRequestsProxy()
        {
            super(NAME, new flash.utils.Dictionary());
            return;
        }

        public function get requests():flash.utils.Dictionary
        {
            return getData() as flash.utils.Dictionary;
        }

        public function contains(arg1:String):Boolean
        {
            return this.requests[arg1];
        }

        public function add(arg1:String, arg2:mgs.aurora.modules.xman.model.request.XManRequest):void
        {
            this.requests[arg1] = arg2;
            return;
        }

        public function retrieve(arg1:String):mgs.aurora.modules.xman.model.request.XManRequest
        {
            return this.requests[arg1] as mgs.aurora.modules.xman.model.request.XManRequest;
        }

        public function remove(arg1:String):Boolean
        {
            if (this.requests[arg1]) 
            {
                delete this.requests[arg1];
                return true;
            }
            return false;
        }

        public function clear():void
        {
            setData(new flash.utils.Dictionary());
            return;
        }

        public static const NAME:String="PendingRequestsProxy";
    }
}


//            class TimerConfig
package mgs.aurora.modules.xman.model 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.modules.xman.model.timer.*;
    
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
            dispatchEvent(new mgs.aurora.modules.xman.model.timer.IdentifiableTimerEvent(mgs.aurora.modules.xman.model.timer.IdentifiableTimerEvent.TIMER, this));
            return;
        }

        internal var _duration:Number;

        internal var _id:String;

        internal var _timer:flash.utils.Timer;
    }
}


//            class TimerProxy
package mgs.aurora.modules.xman.model 
{
    import flash.utils.*;
    import mgs.aurora.modules.xman.model.timer.*;
    import mgs.aurora.modules.xman.notifications.*;
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

        public function addTimer(arg1:mgs.aurora.modules.xman.model.TimerConfig):Boolean
        {
            var loc1:*=this.timers;
            if (loc1[arg1.id] != null) 
            {
                return false;
            }
            loc1[arg1.id] = arg1;
            arg1.addEventListener(mgs.aurora.modules.xman.model.timer.IdentifiableTimerEvent.TIMER, this.onTimer, false, 0, true);
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
            var loc1:*=this.timers[arg1] as mgs.aurora.modules.xman.model.TimerConfig;
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
            var loc1:*=this.timers[arg1] as mgs.aurora.modules.xman.model.TimerConfig;
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
            var loc1:*=this.timers[arg1] as mgs.aurora.modules.xman.model.TimerConfig;
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

        public function resetDelay(arg1:String):Boolean
        {
            var loc1:*=this.timers[arg1] as mgs.aurora.modules.xman.model.TimerConfig;
            if (!loc1) 
            {
                Debugger.trace("resetDelay : NO config", "SYSTEM - Xman");
                return false;
            }
            Debugger.trace("resetDelay : config.duration = " + loc1.duration, "SYSTEM - Xman");
            if (loc1.timer && loc1.timer.running) 
            {
                loc1.timer.delay = loc1.duration;
                return true;
            }
            return false;
        }

        internal function onTimer(arg1:mgs.aurora.modules.xman.model.timer.IdentifiableTimerEvent):void
        {
            this.stopTimer(arg1.timerConfig.id);
            this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.TIMER_TIMEDOUT, null, arg1.timerConfig.id.toString());
            return;
        }

        public static const NAME:String="TimerProxy";
    }
}


//            class XManConfigProxy
package mgs.aurora.modules.xman.model 
{
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class XManConfigProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function XManConfigProxy(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public override function setData(arg1:Object):void
        {
            super.setData(arg1);
            getData().sessiontimeout.addEventListener(mgs.aurora.common.events.SystemConfigEvent.VALUE_CHANGED, this.onSessionTimeOutChanged);
            return;
        }

        public function setup(arg1:Object):void
        {
            this.setData(arg1);
            return;
        }

        public function get serverURL():String
        {
            return getData().url;
        }

        public function get serverID():String
        {
            return getData().serverid;
        }

        public function set serverID(arg1:String):void
        {
            getData().serverid = arg1;
            return;
        }

        public function get packetTimeout():Number
        {
            return getData().proxytimeout;
        }

        public function get sessionTimeout():Number
        {
            return getData().sessiontimeout;
        }

        public function set sessionTimeout(arg1:Number):void
        {
            getData().sessiontimeout = arg1;
            return;
        }

        public function get language():String
        {
            return getData().casinolanguage;
        }

        public function set language(arg1:String):void
        {
            getData().casinolanguage = arg1;
            return;
        }

        public function get requiresCustomHeader():Boolean
        {
            if (getData().enablecustomheader == "0" || getData().enablecustomheader == undefined) 
            {
                return false;
            }
            return true;
        }

        public function get customHeaderName():String
        {
            if (getData().customheadername == null || getData().customheadername == undefined) 
            {
                return "";
            }
            return getData().customheadername;
        }

        public function get customHeaderValue():String
        {
            return getData().customheadervalue;
        }

        public function onSessionTimeOutChanged(arg1:mgs.aurora.common.events.SystemConfigEvent):void
        {
            var loc1:*=getData().sessiontimeout;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.xman.model.TimerProxy.NAME) as mgs.aurora.modules.xman.model.TimerProxy;
            mgs.aurora.modules.xman.model.TimerConfig(loc2.timers[mgs.aurora.common.enums.XmanTimerNames.SESSION_TIMER]).duration = loc1;
            var loc3:*=loc2.resetDelay(mgs.aurora.common.enums.XmanTimerNames.SESSION_TIMER);
            return;
        }

        public static const NAME:String="XManConfigProxy";
    }
}


//            class XManRequestProxy
package mgs.aurora.modules.xman.model 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.model.request.*;
    import mgs.aurora.modules.xman.model.request.event.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class XManRequestProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function XManRequestProxy()
        {
            super(NAME, new flash.utils.Dictionary());
            return;
        }

        public function get pendingRequests():mgs.aurora.modules.xman.model.PendingRequestsProxy
        {
            return this.facade.retrieveProxy(mgs.aurora.modules.xman.model.PendingRequestsProxy.NAME) as mgs.aurora.modules.xman.model.PendingRequestsProxy;
        }

        public function addRequest(arg1:mgs.aurora.modules.xman.model.request.XManRequest):Boolean
        {
            if (!(arg1.packetID == null) && !this.pendingRequests.contains(arg1.packetID)) 
            {
                this.pendingRequests.add(arg1.packetID, arg1);
                return true;
            }
            return false;
        }

        public function removeRequestListeners(arg1:String):Boolean
        {
            var loc1:*=null;
            if (this.pendingRequests.contains(arg1)) 
            {
                loc1 = this.pendingRequests.retrieve(arg1);
                if (loc1.hasEventListener(mgs.aurora.modules.xman.model.request.event.XmanPacketEvent.RECEIVED)) 
                {
                    this.pendingRequests.retrieve(arg1).removeEventListener(mgs.aurora.modules.xman.model.request.event.XmanPacketEvent.RECEIVED, this.onPacketReturn);
                }
                this.pendingRequests.remove(arg1);
                return true;
            }
            return false;
        }

        public function clearPendingPackets():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this.pendingRequests.requests;
            for (loc1 in loc3) 
            {
                this.removeRequestListeners(loc1);
                this.pendingRequests.remove(loc1);
            }
            return;
        }

        public function sendPacket(arg1:String):Boolean
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=this.pendingRequests.retrieve(arg1);
            if (loc1 != null) 
            {
                loc2 = this.facade.retrieveProxy(mgs.aurora.modules.xman.model.XManStateProxy.NAME) as mgs.aurora.modules.xman.model.XManStateProxy;
                loc1.addEventListener(mgs.aurora.modules.xman.model.request.event.XmanPacketEvent.RECEIVED, this.onPacketReturn, false, 0, true);
                loc1.addEventListener(mgs.aurora.modules.xman.model.request.event.XmanPacketEvent.HEADER_NOT_SUPPORTED, this.onPacketHeaderError, false, 0, true);
                loc1.sendRequest(loc2.casinoClosing);
                (loc3 = new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.PACKET_SENT)).packetID = arg1;
                this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.PACKET_SENT, loc3);
                this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.START_PACKET_TIMER);
                return true;
            }
            return false;
        }

        internal function onPacketReturn(arg1:mgs.aurora.modules.xman.model.request.event.XmanPacketEvent):void
        {
            this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.STOP_PACKET_TIMER);
            var loc1:*=new mgs.aurora.common.events.comms.PacketEvent(arg1.request.params[mgs.aurora.common.enums.XManPacketParameterKeys.EVENT_NAME]);
            loc1.packetID = arg1.packetID;
            loc1.response = arg1.response;
            loc1.request = arg1.request.requestPacket;
            mgs.aurora.modules.xman.model.request.XManRequest(arg1.request).removeEventListener(mgs.aurora.modules.xman.model.request.event.XmanPacketEvent.RECEIVED, this.onPacketReturn);
            this.pendingRequests.remove(arg1.packetID);
            var loc2:*=new XML(String(arg1.response.toXMLString()).toLowerCase());
            loc1.clientID = loc2.id.@cid;
            loc1.moduleID = loc2.id.@mid;
            loc1.serverID = loc2.id.@sid;
            loc1.verb = arg1.response.Id.@verb == undefined ? loc2.id.@verb : arg1.response.Id.@verb;
            loc1.packetAttributes = arg1.request.params[mgs.aurora.common.enums.XManPacketParameterKeys.PKT_ATTRIBUTES] as String;
            loc1.resetSessionTimer = arg1.request.params[mgs.aurora.common.enums.XManPacketParameterKeys.RESET_SESSION_TIMER] as Boolean;
            this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.PACKET_RECEIVED, loc1);
            return;
        }

        internal function onPacketHeaderError(arg1:mgs.aurora.modules.xman.model.request.event.XmanPacketEvent):void
        {
            this.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.HEADER_NOT_SUPPORTED, new mgs.aurora.common.events.comms.XManEvent(mgs.aurora.common.events.comms.XManEvent.HEADER_NOT_SUPPORTED));
            return;
        }

        public static const NAME:String="XManRequestProxy";
    }
}


//            class XManStateProxy
package mgs.aurora.modules.xman.model 
{
    import mgs.aurora.modules.xman.model.vo.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class XManStateProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function XManStateProxy()
        {
            super(NAME, new mgs.aurora.modules.xman.model.vo.XManState());
            return;
        }

        public override function onRegister():void
        {
            this.state.pinging = false;
            this.state.casinoClosing = false;
            return;
        }

        public function get state():mgs.aurora.modules.xman.model.vo.XManState
        {
            return getData() as mgs.aurora.modules.xman.model.vo.XManState;
        }

        public function get sessionID():String
        {
            var loc1:*=this.state.sessionID;
            if (!loc1) 
            {
                loc1 = "";
            }
            return loc1;
        }

        public function set sessionID(arg1:String):void
        {
            this.state.sessionID = arg1;
            return;
        }

        public function get pinging():Boolean
        {
            return this.state.pinging;
        }

        public function set pinging(arg1:Boolean):void
        {
            this.state.pinging = arg1;
            return;
        }

        public function get casinoClosing():Boolean
        {
            return this.state.casinoClosing;
        }

        public function set casinoClosing(arg1:Boolean):void
        {
            this.state.casinoClosing = arg1;
            return;
        }

        public static const NAME:String="XManStateProxy";
    }
}


//          package notifications
//            class XManNotifications
package mgs.aurora.modules.xman.notifications 
{
    public class XManNotifications extends Object
    {
        public function XManNotifications()
        {
            super();
            return;
        }

        public static const NAME:String="XManNotifications";

        public static const STARTUP:String=NAME + "/notes/startup";

        public static const SETUP:String=NAME + "/notes/setup";

        public static const SETUP_COMPLETE:String=NAME + "/notes/setup_complete";

        public static const ERROR:String=NAME + "/notes/error";

        public static const SEND_PACKET:String=NAME + "/notes/send_packet";

        public static const PACKET_SENT:String=NAME + "/notes/packet_sent";

        public static const PACKET_RECEIVED:String=NAME + "/notes/packet_received";

        public static const START_SESSION_TIMER:String=NAME + "/notes/start_session_timer";

        public static const STOP_SESSION_TIMER:String=NAME + "/notes/stop_session_timer";

        public static const SESSION_TIMER_STARTED:String=NAME + "/notes/session_timer_started";

        public static const SESSION_TIMER_STOPPED:String=NAME + "/notes/session_timer_stopped";

        public static const STOP_PACKET_TIMER:String=NAME + "/notes/stop_packet_timer";

        public static const START_PACKET_TIMER:String=NAME + "/notes/start_packet_timer";

        public static const TIMER_TIMEDOUT:String=NAME + "/notes/timer_timedout";

        public static const SESSION_TIMEDOUT:String=NAME + "/notes/session_timedout";

        public static const PACKET_TIMEDOUT:String=NAME + "/notes/packet_timedout";

        public static const CLEAR_PENDING_PACKET_QUEUE:String=NAME + "/notes/clear_pending_packet_queue";

        public static const SET_CLIENT_LANG:String=NAME + "/notes/set_client_lang";

        public static const SET_SESSION_ID:String=NAME + "/notes/set_session_id";

        public static const PACKET_MISMATCH:String=NAME + "/notes/packet_mismatch";

        public static const VALID_RESPONSE_RECEIVED:String=NAME + "/notes/valid_response_received";

        public static const DISPATCH_RESPONSE:String=NAME + "/notes/dispatch_response";

        public static const CLEANUP_REQUEST_HASHES:String=NAME + "/notes/cleanup_request_hashes";

        public static const START_PING:String=NAME + "/notes/start_ping";

        public static const STOP_PING:String=NAME + "/notes/stop_ping";

        public static const SEND_PING:String=NAME + "/notes/send_ping";

        public static const DISPATCH_PACKET_RESPONSE:String=NAME + "/notes/dispatch_packet_response";

        public static const SET_SERVER_ID:String=NAME + "/notes/set_server_id";

        public static const SET_TIMER_CONFIG:String=NAME + "/notes/set_timer_config";

        public static const HEADER_NOT_SUPPORTED:String=NAME + "/notes/header_not_supported";
    }
}


//          package view
//            class EventBridgeMediator
package mgs.aurora.modules.xman.view 
{
    import flash.events.*;
    import mgs.aurora.common.events.comms.*;
    import mgs.aurora.modules.xman.notifications.*;
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
            loc1.push(mgs.aurora.modules.xman.notifications.XManNotifications.SETUP_COMPLETE);
            loc1.push(mgs.aurora.modules.xman.notifications.XManNotifications.ERROR);
            loc1.push(mgs.aurora.modules.xman.notifications.XManNotifications.PACKET_SENT);
            loc1.push(mgs.aurora.modules.xman.notifications.XManNotifications.SESSION_TIMER_STARTED);
            loc1.push(mgs.aurora.modules.xman.notifications.XManNotifications.SESSION_TIMER_STOPPED);
            loc1.push(mgs.aurora.modules.xman.notifications.XManNotifications.SESSION_TIMEDOUT);
            loc1.push(mgs.aurora.modules.xman.notifications.XManNotifications.PACKET_TIMEDOUT);
            loc1.push(mgs.aurora.modules.xman.notifications.XManNotifications.DISPATCH_RESPONSE);
            loc1.push(mgs.aurora.modules.xman.notifications.XManNotifications.HEADER_NOT_SUPPORTED);
            return loc1;
        }

        internal function get eventDispatcher():flash.events.IEventDispatcher
        {
            return getViewComponent() as flash.events.IEventDispatcher;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=arg1.getName();
            switch (loc2) 
            {
                case mgs.aurora.modules.xman.notifications.XManNotifications.SETUP_COMPLETE:
                case mgs.aurora.modules.xman.notifications.XManNotifications.ERROR:
                case mgs.aurora.modules.xman.notifications.XManNotifications.PACKET_SENT:
                case mgs.aurora.modules.xman.notifications.XManNotifications.SESSION_TIMER_STARTED:
                case mgs.aurora.modules.xman.notifications.XManNotifications.SESSION_TIMER_STOPPED:
                case mgs.aurora.modules.xman.notifications.XManNotifications.SESSION_TIMEDOUT:
                case mgs.aurora.modules.xman.notifications.XManNotifications.HEADER_NOT_SUPPORTED:
                case mgs.aurora.modules.xman.notifications.XManNotifications.PACKET_TIMEDOUT:
                {
                    this.eventDispatcher.dispatchEvent(arg1.getBody() as flash.events.Event);
                    break;
                }
                case mgs.aurora.modules.xman.notifications.XManNotifications.DISPATCH_PACKET_RESPONSE:
                {
                    loc1 = arg1.getBody() as mgs.aurora.common.events.comms.PacketEvent;
                    this.dispatchResponseReceived(loc1);
                    break;
                }
                case mgs.aurora.modules.xman.notifications.XManNotifications.DISPATCH_RESPONSE:
                {
                    loc1 = arg1.getBody() as mgs.aurora.common.events.comms.PacketEvent;
                    this.dispatchResponseReceived(loc1);
                    this.dispatchSurrogateResponse(loc1);
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

        internal function dispatchResponseReceived(arg1:mgs.aurora.common.events.comms.PacketEvent):void
        {
            var loc1:*=new mgs.aurora.common.events.comms.PacketEvent(mgs.aurora.common.events.comms.PacketEvent.RESPONSE_PACKET_RECEIVED);
            loc1.response = arg1.response;
            loc1.packetID = arg1.packetID;
            loc1.request = arg1.request;
            loc1.clientID = arg1.clientID;
            loc1.moduleID = arg1.moduleID;
            loc1.packetAttributes = arg1.packetAttributes;
            loc1.resetSessionTimer = arg1.resetSessionTimer;
            loc1.serverID = arg1.serverID;
            loc1.verb = arg1.verb;
            this.eventDispatcher.dispatchEvent(loc1);
            return;
        }

        internal function dispatchSurrogateResponse(arg1:mgs.aurora.common.events.comms.PacketEvent):void
        {
            this.eventDispatcher.dispatchEvent(arg1);
            return;
        }

        public static const NAME:String="EventBridgeMediator";
    }
}


//          class XMan
package mgs.aurora.modules.xman 
{
    import flash.display.*;
    import flash.events.*;
    import flash.external.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.comms.*;
    import mgs.aurora.modules.xman.model.*;
    import mgs.aurora.modules.xman.model.request.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.utilities.pipes.interfaces.*;
    import org.puremvc.as3.multicore.utilities.pipes.plumbing.*;
    
    public class XMan extends flash.display.Sprite implements org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeAware, mgs.aurora.common.interfaces.comms.IXMan
    {
        public function XMan()
        {
            super();
            if (this.stage) 
            {
                this.init();
            }
            addEventListener(flash.events.Event.ADDED_TO_STAGE, this.init);
            addEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.dispose);
            return;
        }

        internal function init(arg1:*=null):void
        {
            this._facade = mgs.aurora.modules.xman.XManFacade.getInstance(this.FACADE_ID);
            this._facade.startup(this);
            flash.external.ExternalInterface.addCallback("onJSPacketReturn", this.onJSPacketReturn);
            return;
        }

        internal function dispose():void
        {
            return;
        }

        public function acceptInputPipe(arg1:String, arg2:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting):void
        {
            this._facade.sendNotification(org.puremvc.as3.multicore.utilities.pipes.plumbing.JunctionMediator.ACCEPT_INPUT_PIPE, arg2, arg1);
            return;
        }

        public function acceptOutputPipe(arg1:String, arg2:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting):void
        {
            this._facade.sendNotification(org.puremvc.as3.multicore.utilities.pipes.plumbing.JunctionMediator.ACCEPT_OUTPUT_PIPE, arg2, arg1);
            return;
        }

        public function setup(arg1:Object):void
        {
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SETUP, arg1);
            return;
        }

        public function sendPacket(arg1:flash.utils.Dictionary):void
        {
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SEND_PACKET, arg1);
            return;
        }

        public function startSessionTimer():void
        {
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.START_SESSION_TIMER);
            return;
        }

        public function stopSessionTimer():void
        {
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.STOP_SESSION_TIMER);
            return;
        }

        public function stopPacketTimer():void
        {
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.STOP_PACKET_TIMER);
            return;
        }

        public function clearPendingPacketQueue():void
        {
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.CLEAR_PENDING_PACKET_QUEUE);
            return;
        }

        public function setClientLang(arg1:String):void
        {
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SET_CLIENT_LANG, arg1);
            return;
        }

        public function setSessionID(arg1:String):void
        {
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SET_SESSION_ID, arg1);
            return;
        }

        public function startPing():void
        {
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.START_PING);
            return;
        }

        public function stopPing():void
        {
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.STOP_PING);
            return;
        }

        public function setServerID(arg1:String):void
        {
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SET_SERVER_ID, arg1);
            return;
        }

        public function updateTimerConfig(arg1:Object):void
        {
            Debugger.trace("XMAN : updateTimerConfig", "SYSTEM - Xman");
            this._facade.sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.SET_TIMER_CONFIG, arg1);
            return;
        }

        public function casinoClosing():void
        {
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.xman.model.XManStateProxy.NAME) as mgs.aurora.modules.xman.model.XManStateProxy;
            loc1.casinoClosing = true;
            return;
        }

        public function onJSPacketReturn(arg1:Object):void
        {
            var loc1:*=null;
            var loc2:*=null;
            if (this._facade.hasProxy(mgs.aurora.modules.xman.model.XManRequestProxy.NAME)) 
            {
                loc1 = this._facade.retrieveProxy(mgs.aurora.modules.xman.model.XManRequestProxy.NAME) as mgs.aurora.modules.xman.model.XManRequestProxy;
                loc2 = loc1.pendingRequests.retrieve(String(arg1["packetid"]));
                if (loc2 != null) 
                {
                    loc2.onJSPacketReturn(arg1["payload"]);
                }
            }
            return;
        }

        internal const FACADE_ID:String="Xman";

        internal var _facade:mgs.aurora.modules.xman.XManFacade;
    }
}


//          class XManFacade
package mgs.aurora.modules.xman 
{
    import flash.events.*;
    import mgs.aurora.modules.xman.controller.*;
    import mgs.aurora.modules.xman.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class XManFacade extends org.puremvc.as3.multicore.patterns.facade.Facade implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function XManFacade(arg1:String)
        {
            super(arg1);
            return;
        }

        protected override function initializeController():void
        {
            super.initializeController();
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.STARTUP, mgs.aurora.modules.xman.controller.StartupCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.SETUP, mgs.aurora.modules.xman.controller.SetupCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.SEND_PACKET, mgs.aurora.modules.xman.controller.SendPacketCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.STOP_SESSION_TIMER, mgs.aurora.modules.xman.controller.StopSessionTimerCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.START_SESSION_TIMER, mgs.aurora.modules.xman.controller.StartSessionTimerCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.STOP_PACKET_TIMER, mgs.aurora.modules.xman.controller.StopPacketRequestTimerCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.START_PACKET_TIMER, mgs.aurora.modules.xman.controller.StartPacketRequestTimerCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.TIMER_TIMEDOUT, mgs.aurora.modules.xman.controller.TimeOutCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.CLEAR_PENDING_PACKET_QUEUE, mgs.aurora.modules.xman.controller.ClearPendingPacketsCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.SET_CLIENT_LANG, mgs.aurora.modules.xman.controller.SetClientLangCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.SET_SESSION_ID, mgs.aurora.modules.xman.controller.SetSessionIDCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.START_PING, mgs.aurora.modules.xman.controller.StartPingCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.STOP_PING, mgs.aurora.modules.xman.controller.StopPingCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.PACKET_RECEIVED, mgs.aurora.modules.xman.controller.ResponseValidationCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.PACKET_MISMATCH, mgs.aurora.modules.xman.controller.CorrectPacketMismatchCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.VALID_RESPONSE_RECEIVED, mgs.aurora.modules.xman.controller.HandleValidResponseCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.CLEANUP_REQUEST_HASHES, mgs.aurora.modules.xman.controller.CleanupRequestHashesCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.SEND_PING, mgs.aurora.modules.xman.controller.SendPingCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.SET_SERVER_ID, mgs.aurora.modules.xman.controller.SetServerIDCommand);
            this.registerCommand(mgs.aurora.modules.xman.notifications.XManNotifications.SET_TIMER_CONFIG, mgs.aurora.modules.xman.controller.UpdateTimerConfigCommand);
            return;
        }

        public function startup(arg1:flash.events.IEventDispatcher):void
        {
            sendNotification(mgs.aurora.modules.xman.notifications.XManNotifications.STARTUP, arg1);
            removeCommand(mgs.aurora.modules.xman.notifications.XManNotifications.STARTUP);
            return;
        }

        public static function getInstance(arg1:String):mgs.aurora.modules.xman.XManFacade
        {
            if (mgs.aurora.modules.xman.XManFacade._instance == null) 
            {
                mgs.aurora.modules.xman.XManFacade._instance = new XManFacade(arg1);
            }
            return mgs.aurora.modules.xman.XManFacade._instance;
        }

        internal static var _instance:mgs.aurora.modules.xman.XManFacade;
    }
}


//  package org
//    package osflash
//      package signals
//        package events
//          class GenericEvent
package org.osflash.signals.events 
{
    import org.osflash.signals.*;
    
    public class GenericEvent extends Object implements org.osflash.signals.events.IEvent
    {
        public function GenericEvent(arg1:Boolean=false)
        {
            super();
            _bubbles = arg1;
            return;
        }

        public function get target():Object
        {
            return _target;
        }

        public function set currentTarget(arg1:Object):void
        {
            _currentTarget = arg1;
            return;
        }

        public function set bubbles(arg1:Boolean):void
        {
            _bubbles = arg1;
            return;
        }

        public function set signal(arg1:org.osflash.signals.IDeluxeSignal):void
        {
            _signal = arg1;
            return;
        }

        public function set target(arg1:Object):void
        {
            _target = arg1;
            return;
        }

        public function clone():org.osflash.signals.events.IEvent
        {
            return new org.osflash.signals.events.GenericEvent(_bubbles);
        }

        public function get bubbles():Boolean
        {
            return _bubbles;
        }

        public function get signal():org.osflash.signals.IDeluxeSignal
        {
            return _signal;
        }

        public function get currentTarget():Object
        {
            return _currentTarget;
        }

        protected var _signal:org.osflash.signals.IDeluxeSignal;

        protected var _currentTarget:Object;

        protected var _target:Object;

        protected var _bubbles:Boolean;
    }
}


//          class IBubbleEventHandler
package org.osflash.signals.events 
{
    public interface IBubbleEventHandler
    {
        function onEventBubbled(arg1:org.osflash.signals.events.IEvent):void;
    }
}


//          class IEvent
package org.osflash.signals.events 
{
    import org.osflash.signals.*;
    
    public interface IEvent
    {
        function set signal(arg1:org.osflash.signals.IDeluxeSignal):void;

        function get target():Object;

        function set target(arg1:Object):void;

        function set currentTarget(arg1:Object):void;

        function get bubbles():Boolean;

        function get signal():org.osflash.signals.IDeluxeSignal;

        function get currentTarget():Object;

        function clone():org.osflash.signals.events.IEvent;

        function set bubbles(arg1:Boolean):void;
    }
}


//        package natives
//          class INativeDispatcher
package org.osflash.signals.natives 
{
    import flash.events.*;
    
    public interface INativeDispatcher
    {
        function get target():flash.events.IEventDispatcher;

        function dispatch(arg1:flash.events.Event):Boolean;

        function get eventType():String;

        function get eventClass():Class;
    }
}


//          class NativeRelaySignal
package org.osflash.signals.natives 
{
    import flash.events.*;
    import org.osflash.signals.*;
    
    public class NativeRelaySignal extends org.osflash.signals.DeluxeSignal
    {
        public function NativeRelaySignal(arg1:flash.events.IEventDispatcher, arg2:String, arg3:Class=null)
        {
            super(arg1, arg3 || flash.events.Event);
            _eventType = arg2;
            return;
        }

        public override function addOnce(arg1:Function, arg2:int=0):void
        {
            var loc1:*=listenerBoxes.length;
            super.addOnce(arg1);
            if (loc1 == 0 && listenerBoxes.length == 1) 
            {
                flash.events.IEventDispatcher(_target).addEventListener(_eventType, dispatch, false, arg2);
            }
            return;
        }

        public override function remove(arg1:Function):void
        {
            var loc1:*=listenerBoxes.length;
            super.remove(arg1);
            if (loc1 == 1 && listenerBoxes.length == 0) 
            {
                flash.events.IEventDispatcher(_target).removeEventListener(_eventType, dispatch);
            }
            return;
        }

        public override function add(arg1:Function, arg2:int=0):void
        {
            var loc1:*=listenerBoxes.length;
            super.add(arg1);
            if (loc1 == 0 && listenerBoxes.length == 1) 
            {
                flash.events.IEventDispatcher(_target).addEventListener(_eventType, dispatch, false, arg2);
            }
            return;
        }

        protected var _eventType:String;
    }
}


//          class NativeSignal
package org.osflash.signals.natives 
{
    import flash.errors.*;
    import flash.events.*;
    import org.osflash.signals.*;
    
    public class NativeSignal extends Object implements org.osflash.signals.IDeluxeSignal, org.osflash.signals.natives.INativeDispatcher
    {
        public function NativeSignal(arg1:flash.events.IEventDispatcher, arg2:String, arg3:Class=null)
        {
            super();
            _target = arg1;
            _eventType = arg2;
            _eventClass = arg3 || flash.events.Event;
            listenerBoxes = [];
            return;
        }

        public function dispatch(arg1:flash.events.Event):Boolean
        {
            if (!(arg1 is _eventClass)) 
            {
                throw new ArgumentError("Event object " + arg1 + " is not an instance of " + _eventClass + ".");
            }
            if (arg1.type != _eventType) 
            {
                throw new ArgumentError("Event object has incorrect type. Expected <" + _eventType + "> but was <" + arg1.type + ">.");
            }
            return _target.dispatchEvent(arg1);
        }

        public function addOnce(arg1:Function, arg2:int=0):void
        {
            registerListener(arg1, true, arg2);
            return;
        }

        public function remove(arg1:Function):void
        {
            var loc1:*=indexOfListener(arg1);
            if (loc1 == -1) 
            {
                return;
            }
            var loc2:*=listenerBoxes.splice(loc1, 1)[0];
            _target.removeEventListener(_eventType, loc2.execute);
            return;
        }

        public function get eventClass():Class
        {
            return _eventClass;
        }

        public function get valueClasses():Array
        {
            return [_eventClass];
        }

        public function get target():flash.events.IEventDispatcher
        {
            return _target;
        }

        public function add(arg1:Function, arg2:int=0):void
        {
            registerListener(arg1, false, arg2);
            return;
        }

        public function set target(arg1:flash.events.IEventDispatcher):void
        {
            _target = arg1;
            return;
        }

        protected function indexOfListener(arg1:Function):int
        {
            var loc1:*=listenerBoxes.length;
            while (loc1--) 
            {
                if (listenerBoxes[loc1].listener != arg1) 
                {
                    continue;
                }
                return loc1;
            }
            return -1;
        }

        public function get numListeners():uint
        {
            return listenerBoxes.length;
        }

        public function get eventType():String
        {
            return _eventType;
        }

        protected function registerListener(arg1:Function, arg2:Boolean=false, arg3:int=0):void
        {
            var once:Boolean=false;
            var prevlistenerBox:Object;
            var signal:org.osflash.signals.natives.NativeSignal;
            var priority:int=0;
            var prevListenerIndex:int;
            var listener:Function;
            var listenerBox:Object;

            var loc1:*;
            prevlistenerBox = null;
            signal = null;
            listener = arg1;
            once = arg2;
            priority = arg3;
            if (listener.length != 1) 
            {
                throw new ArgumentError("Listener for native event must declare exactly 1 argument.");
            }
            prevListenerIndex = indexOfListener(listener);
            if (prevListenerIndex >= 0) 
            {
                prevlistenerBox = listenerBoxes[prevListenerIndex];
                if (prevlistenerBox.once && !once) 
                {
                    throw new flash.errors.IllegalOperationError("You cannot addOnce() then add() the same listener without removing the relationship first.");
                }
                if (!prevlistenerBox.once && once) 
                {
                    throw new flash.errors.IllegalOperationError("You cannot add() then addOnce() the same listener without removing the relationship first.");
                }
                return;
            }
            listenerBox = {"listener":listener, "once":once, "execute":listener};
            if (once) 
            {
                signal = this;
                listenerBox.execute = function (arg1:flash.events.Event):void
                {
                    signal.remove(listener);
                    listener(arg1);
                    return;
                }
            }
            listenerBoxes[listenerBoxes.length] = listenerBox;
            _target.addEventListener(_eventType, listenerBox.execute, false, priority);
            return;
        }

        public function removeAll():void
        {
            var loc1:*=listenerBoxes.length;
            while (loc1--) 
            {
                remove(listenerBoxes[loc1].listener as Function);
            }
            return;
        }

        protected var _eventClass:Class;

        protected var listenerBoxes:Array;

        protected var _target:flash.events.IEventDispatcher;

        protected var _eventType:String;
    }
}


//        class DeluxeSignal
package org.osflash.signals 
{
    import flash.errors.*;
    import org.osflash.signals.events.*;
    
    public class DeluxeSignal extends Object implements org.osflash.signals.IDeluxeSignal, org.osflash.signals.IDispatcher
    {
        public function DeluxeSignal(arg1:Object, ... rest)
        {
            super();
            _target = arg1;
            listenerBoxes = [];
            if (rest.length == 1 && rest[0] is Array) 
            {
                rest = rest[0];
            }
            setValueClasses(rest);
            return;
        }

        public function dispatch(... rest):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc6:*=null;
            var loc8:*=null;
            var loc3:*=_valueClasses.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                var loc9:*;
                loc1 = loc9 = rest[loc4];
                if (!(loc9 === null)) 
                {
                    loc9 === null;
                    loc2 = loc9 = _valueClasses[loc4];
                }
                if (loc9 !== null) 
                {
                    throw new ArgumentError("Value object <" + loc1 + "> is not an instance of <" + loc2 + ">.");
                }
                ++loc4;
            }
            var loc5:*;
            if (loc5 = rest[0] as org.osflash.signals.events.IEvent) 
            {
                if (loc5.target) 
                {
                    loc5 = loc9 = loc5.clone();
                    rest[0] = loc9;
                }
                loc5.target = this.target;
                loc5.currentTarget = this.target;
                loc5.signal = this;
            }
            listenersNeedCloning = true;
            if (listenerBoxes.length) 
            {
                loc9 = 0;
                var loc10:*=listenerBoxes;
                for each (loc8 in loc10) 
                {
                    loc6 = loc8.listener;
                    if (loc8.once) 
                    {
                        remove(loc6);
                    }
                    loc6.apply(null, rest);
                }
            }
            listenersNeedCloning = false;
            if (!loc5 || !loc5.bubbles) 
            {
                return;
            }
            var loc7:*=this.target;
            for (;;) 
            {
                if (loc7 && loc7.hasOwnProperty("parent")) 
                {
                    loc7 && loc7.hasOwnProperty("parent");
                    loc7 = loc9 = loc7.parent;
                }
                if (!(loc7 && loc7.hasOwnProperty("parent"))) 
                {
                    break;
                }
                if (!(loc7 is org.osflash.signals.events.IBubbleEventHandler)) 
                {
                    continue;
                }
                loc5.currentTarget = loc9 = loc7;
                org.osflash.signals.events.IBubbleEventHandler(loc9).onEventBubbled(loc5);
                break;
            }
            return;
        }

        public function addOnce(arg1:Function, arg2:int=0):void
        {
            registerListener(arg1, true, arg2);
            return;
        }

        public function remove(arg1:Function):void
        {
            if (indexOfListener(arg1) == -1) 
            {
                return;
            }
            if (listenersNeedCloning) 
            {
                listenerBoxes = listenerBoxes.slice();
                listenersNeedCloning = false;
            }
            listenerBoxes.splice(indexOfListener(arg1), 1);
            return;
        }

        public function get target():Object
        {
            return _target;
        }

        public function get numListeners():uint
        {
            return listenerBoxes.length;
        }

        protected function indexOfListener(arg1:Function):int
        {
            var loc1:*=listenerBoxes.length;
            while (loc1--) 
            {
                if (listenerBoxes[loc1].listener != arg1) 
                {
                    continue;
                }
                return loc1;
            }
            return -1;
        }

        public function add(arg1:Function, arg2:int=0):void
        {
            registerListener(arg1, false, arg2);
            return;
        }

        public function set target(arg1:Object):void
        {
            if (arg1 == _target) 
            {
                return;
            }
            removeAll();
            _target = arg1;
            return;
        }

        protected function setValueClasses(arg1:Array):void
        {
            _valueClasses = arg1 || [];
            var loc1:*=_valueClasses.length;
            while (loc1--) 
            {
                if (_valueClasses[loc1] is Class) 
                {
                    continue;
                }
                throw new ArgumentError("Invalid valueClasses argument: item at index " + loc1 + " should be a Class but was:<" + _valueClasses[loc1] + ">.");
            }
            return;
        }

        public function get valueClasses():Array
        {
            return _valueClasses;
        }

        public function removeAll():void
        {
            var loc1:*=listenerBoxes.length;
            while (loc1--) 
            {
                remove(listenerBoxes[loc1].listener as Function);
            }
            return;
        }

        protected function registerListener(arg1:Function, arg2:Boolean=false, arg3:int=0):void
        {
            var loc5:*=null;
            var loc6:*=null;
            if (arg1.length < _valueClasses.length) 
            {
                loc5 = arg1.length != 1 ? "arguments" : "argument";
                throw new ArgumentError("Listener has " + arg1.length + " " + loc5 + " but it needs at least " + _valueClasses.length + " to match the given value classes.");
            }
            var loc1:*={"listener":arg1, "once":arg2, "priority":arg3};
            if (!listenerBoxes.length) 
            {
                listenerBoxes[0] = loc1;
                return;
            }
            var loc2:*;
            if ((loc2 = indexOfListener(arg1)) >= 0) 
            {
                if ((loc6 = listenerBoxes[loc2]).once && !arg2) 
                {
                    throw new flash.errors.IllegalOperationError("You cannot addOnce() then add() the same listener without removing the relationship first.");
                }
                if (!loc6.once && arg2) 
                {
                    throw new flash.errors.IllegalOperationError("You cannot add() then addOnce() the same listener without removing the relationship first.");
                }
                return;
            }
            if (listenersNeedCloning) 
            {
                listenerBoxes = listenerBoxes.slice();
                listenersNeedCloning = false;
            }
            var loc3:*=listenerBoxes.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (arg3 > listenerBoxes[loc4].priority) 
                {
                    listenerBoxes.splice(loc4, 0, loc1);
                    return;
                }
                ++loc4;
            }
            listenerBoxes[listenerBoxes.length] = loc1;
            return;
        }

        protected var _valueClasses:Array;

        protected var listenerBoxes:Array;

        protected var listenersNeedCloning:Boolean=false;

        protected var _target:Object;
    }
}


//        class IDeluxeSignal
package org.osflash.signals 
{
    public interface IDeluxeSignal
    {
        function add(arg1:Function, arg2:int=0):void;

        function addOnce(arg1:Function, arg2:int=0):void;

        function remove(arg1:Function):void;

        function get valueClasses():Array;

        function get numListeners():uint;
    }
}


//        class IDispatcher
package org.osflash.signals 
{
    public interface IDispatcher
    {
        function dispatch(... rest):void;
    }
}


//        class ISignal
package org.osflash.signals 
{
    public interface ISignal
    {
        function add(arg1:Function):void;

        function addOnce(arg1:Function):void;

        function remove(arg1:Function):void;

        function get valueClasses():Array;

        function get numListeners():uint;
    }
}


//        class Signal
package org.osflash.signals 
{
    import flash.errors.*;
    import flash.utils.*;
    
    public class Signal extends Object implements org.osflash.signals.ISignal, org.osflash.signals.IDispatcher
    {
        public function Signal(... rest)
        {
            super();
            listeners = [];
            onceListeners = new flash.utils.Dictionary();
            if (rest.length == 1 && rest[0] is Array) 
            {
                rest = rest[0];
            }
            setValueClasses(rest);
            return;
        }

        public function add(arg1:Function):void
        {
            registerListener(arg1);
            return;
        }

        public function addOnce(arg1:Function):void
        {
            registerListener(arg1, true);
            return;
        }

        public function remove(arg1:Function):void
        {
            var loc1:*=listeners.indexOf(arg1);
            if (loc1 == -1) 
            {
                return;
            }
            if (listenersNeedCloning) 
            {
                listeners = listeners.slice();
                listenersNeedCloning = false;
            }
            listeners.splice(loc1, 1);
            delete onceListeners[arg1];
            return;
        }

        protected function registerListener(arg1:Function, arg2:Boolean=false):void
        {
            var loc1:*=null;
            if (arg1.length < _valueClasses.length) 
            {
                loc1 = arg1.length != 1 ? "arguments" : "argument";
                throw new ArgumentError("Listener has " + arg1.length + " " + loc1 + " but it needs at least " + _valueClasses.length + " to match the given value classes.");
            }
            if (!listeners.length) 
            {
                listeners[0] = arg1;
                if (arg2) 
                {
                    onceListeners[arg1] = true;
                }
                return;
            }
            if (listeners.indexOf(arg1) >= 0) 
            {
                if (onceListeners[arg1] && !arg2) 
                {
                    throw new flash.errors.IllegalOperationError("You cannot addOnce() then add() the same listener without removing the relationship first.");
                }
                if (!onceListeners[arg1] && arg2) 
                {
                    throw new flash.errors.IllegalOperationError("You cannot add() then addOnce() the same listener without removing the relationship first.");
                }
                return;
            }
            if (listenersNeedCloning) 
            {
                listeners = listeners.slice();
                listenersNeedCloning = false;
            }
            listeners[listeners.length] = arg1;
            if (arg2) 
            {
                onceListeners[arg1] = true;
            }
            return;
        }

        protected function setValueClasses(arg1:Array):void
        {
            _valueClasses = arg1 || [];
            var loc1:*=_valueClasses.length;
            while (loc1--) 
            {
                if (_valueClasses[loc1] is Class) 
                {
                    continue;
                }
                throw new ArgumentError("Invalid valueClasses argument: item at index " + loc1 + " should be a Class but was:<" + _valueClasses[loc1] + ">.");
            }
            return;
        }

        public function get numListeners():uint
        {
            return listeners.length;
        }

        public function dispatch(... rest):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc5:*=null;
            var loc3:*=_valueClasses.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                var loc6:*;
                loc1 = loc6 = rest[loc4];
                if (!(loc6 === null)) 
                {
                    loc6 === null;
                    loc2 = loc6 = _valueClasses[loc4];
                }
                if (loc6 !== null) 
                {
                    throw new ArgumentError("Value object <" + loc1 + "> is not an instance of <" + loc2 + ">.");
                }
                ++loc4;
            }
            if (!listeners.length) 
            {
                return;
            }
            listenersNeedCloning = true;
            loc6 = rest.length;
            switch (loc6) 
            {
                case 0:
                {
                    loc6 = 0;
                    var loc7:*=listeners;
                    for each (loc5 in loc7) 
                    {
                        if (onceListeners[loc5]) 
                        {
                            remove(loc5);
                        }
                        loc5();
                    }
                    break;
                }
                case 1:
                {
                    loc6 = 0;
                    loc7 = listeners;
                    for each (loc5 in loc7) 
                    {
                        if (onceListeners[loc5]) 
                        {
                            remove(loc5);
                        }
                        loc5(rest[0]);
                    }
                    break;
                }
                default:
                {
                    loc6 = 0;
                    loc7 = listeners;
                    for each (loc5 in loc7) 
                    {
                        if (onceListeners[loc5]) 
                        {
                            remove(loc5);
                        }
                        loc5.apply(null, rest);
                    }
                }
            }
            listenersNeedCloning = false;
            return;
        }

        public function get valueClasses():Array
        {
            return _valueClasses;
        }

        public function removeAll():void
        {
            var loc1:*=listeners.length;
            while (loc1--) 
            {
                remove(listeners[loc1] as Function);
            }
            return;
        }

        protected var listenersNeedCloning:Boolean=false;

        protected var onceListeners:flash.utils.Dictionary;

        protected var _valueClasses:Array;

        protected var listeners:Array;
    }
}


//    package puremvc
//      package as3
//        package multicore
//          package core
//            class Controller
package org.puremvc.as3.multicore.core 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.observer.*;
    
    public class Controller extends Object implements org.puremvc.as3.multicore.interfaces.IController
    {
        public function Controller(arg1:String)
        {
            super();
            if (instanceMap[arg1] != null) 
            {
                throw Error(MULTITON_MSG);
            }
            multitonKey = arg1;
            instanceMap[multitonKey] = this;
            commandMap = new Array();
            initializeController();
            return;
        }

        public function removeCommand(arg1:String):void
        {
            if (hasCommand(arg1)) 
            {
                view.removeObserver(arg1, this);
                commandMap[arg1] = null;
            }
            return;
        }

        public function registerCommand(arg1:String, arg2:Class):void
        {
            if (commandMap[arg1] == null) 
            {
                view.registerObserver(arg1, new org.puremvc.as3.multicore.patterns.observer.Observer(executeCommand, this));
            }
            commandMap[arg1] = arg2;
            return;
        }

        protected function initializeController():void
        {
            view = org.puremvc.as3.multicore.core.View.getInstance(multitonKey);
            return;
        }

        public function hasCommand(arg1:String):Boolean
        {
            return !(commandMap[arg1] == null);
        }

        public function executeCommand(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=commandMap[arg1.getName()];
            if (loc1 == null) 
            {
                return;
            }
            var loc2:*=new loc1();
            loc2.initializeNotifier(multitonKey);
            loc2.execute(arg1);
            return;
        }

        public static function removeController(arg1:String):void
        {
            delete instanceMap[arg1];
            return;
        }

        public static function getInstance(arg1:String):org.puremvc.as3.multicore.interfaces.IController
        {
            if (instanceMap[arg1] == null) 
            {
                instanceMap[arg1] = new Controller(arg1);
            }
            return instanceMap[arg1];
        }

        
        {
            instanceMap = new Array();
        }

        protected const MULTITON_MSG:String="Controller instance for this Multiton key already constructed!";

        protected var commandMap:Array;

        protected var view:org.puremvc.as3.multicore.interfaces.IView;

        protected var multitonKey:String;

        protected static var instanceMap:Array;
    }
}


//            class Model
package org.puremvc.as3.multicore.core 
{
    import org.puremvc.as3.multicore.interfaces.*;
    
    public class Model extends Object implements org.puremvc.as3.multicore.interfaces.IModel
    {
        public function Model(arg1:String)
        {
            super();
            if (instanceMap[arg1] != null) 
            {
                throw Error(MULTITON_MSG);
            }
            multitonKey = arg1;
            instanceMap[multitonKey] = this;
            proxyMap = new Array();
            initializeModel();
            return;
        }

        protected function initializeModel():void
        {
            return;
        }

        public function removeProxy(arg1:String):org.puremvc.as3.multicore.interfaces.IProxy
        {
            var loc1:*=proxyMap[arg1] as org.puremvc.as3.multicore.interfaces.IProxy;
            if (loc1) 
            {
                proxyMap[arg1] = null;
                loc1.onRemove();
            }
            return loc1;
        }

        public function hasProxy(arg1:String):Boolean
        {
            return !(proxyMap[arg1] == null);
        }

        public function retrieveProxy(arg1:String):org.puremvc.as3.multicore.interfaces.IProxy
        {
            return proxyMap[arg1];
        }

        public function registerProxy(arg1:org.puremvc.as3.multicore.interfaces.IProxy):void
        {
            arg1.initializeNotifier(multitonKey);
            proxyMap[arg1.getProxyName()] = arg1;
            arg1.onRegister();
            return;
        }

        public static function getInstance(arg1:String):org.puremvc.as3.multicore.interfaces.IModel
        {
            if (instanceMap[arg1] == null) 
            {
                instanceMap[arg1] = new Model(arg1);
            }
            return instanceMap[arg1];
        }

        public static function removeModel(arg1:String):void
        {
            delete instanceMap[arg1];
            return;
        }

        
        {
            instanceMap = new Array();
        }

        protected const MULTITON_MSG:String="Model instance for this Multiton key already constructed!";

        protected var multitonKey:String;

        protected var proxyMap:Array;

        protected static var instanceMap:Array;
    }
}


//            class View
package org.puremvc.as3.multicore.core 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.observer.*;
    
    public class View extends Object implements org.puremvc.as3.multicore.interfaces.IView
    {
        public function View(arg1:String)
        {
            super();
            if (instanceMap[arg1] != null) 
            {
                throw Error(MULTITON_MSG);
            }
            multitonKey = arg1;
            instanceMap[multitonKey] = this;
            mediatorMap = new Array();
            observerMap = new Array();
            initializeView();
            return;
        }

        public function removeObserver(arg1:String, arg2:Object):void
        {
            var loc1:*=observerMap[arg1] as Array;
            var loc2:*=0;
            while (loc2 < loc1.length) 
            {
                if (org.puremvc.as3.multicore.patterns.observer.Observer(loc1[loc2]).compareNotifyContext(arg2) == true) 
                {
                    loc1.splice(loc2, 1);
                    break;
                }
                ++loc2;
            }
            if (loc1.length == 0) 
            {
                delete observerMap[arg1];
            }
            return;
        }

        public function hasMediator(arg1:String):Boolean
        {
            return !(mediatorMap[arg1] == null);
        }

        public function notifyObservers(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=NaN;
            if (observerMap[arg1.getName()] != null) 
            {
                loc1 = observerMap[arg1.getName()] as Array;
                loc2 = new Array();
                loc4 = 0;
                while (loc4 < loc1.length) 
                {
                    loc3 = loc1[loc4] as org.puremvc.as3.multicore.interfaces.IObserver;
                    loc2.push(loc3);
                    ++loc4;
                }
                loc4 = 0;
                while (loc4 < loc2.length) 
                {
                    (loc3 = loc2[loc4] as org.puremvc.as3.multicore.interfaces.IObserver).notifyObserver(arg1);
                    ++loc4;
                }
            }
            return;
        }

        protected function initializeView():void
        {
            return;
        }

        public function registerMediator(arg1:org.puremvc.as3.multicore.interfaces.IMediator):void
        {
            var loc2:*=null;
            var loc3:*=NaN;
            if (mediatorMap[arg1.getMediatorName()] != null) 
            {
                return;
            }
            arg1.initializeNotifier(multitonKey);
            mediatorMap[arg1.getMediatorName()] = arg1;
            var loc1:*=arg1.listNotificationInterests();
            if (loc1.length > 0) 
            {
                loc2 = new org.puremvc.as3.multicore.patterns.observer.Observer(arg1.handleNotification, arg1);
                loc3 = 0;
                while (loc3 < loc1.length) 
                {
                    registerObserver(loc1[loc3], loc2);
                    ++loc3;
                }
            }
            arg1.onRegister();
            return;
        }

        public function removeMediator(arg1:String):org.puremvc.as3.multicore.interfaces.IMediator
        {
            var loc2:*=null;
            var loc3:*=NaN;
            var loc1:*=mediatorMap[arg1] as org.puremvc.as3.multicore.interfaces.IMediator;
            if (loc1) 
            {
                loc2 = loc1.listNotificationInterests();
                loc3 = 0;
                while (loc3 < loc2.length) 
                {
                    removeObserver(loc2[loc3], loc1);
                    ++loc3;
                }
                delete mediatorMap[arg1];
                loc1.onRemove();
            }
            return loc1;
        }

        public function registerObserver(arg1:String, arg2:org.puremvc.as3.multicore.interfaces.IObserver):void
        {
            if (observerMap[arg1] == null) 
            {
                observerMap[arg1] = [arg2];
            }
            else 
            {
                observerMap[arg1].push(arg2);
            }
            return;
        }

        public function retrieveMediator(arg1:String):org.puremvc.as3.multicore.interfaces.IMediator
        {
            return mediatorMap[arg1];
        }

        public static function removeView(arg1:String):void
        {
            delete instanceMap[arg1];
            return;
        }

        public static function getInstance(arg1:String):org.puremvc.as3.multicore.interfaces.IView
        {
            if (instanceMap[arg1] == null) 
            {
                instanceMap[arg1] = new View(arg1);
            }
            return instanceMap[arg1];
        }

        
        {
            instanceMap = new Array();
        }

        protected const MULTITON_MSG:String="View instance for this Multiton key already constructed!";

        protected var multitonKey:String;

        protected var observerMap:Array;

        protected var mediatorMap:Array;

        protected static var instanceMap:Array;
    }
}


//          package interfaces
//            class IAsyncCommand
package org.puremvc.as3.multicore.interfaces 
{
    public interface IAsyncCommand extends org.puremvc.as3.multicore.interfaces.ICommand
    {
        function setOnComplete(arg1:Function):void;
    }
}


//            class ICommand
package org.puremvc.as3.multicore.interfaces 
{
    public interface ICommand extends org.puremvc.as3.multicore.interfaces.INotifier
    {
        function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void;
    }
}


//            class IController
package org.puremvc.as3.multicore.interfaces 
{
    public interface IController
    {
        function registerCommand(arg1:String, arg2:Class):void;

        function hasCommand(arg1:String):Boolean;

        function executeCommand(arg1:org.puremvc.as3.multicore.interfaces.INotification):void;

        function removeCommand(arg1:String):void;
    }
}


//            class IFacade
package org.puremvc.as3.multicore.interfaces 
{
    public interface IFacade extends org.puremvc.as3.multicore.interfaces.INotifier
    {
        function removeCommand(arg1:String):void;

        function registerCommand(arg1:String, arg2:Class):void;

        function removeProxy(arg1:String):org.puremvc.as3.multicore.interfaces.IProxy;

        function registerProxy(arg1:org.puremvc.as3.multicore.interfaces.IProxy):void;

        function hasMediator(arg1:String):Boolean;

        function retrieveMediator(arg1:String):org.puremvc.as3.multicore.interfaces.IMediator;

        function hasCommand(arg1:String):Boolean;

        function retrieveProxy(arg1:String):org.puremvc.as3.multicore.interfaces.IProxy;

        function notifyObservers(arg1:org.puremvc.as3.multicore.interfaces.INotification):void;

        function registerMediator(arg1:org.puremvc.as3.multicore.interfaces.IMediator):void;

        function removeMediator(arg1:String):org.puremvc.as3.multicore.interfaces.IMediator;

        function hasProxy(arg1:String):Boolean;
    }
}


//            class IMediator
package org.puremvc.as3.multicore.interfaces 
{
    public interface IMediator extends org.puremvc.as3.multicore.interfaces.INotifier
    {
        function listNotificationInterests():Array;

        function onRegister():void;

        function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void;

        function getMediatorName():String;

        function setViewComponent(arg1:Object):void;

        function getViewComponent():Object;

        function onRemove():void;
    }
}


//            class IModel
package org.puremvc.as3.multicore.interfaces 
{
    public interface IModel
    {
        function removeProxy(arg1:String):org.puremvc.as3.multicore.interfaces.IProxy;

        function retrieveProxy(arg1:String):org.puremvc.as3.multicore.interfaces.IProxy;

        function registerProxy(arg1:org.puremvc.as3.multicore.interfaces.IProxy):void;

        function hasProxy(arg1:String):Boolean;
    }
}


//            class INotification
package org.puremvc.as3.multicore.interfaces 
{
    public interface INotification
    {
        function getType():String;

        function getName():String;

        function toString():String;

        function setBody(arg1:Object):void;

        function getBody():Object;

        function setType(arg1:String):void;
    }
}


//            class INotifier
package org.puremvc.as3.multicore.interfaces 
{
    public interface INotifier
    {
        function sendNotification(arg1:String, arg2:Object=null, arg3:String=null):void;

        function initializeNotifier(arg1:String):void;
    }
}


//            class IObserver
package org.puremvc.as3.multicore.interfaces 
{
    public interface IObserver
    {
        function compareNotifyContext(arg1:Object):Boolean;

        function setNotifyContext(arg1:Object):void;

        function setNotifyMethod(arg1:Function):void;

        function notifyObserver(arg1:org.puremvc.as3.multicore.interfaces.INotification):void;
    }
}


//            class IProxy
package org.puremvc.as3.multicore.interfaces 
{
    public interface IProxy extends org.puremvc.as3.multicore.interfaces.INotifier
    {
        function getData():Object;

        function onRegister():void;

        function getProxyName():String;

        function onRemove():void;

        function setData(arg1:Object):void;
    }
}


//            class IView
package org.puremvc.as3.multicore.interfaces 
{
    public interface IView
    {
        function notifyObservers(arg1:org.puremvc.as3.multicore.interfaces.INotification):void;

        function registerMediator(arg1:org.puremvc.as3.multicore.interfaces.IMediator):void;

        function removeMediator(arg1:String):org.puremvc.as3.multicore.interfaces.IMediator;

        function registerObserver(arg1:String, arg2:org.puremvc.as3.multicore.interfaces.IObserver):void;

        function removeObserver(arg1:String, arg2:Object):void;

        function hasMediator(arg1:String):Boolean;

        function retrieveMediator(arg1:String):org.puremvc.as3.multicore.interfaces.IMediator;
    }
}


//          package patterns
//            package command
//              class AsyncCommand
package org.puremvc.as3.multicore.patterns.command 
{
    import org.puremvc.as3.multicore.interfaces.*;
    
    public class AsyncCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.IAsyncCommand
    {
        public function AsyncCommand()
        {
            super();
            return;
        }

        public function setOnComplete(arg1:Function):void
        {
            onComplete = arg1;
            return;
        }

        protected function commandComplete():void
        {
            onComplete();
            return;
        }

        internal var onComplete:Function;
    }
}


//              class AsyncMacroCommand
package org.puremvc.as3.multicore.patterns.command 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.observer.*;
    
    public class AsyncMacroCommand extends org.puremvc.as3.multicore.patterns.observer.Notifier implements org.puremvc.as3.multicore.interfaces.IAsyncCommand, org.puremvc.as3.multicore.interfaces.INotifier
    {
        public function AsyncMacroCommand()
        {
            super();
            subCommands = new Array();
            initializeAsyncMacroCommand();
            return;
        }

        public function setOnComplete(arg1:Function):void
        {
            onComplete = arg1;
            return;
        }

        protected function initializeAsyncMacroCommand():void
        {
            return;
        }

        protected function addSubCommand(arg1:Class):void
        {
            subCommands.push(arg1);
            return;
        }

        internal function nextCommand():void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=false;
            if (subCommands.length > 0) 
            {
                loc1 = subCommands.shift();
                loc2 = new loc1();
                loc3 = loc2 is org.puremvc.as3.multicore.interfaces.IAsyncCommand;
                if (loc3) 
                {
                    org.puremvc.as3.multicore.interfaces.IAsyncCommand(loc2).setOnComplete(nextCommand);
                }
                org.puremvc.as3.multicore.interfaces.ICommand(loc2).initializeNotifier(multitonKey);
                org.puremvc.as3.multicore.interfaces.ICommand(loc2).execute(note);
                if (!loc3) 
                {
                    nextCommand();
                }
            }
            else 
            {
                if (onComplete != null) 
                {
                    onComplete();
                }
                note = null;
                onComplete = null;
            }
            return;
        }

        public final function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            note = arg1;
            nextCommand();
            return;
        }

        internal var subCommands:Array;

        internal var note:org.puremvc.as3.multicore.interfaces.INotification;

        internal var onComplete:Function;
    }
}


//              class MacroCommand
package org.puremvc.as3.multicore.patterns.command 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.observer.*;
    
    public class MacroCommand extends org.puremvc.as3.multicore.patterns.observer.Notifier implements org.puremvc.as3.multicore.interfaces.ICommand, org.puremvc.as3.multicore.interfaces.INotifier
    {
        public function MacroCommand()
        {
            super();
            subCommands = new Array();
            initializeMacroCommand();
            return;
        }

        public final function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=null;
            while (subCommands.length > 0) 
            {
                loc1 = subCommands.shift();
                loc2 = new loc1();
                loc2.initializeNotifier(multitonKey);
                loc2.execute(arg1);
            }
            return;
        }

        protected function addSubCommand(arg1:Class):void
        {
            subCommands.push(arg1);
            return;
        }

        protected function initializeMacroCommand():void
        {
            return;
        }

        internal var subCommands:Array;
    }
}


//              class SimpleCommand
package org.puremvc.as3.multicore.patterns.command 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.observer.*;
    
    public class SimpleCommand extends org.puremvc.as3.multicore.patterns.observer.Notifier implements org.puremvc.as3.multicore.interfaces.ICommand, org.puremvc.as3.multicore.interfaces.INotifier
    {
        public function SimpleCommand()
        {
            super();
            return;
        }

        public function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            return;
        }
    }
}


//            package facade
//              class Facade
package org.puremvc.as3.multicore.patterns.facade 
{
    import org.puremvc.as3.multicore.core.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.observer.*;
    
    public class Facade extends Object implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function Facade(arg1:String)
        {
            super();
            if (instanceMap[arg1] != null) 
            {
                throw Error(MULTITON_MSG);
            }
            initializeNotifier(arg1);
            instanceMap[multitonKey] = this;
            initializeFacade();
            return;
        }

        public function removeProxy(arg1:String):org.puremvc.as3.multicore.interfaces.IProxy
        {
            var loc1:*=null;
            if (model != null) 
            {
                loc1 = model.removeProxy(arg1);
            }
            return loc1;
        }

        public function registerProxy(arg1:org.puremvc.as3.multicore.interfaces.IProxy):void
        {
            model.registerProxy(arg1);
            return;
        }

        protected function initializeController():void
        {
            if (controller != null) 
            {
                return;
            }
            controller = org.puremvc.as3.multicore.core.Controller.getInstance(multitonKey);
            return;
        }

        protected function initializeFacade():void
        {
            initializeModel();
            initializeController();
            initializeView();
            return;
        }

        public function retrieveProxy(arg1:String):org.puremvc.as3.multicore.interfaces.IProxy
        {
            return model.retrieveProxy(arg1);
        }

        public function sendNotification(arg1:String, arg2:Object=null, arg3:String=null):void
        {
            notifyObservers(new org.puremvc.as3.multicore.patterns.observer.Notification(arg1, arg2, arg3));
            return;
        }

        public function notifyObservers(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            if (view != null) 
            {
                view.notifyObservers(arg1);
            }
            return;
        }

        protected function initializeView():void
        {
            if (view != null) 
            {
                return;
            }
            view = org.puremvc.as3.multicore.core.View.getInstance(multitonKey);
            return;
        }

        public function retrieveMediator(arg1:String):org.puremvc.as3.multicore.interfaces.IMediator
        {
            return view.retrieveMediator(arg1) as org.puremvc.as3.multicore.interfaces.IMediator;
        }

        public function initializeNotifier(arg1:String):void
        {
            multitonKey = arg1;
            return;
        }

        public function removeMediator(arg1:String):org.puremvc.as3.multicore.interfaces.IMediator
        {
            var loc1:*=null;
            if (view != null) 
            {
                loc1 = view.removeMediator(arg1);
            }
            return loc1;
        }

        public function hasCommand(arg1:String):Boolean
        {
            return controller.hasCommand(arg1);
        }

        public function removeCommand(arg1:String):void
        {
            controller.removeCommand(arg1);
            return;
        }

        public function registerCommand(arg1:String, arg2:Class):void
        {
            controller.registerCommand(arg1, arg2);
            return;
        }

        public function hasMediator(arg1:String):Boolean
        {
            return view.hasMediator(arg1);
        }

        public function registerMediator(arg1:org.puremvc.as3.multicore.interfaces.IMediator):void
        {
            if (view != null) 
            {
                view.registerMediator(arg1);
            }
            return;
        }

        protected function initializeModel():void
        {
            if (model != null) 
            {
                return;
            }
            model = org.puremvc.as3.multicore.core.Model.getInstance(multitonKey);
            return;
        }

        public function hasProxy(arg1:String):Boolean
        {
            return model.hasProxy(arg1);
        }

        public static function hasCore(arg1:String):Boolean
        {
            return !(instanceMap[arg1] == null);
        }

        public static function getInstance(arg1:String):org.puremvc.as3.multicore.interfaces.IFacade
        {
            if (instanceMap[arg1] == null) 
            {
                instanceMap[arg1] = new Facade(arg1);
            }
            return instanceMap[arg1];
        }

        public static function removeCore(arg1:String):void
        {
            if (instanceMap[arg1] == null) 
            {
                return;
            }
            org.puremvc.as3.multicore.core.Model.removeModel(arg1);
            org.puremvc.as3.multicore.core.View.removeView(arg1);
            org.puremvc.as3.multicore.core.Controller.removeController(arg1);
            delete instanceMap[arg1];
            return;
        }

        
        {
            instanceMap = new Array();
        }

        protected const MULTITON_MSG:String="Facade instance for this Multiton key already constructed!";

        protected var multitonKey:String;

        protected var controller:org.puremvc.as3.multicore.interfaces.IController;

        protected var model:org.puremvc.as3.multicore.interfaces.IModel;

        protected var view:org.puremvc.as3.multicore.interfaces.IView;

        protected static var instanceMap:Array;
    }
}


//            package mediator
//              class Mediator
package org.puremvc.as3.multicore.patterns.mediator 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.observer.*;
    
    public class Mediator extends org.puremvc.as3.multicore.patterns.observer.Notifier implements org.puremvc.as3.multicore.interfaces.IMediator, org.puremvc.as3.multicore.interfaces.INotifier
    {
        public function Mediator(arg1:String=null, arg2:Object=null)
        {
            super();
            this.mediatorName = arg1 == null ? NAME : arg1;
            this.viewComponent = arg2;
            return;
        }

        public function listNotificationInterests():Array
        {
            return [];
        }

        public function onRegister():void
        {
            return;
        }

        public function onRemove():void
        {
            return;
        }

        public function getViewComponent():Object
        {
            return viewComponent;
        }

        public function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            return;
        }

        public function getMediatorName():String
        {
            return mediatorName;
        }

        public function setViewComponent(arg1:Object):void
        {
            this.viewComponent = arg1;
            return;
        }

        public static const NAME:String="Mediator";

        protected var viewComponent:Object;

        protected var mediatorName:String;
    }
}


//            package observer
//              class Notification
package org.puremvc.as3.multicore.patterns.observer 
{
    import org.puremvc.as3.multicore.interfaces.*;
    
    public class Notification extends Object implements org.puremvc.as3.multicore.interfaces.INotification
    {
        public function Notification(arg1:String, arg2:Object=null, arg3:String=null)
        {
            super();
            this.name = arg1;
            this.body = arg2;
            this.type = arg3;
            return;
        }

        public function setBody(arg1:Object):void
        {
            this.body = arg1;
            return;
        }

        public function getName():String
        {
            return name;
        }

        public function toString():String
        {
            var loc1:*="Notification Name: " + getName();
            loc1 = loc1 + ("\nBody:" + (body != null ? body.toString() : "null"));
            loc1 = loc1 + ("\nType:" + (type != null ? type : "null"));
            return loc1;
        }

        public function getType():String
        {
            return type;
        }

        public function setType(arg1:String):void
        {
            this.type = arg1;
            return;
        }

        public function getBody():Object
        {
            return body;
        }

        internal var body:Object;

        internal var name:String;

        internal var type:String;
    }
}


//              class Notifier
package org.puremvc.as3.multicore.patterns.observer 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class Notifier extends Object implements org.puremvc.as3.multicore.interfaces.INotifier
    {
        public function Notifier()
        {
            super();
            return;
        }

        public function sendNotification(arg1:String, arg2:Object=null, arg3:String=null):void
        {
            if (facade != null) 
            {
                facade.sendNotification(arg1, arg2, arg3);
            }
            return;
        }

        protected function get facade():org.puremvc.as3.multicore.interfaces.IFacade
        {
            if (multitonKey == null) 
            {
                throw Error(MULTITON_MSG);
            }
            return org.puremvc.as3.multicore.patterns.facade.Facade.getInstance(multitonKey);
        }

        public function initializeNotifier(arg1:String):void
        {
            multitonKey = arg1;
            return;
        }

        protected const MULTITON_MSG:String="multitonKey for this Notifier not yet initialized!";

        protected var multitonKey:String;
    }
}


//              class Observer
package org.puremvc.as3.multicore.patterns.observer 
{
    import org.puremvc.as3.multicore.interfaces.*;
    
    public class Observer extends Object implements org.puremvc.as3.multicore.interfaces.IObserver
    {
        public function Observer(arg1:Function, arg2:Object)
        {
            super();
            setNotifyMethod(arg1);
            setNotifyContext(arg2);
            return;
        }

        internal function getNotifyMethod():Function
        {
            return notify;
        }

        public function compareNotifyContext(arg1:Object):Boolean
        {
            return arg1 === this.context;
        }

        public function setNotifyContext(arg1:Object):void
        {
            context = arg1;
            return;
        }

        internal function getNotifyContext():Object
        {
            return context;
        }

        public function setNotifyMethod(arg1:Function):void
        {
            notify = arg1;
            return;
        }

        public function notifyObserver(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            this.getNotifyMethod().apply(this.getNotifyContext(), [arg1]);
            return;
        }

        internal var notify:Function;

        internal var context:Object;
    }
}


//            package proxy
//              class Proxy
package org.puremvc.as3.multicore.patterns.proxy 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.observer.*;
    
    public class Proxy extends org.puremvc.as3.multicore.patterns.observer.Notifier implements org.puremvc.as3.multicore.interfaces.IProxy, org.puremvc.as3.multicore.interfaces.INotifier
    {
        public function Proxy(arg1:String=null, arg2:Object=null)
        {
            super();
            this.proxyName = arg1 == null ? NAME : arg1;
            if (arg2 != null) 
            {
                setData(arg2);
            }
            return;
        }

        public function getData():Object
        {
            return data;
        }

        public function setData(arg1:Object):void
        {
            this.data = arg1;
            return;
        }

        public function onRegister():void
        {
            return;
        }

        public function getProxyName():String
        {
            return proxyName;
        }

        public function onRemove():void
        {
            return;
        }

        
        {
            NAME = "Proxy";
        }

        protected var data:Object;

        protected var proxyName:String;

        public static var NAME:String="Proxy";
    }
}


//          package utilities
//            package pipes
//              package interfaces
//                class IPipeAware
package org.puremvc.as3.multicore.utilities.pipes.interfaces 
{
    public interface IPipeAware
    {
        function acceptInputPipe(arg1:String, arg2:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting):void;

        function acceptOutputPipe(arg1:String, arg2:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting):void;
    }
}


//                class IPipeFitting
package org.puremvc.as3.multicore.utilities.pipes.interfaces 
{
    public interface IPipeFitting
    {
        function connect(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting):Boolean;

        function disconnect():org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting;

        function write(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):Boolean;
    }
}


//                class IPipeMessage
package org.puremvc.as3.multicore.utilities.pipes.interfaces 
{
    public interface IPipeMessage
    {
        function getType():String;

        function getHeader():Object;

        function setBody(arg1:Object):void;

        function setPriority(arg1:int):void;

        function getBody():Object;

        function getPriority():int;

        function setType(arg1:String):void;

        function setHeader(arg1:Object):void;
    }
}


//              package messages
//                class FilterControlMessage
package org.puremvc.as3.multicore.utilities.pipes.messages 
{
    public class FilterControlMessage extends org.puremvc.as3.multicore.utilities.pipes.messages.Message
    {
        public function FilterControlMessage(arg1:String, arg2:String, arg3:Function=null, arg4:Object=null)
        {
            super(arg1);
            setName(arg2);
            setFilter(arg3);
            setParams(arg4);
            return;
        }

        public function getName():String
        {
            return this.name;
        }

        public function setParams(arg1:Object):void
        {
            this.params = arg1;
            return;
        }

        public function setName(arg1:String):void
        {
            this.name = arg1;
            return;
        }

        public function getFilter():Function
        {
            return this.filter;
        }

        public function setFilter(arg1:Function):void
        {
            this.filter = arg1;
            return;
        }

        public function getParams():Object
        {
            return this.params;
        }

        protected static const BASE:String=org.puremvc.as3.multicore.utilities.pipes.messages.Message.BASE + "filter-control/";

        public static const SET_PARAMS:String=BASE + "setparams";

        public static const SET_FILTER:String=BASE + "setfilter";

        public static const BYPASS:String=BASE + "bypass";

        public static const FILTER:String=BASE + "filter";

        protected var params:Object;

        protected var name:String;

        protected var filter:Function;
    }
}


//                class Message
package org.puremvc.as3.multicore.utilities.pipes.messages 
{
    import org.puremvc.as3.multicore.utilities.pipes.interfaces.*;
    
    public class Message extends Object implements org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage
    {
        public function Message(arg1:String, arg2:Object=null, arg3:Object=null, arg4:int=5)
        {
            super();
            setType(arg1);
            setHeader(arg2);
            setBody(arg3);
            setPriority(arg4);
            return;
        }

        public function setPriority(arg1:int):void
        {
            this.priority = arg1;
            return;
        }

        public function getPriority():int
        {
            return priority;
        }

        public function getHeader():Object
        {
            return header;
        }

        public function setHeader(arg1:Object):void
        {
            this.header = arg1;
            return;
        }

        public function getType():String
        {
            return this.type;
        }

        public function setBody(arg1:Object):void
        {
            this.body = arg1;
            return;
        }

        public function getBody():Object
        {
            return body;
        }

        public function setType(arg1:String):void
        {
            this.type = arg1;
            return;
        }

        public static const PRIORITY_MED:int=5;

        public static const NORMAL:String=BASE + "normal/";

        protected static const BASE:String="http://puremvc.org/namespaces/pipes/messages/";

        public static const PRIORITY_LOW:int=10;

        public static const PRIORITY_HIGH:int=1;

        protected var body:Object;

        protected var priority:int;

        protected var header:Object;

        protected var type:String;
    }
}


//                class QueueControlMessage
package org.puremvc.as3.multicore.utilities.pipes.messages 
{
    public class QueueControlMessage extends org.puremvc.as3.multicore.utilities.pipes.messages.Message
    {
        public function QueueControlMessage(arg1:String)
        {
            super(arg1);
            return;
        }

        protected static const BASE:String=org.puremvc.as3.multicore.utilities.pipes.messages.Message.BASE + "/queue/";

        public static const FIFO:String=BASE + "fifo";

        public static const FLUSH:String=BASE + "flush";

        public static const SORT:String=BASE + "sort";
    }
}


//              package plumbing
//                class Filter
package org.puremvc.as3.multicore.utilities.pipes.plumbing 
{
    import org.puremvc.as3.multicore.utilities.pipes.interfaces.*;
    import org.puremvc.as3.multicore.utilities.pipes.messages.*;
    
    public class Filter extends org.puremvc.as3.multicore.utilities.pipes.plumbing.Pipe
    {
        public function Filter(arg1:String, arg2:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting=null, arg3:Function=null, arg4:Object=null)
        {
            mode = org.puremvc.as3.multicore.utilities.pipes.messages.FilterControlMessage.FILTER;
            filter = function (arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage, arg2:Object):void
            {
                return;
            }
            params = {};
            super(arg2);
            this.name = arg1;
            if (arg3 != null) 
            {
                setFilter(arg3);
            }
            if (arg4 != null) 
            {
                setParams(arg4);
            }
            return;
        }

        public function setParams(arg1:Object):void
        {
            this.params = arg1;
            return;
        }

        protected function applyFilter(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage
        {
            filter.apply(this, [arg1, params]);
            return arg1;
        }

        public function setFilter(arg1:Function):void
        {
            this.filter = arg1;
            return;
        }

        protected function isTarget(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):Boolean
        {
            return org.puremvc.as3.multicore.utilities.pipes.messages.FilterControlMessage(arg1).getName() == this.name;
        }

        public override function write(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):Boolean
        {
            var success:Boolean;
            var outputMessage:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage;
            var message:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage;

            var loc1:*;
            outputMessage = null;
            message = arg1;
            success = true;
            var loc2:*=message.getType();
            switch (loc2) 
            {
                case org.puremvc.as3.multicore.utilities.pipes.messages.Message.NORMAL:
                {
                    try 
                    {
                        if (mode != org.puremvc.as3.multicore.utilities.pipes.messages.FilterControlMessage.FILTER) 
                        {
                            outputMessage = message;
                        }
                        else 
                        {
                            outputMessage = applyFilter(message);
                        }
                        success = output.write(outputMessage);
                    }
                    catch (e:Error)
                    {
                        success = false;
                    }
                    break;
                }
                case org.puremvc.as3.multicore.utilities.pipes.messages.FilterControlMessage.SET_PARAMS:
                {
                    if (isTarget(message)) 
                    {
                        setParams(org.puremvc.as3.multicore.utilities.pipes.messages.FilterControlMessage(message).getParams());
                    }
                    else 
                    {
                        success = output.write(outputMessage);
                    }
                    break;
                }
                case org.puremvc.as3.multicore.utilities.pipes.messages.FilterControlMessage.SET_FILTER:
                {
                    if (isTarget(message)) 
                    {
                        setFilter(org.puremvc.as3.multicore.utilities.pipes.messages.FilterControlMessage(message).getFilter());
                    }
                    else 
                    {
                        success = output.write(outputMessage);
                    }
                    break;
                }
                case org.puremvc.as3.multicore.utilities.pipes.messages.FilterControlMessage.BYPASS:
                case org.puremvc.as3.multicore.utilities.pipes.messages.FilterControlMessage.FILTER:
                {
                    if (isTarget(message)) 
                    {
                        mode = org.puremvc.as3.multicore.utilities.pipes.messages.FilterControlMessage(message).getType();
                    }
                    else 
                    {
                        success = output.write(outputMessage);
                    }
                    break;
                }
                default:
                {
                    success = output.write(outputMessage);
                }
            }
            return success;
        }

        protected var mode:String;

        protected var name:String;

        protected var params:Object;

        protected var filter:Function;
    }
}


//                class Junction
package org.puremvc.as3.multicore.utilities.pipes.plumbing 
{
    import org.puremvc.as3.multicore.utilities.pipes.interfaces.*;
    
    public class Junction extends Object
    {
        public function Junction()
        {
            inputPipes = new Array();
            outputPipes = new Array();
            pipesMap = new Array();
            pipeTypesMap = new Array();
            super();
            return;
        }

        public function addPipeListener(arg1:String, arg2:Object, arg3:Function):Boolean
        {
            var loc2:*=null;
            var loc1:*=false;
            if (hasInputPipe(arg1)) 
            {
                loc1 = (loc2 = pipesMap[arg1] as org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting).connect(new org.puremvc.as3.multicore.utilities.pipes.plumbing.PipeListener(arg2, arg3));
            }
            return loc1;
        }

        public function hasPipe(arg1:String):Boolean
        {
            return !(pipesMap[arg1] == null);
        }

        public function hasOutputPipe(arg1:String):Boolean
        {
            return hasPipe(arg1) && pipeTypesMap[arg1] == OUTPUT;
        }

        public function retrievePipe(arg1:String):org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting
        {
            return pipesMap[arg1] as org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting;
        }

        public function registerPipe(arg1:String, arg2:String, arg3:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting):Boolean
        {
            var loc1:*=true;
            if (pipesMap[arg1] != null) 
            {
                loc1 = false;
            }
            else 
            {
                pipesMap[arg1] = arg3;
                pipeTypesMap[arg1] = arg2;
                var loc2:*=arg2;
                switch (loc2) 
                {
                    case INPUT:
                    {
                        inputPipes.push(arg1);
                        break;
                    }
                    case OUTPUT:
                    {
                        outputPipes.push(arg1);
                        break;
                    }
                    default:
                    {
                        loc1 = false;
                    }
                }
            }
            return loc1;
        }

        public function removePipe(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=0;
            if (hasPipe(arg1)) 
            {
                loc1 = pipeTypesMap[arg1];
                var loc4:*=loc1;
                switch (loc4) 
                {
                    case INPUT:
                    {
                        loc2 = inputPipes;
                        break;
                    }
                    case OUTPUT:
                    {
                        loc2 = outputPipes;
                        break;
                    }
                }
                loc3 = 0;
                while (loc3 < loc2.length) 
                {
                    if (loc2[loc3] == arg1) 
                    {
                        loc2.splice(loc3, 1);
                        break;
                    }
                    ++loc3;
                }
                delete pipesMap[arg1];
                delete pipeTypesMap[arg1];
            }
            return;
        }

        public function hasInputPipe(arg1:String):Boolean
        {
            return hasPipe(arg1) && pipeTypesMap[arg1] == INPUT;
        }

        public function sendMessage(arg1:String, arg2:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):Boolean
        {
            var loc2:*=null;
            var loc1:*=false;
            if (hasOutputPipe(arg1)) 
            {
                loc1 = (loc2 = pipesMap[arg1] as org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting).write(arg2);
            }
            return loc1;
        }

        public static const OUTPUT:String="output";

        public static const INPUT:String="input";

        protected var outputPipes:Array;

        protected var pipesMap:Array;

        protected var pipeTypesMap:Array;

        protected var inputPipes:Array;
    }
}


//                class JunctionMediator
package org.puremvc.as3.multicore.utilities.pipes.plumbing 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    import org.puremvc.as3.multicore.utilities.pipes.interfaces.*;
    
    public class JunctionMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator
    {
        public function JunctionMediator(arg1:String, arg2:org.puremvc.as3.multicore.utilities.pipes.plumbing.Junction)
        {
            super(arg1, arg2);
            return;
        }

        public override function listNotificationInterests():Array
        {
            return [JunctionMediator.ACCEPT_INPUT_PIPE, JunctionMediator.ACCEPT_OUTPUT_PIPE];
        }

        public function handlePipeMessage(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):void
        {
            return;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=arg1.getName();
            switch (loc5) 
            {
                case JunctionMediator.ACCEPT_INPUT_PIPE:
                {
                    loc1 = arg1.getType();
                    loc2 = arg1.getBody() as org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting;
                    if (junction.registerPipe(loc1, org.puremvc.as3.multicore.utilities.pipes.plumbing.Junction.INPUT, loc2)) 
                    {
                        junction.addPipeListener(loc1, this, handlePipeMessage);
                    }
                    break;
                }
                case JunctionMediator.ACCEPT_OUTPUT_PIPE:
                {
                    loc3 = arg1.getType();
                    loc4 = arg1.getBody() as org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting;
                    junction.registerPipe(loc3, org.puremvc.as3.multicore.utilities.pipes.plumbing.Junction.OUTPUT, loc4);
                    break;
                }
            }
            return;
        }

        protected function get junction():org.puremvc.as3.multicore.utilities.pipes.plumbing.Junction
        {
            return viewComponent as org.puremvc.as3.multicore.utilities.pipes.plumbing.Junction;
        }

        public static const ACCEPT_INPUT_PIPE:String="acceptInputPipe";

        public static const ACCEPT_OUTPUT_PIPE:String="acceptOutputPipe";
    }
}


//                class Pipe
package org.puremvc.as3.multicore.utilities.pipes.plumbing 
{
    import org.puremvc.as3.multicore.utilities.pipes.interfaces.*;
    
    public class Pipe extends Object implements org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting
    {
        public function Pipe(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting=null)
        {
            super();
            if (arg1) 
            {
                connect(arg1);
            }
            return;
        }

        public function connect(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting):Boolean
        {
            var loc1:*=false;
            if (this.output == null) 
            {
                this.output = arg1;
                loc1 = true;
            }
            return loc1;
        }

        public function disconnect():org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting
        {
            var loc1:*=this.output;
            this.output = null;
            return loc1;
        }

        public function write(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):Boolean
        {
            return output.write(arg1);
        }

        protected var output:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting;
    }
}


//                class PipeListener
package org.puremvc.as3.multicore.utilities.pipes.plumbing 
{
    import org.puremvc.as3.multicore.utilities.pipes.interfaces.*;
    
    public class PipeListener extends Object implements org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting
    {
        public function PipeListener(arg1:Object, arg2:Function)
        {
            super();
            this.context = arg1;
            this.listener = arg2;
            return;
        }

        public function write(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):Boolean
        {
            listener.apply(context, [arg1]);
            return true;
        }

        public function connect(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting):Boolean
        {
            return false;
        }

        public function disconnect():org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting
        {
            return null;
        }

        internal var listener:Function;

        internal var context:Object;
    }
}


//                class Queue
package org.puremvc.as3.multicore.utilities.pipes.plumbing 
{
    import org.puremvc.as3.multicore.utilities.pipes.interfaces.*;
    import org.puremvc.as3.multicore.utilities.pipes.messages.*;
    
    public class Queue extends org.puremvc.as3.multicore.utilities.pipes.plumbing.Pipe
    {
        public function Queue(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting=null)
        {
            mode = org.puremvc.as3.multicore.utilities.pipes.messages.QueueControlMessage.SORT;
            messages = new Array();
            super(arg1);
            return;
        }

        protected function store(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):void
        {
            messages.push(arg1);
            if (mode == org.puremvc.as3.multicore.utilities.pipes.messages.QueueControlMessage.SORT) 
            {
                messages.sort(sortMessagesByPriority);
            }
            return;
        }

        protected function flush():Boolean
        {
            var loc3:*=false;
            var loc1:*=true;
            var loc2:*=messages.shift() as org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage;
            while (loc2 != null) 
            {
                loc3 = output.write(loc2);
                if (!loc3) 
                {
                    loc1 = false;
                }
                loc2 = messages.shift() as org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage;
            }
            return loc1;
        }

        protected function sortMessagesByPriority(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage, arg2:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):Number
        {
            var loc1:*=0;
            if (arg1.getPriority() < arg2.getPriority()) 
            {
                loc1 = -1;
            }
            if (arg1.getPriority() > arg2.getPriority()) 
            {
                loc1 = 1;
            }
            return loc1;
        }

        public override function write(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):Boolean
        {
            var loc1:*=true;
            var loc2:*=arg1.getType();
            switch (loc2) 
            {
                case org.puremvc.as3.multicore.utilities.pipes.messages.Message.NORMAL:
                {
                    this.store(arg1);
                    break;
                }
                case org.puremvc.as3.multicore.utilities.pipes.messages.QueueControlMessage.FLUSH:
                {
                    loc1 = this.flush();
                    break;
                }
                case org.puremvc.as3.multicore.utilities.pipes.messages.QueueControlMessage.SORT:
                case org.puremvc.as3.multicore.utilities.pipes.messages.QueueControlMessage.FIFO:
                {
                    mode = arg1.getType();
                    break;
                }
            }
            return loc1;
        }

        protected var mode:String;

        protected var messages:Array;
    }
}


//                class TeeMerge
package org.puremvc.as3.multicore.utilities.pipes.plumbing 
{
    import org.puremvc.as3.multicore.utilities.pipes.interfaces.*;
    
    public class TeeMerge extends org.puremvc.as3.multicore.utilities.pipes.plumbing.Pipe
    {
        public function TeeMerge(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting=null, arg2:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting=null)
        {
            super();
            if (arg1) 
            {
                connectInput(arg1);
            }
            if (arg2) 
            {
                connectInput(arg2);
            }
            return;
        }

        public function connectInput(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting):Boolean
        {
            return arg1.connect(this);
        }
    }
}


//                class TeeSplit
package org.puremvc.as3.multicore.utilities.pipes.plumbing 
{
    import org.puremvc.as3.multicore.utilities.pipes.interfaces.*;
    
    public class TeeSplit extends Object implements org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting
    {
        public function TeeSplit(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting=null, arg2:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting=null)
        {
            outputs = new Array();
            super();
            if (arg1) 
            {
                connect(arg1);
            }
            if (arg2) 
            {
                connect(arg2);
            }
            return;
        }

        public function disconnectFitting(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting):org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting
        {
            var loc1:*=null;
            var loc3:*=null;
            var loc2:*=0;
            while (loc2 < outputs.length) 
            {
                if ((loc3 = outputs[loc2]) === arg1) 
                {
                    outputs.splice(loc2, 1);
                    loc1 = loc3;
                    break;
                }
                ++loc2;
            }
            return loc1;
        }

        public function connect(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting):Boolean
        {
            outputs.push(arg1);
            return true;
        }

        public function disconnect():org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting
        {
            return outputs.pop() as org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeFitting;
        }

        public function write(arg1:org.puremvc.as3.multicore.utilities.pipes.interfaces.IPipeMessage):Boolean
        {
            var loc3:*=null;
            var loc1:*=true;
            var loc2:*=0;
            while (loc2 < outputs.length) 
            {
                if (!(loc3 = outputs[loc2]).write(arg1)) 
                {
                    loc1 = false;
                }
                ++loc2;
            }
            return loc1;
        }

        protected var outputs:Array;
    }
}


//            package statemachine
//              class FSMInjector
package org.puremvc.as3.multicore.utilities.statemachine 
{
    import org.puremvc.as3.multicore.patterns.observer.*;
    
    public class FSMInjector extends org.puremvc.as3.multicore.patterns.observer.Notifier
    {
        public function FSMInjector(arg1:XML)
        {
            super();
            this.fsm = arg1;
            return;
        }

        public function inject():void
        {
            var loc2:*=null;
            var loc1:*=new org.puremvc.as3.multicore.utilities.statemachine.StateMachine();
            var loc3:*=0;
            var loc4:*=states;
            for each (loc2 in loc4) 
            {
                loc1.registerState(loc2, isInitial(loc2.name));
            }
            facade.registerMediator(loc1);
            return;
        }

        protected function get states():Array
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=null;
            var loc4:*=null;
            if (stateList == null) 
            {
                stateList = new Array();
                loc1 = fsm;
                while (loc2 < loc1.length()) 
                {
                    loc3 = loc1[loc2];
                    loc4 = createState(loc3);
                    stateList.push(loc4);
                    ++loc2;
                }
            }
            return stateList;
        }

        protected function createState(arg1:XML):org.puremvc.as3.multicore.utilities.statemachine.State
        {
            var loc7:*=0;
            var loc8:*=null;
            var loc1:*=arg1.@name.toString();
            var loc2:*=arg1.@exiting.toString();
            var loc3:*=arg1.@entering.toString();
            var loc4:*=arg1.@changed.toString();
            var loc5:*=new org.puremvc.as3.multicore.utilities.statemachine.State(loc1, loc3, loc2, loc4);
            var loc6:*=arg1 as XMLList;
            while (loc7 < loc6.length()) 
            {
                loc8 = loc6[loc7];
                loc5.defineTrans(String(loc8.@action), String(loc8.@target));
                ++loc7;
            }
            return loc5;
        }

        protected function isInitial(arg1:String):Boolean
        {
            var loc1:*=XML(fsm.@initial).toString();
            return arg1 == loc1;
        }

        protected var fsm:XML;

        protected var stateList:Array;
    }
}


//              class State
package org.puremvc.as3.multicore.utilities.statemachine 
{
    public class State extends Object
    {
        public function State(arg1:String, arg2:String=null, arg3:String=null, arg4:String=null)
        {
            transitions = new Object();
            super();
            this.name = arg1;
            if (arg2) 
            {
                this.entering = arg2;
            }
            if (arg3) 
            {
                this.exiting = arg3;
            }
            if (arg4) 
            {
                this.changed = arg4;
            }
            return;
        }

        public function removeTrans(arg1:String):void
        {
            transitions[arg1] = null;
            return;
        }

        public function getTarget(arg1:String):String
        {
            return transitions[arg1];
        }

        public function defineTrans(arg1:String, arg2:String):void
        {
            if (getTarget(arg1) != null) 
            {
                return;
            }
            transitions[arg1] = arg2;
            return;
        }

        public var entering:String;

        public var exiting:String;

        public var name:String;

        public var changed:String;

        protected var transitions:Object;
    }
}


//              class StateMachine
package org.puremvc.as3.multicore.utilities.statemachine 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class StateMachine extends org.puremvc.as3.multicore.patterns.mediator.Mediator
    {
        public function StateMachine()
        {
            states = new Object();
            super(NAME);
            return;
        }

        public override function listNotificationInterests():Array
        {
            return [ACTION, CANCEL];
        }

        public override function onRegister():void
        {
            if (initial) 
            {
                transitionTo(initial, null);
            }
            return;
        }

        public function removeState(arg1:String):void
        {
            var loc1:*=states[arg1];
            if (loc1 == null) 
            {
                return;
            }
            states[arg1] = null;
            return;
        }

        public function registerState(arg1:org.puremvc.as3.multicore.utilities.statemachine.State, arg2:Boolean=false):void
        {
            if (arg1 == null || !(states[arg1.name] == null)) 
            {
                return;
            }
            states[arg1.name] = arg1;
            if (arg2) 
            {
                this.initial = arg1;
            }
            return;
        }

        protected function transitionTo(arg1:org.puremvc.as3.multicore.utilities.statemachine.State, arg2:Object=null):void
        {
            if (arg1 == null) 
            {
                return;
            }
            canceled = false;
            if (currentState && currentState.exiting) 
            {
                sendNotification(currentState.exiting, arg2, arg1.name);
            }
            if (canceled) 
            {
                canceled = false;
                return;
            }
            if (arg1.entering) 
            {
                sendNotification(arg1.entering, arg2);
            }
            currentState = arg1;
            if (arg1.changed) 
            {
                sendNotification(currentState.changed, arg2);
            }
            sendNotification(CHANGED, currentState, currentState.name);
            return;
        }

        protected function set currentState(arg1:org.puremvc.as3.multicore.utilities.statemachine.State):void
        {
            viewComponent = arg1;
            return;
        }

        protected function get currentState():org.puremvc.as3.multicore.utilities.statemachine.State
        {
            return viewComponent as org.puremvc.as3.multicore.utilities.statemachine.State;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=arg1.getName();
            switch (loc4) 
            {
                case ACTION:
                {
                    loc1 = arg1.getType();
                    loc2 = currentState.getTarget(loc1);
                    if (loc3 = states[loc2]) 
                    {
                        transitionTo(loc3, arg1.getBody());
                    }
                    break;
                }
                case CANCEL:
                {
                    canceled = true;
                    break;
                }
            }
            return;
        }

        public static const CHANGED:String=NAME + "/notes/changed";

        public static const ACTION:String=NAME + "/notes/action";

        public static const CANCEL:String=NAME + "/notes/cancel";

        public static const NAME:String="StateMachine";

        protected var states:Object;

        protected var canceled:Boolean;

        protected var initial:org.puremvc.as3.multicore.utilities.statemachine.State;
    }
}


//  class _7b7e4e6f5f76275cf0c2562e90fe71eabc843c54607ed29acd7adac4401b6f19_flash_display_Sprite
package 
{
    import flash.display.*;
    import flash.system.*;
    
    public class _7b7e4e6f5f76275cf0c2562e90fe71eabc843c54607ed29acd7adac4401b6f19_flash_display_Sprite extends flash.display.Sprite
    {
        public function _7b7e4e6f5f76275cf0c2562e90fe71eabc843c54607ed29acd7adac4401b6f19_flash_display_Sprite()
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


//  class _fef13db75c522e9deb82eaceba03a695e4e64af2a882cd9068d0177efdfcf111_flash_display_Sprite
package 
{
    import flash.display.*;
    import flash.system.*;
    
    public class _fef13db75c522e9deb82eaceba03a695e4e64af2a882cd9068d0177efdfcf111_flash_display_Sprite extends flash.display.Sprite
    {
        public function _fef13db75c522e9deb82eaceba03a695e4e64af2a882cd9068d0177efdfcf111_flash_display_Sprite()
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


