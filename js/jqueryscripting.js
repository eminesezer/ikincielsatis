var cikisYapFunc=function(){
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "api/cikisyap.php",
		success: function (data) {
			if(data.error==false){
				window.location.href="login.html";
			}
			else {
				alert(data.message);
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			alert(jqXHR.status);
			alert(textStatus);
			alert(errorThrown);
		}
	});
};
var checkHome=function(){
	var url="http://trmyrobot.com/ikinciel/homepage.html";
	var checker=window.location.href;
	if(url==checker){}
	else{
		window.location.href="login.html";
	}
}
LoadNavBar=function(){
	var level;
	$.ajax({
		type:"GET",
		dataType:"json",
		url:"api/getlevel.php",
		success:function(data){
			if(data.error==false){
				level=data.level;
				var veri = JSON.stringify({ "level": level });
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "api/getpages.php",
					data: veri,
					success: function (data) {
						if(data.error==false){
							$("#navbarlist li").remove();
							for(var i = 0; i < data.message.length; i++){
								$("#navbarlist").append("<li class=\"navbarlist_li\"><a class=\"navbar_call\" href=\"" + data.message[i].navlink + "\">" + data.message[i].navitem + "</a></li>");
							}
						}
						else {
							alert(data.message);
						}
					}
				});
				if(level>1){
					$.ajax({
						type: "POST",
						dataType: "json",
						url: "api/getfromsession.php",
						success: function (data) {
							if(data.error==false&&data.checker==true){
								$("#navbarlist").append("<li class=\"navbarlist_li dropdown\" style=\"float:right\"><a class=\"active\" id=\"userinfo\" href=\"profile.html\">"+data.message+"</a><div class=\"dropdown-content\"><a id=\"cikisyap\" href=\"login.html\">Çıkış Yap</a></div></li>");
							}
							else if(data.error==true&&data.checker==false) {
								checkHome();
							}
							else {alert(data.message);}
						}
					});
				}
				else {
					checkHome();
				}
			}
			else {
				alert(data.message);
			}
		}
	});
	
};
var fillcountity=function(){
	var data=JSON.stringify({"City":city});
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "api/getcountity.php",
			data: data,
			success: function (data) {
				if(!data.error){
					$("#register_countity option").remove();
					if (data.message.length > 0){
						for (var i = 0; i < data.message.length; i++){
							if(i==0){
								$("#register_countity").append("<option selected>"+data.message[i]+"</option>");
								countity=data.message[i];}
							else {
							$("#register_countity").append("<option>"+data.message[i]+"</option>");}
						}
						$("#register_countity").change(function(){
							$("#register_countity option:selected").each(function(){
								countity=$(this).text();
							});
						});
					}
					else {
						$("#register_countity").append("<option>Herhangi Bir Seçenek Bulunamadı...</option>");
					}
				}
				else{
					alert(data.message);
				}
			},
			error: function (jqXHR, exception) {
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				alert(msg);
			}
		});
	};
