//ActionScript 3.0
//  package mgs
//    package aurora
//      package modules
//        package framesBuilder
//          package controller
//            package frameBuilder
//              class AddBackgroundCommand
package mgs.aurora.modules.framesBuilder.controller.frameBuilder 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class AddBackgroundCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function AddBackgroundCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.FrameDefinitionsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.FrameDefinitionsProxy;
            var loc3:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy;
            var loc4:*=loc1.currentFrame;
            var loc5:*;
            var loc6:*;
            var loc7:*=(loc6 = (loc5 = loc2.getData() as XML).systemFrame[loc4]).@className.toString();
            var loc8:*;
            (loc8 = this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.FramesProxy.NAME) as mgs.aurora.modules.framesBuilder.model.FramesProxy).setBackground(loc3.art, loc7);
            arg1.setBody(loc8);
            return;
        }
    }
}


//              class AddFrameButtons
package mgs.aurora.modules.framesBuilder.controller.frameBuilder 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class AddFrameButtons extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function AddFrameButtons()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.FramesProxy.NAME) as mgs.aurora.modules.framesBuilder.model.FramesProxy;
            loc2.setButtons(loc1.sysButtonVector);
            return;
        }
    }
}


//              class SetClockTimeCommand
package mgs.aurora.modules.framesBuilder.controller.frameBuilder 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetClockTimeCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetClockTimeCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.FramesProxy.NAME) as mgs.aurora.modules.framesBuilder.model.FramesProxy;
            loc1.setClockTime();
            return;
        }
    }
}


//            package framesControls
//              class BuildButtonsCommand
package mgs.aurora.modules.framesBuilder.controller.framesControls 
{
    import flash.display.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BuildButtonsCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BuildButtonsCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as XML;
            var loc2:*=new flash.display.MovieClip();
            var loc3:*;
            var loc4:*=(loc3 = this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy).art;
            var loc5:*=loc3.config;
            var loc6:*=loc1.@configId.toString();
            var loc7:*=loc5.buttons;
            var loc8:*;
            var loc9:*=(loc8 = this.getButtonXML(loc7, loc6)).@textLayer;
            var loc10:*=loc5.textLayer;
            var loc11:*;
            var loc12:*=(loc11 = this.getTextStyle(loc10, loc9)).@textFormat;
            var loc13:*=loc5.textFormat;
            var loc14:*=this.getTextFormat(loc13, loc12);
            var loc15:*=loc11.@textField;
            var loc16:*=loc5.textField;
            var loc17:*=this.getTextField(loc16, loc15);
            var loc18:*=loc5.dropShadow;
            var loc19:*;
            (loc19 = new mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonControl(loc2)).id = loc1.@id;
            loc19.type = loc1.@type;
            loc19.shortCutKey = uint(loc1.@shortCut);
            loc19.text = loc1.@text;
            loc19.inactiveText = loc1.@inactiveText;
            loc19.frameExcludeMethod = loc1.@excludeMethod;
            if (mgs.aurora.common.utilities.StringUtils.stringToBoolean(loc17.@embedFonts)) 
            {
                loc3.fontByName(loc14.@font);
            }
            var loc20:*;
            var loc21:*;
            if ((loc21 = (loc20 = facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.FrameDefinitionsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.FrameDefinitionsProxy).getData() as XML).BrandingSettings != undefined) 
            {
                this.replaceBrandingSettings(loc14, loc21.BrandingSettings);
            }
            loc19.drawButton(loc1, loc8, loc11, loc14, loc17, loc18, loc4);
            var loc22:*=loc1.@xpos;
            var loc23:*=loc1.@ypos;
            loc22 = loc8.@xOffsetScale == undefined ? loc22 : loc22 * Number(loc8.@xOffsetScale);
            loc23 = loc8.@yOffsetScale == undefined ? loc23 : loc23 * Number(loc8.@yOffsetScale);
            loc19.x = loc22;
            loc19.y = loc23;
            loc19.visible = mgs.aurora.common.utilities.StringUtils.stringToBoolean(loc1.@show.toString());
            loc19.enabled = false;
            var loc25:*=loc1.@state.toString();
            switch (loc25) 
            {
                case "enableButtons":
                case "enabled":
                {
                    loc19.enabled = true;
                    break;
                }
                case "disableButtons":
                case "disabled":
                {
                    loc19.enabled = false;
                    break;
                }
                case "hideButtons":
                case "hidden":
                {
                    loc19.visible = false;
                    break;
                }
                default:
                {
                    break;
                }
            }
            var loc24:*;
            (loc24 = this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy).addControl(loc19);
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_NEXT_CONTROL);
            return;
        }

        internal function getButtonXML(arg1:XMLList, arg2:String):XML
        {
            var buttonsXML:XMLList;
            var ButtonToBuild:String;
            var targetXML:XML;

            var loc1:*;
            buttonsXML = arg1;
            ButtonToBuild = arg2;
            targetXML = new XML("<button/>");
            var loc3:*=0;
            var loc4:*=buttonsXML.button;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == ButtonToBuild) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), buttonsXML, "button");
            return targetXML;
        }

        internal function getTextStyle(arg1:XMLList, arg2:String):XML
        {
            var textLayerXML:XMLList;
            var textLayerId:String;
            var targetXML:XML;

            var loc1:*;
            textLayerXML = arg1;
            textLayerId = arg2;
            targetXML = new XML("<textLayer/>");
            var loc3:*=0;
            var loc4:*=textLayerXML.style;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textLayerId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textLayerXML, "style");
            return targetXML;
        }

        internal function getTextFormat(arg1:XMLList, arg2:String):XML
        {
            var textFormatXML:XMLList;
            var textFormatId:String;
            var targetXML:XML;

            var loc1:*;
            textFormatXML = arg1;
            textFormatId = arg2;
            targetXML = new XML("<textFormat/>");
            var loc3:*=0;
            var loc4:*=textFormatXML.style;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textFormatId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textFormatXML, "style");
            return targetXML;
        }

        internal function getTextField(arg1:XMLList, arg2:String):XML
        {
            var textFieldXML:XMLList;
            var textFieldId:String;
            var targetXML:XML;

            var loc1:*;
            textFieldXML = arg1;
            textFieldId = arg2;
            targetXML = new XML("<textField/>");
            var loc3:*=0;
            var loc4:*=textFieldXML.textt;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textFieldId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textFieldXML, "textt");
            return targetXML;
        }

        internal function populateFromInheritedNode(arg1:XML, arg2:XML, arg3:XMLList, arg4:String):void
        {
            var targetXML:XML;
            var sourceXML:XML;
            var parentXML:XMLList;
            var targetChild:String;
            var item:XML;
            var inheritFrom:String;
            var extendFrom:XML;
            var property:String;
            var value:String;

            var loc1:*;
            item = null;
            inheritFrom = null;
            extendFrom = null;
            property = null;
            value = null;
            targetXML = arg1;
            sourceXML = arg2;
            parentXML = arg3;
            targetChild = arg4;
            if (sourceXML.@inherit != undefined) 
            {
                inheritFrom = sourceXML.@inherit;
                var loc3:*=0;
                var loc4:*=parentXML[targetChild];
                var loc2:*=new XMLList("");
                for each (var loc5:* in loc4) 
                {
                    var loc6:*;
                    with (loc6 = loc5) 
                    {
                        if (@id == inheritFrom) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                extendFrom = XML(loc2);
                this.populateFromInheritedNode(targetXML, extendFrom, parentXML, targetChild);
            }
            targetXML.appendChild(sourceXML.children());
            loc2 = 0;
            loc3 = sourceXML.attributes();
            for each (item in loc3) 
            {
                property = item.name();
                value = item.toString();
                targetXML.@[property] = value;
            }
            return;
        }

        internal function replaceBrandingSettings(arg1:XML, arg2:XMLList):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=null;
            var loc7:*=0;
            var loc8:*=arg1.attributes();
            for each (loc1 in loc8) 
            {
                loc3 = loc1.name();
                if ((loc4 = loc1.toString()).indexOf("$") != 0) 
                {
                    continue;
                }
                loc5 = loc4.substr(1, loc4.length);
                arg1.@[loc3] = arg2.@[loc5];
            }
            loc2 = 0;
            while (loc2 < arg1.children().length()) 
            {
                loc6 = arg1.children()[loc2];
                this.replaceBrandingSettings(loc6, arg2);
                ++loc2;
            }
            return;
        }
    }
}


//              class BuildGraphicsCommand
package mgs.aurora.modules.framesBuilder.controller.framesControls 
{
    import flash.display.*;
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.graphics.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BuildGraphicsCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BuildGraphicsCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as XML;
            var loc2:*=new flash.display.MovieClip();
            var loc3:*;
            var loc4:*=(loc3 = this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy).config;
            var loc5:*=loc3.art;
            var loc6:*=loc4.dropShadow;
            var loc7:*;
            (loc7 = new mgs.aurora.modules.framesBuilder.model.frames.controls.graphics.GraphicControl(loc2)).id = loc1.@id.toString();
            loc7.type = loc1.@type.toString();
            loc7.drawGraphic(loc1, loc6, loc5);
            var loc9:*=loc1.@state.toString();
            switch (loc9) 
            {
                case "true":
                {
                    loc7.visible = true;
                    break;
                }
                case "false":
                {
                    loc7.visible = false;
                    break;
                }
                default:
                {
                    break;
                }
            }
            loc7.x = loc1.@xpos;
            loc7.y = loc1.@ypos;
            var loc8:*;
            (loc8 = this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy).addControl(loc7);
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_NEXT_CONTROL);
            return;
        }
    }
}


//              class BuildTextCommand
package mgs.aurora.modules.framesBuilder.controller.framesControls 
{
    import flash.display.*;
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.text.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BuildTextCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BuildTextCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var notification:org.puremvc.as3.multicore.interfaces.INotification;
            var controlXML:XML;
            var textHolder:flash.display.MovieClip;
            var controlsConfig:mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy;
            var configXML:XML;
            var textXML:XML;
            var textLayerId:String;
            var textLayerXML:XMLList;
            var textStyleConfig:XML;
            var textFormatId:String;
            var textFormatXML:XMLList;
            var textFormatConfig:XML;
            var textFieldId:String;
            var textFieldXML:XMLList;
            var textFieldConfig:XML;
            var dropShadow:XMLList;
            var textControl:mgs.aurora.modules.framesBuilder.model.frames.controls.text.TextControl;
            var controlProxy:mgs.aurora.modules.framesBuilder.model.ControlsProxy;

            var loc1:*;
            controlXML = null;
            textHolder = null;
            controlsConfig = null;
            configXML = null;
            textXML = null;
            textLayerId = null;
            textLayerXML = null;
            textStyleConfig = null;
            textFormatId = null;
            textFormatXML = null;
            textFormatConfig = null;
            textFieldId = null;
            textFieldXML = null;
            textFieldConfig = null;
            dropShadow = null;
            textControl = null;
            controlProxy = null;
            notification = arg1;
            controlXML = notification.getBody() as XML;
            textHolder = new flash.display.MovieClip();
            controlsConfig = this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy;
            configXML = controlsConfig.config;
            var loc3:*=0;
            var loc4:*=configXML.texts.text;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == controlXML.@type) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            textXML = XML(loc2);
            textLayerId = textXML.@textLayer;
            textLayerXML = configXML.textLayer;
            textStyleConfig = this.getTextStyle(textLayerXML, textLayerId);
            textFormatId = textStyleConfig.@textFormat;
            textFormatXML = configXML.textFormat;
            textFormatConfig = this.getTextFormat(textFormatXML, textFormatId);
            textFieldId = textStyleConfig.@textField;
            textFieldXML = configXML.textField;
            textFieldConfig = this.getTextField(textFieldXML, textFieldId);
            dropShadow = configXML.dropShadow;
            textControl = new mgs.aurora.modules.framesBuilder.model.frames.controls.text.TextControl(textHolder);
            textControl.id = controlXML.@id;
            textControl.type = controlXML.@type;
            textControl.text = controlXML.@text;
            textControl.drawText(controlXML, textXML, textStyleConfig, textFormatConfig, textFieldConfig, dropShadow);
            loc2 = controlXML.@state.toString();
            switch (loc2) 
            {
                case "true":
                {
                    textControl.visible = true;
                    break;
                }
                case "false":
                {
                    textControl.visible = false;
                    break;
                }
                default:
                {
                    break;
                }
            }
            textControl.x = controlXML.@xpos;
            textControl.y = controlXML.@ypos;
            controlProxy = this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy;
            controlProxy.addControl(textControl);
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_NEXT_CONTROL);
            return;
        }

        internal function getTextStyle(arg1:XMLList, arg2:String):XML
        {
            var textLayerXML:XMLList;
            var textLayerId:String;
            var targetXML:XML;

            var loc1:*;
            textLayerXML = arg1;
            textLayerId = arg2;
            targetXML = new XML("<textLayer/>");
            var loc3:*=0;
            var loc4:*=textLayerXML.style;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textLayerId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textLayerXML, "style");
            return targetXML;
        }

        internal function getTextFormat(arg1:XMLList, arg2:String):XML
        {
            var textFormatXML:XMLList;
            var textFormatId:String;
            var targetXML:XML;

            var loc1:*;
            textFormatXML = arg1;
            textFormatId = arg2;
            targetXML = new XML("<textFormat/>");
            var loc3:*=0;
            var loc4:*=textFormatXML.style;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textFormatId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textFormatXML, "style");
            return targetXML;
        }

        internal function getTextField(arg1:XMLList, arg2:String):XML
        {
            var textFieldXML:XMLList;
            var textFieldId:String;
            var targetXML:XML;

            var loc1:*;
            textFieldXML = arg1;
            textFieldId = arg2;
            targetXML = new XML("<textField/>");
            var loc3:*=0;
            var loc4:*=textFieldXML.textt;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textFieldId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textFieldXML, "textt");
            return targetXML;
        }

        internal function populateFromInheritedNode(arg1:XML, arg2:XML, arg3:XMLList, arg4:String):void
        {
            var targetXML:XML;
            var sourceXML:XML;
            var parentXML:XMLList;
            var targetChild:String;
            var item:XML;
            var inheritFrom:String;
            var extendFrom:XML;
            var property:String;
            var value:String;

            var loc1:*;
            item = null;
            inheritFrom = null;
            extendFrom = null;
            property = null;
            value = null;
            targetXML = arg1;
            sourceXML = arg2;
            parentXML = arg3;
            targetChild = arg4;
            if (sourceXML.@inherit != undefined) 
            {
                inheritFrom = sourceXML.@inherit;
                var loc3:*=0;
                var loc4:*=parentXML[targetChild];
                var loc2:*=new XMLList("");
                for each (var loc5:* in loc4) 
                {
                    var loc6:*;
                    with (loc6 = loc5) 
                    {
                        if (@id == inheritFrom) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                extendFrom = XML(loc2);
                this.populateFromInheritedNode(targetXML, extendFrom, parentXML, targetChild);
            }
            targetXML.appendChild(sourceXML.children());
            loc2 = 0;
            loc3 = sourceXML.attributes();
            for each (item in loc3) 
            {
                property = item.name();
                value = item.toString();
                targetXML.@[property] = value;
            }
            return;
        }
    }
}


//              class CreateNextControlCommand
package mgs.aurora.modules.framesBuilder.controller.framesControls 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class CreateNextControlCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function CreateNextControlCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsQueueProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsQueueProxy;
            if (loc1.isEmpty) 
            {
                this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CONTROLS_CREATED);
            }
            else 
            {
                loc2 = loc1.next;
                this.sendNotification(loc2.@type.toLowerCase(), loc2);
            }
            return;
        }
    }
}


//            package utils
//              class PureMVCUtility
package mgs.aurora.modules.framesBuilder.controller.utils 
{
    import mgs.aurora.modules.framesBuilder.*;
    import org.puremvc.as3.multicore.interfaces.*;
    
    public class PureMVCUtility extends Object
    {
        public function PureMVCUtility()
        {
            super();
            return;
        }

        public static function retrieveMediator(arg1:String):org.puremvc.as3.multicore.interfaces.IMediator
        {
            var loc1:*=mgs.aurora.modules.framesBuilder.FramesBuilderFacade.getInstance(mgs.aurora.modules.framesBuilder.FramesBuilderFacade.NAME);
            return loc1.retrieveMediator(arg1);
        }

        public static function retrieveProxy(arg1:String):org.puremvc.as3.multicore.interfaces.IProxy
        {
            var loc1:*=mgs.aurora.modules.framesBuilder.FramesBuilderFacade.getInstance(mgs.aurora.modules.framesBuilder.FramesBuilderFacade.NAME);
            return loc1.retrieveProxy(arg1);
        }

        public static function sendNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=mgs.aurora.modules.framesBuilder.FramesBuilderFacade.getInstance(mgs.aurora.modules.framesBuilder.FramesBuilderFacade.NAME);
            return loc1.sendNotification(arg1.getName(), arg1.getBody(), arg1.getType());
        }
    }
}


//            class AddGameControlsToStageCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class AddGameControlsToStageCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function AddGameControlsToStageCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.FramesProxy.NAME) as mgs.aurora.modules.framesBuilder.model.FramesProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy;
            loc1.setGameButtons(loc2.buttonVector);
            loc1.setGameGraphic(loc2.graphicVector);
            loc1.setGameText(loc2.textVector);
            loc1.addGameLayOutToContainer();
            this.facade.removeCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.HAVE_CONTROLS);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.HAVE_CONTROLS, mgs.aurora.modules.framesBuilder.controller.BuildFrameAsyncMacroCommand);
            loc1.currentFrame.gameLayoutComplete();
            return;
        }
    }
}


//            class AddGameLayoutCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class AddGameLayoutCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function AddGameLayoutCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            facade.removeCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.HAVE_CONTROLS);
            facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.HAVE_CONTROLS, mgs.aurora.modules.framesBuilder.controller.BuildGameLayoutMacroCommand);
            var loc1:*=arg1.getBody() as XML;
            var loc2:*=new XML("<layout><game><frame></frame></game></layout>");
            loc2.game.child("frame").appendChild(loc1.children());
            facade.registerProxy(new mgs.aurora.modules.framesBuilder.model.GameFrameDefinitionsProxy(loc2));
            sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CLEAR_GAME_LAYOUT);
            return;
        }
    }
}


//            class BuildFrameAsyncMacroCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import mgs.aurora.modules.framesBuilder.controller.frameBuilder.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BuildFrameAsyncMacroCommand extends org.puremvc.as3.multicore.patterns.command.AsyncMacroCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BuildFrameAsyncMacroCommand()
        {
            super();
            return;
        }

        protected override function initializeAsyncMacroCommand():void
        {
            this.addSubCommand(mgs.aurora.modules.framesBuilder.controller.frameBuilder.AddBackgroundCommand);
            this.addSubCommand(mgs.aurora.modules.framesBuilder.controller.frameBuilder.AddFrameButtons);
            this.addSubCommand(mgs.aurora.modules.framesBuilder.controller.frameBuilder.SetClockTimeCommand);
            return;
        }
    }
}


//            class BuildGameLayoutMacroCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BuildGameLayoutMacroCommand extends org.puremvc.as3.multicore.patterns.command.MacroCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BuildGameLayoutMacroCommand()
        {
            super();
            return;
        }

        protected override function initializeMacroCommand():void
        {
            super.initializeMacroCommand();
            this.addSubCommand(mgs.aurora.modules.framesBuilder.controller.AddGameControlsToStageCommand);
            return;
        }
    }
}


//            class ClearGameLayoutCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ClearGameLayoutCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ClearGameLayoutCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc2:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.FramesProxy.NAME) as mgs.aurora.modules.framesBuilder.model.FramesProxy;
            loc1.removeGameLayOutFromContainer();
            if (facade.hasProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME)) 
            {
                loc2 = this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy;
                loc2.reset(false);
            }
            sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CONTINUE_ADD_GAME_LAYOUT);
            return;
        }
    }
}


//            class ContinueAddingGameLayoutCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.model.frameSets.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ContinueAddingGameLayoutCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ContinueAddingGameLayoutCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.GameFrameDefinitionsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.GameFrameDefinitionsProxy;
            var loc2:*=loc1.getData() as XML;
            var loc3:*=loc2.child("game");
            var loc4:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy;
            var loc5:*;
            var loc6:*=(loc5 = new mgs.aurora.modules.framesBuilder.model.frameSets.CreateControlXml()).getControlXML(loc3, loc4.theme, facade);
            facade.registerProxy(new mgs.aurora.modules.framesBuilder.model.GameFrameDefinitionsProxy(loc2));
            loc4.systemFrameSet = false;
            sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_CONTROLS, loc6);
            return;
        }
    }
}


//            class ControlsCreatedCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ControlsCreatedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ControlsCreatedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            if (!this.facade.hasProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME)) 
            {
                this.facade.registerProxy(new mgs.aurora.modules.framesBuilder.model.ControlsProxy());
            }
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.HAVE_CONTROLS);
            return;
        }
    }
}


//            class ControlsProxySetupCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class ControlsProxySetupCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function ControlsProxySetupCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            if (!this.facade.hasProxy(mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy.NAME)) 
            {
                this.facade.registerProxy(new mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy());
            }
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy;
            var loc2:*=arg1.getName();
            switch (loc2) 
            {
                case mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_CONFIG:
                {
                    loc1.config = arg1.getBody() as XML;
                    break;
                }
                case mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_ART:
                {
                    loc1.art = arg1.getBody() as flash.display.LoaderInfo;
                    break;
                }
                case mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_FONT:
                {
                    loc1.font = arg1.getBody() as flash.display.LoaderInfo;
                    break;
                }
                case mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_EXCLUDE_LIST:
                {
                    loc1.excludeList = arg1.getBody() as Vector.<String>;
                    break;
                }
            }
            return;
        }
    }
}


//            class CreateControlsCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class CreateControlsCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function CreateControlsCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            if (!this.facade.hasProxy(mgs.aurora.modules.framesBuilder.model.ControlsQueueProxy.NAME)) 
            {
                this.facade.registerProxy(new mgs.aurora.modules.framesBuilder.model.ControlsQueueProxy());
            }
            var loc1:*=arg1.getBody() as XMLList;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsQueueProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsQueueProxy;
            loc2.add(loc1);
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_NEXT_CONTROL);
            return;
        }
    }
}


//            class RegisterFrameDefinitionsCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RegisterFrameDefinitionsCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RegisterFrameDefinitionsCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            this.facade.registerProxy(new mgs.aurora.modules.framesBuilder.model.FrameDefinitionsProxy(arg1.getBody()));
            return;
        }
    }
}


//            class RetrieveFrameSetCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.model.frameSets.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RetrieveFrameSetCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RetrieveFrameSetCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            if (!this.facade.hasProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME)) 
            {
                this.facade.registerProxy(new mgs.aurora.modules.framesBuilder.model.ControlsProxy());
            }
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.FrameDefinitionsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.FrameDefinitionsProxy;
            var loc2:*=loc1.getData() as XML;
            var loc3:*=arg1.getBody().id as String;
            var loc4:*=arg1.getBody().theme as String;
            var loc5:*=loc2.systemFrame[loc3];
            var loc6:*;
            var loc7:*=(loc6 = new mgs.aurora.modules.framesBuilder.model.frameSets.CreateControlXml()).getControlXML(loc5, loc4, facade);
            var loc8:*;
            (loc8 = this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy).currentFrame = loc3;
            loc8.theme = loc4;
            loc8.systemFrameSet = true;
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_CONTROLS, loc7);
            return;
        }
    }
}


//            class SetupSessionCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import mgs.aurora.modules.framesBuilder.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class SetupSessionCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function SetupSessionCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody() as Object;
            if (loc1 != null) 
            {
                if (this.facade.hasProxy(mgs.aurora.modules.framesBuilder.model.SessionProxy.NAME)) 
                {
                    this.facade.removeProxy(mgs.aurora.modules.framesBuilder.model.SessionProxy.NAME);
                }
                this.facade.registerProxy(new mgs.aurora.modules.framesBuilder.model.SessionProxy(loc1));
            }
            return;
        }
    }
}


//            class StartupCommand
package mgs.aurora.modules.framesBuilder.controller 
{
    import flash.display.*;
    import mgs.aurora.modules.framesBuilder.controller.framesControls.*;
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
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
            var loc1:*=arg1.getBody() as flash.display.Sprite;
            this.facade.registerProxy(new mgs.aurora.modules.framesBuilder.model.FramesProxy());
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_CONFIG, mgs.aurora.modules.framesBuilder.controller.ControlsProxySetupCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_ART, mgs.aurora.modules.framesBuilder.controller.ControlsProxySetupCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_FONT, mgs.aurora.modules.framesBuilder.controller.ControlsProxySetupCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_EXCLUDE_LIST, mgs.aurora.modules.framesBuilder.controller.ControlsProxySetupCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_FRAMEDEFINITIONS_CONFIG, mgs.aurora.modules.framesBuilder.controller.RegisterFrameDefinitionsCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_CONTROLS, mgs.aurora.modules.framesBuilder.controller.CreateControlsCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CONTROLS_CREATED, mgs.aurora.modules.framesBuilder.controller.ControlsCreatedCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.GET_FRAME, mgs.aurora.modules.framesBuilder.controller.RetrieveFrameSetCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.HAVE_CONTROLS, mgs.aurora.modules.framesBuilder.controller.BuildFrameAsyncMacroCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_NEXT_CONTROL, mgs.aurora.modules.framesBuilder.controller.framesControls.CreateNextControlCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_SESSIONCONFIG, mgs.aurora.modules.framesBuilder.controller.SetupSessionCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_BUTTON, mgs.aurora.modules.framesBuilder.controller.framesControls.BuildButtonsCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_BETTEXT, mgs.aurora.modules.framesBuilder.controller.framesControls.BuildTextCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_BETINFO, mgs.aurora.modules.framesBuilder.controller.framesControls.BuildTextCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CREATE_GRAPHIC, mgs.aurora.modules.framesBuilder.controller.framesControls.BuildGraphicsCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.ADD_GAME_LAYOUT, mgs.aurora.modules.framesBuilder.controller.AddGameLayoutCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CONTINUE_ADD_GAME_LAYOUT, mgs.aurora.modules.framesBuilder.controller.ContinueAddingGameLayoutCommand);
            this.facade.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.CLEAR_GAME_LAYOUT, mgs.aurora.modules.framesBuilder.controller.ClearGameLayoutCommand);
            return;
        }
    }
}


