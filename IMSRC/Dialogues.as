//ActionScript 3.0
//  package mgs
//    package aurora
//      package modules
//        package controls
//          package controller
//            class CreateControlsCommand
package mgs.aurora.modules.controls.controller 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.text.*;
    import flash.ui.*;
    import flash.utils.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.controls.*;
    import mgs.aurora.modules.controls.model.*;
    import mgs.aurora.modules.controls.view.components.*;
    import mgs.aurora.modules.controls.view.layout.*;
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
            var loc3:*=null;
            var loc4:*=null;
            var loc1:*=arg1.getBody() as XMLList;
            var loc2:*=new flash.utils.Dictionary();
            this._artProxy = this.facade.retrieveProxy(mgs.aurora.modules.controls.model.ArtProxy.NAME) as mgs.aurora.modules.controls.model.ArtProxy;
            this._configProxy = this.facade.retrieveProxy(mgs.aurora.modules.controls.model.ConfigProxy.NAME) as mgs.aurora.modules.controls.model.ConfigProxy;
            this._fontsProxy = this.facade.retrieveProxy(mgs.aurora.modules.controls.model.FontsProxy.NAME) as mgs.aurora.modules.controls.model.FontsProxy;
            this._radioGroups = new flash.utils.Dictionary();
            var loc5:*=0;
            while (loc5 < loc1.children().length()) 
            {
                loc4 = loc1.children()[loc5];
                var loc6:*=loc4.@type.toString();
                switch (loc6) 
                {
                    case "text":
                    {
                        loc3 = this.createText(loc4);
                        break;
                    }
                    case "inputtext":
                    {
                        loc3 = this.createInputText(loc4);
                        break;
                    }
                    case "graphic":
                    {
                        loc3 = this.createGraphic(loc4);
                        break;
                    }
                    case "checkbox":
                    {
                        loc3 = this.createCheckBox(loc4);
                        break;
                    }
                    case "radiobutton":
                    {
                        loc3 = this.createRadioButton(loc4);
                        break;
                    }
                    case "button":
                    {
                        loc3 = this.createButton(loc4);
                        break;
                    }
                    case "title":
                    {
                        loc3 = this.createButton(loc4, true);
                        break;
                    }
                    case "list":
                    {
                        loc3 = this.createList(loc4);
                        break;
                    }
                    case "combobox":
                    {
                        loc3 = this.createComboBox(loc4);
                        break;
                    }
                    default:
                    {
                        break;
                    }
                }
                if (loc3 != null) 
                {
                    loc2[loc3.id] = loc3;
                }
                ++loc5;
            }
            this.sendNotification(mgs.aurora.modules.controls.ControlsBuilderFacade.CONTROLS_CREATED, loc2);
            return;
        }

        internal function createText(arg1:XML):mgs.aurora.common.interfaces.controls.IText
        {
            var config:XML;
            var textConfig:XML;
            var layerConfig:XML;
            var formatConfig:XML;
            var fieldConfig:XML;
            var graphic:mgs.aurora.common.interfaces.controls.ITimelineGraphic;
            var stateFormats:flash.utils.Dictionary;
            var filtersProxy:mgs.aurora.modules.controls.model.FiltersProxy;
            var spacing:mgs.aurora.modules.controls.view.layout.Spacing;
            var text:mgs.aurora.modules.controls.view.components.Text;

            var loc1:*;
            textConfig = null;
            layerConfig = null;
            formatConfig = null;
            fieldConfig = null;
            graphic = null;
            stateFormats = null;
            filtersProxy = null;
            spacing = null;
            text = null;
            config = arg1;
            textConfig = this._configProxy.getTextConfig(config.@configId);
            var loc3:*=0;
            var loc4:*=textConfig.layer;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == "text") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            layerConfig = this._configProxy.getTextLayerConfig(loc2[0].@configId);
            formatConfig = this._configProxy.getTextFormatConfig(layerConfig.@textFormat);
            fieldConfig = this._configProxy.getTextFieldConfig(layerConfig.@textField);
            loc3 = 0;
            loc4 = textConfig.layer;
            loc2 = new XMLList("");
            for each (loc5 in loc4) 
            {
                with (loc6 = loc5) 
                {
                    if (@id == "art") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            graphic = this.createGraphic(loc2[0]);
            stateFormats = this.getTextStateFormats(formatConfig);
            textConfig = this.setXmlPropertiesFromXml(textConfig.copy(), config);
            layerConfig = this.setXmlPropertiesFromXml(layerConfig.copy(), textConfig);
            loc3 = 0;
            loc4 = textConfig.layer;
            loc2 = new XMLList("");
            for each (loc5 in loc4) 
            {
                with (loc6 = loc5) 
                {
                    if (@id == "text") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            spacing = this.getSpacing(loc2[0]);
            text = new mgs.aurora.modules.controls.view.components.Text(config.@id, spacing, graphic);
            if (layerConfig.@dropShadow.length() == 1) 
            {
                filtersProxy = this.facade.retrieveProxy(mgs.aurora.modules.controls.model.FiltersProxy.NAME) as mgs.aurora.modules.controls.model.FiltersProxy;
                text.filters = [filtersProxy.getDropshadow(layerConfig.@dropShadow)];
            }
            this.setTextPropertiesFromXml(text, layerConfig);
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(fieldConfig, text.properties);
            text.setStateFormats(stateFormats);
            if (text.properties.embedFonts) 
            {
                this._fontsProxy.registerFont(formatConfig.@font);
            }
            text.text = config.@text;
            return text;
        }

        internal function getTextStateFormats(arg1:XML):flash.utils.Dictionary
        {
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=0;
            var loc6:*=0;
            var loc1:*=new flash.utils.Dictionary();
            var loc2:*=new flash.text.TextFormat();
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(arg1, loc2);
            loc1["enabled"] = loc2;
            if (arg1.states.length() == 1) 
            {
                loc5 = (loc3 = arg1.states[0]).children().length();
                loc6 = 0;
                while (loc6 < loc5) 
                {
                    loc4 = loc3.children()[loc6];
                    loc2 = new flash.text.TextFormat();
                    mgs.aurora.common.utilities.ObjectUtils.updateFromXML(arg1, loc2);
                    mgs.aurora.common.utilities.ObjectUtils.updateFromXML(loc4, loc2);
                    loc1[loc4.name() + ""] = loc2;
                    ++loc6;
                }
            }
            return loc1;
        }

        internal function createInputText(arg1:XML, arg2:String=null):mgs.aurora.common.interfaces.controls.IInputText
        {
            var config:XML;
            var id:String=null;
            var textConfig:XML;
            var layerConfig:XML;
            var formatConfig:XML;
            var fieldConfig:XML;
            var graphic:mgs.aurora.common.interfaces.controls.ITimelineGraphic;
            var stateFormats:flash.utils.Dictionary;
            var spacing:mgs.aurora.modules.controls.view.layout.Spacing;
            var text:mgs.aurora.modules.controls.view.components.InputText;

            var loc1:*;
            textConfig = null;
            layerConfig = null;
            formatConfig = null;
            fieldConfig = null;
            graphic = null;
            stateFormats = null;
            spacing = null;
            text = null;
            config = arg1;
            id = arg2;
            textConfig = this._configProxy.getTextConfig(config.@configId);
            this.copyPropertiesFromXml(textConfig, config);
            var loc3:*=0;
            var loc4:*=textConfig.layer;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == "text") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            layerConfig = this._configProxy.getTextLayerConfig(loc2[0].@configId);
            formatConfig = this._configProxy.getTextFormatConfig(layerConfig.@textFormat);
            fieldConfig = this._configProxy.getTextFieldConfig(layerConfig.@textField);
            loc3 = 0;
            loc4 = textConfig.layer;
            loc2 = new XMLList("");
            for each (loc5 in loc4) 
            {
                with (loc6 = loc5) 
                {
                    if (@id == "art") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            graphic = this.createGraphic(loc2[0]);
            stateFormats = this.getTextStateFormats(formatConfig);
            loc3 = 0;
            loc4 = textConfig.layer;
            loc2 = new XMLList("");
            for each (loc5 in loc4) 
            {
                with (loc6 = loc5) 
                {
                    if (@id == "text") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            spacing = this.getSpacing(loc2[0]);
            id = id != null ? id : config.@id;
            text = new mgs.aurora.modules.controls.view.components.InputText(id, spacing, graphic);
            if (config.@maxChars.length() == 1) 
            {
                fieldConfig.@maxChars = config.@maxChars.toString();
            }
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(fieldConfig, text.properties);
            text.setStateFormats(stateFormats);
            if (text.properties.embedFonts) 
            {
                this._fontsProxy.registerFont(formatConfig.@font);
            }
            text.text = config.@text;
            if (textConfig.@width.length() == 1) 
            {
                text.width = textConfig.@width.toString();
            }
            this.setTabIndex(text, config);
            return text;
        }

        internal function createButton(arg1:XML, arg2:Boolean=false):mgs.aurora.common.interfaces.controls.IButton
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=null;
            var loc1:*=this._configProxy.getButtonConfig(arg1.@configId);
            loc1 = this.setXmlPropertiesFromXml(loc1.copy(), arg1);
            if (arg2) 
            {
                loc2 = new mgs.aurora.modules.controls.view.components.Title(arg1.@id);
            }
            else 
            {
                loc2 = new mgs.aurora.modules.controls.view.components.Button(arg1.@id, this.getButtonShortut(arg1));
            }
            if (loc1.@minHeight.length() == 1) 
            {
                loc2.minHeight = loc1.@minHeight.toString();
            }
            if (loc1.@maxHeight.length() == 1) 
            {
                loc2.maxHeight = loc1.@maxHeight.toString();
            }
            if (loc1.@minWidth.length() == 1) 
            {
                loc2.minWidth = loc1.@minWidth.toString();
            }
            var loc7:*=0;
            while (loc7 < loc1.children().length()) 
            {
                loc3 = loc1.children()[loc7].@type;
                loc6 = loc1.children()[loc7];
                var loc8:*=loc3;
                switch (loc8) 
                {
                    case "graphic":
                    {
                        loc6 = this.setXmlPropertiesFromXml(loc6.copy(), loc1);
                        loc4 = this.createGraphic(loc6);
                        break;
                    }
                    case "text":
                    {
                        (loc6 = this.setXmlPropertiesFromXml(loc6.copy(), arg1)).@text = arg1.@text.toString();
                        loc4 = this.createText(loc6);
                        break;
                    }
                    case "button":
                    {
                        loc6.@text = arg1.@text.toString();
                        loc4 = this.createButton(loc6);
                        break;
                    }
                    case "focus":
                    {
                        loc4 = new mgs.aurora.modules.controls.view.components.ButtonFocus();
                        mgs.aurora.modules.controls.view.components.ButtonFocus(loc4).color = loc6.@color;
                        break;
                    }
                }
                if (loc4 != null) 
                {
                    loc2.addLayer(loc4, this.getSpacing(loc6), this.getAlignment(loc6), this.getPreferedLayerDimensions(loc4, loc6));
                }
                if (loc2.type != mgs.aurora.common.enums.controls.ControlType.TITLE) 
                {
                    this.setTabIndex(loc2, arg1);
                }
                ++loc7;
            }
            if (loc1.@handcursor.length() == 1) 
            {
                flash.display.Sprite(loc2.interactiveObject).buttonMode = loc1.@handcursor == "true";
            }
            this.setControlWidthAndHeight(loc1, loc2);
            loc2.setState("Active");
            return loc2;
        }

        internal function getButtonShortut(arg1:XML):uint
        {
            var loc1:*=null;
            if (arg1.@shortCut.length() == 1) 
            {
                loc1 = arg1.@shortCut;
                if (flash.ui.Keyboard[loc1]) 
                {
                    return flash.ui.Keyboard[loc1];
                }
                return parseInt(loc1, 10);
            }
            return 0;
        }

        internal function setControlWidthAndHeight(arg1:XML, arg2:mgs.aurora.common.interfaces.controls.IControl):void
        {
            if (arg1.@height.length() == 1) 
            {
                arg2.height = arg1.@height.toString();
            }
            if (arg1.@width.length() == 1) 
            {
                arg2.width = arg1.@width.toString();
            }
            return;
        }

        internal function createCheckBox(arg1:XML):mgs.aurora.common.interfaces.controls.ICheckBox
        {
            var config:XML;
            var checkBoxConfigXml:XML;
            var graphic:mgs.aurora.common.interfaces.controls.ITimelineGraphic;
            var textFieldConfig:XML;
            var focusConfig:XML;
            var textField:mgs.aurora.common.interfaces.controls.IText;
            var control:mgs.aurora.modules.controls.view.components.CheckBox;

            var loc1:*;
            checkBoxConfigXml = null;
            graphic = null;
            textFieldConfig = null;
            focusConfig = null;
            textField = null;
            control = null;
            config = arg1;
            checkBoxConfigXml = this._configProxy.getCheckBoxConfig(config.@configId);
            var loc3:*=0;
            var loc4:*=checkBoxConfigXml.layer;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == "art") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            graphic = this.createGraphic(loc2[0]);
            loc3 = 0;
            loc4 = checkBoxConfigXml.layer;
            loc2 = new XMLList("");
            for each (loc5 in loc4) 
            {
                with (loc6 = loc5) 
                {
                    if (@id == "text") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            textFieldConfig = loc2[0];
            loc3 = 0;
            loc4 = checkBoxConfigXml.layer;
            loc2 = new XMLList("");
            for each (loc5 in loc4) 
            {
                with (loc6 = loc5) 
                {
                    if (@id == "focus") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            focusConfig = loc2[0];
            textFieldConfig.@text = config.@text;
            textField = this.createText(textFieldConfig);
            control = new mgs.aurora.modules.controls.view.components.CheckBox(config.@id, textField, graphic, this.getFocusColor(focusConfig));
            this.setTabIndex(control, config);
            return control;
        }

        internal function createRadioButton(arg1:XML):mgs.aurora.common.interfaces.controls.IRadioButton
        {
            var config:XML;
            var radioButtonConfigXml:XML;
            var graphic:mgs.aurora.common.interfaces.controls.ITimelineGraphic;
            var textFieldConfig:XML;
            var focusConfig:XML;
            var textField:mgs.aurora.common.interfaces.controls.IText;
            var control:mgs.aurora.modules.controls.view.components.RadioButton;
            var radioButtonGroup:mgs.aurora.common.interfaces.controls.IRadioButtonGroup;

            var loc1:*;
            radioButtonConfigXml = null;
            graphic = null;
            textFieldConfig = null;
            focusConfig = null;
            textField = null;
            control = null;
            radioButtonGroup = null;
            config = arg1;
            radioButtonConfigXml = this._configProxy.getRadioButtonConfig(config.@configId);
            var loc3:*=0;
            var loc4:*=radioButtonConfigXml.layer;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == "art") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            graphic = this.createGraphic(loc2[0]);
            loc3 = 0;
            loc4 = radioButtonConfigXml.layer;
            loc2 = new XMLList("");
            for each (loc5 in loc4) 
            {
                with (loc6 = loc5) 
                {
                    if (@id == "text") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            textFieldConfig = loc2[0];
            loc3 = 0;
            loc4 = radioButtonConfigXml.layer;
            loc2 = new XMLList("");
            for each (loc5 in loc4) 
            {
                with (loc6 = loc5) 
                {
                    if (@id == "focus") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            focusConfig = loc2[0];
            textFieldConfig.@text = config.@text;
            textField = this.createText(textFieldConfig);
            control = new mgs.aurora.modules.controls.view.components.RadioButton(config.@id, textField, graphic, this.getFocusColor(focusConfig));
            this.setTabIndex(control, config);
            radioButtonGroup = this._radioGroups[config.@groupName.toString()] as mgs.aurora.common.interfaces.controls.IRadioButtonGroup;
            if (radioButtonGroup == null) 
            {
                radioButtonGroup = new mgs.aurora.modules.controls.view.components.RadioGroup(config.@groupName.toString());
                this._radioGroups[config.@groupName.toString()] = radioButtonGroup;
            }
            control.group = radioButtonGroup;
            control.selected = config.@selected == "true";
            return control;
        }

        internal function getFocusColor(arg1:XML):uint
        {
            if (arg1) 
            {
                return arg1.@color;
            }
            return 16777215;
        }

        internal function setTabIndex(arg1:mgs.aurora.common.interfaces.controls.IButton, arg2:XML):void
        {
            if (arg2.@tabIndex.length() == 1) 
            {
                arg1.tabIndex = arg2.@tabIndex;
            }
            return;
        }

        internal function createGraphic(arg1:XML):mgs.aurora.common.interfaces.controls.ITimelineGraphic
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc5:*=null;
            var loc6:*=0;
            var loc3:*=null;
            var loc4:*=null;
            if (arg1 != null) 
            {
                loc1 = this._configProxy.getGraphicsConfig(arg1.@configId);
                this.copyPropertiesFromXml(loc1, arg1);
                if (loc1.@["class"].length() != 1) 
                {
                    loc3 = new mgs.aurora.modules.controls.view.components.LayeredGraphic(arg1.@id);
                    loc6 = 0;
                    while (loc6 < loc1.layer.length()) 
                    {
                        loc2 = loc1.layer[loc6];
                        loc4 = new mgs.aurora.modules.controls.view.components.Graphic(arg1.@id, this._artProxy.getAsset(loc2.@["class"].toString()));
                        mgs.aurora.modules.controls.view.components.LayeredGraphic(loc3).addLayer(loc4, this.getSpacing(loc2), this.getAlignment(loc2), this.getPreferedLayerGraphicDimensions(loc4, loc2));
                        ++loc6;
                    }
                }
                else 
                {
                    loc3 = new mgs.aurora.modules.controls.view.components.Graphic(arg1.@id, this._artProxy.getAsset(loc1.@["class"].toString()));
                    this.getPreferedLayerGraphicDimensions(loc3, loc1);
                }
                this.setGraphicScale(loc3, loc1);
                this.setGraphicAlpha(loc3, loc1);
                if (loc1.@dropShadow.length() == 1) 
                {
                    loc5 = this.facade.retrieveProxy(mgs.aurora.modules.controls.model.FiltersProxy.NAME) as mgs.aurora.modules.controls.model.FiltersProxy;
                    loc3.filters = [loc5.getDropshadow(loc1.@dropShadow)];
                }
            }
            return loc3;
        }

        internal function createList(arg1:XML):mgs.aurora.common.interfaces.controls.IList
        {
            var config:XML;
            var listConfig:XML;
            var button:mgs.aurora.common.interfaces.controls.IButton;
            var border:mgs.aurora.common.interfaces.controls.ITimelineGraphic;
            var list:mgs.aurora.modules.controls.view.components.List;

            var loc1:*;
            listConfig = null;
            button = null;
            border = null;
            list = null;
            config = arg1;
            listConfig = this._configProxy.getListConfig(config.@configId);
            var loc3:*=0;
            var loc4:*=listConfig.layer;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == "button") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            button = this.createButton(loc2[0]);
            loc3 = 0;
            loc4 = listConfig.layer;
            loc2 = new XMLList("");
            for each (loc5 in loc4) 
            {
                with (loc6 = loc5) 
                {
                    if (@id == "border") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            border = this.createGraphic(loc2[0]);
            list = new mgs.aurora.modules.controls.view.components.List(config.@id, button, border);
            return list;
        }

        internal function createComboBox(arg1:XML):mgs.aurora.common.interfaces.controls.IComboBox
        {
            var config:XML;
            var comboConfig:XML;
            var button:mgs.aurora.common.interfaces.controls.IButton;
            var textField:mgs.aurora.common.interfaces.controls.IInputText;
            var list:mgs.aurora.common.interfaces.controls.IList;
            var comboBox:mgs.aurora.modules.controls.view.components.ComboBox;
            var labels:Array;
            var data:Array;
            var i:int;

            var loc1:*;
            comboConfig = null;
            button = null;
            textField = null;
            list = null;
            comboBox = null;
            labels = null;
            data = null;
            i = 0;
            config = arg1;
            comboConfig = this._configProxy.getComboBoxConfig(config.@configId);
            var loc3:*=0;
            var loc4:*=comboConfig.layer;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == "button") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            button = this.createButton(loc2[0]);
            loc3 = 0;
            loc4 = comboConfig.layer;
            loc2 = new XMLList("");
            for each (loc5 in loc4) 
            {
                with (loc6 = loc5) 
                {
                    if (@id == "text") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            textField = this.createInputText(loc2[0], config.@id + "_text");
            loc3 = 0;
            loc4 = comboConfig.layer;
            loc2 = new XMLList("");
            for each (loc5 in loc4) 
            {
                with (loc6 = loc5) 
                {
                    if (@id == "list") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            list = this.createList(loc2[0]);
            comboBox = new mgs.aurora.modules.controls.view.components.ComboBox(config.@id, textField, button, list);
            labels = config.@labels.split(",");
            data = config.@data.split(",");
            i = 0;
            while (i < labels.length) 
            {
                comboBox.addItem({"label":labels[i], "data":data[i] ? data[i] : null});
                ++i;
            }
            if (config.@defaultIndex.length() == 1) 
            {
                comboBox.selectedIndex = config.@defaultIndex;
            }
            if (config.@restrict.length() == 1) 
            {
                comboBox.textField.properties.restrict = config.@restrict;
            }
            this.setTabIndex(comboBox.textField as mgs.aurora.common.interfaces.controls.IButton, config);
            return comboBox;
        }

        internal function getPreferedLayerGraphicDimensions(arg1:mgs.aurora.common.interfaces.controls.IGraphic, arg2:XML):Object
        {
            var loc1:*={"width":null, "height":null};
            var loc2:*=arg2.@fixed;
            var loc3:*=parseInt(arg2.@width, 10);
            var loc4:*=parseInt(arg2.@minWidth, 10);
            var loc5:*=parseInt(arg2.@height, 10);
            if (loc2 != "") 
            {
                var loc6:*=loc2;
                switch (loc6) 
                {
                    case "width":
                    {
                        loc1.width = arg1.width;
                        break;
                    }
                    case "height":
                    {
                        loc1.height = arg1.height;
                        break;
                    }
                    case "both":
                    {
                        loc1.width = arg1.width;
                        loc1.height = arg1.height;
                        break;
                    }
                }
            }
            if (!isNaN(loc3)) 
            {
                loc1.width = loc3;
                arg1.width = loc3;
            }
            if (!isNaN(loc5)) 
            {
                loc1.height = loc5;
                arg1.height = loc5;
            }
            if (!isNaN(loc4)) 
            {
                mgs.aurora.modules.controls.view.components.Graphic(arg1).minWidth = loc4;
            }
            return loc1;
        }

        internal function getPreferedLayerDimensions(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:XML):Object
        {
            var loc1:*={"width":null, "height":null};
            var loc2:*=arg2.@fixed;
            var loc3:*=parseInt(arg2.@width, 10);
            var loc4:*=parseInt(arg2.@minWidth, 10);
            var loc5:*=parseInt(arg2.@height, 10);
            if (loc2 != "") 
            {
                var loc6:*=loc2;
                switch (loc6) 
                {
                    case "width":
                    {
                        loc1.width = arg1.width;
                        break;
                    }
                    case "height":
                    {
                        loc1.height = arg1.height;
                        break;
                    }
                    case "both":
                    {
                        loc1.width = arg1.width;
                        loc1.height = arg1.height;
                        break;
                    }
                }
            }
            if (!isNaN(loc3)) 
            {
                loc1.width = loc3;
                arg1.width = loc3;
            }
            if (!isNaN(loc5)) 
            {
                loc1.height = loc5;
                arg1.height = loc5;
            }
            if (!(!isNaN(loc4) && arg1.type == mgs.aurora.common.enums.controls.ControlType.GRAPHIC)) 
            {
            };
            return loc1;
        }

        internal function setGraphicScale(arg1:mgs.aurora.common.interfaces.controls.IGraphic, arg2:XML):void
        {
            if (arg2.@scaleX.length() == 1) 
            {
                arg1.scaleX = arg2.@scaleX / 100;
            }
            if (arg2.@scaleY.length() == 1) 
            {
                arg1.scaleY = arg2.@scaleY / 100;
            }
            return;
        }

        internal function setGraphicAlpha(arg1:mgs.aurora.common.interfaces.controls.IGraphic, arg2:XML):void
        {
            if (arg2.@alpha.length() == 1) 
            {
                arg1.alpha = arg2.@alpha / 100;
            }
            return;
        }

        internal function setPropertiesFromXml(arg1:Object, arg2:XML):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=0;
            var loc5:*=arg2.attributes();
            for each (loc1 in loc5) 
            {
                loc2 = loc1.name();
                loc3 = loc1.toString();
                if (!arg1.hasOwnProperty(loc2)) 
                {
                    continue;
                }
                arg1[loc2] = loc3;
            }
            return;
        }

        internal function copyPropertiesFromXml(arg1:Object, arg2:XML):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=0;
            var loc5:*=arg2.attributes();
            label161: for each (loc1 in loc5) 
            {
                loc2 = loc1.name();
                loc3 = loc1.toString();
                var loc6:*=loc2;
                switch (loc6) 
                {
                    case "id":
                    case "configId":
                    case "type":
                    {
                        continue label161;
                    }
                    default:
                    {
                        arg1.@[loc2] = loc3;
                        continue label161;
                    }
                }
            }
            return;
        }

        internal function setTextPropertiesFromXml(arg1:Object, arg2:XML):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=0;
            var loc5:*=arg2.attributes();
            label186: for each (loc1 in loc5) 
            {
                loc2 = loc1.name();
                loc3 = loc1.toString();
                var loc6:*=loc2;
                switch (loc6) 
                {
                    case "maxWidth":
                    case "minWidth":
                    case "maxHeight":
                    case "minHeight":
                    {
                        if (arg1.hasOwnProperty(loc2)) 
                        {
                            arg1[loc2] = loc3;
                        }
                        continue label186;
                    }
                }
            }
            return;
        }

        internal function setXmlPropertiesFromXml(arg1:XML, arg2:XML):XML
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=0;
            var loc5:*=arg2.attributes();
            label175: for each (loc1 in loc5) 
            {
                loc2 = loc1.name();
                loc3 = loc1.toString();
                var loc6:*=loc2;
                switch (loc6) 
                {
                    case "maxWidth":
                    case "minWidth":
                    case "maxHeight":
                    case "minHeight":
                    {
                        arg1.@[loc2] = loc3;
                        continue label175;
                    }
                }
            }
            return arg1;
        }

        internal function getSpacing(arg1:XML):mgs.aurora.modules.controls.view.layout.Spacing
        {
            var loc3:*=null;
            var loc4:*=0;
            var loc1:*=new mgs.aurora.modules.controls.view.layout.Spacing();
            var loc2:*=new Vector.<Object>();
            loc2.push({"name":"spacing", "value":parseInt(arg1.@margin, 10)});
            loc2.push({"name":"left", "value":parseInt(arg1.@marginLeft, 10)});
            loc2.push({"name":"right", "value":parseInt(arg1.@marginRight, 10)});
            loc2.push({"name":"top", "value":parseInt(arg1.@marginTop, 10)});
            loc2.push({"name":"bottom", "value":parseInt(arg1.@marginBottom, 10)});
            while (loc4 < loc2.length) 
            {
                loc3 = loc2[loc4];
                if (!isNaN(loc3.value)) 
                {
                    loc1[loc3.name] = loc3.value;
                }
                ++loc4;
            }
            return loc1;
        }

        internal function getAlignment(arg1:XML):mgs.aurora.modules.controls.view.layout.Alignment
        {
            var loc3:*=null;
            var loc4:*=0;
            var loc1:*=new mgs.aurora.modules.controls.view.layout.Alignment();
            var loc2:*=new Vector.<Object>();
            loc2.push({"name":"horizontal", "value":arg1.@align});
            loc2.push({"name":"vertical", "value":arg1.@valign});
            while (loc4 < loc2.length) 
            {
                if ((loc3 = loc2[loc4]).value != undefined) 
                {
                    loc1[loc3.name] = mgs.aurora.modules.controls.view.layout.Alignment[String(loc3.value).toUpperCase()];
                }
                ++loc4;
            }
            return loc1;
        }

        internal var _artProxy:mgs.aurora.modules.controls.model.ArtProxy;

        internal var _configProxy:mgs.aurora.modules.controls.model.ConfigProxy;

        internal var _fontsProxy:mgs.aurora.modules.controls.model.FontsProxy;

        internal var _radioGroups:flash.utils.Dictionary;
    }
}


//            class StartupCommand
package mgs.aurora.modules.controls.controller 
{
    import mgs.aurora.modules.controls.model.*;
    import mgs.aurora.modules.controls.view.*;
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
            this.facade.registerMediator(new mgs.aurora.modules.controls.view.ControlsBuilderMediator(arg1.getBody()));
            this.facade.registerProxy(new mgs.aurora.modules.controls.model.ConfigProxy());
            this.facade.registerProxy(new mgs.aurora.modules.controls.model.ArtProxy());
            this.facade.registerProxy(new mgs.aurora.modules.controls.model.FiltersProxy());
            this.facade.registerProxy(new mgs.aurora.modules.controls.model.FontsProxy());
            return;
        }
    }
}


//          package model
//            class ArtProxy
package mgs.aurora.modules.controls.model 
{
    import flash.display.*;
    import flash.system.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class ArtProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function ArtProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public function getAsset(arg1:String):flash.display.MovieClip
        {
            var loc1:*=this.artLoaderInfo.applicationDomain;
            var loc2:*=loc1.getDefinition(arg1) as Class;
            var loc3:*;
            if ((loc3 = new loc2() as flash.display.MovieClip) == null) 
            {
                throw new Error("Cannot find library asset with linkage - " + arg1);
            }
            return loc3;
        }

        public function get artLoaderInfo():flash.display.LoaderInfo
        {
            return this.data as flash.display.LoaderInfo;
        }

        public static const NAME:String="ArtProxy";
    }
}


//            class ConfigProxy
package mgs.aurora.modules.controls.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class ConfigProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function ConfigProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public function getGraphicsConfig(arg1:String):XML
        {
            var id:String;

            var loc1:*;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.config.graphics.graphic;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            return loc2[0];
        }

        public function getCheckBoxConfig(arg1:String):XML
        {
            var id:String;

            var loc1:*;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.config.checkboxes.checkbox;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            return loc2[0];
        }

        public function getRadioButtonConfig(arg1:String):XML
        {
            var id:String;

            var loc1:*;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.config.radiobuttons.radiobutton;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            return loc2[0];
        }

        public function getTextConfig(arg1:String):XML
        {
            var id:String;

            var loc1:*;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.config.textFields.textField;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            return loc2[0];
        }

        public function getButtonConfig(arg1:String):XML
        {
            var id:String;

            var loc1:*;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.config.buttons.button;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            return loc2[0];
        }

        public function getListConfig(arg1:String):XML
        {
            var id:String;

            var loc1:*;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.config.lists.list;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            return loc2[0];
        }

        public function getComboBoxConfig(arg1:String):XML
        {
            var id:String;

            var loc1:*;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.config.comboboxes.combobox;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            return loc2[0];
        }

        public function getTextLayerConfig(arg1:String):XML
        {
            var id:String;
            var config:XML;

            var loc1:*;
            config = null;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.config.textLayer.style;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            config = loc2[0];
            if (config.@inherit != undefined) 
            {
                config = this.addProperties(config.copy()[0], config.@inherit.toString(), this.config.textLayer.style);
            }
            return config;
        }

        public function getTextFormatConfig(arg1:String):XML
        {
            var id:String;
            var config:XML;

            var loc1:*;
            config = null;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.config.textFormat.style;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            config = loc2[0];
            if (config.@inherit != undefined) 
            {
                config = this.addProperties(config.copy()[0], config.@inherit.toString(), this.config.textFormat.style);
            }
            return config;
        }

        public function getTextFieldConfig(arg1:String):XML
        {
            var id:String;
            var config:XML;

            var loc1:*;
            config = null;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.config.textField.text;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            config = loc2[0];
            if (config.@inherit != undefined) 
            {
                config = this.addProperties(config.copy()[0], config.@inherit.toString(), this.config.textField.text);
            }
            return config;
        }

        public function get config():XML
        {
            return this.data as XML;
        }

        internal function addProperties(arg1:XML, arg2:String, arg3:XMLList):XML
        {
            var target:XML;
            var sourceId:String;
            var sourceXml:XMLList;
            var source:XML;
            var item:XML;
            var property:String;
            var value:String;

            var loc1:*;
            source = null;
            item = null;
            property = null;
            value = null;
            target = arg1;
            sourceId = arg2;
            sourceXml = arg3;
            var loc3:*=0;
            var loc4:*=sourceXml;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == sourceId) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            source = loc2[0];
            if (source.@inherit != undefined) 
            {
                source = this.addProperties(source.copy()[0], source.@inherit, sourceXml);
            }
            loc2 = 0;
            loc3 = source.attributes();
            for each (item in loc3) 
            {
                property = item.name();
                value = item.toString();
                if (target.attribute(property) != undefined) 
                {
                    continue;
                }
                target.@[property] = value;
            }
            return target;
        }

        public static const NAME:String="ConfigProxy";
    }
}


//            class FiltersProxy
package mgs.aurora.modules.controls.model 
{
    import flash.filters.*;
    import mgs.aurora.common.utilities.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class FiltersProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function FiltersProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public function getDropshadow(arg1:String):flash.filters.DropShadowFilter
        {
            var id:String;
            var filter:flash.filters.DropShadowFilter;
            var config:XML;

            var loc1:*;
            filter = null;
            config = null;
            id = arg1;
            filter = new flash.filters.DropShadowFilter();
            var loc3:*=0;
            var loc4:*=this.filterConfig.shadow;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            config = loc2[0].copy();
            if (config.@inherit.length() == 1) 
            {
                loc3 = 0;
                loc4 = this.filterConfig.shadow;
                loc2 = new XMLList("");
                for each (loc5 in loc4) 
                {
                    with (loc6 = loc5) 
                    {
                        if (@id == config.@inherit) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                config = this.setXmlPropertiesFromXml(config, loc2[0]);
            }
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(config, filter);
            return filter;
        }

        internal function get filterConfig():XML
        {
            return this.data as XML;
        }

        internal function setXmlPropertiesFromXml(arg1:XML, arg2:XML):XML
        {
            var target:XML;
            var source:XML;
            var item:XML;
            var property:String;
            var value:String;

            var loc1:*;
            item = null;
            property = null;
            value = null;
            target = arg1;
            source = arg2;
            source = source.copy();
            if (source.@inherit.length() == 1) 
            {
                var loc3:*=0;
                var loc4:*=this.filterConfig.shadow;
                var loc2:*=new XMLList("");
                for each (var loc5:* in loc4) 
                {
                    var loc6:*;
                    with (loc6 = loc5) 
                    {
                        if (@id == source.@inherit) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                source = this.setXmlPropertiesFromXml(source, loc2[0]);
            }
            loc2 = 0;
            loc3 = target.attributes();
            for each (item in loc3) 
            {
                property = item.name();
                value = item.toString();
                source.@[property] = value;
            }
            return source;
        }

        public static const NAME:String="FiltersProxy";
    }
}


//            class FontsProxy
package mgs.aurora.modules.controls.model 
{
    import flash.display.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class FontsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function FontsProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public function registerFont(arg1:String):void
        {
            return;
        }

        public function get fontsLoaderInfo():flash.display.LoaderInfo
        {
            return this.data as flash.display.LoaderInfo;
        }

        public static const NAME:String="FontsProxy";
    }
}


//          package view
//            package components
//              class AbstractButton
package mgs.aurora.modules.controls.view.components 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    
    public class AbstractButton extends mgs.aurora.modules.controls.view.components.AbstractControl implements mgs.aurora.common.interfaces.controls.IButton
    {
        public function AbstractButton(arg1:String)
        {
            super(arg1);
            return;
        }

        protected function createDisplay(arg1:Boolean=true):void
        {
            this._display = new flash.display.Sprite();
            this._display.name = this.id;
            this._display.addEventListener(flash.events.Event.ADDED_TO_STAGE, this.addedToStage);
            this._display.addEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.removedFromToStage);
            this._display.addEventListener(flash.events.MouseEvent.MOUSE_DOWN, this.onMouseDown);
            if (arg1) 
            {
                this._display.addEventListener(flash.events.FocusEvent.FOCUS_IN, this.onFocusIn);
                this._display.addEventListener(flash.events.FocusEvent.FOCUS_OUT, this.onFocusOut);
            }
            this._display.mouseChildren = false;
            return;
        }

        internal function removedFromToStage(arg1:flash.events.Event):void
        {
            mgs.aurora.common.utilities.EventUtils.removeKeyEventsFromSingleMethod(this._display, this.onKeyboardEvent);
            mgs.aurora.common.utilities.EventUtils.removeKeyEventsFromSingleMethod(this._display.stage, this.onStageKeyboardEvent);
            return;
        }

        protected function addedToStage(arg1:flash.events.Event):void
        {
            mgs.aurora.common.utilities.EventUtils.addKeyEventsToSingleMethod(this._display, this.onKeyboardEvent, false, 1500);
            mgs.aurora.common.utilities.EventUtils.addKeyEventsToSingleMethod(this._display.stage, this.onStageKeyboardEvent, false, 1500);
            return;
        }

        protected function onKeyboardEvent(arg1:flash.events.KeyboardEvent):void
        {
            return;
        }

        protected function onStageKeyboardEvent(arg1:flash.events.KeyboardEvent):void
        {
            if (arg1.keyCode != 9) 
            {
                this._tabbedDown = false;
            }
            else 
            {
                this._tabbedDown = arg1.type == flash.events.KeyboardEvent.KEY_DOWN;
            }
            return;
        }

        protected function onMouseEvent(arg1:flash.events.MouseEvent):void
        {
            if (this._enabled && this._visible) 
            {
                this.dispatchEvent(new mgs.aurora.common.events.SystemMouseEvent(arg1.type, this.id, arg1));
            }
            return;
        }

        protected function onFocusIn(arg1:flash.events.FocusEvent):void
        {
            mgs.aurora.modules.controls.view.components.AbstractButton.ButtonTabbed = false;
            if (this._tabbedDown) 
            {
                this._hasKeyboardFocus = true;
                this.showFocusIn();
            }
            this.dispatchEvent(new mgs.aurora.common.events.SystemFocusEvent(mgs.aurora.common.events.SystemFocusEvent.FOCUS_IN, this.id, arg1));
            return;
        }

        protected function onFocusOut(arg1:flash.events.FocusEvent):void
        {
            this._hasKeyboardFocus = false;
            mgs.aurora.modules.controls.view.components.AbstractButton.ButtonTabbed = false;
            this.showFocusOut();
            this.dispatchEvent(new mgs.aurora.common.events.SystemFocusEvent(mgs.aurora.common.events.SystemFocusEvent.FOCUS_OUT, this.id, arg1));
            return;
        }

        protected function showFocusIn():void
        {
            return;
        }

        protected function showFocusOut():void
        {
            return;
        }

        public override function removeFromContainer():void
        {
            super.removeFromContainer();
            return;
        }

        public function setState(arg1:String):void
        {
            return;
        }

        public function get tabIndex():int
        {
            return this._tabIndex;
        }

        public function set tabIndex(arg1:int):void
        {
            this._tabIndex = arg1;
            this._tabEnabled = true;
            this._display.tabEnabled = true;
            this._display.tabIndex = arg1;
            return;
        }

        public function get textField():mgs.aurora.common.interfaces.controls.IText
        {
            return null;
        }

        public override function dispose():void
        {
            this._display.removeEventListener(flash.events.Event.ADDED_TO_STAGE, this.addedToStage);
            this._display.removeEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.removedFromToStage);
            this._display.removeEventListener(flash.events.FocusEvent.FOCUS_IN, this.onFocusIn);
            this._display.removeEventListener(flash.events.FocusEvent.FOCUS_OUT, this.onFocusOut);
            this._display.removeEventListener(flash.events.MouseEvent.MOUSE_DOWN, this.onMouseDown);
            super.dispose();
            return;
        }

        public override function get enabled():Boolean
        {
            return super.enabled;
        }

        public override function set enabled(arg1:Boolean):void
        {
            this._display.tabEnabled = arg1 && this._tabEnabled && this._visible;
            this._display.mouseEnabled = arg1;
            super.enabled = arg1;
            return;
        }

        public override function get visible():Boolean
        {
            return super.visible;
        }

        public override function set visible(arg1:Boolean):void
        {
            this._display.tabEnabled = arg1 && this._tabEnabled && this._enabled;
            super.visible = arg1;
            return;
        }

        protected function onMouseDown(arg1:flash.events.MouseEvent):void
        {
            if (this._display.stage && this.hitTest) 
            {
                this._display.stage.focus = this._display;
            }
            return;
        }

        
        {
            ButtonTabbed = false;
        }

        protected var _tabEnabled:Boolean=false;

        protected var _tabIndex:int=-1;

        protected var _tabbedDown:Boolean=false;

        protected var _hasKeyboardFocus:Boolean=false;

        public static var ButtonTabbed:Boolean=false;
    }
}


//              class AbstractControl
package mgs.aurora.modules.controls.view.components 
{
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class AbstractControl extends Object implements mgs.aurora.common.interfaces.controls.IControl, mgs.aurora.common.interfaces.controls.IControlDimensions
    {
        public function AbstractControl(arg1:String="")
        {
            super();
            this._id = arg1;
            this._eventDispatcher = new flash.events.EventDispatcher(this);
            return;
        }

        protected function changeX(arg1:Number, arg2:Boolean=true):void
        {
            this._x = arg1;
            return;
        }

        protected function changeY(arg1:Number, arg2:Boolean=true):void
        {
            this._y = arg1;
            return;
        }

        protected function changeWidth(arg1:Number, arg2:Boolean=true):void
        {
            this._width = arg1;
            if (arg2) 
            {
                this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            }
            return;
        }

        protected function changeHeight(arg1:Number, arg2:Boolean=true):void
        {
            this._height = arg1;
            if (arg2) 
            {
                this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            }
            return;
        }

        public function get filters():Array
        {
            return this._display.filters;
        }

        public function set filters(arg1:Array):void
        {
            this._display.filters = arg1;
            return;
        }

        public function set visible(arg1:Boolean):void
        {
            if (this._visible != arg1) 
            {
                this._visible = arg1;
                this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            }
            return;
        }

        public function set alpha(arg1:Number):void
        {
            this._display.alpha = arg1;
            return;
        }

        public function set minWidth(arg1:Number):void
        {
            this._minWidth = arg1;
            return;
        }

        public function set maxWidth(arg1:Number):void
        {
            this._maxWidth = arg1;
            return;
        }

        public function set minHeight(arg1:Number):void
        {
            this._minHeight = arg1;
            return;
        }

        public function set maxHeight(arg1:Number):void
        {
            this._maxHeight = arg1;
            return;
        }

        protected function byteClone(arg1:*):*
        {
            var loc1:*=new flash.utils.ByteArray();
            loc1.writeObject(arg1);
            loc1.position = 0;
            return loc1.readObject();
        }

        protected function duplicateDisplayObject(arg1:flash.display.DisplayObject, arg2:Boolean=false):flash.display.DisplayObject
        {
            var loc1:*=Object(arg1).constructor;
            var loc2:*;
            (loc2 = new loc1()).transform = arg1.transform;
            loc2.filters = arg1.filters;
            loc2.cacheAsBitmap = arg1.cacheAsBitmap;
            loc2.opaqueBackground = arg1.opaqueBackground;
            if (arg2 && arg1.parent) 
            {
                arg1.parent.addChild(loc2);
            }
            return loc2;
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

        public function get x():Number
        {
            return this._x;
        }

        public function set x(arg1:Number):void
        {
            if (this._x != arg1) 
            {
                this.changeX(arg1);
            }
            return;
        }

        public function get y():Number
        {
            return this._y;
        }

        public function set y(arg1:Number):void
        {
            if (this._y != arg1) 
            {
                this.changeY(arg1);
            }
            return;
        }

        public function get width():Number
        {
            return this._width;
        }

        public function set width(arg1:Number):void
        {
            if (this._width != arg1) 
            {
                this.changeWidth(arg1);
            }
            return;
        }

        public function get height():Number
        {
            return this._height;
        }

        public function set height(arg1:Number):void
        {
            if (this._height != arg1) 
            {
                this.changeHeight(arg1);
            }
            return;
        }

        public function get enabled():Boolean
        {
            return this._enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            this._enabled = arg1;
            return;
        }

        public function get visible():Boolean
        {
            return this._visible;
        }

        public function get alpha():Number
        {
            return this._display.alpha;
        }

        public function get hitTest():Boolean
        {
            if (this._display.stage) 
            {
                return this._display.hitTestPoint(this._display.stage.mouseX, this._display.stage.mouseY);
            }
            return false;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            arg1.addChild(this._display);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            arg1.addChildAt(this._display, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            this._display.parent.removeChild(this._display);
            return;
        }

        public function dispose():void
        {
            this._display = null;
            return;
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return this._display;
        }

        public function addEventListener(arg1:String, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            this._eventDispatcher.addEventListener(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public function dispatchEvent(arg1:flash.events.Event):Boolean
        {
            if (this._enabled) 
            {
                return this._eventDispatcher.dispatchEvent(arg1);
            }
            return false;
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

        public function get minWidth():Number
        {
            if (this._minWidth == 0 && this._maxWidth == 0) 
            {
                return this.width;
            }
            return this._minWidth;
        }

        public function get maxWidth():Number
        {
            if (this._minWidth == 0 && this._maxWidth == 0) 
            {
                return this.width;
            }
            return this._maxWidth;
        }

        public function get minHeight():Number
        {
            if (this._minHeight == 0 && this._maxHeight == 0) 
            {
                return this.height;
            }
            return this._minHeight;
        }

        public function get maxHeight():Number
        {
            if (this._minHeight == 0 && this._maxHeight == 0) 
            {
                return this.height;
            }
            return this._maxHeight;
        }

        protected var _eventDispatcher:flash.events.EventDispatcher;

        protected var _id:String="";

        protected var _width:Number=0;

        protected var _height:Number=0;

        protected var _minWidth:Number=0;

        protected var _minHeight:Number=0;

        protected var _maxHeight:Number=0;

        protected var _x:Number=0;

        protected var _y:Number=0;

        protected var _display:flash.display.DisplayObjectContainer;

        protected var _enabled:Boolean=true;

        protected var _visible:Boolean=true;

        protected var _type:String="";

        protected var _maxWidth:Number=0;
    }
}


//              class AbstractTextButton
package mgs.aurora.modules.controls.view.components 
{
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class AbstractTextButton extends mgs.aurora.modules.controls.view.components.AbstractButton implements mgs.aurora.common.interfaces.controls.IButton
    {
        public function AbstractTextButton(arg1:String)
        {
            super(arg1);
            return;
        }

        protected function addTextField(arg1:mgs.aurora.common.interfaces.controls.IText):void
        {
            this._textField = arg1;
            this._textField.addToContainer(this._display);
            return;
        }

        public override function get textField():mgs.aurora.common.interfaces.controls.IText
        {
            return this._textField;
        }

        public override function get enabled():Boolean
        {
            return super.enabled;
        }

        public override function set enabled(arg1:Boolean):void
        {
            if (this._textField) 
            {
                this._textField.enabled = arg1;
            }
            super.enabled = arg1;
            return;
        }

        protected override function onMouseEvent(arg1:flash.events.MouseEvent):void
        {
            if (this._textField && this._enabled && this._visible) 
            {
                this._textField.interactiveObject.dispatchEvent(new flash.events.MouseEvent(this._hasKeyboardFocus ? flash.events.MouseEvent.MOUSE_OVER : arg1.type, false));
            }
            super.onMouseEvent(arg1);
            return;
        }

        protected var _textField:mgs.aurora.common.interfaces.controls.IText;
    }
}


//              class Button
package mgs.aurora.modules.controls.view.components 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.controls.view.layout.*;
    
    public class Button extends mgs.aurora.modules.controls.view.components.AbstractTextButton implements mgs.aurora.common.interfaces.controls.IButton, mgs.aurora.common.interfaces.controls.IClonable
    {
        public function Button(arg1:String, arg2:uint=0)
        {
            super(arg1);
            this.createDisplay();
            this.addEvents();
            this._layers = new Vector.<mgs.aurora.common.interfaces.controls.IControl>();
            this._spacing = new Vector.<mgs.aurora.modules.controls.view.layout.Spacing>();
            this._alignment = new Vector.<mgs.aurora.modules.controls.view.layout.Alignment>();
            this._fixed = new Vector.<Boolean>();
            this._preferedDimensions = new Vector.<Object>();
            this._shorcutKey = arg2;
            this.display.mouseChildren = false;
            this._type = mgs.aurora.common.enums.controls.ControlType.BUTTON;
            return;
        }

        protected override function onKeyboardEvent(arg1:flash.events.KeyboardEvent):void
        {
            if (arg1.keyCode == 32 && this._hasKeyboardFocus) 
            {
                this.doKeyboardAction(arg1);
            }
            return;
        }

        protected override function onStageKeyboardEvent(arg1:flash.events.KeyboardEvent):void
        {
            super.onStageKeyboardEvent(arg1);
            if (this._mouseLeftIsDown) 
            {
                return;
            }
            if (arg1.keyCode == this._shorcutKey && this._display.parent.tabChildren || arg1.keyCode == 13 && mgs.aurora.modules.controls.view.components.AbstractButton.ButtonTabbed && _hasKeyboardFocus) 
            {
                if (arg1.keyCode == 13 && mgs.aurora.modules.controls.view.components.AbstractButton.ButtonTabbed && !_hasKeyboardFocus) 
                {
                    return;
                }
                this._display.stage.focus = this._display;
                this.doKeyboardAction(arg1);
            }
            return;
        }

        protected function doKeyboardAction(arg1:flash.events.KeyboardEvent):void
        {
            arg1.stopImmediatePropagation();
            var loc1:*=arg1.type;
            switch (loc1) 
            {
                case flash.events.KeyboardEvent.KEY_DOWN:
                {
                    if (!this._keyIsDown) 
                    {
                        this._keyIsDown = true;
                        this.setState("Depressed");
                    }
                    break;
                }
                case flash.events.KeyboardEvent.KEY_UP:
                {
                    this._keyIsDown = false;
                    if (this._hasKeyboardFocus) 
                    {
                        this.setState("Over");
                    }
                    else 
                    {
                        this.setState("Active");
                    }
                    break;
                }
            }
            this.dispatchEvent(new mgs.aurora.common.events.SystemKeyboardEvent(arg1.type, this.id, arg1));
            return;
        }

        protected override function onFocusIn(arg1:flash.events.FocusEvent):void
        {
            super.onFocusIn(arg1);
            if (this._tabbedDown) 
            {
                ButtonTabbed = true;
            }
            return;
        }

        protected override function changeHeight(arg1:Number, arg2:Boolean=true):void
        {
            var loc1:*=false;
            var loc2:*=null;
            var loc3:*=NaN;
            var loc4:*=NaN;
            var loc6:*=0;
            var loc5:*=this._spacing[this._textIndex];
            if (arg1 < this._minHeight) 
            {
                arg1 = this._minHeight;
            }
            if (this._textField) 
            {
                loc4 = this._textField.height + loc5.top + loc5.bottom;
                if (arg1 < loc4) 
                {
                    arg1 = Math.ceil(loc4);
                }
            }
            loc1 = !(arg1 == this._height);
            if (loc1) 
            {
                loc6 = 0;
                while (loc6 < this._layers.length) 
                {
                    if ((loc2 = this._layers[loc6]).type == mgs.aurora.common.enums.controls.ControlType.GRAPHIC && this._preferedDimensions[loc6].height == null) 
                    {
                        loc2.height = arg1 - this._spacing[loc6].top - this._spacing[loc6].bottom;
                    }
                    ++loc6;
                }
            }
            this.applyVerticalAlignment(arg1);
            if (loc1) 
            {
                super.changeHeight(arg1, arg2);
            }
            return;
        }

        protected override function showFocusIn():void
        {
            super.showFocusIn();
            if (this._buttonFocus) 
            {
                this._buttonFocus.focus(true);
            }
            if (this._textField) 
            {
                this._textField.interactiveObject.dispatchEvent(new flash.events.MouseEvent(flash.events.MouseEvent.MOUSE_OVER, false));
            }
            if (this.enabled) 
            {
                this.setState("Over");
            }
            return;
        }

        public override function setState(arg1:String):void
        {
            var loc2:*=null;
            var loc1:*=this._layers.length;
            var loc3:*=0;
            while (loc3 < loc1) 
            {
                loc2 = this._layers[loc3];
                var loc4:*=loc2.type;
                switch (loc4) 
                {
                    case mgs.aurora.common.enums.controls.ControlType.GRAPHIC:
                    {
                        mgs.aurora.common.interfaces.controls.ITimelineGraphic(loc2).gotoAndStop(arg1);
                        break;
                    }
                    case mgs.aurora.common.enums.controls.ControlType.BUTTON:
                    {
                        mgs.aurora.common.interfaces.controls.IButton(loc2).setState(arg1);
                        break;
                    }
                }
                ++loc3;
            }
            return;
        }

        public function get display():flash.display.Sprite
        {
            return this._display as flash.display.Sprite;
        }

        public override function dispose():void
        {
            mgs.aurora.common.utilities.EventUtils.removeMouseEventsFromSingleMethod(this.display, this.onMouseEvent);
            super.dispose();
            return;
        }

        public function clone(... rest):*
        {
            var loc1:*=new mgs.aurora.modules.controls.view.components.Button(rest[0]);
            var loc2:*=this._layers.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                loc1.addLayer(mgs.aurora.common.interfaces.controls.IClonable(this._layers[loc3]).clone(this._layers[loc3].id), this._spacing[loc3], this._alignment[loc3], this._preferedDimensions[loc3]);
                ++loc3;
            }
            return loc1;
        }

        public override function set visible(arg1:Boolean):void
        {
            this._display.visible = arg1;
            super.visible = arg1;
            return;
        }

        public function addLayer(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:mgs.aurora.modules.controls.view.layout.Spacing, arg3:mgs.aurora.modules.controls.view.layout.Alignment, arg4:Object):void
        {
            var loc1:*=0;
            var loc2:*=0;
            this._layers.push(arg1);
            this._spacing.push(arg2);
            this._alignment.push(arg3);
            this._preferedDimensions.push(arg4);
            arg1.addToContainer(this._display);
            if (arg1.type == mgs.aurora.common.enums.controls.ControlType.TEXT) 
            {
                this._textField = arg1 as mgs.aurora.common.interfaces.controls.IText;
                this._textIndex = (this._layers.length - 1);
                this._textField.addEventListener(flash.events.Event.CHANGE, this.refreshTextLayout);
            }
            if (arg1.type == "ButtonFocus") 
            {
                this._buttonFocus = arg1 as mgs.aurora.modules.controls.view.components.ButtonFocus;
                loc1 = (this._layers.length - 1);
                loc2 = 0;
                while (loc2 < loc1) 
                {
                    this._buttonFocus.addLayer(this._layers[loc2]);
                    ++loc2;
                }
            }
            this.refreshLayout();
            return;
        }

        protected function addEvents():void
        {
            mgs.aurora.common.utilities.EventUtils.addMouseEventsToSingleMethod(this.display, this.onMouseEvent);
            return;
        }

        protected function refreshTextLayout(arg1:flash.events.Event=null):void
        {
            this._setWidth = 0;
            this.refreshLayout();
            return;
        }

        protected function refreshLayout(arg1:flash.events.Event=null):void
        {
            this.changeWidth(this.getPreferedWidth());
            this.changeHeight(this.getPreferedHeight());
            return;
        }

        public override function get width():Number
        {
            return super.width;
        }

        public override function set width(arg1:Number):void
        {
            this._setWidth = arg1;
            super.width = arg1;
            return;
        }

        protected override function changeX(arg1:Number, arg2:Boolean=true):void
        {
            this._display.x = arg1;
            super.changeX(arg1, false);
            return;
        }

        protected override function changeY(arg1:Number, arg2:Boolean=true):void
        {
            this._display.y = arg1;
            super.changeY(arg1, false);
            return;
        }

        protected override function changeWidth(arg1:Number, arg2:Boolean=true):void
        {
            var loc2:*=NaN;
            var loc3:*=false;
            var loc4:*=null;
            var loc5:*=NaN;
            var loc6:*=0;
            var loc1:*=this._spacing[this._textIndex];
            if (arg1 < this._minWidth) 
            {
                arg1 = this._minWidth;
            }
            if (this._textField) 
            {
                loc2 = this._textField.width + loc1.left + loc1.right;
                if (arg1 < loc2) 
                {
                    arg1 = Math.ceil(loc2);
                }
            }
            if (arg1 < this._setWidth) 
            {
                arg1 = this._setWidth;
            }
            if (loc3 = !(arg1 == this._width)) 
            {
                loc6 = 0;
                while (loc6 < this._layers.length) 
                {
                    if ((loc4 = this._layers[loc6]).type == mgs.aurora.common.enums.controls.ControlType.GRAPHIC && this._preferedDimensions[loc6].width == null) 
                    {
                        loc4.width = arg1 - this._spacing[loc6].left - this._spacing[loc6].right;
                    }
                    ++loc6;
                }
            }
            this.applyHorizontalAlignment(arg1);
            if (loc3) 
            {
                super.changeWidth(arg1, arg2);
            }
            return;
        }

        protected override function showFocusOut():void
        {
            super.showFocusOut();
            if (this._buttonFocus) 
            {
                this._buttonFocus.focus(false);
            }
            if (this._textField) 
            {
                this._textField.interactiveObject.dispatchEvent(new flash.events.MouseEvent(flash.events.MouseEvent.MOUSE_OUT, false));
            }
            if (this.enabled) 
            {
                this.setState("Active");
            }
            return;
        }

        protected function applyHorizontalAlignment(arg1:Number):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=NaN;
            var loc1:*=this._layers.length;
            var loc6:*=0;
            while (loc6 < this._layers.length) 
            {
                loc4 = this._layers[loc6];
                loc3 = this._spacing[loc6];
                loc2 = this._alignment[loc6];
                var loc7:*=loc2.horizontal;
                switch (loc7) 
                {
                    case mgs.aurora.modules.controls.view.layout.Alignment.LEFT:
                    {
                        loc5 = loc3.left;
                        break;
                    }
                    case mgs.aurora.modules.controls.view.layout.Alignment.CENTER:
                    {
                        loc5 = Math.round((arg1 - loc4.width) / 2 + loc3.left - loc3.right);
                        break;
                    }
                    case mgs.aurora.modules.controls.view.layout.Alignment.RIGHT:
                    {
                        loc5 = arg1 - loc3.right - loc4.width;
                        break;
                    }
                }
                loc4.x = loc5;
                ++loc6;
            }
            return;
        }

        protected function applyVerticalAlignment(arg1:Number):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=NaN;
            var loc1:*=this._layers.length;
            var loc6:*=0;
            while (loc6 < this._layers.length) 
            {
                loc4 = this._layers[loc6];
                loc3 = this._spacing[loc6];
                loc2 = this._alignment[loc6];
                var loc7:*=loc2.vertical;
                switch (loc7) 
                {
                    case mgs.aurora.modules.controls.view.layout.Alignment.TOP:
                    {
                        loc5 = loc3.top;
                        break;
                    }
                    case mgs.aurora.modules.controls.view.layout.Alignment.MIDDLE:
                    {
                        loc5 = Math.round((arg1 - loc4.height) / 2 + loc3.top - loc3.bottom);
                        break;
                    }
                    case mgs.aurora.modules.controls.view.layout.Alignment.BOTTOM:
                    {
                        loc5 = arg1 - loc3.bottom - loc4.height;
                        break;
                    }
                }
                loc4.y = loc5;
                ++loc6;
            }
            return;
        }

        public override function set enabled(arg1:Boolean):void
        {
            super.enabled = arg1;
            this.display.mouseEnabled = arg1;
            this.setState(this._enabled ? "Active" : "Inactive");
            if (this._textField) 
            {
                this._textField.enabled = arg1;
            }
            return;
        }

        protected function getPreferedWidth():Number
        {
            var loc4:*=null;
            var loc1:*=this._layers.length;
            var loc2:*=0;
            var loc3:*=0;
            var loc5:*=0;
            while (loc5 < loc1) 
            {
                loc4 = this._layers[loc5];
                var loc6:*=loc4.type;
                switch (loc6) 
                {
                    case mgs.aurora.common.enums.controls.ControlType.GRAPHIC:
                    {
                        if (this._preferedDimensions[loc5].width == null) 
                        {
                            break;
                        }
                    }
                    default:
                    {
                        loc3 = loc4.width + this._spacing[loc5].left + this._spacing[loc5].right;
                        loc2 = loc3 > loc2 ? loc3 : loc2;
                    }
                }
                ++loc5;
            }
            if (loc2 < this._minWidth) 
            {
                loc2 = this._minWidth;
            }
            return loc2;
        }

        protected function getPreferedHeight():Number
        {
            var loc4:*=null;
            var loc1:*=this._layers.length;
            var loc2:*=0;
            var loc3:*=0;
            var loc5:*=0;
            while (loc5 < loc1) 
            {
                loc4 = this._layers[loc5];
                var loc6:*=loc4.type;
                switch (loc6) 
                {
                    case mgs.aurora.common.enums.controls.ControlType.GRAPHIC:
                    {
                        if (this._preferedDimensions[loc5].height == null) 
                        {
                            break;
                        }
                    }
                    default:
                    {
                        loc3 = loc4.height + this._spacing[loc5].top + this._spacing[loc5].bottom;
                        loc2 = loc3 > loc2 ? loc3 : loc2;
                    }
                }
                ++loc5;
            }
            if (loc2 < this._minHeight) 
            {
                loc2 = this._minHeight;
            }
            return loc2;
        }

        public override function get maxWidth():Number
        {
            return this._width;
        }

        public override function get minWidth():Number
        {
            return this._width;
        }

        public override function set minWidth(arg1:Number):void
        {
            super.maxWidth = arg1;
            super.minWidth = arg1;
            return;
        }

        protected override function onMouseEvent(arg1:flash.events.MouseEvent):void
        {
            if (this._enabled) 
            {
                var loc1:*=arg1.type;
                switch (loc1) 
                {
                    case flash.events.MouseEvent.MOUSE_OVER:
                    {
                        this.setState("Over");
                        break;
                    }
                    case flash.events.MouseEvent.MOUSE_OUT:
                    {
                        if (this._hasKeyboardFocus) 
                        {
                            this.setState("Over");
                        }
                        else 
                        {
                            this.setState("Active");
                        }
                        break;
                    }
                    case flash.events.MouseEvent.MOUSE_DOWN:
                    {
                        this._mouseLeftIsDown = true;
                        this.setState("Depressed");
                        break;
                    }
                    case flash.events.MouseEvent.MOUSE_UP:
                    {
                        this.setState("Over");
                        this._mouseLeftIsDown = false;
                        break;
                    }
                }
            }
            super.onMouseEvent(arg1);
            return;
        }

        protected var _layers:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IControl>;

        protected var _spacing:__AS3__.vec.Vector.<mgs.aurora.modules.controls.view.layout.Spacing>;

        protected var _alignment:__AS3__.vec.Vector.<mgs.aurora.modules.controls.view.layout.Alignment>;

        protected var _preferedDimensions:__AS3__.vec.Vector.<Object>;

        protected var _textIndex:int;

        protected var _buttonFocus:mgs.aurora.modules.controls.view.components.ButtonFocus;

        protected var _setWidth:Number;

        protected var _shorcutKey:uint;

        protected var _mouseLeftIsDown:Boolean;

        protected var _keyIsDown:Boolean;

        protected var _fixed:__AS3__.vec.Vector.<Boolean>;
    }
}


//              class ButtonFocus
package mgs.aurora.modules.controls.view.components 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    
    public class ButtonFocus extends flash.display.Sprite implements mgs.aurora.common.interfaces.controls.IControl, mgs.aurora.common.interfaces.controls.IClonable
    {
        public function ButtonFocus()
        {
            super();
            this._layers = new Vector.<mgs.aurora.common.interfaces.controls.IControl>();
            return;
        }

        public function addLayer(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            this._layers.push(arg1);
            return;
        }

        public function focus(arg1:Boolean):void
        {
            var loc1:*=0;
            var loc2:*=null;
            var loc3:*=NaN;
            var loc4:*=NaN;
            var loc5:*=NaN;
            var loc6:*=NaN;
            var loc7:*=0;
            var loc8:*=0;
            if (arg1) 
            {
                loc1 = this._layers.length;
                loc2 = this._layers[0];
                loc3 = loc2.x;
                loc4 = loc2.y;
                loc5 = loc2.width;
                loc6 = loc2.height;
                loc7 = 1;
                while (loc7 < loc1) 
                {
                    loc2 = this._layers[loc7];
                    loc3 = loc2.x < loc3 ? loc2.x : loc3;
                    loc4 = loc2.y < loc4 ? loc2.y : loc4;
                    loc5 = loc2.x + loc2.width - loc3 > loc5 ? loc2.x + loc2.width : loc5;
                    loc6 = loc2.y + loc2.height - loc4 > loc6 ? loc2.y + loc2.height : loc6;
                    ++loc7;
                }
                --loc3;
                --loc4;
                loc5 = loc5 + 1;
                loc6 = loc6 + 1;
                loc8 = this._color;
                mgs.aurora.common.utilities.GraphicsUtils.drawFocusRect(this, loc3, loc4, loc5, loc6, loc8);
            }
            else 
            {
                this.graphics.clear();
            }
            return;
        }

        public function get id():String
        {
            return "";
        }

        public function set id(arg1:String):void
        {
            return;
        }

        public function get type():String
        {
            return "ButtonFocus";
        }

        public function get enabled():Boolean
        {
            return false;
        }

        public function set enabled(arg1:Boolean):void
        {
            return;
        }

        public function get hitTest():Boolean
        {
            return false;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            arg1.addChild(this);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            arg1.addChildAt(this, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            this.parent.removeChild(this);
            return;
        }

        public function dispose():void
        {
            this._layers = null;
            return;
        }

        public function clone(... rest):*
        {
            return new mgs.aurora.modules.controls.view.components.ButtonFocus();
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return this;
        }

        public override function get x():Number
        {
            return 0;
        }

        public override function set x(arg1:Number):void
        {
            return;
        }

        public override function get y():Number
        {
            return 0;
        }

        public override function set y(arg1:Number):void
        {
            return;
        }

        public override function get width():Number
        {
            return 0;
        }

        public override function set width(arg1:Number):void
        {
            return;
        }

        public override function get height():Number
        {
            return 0;
        }

        public override function set height(arg1:Number):void
        {
            return;
        }

        public function set color(arg1:uint):void
        {
            this._color = arg1;
            return;
        }

        protected var _layers:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IControl>;

        protected var _color:uint;
    }
}


//              class CheckBox
package mgs.aurora.modules.controls.view.components 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    
    public class CheckBox extends mgs.aurora.modules.controls.view.components.AbstractTextButton implements mgs.aurora.common.interfaces.controls.ICheckBox
    {
        public function CheckBox(arg1:String, arg2:mgs.aurora.common.interfaces.controls.IText, arg3:mgs.aurora.common.interfaces.controls.ITimelineGraphic, arg4:uint=16777215)
        {
            super(arg1);
            this._type = mgs.aurora.common.enums.controls.ControlType.CHECKBOX;
            this._focusColor = arg4;
            this.createDisplay();
            this.addTextField(arg2);
            this.addArt(arg3);
            this.doLayout();
            this.addEvents();
            return;
        }

        internal function addArt(arg1:mgs.aurora.common.interfaces.controls.ITimelineGraphic):void
        {
            this._art = arg1;
            this._art.addToContainer(this._display);
            return;
        }

        internal function doLayout():void
        {
            this._height = this._textField.height > this._art.height ? this._textField.height : this._art.height;
            this._width = this._textField.width + this._art.width;
            this._art.y = Math.round((this._height - this._art.height) / 2);
            this._textField.x = this._art.width;
            this._textField.y = Math.round((this._height - this._textField.height) / 2);
            return;
        }

        internal function addEvents():void
        {
            this._display.addEventListener(flash.events.MouseEvent.CLICK, this.onClick);
            mgs.aurora.common.utilities.EventUtils.addMouseEventsToSingleMethod(this.display, this.onMouseEvent);
            return;
        }

        protected override function onKeyboardEvent(arg1:flash.events.KeyboardEvent):void
        {
            super.onKeyboardEvent(arg1);
            if (arg1.keyCode == 32 && this._hasKeyboardFocus) 
            {
                this.dispatchEvent(new mgs.aurora.common.events.SystemKeyboardEvent(arg1.type, this.id, arg1));
                if (arg1.type == flash.events.KeyboardEvent.KEY_UP) 
                {
                    this.checked = !this._checked;
                }
            }
            return;
        }

        public function get checked():Boolean
        {
            return this._checked;
        }

        public function set checked(arg1:Boolean):void
        {
            if (this._checked != arg1) 
            {
                this._checked = arg1;
                this._art.display.gotoAndStop(this._checked ? "Checked" : "Unchecked");
                this.dispatchEvent(new mgs.aurora.common.events.SystemSelectionEvent(this._checked ? mgs.aurora.common.events.SystemSelectionEvent.SELECTED : mgs.aurora.common.events.SystemSelectionEvent.DESELECTED, this.id));
                this.dispatchEvent(new mgs.aurora.common.events.SystemSelectionEvent(mgs.aurora.common.events.SystemSelectionEvent.SELECTION_CHANGE, this.id));
            }
            return;
        }

        public override function set visible(arg1:Boolean):void
        {
            this._display.visible = arg1;
            super.visible = arg1;
            return;
        }

        public override function set enabled(arg1:Boolean):void
        {
            this._textField.enabled = arg1;
            this._art.alpha = arg1 ? 1 : 0.5;
            super.enabled = arg1;
            return;
        }

        protected override function changeX(arg1:Number, arg2:Boolean=true):void
        {
            this._display.x = arg1;
            super.changeX(arg1, false);
            return;
        }

        protected override function changeY(arg1:Number, arg2:Boolean=true):void
        {
            this._display.y = arg1;
            super.changeY(arg1, false);
            return;
        }

        internal function onClick(arg1:flash.events.MouseEvent):void
        {
            this.checked = !this._checked;
            return;
        }

        public function get display():flash.display.Sprite
        {
            return this._display as flash.display.Sprite;
        }

        protected override function showFocusIn():void
        {
            super.showFocusIn();
            var loc1:*=new flash.display.Sprite();
            loc1.name = "focusGraphic";
            var loc2:*=-6;
            var loc3:*=-4;
            var loc4:*=this.display.width + 12;
            var loc5:*=this.display.height + 8;
            var loc6:*=this._focusColor;
            mgs.aurora.common.utilities.GraphicsUtils.drawFocusRect(loc1, loc2, loc3, loc4, loc5, loc6);
            this.display.addChild(loc1);
            return;
        }

        protected override function showFocusOut():void
        {
            super.showFocusOut();
            if (this.display.getChildByName("focusGraphic")) 
            {
                this.display.removeChild(this.display.getChildByName("focusGraphic"));
            }
            return;
        }

        public override function dispose():void
        {
            mgs.aurora.common.utilities.EventUtils.removeMouseEventsFromSingleMethod(this.display, this.onMouseEvent);
            super.dispose();
            return;
        }

        internal var _checked:Boolean=false;

        internal var _art:mgs.aurora.common.interfaces.controls.ITimelineGraphic;

        internal var _focusColor:uint;
    }
}


//              class ComboBox
package mgs.aurora.modules.controls.view.components 
{
    import flash.display.*;
    import flash.events.*;
    import flash.text.*;
    import flash.ui.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class ComboBox extends mgs.aurora.modules.controls.view.components.AbstractControl implements mgs.aurora.common.interfaces.controls.IComboBox
    {
        public function ComboBox(arg1:String, arg2:mgs.aurora.common.interfaces.controls.IInputText, arg3:mgs.aurora.common.interfaces.controls.IButton, arg4:mgs.aurora.common.interfaces.controls.IList)
        {
            super(arg1);
            this._type = mgs.aurora.common.enums.controls.ControlType.COMBOBOX;
            this.createDisplay();
            this._textField = arg2;
            this._button = arg3;
            this._list = arg4;
            this._list.visible = false;
            this.addComponentsToContainer();
            this.doLayout();
            this.setupEvents();
            return;
        }

        public override function get enabled():Boolean
        {
            return super.enabled;
        }

        public override function set enabled(arg1:Boolean):void
        {
            this._textField.enabled = arg1;
            this._button.enabled = arg1;
            this._list.enabled = arg1;
            super.enabled = arg1;
            return;
        }

        internal function getListIndex(arg1:String):int
        {
            var loc2:*=null;
            var loc1:*=0;
            while (loc1 < this._list.numItems) 
            {
                loc2 = this._list.getItemAt(loc1);
                if (loc2.label == arg1) 
                {
                    return loc1;
                }
                ++loc1;
            }
            return -1;
        }

        public function get numItems():int
        {
            return this._list.numItems;
        }

        protected function createDisplay():void
        {
            this._display = new flash.display.Sprite();
            this._display.addEventListener(flash.events.Event.ADDED_TO_STAGE, this.addedToStage);
            this._display.addEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.removedFromStage);
            return;
        }

        protected function addedToStage(arg1:flash.events.Event):void
        {
            this._display.stage.addEventListener(flash.events.MouseEvent.CLICK, this.onStageClick);
            return;
        }

        protected function removedFromStage(arg1:flash.events.Event):void
        {
            this._display.stage.removeEventListener(flash.events.MouseEvent.CLICK, this.onStageClick);
            return;
        }

        protected function addComponentsToContainer():void
        {
            this._textField.addToContainer(this._display);
            this._button.addToContainer(this._display);
            return;
        }

        protected function setupEvents():void
        {
            this._button.addEventListener(mgs.aurora.common.events.SystemMouseEvent.CLICK, this.onButtonClick);
            this._button.addEventListener(mgs.aurora.common.events.SystemFocusEvent.FOCUS_IN, this.onFocusIn);
            this._button.addEventListener(mgs.aurora.common.events.SystemFocusEvent.FOCUS_OUT, this.onFocusOut);
            this._textField.addEventListener(mgs.aurora.common.events.SystemFocusEvent.FOCUS_IN, this.onFocusIn);
            this._textField.addEventListener(mgs.aurora.common.events.SystemFocusEvent.FOCUS_OUT, this.onFocusOut);
            this._textField.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_UP, this.onKeyUp);
            this._textField.addEventListener(mgs.aurora.common.events.SystemKeyboardEvent.KEY_DOWN, this.onKeyDown);
            this._textField.addEventListener(mgs.aurora.common.events.SystemTextEvent.CHANGE, this.onTextEvent);
            this._textField.addEventListener(mgs.aurora.common.events.SystemTextEvent.TEXT_INPUT, this.onTextEvent);
            this._list.addEventListener(mgs.aurora.common.events.SystemSelectionEvent.SELECTION_CHANGE, this.onListSelectionChange);
            return;
        }

        internal function onTextEvent(arg1:mgs.aurora.common.events.SystemTextEvent):void
        {
            if (!this._selectionChanging) 
            {
                if (arg1.type == mgs.aurora.common.events.SystemTextEvent.CHANGE) 
                {
                    this._list.selectedIndex = this.getListIndex(this._textField.text);
                }
                this.dispatchEvent(arg1);
            }
            return;
        }

        internal function onKeyUp(arg1:mgs.aurora.common.events.SystemKeyboardEvent):void
        {
            if (flash.events.KeyboardEvent(arg1.originalEvent).keyCode == flash.ui.Keyboard.UP) 
            {
                this._list.selectedIndex = this._list.selectedIndex <= 0 ? (this._list.numItems - 1) : (this._list.selectedIndex - 1);
                this._textField.setSelection(0, this._textField.text.length);
            }
            if (flash.events.KeyboardEvent(arg1.originalEvent).keyCode == flash.ui.Keyboard.DOWN) 
            {
                this._list.selectedIndex = this._list.selectedIndex != (this._list.numItems - 1) ? this._list.selectedIndex + 1 : 0;
                this._textField.setSelection(0, this._textField.text.length);
            }
            return;
        }

        internal function onKeyDown(arg1:mgs.aurora.common.events.SystemKeyboardEvent):void
        {
            if (flash.events.KeyboardEvent(arg1.originalEvent).keyCode == flash.ui.Keyboard.UP) 
            {
                this._textField.setSelection(0, this._textField.text.length);
            }
            return;
        }

        protected function onFocusIn(arg1:mgs.aurora.common.events.SystemFocusEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.SystemFocusEvent(mgs.aurora.common.events.SystemFocusEvent.FOCUS_IN, this.id, arg1.originalEvent));
            if (arg1.target == this._textField) 
            {
                this.close();
            }
            return;
        }

        protected function onFocusOut(arg1:mgs.aurora.common.events.SystemFocusEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.SystemFocusEvent(mgs.aurora.common.events.SystemFocusEvent.FOCUS_OUT, this.id, arg1.originalEvent));
            if (!this.hitTest) 
            {
                this.close();
            }
            return;
        }

        protected function onStageClick(arg1:flash.events.MouseEvent):void
        {
            if (!this.hitTest) 
            {
                this.close();
            }
            return;
        }

        protected function onButtonClick(arg1:mgs.aurora.common.events.SystemMouseEvent):void
        {
            if (this._list.visible) 
            {
                this.close();
            }
            else 
            {
                this.open();
            }
            return;
        }

        protected function onListSelectionChange(arg1:mgs.aurora.common.events.SystemSelectionEvent):void
        {
            if (!this._selectionChanging) 
            {
                this._selectionChanging = true;
                this._textField.text = this._list.selectedItem.label;
                if (this.editable) 
                {
                    this._textField.setFocus();
                    this._textField.setSelection(this._textField.text.length, this._textField.text.length);
                }
                this._selectionChanging = false;
                this.dispatchEvent(new mgs.aurora.common.events.SystemSelectionEvent(mgs.aurora.common.events.SystemSelectionEvent.SELECTION_CHANGE, this.id));
            }
            return;
        }

        protected function doLayout():void
        {
            this._button.x = this._textField.width;
            this._list.y = this._textField.height;
            this._width = this._textField.width + this._button.width;
            this._height = this._textField.height;
            this._list.width = this._width;
            this._button.height = this._height;
            return;
        }

        public function get editable():Boolean
        {
            return this._textField.properties.type == flash.text.TextFieldType.INPUT && this._textField.properties.selectable;
        }

        public function set editable(arg1:Boolean):void
        {
            this._textField.properties.type = arg1 ? flash.text.TextFieldType.INPUT : flash.text.TextFieldType.DYNAMIC;
            this._textField.properties.selectable = arg1;
            return;
        }

        public function get selectedIndex():int
        {
            return this._list.selectedIndex;
        }

        public function set selectedIndex(arg1:int):void
        {
            this._list.selectedIndex = arg1;
            return;
        }

        public function get selectedItem():Object
        {
            return this._list.selectedItem;
        }

        public function get text():String
        {
            return this._textField.text;
        }

        public function set text(arg1:String):void
        {
            this._textField.text = arg1;
            this._list.selectedIndex = -1;
            return;
        }

        public function get textField():mgs.aurora.common.interfaces.controls.IInputText
        {
            return this._textField;
        }

        public function addItem(arg1:Object):void
        {
            this._list.addItem(arg1);
            return;
        }

        public function addItemAt(arg1:Object, arg2:uint):void
        {
            this._list.addItemAt(arg1, arg2);
            return;
        }

        public function close():void
        {
            if (this._list.visible) 
            {
                this._list.removeFromContainer();
                this._list.visible = false;
            }
            return;
        }

        public function getItemAt(arg1:uint):Object
        {
            return this._list.getItemAt(arg1);
        }

        public function open():void
        {
            if (!this._list.visible) 
            {
                this._list.addToContainer(this._display);
                this._list.visible = true;
            }
            return;
        }

        public function removeAll():void
        {
            this._list.removeAll();
            return;
        }

        public function removeItem(arg1:Object):Object
        {
            return this._list.removeItem(arg1);
        }

        public function removeItemAt(arg1:uint):Object
        {
            return this._list.removeItemAt(arg1);
        }

        public function replaceItemAt(arg1:Object, arg2:uint):Object
        {
            return this._list.replaceItemAt(arg1, arg2);
        }

        protected override function changeX(arg1:Number, arg2:Boolean=true):void
        {
            this._display.x = arg1;
            super.changeX(arg1, false);
            return;
        }

        protected override function changeY(arg1:Number, arg2:Boolean=true):void
        {
            this._display.y = arg1;
            super.changeY(arg1, false);
            return;
        }

        protected var _textField:mgs.aurora.common.interfaces.controls.IInputText;

        protected var _button:mgs.aurora.common.interfaces.controls.IButton;

        protected var _list:mgs.aurora.common.interfaces.controls.IList;

        protected var _selectionChanging:Boolean=false;
    }
}


//              class Graphic
package mgs.aurora.modules.controls.view.components 
{
    import flash.display.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class Graphic extends mgs.aurora.modules.controls.view.components.AbstractControl implements mgs.aurora.common.interfaces.controls.ITimelineGraphic, mgs.aurora.common.interfaces.controls.IClonable
    {
        public function Graphic(arg1:String, arg2:flash.display.MovieClip)
        {
            super(arg1);
            this._display = arg2;
            this._width = this._display.width;
            this._height = this._display.height;
            this._type = mgs.aurora.common.enums.controls.ControlType.GRAPHIC;
            return;
        }

        protected override function changeX(arg1:Number, arg2:Boolean=true):void
        {
            this._display.x = arg1;
            super.changeX(arg1, false);
            return;
        }

        protected override function changeY(arg1:Number, arg2:Boolean=true):void
        {
            this._display.y = arg1;
            super.changeY(arg1, false);
            return;
        }

        protected override function changeWidth(arg1:Number, arg2:Boolean=true):void
        {
            this._display.width = arg1;
            super.changeWidth(arg1, arg2);
            return;
        }

        protected override function changeHeight(arg1:Number, arg2:Boolean=true):void
        {
            this._display.height = arg1;
            super.changeHeight(arg1, arg2);
            return;
        }

        public function gotoAndStop(arg1:Object):void
        {
            this.display.gotoAndStop(arg1);
            return;
        }

        public function clone(... rest):*
        {
            var loc1:*=new mgs.aurora.modules.controls.view.components.Graphic(rest[0], this.duplicateDisplayObject(this._display) as flash.display.MovieClip);
            return loc1;
        }

        public function get scaleX():Number
        {
            return this.display.scaleX;
        }

        public function set scaleX(arg1:Number):void
        {
            this._scaleX = arg1;
            this.display.scaleX = arg1;
            this._width = this.display.width;
            return;
        }

        public function get scaleY():Number
        {
            return this.display.scaleY;
        }

        public function set scaleY(arg1:Number):void
        {
            this._scaleY = arg1;
            this.display.scaleY = arg1;
            this._height = this._display.height;
            return;
        }

        public function get display():flash.display.MovieClip
        {
            return this._display as flash.display.MovieClip;
        }

        public override function set visible(arg1:Boolean):void
        {
            this._display.visible = arg1;
            super.visible = arg1;
            return;
        }

        internal var _scaleX:Number=1;

        internal var _scaleY:Number=1;
    }
}


//              class InputText
package mgs.aurora.modules.controls.view.components 
{
    import flash.display.*;
    import flash.events.*;
    import flash.text.*;
    import flash.utils.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.controls.view.layout.*;
    
    public class InputText extends mgs.aurora.modules.controls.view.components.AbstractButton implements mgs.aurora.common.interfaces.controls.IInputText
    {
        public function InputText(arg1:String, arg2:mgs.aurora.modules.controls.view.layout.Spacing, arg3:mgs.aurora.common.interfaces.controls.ITimelineGraphic=null)
        {
            this._timer = new flash.utils.Timer(20, 1);
            super(arg1);
            this._type = mgs.aurora.common.enums.controls.ControlType.INPUTTEXT;
            this._textSpacing = arg2;
            this.createDisplay(false);
            this._display.removeEventListener(flash.events.MouseEvent.MOUSE_DOWN, this.onMouseDown);
            this._display.mouseChildren = true;
            if (arg3 != null) 
            {
                this._background = arg3;
                this._background.addToContainer(this._display);
            }
            this._textField = new flash.text.TextField();
            this._textField.type = flash.text.TextFieldType.INPUT;
            this._textField.selectable = true;
            this._textField.tabEnabled = false;
            this._textField.addEventListener(flash.events.TextEvent.TEXT_INPUT, this.onTextInputEvent);
            this._textField.addEventListener(flash.events.Event.CHANGE, this.onTextChangeEvent);
            this._textField.addEventListener(flash.events.FocusEvent.FOCUS_IN, this.onFocusIn);
            this._textField.addEventListener(flash.events.FocusEvent.FOCUS_OUT, this.onFocusOut);
            this._textField.addEventListener(flash.events.FocusEvent.FOCUS_OUT, this.onFocusOut);
            this._textField.mouseEnabled = true;
            this._display.addChild(this._textField);
            this._textFieldProperties = new mgs.aurora.modules.controls.view.components.TextFieldProperties(this._textField);
            this._textFieldProperties.addEventListener(flash.events.Event.RENDER, this.onRedraw);
            this.width = 100;
            this.resizeText();
            return;
        }

        public override function set tabIndex(arg1:int):void
        {
            this._tabIndex = arg1;
            this._tabEnabled = true;
            this._textField.tabEnabled = true;
            this._textField.tabIndex = arg1;
            return;
        }

        protected override function showFocusIn():void
        {
            super.showFocusIn();
            this.setSelection(0, this._textField.length);
            return;
        }

        public function setFocus():void
        {
            if (this.display.stage) 
            {
                this._textField.stage.focus = this._textField;
            }
            return;
        }

        public function setSelection(arg1:int, arg2:int):void
        {
            this._textField.setSelection(arg1, arg2);
            return;
        }

        protected override function createDisplay(arg1:Boolean=true):void
        {
            super.createDisplay(arg1);
            this._display.tabEnabled = false;
            this._display.mouseEnabled = false;
            return;
        }

        public function setStateFormats(arg1:flash.utils.Dictionary):void
        {
            this._stateFormats = arg1;
            this.defaultTextFormat = arg1["enabled"];
            return;
        }

        protected function getFormattingForState(arg1:String):flash.text.TextFormat
        {
            if (this._stateFormats[arg1] != undefined) 
            {
                return this._stateFormats[arg1];
            }
            return this._stateFormats["enabled"];
        }

        public function get caretIndex():int
        {
            return this._textField.caretIndex;
        }

        public function get selectionBeginIndex():int
        {
            return this._textField.selectionBeginIndex;
        }

        public function get selectionEndIndex():int
        {
            return this._textField.selectionEndIndex;
        }

        protected function onTextChangeEvent(arg1:flash.events.Event):void
        {
            if (this._backSpace != true) 
            {
                this.dispatchEvent(new mgs.aurora.common.events.SystemTextEvent(mgs.aurora.common.events.SystemTextEvent.CHANGE, this.id));
            }
            else 
            {
                var loc1:*=this._timerComplete;
                switch (loc1) 
                {
                    case 0:
                    {
                        this._timerComplete = 1;
                        this._timer.addEventListener(flash.events.TimerEvent.TIMER_COMPLETE, this.timerComplete);
                        this._timer.start();
                        this._text = this.text;
                        this.dispatchEvent(new mgs.aurora.common.events.SystemTextEvent(mgs.aurora.common.events.SystemTextEvent.CHANGE, this.id));
                        break;
                    }
                    case 1:
                    {
                        this.text = this._text;
                        this._textField.setSelection(this.caretIndex + 1, this._textField.text.length);
                        break;
                    }
                    default:
                    {
                        this.dispatchEvent(new mgs.aurora.common.events.SystemTextEvent(mgs.aurora.common.events.SystemTextEvent.CHANGE, this.id));
                        break;
                    }
                }
            }
            return;
        }

        internal function timerComplete(arg1:flash.events.TimerEvent):void
        {
            this._timerComplete = 2;
            return;
        }

        protected function onTextInputEvent(arg1:flash.events.Event):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.SystemTextEvent(mgs.aurora.common.events.SystemTextEvent.TEXT_INPUT, this.id));
            return;
        }

        protected override function onKeyboardEvent(arg1:flash.events.KeyboardEvent):void
        {
            if (arg1.keyCode == 8 && arg1.type.toLowerCase() == "keydown") 
            {
                this._backSpace = true;
            }
            else if (arg1.keyCode == 8 && arg1.type.toLowerCase() == "keyup") 
            {
                this._backSpace = false;
                this._timerComplete = 0;
                this._timer.reset();
            }
            this.dispatchEvent(new mgs.aurora.common.events.SystemKeyboardEvent(arg1.type, this.id, arg1));
            return;
        }

        public function get text():String
        {
            return this._textField.text;
        }

        public function set text(arg1:String):void
        {
            if (this._textFieldProperties.html) 
            {
                this._textField.htmlText = arg1;
            }
            else 
            {
                this._textField.text = arg1;
            }
            this.dispatchEvent(new mgs.aurora.common.events.SystemTextEvent(mgs.aurora.common.events.SystemTextEvent.CHANGE, this.id));
            return;
        }

        public function get defaultTextFormat():flash.text.TextFormat
        {
            return this._textField.defaultTextFormat;
        }

        public function set defaultTextFormat(arg1:flash.text.TextFormat):void
        {
            this._textField.defaultTextFormat = arg1;
            this.resizeText();
            return;
        }

        public function get properties():mgs.aurora.common.interfaces.controls.ITextFieldProperties
        {
            return this._textFieldProperties;
        }

        public function getTextFormat(arg1:int=-1, arg2:int=-1):flash.text.TextFormat
        {
            return this._textField.getTextFormat(arg1, arg2);
        }

        public function setTextFormat(arg1:flash.text.TextFormat, arg2:int=-1, arg3:int=-1):void
        {
            this._textField.setTextFormat(arg1, arg2, arg3);
            this._textField.defaultTextFormat = arg1;
            if (this._textField.text.length > 0) 
            {
                this.resizeText();
            }
            return;
        }

        public override function dispose():void
        {
            this._textFieldProperties.removeEventListener(flash.events.Event.RENDER, this.onRedraw);
            mgs.aurora.common.utilities.EventUtils.removeMouseEventsFromSingleMethod(this._display, this.onMouseEvent);
            super.dispose();
            return;
        }

        public override function set visible(arg1:Boolean):void
        {
            this._textField.tabEnabled = arg1 && this._tabEnabled && this._enabled;
            this._display.visible = arg1;
            super.visible = arg1;
            return;
        }

        public override function get width():Number
        {
            return this._width;
        }

        public override function set width(arg1:Number):void
        {
            this._maxWidth = arg1;
            this._minWidth = arg1;
            super.width = arg1;
            return;
        }

        public override function get height():Number
        {
            return this._textField.height + this._textSpacing.top + this._textSpacing.bottom;
        }

        public override function set height(arg1:Number):void
        {
            return;
        }

        protected override function changeX(arg1:Number, arg2:Boolean=true):void
        {
            this._display.x = arg1;
            super.changeX(arg1, arg2);
            return;
        }

        protected override function changeY(arg1:Number, arg2:Boolean=true):void
        {
            this._display.y = arg1;
            super.changeY(arg1, arg2);
            return;
        }

        protected override function changeWidth(arg1:Number, arg2:Boolean=true):void
        {
            this._width = arg1;
            this.resizeText();
            return;
        }

        protected override function changeHeight(arg1:Number, arg2:Boolean=true):void
        {
            return;
        }

        public override function get enabled():Boolean
        {
            return super.enabled;
        }

        public override function set enabled(arg1:Boolean):void
        {
            if (this._enabled != arg1) 
            {
                this._textField.tabEnabled = arg1 && this._tabEnabled && this._visible;
                this._textField.selectable = arg1;
                this.setTextFormat(this.getFormattingForState(arg1 ? "enabled" : "disabled"));
                super.enabled = arg1;
                this._display.tabEnabled = false;
                this._display.mouseEnabled = false;
                this._textField.type = arg1 ? flash.text.TextFieldType.INPUT : flash.text.TextFieldType.DYNAMIC;
            }
            return;
        }

        protected function resizeText():void
        {
            this._textField.multiline = false;
            this._textField.wordWrap = false;
            this._textField.autoSize = flash.text.TextFieldAutoSize.LEFT;
            this._textField.width = this._width;
            var loc1:*=this._width - this._textSpacing.left + this._textSpacing.right;
            var loc2:*=this._textField.height;
            this._textField.autoSize = flash.text.TextFieldAutoSize.NONE;
            this._textField.width = loc1;
            this._textField.height = loc2;
            this.onRedraw();
            return;
        }

        protected function onRedraw(arg1:flash.events.Event=null):void
        {
            this.display.graphics.clear();
            if (this._textFieldProperties.border) 
            {
                this.display.graphics.lineStyle(1, this._textFieldProperties.borderColor);
            }
            if (this._textFieldProperties.background) 
            {
                this.display.graphics.beginFill(this._textFieldProperties.backgroundColor);
            }
            this.display.graphics.drawRect(0, 0, this.width, this.height);
            this.display.graphics.endFill();
            this._textField.y = this._textSpacing.top;
            this._textField.x = this._textSpacing.left;
            if (this._background != null) 
            {
                this._background.height = this._textField.height + this._textSpacing.top + this._textSpacing.bottom;
                this._background.width = this.width;
            }
            this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            return;
        }

        protected function get display():flash.display.Sprite
        {
            return this._display as flash.display.Sprite;
        }

        protected var _textField:flash.text.TextField;

        protected var _textFieldProperties:mgs.aurora.common.interfaces.controls.ITextFieldProperties;

        protected var _background:mgs.aurora.common.interfaces.controls.ITimelineGraphic;

        protected var _textSpacing:mgs.aurora.modules.controls.view.layout.Spacing;

        internal var _text:String;

        internal var _timerComplete:int=0;

        internal var _backSpace:Boolean=false;

        internal var _timer:flash.utils.Timer;

        protected var _stateFormats:flash.utils.Dictionary;
    }
}


//              class LayeredGraphic
package mgs.aurora.modules.controls.view.components 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.modules.controls.view.layout.*;
    
    public class LayeredGraphic extends mgs.aurora.modules.controls.view.components.AbstractControl implements mgs.aurora.common.interfaces.controls.ITimelineGraphic, mgs.aurora.common.interfaces.controls.IClonable
    {
        public function LayeredGraphic(arg1:String)
        {
            super(arg1);
            this._display = new flash.display.MovieClip();
            this._layers = new Vector.<mgs.aurora.common.interfaces.controls.ITimelineGraphic>();
            this._spacing = new Vector.<mgs.aurora.modules.controls.view.layout.Spacing>();
            this._alignment = new Vector.<mgs.aurora.modules.controls.view.layout.Alignment>();
            this._preferedDimensions = new Vector.<Object>();
            this._type = mgs.aurora.common.enums.controls.ControlType.GRAPHIC;
            return;
        }

        public function addLayer(arg1:mgs.aurora.common.interfaces.controls.ITimelineGraphic, arg2:mgs.aurora.modules.controls.view.layout.Spacing, arg3:mgs.aurora.modules.controls.view.layout.Alignment, arg4:Object):void
        {
            this._layers.push(arg1);
            this._spacing.push(arg2);
            this._alignment.push(arg3);
            this._preferedDimensions.push(arg4);
            arg1.addToContainer(this._display);
            this.refreshLayout();
            return;
        }

        protected function refreshLayout():void
        {
            this.changeWidth(this.getPreferedWidth());
            this.changeHeight(this.getPreferedHeight());
            return;
        }

        protected override function changeX(arg1:Number, arg2:Boolean=true):void
        {
            this._display.x = arg1;
            super.changeX(arg1, false);
            return;
        }

        protected override function changeY(arg1:Number, arg2:Boolean=true):void
        {
            this._display.y = arg1;
            super.changeY(arg1, false);
            return;
        }

        protected override function changeWidth(arg1:Number, arg2:Boolean=true):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=NaN;
            var loc6:*=0;
            while (loc6 < this._layers.length) 
            {
                loc1 = this._layers[loc6];
                loc2 = this._spacing[loc6];
                loc3 = this._alignment[loc6];
                if ((loc4 = this._preferedDimensions[loc6]).width == null) 
                {
                    loc1.width = arg1 - loc2.left - loc2.right;
                }
                else 
                {
                    loc1.width = loc4.width;
                }
                var loc7:*=loc3.horizontal;
                switch (loc7) 
                {
                    case mgs.aurora.modules.controls.view.layout.Alignment.LEFT:
                    {
                        loc5 = loc2.left;
                        break;
                    }
                    case mgs.aurora.modules.controls.view.layout.Alignment.CENTER:
                    {
                        loc5 = Math.round((arg1 - loc1.width) / 2 + loc2.left - loc2.right);
                        break;
                    }
                    case mgs.aurora.modules.controls.view.layout.Alignment.BOTTOM:
                    {
                        loc5 = arg1 - loc2.right - loc1.width;
                        break;
                    }
                }
                loc1.x = Math.round(loc5);
                ++loc6;
            }
            super.changeWidth(arg1, arg2);
            return;
        }

        protected override function changeHeight(arg1:Number, arg2:Boolean=true):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=NaN;
            var loc6:*=0;
            while (loc6 < this._layers.length) 
            {
                loc1 = this._layers[loc6];
                loc2 = this._spacing[loc6];
                loc3 = this._alignment[loc6];
                if ((loc4 = this._preferedDimensions[loc6]).height == null) 
                {
                    loc1.height = arg1 - loc2.top - loc2.bottom;
                }
                else 
                {
                    loc1.height = loc4.height;
                }
                var loc7:*=loc3.vertical;
                switch (loc7) 
                {
                    case mgs.aurora.modules.controls.view.layout.Alignment.TOP:
                    {
                        loc5 = loc2.top;
                        break;
                    }
                    case mgs.aurora.modules.controls.view.layout.Alignment.MIDDLE:
                    {
                        loc5 = Math.round((arg1 - loc1.height) / 2 + loc2.top - loc2.bottom);
                        break;
                    }
                    case mgs.aurora.modules.controls.view.layout.Alignment.BOTTOM:
                    {
                        loc5 = arg1 - loc2.bottom - loc1.height;
                        break;
                    }
                }
                loc1.y = Math.round(loc5);
                ++loc6;
            }
            super.changeHeight(arg1, arg2);
            return;
        }

        protected function getPreferedWidth():Number
        {
            var loc4:*=null;
            var loc5:*=null;
            var loc1:*=this._layers.length;
            var loc2:*=0;
            var loc3:*=0;
            var loc6:*=0;
            while (loc6 < loc1) 
            {
                loc4 = this._layers[loc6];
                loc5 = this._spacing[loc6];
                loc3 = loc4.width + loc5.left + loc5.right;
                loc2 = loc3 > loc2 ? loc3 : loc2;
                ++loc6;
            }
            if (loc2 < this._minWidth) 
            {
                loc2 = this._minWidth;
            }
            return Math.ceil(loc2);
        }

        protected function getPreferedHeight():Number
        {
            var loc4:*=null;
            var loc5:*=null;
            var loc1:*=this._layers.length;
            var loc2:*=0;
            var loc3:*=0;
            var loc6:*=0;
            while (loc6 < loc1) 
            {
                loc4 = this._layers[loc6];
                loc5 = this._spacing[loc6];
                loc3 = loc4.height + loc5.top + loc5.bottom;
                loc2 = loc3 > loc2 ? loc3 : loc2;
                ++loc6;
            }
            if (loc2 < this._minHeight) 
            {
                loc2 = this._minHeight;
            }
            return Math.ceil(loc2);
        }

        public function gotoAndStop(arg1:Object):void
        {
            var loc1:*=this._layers.length;
            var loc2:*=0;
            while (loc2 < loc1) 
            {
                this._layers[loc2].gotoAndStop(arg1);
                ++loc2;
            }
            return;
        }

        public function clone(... rest):*
        {
            var loc1:*=new mgs.aurora.modules.controls.view.components.LayeredGraphic(rest[0]);
            var loc2:*=this._layers.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                loc1.addLayer(mgs.aurora.common.interfaces.controls.IClonable(this._layers[loc3]).clone(this._layers[loc3].id), this._spacing[loc3], this._alignment[loc3], this._preferedDimensions[loc3]);
                ++loc3;
            }
            return loc1;
        }

        public function get scaleX():Number
        {
            return this._display.scaleX;
        }

        public function set scaleX(arg1:Number):void
        {
            this._display.scaleX = arg1;
            return;
        }

        public function get scaleY():Number
        {
            return this._display.scaleY;
        }

        public function set scaleY(arg1:Number):void
        {
            this._display.scaleY = arg1;
            return;
        }

        public function get display():flash.display.MovieClip
        {
            return this._display as flash.display.MovieClip;
        }

        public override function set visible(arg1:Boolean):void
        {
            this._display.visible = arg1;
            super.visible = arg1;
            return;
        }

        internal var _layers:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.ITimelineGraphic>;

        internal var _spacing:__AS3__.vec.Vector.<mgs.aurora.modules.controls.view.layout.Spacing>;

        internal var _alignment:__AS3__.vec.Vector.<mgs.aurora.modules.controls.view.layout.Alignment>;

        internal var _preferedDimensions:__AS3__.vec.Vector.<Object>;
    }
}


//              class List
package mgs.aurora.modules.controls.view.components 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class List extends mgs.aurora.modules.controls.view.components.AbstractControl implements mgs.aurora.common.interfaces.controls.IList
    {
        public function List(arg1:String, arg2:mgs.aurora.common.interfaces.controls.IButton, arg3:mgs.aurora.common.interfaces.controls.ITimelineGraphic)
        {
            super(arg1);
            this._masterButton = arg2;
            this._border = arg3;
            this.setupLists();
            this.setupLayout();
            return;
        }

        protected function setupLists():void
        {
            this._items = new Vector.<Object>();
            this._buttons = new Vector.<mgs.aurora.common.interfaces.controls.IButton>();
            return;
        }

        protected function setupLayout():void
        {
            this._display = new flash.display.Sprite();
            this._buttonHolder = new flash.display.Sprite();
            this._display.addChild(this._buttonHolder);
            this._border.addToContainer(this._display);
            this.refreshLayout();
            return;
        }

        protected function refreshLayout():void
        {
            var loc1:*=this._buttons.length;
            var loc2:*=0;
            while (loc2 < loc1) 
            {
                this._buttons[loc2].width = this._width;
                mgs.aurora.modules.controls.view.components.AbstractControl(this._buttons[loc2]).maxWidth = _width;
                mgs.aurora.modules.controls.view.components.AbstractControl(this._buttons[loc2]).minWidth = _width;
                if (loc2 > 0) 
                {
                    this._buttons[loc2].y = this._buttons[(loc2 - 1)].y + this._buttons[(loc2 - 1)].height;
                }
                ++loc2;
            }
            this._border.width = this._width;
            this._border.height = this._buttonHolder.height;
            return;
        }

        public function get selectedIndex():int
        {
            return this._selectedIndex;
        }

        public function set selectedIndex(arg1:int):void
        {
            if (!(this._selectedIndex == arg1) && arg1 < this._items.length && arg1 >= -1) 
            {
                if (this._selectedIndex >= 0) 
                {
                    this._buttons[this._selectedIndex].enabled = true;
                }
                this._selectedIndex = arg1;
                if (this._selectedIndex >= 0) 
                {
                    this._buttons[this._selectedIndex].enabled = false;
                    this.dispatchEvent(new mgs.aurora.common.events.SystemSelectionEvent(mgs.aurora.common.events.SystemSelectionEvent.SELECTION_CHANGE, this.id));
                }
            }
            return;
        }

        public function get selectedItem():Object
        {
            if (this._selectedIndex >= 0) 
            {
                return this._items[this._selectedIndex];
            }
            return null;
        }

        public function get numItems():int
        {
            return this._items.length;
        }

        public function addItem(arg1:Object):void
        {
            var loc1:*=this.getNewButtonFromItem(arg1);
            this._buttons.push(loc1);
            this._items.push(arg1);
            loc1.addToContainer(this._buttonHolder);
            this.refreshLayout();
            return;
        }

        public function addItemAt(arg1:Object, arg2:uint):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=0;
            var loc5:*=0;
            if (arg2 >= 0 && arg2 <= this._buttons.length) 
            {
                loc1 = this.getNewButtonFromItem(arg1);
                loc2 = this._buttons.slice(0, arg2);
                loc3 = this._items.slice(0, arg2);
                loc4 = this._buttons.length;
                loc2.push(loc1);
                loc3.push(arg1);
                loc5 = arg2;
                while (loc5 < loc4) 
                {
                    loc2.push(this._buttons[loc5]);
                    loc3.push(this._items[loc5]);
                    ++loc5;
                }
                this._buttons = loc2;
                this._items = loc3;
                loc1.addToContainer(this._buttonHolder);
                this.refreshLayout();
            }
            else 
            {
                throw new Error("Index " + arg2 + " is out of bounds in addItemAt of class List");
            }
            return;
        }

        protected function getNewButtonFromItem(arg1:Object):mgs.aurora.common.interfaces.controls.IButton
        {
            var loc1:*=mgs.aurora.common.interfaces.controls.IClonable(this._masterButton).clone(arg1.label);
            loc1.textField.text = arg1.label;
            loc1.enabled = true;
            loc1.addEventListener(mgs.aurora.common.events.SystemMouseEvent.CLICK, this.onButtonClick);
            return loc1;
        }

        public function getItemAt(arg1:uint):Object
        {
            return arg1 >= 0 && arg1 < this._items.length ? this._items[arg1] : null;
        }

        public function removeAll():void
        {
            return;
        }

        public function removeItem(arg1:Object):Object
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=0;
            while (loc3 < this._items.length) 
            {
                if (this._items[loc3] == arg1) 
                {
                    loc1 = this._items.splice(loc3, 1);
                    loc2 = this._buttons.splice(loc3, 1)[0];
                    loc2.removeFromContainer();
                    break;
                }
                ++loc3;
            }
            this.refreshLayout();
            return loc1[0];
        }

        public function removeItemAt(arg1:uint):Object
        {
            if (arg1 >= 0 && arg1 < this._items.length) 
            {
                return this.removeItem(this._items[arg1]);
            }
            return null;
        }

        public function replaceItemAt(arg1:Object, arg2:uint):Object
        {
            var loc1:*=null;
            if (arg2 >= 0 && arg2 < this._items.length) 
            {
                loc1 = this.removeItem(this._items[arg2]);
                this.addItemAt(arg1, arg2);
                return loc1;
            }
            return null;
        }

        protected override function changeWidth(arg1:Number, arg2:Boolean=true):void
        {
            super.changeWidth(arg1, arg2);
            this.refreshLayout();
            return;
        }

        protected override function changeX(arg1:Number, arg2:Boolean=true):void
        {
            this._display.x = arg1;
            super.changeX(arg1, false);
            return;
        }

        protected override function changeY(arg1:Number, arg2:Boolean=true):void
        {
            this._display.y = arg1;
            super.changeY(arg1, false);
            return;
        }

        public override function get visible():Boolean
        {
            return super.visible;
        }

        public override function set visible(arg1:Boolean):void
        {
            if (this._selectedIndex >= 0 && arg1) 
            {
                this._buttons[this._selectedIndex].enabled = false;
            }
            super.visible = arg1;
            return;
        }

        protected function onButtonClick(arg1:mgs.aurora.common.events.SystemMouseEvent):void
        {
            var loc1:*=arg1.target as mgs.aurora.common.interfaces.controls.IButton;
            this.selectedIndex = this.getButtonIndex(loc1);
            return;
        }

        protected function getButtonIndex(arg1:mgs.aurora.common.interfaces.controls.IButton):int
        {
            var loc2:*=0;
            var loc1:*=this._buttons.length;
            loc2 = 0;
            while (loc2 < loc1) 
            {
                if (this._buttons[loc2] == arg1) 
                {
                    break;
                }
                ++loc2;
            }
            return loc2;
        }

        protected var _items:__AS3__.vec.Vector.<Object>;

        protected var _buttons:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IButton>;

        protected var _masterButton:mgs.aurora.common.interfaces.controls.IButton;

        protected var _buttonHolder:flash.display.Sprite;

        protected var _border:mgs.aurora.common.interfaces.controls.ITimelineGraphic;

        protected var _selectedIndex:int=-1;
    }
}


//              class RadioButton
package mgs.aurora.modules.controls.view.components 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    
    public class RadioButton extends mgs.aurora.modules.controls.view.components.AbstractTextButton implements mgs.aurora.common.interfaces.controls.IRadioButton
    {
        public function RadioButton(arg1:String, arg2:mgs.aurora.common.interfaces.controls.IText, arg3:mgs.aurora.common.interfaces.controls.ITimelineGraphic, arg4:uint=16777215)
        {
            super(arg1);
            this._type = mgs.aurora.common.enums.controls.ControlType.RADIOBUTTON;
            this._focusColor = arg4;
            this.createDisplay();
            this.addTextField(arg2);
            this.addArt(arg3);
            this.doLayout();
            this.addEvents();
            return;
        }

        internal function addArt(arg1:mgs.aurora.common.interfaces.controls.ITimelineGraphic):void
        {
            this._art = arg1;
            this._art.addToContainer(this._display);
            return;
        }

        internal function doLayout():void
        {
            this._height = this._textField.height > this._art.height ? this._textField.height : this._art.height;
            this._width = this._textField.width + this._art.width;
            this._art.y = Math.round((this._height - this._art.height) / 2);
            this._textField.x = this._art.width;
            this._textField.y = Math.round((this._height - this._textField.height) / 2);
            return;
        }

        internal function addEvents():void
        {
            this._display.addEventListener(flash.events.MouseEvent.CLICK, this.onClick);
            return;
        }

        protected override function onKeyboardEvent(arg1:flash.events.KeyboardEvent):void
        {
            if (arg1.keyCode == 32) 
            {
                this.dispatchEvent(new mgs.aurora.common.events.SystemKeyboardEvent(arg1.type, this.id, arg1));
                if (arg1.type == flash.events.KeyboardEvent.KEY_UP) 
                {
                    this.selected = !this._selected;
                }
            }
            return;
        }

        internal function onClick(arg1:flash.events.MouseEvent):void
        {
            this.selected = !this._selected;
            return;
        }

        public function get selected():Boolean
        {
            return this._selected;
        }

        public function set selected(arg1:Boolean):void
        {
            if (!this.selected && arg1) 
            {
                this._art.display.gotoAndStop("Checked");
                this._selected = !this._selected;
                this.dispatchEvent(new flash.events.Event(flash.events.Event.SELECT));
                this.dispatchEvent(new mgs.aurora.common.events.SystemSelectionEvent(mgs.aurora.common.events.SystemSelectionEvent.SELECTED, this.id));
                this.dispatchEvent(new mgs.aurora.common.events.SystemSelectionEvent(mgs.aurora.common.events.SystemSelectionEvent.SELECTION_CHANGE, this.id));
            }
            return;
        }

        public override function set visible(arg1:Boolean):void
        {
            this._display.visible = arg1;
            super.visible = arg1;
            return;
        }

        public override function set enabled(arg1:Boolean):void
        {
            this._textField.enabled = arg1;
            super.enabled = arg1;
            return;
        }

        protected override function changeX(arg1:Number, arg2:Boolean=true):void
        {
            this._display.x = arg1;
            super.changeX(arg1, false);
            return;
        }

        protected override function changeY(arg1:Number, arg2:Boolean=true):void
        {
            this._display.y = arg1;
            super.changeY(arg1, false);
            return;
        }

        public function get group():mgs.aurora.common.interfaces.controls.IRadioButtonGroup
        {
            return this._group;
        }

        public function set group(arg1:mgs.aurora.common.interfaces.controls.IRadioButtonGroup):void
        {
            this._group = arg1;
            this._group.addRadioButton(this);
            this._group.addEventListener(flash.events.Event.SELECT, this.onSelectionChange);
            return;
        }

        internal function onSelectionChange(arg1:flash.events.Event):void
        {
            if (this._group.selected != this) 
            {
                this._art.display.gotoAndStop("Unchecked");
                this._selected = false;
                this.dispatchEvent(new mgs.aurora.common.events.SystemSelectionEvent(mgs.aurora.common.events.SystemSelectionEvent.DESELECTED, this.id));
                this.dispatchEvent(new mgs.aurora.common.events.SystemSelectionEvent(mgs.aurora.common.events.SystemSelectionEvent.SELECTION_CHANGE, this.id));
            }
            return;
        }

        protected function get display():flash.display.Sprite
        {
            return this._display as flash.display.Sprite;
        }

        protected override function showFocusIn():void
        {
            super.showFocusIn();
            var loc1:*=new flash.display.Sprite();
            loc1.name = "focusGraphic";
            var loc2:*=-6;
            var loc3:*=-4;
            var loc4:*=this.display.width + 12;
            var loc5:*=this.display.height + 8;
            var loc6:*=this._focusColor;
            mgs.aurora.common.utilities.GraphicsUtils.drawFocusRect(loc1, loc2, loc3, loc4, loc5, loc6);
            this.display.addChild(loc1);
            return;
        }

        protected override function showFocusOut():void
        {
            super.showFocusOut();
            if (this.display.getChildByName("focusGraphic")) 
            {
                this.display.removeChild(this.display.getChildByName("focusGraphic"));
            }
            return;
        }

        public override function dispose():void
        {
            this._group = null;
            super.dispose();
            return;
        }

        internal var _selected:Boolean=false;

        internal var _art:mgs.aurora.common.interfaces.controls.ITimelineGraphic;

        internal var _group:mgs.aurora.common.interfaces.controls.IRadioButtonGroup;

        internal var _focusColor:uint;
    }
}


//              class RadioGroup
package mgs.aurora.modules.controls.view.components 
{
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class RadioGroup extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IRadioButtonGroup
    {
        public function RadioGroup(arg1:String)
        {
            super();
            this._id = arg1;
            return;
        }

        public function addRadioButton(arg1:mgs.aurora.common.interfaces.controls.IRadioButton):void
        {
            arg1.addEventListener(flash.events.Event.SELECT, this.onSelected);
            return;
        }

        public function removeRadioButton(arg1:mgs.aurora.common.interfaces.controls.IRadioButton):void
        {
            arg1.removeEventListener(flash.events.Event.SELECT, this.onSelected);
            return;
        }

        internal function onSelected(arg1:flash.events.Event):void
        {
            var loc1:*=arg1.target as mgs.aurora.common.interfaces.controls.IRadioButton;
            this._selected = loc1;
            this.dispatchEvent(new flash.events.Event(flash.events.Event.SELECT));
            return;
        }

        public function get id():String
        {
            return this._id;
        }

        public function get selected():mgs.aurora.common.interfaces.controls.IRadioButton
        {
            return this._selected;
        }

        internal var _id:String;

        internal var _selected:mgs.aurora.common.interfaces.controls.IRadioButton;
    }
}


//              class Text
package mgs.aurora.modules.controls.view.components 
{
    import flash.display.*;
    import flash.events.*;
    import flash.text.*;
    import flash.utils.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.controls.view.layout.*;
    
    public class Text extends mgs.aurora.modules.controls.view.components.AbstractControl implements mgs.aurora.common.interfaces.controls.IText, mgs.aurora.common.interfaces.controls.IClonable
    {
        public function Text(arg1:String, arg2:mgs.aurora.modules.controls.view.layout.Spacing, arg3:mgs.aurora.common.interfaces.controls.ITimelineGraphic=null)
        {
            super(arg1);
            this._type = mgs.aurora.common.enums.controls.ControlType.TEXT;
            this._textField = new flash.text.TextField();
            this._textField.selectable = false;
            this._background = arg3;
            this._textSpacing = arg2;
            this._textField.x = this._textSpacing.left;
            this._textField.y = this._textSpacing.top;
            this._display = new flash.display.Sprite();
            this._display.mouseEnabled = false;
            if (this._background != null) 
            {
                this._background.addToContainer(this._display);
            }
            this._display.addChild(this._textField);
            this._textFieldProperties = new mgs.aurora.modules.controls.view.components.TextFieldProperties(this._textField);
            this._textFieldProperties.addEventListener(flash.events.Event.RENDER, this.onRedraw);
            mgs.aurora.common.utilities.EventUtils.addMouseEventsToSingleMethod(this._display, this.onMouseEvent);
            return;
        }

        public override function get minWidth():Number
        {
            if (this.properties.multiline) 
            {
                if (this.properties.wordWrap && this._maxWidth == 0) 
                {
                    return super.minWidth;
                }
            }
            return this.width;
        }

        public override function get maxWidth():Number
        {
            if (this.properties.multiline) 
            {
                return super.maxWidth;
            }
            return this.width;
        }

        public function setStateFormats(arg1:flash.utils.Dictionary):void
        {
            this._stateFormats = arg1;
            var loc1:*=this.getFormattingForState("enabled");
            this.defaultTextFormat = this.getFormattingForState("enabled");
            this.setTextFormat(loc1);
            return;
        }

        protected function getFormattingForState(arg1:String):flash.text.TextFormat
        {
            var loc1:*=this._stateFormats["enabled"];
            if (this._stateFormats[arg1] != undefined) 
            {
                loc1 = this._stateFormats[arg1];
            }
            return this.filterHtmlFormatting(loc1);
        }

        public function clone(... rest):*
        {
            var loc1:*=null;
            if (this._background) 
            {
                loc1 = mgs.aurora.common.interfaces.controls.IClonable(this._background).clone(this._background.id);
            }
            var loc2:*=new mgs.aurora.modules.controls.view.components.Text(rest[0], this._textSpacing, loc1);
            loc2.setStateFormats(this._stateFormats);
            mgs.aurora.common.utilities.ObjectUtils.updateFromSameTypeObject(this._textFieldProperties, loc2.properties);
            return loc2;
        }

        protected function filterHtmlFormatting(arg1:flash.text.TextFormat):flash.text.TextFormat
        {
            if (this.properties.html) 
            {
                arg1.bold = arg1.bold ? arg1.bold : null;
                arg1.italic = arg1.italic ? arg1.italic : null;
            }
            return arg1;
        }

        public function get text():String
        {
            return this._textField.text;
        }

        public function set text(arg1:String):void
        {
            if (this._textFieldProperties.html) 
            {
                this._textField.htmlText = arg1;
            }
            else 
            {
                this._textField.text = arg1;
            }
            this.resizeText();
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

        public function get properties():mgs.aurora.common.interfaces.controls.ITextFieldProperties
        {
            return this._textFieldProperties;
        }

        public function getTextFormat(arg1:int=-1, arg2:int=-1):flash.text.TextFormat
        {
            return this._textField.getTextFormat(arg1, arg2);
        }

        public function setTextFormat(arg1:flash.text.TextFormat, arg2:int=-1, arg3:int=-1):void
        {
            this._textField.setTextFormat(arg1, arg2, arg3);
            this.resizeText();
            return;
        }

        public override function dispose():void
        {
            this._textFieldProperties.removeEventListener(flash.events.Event.RENDER, this.onRedraw);
            mgs.aurora.common.utilities.EventUtils.removeMouseEventsFromSingleMethod(this._display, this.onMouseEvent);
            super.dispose();
            return;
        }

        protected override function changeX(arg1:Number, arg2:Boolean=true):void
        {
            this._display.x = arg1;
            super.changeX(arg1, arg2);
            return;
        }

        protected override function changeY(arg1:Number, arg2:Boolean=true):void
        {
            this._display.y = arg1;
            super.changeY(arg1, arg2);
            return;
        }

        public override function set width(arg1:Number):void
        {
            this._setWidth = arg1;
            super.width = arg1;
            return;
        }

        protected override function changeWidth(arg1:Number, arg2:Boolean=true):void
        {
            this._width = arg1;
            this.resizeText();
            return;
        }

        protected override function changeHeight(arg1:Number, arg2:Boolean=true):void
        {
            this._height = arg1;
            this.resizeText();
            return;
        }

        public override function set visible(arg1:Boolean):void
        {
            this._display.visible = arg1;
            super.visible = arg1;
            return;
        }

        public override function get enabled():Boolean
        {
            return super.enabled;
        }

        public override function set enabled(arg1:Boolean):void
        {
            this.setTextFormat(this.getFormattingForState(arg1 ? "enabled" : "disabled"));
            this._display.mouseEnabled = arg1;
            this._display.mouseChildren = arg1;
            super.enabled = arg1;
            return;
        }

        protected function resizeText():void
        {
            if (this._textField.text == "") 
            {
                if (!(this._width == 0) || !(this._height == 0)) 
                {
                    this._width = 0;
                    this._height = 0;
                    this.onRedraw();
                }
            }
            else 
            {
                this._textField.wordWrap = false;
                this._textField.autoSize = flash.text.TextFieldAutoSize.LEFT;
                if (this.properties.multiline) 
                {
                    if (this.getTextFieldWidth() > this._maxWidth && this._maxWidth > 0) 
                    {
                        this._textField.wordWrap = true;
                        this._textField.width = this._setWidth < this._maxWidth && this._setWidth > 0 ? this._setWidth - this._textSpacing.left - this._textSpacing.right : this._maxWidth;
                        this._textField.autoSize = flash.text.TextFieldAutoSize.LEFT;
                    }
                    else if (this.getTextFieldWidth() < this._minWidth && this._minWidth > 0) 
                    {
                        this._textField.wordWrap = true;
                        this._textField.width = this._minWidth - this._textSpacing.left - this._textSpacing.right;
                        this._textField.autoSize = flash.text.TextFieldAutoSize.LEFT;
                    }
                    else 
                    {
                        this._textField.wordWrap = this._maxWidth == 0 && this._minWidth > 0;
                        this._textField.width = this._setWidth - this._textSpacing.left - this._textSpacing.right;
                        this._textField.autoSize = flash.text.TextFieldAutoSize.LEFT;
                    }
                }
                if (!(this._width == Math.ceil(this.getTextFieldWidth())) || !(this._height == Math.ceil(this.getTextFieldHeight()))) 
                {
                    this._width = Math.ceil(this.getTextFieldWidth());
                    this._height = Math.ceil(this.getTextFieldHeight());
                    this.onRedraw();
                }
            }
            return;
        }

        protected function getTextFieldWidth():Number
        {
            return this._textField.width + this._textSpacing.left + this._textSpacing.right;
        }

        protected function getTextFieldHeight():Number
        {
            return this._textField.height + this._textSpacing.top + this._textSpacing.bottom;
        }

        protected function onRedraw(arg1:flash.events.Event=null):void
        {
            this.display.graphics.clear();
            if (this._textFieldProperties.border) 
            {
                this.display.graphics.lineStyle(1, this._textFieldProperties.borderColor);
            }
            if (this._textFieldProperties.background) 
            {
                this.display.graphics.beginFill(this._textFieldProperties.backgroundColor);
            }
            if (this._textFieldProperties.border || this._textFieldProperties.background) 
            {
                this.display.graphics.drawRect(0, 0, this.width, this.height);
                this.display.graphics.endFill();
            }
            this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            return;
        }

        protected function get display():flash.display.Sprite
        {
            return this._display as flash.display.Sprite;
        }

        internal function onMouseEvent(arg1:flash.events.MouseEvent):void
        {
            var loc1:*=arg1.type;
            switch (loc1) 
            {
                case flash.events.MouseEvent.MOUSE_MOVE:
                {
                    break;
                }
                case flash.events.MouseEvent.MOUSE_OUT:
                {
                    this.setTextFormat(this.getFormattingForState(this.enabled ? "enabled" : "disabled"));
                    break;
                }
                default:
                {
                    if (this.enabled) 
                    {
                        this.setTextFormat(this.getFormattingForState(arg1.type));
                    }
                    break;
                }
            }
            this.dispatchEvent(arg1);
            return;
        }

        protected var _textField:flash.text.TextField;

        protected var _textFieldProperties:mgs.aurora.common.interfaces.controls.ITextFieldProperties;

        protected var _background:mgs.aurora.common.interfaces.controls.ITimelineGraphic;

        protected var _setWidth:Number=0;

        protected var _stateFormats:flash.utils.Dictionary;

        protected var _textSpacing:mgs.aurora.modules.controls.view.layout.Spacing;
    }
}


//              class TextFieldProperties
package mgs.aurora.modules.controls.view.components 
{
    import flash.events.*;
    import flash.text.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class TextFieldProperties extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.ITextFieldProperties
    {
        public function TextFieldProperties(arg1:flash.text.TextField)
        {
            super();
            this._textField = arg1;
            return;
        }

        public function get sharpness():Number
        {
            return this._textField.sharpness;
        }

        public function set sharpness(arg1:Number):void
        {
            this._textField.sharpness = arg1;
            return;
        }

        public function get thickness():Number
        {
            return this._textField.thickness;
        }

        public function set thickness(arg1:Number):void
        {
            this._textField.thickness = arg1;
            return;
        }

        public function get wordWrap():Boolean
        {
            return this._textField.wordWrap;
        }

        public function set wordWrap(arg1:Boolean):void
        {
            this._textField.wordWrap = arg1;
            return;
        }

        public function get type():String
        {
            return this._textField.type;
        }

        public function set type(arg1:String):void
        {
            this._textField.type = arg1;
            return;
        }

        public function get antiAliasType():String
        {
            return this._textField.antiAliasType;
        }

        public function set antiAliasType(arg1:String):void
        {
            this._textField.antiAliasType = arg1;
            return;
        }

        public function get background():Boolean
        {
            return this._background;
        }

        public function set background(arg1:Boolean):void
        {
            if (this._background != arg1) 
            {
                this._background = arg1;
                this.dispatchEvent(new flash.events.Event(flash.events.Event.RENDER));
            }
            return;
        }

        public function get backgroundColor():uint
        {
            return this._backgroundColor;
        }

        public function set backgroundColor(arg1:uint):void
        {
            if (this._backgroundColor != arg1) 
            {
                this._backgroundColor = arg1;
                if (this._background) 
                {
                    this.dispatchEvent(new flash.events.Event(flash.events.Event.RENDER));
                }
            }
            return;
        }

        public function get border():Boolean
        {
            return this._border;
        }

        public function set border(arg1:Boolean):void
        {
            if (this._border != arg1) 
            {
                this._border = arg1;
                this.dispatchEvent(new flash.events.Event(flash.events.Event.RENDER));
            }
            return;
        }

        public function get borderColor():uint
        {
            return this._borderColor;
        }

        public function set borderColor(arg1:uint):void
        {
            if (this._borderColor != arg1) 
            {
                this._borderColor = arg1;
                if (this._border) 
                {
                    this.dispatchEvent(new flash.events.Event(flash.events.Event.RENDER));
                }
            }
            return;
        }

        public function get displayAsPassword():Boolean
        {
            return this._textField.displayAsPassword;
        }

        public function set displayAsPassword(arg1:Boolean):void
        {
            this._textField.displayAsPassword = arg1;
            return;
        }

        public function get embedFonts():Boolean
        {
            return this._textField.embedFonts;
        }

        public function set embedFonts(arg1:Boolean):void
        {
            this._textField.embedFonts = arg1;
            return;
        }

        public function get gridFitType():String
        {
            return this._textField.gridFitType;
        }

        public function set gridFitType(arg1:String):void
        {
            this._textField.gridFitType = arg1;
            return;
        }

        public function get html():Boolean
        {
            return this._html;
        }

        public function set html(arg1:Boolean):void
        {
            this._html = arg1;
            return;
        }

        public function get maxChars():int
        {
            return this._textField.maxChars;
        }

        public function set maxChars(arg1:int):void
        {
            this._textField.maxChars = arg1;
            return;
        }

        public function get multiline():Boolean
        {
            return this._textField.multiline;
        }

        public function set multiline(arg1:Boolean):void
        {
            this._textField.multiline = arg1;
            return;
        }

        public function get restrict():String
        {
            return this._textField.restrict;
        }

        public function set restrict(arg1:String):void
        {
            this._textField.restrict = arg1;
            return;
        }

        public function get selectable():Boolean
        {
            return this._textField.selectable;
        }

        public function set selectable(arg1:Boolean):void
        {
            this._textField.selectable = arg1;
            return;
        }

        internal var _textField:flash.text.TextField;

        internal var _background:Boolean=false;

        internal var _backgroundColor:uint=16777215;

        internal var _border:Boolean=false;

        internal var _borderColor:uint=16777215;

        internal var _html:Boolean=false;
    }
}


//              class Title
package mgs.aurora.modules.controls.view.components 
{
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.modules.controls.view.layout.*;
    
    public class Title extends mgs.aurora.modules.controls.view.components.Button implements mgs.aurora.common.interfaces.controls.IButton
    {
        public function Title(arg1:String)
        {
            super(arg1);
            this._type = mgs.aurora.common.enums.controls.ControlType.TITLE;
            return;
        }

        public override function get minWidth():Number
        {
            var loc1:*=null;
            var loc2:*=NaN;
            if (this._textField != null) 
            {
                loc1 = this._spacing[this._textIndex];
                loc2 = this._textField.width + loc1.left + loc1.right;
                loc2 = loc2 > this._minWidth ? loc2 : this._minWidth;
                return loc2;
            }
            return super.minWidth;
        }

        public override function get maxWidth():Number
        {
            return 0;
        }

        public override function set maxWidth(arg1:Number):void
        {
            super.maxWidth = arg1;
            return;
        }
    }
}


//            package events
//              class ControlsEvent
package mgs.aurora.modules.controls.view.events 
{
    import flash.events.*;
    
    public class ControlsEvent extends flash.events.Event
    {
        public function ControlsEvent(arg1:String, arg2:Object)
        {
            super(arg1);
            this.data = arg2;
            return;
        }

        internal static const NAME:String="controls_builder/controls_event";

        public static const CREATE:String=NAME + "/create";

        public var data:Object;
    }
}


//              class SetupEvent
package mgs.aurora.modules.controls.view.events 
{
    import flash.events.*;
    
    public class SetupEvent extends flash.events.Event
    {
        public function SetupEvent(arg1:String, arg2:Object)
        {
            super(arg1);
            this.data = arg2;
            return;
        }

        internal static const NAME:String="controls_builder/setup_event";

        public static const CONFIG:String=NAME + "/config";

        public static const FONTS:String=NAME + "/fonts";

        public static const ART:String=NAME + "/art";

        public static const ART_LANG:String=NAME + "/art_lang";

        public var data:Object;
    }
}


//            package layout
//              class Alignment
package mgs.aurora.modules.controls.view.layout 
{
    public class Alignment extends Object
    {
        public function Alignment(arg1:String="alignment/left", arg2:String="alignment/middle")
        {
            super();
            this._horizontal = arg1;
            this._vertical = arg2;
            return;
        }

        public function get horizontal():String
        {
            return this._horizontal;
        }

        public function set horizontal(arg1:String):void
        {
            this._horizontal = arg1;
            return;
        }

        public function get vertical():String
        {
            return this._vertical;
        }

        public function set vertical(arg1:String):void
        {
            this._vertical = arg1;
            return;
        }

        public function clone():mgs.aurora.modules.controls.view.layout.Alignment
        {
            var loc1:*=new mgs.aurora.modules.controls.view.layout.Alignment(this._horizontal, this._vertical);
            return loc1;
        }

        public static const TOP:String="alignment/top";

        public static const MIDDLE:String="alignment/middle";

        public static const BOTTOM:String="alignment/bottom";

        public static const LEFT:String="alignment/left";

        public static const CENTER:String="alignment/center";

        public static const RIGHT:String="alignment/right";

        internal var _horizontal:String;

        internal var _vertical:String;
    }
}


//              class Spacing
package mgs.aurora.modules.controls.view.layout 
{
    public class Spacing extends Object
    {
        public function Spacing(arg1:Number=0, arg2:Number=0, arg3:Number=0, arg4:Number=0)
        {
            super();
            this.left = arg1;
            this.right = arg2;
            this.top = arg3;
            this.bottom = arg4;
            return;
        }

        public function set left(arg1:Number):void
        {
            this._left = arg1;
            return;
        }

        public function set right(arg1:Number):void
        {
            this._right = arg1;
            return;
        }

        public function set top(arg1:Number):void
        {
            this._top = arg1;
            return;
        }

        public function set bottom(arg1:Number):void
        {
            this._bottom = arg1;
            return;
        }

        public function setSpacing(arg1:Number):void
        {
            this.left = arg1;
            this.right = arg1;
            this.top = arg1;
            this.bottom = arg1;
            return;
        }

        public function clone():mgs.aurora.modules.controls.view.layout.Spacing
        {
            var loc1:*=new mgs.aurora.modules.controls.view.layout.Spacing(this._left, this._right, this._top, this._bottom);
            return loc1;
        }

        public function set spacing(arg1:Number):void
        {
            this.setSpacing(arg1);
            return;
        }

        public function get left():Number
        {
            return this._left;
        }

        public function get right():Number
        {
            return this._right;
        }

        public function get top():Number
        {
            return this._top;
        }

        public function get bottom():Number
        {
            return this._bottom;
        }

        internal var _left:Number=0;

        internal var _right:Number=0;

        internal var _top:Number=0;

        internal var _bottom:Number=0;
    }
}


//            class ControlsBuilderMediator
package mgs.aurora.modules.controls.view 
{
    import flash.utils.*;
    import mgs.aurora.modules.controls.*;
    import mgs.aurora.modules.controls.model.*;
    import mgs.aurora.modules.controls.view.events.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class ControlsBuilderMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function ControlsBuilderMediator(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public override function onRegister():void
        {
            this.builder.addEventListener(mgs.aurora.modules.controls.view.events.SetupEvent.CONFIG, this.onSetConfig);
            this.builder.addEventListener(mgs.aurora.modules.controls.view.events.SetupEvent.ART, this.onSetArt);
            this.builder.addEventListener(mgs.aurora.modules.controls.view.events.SetupEvent.FONTS, this.onSetFonts);
            this.builder.addEventListener(mgs.aurora.modules.controls.view.events.ControlsEvent.CREATE, this.onCreateControls);
            return;
        }

        public override function listNotificationInterests():Array
        {
            var loc1:*=super.listNotificationInterests();
            loc1.push(mgs.aurora.modules.controls.ControlsBuilderFacade.CONTROLS_CREATED);
            return loc1;
        }

        public override function handleNotification(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getName();
            switch (loc1) 
            {
                case mgs.aurora.modules.controls.ControlsBuilderFacade.CONTROLS_CREATED:
                {
                    this.builder.onControlsCreated(arg1.getBody() as flash.utils.Dictionary);
                    break;
                }
            }
            return;
        }

        internal function onSetConfig(arg1:mgs.aurora.modules.controls.view.events.SetupEvent):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.controls.model.ConfigProxy.NAME) as mgs.aurora.modules.controls.model.ConfigProxy;
            loc1.setData(arg1.data);
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.controls.model.FiltersProxy.NAME) as mgs.aurora.modules.controls.model.FiltersProxy;
            loc2.setData(arg1.data.dropShadow[0]);
            return;
        }

        internal function onSetArt(arg1:mgs.aurora.modules.controls.view.events.SetupEvent):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.controls.model.ArtProxy.NAME) as mgs.aurora.modules.controls.model.ArtProxy;
            loc1.setData(arg1.data);
            return;
        }

        internal function onSetFonts(arg1:mgs.aurora.modules.controls.view.events.SetupEvent):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.controls.model.FontsProxy.NAME) as mgs.aurora.modules.controls.model.FontsProxy;
            loc1.setData(arg1.data);
            return;
        }

        internal function onCreateControls(arg1:mgs.aurora.modules.controls.view.events.ControlsEvent):void
        {
            this.sendNotification(mgs.aurora.modules.controls.ControlsBuilderFacade.CREATE_CONTROLS, arg1.data as XMLList);
            return;
        }

        protected function get builder():mgs.aurora.modules.controls.ControlsBuilder
        {
            return this.viewComponent as mgs.aurora.modules.controls.ControlsBuilder;
        }

        public static const NAME:String="ControlsBuilderMediator";
    }
}


//          class ControlsBuilder
package mgs.aurora.modules.controls 
{
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.events.controlsBuilder.*;
    import mgs.aurora.modules.controls.view.events.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class ControlsBuilder extends flash.events.EventDispatcher
    {
        public function ControlsBuilder()
        {
            super();
            return;
        }

        public function init(arg1:String=null):void
        {
            this._name = arg1 == null ? this._name : arg1;
            this._facade = mgs.aurora.modules.controls.ControlsBuilderFacade.getInstance(this._name);
            this._facade.startup(this);
            return;
        }

        public function dispose():void
        {
            this._facade.dispose();
            org.puremvc.as3.multicore.patterns.facade.Facade.removeCore(this._name);
            return;
        }

        public function setConfig(arg1:XML):void
        {
            this.dispatchEvent(new mgs.aurora.modules.controls.view.events.SetupEvent(mgs.aurora.modules.controls.view.events.SetupEvent.CONFIG, arg1));
            return;
        }

        public function setFonts(arg1:flash.display.LoaderInfo):void
        {
            this.dispatchEvent(new mgs.aurora.modules.controls.view.events.SetupEvent(mgs.aurora.modules.controls.view.events.SetupEvent.FONTS, arg1));
            return;
        }

        public function setArt(arg1:flash.display.LoaderInfo):void
        {
            this.dispatchEvent(new mgs.aurora.modules.controls.view.events.SetupEvent(mgs.aurora.modules.controls.view.events.SetupEvent.ART, arg1));
            return;
        }

        public function setArtLanguage(arg1:flash.display.LoaderInfo):void
        {
            this.dispatchEvent(new mgs.aurora.modules.controls.view.events.SetupEvent(mgs.aurora.modules.controls.view.events.SetupEvent.ART_LANG, arg1));
            return;
        }

        public function createControls(arg1:XMLList):void
        {
            this.dispatchEvent(new mgs.aurora.modules.controls.view.events.ControlsEvent(mgs.aurora.modules.controls.view.events.ControlsEvent.CREATE, arg1));
            return;
        }

        public function onControlsCreated(arg1:flash.utils.Dictionary):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.controlsBuilder.ControlsBuilderEvent(mgs.aurora.common.events.controlsBuilder.ControlsBuilderEvent.CONTROLS_CREATED, arg1));
            return;
        }

        internal var _name:String="controls_builder";

        internal var _facade:mgs.aurora.modules.controls.ControlsBuilderFacade;
    }
}


//          class ControlsBuilderFacade
package mgs.aurora.modules.controls 
{
    import mgs.aurora.modules.controls.controller.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class ControlsBuilderFacade extends org.puremvc.as3.multicore.patterns.facade.Facade implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function ControlsBuilderFacade(arg1:String)
        {
            super(arg1);
            return;
        }

        public function startup(arg1:mgs.aurora.modules.controls.ControlsBuilder):void
        {
            this.sendNotification(mgs.aurora.modules.controls.ControlsBuilderFacade.STARTUP, arg1);
            this.removeCommand(mgs.aurora.modules.controls.ControlsBuilderFacade.STARTUP);
            return;
        }

        public function dispose():void
        {
            return;
        }

        protected override function initializeController():void
        {
            super.initializeController();
            this.registerCommand(mgs.aurora.modules.controls.ControlsBuilderFacade.STARTUP, mgs.aurora.modules.controls.controller.StartupCommand);
            this.registerCommand(mgs.aurora.modules.controls.ControlsBuilderFacade.CREATE_CONTROLS, mgs.aurora.modules.controls.controller.CreateControlsCommand);
            return;
        }

        public static function getInstance(arg1:String):mgs.aurora.modules.controls.ControlsBuilderFacade
        {
            if (mgs.aurora.modules.controls.ControlsBuilderFacade._instance == null) 
            {
                mgs.aurora.modules.controls.ControlsBuilderFacade._instance = new ControlsBuilderFacade(arg1);
            }
            return mgs.aurora.modules.controls.ControlsBuilderFacade._instance;
        }

        public static const NAME:String="ControlsBuilderFacade";

        public static const STARTUP:String=NAME + "/notes/startup";

        public static const CREATE_CONTROLS:String=NAME + "/notes/create_controls";

        public static const CONTROLS_CREATED:String=NAME + "/notes/controls_created";

        internal static var _instance:mgs.aurora.modules.controls.ControlsBuilderFacade;
    }
}


//        package dialogues
//          package controller
//            class BuildDialogueCommand
package mgs.aurora.modules.dialogues.controller 
{
    import __AS3__.vec.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.dialogues.*;
    import mgs.aurora.modules.dialogues.model.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    import mgs.aurora.modules.dialogues.model.layout.*;
    import mgs.aurora.modules.dialogues.view.*;
    import mgs.aurora.modules.dialogues.view.components.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class BuildDialogueCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function BuildDialogueCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.CurrentRequestProxy.NAME) as mgs.aurora.modules.dialogues.model.CurrentRequestProxy;
            var loc2:*=this.facade.retrieveMediator(mgs.aurora.modules.dialogues.view.DialoguesMediator.NAME) as mgs.aurora.modules.dialogues.view.DialoguesMediator;
            var loc3:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.ControlsProxy.NAME) as mgs.aurora.modules.dialogues.model.ControlsProxy;
            var loc4:*;
            (loc4 = new mgs.aurora.modules.dialogues.view.components.Dialogue(loc1.id, loc1.type)).setStageResolution(loc2.horizontalRes, loc2.verticalRes);
            var loc5:*=new mgs.aurora.modules.dialogues.model.layout.Spacing();
            var loc6:*=new mgs.aurora.modules.dialogues.model.layout.Alignment();
            var loc7:*=new Vector.<mgs.aurora.common.interfaces.controls.IControl>();
            var loc8:*=this.createTable("main", loc1.layoutConfig[0], loc5, loc6, loc4, loc7);
            loc4.setTable(loc8);
            loc4.setModal(loc3.getControl("modal"));
            var loc9:*=(loc7.length - 1);
            while (loc9 >= 0) 
            {
                loc4.addBackground(loc7[loc9] as mgs.aurora.common.interfaces.controls.IControl);
                --loc9;
            }
            this.sendNotification(mgs.aurora.modules.dialogues.DialoguesFacade.DIALOGUE_CREATED, loc4);
            return;
        }

        internal function createTable(arg1:String, arg2:XML, arg3:mgs.aurora.modules.dialogues.model.interfaces.ISpacing, arg4:mgs.aurora.modules.dialogues.model.interfaces.IAlignment, arg5:mgs.aurora.common.interfaces.dialogues.IDialogue, arg6:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IControl>):mgs.aurora.modules.dialogues.model.interfaces.ITable
        {
            var loc7:*=0;
            var loc8:*=null;
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.ControlsProxy.NAME) as mgs.aurora.modules.dialogues.model.ControlsProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.FiltersProxy.NAME) as mgs.aurora.modules.dialogues.model.FiltersProxy;
            var loc3:*=0;
            var loc4:*=0;
            var loc5:*=new mgs.aurora.modules.dialogues.model.layout.Table(arg1);
            var loc6:*;
            (loc6 = new flash.utils.Dictionary()).table = loc5;
            loc6.rows = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.IRow>();
            loc6.rowSpans = new flash.utils.Dictionary();
            loc6.columns = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.IColumn>();
            loc6.columnSpans = new flash.utils.Dictionary();
            loc6.cells = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>();
            loc6.controls = new Vector.<mgs.aurora.common.interfaces.controls.IControl>();
            loc6.matrix = new Vector.<Vector.<Boolean>>();
            arg3 = this.getPadding(arg2, arg3);
            arg4 = this.getAlignment(arg2, arg4);
            this.createColumns(arg2.children()[0], loc6);
            this.createRows(arg2[0], loc6);
            this.setupCompletionMatrix(loc6);
            this.createCells(arg2[0], arg3, arg4, loc6, arg5, arg6);
            loc7 = 0;
            while (loc7 < loc6.rows.length) 
            {
                loc5.addRow(loc6.rows[loc7]);
                ++loc7;
            }
            loc7 = 0;
            while (loc7 < loc6.columns.length) 
            {
                loc5.addColumn(loc6.columns[loc7]);
                ++loc7;
            }
            loc7 = 0;
            while (loc7 < loc6.cells.length) 
            {
                loc5.addCell(loc6.cells[loc7]);
                ++loc7;
            }
            if (arg2.@background.length() == 1) 
            {
                loc8 = loc1.getControl(arg2.@background);
                arg6.push(loc8);
                loc5.background = loc8;
                if (arg2.@dropshadow.length() == 1) 
                {
                    loc8.filters = [loc2.getDropshadow(arg2.@dropshadow)];
                }
            }
            loc7 = 0;
            while (loc7 < loc6.controls.length) 
            {
                arg5.addControl(loc6.controls[loc7]);
                ++loc7;
            }
            return loc5;
        }

        internal function createColumns(arg1:XML, arg2:flash.utils.Dictionary):void
        {
            var loc2:*=null;
            var loc3:*=NaN;
            var loc8:*=0;
            var loc1:*=arg1.children().length();
            var loc4:*=0;
            var loc5:*=arg2.columns;
            var loc6:*=arg2.table;
            var loc7:*=0;
            while (loc7 < loc1) 
            {
                loc2 = new mgs.aurora.modules.dialogues.model.layout.Column(loc4++, loc5.length > 0 ? loc5[(loc5.length - 1)] : null, loc6);
                loc5.push(loc2);
                loc3 = parseInt(arg1.children()[loc7].@colspan, 10);
                if (!isNaN(loc3) && loc3 > 1) 
                {
                    loc8 = 1;
                    while (loc8 < loc3) 
                    {
                        loc2 = new mgs.aurora.modules.dialogues.model.layout.Column(loc4++, loc5[(loc5.length - 1)]);
                        loc5.push(loc2);
                        ++loc8;
                    }
                }
                ++loc7;
            }
            return;
        }

        internal function createRows(arg1:XML, arg2:flash.utils.Dictionary):void
        {
            var loc2:*=null;
            var loc1:*=arg1.children().length();
            var loc3:*;
            var loc4:*=(loc3 = arg2.rows).length;
            var loc5:*=arg2.table;
            var loc6:*=0;
            while (loc6 < loc1) 
            {
                loc2 = new mgs.aurora.modules.dialogues.model.layout.Row(loc4++, loc3.length > 0 ? loc3[(loc3.length - 1)] : null, loc5);
                loc3.push(loc2);
                ++loc6;
            }
            return;
        }

        internal function createCells(arg1:XML, arg2:mgs.aurora.modules.dialogues.model.interfaces.ISpacing, arg3:mgs.aurora.modules.dialogues.model.interfaces.IAlignment, arg4:flash.utils.Dictionary, arg5:mgs.aurora.common.interfaces.dialogues.IDialogue, arg6:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IControl>):void
        {
            var loc2:*=0;
            var loc3:*=0;
            var loc4:*=null;
            var loc5:*=null;
            var loc6:*=null;
            var loc9:*=null;
            var loc10:*=null;
            var loc11:*=null;
            var loc12:*=null;
            var loc13:*=null;
            var loc14:*=null;
            var loc15:*=null;
            var loc17:*=null;
            var loc19:*=0;
            var loc20:*=0;
            var loc1:*=arg1.children().length();
            var loc7:*=arg4.cells;
            var loc8:*=arg4.controls;
            var loc16:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.ControlsProxy.NAME) as mgs.aurora.modules.dialogues.model.ControlsProxy;
            var loc18:*=0;
            while (loc18 < loc1) 
            {
                loc13 = arg1.children()[loc18];
                loc9 = this.getPadding(loc13, arg2);
                loc10 = this.getAlignment(loc13, arg3);
                loc2 = loc13.children().length();
                loc19 = 0;
                while (loc19 < loc2) 
                {
                    loc14 = loc13.children()[loc19];
                    loc11 = this.getPadding(loc14, loc9);
                    loc12 = this.getAlignment(loc14, loc10);
                    loc4 = (loc15 = this.getRowAndColumnForCell(loc18, loc14, arg4)).row;
                    loc5 = loc15.column;
                    loc6 = new mgs.aurora.modules.dialogues.model.layout.Cell(loc11, loc12);
                    loc4.addCell(loc6);
                    loc5.addCell(loc6);
                    loc6.row = loc4;
                    loc6.column = loc5;
                    if ((loc3 = loc14.ctrl.length()) > 0) 
                    {
                        loc20 = 0;
                        while (loc20 < loc3) 
                        {
                            if ((loc17 = loc16.getControl(loc14.ctrl[loc20].@id)) == null) 
                            {
                                throw new Error("Control with id [\"" + loc14.ctrl[loc20].@id + "\"] not created");
                            }
                            else 
                            {
                                loc6.addControl(loc17, this.getControlMargins(loc14.ctrl[loc20]));
                                loc8.push(loc17);
                            }
                            ++loc20;
                        }
                    }
                    else if (loc14.table.length() > 0) 
                    {
                        loc17 = this.createTable(loc4.index + "-" + loc5.index, loc14.table[0], loc11, loc12, arg5, arg6);
                        loc6.addControl(loc17, this.getControlMargins(loc14.table[0]));
                        mgs.aurora.modules.dialogues.model.interfaces.ITable(loc17).init();
                    }
                    loc7.push(loc6);
                    ++loc19;
                }
                ++loc18;
            }
            return;
        }

        internal function getRowAndColumnForCell(arg1:int, arg2:XML, arg3:flash.utils.Dictionary):flash.utils.Dictionary
        {
            var loc7:*=0;
            var loc9:*=0;
            var loc1:*=arg3.matrix;
            var loc2:*=arg3.rows;
            var loc3:*=arg3.columns;
            var loc4:*=new flash.utils.Dictionary();
            var loc5:*=parseInt(arg2.@rowspan, 10);
            var loc6:*=parseInt(arg2.@colspan, 10);
            loc7 = this.getNextColumnIndex(arg1, loc1);
            loc5 = isNaN(loc5) ? 1 : loc5;
            loc6 = isNaN(loc6) ? 1 : loc6;
            loc4.row = loc5 != 1 ? this.getRowSpan(arg1, loc5, arg3) : loc2[arg1];
            loc4.column = loc6 != 1 ? this.getColumnSpan(loc7, loc6, arg3) : loc3[loc7];
            var loc8:*=arg1;
            while (loc8 < loc5 + arg1) 
            {
                loc9 = loc7;
                while (loc9 < loc6 + loc7) 
                {
                    loc1[loc8][loc9] = true;
                    ++loc9;
                }
                ++loc8;
            }
            return loc4;
        }

        internal function getRowSpan(arg1:int, arg2:Number, arg3:flash.utils.Dictionary):mgs.aurora.modules.dialogues.model.interfaces.IRow
        {
            var loc5:*=0;
            var loc1:*=arg3.rows;
            var loc2:*=arg3.rowSpans;
            var loc3:*=arg1.toString() + arg2.toString();
            var loc4:*;
            if ((loc4 = loc2[loc3]) == null) 
            {
                loc4 = new mgs.aurora.modules.dialogues.model.layout.RowSpan();
                loc5 = arg1;
                while (loc5 < arg2 + arg1) 
                {
                    loc4.addRow(loc1[loc5]);
                    ++loc5;
                }
                loc2[loc3] = loc4;
            }
            return loc4;
        }

        internal function getColumnSpan(arg1:int, arg2:Number, arg3:flash.utils.Dictionary):mgs.aurora.modules.dialogues.model.interfaces.IColumn
        {
            var loc5:*=0;
            var loc1:*=arg3.columns;
            var loc2:*=arg3.columnSpans;
            var loc3:*=arg1.toString() + arg2.toString();
            var loc4:*;
            if ((loc4 = loc2[loc3]) == null) 
            {
                loc4 = new mgs.aurora.modules.dialogues.model.layout.ColumnSpan();
                loc5 = arg1;
                while (loc5 < arg2 + arg1) 
                {
                    loc4.addColumn(loc1[loc5]);
                    ++loc5;
                }
                loc2[loc3] = loc4;
            }
            return loc4;
        }

        internal function setupCompletionMatrix(arg1:flash.utils.Dictionary):void
        {
            var loc5:*=0;
            var loc1:*=arg1.matrix;
            var loc2:*=arg1.rows.length;
            var loc3:*=arg1.columns.length;
            var loc4:*=0;
            while (loc4 < loc2) 
            {
                loc1.push(new Vector.<Boolean>());
                loc5 = 0;
                while (loc5 < loc3) 
                {
                    loc1[loc4].push(false);
                    ++loc5;
                }
                ++loc4;
            }
            return;
        }

        internal function getNextColumnIndex(arg1:int, arg2:__AS3__.vec.Vector.<__AS3__.vec.Vector.<Boolean>>):int
        {
            var loc1:*=arg2[arg1];
            var loc2:*=-1;
            var loc3:*=0;
            while (loc3 < loc1.length) 
            {
                if (!loc1[loc3]) 
                {
                    loc2 = loc3;
                    break;
                }
                ++loc3;
            }
            return loc2;
        }

        internal function getPadding(arg1:XML, arg2:mgs.aurora.modules.dialogues.model.interfaces.ISpacing):mgs.aurora.modules.dialogues.model.interfaces.ISpacing
        {
            var loc3:*=null;
            var loc4:*=0;
            var loc1:*=false;
            var loc2:*;
            (loc2 = new Vector.<Object>()).push({"name":"spacing", "value":parseInt(arg1.@padding, 10)});
            loc2.push({"name":"left", "value":parseInt(arg1.@paddingLeft, 10)});
            loc2.push({"name":"right", "value":parseInt(arg1.@paddingRight, 10)});
            loc2.push({"name":"top", "value":parseInt(arg1.@paddingTop, 10)});
            loc2.push({"name":"bottom", "value":parseInt(arg1.@paddingBottom, 10)});
            while (loc4 < loc2.length) 
            {
                loc3 = loc2[loc4];
                if (!isNaN(loc3.value)) 
                {
                    if (!loc1) 
                    {
                        arg2 = arg2.clone();
                        loc1 = true;
                    }
                    arg2[loc3.name] = loc3.value;
                }
                ++loc4;
            }
            return arg2;
        }

        internal function getControlMargins(arg1:XML):mgs.aurora.modules.dialogues.model.interfaces.ISpacing
        {
            var loc3:*=null;
            var loc4:*=0;
            var loc1:*=new mgs.aurora.modules.dialogues.model.layout.Spacing();
            var loc2:*=new Vector.<Object>();
            loc2.push({"name":"spacing", "value":parseInt(arg1.@margin, 10)});
            loc2.push({"name":"left", "value":parseInt(arg1.@marginLeft, 10)});
            loc2.push({"name":"right", "value":parseInt(arg1.@marginRight, 10)});
            loc2.push({"name":"top", "value":parseInt(arg1.@marginTop, 10)});
            loc2.push({"name":"bottom", "value":parseInt(arg1.@marginBottom, 10)});
            while (loc4 < loc2.length) 
            {
                loc3 = loc2[loc4];
                if (!isNaN(loc3.value)) 
                {
                    loc1[loc3.name] = loc3.value;
                }
                ++loc4;
            }
            return loc1;
        }

        internal function getAlignment(arg1:XML, arg2:mgs.aurora.modules.dialogues.model.interfaces.IAlignment):mgs.aurora.modules.dialogues.model.interfaces.IAlignment
        {
            var loc3:*=null;
            var loc4:*=0;
            var loc1:*=false;
            var loc2:*;
            (loc2 = new Vector.<Object>()).push({"name":"horizontal", "value":arg1.@align});
            loc2.push({"name":"vertical", "value":arg1.@valign});
            while (loc4 < loc2.length) 
            {
                if ((loc3 = loc2[loc4]).value != undefined) 
                {
                    if (!loc1) 
                    {
                        arg2 = arg2.clone();
                        loc1 = true;
                    }
                    arg2[loc3.name] = mgs.aurora.modules.dialogues.model.layout.Alignment[String(loc3.value).toUpperCase()];
                }
                ++loc4;
            }
            return arg2;
        }
    }
}


//            class ControlsCreatedCommand
package mgs.aurora.modules.dialogues.controller 
{
    import flash.utils.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.modules.dialogues.*;
    import mgs.aurora.modules.dialogues.model.*;
    import mgs.aurora.modules.dialogues.model.controls.*;
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
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.ControlsProxy.NAME) as mgs.aurora.modules.dialogues.model.ControlsProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.CurrentRequestProxy.NAME) as mgs.aurora.modules.dialogues.model.CurrentRequestProxy;
            loc1.setData(this.wrapControls(arg1.getBody() as flash.utils.Dictionary, loc2.id, loc2.type));
            this.sendNotification(mgs.aurora.modules.dialogues.DialoguesFacade.BUILD_DIALOGUE);
            return;
        }

        internal function wrapControls(arg1:flash.utils.Dictionary, arg2:String, arg3:String):flash.utils.Dictionary
        {
            var loc2:*=null;
            var loc1:*=new flash.utils.Dictionary();
            var loc3:*=0;
            var loc4:*=arg1;
            for each (loc2 in loc4) 
            {
                var loc5:*=loc2.type;
                switch (loc5) 
                {
                    case mgs.aurora.common.enums.controls.ControlType.TEXT:
                    {
                        loc2 = new mgs.aurora.modules.dialogues.model.controls.DialogueText(loc2, arg2, arg3);
                        break;
                    }
                    case mgs.aurora.common.enums.controls.ControlType.INPUTTEXT:
                    {
                        loc2 = new mgs.aurora.modules.dialogues.model.controls.DialogueInputText(loc2, arg2, arg3);
                        break;
                    }
                    case mgs.aurora.common.enums.controls.ControlType.TITLE:
                    case mgs.aurora.common.enums.controls.ControlType.BUTTON:
                    {
                        loc2 = new mgs.aurora.modules.dialogues.model.controls.DialogueButton(loc2, arg2, arg3);
                        break;
                    }
                    case mgs.aurora.common.enums.controls.ControlType.CHECKBOX:
                    {
                        loc2 = new mgs.aurora.modules.dialogues.model.controls.DialogueCheckBox(loc2, arg2, arg3);
                        break;
                    }
                    case mgs.aurora.common.enums.controls.ControlType.RADIOBUTTON:
                    {
                        loc2 = new mgs.aurora.modules.dialogues.model.controls.DialogueRadioButton(loc2, arg2, arg3);
                        break;
                    }
                    case mgs.aurora.common.enums.controls.ControlType.COMBOBOX:
                    {
                        loc2 = new mgs.aurora.modules.dialogues.model.controls.DialogueComboBox(loc2, arg2, arg3);
                        break;
                    }
                    default:
                    {
                        loc2 = new mgs.aurora.modules.dialogues.model.controls.AbstractControlAdaptor(loc2, arg2, arg3);
                        break;
                    }
                }
                loc1[loc2.id] = loc2;
            }
            return loc1;
        }
    }
}


//            class CreateControlsCommand
package mgs.aurora.modules.dialogues.controller 
{
    import mgs.aurora.modules.dialogues.model.*;
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
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.CurrentRequestProxy.NAME) as mgs.aurora.modules.dialogues.model.CurrentRequestProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.ControlsBuilderProxy.NAME) as mgs.aurora.modules.dialogues.model.ControlsBuilderProxy;
            loc2.createControls(loc1.controlsConfig);
            return;
        }
    }
}


//            class DialogueCreatedCommand
package mgs.aurora.modules.dialogues.controller 
{
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.dialogues.model.*;
    import mgs.aurora.modules.dialogues.model.vo.*;
    import mgs.aurora.modules.dialogues.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class DialogueCreatedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function DialogueCreatedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.RequestQueueProxy.NAME) as mgs.aurora.modules.dialogues.model.RequestQueueProxy;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.CurrentRequestProxy.NAME) as mgs.aurora.modules.dialogues.model.CurrentRequestProxy;
            var loc3:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.HandlersProxy.NAME) as mgs.aurora.modules.dialogues.model.HandlersProxy;
            var loc4:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.DialogueStoreProxy.NAME) as mgs.aurora.modules.dialogues.model.DialogueStoreProxy;
            var loc5:*=new mgs.aurora.modules.dialogues.model.vo.DialogueResponse(loc2.getData() as mgs.aurora.modules.dialogues.model.vo.DialogueRequest, arg1.getBody() as mgs.aurora.common.interfaces.dialogues.IDialogue);
            var loc6:*=this.facade.retrieveMediator(mgs.aurora.modules.dialogues.view.DialoguesMediator.NAME) as mgs.aurora.modules.dialogues.view.DialoguesMediator;
            loc3.dialogueCreated(loc5);
            if (loc4.count > 0) 
            {
                loc4.top.enabled = false;
            }
            loc4.add(loc5);
            this.facade.removeProxy(mgs.aurora.modules.dialogues.model.CurrentRequestProxy.NAME);
            loc6.dialogueCreated(loc5);
            if (loc1.hasNext()) 
            {
                this.facade.registerProxy(new mgs.aurora.modules.dialogues.model.CurrentRequestProxy(loc1.getNext()));
            }
            return;
        }
    }
}


//            class DialogueDisplayedCommand
package mgs.aurora.modules.dialogues.controller 
{
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.dialogues.model.*;
    import mgs.aurora.modules.dialogues.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class DialogueDisplayedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function DialogueDisplayedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.HandlersProxy.NAME) as mgs.aurora.modules.dialogues.model.HandlersProxy;
            var loc2:*=this.facade.retrieveMediator(mgs.aurora.modules.dialogues.view.DialoguesMediator.NAME) as mgs.aurora.modules.dialogues.view.DialoguesMediator;
            var loc3:*=arg1.getBody().dialogue;
            var loc4:*=arg1.getBody().handlerId;
            loc1.dialogueDisplayed(loc3, loc4);
            loc2.dialogueDisplayed({"diagId":loc3.id, "diagType":loc3.type, "handlerId":loc4});
            return;
        }
    }
}


//            class DialogueRemovedCommand
package mgs.aurora.modules.dialogues.controller 
{
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.dialogues.model.*;
    import mgs.aurora.modules.dialogues.view.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class DialogueRemovedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function DialogueRemovedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.HandlersProxy.NAME) as mgs.aurora.modules.dialogues.model.HandlersProxy;
            var loc2:*=this.facade.retrieveMediator(mgs.aurora.modules.dialogues.view.DialoguesMediator.NAME) as mgs.aurora.modules.dialogues.view.DialoguesMediator;
            var loc3:*=arg1.getBody().dialogue;
            var loc4:*=arg1.getBody().handlerId;
            loc1.dialogueRemoved(loc3, loc4);
            loc2.dialogueRemoved({"diagId":loc3.id, "diagType":loc3.type, "handlerId":loc4});
            return;
        }
    }
}


//            class DialogueRequestedCommand
package mgs.aurora.modules.dialogues.controller 
{
    import mgs.aurora.modules.dialogues.model.*;
    import mgs.aurora.modules.dialogues.model.vo.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class DialogueRequestedCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function DialogueRequestedCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=arg1.getBody().data as mgs.aurora.modules.dialogues.model.vo.DialogueRequest;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.RequestQueueProxy.NAME) as mgs.aurora.modules.dialogues.model.RequestQueueProxy;
            var loc3:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.LayoutConfigProxy.NAME) as mgs.aurora.modules.dialogues.model.LayoutConfigProxy;
            var loc4:*;
            var loc5:*=(loc4 = this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.LayoutMappingConfigProxy.NAME) as mgs.aurora.modules.dialogues.model.LayoutMappingConfigProxy).getMapping(loc1.type);
            if (loc1.layoutConfig == null) 
            {
                loc1.layoutConfig = this.applyMappingSettings(this.addDefaultConfigAttributes(loc3.getDefinition(loc5.@type), loc3.getDefinition("default")), loc5);
            }
            loc2.add(loc1);
            if (!this.facade.hasProxy(mgs.aurora.modules.dialogues.model.CurrentRequestProxy.NAME)) 
            {
                this.facade.registerProxy(new mgs.aurora.modules.dialogues.model.CurrentRequestProxy(loc2.getNext()));
            }
            return;
        }

        internal function addDefaultConfigAttributes(arg1:XMLList, arg2:XMLList):XMLList
        {
            var loc2:*=null;
            var loc1:*=arg2.attributes().length();
            var loc3:*=0;
            while (loc3 < loc1) 
            {
                loc2 = arg2.attributes()[loc3].name();
                if (arg1.@[loc2].length() == 0) 
                {
                    arg1.@[loc2] = arg2.attributes()[loc3];
                }
                ++loc3;
            }
            return arg1;
        }

        internal function applyMappingSettings(arg1:XMLList, arg2:XML):XMLList
        {
            var config:XMLList;
            var mappingConfig:XML;
            var title:XML;
            var overrides:XMLList;
            var controlXml:XML;
            var controlOverideXml:XML;

            var loc1:*;
            title = null;
            overrides = null;
            controlXml = null;
            controlOverideXml = null;
            config = arg1;
            mappingConfig = arg2;
            var loc3:*=0;
            var loc4:*=config.controls.ctrl;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == "title") 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            title = loc2[0];
            overrides = mappingConfig.override;
            if (mappingConfig.@text.length() == 1) 
            {
                title.@text = mappingConfig.@text;
            }
            if (overrides.length() > 0) 
            {
                loc2 = 0;
                loc3 = overrides.controls[0].children();
                for each (controlOverideXml in loc3) 
                {
                    loc5 = 0;
                    loc6 = config.controls.ctrl;
                    loc4 = new XMLList("");
                    for each (var loc7:* in loc6) 
                    {
                        var loc8:*;
                        with (loc8 = loc7) 
                        {
                            if (@id == controlOverideXml.@id) 
                            {
                                loc4[loc5] = loc7;
                            }
                        }
                    }
                    controlXml = loc4[0];
                    this.setXmlPropertiesFromXml(controlXml, controlOverideXml);
                }
            }
            return config;
        }

        internal function setXmlPropertiesFromXml(arg1:XML, arg2:XML):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=0;
            var loc5:*=arg2.attributes();
            for each (loc1 in loc5) 
            {
                loc2 = loc1.name();
                loc3 = loc1.toString();
                arg1.@[loc2] = loc3;
            }
            return;
        }
    }
}


//            class PrepModelCommand
package mgs.aurora.modules.dialogues.controller 
{
    import mgs.aurora.modules.controls.*;
    import mgs.aurora.modules.dialogues.model.*;
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
            this.facade.registerProxy(new mgs.aurora.modules.dialogues.model.LayoutConfigProxy());
            this.facade.registerProxy(new mgs.aurora.modules.dialogues.model.LayoutMappingConfigProxy());
            this.facade.registerProxy(new mgs.aurora.modules.dialogues.model.RequestQueueProxy());
            this.facade.registerProxy(new mgs.aurora.modules.dialogues.model.HandlersProxy());
            this.facade.registerProxy(new mgs.aurora.modules.dialogues.model.ControlsProxy());
            this.facade.registerProxy(new mgs.aurora.modules.dialogues.model.ControlsBuilderProxy(new mgs.aurora.modules.controls.ControlsBuilder()));
            this.facade.registerProxy(new mgs.aurora.modules.dialogues.model.DialogueStoreProxy());
            this.facade.registerProxy(new mgs.aurora.modules.dialogues.model.FiltersProxy());
            return;
        }
    }
}


//            class PrepViewCommand
package mgs.aurora.modules.dialogues.controller 
{
    import mgs.aurora.modules.dialogues.view.*;
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
            this.facade.registerMediator(new mgs.aurora.modules.dialogues.view.DialoguesMediator(arg1.getBody()));
            return;
        }
    }
}


//            class RemoveDialogueCommand
package mgs.aurora.modules.dialogues.controller 
{
    import mgs.aurora.modules.dialogues.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RemoveDialogueCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RemoveDialogueCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.DialogueStoreProxy.NAME) as mgs.aurora.modules.dialogues.model.DialogueStoreProxy;
            var loc2:*=arg1.getBody().handlerId;
            var loc3:*=arg1.getBody().data;
            loc1.remove(loc3, loc2);
            return;
        }
    }
}


//            class RemovedFromContainerCommand
package mgs.aurora.modules.dialogues.controller 
{
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.dialogues.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.command.*;
    
    public class RemovedFromContainerCommand extends org.puremvc.as3.multicore.patterns.command.SimpleCommand implements org.puremvc.as3.multicore.interfaces.ICommand
    {
        public function RemovedFromContainerCommand()
        {
            super();
            return;
        }

        public override function execute(arg1:org.puremvc.as3.multicore.interfaces.INotification):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.DialogueStoreProxy.NAME) as mgs.aurora.modules.dialogues.model.DialogueStoreProxy;
            var loc2:*=arg1.getBody() as mgs.aurora.common.interfaces.dialogues.IDialogue;
            if (loc1.count > 0) 
            {
                loc1.top.enabled = true;
            }
            return;
        }
    }
}


//            class StartupCommand
package mgs.aurora.modules.dialogues.controller 
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
            this.addSubCommand(mgs.aurora.modules.dialogues.controller.PrepModelCommand);
            this.addSubCommand(mgs.aurora.modules.dialogues.controller.PrepViewCommand);
            return;
        }
    }
}


//          package model
//            package config
//              class LayoutConfigData
package mgs.aurora.modules.dialogues.model.config 
{
    public class LayoutConfigData extends Object
    {
        public function LayoutConfigData()
        {
            super();
            return;
        }

        public function setConfig(arg1:XML):void
        {
            this._global = arg1;
            return;
        }

        public function setCustomConfig(arg1:XML):void
        {
            this._custom = arg1;
            return;
        }

        public function removeCustomConfig():void
        {
            this._custom = null;
            return;
        }

        public function getDefinition(arg1:String):XMLList
        {
            var id:String;
            var def:XMLList;

            var loc1:*;
            def = null;
            id = arg1;
            if (this._custom == null) 
            {
                loc3 = 0;
                loc4 = this._global.dialogue;
                loc2 = new XMLList("");
                for each (loc5 in loc4) 
                {
                    with (loc6 = loc5) 
                    {
                        if (@id == id) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                def = loc2;
            }
            else 
            {
                var loc3:*=0;
                var loc4:*=this._custom.dialogue;
                var loc2:*=new XMLList("");
                for each (var loc5:* in loc4) 
                {
                    var loc6:*;
                    with (loc6 = loc5) 
                    {
                        if (@id == id) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                def = loc2;
                if (def.length() == 0) 
                {
                    loc3 = 0;
                    loc4 = this._global.dialogue;
                    loc2 = new XMLList("");
                    for each (loc5 in loc4) 
                    {
                        with (loc6 = loc5) 
                        {
                            if (@id == id) 
                            {
                                loc2[loc3] = loc5;
                            }
                        }
                    }
                    def = loc2;
                }
            }
            return def.copy();
        }

        internal var _global:XML;

        internal var _custom:XML;
    }
}


//            package controls
//              class AbstractControlAdaptor
package mgs.aurora.modules.dialogues.model.controls 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class AbstractControlAdaptor extends Object implements mgs.aurora.common.interfaces.controls.IControl, mgs.aurora.common.interfaces.controls.IControlDimensions
    {
        public function AbstractControlAdaptor(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:String=null, arg3:String=null)
        {
            super();
            this._control = arg1;
            this._diagId = arg2;
            this._diagType = arg3;
            this._eventDispatcher = new flash.events.EventDispatcher(this);
            this.setupEvents();
            return;
        }

        public function set alpha(arg1:Number):void
        {
            this._control.alpha = arg1;
            return;
        }

        public function get minWidth():Number
        {
            return mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).minWidth;
        }

        public function get maxWidth():Number
        {
            return mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).maxWidth;
        }

        public function get minHeight():Number
        {
            return mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).minHeight;
        }

        public function get id():String
        {
            return this._control.id;
        }

        protected function setupEvents():void
        {
            this._control.addEventListener(flash.events.Event.CHANGE, this.onEvent);
            return;
        }

        protected function onEvent(arg1:flash.events.Event):void
        {
            this.dispatchEvent(arg1);
            return;
        }

        public function get modal():Boolean
        {
            return this._modalState;
        }

        public function set modal(arg1:Boolean):void
        {
            this._modalState = arg1;
            return;
        }

        public function get maxHeight():Number
        {
            return mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).maxHeight;
        }

        public function set id(arg1:String):void
        {
            this._control.id = arg1;
            return;
        }

        public function get type():String
        {
            return this._control.type;
        }

        public function get x():Number
        {
            return this._control.x;
        }

        public function set x(arg1:Number):void
        {
            this._control.x = arg1;
            return;
        }

        public function get y():Number
        {
            return this._control.y;
        }

        public function set y(arg1:Number):void
        {
            this._control.y = arg1;
            return;
        }

        public function get width():Number
        {
            if (this._control.visible) 
            {
                return this._control.width;
            }
            return 0;
        }

        public function set width(arg1:Number):void
        {
            this._control.width = arg1;
            return;
        }

        public function get height():Number
        {
            if (this._control.visible) 
            {
                return this._control.height;
            }
            return 0;
        }

        public function set height(arg1:Number):void
        {
            this._control.height = arg1;
            return;
        }

        public function get enabled():Boolean
        {
            return this._control.enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            this._control.enabled = arg1;
            return;
        }

        public function get visible():Boolean
        {
            return this._control.visible;
        }

        public function set visible(arg1:Boolean):void
        {
            this._control.visible = arg1;
            return;
        }

        public function get hitTest():Boolean
        {
            return this._control.hitTest;
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return this._control.interactiveObject;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            this._control.addToContainer(arg1);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            this._control.addToContainerAt(arg1, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            this._control.removeFromContainer();
            return;
        }

        public function dispose():void
        {
            this._control.dispose();
            this._eventDispatcher = null;
            this._diagId = null;
            this._control = null;
            return;
        }

        public function addEventListener(arg1:String, arg2:Function, arg3:Boolean=false, arg4:int=0, arg5:Boolean=false):void
        {
            this._eventDispatcher.addEventListener(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public function dispatchEvent(arg1:flash.events.Event):Boolean
        {
            if (this.enabled && !this._modalState) 
            {
                return this._eventDispatcher.dispatchEvent(arg1);
            }
            return false;
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

        public function get filters():Array
        {
            return this._control.filters;
        }

        public function set filters(arg1:Array):void
        {
            this._control.filters = arg1;
            return;
        }

        public function get alpha():Number
        {
            return this._control.alpha;
        }

        protected var _control:mgs.aurora.common.interfaces.controls.IControl;

        protected var _modalState:Boolean=false;

        protected var _diagId:String;

        protected var _diagType:String;

        protected var _eventDispatcher:flash.events.EventDispatcher;
    }
}


//              class ButtonList
package mgs.aurora.modules.dialogues.model.controls 
{
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    
    public class ButtonList extends mgs.aurora.modules.dialogues.model.controls.ControlList implements mgs.aurora.common.interfaces.controls.IButtonList
    {
        public function ButtonList(arg1:String)
        {
            super(arg1);
            return;
        }

        public override function add(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            super.add(arg1);
            mgs.aurora.common.utilities.EventUtils.addDialogueMouseEventsToSingleMethod(arg1, this.onButtonMouseEvent);
            mgs.aurora.common.utilities.EventUtils.addDialogueKeyEventsToSingleMethod(arg1, this.onButtonKeyboardEvent);
            return;
        }

        public function getButton(arg1:String):mgs.aurora.common.interfaces.controls.IButton
        {
            return this.getControl(arg1) as mgs.aurora.common.interfaces.controls.IButton;
        }

        public function hasButtons(arg1:String):Boolean
        {
            return this.hasControls(arg1);
        }

        internal function onButtonMouseEvent(arg1:mgs.aurora.common.events.dialogues.DialogueMouseEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }

        internal function onButtonKeyboardEvent(arg1:mgs.aurora.common.events.dialogues.DialogueKeyboardEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }
    }
}


//              class CheckBoxList
package mgs.aurora.modules.dialogues.model.controls 
{
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    
    public class CheckBoxList extends mgs.aurora.modules.dialogues.model.controls.ControlList implements mgs.aurora.common.interfaces.controls.ICheckBoxList
    {
        public function CheckBoxList(arg1:String)
        {
            super(arg1);
            return;
        }

        public override function add(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            super.add(arg1);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueSelectionEvent.DESELECTED, this.onSelectionEvent);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueSelectionEvent.SELECTED, this.onSelectionEvent);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueSelectionEvent.SELECTION_CHANGE, this.onSelectionEvent);
            mgs.aurora.common.utilities.EventUtils.addDialogueKeyEventsToSingleMethod(arg1, this.onButtonKeyboardEvent);
            return;
        }

        public function getCheckBox(arg1:String):mgs.aurora.common.interfaces.controls.ICheckBox
        {
            return this.getControl(arg1) as mgs.aurora.common.interfaces.controls.ICheckBox;
        }

        public function hasCheckBox(arg1:String):Boolean
        {
            return this.hasControls(arg1);
        }

        protected function onSelectionEvent(arg1:mgs.aurora.common.events.dialogues.DialogueSelectionEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }

        internal function onButtonKeyboardEvent(arg1:mgs.aurora.common.events.dialogues.DialogueKeyboardEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }
    }
}


//              class ComboBoxList
package mgs.aurora.modules.dialogues.model.controls 
{
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class ComboBoxList extends mgs.aurora.modules.dialogues.model.controls.ControlList implements mgs.aurora.common.interfaces.controls.IComboBoxList
    {
        public function ComboBoxList(arg1:String)
        {
            super(arg1);
            return;
        }

        public override function add(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            super.add(arg1);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueSelectionEvent.SELECTION_CHANGE, this.onSelectionEvent);
            return;
        }

        public function getComboBox(arg1:String):mgs.aurora.common.interfaces.controls.IComboBox
        {
            return this.getControl(arg1) as mgs.aurora.common.interfaces.controls.IComboBox;
        }

        public function hasComboBox(arg1:String):Boolean
        {
            return this.hasControls(arg1);
        }

        protected function onSelectionEvent(arg1:mgs.aurora.common.events.dialogues.DialogueSelectionEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }
    }
}


//              class ControlList
package mgs.aurora.modules.dialogues.model.controls 
{
    import __AS3__.vec.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class ControlList extends Object implements mgs.aurora.common.interfaces.controls.IControlList, mgs.aurora.common.interfaces.controls.IAbstractControlList
    {
        public function ControlList(arg1:String)
        {
            super();
            this._controls = new flash.utils.Dictionary();
            this._eventDispatcher = new flash.events.EventDispatcher(this);
            this._diagId = arg1;
            return;
        }

        public function remove(arg1:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=arg1.split(",");
            var loc4:*=0;
            var loc5:*=loc1;
            for each (loc3 in loc5) 
            {
                if (!this._controls.hasOwnProperty(loc3)) 
                {
                    continue;
                }
                loc2 = this._controls[loc3];
                loc2.removeFromContainer();
                loc2.dispose();
                this._controls[loc3] = null;
                delete this._controls[loc3];
                loc2 = null;
            }
            return;
        }

        public function removeAll():void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=0;
            var loc4:*=this._controls;
            for each (loc1 in loc4) 
            {
                loc2 = loc1.id;
                loc1.removeFromContainer();
                loc1.dispose();
                this._controls[loc2] = null;
                delete this._controls[loc2];
                loc1 = null;
            }
            return;
        }

        public function get list():String
        {
            var loc2:*=null;
            var loc1:*=new Vector.<String>();
            var loc3:*=0;
            var loc4:*=this._controls;
            for each (loc2 in loc4) 
            {
                loc1.push(loc2.id);
            }
            return loc1.toString();
        }

        public function add(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            if (!this._controls.hasOwnProperty(arg1.id)) 
            {
                this._controls[arg1.id] = arg1;
            }
            return;
        }

        public function addList(arg1:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IControl>):void
        {
            return;
        }

        public function set modal(arg1:Boolean):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._controls;
            for each (loc1 in loc3) 
            {
                loc1.modal = arg1;
            }
            return;
        }

        public function enableControls(arg1:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=arg1.split(",");
            var loc4:*=0;
            var loc5:*=loc1;
            for each (loc3 in loc5) 
            {
                if (!this._controls.hasOwnProperty(loc3)) 
                {
                    continue;
                }
                loc2 = this._controls[loc3];
                loc2.enabled = true;
            }
            return;
        }

        public function enableAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._controls;
            for each (loc1 in loc3) 
            {
                loc1.enabled = true;
            }
            return;
        }

        public function disableControls(arg1:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=arg1.split(",");
            var loc4:*=0;
            var loc5:*=loc1;
            for each (loc3 in loc5) 
            {
                if (!this._controls.hasOwnProperty(loc3)) 
                {
                    continue;
                }
                loc2 = this._controls[loc3];
                loc2.enabled = false;
            }
            return;
        }

        public function disableAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._controls;
            for each (loc1 in loc3) 
            {
                loc1.enabled = false;
            }
            return;
        }

        public function showControls(arg1:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=arg1.split(",");
            var loc4:*=0;
            var loc5:*=loc1;
            for each (loc3 in loc5) 
            {
                if (!this._controls.hasOwnProperty(loc3)) 
                {
                    continue;
                }
                loc2 = this._controls[loc3];
                loc2.visible = true;
            }
            return;
        }

        public function showAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._controls;
            for each (loc1 in loc3) 
            {
                loc1.visible = true;
            }
            return;
        }

        public function hideControls(arg1:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=arg1.split(",");
            var loc4:*=0;
            var loc5:*=loc1;
            for each (loc3 in loc5) 
            {
                if (!this._controls.hasOwnProperty(loc3)) 
                {
                    continue;
                }
                loc2 = this._controls[loc3];
                loc2.visible = false;
            }
            return;
        }

        public function hideAllControls():void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._controls;
            for each (loc1 in loc3) 
            {
                loc1.visible = false;
            }
            return;
        }

        public function getControl(arg1:String):mgs.aurora.common.interfaces.controls.IControl
        {
            return this._controls[arg1];
        }

        public function hasControls(arg1:String):Boolean
        {
            var loc3:*=null;
            var loc1:*=arg1.split(",");
            var loc2:*=true;
            var loc4:*=0;
            var loc5:*=loc1;
            for each (loc3 in loc5) 
            {
                if (this._controls.hasOwnProperty(loc3)) 
                {
                    continue;
                }
                loc2 = false;
                break;
            }
            return loc2;
        }

        public function get enabledList():String
        {
            var loc2:*=null;
            var loc1:*=new Vector.<String>();
            var loc3:*=0;
            var loc4:*=this._controls;
            for each (loc2 in loc4) 
            {
                if (!loc2.enabled) 
                {
                    continue;
                }
                loc1.push(loc2.id);
            }
            return loc1.toString();
        }

        public function get disabledList():String
        {
            var loc2:*=null;
            var loc1:*=new Vector.<String>();
            var loc3:*=0;
            var loc4:*=this._controls;
            for each (loc2 in loc4) 
            {
                if (loc2.enabled) 
                {
                    continue;
                }
                loc1.push(loc2.id);
            }
            return loc1.toString();
        }

        public function get visibleList():String
        {
            var loc2:*=null;
            var loc1:*=new Vector.<String>();
            var loc3:*=0;
            var loc4:*=this._controls;
            for each (loc2 in loc4) 
            {
                if (!loc2.visible) 
                {
                    continue;
                }
                loc1.push(loc2.id);
            }
            return loc1.toString();
        }

        public function get hiddenList():String
        {
            var loc2:*=null;
            var loc1:*=new Vector.<String>();
            var loc3:*=0;
            var loc4:*=this._controls;
            for each (loc2 in loc4) 
            {
                if (loc2.visible) 
                {
                    continue;
                }
                loc1.push(loc2.id);
            }
            return loc1.toString();
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

        public function enable(arg1:String):void
        {
            this.enableControls(arg1);
            return;
        }

        public function enableAll():void
        {
            this.enableAllControls();
            return;
        }

        public function disable(arg1:String):void
        {
            this.disableControls(arg1);
            return;
        }

        public function disableAll():void
        {
            this.disableAllControls();
            return;
        }

        public function show(arg1:String):void
        {
            this.showControls(arg1);
            return;
        }

        public function showAll():void
        {
            this.showAllControls();
            return;
        }

        public function hide(arg1:String):void
        {
            this.hideControls(arg1);
            return;
        }

        public function hideAll():void
        {
            this.hideAllControls();
            return;
        }

        protected var _controls:flash.utils.Dictionary;

        protected var _eventDispatcher:flash.events.EventDispatcher;

        protected var _diagId:String;
    }
}


//              class DialogueButton
package mgs.aurora.modules.dialogues.model.controls 
{
    import flash.events.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    
    public class DialogueButton extends mgs.aurora.modules.dialogues.model.controls.AbstractControlAdaptor implements mgs.aurora.common.interfaces.controls.IButton
    {
        public function DialogueButton(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:String=null, arg3:String=null)
        {
            super(arg1, arg2, arg3);
            return;
        }

        protected function get dialogueButton():mgs.aurora.common.interfaces.controls.IButton
        {
            return this._control as mgs.aurora.common.interfaces.controls.IButton;
        }

        protected override function setupEvents():void
        {
            super.setupEvents();
            mgs.aurora.common.utilities.EventUtils.addSystemMouseEventsToSingleMethod(this._control, this.onMouseEvent);
            mgs.aurora.common.utilities.EventUtils.addSystemKeyEventsToSingleMethod(this._control, this.onKeyboardEvent);
            return;
        }

        protected function onMouseEvent(arg1:mgs.aurora.common.events.SystemMouseEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialogueMouseEvent(arg1.type, this._diagId, this._diagType, this, flash.events.MouseEvent(arg1.originalEvent)));
            return;
        }

        protected function onKeyboardEvent(arg1:mgs.aurora.common.events.SystemKeyboardEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialogueKeyboardEvent(arg1.type, this._diagId, this._diagType, this, flash.events.KeyboardEvent(arg1.originalEvent)));
            return;
        }

        public function get tabIndex():int
        {
            return this.dialogueButton.tabIndex;
        }

        public function set tabIndex(arg1:int):void
        {
            this.dialogueButton.tabIndex = arg1;
            return;
        }

        public function get textField():mgs.aurora.common.interfaces.controls.IText
        {
            return this.dialogueButton.textField;
        }

        public function setState(arg1:String):void
        {
            this.dialogueButton.setState(arg1);
            return;
        }

        public override function dispose():void
        {
            mgs.aurora.common.utilities.EventUtils.removeSystemMouseEventsFromSingleMethod(this._control, this.onMouseEvent);
            mgs.aurora.common.utilities.EventUtils.removeSystemKeyEventsFromSingleMethod(this._control, this.onKeyboardEvent);
            super.dispose();
            return;
        }
    }
}


//              class DialogueCheckBox
package mgs.aurora.modules.dialogues.model.controls 
{
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class DialogueCheckBox extends mgs.aurora.modules.dialogues.model.controls.DialogueButton implements mgs.aurora.common.interfaces.controls.ICheckBox
    {
        public function DialogueCheckBox(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:String=null, arg3:String=null)
        {
            super(arg1, arg2, arg3);
            return;
        }

        protected function get dialogueCheckBox():mgs.aurora.common.interfaces.controls.ICheckBox
        {
            return this._control as mgs.aurora.common.interfaces.controls.ICheckBox;
        }

        protected override function setupEvents():void
        {
            super.setupEvents();
            this._control.addEventListener(mgs.aurora.common.events.SystemSelectionEvent.DESELECTED, this.onSelectionEvent);
            this._control.addEventListener(mgs.aurora.common.events.SystemSelectionEvent.SELECTED, this.onSelectionEvent);
            this._control.addEventListener(mgs.aurora.common.events.SystemSelectionEvent.SELECTION_CHANGE, this.onSelectionEvent);
            return;
        }

        protected function onSelectionEvent(arg1:mgs.aurora.common.events.SystemSelectionEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialogueSelectionEvent(arg1.type, this._diagId, this._diagType, this));
            return;
        }

        public function get checked():Boolean
        {
            return this.dialogueCheckBox.checked;
        }

        public function set checked(arg1:Boolean):void
        {
            this.dialogueCheckBox.checked = arg1;
            return;
        }
    }
}


//              class DialogueComboBox
package mgs.aurora.modules.dialogues.model.controls 
{
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class DialogueComboBox extends mgs.aurora.modules.dialogues.model.controls.AbstractControlAdaptor implements mgs.aurora.common.interfaces.controls.IComboBox
    {
        public function DialogueComboBox(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:String=null, arg3:String=null)
        {
            super(arg1, arg2, arg3);
            this._inputText = new mgs.aurora.modules.dialogues.model.controls.DialogueInputText(this.dialogueComboBox.textField, arg2, arg3);
            return;
        }

        protected function get dialogueComboBox():mgs.aurora.common.interfaces.controls.IComboBox
        {
            return this._control as mgs.aurora.common.interfaces.controls.IComboBox;
        }

        protected override function setupEvents():void
        {
            super.setupEvents();
            this._control.addEventListener(mgs.aurora.common.events.SystemTextEvent.CHANGE, this.onTextEvent);
            this._control.addEventListener(mgs.aurora.common.events.SystemTextEvent.TEXT_INPUT, this.onTextEvent);
            this._control.addEventListener(mgs.aurora.common.events.SystemFocusEvent.FOCUS_IN, this.onFocusEvent);
            this._control.addEventListener(mgs.aurora.common.events.SystemFocusEvent.FOCUS_OUT, this.onFocusEvent);
            this._control.addEventListener(mgs.aurora.common.events.SystemSelectionEvent.SELECTION_CHANGE, this.onSelectionEvent);
            return;
        }

        protected function onTextEvent(arg1:mgs.aurora.common.events.SystemTextEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesTextEvent(arg1.type, this._diagId, this._diagType, this));
            return;
        }

        protected function onFocusEvent(arg1:mgs.aurora.common.events.SystemFocusEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialogueFocusEvent(arg1.type, this._diagId, this._diagType, this, arg1.originalEvent));
            return;
        }

        internal function onSelectionEvent(arg1:mgs.aurora.common.events.SystemSelectionEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialogueSelectionEvent(arg1.type, this._diagId, this._diagType, this));
            return;
        }

        public override function dispose():void
        {
            this._control.removeEventListener(mgs.aurora.common.events.SystemTextEvent.CHANGE, this.onTextEvent);
            this._control.removeEventListener(mgs.aurora.common.events.SystemTextEvent.TEXT_INPUT, this.onTextEvent);
            this._control.removeEventListener(mgs.aurora.common.events.SystemFocusEvent.FOCUS_IN, this.onFocusEvent);
            this._control.removeEventListener(mgs.aurora.common.events.SystemFocusEvent.FOCUS_OUT, this.onFocusEvent);
            this._control.removeEventListener(mgs.aurora.common.events.SystemSelectionEvent.SELECTION_CHANGE, this.onSelectionEvent);
            super.dispose();
            return;
        }

        public function get editable():Boolean
        {
            return this.dialogueComboBox.editable;
        }

        public function set editable(arg1:Boolean):void
        {
            this.dialogueComboBox.editable = arg1;
            return;
        }

        public function get selectedIndex():int
        {
            return this.dialogueComboBox.selectedIndex;
        }

        public function set selectedIndex(arg1:int):void
        {
            this.dialogueComboBox.selectedIndex = arg1;
            return;
        }

        public function get selectedItem():Object
        {
            return this.dialogueComboBox.selectedItem;
        }

        public function get text():String
        {
            return this.dialogueComboBox.text;
        }

        public function set text(arg1:String):void
        {
            this.dialogueComboBox.text = arg1;
            return;
        }

        public function get textField():mgs.aurora.common.interfaces.controls.IInputText
        {
            return this._inputText;
        }

        public function addItem(arg1:Object):void
        {
            this.dialogueComboBox.addItem(arg1);
            return;
        }

        public function addItemAt(arg1:Object, arg2:uint):void
        {
            this.dialogueComboBox.addItemAt(arg1, arg2);
            return;
        }

        public function close():void
        {
            this.dialogueComboBox.close();
            return;
        }

        public function getItemAt(arg1:uint):Object
        {
            return this.dialogueComboBox.getItemAt(arg1);
        }

        public function open():void
        {
            this.dialogueComboBox.open();
            return;
        }

        public function removeAll():void
        {
            this.dialogueComboBox.removeAll();
            return;
        }

        public function removeItem(arg1:Object):Object
        {
            return this.dialogueComboBox.removeItem(arg1);
        }

        public function removeItemAt(arg1:uint):Object
        {
            return this.dialogueComboBox.removeItemAt(arg1);
        }

        public function replaceItemAt(arg1:Object, arg2:uint):Object
        {
            return this.dialogueComboBox.replaceItemAt(arg1, arg2);
        }

        public function get numItems():int
        {
            return this.dialogueComboBox.numItems;
        }

        protected var _inputText:mgs.aurora.common.interfaces.controls.IInputText;
    }
}


//              class DialogueInputText
package mgs.aurora.modules.dialogues.model.controls 
{
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class DialogueInputText extends mgs.aurora.modules.dialogues.model.controls.DialogueText implements mgs.aurora.modules.dialogues.model.interfaces.IDialogueInputText
    {
        public function DialogueInputText(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:String=null, arg3:String=null)
        {
            super(arg1, arg2, arg3);
            return;
        }

        protected function get dialogueInputText():mgs.aurora.common.interfaces.controls.IInputText
        {
            return this._control as mgs.aurora.common.interfaces.controls.IInputText;
        }

        protected override function setupEvents():void
        {
            super.setupEvents();
            this._control.addEventListener(mgs.aurora.common.events.SystemTextEvent.CHANGE, this.onTextEvent);
            this._control.addEventListener(mgs.aurora.common.events.SystemTextEvent.TEXT_INPUT, this.onTextEvent);
            this._control.addEventListener(mgs.aurora.common.events.SystemFocusEvent.FOCUS_IN, this.onFocusEvent);
            this._control.addEventListener(mgs.aurora.common.events.SystemFocusEvent.FOCUS_OUT, this.onFocusEvent);
            return;
        }

        protected function onTextEvent(arg1:mgs.aurora.common.events.SystemTextEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesTextEvent(arg1.type, this._diagId, this._diagType, this));
            return;
        }

        protected function onFocusEvent(arg1:mgs.aurora.common.events.SystemFocusEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialogueFocusEvent(arg1.type, this._diagId, this._diagType, this, arg1.originalEvent));
            return;
        }

        public function setFocus():void
        {
            this.dialogueInputText.setFocus();
            return;
        }

        public function setSelection(arg1:int, arg2:int):void
        {
            this.dialogueInputText.setSelection(arg1, arg2);
            return;
        }

        public function get caretIndex():int
        {
            return this.dialogueInputText.caretIndex;
        }

        public function get selectionBeginIndex():int
        {
            return this.dialogueInputText.selectionBeginIndex;
        }

        public function get selectionEndIndex():int
        {
            return this.dialogueInputText.selectionEndIndex;
        }
    }
}


//              class DialogueRadioButton
package mgs.aurora.modules.dialogues.model.controls 
{
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class DialogueRadioButton extends mgs.aurora.modules.dialogues.model.controls.DialogueButton implements mgs.aurora.common.interfaces.controls.IRadioButton
    {
        public function DialogueRadioButton(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:String=null, arg3:String=null)
        {
            super(arg1, arg2, arg3);
            return;
        }

        protected function get dialogueRadioButton():mgs.aurora.common.interfaces.controls.IRadioButton
        {
            return this._control as mgs.aurora.common.interfaces.controls.IRadioButton;
        }

        protected override function setupEvents():void
        {
            super.setupEvents();
            this._control.addEventListener(mgs.aurora.common.events.SystemSelectionEvent.DESELECTED, this.onSelectionEvent);
            this._control.addEventListener(mgs.aurora.common.events.SystemSelectionEvent.SELECTED, this.onSelectionEvent);
            this._control.addEventListener(mgs.aurora.common.events.SystemSelectionEvent.SELECTION_CHANGE, this.onSelectionEvent);
            return;
        }

        internal function onSelectionEvent(arg1:mgs.aurora.common.events.SystemSelectionEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialogueSelectionEvent(arg1.type, this._diagId, this._diagType, this));
            return;
        }

        public function get selected():Boolean
        {
            return this.dialogueRadioButton.selected;
        }

        public function set selected(arg1:Boolean):void
        {
            this.dialogueRadioButton.selected = arg1;
            return;
        }

        public function get group():mgs.aurora.common.interfaces.controls.IRadioButtonGroup
        {
            return this.dialogueRadioButton.group;
        }

        public function set group(arg1:mgs.aurora.common.interfaces.controls.IRadioButtonGroup):void
        {
            return;
        }
    }
}


//              class DialogueText
package mgs.aurora.modules.dialogues.model.controls 
{
    import flash.text.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class DialogueText extends mgs.aurora.modules.dialogues.model.controls.AbstractControlAdaptor implements mgs.aurora.modules.dialogues.model.interfaces.IDialogueText
    {
        public function DialogueText(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:String=null, arg3:String=null)
        {
            super(arg1, arg2, arg3);
            return;
        }

        protected function get dialogueText():mgs.aurora.common.interfaces.controls.IText
        {
            return this._control as mgs.aurora.common.interfaces.controls.IText;
        }

        public function get text():String
        {
            return this.dialogueText.text;
        }

        public function set text(arg1:String):void
        {
            this.dialogueText.text = arg1;
            return;
        }

        public function get defaultTextFormat():flash.text.TextFormat
        {
            return this.dialogueText.defaultTextFormat;
        }

        public function set defaultTextFormat(arg1:flash.text.TextFormat):void
        {
            this.dialogueText.defaultTextFormat = arg1;
            return;
        }

        public function get properties():mgs.aurora.common.interfaces.controls.ITextFieldProperties
        {
            return this.dialogueText.properties;
        }

        public function getTextFormat(arg1:int=-1, arg2:int=-1):flash.text.TextFormat
        {
            return this.dialogueText.getTextFormat(arg1, arg2);
        }

        public function setTextFormat(arg1:flash.text.TextFormat, arg2:int=-1, arg3:int=-1):void
        {
            this.dialogueText.setTextFormat(arg1, arg2, arg3);
            return;
        }
    }
}


//              class RadioButtonList
package mgs.aurora.modules.dialogues.model.controls 
{
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.utilities.*;
    
    public class RadioButtonList extends mgs.aurora.modules.dialogues.model.controls.ControlList implements mgs.aurora.common.interfaces.controls.IRadioButtonList
    {
        public function RadioButtonList(arg1:String)
        {
            super(arg1);
            return;
        }

        public override function add(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            super.add(arg1);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueSelectionEvent.DESELECTED, this.onSelectionEvent);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueSelectionEvent.SELECTED, this.onSelectionEvent);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueSelectionEvent.SELECTION_CHANGE, this.onSelectionEvent);
            mgs.aurora.common.utilities.EventUtils.addDialogueKeyEventsToSingleMethod(arg1, this.onButtonKeyboardEvent);
            return;
        }

        public function getRadioButton(arg1:String):mgs.aurora.common.interfaces.controls.IRadioButton
        {
            return this.getControl(arg1) as mgs.aurora.common.interfaces.controls.IRadioButton;
        }

        public function hasRadioButtons(arg1:String):Boolean
        {
            return this.hasControls(arg1);
        }

        protected function onSelectionEvent(arg1:mgs.aurora.common.events.dialogues.DialogueSelectionEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }

        internal function onButtonKeyboardEvent(arg1:mgs.aurora.common.events.dialogues.DialogueKeyboardEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }
    }
}


//              class TextList
package mgs.aurora.modules.dialogues.model.controls 
{
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class TextList extends mgs.aurora.modules.dialogues.model.controls.ControlList implements mgs.aurora.common.interfaces.controls.ITextList
    {
        public function TextList(arg1:String)
        {
            super(arg1);
            return;
        }

        public override function add(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            super.add(arg1);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialoguesTextEvent.CHANGE, this.onTextEvent);
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialoguesTextEvent.TEXT_INPUT, this.onTextEvent);
            return;
        }

        public function getText(arg1:String):mgs.aurora.common.interfaces.controls.IText
        {
            return this.getControl(arg1) as mgs.aurora.common.interfaces.controls.IText;
        }

        public function getInputText(arg1:String):mgs.aurora.common.interfaces.controls.IInputText
        {
            return this.getControl(arg1) as mgs.aurora.common.interfaces.controls.IInputText;
        }

        public function hasText(arg1:String):Boolean
        {
            return this.hasControls(arg1);
        }

        protected function onTextEvent(arg1:mgs.aurora.common.events.dialogues.DialoguesTextEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }
    }
}


//            package events
//              class DialoguesHandlerRequestEvent
package mgs.aurora.modules.dialogues.model.events 
{
    import flash.events.*;
    
    public class DialoguesHandlerRequestEvent extends flash.events.Event
    {
        public function DialoguesHandlerRequestEvent(arg1:String, arg2:String, arg3:Object=null)
        {
            super(arg1);
            this.data = arg3;
            this.id = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent(type, this.id, this.data);
        }

        public override function toString():String
        {
            return formatToString("DialogueEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="dialogues/events/handler";

        public static const CREATE:String=NAME + "/create";

        public static const REMOVE:String=NAME + "/remove";

        public static const REMOVE_ALL:String=NAME + "/remove_all";

        public var data:Object;

        public var id:String;
    }
}


//            package handler
//              class DialoguesHandler
package mgs.aurora.modules.dialogues.model.handler 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.dialogues.model.events.*;
    import mgs.aurora.modules.dialogues.model.vo.*;
    import mgs.aurora.modules.dialogues.view.events.*;
    
    public class DialoguesHandler extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.dialogues.IDialoguesHandler
    {
        public function DialoguesHandler(arg1:flash.display.DisplayObjectContainer, arg2:String=null)
        {
            super();
            this._id = arg2 != null ? arg2 : mgs.aurora.common.utilities.GUID.create();
            this._dialogues = new flash.utils.Dictionary();
            this._dialogueIds = new Vector.<String>();
            this._container = arg1;
            return;
        }

        public function set uiConfig(arg1:XML):void
        {
            this._uiConfig = arg1;
            return;
        }

        public function get uiConfig():XML
        {
            return this._uiConfig;
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

        public function set artLang(arg1:flash.display.LoaderInfo):void
        {
            this._artLang = arg1;
            return;
        }

        public function get artLang():flash.display.LoaderInfo
        {
            return this._artLang;
        }

        public function set fonts(arg1:flash.display.LoaderInfo):void
        {
            this._fonts = arg1;
            return;
        }

        public function get fonts():flash.display.LoaderInfo
        {
            return this._fonts;
        }

        public function get displayedList():String
        {
            return this._dialogueIds.toString();
        }

        public function get numDisplayed():int
        {
            return this._numDisplayed;
        }

        public function get globalNumDisplayed():int
        {
            return this._globalNumDisplayed;
        }

        public function get id():String
        {
            return this._id;
        }

        public function create(arg1:String, arg2:String, arg3:flash.display.DisplayObjectContainer=null, arg4:XMLList=null, arg5:XMLList=null, arg6:flash.display.LoaderInfo=null, arg7:flash.display.LoaderInfo=null, arg8:flash.display.LoaderInfo=null):void
        {
            var loc1:*=null;
            if (arg3 == null) 
            {
                arg3 = this._container;
            }
            if (this._dialogues[arg1] == undefined) 
            {
                loc1 = new mgs.aurora.modules.dialogues.model.vo.DialogueRequest(this._id, arg1, arg2, arg3, arg4, arg5, arg6, arg7, arg8);
                this.dispatchEvent(new mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent(mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent.CREATE, this.id, loc1));
            }
            return;
        }

        public function remove(arg1:String):void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent(mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent.REMOVE, this.id, arg1));
            return;
        }

        public function removeAll():void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent(mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent.REMOVE, this.id, this._dialogueIds.toString()));
            return;
        }

        public function dialogue(arg1:String):mgs.aurora.common.interfaces.dialogues.IDialogue
        {
            if (this._dialogues[arg1] == undefined) 
            {
                return null;
            }
            return mgs.aurora.common.interfaces.dialogues.IDialogue(this._dialogues[arg1]);
        }

        public function onDialogueCreated(arg1:mgs.aurora.modules.dialogues.model.vo.DialogueResponse):void
        {
            var loc1:*=arg1.dialogue;
            loc1.addEventListener(mgs.aurora.modules.dialogues.view.events.DialogueEvent.DISPOSING, this.onDisposingEvent);
            loc1.addEventListener(mgs.aurora.modules.dialogues.view.events.DialogueEvent.REMOVE_FROM_CONTAINER, this.onDialogueEvent);
            this._dialogues[loc1.id] = loc1;
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesHandlerEvent(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.DIALOGUE_CREATED, this.id, loc1.id, loc1.type));
            return;
        }

        public function onDialogueDisplayed(arg1:mgs.aurora.modules.dialogues.view.events.DialogueHandlerManagerEvent):void
        {
            var loc1:*;
            var loc2:*=((loc1 = this)._globalNumDisplayed + 1);
            loc1._globalNumDisplayed = loc2;
            if (arg1.handlerId != this.id) 
            {
                this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesHandlerEvent(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.OTHER_DIALOGUE_DISPLAYED, arg1.handlerId, arg1.dialogue.id, arg1.dialogue.type));
            }
            else 
            {
                loc2 = ((loc1 = this)._numDisplayed + 1);
                loc1._numDisplayed = loc2;
                this._dialogueIds.push(arg1.dialogue.id);
                this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesHandlerEvent(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.DIALOGUE_DISPLAYED, arg1.handlerId, arg1.dialogue.id, arg1.dialogue.type));
            }
            return;
        }

        public function onDialogueRemoved(arg1:mgs.aurora.modules.dialogues.view.events.DialogueHandlerManagerEvent):void
        {
            var loc1:*=0;
            var loc2:*=0;
            var loc3:*;
            var loc4:*=((loc3 = this)._globalNumDisplayed - 1);
            loc3._globalNumDisplayed = loc4;
            if (arg1.handlerId != this.id) 
            {
                this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesHandlerEvent(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.OTHER_DIALOGUE_REMOVED, arg1.handlerId, arg1.dialogue.id, arg1.dialogue.type));
            }
            else 
            {
                loc1 = this._dialogueIds.length;
                loc4 = ((loc3 = this)._numDisplayed - 1);
                loc3._numDisplayed = loc4;
                loc2 = 0;
                while (loc2 < loc1) 
                {
                    if (this._dialogueIds[loc2] == arg1.dialogue.id) 
                    {
                        this._dialogueIds.splice(loc2, 1);
                        delete this._dialogues[arg1.dialogue.id];
                        break;
                    }
                    ++loc2;
                }
                this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesHandlerEvent(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.DIALOGUE_REMOVED, this.id, arg1.dialogue.id, arg1.dialogue.type));
            }
            if (this._globalNumDisplayed == 0) 
            {
                this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesHandlerEvent(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.ALL_DIALOGUES_REMOVED, this.id));
            }
            return;
        }

        public function onDialogueEvent(arg1:mgs.aurora.modules.dialogues.view.events.DialogueEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }

        protected function onDisposingEvent(arg1:mgs.aurora.modules.dialogues.view.events.DialogueEvent):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesHandlerEvent(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.REMOVING_DIALOGUE, this.id, arg1.dialogue.id, arg1.dialogue.type));
            return;
        }

        public function set layoutConfig(arg1:XML):void
        {
            this._layoutConfig = arg1;
            return;
        }

        public function get layoutConfig():XML
        {
            return this._layoutConfig;
        }

        internal var _id:String;

        internal var _dialogues:flash.utils.Dictionary;

        internal var _dialogueIds:__AS3__.vec.Vector.<String>;

        internal var _container:flash.display.DisplayObjectContainer;

        internal var _numDisplayed:int=0;

        internal var _globalNumDisplayed:int=0;

        internal var _layoutConfig:XML;

        internal var _uiConfig:XML;

        internal var _art:flash.display.LoaderInfo;

        internal var _artLang:flash.display.LoaderInfo;

        internal var _fonts:flash.display.LoaderInfo;
    }
}


//              class DialoguesHandlerManager
package mgs.aurora.modules.dialogues.model.handler 
{
    import flash.display.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.dialogues.model.events.*;
    import mgs.aurora.modules.dialogues.model.vo.*;
    import mgs.aurora.modules.dialogues.view.events.*;
    
    public class DialoguesHandlerManager extends flash.events.EventDispatcher
    {
        public function DialoguesHandlerManager()
        {
            super();
            this._handlers = new flash.utils.Dictionary();
            return;
        }

        public function setContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            this._container = arg1;
            return;
        }

        public function getNewHandler(arg1:String=null):mgs.aurora.common.interfaces.dialogues.IDialoguesHandler
        {
            var loc1:*=null;
            if (this._handlers[arg1]) 
            {
                throw new Error("Cannot create dialogues handler. A handler with id [\"" + arg1 + "\"] already exists.");
            }
            else 
            {
                loc1 = new mgs.aurora.modules.dialogues.model.handler.DialoguesHandler(this._container, arg1);
                loc1.addEventListener(mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent.CREATE, this.onHandlerRequest);
                loc1.addEventListener(mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent.REMOVE, this.onHandlerRequest);
                loc1.addEventListener(mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent.REMOVE_ALL, this.onHandlerRequest);
                loc1.addEventListener(mgs.aurora.modules.dialogues.view.events.DialogueEvent.REMOVE_FROM_CONTAINER, this.onDialogueEvent);
                loc1.addEventListener(mgs.aurora.common.events.dialogues.DialoguesHandlerEvent.REMOVING_DIALOGUE, this.onRemovingDialogue);
                this.addEventListener(mgs.aurora.modules.dialogues.view.events.DialogueHandlerManagerEvent.ADDED_TO_STAGE, loc1.onDialogueDisplayed);
                this.addEventListener(mgs.aurora.modules.dialogues.view.events.DialogueHandlerManagerEvent.REMOVED_FROM_STAGE, loc1.onDialogueRemoved);
                this._handlers[loc1.id] = loc1;
            }
            return loc1;
        }

        public function getHandler(arg1:String):mgs.aurora.common.interfaces.dialogues.IDialoguesHandler
        {
            var loc1:*=null;
            if (this._handlers[arg1]) 
            {
                loc1 = this._handlers[arg1];
            }
            else 
            {
                throw new Error("Cannot find dialogues handler with id [\"" + arg1 + "\"].");
            }
            return loc1;
        }

        public function dialogueCreated(arg1:mgs.aurora.modules.dialogues.model.vo.DialogueResponse):void
        {
            var loc1:*=this._handlers[arg1.request.handlerId] as mgs.aurora.modules.dialogues.model.handler.DialoguesHandler;
            loc1.onDialogueCreated(arg1);
            return;
        }

        protected function onHandlerRequest(arg1:mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }

        protected function onRemovingDialogue(arg1:mgs.aurora.common.events.dialogues.DialoguesHandlerEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }

        protected function onDialogueEvent(arg1:mgs.aurora.modules.dialogues.view.events.DialogueEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }

        public function onDialogueDisplayed(arg1:mgs.aurora.common.interfaces.dialogues.IDialogue, arg2:String):void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.DialogueHandlerManagerEvent(mgs.aurora.modules.dialogues.view.events.DialogueHandlerManagerEvent.ADDED_TO_STAGE, arg1, arg2));
            return;
        }

        public function onDialogueRemoved(arg1:mgs.aurora.common.interfaces.dialogues.IDialogue, arg2:String):void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.DialogueHandlerManagerEvent(mgs.aurora.modules.dialogues.view.events.DialogueHandlerManagerEvent.REMOVED_FROM_STAGE, arg1, arg2));
            return;
        }

        internal var _handlers:flash.utils.Dictionary;

        internal var _container:flash.display.DisplayObjectContainer;
    }
}


//            package interfaces
//              class IAlignment
package mgs.aurora.modules.dialogues.model.interfaces 
{
    public interface IAlignment
    {
        function get horizontal():String;

        function set horizontal(arg1:String):void;

        function get vertical():String;

        function set vertical(arg1:String):void;

        function clone():mgs.aurora.modules.dialogues.model.interfaces.IAlignment;
    }
}


//              class ICell
package mgs.aurora.modules.dialogues.model.interfaces 
{
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public interface ICell extends flash.events.IEventDispatcher
    {
        function addControl(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:mgs.aurora.modules.dialogues.model.interfaces.ISpacing=null):void;

        function redraw(arg1:flash.events.Event=null):void;

        function forceUpdate(arg1:flash.events.Event=null):void;

        function invalidate():void;

        function get invalidated():Boolean;

        function get spacing():mgs.aurora.modules.dialogues.model.interfaces.ISpacing;

        function get row():mgs.aurora.modules.dialogues.model.interfaces.IRow;

        function set row(arg1:mgs.aurora.modules.dialogues.model.interfaces.IRow):void;

        function get column():mgs.aurora.modules.dialogues.model.interfaces.IColumn;

        function set column(arg1:mgs.aurora.modules.dialogues.model.interfaces.IColumn):void;

        function get width():Number;

        function get height():Number;

        function get minWidth():Number;

        function get maxWidth():Number;

        function get minHeight():Number;

        function get maxHeight():Number;
    }
}


//              class IColumn
package mgs.aurora.modules.dialogues.model.interfaces 
{
    import flash.events.*;
    
    public interface IColumn extends flash.events.IEventDispatcher
    {
        function addCell(arg1:mgs.aurora.modules.dialogues.model.interfaces.ICell):void;

        function get index():int;

        function get x():Number;

        function get width():Number;

        function get minWidth():Number;

        function get maxWidth():Number;
    }
}


//              class IColumnSpan
package mgs.aurora.modules.dialogues.model.interfaces 
{
    public interface IColumnSpan extends mgs.aurora.modules.dialogues.model.interfaces.IColumn
    {
        function addColumn(arg1:mgs.aurora.modules.dialogues.model.interfaces.IColumn):void;
    }
}


//              class IControlAdaptor
package mgs.aurora.modules.dialogues.model.interfaces 
{
    import mgs.aurora.common.interfaces.controls.*;
    
    public interface IControlAdaptor extends mgs.aurora.common.interfaces.controls.IControl
    {
        function get control():mgs.aurora.common.interfaces.controls.IControl;

        function get spacing():mgs.aurora.modules.dialogues.model.interfaces.ISpacing;

        function get isVariableWidth():Boolean;

        function get isVariableHeight():Boolean;

        function get preferedWidth():Number;

        function get preferedHeight():Number;

        function get minWidth():Number;

        function get maxWidth():Number;

        function get minHeight():Number;

        function get maxHeight():Number;
    }
}


//              class IDialogueInputText
package mgs.aurora.modules.dialogues.model.interfaces 
{
    import mgs.aurora.common.interfaces.controls.*;
    
    public interface IDialogueInputText extends mgs.aurora.common.interfaces.controls.IInputText
    {
    }
}


//              class IDialogueText
package mgs.aurora.modules.dialogues.model.interfaces 
{
    import mgs.aurora.common.interfaces.controls.*;
    
    public interface IDialogueText extends mgs.aurora.common.interfaces.controls.IText
    {
    }
}


//              class IDimensions
package mgs.aurora.modules.dialogues.model.interfaces 
{
    public interface IDimensions
    {
        function get width():Number;

        function get height():Number;

        function get preferedWidth():Number;

        function get preferedHeight():Number;

        function get minWidth():Number;

        function get maxWidth():Number;

        function get minHeight():Number;

        function get maxHeight():Number;
    }
}


//              class ILayoutManager
package mgs.aurora.modules.dialogues.model.interfaces 
{
    import flash.events.*;
    
    public interface ILayoutManager extends flash.events.IEventDispatcher
    {
        function addRow(arg1:mgs.aurora.modules.dialogues.model.interfaces.IRow):void;

        function addColumn(arg1:mgs.aurora.modules.dialogues.model.interfaces.IColumn):void;

        function addCell(arg1:mgs.aurora.modules.dialogues.model.interfaces.ICell):void;

        function init():void;

        function refresh():void;
    }
}


//              class IRow
package mgs.aurora.modules.dialogues.model.interfaces 
{
    import flash.events.*;
    
    public interface IRow extends flash.events.IEventDispatcher
    {
        function addCell(arg1:mgs.aurora.modules.dialogues.model.interfaces.ICell):void;

        function get index():int;

        function get y():Number;

        function get height():Number;

        function get minHeight():Number;

        function get maxHeight():Number;
    }
}


//              class ISpacing
package mgs.aurora.modules.dialogues.model.interfaces 
{
    public interface ISpacing
    {
        function get left():Number;

        function set left(arg1:Number):void;

        function get right():Number;

        function set right(arg1:Number):void;

        function get top():Number;

        function set top(arg1:Number):void;

        function get bottom():Number;

        function set bottom(arg1:Number):void;

        function set spacing(arg1:Number):void;

        function setSpacing(arg1:Number):void;

        function clone():mgs.aurora.modules.dialogues.model.interfaces.ISpacing;
    }
}


//              class ITable
package mgs.aurora.modules.dialogues.model.interfaces 
{
    import mgs.aurora.common.interfaces.controls.*;
    
    public interface ITable extends mgs.aurora.common.interfaces.controls.IControl
    {
        function addRow(arg1:mgs.aurora.modules.dialogues.model.interfaces.IRow):void;

        function addColumn(arg1:mgs.aurora.modules.dialogues.model.interfaces.IColumn):void;

        function addCell(arg1:mgs.aurora.modules.dialogues.model.interfaces.ICell):void;

        function addControl(arg1:mgs.aurora.common.interfaces.controls.IControl):void;

        function init():void;

        function refreshLayout():void;

        function set background(arg1:mgs.aurora.common.interfaces.controls.IControl):void;

        function get background():mgs.aurora.common.interfaces.controls.IControl;
    }
}


//            package layout
//              class Alignment
package mgs.aurora.modules.dialogues.model.layout 
{
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class Alignment extends Object implements mgs.aurora.modules.dialogues.model.interfaces.IAlignment
    {
        public function Alignment(arg1:String="alignment/left", arg2:String="alignment/middle")
        {
            super();
            this._horizontal = arg1;
            this._vertical = arg2;
            return;
        }

        public function get horizontal():String
        {
            return this._horizontal;
        }

        public function set horizontal(arg1:String):void
        {
            this._horizontal = arg1;
            return;
        }

        public function get vertical():String
        {
            return this._vertical;
        }

        public function set vertical(arg1:String):void
        {
            this._vertical = arg1;
            return;
        }

        public function clone():mgs.aurora.modules.dialogues.model.interfaces.IAlignment
        {
            var loc1:*=new mgs.aurora.modules.dialogues.model.layout.Alignment(this._horizontal, this._vertical);
            return loc1;
        }

        public static const TOP:String="alignment/top";

        public static const MIDDLE:String="alignment/middle";

        public static const BOTTOM:String="alignment/bottom";

        public static const LEFT:String="alignment/left";

        public static const CENTER:String="alignment/center";

        public static const RIGHT:String="alignment/right";

        internal var _horizontal:String;

        internal var _vertical:String;
    }
}


//              class Cell
package mgs.aurora.modules.dialogues.model.layout 
{
    import __AS3__.vec.*;
    import flash.events.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class Cell extends flash.events.EventDispatcher implements mgs.aurora.modules.dialogues.model.interfaces.ICell, mgs.aurora.modules.dialogues.model.interfaces.IDimensions
    {
        public function Cell(arg1:mgs.aurora.modules.dialogues.model.interfaces.ISpacing, arg2:mgs.aurora.modules.dialogues.model.interfaces.IAlignment)
        {
            super();
            this._controls = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.IControlAdaptor>();
            this._padding = arg1;
            this._align = arg2;
            return;
        }

        internal function doTopAlign():void
        {
            var loc3:*=null;
            var loc1:*=this._row.y;
            var loc2:*=this._controls.length;
            var loc4:*=0;
            while (loc4 < loc2) 
            {
                loc3 = this._controls[loc4] as mgs.aurora.common.interfaces.controls.IControl;
                loc3.y = Math.floor(loc1 + this._padding.top);
                ++loc4;
            }
            return;
        }

        internal function doBottomAlign():void
        {
            var loc4:*=null;
            var loc1:*=this._row.height;
            var loc2:*=this._row.y;
            var loc3:*=this._controls.length;
            var loc5:*=0;
            while (loc5 < loc3) 
            {
                (loc4 = this._controls[loc5] as mgs.aurora.common.interfaces.controls.IControl).y = Math.floor(loc2 + loc1 - loc4.height - this._padding.bottom);
                ++loc5;
            }
            return;
        }

        internal function doMiddleAlign():void
        {
            var loc4:*=null;
            var loc1:*=this._row.height;
            var loc2:*=this._row.y;
            var loc3:*=this._controls.length;
            var loc5:*=0;
            var loc6:*=0;
            while (loc6 < loc3) 
            {
                (loc4 = this._controls[loc6] as mgs.aurora.common.interfaces.controls.IControl).y = Math.floor(loc2 + this._padding.top + (loc1 - loc4.height - this._padding.top - this._padding.bottom) / 2);
                ++loc6;
            }
            return;
        }

        internal function doLeftAlign():void
        {
            var loc1:*=this._controls.length;
            var loc2:*=this._controls[0] as mgs.aurora.common.interfaces.controls.IControl;
            var loc3:*=loc2;
            loc2.x = Math.floor(this._column.x + this._padding.left);
            var loc4:*=1;
            while (loc4 < loc1) 
            {
                loc2 = this._controls[loc4] as mgs.aurora.common.interfaces.controls.IControl;
                loc2.x = Math.floor(loc3.x + loc3.width);
                loc3 = loc2;
                ++loc4;
            }
            return;
        }

        public function redraw(arg1:flash.events.Event=null):void
        {
            var loc1:*=null;
            var loc2:*=null;
            if (this._controls.length > 0) 
            {
                this._height = this.getHeight(mgs.aurora.modules.dialogues.model.layout.Cell.CURRENT);
                this._width = this.getWidth(mgs.aurora.modules.dialogues.model.layout.Cell.CURRENT);
                loc1 = this._controls[0] as mgs.aurora.common.interfaces.controls.IControl;
                if (this._height > 0 && this._width > 0) 
                {
                    var loc3:*=this._align.vertical;
                    switch (loc3) 
                    {
                        case mgs.aurora.modules.dialogues.model.layout.Alignment.TOP:
                        {
                            this.doTopAlign();
                            break;
                        }
                        case mgs.aurora.modules.dialogues.model.layout.Alignment.MIDDLE:
                        {
                            this.doMiddleAlign();
                            break;
                        }
                        case mgs.aurora.modules.dialogues.model.layout.Alignment.BOTTOM:
                        {
                            this.doBottomAlign();
                            break;
                        }
                    }
                    loc3 = this._align.horizontal;
                    switch (loc3) 
                    {
                        case mgs.aurora.modules.dialogues.model.layout.Alignment.LEFT:
                        {
                            this.doLeftAlign();
                            break;
                        }
                        case mgs.aurora.modules.dialogues.model.layout.Alignment.CENTER:
                        {
                            this.doCenterAlign();
                            break;
                        }
                        case mgs.aurora.modules.dialogues.model.layout.Alignment.RIGHT:
                        {
                            this.doRightAlign();
                            break;
                        }
                    }
                }
                loc2 = mgs.aurora.modules.dialogues.model.interfaces.IControlAdaptor(loc1).control as mgs.aurora.modules.dialogues.model.interfaces.ITable;
                if (loc2 != null) 
                {
                    loc2.init();
                }
                this._invalidated = false;
            }
            return;
        }

        internal function doRightAlign():void
        {
            var loc1:*=this._controls.length;
            var loc2:*=this._controls[(loc1 - 1)] as mgs.aurora.common.interfaces.controls.IControl;
            var loc3:*=loc2;
            loc2.x = Math.floor(this._column.x + this._column.width - loc2.width - this._padding.right);
            var loc4:*=loc1 - 2;
            while (loc4 >= 0) 
            {
                loc2 = this._controls[loc4] as mgs.aurora.common.interfaces.controls.IControl;
                loc2.x = Math.floor(loc3.x - loc2.width);
                loc3 = loc2;
                --loc4;
            }
            return;
        }

        internal function doCenterAlign():void
        {
            var loc1:*=this._controls.length;
            var loc2:*=this._column.x;
            var loc3:*=this._column.width;
            var loc4:*=this.getWidth(mgs.aurora.modules.dialogues.model.layout.Cell.CURRENT) - this._padding.left - this._padding.right;
            var loc5:*;
            var loc6:*=loc5 = this._controls[0] as mgs.aurora.common.interfaces.controls.IControl;
            loc5.x = Math.floor(loc2 + this._padding.left + (loc3 - loc4 - this._padding.left - this._padding.right) / 2);
            var loc7:*=1;
            while (loc7 < loc1) 
            {
                (loc5 = this._controls[loc7] as mgs.aurora.common.interfaces.controls.IControl).x = Math.floor(loc6.x + loc6.width);
                loc6 = loc5;
                ++loc7;
            }
            return;
        }

        public function get spacing():mgs.aurora.modules.dialogues.model.interfaces.ISpacing
        {
            return this._padding;
        }

        public function addControl(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:mgs.aurora.modules.dialogues.model.interfaces.ISpacing=null):void
        {
            var loc1:*=new mgs.aurora.modules.dialogues.model.layout.ControlAdaptor(arg1, arg2);
            this._controls.push(loc1);
            loc1.addEventListener(flash.events.Event.CHANGE, this.onControlChange);
            this._height = this.getHeight(mgs.aurora.modules.dialogues.model.layout.Cell.CURRENT);
            this._width = this.getWidth(mgs.aurora.modules.dialogues.model.layout.Cell.CURRENT);
            return;
        }

        
        {
            CURRENT = "current";
            PREFERED = "prefered";
            MAX = "max";
            MIN = "min";
        }

        public function forceUpdate(arg1:flash.events.Event=null):void
        {
            this.invalidate();
            this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            return;
        }

        public function invalidate():void
        {
            this._invalidated = true;
            return;
        }

        public function get invalidated():Boolean
        {
            return this._invalidated;
        }

        public function get row():mgs.aurora.modules.dialogues.model.interfaces.IRow
        {
            return this._row;
        }

        public function set row(arg1:mgs.aurora.modules.dialogues.model.interfaces.IRow):void
        {
            if (this._row == null) 
            {
                this._row = arg1;
                this._row.addEventListener(flash.events.Event.CHANGE, this.onRowChange);
                this._row.addEventListener(flash.events.Event.RESIZE, this.onRowResize);
            }
            return;
        }

        public function get column():mgs.aurora.modules.dialogues.model.interfaces.IColumn
        {
            return this._column;
        }

        public function set column(arg1:mgs.aurora.modules.dialogues.model.interfaces.IColumn):void
        {
            if (this._column == null) 
            {
                this._column = arg1;
                this._column.addEventListener(flash.events.Event.CHANGE, this.onColumnChange);
                this._column.addEventListener(flash.events.Event.RESIZE, this.onColumnResize);
            }
            return;
        }

        public function get width():Number
        {
            if (this._invalidated) 
            {
                this._width = this.getWidth(mgs.aurora.modules.dialogues.model.layout.Cell.CURRENT);
            }
            return this._width;
        }

        public function get height():Number
        {
            if (this._invalidated) 
            {
                this._height = this.getHeight(mgs.aurora.modules.dialogues.model.layout.Cell.CURRENT);
            }
            return this._height;
        }

        public function get preferedWidth():Number
        {
            return this.getWidth(mgs.aurora.modules.dialogues.model.layout.Cell.PREFERED);
        }

        public function get preferedHeight():Number
        {
            return this.getHeight(mgs.aurora.modules.dialogues.model.layout.Cell.PREFERED);
        }

        public function get minWidth():Number
        {
            return this.getWidth(mgs.aurora.modules.dialogues.model.layout.Cell.MIN);
        }

        public function get maxWidth():Number
        {
            return this.getWidth(mgs.aurora.modules.dialogues.model.layout.Cell.MAX);
        }

        public function get minHeight():Number
        {
            return this.getHeight(mgs.aurora.modules.dialogues.model.layout.Cell.MIN);
        }

        public function get maxHeight():Number
        {
            return this.getHeight(mgs.aurora.modules.dialogues.model.layout.Cell.MAX);
        }

        internal function onControlChange(arg1:flash.events.Event):void
        {
            var loc1:*=null;
            if (!this._invalidated) 
            {
                loc1 = arg1.target as mgs.aurora.modules.dialogues.model.interfaces.IControlAdaptor;
                this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE, false, true));
            }
            return;
        }

        internal function onRowResize(arg1:flash.events.Event):void
        {
            if (this._controls.length > 0) 
            {
                this.invalidate();
                this.resizeControl(arg1);
            }
            return;
        }

        internal function onColumnResize(arg1:flash.events.Event):void
        {
            if (this._controls.length > 0) 
            {
                this.invalidate();
                this.resizeControl(arg1);
            }
            return;
        }

        internal function onRowChange(arg1:flash.events.Event):void
        {
            this.invalidate();
            return;
        }

        internal function onColumnChange(arg1:flash.events.Event):void
        {
            this.invalidate();
            return;
        }

        internal function resizeControl(arg1:flash.events.Event):void
        {
            var loc1:*=this._controls[0] as mgs.aurora.modules.dialogues.model.interfaces.IControlAdaptor;
            if (!(this.preferedWidth == this.column.width) || !(this.preferedHeight == this.row.height)) 
            {
                if (loc1.control.type == mgs.aurora.common.enums.controls.ControlType.TITLE) 
                {
                    loc1.width = mgs.aurora.modules.dialogues.model.interfaces.IDimensions(this.column).preferedWidth;
                    loc1.width = mgs.aurora.modules.dialogues.model.interfaces.IDimensions(this.column).width;
                }
                else 
                {
                    if (loc1.isVariableWidth) 
                    {
                        loc1.width = loc1.preferedWidth - this.spacing.left - this.spacing.right;
                        loc1.width = mgs.aurora.modules.dialogues.model.interfaces.IDimensions(this.column).width - this.spacing.left - this.spacing.right;
                        this._width = this.getWidth(mgs.aurora.modules.dialogues.model.layout.Cell.CURRENT);
                    }
                    if (loc1.isVariableHeight) 
                    {
                        loc1.height = loc1.preferedHeight - this.spacing.top - this.spacing.bottom;
                        loc1.height = mgs.aurora.modules.dialogues.model.interfaces.IDimensions(this.row).height - this.spacing.top - this.spacing.bottom;
                        this._height = this.getHeight(mgs.aurora.modules.dialogues.model.layout.Cell.CURRENT);
                    }
                }
            }
            return;
        }

        internal function getWidth(arg1:String):Number
        {
            var loc2:*=null;
            var loc1:*=0;
            var loc3:*=this._controls.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                loc2 = mgs.aurora.modules.dialogues.model.interfaces.IControlAdaptor(this._controls[loc4]);
                if (mgs.aurora.common.interfaces.controls.IControl(loc2).visible) 
                {
                    var loc5:*=arg1;
                    switch (loc5) 
                    {
                        case mgs.aurora.modules.dialogues.model.layout.Cell.CURRENT:
                        {
                            loc1 = loc1 + loc2.width;
                            break;
                        }
                        case mgs.aurora.modules.dialogues.model.layout.Cell.PREFERED:
                        {
                            loc1 = loc1 + loc2.preferedWidth;
                            break;
                        }
                        case mgs.aurora.modules.dialogues.model.layout.Cell.MAX:
                        {
                            loc1 = loc1 + loc2.maxWidth;
                            break;
                        }
                        case mgs.aurora.modules.dialogues.model.layout.Cell.MIN:
                        {
                            loc1 = loc1 + loc2.minWidth;
                            break;
                        }
                    }
                }
                ++loc4;
            }
            if (loc1 > 0) 
            {
                loc1 = loc1 + this._padding.left + this._padding.right;
            }
            return loc1;
        }

        internal function getHeight(arg1:String):Number
        {
            var loc4:*=null;
            var loc1:*=0;
            var loc2:*=0;
            var loc3:*=0;
            var loc5:*=this._controls.length;
            var loc6:*=0;
            while (loc6 < loc5) 
            {
                loc4 = mgs.aurora.modules.dialogues.model.interfaces.IControlAdaptor(this._controls[loc6]);
                if (mgs.aurora.common.interfaces.controls.IControl(loc4).visible) 
                {
                    var loc7:*=arg1;
                    switch (loc7) 
                    {
                        case mgs.aurora.modules.dialogues.model.layout.Cell.CURRENT:
                        {
                            loc2 = loc4.height;
                            loc1 = loc1 > loc2 ? loc1 : loc2;
                            break;
                        }
                        case mgs.aurora.modules.dialogues.model.layout.Cell.PREFERED:
                        {
                            loc2 = loc4.preferedHeight;
                            loc1 = loc1 > loc2 ? loc1 : loc2;
                            break;
                        }
                        case mgs.aurora.modules.dialogues.model.layout.Cell.MAX:
                        {
                            loc2 = loc4.maxHeight;
                            loc1 = loc1 > loc2 ? loc1 : loc2;
                            break;
                        }
                        case mgs.aurora.modules.dialogues.model.layout.Cell.MIN:
                        {
                            loc2 = loc4.minHeight;
                            loc1 = loc1 < loc2 && loc1 > 0 ? loc1 : loc2;
                            break;
                        }
                    }
                }
                ++loc6;
            }
            if (loc1 > 0) 
            {
                loc3 = loc1 + this._padding.top + this._padding.bottom;
            }
            return loc3;
        }

        internal var _controls:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.IControlAdaptor>;

        internal var _row:mgs.aurora.modules.dialogues.model.interfaces.IRow=null;

        internal var _column:mgs.aurora.modules.dialogues.model.interfaces.IColumn=null;

        internal var _padding:mgs.aurora.modules.dialogues.model.interfaces.ISpacing;

        internal var _invalidated:Boolean=true;

        internal var _width:Number=0;

        internal var _height:Number=0;

        internal var _align:mgs.aurora.modules.dialogues.model.interfaces.IAlignment;

        internal static var PREFERED:String="prefered";

        internal static var MAX:String="max";

        internal static var MIN:String="min";

        internal static var CURRENT:String="current";
    }
}


//              class Column
package mgs.aurora.modules.dialogues.model.layout 
{
    import __AS3__.vec.*;
    import flash.events.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class Column extends flash.events.EventDispatcher implements mgs.aurora.modules.dialogues.model.interfaces.IColumn, mgs.aurora.modules.dialogues.model.interfaces.IDimensions
    {
        public function Column(arg1:int, arg2:mgs.aurora.modules.dialogues.model.interfaces.IColumn=null, arg3:mgs.aurora.modules.dialogues.model.interfaces.ITable=null)
        {
            super();
            this._index = arg1;
            this._previousColumn = arg2;
            this._table = arg3;
            this._cells = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>();
            this._dimensions = new mgs.aurora.modules.dialogues.model.layout.LayoutDimensions(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.PREFERED);
            if (arg2 != null) 
            {
                this._previousColumn.addEventListener(flash.events.Event.CHANGE, this.onPreviousColumnChange);
                this._previousColumn.addEventListener(flash.events.Event.RESIZE, this.onPreviousColumnChange);
            }
            return;
        }

        public function addCell(arg1:mgs.aurora.modules.dialogues.model.interfaces.ICell):void
        {
            this._cells.push(arg1);
            arg1.column = this;
            this._dimensions.addWidthElement(arg1 as mgs.aurora.modules.dialogues.model.interfaces.IDimensions);
            arg1.addEventListener(flash.events.Event.CHANGE, this.onCellChange);
            return;
        }

        public function get index():int
        {
            return this._index;
        }

        public function get x():Number
        {
            if (this._previousColumn != null) 
            {
                return this._previousColumn.x + this._previousColumn.width;
            }
            if (this._table != null) 
            {
                return this._table.x;
            }
            return 0;
        }

        public function get width():Number
        {
            return this._dimensions.width;
        }

        public function get preferedWidth():Number
        {
            return this._dimensions.preferedWidth;
        }

        public function get minWidth():Number
        {
            return this._dimensions.minWidth;
        }

        public function get maxWidth():Number
        {
            return this._dimensions.maxWidth;
        }

        internal function onCellChange(arg1:flash.events.Event):void
        {
            var loc1:*=arg1.target as mgs.aurora.modules.dialogues.model.interfaces.ICell;
            this.dispatchEvent(new flash.events.Event(flash.events.Event.RESIZE, false, true));
            return;
        }

        internal function onPreviousColumnChange(arg1:flash.events.Event):void
        {
            this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE, false, true));
            return;
        }

        public function get height():Number
        {
            return 0;
        }

        public function get preferedHeight():Number
        {
            return 0;
        }

        public function get minHeight():Number
        {
            return 0;
        }

        public function get maxHeight():Number
        {
            return 0;
        }

        internal var _index:int;

        internal var _previousColumn:mgs.aurora.modules.dialogues.model.interfaces.IColumn;

        internal var _table:mgs.aurora.modules.dialogues.model.interfaces.ITable;

        internal var _cells:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>;

        internal var _height:Number=0;

        internal var _dimensions:mgs.aurora.modules.dialogues.model.layout.LayoutDimensions;
    }
}


//              class ColumnSpan
package mgs.aurora.modules.dialogues.model.layout 
{
    import __AS3__.vec.*;
    import flash.events.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class ColumnSpan extends flash.events.EventDispatcher implements mgs.aurora.modules.dialogues.model.interfaces.IColumn, mgs.aurora.modules.dialogues.model.interfaces.IColumnSpan, mgs.aurora.modules.dialogues.model.interfaces.IDimensions
    {
        public function ColumnSpan()
        {
            super();
            this._columns = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.IColumn>();
            this._cells = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>();
            this._spanCells = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>();
            this._dimensions = new mgs.aurora.modules.dialogues.model.layout.LayoutDimensions(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.TOTAL);
            this._cellDimensions = new mgs.aurora.modules.dialogues.model.layout.LayoutDimensions(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.PREFERED);
            return;
        }

        public function addColumn(arg1:mgs.aurora.modules.dialogues.model.interfaces.IColumn):void
        {
            this._columns.push(arg1);
            this._dimensions.addWidthElement(arg1 as mgs.aurora.modules.dialogues.model.interfaces.IDimensions);
            if (this._columns.length == 1) 
            {
                arg1.addEventListener(flash.events.Event.CHANGE, this.onColumnChange);
            }
            arg1.addEventListener(flash.events.Event.RESIZE, this.onColumnResize);
            var loc1:*=new mgs.aurora.modules.dialogues.model.layout.SpanCell();
            loc1.column = arg1;
            arg1.addCell(loc1);
            this._spanCells.push(loc1);
            return;
        }

        public function addCell(arg1:mgs.aurora.modules.dialogues.model.interfaces.ICell):void
        {
            this._cells.push(arg1);
            this._cellDimensions.addWidthElement(arg1 as mgs.aurora.modules.dialogues.model.interfaces.IDimensions);
            arg1.column = this;
            arg1.addEventListener(flash.events.Event.CHANGE, this.onCellResize, false, 1);
            return;
        }

        public function get index():int
        {
            return -1;
        }

        public function get x():Number
        {
            var loc1:*=this._columns[0] as mgs.aurora.modules.dialogues.model.interfaces.IColumn;
            return loc1.x;
        }

        public function get width():Number
        {
            return this._dimensions.width;
        }

        public function get minWidth():Number
        {
            return this._dimensions.minWidth;
        }

        public function get maxWidth():Number
        {
            return this._dimensions.maxWidth;
        }

        internal function onColumnChange(arg1:flash.events.Event=null):void
        {
            this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE, false, true));
            return;
        }

        internal function onCellResize(arg1:flash.events.Event=null):void
        {
            this.onLayoutResize(arg1);
            return;
        }

        internal function onColumnResize(arg1:flash.events.Event=null):void
        {
            this.onLayoutResize(arg1);
            return;
        }

        internal function onLayoutResize(arg1:flash.events.Event=null):void
        {
            this.setSpanCellStatus(false);
            var loc1:*=0;
            var loc2:*=this._dimensions.preferedWidth;
            var loc3:*=this._dimensions.width;
            var loc4:*=this._cellDimensions.preferedWidth;
            var loc5:*=false;
            this.setSpanCellStatus(true);
            if (loc4 > loc2) 
            {
                loc1 = loc4 - loc2;
                loc1 = loc1 >= 0 ? loc1 : 0;
                this.setSpanCellWidths(loc1);
                loc5 = true;
            }
            else if (loc4 < loc3) 
            {
                loc1 = loc4 - loc3;
                loc1 = loc1 >= 0 ? loc1 : 0;
                this.setSpanCellWidths(loc1);
                loc5 = true;
            }
            else 
            {
                this.setSpanCellWidths(0);
            }
            loc3 = this._dimensions.width;
            loc4 = this._cellDimensions.preferedWidth;
            if (this._width != loc3) 
            {
                this._width = loc3;
                this.dispatchEvent(new flash.events.Event(flash.events.Event.RESIZE, false, true));
            }
            return;
        }

        internal function setSpanCellWidths(arg1:Number):void
        {
            var loc2:*=null;
            var loc1:*=this._spanCells.length;
            var loc3:*=0;
            var loc4:*=this._spanCells;
            for each (loc2 in loc4) 
            {
                loc2.width = arg1 > 0 ? mgs.aurora.modules.dialogues.model.interfaces.IDimensions(loc2.column).preferedWidth + arg1 / loc1 : 0;
            }
            return;
        }

        internal function setSpanCellStatus(arg1:Boolean):void
        {
            var loc1:*=null;
            var loc2:*=0;
            var loc3:*=this._spanCells;
            for each (loc1 in loc3) 
            {
                loc1.enabled = arg1;
            }
            return;
        }

        public function get height():Number
        {
            return 0;
        }

        public function get preferedWidth():Number
        {
            return this._dimensions.preferedWidth;
        }

        public function get preferedHeight():Number
        {
            return 0;
        }

        public function get minHeight():Number
        {
            return 0;
        }

        public function get maxHeight():Number
        {
            return 0;
        }

        internal var _columns:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.IColumn>;

        internal var _cells:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>;

        internal var _spanCells:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>;

        internal var _dimensions:mgs.aurora.modules.dialogues.model.layout.LayoutDimensions;

        internal var _cellDimensions:mgs.aurora.modules.dialogues.model.layout.LayoutDimensions;

        internal var _width:Number;
    }
}


//              class ControlAdaptor
package mgs.aurora.modules.dialogues.model.layout 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class ControlAdaptor extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IControlDimensions, mgs.aurora.modules.dialogues.model.interfaces.IDimensions, mgs.aurora.modules.dialogues.model.interfaces.IControlAdaptor
    {
        public function ControlAdaptor(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:mgs.aurora.modules.dialogues.model.interfaces.ISpacing=null)
        {
            super();
            if (arg2 == null) 
            {
                arg2 = new mgs.aurora.modules.dialogues.model.layout.Spacing();
            }
            this._spacing = arg2;
            this._control = arg1;
            this._control.addEventListener(flash.events.Event.CHANGE, this.onControlChange);
            return;
        }

        public function get preferedHeight():Number
        {
            return this.minHeight;
        }

        public function get isVariableWidth():Boolean
        {
            return !(mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).maxWidth == mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).minWidth);
        }

        public function get isVariableHeight():Boolean
        {
            return !(mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).maxHeight == mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).minHeight);
        }

        public function get control():mgs.aurora.common.interfaces.controls.IControl
        {
            return this._control;
        }

        public function get enabled():Boolean
        {
            return this._control.enabled;
        }

        internal function onControlChange(arg1:flash.events.Event):void
        {
            this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            return;
        }

        public function get id():String
        {
            return this._control.id;
        }

        public function set id(arg1:String):void
        {
            return;
        }

        public function get type():String
        {
            return this._control.type;
        }

        public function get spacing():mgs.aurora.modules.dialogues.model.interfaces.ISpacing
        {
            return this._spacing;
        }

        public function set enabled(arg1:Boolean):void
        {
            this._control.enabled = arg1;
            return;
        }

        public function get visible():Boolean
        {
            return this._control.visible;
        }

        public function set visible(arg1:Boolean):void
        {
            this._control.visible = arg1;
            return;
        }

        public function get x():Number
        {
            return this._control.x - this._spacing.left;
        }

        public function set x(arg1:Number):void
        {
            this._control.x = arg1 + this._spacing.left;
            return;
        }

        public function get y():Number
        {
            return this._control.y - this._spacing.top;
        }

        public function set y(arg1:Number):void
        {
            this._control.y = arg1 + this._spacing.top;
            return;
        }

        public function get width():Number
        {
            var loc1:*=this._control.width;
            if (loc1 > 0) 
            {
                return this._control.width + this._spacing.left + this._spacing.right;
            }
            return 0;
        }

        public function set width(arg1:Number):void
        {
            var loc1:*=arg1 - this._spacing.left - this._spacing.right;
            var loc2:*=mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).minWidth;
            var loc3:*=mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).maxWidth;
            if (loc1 < loc2) 
            {
                loc1 = loc2;
            }
            else if (loc1 > loc3) 
            {
                if (loc3 > loc2) 
                {
                    loc1 = loc3;
                }
                else if (loc3 < loc2 && loc3 > 0) 
                {
                    loc1 = loc2;
                }
            }
            this._control.width = loc1;
            return;
        }

        public function get height():Number
        {
            var loc1:*=this._control.height;
            if (loc1 > 0) 
            {
                return this._control.height + this._spacing.top + this._spacing.bottom;
            }
            return 0;
        }

        public function set height(arg1:Number):void
        {
            var loc1:*=arg1 - this._spacing.top - this._spacing.bottom;
            var loc2:*=mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).minHeight;
            var loc3:*=mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).maxHeight;
            if (loc1 < loc2) 
            {
                loc1 = loc2;
            }
            else if (loc1 > loc3) 
            {
                if (loc3 > loc2) 
                {
                    loc1 = loc3;
                }
                else if (loc3 < loc2 && loc3 > 0) 
                {
                    loc1 = loc2;
                }
            }
            this._control.height = loc1;
            return;
        }

        public function get minWidth():Number
        {
            return mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).minWidth + this._spacing.left + this._spacing.right;
        }

        public function set minWidth(arg1:Number):void
        {
            return;
        }

        public function get maxWidth():Number
        {
            return mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).maxWidth + this._spacing.left + this._spacing.right;
        }

        public function set maxWidth(arg1:Number):void
        {
            return;
        }

        public function get minHeight():Number
        {
            return mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).minHeight + this._spacing.top + this._spacing.bottom;
        }

        public function set minHeight(arg1:Number):void
        {
            return;
        }

        public function get maxHeight():Number
        {
            return mgs.aurora.common.interfaces.controls.IControlDimensions(this._control).maxHeight + this._spacing.top + this._spacing.bottom;
        }

        public function set maxHeight(arg1:Number):void
        {
            return;
        }

        public function get hitTest():Boolean
        {
            return this._control.hitTest;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            this._control.addToContainer(arg1);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            this._control.addToContainerAt(arg1, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            this._control.removeFromContainer();
            return;
        }

        public function dispose():void
        {
            this._control.dispose();
            return;
        }

        public function get filters():Array
        {
            return this._control.filters;
        }

        public function set filters(arg1:Array):void
        {
            this._control.filters = arg1;
            return;
        }

        public function get alpha():Number
        {
            return this._control.alpha;
        }

        public function set alpha(arg1:Number):void
        {
            this._control.alpha = arg1;
            return;
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return this._control.interactiveObject;
        }

        public function get preferedWidth():Number
        {
            return this.minWidth;
        }

        internal var _control:mgs.aurora.common.interfaces.controls.IControl;

        internal var _spacing:mgs.aurora.modules.dialogues.model.interfaces.ISpacing;

        internal var _row:mgs.aurora.modules.dialogues.model.interfaces.IRow;

        internal var _column:mgs.aurora.modules.dialogues.model.interfaces.IColumn;

        internal var _precedingControl:mgs.aurora.common.interfaces.controls.IControl;
    }
}


//              class DepthManager
package mgs.aurora.modules.dialogues.model.layout 
{
    import flash.display.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    
    public class DepthManager extends Object
    {
        public function DepthManager(arg1:flash.display.DisplayObjectContainer)
        {
            super();
            this._container = arg1;
            return;
        }

        public function addControl(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            arg1.addEventListener(mgs.aurora.common.events.dialogues.DialogueFocusEvent.FOCUS_IN, this.onFocus);
            flash.display.Sprite(arg1.interactiveObject);
            return;
        }

        protected function onFocus(arg1:mgs.aurora.common.events.dialogues.DialogueFocusEvent):void
        {
            var loc1:*=arg1.control.interactiveObject as flash.display.DisplayObject;
            var loc2:*=this._container.getChildAt((this._container.numChildren - 1));
            if (loc1 != loc2) 
            {
                this._container.swapChildren(loc1, loc2);
            }
            return;
        }

        public function dispose():void
        {
            this._container = null;
            return;
        }

        protected var _container:flash.display.DisplayObjectContainer;
    }
}


//              class LayoutDimensions
package mgs.aurora.modules.dialogues.model.layout 
{
    import __AS3__.vec.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class LayoutDimensions extends Object implements mgs.aurora.modules.dialogues.model.interfaces.IDimensions
    {
        public function LayoutDimensions(arg1:String="total")
        {
            super();
            this._type = arg1;
            this._widthElements = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.IDimensions>();
            this._heightElements = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.IDimensions>();
            return;
        }

        public function addWidthElement(arg1:mgs.aurora.modules.dialogues.model.interfaces.IDimensions):void
        {
            this._widthElements.push(arg1);
            return;
        }

        public function addHeightElement(arg1:mgs.aurora.modules.dialogues.model.interfaces.IDimensions):void
        {
            this._heightElements.push(arg1);
            return;
        }

        public function get width():Number
        {
            if (this._type == mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.TOTAL) 
            {
                return this.getTotalDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.CURRENT, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH);
            }
            return this.getPreferedDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.CURRENT, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH);
        }

        public function get height():Number
        {
            if (this._type == mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.TOTAL) 
            {
                return this.getTotalDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.CURRENT, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.HEIGHT);
            }
            return this.getPreferedDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.CURRENT, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.HEIGHT);
        }

        public function get preferedWidth():Number
        {
            if (this._type == mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.TOTAL) 
            {
                return this.getTotalDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.PREFERED, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH);
            }
            return this.getPreferedDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.PREFERED, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH);
        }

        public function get preferedHeight():Number
        {
            if (this._type == mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.TOTAL) 
            {
                return this.getTotalDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.PREFERED, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.HEIGHT);
            }
            return this.getPreferedDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.PREFERED, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.HEIGHT);
        }

        public function get minWidth():Number
        {
            if (this._type == mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.TOTAL) 
            {
                return this.getTotalDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MIN, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH);
            }
            return this.getPreferedDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MIN, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH);
        }

        public function get maxWidth():Number
        {
            if (this._type == mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.TOTAL) 
            {
                return this.getTotalDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MAX, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH);
            }
            return this.getPreferedDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MAX, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH);
        }

        public function get minHeight():Number
        {
            if (this._type == mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.TOTAL) 
            {
                return this.getTotalDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MIN, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.HEIGHT);
            }
            return this.getPreferedDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MIN, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.HEIGHT);
        }

        public function get maxHeight():Number
        {
            if (this._type == mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.TOTAL) 
            {
                return this.getTotalDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MAX, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.HEIGHT);
            }
            return this.getPreferedDimension(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MAX, mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.HEIGHT);
        }

        internal function getTotalDimension(arg1:String, arg2:String):Number
        {
            var loc2:*=null;
            var loc1:*=0;
            var loc3:*=arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? this._heightElements.length : this._widthElements.length;
            var loc4:*=0;
            while (loc4 < loc3) 
            {
                loc2 = mgs.aurora.modules.dialogues.model.interfaces.IDimensions(arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? this._heightElements[loc4] : this._widthElements[loc4]);
                var loc5:*=arg1;
                switch (loc5) 
                {
                    case mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.CURRENT:
                    {
                        loc1 = loc1 + (arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? loc2.height : loc2.width);
                        break;
                    }
                    case mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.PREFERED:
                    {
                        loc1 = loc1 + (arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? loc2.preferedHeight : loc2.preferedWidth);
                        break;
                    }
                    case mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MAX:
                    {
                        loc1 = loc1 + (arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? loc2.maxHeight : loc2.maxWidth);
                        break;
                    }
                    case mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MIN:
                    {
                        loc1 = loc1 + (arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? loc2.minHeight : loc2.minWidth);
                        break;
                    }
                }
                ++loc4;
            }
            return loc1;
        }

        internal function getPreferedDimension(arg1:String, arg2:String):Number
        {
            var loc3:*=null;
            var loc1:*=0;
            var loc2:*=0;
            var loc4:*=arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? this._heightElements.length : this._widthElements.length;
            var loc5:*=0;
            while (loc5 < loc4) 
            {
                loc3 = mgs.aurora.modules.dialogues.model.interfaces.IDimensions(arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? this._heightElements[loc5] : this._widthElements[loc5]);
                var loc6:*=arg1;
                switch (loc6) 
                {
                    case mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.CURRENT:
                    {
                        loc1 = (loc2 = arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? loc3.height : loc3.width) > loc1 ? loc2 : loc1;
                        break;
                    }
                    case mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.PREFERED:
                    {
                        loc1 = (loc2 = arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? loc3.preferedHeight : loc3.preferedWidth) > loc1 ? loc2 : loc1;
                        break;
                    }
                    case mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MAX:
                    {
                        loc1 = (loc2 = arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? loc3.maxHeight : loc3.maxWidth) > loc1 ? loc2 : loc1;
                        break;
                    }
                    case mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.MIN:
                    {
                        loc1 = (loc2 = arg2 != mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.WIDTH ? loc3.minHeight : loc3.minWidth) < loc1 ? loc2 : loc1;
                        break;
                    }
                }
                ++loc5;
            }
            return loc1;
        }

        public function dispose():void
        {
            this._heightElements = null;
            this._widthElements = null;
            return;
        }

        internal static const CURRENT:String="current";

        public static const PREFERED:String="prefered";

        internal static const MAX:String="max";

        internal static const MIN:String="min";

        internal static const HEIGHT:String="height";

        internal static const WIDTH:String="width";

        public static const TOTAL:String="total";

        internal var _type:String;

        internal var _widthElements:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.IDimensions>;

        internal var _heightElements:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.IDimensions>;
    }
}


//              class LayoutManager
package mgs.aurora.modules.dialogues.model.layout 
{
    import __AS3__.vec.*;
    import flash.events.*;
    import flash.utils.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class LayoutManager extends flash.events.EventDispatcher implements mgs.aurora.modules.dialogues.model.interfaces.ILayoutManager
    {
        public function LayoutManager()
        {
            super();
            this._rows = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.IRow>();
            this._columns = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.IColumn>();
            this._cells = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>();
            return;
        }

        public function addRow(arg1:mgs.aurora.modules.dialogues.model.interfaces.IRow):void
        {
            this._rows.push(arg1);
            return;
        }

        public function addColumn(arg1:mgs.aurora.modules.dialogues.model.interfaces.IColumn):void
        {
            this._columns.push(arg1);
            return;
        }

        public function addCell(arg1:mgs.aurora.modules.dialogues.model.interfaces.ICell):void
        {
            this._cells.push(arg1);
            arg1.addEventListener(flash.events.Event.CHANGE, this.onCellChanged, false, -1);
            arg1.invalidate();
            this.addEventListener(flash.events.Event.CHANGE, arg1.redraw);
            this.addEventListener(flash.events.Event.INIT, arg1.forceUpdate);
            return;
        }

        public function refresh():void
        {
            this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            return;
        }

        public function init():void
        {
            this.dispatchEvent(new flash.events.Event(flash.events.Event.INIT));
            return;
        }

        internal function onCellChanged(arg1:flash.events.Event):void
        {
            this.dispatchEvent(new flash.events.Event(flash.events.Event.RESIZE));
            return;
        }

        internal var _rows:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.IRow>;

        internal var _columns:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.IColumn>;

        internal var _cells:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>;

        internal var _redrawTimer:flash.utils.Timer;
    }
}


//              class Row
package mgs.aurora.modules.dialogues.model.layout 
{
    import __AS3__.vec.*;
    import flash.events.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class Row extends flash.events.EventDispatcher implements mgs.aurora.modules.dialogues.model.interfaces.IRow, mgs.aurora.modules.dialogues.model.interfaces.IDimensions
    {
        public function Row(arg1:int, arg2:mgs.aurora.modules.dialogues.model.interfaces.IRow=null, arg3:mgs.aurora.modules.dialogues.model.interfaces.ITable=null)
        {
            super();
            this._index = arg1;
            this._previousRow = arg2;
            this._table = arg3;
            this._cells = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>();
            this._dimensions = new mgs.aurora.modules.dialogues.model.layout.LayoutDimensions(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.PREFERED);
            if (arg2 != null) 
            {
                this._previousRow.addEventListener(flash.events.Event.CHANGE, this.onPreviousRowChange);
                this._previousRow.addEventListener(flash.events.Event.RESIZE, this.onPreviousRowChange);
            }
            return;
        }

        public function addCell(arg1:mgs.aurora.modules.dialogues.model.interfaces.ICell):void
        {
            this._cells.push(arg1);
            arg1.row = this;
            this._dimensions.addHeightElement(arg1 as mgs.aurora.modules.dialogues.model.interfaces.IDimensions);
            arg1.addEventListener(flash.events.Event.CHANGE, this.onCellChange);
            return;
        }

        public function get index():int
        {
            return this._index;
        }

        public function get y():Number
        {
            if (this._previousRow != null) 
            {
                return this._previousRow.y + this._previousRow.height;
            }
            if (this._table != null) 
            {
                return this._table.y;
            }
            return 0;
        }

        public function get height():Number
        {
            return this._dimensions.height;
        }

        public function get preferedHeight():Number
        {
            return this._dimensions.preferedHeight;
        }

        public function get minHeight():Number
        {
            return this._dimensions.minHeight;
        }

        public function get maxHeight():Number
        {
            return this._dimensions.maxHeight;
        }

        internal function onCellChange(arg1:flash.events.Event):void
        {
            var loc1:*=arg1.target as mgs.aurora.modules.dialogues.model.interfaces.ICell;
            this.dispatchEvent(new flash.events.Event(flash.events.Event.RESIZE, false, true));
            return;
        }

        internal function onPreviousRowChange(arg1:flash.events.Event):void
        {
            this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE, false, true));
            return;
        }

        public function get width():Number
        {
            return 0;
        }

        public function get preferedWidth():Number
        {
            return 0;
        }

        public function get minWidth():Number
        {
            return 0;
        }

        public function get maxWidth():Number
        {
            return 0;
        }

        internal var _index:int;

        internal var _previousRow:mgs.aurora.modules.dialogues.model.interfaces.IRow;

        internal var _table:mgs.aurora.modules.dialogues.model.interfaces.ITable;

        internal var _cells:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>;

        internal var _height:Number=0;

        internal var _dimensions:mgs.aurora.modules.dialogues.model.layout.LayoutDimensions;
    }
}


//              class RowSpan
package mgs.aurora.modules.dialogues.model.layout 
{
    import __AS3__.vec.*;
    import flash.events.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class RowSpan extends flash.events.EventDispatcher implements mgs.aurora.modules.dialogues.model.interfaces.IRow, mgs.aurora.modules.dialogues.model.interfaces.IDimensions
    {
        public function RowSpan()
        {
            super();
            this._rows = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.IRow>();
            this._cells = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>();
            this._spanCells = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>();
            this._dimensions = new mgs.aurora.modules.dialogues.model.layout.LayoutDimensions(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.TOTAL);
            this._cellDimensions = new mgs.aurora.modules.dialogues.model.layout.LayoutDimensions(mgs.aurora.modules.dialogues.model.layout.LayoutDimensions.PREFERED);
            return;
        }

        public function addRow(arg1:mgs.aurora.modules.dialogues.model.interfaces.IRow):void
        {
            this._rows.push(arg1);
            this._dimensions.addHeightElement(arg1 as mgs.aurora.modules.dialogues.model.interfaces.IDimensions);
            arg1.addEventListener(flash.events.Event.CHANGE, this.onLayoutChange);
            var loc1:*=new mgs.aurora.modules.dialogues.model.layout.SpanCell();
            loc1.row = arg1;
            arg1.addCell(loc1);
            this._spanCells.push(loc1);
            return;
        }

        public function addCell(arg1:mgs.aurora.modules.dialogues.model.interfaces.ICell):void
        {
            this._cells.push(arg1);
            this._cellDimensions.addHeightElement(arg1 as mgs.aurora.modules.dialogues.model.interfaces.IDimensions);
            arg1.row = this;
            arg1.addEventListener(flash.events.Event.CHANGE, this.onLayoutChange);
            return;
        }

        public function get index():int
        {
            return -1;
        }

        public function get y():Number
        {
            var loc1:*=this._rows[0] as mgs.aurora.modules.dialogues.model.interfaces.IRow;
            return loc1.y;
        }

        public function get height():Number
        {
            return this._dimensions.height;
        }

        public function get minHeight():Number
        {
            return this._dimensions.minHeight;
        }

        public function get maxHeight():Number
        {
            return this._dimensions.maxHeight;
        }

        internal function onLayoutChange(arg1:flash.events.Event):void
        {
            var loc1:*=0;
            var loc2:*=this.preferedHeight;
            var loc3:*;
            if ((loc3 = this._cellDimensions.preferedHeight) != loc2) 
            {
                loc1 = loc3 - loc2;
                loc1 = loc1 >= 0 ? loc1 : 0;
                this.setSpanCellHeights(loc1);
                this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
            }
            return;
        }

        internal function setSpanCellHeights(arg1:Number):void
        {
            var loc2:*=null;
            var loc1:*=this._spanCells.length;
            var loc3:*=0;
            var loc4:*=this._spanCells;
            for each (loc2 in loc4) 
            {
                loc2.height = arg1 > 0 ? mgs.aurora.modules.dialogues.model.interfaces.IDimensions(loc2.row).preferedHeight + arg1 / loc1 : 0;
            }
            return;
        }

        public function get width():Number
        {
            return 0;
        }

        public function get preferedWidth():Number
        {
            return 0;
        }

        public function get preferedHeight():Number
        {
            return this._dimensions.preferedHeight;
        }

        public function get minWidth():Number
        {
            return 0;
        }

        public function get maxWidth():Number
        {
            return 0;
        }

        internal var _rows:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.IRow>;

        internal var _cells:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>;

        internal var _spanCells:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>;

        internal var _dimensions:mgs.aurora.modules.dialogues.model.layout.LayoutDimensions;

        internal var _cellDimensions:mgs.aurora.modules.dialogues.model.layout.LayoutDimensions;
    }
}


//              class Spacing
package mgs.aurora.modules.dialogues.model.layout 
{
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class Spacing extends Object implements mgs.aurora.modules.dialogues.model.interfaces.ISpacing
    {
        public function Spacing(arg1:Number=0, arg2:Number=0, arg3:Number=0, arg4:Number=0)
        {
            super();
            this.left = arg1;
            this.right = arg2;
            this.top = arg3;
            this.bottom = arg4;
            return;
        }

        public function set left(arg1:Number):void
        {
            this._left = arg1;
            return;
        }

        public function set right(arg1:Number):void
        {
            this._right = arg1;
            return;
        }

        public function set top(arg1:Number):void
        {
            this._top = arg1;
            return;
        }

        public function set bottom(arg1:Number):void
        {
            this._bottom = arg1;
            return;
        }

        public function setSpacing(arg1:Number):void
        {
            this.left = arg1;
            this.right = arg1;
            this.top = arg1;
            this.bottom = arg1;
            return;
        }

        public function clone():mgs.aurora.modules.dialogues.model.interfaces.ISpacing
        {
            var loc1:*=new mgs.aurora.modules.dialogues.model.layout.Spacing(this._left, this._right, this._top, this._bottom);
            return loc1;
        }

        public function set spacing(arg1:Number):void
        {
            this.setSpacing(arg1);
            return;
        }

        public function get left():Number
        {
            return this._left;
        }

        public function get right():Number
        {
            return this._right;
        }

        public function get top():Number
        {
            return this._top;
        }

        public function get bottom():Number
        {
            return this._bottom;
        }

        internal var _left:Number=0;

        internal var _right:Number=0;

        internal var _top:Number=0;

        internal var _bottom:Number=0;
    }
}


//              class SpanCell
package mgs.aurora.modules.dialogues.model.layout 
{
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class SpanCell extends flash.events.EventDispatcher implements mgs.aurora.modules.dialogues.model.interfaces.ICell, mgs.aurora.modules.dialogues.model.interfaces.IDimensions
    {
        public function SpanCell()
        {
            super();
            return;
        }

        public function addControl(arg1:mgs.aurora.common.interfaces.controls.IControl, arg2:mgs.aurora.modules.dialogues.model.interfaces.ISpacing=null):void
        {
            return;
        }

        public function redraw(arg1:flash.events.Event=null):void
        {
            return;
        }

        public function invalidate():void
        {
            return;
        }

        public function forceUpdate(arg1:flash.events.Event=null):void
        {
            return;
        }

        public function set preferedWidth(arg1:Number):void
        {
            this._preferedWidth = arg1;
            return;
        }

        public function get preferedWidth():Number
        {
            return 0;
        }

        public function get preferedHeight():Number
        {
            return 0;
        }

        public function get invalidated():Boolean
        {
            return false;
        }

        public function get spacing():mgs.aurora.modules.dialogues.model.interfaces.ISpacing
        {
            return null;
        }

        public function get row():mgs.aurora.modules.dialogues.model.interfaces.IRow
        {
            return this._row;
        }

        public function set row(arg1:mgs.aurora.modules.dialogues.model.interfaces.IRow):void
        {
            if (this._row == null) 
            {
                this._row = arg1;
            }
            return;
        }

        public function get column():mgs.aurora.modules.dialogues.model.interfaces.IColumn
        {
            return this._column;
        }

        public function set column(arg1:mgs.aurora.modules.dialogues.model.interfaces.IColumn):void
        {
            if (this._column == null) 
            {
                this._column = arg1;
            }
            return;
        }

        public function get width():Number
        {
            return this._enabled ? this._width : 0;
        }

        public function get height():Number
        {
            return this._enabled ? this._height : 0;
        }

        public function get minWidth():Number
        {
            return 0;
        }

        public function get maxWidth():Number
        {
            return 0;
        }

        public function get minHeight():Number
        {
            return 0;
        }

        public function get maxHeight():Number
        {
            return 0;
        }

        public function set width(arg1:Number):void
        {
            if (arg1 != this._width) 
            {
                this._width = arg1;
                this.preferedWidth = arg1;
                this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE, false, true));
            }
            return;
        }

        public function set height(arg1:Number):void
        {
            if (arg1 != this._height) 
            {
                this._height = arg1;
                this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE, false, true));
            }
            return;
        }

        public function get enabled():Boolean
        {
            return this._enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            this._enabled = arg1;
            return;
        }

        internal var _row:mgs.aurora.modules.dialogues.model.interfaces.IRow=null;

        internal var _column:mgs.aurora.modules.dialogues.model.interfaces.IColumn=null;

        internal var _width:Number=0;

        internal var _height:Number=0;

        internal var _enabled:Boolean=true;

        internal var _preferedWidth:Number=0;
    }
}


//              class Table
package mgs.aurora.modules.dialogues.model.layout 
{
    import __AS3__.vec.*;
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    
    public class Table extends flash.events.EventDispatcher implements mgs.aurora.modules.dialogues.model.interfaces.ITable, mgs.aurora.common.interfaces.controls.IControlDimensions, mgs.aurora.modules.dialogues.model.interfaces.IDimensions
    {
        public function Table(arg1:String)
        {
            super();
            this._canvas = new flash.display.Sprite();
            this._layoutManager = new mgs.aurora.modules.dialogues.model.layout.LayoutManager();
            this._layoutManager.addEventListener(flash.events.Event.RESIZE, this.onLayoutChange);
            this._layoutDimensions = new mgs.aurora.modules.dialogues.model.layout.LayoutDimensions();
            this._controls = new Vector.<mgs.aurora.common.interfaces.controls.IControl>();
            this._cells = new Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>();
            this._id = arg1;
            return;
        }

        public function refreshLayout():void
        {
            var loc2:*=null;
            this._canvas.graphics.clear();
            var loc1:*=0;
            while (loc1 < this._cells.length) 
            {
                loc2 = this._cells[loc1] as mgs.aurora.modules.dialogues.model.interfaces.ICell;
                ++loc1;
            }
            this._layoutManager.refresh();
            this.refreshBackground();
            return;
        }

        public function init():void
        {
            this._layoutManager.init();
            this.refreshBackground();
            return;
        }

        internal function onLayoutChange(arg1:flash.events.Event=null):void
        {
            this.refreshLayout();
            return;
        }

        public function set background(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            this._background = arg1;
            return;
        }

        public function get background():mgs.aurora.common.interfaces.controls.IControl
        {
            return this._background;
        }

        internal function refreshBackground():void
        {
            if (this._background != null) 
            {
                this._background.x = Math.round(this.x);
                this._background.y = Math.round(this.y);
                this._background.width = Math.ceil(this.width);
                this._background.height = Math.ceil(this.height);
            }
            return;
        }

        public function addCell(arg1:mgs.aurora.modules.dialogues.model.interfaces.ICell):void
        {
            this._layoutManager.addCell(arg1);
            this._cells.push(arg1);
            return;
        }

        public function get filters():Array
        {
            return this._canvas.filters;
        }

        public function set filters(arg1:Array):void
        {
            this._canvas.filters = arg1;
            return;
        }

        public function get alpha():Number
        {
            return this._canvas.alpha;
        }

        public function set alpha(arg1:Number):void
        {
            this._canvas.alpha = arg1;
            return;
        }

        public function addRow(arg1:mgs.aurora.modules.dialogues.model.interfaces.IRow):void
        {
            this._layoutManager.addRow(arg1);
            arg1.addEventListener(flash.events.Event.RESIZE, this.onRowColumnChange);
            this._layoutDimensions.addHeightElement(arg1 as mgs.aurora.modules.dialogues.model.interfaces.IDimensions);
            return;
        }

        public function addColumn(arg1:mgs.aurora.modules.dialogues.model.interfaces.IColumn):void
        {
            this._layoutManager.addColumn(arg1);
            arg1.addEventListener(flash.events.Event.RESIZE, this.onRowColumnChange);
            this._layoutDimensions.addWidthElement(arg1 as mgs.aurora.modules.dialogues.model.interfaces.IDimensions);
            return;
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return this._canvas;
        }

        public function addControl(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            arg1.addToContainer(this._canvas);
            return;
        }

        public function onRowColumnChange(arg1:flash.events.Event):void
        {
            this.dispatchEvent(new flash.events.Event(flash.events.Event.CHANGE));
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
            return "table";
        }

        public function get enabled():Boolean
        {
            return true;
        }

        public function set enabled(arg1:Boolean):void
        {
            return;
        }

        public function get visible():Boolean
        {
            return true;
        }

        public function set visible(arg1:Boolean):void
        {
            return;
        }

        public function get x():Number
        {
            return this._x;
        }

        public function set x(arg1:Number):void
        {
            this._x = arg1;
            this._canvas.x = arg1;
            return;
        }

        public function get y():Number
        {
            return this._y;
        }

        public function set y(arg1:Number):void
        {
            this._y = arg1;
            this._canvas.y = arg1;
            return;
        }

        public function get width():Number
        {
            return this._layoutDimensions.width;
        }

        public function set width(arg1:Number):void
        {
            return;
        }

        public function get preferedWidth():Number
        {
            return this._layoutDimensions.preferedWidth;
        }

        public function get preferedHeight():Number
        {
            return this._layoutDimensions.preferedHeight;
        }

        public function get height():Number
        {
            return this._layoutDimensions.height;
        }

        public function set height(arg1:Number):void
        {
            return;
        }

        public function get minWidth():Number
        {
            return this._layoutDimensions.width;
        }

        public function set minWidth(arg1:Number):void
        {
            return;
        }

        public function get maxWidth():Number
        {
            return this._layoutDimensions.width;
        }

        public function set maxWidth(arg1:Number):void
        {
            return;
        }

        public function get minHeight():Number
        {
            return this._layoutDimensions.height;
        }

        public function set minHeight(arg1:Number):void
        {
            return;
        }

        public function get maxHeight():Number
        {
            return this._layoutDimensions.height;
        }

        public function set maxHeight(arg1:Number):void
        {
            return;
        }

        public function get hitTest():Boolean
        {
            return false;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            arg1.addChild(this._canvas);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            arg1.addChildAt(this._canvas, arg2);
            return;
        }

        public function removeFromContainer():void
        {
            this._canvas.parent.removeChild(this._canvas);
            return;
        }

        public function dispose():void
        {
            return;
        }

        internal var _layoutManager:mgs.aurora.modules.dialogues.model.interfaces.ILayoutManager;

        internal var _id:String;

        internal var _canvas:flash.display.Sprite;

        internal var _controls:__AS3__.vec.Vector.<mgs.aurora.common.interfaces.controls.IControl>;

        internal var _cells:__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.interfaces.ICell>;

        internal var _layoutDimensions:mgs.aurora.modules.dialogues.model.layout.LayoutDimensions;

        internal var _column:mgs.aurora.modules.dialogues.model.interfaces.IColumn;

        internal var _x:Number;

        internal var _y:Number;

        internal var _background:mgs.aurora.common.interfaces.controls.IControl;

        internal var _row:mgs.aurora.modules.dialogues.model.interfaces.IRow;
    }
}


//            package vo
//              class DialogueRequest
package mgs.aurora.modules.dialogues.model.vo 
{
    import flash.display.*;
    
    public class DialogueRequest extends Object
    {
        public function DialogueRequest(arg1:String, arg2:String, arg3:String, arg4:flash.display.DisplayObjectContainer=null, arg5:XMLList=null, arg6:XMLList=null, arg7:flash.display.LoaderInfo=null, arg8:flash.display.LoaderInfo=null, arg9:flash.display.LoaderInfo=null)
        {
            super();
            this.handlerId = arg1;
            this.id = arg2;
            this.type = arg3;
            this.container = arg4;
            this.layoutConfig = arg5;
            this.uiConfig = arg6;
            this.art = arg7;
            this.artLanguage = arg8;
            this.fonts = arg9;
            return;
        }

        public var handlerId:String;

        public var id:String;

        public var type:String;

        public var container:flash.display.DisplayObjectContainer;

        public var layoutConfig:XMLList;

        public var uiConfig:XMLList;

        public var art:flash.display.LoaderInfo;

        public var artLanguage:flash.display.LoaderInfo;

        public var fonts:flash.display.LoaderInfo;
    }
}


//              class DialogueResponse
package mgs.aurora.modules.dialogues.model.vo 
{
    import mgs.aurora.common.interfaces.dialogues.*;
    
    public class DialogueResponse extends Object
    {
        public function DialogueResponse(arg1:mgs.aurora.modules.dialogues.model.vo.DialogueRequest, arg2:mgs.aurora.common.interfaces.dialogues.IDialogue)
        {
            super();
            this.request = arg1;
            this.dialogue = arg2;
            return;
        }

        public var request:mgs.aurora.modules.dialogues.model.vo.DialogueRequest;

        public var dialogue:mgs.aurora.common.interfaces.dialogues.IDialogue;
    }
}


//            class ControlsBuilderProxy
package mgs.aurora.modules.dialogues.model 
{
    import flash.display.*;
    import flash.utils.*;
    import mgs.aurora.common.events.controlsBuilder.*;
    import mgs.aurora.modules.controls.*;
    import mgs.aurora.modules.dialogues.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class ControlsBuilderProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function ControlsBuilderProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public override function onRegister():void
        {
            this.builder.init("dialogues-controls-builder");
            this.builder.addEventListener(mgs.aurora.common.events.controlsBuilder.ControlsBuilderEvent.CONTROLS_CREATED, this.onControlsCreated);
            return;
        }

        public function setConfig(arg1:XML):void
        {
            this.builder.setConfig(arg1);
            return;
        }

        public function setFonts(arg1:flash.display.LoaderInfo):void
        {
            this.builder.setFonts(arg1);
            return;
        }

        public function setArt(arg1:flash.display.LoaderInfo):void
        {
            this.builder.setArt(arg1);
            return;
        }

        public function setArtLanguage(arg1:flash.display.LoaderInfo):void
        {
            this.builder.setArtLanguage(arg1);
            return;
        }

        public function createControls(arg1:XMLList):void
        {
            this.builder.createControls(arg1);
            return;
        }

        internal function onControlsCreated(arg1:mgs.aurora.common.events.controlsBuilder.ControlsBuilderEvent):void
        {
            this.sendNotification(mgs.aurora.modules.dialogues.DialoguesFacade.CONTROLS_CREATED, arg1.data as flash.utils.Dictionary);
            return;
        }

        internal function get builder():mgs.aurora.modules.controls.ControlsBuilder
        {
            return this.data as mgs.aurora.modules.controls.ControlsBuilder;
        }

        public static const NAME:String="ControlsBuilderProxy";
    }
}


//            class ControlsProxy
package mgs.aurora.modules.dialogues.model 
{
    import flash.utils.*;
    import mgs.aurora.common.interfaces.controls.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class ControlsProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function ControlsProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public function getControl(arg1:String):mgs.aurora.common.interfaces.controls.IControl
        {
            return this.controls[arg1] as mgs.aurora.common.interfaces.controls.IControl;
        }

        internal function get controls():flash.utils.Dictionary
        {
            return this.data as flash.utils.Dictionary;
        }

        public static const NAME:String="ControlsProxy";
    }
}


//            class CurrentRequestProxy
package mgs.aurora.modules.dialogues.model 
{
    import mgs.aurora.modules.dialogues.*;
    import mgs.aurora.modules.dialogues.model.vo.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class CurrentRequestProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function CurrentRequestProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public override function onRegister():void
        {
            this.sendNotification(mgs.aurora.modules.dialogues.DialoguesFacade.CREATE_CONTROLS);
            return;
        }

        public function get id():String
        {
            return this.request.id;
        }

        public function get type():String
        {
            return this.request.type;
        }

        public function get layoutConfig():XMLList
        {
            return this.request.layoutConfig.table;
        }

        public function get controlsConfig():XMLList
        {
            return this.request.layoutConfig.controls;
        }

        internal function get request():mgs.aurora.modules.dialogues.model.vo.DialogueRequest
        {
            return this.data as mgs.aurora.modules.dialogues.model.vo.DialogueRequest;
        }

        public static const NAME:String="CurrentRequestProxy";
    }
}


//            class DialogueStoreProxy
package mgs.aurora.modules.dialogues.model 
{
    import __AS3__.vec.*;
    import flash.utils.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.dialogues.*;
    import mgs.aurora.modules.dialogues.model.vo.*;
    import mgs.aurora.modules.dialogues.view.events.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class DialogueStoreProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function DialogueStoreProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public override function onRegister():void
        {
            this._handlerIds = new flash.utils.Dictionary();
            this._dialogues = new flash.utils.Dictionary();
            this._dialoguesOrder = new Vector.<String>();
            return;
        }

        public function add(arg1:mgs.aurora.modules.dialogues.model.vo.DialogueResponse):void
        {
            var loc1:*=arg1.dialogue;
            var loc2:*=arg1.request.handlerId;
            this._dialoguesOrder.push(loc2 + "_" + loc1.id);
            this._handlerIds[loc1] = loc2;
            this._dialogues[loc2 + "_" + loc1.id] = loc1;
            loc1.addEventListener(mgs.aurora.modules.dialogues.view.events.DialogueEvent.ADDED_TO_STAGE, this.onAddedToStageEvent);
            loc1.addEventListener(mgs.aurora.modules.dialogues.view.events.DialogueEvent.REMOVED_FROM_STAGE, this.onRemovedFromStageEvent);
            loc1.addToContainer(arg1.request.container);
            return;
        }

        internal function onAddedToStageEvent(arg1:mgs.aurora.modules.dialogues.view.events.DialogueEvent):void
        {
            this.sendNotification(mgs.aurora.modules.dialogues.DialoguesFacade.DIALOGUE_DISPLAYED, {"dialogue":arg1.dialogue, "handlerId":this._handlerIds[arg1.dialogue]});
            return;
        }

        internal function onRemovedFromStageEvent(arg1:mgs.aurora.modules.dialogues.view.events.DialogueEvent):void
        {
            var loc1:*=this._handlerIds[arg1.dialogue];
            var loc2:*=arg1.dialogue;
            delete this._dialogues[loc1 + "_" + loc2.id];
            delete this._handlerIds[loc2];
            this.sendNotification(mgs.aurora.modules.dialogues.DialoguesFacade.DIALOGUE_REMOVED, {"dialogue":loc2, "handlerId":loc1});
            return;
        }

        public function remove(arg1:String, arg2:String):void
        {
            var loc4:*=null;
            var loc5:*=null;
            var loc1:*=arg1.split(",");
            var loc2:*=loc1.length;
            var loc3:*=this._dialoguesOrder.length;
            var loc6:*=0;
            while (loc6 < loc2) 
            {
                loc1[loc6] = arg2 + "_" + loc1[loc6];
                ++loc6;
            }
            arg1 = loc1.toString();
            var loc7:*;
            --loc7;
            while (loc7 >= 0) 
            {
                if (arg1.indexOf(this._dialoguesOrder[loc7]) != -1) 
                {
                    loc4 = this._dialogues[this._dialoguesOrder[loc7]];
                    this._dialoguesOrder.splice(loc7, 1);
                    loc4.removeFromContainer();
                    loc4.dispose();
                    loc4 = null;
                    break;
                }
                --loc7;
            }
            return;
        }

        public function removeAll():void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=this._dialoguesOrder.length;
            var loc4:*;
            --loc4;
            while (loc4 >= 0) 
            {
                loc2 = this._dialogues[this._dialoguesOrder[loc4]];
                this._dialoguesOrder.pop();
                loc2.removeFromContainer();
                loc2.dispose();
                loc2 = null;
                --loc4;
            }
            return;
        }

        public function get top():mgs.aurora.common.interfaces.dialogues.IDialogue
        {
            if (this._dialogues[this._dialoguesOrder[(this.count - 1)]] == null) 
            {
                throw new Error("Cannot find dialogue with storage id - " + this._dialoguesOrder[(this.count - 1)]);
            }
            return this._dialogues[this._dialoguesOrder[(this.count - 1)]] as mgs.aurora.common.interfaces.dialogues.IDialogue;
        }

        public function get count():int
        {
            return this._dialoguesOrder.length;
        }

        public static const NAME:String="DialogueStoreProxy";

        internal var _handlerIds:flash.utils.Dictionary;

        internal var _dialogues:flash.utils.Dictionary;

        internal var _dialoguesOrder:__AS3__.vec.Vector.<String>;
    }
}


//            class FiltersProxy
package mgs.aurora.modules.dialogues.model 
{
    import flash.filters.*;
    import mgs.aurora.common.utilities.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class FiltersProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function FiltersProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public function getDropshadow(arg1:String):flash.filters.DropShadowFilter
        {
            var id:String;
            var filter:flash.filters.DropShadowFilter;
            var config:XML;

            var loc1:*;
            filter = null;
            config = null;
            id = arg1;
            filter = new flash.filters.DropShadowFilter();
            var loc3:*=0;
            var loc4:*=this.filterConfig.shadow;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            config = loc2[0].copy();
            if (config.@inherit.length() == 1) 
            {
                loc3 = 0;
                loc4 = this.filterConfig.shadow;
                loc2 = new XMLList("");
                for each (loc5 in loc4) 
                {
                    with (loc6 = loc5) 
                    {
                        if (@id == config.@inherit) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                config = this.setXmlPropertiesFromXml(config, loc2[0]);
            }
            mgs.aurora.common.utilities.ObjectUtils.updateFromXML(config, filter);
            return filter;
        }

        internal function get filterConfig():XML
        {
            return this.data as XML;
        }

        internal function setXmlPropertiesFromXml(arg1:XML, arg2:XML):XML
        {
            var target:XML;
            var source:XML;
            var item:XML;
            var property:String;
            var value:String;

            var loc1:*;
            item = null;
            property = null;
            value = null;
            target = arg1;
            source = arg2;
            source = source.copy();
            if (source.@inherit.length() == 1) 
            {
                var loc3:*=0;
                var loc4:*=this.filterConfig.shadow;
                var loc2:*=new XMLList("");
                for each (var loc5:* in loc4) 
                {
                    var loc6:*;
                    with (loc6 = loc5) 
                    {
                        if (@id == source.@inherit) 
                        {
                            loc2[loc3] = loc5;
                        }
                    }
                }
                source = this.setXmlPropertiesFromXml(source, loc2[0]);
            }
            loc2 = 0;
            loc3 = target.attributes();
            for each (item in loc3) 
            {
                property = item.name();
                value = item.toString();
                source.@[property] = value;
            }
            return source;
        }

        public static const NAME:String="FiltersProxy";
    }
}


//            class HandlersProxy
package mgs.aurora.modules.dialogues.model 
{
    import flash.display.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.dialogues.*;
    import mgs.aurora.modules.dialogues.model.events.*;
    import mgs.aurora.modules.dialogues.model.handler.*;
    import mgs.aurora.modules.dialogues.model.vo.*;
    import mgs.aurora.modules.dialogues.view.events.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class HandlersProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function HandlersProxy(arg1:Object=null)
        {
            super(NAME, new mgs.aurora.modules.dialogues.model.handler.DialoguesHandlerManager());
            return;
        }

        public override function onRegister():void
        {
            this.manager.addEventListener(mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent.CREATE, this.onCreateDialogueRequest);
            this.manager.addEventListener(mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent.REMOVE, this.onRemoveRequest);
            this.manager.addEventListener(mgs.aurora.modules.dialogues.view.events.DialogueEvent.REMOVE_FROM_CONTAINER, this.onRemoveFromContainer);
            return;
        }

        public function setContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            this.manager.setContainer(arg1);
            return;
        }

        public function getHandler(arg1:String):mgs.aurora.common.interfaces.dialogues.IDialoguesHandler
        {
            return this.manager.getHandler(arg1);
        }

        public function getNewHandler(arg1:String=null):mgs.aurora.common.interfaces.dialogues.IDialoguesHandler
        {
            return this.manager.getNewHandler(arg1);
        }

        public function dialogueCreated(arg1:mgs.aurora.modules.dialogues.model.vo.DialogueResponse):void
        {
            this.manager.dialogueCreated(arg1);
            return;
        }

        public function dialogueDisplayed(arg1:mgs.aurora.common.interfaces.dialogues.IDialogue, arg2:String):void
        {
            this.manager.onDialogueDisplayed(arg1, arg2);
            return;
        }

        public function dialogueRemoved(arg1:mgs.aurora.common.interfaces.dialogues.IDialogue, arg2:String):void
        {
            this.manager.onDialogueRemoved(arg1, arg2);
            return;
        }

        public function removeHandler(arg1:mgs.aurora.common.interfaces.dialogues.IDialoguesHandler):Boolean
        {
            return true;
        }

        internal function get manager():mgs.aurora.modules.dialogues.model.handler.DialoguesHandlerManager
        {
            return this.data as mgs.aurora.modules.dialogues.model.handler.DialoguesHandlerManager;
        }

        internal function onCreateDialogueRequest(arg1:mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent):void
        {
            this.sendNotification(mgs.aurora.modules.dialogues.DialoguesFacade.DIALOGUE_REQUESTED, {"handlerId":arg1.id, "data":arg1.data});
            return;
        }

        internal function onRemoveRequest(arg1:mgs.aurora.modules.dialogues.model.events.DialoguesHandlerRequestEvent):void
        {
            this.sendNotification(mgs.aurora.modules.dialogues.DialoguesFacade.REMOVE_REQUEST, {"handlerId":arg1.id, "data":arg1.data});
            return;
        }

        internal function onRemoveFromContainer(arg1:mgs.aurora.modules.dialogues.view.events.DialogueEvent):void
        {
            this.sendNotification(mgs.aurora.modules.dialogues.DialoguesFacade.REMOVED_FROM_CONTAINER, arg1.dialogue);
            return;
        }

        public static const NAME:String="HandlersProxy";

        internal var _container:flash.display.DisplayObjectContainer;
    }
}


//            class LayoutConfigProxy
package mgs.aurora.modules.dialogues.model 
{
    import mgs.aurora.modules.dialogues.model.config.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class LayoutConfigProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function LayoutConfigProxy(arg1:Object=null)
        {
            super(NAME, new mgs.aurora.modules.dialogues.model.config.LayoutConfigData());
            return;
        }

        public function setConfig(arg1:XML):void
        {
            this.configData.setConfig(arg1);
            return;
        }

        public function setCustomConfig(arg1:XML):void
        {
            this.configData.setCustomConfig(arg1);
            return;
        }

        public function removeCustomConfig():void
        {
            this.configData.removeCustomConfig();
            return;
        }

        public function getDefinition(arg1:String):XMLList
        {
            return this.configData.getDefinition(arg1);
        }

        internal function get configData():mgs.aurora.modules.dialogues.model.config.LayoutConfigData
        {
            return this.data as mgs.aurora.modules.dialogues.model.config.LayoutConfigData;
        }

        public static const NAME:String="LayoutConfigProxy";
    }
}


//            class LayoutMappingConfigProxy
package mgs.aurora.modules.dialogues.model 
{
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class LayoutMappingConfigProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function LayoutMappingConfigProxy(arg1:Object=null)
        {
            super(NAME, arg1);
            return;
        }

        public function getMapping(arg1:String):XML
        {
            var id:String;

            var loc1:*;
            id = arg1;
            var loc3:*=0;
            var loc4:*=this.config.dialogue;
            var loc2:*=new XMLList("");
            for each (var loc5:* in loc4) 
            {
                var loc6:*;
                with (loc6 = loc5) 
                {
                    if (@id == id) 
                    {
                        loc2[loc3] = loc5;
                    }
                }
            }
            return loc2[0];
        }

        internal function get config():XML
        {
            return this.data as XML;
        }

        public static const NAME:String="LayoutMappingConfigProxy";
    }
}


//            class RequestQueueProxy
package mgs.aurora.modules.dialogues.model 
{
    import __AS3__.vec.*;
    import mgs.aurora.modules.dialogues.model.vo.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.proxy.*;
    
    public class RequestQueueProxy extends org.puremvc.as3.multicore.patterns.proxy.Proxy implements org.puremvc.as3.multicore.interfaces.IProxy
    {
        public function RequestQueueProxy(arg1:Object=null)
        {
            super(NAME, new Vector.<mgs.aurora.modules.dialogues.model.vo.DialogueRequest>());
            return;
        }

        public function add(arg1:mgs.aurora.modules.dialogues.model.vo.DialogueRequest):void
        {
            this.requests.push(arg1);
            return;
        }

        public function getNext():mgs.aurora.modules.dialogues.model.vo.DialogueRequest
        {
            var loc1:*=this.requests.shift();
            return loc1;
        }

        public function hasNext():Boolean
        {
            return this.requests.length > 0;
        }

        protected function get requests():__AS3__.vec.Vector.<mgs.aurora.modules.dialogues.model.vo.DialogueRequest>
        {
            return this.data as Vector.<mgs.aurora.modules.dialogues.model.vo.DialogueRequest>;
        }

        public static const NAME:String="RequestQueueProxy";
    }
}


//          package view
//            package components
//              class Dialogue
package mgs.aurora.modules.dialogues.view.components 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.enums.controls.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.controls.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.dialogues.model.controls.*;
    import mgs.aurora.modules.dialogues.model.interfaces.*;
    import mgs.aurora.modules.dialogues.model.layout.*;
    import mgs.aurora.modules.dialogues.view.events.*;
    
    public class Dialogue extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.controls.IControl, mgs.aurora.common.interfaces.dialogues.IDialogue
    {
        public function Dialogue(arg1:String, arg2:String)
        {
            super();
            this._id = arg1;
            this._type = arg2;
            this._display = new flash.display.Sprite();
            this._backgroundHolder = new flash.display.Sprite();
            this._display.addChild(this._backgroundHolder);
            this._controlsHolder = new flash.display.Sprite();
            this._display.addChild(this._controlsHolder);
            this._modalHolder = new flash.display.Sprite();
            this._display.addChild(this._modalHolder);
            this._controlList = new mgs.aurora.modules.dialogues.model.controls.ControlList(this._id);
            this._backgroundList = new mgs.aurora.modules.dialogues.model.controls.ControlList(this._id);
            this._buttons = new mgs.aurora.modules.dialogues.model.controls.ButtonList(this._id);
            this._texts = new mgs.aurora.modules.dialogues.model.controls.TextList(this._id);
            this._checkboxes = new mgs.aurora.modules.dialogues.model.controls.CheckBoxList(this._id);
            this._radioButtons = new mgs.aurora.modules.dialogues.model.controls.RadioButtonList(this._id);
            this._comboBoxes = new mgs.aurora.modules.dialogues.model.controls.ComboBoxList(this._id);
            this._depthManager = new mgs.aurora.modules.dialogues.model.layout.DepthManager(this._controlsHolder);
            this._display.addEventListener(flash.events.Event.ADDED_TO_STAGE, this.onAddedToStage);
            return;
        }

        public function addControl(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            this._controlList.add(arg1);
            arg1.addToContainer(this._controlsHolder);
            this._depthManager.addControl(arg1);
            var loc1:*=arg1.type;
            switch (loc1) 
            {
                case mgs.aurora.common.enums.controls.ControlType.BUTTON:
                {
                    this._buttons.add(arg1);
                    break;
                }
                case mgs.aurora.common.enums.controls.ControlType.CHECKBOX:
                {
                    this._checkboxes.add(arg1);
                    break;
                }
                case mgs.aurora.common.enums.controls.ControlType.RADIOBUTTON:
                {
                    this._radioButtons.add(arg1);
                    break;
                }
                case mgs.aurora.common.enums.controls.ControlType.TEXT:
                case mgs.aurora.common.enums.controls.ControlType.INPUTTEXT:
                {
                    this._texts.add(arg1);
                    break;
                }
                case mgs.aurora.common.enums.controls.ControlType.COMBOBOX:
                {
                    this._comboBoxes.add(arg1);
                    break;
                }
            }
            return;
        }

        public function addBackground(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            this._backgroundList.add(arg1);
            arg1.addToContainer(this._backgroundHolder);
            return;
        }

        public function doStartDrag(arg1:mgs.aurora.common.events.dialogues.DialogueMouseEvent):void
        {
            this._dragged = true;
            this._display.startDrag(false);
            return;
        }

        public function doStopDrag(arg1:mgs.aurora.common.events.dialogues.DialogueMouseEvent):void
        {
            this._display.stopDrag();
            return;
        }

        public function get graphics():mgs.aurora.common.interfaces.controls.IGraphicsList
        {
            return null;
        }

        public function get comboBoxes():mgs.aurora.common.interfaces.controls.IComboBoxList
        {
            return this._comboBoxes;
        }

        public function get filters():Array
        {
            return this._display.filters;
        }

        public function removeFromContainer():void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.DialogueEvent(mgs.aurora.modules.dialogues.view.events.DialogueEvent.REMOVE_FROM_CONTAINER, this));
            this._display.parent.removeChild(this._display);
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.DialogueEvent(mgs.aurora.modules.dialogues.view.events.DialogueEvent.REMOVED_FROM_STAGE, this));
            return;
        }

        public function set filters(arg1:Array):void
        {
            this._display.filters = arg1;
            return;
        }

        public function get x():Number
        {
            return this._display.x;
        }

        public function set x(arg1:Number):void
        {
            this._display.x = arg1;
            return;
        }

        public function get y():Number
        {
            return this._display.y;
        }

        public function set y(arg1:Number):void
        {
            this._display.y = arg1;
            return;
        }

        public function get visible():Boolean
        {
            return this._display.visible;
        }

        public function get alpha():Number
        {
            return this._display.alpha;
        }

        public function set alpha(arg1:Number):void
        {
            this._display.alpha = arg1;
            return;
        }

        public function get interactiveObject():flash.display.InteractiveObject
        {
            return this._display;
        }

        public function get title():mgs.aurora.common.interfaces.controls.IText
        {
            return this._title.textField;
        }

        public function get buttons():mgs.aurora.common.interfaces.controls.IButtonList
        {
            return this._buttons;
        }

        public function get texts():mgs.aurora.common.interfaces.controls.ITextList
        {
            return this._texts;
        }

        public function get checkBoxes():mgs.aurora.common.interfaces.controls.ICheckBoxList
        {
            return this._checkboxes;
        }

        public function get radioButtons():mgs.aurora.common.interfaces.controls.IRadioButtonList
        {
            return this._radioButtons;
        }

        public function setStageResolution(arg1:Number, arg2:Number):void
        {
            this._horizontalRes = arg1;
            this._verticalRes = arg2;
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

        public function get enabled():Boolean
        {
            return this._enabled;
        }

        public function set enabled(arg1:Boolean):void
        {
            this._controlsHolder.tabChildren = arg1;
            if (arg1 != this._enabled) 
            {
                this._enabled = arg1;
                if (this._modal) 
                {
                    this._modal.visible = !arg1;
                    if (arg1) 
                    {
                        this._modal.removeFromContainer();
                    }
                    else 
                    {
                        this._modal.addToContainer(this._modalHolder);
                    }
                }
                this._controlList.modal = !arg1;
            }
            if (this._display.stage && arg1) 
            {
                this._display.stage.focus = this._display;
            }
            return;
        }

        public function get hitTest():Boolean
        {
            return false;
        }

        public function addToContainer(arg1:flash.display.DisplayObjectContainer):void
        {
            arg1.addChild(this._display);
            return;
        }

        public function addToContainerAt(arg1:flash.display.DisplayObjectContainer, arg2:int):void
        {
            arg1.addChildAt(this._display, arg2);
            return;
        }

        public function set visible(arg1:Boolean):void
        {
            return;
        }

        public function dispose():void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.DialogueEvent(mgs.aurora.modules.dialogues.view.events.DialogueEvent.DISPOSING, this));
            this._depthManager.dispose();
            this._controlList.removeAll();
            this._controlList = null;
            this._backgroundList.removeAll();
            this._backgroundList = null;
            this._table.dispose();
            return;
        }

        public function get width():Number
        {
            return this._display.width;
        }

        public function set width(arg1:Number):void
        {
            return;
        }

        public function get height():Number
        {
            return this._display.height;
        }

        public function set height(arg1:Number):void
        {
            return;
        }

        public function setTable(arg1:mgs.aurora.modules.dialogues.model.interfaces.ITable):void
        {
            this._table = arg1;
            this._table.x = 0;
            this._table.y = 0;
            this._table.init();
            this._table.addToContainer(this._controlsHolder);
            this._table.addEventListener(flash.events.Event.CHANGE, this.onTableChange);
            this._title = this._controlList.getControl("title") as mgs.aurora.common.interfaces.controls.IButton;
            this._title.enabled = true;
            this._title.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_DOWN, this.doStartDrag);
            this._title.addEventListener(mgs.aurora.common.events.dialogues.DialogueMouseEvent.MOUSE_UP, this.doStopDrag);
            return;
        }

        public function setModal(arg1:mgs.aurora.common.interfaces.controls.IControl):void
        {
            if (arg1) 
            {
                this._modal = arg1;
            }
            return;
        }

        public function onTableChange(arg1:flash.events.Event=null):void
        {
            var loc1:*;
            var loc2:*=((loc1 = this).counter + 1);
            loc1.counter = loc2;
            if (!this._dragged && this._display.stage) 
            {
                this._display.x = Math.floor((this._horizontalRes - this._table.width) / 2);
                this._display.y = Math.floor((this._verticalRes - this._table.height) / 2);
            }
            if (this._modal) 
            {
                this._modal.width = this._table.width;
                this._modal.height = this._table.height;
            }
            return;
        }

        internal function onAddedToStage(arg1:flash.events.Event):void
        {
            this._display.stage.stageFocusRect = false;
            this._display.stage.focus = this._display;
            this._display.x = Math.floor((this._horizontalRes - this._table.width) / 2);
            this._display.y = Math.floor((this._verticalRes - this._table.height) / 2);
            this.onTableChange();
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.DialogueEvent(mgs.aurora.modules.dialogues.view.events.DialogueEvent.ADDED_TO_STAGE, this));
            return;
        }

        public function get controls():mgs.aurora.common.interfaces.controls.IControlList
        {
            return this._controlList;
        }

        internal var _id:String;

        internal var _display:flash.display.Sprite;

        internal var _type:String;

        internal var _table:mgs.aurora.modules.dialogues.model.interfaces.ITable;

        internal var _modal:mgs.aurora.common.interfaces.controls.IControl;

        internal var _controlsHolder:flash.display.Sprite;

        internal var _backgroundHolder:flash.display.Sprite;

        internal var _controlList:mgs.aurora.modules.dialogues.model.controls.ControlList;

        internal var _backgroundList:mgs.aurora.modules.dialogues.model.controls.ControlList;

        internal var _buttons:mgs.aurora.modules.dialogues.model.controls.ButtonList;

        internal var _texts:mgs.aurora.modules.dialogues.model.controls.TextList;

        internal var _checkboxes:mgs.aurora.modules.dialogues.model.controls.CheckBoxList;

        internal var _radioButtons:mgs.aurora.modules.dialogues.model.controls.RadioButtonList;

        internal var _comboBoxes:mgs.aurora.modules.dialogues.model.controls.ComboBoxList;

        internal var _title:mgs.aurora.common.interfaces.controls.IButton;

        internal var _horizontalRes:Number=1024;

        internal var _verticalRes:Number=768;

        internal var _dragged:Boolean=false;

        internal var _enabled:Boolean=true;

        internal var _depthManager:mgs.aurora.modules.dialogues.model.layout.DepthManager;

        public var counter:int=0;

        internal var _modalHolder:flash.display.Sprite;
    }
}


//            package events
//              class DialogueEvent
package mgs.aurora.modules.dialogues.view.events 
{
    import flash.events.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    
    public class DialogueEvent extends flash.events.Event
    {
        public function DialogueEvent(arg1:String, arg2:mgs.aurora.common.interfaces.dialogues.IDialogue, arg3:Boolean=false, arg4:Boolean=false)
        {
            super(arg1, arg3, arg4);
            this.dialogue = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.modules.dialogues.view.events.DialogueEvent(type, this.dialogue, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("DialogueEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="dialogue/event";

        public static const DISPOSING:String=NAME + "/disposing";

        public static const ADDED_TO_STAGE:String=NAME + "/added_to_stage";

        public static const REMOVED_FROM_STAGE:String=NAME + "/removed_from_stage";

        public static const REMOVE_FROM_CONTAINER:String=NAME + "/remove_from_container";

        public var dialogue:mgs.aurora.common.interfaces.dialogues.IDialogue;
    }
}


//              class DialogueHandlerManagerEvent
package mgs.aurora.modules.dialogues.view.events 
{
    import flash.events.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    
    public class DialogueHandlerManagerEvent extends flash.events.Event
    {
        public function DialogueHandlerManagerEvent(arg1:String, arg2:mgs.aurora.common.interfaces.dialogues.IDialogue, arg3:String, arg4:Boolean=false, arg5:Boolean=false)
        {
            super(arg1, arg4, arg5);
            this.dialogue = arg2;
            this.handlerId = arg3;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.modules.dialogues.view.events.DialogueHandlerManagerEvent(type, this.dialogue, this.handlerId, bubbles, cancelable);
        }

        public override function toString():String
        {
            return formatToString("DialogueHandlerManagerEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="dialogue_handler_manager/event";

        public static const ADDED_TO_STAGE:String=NAME + "/added_to_stage";

        public static const REMOVED_FROM_STAGE:String=NAME + "/removed_from_stage";

        public var dialogue:mgs.aurora.common.interfaces.dialogues.IDialogue;

        public var handlerId:String;
    }
}


//              class SetupEvent
package mgs.aurora.modules.dialogues.view.events 
{
    import flash.events.*;
    
    public class SetupEvent extends flash.events.Event
    {
        public function SetupEvent(arg1:String, arg2:Object=null)
        {
            super(arg1);
            this.data = arg2;
            return;
        }

        public override function clone():flash.events.Event
        {
            return new mgs.aurora.modules.dialogues.view.events.SetupEvent(type, this.data);
        }

        public override function toString():String
        {
            return formatToString("DialogueEvent", "type", "bubbles", "cancelable", "eventPhase");
        }

        internal static const NAME:String="dialogues/setup_event";

        public static const LAYOUT:String=NAME + "/layout";

        public static const LAYOUT_MAPPING:String=NAME + "/layout_mapping";

        public static const CUSTOM_LAYOUT:String=NAME + "/custom_layout";

        public static const REMOVE_CUSTOM_LAYOUT:String=NAME + "/remove_custom_layout";

        public static const CONTROLS:String=NAME + "/controls";

        public static const FONTS:String=NAME + "/fonts";

        public static const ART:String=NAME + "/art";

        public static const ART_LANG:String=NAME + "/art_lang";

        public static const SET_STAGE_RESOLUTION:String=NAME + "/set_stage_resolution";

        public var data:Object;
    }
}


//            class DialoguesMediator
package mgs.aurora.modules.dialogues.view 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.utilities.*;
    import mgs.aurora.modules.dialogues.*;
    import mgs.aurora.modules.dialogues.model.*;
    import mgs.aurora.modules.dialogues.model.vo.*;
    import mgs.aurora.modules.dialogues.view.events.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.mediator.*;
    
    public class DialoguesMediator extends org.puremvc.as3.multicore.patterns.mediator.Mediator implements org.puremvc.as3.multicore.interfaces.IMediator
    {
        public function DialoguesMediator(arg1:Object)
        {
            super(NAME, arg1);
            return;
        }

        public override function onRegister():void
        {
            this.view.addEventListener(mgs.aurora.modules.dialogues.view.events.SetupEvent.LAYOUT, this.onSetLayoutConfig);
            this.view.addEventListener(mgs.aurora.modules.dialogues.view.events.SetupEvent.LAYOUT_MAPPING, this.onSetLayoutMappingConfig);
            this.view.addEventListener(mgs.aurora.modules.dialogues.view.events.SetupEvent.CUSTOM_LAYOUT, this.onSetCustomLayoutConfig);
            this.view.addEventListener(mgs.aurora.modules.dialogues.view.events.SetupEvent.REMOVE_CUSTOM_LAYOUT, this.onRemoveCustomLayoutConfig);
            this.view.addEventListener(mgs.aurora.modules.dialogues.view.events.SetupEvent.CONTROLS, this.onSetControlsConfig);
            this.view.addEventListener(mgs.aurora.modules.dialogues.view.events.SetupEvent.FONTS, this.onSetFonts);
            this.view.addEventListener(mgs.aurora.modules.dialogues.view.events.SetupEvent.ART, this.onSetArt);
            this.view.addEventListener(mgs.aurora.modules.dialogues.view.events.SetupEvent.ART_LANG, this.onSetArtLanguage);
            this.view.addEventListener(mgs.aurora.modules.dialogues.view.events.SetupEvent.SET_STAGE_RESOLUTION, this.onStageResolutionChange);
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.HandlersProxy.NAME) as mgs.aurora.modules.dialogues.model.HandlersProxy;
            loc1.setContainer(this.view);
            return;
        }

        protected function onSetLayoutConfig(arg1:mgs.aurora.modules.dialogues.view.events.SetupEvent):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.LayoutConfigProxy.NAME) as mgs.aurora.modules.dialogues.model.LayoutConfigProxy;
            loc1.setConfig(arg1.data as XML);
            return;
        }

        protected function onSetLayoutMappingConfig(arg1:mgs.aurora.modules.dialogues.view.events.SetupEvent):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.LayoutMappingConfigProxy.NAME) as mgs.aurora.modules.dialogues.model.LayoutMappingConfigProxy;
            loc1.setData(arg1.data);
            return;
        }

        protected function onSetCustomLayoutConfig(arg1:mgs.aurora.modules.dialogues.view.events.SetupEvent):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.LayoutConfigProxy.NAME) as mgs.aurora.modules.dialogues.model.LayoutConfigProxy;
            loc1.setCustomConfig(arg1.data as XML);
            return;
        }

        protected function onSetControlsConfig(arg1:mgs.aurora.modules.dialogues.view.events.SetupEvent):void
        {
            var loc1:*=arg1.data as XML;
            var loc2:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.ControlsBuilderProxy.NAME) as mgs.aurora.modules.dialogues.model.ControlsBuilderProxy;
            loc2.setConfig(loc1);
            var loc3:*;
            (loc3 = this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.FiltersProxy.NAME) as mgs.aurora.modules.dialogues.model.FiltersProxy).setData(loc1.dropShadow[0]);
            return;
        }

        protected function onSetFonts(arg1:mgs.aurora.modules.dialogues.view.events.SetupEvent):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.ControlsBuilderProxy.NAME) as mgs.aurora.modules.dialogues.model.ControlsBuilderProxy;
            loc1.setFonts(arg1.data as flash.display.LoaderInfo);
            return;
        }

        protected function onSetArt(arg1:mgs.aurora.modules.dialogues.view.events.SetupEvent):void
        {
            if (arg1.data == null) 
            {
                throw new Error("Art loderInfo cannot be null");
            }
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.ControlsBuilderProxy.NAME) as mgs.aurora.modules.dialogues.model.ControlsBuilderProxy;
            loc1.setArt(arg1.data as flash.display.LoaderInfo);
            return;
        }

        protected function onSetArtLanguage(arg1:mgs.aurora.modules.dialogues.view.events.SetupEvent):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.ControlsBuilderProxy.NAME) as mgs.aurora.modules.dialogues.model.ControlsBuilderProxy;
            loc1.setArtLanguage(arg1.data as flash.display.LoaderInfo);
            return;
        }

        protected function onRemoveCustomLayoutConfig(arg1:mgs.aurora.modules.dialogues.view.events.SetupEvent):void
        {
            var loc1:*=this.facade.retrieveProxy(mgs.aurora.modules.dialogues.model.LayoutConfigProxy.NAME) as mgs.aurora.modules.dialogues.model.LayoutConfigProxy;
            loc1.removeCustomConfig();
            return;
        }

        protected function onStageResolutionChange(arg1:mgs.aurora.modules.dialogues.view.events.SetupEvent):void
        {
            this._horizontalRes = arg1.data.horizontal;
            this._verticalRes = arg1.data.vertical;
            return;
        }

        public function dialogueCreated(arg1:mgs.aurora.modules.dialogues.model.vo.DialogueResponse):void
        {
            this.view.onDialogueCreated(arg1);
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.dialogues.model.DialogueStoreProxy.NAME) as mgs.aurora.modules.dialogues.model.DialogueStoreProxy;
            if (loc1.count == 1) 
            {
                mgs.aurora.common.utilities.EventUtils.addKeyEventsToSingleMethod(this.view.stage, this.onStageKeyboardEvent, false, 1000);
            }
            return;
        }

        internal function onStageKeyboardEvent(arg1:flash.events.KeyboardEvent):void
        {
            arg1.stopImmediatePropagation();
            return;
        }

        public function dialogueDisplayed(arg1:Object):void
        {
            this.view.onDialogueDisplayed(arg1);
            return;
        }

        public function dialogueRemoved(arg1:Object):void
        {
            this.view.onDialogueRemoved(arg1);
            var loc1:*=facade.retrieveProxy(mgs.aurora.modules.dialogues.model.DialogueStoreProxy.NAME) as mgs.aurora.modules.dialogues.model.DialogueStoreProxy;
            if (loc1.count == 0) 
            {
                mgs.aurora.common.utilities.EventUtils.removeKeyEventsFromSingleMethod(this.view.stage, this.onStageKeyboardEvent);
            }
            return;
        }

        public function get horizontalRes():Number
        {
            return this._horizontalRes;
        }

        public function get verticalRes():Number
        {
            return this._verticalRes;
        }

        internal function get view():mgs.aurora.modules.dialogues.Dialogues
        {
            return this.viewComponent as mgs.aurora.modules.dialogues.Dialogues;
        }

        public static const NAME:String="DialoguesMediator";

        internal var _horizontalRes:Number=1024;

        internal var _verticalRes:Number=768;
    }
}


//          class Dialogues
package mgs.aurora.modules.dialogues 
{
    import flash.display.*;
    import flash.events.*;
    import mgs.aurora.common.events.dialogues.*;
    import mgs.aurora.common.interfaces.dialogues.*;
    import mgs.aurora.modules.dialogues.model.*;
    import mgs.aurora.modules.dialogues.model.vo.*;
    import mgs.aurora.modules.dialogues.view.events.*;
    
    public class Dialogues extends flash.display.Sprite implements mgs.aurora.common.interfaces.dialogues.IDialoguesModule
    {
        public function Dialogues()
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
            this.stage.stageFocusRect = false;
            this._facade = mgs.aurora.modules.dialogues.DialoguesFacade.getInstance(Dialogues.NAME);
            this._facade.startup(this);
            return;
        }

        internal function dispose(arg1:flash.events.Event=null):void
        {
            return;
        }

        public function setLayoutConfig(arg1:XML):void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.SetupEvent(mgs.aurora.modules.dialogues.view.events.SetupEvent.LAYOUT, arg1));
            return;
        }

        public function setLayoutMappingConfig(arg1:XML):void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.SetupEvent(mgs.aurora.modules.dialogues.view.events.SetupEvent.LAYOUT_MAPPING, arg1));
            return;
        }

        public function setCustomLayoutConfig(arg1:XML):void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.SetupEvent(mgs.aurora.modules.dialogues.view.events.SetupEvent.CUSTOM_LAYOUT, arg1));
            return;
        }

        public function removeCustomLayout():void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.SetupEvent(mgs.aurora.modules.dialogues.view.events.SetupEvent.REMOVE_CUSTOM_LAYOUT));
            return;
        }

        public function setControlsConfig(arg1:XML):void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.SetupEvent(mgs.aurora.modules.dialogues.view.events.SetupEvent.CONTROLS, arg1));
            return;
        }

        public function setFonts(arg1:flash.display.LoaderInfo):void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.SetupEvent(mgs.aurora.modules.dialogues.view.events.SetupEvent.FONTS, arg1));
            return;
        }

        public function setArt(arg1:flash.display.LoaderInfo):void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.SetupEvent(mgs.aurora.modules.dialogues.view.events.SetupEvent.ART, arg1));
            return;
        }

        public function setArtLanguage(arg1:flash.display.LoaderInfo):void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.SetupEvent(mgs.aurora.modules.dialogues.view.events.SetupEvent.ART_LANG, arg1));
            return;
        }

        public function setStageResolution(arg1:Number, arg2:Number):void
        {
            this.dispatchEvent(new mgs.aurora.modules.dialogues.view.events.SetupEvent(mgs.aurora.modules.dialogues.view.events.SetupEvent.SET_STAGE_RESOLUTION, {"horizontal":arg1, "vertical":arg2}));
            return;
        }

        public function getNewHandler(arg1:String=null):mgs.aurora.common.interfaces.dialogues.IDialoguesHandler
        {
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.dialogues.model.HandlersProxy.NAME) as mgs.aurora.modules.dialogues.model.HandlersProxy;
            return loc1.getNewHandler(arg1);
        }

        public function onDialogueCreated(arg1:mgs.aurora.modules.dialogues.model.vo.DialogueResponse):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesModuleEvent(mgs.aurora.common.events.dialogues.DialoguesModuleEvent.DIALOGUE_CREATED, arg1.dialogue.id, arg1.dialogue.type, arg1.request.handlerId));
            return;
        }

        public function onDialogueDisplayed(arg1:Object):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesModuleEvent(mgs.aurora.common.events.dialogues.DialoguesModuleEvent.DIALOGUE_DISPLAYED, arg1.diagId, arg1.diagType, arg1.handlerId));
            return;
        }

        public function onDialogueRemoved(arg1:Object):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.dialogues.DialoguesModuleEvent(mgs.aurora.common.events.dialogues.DialoguesModuleEvent.DIALOGUE_REMOVED, arg1.diagId, arg1.diagType, arg1.handlerId));
            return;
        }

        public function getHandler(arg1:String):mgs.aurora.common.interfaces.dialogues.IDialoguesHandler
        {
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.dialogues.model.HandlersProxy.NAME) as mgs.aurora.modules.dialogues.model.HandlersProxy;
            return loc1.getHandler(arg1);
        }

        public function removeAllDialogues():void
        {
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.dialogues.model.DialogueStoreProxy.NAME) as mgs.aurora.modules.dialogues.model.DialogueStoreProxy;
            return loc1.removeAll();
        }

        public function get displayCount():uint
        {
            var loc1:*=this._facade.retrieveProxy(mgs.aurora.modules.dialogues.model.DialogueStoreProxy.NAME) as mgs.aurora.modules.dialogues.model.DialogueStoreProxy;
            return loc1.count;
        }

        public static const NAME:String="Dialogues";

        internal var _facade:mgs.aurora.modules.dialogues.DialoguesFacade;
    }
}


//          class DialoguesFacade
package mgs.aurora.modules.dialogues 
{
    import flash.display.*;
    import mgs.aurora.modules.dialogues.controller.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class DialoguesFacade extends org.puremvc.as3.multicore.patterns.facade.Facade implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function DialoguesFacade(arg1:String)
        {
            super(arg1);
            return;
        }

        public function startup(arg1:flash.display.Sprite):void
        {
            this.sendNotification(mgs.aurora.modules.dialogues.DialoguesFacade.STARTUP, arg1);
            this.removeCommand(mgs.aurora.modules.dialogues.DialoguesFacade.STARTUP);
            return;
        }

        protected override function initializeController():void
        {
            super.initializeController();
            this.registerCommand(mgs.aurora.modules.dialogues.DialoguesFacade.STARTUP, mgs.aurora.modules.dialogues.controller.StartupCommand);
            this.registerCommand(mgs.aurora.modules.dialogues.DialoguesFacade.DIALOGUE_REQUESTED, mgs.aurora.modules.dialogues.controller.DialogueRequestedCommand);
            this.registerCommand(mgs.aurora.modules.dialogues.DialoguesFacade.BUILD_DIALOGUE, mgs.aurora.modules.dialogues.controller.BuildDialogueCommand);
            this.registerCommand(mgs.aurora.modules.dialogues.DialoguesFacade.CREATE_CONTROLS, mgs.aurora.modules.dialogues.controller.CreateControlsCommand);
            this.registerCommand(mgs.aurora.modules.dialogues.DialoguesFacade.CONTROLS_CREATED, mgs.aurora.modules.dialogues.controller.ControlsCreatedCommand);
            this.registerCommand(mgs.aurora.modules.dialogues.DialoguesFacade.DIALOGUE_CREATED, mgs.aurora.modules.dialogues.controller.DialogueCreatedCommand);
            this.registerCommand(mgs.aurora.modules.dialogues.DialoguesFacade.REMOVED_FROM_CONTAINER, mgs.aurora.modules.dialogues.controller.RemovedFromContainerCommand);
            this.registerCommand(mgs.aurora.modules.dialogues.DialoguesFacade.DIALOGUE_DISPLAYED, mgs.aurora.modules.dialogues.controller.DialogueDisplayedCommand);
            this.registerCommand(mgs.aurora.modules.dialogues.DialoguesFacade.DIALOGUE_REMOVED, mgs.aurora.modules.dialogues.controller.DialogueRemovedCommand);
            this.registerCommand(mgs.aurora.modules.dialogues.DialoguesFacade.REMOVE_REQUEST, mgs.aurora.modules.dialogues.controller.RemoveDialogueCommand);
            return;
        }

        public static function getInstance(arg1:String):mgs.aurora.modules.dialogues.DialoguesFacade
        {
            if (mgs.aurora.modules.dialogues.DialoguesFacade._instance == null) 
            {
                mgs.aurora.modules.dialogues.DialoguesFacade._instance = new DialoguesFacade(arg1);
            }
            return mgs.aurora.modules.dialogues.DialoguesFacade._instance;
        }

        internal static const NAME:String="dialogues_facade";

        public static const STARTUP:String=NAME + "/notes/startup";

        public static const CREATE_CONTROLS:String=NAME + "/notes/create_controls";

        public static const CONTROLS_CREATED:String=NAME + "/notes/controls_created";

        public static const DIALOGUE_REQUESTED:String=NAME + "/notes/dialogue_requested";

        public static const DIALOGUE_DISPLAYED:String=NAME + "/notes/dialogue_displayed";

        public static const DIALOGUE_REMOVED:String=NAME + "/notes/dialogue_removed";

        public static const DIALOGUE_CREATED:String=NAME + "/notes/dialogue_created";

        public static const CREATE_NEXT_DIALOGUE:String=NAME + "/notes/create_next_dialogue";

        public static const BUILD_DIALOGUE:String=NAME + "/notes/build_dialogue";

        public static const SET_STAGE_RESOLUTION:String=NAME + "/notes/set_stage_resolution";

        public static const REMOVED_FROM_CONTAINER:String=NAME + "/notes/removed_from_container";

        public static const REMOVE_REQUEST:String=NAME + "/notes/remove_request";

        public static const REMOVE_ALL_REQUEST:String=NAME + "/notes/remove_all_request";

        internal static var _instance:mgs.aurora.modules.dialogues.DialoguesFacade;
    }
}


