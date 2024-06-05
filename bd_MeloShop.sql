create database db_melodiaShop;
use db_melodiaShop;
drop database db_melodiashop;

-- tabela de funcinario que esta interligada com cliente, produto, fornecedor, pagamento e  agenda
create table funcionario(
 id_func int auto_increment primary key,
 nome_func varchar(80) not null,
 email_func varchar(50) not null,
 senha_func varchar(50) not null,
 CPF_func char(14) not null unique
);


-- tabela cliente que tem funcionario como chave estrangeira e esta interligada com venda
create table cliente(
 id_cli int auto_increment primary key,
 nome_cli varchar(80) not null,
 email_cli varchar(50) not null,
 tel_cli varchar(14) not null,
 CPF_cli char(14) not null unique,
 senha_cli varchar(50) not null,
 id_func int, 
 constraint foreign key (id_func) references funcionario(id_func)
);


-- tabela fornecedor que tem funcionario como chave estrangeira e esta interligada com comissão
create table fornecedor(
 id_forn int auto_increment primary key,
 nome_forn varchar(80) not null,
 email_forn varchar(50) not null,
 CNPJ_forn char(18) not null unique,
 id_func int,
  constraint foreign key (id_func) references funcionario(id_func)
);

-- tabela produto que tem funcionario como chave estrangeira e esta interligada com venda e comissão
create table produto(
id_prod int auto_increment primary key,
categoria varchar(20) not null,
valor decimal(16,2) not null,
quant_prod int not null,
nome_prod varchar(50) not null,
desc_prod varchar(80) not null,
img_prod varchar(250) not null,
cart_prod bit not null,
id_func int,
id_cli int,
  constraint foreign key (id_func) references funcionario(id_func),
  constraint foreign key (id_cli) references cliente(id_cli)
);



-- tabela pagamento que tem funcionario como chave estrangeira 
create table pagamento(
id_pag int auto_increment primary key,
tipo_pag varchar(10) not null,
valor_total int not null,
id_func int,
  constraint foreign key (id_func) references funcionario(id_func)
);

-- tabela agenda que tem funcionario como chave estrangeira 
create table agenda(
periodo datetime not null,
desc_agenda varchar(50) not null,
id_func int primary key,
  constraint foreign key (id_func) references funcionario(id_func)
);

-- tabela venda que tem produto e cliente como chave estrangeira, alem de ser um relacionamento entre cliente e produto
create table venda (
id_venda int auto_increment primary key,
no_ticket varchar(13) not null,
quant_prod int not null,
vl_item decimal(10,2) not null,
valor_venda decimal(10,2) generated always as ((quant_prod * vl_item)) virtual,
quant_venda int not null,
dt_venda date not null,
id_cli int,
id_prod int,
  constraint foreign key (id_cli) references cliente(id_cli),
  constraint foreign key (id_prod) references produto(id_prod)
);

-- comissão é o relacionamento entre o fornecedor e o produto e tem como chave estrangeira o produto e o fornecedor  
create table comissao(
id_comissao int auto_increment primary key,
quant_comissao int not null,
id_prod int,
id_forn int,
  constraint foreign key (id_prod) references produto(id_prod),
  constraint foreign key (id_forn) references fornecedor(id_forn)
);

create table tel_func(
id_fone int primary key auto_increment,
tel_func varchar (11) not null,
id_func int,
constraint foreign key (id_func) references funcionario(id_func)
);

create table tel_cli(
id_fone int primary key auto_increment,
tel_cli varchar (11) not null,
id_cli int,
constraint foreign key (id_cli) references cliente(id_cli)
);

create table tel_forn(
id_fone int primary key auto_increment,
tel_forn varchar (11) not null,
id_forn int,
constraint foreign key (id_forn) references fornecedor(id_forn)
);

-- deletar um cliente
delete from produto where id_prod = '1';

-- selecionar tudo de uma tabela
select * from produto;

-- selecionar produto de acordo com a categoria dele
select * from produto where categoria like '{0}%';

-- inserir funcionario
insert into funcionario (nome_func, email_func, senha_func, CPF_func)
				values ('Daniel','daniel@gmail.com', '102030', '12345612379');
                
-- inserir cliente
insert into cliente (nome_cli, senha_cli, email_cli, CPF_cli, tel_cli)
				values ('Daniel Batista', '102030','dani@gmail','11231456789', '(11)94908-1179');
                
                
-- inserir fornecedor
insert into fornecedor (nome_forn, email_forn, CNPJ_forn)
				values ('edu','edu@gmail','11231456789123');

-- inserir produto
insert into produto (nome_prod, categoria, valor, desc_prod, img_prod, quant_prod)
				values ('Guitarra','guitarras','4500', 'Você é do rock?', 'guitarra 2', '3');

-- inserir pagamento
insert into pagamento (tipo_pag, valor_total)
				values ('pix','99.99');
                
-- inserir agenda
insert into agenda (periodo, desc_agenda, id_func)
				values (str_to_date('14/12/2012', '%d/%m/%Y'),'dia de entrada', '1');

  -- inserir venda
insert into venda (valor_venda, quant_venda, id_cli, id_prod)
				values ('15000','5', '2', '2');

-- inserir comissão (erro)
insert into comissao (quant_comissao, id_forn, id_prod)
				values ('30','1', '2');

-- inserir telefone funcionario
insert into tel_func ( tel_func, id_func)
				values ('115558031','1');
                
-- inserir telefone cliente (erro)
insert into tel_cli ( tel_cli, id_cli)
				values ('1199515421','2');
                
-- inserir telefone fornecedor
insert into tel_forn ( tel_forn, id_forn)
				values ('154758031','1');
                
-- atualizar dados de um atributo de uma tabela
update produto set valor = 3000 where id_prod = 2;