//          package model
//            package frameSets
//              class CreateControlXml
package mgs.aurora.modules.framesBuilder.model.frameSets 
{
    import mgs.aurora.common.enums.frame.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.modules.framesBuilder.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    
    public class CreateControlXml extends Object
    {
        public function CreateControlXml()
        {
            super();
            return;
        }

        public function getControlXML(arg1:XMLList, arg2:String, arg3:org.puremvc.as3.multicore.interfaces.IFacade):XMLList
        {
            var loc7:*=null;
            var loc8:*=null;
            var loc9:*=null;
            var loc10:*=null;
            var loc11:*=null;
            var loc12:*=null;
            var loc13:*=null;
            var loc14:*=null;
            var loc15:*=null;
            var loc16:*=null;
            var loc17:*=null;
            var loc18:*=null;
            var loc19:*=null;
            var loc20:*=null;
            var loc21:*=null;
            var loc22:*=null;
            var loc23:*=null;
            var loc24:*=null;
            var loc1:*=arg3.retrieveProxy(mgs.aurora.modules.framesBuilder.model.FramesProxy.NAME) as mgs.aurora.modules.framesBuilder.model.FramesProxy;
            var loc2:*=new XML("<controls/>");
            var loc3:*=0;
            while (loc3 < arg1.frame.button.length()) 
            {
                loc7 = arg1.frame.button[loc3].@regXPosition != undefined ? arg1.frame.button[loc3].@regXPosition.toString() : "";
                loc8 = arg1.frame.button[loc3].@regYPosition != undefined ? arg1.frame.button[loc3].@regYPosition.toString() : "";
                loc9 = arg1.frame.button[loc3].@theme.toString() != "true" ? arg1.frame.button[loc3].@type.toString() : arg1.frame.button[loc3].@type.toString() + arg2;
                loc10 = arg1.frame.button[loc3].@inactiveText != undefined ? arg1.frame.button[loc3].@inactiveText.toString() : "";
                loc11 = arg1.frame.button[loc3].@show != undefined ? arg1.frame.button[loc3].@show.toString() : "1";
                loc12 = arg1.frame.button[loc3].@evt.toString();
                if ((loc13 = arg1.frame.button[loc3].@state.toString()) == "" || loc13 == "null" || loc13 == "undefined" || loc13 == null) 
                {
                    if ((loc15 = loc1.currentFrame == null ? null : loc1.currentFrame.controls.buttons.getControl(this.changeSystemButtonNames(loc12))) != null) 
                    {
                        if (loc15.visible) 
                        {
                            loc11 = "1";
                        }
                        else 
                        {
                            loc11 = "0";
                        }
                        if (loc15.enabled) 
                        {
                            loc13 = "enableButtons";
                        }
                        else 
                        {
                            loc13 = "disableButtons";
                        }
                    }
                }
                loc14 = new XML("<ctrl id=\"" + loc12 + "\" type=\"button\" configId=\"" + ("Button" + loc9) + "\" shortCut=\"" + arg1.frame.button[loc3].@shortCut.toString() + "\" text=\"" + arg1.frame.button[loc3].@text.toString() + "\" inactiveText=\"" + loc10 + "\" regXPosition=\"" + loc7 + "\" regYPosition=\"" + loc8 + "\" evt=\"" + arg1.frame.button[loc3].@evt.toString() + "\" show=\"" + loc11 + "\" useHandCursor=\"" + arg1.frame.button[loc3].@useHandCursor.toString() + "\" width=\"" + arg1.frame.button[loc3].@width.toString() + "\" height=\"" + arg1.frame.button[loc3].@height.toString() + "\" tabIndex=\"\" excludeMethod=\"" + arg1.frame.@excludeMethod.toString() + "\" xpos=\"" + arg1.frame.button[loc3].@x.toString() + "\" ypos=\"" + arg1.frame.button[loc3].@y.toString() + "\" state=\"" + loc13 + "\"/>");
                loc2.appendChild(loc14);
                ++loc3;
            }
            var loc4:*=0;
            while (loc4 < arg1.frame.BETTEXT.length()) 
            {
                loc16 = arg1.frame.BETTEXT[loc4].@regYPosition != undefined ? arg1.frame.BETTEXT[loc4].@regYPosition.toString() : "";
                loc17 = arg1.frame.BETTEXT[loc4].@regXPosition != undefined ? arg1.frame.BETTEXT[loc4].@regXPosition.toString() : "";
                loc18 = arg1.frame.BETTEXT[loc4].@text != undefined ? arg1.frame.BETTEXT[loc4].@text.toString() : "";
                loc19 = new XML("<ctrl id=\"" + arg1.frame.BETTEXT[loc4].@id.toString() + "\" type=\"bettext\" text=\"" + loc18 + "\" regXPosition=\"" + loc17 + "\" regYPosition=\"" + loc16 + "\" xpos=\"" + arg1.frame.BETTEXT[loc4].@x.toString() + "\" ypos=\"" + arg1.frame.BETTEXT[loc4].@y.toString() + "\" state=\"" + arg1.frame.BETTEXT[loc4].@state.toString() + "\"/>");
                loc2.appendChild(loc19);
                ++loc4;
            }
            var loc5:*=0;
            while (loc5 < arg1.frame.BETINFO.length()) 
            {
                loc20 = arg1.frame.BETINFO[loc5].@regXPosition != undefined ? arg1.frame.BETINFO[loc5].@regXPosition.toString() : "";
                loc21 = arg1.frame.BETINFO[loc5].@regYPosition != undefined ? arg1.frame.BETINFO[loc5].@regYPosition.toString() : "";
                loc22 = arg1.frame.BETINFO[loc5].@text != undefined ? arg1.frame.BETINFO[loc5].@text.toString() : "";
                loc23 = new XML("<ctrl id=\"" + arg1.frame.BETINFO[loc5].@id.toString() + "\" type=\"betinfo\" text=\"" + loc22 + "\" regXPosition=\"" + loc20 + "\" regYPosition=\"" + loc21 + "\" xpos=\"" + arg1.frame.BETINFO[loc5].@x.toString() + "\" ypos=\"" + arg1.frame.BETINFO[loc5].@y.toString() + "\" state=\"" + arg1.frame.BETINFO[loc5].@state.toString() + "\"/>");
                loc2.appendChild(loc23);
                ++loc5;
            }
            var loc6:*=0;
            while (loc6 < arg1.frame.SEPARATOR.length()) 
            {
                loc24 = new XML("<ctrl id=\"" + arg1.frame.SEPARATOR[loc6].@id.toString() + "\" type=\"graphic\" graphicType=\"SEPARATOR\" linkage=\"" + (arg1.frame.SEPARATOR[loc6].@type.toString() + arg2) + "\" xpos=\"" + arg1.frame.SEPARATOR[loc6].@x.toString() + "\" ypos=\"" + arg1.frame.SEPARATOR[loc6].@y.toString() + "\" state=\"" + arg1.frame.SEPARATOR[loc6].@state.toString() + "\"/>");
                loc2.appendChild(loc24);
                ++loc6;
            }
            return loc2.ctrl;
        }

        internal function changeSystemButtonNames(arg1:String):String
        {
            var loc1:*=arg1.toUpperCase();
            switch (loc1) 
            {
                case "EXPERT":
                {
                    return mgs.aurora.common.enums.frame.SystemButtonTypes.EXPERT;
                }
                case "REGULAR":
                {
                    return mgs.aurora.common.enums.frame.SystemButtonTypes.REGULAR;
                }
                case "BANK":
                {
                    return mgs.aurora.common.enums.frame.SystemButtonTypes.BANK;
                }
                case "CONNECT":
                {
                    return mgs.aurora.common.enums.frame.SystemButtonTypes.CONNECT;
                }
                case "DISCONNECT":
                {
                    return mgs.aurora.common.enums.frame.SystemButtonTypes.DISCONNECT;
                }
                case "EXIT":
                {
                    return mgs.aurora.common.enums.frame.SystemButtonTypes.EXIT;
                }
                case "HELP":
                {
                    return mgs.aurora.common.enums.frame.SystemButtonTypes.HELP;
                }
                case "OPTIONS":
                {
                    return mgs.aurora.common.enums.frame.SystemButtonTypes.OPTIONS;
                }
                case "PLAYFORREAL":
                {
                    return mgs.aurora.common.enums.frame.SystemButtonTypes.PLAYFORREAL;
                }
                case "STATS":
                {
                    return mgs.aurora.common.enums.frame.SystemButtonTypes.STATS;
                }
                default:
                {
                    return arg1;
                }
            }
        }
    }
}


//            package frames
//              package controls
//                package buttons
//                  class BalanceButton
package mgs.aurora.modules.framesBuilder.model.frames.controls.buttons 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.enums.frame.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.common.utilities.*;
    
    public class BalanceButton extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.frames.frame.assets.IBalanceButton
    {
        public function BalanceButton(arg1:flash.display.MovieClip)
        {
            super();
            this._balanceButton = arg1;
            if (this._balanceButton != null) 
            {
                this.addListeners();
            }
            return;
        }

        internal function addListeners():void
        {
            mgs.aurora.common.utilities.EventUtils.addMouseEventsToSingleMethod(this._balanceButton, this.onEvent);
            return;
        }

        internal function removeListeners():void
        {
            mgs.aurora.common.utilities.EventUtils.removeMouseEventsFromSingleMethod(this._balanceButton, this.onEvent);
            return;
        }

        internal function onEvent(arg1:flash.events.MouseEvent):void
        {
            if (this.locked) 
            {
                return;
            }
            this.dispatchEvent(mgs.aurora.common.utilities.EventUtils.nativeMouseEventToSystemMouseEvent(arg1, this.id));
            return;
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return null;
        }

        public function get filters():Array
        {
            return new Array();
        }

        public function set filters(arg1:Array):void
        {
            return;
        }

        public function get alpha():Number
        {
            return 100;
        }

        public function set alpha(arg1:Number):void
        {
            return;
        }

        public function get balanceButton():flash.display.InteractiveObject
        {
            return this._balanceButton as flash.display.InteractiveObject;
        }

        public function set balanceButton(arg1:flash.display.InteractiveObject):void
        {
            this._balanceButton = arg1 as flash.display.MovieClip;
            return;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            arg1.addChild(this._balanceButton);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            arg1.addChildAt(this._balanceButton, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            this._balanceButton.parent.removeChild(this._balanceButton);
            return;
        }

        public function get x():Number
        {
            return this._balanceButton.x;
        }

        public function set x(arg1:Number):void
        {
            this._balanceButton.x = arg1;
            return;
        }

        public function get y():Number
        {
            return this._balanceButton.y;
        }

        public function set y(arg1:Number):void
        {
            this._balanceButton.y = arg1;
            return;
        }

        public function get width():Number
        {
            return this._balanceButton.width;
        }

        public function set width(arg1:Number):void
        {
            this._balanceButton.width = arg1;
            return;
        }

        public function get height():Number
        {
            return this._balanceButton.height;
        }

        public function set height(arg1:Number):void
        {
            this._balanceButton.height = arg1;
            return;
        }

        public function get locked():Boolean
        {
            return this._locked;
        }

        public function set locked(arg1:Boolean):void
        {
            this._locked = arg1;
            return;
        }

        public function get id():String
        {
            return mgs.aurora.common.enums.frame.ControlIdentifiers.BALANCEBUTTON;
        }

        public function set id(arg1:String):void
        {
            return;
        }

        public function get type():String
        {
            return this.TYPE;
        }

        public function get enabled():Boolean
        {
            return this._balanceButton.enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            this._balanceButton.enabled = arg1;
            this._locked = !arg1;
            return;
        }

        public function get visible():Boolean
        {
            return this._balanceButton.visible;
        }

        public function set visible(arg1:Boolean):void
        {
            this._balanceButton.visible = arg1;
            return;
        }

        public function get hitTest():Boolean
        {
            return mgs.aurora.common.utilities.GraphicsUtils.hitTestMouse(this._balanceButton);
        }

        public function dispose():void
        {
            this.removeListeners();
            return;
        }

        public function get text():String
        {
            return "";
        }

        public function set text(arg1:String):void
        {
            return;
        }

        public const TYPE:String="Button";

        internal var _balanceButton:flash.display.MovieClip;

        internal var _locked:Boolean=false;
    }
}


