<table class="table-boleto" cellpadding="0" cellspacing="0" border="0">
    <tbody>
    <tr>
        <td valign="bottom" colspan="8" class="noborder nopadding">
            <div class="logocontainer">
                <div class="logobanco">
                    <img src="<?php echo $logo_banco; ?>" alt="logotipo do banco">
                </div>
                <div class="codbanco"><?php echo $codigo_banco_com_dv ?></div>
            </div>
            <div class="linha-digitavel"><?php echo $linha_digitavel ?></div>
        </td>
    </tr>
    <tr>
        <td colspan="7">
            <div class="titulo">Local de pagamento</div>
            <div class="conteudo"><?php echo $local_pagamento ?></div>
        </td>
        <td width="180">
            <div class="titulo">Vencimento</div>
            <div class="conteudo rtl"><?php echo $data_vencimento ?></div>
        </td>
    </tr>
    <tr>
        <td colspan="7" rowspan="2" valign="top">
            <div class="titulo">Beneficiário</div>
            <div class="conteudo float_left"><?php echo $cedente ?><br /><?php echo $cedente_endereco1;?><br /><?php echo $cedente_endereco2;?></div>
            <div class="conteudo cpf_cnpj"><?php echo $cedente_cpf_cnpj ?></div>
            

        </td>
        <td>
            <div class="titulo">Agência/Código beneficiário</div>
            <div class="conteudo rtl"><?php echo $agencia_codigo_cedente ?></div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="titulo">Nosso número</div>
            <div class="conteudo rtl"><?php echo $nosso_numero ?></div>
        </td>
    </tr>
    <tr>
        <td width="110" colspan="2">
            <div class="titulo">Data do documento</div>
            <div class="conteudo"><?php echo $data_documento ?></div>
        </td>
        <td width="120" colspan="2">
            <div class="titulo">Nº documento</div>
            <div class="conteudo"><?php echo $numero_documento ?></div>
        </td>
        <td width="60">
            <div class="titulo">Espécie doc.</div>
            <div class="conteudo"><?php echo $especie_doc ?></div>
        </td>
        <td>
            <div class="titulo">Aceite</div>
            <div class="conteudo"><?php echo $aceite ?></div>
        </td>
        <td width="110">
            <div class="titulo">Data processamento</div>
            <div class="conteudo"><?php echo $data_processamento ?></div>
        </td>
        <td>
            <div class="titulo">(=) Valor do Documento</div>
            <div class="conteudo rtl"><?php echo $valor_documento ?></div>
        </td>
    </tr>
    <tr>
        <?php if (isset($esconde_uso_banco) && !$esconde_uso_banco) : ?>
            <td<?php if (!$mostra_cip) : ?> colspan="2"<?php endif ?>>
                <div class="titulo">Uso do banco</div>
                <div class="conteudo"><?php echo $uso_banco ?></div>
            </td>
        <?php endif; ?>

        <?php if (isset($mostra_cip) && $mostra_cip) : ?>
            <!-- Campo exclusivo do Bradesco -->
            <td width="20">
                <div class="titulo">CIP</div>
                <div class="conteudo"><?php echo $cip ?></div>
            </td>
        <?php endif ?>

        <td<?php if (isset($esconde_uso_banco) && $esconde_uso_banco) : ?> colspan="3"<?php endif; ?>>
            <div class="titulo">Carteira</div>
            <div class="conteudo"><?php echo $carteira ?></div>
        </td>
        <td width="35">
            <div class="titulo">Espécie</div>
            <div class="conteudo"><?php echo $especie ?></div>
        </td>
        <td colspan="2">
            <div class="titulo">Quantidade</div>
            <div class="conteudo"><?php echo $quantidade ?></div>
        </td>
        <td width="110">
            <div class="titulo">Valor</div>
            <div class="conteudo"><?php echo $valor_unitario ?></div>
        </td>
        <td>
            <div class="titulo">(-) Descontos / Abatimentos</div>
            <div class="conteudo rtl"><?php echo $desconto_abatimento ?></div>
        </td>
    </tr>
    <tr>
        <td colspan="7" valign="top">
            <div class="titulo">Instruções (Texto de responsabilidade do beneficiário)</div>
        </td>
        <td>
            <div class="titulo">(-) Outras deduções</div>
            <div class="conteudo rtl"><?php echo $outras_deducoes ?></div>
        </td>
    </tr>
    <tr>
        <td colspan="7" class="notopborder" valign="top">
            <div class="conteudo"><?php echo $instrucoes[0]; ?></div>
            <div class="conteudo"><?php echo $instrucoes[1]; ?></div>
        </td>
        <td>
            <div class="titulo">(+) Mora / Multa</div>
            <div class="conteudo rtl"><?php echo $mora_multa ?></div>
        </td>
    </tr>
    <tr>
        <td colspan="7" class="notopborder">
            <div class="conteudo"><?php echo $instrucoes[2]; ?></div>
            <div class="conteudo"><?php echo $instrucoes[3]; ?></div>
        </td>
        <td>
            <div class="titulo">(+) Outros acréscimos</div>
            <div class="conteudo rtl"><?php echo $outros_acrescimos ?></div>
        </td>
    </tr>
    <tr>
        <td colspan="7" class="notopborder">
            <div class="conteudo"><?php echo $instrucoes[4]; ?></div>
            <div class="conteudo"><?php echo $instrucoes[5]; ?></div>
        </td>
        <td>
            <div class="titulo">(=) Valor cobrado</div>
            <div class="conteudo rtl"><?php echo $valor_cobrado ?></div>
        </td>
    </tr>
    <tr>
        <td colspan="7" valign="top">
            <div class="titulo">Pagador</div>
            <div class="conteudo float_left"><?php echo $sacado ?><br />
            <?php echo $sacado_endereco1;?><br /><?php echo $sacado_endereco2;?></div>
            <div class="conteudo cpf_cnpj"><?php echo $sacado_documento; ?></div>
        </td>
        <td class="noleftborder">
            <div class="titulo" style="margin-top: 50px">Cód. Baixa</div>
        </td>
    </tr>

    <tr>
        <td colspan="6" class="noleftborder">
            <div class="titulo">Pagador / Avalista <div class="conteudo pagador"><?php echo $sacador_avalista; ?></div></div>
        </td>
        <td colspan="2" class="norightborder noleftborder">
            <div class="conteudo noborder rtl">Autenticação mecânica - Ficha de Compensação</div>
        </td>
    </tr>

    <tr>
        <td colspan="8" class="noborder">
            <?php echo $codigo_barras ?>
        </td>
    </tr>

    </tbody>
</table>
