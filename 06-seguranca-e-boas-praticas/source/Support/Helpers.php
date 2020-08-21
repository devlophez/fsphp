<?php

/**
 * ##################
 * ###   STRING   ###
 * ##################
 */

/**
 * captura uma string qualquer e transforma isso em url
 * @param string $string
 * @return string
 */
function str_slug(string $string): string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    /**
     * trim() é para tratar espaços desnecessários
     * strtr(fonte de dados, fonte de substituição, pelo quê substituir) é para fazer a susbtituição dos caracteres
     * utf8_decode() é para manter as letras após as retiradas dos acentos
     * str_replace() é para substituir, nesse exemplo, o espaço pelo traço
     */

    $slug = str_replace(
        [
            "-----",
            "----",
            "---",
            "--",
        ],
        "-",
        str_replace(
            " ",
            "-",
            trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
        )
    );
    return $slug;
}

/**
 * converter uma requisição em um nome de classe e compor um mvc
 */

/**
 * @param string $string
 * @return string
 */
function str_studly_case(string $string): string
{
    $string = str_slug($string);
    $studlyCase = str_replace(" ", "",
        mb_convert_case(str_replace("-", " ", $string), MB_CASE_TITLE)
    );
    return $studlyCase;
}

/**
 * tratar nome de métodos
 */

/**
 * @param string $string
 * @return string
 */
function str_camel_case(string $string): string
{
return lcfirst(str_studly_case($string));
}