<?php

    class Fungsi
    {
        protected $ci;

        function __construct()
        {
            $this->ci = &get_instance();
        }
        function user_login()
        {
            $this->ci->load->model('m_user');
            $id = $this->ci->session->userdata('id');
            $user_data = $this->ci->m_user->get($id)->row();
            return $user_data;
            # code...
        }

        function Pdfgenerator($html, $filename, $paper, $orientation)
        {
            // $options = new Dompdf\Options();
            // $options->setDefaultFont('courier');
            // $options->setIsRemoteEnabled(true);

            $dompdf = new Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper($paper, $orientation);
            // Render the HTML as PDF
            $dompdf->render();
            // Output the generated PDF to Browser
            $dompdf->stream($filename, array('Attachment' => 0));
        }
    }
