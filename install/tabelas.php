<?

$tabelas["permissao"]["criar"]="
CREATE TABLE IF NOT EXISTS `permissao` (
  `login` varchar(50) NOT NULL,
  `codModulo` int(3) NOT NULL,
  `codRotina` int(3) NOT NULL,
  `codFuncao` int(3) NOT NULL,
  `permissao` int(3) default NULL,
  `dataCadastro` date default NULL,
  `horaCadastro` time default NULL,
  `usuarioCadastro` varchar(50) default NULL,
  PRIMARY KEY  (`login`,`codModulo`,`codRotina`,`codFuncao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$tabelas["permissao"]["inserir"]="
Insert  
into permissao
(login,codModulo,codRotina,codFuncao,permissao,dataCadastro,horaCadastro,usuarioCadastro) 
values 
('SUPORTE',999,1,1,3,NULL,NULL,NULL),
('SUPORTE',999,1,2,3,NULL,NULL,NULL),
('SUPORTE',999,2,1,3,NULL,NULL,NULL),
('SUPORTE',999,3,1,3,NULL,NULL,NULL),
('SUPORTE',999,3,2,3,NULL,NULL,NULL);
";

$tabelas["modulos"]["criar"]="
CREATE TABLE IF NOT EXISTS modulos (
  modulo varchar(50) NOT NULL,
  rotina varchar(50) NOT NULL,
  funcao varchar(50) NOT NULL,
  codModulo int(3) NOT NULL,
  codRotina int(3) NOT NULL,
  codFuncao int(3) NOT NULL,
  loadClass varchar(50) NOT NULL,
  PRIMARY KEY  (codModulo,codRotina,codFuncao)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$tabelas["modulos"]["inserir"]="
INSERT 
INTO modulos 
(modulo, rotina, funcao, codModulo, codRotina, codFuncao, loadClass) 
VALUES 
('Gerenciar', 'Usuario', 'Gerenciar', 999, 1, 1, 'm999/r001/f001/load'),
('Gerenciar', 'Usuario', 'Permissões', 999, 1, 2, 'm999/r001/f002/load'),
('Gerenciar', 'Modulos', 'Modulos', 999, 2, 1, 'm999/r002/f001/load'),
('Gerenciar', 'Back-Up', 'Gerar', 999, 3, 1, 'm999/r003/f001/load'),
('Gerenciar', 'Back-Up', 'Restaurar', 999, 3, 2, 'm999/r003/f002/load'),
('Gerenciar', 'Licensa', 'Licensa', 999, 4, 1, 'm999/r004/f001/load');
";


$tabelas["usuarios"]["criar"]="
CREATE TABLE IF NOT EXISTS usuarios (
  login varchar(50) NOT NULL,
  senha varchar(100) default NULL,
  nome varchar(100) default NULL,
  email varchar(100) default NULL,
  telefone varchar(100) default NULL,
  dataSenha date default NULL,
  PRIMARY KEY  (login)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$tabelas["usuarios"]["inserir"]="
Insert  
into usuarios(login,senha,nome,email,telefone,dataSenha) 
values ('SUPORTE','319bfbc022f7cb4fc1c92d3460ae3bde','SUPORTE','LEANDROVIANA@GMAIL.COM','83860079','".date('Y-m-d')."'); 
";


$tabelas["usuariohistorico"]["criar"]="
CREATE TABLE IF NOT EXISTS usuariohistorico (
  login varchar(50) default NULL,
  dataLogin date default NULL,
  horaLogin time default NULL,
  dataLogof date default NULL,
  horaLogof time default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";


$tabelas["navegacao"]["criar"]=" CREATE TABLE IF NOT EXISTS navegacao (
codigo int(10) NOT NULL auto_increment,
tipo varchar(50) default NULL,
situacao varchar(50) default NULL,
dado varchar(50) default NULL,
informacao varchar(50) default NULL,
tela varchar(50) default NULL,
usuario varchar(50) default NULL,
data date default NULL,
hora time default NULL,
PRIMARY KEY  (codigo)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
							 ";



?>