//                  class ButtonControl
package mgs.aurora.modules.framesBuilder.model.frames.controls.buttons 
{
    import flash.display.*;
    import flash.events.*;
    import flash.text.*;
    import flash.utils.*;
    import mgs.aurora.common.enums.frame.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    
    public class ButtonControl extends Object implements mgs.aurora.common.interfaces.controls.IButton, mgs.aurora.common.interfaces.controls.ICustomControl
    {
        public function ButtonControl(arg1:flash.display.MovieClip)
        {
            super();
            this._displayObject = arg1;
            this._eventDispatcher = new flash.events.EventDispatcher();
            this._statesMovieDictionary = new flash.utils.Dictionary();
            this.enabled = true;
            if (this._displayObject.stage) 
            {
                this.init();
            }
            else 
            {
                this._displayObject.addEventListener(flash.events.Event.ADDED_TO_STAGE, this.init);
            }
            return;
        }

        public function set inactiveText(arg1:String):void
        {
            this._inactiveText = arg1;
            return;
        }

        public function get bctextField():flash.text.TextField
        {
            return this._textField;
        }

        public function set bctextField(arg1:flash.text.TextField):void
        {
            this._textField = arg1;
            return;
        }

        public function get frameExcludeMethod():String
        {
            return this._frameExcludeMethod;
        }

        public function set frameExcludeMethod(arg1:String):void
        {
            this._frameExcludeMethod = mgs.aurora.common.enums.frame.ExcludeMethodTypes[arg1.toUpperCase()];
            return;
        }

        public function get excluded():Boolean
        {
            return this._excluded;
        }

        public function set excluded(arg1:Boolean):void
        {
            this._excluded = arg1;
            return;
        }

        public function get textField():mgs.aurora.common.interfaces.controls.IText
        {
            return null;
        }

        public function setState(arg1:String):void
        {
            return;
        }

        public function dispose():void
        {
            return;
        }

        public function drawButton(arg1:XML, arg2:XML, arg3:XML, arg4:XML, arg5:XML, arg6:XMLList, arg7:flash.display.LoaderInfo):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            this.bctextField = new flash.text.TextField();
            this.setupTextFormats(arg3, arg4);
            this._textField.defaultTextFormat = this._enabledTextFormat;
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(arg5, this._textField);
            this._isHtmlText = arg5.@html == "true";
            this._textField.autoSize = flash.text.TextFieldAutoSize.LEFT;
            if (this._isHtmlText) 
            {
                this.bctextField.htmlText = this._text;
            }
            else 
            {
                this.bctextField.text = this._text;
            }
            this._textField.setTextFormat(this._enabledTextFormat);
            this._regXPosition = arg1.@regXPosition != undefined ? arg1.@regXPosition : "";
            this._regYPosition = arg1.@regYPosition != undefined ? arg1.@regYPosition : "";
            if (arg1.@useHandCursor != "") 
            {
                var loc5:*;
                this._displayObject.useHandCursor = loc5 = mgs.aurora.common.utilities.StringUtils.stringToBoolean(arg1.@useHandCursor);
                this._displayObject.buttonMode = loc5 = loc5;
                this._useHandCursor = loc5;
            }
            if (arg1.@width != "") 
            {
                arg2.@width = arg1.@width;
            }
            if (arg1.@height != "") 
            {
                arg2.@height = arg1.@height;
            }
            var loc1:*=0;
            loc5 = 0;
            var loc6:*=arg2.layer;
            for each (loc2 in loc6) 
            {
                (loc3 = mgs.aurora.common.utilities.GraphicsUtils.getMovieClipFromLibrary(loc2.@linkage, arg7)).name = loc2.@linkage;
                this.setSizeAndPosition(arg2, loc3, loc1);
                if (mgs.aurora.common.utilities.StringUtils.stringToBoolean(loc2.@hasStates)) 
                {
                    this._statesMovieDictionary[loc2.@linkage] = loc3;
                    if (!this._displayObject.enabled) 
                    {
                        loc3.gotoAndStop(INACTIVE);
                    }
                }
                this._displayObject.addChild(loc3);
                ++loc1;
            }
            this.xOffSet = Number(arg2.@xOffset);
            this.yOffset = Number(arg2.@yOffset);
            this.leftMargin = Number(arg4.@leftMargin);
            this.textalignment = arg4.@align.toLowerCase();
            if (this.textalignment != "left") 
            {
                if (this.bctextField.width > this._displayObject.width && this._displayObject.height > this.bctextField.height * 2) 
                {
                    this.bctextField.multiline = true;
                    this.bctextField.wordWrap = true;
                    this.bctextField.width = this._displayObject.width - this.xOffSet;
                    this.bctextField.height = this.bctextField.textHeight;
                }
                this.bctextField.x = (this._displayObject.width - this.bctextField.width) / 2 + this.xOffSet;
                this.bctextField.y = (this._displayObject.height - this.bctextField.height) / 2 + this.yOffset;
            }
            else 
            {
                this.bctextField.x = this.leftMargin + this.xOffSet;
                this.bctextField.y = (this._displayObject.height - this.bctextField.height) / 2 + this.yOffset;
            }
            if (this._text == "") 
            {
                this.bctextField.mouseEnabled = false;
                this.bctextField.visible = false;
                this.bctextField.width = 0;
            }
            this.bctextField = this._displayObject.addChild(this.bctextField) as flash.text.TextField;
            if (mgs.aurora.common.utilities.StringUtils.stringToBoolean(arg2.@autoResizeToText)) 
            {
                loc5 = 0;
                loc6 = this._statesMovieDictionary;
                for each (loc4 in loc6) 
                {
                    loc4.width = this.bctextField.width + this.leftMargin;
                    loc4.x = loc4.x + (this.bctextField.x - (loc4.width - this.bctextField.width) / 2);
                }
            }
            return;
        }

        public function get height():Number
        {
            return this._displayObject.height;
        }

        internal function setText(arg1:String):void
        {
            var loc1:*=NaN;
            var loc2:*=NaN;
            if (this.bctextField != null) 
            {
                if (arg1 == "") 
                {
                    this.bctextField.mouseEnabled = false;
                    this.bctextField.visible = false;
                    return;
                }
                loc1 = this._displayObject.width;
                loc2 = this._displayObject.height;
                if (this._isHtmlText) 
                {
                    this.bctextField.htmlText = arg1;
                }
                else 
                {
                    this.bctextField.text = arg1;
                }
                this.bctextField.visible = true;
                if (this.textalignment != "left") 
                {
                    if (this.bctextField.width > loc1 && loc2 > this.bctextField.height * 2) 
                    {
                        this.bctextField.multiline = true;
                        this.bctextField.wordWrap = true;
                        this.bctextField.width = loc1 - this.xOffSet;
                        this.bctextField.height = this.bctextField.textHeight;
                    }
                    this.bctextField.x = (loc1 - this.bctextField.width) / 2 + this.xOffSet;
                    this.bctextField.y = (loc2 - this.bctextField.height) / 2 + this.yOffset;
                }
                else 
                {
                    this.bctextField.x = this.leftMargin + this.xOffSet;
                    this.bctextField.y = this.yOffset;
                }
            }
            return;
        }

        internal function setSizeAndPosition(arg1:XML, arg2:flash.display.MovieClip, arg3:int):void
        {
            var loc1:*=NaN;
            var loc2:*=NaN;
            if (arg3 != 0) 
            {
                if (arg1.layer[arg3].@padding == undefined) 
                {
                    if (!(arg1.@xScale == 100) && !(arg1.@xScale == undefined)) 
                    {
                        arg2.scaleX = arg2.xScale;
                    }
                    else 
                    {
                        arg2.width = arg2.width <= 0 ? arg1.@width : arg2.width;
                    }
                }
                else 
                {
                    arg2.width = this._displayObject.width - arg1.layer[arg3].@padding * 2;
                }
                if (arg1.layer[arg3].@padding == undefined) 
                {
                    if (!(arg1.@yScale == 100) && !(arg1.@yScale == undefined)) 
                    {
                        arg2.scaleY = arg1.@yScale;
                    }
                    else 
                    {
                        arg2.height = arg1.@height <= 0 ? arg1.@height : arg2.height;
                    }
                }
                else 
                {
                    arg2.height = this._displayObject.height - arg1.layer[arg3].@padding * 2;
                }
                loc1 = 0;
                loc2 = 0;
                var loc3:*=String(arg1.layer[arg3].@align).toLowerCase();
                switch (loc3) 
                {
                    case "right":
                    {
                        loc1 = loc1 + (this._displayObject.width - arg2.width - (arg1.layer[arg3].@padding > -1 ? arg1.layer[arg3].@padding : 0));
                        break;
                    }
                    case "center":
                    {
                        loc1 = loc1 + (this._displayObject.width - arg2.width) / 2;
                        break;
                    }
                    case "exact":
                    {
                        loc1 = loc1 + arg1.layer[arg3].@x;
                        break;
                    }
                    case "left":
                    default:
                    {
                        loc1 = loc1 + (arg1.layer[arg3].@padding == undefined ? arg1.@x : arg1.layer[arg3].@padding);
                    }
                }
                loc3 = String(arg1.layer[arg3].@valign).toLowerCase();
                switch (loc3) 
                {
                    case "bottom":
                    {
                        loc2 = loc2 + (this._displayObject.height - arg2.height - (arg1.layer[arg3].@padding > -1 ? arg1.layer[arg3].@padding : 0));
                        break;
                    }
                    case "middle":
                    {
                        loc2 = loc2 + (this._displayObject.height - arg2.height) / 2;
                        break;
                    }
                    case "top":
                    default:
                    {
                        loc2 = loc2 + (arg1.layer[arg3].@padding == undefined ? arg1.@y : arg1.layer[arg3].@padding);
                    }
                }
                arg2.x = loc1;
                arg2.y = loc2;
            }
            else 
            {
                if (arg1.@width != undefined) 
                {
                    arg2.width = arg1.@width;
                }
                if (arg1.@height != undefined) 
                {
                    arg2.height = arg1.@height;
                }
            }
            return;
        }

        internal function init(arg1:flash.events.Event=null):void
        {
            this._displayObject.removeEventListener(flash.events.Event.ADDED_TO_STAGE, this.init);
            this._displayObject.addEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.remove);
            this._displayObject.addEventListener(flash.events.MouseEvent.MOUSE_DOWN, this.onMouseEventMouseDown);
            this._displayObject.addEventListener(flash.events.MouseEvent.MOUSE_UP, this.onMouseEventMouseUp);
            this._displayObject.addEventListener(flash.events.MouseEvent.MOUSE_MOVE, this.onMouseEventMouseMove);
            this._displayObject.addEventListener(flash.events.MouseEvent.ROLL_OUT, this.onMouseEventMouseOut);
            this._displayObject.addEventListener(flash.events.MouseEvent.ROLL_OVER, this.onMouseEventMouseOver);
            this._displayObject.addEventListener(flash.events.MouseEvent.MOUSE_WHEEL, this.onMouseEventMouseWheel);
            this._displayObject.stage.addEventListener(flash.events.KeyboardEvent.KEY_UP, this.onKeyUp);
            this._displayObject.stage.addEventListener(flash.events.KeyboardEvent.KEY_DOWN, this.onKeyDown);
            return;
        }

        internal function remove(arg1:flash.events.Event):void
        {
            this._displayObject.removeEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.remove);
            this._displayObject.removeEventListener(flash.events.MouseEvent.MOUSE_DOWN, this.onMouseEventMouseDown);
            this._displayObject.removeEventListener(flash.events.MouseEvent.MOUSE_UP, this.onMouseEventMouseUp);
            this._displayObject.removeEventListener(flash.events.MouseEvent.MOUSE_MOVE, this.onMouseEventMouseMove);
            this._displayObject.removeEventListener(flash.events.MouseEvent.ROLL_OVER, this.onMouseEventMouseOver);
            this._displayObject.removeEventListener(flash.events.MouseEvent.ROLL_OUT, this.onMouseEventMouseUp);
            this._displayObject.removeEventListener(flash.events.MouseEvent.MOUSE_WHEEL, this.onMouseEventMouseWheel);
            this._displayObject.stage.removeEventListener(flash.events.KeyboardEvent.KEY_UP, this.onKeyUp);
            this._displayObject.stage.removeEventListener(flash.events.KeyboardEvent.KEY_DOWN, this.onKeyDown);
            this._id = null;
            this._displayObject = null;
            this._eventDispatcher = null;
            return;
        }

        internal function setupTextFormats(arg1:XML, arg2:XML):void
        {
            var loc2:*=null;
            this._enabledTextFormat = new flash.text.TextFormat();
            this._disabledTextFormat = new flash.text.TextFormat();
            this._overTextFormat = new flash.text.TextFormat();
            this._pressedTextFormat = new flash.text.TextFormat();
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(arg2, this._enabledTextFormat);
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(arg2, this._disabledTextFormat);
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(arg2, this._overTextFormat);
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(arg2, this._pressedTextFormat);
            var loc1:*=arg2.children();
            var loc3:*=0;
            var loc4:*=loc1;
            for each (loc2 in loc4) 
            {
                if (loc2.disabled != undefined) 
                {
                    if (loc2.disabled.hasOwnProperty("@alpha")) 
                    {
                        this._disableAlphaColor = Number(loc2.disabled.@alpha) / 100;
                    }
                    mgs.aurora.common.utilities.ObjectUtils.updateFromXML(new XML(loc2.disabled), this._disabledTextFormat);
                }
                if (loc2.press != undefined) 
                {
                    mgs.aurora.common.utilities.ObjectUtils.updateFromXML(new XML(loc2.press), this._pressedTextFormat);
                }
                if (loc2.over == undefined) 
                {
                    continue;
                }
                mgs.aurora.common.utilities.ObjectUtils.updateFromXML(new XML(loc2.over), this._overTextFormat);
            }
            return;
        }

        internal function updateChildGraphics(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._statesMovieDictionary;
            for each (loc1 in loc3) 
            {
                loc1.gotoAndStop(arg1);
            }
            loc2 = arg1;
            switch (loc2) 
            {
                case ACTIVE:
                {
                    if (!(this.bctextField == null) && !(this.text == "")) 
                    {
                        this._textField.visible = true;
                        this.bctextField.alpha = 1;
                    }
                    if (this._enabledTextFormat != null) 
                    {
                        this.bctextField.setTextFormat(this._enabledTextFormat);
                    }
                    if (this._useHandCursor) 
                    {
                        this._displayObject.useHandCursor = loc2 = true;
                        this._displayObject.buttonMode = loc2;
                    }
                    if (this.inactiveText != "") 
                    {
                        this.text = this._text;
                    }
                    break;
                }
                case HIDDEN:
                {
                    if (this.bctextField != null) 
                    {
                        this.bctextField.visible = false;
                    }
                    break;
                }
                case DOWN:
                {
                    if (this._pressedTextFormat != null) 
                    {
                        this.bctextField.setTextFormat(this._pressedTextFormat);
                    }
                    break;
                }
                case OVER:
                {
                    if (this._overTextFormat != null) 
                    {
                        this.bctextField.setTextFormat(this._overTextFormat);
                    }
                    break;
                }
                case INACTIVE:
                {
                    if (!(this.bctextField == null) && !(this.text == "")) 
                    {
                        this._textField.visible = true;
                        this.bctextField.setTextFormat(this._disabledTextFormat);
                        this.bctextField.alpha = this._disableAlphaColor;
                    }
                    if (this._useHandCursor) 
                    {
                        this._displayObject.useHandCursor = loc2 = false;
                        this._displayObject.buttonMode = loc2;
                    }
                    if (this.inactiveText != "") 
                    {
                        this.setText(this.inactiveText);
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

        internal function onMouseEventMouseDown(arg1:flash.events.MouseEvent):void
        {
            if (this.locked || this.excluded || !this.enabled) 
            {
                return;
            }
            this.updateChildGraphics(DOWN);
            this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, this.id, arg1));
            return;
        }

        internal function onMouseEventMouseOver(arg1:flash.events.MouseEvent):void
        {
            if (this.locked || this.excluded || !this.enabled) 
            {
                return;
            }
            this.updateChildGraphics(OVER);
            this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, this.id, arg1));
            return;
        }

        internal function onMouseEventMouseUp(arg1:flash.events.MouseEvent):void
        {
            if (this.locked || this.excluded || !this.enabled) 
            {
                return;
            }
            this.updateChildGraphics(OVER);
            this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, this.id, arg1));
            this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.CLICK, this.id, arg1));
            return;
        }

        internal function onMouseEventDoubleClick(arg1:flash.events.MouseEvent):void
        {
            if (this.locked || this.excluded || !this.enabled) 
            {
                return;
            }
            this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.DOUBLE_CLICK, this.id, arg1));
            return;
        }

        internal function onMouseEventMouseMove(arg1:flash.events.MouseEvent):void
        {
            if (this.locked || this.excluded || !this.enabled) 
            {
                return;
            }
            this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_MOVE, this.id, arg1));
            return;
        }

        internal function onMouseEventMouseWheel(arg1:flash.events.MouseEvent):void
        {
            if (this.locked || this.excluded || !this.enabled) 
            {
                return;
            }
            this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_WHEEL, this.id, arg1));
            return;
        }

        internal function onKeyUp(arg1:flash.events.KeyboardEvent):void
        {
            if (this.locked || this.excluded || !this.enabled) 
            {
                return;
            }
            if (arg1.keyCode == this.shortCutKey) 
            {
                this.updateChildGraphics(OVER);
                this.dispatchEvent(new mgs.aurora.common.events.SystemKeyboardEvent(mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP, this.id, arg1));
            }
            return;
        }

        internal function onKeyDown(arg1:flash.events.KeyboardEvent):void
        {
            if (this.locked || this.excluded || !this.enabled) 
            {
                return;
            }
            if (arg1.keyCode == this.shortCutKey) 
            {
                this.dispatchEvent(new mgs.aurora.common.events.SystemKeyboardEvent(mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN, this.id, arg1));
            }
            return;
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return this._displayObject;
        }

        public function get filters():Array
        {
            return new Array();
        }

        public function set filters(arg1:Array):void
        {
            return;
        }

        public function get alpha():Number
        {
            return 100;
        }

        public function set alpha(arg1:Number):void
        {
            return;
        }

        public function set shortCutKey(arg1:uint):void
        {
            this._shortCutKey = arg1;
            return;
        }

        public function get shortCutKey():uint
        {
            return this._shortCutKey;
        }

        public function get id():String
        {
            return this._id;
        }

        public function set id(arg1:String):void
        {
            this._displayObject.name = arg1;
            this._id = arg1;
            return;
        }

        public function get type():String
        {
            return this._type;
        }

        public function set type(arg1:String):void
        {
            this._type = arg1;
            return;
        }

        public function get enabled():Boolean
        {
            if (this._id == null || this._displayObject == null) 
            {
                return false;
            }
            return this._displayObject.enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            if (!this.visible || this.excluded) 
            {
                return;
            }
            if (arg1) 
            {
                this.updateChildGraphics(ACTIVE);
            }
            else 
            {
                this.updateChildGraphics(INACTIVE);
            }
            this._displayObject.enabled = arg1;
            this.locked = !this._displayObject.enabled;
            return;
        }

        public function get visible():Boolean
        {
            return this._displayObject.visible;
        }

        public function set visible(arg1:Boolean):void
        {
            if (this.excluded) 
            {
                return;
            }
            if (arg1) 
            {
                this.updateChildGraphics(this.enabled ? ACTIVE : INACTIVE);
            }
            else 
            {
                this.updateChildGraphics(HIDDEN);
            }
            this._displayObject.visible = arg1;
            return;
        }

        public function get x():Number
        {
            return this._displayObject.x;
        }

        public function set x(arg1:Number):void
        {
            this._displayObject.x = arg1;
            var loc1:*=this._regXPosition;
            switch (loc1) 
            {
                case "right":
                {
                    this._displayObject.x = this._displayObject.x - this._displayObject.width;
                    break;
                }
                case "center":
                {
                    this._displayObject.x = this._displayObject.x - this._displayObject.width / 2;
                    break;
                }
                case "left":
                default:
                {
                    break;
                }
            }
            return;
        }

        public function get y():Number
        {
            return this._displayObject.y;
        }

        public function set y(arg1:Number):void
        {
            this._displayObject.y = arg1;
            var loc1:*=this._regYPosition;
            switch (loc1) 
            {
                case "bottom":
                {
                    this._displayObject.y = this._displayObject.y - this._displayObject.height;
                    break;
                }
                case "middle":
                {
                    this._displayObject.y = this._displayObject.y - this._displayObject.height / 2;
                    break;
                }
                case "top":
                default:
                {
                    break;
                }
            }
            return;
        }

        public function get width():Number
        {
            return this._displayObject.width;
        }

        public function set width(arg1:Number):void
        {
            this._displayObject.width = arg1;
            return;
        }

        internal function onMouseEventMouseOut(arg1:flash.events.MouseEvent):void
        {
            if (this.locked || this.excluded || !this.enabled) 
            {
                return;
            }
            this.updateChildGraphics(ACTIVE);
            this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, this.id, arg1));
            return;
        }

        public function set height(arg1:Number):void
        {
            this._displayObject.height = arg1;
            return;
        }

        public function get locked():Boolean
        {
            return this._locked;
        }

        public function set locked(arg1:Boolean):void
        {
            this._locked = arg1;
            return;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            arg1.addChild(this._displayObject);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            arg1.addChildAt(this._displayObject, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            this._displayObject.parent.removeChild(this._displayObject);
            return;
        }

        public function get tabIndex():int
        {
            return this._tabIndex;
        }

        public function set tabIndex(arg1:int):void
        {
            this._tabIndex = arg1;
            return;
        }

        public function get hitTest():Boolean
        {
            return mgs.aurora.common.utilities.GraphicsUtils.hitTestMouse(this._displayObject);
        }

        public function addEventListener(arg1:String, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            this._eventDispatcher.addEventListener(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public function removeEventListener(arg1:String, arg2:Function, arg3:Boolean=false):void
        {
            this._eventDispatcher.removeEventListener(arg1, arg2, arg3);
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

        public function willTrigger(arg1:String):Boolean
        {
            return this._eventDispatcher.willTrigger(arg1);
        }

        public function get text():String
        {
            return this._text;
        }

        public function set text(arg1:String):void
        {
            this._text = arg1;
            this.setText(arg1);
            return;
        }

        public function get inactiveText():String
        {
            return this._inactiveText;
        }

        internal static const INACTIVE:String="Inactive";

        internal static const ACTIVE:String="Active";

        internal static const DOWN:String="Depressed";

        internal static const OVER:String="Over";

        internal static const HIDDEN:String="Hidden";

        internal var _id:String;

        internal var _type:String;

        internal var _displayObject:flash.display.MovieClip;

        internal var _text:String;

        internal var _inactiveText:String;

        internal var _shortCutKey:uint;

        internal var _eventDispatcher:flash.events.EventDispatcher;

        internal var _textField:flash.text.TextField;

        internal var _locked:Boolean;

        internal var _tabIndex:int;

        internal var _enabledTextFormat:flash.text.TextFormat;

        internal var _pressedTextFormat:flash.text.TextFormat;

        internal var _overTextFormat:flash.text.TextFormat;

        internal var _statesMovieDictionary:flash.utils.Dictionary;

        internal var _useHandCursor:Boolean;

        internal var _frameExcludeMethod:String;

        internal var _excluded:Boolean=false;

        internal var _disableAlphaColor:Number=0.4;

        internal var xOffSet:Number;

        internal var yOffset:Number;

        internal var leftMargin:Number;

        internal var textalignment:String;

        internal var _regXPosition:String="";

        internal var _regYPosition:String="";

        internal var _isHtmlText:Boolean=false;

        internal var _disabledTextFormat:flash.text.TextFormat;
    }
}


//                  class ButtonGroup
package mgs.aurora.modules.framesBuilder.model.frames.controls.buttons 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class ButtonGroup extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IControlGroup
    {
        public function ButtonGroup(arg1:String, arg2:mgs.aurora.common.interfaces.controls.IControlManager)
        {
            super();
            this._id = arg1;
            this._controlManager = arg2;
            this._buttonList = new flash.utils.Dictionary();
            return;
        }

        public function linkToGroup(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (!this._buttonList.hasOwnProperty(loc1[loc3])) 
                {
                    this._buttonList[loc1[loc3]] = loc1[loc3];
                    this.addControlListeners(this._controlManager.getControl(loc1[loc3]));
                }
                ++loc3;
            }
            return;
        }

        public function unlinkFromGroup(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._buttonList.hasOwnProperty(loc1[loc3])) 
                {
                    this.removeControlListeners(this._controlManager.getControl(loc1[loc3]));
                    delete this._buttonList[loc1[loc3]];
                }
                ++loc3;
            }
            return;
        }

        public function hasControls(arg1:String):Boolean
        {
            var loc1:*="";
            var loc2:*=arg1.split(",");
            var loc3:*=loc2.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (this._buttonList.hasOwnProperty(loc2[loc4])) 
                {
                    loc1 = loc1 + (loc2[loc4] + ",");
                }
                ++loc4;
            }
            return arg1 == loc1.slice(0, (loc1.length - 1));
        }

        public function get disabledList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._buttonList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (loc3.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get enabledList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._buttonList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (!loc3.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get hiddenList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._buttonList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (loc3.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get visibleList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._buttonList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (!loc3.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get id():String
        {
            return this._id;
        }

        public function getControl(arg1:String):mgs.aurora.common.interfaces.controls.IControl
        {
            return this._controlManager.getControl(arg1);
        }

        public function showAllControls():void
        {
            this._controlManager.showControls(this.getAllControlIds());
            return;
        }

        public function showControls(arg1:String):void
        {
            this._controlManager.showControls(arg1);
            return;
        }

        public function disableAllControls():void
        {
            this._controlManager.disableControls(this.getAllControlIds());
            return;
        }

        public function disableControls(arg1:String):void
        {
            this._controlManager.disableControls(arg1);
            return;
        }

        public function enableAllControls():void
        {
            this._controlManager.enableControls(this.getAllControlIds());
            return;
        }

        public function enableControls(arg1:String):void
        {
            this._controlManager.enableControls(arg1);
            return;
        }

        public function hideAllControls():void
        {
            this._controlManager.hideControls(this.getAllControlIds());
            return;
        }

        public function hideControls(arg1:String):void
        {
            this._controlManager.hideControls(arg1);
            return;
        }

        public function getAllControlIds():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._buttonList;
            for each (loc2 in loc4) 
            {
                loc1 = loc1 + (loc2 + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        internal function addControlListeners(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.CLICK, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.DOUBLE_CLICK, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_MOVE, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_WHEEL, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OUT, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OVER, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN, this.onControlEvent);
            return;
        }

        internal function removeControlListeners(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.CLICK, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.DOUBLE_CLICK, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_MOVE, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_WHEEL, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OUT, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OVER, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN, this.onControlEvent);
            return;
        }

        internal function onControlEvent(arg1:*):void
        {
            if (super.hasEventListener(arg1.type)) 
            {
                super.dispatchEvent(arg1.clone());
            }
            return;
        }

        internal var _buttonList:flash.utils.Dictionary;

        internal var _controlManager:mgs.aurora.common.interfaces.controls.IControlManager;

        internal var _id:String;
    }
}


//                  class ButtonManager
package mgs.aurora.modules.framesBuilder.model.frames.controls.buttons 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class ButtonManager extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IControlManager
    {
        public function ButtonManager()
        {
            super();
            this._groupList = new flash.utils.Dictionary();
            this._buttonRefs = new flash.utils.Dictionary();
            this._lockedStateHistory = new flash.utils.Dictionary();
            this._allControlsLocked = false;
            return;
        }

        public function changeControl(arg1:String, arg2:String, arg3:String=""):void
        {
            var loc1:*;
            if ((loc1 = mgs.aurora.common.interfaces.controls.ICustomControl(this._buttonRefs[arg1])) != null) 
            {
                if (!(arg3 == "undefined") && !(arg3 == "null")) 
                {
                    loc1.text = arg3;
                }
                if (!(arg1.toLowerCase() == arg2.toLowerCase()) && !(arg2 == "null") && !(arg2 == "undefined") && !(arg2 == null)) 
                {
                    this.unLinkFromAllGroups(arg1);
                    loc1.id = arg2;
                    this._buttonRefs[arg2] = loc1;
                    this.linkControlsToGroups(arg2, "GAME_FRAME");
                    delete this._buttonRefs[arg1];
                }
            }
            return;
        }

        internal function unLinkFromAllGroups(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._groupList;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.unlinkFromGroup(arg1);
            }
            return;
        }

        internal function addControlListeners(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.CLICK, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.DOUBLE_CLICK, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_MOVE, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_WHEEL, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OUT, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OVER, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN, this.onControlEvent);
            return;
        }

        internal function removeControlListeners(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.CLICK, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.DOUBLE_CLICK, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_MOVE, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_WHEEL, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OUT, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OVER, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN, this.onControlEvent);
            return;
        }

        internal function onControlEvent(arg1:*):void
        {
            if (super.hasEventListener(arg1.type)) 
            {
                super.dispatchEvent(arg1.clone());
            }
            return;
        }

        public function addControl(arg1:mgs.aurora.common.interfaces.controls.ICustomControl, arg2:flash.display.DisplayObjectContainer, arg3:String=null):void
        {
            var loc1:*=null;
            if (this._buttonRefs.hasOwnProperty(arg1.id)) 
            {
                Debugger.trace("ButtonManager :: addControl - \"" + arg1.id + "\" already exists in list", "SYSTEM - Frames Error");
                return;
            }
            this._buttonRefs[arg1.id] = arg1;
            if (arg3 != null) 
            {
                var loc2:*=0;
                var loc3:*=arg3.split(",");
                for each (loc1 in loc3) 
                {
                    if (!this._groupList.hasOwnProperty(loc1)) 
                    {
                        this.createGroups(loc1);
                    }
                    mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonGroup(this._groupList[loc1]).linkToGroup(arg1.id);
                }
            }
            arg1.locked = this._allControlsLocked;
            arg1.addToContainer(arg2);
            this.addControlListeners(arg1);
            return;
        }

        public function addControls(arg1:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.ICustomControl>, arg2:flash.display.DisplayObjectContainer, arg3:String=null):void
        {
            var loc1:*=arg1.length;
            var loc2:*=0;
            while (loc2 < loc1) 
            {
                this.addControl(arg1[loc2], arg2, arg3);
                ++loc2;
            }
            return;
        }

        public function hasControls(arg1:String):Boolean
        {
            var loc1:*="";
            var loc2:*=arg1.split(",");
            var loc3:*=loc2.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (this._buttonRefs.hasOwnProperty(loc2[loc4]) || !(this.systemButtons.getControl(loc2[loc4]) == null)) 
                {
                    loc1 = loc1 + (loc2[loc4] + ",");
                }
                ++loc4;
            }
            return arg1 == loc1.slice(0, (loc1.length - 1));
        }

        public function hasGroups(arg1:String):Boolean
        {
            var loc1:*="";
            var loc2:*=arg1.split(",");
            var loc3:*=loc2.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (this._groupList.hasOwnProperty(loc2[loc4])) 
                {
                    loc1 = loc1 + (loc2[loc4] + ",");
                }
                ++loc4;
            }
            return arg1 == loc1.slice(0, (loc1.length - 1));
        }

        public function get disabledList():String
        {
            var loc2:*=null;
            var loc1:*=this._systemButtons.disabledList;
            if (loc1.length > 0) 
            {
                loc1 = loc1 + ",";
            }
            var loc3:*=0;
            var loc4:*=this._buttonRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (loc2.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get enabledList():String
        {
            var loc2:*=null;
            var loc1:*=this._systemButtons.enabledList;
            if (loc1.length > 0) 
            {
                loc1 = loc1 + ",";
            }
            var loc3:*=0;
            var loc4:*=this._buttonRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (!loc2.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get hiddenList():String
        {
            var loc2:*=null;
            var loc1:*=this._systemButtons.hiddenList;
            if (loc1.length > 0) 
            {
                loc1 = loc1 + ",";
            }
            var loc3:*=0;
            var loc4:*=this._buttonRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (loc2.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get visibleList():String
        {
            var loc2:*=null;
            var loc1:*=this._systemButtons.visibleList;
            if (loc1.length > 0) 
            {
                loc1 = loc1 + ",";
            }
            var loc3:*=0;
            var loc4:*=this._buttonRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (!loc2.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function lockAllControls(arg1:Boolean=true):void
        {
            var loc1:*=null;
            this._allControlsLocked = true;
            var loc2:*=0;
            var loc3:*=this._buttonRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                if (arg1) 
                {
                    this._lockedStateHistory[loc1.id] = loc1.locked;
                }
                loc1.locked = true;
            }
            return;
        }

        public function unlockAllControls(arg1:Boolean=true):void
        {
            var loc1:*=null;
            this._allControlsLocked = false;
            var loc2:*=0;
            var loc3:*=this._buttonRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.locked = false;
                if (!arg1) 
                {
                    continue;
                }
                if (this._lockedStateHistory[loc1.id] == null) 
                {
                    continue;
                }
                loc1.locked = this._lockedStateHistory[loc1.id];
            }
            return;
        }

        public function get systemButtons():mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.SystemButtonManager
        {
            if (this._systemButtons == null) 
            {
                this._systemButtons = new mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.SystemButtonManager();
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemMouseEvent.CLICK, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemMouseEvent.DOUBLE_CLICK, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_MOVE, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_WHEEL, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemMouseEvent.RIGHT_CLICK, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OUT, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OVER, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN, this.onControlEvent);
                this._systemButtons.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP, this.onControlEvent);
            }
            return this._systemButtons;
        }

        public function createGroups(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=arg1.split(",");
            for each (loc1 in loc3) 
            {
                this._groupList[loc1] = new mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonGroup(loc1, this as mgs.aurora.common.interfaces.controls.IControlManager);
            }
            return;
        }

        public function disableAllControls():void
        {
            var loc1:*=null;
            this._systemButtons.disableAllControls();
            var loc2:*=0;
            var loc3:*=this._buttonRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.enabled = false;
            }
            return;
        }

        public function disableControls(arg1:String):void
        {
            this._systemButtons.disableControls(arg1);
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._buttonRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.ICustomControl(this._buttonRefs[loc1[loc3]]).enabled = false;
                }
                ++loc3;
            }
            return;
        }

        public function enableAllControls():void
        {
            var loc1:*=null;
            this._systemButtons.enableAllControls();
            var loc2:*=0;
            var loc3:*=this._buttonRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.enabled = true;
            }
            return;
        }

        public function enableControls(arg1:String):void
        {
            this._systemButtons.enableControls(arg1);
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._buttonRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.ICustomControl(this._buttonRefs[loc1[loc3]]).enabled = true;
                }
                ++loc3;
            }
            return;
        }

        public function getControl(arg1:String):mgs.aurora.common.interfaces.controls.IControl
        {
            var loc1:*=this._systemButtons.getControl(arg1);
            if (loc1 != null) 
            {
                return loc1;
            }
            return this._buttonRefs[arg1];
        }

        public function getGroup(arg1:String):mgs.aurora.common.interfaces.controls.IControlGroup
        {
            return this._groupList[arg1] as mgs.aurora.common.interfaces.controls.IControlGroup;
        }

        public function hideAllControls():void
        {
            var loc1:*=null;
            this._systemButtons.hideAllControls();
            var loc2:*=0;
            var loc3:*=this._buttonRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.visible = false;
            }
            return;
        }

        public function hideControls(arg1:String):void
        {
            this._systemButtons.hideControls(arg1);
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._buttonRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.ICustomControl(this._buttonRefs[loc1[loc3]]).visible = false;
                }
                ++loc3;
            }
            return;
        }

        public function linkControlsToGroups(arg1:String, arg2:String):void
        {
            var loc1:*=arg2.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._groupList.hasOwnProperty(loc1[loc3])) 
                {
                    if (this._groupList[loc1[loc3]] != null) 
                    {
                        mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonGroup(this._groupList[loc1[loc3]]).linkToGroup(arg1);
                    }
                }
                ++loc3;
            }
            return;
        }

        public function unlinkControlsFromGroups(arg1:String, arg2:String):void
        {
            var loc1:*=arg2.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._groupList.hasOwnProperty(loc1[loc3])) 
                {
                    if (this._groupList[loc1[loc3]] != null) 
                    {
                        mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonGroup(this._groupList[loc1[loc3]]).unlinkFromGroup(arg1);
                    }
                }
                ++loc3;
            }
            return;
        }

        public function removeAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._buttonRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                this.removeControlListeners(loc1);
                this.unLinkFromAllGroups(loc1.id);
                loc1.removeFromContainer();
                delete this._buttonRefs[loc1.id];
            }
            this._buttonRefs = new flash.utils.Dictionary();
            return;
        }

        public function removeAllGroups():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._groupList;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.unlinkFromGroup(loc1.getAllControlIds());
                delete this._groupList[loc1.id];
            }
            this._groupList = new flash.utils.Dictionary();
            return;
        }

        public function removeControls(arg1:String):void
        {
            var loc4:*=null;
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            this.unLinkFromAllGroups(arg1);
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if ((loc4 = this._buttonRefs[loc1[loc3]]) != null) 
                {
                    this.removeControlListeners(loc4);
                    loc4.removeFromContainer();
                    delete this._buttonRefs[loc1[loc3]];
                }
                ++loc3;
            }
            return;
        }

        public function removeGroups(arg1:String):void
        {
            var loc4:*=null;
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if ((loc4 = this._groupList[loc1[loc3]] as mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonGroup) != null) 
                {
                    loc4.unlinkFromGroup(loc4.getAllControlIds());
                    delete this._groupList[loc1[loc3]];
                }
                ++loc3;
            }
            return;
        }

        public function showAllControls():void
        {
            var loc1:*=null;
            this._systemButtons.showAllControls();
            var loc2:*=0;
            var loc3:*=this._buttonRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.visible = true;
            }
            return;
        }

        public function showControls(arg1:String):void
        {
            this._systemButtons.showControls(arg1);
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._buttonRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.IControl(this._buttonRefs[loc1[loc3]]).visible = true;
                }
                ++loc3;
            }
            return;
        }

        internal var _groupList:flash.utils.Dictionary;

        internal var _buttonRefs:flash.utils.Dictionary;

        internal var _systemButtons:mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.SystemButtonManager;

        internal var _lockedStateHistory:flash.utils.Dictionary;

        internal var _allControlsLocked:Boolean;
    }
}


