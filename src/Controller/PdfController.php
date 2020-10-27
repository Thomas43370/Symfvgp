<?php

namespace App\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\LesvgpVgp;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PdfController extends AbstractController
{
    /**
     * @Route("Espace-Client/Pdf", name="Espace-Client_Pdf")
     */
    public function index(SessionInterface $session)
    {

        $prepa=$session->get('prepa', []);
                // Configure Dompdf according to your needs
              /*  $pdfOptions = new Options();
                $pdfOptions->set('defaultFont', 'Arial');
                
                // Instantiate Dompdf with our options
                $dompdf = new Dompdf($pdfOptions);
                
                // Retrieve the HTML generated in our twig file
                $html = $this->renderView('default/mypdf.html.twig', [
                    'title' => "Welcome to our PDF Test"
                ]);
                
                // Load HTML to Dompdf
                $dompdf->loadHtml($html);
                
                // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
                $dompdf->setPaper('A4', 'portrait');
        
                // Render the HTML as PDF
                $dompdf->render();
        
                // Output the generated PDF to Browser (inline view)
                $dompdf->stream("mypdf.pdf", [
                    "Attachment" => false
                ]);*/
    }
            
}
