<?php

namespace App\Libraries;

use Exception;
use \OpenBoleto\Banco\Santander;
use \OpenBoleto\Agente;

class PDF extends \FPDF {

    public function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        try {
            $txt = iconv("UTF-8", "ISO-8859-1", $txt);
        } catch(Exception $e) {}
        parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
    }
}

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
                'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
                'Não receber após o vencimento.',
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


        $pdf = new PDF();
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
        $pdf->Cell(40, 4, "(-) Outras dedu??es", "L", 0);
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

        self::fichaCompensacao($pdf, $boleto);

        return $pdf->Output("S", "boleto", false);
    }

    /**
     * @param \OpenBoleto\Banco\Santander[]
     */

    public static function carnes(array $boletos)
    {
        $pdf = new PDF();
        $pdf->AddPage();
        $i = 1;
        foreach ($boletos as $b) {
            /**
             * @var \OpenBoleto\Banco\Santander $boleto */
            $boleto = $b;

            $y = $pdf->GetY();
            self::fichaCompensacao($pdf, $boleto, true);
            $y2 = $pdf->GetY();

            $pdf->SetLeftMargin(10);
            $pdf->SetY($y);


            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "Vencimento", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "05/01/2023", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "Agência/Código do Beneficiário", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "4004-5 / 177808-0", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "Nosso número", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "000000000100-7", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "Nº documento", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "Espécie", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "REAL", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "Quantidade", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "(=) Valor Documento", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "60,00", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "(-) Descontos / Abatimentos", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "(-) Outras deduções", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "(+) Mora / Multa", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "(+) Outros acréscimos", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "(=) Valor cobrado", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "CNPJ do Beneficiário", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->Cell(38, 2.5, "11.340.883/0001-03", "RL", 1);

            $pdf->setFont("Arial", "", 6);
            $pdf->Cell(38, 2.5, "Endereço do Beneficiário", "TRL", 1);
            $pdf->setFont("Arial", "B", 6);
            $pdf->MultiCell(38, 2.5, "R JOAQUIM FERREIRA DE ARAUJO 192 LETRA A ", "RLB", 1);


            $pdf->SetY($y2);



            if ($i % 3 === 0) {
                $pdf->AddPage();
            }

            $i++;
        }


        return $pdf->Output("S", "boleto", true);
    }

    /**
     * @param \FPDF
     * @param \OpenBoleto\Banco\Santander
     */
    public static function fichaCompensacao(\FPDF $pdf, $boleto, $carne = false)
    {
        $data = $boleto->getData();
        $cedente = $boleto->getCedente();
        $sacado = $boleto->getSacado();
        $pdf->SetLineWidth(0.5);

        if ($carne) {
            $h = 2.7;
            $fontSize = 7;
            $width = 150;
            $pdf->SetLeftMargin(50);
        } else {
            $h = 4;
            $fontSize = 8;
            $width = 190;
        }



        $pdf->Image("santander.jpg", $pdf->GetX(), $pdf->GetY(), 30 / 190 * $width, 6);
        $pdf->Cell((35 / 190) * $width, 6, "", "R", 0, "C");
        $pdf->SetFont("Arial", 'B', 10);
        $pdf->Cell((20 / 190) * $width, 6, $boleto->getCodigoBancoComDv(), "R", 0, "C");
        $pdf->SetFont("Arial", 'B', 10);
        $pdf->Cell((135 / 190) * $width, 6, $boleto->getLinhaDigitavel(), "", 1, "R");

        $pdf->SetLineWidth(0.1);

        $pdf->SetFont("Arial", '', $fontSize);
        $pdf->Cell((135 / 190) * $width, $h, "Local de pagamento", "TL");
        $pdf->Cell((55 / 190) * $width, $h, "Vencimento", "TLR", 1);
        $pdf->SetFont("Arial", 'B', $fontSize);
        $pdf->Cell((135 / 190) * $width, $h, "Pagar preferencialmente no Banco Santander", "BL");
        $pdf->Cell((55 / 190) * $width, $h, $boleto->getDataVencimento()->format('d/m/Y'), "BLR", 1, "R");

        $pdf->SetFont("Arial", '', $fontSize);
        $pdf->Cell((135 / 190) * $width, $h, "Beneficiário", "TL");
        $pdf->Cell((55 / 190) * $width, $h, "Agência/Código beneficiário", "TLR", 1);
        $pdf->SetFont("Arial", 'B', $fontSize);
        $pdf->Cell((100 / 190) * $width, $h, $cedente->getNome(), "L");
        $pdf->Cell((35 / 190) * $width, $h, $cedente->getDocumento(), "");
        $pdf->Cell((55 / 190) * $width, $h, $boleto->getAgenciaCodigoCedente(), "LR", 1, "R");

        $pdf->Cell((135 / 190) * $width, $h, $cedente->getEndereco(), "L");
        $pdf->SetFont("Arial", '', $fontSize);
        $pdf->Cell((55 / 190) * $width, $h, "Nosso número", "TLR", 1);

        $pdf->SetFont("Arial", 'B', $fontSize);
        $pdf->Cell((135 / 190) * $width, $h, $cedente->getCepCidadeUf(), "L");
        $pdf->Cell((55 / 190) * $width, $h, $boleto->getNossoNumero(true), "LR", 1, "R");

        $pdf->SetFont("Arial", '', $fontSize);
        $pdf->Cell((30 / 190) * $width, $h, "Data do documento", "TL");
        $pdf->Cell((30 / 190) * $width, $h, "N? documento", "TL");
        $pdf->Cell((30 / 190) * $width, $h, "é doc.", "TL");
        $pdf->Cell((15 / 190) * $width, $h, "Aceite", "TL");
        $pdf->Cell((30 / 190) * $width, $h, "Data processamento", "TL");
        $pdf->Cell((55 / 190) * $width, $h, "(=) Valor do Documento", "TLR", 1);

        $pdf->SetFont("Arial", 'B', $fontSize);
        $pdf->Cell((30 / 190) * $width, $h, $boleto->getDataDocumento()->format('d/m/Y'), "L");
        $pdf->Cell((30 / 190) * $width, $h, "", "L");
        $pdf->Cell((30 / 190) * $width, $h, "", "L");
        $pdf->Cell((15 / 190) * $width, $h, "N", "L");
        $pdf->Cell((30 / 190) * $width, $h, $boleto->getDataProcessamento()->format('d/m/Y'), "L");
        $pdf->Cell((55 / 190) * $width, $h, $data["valor_documento"], "LR", 1, "R");

        $pdf->SetFont("Arial", '', $fontSize);
        $pdf->Cell((45 / 190) * $width, $h, "Carteira", "TL");
        $pdf->Cell((15 / 190) * $width, $h, "é", "TL");
        $pdf->Cell((45 / 190) * $width, $h, "Quantidade", "TL");
        $pdf->Cell((30 / 190) * $width, $h, "Valor", "TL");
        $pdf->Cell((55 / 190) * $width, $h, " (-) Descontos / Abatimentos", "TLR", 1);

        $pdf->SetFont("Arial", 'B', $fontSize);
        $pdf->Cell((45 / 190) * $width, $h, "Cobrança Simples ECR", "L");
        $pdf->Cell((15 / 190) * $width, $h, $boleto->getEspecieDoc(), "L");
        $pdf->Cell((45 / 190) * $width, $h, "", "L");
        $pdf->Cell((30 / 190) * $width, $h, "", "L");
        $pdf->Cell((55 / 190) * $width, $h, "", "LR", 1);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(135 / 190 * $width, $h * 8, "", "TLRB");

        $pdf->SetXY($x, $y);

        $pdf->SetFont("Arial", '', $fontSize);
        $pdf->Cell((135 / 190) * $width, $h, "Instru??es (Texto de responsabilidade do beneficiário)");
        $pdf->Cell((55 / 190) * $width, $h, " (-) Outras dedu??es", "TLR", 1);
        $pdf->Cell((135 / 190) * $width, $h, "");
        $pdf->Cell((55 / 190) * $width, $h, "", "LR", 1);

        $pdf->Cell((135 / 190) * $width, $h, "Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.");
        $pdf->Cell((55 / 190) * $width, $h, "(+) Mora / Multa", "TLR", 1);
        $pdf->Cell((135 / 190) * $width, $h, "Não receber após o vencimento.");
        $pdf->Cell((55 / 190) * $width, $h, "", "LR", 1);

        $pdf->Cell((135 / 190) * $width, $h, "");
        $pdf->Cell((55 / 190) * $width, $h, "(+) Outros acréscimos", "TLR", 1);
        $pdf->Cell((135 / 190) * $width, $h, "");
        $pdf->Cell((55 / 190) * $width, $h, "", "LR", 1);

        $pdf->Cell((135 / 190) * $width, $h, "");
        $pdf->Cell((55 / 190) * $width, $h, "(+) Mora / Multa", "TLR", 1);
        $pdf->Cell((135 / 190) * $width, $h, "");
        $pdf->Cell((55 / 190) * $width, $h, "", "BLR", 1);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell($width, $h * 5, "", "LRB");

        $pdf->SetXY($x, $y);
        $pdf->Cell((190 / 190) * $width, $h, "Pagador", 0, 1);

        $pdf->SetFont("Arial", 'B', $fontSize);
        $pdf->Cell((100 / 190) * $width, $h, $sacado->getNome(), 0, 0);
        $pdf->Cell((90 / 190) * $width, $h, $sacado->getDocumento(), 0, 1);

        $pdf->Cell((190 / 190) * $width, $h, $sacado->getEndereco(), 0, 1);
        $pdf->Cell((190 / 190) * $width, $h, $sacado->getCepCidadeUf(), 0, 1);

        $pdf->Ln(4);
        $pdf->SetFont("Arial", '', $fontSize);
        $pdf->Cell((100 / 190) * $width, $h, "Pagador / Avalista", 0, 0);
        $pdf->SetFont("Arial", 'B', $fontSize);
        $pdf->Cell((90 / 190) * $width, $h, "Autenticaçãoo mecânica - Ficha de Compensação", 0, 1, "R");

        $bars = self::getBars($boleto->getData()['codigo_barras']);

        foreach ($bars as $bar) {
            $fill = explode(' ', $bar)[0] == "black";
            $size = (explode(' ', $bar)[1] == "thin") ? 0.3 : 0.9;

            $pdf->Cell($size, 12, "", 0, 0, "", $fill);
        }

        $pdf->Ln(18);
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
