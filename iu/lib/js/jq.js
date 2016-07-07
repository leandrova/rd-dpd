
function msnGeral(msg) {
	$.prompt(msg);
}
function msnConfirm(msg) {
	$.prompt(msg,{ buttons: { Confirmar: true, Cancelar: false }, focus:1,submit:function(v,m) { if (v) { alert(v + '=' + m) } } });
}
function msnLateral(msg){
	$.jGrowl(msg, { header: 'Aten&ccedil;&atilde;o', sticky: true });
}

jQuery(document).ready(function(){

	/* Filtro Tabelas */
	if ($('table#filterTable1')) { $('table#filterTable1').columnFilters({alternateRowClassNames:['rowa','rowb']}); }
	
	/* breadCrumb */
	jQuery("#breadCrumb0").jBreadCrumb();

	/* Limita o Textarea*/
	if ($("textarea[maxlength]")){
		$("textarea[maxlength]").keypress(function(event){
			var key = event.which;
			if(key >= 33 || key == 13) {
				var maxLength = $(this).attr("maxlength");
				var length = this.value.length;
				if(length >= maxLength) {
					event.preventDefault();
				}
			}
		});
	}
	/* Calendario */
	if ($('#data0')){
		$('#data0').focus(function(){
			$(this).calendario({ 
				target:'#data0',
				top:-50,
				left:80
			});
		});
	}
	/**/
	if ($('#data1')){
		$('#data1').focus(function(){
			$(this).calendario({ 
				target:'#data1',
				top:-50,
				left:80
			});
		});
	}
	/**/
	if ($('#data2')){
		$('#data2').focus(function(){
			$(this).calendario({ 
				target:'#data2',
				top:-50,
				left:80
			});
		});
	}
	/**/
	if ($('#data3')){
		$('#data3').focus(function(){
			$(this).calendario({ 
				target:'#data3',
				top:-50,
				left:80
			});
		});
	}
	/* Formata Valor */	
	if ($("#data0"))	{ $("#data0").mask("99/99/9999");	}
	if ($("#data1"))	{ $("#data1").mask("99/99/9999");	}
	if ($("#valor0"))	{ $("#valor0").maskMoney({symbol:"R$",decimal:",",thousands:"."})	}
	if ($("#valor1"))	{ $("#valor1").maskMoney({symbol:"R$",decimal:",",thousands:"."})	}	
})
