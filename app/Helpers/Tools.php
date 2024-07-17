<?php



use App\Mail\AttachmentTicketMail;
use App\Models\Demande;
use Illuminate\Support\Facades\Mail;

if (!function_exists('sendMail')) {
    function sendMail(Demande $maDemande)
    {
        $data = [
            'title' => 'Titre de l\'e-mail',
            'body' => 'Contenu de l\'e-mail'
        ];

        $pdf = PDF::loadView('client.recuPdf', ['title' => 'Recu', 'date' => date('y-m-d'), 'maDemande' => $maDemande, 'code_demande' => $maDemande->code_demande,]);

        $attachment = [
            'name' => 'recu_paiement.pdf',
            'data' => $pdf->output()
        ];

        Mail::to('guyaristide@gmail.com')->send(new AttachmentTicketMail($data, $attachment));

        return 'E-mail envoyé avec succès avec la pièce jointe.';
    }
}
