<?php

/*
 * Copyright (C) 2019 Leda Ferreira
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace cbr724;

/**
 * \cbr724\CBR724.
 */
class CBR724
{
    /**
     * Códigos de Ocorrência - Banco do Brasil
     * @var array
     */
    public static $codigosOcorrencia = [
        'AB'  => 'Abatimento autorizado',
        'ABC' => 'Abatimento cancelado',
        'BX'  => 'Baixado conforme instruções',
        'BXA' => 'Baixado-liquidado anteriormente (motivo 31)',
        'BXC' => 'Baixado-alteração de cedente',
        'BXF' => 'Baixado-autorizada a entrega franco de pagamento',
        'BXH' => 'Baixado-habilitado em processo (motivo 32)',
        'BXI' => 'Baixado-incobrável por nosso intermédio (motivo 33-Instrução)',
        'BXL' => 'Baixado-em transferência para créditos em liquidação(motivo 34)',
        'BXM' => 'Baixado-mudança em carteira',
        'BXP' => 'Baixado-protestado (motivo 15)',
        'BXR' => 'Baixado-remanejamento de cliente',
        'BXS' => 'Baixado-automaticamente pelo Sistema (venc. s/solução–motivo 90)',
        'BXT' => 'Baixado-registrado indevidamente (motivo 51)',
        'BXV' => 'Baixado-alteração de variação',
        'CB'  => 'Alteração de agência cobradora',
        'CGC' => 'Alteração de CNPJ/CPF do sacado',
        'DB'  => 'Debitado em sua conta por falta de pagamento',
        'DBT' => 'Debitado em sua conta conforme instruções',
        'DCA' => 'Débito de custas cartorárias antecipadas',
        'DDP' => 'Despesa de protesto',
        'DDS' => 'Despesa de sustação de protesto',
        'DSP' => 'Disponibilidade de empréstimos transferida',
        'EMS' => 'Alteração da data de emissão do título',
        'END' => 'Alteração do endereço do sacado',
        'INS' => 'Acolhimento de instrução sobre cobrança',
        'IOF' => 'Alteração do valor do IOF de seguro',
        'LCA' => 'Liquidado com cheque pendente de compensação',
        'LCC' => 'Liquidado em cartório com cheque',
        'LCD' => 'Liquidado em cartório com dinheiro',
        'LCE' => 'Liquidação não efetuada – Cheque devolvido',
        'LCH' => 'Liquidado com cheque a compensar',
        'LPB' => 'Liquidação compartilhada na compensação',
        'LPH' => 'Liquidação compartilhada com cheque a compensar',
        'LPD' => 'Liquidação compartilhada em dinheiro',
        'LQ'  => 'Liquidado',
        'LQA' => 'Liquidado-baixado anteriormente',
        'LQB' => 'Liquidado em outro banco (Compe)',
        'LQC' => 'Liquidado em cartório',
        'LQF' => 'Liquidado após feriado não previsto ou local',
        'LQN' => 'Liquidado na apresentação',
        'LQP' => 'Liquidado parcialmente',
        'LQR' => 'Liquidado sem registro',
        'LQS' => 'Liquidado pelo saldo',
        'MTV' => 'Manutenção mensal de título vencido',
        'NCP' => 'Alteração do controle do participante',
        'REL' => 'Levantamento de títulos',
        'RG'  => 'Registrado para cobrança',
        'RGC' => 'Registrado para cobrança - transferido de outro cedente',
        'RGM' => 'Registrado para cobrança - alteração de carteira',
        'RGP' => 'Registrado para cobrança com instrução de protesto',
        'RGR' => 'Registrado para cobrança - remanejamento de cliente',
        'RGV' => 'Registrado para cobrança - transferido de outra variação',
        'RV'  => 'Revertido à conta 1 - pendência regularizada',
        'RVP' => 'Revertido à conta 1 - prazo regularizado',
        'SAC' => 'Alteração do nome do sacado',
        'SN'  => 'Alteração do seu número',
        'SUS' => 'Instrução para sustar protesto',
        'TEC' => 'Título encaminhado a cartório',
        'TR'  => 'Transferido para a conta 2',
        'VC'  => 'Alteração do vencimento',
    ];

