<?php
if(isset($_POST['cotizacion'])) // Condicional para generar formulario con IVA por medio del metodo POST
{
require('fpdf.php');
// Segunda página
class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';
function WriteHTML($html)
{
    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0
)        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}
function OpenTag($tag, $attr)
{
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}
function CloseTag($tag)
{
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}
function SetStyle($tag, $enable)
{
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}
function contadorvisitas()
    {
        $archivo = "contador.txt"; //el archivo de texto que contendra el numero de visitas
        $f = fopen($archivo, "r"); //abrimos el fichero en modo de lectura
        if($f)
        {
            $contadorvisitas = fread($f, filesize($archivo)); //vemos el archivo de texto
            $contadorvisitas = $contadorvisitas + 1; //Le sumamos +1 al contador de visitas
            fclose($f);
        }
        $f = fopen($archivo, "w+");
        if($f)
        {
            fwrite($f, $contadorvisitas);
            fclose($f);
        }
    
        return $contadorvisitas;
    }
    
    function contadorvisitas2()
    {
        $archivo = "contador.txt"; //el archivo de texto que contendra el numero de visitas
        $f = fopen($archivo, "r"); //abrimos el fichero en modo de lectura
        if($f)
        {
            $contadorvisitas2 = fread($f, filesize($archivo)); //vemos el archivo de texto
            $contadorvisitas2 = $contadorvisitas2 * 1; //Le sumamos +1 al contador de visitas
            fclose($f);
        }
        $f = fopen($archivo, "w+");
        if($f)
        {
            fwrite($f, $contadorvisitas2);
            fclose($f);
        }
    
        return $contadorvisitas2;
    }
    
     function contadorvisitas3()
    {
        $archivo = "contador.txt"; //el archivo de texto que contendra el numero de visitas
        $f = fopen($archivo, "r"); //abrimos el fichero en modo de lectura
        if($f)
        {
            $contadorvisitas3 = fread($f, filesize($archivo)); //vemos el archivo de texto
            $contadorvisitas3 = $contadorvisitas3 * 1; //Le sumamos +1 al contador de visitas
            fclose($f);
        }
        $f = fopen($archivo, "w+");
        if($f)
        {
            fwrite($f, $contadorvisitas3);
            fclose($f);
        }
    
        return $contadorvisitas3;
    }
// Cabecera de página

     function TablaColores()
{
//Colores, ancho de línea y fuente en negrita
     $this->SetDrawColor(5,5,5);//Color bordes de la tabla
     $this->SetLineWidth(.2);//Ancho de los bordes
     $this->SetFont('helvetica','', 10);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
     $this->SetFillColor(255,255,255);//color texto
     $this->SetTextColor(20);//Opacidad del texto
//Datos
        $this->Image('images/Cotizaciones/play-4-1.jpg',0,0,210);//imagen imagen principal  margen izq / altura top / tamaño
         $this->Image('images/logo.png',-1,0,50);//imagen imagen principal  margen izq / altura top / tamaño
         $this->SetTextColor(255,255,255);//Opacidad del texto

$this->Ln(110);//salto de linea
$this->SetFont('helvetica','B',16);//letra:   tipo / negrita / tamaño
$this->Cell(190,12,'COTIZACION PARA:',0,0,'L'); // Variable que trae el campo "nombre"
$this->Ln(9);//salto de linea
$this->SetFont('helvetica','',13);//letra:   tipo / negrita / tamaño
$this->Cell(190,12,''.$_POST['nombre'].' '.$_POST['apellido'],0,0,'L'); // Variable que trae el campo "nombre"
$this->Ln(7);//salto de linea
$this->Cell(190,10,''.$_POST['telefono'],0,0,'L');// Variable que trae el campo "telefono"
         $this->Ln(7);//salto de linea
$this->Cell(190,10,''.$_POST['correo'],0,0,'L');// Variable que trae el campo "telefono"
$this->Ln(10);//salto de linea
$this->SetFont('helvetica','B',16);//letra:   tipo / negrita / tamaño
$this->Cell(190,12,'ELABORADA POR:',0,0,'L'); // Variable que trae el campo "nombre"
$this->Ln(9);//salto de linea
$this->SetFont('helvetica','',13);//letra:   tipo / negrita / tamaño
$this->Cell(190,10,utf8_decode('Felipe Salas'),0,0,'L');// Variable que trae el campo "telefono"
$this->Ln(6);//salto de linea
$this->Cell(190,10,'Asesor De Ventas',0,0,'L');// Variable que trae el campo "telefono"
$fill=true;
$this->SetFont('helvetica','',18);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$this->Ln(48);//salto de linea
$this->cell(110,5,'           315 739 9574',0,'','L',0,'https://api.whatsapp.com/send?phone=573157399574&text=Hola,%20vi%20la%20cotizacion%20y%20estoy%20interesado');//Vinculo bases y soportes
         $this->cell(185,5,' storegamerplus@gmail.com',0,'','L',0,'mailto:storegamerplus@gmail.com');//Vinculo bases y soportes






}     
    function Footer()
{   
    $this->SetY(-8); // Posición: a 1,5 cm del final    
    $this->SetFont('helvetica','I',13);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
        $this->cell(90,5,'Consolas De Calidad Garantizadas',0,'','L',0);//Vinculo bases y soportes
   $this->cell(40,5,'       315 739 9574 -',0,'','L',0,'https://api.whatsapp.com/send?phone=573157399574&text=Hola,%20vi%20la%20cotizacion%20y%20estoy%20interesado');//Vinculo bases y soportes
         $this->cell(50,5,'  storegamerplus@gmail.com',0,'','L',0,'mailto:storegamerplus@gmail.com');//Vinculo bases y soportes
}
    
}

    $pdf = new PDF();