//                  class SystemButtonManager
package mgs.aurora.modules.framesBuilder.model.frames.controls.buttons 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.enums.frame.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.modules.framesBuilder.controller.utils.*;
    import mgs.aurora.modules.framesBuilder.model.*;
    
    public class SystemButtonManager extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IControlManager
    {
        public function SystemButtonManager()
        {
            super();
            this._groupList = new flash.utils.Dictionary();
            this._buttonRefs = new flash.utils.Dictionary();
            return;
        }

        internal function addControlListeners(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.CLICK, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.DOUBLE_CLICK, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_MOVE, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_WHEEL, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OUT, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OVER, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP, this.onControlEvent);
            arg1.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN, this.onControlEvent);
            return;
        }

        internal function removeControlListeners(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.CLICK, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.DOUBLE_CLICK, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_MOVE, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.MOUSE_WHEEL, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OUT, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemMouseEvent.ROLL_OVER, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP, this.onControlEvent);
            arg1.removeEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN, this.onControlEvent);
            return;
        }

        internal function onControlEvent(arg1:*):void
        {
            var loc1:*=null;
            if (super.hasEventListener(arg1.type)) 
            {
                if (arg1.type == mgs.aurora.common.events.SystemMouseEvent.CLICK || arg1.type == mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP) 
                {
                    loc1 = mgs.aurora.modules.framesBuilder.model.SoundsProxy(mgs.aurora.modules.framesBuilder.controller.utils.PureMVCUtility.retrieveProxy(mgs.aurora.modules.framesBuilder.model.SoundsProxy.NAME));
                    Debugger.trace("CLICKING BUTTON AND PLAYING SOUNDS ", "SYSTEM");
                    loc1.play(mgs.aurora.modules.framesBuilder.model.FrameSoundsEnum.SOUND_NAME_FROM_LIB);
                }
                super.dispatchEvent(arg1.clone());
            }
            return;
        }

        public function addControl(arg1:mgs.aurora.common.interfaces.controls.ICustomControl, arg2:flash.display.DisplayObjectContainer, arg3:String=null):void
        {
            var loc2:*=null;
            if (this._buttonRefs.hasOwnProperty(arg1.id)) 
            {
                return;
            }
            var loc1:*=mgs.aurora.common.enums.frame.SystemButtonTypes[arg1.id];
            mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonControl(arg1).id = loc1;
            this._buttonRefs[loc1] = arg1;
            if (arg3 != null) 
            {
                var loc3:*=0;
                var loc4:*=arg3.split(",");
                for each (loc2 in loc4) 
                {
                    if (!this._groupList.hasOwnProperty(loc2)) 
                    {
                        this.createGroups(loc2);
                    }
                    mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonGroup(this._groupList[loc2]).linkToGroup(loc1);
                }
            }
            arg1.addToContainer(arg2);
            this.addControlListeners(arg1);
            return;
        }

        public function addControls(arg1:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.ICustomControl>, arg2:flash.display.DisplayObjectContainer, arg3:String=null):void
        {
            var loc1:*=arg1.length;
            var loc2:*=0;
            while (loc2 < loc1) 
            {
                this.addControl(arg1[loc2], arg2, arg3);
                ++loc2;
            }
            return;
        }

        public function createGroups(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=arg1.split(",");
            for each (loc1 in loc3) 
            {
                this._groupList[loc1] = new mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonGroup(loc1, this as mgs.aurora.common.interfaces.controls.IControlManager);
            }
            return;
        }

        public function getGroup(arg1:String):mgs.aurora.common.interfaces.controls.IControlGroup
        {
            return this._groupList[arg1] as mgs.aurora.common.interfaces.controls.IControlGroup;
        }

        public function hasGroups(arg1:String):Boolean
        {
            var loc1:*="";
            var loc2:*=arg1.split(",");
            var loc3:*=loc2.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (this._groupList.hasOwnProperty(loc2[loc4])) 
                {
                    loc1 = loc1 + (loc2[loc4] + ",");
                }
                ++loc4;
            }
            return arg1 == loc1.slice(0, (loc1.length - 1));
        }

        public function linkControlsToGroups(arg1:String, arg2:String):void
        {
            var loc1:*=arg2.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._groupList.hasOwnProperty(loc1[loc3])) 
                {
                    if (this._groupList[loc1[loc3]] != null) 
                    {
                        mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonGroup(this._groupList[loc1[loc3]]).linkToGroup(arg1);
                    }
                }
                ++loc3;
            }
            return;
        }

        public function removeAllControls():void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=0;
            var loc4:*=this._buttonRefs;
            for each (loc1 in loc4) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc2 = loc1.id;
                this.unLinkFromAllGroups(loc2);
                this.removeControlListeners(loc1);
                loc1.removeFromContainer();
                delete this._buttonRefs[loc2];
            }
            return;
        }

        public function removeAllGroups():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._groupList;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.unlinkFromGroup(loc1.getAllControlIds());
                delete this._groupList[loc1.id];
            }
            this._groupList = new flash.utils.Dictionary();
            return;
        }

        public function removeControls(arg1:String):void
        {
            var loc4:*=null;
            var loc1:*=this.filterSystemButtons(arg1);
            var loc2:*=loc1.length;
            this.unLinkFromAllGroups(arg1);
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if ((loc4 = this._buttonRefs[loc1[loc3]]) != null) 
                {
                    this.removeControlListeners(loc4);
                    loc4.removeFromContainer();
                    delete this._buttonRefs[loc1[loc3]];
                }
                ++loc3;
            }
            return;
        }

        public function removeGroups(arg1:String):void
        {
            var loc4:*=null;
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if ((loc4 = this._groupList[loc1[loc3]] as mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonGroup) != null) 
                {
                    loc4.unlinkFromGroup(loc4.getAllControlIds());
                    delete this._groupList[loc1[loc3]];
                }
                ++loc3;
            }
            return;
        }

        public function unlinkControlsFromGroups(arg1:String, arg2:String):void
        {
            var loc1:*=arg2.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._groupList.hasOwnProperty(loc1[loc3])) 
                {
                    if (this._groupList[loc1[loc3]] != null) 
                    {
                        mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonGroup(this._groupList[loc1[loc3]]).unlinkFromGroup(arg1);
                    }
                }
                ++loc3;
            }
            return;
        }

        public function get disabledList():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._buttonRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (loc2.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get enabledList():String
        {
            var loc2:*=null;
            Logger.logMessage("System Buttons : enabledList");
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._buttonRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                Logger.logMessage("System Buttons : enabledList : " + loc2.id + " : " + loc2.enabled);
                if (!loc2.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get hiddenList():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._buttonRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (loc2.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get visibleList():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._buttonRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (!loc2.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function disableAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._buttonRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                if (this.isAlwaysEnabled(loc1.id)) 
                {
                    continue;
                }
                loc1.enabled = false;
            }
            return;
        }

        public function disableControls(arg1:String):void
        {
            var loc1:*=this.filterSystemButtons(arg1);
            this.checkAndRemoveAlwaysEnabled(loc1);
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (!(this._buttonRefs[loc1[loc3]] == null) && !this.isAlwaysEnabled(loc1[loc3])) 
                {
                    mgs.aurora.common.interfaces.controls.ICustomControl(this._buttonRefs[loc1[loc3]]).enabled = false;
                }
                ++loc3;
            }
            return;
        }

        public function enableAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._buttonRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.enabled = true;
            }
            return;
        }

        public function enableControls(arg1:String):void
        {
            var loc4:*=null;
            var loc1:*=this.filterSystemButtons(arg1);
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._buttonRefs[loc1[loc3]] != null) 
                {
                    (loc4 = mgs.aurora.common.interfaces.controls.ICustomControl(this._buttonRefs[loc1[loc3]])).enabled = true;
                }
                ++loc3;
            }
            return;
        }

        public function getControl(arg1:String):mgs.aurora.common.interfaces.controls.IControl
        {
            return this._buttonRefs[arg1];
        }

        public function hasControls(arg1:String):Boolean
        {
            var loc1:*=this.filterSystemButtons(arg1);
            var loc2:*=loc1.length;
            var loc3:*="";
            var loc4:*=0;
            while (loc4 < loc2) 
            {
                if (this._buttonRefs.hasOwnProperty(loc1[loc4])) 
                {
                    loc3 = loc3 + (loc1[loc4] + ",");
                }
                ++loc4;
            }
            return arg1 == loc3.slice(0, (loc3.length - 1));
        }

        public function hideAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._buttonRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                if (this.isAlwaysEnabled(loc1.id)) 
                {
                    continue;
                }
                loc1.visible = false;
            }
            return;
        }

        public function hideControls(arg1:String):void
        {
            var loc1:*=this.filterSystemButtons(arg1);
            this.checkAndRemoveAlwaysEnabled(loc1);
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._buttonRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.ICustomControl(this._buttonRefs[loc1[loc3]]).visible = false;
                }
                ++loc3;
            }
            return;
        }

        public function showAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._buttonRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.visible = true;
            }
            return;
        }

        public function showControls(arg1:String):void
        {
            var loc1:*=this.filterSystemButtons(arg1);
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._buttonRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.IControl(this._buttonRefs[loc1[loc3]]).visible = true;
                }
                ++loc3;
            }
            return;
        }

        public function set excludeList(arg1:__AS3__.vec.Vector.<String>):void
        {
            var loc2:*=null;
            var loc3:*=null;
            this._excludeList = arg1;
            var loc1:*=0;
            while (loc1 < this._excludeList.length) 
            {
                loc2 = this._excludeList[loc1];
                if ((loc3 = this._buttonRefs[loc2]) != null) 
                {
                    if (loc3.frameExcludeMethod != mgs.aurora.common.enums.frame.ExcludeMethodTypes.DISABLED) 
                    {
                        if (loc3.frameExcludeMethod != mgs.aurora.common.enums.frame.ExcludeMethodTypes.ENABLED) 
                        {
                            if (loc3.frameExcludeMethod == mgs.aurora.common.enums.frame.ExcludeMethodTypes.HIDDEN) 
                            {
                                loc3.visible = false;
                            }
                        }
                        else 
                        {
                            loc3.enabled = true;
                        }
                    }
                    else 
                    {
                        loc3.enabled = false;
                    }
                    loc3.excluded = true;
                }
                ++loc1;
            }
            return;
        }

        public function get excludeList():__AS3__.vec.Vector.<String>
        {
            return this._excludeList;
        }

        public function lockAllControls(arg1:Boolean=true):void
        {
            return;
        }

        public function unlockAllControls(arg1:Boolean=true):void
        {
            return;
        }

        public function changeControl(arg1:String, arg2:String, arg3:String=""):void
        {
            var loc1:*;
            (loc1 = mgs.aurora.common.interfaces.controls.ICustomControl(this._buttonRefs[arg1])).id = arg2;
            if (!(arg3 == "undefined") && !(arg3 == "null")) 
            {
                loc1.text = arg3;
            }
            return;
        }

        internal function checkAndRemoveAlwaysEnabled(arg1:__AS3__.vec.Vector.<String>):void
        {
            var loc1:*=arg1.indexOf(mgs.aurora.common.enums.frame.SystemButtonTypes.PLAYFORREAL, 0);
            if (loc1 > -1) 
            {
                arg1 = arg1.slice(loc1, loc1);
            }
            return;
        }

        internal function isAlwaysEnabled(arg1:String):Boolean
        {
            if (arg1 == mgs.aurora.common.enums.frame.SystemButtonTypes.HELP || arg1 == mgs.aurora.common.enums.frame.SystemButtonTypes.PLAYFORREAL) 
            {
                return true;
            }
            return false;
        }

        internal function unLinkFromAllGroups(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._groupList;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.unlinkFromGroup(arg1);
            }
            return;
        }

        internal function filterSystemButtons(arg1:String):__AS3__.vec.Vector.<String>
        {
            var loc1:*=new Vector.<String>();
            var loc2:*=arg1.split(",");
            var loc3:*=loc2.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (loc2[loc4] == mgs.aurora.common.enums.frame.SystemButtonTypes.BANK || loc2[loc4] == mgs.aurora.common.enums.frame.SystemButtonTypes.CONNECT || loc2[loc4] == mgs.aurora.common.enums.frame.SystemButtonTypes.DISCONNECT || loc2[loc4] == mgs.aurora.common.enums.frame.SystemButtonTypes.EXIT || loc2[loc4] == mgs.aurora.common.enums.frame.SystemButtonTypes.EXPERT || loc2[loc4] == mgs.aurora.common.enums.frame.SystemButtonTypes.HELP || loc2[loc4] == mgs.aurora.common.enums.frame.SystemButtonTypes.OPTIONS || loc2[loc4] == mgs.aurora.common.enums.frame.SystemButtonTypes.PLAYFORREAL || loc2[loc4] == mgs.aurora.common.enums.frame.SystemButtonTypes.REGULAR || loc2[loc4] == mgs.aurora.common.enums.frame.SystemButtonTypes.STATS) 
                {
                    loc1.push(loc2[loc4]);
                }
                ++loc4;
            }
            return loc1;
        }

        internal var _groupList:flash.utils.Dictionary;

        internal var _buttonRefs:flash.utils.Dictionary;

        internal var _excludeList:__AS3__.vec.Vector.<String>;
    }
}


//                package chipSelector
//                  class ChipSelector
package mgs.aurora.modules.framesBuilder.model.frames.controls.chipSelector 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import flash.filters.*;
    import flash.text.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.common.utilities.*;
    
    public class ChipSelector extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.frames.frame.assets.IChipSelector
    {
        public function ChipSelector(arg1:flash.display.MovieClip=null, arg2:Object=null)
        {
            super();
            this._chipSelectorMc = arg1;
            this._fixValueTextFormatXML = arg2.textFormat as XML;
            this._fixValueTextXML = arg2.textProperties as XML;
            this._fixValueString = arg2.text as String;
            this._fixValueBevel = arg2.textBevel as Boolean;
            this._fixValueWidth = Number(arg2.width);
            if (this._chipSelectorMc != null) 
            {
                this._ucsAvailable = true;
                this._incButton = this._chipSelectorMc.inc as flash.display.MovieClip;
                this._decButton = this._chipSelectorMc.dec as flash.display.MovieClip;
                this._coinMovie = this._chipSelectorMc.coins as flash.display.MovieClip;
                this._fixValueMovie = this._chipSelectorMc.fixedValue as flash.display.MovieClip;
                this.addListeners();
                this.visible = false;
            }
            else 
            {
                this._ucsAvailable = false;
            }
            return;
        }

        public function get visible():Boolean
        {
            return this._visible;
        }

        public function set visible(arg1:Boolean):void
        {
            if (this._visible == arg1) 
            {
                return;
            }
            this._visible = arg1;
            this.buttonVisable = arg1;
            if (this._ucsAvailable) 
            {
                this._chipSelectorMc.gotoAndStop(arg1 ? "active" : "inactive");
                if (arg1) 
                {
                    this._incButton = this._chipSelectorMc.inc as flash.display.MovieClip;
                    this._decButton = this._chipSelectorMc.dec as flash.display.MovieClip;
                    this._coinMovie = this._chipSelectorMc.coins as flash.display.MovieClip;
                    this._fixValueMovie = this._chipSelectorMc.fixedValue as flash.display.MovieClip;
                    this.addListeners();
                }
                else 
                {
                    this.removeListeners();
                }
                this.refreshDisplay();
            }
            return;
        }

        public function get value():uint
        {
            return this._value;
        }

        public function set value(arg1:uint):void
        {
            if (this._value == arg1 || arg1 == 0) 
            {
                return;
            }
            this._value = arg1;
            if (this._range == null) 
            {
                this._index = 0;
            }
            else 
            {
                this._index = this._range.indexOf(arg1);
            }
            this.refreshDisplay();
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

        public function set type(arg1:String):void
        {
            this._type = arg1;
            return;
        }

        public function get type():String
        {
            return this._type;
        }

        public function set incAndDecButtonVisiblity(arg1:Boolean):void
        {
            this._buttonHiddenByGame = !arg1;
            this.buttonVisable = arg1;
            return;
        }

        public function set incForciblyEnabled(arg1:Boolean):void
        {
            this._enabled = undefined;
            if (this._ucsAvailable) 
            {
                this.enableIncDecButtons(this._incButton, arg1);
            }
            return;
        }

        public function set decForciblyEnabled(arg1:Boolean):void
        {
            this._enabled = undefined;
            if (this._ucsAvailable) 
            {
                this.enableIncDecButtons(this._decButton, arg1);
            }
            return;
        }

        internal function refreshDisplay():void
        {
            if (!this._visible || !this._ucsAvailable) 
            {
                return;
            }
            this._coinMovie.gotoAndStop(this._displayType + this._value.toString());
            if (!this._fixValue && !this._buttonHiddenByGame) 
            {
                this.buttonsEnabled(this._enabled);
                if (this._fixValueText != null) 
                {
                    this._fixValueMovie.removeChildAt(0);
                    this._fixValueText = null;
                }
            }
            else 
            {
                this.hideIncDecButtons();
                if (this._fixValueText == null && this._fixValue) 
                {
                    this._fixValueTextFormat = new flash.text.TextFormat();
                    mgs.aurora.common.utilities.ObjectUtils.updateFromXML(this._fixValueTextFormatXML, this._fixValueTextFormat);
                    this._fixValueText = new flash.text.TextField();
                    mgs.aurora.common.utilities.ObjectUtils.updateFromXML(this._fixValueTextXML, this._fixValueText);
                    this._fixValueText.defaultTextFormat = this._fixValueTextFormat;
                    this._fixValueText.width = this._fixValueWidth != 0 ? this._fixValueWidth : this._fixValueText.width;
                    if (this._fixValueString != null) 
                    {
                        this._fixValueText.text = this._fixValueString;
                    }
                    if (this._fixValueBevel) 
                    {
                        this.applayBevel(this._fixValueText, 0.2, 1, 1);
                    }
                    this._fixValueMovie.addChildAt(this._fixValueText, 0);
                    this.updatePosition();
                }
            }
            return;
        }

        internal function updatePosition():void
        {
            var loc1:*=String(this._fixValueTextXML.@regXPosition).toLowerCase();
            switch (loc1) 
            {
                case "right":
                {
                    this._fixValueText.x = 0 - this._fixValueText.width;
                    break;
                }
                case "left":
                {
                    this._fixValueText.x = 0;
                    break;
                }
                case "center":
                default:
                {
                    this._fixValueText.x = 0 - this._fixValueText.width / 2;
                }
            }
            return;
        }

        internal function applayBevel(arg1:Object, arg2:Number, arg3:Number, arg4:Number):void
        {
            var loc1:*=45;
            var loc2:*=0;
            var loc3:*=1;
            var loc4:*=16777215;
            var loc5:*=1;
            var loc6:*=1;
            var loc7:*=5;
            var loc8:*="outer";
            var loc9:*=false;
            var loc10:*=new flash.filters.BevelFilter(arg2, loc1, loc2, loc3, loc4, loc5, arg3, arg4, loc6, loc7, loc8, loc9);
            var loc11:*;
            (loc11 = new Array()).push(loc10);
            arg1.filters = loc11;
            return;
        }

        internal function getTextStyle(arg1:XMLList, arg2:String):XML
        {
            var textLayerXML:XMLList;
            var textLayerId:String;
            var targetXML:XML;

            var loc1:*;
            textLayerXML = arg1;
            textLayerId = arg2;
            targetXML = new XML("<textLayer/>");
            var loc3:*=0;
            var loc4:*=textLayerXML.style;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textLayerId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textLayerXML, "style");
            return targetXML;
        }

        internal function getTextFormat(arg1:XMLList, arg2:String):XML
        {
            var textFormatXML:XMLList;
            var textFormatId:String;
            var targetXML:XML;

            var loc1:*;
            textFormatXML = arg1;
            textFormatId = arg2;
            targetXML = new XML("<textFormat/>");
            var loc3:*=0;
            var loc4:*=textFormatXML.style;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textFormatId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textFormatXML, "style");
            return targetXML;
        }

        internal function getTextField(arg1:XMLList, arg2:String):XML
        {
            var textFieldXML:XMLList;
            var textFieldId:String;
            var targetXML:XML;

            var loc1:*;
            textFieldXML = arg1;
            textFieldId = arg2;
            targetXML = new XML("<textField/>");
            var loc3:*=0;
            var loc4:*=textFieldXML.textt;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textFieldId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textFieldXML, "textt");
            return targetXML;
        }

        internal function populateFromInheritedNode(arg1:XML, arg2:XML, arg3:XMLList, arg4:String):void
        {
            var targetXML:XML;
            var sourceXML:XML;
            var parentXML:XMLList;
            var targetChild:String;
            var item:XML;
            var inheritFrom:String;
            var extendFrom:XML;
            var property:String;
            var value:String;

            var loc1:*;
            item = null;
            inheritFrom = null;
            extendFrom = null;
            property = null;
            value = null;
            targetXML = arg1;
            sourceXML = arg2;
            parentXML = arg3;
            targetChild = arg4;
            if (sourceXML.@inherit != undefined) 
            {
                inheritFrom = sourceXML.@inherit;
                var loc3:*=0;
                var loc4:*=parentXML[targetChild];
                var loc2:*=new XMLList("");
                for each (var loc5:* in loc4) 
                {
                    var loc6:*;
                    with (loc6 = loc5) 
                    {
                        if (@id == inheritFrom) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                extendFrom = XML(loc2);
                this.populateFromInheritedNode(targetXML, extendFrom, parentXML, targetChild);
            }
            targetXML.appendChild(sourceXML.children());
            loc2 = 0;
            loc3 = sourceXML.attributes();
            for each (item in loc3) 
            {
                property = item.name();
                value = item.toString();
                targetXML.@[property] = value;
            }
            return;
        }

        internal function set buttonVisable(arg1:Boolean):void
        {
            if (arg1 == this._buttonsVisible) 
            {
                return;
            }
            this._buttonsVisible = arg1;
            if (this._ucsAvailable) 
            {
                if (this._visible && !this._fixValue && !this._buttonHiddenByGame) 
                {
                    this.buttonsEnabled(this._enabled);
                }
                else 
                {
                    this.hideIncDecButtons();
                }
            }
            return;
        }

        internal function buttonsEnabled(arg1:Boolean):void
        {
            if (!this._fixValue && !this._buttonHiddenByGame && !(this._range == null)) 
            {
                if (arg1) 
                {
                    if (this._value <= this._minValue) 
                    {
                        this.enableIncDecButtons(this._decButton, false);
                    }
                    else 
                    {
                        this.enableIncDecButtons(this._decButton, true);
                    }
                    if (this._value >= this._maxValue) 
                    {
                        this.enableIncDecButtons(this._incButton, false);
                    }
                    else 
                    {
                        this.enableIncDecButtons(this._incButton, true);
                    }
                }
                else 
                {
                    this.enableIncDecButtons(this._decButton, false);
                    this.enableIncDecButtons(this._incButton, false);
                }
            }
            return;
        }

        internal function enableIncDecButtons(arg1:flash.display.MovieClip, arg2:Boolean):void
        {
            arg1.enabled = arg2;
            if (arg2) 
            {
                arg1.gotoAndStop(ACTIVE);
            }
            else 
            {
                arg1.gotoAndStop(INACTIVE);
            }
            return;
        }

        internal function hideIncDecButtons():void
        {
            this._incButton.gotoAndStop(HIDDEN);
            this._decButton.gotoAndStop(HIDDEN);
            return;
        }

        internal function removeListeners():void
        {
            mgs.aurora.common.utilities.EventUtils.removeMouseEventsFromSingleMethod(this._incButton, this.onIncClicked);
            mgs.aurora.common.utilities.EventUtils.removeMouseEventsFromSingleMethod(this._decButton, this.onDecClicked);
            return;
        }

        internal function onIncClicked(arg1:flash.events.MouseEvent):void
        {
            Debugger.trace("onIncClicked " + arg1.type, "FRAMES CHIP");
            var loc1:*=arg1.type;
            switch (loc1) 
            {
                case flash.events.MouseEvent.MOUSE_OUT:
                case flash.events.MouseEvent.ROLL_OUT:
                {
                    if (this._incButton.enabled) 
                    {
                        this._incButton.gotoAndStop(ACTIVE);
                        this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, "UCS_INC", arg1));
                    }
                    break;
                }
                case flash.events.MouseEvent.MOUSE_DOWN:
                {
                    if (this._incButton.enabled) 
                    {
                        this._incButton.gotoAndStop(DOWN);
                    }
                    this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, "UCS_INC", arg1));
                    break;
                }
                case flash.events.MouseEvent.MOUSE_UP:
                case flash.events.MouseEvent.DOUBLE_CLICK:
                {
                    if (this._incButton.enabled) 
                    {
                        this._incButton.gotoAndStop(OVER);
                    }
                    break;
                }
                case flash.events.MouseEvent.MOUSE_OVER:
                case flash.events.MouseEvent.ROLL_OVER:
                {
                    if (this._incButton.enabled) 
                    {
                        this._incButton.gotoAndStop(OVER);
                        this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, "UCS_INC", arg1));
                    }
                    break;
                }
                case flash.events.MouseEvent.CLICK:
                {
                    if (this._incButton.enabled) 
                    {
                        this._incButton.gotoAndStop(OVER);
                        Debugger.trace("INC BET CLICKED", "FRAMES CHIP");
                        this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, "UCS_INC", arg1));
                        this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.CLICK, "UCS_INC", arg1));
                        if (this.range != null) 
                        {
                            var loc2:*=((loc1 = this).index + 1);
                            loc1.index = loc2;
                        }
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

        public function get enabled():Boolean
        {
            return this._enabled;
        }

        internal function onDecClicked(arg1:flash.events.MouseEvent):void
        {
            var loc1:*=arg1.type;
            switch (loc1) 
            {
                case flash.events.MouseEvent.MOUSE_OUT:
                case flash.events.MouseEvent.ROLL_OUT:
                {
                    if (this._decButton.enabled) 
                    {
                        this._decButton.gotoAndStop(ACTIVE);
                        this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OUT, "UCS_DEC", arg1));
                    }
                    break;
                }
                case flash.events.MouseEvent.MOUSE_DOWN:
                {
                    if (this._decButton.enabled) 
                    {
                        this._decButton.gotoAndStop(DOWN);
                        this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_DOWN, "UCS_DEC", arg1));
                    }
                    break;
                }
                case flash.events.MouseEvent.MOUSE_UP:
                case flash.events.MouseEvent.DOUBLE_CLICK:
                {
                    if (this._decButton.enabled) 
                    {
                        this._decButton.gotoAndStop(OVER);
                    }
                    break;
                }
                case flash.events.MouseEvent.MOUSE_OVER:
                case flash.events.MouseEvent.ROLL_OVER:
                {
                    if (this._decButton.enabled) 
                    {
                        this._decButton.gotoAndStop(OVER);
                        this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_OVER, "UCS_DEC", arg1));
                    }
                    break;
                }
                case flash.events.MouseEvent.CLICK:
                {
                    if (this._decButton.enabled) 
                    {
                        this._decButton.gotoAndStop(OVER);
                        Debugger.trace("DEC BET CLICKED", "FRAMES CHIP");
                        this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.MOUSE_UP, "UCS_DEC", arg1));
                        this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(mgs.aurora.common.events.SystemMouseEvent.CLICK, "UCS_DEC", arg1));
                        if (this.range != null) 
                        {
                            var loc2:*=((loc1 = this).index - 1);
                            loc1.index = loc2;
                        }
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

        public function get displayType():String
        {
            return this._displayType;
        }

        public function set displayType(arg1:String):void
        {
            if (this._displayType == arg1) 
            {
                return;
            }
            this._displayType = arg1;
            this.refreshDisplay();
            return;
        }

        public function get index():uint
        {
            return this._index;
        }

        public function set index(arg1:uint):void
        {
            if (this._index == arg1 && arg1 > (this._range.length - 1) && arg1 < 0) 
            {
                return;
            }
            this._index = arg1;
            this._value = this._range[this._index];
            this.refreshDisplay();
            return;
        }

        public function get range():__AS3__.vec.Vector.<uint>
        {
            return this._range;
        }

        public function set range(arg1:__AS3__.vec.Vector.<uint>):void
        {
            if (this._range == arg1) 
            {
                return;
            }
            this._range = arg1;
            this._fixValue = this._range.length == 1;
            this._minValue = this._range[0];
            this._maxValue = this._range[(this._range.length - 1)];
            if (this._value != 0) 
            {
                this._index = this._range.indexOf(this._value);
            }
            this.refreshDisplay();
            return;
        }

        internal function addListeners():void
        {
            mgs.aurora.common.utilities.EventUtils.addMouseEventsToSingleMethod(this._incButton, this.onIncClicked);
            mgs.aurora.common.utilities.EventUtils.addMouseEventsToSingleMethod(this._decButton, this.onDecClicked);
            return;
        }

        public function set enabled(arg1:Boolean):void
        {
            if (this._enabled == arg1) 
            {
                return;
            }
            this._enabled = arg1;
            if (this._visible && this._ucsAvailable) 
            {
                this.buttonsEnabled(this._enabled);
            }
            return;
        }

        internal static const INACTIVE:String="Inactive";

        internal static const ACTIVE:String="Active";

        internal static const DOWN:String="Depressed";

        internal static const OVER:String="Over";

        internal static const HIDDEN:String="Hidden";

        internal var _chipSelectorMc:flash.display.MovieClip;

        internal var _incButton:flash.display.MovieClip;

        internal var _decButton:flash.display.MovieClip;

        internal var _coinMovie:flash.display.MovieClip;

        internal var _fixValueMovie:flash.display.MovieClip;

        internal var _fixValueText:flash.text.TextField;

        internal var _ucsAvailable:Boolean;

        internal var _displayType:String;

        internal var _index:uint=0;

        internal var _range:__AS3__.vec.Vector.<uint>;

        internal var _value:uint;

        internal var _enabled:Boolean;

        internal var _id:String;

        internal var _type:String;

        internal var _visible:Boolean=true;

        internal var _buttonsVisible:Boolean;

        internal var _buttonHiddenByGame:Boolean=false;

        internal var _maxValue:uint;

        internal var _minValue:uint;

        internal var _fixValueTextFormat:flash.text.TextFormat;

        internal var _fixValueTextFormatXML:XML;

        internal var _fixValueTextXML:XML;

        internal var _fixValueString:String;

        internal var _fixValueWidth:Number;

        internal var _fixValue:Boolean;

        internal var _fixValueBevel:Boolean;
    }
}


//                package clock
//                  class Clock
package mgs.aurora.modules.framesBuilder.model.frames.controls.clock 
{
    import flash.display.*;
    import flash.events.*;
    import flash.text.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    
    public class Clock extends Object implements mgs.aurora.common.interfaces.frames.frame.assets.IClock
    {
        public function Clock(arg1:flash.text.TextField)
        {
            super();
            this._txtTime = arg1;
            this._firstTimer = new flash.utils.Timer(0, 1);
            this._firstTimer.addEventListener(flash.events.TimerEvent.TIMER_COMPLETE, this.onFirstTime);
            this._updateTimer = new flash.utils.Timer(60000, 0);
            this._updateTimer.addEventListener(flash.events.TimerEvent.TIMER, this.onTimeChange);
            this._showing = false;
            this._txtTime.visible = this._showing;
            return;
        }

        public function showTime():void
        {
            this._showing = true;
            this._txtTime.visible = this._showing;
            var loc1:*=60000 - this.updateTime();
            if (!this._firstTimer.running) 
            {
                if (loc1 < 10) 
                {
                    if (!this._updateTimer.running) 
                    {
                        this._updateTimer.reset();
                        this._updateTimer.start();
                    }
                }
                else 
                {
                    this._firstTimer.delay = loc1;
                    this._firstTimer.reset();
                    this._firstTimer.start();
                }
            }
            return;
        }

        public function hideTime():void
        {
            this._showing = false;
            this._txtTime.visible = this._showing;
            this._firstTimer.stop();
            this._updateTimer.stop();
            this._txtTime.text = "";
            return;
        }

        internal function updateTime():int
        {
            var loc1:*=new Date();
            var loc2:*=loc1.getHours();
            var loc3:*=loc1.getMinutes();
            var loc4:*=loc1.getSeconds() * 1000 + loc1.getMilliseconds();
            var loc5:*;
            if ((loc5 = "" + loc2).length == 1) 
            {
                loc5 = "0" + loc2;
            }
            var loc6:*;
            if ((loc6 = "" + loc3).length == 1) 
            {
                loc6 = "0" + loc3;
            }
            this._txtTime.text = "" + loc5 + ":" + loc6;
            return loc4;
        }

        internal function onFirstTime(arg1:flash.events.TimerEvent):void
        {
            this.updateTime();
            this._firstTimer.stop();
            if (!this._updateTimer.running) 
            {
                this._updateTimer.reset();
                this._updateTimer.start();
            }
            return;
        }

        internal function onTimeChange(arg1:flash.events.TimerEvent):void
        {
            this.updateTime();
            return;
        }

        internal var _container:flash.display.MovieClip;

        internal var _showing:Boolean;

        internal var _txtTime:flash.text.TextField;

        internal var _firstTimer:flash.utils.Timer;

        internal var _updateTimer:flash.utils.Timer;
    }
}


//                package connectClip
//                  class ConnectClip
package mgs.aurora.modules.framesBuilder.model.frames.controls.connectClip 
{
    import flash.display.*;
    
    public class ConnectClip extends Object
    {
        public function ConnectClip(arg1:flash.display.MovieClip)
        {
            super();
            this._connectClip = arg1;
            this.stop();
            return;
        }

        public function start():void
        {
            if (this._connectClip != null) 
            {
                this._connectClip.gotoAndPlay(this.FRAME_START);
            }
            return;
        }

        public function stop():void
        {
            if (this._connectClip != null) 
            {
                this._connectClip.gotoAndStop(this.FRAME_STOP);
            }
            return;
        }

        public const FRAME_START:String="Play";

        public const FRAME_STOP:String="Start";

        internal var _connectClip:flash.display.MovieClip;
    }
}


