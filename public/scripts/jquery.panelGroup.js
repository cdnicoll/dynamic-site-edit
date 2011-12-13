/*
Copyright (c) 2010 Cody Nicoll (http://www.cnicollonline.com)
Licensed under the MIT License:
    http://www.opensource.org/licenses/mit-license.php

@author:    cNicoll
@email:     cdnicoll[@]gmail.com
@name:	    jquery.PanelGroup.js
@date:      02-11-10_12-01

RELEASE NOTES:
==========================================================================================
@version 1.0 | 02-11-10_12-01
    *   Used with jQuery UI Sortable API (http://jqueryui.com/demos/sortable/)
    *   External jQuery scripts needed:
            - jquery.js (this version uses 1.4)
            - jquery-ui-1.7.2.custom.min.js
            - jquery.json.min.js
    *   Tested and working in:
    *       - Safari 4.0.4
    *   Takes a group of panels and allows the user to move them around. Once a move has
        been made the update() function is invoked. The update function will use JSON to
        encode the data which will then be sent to an external script. The external script
        will take the JSON encoded data provided and decode it using PHP
    *   In order to use this successfully with a database there _MUST_ be a table name supplied
        when the object is created. JSON passes this to the external script and that script will
        use the table to update the correct table within the database
        
KNOWN ISSUES:
==========================================================================================
@version 1.0 | 02-11-10_12-01
    [ ] If there is a grid I need to get the parent item. I'm currently check the parent
        of the top <UL> item. The problem with this is that if the groupPanel are not in 
        a UL LI structure there might be a hickup.    
        [ ] I could maybe solve this by making an option, but kind of asking the end user
            a lot in the event they choose not to use a UL LI structure.
==========================================================================================
*/

//Anonymous function to wrap around your function to avoid conflict  
(function($){  

    //Attach this new method to jQuery  
    $.fn.extend({   
          
          //This is where you write your plugin's name  
          panelGroup: function(tablename, options) {
  
            // Default settings that can be overridden
            var defaults = {
                handle:         '.drag_handle',
                cursor:         'move',
                placeholder:    'placeholder'
            }
            
            // passing the arguments into an options variable
            var options = $.extend(defaults, options, tablename);
            
            //Iterate over the current set of matched elements  
            return this.each(function() {  
                var group = '.'+$(this).attr('class');          // get the class for the items to be sorted
                               
                $(this).children().addClass("drag_box");        // added a dragbox to all elements within the
                                                                // object.
                
                $(options.handle).css("cursor",options.cursor)  // add the option cursor to the option handle                                         
                                                            
                // Start using the sortable jQuery UI plugin
                $(group).sortable({
                    connectWith: group,                 // from the default options, can be overridden
                    handle: options.handle,             // from the default options, can be overridden
                    cursor: options.cursor,             // from the default options, can be overridden
                    placeholder: options.placeholder,   // from the default options, can be overridden
                    forcePlaceholderSize: true,
                    opacity: 0.4,
                    start: function(event, ui) {
                    	// nothing going on right now
                    },  
                    stop: function(event, ui){ 
                       update($(this), tablename)
                    } 
                }).disableSelection(); 
              
            }); // close the return
        }  // close the panelGroup function
    }); // close the main funciton
    
    function update(obj, tablename)
    {
        var items = []; // create an array holder for all the items
        
        // Check to see if there is a parent to the list (IE) if it's in a grid. If there is no parent item, assign the object
        var parent = ($(obj).parents('ul').length >= 1 ? $(obj).parents('ul') : $(obj));
        
        // loop through each drag_box item within the parent
        $(parent).find('.drag_box').each(function(i) {
            var item = {
				id: $(this).attr('id'),            // id to update
				order: i,                           // order
				column: $(this).parent().attr('id'),                   // current column
				table: tablename                    // table name (supplied when object is created)
			};
			items.push(item);   // put the item into the items stack
        });
        
        var sortorder = {items:items}   // group the items
        
        // start the JSON encoding
		$.post(URI_PATH+'system/lib/update_jQ.php', {action: 'updatePanels', data: $.toJSON(sortorder)}, function(response) {
    		if(response = "success") {      // check for a response from JSON
    			//console.log("success");
    		}
    		else {
    		    //console.log('failed');
    		}
    	});
    }
      
//pass jQuery to the function,   
//So that we will able to use any valid Javascript variable name   
//to replace "$" SIGN. But, we'll stick to $ (I like dollar sign: ) )         
})(jQuery);
