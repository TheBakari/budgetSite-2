<?php
    
    require_once('pdf/WriteHTML.php');
    require_once("require.php");//poziv iz require.php stranice
    session_start();
    $db=new Baza(); //povezivanje sa bazom
    $db->connect(); //konekcija za bazon

    //potrebno da prikazivanje
    $pdf= new PDF_HTML();
    $pdf->AddPage();//pravljenje stranice
    $pdf->SetFont('Arial','',11);// font, kakv je izgled (b, i, u) font size 
    
    
    $pdf->AliasNbPages();
    //$pdf->Cell(58,5,'026ETY ',1,1 );//sirina, visina, text, border, nova linija, text align// ako necemo nesto stavimo 0
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $id=(intval($id));
        if(is_int($id))
        {
        $upit="SELECT * FROM recept WHERE idRecept={$id}";
            $rez=$db->query($upit);
            while($red=$db->fetch_object($rez))
            {
                //Logo stranice
                $pdf->SetFont('Arial','b',20);
                $pdf->Cell(190,30,"Budget bytes",0,1,'C');
                $pdf->Ln(10);
                
                //Naslov Recepta
                $pdf->Cell(190,30,$red->headRecept,0,1,'C');
                $pdf->Ln(10);

                $pdf->SetFont('Arial','b',20);
                $pdf->Cell(190,10,"DESCRIPTION",0,1,'C');
                $pdf->Ln(10);

                $pdf->SetFont('Arial','',11);
                $html=$red->descriptionRecept;
                $pdf->WriteHTML($html);
                $pdf->Ln(10);
            /* //Opis recepta
                $pdf->Cell(190,30,$red->descriptionRecept,0,1);
                $pdf->Ln(10);
                //Sastojci recepta
                $pdf->Cell(190,30,$red->ingredientsRecept,0,1);
                $pdf->Ln(10);
                //Instrukcije kako se poravi
                $pdf->Cell(190,30,$red->instructionRecept,0,1);
                $pdf->Ln(10);*/
                $pdf->SetFont('Arial','b',20);
                $pdf->Cell(190,10,"INGREDIENTS",0,1,'C');
                $pdf->Ln(10);

                $pdf->SetFont('Arial','',11);
                $html=$red->ingredientsRecept;
                $pdf->WriteHTML($html);
                $pdf->Ln(10);

                $pdf->SetFont('Arial','b',20);
                $pdf->Cell(190,10,"INSTRUCTION",0,1,'C');
                $pdf->SetFont('Arial','',11);
                $html=$red->instructionRecept;
                $pdf->WriteHTML($html);

                $html="<br><br><a href='index.php class='pdf_dugne'> Back to home page</a>";
                $pdf->WriteHTML($html); 
                $pdf->OutPut();
            }
        }
    }
    

   
   
?>