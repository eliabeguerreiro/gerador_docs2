<?php

if($_POST){

    //var_dump($_POST);

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
        <link href='' rel='stylesheet'>
        <script async src='https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5526172241213918'
            crossorigin='anonymous'></script>
    </head>


    <body>
    </center>
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



    </body>
</html>