    /**
     * Códigos de Operação - Banco do Brasil
     * @var array
     */
    public static $codigosOperacao = [
        'A' => 'abatimento concedido',
        'B' => 'soma dos valores compartilhados',
        'D' => 'valor recebido do convênio compartilhador',
        'E' => 'comissão de permanência',
        'F' => 'desconto concedido',
        'G' => 'tarifa pelo registro de título',
        'H' => 'tarifa pela baixa/devolução de título',
        'I' => 'IOF',
        'J' => 'juros de mora',
        'K' => 'devolução de custas antecipadas',
        'M' => 'desconto calculado',
        'N' => 'abatimento não aproveitado',
        'P' => 'pagamento parcial',
        'R' => 'recebimentos diversos',
        'S' => 'complemento de IOF',
        'T' => 'reajuste',
        'U' => 'multa contratual',
        'W' => 'débito de diferença de encargos pós-fixados',
        'X' => 'comissão de permanência não paga pelo sacado',
        'Y' => 'crédito de diferença de encargos pós-fixados',
        'Z' => 'salário de contribuição do FNDE',
    ];

    /**
     * @var string
     */
    private $header;

    /**
     * @var array
     */
    private $lines;

    /**
     * @var string
     */
    private $text;

    /**
     * @var array
     */
    private $sections;

    /**
     * Parses a CBR724-formatted text file.
     * @param string $file
     * @return void
     */
    public function parseFile($file)
    {
        $text = file_get_contents($file);
        $this->parseText($text);
    }

    /**
     * Parses a CBR724-formatted text.
     * @param type $text
     * @return void
     */
    public function parseText($text)
    {
        $this->text = $text;
        $this->lines = preg_split('/\R/', $text);
        $this->header = array_shift($this->lines);
        $this->process();
    }

    /**
     * Parses the file header.
     * @return array
     */
    private function parseHeader()
    {
        $map = [
            1 => 'trail',
            2 => 'formato',
            3 => 'agencia',
            4 => 'conta',
            5 => 'convenio',
            6 => 'unknown',
        ];

        $pattern = '/^(\d{6})(.{6})(\d{4})(\d{9})(\d{7})(\d*).*$/';
        preg_match_all($pattern, $this->header, $matches);

        $result = [];
        foreach ($map as $index => $column) {
            $result[$column] = trim($matches[$index][0]);
        }

        return $result;
    }

    /**
     * Parses generic strings.
     * @param string $text
     * @return array
     */
    private function parseDefault($text)
    {
        return array_filter(
            explode('  ', preg_replace('/(\s{2,})/', '  ', $text))
        );
    }

    /**
     * Parses data entries.
     * @param string $text
     * @return array
     */
    private function parseCode7($text)
    {
        $map = [
            1 => 'nosso_numero',
            2 => 'numero_documento',
            3 => 'nome_sacado',
            4 => 'data_vencimento',
            5 => 'data_ocorrencia',
            6 => 'agencia_cobradora',
            7 => 'codigo_ocorrencia',
            8 => 'valor_titulo',
            9 => 'alteracao_valor',
            10 => 'tarifa',
            11 => 'valor_liquido',
        ];

        $pattern = '/^ ' . implode(' ', [
            '(\d{17})',
            '(.{12})',
            '(.{28})',
            '(\d{8})',
            '(.{4})',
            '(.{5})',
            '(.{3})',
            '(.{19})',
            '(.{18})',
            '(.{9})',
            '(.*)',
        ]) . '/';
        preg_match_all($pattern, $text, $matches);

        $result = [];
        foreach ($map as $index => $column) {
            $value = $result[$column] = trim($matches[$index][0]);
            if ($column === 'codigo_ocorrencia') {
                $result['descricao_ocorrencia'] = self::$codigosOcorrencia[$value];
            } elseif ($value && $column === 'data_vencimento') {
                $result[$column] = new \DateTime(fix_date($value));
            } elseif ($value && $column === 'data_ocorrencia') {
                $result[$column] = new \DateTime(fix_short_date($value));
            } elseif ($value && ($column === 'alteracao_valor' || $column === 'valor_liquido')) {
                $operacao = substr($value, -1);
                if (array_key_exists($operacao, self::$codigosOperacao)) {
                    $result[$column] = [
                        'valor' => substr($value, 0, -1),
                        'codigo_operacao' => $operacao,
                        'descricao_operacao' => self::$codigosOperacao[$operacao],
                    ];
                }
            }
        }

        return $result;
    }

