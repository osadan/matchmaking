	var sItem = function (key,value){this.key=key;this.value=value;}
		var countComboAttr = 1;
		var countTextSearch = 1;
		var countAddress = 1;
		var conf = function (){};
		var flow = {"id":"flow","options":[new sItem("hasid","חסידי"),new sItem("litai","ליטאי"),new sItem("sfarady","ספרדי"),new sItem("datyleumi","דתי-לאומי"),new sItem("charadlnic","חרדלניק"),new sItem("shiduchHachyTov","חוזר בתשובה"),new sItem("other","אחר")]};
		var bird = {"id":"bird","options":[new sItem("long","ארוך"),new sItem("short","קצר"),new sItem("shaved","מגולח"),new sItem("neat","מסודר"),new sItem("moustache","שפם"),new sItem("nobird","ללא"),new sItem("other","אחר")]};
		var hat = {"id":"hat","options":[ new sItem("hasidy","חסידי"),new sItem("jerushalmy","ירושלמי"),new sItem("kneych","קנייץ"),new sItem("nohat","ללא כובע"),new sItem("other","אחר")]};
		var suit = {"id":"suit","options" : [new sItem("long","ארוך"),new sItem("short","קצר"),new sItem("chalet","חאלט"),new sItem("jerusjalmy","ירושלמי"),new sItem("nosuit","ללא חליפה"),new sItem("other","אחר")]};
		var sideburns = {"id":"sideburns" ,"options":[new sItem( "short","קצרות"),new sItem("long","ארוכות"),new sItem("wavy","מסולסלות"),new sItem("afterEar","אחרי האוזן"),new sItem("nosideburns","ללא פאות"),new sItem("other","אחר")]};
		var selectAttr = {"id":"comboAttr","options":[new sItem("flow","זרם"),new sItem("bird","זקן"),new sItem("hat","כובע"),new sItem("suit","חליפה"),new sItem("sideburns","פאות")]};
		var selectDetails = {"id":"comboDetails","options":[new sItem("firstName","שם פרטי"),new sItem("lastName","שם משפחה"),new sItem("tid","מספר ת.ז"),new sItem("dorYesharim","דור ישרים"),new sItem("fatherName","שם האב"),new sItem("fatherJob","מקצוע אבא"),new sItem("fatherWork","מקום עבודה/כולל"),new sItem("motherName","שם האם"),new sItem("motherLastName","שם משפחה אמא לפני "),new sItem("motherJob","אמא עבודה"),new sItem("sibiling","מס אחים"),new sItem("origin","קהילה")]};
		var selectAddress = {"id":"comboAddress","options":[new sItem("street","רחוב"),new sItem("neighborhood","שכונה"),new sItem("city","עיר"),new sItem("country","ארץ"),new sItem("phone","טלפון"),new sItem("cellPhone","פלאפון"),new sItem("email","אימייל")]};
		/*
			add new attribute select box 
		*/
		function addAttrCombo(el)
		{
			countComboAttr = countComboAttr + 1;
			var str = moreCombo();
			var val = $(el).attr("id").replace(/[\D]*/,"");
			$(el).after("<div style='clear:both;height:1px;'></div>" + str);
			$(el).css("display","none");
			$(el).prev("a.minus").show();
			$(".selAttr").bind("change",function(event){
					comboSelect(this.value,this.id);
			});
		}
		/*
			add new details select box(The input is added only after the select box is selected
		*/         
		function addDetailsCombo(el,type)
		{
			countTextSearch = countTextSearch + 1;
			var str = moreDetails();
			$(el).after("<div style='clear:both;height:1px;'></div>" + str);
			$(el).css("display","none");
			$(el).prev("a.minus").show();
			$(".setDetails").bind("change",function(event){
					textSelect(this.id,type);
			});
		}
		function deleteDetailsRow(el,name)
		{
			$("#" + name).val('disabled').hide();
			try{
				$("#" + name.replace("comboD","inputD")).val("").hide();
				var temp = name.replace("combo","cond") ; 
				$("#" + temp).hide();
			}catch(e){
				//doNothing
			}
			$(el).hide();
		}
		function deleteAttrRow(el,name)
		{
			$("#" + name).val("disabled").hide();
			try{
			$("#" + name.replace("Attr","Value")).hide();
			$("#" + name.replace("combo","cond")).hide();
			}catch(e){
				//do nothing
			}
			$(el).hide();
		}
		/*
			add an attribute select box 
		*/
		function getCond(type,index)
		{
			var arr = new Array();
			arr.push("<select id='cond" + type + index +"' name='cond" + type + index +"'>");
		 	arr.push("<option value='default'></option><option value='or'>או</option><option value='and'>וגם</option></select>");
			return arr.join("");
		}
		function moreCombo()
		{
			var id = selectAttr.id + countComboAttr; 
			arr = new Array();
			if (countComboAttr < 2){
			 	arr.push("<div style='height:20px;'><label for='" + id +  "'>תיאור חיצוני:</label></div>");
			 	//arr.push("<br />");
			 }else{
			 	arr.push(getCond("Attr",countComboAttr));
			 }
		 	//arr.push("<select id='condAttr" + countComboAttr +"' name='condAttr" + countComboAttr +"'>");
		 	//arr.push("<option value='or'>או</option><option value='and'>וגם</option></select>");
			arr.push("<select class='selAttr' id='" + id + "' name='" + id + "'>" );
			arr.push("<option value='disabled'></option>");
			for (i = 0,num = selectAttr.options.length;i< num;i++)
			{
				arr.push("<option value='" + selectAttr.options[i].key + "'>" + selectAttr.options[i].value + "</option>");
			}
			arr.push("</select>");
			arr.push("<select class='selValue' name='comboValueAttr"  + countComboAttr + "' id='comboValue"  + countComboAttr + "'></select>" );			
			arr.push("<a class='minus' href='javascript:void(0);' onClick='deleteAttrRow(this,\"" + id + "\")' style='display:none;'>-</a>");
			arr.push("<a class='plus' href='javascript:void(0);' onClick='addAttrCombo(this);'>+</a>");
			return arr.join("");
		}
		/*
			add an details/street select box - using a configuration object  
		*/
		function moreDetails()
		{
			var id = selectDetails.id + countTextSearch;
			var arr = new Array();
			if(countTextSearch < 2){
				arr.push("<div style='height:20px'><label for='" + id + "' >פרטים כללים:</label></div>")
			}else{
			 arr.push(getCond("Details",countTextSearch));
			 }
			//arr.push("<select id='condDetails" + countTextSearch + "' name='condDetails" + countTextSearch + "'>");
			//arr.push("<option value='or'>או</option><option value='and'>וגם</option></select>");
			arr.push("<select class='setDetails' id='" + id + "' name='" + id + "'>");
			arr.push("<option value='disabled'></option>");
			for(i=0,num = selectDetails.options.length;i<num;i++)
			{
				arr.push("<option value='" + selectDetails.options[i].key + "'>" + selectDetails.options[i].value + "</options>");
			}
			arr.push("</select>");
			arr.push("<a class='minus' href='javascript:void(0);' onClick='deleteDetailsRow(this,\"" + id + "\")' style='display:none;'>-</a>");//
;			arr.push("<a class='plus' href='javascript:void(0);' onClick='addDetailsCombo(this,\"Details\");'>+</a>");
			return arr.join("");
		}
		/*
			make a new attribute combo while reciving the object in the function signiture
		*/
		function comboSelect(value,name)
		{
			var obj = eval(value); 
			var arr = new Array();
			if( obj){
				for (i  = 0,num = obj.options.length;i< num;i++)
				{
					arr.push("<option value='" + obj.options[i].key + "'>" + obj.options[i].value + "</option>" );
				}
			}
			var id = name.replace("Attr","Value");
			$("#" + id ).html(arr.join(""));
		}
		/*
			add a text input after the combo is selected /details and street
			
		*/
		function textSelect(name,type){
			var index = name.replace(/[\D]*/ig,""); //leaves only the digits
			var inputname ="input" + type + index; 
			if($("#" + inputname).index() < 0){//the input is not exist
				var input = "<input type='text' value='' name='" + inputname + "' id='" + inputname + "' class='inputSearch'/>";
				$("#" + name).after(input);	
			}else{
				$("#" + inputname).val("");
			}
			$("#" + inputname).focus();
		}
		$(document).ready(function(){
			$(".selAttr").change(function (event){
				comboSelect(this.value,this.id);
			});
			$(".setDetails").change(function(event){
				textSelect(this.id,"Details");
			});
		});
		