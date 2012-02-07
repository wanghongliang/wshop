if(typeof(dclk_isDartRichMediaLoaded) == "undefined") {
        dclk_isDartRichMediaLoaded = true;
        function dclkWrite(str){
                if(dclk_shouldOverride) {
                        dclk_original_documentWrite(str);
                }
                else{
                        document.write(str);
                }
        }
        function dclkWriteln(str){
                if(dclk_shouldOverride) {
                        dclk_original_documentWriteLn(str);
                }
                else{
                        document.writeln(str);
                }
        }
        function dclk_isInternetExplorer() {
                return (navigator.appVersion.indexOf("MSIE") != -1 && navigator.userAgent.indexOf("Opera") < 0);
        }
        dclk_shouldOverride = dclk_isInternetExplorer();
        if(dclk_shouldOverride) {
                dclk_original_documentWrite = document.write;
                dclk_original_documentWriteLn = document.writeln;
                document.write = dclkWrite;
                document.writeln = dclkWriteln;
        }
}


function flash(url,w,h,wmode)
{
document.write('<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"');
document.write(' codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"');
document.write(' WIDTH='+w+' HEIGHT='+h+'>');
document.write(' <PARAM NAME=movie VALUE="'+url+'"> '); 
document.write(' <PARAM NAME=quality VALUE=autohigh> ');
document.write(' <PARAM NAME=wmode VALUE='+wmode+'> '); 
document.write(' <EMBED SRC="'+url+'" QUALITY=autohigh wmode='+wmode); 
document.write(' NAME=flashad swLiveConnect=TRUE WIDTH='+w+' HEIGHT='+h);
document.write(' TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">');
document.write('</EMBED>');
document.write('</OBJECT>');
}


 