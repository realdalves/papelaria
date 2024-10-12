<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclui o autoload do Composer para carregar as classes do PHPMailer
require 'vendor/autoload.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $message = $_POST['message'];

    // Verifica se todos os campos estão preenchidos
    if (!empty($name) && !empty($email) && !empty($phoneNumber) && !empty($message)) {
        $mail = new PHPMailer(true); // Cria uma nova instância do PHPMailer
        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Servidor SMTP (substitua pelo seu provedor)
            $mail->SMTPAuth = true;
            $mail->Username = 'diegoalves.nasa@gmail.com.br'; // Seu e-mail
            $mail->Password = 'olimpico10G*'; // Sua senha ou App Password (recomendado para Gmail)
            $mail->SMTPSecure = 'tls'; // TLS ou SSL
            $mail->Port = 587; // Porta para TLS (use 465 para SSL)

            // Remetente e destinatário
            $mail->setFrom($email, $name); // Remetente do e-mail
            $mail->addAddress('diegoalves.nasa@gmail.com.br'); // E-mail do destinatário

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Nova mensagem de contato';
            $mail->Body = "
                <h2>Nova mensagem de contato</h2>
                <p><strong>Nome:</strong> {$name}</p>
                <p><strong>E-mail:</strong> {$email}</p>
                <p><strong>Telefone:</strong> {$phoneNumber}</p>
                <p><strong>Mensagem:</strong><br>{$message}</p>
            ";

            // Enviar o e-mail
            $mail->send();
            echo "Mensagem enviada com sucesso!";
        } catch (Exception $e) {
            echo "Erro ao enviar a mensagem: {$mail->ErrorInfo}";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