//                package credits
//                  class Credits
package mgs.aurora.modules.framesBuilder.model.frames.controls.credits 
{
    import __AS3__.vec.*;
    import flash.events.*;
    import flash.text.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    
    public class Credits extends Object implements mgs.aurora.common.interfaces.frames.frame.assets.ICredits
    {
        public function Credits(arg1:flash.text.TextField, arg2:flash.text.TextField)
        {
            super();
            this._txtValue = arg2;
            this._txtWord = arg1;
            if (!(arg1 == null) && !(arg2 == null)) 
            {
                this._timer = new flash.utils.Timer(0);
                this._timer.addEventListener(flash.events.TimerEvent.TIMER, this.onTimer);
                this._maxCreditWordWidth = this._txtWord.width;
                this._maxCreditValueWidth = this._txtValue.width;
                this._creditValueX = this._txtValue.x;
                this._creditWordX = this._txtWord.x;
            }
            return;
        }

        public function alternate(arg1:__AS3__.vec.Vector.<String>, arg2:int):void
        {
            this._alternateV = arg1;
            this._timer.delay = arg2;
            this._alternateIndex = 0;
            this._timer.start();
            return;
        }

        public function stopAlternate():void
        {
            this._timer.reset();
            this._timer.stop();
            this.word = this._staticValue;
            return;
        }

        public function set word(arg1:String):void
        {
            if (this._txtWord != null) 
            {
                this._txtWord.text = arg1;
                this.checkWordSize();
            }
            this._staticValue = arg1;
            return;
        }

        public function set value(arg1:String):void
        {
            if (this._txtValue != null) 
            {
                this._txtValue.text = arg1;
                this.checkValueSize();
            }
            return;
        }

        internal function onTimer(arg1:flash.events.TimerEvent):void
        {
            this._txtWord.text = this._alternateV[this._alternateIndex];
            var loc1:*;
            var loc2:*=((loc1 = this)._alternateIndex + 1);
            loc1._alternateIndex = loc2;
            if (this._alternateIndex == this._alternateV.length) 
            {
                this._alternateIndex = 0;
            }
            return;
        }

        internal function checkWordSize():void
        {
            if (this._maxCreditWordWidth == 0) 
            {
                return;
            }
            this._txtWord.wordWrap = false;
            this._txtWord.autoSize = flash.text.TextFieldAutoSize.CENTER;
            this._txtWord.width = this._txtWord.textWidth;
            var loc1:*=this._txtWord.getTextFormat();
            while (this._txtWord.width >= this._maxCreditWordWidth && loc1.size > 8) 
            {
                loc1 = this._txtWord.getTextFormat();
                loc1.size = (Number(loc1.size) - 1);
                this._txtWord.setTextFormat(loc1);
            }
            var loc2:*=this._maxCreditWordWidth / 2;
            if (this._txtWord.width <= loc2) 
            {
                loc1 = this._txtWord.getTextFormat();
                loc1.size = Number(loc1.size) + 2;
                this._txtWord.setTextFormat(loc1);
            }
            this._txtWord.width = this._txtWord.width + 3;
            this._txtWord.autoSize = flash.text.TextFieldAutoSize.NONE;
            var loc3:*=this._creditWordX + this._maxCreditWordWidth / 2 - this._txtWord.width / 2;
            this._txtWord.x = loc3;
            return;
        }

        internal function checkValueSize():void
        {
            if (this._maxCreditValueWidth == 0) 
            {
                return;
            }
            this._txtValue.wordWrap = false;
            this._txtValue.autoSize = flash.text.TextFieldAutoSize.CENTER;
            this._txtValue.width = this._txtValue.textWidth;
            var loc1:*=this._txtValue.getTextFormat();
            while (this._txtValue.width >= this._maxCreditValueWidth && loc1.size > 8) 
            {
                loc1 = this._txtValue.getTextFormat();
                loc1.size = (Number(loc1.size) - 1);
                this._txtValue.setTextFormat(loc1);
            }
            this._txtValue.width = this._txtValue.width + 3;
            this._txtValue.autoSize = flash.text.TextFieldAutoSize.NONE;
            var loc2:*=this._creditValueX + this._maxCreditValueWidth / 2 - this._txtValue.width / 2;
            this._txtValue.x = loc2;
            return;
        }

        internal var _txtWord:flash.text.TextField;

        internal var _txtValue:flash.text.TextField;

        internal var _alternateV:__AS3__.vec.Vector.<String>;

        internal var _timer:flash.utils.Timer;

        internal var _staticValue:String;

        internal var _alternateIndex:int;

        internal var _maxCreditWordWidth:int=0;

        internal var _maxCreditValueWidth:int=0;

        internal var _creditValueX:int=0;

        internal var _creditWordX:int=0;
    }
}


//                package externalSites
//                  class ExternalSite
package mgs.aurora.modules.framesBuilder.model.frames.controls.externalSites 
{
    import flash.display.*;
    import flash.events.*;
    import flash.net.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.common.interfaces.loader.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.framesBuilder.model.frames.events.*;
    
    public class ExternalSite extends flash.events.EventDispatcher
    {
        public function ExternalSite(arg1:flash.display.DisplayObjectContainer, arg2:XML, arg3:mgs.aurora.common.interfaces.frames.frame.assets.IToolTip)
        {
            super();
            this._site = arg2;
            this._base = arg1;
            this._tooltip = arg3;
            return;
        }

        public function dispose():void
        {
            mgs.aurora.common.utilities.EventUtils.removeMouseEventsFromSingleMethod(this._base, this.onMouseEvent);
            this._base.removeChild(this._icon);
            return;
        }

        public function initialize(arg1:mgs.aurora.common.interfaces.loader.IDependenciesConfig):void
        {
            var loc1:*=new flash.net.URLRequest("System/Aurora/" + arg1.getVersionedFilename(this._site.@iconURL));
            var loc2:*=new flash.display.Loader();
            loc2.contentLoaderInfo.addEventListener(flash.events.Event.COMPLETE, this.onLoaded);
            loc2.load(loc1);
            return;
        }

        internal function onLoaded(arg1:flash.events.Event):void
        {
            var loc1:*=arg1.target as flash.display.LoaderInfo;
            this._icon = this._base.addChild(loc1.content);
            flash.display.MovieClip(this._base).buttonMode = true;
            flash.display.MovieClip(this._base).useHandCursor = true;
            mgs.aurora.common.utilities.EventUtils.addMouseEventsToSingleMethod(this._base, this.onMouseEvent);
            this.dispatchEvent(new mgs.aurora.modules.framesBuilder.model.frames.events.ExternalSiteEvent(mgs.aurora.modules.framesBuilder.model.frames.events.ExternalSiteEvent.EXTERNAL_SITE_INITIALIZED));
            return;
        }

        internal function onMouseEvent(arg1:flash.events.MouseEvent):void
        {
            var loc1:*=arg1.type;
            switch (loc1) 
            {
                case flash.events.MouseEvent.MOUSE_OVER:
                {
                    this._tooltip.show(this._site.@tooltip);
                    break;
                }
                case flash.events.MouseEvent.MOUSE_OUT:
                {
                    this._tooltip.remove();
                    break;
                }
            }
            this.dispatchEvent(mgs.aurora.common.utilities.EventUtils.nativeMouseEventToSystemMouseEvent(arg1, this._site.@name));
            return;
        }

        internal var _site:XML;

        internal var _base:flash.display.DisplayObjectContainer;

        internal var _icon:flash.display.DisplayObject;

        internal var _tooltip:mgs.aurora.common.interfaces.frames.frame.assets.IToolTip;
    }
}


//                  class ExternalSitesManager
package mgs.aurora.modules.framesBuilder.model.frames.controls.externalSites 
{
    import __AS3__.vec.*;
    import flash.events.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.common.interfaces.loader.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.framesBuilder.model.frames.events.*;
    
    public class ExternalSitesManager extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.frames.frame.assets.IExternalSites
    {
        public function ExternalSitesManager(arg1:__AS3__.vec.Vector.<flash.display.DisplayObjectContainer>, arg2:mgs.aurora.common.interfaces.frames.frame.assets.IToolTip)
        {
            super();
            this._externalSitesIcons = arg1;
            this._tooltip = arg2;
            return;
        }

        public function configuration(arg1:XML, arg2:mgs.aurora.common.interfaces.loader.IDependenciesConfig):void
        {
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=false;
            var loc6:*=null;
            this._dependeciesConfig = arg2;
            this._externalSites = new Vector.<mgs.aurora.modules.framesBuilder.model.frames.controls.externalSites.ExternalSite>();
            this._config = arg1;
            var loc1:*="," + this._config.@excludeList + ",";
            var loc2:*=0;
            var loc7:*=0;
            var loc8:*=this._config.site;
            for each (loc3 in loc8) 
            {
                if (!(loc2 < this.MAX_ICONS)) 
                {
                    continue;
                }
                loc4 = String(loc3.@name).toLowerCase();
                loc5 = !(loc1.indexOf("," + loc4 + ",") == -1);
                if (!(!(loc4 == "") && !loc5)) 
                {
                    continue;
                }
                (loc6 = new mgs.aurora.modules.framesBuilder.model.frames.controls.externalSites.ExternalSite(this._externalSitesIcons[loc2], loc3, this._tooltip)).addEventListener(mgs.aurora.modules.framesBuilder.model.frames.events.ExternalSiteEvent.EXTERNAL_SITE_INITIALIZED, this.onSiteIconLoad);
                mgs.aurora.common.utilities.EventUtils.addSystemMouseEventsToSingleMethod(loc6, super.dispatchEvent);
                this._externalSites.push(loc6);
                ++loc2;
            }
            if (loc2 > 0) 
            {
                this._iconLoadIndex = 0;
                this._externalSites[this._iconLoadIndex].initialize(arg2);
            }
            return;
        }

        internal function onSiteIconLoad(arg1:mgs.aurora.modules.framesBuilder.model.frames.events.ExternalSiteEvent):void
        {
            var loc1:*;
            var loc2:*=((loc1 = this)._iconLoadIndex + 1);
            loc1._iconLoadIndex = loc2;
            if (this._iconLoadIndex < this._externalSites.length) 
            {
                this._externalSites[this._iconLoadIndex].initialize(this._dependeciesConfig);
            }
            return;
        }

        public function dispose():void
        {
            var loc1:*=0;
            while (loc1 < this._externalSites.length) 
            {
                this._externalSites[loc1].dispose();
                ++loc1;
            }
            return;
        }

        internal const MAX_ICONS:int=5;

        internal var _externalSitesIcons:__AS3__.vec.Vector.<flash.display.DisplayObjectContainer>;

        internal var _externalSites:__AS3__.vec.Vector.<mgs.aurora.modules.framesBuilder.model.frames.controls.externalSites.ExternalSite>;

        internal var _config:XML;

        internal var _tooltip:mgs.aurora.common.interfaces.frames.frame.assets.IToolTip;

        internal var _iconLoadIndex:int;

        internal var _dependeciesConfig:mgs.aurora.common.interfaces.loader.IDependenciesConfig;
    }
}


//                package graphics
//                  class GraphicControl
package mgs.aurora.modules.framesBuilder.model.frames.controls.graphics 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    
    public class GraphicControl extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IGraphic, mgs.aurora.common.interfaces.controls.ICustomControl
    {
        public function GraphicControl(arg1:flash.display.MovieClip)
        {
            super();
            this.displayObject = arg1;
            return;
        }

        public function get text():String
        {
            return "";
        }

        public function set text(arg1:String):void
        {
            return;
        }

        public function get graphicType():String
        {
            return this._graphicType;
        }

        public function set graphicType(arg1:String):void
        {
            this._graphicType = arg1;
            return;
        }

        public function set scaleX(arg1:Number):void
        {
            this._displayObject.scaleX = arg1;
            return;
        }

        public function get displayObject():flash.display.MovieClip
        {
            return this._displayObject;
        }

        public function set displayObject(arg1:flash.display.MovieClip):void
        {
            this._displayObject = arg1;
            return;
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return this._displayObject;
        }

        public function get scaleX():Number
        {
            return this._displayObject.scaleX;
        }

        public function drawGraphic(arg1:XML, arg2:XMLList, arg3:flash.display.LoaderInfo):void
        {
            this._graphicType = arg1.@graphicType;
            var loc1:*=arg1.@graphicType + arg1.@linkage.toString();
            var loc2:*;
            (loc2 = mgs.aurora.common.utilities.GraphicsUtils.getMovieClipFromLibrary(loc1, arg3)).x = 0;
            loc2.y = 0;
            this._displayObject.addChild(loc2);
            return;
        }

        public function get scaleY():Number
        {
            return this._displayObject.scaleY;
        }

        public function set scaleY(arg1:Number):void
        {
            this._displayObject.scaleY = arg1;
            return;
        }

        public function get id():String
        {
            return this._id;
        }

        public function set id(arg1:String):void
        {
            this._displayObject.name = arg1;
            this._id = arg1;
            return;
        }

        public function get type():String
        {
            return this._type;
        }

        public function set type(arg1:String):void
        {
            this._type = arg1;
            return;
        }

        public function get x():Number
        {
            return this._displayObject.x;
        }

        public function set x(arg1:Number):void
        {
            this._displayObject.x = arg1;
            return;
        }

        public function get y():Number
        {
            return this._displayObject.y;
        }

        public function set y(arg1:Number):void
        {
            this._displayObject.y = arg1;
            return;
        }

        public function get width():Number
        {
            return this._displayObject.width;
        }

        public function set width(arg1:Number):void
        {
            this._displayObject.width = arg1;
            return;
        }

        public function get height():Number
        {
            return this._displayObject.height;
        }

        public function set height(arg1:Number):void
        {
            this._displayObject.height = arg1;
            return;
        }

        public function get enabled():Boolean
        {
            return this._displayObject.enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            if (!this.visible) 
            {
                return;
            }
            this._displayObject.enabled = arg1;
            this.locked = !this._displayObject.enabled;
            return;
        }

        public function get visible():Boolean
        {
            return this._displayObject.visible;
        }

        public function set visible(arg1:Boolean):void
        {
            this._displayObject.visible = arg1;
            return;
        }

        public function get hitTest():Boolean
        {
            return mgs.aurora.common.utilities.GraphicsUtils.hitTestMouse(this._displayObject);
        }

        public function get filters():Array
        {
            return new Array();
        }

        public function set filters(arg1:Array):void
        {
            return;
        }

        public function get alpha():Number
        {
            return this._displayObject.alpha;
        }

        public function set alpha(arg1:Number):void
        {
            this._displayObject.alpha = arg1;
            return;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            arg1.addChild(this._displayObject);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            arg1.addChildAt(this._displayObject, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            this._displayObject.parent.removeChild(this._displayObject);
            return;
        }

        public function dispose():void
        {
            return;
        }

        public function get locked():Boolean
        {
            return this._locked;
        }

        public function set locked(arg1:Boolean):void
        {
            this._locked = arg1;
            return;
        }

        internal var _displayObject:flash.display.MovieClip;

        internal var _id:String;

        internal var _type:String;

        internal var _graphicType:String;

        internal var _locked:Boolean;
    }
}


//                  class GraphicGroup
package mgs.aurora.modules.framesBuilder.model.frames.controls.graphics 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class GraphicGroup extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IControlGroup
    {
        public function GraphicGroup(arg1:String, arg2:mgs.aurora.common.interfaces.controls.IControlManager)
        {
            super();
            this._id = arg1;
            this._controlManager = arg2;
            this._graphicList = new flash.utils.Dictionary();
            return;
        }

        public function get id():String
        {
            return this._id;
        }

        public function linkToGroup(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (!this._graphicList.hasOwnProperty(loc1[loc3])) 
                {
                    this._graphicList[loc1[loc3]] = loc1[loc3];
                }
                ++loc3;
            }
            return;
        }

        public function unlinkFromGroup(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._graphicList.hasOwnProperty(loc1[loc3])) 
                {
                    delete this._graphicList[loc1[loc3]];
                }
                ++loc3;
            }
            return;
        }

        public function enableControls(arg1:String):void
        {
            this._controlManager.enableControls(arg1);
            return;
        }

        public function enableAllControls():void
        {
            this._controlManager.enableControls(this.getAllControlIds());
            return;
        }

        public function disableControls(arg1:String):void
        {
            this._controlManager.disableControls(arg1);
            return;
        }

        public function disableAllControls():void
        {
            this._controlManager.disableControls(this.getAllControlIds());
            return;
        }

        public function showControls(arg1:String):void
        {
            this._controlManager.showControls(arg1);
            return;
        }

        public function showAllControls():void
        {
            this._controlManager.showControls(this.getAllControlIds());
            return;
        }

        public function hideControls(arg1:String):void
        {
            this._controlManager.hideControls(arg1);
            return;
        }

        public function hideAllControls():void
        {
            this._controlManager.hideControls(this.getAllControlIds());
            return;
        }

        public function getControl(arg1:String):mgs.aurora.common.interfaces.controls.IControl
        {
            return this._controlManager.getControl(arg1);
        }

        public function hasControls(arg1:String):Boolean
        {
            var loc1:*="";
            var loc2:*=arg1.split(",");
            var loc3:*=loc2.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (this._graphicList.hasOwnProperty(loc2[loc4])) 
                {
                    loc1 = loc1 + (loc2[loc4] + ",");
                }
                ++loc4;
            }
            return arg1 == loc1.slice(0, (loc1.length - 1));
        }

        public function get enabledList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._graphicList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (!loc3.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get disabledList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._graphicList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (loc3.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get visibleList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._graphicList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (!loc3.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get hiddenList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._graphicList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (loc3.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function getAllControlIds():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._graphicList;
            for each (loc2 in loc4) 
            {
                loc1 = loc1 + (loc2 + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        internal var _graphicList:flash.utils.Dictionary;

        internal var _controlManager:mgs.aurora.common.interfaces.controls.IControlManager;

        internal var _id:String;
    }
}


//                  class GraphicManager
package mgs.aurora.modules.framesBuilder.model.frames.controls.graphics 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class GraphicManager extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IControlManager
    {
        public function GraphicManager()
        {
            super();
            this._groupList = new flash.utils.Dictionary();
            this._grahpicRefs = new flash.utils.Dictionary();
            this._lockedStateHistory = new flash.utils.Dictionary();
            this._allControlsLocked = false;
            return;
        }

        public function get disabledList():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._grahpicRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (loc2.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get visibleList():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._grahpicRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (!loc2.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get hiddenList():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._grahpicRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (loc2.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        internal function unLinkFromAllGroups(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._groupList;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.unlinkFromGroup(arg1);
            }
            return;
        }

        public function getGroup(arg1:String):mgs.aurora.common.interfaces.controls.IControlGroup
        {
            return this._groupList[arg1] as mgs.aurora.common.interfaces.controls.IControlGroup;
        }

        public function createGroups(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=arg1.split(",");
            for each (loc1 in loc3) 
            {
                this._groupList[loc1] = new mgs.aurora.modules.framesBuilder.model.frames.controls.graphics.GraphicGroup(loc1, this as mgs.aurora.common.interfaces.controls.IControlManager);
            }
            return;
        }

        public function removeGroups(arg1:String):void
        {
            var loc4:*=null;
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if ((loc4 = this._groupList[loc1[loc3]] as mgs.aurora.modules.framesBuilder.model.frames.controls.graphics.GraphicGroup) != null) 
                {
                    loc4.unlinkFromGroup(loc4.getAllControlIds());
                    delete this._groupList[loc1[loc3]];
                }
                ++loc3;
            }
            return;
        }

        public function removeAllGroups():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._groupList;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.unlinkFromGroup(loc1.getAllControlIds());
                delete this._groupList[loc1.id];
            }
            this._groupList = new flash.utils.Dictionary();
            return;
        }

        public function hasGroups(arg1:String):Boolean
        {
            var loc1:*="";
            var loc2:*=arg1.split(",");
            var loc3:*=loc2.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (this._groupList.hasOwnProperty(loc2[loc4])) 
                {
                    loc1 = loc1 + (loc2[loc4] + ",");
                }
                ++loc4;
            }
            return arg1 == loc1.slice(0, (loc1.length - 1));
        }

        public function linkControlsToGroups(arg1:String, arg2:String):void
        {
            var loc1:*=arg2.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._groupList.hasOwnProperty(loc1[loc3])) 
                {
                    if (this._groupList[loc1[loc3]] != null) 
                    {
                        mgs.aurora.modules.framesBuilder.model.frames.controls.graphics.GraphicGroup(this._groupList[loc1[loc3]]).linkToGroup(arg1);
                    }
                }
                ++loc3;
            }
            return;
        }

        public function unlinkControlsFromGroups(arg1:String, arg2:String):void
        {
            var loc1:*=arg2.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._groupList.hasOwnProperty(loc1[loc3])) 
                {
                    if (this._groupList[loc1[loc3]] != null) 
                    {
                        mgs.aurora.modules.framesBuilder.model.frames.controls.graphics.GraphicGroup(this._groupList[loc1[loc3]]).unlinkFromGroup(arg1);
                    }
                }
                ++loc3;
            }
            return;
        }

        public function addControl(arg1:mgs.aurora.common.interfaces.controls.ICustomControl, arg2:flash.display.DisplayObjectContainer, arg3:String=null):void
        {
            var loc1:*=null;
            if (this._grahpicRefs.hasOwnProperty(arg1.id)) 
            {
                Debugger.trace("GraphicManager :: addControl - \"" + arg1.id + "\" already exists in list", "SYSTEM - Frames Error");
                return;
            }
            this._grahpicRefs[arg1.id] = arg1;
            if (arg3 != null) 
            {
                var loc2:*=0;
                var loc3:*=arg3.split(",");
                for each (loc1 in loc3) 
                {
                    if (!this._groupList.hasOwnProperty(loc1)) 
                    {
                        this.createGroups(loc1);
                    }
                    mgs.aurora.modules.framesBuilder.model.frames.controls.graphics.GraphicGroup(this._groupList[loc1]).linkToGroup(arg1.id);
                }
            }
            arg1.locked = this._allControlsLocked;
            arg1.addToContainer(arg2);
            return;
        }

        public function addControls(arg1:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.ICustomControl>, arg2:flash.display.DisplayObjectContainer, arg3:String=null):void
        {
            var loc1:*=arg1.length;
            var loc2:*=0;
            while (loc2 < loc1) 
            {
                this.addControl(arg1[loc2], arg2, arg3);
                ++loc2;
            }
            return;
        }

        public function removeControls(arg1:String):void
        {
            var loc4:*=null;
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            this.unLinkFromAllGroups(arg1);
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if ((loc4 = this._grahpicRefs[loc1[loc3]]) != null) 
                {
                    loc4.removeFromContainer();
                    delete this._grahpicRefs[loc1[loc3]];
                }
                ++loc3;
            }
            return;
        }

        public function removeAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._grahpicRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                this.unLinkFromAllGroups(loc1.id);
                loc1.removeFromContainer();
                delete this._grahpicRefs[loc1.id];
            }
            this._grahpicRefs = new flash.utils.Dictionary();
            return;
        }

        public function lockAllControls(arg1:Boolean=true):void
        {
            var loc1:*=null;
            this._allControlsLocked = true;
            var loc2:*=0;
            var loc3:*=this._grahpicRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.locked = true;
            }
            return;
        }

        public function unlockAllControls(arg1:Boolean=true):void
        {
            var loc1:*=null;
            this._allControlsLocked = false;
            var loc2:*=0;
            var loc3:*=this._grahpicRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.locked = false;
            }
            return;
        }

        public function enableControls(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._grahpicRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.ICustomControl(this._grahpicRefs[loc1[loc3]]).enabled = true;
                }
                ++loc3;
            }
            return;
        }

        public function enableAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._grahpicRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.enabled = true;
            }
            return;
        }

        public function disableControls(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._grahpicRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.ICustomControl(this._grahpicRefs[loc1[loc3]]).enabled = false;
                }
                ++loc3;
            }
            return;
        }

        public function disableAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._grahpicRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.enabled = true;
            }
            return;
        }

        public function showControls(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._grahpicRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.IControl(this._grahpicRefs[loc1[loc3]]).visible = true;
                }
                ++loc3;
            }
            return;
        }

        public function showAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._grahpicRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.visible = true;
            }
            return;
        }

        public function hideControls(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._grahpicRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.IControl(this._grahpicRefs[loc1[loc3]]).visible = false;
                }
                ++loc3;
            }
            return;
        }

        public function hideAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._grahpicRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.visible = false;
            }
            return;
        }

        public function getControl(arg1:String):mgs.aurora.common.interfaces.controls.IControl
        {
            return this._grahpicRefs[arg1];
        }

        public function hasControls(arg1:String):Boolean
        {
            var loc1:*="";
            var loc2:*=arg1.split(",");
            var loc3:*=loc2.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (this._grahpicRefs.hasOwnProperty(loc2[loc4])) 
                {
                    loc1 = loc1 + (loc2[loc4] + ",");
                }
                ++loc4;
            }
            return arg1 == loc1.slice(0, (loc1.length - 1));
        }

        public function changeControl(arg1:String, arg2:String, arg3:String=""):void
        {
            return;
        }

        public function get enabledList():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._grahpicRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (!loc2.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        internal var _groupList:flash.utils.Dictionary;

        internal var _grahpicRefs:flash.utils.Dictionary;

        internal var _lockedStateHistory:flash.utils.Dictionary;

        internal var _allControlsLocked:Boolean;
    }
}


