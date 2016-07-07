function executar(valor,form) {
	document.aplicacao.evento.value=valor;
	document.forms[form].submit();	
}
function obj(s) {
	return document.getElementById(obj);
}

function initTimer() {
	// O metodo nativo setInterval executa uma determinada funcao em um determinado tempo  
	setInterval(showTimer,1000);
}

function imprimirDIV(div) {
	var conteudo;
	conteudo = "<HTML><HEAD><title>Janela de Impressão</title>";
	conteudo = conteudo + "<LINK rel='stylesheet' type='text/css' href='./iu/lib/css/style_p.css' media='screen'>";
	conteudo = conteudo + "<LINK rel='stylesheet' type='text/css' href='./iu/lib/css/style_pp.css' media='print'>";
	conteudo = conteudo + "</HEAD><BODY style='overflow-y:auto'>";
	conteudo = conteudo + "<input class=button type=button value='imprimir' onclick=window.print()>&nbsp;";
	conteudo = conteudo + "<input class=button type=button value='fechar' onclick=window.close()><br class=exibir><br class=exibir>";
	conteudo = conteudo + document.all(div).innerHTML;
	conteudo = conteudo + "<scrip" + "t>window.print(); </sc" + "ript>";
	conteudo = conteudo + "</BODY></HTML>";
	var printWin=window.open("","Impressão","height=600,width=600,scrollbars=yes");
	printWin.document.write(conteudo);
	printWin.document.close();
	printWin.focus();
}

function formataHora(obj){
	tecla = window.event.keyCode;
	conteudo = obj.value;
	conteudo = conteudo.replace(":","");
	if (tecla!=8){
		if (tecla!=6){
			if (conteudo.length==4){
				obj.value = conteudo.substr(0,2)+':'+conteudo.substr(2,2)
			}
			if (conteudo.length==6){
				obj.value = conteudo.substr(0,2)+':'+conteudo.substr(2,2)+':'+conteudo.substr(4,2)
			}
		}if (tecla==111){
			obj.value = conteudo
		}
	}
}

function LimparVlr(valor, validos) {
	// retira caracteres invalidos da string
	var result = "";
	var aux;
	for (var i=0; i < valor.length; i++) {
		aux = validos.indexOf(valor.substring(i, i+1));
		if (aux>=0) {
		result += aux;
		}
	}
	return result;
}

