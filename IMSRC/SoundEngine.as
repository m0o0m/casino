//ActionScript 3.0
//  package mgs
//    package aurora
//      package soundengine
//        package controller
//          package timers
//            class PanTimer
package mgs.aurora.soundengine.controller.timers 
{
    import flash.utils.*;
    
    public class PanTimer extends flash.utils.Timer
    {
        public function PanTimer(arg1:Number=undefined, arg2:int=0)
        {
            super(arg1, arg2);
            return;
        }

        public var soundName:String;

        public var soundGroup:String;

        public var panStart:Number;

        public var panEnd:Number;

        public var time:Number;

        public var panOverTimeHandler:Function;

        public var panChange:Number;

        public var timeCounter:Number;
    }
}


//            class VolumeTimer
package mgs.aurora.soundengine.controller.timers 
{
    import flash.utils.*;
    
    public class VolumeTimer extends flash.utils.Timer
    {
        public function VolumeTimer(arg1:Number=undefined, arg2:int=0)
        {
            super(arg1, arg2);
            return;
        }

        public var soundName:String;

        public var soundGroup:String;

        public var volumeStart:Number;

        public var volumeEnd:Number;

        public var time:Number;

        public var volumeOverTimeHandler:Function;

        public var volumeDrop:Number;

        public var timeCounter:Number;
    }
}


//        package model
//          class SoundChannelEx
package mgs.aurora.soundengine.model 
{
    import flash.events.*;
    import flash.media.*;
    import mgs.aurora.common.events.*;
    
    public class SoundChannelEx extends flash.events.EventDispatcher
    {
        public function SoundChannelEx(arg1:String, arg2:String)
        {
            super();
            this._group = arg2;
            this._soundName = arg1;
            this._soundChannel = new flash.media.SoundChannel();
            return;
        }

        public function get group():String
        {
            return this._group;
        }

        public function get soundName():String
        {
            return this._soundName;
        }

        public function get soundTransform():flash.media.SoundTransform
        {
            return this._soundChannel.soundTransform;
        }

        public function set soundTransform(arg1:flash.media.SoundTransform):void
        {
            if (arg1 == null) 
            {
                arg1 = new flash.media.SoundTransform();
            }
            this._lastSoundTransform = this._soundChannel.soundTransform;
            this._soundChannel.soundTransform = arg1;
            return;
        }

        public function get soundChannel():flash.media.SoundChannel
        {
            return this._soundChannel;
        }

        public function set soundChannel(arg1:flash.media.SoundChannel):void
        {
            this._lastSoundChannel = this._soundChannel;
            this._soundChannel = arg1;
            if (!(this._soundChannel == null) && !this._soundChannel.hasEventListener(flash.events.Event.SOUND_COMPLETE)) 
            {
                this._soundChannel.addEventListener(flash.events.Event.SOUND_COMPLETE, this.onSoundChannelEvent);
            }
            else 
            {
                this._soundChannel = new flash.media.SoundChannel();
                this.onSoundChannelEvent();
            }
            return;
        }

        public function get lastSoundTransform():flash.media.SoundTransform
        {
            return this._lastSoundTransform;
        }

        public function get lastSoundChannel():flash.media.SoundChannel
        {
            return this._lastSoundChannel;
        }

        public function stop():void
        {
            this.soundChannel.stop();
            this.dispatchEvent(new mgs.aurora.common.events.SystemSoundEvent(mgs.aurora.common.events.SystemSoundEvent.STOPPED, this.soundName, this.group, this.soundChannel));
            return;
        }

        internal function onSoundChannelEvent(arg1:flash.events.Event=null):void
        {
            this.dispatchEvent(new mgs.aurora.common.events.SystemSoundEvent(mgs.aurora.common.events.SystemSoundEvent.COMPLETE, this.soundName, this.group, this.soundChannel));
            return;
        }

        internal var _group:String;

        internal var _soundName:String;

        internal var _soundChannel:flash.media.SoundChannel;

        internal var _lastSoundTransform:flash.media.SoundTransform;

        internal var _lastSoundChannel:flash.media.SoundChannel;
    }
}