//                package heading
//                  class FrameHeadings
package mgs.aurora.modules.framesBuilder.model.frames.controls.heading 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import flash.geom.*;
    import flash.text.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.common.utilities.*;
    
    public class FrameHeadings extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.frames.frame.assets.IFrameHeading
    {
        public function FrameHeadings(arg1:flash.text.TextField, arg2:flash.display.MovieClip)
        {
            super();
            this._textField = arg1;
            this._backGround = arg2;
            this.defaultTextFormat = this._textField.getTextFormat();
            this._originalTextColor = this._textField.textColor;
            return;
        }

        public function set textVisible(arg1:Boolean):void
        {
            this._textField.visible = arg1;
            return;
        }

        public function get textVisible():Boolean
        {
            return this._textField.visible;
        }

        public function movebackGround(arg1:flash.geom.Point):void
        {
            this._backGround.x = arg1.x;
            this._backGround.y = arg1.y;
            return;
        }

        public function moveText(arg1:flash.geom.Point):void
        {
            this._textField.x = arg1.x;
            this._textField.y = arg1.y;
            return;
        }

        public function dispose():void
        {
            this.stop();
            return;
        }

        public function get defaultTextFormat():flash.text.TextFormat
        {
            return this._defaultTextFormat;
        }

        public function set defaultTextFormat(arg1:flash.text.TextFormat):void
        {
            this._defaultTextFormat = arg1;
            return;
        }

        public function get properties():mgs.aurora.common.interfaces.controls.ITextFieldProperties
        {
            return null;
        }

        public function getTextFormat(arg1:int=-1, arg2:int=-1):flash.text.TextFormat
        {
            return this._textField.getTextFormat(arg1, arg2);
        }

        public function set underline(arg1:Boolean):void
        {
            this._underline = arg1;
            var loc1:*=this._textField.getTextFormat();
            loc1.underline = this._underline;
            this._textField.setTextFormat(loc1);
            return;
        }

        public function setTextFormat(arg1:flash.text.TextFormat, arg2:int=-1, arg3:int=-1):void
        {
            this._textField.setTextFormat(arg1, arg2, arg3);
            return;
        }

        public function get x():Number
        {
            return this._backGround.x;
        }

        public function set x(arg1:Number):void
        {
            if (!this._titlemoved) 
            {
                this._originalPoint = new flash.geom.Point(this._backGround.x, this._backGround.y);
                this._titlebackgroundOffset = new flash.geom.Point(this._textField.x - this._backGround.x, this._textField.y - this._backGround.y);
                this._titlemoved = true;
            }
            this._backGround.x = arg1;
            this._textField.x = this._titlebackgroundOffset.x + arg1;
            return;
        }

        public function get y():Number
        {
            return this._backGround.y;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            return;
        }

        public function removeFromContainer():void
        {
            return;
        }

        public function get height():Number
        {
            return 0;
        }

        public function set height(arg1:Number):void
        {
            return;
        }

        public function get width():Number
        {
            return 0;
        }

        public function set width(arg1:Number):void
        {
            return;
        }

        internal function start():void
        {
            this._currentIndex = 0;
            this._timer = new flash.utils.Timer(this._currentInterval);
            this._timer.addEventListener(flash.events.TimerEvent.TIMER, this.onTimer);
            this._timer.start();
            return;
        }

        internal function stop():void
        {
            if (this._timer != null) 
            {
                this._timer.stop();
                this._timer.removeEventListener(flash.events.TimerEvent.TIMER, this.onTimer);
                this._timer = null;
            }
            return;
        }

        internal function onTimer(arg1:flash.events.TimerEvent):void
        {
            this._text = this._currentCollection[this._currentIndex];
            this._textField.text = this._text;
            var loc1:*;
            var loc2:*=((loc1 = this)._currentIndex + 1);
            loc1._currentIndex = loc2;
            if (this._currentIndex == this._currentCollection.length) 
            {
                this._currentIndex = 0;
            }
            return;
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return null;
        }

        public function get filters():Array
        {
            return new Array();
        }

        public function set filters(arg1:Array):void
        {
            return;
        }

        public function get alpha():Number
        {
            return 100;
        }

        public function set alpha(arg1:Number):void
        {
            return;
        }

        public function set alternatingIntervalSize(arg1:int):void
        {
            this._currentInterval = arg1;
            return;
        }

        public function get alternatingIntervalSize():int
        {
            return this._currentInterval;
        }

        public function set alternatingText(arg1:__AS3__.vec.Vector.<String>):void
        {
            this._currentCollection = arg1;
            return;
        }

        public function get alternatingText():__AS3__.vec.Vector.<String>
        {
            return this._currentCollection;
        }

        public function get bold():Boolean
        {
            return this._bold;
        }

        public function set bold(arg1:Boolean):void
        {
            this._bold = arg1;
            var loc1:*=this._textField.getTextFormat();
            loc1.bold = this._bold;
            this._textField.setTextFormat(loc1);
            return;
        }

        public function get color():uint
        {
            return this._color;
        }

        public function set color(arg1:uint):void
        {
            this._color = arg1;
            this._textField.textColor = this._color;
            return;
        }

        public function get italic():Boolean
        {
            return this._italic;
        }

        public function set italic(arg1:Boolean):void
        {
            this._italic = arg1;
            var loc1:*=this._textField.getTextFormat();
            loc1.italic = this._italic;
            this._textField.setTextFormat(loc1);
            return;
        }

        public function get text():String
        {
            return this._text;
        }

        public function set text(arg1:String):void
        {
            this.stop();
            this._text = arg1;
            this._textField.text = this._text;
            return;
        }

        public function get underline():Boolean
        {
            return this._underline;
        }

        public function set y(arg1:Number):void
        {
            if (!this._titlemoved) 
            {
                this._originalPoint = new flash.geom.Point(this._backGround.x, this._backGround.y);
                this._titlebackgroundOffset = new flash.geom.Point(this._textField.x - this._backGround.x, this._textField.y - this._backGround.y);
                this._titlemoved = true;
            }
            this._backGround.y = arg1;
            this._textField.y = this._titlebackgroundOffset.y + arg1;
            return;
        }

        public function get enabled():Boolean
        {
            return this._enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            var loc1:*;
            this._enabled = loc1 = arg1;
            this._backGround.enabled = loc1 = loc1;
            this._textField.mouseWheelEnabled = loc1 = loc1;
            this._textField.mouseEnabled = loc1;
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

        public function get type():String
        {
            return this._type;
        }

        public function set type(arg1:String):void
        {
            this._type = arg1;
            return;
        }

        public function get visible():Boolean
        {
            return this._visible;
        }

        public function set visible(arg1:Boolean):void
        {
            var loc1:*;
            this._backGround.visible = loc1 = arg1;
            this._textField.visible = loc1 = loc1;
            this._visible = loc1;
            return;
        }

        public function alternateText(arg1:__AS3__.vec.Vector.<String>, arg2:int):void
        {
            this.stop();
            this._currentCollection = arg1;
            this._currentInterval = arg2;
            this.start();
            return;
        }

        public function reset():void
        {
            this.systemAlternateText(this._systemAlternatingText, this._systemAlternatingInterval);
            return;
        }

        public function set alignText(arg1:String):void
        {
            this._alignText = arg1;
            var loc1:*=this._textField.getTextFormat();
            loc1.align = this._alignText;
            this._textField.setTextFormat(loc1);
            return;
        }

        public function get alignText():String
        {
            return this._alignText;
        }

        public function restoreTitleDisplay():void
        {
            var loc1:*=null;
            if (this._titlemoved) 
            {
                loc1 = new flash.geom.Point(this._titlebackgroundOffset.x + this._originalPoint.x, this._titlebackgroundOffset.y + this._originalPoint.y);
                this.movebackGround(this._originalPoint);
                this.moveText(loc1);
                this._titlemoved = false;
            }
            this.color = this._originalTextColor;
            this._textField.setTextFormat(this.defaultTextFormat);
            this._visible = true;
            this.backGroundVisible = true;
            this.textVisible = true;
            return;
        }

        public function restoreTitleColour():void
        {
            this.color = this._originalTextColor;
            return;
        }

        public function systemAlternateText(arg1:__AS3__.vec.Vector.<String>, arg2:int):void
        {
            this.stop();
            this._systemAlternatingText = arg1;
            this._systemAlternatingInterval = arg2;
            this._currentCollection = this._systemAlternatingText;
            this._currentInterval = this._systemAlternatingInterval;
            this.start();
            return;
        }

        public function get hitTest():Boolean
        {
            return mgs.aurora.common.utilities.GraphicsUtils.hitTestMouse(this._backGround);
        }

        public function set backGroundVisible(arg1:Boolean):void
        {
            if (this._backGround != null) 
            {
                this._backGround.visible = arg1;
            }
            return;
        }

        public function get backGroundVisible():Boolean
        {
            return this._backGround.visible;
        }

        internal var _backGround:flash.display.MovieClip;

        internal var _textField:flash.text.TextField;

        internal var _systemAlternatingText:__AS3__.vec.Vector.<String>;

        internal var _systemAlternatingInterval:int;

        internal var _frameHeadingsMc:flash.display.MovieClip;

        internal var _bold:Boolean;

        internal var _color:uint;

        internal var _italic:Boolean;

        internal var _underline:Boolean;

        internal var _id:String;

        internal var _type:String;

        internal var _visible:Boolean;

        internal var _text:String;

        internal var _timer:flash.utils.Timer;

        internal var _currentIndex:int;

        internal var _currentCollection:__AS3__.vec.Vector.<String>;

        internal var _currentInterval:int;

        internal var _alignText:String;

        internal var _titlemoved:Boolean=false;

        internal var _originalPoint:flash.geom.Point;

        internal var _titlebackgroundOffset:flash.geom.Point;

        internal var _originalTextColor:uint;

        internal var _defaultTextFormat:flash.text.TextFormat;

        internal var _enabled:Boolean;
    }
}


//                package quickMute
//                  class QuickMute
package mgs.aurora.modules.framesBuilder.model.frames.controls.quickMute 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.enums.frame.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.common.utilities.*;
    
    public class QuickMute extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.frames.frame.assets.IQuickMute
    {
        public function QuickMute(arg1:flash.display.MovieClip)
        {
            super();
            this._quickMute = arg1;
            this._id = mgs.aurora.common.enums.frame.ControlIdentifiers.QUICKMUTE;
            this._type = this.TYPE;
            var loc1:*;
            this._quickMute.useHandCursor = loc1 = true;
            this._quickMute.buttonMode = loc1;
            this.addListeners();
            return;
        }

        public function get text():String
        {
            return "";
        }

        public function set text(arg1:String):void
        {
            return;
        }

        internal function addListeners():void
        {
            mgs.aurora.common.utilities.EventUtils.addMouseEventsToSingleMethod(this._quickMute, this.onEvent);
            return;
        }

        internal function removeListeners():void
        {
            mgs.aurora.common.utilities.EventUtils.removeMouseEventsFromSingleMethod(this._quickMute, this.onEvent);
            return;
        }

        internal function onEvent(arg1:flash.events.MouseEvent):void
        {
            if (this.locked) 
            {
                return;
            }
            if (arg1.type == flash.events.MouseEvent.CLICK) 
            {
                if (this.state != mgs.aurora.common.enums.frame.QuickMuteFrameLabels.OFF) 
                {
                    if (this.state == mgs.aurora.common.enums.frame.QuickMuteFrameLabels.ON) 
                    {
                        this.off();
                    }
                }
                else 
                {
                    this.on();
                }
            }
            this.dispatchEvent(mgs.aurora.common.utilities.EventUtils.nativeMouseEventToSystemMouseEvent(arg1, this._id));
            return;
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return this._quickMute;
        }

        public function get filters():Array
        {
            return new Array();
        }

        public function set filters(arg1:Array):void
        {
            return;
        }

        public function get alpha():Number
        {
            return 100;
        }

        public function set alpha(arg1:Number):void
        {
            return;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            arg1.addChild(this._quickMute);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            arg1.addChildAt(this._quickMute, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            this._quickMute.parent.removeChild(this._quickMute);
            return;
        }

        public function get hitTest():Boolean
        {
            return mgs.aurora.common.utilities.GraphicsUtils.hitTestMouse(this._quickMute);
        }

        public function get height():Number
        {
            return this._quickMute.height;
        }

        public function set height(arg1:Number):void
        {
            this._quickMute.height = arg1;
            return;
        }

        public function get locked():Boolean
        {
            return this._locked;
        }

        public function set locked(arg1:Boolean):void
        {
            this._locked = arg1;
            return;
        }

        public function get width():Number
        {
            return this._quickMute.width;
        }

        public function set width(arg1:Number):void
        {
            this._quickMute.width = arg1;
            return;
        }

        public function get x():Number
        {
            return this._quickMute.x;
        }

        public function set x(arg1:Number):void
        {
            this._quickMute.x = arg1;
            return;
        }

        public function get y():Number
        {
            return this._quickMute.y;
        }

        public function set y(arg1:Number):void
        {
            this._quickMute.y = arg1;
            return;
        }

        public function get enabled():Boolean
        {
            return this._quickMute.enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            this._quickMute.enabled = arg1;
            var loc1:*;
            this._quickMute.useHandCursor = loc1 = arg1;
            this._quickMute.buttonMode = loc1;
            this._locked = !this._quickMute.enabled;
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

        public function get type():String
        {
            return this._type;
        }

        public function get visible():Boolean
        {
            return this._quickMute.visible;
        }

        public function set visible(arg1:Boolean):void
        {
            this._quickMute.visible = arg1;
            return;
        }

        public function on():void
        {
            this._quickMute.gotoAndStop(mgs.aurora.common.enums.frame.QuickMuteFrameLabels.ON);
            return;
        }

        public function off():void
        {
            this._quickMute.gotoAndStop(mgs.aurora.common.enums.frame.QuickMuteFrameLabels.OFF);
            return;
        }

        public function get state():String
        {
            return this._quickMute.currentLabel;
        }

        public function dispose():void
        {
            this.removeListeners();
            return;
        }

        public const TYPE:String="Button";

        internal var _quickMute:flash.display.MovieClip;

        internal var _locked:Boolean=false;

        internal var _id:String;

        internal var _type:String;
    }
}


//                package text
//                  class TextControl
package mgs.aurora.modules.framesBuilder.model.frames.controls.text 
{
    import flash.display.*;
    import flash.events.*;
    import flash.text.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    
    public class TextControl extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IText, mgs.aurora.common.interfaces.controls.ICustomControl
    {
        public function TextControl(arg1:flash.display.MovieClip)
        {
            super();
            this.displayObject = arg1;
            return;
        }

        public function set x(arg1:Number):void
        {
            this._displayObject.x = arg1;
            this._configX = arg1;
            this.updatePosition();
            return;
        }

        public function get y():Number
        {
            return this._displayObject.y;
        }

        public function set y(arg1:Number):void
        {
            this._displayObject.y = arg1;
            this._configY = arg1;
            this.updatePosition();
            return;
        }

        public function get width():Number
        {
            return this._displayObject.width;
        }

        public function set width(arg1:Number):void
        {
            this._displayObject.width = arg1;
            return;
        }

        public function get height():Number
        {
            return this._displayObject.height;
        }

        public function get locked():Boolean
        {
            return this._locked;
        }

        public function set height(arg1:Number):void
        {
            this._displayObject.height = arg1;
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            arg1.addChildAt(this._displayObject, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            this._displayObject.parent.removeChild(this._displayObject);
            return;
        }

        public function dispose():void
        {
            return;
        }

        public function drawText(arg1:XML, arg2:XML, arg3:XML, arg4:XML, arg5:XML, arg6:XMLList):void
        {
            this._textField = new flash.text.TextField();
            this._textconfigXML = arg2.copy();
            if (arg1.@regXPosition != "") 
            {
                this._textconfigXML.@regXPosition = arg1.@regXPosition;
            }
            if (arg1.@regYPosition != "") 
            {
                this._textconfigXML.@regYPosition = arg1.@regYPosition;
            }
            this.setupTextFormats(arg3, arg4);
            this._textField.defaultTextFormat = this._enabledTextFormat;
            this._textField.width = arg2.@width;
            this._textField.height = arg2.@height;
            this._textField.x = 0;
            this._textField.y = 0;
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(arg5, this._textField);
            this._textField.text = this._text;
            this._textField.setTextFormat(this._enabledTextFormat);
            this._displayObject.addChild(this._textField);
            this.sizeandPosition();
            return;
        }

        internal function setupTextFormats(arg1:XML, arg2:XML):void
        {
            this._enabledTextFormat = new flash.text.TextFormat();
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(arg2, this._enabledTextFormat);
            return;
        }

        internal function sizeandPosition():void
        {
            this._textField.autoSize = flash.text.TextFieldAutoSize.LEFT;
            this.updatePosition();
            return;
        }

        internal function updatePosition():void
        {
            var loc1:*=String(this._textconfigXML.@regXPosition).toLowerCase();
            switch (loc1) 
            {
                case "right":
                {
                    this._displayObject.x = this._configX - this._textField.width;
                    break;
                }
                case "left":
                {
                    this._displayObject.x = this._configX;
                    break;
                }
                case "center":
                default:
                {
                    this._displayObject.x = this._configX - this._textField.width / 2;
                }
            }
            loc1 = String(this._textconfigXML.@regYPosition).toLowerCase();
            switch (loc1) 
            {
                case "bottom":
                {
                    this._displayObject.y = this._configY - this._textField.height;
                    break;
                }
                case "top":
                {
                    this._displayObject.y = this._configY + 2;
                    break;
                }
                case "center":
                case "middle":
                default:
                {
                    this._displayObject.y = this._configY - this._textField.height / 2;
                }
            }
            return;
        }

        public function get displayObject():flash.display.MovieClip
        {
            return this._displayObject;
        }

        public function set displayObject(arg1:flash.display.MovieClip):void
        {
            this._displayObject = arg1;
            return;
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return this._displayObject;
        }

        public function set shortCutKey(arg1:uint):void
        {
            return;
        }

        public function get shortCutKey():uint
        {
            return null;
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

        public function get type():String
        {
            return this._type;
        }

        public function set type(arg1:String):void
        {
            this._type = arg1;
            return;
        }

        public function get enabled():Boolean
        {
            return this._displayObject.enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            if (!this.visible) 
            {
                return;
            }
            this._displayObject.enabled = arg1;
            this.locked = !this._displayObject.enabled;
            return;
        }

        public function get visible():Boolean
        {
            return this.displayObject.visible;
        }

        public function set visible(arg1:Boolean):void
        {
            this.displayObject.visible = arg1;
            return;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            arg1.addChild(this._displayObject);
            return;
        }

        public function set locked(arg1:Boolean):void
        {
            this._locked = arg1;
            return;
        }

        public function get hitTest():Boolean
        {
            return mgs.aurora.common.utilities.GraphicsUtils.hitTestMouse(this._displayObject);
        }

        public function get filters():Array
        {
            return new Array();
        }

        public function set filters(arg1:Array):void
        {
            return;
        }

        public function get alpha():Number
        {
            return 100;
        }

        public function set alpha(arg1:Number):void
        {
            return;
        }

        public function get defaultTextFormat():flash.text.TextFormat
        {
            return this._textField.defaultTextFormat;
        }

        public function set defaultTextFormat(arg1:flash.text.TextFormat):void
        {
            this._textField.defaultTextFormat = arg1;
            return;
        }

        public function getTextFormat(arg1:int=-1, arg2:int=-1):flash.text.TextFormat
        {
            return this._textField.getTextFormat(arg1, arg2);
        }

        public function setTextFormat(arg1:flash.text.TextFormat, arg2:int=-1, arg3:int=-1):void
        {
            this._textField.setTextFormat(arg1, arg2, arg3);
            return;
        }

        public function get properties():mgs.aurora.common.interfaces.controls.ITextFieldProperties
        {
            var loc1:*=null;
            return loc1;
        }

        public function get text():String
        {
            return this._text;
        }

        public function set text(arg1:String):void
        {
            if (this._textField != null) 
            {
                this._textField.text = arg1;
                this.sizeandPosition();
            }
            this._text = arg1;
            return;
        }

        public function get x():Number
        {
            return this._displayObject.x;
        }

        internal var _displayObject:flash.display.MovieClip;

        internal var _base:flash.display.MovieClip;

        internal var _textField:flash.text.TextField;

        internal var _text:String;

        internal var _id:String;

        internal var _type:String;

        internal var _controlXML:XML;

        internal var _styleXML:XML;

        internal var _enabled:Boolean;

        internal var _enabledTextFormat:flash.text.TextFormat;

        internal var _locked:Boolean;

        internal var _textconfigXML:XML;

        internal var _configX:Number=0;

        internal var _configY:Number=0;

        internal var _html:Boolean;
    }
}


//                  class TextGroup
package mgs.aurora.modules.framesBuilder.model.frames.controls.text 
{
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class TextGroup extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IControlGroup
    {
        public function TextGroup(arg1:String, arg2:mgs.aurora.common.interfaces.controls.IControlManager)
        {
            super();
            this._id = arg1;
            this._controlManager = arg2;
            this._textList = new flash.utils.Dictionary();
            return;
        }

        public function get id():String
        {
            return this._id;
        }

        public function linkToGroup(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (!this._textList.hasOwnProperty(loc1[loc3])) 
                {
                    this._textList[loc1[loc3]] = loc1[loc3];
                }
                ++loc3;
            }
            return;
        }

        public function unlinkFromGroup(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._textList.hasOwnProperty(loc1[loc3])) 
                {
                    delete this._textList[loc1[loc3]];
                }
                ++loc3;
            }
            return;
        }

        public function enableControls(arg1:String):void
        {
            this._controlManager.enableControls(arg1);
            return;
        }

        public function enableAllControls():void
        {
            this._controlManager.enableControls(this.getAllControlIds());
            return;
        }

        public function disableControls(arg1:String):void
        {
            this._controlManager.disableControls(arg1);
            return;
        }

        public function disableAllControls():void
        {
            this._controlManager.disableControls(this.getAllControlIds());
            return;
        }

        public function showControls(arg1:String):void
        {
            this._controlManager.showControls(arg1);
            return;
        }

        public function showAllControls():void
        {
            this._controlManager.showControls(this.getAllControlIds());
            return;
        }

        public function hideControls(arg1:String):void
        {
            this._controlManager.hideControls(arg1);
            return;
        }

        public function hideAllControls():void
        {
            this._controlManager.hideControls(this.getAllControlIds());
            return;
        }

        public function getControl(arg1:String):mgs.aurora.common.interfaces.controls.IControl
        {
            return this._controlManager.getControl(arg1);
        }

        public function hasControls(arg1:String):Boolean
        {
            var loc1:*="";
            var loc2:*=arg1.split(",");
            var loc3:*=loc2.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (this._textList.hasOwnProperty(loc2[loc4])) 
                {
                    loc1 = loc1 + (loc2[loc4] + ",");
                }
                ++loc4;
            }
            return arg1 == loc1.slice(0, (loc1.length - 1));
        }

        public function get enabledList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._textList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (!loc3.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get disabledList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._textList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (loc3.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get visibleList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._textList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (!loc3.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get hiddenList():String
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*="";
            var loc4:*=0;
            var loc5:*=this._textList;
            for each (loc2 in loc5) 
            {
                loc3 = this.getControl(loc2);
                if (loc3.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc3.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function getAllControlIds():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._textList;
            for each (loc2 in loc4) 
            {
                loc1 = loc1 + (loc2 + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        internal var _textList:flash.utils.Dictionary;

        internal var _controlManager:mgs.aurora.common.interfaces.controls.IControlManager;

        internal var _id:String;
    }
}


//                  class TextsManager
package mgs.aurora.modules.framesBuilder.model.frames.controls.text 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class TextsManager extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IControlManager
    {
        public function TextsManager()
        {
            super();
            this._groupList = new flash.utils.Dictionary();
            this._textRefs = new flash.utils.Dictionary();
            this._lockedStateHistory = new flash.utils.Dictionary();
            this._allControlsLocked = false;
            return;
        }

        public function get disabledList():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._textRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (loc2.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get visibleList():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._textRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (!loc2.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        public function get hiddenList():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._textRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (loc2.visible) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        internal function unLinkFromAllGroups(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._groupList;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.unlinkFromGroup(arg1);
            }
            return;
        }

        public function getGroup(arg1:String):mgs.aurora.common.interfaces.controls.IControlGroup
        {
            return this._groupList[arg1] as mgs.aurora.common.interfaces.controls.IControlGroup;
        }

        public function createGroups(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=arg1.split(",");
            for each (loc1 in loc3) 
            {
                this._groupList[loc1] = new mgs.aurora.modules.framesBuilder.model.frames.controls.text.TextGroup(loc1, this as mgs.aurora.common.interfaces.controls.IControlManager);
            }
            return;
        }

        public function removeGroups(arg1:String):void
        {
            var loc4:*=null;
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if ((loc4 = this._groupList[loc1[loc3]] as mgs.aurora.modules.framesBuilder.model.frames.controls.text.TextGroup) != null) 
                {
                    loc4.unlinkFromGroup(loc4.getAllControlIds());
                    delete this._groupList[loc1[loc3]];
                }
                ++loc3;
            }
            return;
        }

        public function removeAllGroups():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._groupList;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.unlinkFromGroup(loc1.getAllControlIds());
                delete this._groupList[loc1.id];
            }
            this._groupList = new flash.utils.Dictionary();
            return;
        }

        public function hasGroups(arg1:String):Boolean
        {
            var loc1:*="";
            var loc2:*=arg1.split(",");
            var loc3:*=loc2.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (this._groupList.hasOwnProperty(loc2[loc4])) 
                {
                    loc1 = loc1 + (loc2[loc4] + ",");
                }
                ++loc4;
            }
            return arg1 == loc1.slice(0, (loc1.length - 1));
        }

        public function linkControlsToGroups(arg1:String, arg2:String):void
        {
            var loc1:*=arg2.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._groupList.hasOwnProperty(loc1[loc3])) 
                {
                    if (this._groupList[loc1[loc3]] != null) 
                    {
                        mgs.aurora.modules.framesBuilder.model.frames.controls.text.TextGroup(this._groupList[loc1[loc3]]).linkToGroup(arg1);
                    }
                }
                ++loc3;
            }
            return;
        }

        public function unlinkControlsFromGroups(arg1:String, arg2:String):void
        {
            var loc1:*=arg2.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._groupList.hasOwnProperty(loc1[loc3])) 
                {
                    if (this._groupList[loc1[loc3]] != null) 
                    {
                        mgs.aurora.modules.framesBuilder.model.frames.controls.text.TextGroup(this._groupList[loc1[loc3]]).unlinkFromGroup(arg1);
                    }
                }
                ++loc3;
            }
            return;
        }

        public function addControl(arg1:mgs.aurora.common.interfaces.controls.ICustomControl, arg2:flash.display.DisplayObjectContainer, arg3:String=null):void
        {
            var loc1:*=null;
            if (this._textRefs.hasOwnProperty(arg1.id)) 
            {
                return;
            }
            this._textRefs[arg1.id] = arg1;
            if (arg3 != null) 
            {
                var loc2:*=0;
                var loc3:*=arg3.split(",");
                for each (loc1 in loc3) 
                {
                    if (!this._groupList.hasOwnProperty(loc1)) 
                    {
                        this.createGroups(loc1);
                    }
                    mgs.aurora.modules.framesBuilder.model.frames.controls.text.TextGroup(this._groupList[loc1]).linkToGroup(arg1.id);
                }
            }
            arg1.locked = this._allControlsLocked;
            arg1.addToContainer(arg2);
            return;
        }

        public function addControls(arg1:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.ICustomControl>, arg2:flash.display.DisplayObjectContainer, arg3:String=null):void
        {
            var loc1:*=arg1.length;
            var loc2:*=0;
            while (loc2 < loc1) 
            {
                this.addControl(arg1[loc2], arg2, arg3);
                ++loc2;
            }
            return;
        }

        public function removeControls(arg1:String):void
        {
            var loc4:*=null;
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            this.unLinkFromAllGroups(arg1);
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if ((loc4 = this._textRefs[loc1[loc3]]) != null) 
                {
                    loc4.removeFromContainer();
                    delete this._textRefs[loc1[loc3]];
                }
                ++loc3;
            }
            return;
        }

        public function removeAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._textRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                this.unLinkFromAllGroups(loc1.id);
                loc1.removeFromContainer();
                delete this._textRefs[loc1.id];
            }
            this._textRefs = new flash.utils.Dictionary();
            return;
        }

        public function lockAllControls(arg1:Boolean=true):void
        {
            var loc1:*=null;
            this._allControlsLocked = true;
            var loc2:*=0;
            var loc3:*=this._textRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.locked = true;
            }
            return;
        }

        public function unlockAllControls(arg1:Boolean=true):void
        {
            var loc1:*=null;
            this._allControlsLocked = false;
            var loc2:*=0;
            var loc3:*=this._textRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.locked = false;
            }
            return;
        }

        public function enableControls(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._textRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.ICustomControl(this._textRefs[loc1[loc3]]).enabled = true;
                }
                ++loc3;
            }
            return;
        }

        public function enableAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._textRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.enabled = true;
            }
            return;
        }

        public function disableControls(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._textRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.ICustomControl(this._textRefs[loc1[loc3]]).enabled = false;
                }
                ++loc3;
            }
            return;
        }

        public function disableAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._textRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.enabled = true;
            }
            return;
        }

        public function showControls(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._textRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.IControl(this._textRefs[loc1[loc3]]).visible = true;
                }
                ++loc3;
            }
            return;
        }

        public function showAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._textRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.visible = true;
            }
            return;
        }

        public function hideControls(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                if (this._textRefs[loc1[loc3]] != null) 
                {
                    mgs.aurora.common.interfaces.controls.IControl(this._textRefs[loc1[loc3]]).visible = false;
                }
                ++loc3;
            }
            return;
        }

        public function hideAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._textRefs;
            for each (loc1 in loc3) 
            {
                if (loc1 == null) 
                {
                    continue;
                }
                loc1.visible = false;
            }
            return;
        }

        public function getControl(arg1:String):mgs.aurora.common.interfaces.controls.IControl
        {
            return this._textRefs[arg1];
        }

        public function hasControls(arg1:String):Boolean
        {
            var loc1:*="";
            var loc2:*=arg1.split(",");
            var loc3:*=loc2.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                if (this._textRefs.hasOwnProperty(loc2[loc4])) 
                {
                    loc1 = loc1 + (loc2[loc4] + ",");
                }
                ++loc4;
            }
            return arg1 == loc1.slice(0, (loc1.length - 1));
        }

        public function changeControl(arg1:String, arg2:String, arg3:String=""):void
        {
            return;
        }

        public function get enabledList():String
        {
            var loc2:*=null;
            var loc1:*="";
            var loc3:*=0;
            var loc4:*=this._textRefs;
            for each (loc2 in loc4) 
            {
                if (loc2 == null) 
                {
                    continue;
                }
                if (!loc2.enabled) 
                {
                    continue;
                }
                loc1 = loc1 + (loc2.id + ",");
            }
            return loc1.slice(0, (loc1.length - 1));
        }

        internal var _groupList:flash.utils.Dictionary;

        internal var _textRefs:flash.utils.Dictionary;

        internal var _lockedStateHistory:flash.utils.Dictionary;

        internal var _allControlsLocked:Boolean;
    }
}


