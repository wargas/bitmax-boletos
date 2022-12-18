<?php

namespace App\Libraries;

use \OpenBoleto\Banco\Santander;
use \OpenBoleto\Agente;

class Boleto
{

    /**
     * @return \OpenBoleto\BoletoAbstract;
     */
    public static function defaultBoleto()
    {
        return new Santander([
            'cedente' => self::getCedente(),
            'agencia' => 4004,
            'carteira' => 101,
            'conta' => 177808,
            'contaDv' => 0,
            'agenciaDv' => 5,
            'carteiraDv' => 1,
            'descricaoDemonstrativo' => array(
                'Fornecimento de internet'
            ),
            'instrucoes' => array(
                'ApÃ³s o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
                'NÃ£o receber apÃ³s o vencimento.',
            ),

        ]);
    }

    /**
     * @return \OpenBoleto\Agente
     */
    public static function getCedente()
    {
        return new Agente(
            'INFOLINK',
            '11.340.883/0001-03',
            'R JOAQUIM FERREIRA DE ARAUJO 192 LETRA A ',
            '56210-000',
            'Santa Filomena',
            'PE'
        );
    }

    /**
     * @param \OpenBoleto\Banco\Santander $boleto;
     */
    public static function pdf(Santander $boleto)
    {
        $data = $boleto->getData();
        $cedente = $boleto->getCedente();
        $sacado = $boleto->getSacado();


        $pdf = new \FPDF();
        $pdf->AddPage();

        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(190, 4, $cedente->getNome(), 0, 1);
        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(190, 4, $cedente->getDocumento(), 0, 1);
        $pdf->Cell(190, 4, $cedente->getEndereco(), 0, 1);
        $pdf->Cell(190, 4, $cedente->getCepCidadeUf(), 0, 1);
        $pdf->Ln(4);


        $pdf->SetLineWidth(0.5);

        $pdf->Image('santander.jpg', null, null, 30, 6);
        $pdf->SetXY(10, $pdf->GetY() - 6);
        $pdf->Cell(35, 6, "", "R", 0, "C");
        $pdf->SetFont("Arial", 'B', 16);
        $pdf->Cell(20, 6, $boleto->getCodigoBancoComDv(), "R", 0, "C");
        $pdf->SetFont("Arial", 'B', 12);
        $pdf->Cell(135, 6, $boleto->getLinhaDigitavel(), "", 1, "R");

        $pdf->SetLineWidth(0.1);
        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(80, 4, "Beneficiário", "LT", 0);
        $pdf->Cell(30, 4, "CPF/CNPJ", "LTR", 0);
        $pdf->SetFont("Arial", '', 7);
        $pdf->Cell(40, 3, "Agência/Código do", "T", 0);
        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(40, 4, "Vencimento", "LRT", 1);

        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(80, 4, $cedente->getNome(), "LB", 0);
        $pdf->Cell(30, 4, $cedente->getDocumento(), "LB", 0);
        $pdf->Cell(40, 4, $boleto->getAgenciaCodigoCedente(), "LB", 0);
        $pdf->Cell(40, 4, $boleto->getDataVencimento()->format("d/m/Y"), "LRB", 1, "R");

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetFont("Arial", '', 8);
        $pdf->setXY(120, $y - 6);
        $pdf->SetFont("Arial", '', 7);
        $pdf->Cell(40, 3, "Pagador");
        $pdf->SetFont("Arial", '', 8);

        $pdf->SetXY($x, $y);

        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(110, 4, "Pagador", "L", 0);
        $pdf->Cell(40, 4, "Nº documento", "L", 0);
        $pdf->Cell(40, 4, "Nosso número", "LR", 1);

        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(110, 4, $sacado->getNome(), "LB", 0);
        $pdf->Cell(40, 4, "", "LB", 0);
        $pdf->Cell(40, 4, $boleto->getNossoNumero(true), "LRB", 1, 'R');

        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(30, 4, "Espécie", "L", 0);
        $pdf->Cell(40, 4, "Quantidade", "L", 0);
        $pdf->Cell(40, 4, "Valor", "L", 0);
        $pdf->Cell(40, 4, "(-) Descontos / Abatimentos", "L", 0);
        $pdf->Cell(40, 4, "(=) Valor Documento", "LR", 1);

        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(30, 4, $data['especie'], "LB", 0);
        $pdf->Cell(40, 4, "", "LB", 0);
        $pdf->Cell(40, 4, "", "LB", 0);
        $pdf->Cell(40, 4, "", "LB", 0);
        $pdf->Cell(40, 4, $data["valor_documento"], "LRB", 1, 'R');

        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(70, 4, "", "L", 0);
        $pdf->Cell(40, 4, "(-) Outras deduções", "L", 0);
        $pdf->Cell(40, 4, "(+) Outros acréscimos", "L", 0);
        $pdf->Cell(40, 4, "(=) Valor cobrado", "LR", 1);


        $pdf->Cell(70, 4, "Deonstrativo", "LB", 0);
        $pdf->Cell(40, 4, "", "LB", 0);
        $pdf->Cell(40, 4, "", "LB", 0);
        $pdf->Cell(40, 4, "", "LRB", 1, 'R');

        $pdf->MultiCell(190, 30, "", 1);
        $pdf->SetY($pdf->GetY() - 28);
        $pdf->Cell(100, 4, "Fornecimento de internet", 0, 0);
        $pdf->Cell(90, 4, "Autenticação Mecânica", 0, 1, "R");
        $pdf->SetY($pdf->GetY() + 28);

        $pdf->Cell(190, 3, "Corte na linha pontilhada", 0, 1, "R");
        $pdf->Image("line.png", null, null, 190);


        $pdf->SetY($pdf->GetY() + 4, true);

        $pdf->SetLineWidth(0.5);

        $pdf->Image("santander.jpg", null, null, 30, 6);
        $pdf->SetXY(10, $pdf->GetY() - 6);
        $pdf->Cell(35, 6, "", "R", 0, "C");
        $pdf->SetFont("Arial", 'B', 16);
        $pdf->Cell(20, 6, $boleto->getCodigoBancoComDv(), "R", 0, "C");
        $pdf->SetFont("Arial", 'B', 12);
        $pdf->Cell(135, 6, $boleto->getLinhaDigitavel(), "", 1, "R");

        $pdf->SetLineWidth(0.1);

        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(135, 4, "Local de pagamento", "TL");
        $pdf->Cell(55, 4, "Vencimento", "TLR", 1);
        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(135, 4, "Pagar preferencialmente no Banco Santander", "BL");
        $pdf->Cell(55, 4, $boleto->getDataVencimento()->format('d/m/Y'), "BLR", 1, "R");

        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(135, 4, "Beneficiário", "TL");
        $pdf->Cell(55, 4, "Agência/Código beneficiário", "TLR", 1);
        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(100, 4, $cedente->getNome(), "L");
        $pdf->Cell(35, 4, $cedente->getDocumento(), "");
        $pdf->Cell(55, 4, $boleto->getAgenciaCodigoCedente(), "LR", 1, "R");

        $pdf->Cell(135, 4, $cedente->getEndereco(), "L");
        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(55, 4, "Nosso número", "TLR", 1);

        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(135, 4, $cedente->getCepCidadeUf(), "L");
        $pdf->Cell(55, 4, $boleto->getNossoNumero(true), "LR", 1, "R");

        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(30, 4, "Data do documento", "TL");
        $pdf->Cell(30, 4, "Nº documento", "TL");
        $pdf->Cell(30, 4, "Espécie doc.", "TL");
        $pdf->Cell(15, 4, "Aceite", "TL");
        $pdf->Cell(30, 4, "Data processamento", "TL");
        $pdf->Cell(55, 4, "(=) Valor do Documento", "TLR", 1);

        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(30, 4, $boleto->getDataDocumento()->format('d/m/Y'), "L");
        $pdf->Cell(30, 4, "", "L");
        $pdf->Cell(30, 4, "", "L");
        $pdf->Cell(15, 4, "N", "L");
        $pdf->Cell(30, 4, $boleto->getDataProcessamento()->format('d/m/Y'), "L");
        $pdf->Cell(55, 4, $data["valor_documento"], "LR", 1, "R");

        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(45, 4, "Carteira", "TL");
        $pdf->Cell(15, 4, "Espécie", "TL");
        $pdf->Cell(45, 4, "Quantidade", "TL");
        $pdf->Cell(30, 4, "Valor", "TL");
        $pdf->Cell(55, 4, " (-) Descontos / Abatimentos", "TLR", 1);

        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(45, 4, "Cobrança Simples ECR", "L");
        $pdf->Cell(15, 4, $boleto->getEspecieDoc(), "L");
        $pdf->Cell(45, 4, "", "L");
        $pdf->Cell(30, 4, "", "L");
        $pdf->Cell(55, 4, "", "LR", 1);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(135, 32, "", "TLRB");

        $pdf->SetXY($x, $y);

        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(135, 4, "Instruções (Texto de responsabilidade do beneficiário)");
        $pdf->Cell(55, 4, " (-) Outras deduções", "TLR", 1);
        $pdf->Cell(135, 4, "");
        $pdf->Cell(55, 4, "", "LR", 1);

        $pdf->Cell(135, 4, "Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.");
        $pdf->Cell(55, 4, "(+) Mora / Multa", "TLR", 1);
        $pdf->Cell(135, 4, "Não receber após o vencimento.");
        $pdf->Cell(55, 4, "", "LR", 1);

        $pdf->Cell(135, 4, "");
        $pdf->Cell(55, 4, "(+) Outros acréscimos", "TLR", 1);
        $pdf->Cell(135, 4, "");
        $pdf->Cell(55, 4, "", "LR", 1);

        $pdf->Cell(135, 4, "");
        $pdf->Cell(55, 4, "(+) Mora / Multa", "TLR", 1);
        $pdf->Cell(135, 4, "");
        $pdf->Cell(55, 4, "", "BLR", 1);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(190, 20, "", "LRB");

        $pdf->SetXY($x, $y);
        $pdf->Cell(190, 4, "Pagador", 0, 1);

        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(100, 4, $sacado->getNome(), 0, 0);
        $pdf->Cell(90, 4, $sacado->getDocumento(), 0, 1);

        $pdf->Cell(190, 4, $sacado->getEndereco(), 0, 1);
        $pdf->Cell(190, 4, $sacado->getCepCidadeUf(), 0, 1);

        $pdf->Ln(4);
        $pdf->SetFont("Arial", '', 8);
        $pdf->Cell(100, 4, "Pagador / Avalista", 0, 0);
        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(90, 4, "Autenticação mecânica - Ficha de Compensação", 0, 1, "R");

        $bars = self::getBars($boleto->getData()['codigo_barras']);

        foreach ($bars as $bar) {
            $fill = explode(' ', $bar)[0] == "black";
            $size = (explode(' ', $bar)[1] == "thin") ? 0.3 : 0.9;

            $pdf->Cell($size, 20, "", 0, 0, "", $fill);
        }

        return $pdf->Output("S", "boleto", true);
    }

    public static function getBars(string $barcoHtml)
    {
        preg_match_all("/(black thin|white thin|black large|white large)/", $barcoHtml, $matches, PREG_OFFSET_CAPTURE);

        $bars = [];

        foreach ($matches[0] as $m) {
            $bars[] = $m[0];
        }

        return $bars;
    }
}
