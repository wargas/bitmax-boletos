<?php 

namespace App\Libraries\Remessa;

use DOMDocument;
use DOMElement;
use SoapClient;

class BoletoXML {
    private $dom;
    private $dados;

    function __construct()
    {
        $this->dom = new DOMDocument("1.0", "UTF-8");
        $this->dados = $this->dom->createElement("dados");

        $envelope = $this->dom->createElementNS('http://schemas.xmlsoap.org/soap/envelope/', 'soapenv:Envelope');
        $envelope->setAttribute("xmlns:impl","http://impl.webservice.dl.app.bsbr.altec.com/");
        $header = $this->dom->createElement("soapenv:Header");
        $body = $this->dom->createElement("soapenv:Body");
        $create = $this->dom->createElement("impl:create");
        $TicketRequest = $this->dom->createElement("TicketRequest");
        
        $expiracao = $this->dom->createElement("expiracao", 100);
        $sistema = $this->dom->createElement("sistema", "YMB");

        $body->appendChild($create);
        $create->appendChild($TicketRequest);
        $TicketRequest->appendChild($this->dados);
        $TicketRequest->appendChild($expiracao);
        $TicketRequest->appendChild($sistema);      
        $envelope->appendChild($header);
        $envelope->appendChild($body);
        $this->dom->appendChild($envelope);
    }

    public function build() {
        $this->addDados("CONVENIO.COD-BANCO", "0033");
        $this->addDados("CONVENIO.COD-CONVENIO", "XXX");
        $this->addDados("PAGADOR.TP-DOC", "99");
        $this->addDados("PAGADOR.NUM-DOC", "XXX");
        $this->addDados("PAGADOR.NOME", "XXX");
        $this->addDados("PAGADOR.ENDER", "XXX");
        $this->addDados("PAGADOR.BAIRRO", "XXX");
        $this->addDados("PAGADOR.CIDADE", "XXX");
        $this->addDados("PAGADOR.UF", "XXX");
        $this->addDados("PAGADOR.CEP", "XXX");
        $this->addDados("TITULO.NOSSO-NUMERO", "XXX");
        $this->addDados("TITULO.SEU-NUMERO", "XXX");
        $this->addDados("TITULO.DT-VENCTO", "XXX");
        $this->addDados("TITULO.DT-EMISSAO", "XXX");
        $this->addDados("TITULO.ESPECIE", "XXX");
        $this->addDados("TITULO.VL-NOMINAL", "XXX");
        $this->addDados("TITULO.PC-MULTA", "XXX");
        $this->addDados("TITULO.QT-DIAS-MULTA", "XXX");
        $this->addDados("TITULO.PC-JURO", "XXX");
        $this->addDados("TITULO.TP-DESC", "XXX");
        $this->addDados("TITULO.VL-DESC", "XXX");
        $this->addDados("TITULO.DT-LIMI-DESC", "XXX");
        $this->addDados("TITULO.VL-DESC2", "XXX");
        $this->addDados("TITULO.DT-LIMI-DESC2", "XXX");
        $this->addDados("TITULO.VL-DESC3", "XXX");
        $this->addDados("TITULO.DT-LIMI-DESC3", "XXX");
        $this->addDados("TITULO.VL-ABATIMENTO", "XXX");
        $this->addDados("TITULO.TP-PROTESTO", "XXX");
        $this->addDados("TITULO.QT-DIAS-PROTESTO", "XXX");
        $this->addDados("TITULO.QT-DIAS-BAIXA", "XXX");
        $this->addDados("TITULO.TP-PAGAMENTO", "XXX");
        $this->addDados("TITULO.QT-PARCIAIS", "XXX");
        $this->addDados("TITULO.TP-VALOR", "XXX");
        $this->addDados("TITULO.VL-PERC-MINIMO", "XXX");
        $this->addDados("TITULO.VL-PERC-MAXIMO", "XXX");
        $this->addDados("TITULO.TP-DOC-AVALISTA", "XXX");
        $this->addDados("TITULO.NUM-DOC-AVALISTA", "XXX");
        $this->addDados("TITULO.NOME-AVALISTA", "XXX");
        $this->addDados("TITULO.COD-PARTILHA1", "XXX");
        $this->addDados("TITULO.VL-PARTILHA1", "XXX");
        $this->addDados("TITULO.COD-PARTILHA2", "XXX");
        $this->addDados("TITULO.VL-PARTILHA2", "XXX");
        $this->addDados("TITULO.COD-PARTILHA3", "XXX");
        $this->addDados("TITULO.VL-PARTILHA3", "XXX");
        $this->addDados("TITULO.COD-PARTILHA4", "XXX");
        $this->addDados("TITULO.VL-PARTILHA4", "XXX");
        $this->addDados("TITULO.TIPO-CHAVE-DICT", "XXX");
        $this->addDados("TITULO.COD-CHAVE-DICT", "XXX");
        $this->addDados("TITULO.TXID-PIX", "XXX");
        $this->addDados("TITULO.CTRL-PARTICIPANTE", "XXX");
        $this->addDados("MENSAGEM", "XXX");
    }

    public function getXML() {
        $this->dom->save("boleto.xml");
        return $this->dom->saveXML();
    }

    public function addDados($key, $value) {

        $entry = $this->dom->createElement("entry");
        $_key = $this->dom->createElement("key", $key);
        $_value = $this->dom->createElement("value", $value);

        $entry->appendChild($_key);
        $entry->appendChild($_value);

        $this->dados->appendChild($entry);

    }

    public function send() {
        $soap = new \SoapClient('https://ymbdlb.santander.com.br/dl-ticket-services/TicketEndpointService/TicketEndpointService.wsdl', [
            "keep-alive" => false
        ]);

        print_r($soap);

    }
    
}