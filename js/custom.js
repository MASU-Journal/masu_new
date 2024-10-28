$(document).ready(function() { 
    var rp_action = getUrlParameter('action');
    if(rp_action == 'reset-password'){
        //alert('2');
        var rp_token = getUrlParameter('token');
        if(rp_token !== undefined && rp_token !== '' && rp_token !== null){
            //alert('3');
            //$("reset_pass").model('show');
            $("#rp-token").val(rp_token);
            $("#trigger_rpd").click();
        }
    }
	/*notification load */
	$("#notification_count").hide();
	window.setInterval(function(){
		var role_id=$("#role_id").val();
		//alert(role_id);
		if(role_id!=undefined && role_id==1){
			
				$.ajax({
					type: 'post',
					url: 'backend.php',
					data: {
						admin_notification: "admin_notification"
					},
					dataType: "json",
					success: function(response) {
						if (response.message == "success") {
							if(response.new_notification_count>0){
							$("#notification_count").show();
							$("#notification_count").html(response.new_notification_count);
							}else{
								$("#notification_count").hide();
								$("#notification_count").html("");
							}
								$("#chief_command_notifications").html("");
							 $.each(response.notifications, function(key,val) {
										
										$("#chief_command_notifications").append("<li><div class='commenterImage'><img src='images/adv/header_icon.png' /></div><div class='commentText'><p><a href="+'view_comments.php?view=journal_commentview&journal_id='+val.journal_id+''+" target='_blank'><b>"+val.admin_name+"</b> Comment The Journal&nbsp<b>"+val.title+"</b>&nbsp</a><b></b></p><span class='date sub-text'>on&nbsp"+val.created_date+"</span></div></li>");
							});
						} else {
							$("#notification_count").hide();
							$("#notification_count").html("");
							$("#chief_command_notifications").html("<li><div class='commenterImage'>There is no Notifications</div></li>");
							return false;
						}
					}
				});
			}else{
				/** assign notification */
		$.ajax({
                type: 'post',
                url: 'backend.php',
                data: {
                    notification: "notification"
                },
                dataType: "json",
                success: function(response) {
					$("#notifications_ul").html("");
                    if (response.message == "success") {
						
							
						 $.each(response.notifications, function(key,val) {
									$("#notifications_ul").append("<li><div class='commenterImage'><img src='images/adv/header_icon.png' /></div><div class='commentText'><p><a href='javascript:void(0);'><b>Chief Editor</b> Assigned your <b>"+val.title+"</b>&nbspPaper to&nbsp</a><b>"+val.admin_cat_name+"</b></p><span class='date sub-text'>on&nbsp"+val.assigned_date+"</span></div></li>");
						});
                    } if (response.cmd_message == "success") {
						
							
						 $.each(response.cmd_notifications, function(key,val) {
									$("#notifications_ul").append("<li><div class='commenterImage'><img src='images/adv/header_icon.png' /></div><div class='commentText'><p><a href='javascript:void(0);'><b>"+val.admin_name+"</b> Command your <b>"+val.title+"</b>&nbspPaper </p><span class='date sub-text'>on&nbsp"+val.created_date+"</span></div></li>");
						});
                    }
					if(response.total_notification_count!=0){
					$("#notification_count").html(response.total_notification_count);
					}
					if(response.message!="success" || response.cmd_message!="success") {
                        $("#notification_count").html("");
						$("#notifications_ul").html("<li><div class='commenterImage'>There is no Notifications</div></li>");
                        return false;
                    }
                }
            });
			}
	}, 5000);
	$("#notification_checking_but").click(function(){
		
		$.ajax({
                type: 'post',
                url: 'backend.php',
                data: {
					notification_reset:"reset"
                },
                dataType: "json",
                success: function(response) {
                    if (response== "success") {
						$("#notification_count").html("");
                    }
                }
            });
	});
	$("#notificationLink").click(function(){
		$("#notificationContainer").fadeToggle(300);
		$("#notification_count").fadeOut("slow");
		$.ajax({
                type: 'post',
                url: 'backend.php',
                data: {
					admin_notification_reset:"reset"
                },
                dataType: "json",
                success: function(response) {
                    if (response== "success") {
						$("#notification_count").hide();
						$("#notification_count").html("");
                    }
                }
            });
		return false;
	});
	
	/*notification */
    $("#institutionregister").submit(function(e) {
        var instution_name = $("#reg_institution").val();
        var postal_add = $("#reg_postal").val();
        var email = $("#reg_email").val();
        var phone = $("#reg_contact").val();
        var year = $("#reg_year").val();
        var password_reg = $("#password_reg").val();
        var con_password = $("#con_password").val();
        $("#reg_institution").attr('placeholder', 'Register Institude');
        $("#reg_institution").attr('style', 'border:1px solid #fff;');
        $("#reg_postal").attr('placeholder', 'Postal Address');
        $("#reg_postal").attr('style', 'border:1px solid #fff;');
        $("#reg_email").attr('placeholder', 'Email');
        $("#reg_email").attr('style', 'border:1px solid #fff;');
        $("#reg_contact").attr('placeholder', 'Contact Number');
        $("#reg_contact").attr('style', 'border:1px solid #fff;');
        $("#reg_year").attr('placeholder', 'Year');
        $("#reg_year").attr('style', 'border:1px solid #fff;');
        $("#password_reg").attr('placeholder', 'Password');
        $("#password_reg").attr('style', 'border:1px solid #fff;');
        $("#con_password").attr('placeholder', 'Confirm Password');
        $("#con_password").attr('style', 'border:1px solid #fff;');
        var count = 0;
        if (instution_name == '' || instution_name == undefined) {
            $("#reg_institution").attr('placeholder', 'Please Enter Institude Name');
            $("#reg_institution").attr('style', 'border:1px solid red;');
            count++;
        }
        if (postal_add == '' || postal_add == undefined) {
            $("#reg_postal").attr('placeholder', 'Please Enter Posatl Address');
            $("#reg_postal").attr('style', 'border:1px solid red;');
            count++;
        }
        if (email == '' || email == undefined) {
            $("#reg_email").attr('placeholder', 'Please Enter Email');
            $("#reg_email").attr('style', 'border:1px solid red;');
            count++;
        }
        if (email.indexOf("@", 0) < 0) {
            $("#reg_email").attr('placeholder', 'Please Enter Valid Email');
            $("#reg_email").attr('style', 'border:1px solid red;');
            count++;
        }
        if (email.indexOf(".", 0) < 0) {
            $("#email").attr('placeholder', 'Please Enter Valid Email');
            $("#email").attr('style', 'border:1px solid red;');
            count++;
        }
        if (phone == "" || phone == undefined) {
            $("#reg_contact").attr('placeholder', 'Please Enter Contact Number');
            $("#reg_contact").attr('style', 'border:1px solid red;');
            count++;
        }
        if (phone != "" && (phone.length) < 10) {
            $("#reg_contact").attr('placeholder', 'Phone Number Should atlease 10 Digit');
            $("#reg_contact").attr('style', 'border:1px solid red;');
            count++;
        }
        if (year == '' || year == undefined) {
            $("#reg_year").attr('placeholder', 'Please Select Year');
            $("#reg_year").attr('style', 'border:1px solid red;');
            count++;
        }
        if (password_reg == '' || password_reg == undefined) {
            $("#password_reg").attr('placeholder', 'Please Enter Password');
            $("#password_reg").attr('style', 'border:1px solid red;');
            count++;
        }
        if (con_password == '' || con_password == undefined) {
            $("#con_password").attr('placeholder', 'Please Enter Confirm Password');
            $("#con_password").attr('style', 'border:1px solid red;');
            count++;
        }
        if (password_reg != "" && password_reg.length < 8) {
            $("#password_reg").attr('placeholder', 'Password should atleast 8 character in length...!!!!!!');
            $("#password_reg").attr('style', 'border:1px solid red;');
            count++;
        }
        if (password_reg != "" && con_password != "" && password_reg != con_password) {
            alert("Password Does't Match");
            count++;
        }
        if (count == 0) {
            $.ajax({
                type: 'post',
                url: 'do_login.php',
                data: {
                    do_register: "do_register",
                    category_id: '1',
                    type_id: '1',
                    instution_name: instution_name,
                    postal_add: postal_add,
                    email: email,
                    phone: phone,
                    year: year,
                    password: password_reg,
                },
                dataType: "json",
                success: function(response) {
                    if (response.result == "success") {
                        alert("You Have Registered Successfully !Please Login to Continue");
                        /*$('.modal').modal({
                            dismissible: true
                        });*/
                       $("#loginopener").click(); 
                        $("input, textarea").val("");
                    } else {
                        alert(response.result);
                        return false;
                    }
                }
            });
        }
        e.preventDefault();
    }); /*Editorial Board */
$(".date-filter-btn").click(function(e){
   $(".btn-df-selected").removeClass("btn-df-selected");
   $(this).addClass("btn-df-selected");
   var filter_class = $(this).attr("filter-class");
   $(".all-reviews").hide();
   $("."+filter_class).show();
});
$("#lfname").keypress(function(e){
	var value = $(this).val();
	if(value.length > 20){
		$(this).val(value.slice(0,-1));
	}
});
$("#lfemail").keypress(function(e){
	var value = $(this).val();
	if(value.length > 100){
		$(this).val(value.slice(0,-1));
	}
});
$("#lfphone").keypress(function(e){
	var value = $(this).val();
	if(value.length > 9){
		$(this).val(value.slice(0,-1));
	}
});
$("#lfcommunication").keypress(function(e){
	var value = $(this).val();
	if(value.length > 100){
		$(this).val(value.slice(0,-1));
	}
});
$("#lfpass").keypress(function(e){
	var value = $(this).val();
	if(value.length > 30){
		$(this).val(value.slice(0,-1));
	}
});
$("#lfconpass").keypress(function(e){
	var value = $(this).val();
	if(value.length > 30){
		$(this).val(value.slice(0,-1));
	}
});
$("#lfaddress").keypress(function(e){
	var value = $(this).val();
	if(value.length > 150){
		$(this).val(value.slice(0,-1));
	}
});


$("#loginform").submit(function(e) {
        var lfname = $("#lfname").val();
        var lfemail = $("#lfemail").val();
        var lfphone = $("#lfphone").val();
        var lfcommunication = $("#lfcommunication").val();
        var lfpass = $("#lfpass").val();
        var lfconpass = $("#lfconpass").val();
        var lfaddress = $("#lfaddress").val();
        var lfannual = $("#lfannual").val();
        $("#lfname").attr('placeholder', 'Enter Name');
        $("#lfname").attr('style', 'border:1px solid #fff;');

        $("#lfemail").attr('placeholder', 'Email ');
        $("#lfemail").attr('style', 'border:1px solid #fff;');

        $("#lfphone").attr('placeholder', 'Contact Number');
        $("#lfphone").attr('style', 'border:1px solid #fff;');

        $("#lfcommunication").attr('placeholder', 'Specialization');
        $("#lfcommunication").attr('style', 'border:1px solid #fff;');

        $("#lfpass").attr('placeholder', 'Password');
        $("#lfpass").attr('style', 'border:1px solid #fff;');

        $("#lfconpass").attr('placeholder', 'Confirm Password');
        $("#lfconpass").attr('style', 'border:1px solid #fff;');

        $("#lfaddress").attr('placeholder', 'Address');
        $("#lfaddress").attr('style', 'border:1px solid #fff;');

        $("#lfannual").attr('placeholder', 'Select Membership');
        $("#lfannual").attr('style', 'border:1px solid #fff;');

        var count = 0;
        if (lfname == '' || lfname == undefined) {
            $("#lfname").attr('placeholder', 'Please Enter Name');
            $("#lfname").attr('style', 'border:1px solid red;');
            count++;
        }

        //if (lfname != "" && lfname.length < 3 &&  lfname.length >50 ) {
           // $("#lfname").attr('placeholder', 'Password should atleast 4 and maximum 50 character in length...!!!!!!');
           // $("#lfname").attr('style', 'border:1px solid red;');
           // count++;
        //}
       
        if (lfemail == '' || lfemail == undefined) {
            $("#lfemail").attr('placeholder', 'Please Enter Email');
            $("#lfemail").attr('style', 'border:1px solid red;');
            count++;
        }
        if (lfemail.indexOf("@", 0) < 0) {
            $("#lfemail").attr('placeholder', 'Please Enter Valid Email');
            $("#lfemail").attr('style', 'border:1px solid red;');
            count++;
        }
        if (lfemail.indexOf(".", 0) < 0) {
            $("#lfemail").attr('placeholder', 'Please Enter Valid Email');
            $("#lfemail").attr('style', 'border:1px solid red;');
            count++;
        }
        if (lfphone == "" || lfphone == undefined) {
            $("#lfphone").attr('placeholder', 'Please Enter Contact Number');
            $("#lfphone").attr('style', 'border:1px solid red;');
            count++;
        }
        if (lfphone != "" && (lfphone.length) < 10) {
            $("#lfphone").attr('placeholder', 'Phone Number Should atlease 10 Digit');
            $("#lfphone").attr('style', 'border:1px solid red;');
            count++;
        }
       if (lfcommunication == '' || lfcommunication == undefined) {
            $("#lfcommunication").attr('placeholder', 'Please Enter Email');
            $("#lfcommunication").attr('style', 'border:1px solid red;');
            count++;
        }
        if (lfpass == '' || lfpass == undefined) {
            $("#lfpass").attr('placeholder', 'Please Enter Password');
            $("#lfpass").attr('style', 'border:1px solid red;');
            count++;
        }
        if (lfconpass == '' || lfconpass == undefined) {
            $("#lfconpass").attr('placeholder', 'Please Enter Confirm Password');
            $("#lfconpass").attr('style', 'border:1px solid red;');
            count++;
        }
        if (lfpass != "" && lfpass.length < 30) {
            $("#lfpass").attr('placeholder', 'Password should atleast minimum 4 and maximum 30 character in length...!!!!!!');
            $("#lfpass").attr('style', 'border:1px solid red;');
            count++;
        }
        if (lfpass != "" && lfconpass != "" && lfpass != lfconpass) {
            alert("Password Does't Match");
            count++;
        }
        if (lfaddress == '' || lfaddress == undefined) {
            $("#lfaddress").attr('placeholder', 'Please Enter Address');
            $("#lfaddress").attr('style', 'border:1px solid red;');
            count++;
        }
        if (lfannual == '' || lfannual == undefined) {
            $("#lfannual").attr('placeholder', 'Please  Select Membership');
            $("#lfannual").attr('style', 'border:1px solid red;');
            count++;
        }
        if (count == 0) {
            $.ajax({
                type: 'post',
                url: 'do_login.php',
                data: {
                    do_register: "do_register",
                    category_id: '1',
                    type_id: '1',
                    lfname: lfname,                   
                    lfemail: lfemail,                  
                    lfphone: lfphone,
                    lfcommunication: lfcommunication,
                   
                    password: lfpass,
                },
                dataType: "json",
                success: function(response) {
                    if (response.result == "success") {
                        alert("You Have Registered Successfully !Please Login to Continue");
                        /*$('.modal').modal({
                            dismissible: true
                        });*/
                       $("#loginopener").click(); 
                        $("input, textarea").val("");
                    } else {
                        alert(response.result);
                        return false;
                    }
                }
            });
        }
        e.preventDefault();
    }); /*Editorial Board */



//end
	$(".prevBtn").hide();
	 $(".prevBtn").click(function(e) {
		var current_tab_id=$('.tab-active').attr('id');
		current_tab_id=current_tab_id.replace('tab','');
		//salert(current_tab_id);
		Prev(current_tab_id);
	 });
	 
    $(".nextBtn").click(function(e) {
		var current_tab_for_next=$('.tab-active').attr('id');
		var count = 0;
		var fname = $("#life_edit_fname").val();
        var mname = $("#life_edit_mname").val();
        var lname = $("#life_edit_lname").val();
        var phone = $("#life_edit_phone").val();
        var dob = $("#life_edit_dob").val();
        var fax = $("#life_edit_fax").val();
        var password_reg = $("#password_reg").val();
        var con_password = $("#con_password").val();
        var web = $("#life_edit_web").val();
		var membership = $("input[name='membership']:checked").val();
		/*2nd tab */
		var email = $("#life_edit_mail").val();
        var address = $("#life_edit_add").val();
        var pos = $("#life_edit_pos").val();
        var pos_choos_cat = $("#life_edit_pos_choose_form").val();
        var country = $("#life_edit_country").val();
	
		/*3rt tab */
		var domain = $("#life_edit_domain").val();
		var field = $("#life_edit_field").val();
		var interest = $("#life_edit_interest").val();
		var special = $("#life_edit_specialize").val();
		var  keyword= $("#life_edit_keyword").val();
		
		/*4th ytab */
		var brife_words = $("#life_edit_briefwords").val();
	if(current_tab_for_next=="tab0"){
        
        $("#life_edit_fname").attr('placeholder', 'First Name');
        $("#life_edit_fname").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_edit_mname").attr('placeholder', 'Middle Name');
        $("#life_edit_mname").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_edit_lname").attr('placeholder', 'Last Name');
        $("#life_edit_lname").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_edit_phone").attr('placeholder', 'Contact Number');
        $("#life_edit_phone").attr('style', 'border-bottom:1px solid #9e9e9e;width: 348px;');
        $("#life_edit_dob").attr('placeholder', 'Date Of Birth');
        $("#life_edit_dob").attr('style', 'border-bottom:1px solid #9e9e9e;width: 348px;');
        $("#password_reg").attr('placeholder', 'Password');
        $("#password_reg").attr('style', 'border-bottom:1px solid #9e9e9e;width: 306px;');
        $("#con_password").attr('placeholder', 'Confirm Password');
        $("#con_password").attr('style', 'border-bottom:1px solid #9e9e9e;width: 348px;');
        
        if (fname == '' || fname == undefined) {
            $("#life_edit_fname").attr('placeholder', 'Enter First Name');
            $("#life_edit_fname").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (mname == '' || mname == undefined) {
            $("#life_edit_mname").attr('placeholder', 'Enter Middle Name');
            $("#life_edit_mname").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (lname == '' || lname == undefined) {
            $("#life_edit_lname").attr('placeholder', 'Last Name');
            $("#life_edit_lname").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (phone == "" || phone == undefined) {
            $("#life_edit_phone").attr('placeholder', 'Please Enter Contact Number');
            $("#life_edit_phone").attr('style', 'border-bottom:1px solid red;width: 348px;');
            count++;
        }
        if (phone != "" && (phone.length) < 10) {
            $("#life_edit_phone").attr('placeholder', 'Phone Number Should atlease 10 Digit');
            $("#life_edit_phone").attr('style', 'border-bottom:1px solid red;width: 348px;');
            count++;
        }
        if (dob == '' || dob == undefined) {
            $("#life_edit_dob").attr('placeholder', 'Please Select Date of Birth');
            $("#life_edit_dob").attr('style', 'border-bottom:1px solid red;width: 306px;');
            count++;
        }
        if (password_reg == '' || password_reg == undefined) {
            $("#password_reg").attr('placeholder', 'Please Enter Password');
            $("#password_reg").attr('style', 'border-bottom:1px solid red;width: 302px;');
            count++;
        }
        if (con_password == '' || con_password == undefined) {
            $("#con_password").attr('placeholder', 'Please Enter Confirm Password');
            $("#con_password").attr('style', 'border-bottom:1px solid red;width: 348px;');
            count++;
        }
        if (password_reg != "" && con_password != "" && password_reg != con_password) {
            alert("Password Does't Match");
            count++;
        }
        if (count == 0) {
            nextPrev(0);
        }
		
	}else if(current_tab_for_next=="tab1"){
		
        $("#life_edit_mail").attr('placeholder', 'Mail Id');
        $("#life_edit_mail").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_edit_add").attr('placeholder', 'Postal Address');
        $("#life_edit_add").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_edit_pos").attr('placeholder', 'Position');
        $("#life_edit_pos").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_edit_pos_choose_form").attr('placeholder', 'Affiliation/Employer');
        $("#life_edit_pos_choose_form").attr('style', 'border-bottom:1px solid #9e9e9e;');
		$("#life_edit_country").attr('placeholder', 'Country');
        $("#life_edit_country").attr('style', 'border-bottom:1px solid #9e9e9e;');
		if (email == '' || email == undefined) {
            $("#life_edit_mail").attr('placeholder', 'Please Enter Email');
            $("#life_edit_mail").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (email.indexOf("@", 0) < 0) {
            $("#life_edit_mail").attr('placeholder', 'Please Enter Valid Email');
            $("#life_edit_mail").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (address == "" || address == undefined) {
            $("#life_edit_add").attr('placeholder', 'Please Enter Address');
            $("#life_edit_add").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (pos == "" || pos == undefined) {
            $("#life_edit_pos").attr('placeholder', 'Please Enter Position');
            $("#life_edit_pos").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (pos_choos_cat == "" || pos == undefined) {
            $("#life_edit_pos_choose_form").attr('placeholder', 'Please Choose Position Option');
            $("#life_edit_pos_choose_form").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (country == "" || country == undefined) {
            $("#life_edit_country").attr('placeholder', 'Please Enter Country');
            $("#life_edit_country").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (count == 0) {
            nextPrev(1);
        }
	}else if(current_tab_for_next=="tab2"){
		
		$("#life_edit_domain").attr('placeholder', 'Domain');
        $("#life_edit_mail").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_edit_field").attr('placeholder', 'Field');
        $("#life_edit_field").attr('style', 'border-bottom:1px solid #9e9e9e;');
		if (domain == "" || domain == undefined) {
            $("#life_edit_domain").attr('placeholder', 'Please Enter Domain');
            $("#life_edit_domain").attr('style', 'border-bottom:1px solid red;');
            count++;
        }if (field == "" || field == undefined) {
            $("#life_edit_field").attr('placeholder', 'Please Enter Field');
            $("#life_edit_field").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (count == 0) {
            nextPrev(2);
        }
	}else if(current_tab_for_next=="tab3"){
		
	
		if (count == 0) {
            $.ajax({
                type: 'post',
                url: 'do_login.php',
                data: {
                    do_register: "do_register",
                    category_id:membership,
                    type_id:'1',
                    fname:fname,
                    mname:mname,
                    lname:lname,
                    phone:phone,
                    dob:dob,
                    fax:fax,
                    password_reg:password_reg,
                    web:web,
					email:email,
					address:address,
                    pos:pos,
					pos_choos_cat:pos_choos_cat,
					country:country,
					domain:domain,
					field:field,
					interest:interest,
					special:special,
					keyword:keyword,
					brife_words:brife_words
                },
                dataType: "json",
                success: function(response) {
                    if (response.result == "success") {
                        alert("You Have Registered Successfully !Please Login to Continue");
                       
                        $("#loginopener").click(); 
                        $("input, textarea").val("");
                    } else {
                        alert(response.result);
                        return false;
                    }
                }
            });
        }
	}
        e.preventDefault();
    }); /*Editorial Board */
	/*Student Board */
	 var fname; 
        var lname; 
        var email ;
        var stu_id ;
        var phone ;
        var age; 
        var gender; 
        var password_reg; 
        var con_password;
		var membership; 
		var address;
        var district; 
        var pincode;
        var state;
        var country; 
		var graduate;
		var coursel;
		var year;
	$(".stunextBtn").click(function(e) {
		var current_tab_for_next=$('.tab-active').attr('id');
		var count = 0;
	if(current_tab_for_next=="tab0"){
        fname = $("#life_stu_fname").val();
        lname = $("#life_stu_lname").val();
        email = $("#life_stu_mail").val();
        stu_id = $("#life_stu_id").val();
        phone = $("#life_stu_phone").val();
        age = $("#life_stu_age").val();
        gender = $("input[name='membership']:checked").val();
        password_reg = $("#password_reg").val();
        con_password = $("#con_password").val();
		membership = $("input[name='membership']:checked").val();
        $("#life_stu_fname").attr('placeholder', 'First Name');
        $("#life_stu_fname").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_stu_lname").attr('placeholder', 'Last Name');
        $("#life_stu_lname").attr('style', 'border-bottom:1px solid #9e9e9e;');
		$("#life_stu_id").attr('placeholder', 'ID');
        $("#life_stu_id").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_stu_phone").attr('placeholder', 'Contact Number');
        $("#life_stu_phone").attr('style', 'border-bottom:1px solid #9e9e9e;');
		$("#life_stu_mail").attr('placeholder', 'Mail ID');
        $("#life_stu_mail").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_stu_age").attr('placeholder', 'Age');
        $("#life_stu_age").attr('style', 'border-bottom:1px solid #9e9e9e;');
		//$("#life_stu_gender").attr('placeholder', 'Gender');
        //$("#life_stu_gender").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#password_reg").attr('placeholder', 'Password');
        $("#password_reg").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#con_password").attr('placeholder', 'Confirm Password');
        $("#con_password").attr('style', 'border-bottom:1px solid #9e9e9e;');
        
        if (fname == '' || fname == undefined) {
            $("#life_stu_fname").attr('placeholder', 'Enter First Name');
            $("#life_stu_fname").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (lname == '' || lname == undefined) {
            $("#life_stu_lname").attr('placeholder', 'Enter Last Name');
            $("#life_stu_lname").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (stu_id == '' || stu_id == undefined) {
            $("#life_stu_id").attr('placeholder', 'Enter ID');
            $("#life_stu_id").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (email == '' || email == undefined) {
            $("#life_stu_mail").attr('placeholder', 'Please Enter Email');
            $("#life_stu_mail").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (email.indexOf("@", 0) < 0) {
			
            $("#life_stu_mail").attr('placeholder', 'Please Enter Valid Email');
            $("#life_stu_mail").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (phone == "" || phone == undefined) {
            $("#life_stu_phone").attr('placeholder', 'Please Enter Contact Number');
            $("#life_stu_phone").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (phone != "" && (phone.length) < 10) {
            $("#life_stu_phone").attr('placeholder', 'Phone Number Should atlease 10 Digit');
            $("#life_stu_phone").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (age == '' || age == undefined) {
            $("#life_stu_age").attr('placeholder', 'Enter Age');
            $("#life_stu_age").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (password_reg == '' || password_reg == undefined) {
            $("#password_reg").attr('placeholder', 'Please Enter Password');
            $("#password_reg").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (con_password == '' || con_password == undefined) {
            $("#con_password").attr('placeholder', 'Please Enter Confirm Password');
            $("#con_password").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
        if (password_reg != "" && con_password != "" && password_reg != con_password) {
            alert("Password Does't Match");
            count++;
        }
		
        if (count == 0) {
			
            nextPrev(0);
        }
	}else if(current_tab_for_next=="tab1"){
		
        address = $("#life_stu_address").val();
        district = $("#life_stu_district").val();
        pincode = $("#life_stu_pincode").val();
        state = $("#life_stu_state").val();
        country = $("#life_stu_country").val();
        $("#life_stu_address").attr('placeholder', 'Address');
        $("#life_stu_address").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_stu_district").attr('placeholder', 'District');
        $("#life_stu_district").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_stu_pincode").attr('placeholder', 'Pincode');
        $("#life_stu_pincode").attr('style', 'border-bottom:1px solid #9e9e9e;');
        $("#life_stu_state").attr('placeholder', 'State');
        $("#life_stu_state").attr('style', 'border-bottom:1px solid #9e9e9e;');
		$("#life_stu_country").attr('placeholder', 'Country');
        $("#life_stu_country").attr('style', 'border-bottom:1px solid #9e9e9e;');
        if (address == "" || address == undefined) {
            $("#life_stu_address").attr('placeholder', 'Please Enter Address');
            $("#life_stu_address").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (district == "" || district == undefined) {
            $("#life_stu_district").attr('placeholder', 'Please Enter District');
            $("#life_stu_district").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (pincode == "" || pincode == undefined) {
            $("#life_stu_pincode").attr('placeholder', 'Please Enter Pincode');
            $("#life_stu_pincode").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (state == "" || state == undefined) {
            $("#life_stu_state").attr('placeholder', 'Please Enter State');
            $("#life_stu_state").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (country == "" || country == undefined) {
            $("#life_stu_country").attr('placeholder', 'Please Enter Country');
            $("#life_stu_country").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (count == 0) {
            nextPrev(1);
        }
	}else if(current_tab_for_next=="tab2"){
		graduate = $("input[name='graudation']:checked").val();
		course = $("#life_stu_course").val();
		year = $("#life_stu_year").val();
		if (course == "" || course == undefined) {
            $("#life_stu_course").attr('placeholder', 'Please Enter Discipline/Department/Specification');
            $("#life_stu_course").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (year == "" || year == undefined) {
            $("#life_stu_year").attr('placeholder', 'Please Enter Year');
            $("#life_stu_year").attr('style', 'border-bottom:1px solid red;');
            count++;
        }
		if (count == 0) {
            $.ajax({
                type: 'post',
                url: 'do_login.php',
                data: {
                    do_register: "do_register",
                    category_id: membership,
                    type_id: '2',
                    fname: fname,
                    lname: lname,
                    email: email,
                    stu_id: stu_id,
                    pincode: pincode,
                    phone: phone,
                    age: age,
                    gender: gender,
                    password_reg: password_reg,
					address:address,
                    district:district,
					pincode:pincode,
					state:state,
					country:country,
					graduate:graduate,
					course:course,
					year:year
                },
                dataType: "json",
                success: function(response) {
                    if (response.result == "success") {
                        alert("You Have Registered Successfully !Please Login to Continue");
                        $("#loginopener").click(); 
                        $("input, textarea").val("");
                    } else {
                        alert(response.result);
                        return false;
                    }
                }
            });
        }
	}
        e.preventDefault();
    }); 
	/* assign submit */
	$(".assign-submit").click(function(e) {
		var journal_assigner_to=$(this).attr('value');
		//alert(journal_assigner_to);
		//return false;
		var assigned_to_refree =$("#journal"+journal_assigner_to+"_assigner_to_refree").val();
		var assigned_to_tech =$("#journal"+journal_assigner_to+"_assigner_to_tech").val();
		var assigned_to_assoc =$("#journal"+journal_assigner_to+"_assigner_to_asso").val();
		var is_assigned=parseInt(assigned_to_refree+assigned_to_tech+assigned_to_assoc);
		//alert(assigned_to_refree);
		//alert(assigned_to_tech);
		//alert(assigned_to_assoc);
		//alert(is_assigned);
		//return false;
		if(is_assigned==0 || is_assigned==null || is_assigned==NaN ){
			alert('Please Select Reviewer');
			return false;
		}else{
			
			$("#journal_assign_form"+journal_assigner_to).submit();
		}
		e.preventDefault();
		//if(assigned_to)
	});
	$(".correct-submit").click(function(e) {
		var correct_journal_id=$(this).attr('value');
		if (confirm('Are You Sure')) {
			 $.ajax({
						type: 'post',
						url: 'backend.php',
						data: {
							correct_journal_id:correct_journal_id
						},
						dataType: "json",
						success: function(response) {
							if (response.result == "success") {   
								window.location.href = "chiefeditor.php";
							} else {
								window.location.href = "chiefeditor.php";
								return false;
							}
						}
					});
		}
	});
	$(".publish-submit").click(function(e) {
		var publish_journal_id=$(this).attr('value');
		if (confirm('Are You Sure')) {
			 $.ajax({
						type: 'post',
						url: 'backend.php',
						data: {
							publish_journal_id:publish_journal_id
						},
						dataType: "json",
						success: function(response) {
						    console.log(response);
						    return false;
							if (response.result == "success") {   
								window.location.href = "chiefeditor.php";
							} else {
								window.location.href = "chiefeditor.php";
								return false;
							}
						}
					});
		}
	});
	$(".reject").click(function(e) {
		var publish_journal_id=$(this).attr('value');
		if (confirm('Are You Sure Reject')) {
			 $.ajax({
						type: 'post',
						url: 'backend.php',
						data: {
							reject_journal_id:publish_journal_id,
							reject:'reject'
						},
						dataType: "json",
						success: function(response) {
							if (response.result == "success") {   
								window.location.href = "chiefeditor.php";
							} else {
								window.location.href = "chiefeditor.php";
								return false;
							}
						}
					});
		}
	});
	/* assign submit */
	/*Student Board */
    $("#btn_submit").click(function(e) {
        var count = 0;
        var login_mail = $('#ins_username').val();
        var pass = $('#ins_pass').val();
        if (login_mail == "") {
            $("#ins_username").attr('placeholder', 'Please Enter Username');
            $("#ins_username").attr('style', 'border:1px solid red;');
            count++;
        }
        if (pass == "") {
            $("#ins_pass").attr('placeholder', 'Please Enter Password');
            $("#ins_pass").attr('style', 'border:1px solid red;');
            count++;
        }
        if (login_mail != "" && pass != "") {
            if (!isEmail(login_mail)) {
                $("#ins_username").attr('placeholder', 'Please Enter Valid Mail');
                $("#ins_username").attr('style', 'border:1px solid red;');
                count++;
            }
            if (count == 0) {

                $.ajax({
                    type: 'post',
                    url: 'do_login.php',
                    data: {
                        do_login: "do_login",
                        email: login_mail,
                        password: pass
                    },
                    dataType: "json",
                    success: function(response) {                        
						console.log(response);
                        if (response.result == "success") {
                            //alert("Login Successfully ");
							if(response.category_id==1){
                            window.location.href = "db-Institutionprofile.php";
							}else if((response.category_id==2 || response.category_id==3) && response.type_id==1){
								window.location.href = "db-editorialprofile.php";
							}else if((response.category_id==2 || response.category_id==3) && response.type_id==2){
								window.location.href = "db-profile.php";
							}
                        } else {
                            alert("Username Or Passwosrd is incorrect");
                            return false;
                        }
                    }
                });
            }
        }
	 e.preventDefault();
    }); /*my scripts */
	/*add new command */
	
	$("#add_command_but").click(function(){
		$("#comments").attr('style', 'border-bottom:1px solid #9e9e9e;');
		if($("#comments").val()!=""){
			$("#comment_form").submit();
			
		}else{
			$("#comments").attr('style', 'border-bottom:1px solid red;');
			return false;
		}
		
	});
		
	$("#select_add_command_but").click(function(){
		alert('');
		$("#select_command_form").submit();
		
	});
	$("#correction_send_to_author").click(function(){
		var enable_command_journal_id=$("#journal_id").val();
	if (confirm('Corrections Will Send to Author')) {                 
        //Ok button pressed...  
	 $.ajax({
                    type: 'post',
                    url: 'backend.php',
                    data: {
                        do_enable_command: "do_command_enabled",
                        journal_id: enable_command_journal_id
                        
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.result == "success") {
                            alert("Correction Send Successfully");
                        } else {
                            alert(response.result);
                            return false;
                        }
                    }
                });
			}
	});
	$("#ad-fp-button").click(function(e){
	   $("#fp-from-admin").val('1');
	});
	$("#form_reset_password").submit(function(e){
	    e.preventDefault();
	    var password = $("#rp-password").val();
	    var cpassword = $("#rp-cpassword").val();
	    var rp_token = $("#rp-token").val();
	    //alert(rp_token);exit;
	    if(cpassword != password){
	        $(".rp-alert-box").css("background-color", "red");
         	$("#rp-alert-content").html("Sorry..Passwords doesnot match");
         	return false;
	    }
	    if(password.length < 8){
	        $(".rp-alert-box").css("background-color", "red");
         	$("#rp-alert-content").html("Sorry..Password should have minimum 8 characters ");
         	return false;
	    }
	    $(".loader-mask").css("display","block");
	    $.ajax({
                    type: 'post',
                    url: 'forgot_password.php',
                    data: {
                        rp_token: rp_token,
                        password : password,
                        action : 'reset-password'
                    },
                    dataType: "text",
                    success: function(response) {
                        //alert(response);
                        if (response == "0") {
                            $(".rp-alert-box").css("background-color", "red");
         					$("#rp-alert-content").html("Sorry..invalid Request!");
                        } else if(response == "1") {
                            $(".rp-alert-box").css("background-color", "red");
         					$("#rp-alert-content").html("Sorry.. Token expired!");
                        } else if(response == "2"){
                            $(".rp-alert-box").css("background-color", "green");
         					$("#rp-alert-content").html("Password updated successfully!");
                        } else {
                            $(".rp-alert-box").css("background-color", "red");
         					$("#rp-alert-content").html("Something is not right !");
                        }
                        hideLoader();
                        setTimeout(function(){ $(".rp-alert-box").hide();$(".pop-close").click(); }, 5000);
                        
                    }
                });
                hideLoader();
	    return false;
	});
	
	$("#form_forgot_password").submit(function(e){
	    e.preventDefault();
	    //showLoader();
	    var email = $("#fp-email").val();
	    var from_admin = $("#fp-from-admin").val();
	    if(email == undefined || email == '' || email ==null){
	        $(".fp-alert-box").css("background-color", "red");
         	$("#fp-alert-content").html("Please provide the registered Email ID");
			setTimeout(function(){ $(".fp-alert-box").hide(); }, 3000);
			return false;
	    } else if(!isEmail(email)){
	        $(".fp-alert-box").css("background-color", "red");
         	$("#fp-alert-content").html("Please provide a valid Email ID");
			setTimeout(function(){ $(".fp-alert-box").hide(); }, 3000);
			return false;
	    }
	    $(".loader-mask").css("display","block");
	    $.ajax({
                    type: 'post',
                    url: 'forgot_password.php',
                    data: {
                        email: email,
                        from_admin : from_admin
                    },
                    dataType: "text",
                    success: function(response) {
                        if (response == "0") {
                            $(".fp-alert-box").css("background-color", "red");
         					$("#fp-alert-content").html("Sorry..Please enter an valid email address");
                        } else if(response == "1") {
                            $(".fp-alert-box").css("background-color", "red");
         					$("#fp-alert-content").html("Sorry.. The email is not available!");
                        } else if(response == "2"){
                            $(".fp-alert-box").css("background-color", "green");
         					$("#fp-alert-content").html("Email sent to the given email ID.. Please check!");
                        } else {
                            $(".fp-alert-box").css("background-color", "red");
         					$("#fp-alert-content").html("Something is not right !");
                        }
                        hideLoader();
                        setTimeout(function(){ $(".fp-alert-box").hide();$(".pop-close").click(); }, 5000);
                        
                    }
                });
                hideLoader();
	    return false;
	});
	
	/*add new command */
	
	$("#admin_btn_submit").click(function(e) {
        var count = 0;
        var login_mail = $('#adminname').val();
        var pass = $('#adminpass').val();
        var role_val = $('#adminlogin').val();
        if (login_mail == "") {
            $("#adminname").attr('placeholder', 'Please Enter Username');
            $("#adminname").attr('style', 'border:1px solid red;');
            count++;
        }
        if (pass == "") {
            $("#adminpass").attr('placeholder', 'Please Enter Password');
            $("#adminpass").attr('style', 'border:1px solid red;');
            count++;
        }
        if (login_mail != "" && pass != "") {
            /*if (!isEmail(login_mail)) {
                $("#adminname").attr('placeholder', 'Please Enter Username');
                $("#adminname").attr('style', 'border:1px solid red;');
                count++;
            }*/
            if (count == 0) {
                $.ajax({
                    type: 'post',
                    url: 'do_login.php',
                    data: {
                        do_login: "do_login",
                        email: login_mail,
                        password: pass,
						role_val:role_val
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.result == "success") {
                            //alert("Login Successfully");
							if(response.role_id==1){
                            window.location.href = "chiefeditor.php";
							}else if(response.role_id==2 ){
								window.location.href = "reviewer.php";
							}else if(response.role_id==4 ){
                                window.location.href = "aPanel.php";
                            }
                        } else {
                            alert("Username Or Passwosrd is incorrect");
                            return false;
                        }
                    }
                });
            }
        }
	 e.preventDefault();
    }); /*admin my scripts */
	$("#sign_out").click(function(e) {
		var user_id=$("#signout_user").val();
                $.ajax({
                    type: 'post',
                    url: 'do_login.php',
                    data: {
                        signout: "do_login",
						user_id:user_id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.result == "success") {
                          location.href='index.php';
							
                        } else {
                            alert("Please Try One More! Some thing Went Wrong");
                            return false;
                        }
                    }
                });
	 e.preventDefault();
    });
	$("#resubmit_check1").click(function () {
	
            if ($(this).is(":checked")) {
                $("#resub_file").hide();
                $("#resub_select").hide();
               
               
            } else {
                $("#resub_file").show();
                $("#resub_select").show();
              
            }
	});			
		//$("#resubmit_check").click(function () {
	
          //  if ($(this).is(":checked")) {
             //   $("#resub_file").show();
              //  $("#resub_select").show();
             //   $("#resub_img").hide();
               // $("#resub_title").hide();
              //  $("#resub_sub").hide();
              //  $("#resub_artticle").hide();
              //  $("#resub_detail").hide();
               
           // } else {
               // $("#resub_file").show();
              //  $("#resub_select").hide();
               // $("#resub_img").show();
              //  $("#resub_detail").show();
			  //  $("#resub_title").show();
              //  $("#resub_sub").show();
               // $("#resub_artticle").show();
               
          //  }
//	});//
//edit profiles
	$(".edit_field").hide();
	$("#edit_stu_save").hide();
	$("#edit_stu_cancel").hide();

	$('#edit_stu_edit').click(function(){
	  $('#edit_stu_edit').hide();
	  $(".edit_td").hide();
	 $(".edit_field").show();
	  
	  $('#edit_stu_save').show();
	  $('#edit_stu_cancel').show();
	  $('.info').fadeIn('fast');
	});
	$('#edit_stu_cancel').click(function(){
	  $('#edit_stu_save, .info').hide();
		 $(".edit_td").show();
		 $('#edit_stu_edit').show();
		$(".edit_field").hide();
		$('#edit_stu_cancel').hide();
	  $('#edit').show(); 
	});
	$('#edit_stu_save').click(function(e){
			var count=0;
			var fname = $("#edit_stu_name").val();
		  // = $("#life_stu_lname").val();
		   var email = $("#edit_stu_mail").val();
			var stu_id = $("#edit_stu_id").val();
			var phone = $("#edit_stu_contact").val();
			var age = $("#edit_stu_age").val();
			var address = $("#edit_stu_address").val();
			$("#edit_stu_name").attr('placeholder', 'First Name');
			$("#edit_stu_name").attr('style', 'border-bottom:1px solid #9e9e9e;');
			$("#edit_stu_mail").attr('placeholder', 'Mail ID');
			$("#edit_stu_mail").attr('style', 'border-bottom:1px solid #9e9e9e;');
			$("#edit_stu_id").attr('placeholder', 'Student ID');
			$("#edit_stu_id").attr('style', 'border-bottom:1px solid #9e9e9e;');
			$("#edit_stu_age").attr('placeholder', 'Age');
			$("#edit_stu_age").attr('style', 'border-bottom:1px solid #9e9e9e;');
			$("#edit_stu_address").attr('placeholder', 'Address');
			$("#edit_stu_address").attr('style', 'border-bottom:1px solid #9e9e9e;');
			if (fname == '' || fname == undefined) {
				$("#edit_stu_name").attr('placeholder', 'Enter First Name');
				$("#edit_stu_name").attr('style', 'border-bottom:1px solid red;');
				count++;
			}
			if (stu_id == '' || stu_id == undefined) {
				$("#edit_stu_id").attr('placeholder', 'Enter ID');
				$("#edit_stu_id").attr('style', 'border-bottom:1px solid red;');
				count++;
			}
			if (email == '' || email == undefined) {
				$("#edit_stu_mail").attr('placeholder', 'Please Enter Email');
				$("#edit_stu_mail").attr('style', 'border-bottom:1px solid red;');
				count++;
			}
			if (email.indexOf("@", 0) < 0) {
				
				$("#edit_stu_mail").attr('placeholder', 'Please Enter Valid Email');
				$("#edit_stu_mail").attr('style', 'border-bottom:1px solid red;');
				count++;
			}
			if (phone == "" || phone == undefined) {
				$("#life_stu_phone").attr('placeholder', 'Please Enter Contact Number');
				$("#life_stu_phone").attr('style', 'border-bottom:1px solid red;');
				count++;
			}
			if (phone != "" && (phone.length) < 10) {
				$("#edit_stu_contact").attr('placeholder', 'Phone Number Should atlease 10 Digit');
				$("#edit_stu_contact").attr('style', 'border-bottom:1px solid red;');
				count++;
			}
			if (age == '' || age == undefined) {
				$("#edit_stu_age").attr('placeholder', 'Please Enter Age');
				$("#edit_stu_age").attr('style', 'border-bottom:1px solid red;');
				count++;
			}
			if (address == '' || address == undefined) {
				$("#edit_stu_address").attr('placeholder', 'Please Enter Address');
				$("#edit_stu_address").attr('style', 'border-bottom:1px solid red;');
				count++;
			}
			if(count==0){
					$("#student_edit_form").submit();
					$('#edit_stu_save, .info').hide();
					$(".edit_td").show();
					$('#edit_stu_cancel').hide();
					$('#edit_stu_edit').show();
					$(".edit_field").hide();
			} else {
				e.preventDefault();
			}
			
		
	});
	/* Jounal Form */

	$("#journal_img").on("change", function(e) {
	  if (this.files && this.files[0] && this.files[0].name.match(/\.(jpg|jpeg|png|gif)$/) ) {
		  if(this.files[0].size>1048576) {
						alert('Image size is larger than 1MB!');
		  }
	  }else{
		  alert("Your Image is Invalid Format");
		  $("#journal_img").val('');
	  }
	});
	$("#journal_file").on("change", function(e) {
	  if (this.files && this.files[0] && this.files[0].name.match(/\.(css|doc|docx|pdf|latex)$/) ) {
		  if(this.files[0].size>2097152) {
						alert('Journal size is larger than 2MB!');
						 $("#journal_file").val('');
		  }
	  }else{
		  alert("Your Journal is Invalid Format");
		  $("#journal_file").val('');
	  }
	});
	//Document Click
	$(document).click(function(){
		$("#notificationContainer").hide();
	});
    //Popup Click
	$("#notificationContainer").click(function() {
		return false;
	});
    $(".resub").click(function(e){
		alert('');
		e.preventDefault();
	});
});
function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};
function isEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}
var currentTab = 0;
showTab(currentTab); // Display the crurrent tab
function showTab(n) {
  // This function will display the specified tab of the form...
  var x = $(".tab");
  var tab_pos=n;
  $("#tab"+tab_pos+"").attr('style','display:block;');
  
  if(!$("#tab"+tab_pos+"").hasClass('tab-active')){
	 
	 $("#tab"+tab_pos+"").addClass('tab-active');
 }
 // x[n].addClass(".tab-active");
  //... and fix the Previous/Next buttons:
  if (n == 0) {
	  $(".prevBtn").hide();
  } else {
	  $(".prevBtn").show();
  }
  if (n == (x.length - 1)) {
    $(".nextBtn").html("Submit");
    $(".stunextBtn").html("Submit");
  } else {
    $(".nextBtn").html("Next");
	$(".stunextBtn").html("Next");
  }
  //... and run a function that will display the correct step indicator:
}

function nextPrev(n) {
	//alert('');
	currentTab=0;
  // This function will figure out which tab to display
  var x = $(".tab");
  // Exit the function if any field in the current tab is invalid:
  //if (n == 1 ) return false;
  // Hide the current tab:
 $("#tab"+n+"").attr('style','display:none;');
 if($("#tab"+n+"").hasClass('tab-active')){
	 
	 $("#tab"+n+"").removeClass('tab-active');
 }
  // Increase or decrease the current tab by 1:
  
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
  //  document.getElementById("lifememeditform").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab+1);
}
function Prev(n) {
	//alert('');
  // This function will figure out which tab to display
  var x = $(".tab");
  // Exit the function if any field in the current tab is invalid:
  //if (n == 1 ) return false;
  // Hide the current tab:
 $("#tab"+n+"").attr('style','display:none;');
 if($("#tab"+n+"").hasClass('tab-active')){
	 
	 $("#tab"+n+"").removeClass('tab-active');
 }
  // Increase or decrease the current tab by 1:
  
  var precurrentTab = n-1;
  //alert(precurrentTab+'currenttsb');
  // if you have reached the end of the form...
  if (precurrentTab >= x.length) {
    // ... the form gets submitted:
   // document.getElementById("lifememeditform").submit();
    return false;
  }
  // Otherwise, display the correct tab:
 
  showTab(precurrentTab);
}
function showTabprev(n) {
  // This function will display the specified tab of the form...
  var x = $(".tab");
  var tab_pos=n-1;
  $("#tab"+tab_pos+"").attr('style','display:none;');
  
  if(!$("#tab"+tab_pos+"").hasClass('tab-active')){
	 
	 $("#tab"+tab_pos+"").removeClass('tab-active');
 }
 // x[n].addClass(".tab-active");
  //... and fix the Previous/Next buttons:
 showTab(tab_pos);
}

function openCity(evt, cityName) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById(cityName).style.display = "block";
	evt.currentTarget.className += " active";
	var jour_id=$("#this_journal_id").val();
	$("#journal"+jour_id+"_assigner_to_refree").val(0);
	$("#journal"+jour_id+"_assigner_to_tech").val(0);
	$("#journal"+jour_id+"_assigner_to_asso").val(0);
}

function showLoader(){
    $(".loader-mask").css("display","block");
}
function hideLoader(){
    $(".loader-mask").css("display","none");
}
     $(document).ready(function() {
         $("#lfsubmit").click(function(e) {
         
         var count=0;
         var lfname = $("#lfname").val();
         //var lflastname = $("#lflastname").val();
         var lfaddress = $("#lfaddress").val();
         var lfcommunication = $("#lfcommunication").val();
         var lfemail = $("#lfemail").val();
         var lfphone = $("#lfphone").val();
         var lfpass = $("#lfpass").val();
         var lfconpass = $("#lfconpass").val();
         var lfannual = $("#lfannual").val();
       
         if (lfname == '' || lfaddress == '' || lfcommunication == '' || lfemail == '' || lfphone == '' || lfpass == '' || lfconpass == '' || lfannual == '') {
         alert("Please fill all fields...!!!!!!");
         count++;
         } else {
			 if ((lfpass.length) < 8) {
			 alert("Password should atleast 8 character in length...!!!!!!");
			 count++;
			 } 
			  if ((lfphone.length) < 10) {
			 alert("Phone number should  10 numbers in length...!!!!!!");
			 count++;
			 } 
			if(!isEmail(lfemail)){
					alert("Please Enter Valid Email Address");
					count++;
					
			}
			if(lfpass != lfconpass){
				alert("Password Doesn't Match");
				count++;
			}
		 }
		 
         if(count==0) {
         $(".loader-mask").css("display","block");
         $.ajax({
         				  type:'post',
         				  url:'do_login.php',
         				  data:{
         				   lf_register:"lf_register",
         				   lfname:lfname,
         				   //lflastname:lflastname,
         				   lfaddress:lfaddress,
         				   lfcommunication:lfcommunication,
         				   lfemail:lfemail,
						   lfphone:lfphone,
						   lfpass: lfpass,
						   lfannual :lfannual
         				  },
         				  dataType: "json",
         				  success:function(response) {
         				  if(response.result=="success")
         				  {
         					//alert(" Registered Successfully");
         					hideLoader();
         					$(".pop-close").click();
         					$("#loginopener").click();
         					$(".alert-box").css("background-color", "green");
         					$("#alert-content").html("Registered Successfully.! Please continue to login..");
							setTimeout(function(){ $(".alert-box").hide(); }, 3000);
         				  }
         				  else
         				  {
         					alert(response.result);
         					hideLoader();
         					return false;
         				  }
         				  }
         			  });
         }
         //hideLoader();
		 e.preventDefault();
         });
         });