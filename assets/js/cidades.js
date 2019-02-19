/**
 * Escrito por DGmike
 * http://dgmike.com.br/cidades-estados-js
 */

/* Dom Ready */
window.onDomReady = function dgDomReady(fn){
	if(document.addEventListener)	//W3C
		document.addEventListener("DOMContentLoaded", fn, false);
	else //IE
		document.onreadystatechange = function(){dgReadyState(fn);}
}

function dgReadyState(fn){ //dom is ready for interaction (IE)
	if(document.readyState == "interactive") fn();
}

/* Objeto */
dgCidadesEstados = function(bairro,cidade,init) {
  this.set(bairro,cidade);
  if (init) this.start();
}

dgCidadesEstados.prototype = {
  cidade: document.createElement('select'),
  bairro: document.createElement('select'),
  set: function(cidade, bairro) {
    this.cidade=cidade;
    this.cidade.dgCidadesEstados=this
    this.bairro=bairro;
    this.cidade.onchange=function(){this.dgCidadesEstados.run()};
  },
  run: function () {
    var sel = this.cidade.options.selectedIndex;
    var itens = this.bairros[sel];
    var itens_total = itens.length;
    var opts = this.bairro;
    while (opts.childNodes.length)
      opts.removeChild(opts.firstChild);
    this.addOption(opts, '', '*Selecione o bairro do imóvel');
    for (var i=0;i<itens_total;i++)
      this.addOption(opts, itens[i], itens[i]);
  },
  start: function () {
    var cidade = this.cidade
    while (cidade.childNodes.length)
      cidade.removeChild(cidade.firstChild);
    for (var i=0;i<this.cidades.length;i++)
      this.addOption(cidade, this.cidades[i][0], this.cidades[i][1]);
  },
  addOption: function (elm, val, text) {
    var opt = document.createElement('option');
    opt.appendChild(document.createTextNode(text));
    opt.value = val;
    elm.appendChild(opt);
  },
  cidades : [
    ['cidade','*Selecione a cidade do imóvel'],['1','Adrianópolis'],['2','Agudos do Sul'],['3','Almirante Tamandaré'],['4','Araucária'],['5','Balsa Nova'],
    ['6','Bocaiuva do Sul'],['7','Campina Grande do Sul'],['8','Campo do Tenente'],['9','Campo Largo'],['10','Campo Magro'],['11','Cerro Azul'],
    ['12','Colombo'],['13','Contenda'],['14','Curitiba'],['15','Doutor Ulysses'],['16','Fazenda Rio Grande'],['17','Itaperuçu'],
    ['18','Lapa'],['19','Mandirituba'],['20','Piên'],['21','Pinhais'],['22','Piraquara'],['23','Quatro Barras'],
    ['24','Quitandinha'],['25','Rio Branco do Sul'],['26','Rio Negro'],['27','São José dos Pinhais'],['28','Tijucas do Sul'],['29','Tunas do Paraná']
  ],
  bairros : [[
    ],[ 'Centro'
	],['Centro','Leão'
	],['Areias','Boichininga','Bonfim','Botiatuba','Cachoeira','Campina do Arruda','Campo Grande','Centro','Colônia Antônio Prado','Colonia Santa Gabriela','Colônia São Venâncio','Jardim Água Boa','Jardim Alvorada','Jardim Alvorada II','Jardim Anita Garibaldi','Jardim Apucarana','Jardim Bela Vista','Jardim Benfica','Jardim Campo Verde','Jardim Colonial','Jardim das Oliveiras','Jardim do Norte','Jardim do Rocio','Jardim Dona Belizaria','Jardim Dona Luiza','Jardim Giannini','Jardim Gineste','Jardim Ipê','Jardim Itamarati','Jardim Kokot','Jardim Marambaia','Jardim Miragem',' Jardim Mônica','Jardim Monte Santo'
	],['Cachoeira','Campina da Barra','Capela Velha','Centro','Chapada','Costeira','Estação','Fazenda Velha','Iguaçu','Passaúna','Porto das Laranjeiras','Sabiá','São Miguel','Thomaz Coelho',
	],['Bugre','Centro','Jardim Serrinha','Nova Serrinha'
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],['Abranches','Água Verde','Ahú','Alto Boqueirão','Alto da Glória','Alto da XV','Atuba','Augusta','Bacacheri','Bairro Alto','Barreirinha','Batel','Boa Vista','Bom Retiro','Boqueirão','Boqueirão','Butiatuvinha','Cabral','Cachoeira','Cajuru','Campina do Siqueira','Campo Comprido','Campo de Santana','Capão da Imbuia','Capão Raso','Cascatinha','Centro','Centro Histórico','Caximba','Centro Cívico','Champagnat','Cidade Industrial','Cristo Rei','Fanny','Fazendinha','Ganchinho','Guabirotuba','Guaíra','Hauer','Hugo Lange','Jardim Botânico','Jardim Social','Jardim das Américas','Juvevê','Lamenha Pequena','Lindoia','Mercês','Mossunguê (Ecoville)','Novo Mundo','Orleans','Parolin','Pilarzinho','Pilarzinho','Portão','Prado Velho','Rebouças','Riviera','Santa Cândida','Santa Felicidade','Santa Quitéria','Santo Inácio','São Braz','São Francisco','São João','São Lourenço','São Miguel','Seminário','Sítio Cercado','Taboão','Tarumã','Tatuquara','Tingui','Uberaba','Umbará','Vila Izabel','Vista Alegre','Xaxim'
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	],[''
	]
	
  ]
};