//          class SoundEngine
package mgs.aurora.soundengine.model 
{
    import flash.display.*;
    import flash.events.*;
    import flash.media.*;
    import flash.utils.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.sounds.*;
    import mgs.aurora.soundengine.controller.timers.*;
    
    public class SoundEngine extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.sounds.ISounds
    {
        public function SoundEngine()
        {
            super();
            this._eventDispatcher = new flash.events.EventDispatcher(this);
            this._soundDictionary = new flash.utils.Dictionary();
            this._globalVolume = flash.media.SoundMixer.soundTransform.volume;
            this._globalPan = flash.media.SoundMixer.soundTransform.pan;
            this._globalLeftToLeft = flash.media.SoundMixer.soundTransform.leftToLeft;
            this._globalLeftToRight = flash.media.SoundMixer.soundTransform.leftToRight;
            this._globalRightToLeft = flash.media.SoundMixer.soundTransform.rightToLeft;
            this._globalRightToRight = flash.media.SoundMixer.soundTransform.rightToRight;
            this.mute = false;
            return;
        }

        public function setChannelPanOverTime(arg1:Array, arg2:String, arg3:Number, arg4:Number, arg5:Number):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=NaN;
            var loc5:*=NaN;
            var loc1:*=0;
            while (loc1 < arg1.length) 
            {
                if (this._soundDictionary[arg2] != null) 
                {
                    if (this._soundDictionary[arg2][arg1[loc1].toLowerCase()] != null) 
                    {
                        loc3 = (loc2 = arg1[loc1].toLowerCase()) + "_panOver";
                        this._soundDictionary[arg2][loc3] = new Object();
                        this._soundDictionary[arg2][loc3].pTimer = new mgs.aurora.soundengine.controller.timers.PanTimer(this.SOUND_OVER_TIME_DELAY);
                        this._soundDictionary[arg2][loc3].pTimer.soundName = loc2;
                        this._soundDictionary[arg2][loc3].pTimer.soundGroup = arg2;
                        this._soundDictionary[arg2][loc3].pTimer.panStart = arg3;
                        this._soundDictionary[arg2][loc3].pTimer.panEnd = arg4;
                        this._soundDictionary[arg2][loc3].pTimer.time = arg5;
                        this._soundDictionary[arg2][loc3].pTimer.timeCounter = 0;
                        loc4 = arg3 - arg4;
                        loc5 = arg5 / this.SOUND_OVER_TIME_DELAY;
                        this._soundDictionary[arg2][loc3].pTimer.panChange = loc4 / loc5;
                        this._soundDictionary[arg2][loc3].pTimer.addEventListener(flash.events.TimerEvent.TIMER, this.onPanOverTimer);
                        this._soundDictionary[arg2][loc3].pTimer.start();
                    }
                }
                ++loc1;
            }
            return;
        }

        public function stopVolumeOverTime(arg1:String, arg2:String):void
        {
            var loc1:*=arg1.toLowerCase() + "_volumeOver";
            if (this._soundDictionary[arg2][loc1] == null) 
            {
                return;
            }
            if (this._soundDictionary[arg2][loc1].vTimer != null) 
            {
                if (this._soundDictionary[arg2][loc1].vTimer.running) 
                {
                    this._soundDictionary[arg2][loc1].vTimer.stop();
                }
            }
            return;
        }

        public function stopPanOverTime(arg1:String, arg2:String):void
        {
            var loc1:*=arg1.toLowerCase() + "_panOver";
            if (this._soundDictionary[arg2][loc1] == null) 
            {
                return;
            }
            if (this._soundDictionary[arg2][loc1].pTimer != null) 
            {
                if (this._soundDictionary[arg2][loc1].pTimer.running) 
                {
                    this._soundDictionary[arg2][loc1].pTimer.stop();
                }
            }
            return;
        }

        public function getChannel(arg1:String):flash.media.SoundChannel
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=0;
            var loc4:*=this._soundDictionary;
            for (loc1 in loc4) 
            {
                if (this._soundDictionary[loc1] == null) 
                {
                    continue;
                }
                var loc5:*=0;
                var loc6:*=this._soundDictionary[loc1];
                for (loc2 in loc6) 
                {
                    if (this._soundDictionary[loc1][loc2.toLowerCase() + "_channel"] == null) 
                    {
                        continue;
                    }
                    return this._soundDictionary[loc1][loc2.toLowerCase() + "_channel"].soundChannel;
                }
            }
            return null;
        }

        internal function onPanOverTimer(arg1:flash.events.TimerEvent):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=arg1.target as mgs.aurora.soundengine.controller.timers.PanTimer;
            loc1.timeCounter = loc1.timeCounter + this.SOUND_OVER_TIME_DELAY;
            if (this._soundDictionary[loc1.soundGroup][loc1.soundName + "_channel"] == null) 
            {
                loc1.stop();
                this.dispatchEvent(new mgs.aurora.common.events.SystemSoundEvent(mgs.aurora.common.events.SystemSoundEvent.PANOVERTIME, loc1.soundName, loc1.soundGroup, null));
            }
            else 
            {
                loc2 = mgs.aurora.soundengine.model.SoundChannelEx(this._soundDictionary[loc1.soundGroup][loc1.soundName + "_channel"]).soundChannel;
                loc3 = loc2.soundTransform;
                loc1.panStart = loc1.panStart - loc1.panChange;
                loc3.pan = this.getPanFromPercentage(loc1.panStart);
                loc2.soundTransform = loc3;
                if (this._soundDictionary[loc1.soundGroup].mute) 
                {
                    loc3.volume = 0;
                }
                if (loc1.timeCounter >= loc1.time) 
                {
                    loc1.stop();
                    this.dispatchEvent(new mgs.aurora.common.events.SystemSoundEvent(mgs.aurora.common.events.SystemSoundEvent.PANOVERTIME, loc1.soundName, loc1.soundGroup, loc2));
                }
            }
            return;
        }

        public function group(arg1:String):mgs.aurora.common.interfaces.sounds.ISoundGroup
        {
            return this._soundDictionary[arg1] as mgs.aurora.common.interfaces.sounds.ISoundGroup;
        }

        internal function onVolumeOverTimer(arg1:flash.events.TimerEvent):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=arg1.target as mgs.aurora.soundengine.controller.timers.VolumeTimer;
            loc1.timeCounter = loc1.timeCounter + this.SOUND_OVER_TIME_DELAY;
            if (this._soundDictionary[loc1.soundGroup][loc1.soundName + "_channel"] == null) 
            {
                loc1.stop();
                this.dispatchEvent(new mgs.aurora.common.events.SystemSoundEvent(mgs.aurora.common.events.SystemSoundEvent.VOLUMEOVERTIME, loc1.soundName, loc1.soundGroup, null));
            }
            else 
            {
                loc2 = mgs.aurora.soundengine.model.SoundChannelEx(this._soundDictionary[loc1.soundGroup][loc1.soundName + "_channel"]).soundChannel;
                loc3 = loc2.soundTransform;
                loc1.volumeStart = loc1.volumeStart - loc1.volumeDrop;
                if (this._soundDictionary[loc1.soundGroup].mute) 
                {
                    loc3.volume = 0;
                }
                else 
                {
                    loc3.volume = loc1.volumeStart * this.MULTIPLIER;
                }
                loc2.soundTransform = loc3;
                if (loc1.timeCounter >= loc1.time) 
                {
                    loc1.stop();
                    this.dispatchEvent(new mgs.aurora.common.events.SystemSoundEvent(mgs.aurora.common.events.SystemSoundEvent.VOLUMEOVERTIME, loc1.soundName, loc1.soundGroup, loc2));
                }
            }
            return;
        }

        internal function getPanFromPercentage(arg1:Number):Number
        {
            if (arg1 > 50) 
            {
                return (arg1 / 50 - 1);
            }
            if (arg1 < 50) 
            {
                return (arg1 - 50) / 50;
            }
            return 0;
        }

        internal function onSoundStopped(arg1:mgs.aurora.common.events.SystemSoundEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }

        internal function onSoundComplete(arg1:mgs.aurora.common.events.SystemSoundEvent):void
        {
            this.dispatchEvent(arg1);
            return;
        }

        internal function onId3(arg1:flash.events.Event):void
        {
            return;
        }

        internal function onSampleData(arg1:flash.events.SampleDataEvent):void
        {
            return;
        }

        public function add(arg1:flash.display.LoaderInfo, arg2:Array, arg3:String):mgs.aurora.common.interfaces.sounds.ISoundGroup
        {
            var loc2:*=null;
            if (this._soundDictionary[arg3] == null) 
            {
                this._soundDictionary[arg3] = new mgs.aurora.soundengine.model.SoundGroup(arg3, this as mgs.aurora.common.interfaces.sounds.ISounds);
            }
            var loc1:*=0;
            while (loc1 < arg2.length) 
            {
                loc2 = arg1.applicationDomain.getDefinition(String(arg2[loc1])) as Class;
                this._soundDictionary[arg3][String(arg2[loc1]).toLowerCase()] = new loc2();
                ++loc1;
            }
            return this._soundDictionary[arg3] as mgs.aurora.common.interfaces.sounds.ISoundGroup;
        }

        public function play(arg1:String, arg2:String, arg3:Number=0, arg4:int=0, arg5:flash.media.SoundTransform=null):void
        {
            var loc1:*=null;
            if (this._soundDictionary[arg2] == null) 
            {
                Debugger.trace("GROUP DOES NOT EXIST : " + arg2, "SOUNDS");
                return;
            }
            if (arg5 != null) 
            {
                loc1 = arg5;
            }
            else 
            {
                loc1 = new flash.media.SoundTransform();
            }
            var loc2:*=arg1.toLowerCase();
            if (this._soundDictionary[arg2][loc2] == null) 
            {
                Debugger.trace("TARGET DOES NOT EXIST : " + loc2, "SOUNDS");
                return;
            }
            this._soundDictionary[arg2][loc2 + "_channel"] = new mgs.aurora.soundengine.model.SoundChannelEx(arg1, arg2);
            this._soundDictionary[arg2][loc2 + "_channel"].addEventListener(mgs.aurora.common.events.SystemSoundEvent.COMPLETE, this.onSoundComplete);
            this._soundDictionary[arg2][loc2 + "_channel"].addEventListener(mgs.aurora.common.events.SystemSoundEvent.STOPPED, this.onSoundStopped);
            this._soundDictionary[arg2][loc2 + "_channel"].soundChannel = this._soundDictionary[arg2][loc2].play(arg3, arg4, loc1);
            this._soundDictionary[arg2][loc2 + "_soundTransformHistory"] = loc1;
            this.setChannelMute([arg1], this._soundDictionary[arg2].mute, arg2);
            return;
        }

        public function stop(arg1:String, arg2:String):void
        {
            var loc1:*=arg1.toLowerCase();
            if (this._soundDictionary[arg2] != null) 
            {
                if (this._soundDictionary[arg2][loc1 + "_channel"] != null) 
                {
                    this._soundDictionary[arg2][loc1 + "_channel"].stop();
                }
            }
            return;
        }

        public function stopAll(arg1:String):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            if (arg1 != "") 
            {
                loc4 = 0;
                loc5 = this._soundDictionary[arg1];
                for (loc3 in loc5) 
                {
                    if (this._soundDictionary[arg1][loc3.toLowerCase() + "_channel"] == null) 
                    {
                        continue;
                    }
                    this._soundDictionary[arg1][loc3.toLowerCase() + "_channel"].stop();
                }
            }
            else 
            {
                var loc4:*=0;
                var loc5:*=this._soundDictionary;
                for (loc1 in loc5) 
                {
                    if (this._soundDictionary[loc1] == null) 
                    {
                        continue;
                    }
                    var loc6:*=0;
                    var loc7:*=this._soundDictionary[loc1];
                    for (loc2 in loc7) 
                    {
                        if (this._soundDictionary[loc1][loc2.toLowerCase() + "_channel"] == null) 
                        {
                            continue;
                        }
                        this._soundDictionary[loc1][loc2.toLowerCase() + "_channel"].stop();
                    }
                }
            }
            return;
        }

        public function remove(arg1:Array, arg2:String):void
        {
            var loc2:*=null;
            var loc1:*=0;
            while (loc1 < arg1.length) 
            {
                loc2 = arg1[loc1].toLowerCase();
                if (this._soundDictionary[arg2][loc2] != null) 
                {
                    if (this._soundDictionary[arg2][loc2 + "_channel"] != null) 
                    {
                        this.stop(loc2, arg2);
                        this._soundDictionary[arg2][loc2 + "_channel"].removeEventListener(mgs.aurora.common.events.SystemSoundEvent.COMPLETE, this.onSoundComplete);
                        delete this._soundDictionary[arg2][loc2 + "_channel"];
                        delete this._soundDictionary[arg2][loc2];
                    }
                }
                ++loc1;
            }
            return;
        }

        public function removeAll(arg1:String):void
        {
            var loc1:*=null;
            this.stopAll(arg1);
            var loc2:*=0;
            var loc3:*=this._soundDictionary[arg1];
            for (loc1 in loc3) 
            {
                if (this._soundDictionary[arg1][loc1.toLowerCase() + "_channel"] == null) 
                {
                    continue;
                }
                this._soundDictionary[arg1][loc1.toLowerCase() + "_channel"].removeEventListener(mgs.aurora.common.events.SystemSoundEvent.COMPLETE, this.onSoundComplete);
                delete this._soundDictionary[arg1][loc1.toLowerCase() + "_channel"];
                delete this._soundDictionary[arg1][loc1.toLowerCase()];
            }
            delete this._soundDictionary[arg1];
            return;
        }

        public function setChannelVolume(arg1:Array, arg2:Number, arg3:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=0;
            while (loc1 < arg1.length) 
            {
                if (this._soundDictionary[arg3] != null) 
                {
                    if (this._soundDictionary[arg3][arg1[loc1].toLowerCase()] != null) 
                    {
                        if ((loc2 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"]) != null) 
                        {
                            (loc3 = loc2.soundTransform).volume = arg2 * this.MULTIPLIER;
                            this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform = loc3;
                        }
                    }
                }
                ++loc1;
            }
            return;
        }

        public function setChannelPan(arg1:Array, arg2:Number, arg3:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=0;
            while (loc1 < arg1.length) 
            {
                if (this._soundDictionary[arg3][arg1[loc1].toLowerCase()] != null) 
                {
                    if ((loc2 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"]) != null) 
                    {
                        (loc3 = loc2.soundTransform).pan = this.getPanFromPercentage(arg2);
                        this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform = loc3;
                    }
                }
                ++loc1;
            }
            return;
        }

        public function setChannelLeftToLeft(arg1:Array, arg2:Number, arg3:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=0;
            while (loc1 < arg1.length) 
            {
                if (this._soundDictionary[arg3][arg1[loc1].toLowerCase()] != null) 
                {
                    if ((loc2 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"]) != null) 
                    {
                        (loc3 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform).leftToLeft = arg2 * this.MULTIPLIER;
                        this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform = loc3;
                    }
                }
                ++loc1;
            }
            return;
        }

        public function setChannelLeftToRight(arg1:Array, arg2:Number, arg3:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=0;
            while (loc1 < arg1.length) 
            {
                if (this._soundDictionary[arg3][arg1[loc1].toLowerCase()] != null) 
                {
                    if ((loc2 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"]) != null) 
                    {
                        (loc3 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform).leftToRight = arg2 * this.MULTIPLIER;
                        this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform = loc3;
                    }
                }
                ++loc1;
            }
            return;
        }

        public function setChannelRightToRight(arg1:Array, arg2:Number, arg3:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=0;
            while (loc1 < arg1.length) 
            {
                if (this._soundDictionary[arg3][arg1[loc1].toLowerCase()] != null) 
                {
                    if ((loc2 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"]) != null) 
                    {
                        (loc3 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform).rightToRight = arg2 * this.MULTIPLIER;
                        this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform = loc3;
                    }
                }
                ++loc1;
            }
            return;
        }

        public function setChannelRightToLeft(arg1:Array, arg2:Number, arg3:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc1:*=0;
            while (loc1 < arg1.length) 
            {
                if (this._soundDictionary[arg3][arg1[loc1].toLowerCase()] != null) 
                {
                    if ((loc2 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"]) != null) 
                    {
                        (loc3 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform).rightToLeft = arg2 * this.MULTIPLIER;
                        this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform = loc3;
                    }
                }
                ++loc1;
            }
            return;
        }

        public function setChannelMute(arg1:Array, arg2:Boolean, arg3:String):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=null;
            var loc5:*=null;
            var loc1:*=0;
            while (loc1 < arg1.length) 
            {
                if (this._soundDictionary[arg3][arg1[loc1].toLowerCase()] != null) 
                {
                    if (arg2 != true) 
                    {
                        if (arg2 == false) 
                        {
                            if ((loc4 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"]) != null) 
                            {
                                loc5 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_soundTransformHistory"];
                                loc4.soundTransform = loc5;
                            }
                        }
                    }
                    else if ((loc2 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"]) != null) 
                    {
                        loc3 = this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform;
                        this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_soundTransformHistory"] = loc5;
                        loc3.volume = 0;
                        this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_channel"].soundTransform = loc3;
                    }
                    this._soundDictionary[arg3][arg1[loc1].toLowerCase() + "_mute"] = arg2;
                }
                ++loc1;
            }
            return;
        }

        public function getChannelMute(arg1:Array, arg2:String):Boolean
        {
            var loc1:*=0;
            while (loc1 < arg1.length) 
            {
                if (this._soundDictionary[arg2][arg1[loc1].toLowerCase()] != null) 
                {
                    return this._soundDictionary[arg2][arg1[loc1].toLowerCase() + "_mute"];
                }
                ++loc1;
            }
            return undefined;
        }

        public function set globalVolume(arg1:Number):void
        {
            this._globalVolume = arg1 * this.MULTIPLIER;
            if (this.mute) 
            {
                return;
            }
            Debugger.trace("globalVolume : " + this._globalVolume);
            var loc1:*=flash.media.SoundMixer.soundTransform;
            loc1.volume = this._globalVolume;
            flash.media.SoundMixer.soundTransform = loc1;
            this.dispatchEvent(new mgs.aurora.common.events.SystemSoundEvent(mgs.aurora.common.events.SystemSoundEvent.VOLUME, "global", "global", null));
            return;
        }

        public function get globalVolume():Number
        {
            return this._globalVolume;
        }

        public function set mute(arg1:Boolean):void
        {
            var loc1:*=null;
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=0;
            var loc5:*=0;
            var loc6:*=null;
            var loc7:*=null;
            this._mute = arg1;
            if (this._mute) 
            {
                loc2 = flash.media.SoundMixer.soundTransform;
                loc2.volume = 0;
                flash.media.SoundMixer.soundTransform = loc2;
            }
            else if (!this._mute) 
            {
                (loc3 = flash.media.SoundMixer.soundTransform).volume = this._globalVolume;
                loc3.pan = this._globalPan;
                flash.media.SoundMixer.soundTransform = loc3;
            }
            var loc8:*=0;
            var loc9:*=this._soundDictionary;
            for each (loc1 in loc9) 
            {
                if (loc1 != null) 
                {
                    if (this._mute) 
                    {
                        this.setChannelVolume(loc1.soundList, 0, loc1.groupName);
                    }
                    else 
                    {
                        loc4 = loc1.soundList.length;
                        loc5 = 0;
                        while (loc5 < loc4) 
                        {
                            loc6 = loc1.soundList[loc5] + "_channel";
                            if ((loc7 = this._soundDictionary[loc1.groupName][loc6] as mgs.aurora.soundengine.model.SoundChannelEx) != null) 
                            {
                                loc7.soundTransform = loc7.lastSoundTransform;
                            }
                            ++loc5;
                        }
                    }
                }
                loc1.mute = this._mute;
            }
            this.dispatchEvent(new mgs.aurora.common.events.SystemSoundEvent(mgs.aurora.common.events.SystemSoundEvent.MUTE, "global", "global", null));
            return;
        }

        public function get mute():Boolean
        {
            return this._mute;
        }

        public function set globalPan(arg1:Number):void
        {
            this._globalPan = this.getPanFromPercentage(arg1);
            if (this.mute) 
            {
                return;
            }
            var loc1:*=flash.media.SoundMixer.soundTransform;
            loc1.volume = this.globalVolume;
            loc1.pan = this._globalPan;
            flash.media.SoundMixer.soundTransform = loc1;
            return;
        }

        public function get globalPan():Number
        {
            return this._globalPan;
        }

        public function set globalLeftToLeft(arg1:Number):void
        {
            this._globalLeftToLeft = arg1 * this.MULTIPLIER;
            if (this.mute) 
            {
                return;
            }
            var loc1:*=flash.media.SoundMixer.soundTransform;
            loc1.leftToLeft = this._globalLeftToLeft;
            flash.media.SoundMixer.soundTransform = loc1;
            return;
        }

        public function get globalLeftToLeft():Number
        {
            return this._globalLeftToLeft;
        }

        public function set globalLeftToRight(arg1:Number):void
        {
            this._globalLeftToRight = arg1 * this.MULTIPLIER;
            if (this.mute) 
            {
                return;
            }
            var loc1:*=flash.media.SoundMixer.soundTransform;
            loc1.leftToRight = this._globalLeftToRight;
            flash.media.SoundMixer.soundTransform = loc1;
            return;
        }

        public function get globalLeftToRight():Number
        {
            return this._globalLeftToRight;
        }

        public function set globalRightToRight(arg1:Number):void
        {
            this._globalRightToRight = arg1 * this.MULTIPLIER;
            if (this.mute) 
            {
                return;
            }
            var loc1:*=flash.media.SoundMixer.soundTransform;
            loc1.rightToRight = this._globalRightToRight;
            flash.media.SoundMixer.soundTransform = loc1;
            return;
        }

        public function get globalRightToRight():Number
        {
            return this._globalRightToRight;
        }

        public function set globalRightToLeft(arg1:Number):void
        {
            this._globalRightToLeft = arg1 * this.MULTIPLIER;
            if (this.mute) 
            {
                return;
            }
            var loc1:*=flash.media.SoundMixer.soundTransform;
            loc1.rightToLeft = this._globalRightToLeft;
            flash.media.SoundMixer.soundTransform = loc1;
            return;
        }

        public function get globalRightToLeft():Number
        {
            return this._globalRightToLeft;
        }

        public function setChannelVolumeOverTime(arg1:Array, arg2:String, arg3:Number, arg4:Number, arg5:Number):void
        {
            var loc2:*=null;
            var loc3:*=null;
            var loc4:*=NaN;
            var loc5:*=NaN;
            var loc1:*=0;
            while (loc1 < arg1.length) 
            {
                if (this._soundDictionary[arg2] != null) 
                {
                    if (this._soundDictionary[arg2][arg1[loc1].toLowerCase()] != null) 
                    {
                        loc3 = (loc2 = arg1[loc1].toLowerCase()) + "_volumeOver";
                        this._soundDictionary[arg2][loc3] = new Object();
                        this._soundDictionary[arg2][loc3].vTimer = new mgs.aurora.soundengine.controller.timers.VolumeTimer(this.SOUND_OVER_TIME_DELAY);
                        this._soundDictionary[arg2][loc3].vTimer.soundName = loc2;
                        this._soundDictionary[arg2][loc3].vTimer.soundGroup = arg2;
                        this._soundDictionary[arg2][loc3].vTimer.volumeStart = arg3;
                        this._soundDictionary[arg2][loc3].vTimer.volumeEnd = arg4;
                        this._soundDictionary[arg2][loc3].vTimer.time = arg5;
                        this._soundDictionary[arg2][loc3].vTimer.timeCounter = 0;
                        loc4 = arg3 - arg4;
                        loc5 = arg5 / this.SOUND_OVER_TIME_DELAY;
                        this._soundDictionary[arg2][loc3].vTimer.volumeDrop = loc4 / loc5;
                        this._soundDictionary[arg2][loc3].vTimer.addEventListener(flash.events.TimerEvent.TIMER, this.onVolumeOverTimer);
                        this._soundDictionary[arg2][loc3].vTimer.start();
                    }
                }
                ++loc1;
            }
            return;
        }

        internal const MULTIPLIER:Number=0.01;

        internal const SOUND_OVER_TIME_DELAY:Number=100;

        internal var _soundDictionary:flash.utils.Dictionary;

        internal var _eventDispatcher:flash.events.EventDispatcher;

        internal var _mute:Boolean;

        internal var _globalVolume:Number;

        internal var _globalPan:Number;

        internal var _globalLeftToRight:Number;

        internal var _globalRightToRight:Number;

        internal var _globalRightToLeft:Number;

        internal var _globalLeftToLeft:Number;
    }
}


//          class SoundEngineNotifications
package mgs.aurora.soundengine.model 
{
    public class SoundEngineNotifications extends Object
    {
        public function SoundEngineNotifications()
        {
            super();
            return;
        }

        public static const SOUND_ENGINE_STARTUP:String="Sound_Engine_Startup";
    }
}


//          class SoundGroup
package mgs.aurora.soundengine.model 
{
    import flash.events.*;
    import flash.media.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.sounds.*;
    
    public dynamic class SoundGroup extends flash.events.EventDispatcher implements mgs.aurora.common.interfaces.sounds.ISoundGroup
    {
        public function SoundGroup(arg1:String, arg2:mgs.aurora.common.interfaces.sounds.ISounds)
        {
            super();
            this._groupName = arg1;
            this._sound = arg2;
            this.mute = arg2.mute;
            this.volume = arg2.globalVolume;
            this._sound.addEventListener(mgs.aurora.common.events.SystemSoundEvent.COMPLETE, this.onSoundEvent);
            this._sound.addEventListener(mgs.aurora.common.events.SystemSoundEvent.PANOVERTIME, this.onSoundEvent);
            this._sound.addEventListener(mgs.aurora.common.events.SystemSoundEvent.VOLUMEOVERTIME, this.onSoundEvent);
            this._sound.addEventListener(mgs.aurora.common.events.SystemSoundEvent.STOPPED, this.onSoundEvent);
            this._sound.addEventListener(mgs.aurora.common.events.SystemSoundEvent.MUTE, this.onSoundMuted);
            return;
        }

        public function play(arg1:String, arg2:Number=0, arg3:int=0, arg4:flash.media.SoundTransform=null):void
        {
            this._sound.play(arg1, this.groupName, arg2, arg3, arg4);
            return;
        }

        public function stop(arg1:String):void
        {
            this._sound.stop(arg1, this.groupName);
            return;
        }

        public function stopAll():void
        {
            this._sound.stopAll(this.groupName);
            return;
        }

        public function remove(arg1:Array):void
        {
            this._sound.remove(arg1, this.groupName);
            return;
        }

        public function removeAll():void
        {
            this._sound.removeAll(this.groupName);
            return;
        }

        public function setChannelVolume(arg1:Array, arg2:Number):void
        {
            this._sound.setChannelVolume(arg1, arg2, this.groupName);
            return;
        }

        public function setChannelPan(arg1:Array, arg2:Number):void
        {
            this._sound.setChannelPan(arg1, arg2, this.groupName);
            return;
        }

        public function setChannelLeftToLeft(arg1:Array, arg2:Number):void
        {
            this._sound.setChannelLeftToLeft(arg1, arg2, this.groupName);
            return;
        }

        public function setChannelLeftToRight(arg1:Array, arg2:Number):void
        {
            this._sound.setChannelLeftToRight(arg1, arg2, this.groupName);
            return;
        }

        public function setChannelRightToRight(arg1:Array, arg2:Number):void
        {
            this._sound.setChannelRightToRight(arg1, arg2, this.groupName);
            return;
        }

        public function setChannelRightToLeft(arg1:Array, arg2:Number):void
        {
            this._sound.setChannelRightToLeft(arg1, arg2, this.groupName);
            return;
        }

        public function setChannelMute(arg1:Array, arg2:Boolean):void
        {
            this._sound.setChannelMute(arg1, arg2, this.groupName);
            return;
        }

        public function getChannelMute(arg1:Array):Boolean
        {
            return this._sound.getChannelMute(arg1, this.groupName);
        }

        public function setChannelVolumeOverTime(arg1:Array, arg2:Number, arg3:Number, arg4:Number):void
        {
            this._sound.setChannelVolumeOverTime(arg1, this.groupName, arg2, arg3, arg4);
            return;
        }

        public function setChannelPanOverTime(arg1:Array, arg2:Number, arg3:Number, arg4:Number):void
        {
            this._sound.setChannelPanOverTime(arg1, this.groupName, arg2, arg3, arg4);
            return;
        }

        public function stopVolumeOverTime(arg1:String):void
        {
            this._sound.stopVolumeOverTime(arg1, this.groupName);
            return;
        }

        public function stopPanOverTime(arg1:String):void
        {
            this._sound.stopPanOverTime(arg1, this.groupName);
            return;
        }

        public function get groupName():String
        {
            return this._groupName;
        }

        public function getChannel(arg1:String):flash.media.SoundChannel
        {
            return this._sound.getChannel(arg1);
        }

        public function get mute():Boolean
        {
            return this._mute;
        }

        public function set mute(arg1:Boolean):void
        {
            this._mute = arg1;
            this._sound.setChannelMute(this.soundList, this._mute, this._groupName);
            return;
        }

        public function get volume():Number
        {
            return this._volume;
        }

        public function set volume(arg1:Number):void
        {
            this._volume = arg1;
            this._sound.setChannelVolume(this.soundList, this._volume, this._groupName);
            return;
        }

        public function get soundList():Array
        {
            var loc2:*=null;
            var loc3:*=undefined;
            var loc1:*=new Array();
            var loc4:*=0;
            var loc5:*=this;
            for (loc2 in loc5) 
            {
                loc3 = this[loc2.toLowerCase()];
                if (!(loc3 is flash.media.Sound)) 
                {
                    continue;
                }
                loc1.push(loc2);
            }
            return loc1;
        }

        internal function onSoundEvent(arg1:mgs.aurora.common.events.SystemSoundEvent):void
        {
            if (arg1.group == this.groupName) 
            {
                super.dispatchEvent(arg1);
            }
            return;
        }

        internal function onSoundMuted(arg1:mgs.aurora.common.events.SystemSoundEvent):void
        {
            return;
        }

        internal var _groupName:String;

        internal var _sound:mgs.aurora.common.interfaces.sounds.ISounds;

        internal var _mute:Boolean;

        internal var _volume:Number;
    }
}


//        class SoundEngineFacade
package mgs.aurora.soundengine 
{
    import com.demonsters.debugger.*;
    import flash.display.*;
    import mgs.aurora.soundengine.model.*;
    import org.puremvc.as3.multicore.interfaces.*;
    import org.puremvc.as3.multicore.patterns.facade.*;
    
    public class SoundEngineFacade extends org.puremvc.as3.multicore.patterns.facade.Facade implements org.puremvc.as3.multicore.interfaces.IFacade
    {
        public function SoundEngineFacade(arg1:String)
        {
            super(arg1);
            return;
        }

        public function startUp(arg1:flash.display.MovieClip):void
        {
            this.sendNotification(mgs.aurora.soundengine.model.SoundEngineNotifications.SOUND_ENGINE_STARTUP, arg1);
            return;
        }

        public static function getInstance(arg1:String):mgs.aurora.soundengine.SoundEngineFacade
        {
            if (mgs.aurora.soundengine.SoundEngineFacade.__instance__ == null) 
            {
                mgs.aurora.soundengine.SoundEngineFacade.__instance__ = new SoundEngineFacade(arg1);
            }
            return mgs.aurora.soundengine.SoundEngineFacade.__instance__ as mgs.aurora.soundengine.SoundEngineFacade;
        }

        internal static var __instance__:mgs.aurora.soundengine.SoundEngineFacade;

        public static var monster:com.demonsters.debugger.MonsterDebugger;
    }
}


//        class SoundEngineMain
package mgs.aurora.soundengine 
{
    import flash.display.*;
    import flash.events.*;
    import flash.media.*;
    import mgs.aurora.common.events.*;
    import mgs.aurora.common.interfaces.sounds.*;
    import mgs.aurora.soundengine.model.*;
    
    public class SoundEngineMain extends flash.display.Sprite implements mgs.aurora.common.interfaces.sounds.ISounds
    {
        public function SoundEngineMain()
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

        public function group(arg1:String):mgs.aurora.common.interfaces.sounds.ISoundGroup
        {
            return this._soundEngineImpl.group(arg1);
        }

        public function getChannel(arg1:String):flash.media.SoundChannel
        {
            return this._soundEngineImpl.getChannel(arg1);
        }

        internal function init(arg1:flash.events.Event=null):void
        {
            this.removeEventListener(flash.events.Event.ADDED_TO_STAGE, this.init);
            this.addEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.dispose);
            this._soundEngineImpl = new mgs.aurora.soundengine.model.SoundEngine();
            this._soundEngineImpl.addEventListener(mgs.aurora.common.events.SystemSoundEvent.COMPLETE, this.dispatchEvent);
            this._soundEngineImpl.addEventListener(mgs.aurora.common.events.SystemSoundEvent.MUTE, this.dispatchEvent);
            this._soundEngineImpl.addEventListener(mgs.aurora.common.events.SystemSoundEvent.PANOVERTIME, this.dispatchEvent);
            this._soundEngineImpl.addEventListener(mgs.aurora.common.events.SystemSoundEvent.VOLUME, this.dispatchEvent);
            this._soundEngineImpl.addEventListener(mgs.aurora.common.events.SystemSoundEvent.VOLUMEOVERTIME, this.dispatchEvent);
            this._soundEngineImpl.addEventListener(mgs.aurora.common.events.SystemSoundEvent.STOPPED, this.dispatchEvent);
            return;
        }

        internal function dispose(arg1:flash.events.Event):void
        {
            removeEventListener(flash.events.Event.REMOVED_FROM_STAGE, this.dispose);
            this._soundEngineImpl.removeEventListener(mgs.aurora.common.events.SystemSoundEvent.COMPLETE, this.dispatchEvent);
            this._soundEngineImpl.removeEventListener(mgs.aurora.common.events.SystemSoundEvent.MUTE, this.dispatchEvent);
            this._soundEngineImpl.removeEventListener(mgs.aurora.common.events.SystemSoundEvent.PANOVERTIME, this.dispatchEvent);
            this._soundEngineImpl.removeEventListener(mgs.aurora.common.events.SystemSoundEvent.VOLUME, this.dispatchEvent);
            this._soundEngineImpl.removeEventListener(mgs.aurora.common.events.SystemSoundEvent.VOLUMEOVERTIME, this.dispatchEvent);
            this._soundEngineImpl.removeEventListener(mgs.aurora.common.events.SystemSoundEvent.STOPPED, this.dispatchEvent);
            this._soundEngineImpl = null;
            return;
        }

        public function add(arg1:flash.display.LoaderInfo, arg2:Array, arg3:String):mgs.aurora.common.interfaces.sounds.ISoundGroup
        {
            return this._soundEngineImpl.add(arg1, arg2, arg3);
        }

        public function play(arg1:String, arg2:String, arg3:Number=0, arg4:int=0, arg5:flash.media.SoundTransform=null):void
        {
            this._soundEngineImpl.play(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public function stop(arg1:String, arg2:String):void
        {
            this._soundEngineImpl.stop(arg1, arg2);
            return;
        }

        public function stopAll(arg1:String):void
        {
            this._soundEngineImpl.stopAll(arg1);
            return;
        }

        public function remove(arg1:Array, arg2:String):void
        {
            this._soundEngineImpl.remove(arg1, arg2);
            return;
        }

        public function removeAll(arg1:String):void
        {
            this._soundEngineImpl.removeAll(arg1);
            return;
        }

        public function setChannelVolume(arg1:Array, arg2:Number, arg3:String):void
        {
            this._soundEngineImpl.setChannelVolume(arg1, arg2, arg3);
            return;
        }

        public function setChannelPan(arg1:Array, arg2:Number, arg3:String):void
        {
            this._soundEngineImpl.setChannelPan(arg1, arg2, arg3);
            return;
        }

        public function setChannelLeftToLeft(arg1:Array, arg2:Number, arg3:String):void
        {
            this._soundEngineImpl.setChannelLeftToLeft(arg1, arg2, arg3);
            return;
        }

        public function setChannelLeftToRight(arg1:Array, arg2:Number, arg3:String):void
        {
            this._soundEngineImpl.setChannelLeftToRight(arg1, arg2, arg3);
            return;
        }

        public function setChannelRightToRight(arg1:Array, arg2:Number, arg3:String):void
        {
            this._soundEngineImpl.setChannelRightToRight(arg1, arg2, arg3);
            return;
        }

        public function setChannelRightToLeft(arg1:Array, arg2:Number, arg3:String):void
        {
            this._soundEngineImpl.setChannelRightToLeft(arg1, arg2, arg3);
            return;
        }

        public function setChannelMute(arg1:Array, arg2:Boolean, arg3:String):void
        {
            this._soundEngineImpl.setChannelMute(arg1, arg2, arg3);
            return;
        }

        public function getChannelMute(arg1:Array, arg2:String):Boolean
        {
            return this._soundEngineImpl.getChannelMute(arg1, arg2);
        }

        public function set mute(arg1:Boolean):void
        {
            this._soundEngineImpl.mute = arg1;
            return;
        }

        public function get mute():Boolean
        {
            return this._soundEngineImpl.mute;
        }

        public function set globalVolume(arg1:Number):void
        {
            this._soundEngineImpl.globalVolume = arg1;
            return;
        }

        public function get globalVolume():Number
        {
            return this._soundEngineImpl.globalVolume;
        }

        public function set globalPan(arg1:Number):void
        {
            this._soundEngineImpl.globalPan = arg1;
            return;
        }

        public function get globalPan():Number
        {
            return this._soundEngineImpl.globalPan;
        }

        public function set globalLeftToLeft(arg1:Number):void
        {
            this._soundEngineImpl.globalLeftToLeft = arg1;
            return;
        }

        public function get globalLeftToLeft():Number
        {
            return this._soundEngineImpl.globalLeftToLeft;
        }

        public function set globalLeftToRight(arg1:Number):void
        {
            this._soundEngineImpl.globalLeftToRight = arg1;
            return;
        }

        public function get globalLeftToRight():Number
        {
            return this._soundEngineImpl.globalLeftToRight;
        }

        public function set globalRightToRight(arg1:Number):void
        {
            this._soundEngineImpl.globalRightToRight = arg1;
            return;
        }

        public function get globalRightToRight():Number
        {
            return this._soundEngineImpl.globalRightToRight;
        }

        public function set globalRightToLeft(arg1:Number):void
        {
            this._soundEngineImpl.globalRightToLeft = arg1;
            return;
        }

        public function get globalRightToLeft():Number
        {
            return this._soundEngineImpl.globalRightToLeft;
        }

        public function setChannelVolumeOverTime(arg1:Array, arg2:String, arg3:Number, arg4:Number, arg5:Number):void
        {
            this._soundEngineImpl.setChannelVolumeOverTime(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public function setChannelPanOverTime(arg1:Array, arg2:String, arg3:Number, arg4:Number, arg5:Number):void
        {
            this._soundEngineImpl.setChannelPanOverTime(arg1, arg2, arg3, arg4, arg5);
            return;
        }

        public function stopVolumeOverTime(arg1:String, arg2:String):void
        {
            this._soundEngineImpl.stopVolumeOverTime(arg1, arg2);
            return;
        }

        public function stopPanOverTime(arg1:String, arg2:String):void
        {
            this._soundEngineImpl.stopPanOverTime(arg1, arg2);
            return;
        }

        internal var _applicationFacade:mgs.aurora.soundengine.SoundEngineFacade;

        internal var _soundEngineImpl:mgs.aurora.soundengine.model.SoundEngine;
    }
}


