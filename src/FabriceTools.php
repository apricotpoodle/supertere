<?php

namespace App;

Class FabriceTools
{
    /**
     * Unifie récursivement la hauteur de casse des clefs
     * d'un tableau associatif.
     *
     * @param array $arr - tableau associatif aux clefs
     *                   de différentes hauteur de casse.
     * @param int   $c   - constante de type de hauteur de casse
     *
     * @return array
     */
    public static function arrayChangeKeyCaseUnicodeRecurs(
        array $arr,
        int $c = CASE_LOWER
    ) {
        foreach ($arr as $k => $v) {
            $ret[
                    mb_convert_case(
                        $k,
                        (($c === CASE_LOWER) ? MB_CASE_LOWER : MB_CASE_UPPER),
                        "UTF-8"
                    )
                ] = (
                    is_array($v) ?
                    self::arrayChangeKeyCaseUnicodeRecurs($v, $c) : $v
                );
        }
        return $ret;
    }
    /**
     * Formate un nom de fichier :
     *  - Ni accent & ni apostrophe : noAccentString(chaine).
     *  - Pas d'espace              : remplacement par un tiret.
     *
     * @param string $chaine - contient les accents
     *
     * @return string - nom de fichier formaté
     */
    static function noAccentFileName($chaine = "")
    {
        return strtr(
            // * Ôte accents sur caractère et apostrophe.
            utf8_decode(self::noAccentString($chaine)),
            // remplace espace
            // par un tiret pour les noms de fichiers
            utf8_decode(
                " "
            ),
            utf8_decode(
                "-"
            )
        );
    }
    /**
     * Ôte les accents d'une chaîne de caractères
     * Formate une chaîne de caractères :
     *  - Pas d'accent     : remplacement par son équivalent non accentué.
     *  - Pas d'apostrophe : remplacement par un tiret.
     *
     * @param string $chaine - Chaîne avec des caractères accentués
     *
     * @return string  - chaîne sans accent
     */
    static function noAccentString($chaine = "")
    {
        return strtr(
            utf8_decode($chaine),
            utf8_decode(
                "ÀÁÂÃÄÅÇÑñÇçÈÉÊËÌÍÎÏÒÓÔÕÖØÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöøùúûüýÿ'’"
            ),
            utf8_decode(
                "AAAAAACNnCcEEEEIIIIOOOOOOUUUUYaaaaaaceeeeiiiiooooooouuuuyy--"
            )
        );
    }
}