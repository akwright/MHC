
// LAST UPDATED ON NOVEMBER 13TH, 2012 (FH)

function setContainerEnabledState(container, enabled) {
    container.css({ opacity: enabled ? 1.0 : 0.5 });
    var formElems = container.find("input");
    if (enabled){
        formElems.removeAttr("disabled");
    } else {
        formElems.attr("disabled", "disabled");
    }
}

function registerEnableStateCallback(container, checkboxSelector) {
    jQuery(checkboxSelector).click(function(){
        var checked = jQuery(this).is(':checked');
        setContainerEnabledState(container, checked);
    });
}

jQuery(document).ready(function(){

    var optionalContainers = jQuery.find('.optional-container');
    jQuery.each(optionalContainers, function(index, value) {
        var container = jQuery(value);
        var controllingCheckboxName = container.attr("controlling-checkbox")
        var controllingCheckboxSelector = 'input[name=\"' + controllingCheckboxName + '\"]';
        var checked = jQuery(controllingCheckboxSelector).is(':checked');
        setContainerEnabledState(container, checked);
        registerEnableStateCallback(container, controllingCheckboxSelector);
    });

    // SELECT ALL & DESELECT ALL (IN "Categories to display" BOX)
    jQuery('.display-categories a.select-button').click(function() {

	    var mhc_value = jQuery(this).hasClass('mhc-select')
        jQuery(this).closest(".categories-container").find('input').each(function(){

            jQuery(this).attr('checked', mhc_value);

        });

        return false;

    });

	jQuery('.option-display-type').change(function() {
		var section = jQuery(this).parents('.mhc-content-sections');
		if(jQuery(this).find("option:selected").val()=="default_loop") {
			jQuery(section).find('.display-categories').hide();
			jQuery(section).find('.display-posts').hide();
		} else {
			jQuery(section).find('.display-categories').show();
			jQuery(section).find('.display-posts').show();
		}
	})

    // APPEND NEW SECTION TO THE LIST
    jQuery('#mhc-add-content-section a').click(function() {

        // WE'LL FIRST CLONE IT, THEN APPEND IT TO THE LIST
        var clonedItem = jQuery('.mhc-content-sections:eq(0)').clone();
        
        // MAKE SURE NEW CONTENT SECTION LOADS BENEATH OTHERS & ABOVE THE "ADD NEW" BUTTON
        jQuery('.mhc-content-sections:last').after(clonedItem);

        // NOW WE NEED TO CLEAR OUT ANY INPUT THAT CAME WITH THE CLONE
        jQuery('.mhc-content-sections:last input[type=text]').val('');
        jQuery('.mhc-content-sections:last textarea').val('');
        jQuery('.mhc-content-sections:last input[type=checkbox]').attr('checked', false);

        // WE ALSO NEED TO MANAGE OUR INPUT ID'S TO PREVENT COLLISION
        var mhchash = new Date();
        	mhchash = mhchash.getTime();

        // DISPLAY TYPE TO USE
        jQuery('.mhc-content-sections:last .display-types select')
        	.attr('name','mhc-display-type-' + mhchash)
            .attr('id','mhc-display-type-' + mhchash);

        // SECTION TITLE TO DISPLAY
        jQuery('.mhc-content-sections:last .display-titles input')
	        .attr('name','mhc-section-title-' + mhchash)
	        .attr('id','mhc-section-title-' + mhchash);

        // SECTION CAPTION TO DISPLAY
        jQuery('.mhc-content-sections:last .display-captions textarea')
		    .attr('name','mhc-section-caption-' + mhchash)
		    .attr('id','mhc-section-caption-' + mhchash);

        // NUMBER OF POSTS TO DISPLAY
        jQuery('.mhc-content-sections:last .display-posts input')
	        .attr('name','mhc-section-num-posts-' + mhchash)
	        .attr('id','mhc-section-num-posts-' + mhchash);

        // CATEGORIES TO DISPLAY
        jQuery('.mhc-content-sections:last .categorychecklist input').each(function() {

            var mhccat = jQuery(this);

            mhccat.attr('name', 'post_category-' + mhchash + '[]');
            mhccat.attr('id', mhccat.attr('id') + '-' + mhchash);

        });
        
        // MAKE SURE SORTABLE FUNCTIONALITY ACTIVATES IMMEDIATLY IF THERE ARE MORE THAN ONE CONTENT SECTIONS
        if(jQuery('.mhc-content-sections').length > 1) {

            jQuery('.mhc-handle').show();
            jQuery('.mhc-handle:first').after('<p class="dragdrop">' + admin_strings.drag_section_instruction + '</p>');
            jQuery('#mhc-content-sections').sortable('refresh');

        } else {

	        jQuery('.mhc-handle').hide();

        }

        return false;

    });

    // DELETE SECTION BY CLICKING ON 'X' IN THE UPPER RIGHT HAND CORNER OF BLOCK
    jQuery('a.mhc-content-section-delete').click(function(){
	    
	    // CONFIRMATION MESSAGE & FUNCTIONALITY TO DELETE CONTENT SECTIONS
        if(confirm(admin_strings.delete_section_alert)) {

        	var mhc_section;

            mhc_section = jQuery(this).parent().parent();

            mhc_section.slideUp(function() {

                mhc_section.remove();

                if(jQuery('.mhc-content-sections').length > 1){

                    jQuery('.mhc-handle').show();
                    jQuery('.mhc-handle:first').after('<p class="dragdrop">' + admin_strings.drag_section_instruction + '</p>');
                    jQuery('#mhc-content-sections').sortable('refresh');

                } else {

                    jQuery('.mhc-handle').hide();

                }

            });

        }

        return false;

    });

    // IF WE'RE LOADING SAVED SECTIONS, THE CATEGORY ID'S / NAMES AREN'T GOING TO WORK SOO...
    jQuery('.mhc-content-sections').each(function(){
		
		if(jQuery(this).find(".option-display-type option:selected").val()=="default_loop") {
			jQuery(this).find('.display-categories').hide();
			jQuery(this).find('.display-posts').hide();
		} else {
			jQuery(this).find('.display-categories').show();
			jQuery(this).find('.display-posts').show();
		}
		
		
        if(jQuery(this).attr('id') != 'default' && !jQuery(this).hasClass('mhc-content-section-default')) {

            mhchash = jQuery(this).attr('id').replace('mhc-street-section-','');

            jQuery(this).find('.categorychecklist input').each(function(){

                mhccat = jQuery(this);
                mhccat.attr('name','post_category-' + mhchash + '[]');
                mhccat.attr('id',mhccat.attr('id') + '-' + mhchash);

            });

        }

    });

    // ACTIVATE HELPER TEXT & JQUERY SORTABLE IF THERE IS MORE THAN ONE CONTENT SECTION
    if(jQuery('.mhc-content-sections').length > 1) {

    	jQuery('.mhc-handle:first').after('<p class="dragdrop">' + admin_strings.drag_section_instruction + '</p>');

	    jQuery(function() {
		   jQuery('#mhc-content-sections').sortable({
	            axis: 'y',
	            containment: 'parent',
	            forceHelperSize: true,
	            helper: 'clone',
	            opacity: 0.6
	        });

	        jQuery('#mhc-content-sections').disableSelection();

	    });

    } else {

        jQuery('.mhc-handle').hide();

    }

});