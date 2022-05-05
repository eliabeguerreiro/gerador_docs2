<?php

if($_POST){

    var_dump($_POST);

}


$curl = curl_init();
curl_setopt_array( $curl, [
    CURLOPT_URL                 => "https://servicodados.ibge.gov.br/api/v1/localidades/estados/25/municipios",
    CURLOPT_CUSTOMREQUEST       => 'GET',
    CURLOPT_RETURNTRANSFER      => true,
    CURLOPT_SSL_VERIFYPEER      => false,

]);
$response = json_decode(curl_exec($curl));
//var_dump($response[0]);

?>


<!DOCTYPE html>
<html lang='pt-BR'>

    <head>
        <meta charset='utf-8' />
        <meta name=”description” content='Gerador de Documentos 2.0'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <link rel='shortcut icon' href='img/meia_entrada_logo.png' type='image/x-icon' />
        <title>Gerador Docs 2.0</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- <link href='' rel='stylesheet'> -->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
        <script>
            function getPDF(){
                $("#downloadbtn").hide();
                $("#genmsg").show();
                var HTML_Width =  495;
                var HTML_Height = 715;
                var top_left_margin = 35;
                var PDF_Width = HTML_Width+(top_left_margin*1.99);
                var PDF_Height = (top_left_margin*1)+(PDF_Width*1.35)+(top_left_margin*1);
                var canvas_image_width = HTML_Width;
                var canvas_image_height = HTML_Height;
                
                var totalPDFPages = 2;
                

                html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
                    canvas.getContext('2d');
                    
                    console.log(canvas.height+"  "+canvas.width);
                    
                    
                    var imgData = canvas.toDataURL("image/jpeg", 1.0);
                    var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
                    
                    
                    for (var i = 1; i <= totalPDFPages; i++) { 
                        pdf.addPage(PDF_Width, PDF_Height);
                        pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                    }
                    
                    pdf.save("pdf-<?php echo$_POST['nome_escola1']?>");
                    
                    setTimeout(function(){ 			
                        $("#downloadbtn").show();
                        $("#genmsg").hide();
                    }, 0);

                });
            };
        </script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');

            * {
                margin-top: 0;
                margin-bottom: 2.5px;
            }

            h1{
                font-size: 80px;
                color: #38578e;
            }
            h2{
                font-size: 53px;
                color: #38578e;
            }
            h3{
                font-size: 20px;
                color: #38578e;
            }
            
            .Grupo1{
                font-family: 'Bebas Neue', cursive;
                font-weight: bold;
                text-align: center;
            }
            .Grupo2{text-align: center; margin-top: 55px}
            .Grupo3{text-align: center; margin-top: 15px}
            .Grupo4{text-align: right; margin-top: 110px}
            .Grupo5{text-align: center; display: flex; flex-direction: column; margin-top: 110px}
            .Grupo6{height: 100%; background-color: white;}
            
            @media print {
                .noPrint{display: none;}
            }
        </style>
    </head>


    <body>
    <div class='jumbotron'>
        <form method="POST" action="" enctype="multipart/form-data">

                <label>Nome da Escola</label>
                <input required class="form-control" type="text" name="nome_escola1" >
                <br>

                <div class="col-md-4">
                <label>Endereço</label>
                    <input required class="form-control" type="text" name="endereco1"
                        placeholder="Rua fulano de tal, 000"><br>

                    
                    <label>Município</label>
                    <select required class="form-control" name="municipio1" id="">
                        <?php
                            
                            foreach ($response as $key => $value){
                                echo("<option value='".$value->nome."'>".$value->nome."</option>" );
                                echo $value->nome;
                                echo('<br>');
                            }

                    
                        ?>
                    </select><br>
                    <label>UF</label>
                    <input required class="form-control" type="text" name="UF"
                        value="PB"><br>
                                    
                </div>
                <br><br>


                <label>Nome da Escola</label>
                <input required class="form-control" type="text" name="nome_escola2" >
                <br>

                <div class="col-md-4">
                <label>Endereço</label>
                    <input required class="form-control" type="text" name="endereco2"
                        placeholder="Rua fulano de tal, 000"><br>

                    
                    <label>Município</label>
                    <select required class="form-control" name="municipio2" id="">
                        <?php
                            
                            foreach ($response as $key => $value){
                                echo("<option value='".$value->nome."'>".$value->nome."</option>" );
                                echo $value->nome;
                                echo('<br>');
                            }

                    
                        ?>
                    </select><br>
                    <label>CEP</label>
                    <input required class="form-control" type="text" name="CEP"
                        placeholder="xxxxx-xxx"><br>
                                    
                </div>
                <br><br>

                <!--label>Nome do Grêmio</label>
                <input class="form-control" type="texte" name="gremio" >
                <br>
                <label>Responsável 1</label>
                <input class="form-control" type="text" name="reponsavel1"  placeholder="nome">
                <input class="form-control" type="text" name="ass_reponsavel1" placeholder="assinatura1">
                <br>
                <label>Responsável 2</label>
                <input class="form-control" type="text" name="reponsavel2"  placeholder="nome">
                <input class="form-control" type="text" name="ass_reponsavel2" placeholder="assinatura2">
                <br>
                <label>Responsável 3</label>
                <input class="form-control" type="text" name="reponsavel3"  placeholder="nome">
                <input class="form-control" type="text" name="ass_reponsavel1"placeholder="assinatura3" >
                <br>

                <br--><br><br>
                <input class="btn btn-primary" type="submit" name="btnDocumento" value="GERAR DOCUMENTO"><br>

        </form>
    </div>
    <center>
        <button onclick="getPDF()" id="downloadbtn">Download PDF</button>

        <div style="width: 700px; height: 990px; display: flex; flex-direction: column;" class="canvas_div_pdf">
                <div class="Grupo1">
                    <h1>44º CONUBES</h1>
                    <div style="display: flex; width: 100%; align-items: center; justify-content: center;">
                        <div style="width: 330px; height: 7px; background: #38578e"></div>
                    </div>
                    <h2 style="margin-bottom: 35px">CONGRESSO DA UBES</h2>
                    <img width="450" height="auto" src="./images/logoUBES.png" alt="UBES">
                    
                </div>
                <div class="Grupo2">
                    <h3>ATA DE ELEIÇÃO DOS DELEGADOS/AS</h3>
                    <h3>DADOS DA ESCOLA</h3>
                </div>
                <div class="Grupo3">
                    <div style="width: 100%; display: flex; flex-direction: column">
                        <h3 style="align-self: flex-start">NOME DA ESCOLA:</h3>
                        <input value="NOME DA ESCOLA"/>
                        <h3 style="align-self: flex-start">MUNICÍPIO:</h3>
                        <input value="PARAIBA"/>
                        <h3 style="align-self: flex-start">ENDEREÇO:</h3>
                        <input value="RUA FULANO DE TAL"/>
                    </div>
                </div>
                <div class="Grupo4">
                </div>
                <div class="Grupo5">
                </div>
                <div class="Grupo6" style="margin-bottom: 0">
                </div>
            </div>
    </center>
    </body>
</html>