//                package tooltip
//                  class ToolTip
package mgs.aurora.modules.framesBuilder.model.frames.controls.tooltip 
{
    import flash.display.*;
    import flash.events.*;
    import flash.geom.*;
    import flash.text.*;
    import flash.utils.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.common.utilities.*;
    
    public class ToolTip extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.frames.frame.assets.IToolTip
    {
        public function ToolTip()
        {
            super();
            return;
        }

        public function set base(arg1:flash.display.Sprite):void
        {
            this._base = arg1;
            return;
        }

        public function get base():flash.display.Sprite
        {
            return this._base;
        }

        public function configuration(arg1:XML):void
        {
            if (this._textField == null) 
            {
                this._boundaryRect = this._base.getRect(this._base);
                this._config = arg1;
                this.setupTextField();
            }
            return;
        }

        public function show(arg1:String, arg2:flash.geom.Point=null):void
        {
            this.completeRemove();
            this._textField.htmlText = arg1;
            this._textField.alpha = 0;
            this.calculatePoint(arg2);
            this._base.addChild(this._textField);
            this._transitionTimeCounter = 0;
            this._initialTimer.start();
            return;
        }

        public function update(arg1:String):void
        {
            this._initialTimer.stop();
            this._showTimer.stop();
            this._removeTimer.stop();
            this._textField.alpha = 1;
            this._textField.htmlText = arg1;
            return;
        }

        public function remove():void
        {
            if (this._showTimer.running) 
            {
                this._showTimer.reset();
                this._showTimer.stop();
            }
            this._transitionTimeCounter = Number(this._config.Remove.@delayToFullRemove);
            this._removeTimer.start();
            return;
        }

        public function dispose():void
        {
            this.remove();
            return;
        }

        internal function setupTextField():void
        {
            this._initialTimer = new flash.utils.Timer(Number(this._config.Show.@delayToStartShow));
            this._initialTimer.addEventListener(flash.events.TimerEvent.TIMER, this.onStartShow);
            this._showTimer = new flash.utils.Timer(Number(this._config.Show.@alphaChangeInterval));
            this._showTimer.addEventListener(flash.events.TimerEvent.TIMER, this.onShowTransition);
            this._removeTimer = new flash.utils.Timer(Number(this._config.Remove.@alphaChangeInterval));
            this._removeTimer.addEventListener(flash.events.TimerEvent.TIMER, this.onRemoveTransition);
            this._textField = new flash.text.TextField();
            this._textField.name = this.TEXTFIELDNAME;
            this._textField.mouseEnabled = false;
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(new XML(this._config.TextField), this._textField);
            var loc1:*=new flash.text.TextFormat();
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(new XML(this._config.TextFormat), loc1);
            this._textField.defaultTextFormat = loc1;
            return;
        }

        internal function onStartShow(arg1:flash.events.TimerEvent):void
        {
            if (!this._removeTimer.running) 
            {
                this._initialTimer.stop();
                this._showTimer.start();
            }
            return;
        }

        internal function onRemoveTransition(arg1:flash.events.TimerEvent):void
        {
            this._textField.alpha = this._textField.alpha - Number(this._config.Remove.@alphaChangeRate);
            var loc1:*=Number(this._config.Remove.@alphaChangeInterval);
            this._transitionTimeCounter = this._transitionTimeCounter - loc1;
            if (this._transitionTimeCounter <= 0) 
            {
                this.completeRemove();
            }
            return;
        }

        internal function onShowTransition(arg1:flash.events.TimerEvent):void
        {
            this._textField.alpha = this._textField.alpha + Number(this._config.Show.@alphaChangeRate);
            this._transitionTimeCounter = this._transitionTimeCounter + Number(this._config.Show.@alphaChangeInterval);
            if (this._transitionTimeCounter == Number(this._config.Show.@delayToFullDisplay)) 
            {
                this._showTimer.stop();
                this.dispatchEvent(new mgs.aurora.common.events.SystemToolTipEvent(mgs.aurora.common.events.SystemToolTipEvent.SHOWING));
            }
            return;
        }

        internal function completeRemove():void
        {
            this._initialTimer.reset();
            this._initialTimer.stop();
            this._showTimer.reset();
            this._showTimer.stop();
            this._removeTimer.reset();
            this._removeTimer.stop();
            if (this._base.getChildByName(this.TEXTFIELDNAME) != null) 
            {
                if (this._textField.parent != null) 
                {
                    this._base.removeChild(this._textField);
                    this.dispatchEvent(new mgs.aurora.common.events.SystemToolTipEvent(mgs.aurora.common.events.SystemToolTipEvent.REMOVED));
                }
            }
            return;
        }

        internal function calculatePoint(arg1:flash.geom.Point):void
        {
            if (arg1 == null) 
            {
                this._textField.x = Math.ceil(this._base.mouseX);
                this._textField.y = Math.ceil(this._base.mouseY + 21);
            }
            else 
            {
                this._textField.x = arg1.x;
                this._textField.y = arg1.y;
            }
            var loc1:*=this._textField.x + Math.round(this._textField.width + 10) - this._boundaryRect.bottomRight.x;
            var loc2:*=this._textField.y + this._textField.height - this._boundaryRect.bottomRight.y;
            if (loc1 > -10) 
            {
                this._textField.x = this._textField.x - (loc1 + 15);
            }
            if (loc2 > -10) 
            {
                this._textField.y = this._textField.y - (loc2 + 15);
            }
            return;
        }

        internal const TEXTFIELDNAME:String="txt_tooltip";

        internal var _base:flash.display.Sprite;

        internal var _config:XML;

        internal var _textField:flash.text.TextField;

        internal var _showTimer:flash.utils.Timer;

        internal var _removeTimer:flash.utils.Timer;

        internal var _initialTimer:flash.utils.Timer;

        internal var _transitionTimeCounter:Number;

        internal var _boundaryRect:flash.geom.Rectangle;
    }
}


//                class FrameControls
package mgs.aurora.modules.framesBuilder.model.frames.controls 
{
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.graphics.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.text.*;
    
    public class FrameControls extends Object implements mgs.aurora.common.interfaces.frames.frame.assets.IFrameControls
    {
        public function FrameControls()
        {
            super();
            this._buttons = new mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonManager();
            this._texts = new mgs.aurora.modules.framesBuilder.model.frames.controls.text.TextsManager();
            this._graphics = new mgs.aurora.modules.framesBuilder.model.frames.controls.graphics.GraphicManager();
            Logger.logMessage("FrameControls : FrameControls");
            return;
        }

        public function get buttons():mgs.aurora.common.interfaces.controls.IControlManager
        {
            return mgs.aurora.common.interfaces.controls.IControlManager(this._buttons);
        }

        public function get graphics():mgs.aurora.common.interfaces.controls.IControlManager
        {
            return mgs.aurora.common.interfaces.controls.IControlManager(this._graphics);
        }

        public function get texts():mgs.aurora.common.interfaces.controls.IControlManager
        {
            return mgs.aurora.common.interfaces.controls.IControlManager(this._texts);
        }

        internal var _buttons:mgs.aurora.common.interfaces.controls.IControlManager;

        internal var _graphics:mgs.aurora.common.interfaces.controls.IControlManager;

        internal var _texts:mgs.aurora.common.interfaces.controls.IControlManager;
    }
}


//              package events
//                class ExternalSiteEvent
package mgs.aurora.modules.framesBuilder.model.frames.events 
{
    import flash.events.*;
    
    public class ExternalSiteEvent extends flash.events.Event
    {
        public function ExternalSiteEvent(arg1:String, arg2:Boolean=false, arg3:Boolean=false)
        {
            super(arg1, arg2, arg3);
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.modules.framesBuilder.model.frames.events.ExternalSiteEvent(type, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("ExternalSiteEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        public static const EXTERNAL_SITE_INITIALIZED:String="External_Site_Initialized";
    }
}


//              class Frame
package mgs.aurora.modules.framesBuilder.model.frames 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import flash.text.*;
    import mgs.aurora.common.enums.raptorSession.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.frames.frame.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.modules.framesBuilder.*;
    import mgs.aurora.modules.framesBuilder.controller.utils.*;
    import mgs.aurora.modules.framesBuilder.model.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.chipSelector.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.clock.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.connectClip.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.credits.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.externalSites.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.heading.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.quickMute.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.tooltip.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.patterns.observer.*;
    
    public class Frame extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.frames.frame.IFrame
    {
        public function Frame(arg1:flash.display.MovieClip, arg2:flash.display.Sprite, arg3:XML, arg4:XML, arg5:String, arg6:String)
        {
            super();
            this._mainSprite = arg2;
            this.id = arg5;
            this._theme = arg6;
            Debugger.trace("FRAME SYSTEM : " + this._theme, "SYSTEM");
            this.initialize(arg1, arg3, arg4);
            return;
        }

        public function removeFromContainer():void
        {
            if (this._frameMc.parent != null) 
            {
                this._frameMc.parent.removeChild(this._frameMc);
            }
            return;
        }

        public function get canvas():flash.display.Sprite
        {
            return this._canvas as flash.display.Sprite;
        }

        public function get chipSelector():mgs.aurora.common.interfaces.frames.frame.assets.IChipSelector
        {
            return this._chipSelector;
        }

        public function get controls():mgs.aurora.common.interfaces.frames.frame.assets.IFrameControls
        {
            return this._controls as mgs.aurora.common.interfaces.frames.frame.assets.IFrameControls;
        }

        public function get quickMute():mgs.aurora.common.interfaces.frames.frame.assets.IQuickMute
        {
            return this._quickMute as mgs.aurora.common.interfaces.frames.frame.assets.IQuickMute;
        }

        public function get tooltip():mgs.aurora.common.interfaces.frames.frame.assets.IToolTip
        {
            return this._tooltip as mgs.aurora.common.interfaces.frames.frame.assets.IToolTip;
        }

        public function get heading():mgs.aurora.common.interfaces.frames.frame.assets.IFrameHeading
        {
            return this._headings as mgs.aurora.common.interfaces.frames.frame.assets.IFrameHeading;
        }

        public function get assetHolder():flash.display.MovieClip
        {
            return this._assetHolder;
        }

        public function get externalSitesManager():mgs.aurora.common.interfaces.frames.frame.assets.IExternalSites
        {
            return this._externalSitesManager as mgs.aurora.common.interfaces.frames.frame.assets.IExternalSites;
        }

        public function get infoTextBackGround():flash.display.MovieClip
        {
            return this._infoTextBackGround;
        }

        public function get credits():mgs.aurora.common.interfaces.frames.frame.assets.ICredits
        {
            return this._credits as mgs.aurora.common.interfaces.frames.frame.assets.ICredits;
        }

        public function get clock():mgs.aurora.common.interfaces.frames.frame.assets.IClock
        {
            return this._clock as mgs.aurora.common.interfaces.frames.frame.assets.IClock;
        }

        public function get balanceButton():mgs.aurora.common.interfaces.frames.frame.assets.IBalanceButton
        {
            return this._balanceButton as mgs.aurora.common.interfaces.frames.frame.assets.IBalanceButton;
        }

        public function get connectClip():mgs.aurora.modules.framesBuilder.model.frames.controls.connectClip.ConnectClip
        {
            return this._connectClip;
        }

        public function addGameLayout(arg1:XML):void
        {
            Debugger.trace("ButtonManager :: addGameLayout", "FRAMES");
            mgs.aurora.modules.framesBuilder.controller.utils.PureMVCUtility.sendNotification(new org.puremvc.as3.multicore.patterns.observer.Notification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.ADD_GAME_LAYOUT, arg1));
            return;
        }

        public function gameLayoutComplete():void
        {
            Debugger.trace("ButtonManager :: gameLayoutComplete", "FRAMES");
            this.dispatchEvent(new mgs.aurora.common.events.SystemFrameEvents(mgs.aurora.common.events.SystemFrameEvents.GAME_LAYOUT_COMPLETE));
            return;
        }

        public function switchComplete():void
        {
            this.dispatchEvent(new mgs.aurora.common.events.SystemFrameEvents(mgs.aurora.common.events.SystemFrameEvents.FRAME_SWITCH_COMPLETE));
            return;
        }

        public function gameFrameCleared():void
        {
            this.dispatchEvent(new mgs.aurora.common.events.SystemFrameEvents(mgs.aurora.common.events.SystemFrameEvents.GAME_LAYOUT_CLEARED));
            return;
        }

        internal function initialize(arg1:flash.display.MovieClip, arg2:XML, arg3:XML):void
        {
            var frameMc:flash.display.MovieClip;
            var displayConfigXML:XML;
            var frameLibXML:XML;
            var facade:mgs.aurora.modules.framesBuilder.FramesBuilderFacade;
            var sessionProxy:mgs.aurora.modules.framesBuilder.model.SessionProxy;
            var userType:int;
            var externalSitesV:__AS3__.vec.Vector.<flash.display.DisplayObjectContainer>;
            var obj:Object;
            var display:flash.display.DisplayObject;

            var loc1:*;
            display = null;
            frameMc = arg1;
            displayConfigXML = arg2;
            frameLibXML = arg3;
            this._frameMc = frameMc;
            this._frameMc.gotoAndStop(this._theme);
            this._displayConfigXML = displayConfigXML;
            this._frameLibXML = frameLibXML;
            this._txtCreditsWord = this._frameMc.sCreditsWord as flash.text.TextField;
            this._txtCredits = this._frameMc.sCredits as flash.text.TextField;
            this._scrollText = this._frameMc.scrolltext as flash.text.TextField;
            this._txtTime = this._frameMc.getChildByName("sTime") as flash.text.TextField;
            facade = mgs.aurora.modules.framesBuilder.FramesBuilderFacade.getInstance(mgs.aurora.modules.framesBuilder.FramesBuilder.NAME);
            sessionProxy = mgs.aurora.modules.framesBuilder.model.SessionProxy(facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.SessionProxy.NAME));
            userType = sessionProxy.userType;
            if (this._txtTime == null) 
            {
                this._txtTime = new flash.text.TextField();
                this._txtTime.name = "sTime";
                this._frameMc.addChild(this._txtTime);
            }
            this.setAllTextFormatting(displayConfigXML, frameLibXML, userType);
            this._assetHolder = this._frameMc.assetsHolder as flash.display.MovieClip;
            this._quickMute_mc = this._frameMc.quickmute as flash.display.MovieClip;
            this._tooltipHolder = this._frameMc.tooltipHolder as flash.display.MovieClip;
            this._infoTextBackGround = this._frameMc.InfoTextBackground as flash.display.MovieClip;
            this._canvas = this._frameMc.canvas as flash.display.MovieClip;
            this._balanceButtonMc = this._frameMc.BalanceButton as flash.display.MovieClip;
            this._connectClipMc = this._frameMc.ConnectClip as flash.display.MovieClip;
            externalSitesV = new Vector.<flash.display.DisplayObjectContainer>();
            externalSitesV.push(this._frameMc.Icon0 as flash.display.DisplayObjectContainer);
            externalSitesV.push(this._frameMc.Icon1 as flash.display.DisplayObjectContainer);
            externalSitesV.push(this._frameMc.Icon2 as flash.display.DisplayObjectContainer);
            externalSitesV.push(this._frameMc.Icon3 as flash.display.DisplayObjectContainer);
            externalSitesV.push(this._frameMc.Icon4 as flash.display.DisplayObjectContainer);
            obj = this.getChipSelectorTextFormats(displayConfigXML, frameLibXML);
            this._chipSelector = new mgs.aurora.modules.framesBuilder.model.frames.controls.chipSelector.ChipSelector(this._frameMc.UCS as flash.display.MovieClip, obj);
            this._chipSelector.visible = false;
            this._controls = new mgs.aurora.modules.framesBuilder.model.frames.controls.FrameControls();
            this._headings = new mgs.aurora.modules.framesBuilder.model.frames.controls.heading.FrameHeadings(this._scrollText, this._infoTextBackGround);
            this._quickMute = new mgs.aurora.modules.framesBuilder.model.frames.controls.quickMute.QuickMute(this._quickMute_mc);
            this._tooltip = new mgs.aurora.modules.framesBuilder.model.frames.controls.tooltip.ToolTip();
            try 
            {
                display = this._mainSprite.parent.parent.getChildByName("layer_tooltip");
                this._tooltip.base = display as flash.display.Sprite;
            }
            catch (e:Error)
            {
                Debugger.trace("ERROR LOCATING AND SETTING TOOLTIP LAYER");
                this._tooltip.base = this._tooltipHolder;
            }
            this._externalSitesManager = new mgs.aurora.modules.framesBuilder.model.frames.controls.externalSites.ExternalSitesManager(externalSitesV, this._tooltip as mgs.aurora.common.interfaces.frames.frame.assets.IToolTip);
            this._credits = new mgs.aurora.modules.framesBuilder.model.frames.controls.credits.Credits(this._txtCreditsWord, this._txtCredits);
            this._clock = new mgs.aurora.modules.framesBuilder.model.frames.controls.clock.Clock(this._txtTime);
            this._balanceButton = new mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.BalanceButton(this._balanceButtonMc);
            this._connectClip = new mgs.aurora.modules.framesBuilder.model.frames.controls.connectClip.ConnectClip(this._connectClipMc);
            return;
        }

        internal function setAllTextFormatting(arg1:XML, arg2:XML, arg3:int):void
        {
            this.applyTextFormatting(arg1, arg2, this._txtTime, "time");
            if (this._txtCreditsWord != null) 
            {
                this.applyTextFormatting(arg1, arg2, this._txtCreditsWord, "creditsWord");
            }
            if (this._txtCredits != null) 
            {
                this.applyTextFormatting(arg1, arg2, this._txtCredits, "credits");
                this._txtCredits.text = "999";
                this._txtCredits.y = this._txtCredits.y + Math.round((this._txtCredits.height - this._txtCredits.textHeight) / 2);
                this._txtCredits.text = "";
            }
            return;
        }

        internal function applyTextFormatting(arg1:XML, arg2:XML, arg3:flash.text.TextField, arg4:String):void
        {
            var loc2:*=null;
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
            var loc1:*;
            if ((loc1 = arg1.frame.static[arg4][this.id][0]) != null) 
            {
                loc2 = loc1.@textLayer;
                loc3 = arg2.textLayer;
                loc5 = (loc4 = this.getTextStyle(loc3, loc2)).@textFormat;
                loc6 = arg2.textFormat;
                loc7 = this.getTextFormat(loc6, loc5);
                loc8 = loc4.@textField;
                loc9 = arg2.textField;
                loc10 = this.getTextField(loc9, loc8);
                loc11 = new flash.text.TextFormat();
                if (loc7.@font != "null") 
                {
                    loc11.font = loc7.@font;
                }
                loc11.size = parseFloat(loc7.@size);
                if (loc7.@color != "null") 
                {
                    loc11.color = uint(loc7.@color);
                }
                loc12 = "color_" + this._theme;
                if (loc7.attribute(loc12).length() > 0) 
                {
                    loc11.color = uint(loc7.@[loc12]);
                }
                loc11.align = loc7.@align;
                loc11.bold = loc7.@bold == "true";
                loc11.italic = loc7.@italic == "true";
                arg3.defaultTextFormat = loc11;
                arg3.wordWrap = loc10.@wordWrap == "true";
                arg3.multiline = loc10.@multiline == "true";
                arg3.selectable = loc10.@selectable == "true";
                arg3.border = loc10.@border == "true";
                arg3.borderColor = uint(loc10.@borderColor);
                arg3.embedFonts = loc10.@embedFonts == "true";
                arg3.thickness = parseFloat(loc10.@thickness);
                arg3.antiAliasType = loc10.@antiAliasType;
                arg3.gridFitType = loc10.@gridFitType;
                arg3.autoSize = loc10.@autoSize;
                arg3.background = loc10.@background == "true";
                arg3.backgroundColor = loc10.@backgroundColor;
                arg3.x = parseFloat(loc1.@x);
                arg3.y = parseFloat(loc1.@y);
                arg3.width = parseFloat(loc1.@width);
                arg3.height = parseFloat(loc1.@height);
            }
            return;
        }

        public function set id(arg1:String):void
        {
            this._id = arg1;
            return;
        }

        internal function getTextStyle(arg1:XMLList, arg2:String):XML
        {
            var textLayerXML:XMLList;
            var textLayerId:String;
            var targetXML:XML;

            var loc1:*;
            textLayerXML = arg1;
            textLayerId = arg2;
            targetXML = new XML("<textLayer/>");
            var loc3:*=0;
            var loc4:*=textLayerXML.style;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textLayerId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textLayerXML, "style");
            return targetXML;
        }

        internal function getTextFormat(arg1:XMLList, arg2:String):XML
        {
            var textFormatXML:XMLList;
            var textFormatId:String;
            var targetXML:XML;

            var loc1:*;
            textFormatXML = arg1;
            textFormatId = arg2;
            targetXML = new XML("<textFormat/>");
            var loc3:*=0;
            var loc4:*=textFormatXML.style;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textFormatId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textFormatXML, "style");
            return targetXML;
        }

        internal function getTextField(arg1:XMLList, arg2:String):XML
        {
            var textFieldXML:XMLList;
            var textFieldId:String;
            var targetXML:XML;

            var loc1:*;
            textFieldXML = arg1;
            textFieldId = arg2;
            targetXML = new XML("<textField/>");
            var loc3:*=0;
            var loc4:*=textFieldXML.textt;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == textFieldId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            this.populateFromInheritedNode(targetXML, XML(loc2), textFieldXML, "textt");
            return targetXML;
        }

        internal function populateFromInheritedNode(arg1:XML, arg2:XML, arg3:XMLList, arg4:String):void
        {
            var targetXML:XML;
            var sourceXML:XML;
            var parentXML:XMLList;
            var targetChild:String;
            var item:XML;
            var inheritFrom:String;
            var extendFrom:XML;
            var property:String;
            var value:String;

            var loc1:*;
            item = null;
            inheritFrom = null;
            extendFrom = null;
            property = null;
            value = null;
            targetXML = arg1;
            sourceXML = arg2;
            parentXML = arg3;
            targetChild = arg4;
            if (sourceXML.@inherit != undefined) 
            {
                inheritFrom = sourceXML.@inherit;
                var loc3:*=0;
                var loc4:*=parentXML[targetChild];
                var loc2:*=new XMLList("");
                for each (var loc5:* in loc4) 
                {
                    var loc6:*;
                    with (loc6 = loc5) 
                    {
                        if (@id == inheritFrom) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                extendFrom = XML(loc2);
                this.populateFromInheritedNode(targetXML, extendFrom, parentXML, targetChild);
            }
            targetXML.appendChild(sourceXML.children());
            loc2 = 0;
            loc3 = sourceXML.attributes();
            for each (item in loc3) 
            {
                property = item.name();
                value = item.toString();
                targetXML.@[property] = value;
            }
            return;
        }

        public function updateAfterUserSwitch():void
        {
            this._txtCreditsWord = this._frameMc.sCreditsWord as flash.text.TextField;
            var loc1:*=mgs.aurora.modules.framesBuilder.FramesBuilderFacade.getInstance(mgs.aurora.modules.framesBuilder.FramesBuilder.NAME);
            var loc2:*=mgs.aurora.modules.framesBuilder.model.SessionProxy(loc1.retrieveProxy(mgs.aurora.modules.framesBuilder.model.SessionProxy.NAME));
            var loc3:*=loc2.userType;
            if (this._txtCreditsWord == null && loc3 == mgs.aurora.common.enums.raptorSession.UserTypes.FUN_BONUS) 
            {
                this._txtCreditsWord = new flash.text.TextField();
                this._txtCreditsWord.name = "creditsWord";
                this._frameMc.addChild(this._txtCreditsWord);
                this.setAllTextFormatting(this._displayConfigXML, this._frameLibXML, loc3);
                this._credits = new mgs.aurora.modules.framesBuilder.model.frames.controls.credits.Credits(this._txtCreditsWord, this._txtCredits);
            }
            return;
        }

        public function get id():String
        {
            return this._id;
        }

        internal function getChipSelectorTextFormats(arg1:XML, arg2:XML):Object
        {
            var loc1:*=arg1.ucs.fixedValue;
            var loc2:*=loc1.@textLayer;
            var loc3:*=arg2.textLayer;
            var loc4:*;
            var loc5:*=(loc4 = this.getTextStyle(loc3, loc2)).@textFormat.toString();
            var loc6:*=arg2.textFormat;
            var loc7:*=this.getTextFormat(loc6, loc5);
            var loc8:*=loc4.@textField.toString();
            var loc9:*=arg2.textField;
            var loc10:*=this.getTextField(loc9, loc8);
            var loc11:*;
            (loc11 = new Object()).textFormat = loc7;
            loc11.textProperties = loc10;
            loc11.text = loc1.@text.toString();
            loc11.textBevel = loc1.@useBevel.toString() == "1";
            loc11.width = loc1.@width.toString();
            return loc11;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            arg1.addChild(this._frameMc);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            arg1.addChildAt(this._frameMc, arg2);
            return;
        }

        internal var _mainSprite:flash.display.Sprite;

        internal var _id:String;

        internal var _frameMc:flash.display.MovieClip;

        internal var _chipSelector:mgs.aurora.modules.framesBuilder.model.frames.controls.chipSelector.ChipSelector;

        internal var _controls:mgs.aurora.modules.framesBuilder.model.frames.controls.FrameControls;

        internal var _headings:mgs.aurora.modules.framesBuilder.model.frames.controls.heading.FrameHeadings;

        internal var _connectClipMc:flash.display.MovieClip;

        internal var _infoTextBackGround:flash.display.MovieClip;

        internal var _scrollText:flash.text.TextField;

        internal var _txtCreditsWord:flash.text.TextField;

        internal var _txtCredits:flash.text.TextField;

        internal var _txtTime:flash.text.TextField;

        internal var _balanceButtonMc:flash.display.MovieClip;

        internal var _tooltipHolder:flash.display.MovieClip;

        internal var _canvas:flash.display.MovieClip;

        internal var _assetHolder:flash.display.MovieClip;

        internal var _quickMute_mc:flash.display.MovieClip;

        internal var _tooltip:mgs.aurora.modules.framesBuilder.model.frames.controls.tooltip.ToolTip;

        internal var _externalSitesManager:mgs.aurora.modules.framesBuilder.model.frames.controls.externalSites.ExternalSitesManager;

        internal var _credits:mgs.aurora.modules.framesBuilder.model.frames.controls.credits.Credits;

        internal var _balanceButton:mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.BalanceButton;

        internal var _connectClip:mgs.aurora.modules.framesBuilder.model.frames.controls.connectClip.ConnectClip;

        internal var _theme:String;

        internal var _displayConfigXML:XML;

        internal var _frameLibXML:XML;

        internal var _quickMute:mgs.aurora.modules.framesBuilder.model.frames.controls.quickMute.QuickMute;

        internal var _clock:mgs.aurora.modules.framesBuilder.model.frames.controls.clock.Clock;
    }
}


