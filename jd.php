<?php
function monChiffrement($texte, $cleSecrete) {
    // Générer un IV de 16 octets
    $iv = openssl_random_pseudo_bytes(16);

    // Chiffrer le texte
    $texteChiffre = openssl_encrypt($texte, 'aes-256-cbc', $cleSecrete, 0, $iv);

    // Réduire la taille du texte chiffré à 10 caractères
    $texteChiffreCourt = substr($texteChiffre, 0, 10);

    return $texteChiffreCourt;
}

// Exemple d'utilisation
$donneeOriginale = "Données confidentielles à protéger";
$cleSecrete = "MaCleSecrete123";

$donneeChiffree = monChiffrement($donneeOriginale, $cleSecrete);
echo "Données chiffrées (réduites) : " . $donneeChiffree;


function monDechiffrement($texteChiffre, $cleSecrete) {
    $texteChiffreBase64 = base64_decode($texteChiffre);
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($texteChiffreBase64, -$ivSize);
    $texteChiffreCourt = substr($texteChiffreBase64, 0, -$ivSize);
    $texteDechiffre = openssl_decrypt($texteChiffreCourt, 'aes-256-cbc', $cleSecrete, 0, $iv);
    return $texteDechiffre;
}

$donneeDechiffree = monDechiffrement($donneeChiffree, $cleSecrete);
echo "Données déchiffrées : " . $donneeDechiffree;
?>