/*
@author:    
@name:	    
@date:      12-30-09_16|49

RELEASE NOTES:
==========================================================================================
@version 1.0 | 12-30-09_16|49
    http://jquery-howto.blogspot.com/2009/09/get-url-parameters-values-with-jquery.html
    
    To get a value of first parameter you would do this:
        var first = getUrlVars()["me"];
        
        // To get the second parameter
        var second = getUrlVars()["name2"];
*/

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