//-----------PAGINA # 1 Arriba Portada------------//
    $pdf->AddPage();
    $pdf->SetY(65);
    $pdf->TablaColores();
    $pdf->SetLeftMargin(10);
    $pdf->SetFontSize(11);
    
    

    
    
    
    
    
    
//-------------------------------------------PAGINA # 2--------------------------------------------//
    
    
    
    
    
     $pdf->AddPage3();
    $pdf->SetY(37);
$pdf->Image('images/Cotizaciones/play-4-2.jpg',0,0,210);//imagen Linea del footer  margen izq / altura top / tamaño
$pdf->SetFont('helvetica','',12);//letra:   tipo / negrita / tamaño
$fill=false;
$fill=!$fill;   
     $pdf->SetTextColor(6,47,72);//Opacidad del texto
    $pdf->SetFont('helvetica','B',35);//letra:   tipo / negrita / tamaño
       $pdf->SetTextColor(255,255,255);//Opacidad del texto
$pdf->cell(11,5,'                       CARACTERISTICAS',0,'','L',0,'');//Vinculo bases y soportes
$pdf->Ln(-10);//salto de linea
        $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita / tamaño
$pdf->Cell(190,12,utf8_decode('  Cotización          N° - ').$pdf->contadorvisitas().'',0,0,'L');// contador/ consecutivo
$pdf->Ln(8);//salto de linea
    $pdf->Cell(190,12,utf8_decode('  Fecha           ') . date('d') . ' / '. date('m'). ' / '. date('Y'), 0,0,'L');//fecha:    d=dia  /  F=mes  / Y=año
