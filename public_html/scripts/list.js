	var sItem = function (key,value){this.key=key;this.value=value;}
		var countComboAttr = 1;
		var countTextSearch = 1;
		var countAddress = 1;
		var conf = function (){};
		var flow = {"id":"flow","options":[new sItem("hasid","�����"),new sItem("litai","�����"),new sItem("sfarady","�����"),new sItem("datyleumi","���-�����"),new sItem("charadlnic","�������"),new sItem("shiduchHachyTov","���� ������"),new sItem("other","���")]};
		var bird = {"id":"bird","options":[new sItem("long","����"),new sItem("short","���"),new sItem("shaved","�����"),new sItem("neat","�����"),new sItem("moustache","���"),new sItem("nobird","���"),new sItem("other","���")]};
		var hat = {"id":"hat","options":[ new sItem("hasidy","�����"),new sItem("jerushalmy","�������"),new sItem("kneych","�����"),new sItem("nohat","��� ����"),new sItem("other","���")]};
		var suit = {"id":"suit","options" : [new sItem("long","����"),new sItem("short","���"),new sItem("chalet","����"),new sItem("jerusjalmy","�������"),new sItem("nosuit","��� �����"),new sItem("other","���")]};
		var sideburns = {"id":"sideburns" ,"options":[new sItem( "short","�����"),new sItem("long","������"),new sItem("wavy","��������"),new sItem("afterEar","���� �����"),new sItem("nosideburns","��� ����"),new sItem("other","���")]};
		var selectAttr = {"id":"comboAttr","options":[new sItem("flow","���"),new sItem("bird","���"),new sItem("hat","����"),new sItem("suit","�����"),new sItem("sideburns","����")]};
		var selectDetails = {"id":"comboDetails","options":[new sItem("firstName","�� ����"),new sItem("lastName","�� �����"),new sItem("tid","���� �.�"),new sItem("dorYesharim","��� �����"),new sItem("fatherName","�� ���"),new sItem("fatherJob","����� ���"),new sItem("fatherWork","���� �����/����"),new sItem("motherName","�� ���"),new sItem("motherLastName","�� ����� ��� ���� "),new sItem("motherJob","��� �����"),new sItem("sibiling","�� ����"),new sItem("origin","�����")]};
		var selectAddress = {"id":"comboAddress","options":[new sItem("street","����"),new sItem("neighborhood","�����"),new sItem("city","���"),new sItem("country","���"),new sItem("phone","�����"),new sItem("cellPhone","������"),new sItem("email","������")]};
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
		 	arr.push("<option value='default'></option><option value='or'>��</option><option value='and'>���</option></select>");
			return arr.join("");
		}
		function moreCombo()
		{
			var id = selectAttr.id + countComboAttr; 
			arr = new Array();
			if (countComboAttr < 2){
			 	arr.push("<div style='height:20px;'><label for='" + id +  "'>����� ������:</label></div>");
			 	//arr.push("<br />");
			 }else{
			 	arr.push(getCond("Attr",countComboAttr));
			 }
		 	//arr.push("<select id='condAttr" + countComboAttr +"' name='condAttr" + countComboAttr +"'>");
		 	//arr.push("<option value='or'>��</option><option value='and'>���</option></select>");
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
				arr.push("<div style='height:20px'><label for='" + id + "' >����� �����:</label></div>")
			}else{
			 arr.push(getCond("Details",countTextSearch));
			 }
			//arr.push("<select id='condDetails" + countTextSearch + "' name='condDetails" + countTextSearch + "'>");
			//arr.push("<option value='or'>��</option><option value='and'>���</option></select>");
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
		