    /**
     * Parses sub-header.
     * @param string $text
     * @return array
     */
    private function parseCode11($text)
    {
        $map = [
            1 => 'agencia',
            2 => 'conta',
            3 => 'carteira',
            4 => 'variacao',
            5 => 'formato'
        ];

        $pattern = '/^.(\d{4})(\d{9})(\d{3})(\d{3})(.{6}).*$/';
        preg_match_all($pattern, $text, $matches);

        $result = [];
        foreach ($map as $index => $column) {
            $result[$column] = trim($matches[$index][0]);
        }

        return $result;
    }

    /**
     * Returns the most appropriate parser method for the specified code.
     * @param string $code
     * @return string
     */
    private function getParser($code) {
        $parsers = [
            '7' => 'parseCode7',
            '11' => 'parseCode11'
        ];

        return isset($parsers[$code]) ? $parsers[$code] : 'parseDefault';
    }

    /**
     * TODO: document this.
     * @return void.
     */
    private function process()
    {
        $sections = [
            'header' => $this->parseHeader(),
        ];

        foreach ($this->lines as $line) {
            $code = trim(substr($line, 0, 2));
            $parseFunction = $this->getParser($code);
            $sections[$code][] = $this->{$parseFunction}(substr($line, 2));
        }

        $this->sections = $sections;
    }

    /**
     * Returns the account number.
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->sections[28][0][1] ?? null;
    }

    /**
     * Returns the bank agency.
     * @return string
     */
    public function getBankAgency()
    {
        return $this->sections[28][0][3] ?? null;
    }

    /**
     * Returns the address' components.
     * @return array
     */
    public function getCompanyAddress()
    {
        if (isset($this->sections[-8])) {
            return [
                'logradouro' => $this->sections[-8][0][1] ?? null,
                'cidade' => $this->sections[-8][1][2] ?? null,
                'cep' => $this->sections[-8][1][1] ?? null,
                'uf' => $this->sections[-8][1][3] ?? null,
            ];
        }
        return null;
    }

    /**
     * Returns the customer's name.
     * @return string
     */
    public function getCompanyName()
    {
        return $this->sections[28][2][1] ?? null;
    }

    /**
     * Returns the file's creation date.
     * @return \DateTime|null
     */
    public function getCreationDate()
    {
        if (isset($this->sections[28][0][6])) {
            return new \DateTime(fix_date($this->sections[28][0][6]));
        }
        return null;
    }

    /**
     * Returns the header.
     * @return array
     */
    public function getHeader()
    {
        return $this->sections['header'] ?? null;
    }

    /**
     * Returns the sub-header.
     * @return array
     */
    public function getSubHeader()
    {
        return $this->sections[11][0] ?? null;
    }

    /**
     * Returns the list of records.
     * @return array
     */
    public function getListOfRecords()
    {
        return $this->sections[7] ?? null;
    }

    /**
     * Returns the UF.
     * @return string
     */
    public function getState()
    {
        return $this->sections[28][2][4] ?? null;
    }

    /**
     * Returns the wallet number and type.
     * @return string
     */
    public function getWalletNumber()
    {
        return $this->sections[28][0][2] ?? null;
    }
}
