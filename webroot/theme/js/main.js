$(function () {
    //BEGIN MENU SIDEBAR
    $('#sidebar').css('min-height', '100%');
    $('#side-menu').metisMenu();
    $('.datetimepicker-date').datetimepicker({
        pickTime: false
    });
    $('.datetimepicker-time').datetimepicker({
        pickDate: false
    });
	
	$('.datepicker').datepicker();
	
	$('#category-type').change(function(){
		var categoryType =  $('#category-type').val();
		$.ajax({
			url: baseUrl+"announcements/get-list",
			type: "post",
			dataType : 'json',
			data: {categoryType:categoryType} ,
            success : function(json, textStatus) {
				$('#related-id').find('option').remove().end().append("<option value='' selected='selected'>Please Select</option>").val('');
				$.each(json, function(i, value) {
					$('#related-id').append($('<option>').text(value).attr('value', value));
				});
            },
            error : function(xhr, textStatus, errorThrown) {
                alert('An error occurred! ' + errorThrown);
            }
		});
	});
	
	$('#report_type').change(function(){
		var reportType =  $(this).val();
		$.ajax({
			url: baseUrl+"announcements/reportType",
			type: "post",
			dataType : 'json',
			data: {reportType:reportType} ,
            success : function(json, textStatus) {
				$('#event-company-name').find('option').remove().end().append("<option value='' selected='selected'>Please Select</option>").val('');
				$.each(json, function(i, value) {
					$('#event-company-name').append($('<option>').text(value).attr('value', value));
				});
            },
            error : function(xhr, textStatus, errorThrown) {
                alert('An error occurred! ' + errorThrown);
            }
		});
	});

	$("input").on("ifChecked", function(){
		var eventType =  $(this).val();
		if(eventType == 'AGM' || eventType == 'EGM' ){
			$('#report-type').val(eventType);
			$.ajax({
				url: baseUrl+"events/get-company",
				type: "post",
				dataType : 'json',
				data: {eventType:eventType} ,
				success : function(json, textStatus) {
					$('#event-company-name').find('option').remove().end().append("<option value='' selected='selected'>Please Select</option>").val('');
					$.each(json, function(i, value) {
						$('#event-company-name').append($('<option>').text(value).attr('value', value));
					});
				},
				error : function(xhr, textStatus, errorThrown) {
					alert('An error occurred! ' + errorThrown);
				}
			});
		}else if(eventType == 'downloaded_report' || eventType == 'readed_report'  || eventType == 'downloads_of_users_report'  || eventType == 'list_of_users_report'   || eventType == 'rsvp'  || eventType == 'user_logins'  || eventType == 'verfied_users'  || eventType == 'active_users' ){
			if(eventType == 'rsvp'){
				$('.jsevent').show();
			}
			if(eventType == 'downloads_of_users_report' || eventType == 'list_of_users_report'){
				$('.report').show();
				var eventType = 'AGM';
				$.ajax({
					url: baseUrl+"events/get-company",
					type: "post",
					dataType : 'json',
					data: {eventType:eventType} ,
					success : function(json, textStatus) {
						$('#event-company-name').find('option').remove().end().append("<option value='' selected='selected'>Please Select</option>").val('');
						$.each(json, function(i, value) {
							$('#event-company-name').append($('<option>').text(value).attr('value', value));
						});
						$('#event-company-name').append('<input type="hidden"  value="AGM" name="report_type" class="form-control "  id="report-type" />');
					},
					error : function(xhr, textStatus, errorThrown) {
						alert('An error occurred! ' + errorThrown);
					}
				});				
			}
			if(eventType == 'downloaded_report' || eventType == 'readed_report'){
				$('.report').show();
				var eventType = 'EGM';
				$.ajax({
					url: baseUrl+"events/get-company",
					type: "post",
					dataType : 'json',
					data: {eventType:eventType} ,
					success : function(json, textStatus) {
						$('#event-company-name').find('option').remove().end().append("<option value='' selected='selected'>Please Select</option>").val('');
						$.each(json, function(i, value) {
							$('#event-company-name').append($('<option>').text(value).attr('value', value));
						});
						$('#event-company-name').append('<input type="hidden"  value="EGM" name="report_type" class="form-control "  id="report-type" />');
					},
					error : function(xhr, textStatus, errorThrown) {
						alert('An error occurred! ' + errorThrown);
					}
				});	
			}
		}
	});
	$("input").on("ifUnchecked", function(){
			$('.jsevent').hide();
			$('.report').hide();
	});
	
	$("#event-company-name").on("change", function(){
		var eventType =  $('#report-type').val();
		var companyName =  $(this).val();		
		$.ajax({
			url: baseUrl+"events/get-year",
			type: "post",
			dataType : 'json',
			data: {eventType:eventType, company_name:companyName} ,
            success : function(json, textStatus) {
				$('#eventyear').find('option').remove().end().append("<option value='' selected='selected'>Please Select</option>").val('');
				$.each(json, function(i, value) {
					$('#eventyear').append($('<option>').text(value).attr('value', value));
				});
            },
            error : function(xhr, textStatus, errorThrown) {
                alert('An error occurred! ' + errorThrown);
            }
		});
	});
	
	$("#report-company-name").on("change", function(){
		var companyName =  $(this).val();		
		$.ajax({
			url: baseUrl+"events/get-report-year",
			type: "post",
			dataType : 'json',
			data: {companyName:companyName} ,
            success : function(json, textStatus) {
				$('#reportyear').find('option').remove().end().append("<option value='' selected='selected'>Please Select</option>").val('');
				$.each(json, function(i, value) {
					$('#reportyear').append($('<option>').text(value).attr('value', value));
				});
            },
            error : function(xhr, textStatus, errorThrown) {
                alert('An error occurred! ' + errorThrown);
            }
		});
	});
	
	$("#reportyear").on("change", function(){
		var companyName =  $('#report-company-name').val();		
		var year =  $(this).val();
		$.ajax({
			url: baseUrl+"events/get-report-events",
			type: "post",
			dataType : 'json',
			data: {companyName:companyName,year:year} ,
            success : function(json, textStatus) {
				$('#eventslist').find('option').remove().end().append("<option value='' selected='selected'>Please Select</option>").val('');
				$.each(json, function(i, value) {
					$('#eventslist').append($('<option>').text(value).attr('value', i));
				});
            },
            error : function(xhr, textStatus, errorThrown) {
                alert('An error occurred! ' + errorThrown);
            }
		});
	});
	
	$("#eventyear").on("change", function(){
		var eventType =  $('#report-type').val();
		var companyName =  $('#event-company-name').val();
		var year =  $('#eventyear').val();
		$.ajax({
			url: baseUrl+"events/get-reports",
			type: "post",
			dataType : 'json',
			data: {eventType:eventType, company_name:companyName,year:year} ,
            success : function(json, textStatus) {
				$('#report-id').find('option').remove().end().append("<option value='' selected='selected'>Please Select</option>").val('');
				$.each(json, function(i, value) {
					$('#report-id').append($('<option>').text(value).attr('value', i));
				});
            },
            error : function(xhr, textStatus, errorThrown) {
                alert('An error occurred! ' + errorThrown);
            }
		});
	});
	
	
	$('.datepickermonth').datepicker( {
		format: "yyyy",
		viewMode: "years", 
		minViewMode: "years"
	});
    $(window).bind("load resize", function () {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse');
        } else {
            $('div.sidebar-collapse').removeClass('collapse');
            $('div.sidebar-collapse').css('height', 'auto');
        }
        if($('body').hasClass('sidebar-icons')){
            $('#menu-toggle').hide();
        } else{
            $('#menu-toggle').show();
        }
    });
    //END MENU SIDEBAR

    //BEGIN TOPBAR DROPDOWN
    $('.dropdown-slimscroll').slimScroll({
        "height": '250px',
        "wheelStep": 5
    });
    //END TOPBAR DROPDOWN

    //BEGIN CHECKBOX & RADIO
	if(typeof $.fn.iCheck !== 'undefined'){
		if($('#demo-checkbox-radio').length <= 0){
			$('input[type="checkbox"]:not(".switch")').iCheck({
				checkboxClass: 'icheckbox_minimal-grey',
				increaseArea: '20%' // optional
			});
			$('input[type="radio"]:not(".switch")').iCheck({
				radioClass: 'iradio_minimal-grey',
				increaseArea: '20%' // optional
			});
		}
	}
    //END CHECKBOX & RADIO

    //BEGIN TOOTLIP
    $("[data-toggle='tooltip'], [data-hover='tooltip']").tooltip();
    //END TOOLTIP

    //BEGIN POPOVER
    $("[data-toggle='popover'], [data-hover='popover']").popover();
    //END POPOVER


    //BEGIN PORTLET
    $(".portlet").each(function(index, element) {
        var me = $(this);
        $(">.portlet-header>.tools>i", me).click(function(e){
            if($(this).hasClass('fa-chevron-up')){
                $(">.portlet-body", me).slideUp('fast');
                $(this).removeClass('fa-chevron-up').addClass('fa-chevron-down');
            }
            else if($(this).hasClass('fa-chevron-down')){
                $(">.portlet-body", me).slideDown('fast');
                $(this).removeClass('fa-chevron-down').addClass('fa-chevron-up');
            }
            else if($(this).hasClass('fa-cog')){
                //Show modal
            }
            else if($(this).hasClass('fa-refresh')){
                //$(">.portlet-body", me).hide();
                $(">.portlet-body", me).addClass('wait');

                setTimeout(function(){
                    //$(">.portlet-body>div", me).show();
                    $(">.portlet-body", me).removeClass('wait');
                }, 1000);
            }
            else if($(this).hasClass('fa-times')){
                me.remove();
            }
        });
    });
    //END PORTLET

    //BEGIN BACK TO TOP
    $(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
            $('#totop') .fadeOut();
        } else {
            $('#totop') .fadeIn();
        }
    });
    $('#totop').on('click', function(){
        $('html, body').animate({scrollTop:0}, 'fast');
        return false;
    });
    //END BACK TO TOP

    //BEGIN CHECKBOX TABLE
	if(typeof $.fn.iCheck !== 'undefined'){
		$('.checkall').on('ifChecked ifUnchecked', function(event) {
			if (event.type == 'ifChecked') {
				$(this).closest('table').find('input[type=checkbox]').iCheck('check');
			} else {
				$(this).closest('table').find('input[type=checkbox]').iCheck('uncheck');
			}
		});
	}
    //END CHECKBOX TABLE

    //BEGIN JQUERY NEWS UPDATE
    $('#news-update').ticker({
        controls: false,
        titleText: ''
    });
    //END JQUERY NEWS UPDATE

    $('.option-demo').hover(function() {
        $(this).append("<div class='demo-layout animated fadeInUp'><i class='fa fa-magic mrs'></i>Demo</div>");
    }, function() {
        $('.demo-layout').remove();
    });
    $('#header-topbar-page .demo-layout').live('click', function() {
        var HtmlOption = $(this).parent().detach();
        $('#header-topbar-option-demo').html(HtmlOption).addClass('animated flash').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).removeClass('animated flash');
        });
        $('#header-topbar-option-demo').find('.demo-layout').remove();
        return false;
    });
    $('#title-breadcrumb-page .demo-layout').live('click', function() {
        var HtmlOption = $(this).parent().html();
        $('#title-breadcrumb-option-demo').html(HtmlOption).addClass('animated flash').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).removeClass('animated flash');
        });
        $('#title-breadcrumb-option-demo').find('.demo-layout').remove();
        return false;
    });
    // CALL FUNCTION RESPONSIVE TABS
    fakewaffle.responsiveTabs(['xs', 'sm']);

});