$pdf->Ln(36);//salto de linea
$fill=true;
    $pdf->SetTextColor(0,0,0);//Opacidad del texto
    $pdf->SetFont('helvetica','B', 15);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño

    $pdf->Write(8,utf8_decode('LA '));
     $pdf->SetTextColor(64,64,65);//Opacidad del texto
    $pdf->Ln(10);//salto de linea  
    $pdf->SetFont('helvetica','', 12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
      $pdf->Write(12,utf8_decode('Es la cuarta videoconsola del modelo PlayStation.
Es la segunda consola de Sony en ser diseñada 
por Mark Cerny y forma parte de las videoconsolas 
de octava generación. Fue anunciada oficialmente
el 20 de febrero de 2013 en el evento PlayStation
Meeting 2013, aunque el diseño de la consola 
no fue presentado hasta el 10 de junio en el E3 
2013.102Es la sucesora de la PlayStation 3 y 
compite con Wii U y Switch de Nintendo y Xbox 
One de Microsoft. Su lanzamiento fue el 15 de
noviembre de 2013 en Estados Unidos y en Europa
y Sudamérica fue el 29 de noviembre de 2013,11
mientras que en Japón fue el 22 de febrero de 2014.'));
$pdf->Ln(35);//salto de linea
$fill=true;
         $pdf->SetTextColor(255,255,255);//Opacidad del texto
    
    
    
//-------------------------------------------PAGINA # 3 -------------------------------------------//
    
    
    
    
    
    $pdf->AddPage();
    $pdf->SetY(37);
     $pdf->Image('images/Cotizaciones/play-4-3.jpg',0,0,210);//imagen Linea del footer  margen izq / altura top / tamaño


$pdf->SetFont('helvetica','',12);//letra:   tipo / negrita / tamaño
$fill=false;
$fill=!$fill;   
     $pdf->SetTextColor(6,47,72);//Opacidad del texto
    $pdf->SetFont('helvetica','B',35);//letra:   tipo / negrita / tamaño
       $pdf->SetTextColor(255,255,255);//Opacidad del texto
$pdf->cell(11,5,'                              PRECIOS',0,'','L',0,'');//Vinculo bases y soportes
$pdf->Ln(-10);//salto de linea
        $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita / tamaño
$pdf->Cell(190,12,utf8_decode('  Cotización          N° - ').$pdf->contadorvisitas().'',0,0,'L');// contador/ consecutivo
$pdf->Ln(8);//salto de linea
    $pdf->Cell(190,12,utf8_decode('  Fecha           ') . date('d') . ' / '. date('m'). ' / '. date('Y'), 0,0,'L');//fecha:    d=dia  /  F=mes  / Y=año
$pdf->Ln(25);//salto de linea
$fill=true;


    
// ---------------------------------------------------------------------------------------//
    $pdf->SetTextColor(6,109,181);//Opacidad del texto
     $pdf->Ln(5);//salto de linea
     $pdf->SetFillColor(6,47,72);//color de la celda
    $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->Cell(50,10,utf8_decode("Producto"),1,0, 'L');
$pdf->SetTextColor(25,25,25);//Opacidad del texto
$pdf->Cell(30,10,"PlayStation 4",1,0,'L');
        $pdf->Ln(10);//salto de linea
         $pdf->SetFillColor(6,47,72);//color de la celda
           $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
         $pdf->SetTextColor(6,109,181);//Opacidad del texto
$pdf->Cell(50,10,utf8_decode("Cantidad"),1,0, 'L');
$pdf->SetTextColor(25,25,25);//Opacidad del texto
$pdf->Cell(30,10,"".$_POST['cantidad'],1,0,'L');
        $pdf->Ln(10);//salto de linea
     $pdf->SetTextColor(6,109,181);//Opacidad del texto
           $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->Cell(50,10,utf8_decode("Precio"),1,0, 'L');
$pdf->SetTextColor(25,25,25);//Opacidad del texto
$pdf->Cell(30,10,utf8_decode("$ " . number_format($_POST['precio'], 0, ',', '.')), 1, "L", 1);
            $pdf->Ln(10);//salto de linea
     $pdf->SetTextColor(6,109,181);//Opacidad del texto
           $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->Cell(50,10,utf8_decode("Subtotal"),1,0, 'L');
$pdf->SetTextColor(25,25,25);//Opacidad del texto
$pdf->Cell(30,10,utf8_decode("$ " . number_format($_POST['subtotal'], 0, ',', '.')), 1, "L", 1);
       $pdf->Ln(10);//salto de linea
     $pdf->SetTextColor(6,109,181);//Opacidad del texto
           $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->Cell(50,10,utf8_decode("Iva"),1,0, 'L');
$pdf->SetTextColor(25,25,25);//Opacidad del texto
$pdf->Cell(30,10,utf8_decode("$ " . number_format($_POST['resultadoiva'], 0, ',', '.')), 1, "L", 1);
            $pdf->Ln(10);//salto de linea
     $pdf->SetTextColor(6,109,181);//Opacidad del texto
           $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->Cell(50,10,utf8_decode("Valor Total"),1,0, 'L');
$pdf->SetTextColor(25,25,25);//Opacidad del texto
$pdf->Cell(30, 10, utf8_decode("$ " . number_format($_POST['resultadototal'], 0, ',', '.')), 1, "L", 1);


    
    
    
    
      $pdf->SetTextColor(25,25,25);//Opacidad del texto
        $pdf->Ln(40);//salto de linea
       $pdf->Cell(192,0.5,utf8_decode(''),0,0,'C','true');//linea separadora de color GRIS
 $pdf->Ln(1);//salto de linea 
        $pdf->SetFont('helvetica','',11);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
    $html =utf8_decode('
<br>
   Esta cotizacion incluye los productos mencionados en la misma.
<br>
   Cotización valida por <b>30 dias</b>.
<br>
   Incluye los servicio y productos descritos anteriormente.
<br>
   Condiciones de pago: a convenir.
<br>
   El tiempo de entrega es inmediato dependiendo disponibilidad.
   <br>'); 
    $pdf->WriteHTML($html);
 $pdf->Ln(55);//salto de linea 
    $pdf->SetFont('helvetica','B',13);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->cell(104,5,utf8_decode('     Cordialmente'));
$pdf->Ln(5);//salto de linea
        $pdf->SetFont('helvetica','B',11);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
    $pdf->cell(104,5,utf8_decode('      Felipe Salas'));
$pdf->Ln(5);//salto de linea
$pdf->SetFont('helvetica','',10);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->cell(15,5,'       TEL:',0,'','L',0,'');//Vinculo bases y soportes
$pdf->cell(180,5,'315 739 9574',0,'','L',0,'tel:3157399574');//Vinculo bases y soportes
$pdf->Ln();//salto de linea
    
$pdf->SetFont('helvetica','',10);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->cell(20,5,'       EMAIL:',0,'','L',0,'');//Vinculo bases y soportes
$pdf->cell(180,5,'storegamerplus@gmail.com',0,'','L',0,'mailto:storegamerplus@gmail.com');//Vinculo bases y soportes
$pdf->SetFont('helvetica','I',10);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
    $pdf->Ln(3);//salto de linea
            $pdf->SetTextColor(255,255,255);//Opacidad del texto
    
$pdf->Output();
}
else if(isset($_POST['cotizacion2'])) // Condicional para generar formulario con sin iva
{
require('fpdf.php');
// Segunda página
class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';
function WriteHTML($html)
{
    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0
)        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}
function OpenTag($tag, $attr)
{
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}
function CloseTag($tag)
{
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}
function SetStyle($tag, $enable)
{
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}
function contadorvisitas()
    {
        $archivo = "contador.txt"; //el archivo de texto que contendra el numero de visitas
        $f = fopen($archivo, "r"); //abrimos el fichero en modo de lectura
        if($f)
        {
            $contadorvisitas = fread($f, filesize($archivo)); //vemos el archivo de texto
            $contadorvisitas = $contadorvisitas + 1; //Le sumamos +1 al contador de visitas
            fclose($f);
        }
        $f = fopen($archivo, "w+");
        if($f)
        {
            fwrite($f, $contadorvisitas);
            fclose($f);
        }
    
        return $contadorvisitas;
    }
    
    function contadorvisitas2()
    {
        $archivo = "contador.txt"; //el archivo de texto que contendra el numero de visitas
        $f = fopen($archivo, "r"); //abrimos el fichero en modo de lectura
        if($f)
        {
            $contadorvisitas2 = fread($f, filesize($archivo)); //vemos el archivo de texto
            $contadorvisitas2 = $contadorvisitas2 * 1; //Le sumamos +1 al contador de visitas
            fclose($f);
        }
        $f = fopen($archivo, "w+");
        if($f)
        {
            fwrite($f, $contadorvisitas2);
            fclose($f);
        }
    
        return $contadorvisitas2;
    }
    
     function contadorvisitas3()
    {
        $archivo = "contador.txt"; //el archivo de texto que contendra el numero de visitas
        $f = fopen($archivo, "r"); //abrimos el fichero en modo de lectura
        if($f)
        {
            $contadorvisitas3 = fread($f, filesize($archivo)); //vemos el archivo de texto
            $contadorvisitas3 = $contadorvisitas3 * 1; //Le sumamos +1 al contador de visitas
            fclose($f);
        }
        $f = fopen($archivo, "w+");
        if($f)
        {
            fwrite($f, $contadorvisitas3);
            fclose($f);
        }
    
        return $contadorvisitas3;
    }
// Cabecera de página

     function TablaColores()
{
//Colores, ancho de línea y fuente en negrita
     $this->SetDrawColor(5,5,5);//Color bordes de la tabla
     $this->SetLineWidth(.2);//Ancho de los bordes
     $this->SetFont('helvetica','', 10);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
     $this->SetFillColor(255,255,255);//color texto
     $this->SetTextColor(20);//Opacidad del texto
//Datos
        $this->Image('images/Cotizaciones/play-4-1.jpg',0,0,210);//imagen imagen principal  margen izq / altura top / tamaño
         $this->Image('images/logo.png',-1,0,50);//imagen imagen principal  margen izq / altura top / tamaño
         $this->SetTextColor(255,255,255);//Opacidad del texto

$this->Ln(110);//salto de linea
$this->SetFont('helvetica','B',16);//letra:   tipo / negrita / tamaño
$this->Cell(190,12,'COTIZACION PARA:',0,0,'L'); // Variable que trae el campo "nombre"
$this->Ln(9);//salto de linea
$this->SetFont('helvetica','',13);//letra:   tipo / negrita / tamaño
$this->Cell(190,12,''.$_POST['nombre'].' '.$_POST['apellido'],0,0,'L'); // Variable que trae el campo "nombre"
$this->Ln(7);//salto de linea
$this->Cell(190,10,''.$_POST['telefono'],0,0,'L');// Variable que trae el campo "telefono"
         $this->Ln(7);//salto de linea
$this->Cell(190,10,''.$_POST['correo'],0,0,'L');// Variable que trae el campo "telefono"
$this->Ln(10);//salto de linea
$this->SetFont('helvetica','B',16);//letra:   tipo / negrita / tamaño
$this->Cell(190,12,'ELABORADA POR:',0,0,'L'); // Variable que trae el campo "nombre"
$this->Ln(9);//salto de linea
$this->SetFont('helvetica','',13);//letra:   tipo / negrita / tamaño
$this->Cell(190,10,utf8_decode('Felipe Salas'),0,0,'L');// Variable que trae el campo "telefono"
$this->Ln(6);//salto de linea
$this->Cell(190,10,'Asesor De Ventas',0,0,'L');// Variable que trae el campo "telefono"
$fill=true;
$this->SetFont('helvetica','',18);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$this->Ln(48);//salto de linea
$this->cell(110,5,'           315 739 9574',0,'','L',0,'https://api.whatsapp.com/send?phone=573157399574&text=Hola,%20vi%20la%20cotizacion%20y%20estoy%20interesado');//Vinculo bases y soportes
         $this->cell(185,5,' storegamerplus@gmail.com',0,'','L',0,'mailto:storegamerplus@gmail.com');//Vinculo bases y soportes






}     
    function Footer()
{   
    $this->SetY(-8); // Posición: a 1,5 cm del final    
    $this->SetFont('helvetica','I',13);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
        $this->cell(90,5,'Consolas De Calidad Garantizadas',0,'','L',0);//Vinculo bases y soportes
   $this->cell(40,5,'       315 739 9574 -',0,'','L',0,'https://api.whatsapp.com/send?phone=573157399574&text=Hola,%20vi%20la%20cotizacion%20y%20estoy%20interesado');//Vinculo bases y soportes
         $this->cell(50,5,'  storegamerplus@gmail.com',0,'','L',0,'mailto:storegamerplus@gmail.com');//Vinculo bases y soportes
}
    
}

    $pdf = new PDF();
//-----------PAGINA # 1 Arriba Portada------------//
    $pdf->AddPage();
    $pdf->SetY(65);
    $pdf->TablaColores();
    $pdf->SetLeftMargin(10);
    $pdf->SetFontSize(11);
    
    

    
    
    
    
    
    
//-------------------------------------------PAGINA # 2--------------------------------------------//
    
    
    
    
    
     $pdf->AddPage3();
    $pdf->SetY(37);
$pdf->Image('images/Cotizaciones/play-4-2.jpg',0,0,210);//imagen Linea del footer  margen izq / altura top / tamaño
$pdf->SetFont('helvetica','',12);//letra:   tipo / negrita / tamaño
$fill=false;
$fill=!$fill;   
     $pdf->SetTextColor(6,47,72);//Opacidad del texto
    $pdf->SetFont('helvetica','B',35);//letra:   tipo / negrita / tamaño
       $pdf->SetTextColor(255,255,255);//Opacidad del texto
$pdf->cell(11,5,'                       CARACTERISTICAS',0,'','L',0,'');//Vinculo bases y soportes
$pdf->Ln(-10);//salto de linea
        $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita / tamaño
$pdf->Cell(190,12,utf8_decode('  Cotización          N° - ').$pdf->contadorvisitas().'',0,0,'L');// contador/ consecutivo
$pdf->Ln(8);//salto de linea
    $pdf->Cell(190,12,utf8_decode('  Fecha           ') . date('d') . ' / '. date('m'). ' / '. date('Y'), 0,0,'L');//fecha:    d=dia  /  F=mes  / Y=año
$pdf->Ln(36);//salto de linea
$fill=true;
    $pdf->SetTextColor(0,0,0);//Opacidad del texto
    $pdf->SetFont('helvetica','B', 15);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño

    $pdf->Write(8,utf8_decode('LA ULTIMA CONSOLA DE PS'));
     $pdf->SetTextColor(64,64,65);//Opacidad del texto
    $pdf->Ln(10);//salto de linea  
    $pdf->SetFont('helvetica','', 12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
      $pdf->Write(12,utf8_decode('Es la cuarta videoconsola del modelo PlayStation.
Es la segunda consola de Sony en ser diseñada 
por Mark Cerny y forma parte de las videoconsolas 
de octava generación. Fue anunciada oficialmente
el 20 de febrero de 2013 en el evento PlayStation
Meeting 2013, aunque el diseño de la consola 
no fue presentado hasta el 10 de junio en el E3 
2013.102Es la sucesora de la PlayStation 3 y 
compite con Wii U y Switch de Nintendo y Xbox 
One de Microsoft. Su lanzamiento fue el 15 de
noviembre de 2013 en Estados Unidos y en Europa
y Sudamérica fue el 29 de noviembre de 2013,11
mientras que en Japón fue el 22 de febrero de 2014.'));
$pdf->Ln(35);//salto de linea
$fill=true;
         $pdf->SetTextColor(255,255,255);//Opacidad del texto
    
    
    
//-------------------------------------------PAGINA # 3 -------------------------------------------//
    
    
    
    
    
    $pdf->AddPage();
    $pdf->SetY(37);
     $pdf->Image('images/Cotizaciones/play-4-3.jpg',0,0,210);//imagen Linea del footer  margen izq / altura top / tamaño


$pdf->SetFont('helvetica','',12);//letra:   tipo / negrita / tamaño
$fill=false;
$fill=!$fill;   
     $pdf->SetTextColor(6,47,72);//Opacidad del texto
    $pdf->SetFont('helvetica','B',35);//letra:   tipo / negrita / tamaño
       $pdf->SetTextColor(255,255,255);//Opacidad del texto
$pdf->cell(11,5,'                              PRECIOS',0,'','L',0,'');//Vinculo bases y soportes
$pdf->Ln(-10);//salto de linea
        $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita / tamaño
$pdf->Cell(190,12,utf8_decode('  Cotización          N° - ').$pdf->contadorvisitas().'',0,0,'L');// contador/ consecutivo
$pdf->Ln(8);//salto de linea
    $pdf->Cell(190,12,utf8_decode('  Fecha           ') . date('d') . ' / '. date('m'). ' / '. date('Y'), 0,0,'L');//fecha:    d=dia  /  F=mes  / Y=año
$pdf->Ln(25);//salto de linea
$fill=true;


    
// ---------------------------------------------------------------------------------------//
    $pdf->SetTextColor(6,109,181);//Opacidad del texto
     $pdf->Ln(5);//salto de linea
     $pdf->SetFillColor(6,47,72);//color de la celda
    $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->Cell(50,10,utf8_decode("Producto"),1,0, 'L');
$pdf->SetTextColor(25,25,25);//Opacidad del texto
$pdf->Cell(30,10,"PlayStation 4",1,0,'L');
        $pdf->Ln(10);//salto de linea
         $pdf->SetFillColor(6,47,72);//color de la celda
           $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
         $pdf->SetTextColor(6,109,181);//Opacidad del texto
$pdf->Cell(50,10,utf8_decode("Cantidad"),1,0, 'L');
$pdf->SetTextColor(25,25,25);//Opacidad del texto
$pdf->Cell(30,10,"".$_POST['cantidad'],1,0,'L');
        $pdf->Ln(10);//salto de linea
     $pdf->SetTextColor(6,109,181);//Opacidad del texto
           $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->Cell(50,10,utf8_decode("Precio"),1,0, 'L');
$pdf->SetTextColor(25,25,25);//Opacidad del texto
$pdf->Cell(30,10,utf8_decode("$ " . number_format($_POST['precio'], 0, ',', '.')), 1, "L", 1);
      
            $pdf->Ln(10);//salto de linea
     $pdf->SetTextColor(6,109,181);//Opacidad del texto
           $pdf->SetFont('helvetica','B',12);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->Cell(50,10,utf8_decode("Valor Total"),1,0, 'L');
$pdf->SetTextColor(25,25,25);//Opacidad del texto
$pdf->Cell(30, 10, utf8_decode("$ " . number_format($_POST['subtotal'], 0, ',', '.')), 1, "L", 1);


    
    
    
    
      $pdf->SetTextColor(25,25,25);//Opacidad del texto
        $pdf->Ln(50);//salto de linea
       $pdf->Cell(192,0.5,utf8_decode(''),0,0,'C','true');//linea separadora de color GRIS
 $pdf->Ln(1);//salto de linea 
        $pdf->SetFont('helvetica','',11);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
    $html =utf8_decode('
<br>
   Esta cotizacion incluye los productos mencionados en la misma.
<br>
   Cotización valida por <b>30 dias</b>.
<br>
   Incluye los servicio y productos descritos anteriormente.
<br>
   Condiciones de pago: a convenir.
<br>
   El tiempo de entrega es inmediato dependiendo disponibilidad.
   <br>'); 
    $pdf->WriteHTML($html);
 $pdf->Ln(70);//salto de linea 
    $pdf->SetFont('helvetica','B',13);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->cell(104,5,utf8_decode('     Cordialmente'));
$pdf->Ln(5);//salto de linea
        $pdf->SetFont('helvetica','B',11);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
    $pdf->cell(104,5,utf8_decode('      Felipe Salas'));
$pdf->Ln(5);//salto de linea
$pdf->SetFont('helvetica','',10);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->cell(15,5,'       TEL:',0,'','L',0,'');//Vinculo bases y soportes
$pdf->cell(180,5,'315 739 9574',0,'','L',0,'tel:3157399574');//Vinculo bases y soportes
$pdf->Ln();//salto de linea
    
$pdf->SetFont('helvetica','',10);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
$pdf->cell(20,5,'       EMAIL:',0,'','L',0,'');//Vinculo bases y soportes
$pdf->cell(180,5,'storegamerplus@gmail.com',0,'','L',0,'mailto:storegamerplus@gmail.com');//Vinculo bases y soportes
$pdf->SetFont('helvetica','I',10);//letra:   tipo / negrita=B  italica=I subrayado=U / tamaño
    $pdf->Ln(3);//salto de linea
            $pdf->SetTextColor(255,255,255);//Opacidad del texto
    
$pdf->Output();
} 