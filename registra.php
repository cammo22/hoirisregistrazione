<?php
// Assicurati che la richiesta sia di tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Estrai i dati dal POST
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $data_nascita = $_POST['data_nascita'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $indirizzo = $_POST['indirizzo'];
    $cap = $_POST['cap'];
    $civico = $_POST['civico'];

    // Crea un ID univoco a 4 cifre e verifica che non sia già in uso
    $uniqueId = rand(1000, 9999);
    $folderName = "clienti/$uniqueId-{$nome}_{$cognome}";
    while (file_exists($folderName)) {
        $uniqueId = rand(1000, 9999);
        $folderName = "clienti/$uniqueId-{$nome}_{$cognome}";
    }

    // Crea il nome del file all'interno della cartella
    $fileName = $folderName . "/dati.txt";

    // Assicurati che la cartella esista o creala
    if (!file_exists($folderName)) {
        mkdir($folderName, 0777, true);
    }

    // Crea il contenuto del file
    $content = "Nome: $nome\nCognome: $cognome\nData di Nascita: $data_nascita\nEmail: $email\nTelefono: $telefono\nIndirizzo: $indirizzo\nCAP: $cap\nNumero Civico: $civico\n";

    // Salva il file
    file_put_contents($fileName, $content);

    // Redirect a pagina di conferma
    header("Location: conferma.html");
    exit();
} else {
    // Non permettere l'accesso diretto a questo script
    header("Location: index.html");
    exit();
}
?>
