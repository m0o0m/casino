mgs.aurora.games.common.components.utils.Scrambler

public class Scrambler extends Object
    {
        public function Scrambler()
        {
            super();
            return;
        }

        public static function unscrambleArray(arg1:String):String
        {
            var loc6:*=NaN;
            var loc7:*=null;
            var loc1:*=Vector.<String>(arg1.split(""));
            loc1.reverse();
            var loc2:*=parseInt(loc1.slice(0, 2).join(""), 26);
            var loc3:*="";
            var loc4:*="";
            var loc5:*=2;
            while (loc5 < loc1.length) 
            {
                if ((loc3 = loc3 + loc1[loc5]).length >= 2) 
                {
                    loc6 = parseInt(loc3, 30);
                    loc7 = (loc7 = Scrambler.convertToDigitString(loc6.toString(2), 9)).substring(0, 7);
                    loc6 = (loc6 = parseInt(loc7, 2)) ^ loc2;
                    loc4 = loc4 + String.fromCharCode(loc6 + 13);
                    loc3 = "";
                }
                ++loc5;
            }
            return loc4;
        }

        internal static function convertToDigitString(arg1:String, arg2:Number):String
        {
            var loc1:*="";
            var loc2:*=arg2 - arg1.length;
            var loc3:*=0;
            while (loc3 < loc2) 
            {
                loc1 = loc1 + "0";
                ++loc3;
            }
            return loc1 + arg1;
        }
    }
