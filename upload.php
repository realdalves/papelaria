<?php
// Caminho do arquivo local que você deseja fazer o upload
$filePath = 'caminho/do/seu/arquivo/local.txt';
$bucketURL = 'https://gravatairecargas.s3.us-east-2.amazonaws.com/papelariagravatai/arquivo-no-s3.txt';

// Inicializando cURL
$ch = curl_init();

// Configurando o URL do bucket S3
curl_setopt($ch, CURLOPT_URL, $bucketURL);

// Usando o método PUT
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

// Definir o arquivo local para upload
curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($filePath));

// Definir o cabeçalho do conteúdo
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/octet-stream',
    'x-amz-acl: public-read' // Se você quiser tornar o arquivo público, caso contrário, remova isso
));

// Executando o cURL
$response = curl_exec($ch);

// Fechando o cURL
curl_close($ch);

// Exibindo o resultado
if ($response === false) {
    echo 'Erro ao fazer upload do arquivo: ' . curl_error($ch);
} else {
    echo 'Upload bem-sucedido!';
}
?>
