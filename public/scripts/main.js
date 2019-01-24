$(function(){
   /* --------------------------------------------------------------------------------
    * Global Variables.
    * -------------------------------------------------------------------------------- */
   numeric_error     = 'Value must be numeric!';
   month_error	     = 'Invalid Month!';
   day_error	     = 'Invalid Day!';
   hour_error	     = 'Invalid Hour!';
   minute_error	     = 'Invalid Minute!';
   form              = $('form');
   messages          = $('#messages');
   ajax_messages	 = $('#ajax-messages')
   
   /* --------------------------------------------------------------------------------
    * On-load Functions.
    * -------------------------------------------------------------------------------- */
   populate_screen();
   get_messages();

   /* --------------------------------------------------------------------------------
    * Initialize TinyMCE textarea.
    * -------------------------------------------------------------------------------- */
    tinymce.init({
        selector: ".tinymce",
        height: 300,
        width: '100%',
        plugins: "link image table paste textcolor",
        menubar: false,
        toolbar: "fontselect fontsizeselect forecolor backcolor | bold italic underline strikethrough | bullist numlist | alignleft aligncenter alignright alignjustify | link image table"
    });

    /* --------------------------------------------------------------------------------
    * Initialize Datatables.
    * -------------------------------------------------------------------------------- */
    $('.datatable').DataTable({
        dom: 'lfrtBip',
        "order": [[1, "desc"]],
        iDisplayLength: 50,
        "language": {
            "search": "",
            "lengthMenu": "_MENU_"
        },
        // buttons: ['copy', 'print', 'excel', 'pdf']
        buttons: {
            buttons: [
                { extend: 'copy', className: 'button is-warning' },
                { extend: 'print', className: 'button is-info' },
                { extend: 'excel', className: 'button is-success' },
                { extend: 'pdf', className: 'button is-danger' }
            ]
        },
        initComplete: function (settings, json) {
            $(".dt-button").removeClass("dt-button");
        }
    });
    $('.dataTables_length label').addClass('select');
    $('.dataTables_filter input').addClass('input');
    $('.dataTables_filter input').attr('placeholder', 'Search...');
   
   /* --------------------------------------------------------------------------------
    * Populate screen with data from JSON.
    * -------------------------------------------------------------------------------- */
   function populate_screen(){
      console.log('populate_screen()');
      
      //Setup a request to retrieve data to populate on the screen.
      $.ajax({
        //  async:		    false,
         method:		"POST",
         type:		    "HTML",
         url:           base_url+'AJAX/Populate'
      })
      .done(function(data){
         //If a JSON object is retrieved from the request, try to parse the data onto the screen.
         try{
            obj=jQuery.parseJSON(data);
            $.each(obj, function(name, value){
               if(form.find('[name="'+name+'"]').attr('type')!='submit'){
                  //Is this is a radio button?
                  if(form.find('[name="'+name+'"]').attr('type')=='radio'){
                     //This is a radio button.
                     form.find('[id="'+name+'_'+value+'"]').prop('checked', 'checked');
                  }else{
                     //This is NOT a radio button. Is this a checkbox?
                     if(form.find('[name="'+name+'"][type=checkbox]').attr('type')=='checkbox'){
                        if(value=="CHECKED"){
                           //This is a CHECKED checkbox.
                           form.find('[name="'+name+'"]').prop('checked', true);
                        }else{
                           //This is an UNCHECKED checkbox.
                           form.find('[name="'+name+'"]').prop('checked', false);
                        }
                     }else{
                        //This is a standard input field.
                        form.find('[name="'+name+'"]').val(value);
                     }
                  }
               }
            });
            
            console.log('Screen populated successfully!');
         }catch(e){
             
         }
      })
	  .fail(function(xhr, status, error){
		 console.log('Populate screen failed!');
	  });
   }
   
   /* --------------------------------------------------------------------------------
    * Get messages.
    * -------------------------------------------------------------------------------- */
   function get_messages(){
      console.log('get_messages()');
      
      //Clear existing messages.
      clear_messages();
      
      //Setup a request to retrieve messages.
      $.ajax({
         method:	 "POST",
         type:       "HTML",
         url:	     base_url+'AJAX/Messages'
      })
      .done(function(data){
		 console.log('Messages retrieved successfully!');
         //If messages are present.
         if(data!=''){
            //Display messages.
            messages.html(data);
            
            //Format currency.
            //$('.currency').formatCurrency();
         }
      })
      .fail(function(xhr, status, error){
         console.log('Message Retrieval Error: '+xhr.responseText);
      });
   }

   function get_messages_ajax(){
    console.log('get_messages()');
    
    //Clear existing messages.
    clear_messages();
    
    //Setup a request to retrieve messages.
    $.ajax({
       method:	 "POST",
       type:     "HTML",
       url:	     base_url+'AJAX/Messages'
    })
    .done(function(data){
       console.log('Messages retrieved successfully!');
       //If messages are present.
       if(data!=''){
          //Display messages.
          ajax_messages.html(data);
          
          //Format currency.
          //$('.currency').formatCurrency();
       }
    })
    .fail(function(xhr, status, error){
       console.log('Message Retrieval Error: '+xhr.responseText);
    });
 }
    
   /* --------------------------------------------------------------------------------
    * Clear existing messages.
    * -------------------------------------------------------------------------------- */
   function clear_messages(){
      console.log('clear_messages()');
       
      messages.html('');
   }
   
   /* --------------------------------------------------------------------------------
    * Form submit.
    * -------------------------------------------------------------------------------- */
    // AJAX form
    $('.ajax-btn').on('click', function(e) {
        e.preventDefault();
        form = $(this).parents('form:first');
        action = $(this).val();
        validate();

        $.ajax({
            // async: 		false,
            method: 	"POST",
            type:		"JSON",
            data: 		form.serialize()+'&action='+action,
            url: 		form.attr('action'),
        })
        
        //The .done method will be executed if the AJAX request successfully receives a response.
        .done(function(data){
            // console.log('DATA', data);
            dataParsed = JSON.parse(data);
            get_messages_ajax();
            if (typeof(dataParsed.success) != "undefined") {
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        })

        //The .fail method will be executed if the AJAX request fails to receive a response.
        .fail(function(xhr, status, error){
            console.log('Form Submit Error: '+xhr.responseText);
        })
    });

   // Standard form
   form.not('.ajax').on('submit', function(e){
      console.log('form_submit()');

      // Setting the specific form that was submitted.
      form = $(this);
      
	  //Validate form submission.
      validate();
   });

   // Populate a form via ajax for editing
   $('[ajax-populate]').on('click', function(e) {
        e.preventDefault();

        var href = $(this).attr('href');
        var form = $(this).attr('ajax-populate');

        $.ajax({
            method: 	"GET",
            type:		"JSON",
            url: 		href,
        })

        //The .done method will be executed if the AJAX request successfully receives a response.
        .done(function(data){
            console.log(data);
            for(key in data) {
                if (data.hasOwnProperty(key)) {
                    console.log(key + " -> " + data[key]);
                    $(form).find('[name="' + key + '"]').val(data[key]);

                    if (key.indexOf('date') != -1) {
                        $(form).find('[name="' + key + '_mo"]').val(data[key].substr(4,2));
                        $(form).find('[name="' + key + '_day"]').val(data[key].substr(6,2));
                        $(form).find('[name="' + key + '_yr"]').val(data[key].substr(0,4));
                    }
                }
            }
        })

        //The .fail method will be executed if the AJAX request fails to receive a response.
        .fail(function(xhr, status, error){
            console.log('AJAX Populate Error: '+xhr.responseText);
        })
   });

   
   /* --------------------------------------------------------------------------------
    * Run server-side validations to validate form submission.
    * -------------------------------------------------------------------------------- */
   function validate(){
      console.log('validate()');
      
      var validated = true;
      
      $.ajax({
        //  async:		false,
         type:		"POST",
         url:		base_url+'AJAX/Validate',
         data:		{validations: get_validations()}
      })
      .done(function(data){
         //If data was returned, there are errors so set validated to false; otherwise set validated to true.
         if (data!='') {
            // console.log('Validations failed!');
            validated=false;
            console.log(data);
         }
      })
      .fail(function(xhr, status, error){
         console.log('Form Validation Error: '+xhr.responseText);
      });
      
      return validated;
   }
	
   /* --------------------------------------------------------------------------------
   * Get any fields that require server-side validation.
   * -------------------------------------------------------------------------------- */
   function get_validations(){
      console.log('get_validations()');
      
      //Create a validation object.
      var Validations={
         'required':		{},
      };
      
      //Loop through each element that needs to be validated.
      form.find('[data-required]').each(function(){
         //Get some information for each element being processed.
         var field_name       = $(this).attr('name');
         var field_value      = $(this).val();
         var field_label      = $(this).attr('data-label');
         if(typeof(field_label)=='undefined'){
            field_label='';
         }
         
         //If the required attribute is defined, set required to true.
         var field_required   = $(this).attr('data-required');
         if(typeof(field_required)!='undefined'){
            Validations['required'][field_name]={
               'value':	field_value,
               'label':	field_label
            }
         }
      });
      
      return JSON.stringify(Validations);
   }

	/* --------------------------------------------------------------------------------
     * Automatically add leading 0's to fields that should be numeric.
     * -------------------------------------------------------------------------------- */
    $("[data-numeric], [data-month], [data-day], [data-hour], [data-minutes]").blur(function(){
		 if ($(this).val()!='') {
			max=$(this).attr("maxlength");
			neg=max-(max*2);
			zeros='';
			count=0;
			while (count<max) {
			   zeros=zeros+'0';
			   count++;
			}
			 
			var num=zeros+$(this).val();
			
			num=num.slice(neg);
			$(this).val(num);
			
			if ($.isNumeric($(this).val())==false) {
            $(this).val('');
			   $(this).focus();
			   alert(numeric_error);
			}
		 }
    });

    /* --------------------------------------------------------------------------------
     * Add the "data-numeric" attribute to an element to validate for numeric values only.
     * -------------------------------------------------------------------------------- */
    $("[data-numeric]").keyup(function(){
        if ($(this).val()!='') {
            if ($.isNumeric($(this).val())==false) {
               $(this).val('');
               $(this).focus();
               alert(numeric_error);
            }
		 }
   });

    /* --------------------------------------------------------------------------------
     * Add the "data-month" attribute to an element to determine if the field
     * contains a valid month value.
     * -------------------------------------------------------------------------------- */
    $("[data-month]").keyup(function(e){
        if(this.value.length=='2'){
            if ($.isNumeric($(this).val())==false) {
               if(e.which!='67'){
                  $(this).val('');
                  $(this).focus();
                  alert(month_error);
               }
            }else{
                if ($(this).val()>12 || $(this).val()<1){
                  $(this).val('');
                  $(this).focus();
                  alert(month_error);
                }
            }
        }
    });

    /* --------------------------------------------------------------------------------
     * Add the "data-day" attribute to an element to determine if the field
     * contains a valid day value.
     * -------------------------------------------------------------------------------- */
    $("[data-day]").keyup(function(e){
        if(this.value.length=='2'){
            if ($.isNumeric($(this).val())==false) {
               if(e.which!='67'){
                  $(this).val('');
                  $(this).focus();
                  alert(day_error);
               }
            }else{
                if ($(this).val()>31 || $(this).val()<1){
                  $(this).val('');
                  $(this).focus();
                  alert(day_error);
                }
            }
        }
    });

    /* --------------------------------------------------------------------------------
     * Add the "data-year" attribute to an element to determine if the field
     * contains a "reasonable" year value.
     * -------------------------------------------------------------------------------- */
    $("[data-year]").blur(function(e){
        if($(this).val()!=""){
            year = '0000'+$(this).val();
            year = year.slice(-4);
            year = year.toString();
             
            if(year.substr(0,2)=='00'){
                if (year>25) {
                    thisYear='19';
                }else{
                    var d = new Date();
                    thisYear= d.getFullYear();
                    thisYear = thisYear.toString();
                    thisYear = thisYear.substr(0,2);
                }
                 
                year = year.substr(2,2);
                year = thisYear+year;
            }
             
            $(this).val(year);
        }       
    });

    /* --------------------------------------------------------------------------------
     * Add the "data-hour" attribute to an element to determine if the field
     * contains a valid hour value.
     * -------------------------------------------------------------------------------- */
    $("[data-hour], [data-hours]").keyup(function(e){
        if($(this).val()!=""){
            if ($(this).val()>23 || $(this).val()<0) {
               $(this).val('');
               $(this).focus();
               alert(hour_error);
            }
        }   
    });
     
    /* --------------------------------------------------------------------------------
     * Add the "data-minute" attribute to an element to determine if the field
     * contains a valid minute value.
     * -------------------------------------------------------------------------------- */
    $("[data-minute], [data-minutes]").keyup(function(e){
        if($(this).val()!=""){
            if ($(this).val()>59 || $(this).val()<0) {
               $(this).val('');
               $(this).focus();
               alert(minute_error);
            }
        }       
    });

    /* --------------------------------------------------------------------------------
     * Typing the letter "C" into a date field will auto-populate the current date.
     * -------------------------------------------------------------------------------- */
    $("[data-month], [data-day], [data-year]").on('keyup',function(e){
        if(e.which=='67'){
            $(this).val('');
             
            //Get today's date.
            var today   = new Date();
            var day     = '0'+today.getDate();
            var month   = '0'+(today.getMonth()+1);
            var year    = today.getFullYear();
             
            //Format leading 0's.
            day     = day.slice(-2);
            month   = month.slice(-2);
			
            //Get the fieldname in order to populate the date values.
			var name=$(this).attr('name');
			if(name=='date_mo' || name=='date_day' || name=='date_yr'){
				fieldname='';
			}else{
				var fieldname=name.split('_date', 1)+'_';
			}
             
            //Populate the date values.
            $('input[name="'+fieldname+'date_mo"]').val(month);
            $('input[name='+fieldname+'date_day]').val(day);
            $('input[name='+fieldname+'date_yr]').val(year);
        }
    });

    /* --------------------------------------------------------------------------------
     * Typing the letter "C" into a time field will auto-populate the current time.
     * -------------------------------------------------------------------------------- */
    $("[data-hour], [data-hours], [data-minute], [data-minutes]").on('keyup',function(e){
        if(e.which=='67'){
            $(this).val('');
         
            var date=new Date();
            var hours=('0'+date.getHours()).slice(-2);
            var minutes=('0'+date.getMinutes()).slice(-2);
             
            var fieldname=$(this).attr('name').substring(0,$(this).attr('name').length-2);
             
            $("#"+fieldname+"hr").val(hours);
            $("#"+fieldname+"mn").val(minutes);
        }
    });

    /* --------------------------------------------------------------------------------
     * When an input field is focused, highlight all of the existing text in it automatically.
     * -------------------------------------------------------------------------------- */
    $("input[type=text]").focus(function() {
        $(this).select();
    });

    /* --------------------------------------------------------------------------------
     * Add the "data-autotab" attribute to an element to automatically tab to the next
     * field when the "maxlength" attribute is reached.  Maxlength attribute is required.
     * -------------------------------------------------------------------------------- */
    $("[data-autotab]").keyup(function(e) {
        //Ignore Shift + Tab and Arrow Keys
        if (e.which!='9' && e.which!='16' && e.which!='37' && e.which!='38' && e.which!='39' && e.which!='40') {
            if (this.getAttribute&&this.value.length==this.getAttribute("maxlength")){
                var inputs = $(this).closest('form').find(':input[type="text"]');
                inputs.eq( inputs.index(this)+ 1 ).focus();
            }
        }
    });
   
   /* --------------------------------------------------------------------------------
	 * Add the "data-confirm" attribute to an element to create a confirmation dialog.
	 * NOTE: The data-confirm attribute must contain a message!
	 * -------------------------------------------------------------------------------- */
   $("[data-confirm]").on("click",function(e){
	  e.preventDefault();
	  
	  var confirm_message	= $(this).attr('data-confirm');
	  var confirm_action	= $(this).attr('value').toLowerCase();
	  var confirm_form		= $(this).closest('form');
	  
	  if(typeof(confirm_message)!='undefined'){
		 if(confirm(confirm_message)==true){
			confirm_form.append($('<input>').attr('type','hidden').attr('name','action').val(confirm_action));
			confirm_form.submit();
		 }else{
			return false;
		 }
	  }
	  return false;
   });

   $("#all_employees").on("click", function(e){
        var all_employees = $(this).is(':checked');

        $('body .assigned_employees input[type=checkbox]').each(function() {
            // console.log('checkbox: ' + $(this).attr('id'));
            if (all_employees === true) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
   });
   
   $("#all_departments").on("click", function(e){
        var all_departments = $(this).is(':checked');

        $('body .assigned_departments input[type=checkbox]').each(function() {
            // console.log('checkbox: ' + $(this).attr('id'));
            if (all_departments === true) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
    });

    $("#all_systems").on("click", function(e){
        var all_systems = $(this).is(':checked');

        $('body .all_systems input[type=checkbox]').each(function() {
            // console.log('checkbox: ' + $(this).attr('id'));
            if (all_systems === true) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
    });

    // New tabs
    // Load tabs based on hash.  Tabs must be in the format <a href="specific-target-tab"></a>
    var hash = window.location.hash;
    if (hash != null && typeof(hash) != 'undefined' && hash != '') {
        $('.tab[data-target="' + hash.replace('#', '').replace('-tab', '') + '"]').addClass('is-active');
        $(hash.replace('-tab', '')).show();
    } else {
        $('.tab-init').addClass('is-active');
        $('.tab-panel-init').show();
    }
    
    // Tab clicks
    $('.tab').on('click', function() {
        $('.tab-panel').hide();
        $('.tab').removeClass('is-active');
        $(this).addClass('is-active');

        var target = $(this).data('target');
        $('#' + target).show();
    });

    

    // New modals
    $('[data-modal]').on('click', function() {
        console.log('modal click');
        var modal = $(this).data('modal');
        $('#' + modal).addClass('is-active');
    });

    $('.modal-close, .modal-background').on('click', function() {
        console.log('closing modal');
        var modal = $(this).data('modal');
        $('#' + modal).removeClass('is-active');
    });


   /* --------------------------------------------------------------------------------
	 * When a "remove" icon is hovered over, change to a success icon.
	 * -------------------------------------------------------------------------------- */
   $( ".glyphicon-remove" )
   .mouseover(function() {
	  $(this).removeClass('glyphicon-remove btn-danger');
	  $(this).addClass('glyphicon-ok btn-success');
   })
   .mouseout(function() {
	  $(this).removeClass('glyphicon-ok btn-success');
	  $(this).addClass('glyphicon-remove btn-danger');
   });

   if ($(".navbar-burger").on("click", function () { 
      $(".navbar-burger").hasClass("is-active") ? 
      ($(".navbar-burger").removeClass("is-active"), $(".navbar-menu").removeClass("is-active")) : 
      ($(".navbar-burger").addClass("is-active"), $(".navbar-menu").addClass("is-active"))
   }));

   $('#file-attachment').on('change', function() {
      if ($(this).files.length > 0) {
         $('#file-name').html($(this).files[0].name);
      }
   });

   // Used to display the file attachment name in the file attachment box
   var file = document.getElementById("file-attachment");
   if (file != null && typeof(file) != 'undefined') {
    file.onchange = function() {
        if(file.files.length > 0) {
            document.getElementById('file-name').innerHTML = file.files[0].name;
        }
    };
   }

});