//            class ControlsConfigProxy
package mgs.aurora.modules.framesBuilder.model 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.text.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class ControlsConfigProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function ControlsConfigProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public function set art(arg1:flash.display.LoaderInfo):void
        {
            this._art = arg1;
            return;
        }

        public function get art():flash.display.LoaderInfo
        {
            return this._art;
        }

        public function set font(arg1:flash.display.LoaderInfo):void
        {
            this._font = arg1;
            return;
        }

        public function get font():flash.display.LoaderInfo
        {
            return this._font;
        }

        public function set config(arg1:XML):void
        {
            this._config = arg1;
            return;
        }

        public function get config():XML
        {
            return this._config;
        }

        public function set excludeList(arg1:__AS3__.vec.Vector.<String>):void
        {
            this._excludeList = arg1;
            return;
        }

        public function get excludeList():__AS3__.vec.Vector.<String>
        {
            return this._excludeList;
        }

        public function fontByName(arg1:String):flash.text.Font
        {
            return null;
        }

        public static const NAME:String="ControlsConfigProxy";

        internal var _art:flash.display.LoaderInfo;

        internal var _font:flash.display.LoaderInfo;

        internal var _config:XML;

        internal var _excludeList:__AS3__.vec.Vector.<String>;
    }
}


//            class ControlsProxy
package mgs.aurora.modules.framesBuilder.model 
{
    import __AS3__.vec.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.controls.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class ControlsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function ControlsProxy(arg1:Object=null)
        {
            super(NAME, new flash.utils.Dictionary());
            this._buttonVector = new Vector.<mgs.aurora.common.interfaces.controls.IButton>();
            this._textVector = new Vector.<mgs.aurora.common.interfaces.controls.IText>();
            this._graphicVector = new Vector.<mgs.aurora.common.interfaces.controls.IGraphic>();
            this._sysButtonVector = new Vector.<mgs.aurora.common.interfaces.controls.IButton>();
            return;
        }

        public function removeControl(arg1:String):void
        {
            this.controls[arg1] = null;
            delete this.controls[arg1];
            return;
        }

        public function removeControls(arg1:String):void
        {
            var loc1:*=arg1.split(",");
            var loc2:*=0;
            while (loc2 < loc1.length) 
            {
                arg1 = loc1[loc2];
                this.controls[arg1] = null;
                delete this.controls[arg1];
                ++loc2;
            }
            return;
        }

        public function removeAllControls():void
        {
            this.data = null;
            this.data = new flash.utils.Dictionary();
            return;
        }

        public function addControl(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            this.controls[arg1.id] = arg1;
            var loc1:*=arg1.type.toLowerCase();
            switch (loc1) 
            {
                case "button":
                {
                    if (this._systemFrameSet) 
                    {
                        this._sysButtonVector.push(arg1);
                    }
                    else 
                    {
                        this._buttonVector.push(arg1);
                    }
                    break;
                }
                case "betinfo":
                case "bettext":
                {
                    this._textVector.push(arg1);
                    break;
                }
                case "graphic":
                {
                    this._graphicVector.push(arg1);
                    break;
                }
            }
            return;
        }

        public function get controls():flash.utils.Dictionary
        {
            return this.data as flash.utils.Dictionary;
        }

        public function set currentFrame(arg1:String):void
        {
            this._curFrame = arg1;
            return;
        }

        public function get currentFrame():String
        {
            return this._curFrame;
        }

        public function get systemFrameSet():Boolean
        {
            return this._systemFrameSet;
        }

        public function set systemFrameSet(arg1:Boolean):void
        {
            this._systemFrameSet = arg1;
            return;
        }

        public function get buttonVector():__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IButton>
        {
            return this._buttonVector;
        }

        public function get textVector():__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IText>
        {
            return this._textVector;
        }

        public function get graphicVector():__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IGraphic>
        {
            return this._graphicVector;
        }

        public function get sysButtonVector():__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IButton>
        {
            return this._sysButtonVector;
        }

        public function get theme():String
        {
            return this._theme;
        }

        public function set theme(arg1:String):void
        {
            this._theme = arg1;
            return;
        }

        public function get switched():Boolean
        {
            return this._switched;
        }

        public function set switched(arg1:Boolean):void
        {
            this._switched = arg1;
            return;
        }

        public function reset(arg1:Boolean):void
        {
            this._buttonVector = new Vector.<mgs.aurora.common.interfaces.controls.IButton>();
            this._textVector = new Vector.<mgs.aurora.common.interfaces.controls.IText>();
            this._graphicVector = new Vector.<mgs.aurora.common.interfaces.controls.IGraphic>();
            if (arg1) 
            {
                this._sysButtonVector = new Vector.<mgs.aurora.common.interfaces.controls.IButton>();
            }
            return;
        }

        public static const NAME:String="ControlsProxy";

        internal var _curFrame:String;

        internal var _theme:String;

        internal var _systemFrameSet:Boolean;

        internal var _buttonVector:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IButton>;

        internal var _textVector:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IText>;

        internal var _graphicVector:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IGraphic>;

        internal var _sysButtonVector:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IButton>;

        internal var _switched:Boolean=false;
    }
}


//            class ControlsQueueProxy
package mgs.aurora.modules.framesBuilder.model 
{
    import __AS3__.vec.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class ControlsQueueProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function ControlsQueueProxy(arg1:Object=null)
        {
            super(NAME);
            super.data = new Vector.<String>();
            return;
        }

        public function add(arg1:XMLList):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=arg1;
            for each (loc1 in loc3) 
            {
                super.data.push(loc1.toXMLString());
            }
            return;
        }

        public function get next():XML
        {
            return new XML(super.data.shift());
        }

        public function get isEmpty():Boolean
        {
            return this.length == 0;
        }

        public function get length():int
        {
            return super.data.length;
        }

        public static const NAME:String="ControlsQueryProxy";
    }
}


//            class FrameDefinitionsProxy
package mgs.aurora.modules.framesBuilder.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class FrameDefinitionsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function FrameDefinitionsProxy(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public static const NAME:String="FrameDefinitionsProxy";
    }
}


//            class FrameSoundsEnum
package mgs.aurora.modules.framesBuilder.model 
{
    public class FrameSoundsEnum extends Object
    {
        public function FrameSoundsEnum()
        {
            super();
            return;
        }

        public static const SOUND_GROUP_NAME:String="frame_sounds";

        public static const SOUND_NAME_FROM_LIB:String="buttonFC";
    }
}


//            class FramesProxy
package mgs.aurora.modules.framesBuilder.model 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.interfaces.frames.*;
    import mgs.aurora.common.interfaces.frames.frame.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.common.interfaces.sounds.*;
    import mgs.aurora.modules.framesBuilder.controller.utils.*;
    import mgs.aurora.modules.framesBuilder.model.frames.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.graphics.*;
    import mgs.aurora.modules.framesBuilder.model.frames.controls.text.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class FramesProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy, mgs.aurora.common.interfaces.frames.IFrames
    {
        public function FramesProxy(arg1:Object=null)
        {
            super(NAME, this);
            return;
        }

        public function get clockFeatureOn():Boolean
        {
            return this._clockFeatureOn;
        }

        public function set clockFeatureOn(arg1:Boolean):void
        {
            this._clockFeatureOn = arg1;
            return;
        }

        public function switchTo(arg1:String, arg2:String):void
        {
            var loc1:*=null;
            if (this._systemButtons != null) 
            {
                this._cachedEnabledButtonList = this._systemButtons.enabledList;
                this._cachedDisabledButtonList = this._systemButtons.disabledList;
                this._cachedHiddenButtonList = this._systemButtons.hiddenList;
            }
            if (this.currentFrame != null) 
            {
                this._cachedUcsDisplayType = this.currentFrame.chipSelector.displayType;
                this._cachedUcsIndex = this.currentFrame.chipSelector.index;
                this._cachedUcsValue = this.currentFrame.chipSelector.value;
                this._cachedUcsRange = this.currentFrame.chipSelector.range;
                this.currentFrame.clock.hideTime();
                this.removeFromContainer();
            }
            if (facade.hasProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME)) 
            {
                loc1 = mgs.aurora.modules.framesBuilder.model.ControlsProxy(facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME)).controls;
                mgs.aurora.modules.framesBuilder.model.ControlsProxy(facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME)).reset(true);
                mgs.aurora.modules.framesBuilder.model.ControlsProxy(facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME)).switched = true;
            }
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.GET_FRAME, {"id":arg1, "theme":arg2});
            return;
        }

        public function setClockTime():void
        {
            if (this._clockFeatureOn && !(this.currentFrame == null)) 
            {
                this.currentFrame.clock.showTime();
            }
            return;
        }

        public function set excludeList(arg1:__AS3__.vec.Vector.<String>):void
        {
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_EXCLUDE_LIST, arg1);
            return;
        }

        public function removeGameLayOutFromContainer():void
        {
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy;
            if (this._frame.controls.buttons.hasGroups("GAME_FRAME")) 
            {
                loc3 = mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonGroup(this._frame.controls.buttons.getGroup("GAME_FRAME")).getAllControlIds();
                this._frame.controls.buttons.removeControls(loc3);
                this._frame.controls.buttons.removeGroups("GAME_FRAME");
            }
            if (this._frame.controls.texts.hasGroups("GAME_FRAME")) 
            {
                loc4 = mgs.aurora.modules.framesBuilder.model.frames.controls.text.TextGroup(this._frame.controls.texts.getGroup("GAME_FRAME")).getAllControlIds();
                this._frame.controls.texts.removeGroups("GAME_FRAME");
                this._frame.controls.texts.removeControls(loc4);
            }
            if (this._frame.controls.graphics.hasGroups("GAME_FRAME")) 
            {
                loc5 = mgs.aurora.modules.framesBuilder.model.frames.controls.graphics.GraphicGroup(this._frame.controls.graphics.getGroup("GAME_FRAME")).getAllControlIds();
                this._frame.controls.graphics.removeGroups("GAME_FRAME");
                this._frame.controls.graphics.removeControls(loc5);
            }
            var loc2:*=loc3 + "," + loc4 + "," + loc5;
            loc1.removeControls(loc2);
            this._frame.gameFrameCleared();
            return;
        }

        public function startConnectClip():void
        {
            this._frame.connectClip.start();
            return;
        }

        public function stopConnectClip():void
        {
            this._frame.connectClip.stop();
            return;
        }

        public function set mute(arg1:int):void
        {
            if (arg1 != 1) 
            {
                this._frame.quickMute.on();
            }
            else 
            {
                this._frame.quickMute.off();
            }
            var loc1:*=mgs.aurora.modules.framesBuilder.model.SoundsProxy(mgs.aurora.modules.framesBuilder.controller.utils.PureMVCUtility.retrieveProxy(mgs.aurora.modules.framesBuilder.model.SoundsProxy.NAME));
            loc1.mute = arg1 == 1;
            return;
        }

        public function set show(arg1:Boolean):void
        {
            return;
        }

        public function addEventListener(arg1:String, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            this._frame.addEventListener(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public function hasEventListener(arg1:String):Boolean
        {
            return this._frame.hasEventListener(arg1);
        }

        public function removeEventListener(arg1:String, arg2:Function, arg3:Boolean=false):void
        {
            this._frame.removeEventListener(arg1, arg2, arg3);
            return;
        }

        public function willTrigger(arg1:String):Boolean
        {
            return this._frame.willTrigger(arg1);
        }

        public function updateAfterUserSwitch():void
        {
            this._frame.updateAfterUserSwitch();
            return;
        }

        internal function invokeSwitchCompleteCachedStates():void
        {
            if (this._systemButtons != null) 
            {
                if (this._cachedEnabledButtonList != "") 
                {
                    this._systemButtons.enableControls(this._cachedEnabledButtonList);
                }
                this._cachedEnabledButtonList = "";
                if (this._cachedDisabledButtonList != "") 
                {
                    this._systemButtons.disableControls(this._cachedDisabledButtonList);
                }
                this._cachedDisabledButtonList = "";
                if (this._cachedHiddenButtonList != "") 
                {
                    this._systemButtons.hideControls(this._cachedHiddenButtonList);
                }
                this._cachedHiddenButtonList = "";
            }
            if (this.currentFrame != null) 
            {
                if (this._cachedUcsDisplayType != "") 
                {
                    this.currentFrame.chipSelector.displayType = this._cachedUcsDisplayType;
                }
                this._cachedUcsDisplayType = "";
                if (this._cachedUcsRange != null) 
                {
                    this.currentFrame.chipSelector.range = this._cachedUcsRange;
                }
                this._cachedUcsRange = null;
                if (!isNaN(this._cachedUcsValue)) 
                {
                    this.currentFrame.chipSelector.value = this._cachedUcsValue;
                }
                this._cachedUcsValue = NaN;
                if (!(this.currentFrame.chipSelector.range == null) && !isNaN(this._cachedUcsIndex)) 
                {
                    this.currentFrame.chipSelector.index = this._cachedUcsIndex;
                }
                this._cachedUcsIndex = NaN;
            }
            return;
        }

        public function set mainSprite(arg1:flash.display.Sprite):void
        {
            this._mainSprite = arg1;
            return;
        }

        public function get mainSprite():flash.display.Sprite
        {
            return this._mainSprite;
        }

        public function setBackground(arg1:flash.display.LoaderInfo, arg2:String):void
        {
            if (this._frame != null) 
            {
                this._frame.removeFromContainer();
            }
            var loc1:*=arg1.applicationDomain.getDefinition(arg2) as Class;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.FrameDefinitionsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.FrameDefinitionsProxy;
            var loc3:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy;
            var loc4:*=(this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy).currentFrame;
            var loc5:*=(this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy).theme;
            this._frame = new mgs.aurora.modules.framesBuilder.model.frames.Frame(flash.display.MovieClip(new loc1()), this._mainSprite, loc2.getData() as XML, loc3.config, loc4, loc5);
            return;
        }

        public function setButtons(arg1:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IButton>):void
        {
            this._buttons = new Vector.<mgs.aurora.common.interfaces.controls.IButton>();
            this._buttons = arg1;
            return;
        }

        public function setGameButtons(arg1:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IButton>):void
        {
            this._gameButtons = new Vector.<mgs.aurora.common.interfaces.controls.IButton>();
            this._gameButtons = arg1;
            return;
        }

        public function setGameText(arg1:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IText>):void
        {
            this._gameTextControls = new Vector.<mgs.aurora.common.interfaces.controls.IText>();
            this._gameTextControls = arg1;
            return;
        }

        public function setGameGraphic(arg1:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IGraphic>):void
        {
            this._gameGraphicControls = new Vector.<mgs.aurora.common.interfaces.controls.IGraphic>();
            this._gameGraphicControls = arg1;
            return;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            this._frame.addToContainer(arg1);
            this._systemButtons = mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.ButtonManager(this._frame.controls.buttons).systemButtons;
            this._systemButtons.addControls(Vector.<mgs.aurora.common.interfaces.controls.ICustomControl>(this._buttons), this._frame.assetHolder, "SYSTEM_FRAME");
            this._systemButtons.excludeList = mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy(this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy.NAME)).excludeList;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsProxy.NAME) as mgs.aurora.modules.framesBuilder.model.ControlsProxy;
            if (loc1.switched) 
            {
                loc1.switched = false;
                this.invokeSwitchCompleteCachedStates();
                this.currentFrame.switchComplete();
            }
            return;
        }

        public function addGameLayOutToContainer():void
        {
            this._frame.controls.buttons.addControls(Vector.<mgs.aurora.common.interfaces.controls.ICustomControl>(this._gameButtons), this._frame.assetHolder, "GAME_FRAME");
            this._frame.controls.texts.addControls(Vector.<mgs.aurora.common.interfaces.controls.ICustomControl>(this._gameTextControls), this._frame.assetHolder, "GAME_FRAME");
            this._frame.controls.graphics.addControls(Vector.<mgs.aurora.common.interfaces.controls.ICustomControl>(this._gameGraphicControls), this._frame.assetHolder, "GAME_FRAME");
            return;
        }

        public function dispatchEvent(arg1:flash.events.Event):Boolean
        {
            return this._frame.dispatchEvent(arg1);
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            this._frame.addToContainerAt(arg1, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            if (this._systemButtons != null) 
            {
                this._systemButtons.removeAllControls();
                this._systemButtons = null;
            }
            this._frame.removeFromContainer();
            return;
        }

        public function initialize(arg1:flash.display.LoaderInfo, arg2:flash.display.LoaderInfo, arg3:XML, arg4:XML, arg5:mgs.aurora.common.interfaces.sounds.ISounds, arg6:Object):void
        {
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_SESSIONCONFIG, arg6);
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_FRAMEDEFINITIONS_CONFIG, arg4);
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_ART, arg1);
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_CONFIG, arg3);
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.SET_FONT, arg2);
            this.facade.registerProxy(new mgs.aurora.modules.framesBuilder.model.SoundsProxy(arg5));
            return;
        }

        public function get systemButtons():mgs.aurora.common.interfaces.controls.IControlManager
        {
            return this._systemButtons;
        }

        public function get currentFrame():mgs.aurora.common.interfaces.frames.frame.IFrame
        {
            return this._frame as mgs.aurora.common.interfaces.frames.frame.IFrame;
        }

        public function get tooltip():mgs.aurora.common.interfaces.frames.frame.assets.IToolTip
        {
            return this._frame.tooltip as mgs.aurora.common.interfaces.frames.frame.assets.IToolTip;
        }

        public function get externalSites():mgs.aurora.common.interfaces.frames.frame.assets.IExternalSites
        {
            return this._frame.externalSitesManager as mgs.aurora.common.interfaces.frames.frame.assets.IExternalSites;
        }

        public function set bonusBubbleTrigger(arg1:flash.display.InteractiveObject):void
        {
            this._frame.balanceButton.balanceButton = arg1;
            return;
        }

        public function get bonusBubbleTrigger():flash.display.InteractiveObject
        {
            return this._frame.balanceButton.balanceButton;
        }

        public static const NAME:String="FramesProxy";

        internal var _frame:mgs.aurora.modules.framesBuilder.model.frames.Frame;

        internal var _mainSprite:flash.display.Sprite;

        internal var _buttons:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IButton>;

        internal var _gameButtons:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IButton>;

        internal var _gameTextControls:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IText>;

        internal var _systemButtons:mgs.aurora.modules.framesBuilder.model.frames.controls.buttons.SystemButtonManager;

        internal var _moduleButtons:mgs.aurora.common.interfaces.controls.IControlManager;

        internal var _clockFeatureOn:Boolean;

        internal var _cachedEnabledButtonList:String="";

        internal var _cachedDisabledButtonList:String="";

        internal var _cachedHiddenButtonList:String="";

        internal var _cachedUcsDisplayType:String="";

        internal var _cachedUcsIndex:uint=0;

        internal var _cachedUcsValue:uint=0;

        internal var _cachedUcsRange:__AS3__.vec.Vector.<uint>=null;

        internal var _gameGraphicControls:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IGraphic>;
    }
}


//            class GameFrameDefinitionsProxy
package mgs.aurora.modules.framesBuilder.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class GameFrameDefinitionsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function GameFrameDefinitionsProxy(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public static const NAME:String="GameFrameDefinitionsProxy";
    }
}


//            class SessionProxy
package mgs.aurora.modules.framesBuilder.model 
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


//            class SoundsProxy
package mgs.aurora.modules.framesBuilder.model 
{
    import flash.display.*;
    import mgs.aurora.common.interfaces.sounds.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class SoundsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function SoundsProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public override function onRegister():void
        {
            super.onRegister();
            this.initialize();
            return;
        }

        public function get sounds():mgs.aurora.common.interfaces.sounds.ISoundGroup
        {
            return this._sounds;
        }

        public function set mute(arg1:Boolean):void
        {
            Debugger.trace("SOUNDS PROXY 1 " + arg1, "SYSTEM");
            this._sounds.mute = arg1;
            Debugger.trace("SOUNDS PROXY 2 " + this._sounds.mute, "SYSTEM");
            return;
        }

        public function play(arg1:String):void
        {
            Debugger.trace("SOUNDS PROXY  " + this._sounds.mute, "SYSTEM");
            this._sounds.play(arg1);
            return;
        }

        internal function initialize():void
        {
            var loc1:*=this.data as mgs.aurora.common.interfaces.sounds.ISounds;
            var loc2:*=mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy(this.facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.ControlsConfigProxy.NAME)).art;
            this._sounds = loc1.add(loc2, [mgs.aurora.modules.framesBuilder.model.FrameSoundsEnum.SOUND_NAME_FROM_LIB], mgs.aurora.modules.framesBuilder.model.FrameSoundsEnum.SOUND_GROUP_NAME);
            return;
        }

        public static const NAME:String="SoundsProxy";

        internal var _sounds:mgs.aurora.common.interfaces.sounds.ISoundGroup;
    }
}


//          package notifications
//            class FramesBuilderNotifications
package mgs.aurora.modules.framesBuilder.notifications 
{
    public class FramesBuilderNotifications extends Object
    {
        public function FramesBuilderNotifications()
        {
            super();
            return;
        }

        public static const NAME:String="FramesBuilderNotifications";

        public static const STARTUP:String=NAME + "/notes/startup";

        public static const SET_CONFIG:String=NAME + "/notes/set_config";

        public static const SET_ART:String=NAME + "/notes/set_art";

        public static const SET_FONT:String=NAME + "/notes/set_font";

        public static const SET_EXCLUDE_LIST:String=NAME + "/notes/set_exclude_list";

        public static const SET_FRAMEDEFINITIONS_CONFIG:String=NAME + "/notes/set_framedefinitions_config";

        public static const GET_FRAME:String=NAME + "/message/get_frame";

        public static const CREATE_CONTROLS:String=NAME + "/notes/create_controls";

        public static const CONTROLS_CREATED:String=NAME + "/notes/controls_created";

        public static const HAVE_CONTROLS:String=NAME + "/notes/have_controls";

        public static const FRAME_CREATED:String=NAME + "/notes/frame_created";

        public static const CREATE_NEXT_CONTROL:String=NAME + "/notes/create_next_control";

        public static const CREATE_BUTTON:String="button";

        public static const CREATE_BETTEXT:String="bettext";

        public static const CREATE_BETINFO:String="betinfo";

        public static const CREATE_GRAPHIC:String="graphic";

        public static const ADD_GAME_LAYOUT:String=NAME + "/notes/add_game_layout";

        public static const CONTINUE_ADD_GAME_LAYOUT:String=NAME + "/notes/continue_add_game_layout";

        public static const CLEAR_GAME_LAYOUT:String=NAME + "/notes/clear_game_layout";

        public static const SET_SESSIONCONFIG:String=NAME + "/notes/set_sessionconfig";
    }
}


//          class FramesBuilder
package mgs.aurora.modules.framesBuilder 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.interfaces.frames.*;
    import mgs.aurora.common.interfaces.frames.frame.*;
    import mgs.aurora.common.interfaces.frames.frame.assets.*;
    import mgs.aurora.common.interfaces.sounds.*;
    import mgs.aurora.modules.framesBuilder.model.*;
    
    public class FramesBuilder extends flash.display.Sprite implements mgs.aurora.common.interfaces.frames.IFrames
    {
        public function FramesBuilder()
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
            this.show = false;
            this._facade = mgs.aurora.modules.framesBuilder.FramesBuilderFacade.getInstance(mgs.aurora.modules.framesBuilder.FramesBuilderFacade.NAME);
            this._facade.startup(this);
            this._frames = this._facade.retrieveProxy(mgs.aurora.modules.framesBuilder.model.FramesProxy.NAME) as mgs.aurora.modules.framesBuilder.model.FramesProxy;
            this._frames.mainSprite = this;
            return;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            this._frames.addToContainer(arg1);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            this._frames.addToContainerAt(arg1, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            this._frames.removeFromContainer();
            return;
        }

        public function get currentFrame():mgs.aurora.common.interfaces.frames.frame.IFrame
        {
            return mgs.aurora.common.interfaces.frames.frame.IFrame(this._frames.currentFrame);
        }

        public function get tooltip():mgs.aurora.common.interfaces.frames.frame.assets.IToolTip
        {
            return mgs.aurora.common.interfaces.frames.frame.assets.IToolTip(this._frames.tooltip);
        }

        public function set bonusBubbleTrigger(arg1:flash.display.InteractiveObject):void
        {
            this._frames.bonusBubbleTrigger = arg1;
            return;
        }

        public function get bonusBubbleTrigger():flash.display.InteractiveObject
        {
            return this._frames.bonusBubbleTrigger;
        }

        public function get clockFeatureOn():Boolean
        {
            return this._frames.clockFeatureOn;
        }

        public function set clockFeatureOn(arg1:Boolean):void
        {
            this._frames.clockFeatureOn = arg1;
            return;
        }

        public function switchTo(arg1:String, arg2:String):void
        {
            this._frames.switchTo(arg1, arg2);
            return;
        }

        public function initialize(arg1:flash.display.LoaderInfo, arg2:flash.display.LoaderInfo, arg3:XML, arg4:XML, arg5:mgs.aurora.common.interfaces.sounds.ISounds, arg6:Object):void
        {
            this._frames.initialize(arg1, arg2, arg3, arg4, arg5, arg6);
            return;
        }

        public function get externalSites():mgs.aurora.common.interfaces.frames.frame.assets.IExternalSites
        {
            return this._frames.externalSites;
        }

        public function get systemButtons():mgs.aurora.common.interfaces.controls.IControlManager
        {
            return this._frames.systemButtons;
        }

        public function set excludeList(arg1:__AS3__.vec.Vector.<String>):void
        {
            this._frames.excludeList = arg1;
            return;
        }

        public function startConnectClip():void
        {
            this._frames.startConnectClip();
            return;
        }

        public function stopConnectClip():void
        {
            this._frames.stopConnectClip();
            return;
        }

        public function set mute(arg1:int):void
        {
            this._frames.mute = arg1;
            return;
        }

        public function set show(arg1:Boolean):void
        {
            this.parent.visible = arg1;
            return;
        }

        public function updateAfterUserSwitch():void
        {
            this._frames.updateAfterUserSwitch();
            return;
        }

        public static const NAME:String="FramesBuilder";

        protected var _facade:mgs.aurora.modules.framesBuilder.FramesBuilderFacade;

        internal var _frames:mgs.aurora.modules.framesBuilder.model.FramesProxy;
    }
}


//          class FramesBuilderFacade
package mgs.aurora.modules.framesBuilder 
{
    import flash.display.*;
    import mgs.aurora.modules.framesBuilder.controller.*;
    import mgs.aurora.modules.framesBuilder.notifications.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class FramesBuilderFacade extends org.puremvc.as3.multicore.patterns.facade.Facade implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function FramesBuilderFacade(arg1:String)
        {
            super(arg1);
            return;
        }

        public function startup(arg1:flash.display.Sprite):void
        {
            this.sendNotification(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.STARTUP, arg1);
            return;
        }

        protected override function initializeController():void
        {
            super.initializeController();
            this.registerCommand(mgs.aurora.modules.framesBuilder.notifications.FramesBuilderNotifications.STARTUP, mgs.aurora.modules.framesBuilder.controller.StartupCommand);
            return;
        }

        public static function getInstance(arg1:String):mgs.aurora.modules.framesBuilder.FramesBuilderFacade
        {
            if (mgs.aurora.modules.framesBuilder.FramesBuilderFacade._instance == null) 
            {
                mgs.aurora.modules.framesBuilder.FramesBuilderFacade._instance = new FramesBuilderFacade(arg1);
            }
            return mgs.aurora.modules.framesBuilder.FramesBuilderFacade._instance;
        }

        public static const NAME:String="FramesBuilderFacade";

        internal static var _instance:mgs.aurora.modules.framesBuilder.FramesBuilderFacade;
    }
}


