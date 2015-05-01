<?

    $sc = PHP_EOL.'<script>
            function getSearchParameters() {
      var prmstr = window.location.search.substr(1);
      return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray( prmstr ) {
    var params = {};
    var prmarr = prmstr.split("&");
    for ( var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}

var params = getSearchParameters();
        var se = params.session;
        var st = params.static;
        
        var obj = document.getElementById("gameSwf");
            
            var dd = st + "/" + obj.getAttribute("data");
            obj.setAttribute("data", dd);
            var param = obj.children[2];
            var val = se + "/" + param.value;
            param.setAttribute("value", val);
           
            var needle = obj.outerHTML;
            var parent = obj.parentNode;
            parent.removeChild(obj);
            
            var obj = document.createElement("object");
            parent.appendChild(obj);
            obj.outerHTML = needle;
        </script>';
            
    $m = scandir('games/igt');
    
    foreach($m as $d) {
        if(strlen($d) > 3) {
            $index = file_get_contents('games/igt/'.$d.'/index.php');
            $pos = strpos($index, '</object>');
            $new = substr_replace($index, $sc, ($pos+9), 0);
            $f = fopen('games/igt/'.$d.'/index.html', 'w+');
            fwrite($f, $new);
            fclose($f);
        }
    }