var fillcity=function(){
	var data =JSON.stringify({"Country":country});
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "api/getcity.php",
		data: data,
		success: function (data) {
			countity="";
			if(!data.error){	
				$("#register_cities option").remove();
				if (data.message.length > 0){
					for (var i = 0; i < data.message.length; i++){
						if(i==0){
							$("#register_cities").append("<option selected>"+data.message[i]+"</option>");
							city=data.message[i];
						}
						else {
						$("#register_cities").append("<option>"+data.message[i]+"</option>");}
					}
					if(data.message.length==1){fillcountity();}
					$("#register_cities").change(function(){
						$("#register_cities option:selected").each(function(){
							city=$(this).text();
							fillcountity();
						});
					});
				}
				else {
					$("#register_cities").append("<option>Herhangi Bir Seçenek Bulunamadı...</option>");
				}
			}
			else{
				alert(data.message);
			}
		}
	});
};
var fillcountry=function(){
	var data=JSON.stringify({"Country":1});
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "api/getcountry.php",
		data: data,
		success: function (data) {
			city="";
			countity="";
			if(!data.error){
				$("#register_country option").remove();
				if (data.message.length > 0){
					for (var i = 0; i < data.message.length; i++){
						if(i==0){
							$("#register_country").append("<option selected>"+data.message[i]+"</option>");
							country=data.message[i];
						}
						else {
							$("#register_country").append("<option>"+data.message[i]+"</option>");
						}
					}
					$("#register_cities option").remove();
					$("#register_cities").append("<option disabled=\"disabled\" SELECTED>Lütfen Bir Ülke Seçin</option>");
					$("#register_countity option").remove();
					$("#register_countity").append("<option disabled=\"disabled\" SELECTED>Lütfen Bir Ülke Seçin</option>");
					if(data.message.length==1){fillcity();}
					$("#register_country").change(function(){
						$("#register_country option:selected").each(function(){
							country=$(this).text();
							$("#register_countity option").remove();
							$("#register_cities option").remove();
							fillcity();
						});
					});
				}
			}
			else{
				alert(data.message);
			}
		},
		error: function (jqXHR, exception) {
			var msg = '';
			if (jqXHR.status === 0) {
				msg = 'Not connect.\n Verify Network.';
			} else if (jqXHR.status == 404) {
				msg = 'Requested page not found. [404]';
			} else if (jqXHR.status == 500) {
				msg = 'Internal Server Error [500].';
			} else if (exception === 'parsererror') {
				msg = 'Requested JSON parse failed.';
			} else if (exception === 'timeout') {
				msg = 'Time out error.';
			} else if (exception === 'abort') {
				msg = 'Ajax request aborted.';
			} else {
				msg = 'Uncaught Error.\n' + jqXHR.responseText;
			}
			alert(msg);
		}
	});	
};
var questionfiller=function(){
	question="";
	var data=JSON.stringify({"reason":"send"});
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "api/getquestion.php",
		data: data,
		success: function (data) {
			if(!data.error){
				$("#register_securityquestion option").remove();
				if (data.message.length > 0){
					for (var i = 0; i < data.message.length; i++){
						$("#register_securityquestion").append("<option>"+data.message[i]+"</option>");
					}
				}
			}
			else {
				alert(data.message);
			}
		}
	});
};
var formfiller=function(){
	var date = new Date($("#register_birthday").val());
	name=$("#register_name").val();	
	lastname=$("#register_lastname").val();	
	phone=$("#register_phone").val();	
	email=$("#register_email").val();
	address=$("#register_address").val();	
	postcode=$("#register_postcode").val();		
	answer=$("#register_secureanswer").val();	
	if(isNaN(date)){
		alert("Doğum Tarihi Boş Olmamalı...");
	}
	else if(pass!=password){
		alert("Şifreler eşleşmiyor...");
	}
	else if(question==""||question=="Bir soru seçiniz"){
		alert("Lütfen bir soru seçiniz...");
	}
	else if(name==""||lastname==""||phone==""||email==""||address==""||postcode==""||answer==""){
		alert("Lütfen boş alan bırakmayınız...");
	}
	else if(checker!=1){
		alert("Bu kullanıcı adı kullanımda...");
	}
	else {
		day = date.getDate();
		month = date.getMonth() + 1;
		year = date.getFullYear();
		birthday=[day, month, year].join('.');
		formlab=1;					
	}
};
var ProfileFiller=function(){
	var level;
	$.ajax({
		type:"GET",
		dataType:"json",
		url:"api/getlevel.php",
		success:function(data){
			if(data.error==false){
				level=data.level;
				if(level>0){
					var data = JSON.stringify({ "profile": level});
					$.ajax({
						type: "POST",
						dataType: "json",
						url: "api/getuserinfo.php",
						data: data,
						success: function (data) {
							if(data.error==false){
								$("#register_name").val(data.message.name);
								$("#register_lastname").val(data.message.lastname);
								$("#register_username").val(data.message.address);
								$("#register_phone").val(data.message.phone);
								$("#register_address").val(data.message.address);
								$("#register_cities").val(data.message.city);
								$("#register_countity").val(data.message.countity);
								$("#register_postcode").val(data.message.postcode);
								$("#register_securityquestion").val(data.message.question);
								$("#register_secureanswer").val(data.message.answer);
								$("#profile_img").attr("src",data.message.profile);
							}
							else{
								alert(data.message);
								window.location.href="login.html";
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {
							alert(jqXHR.status);
							alert(textStatus);
							alert(errorThrown);
						}
					});
				}
				else{
					alert("Bir hatayla karşılaşıldı. Lütfen sayfayı yenilemeyi deneyin.");
				}
			}
			else {
				alert(data.message);
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			alert(jqXHR.status);
			alert(textStatus);
			alert(errorThrown);
		}
	});
};
var ProductFiller=function(){
	$.ajax({
		type: "GET",
		dataType: "json",
		url: "api/getproducts.php",
		success: function (data) {
			if(data.error==false){
				$("#products").empty();
				if (data.message.length > 0){
					for (var i = 0; i < data.message.length; i++){
						$("#products").append("<div class=\"responsive\"><a class=\"call_product\" href=\""+data.message[i].productid+"\"><div class=\"gallery\"><img src=\""+
						data.message[i].image+"\" alt=\"Resim Yüklenemedi...\" width=\"100%\" ><div class=\"desc\">"+data.message[i].name+"</div><div class=\"desc\">"+data.message[i].price+"</div></div></a></div>");
					}
					$(".call_product").click(function () {
						productid = $(this).attr("href");
						var data = JSON.stringify({ "productid": productid});
						$.ajax({
							type: "POST",
							dataType: "json",
							url: "api/getproduct.php",
							data: data,
							success: function (data) {
								if(data.error==false){
									window.location.href=data.message;
								}
								else {alert(data.message);}
							}
						});
						$('.call_robot').attr('style', 'background-color: white !important');
						$(this).attr('style', 'background-color: rgba(82, 168, 236, 0.8) !important');
						return false;
					});
				}
				else{
				alert("Gösterilecek ürün yok.!");}
			}
			else {alert(data.message);}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			alert(jqXHR.status);
			alert(textStatus);
			alert(errorThrown);
		}
	});
};
		
var myProducts=function(){
	$.ajax({
		type: "GET",
		dataType: "json",
		url: "api/getmyproducts.php",
		success: function (data) {
			if (data.error == false) {
				$("#myproducts_table tr:not(:first)").remove();
				if((data.message).length>0){
					for(var i=0;i<data.message.length;i++){
						$("#myproducts_table").append("<tr><td class=\"myproduct_id\">" + data.message[i].productid +"</td><td class=\"product_img\"><img class=\"myproduct_images\" src=\""+data.message[i].image+"/></td><td class=\"myproduct_info\">" + data.message[i].info + "</td><td class=\"myproduct_note\">" +data.message[i].note+"</td><td class=\"myproduct_price\">"+data.message[i].price+"</td></tr>");//refresh yapılabilir burada
					}
			
					$("#myproducts_table tr").click(function(){
						var selected = $(this).hasClass("headerrow");
							if (selected)
								return;
						$(".highlight").removeClass("highlight");
						$(this).addClass("highlight");
						$("#myproducts_table tr > *:nth-child(1)").hide();
						productid = $(".myproduct_id", this).html();
						var data=JSON.stringify({"id":productid});
						$.ajax({
							type: "GET",
							dataType: "json",
							url: "api/showmyproduct.php",
							data:data,
							success: function (data) {
								if(data.error==false){
									window.location.href=data.message;
								}
								else {
									alert(data.message);
								}
							}
						});
					});
				}
			}
			else{
				alert(data.message);
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			alert(jqXHR.status);
			alert(textStatus);
			alert(errorThrown);
		}
	});	 
};

var fillusers=function(){
	$.ajax({
		type: "GET",
		dataType: "json",
		url: "api/getallusers.php",
		success:function (data) {
			if (data.error == false) {
				$("#users_table tr:not(:first)").remove();
				if((data.message).length>0){
					for(var i=0;i<data.message.length;i++){
						$("#users_table").append("<tr><td class=\"user_id_\">" + data.message[i].id +"</td><td class=\"user_name_\">"+data.message[i].name+"</td><td class=\"user_lastname_\">" + data.message[i].lastname + "</td><td class=\"user_username_\">" +data.message[i].username+"</td><td class=\"user_email_\">"+data.message[i].email+"</td><td class=\"user_urunsayisi_\">"+data.message[i].urunsayisi+"</td></tr>");//refresh yapılabilir burada
					}
					$("#users_table tr").click(function(){
						var selected = $(this).hasClass("headerrow");
							if (selected)
								return;
						$(".highlight").removeClass("highlight");
						$(this).addClass("highlight");
						$("#users_table tr > *:nth-child(1)").hide();
					});
				}
			}
			else{
				alert(data.message);
			}
		},
		error: function (jqXHR, exception) {
			var msg = '';
			if (jqXHR.status === 0) {
				msg = 'Not connect.\n Verify Network.';
			} else if (jqXHR.status == 404) {
				msg = 'Requested page not found. [404]';
			} else if (jqXHR.status == 500) {
				msg = 'Internal Server Error [500].';
			} else if (exception === 'parsererror') {
				msg = 'Requested JSON parse failed.';
			} else if (exception === 'timeout') {
				msg = 'Time out error.';
			} else if (exception === 'abort') {
				msg = 'Ajax request aborted.';
			} else {
				msg = 'Uncaught Error.\n' + jqXHR.responseText;
			}
			alert(msg);
		}
	});	
};
