<div style="width: 863px">
        <div style="float: left">
            <table class="table-boleto" style="width: 180px" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
                        <div class="titulo">Vencimento</div>
                        <div class="conteudo"><?php echo $data_vencimento ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="titulo">Agência/Código do Beneficiário</div>
                        <div class="conteudo"><?php echo $agencia_codigo_cedente ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="titulo">Nosso número</div>
                        <div class="conteudo"><?php echo $nosso_numero ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="titulo">Nº documento</div>
                        <div class="conteudo"><?php echo $numero_documento ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="titulo">Espécie</div>
                        <div class="conteudo"><?php echo $especie ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="titulo">Quantidade</div>
                        <div class="conteudo"><?php echo $quantidade ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="titulo">(=) Valor Documento</div>
                        <div class="conteudo"><?php echo $valor_documento ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="titulo">(-) Descontos / Abatimentos</div>
                        <div class="conteudo"><?php echo $desconto_abatimento ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="titulo">(-) Outras deduções</div>
                        <div class="conteudo"><?php echo $outras_deducoes ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="titulo">(+) Mora / Multa</div>
                        <div class="conteudo"><?php echo $mora_multa ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="titulo">(+) Outros acréscimos</div>
                        <div class="conteudo"><?php echo $outros_acrescimos ?></div>
                    </td>
                </tr>
                <tr>
                    <td class="">
                        <div class="titulo">(=) Valor cobrado</div>
                        <div class="conteudo"><?php echo $valor_cobrado ?></div>
                    </td>
                </tr>
                <tr>
                    <td class="">
                        <div class="titulo">CNPJ do Beneficiário</div>
                        <div class="conteudo"><?php echo $cedente_cpf_cnpj ?></div>
                    </td>
                </tr>
                <tr>
                    <td class="bottomborder" style="overflow: hidden">
                        <div class="titulo">Endereço do Beneficiário</div>
                        <div class="conteudo"><?php echo $cedente_endereco1 ?></div>
                    </td>
                </tr>
            </table>
        <span class="header">Recibo do Pagador</span>
        </div>
        <div style="float: left; margin-left: 15px">
            <!-- Ficha de compensação -->
            @include('ficha-compensacao')
        </div>
        <div style="clear: both"></div>
        <div class="linha-pontilhada">Corte na linha pontilhada</div>
    </div>